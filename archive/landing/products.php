<?php
//======================
//
//   Employee Page - An employee viewing their own profile
//
//======================

//Required Class files
	require_once('classes/employee.class.php');	
	require_once('classes/products.class.php');	
	require_once('classes/utilities.class.php');	
	require_once('mobile_detect.php');		

//Required HTML files
	require_once('html/product_html.php');	
	require_once('html/general_content_html.php');
	require_once('html/public_html.php');
	require_once('mobile/product_html_mobile.php');	
	
//Required Dialogue files
	require_once('dialogue/mobile_dialogue.php');	
	
//start session

session_start();
//Forces page to refresh, this is needed, or else people adding new info to profile and clicking "back" will see old info
header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
header('Pragma: no-cache'); // HTTP 1.0.
header('Expires: 0'); // Proxies. 
error_reporting(0);

	$utilities = new Utilities;
	$version = $utilities->version;	
		
//name of javascript file
	$js_file = "<script type='text/javascript' src='js/product.js?v=".$version."'></script>";

//	$member = new Member($_SESSION['userID']);
//	$member_data = $member->get_member_data();
	
	$general_content = new General_Content;

	
	if (isset($_SESSION['userID']) && $_SESSION['type'] == "employee") {		
	$general_content->html_top("profile", $js_file);
						
		$product = new Product;
		$display_details = $product->get_specific_product_list();
		
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
		} else {
			$page = $display_details['condition'];			
		}
		
		$product_details = $display_details['products'];
		$product_badge_status = $product->get_product_badge_status();
		

					switch($page) {
						//HOLDERS FOR NEW PAGES
						case "products":
							$question = $display_details['question_data'];
							$question_type = $display_details['question_type'];
							$lead_product = $product_details['highest']['details'];
							$lead_product_date = $product_details['highest']['date'];
							$product_list = $product_details['list'];
							
							switch($question_type) {
								case "FOH":
									$question_type_text = "Front of House";
								break;
								
								case "BOH":
									$question_type_text = "Back of House";
								break;

								case "MGMT":
									$question_type_text = "Management";
								break;								
							}
							
							$productID_array[0] = $productID_array[1] = $productID_array[2] = "NA";
							$i = 0;
							$ranking_array = array();
							foreach($product_list as $row) {
								//get ranking
								$ranking = $product->get_product_ranking($row['productID']);
								$ranking_array[$row['productID']] = $ranking;
								
								$productID_array[$i] = $row['productID'];
								$i++;
							}
							
							if ($lead_product != "NA") {
								$ranking = $product->get_product_ranking($lead_product['productID']);
								$ranking_array[$lead_product['productID']] = $ranking;								
							}

							if ($_SESSION['device'] == "full") {								
								product_display($question, $question_type, $question_type_text, $lead_product, $lead_product_date, $product_list, $product_badge_status, $ranking_array);									
								product_badge_descriptions($product_badge_status);
								mobile_loader_box();																																
							} else {
								product_display_mobile($question, $question_type, $question_type_text, $lead_product, $lead_product_date, $product_list, $product_badge_status, $ranking_array);									
								product_badge_descriptions_mobile($product_badge_status);
								mobile_loader_box();																															
							}	
							
?>
<script>
								$(document).ready(function() {
									var product_one = '<?php echo $productID_array[0]; ?>';									
									var product_two = '<?php echo $productID_array[1]; ?>';									
									var product_three = '<?php echo $productID_array[2]; ?>';									
									var badge = '<?php echo $product_badge_status['badge']; ?>';									

									var questionID = '<?php echo $question['questionID']; ?>';
									var device = "<? echo $_SESSION['device'] ?>"; 
									product(questionID, product_one, product_two, product_three, badge, device);
								});
</script>
<?php																																					
						break;
						
						case "date":
							if ($_SESSION['device'] == "full") {								
								product_tomorrow_display();									
							} else {
								product_tomorrow_display_mobile();									
							}								
						break;
	
						case "none":
							if ($_SESSION['device'] == "full") {								
								product_none_display();									
							} else {
								product_none_display_mobile();									
							}								
						break;
						
						case "top":
							$type = $_GET['type'];
							
							$product_list = $product->get_top_products($type);

							switch($type) {
								case "FOH":
									$type_text = "Front of House";
								break;
								
								case "BOH":
									$type_text = "Back of House";
								break;

								case "MGMT":
									$type_text = "Management";
								break;								
							}

						
							if ($_SESSION['device'] == "full") {	
								if ($product_list == "NA") {
									product_none_display_mobile();									
								} else {
									top_product_display($type_text, $product_list);																	
								}						
							} else {
								if ($product_list == "NA") {								
									product_none_display_mobile();									
								} else {
									top_product_display_mobile($type_text, $product_list);												
								}						
							}														
						break;
						
						case "thanks":
							//random skill for view top products
							$skill_array = array("FOH", "BOH", "MGMT");
							
							shuffle($skill_array);
							
							$skill = $skill_array[0];
							switch($skill) {
								case "FOH":
									$skill_text = "Front of House";
								break;
								
								case "BOH":
									$skill_text = "Back of House";
								break;

								case "MGMT":
									$skill_text = "Management";
								break;								
							}
							
							if ($_SESSION['device'] == "full") {	
								thank_you_page($product_badge_status['count'], $product_badge_status, $skill, $skill_text);
							} else {
								thank_you_page_mobile($product_badge_status['count'], $product_badge_status, $skill, $skill_text);	
							}														
						break;																		
					}																			
		} else {
			$product = new Product;
		
			$info = new uagent_info; 
			$test = $info->DetectTierIphone();
			if ($test == true) {
				$windows_phone = $info->DetectWindowsPhone7();
				if ($windows_phone == true) {
					$_SESSION['phone'] = "windows";
					$_SESSION['device'] = "full";
					$device = "full";		
				} else {
					$device = "mobile";	
					$_SESSION['device'] = "mobile";
					$_SESSION['phone'] = "other";		
				}
			} else {
				$device = "full";
				$_SESSION['device'] = "full";
			}
			
			$product_array = $product->get_random_product_list();
			
			if ($_SESSION['device'] == "full") {								
				public_full_header_html('prototype');			
				product_random_display($product_array);									
			} else {
//				public_mobile_header_html('prototype');			
				product_random_display_mobile($product_array);									
				mobile_loader_box();																															
			}	
		}			

	$general_content->html_footer();
?>