<?php
//==================================
//!   Handler for ajax calls to Main functions 
//==================================

//CHANGE FOR LIVE SITE
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/member.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/job_list.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/opportunity_list.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/employee.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/html/main_html.php');		
	require_once($_SERVER['DOCUMENT_ROOT'].'/mobile/main_html_mobile.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/utilities.class.php');		
	$utilities = new Utilities;
	$site_type	 = $utilities->site_type;
	
	session_start();
	
	if ($site_type == "prototype") {
		ini_set('display_errors',1);
		error_reporting(E_ALL|E_STRICT); 
	} 

if(isset($_GET['type'])) {	

	$type = $_GET['type'];

	switch($type) {		
		case "change_password":
			$old_pass = $_POST['old_pass'];
			$new_pass = $_POST['new_pass'];

			$member = new Member($_SESSION['userID']);
			$result = $member->change_password($old_pass, $new_pass);
		break;
		
		case "change_device":
			$device_type = $_POST['device_type'];
			
			if ($device_type == "mobile") {
				$_SESSION['device'] = "full";
			} else {
				$_SESSION['device'] = "mobile";				
			}
		break;
		
		case "check_profile_status":
			//if profile hasn't been marked as complete, but has enough info to be complete, change status too complete
			$employee = new Employee($_SESSION['userID']);
			$employee_data = $employee->get_employee_data();
			
			$profile_status = $employee_data['general']['profile_status'];
			
			if ($profile_status != "complete") {
				//count past employment
				$past_employment = $employee_data['employment'];
				if(count($past_employment) > 0) {
					$employee->update_employee_record("status", "complete", "");
					echo "complete";
				}
			}
		break;
		
		case "load_job_summary":
			$job_list = new JobList($_SESSION['userID']);
			
			$job_array = $job_list->get_job_list_by_group();
			
			//break up master array
			$current_jobs =$job_array['current_jobs'];
			$float_jobs =$job_array['float_jobs'];
			$incomplete_jobs =$job_array['incomplete_jobs'];
			
			$current_count = $job_array['current_count'];
			$float_count = $job_array['float_count'];
			$incomplete_count = $job_array['incomplete_count'];
			
			employer_job_summary_html($current_jobs, $float_jobs, $incomplete_jobs, $current_count, $float_count, $incomplete_count);	
		break;
		
		case "load_opportunity_summary":
			$device = $_GET['device'];
			$opportunity = new OpportunityList($_SESSION['userID']);	
			$employee = new Employee($_SESSION['userID']);	
			$employee_data = $employee->get_employee_data();

			if (isset($employee_data['general']['last_login']) && $employee_data['general']['last_login'] > 0) {
				$missed_jobs = $opportunity->get_missed_opportunities($employee_data['general']['last_login'], $employee_data['general']['current_login']);
			} else {
				$missed_jobs = "NA";
			}

			$opportunity_array = $opportunity->get_qualified_opportunities();
			$unqualified_count = count($opportunity->get_unqualified_opportunities());
					
			if ($device == "full") {
				employee_opportunity_summary_html($opportunity_array, $unqualified_count);	
			} elseif ($device == "mobile") {
				employee_opportunity_summary_mobile_html($opportunity_array, $unqualified_count);					
			}
		break;		
	} 
}
?>