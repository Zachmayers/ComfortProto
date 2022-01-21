<?php
//For ease, combining both mobile and full public job post functions in single file
	
function set_open_graph_vars($opportunity_data, $city_state)	{
	
	//set open graph variables for sharing option
	
		$job_data						= $opportunity_data['job_data'];

		$jobID							= $job_data['general']['jobID'];
		$store_name					= $job_data['store']['name'];
		$store_zip						= $job_data['store']['zip'];
		$title		 						= $job_data['general']['title'];
		$description					= $job_data['general']['description'];
		$main_skill		 			= $job_data['skills']['main_skill']['specialty'];
		$post_type					= $job_data['general']['post_type'];
		$bounty						= $job_data['general']['bounty'];
		$date_created				= $job_data['general']['date_created'];
		$schedule						= $job_data['general']['schedule'];
		$address						= $job_data['store']['address'];
		$zip								= $job_data['store']['zip'];
		$comp_type					= $job_data['general']['comp_type'];
		$comp_value					= $job_data['general']['comp_value'];

		switch($main_skill) {
			case "Bartender":
				$og_title = "Bartender Position Available";
				$og_description = $title." @ ".$store_name;		
				$meta_title = "Hiring Bartender Position - ".$store_name;		
			break;
			
			case "Manager":
				$og_title = "Management Position Available";
				$og_description = $title." @ ".$store_name;				
				$meta_title = "Hiring Management Position - ".$store_name;				
			break;
			
			case "Kitchen":
				$og_title = "Kitchen Position Available";
				$og_description = $title." @ ".$store_name;	
				
				if (strpos($title, 'Line Cook') !== false) {
					$meta_title = "Hiring Line Cook Position - ".$store_name;				
				} elseif (strpos($title, 'Prep') !== false) {
					$meta_title = "Hiring Prep Cook Position - ".$store_name;					
				} elseif (strpos($title, 'Dish') !== false) {
					$meta_title = "Hiring Dish Position - ".$store_name;					
				} else {
					$meta_title = "Hiring Kitchen Position - ".$store_name;										
				}
			break;
			
			case "Server":
				$og_title = "Server Position Available";
				$og_description = $title." @ ".$store_name;				
				$meta_title = "Hiring Server Position - ".$store_name;				
			break;
									
			case "Bus":
				$og_title = "Bus Position Available";
				$og_description = $title." @ ".$store_name;				
				$meta_title = "Hiring Bus Position - ".$store_name;				
			break;

			case "Host":
				$og_title = "Host Position Available";
				$og_description = $title." @ ".$store_name;				
				$meta_title = "Hiring Host Position - ".$store_name;				
			break;						
		}
		
		$meta_description = $store_name." in ".$city_state['city'].", ".$city_state['state']." is hiring - ".$title;	
		
		//set variables for Rich Snippet data
		if ($title == "Line Cook - Casual Dining" || $title == "Line Cook - Fine Dining") {
			$snippet_title = "Line Cook";
		} elseif ($title == "Server - Casual Dining" || $title == "Server - Fine Dining") {
			$snippet_title = "Server";			
		} else {
			$snippet_title = $title;
		}
		
		$snippet_description = $description;	
				
		if ($comp_type == "Hourly") {
			$snippet_pay_type = "HOUR";
			$snippet_pay_amount = $comp_value;
		} elseif ($comp_type == "Salary") {
			$snippet_pay_type = "SALARY";
			$snippet_pay_amount = $comp_value;			
		} else {
			$snippet_pay_type = "NA";
			$snippet_pay_amount = "NA";	
		}
		
		switch($schedule) {
			default: 
				$snippet_schedule = "PART TIME";
			break;
			
			case "Part Time": 
				$snippet_schedule = "PART TIME";
			break;

			case "Full Time": 
				$snippet_schedule = "FULL TIME";
			break;
		}
		
		return $og_array = array("title" => $og_title,
												"description" => $og_description, 
												"meta_title" => $meta_title, 
												"meta_description" => $meta_description,
												"snippet_title" => $snippet_title,
												"snippet_description" => $snippet_description,
												"snippet_pay_type" => $snippet_pay_type,
												"snippet_pay_amount" => $snippet_pay_amount,
												"snippet_schedule" => $snippet_schedule,
												"store_name" => $store_name,
												"date_created" => $date_created,
												"store_zip" => $zip,
												"store_address" => $address,
												"store_city" => $city_state['city'],
												"store_state" => $city_state['state']);
}
	
function public_full_header_html($site_type, $og_title, $og_description, $meta_title, $meta_description, $google_analytics, $fb_remarket, $snippet_details) {
	//header and sidebar for full site
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title><? echo $meta_title ?></title>
	<meta name="description" content="<? echo $meta_description ?>">
	
<!--
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
-->
<?php
	if ($site_type != "live") {
?>
		<meta name='robots' content='noindex' />
<?php
	}
?>
<!-- 	Meta tags for Facebook OpenGraph -->

	<meta property="og:title" content="<? echo $og_title ?>" />
	<meta property="og:description" content="<? echo $og_description ?>" />	
	<meta property="og:image" content="https://servebartendcook.com/new_square_logo.png" />
<!--  	<meta property="og:url" content="<? echo $og_url ?>" /> -->

<!-- 	Meta tags for Twitter Card/Share -->

	<meta property="twitter:account_id" content="1125423043" />
	<meta name="twitter:card" content="summary">
	<meta property="twitter:site" content="@servebarcook" />	
	<meta name="twitter:title" content="<? echo $og_title ?>">
	<meta name="twitter:description" content="<? echo $og_description ?>"> 
	<meta property="twitter:image" content="http://servebartendcook.com/images/SBC-cook-Twitter.png" />
	
	<!-- Stylesheets -->
	<link rel="stylesheet" type="text/css" href="stylesheets/base.css?v=8cb" /> 

	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Nothing+You+Could+Do|Quicksand:400,700,300">
	<link href="css/lightbox.css" rel="stylesheet" />
	<link href="css/flat-ui.css?v=1b" rel="stylesheet" />
		
	<!-- Javascripts -->
	<script src="https://use.fontawesome.com/54f279e8d7.js"></script>	
	<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="js/lightbox-2.6.min.js"></script>	
	<script src="//cdn.embed.ly/jquery.embedly-3.1.1.min.js" type="text/javascript"></script>	
    <script src="js/flatui-checkbox.js"></script>
	<script src="js/flatui-radio.js"></script>
	<script type="text/javascript" src="javascripts/html5shiv.js"></script>
	<script type="text/javascript" src="js/public.js?v=1a"></script>	
		
	<!-- Favicons -->
	<link rel="shortcut icon" href="images/favicon.png" />
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
<!--	
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
-->
	
<link type="text/css" href="css/custom-theme/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" />
<link href='//fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald:300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Lato:400' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>

<script type="text/javascript" src="js/jquery_form.js"></script>

<?php
	if ($site_type == "live") {
?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-38015816-1', 'auto');
	  ga('send', 'pageview');

</script>
 
<?php
	}
?>

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1436959506576243');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1436959506576243&ev=PageView&noscript=1"
/></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->

<!-- Rich Snippet Mark-Up for Google Searches -->
<script type="application/ld+json"> {
  "@context" : "http://schema.org/",
  "@type" : "JobPosting",
  "title" : "<? echo $snippet_details['snippet_title'] ?>",
  "description" : "<p><? echo $snippet_details['snippet_description'] ?></p>",

  "datePosted" : "<? echo $snippet_details['snippet_date'] ?>",
  "employmentType" : "<? echo $snippet_details['snippet_schedule'] ?>",
  "hiringOrganization" : {
    "@type" : "Organization",
    "name" : "<? echo $snippet_details['store_name'] ?>"
   },

  "jobLocation" : {
    "@type" : "Place",
    "address" : {
      "@type" : "PostalAddress",
      "streetAddress" : "<? echo $snippet_details['store_address'] ?>",
      "addressLocality" : "<? echo $snippet_details['store_city'] ?>",
      "addressRegion" : "<? echo $snippet_details['store_state'] ?>",
      "postalCode" : "<? echo $snippet_details['store_zip'] ?>",
      "addressCountry": "US"
    }
  }
<?php if ($snippet_details['snippet_pay_type'] != "NA") { ?>
	,
	  "baseSalary": {
	    "@type": "MonetaryAmount",
	    "currency": "USD",
	    "value": {
	      "@type": "QuantitativeValue",
	      "value": <? echo $snippet_details['snippet_pay_amount'] ?>,
	      "unitText": "<? echo $snippet_details['snippet_pay_type'] ?>"
	    }
	  }
    
 <?php } ?>
}
</script>
	
</head>
<body>

	<header>
		
		<div class="container">
			<a href="index.php" class="logo" style="margin-top: 0px; margin-bottom: 30px;"></a>
		</div>
		
	</header>
	
 	<section class="container"> 
		
		<!-- Start App Info -->
	
		<div id="left">
			
	<div id="sidebar" style='min-height:500px; '>
	
	<div id="sidebar-content" style='margin-top:-5px;'>
	
	
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
		<div class='sidebar_button'>FOLLOW US</div>										
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
}	

function public_mobile_header_html($site_type, $og_title, $og_description, $meta_title, $meta_description, $google_analytics, $fb_remarket, $snippet_details) {
	//header for mobile site
?>
<!-- <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> -->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title><? echo $meta_title ?></title>
	<meta name="description" content="<? echo $meta_description ?>">
	
<?php
	if ($site_type != "live") {
?>
		<meta name='robots' content='noindex' />
<?php
	}
?>
	
<!-- 	Meta tags for Facebook OpenGraph -->

	<meta property="og:title" content="<? echo $og_title ?>" />
	<meta property="og:description" content="<? echo $og_description ?>" />	
	<meta property="og:image" content="https://servebartendcook.com/new_square_logo.png" />
<!--  	<meta property="og:url" content="<? echo $og_url ?>" /> -->

<!-- 	Meta tags for Twitter Card/Share -->

	<meta property="twitter:account_id" content="1125423043" />
	<meta name="twitter:card" content="summary">
	<meta property="twitter:site" content="@servebarcook" />	
	<meta name="twitter:title" content="<? echo $og_title ?>">
	<meta name="twitter:description" content="<? echo $og_description ?>"> 
	<meta property="twitter:image" content="http://servebartendcook.com/images/SBC-cook-Twitter.png" />
	
<!-- 	<link rel="apple-touch-icon" href="icons/ios/2013-FL-iOS-57.png"/> -->
	<meta name="apple-mobile-web-app-capable" content="yes" />	

	<link rel="stylesheet" type="text/css" href="css/style-mobile.css?v=2n" />
 	<link rel="stylesheet" type="text/css" href="css/flat-ui-mobile.css?v=1f" />
 	<!-- 	<link rel="stylesheet" type="text/css" href="stylesheets/base.css?v=8cb" />  -->
	
	<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
 
	<script src="https://use.fontawesome.com/54f279e8d7.js"></script> 
    <script src="js/flatui-checkbox.js"></script>
	<script src="js/flatui-radio.js"></script>
	<script src="//cdn.embed.ly/jquery.embedly-3.1.1.min.js" type="text/javascript"></script>	
	<script type="text/javascript" src="javascripts/html5shiv.js"></script>
	<script type="text/javascript" src="js/jquery_form.js"></script>
	<script type="text/javascript" src="js/ajax.js?v=5"></script>	
	<script type="text/javascript" src="js/public.js?v=1"></script>	

<?php
	if ($site_type == "live") {
?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-38015816-1', 'auto');
	  ga('send', 'pageview');

</script>
<?php
	}
?>

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1436959506576243');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1436959506576243&ev=PageView&noscript=1"
/></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->

<!-- Rich Snippet Mark-Up for Google Searches -->
<script type="application/ld+json"> {
  "@context" : "http://schema.org/",
  "@type" : "JobPosting",
  "title" : "<? echo $snippet_details['snippet_title'] ?>",
  "description" : "<p><? echo $snippet_details['snippet_description'] ?></p>",

  "datePosted" : "<? echo $snippet_details['snippet_date'] ?>",
  "employmentType" : "<? echo $snippet_details['snippet_schedule'] ?>",
  "hiringOrganization" : {
    "@type" : "Organization",
    "name" : "<? echo $snippet_details['store_name'] ?>"
   },

  "jobLocation" : {
    "@type" : "Place",
    "address" : {
      "@type" : "PostalAddress",
      "streetAddress" : "<? echo $snippet_details['store_address'] ?>",
      "addressLocality" : "<? echo $snippet_details['store_city'] ?>",
      "addressRegion" : "<? echo $snippet_details['store_state'] ?>",
      "postalCode" : "<? echo $snippet_details['store_zip'] ?>",
      "addressCountry": "US"
    }
  }
<?php if ($snippet_details['snippet_pay_type'] != "NA") { ?>
	,
	  "baseSalary": {
	    "@type": "MonetaryAmount",
	    "currency": "USD",
	    "value": {
	      "@type": "QuantitativeValue",
	      "value": <? echo $snippet_details['snippet_pay_amount'] ?>,
	      "unitText": "<? echo $snippet_details['snippet_pay_type'] ?>"
	    }
	  }
    
 <?php } ?>
}
</script>

	</head>

	<body onunload="">

	<div id="content">	
	
<!-- Main content divs  -->

	<div id="holder">
		
	<div class="fixed-menu" style="text-align:center; padding-bottom:5px; color:red;">
		<span style='float:left; position:relative; top:8px; left:3.5%'> &nbsp; </span>
		<img src="images/logo-final.png" height='30px' style='padding-top:15px;'>
	</div>
<?php
}
	
function public_opportunity_html($opportunity_data, $public_hash) {
$utilities = new Utilities;
//==================================
//!  First break master arrays into trait arrays
//
//  Modify any data for presentation
//==================================

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

		$employer 					= $job_data['employer'];
		$title		 						= $job_data['general']['title'];
		$requirements		 		= $job_data['requirements'];
		$notes							= $job_data['general']['description'];
		$qualifications				= $$job_data['general']['qualifications'];
		$main_skill		 			= $job_data['skills']['main_skill']['specialty'];
		$specialtyID			 		= $job_data['skills']['main_skill']['ID'];
		$benefits						= $job_data['general']['benefits'];
		$benefits_desc				= $job_data['general']['benefits_desc'];
		$schedule						= $job_data['general']['schedule'];
		$comp_type					= $job_data['general']['comp_type'];
		$comp_value					= $job_data['general']['comp_value'];
		$question_array				= $job_data['question_list']['questions'];
		$sub_skills						= $job_data['skills']['sub_skills'];
		$employment					= $job_data['general']['past_employment'];
		$date_created				= $job_data['general']['date_created'];

		$post_type					= $job_data['general']['post_type'];
		$bounty						= $job_data['general']['bounty'];
		
		$city_state = $utilities->get_city_state($zip);		
		
		//separate skills
		//show only the first 5 then a more button
		//if there are no skills, or less than 5 show requirement
		//if no requirements show description
		//if no description fuck it, show dancing squirrels
		
		$visible_list = array();
		$hidden_list = array();
		$visible_description = "";
		$hidden_description = "";

		$count = 1;
		
		if (count($sub_skills) > 0) {
			foreach($sub_skills as $row) {
				if ($count <= 8) {
					$visible_list[] = $row['sub_specialty'];
				} else {
					$hidden_list[] = $row['sub_specialty'];
				}
				$count++;		
			}	
		}
		
		if (count($requirements) > 0) {
			foreach($requirements as $row) {
				if ($count >= 8) {
					$hidden_list[] = $row['requirement'];
				} else {
					$visible_list[] = $row['requirement'];
				}
				$count++;
			}
		}
		
		$hidden_description = "<i>No specific skills or requirements added for this positions</i>";
		$visible_description = "<span id='visible_description'></span>";
		
		if (count($visible_list) == 0) {
			//count description number of characters
			$desc_length = strlen($notes);
			if ($desc_length < 200) {
				$visible_description = $notes;
			} else {
				$visible_description = substr($notes, 0, 200);
				$visible_description .= "...";
				//$hidden_description = substr($notes, 200);
				$hidden_description = $notes;
				$visible_description = "<div id='visible_description'>".$visible_description."<br /> &nbsp; <br /></div>";
			}
		} else {
			if ($notes == "") {
				$hidden_description = "<i>No specific skills or requirements added for this positions</i>";
			} else {
				$hidden_description = $notes;				
			}
		}
		
		
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
			$benefits_text = "Benefits Available<br />";
		} else {
			$benefits_text = "No Benefits<br />";				
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
		
		if ($post_type == "bounty") {
			$bounty_bar = "<div style='float:left; width:99%; border-bottom: solid black 1px; border-top: solid black 1px; background-color:#2e6652; color:white; padding: 3px 3px 3px 3px; margin-bottom:5px;'>";
				$bounty_bar .= "<a href='https://servebartendcook.com/index.php?page=bounty_faq' style='color:white'><div style='float:left; width:65px;'><img src='images/bounty.png' height='50px' width='50px' alt='bounty_job' style='vertical-align:middle;'></div>";
				$bounty_bar .= "<div style='float:left; margin-top:5px; width:80%;'><h4 style='margin-bottom:5px; display:inline;'>BOUNTY: $".$bounty."</h3><br />";
				$bounty_bar .= "This job has a bounty available, click to learn more about bounties.</div>";
			$bounty_bar .= "</div></a>";
		} else {
			$bounty_bar = "";
		}								
			
		echo "<div class='job_details' style='float:left; margin-top:5px; width:100%;'>";
			
			echo "<div id='title_holder' style='float:left; width:100%; margin-top:0px; float:left; font-size:1.125em'>";
				echo "<div style='width:50%;'>";
					echo "<div id='apply' style='float:left; text-align:center; width:250px; margin-left:10px; border-radius:10px; border-style:solid; border-width:3px; border-color:white; background-color:#8e080b'><h2 style='color:white; margin-top:8px; margin-bottom:8px; cursor:pointer;'>APPLY NOW</h2></div>";
				echo "</div>";
				echo "<div style='float:left; width:50%; text-align:center; color:gray; margin-top:5px;'>";
					echo "<i>Located @ ";
					echo $address."<br /> ".$city_state['city'].", ".$city_state['state']." ".$zip."</i>";					
				echo "</div>";
			echo "</div>";
	
			echo "<div style='float:left; width:100%; margin-left:25px; margin-top:10px; float:left;'>";
				echo "<h3 style='margin-bottom:0px'>".strtoupper($title)."</h3>";
				//echo "<h4 style='margin-bottom:0px; color:gray'>@</h3>";
				echo "<h3 style='margin-bottom:0px'><i>".$store_name."</i></h4>";
			echo "</div>";
			
			echo "<div style='float:left; width:100%; margin-left:25px; margin-top:10px; float:left; color:gray;'>";				
				echo "<h5 style='margin-top:0px;'><i>".$schedule."</i> &nbsp; &nbsp; &nbsp; &nbsp; | &nbsp; &nbsp; &nbsp; &nbsp; <i>".$compensation."</i> &nbsp; &nbsp; &nbsp; &nbsp; | &nbsp; &nbsp; &nbsp; &nbsp; <i>".$benefits_text."</i></h5>";
			echo "</div>";
			
				echo "<div style='width:100%; float:left; padding-left:15px; padding-right:15px; font-size:1.125em; color:#4c0100;'>";
					if (count($visible_list) == 0) {
						echo $visible_description;
					} else {							
						//table for display
						foreach ($visible_list as $row) {
							echo "<div style='float:left; width:100%; margin-bottom:8px;'>";
								echo "<b> &#x2713;</b> ".$row."<br />";
							echo "</div>";
						}
					}	
				echo "</div>";
				
				echo "<div style='float:left; width:100%; text-align:center;'><a href='#' id='more' style='color:#4c0100; text-decoration: none'>&#9660;<b>MORE</b>&#9660;</a></div>";		

				echo "<div class='description' style='width:100%; float:left; padding-left:15px; padding-right:15px; font-size:1.125em; color:#4c0100; display:none;'>";
					if (count($hidden_list)> 0) {
						foreach ($hidden_list as $row) {
							echo "<div style='float:left; width:100%; margin-bottom:8px;'>";
								echo "&#x2713; ".$row."<br />";
							echo "</div>";
						}
					}	
					echo "</br>".$hidden_description."<br /> &nbsp; <br />";					
				echo "</div>";
				echo "<div class='description' style='float:left; width:100%; text-align:center; color:#4c0100; display:none;'><a href='#' id='less' style='color:#4c0100; text-decoration: none'>&#9650; LESS &#9650;</a></div>";		
			
			echo "<div style='width:100%; text-align:center; margin-top:15px; float:left;'>";
				
				echo "<div style='float:left; width:40%; padding-left:20%'>";
					echo "<a href='https://www.google.com/maps/place/".$address." ".$zip."'><div style='float:left; width:100px; padding-top:7px; padding-bottom:7px; border-radius:2px; border-style:solid; border-width:1px; border-color:#b76163; color:#b76163'>";
						echo "<i class='fa fa-map-marker' aria-hidden='true'></i> View Map";
					echo "</div></a>";
				echo "</div>";

				if ($website == "") {
					echo "<div style='float:right; width:40%;'>";				
						echo "<div style='float:left; width:100px; padding-top:7px; padding-bottom:7px; border-radius:2px; border-style:solid; border-width:1px; border-color:gray; color:gray'>";
							echo "<i class='fa fa-external-link' aria-hidden='true'></i>No Website";
						echo "</div>";
					echo "</div>";				
				} else {					
					echo "<div style='float:right; width:40%;'>";				
						echo "<a href='http://".$website."'>";
						echo "<div style='float:left; width:100px; padding-top:7px; padding-bottom:7px; border-radius:2px; border-style:solid; border-width:1px; border-color:#b76163; color:#b76163'>";
							echo "<i class='fa fa-external-link' aria-hidden='true'></i> &nbsp; Website";
						echo "</div></a>";
					echo "</div>";	
				}				
			echo "</div>";
		echo "</div>";	
			
		echo "</div>";		
?>

			<div class="clear"></div>
	</section>
		
	</div>
		
	<!-- Start Footer -->
		<footer>
		&nbsp; <br />
		<p>Copyright &copy; 2017 SBC Industries, LLC</p>
	</footer>
	<!-- End Footer -->
	
	</div>

	<!-- End Wrapper -->
	
</body>

</html>
		
<?php	
}

function public_opportunity_html_mobile($opportunity_data, $public_hash) {
$utilities = new Utilities;
//==================================
//!  First break master arrays into trait arrays
//
//  Modify any data for presentation
//==================================

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

		$employer 					= $job_data['employer'];
		$title		 						= $job_data['general']['title'];
		$requirements		 		= $job_data['requirements'];
		$notes							= $job_data['general']['description'];
		$qualifications				= $$job_data['general']['qualifications'];
		$main_skill		 			= $job_data['skills']['main_skill']['specialty'];
		$specialtyID			 		= $job_data['skills']['main_skill']['ID'];
		$benefits						= $job_data['general']['benefits'];
		$benefits_desc				= $job_data['general']['benefits_desc'];
		$schedule						= $job_data['general']['schedule'];
		$comp_type					= $job_data['general']['comp_type'];
		$comp_value					= $job_data['general']['comp_value'];
		$question_array				= $job_data['question_list']['questions'];
		$sub_skills						= $job_data['skills']['sub_skills'];
		$employment					= $job_data['general']['past_employment'];
		$date_created				= $job_data['general']['date_created'];

		$post_type					= $job_data['general']['post_type'];
		$bounty						= $job_data['general']['bounty'];
		
		$city_state = $utilities->get_city_state($zip);		
		
		//separate skills
		//show only the first 5 then a more button
		//if there are no skills, or less than 5 show requirement
		//if no requirements show description
		//if no description fuck it, show dancing squirrels
		
		$visible_list = array();
		$hidden_list = array();
		$visible_description = "";
		$hidden_description = "";

		$count = 1;
		
		if (count($sub_skills) > 0) {
			foreach($sub_skills as $row) {
				if ($count <= 6) {
					$visible_list[] = $row['sub_specialty'];
				} else {
					$hidden_list[] = $row['sub_specialty'];
				}
				$count++;		
			}	
		}
		
		if (count($requirements) > 0) {
			foreach($requirements as $row) {
				if ($count >= 6) {
					$hidden_list[] = $row['requirement'];
				} else {
					$visible_list[] = $row['requirement'];
				}
				$count++;
			}
		}
		
		$hidden_description = "<i>No specific skills or requirements added for this positions</i>";
		$visible_description = "";
		
		if (count($visible_list) == 0) {
			//count description number of characters
			$desc_length = strlen($notes);
			if ($desc_length < 200) {
				$visible_description = $notes;
			} else {
				$visible_description = substr($notes, 0, 200);
				$visible_description .= "...";
				//$hidden_description = substr($notes, 200);
				$hidden_description = $notes;
				$visible_description = "<div id='visible_description'>".$visible_description."<br /> &nbsp; <br /></div>";
			}
		} else {
			$hidden_description = $notes;
		}
		
		
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
			//$benefits_text =	"<i>".$benefits_desc."</i><br />";
			$benefits_text = "Benefits Avail.";
		} else {
			$benefits_text = "No Benefits";				
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

		if ($post_type == "bounty") {
			$bounty_bar = "<div style='float:left; width:100%; border-bottom: solid black 1px; border-top: solid black 1px; background-color:#2e6652; color:white; padding: 3px 3px 3px 3px; margin-bottom:5px;'>";
				$bounty_bar .= "<a href='https://servebartendcook.com/index.php?page=bounty_faq' style='color:white'><div style='float:left; width:20%;'><img src='images/bounty.png' height='50px' width='50px' alt='bounty_job' style='vertical-align:middle;'></div>";
				$bounty_bar .= "<div style='float:left; margin-top:5px; width:80%;'><h4 style='margin-bottom:5px; display:inline;'>BOUNTY: $".$bounty."</h3><br />";
				$bounty_bar .= "Click to learn more about bounties.</div>";
			$bounty_bar .= "</div></a>";
		} else {
			$bounty_bar = "";
		}								

		
		echo "<div class='job_details' style='float:left; margin-top:5px; width:100%; min-height:300px;'>";
			
			echo "<div id='title_holder' style='width:100%; text-align:center; margin-top:0px; float:left; font-size:1.125em'>";
				echo "<h3 style='margin-bottom:0px'>".strtoupper($title)."</h3>";
				//echo "<h4 style='margin-bottom:0px; color:gray'>@</h3>";
				echo "<h3 style='margin-bottom:0px'><i>".$store_name."</i></h4>";
			echo "</div>";
	
			echo "<div style='float:left; width:100%; text-align:center; margin-top:10px; float:left; color:gray'>";
				
				echo "<div style='float:left; width:33%;'>";
					echo "<h5 style='margin-top:0px;'>".$schedule."</h5>";
				echo "</div>";
				
				echo "<div style='float:left; width:33%'>";
					echo "<h5 style='margin-top:0px;'>".$compensation."</h5>";
				echo "</div>";
				
				echo "<div style='float:left; width:33%'>";
					echo "<h5 style='margin-top:0px;'>".$benefits_text."</h5>";
				echo "</div>";				
				
			echo "</div>";
			
				echo "<div style='width:100%; float:left; padding-left:15px; padding-right:15px; font-size:1.125em; color:#4c0100;'>";
					if (count($visible_list) == 0) {
						echo $visible_description;
					} else {							
						//table for display
						foreach ($visible_list as $row) {
							echo "<div style='float:left; width:100%; margin-bottom:8px;'>";
								echo "<b> &#x2713;</b> ".$row."<br />";
							echo "</div>";
						}
					}	
				echo "</div>";
				
				echo "<div style='float:left; width:100%; text-align:center;'><a href='#' id='more' style='color:#4c0100; text-decoration: none'>&#9660;<b>MORE</b>&#9660;</a></div>";		

				echo "<div class='description' style='width:100%; float:left; padding-left:15px; padding-right:15px; font-size:1.125em; color:#4c0100; display:none;'>";
					if (count($hidden_list)> 0) {
						foreach ($hidden_list as $row) {
							echo "<div style='float:left; width:100%; margin-bottom:8px;'>";
								echo "&#x2713; ".$row."<br />";
							echo "</div>";
						}
					}	
					echo "</br>";
					echo "<div style='float:left; width:95%; margin-right:3px;'>";					
						echo $hidden_description."<br /> &nbsp; <br />";
					echo "</div>";					
				echo "</div>";
				echo "<div class='description' style='float:left; width:100%; text-align:center; color:#4c0100; display:none;'><a href='#' id='less' style='color:#4c0100; text-decoration: none'>&#9650; LESS &#9650;</a></div>";		
			
			echo "<div style='width:100%; text-align:center; margin-top:15px; float:left;'>";
				
				echo "<div style='float:left; width:40%; padding-left:10%'>";
					echo "<a href='https://www.google.com/maps/place/".$address." ".$zip."'><div style='float:left; width:100px; padding-top:7px; padding-bottom:7px; border-radius:2px; border-style:solid; border-width:1px; border-color:#b76163; color:#b76163'>";
						echo "<i class='fa fa-map-marker' aria-hidden='true'></i> View Map";
					echo "</div></a>";
				echo "</div>";

				if ($website == "") {
					echo "<div style='float:left; width:40%; padding-left:10%'>";				
						echo "<div style='float:left; width:100px; padding-top:7px; padding-bottom:7px; border-radius:2px; border-style:solid; border-width:1px; border-color:gray; color:gray'>";
							echo "<i class='fa fa-external-link' aria-hidden='true'></i>No Website";
						echo "</div>";
					echo "</div>";				
				} else {					
					echo "<div style='float:left; width:40%; padding-left:10%'>";				
						echo "<a href='http://".$website."'>";
						echo "<div style='float:left; width:100px; padding-top:7px; padding-bottom:7px; border-radius:2px; border-style:solid; border-width:1px; border-color:#b76163; color:#b76163'>";
							echo "<i class='fa fa-external-link' aria-hidden='true'></i> &nbsp; Website";
						echo "</div></a>";
					echo "</div>";	
				}				
			echo "</div>";
		echo "</div>";	
			
			//special background and apply button
?>
			<div style="float:left; width:100%; min-height:200px; margin-top:15px; background-image: url('images/mobile-bg-server.jpg'); background-size: cover; text-align:center">
<?php
				echo "<div style='float:left; width:100%; margin-top:15px; color:white;'>";
					echo "Located @ ";
					echo $address."<br /> ".$city_state['city'].", ".$city_state['state']." ".$zip;					
				echo "</div>";
				
				echo "<div style='float:left; width:100%; margin-top:15px;'>";
					echo "<div id='apply' style='float:left; width:50%; margin-left:25%; border-radius:10px; border-style:solid; border-width:3px; border-color:white; background-color:#8e080b'><h2 style='color:white; margin-top:8px; margin-bottom:8px; cursor:pointer;'>APPLY NOW</h2></div>";
				echo "</div>";

				if ($post_type == "bounty") {
					echo "<div style='float:left; width:100%; margin-top:10px; color:white;'>";
						echo "Bounty Available: $".$bounty."<br />";
					echo "</div>";
				}

				echo "<div style='float:left; width:100%; margin-top:30px; color:white; text-decoration:underline;'>";
					echo "<a href='index.php' style='color:white; text-decoration-color:white;'><h3 style='color:white; text-decoration-color:white;'>View More Available Jobs!</h3></a>";
				echo "</div>";
				
			echo "</div>";
						
/*
			echo "<div style='float:left; width:100%; margin-left:5px; margin-right:3px;'>";
		
					echo "<div id='date_holder' style='width:100%; margin-top:5px; float:left; font-size:1.125em'>";
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

					echo "<div id='store_holder' style='width:100%; margin-top:10px; text-align:center; float:left; font-size:1.125em'>";
						echo "<b><i>".$store_name." <br /> Job posted by: ".$employer['position']."</i></b>";    
					echo "</div>";	
					
					echo "<div id='type_holder' style='width:100%; margin-left:5px; margin-top:10px; margin-bottom:0px; float:left; font-size:1.125em'>";					
						echo  "<span id='store_type'>&#9679;  <b>Type:</b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ".$store_type."</span>";
					echo "</div>";	
					
					echo "<div id='type_holder' style='width:100%; margin-left:5px; margin-top:10px; margin-bottom:10px; float:left; font-size:1.125em'>";					
						echo  "<span id='store_type'>&#9679;  <b>Location: </b>&nbsp; &nbsp;<a href='https://www.google.com/maps/place/".$address." ".$zip."'>Map</a></span>";
					echo "</div>";						

					echo "<div id='type_holder' style='width:100%; margin-bottom:10px; margin-top:5px; text-align:center; float:left; font-size:1.125em'>";					
						echo  "<span id='store_type'> &nbsp; ".$website_text.$facebook_text.$twitter_text."</span>";
					echo "</div>";	

			echo "</div>";

			echo	"<table class='dark' style='width:100%;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle'>PREFERRED JOB SKILLS</th>";
				echo "</tr>";			
			echo "</table>";
			
			echo "<div id='skill_holder' style='width:100%; float:left; margin-bottom:10px;'>";
				echo "<div style='width:110px; float:left; text-align:center;'>";
					echo $main_skill_image."<br />";
				echo "</div>";																							
		
				echo "<div style='float:left;'>";
					if (count($sub_skills) == 0) {
						echo "&nbsp; <br /><i>No Specific Skills Required</i>";
					} else {							
						//table for display
						echo "<table id='skill_display' CELLSPACING=3 cellpadding=3 style='color:red'>";
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
				echo "<th valign='middle'>ADDITIONAL REQUIREMENTS</th>";
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
					echo "<th valign='middle'>OTHER INFORMATION</th>";
					echo "</tr>";			
				echo "</table>";
	
				echo "<div id='notes_holder' style='float:left; margin-left:5px; margin-bottom:10px; font-size:1.125em'>";
					echo "<div id='notes_current' style='float:left; padding-left:10px;'><i>".$notes_text."</i></div>";
				echo "</div><br />";
			}			
	
echo "<div style='text-align:center; width:100%; float:left;'><a href='index.php'><div class='btn btn-large btn-warning' style='float:left; width:95%; text-align:center; margin-left:1px; margin-bottom:10px; color:white;'>Learn More About SBC</div></a></div>";
*/
	
echo "</div>";		
}

function public_expired_html($opportunity_data, $public_hash) {
//==================================
//!  First break master arrays into trait arrays
//
//  Modify any data for presentation
//==================================

		//get job details
		$job_data						= $opportunity_data['job_data'];

		$jobID							= $job_data['general']['jobID'];
		$store_name					= $job_data['store']['name'];
		$store_type					= $job_data['store']['description'];

		$employer 					= $job_data['employer'];
		$title		 						= $job_data['general']['title'];
		$qualifications				= $$job_data['general']['qualifications'];
		$main_skill		 			= $job_data['skills']['main_skill']['specialty'];
		$date_created				= $job_data['general']['date_created'];
		
?>	
		<div class='job_details'>
		
			<div style="width:100%; float:left;">
				
				<div style="float:left; width:100%; margin-left:5px;">
					<div style='float:left; width:80px;'>
						<img src='images/expiredjob.png' style='vertical-align:middle' height='75px' width='75px' alt='expired job'>
					</div>
					<div style='float:left;width:500px; margin-top:15px;'>					
						<h4 style='display:inline'>We're sorry, the job posting for the <? echo $title?> position at <? echo $store_name ?> has expired.</h4>
					</div>
				</div>
				
				<div style="float:left; width:100%; margin-left:5px; margin-top:10px;">
					<div style='float:left; width:80px;'>
						<img src='images/morejobsavailable.png' style='vertical-align:middle' height='75px' width='75px' alt='more jobs'>
					</div>
					
					<div style='float:left;width:500px; margin-top:15px;'>							
						<h4>Good News! There are several <? echo $main_skill ?> jobs currently available on ServeBartendCook.com, and new jobs are added daily!</h4>
					</div>
				</div>
				
			</div>	
			
			<div style='float:left; width:90%; background-color:#e9e6de; margin-top:30px; margin-left:-50px; padding-left:15px; padding-right:15px; padding-top:15px; padding-bottom:15px;'>
				<h3><a href='http://servebartendcook.com'>Login</a> or <a href='http://servebartendcook.com'>Register</a> to find your new job today.</h3>
			</div>

			<div class="clear"></div>
	</section>
		
	</div>
		
	<!-- Start Footer -->
		<footer>
		&nbsp; <br />
		<p>Copyright &copy; 2017 SBC Industries, LLC</p>
	</footer>
	<!-- End Footer -->
	
	</div>

	<!-- End Wrapper -->
	
</body>

</html>
		
<?php		
}

function public_expired_html_mobile($opportunity_data, $public_hash) {
//==================================
//!  First break master arrays into trait arrays
//
//  Modify any data for presentation
//==================================

		//get job details
		$job_data						= $opportunity_data['job_data'];

		$jobID							= $job_data['general']['jobID'];
		$store_name					= $job_data['store']['name'];
		$store_type					= $job_data['store']['description'];

		$employer 					= $job_data['employer'];
		$title		 						= $job_data['general']['title'];
		$qualifications				= $$job_data['general']['qualifications'];
		$main_skill		 			= $job_data['skills']['main_skill']['specialty'];
		$date_created				= $job_data['general']['date_created'];
		
?>	
		<div class='job_details' style='min-height:650px;'>
		
			<div style="width:100%; float:left;">
				
				<div style="float:left; width:100%; margin-left:5px; margin-top:15px;">
					<div style='float:left; width:100%; text-align:center;'>
						<a href='http://servebartendcook.com'><img src='images/expiredjob.png' style='vertical-align:middle' height='75px' width='75px' alt='expired job'></a>
					</div>
					<div style='float:left; width:95%; margin-left:3px; margin-top:15px;'>							
						<h4 style='display:inline'>We're sorry, the job posting for the <? echo $title?> position at <? echo $store_name ?> has expired.</h4>
					</div>
				</div>
				
				<div style="float:left; width:100%; margin-left:5px; margin-top:35px;">
					<div style='float:left; width:100%; text-align:center;'>
						<a href='http://servebartendcook.com'><img src='images/morejobsavailable.png' style='vertical-align:middle' height='75px' width='75px' alt='more jobs'></a>
					</div>
					
					<div style='float:left; width:95%; margin-left:3px; margin-top:15px;'>							
						<h4>Good News! There are several <? echo $main_skill ?> jobs currently available on ServeBartendCook.com, and new jobs are added daily!</h4>
					</div>
				</div>
				
			</div>	
			
			<div style='float:left; width:100%; background-color:#e9e6de; margin-top:65px; padding-left:15px; padding-right:15px; padding-top:15px; padding-bottom:15px;'>
				<h3><a href='http://servebartendcook.com'>Login</a> or <a href='http://servebartendcook.com'>Register</a> to find your new job today.</h3>
			</div>

			<div style='text-align:center; width:100%; float:left; margin-top:15px;'>Copyright &copy; 2017 SBC Industries, LLC</div>";
	
</body>

</html>
		
<?php		
}

function public_page_warning($valid_page, $device, $site_type) {		
	
	if ($device == "full") {
		public_full_header_html($site_type);		
	} else {
		public_mobile_header_html($site_type);			
	}			
?>	
	<div style='width:100%; text-align:center; margin-top:5px; float:left;'>
		<h3>Job Listing Unavailable</h3>
		
		<table class="dark">
			<tr><td>This Job Listing has expired and is no longer available</td></tr>
		</table>
	</div>
<?php
	if ($device == "mobile") {
		echo "<div style='text-align:center; width:100%; float:left;'><a href='index.php'><div class='btn btn-large btn-warning' style='float:left; width:95%; text-align:center; margin-left:1px; margin-top:30px; margin-bottom:10px; color:white;'>Home</div></a></div>";	
	}
?>
</div>					
<?php
}
