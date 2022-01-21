<?php
function opportunity_html_mobile($button_type, $opportunity_data, $employee_data, $answer_array) {
	
$utilities = new Utilities;
//==================================
//!  First break master arrays into trait arrays
//
//  Modify any data for presentation
//==================================

		$job_data						= $opportunity_data['job_data'];

		$post_type					= $job_data['general']['post_type'];
		$bounty						= $job_data['general']['bounty'];
		$hash							= $job_data['general']['public_hash'];

		$jobID							= $job_data['general']['jobID'];
		$store_name					= $job_data['store']['name'];
		$address						= $job_data['store']['address'];
		$zip								= $job_data['store']['zip'];
		$website						= $job_data['store']['website'];
		$facebook						= $job_data['store']['facebook'];
		$twitter							= $job_data['store']['twitter'];
		$store_type					= $job_data['store']['description'];

		$employer 					= $job_data['employer'];
		$title		 						= $job_data['general']['title'];
		$requirements		 		= $job_data['requirements'];
		$notes							= $job_data['general']['description'];
		$qualifications				= $job_data['general']['qualifications'];
		$main_skill		 			= $job_data['skills']['main_skill']['specialty'];
		$specialtyID			 		= $job_data['skills']['main_skill']['ID'];
		$benefits						= $job_data['general']['benefits'];
		$benefits_desc				= $job_data['general']['benefits_desc'];
		$schedule						= $job_data['general']['schedule'];
		$comp_type					= $job_data['general']['comp_type'];
		$comp_value					= $job_data['general']['comp_value'];
		$question_array				= $job_data['question_list']['questions'];
		$sub_skills						= $job_data['skills']['sub_skills'];
		$employment					= $job_data['general']['past_employment'];
		$date_created				= $job_data['general']['date_created'];
		
		if ($employee_data != "employer") {
			$response_data 				= $opportunity_data['response_data'];
			$employee_info		 			= $employee_data['general'];
			$past_employment		 	= $employee_data['employment'];
			$employment_version		= $employee_data['employment_version'];
			$video_array 					= $employee_data['video'];
			$personal_message			= $employee_data['personal_message']['message'];
			$saved_answer_array			= $employee_data['saved_answers'];
			$recommendation				= $opportunity_data['recommendation'];
		} else {
			$response_data 				= array();
			$employee_info		 			= "";
			$past_employment		 	= "";
			$video_array 					= "";	
			$recommendation				= "NA";	
		}
		
		$city_state = $utilities->get_city_state($zip);

		if ($employment == "Y") {
			if (count($past_employment) == 0) {
				$employment_test = "N";
			} else {
				$employment_test = "Y";							
			}
		} else {
				$employment_test = "Y";		
		}	
		
		if ($post_type == "bounty") {
			$bounty_bar = "<img src='images/bounty.png' height='50px' width='50px' alt='bounty_job' style='vertical-align:middle'> <h4 style='margin-bottom:5px; display:inline;'><a href='opportunity.php?ID=".$jobID."&hash=".$hash."&page=recommend'>&nbsp This job has a $".$bounty." bounty!</b></a></h4><br />";
		} else {
			$bounty_bar = "";
		}
		
//BUTTON TYPES

//1) ALL (can apply and recommend (if bounty)
//2) Incomplete Profile (if recommended, person is directed to create their profile to apply)
//3) Expired Responded (if bounty, show it as no longer available)
//4) Recommend (can only recommend)
//5) Employer = dead buttons

	switch($button_type) {
		case "all":
			
			if ($response_data['employee_interest'] == "Y") {
				$apply_bar = "<div style='float:left; width:100%; margin-top:15px;'>";
					$apply_bar .= "<h4 style='margin-bottom:3px; text-align:center'><i>You responded to this job on: <br /> ".date('M j, Y', strtotime($response_data['date_responded']))."</i></h4>";
				$apply_bar .= "</div>";				
			} else {
				$apply_bar = "<div style='float:left; width:100%; margin-top:15px;'>";
					$apply_bar .= "<div id='interested' style='float:left; width:50%; margin-left:25%; border-radius:10px; border-style:solid; border-width:3px; border-color:#b76e1f; background-color:#8e080b'><h2 style='color:white; margin-top:8px; margin-bottom:8px; cursor:pointer; text-align:center;'>APPLY NOW</h2></div>";
				$apply_bar .= "</div>";				
				
/*
				$apply_bar = "<div id='interested' style='float:left; width:100%; border-bottom: solid black 1px; border-top: solid black 1px;background-color:#b76e1f; padding: 3px 3px 3px 3px; margin-bottom:3px; color:white'>";
					$apply_bar .= "<div style='float:left; width:20%;'><img src='images/goldcheck.png' height='60px' width='50px' alt='bounty_job' style='vertical-align:middle;'></div>";
					$apply_bar .= "<div style='float:left; margin-top:5px; width:80%;'><h4 style='margin-bottom:5px; display:inline;'> Apply For This Position</h4><br />";
					$apply_bar .= "You can choose to include available recommendations on the next page.</div>";
				$apply_bar .= "</div>";			
*/
			}
			
		break;
		
		case "incomplete_profile":
			$apply_bar = "<div style='margin-bottom:20px'><a href='profile_menu.php' class='btn btn-primary' id='profile' style='padding-left:35px; padding-right:35px;'> &#10004; COMPLETE YOUR PROFILE & APPLY</a></div>";				
		break;
				
		case "expired":
			if ($response_data['employee_interest'] == "Y") {
				$interested_bar = "<div style='width:100%; float:left; margin-bottom:20px;'><h4 style='margin-bottom:3px;'>You responded to this job on ".date('M j, Y', strtotime($response_data['date_responded']))."</h4>";				
			} else {
				$interested_bar = "<div style='margin-bottom:20px'><a href='#' class='btn btn-primary' id='interested' style='padding-left:35px; padding-right:35px;'> &#10004; APPLY</a></div>";				
			}
									
			if ($response_data['employee_interest'] == "Y") {
				$apply_bar = "<div style='float:left; width:100%; margin-top:15px;'>";
					$apply_bar .= "<h4 style='margin-bottom:3px; text-align:center'><i>You responded to this job on: <br /> ".date('M j, Y', strtotime($response_data['date_responded']))."</i></h4>";
				$apply_bar .= "</div>";				
			} else {
				$apply_bar = "<div style='float:left; width:100%; margin-top:15px;'>";
					$apply_bar .= "<h4 style='margin-bottom:3px; text-align:center'>This Job Opportunity has expired.</h4>";
				$apply_bar .= "</div>";				
			}
		break;				
		
		case "employer":
				$apply_bar = "<div style='float:left; width:100%; margin-top:15px;'>";
					$apply_bar .= "<div id='#' style='float:left; width:50%; margin-left:25%; border-radius:10px; border-style:solid; border-width:3px; border-color:#b76e1f; background-color:#8e080b'><h2 style='color:white; margin-top:8px; margin-bottom:8px; cursor:pointer; text-align:center;'>APPLY NOW</h2></div>";
				$apply_bar .= "</div>";				
		break;
	}	
														
		switch($comp_type) {
			default:
				$compensation = $comp_type;
			break;
			
			case "Hourly":
				$compensation = "$".$comp_value."/hr";
			break;
			
			case "Salary":
				$compensation = "Salary:  $".$comp_value;
			break;				
		}		

		if ($benefits == "Y") {
			$benefits_text =	"<i>".$benefits_desc."</i><br />";
		} else {
			$benefits_text = 	"None<br />";				
		}

		switch($main_skill) {
			case "Bartender":
				$main_skill_image = "<img src='images/main-bar.png' height='100px'>";
			break;
			
			case "Manager":
				$main_skill_image = "<img src='images/main-manager.png' height='100px'>";
			break;
			
			case "Kitchen":
				$main_skill_image = "<img src='images/main-cook.png' height='100px'>";
			break;
			
			case "Server":
				$main_skill_image = "<img src='images/main-server.png' height='100px'>";
			break;
									
			case "Bus":
				$main_skill_image = "<img src='images/main-bus.png' height='100px'>";
			break;

			case "Host":
				$main_skill_image = "<img src='images/main-host.png' height='100px'>";
			break;						
		}				
		
		//$main_skill_image = "";
		
		if ($notes == "" && $qualifications == "") {
			$notes_text = "";
		} else {
			$notes_text = $notes." <br />".$qualifications;
		}
		
		$website_text = "";
		if ($website == "") {
			$website_text = "No Website";
		} else {
			$website_text = "<a href='http://".$website."'>Website</a>";
		}

		if ($facebook == "") {
			$facebook_text = "";
		} else {
			$facebook_text = " | <a href='http://".$facebook."'>Facebook</a>";
		}
		
		if ($twitter == "") {
			$twitter_text = "";
		} else {
			$twitter_text = " | <a href='http://".$twitter."'>Twitter</a>";
		}												

		echo "<div class='detail_holder job_details' style='margin-top:25px; width:100%;'>";

			//echo $bounty_bar;
			echo $apply_bar;

			
			echo "<div id='title_holder' style='width:100%; text-align:center; margin-top:10px; margin-bottom:10px; float:left; font-size:1.125em'>";
				echo "<h3>".$title."</h3>";
				echo "<h5 style='margin-top:0px; margin-bottom:0px'>".$store_name."</h3>";
				echo "<span style='color:gray;'><i>".$address."<br /> ".$city_state['city'].", ".$city_state['state']."</i></span>";					
			echo "</div>";
	
			echo	"<table class='dark' style='width:100%;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle'>General Details</th>";
				echo "</tr>";			
			echo "</table>";
	
			echo "<div style='float:left; width:100%; margin-left:5px; margin-right:3px;'>";
		
					echo "<div id='date_holder' style='width:100%; margin-top:5px; float:left; font-size:1.125em'>";
						echo "<div style='float:left; width:140px;'>&#9679; <b>Date Posted:</b> </div>";
						echo "<div id='date' style='float:left; padding-left:10px;'>".date('m-d-Y', strtotime($date_created))."</div>";
					echo "</div><br />";	
									
					echo "<div id='schedule_holder' style='width:100%; margin-top:10px; float:left; font-size:1.125em'>";		
						echo "<div style='float:left; width:150px;'>&#9679; <b>Schedule:</b></div>";
						echo "<span id='schedule_current' >".$schedule."</span>";
					echo "</div>";	
					
					echo "<div id='compensation_holder' style='width:100%; margin-top:10px; float:left; font-size:1.125em'>";					
						echo "<div style='float:left; width:150px;'>&#9679; <b>Compensation:</b></div>";
						echo "<span id='compensation_current'>".$compensation."</span>";
					echo "</div>";	
								
					echo "<div id='benefits_holder' style='width:100%; margin-top:10px; margin-bottom:10px; float:left; font-size:1.125em'>";					
						echo "<div style='float:left; width:150px;'>&#9679;  <b>Benefits:</b></div>";
						echo  "<span id='benefits_current'>".$benefits_text."</span>";
					echo "</div>";	

					echo "<div id='store_holder' style='width:100%; margin-top:10px; text-align:center; float:left; font-size:1.125em'>";
						//echo "<b><i>".$store_name." <br /> Job posted by: ".$employer['position']."</i></b>";    
						echo "<b><i>Job posted by: ".$employer['position']."</i></b>";    

					echo "</div>";	
					
					echo "<div id='type_holder' style='width:100%; margin-left:5px; margin-top:10px; margin-bottom:0px; float:left; font-size:1.125em'>";					
						echo  "<span id='store_type'>&#9679;  <b>Type:</b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ".$store_type."</span>";
					echo "</div>";	
					
					echo "<div id='type_holder' style='width:100%; margin-left:5px; margin-top:10px; margin-bottom:10px; float:left; font-size:1.125em'>";					
						echo  "<span id='store_type'>&#9679;  <b>Location: </b>&nbsp; &nbsp;<a href='https://www.google.com/maps/place/".$address." ".$zip."'>Map</a></span>";
					echo "</div>";						

					echo "<div id='type_holder' style='width:100%; margin-bottom:10px; margin-top:5px; text-align:center; float:left; font-size:1.125em'>";					
						echo  "<span id='store_type'> &nbsp; ".$website_text.$facebook_text.$twitter_text."</span>";
					echo "</div>";	

			echo "</div>";

			echo	"<table class='dark' style='width:100%;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle'>PREFERRED JOB SKILLS</th>";
				echo "</tr>";			
			echo "</table>";
			
			echo "<div id='skill_holder' style='width:100%; float:left; margin-bottom:10px;'>";
				echo "<div style='width:110px; float:left; text-align:center;'>";
					echo $main_skill_image."<br />";
				echo "</div>";																							
		
				echo "<div style='float:left;'>";
					if (count($sub_skills) == 0) {
						echo "&nbsp; <br /><i>No Specific Skills Required</i>";
					} else {							
						//table for display
						echo "<table id='skill_display' CELLSPACING=3 cellpadding=3 style='color:red'>";
						$row_count = 2;
						foreach ($sub_skills as $row) {
								if ($row_count % 2 == 0) {		
									echo "<tr>";	
									echo "<td><b> &#x2713; ".$row['sub_specialty']."</b></td>";
								} else {
									echo "<td><b> &#x2713; ".$row['sub_specialty']."</b></td>";								
									echo "</tr>";
								}
								$row_count++;
						}
						if ($row_count % 2 == 0) {	
							echo "</tr>";
						}															
						echo "</table>";	
					}			
				echo "</div>";
			echo "</div>";
						
			echo	"<table class='dark' style='width:100%; margin-bottom:5px;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle'>ADDITIONAL REQUIREMENTS</th>";
				echo "</tr>";			
			echo "</table>";

			echo "<div id='requirements_holder' style='float:left; margin-left:5px; margin-bottom:10px; font-size:1.125em'>"	;	
				if (count($requirements) > 0) {
					foreach ($requirements as $row) {
						echo "<img src='images/icon-locations.png' style='vertical-align:middle;' width=30px;></b>".$row['requirement']."<br />";
					}				
				} else {
					echo "<i>No Requirements Listed</i>";
				}					
			echo "</div>";
			
			if ($notes_text != "") {
				echo	"<table class='dark' style='margin-bottom:5px; width:100%;'>";
					echo "<tr valign='middle'>";
					echo "<th valign='middle'>OTHER INFORMATION</th>";
					echo "</tr>";			
				echo "</table>";
	
				echo "<div id='notes_holder' style='float:left; margin-left:5px; margin-bottom:10px; font-size:1.125em'>";
					echo "<div id='notes_current' style='float:left; padding-left:10px;'><i>".$notes_text."</i></div>";
				echo "</div><br />";
			}			

			echo	"<table class='dark' style='width:100%;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle'>PRE-INTERVIEW QUESTIONS</th>";
				echo "</tr>";			
			echo "</table>";
			echo "<div id='question_holder' style='float:left; margin-top:5px; margin-left:5px; margin-bottom:5px; font-size:1.125em'>";	
			echo "<i>You will be required to answer these questions when you apply for this position</i><br /> &nbsp; <br />";

				if (count($question_array) > 0) {
					$count = 1;
					foreach ($question_array as $row) {
						switch($count) {
							case "1":
								$question_image = "<img src='images/icon-one.png' style='vertical-align:middle;' width=30px;>";
							break;
							
							case "2":
								$question_image = "<img src='images/icon-two.png' style='vertical-align:middle;' width=30px;>";
							break;
		
							case "3":
								$question_image = "<img src='images/icon-three.png' style='vertical-align:middle;' width=30px;>";
							break;					
						}						
						echo $question_image." " .$row['question']."<br /> &nbsp; <br />";
						$count++;
					}
				} else {
					echo "<b>No Questions Added</b>";			
				}
				
			echo "</div>";

			echo	"<table class='dark' style='width:100%; margin-bottom:10px;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle'></th>";
				echo "</tr>";			
			echo "</table>";
			echo "&nbsp; <br />";
		if ($employee_data == "employer") {
			echo "<div style='width:100%; margin-bottom:7px; margin-top:8px; width:100%; text-align:center; float:left;'><a href='job.php?ID=".$jobID."' class='btn btn-large btn-primary' >CLOSE PREVIEW - RETURN TO JOB</a></div><br />";
		} else {
			echo "&nbsp; &nbsp; &nbsp; <a href='#' class='inappropriate'>Report Inappropriate Content</a>";
			echo "<div class='inappropriate_message' style='width:100%; float:left; text-align:center; display:none'><b>An administrator has been notified.  Thank you for reporting inappropriate content.</b></div>";
			echo "<br />";
			
		}						
			echo "&nbsp; <br />";		
		echo "</div>";													
	
	//if employer requires past employment, and user has none on their profile, require the user to edit their profile
	if ($employment_test == "Y") {
		if ($employment_version == "new") {	

			echo "<div id='interested_form' style='display:none; float:left; width:100%;'>";
				application_form_mobile($employee_data, $question_array, $saved_answer_array, $personal_message, $post_type, $recommendation);
			echo "</div>";	
		} else {
			echo "<div id='interested_form' style='display:none; float:left; width:100%;'>";
				echo "<div id='application_warning' style='float:left; width:100%; text-align:center;'>";
					echo " &nbsp; <br />";
					echo "<h3>".$title."</h3>";
					echo "<h4 style='margin-bottom:10px;'>To apply to this job, the employer would like you to provide a few more details about your previous employment experience.</h3>";
					echo "&nbsp; <br />";	
					echo "<a href='employee.php?page=work_skills_menu' class='btn btn-primary'>Update Details & Continue to Apply</a>";
					echo "&nbsp; <br />";
					echo "<div style='float:left; width:100%; text-align:center; margin-top:300px;'><a href='#' id='apply_anyway'>Apply without updating</a></div>";		
				echo "</div>";
				echo "<div id='application_form' style='display:none; float:left; width:100%;'>";
					application_form_mobile($employee_data, $question_array, $saved_answer_array, $personal_message, $post_type, $recommendation);
				echo "</div>";						
			echo "</div>";				
		}
	} else {
		echo "<div id='interested_form' style='display:none'>";
			echo " &nbsp; <br />";
			echo "<font color='red'><b>This employer requires your profile to list past employment to apply</b></font><br/>";
			echo "&nbsp; <br />";	
			echo "Please edit your profile in order to apply for this job:<br />";
			echo " &nbsp; <br />  <a href='employee.php?page=work_skills_menu' class='btn btn-primary'>ADD PAST EMPLOYMENT</a>";
			echo "&nbsp; <br />";		
		echo "</div>";		
	}
	
	echo "<div id='not_interested_form' style='display:none; text-align:center; margin-bottom:15px; width:98%; margin-left:3px; margin-right:1px;'>";
		echo "&nbsp; <br />";
		echo "Clicking below will remove this job from your list.  The employer will NOT be able to see any of your information.<br />";
		echo "&nbsp; <br />";
		
		echo "<div id='button_holder'>";
			echo "<a href='#' class='submit_not_interested btn btn-primary' id='".$job_data['jobID']."' >Remove Job</a> <a href='#' class='btn btn-primary' id='cancel_no_interest' >Cancel</a>";		
		echo "</div>";
	
		echo "<div id='loader_holder' style='display:none'>";
			echo "<b>LOADING...</b>";
		echo "</div>";
	
	echo "</div>";
	
	echo "<div id='phone_warning_holder' style='display:none; text-align:center; margin-bottom:15px; width:98%; margin-left:3px; margin-right:1px;'>";
		echo "&nbsp; <br />";
		echo "<font color='red'>NOTICE:  You have not included a contact phone number.</font><br />";
		echo "&nbsp; <br />";
		
		echo "<div id='button_holder'>";
			echo "<a href='#' class='submit_not_interested btn btn-primary' id='".$job_data['jobID']."' >Remove Job</a> <a href='#' class='btn btn-primary' id='cancel_no_interest' >Cancel</a>";		
		echo "</div>";
	
		echo "<div id='loader_holder' style='display:none'>";
			echo "<b>LOADING...</b>";
		echo "</div>";
	
	echo "</div>";	
	

	echo "&nbsp; <br />";
	echo "&nbsp; <br />";
	
	echo "<div class='detail_holder' id='answer_details' style='display:none'>";
		if (count($question_array) > 0) {
			foreach ($question_array as $question) {
				//determine if they user has an answer saved
				$employee_answer = "";
				if (count($response_answer_data) > 0) {
					foreach($response_answer_data as $answer) {
						if ($answer['questionID'] == $question['questionID']) {
							$employee_answer = $answer['answer'];
						}
					}
				}

				echo "<div style='color:gray; margin-top:3px; margin-left:10px; float:left; width:98%'>";	
					echo "<i>".$question['question']."</i><br />";
				echo "</div><br />";
				echo "<div style='margin-top:5px; margin-left:10px; float:left; margin-bottom:3px; width:98%'>";	
					echo $utilities->makeSafe_flat($employee_answer);
				echo "</div>";
			}
			
		} else {
			echo "<i>No pre-interview questions included with this job post</i>";
		}
	echo "</div>";
	
	echo "<div class='detail_holder' id='message_details' style='display:none'>";
		echo "<div style='margin-left:5px; margin-top:5px; width:98%;'>";
			if ($response_data['message'] == "") {
				echo "<i>No personal image included</i>";
			} else {
				echo "<b>Personal Message:</b><br />";
				echo "&nbsp; <br />";
				echo "<i>".$response_data['message']."</i>";
			}
		echo "</div>";
	echo "</div>";
	
	if ($response_data['employee_interest'] == "Y") {
		echo "<div id='application_details' style='float:left; width:100%; display:none;'>";
			application_details_mobile($title, $store_name, $response_data['date_responded'], $response_data['message'], $recommendation, $question_array, $answer_array);
		echo "</div>";
	}
	
			
	echo "</div>";		
}

function	 application_form_mobile($employee_data, $question_array, $saved_answer_array, $personal_message, $post_type, $recommendation) {

	if ($post_type == "bounty" && count($recommendation) > 0 && $recommendation != "NA" && $recommendation != "") {		
		choose_recommendation_html_mobile($recommendation, "application");
		//hidden form to flag whether there are recomendatins
		echo "<input type='hidden' id='recommendation_check' value='Y'>";
	} else {
		echo "<input type='hidden' id='recommendation_check' value='N'>";		
	}

	echo	"<table class='dark' style='width:100%; margin-top:3px;'>";
		echo "<tr valign='middle'>";
		echo "<th valign='middle'>Your Contact</th>";
		echo "</tr>";			
	echo "</table>";

	echo "<div style='float:left; width:100%; margin-left:5px; margin-right:3px; margin-top:5px; margin-bottom:5px;'>";
		echo "<div id='phone_warning' style='display:none; color:red'><b>Please include a contact phone number below.</b></div>";
		echo "&nbsp; <b>Phone Number</b> <br /><input type='tel' id='phone' style='width:95%;' value=".$employee_data['general']['contact_phone']."><br/>";					
	echo "</div>";					

	echo "<input type='hidden' id='question_count' value='".count($question_array)."'>";
	$count = 1;
	if (count($question_array) > 0) {

		echo	"<table class='dark' style='width:100%;'>";
			echo "<tr valign='middle'>";
			echo "<th valign='middle'>Required Information</th>";
			echo "</tr>";			
		echo "</table>";

	echo "<div style='float:left; width:100%; margin-left:5px; margin-right:3px; margin-top:5px; margin-bottom:5px;'>";
		echo "<div id='empty_warning' style='display:none; color:red'><b>You must answer all questions below.</b></div>";
		foreach ($question_array as $question) {
			//determine if they user has an answer saved
			$employee_answer = "";
			if (count($saved_answer_array) > 0) {
				foreach($saved_answer_array as $answer) {
					if ($answer['template_questionID'] == $question['template_questionID']) {
						$employee_answer = $answer['answer'];
					}
				}
			}

			echo "<input type='hidden' id='questionID_".$count."' value='".$question['questionID']."'>";					
			echo "<div style='margin-top:3px; float:left; width:100%'><b>";	
				echo $question['question']."<br />";
			echo "</b></div><br />";
			echo "<div id='charNum_".$count."' style='color:black; margin-bottom:2px; padding-left:15px;'></div>";						
			echo "<textarea id='answer_".$count."' style='width:90%;' cols='75' rows='2' maxlength='250'>".$employee_answer."</textarea>";
			echo "&nbsp; <br />";
			$count++;
		}
		echo "&nbsp; &nbsp; <span class='save_answers unselected_button' id='save_answers' data-save_answer='unselected' style='cursor:pointer;'><span class='fui-check-inverted' style='color:white; float:left;'></span> Remember answers</span><br />";				

		echo "</div>";

	}


		echo	"<table class='dark' style='width:100%;'>";
			echo "<tr valign='middle'>";
			echo "<th valign='middle'>Optional Information</th>";
			echo "</tr>";		
		echo "</table>";
		
		echo "<div style='float:left; width:100%; margin-left:5px; margin-right:3px; margin-top:5px; margin-bottom:5px;'>";								
			echo "&nbsp; <b>Personal Message</b>";
			echo "<div id='charNum_message' style='color:black; margin-bottom:2px;'></div>";										
			echo "<textarea id='personal_message' style='width:90%; margin-bottom:5px;' cols='65' maxlength='250' rows='2' placeholder='e.g. reason why you want to work their establishment, a reference that currently works at their establishment, etc.'>".$personal_message."</textarea><br />";
			echo "<div style='float:left; width:100%;'><span class='save_message unselected_button' id='save_message' data-save_message='unselected' style='cursor:pointer;'><span class='fui-check-inverted' style='color:white; float:left;'></span> Remember messsage</span></div><br />";				
		echo "</div>";

		echo "<div style='float:left; width:100%; text-align:center; margin-top:20px; margin-bottom:5x;'>";			
			echo "<a href='#' id='review_application' class='btn'>Review Application</a><br />";		
		echo "</div>";

		echo "<div id='review_holder' style='float:left; width:100%; display:none; text-align:center; margin-top:10px;'>";
			echo "LOADING....";
		echo "</div>";
	
		echo "&nbsp; <br />";
		echo "<table style='width:100%; background-color:#8e080b'>";
			echo "<tr>";
				echo "<th style='line-height:1px;'>&nbsp; </th>";
			echo "</tr>";
		echo "</table>";

		echo "<div id='button_holder' style='float:left; width:100%; text-align:center;'>";	
			echo "<div style='float:left; width:100%; text-align:center;'>";
				echo "<div id='submit_interested' style='float:left; width:80%; margin-top:15px; margin-left:10%; border-radius:10px; border-style:solid; border-width:3px; border-color:#b76e1f; background-color:#8e080b'><h2 style='color:white; margin-top:8px; margin-bottom:8px; cursor:pointer; text-align:center;'>Submit Application</h2></div>";
			echo "</div>";
			echo "<div style='float:left; width:100%; text-align:center; margin-top:10px; margin-bottom:10px;'>";
				echo "<a href='#' id='cancel'><h4>Cancel</h4></a>";
			echo "</div>";
// 			echo "<div style='width:75%; float:left; background-color:#b76e1f; min-height:30px; margin-right:1px;'><a href='#' id='submit_interested' style='color:white'><h4 style='margin-bottom:10px; margin-top:10px;'>Submit Interview Request</h4></a></div>";
// 			echo "<div style='width:24%; float:right; background-color:#DBDCCE; min-height:30px; text-align:center'><a href='#' id='cancel' style='color:#5D0000'><h4 style='margin-bottom:10px; margin-top:10px;'>Cancel</h4></a></div>";
		echo "</div>";	
						
	echo "<table style='width:100%; background-color:#8e080b'>";
		echo "<tr>";
			echo "<th style='line-height:1px;'>&nbsp; </th>";
		echo "</tr>";
	echo "</table>";				

	echo "<div style='padding-left:3px; padding-right:3px; padding-top:10px; padding-bottom:10px; background-color:#DBDCCE;'><b>IMPORTANT: Submitting a request does NOT guarantee an interview.  It will allow the job poster to view your profile and any message entered above while the job post is still valid.  Interviews are at the sole discretion of the employer.</b><br /> &nbsp; <br />Please review our <a href='http://servebartendcook.com/index.php?page=TOS'>TOS</a> and <a href='http://servebartendcook.com/index.php?page=privacy_policy'>Privacy Policy</a> if you have questions.</div>";	

	echo "<input type='hidden' id='hash' value='".$_GET['hash']."'>";

}

function opportunity_recommend_html_mobile($opportunity_data, $recommendation_count) {
		$job_data						= $opportunity_data['job_data'];

		$post_type					= $job_data['general']['post_type'];
		$bounty						= $job_data['general']['bounty'];

		$jobID							= $job_data['general']['jobID'];
		$store_name					= $job_data['store']['name'];

		$title		 						= $job_data['general']['title'];
		$main_skill		 			= $job_data['skills']['main_skill']['specialty'];

	echo "<div style='float:left; width:100%'>";
		echo "<h3 style='text-align:center; margin-top:15px;'>".$title."</h3>";

		echo "<div style='float:left; width:100%; margin-bottom:10px;'>";
			echo "<div style='float:left; width:20%;'>";
				echo "<img src='images/bounty.png' style='margin-left:3px; height:50px; width:50px; vertical-align:middle'>";		
			echo "</div>";
			
			echo "<div style='float:left; width:80%; margin-top:3px;'>";
				echo "<h4 style='display:inline'>Recommend to Potentially Earn &dollar;".$bounty."</h4><br />";		
			echo "</div>";
		echo "</div>";


		echo "<div id='recommend_form' style='float:left; width:100%;'>";
	
			echo "<div style='width:90%; margin-top:0px; float:left; padding-left:20px;'>";		
				echo "&#8226; Recommend someone for this position to be eligible for the above bounty.  <a href='main.php?page=bounty_faq'>Learn More</a><br />";
				echo "&#8226; You have recommended ".$recommendation_count." people for this job.  ";
				echo "<a href='employee.php?page=recommendation_list'>View All Recommendations</a><br />";
			echo "</div>";
					
			echo "<div style='width:100%; margin-top:10px; float:left; margin-left:5px;'>";
				echo "<h4 style='margin-bottom:5px'>Who would you like to recommend for this job? </h4>";
				echo "<div id='empty_error' class='error' style='color:red; display:none'>Fields cannot be empty.</div>";
		
					echo "<table width='95%' style='padding-left:10px;'>";
						echo "<tr>";
							echo "<td><b>First Name: &nbsp; </b></td>";
							echo "<td><input type='text' name='firstname' id='firstname'></input></td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td><b>Last Name: &nbsp; </b></td>";
							echo "<td><input type='text' name='lastname' id='lastname'></input></td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td><b>Email Address: &nbsp; </b></td>";
							echo "<td><input type='text' name='email' id='email'></input></td>";
						echo "</tr>";
					echo "</table>";
					
				echo "<div style='width:100%; margin-top:10px; float:left; margin-left:5px;'>";
					echo "<b>Have you worked with this person before?</b> &nbsp; ";
					echo "<select id='coworker'>";
						echo "<option value='N'>No</option>";
						echo "<option value='Y'>Yes</option>";
					echo "</select><br />";
					echo "&nbsp; <br />";
					echo "<b>Have you worked for ".$store_name."?</b> &nbsp; ";
					echo "<select id='employer'>";
						echo "<option value='N'>No</option>";
						echo "<option value='Y'>Yes</option>";
					echo "</select><br />";
				echo "</div>";
				
				echo "<div style='float:left; width:100%'>";
					echo "<div class='green_button' id='submit_summary' style='margin-right:10px; margin-top:10px; margin-bottom:10px; cursor:pointer;'>";
						echo "<img src='images/savegreen.png' style='width:25px;height:25px; vertical-align:middle'><span style='margin-left:15px; vertical-align:middle;'>Final Step</span>";
					echo "</div>";
				echo "</div>";		
				
				//echo "<div style='float:left;'><a href='#'>How do Bounties work?</a></div>";			
	
			echo "</div>";
			
			echo "<div style='width:100%; margin-top:0px; float:left; padding-left:10px; font-size:0.875em'>";		
				echo "If you recommend someone who applies via ServeBartendCook and is verified as hired, you are eligible for the bounty amount above.";
			echo "</div>";
				
		echo "</div>";
		
		
		echo "<div id='summary' style='float:left; width:100%; margin-left:3px; margin-right:3px; display:none;'>";
			echo "<h4>Review your recommendation details</h4>";
			echo "<div id='summary_holder' style='float:left; width:100%; margin-top:20px'></div>";
			
			echo "<div style='float:left; width:98%; margin-top:10px; margin-left:5px; margin-right:5px;'>";			
				echo "<h4 style='margin-bottom:5px;'>By clicking SUBMIT you agree that:</h4>";
				echo "<b>";
					echo "&#8226; You are recommending a person you know and give us permission to email them on your behalf.<br />";
					echo "&#8226; If this user applies for the position and accepts your recommendation, the above details will appear on her/his application.<br />";
					echo "&#8226; You will only be eligible for the bounty if the user applies for the position through SBC, accepts your recommendation and is verified as hired.<br />";
					echo "&#8226; Please review our <a href='main.php?page=bounty_faq'>Bounty FAQ</a> and <a href='index.php?page=TOS'>Terms of Service</a> for details.<br />";
					echo "&#8226; If you violate any of the <a href='index.php?page=TOS'>Terms of Service</a>, you will not be eligible for the bounty and your account may be suspended.<br />";
				echo "</b><br />";
				echo "&nbsp; <br />";
			
				//echo "<p>By clicking <b>SUBMIT</b> below, you agree to SBC's <a href='http://servebartendcook.com/index.php?page=TOS'>Terms of Use</a> and <a href='http://servebartendcook.com/index.php?page=privacy_policy'>Privacy Policy</a>, as it applies to job referrals.</p>";
				echo "<div class='green_button recommend' style='float:left; margin-right:10px; margin-bottom:10px'><img src='images/savegreen.png' style='width:25px;height:25px; vertical-align:middle'><span style='margin-left:15px; vertical-align:middle'>Submit</span></div>";					
				echo "<div style='display:inline-block; vertical-align:middle'><h4 style='color:#760006;'><a href='#' id='recommend_cancel'>Cancel</a></h4></div>";
			echo "</div>";
			
		echo "</div>";
		
		echo "<div id='self_warning' class='warning' style='width:100%; margin-top:10px; float:left; padding-left:10px; display:none;'>";
			echo "<h2 style='color:#760006'>Oops.  You cannot recommend yourself for a job.</h2>";
			echo "<div style='float:left; width:100%'><h5><a href='#' class='warning_cancel'>Recommend Someone Else</a></h4></div>";
	
			echo "<div style='float:left; width:100%; margin-top:15px;'><a href='main.php?page=bounty_faq'>How do Bounties work?</a></div>";			
		echo "</div>";
		
		
// 		html if this person has already been referred by this user for this job.
		echo "<div id='duplicate_warning' class='warning' style='width:100%; margin-top:10px; float:left; padding-left:10px; display:none;'>";
			echo "<h2 style='color:#760006'>You have already recommended this person for this job.</h2>";
			echo "<h4>You only need to recommend someone once.</h4>"; 
			echo "<div style='float:left; width:100%'><h5><a href='#' class='warning_cancel'>Recommend Someone Else</a></h4></div>";
	
			echo "<div style='float:left; width:100%; margin-top:15px;'><a href='main.php?page=bounty_faq'>How do Bounties work?</a></div>";			
		echo "</div>";
		
// 		html if account has been deactivated
		echo "<div id='deactivate_warning' class='warning' style='width:100%; margin-top:10px; float:left; padding-left:10px; display:none;'>";
			echo "<h2 style='color:#760006'>This candidate's account has been deactivated.</h2>";
			echo "<h4>Deactivated account cannot be recommended.</h4>"; 
			echo "<div style='float:left; width:100%'><h5><a href='#' class='warning_cancel'>Recommend Someone Else</a></h4></div>";
	
			echo "<div style='float:left; width:100%; margin-top:15px;'><a href='main.php?page=bounty_faq'>How do Bounties work?</a></div>";			
		echo "</div>";		
		
// 		html for employer warning.
		echo "<div id='employer_warning' class='warning' style='width:100%; margin-top:10px; float:left; padding-left:10px; display:none;'>";
			echo "<h2 style='color:#760006'>Oops.  The person you recommended on the site as an Employer, and not a job seeker.</h2>";
			echo "<h4>You can only recommend job-seekers.</h4>"; 
			echo "<div style='float:left; width:100%'><h5><a href='#' class='warning_cancel'>Recommend Someone Else</a></h4></div>";
	
			echo "<div style='float:left; width:100%; margin-top:15px;'><a href='main.php?page=bounty_faq'>How do Bounties work?</a></div>";			
		echo "</div>";
		
		
// 		html for confirm/sent page
		echo "<div id='member' style='width:100%; margin-top:10px; float:left; margin-left:3px; margin-right:3px; text-align:center; display:none;'>";
			echo "<img src='images/finalize_profile.png' style='height:80px; width:80px; vertical-align:center' alt='submitted referral'><h3>Recommendation submitted.</h3>";	
			echo "An email was sent to your candidate, letting them know of your recommendation.<br />";
			echo "<b>IMPORTANT:  The candidate you recommended needs to sign-up with the link in the email for recommendation to be valid. </b><br />";
			echo "&nbsp; <br />";
			echo "Please see your <a href='employee.php?page=recommendation_list'>Pending Bounties</a> for the status of your bounty.";
		
			echo "If your recommendation does not receive the email, you can have them sign-up using this link:<br />";
		echo "</div>";
		
		echo "<div id='non-member' style='width:100%; margin-top:10px; float:left; padding-left:10px; display:none;'>";
			echo "<img src='images/finalize_profile.png' style='height:100px; width:100px; vertical-align:center' alt='submitted referral'><h2>Referral submitted.</h2>";	
			echo "We sent an email to <span id='new_email'></span>.  <span id='name'></span> needs to sign-up with the link in the email for recommendation to be valid.  <br />";
/*
			echo "You can also send the recommendation link directly to your colleague: <span id='recommendation_link'></span><br />";
			echo "<i>IMPORTANT:  This link is meant for only the person you recommended, and can only be used once.  If you wish to recommend more people, please go back to <a href=''>Job Page</a> to recommend more.<i>";
*/
			echo "&nbsp; <br />";
			echo "Please see your <a href='employee.php?page=recommendation_list'>Pending Bounties</a> for the status of your bounty.";
		echo "</div>";
		
		
// 		html for employee learn more page		
/*
		echo "<div style='width:100%; margin-top:10px; float:left; padding-left:10px;'>";
		echo "<hr>";
		echo "<h1>Learn More about Bounty Jobs</h1>";
				
		echo "<table class='dark' style='width:100%;'>";
		echo "<tr valign='middle'>";
		echo "<th valign='middle;' style='background-color:#2e6652'><h4>What is a bounty?</h4></th>";
		echo "</tr>";			
		echo "</table>";
		echo "<div style='padding-top:15px; margin-left:10px; color:#2e6652'>A bounty is a professional reference, <b>with an actual benefit to you, the reference</b>. If you refer an SBC user to a job on the site, and they get the job, you will receive a bounty. Each bounty payment is different, depending on location and job type.<br><br>Even if you aren?t looking for a job, referring others to jobs with bounties is a way to make some extra money, so why not check out your SBC job list and help your friends find a new job?</div><br>";

		echo "<table class='dark' style='width:100%;'>";
		echo "<tr valign='middle'>";
		echo "<th valign='middle;' style='background-color:#2e6652'><h4>How do I refer a friend for a bounty job?</h4></th>";
		echo "</tr>";			
		echo "</table>";
		echo "<div style='padding-top:15px; margin-left:10px; color:#2e6652'>Log in to your ServeBartendCook account and view your job list. Jobs with bounties will be marked. When you view the job, you will have the option to Apply, Decline, or Refer the job. Choose the Refer option, and provide your friend?s name. If your friend is already an SBC user, your work is done. If not, simply provide their email address or phone number, and we will contact them to let them know that they?ve been referred to a job. They can register for the site and apply for the bounty job in minutes.</div><br>";
		
		echo "<table class='dark' style='width:100%;'>";
		echo "<tr valign='middle'>";
		echo "<th valign='middle;' style='background-color:#2e6652'><h4>How do I collect a bounty?</h4></th>";
		echo "</tr>";			
		echo "</table>";
		echo "<div style='padding-top:15px; margin-left:10px; color:#2e6652'>If an employee is hired because of your referral, SBC will confirm the hire with the employer. Once the hire is confirmed, you will receive an email, and your bounty will arrive within 30 days. You can always check your job list status to view the status of any bounty job referrals you have made. Bounty payments will be made in the form of Amazon Gift Card.</div><br>";
	
		echo "<table class='dark' style='width:100%;'>";
		echo "<tr valign='middle'>";
		echo "<th valign='middle;' style='background-color:#2e6652'><h4>What happens if I don?t get my bounty?</h4></th>";
		echo "</tr>";			
		echo "</table>";
		echo "<div style='padding-top:15px; margin-left:10px; color:#2e6652'>Only the first successful referral to any given job posting will receive a bounty, even if multiple employees are hired for the same position. So refer your friends quickly and often!</div><br>";

echo "<table class='dark' style='width:100%;'>";
		echo "<tr valign='middle'>";
		echo "<th valign='middle;' style='background-color:#2e6652'><h4>How do I get referred for a bounty job?</h4></th>";
		echo "</tr>";			
		echo "</table>";
		echo "<div style='padding-top:15px; margin-left:10px; color:#2e6652'>Ask your work friends (past and present) to join ServeBartendCook, and provide a reference for you for any bounty job you want. All they need to do is create a profile, and give us your name. We?ll do the rest.</div><br>";
		
		echo "<table class='dark' style='width:100%;'>";
		echo "<tr valign='middle'>";
		echo "<th valign='middle;' style='background-color:#2e6652'><h4>Why can I only collect $600 in bounties per year?</h4></th>";
		echo "</tr>";			
		echo "</table>";
		echo "<div style='padding-top:15px; margin-left:10px; color:#2e6652'>Answer here. Not sure how to best answer this one yet.</div><br>";
		
		echo "</div>";
*/
	echo "</div>";
}

function application_details_mobile($title, $store_name, $application_date, $message, $recommendation, $question_array, $answer_array) {
	$utilities = new Utilities;
	
	echo	"<table class='dark' style='width:100%; margin-top:-30px;'>";
		echo "<tr valign='middle'>";
			echo "<th valign='middle'>Application Summary</th>";
		echo "</tr>";			
	echo "</table>";
	
	echo "<div id='application_summary_holder' style='float:left; width:100%; margin-left:3px; margin-right:3px;'>";
		echo "<h3> ".$title." - ".$store_name."</h3>";  
		//echo "<h3 style='margin-bottom:10px; text-align:center'>".$store_name."</h3>";  
		echo "<b>This employer can view your current <a href='employee.php'>PROFILE</a> as well as all information listed below.</b>";
		
		echo "<div style='float:left; width:100%; margin-left:10px; margin-top:10px;'>";
			echo "<h4 style='margin-bottom:5px;'>&#8226; Application Date: &nbsp; ".date('m-d-Y', strtotime($application_date))."</h4>";
			
			recommender_details_html_mobile("Y", $recommendation)	;
		
			echo "<h4 style='margin-bottom:5px;'>&#8226; Personal Message</h4>";
			echo "<div style='float:left; width:100%; margin-left:15px; margin-bottom:10px;'>";
				if ($message != "") {
					echo "<i>".$message."</i>";
				} else {
					echo "You did not leave a personal message.";
				}
			echo "</div>";
		
			echo "<h4>&#8226; Question Responses</h4>";
			echo "<div style='float:left; width:100%; margin-left:15px; margin-bottom:10px;'>";

				if (count($question_array) > 0) {
					$count = 1;
					foreach ($question_array as $row) {
						echo $count.") ".$row['question']."<br />";
							if ($answer_array != "NA") {
								foreach($answer_array as $answer) {
									if ($row['questionID'] == $answer['questionID']) {
										echo "&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <b>Your Answer:</b>  ".$utilities->makeSafe_flat($answer['answer'])."<br />";								
									}
								}
							}
						echo "&nbsp; <br />";
						$count++;
					}					
				} else {
					echo "No Questions Added";			
				}
				
		echo "</div>";
		
	echo "<div class='green_button' id='hide_application' style='float:left;'>";
		echo " &nbsp; Back";
	echo "</div>";
		
		
	echo "</div>";
		
	echo "</div>";	
	
	if ($recommendation != "NA" && count($recommendation) > 0 && $recommendation != "") {
		echo "<div id='edit_recommendation_holder' style='display:none'>";
			choose_recommendation_html_mobile($recommendation, "change");
		echo "</div>";	
	}	
}

function recommender_details_html_mobile($employee_interest, $recommendation) {	

	if ($recommendation != "NA" && count($recommendation) > 0 && $recommendation != "") {
		if ($employee_interest == 'Y') {
			
			//user has already applied
			//if they haven't chosen a recommendation, give them the option to,  if the have chosen show details
			$selected_recommendation = array();
			$other_recommendations = array();
			foreach($recommendation as $row) {
				if ($row['recommend_status'] == "Accepted" || $row['recommend_status'] == "Hired" || $row['recommend_status'] == "Earned") {
					$selected_recommendation = $row;	
				} else {
					$other_recommendations[] = $row;
				}
			}
			
			if (count($selected_recommendation) > 0) {
				$total_recommendations = count($recommendation) - 1;
				//display recommendation details
				$recommendation_text = recommendation_text_html_mobile($selected_recommendation);

				echo "<div class='recommendation_summary_holder' data-recommendationID='".$row['ID']."' style='float:left; width:100%'>";
					echo "<h4 style='margin-bottom:5px;'>&#8226; Recommended By: &nbsp; ".$selected_recommendation['firstname']." ".$selected_recommendation['lastname']." &nbsp;";
					
					if ($selected_recommendation['recommend_status'] == "Accepted") {
						echo "<a href='#' id='edit_recommendation'> EDIT/REMOVE</a></h4>";
					} else {
						echo "</h4>";
					}
					
					echo "<h4 style='margin-bottom:0px;'>&#8226; Recommendation Text: </h4>";

					echo "<div style='float:left; width:90%; margin-left:15px; margin-bottom:10px; margin-top:5px;'>";
					echo "<i>".$selected_recommendation['firstname']." ".$selected_recommendation['lastname']." recommends this candidate for the position.<br />";
						echo $recommendation_text['relation_text'];
						echo $recommendation_text['experience_text'];
						echo $recommendation_text['current_text'];
					echo "</i></div><br />";
					
				echo "</div>";
				
				//removal confirmation page
/*
				echo "<div id='remove_holder' style='float:left; width:100%; padding-left:2.5%; padding-right:2.5%; padding-top: 10px; padding-bottom: 10px; display:none'>";
					echo "<h4>Are you sure you want to REMOVE the recommendation from ".$row['firstname']." ".$row['lastname']." from you application?</h4>";
					
					echo "<div style='width:100%; float:left; margin-top:10px; text-align:center;'>";
						echo "<div class='red_button confirm_remove' style='width:200px; cursor:pointer;' data-recommendation_id='".$row['ID']."' >";
							echo "<span style='margin-left:8px; vertical-align: middle; font-size:18px'>Confirm Removal</span>";
						echo "</div>";
					echo "</div>";

					echo "<br />";
					echo "&nbsp; <br />";

					echo "<a href='#' class='cancel_remove'><h4>Cancel</h4></a>";	
					
					echo "<b>NOTE: The user will no longer be eligible for the bounty above.</b>";					
				echo "</div>";
				
				echo "<div id='change_recommendation_holder' style='float:left; width:100%; padding-left:2.5%; padding-right:2.5%; padding-top: 10px; padding-bottom: 10px; display:none'>";
					if (count($other_recommendations) == 0) {
						echo "<h4>No one else has recommended you</h4>";
					} else {
						choose_recommendation_html($other_recommendations, "change");
					}	
				echo "</div>";
*/
			} else {
					echo "<h4 style='margin-bottom:5px;'>&#8226; Recommended By: &nbsp; None Added <a href='#' id='edit_recommendation'><br /> ADD</a></h4>";
					echo "<h4 style='margin-bottom:0px;'>&#8226; Recommendation Text: NA </h4>";
				
/*
				echo "<div id='change_recommendation_holder' style='float:left; width:100%; padding-left:2.5%; padding-right:2.5%; padding-top: 10px; padding-bottom: 10px; display:none'>";
					choose_recommendation_html($recommendation, "change");	
				echo "</div>";
				
				echo "<div class='recommendation_summary_holder' style='float:left; width:100%'>";
					echo "<div style='width:100%; float:left; margin-top:15px;'>";
						echo "<div class='green_button' id='change_recommendation' style='width:200px;'>";
							echo "<span style='margin-left:8px; vertical-align: middle; font-size:18px'>Add Recommendation</span>";
						echo "</div>";
					echo "</div>";
					
					echo "<div style='width:100%; float:left; margin-top:10px; '>";
						if (count($recommendation) == 1) {
							echo "You've been recommended by one person.";
						} else {
							echo "You've been recommended by ".count($recommendation)." people.";
						}
					echo "</div>";
				echo "</div>";
*/
					
			}
		} else {
			//has not applied, show recommendation options, selection is made on the application page for convienience.
			echo "<i>You will be able to select one recommendation to include on your application.  That person will be eligible for the bounty listed above if you are hired.</i>";
			foreach($recommendation as $row) {
				if ($row != "NA") {
					if ($row['experience']['hospitality'] > 0) {
						$experience_text = " who has <b>".$row['experience']['hospitality']." yrs of Hospitality Experience</b>.  ";
					} elseif ($recommendation['experience']['other'] > 0) {
						$experience_text = " who has ".$row['experience']['other']." yrs of general experience.  ";		
					} else {
						$experience_text = ".  ";
					}
		
					if (count($row['current']) > 0) {
						$current_text = "The job reference is currently employed at <b>";
						$count = 1;
						foreach ($row['current'] as $current) {
							if ($count > 1) {
								$current_text .= " and ";
							}
							$current_text .= $current['company']." as ".$current['position'];
							$count++;
						}
						$current_text .= "</b>.  ";
					} else {
						$current_text = "";
					}
					
					if ($row['coworker'] == 'Y' && $row['employer'] == 'Y') {
						$relation_text = "This job reference comes from a past employee of yours who has worked with this candidate";
					} elseif ($coworker == 'Y') {
						$relation_text = "This job reference comes from a coworker of the candidate";		
					} elseif ($employer == 'Y') {
						$relation_text = "This job reference comes from a past employee of yours";				
					} else {
						$relation_text = "This job reference comes from an SBC member";
					}

					echo "<div id='reference_notice' style='float:left; width:100%; margin-top:5px; padding-left:5px; padding-top:5px; padding-bottom:5px; margin-bottom:5px'>";
						echo "<a href='#' class='view_recommendation' data-recommendation_id='".$row['ID']."'><img src='images/postjob.png' height='50px' width='50px' alt='recommendation' style='vertical-align:middle;'></a> &nbsp; ";
						echo "<a href='#' class='view_recommendation' data-recommendation_id='".$row['ID']."''><h4 style='display:inline'>".$row['firstname']." ".$row['lastname']." has recommended you for this job!</h4></a><br />";
					echo "</div>";		
				
					echo "<div class='recommendation_summary_holder' data-recommendation_id='".$row['ID']."' style='float:left; width:95%; padding-left:2.5%; padding-right:2.5%; padding-top: 10px; padding-bottom: 10px; display:none'>";
						echo "<h4>If selected while applying, the following recommendation will appear on your application for this position:</h4>";
							echo "<div style='float:left; width:90%; margin-left:10px; margin-bottom:10px; margin-top:5px; color:#760006'><i><h4>".$row['firstname']." ".$row['lastname']." has provided a job reference for this candidate.</h4>";
								echo $relation_text;
								echo $experience_text;
								echo $current_text;
							echo "</i></div>";
					echo "</div>";					
				}
			}
		} 
		
		echo "<div id='recommendation_loader' style='float:left; width:100%; margin-top:35px; margin-bottom:20px; text-align:center; display:none;'>";
			echo "<h4>LOADING....</h4>";
		echo "</div>";			

	} else {		
		echo "<div id='reference_notice' style='float:left; width:100%; margin-top:5px; padding-left:5px; padding-top:5px; padding-bottom:5px; margin-bottom:5px'>";
			echo "<h4 style='margin-bottom:5px;'>&#8226; Recommended By: NA</h4>";
		echo "</div>";			
	}
	
}

function recommendation_text_html_mobile($details) {	
	//this turns the recommendation into narrative text
		if ($details['experience']['hospitality'] > 0) {
			$experience_text = " who has <b>".$details['experience']['hospitality']." yrs of Hospitality Experience</b>.  ";
		} elseif ($recommendation['experience']['other'] > 0) {
			$experience_text = " who has ".$details['experience']['other']." yrs of general experience.  ";		
		} else {
			$experience_text = ".  ";
		}
	
		if (count($details['current']) > 0) {
			$current_text = "The job reference is currently employed at <b>";
			$count = 1;
			foreach ($details['current'] as $current) {
				if ($count > 1) {
					$current_text .= " and ";
				}
				$current_text .= $current['company']." as ".$current['position'];
				$count++;
			}
			$current_text .= "</b>.  ";
		} else {
			$current_text = "";
		}
		
		if ($details['coworker'] == 'Y' && $details['employer'] == 'Y') {
			$relation_text = "This job reference comes from a past employee of yours who has worked with this candidate";
		} elseif ($coworker == 'Y') {
			$relation_text = "This job reference comes from a coworker of the candidate";		
		} elseif ($employer == 'Y') {
			$relation_text = "This job reference comes from a past employee of yours";				
		} else {
			$relation_text = "This job reference comes from an SBC member";
		}
		
		return array("experience_text" => $experience_text, "current_text" => $current_text, "relation_text" => $relation_text);
}

function choose_recommendation_html_mobile($recommendation, $type) {	

	//switch header based on situation
	switch($type) {
		case "application":
			echo	"<table class='dark' style='width:100%; margin-top:3px;'>";
				echo "<tr valign='middle'>";
					echo "<th valign='middle'>Choose Recommendation</th>";
				echo "</tr>";			
			echo "</table>";

			echo "<div style='float:left; width:100%; margin-left:10px; margin-bottom:10px;'>";
				echo "<h4 style='margin-bottom:0px'>Please select a recommendation to include on your application.</h4>The selected user will be eligible for the bounty if you are hired.<br />";
			echo "</div>";
			
		break;
		
		case "change":
			echo "<h4>Select a new Recommendation below</h4>";
		break;
	}

	
	switch($type) {
		case "application":
			echo "<div id='empty_recommendation' class='warning' style='float:left; width:100%; margin-left:10px; color:red; display:none;'><b>You must select one name or 'no recommendations' option.</b></div>";		
		break;

		case "change":
			echo "<div id='empty_recommendation' class='warning' style='float:left; width:100%; margin-left:10px; color:red; display:none;'><b>You must select one name or cancel below.</b></div>";		
		break;		
	}

	if ($recommendation != "NA" && count($recommendation) > 0 && $recommendation != "") {
		echo "<div style='margin-left:5px; margin-top:5px; float:left; width:100%;'>";

		foreach($recommendation as $key=>$row) {

			if ($row != "NA") {
				if ($row['experience']['hospitality'] > 0) {
					$experience_text = " who has ".$row['experience']['hospitality']." yrs of Hospitality Experience.  ";
				} elseif ($recommendation['experience']['other'] > 0) {
					$experience_text = " who has ".$row['experience']['other']." yrs of general experience.  ";		
				} else {
					$experience_text = ".  ";
				}
	
				if (count($row['current']) > 0) {
					$current_text = "The job reference is currently employed at ";
					$count = 1;
					foreach ($row['current'] as $current) {
						if ($count > 1) {
							$current_text .= " and ";
						}
						$current_text .= $current['company']." as ".$current['position'];
						$count++;
					}
					$current_text .= ".  ";
				} else {
					$current_text = "";
				}
				
					if ($row['coworker'] == 'Y' && $row['employer'] == 'Y') {
						$relation_text = "This job reference comes from a past employee of yours who has worked with this candidate";
					} elseif ($coworker == 'Y') {
						$relation_text = "This job reference comes from a coworker of the candidate";		
					} elseif ($employer == 'Y') {
						$relation_text = "This job reference comes from a past employee of yours";				
					} else {
						$relation_text = "This job reference comes from an SBC member";
					}
										
					$recommendation_text[$key]['firstname'] = $row['firstname'];
					$recommendation_text[$key]['lastname'] = $row['lastname'];					
					
					$recommendation_text[$key]['text'] = $relation_text;
					$recommendation_text[$key]['text'] .= $experience_text;
					$recommendation_text[$key]['text'] .= $current_text;

					echo "<div style='text-align:center;  cursor:pointer;' class='unselected_button recommend_button' data-s_status='unselected' data-recommend_id='".$row['ID']."' id='".$key."'> &#10004; ".$row['firstname']." ".$row['lastname']."</div>";								
				}
			}
			echo "</div>";

			echo "<div style='margin-left:10px; margin-top:10px; margin-bottom:10px; float:left; width:100%;'>";
				echo "<div style='width:250px; cursor:pointer;' class='unselected_button recommend_button' data-s_status='unselected' id='none'> &#10008; Do Not Include a Recommendation</div>";								
			echo "</div>";	
								
		} else {
			echo "<div style='margin-left:7%; margin-top:10px; margin-bottom:10px; float:left; width:100%;'>";
				echo "<i>No one has recommended you for this position.</i>";
				//echo "<div style=' width:40%;' class='unselected_button recommend_button' data-s_status='unselected' id='none'> &#10008; Do Not Include a Recommendation</div>";								
			echo "</div>";						
		}
		
		if (isset($recommendation_text)) {
			foreach($recommendation_text as $key=>$row) {
				echo "<div style='float:left; width:90%; margin-left:15px; margin-right:10px; margin-bottom:10px; display:none;' class='recommendation_selection_holder' id='holder_".$key."'>";

					echo "<h3 style='text-align:center'>Recommendation</h4>";
					//echo " &nbsp; The following recommendation will appear on your application for this position:";
					
					echo "<div style='float:left; width:95%; margin-right:0px; margin-bottom:10px; padding-left:5px; padding-top:5px; padding-bottom:5px;  border-style:solid; border-color:#760006; border-width:3px; margin-top:0px; border-radius:20px; margin-bottom:10px'>";
						echo "<div style='float:left; width:90%; margin-left:15px; margin-right:5px; margin-bottom:10px;  color:#760006'><b>".$row['firstname']." ".$row['lastname']." has provided a recommendation for this candidate.</b><br />";
								echo $row['text'];
						echo "</div>";
					echo "</div>";
				echo "</div>";
			}
			
			echo "<div style='float:left; width:90%; margin-left:15px; margin-right:10px; margin-bottom:10px; display:none;' class='recommendation_selection_holder' id='holder_none'>";
				echo "<h3 style='text-align:center'>Recommendation</h4>";
					
				echo "<div style='float:left; width:95%; margin-right:0px; margin-bottom:10px; padding-left:5px; padding-top:5px; margin-bottom:10px'>";
					echo "No recommendations will appear on your application.<br /> None of the users above will be eligible for the bounty if you are hired.";
				echo "</div>";
			echo "</div>";
			
			if ($type == "change") {
				echo "<div id='confirm_change_holder' style='float:left; width:100%; margin-left:10px; display:none'>";
					echo "<div style='float:left; width:100%;'>";
						echo "<h4>Are you sure you want to replace your recommendation?</h4>";
						
						echo "<div style='width:100%; float:left; margin-top:10px;'>";
							echo "<div class='red_button confirm_change' style='width:200px; cursor:pointer; margin-right:20px;' >";
								echo "<span style='margin-left:8px; vertical-align: middle; font-size:18px'>Confirm Change</span>";
							echo "</div>";
							//echo "<a href='#' id='cancel_change'><h4 style>Cancel</h4></a>";

						echo "</div>";
						
						echo "NOTE:  The new recommendation will be eligible for the bounty, the old recommendation will no longer be eligible.<br />";
					echo "</div><br />";
				echo "</div>";	
				
				echo "<div style='width:100%; float:left; margin-top:10px; margin-left:20px;'>";			
					echo "<a href='#' id='cancel_edit_recommendation'><h4 style>Cancel</h4></a>";
				echo "</div>";
			}
		}
}

function opportunity_potential_bounty_html_mobile($recommendation_details, $opportunity_data) {

		$job_data						= $opportunity_data['job_data'];

		$post_type					= $job_data['general']['post_type'];
		$bounty						= $job_data['general']['bounty'];

		$store_name					= $job_data['store']['name'];
		$title		 						= $job_data['general']['title'];
		
		switch ($recommendation_details['recommend_status']) {
			case "email_sent":
				$status = "Email Sent";
				if (isset($recommendation_details['recommendedID']) && $recommendation_details['recommendedID'] > 0) {				
					$status_text = "An email was sent to ".$recommendation_details['firstname']." ".$recommendation_details['lastname']." at ".$recommendation_details['email']." containing a link to signup and accept your recommendation.";
					$status_text .= "Here is the  link:<br />";
					$status_text .= "This link is only usable for one user, please only give that link to the above candidate.  Multiple uses will invalidate the link.";					
					$status_text .= "You will receive a bounty payment if your recommended candidate applies for the listed job through ServeBartendCook and ServeBartendCook verifies your recommended was hired for the listed position.<br />";
				} else {
					$status_text = "An email was sent to ".$recommendation_details['firstname']." ".$recommendation_details['lastname']." letting the candidate know of your recommendation";
					$status_text .= "You will receive a bounty payment if your recommended candidate applies for the listed job through ServeBartendCook and ServeBartendCook verifies your recommended was hired for the listed position.<br />";				
				}
			break;
			
			case "email_bounced":
				$status = "<font color='red'>Email Bounced</font>";
				$status_text = "The email sent to ".$recommendation_details['firstname']." ".$recommendation_details['lastname']." at ".$recommendation_details['email']." bounced.";
				$status_text .= "You can either send another recommendation to a different email, or give ".$recommendation_details['firstname']." ".$recommendation_details['lastname']." this link:<br />";
				$status_text .= "This link is only usable for one user, please only give that link to the above candidate.  Multiple uses will invalidate the link.";
				$status_text .= "You will receive a bounty payment if your recommended candidate applies for the listed job through ServeBartendCook and ServeBartendCook verifies your recommended was hired for the listed position.<br />";
			break;
			
			case "viewed":
				$status = "Job Viewed";
				$status_text = $recommendation_details['firstname']." ".$recommendation_details['lastname']." has viewed your recommendation.";
				$status_text .= "You will receive a bounty payment if your recommended candidate applies for the listed job through ServeBartendCook and ServeBartendCook verifies your recommended was hired for the listed position.<br />";
			break;
			
			case "hired":
				$status = "HIRED!!!";
				$status_text = $recommendation_details['firstname']." ".$recommendation_details['lastname']." has been hired for the position!";
				$status_text .= "You should have received an email regarding your bounty, please click here if you have not received it.<br />";
			break;
			
			case "collected":
				$status = "BOUNTY COLLECTED!";
				$status_text = $recommendation_details['firstname']." ".$recommendation_details['lastname']." has been hired for the position!  You have collected your bounty, congratulations!";
			break;			

			case "closed":
				$status = "Job FIlled";
				$status_text = $recommendation_details['firstname']." ".$recommendation_details['lastname']." not been hired for this position.";
				$status_text .= "This bounty is no longer available.<br />";
			break;

			case "rejected":
				$status = "<font color='red'>Rejected</font>";
				$status_text = $recommendation_details['firstname']." ".$recommendation_details['lastname']." has rejected your recommendation.";
				$status_text .= "You will not receive a bounty if the candidate is hired.  You may recommend another person for this job.<br />";

			break;

			case "rescinded":
				$status = "Removed";
				$status_text = "You removed your recommendation for ".$recommendation_details['firstname']." ".$recommendation_details['lastname'].".";
				$status_text .= "You will not receive a bounty if the candidate is hired.  You may recommend another person for this job.<br />";
			break;					
		}


		echo "<img src='images/bounty.png' style='height:60px; width:60px; position:absolute; left:30px; top:12px'>";
		echo	"<table class='dark' style='width:100%; margin-bottom:10px;'>";
			echo "<tr valign='middle'>";
			echo "<th valign='middle' style='background-color:#2e6652'><h4 style='margin-left:50px'>POTENTIAL BOUNTY</h4></th>";
			echo "</tr>";			
		echo "</table>";
	
	
	echo "<div id='recommendation_holder' style='float:left; width:100%; margin-left:10px;'>";
		echo "<h2>".$title."</h2>";
		echo "<h4>".$store_name."</h4>";
	
		echo "<div style='float:left; width:100%; margin-left:10px;'>";
			echo "<h4>You recommended <b>".$recommendation_details['firstname']." ".$recommendation_details['lastname']." on ".date('m-d-Y', strtotime($recommendation_details['date']))."</b> for this position.</h4>";
			echo "<b>Potential Bounty:</b> $".$bounty."<br />";
			echo "<b>Status:</b> ".$status."<br />";
			echo "&nbsp; <br />";			
			echo $status_text;
			echo "&nbsp; <br />";
		echo "</div>";
		
		if ($recommendation_details['recommend_status'] == "email_sent" || $recommendation_details['recommend_status'] == "email_bounced" || $recommendation_details['recommend_status'] == "viewed") {
			
			echo "This is how your recommendation will appear to the employer if ".$recommendation_details['firstname']." ".$recommendation_details['lastname']." applies for this positions:";
			
			recommender_details_html_mobile($recommendation_details);
			
			echo "<div style='float:left; padding-right:20px; padding-left:20px; padding-top:8px; padding-bottom:8px; background-color:#760006; margin-bottom:10px; margin-right: 10px; border-radius:5px'><a href='#' class='show_remove' style='color:#ffffff'>Remove Recommendation for ".$recommendation_details['firstname']." ".$recommendation_details['lastname']."</a></div>";
		}
	echo "</div>";
	
	echo "<div id='remove_holder' style='display:none; float:left; width:100%;'>";
		echo "<h3 style='text-align:center'>Would you like to remove your recommendation for ".$recommendation_details['firstname']." ".$recommendation_details['lastname']."?</h3>";
		echo "<br /><b>If you remove your recommendation, you will no longer be eligible to receive the bounty if ".$recommendation_details['firstname']." ".$recommendation_details['lastname']." is hired, but you may recommend new candidate.<br /";
		
		echo "<div style='float:left; width:100%; text-align:center'>";
			echo "<div style='float:left; padding-right:20px; padding-left:20px; padding-top:8px; padding-bottom:8px; background-color:#760006; margin-bottom:10px; margin-right: 10px; border-radius:5px'><a href='#' class='save_remove' style='color:#ffffff'>REMOVE</a></div><br /><br />";
			echo "<a href='#' class='cancel_remove'>Cancel</a>";
		echo "</div>";
	echo "</div>";
}

function opportunity_employee_unqualified_mobile($opportunity_data) {								
		
		$job_data						= $opportunity_data['job_data'];
		$unqualified_reasons			= $opportunity_data['job_status']['unqualified_reasons'];

		$jobID							= $job_data['general']['jobID'];

		$employer 						= $job_data['employer'];
		$title		 						= $job_data['general']['title'];
		$requirements		 			= $job_data['requirements'];
		$notes							= $job_data['general']['description'];
		$qualifications					= $$job_data['general']['qualifications'];
		$main_skill		 				= $job_data['skills']['main_skill']['specialty'];
		$specialtyID			 		= $job_data['skills']['main_skill']['ID'];
		$benefits						= $job_data['general']['benefits'];
		$benefits_desc				= $job_data['general']['benefits_desc'];
		$schedule						= $job_data['general']['schedule'];
		$comp_type					= $job_data['general']['comp_type'];
		$comp_value					= $job_data['general']['comp_value'];
		$sub_skills						= $job_data['skills']['sub_skills'];
		$date_created					= $job_data['general']['date_created'];
		$store_type					= $job_data['store']['description'];


		switch($comp_type) {
			default:
				$compensation = $comp_type;
			break;
			
			case "Hourly":
				$compensation = "$".$comp_value."/hr";
			break;
			
			case "Salary":
				$compensation = "Salary:  $".$comp_value;
			break;				
		}		

		if ($benefits == "Y") {
			$benefits_text =	"<i>".$benefits_desc."</i><br />";
		} else {
			$benefits_text = 	"None<br />";				
		}
		
		switch($main_skill) {
			case "Bartender":
				$main_skill_image = "<img src='images/main-bar.png' height='100px'>";
			break;
			
			case "Manager":
				$main_skill_image = "<img src='images/main-manager.png' height='100px'>";
			break;
			
			case "Kitchen":
				$main_skill_image = "<img src='images/main-cook.png' height='100px'>";
			break;
			
			case "Server":
				$main_skill_image = "<img src='images/main-server.png' height='100px'>";
			break;
									
			case "Bus":
				$main_skill_image = "<img src='images/main-bus.png' height='100px'>";
			break;

			case "Host":
				$main_skill_image = "<img src='images/main-host.png' height='100px'>";
			break;						
		}				
		
		
		if ($notes == "" && $qualifications == "") {
			$notes_text = "";
		} else {
			$notes_text = $notes." <br />".$qualifications;
		}
		
		$website_text = "";
		if ($website == "") {
			$website_text = "No Website";
		} else {
			$website_text = "<a href='http://".$website."'>Website</a>";
		}

		if ($facebook == "") {
			$facebook_text = "";
		} else {
			$facebook_text = " | <a href='http://".$facebook."'>Facebook</a>";
		}
		
		if ($twitter == "") {
			$twitter_text = "";
		} else {
			$twitter_text = " | <a href='http://".$twitter."'>Twitter</a>";
		}												
?>		
		<div class='job_details' style='float:left; width:100%; margin-top:10px;;'>

		<h4 style="color:red; margin-left:3px;">Your profile is missing qualifications for this job.</h4>
		
		<div style="float:left; margin-left:2px; margin-right:2px; width:89%; background-color:#E7E7DD; " class='bubble_inside' >
			<b>MISSING QUALIFICATIONS</b><br />
			&nbsp; <br />
			<font color='red'>
<?php

			if ($unqualified_reasons['distance_flag'] == "Y") {
				echo "&nbsp; <b>-This job is located outside of your region.</b><br />";
				echo "&nbsp; &nbsp; <i>If you are relocating to a new area, please use that zip code on your profile to search for jobs.</i><br />";				
				echo "&nbsp; <br />";
			} 

			if ($unqualified_reasons['skill_flag'] == "Y") {
				echo "&nbsp; <b>-Your profile does not contain any ".$main_skill." skills.</b><br />";
				echo "&nbsp; <br />";
			} elseif ($unqualified_reasons['skill_flag'] == "Not Seeking") {
				echo "&nbsp; <b>-".$main_skill." matches are TURNED OFF on your profile.</b><br />";
				echo "&nbsp; <b><a href='employee.php?page=profile_menu'>Edit Profile</a> to turn matched on and apply.</b><br />";				
			}
			
/*
			if ($unqualified_reasons['required_skills'] != "N") {
				echo "&nbsp; <b>-This job requires the following ".$main_skill." skill: <br />";
				foreach($unqualified_reasons['required_skills'] as $row) {
					echo "&nbsp; &nbsp; <i>".$row['sub_specialty']."</i><br />";
				}
				echo "&nbsp; <br />";
			} 			
*/
?>
			</font>
			&nbsp; <br />
		<i>In order to respond to this job, or view the employer details, your profile must meet the qualifications.</i><br />			
		</div>
<?php
			echo	"<table class='dark' style='width:100%;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle'>General Details</th>";
				echo "</tr>";			
			echo "</table>";
			
			echo "<div id='title_holder' style='width:100%; text-align:center; margin-top:10px; float:left; font-size:1.125em'>";
				echo "<h4>".$title."</h4>";
			echo "</div>";
	
			echo "<div style='float:left; width:100%; margin-left:5px; margin-right:3px;'>";
		
					echo "<div id='date_holder' style='width:100%; margin-top:10px; float:left; font-size:1.125em'>";
						echo "<div style='float:left; width:140px;'>&#9679; <b>Date Posted:</b> </div>";
						echo "<div id='date' style='float:left; padding-left:10px;'>".date('m-d-Y', strtotime($date_created))."</div>";
					echo "</div><br />";	
									
					echo "<div id='schedule_holder' style='width:100%; margin-top:10px; float:left; font-size:1.125em'>";		
						echo "<div style='float:left; width:150px;'>&#9679; <b>Schedule:</b></div>";
						echo "<span id='schedule_current' >".$schedule."</span>";
					echo "</div>";	
					
					echo "<div id='compensation_holder' style='width:100%; margin-top:10px; float:left; font-size:1.125em'>";					
						echo "<div style='float:left; width:150px;'>&#9679; <b>Compensation:</b></div>";
						echo "<span id='compensation_current'>".$compensation."</span>";
					echo "</div>";	
								
					echo "<div id='benefits_holder' style='width:100%; margin-top:10px; margin-bottom:10px; float:left; font-size:1.125em'>";					
						echo "<div style='float:left; width:150px;'>&#9679;  <b>Benefits:</b></div>";
						echo  "<span id='benefits_current'>".$benefits_text."</span>";
					echo "</div>";	

					echo "<div id='store_holder' style='width:100%; margin-top:10px; text-align:center; float:left; font-size:1.125em'>";
						echo "<b><i>".$store_name." <br /> Job posted by: ".$employer['position']."</i></b>";    
					echo "</div>";	
					
					echo "<div id='type_holder' style='width:100%; margin-left:5px; margin-top:10px; margin-bottom:0px; float:left; font-size:1.125em'>";					
						echo  "<span id='store_type'>&#9679;  <b>Type:</b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ".$store_type."</span>";
					echo "</div>";	
					
					echo "<div id='type_holder' style='width:100%; margin-left:5px; margin-top:10px; margin-bottom:10px; float:left; font-size:1.125em'>";					
						echo  "<span id='store_type'>&#9679;  <b>Location: </b>&nbsp; &nbsp;<a href='https://www.google.com/maps/place/".$address." ".$zip."'>Map</a></span>";
					echo "</div>";						

					echo "<div id='type_holder' style='width:100%; margin-bottom:10px; margin-top:5px; text-align:center; float:left; font-size:1.125em'>";					
						echo  "<span id='store_type'> &nbsp; ".$website_text.$facebook_text.$twitter_text."</span>";
					echo "</div>";	

			echo "</div>";

			echo	"<table class='dark' style='width:100%;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle'>PREFERRED JOB SKILLS</th>";
				echo "</tr>";			
			echo "</table>";
			
			echo "<div id='skill_holder' style='width:100%; float:left; margin-bottom:10px;'>";
				echo "<div style='width:110px; float:left; text-align:center;'>";
					echo $main_skill_image."<br />";
				echo "</div>";																							
		
				echo "<div style='float:left;'>";
					if (count($sub_skills) == 0) {
						echo "&nbsp; <br /><i>No Specific Skills Required</i>";
					} else {							
						//table for display
						echo "<table id='skill_display' CELLSPACING=6 cellpadding=6 style='color:red'>";
						$row_count = 2;
						foreach ($sub_skills as $row) {
								if ($row_count % 2 == 0) {		
									echo "<tr>";	
									echo "<td><b> &#x2713; ".$row['sub_specialty']."</b></td>";
								} else {
									echo "<td><b> &#x2713; ".$row['sub_specialty']."</b></td>";								
									echo "</tr>";
								}
								$row_count++;
						}
						if ($row_count % 2 == 0) {	
							echo "</tr>";
						}															
						echo "</table>";	
					}			
				echo "</div>";
			echo "</div>";
						
			echo	"<table class='dark' style='width:100%; margin-bottom:5px;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle'>ADDITIONAL REQUIREMENTS</th>";
				echo "</tr>";			
			echo "</table>";

			echo "<div id='requirements_holder' style='float:left; margin-left:5px; margin-bottom:10px; font-size:1.125em'>"	;	
				if (count($requirements) > 0) {
					foreach ($requirements as $row) {
						echo "<img src='images/icon-locations.png' style='vertical-align:middle;' width=30px;></b>".$row['requirement']."<br />";
					}				
				} else {
					echo "<i>No Requirements Listed</i>";
				}					
			echo "</div>";
			
			if ($notes_text != "") {
				echo	"<table class='dark' style='margin-bottom:5px; width:100%;'>";
					echo "<tr valign='middle'>";
					echo "<th valign='middle'>OTHER INFORMATION</th>";
					echo "</tr>";			
				echo "</table>";
	
				echo "<div id='notes_holder' style='float:left; margin-left:5px; margin-bottom:10px; font-size:1.125em'>";
					echo "<div id='notes_current' style='float:left; padding-left:10px;'><i>".$notes_text."</i></div>";
				echo "</div><br />";
			}			

			echo	"<table class='dark' style='width:100%; margin-bottom:10px;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle'></th>";
				echo "</tr>";			
			echo "</table>";
			
			echo "<a href='#' class='inappropriate'>Report Inappropriate Content</a>";					
	echo "</div>";	
}

function opportunity_application_sent_mobile() {
?>	
	<div class='job_details' style='float:left; width:100%; '>
	
	<div style='float:left: width:100%; text-align:center'>
		<h1 style='text-align:center'>Application Sent</h1>
		<h3>Good Luck!</h3>
	</div>	
	
	<div style='float:left: width:99%; margin-left:5px; margin-right:5px;'>
		<b>The employer that posted this job has been notified of your interest.</b><br />
		<i>Submitting a request does not guarantee an interview.  Interviews are at the sole discretion of the employer.<br />  Interested employers will contact you directly using the contact information included on your profile.</i>
	</div>
		
<!--
		<div style='float:left; width:86px; position:relative; left:5px; top:55px'><img src='images/productgold.png' height='86px' alt='goldbadge'></div>
		<div class='employee_profile_header' style='padding-left:85px; margin-left:14px;'>We need your expert opinion!</div> 
		
		<div style='float:left; text-align:center; width:100%; margin-top:10px; margin-bottom:10px;'>
			<h4>Based on your hospitality experience, we'd appreciate your opinion.</h4>

			<a href='products.php'><div class='btn btn-large btn-primary' id='go_products' style='float:left; width:85%; text-align:center; margin-left:7%; background-color:#28543f'>SHOW ME</div></a> 
		</div>
		
		<div style='float:left; text-align:center; width:100%; margin-top:15px;'><a href='opportunity_list.php'>BACK TO JOB LIST</a></div>			
-->

		</div>
	</div>
<?php
}

function opportunity_html_expired_mobile() {					
?>	
		<h1>Expired Listing</h1>
		
		<table class="dark">
			<tr><td>This Job Listing has expired and is no longer available</td></tr>
		</table>					
<?php		
}

function opportunity_incomplete_profile_mobile() {
	echo "<h4>You must complete your <a href='employee.php?page=profile_menu'>PROFILE</a> before you can view jobs</h4>";  
	echo "<b>We match you with jobs based on your profile</b>";
}


function opportunity_html_removed_mobile() {					
?>	
		<h1>Job Removed</h1>
		
		<table class="dark">
			<tr><td>This Job Listing has been removed from the site.</td></tr>
		</table>					
<?php		
}

function opportunity_unverified_email_mobile() {					
?>	
		<h3 style='text-align:center'>Oops!  You haven't verified your email address yet</h1>
		
		<table class="dark">
			<tr><td align='center'>We need to make sure you are not a robot before we can let you apply for jobs.</td></tr>
			<tr><td align='center'><a href='main.php?page=verify_email'><b>Click here to resend the verification email</b></a></td></tr>
		</table>					
<?php		
}

function application_review($profile_icon, $quote_icon, $trait_icon, $employment_count, $sub_skill_count, $employment_skill_count, $education_count, $certification_count, $total_experience) {
	
	echo "<div id='review_holder' style='float:left; width:100%; margin-top:10px;'>";
		echo "<h3 style='text-align:center'>Application Summary</h3>";
		echo "<table class='dark'>";
			echo "<tr>";
				echo "<td width='60%'>Profile Photo</td>";
				echo "<td>".$profile_icon."</td>";
			echo "</tr>";
			
			echo "<tr>";
				echo "<td width='60%'>Personal Quote</td>";
				echo "<td>".$quote_icon."</td>";
			echo "</tr>";

			echo "<tr>";
				echo "<td width='60%'>Personality Traits</td>";
				echo "<td>".$trait_icon."</td>";
			echo "</tr>";

			echo "<tr>";
				echo "<td width='60%'>Past Employment</td>";
				echo "<td>".$employment_count."</td>";
			echo "</tr>";

			echo "<tr>";
				echo "<td width='60%'>Skills</td>";
				echo "<td>".$sub_skill_count."</td>";
			echo "</tr>";

			echo "<tr>";
				echo "<td width='60%'>Experience</td>";
				echo "<td>";
					echo "Hospitality: ".$total_experience['hospitality']." yrs";
					if ($total_experience['other'] > 0) {
						echo "<br />Other: ".$total_experience['other']." yrs";
					}
					if ($total_experience['unknown'] > 0) {
						echo "<br />Unknown: ".$total_experience['unknown']." yrs";
					}				
				echo "</td>";
			echo "</tr>";			
		echo "</table>";
		
		echo "<div style='width:100%; float:left; text-align:center; margin-top:15px; margin-bottom:10px;'>";
			echo "<a href='employee.php' class='btn btn-primary'>View/Edit Profile</a><br />";		
		echo "</div>";
						
	echo "</div>";
}
?>