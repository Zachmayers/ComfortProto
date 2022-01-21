<?php
require_once('mysqldb.class.php');	
require_once('utilities.class.php');	
require_once('member.class.php');	

class OpportunityList {

	public $userID;
	
	function __construct($userID) {
		$this->userID = $userID;
	}
	
	function get_local_opportunities() {
		//get jobs within 40 miles of user

		$member = new Member($_SESSION['userID']);
		$utilities = new Utilities;
				
		$member_data = $member->get_member_data();
								
		$user_coordinates = $utilities->get_coordinates($member_data['zip']);
		$user_lat = $user_coordinates['latitude'];
		$user_long = $user_coordinates['longitude'];

		//set min and max coordinates for store radius (40 miles)
		$min_lat = $user_lat - 0.57971;
		$max_lat = $user_lat + 0.57971;
		$min_long = $user_long - 0.57827;
		$max_long = $user_long + 0.57827;
		
				
		//Strangely, adding the Jobs_Specialties to the main query slows it WAY down
		//dividing it into 2 queries then matching them together actually speeds it up (counter intuitively)
		
		$database = new Database;				
		$database->query("SELECT * FROM jobs, stores, zcta
									WHERE (jobs.job_status = :open OR jobs.job_status = :filled)
									AND jobs.storeID = stores.storeID
									AND stores.zip = zcta.zip
									AND zcta.latitude BETWEEN :min_lat AND :max_lat
									AND zcta.longitude BETWEEN :min_long AND :max_long
									AND jobs.expiration_date > NOW()
									ORDER BY jobs.date_created DESC");							
		$database->bind(':open', "Open");			
		$database->bind(':filled', "Filled");			
		$database->bind(':min_lat', $min_lat);			
		$database->bind(':max_lat', $max_lat);			
		$database->bind(':min_long', $min_long);			
		$database->bind(':max_long', $max_long);			
		$opportunity_array = $database->resultset();
		
		//query for job specialties
		$database->query("SELECT jobs_specialties.jobID, jobs_specialties.specialty FROM jobs, jobs_specialties
									WHERE jobs.jobID = jobs_specialties.jobID
									AND jobs.expiration_date > NOW()");							
		$main_skill_array = $database->resultset();
		
		//attach skills
		if (count($opportunity_array) > 0 && count($main_skill_array) > 0) {
			foreach($opportunity_array as $key=>$row) {
				foreach($main_skill_array as $skill) {
					if ($row['jobID'] == $skill['jobID']) {
						$opportunity_array[$key]['specialty'] = $skill['specialty'];
					}
				}
			}
		}
		
		//determine whether jobs have been viewed before and if they have applied before
		//first get the lowest jobID in the list
		$lowID = 0;
		if (count($opportunity_array) > 0) {
			foreach($opportunity_array as $row) {
				if ($lowID == 0) {
					$lowID = $row['jobID'];
				} else {
					if ($row['jobID'] < $lowID) {
						$lowID = $row['jobID'];						
					}
				}
			}
		}
		
		if ($lowID > 0) {
			//get job views and job responses
			$database->query("SELECT * FROM job_views
										WHERE jobID >= :lowID
										AND userID = :userID");							
			$database->bind(':lowID', $lowID);			
			$database->bind(':userID', $_SESSION['userID']);			
			$job_view_array = $database->resultset();

			$database->query("SELECT jobID, date_responded FROM job_match
										WHERE jobID >= :lowID
										AND employee_interest = :interest
										AND userID = :userID");							
			$database->bind(':lowID', $lowID);			
			$database->bind(':interest', 'Y');				
			$database->bind(':userID', $_SESSION['userID']);			
			$job_response_array = $database->resultset();
			
			//echo var_dump($job_response_array);
			
			foreach($opportunity_array as $key=>$row) {
				if(count($job_view_array) > 0) {
					$opportunity_array[$key]['viewed'] = 'N';
					foreach($job_view_array as $view) {
						if ($row['jobID'] == $view['jobID']) {
							$opportunity_array[$key]['viewed'] = 'Y';
						}
					}
				} else {
					$opportunity_array[$key]['viewed'] = 'N';
				}
				
				if(count($job_response_array) > 0) {
					$opportunity_array[$key]['responded'] = 'N';
					foreach($job_response_array as $response) {
						if ($row['jobID'] == $response['jobID']) {
							$opportunity_array[$key]['responded'] = 'Y';
						}
					}
				} else {
					$opportunity_array[$key]['responded'] = 'N';
				}				
			}			
		}

		$utilities = new Utilities;
		array_walk_recursive($opportunity_array, array($utilities, "makeSafe"));

		return $opportunity_array;		
	}
	
	function get_qualified_opportunities($type) {
		$database = new Database;
		
		switch($type) {
			case "bounty":
				$database->query("SELECT * FROM job_match, jobs, jobs_specialties, stores
														WHERE job_match.userID = :userID
														AND job_match.employee_interest != 'N'
														AND job_match.employer_interest != 'N'
														AND job_match.hidden != 'Y'
														AND jobs.expiration_date > NOW()
														AND job_match.jobID = jobs.jobID
														AND jobs_specialties.jobID = jobs.jobID
														AND jobs.expiration_date > NOW()
														AND jobs.storeID = stores.storeID
														AND jobs.job_status != :job_status
														AND post_type = :post_type
														ORDER BY jobs.bounty DESC ");
			break;
			
			case "non_bounty":
				$database->query("SELECT * FROM job_match, jobs, jobs_specialties, stores
														WHERE job_match.userID = :userID
														AND job_match.employee_interest != 'N'
														AND job_match.employer_interest != 'N'
														AND job_match.hidden != 'Y'
														AND jobs.expiration_date > NOW()
														AND job_match.jobID = jobs.jobID
														AND jobs_specialties.jobID = jobs.jobID
														AND jobs.expiration_date > NOW()
														AND jobs.storeID = stores.storeID
														AND jobs.job_status != :job_status
														AND post_type != :post_type
														ORDER BY jobs.date_created DESC ");	
			break;
			
		}
		
		$database->bind(':userID', $this->userID);			
		$database->bind(':post_type', 'bounty');			
		$database->bind(':job_status', 'Removed');			
		$result = $database->resultset();
		
		$utilities = new Utilities;
		array_walk_recursive($result, array($utilities, "makeSafe"));
		return $result;		
	}
	
	function get_local_bounties() {
		$database = new Database;
		$utilities = new Utilities;
		
		$member = new Member($_SESSION['userID']);
		
		$member_data = $member->get_member_data();
		
		$coordinates = $utilities->get_coordinates($member_data['zip']);
		
		$longitude = $coordinates['longitude'];
		$latitude = $coordinates['latitude'];
		
		//40 mile appoximation, square
		$max_lat = $latitude + 0.57971;
		$min_lat = $latitude - 0.57971;
		$max_long = $longitude + 0.57827;
		$min_long = $longitude - 0.57827;
		
		
		$database->query("SELECT * FROM jobs, jobs_specialties, stores, zcta
												WHERE  jobs.expiration_date > NOW()
												AND jobs_specialties.jobID = jobs.jobID
												AND jobs.storeID = stores.storeID
												AND jobs.post_type = :post_type
												AND jobs.job_status != :job_status
												AND stores.zip = zcta.zip
												AND zcta.latitude BETWEEN :min_lat AND :max_lat
												AND zcta.longitude BETWEEN :min_long AND :max_long
												ORDER BY jobs.bounty DESC ");
		$database->bind(':post_type', 'bounty');			
		$database->bind(':job_status', 'Removed');			
		$database->bind(':min_lat', $min_lat);			
		$database->bind(':max_lat', $max_lat);			
		$database->bind(':min_long', $min_long);			
		$database->bind(':max_long', $max_long);			

		$result = $database->resultset();

		array_walk_recursive($result, array($utilities, "makeSafe"));
		return $result;		
	}
		
	function organize_opportunities_by_specialty($opportunity_array) {
		//create an array of opportunities based on specialties
		$utilities = new Utilities;
		$specialties = $utilities->main_skills;
		
		$new_opportunity_array = array();
		
		foreach ($specialties as $skill) {
			$new_opportunity_array[$skill] = array();

			foreach($opportunity_array as $row) {
				if ($row['specialty'] == $skill) {
					$new_opportunity_array[$skill][] = $row;
				}
			}
		} 
		
		return $new_opportunity_array;
	}
	
	function get_opportunity_job_types() {
		$database = new Database;
		$database->query("SELECT DISTINCT jobs_specialties.specialty FROM job_match, jobs, jobs_specialties
												WHERE job_match.userID = :userID
												AND job_match.employee_interest != 'N'
												AND job_match.employer_interest != 'N'
												AND jobs.expiration_date > NOW()
												AND job_match.jobID = jobs.jobID
												AND jobs_specialties.jobID = jobs.jobID
												AND jobs.expiration_date > NOW() ");
		$database->bind(':userID', $this->userID);			
		$result = $database->resultset();
				
		//flatten result
		$job_types = array();
		
		if (count($result) > 0) {
			foreach($result as $row) {
				$job_types[] = $row['specialty'];
			}
		}
		
		return $job_types;			
	}

	function get_opportunity_store_types() {
		$database = new Database;
		$database->query("SELECT DISTINCT stores.description FROM job_match, jobs, stores
												WHERE job_match.userID = :userID
												AND job_match.employee_interest != 'N'
												AND job_match.employer_interest != 'N'
												AND jobs.expiration_date > NOW()
												AND job_match.jobID = jobs.jobID
												AND jobs.expiration_date > NOW()
												AND jobs.storeID = stores.storeID");
		$database->bind(':userID', $this->userID);			
		$result = $database->resultset();
			
		//flatten result
		$job_types = array();
		
		if (count($result) > 0) {
			foreach($result as $row) {
				$job_types[] = $row['description'];
			}
		}
		
		return $job_types;			
	}
	
	function get_opportunity_schedule_types() {
		$database = new Database;
		$database->query("SELECT DISTINCT jobs.schedule FROM job_match, jobs
												WHERE job_match.userID = :userID
												AND job_match.employee_interest != 'N'
												AND job_match.employer_interest != 'N'
												AND jobs.expiration_date > NOW()
												AND job_match.jobID = jobs.jobID
												AND jobs.expiration_date > NOW()");
		$database->bind(':userID', $this->userID);			
		$result = $database->resultset();
			
		//flatten result
		$job_types = array();
		
		if (count($result) > 0) {
			foreach($result as $row) {
				$job_types[] = $row['schedule'];
			}
		}
		
		return $job_types;			
	}
	
	function get_opportunity_compensation_types() {
		$database = new Database;
		$database->query("SELECT DISTINCT jobs.comp_type FROM job_match, jobs
												WHERE job_match.userID = :userID
												AND job_match.employee_interest != 'N'
												AND job_match.employer_interest != 'N'
												AND jobs.expiration_date > NOW()
												AND job_match.jobID = jobs.jobID
												AND jobs.expiration_date > NOW()");
		$database->bind(':userID', $this->userID);			
		$result = $database->resultset();
			
		//flatten result
		$job_types = array();
		
		if (count($result) > 0) {
			foreach($result as $row) {
				$job_types[] = $row['comp_type'];
			}
		}
		
		return $job_types;			
	}	
	
	function get_opportunity_hourly_range() {
		$database = new Database;
		$database->query("SELECT MIN(comp_value), MAX(comp_value) FROM job_match, jobs
												WHERE job_match.userID = :userID
												AND job_match.employee_interest != 'N'
												AND job_match.employer_interest != 'N'
												AND jobs.expiration_date > NOW()
												AND job_match.jobID = jobs.jobID
												AND jobs.comp_type = :comp_type
												AND jobs.expiration_date > NOW() ");
		$database->bind(':userID', $this->userID);			
		$database->bind(':comp_type', 'Hourly');			
		$result = $database->resultset();

		return $result;
	}
	
	function get_opportunity_salary_range() {
		$database = new Database;
		$database->query("SELECT MIN(comp_value), MAX(comp_value) FROM job_match, jobs
												WHERE job_match.userID = :userID
												AND job_match.employee_interest != 'N'
												AND job_match.employer_interest != 'N'
												AND jobs.expiration_date > NOW()
												AND job_match.jobID = jobs.jobID
												AND jobs.comp_type = :comp_type
												AND jobs.expiration_date > NOW() ");
		$database->bind(':userID', $this->userID);			
		$database->bind(':comp_type', 'Salary');			
		$result = $database->resultset();

		return $result;			
	}							
	
	function get_opportunity_type_counts($opportunity_array) {
		$utilities = new Utilities;
		$specialties = $utilities->main_skills;

		$opportunity_type_count = array();
		
		foreach ($specialties as $skill) {	
			$opportunity_type_count[$skill] = 0;
				
			foreach($opportunity_array as $row) {
				if ($row['specialty'] == $skill) {
					$opportunity_type_count[$skill]++;
				}
			}
		} 
		
		return $opportunity_type_count;	
	}
	
	function filter_opportunity_list($opportunity_list, $type, $filter_array) {
		$filtered_list = array();
		
		switch($type) {
			case "skills":
				foreach($opportunity_list as $row) {
					if (in_array($row['specialty'], $filter_array)) {
						$filtered_list[] = $row; 
					} else {
						$this->log_filtered_job_data($type, $row['jobID']);
					}
				}
			break;
			
			case "stores":
				foreach($opportunity_list as $row) {
					if (in_array($row['description'], $filter_array)) {
						$filtered_list[] = $row; 
					} else {
						$this->log_filtered_job_data($type, $row['jobID']);
					}
				}
			break;
			
			case "schedules":
				foreach($opportunity_list as $row) {
					if (in_array($row['schedule'], $filter_array)) {
						$filtered_list[] = $row; 
					} else {
						$this->log_filtered_job_data($type, $row['jobID']);
					}
				}
			break;
			
			case "comp_type":
				if (in_array("Min Wage", $filter_array)) {
					$filter_array[] = "Min Wage Plus Tips";
				}
				
				foreach($opportunity_list as $row) {
					if (in_array($row['comp_type'], $filter_array)) {
						$filtered_list[] = $row; 
					} else {
						$this->log_filtered_job_data($type, $row['jobID']);
					}
				}
			break;
			
			case "hourly":	
				foreach($opportunity_list as $row) {
					if ($row['comp_type'] == "Hourly") {
						if ($row['comp_value'] >= $filter_array['min'] && $row['comp_value'] <= $filter_array['max']) {
							$filtered_list[] = $row; 
						} else {
							$this->log_filtered_job_data($type, $row['jobID']);
						}
					} else {
						$filtered_list[] = $row; 
					}
				}
			break;
			
			case "salary":		
				foreach($opportunity_list as $row) {
					if ($row['comp_type'] == "Salary") {					
						if ($row['comp_value'] >= $filter_array['min'] && $row['comp_value'] <= $filter_array['max']) {
							$filtered_list[] = $row; 
						} else {
							$this->log_filtered_job_data($type, $row['jobID']);
						}
					} else {
						$filtered_list[] = $row; 						
					}
				}
			break;																																																			
		}
		
		return $filtered_list;
	}
	
	function log_filtered_job_data($type, $jobID) {
		//This will log everytime a job is filtered out of an opportunity list.  This data will be used later
		$database = new Database;				

		$database->query("INSERT INTO opportunity_filter_log (jobID, userID, filter_type, count, date) 
										VALUES (:jobID, :userID, :type, :count, NOW())
										ON DUPLICATE KEY UPDATE count = count + 1");		
		$database->bind(':jobID', $jobID);			
		$database->bind(':userID', $this->userID);			
		$database->bind(':type', $type);			
		$database->bind(':count', '1');			
		$database->execute();								
	}
	
	
	function get_unqualified_opportunities() {
		//First find any jobs that aren't in the match table, but are within zip range
			
		$member = new Member($_SESSION['userID']);
		$utilities = new Utilities;
				
		$member_data = $member->get_member_data();
								
		$user_coordinates = $utilities->get_coordinates($member_data['zip']);
		$user_lat = $user_coordinates['latitude'];
		$user_long = $user_coordinates['longitude'];

		//set min and max coordinates for store radius (40 miles)
		$min_lat = $user_lat - 0.57971;
		$max_lat = $user_lat + 0.57971;
		$min_long = $user_long - 0.57827;
		$max_long = $user_long + 0.57827;
		
		$database = new Database;				
		$database->query("SELECT * FROM jobs, stores, zcta, jobs_specialties
									WHERE  jobs.job_status = 'Open'
									AND jobs.storeID = stores.storeID
									AND stores.zip = zcta.zip
									AND zcta.latitude BETWEEN :min_lat AND :max_lat
									AND zcta.longitude BETWEEN :min_long AND :max_long
									AND jobs_specialties.jobID = jobs.jobID
									AND jobs.expiration_date > NOW()
									GROUP BY jobs.jobID
									ORDER BY jobs.date_created DESC ");							
		$database->bind(':min_lat', $min_lat);			
		$database->bind(':max_lat', $max_lat);			
		$database->bind(':min_long', $min_long);			
		$database->bind(':max_long', $max_long);			
		$unqualified_array  = $database->resultset();

		//get bounty matches
		$bounty_matches = $this->get_qualified_opportunities("bounty");
		//get non_bounty matches
		$non_bounty_matches = $this->get_declined_opportunities("non_bounty");

		if (count($unqualified_array) > 0) {
			foreach ($unqualified_array as $key=>$data1) {
				if (count($bounty_matches) > 0) {
					foreach($bounty_matches as $data2) {
						if ($data1['jobID'] === $data2['jobID']) {
							unset($unqualified_array[$key]);
						} 
					}
				}
				
				if (count($non_bounty_matches) > 0) {
					foreach ($non_bounty_matches as $dm) {
						if ($data1['jobID'] == $dm['jobID']) {
							unset($unqualified_array[$key]);
						}				
					}
				}
			}
		}

		array_walk_recursive($unqualified_array, array($utilities, "makeSafe"));

		return $unqualified_array;																								
	}
	
	
	function get_missed_opportunities($last_login, $current_login) {
		$database = new Database;
		
		$database->query("SELECT job_match.matchID, jobs.jobID FROM job_match, jobs
									WHERE job_match.userID = :userID
									AND jobs.jobID = job_match.jobID
									AND jobs.expiration_date BETWEEN :last_login AND :current_login
									AND jobs.date_created BETWEEN :last_login AND :current_login");		
		$database->bind(':userID', $this->userID);			
		$database->bind(':last_login', $last_login);			
		$database->bind(':current_login', $current_login);			
		$result = $database->resultset();

		return $result;		
	}
	
	function get_responded_opportunities($type) {
		$utilities = new Utilities;

		switch($type) {
			case "recent":
				$database = new Database;
				$database->query("SELECT * FROM job_match, jobs, stores
														WHERE job_match.userID = :userID
														AND jobs.date_created BETWEEN NOW() - INTERVAL 90 DAY AND NOW()
														AND job_match.jobID = jobs.jobID
														AND jobs.storeID = stores.storeID
														AND job_match.employee_interest = 'Y'
														AND jobs.job_status != :job_status
														ORDER BY jobs.date_created DESC ");
				$database->bind(':userID', $this->userID);			
				$database->bind(':job_status', 'Removed');			
				$result = $database->resultset();
				
				array_walk_recursive($result, array($utilities, "makeSafe"));
				return $result;		
			break;			
			
			case "current":
				$database = new Database;
				$database->query("SELECT * FROM job_match, jobs, jobs_specialties, stores
														WHERE job_match.userID = :userID
														AND jobs.expiration_date > NOW()
														AND job_match.jobID = jobs.jobID
														AND jobs_specialties.jobID = jobs.jobID
														AND jobs.storeID = stores.storeID
														AND job_match.employee_interest = 'Y'
														AND jobs.job_status != :job_status
														ORDER BY jobs.date_created DESC ");
				$database->bind(':userID', $this->userID);			
				$database->bind(':job_status', 'Removed');			
				$result = $database->resultset();
				
				array_walk_recursive($result, array($utilities, "makeSafe"));
				return $result;		
			break;
			
			case "expired":
				$database = new Database;

				$database->query("SELECT * FROM job_match, jobs, jobs_specialties, stores
														WHERE job_match.userID = :userID
														AND jobs.expiration_date < NOW()
														AND job_match.jobID = jobs.jobID
														AND jobs_specialties.jobID = jobs.jobID
														AND jobs.storeID = stores.storeID
														AND job_match.employee_interest = 'Y'
														AND jobs.job_status != :job_status
														ORDER BY jobs.date_created DESC ");
				$database->bind(':userID', $this->userID);			
				$database->bind(':job_status', 'Removed');			
				$result = $database->resultset();

				array_walk_recursive($result, array($utilities, "makeSafe"));
				return $result;	
			break;
			
			case "archive":
				$database = new Database;
				$database->query("SELECT * FROM job_match_archive, jobs, jobs_specialties, stores
														WHERE job_match_archive.userID = :userID
														AND jobs.expiration_date < NOW()
														AND job_match_archive.jobID = jobs.jobID
														AND jobs_specialties.jobID = jobs.jobID
														AND jobs.storeID = stores.storeID
														AND job_match_archive.employee_interest = 'Y'
														AND jobs.job_status != :job_status
														ORDER BY jobs.date_created DESC ");
				$database->bind(':userID', $this->userID);			
				$database->bind(':job_status', 'Removed');			
				$result = $database->resultset();

				array_walk_recursive($result, array($utilities, "makeSafe"));
				return $result;								
			break;
		}
	}
	
	function get_group_jobs($groupID) {
				$database = new Database;
				$database->query("SELECT * FROM jobs WHERE groupID = :groupID");
				$database->bind(':groupID', $groupID);			
				$result = $database->resultset();
	}
	
	function get_public_job_list_new($region, $position, $page) {
		$utilities = new Utilities;
		//get a limited list of jobs for front facing site
		//this limited list is based on region
		//if there are several available jobs, try to mix job types
		
		//very inneficient but variable dont bind in limit statement, no clue how pagination is done with PDO
		switch($page) {
			default:
				$page_limit = "LIMIT 30 OFFSET 0";
			break;			
			case "2":
				$page_limit = "LIMIT 30 OFFSET 29";
			break;
			case "3":
				$page_limit = "LIMIT 30 OFFSET 59";
			break;
			case "4":
				$page_limit = "LIMIT 30 OFFSET 89";
			break;
			case "5":
				$page_limit = "LIMIT 30 OFFSET 119";
			break;
			case "6":
				$page_limit = "LIMIT 30 OFFSET 159";
			break;
			case "7":
				$page_limit = "LIMIT 30 OFFSET 179";
			break;
		}
		
		switch($region) {
			default:
				$coordinates_city = "NA";
			break;
						
			case "orlando":
				$coordinates_city = $utilities->get_coordinates('32801');			
			break;
			
			case "tampa":
				$coordinates_city = $utilities->get_coordinates('33602');			
			break;
			
			case "charlotte":
				$coordinates_city = $utilities->get_coordinates('28204');			
			break;			

			}

			if($position != "boh" && $position != "foh" && $position != "all") {
					if ($coordinates_city != "NA") {
						$longitude_city = $coordinates_city['longitude'];
						$latitude_city= $coordinates_city['latitude'];
						
						//40 mile appoximation, square
						$max_lat = $latitude_city + 0.57971;
						$min_lat = $latitude_city - 0.57971;
						$max_long = $longitude_city + 0.57827;
						$min_long = $longitude_city - 0.57827;

						$database = new Database;
						$database->query("SELECT * FROM jobs, stores, zcta, jobs_specialties
													WHERE  jobs.job_status = 'Open'
													AND jobs.storeID = stores.storeID
													AND stores.zip = zcta.zip
													AND zcta.latitude BETWEEN :min_lat AND :max_lat
													AND zcta.longitude BETWEEN :min_long AND :max_long
													AND jobs_specialties.jobID = jobs.jobID
													AND jobs_specialties.specialty = :position
													AND jobs.expiration_date > NOW()
													ORDER BY jobs.date_created DESC ".$page_limit);							
						$database->bind(':min_lat', $min_lat);			
						$database->bind(':max_lat', $max_lat);			
						$database->bind(':min_long', $min_long);			
						$database->bind(':max_long', $max_long);		
						$database->bind(':position', $position);		
							
						$job_list  = $database->resultset();
					} else {
		
						$database = new Database;
						$database->query("SELECT * FROM jobs, stores, jobs_specialties
													WHERE  jobs.job_status = 'Open'
													AND jobs.storeID = stores.storeID
													AND jobs_specialties.jobID = jobs.jobID
													AND jobs_specialties.specialty = :position
													AND jobs.expiration_date > NOW()
													ORDER BY jobs.date_created DESC ".$page_limit);							
						$database->bind(':position', $position);		
									
						$job_list  = $database->resultset();				
					}
			} elseif ($position == "foh") {
					if ($coordinates_city != "NA") {
						$longitude_city = $coordinates_city['longitude'];
						$latitude_city= $coordinates_city['latitude'];
						
						//40 mile appoximation, square
						$max_lat = $latitude_city + 0.57971;
						$min_lat = $latitude_city - 0.57971;
						$max_long = $longitude_city + 0.57827;
						$min_long = $longitude_city - 0.57827;

						$database = new Database;
						$database->query("SELECT * FROM jobs, stores, zcta, jobs_specialties
													WHERE  jobs.job_status = 'Open'
													AND jobs.storeID = stores.storeID
													AND stores.zip = zcta.zip
													AND zcta.latitude BETWEEN :min_lat AND :max_lat
													AND zcta.longitude BETWEEN :min_long AND :max_long
													AND jobs_specialties.jobID = jobs.jobID
													AND (jobs_specialties.specialty = :position_1 
															OR jobs_specialties.specialty = :position_2
															OR jobs_specialties.specialty = :position_3
															OR jobs_specialties.specialty = :position_4)
													AND jobs.expiration_date > NOW()
													ORDER BY jobs.date_created DESC ".$page_limit);							
						$database->bind(':min_lat', $min_lat);			
						$database->bind(':max_lat', $max_lat);			
						$database->bind(':min_long', $min_long);			
						$database->bind(':max_long', $max_long);		
						$database->bind(':position_1', "Server");		
						$database->bind(':position_2', "Host");		
						$database->bind(':position_3', "Bartender");		
						$database->bind(':position_4', "Manager");		
							
						$job_list  = $database->resultset();
					} else {
		
						$database = new Database;
						$database->query("SELECT * FROM jobs, stores, jobs_specialties
													WHERE  jobs.job_status = 'Open'
													AND jobs.storeID = stores.storeID
													AND jobs_specialties.jobID = jobs.jobID
													AND (jobs_specialties.specialty = :position_1 
															OR jobs_specialties.specialty = :position_2
															OR jobs_specialties.specialty = :position_3
															OR jobs_specialties.specialty = :position_4)
													AND jobs.expiration_date > NOW()
													ORDER BY jobs.date_created DESC ".$page_limit);							
						$database->bind(':position_1', "Server");		
						$database->bind(':position_2', "Host");		
						$database->bind(':position_3', "Bartender");		
						$database->bind(':position_4', "Manager");		
									
						$job_list  = $database->resultset();				
					}
				
			} elseif ($position == "boh") {
					if ($coordinates_city != "NA") {
						$longitude_city = $coordinates_city['longitude'];
						$latitude_city= $coordinates_city['latitude'];
						
						//40 mile appoximation, square
						$max_lat = $latitude_city + 0.57971;
						$min_lat = $latitude_city - 0.57971;
						$max_long = $longitude_city + 0.57827;
						$min_long = $longitude_city - 0.57827;

						$database = new Database;
						$database->query("SELECT * FROM jobs, stores, zcta, jobs_specialties
													WHERE  jobs.job_status = 'Open'
													AND jobs.storeID = stores.storeID
													AND stores.zip = zcta.zip
													AND zcta.latitude BETWEEN :min_lat AND :max_lat
													AND zcta.longitude BETWEEN :min_long AND :max_long
													AND jobs_specialties.jobID = jobs.jobID
													AND (jobs_specialties.specialty = :position_1 
															OR jobs_specialties.specialty = :position_2
															OR jobs_specialties.specialty = :position_3)
													AND jobs.expiration_date > NOW()
													ORDER BY jobs.date_created DESC ".$page_limit);							
						$database->bind(':min_lat', $min_lat);			
						$database->bind(':max_lat', $max_lat);			
						$database->bind(':min_long', $min_long);			
						$database->bind(':max_long', $max_long);		
						$database->bind(':position_1', "Kitchen");		
						$database->bind(':position_2', "Bus");		
						$database->bind(':position_3', "Manager");		
							
						$job_list  = $database->resultset();
					} else {
		
						$database = new Database;
						$database->query("SELECT * FROM jobs, stores, jobs_specialties
													WHERE  jobs.job_status = 'Open'
													AND jobs.storeID = stores.storeID
													AND jobs_specialties.jobID = jobs.jobID
													AND (jobs_specialties.specialty = :position_1 
															OR jobs_specialties.specialty = :position_2
															OR jobs_specialties.specialty = :position_3)
													AND jobs.expiration_date > NOW()
													ORDER BY jobs.date_created DESC ".$page_limit);							
						$database->bind(':position_1', "Kitchen");		
						$database->bind(':position_2', "Bus");		
						$database->bind(':position_3', "Manager");		
									
						$job_list  = $database->resultset();				
					}
				
			} else {
				if ($coordinates_city != "NA") {
					$longitude_city = $coordinates_city['longitude'];
					$latitude_city= $coordinates_city['latitude'];
					
					//40 mile appoximation, square
					$max_lat = $latitude_city + 0.57971;
					$min_lat = $latitude_city - 0.57971;
					$max_long = $longitude_city + 0.57827;
					$min_long = $longitude_city - 0.57827;

					$database = new Database;
					$database->query("SELECT * FROM jobs, stores, zcta, jobs_specialties
												WHERE  jobs.job_status = 'Open'
												AND jobs.storeID = stores.storeID
												AND stores.zip = zcta.zip
												AND zcta.latitude BETWEEN :min_lat AND :max_lat
												AND zcta.longitude BETWEEN :min_long AND :max_long
												AND jobs_specialties.jobID = jobs.jobID
												AND jobs.expiration_date > NOW()
												ORDER BY jobs.date_created DESC ".$page_limit);							
					$database->bind(':min_lat', $min_lat);			
					$database->bind(':max_lat', $max_lat);			
					$database->bind(':min_long', $min_long);			
					$database->bind(':max_long', $max_long);		
						
					$job_list  = $database->resultset();
				} else {
	
					$database = new Database;
					$database->query("SELECT * FROM jobs, stores, jobs_specialties
												WHERE  jobs.job_status = 'Open'
												AND jobs.storeID = stores.storeID
												AND jobs_specialties.jobID = jobs.jobID
												AND jobs.expiration_date > NOW()
												ORDER BY jobs.date_created DESC ".$page_limit);							
								
					$job_list  = $database->resultset();				
				}			
			}
						
			return $job_list;
	}	
	
	function get_public_job_list($region, $position) {
		$utilities = new Utilities;
		//get a limited list of jobs for front facing site
		//this limited list is based on region
		//if there are several available jobs, try to mix job types
		
		switch($region) {
			default:
				$coordinates_city = "NA";
			break;
						
			case "orlando":
				$coordinates_city = $utilities->get_coordinates('32801');			
			break;
			
			case "tampa":
				$coordinates_city = $utilities->get_coordinates('33602');			
			break;

/*
			case "jacksonville":
				$coordinates_city = $utilities->get_coordinates('32206');			
			break;

			case "miami":
				$coordinates_city = $utilities->get_coordinates('33166');			
			break;
*/
			
			case "charlotte":
				$coordinates_city = $utilities->get_coordinates('28204');			
			break;			

/*
			case "triangle":
				$coordinates_city = $utilities->get_coordinates('27587');			
			break;			

			case "austin":
				$coordinates_city = $utilities->get_coordinates('78701');			
			break;
			
			case "charleston":
				$coordinates_city = $utilities->get_coordinates('29403');			
			break;
			
			case "nashville":
				$coordinates_city = $utilities->get_coordinates('37219');			
			break;									
*/
			}
			
			if ($coordinates_city != "NA") {
				$longitude_city = $coordinates_city['longitude'];
				$latitude_city= $coordinates_city['latitude'];
				
				//40 mile appoximation, square
				$max_lat = $latitude_city + 0.57971;
				$min_lat = $latitude_city - 0.57971;
				$max_long = $longitude_city + 0.57827;
				$min_long = $longitude_city - 0.57827;
				
				$database = new Database;
				$database->query("SELECT * FROM jobs, stores, zcta, jobs_specialties
											WHERE  jobs.job_status = 'Open'
											AND jobs.storeID = stores.storeID
											AND stores.zip = zcta.zip
											AND zcta.latitude BETWEEN :min_lat AND :max_lat
											AND zcta.longitude BETWEEN :min_long AND :max_long
											AND jobs_specialties.jobID = jobs.jobID
											AND jobs.expiration_date > NOW()
											ORDER BY jobs.date_created DESC ");							
				$database->bind(':min_lat', $min_lat);			
				$database->bind(':max_lat', $max_lat);			
				$database->bind(':min_long', $min_long);			
				$database->bind(':max_long', $max_long);			
				$job_list  = $database->resultset();
			} else {
				$database = new Database;
				$database->query("SELECT * FROM jobs, stores, jobs_specialties
											WHERE  jobs.job_status = 'Open'
											AND jobs.storeID = stores.storeID
											AND jobs_specialties.jobID = jobs.jobID
											AND jobs.expiration_date > NOW()
											ORDER BY jobs.date_created DESC ");							
				$database->bind(':min_lat', $min_lat);			
				$database->bind(':max_lat', $max_lat);			
				$database->bind(':min_long', $min_long);			
				$database->bind(':max_long', $max_long);			
				$job_list  = $database->resultset();				
			}
			
			//separate jobs into types
			$server_jobs = array();
			$bartender_jobs = array();
			$kitchen_jobs = array();
			$manager_jobs = array();
			$host_jobs = array();
			$bus_jobs = array();
			
			foreach($job_list as $row) {
				switch($row['specialty']) {
					case "Server":
						$final_jobs["server"][] = $row;
					break;
					case "Bartender":
						$final_jobs["bartender"][] = $row;
					break;
					case "Kitchen":
						$final_jobs["kitchen"][] = $row;
					break;
					case "Manager":
						$final_jobs["manager"][]  = $row;
					break;
					case "Host":
						$final_jobs["host"][] = $row;
					break;
					case "Bus":
						$final_jobs["bus"][] = $row;
					break;				
				}
			}
			
			$slot = array();
			
			switch($position) {
				default:
					$slot[0] = $this->setup_public_job_slots($slot, $final_jobs, "server", "bartender", "kitchen", "manager", "host", "bus");
					$slot[1] = $this->setup_public_job_slots($slot, $final_jobs, "bartender", "server", "kitchen", "manager", "host", "bus");
					$slot[2] = $this->setup_public_job_slots($slot, $final_jobs, "kitchen", "bartender", "server", "manager", "host", "bus");
					$slot[3] = $this->setup_public_job_slots($slot, $final_jobs, "manager", "kitchen", "bartender", "server", "host", "bus");
					$slot[4] = $this->setup_public_job_slots($slot, $final_jobs, "host", "manager", "bartender", "server", "kitchen", "bus");
					$slot[5] = $this->setup_public_job_slots($slot, $final_jobs, "bus", "host", "manager", "bartender", "server", "kitchen");
				break;
				
				case "foh":
					$slot[0] = $this->setup_public_job_slots($slot, $final_jobs, "server", "bartender", "host", "manager", "bus", "kitchen");
					$slot[1] = $this->setup_public_job_slots($slot, $final_jobs, "bartender", "server", "host", "manager", "bus", "kitchen");
					$slot[2] = $this->setup_public_job_slots($slot, $final_jobs, "host", "server", "bartender", "manager", "bus", "kitchen");
					$slot[3] = $this->setup_public_job_slots($slot, $final_jobs, "manager", "server", "bartender", "host", "bus", "kitchen");
					$slot[4] = $this->setup_public_job_slots($slot, $final_jobs, "server", "bartender", "host", "manager", "bus", "kitchen");
					$slot[5] = $this->setup_public_job_slots($slot, $final_jobs, "bartender", "server", "host", "manager", "bus", "kitchen");
				break;

				case "boh":
					$slot[0] = $this->setup_public_job_slots($slot, $final_jobs, "kitchen", "manager", "bus", "host", "server", "bartender");
					$slot[1] = $this->setup_public_job_slots($slot, $final_jobs, "kitchen", "manager", "bus", "host", "server", "bartender");
					$slot[2] = $this->setup_public_job_slots($slot, $final_jobs, "kitchen", "manager", "bus", "host", "server", "bartender");
					$slot[3] = $this->setup_public_job_slots($slot, $final_jobs, "kitchen", "manager", "bus", "host", "server", "bartender");
					$slot[4] = $this->setup_public_job_slots($slot, $final_jobs, "kitchen", "manager", "bus", "host", "server", "bartender");
					$slot[5] = $this->setup_public_job_slots($slot, $final_jobs, "kitchen", "manager", "bus", "host", "server", "bartender");
				break;

				case "server":
					$slot[0] = $this->setup_public_job_slots($slot, $final_jobs, "server", "host", "bartender", "manager", "kitchen", "bus");
					$slot[1] = $this->setup_public_job_slots($slot, $final_jobs, "server", "host", "bartender", "manager", "kitchen", "bus");
					$slot[2] = $this->setup_public_job_slots($slot, $final_jobs, "server", "host", "bartender", "manager", "kitchen", "bus");
					$slot[3] = $this->setup_public_job_slots($slot, $final_jobs, "server", "host", "bartender", "manager", "kitchen", "bus");
					$slot[4] = $this->setup_public_job_slots($slot, $final_jobs, "server", "host", "bartender", "manager", "kitchen", "bus");
					$slot[5] = $this->setup_public_job_slots($slot, $final_jobs, "server", "host", "bartender", "manager", "kitchen", "bus");
				break;

				case "bartender":
					$slot[0] = $this->setup_public_job_slots($slot, $final_jobs, "bartender", "server", "manager", "host", "kitchen", "bus");
					$slot[1] = $this->setup_public_job_slots($slot, $final_jobs, "bartender", "server", "manager", "host", "kitchen", "bus");
					$slot[2] = $this->setup_public_job_slots($slot, $final_jobs, "bartender", "server", "manager", "host", "kitchen", "bus");
					$slot[3] = $this->setup_public_job_slots($slot, $final_jobs, "bartender", "server", "manager", "host", "kitchen", "bus");
					$slot[4] = $this->setup_public_job_slots($slot, $final_jobs, "bartender", "server", "manager", "host", "kitchen", "bus");
					$slot[5] = $this->setup_public_job_slots($slot, $final_jobs, "bartender", "server", "manager", "host", "kitchen", "bus");
				break;

				case "host":
					$slot[0] = $this->setup_public_job_slots($slot, $final_jobs, "host", "server", "bartender", "bus", "manager", "kitchen");
					$slot[1] = $this->setup_public_job_slots($slot, $final_jobs, "host", "server", "bartender", "bus", "manager", "kitchen");
					$slot[2] = $this->setup_public_job_slots($slot, $final_jobs, "host", "server", "bartender", "bus", "manager", "kitchen");
					$slot[3] = $this->setup_public_job_slots($slot, $final_jobs, "host", "server", "bartender", "bus", "manager", "kitchen");
					$slot[4] = $this->setup_public_job_slots($slot, $final_jobs, "host", "server", "bartender", "bus", "manager", "kitchen");
					$slot[5] = $this->setup_public_job_slots($slot, $final_jobs, "host", "server", "bartender", "bus", "manager", "kitchen");
				break;

				case "cook":
					$slot[0] = $this->setup_public_job_slots($slot, $final_jobs, "kitchen", "manager", "bus", "server", "bartender", "host");
					$slot[1] = $this->setup_public_job_slots($slot, $final_jobs, "kitchen", "manager", "bus", "server", "bartender", "host");
					$slot[2] = $this->setup_public_job_slots($slot, $final_jobs, "kitchen", "manager", "bus", "server", "bartender", "host");
					$slot[3] = $this->setup_public_job_slots($slot, $final_jobs, "kitchen", "manager", "bus", "server", "bartender", "host");
					$slot[4] = $this->setup_public_job_slots($slot, $final_jobs, "kitchen", "manager", "bus", "server", "bartender", "host");
					$slot[5] = $this->setup_public_job_slots($slot, $final_jobs, "kitchen", "manager", "bus", "server", "bartender", "host");
				break;

				case "manager":
					$slot[0] = $this->setup_public_job_slots($slot, $final_jobs, "manager", "bartender", "server", "kitchen", "bus", "host");
					$slot[1] = $this->setup_public_job_slots($slot, $final_jobs, "manager", "bartender", "server", "kitchen", "bus", "host");
					$slot[2] = $this->setup_public_job_slots($slot, $final_jobs, "manager", "bartender", "server", "kitchen", "bus", "host");
					$slot[3] = $this->setup_public_job_slots($slot, $final_jobs, "manager", "bartender", "server", "kitchen", "bus", "host");
					$slot[4] = $this->setup_public_job_slots($slot, $final_jobs, "manager", "bartender", "server", "kitchen", "bus", "host");
					$slot[5] = $this->setup_public_job_slots($slot, $final_jobs, "manager", "bartender", "server", "kitchen", "bus", "host");
				break;

				case "bus":
					$slot[0] = $this->setup_public_job_slots($slot, $final_jobs, "bus", "kitchen", "host", "server", "bartender", "manager");
					$slot[1] = $this->setup_public_job_slots($slot, $final_jobs, "bus", "kitchen", "host", "server", "bartender", "manager");
					$slot[2] = $this->setup_public_job_slots($slot, $final_jobs, "bus", "kitchen", "host", "server", "bartender", "manager");
					$slot[3] = $this->setup_public_job_slots($slot, $final_jobs, "bus", "kitchen", "host", "server", "bartender", "manager");
					$slot[4] = $this->setup_public_job_slots($slot, $final_jobs, "bus", "kitchen", "host", "server", "bartender", "manager");
					$slot[5] = $this->setup_public_job_slots($slot, $final_jobs, "bus", "kitchen", "host", "server", "bartender", "manager");
				break;
			}
			
			
			return $slot;
	}	
	
	function setup_public_job_slots($slot, $final_jobs, $main_array, $second, $third, $fourth, $fifth, $sixth) {
		$empty = "Y";
		$next_slot = array();

		//flatted slot array for testing
		$slot_jobID = array();
		if (count($slot) > 0) {
			foreach($slot as $row) {
				$slot_jobID[] = $row['jobID'];
			}
		}
		
		if (count($final_jobs[$main_array]) > 0) {
			if (count($slot) > 0) {
				if ($empty == "Y") {
					foreach($final_jobs[$main_array] as $job) {
						if (!in_array($job['jobID'], $slot_jobID)) {
							$next_slot = $job;	
							$empty = "N";
							break;
						}
					}
				}
			} else {
				foreach($final_jobs[$main_array] as $job) {
					$next_slot = $job;	
					$empty = "N";
					break;
				}	
			}
		}

		if ($empty == "Y" && count($final_jobs[$second]) > 0) {
			if (count($slot) > 0) {
					if ($empty == "Y") {
						foreach($final_jobs[$second] as $job) {
							if (!in_array($job['jobID'], $slot_jobID)) {
								$next_slot = $job;	
								$empty = "N";
								break;
							}
						}
					}
			} else {
				foreach($final_jobs[$second] as $job) {
					$next_slot = $job;	
					$empty = "N";
					break;
				}	
			}
					
		}	
		
		if ($empty == "Y" && count($final_jobs[$third]) > 0) {
			if (count($slot) > 0) {
					if ($empty == "Y") {
						foreach($final_jobs[$third] as $job) {
							if (!in_array($job['jobID'], $slot_jobID)) {
								$next_slot = $job;	
								$empty = "N";
								break;
							}
						}
					}
			} else {
				foreach($final_jobs[$third] as $job) {
					$next_slot = $job;	
					$empty = "N";
					break;
				}	
			}
					
		}	
		
		if ($empty == "Y" && count($final_jobs[$fourth]) > 0) {
			if (count($slot) > 0) {
					if ($empty == "Y") {
						foreach($final_jobs[$fourth] as $job) {
							if (!in_array($job['jobID'], $slot_jobID)) {
								$next_slot = $job;	
								$empty = "N";
								break;
							}
						}
					}
			} else {
				foreach($final_jobs[$fourth] as $job) {
					$next_slot = $job;	
					$empty = "N";
					break;
				}	
			}
					
		}	
		
		if ($empty == "Y" && count($final_jobs[$fifth]) > 0) {
			if (count($slot) > 0) {
					if ($empty == "Y") {
						foreach($final_jobs[$fifth] as $job) {
							if (!in_array($job['jobID'], $slot_jobID)) {
								$next_slot = $job;	
								$empty = "N";
								break;
							}
						}
					}
			} else {
				foreach($final_jobs[$fifth] as $job) {
					$next_slot = $job;	
					$empty = "N";
					break;
				}	
			}
						
		}	
	
		if ($empty == "Y" && count($final_jobs[$sixth]) > 0) {
			if (count($slot) > 0) {
					if ($empty == "Y") {
						foreach($final_jobs[$sixth] as $job) {
							if (!in_array($job['jobID'], $slot_jobID)) {
								$next_slot = $job;	
								$empty = "N";
								break;
							}
						}
					}
			} else {
				foreach($final_jobs[$sixth] as $job) {
					$next_slot = $job;	
					$empty = "N";
					break;
				}	
			}
						
		}	
		
		$utilities = new Utilities;
		if ($next_slot['zip'] > 0) {
			$city_state = $utilities->get_city_state($next_slot['zip']);	
			$city = $city_state['city'];
			$state = $city_state['state'];
			$next_slot['city'] = $city;
			$next_slot['state'] = $state;
		}
		
		//payscale text
		if ($next_slot['comp_type'] != "") {
			if ($next_slot['comp_type'] == "Hourly") {
				if ($next_slot['comp_value'] > 0) {
					$next_slot['pay_text'] = "$".$next_slot['comp_value']."/HR"; 
				} elseif ($next_slot['comp_value_high'] == $next_slot['comp_value_low']) {
					$next_slot['pay_text'] = "$".$next_slot['comp_value_high']."/HR"; 										
				} else {
					$next_slot['pay_text'] = "$".$next_slot['comp_value_low']."/HR - $".$next_slot['comp_value_high']."/HR"; 										
				}
			} else {
				$next_slot['pay_text'] = " &nbsp; ";
			}
		}

		switch($next_slot['specialty']) {
/*
			default:
				$next_slot['bg_image'] = "images/mobile-bg-server-wide.jpg";			
			break;
*/
			
			case "Server":
				//$next_slot['bg_image'] = "images/mobile-bg-server-wide.jpg";	
				$next_slot['category'] = "FOH";		
				$next_slot['position_type'] = "server";		
				$next_slot['bg_image'] = "images/TINT-Youngserverwhiteshirt.jpg";			
			break;

			case "Bartender":
				//$next_slot['bg_image'] = "images/mobile-bg-bartender-wide.jpg";			
				$next_slot['category'] = "FOH";		
				$next_slot['position_type'] = "bartender";		
				$next_slot['bg_image'] = "images/TINT-PouringDrinksAtSunset.jpg";			
			break;

			case "Kitchen":
			//	$next_slot['bg_image'] = "images/mobile-bg-cook-wide.jpg";			
				$next_slot['category'] = "BOH";		
				$next_slot['position_type'] = "kitchen";		
				$next_slot['bg_image'] = "images/TINT-choppingchives.jpg";			
			break;

			case "Manager":
			//	$next_slot['bg_image'] = "images/mobile-bg-server-wide.jpg";			
				$next_slot['category'] = "Management";		
				$next_slot['position_type'] = "manager";		
				$next_slot['bg_image'] = "images/TINT-Bartender-Beard-Tattoo-with-Menu.jpg";			
			break;

			case "Host":
			//	$next_slot['bg_image'] = "images/mobile-bg-server-wide.jpg";			
				$next_slot['category'] = "FOH";		
				$next_slot['position_type'] = "host";		
				$next_slot['bg_image'] = "images/TINT-Youngserverwhiteshirt.jpg";			
			break;

			case "Bus":
			//	$next_slot['bg_image'] = "images/mobile-bg-cook-wide.jpg";			
				$next_slot['category'] = "BOH";		
				$next_slot['position_type'] = "bus";		
				$next_slot['bg_image'] = "images/TINT-chef-at-work.jpg";			
			break;			
		}

		return $next_slot;	
	}
}