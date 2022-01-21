<?php
//==================================
//!   Handler for ajax calls to Job functions 
//==================================

//CHANGE FOR LIVE SITE
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/job.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/member.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/candidate.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/utilities.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/match.class.php');	
	require_once($_SERVER['DOCUMENT_ROOT'].'/html/job_html.php');		
	require_once($_SERVER['DOCUMENT_ROOT'].'/mobile/job_html_mobile.php');
	$utilities = new Utilities;
	$site_type	 = $utilities->site_type;
	
	session_start();
	
	if ($site_type == "prototype") {
		ini_set('display_errors',1);
		error_reporting(E_ALL|E_STRICT); 
	} 
	
	$jobID = $_POST['jobID'];
	
	$job = new Job($jobID);
	
 	$type = $_GET['type'];
	
	switch($type) {	
		case "new_template_job":
			$templateID = trim($_POST['templateID']);
			$storeID = trim($_POST['storeID']);
			$groupID = trim($_POST['groupID']);
			$jobID = $job->add_template_job($storeID, $templateID, $groupID);
			echo $jobID;
		break;
		
		case "new_custom_job":
			$main_skill = trim($_POST['main_skill']);
			$storeID = trim($_POST['storeID']);
			$groupID = trim($_POST['groupID']);
			$jobID = $job->add_custom_job($storeID, $main_skill, $groupID);
			echo $jobID;
		break;
		
		case "repost_job":
			$storeID = trim($_POST['storeID']);
			$groupID = trim($_POST['groupID']);
			$newID = $job->repost_job($storeID, $groupID);
			echo $newID;
		break;
		
		case "repost_group":
			$old_groupID = trim($_POST['old_groupID']);
			$result = $job->repost_group($old_groupID);

			if ($result != "error") {
				$new_groupID = $result['new_groupID'];
				$storeID = $result['storeID'];
				$job_array = $result['job_array'];

				if (count($job_array) > 0) {
					foreach($job_array as $row) {
						$job = new Job($row['jobID']);
						$job->repost_job($storeID, $new_groupID);
					}
					echo $new_groupID;
				} else {
					echo "false1";
				}
			} else {
				echo "false2";
			}
		break;												
		
		case "update":
			$criteria = $_GET['criteria'];
			switch($criteria) {
				case "title":
					$title = trim($_POST['title']);
					$job->update_job('title', $title);								
				break;
				
				case "schedule":
					$schedule = trim($_POST['schedule']);
					$job->update_job('schedule', $schedule);								
				break;
				
				case "store":
					$storeID = trim($_POST['storeID']);
					$job->update_job('store', $storeID);								
				break;				

				case "benefits":
					$benefits_desc = trim($_POST['benefits_desc']);			
					$benefits = trim($_POST['benefits']);
					$benefit_array = array("benefits" => $benefits, "benefits_desc" => $benefits_desc);	
					$job->update_job('benefits', $benefit_array);								
				break;

				case "compensation":
					$comp_type = $_POST['comp_type'];
					$comp_value = trim($_POST['comp_value']);			
					$comp_array = array("comp_type" => $comp_type, "comp_value" => $comp_value);			
					$job->update_job('comp', $comp_array);			
				break;
				
				case "employment":
					$employment = trim($_POST['employment']);
					$job->update_job('employment', $employment);								
				break;
				
				case "intern":
					$intern = trim($_POST['intern']);
					$job->update_job('intern', $intern);								
				break;																				
				
				case "sub_specialty":
					$utilities = new Utilities;
					
					$sub_specialties = $_POST['sub_specialty'];							
					$sub_array_test = explode(",", $sub_specialties);
					//test sub-skill for errors
					$sub_array_final = array();
					
					$sub_specialty_array = array("specialtyID" => $_POST['specialtyID'], "sub_specialty" => $sub_array_test);			
					$job->update_job('sub_specialty', $sub_specialty_array);			
				break;
				
				case "requirements":
					$requirements = $_POST['requirements'];							
					$requirement_array = explode(",", $requirements);
					$job->update_job('requirements', $requirement_array);			
				break;
				
				case "question":
					$questionID = $_POST['questionID'];
					$question = $_POST['question'];		
					$type = $_POST['type'];	
					$question_array = array("questionID" => $questionID, "question" => $question, "type" => $type);			
					$job->update_job('question', $question_array);			
				break;	

				case "edit_question":
					$questionID = $_POST['questionID'];
					$template_questionID = $_POST['template_questionID'];
					$question = $_POST['question'];		

					$question_array = array("questionID" => $questionID, "question" => $question, "template_questionID" => $template_questionID);			
					$job->update_job('edit_question', $question_array);			
				break;	
				
				case "notes":
					$notes = trim($_POST['notes']);
					$job->update_job('notes', $notes);												
				break;																																											
			}
		break;
		
		case "add_general_details":
			$utilities = new Utilities;
			
			//$storeID = trim($_POST['storeID']);			
			$title = trim($_POST['title']);
			$main_skill = trim($_POST['main_skill']);	
			$benefits_desc = trim($_POST['benefits_desc']);			
			$schedule = trim($_POST['schedule']);
			$benefits = trim($_POST['benefits']);
			$comp_type = $_POST['comp_type'];
			$comp_value = trim($_POST['comp_value']);			
			$benefit_array = array("benefits" => $benefits, "benefits_desc" => $benefits_desc);
			$comp_array = array("comp_type" => $comp_type, "comp_value" => $comp_value);			
			$past_employment = $_POST['employment'];
			$intern = $_POST['intern'];

			$job->update_job('title', $title);				
			//$job->update_job('store', $storeID);								
			$job->update_job('schedule', $schedule);				
			$job->update_job('benefits', $benefit_array);
			$job->update_job('comp', $comp_array);			
			$job->update_job('employment', $past_employment);							
			if ($intern == "Y") {
				$job->update_job('intern', $past_employment);											
			}
			
			
			$title = $utilities->makeSafe_flat($title);
			
			$store_data = $job->get_job_details("store");	
			$store_name = 	$utilities->makeSafe_flat($store_data['name']);
			$storeID	= $store_data['storeID'];
			$store_array = $job->get_job_details("store_array");		

			$benefits_desc = $utilities->makeSafe_flat($benefits_desc);					
			if ($benefits == "Y") {
				$benefits_text =	"<div style='float:left; width:350px;'>Yes<br /><i>".$benefits_desc."</i></div><br />";
			} else {
				$benefits_text = 	"None<br />";				
			}

			switch($comp_type) {
				default:
					$compensation = $comp_type;
				break;
				
				case "Hourly":
					$compensation = "$".$comp_value."/hr";
					if ($comp_value == 0) {
						$comp_alert = "<b><font color='red'>!</font></b>";
					}
				break;
				
				case "Salary":
					$compensation = "Salary:  $".$comp_value."/yr";
					if ($comp_value == 0) {
						$comp_alert = "<b><font color='red'>!</font></b>";
					}				
				break;				
			}							
	
			
			if ($_SESSION['device'] == "full") {
				display_general_section($title, $store_array, $storeID, $store_name, $schedule, $compensation, $comp_type, $comp_value, $benefits, $benefits_text, $benefits_desc, $intern, $past_employment, $main_skill);											
			} else {
				display_general_section_mobile($title, $store_array, $storeID, $store_name, $schedule, $compensation, $comp_type, $comp_value, $benefits, $benefits_text, $benefits_desc, $intern, $past_employment, $main_skill);															
			}
			
		break;

		case "edit_all_details":
			$utilities = new Utilities;
			
			//$storeID = trim($_POST['storeID']);			
			$title = trim($_POST['title']);
			$main_skill = trim($_POST['main_skill']);	
			$specialtyID = $_POST['specialtyID'];	
			$benefits = trim($_POST['benefits']);
			$benefits_desc = trim($_POST['benefits_desc']);			
			$walkin = trim($_POST['walkin']);
			$walkin_desc = trim($_POST['walkin_desc']);			
			$schedule = trim($_POST['schedule']);
			$comp_type = $_POST['comp_type'];
			$comp_value_high = trim($_POST['comp_value_high']);			
			$comp_value_low = trim($_POST['comp_value_low']);			
			$requirements = $_POST['requirements'];							
			$sub_specialties = $_POST['skills'];							
			$notes = trim($_POST['notes']);


			$sub_array_test = explode(",", $sub_specialties);					
			$sub_specialty_array = array("specialtyID" => $specialtyID, "sub_specialty" => $sub_array_test);			

			$benefit_array = array("benefits" => $benefits, "benefits_desc" => $benefits_desc);
			$walkin_array = array("walkin" => $walkin, "walkin_desc" => $walkin_desc);
			$comp_array = array("comp_type" => $comp_type, "comp_value_high" => $comp_value_high, "comp_value_low" => $comp_value_low);			
			$requirement_array = explode(",", $requirements);

			$job->update_job('title', $title);				
			//$job->update_job('store', $storeID);								
			$job->update_job('schedule', $schedule);				
			$job->update_job('benefits', $benefit_array);
			$job->update_job('walkin', $walkin_array);
			$job->update_job('comp', $comp_array);			
			
	
			$job->update_job('requirements', $requirement_array);			
			$job->update_job('sub_specialty', $sub_specialty_array);			
			$job->update_job('notes', $notes);												
		break;
		
		case "create_group":
			//create a group 
			//for ease of payment system, jobs are put into groups
			$storeID = $_POST['storeID'];
			$post_type = trim($_POST['post_type']);

			$groupID = $job->create_group($storeID, $post_type);

			echo $groupID;
		break;
		
		case "add_bounty":
			$total_amount = trim($_POST['total_amount']);

			$result = $job->update_job('bounty_amount', $total_amount);
			
			echo $result;						
		break;
		
		case "add_custom_details":
			$utilities = new Utilities;

			$title = trim($_POST['title']);
			$notes = trim($_POST['notes']);
			$benefits_desc = trim($_POST['benefits_desc']);			
			$schedule = trim($_POST['schedule']);
			$benefits = trim($_POST['benefits']);
			$comp_type = $_POST['comp_type'];
			$comp_value = trim($_POST['comp_value']);			
			$benefit_array = array("benefits" => $benefits, "benefits_desc" => $benefits_desc);
			$comp_array = array("comp_type" => $comp_type, "comp_value" => $comp_value);			
			$past_employment = $_POST['employment'];
			$intern = $_POST['intern'];
			$specialtyID = $_POST['specialtyID'];
			$specialty = $_POST['specialty'];
			$sub_specialties = $_POST['sub_specialties'];
			$requirements = $_POST['requirements'];										

			$job->update_job('title', $title);				
			$job->update_job('schedule', $schedule);				
			$job->update_job('notes', $notes);				
			$job->update_job('benefits', $benefit_array);
			$job->update_job('comp', $comp_array);			
			$job->update_job('past_employment', $past_employment);							
			$job->update_job('past_employment', $past_employment);							
			if ($intern == "Y") {
				$job->update_job('past_employment', $past_employment);											
			}
			
			$requirement_array = explode(",", $requirements);
			$job->update_job('requirements', $requirement_array);						
											
			$sub_array_test = explode(",", $sub_specialties);
			//test sub-skill for errors

			$sub_specialty_array = array("specialtyID" => $specialtyID, "sub_specialty" => $sub_array_test);			
			$job->update_job('sub_specialty', $sub_specialty_array);			
			//$job->update_job("job_status", "choose_type");					
			$job->update_job("job_status", "template_edit");					
		break;	
		
		case "add_main_skill":
			$specialty = $_POST['specialty'];			
			$job->update_job("main_skill", $specialty);		
		break;				
		
		case "add_questions":
			$question_array = array();
			if ($_POST['question_1'] != "") {
				array_push($question_array, $_POST['question_1']);
			}
			if ($_POST['question_2'] != "") {
				array_push($question_array, $_POST['question_2']);
			}
			if ($_POST['question_3'] != "") {
				array_push($question_array, $_POST['question_3']);
			}		
			
			$job->update_job("questions", $question_array);					
		break;
		
		case "remove_question":
			$questionID = $_POST['questionID'];			
			$job->remove_job_data("question", $questionID);					
		break;													
		
		case "update_status":
			$status = $_POST['status'];			
			$job->update_job("job_status", $status);							
		break;
		
		case "close_job":
			$job->update_job('job_status', "Filled");	
		break;
		
		case "unfill_job":
			$job->update_job('job_status', "Open");	
		break;	
		
		case "remove_job":
			$groupID = $job->remove_job();	
			echo $groupID;	
		break;
		
		case "complete_check":
			$jobID = $_POST['jobID'];			
			$job->complete_check($jobID);				
		break;	
		
		case "match":
			$match = new Match();
			$jobID = $_POST['jobID'];		

			$match->get_match_array($jobID);			
		break;	
		
		case "confirm_hire":
			$status = $_POST['status'];
					
			$candidate_list = $_POST['candidate_list'];							
			$hireID_array = explode(",", $candidate_list);
						
			$job->confirm_hire($status, $hireID_array);			
		break;		
		
		case "update_bounty_status":
			$status_type = $_POST['status_type'];
			
			switch($status_type) {
				case "site":
					$input = $_POST['bounty_status'];
					$job->update_bounty_status($status_type, $input);							
				break;
			}
			
		break;
		
		case "save_boost_session":
			//before checkout, save boost details to a session variable
			
			//first verify that everything is valid
			//cannot have zero array variables
			
			//first destroy any current sessions associated with job
			unset($_SESSION['boost'][$jobID]);
			
			$boost_details = $_POST['boost_array'];	
			$jobID = $_POST['jobID'];	
			$final_cost = $_POST['final_cost'];					
			$boost_array = explode(",", $boost_details);

			if ($boost_details == "" || count($boost_array) < 1 || count($boost_array) > 3) {
				echo "error";
			} else {
				
				$_SESSION['boost'][$jobID]['final_cost'] = $final_cost;
				$_SESSION['boost'][$jobID]['cl_group'] = "N";
				$_SESSION['boost'][$jobID]['social'] = "N";
				$_SESSION['boost'][$jobID]['email'] = "N";
				
				foreach($boost_array as $row) {
					if ($row == "cl_group") {
						$_SESSION['boost'][$jobID]['cl_group'] = "Y";						
					} elseif ($row == "social") {
						$_SESSION['boost'][$jobID]['social'] = "Y";
					} elseif ($row == "email") {
						$_SESSION['boost'][$jobID]['email'] = "Y";
					}
				}
				
				echo "true";
			}
			
		break;
		
		case "boost_paid":

			$jobID = $_POST['jobID'];						
			//$email = $_POST['email'];
			$checkout_amount = $_POST['checkout_amount'];
			$phone = $_POST['employer_phone'];
			$transactionID = $_POST['transactionID'];

			$boost_array = array();
			
			if ($_POST['cl_group'] == "Y") {
				$boost_array[] = "cl_group";
			}
			
			if ($_POST['social'] == "Y") {
				$boost_array[] = "social";
			}

			if ($_POST['email'] == "Y") {
				$boost_array[] = "email";
			}

			$test = $job->job_boost_paid($jobID, $boost_array, $checkout_amount, $phone, $transactionID);							

			echo $test;
		break;
		
		case "post_paid":
			//mark group as paid and jobs as posted
			
			$groupID = $_POST['groupID'];						
			//$email = $_POST['email'];
			$checkout_amount = $_POST['checkout_amount'];
			$phone = $_POST['employer_phone'];
			$transactionID = $_POST['transactionID'];

			$test = $job->job_post_paid($groupID, $checkout_amount, $phone, $transactionID);							

			echo $test;			
		break;
		
		case "free_group_post":
			$groupID = $_POST['groupID'];	
			$phone = "NA";
								
			$test = $job->job_post_free($groupID, $phone);							

			echo $test;					
		break;
		
		case "update_group_post":
			$groupID = $_POST['groupID'];	
			$phone = "NA";
								
			$test = $job->update_group_post($groupID, $phone);							

			echo $test;					
		break;
		
	}	
?>