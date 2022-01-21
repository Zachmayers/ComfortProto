<?php
//==================================
//!   Handler for ajax calls to Job List functions 
//==================================

//CHANGE FOR LIVE SITE
	require_once($_SERVER['DOCUMENT_ROOT'].'/popparlour/classes/pop.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/popparlour/classes/utilities.class.php');
	
	$utilities = new Utilities;
	$site_type	 = $utilities->site_type;
	
	session_start();
	
	if ($site_type == "prototype") {
		ini_set('display_errors',1);
		error_reporting(E_ALL|E_STRICT); 
	} 
	
	$type = $_GET['type'];
	$pop = new Pop();
	
	switch($type) {	
	
		case "save_order":
			$item_list = $_POST['item_list'];	
			$item_array = json_decode($item_list, true);
			//echo var_dump($item_array);
			$orderID = $pop->save_order($item_array);
			//echo var_dump($item_array);
			echo $orderID;
		break;
		
		case "save_address":
			$name = trim($_POST['name']);
			$email = trim($_POST['email']);
			$street = trim($_POST['street']);
			$phone = trim($_POST['phone']);			
			$zip = trim($_POST['zip']);
			$notes = trim($_POST['notes']);
			$day = trim($_POST['day']);
			$time = trim($_POST['time']);

			$valid = $pop->check_orderID($_GET['orderID']);
			
			if ($valid == "Y") {
				$result = $pop->save_address($name, $email, $street, $zip, $phone, $notes, $day, $time, $_GET['orderID']);
			} else {
				$result = "error";
			}
			echo $result;
		break;
		
		case "paid":
			$orderID = trim($_POST['orderID']);
			$amount = trim($_POST['checkout_amount']);

			$pop->mark_paid($orderID, $amount);
		break;
		
		
		case "delivered":
			$orderID = trim($_POST['orderID']);

			$pop->change_delivery_status($orderID);
		break;
		

		case "login":
			$pass = trim($_POST['pass']);
			if($pass == "ardensummer1") {
				$_SESSION['admin'] = 'Y';
			}
		break;

		case "blarg":
				session_destroy();
		break;
	
	} 
?>