<?php
//Page Description

//Required files
	require_once('html/general_content_html.php');
	require_once('admin/admin_culinary_html_class.php');
																																																																																																														
	require_once('classes/admin.class.php');		
	require_once('classes/employee.class.php');		
	require_once('classes/employer.class.php');		
	require_once('classes/member.class.php');		
	require_once('classes/candidate.class.php');		

	
//start session
	session_start();
	$admin = new Admin;
	$utilities = new Utilities;
	$version = $utilities->version;	
	
//name of javascript file
	$js_file = "";
	
//get page variable
	$page = $_GET['page'];
	
//define objects
	$admin_content = new Admin_Content;
	
// display header, with name, type, and required javascript file
	if ($_SESSION['culinary'] == "yes") {
		
		//display page based on page variable
		switch($page) {
			
			default:
				$admin_content->html_top("", "main");
				$member_data = $admin->get_culinary_member();			
				main_culinary_html($member_data);				
			break;
			
			case "culinary_job_list":
				$admin_content->html_top("", "culinary_list");
				$job_array = $admin->get_culinary_jobs();
				culinary_job_list_html($job_array);	
			break;	
			
			case "view_culinary_job":
				$admin_content->html_top("", "culinary_job");
				$jobID = $_GET['id'];				
				$job = new Job($jobID);
				$job_data = $job->get_job_data(array('general', 'store', 'employer', 'requirements', 'skills', 'question_list', 'candidate_videos', 'candidate_count', 'negative_count', 'positive_list'));

				//get job view data
				$admin = new Admin;
				$job_views = $admin->get_job_views($jobID, $job_data);
				$employer_name = $admin->get_employer_name($job_data['general']['userID']);
				
				view_culinary_job_html($job_data, $job_views, $employer_name);				
			break;			
				
		}
			
	} else {
		$admin_content->login_warning_html();		
	}
	//display footer
		$admin_content->html_footer();
?>