<?php
	require_once('classes/utilities.class.php');
	
//Required HTML files
	require_once('html/index_html.php');	

// 	require_once('html/general_content_html.php');

	
//start session

	session_start();
	$utilities = new Utilities;
//	$general_content = new General_Content;

	$utilities = new Utilities;
	$version = $utilities->version;	
	

	$page = $_GET['page'];
	$meta_data = $utilities->get_meta_data($page);
	$meta_title = $meta_data['title'];
	$meta_description = $meta_data['description'];

	$robot_test = $utilities->robot_test($page);
				
?>
<!DOCTYPE html>
<html lang="en" class="homehead">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Wine Ranker - BETA</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Comfortaa:300,400,700" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/theme.css?v=6" rel="stylesheet">
	<script type="text/javascript" src="js/ajax.js?v=5"></script>	
	<script type="text/javascript" src="js/index.js?v=5"></script>	

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

<!--  <body class="page-index has-hero"> -->
<body>
<?php
		index_main_header_html();				
	//echo var_dump($recommendation);
		$page = $_GET['page'];	
/*
		if (isset($_SESSION['userID']) && isset($_SESSION['type']) && $page != "complete" && $page != "info_graphic" && $page != "cancel_int" && $page != "privacy_policy" && $page != "TOS" ) {
		//	full_logged_in();
			index_login_html($email);		

			index_html_footer();											
		} else {	
*/
			switch($page) {	
				default:
					index_html($page, $device, $email);					
					index_html_footer_full();														
				break;
				
				case "login":
					index_login_html($email);		
					index_html_footer();							
				break;	
				
				case "forgot_pass":
					index_html_forgot_pass();				
					index_html_footer();							
				break;
				
				case "verification_email":
					index_verification_email_html();					
					index_html_footer();							
				break;

				case "create_account":
					index_create_account_html();					
					index_html_footer_full();														
				break;
				
/*
				case "fb_signup":
				
					if (isset($_SESSION['fb_ID']) && $_SESSION['fb_ID'] != "") {
						index_fb_signup_html($page, $device, $email, $refID, $cmp, $rgn, $ste, $dmg, $ad, $msc_a, $msc_b);					
					} else {
						index_html($page, $device, $email, $refID, $cmp, $rgn, $ste, $dmg, $ad, $msc_a, $msc_b);											
					}
					index_html_footer();							
				break;		
*/
				
/*
				case "fb_connect":
					//this page is only reached after FB login button has been used
					//make sure the session is set so that no one can hard type this page

					if (isset($_SESSION['fb_ID']) && $_SESSION['fb_ID'] != "") {
						index_fb_connect_html();					
					} else {
						index_html($page, $device, $email, $refID, $cmp, $rgn, $ste, $dmg, $ad, $msc_a, $msc_b);											
					}
					index_html_footer();							
				break;	
				
				case "help":
					index_help_html();					
					index_html_footer();							
				break;													

				case "privacy_policy":
					index_privacy_html();					
					index_html_footer();							
				break;	
				
				case "TOS":
					index_tos_html();					
					index_html_footer();							
				break;
*/

				case "complete":
					//test to see if user is logged in
					if (isset($_SESSION['userID'])) {
						$member = new Member($_SESSION['userID']);
						$userID = $_SESSION['userID'];
						
						$member_array = $member->get_member_data($userID);
						$email = $member_array['email'];	
					} else {
						$email = "NA";
						$userID = "NA";
					}				
					
					index_complete_html($userID, $email);					
					index_html_footer();							
				break;		
				
			}
//		}
		
?>

<!-- </body> -->
<script>
$(document).ready(function() {
	index_full();	
// 			facebook_login(type, jobID, refID, CMP, RGN, STE, DMG, AD, MSCA, MSCB, public_hash);	
})
</script>
</html>
