<?php
//======================
//
//  Front facing site that displays 6 of the latest jobs by region (or all regions)
//
//======================

//Required Class files
	require_once('classes/opportunity_list.class.php');	
	require_once('classes/utilities.class.php');	

//Required HTML files
	require_once('html/jobs_html.php');	
	require_once('html/general_content_html.php');
	
		
//start session
session_start();
//Forces page to refresh, this is needed, or else people adding new info to profile and clicking "back" will see old info
/*
header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
header('Pragma: no-cache'); // HTTP 1.0.
header('Expires: 0'); // Proxies. 
*/

	$utilities = new Utilities;
	$version = $utilities->version;
	$site_type = $utilities->site_type;
		
//name of javascript file
	$js_file = "<script type='text/javascript' src='js/jobs.js?v=".$version." '></script>";
		
//define objects
	$general_content = new General_Content;
	$opportunity_list = new OpportunityList("public");
	
	if (isset($_GET['groupID']) && isset($_GET['ref'])) {
		$group = array("groupID" => $_GET['groupID'], "ref" => $_GET['ref']);
		
		//get group details
		
	} else {
		$group = "none";
	}
	
	
	if (isset($_GET['region'])) {
		$region = $_GET['region'];
	} else {
		$region = "all";
	}
	
	if (isset($_GET['position'])) {
		$position = $_GET['position'];
	} else {
		$position = "all";
	}

	//set up region text
	switch($position) {
		default:
			$position_text = $meta_position = "Restaurant";
		break;
		
		case "server":
			$position_text = $meta_position = "Server";
		break;

		case "bartender":
			$position_text = $meta_position = "Bartender";
		break;

		case "host":
			$position_text = $meta_position = "Host";
		break;

		case "bus":
			$position_text = $meta_position = "Bus";
		break;

		case "cook":
			$position_text = $$meta_position = "Cook";
		break;
		
		case "manager":
			$position_text = $$meta_position = "Restaurant Manager";
		break;
		
		case "foh":
			$position_text = "Bartender and Server";
			$meta_position = "Front of House";
		break;

		case "boh":
			$position_text = "Cook and Kitchen";
			$meta_position = "Back of House";
		break;
		
	}

	
	//set up region text
	switch($region) {
		default:
			$region_text = "Latest Hot ".$position_text." Jobs on SBC!";
			$meta_text = "Latest Available ".$position_text." Jobs";
		break;
		
		case "orlando":
			$region_text = "Latest ".$position_text." Jobs in Orlando, FL";
			$meta_text = $position_text." Jobs in Orlando, FL";
		break;

		case "tampa":
			$region_text = "Latest ".$position_text." Jobs in Tampa, FL";
			$meta_text = $position_text." Jobs in Tampa, FL";
		break;

		case "charlotte":
			$region_text = "Latest ".$position_text." Jobs in Charlotte, NC";
			$meta_text = $position_text." Jobs in Charlotte, NC";
		break;
	}
	
	//get meta data				
		$meta_data['title'] = $meta_text." | Serve Bartend Cook";
		$meta_data['description'] = $region_text." - Quick, easy job search and posting for servers, bartenders, cooks.  Job Matching for restaurant, bar positions.";
				
	
/*
	if ($site_type == "prototype") {
		$og_url = "https://servebartendcook.com/public_listing_new.php?ID=".$_GET['ID']."&ref=".$public_hash;		
		$og_image = "https://servebartendcook.com/graphics/icon_800.png";
	} else {
		$og_url = "https://servebartendcook.com/public_listing_new.php?ID=".$_GET['ID']."&ref=".$public_hash;		
		$og_image = "https://servebartendcook.com/graphics/icon_800.png";
	}
*/

	date_default_timezone_set('America/Los_Angeles');	
	$today = date('F j, Y');
	
	
	
	//get the 6 jobs to display on the site			
	$public_job_slots = $opportunity_list->get_public_job_list($region, $position);

	jobs_header_html($site_type, $meta_data, $region, $js_file, $position);
	
	jobs_html($region_text, $public_job_slots, $today);	
	
	jobs_html_footer($version);
	
?>
<script>
	$(document).ready(function() {
		jobs()					
	})
</script>
<?php
