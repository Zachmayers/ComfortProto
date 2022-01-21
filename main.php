<?php
//======================
//
//   Main Page - Displays main page after login
//
//======================

//Required Class files
	require_once('classes/moment_list.class.php');	
	require_once('classes/moment.class.php');
	require_once('classes/member.class.php');		
	require_once('classes/utilities.class.php');	

//Required HTML files
	require_once('html/main_html.php');	
	require_once('html/general_content_html.php');
	
//start session
	session_start();
//Forces page to refresh, this is needed, or else people adding new info to profile and clicking "back" will see old info
header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
header('Pragma: no-cache'); // HTTP 1.0.
header('Expires: 0'); // Proxies. 

	$utilities = new Utilities;
	$general_content = new General_Content;

	$version = $utilities->version;	
	
//name of javascript file
	$js_file = "<script type='text/javascript' src='js/main.js?v=".$version."'></script>";
	$js_file = "<script type='text/javascript' src='js/alert.js?v=1d".$version."'></script>";

//SET COOKIE FOR LOGINS
	$member = new Member($_SESSION['userID']);
	$member_data = $member->get_member_data();
	setcookie('hash', $member_data['valid_hash'], time() + (86400 * 90));
	
	if (isset($_SESSION['userID'])) {
		//Determine whether email address has been verified
		$general_content->html_top_new('main', $js_file);
		
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
		} else {
			if ($member_data['provider'] == "Y") {
				$page = "provider";
			} else {
				$page = "client";
			}
		}	
		
		$moment = new Moment("new");
		
												
			switch($page) {
				case "provider":
					//determine if provider has been verified
					
					
					$moment_list = new MomentList($_SESSION['userID']);
					$upcoming_moments = $moment_list->get_moment_list("today_provider", "1");
					//$pending_moments = $moment_list->get_moment_list("provider_pending", "1");
					//check for new messages
					$messages = $moment_list->check_new_messages();
					
					main_html_provider($upcoming_moments, $messages);		
?>
<script>
						$(document).ready(function() {
							check_for_message_alert();
						})
</script>
<?php	
//					}
				break;
					
				case "client":
					$moment_list = new MomentList($_SESSION['userID']);
						$moment = new Moment("new");
						$moment_type_list = $moment->get_moment_type_list();
					
					//fix these calls
					$upcoming_moments = $moment_list->get_moment_list("today_client", "1");
					//$pending_moments = $moment_list->get_moment_list("client_pending", "1");
					//$available_moments = $moment_list->available_moments();
					//$unrated_moments = $moment_list->unrated_moments();
					$messages = $moment_list->check_new_messages();

					main_html_client($upcoming_moments, $messages, $moment_type_list);		
?>
<script>
						$(document).ready(function() {
							check_for_message_alert();
						})
</script>
<?php
				break;
															
				case "general_faq":
					if ($_SESSION['type'] == "employee") {
						employee_faq_general();
					} elseif ($_SESSION['type'] == "employer") {
						employer_faq_general();	
					}
				break;
				
				case "contact":
					contact_html();
				break;
										
				case "verify_email":
					email_verification_html($email_verification, $member_data['email'], $member_data['creation_date']); 
?>
<script>
						$(document).ready(function() {
							main_functions();
						})
</script>
<?php																																									
				break;														
			}	
			$general_content->nav_bar_bottom();		
		
	} else {
		$general_content->login_warning_page();		
	}
		
$general_content->html_footer();
?>