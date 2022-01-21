<?php
function jobs_header_new_html($site_type, $meta_data, $region, $js_file_name, $position) {
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
<!--   	<link href="css/public_jobs.css?v=1c" rel="stylesheet"> -->


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
	


function jobs_html_new($region_text, $opportunity_list, $today, $region, $position) {		
	$utilities = new Utilities;	
	
	$all_region_select = $orlando = $charlotte = $tampa = "";
	switch($region) {
		default:
			$all_region_select = "selected";
		break;
		case "orlando":
			$orlando = "selected";
		break;
		case "tampa":
			$tampa = "selected";
		break;
		case "charlotte":
			$charlotte = "selected";
		break;
	}	
	
	$all_position_select = $foh = $boh = "";
	switch($position) {
		default:
			$all_position_select = "selected";
		break;
		case "foh":
			$foh = "selected";
		break;
		case "boh":
			$boh = "selected";
		break;
	}			
			
?>	
	<div class="container">
			    <div class="row">		
					<div class="col-md-10 col-md-offset-2" id="region_holder">
						<h2 style="color:gray"><? echo $region_text ?></h4>
						<h5 style="color:gray"><?echo $today ?></h5>
						
						<a href='#' id='show_filters' class="hidden-md hidden-lg"><h5><i class="fa fa-filter" aria-hidden="true"></i> Filter Jobs</h5></a>
					</div>
					
					<div class="col-xs-12 col-xs-offset-0" id="filter_holder" style="display: none">
						<div class="form-group position">
							<h2>Select Options</h4>

						   		<div class="col-xs-6">
									<select class='edit_region form-control' id="edit_region">
									<option value='all' <? echo $all_region_select ?> >All Regions</option>
									<option value='orlando' <? echo $orlando ?> >Orlando</option>
									<option value='charlotte' <? echo $charlotte ?> >Charlotte</option>
									<option value='tampa' <? echo $tampa ?> >Tampa</option>
									</select>
								</div>
								
						   		<div class="col-xs-6">
									<select class='edit_position form-control' id="edit_position">
									<option value='all' <? echo $all_position_select ?> >All Positions</option>
									<option value='foh' <? echo $foh ?> >Front of House</option>
									<option value='boh' <? echo $boh ?> >Back of House</option>
									</select>
								</div>
						</div>
						
						<div class="col-xs-12" style="margin-top: 15px">
							<a href='#' id='add_filter' class='btn btn-primary'><i class="fa fa-search" aria-hidden="true"></i> Search</a>
							&nbsp; &nbsp; <a href='#' id='cancel_filters'>Cancel</a>
						</div>

					</div>
					
				</div>
		<div  style="min-height: 350px; margin-top: 15px" class="row">

<?php		
	$count = 1;
	if (count($opportunity_list) > 0) {	
// BEGIN LOOP OF JOBS
		foreach($opportunity_list as $row) {
		
		//internal  tags for proper remarketing
		$position = $row['specialty'];
		switch($row['specialty']) {
			default:
				$category = "FOH";
			break;
			
			case "Kitchen":
				$category = "BOH";
			break;
			
			case "Bus":
				$category = "BOH";
			break;
		}
		
		$tracking_tag = "category=".$category."&position=".$position;
		 
		//DIFFERENT TEXT BASED ON WHETHER JOB WAS VIEWED, REPLIED, OR NEW
/*
			if ($row['responded'] == "Y") {
				$status = "Responded";
			} elseif ($row['viewed'] == "Y") {
				$status = "<i>Viewed</i>";
			} else {
				$status = "<font color='green'>NEW!</font>";						
			}
*/
			
			if ($row['image'] == "") {			
				switch($row['specialty']) {
					case "Bartender":
						$image = "images/main-bar.png";
					break;
					
					case "Server":
						$image = "images/main-server.png";
					break;
					
					case "Kitchen":
						$image = "images/main-cook.png";
					break;		
					
					case "Host":
						$image = "images/main-host.png";
					break;
												
					case "Bus":
						$image = "images/main-bus.png";
					break;
	
					case "Manager":
						$image = "images/main-manager.png";
					break;					
					
				}
				
			} else {
				$image = "images/store_pics/".$row['image']."?".time();
			}

			$city_state = $utilities->get_city_state($row['zip']);

			
//END VARIABLES FOR JOB LISTING

//JOBS THAT ARE OPEN AND JOBS THAT ARE FILLED DISPLAY DIFFERENTLY

			if ($row['job_status'] == "Open") {
				switch($row['comp_type']) {
					default:
						$compensation = $row['comp_type'];
						if ($compensation == "Min Wage plus Tips") {
							$compensation = "Tip Wage";
						}
					break;
					
					case "Hourly":
						if ($row['comp_value'] > 0) {
							$compensation = "$".$row['comp_value']."/hr";
							//$comp_filter = $row['comp_value'];
						} elseif ($row['comp_value_low'] == $row['comp_value_high']) {
							$compensation = "$".$row['comp_value_high']."/hr";
							//$comp_filter = $row['comp_value_high'];					
						} else {
							$compensation = "$".$row['comp_value_low']." - $".$row['comp_value_high']."/hr";
							//$comp_filter = $row['comp_value_high'];
						}
					break;
					
					case "Salary":
						$compensation = "Salary:  $".number_format($row['comp_value']);
						if ($row['comp_value'] > 0) {
							$compensation = "$".number_format($row['comp_value']);
							//$comp_filter = $row['comp_value'];
						} elseif ($row['comp_value_low'] == $row['comp_value_high']) {
							$compensation = "$".number_format($row['comp_value_high']);
							//$comp_filter = $row['comp_value_high'];
						} else {
							$compensation = "$".number_format($row['comp_value_low'])." - $".number_format($row['comp_value_high']);
							//$comp_filter = $row['comp_value_high'];
						}
					break;				
				}
?>
		<div class="col-md-4 col-xs-12  job_row" data-jobid='<? echo $row['jobID'] ?>' data-skill='<? echo $row['specialty'] ?>' data-comptype='<? echo $row['comp_type'] ?>' data-compvalue='<? echo $comp_filter ?>' data-schedule='<? echo $row['schedule'] ?>' >
            <div class="panel panel-default panel-opportunity">
            	<div class="panel-heading text-center">
	                <h5 class="panel-title">
	                	<? echo $row['name'] ?>
	                </h5>
	               <i class="fa fa-map-marker" aria-hidden="true"></i> <i><? echo $city_state['city'].", ".$city_state['state'] ?></i>

            	</div>
            
				<div class="panel-body" style="color: black; ">
					<div class="col-md-5 col-xs-5">
			        	<img src="<? echo $image ?>" class="center-block; img-fluid" >
					</div>
					<div class="col-md-7 col-xs-7" >
						<h4 style="margin-top: -5px;"><? echo $row['title'] ?></h5>
						<span style="color: gray"> <i class="fa fa-calendar-check-o" aria-hidden="true"></i> - <? echo $row['schedule'] ?></span><br />
						<span style="color: gray"><i class="fa fa-money" aria-hidden="true"></i> - <? echo $compensation ?></span>
						<div style="margin-top:15px">
							<a href="public_listing_new.php?ID=<? echo $row['jobID'] ?>&ref=<? echo $row['public_hash'] ?>&<? echo $tracking_tag ?>" class="btn btn-primary">VIEW DETAILS</a>
						</div>
<!--
			  		<h2 style="margin-top:0px; word-break: break-word; color: black; display: inline;"><? echo $row['title'] ?></h2>
			  		<ul class="list-group" style="font-size: 16px;">
			  			<li class="list-group-item"><? echo $row['schedule'] ?></li>
			  			<li class="list-group-item"><? echo $compensation ?></li>
                	</ul>
					<a href="public_listing_new.php?ID=<? echo $row['jobID'] ?>&ref=<? echo $row['public_hash'] ?>&<? echo $tracking_tag ?>" class="btn btn-primary">VIEW DETAILS</a>
-->
					</div>
              	</div>
              	
            </div>
        </div>
		
<?php
		if ($count % 2 == 0) {
			$visible_xs = "visible-xs";
			$xs_display = "";			
		} else {
			$visible_xs = "";
			$xs_display = "display:none";
		}
		
		if ($count % 3 == 0) {
			$visible_md = "visible-md";
			$visible_lg = "visible-lg";
			$md_display = "";
		} else {
			$visible_md = "";
			$visible_lg = "";
			$md_display = "display:none";
		}
		
?>
		<div class="clearfix <? echo $visible_xs ?>" style="<? echo $xs_display ?>"></div>
		<div class="clearfix <? echo $visible_md." ".$visible_lg ?>" style="<? echo $md_display ?>"></div>
        
<!-- 		<div class="clearfix" id='clear_<? echo $row['jobID'] ?>' data-job='<? echo $row['jobID'] ?>' data-visible='<? echo $match_data ?>' style="display:none;"></div> -->
<?php					

			}
			$count++;
		}
			
	//IF THERE ARE NO JOB OPENINGS SHOW NOTE	
	} elseif (count($opportunity_list) == 0) {
?>
		<div class="row text-center">	
				<h4>No results for your search</h5>
				<a href='jobs.php'>BACK</a>
		
<?php
	}	
?>		
				
		</div>
<?php
		if (count($opportunity_list) == 30) {
?>
        <div class="row spacer-jobs" id="more_job_holder">
			<div class="col-md-6 col-md-offset-3" id="next_page" style="cursor:pointer; text-align:center; border-radius:10px; border-style:solid; border-width:3px; border-color:white; background-color:#8e080b"><h2 style="color:white; margin-top:8px; margin-bottom:8px; cursor:pointer;">NEXT PAGE</h2></div>   
        </div>
<?php
		}
?>
				
			</div>
			</div>
		</div>
	</div>
<?php
}



		

function jobs_html_footer($version) {
?>
	<div class=""> &nbsp; </div>
    </div>
	<!-- /container -->
	
	<footer style='background-color: #8e080b'>	
		<div style='background-color: #8e080b; min-height:75px; text-align:center; padding-top:5px; color:white'>		
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
