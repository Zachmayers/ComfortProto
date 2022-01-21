<?php



//Required Class files
	require_once('classes/moment_list.class.php');	
	require_once('classes/moment.class.php');
	require_once('classes/member.class.php');		
	require_once('classes/utilities.class.php');	

//Required HTML files
	require_once('html/moment_list_html.php');	
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
		
		if (isset($_GET['type'])) {
			$page = $_GET['type'];
		} else {
			$page = "past";
		}	
		
		
		
												
			switch($page) {
				case "upcoming":					
					
					$moment_list = new MomentList($_SESSION['userID']);
					
					if ($_SESSION['type'] == "provider") {
						$upcoming_moments = $moment_list->get_moment_list("upcoming_provider", "1");
					} else {
						$upcoming_moments = $moment_list->get_moment_list("upcoming_client", "1");						
					}

						upcoming_moments_html($upcoming_moments);	
				break;
					
				case "past":
					$moment_list = new MomentList($_SESSION['userID']);
					
					if ($_SESSION['type'] == "provider") {
						$past_moments = $moment_list->get_moment_list("past_provider", "1");
					} else {
						$past_moments = $moment_list->get_moment_list("past_client", "1");						
					}
					
					past_moments_html($past_moments);	

				break;
															
				case "available":
					if ($_SESSION['type'] == "provider") {
						
						$moment_list = new MomentList($_SESSION['userID']);

						$available_moments = $moment_list->get_moment_list("available", "1");
						available_moments_html($available_moments);
					}
				break;
				
			}			
			$general_content->nav_bar_bottom();		
		
	} else {
		$general_content->login_warning_page();		
	}
		
$general_content->html_footer();
?>