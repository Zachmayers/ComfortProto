<?php
require_once('mysqldb.class.php');	
require_once('utilities.class.php');	
require_once('member.class.php');
require_once('message.class.php');

class Verification {
		
	function user_login($email, $entered_password) {
		//run the failed attempts test to make sure there is no brute force attack
		//$delay = $this->failed_logins();
		//if ($delay == "false") {
			if (trim($email) == "" || trim($entered_password) == "") {
				echo "false";
			} else {
				

												
				$database = new Database;
				$database->query("SELECT * FROM users WHERE email = :email");
				$database->bind(':email', $email);
			
				$result = $database->resultset();

				if (count($result) == 1) {	
					foreach ($result as $row) {
						$new_password = $row['password'];	
					}
					
					//do password test
					$valid_login = "N";
						if (password_verify($entered_password, $new_password)) {
							$valid_login = "Y";														
						} else {
							$valid_login = "N";							
						}
									
					}
					
			
					
				if ($valid_login == "Y") {								
				

						$this->set_session_variables($result, "pass");

								echo "complete";

							
					}  else {
						echo "false";
					}

			} 

	}
		
	function fb_user_test($email, $fb_ID) {
		//determine whether this is a new user or an existing user
		$database = new Database;
		
		//first determine whether their FB ID exists in DB
		$database->query("SELECT email, FB_id FROM members WHERE FB_id = :fb_ID");
		$database->bind(':fb_ID', $fb_ID);
		$result = $database->resultset();
		
		if (count($result) > 0) {
			//make sure there is an email address associated with the account (there should be, but just in case something went sideways)
			foreach($result as $row) {
				$db_email = $row['email'];
			}
			
			if ($db_email == "") {
				return "error";
			} else {
				return "true";
			}	
		} else {
			//next determine if email exists
			$database->query("SELECT email, FB_id FROM members WHERE email = :email");
			$database->bind(':email', $email);
			$result = $database->resultset();
			
			if (count($result) > 0) {
				//test to see if FB id exists
				foreach($result as $row) {
					$db_fb_ID = $row['FB_id'];
				}
				
				if ($fb_ID != $db_fb_ID) {
					//if this user hasn't logged in if FB before, add their ID
					$database->query("UPDATE members SET FB_id = :fb_ID WHERE email = :email LIMIT 1");
					$database->bind(':fb_ID', $fb_ID);
					$database->bind(':email', $email);
					$database->execute();			
				}			
				return "true";
			} else {
				return "false";
			}					
		}
	}
	
	function facebook_login($email, $fb_id, $jobID, $public_hash) {
		$database = new Database;
			
		//TEST JOBID AND HASH AGAINST DATABASE
		if ($jobID != "NA") {
			$jobID = $this->job_reference_test($jobID, $public_hash);		
		}									

		$database->query("SELECT userID, type, firstname, lastname, photo_setting, email_validation, valid_hash, valid, profile_status, ref_jobID FROM members WHERE FB_id = :fb_ID");
		$database->bind(':fb_ID', $fb_id);
		$result = $database->resultset();
								
		foreach ($result as $row) {
			$email_validation = $row['email_validation'];
			$valid_hash = $row['valid_hash'];
			$valid_account = $row['valid'];
			$profile_status = $row['profile_status'];
			if ($jobID == "NA") {
				//test to see if person is coming back from a public after verifying email, there will be a job_refID, if so, route to that page		
				if ($row['ref_jobID'] != "") {
					//if expired, send elsewhere
					$ref_status = $this->job_reference_expiration_test($row['ref_jobID']);
					if ($ref_status == "open") {
						$jobID = $row['ref_jobID'];	
					} else {
						$jobID = "NA";
					}
				}						
			} 
		}
				
		if ($valid_account == "Y") {

			//test case where user was recommended for a job, but signed in with different email than the recommender sent (already had an account case)
			//also make sure the recommender didn't use the link themselves for some reason
			if (isset($_SESSION['recommend']) && $_SESSION['recommend']['recommenderID'] != $userID) {
				//update the recommendation table with this user's ID
				$database->query("UPDATE bounty_recommendations 
												SET recommendedID = :userID,
												recommend_status = :recommend_status
												WHERE ID = :recommendID");
				$database->bind(':userID', $userID);		
				$database->bind(':recommend_status', "Viewed");		
				$database->bind(':recommendID', $_SESSION['recommend']['recommendID']);		
				$database->execute();	

				//$jobID = $_SESSION['recommend']['jobID'];
				$jobID = "NA";
				
				unset($_SESSION['recommend']);							
			}

			$this->set_session_variables($result, "FB");

			//get profile status to route them to the correct page
			if ($profile_status == "complete") {
				if ($jobID == "NA" || $_SESSION['type'] == "employer") {
					echo "complete";
				} else {
					echo $jobID;
				}						
			} else {
				echo "profile";
			}				
		} elseif ($valid_account != "Y") {
			echo "deactivate";
		} 
	}	
	
	
	
	
	
	private function set_session_variables($result, $login_type) {
		foreach ($result as $row) {
			$_SESSION['userID'] = $row['userID'];
			$_SESSION['firstname'] = $row['first_name'];
			$_SESSION['lastname'] = $row['last_name'];	
			if ($row['provider'] == "Y") {
				$_SESSION['type'] = "provider";
			} else {
				$_SESSION['type'] = "client";
			}
	
		}
		//$this->login_track();		
	}	
	
	private function login_track() {
		//First, insert into master login table for tracking
		$database = new Database;			
		$database->query("INSERT INTO login_track (userID, login_date, browser, IP, login_type)
									VALUES (:userID, NOW(), :browser, :IP, :login_type)");
		$database->bind(':userID', $_SESSION['userID']);
		$database->bind(':browser', $_SERVER['HTTP_USER_AGENT']);
		$database->bind(':IP', $_SERVER['REMOTE_ADDR']);		
		$database->bind(':login_type', $_SESSION['login_type']);
		$result = $database->execute();
		
		//Set Current & Last Login in the members table, this used to determine events since last login.
		//First figure the last login (since this function didn't exist on creation, we need to sweep the master login table)

		$database = new Database;			
		$database->query("SELECT current_login FROM members WHERE userID = :userID AND current_login IS NOT NULL");
		$database->bind(':userID', $_SESSION['userID']);
		//$database->bind(':current_login', "0000-00-00 00:00:00");		

		$result = $database->resultset();

		if (count($result) == 0) {
			$member = new Member($_SESSION['userID']);
			//Sweep master table, to see if they have logged in before this function was updated
			$login_array = $member->get_logins($_SESSION['userID']);
			//echo count($login_array);
			if (count($login_array) > 1) {
				$last_login = $login_array[1]['login_date'];
				$database = new Database;			
				$database->query("UPDATE members 
											SET current_login = NOW(), last_login = :last_login
											WHERE userID = :userID ");
				$database->bind(':userID', $_SESSION['userID']);
				$database->bind(':last_login', $last_login);		
				$database->execute();											
			} else {
				$database = new Database;			
				$database->query("UPDATE members 
											SET current_login = NOW(), last_login = NOW()
											WHERE userID = :userID ");
				$database->bind(':userID', $_SESSION['userID']);
				$database->execute();													
			}
		} else {
			$last_login = $result[0]['current_login'];
			$database = new Database;			
			$database->query("UPDATE members 
										SET current_login = NOW(), last_login = :last_login
										WHERE userID = :userID ");
			$database->bind(':userID', $_SESSION['userID']);
			$database->bind(':last_login', $last_login);		
			$database->execute();																						
		}			
	}	
	
	function register_user($firstname, $lastname, $email, $password, $access, $phone, $provider) {

		if ($access == "catscradle") {
			//check if username is unique
			$database = new Database;			
			$database->query("SELECT * FROM users WHERE email = :email");
			$database->bind(':email', $email);		
			$result = $database->resultset();																						
			//echo count($result);
			if (count($result) > 0) {
				return "duplicate";
			} else {	
				$utilities = new Utilities;
				//encrypt password
				$options = ['cost' => 10,];
				$new_pass = password_hash($password, PASSWORD_BCRYPT, $options);		
				
				$valid_hash = $utilities->generateRandomString(8);
						
				//insert into member database		
				$database = new Database;			
				$database->query("INSERT INTO users (first_name, last_name, provider, email, password, phone) VALUES
												(:firstname, :lastname, :provider, :email, :password, :phone) ");
				$database->bind(':firstname', $firstname);		
				$database->bind(':lastname', $lastname);		
				$database->bind(':provider', $provider);		
				$database->bind(':email', $email);	
				$database->bind(':password', $new_pass);	
				$database->bind(':phone', $phone);	
						
				$database->execute();
				$userID = $database->lastInsertID();
				

				$database->query("SELECT userID, first_name, last_name, provider FROM users WHERE email = :email");
				$database->bind(':email', $email);
				$result = $database->resultset();
				
				if (isset($_SESSION['fb_ID'])) {
					$login_type = "FB";
				} else {
					$login_type = "pass";
				}				

				$this->set_session_variables($result, $login_type);

/*
				$message = new Message;	
				$message->send_verification_notification($valid_hash, $userID);
*/

				//destroy cookie
				setcookie('ID', "", time()-3600, '/')	;		

				//return $userID;
				return "yes";
			}		
		} else {
			return "access";	
		}	
	}
	
/*
	function register_provider($firstname, $lastname, $email, $password, $phone) {
		
		if ($access == "catscradle") {
			//check if username is unique
			$database = new Database;			
			$database->query("SELECT * FROM members WHERE email = :email");
			$database->bind(':email', $email);		
			$result = $database->resultset();																						
			
			if (count($result) > 0) {
				return "duplicate";
			} else {	
				$utilities = new Utilities;

				$options = ['cost' => 10,];
				$new_pass = password_hash($password, PASSWORD_BCRYPT, $options);		
				
				$valid_hash = $utilities->generateRandomString(8);
				
				//insert into member database		
				$database = new Database;			
				$database->query("INSERT INTO members (firstname, lastname, type, email, zip, password, pass_test, creation_date, valid, terms_date, terms, profile_status, valid_hash, ref_jobID) VALUES
											(:firstname, :lastname, :type, :email, :zip, :password, :pass_test, NOW(), :valid, NOW(), :terms, :profile_status, :valid_hash, :jobID) ");
				$database->bind(':firstname', $firstname);		
				$database->bind(':lastname', $lastname);		
				$database->bind(':type', "employee");		
				$database->bind(':email', $email);
				$database->bind(':zip', $zip);		
				$database->bind(':password', $new_pass);	
				$database->bind(':pass_test', 'Y');	
				$database->bind(':valid', "Y");
				$database->bind(':terms', "Y");	
				$database->bind(':profile_status', "1");																																					
				$database->bind(':valid_hash', $valid_hash);							
				$database->bind(':jobID', $jobID);							
				$database->execute();
				$userID = $database->lastInsertID();
				
				//If referenceID is valid, insert into ref table
				if(isset($_COOKIE['ID'])) {
					$tracking_array = explode(",", $_COOKIE['ID']);

					$refID = $tracking_array[0];
					$cmp = $tracking_array[1];
					$rgn = $tracking_array[2];
					$ste = $tracking_array[3];
					$dmg = $tracking_array[4];
					$ad = $tracking_array[5];
					$msc_a = $tracking_array[6];
					$msc_b = $tracking_array[7];
				} else {
					$refID = $reference['refID'];
					$cmp = $reference['CMP'];
					$rgn = $reference['RGN'];
					$ste = $reference['STE'];
					$dmg = $reference['DMG'];
					$ad = $reference['AD'];
					$msc_a = $reference['MSCA'];
					$msc_b = $reference['MSCB'];									
				}
				
				$database = new Database;			
				$database->query("INSERT INTO signup_ref (userID, refID, CMP, RGN, STE, DMG, AD, MSCA, MSCB) VALUES
												(:userID, :refID, :cmp, :rgn, :ste, :dmg, :ad, :msca, :mscb) ");

				$database->bind(':userID', $userID);		
				$database->bind(':refID', $refID);		
				$database->bind(':cmp', $cmp);		
				$database->bind(':rgn', $rgn);		
				$database->bind(':ste', $ste);		
				$database->bind(':dmg', $dmg);		
				$database->bind(':ad', $ad);		
				$database->bind(':msca', $msc_a);		
				$database->bind(':mscb', $msc_b);		

				$database->execute();	
				
				$database->query("SELECT userID, firstname, lastname, type FROM members WHERE email = :email");
				$database->bind(':email', $email);
				$result = $database->resultset();

				if (isset($_SESSION['fb_ID'])) {
					$login_type = "FB";
				} else {
					$login_type = "pass";
				}
				
				//test the bounty recommendation table against the email used to sign up, and set the recommendedID
				//in this case there are two possible emails, if the person used the link and signed up with a different email address, we must test both cases
				$database->query("UPDATE bounty_recommendations
											SET recommendedID = :recommendedID
											WHERE email = :email");
				$database->bind(':email', $email);
				$database->bind(':recommendedID', $userID);
				$database->execute();
				
				if (isset($_SESSION['recommend'])) {
					//see if the user changed emails during signup, if so run the same as above
					if ($email != $_SESSION['recommend']['email']) {
						$database->query("UPDATE bounty_recommendations
													SET recommendedID = :recommendedID
													WHERE email = :email");
						$database->bind(':email', $_SESSION['recommend']['email']);
						$database->bind(':recommendedID', $userID);
						$database->execute();						
					}
					
					//mark the current job as viewed, to make sure others don't use this link
					$database->query("UPDATE bounty_recommendations
												SET recommend_status = :recommend_status
												WHERE ID = :ID");
					$database->bind(':recommend_status', 'Viewed');
					$database->bind(':ID', $_SESSION['recommend']['recommendID']);
					$database->execute();						
					
					
					//if the user came from a recommendation, unset those variables
					unset($_SESSION['recommend']);
				}

				$this->set_session_variables($result, $login_type);								

				$message = new Message;							
				$message->send_verification_notification($valid_hash, $userID);	
				
				//destroy cookie
				setcookie('ID', "", time()-3600, '/')	;		
				//return $userID;
				return "yes";
			}			
		} else {
			return "access";	
		}	
	}
*/
	
	function facebook_connect($fb_ID, $email, $password) {
		//user attempting to connect fb_ID to email login, test first
		$database = new Database;
		$database->query("SELECT pass_test, password, userID, FB_id, valid FROM members
			                         WHERE email = :email");
		$database->bind(':email', $email);
		//$database->bind(':password', sha1($password));
		$result = $database->resultset();
		
		$valid_login = 'N';

		if (count($result) > 0) {
			foreach ($result as $row) {
				$pass_test = $row['pass_test'];
				$new_password = $row['password'];				
			} 
			
			if ($pass_test == 'Y') {
				if (password_verify($password, $new_password)) {
					$valid_login = "Y";														
				} else {
					$valid_login = "N";							
				}
			} else {
				if (password_verify(sha1($password), $new_password)) {
					$valid_login = "Y";		
					//update password encryption
					$utilities = new Utilities;
					$utilties->convert_password($userID, $password);												
				} else {
					$valid_login = "N";							
				}						
			}			
		} else {
			$valid_login = 'N';		
		}
		
		if ($valid_login == 'Y') {
			foreach ($result as $row) {
				if ($row['valid'] == "Y") {
					if ($row['FB_id'] == "") {
						//insert
						$this->insert_fb_ID($email, $fb_ID);
						echo "true";
					} else {
						echo "duplicate";
					}
				} else {
					echo "deactivate";
				}
			}
		} else {
			return "false";
		}
		
	}
	
	function insert_fb_ID($email, $fb_ID) {
		$database = new Database;		
		$database->query("UPDATE  members
									SET FB_id = :fb_ID
									WHERE email = :email LIMIT 1");
		$database->bind(':email', $email);		
		$database->bind(':fb_ID', $fb_ID);		
		$database->execute();																								
	}
	
	function email_verification($userID, $valid_hash) {
		$database = new Database;		
		$database->query("SELECT userID FROM members
									WHERE userID = :userID
									AND valid_hash = :valid_hash");
		$database->bind(':userID', $userID);		
		$database->bind(':valid_hash', $valid_hash);		
		$result = $database->resultset();																						

		if (count($result) == 1) {
			$database = new Database;		
			$database->query("UPDATE members
										SET email_validation = 'Y'
										WHERE userID = :userID");
			$database->bind(':userID', $userID);		
			$database->execute();	
			return "Y";			
		} else {
			return "N";
		}			
	}	
	
	function email_change($userID, $valid_hash) {
		$database = new Database;		
		$database->query("SELECT userID FROM email_change
									WHERE userID = :userID
									AND valid_hash = :valid_hash
									AND changed != :changed
									AND date_sent > DATE_SUB(NOW(), INTERVAL 1 day)");
		$database->bind(':userID', $userID);		
		$database->bind(':valid_hash', $valid_hash);		
		$database->bind(':changed', 'Y');		
		$result = $database->resultset();																						

		if (count($result) == 1) {
			return "Y";			
		} else {
			return "N";
		}			
	}	
	
	function reset_password($email) {
		$member_data = $this->test_email_address($email);
		
		if (!is_numeric($member_data['userID']) || $member_data['userID'] == 0 || $member_data['userID'] == "") {
			return "no";
		} elseif ($member_data['valid'] == "N") {
			return "deactivate";				
		} else {
			//reset password
/*
	OLD WAY
			$utilities = new Utilities;
			$database = new Database;
			$new_pass = $utilities->generateRandomString(8); 
			
			$database->query("UPDATE members 
										SET password = :password
										WHERE email = :email
										LIMIT 1");			
			$database->bind(':password', sha1($new_pass));																																					
			$database->bind(':email', $email);							
			$database->execute();
*/
			//see if the reset was recently sent (within 48 hours)
			$database = new Database;
			$database->query("SELECT ID, userID, token FROM password_reset 
										WHERE email = :email
										AND date_created BETWEEN NOW() - INTERVAL 2 DAY AND NOW()
										AND changed != :changed");			
			$database->bind(':email', $email);							
			$database->bind(':changed', 'Y');							
			$result = $database->resultset();

			if (count($result) == 1) {
				foreach($result as $row) {
					$token = $row['token'];
					$ID = $row['ID'];
					$userID = $row['userID'];
				}
				
				//reset date created
				$database = new Database;
				$database->query("UPDATE password_reset SET date_created = NOW() 
											WHERE ID = :ID");			
				$database->bind(':ID', $ID);							
				$database->execute();	
				
				$token_data = array('userID' => $userID, 'token' => $token);				
				return $token_data;	
			} else {
				//get userID
				$database = new Database;				
				$database->query("SELECT userID FROM members WHERE email = :email LIMIT 1 ");			
				$database->bind(':email', $email);							
				$result = $database->single();
				$userID = $result['userID'];
				
				$utilities = new Utilities;
				$token = $utilities->generateRandomString(12); 

				$database = new Database;				
				$database->query("INSERT INTO password_reset 
												(email, userID, token, date_created)
											VALUES 
												(:email, :userID, :token, NOW())");			
				$database->bind(':email', $email);							
				$database->bind(':userID', $userID);							
				$database->bind(':token', $token);							
				$database->execute();
	
				$token_data = array('userID' => $userID, 'token' => $token);				
				return $token_data;	
			}
			
		}		
	}
	
	function password_reset_validation_check($userID, $token, $access) {
		$database = new Database;
		
		if ($access == 'Y') {
			$database->query("SELECT ID FROM password_reset
										 WHERE userID = :userID
										 AND token = :token
										 AND changed != :changed ");			
		} else {
			$database->query("SELECT ID FROM password_reset
										 WHERE userID = :userID
										 AND token = :token
										 AND date_created BETWEEN NOW() - INTERVAL 2 DAY AND NOW()
										 AND changed != :changed ");
		}
									 
		$database->bind(':userID', $userID);							
		$database->bind(':token', $token);							
		$database->bind(':changed', 'Y');	
		$result = $database->resultset();
		if (count($result) > 0) {
			return "yes";
		} else {
			return "no";
		}
	}
	
	function change_password($userID, $token, $new_password) {
		//first check to see if user has verified email address or account is deactived
		$database = new Database;	
		$database->query("SELECT valid, email_validation FROM members WHERE userID = :userID");
		$database->bind(':userID', $userID);							
		$result = $database->single();
		
		$continue = "Y";
		
		if ($result['valid'] == "N") {
			$continue = "deactivate";
		} elseif ($result['email_validation'] != "Y") {
			$continue = "Y";			
		}
		
		if ($continue == "Y") {
			//make sure token is valid
			$database = new Database;
			$database->query("SELECT ID FROM password_reset 
										WHERE userID = :userID
										AND token = :token
										AND changed != :changed");			
			$database->bind(':userID', $userID);							
			$database->bind(':token', $token);							
			$database->bind(':changed', 'Y');							
			$result = $database->resultset();
			
			if (count($result) == 0) {
				$continue = "invalid";
			} else {
				//update password, then update password_reset table
				
				$options = ['cost' => 10,];
				$new_password = password_hash($new_password, PASSWORD_BCRYPT, $options);		
				
				$database = new Database;			
				$database->query("UPDATE members
											SET password = :password, pass_test = :pass_test
											WHERE userID = :userID");
				$database->bind(':userID', $userID);	
				$database->bind(':password', $new_password);	
				$database->bind(':pass_test', 'Y');	
				$database->execute();	
				
				$database = new Database;			
				$database->query("UPDATE password_reset
											SET changed = :changed
											WHERE userID = :userID
											AND token = :token");
				$database->bind(':userID', $userID);	
				$database->bind(':changed', 'Y');	
				$database->bind(':token', $token);	
				$database->execute();											
			}			
		}
		
		return $continue;
	}
		
	function test_email_address($email) {
		$database = new Database;
		
		$database->query("SELECT userID, valid_hash, valid, email_validation FROM members WHERE email = :email AND temp != :temp");
		$database->bind(':email', $email);							
		$database->bind(':temp', 'Y');							
		$result = $database->single();
		return $result;
	}
	


	function logout() {
		session_destroy();
	}	
	
	private function failed_logins() {		
		// array of throttling
		$throttle = array(30 => 30, 20 => 2, 10 => 1);
		
		// retrieve the latest failed login attempts
		$database = new Database;
		$database->query("SELECT MAX(attempted) AS attempted FROM failed_logins");			
		$result = $database->single();		

		if (count($result) > 0) {
		
		    $latest_attempt = (int) date('U', strtotime($result['attempted']));
		
		    // get the number of failed attempts
			$database = new Database;
			$database->query("SELECT COUNT(1) AS failed FROM failed_logins WHERE attempted > DATE_SUB(NOW(), INTERVAL 15 minute)");			
			$result = $database->single();	
			
			$failed_attempts = (int) $result['failed'];
			
		    if ($failed_attempts > 0) {
		        // get the returned row

				$remaining_delay = 0;
		        // assume the number of failed attempts was stored in $failed_attempts
		        foreach ($throttle as $attempts => $delay) {
			       // echo $failed_attempts." | ".$attempts. "XX ";
		            if ($failed_attempts > $attempts) {
		                // we need to throttle based on delay
	                    $remaining_delay = $delay - (time() - $latest_attempt);
	                    break;
		            } 
		        }  
		        
		        if ($remaining_delay > 0) {
			        //echo $remaining_delay;
			        return $remaining_delay;		        
		        } else {
			        return "false";
		        }      
		    } else {
			    return "false";
		    }
		}
	}
	
	public function database_test($step) {
		//The purpose of this function is to make sure that MySQL is responding
		// This is needed because there have been numerous issues with HostGator where MySQL stops responding randomly, this causes major issues
		// THis will test that MySQL is responding, if it is not, give a warning to the user and send an email to admin to let them know HostGator has gone down again

		switch($step) {
			case "test":
				$database = new Database;
				$database->query("SELECT userID FROM members LIMIT 1");			
				$result = $database->resultset();
				
				$count = count($result);
				if ($count != 1) {
					$message = new Message;
					$message->send_server_error($result);
				}		
				return $count;		
			break;
			
			case "email":
				$message = new Message;
				$message->send_server_error("NONE");
			break;
		}
	}		
		
}
?>