<?php
function index_main_header_html() {
?>
<!DOCTYPE html>
	  <!-- Fixed navbar -->
    <nav class="navbar navbar navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
          <i class="fas fa-bars"></i>
          </button>
          <a class="navbar-brand" href="#">Wine Ranker Beta</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav pull-right-nav">
            <li class="active"><a href="#">Home</a></li>
<!--             <li><a href="#about">About</a></li> -->
<!--             <li><a href="index.php?page=login">Login</a></li> -->
<!--             <li><a href="index.php?page=signup">Signup</a></li> -->
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<?php	
}

function index_html($page) {
?>

    <div class="jumbotron">
    	<div class="container text-center">
	    	
       		<h1>Project Moirai</h1>
<!-- 	   		<p>Variable Throttled Lead Posting</p> -->
<!-- 	   		<p><a class="btn btn-primary" href="#" role="button">Learn more &raquo;</a></p> -->
		</div>
		<div class="container text-center">

			<div class='row'>			
		    	<div class="col-md-12 warning" id="invalid_login" style="display:none; text-align:center; background-color: white;"><font color="red">Password or Username is incorrect</font></div>
			</div>
		    <div class='row'>
		    	<div class="col-md-12" id="delay_holder"></div>		
		    </div>

		<form class="navbar-form">
			
			<div class="form-group"> <!-- Username field -->
				<input class="form-control" id="user_login" name="user_name" type="text" placeholder="Username"/>
			</div>
			
			<div class="form-group"> <!-- Password field -->
				<input class="form-control" id="pass_login" name="user_password" type="password" placeholder="Password"/>
			</div>
			
			<div class="form-group"> <!-- Login button -->
				<button  id="login_button" class="btn btn-swapaction " name="submit" type="submit">Login</button>
			</div>	
						
		</form>
          	
<!--
        <div class="row"style="min-height: 400px;">	        
            <div class="col-md-12 text-center"><br />
				<a href='index?page=create_account' class='btn btn-large btn-primary'>CREATE ACCOUNT</a> <i>Not Yet</i><br />
	        </div>
        </div>
-->

		</div>
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
			<h3>Contact us at admin@servebartendcook.com</h3><br />			
			</div>
		</div>	
		&nbsp; <br />
		&nbsp; <br />
		&nbsp; <br />
		
	</div>
<?php			
}


function index_create_account_html() {	
?>
    <div class="jumbotron">
    	<div class="container text-center">
       		<h1>Project Moirai</h1>
	   		<p>Sign-Up</p>
		</div>
	    
    <div class="container text-center">

	<div class='row' style='padding-bottom:120px;'>

		<div class="col-md-6 col-md-offset-3" style='text-align:center; padding-top:10px;'>
			<div class='row'>
				<div class="col-md-12 warning" id="empty_warning" style="display:none; text-align:center; background-color: white;"><font color="red"><b>NOTICE: Please complete all fields</b></font></div>
			</div>
			<div class='row'>
				<div class="col-md-12 warning" id="pass_warning" style="display:none; text-align:center; background-color: white;"><font color="red"><b>NOTICE: Invalid password length</b></font></div>
			</div>
			<div class='row'>
				<div  class="col-md-12 warning" id="duplicate_warning" style="display:none; text-align:center; background-color: white;"><font color="red"><b>NOTICE: Email already being used</b></font></div>
			</div>
			<div class='row'>
				<div  class="col-md-12 warning" id="display_duplicate_warning" style="display:none; text-align:center; background-color: white;"><font color="red"><b>NOTICE: Display name already being used</b></font></div>
			</div>			
			<div class='row'>
				<div class="col-md-12 warning" id="email_warning" style="display:none; text-align:center; background-color: white;"><font color="red"><b>NOTICE: Invalid email address</b></font></div>
			</div>
			<div class='row'>
				<div class="col-md-12 warning" id="pass_check_warning" style="display:none; text-align:center; background-color: white;"><font color="red"><b>NOTICE: Passwords do not match</b></font></div>
			</div>
			<div class='row'>
				<div class="col-md-12 warning" id="error" style="display:none; text-align:center; background-color: white;"><font color="red"><b>NOTICE: There was an error processing your request.  Please try again later or contact admin@servebartendcook.com</b></font></div>
			</div>
			
			
					   

<!--
		<div style='width:100%; margin-top: 5px; float:left;'>
			<span style="text-align:center; margin-bottom:0px;"><h5>Already Have an Account?</h4></span>	
			<span style="text-align:center; margin-bottom:0px;"><h4 style='margin-top:0px;'><a href='index.php?page=login&ID=<? echo $_GET['ID'] ?>' style="color:white">LOGIN</a></h4></span>	
		</div>
-->

<!--
					<div style='width:100%; margin-top: 8px; float:left;'>
						<b>By clicking "Get Started", you agree to the:<br /><a href="index.php?page=TOS">TERMS OF SERVICE</a> | <a href="index.php?page=privacy_policy">PRIVACY POLICY</a></b>
					</div>				
-->
		</div>
	</div>
<?php			
}


function index_login_html($email) {			
?>
	<div class='row' style='padding-bottom:335px;'>
		<div class="col-md-12" style="font-family: 'Nothing You Could Do', cursive; text-align:center; margin-bottom:25px;">
			<h2>Welcome Back</h2>
		</div>
		
		<div class="col-md-6 col-md-offset-3 text-box" style='text-align:center; padding-top:10px;'>
			<div class='row'>			
		    	<div class="col-md-12 warning" id="invalid_login" style="display:none; text-align:center; background-color: white;"><font color="red">Password or Username is incorrect</font></div>
			</div>
		    <div class='row'>
		    	<div class="col-md-12" id="delay_holder"></div>		
		    </div>
			
			<table style='margin: 0 auto;'>
				<tr>
		        	<td  style='padding-bottom:15px' align="center">EMAIL</td>
				</tr>
				<tr>
		        	<td  style='padding-bottom:15px; padding-left:7px;' valign="top"><input type="text" id="user_login" size="16" value="<? echo $email ?>" /></td>	        
		      	</tr>
			  	<tr>
		      	  	<td style='padding-bottom:15px' align="center">PASSWORD</td>
			  	</tr>
			  	<tr>
		        	<td style='padding-bottom:15px; padding-left:7px;' valign="top"><input type="password" id="pass_login" size="16"/></td>	        
		      	</tr>
		   </table>

		   <div class='row' style='text-align:center'>
	      		<div class="col-md-12 homelinks">
					<a id="login_button" href='#'><b>LOGIN</b></a>
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

				<a href='index.php?page=forgot_pass' style='color:white'>Forgot Password</a><br />
				&nbsp; <br />	
<!-- 				By logging in, you agree to the following:</br>  <b><a href="index.php?page=TOS">Terms of Service</a> | <a href="index.php?page=privacy_policy"> Privacy Policy</a></b><br /> -->
	
			  <div id="loader" style="display:none; text-align:center;"><h2>Loading....</h2><br /> </div>

		  </div>
		</div>
	</div>
<?php			
}

function index_html_footer_full() {
?>
	<div class="row"> &nbsp; </div>
    </div>
	<!-- /container -->
	
<!--
	<footer class="footerwrap" style='background-color: #5cf2ff; width:100%; '>	
		<div style='background-color: #5cf2ff; min-height:75px; text-align:center; padding-top:5px;'>		
			<p>Copyright &copy; 2018 Robotic Trading Company<br /> <a href="http://servebartendcook.com/index.php?page=privacy_policy">Privacy Policy</a>  | <a href="http://servebartendcook.com/index.php?page=TOS">Terms of Use</a></p><br />		
			<p>info@#####.###</p>
		</div>			
	</footer>
-->
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js?v=1"></script>
</body>

</html>
<?php
}	

function index_html_footer() {
?>
	<div class="row"> &nbsp; </div>
    </div>
	<!-- /container -->
	
	<footer style='background-color: #8e080b'>	
		<div style='background-color: #8e080b; min-height:75px; text-align:center; padding-top:5px;'>		
			<p>Copyright &copy; 2019 Dyson Sphere by JBH<br /> <a href="http://servebartendcook.com/index.php?page=privacy_policy">Privacy Policy</a>  | <a href="http://servebartendcook.com/index.php?page=TOS">Terms of Use</a></p><br />		
			<p>1100101100101100</p>
		</div>			
	</footer>
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js?v=1"></script>
</body>

</html>
	<!-- /container -->
<?php
}	