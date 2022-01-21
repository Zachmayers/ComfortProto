<?php
//==================================
//!   Handler for ajax calls to Job List functions 
//==================================

//CHANGE FOR LIVE SITE
	require_once($_SERVER['DOCUMENT_ROOT'].'/handshake/classes/offers.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/handshake/classes/utilities.class.php');
	$utilities = new Utilities;
	$site_type	 = $utilities->site_type;
	
	session_start();
	
	if ($site_type == "prototype") {
		ini_set('display_errors',1);
		error_reporting(E_ALL|E_STRICT); 
	} 
	
	$type = $_GET['type'];
	$offers = new Offers($_SESSION['userID']);
	
	switch($type) {	
	
		case "accept_offer":
			$offerID = trim($_POST['offerID']);
			$location = trim($_POST['location']);

			$offers->accept_offer($offerID, $location);			
		break;

		case "counter_offer":
			$offerID = trim($_POST['offerID']);
			$new_itemID = trim($_POST['new_itemID']);

			$offers->counter_offer($offerID, $new_itemID);			
		break;
		
		case "decline_offer":
			$offerID = trim($_POST['offerID']);

			$offers
			->decline_offer($offerID);			
		break;

	} 
?>