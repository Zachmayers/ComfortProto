<?php
require_once('mysqldb.class.php');	
require_once('utilities.class.php');
require_once('member.class.php');	
require_once('employee.class.php');	

class Candidate {

	public $userID;
	public $matchID;
	
	function __construct($matchID) {
		$this->matchID = $matchID;		
	}
		
	function get_candidate() {
		$utilities = new Utilities;
		$userID = $this->get_userID();
		
		$member = new Member($userID);
		$employee = new Employee($userID);
		
		$general_data = $member->get_member_data();
		$employee_data = $employee->get_employee_data();	
		$employment_gaps = $employee->determine_employment_gaps();
		$candidate_response = $this->get_candidate_data("response", $userID);	
		$answer_array = $this->get_candidate_data("answers", $userID);	
		$past_replies = $this->get_past_reply($userID);
		$notes = $this->get_candidate_notes($userID);
		$interview_schedule = $this->get_interview_schedule($userID);		
		$recommendation_details = $this->get_recommendation_details($userID);
		$notes = $this->get_notes($userID);		
		
		$candidate_array = array('general' => $general_data, 
											'employee_data' => $employee_data, 
											'employment_gaps' => $employment_gaps,
											'candidate_response' => $candidate_response, 
											'answer_array' => $answer_array,
											'past_replies' => $past_replies,
											'candidate_notes' => $notes,
											'interview_schedule' => $interview_schedule,
											'recommendation_details' => $recommendation_details,
											'notes' => $notes);								
		$utilities = new Utilities;
											
		return $candidate_array;	
	}
	
	private function get_candidate_data($type, $userID) {
		switch($type) {
			case "response":
				$database = new Database;
				$database->query('SELECT * FROM job_match WHERE userID = :userID AND matchID = :matchID');
				$database->bind(':userID', $userID);		
				$database->bind(':matchID', $this->matchID);		
				$result = $database->single();

				return $result;
			break;	
						
			case "answers":			
				$database = new Database;
				$database->query('SELECT * FROM job_match, job_questions, job_answers WHERE job_match.matchID = :matchID
											AND job_questions.jobID = job_match.jobID
											AND job_answers.questionID = job_questions.questionID
											AND job_answers.userID = job_match.userID');
				$database->bind(':matchID', $this->matchID);		
				$result = $database->resultset();	
				
				return $result;
			break;	
		}	
	}
	
	function get_recommendation_details($userID) {
		$database = new Database;
		$database->query('SELECT bounty_recommendations.ID, bounty_recommendations.userID, bounty_recommendations.coworker, bounty_recommendations.employer, bounty_recommendations.notes 
										FROM bounty_recommendations, job_match
										WHERE job_match.matchID = :matchID
										AND job_match.jobID = bounty_recommendations.jobID
										AND bounty_recommendations.recommendedID = :userID
										AND bounty_recommendations.recommend_status = :recommend_status');
		$database->bind(':matchID', $this->matchID);		
		$database->bind(':userID', $userID);		
		$database->bind(':recommend_status', 'Accepted');		
		$result = $database->single();
		
		if (isset($result['ID']) && $result['ID'] > 0) {
		
			$utilities = new Utilities;
			$employee = new Employee($result['userID']);
			$recommender_data = $employee->get_employee_data();
			
			$past_employment = $recommender_data['employment'];
			
			$hospitality_holder = array();
			$other_holder = array();	
			$unknown_holder = array();	
			
			$current_array = array();
			
			if (count($past_employment) > 0) {
				foreach($past_employment as $row) {
					//echo var_dump($row);
					if ($row['category'] == "other") {
						$other_holder[] = $row;
					} elseif ($row['category'] == "") {						
						$unknown_holder[] = $row;	
					} else {
						$hospitality_holder[] = $row;							
					}		
					
					if ($row['current'] == 'Y') {
						$current_array[] = $row;	
					}
				}
			}
			
			$total_experience['other'] = $utilities->determine_years_of_experience($other_holder);
			$total_experience['unknown'] = $utilities->determine_years_of_experience($unknown_holder);
			$total_experience['hospitality'] = $utilities->determine_years_of_experience($hospitality_holder);

			$recommendation = array( "firstname" => $recommender_data['general']['firstname'],
													"lastname" => $recommender_data['general']['lastname'],
													"coworker" => $result['coworker'],
													"employer" => $result['employer'],
													"notes" => $result['notes'],
													"experience" => $total_experience,
													"current" => $current_array);						
			
		} else {
			$recommendation = "NA";
		}
		
		return $recommendation;
	}
	
	function get_candidate_past_employment($filter_type, $filter) {
		$candidateID = $this->get_userID();
		
		$database = new Database;
		
		$past_employment = array();
		
		//for safety, we will not query the DB using any data that comes from a GET variable (the URL)
		//Although it is less effecient, it will reduce the chances of a user doing something strange by hard typing the URL
		
		switch($filter_type) {
			case "business_type":
				$database->query('SELECT * FROM previous_employment WHERE userID = :userID');
				$database->bind(':userID', $candidateID);		
				$result = $database->resultset();
					
				$employment_array = array();

				//due to ampersands
				$filter = html_entity_decode($filter);
				
				foreach($result as $row) {
					if ($row['business_type'] == $filter) {
						$employment_array[] = $row;
					}
				}	
			break;
			
			case "specific_business":
				$database->query('SELECT * FROM previous_employment AND userID = :userID');
				$database->bind(':userID', $candidateID);		
				$result = $database->resultset();		
				
				$employment_array = array();
				
				foreach($result as $row) {
					if ($row['ID'] == $filter) {
						$employment_array[] = $row;
					}
				}					
			break;
			
			case "specific_position":
				$database->query('SELECT * FROM previous_employment WHERE userID = :userID');
				$database->bind(':userID', $candidateID);		
				$result = $database->resultset();	
				
				$employment_array = array();

				//due to ampersands
				$filter = html_entity_decode($filter);
				
				foreach($result as $row) {
					if ($row['position'] == $filter) {
						$employment_array[] = $row;
					}
				}	
			break;					
			
			case "specific_skill":
				$employment_array = array();
				$database->query('SELECT * FROM sub_skills, previous_employment
												WHERE sub_skills.employmentID = previous_employment.ID
												AND sub_skills.employmentID != 0
												AND previous_employment.userID = :userID');
				$database->bind(':userID', $candidateID);	
				$result = $database->resultset();		
				$employment_array = array();
				
				//due to ampersands
				$filter = html_entity_decode($filter);
				
				foreach($result as $row) {
					if ($row['sub_skill'] == $filter) {
						$employment_array[] = $row;
					}
				}	
			break;								
		}
		
		if (count($employment_array) > 0) {
			foreach($employment_array as $key=>$row) {
				//get skills associated with jobs
				$database->query('SELECT * FROM sub_skills WHERE employmentID = :employmentID');
				$database->bind(':employmentID', $row['ID']);		
				$skill_array = $database->resultset();
				$past_employment[$key]['business'] = $row;
				$past_employment[$key]['skills'] = $skill_array;	
			}	
		} 
		return $past_employment;
	}
	
	function get_userID() {
		$database = new Database;
		$database->query('SELECT userID FROM job_match WHERE matchID = :matchID LIMIT 1');
		$database->bind(':matchID', $this->matchID);		
		$result = $database->single();	
		return $result['userID'];	
	}
	
	function get_jobID() {
		$database = new Database;
		$database->query('SELECT jobID FROM job_match WHERE matchID = :matchID LIMIT 1');
		$database->bind(':matchID', $this->matchID);		
		$result = $database->single();	
		return $result['jobID'];	
	}	
	
	function get_candidate_notes($userID) {

		$database = new Database;
		$database->query('SELECT notes, date FROM candidate_notes 
									WHERE matchID = :matchID
									AND candidateID = :candidateID
									AND employerID = :employerID');
		$database->bind(':matchID', $this->matchID);		
		$database->bind(':candidateID', $userID);		
		$database->bind(':employerID', $_SESSION['userID']);		
	
		$result = $database->single();	
		return $result;			
	}
	
	function get_interview_schedule($userID) {

		$database = new Database;
		$database->query('SELECT status, interviewID, matchID, interview_date, date_created FROM interview_confirmation 
									WHERE matchID = :matchID
									AND candidateID = :candidateID
									AND employerID = :employerID');									
		$database->bind(':matchID', $this->matchID);		
		$database->bind(':candidateID', $userID);		
		$database->bind(':employerID', $_SESSION['userID']);		
		$result = $database->single();	
		return $result;					
	}
	
	function get_notes($userID) {

		$database = new Database;
		$database->query('SELECT * FROM interview_notes 
									WHERE matchID = :matchID
									AND candidateID = :candidateID
									AND employerID = :employerID');									
		$database->bind(':matchID', $this->matchID);		
		$database->bind(':candidateID', $userID);		
		$database->bind(':employerID', $_SESSION['userID']);		
		$result = $database->single();	
		return $result;					
	}	
	
	function get_past_reply($userID) {
		//determine whether this person applied to a similar job for this location before
		
		$database = new Database;
		$database->query('SELECT jobs.storeID FROM job_match, jobs 
										WHERE job_match.matchID = :matchID
										AND job_match.jobID = jobs.jobID
										LIMIT 1');
		$database->bind(':matchID', $this->matchID);		
		$result = $database->single();	
		$storeID = $result['storeID'];	
		
		$database = new Database;
		$database->query('SELECT jobs.title, job_match.date_responded, job_match.matchID, job_match.highlight FROM job_match, jobs 
									 WHERE jobs.storeID = :storeID
									 AND jobs.jobID = job_match.jobID
									 AND job_match.userID = :userID
									 AND job_match.employee_interest = :interest
									 AND jobs.expiration_date BETWEEN NOW() - INTERVAL 90 DAY AND NOW()
									 AND job_match.matchID != :matchID');
		$database->bind(':storeID', $storeID);		
		$database->bind(':userID', $userID);
		$database->bind(':interest', 'Y');
		$database->bind(':matchID', $this->matchID);				
		$result = $database->resultset();

		return $result;
	}
	
	function get_archived_reply() {
		//determine whether this person applied to a similar job for this location before (in the archives)
		$userID = $this->get_userID();		
		
		$database = new Database;
		$database->query('SELECT jobs.storeID FROM job_match_archive, jobs 
										WHERE job_match_archive.matchID = :matchID
										AND job_match_archive.jobID = jobs.jobID
										LIMIT 1');
		$database->bind(':matchID', $this->matchID);		
		$result = $database->single();	
		$storeID = $result['storeID'];	
		
		$database = new Database;
		$database->query('SELECT jobs.title, job_match_archive.date_responded, job_match_archive.matchID, job_match_archive.highlight FROM job_match_archive, jobs 
									 WHERE jobs.storeID = :storeID
									 AND jobs.jobID = job_match_archive.jobID
									 AND job_match_archive.userID = :userID
									 AND job_match_archive.employee_interest = :interest
									 AND job_match_archive.matchID != :matchID');
		$database->bind(':storeID', $storeID);		
		$database->bind(':userID', $userID);
		$database->bind(':interest', 'Y');
		$database->bind(':matchID', $this->matchID);				
		$result = $database->resultset();

		return $result;
	}	
	
	function edit_notes($notesID, $candidateID, $matchID, $culture, $experience, $availability, $notes) {
		$utilities = new Utilities;
		$notes = $utilities->makeSafe_flat($notes);
		
		$jobID = $this->get_jobID();

		//check to see if notes already exist
		$database = new Database;	
		$database->query('SELECT ID FROM interview_notes
									 WHERE candidateID = :candidateID
									 AND matchID = :matchID
									 AND employerID = :employerID');
		$database->bind(':candidateID', $candidateID);		
		$database->bind(':matchID', $this->matchID);
		$database->bind(':employerID', $_SESSION['userID']);				
		$result = $database->resultset();

		if (count($result) > 0 && $notesID != "NA") {
			//update notes
			$database->query('UPDATE interview_notes
										 SET notes = :notes,
										 culture = :culture,
										 experience = :experience,
										 availability = :availability,
										 update_date = NOW()
										 WHERE matchID = :matchID
										 AND employerID = :employerID
										 AND candidateID = :candidateID');
			$database->bind(':notes', $notes);		
			$database->bind(':candidateID', $candidateID);		
			$database->bind(':matchID', $this->matchID);
			$database->bind(':employerID', $_SESSION['userID']);							
			$database->bind(':culture', $culture);		
			$database->bind(':experience', $experience);		
			$database->bind(':availability', $availability);		
		} else {
			//add notes
			$database->query('INSERT INTO interview_notes
											(matchID, jobID, employerID, candidateID, notes, culture, experience, availability, update_date)
										VALUES
											(:matchID, :jobID, :employerID, :candidateID, :notes, :culture, :experience, :availability, NOW())');
			$database->bind(':notes', $notes);		
			$database->bind(':jobID', $jobID);		
			$database->bind(':candidateID', $candidateID);		
			$database->bind(':matchID', $this->matchID);
			$database->bind(':employerID', $_SESSION['userID']);									
			$database->bind(':culture', $culture);		
			$database->bind(':experience', $experience);		
			$database->bind(':availability', $availability);		
		}	
		$database->execute();	
	}

	function highlight_toggle($highlight) {
			$database = new Database;	
			$database->query("UPDATE job_match SET highlight = :highlight WHERE matchID = :matchID LIMIT 1");		
			$database->bind(':matchID', $this->matchID);
			$database->bind(':highlight', $highlight);							
			$database->execute();		
			echo $this->matchID." ".$highlight;						
	}
	
	function candidate_viewed($matchID, $jobID) {
			$employeeID = $this->get_userID();
			
			$database = new Database;	
			$database->query("INSERT INTO candidate_views
										(employeeID, employerID, matchID, jobID, date)
										VALUES
										(:employeeID, :employerID, :matchID, :jobID, NOW())");		
			$database->bind(':matchID', $matchID);
			$database->bind(':employeeID', $employeeID);							
			$database->bind(':jobID', $jobID);							
			$database->bind(':employerID', $_SESSION['userID']);							
			$database->execute();				
	}
	
	function add_interview($matchID, $candidateID, $month, $day, $year, $hour, $minute, $ampm) {	
		$jobID = $this->get_jobID();		
			
		//convert date into datetime stamp
		$utilities = new Utilities;
		$date = $utilities->convert_datetime($month, $day, $year, $hour, $minute, $ampm);
		
		//test against current date
		date_default_timezone_set('America/Denver');		
		$current_date = date('Y-m-d');
				
		if ($date < $current_date) {
			return "past";			
		} else {
			
			//find difference between now and interview date
			$time_diff = strtotime($date) - strtotime($current_date);
			$date_diff = floor($time_diff / (60*60*24));
			
			if ($date_diff > 3) {
				//set notice date three days from interview
				$notice_date = strtotime('-3 day' , strtotime($date)) ;
				$notice_date = date ( 'Y-m-d' , $notice_date );
			} else {
				//set notice date one day from interview
				//set notice date three days from interview
				$notice_date = strtotime('-1 day' , strtotime($date)) ;
				$notice_date = date ( 'Y-m-d' , $notice_date );
			}
				
			$database = new Database;
			
			//for safety, make sure the matchID hasn't been used before, if so, just reload the page
			$database->query("SELECT interviewID FROM interview_confirmation WHERE matchID = :matchID");	
			$database->bind(':matchID', $matchID);							
			$result = $database->resultset();
			
			if (count($result) == 0) {
				//generate a random string, this is used for canceling interviews
				$hash = $utilities->generateRandomString(8);
				
				$database->query("INSERT INTO interview_confirmation
											(employerID, matchID, candidateID, jobID, status, interview_date, date_created, hash, site_notification_date, email_notification_date)
											VALUES
											(:employerID, :matchID, :candidateID, :jobID, :status, :interview_date, NOW(), :hash, :site_notification_date, :email_notification_date)");	
												
				$database->bind(':employerID', $_SESSION['userID']);							
				$database->bind(':matchID', $matchID);							
				$database->bind(':candidateID', $candidateID);							
				$database->bind(':jobID', $jobID);							
				$database->bind(':interview_date', $date);							
				$database->bind(':hash', $hash);							
				$database->bind(':site_notification_date', $notice_date);							
				$database->bind(':email_notification_date', $notice_date);							
				$database->bind(':status', 'notified');							
				$database->execute();
			}	
			
			return "good";
		}									
	}
	
	function edit_interview($matchID, $interviewID, $candidateID, $month, $day, $year, $hour, $minute, $ampm) {	
		//convert date into datetime stamp
		$utilities = new Utilities;
		$date = $utilities->convert_datetime($month, $day, $year, $hour, $minute, $ampm);

		//test against current date
		date_default_timezone_set('America/Denver');		
		$current_date = date('Y-m-d');

		if ($date < $current_date) {
			return "past";			
		} else {
			
			//find difference between now and interview date
			$time_diff = strtotime($date) - strtotime($current_date);
			$date_diff = floor($time_diff / (60*60*24));
			
			if ($date_diff >= 3) {
				//set notice date three days from interview
				$notice_date = strtotime('-3 day' , strtotime($date)) ;
				$notice_date = date ( 'Y-m-d' , $notice_date );
			} else {
				//set notice date one day from interview
				//set notice date three days from interview
				$notice_date = strtotime('-1 day' , strtotime($date)) ;
				$notice_date = date ( 'Y-m-d' , $notice_date );
			}
			
			echo $interviewID;
			
			$database = new Database;
			$database->query("UPDATE interview_confirmation								
										SET interview_date = :interview_date,
										status = :status,
										date_created = NOW(),
										site_notification_date = :site_notification_date,
										email_notification_date = :email_notification_date
										WHERE interviewID = :interviewID
										AND employerID = :employerID");		
			$database->bind(':employerID', $_SESSION['userID']);							
			$database->bind(':interview_date', $date);							
			$database->bind(':interviewID', $interviewID);	
			$database->bind(':site_notification_date', $notice_date);											
			$database->bind(':email_notification_date', $notice_date);											
			$database->bind(':status', 'notified');									
			$database->execute();	
			return "good";
		}									
	}
	
	function cancel_interview($matchID, $cancel_type) {
		$database = new Database;
		$database->query("UPDATE interview_confirmation								
									SET status = :status,
									status_date = NOW()
									WHERE matchID = :matchID");		
		//$database->bind(':userID', $_SESSION['userID']);							
		$database->bind(':matchID', $matchID);							
		$database->bind(':status', $cancel_type);							
		$database->execute();		
		
		if ($cancel_type == "employee_cancel") {
			//send an email notice to the employer
			//get employer info, job info, interview info, and candidate info
			
			//interview and job info
			$database->query('SELECT jobs.title, interview_confirmation.interview_date, interview_confirmation.employerID, interview_confirmation.candidateID FROM jobs, interview_confirmation
										 WHERE interview_confirmation.matchID = :matchID
										 AND interview_confirmation.jobID = jobs.jobID');
			$database->bind(':matchID', $this->matchID);
			$interview_details = $database->single();
			
			//employer info
			$database->query('SELECT firstname, lastname, email FROM members WHERE userID = :employerID');
			$database->bind(':employerID', $interview_details['employerID']);				
			$employer_details = $database->single();
			
			//employee info
			$database->query('SELECT firstname, lastname, email FROM members WHERE userID = :userID');
			$database->bind(':userID', $interview_details['candidateID']);				
			$employee_details = $database->single();
			
			echo var_dump($interview_details);
			echo var_dump($employer_details);
			echo var_dump($employee_details);
			
			$job_title = $interview_details['title'];
			$interview_date = date('M d, g:i A', strtotime($interview_details['interview_date']));

			
			$message = new Message;
			
			//send a message to the employer
			//$message->send_interview_cancellation_notice($job_title, $interview_date, $employer_details, $employee_details);
			
			//send a confirmation message to the employee
			//$message->send_interview_cancellation_confirmation($job_title, $interview_date, $employee_details);
			
		}	
	}	
	
	function update_interview_status($matchID, $status) {
		$database = new Database;
		
		if ($status == "site_three") {
			//update site status and set site notification date back
			//get interview date
			$database->query("SELECT interview_date FROM interview_confirmation WHERE matchID = :matchID");
			$database->bind(':matchID', $matchID);							
			$result = $database->single();							
			
			$notice_date = strtotime('-1 day' , strtotime($result['interview_date'])) ;
			$notice_date = date ( 'Y-m-d' , $notice_date );
			
			$database->query("UPDATE interview_confirmation								
										SET site_notice_status = :status,
										site_notification_date = :notification_date,
										status_date = NOW()
										WHERE matchID = :matchID");		
			$database->bind(':matchID', $matchID);							
			$database->bind(':status', $status);	
			$database->bind(':notification_date', $notice_date);	
						
		} elseif ($status == "site_one") {		
			$database->query("UPDATE interview_confirmation								
										SET site_notice_status = :status,
										status_date = NOW()
										WHERE matchID = :matchID");		
			$database->bind(':matchID', $matchID);							
			$database->bind(':status', $status);	
			
		} else {
			$database->query("UPDATE interview_confirmation								
										SET status = :status,
										status_date = NOW()
										WHERE matchID = :matchID");		
			$database->bind(':matchID', $matchID);							
			$database->bind(':status', $status);	
		}		
						
		$database->execute();			
	}		
	
	function verify_interview_hash($interviewID, $hash) {
		$database = new Database;
		$database->query("SELECT interviewID, status FROM interview_confirmation
										WHERE interviewID = :interviewID
										AND matchID = :matchID
										AND hash = :hash");		
		$database->bind(':interviewID', $interviewID);							
		$database->bind(':matchID', $this->matchID);							
		$database->bind(':hash', $hash);							
		$result = $database->resultset();			

		if (count($result) > 0) {
			foreach($result as $row) {
				$status = $row['status'];
			}
			if ($status == "notified") {
				return "true";			
			} else {
				return "false";
			}
		} else {
			return "false";
		}
	}
	
	function get_interview_data($interviewID) {
		$database = new Database;
		$database->query("SELECT interview_confirmation.interview_date, jobs.title, stores.name
										FROM interview_confirmation, jobs, stores
										WHERE interview_confirmation.interviewID = :interviewID
										AND interview_confirmation.matchID = :matchID
										AND interview_confirmation.jobID = jobs.jobID
										AND jobs.storeID = stores.storeID");		
		$database->bind(':interviewID', $interviewID);							
		$database->bind(':matchID', $this->matchID);							
		$result = $database->resultset();			
		
		if (count($result) > 0) {
			return $result;
		} else {
			return "NA";
		}
	}
	
	function legal_view_test($candidateID) {
		$database = new Database;
		$database->query('SELECT stores.userID, jobs.post_type, jobs.expiration_date FROM job_match, stores, jobs
									WHERE job_match.matchID = :matchID 
									AND job_match.userID = :candidateID
									AND job_match.employee_interest = :interest
									AND job_match.jobID = jobs.jobID
									AND stores.storeID = jobs.storeID
									LIMIT 1');
		$database->bind(':matchID', $this->matchID);		
		$database->bind(':candidateID', $candidateID);		
		$database->bind(':interest', "Y");		
		$result = $database->resultset();
		
		if (count($result) > 0) {
			foreach($result as $row) {
				$userID = $row['userID'];
				$post_type = $row['post_type'];
				$expiration_date = $row['expiration_date'];
			}
			
			if ($userID == $_SESSION['userID']) {
				//test expiration window
				//Free Jobs = 7 days after expiration
				//Pay Jobs = 14 days after expiration
				$expiration_date = strtotime($expiration_date);
				date_default_timezone_set('America/Los_Angeles');	
				$today = date('Y-m-d');

				if ($post_type == "bounty") {
					$window_date = date('Y-m-d', strtotime("+14 days", $expiration_date));	
					if ($today < $window_date) {
						$test = "valid";
					} else {
						$test = "invalid";
					}
				} else {
					$window_date = date('Y-m-d', strtotime("+7 days", $expiration_date));	
					if ($today < $window_date) {
						$test = "valid";
					} else {
						$test = "invalid";
					}								
				}
				
			} else {
				$test = "invalid";
			}
		} else {
			$test = "invalid";
		}

		return $test;
	}

	function public_view_test($candidateID, $hash) {
		$database = new Database;
		$database->query('SELECT userID FROM members
									WHERE userID = :candidateID 
									AND type = :type
									AND valid_hash = :hash
									AND valid = :valid
									AND public = :public');
		$database->bind(':candidateID', $candidateID);		
		$database->bind(':hash', $hash);		
		$database->bind(':type', "employee");		
		$database->bind(':public', "Y");		
		$database->bind(':valid', "Y");		
		$result = $database->resultset();
		
		if (count($result) > 0) {
			return "true";
		} else {
			return "false";
		}
	}
	
	function get_public_data($candidateID) {
		$member = new Member($candidateID);
		$employee = new Employee($candidateID);
		
		$general_data = $member->get_member_data();
		$employee_data = $employee->get_employee_data();	
		
		$employee_array = array("general_data" => $general_data, "employee_data" => $employee_data);
		
		return $employee_array;
	}
	
	function log_public_view($candidateID) {
		$database = new Database;
		$database->query('INSERT INTO public_candidate_view 
											(userID, view_date)
											VALUES
											(:candidateID, NOW())');	
		$database->bind(':candidateID', $candidateID);		
		$database->execute();
	}
	
}	
?>