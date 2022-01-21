<?php
//======================
//
//  Page that verifies email address of new user or change of email address
//
//======================

//Required Class files
	require_once('classes/verification.class.php');
	require_once('classes/utilities.class.php');
	require_once('classes/member.class.php');

//Required HTML files
	require_once('html/email_verification_html.php');	
	require_once('html/general_content_html.php');
	
		
//start session
session_start();

	$utilities = new Utilities;
	$version = $utilities->version;
	$site_type = $utilities->site_type;
		
//name of javascript file
	$js_file = "";
		
//define objects
	$general_content = new General_Content;
	
	$site_type = $utilities->site_type;	

	$valid_hash = $_GET['valid_hash'];
	$userID = $_GET['userID'];
	if (isset($_GET['type'])) {
		$type = $_GET['type'];
	} else {
		$type = "verify";
	}
	
	$verification = new Verification;

	email_verification_header_html($site_type);
	
	if ($type == "verify") {
		$valid_check = $verification->email_verification($userID, $valid_hash);
		email_verification_html($valid_check);	
	} elseif ($type == "change") {

		$valid_check = $verification->email_change($userID, $valid_hash);

		if ($valid_check == "Y") {
	
			$member = new Member($userID);
			$email = $member->change_email_address($valid_hash);

			if ($email != "error" && $email != "duplicate") {
				email_change_html($email);	
			} else {
				email_change_error_html($email);	
			}
		} else {
			email_change_error_html("general");	
		}
	}
	
	email_verification_html_footer($version);
?>
