<?php
//==================================
//!   Handler for ajax calls to Trade functions
//==================================

//CHANGE FOR LIVE SITE
	require_once($_SERVER['DOCUMENT_ROOT'].'/handshake/classes/trade.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/handshake/classes/utilities.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/handshake/classes/member.class.php');
	
	$utilities = new Utilities;
	
	session_start();
	
	if ($site_type == "prototype") {
		ini_set('display_errors',1);
		error_reporting(E_ALL|E_STRICT); 
	} 
	
	$type = $_GET['type'];
	
	switch($type) {	
	
		case "offer_trade":
			$trade = new Trade("new");
			
			$offer_itemID = $_POST['offer_itemID'];
			$want_itemID = $_POST['want_itemID'];

			$result = $trade->offer_new_trade($offer_itemID, $want_itemID);
			echo $result;
		break;
		
		case "reject_trade":
			$tradeID = $_POST['tradeID'];
		
			$trade = new Trade($tradeID);

			$result = $trade->trade_reaction($tradeID, "reject");			
			echo $result;
		break;

		case "accept_trade":
			$tradeID = $_POST['tradeID'];
		
			$trade = new Trade($tradeID);

			$result = $trade->trade_reaction($tradeID, "accepted");			
			echo $result;
		break;
		
		case "revoke_trade":
			$tradeID = $_POST['tradeID'];
		
			$trade = new Trade($tradeID);

			$result = $trade->trade_reaction($tradeID, "revoke");			
			echo $result;
		break;		

		case "add_feedback":
			$userID = trim($_POST['userID']);		
			$tradeID = trim($_POST['tradeID']);		
			$rating = trim($_POST['rating']);		
			$review = trim($_POST['review']);		
	
			$member = new Member($userID);

			$result = $member->add_feedback($userID, $tradeID, $rating, $review);			
			echo $result;
		break;
		
	} 
?>