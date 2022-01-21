<?php
//==================================
//!   Handler for ajax calls to Product functions 
//==================================

//CHANGE FOR LIVE SITE

//if ($_GET['key'] == "F23dfhjed" && isset($_POST['tokenid'])) {
	
	require_once($_SERVER['DOCUMENT_ROOT'].'/stripe/init.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/utilities.class.php');		
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/match.class.php');		
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/job.class.php');		

	$utilities = new Utilities;
	$site_type	 = $utilities->site_type;
	
	session_start();
	
	if ($site_type == "prototype") {
		ini_set('display_errors',1);
		error_reporting(E_ALL|E_STRICT); 
	} 

//	\Stripe\Stripe::setApiKey("sk_test_qyYipHL4YUTJOJeX3QkPaZDE");
	\Stripe\Stripe::setApiKey("sk_live_lVO36k6oBF1q5v6hltUT2Ddj");


	$tokenid = $_POST['tokenid'];
	$checkout_amount = $_POST['checkout_amount'];
	$email = $_POST['email'];
	$jobID = $_POST['jobID'];

	$status = "fail";
	
	//run a secondary check here to make sure this person isn't trying to checkout a second time for the same cob
	$job = new Job($jobID);
	$job_data = $job_data = $job->get_job_data(array('general'));
	
	$test_amount = ($job_data['general']['total_payment']*100);
	
	if ($test_amount == $checkout_amount && $job_data['general']['job_status'] != "Open" && $job_data['general']['payment_status'] != "paid" && $job_data['general']['job_status'] != "Filled") {
	
		// Create the charge on Stripe's servers - this will charge the user's card
		try {
			$charge = \Stripe\Charge::create(array(
			    "amount" => $checkout_amount, // amount in cents, again
			    "currency" => "usd",
			    "source" => $tokenid,
			    "description" => "Job Post",
			    "receipt_email" => $email
			));
			
			$status = "success";
				    
		} catch(\Stripe\Error\Card $e) {
			// The card has been declined
			$status = "fail";
		}
	}
	
	echo $status;
//}

?>