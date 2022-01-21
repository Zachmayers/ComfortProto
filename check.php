<?php
//======================
//
//   Check in/Check out
//
//======================

//Required Class files
	require_once('classes/moment.class.php');
	require_once('classes/member.class.php');
	require_once('classes/utilities.class.php');	

//Required HTML files
	require_once('html/check_html.php');
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
	$js_file = "<script type='text/javascript' src='js/check.js?v=".$version."'></script>";
		
	$general_content = new General_Content;
	
// display header, with name, type, and required javascript file
	//if user is logged in display, if not, display warning page
	if (isset($_SESSION['userID'])) {

		switch($_SESSION['type']) {
			case "provider":
			
			
			
				$general_content->html_top('check', $js_file);

				$opportunityID = $_GET['ID'];		
			
				$opportunity = new Opportunity($opportunityID);
				$opportunity_data = $opportunity->get_opportunity_data();
				
				//verify status
				$moment_status = $opportunity->get_status($_SESSION['momentID']);
	
				//statuses
				//invalid
				//time issue
				//not checked in
				//already check in
				//checked out			
			

				if ($moment_status == "false") {
					$page = "false";
				} elseif ($verify_match == "early") {
					$page = "early";		
				} elseif ($job_status == "expired") {
					$page = "expired";					
				} elseif ($job_status == "checked_in") {
					$page = "checked_in";					
				} else {
					$page = "open";						
				}

									
					switch ($page) {
						//case "match":		
						default:				
							//update the job as viewed
							$opportunity->update_opportunity('qualified_view', "");
							
							opportunity_html("provider", $opportunity_data);								
?>
<script>
									var momentID = "<? echo $opportunityID ?>";
									opportunity(momentID);
</script>
<?php	
						
						break;
												
						case "early":
							opportunity_html("provider_expired_responded", $opportunity_data);								
						break;
												
						case "expired":
							opportunity_html_expired();													
						break;
						
						case "checked_in":
							opportunity_html_expired();													
						break;
																								
						case "false":
							$general_content->illegal_view();					
						break;	
					}
				break;
					
				case "client":
					$general_content->html_top('', $js_file);		

					$opportunityID = $_GET['ID'];		
					$opportunity = new Opportunity($opportunityID);
					$opportunity_data = $opportunity->get_opportunity_data();
					
					//determine if this is the owner of the job
					$employerID = $opportunity_data['job_data']['general']['userID'];
					if ($employerID == $_SESSION['userID']) {
						opportunity_html("employer", $opportunity_data, "employer", "NA", "Y", $group_jobs, "N");		
					} else {
						$general_content->illegal_view();											
					}
		
				break;
			}	
		
	} else {
		$general_content->login_warning_page();	
	}	
	//display footer
	
		$general_content->html_footer();
?>