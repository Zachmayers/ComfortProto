<?php
//==================================
//!   Handler for ajax calls to Job List functions 
//==================================

//CHANGE FOR LIVE SITE
	require_once($_SERVER['DOCUMENT_ROOT'].'/handshake/classes/message.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/handshake/classes/utilities.class.php');
	
	$utilities = new Utilities;
	$site_type	 = $utilities->site_type;
	
	session_start();
	
	if ($site_type == "prototype") {
		ini_set('display_errors',1);
		error_reporting(E_ALL|E_STRICT); 
	} 
	
	$type = $_GET['type'];
	
	$message = new Message();
	
	switch($type) {	
	
		case "add_message":
			$tradeID = $_POST['tradeID'];		
			$senderID = $_SESSION['userID'];
			$receiverID = $_POST['receiverID'];
			$message_text = trim($_POST['message_text']);

			$message->add_message($tradeID, $senderID, $receiverID, $message_text);
			
		break;
		
		case "update_item":
			$item_name = trim($_POST['item_name']);
			$category = trim($_POST['category']);
			$description = trim($_POST['description']);

			$result = $item->update_item($itemID, $item_name, $category, $description);
			
			echo $result;
		break;

		case "remove_item":
			$result = $item_name->remove_item($itemID);
			
			echo $result;
		break;
		
	} 
?>