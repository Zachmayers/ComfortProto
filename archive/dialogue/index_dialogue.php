<?php
	function dialogue_index() {
?>	
		<div id="forgot_password_form" title="Retrieve Password" style="display:none">
			<div id="pass-loader" style="display:none">
				&nbsp; <br />
				&nbsp; <br />
				&nbsp; &nbsp; Loading...<br />		
			</div>
		  <div>
		  	<div id="pass-details">
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
		    	<font color="red">No account associated with that email address.</font>
		    </div>    
		  </div>
		</div>

		<div id="signup_complete" title="Signup Almost Complete" style="display:none">
		  <div>
		  	A verification email has been sent to you.  Please open your email and follow the included link to verify your email address and login.  <i>Be sure to check your Spam Folder</i>.<br />
		    &nbsp; <br />
		  </div>
		</div>

		<div id="loader_box" title="Loading" style="display:none">
		  <div>
		     &nbsp; <br />
		    &nbsp; <br /> 
		  	&nbsp; &nbsp; &nbsp; Loading.....
		    &nbsp; <br />
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
		    	<font color="red">No account associated with that email address.</font>
		    </div>    
		  </div>
		</div>
		
		<div id="reset_confirmation" title="Temporary Password Sent" style="display:none">
		  <div>
		  	A temporary password as been sent to your email address.  Use this email to login.  You can reset your password on the main page. <br />
		    &nbsp; <br />
		    <i><b>Be sure to check your Spam Folder</b></i>.  Continuous attempts to reset your password will lock your account.
		  </div>
		</div>

<?php
}