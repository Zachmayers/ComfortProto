<?php
//======================
//
//   Employer Page - An employee viewinga job
//
//======================

//Required Class files
	require_once('classes/moment.class.php');
	require_once('classes/member.class.php');
	require_once('classes/utilities.class.php');	

//Required HTML files
	require_once('html/opportunity_html.php');
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
	$js_file = "<script type='text/javascript' src='js/opportunity.js?v=".$version."'></script>";
		
	$general_content = new General_Content;
	
// display header, with name, type, and required javascript file
	//if user is logged in display, if not, display warning page
	if (isset($_SESSION['userID'])) {

		switch($_SESSION['type']) {
			case "provider":
				$general_content->html_top('opportunity', $js_file);

				$opportunityID = $_GET['ID'];		
			
				$opportunity = new Opportunity($opportunityID);
				$opportunity_data = $opportunity->get_opportunity_data();
				
				//verify opportunity matches user
				$verify_match = $opportunity->verify_match($_SESSION['userID']);
				
				//options
				//expired
				//non-existant
				//non-match
				//already matched other
				//already matched you

				if ($verify_match == "false") {
					$page = "false";
				} elseif ($verify_match == "expired_responded") {
					$page = "expired_responded";		
				} elseif ($job_status == "filled") {
					$page = "filled";					
				} elseif ($job_status == "expired") {
					$page = "expired";					
				} else {
					$page = "match";						
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
												
						case "expired_responded":
							opportunity_html("provider_expired_responded", $opportunity_data);								
						break;
												
						case "expired":
							opportunity_html_expired();													
						break;
						
						case "filled":
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