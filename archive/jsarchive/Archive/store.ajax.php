<?php
//==================================
//!   Handler for ajax calls to Store (location) functions 
//==================================

//CHANGE FOR LIVE SITE
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/store.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/employer.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/utilities.class.php');
	$utilities = new Utilities;
	$site_type	 = $utilities->site_type;
	
	session_start();
	
	if ($site_type == "prototype") {
		ini_set('display_errors',1);
		error_reporting(E_ALL|E_STRICT); 
	} 
	
	$type = $_GET['type'];
	
	$utilities = new Utilities;
	
	switch($type) {	
	
		case "add_store":
			$store = new Store("NA");		
			$name = trim($_POST['store_name']);
			$address = trim($_POST['store_address']);	
			$zip = trim($_POST['store_zip']);				
			$description = trim($_POST['type']);
			$website = trim($_POST['store_website']);	
			$facebook = trim($_POST['facebook']);
			$position = trim($_POST['position']);
			
			if ($utilities->zip_validate($zip) == "invalid") {
				echo "zip_error";
			} else {		
				//strip http off of link
				$pos = strpos($website, "http://");
				$pos_s = strpos($website, "https://");			
				if ($pos !== false) {
					$website = str_replace("http://", "", $website);
				}				
				if ($pos_s !== false) {
					$website = str_replace("https://", "", $website);
				}
				
				$pos = strpos($facebook, "http://");
				$pos_s = strpos($facebook, "https://");			
				if ($pos !== false) {
					$facebook = str_replace("http://", "", $facebook);
				}			
				if ($pos_s !== false) {
					$facebook = str_replace("https://", "", $facebook);
				}					
								
				$store_array = array("name" => $name, "address" => $address, "zip" => $zip, "description" => $description, "website" => $website, "facebook" => $facebook);						
				$storeID = $store->add_store($store_array);
				if ($position != "NA") {
					$employer = new Employer($_SESSION['userID']);
					$record_update_array = array("position" => $position, "company" => $name, "website" => $website);
					$employer->insert_employer_record($record_update_array);
				}
				
				echo $storeID;
			}
		break;
				
		case "edit_store":
			$name = trim($_POST['name']);
			$address = trim($_POST['address']);	
			$zip = trim($_POST['zip']);				
			$description = trim($_POST['description']);
			$website = trim($_POST['website']);
			$facebook = trim($_POST['facebook']);
			$storeID = 	trim($_POST['storeID']);
			
			if ($utilities->zip_validate($zip) == "invalid") {
				echo "zip";
			} else {		
				//strip http off of link
				$pos = strpos($website, "http://");
				$pos_s = strpos($website, "https://");				
				if ($pos !== false) {
					$website = str_replace("http://", "", $website);
				}				
				if ($pos_s !== false) {
					$website = str_replace("https://", "", $website);
				}
				
				
				$pos = strpos($facebook, "http://");
				$pos_s = strpos($facebook, "https://");			
				if ($pos !== false) {
					$facebook = str_replace("http://", "", $facebook);
				}			
				if ($pos_s !== false) {
					$facebook = str_replace("https://", "", $facebook);
				}					
				
				
				$store = new Store($storeID);		
				$store_array = array("name" => $name, "address" => $address, "zip" => $zip, "description" => $description, "website" => $website, "facebook" => $facebook);									
				$store->update_store_data($store_array);
				echo "true";
			}
		break;							
	} 
?>