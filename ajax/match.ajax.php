<?php
//==================================
//!   Handler for ajax calls to Match functions 
//==================================

//CHANGE FOR LIVE SITE
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/match.class.php');	
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/job.class.php');	
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/utilities.class.php');		
	$utilities = new Utilities;
	$site_type	 = $utilities->site_type;
	
	session_start();
	
	if ($site_type == "prototype") {
		ini_set('display_errors',1);
		error_reporting(E_ALL|E_STRICT); 
	} 

 	$type = $_GET['type'];
	
	switch($type) {	
		case "match":
			//change post type in case they have fiirst put a bounty in, then gone back to a free job
			$job = new Job($_POST['jobID']);
			$job->update_job("clear_bounty", "");
		
			$match = new Match();
			$jobID = $_POST['jobID'];		

			$match->get_match_array($jobID);			
		break;
		
		case "match_bounty":
			$jobID = $_POST['jobID'];		
			$employer_phone = $_POST['employer_phone'];		

			$job = new Job($jobID);
			$job->update_job("checkout_paid", $employer_phone);	
			
			$match = new Match();
			$match->get_match_array($jobID);			
		break;													
															
	} 
?>