<?php

//Required Class files
	require_once('classes/job_list.class.php');	
	require_once('classes/job.class.php');	
	require_once('classes/employer.class.php');	
	require_once('classes/utilities.class.php');	

//Required HTML files
	require_once('html/interview_html.php');	
	require_once('html/general_content_html.php');
	require_once('mobile/interview_html_mobile.php');	
	
//Required Dialogue files
	require_once('dialogue/job_list_dialogue.php');
	require_once('dialogue/mobile_dialogue.php');	
	
//start session
session_start();
//Forces page to refresh, this is needed, or else people adding new info to profile and clicking "back" will see old info
header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
header('Pragma: no-cache'); // HTTP 1.0.
header('Expires: 0'); // Proxies. 

	$utilities = new Utilities;
	$version = $utilities->version;
		
//name of javascript file
	$js_file = "<script type='text/javascript' src='js/interview.js?v=".$version." '></script>";
		
//define objects
	$general_content = new General_Content;
	
// display header, with name, type, and required javascript file
	//if user is logged in display, if not, display warning page
	if (isset($_SESSION['userID'])) {
			
	// display content, based on user info
		//display jobs page based on member type
		switch($_SESSION['type']) {
			case "employer":
				$general_content->html_top('interview', $js_file);

				$page = $_GET['page'];
				
				switch($page) {
					default:
					
						date_default_timezone_set('America/Los_Angeles');		
						$current_date =  date('Y-m-d');
					
						$job_list = new JobList($_SESSION['userID']);
						$job_list_array = $job_list->get_job_list();
						
						$employer = new Employer($_SESSION['userID']);
						$count = array();
						$job_list_array = $job_list_array['current'] + $job_list_array['float'];
						if (count($job_list_array) >0) {		
							foreach($job_list_array as $key=>$job) {

								$interview_list = $employer->get_interview_list("job", $job['jobID']);
								
								$count[$key]['cancel'] = $count[$key]['complete'] = $count[$key]['upcoming'] = 0;

								foreach($interview_list as $row) {
									if ($row['status'] == "employer_cancel" || $row['status'] == "employee_cancel" || $row['status'] == "view_employer_cancel" || $row['status'] == "view_employee_cancel") {
										$count[$key]['cancel']++;
									} elseif ($current_date > $row['interview_date']) {
										$count[$key]['complete']++;
									} else {
										$count[$key]['upcoming']++;
									}
								}
							}
						}

						if ($_SESSION['device'] == "full") {						
							interview_menu_html($job_list_array, $job_list_array['archive'], $count);
							loader_box();	
						} else {
							interview_menu_html_mobile($job_list_array, $job_list_array['archive'], $count);							
						}				
?>
<script>
						$(document).ready(function(){
							interview_menu();
						});
</script>
<?php					
					
					break;
										
					case "all":
						$employer = new Employer($_SESSION['userID']);

						$interview_list_current = $employer->get_interview_list("current", "");
						$interview_list_float = $employer->get_interview_list("float", "");
						
						$interview_list = $interview_list_current + $interview_list_float;

						if ($_SESSION['device'] == "full") {						
							interview_list_all_html("current", $interview_list);												
							loader_box();							
						} else {
							interview_list_all_html_mobile("current", $interview_list);												
						}
					break;

					case "past":
						$employer = new Employer($_SESSION['userID']);

						$interview_list = $employer->get_interview_list("past", "");

						if ($_SESSION['device'] == "full") {						
							interview_list_all_html("past", $interview_list);
							loader_box();							
						} else {
							interview_list_all_html_mobile("past", $interview_list);							
						}												
					break;
					
					case "job":
						if (isset($_GET['ID'])) {
							//test to make sure the job is owned by the user
							$job = new Job($_GET['ID']);
							$job_data = $job->get_job_data(array('general'));
							$post_type = $job_data['general']['post_type'];
							
							//check expiration, and the time from expiration
							//Window of time at Y means user can still view candidates, but not anything else
							$view_expired = "N";	
	
							if ($job->job_expiration_check() == "expired" && !(is_numeric($job_status))) {
								
									//check to see if date is still valid to view candidates
									//Free Jobs = 7 days after expiration
									//Pay Jobs = 14 days after expiration
									$expiration_date = strtotime($job_data['general']['expiration_date']);
									date_default_timezone_set('America/Los_Angeles');	
									$today = date('Y-m-d');
	
									if ($job_data['general']['post_type'] == "bounty") {
										$window_date = date('Y-m-d', strtotime("+14 days", $expiration_date));	
										if ($today > $window_date) {
											$view_expired = "Y";
										}
									} else {
										$window_date = date('Y-m-d', strtotime("+7 days", $expiration_date));	
										if ($today > $window_date) {
											$view_expired = "Y";
										}								
									}
							}
							
							
							if ($job_data['general']['userID'] != $_SESSION['userID']) {
								$general_content->illegal_view();					
							} else {
								//get interview list
								$employer = new Employer($_SESSION['userID']);
								$interview_list = $employer->get_interview_list("job", $_GET['ID']);

								date_default_timezone_set('America/Los_Angeles');		
								$current_date =  date('Y-m-d');
					
								if ($_SESSION['device'] == "full") {						
									interview_list_job_html($post_type, $job_data['general']['title'], $interview_list, $count, $view_expired);	
									loader_box();							
								} else {
									interview_list_job_html_mobile($post_type, $job_data['general']['title'], $interview_list, $count, $view_expired);										
								}							
							}																			
						}
					break;
					
					case "candidate":
						//MAY NOT NEED THIS
						if (isset($_GET['matchID']) && isset($_GET['ID'])) {
							//test to make sure the job is owned by the user
							$candidate = new Candidate($_GET['matchID']);
							$test = legal_view_test($_GET['ID']);
							
							if ($test == "invalid") {
								$general_content->illegal_view();					
							} elseif ($test == "valid") {
								//get interview list
								//get potential candidates
							} else {
								$general_content->illegal_view();													
							}												
							
						}
						
						case "notes_list":
							if (isset($_GET['ID'])) {
								//test to make sure the job is owned by the user
								$job = new Job($_GET['ID']);
								$job_data = $job->get_job_data(array('general'));
								$post_type = $job_data['general']['post_type'];
	
								if ($job_data['general']['userID'] != $_SESSION['userID']) {
									$general_content->illegal_view();					
								} else {
									//get interview list
								//	$employer = new Employer($_SESSION['userID']);
									$notes_list = $job->get_notes_list();
									$notes_array[0] = array();
									$notes_array[1] = array();
									$notes_array[2] = array();
									$notes_array[3] = array();
									$notes_array[4] = array();
									
									if (isset($_GET['sort'])) {
										
										$sort = $_GET['sort'];
										foreach($notes_list as $row) {
											if ($row[$sort] == "Great") {
												$notes_array[0][] = $row;
											} elseif ($row[$sort] == "Good") {
												$notes_array[1][] = $row;											
											} elseif ($row[$sort] == "Neutral") {
												$notes_array[2][] = $row;																						
											} elseif ($row[$sort] == "Poor") {
												$notes_array[3][] = $row;																						
											} elseif ($row[$sort] == "NA") {
												$notes_array[4][] = $row;																						
											}
										}
										
									} else {
										foreach($notes_list as $row) {
											$notes_array[0][] = $row;
										}
									}
									
									if ($_SESSION['device'] == "full") {						
										notes_list_job_html($post_type, $job_data['general']['title'], $notes_array);	
										loader_box();							
									} else {
										notes_list_job_html_mobile($post_type, $job_data['general']['title'], $notes_array);											
									}							
								}																			
							}
						break;
						
					break;
					
				}
			break;
			
			case "employee":
				$general_content->html_top('illegal', $js_file);			
				$general_content->illegal_view();					
			break;
		}	
	} else {
		$general_content->login_warning_page();	
	}
	
$general_content->html_footer();
?>