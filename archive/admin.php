<?php
//Page Description

//Required files
	require_once('html/general_content_html.php');
	require_once('admin/admin_main_html_class.php');
	require_once('admin/admin_logins_html_class.php');
	require_once('admin/admin_members_html_class.php');
	require_once('admin/admin_stores_html_class.php');		
	require_once('admin/admin_jobs_html_class.php');
	require_once('admin/admin_profile_html_class.php');
	require_once('admin/admin_view_job_html_class.php');
	require_once('admin/admin_view_store_html_class.php');		
	require_once('admin/admin_job_template_html_class.php');		
	require_once('admin/admin_ads_html_class.php');			
																																																																																																														
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
	$js_file = "<script type='text/javascript' src='js/admin.js?v=".$version."'></script>";
	
//get page variable
	$page = $_GET['page'];
	
//define objects
	$admin_content = new Admin_Content;
	
// display header, with name, type, and required javascript file
	if ($_SESSION['admin'] == "yes") {
		$admin_content->html_top("", "");
		
		//display page based on page variable
		switch($page) {
			
			default:
				$counts = $admin->get_admin("member_count");
				$member_count = $counts[0];
				$employee_count = $counts[1];
				$employer_count = $counts[2];
				$old_employment = $admin->get_old_employment_profiles();
				main_html($member_count, $employee_count, $employer_count, $old_employment);
?>				
	<script>
					$(document).ready(function(){			
						
						$("#view_job").click(function() {	
							jobID = $("#jobID").val();						
							alert(jobID);					
							window.location = "admin.php?page=view_job&type=current&id=" + jobID;				
							return false;			
						})							
					})	
	</script>
<?php												
			break;
			
			case "logins":
				$ID = $_GET['id'];			
				$logins_array = $admin->get_user_logins($ID);
				all_logins_html($logins_array);	
			break;
			
			case "edits":
				$ID = $_GET['id'];			
				$edit_array = $admin->get_member_info("edits", $ID);
				all_edits_html($edit_array);	
			break;			
			
			case "members":
				$type = $_GET['type'];
				if ($type == "employee") {
					$criteria = $_GET['criteria'];
					$term = $_GET['term'];
					
					if ($criteria == "" && $term == "") {
						$members_array = array();
					} else {
						$members_array = $admin->search_employees($criteria, $term);
					}
					employees_html($members_array);
				} else {
					$criteria = $_GET['criteria'];
					$term = $_GET['term'];
					
					if ($criteria == "" && $term == "") {
						$members_array = $admin->get_member_info($type, "");
					} else {
						$members_array = $admin->search_employers($criteria, $term);
					}
					employers_html($members_array);
				}	
			break;
			
			case "stores":
				$site_type = $utilities->site_type;
				
				if ($site_type == "live") {
					$upload_url = "//servebartendcook.com/upload_pic";
				} elseif ($site_type == "prototype") {
					$upload_url = "//threewhitebirds.com/CLEAN/upload_pic";	
				}
			
				$storeID = $_GET['storeID'];

				$store_data = $admin->get_store($storeID);
				admin_store_data_html($store_data, $upload_url);	
?>
				<script>
					
					$(document).ready(function(){			
						store_photo();
						$("#find_store").click(function() {	
							storeID = $("#storeID").val();						
							window.location = "admin.php?page=stores&storeID="+storeID;
							
						})	
						
										
					})	
				</script>
<?php
			break;
			
			case "create_employer":
					create_employer_html();			
			break;
			
			case "create_culinary":
					create_culinary_member();
?>
				<script>
					$(document).ready(function(){			
						
						$("#save_culinary").click(function() {	
							email = $("#email").val();						
							school = $("#school").val();
							password = $("#password").val();
							year = $("#year").val();
							month = $("#month").val();
							day = $("#day").val();
							pass = $("#pass").val();

							if (isNaN(year) || isNaN(month) || isNaN(day)) {
								$("#date_error").show();
							} else {								
								dataString = "email=" + email + "&school=" + school + "&password=" + password + "&year=" + year + "&month=" + month + "&day=" + day + "&pass=" + pass;
								//alert(dataString);					
								$.ajax({
									type: "POST",
									url: "update_admin.php?type=add_culinary_member",
									data: dataString,
									success: function(data) {
										alert(data);
										$("#success").show();
									}
								});	
							}	
							return false;			
						})	
					})	
				</script>
<?php													
								
			break;			
			
			case "user_data":
					$type = $_GET['type'];

					switch($type) {
						default:
							user_data_html();			
						break;
						
						case "search":
							$zip = $_GET['zip'];
							$skill = $_GET['skill'];
							
							$term_array = array($zip, $skill);

							$member_array = $admin->search_employees("user_data", $term_array);
							user_data_results_html($member_array, $skill, $zip);						
						break;
					}
			break;
			
			case "job_data":
					$type = $_GET['type'];

					switch($type) {
						default:
							job_data_html();			
						break;
						
						case "search":
							$zip = $_GET['zip'];
							$skill = $_GET['skill'];

							$term_array = array($zip, $skill);

							$job_array = $admin->search_employers("job_data", $term_array);
							job_data_results_html($job_array, $skill, $zip);						
						break;
					}
			break;			
			
			case "member_details":
				$ID = $_GET['id'];	
				$member = new Member($ID);
						
				$logins = $admin->get_user_logins($ID);
				$profile_details = $member->get_member_data();
				$activation_notes = $admin->get_member_info("activation_notes", $ID);
				$edit_array = $admin->get_member_info("edits", $ID);
				$last_edit = $edit_array[0];

				if ($profile_details['type'] == "employee") {
					profile_employee_menu_html($profile_details, $logins, $ID, $activation_notes, $last_edit);		
				} else {
					$employer= new Employer($ID);
					$employer_data = $employer->get_employer_data();
					$store_data = $employer_data['stores_jobs'];
					$store_array = $store_data['stores'];
					profile_employer_menu_html($profile_details, $logins, $store_array, $ID, $activation_notes, $employer_data);							
				}
				
?>
				<script>
					$(document).ready(function(){			
						$(".open_form").click(function() {
							form_type = $(this).attr('id');
							//alert(form_type);
							$('.change_form').hide();
							switch(form_type) {
								case "change_email":
									$("#change_email_holder").show();
								break;
	
								case "change_activation":
									$("#change_activation_holder").show();
								break;
							}
							return false;
						});	
						
						$("#change_email_button").click(function() {	
							userID = $("#userID").val();						
							email_setting = $("#email_setting").val();
							email_pass = $("#email_pass").val();
							dataString = "email_setting=" + email_setting + "&userID=" + userID + "&pass=" + email_pass;
							//alert(dataString);					
							$.ajax({
								type: "POST",
								url: "update_admin.php?type=change_email",
								data: dataString,
								success: function(data) {
									alert(data);
									window.location.reload();
								}
							});		
							return false;			
						})	
						
						$("#change_activation_button").click(function() {	
							userID = $("#userID").val();						
							activation_setting = $("#activation_setting").val();
							activation_reason = $("#activation_reason").val();
							activation_pass = $("#activation_pass").val();														
							dataString = "activation_setting=" + activation_setting + "&activation_reason=" + activation_reason + "&userID=" + userID + "&pass=" + activation_pass;					
							$.ajax({
								type: "POST",
								url: "update_admin.php?type=change_activation",
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
			
			case "employee_matches":
				$ID = $_GET['id'];			
				$match_array = $admin->get_matches("member", $ID);
				view_member_matches($match_array);
			break;
			
			case "view_response":
				$ID = $_GET['id'];			
				$matchID = $_GET['matchID'];			
				$question_array = $admin->get_questions($matchID);
				$match_array = $admin->get_matches("member", $ID);
				
				foreach ($match_array as $row) {
					$secondary_contact = $row['contact'];
					$message = $row['message'];
				}
				view_response_html($question_array, $secondary_contact, $message);
			break;
			
			case "current_jobs":
				$zip = $_GET['zip'];
				$jobs_array = $admin->get_admin_job_list("current", $zip);
				current_jobs_html($jobs_array);		
			break;						
						
			case "culinary_jobs":
				$zip = $_GET['zip'];
				$jobs_array = $admin->get_culinary_jobs();
				culinary_jobs($jobs_array);	
			break;
			
			case "archive_jobs":
				$zip = $_GET['zip'];
				$jobs_array = $admin->get_admin_job_list("archive", $zip);
				current_jobs_html($jobs_array);		
?>
<!--
				<script>
					$(document).ready(function(){			
						
						$(".unarchive").click(function() {	
							jobID = $(this).attr("id");		
							alert(jobID);				
							dataString = "jobID=" + jobID;
							//alert(dataString);					
							$.ajax({
								type: "POST",
								url: "update_admin.php?type=unarchive_job",
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
-->
<?php						
			break;			
			
			case "profile_pics":
				$member_array = $admin->get_member_info("profile_pics", "");
				echo count($member_array);
				$number_of_pages = ceil(count($member_array) / 50);
				if (isset($_GET['number'])) {
					$page = $_GET['number'];
				} else {
					$page = 1;
				}
				
				$array_page = $page - 1;				
				$lower_limit = $array_page * 25;
				
				if ($page != $number_of_pages) {
					$upper_limit = $lower_limit + 24;
				} else {
					$upper_limit = count($member_array) - $lower_limit;
				}
				
				$i = $lower_limit;
				$pic_array = array();
				
				foreach($member_array as $key=>$row) {
					if ($key == $i  && $i <= $upper_limit) {
						$pic_array[] = $row;
						$i++;
					}
				}
				
				profile_pics_html($pic_array, $page, $number_of_pages, "all");		
			break;
			
			case "month_profile_pics":
				if (isset($_GET['month']) && isset($_GET['year'])) {
					$month = $_GET['month'];
					$year = $_GET['year'];					
				} else {
					$month = "01";
					$year = "2017";
				}
				
				$date = $year."-".$month."-".$day." 00:00:00";
				
				$member_array = $admin->get_profile_pics_by_month($date);
				echo count($member_array);
				$number_of_pages = ceil(count($member_array) / 50);
				if (isset($_GET['number'])) {
					$page = $_GET['number'];
				} else {
					$page = 1;
				}
				
				$array_page = $page - 1;				
				$lower_limit = $array_page * 25;
				
				if ($page != $number_of_pages) {
					$upper_limit = $lower_limit + 24;
				} else {
					$upper_limit = count($member_array) - $lower_limit;
				}
				
				$i = $lower_limit;
				$pic_array = array();
				
				foreach($member_array as $key=>$row) {
					if ($key == $i  && $i <= $upper_limit) {
						$pic_array[] = $row;
						$i++;
					}
				}
				
				profile_pics_html($pic_array, $page, $number_of_pages, "month");		
			break;			
			
			case "gallery_pics":
				$member_array = $admin->get_member_info("gallery_pics", "");
				echo count($member_array);
				$number_of_pages = ceil(count($member_array) / 50);
				if (isset($_GET['number'])) {
					$page = $_GET['number'];
				} else {
					$page = 1;
				}
				
				$array_page = $page - 1;				
				$lower_limit = $array_page * 25;
				
				if ($page != $number_of_pages) {
					$upper_limit = $lower_limit + 24;
				} else {
					$upper_limit = count($member_array) - $lower_limit;
				}
				
				$i = $lower_limit;
				$pic_array = array();
				
				foreach($member_array as $key=>$row) {
					if ($key == $i  && $i <= $upper_limit) {
						$pic_array[] = $row;
						$i++;
					}
				}
				
				gallery_pics_html($pic_array, $page, $number_of_pages, "all");		
			break;
			
			case "month_gallery_pics":
				if (isset($_GET['month']) && isset($_GET['year'])) {
					$month = $_GET['month'];
					$year = $_GET['year'];					
				} else {
					$month = "01";
					$year = "2017";
				}
				
				$date = $year."-".$month."-".$day." 00:00:00";
				
				$member_array = $admin->get_profile_pics_by_month($date);
				echo count($member_array);
				$number_of_pages = ceil(count($member_array) / 50);
				if (isset($_GET['number'])) {
					$page = $_GET['number'];
				} else {
					$page = 1;
				}
				
				$array_page = $page - 1;				
				$lower_limit = $array_page * 25;
				
				if ($page != $number_of_pages) {
					$upper_limit = $lower_limit + 24;
				} else {
					$upper_limit = count($member_array) - $lower_limit;
				}
				
				$i = $lower_limit;
				$pic_array = array();
				
				foreach($member_array as $key=>$row) {
					if ($key == $i  && $i <= $upper_limit) {
						$pic_array[] = $row;
						$i++;
					}
				}
				
				gallery_pics_html($pic_array, $page, $number_of_pages, "month");		
			break;						
			
			case "videos":
				$member_array = $admin->get_member_info("videos", "");
				videos_html($member_array);		
			break;															
			
			case "store_job_list":
				$ID = $_GET['id'];
				$jobs_array = $admin->get_member_info("job_list", $ID);
				//echo $ID;
				jobs_by_store($jobs_array);	
			break;			
			
			case "view_profile":
				$profileID = $_GET['id'];
				$member = new Member($profileID);
				$member_data = $member->get_member_data();
				
				if ($member_data['type'] == "employee") {
							$utilities = new Utilities;
							$employee = new Employee($profileID);
		
							$member_data = $member->get_member_data();
							$employee_data = $employee->get_employee_data();
	
							$count = 0;
							//get total hospitality experience & other experience
							$past_employment = $employee_data['employment'];
							$total_experience = array();
							$hospitality_holder = array();
							$other_holder = array();	
							$unknown_holder = array();	

							$flat_employmentID_holder = array(); //use this to double check skills
			
							foreach($past_employment as $row) {
								//echo var_dump($row);
									if ($row['category'] == "other") {
										$other_holder[] = $row;
									} elseif ($row['category'] == "") {						
										$unknown_holder[] = $row;	
									} else {
										$hospitality_holder[] = $row;							
									}		
									
									$flat_employmentID_holder[] = $row['ID'];										
							}
							
							$total_experience['other'] = $utilities->determine_years_of_experience($other_holder);
							$total_experience['unknown'] = $utilities->determine_years_of_experience($unknown_holder);
							$total_experience['hospitality'] = $utilities->determine_years_of_experience($hospitality_holder);
							$total_experience['total'] = $total_experience['other'] + $total_experience['unknown'] + $total_experience['hospitality'];
							
							
							//get experience related to specific skills, workplace types
/*
							$experience = 0;
							$store_type = $utilities->general_store_types;
							$employee_store_type_experience = array();
							foreach($store_type as $row) {
								$test_holder = array();
								foreach($past_employment as $employment) {
									if ($employment['business_type'] == $row) {
										$test_holder[] = $employment;
									}
								}
			
								$experience = $utilities->determine_years_of_experience($test_holder);
								if ($experience > 0) {
									$employee_store_type[$row] = $experience;
								}
							}
*/
							
							//get experience related to specific positions
							$experience = 0;
							$unique_positions = $utilities->get_unique_array_values($past_employment, 'position');
							$employee_position_experience = array();
							foreach($unique_positions as $row) {
								$test_holder = array();
								foreach($past_employment as $employment) {
									if ($employment['position'] == $row) {
										$test_holder[] = $employment;
									}
								}
			
								$employee_position_experience[$row] = $utilities->determine_years_of_experience($test_holder);
							}
			
							//get experience related to specific skills
							//thos one is a little tricker, first we need to group the skills
							$experience = 0;
			
							$sub_skill_array = array();
							$usable_skill_array = array();
							foreach($employee_data['skills']['sub_skills'] as $row) {
								foreach($row as $inner_row) {
									//remove old skills not attached to a job
									if ($inner_row['employmentID'] > 0 && in_array($inner_row['employmentID'], $flat_employmentID_holder)) {
										//echo $inner_row['employmentID'].$inner_row['sub_skill']."-";
										$sub_skill_array[] = $inner_row['sub_skill'];
										$usable_sklll_array[] = $inner_row;	
									}	
								}
							}
							$unique_skills = array_unique($sub_skill_array);
							$employee_skills_experience = array();
							$old_employee_skills = array();
							
							foreach($unique_skills as $row) {
								
								$test_holder = array();
			
								foreach($usable_sklll_array as $skill) {
			
									if ($skill['sub_skill'] == $row) {
										//get employment data for attached skill
										foreach($past_employment as $employment) {
											if($employment['ID'] == $skill['employmentID']) {
												$test_holder[] = $employment;
											}
										}
										
										if ($skill['employmentID'] == 0) {
											$old_employee_skills[] = $row;
										}
									}
								}
								$experience = $utilities->determine_years_of_experience($test_holder);
								$employee_skills_experience[$row] = $experience;

							}
							
							//get employee skills that were from the old style, not attached to any job		
							
							//In case of an old profile, create a new description based on descriptons of old skills
/*
							if ($employee_data['general']['description'] == "") {
								if (count($employee_data['skills']['skills']) > 0) {
									foreach($employee_data['skills']['skills'] as $row) {
										if ($row['description'] != "") {
											$employee_data['description'] .= "<b>".$row['skill']."</b> - ".$row['description']."<br />&nbsp; <br />";
										}
									}
								}
							}				
*/
									
							if (count($employee_skills_experience) > 1) {
								arsort($employee_skills_experience);
							}
							
							if (count($employee_position_experience) > 1) {
								arsort($employee_position_experience);
							}							
					
					profile_html_employee($employee_data, $total_experience, $employee_store_type, $employee_position_experience, $employee_skills_experience, $old_employee_skills);
?>				
					<script>
						$(document).ready(function(){			
							$("#show_positions_button").click(function() {
						 		$(".hidden_position").show('fast');
								$(".show_positions_button").hide();
								$(".hide_positions_button").show();
								return false;			
							});
						
							$("#hide_positions_button").click(function() {
								$(".hidden_position").hide('fast');
								$(".show_positions_button").show();
								$(".hide_positions_button").hide();
								return false;			
							});	
							
							$("#show_skills_button").click(function() {
						 		$(".hidden_skill").show('fast');
								$(".show_skills_button").hide();
								$(".hide_skills_button").show();
								return false;			
							});
						
							$("#hide_skills_button").click(function() {
								$(".hidden_skill").hide('fast');
								$(".show_skills_button").show();
								$(".hide_skills_button").hide();
								return false;			
							});	
						
							$(".thumb").click(function() {
								var photoID = $(this).attr('ID');
								$(".profilephoto").hide();
								if (photoID == "profile") {
									$("#main_photo").show();
								} else {
									$("#"+photoID+"_large").show();	
								}
								return false;			
							});	
						
							$(".hospitality_header").click(function() {
								$(".hosp-exp").hide('fast');
								$(".total-exp").show('slow');
								return false;			
							});	
						
							$(".total_header").click(function() {
								$(".total-exp").hide('fast');
								$(".hosp-exp").show('slow');
								return false;			
							});	
						})	
					</script>
<?php										


				} else {
					$employer = new Employer($profileID);
					$employer_data = $employer->get_employer_data();

					profile_employer_html($member_data, $employer_data);					
				}						
			break;	
			
			case "view_job":
				$jobID = $_GET['id'];
				$type = $_GET['type'];
				
				$job = new Job($jobID);
				
				if ($type == "archive") {
					$job_data = $job->get_job_data(array('general', 'store', 'employer', 'requirements', 'skills', 'question_list', 'candidate_count', 'positive_list', 'negative_count', 'candidate_videos'));
				} else {
					$job_data = $job->get_job_data(array('general', 'store', 'employer', 'requirements', 'skills', 'question_list', 'candidate_count', 'positive_list', 'negative_count', 'candidate_videos'));
				}
				//get job view data
				$admin = new Admin;
				$job_views = $admin->get_job_views($jobID, $job_data);
				view_job_html($job_data, $job_views);
?>				
				<script>
					$(document).ready(function(){			
						
						$(".remove_job").click(function() {	
							jobID = $(this).attr('ID');						
							pass = $("#remove_job_pass").val();

							dataString = "jobID=" + jobID + "&pass=" + pass;
							alert(dataString);					
							$.ajax({
								type: "POST",
								url: "update_admin.php?type=remove_job",
								data: dataString,
								success: function(data) {
									alert(data);
									window.location = "admin.php";										
								}
							});		
							return false;			
						})	
					
					})	
				</script>
<?php										
			break;
			
			case "view_archive":
				$jobID = $_GET['id'];
				$type = $_GET['type'];
				
				$job = new Job($jobID);
				
				if ($type == "archive") {
					$job_data = $job->get_job_data(array('general', 'store', 'employer', 'requirements', 'skills', 'question_list', 'candidate_videos'));
				} else {
					$job_data = $job->get_job_data(array('general', 'store', 'employer', 'requirements', 'skills', 'question_list', 'candidate_videos'));
				}

				view_job_html($job_data);						
			break;			
			
			case "view_matches":
				$jobID = $_GET['id'];
				
				$match_array = $admin->get_matches("job", $jobID);
				
				match_list_html($match_array);
?>
			<script>
				$(document).ready(function(){			
					$(".filter").click(function() {
						filter_type = $(this).attr('id');
						alert(filter_type);
						$('.members').hide();
						switch(filter_type) {
							default:
								$(".members").show();
							break;
							
							case "N":
								$(".N").show();
							break;

							case "Y":
								$(".Y").show();
							break;
						}
						return false;
					});	
				})				
			</script>
<?php									
			break;
			
			case "view_candidate":
				$candidate = new Candidate($_GET['matchID']);
				$candidate_data = $candidate->get_candidate();
				$count = 0;
				//get total hospitality experience & other experience
				$past_employment = $candidate_data['employee_data']['employment'];
				$total_experience = array();
				$hospitality_holder = array();
				$other_holder = array();	
				$unknown_holder = array();	

				foreach($past_employment as $row) {
					//echo var_dump($row);
						if ($row['category'] == "other") {
							$other_holder[] = $row;
						} elseif ($row['category'] == "") {						
							$unknown_holder[] = $row;	
						} else {
							$hospitality_holder[] = $row;							
						}		
				}
				
				$total_experience['other'] = $utilities->determine_years_of_experience($other_holder);
				$total_experience['unknown'] = $utilities->determine_years_of_experience($unknown_holder);
				$total_experience['hospitality'] = $utilities->determine_years_of_experience($hospitality_holder);
				
				
				//get experience related to specific skills, workplace types
				$experience = 0;
				$store_type = $utilities->general_store_types;
				$employee_store_type_experience = array();
				foreach($store_type as $row) {
					$test_holder = array();
					foreach($past_employment as $employment) {
						if ($employment['business_type'] == $row) {
							$test_holder[] = $employment;
						}
					}

					$experience = $utilities->determine_years_of_experience($test_holder);
					if ($experience > 0) {
						$employee_store_type[$row] = $experience;
					}
				}
				
				//get experience related to specific positions
				$experience = 0;
				$unique_positions = $utilities->get_unique_array_values($past_employment, 'position');
				$employee_position_experience = array();
				foreach($unique_positions as $row) {
					$test_holder = array();
					foreach($past_employment as $employment) {
						if ($employment['position'] == $row) {
							$test_holder[] = $employment;
						}
					}

					$employee_position_experience[$row] = $utilities->determine_years_of_experience($test_holder);
				}

				//get experience related to specific skills
				//thos one is a little tricker, first we need to group the skills
				$experience = 0;

				$sub_skill_array = array();
				$usable_skill_array = array();
				foreach($candidate_data['employee_data']['skills']['sub_skills'] as $row) {
					foreach($row as $inner_row) {
						$sub_skill_array[] = $inner_row['sub_skill'];
						$usable_sklll_array[] = $inner_row;		
					}
				}
				$unique_skills = array_unique($sub_skill_array);
				$employee_skills_experience = array();
				$old_employee_skills = array();
				
				foreach($unique_skills as $row) {
					
					$test_holder = array();

					foreach($usable_sklll_array as $skill) {

						if ($skill['sub_skill'] == $row) {
							//get employment data for attached skill
							foreach($past_employment as $employment) {
								if($employment['ID'] == $skill['employmentID']) {
									$test_holder[] = $employment;
								}
							}
							
							if ($skill['employmentID'] == 0) {
								$old_employee_skills[] = $row;
							}
						}
					}
					$experience = $utilities->determine_years_of_experience($test_holder);
					//separate into gold (10 or great) silver (5 or great) and bronze (below 5)
					if ($experience >= 10) {
						$employee_skills_experience['gold'][$row] = $experience;
					} elseif ($experience >= 5) {
						$employee_skills_experience['silver'][$row] = $experience;						
					} elseif ($experience != 0) {
						$employee_skills_experience['bronze'][$row] = $experience;						
					}
				}
				
				//get employe skills that were from the old style, not attached to any job		
				
				//In case of an old profile, create a new description based on descriptons of old skills
				if ($candidate_data['general']['description'] == "") {
					if (count($candidate_data['employee_data']['skills']['skills']) > 0) {
						foreach($candidate_data['employee_data']['skills']['skills'] as $row) {
							if ($row['description'] != "") {
								$candidate_data['general']['description'] .= "<b>".$row['skill']."</b> - ".$row['description']."<br />&nbsp; <br />";
							}
						}
					}
				}				
				candidate_html($candidate_data, $total_experience, $employee_store_type, $employee_position_experience, $employee_skills_experience, $old_employee_skills);				
?>
			<script>
					$(".profile_tab").click(function() {
						profile_view = $(this).attr('ID');
						
						$('.profile_tab').removeClass('selected_tab');
						$('.profile_tab').addClass('unselected_tab');
						$('#'+profile_view+'').removeClass('unselected_tab');		
						$('#'+profile_view+'').addClass('selected_tab');
						
						if (profile_view == "profile") {
							$('.details').show();	
							$('#questions_holder').hide();	
							$('#message_holder').hide();														
						} else {
							$('.details').hide();
							$('#' + profile_view + '_holder').show();		
						}
						return false;
					});	
			</script>
<?php						
			break;
			
			case "advertising":
				$ad_data = $admin->get_ad_data();
				ad_data_html($ad_data);
?>				
				<script>
					$(document).ready(function(){			
						
						$("#submit_region").click(function() {	
							region = $("#region").val();						
							zip = $("#zip").val();
							pass = $("#region_pass").val();

							dataString = "region=" + region + "&zip=" + zip + "&pass=" + pass;
							alert(dataString);					
							$.ajax({
								type: "POST",
								url: "update_admin.php?type=new_region",
								data: dataString,
								success: function(data) {
									alert(data);
									if (data == "zip") {
										$('#region_warning').show();
									} else {
										window.location.reload();										
									}
								}
							});		
							return false;			
						})	
						
						$("#submit_ad").click(function() {	
							regionID = $("#regionID").val();						
							ad_type = $("#ad_type").val();
							ad_title = $("#ad_title").val();
							ad_link = $("#ad_link").val();
							deal = $("#deal").val();
							photo_link = $("#photo_link").val();
							description = $("#description").val();
							pass = $("#ad_pass").val();

							dataString = "regionID=" + regionID + "&ad_title=" + ad_title + "&ad_type=" + ad_type + "&ad_link=" + ad_link + "&deal=" + deal +"&photo_link=" + photo_link + "&description=" + description + "&pass=" + pass;
							alert(dataString);					
							$.ajax({
								type: "POST",
								url: "update_admin.php?type=new_ad",
								data: dataString,
								success: function(data) {
									alert(data);
									window.location.reload();
								}
							});		
							return false;			
						})	
						
						$(".remove_ad").click(function() {	
							adID = $(this).attr('id');						

							dataString = "adID=" + adID;
							alert(dataString);					
							$.ajax({
								type: "POST",
								url: "update_admin.php?type=remove_ad",
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
			
			case "job_templates":
				$job_template_data = $admin->get_job_template_data();				
				$requirement_data = $admin->get_requirements_template_data();		
				$question_template_data = $admin->get_question_template_data();				
				job_template_html($job_template_data, $question_template_data['questions'], $requirement_data);
			break;
			
			case "edit_template":
				$templateID = $_GET['ID'];
				if ($templateID != "" && is_numeric($templateID)) {
					$job_template_data = $admin->get_job_template_data();				
					$requirement_data = $admin->get_requirements_template_data();		
					$question_template_data = $admin->get_question_template_data();	
					edit_job_template_html($templateID, $job_template_data, $question_template_data['questions'], $requirement_data);				
				}
?>
				<script>	
						$("#save_template").click(function() {
							templateID = <? echo $templateID ?>;	
							title = $("#title").val();						
							sub_skills = $("#sub_skills").val();
							pay = $("#pay").val();
							schedule = $("#schedule").val();
							general_requirements = $("#general_requirements").val();
							front_requirements = $("#front_requirements").val();
							back_requirements = $("#back_requirements").val();
							questions = $("#questions").val();
							pass = $("#pass").val();

							if (title == "" || sub_skills == "") {
								$("#error").show();								
							} else {
								dataString = "templateID=" + templateID + "&title=" + title + "&sub_skills=" + encodeURIComponent(sub_skills) + "&pay=" + pay + "&schedule=" + schedule + "&general_requirements=" + encodeURIComponent(general_requirements) + "&back_requirements=" + encodeURIComponent(back_requirements) + "&front_requirements=" + encodeURIComponent(front_requirements) + "&questions=" + questions + "&pass=" + pass;
								alert(dataString);					
								$.ajax({
									type: "POST",
									url: "update_admin.php?type=edit_job_template",
									data: dataString,
									success: function(data) {
										alert(data);
										window.location = "admin.php";
									}
								});	
							}	
							return false;			
						});
						
						$("#delete_template").click(function() {
							templateID = <? echo $templateID; ?>;	
							pass = $("#pass").val();
								dataString = "templateID=" + templateID + "&pass=" + pass;
								alert(dataString);					
								$.ajax({
									type: "POST",
									url: "update_admin.php?type=delete_template",
									data: dataString,
									success: function(data) {
										alert(data);
										window.location = "admin.php";
									}
								});	
							return false;			
						});									
				</script>
<?php				
			break;
			
			case "new_job_template":
				$requirement_data = $admin->get_requirements_template_data();		
				$question_template_data = $admin->get_question_template_data();	
							
				new_job_template_html($question_template_data['questions'], $requirement_data);	
?>
				<script>	
				
						$("#main_skill").change(function() {
							$(".sub_skills").hide();
							alert("HERE");
							skill = $(this).val();
							$("#"+ skill + "").show();
						});	
									
						$("#save_template").click(function() {	
							title = $("#title").val();						
							main_skill = $("#main_skill").val();
							sub_skills = $("#"+ skill + "").val();
							pay = $("#pay").val();
							schedule = $("#schedule").val();
							general_requirements = $("#general_requirements").val();
							front_requirements = $("#front_requirements").val();
							back_requirements = $("#back_requirements").val();
							questions = $("#questions").val();
							pass = $("#pass").val();

							if (title == "" || sub_skills == "") {
								$("#error").show();								
							} else {
								dataString = "title=" + title + "&main_skill=" + main_skill + "&sub_skills=" + sub_skills + "&pay=" + pay + "&schedule=" + schedule + "&general_requirements=" + general_requirements + "&back_requirements=" + back_requirements + "&front_requirements=" + front_requirements + "&questions=" + questions + "&pass=" + pass;
								alert(dataString);					
								$.ajax({
									type: "POST",
									url: "update_admin.php?type=new_job_template",
									data: dataString,
									success: function(data) {
										alert(data);
										window.location = "admin.php";
									}
								});	
							}	
							return false;			
						})	
				</script>
<?php				
						
			break;
			
			case "view_requirements":
				$requirement_data = $admin->get_requirements_template_data();		
					
				requirements_template_html($requirement_data);				
			break;			
			
			case "edit_requirement":
				$reqID = $_GET['id'];
				if ($reqID != "" && is_numeric($reqID)) {			
					$requirement_data = $admin->get_requirements_template_data();						
					edit_requirement_template_html($reqID, $requirement_data);		
				}						
?>
				<script>	
						$("#save_requirement").click(function() {
							reqID = <? echo $reqID; ?>;	
							requirement = $("#requirement").val();						
							pass = $("#pass").val();

							if (requirement == "") {
								$("#error").show();								
							} else {
								dataString = "reqID=" + reqID + "&requirement=" + requirement + "&pass=" + pass;
								alert(dataString);					
								$.ajax({
									type: "POST",
									url: "update_admin.php?type=edit_requirement",
									data: dataString,
									success: function(data) {
										alert(data);
										window.location = "admin.php";
									}
								});	
							}	
							return false;			
						});
						
						$("#delete_requirement").click(function() {
							reqID = <? echo $reqID; ?>;	
							pass = $("#pass").val();
								dataString = "reqID=" + reqID + "&pass=" + pass;
								//alert(dataString);					
								$.ajax({
									type: "POST",
									url: "update_admin.php?type=delete_requirement",
									data: dataString,
									success: function(data) {
										alert(data);
										window.location = "admin.php";
									}
								});	
							return false;			
						});							
				</script>
<?php								
			break;
			
			case "new_requirement":
				new_requirement_html();				

?>
				<script>	
						$("#save_requirement").click(function() {	
							requirement = $("#requirement").val();
							pass = $("#pass").val();

							if (requirement == "") {
								$("#error").show();								
							} else {
								dataString = "requirement=" + requirement + "&pass=" + pass;
								alert(dataString);					
								$.ajax({
									type: "POST",
									url: "update_admin.php?type=new_requirement",
									data: dataString,
									success: function(data) {
										alert(data);
										window.location = "admin.php";
									}
								});	
							}	
							return false;			
						})	
				</script>
<?php				

			break;
			
			case "view_questions":
				$question_data = $admin->get_question_template_data();		
					
				questions_template_html($question_data);				
			break;			
			
			case "edit_question":
				$questionID = $_GET['id'];
				if ($questionID != "" && is_numeric($questionID)) {			
					$question_data = $admin->get_question_template_data();		
					edit_question_template_html($questionID, $question_data);		
				}
?>
				<script>	
						$("#save_question").click(function() {
							questionID = <? echo $questionID; ?>;	
							question = $("#question").val();	
							type = $("#type").val();	
							answer = new Array();					
							$(".answer").each(function() {
								answer.push($(this).val());
							});						
							pass = $("#pass").val();
							pass = $("#pass").val();

							if (question == "") {
								$("#error").show();								
							} else {
								dataString = "questionID=" + questionID + "&question=" + question + "&answer=" + answer + "&type=" + type + "&pass=" + pass;
								alert(dataString);					
								$.ajax({
									type: "POST",
									url: "update_admin.php?type=edit_question",
									data: dataString,
									success: function(data) {
										alert(data);
										window.location = "admin.php";
									}
								});	
							}	
							return false;			
						});
						
						$("#delete_question").click(function() {
							questionID = <? echo $questionID; ?>;	
							pass = $("#pass").val();
								dataString = "questionID=" + questionID + "&pass=" + pass;
								//alert(dataString);					
								$.ajax({
									type: "POST",
									url: "update_admin.php?type=delete_question",
									data: dataString,
									success: function(data) {
										alert(data);
										window.location = "admin.php";
									}
								});	
							return false;			
						});														
				</script>
<?php														
			break;
			
			case "new_question":
				new_question_html();
?>				
				<script>	
						$("#save_question").click(function() {	
							question = $("#question").val();	
							answer = new Array();					
							type = $("#type").val();	
							$(".answer").each(function() {
								answer.push($(this).val());
							});						
							pass = $("#pass").val();

							if (question == "") {
								$("#error").show();								
							} else {
								dataString = "question=" + question + "&answer=" + answer + "&type=" + type + "&pass=" + pass;
								alert(dataString);					
								$.ajax({
									type: "POST",
									url: "update_admin.php?type=new_question",
									data: dataString,
									success: function(data) {
										alert(data);
										window.location = "admin.php";
									}
								});	
							}	
							return false;			
						})	
				</script>	
<?php							
			break;	
			
			case "employee_job_titles":
				$employee_job_titles = $admin->get_employee_job_titles();				
				$BOH_skills = $admin->get_employee_skills("BOH");		
				$FOH_skills = $admin->get_employee_skills("FOH");		
				$MGMT_skills = $admin->get_employee_skills("Management");		
				$GEN_skills = $admin->get_employee_skills("General");		

				employee_job_titles_html($employee_job_titles, $BOH_skills, $FOH_skills, $MGMT_skills, $GEN_skills);
				
?>				
				<script>	
						$("#save_new_title").click(function() {	
							title = $("#new_title").val();	
							type = $("#type").val();	

							if (title == "") {
								$("#error").show();								
							} else {
								dataString = "title=" + encodeURIComponent(title) + "&type=" + type;
								alert(dataString);					
								$.ajax({
									type: "POST",
									url: "update_admin.php?type=new_job_template_title",
									data: dataString,
									success: function(data) {
										alert(data);
										window.location = "admin.php";
									}
								});	
							}	
							return false;			
						});
						
						
						$("#save_new_skill").click(function() {	
							skill = $("#new_skill").val();	
							skill_type = $("#skill_type").val();	
							rankable = $("#rankable").val();	

							if (skill == "") {
								$("#error").show();								
							} else {
								dataString = "skill=" + encodeURIComponent(skill) + "&skill_type=" + skill_type + "&rankable=" + rankable;
								alert(dataString);					
								$.ajax({
									type: "POST",
									url: "update_admin.php?type=new_skill_template",
									data: dataString,
									success: function(data) {
										alert(data);
										window.location = "admin.php";
									}
								});	
							}	
							return false;			
						});							
				</script>	
<?php				
			break;	
			
			case "edit_employee_job_title":
				$titleID = $_GET['titleID'];
				$job_title_data = $admin->get_employee_job_title_data($titleID);				
				$BOH_skills = $admin->get_employee_skills("BOH");		
				$FOH_skills = $admin->get_employee_skills("FOH");		
				$MGMT_skills = $admin->get_employee_skills("Management");		
				$GEN_skills = $admin->get_employee_skills("General");		
				employee_job_title_edit_html($job_title_data, $BOH_skills, $FOH_skills, $MGMT_skills, $GEN_skills);

?>				
				<script>	
						$("#save_changes").click(function() {	
							title = $("#new_title").val();	
							type = $("#type").val();	
							titleID = $("#titleID").val();					

							var skills = $('#employee_skills').val();
							
							if (title == "" || skills == "null" || titleID == "") {
								$("#error").show();								
							} else {
								dataString = "title=" + encodeURIComponent(title) + "&type=" + type + "&titleID=" + titleID + "&skills=" + skills;
								alert(dataString);					
								$.ajax({
									type: "POST",
									url: "update_admin.php?type=edit_job_title_template",
									data: dataString,
									success: function(data) {
										alert(data);
										window.location = "admin.php";
									}
								});	
							}	
							return false;			
						});						
				</script>	
<?php							
			break;
			
			case "view_employment":
				$employment_array = $admin->get_employment('all');
				view_employment_list($employment_array);
			break;																																																																																			
		}
			
	} else {
		login_warning_html();		
	}
	//display footer
		$admin_content->html_footer();
?>