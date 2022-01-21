<?php
require_once('mysqldb.class.php');	
require_once('utilities.class.php');
require_once('job.class.php');
require_once('member.class.php');
require_once('message.class.php');

class Match {
	
	function get_match_array($jobID) {
		$utilities = new Utilities;
		$job = new Job($jobID);
		$message = new Message;
		
		$job_data = $job->get_job_data(array('general', 'store', 'skills'));
//		if ($job_data['general']['job_status'] == 'checkout' || $job_data['general']['job_status'] == 'free_final') {
		if ($job_data['general']['job_status'] == 'checkout' || $job_data['general']['job_status'] == 'Open' || $job_data['general']['job_status'] == 'free_final' || $job_data['general']['job_status'] == 'template_edit' || $job_data['general']['job_status'] == 'custom_edit') {

			//echo "HERE";
			$duplicate_test = $this->duplicate_match_test($jobID);
		
			if ($duplicate_test == false) {
		
				$store_zip = $job_data['store']['zip'];
				$job_specialty = $job_data['skills']['main_skill']['specialty'];
				$required_skills = $job_data['skills']['sub_skills'];
			
				//get longitude and latitude for the store zip code
				$coordinates = $utilities->get_coordinates($store_zip);
				
				$longitude = $coordinates['longitude'];
				$latitude = $coordinates['latitude'];
				
				//40 mile appoximation, square
				$max_lat = $latitude + 0.57971;
				$min_lat = $latitude - 0.57971;
				$max_long = $longitude + 0.57827;
				$min_long = $longitude - 0.57827;

/*
				echo $max_lat;
				echo $min_lat;
				echo $max_long;
				echo $min_long;
*/
							
				$database = new Database;
									
				$database->query("SELECT members.userID, sub_skills.sub_skill FROM members, skills, sub_skills, zcta WHERE members.type = 'employee'
												AND members.valid = 'Y'
												AND members.profile_status = 'complete'
												AND members.email_validation = 'Y'
												AND skills.userID = members.userID
												AND skills.skill = :job_specialty
												AND skills.seeking = 'Y'
												AND skills.skillID = sub_skills.skillID
												AND members.zip = zcta.zip
												AND zcta.latitude BETWEEN :min_lat AND :max_lat
												AND zcta.longitude BETWEEN :min_long AND :max_long ");							
		
				$database->bind(':min_lat', $min_lat);
				$database->bind(':max_lat', $max_lat);
				$database->bind(':min_long', $min_long);
				$database->bind(':max_long', $max_long);
				$database->bind(':job_specialty', $job_specialty);
				$member_sub_skills = $database->resultset();	
			//	echo var_dump($member_sub_skills);
				//FLATTEN REQUIRED SKILLS ARRAY FOR TESTING		
		
				$reduced_member_array = array();
				
				//IMPORTANT THIS HAS BEEN IGNORED FOR THE UPDATE BECAUSE NEW SKILLS REPLACED OLD SKILLS
/*
				if (count($required_skills) > 0) {
					$required_skills_flat = array();
					foreach($required_skills as $row) {
						$required_skills_flat[] = $row['sub_specialty'];
					}
					
					foreach($member_sub_skills as $row) {
						if (in_array($row['sub_skill'], $required_skills_flat)) {
							$reduced_member_array[] = $row['userID'];
						}
					}
				} else {
					foreach($member_sub_skills as $row) {
						$reduced_member_array[] = $row['userID'];
					}			
				}
*/
				
				foreach($member_sub_skills as $row) {
					$reduced_member_array[] = $row['userID'];
				}						
				
				$member_list = array_unique($reduced_member_array);
				
				//NO LONGER WRITE MATCHES TO TABLE, JUST CREATE EMAIL QUEUE		
				// $this->insert_job_match_multiple_test($jobID, $member_list);
				
				//GO STRAIGHT HERE  **** COMPARE THIS WITH LIVE SITE  ******
				
				$message->email_queue_test($member_list, $jobID);	
				
				//update Job_Status
/*
				$job->update_job("job_status", "Open");
				$job->update_job("creation_date", "");
				$job->update_job("expiration_date", "");	
*/
				
				//if this is a bounty job, set the notice dates
				if ($job_data['general']['post_type'] == 'bounty') {
					$job->update_job("hire_notice_date", "");	
					
					//notify admins that a bounty job was posted			
					$message->new_bounty_post($job_data);

				}			
			}
		}
	}
	
	function get_matched_jobs($userID) {
		//This finds matched jobs based on a single user (used when a member completes their profile for the first time, or when they change something)
		$employee = new Employee($userID);
		$utilities = new Utilities;

		$employee_array = $employee->get_employee_data();	
		$user_coordinates = $utilities->get_coordinates($employee_array['general']['zip']);
		
		$user_lat = $user_coordinates['latitude'];
		$user_long = $user_coordinates['longitude'];
		
		$employee_skills = $employee_array['skills']['skills'];
		$employee_sub_skills = $employee_array['skills']['sub_skills'];
		
		$employee_skills_flat = array();
		foreach($employee_skills as $row) {
			if ($row['seeking'] == "Y") {
				$employee_skills_flat[] = $row['skill'];
			}
		}
		
		//set min and max coordinates for store radius (40 miles)
		$min_lat = $user_lat - 0.57971;
		$max_lat = $user_lat + 0.57971;
		$min_long = $user_long - 0.57827;
		$max_long = $user_long + 0.57827;

		$database = new Database;
		$database->query("SELECT jobs.jobID, jobs_specialties.specialty FROM jobs, stores, jobs_specialties, zcta WHERE jobs.Job_status = 'open'
							AND jobs.expiration_date > NOW()
							AND jobs.jobID = jobs_specialties.jobID
							AND jobs.storeID = stores.storeID
							AND stores.zip = zcta.zip
							AND zcta.latitude BETWEEN :min_lat AND :max_lat
							AND zcta.longitude BETWEEN :min_long AND :max_long ");							
		$database->bind(':min_lat', $min_lat);
		$database->bind(':max_lat', $max_lat);
		$database->bind(':min_long', $min_long);
		$database->bind(':max_long', $max_long);
		$job_array = $database->resultset();	

		if (count($job_array) > 0) {
			foreach($job_array as $key=>$row) {
					
					if (in_array($row['specialty'], $employee_skills_flat)) {
						//get flat array of member skills
						foreach($employee_skills as $skill) {
							if($skill['skill'] == $row['specialty']) {
								$skillID = $skill['skillID'];
							}
						}
						//echo var_dump($employee_sub_skills);
						$employee_sub_skills_flat = array();
						foreach($employee_sub_skills as $key=>$sub_skill) {
							if ($key == $skillID) {
							$inner_array = $employee_sub_skills[$key];
								foreach($inner_array as $inner) {
									$employee_sub_skills_flat[] = $inner['sub_skill'];
								}
							}
						}
						
						//GET THE REQUIRED SKILLS FOR THE JOB
						$job = new Job($row['jobID']);
						$job_data = $job->get_job_data(array('skills'));
						$job_sub_skills = $job_data['skills']['sub_skills'];
						
						$skill_count = 0;
						if (count($job_sub_skills) > 0) {
							foreach($job_sub_skills as $sub_skill) {
								if (in_array($sub_skill['sub_specialty'], $employee_sub_skills_flat)){
									$skill_count++;
								}
							}
						} else {
							$skill_count = 1;
						}
						
						if ($skill_count == 0) {
							unset($job_array[$key]);													
						}
					} else {
						unset($job_array[$key]);						
					}				
			}
		}

		foreach ($job_array as $row) {
			$duplicate_test = $this->duplicate_individual_test($row['jobID']);
			echo $row['jobID']." | ";
			if ($duplicate_test == "false") {
				$this->insert_job_match_single($row['jobID'], $userID);
			}
		}
	
	}	


	private function insert_job_match_multiple_test($jobID, $user_array) {
		//Re-assign array keys, in case some were removed suring duplicate testing
		$user_array = array_values($user_array);

		$database = new Database;
		$database->beginTransaction();		
		
		$database->query('INSERT INTO job_match (jobID, userID, date_created) 
									VALUES (:jobID, :userID, NOW() )');
		foreach($user_array as $row) {
			$database->bind(':userID', $row);			
			$database->bind(':jobID', $jobID);
			$database->execute();		
		}	
		
		$database->endTransaction();	
		
		//write to archive
		//to ensure there are no issues with matchID primary keys not matching in the archive and live table, query the table to get the data
		$database = new Database;
		$database->query('SELECT matchID, userID, date_created FROM job_match WHERE jobID = :jobID');
		$database->bind(':jobID', $jobID);
		$new_result = $database->resultset();
		
		$database = new Database;
		$database->beginTransaction();		
		$database->query('INSERT INTO job_match_archive (matchID, jobID, userID, date_created) 
									VALUES (:matchID, :jobID, :userID, :date_created)');
		foreach($new_result as $row) {
			$database->bind(':matchID', $row['matchID']);			
			$database->bind(':userID', $row['userID']);			
			$database->bind(':jobID', $jobID);
			$database->bind(':date_created', $row['date_created']);			
			$database->execute();		
		}	
		
		$database->endTransaction();	
			
		
		$message = new Message();
		//$message->email_queue($jobID);
				
		// USE THIS ONE $message->email_queue_test($user_array, $jobID);				
	}
		
	
	private function insert_job_match_multiple($jobID, $user_array) {
	
//==============
//! 		The number of rows being inserted varies based on the number of job matches
//    
//			Looping through them all ican be slow depending on number of rows, so we need to use multiple inserts in a single query
//
//			If there are a lot of rows to be inserted, we risk exceeding the max_packet_size for MYSQL and the query will fail
//
//			The solution is to break the query into batches of 200
//==============

		//Re-assign array keys, in case some were removed suring duplicate testing
		$user_array = array_values($user_array);


		//Next get the number of matches that will be inserted
		$total_matches = count($user_array);		
		$batches = $total_matches / 200;
		$batches = ceil($batches);	

		$match_counter = 0;
		$batch_counter = 0;
		
		
		$database = new Database;
//		$database->beginTransaction();
		
		for ($batch_counter = 1; $batch_counter <= $batches; $batch_counter++) {	
										
			$insert_counter = ($batch_counter -1)*200;
			//SET BATCH LIMITS
			if ($batch_counter < $batches) {
				$limit = $insert_counter + 199;
			} else {
				$limit = $total_matches;
			}
			
			$sql = "INSERT INTO job_match (jobID, userID, date_created) VALUES ";			
								
			for ($insert_counter = 0; $insert_counter < $total_matches; $insert_counter++) {
	
				$insertQuery[] = '(:jobID' . $insert_counter . ', :userID' . $insert_counter . ', NOW() ) ';
				
				$user_bind = ":userID".$insert_counter;
				$job_bind = ":jobID".$insert_counter;

				$database->bind($user_bind, $user_array[$insert_counter]);
				$database->bind($job_bind, $jobID);
				
			}	
			$sql .= implode(', ', $insertQuery);

			$database->query($sql);		
			$database->execute();	
		}
		
		//send the jobID to the message queue
		$message = new Message;
		//$message->email_queue('match', $jobID);
	}
	
	private function insert_job_match_single($jobID, $userID) {
		$database = new Database;
		$database->query("INSERT INTO job_match (jobID, userID, date_created)
									 VALUES (:jobID, :userID, NOW() )");			
		$database->bind(':userID', $userID);
		$database->bind(':jobID', $jobID);
		$database->execute();
		
		$database = new Database;
		$database->query("INSERT INTO job_match_archive (jobID, userID, date_created)
									 VALUES (:jobID, :userID, NOW() )");			
		$database->bind(':userID', $userID);
		$database->bind(':jobID', $jobID);
		$database->execute();												
	}
	
	private function duplicate_individual_test($jobID) {
		$database = new Database;
		$database->query("SELECT userID FROM job_match 
									WHERE userID = :userID
									AND jobID = :jobID ");		
		$database->bind(':userID', $_SESSION['userID']);
		$database->bind(':jobID', $jobID);
		$result = $database->resultset();	
		$duplicate = count($result);	
		
		if ($duplicate > 0) {
			return "true";
		} else {
			return "false";
		}
	}
	
	private function duplicate_match_test($jobID) {
		$database = new Database;
		$database->query("SELECT jobID FROM job_match 
									WHERE jobID = :jobID LIMIT 1");		
		$database->bind(':jobID', $jobID);
		$result = $database->resultset();	
		$duplicate = count($result);	
		
		if ($duplicate > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function new_location_filter($userID) {
		//a person has moved locations on their account.  check old matches, if they are not within the new region; hide them	
		$utilities = new Utilities;
		$database = new Database;
		
		//first set all matches to unhidden
		$database->query("UPDATE job_match 
									SET hidden = :hidden 
									WHERE userID = :userID
									AND date_created > DATE_SUB(NOW(), INTERVAL 1 MONTH)");		
		$database->bind(':hidden', "");
		$database->bind(':userID', $userID);
		$database->execute();	
		
		//get zip
		$database->query("SELECT zip FROM members WHERE userID = :userID LIMIT 1");		
		$database->bind(':userID', $userID);
		$result = $database->single();	
		$zip = $result['zip'];	
		
		//get current longitude and lattitude
		$coordinates = $utilities->get_coordinates($zip);
				
		$current_longitude = $coordinates['longitude'];
		$current_latitude = $coordinates['latitude'];
				
		//40 mile appoximation, square
		$max_lat = $current_latitude + 0.57971;
		$min_lat = $current_latitude - 0.57971;
		$max_long = $current_longitude + 0.57827;
		$min_long = $current_longitude - 0.57827;

		
		//get all matches
		$database->query("SELECT zcta.longitude, zcta.latitude, job_match.matchID
									FROM zcta, job_match, jobs, stores
									WHERE job_match.userID = :userID
									AND job_match.jobID = jobs.jobID
									AND stores.storeID = jobs.storeID
									AND job_match.employee_interest != :interest
									AND stores.zip = zcta.zip
									AND job_match.date_created > DATE_SUB(NOW(), INTERVAL 1 MONTH)");		
		$database->bind(':userID', $userID);
		$database->bind(':interest', 'Y');
		$result = $database->resultset();
		//echo var_dump($result);
		//create a match array for archive
		$match_array = array();

		//run a 40 mile test on each match
		foreach ($result as $row) {
			if ($row['longitude'] <= $max_long && $row['longitude'] >= $min_long && $row['latitude'] <= $max_lat && $row['latitude'] >= $min_lat) {
				//do nothing
			} else {
				$database->query("UPDATE job_match 
											SET hidden = :hidden 
											WHERE matchID = :matchID");		
				$database->bind(':hidden', "Y");
				$database->bind(':matchID', $row['matchID']);
				$database->execute();
				
				$match_array[] = $row['matchID'];					
			}
		}
		
		//update job_match archive
		foreach ($match_array as $row) {
			$database->query("UPDATE job_match_archive 
										SET hidden = :hidden 
										WHERE matchID = :matchID");		
			$database->bind(':hidden', "Y");
			$database->bind(':matchID', $row);
			$database->execute();		
		}
	}
		
}
?>