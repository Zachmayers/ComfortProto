<?php
require_once('mysqldb.class.php');	
require_once('utilities.class.php');	

class Employer {

	public $userID;
	
	function __construct($userID) {
		$this->userID = $userID;
	}
		
	function get_employer_data() {	
		$general_data = $this->get_employer_details("general");
		$store_job_array = $this->get_employer_details("stores");	
		
		$employer_array = array('general' => $general_data, 
											'stores_jobs' => $store_job_array);
											
		$utilities = new Utilities;
		array_walk_recursive($employer_array, array($utilities, "makeSafe"));
											
		return $employer_array;	
	}
	
	private function get_employer_details($type) {

		switch($type) {
			case "general":
				$database = new Database;				
				$database->query('SELECT * FROM employer WHERE userID = :userID');
				$database->bind(':userID', $this->userID);
				$result = $database->single();				
			break;
			
			case "stores":
				$database = new Database;
				$database->query('SELECT * FROM stores WHERE userID = :userID');
				$database->bind(':userID', $this->userID);
				$store_array = $database->resultset();
				
				$open_job_array = array();
				$expired_job_array = array();				
				foreach ($store_array as $store) {
					$database = new Database;				
					$database->query('SELECT * FROM jobs WHERE storeID = :storeID
												AND job_status != "Filled" 
												AND expiration_date > NOW()
												ORDER BY expiration_date DESC');					
					$database->bind(':storeID', $store['storeID']);		
					$open_job_array[$store['storeID']] = count($database->resultset());
					
					$database = new Database;				
					$database->query('SELECT * FROM jobs WHERE storeID = :storeID
												AND (job_status = "Filled" OR expiration_date < NOW() )
												ORDER BY expiration_date DESC');					
					$database->bind(':storeID', $store['storeID']);		
					$expired_job_array[$store['storeID']] = count($database->resultset());							
				}
								
				$result = array("stores" => $store_array, "open_jobs" => $open_job_array, "expired_jobs" => $expired_job_array);
			break;
		}
				
		return $result;					
	}
	
	function insert_employer_record($record_update_array) {
		if ($_SESSION['userID'] == $this->userID && $_SESSION['type'] == "employer") {
			//make sure there is no duplicate
			$database = new Database;				
			$database->query('SELECT userID FROM employer WHERE userID = :userID');		
			$database->bind(':userID', $this->userID);
			$result = $database->resultset();	
			
			if (count($result) == 0) {
				$database->query('INSERT INTO employer (userID, company, position, website)
												VALUES (:userID, :company, :position, :website)');		
				$database->bind(':position', $record_update_array['position']);
				$database->bind(':company', $record_update_array['company']);
				$database->bind(':website', $record_update_array['website']);
				$database->bind(':userID', $this->userID);
				$database->execute();									
			}					
		} else {
			return "error";
		}		
	}

	function update_employer_record($record_update_array) {
		if ($_SESSION['userID'] == $this->userID && $_SESSION['type'] == "employer") {
			$database = new Database;				
			$database->query('UPDATE employer SET position = :position WHERE userID = :userID');		
			$database->bind(':position', $record_update_array['position']);
			$database->bind(':userID', $this->userID);
			$database->execute();						
		} else {
			return "error";
		}
	}
	
	function get_interview_list($type, $ID) {
		$database = new Database;
		
		switch($type) {
			case "current":
				$database->query('SELECT members.firstname, members.lastname, members.email, members.contact_phone, jobs.title, interview_confirmation.status, interview_confirmation.interview_date, interview_confirmation.matchID, interview_confirmation.candidateID
											FROM interview_confirmation, members, jobs 
											WHERE interview_confirmation.employerID = :userID
											AND jobs.jobID = interview_confirmation.jobID
											AND members.userID = interview_confirmation.candidateID
											AND interview_confirmation.interview_date >= NOW()
											ORDER BY interview_confirmation.interview_date DESC');
				$database->bind(':userID', $this->userID);				
			break;
			
			case "float":
				$database->query('SELECT members.firstname, members.lastname, members.email, members.contact_phone, jobs.title, interview_confirmation.status, interview_confirmation.interview_date, interview_confirmation.matchID, interview_confirmation.candidateID
											FROM interview_confirmation, members, jobs 
											WHERE interview_confirmation.employerID = :userID
											AND jobs.jobID = interview_confirmation.jobID
											AND members.userID = interview_confirmation.candidateID
											AND interview_confirmation.interview_date BETWEEN NOW() - INTERVAL 7 DAY AND NOW()
											ORDER BY interview_confirmation.interview_date DESC');
				$database->bind(':userID', $this->userID);							
			break;
			
			case "past":
				$database->query('SELECT members.firstname, members.lastname, members.email, members.contact_phone, jobs.title, interview_confirmation.status, interview_confirmation.interview_date, interview_confirmation.matchID, interview_confirmation.candidateID
											FROM interview_confirmation, members, jobs 
											WHERE interview_confirmation.employerID = :userID
											AND jobs.jobID = interview_confirmation.jobID
											AND members.userID = interview_confirmation.candidateID
											AND interview_confirmation.interview_date BETWEEN NOW() - INTERVAL 365 DAY AND NOW()
											ORDER BY interview_confirmation.interview_date DESC');
				$database->bind(':userID', $this->userID);				
			break;
			
			
			case "current_jobs":
				$database->query('SELECT members.firstname, members.lastname, members.email, members.contact_phone, jobs.title, interview_confirmation.status
											FROM interview_confirmation, members, jobs 
											WHERE interview_confirmation.employerID = :userID
											AND interview_confirmation.jobID = :jobID
											AND jobs.jobID = interview_confirmation.jobID
											AND members.userID = interview_confirmation.candidateID
											AND jobs.expiration_date <= NOW() + INTERVAL 30 DAY');
				$database->bind(':userID', $this->userID);				
				$database->bind(':jobID', $jobID);				
			break;			
			
			case "job":
				$database->query('SELECT members.firstname, members.lastname, members.email, members.contact_phone, jobs.title, interview_confirmation.status, interview_confirmation.interview_date, interview_confirmation.matchID, interview_confirmation.candidateID
											FROM interview_confirmation, members, jobs 
											WHERE interview_confirmation.employerID = :userID
											AND interview_confirmation.jobID = :jobID
											AND jobs.jobID = interview_confirmation.jobID
											AND members.userID = interview_confirmation.candidateID');
				$database->bind(':userID', $this->userID);				
				$database->bind(':jobID', $ID);
											
			break;
			
			case "candidate":
				$database->query('SELECT members.firstname, members.lastname, members.email, members.contact_phone, jobs.title, interview_confirmation.status
											FROM interview_confirmation, members, jobs 
											WHERE interview_confirmation.employerID = :userID
											AND interview_confirmation.matchID = :matchID
											AND jobs.jobID = interview_confirmation.jobID											
											AND members.userID = interview_confirmation.candidateID');
				$database->bind(':userID', $this->userID);				
				$database->bind(':matchID', $ID);							
			break;	
			
			case "new_cancels":
				$database->query('SELECT members.firstname, members.lastname, members.email, members.contact_phone, jobs.title, interview_confirmation.interview_date, interview_confirmation.matchID, interview_confirmation.candidateID
											FROM interview_confirmation, members, jobs 
											WHERE interview_confirmation.employerID = :userID
											AND jobs.jobID = interview_confirmation.jobID
											AND members.userID = interview_confirmation.candidateID
											AND interview_confirmation.status = :status
											AND interview_confirmation.status_date >= :last_login
											ORDER BY interview_confirmation.interview_date DESC');
				$database->bind(':userID', $this->userID);	
				$database->bind(':status', "employee_cancel");	
				$database->bind(':last_login', $ID);	
				//echo $ID;									
			break;		
		}
		
		$result = $database->resultset();
		return $result;		
	}
	
	function get_notifications($last_login) {
		//check for notifications
		
		//three general classes of notifications
		//urgent notifications - these take over the main page
		//new notifications - these are on the main page, but are open when the user browses there the first time
		//old/general notifications - in closed notifications bars
		
		//first check for urgent notifications
		//'did you hire' notices
		$notification_array = array("urgent" => array(), "new" => array(), "general" => array());
		
		$potential_bounty_hires = $this->get_potential_bounty_hires();
		$notification_array['urgent']['hire_notice'] = $potential_bounty_hires;

		$interview_cancels = $this->get_interview_list("new_cancels", $last_login);

		$notification_array['urgent']['interview_cancels'] = $interview_cancels;		

		$notification_array['urgent']['urgent_count'] = count($potential_bounty_hires) + count($interview_cancels);

		$utilities = new Utilities;	
		$notification_array['general']['email_verification'] = $utilities->check_email_verification();
		
		return $notification_array;		
	}
	
	function get_boost_notification() {	
		$job_list = array();
		$show_notice = "N";
		
		//remind the employer that the boost option will give them more job views
		
		//determine whether to show the notification based on a few criteria
		
		//first make sure there is are open jobs between 3 and 20 days old and none of them have been boosted
		$database = new Database;

		$database->query('SELECT title, jobID, date_created, expiration_date, post_type FROM jobs
									 WHERE userID = :userID
									 AND job_status = :job_status
									 AND date_created < DATE_SUB(NOW(), interval 3 DAY)
									 AND expiration_date > NOW()');
		$database->bind(':userID', $this->userID);				
		$database->bind(':job_status', 'open');				
		$result = $database->resultset();

		if (count($result) > 0) {
			$boost_count = 0;
			
			foreach($result as $row) {
				$database->query('SELECT boostID FROM job_boost WHERE jobID = :jobID ');
				$database->bind(':jobID', $row['jobID']);				
				$boost_data = $database->resultset();
				
				if (count($boost_data) > 0) {
					$boost_count++;
				}
			}
			
			if ($boost_count == 0) {
				//check the number of applicants for job posts
				$show_notice = "Y";
				foreach($result as $row) {
					$database->query('SELECT userID FROM job_match
												 WHERE jobID = :jobID
												 AND employee_interest = :interest ');
					$database->bind(':jobID', $row['jobID']);				
					$database->bind(':interest', 'Y');				
					$interest_data = $database->resultset();
					
					if (count($interest_data) > 4) {
						$show_notice = "N";
					}					
				}	
			}			
		}
		//$show_notice = 'Y';
		return $show_notice;		
	}
	
	function get_potential_bounty_hires() {
		$database = new Database;
		
		$database->query('SELECT jobs.title, jobs.jobID, jobs.date_created, jobs.expiration_date, stores.name FROM jobs, stores
									 WHERE jobs.userID = :userID
									 AND jobs.post_type = :post_type
									 AND jobs.bounty_status = :bounty_status
									 AND jobs.site_followup <= NOW()
									 AND jobs.storeID = stores.storeID');
		$database->bind(':userID', $this->userID);				
		$database->bind(':post_type', 'bounty');				
		$database->bind(':bounty_status', 'open');				
		$result = $database->resultset();

		//check to see if anyone was recommended and applied
		if (count($result) > 0) {
			foreach($result as $row) {
				$database->query('SELECT members.userID, members.firstname, members.lastname, job_match.matchID, bounty_recommendations.ID, bounty_recommendations.recommend_status
											 FROM members, job_match, bounty_recommendations
											 WHERE job_match.jobID = :jobID
											 AND bounty_recommendations.jobID = :jobID
											 AND job_match.employee_interest = :response
											 AND bounty_recommendations.recommendedID = job_match.userID
											 AND (bounty_recommendations.recommend_status = :accepted OR bounty_recommendations.recommend_status = :hired)
											 AND members.userID = job_match.userID');
				$database->bind(':jobID', $row['jobID']);				
				$database->bind(':response', 'Y');				
				$database->bind(':accepted', 'Accepted');	
				$database->bind(':hired', 'Hired');	
							
				$user_array = $database->resultset();
				
				//echo var_dump($user_array);
				if (count($user_array) > 0) {
					$potential_bounty_hire[] = array("job_details" => $row, "candidate_details" => $user_array);
				}
			}
		}

		return $potential_bounty_hire;							
	}
	
	function send_reminder() {
		$database = new Database;
		$database->query('SELECT userID FROM reminder_email WHERE userID = :userID');
		$database->bind(':userID', $this->userID);				
		$result = $database->resultset();							
		
		if (count($result) == 0) {
			$database->query('INSERT INTO reminder_email (userID, date_to_send, date_created)
											VALUES (:userID, DATE_ADD(current_date, INTERVAL :days DAY), NOW())');
			$database->bind(':userID', $this->userID);				
			$database->bind(':days', '3');				
			$database->execute();	
		} else {
			$database->query('UPDATE reminder_email SET date_to_send = DATE_ADD(current_date, INTERVAL :days DAY), date_created = NOW()
											WHERE userID = :userID');
			$database->bind(':userID', $this->userID);				
			$database->bind(':days', '3');				
			$database->execute();								
		}						
	}
	
	function remove_photo($storeID) {
		$database = new Database;
		
		//GET NAME OF PROFILE PIC
		$photo_name = $storeID.".jpg";				
				
		 if (file_exists($_SERVER['DOCUMENT_ROOT']."/images/store_pics/".$photo_name)) {
		    unlink($_SERVER['DOCUMENT_ROOT']."/images/store_pics/".$photo_name);

			$database->query('UPDATE stores
										SET image = ""									
										WHERE userID = :userID
										AND storeID = :storeID');
			$database->bind(':userID', $this->userID);				
			$database->bind(':storeID', $storeID);				
			$database->execute();
		} else {
			echo "STILL NOPE";
		}
	}	
	
	function switch_account_type($zip) {
		//make sure use has no open job posts
		
		$database = new Database;
		$database->query('SELECT jobID FROM jobs WHERE userID = :userID
										AND job_status = :job_status
										AND expiration_date > NOW()');
		$database->bind(':userID', $this->userID);
		$database->bind(':job_status', "Open");
		$result = $database->resultset();
		
		if (count($result) == 0) {
			$database = new Database;
			
			$database = new Database;
			$database->query('UPDATE members SET type = :type, profile_status = :status, zip = :zip
										WHERE userID = :userID LIMIT 1');
			$database->bind(':userID', $this->userID);
			$database->bind(':type', "employee");
			$database->bind(':status', 'complete');
			$database->bind(':zip', $zip);
			$database->execute();	
			
			$_SESSION['type'] = "employee";	
			
			return "true";					
		} else {
			return "job";
		}	
	}		
}

?>