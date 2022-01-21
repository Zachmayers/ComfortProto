<?php
//==================================
//!   Handler for ajax calls to Product functions 
//==================================

//CHANGE FOR LIVE SITE

if ($_GET['key'] == "F23dfhjed" && isset($_POST['tokenid'])) {
	
	require_once($_SERVER['DOCUMENT_ROOT'].'/popparlour/stripe/init.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/popparlour/classes/utilities.class.php');
/*
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/match.class.php');		
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/job.class.php');		
*/

	$utilities = new Utilities;
//	$site_type	 = $utilities->site_type;
	
	session_start();
	
		ini_set('display_errors',1);
		error_reporting(E_ALL|E_STRICT); 

	\Stripe\Stripe::setApiKey("sk_test_39dumdyy4DG5R7NLQlLDCYQ100URHWpKiW");
//	\Stripe\Stripe::setApiKey("	sk_live_cyC02LQEPb8WEueLdlHLQI4d007eUgKlAC");



	$tokenid = $_POST['tokenid'];
	$checkout_amount = $_POST['checkout_amount'];
	$email = $_POST['email'];
//	$groupID = $_POST['groupID'];

	$status = "fail";
	
	//make sure this isn't being posted twice
/*
	$job = new Job('new');
	$group_details = $job->get_group_details($groupID);
*/
		
//	if ($group_details['post_status'] == "draft") {
	
		// Create the charge on Stripe's servers - this will charge the user's card
		try {
			$charge = \Stripe\Charge::create(array(
			    "amount" => $checkout_amount, // amount in cents, again
			    "currency" => "usd",
			    "source" => $tokenid,
			    "description" => "Pop Parlour Order",
			    "receipt_email" => "$email"
			));
			
			//$status = "success";
			//return the charge ID to use as a transaction ID in the database
			$status = $charge->id;
				    
		} catch(\Stripe\Error\Card $e) {
		  // Since it's a decline, \Stripe\Error\Card will be caught
		  $body = $e->getJsonBody();
		  $err  = $body['error'];
		
		  $email_body = "Status is:". $e->getHttpStatus() . "\n";
		  $email_body .= "Type is:" . $err['type'] . "\n";
		  $email_body .= "Code is:" . $err['code'] . "\n";
		  // param is '' in this case
		  $email_body .= "Param is:" . $err['param'] . "\n";
		  $email_body .= "Message is:" . $err['message'] . "\n";
		  
		  mail("jbhenschen@gmail.com","Stripe Error",$email_body);
		  
		  $status = "fail";
		} catch (\Stripe\Error\RateLimit $e) {
		  // Too many requests made to the API too quickly
		   mail("jbhenschen@gmail.com","Stripe Error","Rate Limit");

		  $status = "fail";
		} catch (\Stripe\Error\InvalidRequest $e) {
		  // Invalid parameters were supplied to Stripe's API
		   mail("jbhenschen@gmail.com","Stripe Error","Invalid Request");

		  $status = "fail";		  
		} catch (\Stripe\Error\Authentication $e) {
		  // Authentication with Stripe's API failed
		  // (maybe you changed API keys recently)
		   mail("jbhenschen@gmail.com","Stripe Error","Authentication Error");

		  $status = "fail";		  
		} catch (\Stripe\Error\ApiConnection $e) {
		  // Network communication with Stripe failed
		   mail("jbhenschen@gmail.com","Stripe Error","API Connection Error");

		  $status = "fail";		  
		} catch (\Stripe\Error\Base $e) {
		  // Display a very generic error to the user, and maybe send
		  // yourself an email
		   mail("jbhenschen@gmail.com","Stripe Error","Generic Error");

		  $status = "fail";		  
		} catch (Exception $e) {
		  // Something else happened, completely unrelated to Stripe
		   mail("jbhenschen@gmail.com","Stripe Error","Other Error");

		  $status = "fail";		  
		}
//	}
	
	echo $status;
}

?>