<?php
require_once('classes/verification.class.php');	
require_once('classes/utilities.class.php');

	$utilities = new Utilities;
	$site_type = $utilities->site_type;	

	$verification = new Verification;
	
	$page = $verification->unsubscribe_page($_GET['page_code'], $userID = $_GET['id'], $key_hash = $_GET['key_hash']);	
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php
	if ($site_type == "live") {
	//Place various analytic tags	
		//GOOGLE	
		$utilities->google_analytics();
	}
?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>SBC Unsubscribe</title>
	
	<meta name="description" content="Password Reset">
	<meta name='robots' content='noindex'>
	
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/ajax.js"></script>
    
    <!-- Custom Javascript File -->
    <script src="js/custom.js"></script>

    <!-- Main Stylesheet File -->
    <link href="css/style.css?v=2" rel="stylesheet">
    
	<!-- CustomStylesheet File -->
  	<link href="css/custom.css?v=2r" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Nothing+You+Could+Do' rel='stylesheet' type='text/css'>

	<script type="text/javascript" src="js/index.js"></script>

	<!-- Favicons -->
	<link rel="shortcut icon" href="images/favicon.ico" />
	<link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>

    <div id="background-wrapper" class="block block-pd-sm block-bg-grey-dark block-bg-overlay block-bg-overlay-6" data-block-bg-img="images/main-desktop-bg-bartender.jpg">

        <!-- ======== @Region: #navigation ======== -->
        <div id="navigation" class="wrapper">

            <!--Header & navbar-branding region-->
            <div class="header">
                <div class="header-inner container">
                    <div class="row">
                        <div class="col-md-12 col-xs-12 text-center">
                            <!--navbar-branding/logo - hidden image tag & site name so things like Facebook to pick up, actual logo set via CSS for flexibility -->
                            <img src="images/logo-final.png" alt="ServeBartendCook Logo" style="margin:0 auto;">
                            <h1 class="hidden">ServeBartendCook</h1>
                        </div>
<!--
                        <div class="col-xs-3 hidden-sm hidden-md hidden-lg">
                            <div class="navbar navbar-default">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                            </div>
                        </div>
-->
                    </div>
                </div>
            </div>
        </div> &nbsp; <br />
    </div>
	<!-- End Header -->
			
			
	<div class='white' style="min-height: 100%">
	    <div class="container" style="min-height: 625px; margin-top: 25px;">

<?php
		if ($page == "unsubscribe_choice") {
?>		
			<div class="row text-center">
				<h1>Too many emails?</h1>
				<h2>We understand</h2>
<!-- 				<h3 style='margin-bottom:10px;'>Sometimes you need to clean out your inbox, please choose an option to the right.</h3> -->
			</div>					
<?php
		} elseif ($page == "oops") {
?>		
			<div id="row text-center">
				<h2>Oops, something went wrong. </h2>
				&nbsp; <br />
				&nbsp; <br />
				If you have any problems, please contact us directly at admin@servebartendcook.com				
			</div>				
<?php
		}
?>				
		
<?php
		if ($page == "unsubscribe_choice") {
?>		
			<div id='unsubscribe_form' class="row" style="margin-top: 20px">
				<div class="col-md-offset-1 col-xs-offset-1 col-md-10 col-md-10">
					<h4 style='text-align:center'>BUT we don't want you to forget about us!</h5>
					<h4 style='margin-bottom:20px; text-align:center'>Select an unsubscribe option:</h5><br />
					<div id='warning' style='color:red; display:none'><b>You must choose an option below</b><br /></div>													
					<form id='blargle'>
						<input type='radio' name='blarge' value='1'> Remind you in 1 month to login and check opportunities (<i>you will only ever receive </i><b>one</b><i> more email from us</i>)<br />
						&nbsp; <br />
						<input type='radio' name='blarge' value='3'> Remind you in 3 months to login and check opportunities (<i>you will only ever receive </i><b>one</b><i> more email from us</i>)<br />
						&nbsp; <br />
						<input type='radio' name='blarge' value='0'> Don't send me any reminders at all (<i>you will NOT receive</i> <b>any</b><i> other emails from us at all</i>)<br />
						&nbsp; <br />
					</form>
					<input type='hidden' id='code' value='DDsn4t887um'>
					<input type='hidden' id='hash' value='<? echo $_GET['key_hash'] ?>'>
					<input type='hidden' id='userID' value='<? echo $_GET['id'] ?>'>
					<h4 style="text-align:center"><a href='#' id='unsubscribe'>
						UNSUBSCRIBE NOW			
					</a></h5>
					&nbsp; <br />
					&nbsp; <br />
					&nbsp; <br />
					&nbsp; <br />

					<i>If you want to change the types of jobs you are matched to, please login and modify your profile: <a href="http://servebartendcook.com">HOME</a></i>
				</div>
			</div>
					
			<div id='success' class="row text-center" style='display:none'>
				<h3>Unsubscribe Complete</h3>
			</div>
					
			<div id='oops' class="row text-center" style='display:none'>
				<h5>Oops, something went wrong.</h5>
				&nbsp; <br />
				&nbsp; <br />
				If you have any problems, please contact us directly at admin@servebartendcook.com										
			</div>						
<?php
		}
?>		
		
	    </div>	
	<!-- Start Footer -->
	<footer style='background-color: #8e080b; color:white;'>	
		<div style='background-color: #8e080b; min-height:75px; text-align:center; padding-top:5px;'>		
			<p>Copyright &copy; 2018 SBC Industries, LLC<br /> <a href="http://servebartendcook.com/index.php?page=privacy_policy">Privacy Policy</a>  | <a href="http://servebartendcook.com/index.php?page=TOS">Terms of Use</a></p><br />		
			<p>info@servebartendcook.com</p>
		</div>			
	</footer>

	<!-- End Footer -->	
	</div>
	<!-- End Wrapper -->
</body>
<?php 
	if ($page == "unsubscribe_choice") {
?>
<script>
$(document).ready(function() {

		$("#unsubscribe").click(function() {
			$('#warning').hide();				
			sub_option = $("#blargle input[type='radio']:checked").val();
			code = $('#code').val();
			userID = $('#userID').val();
			hash = $('#hash').val();	
			//alert(sub_option);			
			if (sub_option == '0' || sub_option == '1' || sub_option == '3') {
				dataString = "sub_option=" + sub_option + "&code=" + code + "&userID=" + userID + "&hash=" + hash;
				//alert(dataString);
				$.when(send_ajax(dataString, "ajax/verification.ajax.php?type=unsubscribe", "full")).done(function(data){
					//alert(data);
					$('#unsubscribe_form').hide();
					if (data == "complete") {
						$('#success').show();						
					} else {
						$('#oops').show();												
					}
				});																	
			} else {				
				$('#warning').show();									
			}
			return false;								
		});	
		
});
</script>
<?php
	}
?>
</html>
