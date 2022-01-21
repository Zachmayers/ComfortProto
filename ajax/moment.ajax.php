<?php
//==================================
//!   Handler for ajax calls to Opportunity functions 
//==================================


//CHANGE FOR LIVE SITE
	require_once($_SERVER['DOCUMENT_ROOT'].'/loneme_proto/classes/moment.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/loneme_proto/classes/moment_list.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/loneme_proto/classes/member.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/loneme_proto/classes/utilities.class.php');		

/*
	require_once($_SERVER['DOCUMENT_ROOT'].'/mobile/opportunity_html_mobile.php');		
	require_once($_SERVER['DOCUMENT_ROOT'].'/html/opportunity_html.php');		
*/

	$utilities = new Utilities;
	$site_type	 = $utilities->site_type;
	
	session_start();
	
	if ($site_type == "prototype") {
		ini_set('display_errors',1);
		error_reporting(E_ALL|E_STRICT); 
	} 
	
	$momentID = $_POST['momentID'];	
 	$type = $_GET['type'];
 	 	
 	switch($type) {
	 	case "new_moment":
	 		$moment = new Moment($momentID);
								
			$event = trim($_POST['event']);
			$title = trim($_POST['title']);
			$address = trim($_POST['address']);
			$zip = trim($_POST['zip']);
			$date = trim($_POST['date']);
			$time = trim($_POST['time']);
			$description = trim($_POST['description']);
			
			$momenID = $moment->create_moment($event, $title, $address, $zip, $date, $time, $description);
			
			echo $momentID;
	 	break;
	 	
	 	case "checkin":
	 		
	 		$moment = new Moment($momentID);
								
			$user_type = trim($_POST['type']);
			
			$passcode = $moment->check($_SESSION['userID'], $user_type, "check_in", $momentID);
			
			echo $passcode;
	 	break;
	 	
	 	case "checkout":
	 		$moment = new Moment($momentID);
								
			$user_type = trim($_POST['type']);
			
			$moment->check($_SESSION['userID'], $user_type, "check_out", $momentID);			

	 	break;
	 	
	 	case "accept":
	 		$moment = new Moment($momentID);
			
			$result = $moment->accept($momentID); 
			echo $result;	 	
	 	break;
	 	
	 	case "send_message":
	 		$moment = new Moment($momentID);
			$message = trim($_POST['message']);
			$result = $moment->send_message($momentID, $message); 
			echo $result;	 	
	 	
	 	break;
	 	
	 	case "check_message":
	 		$moment = new Moment($momentID);
			
			$chat = $moment->get_updated_chat($momentID); 
			if (count($chat) == 0) {
				echo false;
			} else {
				echo "<div id='chat_box'>";
						if (count($chat) > 0) {
							foreach ($chat as $row) {
								if ($row['senderID'] == $_SESSION['userID']) {
									echo "<div class='col-12>";									
								} else {
									echo "<div class='col-12'>";									
								}
								echo "<div class='col-10'>";
								echo $row['message']."<br />".$row['date_created']."<br /> &nbsp; <br />";
								echo "</div>";
						}
					
					}
				echo "</div>";

			}
	 	
	 	break;
	 	
	 	
	 	case "rate":
	 		$moment = new Moment($momentID);

			$rating = $_POST['rating'];
			$notes = trim($_POST['notes']);
			$type = $_POST['type'];
			
			$test = $moment->rate_moment($rating, $notes, $type); 	
			echo $test;	 	
	 	break;
	 			
		case "check_message_alert":
	 		$moment_list = new MomentList($_SESSION['userID']);
			$chat = $moment_list->check_new_messages(); 
			if (count($chat) == 0) {
				echo "false";
			} else {
				echo "true";
			}
	 	
	 	break;
	
		case "report":
			$opportunity = new Opportunity($jobID);			

			$ID = $_POST['jobID'];
			$type = $_POST['type'];
			
			$opportunity->report_inappropriate_content($jobID, $type);
		break;
		
 	}