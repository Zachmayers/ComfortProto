<?php
//Page Description

//Required files
	require_once('html/general_content_html.php');
	
//start session
	session_start();
		$admin_content = new Admin_Content;
		$admin_content->html_top("", "");
?>
	<div class="container text-center">
		<h1 style="display:inline;">SBC ADMIN LOGIN</h1>
		<br /> &nbsp; <br />
			USERNAME: <input type="text" id="username"><br />
			PASSWORD: <input type="password" id="password"><br /><br />
			<button id="login_button">Login</button>
	</div>

<?php	
	//display footer
	$admin_content->html_footer();
?>