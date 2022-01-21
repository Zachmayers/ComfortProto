<?php
function index_main_header_html() {
?>
    <div class="container-fluid">
		<div class="top-section">
			&nbsp;
	        <div class="page-header text-center" style='margin-top:5px; margin-left:7px; margin-right:7px;'>
 	            <img src="/loneme_proto/images/comfort-logo-blk.png">
	        </div>
				
<?php		
}

function index_html() {
?>

       <p class=" text-center " style="color:black">A Project Prototype</p> 
        <p class=" text-center row-margin selection" style='display:none'>Select an option</p>
        <div class="row-margin get_started">
            <div class="col-md-3 spacer100" ></div>
           
            <div class="col-md-6 spacer100">
                <div class="row text-center row-margin homelinks">
        				<a href='#' id='get_started' style='color:black'><b>Create Account &#8594;</b></a>	                
                </div>
            </div>
            <div class="col-md-3 spacer100"></div>
        </div>

        <div class="row selection" style='display:none; margin-top:50px; margin-left:5px; margin-right:5px;'>
            <div class="col-md-4 col-md-offset-4 text-box" style="padding-bottom:50px; ">
	            
                <div class="row text-center homelinks">
	                
					<h3 style='color:black'>I want to...</h3><br />
					<div style='margin-bottom:15px; margin-top:15px; color:black'>
						<a href='index.php?page=client_signup'>Book a Moment! &#8594;</a><br />
					</div>

					<div style='margin-bottom:15px; color:black'>					
						<a href='index.php?page=provider_signup'>Provide Service! &nbsp; &#8594;</a>	                
					</div>
					
			        <div class="row">
			            <div class="col-md-12">				            
<!--
				            <div class="row text-center row-margin">
								<span id='#' style="cursor:pointer; background-color:#3b5998; color:#ffffff; border-radius: 4px; border: 1px solid white; width:150px; padding-left:20px; padding-right:20px; padding-top:12px; padding-bottom:12px; margin-top:35px;"><img src="images/facebook_f.png" alt="facebook_button" height="24px" style="position: relative; top: 0px; right: 6px;">Sign in with Facebook</span>
							</div>
-->
			            </div>
			        </div>
                </div>
            </div>
        </div>
        
  		<div class="text-center row homelinks">
	  		<div class="col-md-12 spacer"><b><a style='color:black' href="index.php?page=login">Login &#8594;</a></b></div>
	  	</div>

  		<div class="text-center row ">
	  		<div class="col-md-12 spacer75 tagline"> &nbsp; </div>
	  	</div>


<!--
        <div class="row text-center row-margin homelinks">
            <div class="col-md-12">
	            <i class="fa fa-star" aria-hidden="true"></i>	
	            	<a href="#learn"><h3 style="display:inline"> Learn More </h3></a>
		        <i class="fa fa-star" aria-hidden="true"></i>				
					<a href="#learn" id="learn_button"><h3 style="display:inline"> Learn More </h3></a>
				<i class="fa fa-star" aria-hidden="true"></i>
            </div> 
        </div>
-->
        
        <div class="row text-center row-margin">
            <div class="col-md-3">
            </div>
            <div class="col-md-3">
            </div>
        </div>
 
 	</div> <!-- end of page -->

<?php
}




function index_help_html() {			
?>			
	<div class='row' style='padding-bottom:300px;'>
		<div class="col-md-12">
			<h2 style='text-align:center'>Need Help?</h2>
		</div>

		<div class='row'>
			<div class="col-md-6 col-md-offset-3 text-box" style='text-align:center; padding-top:10px;'>
				&nbsp; <br />
				<a class="btn btn-default" href="index.php?page=forgot_pass" role="button">Forgot Password</a><br />
				&nbsp; <br />
		<!--
				<a class="btn btn-default" href="index.php?page=verification_email" role="button">Re-send Verification</a><br />
				&nbsp; <br />
		-->
									
				<span style="font-family: 'Nothing You Could Do', cursive; text-align:center; margin-top:15px;"><h3>Need Something Else?</h3></span>		
				<h3>Contact us at ######</h3><br />	
			</div>			
		</div>	
	</div>
<?php			
}		


function index_html_forgot_pass() {
?>	
	<div class='row' style='padding-bottom:260px;'>
		<div class="col-md-12">
			<h2 style='text-align:center'>Forgot Password?</h2>			
		</div>

		<div class="row" id='forgot_pass_holder'>
			<div class="col-md-6 col-md-offset-3 text-box" style='text-align:center;'>
				<div class='row'>
					<div class="col-md-12 warning" id="wrong_email" style="display:none; background-color: white;"><font color="red">No account associated with that email address.</font></div>    
				</div>
				<div class='row'>
					<div class="col-md-12 warning" id="deactivate" style="display:none; background-color: white;"><font color="red"><b>This account has been deactivated.  Please contact admin@servebartendcook.com for more information.</b></font></div>
				</div>
				<div class='row'>
					<div class="col-md-12 warning" id="email_validation" style="display:none; background-color: white;"><font color="red"><b>You need to click the validation email that was sent before changing your password</b></font></div>
				</div>
				<div class='row'>
					<div class="col-md-12 warning" id="pass_error_warning" style="display:none; background-color: white;"><font color="red"><b>Unable to process your request.  Please try again later or contact admin@servebartendcook.com.</b></font></div>
				</div>
			
	
			    <div class="row" id="password_reset" style="display:none; margin-left:5px; margin-right: 5px;">
			    	<div class="col-md-12">
				    	A password reset link has been sent to your email address.  The link will only be valid for 48 hours.<br />
							&nbsp; <br />
						<i><b>Be sure to check your Spam Folder</b></i>.  Continuous attempts to reset your password will lock your account.
			    	</div>
			    	&nbsp; <br />
			    </div>
				
				<div class="row" id='forgot_pass_form'>
			    	<div class="col-md-12" style='padding-top:20px;'>
				  		<b>Enter your login email to reset your password:</b><br />
				  		&nbsp; <br />
				  		<input type="text"  id="retrieve_password" size="16" style='margin: 0 auto;'>
				  		
				        <div class="homelinks">
							<a id="forgot_password_send" href='#'><b>SUBMIT</b></a>
						</div><br />	
			    	</div>
				</div>
	
			  <div id="pass_loader" style="display:none; margin-left:125px;"><h2>Loading....</h2> </div>
									    
			<span style="font-family: 'Nothing You Could Do', cursive; text-align:center; margin-top:15px;"><h3>Need Something Else?</h3></span>		
			<h3>Contact us at #######</h3><br />			
			</div>
		</div>	
		&nbsp; <br />
		&nbsp; <br />
		&nbsp; <br />
		
	</div>
<?php			
}

function index_verification_email_html() {		
?>			
	<div style="float:left; width:100%; text-align: center;">	
		<h2>Resend Email Verification Link?</h2>
		&nbsp; <br />
								
		<div id='verification_holder' style="float:left; width:100%;">
			<div id="bad_email" style="display:none; background-color: white;"><font color="red">No account associated with that email address.</font></div>    									
			<div id="deactivation_warning" class="warning" style="display:none; background-color: white;"><font color="red"><b>This account has been deactivated.  Please contact admin@servebartendcook.com for more information.</b></font></div>
			<div id="verification_sent" style="display:none; background-color: white;">Email verification sent, please check your spam folder.</div>
			<div id="error" class="warning" style="display:none; background-color: white;"><font color="red"><b>There was an error processing your request.  Please try again later or contact admin@servebartendcook.com</b></font></div>

		    <div id="password_reset" style="float:left; width:100%; display:none">
		    	A password reset link has been sent to your email address.  The link will only be valid for 48 hours.<br />
					&nbsp; <br />
				<i><b>Be sure to check your Spam Folder</b></i>.  Continuous attempts to reset your password will lock your account.
		    </div>
			
			<div id='forgot_pass_form' style="float:left; width:100%;">
				Please enter the email you created an account with:<br />
		  		&nbsp; <br />
		  		<input type="text"  id="email_verify" size="16" style='margin: 0 auto;'>
		  		
		        <div class="homelinks">
					<a id="verification_send" href='#'><b>SUBMIT</b></a>
				</div><br />	
			</div>

		  <div id="verification_loader" style="display:none; margin-left:125px;"><h2>Loading....</h2> </div>
								    
		<span style="font-family: 'Nothing You Could Do', cursive; text-align:center; margin-top:15px;"><h3>Need Something Else?</h3></span>		
		<b>Contact us at ########</b><br />			
	</div>	
<?php			
}


function index_provider_signup_html() {	

?>
	<div class='row' style='padding-bottom:120px;'>

		<div class="col-md-6 col-md-offset-3 text-box" style='text-align:center; padding-top:10px;'>
			<div class='row'>
				<div class="col-md-12 warning" id="employee_empty_warning" style="display:none; text-align:center; background-color: white;"><font color="red"><b>NOTICE: Please complete all fields</b></font></div>
			</div>
			<div class='row'>
				<div class="col-md-12 warning" id="employee_email_retype_warning" style="display:none; text-align:center; background-color: white;"><font color="red"><b>NOTICE: Emails do not match</b></font></div>    
			</div>
			<div class='row'>
				<div class="col-md-12 warning" id="employee_zip_warning" style="display:none; text-align:center; background-color: white;"><font color="red"><b>NOTICE: Please use a valid zip code</b></font></div>
			</div>
			<div class='row'>
				<div class="col-md-12 warning" id="employee_pass_warning" style="display:none; text-align:center; background-color: white;"><font color="red"><b>NOTICE: Invalid password length</b></font></div>
			</div>
			<div class='row'>
				<div class="col-md-12 warning" id="employee_invalid_zip_warning" style="display:none; text-align:center; background-color: white;"><font color="red"><b>NOTICE: The zip code entered is either invalid or a military zip code</b></font></div>
			</div>
			<div class='row'>
				<div  class="col-md-12 warning" id="employee_duplicate_warning" style="display:none; text-align:center; background-color: white;"><font color="red"><b>NOTICE: Email already being used</b></font></div>
			</div>
			<div class='row'>
				<div class="col-md-12 warning" id="employee_email_warning" style="display:none; text-align:center; background-color: white;"><font color="red"><b>NOTICE: Invalid email address</b></font></div>
			</div>
			<div class='row'>
				<div class="col-md-12 warning" id="employee_pass_check_warning" style="display:none; text-align:center; background-color: white;"><font color="red"><b>NOTICE: Passwords do not match</b></font></div>
			</div>
			<div class='row'>
				<div class="col-md-12 warning" id="age_warning" style="display:none; text-align:center; background-color: white;"><font color="red"><b>NOTICE: You must be over 18 to use this site</b></font></div>
			</div>
			<div class='row'>
				<div class="col-md-12 warning" id="error" style="display:none; text-align:center; background-color: white;"><font color="red"><b>NOTICE: There was an error processing your request.  Please try again later or contact admin@servebartendcook.com</b></font></div>
			</div>
			
		   <input type="hidden" id="access_2" name="access" value="catscradle"/>  
		   
		   <div class='row' id="sign_up_form" style="text-align: center">

				<div class="col-md-12" style="text-align:center; margin-bottom:25px;">
					<h2 style='text-align:center; color:black;'>Provider Sign-Up</h2>
					<span style="color:black; text-align:center; margin-bottom:15px;"><h3>Want to be a provider?</h3></span>	
				</div>
			  
		  		<div class="col-md-12">
		        	<label for="age">
		        		<input type="checkbox" id="age" value="18" style='color:black'> &nbsp; <b>I am at least 18 years of age.</b>
		        	</label>
				</div>

			        <input type="text" id="firstname" <? echo $first_name ?> placeholder='First Name' size='16' maxlength="16" style="margin:auto;"><br />
	
			        <input type="text" id="lastname" <? echo $last_name ?> placeholder='Last Name' size='16'  maxlength="16" style="margin:auto;"><br />
	
			        <input type="text" id="zip" name="region" placeholder='Region' size='16' maxlength="20" style="margin:auto;"><br />
			        
			        <input type="text" id="phone" name="phone" placeholder='Phone' size='16' maxlength="10" style="margin:auto;"><br />
	
			        <input type="text" id="login_email" <? echo $email ?> placeholder='Email Address' size='16' maxlength="100" style="margin:auto;"><br />
	
			        <input type="password" id="set_password" name="password" placeholder='Select a Password' size='16'  maxlength="12" style="margin:auto;"><br />
	
						<div class="homelinks" style='width:100%; float:left; text-align:center;'>
							<a href="#" id='signup_provider' style='color:black'>Get Started &#8594;</a>
						</div>	<br />
					</div>
					
					<br /> 


					<div style='width:100%; margin-top: 8px; float:left;'>
<!-- 						<b>By clicking "Get Started", you agree to the:<br /><a href="index.php?page=TOS">TERMS OF SERVICE</a> | <a href="index.php?page=privacy_policy">PRIVACY POLICY</a></b> -->
					</div>				
			</div>
		</div>
<?php			
}


function index_client_signup_html() {
?>
	<div class='row' style='padding-bottom:145px;'>
		<div class="col-md-6 col-md-offset-3 text-box" style='text-align:center; padding-top:0px;'>
			
			<div class='row'>
				<div class="col-md-12 warning" id="employer_empty_warning"  style="display:none; text-align:center; background-color: white;"><font color="red"><b>NOTICE: Please complete all fields</b></font></div>
			</div>
			<div class='row'>
				<div class="col-md-12 warning" id="heard_empty_warning"  style="display:none; text-align:center; background-color: white;"><font color="red"><b>NOTICE: Please select how you heard about us</b></font></div>
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

			<div class="col-md-12" style="color:black; text-align:center; margin-bottom:25px;">
				<h2 style='text-align:center;'>Need to book a moment? </h2>
			</div>
		
			<span style="font-family: 'Nothing You Could Do', cursive; text-align:center; margin-bottom:25px;"><h3 style="margin-bottom:20px;">Get Started</h3></span>	
			
			<div class='row' id="sign_up_form" style="text-align: center">
		  		<div class="col-md-12">
		        	<label for="age">
		        		<input type="checkbox" id="permission" value="18" style='color:black'> &nbsp; I am over 18 years of age
		        	</label>
				</div>
					
	        <input type="text" id="firstname" placeholder="First Name" name="firstname" size='16' style="margin:auto; font-size:16px;"><br />	        
	       
	        <input type="text" id="lastname" placeholder="Last Name" name="lastname" size='16' style="margin:auto; font-size:16px;" maxlength="16"/><br />     
	       
			<input type="text" id="zip" name="region" placeholder='Region' size='16' maxlength="20" style="margin:auto;"><br />
			        
			 <input type="text" id="phone" name="phne" placeholder='Phone' size='16' maxlength="10" style="margin:auto;"><br />

	        <input type="text" id="login_email" placeholder="Email Address" name="login_email" size='16' style="margin:auto;font-size:16px;" maxlength="100"/><br />     
	
	        <input type="password" placeholder="Choose a Password" id="set_password" name="password" size='16' style="margin:auto; font-size:16px;" maxlength="12" placeholder="between 6 and 12 chars"><br />	        

	
			<div class="homelinks" style='width:100%; float:left; text-align:center;'>
				<a href="#" id='signup_client' style='color:black'>Get Started &#8594;</a>
			</div>	<br />
			
			<div style='width:100%; margin-top: 5px; float:left;'>
				<span style="text-align:center; margin-bottom:0px; color:black"><h5>Already Have an Account?</h4></span>	
				<span style="text-align:center; margin-bottom:0px; color:black"><h4 style='margin-top:0px;'><a href='index.php' style="color:black">LOGIN</a></h4></span>	
			</div>			

			<div style='width:100%; margin-top: 5px; float:left;'>
<!-- 				<b>By clicking "Start Posting", you agree to the:<br /><a href="index.php?page=TOS">TERMS OF SERVICE</a> | <a href="index.php?page=privacy_policy">PRIVACY POLICY</a></b> -->
			</div>	
		</div>
	</div>			
<?php			
}

						

function index_login_html($email) {			
			
?>
	<div class='row' style='padding-bottom:335px;'>
		<div class="col-md-12" style=" text-align:center; margin-bottom:25px; ">
			<h2 style="color:black">Welcome Back</h2>
		</div>
		
		
		<div class="col-md-6 col-md-offset-3 text-box" style='text-align:center; padding-top:10px;'>
			<div class='row'>
				<div class="col-md-12 warning" id="fb_deactivation_warning" style="display:none; text-align:center; background-color: white;"><font color="red">Your account has been deactivated.  Please contact admin@servebartendcook.com for more information. &nbsp; <br /> &nbsp; <br /></font></div>		
			</div>
			<div class='row'>			
		    	<div class="col-md-12 warning" id="invalid_login" style="display:none; text-align:center; background-color: white;"><font color="red">Password or Username is incorrect</font></div>
			</div>
		    <div class='row'>
		    	<div class="col-md-12 warning" id="verification_warning" style="display:none; text-align:center; background-color: white;"><font color="red">The email address associated with this account has not been verified. <br />Please check your inbox for the verification email sent when you signed up.</font></div>  
		    </div>
		    <div class='row'>
		    	<div class="col-md-12 warning" id="deactivation_warning" style="display:none; text-align:center; background-color: white;"><font color="red">This account has been deactivated.  Please contact admin@servebartendcook.com for more information.</font></div>
		    </div>
		    <div class='row'>
		    	<div class="col-md-12" id="delay_holder"></div>		
		    </div>
			
			<table style='margin: 0 auto;'>
				<tr>
		        	<td  style='padding-bottom:15px; color:black;' align="center">EMAIL</td>
				</tr>
				<tr>
		        	<td  style='padding-bottom:15px; padding-left:7px;' valign="top"><input type="text" id="user_login" size="16" value="<? echo $email ?>" /></td>	        
		      	</tr>
			  	<tr>
		      	  	<td style='padding-bottom:15px; color:black' align="center">PASSWORD</td>
			  	</tr>
			  	<tr>
		        	<td style='padding-bottom:15px; padding-left:7px;' valign="top"><input type="password" id="pass_login" size="16"/></td>	        
		      	</tr>
		   </table>

		   <div class='row' style='text-align:center'>
	      		<div class="col-md-12 homelinks" >
					<a id="login_button" href='#' style='color:black'><b>LOGIN</b></a>
				</div>	
		   </div>

<!--
		   <div class='row' style='text-align:center; margin-top:25px;'>
	      		<div class="col-md-12">
		   
					<div id='fb_holder' style='float:left; width:100%; padding-bottom:20px;'>
						<span id='fb_login' style="background-color:#3b5998; color:#ffffff; cursor:pointer; border-radius: 4px; width:150px; padding-left:20px; padding-right:20px; padding-top:12px; padding-bottom:12px;"><img src="images/facebook_f.png" alt="facebook_button" height="24px" style="position: relative; top: 0px; right: 6px;">Sign in with Facebook</span>
					</div>
				
	      		</div>
		   </div>
-->

<!--
				<a href='index.php?page=forgot_pass' style='color:white'>Forgot Password</a><br />
				&nbsp; <br />	
				By logging in, you agree to the following:</br>  <b><a href="index.php?page=TOS">Terms of Service</a> | <a href="index.php?page=privacy_policy"> Privacy Policy</a></b><br />
-->

			  <div id="loader" style="display:none; text-align:center;"><h2>Loading....</h2><br /> </div>

		  </div>
		  
		</div>
	</div>
	
<?php			
}

	
	
function index_html_footer_layer() {
?>			
	<div class="clear"></div>
	</section>
	
	<footer> </footer>
		
		</div>
	
	<div id="middle_layer" style="float:left; padding-top:45px; min-height:800px; width:100%; background-image:url('images/sbc-homebg01.jpg');">
	<a name="info"></a>	

	
	</div>
		<footer> </footer>

	</div>
<?php		
}
	

 function full_logged_in() {
 		$member = new Member($_SESSION['userID']);
?>
	<div class='row' style='padding-bottom:250px;'>
		<div class="col-md-12" style="font-family: 'Nothing You Could Do', cursive; text-align:center; margin-bottom:25px;">
			<span style="font-family: 'Nothing You Could Do', cursive; text-align:center; margin-bottom:15px;"><h3>You are currently logged in</h3></span>	
		</div>
		
		<div class='row' style="text-align: center">
			<div class="col-md-6 col-md-offset-3 text-box" style="padding-top:50px; padding-bottom:80px;">
<?php
					echo "<a class='btn btn-default' href='main.php' role='button'>Continue to Main Page</a>";			

?>	
			
			<div class="row text-center row-margin homelinks">
				<a href='#' id='logout'>Logout</a>
			</div>
		</div>
	</div>				
<?php
 }	
			
 

 

function index_html_footer_full() {
	$utilities = new Utilities;
	$site_type = $utilities->site_type;		
?>
    </div>
	<!-- /container -->

		<footer style='background-color: #e9e6de;'>	
			<div style='background-color: #e9e6de; min-height:75px; text-align:center; padding-top:5px; color:#8e080b'>		
			</div>			
		</footer>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    
</body>

</html>
<?php
}	

function index_html_footer() {
	$utilities = new Utilities;
	$site_type = $utilities->site_type;	
	
?>
    </div>
	<!-- /container -->
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

    
</body>

</html>
<?php
}	