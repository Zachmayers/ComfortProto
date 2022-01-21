<?php
//==================================
//!   Handler for ajax calls to Message functions 
//==================================

//CHANGE FOR LIVE SITE
	require_once($_SERVER['DOCUMENT_ROOT'].'/CLEAN/classes/message.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/CLEAN/classes/utilities.class.php');		
	$utilities = new Utilities;
	$site_type	 = $utilities->site_type;
	
	session_start();
	
	if ($site_type == "prototype") {
		ini_set('display_errors',1);
		error_reporting(E_ALL|E_STRICT); 
	} 
	
	$type = $_GET['type'];
	
	$message = new Message;
	
	switch($type) {		
		case "send_invite_email":
			$type = $_POST['type'];
			$email = $_POST['email'];
			
			if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))  {
				echo "non_email";
			} else {
				$message = new Message;
				$test = $message->send_invite($type, $email);
				echo $test;
			}
		break;
		
		case "send_job_email":
			$jobID = $_POST['jobID'];
			$email = $_POST['email'];
			
			if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))  {
				echo "non_email";
			} else {
				$message = new Message;
				$test = $message->send_job_email($jobID, $email);
				echo $test;
			}		
		break;
	} 
?>