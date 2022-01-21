<?php
//==================================
//!   Handler for ajax calls to Job List functions 
//==================================

//CHANGE FOR LIVE SITE
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/data_view.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/utilities.class.php');		
	
	$utilities = new Utilities;
	$site_type	 = $utilities->site_type;
	
	session_start();
	
//	if ($site_type == "prototype") {
		ini_set('display_errors',1);
		error_reporting(E_ALL|E_STRICT); 
//	} 
	
	$type = $_GET['type'];
	
	$data_view = new Data_View();
	
	switch($type) {	
	
		case "upload_lead_data":
			$name = trim($_POST['name']);
			$lp_key = trim($_POST['lp_key']);
			$campaign_id = trim($_POST['campaign_id']);		
		
			$first_name = trim($_POST['first_name']);
			$last_name = trim($_POST['last_name']);
			$phone_home = trim($_POST['phone_home']);
			$phone_cell = trim($_POST['phone_cell']);
			$phone_work = trim($_POST['phone_work']);
			$phone_ext = trim($_POST['phone_ext']);
			$address = trim($_POST['address']);
			$address2 = trim($_POST['address2']);
			$city = trim($_POST['city']);
			$state = trim($_POST['state']);
			$zip_code = trim($_POST['zip_code']);
			$county = trim($_POST['county']);
			$country = trim($_POST['country']);
			$email_address = trim($_POST['email_address']);
			$dob = trim($_POST['dob']);
			$ip_address = trim($_POST['ip_address']);
			$src = trim($_POST['src']);
			$type = trim($_POST['type']);
			$landing_page = trim($_POST['landing_page']);
			$gender = trim($_POST['gender']);
			$height_feet = trim($_POST['height_feet']);
			$height_inches = trim($_POST['height_inches']);
			$weight = trim($_POST['weight']);
			$tobacco_use = trim($_POST['tobacco_use']);
			$insurance_type = trim($_POST['insurance_type']);
			$jornaya_lead_id = trim($_POST['jornaya_lead_id']);
			$trusted_form_token = trim($_POST['trusted_form_token']);
			$opt_in_date_time = trim($_POST['opt_in_date_time']);
			$household_income = trim($_POST['household_income']);
			$sub_id = trim($_POST['sub_id']);
			$currently_insured = trim($_POST['currently_insured']);
			$pub_id = trim($_POST['pub_id']);
//echo var_dump($_POST);
			$json_array = $_POST['data_array'];
			echo var_dump($json_array);
			//echo var_dump(json_decode($json_array, true));			
			//echo $first_name;
			$json_array = json_decode($json_array, true);
			//echo var_dump($json_array);
			$new_array = array();
			
			$count = 0;
			foreach($json_array as $row) {
				foreach($row as $key=>$thing) {
					//echo($key.'|');
					if ($key == $first_name) {
						$new_array[$count]['first_name'] =  $row[$key];
					} elseif ($key == $last_name) {
						$new_array[$count]['last_name'] =  $row[$key];
					} elseif ($key == $phone_home) {
						$new_array[$count]['phone_home'] =  $row[$key];
 					} elseif ($key == $phone_cell) {
						$new_array[$count]['phone_cell'] =  $row[$key];
					} elseif ($key == $phone_work) {
						$new_array[$count]['phone_work'] =  $row[$key];
					} elseif ($key == $phone_ext) {
						$new_array[$count]['phone_ext'] =  $row[$key];
					} elseif ($key == $address) {
						$new_array[$count]['address'] =  $row[$key];
					} elseif ($key == $address2) {
						$new_array[$count]['address2'] =  $row[$key];
					} elseif ($key == $city) {
						$new_array[$count]['city'] =  $row[$key];
					} elseif ($key == $state) {
						$new_array[$count]['state'] =  $row[$key];
					} elseif ($key == $zip_code) {
						$new_array[$count]['zip_code'] =  $row[$key];
					} elseif ($key == $county) {
						$new_array[$count]['county'] =  $row[$key];
					} elseif ($key == $country) {
						$new_array[$count]['country'] =  $row[$key];
					} elseif ($key == $email_address) {
						$new_array[$count]['email_address'] =  $row[$key];
					} elseif ($key == $dob) {
						$new_array[$count]['dob'] =  $row[$key];
					} elseif ($key == $ip_address) {
						$new_array[$count]['ip_address'] =  $row[$key];
					} elseif ($key == $src) {
						$new_array[$count]['src'] =  $row[$key];
					} elseif ($key == $type) {
						$new_array[$count]['type'] =  $row[$key];
					} elseif ($key == $landing_page) {
						$new_array[$count]['landing_page'] =  $row[$key];
					} elseif ($key == $gender) {
						$new_array[$count]['gender'] =  $row[$key];
					} elseif ($key == $height_feet) {
						$new_array[$count]['height_feet'] =  $row[$key];
					} elseif ($key == $height_inches) {
						$new_array[$count]['height_feet'] =  $row[$key];
					} elseif ($key == $weight) {
						$new_array[$count]['weight'] =  $row[$key];
					} elseif ($key == $tobacco_use) {
						$new_array[$count]['tobacco_use'] =  $row[$key];
					} elseif ($key == $insurance_type) {
						$new_array[$count]['insurance_type'] =  $row[$key];
					} elseif ($key == $jornaya_lead_id) {
						$new_array[$count]['jornaya_lead_id'] =  $row[$key];
					} elseif ($key == $trusted_form_token) {
						$new_array[$count]['trusted_form_token'] =  $row[$key];
					} elseif ($key == $opt_in_date_time) {
						$new_array[$count]['opt_in_date_time'] =  $row[$key];
					} elseif ($key == $household_income) {
						$new_array[$count]['household_income'] =  $row[$key];
					} elseif ($key == $sub_id) {
						$new_array[$count]['sub_id'] =  $row[$key];
					} elseif ($key == $currently_insured) {
						$new_array[$count]['currently_insured'] =  $row[$key];
					} elseif ($key == $pub_id) {
						$new_array[$count]['pub_id'] =  $row[$key];
					}
					
				}
				$count++;
			}
			echo var_dump($new_array);	
			$data_view->upload_data("lead_data", $new_array, $name, $lp_key, $campaign_id);
		break;
	
		
		case "upload_auto":
//echo var_dump($_POST['data_array']);
			$json_array = $_POST['data_array'];
			//$itemID = $item->add_new_item($item_name, $category, $description);
			
			//echo var_dump(json_decode($json_array, true));			
			
			$json_array = json_decode($json_array, true);
			
			$data_view->upload_data("auto", $json_array);
		break;		

		case "upload_leads":

			$json_array = $_POST['data_array'];
			//$itemID = $item->add_new_item($item_name, $category, $description);
			
			//echo var_dump(json_decode($json_array, true));			
			
			$json_array = json_decode($json_array, true);
			
			$data_view->upload_data("leads", $json_array);
		break;

		case "upload_calls":

			$json_array = $_POST['data_array'];
			//$itemID = $item->add_new_item($item_name, $category, $description);
			//echo($json_array);
			//echo var_dump(json_decode($json_array, true));			
			
			$json_array = json_decode($json_array, true);
			echo json_last_error();
			//$json_array = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $json_array), true );
			echo var_dump($json_array);
			$data_view->upload_data("calls", $json_array);
		break;

		case "hourly_throttle":
			$start_date = $_POST['year']."-".$_POST['month']."-".$_POST['day'];
			$json_array = json_decode($_POST['lead_array'], true);
			
			$data_view->set_throttle_hourly_data($_POST['batchID'], $_POST['destination'], $start_date, $json_array);
		break;

		case "even_throttle":
			$start_date = $_POST['year']."-".$_POST['month']."-".$_POST['day'];
			$start_hour = $_POST['start_hour'];
			$end_hour = $_POST['end_hour'];

			$data_view->set_throttle_even_data($_POST['batchID'], $_POST['destination'], $start_date, $_POST['count'], $_POST['mon'], $_POST['tues'], $_POST['wed'], $_POST['thurs'], $_POST['fri'], $start_hour, $end_hour);
		break;

		case "get_count_num":
				$result = $data_view->get_count($_POST['batchID']);
				echo $result;
		break;
		
		case "get_count":
			$result = $data_view->get_count($_POST['batchID']);
?>
				<div class="col-md-12 text-center" id="record_data">
					<h4 style="color:white">Total Records: <span id="total"><? echo $result ?></span></h4>
					<h4 style="color:white">Unassigned Records : <span id="unassigned"><? echo $result ?></span></h4>
				</div>
<?php			
		break;

		case "create_batch":
			$batch_name = trim($_POST['batch_name']);
			$type = trim($_POST['type']);
			$clean = trim($_POST['clean']);
			$ping = trim($_POST['ping']);
			$destination = trim($_POST['destination']);
		
			$batchID = $data_view->create_batch($batch_name, $type, $clean, $ping, $destination);
			
			echo $batchID;
		break;
		
	} 
?>