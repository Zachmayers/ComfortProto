<?php
require_once('mysqldb.class.php');	
require_once('utilities.class.php');

class Admin {

	function admin_login($user, $pass) {
		if ($user == "SBCorlando"  && $pass == "Overl0rd22") {	
				echo "true";
				$_SESSION['admin'] = "yes";
				$_SESSION['userID'] = "admin";
		} else {
				echo "false";
		}
	}
	
	function stats_login($user, $pass) {
		if ($user == "james@servebartendcook.com"  && $pass == "Overl0rd22") {	
				$_SESSION['stats'] = "yes";
				echo "true";
		} else {
				echo "false";
		}
	}
	
	function pavement_login($pass) {
		if ($pass == "andrew22") {	
				$_SESSION['pavement'] = "yes";
				echo "true";
		} else {
				echo "false";
		}
	}			
	
	function culinary_login($email, $pass) {
		$database = new Database;			
		$database->query("SELECT culinaryID, expiration_date, valid FROM culinary_school_members 
									WHERE email = :email
									AND password = :password");
		$database->bind(':email', $email);	
		$database->bind(':password', $pass);	
		$result = $database->resultset();

		if (count($result) == 0) {
			echo "false";
		} else {
			foreach($result as $row) {
				$expiration_date = $row['expiration_date'];
				$valid = $row['valid'];
				$culinaryID = $row['culinaryID'];
				date_default_timezone_set('America/Los_Angeles');		
				$current_date =  date('Y-m-d', strtotime("+15 minutes"));
			}	
				
			if ($valid != 'Y' || $current_date > $expiration_date) {
				echo "invalid";
			} else {
				$_SESSION['culinary'] = "yes";					
				$_SESSION['culinaryID'] = $culinaryID;		
				//track the login
				$database = new Database;			
				$database->query("INSERT INTO culinary_admin_login_track (email, date, IP)
											VALUES (:email, NOW(), :IP)");
				$database->bind(':email', $email);
				$database->bind(':IP', $_SERVER['REMOTE_ADDR']);		
				$result = $database->execute();
							
				echo "true";
			}			
		}		
	}	
	
	function create_culinary_member($email, $password, $school, $month, $day, $year) {
		$expiration_date = $year."-".$month."-".$day." 00:00:00";
		echo $expiration_date;
		$database = new Database;			
		$database->query("INSERT INTO culinary_school_members 
									(email, password, school, expiration_date, valid)
									VALUES
									(:email, :password, :school, :expiration_date, :valid)");
		$database->bind(':email', $email);	
		$database->bind(':password', $password);	
		$database->bind(':school', $school);	
		$database->bind(':expiration_date', $expiration_date);	
		$database->bind(':valid', 'Y');	
		$database->resultset();	
	}
	
	function get_culinary_member() {
		$database = new Database;			
		$database->query("SELECT school, email, expiration_date FROM culinary_school_members 
									WHERE culinaryID = :culinaryID");
		$database->bind(':culinaryID', $_SESSION['culinaryID']);	
		$result = $database->single();	
		return $result;		
	}
	
	function get_employer_name($userID) {
		$database = new Database;			
		$database->query("SELECT firstname, lastname, email FROM members 
									WHERE userID = :userID");
		$database->bind(':userID', $userID);	
		$result = $database->single();
		$utilities = new Utilities;
		array_walk_recursive($result, array($utilities, "makeSafe"));
			
		return $result;		
	}

	function get_admin($type) {

		switch($type) {
			case "member_count":
				$database = new Database;			
				$database->query("SELECT userID FROM members WHERE type = :type");
				$database->bind(':type', 'employee');	
				$result = $database->resultset();
				$employee_count = count($result);

				$database = new Database;			
				$database->query("SELECT userID FROM members WHERE type = :type");
				$database->bind(':type', "employer");	
				$result = $database->resultset();
				$employer_count = count($result);

				$total_count = $employee_count + $employer_count;
				
				$count_array = array($total_count, $employee_count, $employer_count);
				return $count_array;			
			break;
			
			case "logins":
				$start_date =  date('Y-m-d', strtotime("-1 week"));
			
				$database = new Database;
				$database->query("SELECT login_track.userID, firstname, lastname, login_date FROM login_track, members
											 WHERE login_track.login_date > :start_date
											  AND login_track.userID = members.userID");
				$database->bind(':start_date', $start_date);	
				$result = $database->resultset();

				$utilities = new Utilities;
				array_walk_recursive($result, array($utilities, "makeSafe"));
				
				return $result;
			break;
			
			case "members":
				$database = new Database;
				$database->query("SELECT * FROM members ORDER BY userID DESC");
				$result = $database->resultset();

				$utilities = new Utilities;
				array_walk_recursive($result, array($utilities, "makeSafe"));

				return $result;
			break;	
			
			case "stores":
				$database = new Database;
				$database->query("SELECT * FROM members, stores
									WHERE stores.userID = members.userID
									 ORDER BY stores.storeID DESC");
				$result = $database->resultset();

				$utilities = new Utilities;
				array_walk_recursive($result, array($utilities, "makeSafe"));

				return $result;
			break;			
		}		
	}
	
	function get_admin_job_list($type, $zip) {
		$utilities = new Utilities;
		$database = new Database;

		switch($type) {	
			case "recent":
				$database->query("SELECT jobs.title, jobs.jobID, jobs.public_hash, members.email, members.firstname, members.lastname, 
												stores.address, stores.zip, stores.name, stores.facebook, stores.twitter
											 FROM jobs, stores, members WHERE 
											jobs.date_created > DATE_SUB(curdate(), INTERVAL 1 WEEK)
											AND stores.storeID = jobs.storeID
											AND jobs.userID = members.userID
											AND jobs.job_status = :job_status
											ORDER BY jobs.date_created DESC ");																			
				$database->bind(':job_status', "open");																																								
				$result = $database->resultset();
				
				return $result;
			break;
					
			case "current":
				switch($zip) {
					default:		
						$coordinates = $utilities->get_coordinates($zip);
						
						$longitude = $coordinates['longitude'];
						$latitude = $coordinates['latitude'];
						
						//40 mile appoximation, square
						$max_lat = $latitude + 0.57971;
						$min_lat = $latitude - 0.57971;
						$max_long = $longitude + 0.57827;
						$min_long = $longitude - 0.57827;
					
						$database->query("SELECT * FROM jobs, jobs_specialties, stores, zcta WHERE 
											(jobs.job_status = :status OR jobs.job_status = :status_filled)
											AND jobs.expiration_date > NOW()
											AND stores.storeID = jobs.storeID
											AND jobs_specialties.jobID = jobs.jobID
											AND stores.zip = zcta.zip
											AND zcta.latitude BETWEEN :min_lat AND :max_lat
											AND zcta.longitude BETWEEN :min_long AND :max_long ORDER BY jobs.date_created ASC ");																			
						$database->bind(':status', "open");																																								
						$database->bind(':status_filled', "filled");																																								
						$database->bind(':min_lat', $min_lat);																																
						$database->bind(':max_lat', $max_lat);																																
						$database->bind(':min_long', $min_long);																																
						$database->bind(':max_long', $max_long);																																							
					break;
					
					case "all":
						$database->query("SELECT * FROM jobs, jobs_specialties, stores WHERE
											(jobs.job_status = :status OR jobs.job_status = :status_filled)	
											AND jobs.expiration_date > NOW()					
											AND stores.storeID = jobs.storeID
											AND jobs_specialties.jobID = jobs.jobID
											ORDER BY jobs.date_created ASC ");																			
						$database->bind(':status', "open");																																								
						$database->bind(':status_filled', "filled");																																								
					break;
					
					case "other":
						//create a query that grabs all jobs outside of core regions
						//current regions
							//Orlando: 32801
							//Tampa:
							//Miami:
							//Jax:
						
						//ORLANDO	
							$coordinates_orlando = $utilities->get_coordinates('32801');
							
							$longitude_orlando = $coordinates_orlando['longitude'];
							$latitude_orlando = $coordinates_orlando['latitude'];
							
							//40 mile appoximation, square
							$max_lat_orlando = $latitude_orlando + 0.57971;
							$min_lat_orlando = $latitude_orlando - 0.57971;
							$max_long_orlando = $longitude_orlando + 0.57827;
							$min_long_orlando = $longitude_orlando - 0.57827;

						//TAMPA		
							$coordinates_tampa = $utilities->get_coordinates('33602');
							
							$longitude_tampa = $coordinates_tampa['longitude'];
							$latitude_tampa = $coordinates_tampa['latitude'];
							
							//40 mile appoximation, square
							$max_lat_tampa = $latitude_tampa + 0.57971;
							$min_lat_tampa = $latitude_tampa - 0.57971;
							$max_long_tampa = $longitude_tampa + 0.57827;
							$min_long_tampa = $longitude_tampa - 0.57827;

						//MIAMI		
							$coordinates_miami = $utilities->get_coordinates('33147');
							
							$longitude_miami = $coordinates_miami['longitude'];
							$latitude_miami = $coordinates_miami['latitude'];
							
							//40 mile appoximation, square
							$max_lat_miami = $latitude_miami + 0.57971;
							$min_lat_miami = $latitude_miami - 0.57971;
							$max_long_miami = $longitude_miami + 0.57827;
							$min_long_miami = $longitude_miami - 0.57827;

						//JAX		
							$coordinates_jax = $utilities->get_coordinates('32202');
							
							$longitude_jax = $coordinates_jax['longitude'];
							$latitude_jax = $coordinates_jax['latitude'];
							
							//40 mile appoximation, square
							$max_lat_jax = $latitude_jax + 0.57971;
							$min_lat_jax = $latitude_jax - 0.57971;
							$max_long_jax = $longitude_jax + 0.57827;
							$min_long_jax = $longitude_jax - 0.57827;
					
						$database->query("SELECT * FROM jobs, jobs_specialties, stores, zcta WHERE
											(jobs.job_status = :status OR jobs.job_status = :status_filled)	
											AND stores.storeID = jobs.storeID
											AND jobs_specialties.jobID = jobs.jobID
											AND jobs.expiration_date > NOW()
											AND stores.zip = zcta.zip
											
											AND zcta.latitude NOT BETWEEN :min_lat_orlando AND :max_lat_orlando
											AND zcta.longitude NOT BETWEEN :min_long_orlando AND :max_long_orlando 
											
											AND zcta.latitude NOT BETWEEN :min_lat_tampa AND :max_lat_tampa
											AND zcta.longitude NOT BETWEEN :min_long_tampa AND :max_long_tampa
											
											AND zcta.latitude NOT BETWEEN :min_lat_miami AND :max_lat_miami
											AND zcta.longitude NOT BETWEEN :min_long_miami AND :max_long_miami 
											
											AND zcta.latitude NOT BETWEEN :min_lat_jax AND :max_lat_jax
											AND zcta.longitude NOT BETWEEN :min_long_jax AND :max_long_jax
											
											ORDER BY jobs.date_created ASC ");	
																													
						$database->bind(':status', "open");																																								
						$database->bind(':status_filled', "filled");																																								
																																													
						$database->bind(':min_lat_orlando', $min_lat_orlando);																																
						$database->bind(':max_lat_orlando', $max_lat_orlando);																																
						$database->bind(':min_long_orlando', $min_long_orlando);																																
						$database->bind(':max_long_orlando', $max_long_orlando);																																							

						$database->bind(':min_lat_tampa', $min_lat_tampa);																																
						$database->bind(':max_lat_tampa', $max_lat_tampa);																																
						$database->bind(':min_long_tampa', $min_long_tampa);																																
						$database->bind(':max_long_tampa', $max_long_tampa);																																							

						$database->bind(':min_lat_miami', $min_lat_miami);																																
						$database->bind(':max_lat_miami', $max_lat_miami);																																
						$database->bind(':min_long_miami', $min_long_miami);																																
						$database->bind(':max_long_miami', $max_long_miami);																																							

						$database->bind(':min_lat_jax', $min_lat_jax);																																
						$database->bind(':max_lat_jax', $max_lat_jax);																																
						$database->bind(':min_long_jax', $min_long_jax);																																
						$database->bind(':max_long_jax', $max_long_jax);																																												
					break;
				}
				
				$result = $database->resultset();
				array_walk_recursive($result, array($utilities, "makeSafe"));

				return $result;
			break;
			
			case "archive":
				switch($zip) {
					default:		
						$coordinates = $utilities->get_coordinates($zip);
						
						$longitude = $coordinates['longitude'];
						$latitude = $coordinates['latitude'];
						
						//40 mile appoximation, square
						$max_lat = $latitude + 0.57971;
						$min_lat = $latitude - 0.57971;
						$max_long = $longitude + 0.57827;
						$min_long = $longitude - 0.57827;
					
						$database->query("SELECT * FROM jobs, jobs_specialties, stores, zcta WHERE 
											jobs.expiration_date < NOW()
											AND stores.storeID = jobs.storeID
											AND jobs_specialties.jobID = jobs.jobID
											AND stores.zip = zcta.zip
											AND zcta.latitude BETWEEN :min_lat AND :max_lat
											AND zcta.longitude BETWEEN :min_long AND :max_long ORDER BY jobs.date_created ASC ");																			
						$database->bind(':min_lat', $min_lat);																																
						$database->bind(':max_lat', $max_lat);																																
						$database->bind(':min_long', $min_long);																																
						$database->bind(':max_long', $max_long);																																							
					break;
					
					case "all":
						//echo "HERE";
						$database->query("SELECT * FROM jobs, jobs_specialties, stores WHERE stores.storeID = jobs.storeID
											AND jobs.expiration_date < NOW()
											AND jobs_specialties.jobID = jobs.jobID
											ORDER BY jobs.date_created ASC ");																			
					break;
					
					case "other":
						//create a query that grabs all jobs outside of core regions
						//current regions
							//Orlando: 32801
							//Tampa:
							//Miami:
							//Jax:
						
						//ORLANDO	
							$coordinates_orlando = $utilities->get_coordinates('32801');
							
							$longitude_orlando = $coordinates_orlando['longitude'];
							$latitude_orlando = $coordinates_orlando['latitude'];
							
							//40 mile appoximation, square
							$max_lat_orlando = $latitude_orlando + 0.57971;
							$min_lat_orlando = $latitude_orlando - 0.57971;
							$max_long_orlando = $longitude_orlando + 0.57827;
							$min_long_orlando = $longitude_orlando - 0.57827;

						//TAMPA		
							$coordinates_tampa = $utilities->get_coordinates('33602');
							
							$longitude_tampa = $coordinates_tampa['longitude'];
							$latitude_tampa = $coordinates_tampa['latitude'];
							
							//40 mile appoximation, square
							$max_lat_tampa = $latitude_tampa + 0.57971;
							$min_lat_tampa = $latitude_tampa - 0.57971;
							$max_long_tampa = $longitude_tampa + 0.57827;
							$min_long_tampa = $longitude_tampa - 0.57827;

						//MIAMI		
							$coordinates_miami = $utilities->get_coordinates('33147');
							
							$longitude_miami = $coordinates_miami['longitude'];
							$latitude_miami = $coordinates_miami['latitude'];
							
							//40 mile appoximation, square
							$max_lat_miami = $latitude_miami + 0.57971;
							$min_lat_miami = $latitude_miami - 0.57971;
							$max_long_miami = $longitude_miami + 0.57827;
							$min_long_miami = $longitude_miami - 0.57827;

						//JAX		
							$coordinates_jax = $utilities->get_coordinates('32202');
							
							$longitude_jax = $coordinates_jax['longitude'];
							$latitude_jax = $coordinates_jax['latitude'];
							
							//40 mile appoximation, square
							$max_lat_jax = $latitude_jax + 0.57971;
							$min_lat_jax = $latitude_jax - 0.57971;
							$max_long_jax = $longitude_jax + 0.57827;
							$min_long_jax = $longitude_jax - 0.57827;
					
						$database->query("SELECT * FROM jobs, jobs_specialties, stores, zcta WHERE
											 stores.storeID = jobs.storeID
											AND jobs_specialties.jobID = jobs.jobID
											AND jobs.expiration_date < NOW()
											AND stores.zip = zcta.zip
											
											AND zcta.latitude NOT BETWEEN :min_lat_orlando AND :max_lat_orlando
											AND zcta.longitude NOT BETWEEN :min_long_orlando AND :max_long_orlando 
											
											AND zcta.latitude NOT BETWEEN :min_lat_tampa AND :max_lat_tampa
											AND zcta.longitude NOT BETWEEN :min_long_tampa AND :max_long_tampa
											
											AND zcta.latitude NOT BETWEEN :min_lat_miami AND :max_lat_miami
											AND zcta.longitude NOT BETWEEN :min_long_miami AND :max_long_miami 
											
											AND zcta.latitude NOT BETWEEN :min_lat_jax AND :max_lat_jax
											AND zcta.longitude NOT BETWEEN :min_long_jax AND :max_long_jax
											
											ORDER BY jobs.date_created ASC ");	
																																													
						$database->bind(':min_lat_orlando', $min_lat_orlando);																																
						$database->bind(':max_lat_orlando', $max_lat_orlando);																																
						$database->bind(':min_long_orlando', $min_long_orlando);																																
						$database->bind(':max_long_orlando', $max_long_orlando);																																							

						$database->bind(':min_lat_tampa', $min_lat_tampa);																																
						$database->bind(':max_lat_tampa', $max_lat_tampa);																																
						$database->bind(':min_long_tampa', $min_long_tampa);																																
						$database->bind(':max_long_tampa', $max_long_tampa);																																							

						$database->bind(':min_lat_miami', $min_lat_miami);																																
						$database->bind(':max_lat_miami', $max_lat_miami);																																
						$database->bind(':min_long_miami', $min_long_miami);																																
						$database->bind(':max_long_miami', $max_long_miami);																																							

						$database->bind(':min_lat_jax', $min_lat_jax);																																
						$database->bind(':max_lat_jax', $max_lat_jax);																																
						$database->bind(':min_long_jax', $min_long_jax);																																
						$database->bind(':max_long_jax', $max_long_jax);																																												
					break;
				}
				
				$result = $database->resultset();
				array_walk_recursive($result, array($utilities, "makeSafe"));

				return $result;
			break;												
		}		
	}
	
	function get_employer_email_list() {
		$database = new Database;
		$database->query("SELECT firstname, lastname, email FROM members 
									WHERE type = :type
									AND email_validation = :email_validation
									AND valid = :valid
									AND email_setting = :email_setting");
		$database->bind(':type', 'employer');
		$database->bind(':valid', 'Y');
		$database->bind(':email_validation', 'Y');
		$database->bind(':email_setting', 'Y');
		$result = $database->resultset();	
		
		return $result;	
	}
	
	function get_culinary_jobs() {
		$utilities = new Utilities;
		$database = new Database;
		//get jobs from the last 30 days
		$database->query("SELECT * FROM jobs, stores 
									WHERE jobs.intern = :intern
									AND jobs.date_created BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()
									AND (jobs.job_status = :open OR jobs.job_status = :filled)
									AND stores.storeID = jobs.storeID
									ORDER BY jobs.date_created DESC");
		$database->bind(':intern', 'Y');
		$database->bind(':open', 'Open');
		$database->bind(':filled', 'Filled');
		$result = $database->resultset();
		array_walk_recursive($result, array($utilities, "makeSafe"));

		return $result;								
	}
	
	function get_store($storeID) {
		$utilities = new Utilities;
		$database = new Database;
		$database->query("SELECT * FROM stores 
									WHERE storeID = :storeID");
		$database->bind(':storeID', $storeID);
		$result = $database->resultset();
	//	array_walk_recursive($result, array($utilities, "makeSafe"));

		return $result;								
		
	}	
	
	function get_member_info($type, $ID) {
		$database = new Database;
		
		switch($type) {
			case "employee":
				$database->query("SELECT * FROM members WHERE type = 'employee' ORDER BY lastname ASC");
			break;
			
			case "employer":
				$database->query("SELECT * FROM employer, members WHERE members.type = 'employer'
									AND employer.userID = members.userID
									ORDER BY members.lastname ASC");
			break;			
			
			case "video":
				$database->query("SELECT * FROM videos WHERE userID = :userID ");
				$database->bind(':userID', $ID);	
			break;
			
			case "gallery":
				$database->query("SELECT * FROM photo_gallery WHERE userID = :userID AND deleted = :deleted");
				$database->bind(':userID', $ID);	
				$database->bind(':deleted', "N");	
			break;
			
			case "skills":
				$database->query("SELECT * FROM skills WHERE userID = :userID ");
				$database->bind(':userID', $ID);	
			break;
			
			case "job_list":
				$database->query("SELECT * FROM jobs, jobs_specialties 
											WHERE jobs.storeID = :storeID 
											AND jobs_specialties.jobID = jobs.jobID
											ORDER BY jobs.date_created DESC");
				$database->bind(':storeID', $ID);					
			break;
						
			case "profile_pics":
				$database->query("SELECT * FROM members WHERE type = 'employee' 
									AND profile_pic != '' ORDER BY lastname ASC");			
			break;	
			
			case "gallery_pics":
				$database->query("SELECT * FROM members, photo_gallery WHERE members.userID = photo_gallery.userID
									 ORDER BY members.lastname ASC");			
			break;
			
			case "videos":
				$database->query("SELECT * FROM members, videos WHERE members.userID = videos.userID 
									ORDER BY members.lastname ASC");			
			break;
			
			case "activation_notes":
				$database->query("SELECT * FROM activation_change WHERE userID = :userID");			
				$database->bind(':userID', $ID);					
			break;
			
			case "edits":
				$database->query("SELECT * FROM profile_update_log WHERE userID = :userID ORDER BY date DESC");			
				$database->bind(':userID', $ID);					
			break;			
		}
		$result = $database->resultset();

		$utilities = new Utilities;
		array_walk_recursive($result, array($utilities, "makeSafe"));

		return $result;
	 }	
	 
	 function get_profile_pics_by_month($date) {
		$database = new Database;
		 
		$database->query("SELECT DISTINCT userID FROM photo_updates WHERE date >= :date AND type = :type");			
		$database->bind(':date', $date);	
		$database->bind(':type', "profile");	
		$result = $database->resultset();

		$member_array = array();
		
		if (count($result) > 0) {
			foreach($result as $row) {
				$database->query("SELECT * FROM members WHERE userID = :userID AND profile_pic != '' ORDER BY lastname ASC");			
				$database->bind(':userID', $row['userID']);	
				$user = $database->single();
				
				$member_array[] = $user;
			}
		}
		
		return $member_array;						
	 }
	 
	 function get_gallery_pics_by_month($date) {
		$database = new Database;
		 
		$database->query("SELECT DISTINCT userID FROM photo_updates WHERE date >= :date AND type = :type");			
		$database->bind(':date', $date);	
		$database->bind(':type', "gallery");	
		$result = $database->resultset();

		$member_array = array();
		
		if (count($result) > 0) {
			foreach($result as $row) {
				$database->query("SELECT * FROM members, photo_gallery WHERE members.userID = photo_gallery.userID
									 ORDER BY members.lastname ASC");			
				
				
				$database->query("SELECT * FROM members, photo_gallery WHERE members.userID = :userID AND members.userID = photo_gallery.userID
											 ORDER BY members.lastname ASC");			
				$database->bind(':userID', $row['userID']);	
				$user_array = $database->resultset();
				
				if (count($user_array) > 0) {
					foreach($user_array as $row) {
						$member_array[] = $row;
					}
				}
			}
		}
		
		return $member_array;						
	 }	 
	 
	 function get_job_views($jobID, $job_data) {
		 if ($job_data['general']['code'] == 'A') {
			 //get detailed view info
			$database = new Database;
			$database->query("SELECT * FROM job_views WHERE jobID = :jobID");			
			$database->bind(':jobID', $jobID);					
			$result = $database->resultset();
			
			$qualified_views = 0;
			$unqualified_views = 0;
			$unique_views = 0;
			$list_views = 0;
			$flat_users = array();
			
			foreach($result as $row) {
				if ($row['type'] == "qualified") {
					$qualified_views++;					
				} elseif ($row['type'] == "unqualified") {
					$unqualified_views++;										
				} elseif ($row['type'] == "list") {
					$list_views++;										
				} 
				
				$flat_users[] = $row['userID'];
			}
			 
			 $flat_users = array_unique($flat_users);
			 $unique_views = count($flat_users);
		 } else {
			$qualified_views = $job_data['view_count'];
			$unqualified_views = "NA";
			$unique_views = "NA";
			$list_views = "NA";			 						 
		 }

		 $views = array("reach" => $job_data['candidate_count'], 
		 						"declines" => $job_data['negative_count'], 
		 						"interested" => $job_data['positive_list'],
		 						"qualified_views" => $qualified_views,
		 						"unqualified_views" => $unqualified_views, 
		 						"unique_views" => $unique_views,
		 						"list_views" => $list_views		 						
		 						);
		 return $views;
	}
	 
	 function search_employees($criteria, $term) {
			$database = new Database;
			 
		switch($criteria) {
			case "email":
				$database->query("SELECT * FROM members WHERE type = 'employee' 
											AND email = :email ORDER BY lastname ASC");
				$database->bind(':email', $term);														
			break;
			
			case "last_name":
				$database->query("SELECT * FROM members WHERE type = 'employee' 
									AND lastname LIKE :term ORDER BY lastname ASC");
				$database->bind(':term', '%'.$term.'%');														
									
			break;
			
			case "zip":
				$database->query("SELECT * FROM members WHERE type = 'employee' 
									AND zip = :term ORDER BY lastname ASC");
				$database->bind(':term', $term);																							
			break;
						
			case "status":
				$database->query("SELECT * FROM members WHERE type = 'employee' 
									AND profile_status = :term ORDER BY lastname ASC");
				$database->bind(':term', $term);																																
			break;
			
			case "active":
				$database->query("SELECT * FROM members WHERE type = 'employee' 
									AND valid = :term ORDER BY lastname ASC");
				$database->bind(':term', $term);																																
			break;
			
			case "video":
				$member_array = array();
				$database->query("SELECT * FROM members, videos WHERE members.type = 'employee' 
									AND members.userID =  videos.userID ORDER BY members.lastname ASC");
			break;			
			
			case "photo":
				$member_array = array();
				$database->query("SELECT * FROM members WHERE members.type = 'employee' 
									AND profile_pic !=  '' ORDER BY lastname ASC");
			break;	
			
			case "user_data":
				$zip = $term[0];
				$skill = $term[1];

				$utilities = new Utilities;
				
				if ($skill == 'all') {
					$and = "";
				} else {
					$and = "AND skills.skill = :skill";
				}				
				
				if ($zip == "all") {
					$database->query("SELECT * FROM members, skills WHERE members.type = :type
												AND members.profile_status = :status
												AND members.email_validation = :validation
												AND skills.userID = members.userID
												".$and."
												AND skills.seeking = :seeking ");	
					$database->bind(':type', "employee");																																
					$database->bind(':status', "complete");																																
					$database->bind(':seeking', "Y");																																
					$database->bind(':validation', "Y");	
					if ($skill != 'all') {
						$database->bind(':skill', $skill);																																
					}																																																																			
				} else {
					//get longitude and latitude for the store zip code	
					$coordinates = $utilities->get_coordinates($zip);
					
					$longitude = $coordinates['longitude'];
					$latitude = $coordinates['latitude'];
					
					//40 mile appoximation, square
					$max_lat = $latitude + 0.57971;
					$min_lat = $latitude - 0.57971;
					$max_long = $longitude + 0.57827;
					$min_long = $longitude - 0.57827;
									
					$database->query("SELECT * FROM members, skills, zcta WHERE members.type = :type
												AND members.profile_status = :status
												AND members.email_validation = :validation
												AND skills.userID = members.userID
												".$and."
												AND skills.seeking = :seeking
												AND members.zip = zcta.zip
												AND zcta.latitude BETWEEN :min_lat AND :max_lat
												AND zcta.longitude BETWEEN :min_long AND :max_long ");	
					$database->bind(':type', "employee");																																
					$database->bind(':status', "complete");																																
					$database->bind(':seeking', "Y");																																
					$database->bind(':validation', "Y");									
					$database->bind(':min_lat', $min_lat);																																
					$database->bind(':max_lat', $max_lat);																																
					$database->bind(':min_long', $min_long);																																
					$database->bind(':max_long', $max_long);																																							
					if ($skill != 'all') {
						$database->bind(':skill', $skill);																																
					}																											
			}
				
			break;				
		} 
		$result = $database->resultset();

		$utilities = new Utilities;
		array_walk_recursive($result, array($utilities, "makeSafe"));

		return $result;
	 }	 
	 
	 function get_user_logins($ID) {
		$database = new Database;

		$database->query("SELECT * FROM login_track WHERE userID = :userID ORDER BY login_date DESC");						
		$database->bind(':userID', $ID);																																
		$result = $database->resultset();

		$utilities = new Utilities;
		array_walk_recursive($result, array($utilities, "makeSafe"));

		return $result;
	 } 
	 
	 function get_matches($type, $ID) {
		$database = new Database;

		switch($type) {
			case "member":
				$database->query("SELECT * FROM jobs, job_match WHERE job_match.userID = :userID
									AND jobs.jobID = job_match.jobID ORDER BY job_match.date_created DESC");	
				$database->bind(':userID', $ID);																																														
			break;
			
			case "job":
				$database->query("SELECT * FROM members, job_match WHERE job_match.jobID = :jobID
									AND members.userID = job_match.userID ");	
				$database->bind(':jobID', $ID);																																																																
			break;		
		}
	
		$result = $database->resultset();

		$utilities = new Utilities;
		array_walk_recursive($result, array($utilities, "makeSafe"));

		return $result;
	 }
	 
	 function get_questions($matchID) {
		$database = new Database;

		$database->query("SELECT * FROM job_match, job_questions, job_answers WHERE job_match.matchID = :matchID
							AND job_questions.jobID = job_match.jobID
							AND job_answers.questionID = job_questions.questionID
							AND job_answers.userID = job_match.userID ");										
		$database->bind(':matchID', $matchID);																																																																
		$result = $database->resultset();

		$utilities = new Utilities;
		array_walk_recursive($result, array($utilities, "makeSafe"));

		return $result;
	 }
	 
	 function change_email_setting($userID, $email_setting) {
		$database = new Database;
		
		if ($email_setting == "Y") {
			$new_setting = "N";
		} elseif ($email_setting == "N") {
			$new_setting = "Y";
		} else {
			$new_setting = $email_setting;
		}
		
		$database->query("UPDATE members SET email_setting = :new_setting WHERE userID = :userID LIMIT 1");										
		$database->bind(':new_setting', $new_setting);																																																																
		$database->bind(':userID', $userID);																																																																
		$database->execute();
	 }
	 
	 function change_activation_setting($userID, $activation_setting, $activation_reason) {		
		if ($activation_setting == "Y") {
			$new_setting = "N";
		} elseif ($activation_setting == "N") {
			$new_setting = "Y";
		} else {
			$new_setting = $email_setting;
		}

		$database = new Database;		
		$database->query("UPDATE members SET valid = :new_setting WHERE userID = :userID LIMIT 1");										
		$database->bind(':new_setting', $new_setting);																																																																
		$database->bind(':userID', $userID);																																																																
		$database->execute();

		$database = new Database;
		$database->query("INSERT INTO activation_change (userID, change_to, reason, date) 
								VALUES (:userID, :activation_setting, :activation_reason, NOW()) ");										
		$database->bind(':userID', $userID);																																																																
		$database->bind(':activation_setting', $activation_setting);																																																																
		$database->bind(':activation_reason', $activation_reason);																																																																
		$database->execute();
	 }	 
	 
	 function unarchive_job($jobID) {		
		//first determine whether there is already a job with this ID, in case of error
		$database = new Database;		
		$database->query("SELECT * FROM jobs WHERE jobID = :jobID");
		$database->bind(':jobID', $jobID);																																																																
		$job_array = $database->resultset();
		
		if (count($job_array) == 0) {		
			$database = new Database;		
			$database->query("SELECT * FROM jobs_archive WHERE jobID = :jobID ");
			$database->bind(':jobID', $jobID);																																																																
			$result = $database->resultset();
	
			if (count($result) > 0) {
				foreach ($result as $row) {	
					//unarchive job_details
					$database = new Database;		
					$database->query("INSERT INTO jobs SET
												jobID = :jobID,
												userID = :userID,								
												storeID = :storeID,								
												title = :title,								
												description = :description,		
												qualifications = :qualifications,								
												benefits = :benefits,								
												benefits_desc = :benefits_desc,								
												schedule = :schedule,								
												comp_type = :comp_type,								
												comp_value = :comp_value,								
												job_status = :job_status,								
												date_created = :date_created,								
												expiration_date = :expiration_date");
					$database->bind(':jobID', $row['jobID']);
					$database->bind(':userID', $row['userID']);																																																																						
					$database->bind(':storeID', $row['storeID']);	
					$database->bind(':title', $row['title']);	
					$database->bind(':description', $row['description']);						
					$database->bind(':qualifications', $row['qualifications']);	
					$database->bind(':benefits', $row['benefits']);	
					$database->bind(':benefits_desc', $row['benefits_desc']);	
					$database->bind(':jobID', $row['jobID']);	
					$database->bind(':schedule', $row['schedule']);	
					$database->bind(':comp_type', $row['comp_type']);	
					$database->bind(':comp_value', $row['comp_value']);
					$database->bind(':job_status', $row['job_status']);	
					$database->bind(':date_created', $row['date_created']);
					$database->bind(':expiration_date', $row['expiration_date']);																																											
					$database->execute();
					
					//REMOVE JOB FROM ARCHIVE TABLE
					$database = new Database;			
					$database->query("DELETE FROM jobs_archive WHERE jobID = :jobID LIMIT 1 ");
					$database->bind(':jobID', $row['jobID']);
					$database->execute();
					
					
					//get skills associated with job
					$database = new Database;			
					$database->query("SELECT * FROM jobs_specialties_archive WHERE jobID = :jobID ");
					$database->bind(':jobID', $row['jobID']);
					$skill_array = $database->resultset();
					echo "COUNT".count($skill_array)."<br />";
					//archive the skills
					if (count($skill_array) > 0) {
						foreach($skill_array as $specialty) {
							$specialtyID = $specialty['ID'];
							echo "SPECIALITY ID=".$specialtyID."<br />";
							$database = new Database;
							$database->query("INSERT INTO jobs_specialties SET
														ID = '".$specialtyID."',								
														jobID = '".$specialty['jobID']."',
														specialty = '".$specialty['specialty']."' ");							
							$database->bind(':jobID', $specialty['jobID']);
							$database->bind(':ID', $specialtyID);																																																																						
							$database->bind(':specialty', $specialty['specialty']);	
							$database->execute();
							
							//REMOVE JOB SKILL FROM ARCHIVE TABLE
							$database = new Database;
							$database->query("DELETE FROM jobs_specialties_archive WHERE ID = :ID LIMIT 1 ");
							$database->bind(':ID', $specialtyID);																																																																						
							$database->execute();
							
							//get sub_skills
							$database = new Database;
							$database->query("SELECT * FROM jobs_sub_specialties_archive WHERE specialtyID = :ID");
							$database->bind(':ID', $specialtyID);																																																																						
							$sub_array = $database->resultset();
							
							//archive sub skills
							echo "SUB".count($sub_array)."<br />";
							if (count($sub_array) > 0) {
								foreach($sub_array as $sub) {
									//echo "SUBID".$sub['ID']."<br />";
									$database = new Database;
									$database->query("INSERT INTO jobs_sub_specialties SET
																ID = :ID,										
																specialtyID = :specialtyID,								
																sub_specialty = :sub_specialty,
																preference = :preference");							
									$database->bind(':ID', $sub['ID']);
									$database->bind(':specialtyID', $specialtyID);																																																																						
									$database->bind(':sub_specialty:', $sub['sub_specialty']);	
									$database->bind(':preference:', $sub['preference']);	
									$database->execute();
									
									//REMOVE JOB SUB-SKILL FROM ARCHIVE TABLE
									$database = new Database;
									$database->query("DELETE FROM jobs_sub_specialties_archive WHERE ID = :ID LIMIT 1 ");
									$database->bind(':ID', $sub['ID']);
									$database->execute();
								}					
							}
						}
					}			
					
					//archive the questions
					$database = new Database;
					$database->query("SELECT * FROM job_questions_archive WHERE jobID = :jobID ");
					$database->bind(':jobID', $row['jobID']);
					$question_array = $database->resultset();		
					
					if (count($question_array) > 0) {
						foreach($question_array as $question) {
							$questionID = $question['questionID'];
							$database = new Database;
							$database->query("INSERT INTO job_questions SET
												questionID = :questionID,								
												jobID = :jobID,
												question = :question");	
							$database->bind(':questionID', $questionID);
							$database->bind(':jobID', $question['jobID']);
							$database->bind(':questionID', $question['question']);																		
							$database->execute();
							
							//REMOVE JOB QUESTION FROM ARCHIVE TABLE
							$database = new Database;
							$database->query("DELETE FROM job_questions_archive WHERE questionID = :questionID LIMIT 1 ");
							$database->bind(':questionID', $questionID);
							$database->execute();
		
							//get job_answers
							$database = new Database;
							$database->query("SELECT * FROM job_answers_archive WHERE questionID = :questionID");
							$database->bind(':questionID', $questionID);
							$answer_array = $database->resultset();
							
							if (count($answer_array) > 0) {
								foreach($answer_array as $answer) {
									$database = new Database;
									$database->query("INSERT INTO job_answers SET
																	answerID = :answerID,										
																	questionID = :questionID,								
																	userID = :userID,
																	answer = :answerID");							
									$database->bind(':answerID', $answer['answerID']);
									$database->bind(':questionID', $questionID);
									$database->bind(':userID', $answer['userID']);									
									$database->bind(':answerID', $answer['answer']);									
									$database->execute();
									
									//REMOVE JOB QUESTION FROM ARCHIVE TABLE
									$database = new Database;
									$database->query("DELETE FROM job_answers_archive WHERE answerID = '".$answer['answerID']."' LIMIT 1 ");
									$database->bind(':answerID', $answer['answerID']);
									$database->execute();									
								}
							}			
						}
					}
				
					//get job match data
					$database = new Database;
					$database->query("SELECT * FROM job_match_archive WHERE jobID = :jobIDs");
					$database->bind(':jobID', $row['jobID']);	
					$match_array = $database->resultset();
				
					//unarchive job match data
					if (count($match_array) > 0) {
						foreach($match_array as $match) {
							$database = new Database;
							$database->query("INSERT INTO job_match SET
														matchID = :matchID,
														jobID = :jobID,
														userID = :userID,
														employee_interest = :employee_interest,
														highlight = :highlight,
														contact = :contact,
														message = :message,
														date_responded = :date_responded,
														employer_interest = :employer_interest,
														date_viewed = :date_viewed,
														date_created = :date_created");									
							$database->bind(':matchID', $match['matchID']);									
							$database->bind(':jobID', $match['jobID']);									
							$database->bind(':userID', $match['userID']);									
							$database->bind(':employee_interest', $match['employee_interest']);									
							$database->bind(':highlight', $match['highlight']);									
							$database->bind(':contact', $match['contact']);									
							$database->bind(':message', $match['message']);									
							$database->bind(':date_responded', $match['date_responded']);									
							$database->bind(':employer_interest', $match['employer_interest']);									
							$database->bind(':date_viewed', $match['date_viewed']);									
							$database->bind(':date_created', $match['date_created']);									
							$database->execute();
							
							//REMOVE JOB MATCH FROM ARCHIVE TABLE
							$database = new Database;			
							$database->query("DELETE FROM job_match_archive WHERE matchID = :matchID LIMIT 1 ");
							$database->bind(':matchID', $match['matchID']);									
							$database->execute();
						}
					}	
				}
			}
		}	 
	}
	
	function get_ad_data() {
		$database = new Database;			
		$database->query("SELECT * FROM ad_regions");
		$ad_regions = $database->resultset();

		$database = new Database;			
		$database->query("SELECT * FROM ad_details");
		$ad_details = $database->resultset();	
		
		$ad_data = array("regions" => $ad_regions, "details" => $ad_details);
		return $ad_data;	
	}
	
	function ad_region($region, $zip) {
		$utilities = new Utilities;
		$zip_check = $utilities->zip_validate($zip);
		
		if ($zip_check == "invalid") {
			return "zip";
		} else {
			$database = new Database;
			$database->query("INSERT INTO ad_regions SET
										region_name = :region,
										region_zip = :zip");									
			$database->bind(':region', $region);									
			$database->bind(':zip', $zip);									
			$database->execute();			
		}
	}
	
	function new_ad($region, $ad_title, $ad_link, $photo_link, $description, $ad_type, $deal) {
		//If amazon ad, build link
		if($ad_type == "amazon") {
			$ad_link = "http://local.amazon.com/deals/".$ad_link."?tag=servebartendcook-20";
		}
			
		$database = new Database;
		$database->query("INSERT INTO ad_details SET
									regionID = :region,
									ad_title = :ad_title,
									ad_text = :ad_text,
									ad_link = :ad_link,
									type = :ad_type,
									deal = :deal,
									ad_photo = :ad_photo");									
		$database->bind(':region', $region);									
		$database->bind(':ad_title', $ad_title);									
		$database->bind(':ad_type', $ad_type);									
		$database->bind(':ad_link', $ad_link);									
		$database->bind(':deal', $deal);									
		$database->bind(':ad_text', $description);									
		$database->bind(':ad_photo', $photo_link);									
		$database->execute();			
	}
	
	function remove_ad($adID) {		
		$database = new Database;
		$database->query("DELETE FROM ad_details WHERE
									adID = :adID LIMIT 1");									
		$database->bind(':adID', $adID);									
		$database->execute();			
	}	
	
	function get_employee_job_titles() {
		$database = new Database;			
		$database->query("SELECT * FROM employment_title_template");
		$job_titles = $database->resultset();
		
		$database->query("SELECT * FROM employment_title_skill_reference");
		$job_reference = $database->resultset();		

		$job_title_array = array("job_titles" => $job_titles, "job_reference" => $job_reference);
		return $job_title_array;
	}
	
	
	function new_past_employment_template_title($title, $type) {
		$database = new Database;
		$database->query("INSERT INTO employment_title_template SET
									title = :title,
									type = :type");									
		$database->bind(':title', $title);									
		$database->bind(':type', $type);									
		$database->execute();	
	}
	
	
	function update_past_employment_template_title($titleID, $title, $type, $skill_array) {
		$database = new Database;
		$database->query("UPDATE employment_title_template SET
									title = :title,
									type = :type
									WHERE titleID = :titleID LIMIT 1");									
		$database->bind(':title', $title);									
		$database->bind(':type', $type);									
		$database->bind(':titleID', $titleID);									
		$database->execute();	
		
		//first remove all skills, the add new
		$database->query("DELETE FROM employment_title_skill_reference WHERE titleID = :titleID");									
		$database->bind(':titleID', $titleID);									
		$database->execute();	
		
		foreach($skill_array as $row) {
			$database->query("INSERT INTO employment_title_skill_reference SET
										titleID = :titleID,
										skillID = :skillID");									
			$database->bind(':titleID', $titleID);									
			$database->bind(':skillID', $row);									
			$database->execute();	
		}				
	}
	
	function new_skill_template($skill, $skill_type, $rankable) {
		$database = new Database;
		$database->query("INSERT INTO employment_skill_template SET
									skill = :skill,
									type = :skill_type,
									rankable = :rankable ");									
		$database->bind(':skill', $skill);									
		$database->bind(':skill_type', $skill_type);									
		$database->bind(':rankable', $rankable);									
		$database->execute();	
	}
	
	function get_employee_job_title_data($titleID) {
		$database = new Database;			
		$database->query("SELECT * FROM employment_title_template WHERE titleID = :titleID");
		$database->bind(':titleID', $titleID);									
		$job_title_array = $database->single();

		$database->query("SELECT employment_skill_template.skill, employment_title_skill_reference.skillID FROM employment_title_skill_reference, employment_skill_template, employment_title_template
										WHERE employment_title_skill_reference.titleID = :titleID
										AND employment_title_skill_reference.titleID = employment_title_template.titleID
										AND employment_title_skill_reference.skillID = employment_skill_template.skillID ");
		$database->bind(':titleID', $titleID);									
		$skill_array = $database->resultset();
		
		$job_title_data = array("job_title" => $job_title_array, "skills" => $skill_array);
		
		return $job_title_data;
	}	
	
	function get_employee_skills($type) {
		$database = new Database;			
		$database->query("SELECT * FROM employment_skill_template WHERE type = :type");
		$database->bind(':type', $type);									
		$skill_data = $database->resultset();

		return $skill_data;
	}	
	
	function get_job_template_data() {
		$database = new Database;			
		$database->query("SELECT * FROM template_job");
		$template_jobs = $database->resultset();
		
		$database = new Database;			
		$database->query("SELECT * FROM template_skills");
		$template_skills = $database->resultset();			

		$database = new Database;			
		$database->query("SELECT * FROM template_requirements_index");
		$template_requirements_index = $database->resultset();	

		$database = new Database;			
		$database->query("SELECT * FROM template_question_index");
		$template_question_index = $database->resultset();	
		
		$template_data = array("jobs" => $template_jobs, "skills" => $template_skills, "requirements_index" => $template_requirements_index, "question_index" => $template_question_index);
		return $template_data;			
	}
	
	function get_question_template_data() {
		$database = new Database;			
		$database->query("SELECT * FROM template_questions");
		$template_questions = $database->resultset();
		
		$database = new Database;			
		$database->query("SELECT * FROM template_answers");
		$template_answers = $database->resultset();			
		
		$template_data = array("questions" => $template_questions, "answers" => $template_answers);
		return $template_data;					
	}
	
	function get_requirements_template_data() {
		$database = new Database;			
		$database->query("SELECT * FROM template_requirements");
		$template_requirements = $database->resultset();
		
		return $template_requirements;					
	}
	
	function new_job_template($title, $main_skill, $pay, $schedule, $sub_skills_array, $requirements_array, $questions_array) {		
		$database = new Database;
		$database->query("INSERT INTO template_job SET
									title = :title,
									main_skill = :main_skill,
									schedule = :schedule,
									pay_type = :pay_type");									
		$database->bind(':title', $title);									
		$database->bind(':main_skill', $main_skill);									
		$database->bind(':pay_type', $pay);									
		$database->bind(':schedule', $schedule);									
		$database->execute();	
		$templateID = $database->lastInsertId();	
			
		
		foreach($sub_skills_array as $row) {
			echo "HERE".$row;;
			$database = new Database;
			$database->query("INSERT INTO template_skills SET
										templateID = :templateID,
										sub_skill = :sub_skill");									
			$database->bind(':templateID', $templateID);									
			$database->bind(':sub_skill', $row);									
			$database->execute();	
		}
		
		foreach($requirements_array as $row) {
			$database = new Database;
			$database->query("INSERT INTO template_requirements_index SET
										templateID = :templateID,
										reqID = :reqID");									
			$database->bind(':templateID', $templateID);									
			$database->bind(':reqID', $row);									
			$database->execute();	
		}		

		foreach($questions_array as $row) {
			$database = new Database;
			$database->query("INSERT INTO template_question_index SET
										templateID = :templateID,
										questionID = :questionID");									
			$database->bind(':templateID', $templateID);									
			$database->bind(':questionID', $row);									
			$database->execute();	
		}				
	}
	
	function 	edit_job_template($templateID, $title, $pay, $schedule, $sub_skills_array, $requirements_array, $questions_array) {		
		$database = new Database;
		$database->query("UPDATE template_job SET
									title = :title,
									schedule = :schedule,
									pay_type = :pay_type
									WHERE templateID = :templateID");									
		$database->bind(':title', $title);									
		$database->bind(':pay_type', $pay);									
		$database->bind(':schedule', $schedule);	
		$database->bind(':templateID', $templateID);											
		$database->execute();	

		//Remove skills before rewriting new skills
		$database = new Database;
		$database->query("DELETE FROM template_skills WHERE templateID = :templateID");
		$database->bind(':templateID', $templateID);									
		$database->execute();	
		
		foreach($sub_skills_array as $row) {
			$database = new Database;
			$database->query("INSERT INTO template_skills SET
										templateID = :templateID,
										sub_skill = :sub_skill");									
			$database->bind(':templateID', $templateID);									
			$database->bind(':sub_skill', $row);									
			$database->execute();	
		}

		$database = new Database;
		$database->query("DELETE FROM template_requirements_index WHERE templateID = :templateID");
		$database->bind(':templateID', $templateID);									
		$database->execute();		
		
		foreach($requirements_array as $row) {
		echo $row;
			$database = new Database;
			$database->query("INSERT INTO template_requirements_index SET
										templateID = :templateID,
										reqID = :reqID");									
			$database->bind(':templateID', $templateID);									
			$database->bind(':reqID', $row);									
			$database->execute();	
		}		


		$database = new Database;
		$database->query("DELETE FROM template_question_index WHERE templateID = :templateID");
		$database->bind(':templateID', $templateID);									
		$database->execute();		

		foreach($questions_array as $row) {
			$database = new Database;
			$database->query("INSERT INTO template_question_index SET
										templateID = :templateID,
										questionID = :questionID");									
			$database->bind(':templateID', $templateID);									
			$database->bind(':questionID', $row);									
			$database->execute();	
		}				
	}	
	
	function get_job_template_skills($type) {
		$database = new Database;
		$database->query("SELECT * FROM employment_skill_template
										WHERE type = :type");									
		$database->bind(':type', $type);									
		$result = $database->resultset();	
	
		return $result;
	}
	
	function delete_job_template($templateID) {
		$database = new Database;
		$database->query("DELETE FROM template_job WHERE templateID = :templateID LIMIT 1");									
		$database->bind(':templateID', $templateID);									
		$database->execute();			
	}		
	
	function edit_requirement_template($reqID, $requirement) {
		$database = new Database;
		$database->query("UPDATE template_requirements SET 
									requirement = :requirement
									WHERE reqID = :reqID");									
		$database->bind(':requirement', $requirement);									
		$database->bind(':reqID', $reqID);									
		$database->execute();			
	}
	
	function delete_requirement_template($reqID) {
		$database = new Database;
		$database->query("DELETE FROM template_requirements WHERE reqID = :reqID LIMIT 1");									
		$database->bind(':reqID', $reqID);									
		$database->execute();	
		
		$database = new Database;
		$database->query("DELETE FROM template_requirements_index WHERE reqID = :reqID");									
		$database->bind(':reqID', $reqID);									
		$database->execute();					
	}	
	
	function new_requirement_template($requirement) {
		$database = new Database;
		$database->query("INSERT INTO template_requirements SET 
									requirement = :requirement");									
		$database->bind(':requirement', $requirement);									
		$database->execute();			
	}	

	function edit_question_template($questionID, $question, $answer_array, $type) {
		$database = new Database;
		$database->query("UPDATE template_questions SET
									question = :question,
									type = :type
									WHERE questionID = :questionID");									
		$database->bind(':question', $question);									
		$database->bind(':type', $type);									
		$database->bind(':questionID', $questionID);											
		$database->execute();	

		//Remove answers before rewriting new skills
		$database = new Database;
		$database->query("DELETE FROM template_answers WHERE questionID = :questionID");
		$database->bind(':questionID', $questionID);											
		$database->execute();	
		
		foreach($answer_array as $row) {
			if ($row != "") {
				$database = new Database;
				$database->query("INSERT INTO template_answers SET
											questionID = :questionID,
											answer = :answer");									
				$database->bind(':questionID', $questionID);									
				$database->bind(':answer', $row);									
				$database->execute();	
			}
		}
	}

	function new_question_template($question, $answer_array, $type) {		
		$database = new Database;
		$database->query("INSERT INTO template_questions (question, type) VALUES (:question, :type)");									
		$database->bind(':question', $question);									
		$database->bind(':type', $type);									
		$database->execute();	
		$questionID = $database->lastInsertId();		
		
		foreach($answer_array as $row) {
			$database = new Database;
			$database->query("INSERT INTO template_answers SET
										questionID = :questionID,
										answer = :answer");									
			$database->bind(':questionID', $questionID);									
			$database->bind(':answer', $row);									
			$database->execute();	
		}				
	}
	
	function delete_question_template($questionID) {
		$database = new Database;
		$database->query("DELETE FROM template_questions WHERE questionID = :questionID LIMIT 1");									
		$database->bind(':questionID', $questionID);									
		$database->execute();
		
		$database = new Database;
		$database->query("DELETE FROM template_question_index WHERE questionID = :questionID");									
		$database->bind(':questionID', $questionID);									
		$database->execute();			
					
	}	
	
	function get_employment($type) {
		switch($type) {
			default:
				$database = new Database;
				$database->query("SELECT * FROM previous_employment");									
				$result = $database->resultset();		
			break;
		}
		
		return $result;
	}
	
	function employment_convert($type, $record) {		
		//split string
		$month = "NM";
		$year = "NY";
		$record = strtoupper($record);
		$continue = "yes";
		
		//if it is an end date, check to see if it states currently employed
		if ($type == "end") {
			if (strpos($record, 'CURRENT') !== false) {
				$date = array('month' => "CURRENT", 'year' => "CURRENT");
				$continue = "no";
			} elseif (strpos($record, 'PRESENT') !== false) {
				$date = array('month' => "CURRENT", 'year' => "CURRENT");				
				$continue = "no";
			} elseif (strpos($record, 'STILL') !== false) {
				$date = array('month' => "CURRENT", 'year' => "CURRENT");			
				$continue = "no";
			} elseif (strpos($record, 'EMPLOY') !== false) {
				$date = array('month' => "CURRENT", 'year' => "CURRENT");			
				$continue = "no";
			}
		}
		
		//echo $type;
		
		if ($continue == "yes") {		
		$record_array = explode(". ", $record);
			if (count($record_array) > 1) {
				$month = $record_array[0];
				if (count($record_array) == 2) {
					$year = $record_array[1];
				} elseif (count($record_array) == 3) {
					$year = $record_array[2];
				}
			} else {			
				$record_array = explode(" ", $record);
				if (count($record_array) > 1) {
					$month = $record_array[0];
					if (count($record_array) == 2) {
						$year = $record_array[1];
					} elseif (count($record_array) == 3) {
						$year = $record_array[2];
					}					
				} else {
					$record_array = explode("/", $record);
					if (count($record_array) > 1) {				
						$month = $record_array[0];	
						if (count($record_array) == 2) {
							$year = $record_array[1];
						} elseif (count($record_array) == 3) {
							$year = $record_array[2];
						}										
					} else {
						$record_array = explode("-", $record);
							if (count($record_array) > 1) {				
								$month = $record_array[0];
								if (count($record_array) == 2) {
									$year = $record_array[1];
								} elseif (count($record_array) == 3) {
									$year = $record_array[2];
								}													
						}
					}
				}
			}
			
			if (strpos($month, 'JAN') !== false) {
				$month = 1;
			} elseif (strpos($month, 'FEB') !== false) {
				$month = 2;
			} elseif (strpos($month, 'MAR') !== false) {
				$month = 3;
			} elseif (strpos($month, 'APR') !== false) {
				$month = 4;
			} elseif (strpos($month, 'MAY') !== false) {
				$month = 5;
			} elseif (strpos($month, 'JUN') !== false) {
				$month = 6;
			} elseif (strpos($month, 'JUL') !== false) {
				$month = 7;
			} elseif (strpos($month, 'AUG') !== false) {
				$month = 8;
			} elseif (strpos($month, 'SEP') !== false) {
				$month = 9;
			} elseif (strpos($month, 'OCT') !== false) {
				$month = 10;
			} elseif (strpos($month, 'NOV') !== false) {
				$month = 11;
			} elseif (strpos($month, 'DEC') !== false) {
				$month = 12;
			} elseif ($month == "01" || $month == "1") {
				$month = 1;
			} elseif ($month == "02" || $month == "2") {
				$month = 2;
			} elseif ($month == "03" || $month == "3") {
				$month = 3;
			} elseif ($month == "04" || $month == "4") {
				$month = 4;
			} elseif ($month == "05" || $month == "5") {
				$month = 5;
			} elseif ($month == "06" || $month == "6") {
				$month = 6;
			} elseif ($month == "07" || $month == "7") {
				$month = 7;
			} elseif ($month == "08" || $month == "8") {
				$month = 8;
			} elseif ($month == "09" || $month == "9") {
				$month = 9;
			} elseif ($month == "10") {
				$month = 10;
			} elseif ($month == "11") {
				$month = 11;
			} elseif ($month == "12") {
				$month = 12;
			} else {
				$month = "NM";
			}
			
			if ($year != "NY" && is_numeric($year)) {
				if ($year < 100) {
					if ($year < 20) {
						$year = 2000 + $year;
					} else {
						$year = 1900 + $year;
					}
				}
			} else {
				$year = "NY";
			}
			
			if ($year > 2015 || $year < 1960) {
				$year = "BAD";
			}
			
			$date = array('month' => $month, 'year' => $year);
		}
		//echo "COUNT<br />";
		return $date;
	}	
	
	function get_old_employment_profiles() {
		$database = new Database;
		$database->query("SELECT * FROM previous_employment LIMIT 100");										
		$result = $database->resultset();
		
		$old_array = array();
		foreach($result as $row) {
			if ($row['start_month'] == "" || $row['start_month'] == 0) {
				$old_array[] = $row;
			}
		}
		
		return $old_array;
	}	
	
	function rewrite_employment_dates() {
		//limit the amount of rewrites to 500 to not crash the system
		$database = new Database;
		$database->query("SELECT * FROM previous_employment WHERE admin_test != 'Y' LIMIT 1000");										
		$result = $database->resultset();
		
		$count = 1;

		foreach($result as $row) {
			if ($row['start_month'] == "" || $row['start_month'] == 0) {
				$new_start = $this->employment_convert('start', $row['start_date']);
				$new_end = $this->employment_convert('end', $row['end_date']);

				
				$start_month = $new_start['month'];
				$start_year = $new_start['year'];
				$end_month = $new_end['month'];
				$end_year = $new_end['year'];
				
				//echo $row['end_date']." ".$end_month."<br />";	
								
				if ($end_month == "CURRENT" || $end_year == "CURRENT") {
					//echo  "VAKBJVAJSFO";
					$current = "Y";
					$end_month = 0;
					$end_year = 0;
				} else {
					$current = "";
				}
				
			
				//echo $end_year;
				
				if ($start_month === "NM" || $start_year === "NY" || $start_year === "BAD" || $end_month === "NM" || $end_year === "NY" || $end_year === "BAD") {
					$database = new Database;
					$database->query("UPDATE previous_employment SET
												admin_test = :admin_test
												WHERE ID = :ID");									
					$database->bind(':admin_test', 'Y');	
					$database->bind(':ID', $row['ID']);																										
					$database->execute();						
				} else {
					//write new dates to DB
					
					$database = new Database;
					$database->query("UPDATE previous_employment SET
												start_month = :start_month,
												start_year = :start_year,
												end_month = :end_month,
												end_year = :end_year,
												current = :current,
												admin_test = :admin_test
												WHERE ID = :ID");									
					$database->bind(':start_month', $start_month);									
					$database->bind(':start_year', $start_year);									
					$database->bind(':end_month', $end_month);											
					$database->bind(':end_year', $end_year);											
					$database->bind(':current', $current);											
					$database->bind(':admin_test', 'Y');	
					$database->bind(':ID', $row['ID']);																										
					$database->execute();						
				}
				
			}	
			echo $count."<br />";
			$count++;
		}
		
	}
	
	function get_member_stats($type, $interval, $date) {
		$date_array = $this->get_date_array($date);
		$minus_day = $date_array['minus_day'];
		$minus_week = $date_array['minus_week'];
		$minus_month = $date_array['minus_month'];
		$minus_year = $date_array['minus_year'];		

		switch($type) {
			case "employee":			
				switch($interval) {
					case "day":	
						$new_employees = $this->member_stat_query('employee', 'day', $date);						
						$minus_day_employees = $this->member_stat_query('employee', 'day', $minus_day);						
						$minus_week_employees = $this->member_stat_query('employee', 'day', $minus_week);						
						$minus_month_employees = $this->member_stat_query('employee', 'day', $minus_month);						
						$minus_year_employees = $this->member_stat_query('employee', 'day', $minus_year);						

						$employee_array = array("new" => $new_employees, "day" => $minus_day_employees, "week" => $minus_week_employees, "month" => $minus_month_employees, "year" => $minus_year_employees);																											
						//echo var_dump($employee_array);
						return $employee_array;
					break;
					
					case "week":
						$new_employees = $this->member_stat_query('employee', 'week', $date);						
						$minus_week_employees = $this->member_stat_query('employee', 'week', $minus_week);						
						$minus_month_employees = $this->member_stat_query('employee', 'week', $minus_month);						
						$minus_year_employees = $this->member_stat_query('employee', 'week', $minus_year);						
						
						$employee_array = array("new" => $new_employees, "week" => $minus_week_employees, "month" => $minus_month_employees, "year" => $minus_year_employees);																																
						return $employee_array;
					break;
					
					case "month":
						$new_employees = $this->member_stat_query('employee', 'month', $date);						
						$minus_month_employees = $this->member_stat_query('employee', 'month', $minus_month);						
						$minus_year_employees = $this->member_stat_query('employee', 'month', $minus_year);						

						$employee_array = array("new" => $new_employees, "month" => $minus_month_employees, "year" => $minus_year_employees);																																
						return $employee_array;
					break;					
				}
			break;
			
			case "employer":
				switch($interval) {
					case "day":
						$new_employers = $this->member_stat_query('employer', 'day', $date);						
						$minus_day_employers = $this->member_stat_query('employer', 'day', $minus_day);						
						$minus_week_employers = $this->member_stat_query('employer', 'day', $minus_week);						
						$minus_month_employers = $this->member_stat_query('employer', 'day', $minus_month);						
						$minus_year_employers = $this->member_stat_query('employer', 'day', $minus_year);						

						$employer_array = array("new" => $new_employers, "day" => $minus_day_employers, "week" => $minus_week_employers, "month" => $minus_month_employers, "year" => $minus_year_employers);																											
						return $employer_array;
					break;
					
					case "week":
						$new_employers = $this->member_stat_query('employer', 'week', $date);						
						$minus_week_employers = $this->member_stat_query('employer', 'week', $minus_week);						
						$minus_month_employers = $this->member_stat_query('employer', 'week', $minus_month);						
						$minus_year_employers = $this->member_stat_query('employer', 'week', $minus_year);						

						$employer_array = array("new" => $new_employers, "week" => $minus_week_employers, "month" => $minus_month_employers, "year" => $minus_year_employers);																																
						return $employer_array;
					break;
					
					case "month":
						$new_employers = $this->member_stat_query('employer', 'month', $date);						
						$minus_month_employers = $this->member_stat_query('employer', 'month', $minus_month);						
						$minus_year_employers = $this->member_stat_query('employer', 'month', $minus_year);						

						$employer_array = array("new" => $new_employers, "month" => $minus_month_employers, "year" => $minus_year_employers);																																
						return $employer_array;
					break;					
				}			
			break;
			
			case "jobs":
				switch($interval) {
					case "day":						
						$new_jobs = $this->member_stat_query('jobs', 'day', $date);						
						$minus_day_jobs = $this->member_stat_query('jobs', 'day', $minus_day);						
						$minus_week_jobs = $this->member_stat_query('jobs', 'day', $minus_week);						
						$minus_month_jobs = $this->member_stat_query('jobs', 'day', $minus_month);						
						$minus_year_jobs = $this->member_stat_query('jobs', 'day', $minus_year);						

						$jobs_array = array("new" => $new_jobs, "day" => $minus_day_jobs, "week" => $minus_week_jobs, "month" => $minus_month_jobs, "year" => $minus_year_jobs);																											
						return $jobs_array;
					break;
					
					case "week":
						$new_jobs = $this->member_stat_query('jobs', 'week', $date);						
						$minus_week_jobs = $this->member_stat_query('jobs', 'week', $minus_week);						
						$minus_month_jobs = $this->member_stat_query('jobs', 'week', $minus_month);						
						$minus_year_jobs = $this->member_stat_query('jobs', 'week', $minus_year);						

						$jobs_array = array("new" => $new_jobs, "week" => $minus_week_jobs, "month" => $minus_month_jobs, "year" => $minus_year_jobs);																																

						return $jobs_array;
					break;
					
					case "month":
						$new_jobs = $this->member_stat_query('jobs', 'month', $date);						
						$minus_month_jobs = $this->member_stat_query('jobs', 'month', $minus_month);						
						$minus_year_jobs = $this->member_stat_query('jobs', 'month', $minus_year);						

						$jobs_array = array("new" => $new_jobs, "month" => $minus_month_jobs, "year" => $minus_year_jobs);																																
						return $jobs_array;
					break;					
				}			
			break;

			case "logins":
				switch($interval) {
					case "day":						
						$new_logins = $this->member_stat_query('logins', 'day', $date);						
						$minus_day_logins = $this->member_stat_query('logins', 'day', $minus_day);						
						$minus_week_logins = $this->member_stat_query('logins', 'day', $minus_week);						
						$minus_month_logins = $this->member_stat_query('logins', 'day', $minus_month);						
						$minus_year_logins = $this->member_stat_query('logins', 'day', $minus_year);						

						$logins_array = array("new" => $new_logins, "day" => $minus_day_logins, "week" => $minus_week_logins, "month" => $minus_month_logins, "year" => $minus_year_logins);																											
						return $logins_array;
					break;
					
					case "week":
						$new_logins = $this->member_stat_query('logins', 'week', $date);						
						$minus_week_logins = $this->member_stat_query('logins', 'week', $minus_week);						
						$minus_month_logins = $this->member_stat_query('logins', 'week', $minus_month);						
						$minus_year_logins = $this->member_stat_query('logins', 'week', $minus_year);						

						$logins_array = array("new" => $new_logins, "week" => $minus_week_logins, "month" => $minus_month_logins, "year" => $minus_year_logins);																																
						return $logins_array;
					break;
					
					case "month":
						$new_logins = $this->member_stat_query('logins', 'month', $date);						
						$minus_month_logins = $this->member_stat_query('logins', 'month', $minus_month);						
						$minus_year_logins = $this->member_stat_query('logins', 'month', $minus_year);						

						$logins_array = array("new" => $new_logins, "month" => $minus_month_logins, "year" => $minus_year_logins);																																
						return $logins_array;
					break;					
				}			
			break;			
		}
		
	}
	
	function percent_change($new, $old) {
		if ($old > 0) {
			$change = ($new - $old) / $old;
			$percentage = $change * 100;
			$percentage = round($percentage, 2);
		} else {
			$percentage = "NA";
		}
		return $percentage;
	}
	
	function non_verified_test($member_array) {
		$count = 0;
		if (count($member_array) > 0) {
			foreach($member_array as $row) {
				if ($row['email_validation'] != 'Y') {
					$count++;
				}
			}
		}
		return $count;
	}
	
	function incomplete_test($type, $member_array) {
		$complete = 0;
		$one = 0;
		$two = 0;
		$three = 0;
		$four = 0;

		if (count($member_array) > 0) {		
			foreach($member_array as $row) {
				if ($row['email_validation'] == 'Y') {
					switch($row['profile_status']) {
						case "complete":
							$complete++;
						break;
						
						case "1":
							$one++;
						break;
						
						case "2":
							$two++;
						break;
						
						case "3":
							$three++;
						break;
	
						case "4":
							$four++;
						break;					
					}
				}
			}
		}
		$total_incomplete = $one + $two + $three + $four;
		$status_array = array("incomplete" => $total_incomplete, "complete" => $complete, "one" => $one, "two" => $two, "three" => $three, "four" => $four);
		
		if ($type == "incomplete") {
			return $total_incomplete;
		} else {
			return $status_array;
		}
	}
	
	function runaway_test($member_array) {
		$count = 0;
		if (count($member_array) > 0) {		
			foreach($member_array as $row) {
				if ($row['email_validation'] == 'Y') {
					if (isset($row['current_login']) && $row['current_login'] > 0) {
						//do nothing
					} else {
						$count++;
					}
				}
			}
		}
		return $count;
	}
	
	
	function member_stat_query($type, $interval, $date) {
		switch($type) {
			case "employee":
				switch($interval) {
					case "day":
						$database = new Database;
						$database->query("SELECT userID, profile_status, email_validation, current_login, zip
													FROM members
													WHERE type = :type
													AND creation_date BETWEEN :date AND DATE_ADD(:date, INTERVAL 1 DAY) ");
						$database->bind(':date', $date);									
						$database->bind(':type', 'employee');									
						$employees = $database->resultset();
						return $employees;																											
					break;
					
					case "week":
						$database = new Database;
						$database->query("SELECT userID, profile_status, email_validation, current_login, zip
													FROM members
													WHERE type = :type
													AND creation_date BETWEEN :date AND DATE_ADD(:date, INTERVAL 7 DAY) ");
						$database->bind(':date', $date);									
						$database->bind(':type', 'employee');									
						$employees = $database->resultset();
						return $employees;																											
					break;

					case "month":
						$database = new Database;
						$database->query("SELECT userID, profile_status, email_validation, current_login, zip
													FROM members
													WHERE type = :type
													AND creation_date BETWEEN :date AND DATE_ADD(:date, INTERVAL 1 MONTH) ");
						$database->bind(':date', $date);									
						$database->bind(':type', 'employee');									
						$employees = $database->resultset();
						return $employees;																											
					break;
					
					case "year":
						$database = new Database;
						$database->query("SELECT userID, profile_status, email_validation, current_login, zip
													FROM members
													WHERE type = :type
													AND creation_date BETWEEN :date AND DATE_ADD(:date, INTERVAL 365 DAY) ");
						$database->bind(':date', $date);									
						$database->bind(':type', 'employee');									
						$employees = $database->resultset();
						return $employees;																											
					break;															
				}
			break;
			
			case "employer":
				switch($interval) {
					case "day":
						$database = new Database;
						$database->query("SELECT userID, profile_status, email_validation, current_login
													FROM members
													WHERE type = :type
													AND creation_date BETWEEN :date AND DATE_ADD(:date, INTERVAL 1 DAY) ");
						$database->bind(':date', $date);									
						$database->bind(':type', 'employer');									
						$employers = $database->resultset();
						return $employers;																											
					break;
					
					case "week":
						$database = new Database;
						$database->query("SELECT userID, profile_status, email_validation, current_login
													FROM members
													WHERE type = :type
													AND creation_date BETWEEN :date AND DATE_ADD(:date, INTERVAL 7 DAY) ");
						$database->bind(':date', $date);									
						$database->bind(':type', 'employer');									
						$employers = $database->resultset();
						return $employers;																											
					break;

					case "month":
						$database = new Database;
						$database->query("SELECT userID, profile_status, email_validation, current_login
													FROM members
													WHERE type = :type
													AND creation_date BETWEEN :date AND DATE_ADD(:date, INTERVAL 1 MONTH) ");
						$database->bind(':date', $date);									
						$database->bind(':type', 'employer');									
						$employers = $database->resultset();
						return $employers;																											
					break;	
					
					case "year":
						$database = new Database;
						$database->query("SELECT userID, profile_status, email_validation, current_login
													FROM members
													WHERE type = :type
													AND creation_date BETWEEN :date AND DATE_ADD(:date, INTERVAL 365 DAY) ");
						$database->bind(':date', $date);									
						$database->bind(':type', 'employer');									
						$employers = $database->resultset();
						return $employers;																											
					break;														
				}
			break;
			
			case "jobs":
				switch($interval) {
					case "day":
						$database = new Database;
						$database->query("SELECT jobs.title, stores.name, stores.zip, jobs.jobID
													FROM jobs, stores
													WHERE jobs.storeID = stores.storeID
													AND (jobs.job_status = :open OR jobs.job_status = :filled)
													AND jobs.date_created BETWEEN :date AND DATE_ADD(:date, INTERVAL 1 DAY) ");									
						$database->bind(':date', $date);									
						$database->bind(':open', 'Open');									
						$database->bind(':filled', 'Filled');									
						$jobs = $database->resultset();
						return $jobs;																											
					break;
					
					case "week":
						$database = new Database;
						$database->query("SELECT jobs.title, stores.name, stores.zip, jobs.jobID
													FROM jobs, stores
													WHERE jobs.storeID = stores.storeID
													AND (jobs.job_status = :open OR jobs.job_status = :filled)
													AND jobs.date_created BETWEEN :date AND DATE_ADD(:date, INTERVAL 7 DAY) ");									
						$database->bind(':date', $date);									
						$database->bind(':open', 'Open');									
						$database->bind(':filled', 'Filled');									
						$jobs = $database->resultset();
						return $jobs;																											
					break;

					case "month":
						$database = new Database;
						$database->query("SELECT jobs.title, stores.name, stores.zip, jobs.jobID
													FROM jobs, stores
													WHERE jobs.storeID = stores.storeID
													AND (jobs.job_status = :open OR jobs.job_status = :filled)
													AND jobs.date_created BETWEEN :date AND DATE_ADD(:date, INTERVAL 1 MONTH) ");									
						$database->bind(':date', $date);									
						$database->bind(':open', 'Open');									
						$database->bind(':filled', 'Filled');									
						$jobs = $database->resultset();
						return $jobs;																											
					break;
					
					case "year":
						$database = new Database;
						$database->query("SELECT jobs.title, stores.name, stores.zip, jobs.jobID
													FROM jobs, stores
													WHERE jobs.storeID = stores.storeID
													AND (jobs.job_status = :open OR jobs.job_status = :filled)
													AND jobs.date_created BETWEEN :date AND DATE_ADD(:date, INTERVAL 365 DAY) ");									
						$database->bind(':date', $date);									
						$database->bind(':open', 'Open');									
						$database->bind(':filled', 'Filled');									
						$jobs = $database->resultset();
						return $jobs;																											
					break;															
				}
			break;			

			case "logins":
				switch($interval) {
					case "day":
						$database = new Database;
						$database->query("SELECT userID
													FROM login_track
													WHERE login_date BETWEEN :date AND DATE_ADD(:date, INTERVAL 1 DAY) ");									
						$database->bind(':date', $date);									
						$logins = $database->resultset();
						return $logins;																											
					break;
					
					case "week":
						$database = new Database;
						$database->query("SELECT userID
													FROM login_track
													WHERE login_date BETWEEN :date AND DATE_ADD(:date, INTERVAL 7 DAY) ");									
						$database->bind(':date', $date);									
						$logins = $database->resultset();
						return $logins;																											
					break;

					case "month":
						$database = new Database;
						$database->query("SELECT userID
													FROM login_track
													WHERE login_date BETWEEN :date AND DATE_ADD(:date, INTERVAL 1 MONTH) ");									
						$database->bind(':date', $date);									
						$logins = $database->resultset();
						return $logins;																											
					break;
					
					case "year":
						$database = new Database;
						$database->query("SELECT userID
													FROM login_track
													WHERE login_date BETWEEN :date AND DATE_ADD(:date, INTERVAL 365 DAY) ");									
						$database->bind(':date', $date);									
						$logins = $database->resultset();
						return $logins;																											
					break;															
				}
			break;							
		}
	}
	
	function get_signup_ref($employee_array, $employer_array) {
		//first get limits of member ID's
		
		if (count($employee_array) > 0) {
			$i=0;
			foreach($employee_array as $row)  {
			   $employee[$i] = $row['userID'];
			   $i++;
			}
		} else {
			$employee = NULL;
		}
		
		if (count($employee) > 1) {
			$max_employee = max($employee);
			$min_employee = min($employee);
		} elseif (count($employee) == 1){
			$max_employee = $employee[0];
			$min_employee = $employee[0];			
		} elseif (count($employee) == 0) {
			$max_employee = "NA";
			$min_employee = "NA";						
		}

		if (count($employer_array) > 0) {
			$n=0;
			foreach($employer_array as $row)  {
			   $employer[$n] = $row['userID'];
			   $n++;
			}
		} else {
			$employer = NULL;
		}
		if (count($employer) > 1) {
			$max_employer = max($employer);
			$min_employer = min($employer);
		} elseif (count($employer) == 1){
			$max_employer = $employer[0];
			$min_employer = $employer[0];			
		} elseif (count($employer) == 0) {
			$max_employer = "NA";
			$min_employer = "NA";						
		}
		
		if ($max_employer == "NA") {
			$max_userID = $max_employee;
		} elseif ($max_employee == "NA") {
			$max_userID = $max_employer;			
		} elseif ($max_employer > $max_employee) {
			$max_userID = $max_employer;
		} else {
			$max_userID = $max_employee;
		}

		if ($min_employer == "NA") {
			$min_userID = $min_employee;
		} elseif ($min_employee == "NA") {
			$min_userID = $min_employer;								
		} elseif ($min_employer < $min_employee) {
			$min_userID = $min_employer;
		} else {
			$min_userID = $min_employee;
		}
		
		if ($min_userID != "NA" && $max_userID != "NA") {

			$database = new Database;
			$database->query("SELECT * FROM signup_ref
										WHERE userID BETWEEN :min AND :max");									
			$database->bind(':min', $min_userID);									
			$database->bind(':max', $max_userID);									
			$result = $database->resultset();	

			if (count($result) > 0) {
				//seperate out distinct values
				//flatten arrays
				$refID_array = array_unique($this->flatten_array($result, 'refID'));	
											
				$cmp_array = array_unique($this->flatten_array($result, 'CMP'));
				$rgn_array = array_unique($this->flatten_array($result, 'RGN'));								
				$ste_array = array_unique($this->flatten_array($result, 'STE'));								
				$dmg_array = array_unique($this->flatten_array($result, 'DMG'));								
				$ad_array = array_unique($this->flatten_array($result, 'AD'));								
				$msca_array = array_unique($this->flatten_array($result, 'MSCA'));								
				$mscb_array = array_unique($this->flatten_array($result, 'MSCB'));	
							
				$ref_array = array("ref_array" => $result,
												"refID" => $refID_array,
												"CMP" => $cmp_array,
												"RGN" => $rgn_array,
												"STE" => $ste_array,
												"DMG" => $dmg_array,
												"AD" => $ad_array,
												"MSCA" => $msca_array,
												"MSCB" => $mscb_array);										
			} else {
				$ref_array = "NA";
			}	
			return $ref_array;
		} else {
			return "NA";
		}
	}
	
	function get_employee_types($employee_array) {
		$employee_types = array();

		foreach ($employee_array as $key=>$employee_list) {
			//set counts
			$manager = $server = $bartender = $kitchen = $host = $bus = 0;

			if(count($employee_list) > 0) {		
				foreach ($employee_list as $row) {
					$userID = $row['userID'];
					//query user skills
					$database = new Database;
					$database->query("SELECT * FROM skills
												WHERE userID = :userID
												AND seeking = :seeking");									
					$database->bind(':userID', $userID);									
					$database->bind(':seeking', 'Y');									
					$result = $database->resultset();	
					
					foreach($result as $skill) {
						switch($skill['skill']) {
							case "Manager":
								$manager++;
							break;
							
							case "Server":
								$server++;
							break;
	
							case "Bartender":
								$bartender++;
							break;
	
							case "Kitchen":
								$kitchen++;
							break;
	
							case "Host":
								$host++;
							break;
	
							case "Bus":
								$bus++;
							break;
						}
					}			
				}
			}
			$employee_types[$key] = array("Manager" => $manager,
																"Server" => $server,
																"Bartender" => $bartender,
																"Kitchen" => $kitchen,
																"Host" => $host,
																"Bus" => $bus);
		}
		return $employee_types;
	}
	
	function get_job_types($job_array, $interval, $date) {
		$date_array = $this->get_date_array($date);
	
		switch($interval) {
			case "day":
				$statement = "INTERVAL 1 DAY";
			break;

			case "week":
				$statement = "INTERVAL 7 DAY";
			break;

			case "month":
				$statement = "INTERVAL 1 MONTH";
			break;

			case "year":
				$statement = "INTERVAL 365 DAY";
			break;
		}

		$job_types = array();

		foreach ($job_array as $key=>$job_list) {
			//determine date to use
			switch($key) {
				case "new":
					$query_date = $date;
				break;
				
				case "day":
					$query_date = $date_array['minus_day'];
				break;	
				
				case "week":
					$query_date = $date_array['minus_week'];
				break;				

				case "month":
					$query_date = $date_array['minus_month'];
				break;		
				
				case "year":
					$query_date = $date_array['minus_year'];
				break;																	
			}

			//set counts
			$manager['count'] = $server['count'] = $bartender['count'] = $kitchen['count'] = $host['count'] = $bus['count'] = 0;
			$manager['views'] = $server['views'] = $bartender['views'] = $kitchen['views'] = $host['views'] = $bus['views'] = 0;
			$manager['responses'] = $server['responses'] = $bartender['responses'] = $kitchen['responses'] = $host['responses'] = $bus['responses'] = 0;
			$job_responses = 0;
			$job_views = 0;
			
			if (count($job_list) > 0) {			
				foreach ($job_list as $row) {
					$jobID = $row['jobID'];
					//query job skills
					$database = new Database;
					$database->query("SELECT jobs_specialties.specialty FROM jobs_specialties, jobs
												WHERE jobs.jobID = :jobID
												AND jobs_specialties.jobID = jobs.jobID
												AND jobs.job_status = :status");									
					$database->bind(':jobID', $jobID);									
					$database->bind(':status', 'Open');									
					$result = $database->resultset();	
					
					//get job views
					$database = new Database;
					$database->query("SELECT viewID FROM job_views
												WHERE jobID = :jobID
												AND (type = :qualified OR type = :unqualified)
												AND date BETWEEN :date AND DATE_ADD(:date, $statement) ");									
					$database->bind(':jobID', $jobID);									
					$database->bind(':date', $query_date);									
					$database->bind(':qualified', 'qualified');									
					$database->bind(':unqualified', 'unqualified');									
					$job_views = $database->resultset();	
					$view_count = count($job_views);
					
					
					//get job responses
					$database = new Database;
					$database->query("SELECT matchID FROM job_match_archive
												WHERE jobID = :jobID
												AND date_responded BETWEEN :date AND DATE_ADD(:date, $statement) ");									
					$database->bind(':jobID', $jobID);									
					$database->bind(':date', $query_date);									
					$job_responses = $database->resultset();	
					$response_count = count($job_responses);
	
					foreach($result as $specialty) {
						switch($specialty['specialty']) {
							case "Manager":
								$manager['count']++;
								$manager['views'] = $manager['views'] + $view_count;
								$manager['responses'] = $manager['responses'] + $response_count;
							break;
							
							case "Server":
								$server['count']++;
								$server['views'] = $server['views'] + $view_count;
								$server['responses'] = $server['responses'] + $response_count;
							break;
	
							case "Bartender":
								$bartender['count']++;
								$bartender['views'] = $bartender['views'] + $view_count;
								$bartender['responses'] = $bartender['responses'] + $response_count;
							break;
	
							case "Kitchen":
								$kitchen['count']++;
								$kitchen['views'] = $kitchen['views'] + $view_count;
								$kitchen['responses'] = $kitchen['responses'] + $response_count;
							break;
	
							case "Host":
								$host['count']++;
								$host['views'] = $host['views'] + $view_count;
								$host['responses'] = $host['responses'] + $response_count;
							break;
	
							case "Bus":
								$bus['count']++;
								$bus['views'] = $bus['views'] + $view_count;
								$bus['responses'] = $bus['responses'] + $response_count;
							break;
						}
					}			
						
					//avg view & responses
					$manager['average'] = $this->get_averages($manager['count'], $manager['views'], $manager['responses']);
					$server['average'] = $this->get_averages($server['count'], $server['views'], $server['responses']);
					$bartender['average'] = $this->get_averages($bartender['count'], $bartender['views'], $bartender['responses']);
					$kitchen['average'] = $this->get_averages($kitchen['count'], $kitchen['views'], $kitchen['responses']);
					$host['average'] = $this->get_averages($host['count'], $host['views'], $host['responses']);
					$bus['average'] = $this->get_averages($bus['count'], $bus['views'], $bus['responses']);				
				}
			}		
			
			$job_types[$key] = array("Manager" => $manager,
																"Server" => $server,
																"Bartender" => $bartender,
																"Kitchen" => $kitchen,
																"Host" => $host,
																"Bus" => $bus);
		}
		return $job_types;
	}
	
	function get_averages($count, $views, $responses) {
		if ($views > 0 && $count > 0) {
			$average_views = round($views/$count, 2);
		} else {
			$average_views = 0;
		}

		if ($responses > 0 && $count > 0) {
			$average_responses = round($responses/$count, 2);
		} else {
			$average_responses = 0;
		}		
		
		$average = array('avg_views' => $average_views, 'avg_responses' =>$average_responses);
		return $average;
	}
	
	function get_date_array($date) {
		$date_object = new DateTime($date);
		$date_object->sub(new DateInterval('P1D'));
		$minus_day =  $date_object->format('Y-m-d H:i:s');
		
		$date_object = new DateTime($date);
		$date_object->sub(new DateInterval('P7D'));
		$minus_week =  $date_object->format('Y-m-d H:i:s');					

		$date_object = new DateTime($date);
		$date_object->sub(new DateInterval('P1M'));
		$minus_month =  $date_object->format('Y-m-d H:i:s');	

		$date_object = new DateTime($date);
		$date_object->sub(new DateInterval('P365D'));
		$minus_year =  $date_object->format('Y-m-d H:i:s');	
		
		$date_array = array("minus_day" => $minus_day, "minus_week" => $minus_week, "minus_month" => $minus_month, "minus_year" => $minus_year);
		return $date_array;
	}
	
	function flatten_array($array, $key) {
		$i=0;
		foreach($array as $row)  {
			$new[$i]=$row[$key];
			$i++;
		}	
		return $new;
	}
	
	function get_site_totals($region) {
		$utilities = new Utilities;

		if ($region == "all") {
			$member_count = $this->get_admin("member_count");	
			$employee_count = $member_count[1];
			$employer_count = $member_count[2];
			$total = $member_count[0];

			//get number of unverified accounts
			$database = new Database;
										
			$database->query("SELECT userID FROM members WHERE email_validation = 'Y' ");							
			$email_verification_array = $database->resultset();	
			$non_verified_count = $total - count($email_verification_array);

			$database->query("SELECT userID FROM members WHERE profile_status = 'complete' ");							
			$complete_array = $database->resultset();	
			$incomplete_count = $total - count($complete_array);
			
			$database->query("SELECT storeID FROM stores ");							
			$store_array = $database->resultset();	
			$store_count = count($store_array);
			
			
			$site_counts = array("total" => $total, "employee" => $employee_count, "employer" => $employer_count, "store" => $store_count, "non_verified" => $non_verified_count, "incomplete" => $incomplete_count);
			return $site_counts;
			
		} else {
			switch($region) {
				case "orlando":
					$coordinates_city = $utilities->get_coordinates('32801');			
				break;
				
				case "tampa":
					$coordinates_city = $utilities->get_coordinates('33602');			
				break;

				case "jacksonville":
					$coordinates_city = $utilities->get_coordinates('32206');			
				break;

				case "miami":
					$coordinates_city = $utilities->get_coordinates('33166');			
				break;
				
				case "charlotte":
					$coordinates_city = $utilities->get_coordinates('28204');			
				break;			

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
			}
			
								
			$longitude_city = $coordinates_city['longitude'];
			$latitude_city= $coordinates_city['latitude'];
			
			//40 mile appoximation, square
			$max_lat = $latitude_city + 0.57971;
			$min_lat = $latitude_city - 0.57971;
			$max_long = $longitude_city + 0.57827;
			$min_long = $longitude_city - 0.57827;
			
			$database = new Database;
										
			$database->query("SELECT members.userID, members.email_validation, members.profile_status, members.type
											FROM members, zcta 
											WHERE members.zip = zcta.zip
											AND members.type = :type
											AND zcta.latitude BETWEEN :min_lat AND :max_lat
											AND zcta.longitude BETWEEN :min_long AND :max_long ");										
			$database->bind(':type', 'employee');
			$database->bind(':min_lat', $min_lat);
			$database->bind(':max_lat', $max_lat);
			$database->bind(':min_long', $min_long);
			$database->bind(':max_long', $max_long);
			$member_array = $database->resultset();
			
			$database->query("SELECT stores.storeID
											FROM stores, zcta 
											WHERE stores.zip = zcta.zip
											AND zcta.latitude BETWEEN :min_lat AND :max_lat
											AND zcta.longitude BETWEEN :min_long AND :max_long ");										
			$database->bind(':min_lat', $min_lat);
			$database->bind(':max_lat', $max_lat);
			$database->bind(':min_long', $min_long);
			$database->bind(':max_long', $max_long);
			$store_array = $database->resultset();			
			
			//member counts
			$employee_count = count($member_array);
			$store_count = count($store_array);
			$profile_complete_count = 0;
			$email_verification_count = 0;
			//echo var_dump($member_array);
			foreach($member_array as $row) {		
				if ($row['email_validation'] == 'Y') {
					$email_verification_count++;
				}
				
				if ($row['profile_status'] == 'complete') {
					$profile_complete_count++;
				}
			}	
			
			$non_verified_count = $employee_count - $email_verification_count;
			$incomplete_count = $employee_count  - $profile_complete_count;
			
			$site_counts = array("total" => $employee_count, "employee" => $employee_count, "employer" => "NA", "store" => $store_count, "non_verified" => $non_verified_count, "incomplete" => $incomplete_count);
			return $site_counts;		
		}
	}
	
	
	function employees_by_region($employee_array, $city) {
		$reduced_array = array();
		foreach($employee_array as $key=>$employee_set) {
			$count = 0;
			foreach($employee_set as $row) {
				$test = $this->zip_code_test($city, $row['zip']);
				if ($test == "Y") {
					$reduced_array[$key][] = $row;
					$count++;
				}
			}
			
			if ($count == 0) {
				$reduced_array[$key] = NULL;
			}
		}

		return $reduced_array;
	}
	
	function employers_by_region($employer_array, $city) {
		$reduced_array = array();
		
		foreach($employer_array as $key=>$employer_set) {
			$count = 0;
			
			foreach($employer_set as $row) {
				$database = new Database;
				//get stores
				$database->query("SELECT * FROM stores WHERE userID = :userID");									
				$database->bind(':userID', $row['userID']);									
				$store_array = $database->resultset();	
				$store_count = 0;
				foreach($store_array as $store) {
					$test = $this->zip_code_test($city, $store['zip']);
					if ($test == "Y") {
						if ($store_count == 0) {
							$reduced_array[$key][] = $row;
							$store_count++;
						}
						$count++;
					}
				}
			}
			if ($count == 0) {
				$reduced_array[$key] = NULL;
			}
		}
		return $reduced_array;
	}
	
	function get_stores_by_region($zip) {
		
		$stores_array = array();
		
		if (is_numeric($zip)) {			
			$database = new Database;
			$database->query("SELECT stores.storeID, stores.name, stores.address, members.email, members.firstname, members.lastname
										FROM stores, members
										WHERE stores.zip = :zip
										AND stores.userID = members.userID");																									
			$database->bind(':zip', $zip);									
			$store_array = $database->resultset();	
		}
		
		return $store_array;
	}

	function jobs_by_region($jobs_array, $city) {
		$reduced_array = array();
		foreach($jobs_array as $key=>$job_set) {
			$count = 0;
			foreach($job_set as $row) {
				$test = $this->zip_code_test($city, $row['zip']);
				if ($test == "Y") {
					$reduced_array[$key][] = $row;
					$count++;
				}
			}
			
			if ($count == 0) {
				$reduced_array[$key] = NULL;
			}
		}

		return $reduced_array;
	}

	function logins_by_region($logins_array, $city) {
		$reduced_array = array();
		
		foreach($logins_array as $key=>$logins_set) {
			$count = 0;
			
			foreach($logins_set as $row) {
				$database = new Database;
				$database->query("SELECT zip FROM members WHERE userID = :userID");									
				$database->bind(':userID', $row['userID']);									
				$user_array = $database->resultset();	
				foreach($user_array as $user) {
					$test = $this->zip_code_test($city, $user['zip']);
					if ($test == "Y") {
						$reduced_array[$key][] = $row;
						$count++;
					}
				}
			}
			
			if ($count == 0) {
				$reduced_array[$key] = NULL;
			}
		}

		return $reduced_array;
	}
	
	
	function zip_code_test($city, $zip) {
		$utilities = new Utilities;
		switch($city) {
			case "orlando":
				$coordinates_city = $utilities->get_coordinates('32801');			
			break;
			
			case "tampa":
				$coordinates_city = $utilities->get_coordinates('33602');			
			break;
			
			case "jacksonville":
				$coordinates_city = $utilities->get_coordinates('32206');			
			break;

			case "miami":
				$coordinates_city = $utilities->get_coordinates('33166');			
			break;
			
			case "triangle":
				$coordinates_city = $utilities->get_coordinates('27587');			
			break;					
			
			case "charlotte":
				$coordinates_city = $utilities->get_coordinates('28204');			
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
		}
		
							
		$longitude_city = $coordinates_city['longitude'];
		$latitude_city= $coordinates_city['latitude'];
		
		//40 mile appoximation, square
		$max_lat = $latitude_city + 0.57971;
		$min_lat = $latitude_city - 0.57971;
		$max_long = $longitude_city + 0.57827;
		$min_long = $longitude_city - 0.57827;
		
		//get query coordinates
		$coordinates_query = $utilities->get_coordinates($zip);			
		
		$longitude_query = $coordinates_query['longitude'];
		$latitude_query= $coordinates_query['latitude'];
		
		//test parameters
		if ($longitude_query >= $min_long && $longitude_query <= $max_long && $latitude_query >= $min_lat && $latitude_query <= $max_lat) {
			$test = "Y";
		} else {
			$test = "N";
		}
		
		return $test;
	}
	
/*
	function get_job_views($region) {
		//get job data with views for the last 30 days
		$database = new Database;

		$database->query("SELECT * FROM jobs, stores 
									WHERE job_status = :job_status
									AND date_created BETWEEN NOW() - INTERVAL 30 DAY AND NOW()");									
		$database->bind(':job_status', 'Open');									
		$job_array = $database->resultset();	
		
		$job_data = array();
		
		foreach($job_array as $key=>$row) {
			
		}
		
	}
*/
	
	function get_pavement_lists() {
		$database = new Database;
		$database->query("SELECT * FROM pavement_list WHERE open = :open");									
		$database->bind(':open', 'Y');									
		$list_array = $database->resultset();	
		
		return $list_array;
	}
	
	function get_pavement_list_details($regionID) {
		$database = new Database;
		$database->query("SELECT * FROM pavement_list WHERE regionID = :regionID");									
		$database->bind(':regionID', $regionID);									
		$list_name = $database->single();	
		
		
		$database = new Database;
		$database->query("SELECT * FROM pavement_stores WHERE regionID = :regionID");									
		$database->bind(':regionID', $regionID);									
		$list_array = $database->resultset();	
		
		$list_details = array("city" => $list_name['city'], "region" => $list_name['region'], "list_array" => $list_array);
		
		if ($list_name == false) {
			return "NA";
		} else {
			return $list_details;
		}
	}
	
	function get_pavement_store_details($storeID) {
		$database = new Database;
		$database->query("SELECT * FROM pavement_stores WHERE storeID = :storeID");									
		$database->bind(':storeID', $storeID);									
		$store_details = $database->single();	
		
		return $store_details;
	}	
	
	function remove_job($jobID) {
		$database = new Database;
		$database->query("UPDATE jobs SET job_status = :job_status WHERE jobID = :jobID LIMIT 1");			
		$database->bind(':job_status', 'Removed');					
		$database->bind(':jobID', $jobID);					
		$database->execute();
		
		//change any items in email queue for this job to sent, to stop emails from continuing
		$database = new Database;
		$database->query("UPDATE email_queue_match SET date_sent = NOW() 
										WHERE jobID = :jobID
										AND date_sent IS NULL");			
		$database->bind(':jobID', $jobID);					
		$database->execute();
		
	}	
	
	
	//BOUNTY SECTION STARTS HERE
	function get_bounty_jobs($type) {
		$database = new Database;
		
		switch($type) {
			case "current":
				$database->query("SELECT * FROM jobs, stores, employer, members 
												WHERE jobs.post_type = :post_type
												AND jobs.job_status = :job_status
												AND jobs.date_created BETWEEN NOW() - INTERVAL 180 DAY AND NOW()
												AND jobs.storeID = stores.storeID
												AND jobs.userID = employer.userID
												AND jobs.userID = members.userID
												ORDER BY jobs.date_created DESC");									
				$database->bind(':post_type', 'bounty');	
				$database->bind(':job_status', 'Open');	
				$job_list = $database->resultset();	
				return $job_list;	
			break;
			
			case "unpaid":
				$database->query("SELECT * FROM jobs, stores, employer, members 
												WHERE jobs.post_type = :post_type
												AND jobs.job_status = :job_status
												AND jobs.bounty_status != :bounty_status
												AND jobs.expiration_date BETWEEN NOW() - INTERVAL 90 DAY AND NOW()
												AND jobs.storeID = stores.storeID
												AND jobs.userID = employer.userD
												AND jobs.userID = members.userID ");									
				$database->bind(':post_type', 'bounty');		
				$database->bind(':job_status', 'filled');		
				$database->bind(':bounty_stat', 'paid');		
				$job_list = $database->resultset();	

				//check to see if anyone need to get paid

				foreach ($job_list as $key=>$row) {
					$database->query("SELECT * FROM bounty_recommendation 
													WHERE jobID = :jobID
													AND recommend_status = :recommend_status");									
					$database->bind(':jobID', $row['jobID']);		
					$database->bind(':recommend_status', 'hired');		
					$hired = $database->resultset();	
					
					if (count($hired) == 0) {
						unset($job_list[$key]);
					}
				}
				
				return $job_list;
			break;
			
			case "follow_up":
				$follow_up = array("first" => array(), "second" => array());

				//an employer will require a follow-up if the job is still open, the bounty is unpaid and all followups complete
				$database->query("SELECT * FROM jobs, stores, employer, members 
												WHERE jobs.post_type = :post_type
												AND jobs.job_status = :job_status
												AND jobs.bounty_status != :bounty_status
												AND jobs.expiration_date BETWEEN NOW() - INTERVAL 90 DAY AND NOW()
												AND jobs.storeID = stores.storeID
												AND jobs.userID = employer.userID
												AND jobs.userID = members.userID ");									
				$database->bind(':post_type', 'bounty');		
				$database->bind(':job_status', 'filled');		
				$database->bind(':bounty_status', 'closed');		
				$job_list = $database->resultset();	

				foreach ($job_list as $row) {
					//first get manually scheduled follow-ups
					$database->query("SELECT * FROM admin_bounty_email_queue 
													WHERE contact_type = :type
													AND date_executed IS NULL");									
					$database->bind(':jobID', $row['jobID']);		
					$database->bind(':contact', 'phone');		
					//$database->bind(':date_executed', '0000-00-00 00:00:00');		
					$second_followup = $database->resultset();	
					
					if (count($second_followup) >0) {
						$follow_up['second'][] = $row;
					}
				}
				
				foreach ($job_list as $key=>$row) {
					//first get manually scheduled follow-ups
					$database->query("SELECT * FROM admin_bounty_email_queue 
													WHERE contact_type = :type
													AND date_executed IS NULL");									
					$database->bind(':jobID', $row['jobID']);		
					$database->bind(':contact', 'email');		
				//	$database->bind(':date_executed', '0000-00-00 00:00:00');		
					$first_followup = $database->resultset();	
					
					if (count($first_followup) > 0) {
						unset($job_list[$key]);
					}
				}
				
				$follow_up['first'] = $job_list; 
				
				return $follow_up;
			break;
		}							
	}
	
	function get_bounty_details($jobID) {
		//get the detaisl regarding the bounty
		$database = new Database;
		//first job data
		$database->query("SELECT jobs.title, stores.name, jobs.bounty, jobs.bounty_status, jobs.job_status, jobs.date_created, jobs.expiration_date, members.firstname, members.lastname, members.email, employer.position, stores.zip, jobs.jobID, jobs.public_hash
										FROM jobs, stores, employer, members 
										WHERE jobs.jobID = :jobID
										AND jobs.storeID = stores.storeID
										AND jobs.userID = employer.userID
										AND jobs.userID = members.userID");									
		$database->bind(':jobID', $jobID);		
		$job_details = $database->single();
		
		//then recommendations	
		$database->query("SELECT * FROM bounty_recommendations WHERE jobID = :jobID");									
		$database->bind(':jobID', $jobID);		
		$recommendations = $database->resultset();
		if (count($recommendations) > 0) {
			foreach($recommendations as $key=>$row) {
				$database->query("SELECT firstname, lastname, email FROM members WHERE userID = :userID");									
				$database->bind(':userID', $row['userID']);		
				
				$member_data = $database->single();
				$recommendations[$key]['bounty_first'] = $member_data['firstname']; 
				$recommendations[$key]['bounty_last'] = $member_data['lastname']; 
				$recommendations[$key]['bounty_email'] = $member_data['email']; 
			}
		}

		//then followups
		$database->query("SELECT * FROM admin_bounty_followup_record WHERE jobID = :jobID");									
		$database->bind(':jobID', $jobID);		
		$follow_up = $database->resultset();

		//then bounty record
		$database->query("SELECT * FROM stripe_payment WHERE jobID = :jobID");									
		$database->bind(':jobID', $jobID);		
		$bounty_payment = $database->resultset();

		$bounty_details = array("job" => $job_details, "recommendations" => $recommendations, "follow_up" => $follow_up, "bounty_payment" => $bounty_payment);

		return $bounty_details;
	}
	
	function get_employee_email_list($region) {
		$database = new Database;			
		$utilities = new Utilities;		
		//get a list of emails and names for active employees in specific regions
		//this is used for bulk emailing 
		//We define "Active" as having logged into SBC within the last 12 month, and a complete profile
		
		switch($region) {
			case "orlando":
				$coordinates = $utilities->get_coordinates('32801');			
			break;

			case "tampa":
				$coordinates = $utilities->get_coordinates('33602');			
			break;

			case "charlotte":
				$coordinates = $utilities->get_coordinates('28204');			
			break;

			case "charleston":
				$coordinates = $utilities->get_coordinates('29403');			
			break;
		}		
				
		$longitude = $coordinates['longitude'];
		$latitude= $coordinates['latitude'];
				
		//40 mile appoximation, square
		$max_lat = $latitude + 0.57971;
		$min_lat = $latitude - 0.57971;
		$max_long = $longitude + 0.57827;
		$min_long = $longitude - 0.57827;
		
		
		$database->query("SELECT members.userID, members.email, members.firstname, members.lastname, members.zip, members.type, members.email_validation, members.email_setting, members.last_login
								FROM members, zcta
								WHERE members.email_validation = 'Y'
								AND members.profile_status = 'complete'
								AND members.type = 'employee'
								AND members.email_setting = 'Y'
								AND members.valid = 'Y'
								AND members.last_login >= DATE_SUB(NOW(), INTERVAL 393 DAY)
								AND members.zip = zcta.zip
								AND zcta.latitude BETWEEN :min_lat AND :max_lat
								AND zcta.longitude BETWEEN :min_long AND :max_long ");							

		$database->bind(':min_lat', $min_lat);
		$database->bind(':max_lat', $max_lat);
		$database->bind(':min_long', $min_long);
		$database->bind(':max_long', $max_long);
		$result = $database->resultset();	

		return $result;
	}
	
	function get_bounty_stats($stat_type) {
		$utilities = new Utilities;
		$database = new Database;
		
		switch($stat_type) {
			case "rolling_averages":
				date_default_timezone_set('America/Los_Angeles');		
				$current_date =  date('Y-m-d');

				//in this case we want to get average views per bounty job and regular job per city per type
				//Data is over the last quarter
				
				$city_array = array("orlando", "tampa", "charlotte", "charleston");
				$average_array = array();
				foreach($city_array as $city) {
					$average_array[$city]['Server']['bounty']['avg_views_total'] = 0;
					$average_array[$city]['Server']['bounty']['avg_applies_total'] = 0;
					$average_array[$city]['Server']['bounty']['count'] = 0;
					$average_array[$city]['Server']['free']['avg_views_total'] = 0;
					$average_array[$city]['Server']['free']['avg_applies_total'] = 0;
					$average_array[$city]['Server']['free']['count'] = 0;

					$average_array[$city]['Bartender']['bounty']['avg_views_total'] = 0;
					$average_array[$city]['Bartender']['bounty']['avg_applies_total'] = 0;
					$average_array[$city]['Bartender']['bounty']['count'] = 0;
					$average_array[$city]['Bartender']['free']['avg_views_total'] = 0;
					$average_array[$city]['Bartender']['free']['avg_applies_total'] = 0;
					$average_array[$city]['Bartender']['free']['count'] = 0;

					$average_array[$city]['Kitchen']['bounty']['avg_views_total'] = 0;
					$average_array[$city]['Kitchen']['bounty']['avg_applies_total'] = 0;
					$average_array[$city]['Kitchen']['bounty']['count'] = 0;
					$average_array[$city]['Kitchen']['free']['avg_views_total'] = 0;
					$average_array[$city]['Kitchen']['free']['avg_applies_total'] = 0;
					$average_array[$city]['Kitchen']['free']['count'] = 0;

					$average_array[$city]['Manager']['bounty']['avg_views_total'] = 0;
					$average_array[$city]['Manager']['bounty']['avg_applies_total'] = 0;
					$average_array[$city]['Manager']['bounty']['count'] = 0;
					$average_array[$city]['Manager']['free']['avg_views_total'] = 0;
					$average_array[$city]['Manager']['free']['avg_applies_total'] = 0;
					$average_array[$city]['Manager']['free']['count'] = 0;

					$average_array[$city]['Host']['bounty']['avg_views_total'] = 0;
					$average_array[$city]['Host']['bounty']['avg_applies_total'] = 0;
					$average_array[$city]['Host']['bounty']['count'] = 0;
					$average_array[$city]['Host']['free']['avg_views_total'] = 0;
					$average_array[$city]['Host']['free']['avg_applies_total'] = 0;
					$average_array[$city]['Host']['free']['count'] = 0;

					$average_array[$city]['Bus']['bounty']['avg_views_total'] = 0;
					$average_array[$city]['Bus']['bounty']['avg_applies_total'] = 0;
					$average_array[$city]['Bus']['bounty']['count'] = 0;
					$average_array[$city]['Bus']['free']['avg_views_total'] = 0;
					$average_array[$city]['Bus']['free']['avg_applies_total'] = 0;
					$average_array[$city]['Bus']['free']['count'] = 0;
					
					switch($city) {
						case "orlando":
							$coordinates = $utilities->get_coordinates('32801');			
						break;
			
						case "tampa":
							$coordinates = $utilities->get_coordinates('33602');			
						break;
			
						case "charlotte":
							$coordinates = $utilities->get_coordinates('28204');			
						break;
			
						case "charleston":
							$coordinates = $utilities->get_coordinates('29403');			
						break;
					}
					
					$longitude = $coordinates['longitude'];
					$latitude= $coordinates['latitude'];
							
					//40 mile appoximation, square
					$max_lat = $latitude + 0.57971;
					$min_lat = $latitude - 0.57971;
					$max_long = $longitude + 0.57827;
					$min_long = $longitude - 0.57827;
					
					$database->query("SELECT jobs.jobID, jobs.post_type, jobs_specialties.specialty, jobs.date_created, jobs.expiration_date 
												FROM jobs, stores, jobs_specialties, zcta
												WHERE jobs.date_created > DATE_SUB(NOW(), INTERVAL 3 MONTH)
												AND (jobs.job_status = :open OR jobs.job_status = :filled)
												AND jobs.storeID = stores.storeID
												AND jobs.jobID = jobs_specialties.jobID
												AND stores.zip = zcta.zip
												AND zcta.latitude BETWEEN :min_lat AND :max_lat
												AND zcta.longitude BETWEEN :min_long AND :max_long ");							
			
					$database->bind(':min_lat', $min_lat);
					$database->bind(':max_lat', $max_lat);
					$database->bind(':min_long', $min_long);
					$database->bind(':max_long', $max_long);
					$database->bind(':open', "Open");
					$database->bind(':filled', "Filled");
					
					$job_list = $database->resultset();	
					
					//this is heavy, but it is the only current way to make this calculation
					$view_count = 0;
					$apply_count = 0;
					$bounty_count = 0;
					$free_count = 0;
					
					foreach($job_list as $job) {
						//first determine if the job has expired and get number of dates
						if ($job['expiration_date'] > $current_date) {
							$diff = strtotime($current_date) - strtotime($job['date_created']);
						} else {
							$diff = strtotime($job['expiration_date']) - strtotime($job['date_created']);							
						}	
						$divider = 60*60*24;
						$days = ceil($diff / $divider);

						//get job views
						if ($days > 0) {
							$database->query("SELECT viewID FROM job_views
															WHERE jobID = :jobID
															AND type = :type");										
							$database->bind(':jobID', $job['jobID']);
							$database->bind(':type', "qualified");
							
							$view_count = count($database->resultset());
							//get average views per day
							$avg_views = $view_count / $days;
							//echo $avg_views."<br />";
							
							$database->query("SELECT matchID FROM job_match_archive
															WHERE jobID = :jobID
															AND employee_interest = :interest");											
							$database->bind(':jobID', $job['jobID']);
							$database->bind(':interest', "Y");
							
							$apply_count = count($database->resultset());							
							//get applies views per day
							$avg_applies = $apply_count / $days;						
							
							if ($job['post_type'] == "bounty") {
								$average_array[$city][$job['specialty']]['bounty']['count']++;
								$average_array[$city][$job['specialty']]['bounty']['avg_views_total'] = $average_array[$city]['bounty'][$job['specialty']]['avg_views_total'] + $avg_views;
								$average_array[$city][$job['specialty']]['bounty']['avg_applies_total']  = $average_array[$city]['bounty'][$job['specialty']]['avg_applies_total'] + $avg_applies;
	
							} else {
								$average_array[$city][$job['specialty']]['free']['count']++;								
								$average_array[$city][$job['specialty']]['free']['avg_views_total'] = $average_array[$city]['bounty'][$job['specialty']]['avg_views_total'] + $avg_views;
								$average_array[$city][$job['specialty']]['free']['avg_applies_total']  = $average_array[$city]['bounty'][$job['specialty']]['avg_applies_total'] + $avg_applies;
							}
						}
					}
				}
				//echo var_dump($average_array);
				return $average_array;
				
			break;
		}
	}
	
	function get_boosted_jobs($type) {
		$database = new Database;

		switch($type) {
			case "new":
				$database->query("SELECT jobs.jobID, jobs.public_hash, job_boost.boostID, members.firstname, members.lastname, stores.name, stores.zip, jobs.title, jobs.date_created, job_boost.boost_type, job_boost.date_created, job_boost.payment_status
												FROM members, stores, jobs, job_boost
												WHERE job_boost.date_boosted IS NULL											
												AND job_boost.jobID = jobs.jobID
												AND jobs.userID = members.userID
												AND jobs.storeID = stores.storeID
												AND stores.userID = jobs.userID");											
				$boosted_list = $database->resultset();				
			break;
			
			case "past":
				$database->query("SELECT jobs.jobID, jobs.public_hash, members.firstname, members.lastname, stores.name, stores.zip, jobs.title, jobs.date_created, job_boost.boost_type, job_boost.date_created, job_boost.date_boosted, job_boost.payment_status
												FROM members, stores, jobs, job_boost
												WHERE job_boost.date_boosted IS NOT NULL										
												AND job_boost.jobID = jobs.jobID
												AND jobs.userID = members.userID
												AND jobs.storeID = stores.storeID
												AND stores.userID = jobs.userID");											
				$boosted_list = $database->resultset();	
			break;
		}
		
		return $boosted_list;
	}
	
	function save_boost($boostID, $date) {
		$database = new Database;
		$database->query("UPDATE job_boost SET date_boosted = :date 
										WHERE boostID = :boostID
										AND date_boosted IS NULL ");			
		$database->bind(':boostID', $boostID);					
		$database->bind(':date', $date);					
		$database->execute();		
	}
	
	function get_new_group_jobs() {
		$database = new Database;

		//first get groups
		$database->query("SELECT * FROM group_post, stores
										WHERE group_post.cl_post IS NULL
										AND group_post.post_status = :post_status
										AND group_post.region_status = :region_status										
										AND group_post.storeID = stores.storeID");											
		$database->bind(':post_status', "posted");					
		$database->bind(':region_status', "paid");					
		$active_groups = $database->resultset();	
		
		
		foreach($active_groups as $key=>$row) {
			//fill jobs in to groups
			$active_groups[$key]['job_list'] = array();
			$group_jobs = array();
			
			if ($row['groupID'] > 0) {
				$database->query("SELECT * FROM jobs
												WHERE job_status = :job_status										
												AND groupID = :groupID");											
				$database->bind(':job_status', "Open");
				$database->bind(':groupID', $row['groupID']);
				$group_jobs = $database->resultset();	
				$active_groups[$key]['job_list'] = $group_jobs;																						
			}
		}			

		return $active_groups;
	}	
	
	function save_cl_post($groupID, $date) {
		$database = new Database;
		$database->query("UPDATE group_post SET cl_post = :date 
										WHERE groupID = :groupID
										AND cl_post IS NULL ");			
		$database->bind(':groupID', $groupID);					
		$database->bind(':date', $date);					
		$database->execute();		
	}	
	
	function save_amazon_date($signupID, $date) {
		$database = new Database;
		$database->query("UPDATE referral_signup SET paid_date = :date 
										WHERE signupID = :signupID
										AND paid_date IS NULL ");			
		$database->bind(':signupID', $signupID);					
		$database->bind(':date', $date);					
		$database->execute();		
	}	
	
}
?>