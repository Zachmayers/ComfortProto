<?php


//Required Class files
	require_once('classes/moment.class.php');
	require_once('classes/member.class.php');
	require_once('classes/utilities.class.php');	

//Required HTML files
	require_once('html/moment_html.php');
	require_once('html/general_content_html.php');
	
//start session
session_start();
//Forces page to refresh, this is needed, or else people adding new info to profile and clicking "back" will see old info
header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
header('Pragma: no-cache'); // HTTP 1.0.
header('Expires: 0'); // Proxies. 

	$utilities = new Utilities;
	$version = $utilities->version;	
	$member = new Member($_SESSION['userID']);
	$member_data = $member->get_member_data();

			if ($member_data['provider'] == "Y") {
				$user_type = "provider";
			} else {
				$user_type = "client";
			}		
//name of javascript file
	$js_file = "<script type='text/javascript' src='js/moment.js?v=7a".$version."'></script>";
		
	$general_content = new General_Content;
	
// display header, with name, type, and required javascript file
	//if user is logged in display, if not, display warning page
	if (isset($_SESSION['userID'])) {

		switch($user_type) {
			case "provider":
					$general_content->html_top_new('', $js_file);		

					$momentID = $_GET['momentID'];		
					$moment = new Moment($momentID);
					$moment_details = $moment->get_moment_data($momentID);
					$check_status = $moment->get_checkin($momentID);
					$chat = $moment->get_chat($momentID);
					$standard_details = $moment->get_standard_detail($moment_details['moment_type']);
					
					//has a provider been selected
					if (is_null($moment_details['providerID'])) {
						$provider_status = "none";
					} else {
						$provider_status = "accepted";
					}
										
					if (!is_null($check_status['provider_checkout'])) {
						view_rating_provider($moment_details, $check_status, $standard_details);
					} else {
						view_moment_provider($moment_details, $provider_status, $check_status, $pass_code, $chat, $standard_details);		
					}
?>
<script>
						$(document).ready(function() {
							var momentID = <?php echo $momentID ?>;
							checkin("provider", momentID);
							checkout("provider", momentID);
							rate(momentID, "provider");
							accept_moment(momentID);
							send_message(momentID);
							//get_chat($momentID);
							update_chat_box(momentID);
						})
</script>
<?php					
				break;
					
				case "client":
					$general_content->html_top_new('', $js_file);		

					$momentID = $_GET['momentID'];		
					$moment = new Moment($momentID);
					$moment_details = $moment->get_moment_data($momentID);
					$check_status = $moment->get_checkin($momentID);
					$chat = $moment->get_chat($momentID);
					$standard_details = $moment->get_standard_detail($moment_details['moment_type']);
					
					//has a provider been selected
					if (is_null($moment_details['providerID'])) {
						$provider_status = "none";
					} else {
						$provider_status = "accepted";
					}
					
					if (!is_null($check_status['client_checkout'])) {
						view_rating_client($moment_details, $check_status, $standard_details);
					} else {
						view_moment_client($moment_details, $provider_status, $check_status, $pass_code, $chat, $standard_details);		
					}
											
?>
<script>
						$(document).ready(function() {
							var momentID = <?php echo $momentID ?>;
							checkin("client", momentID);
							checkout("client", momentID);
							rate(momentID, "client");
							send_message(momentID);
							//get_chat($momentID);
							update_chat_box(momentID);
						})
</script>
<?php					
				break;
			}	
			$general_content->nav_bar_bottom();		
		
	} else {
		$general_content->login_warning_page();	
	}	
	//display footer
	
		$general_content->html_footer();
?>