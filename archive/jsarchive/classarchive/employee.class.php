<?php
require_once('mysqldb.class.php');	
require_once('utilities.class.php');
require_once('match.class.php');	
	

class Employee {

	public $userID;
	
	function __construct($userID) {
		$this->userID = $userID;
	}
		
	function get_employee_data() {
		$database = new Database;
		
		$database->query('SELECT firstname, lastname, zip, email, contact_phone, profile_pic, ref_jobID, profile_status, last_login, current_login, email_setting, quote, description, valid, public
									FROM members 
									WHERE userID = :userID');
		$database->bind(':userID', $this->userID);
		$general_data = $database->single();
		
		$skill_array = $this->get_specific_employee_data("skills");
		$employment_array = $this->get_specific_employee_data("employment");
		$education_array = $this->get_specific_employee_data("education");	
		$certification_array = $this->get_specific_employee_data("certifications");	
		$award_array = $this->get_specific_employee_data("awards");	
		$languages_array = $this->get_specific_employee_data("languages");	
		$traits_array = $this->get_specific_employee_data("traits");	
// 		$video_array = $this->get_specific_employee_data("video");	
		$kitchen_photo_array = $this->get_specific_employee_data("kitchen_photos");			
		$bar_photo_array = $this->get_specific_employee_data("bar_photos");			
		$personal_message = $this->get_specific_employee_data("personal_message");			
// 		$gap_message = $this->get_specific_employee_data("gap_message");			
		$saved_answers = $this->get_specific_employee_data("saved_answers");
		$experience_overwrite = $this->get_specific_employee_data("experience_overwrite");

// 		$employment_version = $this->employment_version_check($employment_array);

		$employee_array = array('general' => $general_data, 
											'skills' => $skill_array, 
											'education' => $education_array, 
											'certifications' => $certification_array, 
											'awards' => $award_array, 
											'employment' => $employment_array,
											'languages' => $languages_array, 
											'traits' => $traits_array, 
											'kitchen_photos' => $kitchen_photo_array,
											'bar_photos' => $bar_photo_array,
											'personal_message' => $personal_message,
											'experience_overwrite' => $experience_overwrite,
											'saved_answers' => $saved_answers);
											
		$utilities = new Utilities;
		array_walk_recursive($employee_array, array($utilities, "makeSafe"));
											
		return $employee_array;	
	}
	
	function get_specific_employee_data($type) {
		$database = new Database;

		switch($type) {
			case "skills":
				//special case due to sub skills
				$database->query('SELECT * FROM skills WHERE userID = :userID');
				$database->bind(':userID', $this->userID);		
				$skill_array = $database->resultset();	
				
				$sub_skill_array = array();
				foreach ($skill_array as $skill) {
					$database->query('SELECT * FROM sub_skills WHERE skillID= :skillID');
					$database->bind(':skillID', $skill['skillID']);		
					$sub_skill_array[$skill['skillID']] = $database->resultset();	
				}
				
				//skills based on employment, above will be partially phased out
				//because the initial design is a bit flawed, the below query needs to be complex
				$database->query('SELECT sub_skills.employmentID, sub_skills.sub_skill FROM sub_skills, previous_employment
												 WHERE previous_employment.userID = :userID
												 AND sub_skills.employmentID = previous_employment.ID
												 AND sub_skills.employmentID > 0');
				$database->bind(':userID', $this->userID);		
				$employment_skill_array = $database->resultset();				
								
				$result = array("skills" => $skill_array, "sub_skills" => $sub_skill_array, "employment_skills" => $employment_skill_array);
			break;	
			
			case "sub_skills":
				$database->query('SELECT * FROM sub_skills WHERE userID = :userID');
			break;			
						
			case "employment":
				$database->query('SELECT * FROM previous_employment WHERE userID = :userID ORDER BY start_year DESC, start_month DESC');
			break;

			case "experience_overwrite":
				//this is for users who overwrite the calculate years of experience
				$database->query('SELECT * FROM experience_overwrite WHERE userID = :userID AND overwrite = :overwrite');
				$database->bind(':userID', $this->userID);		
				$database->bind(':overwrite', 'Y');		

				$result = $database->resultset();
				if (count($result) == 0) {
					$result = "NA";
				} else {
					foreach($result as $row) {
						$total = $row['total'];
						$hospitality = $row['hospitality'];
					}
					
					$result = array("total" => $total, "hospitality" => $hospitality);
				}				
				
			break;
			
			case "education":
				$database->query('SELECT * FROM education WHERE userID = :userID');			
			break;
			
			case "certifications":
				$database->query('SELECT * FROM certifications WHERE userID = :userID');			
			break;	

			case "awards":
				$database->query('SELECT * FROM awards WHERE userID = :userID');			
			break;				
						
			case "languages":
				$database->query('SELECT * FROM languages WHERE userID = :userID');			
			break;
			
			case "traits":
				$database->query('SELECT * FROM traits WHERE userID = :userID');			
			break;			
			
			case "video":
				$database->query('SELECT * FROM videos WHERE userID = :userID');			
			break;	
			
			case "kitchen_photos":
				$database->query('SELECT * FROM photo_gallery WHERE type = "kitchen" AND deleted = "N" AND userID = :userID');			
			break;	
			
			case "bar_photos":
				$database->query('SELECT * FROM photo_gallery WHERE type = "bartender" AND deleted = "N" AND userID = :userID');			
			break;	
			
			case "personal_message":
				$database->query('SELECT * FROM employee_message WHERE userID = :userID');			
			break;		
			
			case "gap_message":
				$database->query('SELECT * FROM employee_gap_message WHERE userID = :userID');			
			break;		
						
			case "saved_answers":
				$database->query('SELECT * FROM employee_saved_answers WHERE userID = :userID');			
			break;				
		}
		
		if ($type != "skills" && $type != "experience_overwrite") {
			$database->bind(':userID', $this->userID);
			if ($type == "personal_message" || $type == "gap_message") {
				$result = $database->single();
			} else {
				$result = $database->resultset();				
			}
		}
		
		return $result;					
	}
	
	function get_employment_record($employmentID) {
		$database = new Database;

		$database->query('SELECT * FROM previous_employment WHERE ID = :employmentID
										AND userID = :userID');
		$database->bind(':employmentID', $employmentID);
		$database->bind(':userID', $this->userID);
		$employment_record = $database->single();
		
		//get subskills associated with ID
		$database->query('SELECT * FROM sub_skills WHERE employmentID = :employmentID');
		$database->bind(':employmentID', $employmentID);
		$sub_skill_array = $database->resultset();
		
		//get skills associated with job title in general
		if($employment_record['titleID'] != 0) {
			//get position type
			$database->query('SELECT type FROM employment_title_template WHERE titleID = :titleID');
			$database->bind(':titleID', $employment_record['titleID']);
			$title_type_array = $database->single();
			$title_type = $title_type_array['type'];
			
			$database->query('SELECT * FROM employment_skill_template WHERE type = :type');
			$database->bind(':type', $title_type);
			$template_skill_array = $database->resultset();			
		} else {
			//this condition, the job isn't associated with any specific title, it was "other" entered by user, but is associated with FOH, BOH or Management
			//get all skills, and the title_type will be the "category"

			//get title_type
			$title_type = $employment_record['category'];			
			
			//if title type is "Other", this is a non-restaurant job.  Return empty skills
			if ($title_type != "Other") {
				$database->query('SELECT * FROM employment_skill_template WHERE type = :type');
				$database->bind(':type', $title_type);
				$template_skill_array = $database->resultset();	
			} else {
				$template_skill_array = "";				
			}	
		}
		
		$result_array = array("employment_data" => $employment_record, "current_skills" => $sub_skill_array, "template_skills" => $template_skill_array, "type" => $title_type);
		
		return $result_array;
	}
	
	function get_past_employment_template($titleID) {
		$database = new Database;
		
		if (is_numeric($titleID) && $titleID > 0) {
			$database->query('SELECT * FROM employment_title_template WHERE titleID = :titleID');
			$database->bind(':titleID', $titleID);
			$general_data = $database->single();	
			
			$database->query('SELECT * FROM employment_skill_template WHERE type = :type');
			$database->bind(':type', $general_data['type']);
			$skill_array = $database->resultset();	
			
			return array("general_data" => $general_data, "skill_array" => $skill_array);			
		} else {
			return "error";
		}	
	}
	
	function get_employee_applications() {
		//statistics about specific employee
		
		//get 6-months of applications
		$database = new Database;

		$database->query('SELECT job_match.matchID, job_match.jobID, job_match.date_responded, jobs.title, stores.name
									FROM job_match, jobs, stores 
									WHERE job_match.userID = :userID
									AND job_match.employee_interest = :employee_interest
									AND job_match.jobID = jobs.jobID
									AND jobs.storeID = stores.storeID
									AND job_match.date_responded BETWEEN NOW() - INTERVAL 90 DAY AND NOW()');
		$database->bind(':userID', $this->userID);
		$database->bind(':employee_interest', 'Y');
		$application_array = $database->resultset();
		
		return $application_array;	
	}
	
	function get_employee_saved_answers() {
		$database = new Database;

		//get saved job answers
		$database->query('SELECT employee_saved_answers.answer, template_questions.question
									FROM employee_saved_answers, template_questions
									WHERE employee_saved_answers.userID = :userID
									AND employee_saved_answers.template_questionID = template_questions.questionID');
		$database->bind(':userID', $this->userID);
		$answer_array = $database->resultset();
		
		//get saved message
		$database->query('SELECT message FROM employee_message WHERE userID = :userID');
		$database->bind(':userID', $this->userID);
		$message = $database->single();

		$saved_answers = array("answers" => $answer_array, "message" => $message);
		
		return $saved_answers;			
	}

	function get_resume() {
		$database = new Database;

		$database->query('SELECT resume FROM members WHERE userID = :userID');
		$database->bind(':userID', $this->userID);
		$resume = $database->single();
		
		return $resume;
	}
		
	function get_recommendations($filter) {
		//find any bounty recommendations this user has received
		$database = new Database;

		$database->query('SELECT bounty_recommendations.userID, jobs.jobID, jobs.title, jobs.public_hash, stores.name
										FROM bounty_recommendations, jobs, stores
										WHERE bounty_recommendations.recommendedID = :userID
										AND jobs.jobID = bounty_recommendations.jobID
										AND stores.storeID = jobs.storeID
										ORDER BY bounty_recommendations.date_created DESC');
		$database->bind(':userID', $this->userID);
		$recommended_array = $database->resultset();

		if (count($recommended_array) > 0) {
			switch($filter) {
				default:
					foreach($recommended_array as $row) {
						if ($row['jobID'] == $filter) {
							$database->query('SELECT firstname, lastname FROM members WHERE userID = :userID');
							$database->bind(':userID', $row['userID']);
							$recommender_name = $database->single();	
							
							$recommended_details = array("name" => $recommender_name, "opportunity_details" => $row);																			
						}
					}
				break;
				
				case "current":
					$recommended_details = array();
					
					foreach($recommended_array as $row) {
						//check the status of job to make sure it has not expired and is still Open
						date_default_timezone_set('America/Denver');		
						$current_date = date('Y-m-d H:i:s');
						
						$database->query('SELECT expiration_date, job_status FROM jobs WHERE jobID = :jobID');
						$database->bind(':jobID', $row['jobID']);
						$job_status_array = $database->single();

						if ($current_date > $job_status_array['expiration_date']) {
							$job_status = "expired";
						} elseif ($job_status_array['job_status'] != "Open") {
							$job_status = "Filled";
						} else {
							$job_status = "Open";

			 				//get the user that recommended the job, first and last name
							$database->query('SELECT firstname, lastname FROM members WHERE userID = :userID');
							$database->bind(':userID', $row['userID']);
							$recommender_name = $database->single();	
							
							$recommended_details[] = array("name" => $recommender_name, "opportunity_details" => $row);												
						}						
					}				
				break;				
				
			}
			
			if (count($recommended_details) > 0) {
				return $recommended_details;
			} else {
				return "NA";
			}
		} else {
			return "NA";
		}				
	}
	
	function get_bounties() {
		$database = new Database;

		$database->query('SELECT bounty_recommendations.ID, bounty_recommendations.jobID, bounty_recommendations.firstname, bounty_recommendations.lastname, bounty_recommendations.email, bounty_recommendations.date, bounty_recommendations.email_status, bounty_recommendations.recommend_status, jobs.title, jobs.expiration_date, jobs.public_hash, jobs.bounty, jobs.bounty_status, stores.name
										FROM bounty_recommendations, jobs, stores
										WHERE bounty_recommendations.userID = :userID
										AND jobs.jobID = bounty_recommendations.jobID
										AND stores.storeID = jobs.storeID
										ORDER BY bounty_recommendations.date DESC');
		$database->bind(':userID', $this->userID);
		$bounty_array = $database->resultset();
		
		return $bounty_array;
	}
	
	function get_interview_reminders() {
		$database = new Database;
		$database->query('SELECT interview_confirmation.interviewID, interview_confirmation.matchID, interview_confirmation.jobID, stores.name, jobs.title, interview_confirmation.interview_date, interview_confirmation.status, jobs.public_hash, interview_confirmation.site_notification_date, interview_confirmation.site_notice_status
										FROM interview_confirmation, jobs, stores
										WHERE interview_confirmation.candidateID = :userID
										AND jobs.jobID = interview_confirmation.jobID
										AND stores.storeID = jobs.storeID
										AND interview_confirmation.interview_date >= NOW()');
		$database->bind(':userID', $this->userID);
		$upcoming_interviews = $database->resultset();

		$database->query('SELECT interview_confirmation.interviewID, interview_confirmation.matchID, interview_confirmation.jobID, stores.name, jobs.title, interview_confirmation.interview_date, jobs.public_hash
										FROM interview_confirmation, jobs, stores
										WHERE interview_confirmation.candidateID = :userID
										AND jobs.jobID = interview_confirmation.jobID
										AND stores.storeID = jobs.storeID
										AND interview_confirmation.interview_date BETWEEN NOW() - INTERVAL 7 DAY AND NOW()');
		$database->bind(':userID', $this->userID);
		$past_interviews = $database->resultset();
		
		$interview_reminders = array("upcoming" => $upcoming_interviews, "past" => $past_interviews);
		
		return $interview_reminders;	
	}
	
	function update_interview($interviewID, $status) {
		$database = new Database;
		$database->query('UPDATE interview_confirmation 
									SET status = :status, status_date = NOW()
									WHERE interviewID = :interviewID
									AND candidateID = :userID');
		$database->bind(':candidateID', $this->userID);
		$database->bind(':interviewID', $interviewID);
		$database->bind(':status', $status);
		$database->execute();
		
		if ($status == "cancel") {
			//email employer
		}
	}
	
	function get_match_types() {
		//get job types this user is seeking
		
		$database = new Database;
		$database->query('SELECT skill FROM skills WHERE userID = :userID AND seeking = :seeking');
		$database->bind(':userID', $this->userID);
		$database->bind(':seeking', 'Y');
		$seeking_array = $database->resultset();
		
		//flatten array
		$seeking = array();
		foreach($seeking_array as $row) {
			$seeking[] = $row['skill'];
		}
		
		return $seeking;
	}
	
	function get_notifications($user_info) {
		//check for notifications

		//three general classes of notifications
		//urgent notifications - these take over the main page
		//new notifications - these are on the main page, but are open when the user browses there the first time
		//old/general notifications - in closed notifications bars

		date_default_timezone_set('America/Denver');		
		$current_date = date('Y-m-d');
		
		//first check for urgent notifications
		//interview reminder
		$notification_array = array("urgent" => array(), "new" => array(), "general" => array());
		
		$interview_reminders = $this->get_interview_reminders();
		$notification_array['urgent']['interview_one'] = array();
		$notification_array['urgent']['interview_three'] = array();
		$notification_array['urgent']['interview_cancel'] = array();
		$notification_array['urgent']['urgent_count'] = 0;
		
		//check for interviews within 24 hours
//		echo var_dump($interview_reminders);
		foreach($interview_reminders['upcoming'] as $row) {
			if ($row['status'] == "employer_cancel" || $row['status'] == "view_employer_cancel") {
				$status = "employer_cancel";
			} else {
				$time_diff = strtotime($row['interview_date']) - strtotime($current_date);
				$date_diff = floor($time_diff / (60*60*24));
				if ($date_diff <= 3) {
					if ($date_diff <= 1) {
						$status = "one";
					} else {
						$status = "three";
					}
				} else {
					$status = "NA";
				}				
			}
//echo $date_diff;
			if ($status == "one") {
				if ($row['site_notice_status'] != "site_one" && $row['status'] != "employee_cancel" && $row['status'] != "view_employee_cancel") {
					$notification_array['urgent']['interview_one'][] = $row;
					$notification_array['urgent']['urgent_count']++;
				}
			} elseif ($status == "three") {
				if ($row['site_notice_status'] != "site_three" && $row['status'] != "employee_cancel" && $row['status'] != "view_employee_cancel") {			
					$notification_array['urgent']['interview_three'][] = $row;
					$notification_array['urgent']['urgent_count']++;	
				}	
			} elseif ($status == "employer_cancel") {
				if ($row['status'] != "view_employer_cancel") {
					$notification_array['urgent']['employer_cancel'][] = $row;
					$notification_array['urgent']['urgent_count']++;
				}
			}		
		}
	//echo var_dump($notification_array['urgent']);


		$notification_array['new']['recommendations'] = array();
		$notification_array['general']['recommendations'] = array();

		$notification_array['new']['new_count'] = 0;

		//get recommendations
		$bounty_recommendations = $this->get_recommendations("current");
		if ($bounty_recommendations != "NA") {
			//loop through and grab the new ones, put the others in general
			//test date created against last login
			foreach($bounty_recommendations as $row) {
				if ($row['date_created'] > $user_info['last_login']) {
					$notification_array['new']['recommendations'][] = $row;
					$notification_array['new']['new_count']++;					
				} else {
					$notification_array['general']['recommendations'][] = $row;					
				}
			}		
		}
		
		
				
		$utilities = new Utilities;

		$notification_array['general']['email_verification'] = $utilities->check_email_verification();
		$notification_array['general']['employment_version'] = $user_info['employment_version'];
		
		return $notification_array;
	}
	
	function employment_version_check($employment_array) {
		//this checks if the user has updated their previous employment to the newest version (DATE HERE)
		$version = "new";
		
		$new_count = 0;
		$old_count = 0;
		
		if (count($employment_array) == 0) {
			$version = "empty";
		} else {
			foreach($employment_array as $row) {
				if ($row['category'] == "") {
					$old_count++;
				} else {
					$new_count++;
				}
			}
		}
		
		if ($old_count > 0) {
			$version = "old";
		}
		
		return $version;
	}	
	

	function update_employee_record($type, $record_update, $recordID) {

		if ($_SESSION['userID'] == $this->userID && $_SESSION['type'] == "employee") {
			switch($type) {
				case "zip":
					$database = new Database;
					$database->query('UPDATE members SET zip = :zip WHERE userID = :userID');
					$database->bind(':zip', $record_update);
					$database->bind(':userID', $this->userID);
					$database->execute();						
				break;
				
				case "phone":
					$database = new Database;
					$database->query('UPDATE members SET contact_phone = :phone WHERE userID = :userID');
					$database->bind(':phone', $row);					
					$database->bind(':userID', $this->userID);
					$database->execute();						
				break;
				
				case "skill":
					$database = new Database;
					$database->query('UPDATE skills
												SET description = :description,
														experience = :experience,
														seeking = :seeking
												WHERE userID = :userID
												AND skillID = :skillID');
					$database->bind(':experience', $record_update['experience']);					
					$database->bind(':description', $record_update['description']);					
					$database->bind(':seeking', $record_update['seeking']);					
					$database->bind(':skillID', $recordID);				
					$database->bind(':userID', $this->userID);															
					$database->execute();	
					
					$this->log_update("update_skill");					
				break;
				
				case "seeking":
					$database = new Database;
					$database->query('UPDATE skills
												SET seeking = :seeking
												WHERE userID = :userID
												AND skillID = :skillID LIMIT 1');
					$database->bind(':seeking', $record_update['seeking']);					
					$database->bind(':skillID', $recordID);				
					$database->bind(':userID', $this->userID);															
					$database->execute();	
					
					$this->log_update("update_seeking");									
				break;
				
				case "education":
					$database = new Database;
					$database->query('UPDATE education
												SET school = :school,
													degree = :degree,
													type = :type
												WHERE userID = :userID
												AND ID = :educationID');
					$database->bind(':school', $record_update['school']);					
					$database->bind(':degree', $record_update['degree']);					
					$database->bind(':type', $record_update['type']);					
					$database->bind(':educationID', $recordID);				
					$database->bind(':userID', $this->userID);				
					$database->execute();						
					
					$this->log_update("update_education");
				break;
				
				case "certification":
					$database = new Database;
					$database->query('UPDATE certifications
												SET certification = :certification
												WHERE userID = :userID
												AND certificationID = :certificationID');
					$database->bind(':certification', $record_update);					
					$database->bind(':certificationID', $recordID);				
					$database->bind(':userID', $this->userID);				
					$database->execute();						
					
					$this->log_update("update_certification");		
				break;				
				
				case "award":
					$database = new Database;
					$database->query('UPDATE awards
												SET award = :award
												WHERE userID = :userID
												AND awardID = :awardID');
					$database->bind(':award', $record_update);					
					$database->bind(':awardID', $recordID);				
					$database->bind(':userID', $this->userID);				
					$database->execute();						
					
					$this->log_update("update_education");		
				break;
				
				case "descriptions":
					$database = new Database;
					$database->query('UPDATE members
												SET quote = :quote,
													description = :description
												WHERE userID = :userID');
					$database->bind(':quote', $record_update['quote']);					
					$database->bind(':description', $record_update['description']);					
					$database->bind(':userID', $this->userID);				
					$database->execute();						
					
					$this->log_update("update_descriptions");				
				break;
				
				case "employment":
					$database = new Database;
					
					//get broad job job category
					$database->query('SELECT category FROM employment_title_template WHERE titleID = :titleID');
					$database->bind(':titleID', $record_update['titleID']);					
					$result = $database->single();
					$title_type = $result['category'];					
					
					$database->query('UPDATE previous_employment
												SET 	company = :company,
														position = :position,
														start_month = :start_month,
														start_year = :start_year,
														end_month = :end_month,
														end_year = :end_year,
														current = :current,
														business_type = :business_type,
														titleID = :titleID,
														category = :title_type
												WHERE userID = :userID
												AND ID = :employmentID');
					$database->bind(':company', $record_update['company']);					
					$database->bind(':position', $record_update['position']);					
					$database->bind(':start_month', $record_update['start_month']);					
					$database->bind(':start_year', $record_update['start_year']);					
					$database->bind(':end_month', $record_update['end_month']);					
					$database->bind(':end_year', $record_update['end_year']);					
					$database->bind(':current', $record_update['current']);					
					$database->bind(':business_type', $record_update['business_type']);
					$database->bind(':titleID', $record_update['titleID']);					
					$database->bind(':title_type', $title_type);					
					$database->bind(':employmentID', $recordID);					
					$database->bind(':userID', $this->userID);				
					$database->execute();	
					
					$this->log_update("update_employment");	
					
					return $title_type;														
				break;
				
				case "add_work_category":
					//add a work category to an old past employment record
					$titleID = $record_update;
					
					$database = new Database;

					//if the position title is from a template, get the title and enter it
					//get job title associated with ID
					if (is_numeric($titleID)) {					
						$database->query('SELECT category FROM employment_title_template WHERE titleID = :titleID');
						$database->bind(':titleID', $titleID);			
						$result = $database->single();
						
						$category = $result['category'];				
					} else {
						$category = $titleID;
					}
												
					$database->query('UPDATE previous_employment
												SET titleID = :titleID, 
												category = :category
												WHERE ID = :recordID
												AND userID = :userID');
					$database->bind(':titleID', $titleID);			
					$database->bind(':category', $category);
					$database->bind(':userID', $this->userID);
					$database->bind(':recordID', $recordID);			
					$database->execute();					
				break;
				
				case "employment_old":
					$database = new Database;
					$database->query('UPDATE previous_employment
												SET 	company = :company,
														position = :position,
														start_month = :start_month,
														start_year = :start_year,
														end_month = :end_month,
														end_year = :end_year,
														current = :current,
														website = :website										
												WHERE userID = :userID
												AND ID = :employmentID');
					$database->bind(':company', $record_update['company']);					
					$database->bind(':position', $record_update['position']);					
					$database->bind(':start_month', $record_update['start_month']);					
					$database->bind(':start_year', $record_update['start_year']);					
					$database->bind(':end_month', $record_update['end_month']);					
					$database->bind(':end_year', $record_update['end_year']);					
					$database->bind(':current', $record_update['current']);					
					$database->bind(':website', $record_update['website']);					
					$database->bind(':employmentID', $recordID);					
					$database->bind(':userID', $this->userID);				
					$database->execute();	
					
					$this->log_update("update_employment");										
				break;
				
				case "fix_employment":
					$database = new Database;
					$database->query('UPDATE previous_employment
												SET 	start_month = :start_month,
														start_year = :start_year,
														end_month = :end_month,
														end_year = :end_year,
														current = :current
												WHERE userID = :userID
												AND ID = :employmentID');
					$database->bind(':start_month', $record_update['start_month']);					
					$database->bind(':start_year', $record_update['start_year']);					
					$database->bind(':end_month', $record_update['end_month']);					
					$database->bind(':end_year', $record_update['end_year']);					
					$database->bind(':current', $record_update['current']);					
					$database->bind(':employmentID', $recordID);					
					$database->bind(':userID', $this->userID);				
					$database->execute();	
					
					$this->log_update("update_employment");																								
				break;
				
				case "status":
					$database = new Database;
					$database->query('UPDATE members
												SET profile_status = :status									
												WHERE userID = :userID');
					$database->bind(':userID', $this->userID);				
					$database->bind(':status', $record_update);				
					$database->execute();						
				break;	
				
				case "email_setting":
					if ($record_update['setting'] == 'Y') {
						$setting = 'Y';
					} else {
						$setting = 'N';
					}
				
					$database = new Database;
					$database->query('UPDATE members
												SET email_setting = :email_setting								
												WHERE userID = :userID');
					$database->bind(':userID', $this->userID);				
					$database->bind(':email_setting', $setting);				
					$database->execute();	
					
					//Note the date that the change occured in the email_setting log
					if ($record_update['setting'] == 'N' || $record_update['setting'] == 'Y') {
						$sub_option = 0;
					} else {
						$sub_option = $record_update['setting'];
					}
					
					$database = new Database;
					$database->query('INSERT INTO email_notice_change_log (userID, email_setting, location, sub_option, date)
													VALUES (:userID, :email_setting, :location, :sub_option, NOW())');
					$database->bind(':userID', $this->userID);				
					$database->bind(':email_setting', $setting);				
					$database->bind(':location', 'profile');	
					$database->bind(':sub_option', $sub_option);												
					$database->execute();	
									
					switch($sub_option) {
						default:
							$days = 30;
						break;
						
						case "3":
							$days = 90;
						break;
					}
					
					$database = new Database;
					$database->query('SELECT userID FROM reminder_email WHERE userID = :userID');
					$database->bind(':userID', $this->userID);				
					$result = $database->resultset();							
					
					if ($sub_option == 0) {
						$database = new Database;
						$database->query('DELETE FROM reminder_email WHERE userID = :userID LIMIT 1');
						$database->bind(':userID', $this->userID);				
						$database->execute();											
					} else {
						if (count($result) == 0) {
							$database = new Database;
							$database->query('INSERT INTO reminder_email (userID, date_to_send, date_created)
															VALUES (:userID, DATE_ADD(current_date, INTERVAL :days DAY), NOW())');
							$database->bind(':userID', $this->userID);				
							$database->bind(':days', $days);				
							$database->execute();	
						} else {
								$database = new Database;
								$database->query('UPDATE reminder_email SET date_to_send = DATE_ADD(current_date, INTERVAL :days DAY), date_created = NOW()
																WHERE userID = :userID');
								$database->bind(':userID', $this->userID);				
								$database->bind(':days', $days);				
								$database->execute();								
						}						
					}				
										
				break;

				case "share_settings":
					if ($record_update['setting'] == 'Y') {
						$setting = 'Y';
					} else {
						$setting = 'N';
					}
				
					$database = new Database;
					$database->query('UPDATE members
												SET public = :public								
												WHERE userID = :userID');
					$database->bind(':userID', $this->userID);				
					$database->bind(':public', $setting);				
					$database->execute();	
					echo $setting;
					//Note the date that the change occured in the public_setting log					
					$database = new Database;
					$database->query('INSERT INTO public_profile_change (userID, change_to, date)
													VALUES (:userID, :change_to, NOW())');
					$database->bind(':userID', $this->userID);				
					$database->bind(':change_to', $setting);				
					$database->execute();	
				break;
				
				case "ref_jobID":
					$database = new Database;
					$database->query('UPDATE members
												SET ref_jobID = :ref_jobID								
												WHERE userID = :userID');
					$database->bind(':userID', $this->userID);				
					$database->bind(':ref_jobID', $record_update);				
					$database->execute();					
				break;											
			}
		} else {
			return "error";
		}
	}
	
	function add_employee_record($type, $data_record) {

		if ($_SESSION['userID'] == $this->userID && $_SESSION['type'] == "employee") {
			$database = new Database;
			
			switch($type) {
				case "skill":
					//Skill is now also job title, change made in update
					//check for duplicate
					$employee_data = $this->get_employee_data();
					$skill_array = $employee_data['skills']['skills'];
					$skill_test = true;
					
					foreach($skill_array as $row) {
						if ($row['skill'] == $data_record['specialty']) {
							$recordID = $row['skillID'];
							$skill_test = false;
						}
					}		
					
					if ($skill_test == true) {				
						$database->query('INSERT INTO skills (userID, skill, seeking) 
													VALUES (:userID, :skill, :seeking)');
						$database->bind(':userID', $this->userID);			
						$database->bind(':skill', $data_record['specialty']);
						$database->bind(':seeking', "Y");
						$database->execute();
							
						$recordID = $database->lastInsertId();		
						
						$this->log_update("add_skill");	
					}
					
					return $recordID;																											
				break;
				
				
				case "skill_old":
					//Special case for skill
				
					//CHECK FOR DUPLICATE SKILL IN DB
					$employee_data = $this->get_employee_data();
					$skill_array = $employee_data['skills']['skills'];
					$skill_test = true;

					foreach($skill_array as $row) {
						if ($row['skill'] == $data_record['specialty']) {
							$recordID = $row['skillID'];
							$skill_test = false;
						}
					}
					
					if ($skill_test == true) {
						$database->query('INSERT INTO skills (userID, skill, description, experience, seeking) 
													VALUES (:userID, :skill, :description, :experience, :seeking)');
						$database->bind(':userID', $this->userID);			
						$database->bind(':skill', $data_record['specialty']);
						$database->bind(':description', $data_record['description']);
						$database->bind(':experience', $data_record['experience']);
						$database->bind(':seeking', $data_record['seeking']);
						$database->execute();	
						return $database->lastInsertId();		
						
						$this->log_update("add_skill");															
					} else {
						//Duplicate, so update skill
						$this->update_employee_record("skill", $data_record, $recordID);
						return $recordID;
					}	
															
				break;
				
				case "certification":
					$database->query('INSERT INTO certifications (userID, certification)
										VALUES (:userID, :certification)');
					$database->bind(':userID', $this->userID);			
					$database->bind(':certification', $data_record);
					$database->execute();	
					
					$this->log_update("add_certification");									
				break;				
				
				case "education":
					$database->query('INSERT INTO education (userID, school, degree, type)
										VALUES (:userID, :school, :degree, :type)');
					$database->bind(':userID', $this->userID);			
					$database->bind(':school', $data_record['school']);
					$database->bind(':degree', $data_record['degree']);
					$database->bind(':type', $data_record['type']);
					$database->execute();	
					
					$this->log_update("add_education");									
				break;
				
				case "award":
					$database->query('INSERT INTO awards (userID, award) VALUES (:userID, :award)');
					$database->bind(':userID', $this->userID);			
					$database->bind(':award', $data_record);
					$database->execute();	
					
					$this->log_update("add_award");									
				break;				
				
				case "employment":
					$database->query('INSERT INTO previous_employment (userID, company, position, start_month, start_year, end_month, end_year, current, titleID, category, business_type)
												VALUES (:userID, :company, :position, :start_month, :start_year, :end_month, :end_year, :current, :titleID, :category, :business_type)');
					$database->bind(':userID', $this->userID);			
					$database->bind(':company', $data_record['company']);
					$database->bind(':position', $data_record['position']);
 					$database->bind(':start_month', $data_record['start_month']);
 					$database->bind(':start_year', $data_record['start_year']);
					$database->bind(':end_month', $data_record['end_month']);
					$database->bind(':end_year', $data_record['end_year']);
					$database->bind(':current', $data_record['current']);
					$database->bind(':titleID', $data_record['titleID']);			
					$database->bind(':category', $data_record['job_category']);
					$database->bind(':business_type', $data_record['business_type']);
					$database->execute();	
					
					$workID = $database->lastInsertId();		

					$this->log_update("add_employment");		
					
					return $workID;											
				break;
				
				case "video":
					$employee_data = $this->get_employee_data();
					$video_array = $employee_data['video'];
									
					if (count($video_array) > 0) {
						$database->query("UPDATE videos SET url = :url
													WHERE userID = :userID ");		
					} else {
						$database->query("INSERT INTO videos (userID, url) VALUES (:userID, :url)");		
					}	
					$database->bind(':userID', $this->userID);			
					$database->bind(':url', $data_record);			
					$database->execute();		
					
					$this->log_update("add_video");																
				break;				
			}

		} else {
			return "error";
		}	
	}	
		
	function add_employee_list_record($type, $member_update_array, $ID) {
		
		if ($_SESSION['userID'] == $this->userID && $_SESSION['type'] == "employee") {

			switch($type) {
				case "language":
					//REMOVE CURRENT LANGUAGES BEFORE WRITING NEW ONES
					$this->remove_employee_record("language_list", "");						
				
					foreach($member_update_array as $language) {
						echo $language;
						$database = new Database;
						$database->query('INSERT INTO languages (userID, lang) 
													VALUES (:userID, :language)');
						$database->bind(':userID', $this->userID);			
						$database->bind(':language', $language);	
						$database->execute();								
					}
				break;
				
				case "traits":
					//REMOVE CURRENT TRAITS BEFORE WRITING NEW ONES
					$this->remove_employee_record("trait_list", "");						
				
					foreach($member_update_array as $trait) {
						$database = new Database;
						$database->query('INSERT INTO traits (userID, trait) 
													VALUES (:userID, :trait)');
						$database->bind(':userID', $this->userID);			
						$database->bind(':trait', $trait);	
						$database->execute();								
					}
				break;				
				
				case "sub_skills":
					$skillID = $ID['skillID'];
					$workID = $ID['workID'];
					
					if ($ID > 0 && $ID != "error" && $ID != "") {
						//FIRST REMOVE ALL CURRENT SUB SKILLS ASSOCIATED WITH WORKID
						$this->remove_employee_record("sub_skills", $workID);

						foreach($member_update_array as $sub_skill) {
								$database = new Database;
								$database->query('INSERT INTO sub_skills (skillID, employmentID, sub_skill, userID) 
															VALUES (:skillID, :workID, :sub_skill, :userID)');
								$database->bind(':skillID', $skillID);			
								$database->bind(':workID', $workID);			
								$database->bind(':sub_skill', $sub_skill);
								$database->bind(':userID', $_SESSION['userID']);
								$database->execute();	
						}
						
						return "true";
						
					} else {
						return "error";
					}			
				break;				
				
				case "sub_skills_old":
					if ($ID > 0 && $ID != "error" && $ID != "") {
						//FIRST REMOVE ALL CURRENT SUB SKILLS ASSOCIATED WITH SKILL
						$this->remove_employee_record("sub_skills", $ID);
						echo count($member_update_array);
						foreach($member_update_array as $sub_skill) {
								$database = new Database;
								$database->query('INSERT INTO sub_skills (skillID, sub_skill) 
															VALUES (:skillID, :sub_skill)');
								$database->bind(':skillID', $ID);			
								$database->bind(':sub_skill', $sub_skill);
								$database->execute();	
						}
						
						return "true";
						
					} else {
						return "error";
					}			
				break;
				
			}			
			return "true";	
		} else {
			return "error";
		}
	}	
	
	function remove_employee_record($type, $recordID) {
		$database = new Database;
		$case_count = 0;
		
		switch($type) {
			case "language_list":
				//REMOVE ALL LANGUAGES
				$database->query('DELETE FROM languages WHERE userID = :userID');
				$database->bind(':userID', $this->userID);
				$case_count++;					
			break;
			
			case "trait_list":
				//REMOVE ALL TRAITS
				$database->query('DELETE FROM traits WHERE userID = :userID');
				$database->bind(':userID', $this->userID);
				$case_count++;					
			break;			
			
			case "skill":
				$database->query('DELETE FROM skills WHERE skillID = :skillID AND userID = :userID LIMIT 1');
				$database->bind(':skillID', $recordID);			
				$database->bind(':userID', $this->userID);
				
				$this->remove_employee_record("sub_skills", $recordID);	
				
				$this->log_update("remove_skill");
							
				$case_count++;					
			break;
			
			case "sub_skills":
				//REMOVE ALL SUB_SKILLS OF SPECIFIC WORK ID
				$database->query('DELETE FROM sub_skills WHERE employmentID = :workID');
				$database->bind(':workID', $recordID);			
				$case_count++;					
			break;
			
			case "sub_skills_old":
				//REMOVE ALL SUB_SKILLS OF SPECIFIC MAIN SKILL ID
				$database->query('DELETE FROM sub_skills WHERE skillID = :skillID');
				$database->bind(':skillID', $recordID);			
				$case_count++;					
			break;			
			
			case "certification_list":
				//REMOVE ALL CERTIFICATIONS FROM USER
				$database->query('DELETE FROM certifications WHERE userID = :userID');
				$database->bind(':userID', $this->userID);
				$case_count++;								
			break;				
	
			case "education":
				$database->query('DELETE FROM education WHERE ID = :educationID AND userID = :userID LIMIT 1 ');
				$database->bind(':educationID', $recordID);			
				$database->bind(':userID', $this->userID);
				
				$this->log_update("remove_education");
									
				$case_count++;					
			break;
			
			case "award":
				$database->query('DELETE FROM awards WHERE awardID = :awardID AND userID = :userID LIMIT 1 ');
				$database->bind(':awardID', $recordID);			
				$database->bind(':userID', $this->userID);
				
				$this->log_update("remove_award");
									
				$case_count++;					
			break;
			
			case "certification":
				$database->query('DELETE FROM certifications WHERE certificationID = :certificationID AND userID = :userID LIMIT 1 ');
				$database->bind(':certificationID', $recordID);			
				$database->bind(':userID', $this->userID);
				
				$this->log_update("remove_certification");
									
				$case_count++;					
			break;									
			
			case "employment":
				//to ensure there isn't any strange crossover, make sure the user owns this emplyment title
				$database->query('SELECT * FROM previous_employment WHERE ID = :employmentID AND userID = :userID ');
				$database->bind(':employmentID', $recordID);			
				$database->bind(':userID', $this->userID);
				$result = $database->resultset();
				
				if (count($result) == 1) {
					$database = new Database;
					$database->query('DELETE FROM previous_employment WHERE ID = :employmentID AND userID = :userID LIMIT 1 ');
					$database->bind(':employmentID', $recordID);			
					$database->bind(':userID', $this->userID);
					$database->execute();				

					//remove sub skills
					$this->remove_employee_record("sub_skills", $recordID);
					
					$this->log_update("remove_employment");
				} else {
					
				}
				
				$case_count = 0;
			break;
			
			case "employment_old":
				$database->query('DELETE FROM previous_employment WHERE ID = :employmentID AND userID = :userID LIMIT 1 ');
				$database->bind(':employmentID', $recordID);			
				$database->bind(':userID', $this->userID);
				
				$this->log_update("remove_employment");
				
				$case_count++;					
			break;			
			
			case "video":
				$database->query('DELETE FROM videos WHERE videoID = :videoID AND userID = :userID LIMIT 1 ');
				$database->bind(':videoID', $recordID);			
				$database->bind(':userID', $this->userID);
				
				$this->log_update("remove_video");
				
				$case_count++;								
			break;
		}
		
		if ($case_count > 0) {
			$database->execute();				
		}
	}
	
	function overwrite_experience($total, $hospitality) {
		$database = new Database;

		//if entry exists, update, otherwise enter	
		$database->query('SELECT * FROM experience_overwrite WHERE userID = :userID');
		$database->bind(':userID', $this->userID);
		$result = $database->resultset();
		
		if (count($result) > 0) {
			$database->query('UPDATE experience_overwrite 
										SET hospitality = :hospitality, total = :total, overwrite = :overwrite
										WHERE userID = :userID');
		} else {
			$database->query('INSERT INTO experience_overwrite (userID, hospitality, total, overwrite) 
										VALUES (:userID, :hospitality, :total, :overwrite)');
		}
		
		$database->bind(':userID', $this->userID);
		$database->bind(':hospitality', $hospitality);
		$database->bind(':total', $total);
		$database->bind(':overwrite', "Y");
		$database->execute();
	}
	
	function update_seeking_group($seeking_group, $not_seeking_group) {
		//first find ones to add
		//find ones to change to Y
		//find ones to change to N
		
		$database = new Database;

		//if entry exists, update, otherwise enter	
		$database->query('SELECT * FROM skills WHERE userID = :userID');
		$database->bind(':userID', $this->userID);
		$user_skills = $database->resultset();
		$user_skills_flat = array();
		if (count($user_skills) > 0) {
			foreach($user_skills as $row) {
				$user_skills_flat[] = $row['skill'];
			}
		}
		
				
		foreach($seeking_group as $key=>$skill) {
			if (count($user_skills_flat) > 0) {
				if (in_array($skill, $user_skills_flat)) {
					//switch to yes, then remove from array
					$database->query('UPDATE skills 
												SET seeking = :seeking
												WHERE userID = :userID
												AND skill = :skill');
					$database->bind(':userID', $this->userID);
					$database->bind(':skill', $skill);
					$database->bind(':seeking', "Y");
					$database->execute();
					unset($seeking_group[$key]);
				}
			}
		}
		
		foreach($not_seeking_group as $key=>$skill) {
			if (count($user_skills_flat) > 0) {
				if (in_array($skill, $user_skills_flat)) {
					//switch to yes, then remove from array
					$database->query('UPDATE skills 
												SET seeking = :seeking
												WHERE userID = :userID
												AND skill = :skill');
					$database->bind(':userID', $this->userID);
					$database->bind(':skill', $skill);
					$database->bind(':seeking', "N");
					$database->execute();
					
					unset($not_seeking_group[$key]);
				}
			}
		}

		//insert seeking	
		//echo var_dump($seeking_group);
		if (count($seeking_group > 0)) {	
			foreach($seeking_group as $skill) {
				$database->query('INSERT INTO skills  (userID, skill, seeking)
											VALUES (:userID, :skill, :seeking)');
				$database->bind(':userID', $this->userID);
				$database->bind(':skill', $skill);
				$database->bind(':seeking', "Y");
				$database->execute();
			}	
		}	
		
	}	
		
	function remove_photo($photoID) {
		$database = new Database;
		$employee_data = $this->get_employee_data() ;
		
		switch ($photoID) {
			case "profile":
				//GET NAME OF PROFILE PIC
				$photo_name = $employee_data['general']['profile_pic'];				
				
				//MOVE PHOTO TO DELETED FOLDER																			
				rename("images/profile_pics/".$photo_name, "images/profile_pics/deleted/".$photo_name);																											

				$database->query('UPDATE members
											SET profile_pic = ""									
											WHERE userID = :userID');
				$database->bind(':userID', $this->userID);				
				$database->execute();	
				
				$this->log_update("remove_profile_photo");													
			break;
		
			default:	
				$database->query('UPDATE photo_gallery
											SET deleted = "Y"
											WHERE photoID = :photoID
											AND userID = :userID LIMIT 1');
				$database->bind(':photoID', $photoID);				
				$database->bind(':userID', $this->userID);				
				$database->execute();				
				
				//MOVE PHOTO TO DELETED FOLDER	
				$database->query('SELECT * FROM photo_gallery
											WHERE photoID = :photoID
											AND userID = :userID');
				$database->bind(':photoID', $photoID);				
				$database->bind(':userID', $this->userID);				
				$database->execute();								
				$result = $database->resultset();
				
				foreach ($result as $row) {
					$photo_name = $row['photo'];
					$thumb_name = $row['thumb'];
				}

				rename("images/gallery_pics/".$photo_name, "images/gallery_pics/deleted/".$photo_name);	
				rename("images/gallery_pics/".$thumb_name, "images/gallery_pics/deleted/".$thumb_name);	
				
				$this->log_update("remove_gallery_photo");																																
			break;
		}
	}
	
	
	function log_update($data) {
		//Log the date of the profile update, if profile is complete
		$database = new Database;
		
		$database->query('SELECT profile_status FROM members WHERE userID = :userID');
		$database->bind(':userID', $this->userID);
		$result = $database->single();
		
		$profile_status = $result['profile_status'];

		if ($profile_status == "complete") {
			$database = new Database;
			$database->query('INSERT INTO profile_update_log (userID, type, date) 
										VALUES (:userID, :type, NOW())');
			$database->bind(':userID', $this->userID);			
			$database->bind(':type', $data);
			$database->execute();				
		}

	}

	function profile_complete_check() {
//=========
//! 	DETERMINE WHETHER THIS PROFILE IS COMPLETE
//		I
//		IF IT IS COMPLETE, MATCH IT TO CURRENT JOBS, OR SEND IT TO REFERENCED PUBLIC JOB
//=========

		$employee_array = $this->get_employee_data();
		$employee_general_data = $employee_array['general'];
		$employee_skill_array = $employee_array['skills'];
		$complete = "no";
		
		if ($employee_general_data['firstname'] == "" || $employee_general_data['lastname'] == "" || $employee_general_data['zip'] == "") {
			$complete = "no";		
		} else {
			$complete = "yes";
		}		

		if ($complete == "yes") {
			if (count($employee_skill_array) > 0) {
				$complete = "yes";
			} else {
				$complete = "no";
			}
		}
		
		if ($complete == "yes") {
				//NO LONGER WRITE MATCHES TO TABLE
/*
				$match = new Match;
				//Find matches from new updated profile, insert them into database
				$match->get_matched_jobs($_SESSION['userID']);
*/
								
				//Check to see if there is a Reference JobID in the table, if so, this means this is their first time here, and they came form a public job link
				//Get that jobID to route to that page

				return $employee_general_data['ref_jobID'];				
		}
	}
	
	function get_employment_titles() {
		//Get template titles for employees entering past employment
		$database = new Database;
		
		$database->query('SELECT * FROM employment_title_template');
		$employment_titles = $database->resultset();
		
		return $employment_titles;
	}
	
	function get_employment_skills() {
		//Get template skills for employees entering past employment
		$database = new Database;
		
		$database->query('SELECT * FROM employment_skill_template');
		$employment_skills = $database->resultset();
		
		return $employment_skills;
	}
	
		
	function get_profile_rank() {
		$skill_array = $this->get_specific_employee_data("skills");
		$skill_count = 0;
		$word_count_flag = 0;
		//Count the words in the skills description, if it is less than 25 (approximately 2 sentences) flag it
		if (count($skill_array) > 0) {
			foreach($skill_array['skills'] as $row) {
				$word_count = str_word_count($row['description']);
				if ($word_count < 25) {
					$word_count_flag++;				
				}
				$skill_count++;
			}
		} else {
			$word_count_flag = 2;			
		}	
		
		//word count is worth 2 points, important part of the resume/profile
		if ($word_count_flag > 0) {
			$word_count_flag = 2;
		}
		
		$employment_array = $this->get_specific_employee_data("employment");	
		$employment_flag = 0;		
		if (count($employment_array) == 0) {
			$employment_flag = 1;
		} 
		
		$education_array = $this->get_specific_employee_data("education");	
		$education_flag = 0;		
		if (count($education_array) == 0) {
			$education_flag = 1;
		}
		
		$video_array = $this->get_specific_employee_data("video");	
		$video_flag = 0;		
		if (count($video_array ) == 0) {
			$video_flag = 1;
		}
		 
		$rank_number = $word_count_flag + $employment_flag + $education_flag + $video_flag;	
		
		//assign a letter grad, start at A+ and work downward
		switch($rank_number)	{
			default:
				$rank_letter = "incomplete";
			break;
		
			case "0":
				$rank_letter = "A+";
			break;
			
			case "1":
				$rank_letter = "A";
			break;

			case "2":
				$rank_letter = "A-";
			break;

			case "3":
				$rank_letter = "B+";
			break;

			case "4":
				$rank_letter = "B";
			break;
	
			case "5":
				$rank_letter = "B-";
			break;		
		}	
		
		//return an array with the rank letter as well as the flagged data
		$rank_array = array();
		$rank_array['letter'] = $rank_letter;
		$rank_array['number'] = $rank_number;		
		$rank_array['word_count'] = $word_count_flag;
		$rank_array['employment'] = $employment_flag;	
		$rank_array['education'] = $education_flag;	
		$rank_array['video'] = $video_flag;
		
		return $rank_array;	
	}
	
	function get_email_reminder_setting() {
		$database = new Database;
		$database->query('SELECT * FROM email_notice_change_log WHERE userID = :userID ORDER BY date DESC LIMIT 1');
		$database->bind(':userID', $this->userID);
		$result = $database->resultset();				
		
		if (count($result) > 0) {
			foreach($result as $row) {
				$option = $row['sub_option'];
			}
		} else {
			$option = 0;
		}
		
		return $option;
	}
	
	function upload_photo($photo_type, $file_type, $file_size, $file_name, $temp_name, $error, $new_name, $dest, $img_src, $thumb_name) {
		//TEST SIZE AND NAME FOR ERRORS
		if ($file_size > 5000000 || $_file_name == "") {
			echo "File exceeds maximum size";	
		} elseif ($file_type == "image/jpeg" || $file_type == "image/pjpeg" || $file_type == "image/jpg" || $file_type == "image/png") {	
			$utilities = new Utilities;
			$upload_error = $utilities->upload_photo($file_name, $temp_name, $error, $new_name, $dest);			
			
			//CONVERT FILE TYPE IF NEEDED
			if ($file_type == "image/png") {
				$convert_error = $utilities->convert_png_to_jpg($img_src);
				$img_src = $img_src.".jpg";
			} else {
				$convert_error = 0;
			}			
				
			switch($photo_type) {
				case "profile":
					$utilities = new Utilities;
					$crop_error = $utilities->CroppedThumbnail($img_src, "170", "170", $new_name, $dest);
							
					if ($error == 0 && $convert_error == 0 && $upload_error == 0 && $crop_error == 0) {
						$database = new Database;
						$database->query("UPDATE members
													SET profile_pic = :pic
													WHERE userID = :userID");
						$database->bind(':pic', $pic);				
						$database->bind(':userID', $_SESSION['userID']);				
						$database->execute();				
						
						$this->log_update("update_profile_photo");													
				
						echo "Successful";			
					} else {
						echo "There was a problem uploading the file.";
					}
				break;
				
				case "bartender":
					$bar_photo_array = $this->get_specific_employee_data("bar_photos");
					
					if (count($bar_photo_array) <= 12) {
						$utilities = new Utilities;
						$crop_error = $utilities->CroppedThumbnail($img_src, "60", "60", $new_name, $dest);

						if ($error == 0 && $convert_error == 0 && $upload_error == 0 && $crop_error == 0) {
							$database = new Database;
							
							$database->query("INSERT INTO photo_gallery (userID, type, photo, thumb)
														VALUES (:userID, :photo_type, :pic, :thumb_name)");
							$database->bind(':pic', $pic);				
							$database->bind(':pic', $photo_type);				
							$database->bind(':pic', $thumb_name);				
							$database->bind(':userID', $_SESSION['userID']);				
							$database->execute();	
							
							$this->log_update("update_gallery_photo");																				
														
							echo "Successful";			
						} else {
							echo "There was a problem uploading the file.";
						}
						
					} else {
						echo "You already have the maximum number of files for this gallery.";
					}
				break;
				
				case "kitchen":
					$kitchen_photo_array = $this->get_specific_employee_data("kitchen_photos");
					
					if (count($kitchen_photo_array) <= 12) {
						$utilities = new Utilities;
						$crop_error = $utilities->CroppedThumbnail($img_src, "60", "60", $new_name, $dest);

						if ($error == 0 && $convert_error == 0 && $upload_error == 0 && $crop_error == 0) {
							$database = new Database;
							
							$database->query("INSERT INTO photo_gallery (userID, type, photo, thumb)
														VALUES (:userID, :photo_type, :pic, :thumb_name)");
							$database->bind(':pic', $pic);				
							$database->bind(':pic', $photo_type);				
							$database->bind(':pic', $thumb_name);				
							$database->bind(':userID', $_SESSION['userID']);				
							$database->execute();	
							
							$this->log_update("update_gallery_photo");																				
														
							echo "Successful";			
						} else {
							echo "There was a problem uploading the file.";
						}
						
					} else {
						echo count($kitchen_photo_array)."You already have the maximum number of files for this gallery.";
					}				
				break;
			}
			
		} else {
			echo "Incompatible file type.  Please use a .jpeg or .png file.";											
		}
	}
	
	function save_message($type, $message) {
		if ($message != "") {
		$database = new Database;
			switch($type) {
				case "personal":
					$database->query('INSERT INTO employee_message (userID, message)
												VALUES (:userID, :message)
												ON DUPLICATE KEY UPDATE message = :message');
					$database->bind(':userID', $this->userID);	
					$database->bind(':message', $message);
				break;
				
				case "gap":
					$database->query('INSERT INTO employee_gap_message (userID, message)
												VALUES (:userID, :message)
												ON DUPLICATE KEY UPDATE message = :message');
					$database->bind(':userID', $this->userID);	
					$database->bind(':message', $message);
				break;				
			}
			
			$database->execute();	
		}						
	}
	
	function save_answers($question_array) {
		//determine if questions exist, and if they come from a template
		if ($question_array['questionID_1'] != "NA") {
			$database = new Database;
			$database->query('SELECT template_questionID FROM job_questions 
										WHERE questionID = :questionID');
			$database->bind(':questionID', $question_array['questionID_1']);	
			$result = $database->single();		
			
			if (isset($result['template_questionID']) && $result['template_questionID'] > 0) {
				//save answer
				$database = new Database;
				$database->query('INSERT INTO employee_saved_answers (userID, template_questionID, answer)
											VALUES (:userID, :template_questionID, :answer)
											ON DUPLICATE KEY UPDATE answer = :answer');
				$database->bind(':userID', $this->userID);	
				$database->bind(':template_questionID', $result['template_questionID']);
				$database->bind(':answer', $question_array['answer_1']);
				$database->execute();										
			}							
		}
		
		if ($question_array['questionID_2'] != "NA") {
			$database = new Database;
			$database->query('SELECT template_questionID FROM job_questions 
										WHERE questionID = :questionID');
			$database->bind(':questionID', $question_array['questionID_2']);	
			$result = $database->single();		
			
			if (isset($result['template_questionID']) && $result['template_questionID'] > 0) {
				//save answer
				$database = new Database;
				$database->query('INSERT INTO employee_saved_answers (userID, template_questionID, answer)
											VALUES (:userID, :template_questionID, :answer)
											ON DUPLICATE KEY UPDATE answer = :answer');
				$database->bind(':userID', $this->userID);	
				$database->bind(':template_questionID', $result['template_questionID']);
				$database->bind(':answer', $question_array['answer_2']);
				$database->execute();										
			}							
		}

		if ($question_array['questionID_3'] != "NA") {
			$database = new Database;
			$database->query('SELECT template_questionID FROM job_questions 
										WHERE questionID = :questionID');
			$database->bind(':questionID', $question_array['questionID_3']);	
			$result = $database->single();		
			
			if (isset($result['template_questionID']) && $result['template_questionID'] > 0) {
				//save answer
				$database = new Database;
				$database->query('INSERT INTO employee_saved_answers (userID, template_questionID, answer)
											VALUES (:userID, :template_questionID, :answer)
											ON DUPLICATE KEY UPDATE answer = :answer');
				$database->bind(':userID', $this->userID);	
				$database->bind(':template_questionID', $result['template_questionID']);
				$database->bind(':answer', $question_array['answer_3']);
				$database->execute();										
			}							
		}		
	}
	
	function determine_employment_gaps() {
		$employee_array = $this->get_specific_employee_data('employment');
		$employee_array = array_reverse($employee_array);
		
		$test_end_date = "NA";
		$testID = "NA";
		$gap_array = array();
		$false_gap_ids = array();
		
		foreach($employee_array as $row) {
			if ($test_end_date != "NA") {				 
				//run test
				//loop through all employment again, checking to see if current end date falls in between any intervals
				//if not, calculate the gap
				
				$gap_test = true;
				$gap = 0;
				$currentID = 'NA';
				foreach($employee_array as $job) {
					$current_start_date = $job['start_year'] + $job['start_month']/12; 
					$current_end_date = $job['end_year'] + $job['end_month']/12;

					if ($job['ID'] != $testID) {
						if ($test_end_date >= $current_start_date && $test_end_date <= $current_end_date) {
							$gap_test = false;
							$false_gap_ids[] = $row['ID'];
							//break;
						} else {
							//calculate gap
							$calculated_gap = $current_start_date - $test_end_date;
							//if gap is greater than current gap, make it current	
							if ($calculated_gap < $gap || $gap == 0) {
								$gap = $calculated_gap;
								$currentID = $job['ID'];								
							} 
						}	
					} else {
						$gap_test = false;
					}				
				}
				
				if (!in_array($row['ID'], $false_gap_ids)) {
				$gap_threshold = 100; //if this is changed, make sure to change the text on the employee and candidate pages
				if ($gap > $gap_threshold && $currentID != 'NA') {
					if ($gap < 1) {
						$months = $gap * 12;
						if ($months < 2) {
							$gap_text = "NA";
						} else {
							$gap_text = $months." months";
						}
					} else {
						$denominator = 4;
					    $x = $gap * $denominator;
					    $x = floor($x);
					    $x = $x / $denominator;
					    								
						$gap_text = $x." year(s)";	
					}
					
					$gap_array[] = array("firstID" => $testID, "secondID" => $currentID, "gap" => $gap, "gap_text" => $gap_text);
				}
				}		
			}
			
			if ($row['current'] == "Y") {
				$test_end_date = "NA";
			} else {
				$test_end_date = $row['end_year'] + $row['end_month']/12;
			}
			$testID = $row['ID'];
			//echo $test_end_date." ";
		}
		
		return $gap_array;
	}
	
	function profile_review() {
		$utilities = new Utilities;
		//reviews profile before a person applies to a job and gives suggestions
		$employee_data = $this->get_employee_data();
		
		//test the important parts of the profile
		if ($employee_data['general']['profile_pic'] != "") {
			$profile_pic = true;
		} else {
			$profile_pic = false;			
		}
		
		if ($employee_data['general']['quote'] != "") {
			$quote = true;
		} else {
			$quote = false;			
		}
		
		if (count($employee_data['traits']) > 0) {
			$traits = true;
		} else {
			$traits = false;			
		}		
		
		$past_employment = count($employee_data['employment']);	
		
		$sub_skills = 	count($employee_data['skills']['sub_skills']);	
		$employment_skills = count($employee_data['skills']['employment_skills']);	

		$education = count($employee_data['education']);	

		$certifications = count($employee_data['certifications']);	
		
		$total_experience = array();
		$hospitality_holder = array();
		$other_holder = array();	
		$unknown_holder = array();	

		if (count($employee_data['employment']) > 0) {
			foreach($employee_data['employment'] as $row) {
				if ($row['category'] == "other") {
					$other_holder[] = $row;
				} elseif ($row['category'] == "") {						
					$unknown_holder[] = $row;	
				} else {
					$hospitality_holder[] = $row;							
				}		
			}
		}
		
		$total_experience['other'] = $utilities->determine_years_of_experience($other_holder);
		$total_experience['unknown'] = $utilities->determine_years_of_experience($unknown_holder);
		$total_experience['hospitality'] = $utilities->determine_years_of_experience($hospitality_holder);	
		
		$result = array("profile_pic" => $profile_pic,
								"quote" => $quote,
								"traits" => $traits,
								"employment_count" => $past_employment,
								"sub_skill_count" => $sub_skills,
								"employment_skill_count" => $employment_skills,
								"education_count" => $education,
								"certification_count" => $certifications,
								"total_experience" => $total_experience);
		
		return $result;	
	}
	
	function switch_account_type($company, $position) {
		
		$database = new Database;
		$database->query('SELECT type, profile_status FROM members WHERE userID = :userID');
		$database->bind(':userID', $this->userID);
		$result = $database->single();
		
		if ($result['type'] == "employee") {
			$database = new Database;
			$database->query('UPDATE members SET type = :type, profile_status = :status
										WHERE userID = :userID LIMIT 1');
			$database->bind(':userID', $_SESSION['userID']);				
			$database->bind(':type', "employer");
			$database->bind(':status', "complete");
			$database->execute();	
			
			$_SESSION['type'] = "employer";						
		}
		
	}
	
	function remove_resume($resume) {
		$database = new Database;
		$database->query('SELECT resume FROM members WHERE userID = :userID');
		$database->bind(':userID', $_SESSION['userID']);
		$result = $database->single();
	
		//unlink("resumes/".$result['resume']);																											
		
		rename($_SERVER['DOCUMENT_ROOT']."/resumes/".$result['resume'], $_SERVER['DOCUMENT_ROOT']."/resumes/deleted.pdf");																											

		$database->query('UPDATE members SET resume = NULL
										WHERE userID = :userID');
		$database->bind(':userID', $_SESSION['userID']);
		$database->execute();	

	}	
}
?>