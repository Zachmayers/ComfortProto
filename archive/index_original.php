<?php
	require_once('classes/utilities.class.php');
	require_once('classes/candidate.class.php');
	require_once('mobile_detect.php');	
	
//Required HTML files
	//require_once('html/index_html_new.php');	

	require_once('html/index_html.php');	
	require_once('html/index_docs_html.php');	

	require_once('html/general_content_html.php');
	require_once('mobile/index_html_mobile.php');	
	
//Required Dialogue files
	require_once('dialogue/index_dialogue.php');
	require_once('dialogue/mobile_dialogue.php');	

	
//start session

	session_start();
	$utilities = new Utilities;
	$general_content = new General_Content;

	$utilities = new Utilities;
	$version = $utilities->version;	
	$site_type = $utilities->site_type;	
	$states_array = $utilities->states;
	
	$info = new uagent_info; 
	$test = $info->DetectTierIphone();
	if ($test == true) {
		$windows_phone = $info->DetectWindowsPhone7();
		if ($windows_phone == true) {
			$_SESSION['phone'] = "windows";
			$_SESSION['device'] = "full";
			$device = "full";		
		} else {
			$device = "mobile";	
			$_SESSION['device'] = "mobile";
			$_SESSION['phone'] = "other";		
		}
	} else {
		if ($_GET['radical'] == "mobile") {
			$device = "mobile";
			$_SESSION['device'] = "mobile";
		} else {
			$device = "full";
			$_SESSION['device'] = "full";
			//set browser detection, if IE 8 or lower, run warning on the page
			$ie_test = $utilities->ie_detect();
		}
	}

	//this case someone is coming from a public job post, this will route them to the job after login or signup
	$jobID = "NA";	
	$public_hash = "NA";									

	if(isset($_GET['ID']) && is_numeric($_GET['ID'])) {
		$jobID = $_GET['ID'];	
		$public_hash = $_GET['ref'];													
	} 
	
	//this case for a person who recommended and arrived from a recommendation link
	if (isset($_GET['recommendID']) && isset($_GET['hash'])) {
		$recommendation = $utilities->check_recommendation_landing_page($_GET['recommendID'], $_GET['hash']);
		$jobID = $_SESSION['recommend']['jobID'];
	} else {
		$recommendation = "NA";
	}	

	$refID = $cmp = $rgn = $ste = $dmg = $ad = $msc_a = $msc_b = "NA";
	
	//loop through reference GET vars and set
	foreach($_GET as $key => $value) {
		switch($key) {
			case "refID":
				$refID = $value;
			break;
			
			case "CMP":
				$cmp = $value;
			break;

			case "RGN":
				$rgn = $value;
			break;
			
			case "STE":
				$ste = $value;
			break;
			
			case "DMG":
				$dmg = $value;
			break;

			case "AD":
				$ad = $value;
			break;

			case "MSCA":
				$msc_a = $value;
			break;

			case "MSCB":
				$msc_b = $value;
			break;			
		}
	}
	
	if (isset($_COOKIE['ID'])) {	
		//do nothing
	} else {	
		if ($refID == "NA" && $cmp == "NA" && $rgn == "NA" && $ste == "NA" && $dmg == "NA" && $ad == "NA" && $msc_a == "NA" && $msc_b == "NA") {
			//do nothing
		} else {
			//set cookie for ad tracking
			$ad_track = 	$refID.",".$cmp.",".$rgn.",".$ste.",".$dmg.",".$ad.",".$msc_a .",".$msc_b;
			setcookie('ID', $ad_track, time() + (86400 * 30), '/');	
		}
	}
	
	//check to see if cookie is set
	if (isset($_COOKIE['hash'])) {
		$email = $utilities->get_email($_COOKIE['hash']);
	} else {
		$email = "";
	}

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
		$utilities->google_analytics();
	
		//FB
		$utilities->facebook_RM();

		//linkedIN
		$utilities->linkedIN_RM();
		
		if ($_GET['page'] == "complete") {
			$utilities->facebook_conversion();		
		}	
	}
?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title><? echo $meta_title ?></title>
	
	<meta name="description" content="<? echo $meta_description ?>">
<?php
	if ($site_type == "prototype" || $robot_test == false) {
		echo "<meta name='robots' content='noindex'>";
	}

	if ($site_type == "live") {
		
?>
	<meta property="og:url" content="https://servebartendcook.com" />
	<meta property="og:title" content="<? echo $meta_title ?>" />
	<meta property="og:description" content="<? echo $meta_description ?>" />
	<meta property="og:image" content="https://servebartendcook.com/new_square_logo.png" />


	<meta property="twitter:account_id" content="1125423043" />
	<meta property="twitter:card" content="summary" />
	<meta property="twitter:site" content="@servebarcook" />
	<meta property="twitter:title" content="The Finest Hospitality Jobs!" />
	<meta property="twitter:description" content="ServeBartendCook matches hospitality industry jobs with excellent workers based on skill and experience." />
	<meta property="twitter:image" content="http://servebartendcook.com/images/SBC-cook-Twitter.png" />

<?php
		if (isset($_GET['page'])) {
?>
			<link href="https://servebartendcook.com/index.php?page=<? echo $_GET['page'] ?>" rel="canonical" />
<?php			
		} else {
?>
			<link href="https://servebartendcook.com" rel="canonical" />
			
<script type="application/ld+json">
  [
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "url": "https://servebartendcook.com/",
      "name": "Serve Bartend Cook",
      "alternateName": "ServeBartendCook"
    },
    {
      "@context": "http://schema.org",
      "@type": "Organization",
      "name": "ServeBartendCook",
      "url": "https://servebartendcook.com/",
      "logo": "https://servebartendcook.com/new_square_logo.png",
      "sameAs": [
        "https://www.facebook.com/servebartendcook",
        "https://www.instagram.com/servebartendcook/",
        "https://twitter.com/servebarcook"
      ]
    }
  ]
</script>			
<?php			
		}
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
    <link href="custom.css?v=1bg" rel="stylesheet">

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


	<script type='text/javascript' src='js/index.js?v=<? echo $version ?>'></script>
	<script type='text/javascript' src='js/ajax.js'></script>
	<script type='text/javascript' src='js/fb_login.js'></script>

<?php
	if ($_SESSION['browser'] == 'low_ie') {
		echo "<script type='text/javascript' src='js/ie_8.js'></script>";	
	}
?>
	
	<!-- Stylesheets -->
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
	//echo var_dump($recommendation);
		$page = $_GET['page'];	
		if (isset($_SESSION['userID']) && isset($_SESSION['type']) && $page != "complete" && $page != "info_graphic" && $page != "cancel_int" && $page != "privacy_policy" && $page != "TOS" ) {
			full_logged_in();
			index_html_footer();							
		} elseif (is_array($recommendation)) {
			//user has arrived from a recommendation link, show recommendation page
			index_recommendation_html($recommendation);				
			//index_html_footer_full();							
				
		} else {	
			switch($page) {	
				default:
					index_html($page, $device, $email, $refID, $cmp, $rgn, $ste, $dmg, $ad, $msc_a, $msc_b);					
					//index_html_footer_layer();	
					index_html_footer_full();														
				break;
				
				case "login":
					index_login_html($email);		
					index_html_footer_full();																									
				break;	
				
				case "post_job":
					index_post_job_html($page, $device, $email, $refID);			
					//index_html_footer_layer();	
					index_html_footer_full();														
				break;				
				
				case "job_seeker_faq":
					job_seeker_faq();					
					index_html_footer_full();																									
				break;											

				case "employer_faq":
					employer_faq();					
					index_html_footer_full();																									
				break;											
				
				case "forgot_pass":
					index_html_forgot_pass();				
					index_html_footer_full();																									
				break;
				
/*
				case "verification_email":
					index_verification_email_html();					
					index_html_footer_full();																									
				break;
*/

				case "employee_signup":
					//check to see if this person came from a job page
					$jobID = $_GET['ID'];
					$job_data = "NA";
					if ($jobID > 0 & $jobID != "") {
						$job_data =  $utilities->get_job_title($jobID);
					} else { 
						$jobID = "NA";
					}
					index_employee_signup_html($jobID, $job_data);					
					index_html_footer_full();																									
				break;

				case "employer_signup":
					index_employer_signup_html();					
					index_html_footer_full();																									
				break;
				
				case "fb_signup":
					//this page is only reached after FB login button has been used
					//make sure the session is set so that no one can hard type this page
				
					if (isset($_SESSION['fb_ID']) && $_SESSION['fb_ID'] != "") {
						index_fb_signup_html($page, $device, $email, $refID, $cmp, $rgn, $ste, $dmg, $ad, $msc_a, $msc_b);					
					} else {
						index_html($page, $device, $email, $refID, $cmp, $rgn, $ste, $dmg, $ad, $msc_a, $msc_b);											
					}
					index_html_footer_full();																									
				break;		
				
				case "fb_connect":
					//this page is only reached after FB login button has been used
					//make sure the session is set so that no one can hard type this page

					if (isset($_SESSION['fb_ID']) && $_SESSION['fb_ID'] != "") {
						index_fb_connect_html();					
					} else {
						index_html($page, $device, $email, $refID, $cmp, $rgn, $ste, $dmg, $ad, $msc_a, $msc_b);											
					}
					index_html_footer_full();																									
				break;	
				
/*
				case "help":
					index_help_html();					
					index_html_footer();							
				break;													
*/

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
					index_html_footer_full();																									
				break;		
				
			}
		}
?>

<!-- </body> -->
<script>
$(document).ready(function() {
			mysql_test();
			var jobID = "<? echo $jobID ?>";
			var refID = "<? echo $refID ?>";		
			var CMP = "<? echo $cmp ?>";		
			var RGN = "<? echo $rgn ?>";		
			var STE = "<? echo $ste ?>";		
			var DMG = "<? echo $dmg ?>";		
			var AD = "<? echo $ad ?>";		
			var MSCA = "<? echo $msc_a ?>";		
			var MSCB = "<? echo $msc_b ?>";
			var type = "<? echo $device ?>";		
			var public_hash = "<? echo $public_hash ?>";		
			index_full(jobID, refID, CMP, RGN, STE, DMG, AD, MSCA, MSCB);	
			facebook_login(type, jobID, refID, CMP, RGN, STE, DMG, AD, MSCA, MSCB, public_hash);	
})
</script>
</html>
<?php
		break;
		
}
?>