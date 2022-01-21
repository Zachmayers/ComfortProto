<?php
	require_once('classes/utilities.class.php');	
	require_once('mobile_detect.php');	

//Required HTML files
	require_once('html/index_html.php');	
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
			$device = "full";		
		} else {
			$device = "mobile";	
			$_SESSION['phone'] = "other";		
		}
	} else {
		$device = "full";
		//set browser detection, if IE 8 or lower, run warning on the page
		$ie_test = $utilities->ie_detect();
	}
	
		//$device = "mobile";
	//$_SESSION['device'] = "mobile";

//This line is removed after mobile site is updated
	//$device = "mobile";


	if(isset($_GET['ID']) && is_numeric($_GET['ID'])) {
		$jobID = $_GET['ID'];								
	} else {
		$jobID = "NA";				
	}	
	
	//check to see if cookie is set
	if (isset($_COOKIE['hash'])) {
		$email = $utilities->get_email($_COOKIE['hash']);
	} else {
		$email = "";
	}

	switch($device) {
		case "full":	
			if(isset($_GET['page'])) {
				$page = $_GET['page'];								
			} else {
				$page = "home";				
			}
				
?>

<!DOCTYPE html>
<html lang="en">
<head>

<script type="text/javascript">

<?php
	if ($site_type == "live") {
?>
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38015816-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
  
<?php
	}
?>
</script>

<?php
	if ($site_type == "live") {
	
	//FACEBOOK REMARKETING
?>

<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
    var fbds = document.createElement('script');
    fbds.async = true;
    fbds.src = '//connect.facebook.net/en_US/fbds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fbds, s);
    _fbq.loaded = true;
  }
  _fbq.push(['addPixelId', '1436959506576243']);
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', 'PixelInitialized', {}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=1436959506576243&amp;ev=NoScript" /></noscript>
<?
	}
?>

	<title>Serve. Bartend. Cook. - The Finest Hospitality Jobs!</title>
	
	<meta charset="utf-8" />
	<meta name="viewport" content="user-scalable = yes">
	<meta name="viewport" content="width=1050">	
<?php
	if ($site_type == "prototype") {
		echo "<meta name='robots' content='noindex'>";
	}

	if ($site_type == "live") {
?>
<meta property="twitter:account_id" content="1125423043" />

	<meta property="twitter:card" content="summary" />
	<meta property="twitter:site" content="@servebarcook" />
	<meta property="twitter:title" content="The Finest Hospitality Jobs!" />
	<meta property="twitter:description" content="ServeBartendCook matches hospitality industry jobs with excellent workers based on skill and experience." />
	<meta property="twitter:image" content="http://servebartendcook.com/images/SBC-cook-Twitter.png" />
<?php
	}
?>

	<!-- Javascripts -->
<!-- 	<script type="text/javascript" src="javascripts/jquery-1.7.1.min.js"></script> -->
	<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="js/lightbox-2.6.min.js"></script>	
	

	<script type="text/javascript" src="javascripts/html5shiv.js"></script>
	<script type="text/javascript" src="javascripts/jquery.tipsy.js"></script>
<!--
	<script type="text/javascript" src="javascripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<script type="text/javascript" src="javascripts/fancybox/jquery.easing-1.3.pack.js"></script>
-->
<!--
	<script type="text/javascript" src="javascripts/jquery.touchSwipe.js"></script>
	<script type="text/javascript" src="javascripts/jquery.mobilemenu.js"></script>
	<script type="text/javascript" src="javascripts/jquery.infieldlabel.js"></script>
	<script type="text/javascript" src="javascripts/jquery.echoslider.js"></script>
-->

	<script type="text/javascript" src="javascripts/fluidapp.js"></script>
	<script type='text/javascript' src='js/index.js?v=<? echo $version ?>'></script>
<?php
	if ($_SESSION['browser'] == 'low_ie') {
		echo "<script type='text/javascript' src='js/ie_8.js'></script>";	
	}
?>
	
	<!-- Stylesheets -->
	<link rel="stylesheet" type="text/css" href="stylesheets/mainbase.css?v=13d" />	

	<!-- <link rel="stylesheet" type="text/css" href="stylesheets/media.queries.css" /> -->
	<link rel="stylesheet" type="text/css" href="stylesheets/tipsy.css" />
	<link rel="stylesheet" type="text/css" href="javascripts/fancybox/jquery.fancybox-1.3.4.css" />
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Nothing+You+Could+Do|Quicksand:400,700,300">
	<link href="css/lightbox.css" rel="stylesheet" />	
	<!-- Favicons -->
	<link rel="shortcut icon" href="images/favicon.ico" />
	<link rel="shortcut icon" href="images/favicon.png" />
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
	
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<link type="text/css" href="css/custom-theme/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Oswald:300' rel='stylesheet' type='text/css'>
<!-- <script type="text/javascript" src="js/jquery-ui-1.8.23.custom.min.js"></script> -->
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>

</head>
<body>

<?php
		index_html($page, $device, $email);
		if ($page == "home") {
			index_html_footer_layer();			
		}
		index_html_footer();					
		dialogue_index();	
?>
</body>
<script>
$(document).ready(function() {
			var jobID = "<? echo $jobID ?>";
			index_full(jobID);	
})
</script>
</html>
<?php
		break;
		
		case "mobile":
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript">

/*
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38015816-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
*/

</script>
	<title>Serve. Bartend. Cook.</title>
	
	<meta charset="utf-8" />
   <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1; user-scalable=no;">
	<meta name="viewport" content="initial-scale=1">
	
<!-- <meta property="twitter:account_id" content="1125423043" />	 -->
	<link rel="apple-touch-icon" href="images/mobile-logo320.png"/>
	<meta name="apple-mobile-web-app-capable" content="yes" />	
	
	<!-- Stylesheets -->
	<link href="css/style-mobile.css?v=3a" rel="stylesheet" type="textcss" media="screen" charset="utf-8" >
	<link href="css/flat-ui-mobile.css?v=1" rel="stylesheet" />		
<!-- 	<link rel="stylesheet" type="text/css" href="stylesheets/mainbase.css?v=12c" />	 -->
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
	<link type="text/css" href="css/custom-theme/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
	<link href='http://fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Oswald:300' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="js/jquery-ui-1.8.23.custom.min.js"></script>
	<script type='text/javascript' src='js/index.js?v=<? echo $version ?>'></script>


</head>
<body>
	<div id="content" >
<!-- Main content divs  -->

	<div id="holder">

<?php
		$page = $_GET['page'];
		
		switch($page) {
			default:
				echo "<div id='fixed-menu-main' style='text-align:center'>";
					echo "<img src='images/mobile-logo320.png' style='padding-top:15px;'><br />";
					echo "<img src='images/main-server.png' alt='' height='65px;' style='padding-right: 30px;'/> <img src='images/main-bar.png' alt='' height='65px;' style='padding-right: 30px;'/><img src='images/main-cook.png' height='65px;' alt='' />";		
				echo "</div>";			
				index_html_mobile($email);		
			break;
			
			case "employee_info":
				echo "<div id='fixed-menu-small' style='text-align:center'>";
					echo "<img src='images/mobile-logo320.png' style='padding-top:15px;'><br />";
				echo "</div>";						
				index_html_mobile_info("employee");								
			break;
			
			case "employer_info":
				echo "<div id='fixed-menu-small' style='text-align:center'>";
					echo "<img src='images/mobile-logo320.png' style='padding-top:15px;'><br />";
				echo "</div>";						
				index_html_mobile_info("employer");								
			break;			
			
			case "employer_signup":
				echo "<div id='fixed-menu-small' style='text-align:center'>";
					echo "<img src='images/mobile-logo320.png' style='padding-top:15px;'><br />";
				echo "</div>";
				if (isset($_SESSION['userID'])) {
					index_html_mobile_currently_logged_in($jobID, $device);
				} else {				
					index_html_mobile_signup("employer");	
				}				
			break;
			
			case "employee_signup":
				echo "<div id='fixed-menu-small' style='text-align:center'>";
					echo "<img src='images/mobile-logo320.png' style='padding-top:15px;'><br />";
				echo "</div>";
				if (isset($_SESSION['userID'])) {
					index_html_mobile_currently_logged_in($jobID, $device);
				} else {																	
					index_html_mobile_signup("employee");	
				}				
			break;	
			
			case "login":
				echo "<div id='fixed-menu-small' style='text-align:center'>";
					echo "<img src='images/mobile-logo320.png' style='padding-top:15px;'><br />";
				echo "</div>";
				if (isset($_SESSION['userID'])) {
					index_html_mobile_currently_logged_in($jobID, $device);
				} else {																				
					index_html_mobile_login($device, $email);
				}					
			break;
			
			case "help":
				echo "<div id='fixed-menu-small' style='text-align:center'>";
					echo "<img src='images/mobile-logo320.png' style='padding-top:15px;'><br />";
				echo "</div>";												
				index_html_mobile_help();					
			break;
		}
?>
</body>

<script>
	$(document).ready(function() {
		var jobID = "<? echo $jobID ?>"
		index_mobile(jobID);		
	});
</script>
</html>
<?php		
		break;
}
?>