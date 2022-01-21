<?php
	require_once('classes/utilities.class.php');

	
//Required HTML files
	require_once('html/index_html.php');	


	require_once('html/general_content_html.php');

	
//start session

	session_start();
	$utilities = new Utilities;
	$general_content = new General_Content;

	$utilities = new Utilities;
	$version = $utilities->version;	
	$site_type = $utilities->site_type;	
	$states_array = $utilities->states;
	

	//this case someone is coming from a public job post, this will route them to the job after login or signup
	$jobID = "NA";	
	$public_hash = "NA";									

	if(isset($_GET['ID']) && is_numeric($_GET['ID'])) {
		$jobID = $_GET['ID'];	
		$public_hash = $_GET['ref'];													
	} 
	


// /*
// 	//check to see if cookie is set
// 	if (isset($_COOKIE['hash'])) {
// 		$email = $utilities->get_email($_COOKIE['hash']);
// 	} else {
// 		$email = "";
// 	}
// */

	$page = $_GET['page'];
	$meta_data = $utilities->get_meta_data($page);
	$meta_title = $meta_data['title'];
	$meta_description = $meta_data['description'];

	$robot_test = $utilities->robot_test($page);

	switch($device) {
		//case "full":
		default:	
				
?>
<!DOCTYPE html>
<html lang="en">
<head>

<?php
	if ($site_type == "live") {
	//Place various analytic tags	
		//GOOGLE	
/*
		$utilities->google_analytics();
	
		//FB
		$utilities->facebook_RM();
		
		//linkedIN
		$utilities->linkedin_RM();		
*/
		
		if ($_GET['page'] == "complete") {
// 			$utilities->facebook_conversion();		
		}	
	}
?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Comfort Prototype</title>
	
	<meta name="description" content="Testing">
<?php
	if ($site_type == "prototype" || $robot_test == false) {
		echo "<meta name='robots' content='noindex'>";
	}

	if ($site_type == "live") {
		
?>
	<meta property="og:title" content="Comfort" />
	<meta property="og:description" content="Testing" />
<?php

	}
?>

	<!-- Javascripts -->
<!-- 	<script type="text/javascript" src="javascripts/jquery-1.7.1.min.js"></script> -->
	<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="js/lightbox-2.6.min.js"></script>	
	
    <!-- Bootstrap -->
<!--     <link href="css/bootstrap.min.css" rel="stylesheet"> -->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">    
    <link href="custom.css?v=1bc" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Nothing+You+Could+Do' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


	<script type='text/javascript' src='js/index.js?v=5c<? echo $version ?>'></script>
	<script type='text/javascript' src='js/ajax.js'></script>
<!-- 	<script type='text/javascript' src='js/fb_login.js'></script> -->

	<!-- Favicons -->
	<link rel="shortcut icon" href="images/favicon.ico" />
	<link rel="shortcut icon" href="images/favicon.png" />
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
	
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>

</head>

<body>
<?php
		index_main_header_html();				
		$page = $_GET['page'];	
		if (isset($_SESSION['userID']) && isset($_SESSION['type']) && $page != "complete" && $page != "info_graphic" && $page != "cancel_int" && $page != "privacy_policy" && $page != "TOS" ) {
			full_logged_in();
			index_html_footer();							
		} else {	
			switch($page) {	
				default:
					index_html();					
					//index_html_footer_layer();	
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

				case "client_signup":
					index_client_signup_html();					
					index_html_footer();							
				break;

				case "provider_signup":
					index_provider_signup_html();					
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
		}
		
	//Twitter Remarketing
	//$utilities->twitter_RM();		
?>

<!-- </body> -->
<script>
$(document).ready(function() {
			mysql_test();
			index_full();	
			
})
</script>
</html>
<?php
	//	break;
		
}
?>