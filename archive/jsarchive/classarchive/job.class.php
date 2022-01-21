<?php
require_once('mysqldb.class.php');	
require_once('utilities.class.php');

require_once('message.class.php');	


//for Ajax
//CHANGE FOR LIVE SITE
/*
require_once($_SERVER['DOCUMENT_ROOT'].'/html/job_html.php');		
require_once($_SERVER['DOCUMENT_ROOT'].'/mobile/job_html_mobile.php');
*/


class Job {

	public $jobID;
	
	function __construct($jobID) {
		$this->jobID = $jobID;
	}
		
	function get_job_data($type_array) {
		//separate the data for efficency
		$job_data_array = array();
		
		foreach($type_array as $type) {
			$job_data = $this->get_job_details($type);		
			$job_data_array[$type] = $job_data;
		}
		
		$utilities = new Utilities;
		array_walk_recursive($job_data_array, array($utilities, "makeSafe"));
		
		return $job_data_array;
	}	
			
	public function get_job_details($type) {
		
		switch($type) {
			case "general":
				$database = new Database;
				$database->query('SELECT * FROM jobs WHERE jobID = :jobID');
				$database->bind(':jobID', $this->jobID);
				$result = $database->single();
				return $result;
			break;
			
			case "store":
				$database = new Database;
				$database->query('SELECT stores.storeID, stores.name, stores.address, stores.zip, stores.description, stores.website, stores.facebook, stores.twitter, stores.description, stores.image FROM jobs, stores WHERE jobs.jobID = :jobID AND stores.storeID = jobs.storeID');
				$database->bind(':jobID', $this->jobID);
				$result = $database->single();
				return $result;
			break;			
			
			case "employer":
				$database = new Database;
				$database->query('SELECT employer.position FROM jobs, employer WHERE jobs.jobID = :jobID AND employer.userID = jobs.userID');
				$database->bind(':jobID', $this->jobID);
				$result = $database->single();
				return $result;
			break;			
					
			case "skills":
				$database = new Database;
				$database->query("SELECT * FROM jobs_specialties WHERE jobID = :jobID");
				$database->bind(':jobID', $this->jobID);		
				$skill_array = $database->single();

				$database = new Database;				
				$database->query("SELECT * FROM jobs_sub_specialties WHERE jobID = :jobID");
				$database->bind(':jobID', $this->jobID);		
				$sub_array = $database->resultset();

				$skills = array("main_skill" => $skill_array, "sub_skills" => $sub_array);
				return $skills;				
			break;
			
			case "requirements":
				$database = new Database;
				$database->query("SELECT * FROM job_requirements WHERE jobID = :jobID");
				$database->bind(':jobID', $this->jobID);		
				$requirements = $database->resultset();	
				return $requirements;											
			break;

			case "question_list":
				$database = new Database;
				$database->query("SELECT * FROM job_questions WHERE jobID = :jobID");
				$database->bind(':jobID', $this->jobID);		
				$questions = $database->resultset();	
				
				$answer_array = array();
				
				$question_array = array("questions" => $questions, "answers" => $answer_array);
				return $question_array;								
			break;
			
			case "store_array":
				$database = new Database;
				$database->query('SELECT * FROM jobs, stores WHERE jobs.jobID = :jobID AND stores.userID = jobs.userID');
				$database->bind(':jobID', $this->jobID);
				$result = $database->resultset();
				return $result;			
			break;
			
			case "candidate_count":
				$database = new Database;
				$database->query("SELECT userID, matchID FROM job_match WHERE jobID = :jobID");	
				$database->bind(':jobID', $this->jobID);
				$result = $database->resultset();
				return count($result);								
			break;
			
			case "positive_list":
				$database = new Database;
				$database->query("SELECT * FROM job_match, members
											WHERE job_match.jobID = :jobID
											AND job_match.employee_interest = 'Y'
											AND job_match.userID = members.userID
											ORDER BY job_match.date_responded ASC");	
				$database->bind(':jobID', $this->jobID);
				$positive_list = $database->resultset();
				
				return $positive_list;															
			break;
			
			case "hired_candidates":
				$database = new Database;
				$database->query("SELECT userID, recommendedID FROM bounty_recommendations 
												WHERE jobID = :jobID
												AND recommend_status = :recommend_status");	
				$database->bind(':jobID', $this->jobID);
				$database->bind(':recommend_status', "Hired");
				$result = $database->resultset();
				return $result;
			break;
			
			case "positive_count":
				$database = new Database;
				$database->query("SELECT matchID FROM job_match
											WHERE jobID = :jobID
											AND employee_interest = 'Y' ");	
				$database->bind(':jobID', $this->jobID);
				$result = $database->resultset();
				return count($result);																								
			break;			
			
			case "negative_count":
				$database = new Database;
				$database->query("SELECT userID, matchID FROM job_match
											WHERE job_match.jobID = :jobID
											AND employee_interest = 'N' ");	
				$database->bind(':jobID', $this->jobID);
				$result = $database->resultset();
				return count($result);																								
			break;
			
			case "view_count":
				$database = new Database;
				$database->query("SELECT userID, matchID FROM job_match
											WHERE job_match.jobID = :jobID
											AND date_viewed IS NOT NULL ");
				$database->bind(':jobID', $this->jobID);
				$result = $database->resultset();
				return count($result);																																									
			break;
			
			case "new_view_count":
				$database = new Database;
				$database->query("SELECT userID FROM job_views
											WHERE jobID = :jobID AND type = 'qualified'");	
				$database->bind(':jobID', $this->jobID);
				$result = $database->resultset();
				return count($result);																																																									
			break;				
			
			case "candidate_videos":
 				$database = new Database;
				$database->query("SELECT * FROM job_match, videos
											WHERE job_match.jobID = :jobID
											AND videos.userID = job_match.userID
											AND date_viewed IS NOT NULL");	
				$database->bind(':jobID', $this->jobID);
				$result = $database->resultset();
				return $result;																																																																									
			break;
			
			case "boost_data":
 				$database = new Database;
				$database->query("SELECT * FROM job_boost WHERE jobID = :jobID");	
				$database->bind(':jobID', $this->jobID);
				$result = $database->resultset();
				return $result;																																																																									
			break;									
		}
	}
	
	function create_group($storeID, $type) {
		//test storeID
		$database = new Database;

		if ($storeID > 0) {
			//make sure storeID owned by user
			$database->query("SELECT userID FROM stores WHERE storeID = :storeID AND userID = :userID");	
			$database->bind(':storeID', $storeID);
			$database->bind(':userID', $_SESSION['userID']);
			$result = $database->resultset();
			
			if (count($result) > 0) {
				switch($type) {
					case "BOH":
					case "FOH":
						$max_posts = 4;
					break;
					
					case "single":
						$max_posts = 1;
					break;
					
					case "all":
						$max_posts = 8;
					break;
				}
				
				$database->query("INSERT INTO group_post 
												(storeID, userID, type, max_posts, date_created, post_status)
											VALUES
												(:storeID, :userID, :type, :max_posts, NOW(), :post_status)");
				$database->bind(':storeID', $storeID);
				$database->bind(':userID', $_SESSION['userID']);
				$database->bind(':type', $type);
				$database->bind(':max_posts', $max_posts);				
				$database->bind(':post_status', 'draft');

				$database->execute();
				
				$groupID = $database->lastInsertId();			
			} else {
				//error
				$groupID = "error";
			}			
		} else {
			//error
			$groupID = "error";			
		}

		return $groupID;			
	}
	
	function get_group_details($groupID) {
		//return details for job post
		$database = new Database;
		
		if ($groupID > 0) {
			$database->query("SELECT * FROM group_post WHERE groupID = :groupID AND userID = :userID");	
			$database->bind(':groupID', $groupID);
			$database->bind(':userID', $_SESSION['userID']);
			$result = $database->single();	
		} else {
			$result = "error";
		}

		if ($result['userID'] != $_SESSION['userID']) {
			$result = "error";
		}
		
		return $result;
	}
	
	function get_local_rank($jobID, $zip, $broad_skill) {
		//determine the rank of this job based on bounty amount
		//two values here, overall and broad skill specific

		$utilities = new Utilities;
		
		$coordinates = $utilities->get_coordinates($zip);
		
		$longitude = $coordinates['longitude'];
		$latitude = $coordinates['latitude'];
		
		//40 mile appoximation, square
		$max_lat = $latitude + 0.57971;
		$min_lat = $latitude - 0.57971;
		$max_long = $longitude + 0.57827;
		$min_long = $longitude - 0.57827;
		
		//big set of selects, test for speed issues
		$database = new Database;						
		$database->query("SELECT jobs.bounty, jobs.jobID, jobs_specialties.specialty
									FROM jobs, stores, jobs_specialties, zcta
									WHERE jobs.storeID = stores.storeID
									AND jobs.expiration_date > NOW()
									AND jobs_specialties.jobID = jobs.jobID
									AND jobs.post_type = :post_type
									AND jobs.job_status = :job_status
									AND stores.zip = zcta.zip
									AND zcta.latitude BETWEEN :min_lat AND :max_lat
									AND zcta.longitude BETWEEN :min_long AND :max_long
									ORDER BY jobs.bounty DESC");
		$database->bind(':job_status', 'Open');	
		$database->bind(':post_type', 'bounty');	
		$database->bind(':min_lat', $min_lat);
		$database->bind(':max_lat', $max_lat);
		$database->bind(':min_long', $min_long);
		$database->bind(':max_long', $max_long);			
		$job_list = $database->resultset();	
		
				
		$skill_sort_jobs = array();
		$rank_count = 1;
		foreach($job_list as $row) {
			if ($row['jobID'] == $jobID) {
				$overall_rank = $rank_count;
			}
			
			if ($row['specialty'] == $broad_skill) {
				$skill_sort_jobs[] = $row;
			}
			$rank_count++;
		}
		
		$rank_count = 1;
		foreach($skill_sort_jobs as $row) {
			if ($row['jobID'] == $jobID) {
				$skill_rank = $rank_count;
			}
			
			$rank_count++;
		}
		
		$rank = array("overall" => $overall_rank, "skill" => $skill_rank, "overall_array" => $job_list, "skill_job_array" => $skill_sort_jobs);

		return $rank;
	}
	
	private function get_candidates($type) {
		$database = new Database;

			switch($type) {
				case "all":
					$database->query("SELECT userID, matchID FROM job_match WHERE jobID = :jobID");		
				break;
				
				case "positive":
					$database->query("SELECT * FROM job_match, members
												WHERE job_match.jobID = :jobID
												AND job_match.employee_interest = 'Y'
												AND job_match.employer_interest != 'N'
												AND job_match.userID = members.userID
												ORDER BY job_match.date_responded ASC");		
				break;
				
				case "negative":
					$database->query("SELECT userID, matchID FROM job_match
												WHERE job_match.jobID = :jobID
												AND employee_interest = 'N' ");						
				break;
				
				case "views":
					$database->query("SELECT userID, matchID FROM job_match
												WHERE job_match.jobID = :jobID
												AND date_viewed IS NOT NULL");						
				break;
				
				case "new_views":
					$database->query("SELECT userID FROM job_views
												WHERE jobID = :jobID AND type = 'qualified'");						
				break;				
				
				case "videos":
					$database->query("SELECT * FROM job_match, videos
												WHERE job_match.jobID = :jobID
												AND videos.userID = job_match.userID
												AND date_viewed IS NOT NULL");						
				break;												
			}
			
			$database->bind(':jobID', $this->jobID);		
			$result = $database->resultset();	
					
			return $result;				
	}
	
	
	function add_template_job($storeID, $templateID, $groupID) {
		$store = new Store($storeID);
		
		//ensure this is the owner of the storeID && GroupID
		$store_data = $store->get_store_data();

		$valid_group =  $this->test_groupID($groupID, $storeID);

		if ($_SESSION['type'] == "employer" && $storeID > 0 && $store_data['general']['userID'] == $_SESSION['userID'] && $valid_group == "Y") {
					$template_data = $this->get_job_template_data($templateID);		
					$general_data = $template_data['general'];
					$skill_data = $template_data['skills'];
					$requirement_data = $template_data['requirements'];
					$question_data = $template_data['questions'];
					
					//Write general data to job
					$utilities = new Utilities; 
					
					date_default_timezone_set('America/Los_Angeles');		
					$expiration_date =  date('Y-m-d', strtotime("+15 days"));
					//create a hash for a public job link
					$public_hash = $utilities->generateRandomString(12);

					$database = new Database;					
					$database->query('INSERT INTO jobs
												(userID, storeID, groupID, title, comp_type, schedule, job_status, date_created, expiration_date, public_hash, code, template)
												VALUES (:userID, :storeID, :groupID, :title, :comp_type, :schedule, :job_status, NOW(), :expiration_date, :public_hash, :code, :templateID)');
					$database->bind(':userID', $_SESSION['userID']);			
					$database->bind(':storeID', $storeID);
					$database->bind(':groupID', $groupID);
					$database->bind(':title', $general_data['title']);
					$database->bind(':comp_type', $general_data['pay_type']);
					$database->bind(':schedule', $general_data['schedule']);
					$database->bind(':job_status', "template_edit");
					$database->bind(':expiration_date', $expiration_date);
					$database->bind(':public_hash', $public_hash);
					$database->bind(':code', 'B');
					$database->bind(':templateID', $templateID);
					$database->execute();			
					$jobID = $database->lastInsertId();

					$database = new Database;
					$database->query('INSERT INTO jobs_specialties
												(jobID, specialty)
												VALUES (:jobID, :specialty)');
					$database->bind(':jobID', $jobID);			
					$database->bind(':specialty', $general_data['main_skill']);
					$database->execute();							
					$specialtyID = $database->lastInsertId();

					foreach ($skill_data as $row) {
						$database = new Database;
						$database->query('INSERT INTO jobs_sub_specialties
													(jobID, specialtyID, sub_specialty)
													VALUES (:jobID, :specialtyID, :sub_specialty)');
						$database->bind(':jobID', $jobID);			
						$database->bind(':specialtyID', $specialtyID);			
						$database->bind(':sub_specialty', $row['sub_skill']);
						$database->execute();							
					}					
					
					foreach ($requirement_data as $row) {
						$database = new Database;
						$database->query('INSERT INTO job_requirements
													(jobID, requirement)
													VALUES (:jobID, :requirement)');
						$database->bind(':jobID', $jobID);			
						$database->bind(':requirement', $row['requirement']);
						$database->execute();							
					}
					
					foreach ($question_data as $row) {
						$database = new Database;
						$database->query('INSERT INTO job_questions
													(jobID, template_questionID, question, type)
													VALUES (:jobID, :template_questionID, :question, :type)');
						$database->bind(':jobID', $jobID);			
						$database->bind(':template_questionID', $row['questionID']);
						$database->bind(':question', $row['question']);
						$database->bind(':type', "multiple");
						$database->execute();							
					}
					
					return $jobID;
		}	
	}
	
	function add_custom_job($storeID, $main_skill, $groupID) {
		$store = new Store($storeID);
		
		//ensure this is the owner of the storeID and groupID
		$store_data = $store->get_store_data();
		$valid_group =  $this->test_groupID($groupID, $storeID);		

		if ($_SESSION['type'] == "employer" && $storeID > 0 && $store_data['general']['userID'] == $_SESSION['userID'] && $valid_group == "Y") {
					$database = new Database;
					$utilities = new Utilities; 
					
					date_default_timezone_set('America/Los_Angeles');		
					$expiration_date =  date('Y-m-d', strtotime("+15 days"));
					//create a hash for a public job link
					$public_hash = $utilities->generateRandomString(12);
					$title = "New ".$main_skill." Job";
					
					$database->query('INSERT INTO jobs
												(userID, storeID, groupID, title, job_status, date_created, expiration_date, public_hash, code, template)
												VALUES (:userID, :storeID, :groupID, :title, :job_status, NOW(), :expiration_date, :public_hash, :code, :templateID)');
					$database->bind(':userID', $_SESSION['userID']);			
					$database->bind(':storeID', $storeID);
					$database->bind(':groupID', $groupID);
					$database->bind(':title', $title);
					$database->bind(':job_status', "custom_edit");
					$database->bind(':expiration_date', $expiration_date);
					$database->bind(':public_hash', $public_hash);
					$database->bind(':code', 'B');
					$database->bind(':templateID', 'custom_b');					
					$database->execute();			
					$jobID = $database->lastInsertId();

					$database = new Database;
					$database->query('INSERT INTO jobs_specialties
												(jobID, specialty)
												VALUES (:jobID, :specialty)');
					$database->bind(':jobID', $jobID);			
					$database->bind(':specialty', $main_skill);
					$database->execute();
					
					return $jobID;									
		}		
	}
	
	function repost_job($storeID, $groupID) {
		$store = new Store($storeID);
		
		//ensure this is the owner of the jobID
		$store_data = $store->get_store_data();
		$valid_group =  $this->test_groupID($groupID, $storeID);		

		if ($_SESSION['type'] == "employer" && $storeID > 0 && $store_data['general']['userID'] == $_SESSION['userID'] && $valid_group == "Y") {
				$general_data = $this->get_job_details('general');	
				$skill_data = $this->get_job_details('skills');
				$requirement_data = $this->get_job_details('requirements');
				$question_array = $this->get_job_details('question_list');
				$question_data = $question_array['questions'];

				//in the case of pre update jobs, convert pay amount to high and low pay
				if ($general_data['comp_value'] > 0) {
					$general_data['comp_value_high'] = $general_data['comp_value'];
					$general_data['comp_value_low'] = $general_data['comp_value'];
				}
				
				//Write general data to job
				$database = new Database;
				$utilities = new Utilities; 
					
				date_default_timezone_set('America/Los_Angeles');		
				$expiration_date =  date('Y-m-d', strtotime("+15 days"));
				//create a hash for a public job link
				$public_hash = $utilities->generateRandomString(12);
					
					$database->query('INSERT INTO jobs
												(userID, storeID, groupID, title, description, comp_type, comp_value_high, comp_value_low, benefits, benefits_desc, walkin, walkin_desc, schedule, job_status, date_created, expiration_date, public_hash, code, template)
												VALUES (:userID, :storeID, :groupID, :title, :description, :comp_type, :comp_value_high, :comp_value_low, :benefits, :benefits_desc, :walkin, :walkin_desc, :schedule, :job_status, NOW(), :expiration_date, :public_hash, :code, :template)');
					$database->bind(':userID', $_SESSION['userID']);			
					$database->bind(':storeID', $storeID);
					$database->bind(':groupID', $groupID);
					$database->bind(':title', $general_data['title']);
					$database->bind(':description', $general_data['description']);
					$database->bind(':comp_type', $general_data['comp_type']);
					//$database->bind(':comp_value', $general_data['comp_value']);
					$database->bind(':comp_value_high', $general_data['comp_value_high']);
					$database->bind(':comp_value_low', $general_data['comp_value_low']);
					$database->bind(':benefits', $general_data['benefits']);
					$database->bind(':benefits_desc', $general_data['benefits_desc']);
					$database->bind(':walkin', $general_data['walkin']);
					$database->bind(':walkin_desc', $general_data['walkin_desc']);
					$database->bind(':schedule', $general_data['schedule']);
					$database->bind(':template', $general_data['template']);
					$database->bind(':job_status', "template_edit");
					$database->bind(':expiration_date', $expiration_date);
					$database->bind(':public_hash', $public_hash);
					$database->bind(':code', 'B');
					$database->execute();			
					$jobID = $database->lastInsertId();

					$database = new Database;
					$database->query('INSERT INTO jobs_specialties
												(jobID, specialty)
												VALUES (:jobID, :specialty)');
					$database->bind(':jobID', $jobID);			
					$database->bind(':specialty', $skill_data['main_skill']['specialty']);
					$database->execute();							
					$specialtyID = $database->lastInsertId();

					foreach ($skill_data['sub_skills'] as $row) {
						$database = new Database;
						$database->query('INSERT INTO jobs_sub_specialties
													(jobID, specialtyID, sub_specialty)
													VALUES (:jobID, :specialtyID, :sub_specialty)');
						$database->bind(':jobID', $jobID);			
						$database->bind(':specialtyID', $specialtyID);			
						$database->bind(':sub_specialty', $row['sub_specialty']);
						$database->execute();							
					}					
					
					foreach ($requirement_data as $row) {
						$database = new Database;
						$database->query('INSERT INTO job_requirements
													(jobID, requirement)
													VALUES (:jobID, :requirement)');
						$database->bind(':jobID', $jobID);			
						$database->bind(':requirement', $row['requirement']);
						$database->execute();							
					}
					
					foreach ($question_data as $row) {
						$database = new Database;
						$database->query('INSERT INTO job_questions
													(jobID, template_questionID, question, type)
													VALUES (:jobID, :template_questionID, :question, :type)');
						$database->bind(':jobID', $jobID);			
						$database->bind(':template_questionID', $row['template_questionID']);
						$database->bind(':question', $row['question']);
						$database->bind(':type', $row['type']);
						$database->execute();							
					}
					
					return $jobID;
		}		
	}	
	
	function repost_group($old_groupID) {
		//get group details from old group
		if ($old_groupID > 0) {
			$database = new Database;
			$database->query("SELECT type, storeID FROM group_post
										WHERE groupID = :groupID
										AND userID = :userID");						

			$database->bind(':groupID', $old_groupID);		
			$database->bind(':userID', $_SESSION['userID']);		
			$result = $database->single();	

			//create new group with result
			if ($result['storeID'] > 0) {
				$new_groupID = $this->create_group($result['storeID'], $result['type']);
				
				//get jobs from old group
				$database->query("SELECT jobID FROM jobs
												WHERE groupID = :groupID
												AND userID = :userID
												AND (job_status = :open OR job_status = :filled)");						

				$database->bind(':groupID', $old_groupID);		
				$database->bind(':userID', $_SESSION['userID']);		
				$database->bind(':open', 'Open');		
				$database->bind(':filled', 'Filled');		

				$jobs = $database->resultset();	

				
				$result_array = array("new_groupID" => $new_groupID, "storeID" => $result['storeID'], "job_array" => $jobs);
				return $result_array;
			}
			
			return "error";
		}
		return "error";
	}	
	
	function update_job($type, $job_data) {	
		$utilities = new Utilities;
		
		switch($type) {
			case "job_status":
				$database = new Database;			
				$database->query('UPDATE jobs SET job_status = :job_status
											WHERE jobID = :jobID
											AND userID = :userID LIMIT 1');
				$database->bind(':job_status', $job_data);			
				$database->bind(':jobID', $this->jobID);
				$database->bind(':userID', $_SESSION['userID']);						
				$database->execute();
				
				//if job status is set to Open (i.e. new job), determine whether it is the first job posted by the user
				if($job_data == "Open") {
					$this->first_job_test();
				}				
			break;
			
			case "title":
				$database = new Database;			
				$database->query("UPDATE jobs 
											SET title = :title
											WHERE jobID = :jobID
											AND userID = :userID LIMIT 1");
				$database->bind(':title', $job_data);			
				$database->bind(':jobID', $this->jobID);
				$database->bind(':userID', $_SESSION['userID']);						
				$database->execute();	
				
				$job_data = $utilities->makeSafe_flat($job_data);
			break;						

			case "store":		
				$database = new Database;			
				$database->query("UPDATE jobs 
											SET storeID = :storeID
											WHERE jobID = :jobID
											AND userID = :userID LIMIT 1");
				$database->bind(':storeID', $job_data);			
				$database->bind(':jobID', $this->jobID);
				$database->bind(':userID', $_SESSION['userID']);						
				$database->execute();	
				
				$store_data = $this->get_job_details("store");	
				$store_name = $store_data['name'];
				$storeID	= $store_data['storeID'];
				$store_array = $this->get_job_details("store_array");		
			break;						
			
			case "schedule":
				$database = new Database;			
				$database->query("UPDATE jobs 
											SET schedule = :schedule
											WHERE jobID = :jobID
											AND userID = :userID LIMIT 1");
				$database->bind(':schedule', $job_data);			
				$database->bind(':jobID', $this->jobID);
				$database->bind(':userID', $_SESSION['userID']);						
				$database->execute();	
			break;
			
			case "benefits":
				$database = new Database;			
				$database->query("UPDATE jobs 
											SET 	benefits = :benefits,
													benefits_desc = :benefits_desc
											WHERE jobID = :jobID
											AND userID = :userID LIMIT 1");
				$database->bind(':benefits', $job_data['benefits']);			
				$database->bind(':benefits_desc', $job_data['benefits_desc']);			
				$database->bind(':jobID', $this->jobID);
				$database->bind(':userID', $_SESSION['userID']);						
				$database->execute();	
				
			break;
			
			case "walkin":
				$database = new Database;			
				$database->query("UPDATE jobs 
											SET 	walkin = :walkin,
													walkin_desc = :walkin_desc
											WHERE jobID = :jobID
											AND userID = :userID LIMIT 1");
				$database->bind(':walkin', $job_data['walkin']);			
				$database->bind(':walkin_desc', $job_data['walkin_desc']);			
				$database->bind(':jobID', $this->jobID);
				$database->bind(':userID', $_SESSION['userID']);						
				$database->execute();					
			break;			

			case "comp":
				$database = new Database;			
				$database->query("UPDATE jobs 
											SET 	comp_type = :comp_type,
													comp_value_high = :comp_value_high,
													comp_value_low= :comp_value_low
											WHERE jobID = :jobID
											AND userID = :userID LIMIT 1");
				$database->bind(':comp_type', $job_data['comp_type']);			
				$database->bind(':comp_value_high', $job_data['comp_value_high']);			
				$database->bind(':comp_value_low', $job_data['comp_value_low']);			
				$database->bind(':jobID', $this->jobID);
				$database->bind(':userID', $_SESSION['userID']);						
				$database->execute();	
			break;	
						
			case "requirements":
				//remove all current sub_specialties with skillID
				$database = new Database;					
				$database->query("DELETE FROM job_requirements
											WHERE jobID = :jobID");
				$database->bind(':jobID', $this->jobID);	
				$database->execute();																					

				//write new sub_specialties
				foreach($job_data as $row) {
					if ($row != "") {														
						$database = new Database;												
						$database->query("INSERT INTO job_requirements
														(jobID, requirement)
														VALUES (:jobID, :requirement)");		
						$database->bind(':requirement', $row);			
						$database->bind(':jobID', $this->jobID);			
						$database->execute();	
					}
				}

				//no return value, reload page due to CSS issue
			break;																																										
						
			case "main_skill":
				//if there is an entry, remove it
				$database = new Database;
				$database->query("SELECT * FROM jobs_specialties WHERE jobID = :jobID");
				$database->bind(':jobID', $this->jobID);		
				$skill_array = $database->resultset();

				if (count($skill_array) > 0) {
					$database = new Database;					
					$database->query("DELETE FROM jobs_specialties
												WHERE jobID = :jobID");
					$database->bind(':jobID', $this->jobID);
					$database->execute();									

					foreach($skill_array as $row) {
						$database = new Database;					
						$database->query("DELETE FROM jobs_sub_specialties
													WHERE specialtyID = :specialtyID");
						$database->bind(':specialtyID', $row['ID']);	
						$database->execute();	
					}										
				}		

				$database = new Database;						
				$database->query("INSERT INTO jobs_specialties
												(jobID, specialty)
												VALUES (:jobID, :specialty)");		
				$database->bind(':specialty', $job_data);			
				$database->bind(':jobID', $this->jobID);
				$database->execute();				
			break;
			
			case "sub_specialty":
				$utilities = new Utilities; 
				$specialtyID = $job_data['specialtyID'];
				$sub_skills = $job_data['sub_specialty'];

				//remove all current sub_specialties with skillID
				$database = new Database;					
				$database->query("DELETE FROM jobs_sub_specialties WHERE specialtyID = :specialtyID");
				$database->bind(':specialtyID', $specialtyID);	
				$database->execute();		
					
				//write new sub_specialties
				foreach($sub_skills as $row) {
					if ($row != "") {														
						$database = new Database;												
						$database->query("INSERT INTO jobs_sub_specialties
														(jobID, specialtyID, sub_specialty, preference)
														VALUES (:jobID, :specialtyID, :sub_specialty, :preference)");		
						$database->bind(':sub_specialty', $row);			
						$database->bind(':preference', "preferred");			
						$database->bind(':specialtyID', $specialtyID);			
						$database->bind(':jobID', $this->jobID);			
						$database->execute();	
					}
				}
			break;
			
			case "employment":
				$database = new Database;			
				$database->query("UPDATE jobs 
											SET past_employment = :past_employment
											WHERE jobID = :jobID
											AND userID = :userID LIMIT 1");
				$database->bind(':past_employment', $job_data);			
				$database->bind(':jobID', $this->jobID);
				$database->bind(':userID', $_SESSION['userID']);						
				$database->execute();	
			break;
			
			case "intern":
				$database = new Database;			
				$database->query("UPDATE jobs 
											SET intern = :intern
											WHERE jobID = :jobID
											AND userID = :userID LIMIT 1");
				$database->bind(':intern', $job_data);			
				$database->bind(':jobID', $this->jobID);
				$database->bind(':userID', $_SESSION['userID']);						
				$database->execute();	
			break;					
			
			case "question":
				$type = $job_data['type'];
				$questionID = $job_data['questionID'];
				$question = $job_data['question'];

				if ($type == "remove") {
					$database = new Database;					
					$database->query("DELETE FROM job_questions
												WHERE questionID = :questionID 
												AND jobID = :jobID LIMIT 1");
					$database->bind(':questionID', $questionID);	
					$database->bind(':jobID', $this->jobID);	
					$database->execute();																					
				} else {
					if($questionID == "NA") {
						$database = new Database;												
						$database->query("INSERT INTO job_questions
														(jobID, question)
														VALUES (:jobID, :question)");		
						$database->bind(':question', $question);			
						$database->bind(':jobID', $this->jobID);			
						$database->execute();	
					} else {
						$database = new Database;												
						$database->query("SELECT question FROM template_questions
														WHERE questionID = :questionID");		
						$database->bind(':questionID', $questionID);			
						$result = $database->single();
						$question = $result['question'];	

						$database = new Database;												
						$database->query("INSERT INTO job_questions
														(jobID, question, template_questionID)
														VALUES (:jobID, :question, :template_questionID)");		
						$database->bind(':question', $question);			
						$database->bind(':template_questionID', $questionID);			
						$database->bind(':jobID', $this->jobID);			
						$database->execute();							
					}
				}
				
				$question_data = $this->get_job_details("question_list");	

				array_walk_recursive($question_data, array($utilities, "makeSafe"));

				$question_array = $question_data['questions'];				
				$template_questions_array = $this->get_job_template_questions();

				$job_data = $this->get_job_details('general');
				$job_status = $job_data['job_status'];

				$job_data = $this->get_job_details('skills');
				$main_skill = $job_data['main_skill']['specialty'];

				display_questions_section($job_status, $question_array, $template_questions_array, $main_skill);
			break;

			case "edit_question":
				$template_questionID = $job_data['template_questionID'];
				$questionID = $job_data['questionID'];
				$question = $job_data['question'];

				//first delete existing question
				$database = new Database;					
				$database->query("DELETE FROM job_questions
											WHERE questionID = :questionID 
											AND jobID = :jobID LIMIT 1");
				$database->bind(':questionID', $questionID);	
				$database->bind(':jobID', $this->jobID);	
				$database->execute();																					

				if($template_questionID == "NA") {
					$database = new Database;												
					$database->query("INSERT INTO job_questions
													(jobID, question)
													VALUES (:jobID, :question)");		
					$database->bind(':question', $question);			
					$database->bind(':jobID', $this->jobID);			
					$database->execute();	
				} else {
					$database = new Database;												
					$database->query("SELECT question FROM template_questions
													WHERE questionID = :questionID");		
					$database->bind(':questionID', $template_questionID);			
					$result = $database->single();
					$question = $result['question'];	

					$database = new Database;												
					$database->query("INSERT INTO job_questions
													(jobID, question, template_questionID)
													VALUES (:jobID, :question, :template_questionID)");		
					$database->bind(':question', $question);			
					$database->bind(':template_questionID', $template_questionID);			
					$database->bind(':jobID', $this->jobID);			
					$database->execute();							
				}
				
				$question_data = $this->get_job_details("question_list");	

				array_walk_recursive($question_data, array($utilities, "makeSafe"));

				$question_array = $question_data['questions'];				
				$template_questions_array = $this->get_job_template_questions();

				$job_data = $this->get_job_details('general');
				$job_status = $job_data['job_status'];

				$job_data = $this->get_job_details('skills');
				$main_skill = $job_data['main_skill']['specialty'];

				display_questions_section($job_status, $question_array, $template_questions_array, $main_skill);
			break;
			
			case "notes":
				$database = new Database;			
				$database->query("UPDATE jobs 
											SET description = :description
											WHERE jobID = :jobID
											AND userID = :userID LIMIT 1");
				$database->bind(':description', $job_data);			
				$database->bind(':jobID', $this->jobID);
				$database->bind(':userID', $_SESSION['userID']);						
				$database->execute();	
			break;
			
			case "creation_date":
				$database = new Database;			
				$database->query("UPDATE jobs 
											SET date_created = NOW()
											WHERE jobID = :jobID
											AND userID = :userID LIMIT 1");
				$database->bind(':jobID', $this->jobID);
				$database->bind(':userID', $_SESSION['userID']);						
				$database->execute();										
			break;
			
			case "expiration_date":
				date_default_timezone_set('America/Los_Angeles');		
				
				$job_details = $this->get_job_details('general');
				$job_status = $job_details['job_status'];
				
				//ALL JOBS NOW LAS 21 DAYS
				
				//MODDED TO 28 DAYS WITH REMOVAL OF BOUNTIES

				$expiration_date =  date('Y-m-d', strtotime("+28 days"));	

				$database = new Database;			
				$database->query("UPDATE jobs 
											SET expiration_date = :expiration_date
											WHERE jobID = :jobID
											AND userID = :userID LIMIT 1");
				$database->bind(':expiration_date', $expiration_date);
				$database->bind(':jobID', $this->jobID);
				$database->bind(':userID', $_SESSION['userID']);						
				$database->execute();													
			break;
			
			case "hire_notice_date":
				date_default_timezone_set('America/Los_Angeles');		
				
				$job_details = $this->get_job_details('general');
				$job_status = $job_details['job_status'];
				
				$notice_date =  date('Y-m-d', strtotime("+8 days"));	

				$database = new Database;			
				$database->query("UPDATE jobs 
											SET email_followup = :notice_date,
											site_followup= :notice_date
											WHERE jobID = :jobID
											AND userID = :userID LIMIT 1");
				$database->bind(':notice_date', $notice_date);
				$database->bind(':jobID', $this->jobID);
				$database->bind(':userID', $_SESSION['userID']);						
				$database->execute();													
			break;			
			
			case "bounty_amount":
				$total_amount = $job_data;
				
				//determine split based on hard variables
				//delete base fee first				
				$bounty_and_fee = $total_amount - 19;
				$bounty_amount = $bounty_and_fee / 1.2;
				
				 if ($bounty_amount < 0) {
					 return "low_error";
				 } else {
					$database = new Database;			
					$database->query("UPDATE jobs 
												SET post_type = :post_type,
												total_payment = :total_amount,
												bounty = :bounty_amount,
												job_status = :job_status
												WHERE jobID = :jobID
												AND userID = :userID LIMIT 1");
					$database->bind(':post_type', "bounty");
					$database->bind(':total_amount', $total_amount);
					$database->bind(':bounty_amount', $bounty_amount);	
					$database->bind(':job_status', "checkout");	
					$database->bind(':jobID', $this->jobID);
					$database->bind(':userID', $_SESSION['userID']);																
					$database->execute();													
					 return "success";
				 }
			
			break;	
			
			case "checkout_paid":
				//update bounty status as open and payment status as paid
				//log the transaction in the transaction table
				
				$database = new Database;			
				$database->query("UPDATE jobs 
											SET bounty_status = :bounty_status,
											payment_status = :payment_status
											WHERE jobID = :jobID
											AND userID = :userID LIMIT 1");
				$database->bind(':bounty_status', "open");
				$database->bind(':payment_status', "paid");
				$database->bind(':jobID', $this->jobID);
				$database->bind(':userID', $_SESSION['userID']);						
				$database->execute();													
	
				$database->query("INSERT INTO stripe_payment 
											(userID, jobID, phone, date)
											VALUES
											(:userID, :jobID, :phone, NOW())");
				$database->bind(':phone', $job_data);
				$database->bind(':jobID', $this->jobID);
				$database->bind(':userID', $_SESSION['userID']);						
				$database->execute();																	
			break;
			
			case "clear_bounty":
				$database = new Database;			
				
				$database->query("UPDATE jobs 
											SET post_type = :post_type,
											total_payment = :total_payment,
											bounty = :bounty
											WHERE jobID = :jobID
											AND userID = :userID LIMIT 1");
				$database->bind(':post_type', "");
				$database->bind(':total_payment', "0");
				$database->bind(':bounty', "0");
				$database->bind(':jobID', $this->jobID);
				$database->bind(':userID', $_SESSION['userID']);						
				$database->execute();													
			
			break;
		}
	}

	function remove_job_data($type, $recordID) {
		$database = new Database;
		$case_count = 0;
		
		switch($type) {
			case "question":
				$database->query("DELETE FROM job_questions WHERE questionID = :questionID");
				$database->bind(':questionID', $recordID);	
				$case_count++;					
			break;
		}
		
		if ($case_count > 0) {
			$database->execute();	
		}											
	}
	
	function remove_job() {
		$database = new Database;

		//get the group ID of the job
		$database->query("SELECT groupID FROM jobs
										WHERE jobID = :jobID
										AND userID = :userID");
		$database->bind(':jobID', $this->jobID);	
		$database->bind(':userID', $_SESSION['userID']);	
		$result = $database->single();	
		$groupID = $result['groupID'];
		
		
		$database->query("DELETE FROM jobs
										WHERE jobID = :jobID
										AND userID = :userID
										AND (job_status = 'template_edit' OR job_status = 'custom_edit' OR job_status = 'final_step')  
										LIMIT 1");
		$database->bind(':jobID', $this->jobID);	
		$database->bind(':userID', $_SESSION['userID']);	
		$database->execute();	

		$database = new Database;						
		$database->query("DELETE FROM job_match
									WHERE jobID = :jobID ");
		$database->bind(':jobID', $this->jobID);	
		$database->execute();
		
		return $groupID;	
	}
	
	function job_expiration_check() {
		$database = new Database;
		$database->query("SELECT expiration_date FROM jobs
									WHERE jobID = :jobID
									AND expiration_date > NOW() ");		
		$database->bind(':jobID', $this->jobID);	
		$result = count($database->resultset());		
		
		if ($result == 0) {
			return "expired";
		} else {
			return "valid";	
		}		
	}
	
	
	function get_job_template_data($templateID) {
		switch($templateID) {
			default:
				$database = new Database;						
				$database->query("SELECT * FROM template_job WHERE templateID = :templateID ");
				$database->bind(':templateID', $templateID);	
				$general_data = $database->single();	
				
				$database = new Database;						
				$database->query("SELECT * FROM template_skills WHERE templateID = :templateID");
				$database->bind(':templateID', $templateID);	
				$skill_data = $database->resultset();					
				
				$database = new Database;						
				$database->query("SELECT * FROM template_requirements, template_requirements_index 
												WHERE template_requirements_index.templateID = :templateID
												AND template_requirements.reqID = template_requirements_index.reqID");
				$database->bind(':templateID', $templateID);	
				$requirement_data = $database->resultset();	
				
				$database = new Database;						
				$database->query("SELECT * FROM template_questions, template_question_index 
												WHERE template_question_index.templateID = :templateID
												AND template_questions.questionID = template_question_index.questionID");
				$database->bind(':templateID', $templateID);	
				$question_data = $database->resultset();	
				
				$template_data = array("general" => $general_data, "requirements" => $requirement_data, "questions" => $question_data, "skills" => $skill_data);
			break;
			
			case "all":
				$database = new Database;						
				$database->query("SELECT * FROM template_job WHERE main_skill = :main_skill ");
				$database->bind(':main_skill', "Kitchen");	
				$kitchen = $database->resultset();	

				$database = new Database;						
				$database->query("SELECT * FROM template_job WHERE main_skill = :main_skill ");
				$database->bind(':main_skill', "Server");	
				$server = $database->resultset();	

				$database = new Database;						
				$database->query("SELECT * FROM template_job WHERE main_skill = :main_skill ");
				$database->bind(':main_skill', "Bartender");	
				$bartender = $database->resultset();	

				$database = new Database;						
				$database->query("SELECT * FROM template_job WHERE main_skill = :main_skill ");
				$database->bind(':main_skill', "Manager");	
				$manager = $database->resultset();	

				$database = new Database;						
				$database->query("SELECT * FROM template_job WHERE main_skill = :main_skill ");
				$database->bind(':main_skill', "Host");	
				$host = $database->resultset();	

				$database = new Database;						
				$database->query("SELECT * FROM template_job WHERE main_skill = :main_skill ");
				$database->bind(':main_skill', "Bus");	
				$bus = $database->resultset();	
	
				$template_data = array("Kitchen" => $kitchen, "Server" => $server, "Bartender" => $bartender, "Manager" => $manager, "Host" => $host, "Bus" => $bus);				
			break;
		}
		
		return $template_data;
	}
	
	function get_job_template_skills($type) {	
		$database = new Database;						
		$database->query("SELECT * FROM employment_skill_template WHERE type = :type");
		$database->bind(':type', $type);	
		$skill_data = $database->resultset();	
		return $skill_data;	
	}	
	
	function get_job_template_requirements() {	
		$database = new Database;						
		$database->query("SELECT * FROM template_requirements");
		$requirement_data = $database->resultset();	
		return $requirement_data;	
	}
	
	function get_job_template_questions() {	
		$database = new Database;						
		$database->query("SELECT * FROM template_questions");
		$question_data = $database->resultset();	
		return $question_data;	
	}	
	
	function get_former_jobs() {
		$database = new Database;						
		$database->query("SELECT jobs.jobID, jobs.title, jobs.date_created, jobs_specialties.specialty, jobs.storeID FROM jobs, jobs_specialties
									WHERE jobs.userID = :userID
									AND jobs.jobID = jobs_specialties.jobID
									AND jobs.date_created BETWEEN NOW() - INTERVAL 60 DAY AND NOW() - INTERVAL 14 DAY 
									AND (jobs.job_status = :open OR jobs.job_status = :filled)
									AND jobs.code = :code");
		$database->bind(':userID', $_SESSION['userID']);	
		$database->bind(':open', 'Open');	
		$database->bind(':filled', 'Filled');	
		$database->bind(':code', 'B');	
									
		$job_list = $database->resultset();	
		return $job_list;			
	}
	
	function get_similar_jobs($broad_skill, $zip) {
		//get a list of similar jobs
		$utilities = new Utilities;
		
		$coordinates = $utilities->get_coordinates($zip);
		
		$longitude = $coordinates['longitude'];
		$latitude = $coordinates['latitude'];
		
		//40 mile appoximation, square
		$max_lat = $latitude + 0.57971;
		$min_lat = $latitude - 0.57971;
		$max_long = $longitude + 0.57827;
		$min_long = $longitude - 0.57827;
		
		//big set of selects, test for speed issues
		$database = new Database;						
		$database->query("SELECT jobs.jobID, jobs.title, jobs.date_created, stores.name, jobs.post_type, jobs.bounty, jobs.benefits, jobs.comp_type, jobs.comp_value, jobs.schedule
									FROM jobs, stores, jobs_specialties, zcta
									WHERE jobs.storeID = stores.storeID
									AND jobs_specialties.jobID = jobs.jobID
									AND jobs_specialties.specialty = :broad_skill
									AND (jobs.job_status = :open OR jobs.job_status = :filled)
									AND stores.zip = zcta.zip
									AND zcta.latitude BETWEEN :min_lat AND :max_lat
									AND zcta.longitude BETWEEN :min_long AND :max_long
									AND jobs.expiration_date >= NOW() - INTERVAL 90 DAY
									ORDER BY jobID DESC
									LIMIT 25");
		$database->bind(':broad_skill', $broad_skill);	
		$database->bind(':open', 'Open');	
		$database->bind(':filled', 'Filled');	
		$database->bind(':min_lat', $min_lat);
		$database->bind(':max_lat', $max_lat);
		$database->bind(':min_long', $min_long);
		$database->bind(':max_long', $max_long);			
		$job_list = $database->resultset();	
	
		if (count($job_list) > 0) {
			//determine amount of view and amount of applicants for each
			foreach($job_list as $key=>$row) {
				if ($row['jobID'] == $this->jobID) {
					unset($job_list[$key]);
				} else {
					$database->query("SELECT matchID FROM job_match_archive
												WHERE job_match_archive.jobID = :jobID
												AND job_match_archive.employee_interest = 'Y'");
					$database->bind(':jobID', $row['jobID']);								
					$response_count = count($database->resultset());	
					
					$database->query("SELECT userID FROM job_views
													WHERE jobID = :jobID 
													AND type = :type");						
					$database->bind(':jobID', $row['jobID']);								
					$database->bind(':type', 'qualified');								
					$view_result = $database->resultset();	
					$view_count = count($view_result);
	
					$job_list[$key]['response_count'] = $response_count;
					$job_list[$key]['view_count'] = $view_count;	
				}															
			}			
		} else {
			$job_list = "NA";
		}
		
		return $job_list;
	}
	
	function get_notes_list() {
		$database = new Database;						

		$database->query("SELECT members.userID, members.firstname, members.lastname, members.profile_pic, interview_notes.notes, interview_notes.culture, interview_notes.experience, interview_notes.availability, interview_notes.matchID  
									FROM interview_notes, members
									WHERE interview_notes.jobID = :jobID
									AND interview_notes.candidateID = members.userID");
		$database->bind(':jobID', $this->jobID);								
		$result = $database->resultset();	

		return $result;
	}
	
	function complete_check($jobID) {
		//make job is complete filled out, if so, change status, if not throw error
		$title_error = false;
		$store_error = false;
		$storeID_error = false;
		$main_skill_error = false;
		$comp_type_error = false;
		$comp_value_error = false;
		
		$error_text = "<div id='complete_error' style='color:red; float:left; width:100%; text-align:center;'>";
		
		$job_data = $this->get_job_data(array('general', 'store', 'skills'));
		
		$storeID							= $job_data['store']['storeID'];
		$title		 						= $job_data['general']['title'];
		$main_skill		 				= $job_data['skills']['main_skill']['specialty'];
		$schedule						= $job_data['general']['schedule'];
		$comp_type					= $job_data['general']['comp_type'];
		$comp_value					= $job_data['general']['comp_value'];

		//make sure title
		if ($title == "") {
			$title_error = true;
			$error_text .= "<b>Job Title cannot be blank. </b><br />";
		}
		
		if ($storeID == "") {
			$store_error = true;			
			$error_text .= "<b>Location cannot be blank. </b><br />";
		}
		
		if ($main_skill == "") {
			$main_skill_error = true;			
			$error_text .= "<b>An error has occurred, please start a new job post, or contact admin@servebartendcook.com. </b><br />";
		}

		if ($comp_type == "") {
			$comp_type_error = true;			
			$error_text .= "<b>Compensation cannot be blank. </b><br />";
		}
		
		//make sure comp_value isn't empty under certain condistions
		if ($comp_type == "Hourly" || $comp_type == "Salary") {
			if ($comp_value == "" || $comp_value == 0) {
				$comp_value_error = true;
				$error_text .= "<b>Compensation cannot be blank or $0. </b><br />";
			}
		}
		
		//make sure storeID is owned by user
		$database = new Database;
		$database->query('SELECT userID FROM stores WHERE storeID = :storeID');
		$database->bind(':storeID', $storeID);
		$result = $database->single();
		if ($result['userID'] != $_SESSION['userID']) {
			$storeID_error = true;
			$error_text .= "<b>An error has occurred, please start a new job post, or contact admin@servebartendcook.com. </b><br />";
		}
		
		$error_text .= "</div>";
		
		if ($title_error == true || $store_error == true || $storeID_error == true || $main_skill_error == true || $comp_type_error == true || $comp_value_error == true) {
			echo $error_text;
		} else {
			//update job status

//			$this->update_job("job_status", "free_final");

			echo "true";			
		}
	}
	
	function update_bounty_status($status_type, $input) {
		$database = new Database;												

		switch($status_type) {
			case "site":
				if ($input == "still_hiring") {
					//test to see if job has expired
					$database->query("SELECT jobID FROM jobs 
													WHERE jobID = :jobID
													AND expiration_date < NOW()");		
					$database->bind(':jobID', $this->jobID);			
					$result = $database->resultset();	
					echo count($result);
					//if so, push the notification back one day, if not, push it 4 days
					if (count($result) > 0) {
						$database->query("UPDATE jobs SET site_followup = NOW() + INTERVAL 1 DAY WHERE jobID = :jobID");		
						$database->bind(':jobID', $this->jobID);			
						$database->execute();							
					} else {
						$database->query("UPDATE jobs SET site_followup = NOW() + INTERVAL 4 DAY WHERE jobID = :jobID");		
						$database->bind(':jobID', $this->jobID);			
						$database->execute();													
					}
					
					//track the still hiring, for admin purposes
						$database->query("INSERT INTO still_hiring (jobID, userID, date)
														VALUES (:jobID, :userID, NOW())");		
						$database->bind(':jobID', $this->jobID);			
						$database->bind(':userID', $_SESSION['userID']);			
						$database->execute();													
				}
			break;
			
			case "hired":
				$database->query("UPDATE jobs SET bounty_status = :bounty_status WHERE jobID = :jobID");		
				$database->bind(':jobID', $this->jobID);			
				$database->bind(':bounty_status', $input);			
				$database->execute();	
			break;
			
		}
	}
		
	
	function confirm_hire($status, $hireID_array) {
		$database = new Database;												

		//update the status of the bounty recommendations

		//if the user previously confirmed someone hired, then unconfirmed, we need to change all Hired back to Accepted first, then change the statuses again
		$database->query("UPDATE bounty_recommendations
										SET recommend_status = :update_status
										WHERE jobID = :jobID
										AND recommend_status = :recommend_status");		
		$database->bind(':update_status', 'Accepted');			
		$database->bind(':jobID', $this->jobID);			
		$database->bind(':recommend_status', 'Hired');			
		$database->execute();	
		
		//Now loop through and set any selected candidates as hired

		if (count($hireID_array) > 0) {
			foreach($hireID_array as $row) {
				if ($row != "") {														
					$database->query("UPDATE bounty_recommendations
													SET recommend_status = :update_status,
														status_date = NOW()
													WHERE jobID = :jobID
													AND recommendedID = :userID
													AND recommend_status = :recommend_status");		
					$database->bind(':update_status', 'Hired');			
					$database->bind(':jobID', $this->jobID);			
					$database->bind(':userID', $row);				
					$database->bind(':recommend_status', 'Accepted');			
					$database->execute();	
				}
			}
		}
		
		//SEND NOTICES
		
		//if status complete, mark job as filled
		if ($status == 'complete') {
			$this->update_job('job_status', 'Filled');
			$this->update_bounty_status("hired", "closed");		
			
			//notify admin
			$message = new Message;
			$message->new_hire_notice($this->jobID);	
		} elseif ($status == 'open') {
			//leave job_status open, but move the followup date back
			$this->update_bounty_status("site", "still_hiring");
		}
	}
	
	function first_job_test() {
		//determine whether this is the first job posted by this user, if it is, email admin to let them know
		$job_details = $this->get_job_details('general');
		
		$userID = $job_details['userID'];
		
		$database = new Database;
		$database->query('SELECT jobID FROM jobs WHERE userID = :userID AND job_status = :job_status');
		$database->bind(':userID', $userID);
		$database->bind(':job_status', 'Open');
		$result = $database->resultset();
		if (count($result) == 1) {
			//send notice
			$store_details = $this->get_job_details('store');
			
			$message = new Message;
			
			$message->new_employer_job_post($job_details, $store_details);
		}
	}
	
	function get_archive_responses() {
		$database = new Database;
		$database->query("SELECT * FROM job_match_archive, members
									WHERE job_match_archive.jobID = :jobID
									AND job_match_archive.employee_interest = 'Y'
									AND job_match_archive.userID = members.userID");	
		$database->bind(':jobID', $this->jobID);
		$positive_list = $database->resultset();	
		
		return $positive_list;	
	}	
	
	function job_boost_paid($jobID, $boost_array, $checkout_amount, $phone, $transactionID) {
		$database = new Database;
		
		$checkout_amount = $checkout_amount / 100;
		
		//test to see if job is already boosted, if so, don't post, send error
		$database->query("SELECT boostID, boost_type FROM job_boost WHERE jobID = :jobID");	
		$database->bind(':jobID', $this->jobID);
		$result = $database->resultset();	

		$continue = 'Y';
		
		if (count($result) > 0) {
			foreach($result as $row) {
				foreach($boost_array as $boost_type) {
					if ($boost_type == $row) {
						$continue = "N";
					}
				}
			}
		}

		if(count($boost_array) > 0 && $continue == 'Y') {
			foreach($boost_array as $row) {
				$database->query('INSERT INTO job_boost
											(jobID, boost_type, date_created, payment_status, transactionID)
											VALUES (:jobID, :boost_type, NOW(), :payment_status, :transactionID)');
				$database->bind(':jobID', $this->jobID);			
				$database->bind(':boost_type', $row);			
				$database->bind(':payment_status', 'Y');			
				$database->bind(':transactionID', $transactionID);			
				$database->execute();	
			}

			$database->query("INSERT INTO stripe_payment 
										(userID, jobID, phone, transactionID, payment_amount, date)
										VALUES
										(:userID, :jobID, :phone, :transactionID, :checkout_amount, NOW())");
			$database->bind(':userID', $_SESSION['userID']);						
			$database->bind(':jobID', $this->jobID);
			$database->bind(':phone', $phone);
			$database->bind(':checkout_amount', $checkout_amount);
			$database->bind(':transactionID', $transactionID);
			$database->execute();	
			
			$receiptID = $database->lastInsertId();
			
			//unset tehy saved checkout data
			unset($_SESSION['boost'][$jobID]);
			
			return $receiptID;		
		} else {
			return "error";
			//return $continue.count($boost_array);
		}		
	}
	
	function job_post_paid($groupID, $checkout_amount, $phone, $transactionID) {
		$database = new Database;
		$checkout_amount = $checkout_amount / 100;

		//double check to make sure this person owns the group and get the jobID(s)

		$database->query("INSERT INTO stripe_payment 
									(userID, groupID, phone, transactionID, payment_amount, date)
									VALUES
									(:userID, :groupID, :phone, :transactionID, :checkout_amount, NOW())");
		$database->bind(':userID', $_SESSION['userID']);						
		$database->bind(':groupID', $groupID);
		$database->bind(':phone', $phone);
		$database->bind(':checkout_amount', $checkout_amount);
		$database->bind(':transactionID', $transactionID);
		$database->execute();	
		
		$receiptID = $database->lastInsertId();


		if ($groupID > 0) {

			$database = new Database;
			
			$database->query("SELECT max_posts FROM group_post WHERE groupID = :groupID AND userID = :userID");
			$database->bind(':userID', $_SESSION['userID']);						
			$database->bind(':groupID', $groupID);
			$result = $database->single();
			$max_posts = $result['max_posts'];
	
			$database->query("SELECT jobID FROM jobs WHERE groupID = :groupID AND userID = :userID");
			$database->bind(':userID', $_SESSION['userID']);						
			$database->bind(':groupID', $groupID);
			$job_list = $database->resultset();	
		
			if (count($job_list) == 0 || count($job_list) > $max_posts) {
				//error
				//email the error
			} else {
				//update and change status
				
				$database->query('UPDATE group_post SET post_status = :post_status, region_status = :region_status, date_posted = NOW()
											WHERE groupID = :groupID
											AND userID = :userID LIMIT 1');
				$database->bind(':post_status', 'posted');			
				$database->bind(':region_status', 'paid');			
				$database->bind(':groupID', $groupID);
				$database->bind(':userID', $_SESSION['userID']);						
				$database->execute();

				foreach($job_list as $row) {	
					$jobID = $row['jobID'];		
					$job = new Job($jobID);
			
					//update Job_Status
					$job->update_job("job_status", "Open");
					$job->update_job("creation_date", "");
					$job->update_job("expiration_date", "");	
				}
				
/*
				foreach($job_list as $row) {
					$match = new Match();
					$jobID = $row['jobID'];		
		
					$match->get_match_array($jobID);			
				}
*/
				
			}
		
			return $receiptID;		
		} else {
			return "error";
		}				
	}
	
	function job_post_free($groupID, $phone) {
		$database = new Database;

		//double check to make sure this person owns the group and get the jobID(s)

		if ($groupID > 0) {

			$database = new Database;
			
			$database->query("SELECT max_posts FROM group_post WHERE groupID = :groupID AND userID = :userID");
			$database->bind(':userID', $_SESSION['userID']);						
			$database->bind(':groupID', $groupID);
			$result = $database->single();
			$max_posts = $result['max_posts'];
	
			$database->query("SELECT jobID FROM jobs WHERE groupID = :groupID AND userID = :userID");
			$database->bind(':userID', $_SESSION['userID']);						
			$database->bind(':groupID', $groupID);
			$job_list = $database->resultset();	
		
			if (count($job_list) == 0 || count($job_list) > $max_posts) {
				//error
				$receiptID = "error";
				//email the error
			} else {			
					
				foreach($job_list as $row) {
/*
					$match = new Match();
					$jobID = $row['jobID'];		
					$match->get_match_array($jobID);			
*/
					$jobID = $row['jobID'];		
					$job = new Job($jobID);

					//update Job_Status
					$job->update_job("job_status", "Open");
					$job->update_job("creation_date", "");
					$job->update_job("expiration_date", "");	

				}	
				
				//update and change status
				
				$database->query('UPDATE group_post SET post_status = :post_status, region_status = :region_status, date_posted = NOW()
											WHERE groupID = :groupID
											AND userID = :userID LIMIT 1');
				$database->bind(':post_status', 'posted');			
				$database->bind(':region_status', 'free');			
				$database->bind(':groupID', $groupID);
				$database->bind(':userID', $_SESSION['userID']);						
				$database->execute();	
				
				$receiptID = "free";						
			}
			
			
			return $receiptID;		
		} else {
			return "error";
		}						
	}
	
	function update_group_post($groupID, $phone) {
		$database = new Database;

		//double check to make sure this person owns the group and get the jobID(s)

		if ($groupID > 0) {

			$database = new Database;
			
			$database->query("SELECT max_posts FROM group_post WHERE groupID = :groupID AND userID = :userID");
			$database->bind(':userID', $_SESSION['userID']);						
			$database->bind(':groupID', $groupID);
			$result = $database->single();
			$max_posts = $result['max_posts'];
	
			$database->query("SELECT jobID, job_status FROM jobs WHERE groupID = :groupID AND userID = :userID");
			$database->bind(':userID', $_SESSION['userID']);						
			$database->bind(':groupID', $groupID);
			$job_list = $database->resultset();	
			
			//since this is an update, make sure that the status of the group post is complete
			$database->query("SELECT post_status FROM group_post WHERE groupID = :groupID AND userID = :userID");
			$database->bind(':userID', $_SESSION['userID']);						
			$database->bind(':groupID', $groupID);
			$result = $database->single();
			$post_status = $result['post_status'];
					
			if (count($job_list) == 0 || count($job_list) > $max_posts || $post_status != "posted") {
				//error
				$receiptID = "error";
				//email the error
			} else {			
				
				//get expiration date for the new jobs
				$database->query("SELECT expiration_date FROM jobs WHERE groupID = :groupID 
											AND userID = :userID
											AND job_status = :job_status
											AND expiration_date > NOW()
											LIMIT 1");
				$database->bind(':userID', $_SESSION['userID']);						
				$database->bind(':groupID', $groupID);
				$database->bind(':job_status', "Open");
				$result = $database->single();
				$expiration_date = $result['expiration_date'];
					
					
				foreach($job_list as $row) {
					$match = new Match();

					if ($row['job_status'] != "Open" && $row['job_status'] != "Filled") {
						$jobID = $row['jobID'];		
						$match->get_match_array($jobID);
						
						//Overwrite expiration_date to match other posts in the group
						$database->query('UPDATE jobs SET expiration_date = :expiration_date
													WHERE jobID = :jobID
													AND userID = :userID LIMIT 1');
						$database->bind(':expiration_date', $expiration_date);			
						$database->bind(':jobID', $jobID);
						$database->bind(':userID', $_SESSION['userID']);						
						$database->execute();	
						
						//log the update
						$database->query("INSERT INTO group_post_update 
													(groupID, jobID, date_updated)
													VALUES
													(:groupID, :jobID, NOW())");
						$database->bind(':groupID', $groupID);
						$database->bind(':jobID', $jobID);
						$database->execute();							
					}		
				}	
				
				
				$receiptID = "update";						
			}
			
			return $receiptID;		
		} else {
			return "error";
		}						
	}	
	
	function get_receipt($receiptID) {
		$database = new Database;
		
		//get payment details
		$database->query('SELECT * FROM stripe_payment WHERE jobID = :jobID AND paymentID = :receiptID');
		$database->bind(':jobID', $this->jobID);
		$database->bind(':receiptID', $receiptID);
		$payment_data = $database->single();
		
		if (count($payment_data['jobID']) > 0) {
			//first list of boosts
			$database->query('SELECT * FROM job_boost WHERE jobID = :jobID AND transactionID = :transactionID');
			$database->bind(':jobID', $this->jobID);
			$database->bind(':transactionID', $payment_data['transactionID']);
			$boost_data = $database->resultset();
			
			$boost_array = array("boost_data" => $boost_data, "payment_data" => $payment_data);
			return $boost_array;
		} else {
			return "error";
		}		
	}
	
	function get_group_receipt($receiptID) {
		$database = new Database;
		
		//get payment details
		$database->query('SELECT * FROM stripe_payment WHERE paymentID = :receiptID');
		$database->bind(':receiptID', $receiptID);
		$payment_data = $database->single();
		
		return $payment_data;		
	}
	
	function get_receiptID($groupID) {
		$database = new Database;
		
		//get payment details
		$database->query('SELECT paymentID FROM stripe_payment WHERE groupID = :groupID');
		$database->bind(':groupID', $groupID);
		$receiptID = $database->single();
		
		return $receiptID;		
	}	
	
	
	function test_groupID($groupID, $storeID) {
		$database = new Database;

		$database->query('SELECT groupID, max_posts FROM group_post WHERE groupID = :groupID AND storeID = :storeID AND userID = :userID');
		$database->bind(':groupID', $groupID);
		$database->bind(':storeID', $storeID);
		$database->bind(':userID', $_SESSION['userID']);			
		$result = $database->resultset();

		if (count($result) == 0) {
			$valid_group = "N";			
		} else {
			foreach($result as $row) {
				$max_posts = $row['max_posts'];
			}
			
			//determine whether the max posts for this group has occurred
			$database->query('SELECT jobID FROM jobs WHERE groupID = :groupID');
			$database->bind(':groupID', $groupID);
			$job_list = $database->resultset();
			
			if (count($job_list) >= $max_posts) {
				$valid_group = "N";										
			} else {
				$valid_group = "Y";						
			}
		}
		
		return $valid_group;
	}
	
	function checkout_status($groupID) {
		//see if the user is allowed to checkout, or has already paid
		
		$database = new Database;

		$database->query('SELECT max_posts, post_status FROM group_post WHERE groupID = :groupID AND userID = :userID');
		$database->bind(':groupID', $groupID);
		$database->bind(':userID', $_SESSION['userID']);			
		$result = $database->resultset();

		if (count($result) == 0) {
			//INVALID
			$test = "error";			
		} else {
			foreach($result as $row) {
				$post_status = $row['post_status'];
				$max_posts = $row['max_posts'];
			}
			if ($post_status == "paid") {
				$test = "receipt";
			} else {
				//check number of jobs
				$database->query('SELECT jobID, job_status FROM jobs WHERE groupID = :groupID AND userID = :userID');
				$database->bind(':groupID', $groupID);
				$database->bind(':userID', $_SESSION['userID']);			
				$jobs = $database->resultset();
				
				switch($max_posts) {
					case "1":
						if (count($jobs) == 1) {
							$test = "checkout";
						} else {
							$test = "error";							
						}
					break;
					
					case "4":
						if (count($jobs) >= 2) {
							$test = "checkout";
						} else {
							$test = "error";							
						}					
					break;
					
					case "8":
						if (count($jobs) >= 2) {
							$test = "checkout";
						} else {
							$test = "error";							
						}										
					break;
				}
			}
		}
		
		return $test;
	}
}

?>