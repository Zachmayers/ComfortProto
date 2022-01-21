<?php



//Required Class files
	require_once('classes/moment_list.class.php');	
	require_once('classes/moment.class.php');
	require_once('classes/member.class.php');		
	require_once('classes/utilities.class.php');	

//Required HTML files
	require_once('html/message_list_html.php');	
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

//SET COOKIE FOR LOGINS
	$member = new Member($_SESSION['userID']);
	$member_data = $member->get_member_data();
	setcookie('hash', $member_data['valid_hash'], time() + (86400 * 90));
	
	if (isset($_SESSION['userID'])) {
		//Determine whether email address has been verified
		$general_content->html_top_new('main', $js_file);
		
		$message_list = new MomentList($_SESSION['userID']);
		
		//first get the newest unchecked messages
		$unchecked_messages = $message_list->unchecked_messages();
		//separate by moment
		$moment_unchecked_array = array();
		if (count($unchecked_messages) > 0) {
			foreach($unchecked_messages as $row) {
				$moment_unchecked_array[] = $row['momentID'];
			}
			$moment_unchecked_array = array_unique($moment_unchecked_array);
		}
		
		//then get the last msg from any open moments
		$current_messages = $message_list->check_open_messages();

		$moment_current_array = array();
		if (count($current_messages) > 0) {
			foreach($unchecked_messages as $row) {
				$moment_current_array[] = $row['momentID'];
			}
			$moment_current_array = array_unique($moment_current_array);
		}
		
		latest_messages_html($current_messages, $moment_current_array, $unchecked_messages, $moment_unchecked_array);	
				
		$general_content->nav_bar_bottom();		
	
	} else {
		$general_content->login_warning_page();		
	}
		
$general_content->html_footer();
?>