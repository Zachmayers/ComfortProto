<?php
//==================================
//!   Handler for ajax calls to Job List functions 
//==================================

//CHANGE FOR LIVE SITE
	require_once($_SERVER['DOCUMENT_ROOT'].'/handshake/classes/search.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/handshake/classes/utilities.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/handshake/html/search_html.php');

	$utilities = new Utilities;
	$site_type	 = $utilities->site_type;
	
	session_start();
	
	if ($site_type == "prototype") {
		ini_set('display_errors',1);
		error_reporting(E_ALL|E_STRICT); 
	} 
	
	$type = $_GET['type'];

	$search = new Search();
	
	switch($type) {	
	
		case "keyword":
			$keyword = trim($_POST['keyword']);

			$result = $search->search_result_keyword($keyword);			
	
			echo 	"<div class='row item_row' style='font-size:16px; margin-bottom:20px'>";
			if (count($result) > 0) {
				foreach($result as $item) {
					echo search_result_row($item);					
				}
			}
			echo "</div>";
		break;

		case "keyword_category":
			$keyword = trim($_POST['keyword']);
			$category = trim($_POST['category']);

			$result = $search->search_result_keyword_category($keyword, $category);			
	
			echo 	"<div class='row item_row' style='font-size:16px; margin-bottom:20px'>";
			if (count($result) > 0) {
				foreach($result as $item) {
					echo search_result_row($item);					
				}
			}
			echo "</div>";
		break;

		case "category":
			$category = trim($_POST['category']);

			$result = $search->get_search_results($category);			
	
			echo "<div class='row item_row' style='font-size:16px; margin-bottom:20px'>";
			if (count($result) > 0) {
				foreach($result as $item) {
					echo search_result_row($item);					
				}
			}
			echo "</div>";
		break;
		
	} 
?>