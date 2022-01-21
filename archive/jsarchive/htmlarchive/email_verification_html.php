<?php
function email_verification_header_html($site_type) {
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
	<meta name='robots' content='noindex'>

<!--
	<meta property="og:url" content="https://servebartendcook.com" />
	<meta property="og:title" content="<? echo $meta_title ?>" />
	<meta property="og:description" content="<? echo $meta_description ?>" />
	<meta property="og:image" content="https://servebartendcook.com/new_square_logo.png" />


	<meta property="twitter:account_id" content="1125423043" />
	<meta property="twitter:card" content="summary" />
	<meta property="twitter:site" content="@servebarcook" />
	<meta property="twitter:title" content="The Finest Hospitality Jobs!" />
	<meta property="twitter:description" content="ServeBartendCook matches hospitality industry jobs with excellent workers based on skill and experience." />
	<meta property="twitter:image" content="http://servebartendcook.com/images/SBC-cook-Twitter.png" />
-->

<!-- MODIFY BASED ON REGION -->
<!-- 			<link href="https://servebartendcook.com/index.php?page=<? echo $_GET['page'] ?>" rel="canonical" /> -->

	<!-- Javascripts -->
<!-- 	<script type="text/javascript" src="javascripts/jquery-1.7.1.min.js"></script> -->
<!--
	<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="js/lightbox-2.6.min.js"></script>	
-->
	
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="custom.css?v=1" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Nothing+You+Could+Do' rel='stylesheet' type='text/css'>

	<? echo $js_file_name ?>

	<!-- Favicons -->
	<link rel="shortcut icon" href="images/favicon.ico" />
	<link rel="shortcut icon" href="images/favicon.png" />
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
</head>

<body>

    <div class="page-header text-center">
        <img src="images/logo-final.png">
    </div>


	<div class='white' style="color:black; min-height: 100%">
	
    <div class="container" style="color:black; min-height: 550px">
<?php		
}


function email_verification_html($valid_check) {
?>
    <div class="row">		
		<div class="col-md-10 col-md-offset-2 col-xs-10 col-xs-offset-1 text-center">
			<h3 style="color:gray">Email Verification</h3>
		</div>
	</div>

       <div class="row">	        
	        
<?php
		if ($valid_check == "Y") {
?>
            <div class="col-md-10 col-md-offset-2 col-xs-10 col-xs-offset-1 text-center">
				<h4 style="color:black">Thank you for validating your email address please login below!</h4><br /> &nbsp; <br />
				<a href='index.php?page=login' class='btn btn-large btn-success' > Login</a>
			</div>
<?php
		} else {
?>			
            <div class="col-md-10 col-md-offset-2 col-xs-10 col-xs-offset-1 text-center">
				Your email address has already been verified, or you have clicked an incorrect link.
				&nbsp; <br />
				&nbsp; <br />
				<a href="https://servebartendcook.com">SERVEBARTENDCOOK.COM</a>
				&nbsp; <br />							
				&nbsp; <br />
				If you have any problems, please contact us directly at admin@servebartendcook.com				
	            
<!--
				You must verify your email address to utilize the features of ServeBartendCook.  An email was sent to the address you used to create an account. 
						&nbsp; <br />
						<br /> If you did not receive the email please check your 'spam' folder.<br />
				</P>		
				&nbsp; <br />
				&nbsp; <br />							
				If you have any problems, please contact us directly at admin@servebartendcook.com				
-->
			</div>
<?php 
	}
}

function email_change_html($email) {
?>
    <div class="row">		
		<div class="col-md-10 col-md-offset-2 col-xs-10 col-xs-offset-1 text-center ">
			<h3 style="color:black">Email Address Changed</h3>
		</div>
	</div>

       <div class="row" style="margin-top: 25px;">	        
            <div class="col-md-10 col-md-offset-2 col-xs-10 col-xs-offset-1 text-center">
				<h4 style="color:gray">Your email address has been changed to <? echo $email ?></h4>
				You can now use this email address to login to your account.<br />
				&nbsp; <br />
				<a href='index.php?page=login' class='btn btn-large btn-success' > Login</a>
			</div>
<?php
}
	
function email_change_error_html($error) {
?>
    <div class="row">		
		<div class="col-md-10 col-md-offset-2 col-xs-10 col-xs-offset-1 text-center">
			<h3 style="color:gray">Oops!</h3>
		</div>
	</div>

       <div class="row">	        
            <div class="col-md-10 col-md-offset-2 text-center">
<?php
				switch($error) {
					case "general":
?>
						<h4 style="color:gray">Something went wrong.</h4>
						<h5><a href="https://servebartendcook.com">HOME</a></h5><br />
<?php					
					break;
					
					case "duplicate":
?>
						<h4 style="color:gray">Email address already changed</h4>
						<h5>Please contact admin@servebartendcook.com</h5><br />
<?php					
					break;
				}
?>
			</div>
<?php
}
		

function email_verification_html_footer($version) {
?>
	<div class="row"> &nbsp; </div>
    </div>
	<!-- /container -->
       </div>
	<footer style='background-color: #8e080b'>	
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
<?php
}	
