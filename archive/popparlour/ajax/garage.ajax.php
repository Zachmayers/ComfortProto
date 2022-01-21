<?php
//==================================
//!   Handler for ajax calls to Job List functions 
//==================================

//CHANGE FOR LIVE SITE
	require_once($_SERVER['DOCUMENT_ROOT'].'/handshake/classes/garage.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/handshake/classes/utilities.class.php');
	$utilities = new Utilities;
	$site_type	 = $utilities->site_type;
	
	session_start();
	
	if ($site_type == "prototype") {
		ini_set('display_errors',1);
		error_reporting(E_ALL|E_STRICT); 
	} 
	
	$type = $_GET['type'];
	$garage = new Garage($_SESSION['userID']);
	
	switch($type) {	
	
		case "add_item":
			$item_name = trim($_POST['item_name']);
			$description = trim($_POST['description']);
			$type = trim($_POST['type']);

			$itemID = $garage->add_new_item($item_name, $description, $type);			
			echo $itemID;
		break;
	} 
?>