<?php
	require_once('classes.php');
	session_start();

	$username = strtolower($_POST['user']);
	$password = $_POST['pass'];
	$jobID = $_POST['jobID'];
	$public_hash = $_POST['public_hash'];
	$type = $_POST['type'];
	
	if ($type == "mobile") {
		$_SESSION['device'] = "mobile";
	} else {
		$_SESSION['device'] = "full";		
	}
	
	$login = new Login;
	$login->user_login($username, $password, $jobID, $public_hash);	
?>
