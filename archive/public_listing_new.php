<?php
	require_once('classes/utilities.class.php');
	require_once('classes/opportunity.class.php');
	require_once('html/public_job_html.php');

error_reporting(0);

	$utilities = new Utilities;
	

//This line is removed after mobile site is updated
	//$device = "mobile";

	//zip recruiter is linking bad URLs for some reason, basically putting the entire URL in a GET variable
	//to combat this, parse the URL after the ? 
	
	//first detect if URL exists after ?
	$url_string = $_SERVER['QUERY_STRING'];
	if (strpos($url_string, 'https://servebartendcook') !== false) {
   		$zip_recruiter_bad_link = "Y";

		$sub = substr($url_string, strpos($url_string,"?")+strlen("?"),strlen($url_string));
		$full_sub = substr($sub,0,strpos($sub, "&"));
		$jobID = substr($full_sub, 3);
   		$public_hash = $_GET['ref'];	
	} else {
   		$zip_recruiter_bad_link = "N"	;   
   		$public_hash = $_GET['ref'];	
   		
   		if (isset($_GET['ID'])) {
   			$jobID = $_GET['ID'];
   		} else {
	   		$jobID = $utilities->get_job_public_ID($public_hash);
   		}		
	}

	$opportunity = new Opportunity($jobID);
	$version = $utilities->version;	
	$site_type = $utilities->site_type;
	
	//Test to see if public hash and jobID match, then check if job is expired or filled
	$valid_page = $opportunity->valid_public_opportunity($public_hash);

	if ($valid_page == "Y" || $valid_page == "expired" || $valid_page == "filled" || $valid_page == "removed") {
		if (isset($_GET['utm_source'])) {
			$source = $_GET['utm_source'];
		} else {
			$source = "NA";
		}
		
		if (isset($_GET['utm_medium'])) {
			$medium = $_GET['utm_medium'];
		} else {
			$medium = "NA";
		}

		if (isset($_GET['utm_campaign'])) {
			$campaign = $_GET['utm_campaign'];
		} else {
			$campaign = "NA";
		}

		if (isset($_GET['utm_keyword'])) {
			$keyword = $_GET['utm_keyword'];
		} else {
			$keyword = "NA";
		}
		
		$opportunity->public_opportunity_view($source, $medium, $campaign, $keyword);
		$opportunity_data = $opportunity->get_opportunity_data();
		
		$groupID = $opportunity_data['job_data']['general']['groupID'];
		$group_jobs = $opportunity->get_group_jobs($groupID);	
		
		$store_zip = $opportunity_data['job_data']['store']['zip'];
		$city_state = $utilities->get_city_state($store_zip);
		
		$og_array = set_open_graph_vars($opportunity_data, $city_state);
		
		$og_title = $og_array['title'];
		$og_description = $og_array['description'];
		
		$meta_title = $og_array['meta_title'];
		$meta_description = $og_array['meta_description'];	
		
		
	} else {
		$og_description = $meta_title ="This job is no longer available.";
		$og_title = $meta_description ="ServeBartendCook";
	}
	
	if ($site_type == "prototype") {
		$og_url = "http://servebartendcook.com/public_listing_new.php?ID=".$jobID."&ref=".$public_hash;		
		$og_image = "http://servebartendcook.com/graphics/icon_800.png";
	} else {
		$og_url = "http://servebartendcook.com/public_listing_new.php?ID=".$jobID."&ref=".$public_hash;		
		$og_image = "http://servebartendcook.com/graphics/icon_800.png";
	}
	
		
	$snippet_details = array("snippet_title" => $og_array['snippet_title'],
											"snippet_description" => $og_array['snippet_description'],
											"snippet_pay_type" => $og_array['snippet_pay_type'],
											"snippet_pay_amount" => $og_array['snippet_pay_amount'],
											"snippet_schedule" => $og_array['snippet_schedule'],
											"snippet_date" => $og_array['date_created'],
											"store_name" => $og_array['store_name'],
											"store_zip" => $og_array['store_zip'],
											"store_address" => $og_array['store_address'],
											"store_city" => $og_array['store_city'],
											"store_state" => $og_array['store_state'],
											"snippet_skills" => $og_array['snippet_skills'],
											"snippet_requirements" => $og_array['snippet_requirements'],
											"og_image" => $og_array['og_image']
	);		

	if ($valid_page == "Y") {
	
		if (isset($jobID)) {
			$jobID = $jobID;
		} else {
			$jobID = "NA";
		}
		
		if ($public_hash == "") {
			$public_hash = "NA";
		}
	
		public_full_header_html($site_type, $og_title, $og_description, $meta_title, $meta_description, $google_analytics, $fb_remarket, $snippet_details, $valid_page, $og_array);

		if ($_GET['page'] == "resume") {
			public_resume_upload_html($opportunity_data, $public_hash);			
		} else {
			public_opportunity_html($opportunity_data, $group_jobs, $public_hash);	
		}
	
?>
		<script>
			$(document).ready(function() {
				jobID = '<? echo $jobID ?>';
				public_hash = '<? echo $public_hash ?>';
				public_job(jobID, public_hash);
				copy_clip();																			
			});
		</script>
<?php																										
	} elseif ($valid_page == "expired" || $valid_page == "filled"){
		public_full_header_html($site_type, $og_title, $og_description, $meta_title, $meta_description, $google_analytics, $fb_remarket, $snippet_details, $valid_page, $og_array);		
		public_expired_html($opportunity_data, $public_hash);	
	} else {
		public_page_warning($valid_page, $device, $site_type);
	}
?>