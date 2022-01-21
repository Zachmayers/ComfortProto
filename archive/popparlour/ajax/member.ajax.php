<?php
//==================================
//!   Handler for ajax calls to membert functions 
//==================================

//CHANGE FOR LIVE SITE
	require_once($_SERVER['DOCUMENT_ROOT'].'/handshake/classes/member.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/handshake/classes/utilities.class.php');
	$utilities = new Utilities;
	$site_type	 = $utilities->site_type;
	
	session_start();
	
	if ($site_type == "prototype") {
		ini_set('display_errors',1);
		error_reporting(E_ALL|E_STRICT); 
	} 
	
	$type = $_GET['type'];
	
	switch($type) {	
	
		case "add_tokens":
			$member = new Member($_SESSION['userID']);
			
			$number = trim($_POST['number']);

			if (is_numeric($number) && $number < 100) {
				$member->add_tokens($_SESSION['userID'], $number);			
				echo "true";
			} else {
				echo "error";
			}
		break;
		
		case "add_feedback":
			$userID = trim($_POST['userID']);		
			$tradeID = trim($_POST['tradeID']);		
			$rating = trim($_POST['rating']);		
			$review = trim($_POST['review']);		
	
			$member = new Member($userID);

			$result = $member->add_feedback($userID, $tradeID, $rating, $review);			
			echo $result;
		break;

		case "edit_nickname":
			$nickname = trim($_POST['nickname']);

			$member = new Member($userID);

			$result = $member->edit_nickname($nickname);			
			echo $result;
		break;

		case "edit_name":
			$firstname = trim($_POST['firstname']);
			$lastname = trim($_POST['lastname']);

			$member = new Member($userID);

			$result = $member->edit_name($firstname, $lastname);			
			echo $result;
		break;
		
	} 
?>