<?php
function index_html_mobile($email, $refID, $cmp, $rgn, $ste, $dmg, $ad, $msc_a, $msc_b) {
		$url_tags = "refID=".$refID."&CMP=".$cmp."&RGN=".$rgn."&STE=".$ste."&DMG=".$dmg."&AD=".$ad."&MSCA=".$msc_a."&MSCB=".$msc_b;						
?>
	<!-- Start Wrapper -->
		<!-- Start App Info -->
	
		<div style="margin-top:150px; height:100%; padding-bottom:40px;">
		
			<!-- End Logo -->
			<h2 style="color:#4D0002; text-align:center; margin-top:5px;"><i>The Finest Hospitality Jobs</i></h2>

			<div style="text-align:center;">
			
				<div id='server_warning' style='float:left; width:100%; color:red; margin-bottom:5px; margin-top:5px; display:none'>
					<h3 style=' color:red; margin-bottom:-5px;'>NOTICE:  We are currently experiencing server problems.  The site will not function properly, please log in at another time</h3>
					
					<b>We apologize for the inconvenience, we are working to resolve this issue</b><br />	
				</div>		
			
				<div id="main-buttons">
					<a href='#' id='signup'><img src="images/button-signup.png"></a> <a href='index.php?page=login'><img src="images/button-login.png"></a>
				</div>
				<div id="signup-buttons" style="display:none; text-align:center; margin-bottom:160px;">
					<h1>Account Type</h1>
					
			    	<a href="index.php?page=employer_signup&<? echo $url_tags ?>" class="btn btn-large btn-warning">Employer</a> <a href="index.php?page=employee_signup&<? echo $url_tags ?>" class="btn btn-large btn-warning">Employee</a><br />				
			    	&nbsp; <br />
			    	<a href="#" id='signup_back'>Back</a><br />
				</div>
				
						
			<div class="page" id="main-info" style="text-align:center; margin-left:35px; margin-right:35px;">
				<p style="margin-top: 25px; font-size: 16px;">ServeBartendCook is a free web application that matches open jobs with qualified hospitality workers based on their experience, skills and location.<br />
				&nbsp; <br />
				<b>Learn more:</b><br />
								&nbsp; <br />
				  <a href="index.php?page=employer_info" class='btn btn-warning'>Employer</a>  <a href="index.php?page=employee_info" class='btn btn-warning'>Employee</a><br />
				</P>	
				
				<div> <!-- Alignments options: right_align, left_align, centered -->
							<b><a href="http://servebartendcook.com/blog">SBC BLOG</a></b>
							<P style="margin-top: 20px; margin-left: 0px;" align="center"><a href="http://facebook.com/servebartendcook"><img src="images/facebook.png"></a> <a href="http://twitter.com/servebarcook"><img src="images/twitter.png"></a>
							<br />
							&nbsp; <br />
							<a href="index.php?page=help" id='help' >Help</a>
				</div>											
			</div>
		</div>
		<!-- End App Info -->		
		
	
	<!-- Start Footer -->
			
	<div id="red-footer">
				&nbsp; <br />
				<span style='color:white; margin-top;3px;'>Copyright &copy; 2015 SBC Industries, LLC</span><br /> 
				<a href="http://servebartendcook.com/index.php?page=privacy_policy">Privacy Policy</a> | <a href="http://servebartendcook.com/index.php?page=TOS">Terms of Use</a><br />		
				<span style='color:white'>info@servebartendcook.com</span>
	</div>

	<!-- End Footer -->	
	</div>
	<!-- End Wrapper -->
<?php		
}

function index_html_mobile_signup($type, $refID, $cmp, $rgn, $ste, $dmg, $ad, $msc_a, $msc_b) {	
	switch($type) {
		case "employer":
?>
		<div style="float:left; width:90%; padding-left:10px; padding-right:10px;">
			<h1 style="text-align:center">Employer Sign-Up</h1>
			<span style="font-family: 'Nothing You Could Do', cursive; text-align:center; margin-bottom:15px;"><h3>Hiring for your business?</h3></span>	


		  <div id="employer_empty_warning" class="warning" style="display:none; width:100%; text-align:center;"><font color="red"><b>NOTICE: Please complete required fields</b></font></div>
		  <div id="employer_email_retype_warning" class="warning" style="display:none; width:100%; text-align:center;"><font color="red"><b>NOTICE: Emails do not match</b></font></div>  
		  <div id="employer_pass_warning" class="warning" style="display:none; width:100%; text-align:center;"><font color="red"><b>NOTICE: Invalid password length</b></font></div>
		  <div id="employer_duplicate_warning" class="warning" style="display:none; width:100%; text-align:center;"><font color="red"><b>NOTICE: Email already being used</b></font></div>
		  <div id="employer_email_warning" class="warning" style="display:none; width:100%; text-align:center;"><font color="red"><b>NOTICE: Invalid email address</b></font></div>
		  <div id="employer_pass_check_warning" class="warning" style="display:none; width:100%; text-align:center;"><font color="red"><b>NOTICE: Passwords do not match</b></font></div>
		  <div id="permission_warning" class="warning" style="display:none; width:100%; text-align:center;"><font color="red"><b>NOTICE: You must check the box below to continue</b></font></div>
		  <div id="error" class="warning" style="display:none; width:100%; text-align:center;"><font color="red"><b>NOTICE: There was an error processing your request.  Please try again later or contact admin@servebartendcook.com</b></font></div>
			
		   <input type="hidden" id="access_2" name="access" value="catscradle"/>  
		  <div id="sign_up_form" tyle="float:left; width:100%;">
		  		<div style="float:left; width:100%; margin-bottom:15px;">
		        	<div style="float:left; width:95%; padding-top:15px;"><input type="checkbox" id="permission" value="18" ><br /><b>I certify that I represent the company entered below and have the right and/or permission to make hiring decisions or recommendations.</b></div>
				</div>
					
		        <b style='font-size:14pt'>First Name</b><br />
		        <input type="text" id="firstname" name="firstname" style='width:100%; margin-bottom:10px;'/><br />	        

		        <B style='font-size:14pt'>Last Name</B><br />
		        <input type="text" id="lastname" name="lastname" style='width:100%; margin-bottom:10px;' maxlength="16"/><br />     

		       <B style='font-size:14pt'>Company</B><br />
		        <input type="text" id="company" name="company" style='width:100%; margin-bottom:10px;' /><br />       

		        <B style='font-size:14pt'>Your Title</B><br />
		        <input type="text" id="position" name="position" style='width:100%; margin-bottom:10px;' placeholder="owner, manager, etc" /><br />        

		        <B style='font-size:14pt'>Website</B><br />
		        <input type="text" id="website" name="website" style='width:100%; margin-bottom:10px;' placeholder="optional" /><br />        

		        <B style='font-size:14pt'>Email address</B><br />
		        <input type="text" id="login_email_1" name="login_email_1" style='width:100%; margin-bottom:10px;' maxlength="100"/><br />     

		        <B style='font-size:14pt'>Re-type Email</B><br />
		        <input type="text" id="login_email_1_retype" name="login_email_1_retype" style='width:100%; margin-bottom:10px;' maxlength="100"></br />   

		        <B style='font-size:14pt'>Password</B><br />
		        <input type="password" id="set_password" name="password" style='width:100%; margin-bottom:10px;' maxlength="12" placeholder="between 6 and 12 chars"><br />	        

		        <B style='font-size:14pt'>Re-type Password</B><br />
		        <input type="password" id="check_set_password" name="password" style='width:100%; margin-bottom:10px;' maxlength="12"><br />        

				By clicking "Submit", you agree to the following:</br>  <b><a href="index.php?page=TOS">Terms of Service</a>, <a href="index.php?page=privacy_policy"> Privacy Policy</a></b>

		  </div>
		  &nbsp; <br />
		  
		  <div style="margin-bottom:15px; text-align:center;"><a href="#" id="signup_employer" class="signup_button btn btn-large btn-primary">SUBMIT</a></div>		  
		  <div id="loader" style="display:none; text-align:center; width:100%;"><h2>Loading....</h2> </div>
		</div>   
<?php
		break;
		
		case "employee":
?>
		<div style="float:left; width:90%; padding-left:10px; padding-right:10px;">
			<h1 style="text-align:center">Employee Sign-Up</h1>
			<span style="font-family: 'Nothing You Could Do', cursive; text-align:center; margin-bottom:15px;"><h3>Looking for a new job?</h3></span>	

				  <div id="employee_empty_warning" class="warning" style="display:none; width:100%; text-align:center;"><font color="red"><b>NOTICE: Please complete required fields</b></font></div>
				  <div id="employee_email_retype_warning" class="warning" style="display:none; width:100%; text-align:center;"><font color="red"><b>NOTICE: Emails do not match</b></font></div>    
				  <div id="employee_zip_warning" class="warning" style="display:none; width:100%; text-align:center;"><font color="red"><b>NOTICE: Please use a valid zip code</b></font></div>
				  <div id="employee_pass_warning" class="warning" style="display:none; width:100%; text-align:center;"><font color="red"><b>NOTICE: Invalid password length</b></font></div>
				  <div id="employee_invalid_zip_warning" class="warning" style="display:none; width:100%; text-align:center;"><font color="red"><b>NOTICE: The zip code entered is either invalid or a military zip code</b></font></div>
				  <div id="employee_duplicate_warning" class="warning" style="display:none; width:100%; text-align:center;"><font color="red"><b>NOTICE: Email already being used</b></font></div>
				  <div id="employee_email_warning" class="warning" style="display:none; width:100%; text-align:center;"><font color="red"><b>NOTICE: Invalid email address</b></font></div>
				  <div id="employee_pass_check_warning" class="warning" style="display:none; width:100%; text-align:center;"><font color="red"><b>NOTICE: Passwords do not match</b></font></div>
				  <div id="age_warning" class="warning" style="display:none; width:100%; text-align:center;"><font color="red"><b>NOTICE: You must be over 18 to use this site</b></font></div>
				  <div id="error" class="warning" style="display:none; width:100%; text-align:center;"><font color="red"><b>NOTICE: There was an error processing your request.  Please try again later or contact admin@servebartendcook.com</b></font></div>
			
		   <input type="hidden" id="access_2" name="access" value="catscradle"/>  
		  <div id="sign_up_form" tyle="float:left; width:100%;">
		  		<div style="float:left; width:100%; margin-bottom:15px; padding-left:5px;">
		        	<div style="float:left; width:98%;"><input type="checkbox" id="age" value="18"><br /> <b>I certify that I am at least 18 years of age.</b></div>
				</div>

		        <b style='font-size:14pt'>First Name</b> <br />
		        <input type="text" id="firstname_2" name="firstname" style='width:100%; margin-bottom:10px;' maxlength="10"/><br />

		        <b style='font-size:14pt'>Last Name</b> <br />
		        <input type="text" id="lastname_2" name="lastname" style='width:100%; margin-bottom:10px;' maxlength="16"/><br />

		        <b style='font-size:14pt'>Zip Code</b> <br />
		        <input type="text" id="zip" name="zip" style='width:100%; margin-bottom:10px;' /><br />

		        <b style='font-size:14pt'>Phone</b> <br />
		        <input type="text" id="phone" name="phone" style='width:100%; margin-bottom:10px;' placeholder="optional"><br />

		        <b style='font-size:14pt'>Email Address</b> <br />
		        <input type="text" id="login_email_2" name="login_email" style='width:100%; margin-bottom:10px;' maxlength="100"/><br />

		        <b style='font-size:14pt'>Re-type Email</b> <br />
		        <input type="text" id="login_email_2_retype" name="login_email_retype" style='width:100%; margin-bottom:10px;' maxlength="100"/><br />

		        <b style='font-size:14pt'>Password</b> <br />
		        <input type="password" id="set_password_2" name="password" style='width:100%; margin-bottom:10px;' maxlength="12" placeholder="between 6 and 12 chars"><br />

		        <b style='font-size:14pt'>Re-Type Password</b> <br />
		        <input type="password" id="check_set_password_2" name="password" style='width:100%; margin-bottom:10px;' maxlength="12"><br />

				By clicking "Submit", you agree to the following:</br>  <b><a href="index.php?page=TOS">Terms of Service</a>, <a href="index.php?page=privacy_policy"> Privacy Policy</a></b></td></tr>
		  </div>
		  &nbsp; <br />
		  <div style="margin-bottom:15px; text-align:center;"><a href="#" id="employee_signup" class="signup_button btn btn-large btn-primary">SUBMIT</a></div>		  
		  <div id="loader" style="display:none; text-align:center;"><h2>Loading....</h2> </div>

		</div>

<?php		
		break;
	}
	
?>
			<div id="signup_complete" style="display:none; margin-left:5px; min-height:500px; margin-right:1px; width:98%; float:left;">
			  <div>
			  	&nbsp; <br />			  
			  	<b>Almost Finished....</b>
			  	&nbsp; <br />
			  	A verification email has been sent to you.  Please open your email and follow the included link to verify your email address and login.  <i><b>Be sure to check your Spam Folder</b></i>.<br />
			    &nbsp; <br />
			  </div>
			</div>

<?php	
}	

function index_html_mobile_info($type) {	

	switch($type) {
		case "employer":
?>
			<div class="page" id="employer_page" style="margin-left:15px; margin-right:15px; ">
					<p>&nbsp;</P>				
					<span style="font-family: 'Nothing You Could Do', cursive; text-align:center;"><h2>Are you hiring? - How it works...</h2></span>	
				
						   <div class="bubble">
							<img src="images/icon-check.png" style="float: right;"><h2 style="margin-top:0px;">Post a Job</h2>
							 Create a job post that includes specific skill requirements and experience tailored to your needs.  Job posts are free.
							</div>

							<div class="bubble">
							<img src="images/icon-match.png" style="float: right"><h2 style="margin-top:0px">Find Candidates</h2>
							A notice will immediately be sent to all potential candidates that have the exact skills you've included in your job post.  You will be notified regarding interested candidates and be able to view their resume and contact info.<br />
							&nbsp; <br />
							Responses are fast and accurate.
							</div>
							
							<div class="bubble">
							<img src="images/icon-locations.png" style="float: right"><h2 style="margin-top:0px">Manage Locations</h2>
							 You can manage hiring at multiple locations through a single account.  Jobs will only match to candidates in the area specific to the store location.
							</div>
				
						<p style="margin-top: 40px; margin-left: 30px;">If you have questions or concerns, email us at:  <b>admin@servebartendcook.com</b></p>					
			</div>
<?php
		break;
		
		case "employee":
?>
			<div class="page" id="employee_page" style="margin-left:15px; margin-right:15px;">
					<p>&nbsp;</P>
		
					<span style="font-family: 'Nothing You Could Do', cursive; text-align:center;"><h2>Need a Job? - How it works...</h2></span>	
						
						    <div class="bubble">
							<img src="images/icon-check.png" style="float: right;"><h2 style="margin-top:0px">Create a Profile</h2>
								You'll be guided through a few simple steps to create a quality profile that highlights your skills and experience.
							</div>

							<div class="bubble">
							<img src="images/icon-match.png" style="float: right"><h2 style="margin-top:0px">Get Matched</h2>
								You'll be matched to job opportunities that meet your specific requirements and are located in your area.
							</div>
							
								<div class="bubble">
							<img src="images/icon-anonymous.png" style="float: right"><h2 style="margin-top:0px">Remain Anonymous</h2>
								Your profile is completely <b>private</b>.  The only way anyone can see your profile or contact information, or even know you are on the site, is when you request an interview from a specific employer.
							</div>
							
								<div class="bubble">
							<img src="images/icon-notifications.png" style="float: right"><h2 style="margin-top:0px">Notifications</h2>
								 Get notified by email whenever a new job opening matches your profile.
							</div>
			</div>			

<?php
		break;
	}
}

function index_html_mobile_login($device, $email) {
			if (isset($_GET['ID']) && is_numeric($_GET['ID'])) {
				$jobID = $_GET['ID'];
				$public_hash = $_GET['ref'];				
			} else {
				$jobID = "NA";
				$public_hash = "NA";				
			}
?>
		<div id="login_page" class="page" style="font-size:14pt; text-align:center; margin-bottom:80px; width:99%;">
			<h1>Login</h1>
			<div id="invalid_login" style="display:none">
				<font color="red">Invalid Login or Password</font>
			</div>		
			<div id="deactivation_warning" style="display:none">
				<font color="red"><b>This account has been deactivated.  Please contact admin@servebartendcook.com for more information.</b></font>
			</div>
			<div id="error" style="display:none">
				<font color="red"><b>Error processing your request.  Try again later, or email admin@servebartendcook.com</b></font>
			</div>
			
			<div id="delay_holder"></div>		
				
		  <div id="pass-form">
		    <table align="center">
		      <tr>
		        <td align="right">Email:</td>
		        <td><input type="text" id="blip" value="<? echo $email ?>">
		          </br></td>
		      </tr>
		      <tr>
		        <td align="right">Pass:</td>
		        <td><input type="password" id="login_pass"></td>
		      </tr>
		    </table>
		    &nbsp; <br />
		   <input type='hidden' id='jobID' value='<? echo $jobID ?>'>
		  <input type='hidden' id='public_hash' value='<? echo $public_hash ?>'>
		  <input type='hidden' id='type' value='<? echo $device ?>'>		  

		    <div id='login_holder' style='text-align:center'>
		    	<a href="#" class="btn btn-large btn-primary" id='login-submit'>Login</a><br />
		    	&nbsp; <br />
		    	<a href="index.php?page=help">Forgot Password</a> 
		    </div>
		    
		 	 <div id='login_loader' style='display:none'>
				  	<b>LOADING....</b>
			</div>

		  </div>
		</div>
<?php	
}

function index_html_mobile_currently_logged_in($jobID, $device) {
	if ($device == "mobile") {
		$_SESSION['device'] = "mobile";
	} else {
		$_SESSION['device'] = "full";		
	}


 		$member = new Member($_SESSION['userID']);
 		
 		//check if profile is complete and link to correct page
 		$member_data = $member->get_member_data();
 		$profile_status = $member_data['profile_status'];
		$profile_type = $member_data['type'];
		if ($profile_type == "employer") {
	 		$profile_status = "complete";			
		}
 		
?>
		<div id="login_page" class="page" style="font-size:14pt; text-align:center; margin-bottom:80px;">
		    	&nbsp; <br />
			<h4>You are currently logged in</h4>
		  <div id="pass-form">
		    
		    <div id='login_holder'>
		    	&nbsp; <br />
		    	&nbsp; <br />
<?php
		if ($profile_status == "complete") {
			if ($type == "employee" && $jobID != "" && $jobID != "NA") {
				echo  "<a href='job.php?ID=".$jobID."' class='btn btn-large btn-primary' style='margin-bottom:20px;'>Continue to Site</a><br />";				
			} else {
				echo  "<a href='main.php' class='btn btn-large btn-primary' style='margin-bottom:20px;'>Continue to Site</a><br />";
			}		
		} else {
		   echo  "<a href='employee.php' class='btn btn-large btn-primary' style='margin-bottom:20px;'>Continue to Site</a><br />";			
		}
?>
		    </div>
		    
		 	 <div id='login_loader'>
		    	&nbsp; <br />
		    	&nbsp; <br />
				  <a href='#' id='logout'>Logout</a>
			</div>

		  </div>
		</div>
<?php	
}				


function index_html_mobile_help() {
?>
			<div class="page" id="help_page" style="text-align:center; margin-bottom:80px;">
					<p>&nbsp;</P>
							<p style="margin-top: 15px;"><h2>Need Help?</h2>
								&nbsp; <br />							
								<a href='#' class="new_page btn btn-warning" id='forgot_password'>Forgot Password</a><br />
								&nbsp; <br />
								<a href='#' class="new_page btn btn-warning" id='verification'>Re-send Verification Email</a><br />
								&nbsp; <br />								
								<h4>Contact: admin@servebartendcook.com</h4><br />
							</P>				
			</div>				

			<div id="deactivation_warning" style="display:none">
				<font color="red"><b>This account has been deactivated.  Please contact admin@servebartendcook.com for more information.</b></font>
			</div>
				<div id="pass_error" style="display:none">
					<font color="red"><b>Error processing your request.  Try again later, or email admin@servebartendcook.com</b></font>
				</div>			    

			<div id="forgot_password_page" class="page" style="display:none; font-size:14pt; text-align:center; margin-bottom:100px;">
			  <div id="mobile_pass_form">
			    &nbsp; <br />			  
			  	Enter your login email to reset your password<br />
			    &nbsp; <br />
			    <table align="center">
			      <tr>
			        <td align="right"><b>Email:</b></td>
			        <td><input type="text"  id="email_reset">
			          </br></td>
			      </tr>
			    </table>
			    <div id="password_reset" style="display:none">
			    	<b>A password reset link has been emailed to you.</b><br />
			    	<i>The link will only be valid for 48 hours</i>
			    </div>
			    <div id="wrong_email" style="display:none">
			    	No account associated with that email address.
			    </div>
			    <div id="verification_warning" style="display:none">
			    	You haven't verified your email address. <br /><a href='index.php?page=help'>Click here to resend verification email.</a>
			    </div>    			        
				  &nbsp; <br />
				  <div id='forgot_pass_holder'>
				 	 <a href="#" class="btn btn-large btn-primary" id='password_reset_button'>Submit</a> <a href="#" class="btn btn-large btn-primary" id='help_back'>Back</a><br />			  
				  </div>
				  
				  <div id='pass_loader' style='display:none'>
				  	<b>LOADING....</b>
				  </div>
				  &nbsp; <br />
				  
				</div>  
			</div>

			<div id="verification_page" class="page" style="display:none; font-size:14pt; text-align:center; margin-bottom:80px;">
			  <div id="verification_form">
			  	Please enter the email you created an account with.<br />
			    &nbsp; <br />
			    <table align="center">
			      <tr>
			        <td align="right"><b>Email:</b></td>
			        <td><input type="text"  id="email_verification">
			          </br></td>
			      </tr>
			    </table>
			    <div id="verification_sent" style="display:none">
			    	<font color="red">Email verification sent, please check all folders.</font>
			    </div>
			    <div id="bad_email" style="display:none">
			    	No account associated with that email address.
			    </div> 
				<div id="error" style="display:none">
					<font color="red"><b>Error processing your request.  Try again later, or email admin@servebartendcook.com</b></font>
				</div>			    
			     
			  		&nbsp; <br />
				  <div id='verification_holder'>			  		
				  	<a href="#" class="btn btn-large btn-primary" id='verification_button'>Submit</a> 	<a href="#" class="btn btn-large btn-primary" id='help_back'>Back</a><br />			  
				  </div>
				
				  <div id='verification_loader' style='display:none'>
				  	<b>LOADING....</b>
				  </div>
				
				  &nbsp; <br />			      
			  </div>
			  
			</div>
<?php
}
	
function mobile_privacy_policy() {
?>
	<div style='float:left;width:100%; margin-left:3px; margin-right:2px;'>
					
						<h3>PRIVACY POLICY</h3>
						<i>Updated May 22, 2015</i><br />
<p>We protect your personal information  that you provide to us using industry-standard safeguards. We only share your  information with your consent or as required by law.<br />
</p>
<p>&nbsp;</p>
<p><strong>1.  What information we collect</strong></p>
<p>Our Privacy Policy applies to anyone  with a ServeBartendCook account. </p>
<p>When you create an account with us,  you provide us with information (including your name, email address, and  password) that we use to offer you a personalized, relevant experience on  ServeBartendCook.</p>
<p>&nbsp;</p>
<p><strong>A.  Registration </strong></p>
<p>&nbsp;</p>
<p>JOB SEEKER:</p>
<p>&nbsp;</p>
<p>To create an account on  ServeBartendCook you must provide us with your email address (which will be  used as your login username) first name, last name, zip code and a  password. You may optionally provide a  contact phone number during initial registration.</p>
<p>In order to utilize ServeBartendCook  to find job openings, you will need to complete a Profile. At a minimum, you will need to add at least  one &ldquo;Skill&rdquo; and one &ldquo;Specialty&rdquo; to your profile by following the steps provided  in the &ldquo;Profile&rdquo; section of the account. Additionally, you may optionally add descriptions of your experience regarding  each skill or specialty, past employment information and any certifications,  degrees or awards to further aid ServeBartendCook in finding open jobs that  match your qualifications.</p>
<p>This information will only be seen  by employers from whom you request an interview.</p>
<p>&nbsp;</p>
<p>EMPLOYERS:</p>
<p>&nbsp;</p>
<p>To create an account on  ServeBartendCook you must provide us with an email address (which will be  used as your login username) first name, last name, company you represent, your  position within that company and a password.</p>
<p>In order to utilize ServeBartendCook  to post a job and find qualified candidates you will be required to enter  details about each establishment for which you will be hiring. You will need to provide a name for that  location, a physical address, and the type of business (selected from a drop  down list). Optionally, you may provide  a website as well.</p>
<p>When posting a job, you will be  required to provide general details about the job itself which include required  skills and specialties (chosen from lists provided), a general description of  responsibilities and requirements, whether the position offers benefits,  whether the position is full time, part time, or temporary and compensation details.</p>
<p>All of your profile, establishment  and job details will be viewable by any member who is matched with your job  post.</p>
<p>&nbsp;</p>
<p><strong>B.  Cookies</strong></p>
<p>We use cookies and similar  technologies, including mobile device identifiers, to help us recognize you,  improve your ServeBartendCook experience, increase security, measure use of our  Services. A cookie is a small piece of data  that a Website transfers to your computer's hard disk to allow the server to  distinguish your session from that of others while you are connected. Requests  to send cookies are not designed to collect information about you, but only  about your &quot;browser session.&quot; You can control  cookies through your browser settings and other tools.</p>
<p>&nbsp;</p>
<p><strong>C.  Other </strong></p>
<p>ServeBartendCook is an evolving web  application. We are always working on  ways to improve all aspects of the site to offer you more efficient and  effective services. We often introduce new features, some of which may result  in the collection of new information. Furthermore, new partnerships or corporate acquisitions may result in  new features, and we may potentially collect new types of information.</p>
<p>&nbsp;</p>
<p><strong>D.  Advertising </strong></p>
<p>SBC Industries LLC is a participant in the Amazon Services LLC Associates Program, an affiliate advertising program designed to provide a means for sites to earn advertising fees by advertising and linking to amazon.com.</p>
<p>&nbsp;</p>
<p>We use Google AdWords Remarketing to advertise our website and services across the Internet. AdWords remarketing will display relevant ads tailored to you based on what parts of the ServeBartendCook website you have viewed by placing a cookie on your device. 
	THIS COOKIE DOES NOT IN ANYWAY IDENTIFY YOU OR GIVE ACCESS TO YOUR COMPUTER. The cookie is used to say "This person visited this page, so show them ads relating to that page." Google AdWords Remarketing allows us to tailor our 
	marketing to better suit your needs and only display ads that are relevant to you.</p>
<p>&nbsp;</p>
<p>How to Opt Out of Remarketing and Advertising - If you do not wish to participate in our Google AdWords Remarketing, you can opt out by visiting <a href='https://www.google.com/settings/ads/onweb/'>Google's Ads Preferences Manager</a>
You can also opt out of any third-party vendor's use of cookies by visiting <a href='http://www.networkadvertising.org/choices/'>www.networkadvertising.org/choices/</a></p>
<p>&nbsp;</p>
<p><strong>2.  How we use your personal information</strong><br />
When you join ServeBartendCook, you  acknowledge that information you provide on your profile can be seen by others  and used by us as described in this Privacy Policy and our User Agreement.</p>
<p>&nbsp;</p>
<p><strong>A.  Consent to ServeBartendCook Processing Information About You</strong></p>
<p>The personal information you provide  to us may reveal or allow others to identify aspects of your life that are not  expressly stated on your profile (for example, your picture or your name may  reveal your gender). By providing personal information to us when you create or  update your account and profile, you are expressly and voluntarily accepting  the terms and conditions of our User Agreement and freely accepting and  agreeing to our processing of your personal information in ways set out by this  Privacy Policy. Supplying information to us, including any information deemed  &ldquo;sensitive&rdquo; by applicable law, is entirely voluntary on your part. You have the  right to withdraw or modify your consent to our collection and processing of  the information you provide at any time, in accordance with the terms of this  Privacy Policy and the User Agreement, by changing your profile.</p>
<p>We communicate with you using email,  and other ways available to us. We may send you messages relating to the  availability of the Services, security, or other service-related issues. Email  sent over the Internet is not secure and should not be used to communicate  confidential information to us. Please be aware that we cannot guarantee the  confidentiality or security of any information you send to us over the Internet  when using email. We shall not be liable for any breach of confidentiality  resulting from such use of email via the Internet. </p>
<p>&nbsp;</p>
<p><strong>B.  Compliance with Legal Process and Other Disclosures</strong></p>
<p>It is possible that we may need to  disclose personal information, profile information, or information about your  activities as a ServeBartendCook Member when required by law, subpoena, or  other legal process, or if we have a good faith belief that disclosure is  reasonably necessary to (1) investigate, prevent, or take action regarding  suspected or actual illegal activities or to assist government enforcement  agencies; (2) enforce the User Agreement, investigate and defend ourselves  against any third-party claims or allegations, or protect the security or  integrity of our Service; or (3) exercise or protect the rights, property, or  safety of SBC Industries, LLC, our Members, personnel, or others.<br />
  If there is a change in control or  sale of all or part of SBC Industries, LLC, we may share your information with a  third party, who will have the right to use that information in line with this  Privacy Policy.</p>
<p>&nbsp;</p>
  <p><strong>3.  Your Choices &amp; Obligations</strong></p>
<p>You can change your ServeBartendCook  information at any time by editing your profile, or by closing your account.  You can also ask us for additional information we may have about your account.</p>
<p>&nbsp;</p>
<p><strong>A.  Rights to Access, Correct, or Delete Your Information</strong></p>
<p>You have a right to (1) access,  modify, correct, or delete your personal information controlled by  ServeBartendCook regarding your profile, (2) change or remove your  content. You can also contact us for any  account information which is not on your profile or readily accessible to you. </p>
<p>We keep your information for as long  as your account is active or as needed. For example, we may keep certain  information even after you close your account if it is necessary to comply with  our legal obligations, meet regulatory requirements, resolve disputes, prevent  fraud and abuse, or enforce this agreement.</p>
<p>&nbsp;</p>
<p><strong>B.  Data Retention</strong></p>
<p>We retain the personal information  you provide while your account is active or as needed to provide you services.  We may retain your personal information even after you have closed your account  if retention is reasonably necessary to comply with our legal obligations, meet  regulatory requirements, resolve disputes between Members, prevent fraud and  abuse, or enforce this Privacy Policy and our User Agreement. We may retain  personal information, for a limited period of time, if requested by law  enforcement. ServeBartendCook Customer Service may retain information for as  long as is necessary to provide support-related reporting and trend analysis  only, but we generally delete closed account data consistent with Section 3.A.,  except in the case of our plugin impression data, which we de-personalize after  12 months unless you opt out.</p>
<p>Please respect the terms of our User  Agreement, our Policies, and your fellow ServeBartendCook Members.</p>
<p>&nbsp;</p>
<p><strong>C.  Your Obligations</strong></p>
<p>&nbsp;</p>
<p>As a Member, you have certain  obligations to other Members. Some of these obligations are imposed by  applicable law and regulations and others have become commonplace in  communities of like-minded Members such as ServeBartendCook:</p>
<p>&nbsp;</p>
<ul type="disc" style="font-size: 12px; line-height: 20px;">
  <li>You must, at all times, abide by the terms and       conditions of the current Privacy Policy, User Agreement, and other       policies of ServeBartendCook. This includes respecting all intellectual       property rights that may belong to third parties, such as trademarks or       copyrights.</li>
  <li>You must not upload or otherwise disseminate any       information that may infringe on the rights of others or which may be       deemed to be injurious, violent, offensive, racist, or xenophobic, or       which may otherwise violate the purpose and spirit of ServeBartendCook and       its community of Members.</li>
  <li>You must keep your username and password confidential       and not share it with others.</li>
</ul>
<p>Any violation of these guidelines or  those detailed in our User Agreement or elsewhere may lead to the restriction,  suspension, or termination of your account at the sole discretion of White  Bird, LLC.</p>
<p>&nbsp;</p>
<p><strong>4.  Important Information</strong></p>
<p>&nbsp;</p>
<h2>A.  Changes to this Privacy Policy</h2>
<p>We  may change this Privacy Policy from time to time and changes are effective upon posting. Please  check back frequently for updates as it is your sole responsibility to be aware  of changes. We do not provide notices of changes in any manner other than by  posting the changes at this website. </p>
<p>&nbsp;</p>
<p>If you object to any of the changes  to our terms and you no longer wish to use ServeBartendCook, you may terminate your account as set forth in the User Agreement. Unless stated otherwise, our current Privacy Policy applies to all information that we  has about you and your account. Using ServeBartendCook after a notice of changes  has been posted on this website shall constitute consent to the changed terms  or practices.</p>
<p>&nbsp;</p>
<p>We will not share any of your  personal information with third parties for direct marketing. </p>
<p>&nbsp;</p>
<h2>B. Unsubscribe  Policy</h2>
<p>To  unsubscribe from our email lists, a person must send  an email to <u><a href="mailto:unsubscribe@servebartendcook.com">unsubscribe@servebartendcook.com</a></u>. Our unsubscribe process impacts  only the future delivery of electronic mailings disseminated by us on its own behalf. You may still  receive electronic mailings sent on behalf of third parties and your personal  information may still be shared with third parties for use in offline marketing  and data appends, including email appends. </p>
<p>&nbsp;</p>
<p>Unsubscribing  from our electronic mailings will not automatically unsubscribe the information  from third parties. Since third parties maintain separate databases from us you  will need to unsubscribe from each source individually, if desired. This allows  you the freedom to pick and choose which subscriptions to maintain and which to  discontinue. </p>
<p>&nbsp;</p>
<h3>C.Your California  Privacy Rights</h3>
<p>A  California resident who has provided personal information to a business with  whom he/she has established a business relationship for personal, family, or  household purposes (&ldquo;California customer&rdquo;) is entitled to request information  about whether the business has disclosed personal information to any third  parties for the third parties&rsquo; direct marketing purposes. In general, if the  business has made such a disclosure of personal information, upon receipt of a  request by a California customer, the business is required to provide a list of  all third parties to whom personal information was disclosed in the preceding  calendar year, as well as a list of the categories of personal information that  were disclosed.</p>
<p>&nbsp;</p>
<p>However,  under the law, a business is not required to provide the above-described lists  if the business adopts and discloses to the public (in its privacy policy) a  policy of not disclosing customer&rsquo;s personal information to third parties for  their direct marketing purposes unless the customer first affirmatively agrees  to the disclosure, as long as the business maintains and discloses this policy.  Rather, the business may comply with the law by notifying the customer of his  or her right to prevent disclosure of personal information and providing a cost  free means to exercise that right.</a></p>
<p>&nbsp;</p>
<p>We do  not share information with third parties for their direct marketing purposes.  Please note that whenever you opt in to receive future communications from a  third party, including  employers, your information will be subject  to the third party's privacy policy. If you later decide that you do not want  that third party to use your information, you will need to contact the third  party directly, as we have no control over how third parties use information.  You should always review the privacy policy of any party that collects your  information to determine how that entity will handle your information.</p>
<p>&nbsp;</p>
<p>California  customers may request further information about our compliance with this law by  e-mailing <a href="mailto:privacy@servebartendcook.com">privacy@servebartendcook.com</a>.  Please note that we are only required to respond to one request per customer  each year, and we are not required to respond to requests made by means other  than through this e-mail address.</p>
<p>&nbsp;</p>
<h3>D. No  Information Collected from Children.</h3>
 <p>We will never knowingly collect any  personal information about children under the age of 18. If we obtain actual  knowledge that we have collected personal information about a child under the  age of 18, that information will be immediately deleted from our database.  Because it does not collect such information, we have no such information to use or to  disclose to third parties. We have  designed this policy in order to comply with the Children's Online Privacy  Protection Act (&quot;COPPA&quot;).</p>
<p>&nbsp;</p>
  
	<div>

<?php			
}

function mobile_tos() {
?>
		
	<div style='float:left;width:100%; margin-left:3px; margin-right:2px;'>
<p><h3>Terms and Conditions</h3></p>
<i>Updated May 22, 2015</i><br />
<p>By using or registering on the  ServeBartendCook website (the &ldquo;Website&rdquo;), including our mobile  applications, or other information provided as part of the ServeBartendCook  services (the &ldquo;Services&rdquo;) or any services offered by SBC Industries, LLC (the &ldquo;Company&rdquo;), you are  entering into a legally binding agreement with the Company and agree to be  bound by these Terms and Conditions and the Terms and Conditions of the Privacy  Policy of the Website (collectively the &ldquo;Agreement&rdquo;) which terms are incorporated  herein as though fully set forth. You must read and agree with all of the Terms  and Conditions contained in this agreement and the Privacy Policy, which is  incorporated by reference, before you use the Services. If you do not accept  and agree to be bound by these Terms and Conditions and the Privacy Policy, do  not use the Website or Services. </p>
<p>&nbsp;</p>
<p>If you do not  want to register an account and become a ServeBartendCook Member, do not enter  into this Agreement, do NOT click &ldquo;Join Now&rdquo; and do not access, view, download  or otherwise use any ServeBartendCook webpage, information or services. By  clicking &ldquo;Join Now&rdquo; (or &ldquo;Join ServeBartendCook&rdquo; or similar), you acknowledge  that you have read and understood the terms and conditions of this Agreement  and that you agree to be bound by all of its provisions. By clicking &ldquo;Join  Now,&rdquo; you also consent to use electronic signatures and acknowledge your click  of the &ldquo;Join Now&rdquo; button as one.</p>
<p>&nbsp;</p>
<p>These Terms and Conditions may change  from time to time and changes are effective upon posting. Please check back  frequently for updates as it is your sole responsibility to be aware of  changes. We do not provide notices of changes in any manner other than by  posting the changes at this Website.</p>
<p>&nbsp;</p>
<p>The terms &ldquo;You&rdquo;, &ldquo;you&rdquo;, and  &quot;User&quot; as used herein refer to all individuals and/or entities  accessing this website for any reason. You hereby warrant and represent that  you are: (1) are an individual who is  the &ldquo;<strong>Minimum Age</strong>&rdquo; (defined below) or older; (2) are not currently  restricted from the Services, or not otherwise prohibited from having a  ServeBartendCook account, (3) are currently eligible to work in the United  States if you are using the Services to seek employment opportunities; (4) are  not a competitor of ServeBartendCook or are not using the Services for reasons  that are in competition with ServeBartendCook; (5) will only maintain one  ServeBartendCook account at any given time; (6) will use your real name and  only provide accurate information to ServeBartendCook; (7) have full power,  legal capacity, and authority to enter into this Agreement and doing so will  not violate any other agreement to which you are a party; (8) will not violate  any rights of ServeBartendCook or third party, including intellectual property  rights such as copyright or trademark rights; and (9) agree to provide at your  cost all equipment, software, mobile access, and internet access necessary to  use the Services.</p>
<p>&nbsp;</p>
<p>&ldquo;<strong>Minimum Age</strong>&rdquo; means 18  years old. Please note that some state  laws prohibit persons from serving alcohol unless they are of a minimum age,  which may be older than 18 years old. Consequently, a Member who is below that minimum age may not be eligible  for some employment opportunities in those states.<br />
  The Company makes no representation or warranty that the content published on this site complies with the local laws of your jurisdiction. You are solely responsible  for knowing and understanding your local laws concerning standards of content legality. You further represent and warrant that you understand the nature of the content published on this site, namely, information about employment  opportunities, and that you voluntarily and knowingly choose to view such  material. </p>
<p>&nbsp;</p>
<p>Should you be  unable to affirmatively make the representations and warranties contained  herein, do not use the Services or this Website.</p>
<p>&nbsp;</p>
<p>The Company does not contact employers to verify the identity of the employers or whether the employers are offering legitimate positions which are bona fide jobs. While the Company makes every effort to only  list jobs which employers may want those in the community to know about, we are  not responsible for the accuracy of the jobs and/or the contact information for  those jobs and any consequences to our users that may follow from them applying  to given jobs listed on the Website. The inclusion of links on the Website does  not constitute an endorsement of the employer or a guarantee that a job even  exists with a given employer. The Company assumes no liability whatsoever for  the quality or legality of the jobs posted on its site, or whether or not  employers are actually able to hire a candidate in response to a given job  listing. Furthermore, the Company does not censor any position offered  including, but not limited to, the identity of the employer. </p>
<p>&nbsp;</p>
<p>While we have  taken steps to ensure the accuracy of our job application process, the Company  assumes no liability for the quality, legality or accuracy of your resume,  cover letter, or other materials or our assistance in helping you transmit any  of this information to an employer. </p>
<p>&nbsp;</p>
<p>Information  collected by the Company is limited to information that is applicable to  employers seeking qualified job applicants.&nbsp; The Company does not request  or collect personal information such as social security numbers, checking  account numbers, or credit card numbers and advises visitors and Users of the Website  not to share such information with unknown Internet sites or individuals and to  refrain from including any such information in a resume or job  application.&nbsp; &nbsp;</p>
<p>&nbsp;</p>
<p>1) <strong>Use of Material.</strong> The contents of the Website, such as text, graphics, images, logos, button icons, software and other content  (the &quot;Material&quot;), are protected by applicable intellectual property and  other laws. All Material is the property of the Company or its content  suppliers or clients. The compilation (meaning the collection, arrangement and  assembly) of all content on the Website is the exclusive property of the  Company and is protected  by copyright, trademark, and other laws. </p>
<p>&nbsp;</p>
<p>You must retain all copyright, trademark, service mark, and other proprietary notices contained  in the original Material on any copy (permitted or not permitted) you make of any of the Material. Except  as expressly authorized by the Company, You agree not to modify, copy,  reproduce, sell, display, distribute, or create derivative works based on or contained within the Service or the Company&rsquo;s Material, in whole or in  part. The use of the Material on  any other Website or in a networked computer environment for any purpose is  prohibited. </p>
<p>&nbsp;</p>
<p>The Company grants you a personal,  non-transferable and non-exclusive right and license to use the Material on a  single computer; provided that you do not copy, modify, create a derivative  work of, reserve engineer, decompile, reverse assemble or otherwise attempt to  discover any source code, sell, assign, sublicense, grant a security interest  in or otherwise transfer any right in the Material. You agree not to modify the  Material in any manner or form, or to use modified versions of the Material, including,  without limitation, for the purpose of obtaining unauthorized access to the  Service by any means other than through the interface that is provided by the  Company for use in accessing the Service.</p>
<p>&nbsp;</p>
<p>The Company  reserves the right to terminate the accounts of Users who violate this  Agreement.&nbsp;</p>
<p>&nbsp;</p>
<p>The Company  respects the intellectual property of others, and we ask our Users to do the  same. The unauthorized reproduction, copying, distribution, modification,  public display or public performance of trademarked or copyrighted works  constitutes infringement of the owner's rights. As a condition to your use of  the Website, you agree not to use the Website to infringe the intellectual  property rights of others in any way. The Company will assist the respective owners  of the various intellectual properties in order that they may protect their  rights to the fullest extent of both domestic and international law. We reserve  the right to take these actions at any time, in our sole discretion, with or  without notice and without any liability to any User. &nbsp;</p>
<p>&nbsp;</p>
<p><strong>2. Your Membership.</strong> When you contact the Company, you may be asked to provide the Company with certain personal  information including, without limitation, a valid email address. Please review the Privacy Policy to understand  how the Company uses your Personal Information. You acknowledge and agree that you are solely responsible for the form, content and accuracy of any information placed by you on the Website.
<p>&nbsp;</p>
<p>The profile you create on ServeBartendCook will become part of ServeBartendCook is owned by ServeBartendCook. However, between you  and others, your account belongs to you. You agree to: (1) keep your password  secure and confidential; (2) not permit others to use your account; (3) not use  other&rsquo;s accounts; (4) not sell, trade, or transfer your ServeBartendCook  account to another party; and (5) not charge anyone for access to any portion  of ServeBartendCook, or any information therein. Further, you are responsible  for anything that happens through your account until you close down your  account or prove that your account security was compromised due to no fault of  your own. To close your account, please email <a href="mailto:admin@servebartendcook.com">admin@servebartendcook.com</a>.</p>
<p>You understand and acknowledge  that you have no ownership rights in your account and that if you cancel your  account or your account is terminated, all of your account information,  including resumes, profiles, saved jobs will be marked as deleted in and may be  deleted from the Company&rsquo;s databases and will be removed from any public area  of the Website. Information may continue to be available for some period of  time because of delays in propagating such deletion through the Company&rsquo;s web  servers. In addition, third parties may retain saved copies of your information.</p>
<p><strong>3. Our Rights and Obligations.</strong> We may change or  discontinue Services, and in such case, we do not promise to keep showing or  storing your information and materials.</p>
<p>&nbsp;</p>
<p>For as long as ServeBartendCook  continues to offer the Services, we shall provide and seek to update, improve  and expand the Services. As a result, we allow you to access the Website as it  may exist and be available on any given day and we have no other obligations,  except as expressly stated in this Agreement. We may modify, replace, refuse  access to, suspend or discontinue the Website, partially or entirely, or change  and modify prices for all or part of the Services for you or for all our  Members in our sole discretion. All of these changes shall be effective upon  their posting on the Website. </p>
<p>We reserve the right to withhold,  remove or discard any content available as part of your account, with or  without notice if deemed by us to be contrary to this Agreement. For avoidance  of doubt, we have no obligation to store, maintain or provide you a copy of any  content that you or other Members provide when using the Services.</p>
<p>We have the right to limit the  connections and interactions on the Services.</p>
<p><strong>4. Acceptable Site Use.</strong> The Website may be used  only for lawful purposes by individuals seeking employment and by employers  seeking employees.
<p>&nbsp;</p>
<p><strong>5. Prohibited Uses of the Website.</strong> Users may not  use or reference the Website in order to transmit, distribute, store or destroy  material in violation of any applicable law or regulation, in a manner that  will infringe the copyright, trademark, trade secret or other intellectual  property rights of others or violate the privacy, publicity or other personal  rights of others, or that is defamatory, obscene, threatening, abusive or hateful.  &nbsp;
<p>&nbsp;</p>
<p>Users are  prohibited from:</p>
<p>&nbsp;</p>
<P>(a) - transmit, post, distribute, store or destroy material,  including without limitation ServeBartendCook content, in violation of any  applicable law or regulation, including but not limited to laws or regulations  governing the collection, processing, or transfer of personal information, or  in breach of the Privacy Policy;
<P>(b) - accessing data not intended for such User or logging  into a server or account which the User is not authorized to access;
<P>(c) - imply or state, directly or indirectly, that you are  affiliated with or endorsed by the Company or ServeBartendCook unless you have  entered into a written agreement with the Company or ServeBartendCook (this  includes, but is not limited to, representing yourself as an accredited ServeBartendCook  trainer if you have not been certified by ServeBartendCook as such);
<P>(d) - attempting to probe, scan or test the vulnerability of  a system or network or to breach security or authentication measures without  proper authorization;
<P>(e) - attempting to interfere with service to any User, host  or network, including, without limitation, via means of submitting a virus to  the Website, overloading, &quot;flooding,&quot; &quot;spamming,&quot;  &quot;mailbombing&quot; or &quot;crashing&quot;;
<P>(f) - sending unsolicited email, including promotions and/or  advertising of products or services;
<P>(g) - forging any TCP/IP packet header or any part of the  header information in any email or newsgroup posting;
<P>(h) - using any device, software or routine to interfere or  attempt to interfere with the proper working of the Website or any activity  being conducted on the Website;
<P>(i) - taking any action that imposes an unreasonable or  disproportionately large load on the Website's infrastructure;
<P>(j)- using or attempting to use any engine, software, tool,  agent or other device or mechanism (including, without limitation, browsers,  spiders, robots, avatars and intelligent agents) to navigate, access, or search  the Website other than the search engine and search agents available from the  Company on the Website as well as generally available third-party Web browsers ;
<P>(k) - attempting to decipher, decompile, disassemble or  reverse-engineer any of the software comprising or in any way making up a part  of the Website;
<P>(l) - aggregating, copying or duplicating in any manner any  of the materials or information available from the Website;
<P>(m) - framing of or linking to any of the materials or  information available from the Website unless authorized to do so;
<P>(n) - providing false information of any kind;
<P>(o) - post any content or material that promotes or endorses  false or misleading information or illegal activities, or endorses or provides  instructional information about illegal activities or other activities  prohibited by this Agreement;
<P>(p) - defer any contact from an employer to any agent,  agency, or other third party;
<P>(q) - post content that contains restricted or password-only  access pages, or hidden pages or images;
<P>(r) - solicit passwords or personally identifiable  information from other Users;
<P>(s) - delete or alter any material posted by any other person  or entity;
<P>(t) - harass, incite harassment or advocate harassment of any  group, company, or individual;
<P>(u) - promote or endorse an illegal or unauthorized copy of  another person's copyrighted work, such by as providing or making available  pirated computer programs or links to them, providing or making available  information to circumvent manufacture-installed copy-protect devices, or  providing or making available pirated music or other media or links to pirated  music or other media files;
<P>(v) - use the Services for any unlawful purpose or any  illegal activity, or post or submit any content, resume, or job posting that is  defamatory, libelous, implicitly or explicitly offensive, vulgar, obscene,  threatening, abusive, hateful, racist, discriminatory, of a menacing character  or likely to cause annoyance, inconvenience, embarrassment, anxiety or could  cause harassment to any person or include any links to pornographic, indecent  or sexually explicit material of any kind, as determined by the Company in its  sole and absolute discretion;
<P>(w) -  infringe or use ServeBartendCook brand, logos or  trademarks, including, without limitation, using the word &ldquo;ServeBartendCook&rdquo; in  any business name, email, or URL or including ServeBartendCook trademarks and  logos.</p>
<p>&nbsp;</p>
<p>The Company reserves the right to terminate  the accounts of Users found to be engaging in any of these prohibited uses. Violations  of this Agreement may result in civil or criminal liability. The Company will  investigate occurrences that may involve such violations and will cooperate  with law enforcement authorities in prosecuting Users who are involved in such  violations.</p>
</p>
<p>&nbsp;</p>
<P><strong>6.  User Content  and Contributions.</strong> By submitting  ideas, suggestions, documents, or proposals (&quot;Contributions&quot;) to the  Company through its suggestion or feedback webpages, you acknowledge and agree  that: (a) your Contributions do not contain confidential or proprietary  information; (b) the Company is not under any obligation of confidentiality,  express or implied, with respect to the Contributions; (c) the Company shall be  entitled to use or disclose (or choose not to use or disclose) such  Contributions for any purpose, in any way, in any media worldwide; (d) the  Company may have something similar to the Contributions already under  consideration or in development; (e) you grant the Company a worldwide,  non-exclusive, royalty-free, transferable, sub-licensable license to use,  reproduce, adapt, distribute, exploit, and publish your Contributions; and (f)  you are not entitled to any compensation or reimbursement of any kind from us  under any circumstances. </P>
<p>&nbsp;</p>
<p>You understand that all  information, data, text, software, music, sound, photographs, graphics, video,  advertisements, messages or other materials submitted, posted or displayed by  you on or through the Website (&quot;User Content&quot;) is the sole  responsibility of the person from which such User Content originated. The  Company claims no ownership or control over any User Content. you or a third  party licensor, as appropriate, retain all intellectual property rights to User  Content you submit, post or display on or through the Website and you are  responsible for protecting those rights, as appropriate. </p>
<p>&nbsp;</p>
<p>If you post User Content in any  public area of the Website, you also permit any User to access, display, view,  store and reproduce such User Content for personal use. Subject to the foregoing,  the owner of such User Content placed on the Website retains any and all rights  that may exist in such User Content. The Company may review and remove any User  Content that, in its sole judgment, violates this Agreement or applicable laws,  rules or regulations, is abusive, disruptive, offensive or illegal, or violates  the rights of, or harms or threatens the safety of, Users of the Website. The  Company may take any action with respect to User Content that it deems  necessary or appropriate in its sole discretion if it believes that such User  Content could create liability for the Company, damage the our brands or public  image, or cause the loss of (in whole or in part) the services of its ISPs or  other suppliers.</p>
<p>&nbsp;</p>
<p>We do not represent or guarantee  the truthfulness, accuracy, or reliability of User Content, derivative works  from User Content, or any other communications posted by Users. We do not endorse any opinions expressed by  Users. You acknowledge that any reliance on material posted by other Users will  be at your own risk.</p>
<p>&nbsp;</p>
<p><strong>7.  Disclosure  of User Information.</strong>You  acknowledge, consent and agree that we may access, preserve, and disclose your  registration and any other information you provide in accordance with the terms  of the Privacy Policy, if required to do so by law or in a good faith belief  that such access preservation or disclosure is reasonably necessary in our  opinion to: (1) comply with legal process, including, but not limited to, civil  and criminal subpoenas, court orders or other compulsory disclosures; (2)  enforce this Agreement; (3) respond to claims of a violation of the rights of  third parties, whether or not the third party is a Member, individual, or  government agency; (4) respond to customer service inquiries; or (5) protect  the rights, property, or personal safety of the Company, ServeBartendCook, our  Members, or the public. Disclosures of Member information to third parties,  other than those required to provide customer support, administer this  agreement, or comply with legal requirements, are addressed in the Privacy  Policy </p>
<p>&nbsp;</p>
<p><strong>8.  Notifications  and Service Messages.</strong> For purposes  of service messages and notices about the Services, we may place a banner  notice across its pages to alert you to certain changes such as modifications  to this Agreement. Alternatively, notice may consist of an email from us to an  email address associated with your account, even if we have other contact  information. You also agree that we may communicate with you through your ServeBartendCook account or through other means including email, mobile number  or telephone about your account or services associated with  ServeBartendCook. You acknowledge and  agree that we shall have no liability associated with or arising from your  failure to do so maintain accurate contact or other information, including, but  not limited to, your failure to receive critical information about the Service. </p>
<p>&nbsp;</p>
<p><strong>9. DISCLAIMER  OF WARRANTIES</strong></p>
<p>&nbsp;</p>
<p>YOU EXPRESSLY  UNDERSTAND AND AGREE THAT:</p>
<p>THIS SITE IS FOR  INFORMATIONAL PURPOSES ONLY. THE MATERIAL, SERVICE, AND INFORMATION FOUND ON  THIS SITE ARE PROVIDED &quot;AS  IS,&quot; &quot;WITH ALL FAULTS&quot; AND &quot;AS AVAILABLE,&quot; AND THE  ENTIRE RISK AS TO SATISFACTORY QUALITY, PERFORMANCE, ACCURANCY, AND EFFORT IS  WITH YOU. TO THE MAXIMUM EXTENT PERMITTED BY APPLICABLE LAW, THE COMPANY MAKES  NO REPRESENTATIONS, WARRANTIES OR CONDITIONS, EXPRESS OR IMPLIED. THE COMPANY  DISCLAIMS ANY AND ALL WARRANTIES OR CONDITIONS, EXPRESS, STATUTORY AND IMPLIED,  INCLUDING WITHOUT LIMITATION: WARRANTIES OR CONDITIONS OF MERCHANTABILITY,  FITNESS FOR A PARTICULAR PURPOSE, WORKMANLIKE EFFORT, ACCURACY, TITLE, QUIET  ENJOYMENT, NO ENCUMBRANCES, NO LIENS AND NON-INFRINGEMENT AND WARRANTIES OR  CONDITIONS ARISING THROUGH COURSE OF DEALING OR USAGE OF TRADE. </p>
<p>THERE ARE NO WARRANTIES THAT EXTEND  BEYOND THE FACE OF THIS AGREEMENT.<br />
<p>THE COMPANY DOES NOT WARRANT THAT THE FUNCTIONS OF THE SITE WILL BE  UNINTERRUPTED OR ERROR-FREE, THAT DEFECTS WILL BE CORRECTED, OR THAT THIS SITE  OR THE SERVER THAT MAKES IT AVAILABLE ARE FREE OF VIRUSES OR OTHER HARMFUL  COMPONENTS. THE COMPANY DOES NOT WARRANT OR MAKE ANY REPRESENTATIONS REGARDING  THE USE OR THE RESULTS OF THE USE OF THE MATERIAL IN THIS SITE IN TERMS OF  THEIR CORRECTNESS, ACCURACY, RELIABILITY, OR OTHERWISE. </p>
</p>
<p>&nbsp;</p>
<p><strong>10. DISCLAIMER AND  LIMITATION OF LIABILITY</strong></p>
<p><strong>&nbsp;</strong></p>
<p>YOU EXPRESSLY  UNDERSTAND AND AGREE THAT THE COMPANY AND ITS SUBSIDIARIES, AFFILIATES,  OFFICERS, EMPLOYEES, AGENTS, PARTNERS AND LICENSORS SHALL NOT BE LIABLE TO YOU  FOR ANY PUNITIVE, INDIRECT, INCIDENTAL, SPECIAL, CONSEQUENTIAL OR EXEMPLARY  DAMAGES, INCLUDING, BUT NOT LIMITED TO, DAMAGES FOR LOSS OF PROFITS, GOODWILL,  USE, DATA OR OTHER INTANGIBLE LOSSES (EVEN IF THE COMPANY HAS BEEN ADVISED OF  THE POSSIBILITY OF SUCH DAMAGES), RESULTING FROM: (a) THE USE OR THE INABILITY  TO USE THE COMPANY&rsquo;S SERVICE; (b) THE COST OF PROCUREMENT OF SUBSTITUTE GOODS  AND SERVICES; (c) UNAUTHORIZED ACCESS TO OR ALTERATION OF YOUR TRANSMISSIONS OR  DATA; OR (e) ANY OTHER MATTER RELATING TO THE SERVICE.</p>
<p>THIS DISCLAIMER  OF LIABILITY APPLIES TO ANY DAMAGES OR INJURY CAUSED BY ANY FAILURE OF  PERFORMANCE, ERROR, OMISSION, INTERRUPTION, DELETION, DEFECT, DELAY IN  OPERATION OR TRANSMISSION, COMPUTER VIRUS, ACT OF GOD/ACT OF NATURE,  COMMUNICATION LINE FAILURE, THEFT OR DESTRUCTION OR UNAUTHORIZED ACCESS TO,  ALTERATION OF, OR USE OF RECORD, WHETHER FOR BREACH OF CONTRACT, TORTIOUS  BEHAVIOR, NEGLIGENCE, OR UNDER ANY OTHER CAUSE OF ACTION.</p>
<p>IF YOU ARE  DISSATISFIED OR HARMED BY US OR ANYTHING RELATED TO SERVEBARTENDCOOK, YOU MAY  CLOSE YOUR SERVEBARTENDCOOK ACCOUNT AND TERMINATE THIS AGREEMENT IN ACCORDANCE  WITH SECTION xx (&ldquo;TERMINATION&rdquo;) AND SUCH TERMINATION SHALL BE YOUR SOLE AND  EXCLUSIVE REMEDY.</p>
<p>THE COMPANY  SPECIFICALLY DISCLAIMS ANY LIABILITY, LOSS OR RISK INCURRED DIRECTLY OR  INDIRECTLY BY THE USE OF THE WEBSITE, MATERIAL, AND SERVICES. </p>
<p>THE COMPANY IS NOT INVOLVED WITH  ANY DECISION-MAKING OR OFFERS MADE FROM COMPANIES OTHER THAN ITS OWN. WE DO NOT  GUARANTEE THAT USE OF THE SERVICES WILL RESULT IN EMPLOYMENT OPPORTUNITIES, CONTINUED EMPLOYMENT, OR HIRING OPPORTUNITIES. WE DO NOT GUARANTEE OR WARRANT THE PAYMENT OF WAGES OF ANY AMOUNT. WE DO  NOT VERIFY OR WARRANT THE VERACITY OF ANY COMMUNICATION OR INFORMATION PROVIDED  BY USERS.</p>
<p>&nbsp;</p>
<p><strong>11. EXCLUSIONS  AND LIMITATIONS</strong></p>
<p><strong>&nbsp;</strong></p>
<p>SOME JURISDICTIONS DO NOT ALLOW THE EXCLUSION OF CERTAIN WARRANTIES OR THE  LIMITATION OR EXCLUSION OF LIABILITY FOR INCIDENTAL OR CONSEQUENTIAL DAMAGES.  ACCORDINGLY, SOME OF THE ABOVE LIMITATIONS MAY NOT APPLY TO YOU.</p>
<p>&nbsp;</p>
<p><strong>12. Payment for  Premium Services.</strong> If you purchase  any services that we offer for a fee, either on a one-time or subscription  basis (&ldquo;Premium Services&rdquo;), you agree to the Company and/or ServeBartendCook  storing your payment information. You also agree to pay the applicable fees for  any services offered (including, without limitation, periodic fees for premium  accounts) as they become due plus all related taxes, and to reimburse us for  all collection costs and interest for any overdue amounts. Failure to pay may  result in the termination of your subscription. Depending on where you transact  with us, the type of payment method used and where your payment method was  issued, your transaction with us may be subject to foreign exchange fees or  differences in prices, including because of exchange rates. We do not support  all payment methods, currencies or locations for payment. All applicable taxes  are calculated based on the billing information you provide us at the time of  purchase. We do not guarantee refunds for lack of usage or dissatisfaction. </p>
<p>&nbsp;</p>
<p><strong>13. Links to  Other Sites.</strong> The Website may contain  links to third-party websites. The Company provides these links as a  convenience only and does not endorse any of these sites. The Company is not  responsible for the content of linked third-party sites and does not make any  representations regarding the content or accuracy of materials on such  third-party websites. If you decide to access linked third-party websites, you  do so at your own risk. </p>
<p>&nbsp;</p>
<p><strong>14. No Resale or  Unauthorized Commercial Use.</strong> You  agree not to reproduce, duplicate, copy, sell, trade, resell or exploit for any  commercial purposes, any portion or use of, or access to the Website, Services  or Material.
<p><strong>&nbsp;</strong></p>
<p><strong>15. Termination.</strong> This Agreement will remain in full force  and effect while you are a User of the Website or Services. The Company reserves the right, at its sole  discretion, to terminate this Agreement and your account at any time, with or without notice to you. The Company  reserves the right to pursue all of its legal remedies upon any breach by a  User of this Agreement. </p>
<p>We may restrict, suspend or  terminate the account of any Member who abuses or misuses the Services. Misuse  of the Services includes creating multiple or false profiles; using the  Services commercially without our authorization, infringing any intellectual  property rights, violating any of the terms of this Agreement, or any other  behavior that the Company, in its sole discretion, deems contrary to its  purpose. In addition, and without limiting the foregoing, we have adopted a  policy of terminating accounts of Members who, in our sole discretion, are  deemed to be repeat infringers under the United States Copyright Act.</p>
<p>Upon termination of your account,  you lose access to the Services. The terms of this Agreement shall survive any  termination, except Section 2 (&ldquo;Your Membership&rdquo;).</p>
<p><strong>16. Indemnity.</strong> You agree to indemnify and hold the Company, its subsidiaries,  affiliates, agents, shareholders, officers, contractors, vendors and employees  harmless from any claim or demand, including reasonable attorneys' fees, made  by any third party due to or arising out of your use of the Service or  Material, the violation of the Agreement by you, or the infringement by you, or  any other user of the Service or Material using your computer, of any  intellectual property or other right of any person or entity. The Company  reserves the right to assume the exclusive defense and control of any matter  otherwise subject to indemnification by you. </p>
<p><strong>&nbsp;</strong></p>
<p><strong>17. Intellectual  Property Notices.</strong>The Services include the copyrights and Intellectual property rights of SBC Industries, LLC and  except for the limited license granted to you herein, we reserve all of our  intellectual property rights in the Services. ServeBartendCook, the ServeBartendCook logos and other ServeBartendCook  trademarks, service marks, graphics, and logos used in connection with  ServeBartendCook are trademarks or registered trademarks of SBC Industries, LLC in  the United States and/or other countries. Other trademarks and logos used in  connection with ServeBartendCook may be the trademarks of their respective  owners. This Agreement does not grant you any right or license with respect to  any such trademarks and logos.\ </p>
<p>18. Notification of Claimed Copyright or Trademark  Infringement. If you believe that your  copyrighted work or trademark has been uploaded, posted or copied to the  Website and is accessible on the Website in a way that constitutes copyright or  trademark infringement, please contact the Company by email at admin@servebartendcook.com  or by regular mail at:</p>
<p>&nbsp;</p>
<p>SBC Industries, LLC<br />
  424  E Central Blvd #141<br />
  Orlando,  FL 32801</p>
<p>&nbsp;</p>
<p><strong>19. Reserved  Right of Refusal.</strong> The Company, in  its sole discretion, reserves the right to refuse fulfillment of your order, or  refuse you any involvement with the Service or Material, or to delete your  assigned User name and password if you breach any of the terms of this Agreement.  &nbsp;
<p><strong>&nbsp;</strong></p>
<p><strong>20. Modifications  to Terms and Conditions.</strong> The Company reserves the right  at any time and from time to time to modify or discontinue, temporarily or  permanently, the Service or Material (or any part thereof) with or without  notice. You agree that the Company shall not be liable to you or to any third  party for any modification, suspension or discontinuance of the Service or any  Material. </p>
<p><strong>Email Policy.</strong> If you receive an email from the Company,  its affiliates, or other third  parties, your email address was obtained as a result of either your  express and voluntarily request to receive information from the Company, its  affiliates, or other third parties  or your existing relationship with the Company, its affiliates, or other third parties.&nbsp; Each email  sent contains an automated method to &ldquo;opt out&rdquo; of receiving additional emails  from the Company or its affiliates. If you no longer wish to receive emails  from the Company or its affiliates, please follow the instructions at the end  of any email.&nbsp; If you remove your information from the Company&rsquo;s database,  it will no longer be used by us for secondary purposes, disclosed to third  parties, or used by us or third parties to send promotional correspondence to  you. &nbsp; </p>
<p><strong>&nbsp;</strong></p>
<p><strong>21. Detailed  Wireless Policy.</strong> Data obtained from  you in connection with this SMS service may include your name, address, cell  phone number, your provider's name, and the date, time, and content of your  messages.&nbsp; In addition to any fee of which you are notified, your  provider's standard messaging rates apply to our confirmation and all subsequent  SMS correspondence.&nbsp; All charges are billed by and payable to your mobile  service provider.&nbsp; We will not be liable for any delays in the receipt of  any SMS messages, as delivery is subject to effective transmission from your  network operator.&nbsp; SMS message services are provided on an &ldquo;AS IS&rdquo; basis.  You may opt-out and remove your SMS information by sending &quot;STOP&quot;,  &quot;END&quot;, or &quot;QUIT&quot; to the SMS text message you have  received.&nbsp; If you remove your SMS information from our database, it will  no longer be used by us for secondary purposes, disclosed to third parties, or  used by us or third parties to send promotional correspondence to you. You may  also send an email to: <strong><a href="mailto:textoptout@servebartendcool.com">textoptout@servebartendcool.com</a></strong> with your wireless number and the words &ldquo;Stop&rdquo;, &ldquo;Quit&rdquo;, or &ldquo;End&rdquo; in the body to  be removed.&nbsp; </p>
<p>&nbsp;</p>
<p><strong>22. Entire Agreement</strong> These Terms and  Conditions, including the Privacy Policy, constitute the entire agreement  between you and the Company and govern your use of the Services and Materials,  superseding any prior version of this Terms and Conditions between you and the  Company. You also may be subject to additional terms and conditions that may  apply when you use or purchase certain other Company services, affiliate services,  third-party content or third-party software. </p>
<p><strong>&nbsp;</strong></p>
<p><strong>23. Assignment and Delegation.</strong> You may not assign or delegate any rights  or obligations under the Agreement. Any purported assignment and delegation  shall be ineffective. We may freely assign or delegate all rights and  obligations under the Agreement, fully or partially without notice to you. We  may also substitute, by way of unilateral novation, effective upon notice to  you, SBC Industries, LLC for any third party that assumes our rights and  obligations under this Agreement. </p>
<p><strong>24. Choice of Law and Forum.</strong> This Agreement and the relationship between the parties will be exclusively  governed by and interpreted in accordance with the laws of the State of  Florida, without regard to the conflicts of laws principles thereof. The  parties agree that any and all claims, causes of action or disputes  (regardless of theory) arising out of or relating to this Agreement, or the  relationship between you and the Company shall be brought exclusively in the  courts located in Orange county Florida or the U.S. District Court for the  Middle District of Florida. You agree to submit to the personal jurisdiction of  the courts located within Orange County Florida or the Middle District of  Florida, and agree to waive any and all objections to the exercise of  jurisdiction over the parties by such courts and to venue in such courts. </p>
<p>&nbsp;</p>
<p>THE PARTIES AGREE THAT THIS AGREEMENT HAS BEEN ENTERED INTO AT THE  COMPANY&rsquo;S PLACE OF BUSINESS IN ORLANDO, FLORIDA AND ANY LEGAL ACTION OR  PROCEEDING ARISING OUT OF OR RELATING TO THIS AGREEMENT MUST BE COMMENCED AND  TAKE PLACE IN ORANGE COUNTY FLORIDA. </p>
<p>&nbsp;</p>
<p><strong>25. No Injunctive Relief.</strong> In no event shall you seek or be entitled  to rescission, injunctive or other equitable relief, or to enjoin or restrain  the operation of the Service, exploitation of any advertising or other  materials issued in connection therewith, or exploitation of the Services or  any content or other material used or displayed through the Services. You agree to waive any rights you may have to  seek rescission, injunctive or other equitable relief. </p>
<p>&nbsp;</p>
<p><strong>26. Captions.</strong> The section titles in this Agreement are for  convenience only and have no legal or contractual effect. </p>
<p>&nbsp;</p>
<p><strong>27. Statute of Limitations.</strong> You agree  that regardless of any statute or law to the contrary, any claim or cause of  action arising out of or related to use of the Services, Materials, or this  Agreement must be filed within one (1) year after such claim or cause of action  arose or be forever barred.
<p>&nbsp;</p>
<p><strong>28. Waiver and Severability of Terms.</strong> The failure of the Company to exercise or enforce any right or provision  of this Agreement shall not constitute a waiver of such right or provision. If  any provision of the Agreement is found by a court of competent jurisdiction to  be invalid, the parties nevertheless agree that the court should endeavor to  give effect to the parties' intentions as reflected in the provision, and the  other provisions of the Agreement remain in full force and effect. </p>
<p>&nbsp;</p>
<p><strong>30. Reservation of Rights.</strong> We reserve all rights not expressly granted in this Agreement, including,  without limitation, title, ownership, intellectual property rights, and all  other rights and interest in ServeBartendCook and all related items, including  any and all copies made of the Website. </p>
<p><strong>&nbsp;</strong></p>
<p><strong>31. Additional Terms Applicable to  Employers.</strong> Employers are  solely responsible for their postings on the Website. We are not to be  considered to be an employer with respect to your use of the Website and we are  not be responsible for any employment decisions, for whatever reason, made by  any entity posting jobs on the Website </p>
<p>&nbsp;</p>
<p>Candidate profiles derived from  User Content may also be made available through the Website. We do not make any  representations regarding the accuracy or validity of such derived works or  their appropriateness for evaluation by employers. Derived profiles may vary  significantly from User Content.</p>
<p>&nbsp;</p>
<p>A job posting may not contain: </p>
<ol style="font-size: 12px; line-height: 20px;">
  <li>any hyperlinks, other than those specifically  authorized by us;
  <li>misleading, unreadable, or &quot;hidden&quot; keywords,  repeated keywords or keywords that are irrelevant to the job opportunity being  presented, as determined in the Company&rsquo;s reasonable discretion;
  <li>the names, logos or trademarks of unaffiliated  companies;
  <li>the names of colleges, cities, states, towns or  countries that are unrelated to the posting;
  <li>more than one job or job description, more than one  location, or more than one job category, unless the product so allows;
  <li>inaccurate, false, or misleading information; and
  <li>material or links to material that exploits people in a  sexual, violent or other manner, or solicits personal information from anyone  under 18.
</ol>
<p><strong>&nbsp;</strong></p>
<p>You may not use your job posting  to: </p>
<ol style="font-size: 12px; line-height: 20px;">
  <li>post jobs in a manner that does not comply with  applicable local, national and international laws, including but not limited to  laws relating to labor and employment, equal employment opportunity and  employment eligibility requirements, data privacy, data access and use, and  intellectual property;
  <li>post jobs that require citizenship of any particular  country or lawful permanent residence in a country as a condition of  employment, unless otherwise required in order to comply with law, regulations,  executive order, or federal, state or local government contract;
  <li>post jobs that include any screening requirement or  criterion in connection with a job posting where such requirement or criterion  is not an actual and legal requirement of the posted job;
  <li>post or re-post jobs or other content for third  parties, including our competitors, or other content that contains links to any  site competitive with us including;
  <li>sell, promote or advertise products or services;
  <li>post any franchise, pyramid scheme, &ldquo;club membership&rdquo;,  distributorship, multi-level marketing opportunity, or sales representative  agency arrangement;
  <li>post any business opportunity that requires an up front  or periodic payment or requires recruitment of other members, sub-distributors  or sub-agents;
  <li>promote any opportunity that does not represent bona  fide employment which is generally indicated by the employer&rsquo;s use of IRS forms  W-2 or 1099;
  <li>advertise sexual services or seek employees for jobs of  a sexual nature;
  <li>endorse a particular political party, political agenda,  political position or issue;
  <li>promote a particular religion;
  <li>post jobs located in countries subject to economic  sanctions of the United States Government; and
  <li>except where allowed by applicable law, post jobs which  require the applicant to provide information relating to his/her (i) racial or  ethnic origin (ii) political beliefs (iii) philosophical or religious beliefs  (iv) membership of a trade union (v) physical or mental health (vi) sexual life  (vii) the commission of criminal offences or proceedings or (vii) age.
</ol>
<p>&nbsp;</p>
<p>We reserve the right to remove  any job posting or content from the Website, which in our opinion does not  comply with the terms of this Agreement, or if any content is posted that we  believe is not in our best interest.</p>
<p>If at any time during your use of  the Services, you made a misrepresentation of fact to us or otherwise misled us  with regard to the nature of your business activities, we will have grounds to  terminate your use of the Services.</p>
<p>You will use the candidates&rsquo;  profiles in accordance with this Agreement, any other agreement you have with  the Company, the Privacy Policy and all applicable privacy and data protection  laws. You agree that you will not  disclose any of the candidates&rsquo; profile information to any third party.</p>
<p>You shall take appropriate  physical, technical, and administrative measures to protect the data you have  obtained from the Website from loss, misuse, unauthorized access, disclosure,  alteration or destruction. You shall not share your login credentials with any  other party.</p>
<p>&nbsp;</p>
<p>The profile information shall not  be used: </p>

 <p>(a) - for any purpose other than as an employer seeking  employees, including but not limited to advertising promotions, products, or  services to any resume holders;</p>
  <p>(b) - to make unsolicited phone calls or faxes or send  unsolicited mail, email, or newsletters to resume holders or to contact any  individual unless they have agreed to be contacted (where consent is required  or, if express consent is not required, who has not informed you that they do  not want to be contacted); or</p>
  <p>(c) - to source candidates or to contact job seekers or  resume holders in regards to career fairs and business opportunities.</p>

<p>&nbsp;</p>
<p>In order to ensure a safe and  effective experience for all of our customers, we reserve the right to limit  the amount of data that may be accessed by you in any given time period. These  limits may be amended in our sole and absolute discretion from time to time. </p>
	<div>
<?php
}

