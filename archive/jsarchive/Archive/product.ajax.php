<?php
//==================================
//!   Handler for ajax calls to Product functions 
//==================================

//CHANGE FOR LIVE SITE

	require_once($_SERVER['DOCUMENT_ROOT'].'/SBC/classes/utilities.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/SBC/classes/products.class.php');	
	$utilities = new Utilities;
	$site_type	 = $utilities->site_type;
	
	session_start();
	
	if ($site_type == "prototype") {
		ini_set('display_errors',1);
		error_reporting(E_ALL|E_STRICT); 
	} 
	
	$type = $_GET['type'];

	$product = new Product();
	
	switch($type) {	
	
		case "rank_products":			
			$questionID = $_POST['questionID'];			
			$ranked_product = $_POST['ranked_product'];			
			$other_products[0] = $_POST['product_one'];			
			$other_products[1] = $_POST['product_two'];			
			$other_products[2] = $_POST['product_three'];			

			$product->rank_products($questionID, $ranked_product, $other_products);			
		break;
		
		case "viewed":			
			$questionID = $_POST['questionID'];			
			$other_products[0] = $_POST['product_one'];			
			$other_products[1] = $_POST['product_two'];			
			$other_products[2] = $_POST['product_three'];			

			$product->viewed_products($questionID, $other_products);			
		break;		
		
	} 
	
?>