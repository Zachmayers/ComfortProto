<?php
	require_once('classes/utilities.class.php');
	require_once('classes/opportunity.class.php');

	require_once('mobile_detect.php');	
	$utilities = new Utilities;
	
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

	$utilities = new Utilities;
	$opportunity = new Opportunity($_GET['ID']);
	$version = $utilities->version;	
	$site_type = $utilities->site_type;

	$public_hash = $_GET['ref'];	
	
	//Test to see if public hash and jobID match, then check if job is expired or filled
	$valid_page = $opportunity->valid_public_opportunity($public_hash);

	if ($valid_page == "Y" || $valid_page == "expired" || $valid_page == "filled" || $valid_page == "removed") {

		$opportunity_data = $opportunity->get_opportunity_data();
	
		//get job details
		$job_data						= $opportunity_data['job_data'];

		$jobID							= $job_data['general']['jobID'];
		$store_name					= $job_data['store']['name'];
		$address						= $job_data['store']['address'];
		$zip								= $job_data['store']['zip'];
		$website						= $job_data['store']['website'];
		$facebook						= $job_data['store']['facebook'];
		$twitter							= $job_data['store']['twitter'];
		$store_type					= $job_data['store']['description'];

		$employer 						= $job_data['employer'];
		$title		 						= $job_data['general']['title'];
		$requirements		 			= $job_data['requirements'];
		$notes							= $job_data['general']['description'];
		$qualifications					= $$job_data['general']['qualifications'];
		$main_skill		 				= $job_data['skills']['main_skill']['specialty'];
		$specialtyID			 		= $job_data['skills']['main_skill']['ID'];
		$benefits						= $job_data['general']['benefits'];
		$benefits_desc				= $job_data['general']['benefits_desc'];
		$schedule						= $job_data['general']['schedule'];
		$comp_type					= $job_data['general']['comp_type'];
		$comp_value					= $job_data['general']['comp_value'];
		$question_array				= $job_data['question_list']['questions'];
		$sub_skills						= $job_data['skills']['sub_skills'];
		$employment					= $job_data['general']['past_employment'];
		$date_created					= $job_data['general']['date_created'];
		
		switch($comp_type) {
			default:
				$compensation = $comp_type;
			break;
			
			case "Hourly":
				$compensation = "$".$comp_value."/hr";
			break;
			
			case "Salary":
				$compensation = "Salary:  $".$comp_value;
			break;				
		}		

		if ($benefits == "Y") {
			$benefits_text =	"<i>".$benefits_desc."</i><br />";
		} else {
			$benefits_text = 	"None<br />";				
		}
		
		switch($main_skill) {
			case "Bartender":
				$main_skill_image = "<img src='images/main-bar.png' height='150px'>";
			break;
			
			case "Manager":
				$main_skill_image = "<img src='images/main-manager.png' height='150px'>";
			break;
			
			case "Kitchen":
				$main_skill_image = "<img src='images/main-cook.png' height='150px'>";
			break;
			
			case "Server":
				$main_skill_image = "<img src='images/main-server.png' height='150px'>";
			break;
									
			case "Bus":
				$main_skill_image = "<img src='images/main-bus.png' height='150px'>";
			break;

			case "Host":
				$main_skill_image = "<img src='images/main-host.png' height='150px'>";
			break;						
		}				
		
		
		if ($notes == "" && $qualifications == "") {
			$notes_text = "";
		} else {
			$notes_text = $notes." <br />".$qualifications;
		}
		
		$website_text = "";
		if ($website == "") {
			$website_text = "No Website";
		} else {
			$website_text = "<a href='http://".$website."'>Website</a>";
		}

		if ($facebook == "") {
			$facebook_text = "";
		} else {
			$facebook_text = " | <a href='http://".$facebook."'>Facebook</a>";
		}
		
		if ($twitter == "") {
			$twitter_text = "";
		} else {
			$twitter_text = " | <a href='http://".$twitter."'>Twitter</a>";
		}												
			
		switch($main_skill) {
			case "Bartender":
				$og_title = "Bartender Position Available";
				$og_description = $title.":  ".$trim_description;				
			
			break;
			
			case "Manager":
				$og_title = "Management Position Available";
				$og_description = $title.":  ".$trim_description;				
			break;
			
			case "Kitchen":
				$og_title = "Kitchen Position Available";
				$og_description = $title.":  ".$trim_description;				
			break;
			
			case "Server":
				$og_title = "Server Position Available";
				$og_description = $title.":  ".$trim_description;				
			break;
									
			case "Bus":
				$og_title = "Bus Position Available";
				$og_description = $title.":  ".$trim_description;				
			break;

			case "Host":
				$og_title = "Host Position Available";
				$og_description = $title.":  ".$trim_description;				
			break;						
		}
			
									
	} else {
		$og_description = "This job is no longer available.";
		$og_title = "ServeBartendCook";
	}
	
	if ($site_type == "prototype") {
		$og_url = "http://threewhitebirds.com/SBC/public_listing_new.php?ID=".$_GET['ID']."&ref=".$public_hash;
		$og_image = "http://threewhitebirds.com/SBC/graphics/icon_800.png";
	} else {
		$og_url = "http://servebartendcook.com/public_listing_new.php?ID=".$_GET['ID']."&ref=".$public_hash;		
		$og_image = "http://servebartendcook.com/graphics/icon_800.png";
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53b054581d9d5d10"></script>


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
	<title>Serve. Bartend. Cook. - The Finest Hospitality Jobs!</title>
	
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<?php
	if ($site_type == "prototype") {
		echo "<meta name='robots' content='noindex' />";
	}
	if ($valid_page == "Y" || $valid_page == "expired" || $valid_page == "filled" || $valid_page == "removed") {


?>
<!-- 	Meta tags for Facebook OpenGraph -->

	<meta property="og:title" content="<? echo $og_title ?>" />
	<meta property="og:site_name" content="ServeBartendCook" />
	<meta property="og:description" content="<? echo $og_description ?>" />	
	<meta property="og:image" content="<? echo $og_image ?>" />	
 	<meta property="og:url" content="<? echo $og_url ?>" />

<!-- 	Meta tags for Twitter Card/Share -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:url" content="<? echo $og_url ?>">
	<meta name="twitter:title" content="<? echo $og_title ?>">
	<meta name="twitter:description" content="<? echo $og_description ?>"> 
<?php
	}
?>
	
	<!-- Stylesheets -->
	<link rel="stylesheet" type="text/css" href="stylesheets/base.css?v=8cb" /> 

	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Nothing+You+Could+Do|Quicksand:400,700,300">
	<link href="css/lightbox.css" rel="stylesheet" />
	<link href="css/flat-ui.css?v=1b" rel="stylesheet" />	
	<!-- Javascripts -->
	
	<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="js/lightbox-2.6.min.js"></script>	
	<script src="http://cdn.embed.ly/jquery.embedly-3.1.1.min.js" type="text/javascript"></script>	
    <script src="js/flatui-checkbox.js"></script>
	<script src="js/flatui-radio.js"></script>
	<script type="text/javascript" src="javascripts/html5shiv.js"></script>
	
	
	<? //echo $js_file_name ?>
	
	<!-- Favicons -->
	<link rel="shortcut icon" href="images/favicon.png" />
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
<!--	
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
-->
	
<link type="text/css" href="css/custom-theme/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Oswald:300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lato:400' rel='stylesheet' type='text/css'>
<!-- <script type="text/javascript" src="js/jquery-ui-1.8.23.custom.min.js"></script> -->
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>

<script type="text/javascript" src="js/jquery_form.js"></script>
	
</head>
<body>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=566018000164167";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<?php

if ($valid_page == "Y" || $valid_page == "expired" || $valid_page == "filled" || $valid_page == "removed") {

if ($device == "full") {
	$mobile_style = "";

?>
	<header>
		
		<div class="container">
<!-- 				<a href="#" class="logo"><img src="images/main.png" alt="Fluid App" border='0' /></a> -->

			<a href="index.php" class="logo" style="margin-top: 0px; margin-bottom: 30px;">			</a>

			<nav>
				<ul>
					<li><a href="index.php?page=help">Help</a></li>
				</ul>		
				<ul>
					<li><a href="index.php?page=login">Login</a></li>
				</ul>														
				<span class="arrow"></span>
			</nav>

		</div>
	</header>
<?php
	} else {
	$mobile_style = "style='margin-top:40px;'";
?>
	<a href="#" class="logo"><img src="images/main.png" alt="Fluid App" border='0' /></a> 
<?php		
	}
?>
 	<section class="container"> 
		
		<!-- Start App Info -->
	
		<div id="left" <? echo $mobile_style ?>>
			
	<div id="sidebar" style='min-height:500px; '>
	
	<div id="sidebar-content" style='margin-top:-5px;'>
<?php
	if ($valid_page == "Y") {
		echo "<div class='sidebar_button'> SHARE</div>";
?>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<div class="addthis_sharing_toolbox"></div>			

<?php		
/*
		echo "<div style='margin-top:0px; float:left;'><a href='https://twitter.com/share' class='twitter-share-button' data-text='Great new job on ServeBartendCook.com' data-related='servebarcook' data-lang='en'  data-count='none' data-hashtags='servebartendcook' data-url='http://threewhitebirds.com/SBC/public_listing_three.php?ID=".$_GET['ID']."&ref=".$public_hash."'>Tweet</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','twitter-wjs');</script></div>
					&nbsp; &nbsp; &nbsp; 
					<div class='fb-share-button' data-href='http://threewhitebirds.com/SBC/public_listing_three.php?ID=".$_GET['ID']."&ref=".$public_hash."' data-type='button'></div>";
		echo "&nbsp; <br /> &nbsp; <br />";
*/
	}
?>

		<div class='sidebar_button'> LEARN MORE</div>		
		&nbsp; <br />
		New Jobs of all types are added daily to ServeBartendCook.com.<br />
		&nbsp; <br />		
		It's simple and quick to create a profile and start getting matched to the jobs you want!<br />
		&nbsp; <br />		
		&nbsp; <br />		
		<div style='padding-left:20px;'><a href="index.php"><img src="images/button-who.png" border="0"></a></div>
		<br />
		<div style='padding-left:70px;'><a href="index.php">Are you hiring?</a></div>		
		&nbsp; <br />				
		<a href='main.php?page=how'><div class='sidebar_button'>FOLLOW US</div></a>										
		<div style="margin-top: 30px;"><center><a href="http://facebook.com/servebartendcook"><img src="images/facebook.png" border="0"></a> <a href="http://twitter.com/servebarcook"><img src="images/twitter.png" border="0"></a></center> </div>

	</div>

		</div>
	
		</div>
		<!-- End App Info -->		
									<!-- Start Pages -->
		<div id="pages">
			<div class="top_shadow"></div>
			
			<!-- Start Home -->
			<div id="home" class="">
		<div class="full" style="min-height: 300px;">
					<p>&nbsp;</P>	



<?php

	if ($valid_page == "Y") {					

		echo "<div class='job_details'>";
?>			
			<div style="width:100%; float:left; margin-top:-48px;">
				<h2 style="text-align:center">APPLY TODAY</h2>
				<a href='index.php?page=employee_signup&ID=<? echo $_GET['ID'] ?>'><div class="yellow_button" style="float:right; width:40%; margin-right:20px;">
					Register
				</div></a>
				
				<a href='index.php?page=login&ID=<? echo $_GET['ID'] ?>&ref=<? echo $public_hash ?>'><div class="yellow_button" style="float:left; width:40%; margin-left:20px;">
					Login
				</div></a>	
			</div>						
<?php

			echo	"<table class='dark' style='width:100%;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle'><h4>General Details</h4></th>";
				echo "</tr>";			
			echo "</table>";
			
			echo "<div id='title_holder' style='width:100%; margin-top:10px; float:left; padding-left:10px; font-size:1.125em'>";
				echo "<h3>".$title."</h3>";
			echo "</div><br />";
	
			echo "<div style='float:left; width:100%'>";
				echo "<div style='float:left; width:50%'>";
		
					echo "<div id='date_holder' style='width:100%; margin-top:10px; float:left; font-size:1.125em'>";
						echo "<div style='float:left; width:140px;'>&#9679; <b>Date Posted:</b> </div>";
						echo "<div id='date' style='float:left; padding-left:10px;'>".date('m-d-Y', strtotime($date_created))."</div>";
					echo "</div><br />";	
									
					echo "<div id='schedule_holder' style='width:100%; margin-top:10px; float:left; font-size:1.125em'>";		
						echo "<div style='float:left; width:150px;'>&#9679; <b>Schedule:</b></div>";
						echo "<span id='schedule_current' >".$schedule."</span>";
					echo "</div>";	
					
					echo "<div id='compensation_holder' style='width:100%; margin-top:10px; float:left; font-size:1.125em'>";					
						echo "<div style='float:left; width:150px;'>&#9679; <b>Compensation:</b></div>";
						echo "<span id='compensation_current'>".$compensation."</span>";
					echo "</div>";	
								
					echo "<div id='benefits_holder' style='width:100%; margin-top:10px; margin-bottom:10px; float:left; font-size:1.125em'>";					
						echo "<div style='float:left; width:150px;'>&#9679;  <b>Benefits:</b></div>";
						echo  "<span id='benefits_current'>".$benefits_text."</span>";
					echo "</div>";	
				
				echo "</div>";

				echo "<div style='float:left; width:50%'>";

					echo "<div id='store_holder' style='width:100%; margin-top:10px; float:left; font-size:1.125em'>";
						echo "<div style='float:left; text-align:center'><b><i>".$store_name." <br /> Job posted by: ".$employer['position']." </i></b></div>";    
					echo "</div>";	
					
					echo "<div id='type_holder' style='width:100%; margin-left:5px; margin-top:10px; margin-bottom:0px; float:left; font-size:1.125em'>";					
						echo  "<span id='store_type'>&#9679;  <b>Type:</b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ".$store_type."</span>";
					echo "</div>";	
					
					echo "<div id='type_holder' style='width:100%; margin-left:5px; margin-top:10px; margin-bottom:10px; float:left; font-size:1.125em'>";					
						echo  "<span id='store_type'>&#9679;  <b>Location: </b>&nbsp; &nbsp;<a href='https://www.google.com/maps/place/".$address." ".$zip."'>Map</a></span>";
					echo "</div>";						

					echo "<div id='type_holder' style='width:100%; margin-left:5px; margin-bottom:10px; float:left; font-size:1.125em'>";					
						echo  "<span id='store_type'> &nbsp; ".$website_text.$facebook_text.$twitter_text."</span>";
					echo "</div>";	

				echo "</div>";
			echo "</div>";

			echo	"<table class='dark' style='width:100%;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle'><h4>PREFERRED JOB SKILLS</h4></th>";
				echo "</tr>";			
			echo "</table>";
			
			echo "<div id='skill_holder' style='width:100%; float:left; margin-bottom:10px;'>";
				echo "<div style='width:170px; float:left; text-align:center;'>";
					echo $main_skill_image."<br />";
				echo "</div>";																							
		
				echo "<div style='width:450px; float:left;'>";
					if (count($sub_skills) == 0) {
						echo "&nbsp; <br /><i>No Specific Skills Required</i>";
					} else {							
						//table for display
						echo "<table id='skill_display' CELLSPACING=6 cellpadding=6 width='425px' style='color:red'>";
						$row_count = 2;
						foreach ($sub_skills as $row) {
								if ($row_count % 2 == 0) {		
									echo "<tr>";	
									echo "<td><b> &#x2713; ".$row['sub_specialty']."</b></td>";
								} else {
									echo "<td><b> &#x2713; ".$row['sub_specialty']."</b></td>";								
									echo "</tr>";
								}
								$row_count++;
						}
						if ($row_count % 2 == 0) {	
							echo "</tr>";
						}															
						echo "</table>";	
					}			
				echo "</div>";
			echo "</div>";
						
			echo	"<table class='dark' style='width:100%; margin-bottom:5px;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle'><h4>ADDITIONAL REQUIREMENTS</h4></th>";
				echo "</tr>";			
			echo "</table>";

			echo "<div id='requirements_holder' style='float:left; margin-left:5px; margin-bottom:10px; font-size:1.125em'>"	;	
				if (count($requirements) > 0) {
					foreach ($requirements as $row) {
						echo "<img src='images/icon-locations.png' style='vertical-align:middle;' width=30px;></b>".$row['requirement']."<br />";
					}				
				} else {
					echo "<i>No Requirements Listed</i>";
				}					
			echo "</div>";
			
			if ($notes_text != "") {
				echo	"<table class='dark' style='margin-bottom:5px; width:100%;'>";
					echo "<tr valign='middle'>";
					echo "<th valign='middle'><h4>OTHER INFORMATION</h4></th>";
					echo "</tr>";			
				echo "</table>";
	
				echo "<div id='notes_holder' style='float:left; margin-left:5px; margin-bottom:10px; font-size:1.125em'>";
					echo "<div id='notes_current' style='float:left; padding-left:10px;'><i>".$notes_text."</i></div>";
				echo "</div><br />";
			}			


			echo	"<table class='dark' style='width:100%; margin-bottom:10px;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle'></th>";
				echo "</tr>";			
			echo "</table>";
			
		
		echo "</div>";													
	
//Share form
		echo "<div id='share_job_form' style='display:none'>";
			echo "<h3>Share This Job Post With a Friends!</h3>";
//			echo "<a href='https://www.facebook.com/sharer/sharer.php?u=http://www.inc.com/magazine/201404/issie-lapowsky/what-livestrong-is-like-without-lance-armstrong.html' target='_blank'><div><img src='images/facebook.png' border='0' style='vertical-align:middle'> <b>SHARE ON FACEBOOK</b></div></a><br />";
//			echo "<a href='https://www.facebook.com/sharer/sharer.php?u=http://threewhitebirds.com/SBC/public_listing_three.php?ID=652&ref=VsEVLnP1dUu1&t=Sad%‌​20Trombone' target='_blank'><div><img src='images/facebook.png' border='0' style='vertical-align:middle'> <b>SHARE ON FACEBOOK</b></div></a><br />";

?>
<b>SHARE:  </b>  <a href="https://twitter.com/share" class="twitter-share-button" data-text="Great new <? echo $main_skill ?> job on ServeBartendCook.com" data-related="servebarcook" data-lang="en"  data-count="none" data-hashtags="servebartendcook" data-url="http://servebartendcook.com/public_listing_three.php?ID=652&ref=VsEVLnP1dUu1">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>


	<div class="fb-share-button" data-href="http://threewhitebirds.com/SBC/public_listing_three.php?ID=652&ref=VsEVLnP1dUu1" data-type="button"></div>
<?
			echo "&nbsp; <br />";
			echo "&nbsp; <br />";
			
			echo "<div><img src='images/twitter.png' border='0' style='vertical-align:middle'> <b>SHARE ON TWITTER</b></div><br />";
	
			echo "<b>Email job to a friend:</b><br/>";
			echo "<input type='text' id='email'> 	<a href='#' class='btn btn-large btn-primary send_job_email' id='".$jobID."'>Send Email</a><br />";
			echo "&nbsp; <br />";
			echo "<div id='email_warning' style='display:none'><font color='red'><b>Please enter a valid email address.</b></font><br /> &nbsp; <br /></div>";						
			echo "<div id='repeat_warning' style='display:none'><font color='red'><b>You already sent an email to this person.</b></font><br /> &nbsp; <br /></div>";						
			echo "<div id='spam_warning' style='display:none'><font color='red'><b>We only allow you to send up to 5 invites a day.</b></font><br /> &nbsp; <br /></div>";							
			echo "Clicking send will send an email from you, with your name, to the address above with information about this job post.<br />";
			echo "<i>(We will not use this email for advertising or marketing)</i><br />";
			echo "&nbsp; <br />";
			echo "<a href='#' class='btn btn-large btn-primary' id='close_share_job'>Back to Job Details</a>";		
		echo "</div>";		
	
?>

			<div class="clear"></div>
	</section>
	
		
		</div>

<?php
/*
	if ($device == "full") {
?>
	
	<div id="middle_layer" style="float:left; padding-top:45px; min-height:800px; width:100%; background-image:url('images/sbc-homebg01.jpg');">
	<a name="info"></a>	

		<div style='width:50%; float:left;'>

				<div style='width:100%; margin-left:-30px;'>
					<a href='index.php?page=employee_signup' class="large_button" id="blackberry" style='width:450px; text-align:center; float:right; margin-bottom:35px;'>
						<h1 style='color:white; margin-top:15px;'>NEED A JOB?</h1>
					</a>
				</div>
				
				&nbsp; <br />
				&nbsp; <br />			
				
				   <div class="bubble" style='float:right'>
				   		<div style='width:70%; float:left; '>
					   		<h2>Create Quality Profile</h2>
							 You'll be guided through a few easy steps to create a profile that highlights your skills and experience.  You are only notified of jobs that match your skills.
				   		</div>	
				   		<div style='width:25%; float:right; padding-left:5px; text-align:center'>				   		
							<img src="images/icon-check.png"><br />
							<a href='images/Employee-Profile-View.png' data-lightbox='image-1' title='Sample Profile'>Sample Profile</a>
				   		</div>
					</div>

					<div class="bubble" style='float:right'>
				   		<div style='width:70%; float:left; '>
					   		<h2>Remain Anonymous</h2>
								Your profile is completely <b>private</b>.  The only time anyone can see your profile is when you request an interview from a specific employer.					   						   		
				   		</div>
				   		<div style='width:25%; float:right; padding-left:5px; text-align:center'>				   						   		
							<img src="images/icon-anonymous.png" >
							<a href='images/Employee-Job-View.png' data-lightbox='image-2' title='Sample Job'>Sample Job</a>
							<a href='images/Job-Pre-Response.png' data-lightbox='image-2' title='Job Response Form' style='display:none'>Sample Job</a>																					
						</div>
					</div>
							
					<div class="bubble" style='float:right'>
						<div style='width:70%; float:left; '>
							<h2>Personalize Your Profile</h2>	
							Set yourself apart by adding a video introduction to your profile and a personal photo, or photos of your culinary of mixology creations.							
						
						</div>
				   		<div style='width:25%; float:right; padding-left:5px; text-align:center'>				   						   								
							<img src="images/icon-locations.png" style="float: right">
				   		</div>
					</div>
					
					<a href='index.php?page=employee_signup'><div class="yellow_button" style="float:right; margin-right:20px;">
						Sign up for free!
					</div></a>
		</div>
		
		<div style='width:50%; float:left;'>
				<div style='width:100%; margin-left:30px;'>
					<a href='index.php?page=employer_signup' class="large_button" id="blackberry" style='width:450px; text-align:center;'>
						<h1 style='color:white; margin-top:15px;'>ARE YOU HIRING?</h1>
					</a>
				</div>
	
				&nbsp; <br />
				&nbsp; <br />
				
				   <div class="bubble" style="float:left;">
				   		<div style='width:70%; float:left; '>
					   		<h2>Post a Job</h2>				   		
					   		Create a job post that includes specific skill requirements and experience tailored to your needs.  Job posts are free.				   		
				   		</div>
				   		<div style='width:25%; float:right; padding-left:5px; text-align:center'>				   		
							<img src="images/icon-check.png"><br />
							<a href='images/Employee-Job-View.png' data-lightbox='image-3' title='Sample Job'>Sample Job</a>
				   		</div>
				   </div>

					<div class="bubble" style="float:left;">
				   		<div style='width:70%; float:left; '>
					   		<h2>Screen Interested Candidates</h2>
					   		Filter interested candidates by pre-interview questions, video resumes, or cover letters.<br />
					   		Keep a list of highlighted favorites.				   		
				   		</div>
				   		<div style='width:25%; float:right; padding-left:5px; text-align:center'>				   		
							<img src="images/icon-match.png" >
							<a href='images/Candidate-List.jpg' data-lightbox='image-4' title='Sample Candidate List'>Sample Candidate List</a>
							<a href='images/Employer-Profile-View.png' data-lightbox='image-4' title='Sample Job Response' style='display:none'>Sample Job</a>						
				   		</div>
					</div>
							
					<div class="bubble" style="float:left;">
						<div style='width:70%; float:left; '>
							<h2>Manage Multiple Locations</h2>
							You can manage hiring at multiple locations through a single account.  Jobs will only match to candidates in the area specific to that location.							
						</div>
				   		<div style='width:25%; float:right; padding-left:5px; text-align:center'>				   		
							<img src="images/icon-locations.png" >
				   		</div>							
					</div>
					
					<a href='index.php?page=employer_signup'><div class="yellow_button" style="float:left; margin-left:20px;">
						Sign up for free!
					</div></a>					
		</div>		
	
	</div>
<?php
	}
	
*/
?>
	
	<!-- Start Footer -->
		<footer>
		&nbsp; <br />
		<p>Copyright &copy; 2015 SBC Industries, LLC</p>
	</footer>
	<!-- End Footer -->
	
	</div>

	<!-- End Wrapper -->
	
</body>

</html>
<?php
} else {
	echo "<h1>This page doesn't exist</h1>";
}
}
?>