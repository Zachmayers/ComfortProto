<?php
//==================================
//!   Handler for ajax calls to Job List functions 
//==================================

//CHANGE FOR LIVE SITE
	require_once($_SERVER['DOCUMENT_ROOT'].'/handshake/classes/item.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/handshake/classes/utilities.class.php');
	
	$utilities = new Utilities;
	$site_type	 = $utilities->site_type;
	
	session_start();
	
	if ($site_type == "prototype") {
		ini_set('display_errors',1);
		error_reporting(E_ALL|E_STRICT); 
	} 
	
	$type = $_GET['type'];
	$itemID = $_GET['itemID'];
	
	$item = new Item($itemID);
	
	switch($type) {	
	
		case "add_new_item":
			$item_name = trim($_POST['item_name']);
			$category = trim($_POST['category']);
			$description = trim($_POST['description']);

			$itemID = $item->add_new_item($item_name, $category, $description);
			
			echo $itemID;						
		break;
		
		case "update_item":
			$item_name = trim($_POST['item_name']);
			$category = trim($_POST['category']);
			$description = trim($_POST['description']);

			$result = $item->update_item($itemID, $item_name, $category, $description);
			
			echo $result;
		break;

		case "remove_item":
			$result = $item->remove_item($itemID);
			
			echo $result;
		break;
		
		case "remove_photo":
			$type = $_POST['type'];
			$item->remove_photo($type);		
		break;		
		
	} 
?>