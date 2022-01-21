<?php
//Page Description

//Required files
	require_once('html/general_content_html.php');
	
//start session
	session_start();
		$admin_content = new Admin_Content;
		$admin_content->html_top("", "");
		
		if ($_SESSION['userID']) {
			echo "<h1>GO BACK AND LOG OUT</h1>";	
		} else {
?>
		<h1 style="display:inline;">PAVEMENT ACCESS</h1>
		<br /> &nbsp; <br />
			<div id='invalid_login' style='display:none; color:red'>Password or Email is incorrect<br /></div>

 		  <div id="login-form">
		    <table cellpadding="10" cellspacing="6">
		      <tr>
		        <td align="right"><B>Access Key:</B></td>
		        <td valign="top"><input type="password" id="pass" size="16"/></td>	        
		      </tr>
		    </table>
		  </div>
		  <div style="margin-bottom:15px; margin-left:110px;">
		  	<button id="pave_login_button" class="step_button">LOGIN</button><br />
			  &nbsp; <br />
		  </div>		  
		  <div id="loader" style="display:none; margin-left:125px;"><h2>Loading....</h2> </div>	  
		

<?php	
	}
	//display footer
	$admin_content->html_footer();
?>