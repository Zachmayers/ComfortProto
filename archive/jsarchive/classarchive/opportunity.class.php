<?php
require_once('mysqldb.class.php');	
require_once('utilities.class.php');	

require_once('message.class.php');	

class Opportunity {

	public $jobID;
	
	function __construct($jobID) {
		$this->opportunityID = $jobID;
	}
	
	function create_moment($payload) {
			$database = new Database;

			$low_timestamp = strtotime($payload['time']) - 59*60;
			$high_timestamp = strtotime($payload['time']) + 59*60;

			$low_time = date('H:i', $low_timestamp);
			$high_time = date('H:i', $high_timestamp);


			//test for duplicate/double book
			$database->query('SELECT momentID FROM moments
					  			      	 WHERE creatorID = :creatorID AND moment_date = :date 
											 AND moment_time BETWEEN :low AND :high');
					$database->bind(':creatorID', $payload['userID']);
					$database->bind(':date', $payload['date']);
					$database->bind(':low', $low_time);
					$database->bind(':high', $high_time);
			$result = $database->resultset();

					if (count($result) > 0) {
						return "doublebook";
					} else {
						$database->query('INSERT INTO moments
										(creatorID, moment_type, description, moment_date, moment_time, address, city, state, zip, regionID)
										VALUES (:creatorID, :moment_type, :description, :date, :time, :address, :city, :state, :zip, :regionID)');
						$database->bind(':creatorID', $payload['userID']);
						$database->bind(':moment_type', $payload['type']);
						$database->bind(':description', $payload['description']);
						$database->bind(':date', $payload['date']);
						$database->bind(':time', $payload['time']);
						$database->bind(':address', $payload['address']);
						$database->bind(':city', $payload['city']);
						$database->bind(':state', $payload['state']);
						$database->bind(':zip', $payload['zip']);
						$database->bind(':regionID', $payload['regionID']);

						$database->execute();
						$momentID = $database->lastInsertId();
						
						$database->query('INSERT INTO moment_track
										(momentID)
										VALUES (:momentID)');
						$database->bind(':momentID', $momentID);

						$database->execute();
						
						//$moment_array = array("momentID" => $momentID);
									
						//return $moment_array;
						return $momentID;
					}
		}

		function update_moment($payload) {
			$database = new Database;

			$database->query('UPDATE moments SET
			creatorID = :creatorID,
			moment_type = :moment_type,
			description = :description,
			moment_date = :moment_date, 
			moment_time = :moment_time,
			address = :address,
			city = :city, 
			state = :state,
			zip := zip, 
			regionID := regionID
			WHERE momentID = :momentID');
			$database->bind(':creatorID', $payload['userID']);
			$database->bind(':moment_type', $payload['type']);
			$database->bind(':description', $payload['description']);
			$database->bind(':date', $payload['date']);
			$database->bind(':time', $payload['time']);
			$database->bind(':address', $payload['address']);
			$database->bind(':city', $payload['city']);
			$database->bind(':state', $payload['state']);
			$database->bind(':zip', $payload['zip']);
			$database->bind(':regionID', $payload['regionID']);	
			$database->bind(':momentID', $payload['momentID']);	
			$database->execute();
		}

		function cancel_moment($momentID) {
			$database = new Database;

			$database->query('UPDATE moments SET
			status = :status
			WHERE momentID = :momentID');
			$database->bind(':status', "canceled");
			$database->bind(':momentID', $momentID);	
			$database->execute();
		}

		function rate_moment($payload) {
			$database = new Database;
			//make sure user has checked out of moment		
	
				$database->query('SELECT provider_checkout, client_checkout FROM moment_track
			  			      	 WHERE momentID = :momentID ');
				$database->bind(':momentID', $payload['momentID']);
				$result = $database->single();

			if ($payload['type'] == "client") {
				if (!is_null($result['client_checkout'])) {
					$database->query('UPDATE moment_track
						SET client_moment_rating = :rating, client_notes = :notes
						WHERE momentID = :momentID');
						$database->bind(':rating', $payload['rating']);
						$database->bind(':notes', $payload['notes']);
						$database->bind(':momentID', $payload['momentID']);
						$database->execute();
						return "True";
				} else {
					return "No Checkout Value";
				}
					

			} elseif ($payload['type'] == "provider") {
				$database->query('UPDATE moment_track
				SET provider_moment_rating = :rating, provider_notes = :notes
				WHERE momentID = :momentID');
				$database->bind(':rating', $payload['rating']);
				$database->bind(':notes', $payload['notes']);
				$database->bind(':momentID', $payload['momentID']);				
				$database->execute();
				return "True";
			}


		}	
	
		
	function get_opportunity_data() {
		$utilities = new Utilities;
		$job = new Job($this->opportunityID);
		
		$recommendation = "";
		
		$job_data = $job->get_job_data(array('general', 'store', 'employer', 'skills', 'requirements', 'question_list'));
		if (count($job_data['general']) == 0) {
			$job_status = array("status" => "false");
			$response_data = array();			
		} elseif ($job_data['general']['job_status'] == "Filled") {
			$job_status = array("status" => "filled");
			$response_data = array();	
		} elseif ($job_data['general']['job_status'] != "Open") {
			$job_status = array("status" => "false");
			$response_data = array();											
		} else {
			$job_status = $this->verify_job_status($job_data);
			
			//see if this user was recommended
			$recommendation = $this->get_recommendation_details();
		}
		
		if ($job_status['status'] == "match") {
			$response_data = $job_status['response'];
			$answer_data = $this->get_response("answers");
		} else {
			$response_data = array();
			$answer_data = $this->get_response("answers");		
		}
		
		$opportunity_data = array("job_data" => $job_data, "job_status" => $job_status, "response_data" => $response_data, "answer_data" => $answer_data, "recommendation" => $recommendation);											
		$utilities = new Utilities;

		return $opportunity_data;	
	}
	
	function get_group_jobs($groupID) {
		$database = new Database;
		$database->query("SELECT * FROM jobs WHERE groupID = :groupID");
		$database->bind(':groupID', $groupID);			
		$result = $database->resultset();
		
		return $result;
	}		
	
	private function verify_job_status($job_data) {	
		//TEST JOB EXPIRATION
		$expiration_date = $job_data['general']['expiration_date'];
		date_default_timezone_set('America/Denver');		
		$current_date = date('Y-m-d H:i:s');

		if ($current_date > $expiration_date) {
			$database = new Database;

			//special case, if the user has responded to this job, then return matched, so the user can view the details, if not return expired
			
			//first determine whether this is archived
			$database->query("SELECT * FROM job_match, jobs
										 WHERE job_match.userID = :userID
										 AND job_match.employee_interest = 'Y'
										 AND jobs.jobID = :jobID
										 AND job_match.jobID = :jobID");							
			$database->bind(':jobID', $this->opportunityID);		
			$database->bind(':userID', $_SESSION['userID']);		
			$result = $database->resultset();

			if (count($result) == 0) {
				//use the archive
				$database->query("SELECT * FROM job_match_archive, jobs
											 WHERE job_match_archive.userID = :userID
											 AND job_match_archive.employee_interest = 'Y'
											 AND jobs.jobID = :jobID
											 AND job_match_archive.jobID = :jobID");	
				$database->bind(':jobID', $this->opportunityID);		
				$database->bind(':userID', $_SESSION['userID']);		
				$result = $database->resultset();							 										
			} 		

			if (count($result) > 0) {
				foreach($result as $row) {
					$response = $row;
				}

				return array("status" => "expired_responded", "response" => $response);				
			} else {
				return array("status" => "expired");				
			}
			
		} elseif ($job_data['general']['job_status'] == "Removed"){
			//job has been removed
			return array("status" => "removed");			
		} else {
			//Test to see if this person is matched to this job
			$database = new Database;

			$database->query("SELECT * FROM job_match, jobs
										 WHERE job_match.userID = :userID
										 AND jobs.jobID = :jobID
										 AND job_match.jobID = jobs.jobID");		
			$database->bind(':jobID', $this->opportunityID);		
			$database->bind(':userID', $_SESSION['userID']);		
			$result = $database->resultset();
			if (count($result) > 0) {
				//get indicators
				foreach($result as $row) {
					$job_status = $row['job_status'];
					$employee_interest = $row['employee_interest'];
					$response = $row;
				}
				
				if ($job_status != "Open" || $employee_interest == "N") {
					return array("status" => "false");										
				} else {
					return array("status" => "match", "response" => $response);					
				}
			} else {
				//Find out if the user has declined this job
				$database = new Database;
				$database->query("SELECT job_match.matchID FROM job_match, jobs
											 WHERE jobs.job_status = 'Open'
											 AND job_match.userID = :userID
											 AND job_match.employee_interest = 'N'
											 AND jobs.jobID = :jobID
											 AND job_match.jobID = :jobID");		
				$database->bind(':jobID', $this->opportunityID);		
				$database->bind(':userID', $_SESSION['userID']);		
				$result = $database->resultset();
				
				if (count($result) > 0) {
					return array("status" => "false");				
				} else {
				
					//The user is not qualified for this job, return the reasons
					$utilities = new Utilities; 
					$employee = new Employee($_SESSION['userID']);
				
					$employee_data = $employee->get_employee_data();
					$user_zip = $employee_data['general']['zip'];
					$user_coordinates = $utilities->get_coordinates($user_zip);
					
					$store_zip = $job_data['store']['zip'];
					$store_coordinates = $utilities->get_coordinates($store_zip);
	
					$lat1 = $user_coordinates['latitude'];
					$lng1 = $user_coordinates['longitude'];
					
					$lat2 = $store_coordinates['latitude'];
					$lng2 = $store_coordinates['longitude'];
									
					$distance = $utilities->distance($lat1, $lng1, $lat2, $lng2);				
														
					if ($distance > 40) {
						$distance_flag = "Y";
					} else {
						$distance_flag = "N";
					}
					
					$member_skills = $employee_data['skills']['skills'];
					$skill_flag = "Y";
					
					foreach ($member_skills as $row) {
						if ($row['skill'] == $job_data['skills']['main_skill']['specialty']) {
							if ($row['seeking'] == "N") {
								$skill_flag = "Not Seeking";									
							} else {
								$skill_flag = "N";
								$skillID = $row['skillID'];
							}
						}
					}
	
					if ($skill_flag == "N") {
						//get sub_skills for comparison
						$member_sub_skills = $employee_data['skills']['sub_skills'];
						$required_skills_test_array = $job_data['skills']['required_sub_skills']['sub_specialty'];
	
/*
						if (count($required_skills_test_array) > 0) {
							foreach($required_skills_test_array as $key=>$row) {
								foreach($member_sub_skills as $skill) {
									if ($row['sub_specialty'] == $skill['sub_skill'] && $skill['skillID'] == $skillID) {
										unset($required_skills_test_array[$key]);
									}
								}
							}
						}
*/						
					} else {
						$required_skills_test_array = "N";
					}	
													
					$unqualified_reasons = array();
					$unqualified_reasons['skill_flag'] = $skill_flag; 
					$unqualified_reasons['required_skills'] = $required_skills_test_array;
					$unqualified_reasons['distance_flag'] =  $distance_flag;		
					
					$result = array("status" => "unqualified", "unqualified_reasons" => $unqualified_reasons);
					return $result;								
				}
			}
		}
	}
	
	private function get_response($type) {
		$database = new Database;
		
		switch($type) {
			case "response":
				$database->query("SELECT * FROM job_match WHERE jobID = :jobID AND userID =:userID");
				$database->bind(':jobID', $this->opportunityID);		
				$database->bind(':userID', $_SESSION['userID']);		
				$result = $database->single();
				
				if ($result === false) {
					$database->query("SELECT * FROM job_match_archive WHERE jobID = :jobID AND userID =:userID");
					$database->bind(':jobID', $this->opportunityID);		
					$database->bind(':userID', $_SESSION['userID']);		
					$result = $database->single();
				}
				return $result;				
			break;
			
			case "answers":
				$database->query("SELECT * FROM job_answers WHERE userID =:userID");
				$database->bind(':userID', $_SESSION['userID']);		
				$result = $database->resultset();	
				
				return $result;		
			break;
		}
	}
	
	function get_answers() {
		$database = new Database;

		$database->query("SELECT job_answers.answer, job_answers.answerID, job_answers.questionID 
										FROM job_answers, job_questions
										WHERE job_questions.jobID = :jobID 
										AND job_answers.questionID = job_questions.questionID
										AND job_answers.userID =:userID");
		$database->bind(':jobID', $this->opportunityID);		
		$database->bind(':userID', $_SESSION['userID']);		
		$result = $database->resultset();

		return $result;						
	}
	
	function public_opportunity_view($source, $medium, $campaign, $keyword) {
		$database = new Database;

		$database->query("INSERT INTO job_views
									(jobID, userID, type, source, medium, campaign, keyword, date)
									VALUES (:jobID, :userID, :type, :source, :medium, :campaign, :keyword, NOW())");		
		$database->bind(':jobID', $this->opportunityID);		
		$database->bind(':userID', "0");
		$database->bind(':type', 'qualified');
		$database->bind(':source', $source);
		$database->bind(':medium', $medium);
		$database->bind(':campaign', $campaign);
		$database->bind(':keyword', $keyword);

		$database->execute();	
	}	
	
	function update_opportunity($type, $input) {
		switch($type) {
			case "qualified_view":
					//log that the candidate has viewed the job
					$database = new Database;
					
					//check to see if they have already viewed
/*
					$response_data = $this->get_response("response");
					
					if ($response_data['date_viewed'] == 0) {	
						$database->query("UPDATE job_match
													SET date_viewed = NOW()
													WHERE userID = :userID
													AND jobID = :jobID ");		
						$database->bind(':jobID', $this->opportunityID);		
						$database->bind(':userID', $_SESSION['userID']);
						$database->execute();	
						
						//update live archive as well
						$database->query("UPDATE job_match_archive
													SET date_viewed = NOW()
													WHERE userID = :userID
													AND jobID = :jobID ");		
						$database->bind(':jobID', $this->opportunityID);		
						$database->bind(':userID', $_SESSION['userID']);
						$database->execute();									
					}
*/
					
					//tracking total number of times job was viewed
					$database->query("INSERT INTO job_views
												(jobID, userID, type, date)
												VALUES (:jobID, :userID, :type, NOW())");		
					$database->bind(':jobID', $this->opportunityID);		
					$database->bind(':userID', $_SESSION['userID']);
					$database->bind(':type', 'qualified');
					$database->execute();	
					
					//update bounty recommendation view, if necessary
					//only update if the view is currently set at notified			
/*
					$database->query("UPDATE bounty_recommendations
												SET recommend_status = :status
												WHERE recommendedID = :userID
												AND jobID = :jobID
												AND recommend_status = :recommend_status");	
					$database->bind(':status', "Viewed");															
					$database->bind(':jobID', $this->opportunityID);		
					$database->bind(':userID', $_SESSION['userID']);
					$database->bind(':recommend_status', "Notified");
					$database->execute();														
*/
			break;
			
			case "unqualified_view":
					//tracking total number of times job was viewed
					$database = new Database;
					$database->query("INSERT INTO job_views
												(jobID, userID, type, date)
												VALUES (:jobID, :userID, :type, NOW())");		
					$database->bind(':jobID', $this->opportunityID);		
					$database->bind(':userID', $_SESSION['userID']);
					$database->bind(':type', 'unqualified');
					$database->execute();							
			break;
			
			case "list_view":
					//tracking total number of times job was viewed
					//this is bogging down the site
/*
					$database = new Database;
					$database->query("INSERT INTO job_views
												(jobID, userID, type, date)
												VALUES (:jobID, :userID, :type, NOW())");		
					$database->bind(':jobID', $this->opportunityID);		
					$database->bind(':userID', $_SESSION['userID']);
					$database->bind(':type', 'list');
					$database->execute();							
*/
			break;							
			
			case "interested":
				//a new case needs to be added here, we need to allow people to apply even if they aren't matched, in case they have been recommended
				//In the long run, change job matching

				$database = new Database;
				
				//THIS IS INEFFICENT - CHANGE LATER
				//determing whether the user has been matched
				$database->query("SELECT matchID FROM job_match WHERE userID = :userID AND jobID = :jobID");	
				$database->bind(':jobID', $this->opportunityID);		
				$database->bind(':userID', $_SESSION['userID']);								
				$result = $database->resultset();	
				
				if (count($result) == 0) {
					//insert match
					//This means user has been recommended and/or doesn't match criteria, let them apply by creating match first
					$database->query("INSERT INTO job_match (jobID, userID, date_created)
												 VALUES (:jobID, :userID, NOW() )");			
					$database->bind(':userID', $_SESSION['userID']);
					$database->bind(':jobID', $this->opportunityID);
					$database->execute();
					
					$database = new Database;
					$database->query("INSERT INTO job_match_archive (jobID, userID, date_created)
												 VALUES (:jobID, :userID, NOW() )");			
					$database->bind(':userID', $_SESSION['userID']);
					$database->bind(':jobID', $this->opportunityID);
					$database->execute();																
				} 
				
				$database->query("UPDATE job_match SET employee_interest = 'Y', 
											message = :personal_message, 
											date_responded = NOW()
											WHERE jobID = :jobID
											AND userID = :userID ");	
				$database->bind(':personal_message', $input['personal_message']);		
				$database->bind(':jobID', $this->opportunityID);		
				$database->bind(':userID', $_SESSION['userID']);								
				$database->execute();	
				
				//update archive as well
				$database->query("UPDATE job_match_archive SET employee_interest = 'Y', 
											message = :personal_message, 
											date_responded = NOW()
											WHERE jobID = :jobID
											AND userID = :userID ");	
				$database->bind(':personal_message', $input['personal_message']);		
				$database->bind(':jobID', $this->opportunityID);		
				$database->bind(':userID', $_SESSION['userID']);
				$database->execute();						
							
				
				if ($input['questionID_1'] != "NA") {
					$database->query("INSERT INTO job_answers
												(questionID, userID, answer)
												VALUES (:questionID, :userID, :answer)");
					$database->bind(':questionID', $input['questionID_1']);		
					$database->bind(':answer', $input['answer_1']);		
					$database->bind(':userID', $_SESSION['userID']);
					$database->execute();				
				}	
				
				if ($input['questionID_2'] != "NA") {
					$database->query("INSERT INTO job_answers
												(questionID, userID, answer)
												VALUES (:questionID, :userID, :answer)");
					$database->bind(':questionID', $input['questionID_2']);		
					$database->bind(':answer', $input['answer_2']);		
					$database->bind(':userID', $_SESSION['userID']);
					$database->execute();				
				}													

				if ($input['questionID_3'] != "NA") {
					$database->query("INSERT INTO job_answers
												(questionID, userID, answer)
												VALUES (:questionID, :userID, :answer)");
					$database->bind(':questionID', $input['questionID_3']);		
					$database->bind(':answer', $input['answer_3']);		
					$database->bind(':userID', $_SESSION['userID']);
					$database->execute();				
				}
				
				//if the person was recommended, modify the recommendation according
				//only one or zero recommendation allowed per application
				//first, if there was a recommendID, change that status
				if ($input['recommendID'] != "none") {
					$this->update_opportunity("accept_recommendation", $input['recommendID']);		
				}
				
				$employee = new Employee($_SESSION['userID']);
				$employee->update_employee_record("ref_jobID", "NA", "");
				
				//send notification to employer
				$job = new Job($this->opportunityID);			
				$job_details = $job->get_job_data(array('general'));
				$employerID = $job_details['general']['userID'];
				
				$message = new Message;
				$test = $message->send_notification("employer_new_candidate", $this->opportunityID, $employerID);
				return $test;
			break;
			
			case "temp":
				$database = new Database;
				
				//determing whether the user has been matched
				$database->query("SELECT matchID FROM job_match WHERE userID = :userID AND jobID = :jobID");	
				$database->bind(':jobID', $this->opportunityID);		
				$database->bind(':userID', $_SESSION['tempID']);								
				$result = $database->resultset();	
				
				if (count($result) == 0) {
					//insert match
					//This means user has been recommended and/or doesn't match criteria, let them apply by creating match first
					$database->query("INSERT INTO job_match (jobID, userID, employee_interest, date_created, date_responded)
												 VALUES (:jobID, :userID, :employee_interest, NOW(), NOW() )");			
					$database->bind(':userID', $_SESSION['tempID']);
					$database->bind(':jobID', $this->opportunityID);
					$database->bind(':employee_interest', 'Y');
					$database->execute();
					
					$database = new Database;
					$database->query("INSERT INTO job_match_archive (jobID, userID, employee_interest, date_created, date_responded)
												 VALUES (:jobID, :userID, :employee_interest, NOW(), NOW() )");			
					$database->bind(':userID', $_SESSION['tempID']);
					$database->bind(':jobID', $this->opportunityID);
					$database->bind(':employee_interest', 'Y');
					$database->execute();																
				} 
											
				
				if ($input['questionID_1'] != "NA") {
					$database->query("INSERT INTO job_answers
												(questionID, userID, answer)
												VALUES (:questionID, :userID, :answer)");
					$database->bind(':questionID', $input['questionID_1']);		
					$database->bind(':answer', $input['answer_1']);		
					$database->bind(':userID', $_SESSION['tempID']);
					$database->execute();				
				}	
				
				if ($input['questionID_2'] != "NA") {
					$database->query("INSERT INTO job_answers
												(questionID, userID, answer)
												VALUES (:questionID, :userID, :answer)");
					$database->bind(':questionID', $input['questionID_2']);		
					$database->bind(':answer', $input['answer_2']);		
					$database->bind(':userID', $_SESSION['tempID']);
					$database->execute();				
				}													

				if ($input['questionID_3'] != "NA") {
					$database->query("INSERT INTO job_answers
												(questionID, userID, answer)
												VALUES (:questionID, :userID, :answer)");
					$database->bind(':questionID', $input['questionID_3']);		
					$database->bind(':answer', $input['answer_3']);		
					$database->bind(':userID', $_SESSION['tempID']);
					$database->execute();				
				}
				
				
				//send notification to employer
				$job = new Job($this->opportunityID);			
				$job_details = $job->get_job_data(array('general'));
				$employerID = $job_details['general']['userID'];
				
				$message = new Message;
				$test = $message->send_notification("employer_new_candidate", $this->opportunityID, $employerID);
				return $test;
			break;			
			
			case "accept_recommendation":
				$database = new Database;
				$database->query("UPDATE bounty_recommendations SET recommend_status = :recommend_status
											WHERE ID = :ID
											AND recommendedID = :userID");
				$database->bind(':ID', $input);		
				$database->bind(':userID', $_SESSION['userID']);		
				$database->bind(':recommend_status', 'Accepted');					
				$database->execute();		
			break;
			
			case "change_recommendation":
				$database = new Database;

				$database->query("UPDATE bounty_recommendations SET recommend_status = :new_status
											WHERE recommendedID = :userID
											AND jobID = :jobID
											AND recommend_status = :recommend_status");
				$database->bind(':jobID', $this->opportunityID);		
				$database->bind(':userID', $_SESSION['userID']);		
				$database->bind(':recommend_status', 'Accepted');					
				$database->bind(':new_status', 'Viewed');					
				$database->execute();		
				
				if ($input != "none") {
					$database->query("UPDATE bounty_recommendations SET recommend_status = :recommend_status
												WHERE ID = :ID
												AND recommendedID = :userID");
					$database->bind(':ID', $input);		
					$database->bind(':userID', $_SESSION['userID']);		
					$database->bind(':recommend_status', 'Accepted');					
					$database->execute();
				}		
			break;			
			
			case "decline":
				$database = new Database;
				$database->query("UPDATE job_match SET employee_interest = :interest,
											date_responded = NOW()
											WHERE jobID = :jobID
											AND userID = :userID ");
				$database->bind(':jobID', $this->opportunityID);		
				$database->bind(':interest', "N");
				$database->bind(':userID', $_SESSION['userID']);
				$database->execute();
				
				//update live archive as well
				$database = new Database;
				$database->query("UPDATE job_match_archive SET employee_interest = :interest,
											date_responded = NOW()
											WHERE jobID = :jobID
											AND userID = :userID ");
				$database->bind(':jobID', $this->opportunityID);		
				$database->bind(':interest', "N");
				$database->bind(':userID', $_SESSION['userID']);
				$database->execute();											
			break;	
		}		
	}
	
	function valid_public_opportunity($public_hash) {		
		$valid = "N";
		$continue = "Y";
		
		//make sure all variables are correct
		if (strlen($public_hash) != 12) {
			$continue = "N";
		}
		
		if ($continue == "Y") {
			//test ID vs hash
			$database = new Database;
			$database->query("SELECT jobID, expiration_date, job_status FROM jobs 
										WHERE jobID = :jobID
										AND public_hash = :public_hash
										AND (job_status = 'Open' OR job_status = 'Filled' OR job_status = 'Removed')");
			$database->bind(':jobID', $this->opportunityID);		
			$database->bind(':public_hash', $public_hash);
			$result = $database->resultset();

			if (count($result) == 1) {
				date_default_timezone_set('America/Los_Angeles');		
				$current_date =  date('Y-m-d H:i:s');
				foreach($result as $row) {
					$expiration_date = $row['expiration_date'];
					$status = $row['job_status'];
				}

				if ($status == "Filled") {
					$valid = "filled";
				} elseif ($status == "Removed") {
					$valid = "removed";
				} else {
					if ($current_date < $expiration_date) {
						$valid = "Y";					
					} else {			
						$valid = "expired";					
					}
				}
			} else {
				$valid = "N";
			}
		}
		return $valid;
	}	
	
	function log_job_share($jobID) {
		$database = new Database;
		
		if (isset($_SESSION['userID'])) {
			$userID = $_SESSION['userID'];
		} else {
			$userID = 0;
		}
		
		$database->query("INSERT INTO job_share_track
									(jobID, userID, date_shared)
									VALUES (:jobID, :userID, NOW())");
		$database->bind(':jobID', $jobID);		
		$database->bind(':userID', $userID);
		$database->execute();				
	}
	
	
	function report_inappropriate_content($ID, $type) {
		$message = new Message;
		$message->inappropriate_message($type, $ID, $_SESSION['userID']);
	}
	
	function opportunity_popularity() {
		$utilities = new Utilities;
		
		//determine how popular the job is, in terms of number of responses
		//this will be a function of average job responses over the last month for similar jobs
		
		//the average responses will also be split into time intervals to give a more realistic result
		//for example, if the job has only been posted for 12 hours, compare to the first 12 hours of other jobs
		//the first day will be split into quarters, then full days following
		
		//first determine how many days the job has been live, if less than 1, determine how many quarters
		
		
		//BORKED  - DIVIDE BY ZERO IN SOME CASES
/*
		$database = new Database;				
		$database->query("SELECT jobs.date_created, stores.zip, jobs_specialties.specialty FROM jobs, jobs_specialties, stores
												WHERE jobs.jobID = :jobID
												AND jobs_specialties.jobID = jobs.jobID
												AND jobs.storeID = stores.storeID");
		$database->bind(':jobID', $this->opportunityID);			
		$result = $database->single();
		
		$zip = $result['zip'];
		$specialty = $result['specialty'];
		$date_created = $result['date_created'];
		
		date_default_timezone_set('America/Denver');		
		$current_date = date('Y-m-d H:i:s');
		
		$date_created_mod = strtotime($date_created);
		$current_date_mod = strtotime($current_date);

		$date_diff = $current_date_mod - $date_created_mod;
		$hours = round($date_diff / 3600);
		if ($hours >= 24) {
			$interval_hours = $hours;
		} else {
			//round to the nearest 6 hours
			$new_interval = round($hours / 6);
			$interval_hours = $new_interval * 6;
		}
		
		$final_interval = $interval_hours*3600;
					
		$coordinates = $utilities->get_coordinates($zip);
				
		$longitude = $coordinates['longitude'];
		$latitude = $coordinates['latitude'];
		
		//40 mile appoximation, square
		$max_lat = $latitude + 0.57971;
		$min_lat = $latitude - 0.57971;
		$max_long = $longitude + 0.57827;
		$min_long = $longitude - 0.57827;

		$database->query("SELECT job_match_archive.jobID, jobs.date_created, job_match_archive.date_responded FROM jobs, job_match_archive, jobs_specialties, stores, zcta 
										WHERE job_match_archive.employee_interest = :employee_interest
										AND jobs_specialties.jobID = job_match_archive.jobID
										AND jobs.jobID = job_match_archive.jobID
										AND jobs.storeID = stores.storeID
										AND jobs_specialties.specialty = :specialty
										AND stores.zip = zcta.zip
										AND zcta.latitude BETWEEN :min_lat AND :max_lat
										AND zcta.longitude BETWEEN :min_long AND :max_long ");								
		$database->bind(':min_lat', $min_lat);
		$database->bind(':max_lat', $max_lat);
		$database->bind(':min_long', $min_long);
		$database->bind(':max_long', $max_long);
		$database->bind(':specialty', $specialty);
		$database->bind(':employee_interest', 'Y');
		$result = $database->resultset();
				
		if (count($result) > 0) {		
			//test_array
			$flat_array = array();
			foreach($result as $row) {
				$date_created = strtotime($row['date_created']);
				$date_responded = strtotime($row['date_responded']);
				
				$new_diff = $date_responded - $date_created;
								
				if ($new_diff <= $final_interval) {
					$flat_array[] = $row['jobID'];
				}				
			}
			
			
			$array_count = array_count_values($flat_array);
			
			$count = 0;
			foreach($array_count as $value) {
				$count = $count + $value;
			}	
			
			$average = $count / count($array_count);
			
			if ($average < 2) {
				return "NA";
			} else {
				$low_threshold = $average - (0.15 * $average);
				$high_threshold = $average + (0.15 * $average);
				
				$database = new Database;				
				$database->query("SELECT userID FROM job_match
												WHERE jobID= :jobID
												AND employee_interest = :employee_interest");
				$database->bind(':jobID', $this->opportunityID);			
				$database->bind(':employee_interest', 'Y');			
				$result = $database->resultset();
				
				$interest_count = count($result);
				
				if ($interest_count < $low_threshold) {
					return "low";
				} elseif ($interest_count > $high_threshold) {
					return "high";
				} else {
					return "average";
				}			
			}
		} else {
			return "NA";
		}
	}
*/
	
		return "NA";
	}
	
	function recommend_employee($email, $firstname, $lastname, $coworker, $employer) {
		$utilities = new Utilities;
				
		$error = "none";		

		//see if this person has already been recommended 
		$database = new Database;
		$database->query("SELECT ID FROM bounty_recommendations
										WHERE userID = :userID
										AND jobID = :jobID
										AND email = :email");
		$database->bind(':userID', $_SESSION['userID']);
		$database->bind(':jobID', $this->opportunityID);
		$database->bind(':email', $email);
		$result = $database->resultset();
		
		if (count($result) > 0) {
			$error = 'duplicate';	
		} else {
			$error = "none";
		} 
	
		if ($error == "none") {
			//determine whether this person exists in the database
			//first check to see if the email exists in the DB
			$database->query("SELECT userID, type, valid FROM members WHERE email = :email");
			$database->bind(':email', $email);
			$result = $database->single();
	
			$recommendedID = 0;

				
			if(isset($result['userID']) && $result['userID'] > 0) {
				$recommendedID = $result['userID'];
				if ($result['userID'] == $_SESSION['userID']) {
					$error = "self";
				} elseif ($result['type'] == "employer") {
					$error = "employer";
				} elseif ($result['valid'] == "N") {
					$error = "deactivated";
				}
			}
			
			if ($error == "none") {
				//get a randomized hash for the link to send out
				$hash = $utilities->generateRandomString(8);
							
				$database->query("INSERT INTO bounty_recommendations
											 (jobID, userID, email, firstname, lastname, recommendedID, coworker, employer, recommend_status, date, hash)
											 VALUES
											 (:jobID, :userID, :email, :firstname, :lastname, :recommendedID, :coworker, :employer, :recommend_status, NOW(), :hash)");									 
				$database->bind(':jobID', $this->opportunityID);		
				$database->bind(':userID', $_SESSION['userID']);
				$database->bind(':email', $email);
				$database->bind(':firstname', $firstname);
				$database->bind(':lastname', $lastname);
				$database->bind(':recommendedID', $recommendedID);
				$database->bind(':employer', $employer);
				$database->bind(':coworker', $coworker);
				$database->bind(':hash', $hash);
				$database->bind(':recommend_status', "Notified");
				$database->execute();	
				$ID = $database->lastInsertId();
									
				$database->query("SELECT bounty_recommendations.hash, bounty_recommendations.email_status, jobs.public_hash
											 FROM bounty_recommendations, jobs
											  WHERE bounty_recommendations.ID = :ID
											  AND jobs.jobID = bounty_recommendations.jobID");
				$database->bind(':ID', $ID);
				$result = $database->single();	

					//create link to replace span
					//$error = "<span id='recommend_link'>servebartendcook.com?recommendID=".$ID."&hash=".$result['hash']."</span>";
				
				//send recommendation email
				//first double check to make sure email hasn't been sent to avoid spamming (this may be done differently in the future)
				if ($result['email_status'] != "Sent") {
					$message = new Message;

					$message->send_recommendation_link($ID, $_SESSION['userID'], $email, $firstname, $lastname, $hash, $result['public_hash']);
					
					//set email status as sent
					$database->query("UPDATE bounty_recommendations SET email_status = :email_status WHERE ID = :ID");									 
					$database->bind(':ID', $ID);
					$database->bind(':email_status', "Sent");
					$database->execute();					
				}
			} 
		}
		
		return $error;
	}
	
	function remove_recommendation($type, $input) {
		$database = new Database;

		switch($type) {
			case "candidate":
				//candidate removes recommendation
				$database->query("UPDATE bounty_recommendations
											SET recommend_status = :status
											WHERE recommendedID = :userID
											AND ID = :recommendationID
											AND jobID = :jobID LIMIT 1");		
				$database->bind(':status', "Removed");			
				$database->bind(':jobID', $this->opportunityID);		
				$database->bind(':recommendationID', $input);		
				$database->bind(':userID', $_SESSION['userID']);
			break;
			
			case "recommender":
				//recommender rescinds recommendation
				$database->query("UPDATE bounty_recommendations
											SET recommend_status = :status
											WHERE userID = :userID
											AND jobID = :jobID LIMIT 1");		
				$database->bind(':status', "Rescinded");			
				$database->bind(':jobID', $this->opportunityID);		
				$database->bind(':userID', $_SESSION['userID']);				
			break;
		}
		
		$database->execute();	
	}
	
	function get_recommendation_details() {
		//determine whether this user has been recommended, if so, get the general details of the recommender
		$database = new Database;

		$database->query('SELECT ID, userID, coworker, employer, recommend_status
										FROM bounty_recommendations
										WHERE recommendedID = :userID
										AND jobID = :jobID');
		$database->bind(':userID', $_SESSION['userID']);
		$database->bind(':jobID', $this->opportunityID);
		$result = $database->resultset();

		if (count($result) > 0) {
			$utilities = new Utilities;

			foreach ($result as $row) {
				//get details for a summary of the recommenders profile
				$employee = new Employee($row['userID']);
				$recommender_data = $employee->get_employee_data();

				if ($recommender_data['general']['valid'] == 'Y') {
					$past_employment = $recommender_data['employment'];

					$hospitality_holder = array();
					$other_holder = array();	
					$unknown_holder = array();	
					
					$current_array = array();
					
					if (count($past_employment) > 0) {
						foreach($past_employment as $employment) {
							//echo var_dump($row);
							if ($employment['category'] == "other") {
								$other_holder[] = $employment;
							} elseif ($employment['category'] == "") {						
								$unknown_holder[] = $employment;	
							} else {
								$hospitality_holder[] = $employment;							
							}		
							
							if ($employment['current'] == 'Y') {
								$current_array[] = $employment;	
							}
						}
					}
					
					$total_experience['other'] = $utilities->determine_years_of_experience($other_holder);
					$total_experience['unknown'] = $utilities->determine_years_of_experience($unknown_holder);
					$total_experience['hospitality'] = $utilities->determine_years_of_experience($hospitality_holder);

					$recommendation[] = array( "ID" => $row['ID'],
															"recommend_status" => $row['recommend_status'],
															"firstname" => $recommender_data['general']['firstname'],
															"lastname" => $recommender_data['general']['lastname'],
															"coworker" => $row['coworker'],
															"employer" => $row['employer'],
															"experience" => $total_experience,
															"current" => $current_array);	
				} else {
					//deactivated profile recommended this person
					$recommendation[] = "NA";
				}
			}					
		} else {
			$recommendation = "NA";
		}
		
		return $recommendation;
	}
}
?>