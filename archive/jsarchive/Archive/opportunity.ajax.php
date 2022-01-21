<?php
//==================================
//!   Handler for ajax calls to Opportunity functions 
//==================================


//CHANGE FOR LIVE SITE
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/opportunity_list.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/opportunity.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/employee.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/member.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/utilities.class.php');		

	require_once($_SERVER['DOCUMENT_ROOT'].'/mobile/opportunity_html_mobile.php');		
	require_once($_SERVER['DOCUMENT_ROOT'].'/html/opportunity_html.php');		

	$utilities = new Utilities;
	$site_type	 = $utilities->site_type;
	
	session_start();
	
	if ($site_type == "prototype") {
		ini_set('display_errors',1);
		error_reporting(E_ALL|E_STRICT); 
	} 
	
	$jobID = $_POST['jobID'];	
 	$type = $_GET['type'];
 	 	
 	switch($type) {
	 	case "employee_interest":
			
			//Make sure this isn't a double update, some people push back very quickly then the response can be overwritten
			$opportunity = new Opportunity($jobID);			
			$opportunity_data = $opportunity->get_opportunity_data();
			$response_data = $opportunity_data['response_data'];
			if ($response_data['employee_interest'] == "") {
				$interest = $_POST['interest'];
				if ($interest == "Y") {
					$questionID_1 = $_POST['questionID_1'];
					$answer_1 = trim($_POST['answer_1']);		
					$questionID_2 = $_POST['questionID_2'];
					$answer_2 = trim($_POST['answer_2']);								
					$questionID_3 = $_POST['questionID_3'];
					$answer_3 = trim($_POST['answer_3']);	
					$phone = trim($_POST['phone']);																						
					$personal_message = trim($_POST['personal_message']);		
					$save_message = trim($_POST['save_message']);
					$save_answers = trim($_POST['save_answers']);																													
					$recommendID = trim($_POST['recommendID']);																													

					$input_array = array("interest"=>$interest, "personal_message"=>$personal_message,
													"questionID_1"=>$questionID_1, "answer_1"=>$answer_1,
													"questionID_2"=>$questionID_2, "answer_2"=>$answer_2,
													"questionID_3"=>$questionID_3, "answer_3"=>$answer_3,
													"recommendID"=>$recommendID);

					$opportunity = new Opportunity($jobID);			
					$test = $opportunity->update_opportunity('interested', $input_array);
					
					if ($save_message == 'Y') {
						//save message in DB for later use
						$employee = new Employee($_SESSION['userID']);
						$employee->save_message("personal", $personal_message);
					}
					
					if ($save_answers == 'Y') {
						//save message in DB for later use
						$question_array = array("questionID_1"=>$questionID_1, "answer_1"=>$answer_1,
														"questionID_2"=>$questionID_2, "answer_2"=>$answer_2,
														"questionID_3"=>$questionID_3, "answer_3"=>$answer_3);
						$employee = new Employee($_SESSION['userID']);
						$employee->save_answers($question_array);
					}
					
					//UPDATE PHONE
					//echo $phone;
					$member = new Member($_SESSION['userID']);
					$member->update_phone($phone);
					echo $test;	
																		
				} else {
					$input_array = array("interest"=>$interest);	
					$opportunity = new Opportunity($jobID);			
					$test = $opportunity->update_opportunity('decline', $input_array);
					echo $test;										
				}
			}
		break;

		case "load_suggestions":
			$opportunity_list = new OpportunityList($_SESSION['userID']);			
			$opportunity_list = $opportunity_list->get_local_opportunities();
			
			$suggestion_list = array();
			
			if (count($opportunity_list) > 0) {
				foreach($opportunity_list as $row) {
					if ($row['responded'] != "Y") {
						$suggestion_list[] = $row;
					}
				}
			}
			
			$random_suggestion = array();
			
			if (count($suggestion_list) > 3) {
				$rand_keys = array_rand($suggestion_list, 3);
				$random_suggestion[] = $suggestion_list[$rand_keys[0]];
				$random_suggestion[] = $suggestion_list[$rand_keys[1]];
				$random_suggestion[] = $suggestion_list[$rand_keys[2]];
			}
			suggestion_list_html($random_suggestion);
		break;		
		
		case "log_copy":
			$opportunity = new Opportunity($jobID);			
			
			$opportunity->log_job_share($jobID);
		break;				
		
		case "recommend_summary":
			//summarize recommendation for the user
			$email = trim($_POST['email']);
			$firstname = trim($_POST['firstname']);
			$lastname = trim($_POST['lastname']);
			$coworker = trim($_POST['coworker']);
			$employer = trim($_POST['employer']);
//			$notes = trim($_POST['notes']);

			$utilities = new Utilities;
			$employee = new Employee($_SESSION['userID']);
			
			$recommender_data = $employee->get_employee_data();
			
			$past_employment = $recommender_data['employment'];
			
			$hospitality_holder = array();
			$other_holder = array();	
			$unknown_holder = array();	
			
			$current_array = array();

			foreach($past_employment as $row) {
				//echo var_dump($row);
				if ($row['category'] == "other") {
					$other_holder[] = $row;
				} elseif ($row['category'] == "") {						
					$unknown_holder[] = $row;	
				} else {
					$hospitality_holder[] = $row;							
				}		
				
				if ($row['current'] == 'Y') {
					$current_array[] = $row;	
				}
			}
			
			$total_experience['other'] = $utilities->determine_years_of_experience($other_holder);
			$total_experience['unknown'] = $utilities->determine_years_of_experience($unknown_holder);
			$total_experience['hospitality'] = $utilities->determine_years_of_experience($hospitality_holder);

			//show the summary
			if ($total_experience['hospitality'] > 0) {
				$experience_text = " who has <b>".$total_experience['hospitality']." yrs of Hospitality Experience</b>.  ";
			} if ($total_experience['other'] > 0) {
				$experience_text = " who has ".$total_experience['hospitality']." yrs of general experience.  ";		
			} else {
				$experience_text = ".  ";
			}
			
			if (count($current_array) > 0) {
				$current_text = "The recommender is currently employed at <b>";
				$count = 1;
				foreach ($current_array as $row) {
					if ($count > 1) {
						$current_text .= " and ";
					}
					$current_text .= $row['company']." as ".$row['position'];
					$count++;
				}
				$current_text .= "</b>.  ";
			} else {
				$current_text = "";
			}
			
			if ($coworker == 'Y' && $employer == 'Y') {
				$relation_text = "This recommendation comes from a past employee of yours who has worked with this candidate";
			} elseif ($coworker == 'Y') {
				$relation_text = "This recommendation comes from a coworker of the candidate";		
			} elseif ($employer == 'Y') {
				$relation_text = "This recommendation comes from a past employee of yours";				
			} else {
				$relation_text = "This recommendation comes from an SBC member";
			}

			echo "<div id='summary_holder' style='width:100%; float:left;'>";
			
				if ($_SESSION['device'] == "full") {
					echo "If ".$firstname." applies, the employer will see the details below about your recommendation.<br />";
	
					echo "<div style='float:left; margin-top:0px; margin-left:10px; margin-right:10px; margin-top:10px; padding-right:5px; padding-bottom:10px;  margin-bottom:10px; width:90%; color:#760006; background-color:#e9e6de;'>";
						echo "<div style='width:100%; float:left; text-align:center'>";
							echo "<img src='images/completeprofile.png' width='35px' height='35px' alt='star' style='vertical-align:middle'> <b>".$firstname." ".$lastname." is recommended by ".$recommender_data['general']['firstname']." ".$recommender_data['general']['lastname']."</b>. <img src='images/completeprofile.png' width='35px' height='35px' alt='star' style='vertical-align:middle'>";
						echo "</div><br />";
						echo "<div style='float:left; width:90%; margin-left:35px; margin-top:3px; margin-right:40px;'>";
							echo $relation_text;
							echo $experience_text;
							echo $current_text;
						echo "</div>";
					echo "</div>";
				} else {
					echo "If ".$firstname." applies, the employer will see the details below about your recommendation.<br />";
	
					echo "<div style='float:left; margin-top:0px; margin-left:10px; margin-right:10px; margin-top:10px; padding-right:5px; padding-bottom:10px;  margin-bottom:10px; width:90%; color:#760006; background-color:#e9e6de;'>";
						echo "<div style='width:100%; float:left; text-align:center'>";
							echo "<b>".$firstname." ".$lastname." is recommended by ".$recommender_data['general']['firstname']." ".$recommender_data['general']['lastname']."</b>.";
						echo "</div><br />";
						echo "<div style='float:left; width:90%; margin-left:3px; margin-top:3px; margin-right:3px;'>";
							echo $relation_text;
							echo $experience_text;
							echo $current_text;
						echo "</div>";
					echo "</div>";
				}
				
				echo "<div style='float:left; width:100%;'><i>Note: Details about your experience and employment come from your profile, make sure it is up to date for the best recommendation.</i></div>";				

				//hidden form div
				echo "<input type='hidden' id='email_final' value='".$email."'>";
				echo "<input type='hidden' id='firstname_final' value='".$firstname."'>";
				echo "<input type='hidden' id='lastname_final' value='".$lastname."'>";
				echo "<input type='hidden' id='coworker_final' value='".$coworker."'>";
				echo "<input type='hidden' id='employer_final' value='".$employer."'>";
			echo "</div>";
		break;
		
		case "recommend":
			$email = trim($_POST['email']);
			$firstname = trim($_POST['firstname']);
			$lastname = trim($_POST['lastname']);
			$coworker = trim($_POST['coworker']);
			$employer = trim($_POST['employer']);

			$opportunity = new Opportunity($jobID);			

			$test = $opportunity->recommend_employee($email, $firstname, $lastname, $coworker, $employer);
			echo $test;		
		break;
		
		case "accept_recommendation":
			$jobID = $_POST['jobID'];
			$recommendationID = $_POST['recommendationID'];

			$opportunity = new Opportunity($jobID);	
			
			$opportunity->update_opportunity("accept_recommendation", $recommendationID);		
		break;
		
		case "change_recommendation":
			$jobID = $_POST['jobID'];
			$recommendationID = $_POST['recommendID'];

			$opportunity = new Opportunity($jobID);	
			
			$opportunity->update_opportunity("change_recommendation", $recommendationID);		
		break;		
		
		case "remove_recommendation":
			$jobID = $_POST['jobID'];
			$recommendationID = $_POST['recommendationID'];

			$opportunity = new Opportunity($jobID);			

			$test = $opportunity->remove_recommendation("candidate", $recommendationID);
			echo $test;		
		
		break;
		
		case "rescind_recommendation":
			$jobID = $_POST['jobID'];

			$opportunity = new Opportunity($jobID, "");			

			$test = $opportunity->reremove_recommendation("recommender", "");
			echo $test;		
		
		break;		
		
		case "review":
			//review profile, return results and replace the review div
			$employee = new Employee($_SESSION['userID']);
			
			$review_array = $employee->profile_review();

			if ($review_array['profile_pic'] == true) {
				$profile_icon = "<img src='images/savegreen.png'  style='width:25px;height:25px;vertical-align:middle'>";	
			} else {
				$profile_icon = "<img src='images/delete.png'  style='width:25px;height:25px;vertical-align:middle'>";					
			}	
			
			if ($review_array['quote'] == true) {
				$quote_icon = "<img src='images/savegreen.png'  style='width:25px;height:25px;vertical-align:middle'>";	
			} else {
				$quote_icon = "<img src='images/delete.png'  style='width:25px;height:25px;vertical-align:middle'>";					
			}
			
			if ($review_array['traits'] == true) {
				$trait_icon = "<img src='images/savegreen.png'  style='width:25px;height:25px;vertical-align:middle'>";	
			} else {
				$trait_icon = "<img src='images/delete.png'  style='width:25px;height:25px;vertical-align:middle'>";					
			}				

			application_review($profile_icon, $quote_icon, $trait_icon, $review_array['employment_count'], $review_array['sub_skill_count'], $review_array['employment_skill_count'], $review_array['education_count'], $review_array['certification_count'], $review_array['total_experience']);				
		break;	
		
		case "report":
			$opportunity = new Opportunity($jobID);			

			$ID = $_POST['jobID'];
			$type = $_POST['type'];
			
			$opportunity->report_inappropriate_content($jobID, $type);
		break;
		
 	}