<?php


//Required Class files
	require_once('classes/moment.class.php');
	require_once('classes/member.class.php');
	require_once('classes/utilities.class.php');	

//Required HTML files
	require_once('html/chat_html.php');
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
	
	if (isset($_SESSION['userID'])) {


					$general_content->html_top_new('', $js_file);		

					$momentID = $_GET['momentID'];		
					$moment = new Moment($momentID);
					$chat = $moment->get_chat($momentID);

					//test to see if user is valid for chat
					//test if moment is still valid
					$valid = $moment->valid_chat_test($momentID);
					
					if ($valid == true) {
						//mark chat as seen
						$moment->update_view_chat($momentID);
						chat_html($chat);
						
					} else {
						//error page
					}
?>
<script>
						$(document).ready(function() {
							var momentID = <?php echo $momentID ?>;
							send_message(momentID);
							//get_chat($momentID);
							//update_chat_box(momentID);
						})
</script>
<?php					
			$general_content->nav_bar_bottom();		
	} else {
		$general_content->login_warning_page();	
	}	
	//display footer
	
		$general_content->html_footer();
?>