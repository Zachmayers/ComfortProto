<?php
//======================
//
//   Job List Page - Displays a list of employer's jobs
//
//======================

//Required Class files
	require_once('classes/opportunity_list.class.php');	
	require_once('classes/utilities.class.php');	

//Required HTML files
	require_once('html/opportunity_list_html.php');	
	require_once('html/general_content_html.php');
		
//start session
session_start();
//Forces page to refresh, this is needed, or else people adding new info to profile and clicking "back" will see old info
header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
header('Pragma: no-cache'); // HTTP 1.0.
header('Expires: 0'); // Proxies. 

	$utilities = new Utilities;
	$version = $utilities->version;
		
//name of javascript file
	$js_file = "<script type='text/javascript' src='js/opportunity_list.js?v=".$version." '></script>";
		
//define objects
	$general_content = new General_Content;
	$opportunity_list = new OpportunityList($_SESSION['userID']);
	
// display header, with name, type, and required javascript file
	//if user is logged in display, if not, display warning page
	if (isset($_SESSION['userID'])) {
		//Determine whether email address has been verified
		$email_verification = $utilities->check_email_verification();
			
		// display content, based on user info
		//display jobs page based on member type
		switch($_SESSION['type']) {			
			case "employee":
				$page = $_GET['page'];
			
				$general_content->html_top('opportunity_list', $js_file);	
				
				//get profile status, if incomplete, show warning
				$employee = new Employee($_SESSION['userID']);
				$employee_data = $employee->get_employee_data();
				$firstname = $employee_data['general']['firstname'];
				$zip = $employee_data['general']['zip'];
				$city_state = $utilities->get_city_state($zip);
				
				$profile_status = $employee_data['general']['profile_status'];
				
				//changed during update to allow unfinished profiles to view job posts
/*
				if ($profile_status != "complete") {
					$page = "incomplete";
				}
*/
										
				switch($_GET['page']) {
					default:
						//if profile is incomplete, just show a notice, since there will be no actual job matches
						if ($profile_status != "complete") {
							$incomplete_note = "INCOMPLETE NOTE HOLDER";	
						} else {
							$incomplete_note = "";
						}
						
						
						$type = $_GET['type'];
		
/*
						$job_types = $opportunity_list->get_opportunity_job_types();
						$store_types = $opportunity_list->get_opportunity_store_types();
						$schedule_types = $opportunity_list->get_opportunity_schedule_types();
						$comp_types = $opportunity_list->get_opportunity_compensation_types();
*/
						$job_types = $utilities->main_skills;
						$schedule_types = array('Full Time', 'Part Time', 'Temporary');
						$comp_types = array('Hourly', 'Salary', 'Min Wage', 'Min Wage Plus Tips', 'Negotiable');
												
/*
						if(in_array('Hourly', $comp_types)) {
							$hourly_range= $opportunity_list->get_opportunity_hourly_range();
						} else {
							$hourly_range = 0;
						}
						
						if(in_array('Salary', $comp_types)) {
							$salary_range = $opportunity_list->get_opportunity_salary_range();
						} else {
							$salary_range = 0;
						}				
*/
										
							qualified_job_list_holder($job_types, $schedule_types, $comp_types, $email_verification, $firstname, $zip, $city_state, $profile_status, $incomplete_note);												

/*
							if ($type == "other") {
								unqualified_job_list_holder();						
							} else {
								qualified_job_list_holder($job_types, $store_types, $schedule_types, $comp_types, $hourly_range, $salary_range, $email_verification);												
							}
*/
		
/*
							dialogue_job_response();
							loader_box();						
*/
?>
<script>
							$(document).ready(function(){
								//opportunity_list_viewed();
								var profile_status = "<? echo $profile_status ?>";
								qualified_job_list(profile_status);																										
													
/*
								var type = "<? echo $type ?>";
								if (type == "other") {	
									unqualified_job_list('full');																										
								} else {
									qualified_job_list('full');																										
								}			
*/
								opportunity_list();
								filter_opportunties('full', profile_status);
							});
</script>
<?php					
						break;	
						
						case "responses":
							$current_responses = $opportunity_list->get_responded_opportunities("recent");						

							if ($_GET['search'] == "archive") {
								$archive_responses = $opportunity_list->get_responded_opportunities("archive");
								opportunity_list_responses($archive_responses);																					
							} else {
								opportunity_list_responses($current_responses);																					
							}

?>
<script>
							$(document).ready(function(){
								opportunity_response_list();
							});
</script>
<?php								
						break;	
						
					}	
			break;
			
			case "employer":
				$general_content->html_top('', $js_file);
				$general_content->illegal_view();					
			break;

		}	
	} else {
		$general_content->login_warning_page();	
	}
	
$general_content->html_footer();
?>