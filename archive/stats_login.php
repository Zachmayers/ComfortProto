<?php
//Page Description

//Required files
	require_once('html/general_content_html.php');
	
//start session
	session_start();
		$admin_content = new Admin_Content;
		$admin_content->html_top("", "");

?>
	<div class="container text-center" style="margin-top: 50px">
		<h1 style="display:inline;">SBC ADMINISTRATOR LOGIN</h1>
		<br /> &nbsp; <br />
			<div id='invalid_login' style='display:none; color:red'>Password or Email is incorrect<br /></div>
			<div id='expired' style='display:none; color:red'>This account has expired, or is no longer valid<br /></div>

 		  <div id="login-form">
		    <table cellpadding="10" cellspacing="6">
		      <tr>
		        <td align="right"><B>Email:</B></td>
		        <td valign="top"><input type="text" id="email" size="16" /></td>	        
		      </tr>
		      <tr>
		        <td align="right"><B>Password:</B></td>
		        <td valign="top"><input type="password" id="pass" size="16"/></td>	        
		      </tr>
		      <tr><td colspan="3" style="font-size: 11px; padding: 10px;" align="center">By logging in, you agree to the following:</br>  <b><a href="index.php?page=TOS">Terms of Service</a>, <a href="index.php?page=privacy_policy"> Privacy Policy</a></b></td></tr>
		    </table>
		  </div>
		  <div style="margin-bottom:15px; margin-left:110px;">
		  	<button id="stats_login_button" class="step_button">LOGIN</button><br />
			  &nbsp; <br />
		  </div>		  
		  <div id="loader" style="display:none; margin-left:125px;"><h2>Loading....</h2> </div>	  
	</div>

<?php	
	//display footer
	$admin_content->html_footer();
?>