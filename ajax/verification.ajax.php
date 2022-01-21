<?php
//==================================
//!   Handler for ajax calls to Verification functions 
//==================================

//CHANGE FOR LIVE SITE
	require_once($_SERVER['DOCUMENT_ROOT'].'/loneme_proto/classes/message.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/loneme_proto/classes/verification.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/loneme_proto/classes/utilities.class.php');		


	$utilities = new Utilities;
	$site_type	 = $utilities->site_type;
	
	session_start();
	
	if ($site_type == "prototype") {
		ini_set('display_errors',1);
		error_reporting(E_ALL|E_STRICT); 
	} 
	
	$type = $_GET['type'];
	
	switch($type) {	
		case "register_user":
			$access = trim($_POST['access']);
			$firstname = trim($_POST['first']);
			$lastname = trim($_POST['last']);
			$username = trim($_POST['login']);
			$password = trim($_POST['pass']);
			$phone = trim($_POST['phone']);
			$provider = $_POST['provider'];
					
			if ($firstname == "" || $lastname == "" || $password == "") {
				echo "empty";
			} elseif (filter_var($username, FILTER_VALIDATE_EMAIL) !== false) {
				$verification = new Verification;
				$result = $verification->register_user($firstname, $lastname, $username, $password, $access, $phone, $provider);
				echo $result;	
				
				//errors have been occuring during signup, the code below is an attempt to catch the error
			if($result != "duplicate" &&  $result != "access" && $result != "yes") {
				echo $result;
				}
			} else {
				echo "email";
			}
		break;		
			
		
		case "register_employer_admin":
			$access = trim($_POST['access']);
			$firstname = trim($_POST['first']);
			$lastname = trim($_POST['last']);
			$username = trim($_POST['login']);
			$password = trim($_POST['pass']);
			$company = trim($_POST['company']);
			$position = trim($_POST['position']);
			$website = trim($_POST['website']);
			$refID = "admin";
			
			//strip http off of link
			$pos = strpos($website, "http://");
			$pos_s = strpos($website, "https://");
			
			if ($pos !== false) {
				$website = str_replace("http://", "", $reference_link);
			}
			
			if ($pos_s !== false) {
				$website = str_replace("https://", "", $reference_link);
			}								
		
			if ($firstname == "" || $lastname == "" || $password == "" || $company == "" || $position == "") {
				echo "empty";
			} elseif (filter_var($username, FILTER_VALIDATE_EMAIL) !== false) {
				$verification = new Verification;
				$result = $verification->register_employer_admin($firstname, $lastname, $username, $password, $access, $company, $position, $website, $refID);
				echo $result;					
			} else {
				echo "email";
			}		
		break;
		
		case "register_user":
			$access = trim($_POST['access']);
			$firstname = trim($_POST['first']);
			$lastname = trim($_POST['last']);
			$username = trim($_POST['login']);
			$password = trim($_POST['pass']);
			$phone = trim($_POST['phone']);			
			$provider = trim($_POST['provider']);
			
			
			if ($firstname == "" || $lastname == "" || $password == "") {
				echo "empty";
			} elseif ($utilities->zip_validate($zip) == "invalid") {
				echo "zip";
			} elseif (filter_var($username, FILTER_VALIDATE_EMAIL) !== false) {
				$verification = new Verification;	
				$result = $verification->register_provider($firstname, $lastname, $username, $password, $access, $phone, $provider);
				echo $result;	
			} else {
				echo "email";
			}
		break;			
				
		case "login":
			$username = strtolower($_POST['user']);
			$password = $_POST['pass'];
			$jobID = $_POST['jobID'];
			$public_hash = $_POST['public_hash'];
			$type = $_POST['type'];
			
			if ($type == "mobile") {
				$_SESSION['device'] = "mobile";
			} else {
				$_SESSION['device'] = "full";		
			}
			
			$verification = new Verification;			
			$verification->user_login($username, $password, $jobID, $public_hash);			
		break;	
		
		case "facebook_test":
			$verification = new Verification;			
	
			//this person click "login with facebook" option, check to see if account exists with the provided email address & fbID
			$email = $_POST['email'];
			$fb_ID = $_POST['fb_ID'];
			$jobID = $_POST['jobID'];
			$public_hash = $_POST['public_hash'];
			$firstname = trim($_POST['firstname']);
			$lastname = trim($_POST['lastname']);
			
			$user_test = $verification->fb_user_test($email, $fb_ID);

			if ($user_test == "true") {
				echo "login";				
			} elseif ($user_test == "false") {
				//set session variables for use on the next register page
				$_SESSION['fb_firstname'] = $firstname;
				$_SESSION['fb_lastname'] = $lastname;
				$_SESSION['fb_email'] = $email;
 				$_SESSION['fb_ID'] = $fb_ID;

				echo "register";
			} else {
				echo "error";
			}		
		break;
		
		case "facebook_register":
			$access = trim($_POST['access']);
			$user_type = $_POST['user_type'];
			$fb_ID = $_POST['fb_ID'];
			$firstname = trim($_POST['firstname']);
			$lastname = trim($_POST['lastname']);
			$username = trim($_POST['email']);
			$zip = trim($_POST['zip']);
			$jobID = trim($_POST['jobID']);
			$refID = trim($_POST['refID']);
			$cmp = trim($_POST['jobID']);
			$cmp = trim($_POST['CMP']);
			$rgn = trim($_POST['RGN']);
			$ste = trim($_POST['STE']);
			$dmg = trim($_POST['DMG']);
			$ad = trim($_POST['AD']);
			$msc_a = trim($_POST['MSCA']);
			$msc_b = trim($_POST['MSCB']);
			
			$reference = array("refID" => $refID,
										"CMP" => $cmp,
										"RGN" => $rgn,
										"STE" => $ste,
										"DMG" =>$dmg,
										"AD" => $ad,
										"MSCA" => $msc_a,
										"MSCB" => $msc_b,
										"referral" => "NA");
										
			//generate a random password
			$password = $utilities->generateRandomString('12');
			if ($firstname == "" || $lastname == ""  || $zip == "") {
				echo "empty";
			} elseif ($utilities->zip_validate($zip) == "invalid") {
				echo "zip";
			} elseif (filter_var($username, FILTER_VALIDATE_EMAIL) !== false) {
				$verification = new Verification;	

				if ($user_type == "employee") {
					$result = $verification->register_employee($firstname, $lastname, $username, $password, $access, $zip, $jobID, $reference);					
				} elseif ($user_type == "employer") {
					$result = $verification->register_employer($firstname, $lastname, $username, $password, $access, $reference);					
				} else {
					$result = "error";
				}
				if ($result == "yes") {
					//add facebook ID to DB
					$verification->insert_fb_ID($username, $fb_ID);
				}
				echo $result;	
			} else {
				echo "email";
			}
			
		break;
		
		case "facebook_login":
			$verification = new Verification;			

			$email = $_POST['email'];
			$fb_ID = $_POST['fb_ID'];
			$jobID = $_POST['jobID'];
			$public_hash = $_POST['public_hash'];
			
			$result = $verification->facebook_login($email, $fb_ID, $jobID, $public_hash);	
			
			echo $result;
		break;
		
		case "email_verify":
			$email = $_POST['email'];
			$verification = new Verification;
			
			$user_array = $verification->test_email_address($email);
				
			if (isset($user_array['userID']) && $user_array['userID'] > 0) {
				if ($user_array['valid'] == "Y") {
					$message = new Message;
					$message->send_verification_notification($user_array['valid_hash'], $user_array['userID']);
					echo "Y";
				} else {
					echo "deactivate";
				}
			} else {
				echo "N";
			}	
		break;
		
		case "facebook_connect":
			$fb_ID = $_POST['fb_ID'];
			$email = trim($_POST['email']);
			$password = trim($_POST['password']);	
			
			$verification = new Verification;
			$result = $verification->facebook_connect($fb_ID, $email, $password);
			
			echo $result;		
		break;
		
		case "forgot_password":
			$email = $_POST['email'];
			$verification = new Verification;

			if ($email != "") {
				$reset_test = $verification->reset_password($email);
				if ($reset_test == "no" || $reset_test == "deactivate") {
					echo $reset_test;
				} else {
					//send email
					$userID = $reset_test['userID'];
					$token = $reset_test['token'];
					
					$message = new Message();
					$message->password_reset_link($userID, $email, $token);
					echo "yes";
				}

			} else {
				echo "no";
			}
		break;
		
		case "change_password":
			$userID = $_POST['ID'];
			$token = $_POST['token'];
			$new_pass = $_POST['new_pass'];

			if ($userID != "" && $token != "" && $new_pass != "") {
				$verification = new Verification;
				
				$change_test = $verification->change_password($userID, $token, $new_pass);
				if ($change_test == "invalid" || $change_test == "deactivate") {
					echo $change_test;
				} else {
					echo "yes";
				}
			} else {
				echo "no";
			}
		break;
		
		case "cancel_interview":
			$matchID = $_POST['matchID'];
			
			$candidate = new Candidate($matchID);

			$candidate->cancel_interview($matchID, "employee_cancel");				
		break;		
		
		case "mysql_test":
			$step = $_POST['step'];
			
			$verification = new Verification;

			$test = $verification->database_test($step);
			if ($step == "test") {
				echo $test;
			}
		break;

		case "unsubscribe":
			$userID = trim($_POST['userID']);
			$code = trim($_POST['code']);
			$hash = trim($_POST['hash']);
			$sub_option = trim($_POST['sub_option']);

			$verification = new Verification;
			
			$result = $verification->unsubscribe($code, $userID, $hash, $sub_option);
			echo $result;
		break;		
	} 
