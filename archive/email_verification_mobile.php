<?php
	require_once('classes.php');

	$valid = $_GET['valid_hash'];
	$userID = $_GET['userID'];
	
	$member = new Member;
	$valid_check = $member->email_verification($userID, $valid_hash);
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript">

/*
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38015816-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
*/

</script>
	<title>Serve. Bartend. Cook.</title>
	
	<meta charset="utf-8" />
   <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1; user-scalable=no;">
	<meta name="viewport" content="initial-scale=1">
	<meta name='robots' content='noindex'>
	
	<link rel="apple-touch-icon" href="mages/mobile-logo320.png"/>
	<meta name="apple-mobile-web-app-capable" content="yes" />	
	
	<!-- Stylesheets -->
	<link href="css/style-mobile.css?v=1" rel="stylesheet" type="textcss" media="screen" charset="utf-8" >
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<link type="text/css" href="css/custom-theme/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Oswald:300' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/jquery-ui-1.8.23.custom.min.js"></script>
</head>
<body>

	<!-- Start Wrapper -->
	<div id="content" >
	
	
<!-- Main content divs  -->

	<div id="holder">
	<div id="fixed-menu-main" style="text-align:center">
		<img src="images/mobile-logo320.png" style="padding-top:15px;"><br />
		<img src="images/main-server.png" alt="" height="65px;" style="padding-right: 30px;"/> <img src="images/main-bar.png" alt="" height="65px;" style="padding-right: 30px;"/><img src="images/main-cook.png" height="65px;" alt="" />		
	</div>	
			
			
		
		<!-- Start App Info -->
	
		<div style="margin-top:175px; text-align:center">
		
			<!-- End Logo -->
			<h2 style="color:#4D0002; text-align:center;"><i>The Finest Hospitality Jobs</i></h2>
			
				<h1>Email Verification</h1>
			
			<div class="buttons">
						&nbsp; <br />
			</div>
		
		</div>
		<!-- End App Info -->		
									<!-- Start Pages -->
		<div id="pages1">				
		
		<div class="pages" id="main_info" style="min-height: 300px; text-align:center;">
<?php
		if ($valid_check == "Y") {
?>		
							<p >Thank you for validating your email address please login below!<br />
							&nbsp; <br />
								<a href="index.php?page=login" class="button" id="blackberry">Login</a>
							</P>						
				</div>
<?php
		} else {
?>				
							<p style="margin-top: 15px; font-size: 16px;">You must verify your email address to login for the first time.  An email was sent to the address you used to create an account. 
														&nbsp; <br />

							<br /> If you did not receive the email please check your 'spam' folder, or click below to resend.<br />
							resend button
							</P>		
							&nbsp; <br />
								<a href="#" class="button" id="verification">Resend Verification</a>
							&nbsp; <br />							
							If you have any problems, please contact use directly at admin@servebartendcook.com				
				</div>
				
<?php
		}
?>		
		</div>	
				</div>

	<!-- End Footer -->	
	</div>
	<!-- End Wrapper -->


<div id="login-form" style="display:none; text-align:center;">
  <div id="pass-form">
    <table align="center">
      <tr>
        <td align="right"><b>Email:</b></td>
        <td><input type="text" name="user" id="user">
          </br></td>
      </tr>
      <tr>
        <td align="right"><b>Password:</b></td>
        <td><input type="password" name="pass" id="pass"></td>
      </tr>
    </table>
	<a href="#" class="button" id="login-button">Login</a>        
  </div>
</div>

<div id="verification-form" style="display:none; text-align:center;">
  <div>
  	Please enter the email you created an account with.<br />
    &nbsp; <br />
    <table align="center">
      <tr>
        <td align="right"><b>Email:</b></td>
        <td><input type="text"  id="email_verify">
          </br></td>
      </tr>
    </table>
	<a href="#" class="button" id="verification-button">Send</a>    
    <div id="verification_sent" style="display:none">
    	Email verification sent, please check all folders.
    </div>
    <div id="bad_email" style="display:none">
    	No account associated with that email address.
    </div>    
  </div>
</div>

</body>

<script>
$(document).ready(function() {
	$(".login").click(function() {
		$('.pages').hide();
		$('#login-form').show();			
		return false;
	});
	
	$("#verification").click(function() {
		//alert("here");
		$('.pages').hide();
		$('#verification-form').show();			
		return false;
	});	
		
	$("#login-button").click(function() {
					$('#pass-form').hide();
					$('#loader').show();					
					user = $('#user').attr('value');
					pass = $('#pass').attr('value');
					dataString = "user=" + user + "&pass=" + pass;
					$.ajax({
						type: "POST",
						url: "login_verify.php",
						data: dataString,
						success: function(data) {
							//alert(data);
							if (data == "false") {
								$('#loader').hide();
								$('#pass-form').show();	
								$('#login').prepend('<h3>Invalid Login</h3>');
							} else if (data == "true") {
								window.location = "main.php";
							}
						}
					});					
				});
		
		$("#verification-button").click(function() {
					email = $("#email_verify").attr('value');
					dataString = "email=" + email;
//					alert(dataString);
					$.ajax({
						type: "POST",
						url: "update_profile.php?type=email_verify",
						data: dataString,
						success: function(data) {
							//alert(data);
							if (data == "Y") {
								$('#bad_email').hide();															
								$('#verification_sent').show();
							} else {
								$('#bad_email').show();								
							}
						}
					});					
				});
		
});
</script>
</html>