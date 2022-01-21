<?php
//==================================
//!   Handler for ajax calls to Employee functions 
//==================================

//CHANGE FOR LIVE SITE
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/member.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/employee.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/utilities.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/verification.class.php');		
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/candidate.class.php');		

	$utilities = new Utilities;
	$site_type	 = $utilities->site_type;
	
	session_start();
	
	if ($site_type == "prototype") {
		ini_set('display_errors',1);
		error_reporting(E_ALL|E_STRICT); 
	} 
	
	$type = $_GET['type'];
	
	$member = new Member($_SESSION['userID']);
	$employee = new Employee($_SESSION['userID']);
	
	switch($_GET['type']) {	
	
		case "employee_details":
			$firstname = trim($_POST['first_name']);
			$lastname = trim($_POST['last_name']);
			$zip = trim($_POST['zip']);					
			$phone = trim($_POST['phone']);
//			$languages = trim($_POST['languages']);	
			$profile_status = trim($_POST['profile_status']);	
			$setting = $_POST['email_setting'];	
			
			if ($utilities->zip_validate($zip) == "invalid") {
				echo "zip";
			} else {	
				$member_update_array = array("firstname" => $firstname, "lastname" =>$lastname, "zip" => $zip, "contact_phone" => $phone);
				$member->update_member_data("general", $member_update_array);										

/*
				if ($languages != "") {
					$language_array = explode(",", $languages);				
					$employee->add_employee_list_record('language', $language_array, "");														
				}	
*/
				echo "true";
			}
			
			$email_update = array("setting" => $setting);
			$employee->update_employee_record("email_setting", $email_update, $_SESSION['userID']);			

			
			if ($profile_status == "complete") {
				$employee->log_update("update_general");		
				
				$employee->profile_complete_check();	
			}		
		break;
		
		case "email_setting":
			$email_update = $_POST['email_setting'];
			$employee->update_employee_record("email_setting", $email_update, $_SESSION['userID']);			
		break;
		
		case "employee_name":
			$firstname = trim($_POST['first_name']);
			$lastname = trim($_POST['last_name']);

			$member_update_array = array("firstname" => $firstname, "lastname" =>$lastname);
			$member->update_member_data("name", $member_update_array);												
		break;
		
		case "employee_zip":
			$zip = trim($_POST['zip']);

			if ($utilities->zip_validate($zip) == "invalid") {
				echo "zip";
			} else {	
				$member_update_array = array("zip" => $zip);
				$member->update_member_data("zip", $member_update_array);
			}												
		break;
		
		case "employee_phone":
			$phone = trim($_POST['phone']);

			$member_update_array = array("phone" => $phone);
			$member->update_member_data("phone", $member_update_array);												
		break;				
		
		case "employee_languages":
			$languages = trim($_POST['languages']);	
			if ($languages != "") {
				$language_array = explode(",", $languages);				
				$employee->add_employee_list_record('language', $language_array, "");														
			} else {
				$employee->remove_employee_record('language_list', "");
			}			
		break;
						
		case "add_skill":
			$sub_skills = $_POST['sub'];	
						
			$sub_array_test = explode(",", $sub_skills);
			//test sub-skill for errors
			$sub_array_final = array();
			foreach($sub_array_test as $row) {
			$test = $utilities->sub_skill_validation($row, $_POST['specialty']);
				if ($test == "valid") {
					$sub_array_final[] = $row;
				}
			}
			
			$skill_data_array = array("specialty" => $_POST['specialty'], "description" => trim($_POST['description']), "experience" => trim($_POST['experience']), "seeking" => $_POST['seeking']); 
			$main_skill_array = $utilities->main_skills;
			$status = $_POST['status'];
			
			//RUN THIS TEST AS A PRECAUTION
			if (in_array($_POST['specialty'], $main_skill_array)) {	
				$skillID = $employee->add_employee_record('skill', $skill_data_array);
				$employee = new Employee($_SESSION['userID']);		
				$employee->add_employee_list_record("sub_skills", $sub_array_final, $skillID);
				if ($status == "complete") {
					$complete_check = $employee->profile_complete_check();	 
					echo $complete_check;
				}	
			} else {
				echo "blank";
			}
		break;
		
		case "update_ref_job":
			$employee->update_employee_record("ref_jobID", "NA", "");
		break;		
		
		case "update_seeking":
			$skillID = $_POST['skillID'];	
			$seeking = $_POST['seeking'];	
			$profile_status = $_POST['profile_status'];	
		
			$employee->update_employee_record("seeking", $seeking, $skillID);
			
			if ($profile_status == "complete") {
				$complete_check = $employee->profile_complete_check();	 
			}	
		break;
		
		case "update_seeking_group":
			//put in entire array of seeking/not seeking
			$utilities = new Utilities;
			$broad_skills = $utilities->main_skills;
			
			$seeking_group = $_POST['seeking'];	

			if ($seeking_group != "") {
				$seeking_group = explode(",", $seeking_group);				
			} else {
				$seeking_group = array();
			}			

			$not_seeking_group = array_diff($broad_skills, $seeking_group);
			
			$employee->update_seeking_group($seeking_group, $not_seeking_group);														
		break;		
					
		case "remove_skill":
			$skillID = $_POST['skillID'];		
			$employee->remove_employee_record('skill', $skillID) ;	
		break;
		
		case "add_initial_employment":
			$employment_positions = trim($_POST['employment_array']);	
				if ($employment_positions != "") {
					$employment_array = explode(",", $employment_positions);				
					$result = $employee->add_employee_list_record('initial_employment', $employment_array, "");	
					echo 	$result;												
				} else {
					echo "NA";
				}						
				
		break;
		
		case "add_work":
			$company = trim($_POST['company']);
			$position = trim($_POST['position']);
			$business_type = trim($_POST['business_type']);
			$start_month = trim($_POST['start_month']);
			$start_year = trim($_POST['start_year']);
			$end_month = trim($_POST['end_month']);
			$end_year = trim($_POST['end_year']);
			$current = trim($_POST['current']);
			$titleID = $_POST['titleID'];
			$broad_category = $_POST['broad_category'];
			
			if ($_POST['skill_array'] == "NA") {
				$sub_skill_array = array();
			} else {
				$sub_skill_array = explode(",", $_POST['skill_array']);
			}
						
			
			$detail_array = array("company" => $company, "position" => $position, "start_month" => $start_month, "start_year" => $start_year, "end_month" => $end_month, "end_year" => $end_year, "current" => $current, "business_type" => $business_type, "titleID" => $titleID, "job_category" => $broad_category);		
			$workID = $employee->add_employee_record("employment", $detail_array);

			if ($broad_category == "FOH") {
				//general FOH job, add 4 broad skills, attach subs to server
				$skill_data_array = array("specialty" => "Host");
				$skillID = $employee->add_employee_record('skill', $skill_data_array);

				$skill_data_array = array("specialty" => "Bartender");
				$skillID = $employee->add_employee_record('skill', $skill_data_array);

				$skill_data_array = array("specialty" => "Bus");
				$skillID = $employee->add_employee_record('skill', $skill_data_array);
				
				$skill_data_array = array("specialty" => "Server");
				$skillID = $employee->add_employee_record('skill', $skill_data_array);
			} elseif ($broad_category == "Management" || $broad_category == "Manager") {
				//PATCH TO FIX INCONSISTENT MANAGER VS MANAGEMENT SKILL ENTRY
				$skill_data_array = array("specialty" => "Manager");
				$skillID = $employee->add_employee_record('skill', $skill_data_array);				
			} elseif ($broad_category != "error") {
				$skill_data_array = array("specialty" => $broad_category);
				$skillID = $employee->add_employee_record('skill', $skill_data_array);				
			}

			$ID_array = array("workID" => $workID, "skillID" => $skillID);

			$employee = new Employee($_SESSION['userID']);		
			$employee->add_employee_list_record("sub_skills", $sub_skill_array, $ID_array);
			$employee->update_employee_record("status", "complete", "");

		break;
		
		case "edit_work":
			$ID = trim($_POST['ID']);		
			$company = trim($_POST['company']);
			$position = trim($_POST['position']);
			$start_month = trim($_POST['start_month']);
			$start_year = trim($_POST['start_year']);
			$end_month = trim($_POST['end_month']);
			$end_year = trim($_POST['end_year']);
			$current = trim($_POST['current']);			
			$business_type = trim($_POST['business_type']);
//			$job_category = $_POST['job_category'];
//			$job_type = $_POST['job_type'];	
			$titleID = $_POST['titleID'];			
					
/*
			$status = $_POST['status'];
			$profile_status = $_POST['profile_status'];
*/
			
			if ($_POST['skill_array'] == "NA") {
				$sub_skill_array = array();
			} else {
				$sub_skill_array = explode(",", $_POST['skill_array']);
			}
			
			//echo "STATUS=".$status;
			
			$detail_array = array("company" => $company, "position" => $position, "start_month" => $start_month, "start_year" => $start_year, "end_month" => $end_month, "end_year" => $end_year, "current" => $current, "business_type" => $business_type, "titleID" => $titleID);		
			$job_type = $employee->update_employee_record("employment", $detail_array, $ID);			
			
			if ($job_type == "FOH") {
				//general FOH job, add 4 broad skills, attach subs to server
				$skill_data_array = array("specialty" => "Host");
				$skillID = $employee->add_employee_record('skill', $skill_data_array);

				$skill_data_array = array("specialty" => "Bartender");
				$skillID = $employee->add_employee_record('skill', $skill_data_array);

				$skill_data_array = array("specialty" => "Bus");
				$skillID = $employee->add_employee_record('skill', $skill_data_array);
				
				$skill_data_array = array("specialty" => "Server");
				$skillID = $employee->add_employee_record('skill', $skill_data_array);
			} elseif ($job_type == "Management" || $job_type == "Manager") {
				//PATCH TO FIX INCONSISTENT MANAGER VS MANAGEMENT SKILL ENTRY
				$skill_data_array = array("specialty" => "Manager");
				$skillID = $employee->add_employee_record('skill', $skill_data_array);				
			} elseif ($job_type != "error") {
				$skill_data_array = array("specialty" => $job_type);
				$skillID = $employee->add_employee_record('skill', $skill_data_array);				
			}
				
			$ID_array = array("workID" => $ID, "skillID" => $skillID);
			$employee->add_employee_list_record("sub_skills", $sub_skill_array, $ID_array);

			echo "workID=".$ID." skillID=".$skillID;

// 			if ($profile_status == "complete") {
				$complete_check = $employee->profile_complete_check();	 
				//echo $complete_check;
/*
			} else {
				//mark profile as complete after record added
				$employee->update_employee_record("status", "complete", "");
			}	
*/
		break;	
		
		case "overwrite_experience":
			$total = trim($_POST['total']);
			$hospitality = trim($_POST['hospitality']);
			
			$employee->overwrite_experience($total, $hospitality);						
		break;
		
		case "update_old_work":
			//update previous experience from before update, to have title category
			$titleID = trim($_POST['titleID']);		
			$employmentID = trim($_POST['employmentID']);		

			$employee->update_employee_record("add_work_category", $titleID, $employmentID);			
		break;		
				
		case "edit_work_old":
			$workID = trim($_POST['workID']);		
			$company = trim($_POST['company']);
			$position = trim($_POST['position']);
			$start_month = trim($_POST['start_month']);
			$start_year = trim($_POST['start_year']);
			$end_month = trim($_POST['end_month']);
			$end_year = trim($_POST['end_year']);
			$current = trim($_POST['current']);			
			$website = trim($_POST['website']);
			
			$pos = strpos($website, "http://");
			$pos_s = strpos($website, "https://");
			
			if ($pos !== false) {
				$website = str_replace("http://", "", $website);
			}
			
			if ($pos_s !== false) {
				$website = str_replace("https://", "", $website);
			}																	

			$detail_array = array("company" => $company, "position" => $position, "start_month" => $start_month, "start_year" => $start_year, "end_month" => $end_month, "end_year" => $end_year, "current" => $current, "website" => $website);		
			$employee->update_employee_record("employment", $detail_array, $workID);			
		break;	
		
		case "update_work_category":
			//this case is used for updating jobs in the old format to the new format
			$workID = $_POST['workID'];		
			$titleID = $_POST['titleID'];			

			$employee->update_employee_record("add_work_category", $titleID, $workID);					
		break;
		
		case "fix_past_employment":
			$workID = trim($_POST['workID']);		
			$start_month = trim($_POST['start_month']);
			$start_year = trim($_POST['start_year']);
			$end_month = trim($_POST['end_month']);
			$end_year = trim($_POST['end_year']);
			$current = trim($_POST['current']);			

			$detail_array = array("start_month" => $start_month, "start_year" => $start_year, "end_month" => $end_month, "end_year" => $end_year, "current" => $current);		
			$employee->update_employee_record("fix_employment", $detail_array, $workID);					
		break;
		
		case "remove_work":
			$workID = $_POST['workID'];
			$employee->remove_employee_record("employment", $workID);		
		break;				
		
		case "add_education":
			$school = trim($_POST['school']);
			$degree = trim($_POST['degree']);
			$type = trim($_POST['type']);

			$detail_array = array("school" => $school, "degree" => $degree, "type" => $type);		
			$employee->add_employee_record("education", $detail_array);			
		break;
		
		case "add_award":
			$award = trim($_POST['award']);

			$employee->add_employee_record("award", $award);			
		break;		
		
		case "add_certification":
			$certification = trim($_POST['certification']);

			$employee->add_employee_record("certification", $certification);							
		break;
		
		case "edit_certification":
			$certificationID = trim($_POST['certificationID']);		
			$certification = trim($_POST['certification']);

			$employee->update_employee_record("certification", $certification, $certificationID);			
		break;			
				
		case "edit_education":
			$educationID = trim($_POST['educationID']);		
			$school = trim($_POST['school']);
			$degree = trim($_POST['degree']);
			$type = trim($_POST['type']);

			$detail_array = array("school" => $school, "degree" => $degree, "type" => $type);		
			$employee->update_employee_record("education", $detail_array, $educationID);			
		break;	
		
		case "edit_award":
			$awardID = trim($_POST['awardID']);		
			$award = trim($_POST['award']);

			$employee->update_employee_record("award", $award, $awardID);			
		break;	
		
		case "edit_descriptions":
			$quote = trim($_POST['quote']);		
			$description = trim($_POST['description']);

			$detail_array = array("quote" => $quote, "description" => $description);		
			$employee->update_employee_record("descriptions", $detail_array, "");			
		break;	
		
		case "edit_traits_languages":
			$languages = trim($_POST['language_array']);
			$traits = trim($_POST['trait_array']);
			if ($languages != "") {
				$language_array = explode(",", $languages);				
				$employee->add_employee_list_record('language', $language_array, "");																
			} else {
				$employee->remove_employee_record("language_list", "");
			}
			
			if ($traits != "") {
				$trait_array = explode(",", $traits);	
				$employee->add_employee_list_record('traits', $trait_array, "");																					
			} else {
				$employee->remove_employee_record("trait_list", "");			
			}	
													
		break;				
		
		case "remove_education":
			$educationID = $_POST['educationID'];			
			$employee->remove_employee_record("education", $educationID) ;		
		break;
		
		case "remove_award":
			$awardID = $_POST['awardID'];			
			$employee->remove_employee_record("award", $awardID) ;		
		break;				

		case "remove_certification":
			$certificationID = $_POST['certificationID'];			
			$employee->remove_employee_record("certification", $certificationID) ;		
		break;				
		
		case "update_status":
			$status = $_POST['status'];					
			$employee->update_employee_record("status", $status, "");
			if ($status == "complete") {
				$ref_ID = $employee->profile_complete_check();
				echo $ref_ID;
			}	 			
		break;																		

		case "email_settings":
			$setting = $_POST['email_match_setting'];	
			$record_update = array("setting" => $setting);
			$employee->update_employee_record("email_setting", $record_update, $_SESSION['userID']);			
		break;

		case "share_settings":
			$setting = $_POST['share_setting'];	
			$record_update = array("setting" => $setting);
			$employee->update_employee_record("share_settings", $record_update, $_SESSION['userID']);			
		break;		
		
		case "remove_photo":
			$photoID = $_POST['photoID'];
			$employee->remove_photo($photoID);		
		break;
		
		case "upload_video":
			$url = $_POST['video_url'];	
			$employee->add_employee_record("video", $url);			
		break;
		
		case "remove_video":
			$videoID = $_POST['videoID'];	
			$employee->remove_employee_record("video", $videoID) ;		
		break;	
		
		case "complete_check":
			$employee->profile_complete_check();
		break;	
		
		case "upload_pic":
			if (isset($_SESSION['userID']) && $_SESSION['userID'] != 0) {
				$employee = new Employee($_SESSION['userID']);
				$utilities = new Utilities;
				$photo_type = $_GET['type'];
					//swtich depending on type of pics upload
					switch($photo_type) {
						case "profile":
							$new_name = $_SESSION['userID'].".jpg";			
							$file_name = $_FILES['profile_pic_choose']['name'];
							$temp_name = $_FILES['profile_pic_choose']['tmp_name'];
							$error = $_FILES['profile_pic_choose']['error'];
							$img_src = "images/profile_pics/".$new_name;			
							$dest = "images/profile_pics/";
							$file_type = $_FILES['profile_pic_choose']['type'];
							$file_size = $_FILES['profile_pic_choose']['type'];	
							$thumb_name = "";
														
							$employee->upload_photo($photo_type, $file_type, $file_size, $file_name, $temp_name, $error, $new_name, $dest, $img_src, $thumb_name);
						break;
							
						case "bartender":
							$photo_number = $utilities->get_photo_number();
							
							$new_name = "bartender_".$photo_number."_".$_SESSION['userID'].".jpg";	
							$thumb_name = "bartender_".$photo_number."_".$_SESSION['userID']."_s.jpg";										
							$file_name = $_FILES['bartender_pic_choose']['name'];
							$temp_name = $_FILES['bartender_pic_choose']['tmp_name'];
							$error = $_FILES['bartender_pic_choose']['error'];
							$img_src = "images/gallery_pics/".$new_name;
							$dest = "images/gallery_pics/";		
							
							$employee->upload_photo($photo_type, $file_type, $file_size, $file_name, $temp_name, $error, $new_name, $dest, $img_src, $thumb_name);
						break;	
						
						case "kitchen":				
							$photo_number = $utilities->get_photo_number();
							
							$new_name = "kitchen_".$photo_number."_".$_SESSION['userID'].".jpg";	
							$thumb_name = "kitchen_".$photo_number."_".$_SESSION['userID']."_s.jpg";										
							$file_name = $_FILES['kitchen_pic_choose']['name'];
							$temp_name = $_FILES['kitchen_pic_choose']['tmp_name'];
							$error = $_FILES['kitchen_pic_choose']['error'];
							$img_src = "images/gallery_pics/".$new_name;
							$dest = "images/gallery_pics/";		
							
							$employee->upload_photo($photo_type, $file_type, $file_size, $file_name, $temp_name, $error, $new_name, $dest, $img_src, $thumb_name);
						break;									
					}	
			}		
		break;
		
		case "change_email":
			//for users who have yet to verify email address
			if (filter_var($_POST['new_email'], FILTER_VALIDATE_EMAIL) !== false) {
				$email_array = array("old_email" => $_POST['old_email'], "new_email" => $_POST['new_email']);
				$result = $member->update_email_address("unverified", $email_array);	
				echo $result;
			} else {
				echo "email";
			}											
		break;		
		
		case "new_email":
			//users who have verified their address but need to change it
			if (filter_var($_POST['new_email'], FILTER_VALIDATE_EMAIL) !== false) {
				$email_array = array("old_email" => $_POST['old_email'], "new_email" => $_POST['new_email']);
				$result = $member->update_email_address("verified", $email_array);	
				echo $result;
			} else {
				echo "email";
			}											
		break;				
		
		case "register_new":
			$verification = new Verification;
		
			$firstname = trim($_POST['first']);
			$lastname = trim($_POST['last']);
			$username = trim($_POST['login']);
			$password = trim($_POST['pass']);
			$access = trim($_POST['access']);	
			$zip = trim($_POST['zip']);			
			$phone = trim($_POST['phone']);			
			$jobID = trim($_POST['jobID']);
			
			if ($firstname == "" || $lastname == "" || $password == "" || $zip == "") {
				echo "empty";
			} elseif ($utilities->zip_validate($zip) == "invalid") {
				echo "zip";
			} elseif (filter_var($username, FILTER_VALIDATE_EMAIL) !== false) {
				$result = $verification->register_employee($firstname, $lastname, $account, $username, $password, $access, $zip, $phone, $jobID);
				echo $result;		
			} else {
				echo "email";
			}		
		break;	
		
		case "new_location":
			$match = new Match;	
			//user has changed zip code, hide old jobs
			$match->new_location_filter($_SESSION['userID']);
		break;
		
		case "switch_account_type":
			$employee->switch_account_type();		
		break;	
		
		case "cancel_interview":
			$matchID = $_POST['matchID'];
			
			$candidate = new Candidate($matchID);

			$candidate->cancel_interview($matchID, "employee_cancel");				
		break;
		
		case "update_interview_status":
			$matchID = $_POST['matchID'];
			$status = $_POST['status'];
			
			$candidate = new Candidate($matchID);

			$candidate->update_interview_status($matchID, $status);				
		break;
		
		case "remove_resume":
			$resume = $_POST['resume'];
			$employee->remove_resume($resume);					
		break;		
		
	} 
?>