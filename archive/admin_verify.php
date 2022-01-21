<?php
	require_once('classes/admin.class.php');
	session_start();

	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$admin = new Admin;
	
	switch($_GET['type']) {
		default:
			$admin->admin_login($username, $password);			
		break;
		
		case "culinary":
			$admin->culinary_login($username, $password);					
		break;
		
		case "stats":
			$admin->stats_login($username, $password);					
		break;
		
		case "pavement":
			$admin->pavement_login($password);					
		break;		
	}
?>
