<?php
	require_once('classes/admin.class.php');
	session_start();
	ini_set(‘display_errors’,1);
	error_reporting(E_ALL|E_STRICT);  
	$update_type = $_GET['type'];

	$admin = new Admin;	

	switch($update_type) {
		case "add_culinary_member":
 			$email = trim($_POST['email']);
			$school = trim($_POST['school']);			
			$password = trim($_POST['password']);
			$year = trim($_POST['year']);
			$month = trim($_POST['month']);
			$day = trim($_POST['day']);
			$pass = trim($_POST['pass']);

			if ($pass == "Handle1t") {
				$admin->create_culinary_member($email, $password, $school, $month, $day, $year);
			}		
		break;
		
		case "change_email":
			$email_setting = trim($_POST['email_setting']);
			$userID = trim($_POST['userID']);
			$pass = trim($_POST['pass']);
			echo $pass;

			if ($pass == "Handle1t") {
				$admin->change_email_setting($userID, $email_setting);
			}
		break;
		
		case "change_activation":
			$activation_setting = trim($_POST['activation_setting']);
			$activation_reason = trim($_POST['activation_reason']);			
			$userID = trim($_POST['userID']);
			$pass = trim($_POST['pass']);

			if ($pass == "Handle1t") {
				$admin->change_activation_setting($userID, $activation_setting, $activation_reason);
			}
		break;
		
		case "unarchive_job":
			$jobID = $_POST['jobID'];

			$admin->unarchive_job($jobID);
		break;	
		
		case "new_region":
			$region = trim($_POST['region']);
			$zip = trim($_POST['zip']);			
			$pass = trim($_POST['pass']);

			if ($pass == "Handle1t") {
				$result = $admin->ad_region($region, $zip);
				echo $result;
			}	
		break;
		
		case "new_ad":
			$region = trim($_POST['regionID']);
			$ad_title = trim($_POST['ad_title']);			
			$ad_type = trim($_POST['ad_type']);			
			$ad_link = trim($_POST['ad_link']);
			$deal = trim($_POST['deal']);			
			$photo_link = trim($_POST['photo_link']);
			$description = trim($_POST['description']);
			$pass = trim($_POST['pass']);

			if ($pass == "Handle1t") {
				$result = $admin->new_ad($region, $ad_title, $ad_link, $photo_link, $description, $ad_type, $deal);
				echo $result;
			}	
		break;
		
		case "remove_ad":
			$adID = trim($_POST['adID']);
			$admin->remove_ad($adID);
		break;	
		
		case "new_job_template":
			$requirements = "";
			if ($_POST['general_requirements'] != "") {
				$requirements .= ",".$_POST['general_requirements'];
			}
			if ($_POST['front_requirements'] != "") {
				$requirements .= ",".$_POST['front_requirements'];
			}
			if ($_POST['back_requirements'] != "") {
				$requirements .= ",".$_POST['back_requirements'];
			}

			$title = trim($_POST['title']);
			$main_skill = trim($_POST['main_skill']);			
			$pay = trim($_POST['pay']);			
			$schedule = trim($_POST['schedule']);
			$sub_skills_array = explode(",", $_POST['sub_skills']);			
			$requirements_array = explode(",", $requirements);			
			$questions_array = explode(",", $_POST['questions']);			
			$pass = trim($_POST['pass']);

			if ($pass == "Handle1t") {
				$result = $admin->new_job_template($title, $main_skill, $pay, $schedule, $sub_skills_array, $requirements_array, $questions_array);
				echo $result;
			}	
		break;	

		case "edit_job_template":
			$requirements = "";
			if ($_POST['general_requirements'] != "") {
				$requirements .= ",".$_POST['general_requirements'];
			}
			if ($_POST['front_requirements'] != "") {
				$requirements .= ",".$_POST['front_requirements'];
			}
			if ($_POST['back_requirements'] != "") {
				$requirements .= ",".$_POST['back_requirements'];
			}
		
			$templateID = trim($_POST['templateID']);
			$title = trim($_POST['title']);
			$pay = trim($_POST['pay']);			
			$schedule = trim($_POST['schedule']);
			$sub_skills_array = explode(",", $_POST['sub_skills']);			
			$requirements_array = explode(",", $requirements);			
			$questions_array = explode(",", $_POST['questions']);			
			$pass = trim($_POST['pass']);

			if ($pass == "Handle1t") {
				$result = $admin->edit_job_template($templateID, $title, $pay, $schedule, $sub_skills_array, $requirements_array, $questions_array);
				echo $result;
			}	
		break;
		
		case "delete_template":
			$templateID = trim($_POST['templateID']);
			$pass = trim($_POST['pass']);

			if ($pass == "Handle1t") {
				$result = $admin->delete_job_template($templateID);
				echo $result;
			}			
		break;									
		
		case "edit_requirement":
			$reqID = trim($_POST['reqID']);
			$requirement = trim($_POST['requirement']);			
			$pass = trim($_POST['pass']);

			if ($pass == "Handle1t") {
				$result = $admin->edit_requirement_template($reqID, $requirement);
				echo $result;
			}			
		break;
		
		case "delete_requirement":
			$reqID = trim($_POST['reqID']);
			$pass = trim($_POST['pass']);

			if ($pass == "Handle1t") {
				$result = $admin->delete_requirement_template($reqID);
				echo $result;
			}			
		break;				
		
		case "new_requirement":
			$requirement = trim($_POST['requirement']);			
			$pass = trim($_POST['pass']);

			if ($pass == "Handle1t") {
				$result = $admin->new_requirement_template($requirement);
				echo $result;
			}					
		break;
		
		case "edit_question":
			$questionID = trim($_POST['questionID']);
			$question = trim($_POST['question']);
			$type = trim($_POST['type']);
			$answer_array = explode(",", $_POST['answer']);			
			$pass = trim($_POST['pass']);

			if ($pass == "Handle1t") {
				$result = $admin->edit_question_template($questionID, $question, $answer_array, $type);
				echo $result;
			}			
		break;
		
		case "delete_question":
			$questionID = trim($_POST['questionID']);
			$pass = trim($_POST['pass']);

			if ($pass == "Handle1t") {
				$result = $admin->delete_question_template($questionID);
				echo $result;
			}			
		break;						
		
		case "new_question":
			$question = trim($_POST['question']);			
			$answer_array = explode(",", $_POST['answer']);			
			$type = trim($_POST['type']);
			$pass = trim($_POST['pass']);

			if ($pass == "Handle1t") {
				$result = $admin->new_question_template($question, $answer_array, $type);
				echo $result;
			}					
		break;
		
		case "new_job_template_title":
			$title = trim($_POST['title']);			
			$type = trim($_POST['type']);

			$result = $admin->new_job_template_title($title, $type);
			echo $result;
		break;	
	
		case "edit_job_title_template":
			$title = trim($_POST['title']);			
			$type = trim($_POST['type']);
			$titleID = $_POST['titleID'];
			$skill_array = explode(",", $_POST['skills']);			

			$result = $admin->update_job_template_title($titleID, $title, $type, $skill_array);
			echo var_dump($skill_array);
			echo $result;
		break;	
		
		case "new_skill_template":
			$skill = trim($_POST['skill']);			
			$skill_type = trim($_POST['skill_type']);			
			$rankable = trim($_POST['rankable']);			

			$result = $admin->new_skill_template($skill, $skill_type, $rankable);
			echo $result;
		break;					
		
		case "remove_job":
			$pass = $_POST['pass'];
			$jobID = $_POST['jobID'];
			
			if ($pass == "Handle1t" && $jobID > 0) {
				$admin->remove_job($jobID);
			}							
		break;	
		
		case "save_boost":
			$boostID = trim($_POST['boostID']);			
			$month = trim($_POST['month']);			
			$day = trim($_POST['day']);			
			$year = trim($_POST['year']);			

			$date = $year."-".$month."-".$day." 00:00:00";

			$admin->save_boost($boostID, $date);	
		break;			
		
		case "save_cl_post":
			$groupID = trim($_POST['groupID']);			
			$month = trim($_POST['month']);			
			$day = trim($_POST['day']);			
			$year = trim($_POST['year']);			

			$date = $year."-".$month."-".$day." 00:00:00";

			$admin->save_cl_post($groupID, $date);	
		break;			
		
		case "save_amazon_date":
			$signupID = trim($_POST['signupID']);			
			$month = trim($_POST['month']);			
			$day = trim($_POST['day']);			
			$year = trim($_POST['year']);			

			$date = $year."-".$month."-".$day." 00:00:00";

			$admin->save_amazon_date($signupID, $date);	
		break;			
		
	}
						