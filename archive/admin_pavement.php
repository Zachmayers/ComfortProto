<?php
//Page Description

//Required files
	require_once('html/general_content_html.php');
	require_once('admin/admin_pavement_html_class.php');
																																																																																																														
	require_once('classes/admin.class.php');		
	require_once('classes/employer.class.php');		
	require_once('classes/member.class.php');		
	require_once('classes/store.class.php');		
	require_once('classes/verification.class.php');		
	
//start session
	session_start();
	$admin = new Admin;
	$utilities = new Utilities;
	$version = $utilities->version;	
	
//name of javascript file
	$js_file = "";
	
//get page variable
	$page = $_GET['page'];
	
//define objects
	$admin_content = new Admin_Content;
	
// display header, with name, type, and required javascript file
	if ($_SESSION['pavement'] == "yes") {
		
		//display page based on page variable
		switch($page) {
			
			default:
				$list_array = $admin->get_pavement_lists();
				$admin_content->html_top("", "main");
				main_pavement_html($list_array);				
			break;
			
			case "list":
				$list_array = $admin->get_pavement_list_details($_GET['regionID']);
				$admin_content->html_top("", "main");
				if ($list_array == "NA") {
					echo "<h3>Nothing Here</h3>";							
				} else {
					pavement_list_html($list_array);
				}				
			break;	
			
			case "store":
				$store_array = $admin->get_pavement_store_details($_GET['storeID']);
				$admin_content->html_top("", "main");
				if ($store_array == false) {
					echo "<h3>Nothing Here</h3>";
				} else {
					pavement_store_html($store_array);	
				}
			break;	
			
			case "pavement_ajax":				
				$database = new Database;
				$database->query("SELECT * FROM pavement_stores WHERE storeID = :storeID");									
				$database->bind(':storeID', $_POST['storeID']);									
				$store_array = $database->single();	
				
				
				//create a new employer
				$verification = new Verification;
			
				$firstname = trim($_POST['first_name']);
				$lastname = trim($_POST['last_name']);
				$username = trim($_POST['email']);
				$company = trim($_POST['company']);
				$position = trim($_POST['position']);
				$website = "";
				$access = "catscradle";
				
				$reference['refID'] = "P";
				$reference['CMP'] = "P";
				$reference['RGN'] = "P";
				$reference['STE']  = "P";
				$reference['DMG'] = "P";
				$reference['AD'] = "P";
				$reference['MSCA'] = "P";
				$reference['MSCB'] = "P";											
			
				if ($firstname == "" || $lastname == "" || $position == "") {
					echo "empty";
				} elseif (isset($_SESSION['userID'])) {
					echo "login";
				} elseif (filter_var($username, FILTER_VALIDATE_EMAIL) !== false) {
					$result = $verification->register_employer_pavement($firstname, $lastname,  $username, $store_array['temp_pass'], $access, $store_array['name'], $position, $store_array['website'], $reference);

					//get userID
					if ($result == "duplicate") {
						echo $result;
					} else {
						$database = new Database;
						$database->query("SELECT userID FROM members WHERE email = :email");									
						$database->bind(':email', $username);									
						$user = $database->single();	
						$userID = $user['userID'];	
						
						//no longer auto-login
												
/*
						$_SESSION['type'] = "employer";
						$_SESSION['userID'] = $userID;	
						$_SESSION['device'] = "full";	
*/
					}				
				} else {
					echo "email";
				}	
				
				if ($result == "yes") {
					//add store
					$store = new Store("NA");		
						
					$store_array = array("name" => $store_array['name'], "address" => $store_array['address'], "zip" => $store_array['zip'], 
													"description" => $store_array['description'], "website" => $store_array['website'], 
													"facebook" => $store_array['facebook'], "twitter" => $store_array['twitter']);						
					$storeID = $store->add_store($store_array);
					
					//verify account
					$database = new Database;
					$database->query("UPDATE members SET email_validation = :yes WHERE userID = :userID LIMIT 1");									
					$database->bind(':userID', $userID);									
					$database->bind(':yes', 'Y');									
					$database->execute();	

					$database = new Database;
					$database->query("UPDATE pavement_stores SET open = :open WHERE storeID = :storeID LIMIT 1");									
					$database->bind(':storeID', $_POST['storeID']);									
					$database->bind(':open', 'N');									
					$database->execute();						
					//login
					echo "Yes";
				}
			
			break;			
		}	
	} else {
		$admin_content->login_warning_html();		
	}
	//display footer
	if ($page != "pavement_ajax") {
		$admin_content->html_footer();
	}
?>