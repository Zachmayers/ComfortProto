<?php
require_once('classes/verification.class.php');	
require_once('classes/utilities.class.php');

	$utilities = new Utilities;
	$site_type = $utilities->site_type;	

	$verification = new Verification;
	
	$page = $verification->unsubscribe($_GET['page_code'], $userID = $_GET['id'], $key_hash = $_GET['key_hash']);	
?>

<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript">
<?php
	if ($site_type == "live") {
?>
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38015816-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
<?php
	}
?>

</script>
	<title>Serve. Bartend. Cook.</title>
	
	<meta charset="utf-8" />
	<meta name="viewport" content="user-scalable = yes">
	<meta name="robots" content="noindex">	
	<!-- Stylesheets -->
	<link rel="stylesheet" type="text/css" href="stylesheets/mainbase.css" />

	<!-- <link rel="stylesheet" type="text/css" href="stylesheets/media.queries.css" /> -->
	<link rel="stylesheet" type="text/css" href="stylesheets/tipsy.css" />
	<link rel="stylesheet" type="text/css" href="javascripts/fancybox/jquery.fancybox-1.3.4.css" />
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Nothing+You+Could+Do|Quicksand:400,700,300">
	
	<!-- Javascripts -->
	<script type="text/javascript" src="javascripts/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="javascripts/html5shiv.js"></script>
	<script type="text/javascript" src="javascripts/jquery.tipsy.js"></script>
	<script type="text/javascript" src="javascripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<script type="text/javascript" src="javascripts/fancybox/jquery.easing-1.3.pack.js"></script>
	<script type="text/javascript" src="javascripts/jquery.touchSwipe.js"></script>
	<script type="text/javascript" src="javascripts/jquery.mobilemenu.js"></script>
	<script type="text/javascript" src="javascripts/jquery.infieldlabel.js"></script>
	<script type="text/javascript" src="javascripts/jquery.echoslider.js"></script>
	<script type="text/javascript" src="javascripts/fluidapp.js"></script>
	
	
	<!-- Favicons -->
	<link rel="shortcut icon" href="images/favicon.ico" />
	<link rel="shortcut icon" href="images/favicon.png" />
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<link type="text/css" href="css/custom-theme/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Oswald:300' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/jquery-ui-1.8.23.custom.min.js"></script>
</head>
<body>

	<!-- Start Wrapper -->
	<div id="page_wrapper">
		
	<!-- Start Header -->
	<header>
		<div class="container">
				<a href="#home" class="logo">
				
			</a>
		
			<!-- End Social Icons -->
			
						<!-- Start Navigation -->
			<nav>
				<span class="arrow"></span>
			</nav>
			<!-- End Navigation -->
		</div>
	</header>
	<!-- End Header -->
			
			
			<section class="container">
		
		<!-- Start App Info -->
	
		<div id="app_info">
			<!-- Start Logo -->
		
			<!-- End Logo -->
			<span class="tagline">The Finest Hospitality Jobs</span>
			
			<div class="buttons">
				&nbsp; <br />
			</div>
			
			<div class="buttons">
						&nbsp; <br />
			</div>
		
		</div>
		<!-- End App Info -->		
									<!-- Start Pages -->
		<div id="pages">
			<div class="top_shadow"></div>
			
			<!-- Start Home -->
			<div id="home"  style="margin-top: 5px;">
				
		
		<div class="full" id="main_info" style="min-height: 300px;">
					<p>&nbsp;</P>
<?php
		if ($page == "unsubscribe_choice") {
?>		
							<p style="margin-top: 15px; font-size: 16px;">To stop receiving all job match notifications from ServeBartendCook.com, please click "Unsubscribe" below.<br />
<!-- 							EMAIL: <? echo $email ?> -->
							&nbsp; <br />
								<a href="job_notice_unsubscribe.php?page_code=DDsn4t887um&id=<? echo $userID ?>&key_hash=<? echo $key_hash ?>">
									UNSUBSCRIBE
									
								</a>
							&nbsp; <br />
							&nbsp; <br />
								If you want to change the types of jobs you are matched to, please login and modify your profile: <a href="http://servebartendcook.com">HOME</a>
														
							</P>						
				</div>
<?php
		} elseif ($page == "oops") {
?>				
							<p style="margin-top: 15px; font-size: 16px;">Oops, something went wrong. 
														&nbsp; <br />
														&nbsp; <br />
						
							If you have any problems, please contact use directly at admin@servebartendcook.com				
				</div>
				
<?php
		} elseif ($page == "unsubscribe_complete") {
?>				
							<p style="margin-top: 15px; font-size: 16px;">Unsubscribe complete.  You will no longer receive job match notification emails. 
								&nbsp; <br />

				</div>
<?php
		}
?>		
		</div>	
		
			<!-- End Home -->
					<!-- End Styles -->
			
			<div class="bottom_shadow"></div>
		</div>
		<!-- End Pages -->
		
		<div class="clear"></div>
	</section>
	
	<!-- Start Footer -->
			
		<footer style='background-color: #8e080b'>	
			<div style='background-color: #8e080b; min-height:75px;'>		
				<p>Copyright &copy; 2013 White Bird LLC | info@servebartendcook.com</p>
			</div>			
		</footer>

	<!-- End Footer -->	
	</div>
	<!-- End Wrapper -->



<div id="login" title="Log In" style="display:none">
  <div id="pass-form">
    <table>
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
  </div>
  <div id="loader" style="display:none; margin-left:125px;"> Loading... </div>
</div>

<div id="forgot_password_form" title="Retrieve Password" style="display:none">
  <div>
  	Enter your login email to reset your password<br />
    &nbsp; <br />
    <table>
      <tr>
        <td align="right"><b>Email:</b></td>
        <td><input type="text"  id="retrieve_password">
          </br></td>
      </tr>
    </table>
    <div id="password_reset" style="display:none">
    	A new password has been emailed to you.
    </div>
    <div id="wrong_email" style="display:none">
    	No account associated with that email address.
    </div>    
  </div>
</div>

<div id="verification_form" title="Send Verification Email" style="display:none">
  <div>
  	Please enter the email you created an account with.<br />
    &nbsp; <br />
    <table>
      <tr>
        <td align="right"><b>Email:</b></td>
        <td><input type="text"  id="email_verify">
          </br></td>
      </tr>
    </table>
    <div id="verification_sent" style="display:none">
    	Email verification sent, please check all folders.
    </div>
    <div id="bad_email" style="display:none">
    	No account associated with that email address.
    </div>    
  </div>
</div>

</body>

<!--
<script>
$(document).ready(function() {

	$("#back").live("click", function() {
		$("#employer_page").hide();
		$("#employee_page").hide();		
		$("#main_info").show('fast');		
		return false;
	});	
	
	$(".login").click(function() {
		$("#login").dialog("open");		
		return false;
	});
	
	$(".verification").click(function() {
		$("#verification_form").dialog("open");		
		return false;
	});	
		
	$(function() {
		$("#login").dialog({
			autoOpen: false,
			modal: true,
			height: 200,
			width: 400,
			buttons: {
				"Forgot Password": function() {
					$('#login').dialog('close');
					$('#forgot_password_form').dialog('open');					
				},
				"Log In": function() {
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
				}
			}
		});
	});
		
	$(function() {
		$("#forgot_password_form").dialog({
			autoOpen: false,
			modal: true,
			height: 225,
			width: 350,
			buttons: {
				"Send Password": function() {
					email = $("#retrieve_password").attr('value');
					dataString = "email=" + email;
					$.ajax({
						type: "POST",
						url: "forgot_password.php",
						data: dataString,
						success: function(data) {
							if (data == "yes") {
								$('#wrong_email').hide();															
								$('#password_reset').show();
							} else {
								$('#wrong_email').show();								
							}
						}
					});					
				}
			}
		});
	});	
	
	$(function() {
		$("#verification_form").dialog({
			autoOpen: false,
			modal: true,
			height: 225,
			width: 350,
			buttons: {
				"Send Verification Email": function() {
					email = $("#email_verify").attr('value');
					dataString = "email=" + email;
//					alert(dataString);
					$.ajax({
						type: "POST",
						url: "update_profile.php?type=email_verify",
						data: dataString,
						success: function(data) {
							alert(data);
							if (data == "Y") {
								$('#bad_email').hide();															
								$('#verification_sent').show();
							} else {
								$('#bad_email').show();								
							}
						}
					});					
				}
			}
		});
	});			
		
});
</script>
-->
</html>
?>