<?php
//==================================
//!   Handler for ajax calls to Employer functions 
//==================================

//CHANGE FOR LIVE SITE

	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/member.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/employer.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/utilities.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/verification.class.php');	
	$utilities = new Utilities;
	$site_type	 = $utilities->site_type;
	
	session_start();
	
	if ($site_type == "prototype") {
		ini_set('display_errors',1);
		error_reporting(E_ALL|E_STRICT); 
	} 
	
	$type = $_GET['type'];

	$member = new Member($_SESSION['userID']);
	$employer = new Employer($_SESSION['userID']);
	
	switch($type) {	
		
		case "employer_name":
			$firstname = trim($_POST['first_name']);
			$lastname = trim($_POST['last_name']);

			$member_update_array = array("firstname" => $firstname, "lastname" =>$lastname);
			$member->update_member_data('employer_general', $member_update_array);												
		break;

		case "employer_position":
			$position = trim($_POST['position']);	

			$employer_update_array = array("position" =>$position);
			$employer->update_employer_record($employer_update_array);			
		break;
		
		case "change_email":
			if (filter_var($_POST['new_email'], FILTER_VALIDATE_EMAIL) !== false) {
				$email_array = array("old_email" => $_POST['old_email'], "new_email" => $_POST['new_email']);
				$result = $member->update_email_address($email_array); 	
				echo $result;
			} else {
				echo "email";
			}											
		break;
		
		case "register_new":
			$verification = new Verification;
		
			$firstname = trim($_POST['first']);
			$lastname = trim($_POST['last']);
			$username = trim($_POST['login']);
			$password = trim($_POST['pass']);
			$access = trim($_POST['access']);	
			$company = trim($_POST['company']);
			$position = trim($_POST['position']);
			$website = trim($_POST['website']);
			
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
				$result = $verification->register_employer($firstname, $lastname, $account, $username, $password, $access, $company, $position, $website);
				echo $result;		
			} else {
				echo "email";
			}	
		break;
		
		case "send_reminder":
			if (isset($_SESSION['userID'])) {
				$employer->send_reminder();
			}
		break;
		
		case "remove_photo":
			$storeID = $_POST['storeID'];
			$employer->remove_photo($storeID);		
		break;		
		
		case "new_email":
			//users who have verified their address but need to change it
			if (filter_var($_POST['new_email'], FILTER_VALIDATE_EMAIL) !== false) {
				$email_array = array("old_email" => $_POST['old_email'], "new_email" => $_POST['new_email']);
				$result = $member->update_email_address("verified", $email_array);	
				echo $result;
			} else {
				echo "email";
			}											
		break;						
		
		case "switch_account_type":
				$zip = trim($_POST['zip']);
				$zip_test = $utilities->zip_validate($zip);
				
				if ($zip_test == "valid") {
				 	$result = $employer->switch_account_type($zip);	
				 	echo $result;
				} else {
					echo "zip";
				}
		break;			
	} 
	
?>