<?php
//======================
//
//   Employee Page - An employee viewing their own profile
//
//======================

//Required Class files
	require_once('classes/employee.class.php');	
	require_once('classes/utilities.class.php');	
	require_once('classes/opportunity.class.php');	

//Required HTML files
	require_once('html/employee_html.php');	
	require_once('html/general_content_html.php');
	
//start session

session_start();
//Forces page to refresh, this is needed, or else people adding new info to profile and clicking "back" will see old info
header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
header('Pragma: no-cache'); // HTTP 1.0.
header('Expires: 0'); // Proxies. 

	$utilities = new Utilities;
	$version = $utilities->version;	
		
//name of javascript file
	$js_file = "<script type='text/javascript' src='js/employee.js?v=".$version."'></script>";

//SET COOKIE FOR LOGINS
	$member = new Member($_SESSION['userID']);
	$member_data = $member->get_member_data();
	setcookie('hash', $member_data['valid_hash'], time() + (86400 * 90));
	
	$general_content = new General_Content;
	
	if (isset($_SESSION['userID'])) {		
		$general_content->html_top("profile", $js_file);
		
		if ($_SESSION['type'] == "employee") {					
				//Determine whether email address has been verified
				$email_verification = $utilities->check_email_verification();

				$employee = new Employee($_SESSION['userID']);

				$member_data = $member->get_member_data();
				$employee_data = $employee->get_employee_data();
				$profile_status = $employee_data['general']['profile_status'];
				
					//Change display page based on the URL
					$page = $_GET['page'];

					//if splash page, check to see if this user has entered anything on his profile, if 	so, just move them to the main profile page				
					if ($page == "new_splash") {
						if (count($employee_data['skills']['skills']) > 0) {
							$page = "profile_menu";
						}
					}

					switch($page) {
						default:
							$utilities = new Utilities;
							
							//determine if user has a ref job in DB (directly clicked apply from public link)
							//if so, determine if that job is valid to add a "Finish and Apply" button to profile
							$ref_jobID = $employee_data['general']['ref_jobID'];
							if ($ref_jobID != "" && $ref_jobID > 0) {
								// check expiration
								$opportunity_class = new Opportunity($ref_jobID);
								$opportunity_data = $opportunity_class->get_opportunity_data();
								$job_status = $opportunity_data['job_status'];
								if ($job_status != "expired" && $job_status != "expired_responded" && $job_status != "removed") {
									$ref_job_store = array("store" => $opportunity['job_data']['store']['name'], "ref_jobID" => $ref_jobID);
								}
							} else {
								$ref_job_store = "NA";
							}
							
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

							if ($employee_data['experience_overwrite'] != "NA") {
								$total_experience['total'] = $employee_data['experience_overwrite']['total'];
								$total_experience['hospitality'] = $employee_data['experience_overwrite']['hospitality'];
							}
							
							
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
							
							profile_html_employee($employee_data, $total_experience, $employee_store_type, $employee_position_experience, $employee_skills_experience, $old_employee_skills, $ref_job_store);									
							profile_html_loader();
?>
<script>
							$(document).ready(function() {
								employee_main();											
							});
</script>
<?php																										
						break;
	
						case "new_splash":

							if ($member_data['ref_jobID'] != "NA" && $member_data['ref_jobID'] != "" && $member_data['ref_jobID'] > 0) {
								$opportunity = new Opportunity($member_data['ref_jobID']);
								$opportunity_data = $opportunity->get_opportunity_data();
							} else {
								$opportunity_data = "NA";
							}

							profile_html_employee_splash($member_data, $email_verification, $opportunity_data);
?>
<script>
							$(document).ready(function() {
								new_splash();											
							});
</script>
<?php																																	
						break;
																
						case "work_skills_menu":
							//determine if past work experience is out of date (hasn't been update to new style)
							//if so, require update
							//NO LONGER RELEVANT
							//$employment_version = $employee_data['employment_version'];
							$experience_overwrite = $employee_data['experience_overwrite'];
							$past_employment_array = $employee_data['employment'];
							$employment_skills = $employee_data['skills']['employment_skills'];
							$profile_status = $employee_data['general']['profile_status'];
							foreach ($past_employment_array as $key=>$row) {								
								$skill_count = 0;
								if (count($employment_skills) > 0) {
									foreach($employment_skills as $skill) {
										if ($skill['employmentID'] == $row['ID']) {
											$skill_count++;
										}
									}
								}
								$past_employment_array[$key]['skill_count'] = $skill_count;
							}
							
							$titles = $employee->get_employment_titles();
							//seprate employment titles into types
							$FOH = $BOH = $Management = array();
							foreach($titles as $title) {
								//seperate arrays
//								array_push($$title['type'], $title); //this caused an error when updating to PHP 7.X
								array_push(${$title['type']}, $title);
							}
							
							$template_skills = $employee->get_employment_skills();

							//get total hospitality experience & other experience
							$past_employment = $employee_data['employment'];
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
							
							$total_experience['total'] = $total_experience['hospitality'] + $total_experience['other'];
							
							profile_html_work_skills_menu($past_employment_array, $FOH, $BOH, $Management, $employment_skills, $template_skills, $total_experience, $experience_overwrite, $profile_status);										
							profile_html_loader();
?>
<script>
								$(document).ready(function() {
									employee_work_skills_menu();
								})
</script>
<?php									
						break;	
																								
						case "edit_education":
							$template_certifications = $utilities->certifications;
							$template_awards = $utilities->awards;
							
							$employee_data = $employee->get_employee_data();
							$employee_education = $employee_data['education'];
							$employee_certifications = $employee_data['certifications'];
							$employee_awards = $employee_data['awards'];						

							profile_html_edit_education($employee_education);
							profile_html_loader();
?>
<script>
							$(document).ready(function() {
								//var education_count = <?php echo count($employee_education) ?>;
								employee_edit_education();
							})
</script>
<?php	
						break;

						case "edit_certification":
							$template_certifications = $utilities->certifications;
							$template_awards = $utilities->awards;
							
							$employee_data = $employee->get_employee_data();
							$employee_certifications = $employee_data['certifications'];
							$employee_awards = $employee_data['awards'];						

							profile_html_edit_certification($template_certifications, $employee_certifications, $employee_awards);
							profile_html_loader();
?>
<script>
							$(document).ready(function() {
								employee_edit_certification();
							})
</script>
<?php									
						break;
						
						case "edit_personal_info":
							//get relevant info from array
							$quote = $member_data['quote'];
							$long_description = $member_data['description'];
							
							//long description was originally divided among broad skill, if the long description is empty, search skills for desciptions and create a string
							if ($long_description == "") {
								$skill_array = $employee_data['skills']['skills'];
								foreach($skill_array as $row) {
									if($row['description'] != "") {
										$long_description .= "".$row['skill']."\r\n".$row['description']."\r\n\r\n";
									}
								}
							}

							profile_html_personal_info($quote, $long_description);
							profile_html_loader();
?>
<script>
							$(document).ready(function() {
								employee_personal_info();
							})
</script>
<?php
						break;
						
						case "general_info":
							$first_name = $member_data['firstname'];
							$last_name = $member_data['lastname'];
							$zip = $member_data['zip'];
							$phone = $employee_data['general']['contact_phone'];
							$email = $member_data['email'];

							$traits = $utilities->traits;
							$languages = $utilities->languages;
							
							$employee_traits = $employee_data['traits'];
							$employee_languages = $employee_data['languages'];
							
							$employee_seeking = $employee_data['skills']['skills'];

							profile_html_general_info($first_name, $last_name, $email, $zip, $phone, $traits, $languages, $employee_traits, $employee_languages, $employee_seeking);
							profile_html_loader();
?>
<script>
							$(document).ready(function() {
								employee_general_info();
							})
</script>
<?php																																															
						break;

						case "edit_photos":
							$utilities = new Utilities;
							$site_type = $utilities->site_type;
							
							if ($site_type == "live") {
								$upload_url = "//servebartendcook.com/upload_pic";
							} elseif ($site_type == "prototype") {
								//$upload_url = "//threewhitebirds.com/SBC/upload_pic";	
								$upload_url = "//threewhitebirds.com/CLEAN/upload_pic";	
							}

							//get relevant info from array
							$kitchen_photos = $employee_data['kitchen_photos'];
							$bar_photos = $employee_data['bar_photos'];

							if ($employee_data['general']['profile_pic'] != "") {
								$photo = "<img src='images/profile_pics/".$employee_data['general']['profile_pic']."?".time()."' height='150' width='150'>";																										
								$raw_photo = $employee_data['general']['profile_pic'];
							} else {
								$photo = "<b>NO PHOTO</b>";
								$raw_photo = "NA";
							}
							

							$skill_array = $employee_data['skills']['skills'];
							
							$bartender = false;
							$kitchen = false;
							
							foreach($skill_array as $row) {
								//echo $row['skill']."<br />";
								
								if ($row['skill'] == "Bartender") {
									$bartender = true;
								}
								
								if ($row['skill'] == "Kitchen") {
									$kitchen = true;
								}		
							}
							
							profile_html_edit_photos($upload_url, $photo, $raw_photo, $kitchen, $bartender, $kitchen_photos, $bar_photos, $profile_status);
							profile_html_loader();
?>
<script>
							$(document).ready(function() {
								employee_edit_photos();
							})
</script>
<?php						
						break;
						
						case "settings":
							$email_setting = $employee_data['general']['email_setting'];
							$option = $employee->get_email_reminder_setting();
							
							//if user is employer check for open jobs
							if ($_SESSION['type'] == "employer") {
								$joblist = new JobList($_SESSION['userID']);
								$jobs = $joblist->get_job_list_by_group();
								$open_job_count = $jobs['current_count'];
								$share_status = "NA";
							} else {
								$open_job_count = 0;
								$public_setting = $employee_data['general']['public'];
								if ($public_setting == "Y") {
									$share_status = "Sharable";
								} else {
									$share_status = "No";
								}								
							}

							profile_html_employee_settings($email_setting, $option, $member_data['email'], $open_job_count, $share_status);
							profile_html_loader();
?>
<script>							
								$(document).ready(function() {
									var status = "<? echo $member_data['profile_status'] ?>";											
									var old_zip = "<? echo $member_data['zip'] ?>";											
									employee_edit_settings("full", status, old_zip);
								})
</script>
<?php						
						break;
						
						case "edit_resume":
							$resume = $employee->get_resume();
							profile_html_upload_resume($resume['resume']);
?>
<script>							
							$(document).ready(function() {
								employee_edit_resume("<? echo $resume['resume'] ?>")
							})
</script>
<?php						
						break;						
						
						
					}																			
		} else {
			$general_content->illegal_view();					
		}			
		
	} else {
		$general_content->login_warning_page();	
	}	

	$general_content->html_footer();
?>