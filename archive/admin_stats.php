<?php
//Page Description

//Required files
	require_once('html/general_content_html.php');
	require_once('admin/admin_stats_html_class.php');
																																																																																																														
	require_once('classes/admin.class.php');		
	require_once('classes/employee.class.php');		
	require_once('classes/employer.class.php');		
	require_once('classes/member.class.php');		
	require_once('classes/candidate.class.php');		

	
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
	if ($_SESSION['stats'] == "yes") {
		
		//display page based on page variable
		switch($page) {
			
			default:
				$admin_content->html_top("", "main");
				main_stats_html();				
			break;
			
			case "build_tracking":
				$admin_content->html_top("", "main");
				build_tracking_link_html();	
			break;	
			
			case "build_tracking_ajax":
				$tag_array = array();
				foreach($_POST as $key=>$row) {
					if ($row == "") {
						$row = "NA";
					}					
					$tag_array[$key] = "&".$key."=".$row;					
				}
					
				echo "<div id='link_info_holder'>";
					echo "<h3>Full Link</h3>";
					$full_link = "http://".$_POST['landing'];
					if (strpos($_POST['landing'], '?') === false) {
						if ($_POST['refID'] === "") {
							$full_link .= "?refID=NA";
						} else {
							$full_link .= "?refID=".$_POST['refID'];
						}
					} else {
						$full_link .= $tag_array['refID'];
					}
					$full_link .= $tag_array['CMP'].$tag_array['RGN'].$tag_array['DMG'].$tag_array['STE'].$tag_array['AD'].$tag_array['MSCA'].$tag_array['MSCB']; 
					echo $full_link;
					
					echo "<br /> &nbsp; <br />";
					
					echo "<h3>Tags Only</h3>";

					if ($_POST['refID'] == "") {
						$refID = "NA";
					} else {
						$refID = $_POST['refID'];
					}
					echo "refID=".$refID.$tag_array['CMP'].$tag_array['RGN'].$tag_array['DMG'].$tag_array['STE'].$tag_array['AD'].$tag_array['MSCA'].$tag_array['MSCB'];

	
					echo "<br /> &nbsp; <br />";
					echo "<h3>HTML For Clickable Link</h3>";
					echo "<i>Cut and Paste for CraigsList ads</i><br />";
					$html_display = htmlspecialchars("<a href='".$full_link."'>".$_POST['click_text']."</a>");
					echo $html_display;
				echo "</div>";		

			break;
			
			case "cl_setup":
				$admin_content->html_top("", "main");
				if (isset($_GET['zip']) && isset($_GET['day']) && isset($_GET['month']) && isset($_GET['year'])) {
					//get results, job posts 40 miles from zip and posted greater than date
					$utilities = new Utilities;

					$coordinates = $utilities->get_coordinates($_GET['zip']);
					
					$longitude = $coordinates['longitude'];
					$latitude = $coordinates['latitude'];
					
					//40 mile appoximation, square
					$max_lat = $latitude + 0.57971;
					$min_lat = $latitude - 0.57971;
					$max_long = $longitude + 0.57827;
					$min_long = $longitude - 0.57827;
					
					if ($month < 10) {
						$month = "0".$month;
					}

					if ($day < 10) {
						$day = "0".$day;
					}
					
					$date = $_GET['year']."-".$_GET['month']."-".$_GET['day'];

					$database = new Database;
					
					//get all goups in date range, along with stores
					$database->query("SELECT * FROM group_post, stores, zcta WHERE group_post.post_status = :post_status 
												AND group_post.date_posted >= :date_posted
												AND stores.storeID = group_post.storeID
												AND stores.zip = zcta.zip
												AND zcta.latitude BETWEEN :min_lat AND :max_lat
												AND zcta.longitude BETWEEN :min_long AND :max_long");									
					$database->bind(':post_status', 'posted');									
					$database->bind(':date_posted', $date);		
					$database->bind(':min_lat', $min_lat);
					$database->bind(':max_lat', $max_lat);
					$database->bind(':min_long', $min_long);
					$database->bind(':max_long', $max_long);
					$groups_array = $database->resultset();	
					
					$job_array = array();
					
					foreach($groups_array as $row) {
						$database->query("SELECT * FROM jobs, jobs_specialties WHERE jobs.groupID = :groupID
													AND jobs.job_status = :job_status
													AND jobs_specialties.jobID = jobs.jobID");									
						$database->bind(':job_status', 'Open');									
						$database->bind(':groupID', $row['groupID']);		
						$jobs = $database->resultset();	
						
						$job_array[] = array("store" => $row['name'], "jobs" => $jobs);
					}

					cl_result_html($groups_array, $job_array);
				} else {
					cl_menu_html();	
				}
			break;			
			
			case "stats_menu":
				$admin_content->html_top("", "main");
				$type = $_GET['type'];
				stat_options_html($type);				
			break;
			
			case "site_totals":
				$admin_content->html_top("", "main");
				$region = $_GET['region'];
				$total_array = $admin->get_site_totals($region);
				site_totals_html($total_array);				
			break;	
			
			case "new_jobs":
				$admin_content->html_top("", "main");
				$new_jobs = $admin->get_admin_job_list("recent", "NA");
				new_jobs_html($new_jobs);					
			break;
			
			case "stores_region":
				$admin_content->html_top("", "main");
				$zip = $_GET['zip'];
				$store_array = $admin->get_stores_by_region($zip);
				store_by_region_html($store_array);					
			break;
			
			case "employer_email_list":
				$email_list = $admin->get_employer_email_list();
				employer_email_list_html($email_list);				
			break;																			
			
			case "email_stats":
				$admin_content->html_top("", "main");
				email_stats();				
			break;									
			
			case "view_stats":
				$admin_content->html_top("", "main");
				$type = $_GET['type'];
				
				if ($type == "month") {
					$day = 1;
				} else {
					$day = $_GET['day'];
				}
				$month = $_GET['month'];
				$year = $_GET['year'];
				
				$date = $year."-".$month."-".$day." 00:00:00";
				$date = date('Y-m-d H:i:s', strtotime($date));
				
				$employee_array = $admin->get_member_stats("employee", $type, $date);
				$employer_array = $admin->get_member_stats("employer", $type, $date);
				$jobs_array = $admin->get_member_stats("jobs", $type, $date);
				$logins_array = $admin->get_member_stats("logins", $type, $date);

				$employee_types = $admin->get_employee_types($employee_array);
				
				$job_types = $admin->get_job_types($jobs_array, $type, $date);
				
				//if the page is region specific, reduce results
				if (isset($_GET['region'])) {
					$region = $_GET['region'];
					
					$employee_array = $admin->employees_by_region($employee_array, $region);
					$employer_array = $admin->employers_by_region($employer_array, $region);
					$jobs_array = $admin->jobs_by_region($jobs_array, $region);
					$logins_array = $admin->logins_by_region($logins_array, $region);

					$employee_types = $admin->get_employee_types($employee_array);
					
					$job_types = $admin->get_job_types($jobs_array, $type, $date);
				}
				stats_html($type, $employee_array, $employer_array, $jobs_array, $logins_array, $employee_types, $job_types); 					
			break;
			
			case "job_views":
				//get job views from last 30 days
				switch($_GET['type']) {
					case "all":
						$job_views = get_job_views('all');
					break;
				}
			break;
			
			case "pavement_list":
				$admin_content->html_top("", "main");
				$list_array = $admin->get_pavement_lists();
				
				switch($_GET['type']) {
					case "menu":
						pavement_menu_html($list_array);
					break;
					
					case "list":
						$list_details = $admin->get_pavement_list_details($_GET['regionID']);
						if ($list_details == "NA") {
							echo "<h3>Nothing Here</h3>";							
						} else {
							pavement_view_list_html($list_details);
						}
					break;

					case "view_store":
						$store_details = $admin->get_pavement_store_details($_GET['storeID']);
						if ($store_details == false) {
							echo "<h3>Nothing Here</h3>";
						} else {
							pavement_edit_html($store_details);
						}
					break;					
				}
			break;
			
			case "pavement_ajax":
				$database = new Database;
				switch($_GET['type']) {
					case "add_list":				
						if (trim($_POST['city']) && trim($_POST['region']) != "") {
							$database->query("INSERT INTO pavement_list (city, region, open)
															VALUES (:city, :region, :open)");									
							$database->bind(':city', trim($_POST['city']));									
							$database->bind(':region', trim($_POST['region']));									
							$database->bind(':open', 'Y');									
							$database->execute();	
						}				
					break;
					
					case "add_store":
						$utilities = new Utilities;
						$temp_pass = $utilities->generateRandomString('7');
					
						$name = trim($_POST['store_name']);
						$address = trim($_POST['address']);	
						$zip = trim($_POST['zip']);				
						$description = trim($_POST['description']);
						$website = trim($_POST['website']);	
						$facebook = trim($_POST['facebook']);
						$twitter = trim($_POST['twitter']);
						$regionID = $_POST['regionID'];
						
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
						
						$pos = strpos($twitter, "http://");
						$pos_s = strpos($twitter, "https://");	
						$pos_a = strpos($twitter, "@");				
						if ($pos !== false) {
							$twitter = str_replace("http://", "", $twitter);
						}				
						if ($pos_s !== false) {
							$twitter = str_replace("https://", "", $twitter);
						}
						if ($pos_s !== false) {
							$twitter = str_replace("@", "twitter.com/", $twitter);
						}																																																													

						$database->query('INSERT INTO pavement_stores (regionID, name, address, zip, description, website, facebook, twitter, temp_pass)
													VALUES (:regionID, :name, :address, :zip, :description, :website, :facebook, :twitter, :temp_pass)');
						$database->bind(':regionID', $regionID);
						$database->bind(':name', $name);
						$database->bind(':address', $address);
						$database->bind(':zip', $zip);
						$database->bind(':description', $description);
						$database->bind(':website', $website);
						$database->bind(':facebook', $facebook);
						$database->bind(':twitter', $twitter);
						$database->bind(':temp_pass', $temp_pass);
						$database->execute();						
					break;
					
					case "edit_store":
						$storeID = $_POST['storeID'];
						$name = trim($_POST['store_name']);
						$address = trim($_POST['address']);	
						$zip = trim($_POST['zip']);				
						$description = trim($_POST['description']);
						$website = trim($_POST['website']);	
						$facebook = trim($_POST['facebook']);
						$twitter = trim($_POST['twitter']);
						
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
						
						$pos = strpos($twitter, "http://");
						$pos_s = strpos($twitter, "https://");	
						$pos_a = strpos($twitter, "@");				
						if ($pos !== false) {
							$twitter = str_replace("http://", "", $twitter);
						}				
						if ($pos_s !== false) {
							$twitter = str_replace("https://", "", $twitter);
						}
						if ($pos_s !== false) {
							$twitter = str_replace("@", "twitter.com/", $twitter);
						}																																																													

						$database->query('UPDATE pavement_stores 
															SET name = :name, address = :address, zip = :zip, description = :description,
															 website = :website, facebook = :facebook, twitter = :twitter
													WHERE storeID = :storeID');
						$database->bind(':storeID', $storeID);
						$database->bind(':name', $name);
						$database->bind(':address', $address);
						$database->bind(':zip', $zip);
						$database->bind(':description', $description);
						$database->bind(':website', $website);
						$database->bind(':facebook', $facebook);
						$database->bind(':twitter', $twitter);
						$database->execute();											
					break;
					
					case "close_list":				
						$database->query("UPDATE pavement_list SET open = :open WHERE regionID = :regionID");									
						$database->bind(':regionID', $_POST['regionID']);									
						$database->bind(':open', 'N');									
						$database->execute();	
					break;	
					
					case "delete_store":				
						$database->query("DELETE FROM pavement_stores WHERE storeID = :storeID ");									
						$database->bind(':storeID', $_POST['storeID']);									
						$database->execute();	
					break;					
									
				}
			break;
			
			case "6_month_list":
				$database = new Database;
				$database->query("SELECT firstname, lastname, email FROM members WHERE type = :type 
											AND valid = :valid
											AND email_validation = :email_validation
											AND current_login < date_sub(now(), interval 6 month)");									
				$database->bind(':type', 'employee');									
				$database->bind(':valid', 'Y');									
				$database->bind(':email_validation', 'Y');									
				$email_list = $database->resultset();	
				
				six_month_list_html($email_list);				
			break;
			
			case "pavement_stats":
				//get stats for pavement results
				
				//first get all pavement signups denoted by refID = P
				$database = new Database;
				$database->query("SELECT members.userID, members.firstname, members.lastname, members.email, 
															members.last_login, members.creation_date, password_reset.changed, employer.company			
											FROM members, password_reset, signup_ref, employer
											WHERE members.type = :type 
											AND signup_ref.refID = :refID
											AND members.userID = password_reset.userID
											AND employer.userID = members.userID
											AND members.userID = signup_ref.userID");									
				$database->bind(':type', 'employer');									
				$database->bind(':refID', 'P');									
				$pavement_list = $database->resultset();	
				
				//echo var_dump($pavement_list);
				
				$login_data = array();
				$job_data = array();
				$job_count = 0;
				
				foreach($pavement_list as $row) {
					//get logins
					$login_count = 0;
					if ($row['changed'] == 'Y') {
						$database->query("SELECT userID FROM login_track WHERE userID = :userID");									
						$database->bind(':userID', $row['userID']);									
						$login_count = count($database->resultset());							
					}
					
					$login_data[$row['userID']] = $login_count;
					
					$database->query("SELECT title, date_created FROM jobs 
												WHERE userID = :userID
												AND (job_status = :open OR job_status = :filled)");									
					$database->bind(':userID', $row['userID']);			
					$database->bind(':open', "Open");							
					$database->bind(':filled', "Filled");							
					$job_list = $database->resultset();							
					//var_dump($job_data);
					
					$job_count = $job_count + count($job_list);
					
					$job_data[$row['userID']] = $job_list;	
				}
				
				$admin_content->html_top("", "main");				
				pavement_stats_html($pavement_list, $login_data, $job_data, $job_count);								
			break;
			
			case "email_stats_ajax":
				$city = $_GET['city'];
				$type = $_GET['type'];
				//determine stats based on the emails that were sent out last month
					echo "<div id='email_stats_holder'>";
					$database = new Database;

					$utilities = new Utilities;
					
						switch($city) {
							default:
								echo "NO";
								$continue = "N";
							break;
							
							case "orlando":
								$coordinates_city = $utilities->get_coordinates('32801');			
								$continue = "Y";
							break;
							
							case "tampa":
								$coordinates_city = $utilities->get_coordinates('33602');			
								$continue = "Y";
							break;
							
							case "charlotte":
								$coordinates_city = $utilities->get_coordinates('28204');			
								$continue = "Y";
							break;			
				
							case "austin":
								$coordinates_city = $utilities->get_coordinates('78701');			
								$continue = "Y";
							break;
							
							case "charleston":
								$coordinates_city = $utilities->get_coordinates('29403');			
								$continue = "Y";
							break;																					
						}
						
						if ($continue == "Y") {				
							$longitude_city = $coordinates_city['longitude'];
							$latitude_city= $coordinates_city['latitude'];
							
							//40 mile appoximation, square
							$max_lat = $latitude_city + 0.57971;
							$min_lat = $latitude_city - 0.57971;
							$max_long = $longitude_city + 0.57827;
							$min_long = $longitude_city - 0.57827;
						
							switch($type) {
								case "employee":
									$database->query("SELECT zz_monthly_emails.email FROM zz_monthly_emails, members, zcta WHERE 
															zz_monthly_emails.email = members.email
															AND members.type = :type
															AND members.zip = zcta.zip
															AND zcta.latitude BETWEEN :min_lat AND :max_lat
															AND zcta.longitude BETWEEN :min_long AND :max_long");																			
									$database->bind(':type', "employee");																																								
									$database->bind(':min_lat', $min_lat);																																
									$database->bind(':max_lat', $max_lat);																																
									$database->bind(':min_long', $min_long);																																
									$database->bind(':max_long', $max_long);	
									$result = $database->resultset();
									
									$count = count($result);
								break;
								
								case "employer":
									$database->query("SELECT zz_monthly_emails.email FROM zz_monthly_emails, members, zcta, stores WHERE 
															zz_monthly_emails.email = members.email
															AND members.type = :type
															AND stores.userID = members.userID 
															AND stores.zip = zcta.zip
															AND zcta.latitude BETWEEN :min_lat AND :max_lat
															AND zcta.longitude BETWEEN :min_long AND :max_long");																			
									$database->bind(':type', "employer");																																								
									$database->bind(':min_lat', $min_lat);																																
									$database->bind(':max_lat', $max_lat);																																
									$database->bind(':min_long', $min_long);																																
									$database->bind(':max_long', $max_long);	
									$result = $database->resultset();
									
									$count = count($result);								
								break;
								
								case "server":
									$database->query("SELECT zz_monthly_emails.email, skills.skill FROM zz_monthly_emails, members, zcta, skills WHERE 
															zz_monthly_emails.email = members.email
															AND members.type = :type
															AND members.userID = skills.userID
															AND skills.skill = :skill
															AND members.zip = zcta.zip
															AND zcta.latitude BETWEEN :min_lat AND :max_lat
															AND zcta.longitude BETWEEN :min_long AND :max_long");																			
									$database->bind(':type', "employee");																																								
									$database->bind(':skill', "Server");																																								
									$database->bind(':min_lat', $min_lat);																																
									$database->bind(':max_lat', $max_lat);																																
									$database->bind(':min_long', $min_long);																																
									$database->bind(':max_long', $max_long);	
									$result = $database->resultset();

									$count = count($result);																
								break;
								
								case "bartender":
									$database->query("SELECT zz_monthly_emails.email, skills.skill FROM zz_monthly_emails, members, zcta, skills WHERE 
															zz_monthly_emails.email = members.email
															AND members.type = :type
															AND members.userID = skills.userID
															AND skills.skill = :skill
															AND members.zip = zcta.zip
															AND zcta.latitude BETWEEN :min_lat AND :max_lat
															AND zcta.longitude BETWEEN :min_long AND :max_long");																			
									$database->bind(':type', "employee");																																								
									$database->bind(':skill', "Bartender");																																								
									$database->bind(':min_lat', $min_lat);																																
									$database->bind(':max_lat', $max_lat);																																
									$database->bind(':min_long', $min_long);																																
									$database->bind(':max_long', $max_long);	
									$result = $database->resultset();

									$count = count($result);																								
								break;
								
								case "manager":
									$database->query("SELECT zz_monthly_emails.email, skills.skill FROM zz_monthly_emails, members, zcta, skills WHERE 
															zz_monthly_emails.email = members.email
															AND members.type = :type
															AND members.userID = skills.userID
															AND skills.skill = :skill
															AND members.zip = zcta.zip
															AND zcta.latitude BETWEEN :min_lat AND :max_lat
															AND zcta.longitude BETWEEN :min_long AND :max_long");																			
									$database->bind(':type', "employee");																																								
									$database->bind(':skill', "Manager");																																								
									$database->bind(':min_lat', $min_lat);																																
									$database->bind(':max_lat', $max_lat);																																
									$database->bind(':min_long', $min_long);																																
									$database->bind(':max_long', $max_long);	
									$result = $database->resultset();

									$count = count($result);																						
								break;
								
								case "host":
									$database->query("SELECT zz_monthly_emails.email, skills.skill FROM zz_monthly_emails, members, zcta, skills WHERE 
															zz_monthly_emails.email = members.email
															AND members.type = :type
															AND members.userID = skills.userID
															AND skills.skill = :skill
															AND members.zip = zcta.zip
															AND zcta.latitude BETWEEN :min_lat AND :max_lat
															AND zcta.longitude BETWEEN :min_long AND :max_long");																			
									$database->bind(':type', "employee");																																								
									$database->bind(':skill', "Host");																																								
									$database->bind(':min_lat', $min_lat);																																
									$database->bind(':max_lat', $max_lat);																																
									$database->bind(':min_long', $min_long);																																
									$database->bind(':max_long', $max_long);	
									$result = $database->resultset();

									$count = count($result);																								
								break;
								
								case "bus":
									$database->query("SELECT zz_monthly_emails.email, skills.skill FROM zz_monthly_emails, members, zcta, skills WHERE 
															zz_monthly_emails.email = members.email
															AND members.type = :type
															AND members.userID = skills.userID
															AND skills.skill = :skill
															AND members.zip = zcta.zip
															AND zcta.latitude BETWEEN :min_lat AND :max_lat
															AND zcta.longitude BETWEEN :min_long AND :max_long");																			
									$database->bind(':type', "employee");																																								
									$database->bind(':skill', "Bus");																																								
									$database->bind(':min_lat', $min_lat);																																
									$database->bind(':max_lat', $max_lat);																																
									$database->bind(':min_long', $min_long);																																
									$database->bind(':max_long', $max_long);	
									$result = $database->resultset();

									$count = count($result);																								
								break;
								
								case "kitchen":
									$database->query("SELECT zz_monthly_emails.email, skills.skill FROM zz_monthly_emails, members, zcta, skills WHERE 
															zz_monthly_emails.email = members.email
															AND members.type = :type
															AND members.userID = skills.userID
															AND skills.skill = :skill
															AND members.zip = zcta.zip
															AND zcta.latitude BETWEEN :min_lat AND :max_lat
															AND zcta.longitude BETWEEN :min_long AND :max_long");																			
									$database->bind(':type', "employee");																																								
									$database->bind(':skill', "Kitchen");																																								
									$database->bind(':min_lat', $min_lat);																																
									$database->bind(':max_lat', $max_lat);																																
									$database->bind(':min_long', $min_long);																																
									$database->bind(':max_long', $max_long);	
									$result = $database->resultset();

									$count = count($result);																																
								break;
							}
							echo "<h3>".$city."</h3>";
							echo $type.": ".$count."<br />";
						}
					echo "</div>";
			break;
			
			case "product_options":
				$admin_content->html_top("", "main");
				amazon_product_options();
			break;
			
			case "product_questions":
				$database = new Database;
				$database->query("SELECT * FROM amazon_questions");																			
				$question_array = $database->resultset();

				$admin_content->html_top("", "main");
				amazon_question_list($question_array);				
			break;
			
			case "view_question":
				$questionID = $_GET['ID'];
				
				//get question info
				$database = new Database;
				$database->query("SELECT * FROM amazon_questions WHERE questionID = :questionID");																			
				$database->bind(':questionID', $questionID);	
				$question_array = $database->single();
				
				$database->query("SELECT * FROM amazon_question_type WHERE questionID = :questionID");																			
				$database->bind(':questionID', $questionID);	
				$question_type = $database->resultset();				
				
				$database->query("SELECT * FROM amazon_products, amazon_product_question
												WHERE amazon_product_question.questionID = :questionID
												AND amazon_products.productID = amazon_product_question.productID");																			
				$database->bind(':questionID', $questionID);	
				$question_products = $database->resultset();				

				$question_data['question_info'] = $question_array;
				$question_data['question_type'] = $question_type;
				$question_data['product_array'] = $question_products;
				
				//all products
				$database->query("SELECT * FROM amazon_products");																			
				$product_list = $database->resultset();

				$admin_content->html_top("", "main");							 
				amazon_question($question_data, $product_list);
			break;
			
			case "view_product":
				$productID = $_GET['ID'];
				
				//get product info
				$database = new Database;
				$database->query("SELECT * FROM amazon_products WHERE productID = :productID");																			
				$database->bind(':productID', $productID);	
				$product_info = $database->single();

				//get product info
				$database->query("SELECT * FROM amazon_product_question, amazon_questions 
												WHERE amazon_product_question.productID = :productID
												AND amazon_questions.questionID = amazon_product_question.questionID");																			
				$database->bind(':productID', $productID);	
				$product_attachments = $database->resultset();				

				$database->query("SELECT * FROM amazon_questions");																			
				$question_list = $database->resultset();

				$admin_content->html_top("", "main");
				amazon_product($product_info, $product_attachments, $question_list);			
			break;
			
			case "product_list";
				$database = new Database;
				$database->query("SELECT * FROM amazon_products");																			
				$product_list = $database->resultset();

				$admin_content->html_top("", "main");
				amazon_product_list($product_list);						
			break;		
			
			case "amazon_ajax":
				$type = $_GET['type'];
				
				switch($type) {
					case "add_new_question":
						$question_text = trim($_POST['question_text']);
						$no_answer = trim($_POST['no_answer']);
						$question_type = trim($_POST['question_type']);
						$new_question_key = trim($_POST['new_question_key']);
						
						if ($new_question_key == "Handle1t") {
							$type_array = explode(",", $question_type);
									
							$database = new Database;
							$database->query("INSERT INTO amazon_questions (question, none_text)
															VALUES (:question, :none_text)");									
							$database->bind(':question', $question_text);									
							$database->bind(':none_text', $no_answer);									
							$database->execute();	
							$questionID = $database->lastInsertId();
												
							foreach($type_array as $type) {
								$database->query("INSERT INTO amazon_question_type (questionID, type)
																VALUES (:questionID, :type)");									
								$database->bind(':questionID', $questionID);									
								$database->bind(':type', $type);									
								$database->execute();								
							}		
						}
						
						echo $questionID;
					break;
					
					case "remove_question":
						$questionID = $_POST['questionID'];
						$remove_question_key = trim($_POST['remove_question_key']);

						if ($remove_question_key == "Handle1t") {					
							$database = new Database;
							$database->query('UPDATE amazon_questions SET removed = :removed
														WHERE questionID = :questionID LIMIT 1');
							$database->bind(':removed', "Y");			
							$database->bind(':questionID', $questionID);
							$database->execute();
						}			
					break;
					
					case "add_product":
						$product_name = trim($_POST['product_name']);
						$text_link = trim($_POST['text_link']);
						$image_link = trim($_POST['image_link']);
						$add_product_key = trim($_POST['add_product_key']);

						if ($add_product_key == "Handle1t") {
							$database = new Database;
							$database->query("INSERT INTO amazon_products (product, text_link, image_link)
															VALUES (:product, :text_link, :image_link)");									
							$database->bind(':product', $product_name);									
							$database->bind(':text_link', $text_link);									
							$database->bind(':image_link', $image_link);									
							$database->execute();	
							$productID = $database->lastInsertId();												
						}		
						
						echo $productID;	
					break;
					
					case "edit_product":
						$productID = $_POST['productID'];
						$product_name = trim($_POST['product_name']);
						$text_link = trim($_POST['text_link']);
						$image_link = trim($_POST['image_link']);
						$edit_product_key = trim($_POST['edit_product_key']);

						if ($edit_product_key == "Handle1t") {
							$database = new Database;
							$database->query("UPDATE amazon_products SET
															product = :product, 
															text_link = :text_link, 
															image_link = :image_link
															WHERE productID = :productID");									
							$database->bind(':product', $product_name);									
							$database->bind(':text_link', $text_link);									
							$database->bind(':image_link', $image_link);									
							$database->bind(':productID', $productID);									
							$database->execute();	
						}		
					break;					
					
					case "edit_question":
						$questionID = trim($_POST['questionID']);
						$question_text = trim($_POST['question_text']);
						$no_answer = trim($_POST['no_answer']);
						$question_type = trim($_POST['question_type']);
						$edit_question_key = trim($_POST['edit_question_key']);
						
						if ($edit_question_key == "Handle1t") {
							$type_array = explode(",", $question_type);
									
							$database = new Database;
							$database->query("UPDATE amazon_questions SET
															question = :question,
															none_text = :none_text
															WHERE questionID = :questionID");									
							$database->bind(':question', $question_text);									
							$database->bind(':none_text', $no_answer);									
							$database->bind(':questionID', $questionID);									
							$database->execute();	
							
							//remove types
							$database->query("DELETE FROM amazon_question_type WHERE questionID = :questionID");									
							$database->bind(':questionID', $questionID);									
							$database->execute();	
												
							foreach($type_array as $type) {
								$database->query("INSERT INTO amazon_question_type (questionID, type)
																VALUES (:questionID, :type)");									
								$database->bind(':questionID', $questionID);									
								$database->bind(':type', $type);									
								$database->execute();								
							}		
						}
					break;
					
					case "add_product_relation":
						$questionID = $_POST['questionID'];
						$productID = $_POST['productID'];
						$add_product_key = trim($_POST['add_product_key']);

						if ($add_product_key == "Handle1t") {
							$database = new Database;
							$database->query("INSERT INTO amazon_product_question (questionID, productID)
															VALUES (:questionID, :productID)");									
							$database->bind(':productID', $productID);									
							$database->bind(':questionID', $questionID);									
							$database->execute();	
						}
					break;
					
					case "remove_product_relation":
						$questionID = $_POST['questionID'];
						$productID = $_POST['productID'];

						$database = new Database;
						$database->query("DELETE FROM amazon_product_question WHERE questionID = :questionID AND productID = :productID LIMIT 1");									
						$database->bind(':questionID', $questionID);									
						$database->bind(':productID', $productID);									
						$database->execute();						
					break;
				}
			break;
			
			//BOUNTY & BOOSTED AREA
			case "bounty_menu":
				$admin_content->html_top("", "main");				
				bounty_menu_html();
			break;	
			
			case "bounty":
				$admin_content->html_top("", "main");				

				$admin = new Admin;
				switch($_GET['type']) {
					case "current":
						$job_list = $admin->get_bounty_jobs("current");
						bounty_job_list_html("Current", $job_list);
					break;
					
					case "unpaid":
						$job_list = $admin->get_bounty_jobs("unpaid");
						bounty_job_list_html("Unpaid Bounties", $job_list);				
					break;
					
					case "follow_up":
						$job_list = $admin->get_bounty_jobs("Follow Up");
						
						$combined_job_list = $job_list['second'] + $job_list['first'];
						bounty_job_list_html("Unpaid Bounties", $job_list);				
					break;
					
					case "details":
						$jobID = $_GET['jobID'];
						
						$bounty_details = $admin->get_bounty_details($jobID);
						bounty_details_html($bounty_details);										
					break;
				}
			break;
			
			case "bounty_stats_choose":
				$admin_content->html_top("", "main");				
				bounty_stats_choose_html();								
			break;
			
			case "bounty_stats_results":
/*
				$day = $_GET['day'];
				$month = $_GET['month'];
				$year = $_GET['year'];
				
				$date = $year."-".$month."-".$day." 00:00:00";
				$date = date('Y-m-d H:i:s', strtotime($date));
*/
				
				$average_array = $admin->get_bounty_stats("rolling_averages");
				
				$admin_content->html_top("", "main");				
				bounty_stats_results_html($average_array);								
			break;
			
			case "boosted_jobs":
				$type = $_GET['type'];

				$boosted_list=$admin->get_boosted_jobs($type);

				$admin_content->html_top("", "main");				
				boosted_job_list_html($type, $boosted_list);

?>				
				<script>
					$(document).ready(function(){			
						
						$(".save_boost").click(function() {	
							alert("HERE");
							boostID = $(this).attr('ID');						
							month = $("#month_"+boostID).val();
							day = $("#day_"+boostID).val();
							year = $("#year_"+boostID).val();
								
							dataString = "boostID=" + boostID + "&month=" + month + "&day=" + day + "&year=" + year;
								alert(dataString);					
								$.ajax({
									type: "POST",
									url: "update_admin.php?type=save_boost",
									data: dataString,
									success: function(data) {
										alert(data);
										window.location.reload();
									}
								});	
							return false;			

							})	
						})	
				</script>
<?php																		
			break;
			
			
			case "paid_jobs":

				$paid_jobs = $admin->get_new_group_jobs();

				$admin_content->html_top("", "main");				
				paid_job_list_html($paid_jobs);

?>				
				<script>
					$(document).ready(function(){			
						
						$(".save_cl_post").click(function() {	
							alert("HERE");
							groupID = $(this).attr('ID');						
							month = $("#month_"+groupID).val();
							day = $("#day_"+groupID).val();
							year = $("#year_"+groupID).val();
								
							dataString = "groupID=" + groupID + "&month=" + month + "&day=" + day + "&year=" + year;
								alert(dataString);					
								$.ajax({
									type: "POST",
									url: "update_admin.php?type=save_cl_post",
									data: dataString,
									success: function(data) {
										alert(data);
										window.location.reload();
									}
								});	
							return false;			

							})	
						})	
				</script>
<?php																
			break;			

			case "insightly_menu":
			
			if (isset($_GET['year']) && isset($_GET['month']) && isset($_GET['year']))	{
				$date = $_GET['year']."-".$_GET['month']."-".$_GET['day']." 00:00:00";
				//get new employers
				$database = new Database;
				$database->query("SELECT * FROM members, stores WHERE members.type= :type
												AND stores.userID = members.userID
												AND members.creation_date > :date_created");	
				$database->bind(':type', 'employer');									
				$database->bind(':date_created', $date);																																							
				$new_employers = $database->resultset();
				
				//get latest jobs
				$database->query("SELECT members.userID, members.email, stores.name, stores.address, stores.zip, stores.storeID, jobs.date_created
												 FROM members, stores, jobs WHERE members.type= :type
												AND jobs.userID = members.userID
												AND jobs.storeID = stores.storeID
												AND jobs.date_created >= :date_created
												AND jobs.job_status = :job_status
												ORDER BY members.userID ASC");																			
				$database->bind(':type', 'employer');									
				$database->bind(':date_created', $date);																																							
				$database->bind(':job_status', 'Open');																																							
				$new_jobs = $database->resultset();

				//get last employer logins
				$database->query("SELECT * FROM members WHERE members.type= :type
												AND current_login >= :date");	
				$database->bind(':type', 'employer');									
				$database->bind(':date', $date);																																							
				$logins = $database->resultset();

				$insightly_data = array("new_employers" => $new_employers, "new_jobs" => $new_jobs, "logins" => $logins);
			} else {
				$insightly_data = "N";
			}		

				$admin_content->html_top("", "main");				
				insightly_options_html($insightly_data, $date)
?>				
				<script>
					$(document).ready(function(){			
						
						$("#get_insightly_updates").click(function() {	
							alert("HERE");
							groupID = $(this).attr('ID');						
							month = $("#month").val();
							day = $("#day").val();
							year = $("#year").val();
							
							window.location = "admin_stats.php?page=insightly_menu&day=" + day + "&month=" + month + "&year=" + year;	
							})	
						})	
				</script>
<?php																
			break;			

			case "mailer_indicators":
			
			if (isset($_GET['year']) && isset($_GET['month']) && isset($_GET['year']))	{
				$date = $_GET['year']."-".$_GET['month']."-".$_GET['day']." 00:00:00";
				//get new employers
				$database = new Database;
				$database->query("SELECT job_match.userID, previous_employment.ID, previous_employment.end_month, previous_employment.end_year, previous_employment.company, previous_employment.position, previous_employment.current
												FROM job_match, previous_employment 
												WHERE job_match.date_responded > :date_responded
												AND job_match.userID = previous_employment.userID");	
				$database->bind(':date_responded', $date);																																							
				$employment_list = $database->resultset();
				
				$indicator_array = array();
				$employmentID_array = array();
				
				if (count($employment_list) >0) {
					foreach($employment_list as $row) {
						if (!in_array($row['ID'], $employmentID_array)) {
							if ($row['current'] == "Y") {
								$indicator_array[] = $row;
								$employmentID_array[] = $row['ID'];
							} elseif ($row['end_year'] == $_GET['year'] && $row['end_month'] >= $_GET['month']) {
								$indicator_array[] = $row;		
								$employmentID_array[] = $row['ID'];													
							}
						}
					}
				}
			} else {
				$indicator_array = "N";
			}		

				$admin_content->html_top("", "main");				
				mailer_indicator_html($indicator_array, $date)
?>				
				<script>
					$(document).ready(function(){			
						
						$("#get_indicator_employers").click(function() {	
							groupID = $(this).attr('ID');						
							month = $("#month").val();
							day = $("#day").val();
							year = $("#year").val();
							
							window.location = "admin_stats.php?page=mailer_indicators&day=" + day + "&month=" + month + "&year=" + year;	
							})	
						})	
				</script>
<?php																
			break;						

			case "ad_feed":
				//get new employers
				$database = new Database;
				$database->query("SELECT * FROM jobs
												WHERE expiration_date > NOW()
												AND job_status = :status
												ORDER BY date_created DESC LIMIT 100");	
				$database->bind(':status', 'Open');																																							
				$job_list = $database->resultset();
				$snippet_details = array();
				
				foreach($job_list as $row) {
					$opportunity = new Opportunity($row['jobID']);
					$opportunity_data = $opportunity->get_opportunity_data();
					
					$store_zip = $opportunity_data['job_data']['store']['zip'];
					$city_state = $utilities->get_city_state($store_zip);

					$job_data						= $opportunity_data['job_data'];
			
					$jobID							= $job_data['general']['jobID'];
					$store_name					= $job_data['store']['name'];
					$store_zip						= $job_data['store']['zip'];
					$title		 						= $job_data['general']['title'];
					$description					= $job_data['general']['description'];
					$main_skill		 			= $job_data['skills']['main_skill']['specialty'];
					$post_type					= $job_data['general']['post_type'];
					$date_created				= $job_data['general']['date_created'];
					$expiration_date			= $job_data['general']['expiration_date'];
					$schedule						= $job_data['general']['schedule'];
					$address						= $job_data['store']['address'];
					$zip								= $job_data['store']['zip'];
					$comp_type					= $job_data['general']['comp_type'];
					$comp_value					= $job_data['general']['comp_value'];
					$comp_value_high			= $job_data['general']['comp_value_high'];
					$comp_value_low			= $job_data['general']['comp_value_low'];				
			
					$sub_skills						= $job_data['skills']['sub_skills'];
					$requirements		 		= $job_data['requirements'];
					
					$requirement_text = "";
					foreach ($requirements as $row) {
						$requirement_text .= $row['requirement']." ";
					}

					$snippet_details[] = array("snippet_title" => $title,
															"snippet_description" => $description." - ".$requirement_text,
															"snippet_pay_type" => $comp_type,
															"snippet_pay_amount" => $comp_value." ".$comp_value_high." ".$comp_value_low,
															"snippet_date" => $date_created,
															"store_name" => $store_name,
															"store_address" => $address." ".$city_state['city'].", ".$city_state['state']." ".$zip,
															"snippet_requirements" => $requirements,
															"jobID" => $job_data['general']['jobID'],
															"main_skill" => $main_skill,
															"public_hash" => $job_data['general']['public_hash'],
															"image" => $job_data['store']['image']);
				}
				$admin_content->html_top("", "main");				
				
				ad_feed_html($snippet_details);								
			break;						
			
			case "employee_list":
				$region = $_GET['region'];
				if ($region == "orlando" || $region == "tampa" || $region == "charlotte" || $region == "charleston") {
					$user_array = $admin->get_employee_email_list($region);
					employee_list_html($region, $user_array);								
				}
			break;	
			
			case "store_images":
				$admin_content->html_top("", "main");				

				//get images from last 50 job posts
				$database = new Database;
				$database->query("SELECT stores.storeID, stores.image, stores.name, stores.zip
												FROM jobs, stores
												WHERE jobs.storeID = stores.storeID
												AND jobs.job_status = :job_status
												ORDER BY jobs.jobID DESC LIMIT 50");	
				$database->bind(':job_status', "Open");																																							
												
				$store_list = $database->resultset();
				store_image_list_html($store_list);								
			break;	
			
			
		}	
		
	} else {
		$admin_content->login_warning_html();		
	}
	//display footer
	if ($page != "build_tracking_ajax" && $page != "pavement_ajax" && $page != "email_stats_ajax" && $page != "amazon_ajax") {
		$admin_content->html_footer();
	}
?>