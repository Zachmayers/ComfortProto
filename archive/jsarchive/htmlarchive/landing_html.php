<?php
	
function landing_header_html($page) {
	$utilities = new Utilities;
	$site_type = $utilities->site_type;

?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
	if ($site_type == "live") {	
		$utilities->google_analytics();	
		$utilities->facebook_RM();
	}
?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>Hospitality Hiring Made Easy | Serve. Bartend. Cook.</title>
	
	<meta name="description" content="Find local hospitality jobs or hire staff! Quick, easy job search and posting for servers, bartenders, cooks.  Job Matching for restaurant, bar positions.">
	<meta property="og:url" content="https://servebartendcook.com" />
	<meta property="og:title" content="Hospitality Hiring Made Easy | Serve. Bartend. Cook." />
	<meta property="og:description" content="Find local hospitality jobs or hire staff! Quick, easy job search and posting for servers, bartenders, cooks.  Job Matching for restaurant, bar positions." />
	<meta property="og:image" content="https://servebartendcook.com/new_square_logo.png" />


	<meta property="twitter:account_id" content="1125423043" />
	<meta property="twitter:card" content="summary" />
	<meta property="twitter:site" content="@servebarcook" />
	<meta property="twitter:title" content="The Finest Hospitality Jobs!" />
	<meta property="twitter:description" content="ServeBartendCook matches hospitality industry jobs with excellent workers based on skill and experience." />
	<meta property="twitter:image" content="http://servebartendcook.com/images/SBC-cook-Twitter.png" />

			<link href="https://servebartendcook.com" rel="canonical" />
				
	<meta name='robots' content='noindex' />

	
	<!-- Stylesheets -->
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300i,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Julius+Sans+One" rel="stylesheet">
    <!-- Bootstrap CSS File -->
    <link href="css/bootstrap.min.css?v=2" rel="stylesheet">
  	<link href="custom.css?v=2t" rel="stylesheet">
    <!-- Libraries CSS Files -->
    <link href="fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- Main Stylesheet File -->
    <link href="css/style.css?v=2" rel="stylesheet">
    
	<!-- CustomStylesheet File -->


	<script type="text/javascript" src="js/ajax.js?v=5"></script>	
    <!-- Required JavaScript Libraries -->
    <script src="js/jquery.min.js"></script>
<!--     <script src="js/bootstrap.min.js"></script> -->
    
    <!-- Custom Javascript File -->
    <script src="js/custom.js"></script>

	<script type="text/javascript" src="js/general.js?v=5"></script>	
	<script type="text/javascript" src="js/index.js?v=1d"></script>	
		
	<!-- Favicons -->
	<link rel="shortcut icon" href="images/favicon.png" />
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
<!--	
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
-->
	
<!-- <link type="text/css" href="css/custom-theme/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" /> -->
<!--
<link href='//fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald:300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Lato:400' rel='stylesheet' type='text/css'>
-->
<!--
<script type="text/javascript" src="js/jquery-ui-1.8.23.custom.min.js"></script> 

 <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script> 
-->

<!--  <script type="text/javascript" src="js/jquery_form.js"></script> -->
	
</head>
 <body class="page-index has-hero" style="margin-top: -15px">
    <div id="background-wrapper" class="block block-pd-sm block-bg-grey-dark block-bg-overlay block-bg-overlay-6" data-block-bg-img="images/main-desktop-bg-bartender.jpg">

        <!-- ======== @Region: #navigation ======== -->
        <div id="navigation" class="wrapper">

            <!--Header & navbar-branding region-->
            <div class="header">
                <div class="header-inner container">
                    <div class="row">
                        <div class="col-md-12 col-xs-9 text-center " style="margin-top:-5px;">
				            <img src="images/new-SBC-logo.png" style="max-width: 575px; display: inline; width:100%;">
                        </div>
                        <div class="col-xs-3 hidden-sm visible-xs hidden-lg">
                            <div class="navbar navbar-default">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="navbar navbar-default ">
                    <div class="navbar-text social-media social-media-inline pull-right hidden-xs">
                        <a href="https://www.facebook.com/ServeBartendCook/"><i class="fa fa-facebook"></i></a>
                        <a href="https://www.instagram.com/servebartendcook/"><i class="fa fa-instagram"></i></a>
<!--                         <a href="https://www.twitter.com/servebarcook/"><i class="fa fa-twitter"></i></a> -->
                    </div>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav" id="main-menu">
                            <li class="icon-link">
                                <a href="index.php"><i class="fa fa-home"></i></a>
                            </li>
                            <li>
                            	<a href="jobs.php">Hot Jobs</a>
                            </li>
                            <li>
                            	<a href="index.php?page=login">Login</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php	
}	
	
function landing_body_html($page) {
$utilities = new Utilities;
?>		
    <div class="container-fluid">
	    
		<div class="top-section">
	    	<p class="text-center hidden-xs get_started"> &nbsp; </p>
	    	
			<div class="row ">
				
	            <div class="col-md-6 hidden-xs text-center">
		            <div class="row">
						<div class="col-md-8 col-md-offset-2">

			        		<h1 style='font-weight:500'>Restaurant Jobs <br />Restaurant Talent</h1>	
			        		<h3 style='font-weight:300; margin-bottom:25px;'>Designed specifically for the hospitality industry, SBC allows you to post jobs quickly with easy to use templates and receive only applicants with restaurant experience.</h2>	

							<a href="#learn" id="learn_button"><button type="button" class="btn btn-lg " style="color:white; background-color: #8e080b">
								<i class="fa fa-circle-thin" aria-hidden="true" style="background-color: transparent"></i> Learn More
							</button></a>
						</div>
					</div>
	            </div>
	            
	            <div class="col-xs-12 visible-xs" style="margin-bottom: 25px;">
		            <div class="row">
						<div class="col-xs-10 col-xs-offset-1 text-center">

			        		<h3 style='font-weight:500; margin-bottom:0px;'>Restaurant Jobs</h3> 
			        		<h3 style='font-weight:500; margin-top:5px;'>Restaurant Talent</h3>	
				        		
					        	<h4 style='font-weight:300; margin-bottom:5px;'><i class="fa fa-check" aria-hidden="true"></i> $19 Job Posts</h4>	
				        		<h4 style='font-weight:300; margin-bottom:5px;'><i class="fa fa-check" aria-hidden="true"></i> Designed specifically for the hospitality industry</h4>
					        	<h4 style='font-weight:300; margin-bottom:5px;'><i class="fa fa-check" aria-hidden="true"></i> Easy to use templates</h4>
							<div class="row text-center">
								<a href="#learn" id="learn_button"><button type="button" class="btn" style="color:white; background-color: #8e080b">
									<i class="fa fa-circle-thin" aria-hidden="true" style="background-color: transparent"></i> Learn More
								</button></a><br />
								<i>The most trusted job site for local independently owned restaurants</i>
								
							</div>
						</div>
					</div>
	            </div>
	            
	            
				<div class="col-md-6 col-xs-12">
					<div class="row">
						<div class="col-md-8 col-md-offset-1 col-xs-10  col-xs-offset-1 text-box">
							<div class='row'>
								<div class="col-md-12 warning" id="employer_empty_warning"  style="display:none; text-align:center; background-color: white;"><font color="red"><b>NOTICE: Please complete all fields</b></font></div>
							</div>
							<div class='row'>
								<div class="col-md-12 warning" id="employer_email_retype_warning" style="display:none; text-align:center; background-color: white;"><font color="red"><b>NOTICE: Emails do not match</b></font></div>  
							</div>
							<div class='row'>
								<div class="col-md-12 warning" id="employer_pass_warning" style="display:none; text-align:center; background-color: white;"><font color="red"><b>NOTICE: Invalid password length</b></font></div>
							</div>
							<div class='row'>
								<div class="col-md-12 warning" id="employer_duplicate_warning" style="display:none; text-align:center; background-color: white;"><font color="red"><b>NOTICE: Email already being used</b></font></div>
							</div>
							<div class='row'>
								<div class="col-md-12 warning"  id="employer_email_warning" style="display:none; text-align:center; background-color: white;"><font color="red"><b>NOTICE: Invalid email address</b></font></div>
							</div>
							<div class='row'>
								<div class="col-md-12 warning" id="employer_pass_check_warning" style="display:none; text-align:center; background-color: white;"><font color="red"><b>NOTICE: Passwords do not match</b></font></div>
							</div>
							<div class='row'>
								<div class="col-md-12 warning" id="permission_warning" style="display:none; text-align:center; background-color: white;"><font color="red"><b>NOTICE: You must check the box below to continue</b></font></div>
							</div>
							<div class='row'>
								<div class="col-md-12 warning" id="error" style="display:none; text-align:center; background-color: white;"><font color="red"><b>NOTICE: There was an error processing your request.  Please try again later or contact admin@servebartendcook.com</b></font></div>
							</div>
							
							<input type="hidden" id="access_2" name="access" value="catscradle"/>  

							<span style="text-align:center; margin-bottom:25px;"><h3 style="margin-bottom:20px; font-weight:300;"><i class="fa fa-thumb-tack" aria-hidden="true" style="background-color: transparent"></i>  &nbsp; Start Posting Your Job:</h3></span>	
							
							<div class='row' id="sign_up_form" style="text-align: center">
					        
					        <input type="text" id="firstname" placeholder="First Name" name="firstname" size='16' style="margin:auto;"><br />	        
					       
					        <input type="text" id="lastname" placeholder="Last Name" name="lastname" size='16' style="margin:auto;" maxlength="16"/><br />     
					       
					        <input type="text" id="login_email" placeholder="Email Address" name="login_email" size='16' style="margin:auto;" maxlength="100"/><br />     
					
					        <input type="password" placeholder="Choose a Password" id="set_password" name="password" size='16' style="margin:auto;" maxlength="12" placeholder="between 6 and 12 chars"><br />	        

							<input type="text" id="referral" placeholder="Referral Code (Optional)" name="referral_code" size='8' style="margin:auto; font-size:16px;" maxlength="6"/><br />     

							<button type="button" class="btn btn-lg" id='signup_employer'  style="background-color:white; color: #b76163">
								<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Start Posting a Job
							</button><br />
							
							<div id="loader" style="display:none; text-align: center">
								<h2>Loading...</h2>
							</div>
				
							<div style='width:100%; margin-top: 5px; float:left;'>
								<i>By continuing you agree to our <a href="index.php?page=TOS">Terms of Service</a> and <a href="index.php?page=privacy_policy">Privacy Policy</a></i><br /> &nbsp;
							</div>
						</div>
					</div>	
				</div>
	            
			</div>
        </div>
        <div class="row " style="margin-top: 50px;">
	        <br />&nbsp;
        </div>
	</div>

  	<div class="row hidden-xs" style=" background-color: #292424;">
		<h4 style="text-align:center; font-weight: 400; color:white; margin-bottom: 10px;"><i class="fa fa-star-o" aria-hidden="true"></i> Top Brands Using ServeBartendCook <i class="fa fa-star-o" aria-hidden="true"></i></h4>
  	</div>

  	<div class="row visible-xs" style=" background-color: #292424; margin-top: -55px">
		<h4 style="text-align:center; font-weight: 400; color:white; margin-bottom: 10px;"><i class="fa fa-star-o" aria-hidden="true"></i> Top Brands Using ServeBartendCook <i class="fa fa-star-o" aria-hidden="true"></i></h4>
  	</div>
  	
		<div class="row" style="margin-top: 5px; padding-bottom: 15px; padding-top: 15px; background-color: #e9e6de;">
	  		<div class="col-md-12 col-xs-12">
			  	<div class="row">
			  		<div class="col-md-2 col-xs-12 col-md-offset-1 col-xs-offset-0" style="margin-top:5px;">
				  		<div class="row">
					  		<div class="col-md-6 col-xs-6 text-center">
					  			<a href='jobs.php'><img src='images/store_pics/1937.jpg' class='center-block profilephoto' style='max-height:100px;max-width:100px;height:auto;width:auto;border:1px solid white;'></a>
					  		</div>
						  	<div class="col-md-6 col-xs-6 text-left" style="margin-top:25px; padding-left: 6px; color:#8e080b;">
					  			White Wolf Cafe<br />
					  			Orlando, FL
						  	</div>
				  		</div>
			  		</div>
			  		<div class="col-md-2 col-xs-12" style="margin-top:5px;">
				  		<div class="row">
					  		<div class="col-md-6 col-xs-6 text-center">
					  			<a href='jobs.php'><img src='images/store_pics/2548.jpg' class='center-block profilephoto' style='max-height:100px;max-width:100px;height:auto;width:auto;border:1px solid white;'>
					  		</div>
						  	<div class="col-md-6 col-xs-6 text-left" style="margin-top:25px; padding-left: 6px; color:#8e080b;">
					  			K Restaurant<br />
					  			Orlando, FL
						  	</div>
				  		</div>
			  		</div>
			  		<div class="col-md-2 col-xs-12" style="margin-top:5px;">
				  		<div class="row">
					  		<div class="col-md-6 col-xs-6 text-center">
					  			<a href='jobs.php'><img src='images/store_pics/2461.jpg' class='center-block profilephoto' style='max-height:100px;max-width:100px;height:auto;width:auto;border:1px solid white;'></a>
					  		</div>
						  	<div class="col-md-6 col-xs-6 text-left" style="margin-top:25px; padding-left: 6px; color:#8e080b;">
					  			Kres Chophouse<br />
					  			Orlando, FL
						  	</div>
				  		</div>
			  		</div>
			  		<div class="col-md-2 col-xs-12 " style="margin-top:5px;">
				  		<div class="row">
					  		<div class="col-md-6 col-xs-6 text-center">
					  			<a href='jobs.php'><img src='images/store_pics/2030.jpg' class='center-block profilephoto' style='max-height:100px;max-width:100px;height:auto;width:auto;border:1px solid white;'></a>
					  		</div>
						  	<div class="col-md-6 col-xs-6 text-left" style="margin-top:25px; padding-left: 6px; color:#8e080b;">
					  			Adobe Gila's<br />
					  			Orlando, FL
						  	</div>
				  		</div>
			  		</div>
			  		<div class="col-md-2 col-xs-12" style="margin-top:5px;">
				  		<div class="row">
					  		<div class="col-md-6 col-xs-6 text-center">
					  			<a href='jobs.php'><img src='images/store_pics/196.jpg' class='center-block profilephoto' style='max-height:100px;max-width:100px;height:auto;width:auto;border:1px solid white;'></a>
					  		</div>
						  	<div class="col-md-6 col-xs-6 text-left" style="margin-top:25px; padding-left: 6px; color:#8e080b;">
					  			Relax Grill<br />
					  			Orlando, FL
						  	</div>
				  		</div>
			  		</div>
				  	
			  	</div>	
		  	</div>
  	</div>

  	<div class="row hidden-xs" style=" background-color: #292424; margin-top: 6px">
		<h4 style="text-align:center; font-weight: 400; color:white; margin-bottom: 10px;"><i class="fa fa-star-o" aria-hidden="true"></i>  &nbsp; &nbsp; &nbsp;  <i class="fa fa-star-o" aria-hidden="true"></i> &nbsp; &nbsp; &nbsp; <i class="fa fa-star-o" aria-hidden="true"></i></h4>
  	</div>

  	<div class="row visible-xs" style=" background-color: #292424; margin-top: 0px">
		<h4 style="text-align:center; font-weight: 400; color:white; margin-bottom: 10px;"><i class="fa fa-star-o" aria-hidden="true"></i>  &nbsp; &nbsp; &nbsp;  <i class="fa fa-star-o" aria-hidden="true"></i> &nbsp; &nbsp; &nbsp; <i class="fa fa-star-o" aria-hidden="true"></i></h4>
  	</div>
 	<a name="learn" id="learn">
	<div class="row row-margin" style="background-color: #e9e6de; margin-bottom: -37px; margin-top:0px; padding-bottom:20px;">
            <div class="col-md-4 col-xs-12 text-center middle-spacer">
	            <div class="text-center">
	            	<img src='images/morejobsavailable.png' style="display:inline" height='80px;' width='80px'>
	            </div>
	            <h3 style="text-align:center; color:#8e080b;">Simple Pricing - $19 Posts</h3>
	            <div style="color:#8e080b;">
		            <i class="fa fa-arrow-right" aria-hidden="true"></i> <b>$19 JOB POSTS!</b> <br /> 
	           		<i class="fa fa-arrow-right" aria-hidden="true"></i> <b>No recurring fees, trials or or upselling.</b> <br /> 
	           		<i class="fa fa-arrow-right" aria-hidden="true"></i> <b>No ads.</b> <br />
	            </div><br />
				<a href='index.php?page=employer_signup' class='btn btn-large' style="background-color:#8e080b; width:43%; text-align:center;margin-right:3px; border: hidden; color: white;">HIRE TODAY</a>
            </div>            

            <div class="col-md-4 col-xs-12 text-center middle-spacer">
	            <div class="text-center">
		            <img src='images/postjob.png' style="display:inline" height='80px;' width='80px'>
	            </div>
		        <h3 style="color:#8e080b;">Quick Job Posting</h3>
	            <div style="color:#8e080b;">
	           		<i class="fa fa-arrow-right" aria-hidden="true"></i> <b>Simple templates for typical restaurant positions.</b> <br /> 
	           		<i class="fa fa-arrow-right" aria-hidden="true"></i> <b>Pre-Interview Questions for better candidate filtering.</b> <br />
	           		<i class="fa fa-arrow-right" aria-hidden="true"></i> <b>Post your job in 90 seconds.</b>
	            </div><br />
				<a href='index.php?page=employer_signup' class='btn btn-large' style="background-color:#8e080b; width:43%; text-align:center;margin-right:3px; border: hidden; color: white;">GET STARTED</a>
            </div>
            <div class="col-md-4 col-xs-12 text-center middle-spacer">	          
	            <div class="text-center">
	            	<img src='images/findajob.png' style="display:inline" height='80px;' width='80px'>
	            </div>
	            <h3 style="text-align:center; color:#8e080b;">Hospitality Focused Candidates</h3>
	            <div style="color:#8e080b;">
	           		<i class="fa fa-arrow-right" aria-hidden="true"></i> <b>Standardized profiles highlight restaurant experience.</b> <br /> 
	           		<i class="fa fa-arrow-right" aria-hidden="true"></i> <b>Candidates include pics & answers interview questions.</b> <br />
	           		<i class="fa fa-arrow-right" aria-hidden="true"></i> <b>Applicant Tracking System based on specific restaurant skills and experience.</b>
	            </div><br />
				<a href='index.php?page=employer_signup' class='btn btn-large' style="background-color:#8e080b; width:43%; text-align:center;margin-right:3px; border: hidden; color: white;">POST A JOB</a>
            </div>
	</div>
	
	<div class="bottom-section">
     
    <div class='below-fold row-margin' style='width:99%; padding-top:145px; min-height:700px;'>
	    <p class='free text-center spacer100'>What can SBC do for you?</p>

                <div class="row row-margin">
					<div class="col-md-1">
						&nbsp;
					</div>
                    <div class="col-md-5 extra">
	                    <div class='description text-box' style='float:left; width:100%; margin-left:5px; margin-top:0px; padding-left:3%; padding-right:3%; padding-top:5px; padding-bottom:5px;'>
							<div style="float:right; width:100%">
								<div class="tagline" style="float:left; width:70%; margin-top:10px;">
									<h3 style="display:inline">FIND A JOB</h3>
								</div>
								
								<div style="float:right; width:30%; margin-top:-5px; margin-right:0px;">								
									<a class="btn btn-square" href='index.php?page=job_seeker_faq'>Learn More</a>
								</div>
							</div>

							<div style="float:left; width:100%; padding-bottom: 10px; padding-top: 15px;">
		                		ServeBartendCook will match you with jobs in your region based on your skills and experience.  You can quickly create a profile that allows you to apply to several jobs in just a few clicks.  We will notify you when new jobs are added that match your skills.<br />
							</div>
	                    </div>
                    </div>
                     
                    <div class="col-md-5 extra-right">
	                    <div class='description text-box' style='float:left; width:100%; margin-left:5px; margin-top:0px; padding-left:3%; padding-right:3%; padding-top:5px; padding-bottom:5px;'>
							<div style="float:right; width:100%">
								<div class="tagline" style="float:left; width:70%; margin-top:10px;">
									<h3 style="display:inline">HIRE SOMEONE</h3>
								</div>
								
								<div style="float:right; width:30%; margin-top:-5px; margin-right:0px;">								
									<a class="btn btn-square" href='index.php?page=employer_faq'>Learn More</a>
								</div>
							</div>
							
							<div style="float:left; width:100%; padding-bottom: 10px; padding-top: 15px;">							
		                		Post jobs quickly and easily and get results that include only the information that you need and want. Easily compare, sort and filter qualified candidates.  Job posts are competitively priced at $19 (some regions are are free)<br />
							</div>
	                    </div>
                    </div>
			</div>
        </div>
    </div>    

<?php
 }


function public_page_warning($valid_page, $device, $site_type) {		
	
	public_full_header_html($site_type);	
		
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

function landing_footer_html() {
	$utilities = new Utilities;
	$site_type = $utilities->site_type;		
?>
    </div>
	<!-- /container -->

		<footer style='background-color: #e9e6de;'>	
			<div style='background-color: #e9e6de; min-height:75px; text-align:center; padding-top:5px; color:#8e080b'>		
				<p style='color:#8e080b'>Copyright &copy; 2018 SBC Industries, LLC<br /> <a style='color:#8e080b' href="http://servebartendcook.com/index.php?page=privacy_policy">Privacy Policy</a>  |  <a style='color:#8e080b' href="http://servebartendcook.com/index.php?page=TOS">Terms of Use</a></p><br />		
				<p style='color:#8e080b'>info@servebartendcook.com</p>
			</div>			
		</footer>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
<!--     <script src="js/bootstrap.min.js"></script> -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
<?php
	if ($site_type == "live") {
		$utilities->google_adwords_RM();
	}		
?>
    
</body>

</html>
<?php
}