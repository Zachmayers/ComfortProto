<?php

//CHANGE FOR LIVE SITE
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/candidate.class.php');		
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/utilities.class.php');		
	$utilities = new Utilities;
	$site_type	 = $utilities->site_type;
	
	session_start();
	
	if ($site_type == "prototype") {
		ini_set('display_errors',1);
		error_reporting(E_ALL|E_STRICT); 
	} 
	
	$type = $_GET['type'];
	
	$candidate = new Candidate($_POST['matchID']);
	
	switch($type) {
		case "highlight":			
			$highlight = $_POST['highlight'];
			$matchID = $_POST['matchID'];
			
			$jobID = $candidate->highlight_toggle($highlight);
			echo $jobID;
		break;
		
		case "edit_notes":
			$notesID = $_POST['notesID'];
			$candidateID = $_POST['candidateID'];
			$matchID = $_POST['matchID'];
			
			$culture = $_POST['culture'];
			$experience = $_POST['experience'];
			$availability = $_POST['availability'];
			$notes = trim($_POST['notes']);
			
			$result = $candidate->edit_notes($notesID, $candidateID, $matchID, $culture, $experience, $availability, $notes);
			echo $result;
		break;
		
		case "add_interview":
			$matchID = $_POST['matchID'];
			$candidateID = $_POST['candidateID'];
			$month = $_POST['month'];
			$day = $_POST['day'];
			$year = $_POST['year'];
			$hour = $_POST['hour'];
			$minute = $_POST['minute'];
			$ampm = $_POST['ampm'];
			
			$result = $candidate->add_interview($matchID, $candidateID, $month, $day, $year, $hour, $minute, $ampm);
			echo $result;
		break;

		case "edit_interview":
			$matchID = $_POST['matchID'];
			$interviewID = $_POST['interviewID'];
			$candidateID = $_POST['candidateID'];
			$month = $_POST['month'];
			$day = $_POST['day'];
			$year = $_POST['year'];
			$hour = $_POST['hour'];
			$minute = $_POST['minute'];
			$ampm = $_POST['ampm'];
			
			$result = $candidate->edit_interview($matchID, $interviewID, $candidateID, $month, $day, $year, $hour, $minute, $ampm);
			echo $result;
		break;	
		
		case "cancel_interview":
			$matchID = $_POST['matchID'];
			
			$result = $candidate->cancel_interview($matchID, "employer_cancel");
		break;		
			
	}
	
?>