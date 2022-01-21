<?php
	require_once('classes/verification.class.php');
	require_once('classes/utilities.class.php');

	require_once('mobile_detect.php');	

	$utilities = new Utilities;
	$site_type = $utilities->site_type;	

	$token = $_GET['token'];
	$userID = $_GET['ID'];
	if ($_GET['access'] == 'PJ') {
		$access = 'Y';
	} else {
		$access = 'N';
	}
	
	$verification = new Verification;
	$valid_check = $verification->password_reset_validation_check($userID, $token, $access);

/*
 	$info = new uagent_info; 
	$test = $info->DetectTierIphone();
	if ($test == true) {
		$device = "mobile";
	} else {
		$device = "full";
	}
*/

?>
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

	<title>Password Reset</title>
	
	<meta name="description" content="Password Reset">
	<meta name='robots' content='noindex'>
	
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
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
<!--
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
-->
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

	<div class='white' style="min-height: 100%">
		
	    <div class="container" style="min-height: 525px">
	
			<div id="row">
				<div class="col-md-9 col-md-offset-2 col-xs-10 col-xs-offset-1 text-center">
					<h3 style="color:black">Password Reset</h3>
				</div>
			</div>
			
			<div class="row">
<?php
		if ($valid_check == "yes") {	
?>	
			<script>
				ID = '<? echo $userID ?>';
				token = '<? echo $token ?>';
				change_password(ID, token);
			</script>		

			<div class="col-md-9 col-md-offset-2 col-xs-10 col-xs-offset-1 text-center">
				<h5 style="color:black; text-align:center;">Please enter a new password below (between 6 and 12 characters)</h4>
			</div>
			
			<div id="deactivate_warning" class="warning col-md-9 col-md-offset-2 col-xs-10 col-xs-offset-1 text-center" style="display:none; color:red">This account has been deactivated.  Please contact admin@servebartendcook.com for more information</div>
			<div id="invalid_warning" class="warning col-md-9 col-md-offset-2 col-xs-10 col-xs-offset-1 text-center" style="display:none; color:red">The 'Password Reset' link you used is no longer valid</div>  
			<div id="new_pass_warning" class="warning col-md-9 col-md-offset-2 col-xs-10 col-xs-offset-1 text-center" style="display:none; color:red">Your new passwords don't match</div>  
			<div id="pass_length_warning" class="warning col-md-9 col-md-offset-2 col-xs-10 col-xs-offset-1 text-center" style="display:none; color:red">Your new password must be between 6 and 12 characters</div>  

			<div id="pass_change_form" class="col-md-9 col-md-offset-2 col-xs-10 col-xs-offset-1 text-center">
		
				<form class="form-horizontal">
					<div class="form-group">				
						<label for="new_pass1" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">New Password</label>
						<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
							<input type='password' class='new_pass1 form-control' id="new_pass1" placeholder='New Password'><br />
						</div>
						<label for="new_pass2" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Re-type New Password</label>
						<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
							<input type='password' class='new_pass2 form-control' id="new_pass2" placeholder='Re-type New Password'><br />
						</div>
					</div>		
				</form>
				
				<div class="row" style="margin-bottom:25px">
					<div class="col-md-12 col-xs-12 text-center">
						<button type="button" class="btn btn-success" id="change_password">
							<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save
						</button>
					</div>
				</div>
				
				<div class="row" style="margin-bottom:25px">
					<div class="col-md-12 col-xs-12 text-center">
						If you have any problems resetting your password, please email us at admin@servebartendcook.com
					</div>
				</div>							
											
			</div>
							
			<div class="row text-center" id="pass_loader" style="display:none">
				&nbsp; <br />
				<h4 style="color:black">Updating...</h4>
			</div>
							
			<div class="row text-center" id="pass_change_success" style="display:none">
				&nbsp; <br />
				<h2 style="color:black">Password successfully changed.</h2><br />
				&nbsp; <br />
				<h2 style="color:black"><a href='http://servebartendcook.com/index.php'>LOGIN</a>
			</div>
		</div>
<?php
		} else {
?>				
			<div class="col-md-9 col-md-offset-2 col-xs-9 col-xs-offset-2 text-center">
				<h5>This link is no longer valid</h5>
				&nbsp; <br />
				<br /> Please visit <a href="http://servebartendcook.com">ServeBartendCook.com</a>
				&nbsp; <br />
				If you have any problems, please contact us directly at admin@servebartendcook.com				
			</div>
				
<?php
		}
?>		
		</div>	
	</div>
</div>

	<footer style='background-color: #8e080b; color:white;'>	
		<div style='background-color: #8e080b; min-height:75px; text-align:center; padding-top:5px;'>		
			<p>Copyright &copy; 2018 SBC Industries, LLC<br /> <a href="http://servebartendcook.com/index.php?page=privacy_policy">Privacy Policy</a>  | <a href="http://servebartendcook.com/index.php?page=TOS">Terms of Use</a></p><br />		
			<p>info@servebartendcook.com</p>
		</div>			
	</footer>
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>	
<!-- 	<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js" integrity="sha256-JklDYODbg0X+8sPiKkcFURb5z7RvlNMIaE3RA2z97vw=" crossorigin="anonymous"></script> -->
    
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
<!-- 	<script type='text/javascript' src='js/index.js?v=<? echo $version ?>'></script> -->



</body>
</html>
