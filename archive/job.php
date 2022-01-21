<?php
//======================
//
//   Job List Page - Displays a list of employer's jobs
//
//======================

//Required Class files
	require_once('classes/job.class.php');	
	require_once('classes/job_list.class.php');	
	require_once('classes/employer.class.php');	
	require_once('classes/employee.class.php');	
	require_once('classes/member.class.php');	
	require_once('classes/candidate.class.php');	
	require_once('classes/member.class.php');	
	require_once('classes/verification.class.php');	
	require_once('classes/message.class.php');	
	require_once('classes/utilities.class.php');	

//Required HTML files
	require_once('html/job_html.php');		
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
	$js_file = "<script type='text/javascript' src='js/job.js?v=".$version."'></script>";
	if ($_GET['ID'] == "new_job" && $_GET['page'] != "add_photo") {
		$js_file .= "<script type='text/javascript' src='js/employer.js?v=".$version."'></script>";
		$js_file .= "<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyDb95KTBjE8mIPl_bvDMxs1vvLkyLhAiXs&v=3.exp&libraries=places'></script>";	
	    $js_file .= "<script>google.maps.event.addDomListener(window, 'load', initialize);</script>";
		$js_file .= "<script src='https://checkout.stripe.com/checkout.js'></script>";
	} else {
		$js_file .= "<script src='https://checkout.stripe.com/checkout.js'></script>";
	}
		
//define objects
	$general_content = new General_Content;
// display header, with name, type, and required javascript file
	//if user is logged in display, if not, display warning page
	if (isset($_SESSION['userID'])) {
		
		switch($_SESSION['type']) {
			case "employer":
				$general_content->html_top('job', $js_file);
				$jobID = $_GET['ID'];	
				
				$member = new Member($_SESSION['userID']);
				$employer = new Employer($_SESSION['userID']);
				$member_data = $member->get_member_data();				
				$employer_data = $employer->get_employer_data();
				$store_array = $employer_data['stores_jobs']['stores'];
				
				//set variables for JS issue
				$skill_job_list = "NA";
				$overall_list = "NA";
							
				switch($jobID) {
					case "new_job":	
						
						//get page and store
						$page = $_GET['page'];
						$storeID = $_GET['storeID'];
						$job = new Job($jobID);
									
						switch($page) {
							default:
								//page isn't set, send to OOPS page
								job_html_group_warning("error");
							break;
							
							case "location":
								$store_type_array = $utilities->store_types;										
								//select location or create new location
								
								//determine whether user has locations, if so allow them to choose, if not, route to create a new location
									if (count($store_array) > 0) {
										$first_job = 'N';							
									} else {
										$first_job = 'Y';
										//job_html_employer_no_store();
									}	

									job_html_employer_select_location($member_data['firstname'], $store_array, $store_type_array);											
									job_html_loader();
//									store_warning_box();																																																			
?>
<script>
									$(document).ready(function() {
										new_user = '<? echo $first_job; ?>';
										location_selection(new_user) 
									})
</script>
<?php														
							break;
							
							case "add_photo":
								//determine whether this storeID is attached to user, if not send them to error page
								$valid = "N";
								$store_name = $store_zip = "";
								$city_state = array();
		
								if (count($store_array) > 0) {
									foreach($store_array as $row) {
										if ($row['storeID'] == $storeID) {
											$valid = "Y";
											$store_name = $row['name'];
											$store_zip = $row['zip'];
											$image = $row['image'];
										}
									}
								}
								
								$site_type = $utilities->site_type;
								
								if ($site_type == "live") {
									$upload_url = "//servebartendcook.com/upload_pic";
								} elseif ($site_type == "prototype") {
									//$upload_url = "//threewhitebirds.com/SBC/upload_pic";	
									$upload_url = "//threewhitebirds.com/CLEAN/upload_pic";	
								}
								
								
								if ($valid == "Y" && $storeID != 0) {										
									job_html_add_photo($storeID, $image, $upload_url);	
									job_html_loader();
?>	
<script>
									$(document).ready(function(){
										var storeID = '<? echo $storeID ?>';
										store_photo(storeID);
									});
</script>
<?php																						
								} else {
									job_html_group_warning("error");																																	
								}							
							break;
							
							case "selection":
								//determine whether this storeID is attached to user, if not send them to error page
								$valid = "N";
								$store_name = $store_zip = "";
								$city_state = array();
		
								if (count($store_array) > 0) {
									foreach($store_array as $row) {
										if ($row['storeID'] == $storeID) {
											$valid = "Y";
											$store_name = $row['name'];
											$store_zip = $row['zip'];
										}
									}
								}
								
								if ($valid == "Y") {										
										//check region status
										$region_status = $utilities->determine_region_status($store_zip);
										$city_state = $utilities->get_city_state($store_zip);
										
										//determine next estimated CL group post day
										$current_day_of_week = date("N");
										if ($current_day_of_week > 3) {
											//post following tuesday
											$date_interval = 9 - $current_day_of_week;
										} elseif ($current_day_of_week == 1) {
											//post following tuesday
											$date_interval = 1;
										} else {
											//post following thursday
											$date_interval = 4 - $current_day_of_week;
										}
										
										$next_cl_date = date('Y-m-d', strtotime("+".$date_interval." days"));
														
											if (count($store_array) > 0) {	
												job_html_employer_selection($storeID, $store_name, $region_status, $next_cl_date);	
												job_html_loader();
?>	
<script>
												$(document).ready(function(){
													var storeID = '<? echo $storeID ?>';
													job_post_selection(storeID);
												});
</script>
<?php																						
											} else {
												job_html_employer_no_store();
?>
<script>
												$(document).ready(function() {
													add_store('Y');
												})
</script>
<?php										
											}	
									} else {
										job_html_group_warning("error");																																	
									}							
									break;					
							
									case "templates":
										//select a template/add new job to group of posts
										$groupID = $_GET['groupID'];

										$email_verification = $utilities->check_email_verification();	
										
										//get the users email address						
										$member = new Member($_SESSION['userID']);									
										$member_data = $member->get_member_data();					
										$email = $member_data['email'];
										
										//get group details
										$group_details = $job->get_group_details($groupID);

										if ($group_details == "error") {
											//display error page
											job_html_group_warning("error");																							
										} else {										
											switch($group_details['type']) {
												case "single":
													$cost = 19;
												break;
												case "BOH":
													$cost = 35;
												break; 
												case "FOH":
													$cost = 35;
												break; 
												case "all":
													$cost = 40;
												break; 
											}
											
											//get job posts associated with this group
											$job_list = new JobList($_SESSION['userID']);
											$group_job_list = $job_list->get_group_jobs($groupID);
	
											$store_name = "";
											if (count($store_array) > 0) {
												foreach($store_array as $row) {
													if ($row['storeID'] == $group_details['storeID']) {								
														$store_name = $row['name'];
														$store_zip = $row['zip'];
													}
												}
											}
											
											$region_status = $utilities->determine_region_status($store_zip);
											
											if ($group_details == "error") {
												//error page
												job_html_group_warning("error");																							
											} else {
												
												//if this group has already been posted, send to default page, if not, continue with options
///												if ($group_details['post_status'] == "posted") {
												if ($group_details['post_status'] == "placeholder") {

													//DEFAULT PAGE
													job_html_group_warning("posted");																							
												} else {											
													//page with job post options
													$job_template_array = $job->get_job_template_data("all");			
													$raw_former_jobs = $job->get_former_jobs(); 	

													//modify former jobs array based on storeID and job type
													$former_jobs = array();
													//echo var_dump($raw_former_jobs);
													if( count($raw_former_jobs) > 0) {
														foreach($raw_former_jobs as $row) {
															switch($row['specialty']) {
																case "Server":
																	if ($group_details['type'] == "single" || $group_details['type'] == "all" || $group_details['type'] == "FOH") {
																		$former_jobs[] = $row;																	
																	}
																break;
																
																case "Bartender":
																	if ($group_details['type'] == "single" || $group_details['type'] == "all" || $group_details['type'] == "FOH") {
																		$former_jobs[] = $row;																	
																	}
																break;
	
																case "Host":
																	if ($group_details['type'] == "single" || $group_details['type'] == "all" || $group_details['type'] == "FOH") {
																		$former_jobs[] = $row;																	
																	}
																break;
	
																case "Management":
																	if ($group_details['type'] == "single" || $group_details['type'] == "all" || $group_details['type'] == "FOH" ||  $group_details['type'] == "BOH") {
																		$former_jobs[] = $row;																	
																	}
																break;
	
																case "Kitchen":
																	if ($group_details['type'] == "single" || $group_details['type'] == "all" || $group_details['type'] == "BOH") {
																		$former_jobs[] = $row;																	
																	}
																break;
	
																case "Bus":
																	if ($group_details['type'] == "single" || $group_details['type'] == "all" || $group_details['type'] == "BOH") {
																		$former_jobs[] = $row;																	
																	}
																break;															
															}
														}
													}											

													if( count($former_jobs) > 0) {
														foreach($former_jobs as $key=>$row) {
															if ($row['storeID'] != $group_details['storeID']) {
																unset($former_jobs[$key]);
															}
														}
													}

													if ($group_details['post_status'] == "posted" && $region_status != "free") {
														$receiptID_array = $job->get_receiptID($groupID);
														$receiptID = $receiptID_array['paymentID'];
													} else {
														$receiptID = "NA";
													}
													
													$checkout_cost = $cost *100;
													job_html_employer_templates($group_details, $group_job_list, $job_template_array, $storeID, $store_name, $former_jobs, $email_verification, $email, $region_status, $receiptID);											
													job_html_loader();
?>	
<script>
													$(document).ready(function(){
														var groupID = '<? echo $groupID ?>';
														var storeID = '<? echo $group_details['storeID'] ?>';
														var checkout_cost = '<? echo $checkout_cost ?>';
														var email_verification = '<? echo $email_verification ?>';
		
														job_templates = <? echo json_encode($job_template_array) ?>;
														//alert(storeID);
														new_job(job_templates, groupID, storeID);
														new_checkout(groupID, checkout_cost, email_verification);
														free_post(groupID, email_verification);
														update_post(groupID, email_verification);
													});
</script>
<?php			
												}									
											}
										} 
									break;
																						
									case "group_receipt":
										if (isset($_GET['receiptID'])) {
											//receipt page			
											$receiptID = $_GET['receiptID'];
											$groupID = $_GET['groupID'];
											
											$job_list = new JobList($_SESSION['userID']);
											$group_job_list = $job_list->get_group_jobs($groupID);
											$group_details = $job->get_group_details($groupID);

											$store_name = "";
											if (count($store_array) > 0) {
												foreach($store_array as $row) {
													if ($row['storeID'] == $group_details['storeID']) {								
														$store_name = $row['name'];
														$store_zip = $row['zip'];
													}
												}
											}
											
											$region_status = $utilities->determine_region_status($store_zip);
											
											if ($region_status == "free") {
												$receipt_data = "free";														
											} else {
												//get receipt details
												$receipt_data = $job->get_group_receipt($receiptID);														
											}
											
											if ($receipt_data == "error") {
												$general_content->illegal_view();								
											} else {
												job_html_group_receipt($groupID, $group_job_list, $store_name, $receipt_data);
											}																								
										} else {
											job_html_group_warning("error");											
										}											
									break;
								}
							break;
					break;
				
					default:
						$job = new Job($jobID);

						//This job exists, get the page the user has selected
						//Or default to the main job page at whatever level of completion the job post is currently at

						if (isset($_GET['page'])) {
							$job_data = $job->get_job_data(array('general', 'store', 'employer', 'requirements', 'skills', 'question_list'));
							//Change display page based on the URL
							switch($_GET['page']) {
								case "edit":
									$page = "template_edit";
								break;
								
								case "get_link":
									$page = "get_link";									
								break;
								
								case "sent":
									$page = "sent";								
								break;
																
								case "checkout":
									$page = "checkout";								
								break;	
								
							}
						} else {	
							//No specific page selected, so go to the job page itself
							$job_data = $job->get_job_data(array('general'));

							//This determines if the job is Open or Filled or in the middle of being created
							$page = $job_data['general']['job_status'];			
						}
												
						//check expiration, and the time from expiration
						//Window of time at Y means user can still view candidates, but not anything else
						$expired = "N";	
						$window = "N";

						if ($job->job_expiration_check() == "expired" && !(is_numeric($job_status))) {
								$expired = "Y";
							
								//check to see if date is still valid to view candidates
								//All Jobs = 3 days after expiration
								//legacy bounty 14 days
								$expiration_date = strtotime($job_data['general']['expiration_date']);
								date_default_timezone_set('America/Los_Angeles');	
								$today = date('Y-m-d');

								if ($job_data['general']['post_type'] == "bounty") {
									$window_date = date('Y-m-d', strtotime("+14 days", $expiration_date));	
									if ($today < $window_date) {
										$window = "Y";
									}
								} else {
									$window_date = date('Y-m-d', strtotime("+4 days", $expiration_date));	
									if ($today <= $window_date) {
										$window = "Y";
									}								
								}
						}
						
						//check to see if job has been removed
						if ($job_data['general']['job_status'] == "Removed") {
							$page = "Removed";
						}

						//Verify that the user is the owner of the job based on the jobID					
						if ($job_data['general']['userID'] != $_SESSION['userID']) {
							$page = "invalid";
						}													

							switch($page) {
								case "template_edit":
								case "custom_edit":
									$job_data = $job->get_job_data(array('general', 'store', 'employer', 'requirements', 'skills', 'question_list'));

									if ($job_data['general']['job_status'] != "Expired" || $expired != "Y") {
										$template_requirements_array = $job->get_job_template_requirements();
										$template_questions_array = $job->get_job_template_questions();
										$FOH_skills = $job->get_job_template_skills('FOH');
										$BOH_skills = $job->get_job_template_skills('BOH');
										$management_skills = $job->get_job_template_skills('Management');

										$utilities = new Utilities;
										switch($job_data['skills']['main_skill']['specialty']) {
											case "Manager":
												$sub_specialty_array = $management_skills;
											break;
										
											case "Bartender":
												$sub_specialty_array = $FOH_skills;
											break;
											
											case "Kitchen":
												$sub_specialty_array = $BOH_skills;
											break;
											
											case "Server":
												$sub_specialty_array = $FOH_skills;
											break;	
											
											case "Bus":
												$sub_specialty_array = $BOH_skills;
											break;				
											
											case "Host":
												$sub_specialty_array = $FOH_skills;
											break;																																												
										}
											job_html_employer_template_edit($page, $job_data, $store_array, $sub_specialty_array, $template_requirements_array, $template_questions_array);
											job_html_loader();
									} else {
											job_html_employer_no_edit();
									}
								break;	
																																
								case "free_final":	
									//Determine whether email address has been verified
									$email_verification = $utilities->check_email_verification();							
									
									$member = new Member($_SESSION['userID']);									
									$member_data = $member->get_member_data();					
									$job_data = $job->get_job_data(array('general'));
									
										if ($email_verification == "N") {
											//resend verification email
											$verification = new Verification;
											
											$user_array = $verification->test_email_address($member_data['email']);
											if (isset($user_array['userID']) && $user_array['userID'] > 0) {
												if ($user_array['valid'] == "Y") {
													$message = new Message;
													$message->send_verification_notification($user_array['valid_hash'], $user_array['userID']);
													$valid = "Y";
												} else {
													$valid = "N";									
												}
											} else {
												$valid = "N";
											}	

											job_html_email_warning($member_data['email'], $valid);											
										} else {																													
											job_html_employer_final_step($jobID, $job_data['general']['title']);
											job_match_warning();
										}		
								break;
																	
								case "Filled":  //fall-through - changed the views for filled jobs								
								case "Open":
									//$job_data = $job->get_job_data(array('general', 'store', 'employer', 'requirements', 'skills', 'candidate_count', 'positive_list'));
									$job_data = $job->get_job_data(array('general', 'store', 'skills', 'positive_list'));
								
									//check to see if job was 'sent'
									$status = $_GET['status'];
									if ($status == "sent") {
										//get last login to see what respones are new
										$member = new Member($_SESSION['userID']);
										$member_data = $member->get_member_data();
										$last_login = $member_data['last_login'];
										
										job_html_employer_sent($job_data, $last_login, $sub_specialty_array, $candidate_array);						
									} else {

										//make sure the job is still within the open window
										if ($expired == "N" || $window == "Y") {											
										
											//get last login to see what respones are new
											$member = new Member($_SESSION['userID']);
											$member_data = $member->get_member_data();
											$last_login = $member_data['last_login'];
											
											$trait_array = $utilities->traits;
	
											//get data about each person that responded
											$candidate_array = array();
											$highlight_array = array();
											
											if (count($job_data['positive_list']) > 0) {
												//this is the list of people who have responded to the job
												//first thing to do is separate out the highlighted ones from non-highlight, then re-order so they highlited ones go first
																								
												foreach($job_data['positive_list'] as $row) {
													$candidate = new Candidate($row['matchID']);
													//$candidate_data = $candidate->get_candidate();
													//make this more efficient, only query the info needed
													
													$employee = new Employee($row['userID']);
//													$skills = $employee->get_specific_employee_data('skills');
													//$sub_skills = $employee->get_specific_employee_data('sub_skills');
													$experience_overwrite = $employee->get_specific_employee_data('experience_overwrite');

													if ($experience_overwrite == "NA") {
														$past_employment = $employee->get_specific_employee_data('employment');
													} else {
														$past_employment = array();
													}
													$past_replies = $candidate->get_past_reply($row['userID']); 
													
/*

													$skill_array = $skills['skills'];
													$sub_skill = $skills['sub_skills']; 
*/
																									
																									
													$experience = 0;
													$skillID = "NA";
													$sub_skill_text = "";											
													$photo_class = "";	
													$message_class = "";																										
													$candidate_features = "";													
													$sub_skill_text = "";	
	
													$total_experience = array();
													$hospitality_holder = array();
													$other_holder = array();	
													$unknown_holder = array();	
	
													foreach($past_employment as $employment) {
														if ($row['category'] == "other") {
															$other_holder[] = $employment;
														} elseif ($row['category'] == "") {						
															$unknown_holder[] = $employment;	
														} else {
															$hospitality_holder[] = $employment;							
														}
													}

													if ($experience_overwrite == "NA") {
														$hospitality_experience = $utilities->determine_years_of_experience($hospitality_holder);
														$other_experience = $utilities->determine_years_of_experience($other_holder);
														$unknown_experience = $utilities->determine_years_of_experience($unknown_holder);
														$experience = $hospitality_experience + $other_experience + $unknown_experience;
													} else {
														$experience = $experience_overwrite['hospitality'];
													}
														
/*
													if (count($sub_skills) > 0) {
														foreach($sub_skills as $data) {
															$sub_skill_text .= $data['sub_skill'].", ";
														}
													}
*/
/*
													foreach($skill_array as $skill) {
														if ($skill['skill'] == $job_data['skills']['main_skill']['specialty']) {
															$skillID = $skill['skillID'];
														}
													}
	
													if ($skillID != "NA") {
														$sub_skill_data = $sub_skill[$skillID];
														foreach($sub_skill_data as $data) {
															$sub_skill_text .= $data['sub_skill'].", ";
														}
													}
*/
													
													
																	
												$candidate_class = $photo_class." ".$message_class;		
													
												if (count($past_replies) > 0) {
													$past_reply_note = "<br /><font size='0.8em' ><i>&nbsp; *Applied at this location before</i></font>";
												} else {
													$past_reply_note = "";
												}	

												$new = "";						
												if ($row['date_responded'] > $last_login) {
													$new = "<font color='red'><b><i>NEW</i></b></font>";
												}	
												
												//$recommendation_employer = "NA";												
												
												if ($row['highlight'] == 'Y') {	
	
													$highlight_array[] = array("userID" => $row['userID'],
																					"candidate_class" => $candidate_class,
																					"photo" => $row['profile_pic'],
																					"matchID" => $row['matchID'],
																					"highlight" => "<font color='#DAA520' size='4px'><b>&#9733; </b></font>",
																					"highlight_style" => "background-color:#e9e6de;",
																					"highlight_test" => $row['highlight'],	
																					"date_responded" => $row['date_responded'],
																					"firstname" => $row['firstname'],
																					"lastname" => $row['lastname'],
																					"quote" => $row['quote'],
																					"experience" => $experience,
																					"sub_skill_text" => $sub_skill_text,
																					"past_reply_note" => $past_reply_note,
																					"new" => $new,
																					"temp" => $row['temp']);
													
												} else {
													$candidate_array[] = array("userID" => $row['userID'],
																					"candidate_class" => $candidate_class,
																					"photo" => $row['profile_pic'],																				
																					"matchID" => $row['matchID'],
																					"highlight" => "<font size='4px'><b>&#9733; </b></font>",
																					"highlight_style" => "",
																					"highlight_test" => $row['highlight'],																		
																					"date_responded" => $row['date_responded'],
																					"firstname" => $row['firstname'],
																					"lastname" => $row['lastname'],
																					"quote" => $row['quote'],
																					"experience" => $experience,
																					"sub_skill_text" => $sub_skill_text,
																					"past_reply_note" => $past_reply_note,
																					"new" => $new,
																					"temp" => $row['temp']);
												}
											}
										}
	
											$FOH_skills = $job->get_job_template_skills('FOH');
											$BOH_skills = $job->get_job_template_skills('BOH');
											$management_skills = $job->get_job_template_skills('Management');
	
											switch($job_data['skills']['main_skill']['specialty']) {
												case "Manager":
													$sub_specialty_array = $management_skills;
												break;
											
												case "Bartender":
													$sub_specialty_array = $FOH_skills;
												break;
												
												case "Kitchen":
													$sub_specialty_array = $BOH_skills;
												break;
												
												case "Server":
													$sub_specialty_array = $FOH_skills;
												break;	
												
												case "Bus":
													$sub_specialty_array = $BOH_skills;
												break;				
												
												case "Host":
													$sub_specialty_array = $FOH_skills;
												break;																																												
											}
										} else {
											$sub_specialty_array = $candidate_array = $highlight_array = $trait_array = "Expired";
										}
	
										job_html_employer_open($job_data, $last_login, $sub_specialty_array, $candidate_array, $highlight_array);						
									}							
								break;
								
								case "Expired":
									$job_data = $job->get_job_data(array('general', 'store', 'employer', 'requirements', 'skills', 'question_list', 'candidate_videos', 'candidate_count', 'view_count', 'new_view_count', 'negative_count', 'positive_list'));

									$template_requirements_array = $job->get_job_template_requirements();
									$template_questions_array = $job->get_job_template_questions();
									$utilities = new Utilities;
									$FOH_skills = $job->get_job_template_skills('FOH');
									$BOH_skills = $job->get_job_template_skills('BOH');
									$management_skills = $job->get_job_template_skills('Management');
									
									switch($job_data['skills']['main_skill']['specialty']) {
										case "Manager":
											$sub_specialty_array = $management_skills;
										break;
									
										case "Bartender":
											$sub_specialty_array = $FOH_skills;
										break;
										
										case "Kitchen":
											$sub_specialty_array = $BOH_skills;
										break;
										
										case "Server":
											$sub_specialty_array = $FOH_skills;
										break;	
										
										case "Bus":
											$sub_specialty_array = $BOH_skills;
										break;				
										
										case "Host":
											$sub_specialty_array = $FOH_skills;
										break;																																												
									}
									
										job_html_employer_template_edit($page, $job_data, $store_array, $sub_specialty_array, $template_requirements_array, $template_questions_array);
								break;
																
								case "Removed":
										job_html_removed();
								break;	
								
								case "get_link":
									$job_data = $job->get_job_data(array('general', 'store', 'employer', 'requirements', 'skills', 'question_list', 'candidate_videos', 'candidate_count', 'view_count', 'new_view_count', 'negative_count', 'positive_list'));

									job_html_employer_link($job_data, $expired);
								break;	
																
								case "sent":
									$job_data = $job->get_job_data(array('general', 'store', 'employer', 'requirements', 'skills', 'question_list'));

									job_html_employer_sent($job_data, $expired);
								break;
																								
								case "invalid":
									//$general_content->illegal_view();
									$general_content->no_exist();														
								break;							
							}

?>
<script>
							$(document).ready(function(){
									var jobID = "<? echo $jobID ?>";
									var main_skill = "<? echo $job_data['skills']['main_skill']['specialty'] ?>";
									var job_status = "<? echo $job_data['general']['job_status'] ?>";
									var comp_type = "<? echo $job_data['general']['comp_type'] ?>";
									var comp_value = "<? echo $job_data['general']['comp_value'] ?>";
									var groupID = "<? echo $job_data['general']['groupID'] ?>";
									page = "<? echo $page ?>";
									
									if (page != "bounty_final") {
										var overall_list = "NA";
										var skill_job_list = "NA";
									} else {
										var overall_list = <? echo $overall_list ?>;
										var skill_job_list = <? echo $skill_job_list ?>;
									}
									
									remove_job(jobID);	
									switch(page) {	
										default:
											job_employer(jobID);
											reverse_candidate_order();
										break;
																			
										case "template_edit":
											if (comp_value == "") {
												comp_value = 0;
											}
											job_employer(jobID);
											template_edit(jobID, comp_type, comp_value, groupID);
										break;
										
										case "custom_edit":
//											custom_edit(jobID, main_skill, groupID);
											if (comp_value == "") {
												comp_value = 0;
											}
											job_employer(jobID);
											template_edit(jobID, comp_type, comp_value, groupID);
										break;
										
										case "checkout":
											<?php if($_SESSION['boost'][$jobID]['final_cost'] != "") { ?>
												var checkout_amount = <? echo $_SESSION['boost'][$jobID]['final_cost'] * 100; ?>;
												var cl_group = "<? echo $_SESSION['boost'][$jobID]['cl_group']?>";
												var social = "<? echo $_SESSION['boost'][$jobID]['social']?>";
												var email = "<? echo $_SESSION['boost'][$jobID]['email']?>";
												
												checkout(jobID, checkout_amount, cl_group, social, email);
											<?php } ?>
										break;																																																																		
										
										case "free_final":
											final_step(jobID);
										break;
										
										case "get_link":
											copy_clip();
										break;										
									}
							});
</script>
<?php
				}
			break;
			
			case "employee":
				$general_content->html_top('illegal', $js_file);
				$general_content->illegal_view();								
			break;
		}
		
	} else {
		$general_content->login_warning_page();	
	}	
	
$general_content->html_footer();
?>