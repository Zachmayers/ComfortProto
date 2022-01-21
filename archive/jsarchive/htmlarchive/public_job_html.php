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
		$date_created				= $job_data['general']['date_created'];
		$expiration_date			= $job_data['general']['expiration_date'];
		$schedule						= $job_data['general']['schedule'];
		$address						= $job_data['store']['address'];
		$zip								= $job_data['store']['zip'];
		$comp_type					= $job_data['general']['comp_type'];
		$comp_value					= $job_data['general']['comp_value'];
		$comp_value_high			= $job_data['general']['comp_value_high'];
		$comp_value_low			= $job_data['general']['comp_value_low'];				

		$sub_skills						= $job_data['skills']['sub_skills'];
		$requirements		 		= $job_data['requirements'];

		switch($main_skill) {
			case "Bartender":
				$og_title = "Bartender Position Available";
				$og_description = $title." @ ".$store_name;		
				$meta_title = "Hiring Bartender Position - ".$store_name;		
				$og_image = "HiringBartenders2.png";		
			break;
			
			case "Manager":
				$og_title = "Management Position Available";
				$og_description = $title." @ ".$store_name;				
				$meta_title = "Hiring Management Position - ".$store_name;				
				$og_image = "HiringMgmt.png";		
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
				$og_image = "HiringCooks1.png";						
			break;
			
			case "Server":
				$og_title = "Server Position Available";
				$og_description = $title." @ ".$store_name;				
				$meta_title = "Hiring Server Position - ".$store_name;		
				$og_image = "HiringServers4.png";											
			break;
									
			case "Bus":
				$og_title = "Bus Position Available";
				$og_description = $title." @ ".$store_name;				
				$meta_title = "Hiring Bus Position - ".$store_name;	
				$og_image = "HiringFOH.png";												
			break;

			case "Host":
				$og_title = "Host Position Available";
				$og_description = $title." @ ".$store_name;				
				$meta_title = "Hiring Host Position - ".$store_name;
				$og_image = "HiringFOH.png";													
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
		
		if ($description == "") {
			$snippet_description = $store_name." is hiring a ".$snippet_title." in ".$city_state['city'].", ".$city_state['state'].".";			
		} else {
			$snippet_description = $description;				
		}
				
		if ($comp_type == "Hourly") {
			$snippet_pay_type = "HOUR";
			$pay_range = "N";
			
			if($comp_value > 0 && $comp_value_high == "" && $comp_value_low == "") {
				$snippet_pay_amount = $comp_value;
			} else if ($comp_value_high == $comp_value_low) {
				$snippet_pay_amount = $comp_value_high;
			} else {
				$pay_range = "Y";
				$snippet_pay_high = $comp_value_high;
				$snippet_pay_low = $comp_value_low;
			}

		} elseif ($comp_type == "Salary") {
			$snippet_pay_type = "SALARY";
			$pay_range = "N";
			
			if($comp_value > 0 && $comp_value_high == "" && $comp_value_low == "") {
				$snippet_pay_amount = $comp_value;
			} else if ($comp_value_high == $comp_value_low) {
				$snippet_pay_amount = $comp_value_high;
			} else {
				$pay_range = "Y";
				$snippet_pay_high = $comp_value_high;
				$snippet_pay_low = $comp_value_low;
			}

		} else {
			$snippet_pay_type = "NA";
			$snippet_pay_amount = "NA";	
			$pay_range = "N";
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
		
		$snippet_skills = "";
		$skill_counter = 1;
		if (count($sub_skills) > 0) {
			foreach($sub_skills as $row) {
				$snippet_skills .= $row['sub_specialty'];
				if ($skill_counter < count($sub_skills)){
					$snippet_skills .= ", ";
				}
				$skill_counter++;
			}
		}

		$snippet_requirements = "";
		$req_counter = 1;
		if (count($requirements) > 0) {
			foreach($requirements as $row) {
			$snippet_requirements .= $row['requirement']." ";
				$req_counter++;
			}
		}
		
		return $og_array = array("title" => $og_title,
												"description" => $meta_description, 
												"meta_title" => $meta_title, 
												"meta_description" => $meta_description,
												"snippet_title" => $snippet_title,
												"snippet_description" => $snippet_description,
												"snippet_pay_type" => $snippet_pay_type,
												"snippet_pay_range" => $pay_range,
												"snippet_pay_amount" => $snippet_pay_amount,
												"snippet_pay_high" => $snippet_pay_high,
												"snippet_pay_low" => $snippet_pay_low,
												"snippet_schedule" => $snippet_schedule,
												"store_name" => $store_name,
												"date_created" => $date_created,
												"store_zip" => $zip,
												"store_address" => $address,
												"store_city" => $city_state['city'],
												"store_state" => $city_state['state'],
												"snippet_skills" => $snippet_skills,
												"snippet_requirements" => $snippet_requirements,
												"expiration_date" => $expiration_date,
												"og_image" => $og_image);
}
	
function public_full_header_html($site_type, $og_title, $og_description, $meta_title, $meta_description, $google_analytics, $fb_remarket, $snippet_details, $valid_page, $og_array) {
	//header and sidebar for full site
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title><? echo $meta_title ?></title>
	<meta name="description" content="<? echo $meta_description ?>">
	
<!--
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
-->
<?php
	if ($site_type != "live" || $valid_page == "expired") {
?>
		<meta name='robots' content='noindex' />
<?php
	}
?>
<!-- 	Meta tags for Facebook OpenGraph -->

	<meta property="og:title" content="<? echo $og_title ?>" />
	<meta property="og:description" content="<? echo $og_description ?>" />	
	<meta property="og:image" content="https://servebartendcook.com/og_images/<? echo $og_array['og_image'] ?>" />
<!--  	<meta property="og:url" content="<? echo $og_url ?>" /> -->

<!-- 	Meta tags for Twitter Card/Share -->

	<meta property="twitter:account_id" content="1125423043" />
	<meta name="twitter:card" content="summary">
	<meta property="twitter:site" content="@servebarcook" />	
	<meta name="twitter:title" content="<? echo $og_title ?>">
	<meta name="twitter:description" content="<? echo $og_description ?>"> 
	<meta property="twitter:image" content="https://servebartendcook.com/og_images/<? echo $og_array['og_image'] ?>" />
	
	<!-- Stylesheets -->
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300i,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Julius+Sans+One" rel="stylesheet">
    <!-- Bootstrap CSS File -->
    <link href="css/bootstrap.min.css?v=2" rel="stylesheet">
  
    <!-- Libraries CSS Files -->
    <link href="fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- Main Stylesheet File -->
    <link href="css/style.css?v=2" rel="stylesheet">
    
	<!-- CustomStylesheet File -->
  	<link href="css/custom.css?v=2t" rel="stylesheet">


	<script type="text/javascript" src="js/ajax.js?v=5"></script>	
    <!-- Required JavaScript Libraries -->
    <script src="js/jquery.min.js"></script>
<!--     <script src="js/bootstrap.min.js"></script> -->
    
    <!-- Custom Javascript File -->
    <script src="js/custom.js"></script>

	<script type="text/javascript" src="js/general.js?v=5"></script>	
	<script type="text/javascript" src="js/public.js?v=1e"></script>	
		
	<!-- Favicons -->
	<link rel="shortcut icon" href="images/favicon.png" />
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
<!--	
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
-->
	
<link type="text/css" href="css/custom-theme/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" />
<!--
<link href='//fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald:300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Lato:400' rel='stylesheet' type='text/css'>
-->
<script type="text/javascript" src="js/jquery-ui-1.8.23.custom.min.js"></script> 

 <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script> 
<!--  <script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>  -->

 <script type="text/javascript" src="js/jquery_form.js"></script>
<script type='text/javascript' src="js/dist/clipboard.min.js"></script>

<?php
	if ($site_type == "live") {
?>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-38015816-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			
			gtag('config', 'UA-38015816-1');
			gtag('config', 'AW-1025707558');  
		</script>
 
  <script>
  gtag('event', 'page_view', {
    'send_to': 'AW-1025707558',
    'job_id': '<? echo $_GET['ID'] ?>'
  });
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
   
   "industry": "Restaurant, Food Service, Hospitality",   
   "url":"https://servebartendcook.com/public_listing_new.php?ID=<? echo $_GET['ID'] ?>&ref=<? echo $_GET['ref'] ?>",

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
  },
<?php if ($snippet_details['snippet_pay_type'] != "NA") { ?>

	  "baseSalary": {
	    "@type": "MonetaryAmount",
	    "currency": "USD",
	    "value": {
	      "@type": "QuantitativeValue",
<?php if ($snippet_details['snippet_pay_range'] != "Y") { ?>
	      "minValue": <? echo $snippet_details['snippet_pay_high'] ?>,
	      "minValue": <? echo $snippet_details['snippet_pay_low'] ?>,
	      "unitText": "<? echo $snippet_details['snippet_pay_type'] ?>"

 <?php } else { ?>
 
	      "value": <? echo $snippet_details['snippet_pay_amount'] ?>,
	      "unitText": "<? echo $snippet_details['snippet_pay_type'] ?>"
 <?php } ?>
	  	    }
	  },
    
 <?php } ?>
 
    "skills": "<? echo $snippet_details['snippet_skills'] ?>",
    "responsibilities": "<? echo $snippet_details['snippet_requirements'] ?>",
    "validThrough": "<? echo $og_array['expiration_date'] ?>"
}
</script>
	
</head>

 <body class="page-index has-hero">
    <div id="background-wrapper" class="block block-pd-sm block-bg-grey-dark block-bg-overlay block-bg-overlay-6" data-block-bg-img="images/main-desktop-bg-bartender.jpg">

        <!-- ======== @Region: #navigation ======== -->
        <div id="navigation" class="wrapper">

            <!--Header & navbar-branding region-->
            <div class="header">
                <div class="header-inner container">
                    <div class="row">
                        <div class="col-md-12 col-xs-9 text-center " style="margin-top:-5px;">
                            <!--navbar-branding/logo - hidden image tag & site name so things like Facebook to pick up, actual logo set via CSS for flexibility -->
<!--
                            <img src="images/logo-final.png" alt="ServeBartendCook Logo" style="margin:0 auto;">
                            <h1 class="hidden">ServeBartendCook</h1>
-->
				            <img src="images/new-SBC-logo.png" style="max-width: 575px; display: inline; width:100%;">
                        </div>
                        <div class="col-xs-3 hidden-sm hidden-md hidden-lg">
                            <div class="navbar navbar-default">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="navbar navbar-default ">
                    <!--mobile collapse menu button-->

                    <!--social media icons-->
                    <div class="navbar-text social-media social-media-inline pull-right hidden-xs">
                        <a href="https://www.facebook.com/ServeBartendCook/"><i class="fa fa-facebook"></i></a>
                        <a href="https://www.instagram.com/servebartendcook/"><i class="fa fa-instagram"></i></a>
                        <a href="https://www.twitter.com/servebarcook/"><i class="fa fa-twitter"></i></a>
                    </div>
                    <!--everything within this div is collapsed on mobile-->
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav" id="main-menu">
                            <li class="icon-link">
                                <a href="index.php"><i class="fa fa-home"></i></a>
                            </li>
                            <li>
                            	<a href="jobs.php">More Jobs</a>
                            </li>
                            <li>
                            	<a href="index.php?page=employer_signup">Post a Job</a>
                            </li>
                            <li>
                            	<a href="index.php?page=login">Login</a>
                            </li>
                        </ul>
                    </div>
                    <!--/.navbar-collapse -->
                </div>
            </div>
        </div>
    </div>
<?php	
}	
	
function public_opportunity_html($opportunity_data, $group_jobs, $public_hash) {
$utilities = new Utilities;
//==================================
//!  First break master arrays into trait arrays
//
//  Modify any data for presentation
//==================================
		$job_data						= $opportunity_data['job_data'];

		$post_type					= $job_data['general']['post_type'];
		$bounty						= $job_data['general']['bounty'];
		$hash							= $job_data['general']['public_hash'];

		$jobID							= $job_data['general']['jobID'];
		$store_name					= $job_data['store']['name'];
		$address						= $job_data['store']['address'];
		$zip								= $job_data['store']['zip'];
		$website						= $job_data['store']['website'];
		$facebook						= $job_data['store']['facebook'];
		$twitter							= $job_data['store']['twitter'];
		$store_type					= $job_data['store']['description'];
		$image							= $job_data['store']['image'];
		$template						= $job_data['general']['template'];

		$employer 					= $job_data['employer'];
		$title		 						= $job_data['general']['title'];
		$requirements		 		= $job_data['requirements'];
		$notes							= $job_data['general']['description'];
		$qualifications				= $job_data['general']['qualifications'];
		$main_skill		 			= $job_data['skills']['main_skill']['specialty'];
		$specialtyID			 		= $job_data['skills']['main_skill']['ID'];
		$benefits						= $job_data['general']['benefits'];
		$benefits_desc				= $job_data['general']['benefits_desc'];
		$walkin							= $job_data['general']['walkin'];
		$walkin_desc					= $job_data['general']['walkin_desc'];
		$schedule						= $job_data['general']['schedule'];
		$comp_type					= $job_data['general']['comp_type'];
		$comp_value					= $job_data['general']['comp_value'];
		$comp_value_high			= $job_data['general']['comp_value_high'];
		$comp_value_low			= $job_data['general']['comp_value_low'];		
		$question_array				= $job_data['question_list']['questions'];
		$sub_skills						= $job_data['skills']['sub_skills'];
		$employment					= $job_data['general']['past_employment'];
		$date_created				= $job_data['general']['date_created'];
		
		if ($employee_data != "employer") {
			$response_data 				= $opportunity_data['response_data'];
			$employee_info		 			= $employee_data['general'];
			$past_employment		 	= $employee_data['employment'];
			$employment_version		= $employee_data['employment_version'];
			$personal_message			= $employee_data['personal_message']['message'];
			$saved_answer_array			= $employee_data['saved_answers'];
			$profile_status					= $employee_data['general']['profile_status'];
		} else {
			$response_data 				= array();
			$employee_info		 			= "";
			$past_employment		 	= "";
		}

		$notes = $utilities->clickable_links($notes);

		$city_state = $utilities->get_city_state($zip);
		
		//string for google map
		$google_name = str_replace(" ", "+", $store_name);
		$google_city = str_replace(" ", "+", $city_state['city']);
//		$google_address = $google_name."+".$google_city."+".$city_state['state']."+".$zip;
		$google_address = $address."+".$google_city."+".$city_state['state']."+".$zip;
							
		switch($comp_type) {
			default:
				$compensation = $comp_type;
			break;
			
			case "Hourly":
				if($comp_value > 0 && $comp_value_high == "" && $comp_value_low == "") {
					if ($comp_value_high == 0 && $comp_value_low == 0) {
						$compensation = "$".$comp_value."/hr";
					}
				} else if ($comp_value_high == $comp_value_low) {
					$compensation = "$".$comp_value_high."/hr";
				} else {
					$compensation = "$".$comp_value_low."/hr - $".$comp_value_high."/hr";
				}
			break;
			
			case "Salary":
				if($comp_value > 0 && $comp_value_high == "" && $comp_value_low == "") {
					if ($comp_value_high == 0 && $comp_value_low == 0) {
						$compensation = "$".$comp_value."/Yr";
					}
				} else if ($comp_value_high == $comp_value_low) {
					$compensation = "$".$comp_value_high."/Yr";
				} else {
					$compensation = "$".$comp_value_low."/Yr - $".$comp_value_high."/Yr";
				}
			break;				
		}		
		

		if ($benefits == "Y") {
			$benefits_text =	$benefits_desc;
		} else {
			$benefits_text = 	"None";				
		}
		
		if ($walkin == "Y") {
			$walkin_text =	"".$walkin_desc." - <i>Please mention ServeBartendCook</i>";
		} else {
			$walkin_text = 	"Not Preferred";				
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
		
		
		$lower_button = "N";
		
		if ($image == "") {
			$image = "<h4 style='margin-top:20px; margin-bottom:25px;'>No Company<br/>Logo</h4>";
		} else {
			$image = "<img src='images/store_pics/".$image."?".time()."' class='center-block profilephoto' style='max-height:150px;max-width:150px;height:auto;width:auto'>";
		}
?>		

    <!-- ======== @Region: #content ======== -->
    <div id="content" style="min-height: 70%">

    <!-- Profile block -->
    	<div class="block-contained" >
            <div class="col-md-4 job_details_large">
                <div class="text-center">
				     <h2 class="block-title titlename"><? echo $title ?> </h2>
					    <ul class="oppnotes">
                            <li><? echo $store_type ?></li>
							<li><i class="fa fa-map-marker" aria-hidden="true"></i> <? echo $address." ".$city_state['city']." ".$city_state['state'].", ".$zip ?></li>
                        </ul>
                    <div class="row panel-opportunity-photo">
						<div class="col-md-12 col-xs-6">
							<? echo $image ?>
						</div>
						<div class="col-md-12 col-xs-6 ">
							<div class="opportunitymap embed-container ">
								<iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDb95KTBjE8mIPl_bvDMxs1vvLkyLhAiXs	&q=<? echo $google_address ?>" width="300" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
		                    </div>
						</div>
                    </div>
                </div>

                <div class="row endorsements hidden-xs">
					<div class="col-md-12">
                 		<h4>Recent Posts from <? echo $store_name ?></h4>
<?php
						if (count($group_jobs) > 0) {	
							$count = 0;
							
							foreach($group_jobs as $row) {
								if ($row['job_status'] == "Open" && $row['jobID'] != $_GET['ID']) {
									$count++;
?>                 		
							 	    <div class="row other_job">
										<div class="col-md-12"><a href="/public_listing_new.php?ID=<? echo $row['jobID'] ?>&ref=<? echo $row['public_hash'] ?>"><h5><i class="fa fa-circle-thin" aria-hidden="true"></i> <? echo $row['title'] ?></h5></a></div>
			                    	</div>
<?php
								}
							}
							
							if ($count == 0) {
								echo "<h5> - No other current jobs</h5>";								
							}
						} else {
							echo "<h5> - No other current jobs</h5>";								
						}
?>
						<br /> &nbsp; <br /><iframe src="//rcm-na.amazon-adsystem.com/e/cm?o=1&p=12&l=ez&f=ifr&linkID=7c06e2254f0c7477d3027a24f487d4d1&t=thirmaga-20&tracking_id=servebartendcook-20" width="300" height="250" scrolling="no" border="0" marginwidth="0" style="border:none;" frameborder="0"></iframe>

					</div>
                </div>
            </div>

            <div class="col-md-8 job_details">
				<div  class="row">
					<div class="col-md-12">
						<h2 class="block-title positiontitle"><? echo $store_name ?></h2>
					</div>
				</div>
            </div>

            <div class="col-md-8 job_details">
                <div class="row pastwrap">
                    <div class="col-md-12">
						<div class="row">
                            <div class="col-md-6">
<!-- 	                            <a href="index.php?page=employee_signup&ID=<? echo $jobID ?>&ref=<? echo $public_hash ?>" class="btn btn-more  btn-lg i-right" style="background-color: #ff5821; color: #fff;" >APPLY NOW <i class="fa fa-angle-right"></i></a><br /> -->
	                            <a href="#" class="btn btn-more  btn-lg i-right" id='apply' style="background-color: #ff5821; color: #fff;" >APPLY NOW <i class="fa fa-angle-right"></i></a><br />
	                        	<div id="copy_link" style="margin-top: 15px">
		                        	<a href='#' class="btn copy_btn" id="<? echo $jobID ?>"  data-clipboard-text="https://servebartendcook.com/public_listing_new.php?ID=<? echo $jobID ?>&ref=<? echo $public_hash ?>&utm_source=site&utm_medium=public&utm_campaign=share"><i class="fa fa-share-alt-square" aria-hidden="true"></i> Share Job</a>
	                        	</div>
	                        	<div id="copy_notice" style="color:red; margin-top: 15px; display:none">
		                        	<i>Job link copied to clipboard, paste and share anywhere!</i>
	                        	</div>	                        	
	                        
	                        </div>
                            <div class="col-md-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">Date Posted:</div>
                            <div class="col-xs-6"><? echo date('M j, Y', strtotime($date_created)) ?></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">Schedule:</div>
                            <div class="col-xs-6"><? echo $schedule ?></div>
                        </div>
						<div class="row">
                            <div class="col-xs-6">Compensation:</div>
                            <div class="col-xs-6"><? echo $compensation ?></div>
                        </div>
						<div class="row">
                            <div class="col-xs-6">Benefits:</div>
                            <div class="col-xs-6"><? echo $benefits_text ?></div>
                        </div>
<?php
						if ($walkin == "Y") {
?>
							<div class="row">
	                            <div class="col-xs-6">Walk-ins Allowed:</div>
	                            <div class="col-xs-6"><? echo $walkin_text ?></div>
	                        </div>
<?php							
						}
?>                        
                    </div>
                </div>

<?php
		if ($template != "custom_b") {
?>
                <div class="row profileskills">
                    <div class="col-md-12">
                        <h4>Preferred Job Skills - <? echo $main_skill ?></h4>
                        <div class="row">
<?php
							if (count($sub_skills) == 0) { 
?>
  	                        	<div class="col-md-6 jobskills"><i>No specific skills required for this positions</i></div>
<?php								
							} else {
								foreach($sub_skills as $row) {
?>
									<div class="col-md-6 jobskills"><i class="fa fa-star-o" aria-hidden="true"></i> <? echo $row['sub_specialty'] ?></div>
<?php									
								}							
							}
?>
                        </div>
                    </div>
                </div>

                <div class="row addrequire">
					<div class="col-md-12">   
						<h4>Additional Requirements</h4>				
                   		<ul class="fa-ul">
<?php
							if (count($requirements) == 0) {
?>
		                        <li><i> No additional requirements</i></li>
<?php								
							} else {
								foreach($requirements as $row) {
?>
			                        <li><i class="fa-li fa fa-check-circle-o"></i> <? echo $row ['requirement'] ?></li>
<?php									
								}																
							}
?>
						</ul>
					</div>
                </div>
 <?php
		}
?>
               
<?php
				if ($notes != "") {
?>                
                <div class="row extrainfo">
                    <div class="col-md-12">
	                        <h4>Other Details</h4> <? echo nl2br($notes) ?>
                    </div>
                </div>
<?php							
				} 
?>
                
                <div class="row addrequire">
                    <div class="col-md-12">
	                    <h4>Pre-Interview Questions</h4>
                   		<ul class="fa-ul">
<?php
							if (count($question_array) == 0) {
?>
		                        <li><i> No pre-interview questions required</i></li>
<?php								
							} else {
								foreach($question_array as $row) {
?>
			                        <li><i class="fa-li fa fa-question-circle-o"></i> <? echo $row ['question'] ?></li>
<?php									
								}																
							}
?>
						</ul>
                    </div>
					<div class="col-md-12 text-center hidden-md hidden-lg" style="margin-top: 15px">
						<hr>
						<a href="index.php?page=employee_signup&ID=<? echo $jobID ?>&ref=<? echo $public_hash ?>" class="btn btn-primary">Apply Now</a> &nbsp; <a href='jobs.php' class="btn btn-primary">More Jobs</a><br />
						&nbsp; <br />
						<a href="index.php?page=employer_signup">Post a Job</a>
						<hr>
					</div>
					
					<div class="col-md-12 text-center hidden-md hidden-lg" style="margin-top: 15px">
<!-- 						<div id="amzn-assoc-ad-d07f4080-6ea0-41d4-92f2-1fd68d26c704"></div><script async src="//z-na.amazon-adsystem.com/widgets/onejs?MarketPlace=US&adInstanceId=d07f4080-6ea0-41d4-92f2-1fd68d26c704"></script> -->
							<iframe src="//rcm-na.amazon-adsystem.com/e/cm?o=1&p=42&l=ur1&category=amazonhomepage&f=ifr&linkID=09a308de1aef08bfe83135ade91b031c&t=servebartendcook-20&tracking_id=servebartendcook-20" width="274" height="60" scrolling="no" border="0" marginwidth="0" style="border:none;" frameborder="0"></iframe>
					</div>
					          
                </div>
            </div>
   <!--     Hidden Application               -->
			      	<div class="row apply_details" style="display: none; margin-top: -30px">
				      	<h2 style="text-align:center"><? echo $title ?></h2>
				      	<h5 style="text-align:center"><? echo $store_name ?></h5> &nbsp; <br />
				      	<h3 style="text-align:center">Apply Now</h4><br />
			            <div class="col-md-12">
							<div class="row">
			                    <div class="col-md-12 text-center" >
										<b>Already on ServeBartendCook?</b><br />
				                        <a href="index.php?page=login&ID=<? echo $jobID ?>&ref=<? echo $public_hash ?>" class="btn btn-more  btn-lg i-right" style="background-color: #ff5821; color: #fff;" >Login & Apply <i class="fa fa-angle-right"></i></a><br /> &nbsp; <br />
			            
			            
										<b>Apply with Resume</b><br />
				                        <a href="#" class="btn btn-more  btn-lg i-right" id="resume" style="background-color: #ff5821; color: #fff;" >Upload Resume & Apply <i class="fa fa-angle-right"></i></a><br /> &nbsp; <br />
			            
										<b>No Resume? No Problem!</b> <br />
				                        <a href="index.php?page=employee_signup&ID=<? echo $jobID ?>&ref=<? echo $public_hash ?>" class="btn btn-more  btn-lg i-right" style="background-color: #ff5821; color: #fff;" >Build Your Resume <i class="fa fa-angle-right"></i></a><br /> &nbsp; <br />
				                        
										<a href='#' id='cancel_apply'>Cancel</a>
				                        
			                    </div>
							</div>
			            </div>
			    	</div>

			    	<div class="row upload_resume" style="display: none">
			            <div class="col-md-12">
							<h4 style="text-align:center">Upload Resume & Apply</h4>
							<? echo "<h5 style='text-align:center'>".$title."</h5>" ?>
							<div class=' input name_input'>
									<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1' id='name_empty_warning' style="color:red; display:none"><b>Name cannot be empty</b></div>
									<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1' id='phone_empty_warning' style="color:red; display:none"><b>Phone cannot be empty</b></div>
									<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1' id='file_empty_warning' style="color:red; display:none"><b>Please select your resume file</b></div>
									<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1' id='email_empty_warning' style="color:red; display:none"><b>Email cannot be empty</b></div>
									<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1' id='file_size_warning' style="color:red; display:none"><b>Please choose a file less than 5MB</b></div>
									<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1' id='file_type_warning' style="color:red; display:none"><b>Resume must be a PDF file</b></div>

									<div>
										<div class="form-group name_form">
									   		<label for="edit_first_name" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">First Name</label>
									   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
												<input type='text' class='edit_first_name form-control' placeholder='First Name'><br />
											</div>
											<label for="edit_last_name" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Last Name</label>
											<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
												<input type='text' class='edit_last_name form-control' placeholder='Last Name'><br />
											</div>
											<label for="edit_email" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Email</label>
											<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
												<input type='text' class='edit_email form-control' placeholder='Email'><br />
											</div>
											<label for="edit_phone" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Phone</label>
											<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
												<input type='text' class='edit_phone form-control' placeholder='Phone Number'><br />
											</div>
											<label for="edit_experience" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Yrs of Experience</label>
											<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
												<input type='text' class='edit_experience form-control' placeholder='Years of Experience'><br />
											</div>
											<input type='hidden' id='question_count' value='<? echo count($question_array) ?>'>
											<input type='hidden' id='jobID' value='<? echo $_GET['jobID'] ?>'>

										<div class="form-group" style='margin-top:15px;'>
											<div id='empty_warning' style="display:none; color:red"><b>You must answer all questions below.</b></div>
<?php
						$count = 1;
						foreach ($question_array as $question) {
?>			
										<input type='hidden' id='questionID_<? echo $count ?>' value='<? echo $question['questionID'] ?>'>					
										<label for="answer_<? echo $count ?>"><? echo $question['question'] ?></label>
										<div id='charNum_<? echo $count ?>' style="color:black; margin-bottom:2px; padding-left:15px;"></div>						
										<textarea id='answer_<? echo $count ?>'  class="form-control" rows='3' maxlength='250'><? echo $employee_answer ?></textarea>
<?php
						$count++;
						if ($count != count($question)) {
							echo "<br />";
						}
		}
?>
										</div>
													
										<div class="col-md-9 col-md-offset-2 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
											<form id="myform" action="upload_resume.php" method="post" enctype="multipart/form-data" >
											<label class="btn btn-default">
												Browse <input type="file" id="resume_file" name="resume_file" hidden>
												<input type="submit" value="Save Profile Pic1" id="resume_upload_button" hidden>

											</label>
											</form>

										</div>
									</div><br /> &nbsp; <br />
											
										<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1" style="margin-top: 25px; margin-bottom: 25px;">
											<button type="button" class="btn btn-success" id="save_resume">
												<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Upload Resume
											</button>
						
											<button type="button" class="btn btn-link" id="cancel_apply_2" style="color:#8e080b;">
												Cancel
											</button><br />
											
											<b>By clicking "Upload Resume", you agree to the:<br /><a href="index.php?page=TOS">TERMS OF SERVICE</a> | <a href="index.php?page=privacy_policy">PRIVACY POLICY</a></b>
							
											
										</div>							
                    			</div>
						</div>
			    	</div>
			   </div>
</div>

    </div>
	<!-- /container -->
	
	<footer style='background-color: #8e080b'>	
		<div style='background-color: #8e080b; color:white; min-height:75px; text-align:center; padding-top:5px;'>		
			<p>Copyright &copy; 2019 SBC Industries, LLC<br /> <a href="http://servebartendcook.com/index.php?page=privacy_policy">Privacy Policy</a>  | <a href="http://servebartendcook.com/index.php?page=TOS">Terms of Use</a></p><br />		
			<p>info@servebartendcook.com</p>
		</div>			
	</footer>
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>	
    <script src="js/bootstrap.min.js"></script>
</body>

</html>

<?php
 }
 
 function public_resume_upload_html($opportunity_data, $public_hash) {
$utilities = new Utilities;
//==================================
//!  First break master arrays into trait arrays
//
//  Modify any data for presentation
//==================================
		$job_data						= $opportunity_data['job_data'];

		$hash							= $job_data['general']['public_hash'];

		$jobID							= $job_data['general']['jobID'];
		$store_name					= $job_data['store']['name'];
		$address						= $job_data['store']['address'];
		$zip								= $job_data['store']['zip'];
		$website						= $job_data['store']['website'];
		$facebook						= $job_data['store']['facebook'];
		$twitter							= $job_data['store']['twitter'];
		$store_type					= $job_data['store']['description'];
		$image							= $job_data['store']['image'];

		$employer 					= $job_data['employer'];
		$title		 						= $job_data['general']['title'];
		$main_skill		 			= $job_data['skills']['main_skill']['specialty'];
		$specialtyID			 		= $job_data['skills']['main_skill']['ID'];
		$date_created				= $job_data['general']['date_created'];
		
		
		$city_state = $utilities->get_city_state($zip);
		
		//string for google map
		$google_name = str_replace(" ", "+", $store_name);
		$google_city = str_replace(" ", "+", $city_state['city']);
//		$google_address = $google_name."+".$google_city."+".$city_state['state']."+".$zip;
		$google_address = $address."+".$google_city."+".$city_state['state']."+".$zip;
							
		
		
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
				
		if ($image == "") {
			$image = "<h4 style='margin-top:20px; margin-bottom:25px;'>No Company<br/>Logo</h4>";
		} else {
			$image = "<img src='images/store_pics/".$image."?".time()."' class='center-block profilephoto' style='max-height:150px;max-width:150px;height:auto;width:auto'>";
		}
?>

    	<div class="block-contained" >
            <div class="col-md-4 job_details_large">
                <div class="text-center">
				     <h2 class="block-title titlename"><? echo $title ?> </h2>
					    <ul class="oppnotes">
                            <li><? echo $store_type ?></li>
							<li><i class="fa fa-map-marker" aria-hidden="true"></i> <? echo $address." ".$city_state['city']." ".$city_state['state'].", ".$zip ?></li>
                        </ul>
                    <div class="row panel-opportunity-photo">
						<div class="col-md-12 col-xs-6">
							<? echo $image ?>
						</div>
						<div class="col-md-12 col-xs-6 ">
							<div class="opportunitymap embed-container ">
								<iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDb95KTBjE8mIPl_bvDMxs1vvLkyLhAiXs	&q=<? echo $google_address ?>" width="300" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
		                    </div>
						</div>
                    </div>
                </div>
<!--              UPLOAD -->
            </div>
    	</div> 
<?php	
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
		<div class='container'>
		
			<div class="row">
				<div class="col-md-12" style="margin-top: 20px;">
					<img src='images/expiredjob.png' class="center-block" height='75px' width='75px' alt='expired job'>
				</div>
				
				<div class="col-md-12 text-center" style="margin-top: 20px;">					
					<h4 style='display:inline'>We're sorry, the job posting for the <? echo $title?> position at <? echo $store_name ?> has expired.</h4>
				</div>
			</div>
				
			<div class="row">
				<div class="col-md-12 text-center" style="margin-top: 30px;">
					<img src='images/morejobsavailable.png' class="center-block" height='75px' width='75px' alt='more jobs'>
				</div>
				
				<div class="col-md-12 text-center" style="margin-top: 20px;">
					<h4>Good News! There are several <? echo $main_skill ?> jobs currently available on ServeBartendCook.com, and new jobs are added daily!</h4>
				</div>
			</div>
			
			<div class="row text-center" style='background-color:#e9e6de; margin-top:30px; padding-left:15px; padding-right:15px; padding-top:10px; padding-bottom:15px;'>
				<h3><a href='http://servebartendcook.com?page=login'>Login</a> or <a href='http://servebartendcook.com'>Register</a> to find your new job today.</h3>
			</div>

			<div class="clear"></div>
		</div>	
	</div>
	<div class="row"> &nbsp; </div>
	<div class="row"> &nbsp; </div>
	<div class="row"> &nbsp; </div>

    </div>
    
	<!-- /container -->
	
	<footer style='background-color: #8e080b'>	
		<div style='background-color: #8e080b; color:white; min-height:75px; text-align:center; padding-top:5px;'>		
			<p>Copyright &copy; 2018 SBC Industries, LLC<br /> <a href="http://servebartendcook.com/index.php?page=privacy_policy">Privacy Policy</a>  | <a href="http://servebartendcook.com/index.php?page=TOS">Terms of Use</a></p><br />		
			<p>info@servebartendcook.com</p>
		</div>			
	</footer>
</body>

</html>
<?php		
}


function public_page_warning($valid_page, $device, $site_type) {		
	
	public_full_header_html($site_type, '', '', '', '', '', '', '', $valid_page, '');	
		
?>	
	<div class="row" style="margin-top: 25px;">
		<h3 style="text-align: center">Job Listing Unavailable</h3>
	</div>	
	
	<div class="row text-center" style="margin-top: 20px">
		<h5>This Job Listing has expired and is no longer available</h5>
	</div>	
	
	<div class="row text-center" style="margin-top: 20px">
		<a href="/jobs.php"><h3>View More Jobs</h3></a>
		<br /> &nbsp; <br />
		<a href="/index.php"><h5>LOGIN</h5></a>
	</div>	
</div>					
<?php
}