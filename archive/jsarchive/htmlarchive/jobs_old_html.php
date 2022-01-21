<?php
function jobs_header_html($site_type, $meta_data, $region, $js_file_name, $position) {
?>
<!DOCTYPE html>
<html lang="en">
<head>

<?php
	if ($site_type == "live") {
		$utilities = new Utilities;
	//Place various analytic tags	
		//GOOGLE	
		$utilities->google_analytics();
	
		//FB
		$utilities->facebook_RM();
	}
?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title><? echo $meta_data['title'] ?></title>
	
	<meta name="description" content="<? echo $meta_data['description'] ?>">
<?php
	if ($site_type == "prototype") {
		echo "<meta name='robots' content='noindex'>";
	}

		
?>
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
  	<link href="css/public_jobs.css?v=1e" rel="stylesheet">


	<script type="text/javascript" src="js/ajax.js?v=5"></script>	
    <!-- Required JavaScript Libraries -->
    <script src="js/jquery.min.js"></script>
<!--     <script src="js/bootstrap.min.js"></script> -->
    
    <!-- Custom Javascript File -->
    <script src="js/custom.js"></script>
   <? echo $js_file_name ?>

	<script type="text/javascript" src="js/general.js?v=5"></script>	
	<script type="text/javascript" src="js/public.js?v=1a"></script>	
		
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
                            	<a href="index.php?page=employee_signup">Sign-Up</a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hot Locations<b class="caret"></b></a>
                                <!-- Dropdown Menu -->
                                <ul class="dropdown-menu">
                                    <li>
                                    	<a href="jobs.php?region=all&position=<? echo $position ?>" tabindex="-1" class="menu-item">All</a>
                                    </li>
                                    <li>
                                    	<a href="jobs.php?region=orlando&position=<? echo $position ?>" tabindex="-1" class="menu-item">Orlando</a>
                                    </li>
                                    <li>
                                    	<a href="jobs.php?region=tampa&position=<? echo $position ?>" tabindex="-1" class="menu-item">Tampa</a>
                                    </li>
                                    <li>
                                    	<a href="jobs.php?region=charlotte&position=<? echo $position ?>" tabindex="-1" class="menu-item">Charlotte</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Positions <b class="caret"></b></a>
                                <!-- Dropdown Menu -->
                                <ul class="dropdown-menu">
                                    <li>
                                    	<a href="jobs.php?region=<? echo $region ?>&position=all" tabindex="-1" class="menu-item">All</a>
                                    </li>
                                    <li>
                                    	<a href="jobs.php?region=<? echo $region ?>&position=foh" tabindex="-1" class="menu-item">Front of House</a>
                                    </li>
                                    <li>
                                    	<a href="jobs.php?region=<? echo $region ?>&position=boh" tabindex="-1" class="menu-item">Back of House</a>
                                    </li>
                                </ul>
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


function jobs_html($region_text, $job_slots, $today) {
?>
<div class="container">
	
    <div class="row">		
		<div class="col-md-10 col-md-offset-2 ">
			<h2 style="color:gray; font-weight: 400;"><? echo $region_text ?></h4>
			<h5 style="color:gray"><?echo $today ?></h5>
		</div>
	</div>

        <div class="row">	        
<?php If (count($job_slots[0]) > 0) { 
	$bg_image = $job_slots[0]['bg_image'];
	if ($job_slots[0]['image'] == "") {
		$image = " &nbsp; ";
	} else {
		$image = "<img src='images/store_pics/".$job_slots[0]['image']."?".time()."' class='profilephoto' style='max-height:50px;max-width:50px;height:auto;width:auto'>";
	}
?>	        
            <div class="col-md-4 col-md-offset-2 spacer-jobs">
	        	<div class="col-md-12 tile" style="background-image:url('<? echo $bg_image ?>')">
		        	
		        	<div class="row">
			        	<div class="col-md-12 text-right" style='margin-top:10px'>
				        	<? echo $job_slots[0]['pay_text']; ?>
			        	</div>
		        	</div>
		        		
					<div class="row" style='margin-top:90px'>
						<div class="col-md-2 col-xs-2 text-left" style="margin-top: 3px">
				        	<? echo $image ?>
			        	</div>			        	

						<div class="col-md-10 col-xs-10">
							<h3 style="margin-top: 0px; "><? echo $job_slots[0]['title']; ?> @ <? echo $job_slots[0]['name']; ?></h3>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6 pull-left">
							<h5 style='display:inline'><? echo $job_slots[0]['city']; ?>, <? echo $job_slots[0]['state']; ?></h5>
						</div>
						<div class="col-md-6 pull-right">
							<div class="job" id="<? echo $job_slots[0]['jobID']."&ref=".$job_slots[0]['public_hash']; ?>&utm_source=site&utm_medium=public&utm_campaign=job_list&utm_term=<? echo $job_slots[0]['category'] ?>&utm_content=<? echo $job_slots[0]['position_type'] ?>" style='cursor:pointer; margin-right: -14px; background-color:#8e080b; padding:5px 5px 5px 5px;'><h4 style="text-align:center; margin-top:0px; margin-bottom: 0px;">LEARN MORE</h4></div>
						</div>						
					</div>
	        	</div>
	        </div>
<?php } ?>	        

<?php If (count($job_slots[1]) > 0) { 
	$bg_image = $job_slots[1]['bg_image'];
	if ($job_slots[1]['image'] == "") {
		$image = " &nbsp; ";
	} else {
		$image = "<img src='images/store_pics/".$job_slots[1]['image']."?".time()."' class='profilephoto' style='max-height:50px;max-width:50px;height:auto;width:auto'>";
	}
	
?>	        
            <div class="col-md-4 spacer-jobs">
	        	<div class="col-md-12 tile" style="background-image:url('<? echo $bg_image ?>')">
		        	
		        	<div class="row">
			        	<div class="col-md-12 text-right" style='margin-top:10px'>
				        	<? echo $job_slots[1]['pay_text']; ?>
			        	</div>
		        	</div>
		        		
					<div class="row" style='margin-top:90px'>
						<div class="col-md-2 col-xs-2 text-left" style="margin-top: 3px">
				        	<? echo $image ?>
			        	</div>			        	
						
						<div class="col-md-10 col-xs-10">
							<h3 style="margin-top: 0px"><? echo $job_slots[1]['title']; ?> @ <? echo $job_slots[1]['name']; ?></h3>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6 pull-left">
							<h5 style='display:inline'><? echo $job_slots[1]['city']; ?>, <? echo $job_slots[1]['state']; ?></h5>
						</div>
						<div class="col-md-6 pull-right">
							<div class="job" id="<? echo $job_slots[1]['jobID']."&ref=".$job_slots[1]['public_hash']; ?>&utm_source=site&utm_medium=public&utm_campaign=job_list&utm_term=<? echo $job_slots[1]['category'] ?>&utm_content=<? echo $job_slots[1]['position_type'] ?>" style='cursor:pointer; margin-right: -14px; background-color:#8e080b; padding:5px 5px 5px 5px;'><h4 style="text-align:center; margin-top:0px; margin-bottom: 0px;">LEARN MORE</h4></div>
						</div>						
					</div>
	        	</div>
	        </div>
<?php } ?>	        

        </div>

        <div class="row">	        
<?php If (count($job_slots[2]) > 0) {
	$bg_image = $job_slots[2]['bg_image'];
	if ($job_slots[2]['image'] == "") {
		$image = " &nbsp; ";
	} else {
		$image = "<img src='images/store_pics/".$job_slots[2]['image']."?".time()."' class='profilephoto' style='max-height:50px;max-width:50px;height:auto;width:auto'>";
	}
	
?>	        
            <div class="col-md-4 col-md-offset-2 spacer-jobs">
	        	<div class="col-md-12 tile" style="background-image:url('<? echo $bg_image ?>')">
		        	
		        	<div class="row">
			        	<div class="col-md-12 text-right" style='margin-top:10px'>
				        	<? echo $job_slots[2]['pay_text']; ?>
			        	</div>
		        	</div>
		        		
					<div class="row" style='margin-top:90px'>
						<div class="col-md-2 col-xs-2 text-left" style="margin-top: 3px">
				        	<? echo $image ?>
			        	</div>			        	
						
						<div class="col-md-10 col-xs-10">
							<h3 style="margin-top: 0px"><? echo $job_slots[2]['title']; ?> @ <? echo $job_slots[2]['name']; ?></h3>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6 pull-left">
							<h5 style='display:inline'><? echo $job_slots[2]['city']; ?>, <? echo $job_slots[2]['state']; ?></h5>
						</div>
						<div class="col-md-6 pull-right">
							<div class="job" id="<? echo $job_slots[2]['jobID']."&ref=".$job_slots[2]['public_hash']; ?>&utm_source=site&utm_medium=public&utm_campaign=job_list&utm_term=<? echo $job_slots[2]['category'] ?>&utm_content=<? echo $job_slots[2]['position_type'] ?>" style='cursor:pointer; margin-right: -14px; background-color:#8e080b; padding:5px 5px 5px 5px;'><h4 style="text-align:center; margin-top:0px; margin-bottom: 0px;">LEARN MORE</h4></div>
						</div>						
					</div>
	        	</div>
	        </div>
<?php } ?>	        

<?php If (count($job_slots[3]) > 0) { 
	$bg_image = $job_slots[3]['bg_image'];
	if ($job_slots[3]['image'] == "") {
		$image = " &nbsp; ";
	} else {
		$image = "<img src='images/store_pics/".$job_slots[3]['image']."?".time()."' class='profilephoto' style='max-height:50px;max-width:50px;height:auto;width:auto'>";
	}
	
?>	        
            <div class="col-md-4 spacer-jobs">
	        	<div class="col-md-12 tile" style="background-image:url('<? echo $bg_image ?>')">
		        	
		        	<div class="row">
			        	<div class="col-md-12 text-right" style='margin-top:10px'>
				        	<? echo $job_slots[3]['pay_text']; ?>
			        	</div>
		        	</div>
		        		
					<div class="row" style='margin-top:90px'>
						<div class="col-md-2 col-xs-2 text-left" style="margin-top: 3px">
				        	<? echo $image ?>
			        	</div>			        	
						
						<div class="col-md-10 col-xs-10">
							<h3 style="margin-top: 0px"><? echo $job_slots[3]['title']; ?> @ <? echo $job_slots[3]['name']; ?></h3>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6 pull-left">
							<h5 style='display:inline'><? echo $job_slots[3]['city']; ?>, <? echo $job_slots[3]['state']; ?></h5>
						</div>
						<div class="col-md-6 pull-right">
							<div class="job" id="<? echo $job_slots[3]['jobID']."&ref=".$job_slots[3]['public_hash']; ?>&utm_source=site&utm_medium=public&utm_campaign=job_list&utm_term=<? echo $job_slots[3]['category'] ?>&utm_content=<? echo $job_slots[3]['position_type'] ?>" style='cursor:pointer; margin-right: -14px; background-color:#8e080b; padding:5px 5px 5px 5px;'><h4 style="text-align:center; margin-top:0px; margin-bottom: 0px;">LEARN MORE</h4></div>
						</div>						
					</div>
	        	</div>
	        </div>
<?php } ?>	        

        </div>

        <div class="row">	        
<?php If (count($job_slots[4]) > 0) { 
	$bg_image = $job_slots[4]['bg_image'];	
	if ($job_slots[4]['image'] == "") {
		$image = " &nbsp; ";
	} else {
		$image = "<img src='images/store_pics/".$job_slots[4]['image']."?".time()."' class='profilephoto' style='max-height:50px;max-width:50px;height:auto;width:auto'>";
	}
	
?>	        
            <div class="col-md-4 col-md-offset-2 spacer-jobs">
	        	<div class="col-md-12 tile" style="background-image:url('<? echo $bg_image ?>')">
		        	
		        	<div class="row">
			        	<div class="col-md-12 text-right" style='margin-top:10px'>
				        	<? echo $job_slots[4]['pay_text']; ?>
			        	</div>
		        	</div>
		        		
					<div class="row" style='margin-top:90px'>
						<div class="col-md-2 col-xs-2 text-left" style="margin-top: 3px">
				        	<? echo $image ?>
			        	</div>			        							
						
						<div class="col-md-10 col-xs-10">
							<h3 style="margin-top: 0px"><? echo $job_slots[4]['title']; ?> @ <? echo $job_slots[4]['name']; ?></h3>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6 pull-left">
							<h5 style='display:inline'><? echo $job_slots[4]['city']; ?>, <? echo $job_slots[4]['state']; ?></h5>
						</div>
						<div class="col-md-6 pull-right">
							<div class="job" id="<? echo $job_slots[4]['jobID']."&ref=".$job_slots[4]['public_hash']; ?>&utm_source=site&utm_medium=public&utm_campaign=job_list&utm_term=<? echo $job_slots[4]['category'] ?>&utm_content=<? echo $job_slots[4]['position_type'] ?>" style='cursor:pointer; margin-right: -14px; background-color:#8e080b; padding:5px 5px 5px 5px;'><h4 style="text-align:center; margin-top:0px; margin-bottom: 0px;">LEARN MORE</h4></div>
						</div>						
					</div>
	        	</div>
	        </div>
<?php } ?>	        

<?php If (count($job_slots[5]) > 0) {
	$bg_image = $job_slots[5]['bg_image'];	
	if ($job_slots[5]['image'] == "") {
		$image = " &nbsp; ";
	} else {
		$image = "<img src='images/store_pics/".$job_slots[5]['image']."?".time()."' class='profilephoto' style='max-height:50px;max-width:50px;height:auto;width:auto'>";
	}
	
?>	        
            <div class="col-md-4 spacer-jobs">
	        	<div class="col-md-12 tile" style="background-image:url('<? echo $bg_image ?>')">
		        	
		        	<div class="row">
			        	<div class="col-md-12 text-right" style='margin-top:10px'>
				        	<? echo $job_slots[5]['pay_text']; ?>
			        	</div>
		        	</div>
		        		
					<div class="row" style='margin-top:90px'>
						<div class="col-md-2 col-xs-2 text-left" style="margin-top: 3px">
				        	<? echo $image ?>
			        	</div>			        	
						
						<div class="col-md-10 col-xs-10">
							<h3 style="margin-top: 0px"><? echo $job_slots[5]['title']; ?> @ <? echo $job_slots[5]['name']; ?></h3>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6 pull-left">
							<h5 style='display:inline'><? echo $job_slots[5]['city']; ?>, <? echo $job_slots[5]['state']; ?></h5>
						</div>
						<div class="col-md-6 pull-right">
							<div class="job" id="<? echo $job_slots[5]['jobID']."&ref=".$job_slots[5]['public_hash']; ?>&utm_source=site&utm_medium=public&utm_campaign=job_list&utm_term=<? echo $job_slots[5]['category'] ?>&utm_content=<? echo $job_slots[5]['position_type'] ?>" style='cursor:pointer; margin-right: -14px; background-color:#8e080b; padding:5px 5px 5px 5px;'><h4 style="text-align:center; margin-top:0px; margin-bottom: 0px;">LEARN MORE</h4></div>
						</div>						
					</div>
	        	</div>
	        </div>
<?php } ?>	        

        </div>
        
        <div class="row spacer-jobs" id="more_job_holder">
			<div class="col-md-6 col-md-offset-3" id='more_jobs' style="cursor:pointer; text-align:center; border-radius:10px; border-style:solid; border-width:3px; border-color:white; background-color:#8e080b"><h2 style="color:white; margin-top:8px; margin-bottom:8px; cursor:pointer;">VIEW MORE JOBS</h2></div>";   
        </div>
        
        <div class="row spacer-jobs" id="login_holder" style="display: none">
	        <div class="row">
				<div class="col-md-12">
					<p class="text-center free" style='color:black'>Login or Sign-Up</p>
					<p class="text-center" style='color:black; margin-top:-10px;'><i>View local jobs and apply quickly!</i></p>
				</div>
	        </div>
	        <div class="row">
 	           <div class="col-md-4 col-md-offset-2">
	 	           <div class="col-md-12" id="login" style="cursor:pointer; padding-bottom: 5px; padding-top: 5px; text-align:center; border-radius:10px; border-style:solid; border-width:3px; border-color:white; background-color:#8e080b">
	 			   		LOGIN
	 	           </div>
				</div>
				
 	           <div class="col-md-4">
	 	           <div class="col-md-12" id="employee" style="cursor:pointer; padding-bottom: 5px; padding-top: 5px; text-align:center; border-radius:10px; border-style:solid; border-width:3px; border-color:white; background-color:#8e080b">
	 			   		SIGN-UP
	 	           </div>
				</div>
				
	        <div class="row">
				<div class="col-md-12 homelinks" style='color:black'>
					<p class="text-center"><a href='https://servebartendcook.com' style='color:black'>Learn More</a></p>
				</div>
	        </div>
				
				
	        </div>	        	        
        </div>
 
 	        <div class="row">
				<div class="col-md-12 homelinks" style='color:black'>
					<p class="text-center"><a href='https://servebartendcook.com/?page=employer_signup' style='color:black'>POST A JOB</a></p>
				</div>
	        </div>       
<?php
}
		

function jobs_html_footer($version) {
?>
	<div class="row"> &nbsp; </div>
    </div>
	<!-- /container -->
	
	<footer style='background-color: #8e080b'>	
		<div style='background-color: #8e080b; min-height:75px; text-align:center; padding-top:5px;'>		
			<p>Copyright &copy; 2017 SBC Industries, LLC<br /> <a href="http://servebartendcook.com/index.php?page=privacy_policy">Privacy Policy</a>  | <a href="http://servebartendcook.com/index.php?page=TOS">Terms of Use</a></p><br />		
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
