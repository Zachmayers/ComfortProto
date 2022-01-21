<?php
//==================================
//!   Handler for ajax calls to Job List functions 
//==================================

//CHANGE FOR LIVE SITE
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/job_list.class.php');
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
	
		case "jobs_by_store":
			$job_list = new JobList($_SESSION['userID']);		
			$storeID = trim($_POST['storeID']);
			$result_type = trim($_POST['result_type']);
			
			$result = $job_list->filter_current_jobs_by_store($storeID, $result_type);
			echo $result;
		break;
	} 
?>