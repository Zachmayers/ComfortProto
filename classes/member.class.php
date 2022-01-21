<?php
//CHANGE THE NAME
require_once('mysqldb.class.php');	
require_once('utilities.class.php');	

class Member {

	public $userID;
	
	function __construct($ID) {
		$this->userID = $ID;
	}
	
	function get_member_data() {
		$database = new Database;
		
		$database->query('SELECT userID, email, first_name, last_name, provider
									FROM users 
									WHERE userID = :userID');
		$database->bind(':userID', $this->userID);
		$result = $database->single();
		
		$utilities = new Utilities;

		array_walk_recursive($result, array($utilities, "makeSafe"));

		return $result;	
	}
	
	
	function update_phone($phone) {
		$database = new Database;			
		$database->query('UPDATE members 
									SET contact_phone = :contact_phone
									WHERE userID = :userID');
		$database->bind(':userID', $this->userID);
		$database->bind(':contact_phone', $phone);
		$database->execute();													
	}	
	
	function update_email_address($type, $member_update_array) {
		
		switch($type) {
			case "unverified":
				//make sure the email matches the user
				$database = new Database;
		
				$database->query('SELECT userID, valid_hash FROM members 
												WHERE userID = :userID
												AND email = :email');
				$database->bind(':userID', $this->userID);
				$database->bind(':email', $member_update_array['old_email']);
				$user_array = $database->resultset();	
				
				if (count($user_array) == 1) {
					//check for duplicates
					$database->query('SELECT userID FROM members WHERE  email = :email');
					$database->bind(':email', $member_update_array['new_email']);
					$result = $database->resultset();	
					if (count($result) > 0) {
						echo "duplicate";
					} else {
						$message = new Message();
						//update email
						$database->query('UPDATE members 
													SET email = :new_email
													WHERE userID = :userID
													AND email = :old_email');
						$database->bind(':userID', $this->userID);
						$database->bind(':new_email', $member_update_array['new_email']);
						$database->bind(':old_email', $member_update_array['old_email']);
						$database->execute();
						
						//SEND VERIFICATION EMAIL
						foreach ($user_array as $row) {
							$valid_hash = $row['valid_hash'];
						}		
		
						$message->send_verification_notification($valid_hash, $_SESSION['userID']);
							
						return "yes";
					}
				} else {
					return "error";
				}
			break;
			
			case "verified":
				$utilities = new Utilities;
				$database = new Database;
				$new_email = $member_update_array['new_email'];
				$old_email = $member_update_array['old_email'];

				//check for duplicates
				$database->query('SELECT userID FROM members WHERE email = :new_email');
				$database->bind(':new_email', $new_email);
				$result = $database->resultset();

				if (count($result) > 0) {							
					return "duplicate";
				} else {
					//enter new email in change queue					
					$database->query('SELECT email FROM members WHERE userID = :userID');
					$database->bind(':userID', $this->userID);
					$result = $database->single();
					$old_email = $result['email'];	
	
					$new_valid_hash = $utilities->generateRandomString(8);
					
					$database->query('INSERT INTO email_change
												(userID, old_email, new_email, valid_hash, date_sent)
												VALUES (:userID, :old_email, :new_email, :valid_hash, NOW())');
					$database->bind(':userID', $this->userID);
					$database->bind(':old_email', $old_email);
					$database->bind(':new_email', $new_email);
					$database->bind(':valid_hash', $new_valid_hash);
					$database->execute();	
					
					$message = new Message();										
					$message->send_new_email_verification_notification($new_valid_hash, $_SESSION['userID'], $new_email);
					
					return "yes";
				}
			break;
		}															
	}
	
	function change_email_address($valid_hash) {
		$database = new Database;
		//called when new email verification is sent and clicked
		
		//get email
		$database->query('SELECT ID, userID, new_email FROM email_change WHERE userID = :userID
										AND valid_hash = :valid_hash 
										AND changed != :changed');
		$database->bind(':userID', $this->userID);
		$database->bind(':valid_hash', $valid_hash);
		$database->bind(':changed', 'Y');
		$result = $database->resultset();
		
		if (count($result) == 1) {
			foreach($result as $row) {
				$new_email = $row['new_email'];
				$changeID = $row['ID'];
			}

			//check for duplicates
			$database->query('SELECT userID FROM members WHERE email = :email');
			$database->bind(':email', $new_email);
			$result = $database->resultset();	
			if (count($result) > 0) {
				return "duplicate";
			} else {
				//update email
				$database->query('UPDATE members 
											SET email = :new_email
											WHERE userID = :userID
											LIMIT 1');
				$database->bind(':userID', $this->userID);
				$database->bind(':new_email', $new_email);
				$database->execute();
				
				$database->query('UPDATE email_change 
											SET date_verified = NOW(),
											changed = :changed
											WHERE ID = :changeID
											AND new_email = :new_email
											AND userID = :userID
											LIMIT 1');
				$database->bind(':userID', $this->userID);
				$database->bind(':changeID', $changeID);
				$database->bind(':new_email', $new_email);
				$database->bind(':changed', 'Y');
				$database->execute();				

				return $new_email;
			}
			
		} else {
			return "error";
		}	
	}	
	
	function change_password($entered_password, $new_password) {
		//test old password
		$database = new Database;			
		$database->query("SELECT password, pass_test FROM members
                   					WHERE userID = :userID");
		$database->bind(':userID', $this->userID);	
//		$database->bind(':password', sha1($old_password));	
		$result = $database->resultset();

		if (count($result) != 1) {
			echo "no";
		} else {
			foreach($result as $row) {
				$current_password = $row['password'];
				$pass_test = $row['pass_test'];
			}
			
			if ($pass_test == 'Y') {
				if (password_verify($entered_password, $current_password)) {
					$valid_login = "Y";														
				} else {
					$valid_login = "N";							
				}
			} else {
				if (password_verify(sha1($entered_password), $current_password)) {
					$valid_login = "Y";		
				} else {
					$valid_login = "N";							
				}						
			}

			if ($valid_login == "Y") {
				$options = ['cost' => 10,];		
				$new_password = password_hash($new_password, PASSWORD_BCRYPT, $options);		

				$database = new Database;			
				$database->query("UPDATE members
											SET password = :password, pass_test = :test
											WHERE userID = :userID");
				$database->bind(':userID', $this->userID);	
				$database->bind(':password', $new_password);	
				$database->bind(':test', "Y");	
				$database->execute();
				echo "yes";
			} else {
				echo "no";
			}
		}		
	}
	
	function get_logins($userID) {
		$database = new Database;
		$database->query('SELECT * FROM login_track WHERE userID = :userID ORDER BY login_date DESC');
		$database->bind(':userID', $userID);	
		$result = $database->resultset();
		return $result;							
	}	
	
	function get_referral_code() {
		$database = new Database;
		$database->query('SELECT * FROM referral_code WHERE userID = :userID');
		$database->bind(':userID', $this->userID);	
		$result = $database->resultset();

		if (count($result) == 0) {
			//create code
			$utilities = new Utilities();
			
			$referral_code = strtoupper($utilities->generateRandomString(5));
			//make sure no duplicates
			$count = 1;
			while($count <= 5) {
				$database->query('SELECT * FROM referral_code WHERE code = :code
											AND userID != :userID');
				$database->bind(':userID', $this->userID);	
				$database->bind(':code', $referral_code);
				$new_result = $database->resultset();
				
				if (count($new_result) == 0) {
					$count = 6;
					break;
				} else {
					$referral_code = strtoupper($utilities->generateRandomString(5));
				}
			}
			
			$database->query('INSERT INTO referral_code (userID, code, date)
											VALUES (:userID, :code, NOW())');		
			$database->bind(':code', $referral_code);
			$database->bind(':userID', $this->userID);
			$database->execute();									
			
		} else {
			foreach($result as $row) {
				$referral_code = $row['code'];
			}
		}
		
		return $referral_code;
	}
	
		
}

?>