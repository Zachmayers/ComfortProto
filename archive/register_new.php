<?php
ini_set('display_errors',1); 
 error_reporting(E_ALL);
	// include function files for this application
	require_once('classes.php');
	$account = $_GET['type'];
	$login = new Login;
	$utility = new Utilities;
	
	$firstname = trim($_POST['first']);
	$lastname = trim($_POST['last']);
	$username = trim($_POST['login']);
	$password = trim($_POST['pass']);
	$access = trim($_POST['access']);	
	
	switch($account) {
		case "employer":
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
				$result = $login->register_employer($firstname, $lastname, $account, $username, $password, $access, $company, $position, $website);
				echo $result;		
			} else {
				echo "email";
			}
		break;
		
		case "employee":
			$zip = trim($_POST['zip']);			
			$phone = trim($_POST['phone']);			
			$jobID = trim($_POST['jobID']);
			
			if ($firstname == "" || $lastname == "" || $password == "" || $zip == "") {
				echo "empty";
			} elseif ($utility->zip_validate($zip) == "invalid") {
				echo "zip";
			} elseif (filter_var($username, FILTER_VALIDATE_EMAIL) !== false) {
				$result = $login->register_employee($firstname, $lastname, $account, $username, $password, $access, $zip, $phone, $jobID);
				echo $result;		
			} else {
				echo "email";
			}
		break;
	}

