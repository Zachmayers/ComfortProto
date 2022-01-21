<?php
//==================================
//!   Handler for ajax calls to Opportunity functions 
//==================================


//CHANGE FOR LIVE SITE
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/opportunity.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/employee.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/opportunity_list.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/html/opportunity_list_html.php');		
	require_once($_SERVER['DOCUMENT_ROOT'].'/mobile/opportunity_list_html_mobile.php');	
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
	 	case "list_viewed":
			
			//first get all opportunities
			$opportunity_list = new OpportunityList($_SESSION['userID']);
			$job_matches = $opportunity_list->get_qualified_opportunities();
			//mark each as viewed
			foreach($job_matches as $row) {
				$opportunity = new Opportunity($row['jobID']);
				$opportunity->update_opportunity("list_view", "");
			}
		break;	
		
		case "load_qualified_list":
			$device = $_GET['device'];

			//Determine whether email address has been verified
			$email_verification = $utilities->check_email_verification();

			$opportunity_list = new OpportunityList($_SESSION['userID']);

			$opportunity_list = $opportunity_list->get_local_opportunities();
			
			$employee = new Employee($_SESSION['userID']);
			$employee_data = $employee->get_employee_data();
			$profile_status = $employee_data['general']['profile_status'];
			
			//get job types this employee is seeking to show relevent only jobs
			$employee_match_types = $employee->get_match_types();
						 		
			if ($device == "full") {
				qualified_opportunity_list_html($opportunity_list, $employee_match_types, $email_verification, $profile_status);
				//qualified_opportunity_list_html($qualified_bounty_list, $qualified_list, 0, $email_verification);	
			} elseif ($device == "mobile") {
				qualified_opportunity_list_html_mobile($opportunity_list, $employee_match_types, $email_verification, $profile_status);
				//qualified_opportunity_list_html_mobile($qualified_bounty_list, $qualified_list, 0, $email_verification);					
			}				
		break;
		
		case "load_unqualified_list":
			$device = $_GET['device'];
			
			$opportunity_list = new OpportunityList($_SESSION['userID']);			
			$unqualified_list = $opportunity_list->get_unqualified_opportunities();

			//Determine whether email address has been verified
			$email_verification = $utilities->check_email_verification();
		
			if ($device == "full") {
				unqualified_opportunity_list_html($unqualified_list, $email_verification);	
			} elseif ($device == "mobile") {
				unqualified_opportunity_list_html_mobile($unqualified_list, $email_verification);					
			}				
		break;	
		
		case "filter_list":
			$device = $_GET['device'];

			$skill_list = json_decode($_POST['skill_list'], true);
			$store_list = json_decode($_POST['store_list'], true);
			$schedule_list = json_decode($_POST['schedule_list'], true);
			$comp_list = json_decode($_POST['comp_list'], true);
			$hourly_min = trim($_POST['hourly_min']);			
			$hourly_max = trim($_POST['hourly_max']);			
			$salary_min = trim($_POST['salary_min']);			
			$salary_max = trim($_POST['salary_max']);			

			$opportunity_list = new OpportunityList($_SESSION['userID']);			
//			$filtered_list = $opportunity_list->get_qualified_opportunities();

			$filtered_qualified_bounty_list = $opportunity_list->get_qualified_opportunities("bounty");			
			$filtered_qualified_list = $opportunity_list->get_qualified_opportunities("non_bounty");

			$original_count = count($filtered_qualified_bounty_list) + count($filtered_qualified_list);

			//Determine whether email address has been verified
			$email_verification = $utilities->check_email_verification();
			
			if (count($skill_list) > 0) {
				$filtered_qualified_bounty_list = $opportunity_list->filter_opportunity_list($filtered_qualified_bounty_list, 'skills', $skill_list);
				$filtered_qualified_list = $opportunity_list->filter_opportunity_list($filtered_qualified_list, 'skills', $skill_list);
			}

			if (count($store_list) > 0) {			
				$filtered_qualified_bounty_list = $opportunity_list->filter_opportunity_list($filtered_qualified_bounty_list, 'stores', $store_list);
				$filtered_qualified_list = $opportunity_list->filter_opportunity_list($filtered_qualified_list, 'stores', $store_list);
			}

			if (count($schedule_list) > 0) {						
				$filtered_qualified_bounty_list = $opportunity_list->filter_opportunity_list($filtered_qualified_bounty_list, 'schedules', $schedule_list);
				$filtered_qualified_list = $opportunity_list->filter_opportunity_list($filtered_bounty_list, 'schedules', $schedule_list);
			}

			if (count($comp_list) > 0) {									
				$filtered_qualified_bounty_list = $opportunity_list->filter_opportunity_list($filtered_qualified_bounty_list, 'comp_type', $comp_list);
				$filtered_qualified_list = $opportunity_list->filter_opportunity_list($filtered_qualified_list, 'comp_type', $comp_list);
			}
			
			if (in_array("Hourly", $comp_list)) {
				$filter_array = array("min" => $hourly_min, "max" => $hourly_max);
				$filtered_qualified_bounty_list = $opportunity_list->filter_opportunity_list($filtered_qualified_bounty_list, 'hourly', $filter_array);				
				$filtered_qualified_list = $opportunity_list->filter_opportunity_list($filtered_qualified_list, 'hourly', $filter_array);				
			}
			
			if (in_array("Salary", $comp_list)) {
				$filter_array = array("min" => $salary_min, "max" => $salary_max);
				$filtered_qualified_bounty_list = $opportunity_list->filter_opportunity_list($filtered_qualified_bounty_list, 'salary', $filter_array);				
				$filtered_qualified_list = $opportunity_list->filter_opportunity_list($filtered_qualified_list, 'salary', $filter_array);				
			}			
			
			$final_count = count($filtered_qualified_bounty_list) + count($filtered_qualified_list);
			$hidden_count = $original_count - $final_count;
			
			if ($device == "full") {
				qualified_opportunity_list_html($filtered_qualified_bounty_list, $filtered_qualified_list, $hidden_count, $email_verification);	
			} elseif ($device == "mobile") {
				qualified_opportunity_list_html_mobile($filtered_qualified_bounty_list, $filtered_qualified_list, $hidden_count, $email_verification);					
			}				
		break;	
 	}