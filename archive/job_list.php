<?php
//======================
//
//   Job List Page - Displays a list of employer's jobs
//
//======================

//Required Class files
	require_once('classes/job_list.class.php');	
	require_once('classes/utilities.class.php');	

//Required HTML files
	require_once('html/job_list_html.php');	
	require_once('html/general_content_html.php');
	
//start session
session_start();
//Forces page to refresh, this is needed, or else people adding new info to profile and clicking "back" will see old info
header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
header('Pragma: no-cache'); // HTTP 1.0.
header('Expires: 0'); // Proxies. 
error_reporting(0);

	$utilities = new Utilities;
	$version = $utilities->version;
		
//name of javascript file
	$js_file = "<script type='text/javascript' src='js/job_list.js?v=".$version." '></script>";
		
//define objects
	$general_content = new General_Content;
	
// display header, with name, type, and required javascript file
	//if user is logged in display, if not, display warning page
	if (isset($_SESSION['userID'])) {
	// display content, based on user info
		//display jobs page based on member type
		switch($_SESSION['type']) {
			case "employer":

				$general_content->html_top('job_list', $js_file);

				$job_list = new JobList($_SESSION['userID']);
				$job_list_array = $job_list->get_job_list();
				$group_list = $job_list->get_archive_groups();

				job_list_html($job_list_array, $group_list);
				job_list_html_loader();
?>
<script>
				$(document).ready(function(){
					job_list_employer();
				});
</script>
<?php					
			break;
			
			case "employee":
				$general_content->html_top('', $js_file);			
				$general_content->illegal_view();					
			break;
		}	
	} else {
		$general_content->login_warning_page();	
	}
	
$general_content->html_footer();
?>