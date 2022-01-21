<?php
	require_once('classes.php');

	$valid = $_GET['valid_hash'];
	$userID = $_GET['userID'];
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
	<meta name="viewport" content="user-scalable = yes">
	
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
				<ul>
					<li><a href="#" class="login">Login</a></li>
				</ul>				
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
				<h1>Email Verification</h1>
			</div>
			
			<div class="price centered"> <!-- Alignments options: right_align, left_align, centered -->
				<p>Sign up today for Free!</p>	
						<P style="margin-top: 40px; margin-left: 0px;" align="center"><a href="http://facebook.com/servebartendcook"><img src="/images/facebook.png"></a> <a href="http://twitter.com/servebarcook"><img src="/images/twitter.png"></a></P>
			</div>
		
		</div>
		<!-- End App Info -->		
									<!-- Start Pages -->
		<div id="pages">
			<div class="top_shadow"></div>
			
			<!-- Start Home -->
			<div id="home" class="page" style="margin-top: 5px;">
				
		
		<div class="full" id="main_info" style="min-height: 300px;">
					<p>&nbsp;</P>
		
					<p><a href="javascript:;" rel="tipsy" title="Server Jobs"><img src="images/main-server.png" alt=""  style="margin-left: -20px; padding-right: 0px;"/></a> <a href="javascript:;" rel="tipsy" title="Bartending Positions"><img src="images/main-bar.png" alt=""   style="padding-right: 0px;"/></a> <a href="javascript:;" rel="tipsy" title="Chefs and Cooks"><img src="images/main-cook.png" alt="" /> </a></p>
							<p style="margin-top: 15px; font-size: 14px;">ServeBartendCook is a free web application that matches open jobs with qualified hospitality workers based on their experience, skills and location.<br />
							  <b>Learn more:  <a href="#" id='employer_info'>Employer</a> |  <a href="#" id='employee_info'>Employee</a></b><br />
							</P>						
				</div>
				
			<div class="full" id="employer_page" style="min-height: 300px; display:none">
					<p>&nbsp;</P>
							<p style="margin-top: 15px; font-size: 14px;"><h2>Looking for qualified employees for your restaurant or bar?</h2>
							<ul>
								<li style="margin-bottom:5px"><b>Job Matches are Skill Based</b> - Instead of posting a random job description, chose the exact skills and experience required for the position and only qualified candidates will be matched to the position.</li>
								<li style="margin-bottom:5px"><b>Interested Candidates Only</b> - Only receive responses from candidates that are interested in interviewing, no sifting through useless profiles.</li>
								<li style="margin-bottom:5px"><b>Create Multiple Locations</b> - You can have a profile that contains several different locations if you own multiple bars or restaurants.</li>
								<li style="margin-bottom:5px"><b>Notifications</b> - Receive email notifications as soon as a qualified candidate is interested in interviewing for your open position.</li>
							</ul>
								<a href="#" id='back'><b>Back</b></a><br />
							</P>				
			</div>
				
		
			<div class="full" id="employee_page" style="min-height: 300px; display:none">
					<p>&nbsp;</P>
		
							<p style="margin-top: 15px; font-size: 14px;"><h2>Are you a Server, Bartender or Chef?</h2>
							<ul>
								<li style="margin-bottom:5px"><b>Create a Profile</b> - Immediately be matched to jobs that fit your current location, experience and skills.</li>
								<li style="margin-bottom:5px"><b>Remain Anonymous</b> - No one can view your profile unless you request an interview from a specific employer.</li>
								<li style="margin-bottom:5px"><b>Notifications</b> - Get notified by email whenever a new job opening matches your profile.</li>
								<li style="margin-bottom:5px"><b>Printable Resume</b> - Build a professional style resume to take to interviews in a few easy steps.</li>
							</ul>
								<a href="#" id='back'><b>Back</b></a><br />
							</P>				
			</div>			
		</div>	
		
			<!-- End Home -->
					<!-- End Styles -->
			
			<div class="bottom_shadow"></div>
		</div>
		<!-- End Pages -->
		
		<div class="clear"></div>
	</section>
	
	<!-- Start Footer -->
			
		<footer>			
				<p>Copyright &copy; 2015 SBC Industries LLC | info@servebartendcook.com</p>			
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

<div id="signup_employer" title="Employer - Restricted Sign Up" style="display:none">
	<h1>Employer Sign-Up</h1>
  <h3>ServeBartendCook is in Closed Beta; you must have an access code to sign up</h3>
  &nbsp; <br />
  
  <div id="employer_empty_warning" style="display:none"><font color="red">Please complete required fields</font></div>
  <div id="employer_pass_warning" style="display:none"><font color="red">Invalid password length</font></div>
   <div id="employer_duplicate_warning" style="display:none"><font color="red">Email already being used</font></div>
  <div id="employer_email_warning" style="display:none"><font color="red">Invalid email address</font></div>

  &nbsp; <br />
  <div id="pass-form">
    <table>
      <tr>
        <td>Access Code:</td>
        <td><input type="text" id="access" name="access"size="30" maxlength="100"/></td>
      </tr>
      <tr>
        <td>First Name:</td>
        <td valign="top"><input type="text" id="firstname" name="firstname" size="16" maxlength="16"/></td>
      </tr>
      <tr>
        <td>Last Name:</td>
        <td valign="top"><input type="text" id="lastname" name="lastname" size="16" maxlength="16"/></td>
      </tr>
      <tr>
        <td>Company:</td>
        <td valign="top"><input type="text" id="company" name="company" size="16" /></td>
      </tr> 
      <tr>
        <td>Position:</td>
        <td valign="top"><input type="text" id="position" name="position" size="16" /></td>
      </tr>   
      <tr>
        <td>Website:</td>
        <td valign="top"><input type="text" id="website" name="website" size="16" />(<i>optional</i>)</td>
      </tr>                                     
      <tr>
        <td>Email address:</td>
        <td><input type="text" id="login_email" name="login_email" size="30" maxlength="100"/></td>
      </tr>
      <tr>
        <td>Password <br />
          (between 6 and 12 chars):</td>
        <td valign "top"><input type="password" id="set_password" name="password" size="16" maxlength="12"></td>
      </tr>
      <tr><td colspan="2"> &nbsp; </td></tr>
      <tr><td colspan="2"><b>By signing up as a user, you agree to the following:  <a href="/documents/Conditions of Use.pdf">Terms of Use</a>, <a href="/documents/Privacy Policy.pdf"> Privacy Policy</a>, <a href="/documents/Beta Agreement.pdf">Beta Test Agreement</a></b></td></tr>
    </table>
  </div>
  <div id="loader" style="display:none; margin-left:125px;"> Loading......  </div>
</div>

<div id="signup_employee" title="Employee - Restricted Sign Up" style="display:none">
	<h1>Employee Sign-Up</h1>
  <h3>ServeBartendCook is in Closed Beta; you must have an access code to sign up</h3>
  &nbsp; <br />
  
  <div id="employee_empty_warning" style="display:none"><font color="red">Please complete required fields</font></div>
  <div id="employee_zip_warning" style="display:none"><font color="red">Please use a valid zip code</font></div>
  <div id="employee_pass_warning" style="display:none"><font color="red">Invalid password length</font></div>
  <div id="employee_city_warning" style="display:none"><font color="red">Please choose a city and state</font></div>
   <div id="employee_duplicate_warning" style="display:none"><font color="red">Email already being used</font></div>
  <div id="employee_email_warning" style="display:none"><font color="red">Invalid email address</font></div>

  &nbsp; <br />
  <div id="pass-form">
    <table>
      <tr>
        <td>Access Code:</td>
        <td><input type="text" id="access_2" name="access"size="30" maxlength="100"/></td>
      </tr>
      <tr>
        <td>First Name:</td>
        <td valign="top"><input type="text" id="firstname_2" name="firstname" size="16" maxlength="16"/></td>
      </tr>
      <tr>
        <td>Last Name:</td>
        <td valign="top"><input type="text" id="lastname_2" name="lastname" size="16" maxlength="16"/></td>
      </tr>
			<tr>
				<td>State: &nbsp; </td>
				<td><select name='state' id='state'><option>Choose State</option>
<?php		
				foreach($states_array as $row) {
					echo "<option value='".$row."'>".$row."</option>";
				}
?>
				</select></td>
			</tr>
      <tr>
        <td>City:</td>
        <td valign="top"><div id='city_inner'><i>select a state first</i></div></td></td>
      </tr>
      <tr>
        <td>Zip Code:</td>
        <td valign="top"><input type="text" id="zip" name="zip" size="16" /></td>
      </tr>            
      <tr>
        <td>Phone:</td>
        <td valign="top"><input type="text" id="phone" name="phone" size="16" />(<i>optional</i>)</td>
      </tr>                                     
      <tr>
        <td>Email address:</td>
        <td><input type="text" id="login_email_2" name="login_email" size="30" maxlength="100"/></td>
      </tr>
      <tr>
        <td>Password <br />
          (between 6 and 12 chars):</td>
        <td valign "top"><input type="password" id="set_password_2" name="password" size="16" maxlength="12"></td>
      </tr>
      <tr><td colspan="2"> &nbsp; </td></tr>
      <tr><td colspan="2"><b>By signing up as a user, you agree to the following:  <a href="/documents/Conditions of Use.pdf">Terms of Use</a>, <a href="/documents/Privacy Policy.pdf"> Privacy Policy</a>, <a href="/documents/Beta Agreement.pdf">Beta Test Agreement</a></b></td></tr>
    </table>
  </div>
  <div id="loader" style="display:none; margin-left:125px;"> Loading.... </div>
</div>

</body>

<script>
$(document).ready(function() {

	$("#employer_info").click(function() {
		$("#main_info").hide();
		$("#employer_page").show('slow');
		return false;
	});
	
	$("#employee_info").click(function() {
		$("#main_info").hide();
		$("#employee_page").show('slow');
		return false;
	});

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
		
	$(".signup_employer").click(function() {
		$("#signup_employer").dialog("open");		
		return false;
	});
	
	$(".signup_employee").click(function() {
		$("#signup_employee").dialog("open");		
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
		$("#signup_employer").dialog({
			autoOpen: false,
			modal: true,
			height: 600,
			width: 400,
			buttons: {
				"Sign Up": function() {
					$('#pass-form').hide();
					$('#loader').show();					
					access = $('#access').attr('value');
					first = $('#firstname').attr('value');
					last = $('#lastname').attr('value');
					company = $('#company').attr('value');
					position = $('#position').attr('value');
					website = $('#website').attr('value');					
					login_email = $('#login_email').attr('value');
					set_password = $('#set_password').attr('value');
					dataString = "access=" + access + "&first=" + first + "&last=" + last+ "&company=" + company + "&position=" + position + "&website=" + website + "&login=" + login_email + "&pass=" + set_password;
					//alert(dataString);
					if (access.length == 0 || first.length == 0 || last.length == 0 || company.length == 0 || position.length == 0 || login_email.length == 0 || set_password.length == 0) {
						$('#employer_empty_warning').show();
					} else if (set_password.length > 12 || set_password.length < 6) {
						$('#employer_pass_warning').show();
					} else {
						$.ajax({
							type: "POST",
							url: "register_new.php?type=employer",
							data: dataString,
							success: function(data) {
								//alert(data);
								if (data == "access") {
									$('#loader').hide();
									$('#pass-form').show();	
									$('#employer_access_warning').show();
								} else if (data == "email") {
									$('#loader').hide();
									$('#pass-form').show();	
									$('#employee_email_warning').show();
								} else if (data == "duplicate") {
									$('#loader').hide();
									$('#pass-form').show();	
									$('#employee_duplicate_warning').show();
								} else {
									$('#loader').hide();
									$('#signup').dialog('close');
										dataString = "user=" + login_email + "&pass=" + set_password;
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
					}					
				}
			}
		});
	});
	
	$(function() {
		$("#signup_employee").dialog({
			autoOpen: false,
			modal: true,
			height: 650,
			width: 400,
			buttons: {
				"Sign Up": function() {
					$('#pass-form').hide();
					$('#loader').show();					
					access = $('#access_2').attr('value').trim();
					first = $('#firstname_2').attr('value').trim();
					last = $('#lastname_2').attr('value').trim();
					state = $('#state').attr('value');
					city = $('#city').attr('value');
					zip = $('#zip').attr('value').trim();
					phone = $('#phone').attr('value').trim();										
					login_email = $('#login_email_2').attr('value').trim();
					set_password = $('#set_password_2').attr('value').trim();
					dataString = "access=" + access + "&first=" + first + "&last=" + last+ "&state=" + state + "&city=" + city + "&zip=" + zip + "&phone=" + phone + "&login=" + login_email + "&pass=" + set_password;
					//alert(dataString);
					if (access.length == 0 || first.length == 0 || last.length == 0 || zip.length == 0 || login_email.length == 0 || set_password.length == 0) {
						$('#employee_empty_warning').show();
					} else if (isNaN(zip) == true || zip.length != 5) {
						$('#employee_zip_warning').show();
					} else if (set_password.length > 12 || set_password.length < 6) {
						$('#employee_pass_warning').show();
					} else if (city == undefined) {
						$('#employee_city_warning').show();						
					} else {
						$.ajax({
							type: "POST",
							url: "register_new.php?type=employee",
							data: dataString,
							success: function(data) {
								//alert(data);
								if (data == "access") {
									$('#loader').hide();
									$('#pass-form').show();	
									$('#employee_access_warning').show();
								} else if (data == "email") {
									$('#loader').hide();
									$('#pass-form').show();	
									$('#employee_email_warning').show();
								}  else if (data == "duplicate") {
									$('#loader').hide();
									$('#pass-form').show();	
									$('#employee_duplicate_warning').show();
								} else {
									$('#loader').hide();
									$('#signup').dialog('close');
										dataString = "user=" + login_email + "&pass=" + set_password;
										$.ajax({
											type: "POST",
											url: "login_verify.php",
											data: dataString,
											success: function(data) {
												//alert("data" + data);
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
					}				
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
	
	
					$("#state").change(function() {
						new_state = $('#state').attr('value');
						dataString = "state=" + new_state;
					  	$.ajax({
							type: "POST",
							url: "update_profile.php?type=get_city",
							data: dataString,
							success: function(data) {
								//alert(data);
								$("#city_inner").replaceWith(data);
								}
						});					
					});	
					 					
	
	
});
</script>
</html>