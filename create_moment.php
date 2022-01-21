<?php


//Required Class files
/*
	require_once('classes/moment.class.php');	
	require_once('classes/member.class.php');	

	require_once('classes/verification.class.php');	
	require_once('classes/message.class.php');	
*/
	require_once('classes/utilities.class.php');
	require_once('classes/moment.class.php');	

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
		
//name of javascript file
	$js_file = "<script type='text/javascript' src='js/moment.js?v=9".$version."'></script>";
	$js_file .= "<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyChqlrKggbgsBdhXpA6GnSorZq7ueMSrHs&v=3.exp&libraries=places'></script>";	
	 $js_file .= "<script>google.maps.event.addDomListener(window, 'load', initialize);</script>";

		//$js_file .= "<script src='https://checkout.stripe.com/checkout.js'></script>";

//define objects
	$general_content = new General_Content;
// display header, with name, type, and required javascript file
	//if user is logged in display, if not, display warning page
	if (isset($_SESSION['userID'])) {
		$type = "client";
		switch($type) {
			case "client":
				$general_content->html_top_new('create_moment', $js_file);

							
				switch($_GET['momentID']) {
					case "new_moment":	
						//display moment form
						$moment = new Moment("new");
						$moment_type_list = $moment->get_moment_type_list();
						//create_moment_html_new_form($moment_type_list);		
						select_moment_type_html($moment_type_list);			
					break;
				
					default:
						$moment = new Moment($momentID);

						//moment exists, edit moment form
						//make sure user owns moment and it isn't expired
						//$verify_moment = $moment->verify_moment();
						
						$verify_moment = true;
						if ($verify_moment == false) {
							//oops page
						} else {
							//$moment_details = $moment->get_moment_details();
							create_moment_html_new_form();
							
						}
						
				}
				
?>
<script>
							$(document).ready(function(){
									var momentID = "<? echo $GET_['momentID'] ?>";									
									
									new_moment(momentID);
									next_buttons();

							});
</script>
<?php
				
			break;
			
			case "provider":
				$general_content->html_top('illegal', $js_file);
				$general_content->illegal_view();								
			break;
		}
		
		$general_content->nav_bar_bottom();		

	} else {
		$general_content->login_warning_page();	
	}	
	
$general_content->html_footer();
?>