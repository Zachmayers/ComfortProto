<?php
function public_candidate_full_header_html($profile_data) {
	
	$skill_array 					= $profile_data['employee_data']['skills']['skills'];
	$sub_skill						= $profile_data['employee_data']['skills']['sub_skills']; 
	$employment_array		= $profile_data['employee_data']['employment'];
	$employment_version	= $profile_data['employee_data']['employment_version'];
	$education_array 			= $profile_data['employee_data']['education'];
	$language_array 			= $profile_data['employee_data']['language'];
	$kitchen_photo_array 	= $profile_data['employee_data']['kitchen_photos'];
	$bar_photo_array			= $profile_data['employee_data']['bar_photos'];
	$traits							= $profile_data['employee_data']['traits'];
	$awards						= $profile_data['employee_data']['awards'];
	$certifications				= $profile_data['employee_data']['certifications'];
	$quote							= $profile_data['general_data']['quote'];
	$description					= $profile_data['general_data']['description'];
	$firstname						= $profile_data['general_data']['firstname'];
	$lastname						= $profile_data['general_data']['lastname'];
	
	$last_initial = substr($lastname, 0,1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title><? echo $firstname." ".$last_initial ?></title>
	<meta name="description" content="ServeBartendCook profile">
	
	<meta name='robots' content='noindex' />
	
<!-- 	Meta tags for Facebook OpenGraph -->

<!--
	<meta property="og:title" content="<? echo $og_title ?>" />
	<meta property="og:description" content="<? echo $og_description ?>" />	
	<meta property="og:image" content="https://servebartendcook.com/og_images/<? echo $og_array['og_image'] ?>" />
-->
<!--  	<meta property="og:url" content="<? echo $og_url ?>" /> -->

<!-- 	Meta tags for Twitter Card/Share -->

<!--
	<meta property="twitter:account_id" content="1125423043" />
	<meta name="twitter:card" content="summary">
	<meta property="twitter:site" content="@servebarcook" />	
	<meta name="twitter:title" content="<? echo $og_title ?>">
	<meta name="twitter:description" content="<? echo $og_description ?>"> 
	<meta property="twitter:image" content="https://servebartendcook.com/og_images/<? echo $og_array['og_image'] ?>" />
-->
	
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
	<script type="text/javascript" src="js/profile.js?v=1b"></script>	
		
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

<!--
 <script type="text/javascript" src="js/jquery_form.js"></script>
<script type='text/javascript' src="js/dist/clipboard.min.js"></script>
-->

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
<!--                             <img src="images/logo-final.png" alt="ServeBartendCook Logo" style="margin:0 auto;"> -->
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
                            	<a href="index.php?page=employer_signup">Post a Job</a>
                            </li>
                            <li>
                            	<a href="jobs.php">View Jobs</a>
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
	
function public_candidate_html($profile_data, $total_experience, $employee_store_type, $employee_position_experience, $employee_skills_experience, $old_employee_skills) {
$utilities = new Utilities;
	$skill_array 					= $profile_data['employee_data']['skills']['skills'];
	$sub_skill						= $profile_data['employee_data']['skills']['sub_skills']; 
	$employment_array		= $profile_data['employee_data']['employment'];
	$employment_version	= $profile_data['employee_data']['employment_version'];
	$education_array 			= $profile_data['employee_data']['education'];
	$language_array 			= $profile_data['employee_data']['language'];
	$kitchen_photo_array 	= $profile_data['employee_data']['kitchen_photos'];
	$bar_photo_array			= $profile_data['employee_data']['bar_photos'];
	$traits							= $profile_data['employee_data']['traits'];
	$awards						= $profile_data['employee_data']['awards'];
	$certifications				= $profile_data['employee_data']['certifications'];
	$quote							= $profile_data['general_data']['quote'];
	$description					= $profile_data['general_data']['description'];
	$firstname						= $profile_data['general_data']['firstname'];
	$lastname						= $profile_data['general_data']['lastname'];
	
	$last_initial = substr($lastname, 0,1);
	
		if ($employee_array['general']['profile_pic'] == "") {
			$profile_pic = "<span class='profilephoto'><i class='fa fa-user fa-4x' aria-hidden='true'></i></span>";
			$profile_pic_size = "small";
			$profile_pic_status = "N";
		} else {
			if (file_exists("images/profile_pics/".$profile_data['employee_data']['general']['profile_pic'])) {
				//get profile photo size for legacy photos:
				$profile_pic_size_array = getimagesize("images/profile_pics/".$profile_data['employee_data']['general']['profile_pic']);
				if ($profile_pic_size_array[1] < 200) {
					$profile_pic_size = "small";
					$profile_pic = "<img src='images/profile_pics/".$profile_data['employee_data']['general']['profile_pic']."?".time()."' class='center-block profilephoto' id='main_photo' style='margin-top:80px; margin-bottom:80px'>";
				} else {
					$profile_pic = "<img src='images/profile_pics/".$profile_data['employee_data']['general']['profile_pic']."?".time()."' class='center-block profilephoto' id='main_photo' style='max-height:280px;max-width:280px;height:auto;width:auto;'>";
					$profile_pic_size = "large";
				}
				$profile_pic_status = "Y";	
			} else {
				$profile_pic = "<span class='profilephoto'><i class='fa fa-user fa-4x' aria-hidden='true'></i></span>";
				$profile_pic_size = "small";
				$profile_pic_status = "N";
			}	
		}	

?>		

    <!-- ======== @Region: #content ======== -->
<div class="container">	
	
	<div class="col-md-12 hidden-xs" style="margin-bottom: 15px;">
        <h1 class="text-center" >
			<? echo $firstname ?>'s Profile
		</h2>
    </div>

	<div class="col-md-12 hidden-md hidden-lg text-center" style="margin-bottom: 20px;">
		<b><i>Hospitality Hiring Made Easy</i></b>
    </div>

        <!-- Profile block -->
        <div class="block-contained ">	        
            <div class="row">

                <div class="col-md-4">
                    <h2 class="block-title titlename text-center" >
						<? echo $firstname ?> <? echo $last_initial ?>
					</h2>
                </div>
                <div class="col-md-8 details">
<?php
					if ($quote == "") {
?>
						<h4 class="block-title quoteline" style="margin-top: 6px;"><i>No personal quote added</i></h2>
<?php
					} else {
?>
            	        <h4 class="block-title quoteline"  style="margin-top: 6px;"><i>"<? echo $quote ?>"</i></h2>
<?php
					}
?>		
                </div>
            </div>

            <div class="col-md-4 details">
                <div class="panel-employee text-center">
                    <div class="panel-employee-photo">
<?
						if($profile_pic_size == "small") {
?>
	                        <div class="row">
		                        <? echo $profile_pic ?>
						    </div>
<?php							
						} else {
?>
		                    <? echo $profile_pic ?>
<?php												
						}
						
						//hidden images		
						if (count($kitchen_photo_array) > 0) {
							foreach($kitchen_photo_array as $photo) {
								echo "<img src='images/gallery_pics/".$photo['photo']."?".time()."' class='center-block profilephoto' style='max-height:280px;max-width:280px;height:auto;width:auto; display:none' id='".$photo['photoID']."_large'>";
							}	
						}
						
						if (count($bar_photo_array) > 0) {
							foreach($bar_photo_array as $photo) {
								echo "<img src='images/gallery_pics/".$photo['photo']."?".time()."' class='center-block profilephoto' style='max-height:280px;max-width:280px;height:auto;width:auto; display:none' id='".$photo['photoID']."_large'>";
							}	
						}							
?>
                        <div class="portfoliophotos" style="margin-bottom: 0px">
<?php
							if (count($kitchen_photo_array) > 0 || count($bar_photo_array) > 0) {
								if ($profile_pic_status == "Y") {	
									//Thumb of main profile pic	
									echo "<a href='#' class='thumb' id='profile'><img src='images/profile_pics/".$employee_array['general']['profile_pic']."?".time()."' class='portfoliophotos'></a>";
								}
							}
															
							if (count($kitchen_photo_array) > 0) {
								foreach($kitchen_photo_array as $photo) {
									echo "<a href='#' class='thumb' id='".$photo['photoID']."'><img src='images/gallery_pics/".$photo['thumb']."?".time()."' class='portfoliophotos'></a>";
								}	
							}
							
							if (count($bar_photo_array) > 0) {
								foreach($bar_photo_array as $photo) {
									echo "<a href='#' class='thumb' id='".$photo['photoID']."'><img src='images/gallery_pics/".$photo['thumb']."?".time()."' class='portfoliophotos'></a>";
								}	
							}							
?>
                        </div>
                    </div>

                    <div class="panel-body" style="padding-top:10px">
<!--
	                    Applied in last 90 days: <? echo $past_reply_notice ?><br />
 -->

                        <div class="profilephone"><i>Contact Details Private</i></div>
                        
<!--                         <div class="profileemail">1<? echo $general_array['email'] ?></div> -->
<?php
						$lang_count = count($language_array);
						if ($lang_count > 0) {
?>
							<b>Languages</b>
                         <ul class="langlist">
							
<?php
							foreach($language_array as $row) {
								echo "<li>".$row['lang']."</li>";
							}
						} 
?>
                        </ul>
                    </div>
                </div>

                <div class="row endorsements hidden-xs hidden-sm details" style="min-height: 500px">
					<div class="col-md-12">
	                    <h4>Endorsements</h4>
	                    <br />
	                    &nbsp; &nbsp; <i>Coming Soon</i>
<!--
	                    <div class="row">
	                        <div class="col-xs-4 padding-zero">
	                            <img src="images/employee02.jpg">
	                        </div>
	                        <div class="col-xs-8 padding-top-sm">
		                        Holy cow John beats the meat out of the competition
		                    </div>
	                    </div>
	                    <div class="row">
	                        <div class="col-xs-4 padding-zero">
		                        <img src="images/employee03.jpg">
	                        </div>
	                        <div class="col-xs-8 padding-top-sm">That meats legit</div>
	                    </div>
	                    <div class="row">
	                        <div class="col-xs-4 padding-zero">
		                        <img src="images/employee04.jpg">
	                        </div>
	                        <div class="col-xs-8 padding-top-sm">
		                        It goes in extra hot and finishes early, the steak is great too!
		                    </div>
	                    </div>
-->
					</div>
                </div>
            </div>


            <div class="col-md-8 details">
                <div id="hostpitalityblock">
	                <div class="circlewrap hosp-exp">
<?
								//based on total Hospitaltiy experience light up right circle
								$hospitality_five = (round($total_experience['hospitality'])%5 === 0) ? round($total_experience['hospitality']) : round(($total_experience['hospitality']+5/2)/5)*5;

								if ($hospitality_five < 5) {
									echo "<div class='profilecircle c5yr'></div>";									
								} else {
			                        echo "<div class='profilecircle cpast c5yr'></div>";
								}	
								
								if ($hospitality_five >= 10) {
			                        echo "<div class='profilecircle cpast c10yr'></div>";
								}	else {
			                        echo "<div class='profilecircle c10yr'></div>";									
								}
								
                    			echo "<div class='profilecircle cactive 15yr'>";
									echo "<h4>Hospitality</h4>".round($total_experience['hospitality'])."<span class='subyears'>YEARS</span>";
								echo "</div>";
								
								if ($hospitality_five >= 20) {
			                        echo "<div class='profilecircle cpast c20yr'></div>";
								}	else {
			                        echo "<div class='profilecircle c20yr'></div>";									
								}
								
								if ($hospitality_five >= 25) {
			                        echo "<div class='profilecircle cpast c20yr'></div>";
								} else {
			                        echo "<div class='profilecircle c25yr'></div>";									
								}
?>
								<span style="display: inline-block;vertical-align: middle; line-height: normal; padding-bottom: 20px">	
									<a href='#' class='hospitality_header' style=' display:inline; color:#8b0909'><h5><i class="fa fa-chevron-right" aria-hidden="true"></i></h5></a>
								</span>
	                    	</div>
	                    	
	                    	<div class="circlewrap total-exp" style='display:none'>
								<span style="display: inline-block;vertical-align: middle; line-height: normal; padding-bottom: 20px">	
									<a href='#' class='total_header' style=' display:inline; color:#8b0909'><h5><i class="fa fa-chevron-left" aria-hidden="true"></i></h5></a>
								</span>
		                    	
<? 
								//based on total Hospitaltiy experience light up right circle
								$total_five = (round($total_experience['total'])%5 === 0) ? round($total_experience['total']) : round(($total_experience['total']+5/2)/5)*5;

								if ($total_five < 5) {
									echo "<div class='profilecircle c5yr'></div>";									
								} else {
			                        echo "<div class='profilecircle cpast c5yr'></div>";
								}	
								
								if ($total_five >= 10) {
			                        echo "<div class='profilecircle cpast c10yr'></div>";
								}	else {
			                        echo "<div class='profilecircle c10yr'></div>";									
								}
								
                    			echo "<div class='profilecircle cactive-total  15yr'>";
									echo "<h4>Total</h4>".round($total_experience['total'])."<span class='subyears'>YEARS</span>";
								echo "</div>";
								
								if ($total_five >= 20) {
			                        echo "<div class='profilecircle cpast c20yr'></div>";
								}	else {
			                        echo "<div class='profilecircle c20yr'></div>";									
								}
								
								if ($total_five >= 25) {
			                        echo "<div class='profilecircle cpast c25yr'></div>";
								} else {
			                        echo "<div class='profilecircle c25yr'></div>";									
								}
?>
	                </div> 
            	</div>
                
                <div class="row exposwrap">
	                
                    <div class="col-md-6 profileexperience">
                        <h4>Positions Held (Yrs)</h4>
<?php
						if (count($employee_position_experience) > 0) {//WRONG THING : SHOULD BE SKILLS
							$count = 1;
							foreach($employee_position_experience as $key=>$row) {
								if ($count == 1) {
									$circle = "topcircle";
								} else {
									$circle = "subcircle";
								}
								
								$rounded_yrs = round($row);
								if ($rounded_yrs < 1) {
									$rounded_yrs = "<1";
								}
								
								if ($count > 3) {
									$position_display = "style='display:none'";
									$position_class = "hidden_position";
								} else {
									$position_display = "";									
									$position_class = "";
								}
								
?>
								 <div class="topexperience <? echo $position_class ?>" <? echo $position_display ?>><? echo $key ?>:
								 	<div class="<? echo $circle ?>"><? echo $rounded_yrs ?></div>
								 </div>
<?php
								$count++;
							}
						} else {
?>
							 <div class="topexperience">
								 <i class="fa fa-circle-thin" aria-hidden="true"></i> None Listed
							 </div>
<?php
						}	
						
						if (count($employee_position_experience) > 3) {
?>
							<a href='#' id="show_positions_button"><h5 style='text-align:center; color:#8b0909' class="show_positions_button"><i class="fa fa-chevron-down" aria-hidden="true"></i> SHOW MORE POSITIONS <i class="fa fa-chevron-down" aria-hidden="true"></i></h5></a>		                        
							<a href='#' id="hide_positions_button"><h5 style='text-align:center; color:#8b0909; display:none;' class="hide_positions_button"><i class="fa fa-chevron-up" aria-hidden="true"></i> HIDE POSITIONS <i class="fa fa-chevron-up" aria-hidden="true"></i></h5></a>		                        
<?php
						}
?>
                    </div>                    

                    <div class="col-md-6 profilepositions">
                        <h4 class="spacer">Skills</h4>
<?php
						if (count($employee_skills_experience) > 0) {
							$count = 1;
							$bar = "";
							$rounded_row = "";
							foreach($employee_skills_experience as $key=>$row) {
								$rounded_row = round($row);
								if ($rounded_row < 10) {
									if ($rounded_row == 0) {
										$bar = "posbar01";
										$row = "less than 1";					
									} else {
										$bar = "posbar0".$rounded_row;
									}
								} else {
									$bar = "posbar08";
								}
								
								if ($count > 4) {
									$skill_display = "style='display:none'";
									$skill_class = "hidden_skill";
								} else {
									$skill_display = "";									
									$skill_class = "";
								}
?>
					            <div class="posbar <? echo $bar ?> <? echo $skill_class ?>" <? echo $skill_display ?>>
					                <span><? echo $key ?></span><span><? echo $row ?> yr(s)</span>
					            </div>
<?php	
								$count++;		
							}
						} else {
?>
				            <div class="topexperience" style="margin-top: -10px">
				                <i class="fa fa-circle-thin" aria-hidden="true"></i> No Hospitality Skills Listed
				            </div>
<?php							
						}
						
						if (count($employee_skills_experience) > 3) {
?>
							<a href='#' id="show_skills_button"><h5 style='text-align:center; color:#8b0909; margin-top:40px;' class="show_skills_button"><i class="fa fa-chevron-down" aria-hidden="true"></i> SHOW MORE SKILLS <i class="fa fa-chevron-down" aria-hidden="true"></i></h5></a>		                        
							<a href='#' id="hide_skills_button"><h5 style='text-align:center; color:#8b0909; margin-top:40px; display:none' class="hide_skills_button"><i class="fa fa-chevron-up" aria-hidden="true"></i> HIDE SKILLS <i class="fa fa-chevron-up" aria-hidden="true"></i></h5></a>		                        
<?php
						}
?> 
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="row pastwrap details">
                    <div class="col-md-12">
                        <h4 style="padding-top: 15px;">Past Employment</h4>
 <?php
						if (count($employment_array) > 0) {			
							foreach ($employment_array as $row) {				
								$start_date = $utilities->convert_month($row['start_month'])." ".$row['start_year'];
								if ($row['current'] == 'Y') {
									$end_date = 'Current';
								} else {
									$end_date = $utilities->convert_month($row['end_month'])." ".$row['end_year'];					
								}
				
								if ($end_date != "Current") {
									$end_time = $row['end_year'] + $row['end_month']/12;
									$start_time = $row['start_year'] + $row['start_month']/12;
				
									$total = $end_time - $start_time;
									$denominator = 4;
								    $x = $total * $denominator;
								    $x = floor($x);
								    $x = $x / $denominator;
								    								
									$time = "(".$x." yrs)";
								} else {
									$time = "";
								}
?>	
								<div class="row">
									<div class="col-md-6 col-xs-6 col-xs-offset-1" style="color:black"><i class="fa fa-circle-o" aria-hidden="true"></i> <? echo strtoupper($row['company']) ?></div>
									<div class="col-md-3 col-xs-5" style="color:black"><? echo $row['position'] ?></div>
									<div class="col-md-3 col-xs-10 col-xs-offset-2"><? echo $start_date." - ".$end_date ?>  <i><? echo $time ?></i></div>
								</div>			
<?php
							}
						} else {
?>
							<div class="row">
								<div class="col-md-12 "><i class="fa fa-circle-thin" aria-hidden="true"></i> No Past Employment Entered.</div>
							</div>
<?php
						}	
?>                
                    </div>        
                </div>

                <div class="row profileedu details">
                    <div class="col-md-12">
                        <h4 style='margin-bottom:5px;'>Education</h4>

						<div class="row">                        
<?php
						if (count($education_array) > 0) {
							foreach ($education_array as $row) {
?>
		                        <div class="col-md-6 col-xs-10 col-xs-offset-1 school"><i class="fa fa-graduation-cap" aria-hidden="true"></i> <? echo $row['school'] ?> - <? echo $row['degree'] ?></div>
<?php
							}
						} else {
?>
							<div class="col-md-6 col-xs-10 col-xs-offset-1 school"><i class="fa fa-circle-thin" aria-hidden="true"></i> <i>None Entered</i></div>
<?php
						}
?>	
						</div>
                    </div>
                </div>
                
                <div class="row awardscerts details">
<?php
					if (count($certifications) == 0 && count($awards) == 0) {
?>
                		<div class="col-md-12">
		                    <h4 style='margin-bottom:10px;'>Awards & Certifications</h4>
							<i class="fa fa-circle-thin" aria-hidden="true"></i> <i>None Listed</i>
                		</div>
<?php
					} else {
?>
                		<div class="col-md-6">
<?php
						if (count($awards) > 0) {
?>
                  			<h4 style='margin-bottom:10px;'>Awards</h4>
                  			<div class="col-md-12 col-xs-10 col-xs-offset-1">
<?php					
							foreach ($awards as $row) {
?>	
								<i class="fa fa-trophy" aria-hidden="true"></i> <? echo $row['award'] ?></br>		
<?php
							}
?>
							</div>
<?php
						}
?>			
						</div>
						
						<div class="col-md-6">					
<?php			
							if (count($certifications) > 0) {
?>
             			       <h4 style='margin-bottom:10px; margin-top:10px'>Certifications</h4>
			 				   <div class="col-md-12 col-xs-10 col-xs-offset-1">
             			       
<?php				
								foreach ($certifications as $row) {
?>
									<i class="fa fa-id-card" aria-hidden="true"></i> <? echo $row['certification'] ?></br>		
<?php
								}
?>
								</div>
<?php
							}
?>					
						</div>
<?php
					}
?>
                </div>
                
            <div class="row extrainfo details">
                <div class="col-md-12">
                    <h4>Description</h4> 
                    <? echo nl2br($description) ?>
                </div>
            </div>
            			
        </div>
</div>	

    </div>
	<!-- /container -->
	
	<footer style='background-color: #8e080b'>	
		<div style='background-color: #8e080b; color:white; min-height:75px; text-align:center; padding-top:5px;'>		
			<p>Copyright &copy; 2018 SBC Industries, LLC<br /> <a href="http://servebartendcook.com/index.php?page=privacy_policy">Privacy Policy</a>  | <a href="http://servebartendcook.com/index.php?page=TOS">Terms of Use</a></p><br />		
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



function public_candidate_page_warning($profile_data) {		
	
	public_candidate_full_header_html($profile_data);	
		
?>	
	<div class="row" style="margin-top: 25px;">
		<h3 style="text-align: center">This profile is set to Private</h3>
	</div>	
	
<!--
	<div class="row text-center" style="margin-top: 20px">
		<h5>This Job Listing has expired and is no longer available</h5>
	</div>	
-->
	
	<div class="row text-center" style="margin-top: 20px">
		<a href="/jobs.php"><h3>View More Jobs</h3></a>
		<br /> &nbsp; <br />
		<a href="/index.php"><h5>LOGIN</h5></a>
	</div>	
</div>					
<?php
}