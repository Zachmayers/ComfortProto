<?php

function profile_html_employee_splash_mobile($member_data, $email_verification, $opportunity_data) {
		if ($email_verification == "N") {
			$verification_note = "<h4 style='margin-bottom:8px;'><font color='red'>NOTICE:</font>  <a href='main.php?page=verify_email'>You need to verify your email address before responding to jobs.</a></h4>";
		} else {
			$verification_note = "";
		}	

		echo "<div id='splash_box' style='float:left; width:99%;'>";		
			echo"<div style=' float:left; width:100%; padding-right:3.5%; padding-left:3.5%'>";
				//echo "<div style='float:left; width:100%;'>";
			
				echo "<h2 style='margin-top:12px; color:black;'>WELCOME</h2>";
				if ($opportunity_data == "NA") {

					echo "<h3 style='margin-bottom:0px; margin-top:10px; color:black;'>Are you ready to find a new job?</h4>";
					//echo "<h4 style='color:black;'>Or make money recommending a friend for a job?</h4>";
				
					echo "<div id='welcome_text' style='float:left; margin-right:3.5%; width:95%; color:black; margin-bottom:20px;'>";
						echo "All you need to do is create a profile and you will be matched to jobs in your area!<br />";
						echo "&#9679; You can use your profile to apply for multiple jobs in only a few clicks!<br />";
						//echo "&#9679; Or recommend friends for jobs and earn real money!</b><br>";
					echo "</div>";
	
				} else {
					//this person has come from a public job post, acknowledge this
					$job_title = $opportunity_data['job_data']['general']['title'];
					$store = $opportunity_data['job_data']['store']['name'];

					echo "<h3 style='margin-bottom:10px; margin-top:10px; color:black;'>Are you ready to find a new job?</h3>";
				
					echo "<div id='welcome_text' style='float:left; margin-right:3.5%; width:95%; color:black; margin-bottom:10px;'>";
						echo "All you need to do is create a quick profile and you will be able to apply to the job:<br>";
						echo "<h5 style='text-align:center; margin-top:10px; margin-bottom:10px'>".$job_title. " - ".$store."</h5>";
						echo "You can use your profile to apply for any other open jobs too!<br>";
						echo "Or recommend friends for jobs and earn real money!</b><br>";						
					echo "</div>";

				}
				
				echo "<div style='width:3%; float:left'><a href='employee.php?page=profile_menu'>";
				echo "<img src='images/redarrow.png' alt='lets_get_started' style='position: relative; bottom:8px; height:94px'></div>";
				echo "<div class='unselected_job_areas' style='margin-top:8px;'><span style='color:white; font-size:22px; margin-left:5%'>Let's get started!</span><br><span style='width:80%; margin-left:5%; color:#e9e6de; font-size: 14px;'>Begin making your profile now.</span></a></div>";
			
				echo "<div style='float:left; width:95%; margin-left:-3.5%;'>";
				echo "<p style='float:left; margin-bottom:10px; margin-top:20px; color:6c6367;'>Are you an Employer here to post jobs?<br><a href='employee.php?page=switch_account'>SWITCH ACCOUNT TYPE</a><br><br></p></div>";
			echo "</div>";


			echo "<div style='float:left; width:95%; background-color:#e9e6de; padding-left: 3.5%; padding-right:3.5%; padding-top:3.5%, padding-bottom:-3.5%;'>";
			echo $verification_note;
}

function profile_employee_menu_mobile($email_verification, $completion_percent, $profile_status, $experience_complete, $education_complete, $personal_complete, $broad_skill_array) {
	
	if ($profile_status != "complete") {
		$title = "Create Your Profile";
		$title_note .= "Your profile matches you to open jobs and allows you to apply to several jobs at different companies in only a few clicks.<br /><br><div style='width:100%; float:left'><b>Scroll down to Finalize Profile and apply to jobs.</b></div>";
		if ($experience_complete == "<i>Incomplete</i>") {
			$experience_complete = "START HERE!";
			$view_profile = "";
		}
		
		if ($education_complete == "<i>Incomplete</i>") {
			$education_complete = "ADD THIS NEXT!";
		}
		
		if ($personal_complete == "<i>Incomplete</i>") {
			$personal_complete = "FINISH LAST - IT'S THE BEST PART!";
		}
	} else {
		$title = "Edit Your Profile";
		$title_note = "";
	}

?>
	<div id='menu_buttons' style='float:right; width:100%; margin-bottom:5px; text-align:center;'>
		<a href='employee.php'><div style='width:100%; float:left; background-color:#DBDCCE; min-height:30px; margin-right:1px;'><h4 style='margin-bottom:10px; margin-top:10px; color:#5D0000'>View Profile</h4></div></a>
	</div>
	
	<?php breadcrumb("1", "", "", "", "") ?>	
	

	<div class='main_box' style=' float:left; width:100%; padding-right:3.5%; padding-left:3.5%'>

		<div style='float:left; width:100%;'>
			
		<h2 style='margin-bottom:10px; margin-top:10px; color:black'><? echo $title ?></h2>	
		
		<div style='float:left; width:100%;'>
			<div style='float:left; width:95%; margin-bottom:15px; margin-right:3.5%'>
				<? echo $title_note; ?><br />
			</div>
		</div>
			
		<div class='warning' id='skill_warning' style='width:95%; color:red; display:none; margin-bottom:20px; margin-right:3.5%'>
			You must complete at least the Skills & Experience section to view and respond to job openings.
		</div>
			
		<div id='experience_button' style='width:100%; float:left;'>
				<div style='width:3%; float:left'><img src="images/experienceskills.png" alt="step_one" style="position: relative; bottom: 8px; height:80px"></div>
				<div id='experience_main_button' class='unselected_job_areas'>Experience & Skills<br>
					<span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'><? echo $experience_complete ?></span>
				</div>
		</div>

		<div id='education_button' style='width:100%; float:left;'>
				<div style='width:3%; float:left'><img src="images/educationawards.png" alt="step_two" style="position: relative; bottom: 8px; height:80px"></div>
				<div id='experience_main_button' class='unselected_job_areas'>Education & Awards<br>
					<span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'><? echo $education_complete ?></span>
				</div>
		</div>

		<div id='personal_button' style='width:100%; float:left;'>
				<div style='width:3%; float:left'><img src="images/photopersonal.png" alt="step_three" style="position: relative; bottom: 8px; height:80px"></div>
				<div id='personal_main_button' class='unselected_job_areas'>Photo & Personal Info<br>
					<span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'><? echo $personal_complete ?></span>
				</div>
		</div>
		
<?php
			if (count($broad_skill_array) > 0) {
				$off_count = 0;
				$on_count = 0;

				echo "<div style='width:95%; float:left; '>";
				echo "<h4 style='margin-bottom:0px;'>You are being matched to these job types:</h4>";
				echo "&nbsp; &nbsp; <i>Click to toggle matches on and off.</i><br />";
					echo "<div style='margin-left:7%; margin-top:5px; float:left; width:100%;'>";
						foreach($broad_skill_array as $row) {
							if ($row['skill'] != "Other") {
								if ($row['seeking'] == 'Y') {
									$class = "selected_job_titles";
									$status = "selected";
									$seeking_text = "ON";
									echo "<div class='".$class." job_titles_button' data-s_status='".$status."' data-skill_id='".$row['skillID']."'>".$row['skill']." - ".$seeking_text."</div>";								
									$on_count++;
								} else {
									$off_count++;
								}
							}
						}
						
						if ($on_count == 0) {
							echo "<br />&nbsp; &nbsp; &nbsp; &nbsp; <b>You have all job matches turned off.</b><br /> &nbsp; <br />";
						}
						
					echo "</div>";
					
					
					if ($off_count > 0) {
						echo "<h4 style='margin-bottom:0px;'>You have these matches turned off:</h4>";
							echo "<div style='margin-left:7%; margin-top:5px; float:left; width:100%;'>";
								foreach($broad_skill_array as $row) {
									if ($row['skill'] != "Other") {
										if ($row['seeking'] == 'N') {
											$class = "unselected_job_titles";					
											$status = "unselected";
											$seeking_text = "OFF";
											echo "<div class='".$class." job_titles_button' data-s_status='".$status."' data-skill_id='".$row['skillID']."'>".$row['skill']." - ".$seeking_text."</div>";
										} 
									}
								}
							echo "</div>";
						}
					
					echo "Note:  Add more 'Experience & Skills' above to open up more options";
				echo "</div>";
			}

	if ($profile_status != "complete") {
		if ($experience_complete == "<i>Incomplete</i>" || $experience_complete == "START HERE!") {
?>
<!--
			<div style='width:100%; float:left; text-align:center; margin-bottom:5px; margin-top:10px;'>						
				<div class='green_button' id='incomplete_final' style='width:92%; text-align:center; background-color:gray;'>
					 <span style="margin-left:10px;">FINALIZE PROFILE & FIND JOBS!</span>
				</div>
				<div class='error' id='incomplete_profile' style='width:93%; margin-right:3.5%; float:left; color:red;'><b>You Must add at least one entry to 'Experience & Skills' to finalize your profile and be matched to jobs.</b></div>
				
			</div>
-->
			
		<div id='incomplete_final' style='width:100%; float:left; margin-top:15px;'>
			<div style='width:3%; float:left'><img src="images/finalize_incomplete.png" alt="finalize_profile" style="position: relative; bottom: 10px; height:80px"></div>
			<div id='personal_main_button' class='unselected_job_areas' style='background-color:#848383'>Finalize Profile<br>
				<span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>COMPLETE YOUR PROFILE FIRST!</span>
			</div>
		</div>
		
		<div class='error' id='incomplete_profile' style='width:93%; margin-top:-15px; margin-left:3.5%; margin-right:3.5%; float:left; color:red;'><h5>You Must add at least one entry to 'Experience & Skills' to finalize your profile and be matched to jobs.</h5></div>		
			
<?php			
		} else {
?>

		<div id='finalize' style='width:100%; float:left; cursor:pointer; margin-top:15px;'>
				<div style='width:3%; float:left'><img src="images/finalize_profile.png" alt="finalize_profile" style="position: relative; 	bottom: 10px; height:80px"></div>
				<div id='personal_main_button' class='unselected_job_areas' style='background-color:#2E6652'>Finalize Profile<br>
					<span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>FIND JOBS NOW!</span>
				</div>
		</div>

		<div style='width:100%; float:left; margin-left:-3.5%; background-color:#DBDCCE;'>
			<div style='width:95%; float:left; margin-left:3.5%; margin-right:3.5%; margin-bottom:5px; text-align:center;'>
				After clicking 'Finalize' you will be matched to jobs as they are entered on the site by employers.<br/>						
				<b>You will receive an email notification when a new job matches your profile.<br/>					
				<i>You can change your EMAIL SETTINGS at any time on the <a href='employee.php?page=settings'>SETTINGS</a> page</i></b><br/>			
			</div>
		</div>
		
		

<!--
			<div style='width:95%; float:left; text-align:center; margin-bottom:5px; margin-top:15px;'>			
				<div class='green_button' id='finalize' style='width:96%; text-align:center'>
					 <img src='images/savegreen.png'  style="width:25px;height:25px;vertical-align:middle">
					 <span style="margin-left:10px; vertical-align:middle;">FINALIZE PROFILE & FIND JOBS!</span>
				</div>
			</div>
-->
			
<!--
			<div style='width:100%; float:left; margin-left:-3.5%; background-color:#DBDCCE;'>
				<div style='width:95%; float:left; margin-left:3.5%; margin-right:3.5%; margin-bottom:5px; text-align:center;'>
					After clicking 'Finalize' you will be matched to jobs as they are entered on the site by employers.<br/>						
					<b>You will receive an email notification when a new job that matches your profile.<br/>					
					<i>You can change your EMAIL SETTINGS at any time on the <a href='employee.php?page=settings'>SETTINGS</a> page</i></b><br/>			
				</div>
			</div>
-->
			<div style='width:95%; float:left; margin-bottom:15px; margin-top:5px; margin-right:3.5%; margin-left:-1.5%'>	
				<b>You can edit your profile any time, even after you apply to a job.</b>
			</div>
			
<?php
		}
	}
?>
		</div>
	</div>
<?php
}

function profile_html_work_skills_menu_mobile($past_employment_array, $FOH, $BOH, $management, $profile_status) {
	if ($profile_status == "complete") {
		$note_text = "<div style='float:left; margin-right:3.5%; margin-left:3.5%; margin-bottom:10px; width:90%; color:gray'><i>Please click Profile Menu at the top of the page to return to your profile menu.</i></div>";
	} else {
		$note_text = "<div id='menu_buttons' style='float:right; width:100%; margin-bottom:5px; text-align:center; min-height:15px;'>";
		$note_text .= "<div style='width:99%; float:left; background-color:#DBDCCE; min-height:15px; margin-right:1px;'><a href='employee.php?page=profile_menu' style='color:#5D0000'><h4 style='margin-bottom:10px; margin-top:10px;'>Done Entering Experience?</h4></a></div>";
		$note_text .= "</div>";	
	}
?>	
<div class='main_box'>
	<? breadcrumb(2, "Exp. Menu", "employee.php?page=work_skills_menu", "", ""); ?>
	
	<div style=' float:left; width:100%; padding-right:3.5%; padding-left:3.5%'>

		<div style='float:left; width:95%;'>
			
		<h2 style='margin-bottom:10px; margin-top:10px; color:black'>Experience & Skills</h2>	
<?php
		if ($profile_status != "complete") {
?>	
			Skills and Experience will be used to match you to appropriate jobs.  No one can view your past work history or skills unless you apply to a job.<br />
			&nbsp; <br />
			You must have at least one Experience entry and one Skill to be matched to and apply to jobs. <br /><br>
<?php
		}		

		if (count($past_employment_array) > 0) {
?>
			<div style='width:3%; float:left'>
				<img src="images/editcircle.png" alt="edit_entries" style="position: relative; bottom: 4px; height:80px">
			</div>
			<div id='experience_button' class='unselected_job_areas' style='margin-top:8px'>Edit Experience<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'><i><? echo count($past_employment_array) ?> Entries</i></span></div>
				
				<div id='experience_holder' style='float:left; width:100%; display:none'>
<?php	
						echo "<table style='margin-left:6%' class='dark'>";
	
					foreach($past_employment_array as $row) {
						if ($row['current'] == 'Y') {
							$end_date = "Current";
						} else {
							$end_date = $row['end_month']."/".$row['end_year'];
						}
							echo "<tr>";
								echo "<td width='15%'><a href='employee.php?page=edit_past_employment&ID=".$row['ID']."'><img src='images/editpencil.png' height='24px' width='24px'></a></td>";  
								echo "<td><strong>".$row['position']."</strong> at ".$row['company']."</td>";
							echo "</tr>";  
							echo "<tr>";
								echo "<td width='15%'> &nbsp; </td>";
								echo "<td>".$row['start_month']."/".$row['start_year']." - ".$end_date."</td>";
							echo "</tr>";
							echo "<tr>";
								echo "<td width='15%'> &nbsp </td>";
								echo "<td><i>".$row['skill_count']." Skill(s)</i></td>";
							echo "</tr>";											
					}
					echo "</table>";	
				echo "</div>";
		}
?>
				</div>
		</div>
		
		<div style=' float:left; width:100%; padding-right:3.5%; padding-left:3.5%'>

		<div style='float:left; width:100%;'>
			
			<h2 style='margin-bottom:10px; margin-top:10px; color:black'>Add Experience & Skills</h2>	

		<div id='FOH_button' style='width:100%; float:left;'>
				<div style='width:3%; float:left'><img src="images/frontofhouse.png" alt="menu" style="position: relative; bottom: 8px; height:80px"></div>
				<div id='FOH_main_button' class='unselected_job_areas'>Front of House<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>Servers, Bartenders, Hosts, etc.</span>
				</div>
			</div>
		
		
		<div id='FOH_title_buttons' style='width:100%; float:left; margin-left:20%; margin-top:-10px; margin-bottom:8px; margin-right:8px; background-color:#ffffff; display:none;'>

<?php
		foreach($FOH as $title){
			echo "<div class='unselected_job_titles job_titles_button' data-status='unselected' data-title_id='".$title['titleID']."'>".$title['title']."</div>";
		}
	
?>	
		</div>
		</div>

			<div id='BOH_button' style='width:100%; float:left;'>
				<div style='width:3%; float:left'><img src="images/cheftools.png" alt="chefware" style="position: relative; bottom: 8px; height:80px"></div>
				<div id='BOH_main_button' class='unselected_job_areas'>Back of House<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>Chefs, Cooks, Dishwashers, etc.</span>
				</div>
			</div>
			
	<div id='BOH_title_buttons' style='width:100%; float:left; margin-left:20%; margin-top:-10px; margin-bottom:8px; margin-right:8px; background-color:#ffffff; display:none;'>

<?php
		foreach($BOH as $title){
			echo "<div class='unselected_job_titles job_titles_button' data-status='unselected' data-title_id='".$title['titleID']."'>".$title['title']."</div>";
		}
	
?>	
		</div>
		
		<div id='management_button' style='width:100%; float:left;'>
			<div style='width:3%; float:left'><img src="images/kitchen_manager.png" alt="manager" style="position: relative; bottom: 8px; height:80px"></div>
			<div id='management_main_button' class='unselected_job_areas'>Management<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>Managers, Asst. Managers, etc.</span>
			</div>
		</div>
		
		<div id='management_title_buttons' style='width:100%; float:left; margin-left:20%; margin-top:-10px; margin-bottom:8px; margin-right:8px; background-color:#ffffff; display:none;'>

<?php
		foreach($management as $title){
			echo "<div class='unselected_job_titles job_titles_button' data-status='unselected' data-title_id='".$title['titleID']."'>".$title['title']."</div>";
		}
	
?>		
		</div>
		
		<div id='other_button' style='width:100%; float:left;'>
			<div style='width:3%; float:left'><img src="images/paperclip.png" alt="paperclip" style="position: relative; bottom: 8px; height:80px"></div>
			<div id='other_main_button' class='unselected_job_areas'>Other Job Type<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>Jobs outside of hospitality</span>
			</div>
						
		</div>
		
	</div>
		<? echo $note_text ?>
	
</div>
<?php
}

function profile_html_edit_employment_mobile($status, $employmentID, $employment_record, $current_skills, $template_skills, $type, $profile_status) {

	$utilities = new Utilities;
//separate data for ease of use

	$job_title 			= $employment_record['position'];
	$job_category	= $employment_record['category'];
	$company			= $employment_record['company'];
	$start_month	= $employment_record['start_month'];
	$start_year		= $employment_record['start_year'];
	$end_month		= $employment_record['end_month'];
	$end_year			= $employment_record['end_year'];
	$current			= $employment_record['current'];
	$category			= $employment_record['category'];
	$business_type	= $employment_record['business_type'];
	
//preselect category
	$casual_select = $upscale_casual_select = $upscale = $catering = "";
	
	switch($business_type) {
		case "Casual":
			$casual_select = "selected";
		break;
		
		case "Upscale Casual":
			$upscale_casual_select = "selected";
		break;

		case "Upscale":
			$upscale_select = "selected";
		break;

		case "Catering":
			$catering_select = "selected";
		break;	
	}
	
	//preselect months
	$start_month_selection = $utilities->month_selections($start_month);
	$end_month_selection = $utilities->month_selections($end_month);
	
	//preselect current
	if ($current == 'Y') {
		$current_button = 'selected_button';
		$current_data = 'selected';
	} else {
		$current_button = 'unselected_button';
		$current_data = 'unselected';		
	}
	
//CHANGE BUTTON TEXT BASED ON JOB TYPE
	switch ($type) {
		case "FOH":
			$button_one_text = "Knowledge learned and used";
			$button_two_text = "Tasks and skills";
			$button_three_text = "NA";
			$category = array("learn", "task", "NA");
		break;
		
		case "BOH":
			$button_one_text = "Cooking styles";
			$button_two_text = "Skills used at this job";
			$button_three_text = "Advanced tasks and skills";
			$category = array("style", "skill", "advanced");
		break;

		case "Management":
			$button_one_text = "Skills and tasks performed.";
			$button_two_text = "NA";
			$button_three_text = "NA";
			$category = array("", "NA", "NA");
		break;		
	}	
	
	if ($status == "new") {
		$page_title = "Add Experience & Skills";
		$page_note = "Enter details new details about your work experience below.";
		$page_note .= "<br />Remember: <i>No one can view this information until you apply for a job.</i>";
	} else {
		$page_title = "Edit Experience & Skills";		
		$page_note = "Edit the details of your work experience below.";
	}

	if ($profile_status == "complete") {
		$button_message = "";
		$note_text = "<div style='float:left; margin-right:3.5%; margin-bottom:10px; width:90%; color:gray'><i>Please click Profile Menu at the top of the page to return to your profile menu.</i></div>";
	} else {
		$button_message = "<div id='menu_buttons' style='float:right; width:100%; margin-bottom:5px; text-align:center; min-height:15px;'>";
		$button_message .= "<div style='width:99%; float:left; background-color:#DBDCCE; min-height:15px; margin-right:1px;'><a href='employee.php?page=profile_menu' style='color:#5D0000'><h4 style='margin-bottom:10px; margin-top:10px;'>Profile Status: <i>Incomplete</i></h4></a></div>";
		$button_message .= "</div>";	
		$note_text = "<div style='float:left; margin-right:3.5%; margin-bottom:10px; width:90%;'><b><i>Please click Profile Menu to Finalize your profile and apply to jobs.</i></b></div>";				
	}
?>	
<div class='main_box'>
	<? echo $button_message ?>	
	<? breadcrumb(3, "Exp. Menu", "employee.php?page=work_skills_menu", "Edit Exp.", ""); ?>
	
	<div style='float:left; width:94%; padding-right:3.5%; padding-left:3.5%;'>
		<h2 style='margin-bottom:10px; margin-top:10px; color:black;'><? echo $page_title ?></h2>
		<p style='margin-bottom:14px; margin-top:10px; color:6c6367'><? echo $page_note ?></hp>
	</div>
		
	<div style='float:left; width:100%; padding-right:8px; padding-left:8px'>
		<div id='FOH_button' style='width:100%; float:left;'>
			<div style='width:3%; float:left'><img src="images/frontofhouse.png" alt="menu" style="position: relative; bottom: 8px; height:80px"></div>
			<div class='selected_job_areas'><? echo $job_title ?><br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>Tell us about your <? echo $job_title ?> experience.</span>
		</div>
		
<!-- 	Holder for Warnings	 -->
		<div class='error' id='empty_company' style='float:left; width:100%; color:red; display:none'>Company cannot be blank.</div>
		<div class='error' id='empty_position' style='float:left; width:100%; color:red; display:none'>Position cannot be blank.</div>
		<div class='error' id='empty_type' style='float:left; width:100%; color:red; display:none'>Please select a location type.</div>
		<div class='error' id='empty_year' style='float:left; width:100%; color:red; display:none'>Employment year cannot be empty.</div>
		<div class='error' id='bad_dates' style='float:left; width:100%; color:red; display:none'>Employment end date cannot be earlier than start date.</div>
		
		<table align='center' style='width:100%'>
			<tr>
				<td><b>Position: &nbsp; </b></td>
				<td><input type="text" name="past_company" id="past_position" value="<? echo $job_title ?>"></input></td>
			</tr>
			
			<tr>
				<td><b>Company: &nbsp; </b></td>
				<td><input type="text" name="past_company" id="past_company" value="<? echo $company ?>"></input></td>
			</tr>
			
			<tr>
				<td><b>Business Type: &nbsp; </b></td>
				<td valign="baseline">
					<select id='business_type' style='background-color:#e8e8e8'>
						<option value='0' >--Location Type--</option>;
						<option value='Casual' <? echo $casual_select ?>>Casual</option>;
						<option value='Upscale Casual' <? echo $upscale_casual_select ?>>Upscale Casual</option>;
						<option value='Upscale' <? echo $upscale_select ?>>Upscale</option>;
						<option value='Catering' <? echo $catering_select ?>>Catering</option>;
					</select>
				</td>
			</tr>
			<tr>
				<td><b>Start Date: &nbsp; </b></td>
				<td><select id="start_month" style='background-color:#e8e8e8'>
							<option value='1' <? echo $start_month_selection['jan'] ?>>Jan.</option>
							<option value='2' <? echo $start_month_selection['feb'] ?>>Feb.</option>
							<option value='3' <? echo $start_month_selection['mar'] ?>>Mar.</option>
							<option value='4' <? echo $start_month_selection['apr'] ?>>Apr.</option>
							<option value='5' <? echo $start_month_selection['may'] ?>>May</option>
							<option value='6' <? echo $start_month_selection['jun'] ?>>June</option>
							<option value='7' <? echo $start_month_selection['jul'] ?>>July</option>
							<option value='8' <? echo $start_month_selection['aug'] ?>>Aug.</option>
							<option value='9' <? echo $start_month_selection['sep'] ?>>Sep.</option>
							<option value='10' <? echo $start_month_selection['oct'] ?>>Oct.</option>
							<option value='11' <? echo $start_month_selection['nov'] ?>>Nov.</option>
							<option value='12' <? echo $start_month_selection['dec'] ?>>Dec.</option>
						</select>	
						<input type="text" id="start_year" maxlength="4" style='width:50px;' placeholder="Year" value="<? echo $start_year ?>"></input>
				</td>
			</tr>
			<tr>
				<td class='end'><b>End Date: &nbsp; </b></td>
				<td class='end'><select id="end_month" style='background-color:#e8e8e8'>
							<option value='1' <? echo $end_month_selection['jan'] ?>>Jan.</option>
							<option value='2' <? echo $end_month_selection['feb'] ?>>Feb.</option>
							<option value='3' <? echo $end_month_selection['mar'] ?>>Mar.</option>
							<option value='4' <? echo $end_month_selection['apr'] ?>>Apr.</option>
							<option value='5' <? echo $end_month_selection['may'] ?>>May</option>
							<option value='6' <? echo $end_month_selection['jun'] ?>>June</option>
							<option value='7' <? echo $end_month_selection['jul'] ?>>July</option>
							<option value='8' <? echo $end_month_selection['aug'] ?>>Aug.</option>
							<option value='9' <? echo $end_month_selection['sep'] ?>>Sep.</option>
							<option value='10' <? echo $end_month_selection['oct'] ?>>Oct.</option>
							<option value='11' <? echo $end_month_selection['nov'] ?>>Nov.</option>
							<option value='12' <? echo $end_month_selection['dec'] ?>>Dec.</option>
						</select>	
						<input type="text" id="end_year" maxlength="4" style='width:50px;' placeholder="Year" value="<? echo $end_year ?>"></input>
				</td>
			</tr>	
			<tr>		
				<td> &nbsp; </td>
				<td>
					<span style='width:84%; margin-right:8px;' id='current_employment' class='current_employment <? echo $current_button ?>' data-current_employment='<? echo $current_data ?>'><span class='fui-check-inverted' style='color:white; float:left; cursor:pointer;'></span> Currently Employed</span>
				</td>
			</tr>						
		</table>
		</div>
		
		<br>
		<br>
<?php
	//IF job_type is "Other" this is a non-restaurant job, no sub-skills will be displayed
	
	if ($type != "Other") {
?>		
		<div style='float:left; width:93%; margin-top:2px; margin-bottom:8px; margin-right:4px; margin-left:4px'><b>Please select all the items below you used or learned at this job:</b>
			<div style='width:100%; margin-top:8px; margin-bottom:8px; margin-right:8px; background-color:#ffffff;'>

			<div id='button_one_holder' style='width:100%; float:left;'>
				<div style='width:3%; float:left'><img src="images/nextarrow.png" alt="next_company" style="position: relative; bottom: 0px; height:44px"></div>
				<div id='main_button_one' class='unselected_job_areas'><span style='margin-left:-30px'><? echo $button_one_text ?></span></div>
			</div>
		
			<div id='button_one_skill_buttons' style='width:100%; float:left; margin-left:20%; margin-top:5px; margin-bottom:8px; margin-right:8px; background-color:#ffffff; display:none;'>
<?php
		//loop through skill options based on category
		echo "<div style='float:left; width:100%;'>";
			$count = 1;
			foreach($template_skills as $row) {
				$skill_button_class = "unselected_job_titles";
				$skill_data_status = "unselected";
				
				$category[0];
				if ($row['category'] == $category[0]) {
					//loop through previously enetered user skills and mark them as selected
					if (count($current_skills) > 0 ) {
						foreach ($current_skills as $sub_skill) {
							if ($sub_skill['sub_skill'] == $row['skill']) {
								//change button
								$skill_button_class = "selected_job_titles";
								$skill_data_status = "selected";								
							}
						}					
					}					
					echo "<div class='".$skill_button_class." skill_titles_button' data-status='".$skill_data_status."' data-skill='".$row['skill']."'>".$row['skill']."</div>";
					if ($count % 2 == 0) {
						echo "<br />";
					} 
					$count++;
				}
			}
		echo "</div>";
	echo "</div>";
	
	
	//button holder 2 does not exist for management jobs
	if ($button_two_text != "NA") {
?>			

			<div id='button_two_holder' style='width:100%; float:left;'>
					<div style='width:3%; float:left'><img src="images/nextarrow.png" alt="next_company" style="position: relative; bottom: 0px; height:44px"></div>
					<div id='main_button_two' class='unselected_job_areas'><span style='margin-left:-30px'><? echo $button_two_text ?></span></div>
			</div>
			
			
			<div id='button_two_skill_buttons' style='width:100%; float:left; margin-left:20%; margin-top:5px; margin-bottom:8px; margin-right:8px; background-color:#ffffff; display:none;'>
	
<?php
			//loop through skill options based on category
			echo "<div style='float:left; width:100%;'>";
			$count = 1;
			foreach($template_skills as $row) {
				$skill_button_class = "unselected_job_titles";
				$skill_data_status = "unselected";
				
				if ($row['category'] == $category[1]) {
						//loop through previously entered user skills and mark them as selected
						if (count($current_skills) > 0 ) {
							foreach ($current_skills as $sub_skill) {
								//echo $sub_skill['sub_skill']." - ".$row['skill']."<br />";
								if ($sub_skill['sub_skill'] == $row['skill']) {
									//change button
									$skill_button_class = "selected_job_titles";
									$skill_data_status = "selected";								
								}
							}
							
						}
						echo "<div style='float:left;' class='".$skill_button_class." skill_titles_button' data-status='unselected' data-skill='".$row['skill']."'>".$row['skill']."</div>";
						if ($count % 2 == 0) {
							echo "<br />";
						} 
						$count++;
				}
			}
			echo "</div>";
		echo "</div>";
	}
	
	
	//button holder 3 does not exist for management jobs or FOH jobs
	if ($button_three_text != "NA") {	
?>			
		<div id='button_three_holder' style='width:100%; float:left;'>
				<div style='width:3%; float:left'><img src="images/nextarrow.png" alt="next_company" style="position: relative; bottom: 0px; height:44px"></div>
				<div id='main_button_three' class='unselected_job_areas'><span style='margin-left:-30px'><? echo $button_three_text ?></span></div>
		</div>
		
		<div id='button_three_skill_buttons' style='width:100%; float:left; margin-left:20%; margin-top:5px; margin-bottom:8px; margin-right:8px; background-color:#ffffff; display:none;'>
<?php

				//loop through skill options based on category
				echo "<div style='float:left; width:100%;'>";
				$count = 1;
				foreach($template_skills as $row) {
					$skill_button_class = "unselected_job_titles";
					$skill_data_status = "unselected";
		
					if ($row['category'] == $category[2]) {
							//loop through previously enetered user skills and mark them as selected
							if (count($current_skills) > 0 ) {
								foreach ($current_skills as $sub_skill) {
									if ($sub_skill['sub_skill'] == $row['skill']) {
										//change button
										$skill_button_class = "selected_job_titles";
										$skill_data_status = "selected";								
									}
								}							
							}		
							echo "<div class='".$skill_button_class." skill_titles_button' data-status='unselected' data-skill='".$row['skill']."'>".$row['skill']."</div>";
							if ($count % 2 == 0) {
								echo "<br />";
							} 
							$count++;
					}
				}
				echo "</div>";
			echo "</div>";
		}
	echo "</div>";		
	} //end if
?>					
	</div>
		

<!-- HIDDEN INPUT, DO NOT REMOVE -->
		<input type='hidden' id='job_category' value="<? echo $job_category ?>">
		<input type='hidden' id='status' value="<? echo $status ?>">

		<div style='width:100%; float:left; margin-bottom:25px; margin-top:10px; margin-left:10px;'>		
			
			<div class='green_button save_position' id='<? echo $employmentID ?>'>
				  <img src='images/savegreen.png'  style="width:25px;height:25px;vertical-align:middle">
				  <span style="margin-left:8px; vertical-align: middle">Save </span>
			</div>

<?php
	if ($status != "new") {	
?>	
		<div class='red_button show_delete' style='width:40%; float:left; margin-top:5px; margin-left:0px;'>
			<img src='images/delete.png'  style='width:25px;height:25px;vertical-align:middle'>
			<span style='margin-left:8px; vertical-align:middle'>Delete</span>
		</div>
<?php
	}
?>	
		</div>
	</div>
</div>
</div>

<!-- SPecial div just for this page -->
		<div id="save_box" style="display:none;text-align:center; margin-top:150px; min-height: 435px; width:100%;">
			<font size='6px'><b>Experience Skills Saved</b></font><br />
			<b>Click 'Back' to add more and continue editing your profile</b>	
		</div>																											
<?php	
	profile_html_employment_delete_warning_mobile("Employment", $title, $employmentID);
}

function profile_html_employment_delete_warning_mobile($type, $record_name, $ID) {
?>
	<div id='delete_holder' style='float:left; margin-top:50px; margin-left:10px; display:none;'>
		<h3>Are you sure you want to remove <? echo $type." - ".$record_name ?> and all associated skills and information?</h3>

		<div class='red_button delete' id='<? echo $ID ?>' style='width:40%; float:left; margin-left:5px; '>
			<img src='images/delete.png'  style='width:25px;height:25px;vertical-align:middle'>
			<span style='margin-left:15px;'>Delete</span>
		</div>		
		&nbsp; &nbsp; <a href='#' id='cancel'><b>CANCEL</b></a>
		
	</div>
<?php
}

function profile_html_old_work_list_mobile($past_employment_array, $FOH, $BOH, $Management) {

	echo "<div class='main_box' style='width:100%; float:left;'>";

	breadcrumb(2, "Work Skills", "employee.php?page=work_skills_menu", "", "");
	
	echo "<h3 style='text-align:center'>We've made some improvements!</h3>";
	
	echo "<div style='width:99%; float:left; margin-left:5px; margin-bottom:17px;'>";
		echo "We would like to more accurately determine what skills are associated with your previous jobs.<br />";
		echo "&nbsp; <br />";
		echo "<b>Please update your jobs below:<br />";
	echo "</div>";

	foreach($past_employment_array as $employment) {
		if ($employment['category'] == "") {
			//see if the job title matches
			$title = $employment['position'];
			$titleID = 0;
			
			foreach($FOH as $row) {
				if (strtoupper($row['title']) == strtoupper($title)) {
					$titleID = $row['titleID'];
				}
			}
			
			if ($titleID == 0) {
				foreach($Management as $row) {
					if (strtoupper($row['title']) == strtoupper($title)) {
						$titleID = $row['titleID'];
					}
				}			
			}
			
			if ($titleID == 0) {
				foreach($FOH as $row) {
					if (strtoupper($row['title']) == strtoupper($title)) {
						$titleID = $row['titleID'];
					}
				}			
			}		
	?>
	
			<div id='<? echo $employment['ID'] ?>' class='old_work' data-current_title_ID='<? echo $titleID ?>' style='width:100%; float:left;'>
				<div style='width:3%; float:left'><img src="images/frontofhouse.png" alt="menu" style="position: relative; bottom: 8px; height:80px"></div>
				<div class='unselected_job_areas'><? echo $title ?><br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>Please edit this entry to apply to jobs.</span></div>
			</div>
			
			<div id='title_choices' data-title_holder='<? echo $employment['ID'] ?>' style='width:100%; float:left; margin-left:20%; margin-top:-20px; margin-bottom:8px; margin-right:8px; background-color:#ffffff; display:none;'>		
	<?php
				//hidden job titles
				foreach($FOH as $title){
					echo "<div class='unselected_job_titles update_titles_button' data-employment='".$employment['ID']."' data-title_id='".$title['titleID']."'>".$title['title']."</div>";
				}
		
				foreach($BOH as $title){
					echo "<div class='unselected_job_titles update_titles_button' data-employment='".$employment['ID']."' data-title_id='".$title['titleID']."'>".$title['title']."</div>";
				}
		
				foreach($Management as $title){
					echo "<div class='unselected_job_titles update_titles_button' data-employment='".$employment['ID']."'  data-title_id='".$title['titleID']."'>".$title['title']."</div>";
				}
				echo "<div class='unselected_job_titles update_titles_button' data-employment='".$employment['ID']."' data-title_id='FOH'>Other FOH</div>";	
				echo "<div class='unselected_job_titles update_titles_button' data-employment='".$employment['ID']."' data-title_id='Kitchen'>Other BOH</div>";	
				echo "<div class='unselected_job_titles update_titles_button' data-employment='".$employment['ID']."' data-title_id='Management'>Other Mgmt</div>";	
				echo "<div class='unselected_job_titles update_titles_button' data-employment='".$employment['ID']."' data-title_id='Other'>Non-Hospitality</div>";	

			echo "</div>";				
		}
	}
	
	echo "</div>";
}																			
	

function profile_html_employment_pre_update_mobile($employment_record, $FOH, $BOH, $Management) {
	//THIS PAGE IS DISPLAYED WHEN A USER EDITS PAST EMPLOYMENT THEY ENTERED PRIOR TO UPDATE ON ###### DATE

	//hidden forms
	echo "<input type='hidden' id='workID' value='".$_GET['ID']."'>";	

//Start Page
	 breadcrumb(2, "Work Skills", "employee.php?page=work_skills_menu", "", ""); 


	echo "<h3 style='text-align:center'>We have updated our matching system</h3>";
	
	echo "<div style='width:99%; float:left; margin-left:5px; margin-bottom:17px;'>";
		echo "We would like to more accurately determine what skills are associated with your previous job.<br />";
		echo "&nbsp; <br />";
		echo "<b>Is your ".$employment_record['position']." position a: </b><br />";
	echo "</div>";
?>	
		<div id='FOH_button' style='width:100%; float:left;'>
				<div style='width:3%; float:left'><img src="images/frontofhouse.png" alt="menu" style="position: relative; bottom: 12px; height:80px"></div>
				<div id='FOH_main_button' class='unselected_job_areas'>Front of House<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>Servers, Bartenders, Hosts, etc.</span>
				</div>
			</div>
		
		
		<div id='FOH_title_buttons' style='width:100%; float:left; margin-left:20%; margin-top:-20px; margin-bottom:8px; margin-right:8px; background-color:#ffffff; display:none;'>
			<div style='width:99%; float:left; margin-right:3px;'>Does this position closely resemble one of the following (if not, select Other):</div><br />
<?php
		foreach($FOH as $title){
			echo "<div class='unselected_job_titles job_titles_button' data-status='unselected' data-title_id='".$title['titleID']."'>".$title['title']."</div>";
		}
		echo "<div class='unselected_job_titles job_titles_button' data-status='unselected' data-title_id='FOH'>Other</div>";
	
?>	
		</div>
		</div>

			<div id='BOH_button' style='width:100%; float:left;'>
				<div style='width:3%; float:left'><img src="images/cheftools.png" alt="chefware" style="position: relative; bottom: 12px; height:80px"></div>
				<div id='BOH_main_button' class='unselected_job_areas'>Back of House<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>Chefs, Cooks, Dishwashers, etc.</span>
				</div>
			</div>
			
	<div id='BOH_title_buttons' style='width:100%; float:left; margin-left:20%; margin-top:-20px; margin-bottom:8px; margin-right:8px; background-color:#ffffff; display:none;'>
			<div style='width:99%; float:left; margin-right:3px;'>Does this position closely resemble one of the following (if not, select Other):</div><br />
<?php
		foreach($BOH as $title){
			echo "<div class='unselected_job_titles job_titles_button' data-status='unselected' data-title_id='".$title['titleID']."'>".$title['title']."</div>";
		}
		echo "<div class='unselected_job_titles job_titles_button' data-status='unselected' data-title_id='BOH'>Other</div>";
	
?>	
		</div>
		
		<div id='management_button' style='width:100%; float:left;'>
			<div style='width:3%; float:left'><img src="images/kitchen_manager.png" alt="manager" style="position: relative; bottom: 12px; height:80px"></div>
			<div id='management_main_button' class='unselected_job_areas'>Management<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>Managers, Asst. Managers, etc.</span>
			</div>
		</div>
		
		<div id='management_title_buttons' style='width:100%; float:left; margin-left:20%; margin-top:-20px; margin-bottom:8px; margin-right:8px; background-color:#ffffff; display:none;'>
			<div style='width:99%; float:left; margin-right:3px;'>Does this position closely resemble one of the following (if not, select Other):</div><br />
<?php
		foreach($Management as $title){
			echo "<div class='unselected_job_titles job_titles_button' data-status='unselected' data-title_id='".$title['titleID']."'>".$title['title']."</div>";
		}
		echo "<div class='unselected_job_titles job_titles_button' data-status='unselected' data-title_id='Management'>Other</div>";	
?>		
		</div>
		
		<div id='other_button' style='width:100%; float:left;'>
			<div style='width:3%; float:left'><img src="images/paperclip.png" alt="paperclip" style="position: relative; bottom: 12px; height:80px"></div>
			<div id='Other' data-title_id="Other" class='unselected_job_areas job_titles_button'>Other Job Type<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>Job outside of hospitality</span>
			</div>
		</div>		
<?php	
}

function profile_html_education_menu_mobile($template_certifications, $template_awards, $employee_education, $employee_certifications, $employee_awards, $profile_status) {
	if ($profile_status == "complete") {
		$note_text = "<div style='float:left; margin-right:3.5%; margin-bottom:10px; width:90%; color:gray'><i>Please click Profile Menu at the top of the page to return to your profile menu.</i></div>";
	} else {
		$note_text = "<div style='float:left; margin-right:3.5%; margin-bottom:10px; width:90%;'><b><i>Please click Profile Menu to Finalize your profile and apply to jobs.</i></b></div>";				
	}
?>	
	<?php breadcrumb("2", "Education Etc.", "employee.php?page=education_menu", "", "") ?>

	<div class='main_box' style=' float:left; width:100%; padding-right:3.5%; padding-left:3.5%'>
		<div style='float:left; width:95%;'>			
			<h2 style='margin-bottom:10px; margin-top:10px; color:black'>Education, Certifications & Awards</h2>	
		
			<div id='welcome_text' style='float:left; margin-right:3.5%; margin-bottom: 20px; width:95%;'>Tell us about your relevant education, certifications you have or any awards you have received.</div>
		</div>
	<div id='education_holder_button' style='width:100%; float:left;'>
		<div style='width:3%; float:left'><img src="images/school.png" alt="chefware" style="position: relative; bottom: 8px; height:80px"></div>
		<div id='education_main_button' class='unselected_job_areas'>Education <span id='education_count'></span><br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'><i><? echo count($employee_education) ?> Entries</i></span></div>
	</div>
			
	<div id='education_options' style='width:100%; float:left; margin-left:0%; margin-top:-20px; margin-bottom:8px; margin-right:8px; background-color:#ffffff; display:none;'>

<?php
		foreach($employee_education as $education){
			//determine education type
			$college = $culinary = $bartending = "";
			switch($education['type']) {
				case "College":
					$college = "selected";
				break;
				case "Culinary School":
					$culinary = "selected";
				break;
				case "Bartending School":
					$bartending = "selected";
				break;
			}
			
			echo "<div class='education_row'>";						
				echo "<table style='margin-left:6%' class='dark'>";
					echo "<tr>";
						echo "<td width='15%'><a href='#' class='edit_education' id='".$education['ID']."'><img src='images/editpencil.png' height='24px' width='24px'></a></td>";  
						echo "<td><b>".$education['degree']."</b> from <b>".$education['school']."</b></td>";
					echo "</tr>";  
					echo "<tr>";
						echo "<td width='15%'>";
						echo "<td><i>".$education['type']."</i></td>";
					echo "</tr>";  
				echo "</table>";
			echo "</div>";
			
			echo "<div class='education_input' data-education_id='".$education['ID']."' style='margin-left:20%; display:none'>";
				echo "<div class='error' id='school_empty_warning_".$education['ID']."' style='color:red; display:none'>Institution cannot be empty</div>";
				echo "<input type='text' class='edit_school' data-education_id='".$education['ID']."' value='".$education['school']."' placeholder='Insitution'><br />";
				echo "<input type='text' class='edit_degree' data-education_id='".$education['ID']."' value='".$education['degree']."' placeholder='Degree'><br />";
				echo "<select class='edit_education_type' data-education_id='".$education['ID']."'>";
						echo "<option value='Other'>Other</option>";			
						echo 	"<option value='Culinary School' ".$culinary.">Culinary School</option>";
						echo "<option value='Bartending School' ".$bartending.">Bartending School</option>";
						echo "<option value='College' ".$college.">College/University</option>";
				echo "</select>";
				
				echo "<div style='float:left; width:99%; margin-top:10px; margin-bottom:5px;'>";
					
					echo "<div class='green_button save_education_changes' style='float:left; margin-right:5px; margin-top:3px;' id='".$education['ID']."'>";
						 echo "<img src='images/savegreen.png'  style='width:25px;height:25px;vertical-align:middle'>";
						 echo  "<span style='margin-left:15px;'>Save</span>";
					echo "</div>";
					
					echo "<div class='red_button remove_education' id='".$education['ID']."' style='float:left; margin-top:3px;'>";
						 echo "<img src='images/delete.png'  style='width:25px;height:25px;vertical-align:middle'>";
						 echo  "<span style='margin-left:15px;'>Delete</span>";
					echo "</div>";

					echo "<div style='float:left; margin-top:8px;'>";										
						echo "&nbsp; &nbsp; <a href='#' class='cancel_edit_education'><h4 style='margin-top:8px; display:inline; vertical-align:middle;'>Cancel</h4></a>";			
					echo "</div>";
				echo "</div>";							
			echo "</div>";
		}
?>	
		<div  id='new_education_button_holder' style='float:left; width:100%; margin-top:10px; margin-left:20px; margin-bottom:5px;'>
			<div class='green_button' id='add_education_button'>
				<img src='images/addplussigngreen.png'  style="width:25px;height:25px;vertical-align:middle">
				<span style="margin-left:8px; vertical-align:middle">Add New</span>
			</div>
		</div>

		<div id='new_education_holder' style='display:none; margin-left:20%;'>
			<div class='error' id='new_school_empty_warning' style='color:red; display:none;'><b>Institution cannot be blank</b></div><br />
			<input type='text' id='new_school' placeholder='Insitution'><br />
			<input type='text' id='new_degree' placeholder='Degree'><br />
			Type: <select id='new_education_type'>
						<option value='Other'>Other</option>			
						<option value='Culinary School'>Culinary School</option>
						<option value='Bartending School'>Bartending School</option>
						<option value='College'>College/University</option>
			</select><br />
				
			<div style='float:left; width:100%; margin-top:10px; margin-bottom:5px;'>
				<div class='green_button' id='save_new_education'>
					<img src='images/savegreen.png'  style="width:25px;height:25px;vertical-align:middle">
					<span style="margin-left:8px; vertical-align:middle;">Save</span>
				</div>
					<div style='margin-top:6px'><a href='#' id='cancel_new_education'><p style='display:inline;font-size:18px'>&nbsp; &nbsp; Cancel</p></a></div>			
			</div>				
		</div>
	</div>
	
			<div style='float:left; width:100%;'>			
			<div id='certification_holder_button' style='width:100%; float:left;'>
				<div style='width:3%; float:left'><img src="images/certificate.png" alt="menu" style="position: relative; bottom: 8px; height:80px"></div>
				<div id='certification_main_button' data-job_area_selection='unselected' class='unselected_job_areas'>Certifications<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'><i><? echo count($employee_certifications) ?> Entries</i></span></div>
			</div>			
		<div id='certification_options' style='width:100%; float:left; margin-left:20%; margin-top:-10px; margin-bottom:8px; margin-right:8px; background-color:#ffffff; display:none;'>
			<div id='certification_buttons'>
<?php
	//first show template certifications
				foreach($template_certifications as $certification) {
					$selection = "unselected";
					$class = "unselected_job_titles";
					//annoying loop to find out if any of the items already exist in the users profile
		
					if (count($employee_certifications) > 0) {
						foreach($employee_certifications as $key=>$row) {
							if ($row['certification'] == $certification) {
								$selection = "selected";
								$class = "selected_job_titles";	
								
								unset($employee_certifications[$key]);		
							}
						}
					}
					echo "<div class='".$class." certification_button' data-status='".$selection."' data-certification='".$certification."'>".$certification."</div>";
				}
				
				//now show those added by user manually
				if (count($employee_certifications) > 0) {
					foreach($employee_certifications as $row) {
						echo "<div class='selected_job_titles certification_button' data-status='selected' data-certification='".$row['certification']."'>".$row['certification']."</div>";
					}
				}	
				
				echo "<div class='unselected_job_titles' id='other' >Other</div>";
	
?>	
			</div>
			
			<div id='save_button_holder' style='float:left; width:100%; margin-top:15px;'>
				<div class='green_button' id='save_changes'>
					<img src='images/savegreen.png'  style="width:25px;height:25px;vertical-align:middle">
					<span style="margin-left:8px; vertical-align:middle">Save</span>
				</div>
			</div>

		</div>
		
		<div id='other_certification_holder' style='float:left; width:100%;margin-left:20%; margin-top:-20px; margin-bottom:8px; margin-right:8px; display:none;'>
			<h3>New Certification</h3>
			<div class='error' id='empty_warning' style='color:red; display:none;'>Certification cannot be blank</div>
			<input type='text' id='new_certification' maxlength="25"><br />
			<div id='save_button_holder' style='float:left; width:100%; margin-top:10px; margin-bottom:5px;'>
				<div class='green_button' id='add_certification'>
					<img src='images/savegreen.png'  style="width:25px;height:25px;vertical-align:middle">
					 <span style="margin-left:8px; vertical-align:middle">Save New</span>
				</div>
				&nbsp; &nbsp; <a href='#' id='cancel_other'><h4 style='display:inline; vertical-align:middle;'>Cancel</h4></a>			
			</div>

	</div>
</div>
		
	<div id='award_holder_button' style='width:100%; float:left;'>
		<div style='width:3%; float:left'><img src="images/award.png" alt="manager" style="position: relative; bottom: 8px; height:80px"></div>
		<div id='award_main_button' class='unselected_job_areas'>Contests or Awards<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'><i><? echo count($employee_awards) ?> Entries</i></span></div>
	</div>
		
	<div id='award_options' style='width:100%; float:left; margin-top:-20px; margin-bottom:8px; margin-right:8px; background-color:#ffffff; display:none;'>
<?php
		foreach($employee_awards as $award){
			echo "<div class='award_row'>";
				echo "<table style='margin-left:6%' class='dark'>";
				echo "<tr>";
					echo "<td width='15%'><a href='#' class='edit_award' id='".$award['awardID']."'><img src='images/editpencil.png' height='24px' width='24px'></a></td>";  				
						echo "<td><strong>".$award['award']."</strong></td></tr>";  
					echo "<tr>";
				echo "</table>";
			echo "</div>";
			
			echo "<div class='award_input' data-award_id='".$award['awardID']."' style='margin-left:20%; display:none'>";
				echo "<div class='error' id='award_empty_warning_".$award['awardID']."' style='color:red; display:none'>Award field cannot be empty</div>";
				echo "<input type='text' class='edit_award_holder' data-award_id='".$award['awardID']."' value='".$award['award']."' placeholder='Award'><br />";

				echo "<div style='float:left; width:99%; margin-top:10px; margin-bottom:5px;'>";
					echo "<div class='green_button save_award_edit' id='".$award['awardID']."' style='float:left; margin-right:5px; margin-top:3px;'>";
						 echo "<img src='images/savegreen.png'  style='width:25px;height:25px;vertical-align:middle'>";
						 echo  "<span style='margin-left:15px;'>Save</span>";
					echo "</div>";
					
					echo "<div class='red_button remove_award_edit' id='".$award['awardID']."' style='float:left; margin-top:3px;'>";
						 echo "<img src='images/delete.png'  style='width:25px;height:25px;vertical-align:middle'>";
						 echo  "<span style='margin-left:15px;'>Delete</span>";
					echo "</div>";

					echo "<div style='float:left; margin-top:8px;'>";										
						echo "&nbsp; &nbsp; <a href='#' class='cancel_edit_award'><h4 style='display:inline; vertical-align:middle; margin-top:8px'>Cancel</h4></a>";			
					echo "</div>";
				echo "</div>";				
			echo "</div>";			
			
		}
?>	
		<div id='new_award_button_holder' style='float:left; width:100%; margin-top:10px; margin-left:20px; margin-bottom:5px;'>
			<div class='green_button' id='add_award_button'>
				<img src='images/addplussigngreen.png'  style="width:25px;height:25px;vertical-align:middle">
				<span style="margin-left:8px;vertical-align:middle">Add New</span>
			</div>
		</div>
			
		<div id='new_award_holder' style='display:none; margin-left:20%;'>
			<div class='error' id='new_award_empty_warning' style='color:red; display:none'>Award details cannot be blank</div><br />
			<input type='text' id='new_award' placeholder='Award or Contest'><br />
			<div style='float:left; width:100%; margin-top:10px; margin-bottom:5px;'>
					<div class='green_button' id='save_new_award'>
					  <img src='images/savegreen.png'  style="width:25px;height:25px;vertical-align:middle">
					  <span style="margin-left:8px; vertical-align:middle">Save</span>
					</div>
					<div style='margin-top:6px'><a href='#' id='cancel_new_award'><p style='display:inline;font-size:18px'>&nbsp; &nbsp; Cancel</p></a></div>		
			</div>				
		</div>	
		<br>
	</div>
	
	<? echo $note_text ?>
	
	</div>	
<?php	
}

function profile_html_personal_menu_mobile($traits, $languages, $employee_traits, $employee_languages, $profile_status) {
	if ($profile_status == "complete") {
		$note_text = "<div style='float:left; margin-right:3.5%; margin-bottom:10px; width:90%; color:gray'><i>Please click Profile Menu at the top of the page to return to your profile menu.</i></div>";
	} else {
		$note_text = "<div style='float:left; margin-right:3.5%; margin-bottom:10px; width:90%;'><b><i>Please click Profile Menu to Finalize your profile and apply to jobs.</i></b></div>";				
	}
	
?>	
		<?php breadcrumb("2", "Personal Info", "employee.php?page=personal_menu", "", "") ?>	

	<div style=' float:left; width:100%; padding-right:3.5%; padding-left:3.5%'>
		<div style='float:left; width:95%;'>
			
		<h2 style='margin-bottom:10px; margin-top:10px; color:black'>Photo & Personal Info</h2>	
		
		<p style='margin-bottom:20px; margin-top:10px; color:6c6367'>The information below will help you stand out from other candidates when you apply to jobs.</p>
		</div>
		<div style='float:left; width:100%;'>
		<div id='photo_button' style='width:100%; float:left;'>
				<div style='width:3%; float:left'><img src="images/photo.png" alt="you" style="position: relative; bottom: 8px; height:80px"></div>
				<div id='photo_main_button' class='unselected_job_areas'>Profile Photos<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>Add profile and work photos.</span>
				</div>
		</div>		

		<div id='summary_button' style='width:100%; float:left;'>
				<div style='width:3%; float:left'><img src="images/personalsummary.png" alt="you" style="position: relative; bottom: 8px; height:80px"></div>
				<div id='summary_main_button' class='unselected_job_areas'>Personal Summary<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>Describe who you are as an employee.</span>
				</div>
		</div>

		
		<div id='trait_holder_button' style='width:100%; float:left;'>
				<div style='width:3%; float:left'><img src="images/traits.png" alt="traits" style="position: relative; bottom: 8px; height:80px"></div>
		
				<div id='traits_main_button' data-job_area_selection='unselected' class='unselected_job_areas'>Traits & Languages<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>Choose your top three character traits.</span>
				</div>
			</div>
		
		<div id='trait_options' style='float:left; background-color:white; color:6c6367; margin-left:20%; margin-right:3%; display:none'>Choose three traits that best describe you.
			<div style='float-left; width:100%; margin-top:8px;'>
				<div id='trait_warning' style='color:red; display:none'>Please select only 3 traits (unselect one to continue)</div>
<?php
			foreach($traits as $trait){
				$status = "unselected";
				$class = "unselected_job_titles";
				if (count($employee_traits) > 0) {
					foreach($employee_traits as $row) {
						if ($row['trait'] == $trait) {
							$status = "selected";
							$class = "selected_job_titles";							
						}
					}
				}
				
				echo "<div class='".$class." trait_button' data-status='".$status."' data-trait='".$trait."'>".$trait."</div>";
			}
	
?>	
				</div>
				
		<div id='language_summary' style='float:left; background-color:white; color:6c6367; margin-right:3%; margin-top:12px'>What languages do you speak?
			<div style='float-left; width:100%; margin-top:8px;'>

<?php
		foreach($languages as $language){
				$status = "unselected";
				$class = "unselected_job_titles";
				if (count($employee_languages) > 0) {
					foreach($employee_languages as $row) {
						if ($row['lang'] == $language) {
							$status = "selected";
							$class = "selected_job_titles";							
						}
					}
				}

			echo "<div class='".$class." language_button' data-status='".$status."' data-language='".$language."'>".$language."</div>";
		}
?>	
		</div>
		</div>

		<div style='float:left; width:100%; padding-right:3.5%; padding-left:3.5%'>
				<div id='save_button_holder' style='float:left; width:100%; margin-top:5px; margin-bottom:10px;'>
					<div class='green_button' id='save_changes'>
						 <img src='images/savegreen.png'  style="width:25px;height:25px;vertical-align:middle">
						 <span style="margin-left:8px; vertical-align:middle">Save</span>
					</div>
				</div>
		</div>
	</div>
	
	<? echo $note_text ?>			
	</div>
<?php
	
}

function profile_html_personal_info_mobile($quote, $long_description, $profile_status) {
	if ($profile_status == "complete") {
		$button_message = "";
		$note_text = "<div style='float:left; margin-right:3.5%; margin-bottom:10px; width:90%; color:gray'><i>Please click Profile Menu at the top of the page to return to your profile menu.</i></div>";
	} else {
		$button_message = "<div id='menu_buttons' style='float:right; width:100%; margin-bottom:5px; text-align:center; min-height:15px;'>";
		$button_message .= "<div style='width:99%; float:left; background-color:#DBDCCE; min-height:15px; margin-right:1px;'><a href='employee.php?page=profile_menu' style='color:#5D0000'><h4 style='margin-bottom:10px; margin-top:10px;'>Profile Status: <i>Incomplete</i></h4></a></div>";
		$button_message .= "</div>";	
		$note_text = "<div style='float:left; margin-right:3.5%; margin-bottom:10px; width:90%;'><b><i>Please click Profile Menu to Finalize your profile and apply to jobs.</i></b></div>";				
	}
?>

	<? echo $button_message ?>	
	<?php breadcrumb("3", "Personal Info", "employee.php?page=personal_menu", "Description", "") ?>	

	<div id='main_holder' style='float:left; width:100%; padding-right:3.5%; padding-left:3.5%'>

		<div style='float:left; width:100%;'>
			
			<h2 style='margin-bottom:10px; margin-top:10px; color:black'>Personal Info</h2>	
		
			<h4 style='margin-bottom:10px; margin-top:10px; color:6c6367'>Tell us more about you.</h4>
			<div class='employee_summary' style='width:95%; color:6c6367; font-size:14px; margin-right:3.5%'>
				Give us a short description (70 characters or less) of who you are, as an employee. <strong>Remember that employers will view this when you apply for a job.</strong> 
				<br>
				
				<div id='charNum' style='color:red;'></div><br />
			
				<textarea style="width:95%; margin-bottom:8px;" cols="200" rows="2" maxlength="70" id='quote'><?php echo $quote ?></textarea>
			</div>
			
			<h4 style='margin-bottom:10px; margin-top:10px; color:6c6367'>Want to tell us even more?</h4>

			<div id='employee_summary' style='color:6c6367; font-size:14px; width:95%;'>Include any additional information you'd like to share with potential employers in the area below.  <b>(OPTIONAL)</b>
				<textarea style="width:95%; margin-top:8px; margin-bottom:8px;" cols="200" rows="2" id='long_description'><?php echo $long_description ?></textarea>

				<div id='save_button_holder' style='float:left; width:100%; margin-top:15px;'>
					<div class='green_button' id='save_descriptions'>
						<img src='images/savegreen.png'  style="width:25px;height:25px;vertical-align:middle">
						<span style="margin-left:8px; vertical-align:middle">Save</span>
					</div>
				</div>

				<br>
			</div>
		</div>
	</div>
<?php	
}

function profile_html_edit_photos_mobile($upload_url, $photo, $kitchen, $bartender, $kitchen_photos, $bar_photos, $profile_status) {
	if ($profile_status == "complete") {
		$button_message = "";
		$note_text = "<div style='float:left; margin-right:3.5%; margin-bottom:10px; width:90%; color:gray'><i>Please click Profile Menu at the top of the page to return to your profile menu.</i></div>";
	} else {
		$button_message = "<div id='menu_buttons' style='float:right; width:100%; margin-bottom:5px; text-align:center; min-height:15px;'>";
		$button_message .= "<div style='width:99%; float:left; background-color:#DBDCCE; min-height:15px; margin-right:1px;'><a href='employee.php?page=profile_menu' style='color:#5D0000'><h4 style='margin-bottom:10px; margin-top:10px;'>Profile Status: <i>Incomplete</i></h4></a></div>";
		$button_message .= "</div>";	
		$note_text = "<div style='float:left; margin-right:3.5%; margin-bottom:10px; width:90%;'><b><i>Please click Profile Menu to Finalize your profile and apply to jobs.</i></b></div>";				
	}
?>

	<? echo $button_message ?>
	<?php breadcrumb("3", "Personal Info", "employee.php?page=personal_menu", "Photos", "") ?>	
	
<?php
		
	echo "<div class='main_box' style='float:left; width:100%; padding-right:3.5%; padding-left:3.5%;'>";
			
		echo "<h2 style='margin-bottom:10px; margin-top:10px; color:black;'>Profile Photo</h2>";
		echo "<p style='margin-bottom:10px; margin-top:10px; color:6c6367'>Show us who you are.</hp>";
							
		echo "<div style='width:100%; float:left;'>";
			echo "<div style='width:30%; float:left;  margin-left:10px; margin-top:10px;'>";
				echo $photo;
			echo "</div>";
					
			echo "<div style='width:65%; float:left; margin-bottom:30px; margin-left:5px; margin-top:10px; margin-bottom:10px;'>";
				echo "<div class='button_holder_photo'>";
					echo "<div class='green_button add_photo' id='profile' style='margin-left:5px; width:160px'>";
						echo "<img src='images/addplussigngreen.png'  style='width:25px;height:25px;vertical-align:middle'>";
						echo "<span style='margin-left:8px; vertical-align:middle'>Change Photo</span>";
					echo "</div>";						
				echo "</div>";						

				if ($photo != "<b>NO PHOTO</b>") {	
					echo "<div class='button_holder_photo'>";
						echo "<div class='red_button remove_photo' id='profile' style='width:160px; margin-left:5px; margin-top:10px'>";
							echo "<img src='images/delete.png'  style='width:25px;height:25px;vertical-align:middle'>";
							echo "<span style='margin-left:8px; vertical-align:middle'>Remove Photo</span>";
						echo "</div>";
					echo "</div>";
				}
			echo "</div>";
												
			echo "<div class='warning' id='file_size_warning' style='display:none; color:red; margin-top:10px;'>";
				echo "<b>Please choose a file less than 4 MB</b>";
			echo "</div>";
						
			echo "<div class='warning' id='file_type_warning' style='display:none; color:red; margin-top:10px;'>";
				echo "<b>Please choose a PNG of JPG file</b>";
			echo "</div>";																																																																																														
					
		echo "</div>";	
					
		echo "<div id='status' style='width:100%; color:red;'>";				
		echo "</div>";				
	
		echo "<form id='profile_form_ie' action='".$upload_url."_ie.php?type=profile' method='post' enctype='multipart/form-data' style='float:left; padding-bottom:25px; padding-left:30px; margin-top:30px; display:none;'>";
			echo "<h2 style='text-align:center;'>Choose a File</h2>";
			echo "&nbsp; &nbsp; &nbsp; &nbsp; <input type='file' id='profile_pic_choose_ie' name='profile_pic_choose_ie' >";
			echo "<input type='submit' value='Save Profile Pic' id='profile_upload_button_ie'><br />";
			echo "<a href='#' class='upload_cancel' id='profile'>Cancel</a><br />";					
			echo "<div id='status' style='color:red'></div>";		
		echo "</form>";			
						
?>
	<div id="add_photo_tools" style="margin-top:-15px;">			
	    <form id="myform" action="<? echo $upload_url ?>.php?type=profile" method="post" enctype="multipart/form-data" style="position:absolute; top:-500px;">
	        <input type="file" id="profile_pic_choose" name="profile_pic_choose" >
			<input type="submit" value="Save Profile Pic1" id="profile_upload_button"><br />
		</form>
	</div>
<?php	
			
	if ($bartender == true) {
		echo "<div style='width:3%; float:left; margin-top:10px'><img src='images/martini.png' alt='cocktail_photos' style='position:relative; bottom:12px; height:80px'></div>";
		echo "<div class='unselected_job_areas' style='margin-top:10px'>Cocktail Photos<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>Add up to 6 photos of your work.</span></div>";
		echo "<div style='width:100%; margin-left:20%; margin-top:-20px; float:left;'>";
	
		if (count($bar_photos) > 0) {			
			$count = 1;
			echo "<b>Click on a photo to remove it.</b><br />";
			echo "&nbsp; <br />";
			foreach($bar_photos as $photo) {
				echo "<a href='#' class='remove_photo' id='".$photo['photoID']."'><img src='images/gallery_pics/".$photo['thumb']."?".time()."' height='70' style='margin-left:8px; margin-bottom:8px;'></a>";
				if ($count % 3 == 0) {
					echo "<br />";
				}
				$count++;
			}
		} 
		
		if (count($bar_photos) < 6) {
			echo "<div class='button_holder_photo' style='width:100%; float:left; margin-bottom:10px; margin-top:6px; '>";
				echo "<div class='green_button add_photo' id='bartender' style='margin-left:5px; width:160px'>";
					echo "<img src='images/addplussigngreen.png'  style='width:25px;height:25px;vertical-align:middle'>";
					echo "<span style='margin-left:8px;'>Add Photo</span>";
				echo "</div>";
			echo "</div>";
			
			echo "<div id='file_size_warning' style='display:none; color:red; margin-top:10px;'>";
				echo "<b>Please choose a file less than 4 MB</b>";
			echo "</div>";
			
			echo "<div id='file_type_warning' style='display:none; color:red; margin-top:10px;'>";
				echo "<b>Please choose a PNG of JPG file</b>";
			echo "</div>";																								
		}
		echo "</div>";
?>
		<form id="bar_form" action="<? echo $upload_url ?>.php?type=bartender" method="post" enctype="multipart/form-data" style="position:absolute; top:-500px;">
		        <input type="file" id="bartender_pic_choose" name="bartender_pic_choose" >
				<input type="submit" value="Save Profile Pic" id="bartender_upload_button"><br />
		</form>
<?php

		echo "<div id='status' style='width:100%; color:red;'></div>";				

		echo "<form id='bar_form_ie' action='".$upload_url."_ie.php?type=bartender' method='post' enctype='multipart/form-data' style='float:left; padding-top:30px; padding-left:10px; display:none'>";
		    echo "<h2 style='text-align:center;'>Choose a File</h2>";
		    echo "&nbsp; &nbsp; &nbsp; &nbsp; <input type='file' id='bartender_pic_choose_ie' name='bartender_pic_choose_ie' ><br />";
		    echo "&nbsp; <br />";
			echo "&nbsp; &nbsp; &nbsp;  &nbsp; <input type='submit' value='Save Cocktail Pic' id='bartender_upload_button_ie'><br />";
			echo "<a href='#' class='upload_cancel' id='bar'>Cancel</a><br />";												
			echo "&nbsp; <br />";
			echo "<div id='status' style='color:red'></div>";	
		echo "</form>";
	}
				
	if ($kitchen == true) {
		echo "<div style='width:3%; margin-top: 10px; float:left'><img src='images/plate.png' alt='culinary_photos' style='position:relative; bottom:12px; height:80px'></div>";
			echo "<div class='unselected_job_areas' style='margin-top:10px'>Culinary Photos<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>Upload up to 6 photos of your work.</span></div>";
			echo "<div style='width:100%; margin-left:20%; margin-top:-20px; float:left;'>";
	
			if (count($kitchen_photos) > 0) {			
				$count = 1;
				echo "<b>Click on a photo to remove it.</b><br />";
				echo "&nbsp; <br />";
				foreach($kitchen_photos as $photo) {
					echo "<a href='#' class='remove_photo' id='".$photo['photoID']."'><img src='images/gallery_pics/".$photo['thumb']."?".time()."' height='70' style='margin-left:8px; margin-bottom:8px;'></a>";
					if ($count % 3 == 0) {
						echo "<br />";
					}
					$count++;
				}
			} 
			
			if (count($kitchen_photos) < 6) {
				echo "<div class='button_holder_photo' style='width:100%; float:left; margin-bottom:10px; margin-top:6px; '>";
					echo "<div class='green_button add_photo' id='kitchen' style='margin-left:5px; width:160px'>";
						echo "<img src='images/addplussigngreen.png'  style='width:25px;height:25px;vertical-align:middle'>";
						echo "<span style='margin-left:8px;'>Add Photo</span>";
					echo "</div>";
				echo "</div>";

				echo "<div id='file_size_warning' style='display:none; color:red; margin-top:10px;'>";
					echo "<b>Please choose a file less than 4 MB</b>";
				echo "</div>";
				
				echo "<div id='file_type_warning' style='display:none; color:red; margin-top:10px;'>";
					echo "<b>Please choose a PNG of JPG file</b>";
				echo "</div>";																																																																																																																												
			}
			echo "</div>";
?>
			<form id="kitchen_form" action="<? echo $upload_url ?>.php?type=kitchen" method="post" enctype="multipart/form-data" style="position:absolute; top:-500px;">
			        <input type="file" id="kitchen_pic_choose" name="kitchen_pic_choose" style="">
					<input type="submit" value="Save Profile Pic" id="kitchen_upload_button"><br />
			</form>		
<?php

			echo "<div id='status' style='width:100%; color:red'></div>";				

			echo "<form id='kitchen_form_ie' action='".$upload_url."_ie.php?type=bartender' method='post' enctype='multipart/form-data' style='float:left; padding-top:30px; padding-left:10px; display:none'>";
			        echo "<h2 style='text-align:center;'>Choose a File</h2>";
			        echo "&nbsp; &nbsp; &nbsp; &nbsp; <input type='file' id='kitchen_pic_choose_ie' name='kitchen_pic_choose_ie' ><br />";
					echo "<a href='#' class='upload_cancel' id='kitchen'>Cancel</a><br />";												
			        echo "&nbsp; <br />";
					echo "&nbsp; &nbsp; &nbsp;  &nbsp; <input type='submit' value='Save Culinary Pic' id='kitchen_upload_button_ie'><br />";
					echo "<a href='#' class='upload_cancel' id='bar'>Cancel</a><br />";												
					echo "&nbsp; <br />";
					echo "<div id='status' style='color:red'></div>";	
			echo "</form>";
		}
	echo "</div>";
echo "</div>";
}
	
function profile_html_employee_settings_mobile($first_name, $last_name, $zip, $phone, $email_setting, $option) {

		$standard = "";
		$off = "";
		$one = "";
		$three = "";		
		if ($email_setting == 'Y') {
			$standard = "selected";
		} else {
			if ($option == "0") {
				$off = "selected";
			} else if ($option == "1") {
				$one = "selected";				
			} else if ($option == "3") {
				$three = "selected";
			}		
		}		
		
?>
		<div class='main_box' id="details_edit_employee" style='width:98%; float:left; margin-left:3.5%; margin-right:3.5%;'>
			<h3 style='margin-top:10px; margin-bottom:10px'>General Info & Settings</h3>
			Please review and make any necessary changes below:
				&nbsp; <br />	
				<a href='main.php?page=password'><div class='btn btn-large btn-primary' style='float:left; width:90%; text-align:center;margin-left:3px;'>CHANGE PASSWORD</div></a> 
							
				</br>
				  <div id="employee_empty_warning" class='warning' style="display:none; margin-left:10px;"><font color="red"><b>PLEASE COMPLETE ALL FIELDS</b></font></div>
				  <div id="employee_zip_warning" class='warning' style="display:none; margin-left:10px;"><font color="red"><b>PLEASE USE A VALID ZIP CODE</b></font></div>
				  <div id="employee_invalid_zip_warning" class='warning' style="display:none; margin-left:10px;"><font color="red"><b>THE ZIP CODE ENTERED IS EITHER INVALID OR A MILITARY ZIP CODE</b></font></div>
				<table width='95%'>
				<tr>
					<td><b>First Name: &nbsp; </b></td>
					<td><input type="text" name="new_first" id="first_employee" value="<? echo $first_name?>"></input></td>
				</tr>
				<tr>
					<td><b>Last Name: &nbsp; </b></td>
					<td><input type="text" name="new_last" id="last_employee" value="<? echo $last_name ?>"></input><div id="name_warning" style="display:none"></div></td>
				</tr>
				<tr>
					<td><b>Zip Code: &nbsp; </b></td>
					<td><input type="text" name="new_zip" id="zip_employee" value="<? echo $zip ?>"></input></td>
				</tr>
				<tr>
					<td><b>Contact Phone: &nbsp; </b></td>
					<td><input type="text" name="contact_phone" id="contact_phone" value="<? echo $phone ?>"></input></td>
				</tr>		
				<tr>
					<td ><b>Email Setting: </b></td>
					<td><select style='background-color:#e9e6de' id='email_setting'>
						<option value='Y' <? echo $standard ?> >Standard</option>
						<option value='1' <? echo $one ?>>Notices Off & Reminder 1 month</option>";
						<option value='3' <? echo $three ?> >Notices Off & Reminder 3 months</option>";						
						<option value='N' <? echo $off ?> >All Off</option>
						</select> 
					</td>
				</tr>
				<tr>
					<td colspan="2"><a href='#' id='more_info'>Learn More</a></td>
				</tr>
			</table>
				
			<div id='description_box' style='display:none; background-color:#DBDCCE; float:left; width:98%; margin-left:3px; margin-right:3px;'>
				<h4 style='text-align:center; margin-bottom:0px;'>Contact Phone</h4>
					Contact info will only be seen when you respond to a job post.
					
				<h4 style='text-align:center; margin-bottom:0px;'>Zip Code</h4>
					You will be matched to jobs within 40 miles of your zip code.
									
				<h4 style='text-align:center; margin-bottom:0px;'>Email Setting</h4>
				<b>Standard:</b> Receive emails when you are matched to a job, giving the best opportunity for a quick response.<br  />
				&nbsp; <br />
				<b>Notices Off & Reminder:</b> No notification of jobs that match your profile.<br />
					A single reminder will be sent in one or three months.  No other emails.<br />			
				&nbsp; <br />
				<b>All Off:</b> No notification of jobs that match your profile.<br />
					You may miss out on several opportunities.<br />			
				<a href='#' id='hide_info'><h4 style='text-align:center; margin-bottom:0px;'>Hide Info</h4></a>
			</div>
			
			<div style='width:100%; float:left; margin-left:3.5%; margin-top:10px;'>
				<div class='green_button' id='save_settings'>
					 <img src='images/savegreen.png' style="width:25px;height:25px; vertical-align: middle">
					 <span style="margin-left:4px; vertical-align: middle">Save</span>
				</div>
			</div>
			</div>
			
		</div>
<?php
}

function profile_html_employee_mobile($employee_data, $total_experience, $employee_store_type, $employee_position_experience, $employee_skills_experience, $old_employee_skills) {
//==================================
//!  First break master arrays into trait arrays
//
//  Modify any data for presentation
//==================================
		$utilities = new Utilities;
		
		$employeeID					= $_GET['ID'];

		$general_array				= $employee_data['general'];
	
		$skill_array 					= $employee_data['skills']['skills'];
		$sub_skill						= $employee_data['skills']['sub_skills']; 
		$employment_array		= $employee_data['employment'];
		$employment_version	= $employee_data['employment_version'];
		$education_array 			= $employee_data['education'];
		$language_array 			= $employee_data['language'];
		$kitchen_photo_array 	= $employee_data['kitchen_photos'];
		$bar_photo_array			= $employee_data['bar_photos'];
		$traits							= $employee_data['traits'];
		$language_array			= $employee_data['languages'];
		$awards						= $employee_data['awards'];
		$certifications				= $employee_data['certifications'];

		$quote							= $employee_data['general']['quote'];
		$description					= $employee_data['general']['description'];
		

//MAKE PHONE NUMBER READABLE
		if ($employee_data['general']['contact_phone'] == "") {
			$contact_phone = "<i>No phone entered</i>";
		} else {
			$contact_phone = substr_replace($employee_data['general']['contact_phone'] , '-', 3, 0);
			$contact_phone = substr_replace($contact_phone , '-', 7, 0);			
		}			
					
		if ($employee_data['general']['profile_pic'] == "") {
			$photo = "<b>NO PHOTO</b>";
		} else {
		//	$photo = "<img src='images/profile_pics/".$employee_data['general']['profile_pic']."' height='100' width='100'>";						
			$photo = "<img src='images/profile_pics/".$employee_data['general']['profile_pic']."?".time()."' height='100' width='100'>";						

		}
?>	
			
		<div class='edit' id='profile_menu'style='width:100%; float:left; background-color:#DBDCCE; min-height:30px;'><h4 style='margin-bottom:10px; margin-top:10px; color:#5D0000; text-align:center'>Edit Profile</h4></div>
	
		<div class='main_box' style='float:left; width:100%; padding-right:3.5%; padding-left:3.5%;'>

		<div class='edit' id='edit_photos' style='float:left; width:32%; margin-top:10px;'>
				<? echo $photo ?>
		</div>
				
			<div id='name_holder' style='width:60%; float:left; margin-left:4px; margin-right:3.5%'>
				<h4 style='color: #760006; margin-bottom:0px'><? echo $general_array['firstname'] ?> <? echo $general_array['lastname'] ?><img class='edit' id='settings' src="images/editpencil.png" alt="edit" style="height:14px; float:right; position:relative; margin-top:4px;"></h4></a>
				
				<div style='font-size:14px;'><strong><? echo $contact_phone ?></strong></div>
				
				<? echo "<div style='font-size:12px'>".$general_array['email'] ?><br />
									
<?php
		$lang_count = count($language_array);
		$count = 1;
		if ($lang_count > 0) {
			echo "<b>Languages:</b>  ";
			foreach($language_array as $row) {
				echo $row['lang'];
				if ($count != $lang_count) {
					echo ", ";
				}
				$count++;
			}
		} 
		echo "</div>";
?>
<!--
					<div id="employee_badges" style="float:left; width:100%; margin-top:2px">
					<img src="images/productgold.png" style="width:70px; position:relative">
					</div>
-->
				</div>
			</div>
	</div>
		
	<div class='main_box' id='profile_holder' style='width:100%; float:left; margin-top:4px'>		
	<div style='float:left; width:100%; background-color:#b76e1f; padding-top:8px; padding-bottom:8px;' class='edit' id='personal_menu'>
<?php
		if (count($traits) == 0) {
			echo "<span style='font-size:14px; color:#ffffff; text-align:center; padding-left:4%; padding-right:4%'>No Personality Traits Entered</span>";
		} else {
			foreach ($traits as $row) {
				echo "<div style='float:left; width:33%; height: 26px; text-align:center; font-size:12px; color:#ffffff;'><img src='images/icon-whitecheck.png' style='height:18px; position:relative; right:1px; top:4px'>".$row['trait']."</div>";
			}
		}
?>
	</div>
	
	<div style='float:left; width:100%; background-color:#e9e6de; padding-top:3.5%; padding-bottom:3.5%;' id='quote_holder'>
<?php
	if ($quote == "") {
		echo "<div style='margin-right:3.5%; margin-left:3.5%'><i>No personal quote<img class='edit' id='edit_personal_info' src='images/editpencil.png' alt='edit' style='height:14px; position:relative; left:2px; float:right'></i></div>";
	} else {
		echo "<div style='margin-right:3.5%; margin-left:3.5%'><i>".$quote."</i><img class='edit' id='edit_personal_info' src='images/editpencil.png' alt='edit' style='height:14px; position:relative; left:2px; float:right'></div>";		
	}
?>		
	</div>
	
	<div style='float:left; width:97%;'>
		<div class='employee_profile_header' style=''>Experience<img class='edit' id='work_skills_menu' src='images/whitepencil.png' alt='edit' style='height:14px; position:relative; top:4px; float:right; margin-right:3.5%'></div> 
		
	</div>
	
	<div style='float:left; width:100%; margin-left:3.5%; margin-right:3.5%;'>
		<table class='dark'>
<?php
		if ($total_experience['hospitality'] > 0) {
			echo "<tr>";
				echo "<td width='45%'><strong>Hospitality:</strong></td>";
				echo "<td>".$total_experience['hospitality']." yrs</td>";
			echo "</tr>";	
		}
	
		if ($total_experience['other'] > 0) {
			echo "<tr>";
				echo "<td width='45%'><strong>Other:</strong></td>"; 
				echo "<td>".$total_experience['other']." yrs</td>";
			echo "</tr>";
		}
		
		if ($total_experience['unknown'] > 0) {
			echo "<tr>";
				echo "<td width='45%'><strong>Unknown:</strong> <br /><a href='employee.php?page=work_skills_menu'>Verify Exp. Type</a></td>"; 
				echo "<td>".$total_experience['unknown']." yrs</td>";
			echo "</tr>";
		}
		
	if (count($employee_store_type) > 0) {
			echo "<tr>";
				echo "<td width='45%'><strong>Experience Type: </strong></td>";
				echo "<td>";
				foreach($employee_store_type as $key=>$row) {
				echo $key.": <a href='employee.php?page=work_skills_menu'>".$row." yrs</a> <br>";
			
		}
				echo"</td>";
			echo "</tr>";
	}

		echo "<tr>";
			echo "<td width='45%'><strong>Positions held: </strong></td>";
		echo "<td>";
		if (count($employee_position_experience) > 0) {
			foreach($employee_position_experience as $key=>$row) {
				echo "<a href='employee.php?page=work_skills_menu'>".$key.": ".$row."</a> <br />";
			}
		} else {
			echo "NONE";
		}	
		echo "</td>";
			echo "</tr>";
?>
		</table>
	</div>
	
	<div style='float:left; width:97%;'>
		<div class='employee_profile_header'>Skills</div>
		<img class='edit' id='work_skills_menu' src='images/whitepencil.png' alt='edit' style='height:14px; position:relative; top:-26px; float:right;'>
	</div>
	
	<div style='float:left; margin-left:3.5%;'>
<?php
	if (count($employee_skills_experience['gold']) > 0) {
		echo "<img src='images/gold.png' alt='5+ yrs' style='height: 44px'><div class='gold_skills'>5+ Years of Experience </div>";
		
		echo "<table class='dark' style='margin-top:10px; margin-right:3.5%'>";
		foreach($employee_skills_experience['gold'] as $key=>$row) {
			echo "<tr>";
				echo "<td width='45%'><strong><a href='employee.php?page=work_skills_menu'>".$key."</td>";
				echo "<td>".$row." yrs </td>";
			echo "</tr>";
		}
		echo "</table>";			
	} 
	
	if (count($employee_skills_experience['silver']) > 0) {
		echo "<img src='images/silver.png' alt='2-5 yrs' style='height: 44px'><div class='silver_skills'>2-5 Years of Experience</div>";
		echo "<table class='dark' style='margin-top:10px; margin-right:3.5%'>";
		foreach($employee_skills_experience['silver'] as $key=>$row) {
			echo "<tr><td width='45%'><strong><a href='employee.php?page=work_skills_menu'>".$key."</td>";
			echo "<td>".$row." yrs </td></tr>";
		}
		echo "</table>";			
	} 

	if (count($employee_skills_experience['bronze']) > 0) {
		echo "<img src='images/bronze.png' alt='0-2 yrs' style='height: 44px'><div class='bronze_skills'>0-2 Years of Experience</div>";
		echo "<table class='dark' style='margin-top:10px; margin-right:3.5%'>";
		foreach($employee_skills_experience['bronze'] as $key=>$row) {
			echo "<tr><td width='45%'><strong><a href='employee.php?page=work_skills_menu'>".$key."</td>";
			echo "<td>".$row." yrs </td></tr>";
		}
		echo "</table>";
	} 	
	
	if (count($old_employee_skills) > 0) {
		echo "<div class='old_skills' style='margin-top:10px;'>Other Skills </div>";
		echo "<div style='float:left; width:80%; margin-left:2%; margin-right:3.5%; color:#8e8e8e'>";
		foreach($old_employee_skills as $row) {
			echo $row.", ";
		}
		echo "</div>";		
	}
	
	if (count($employee_skills_experience['bronze']) == 0 && count($employee_skills_experience['silver']) == 0 && count($employee_skills_experience['gold']) ==0 && count($old_employee_skills) == 0) {
		echo "<table class='dark' style='margin-top:2%'>";
			echo "<tr>";
				echo "<td>No Skills Entered</td>";	
			echo "</tr>";
		echo "</table>";
	}
	
	echo "</div>";

//PHOTOS

	if (count($kitchen_photo_array) > 0) {				
		echo "<div style='float:left; width:100%;'>";
			echo "<div class='photo_skills'>Kitchen Photos </div>";
			echo "<img class='edit' id='edit_photos' src='images/whitepencil.png' alt='edit' style='height:14px; position:relative; top:-26px; float:right; margin-right:3.5%'>";
			echo "<table style='width:100%;'>";
				echo"<tr>";
					echo "<th style='line-height:1px; background-color:#e9e6de'>&nbsp; </th>";
				echo"</tr>";
			echo "</table>";	
			foreach($kitchen_photo_array as $photo) {
				echo "<div style='float:left; margin-top:-5px; margin-bottom:14px; margin-left: 1%; width:15.6%'><a href='images/gallery_pics/".$photo['photo']."'><img src='images/gallery_pics/".$photo['thumb']."' height='55' style='margin-left:0px; margin-bottom:0px;'></a></div>";
			}
		echo "</div>";
	} 

	if (count($bar_photo_array) > 0) {				
		echo "<div style='float:left; width:100%;'>";
			echo "<div class='photo_skills'>Bar Photos </div>";
			echo "<img class='edit' id='edit_photos' src='images/whitepencil.png' alt='edit' style='height:14px; position:relative; top:-26px; float:right; margin-right:3.5%'>";
			echo "<table style='width:100%;'>";
				echo"<tr>";
					echo "<th style='line-height:1px; background-color:#e9e6de'>&nbsp; </th>";
				echo"</tr>";
			echo "</table>";	
			foreach($bar_photo_array as $photo) {
				echo "<div style='float:left; margin-top:-5px; margin-bottom:14px; margin-left:1%; width:15.6%'><a href='images/gallery_pics/".$photo['photo']."'><img src='images/gallery_pics/".$photo['thumb']."' height='55' style='margin-left:0px; margin-bottom:0px;'></a></div>";
			}
		echo "</div>";
	} 
?>

	<div style='float:left; width:97%;'>
		<div class='employee_profile_header'>Past Employment</div>
		<img class='edit' id='work_skills_menu' src='images/whitepencil.png' alt='edit' style='height:14px; position:relative; top:-26px; float:right;'>
	</div>
	
	<div style='float:left; width:100%; margin-left:3.5%; margin-right:3.5%;'>
<?php
		echo "<table class='dark'>";	
		if (count($employment_array) > 0) {			
			foreach ($employment_array as $row) {				
				$start_date = $utilities->convert_month($row['start_month'])." ".$row['start_year'];
				if ($row['current'] == 'Y') {
					$end_date = 'Current';
				} else {
					$end_date = $utilities->convert_month($row['end_month'])." ".$row['end_year'];					
				}

				if ($end_date != "Current") {
					$end_time = $row['end_year'] + $row['end_month']/12;
					$start_time = $row['start_year'] + $row['start_month']/12;

					$total = $end_time - $start_time;
					$denominator = 4;
				    $x = $total * $denominator;
				    $x = floor($x);
				    $x = $x / $denominator;
				    								
					$time = "(".$x." yrs)";
				} else {
					$time = "";
				}
				
				echo "<tr>";
					echo "<td width='45%;'><b>".$row['company']."</b>".$indicator." <br />".$row['position']."</td>";
					echo "<td>".$start_date." - ".$end_date."<br /><i>".$time."</i></td>";
				echo "</tr>";
			}
		} else {
			echo "<tr>";
				echo "<td>No Past Employment Entered.</td>";
			echo "</tr>";
		}	
		echo "</table>";		
?>
	</div>

	<div style='float:left; width:97%;'>
		<div class='employee_profile_header'>Education</div>
		<img class='edit' id='education_menu' src='images/whitepencil.png' alt='edit' style='height:14px; position:relative; top:-26px; float:right;'>
	</div>
	
	<div style='float:left; width:100%; margin-left:3.5%; margin-right:3.5%;'>
<?php
	echo "<div style='width:100%; float:left; margin-top:-10px;'>";
	echo "<table class='dark'>";	
	
	if (count($education_array) > 0) {
		foreach ($education_array as $row) {
			echo "<tr>";
			echo "<td style='width:45%;'><b>".$row['school']."</b></td>";				
			echo "<td style='word-wrap: break-word;'>".$row['degree']."</td>";
			echo "</tr>";
		}
	} else {
		echo "<tr>";
			echo "<td>No Education Entered.</td>";
		echo "</tr>";
	}
	
	echo "</table>";
	
	echo "</div>";	
?>
	</div>
	
	<div style='float:left; width:97%;'>
		<div class='employee_profile_header'>Certifications & Awards</div>
		<img class='edit' id='education_menu' src='images/whitepencil.png' alt='edit' style='height:14px; position:relative; top:-26px; float:right;'>
	</div>
		
	<div style='float:left; width:100%; margin-left:3.5%; margin-right:3.5%;'>
<?php
		echo "<div style='width:100%; float:left; margin-top:-10px;'>";
			echo "<table class='dark'>";
			if (count($awards) > 0) {
				echo "<tr>";
					echo "<td><h4>AWARDS</h4></td>";
				echo "</tr>";
					
				foreach ($awards as $row) {
					echo "<tr>";
						echo "<td style='word-wrap: break-word;'>".$row['award']."</td>";
					echo "</tr>";
				}
			}
			
			if (count($certifications) > 0) {
				echo "<tr>";
					echo "<td><h4>CERTIFICATIONS</h4></td>";
				echo "</tr>";
					
				foreach ($certifications as $row) {
					echo "<tr>";
						echo "<td style='word-wrap: break-word;'>".$row['certification']."</td>";
					echo "</tr>";
				}
			}
			

		if (count($certifications) == 0 && count($awards) == 0) {
			echo "<tr>";
				echo "<td>No Certifications or Awards Entered.</td>";
			echo "</tr>";
		}	
		echo "</table>";
	echo "</div>";		
?>
	</div>
	
	<div style='float:left; width:97%'>
		<div class='employee_profile_header'>General Description</div>
		<img class='edit' id='edit_personal_info' src='images/whitepencil.png' alt='edit' style='height:14px; position:relative; top:-26px; float:right;'>
	</div>
	
	<div style='float:left; width:100%; margin-left:3.5%; margin-right:3.5%;'>
<?php
	echo "<div style='margin-left:2%; margin-right:3.5%; margin-bottom:3.5%; color:#8e8e8e'>";
		echo $description;
	echo "</div>";	

echo "</div>";
}


function profile_html_employee_mobile_old($member_data, $employee_data, $employment_gaps) {		
$utilities = new Utilities;
//!!!!!!!CHANGE THIS FOR LIVE SITE!!!!!!!
$site_type = $utilities->site_type;
if ($site_type == "live") {
	$upload_url = "http://servebartendcook.com/upload_pic";
} elseif ($site_type == "prototype") {
	$upload_url = "http://threewhitebirds.com/SBC/upload_pic";	
}


//==================================
//!  First break master arrays into trait arrays
//
//  Modify any data for presentation
//==================================

		$general_employee_array	= $employee_data['general'];
		$skill_array 						= $employee_data['skills']['skills'];
		$sub_skill							= $employee_data['skills']['sub_skills']; 
		$employment_array		 	= $employee_data['employment'];
		$employment_version		= $employee_data['employment_version'];
		$education_array 				= $employee_data['education'];
		$language_array 				= $employee_data['languages'];
		$video_array 					= $employee_data['video'];
		$kitchen_photo_array 		= $employee_data['kitchen_photos'];
		$bar_photo_array				= $employee_data['bar_photos'];
				
		if ($employment_version == "new" && count($employment_array) > 0) {
			$new_employment_array = $utilities->reorder_employment($employment_array);
		}					

//MAKE PHONE NUMBER READABLE
		if ($general_employee_array['contact_phone'] == "") {
			$contact_phone = "<i>No phone entered</i>";
		} else {
			$contact_phone = substr_replace($general_employee_array['contact_phone'] , '-', 3, 0);
			$contact_phone = substr_replace($contact_phone, '-', 7, 0);			
		}			

		if ($employee_data['general']['profile_pic'] != "") {			
			$photo = "<img src='images/profile_pics/".$employee_data['general']['profile_pic']."' height='100px' width='100px'>";						
		} else {
			$photo = "";						
		}
		
		if (count($employment_gaps) > 0) {
			$employment_gap_warning = "<div style='width:100%; float:left; margin-top:-10px; margin-bottom:3px; margin-left:3px; margin-right:3px;'><font color='red'><b>! NOTICE:  You have gaps in your past employment list greater than 3 months.</b></font></div>";
		} else {
			$employment_gap_warning = "";
		}	
		if ($general_employee_array['email_setting'] == 'Y') {
			$email_setting = "Standard";
		} else {
			$email_setting = "<font color='red'>OFF</font>";			
		}
				
/*******************
*
*  Profile HTML - Employee
*
********************/

?>	
	<div class='main_box' style=' float:left; width:100%;'>

		<div style='float:left; width:100%'>
			<div id='photo_buttons' style='float:right; width:100%; margin-bottom:5px; text-align:center;'>
				<div style='width:33%; float:left; background-color:#DBDCCE; min-height:30px; margin-right:1px;'><a href='employee.php?page=edit_details' id='profile' style='color:#5D0000'><h4 style='margin-bottom:10px; margin-top:10px;'>Edit General</h4></a></div>
				<div style='width:33%; float:left; background-color:#DBDCCE; min-height:30px; margin-right:1px;'><a href='employee.php?page=edit_photo&type=menu' id='profile' style='color:#5D0000'><h4 style='margin-bottom:10px; margin-top:10px;'>Edit Photos</h4></a></div>
				<div style='width:33%; float:left; background-color:#DBDCCE; min-height:30px;'><a href='employee.php?page=video' id='profile' style='color:#5D0000'><h4 style='margin-bottom:10px; margin-top:10px;'>Edit Video</h4></a></div>
			</div>
			
			<div id="name_holder" style="width:50%; padding-left:10px; float:left;">
				<b style='font-size:15pt; color: #760006;'><? echo $member_data['firstname'] ?> <? echo $member_data['lastname'] ?></b><br />
				<b><? echo $contact_phone ?></b><br />
				<? echo $member_data['email'] ?><br />		
<?php
				$lang_count = count($language_array);
				$count = 1;
				if ($lang_count > 0) {
					echo "<b>Languages:</b>  ";
					foreach($language_array as $row) {
						echo $row['lang'];
						if ($count != $lang_count) {
							echo ", ";
						}
						$count++;
					}
				} 
?>
			<br /><b>Email Setting:</b> <? echo $email_setting ?> 		
		</div>
			
			<div id="photo_holder" style="margin-right:5px; float:right;">
				<? echo $photo ?>
			</div>
		</div>					
					
<?php		
		echo "&nbsp; <br />";
		echo $employment_gap_warning;
				
		echo "</div>";
?>		
	
			</div>
			</div>
			
		</div>
				
	<div id='profile_holder' style='float:left; width:100%;'>	

	<table class='dark' style='width:100%;'>
		<tr valign='middle'>
			<th valign='middle' align='left' ><span style='float: left;'>Skills</span></th>
			<th style='text-align:center; background-color:#DBDCCE; color:#5D0000; width:75px;'><a href='employee.php?page=edit_skills'><span style='color:#5D0000;'>EDIT</span></a></th>
		</tr>
	</table>
				
<?php
		$skill_counter = 0;
			foreach ($skill_array as $row) {
				$sub_skill_array = array();
				foreach($sub_skill as $sub) {
					if ($sub['skillID'] == $row['skillID']) {
						$sub_skill_array[] = $row['sub_skill'];
					}
				}
			
				if ($row['seeking'] == "Y") {			
					$seeking = "Seeking";
				} else {
					$seeking = "Not Seeking";						
				}
			
				if ($row['skill'] == "Manager") {				
					$icon = "<img src='images/main-manager.png' width='100'>";	
					$photo_bar = "";
				} elseif ($row['skill'] == "Bartender") {
					$icon = "<img src='images/main-bar.png' height='100'>";																							
					$input_array = array($profileID, "bartender");
					$photo_gallery = $bar_photo_array;

					if (count($photo_gallery) > 0) {				
						$photo_bar = "<div style='float:left; width:100%;'>";
						$photo_bar = "<div style='float:left; width:100%;'>";
						$photo_bar .= "<table style='width:100%;'>";
						$photo_bar .= "<tr>";
						$photo_bar .= "<th style='line-height:1px; background-color:#e9e6de'>&nbsp; </th>";
						$photo_bar .= "</tr>";
						$photo_bar .= "</table>";	
						foreach($photo_gallery as $photo) {
							$photo_bar .= "<div style='float:left; margin-top:-5px; margin-bottom:14px; width:16.6%'><a href='employee.php?page=edit_photo&type=bar'><img src='images/gallery_pics/".$photo['thumb']."' height='55' style='margin-left:0px; margin-bottom:0px;'></a></div>";
						}
						$photo_bar .= "</div>";
					} else {	
						$photo_bar = "";				
					}
					
				} elseif ($row['skill'] == "Kitchen") {
					$icon = "<img src='images/main-cook.png' height='100'>";										
					$input_array = array($profileID, "kitchen");
					$photo_gallery = $kitchen_photo_array;

					if (count($photo_gallery) > 0) {					
						$photo_bar = "<div style='float:left; width:100%;'>";
						$photo_bar .= "<table style='width:100%;'>";
						$photo_bar .= "<tr>";
						$photo_bar .= "<th style='line-height:1px; background-color:#e9e6de'>&nbsp; </th>";
						$photo_bar .= "</tr>";
						$photo_bar .= "</table>";	
 
						foreach($photo_gallery as $photo) {
							$photo_bar .= "<div style='float:left; margin-top:-5px; margin-bottom:14px; width:16.6%'><a href='employee.php?page=edit_photo&type=kitchen'><img src='images/gallery_pics/".$photo['thumb']."' height='55' style='margin-left:0px; margin-bottom:0px;'></a></div>";
						}
						$photo_bar .= "</div>";						
					} else {	
						$photo_bar = "";																							
					}
				} elseif ($row['skill'] == "Server") {
					$icon = "<img src='images/main-server.png' height='100'>";		
					$photo_bar = "";								
				} elseif ($row['skill'] == "Host") {
					$icon = "<img src='images/main-host.png' height='100'>";		
					$photo_bar = "";								
				} elseif ($row['skill'] == "Bus") {
					$icon = "<img src='images/main-bus.png' height='100'>";	
					$photo_bar = "";																							
				} else {
					$margin = "0px";					
				}
				
				echo "<div style='float:left; width:100%; margin-bottom:3px;'>";
					echo "<div style='float:left; width:33%'>";
						echo "<h4 style='color:#760006; margin-left:5px; margin-bottom:0px;'>".$row['skill']."</h4>";
					echo "</div>";				
					echo "<div style='float:left; width:33%'>";
						echo "<h4 style='color:#760006; margin-left:5px; margin-bottom:0px;'>Exp: ".$row['experience']." YRS</h4>";
					echo "</div>";
					echo "<div style='float:right; text-align:right; width:33%'>";
						echo "<h4 style='color:#760006; margin-right:5px; margin-bottom:0px;'>".$seeking."</h4>";
					echo "</div>";	
				echo "</div>";

				echo "<table style='width:100%;'>";
				echo "<tr>";
				echo "<th style='line-height:1px; background-color:#e9e6de'>&nbsp; </th>";
				echo "</tr>";
				echo "</table>";	

				
				echo "<div style='float:left; margin-bottom:5px; width:100%; '>";
					echo "<div style='float:left; width:30%; min-height:100px; margin-bottom:5px;'>";
					echo $icon;
					echo "</div>";
				echo "<div style='float:left; margin-top:-3px; margin-left:3px; width:65%;'>";
				echo "<table cellspacing='10' class='holder_".$row['skill']."' style='color:#868686'>";
					$count = 1;
					$sub_skill_array = $sub_skill[$row['skillID']];					
					if(count($sub_skill_array) > 0) {
						foreach ($sub_skill_array as $sub) {
							if ($count%2 != 0) {
								echo "<tr><td>&#149;".$sub['sub_skill']."</td>";
							} else {
								echo "<td>&#149;".$sub['sub_skill']."</td></tr>";								
							}
							$count++;
						}
						if ($count%2 != 0) {
							echo "</tr>";
						}
					}
					
				echo "</table>";

	echo "</div>";
	
	
	echo "</div>";
				
				echo $photo_bar;
	
				echo "<div class='holder_".$row['skill']."' style='width:100%; float:left; margin-top:-15px; margin-bottom:0px;'>";

				echo "<table style='width:100%;'>";
				echo "<tr>";
				echo "<th style='line-height:1px; background-color:#e9e6de'>&nbsp; </th>";
				echo "</tr>";
				echo "</table>";


			if ($row['description'] != "") {
				echo "<div style='float:left; width:100%; margin-top:5px; margin-bottom:5px;'><div style='float:left; margin-left:5px; margin-right:5px;'>".$utilities->mynl2br($row['description'])."</div></div>";
			}
			
			$skill_counter++;			
			
			if ($skill_counter != count($skill_array)) {	
				echo "<table style='width:100%; background-color:#8e080b'>";
				echo "<tr>";
				echo "<th style='line-height:1px;'>&nbsp; </th>";
				echo "</tr>";
				echo "</table>";
			}
					
		echo "</div>";					
	}

	echo "<table class='dark' style='width:100%;'>";
	echo "<tr valign='middle'>";
	echo 	"<th valign='middle' align='left' ><span style='float: left;'>Employment</span></th>";
	echo	"<th style='text-align:center; background-color:#DBDCCE; color:#5D0000; width:75px;'><a href='employee.php?page=edit_employment'><span style='color:#5D0000;'>EDIT</span></a></th>";
	echo "</tr>";
	echo "</table>";

	//clean this up later
	echo "<div style='width:100%; float:left;'>";	
	switch($employment_version) {
		case "empty":
			no_past_employment_mobile();		
		break;
		
		case "old":
			old_past_employment_mobile($employment_array);
		break;
		
		case "new":
			new_past_employment_mobile($new_employment_array, $employment_gaps);		
		break;
	}	
	echo "</div>";
	echo "</br>";

	echo "<table class='dark' style='width:100%;'>";
	echo "<tr valign='middle'>";
	echo	"<th valign='middle' align='left' ><span style='float: left;'>Education</span></th>";
	echo	 "<th style='text-align:center; background-color:#DBDCCE; color:#5D0000; width:75px;'><a href='employee.php?page=edit_education'><span style='color:#5D0000;'>EDIT</span></a></th>";
	echo "</tr>";
	echo "</table>";

	if (count($education_array) > 0) {
		echo "<div style='width:100%; float:left;'>";
			echo "<table cellpadding='12' style='margin-left:5px; table-layout:fixed; width:100%'>";	
			foreach ($education_array as $row) {
				echo "<tr>";
				echo "<td style='width:50%;'><b>".$row['school']."</b></td>";				
				echo "<td align='center' style='word-wrap: break-word;'>".$row['degree']."</td>";
				echo "</tr>";
			}
			echo "</table>";
		echo "</div>";
	} else {
			echo "No education added. <br />";
	}
	echo "</div>";
	
	echo "<table class='dark' style='width:100%;'>";
	echo "<tr valign='middle'>";
	echo	"<th valign='middle' align='left'> &nbsp; </th>";
	echo "</tr>";
	echo "</table>";
		
}

function profile_html_bounty_list_mobile($employee_data, $current_bounties, $closed_bounties, $collected, $potential) {
	$collected_width = $collected / 6;
	
?>
<!--
	<div 'bounty_buttons' style='float:right; width:100%; margin-bottom:5px; margin-top:0px; text-align:center;'>
		<div style='width:49.75%; float:left; background-color:#DBDCCE; min-height:30px; margin-right:1px;'><a href='#' id='current_bounties' style='color:#5D0000'><h4 id='filter_text' style='margin-bottom:10px; margin-top:10px;'>Open</h4><h4 id='cancel_text' style='margin-bottom:10px; margin-top:10px; display:none;'>Cancel</h4></a></div>
		<div style='width:49.75%; float:left; background-color:#DBDCCE; min-height:30px;'><a href='#' id='expired_bounties' style='color:#5D0000'><h4 style='margin-bottom:10px; margin-top:10px;'>Closed</h4></a></div>
	</div>
-->

	<div id="main-page" class='main_box' style="float:left; width:100%; margin-top:5px;">
		<div id='opportunity_list_header'>
			<h3 style='text-align:center'>Your Pending Bounties</h3>
			
			<div style='float:left; width:100%; margin-top:10px; margin-left:1.5%'>			
				<b>You have collected &dollar;<? echo $collected ?> in bounties this year.</b><br />
				<b>Current Potential Bounties: &dollar;<? echo $potential ?></b><br />
				<a href='main.php?page=bounty_faq'>Learn More about Bounties</a><br />
				
			</div>
			<div style='float:left;'>
			<table class="dark" style="width:100%;">
				<tr>
					<th style="width: 40%; background-color:#2e6552">Position</th>
					<th align='right' style="width: 40%; background-color:#2e6552;">Recommended</th>
					<th align='center' style="width: 20%; background-color:#2e6552">Status</th>
				</tr>	
			</table>
<?php
				
	echo "<div id='current_response_holder'>";
		echo "<table class='dark' id='current_table' style='width:100%;'>";
		
		if (count($current_bounties) > 0) {
			foreach($current_bounties as $row) {	
				if ($row['bounty_status'] == "closed" && $row['recommend_status'] != "Hired" && $row['recommend_status'] != "Earned") {
					$row['recommend_status'] = "Closed";
				} elseif ($row['recommend_status'] == "Hired") {
					//this means that the employer has reported the recommended candidate was hired
					//we have not yet payed the bounty so the status will be "Pending"
					//the status is changed manually to 'Earned' after the bounty is paid
					$row['recommend_status'] = "Pending*";					
				}		

				echo "<tr>";
					echo "<td style='width:30%'><a href='opportunity.php?ID=".$row['jobID']."&hash=".$row['public_hash']."'>".$row['title']."</a><br />".$row['name']."</a>";
					echo "<td style='width:40%' align='center'>".$row['firstname']." ".$row['lastname']."</td>";
					echo "<td style='width: 15%;' align='center'>$".$row['bounty']."<br />".$row['recommend_status']."</td>";
				echo "</tr>";	
			}	
		} else {
			echo "<tr><td colspan='3'>You haven't recommended anyone for a job.  No pending bounties.</td></tr>";	
		}	
		echo "</table>";

		echo "<div style='float:left; width99%; margin-left:3px'>";
			echo "<i>*If you have a status that says 'Pending' or 'Earned' you should receive an email from ServeBartendCook regarding bounty payment.</i><br />";
			echo "<i>&nbsp; <br />Please contact us at admin@servebartendcook.com with questions.</i>";
		echo "</div>";
		
		echo "</div>";	
		
	echo "<div id='archive_response_holder' style='display:none;'>";
		echo "<table class='dark'>";
		if (count($closed_bounties) > 0) {
			foreach($closed_bounties as $row) {
				echo "<tr>";
					echo "<td style='width:30%'><a href='opportunity.php?ID=".$row['jobID']."&hash=".$row['public_hash']."'>".$row['title']."</a><br />".$row['name']."</a>";
					echo "<td style='width:40%' align='center'>".$row['firstname']." ".$row['lastname']."</td>";
					echo "<td style='width: 15%;' align='center'>$".$row['bounty']."<br />".$row['recommend_status']."</td>";
				echo "</tr>";	
			}	
		} else {
			echo "<tr><td colspan='3'>No closed bounties on your list.</td></tr>";	
		}	
		echo "</table>";

		echo "<i>*If you have a link that says 'Pending' or 'Earned' you should receive an email from ServeBartendCook regarding bounty payment.</i><br />";
		echo "&nbsp; <br /><i>Please contact us at admin@servebartendcook.com with questions.</i>";
	
		echo "</div>";	
	echo "</div>";
	
}

function profile_html_interview_list_mobile($employee_data, $interview_list) {
?>	
	<div id='interview_table_holder'>

		<div style="float:left; width:100%; margin-top:5px; margin-left:5px; text-align: center;">
			<h3>My Interviews</h3>			
		</div>

		<table class="dark" style="width:100%;">
			<tr>
				<th style="width: 45%;">Position</th>
				<th style="width: 35%;">Date</th>
				<th style="width: 20%;">CANCEL</th>
			</tr>	
		</table>
<?php
		if (count($interview_list['upcoming']) > 0) {
			foreach ($interview_list['upcoming'] as $row) {
				switch($row['status']) {
					default:
						$status = "<a href='#' class='show_cancel_interview' data-interview='".$row['interviewID']."'>Cancel Interview?</a>";
					break;
					
					case "employee_cancel":
					case "view_employee_cancel":					
						$status = "<font color='red'>CANCELED</font><br/><i>You canceled this interview</i>";
					break;
					
					case "employer_cancel":
					case "view_employer_cancel":					
						$status = "<font color='red'>CANCELED</font><br/><i>The Employer canceled this interview</i>";
					break;					
				}

				echo "<table class='dark' style='width:100%'>";
					echo "<tr>";
						echo "<td width='45%;'><a href='opportunity.php?ID=".$row['jobID']."&hash=".$row['public_hash']."'>".$row['title']."</a><br />".$row['name']."</td>";
						echo "<td width='35%;'>".date("F j, Y, g:i a", strtotime($row['interview_date']))."</td>";
						echo "<td align='center' width='20%;'>".$status."</td>";								
					echo "</tr>";
				echo "</table>";
			}	
		} 
		
		if (count($interview_list['past']) > 0) {
			foreach ($interview_list['past'] as $row) {
				echo "<table class='dark' style='width:100%'>";
					echo "<tr>";
						echo "<td width='45%;'><a href='opportunity.php?ID=".$row['jobID']."&hash=".$row['public_hash']."'>".$row['title']."</a><br />".$row['name']."</td>";
						echo "<td width='35%;'>".date("F j, Y, g:i a", strtotime($row['interview_date']))."</td>";
						echo "<td width='20%;'>DATE PASSED</td>";	
					echo "</tr>";
				echo "</table>";
			}	
		} 	
		
		if (count($interview_list['upcoming']) == 0 && count($interview_list['past']) == 0) {
			echo "<h4>No Current Interview Reminders</h4>";
		}
	echo "</div>";

	if (count($interview_list['upcoming']) > 0) {	
		foreach ($interview_list['upcoming'] as $row) {
			echo "<div class='cancel_holder' id='".$row['interviewID']."' style='float:left; width:99%; margin-left:4px; margin-right:3px; display:none'>";
				echo "<h3 style='text-align:center; margin-bottom:10px;'>Cancel Interview?</h3>";
				echo "<h4 style='margin-bottom:10px;'>Do you want to cancel your interview with ".$row['name']." for the position: ".$row['title']."?</h4><br />";
				echo  "<b>".$row['name']." will be notified that you have canceled you interview.  You do not need to provide a reason.</b><br /> &nbsp; <br />";

					echo "<a href='#' class='save_cancel' style='color:#760006' id=".$row['matchID']."><img src='images/declinex.png' 'height=40px; width=40px;' style='position:relative; top:16px'>Confirm Interview Cancellation</a><br />";
				echo "<br /> &nbsp; <a href='#' class='go_back'>BACK</a><br />";
			echo "</div>";
		}
	}
	
}


function no_past_employment_mobile() {
	echo "No Previous Employment Information Added<br />";	
}

function profile_html_type_switch_mobile() {	
	
	echo "<div class='main_box' style='margin-top:70px; '>";				
	
		echo "<div style='width:100%; margin-left:2px; margin-right:2px;'>";

			echo "&nbsp; <br />";		
			echo "You have signed up for a Job-Seeker/Employee account.  This account type is for members looking for open jobs.<br />";
			echo "&nbsp; <br />";
			echo "If you are an Employer (Manager, HR Representative, etc.) and wish to post jobs on the site, you can switch your account type by filling out the info below.";	
			echo "&nbsp; <br />";
	
			echo "<div id='empty_warning' class='warning' style='display:none; width:100%; text-align:center;'><font color='red'><b>Please complete required fields</b></font></div>";
			echo "<div id='permission_warning' class='warning' style='display:none; width:100%; text-align:center;'><font color='red'><b>You must check the box below to continue</b></font></div>";
			echo "<div id='other_warning' class='warning' style='display:none; width:100%; text-align:center;'><font color='red'><b>There was a problem processing your request, please contact admin@servebartendcook.com</b></font></div><br />";
	
			
			echo "<b>Company:</b> <input type='text' id='company' name='company' size='16' /><br />"; 
			echo "&nbsp; <br />";
			echo "<b>Your Title:</b> <input type='text' id='position' name='position' size='16' placeholder='owner, manager, etc' /><br />";       
			echo "<input type='checkbox' id='permission' value='18'>";
			echo "<div style='font-size: 11px;'><b>I certify that I represent the company entered below and have the right and/or permission to make hiring decisions or recommendations.</b></div>";
			echo "<div style='float:left; margin-top:20px; margin-bottom: 20px; width:100%'><a href='#' class='btn btn-large btn-primary' id='change_account_type'>Change Account Type</a></div>";					
	
		echo "</div>";
	echo "</div>";
}

function breadcrumb($number, $text_a, $link_a, $text_b, $link_b) {

	$class_two = "menu_block";
	$class_three= "menu_block";
	$arrow_two = "menu_arrow_right";
	$arrow_three = "menu_arrow_right";	

	if ($number == 1) {
		$class_two = "menu_block_gray";
		$class_three= "menu_block_gray";
		$arrow_three = "menu_arrow_right_gray";	
	}
	
	if ($number == 2) {
		$class_three= "menu_block_gray";
	}
	
?>
	<div style='width:100%; float:left;'>
		<a href='employee.php?page=profile_menu'><div class='menu_block'>Profile Menu</div></a>
	
		<a href='<? echo $link_a ?>'><div class='<? echo $class_two ?>'>
			<div class='<? echo $arrow_two ?>'></div>
			<div class='menu_arrow_filler'></div>
			<div class='menu_arrow_space'></div>		
			<?php echo $text_a ?>
		</div></a>

		
		<a href='<? echo $link_b ?>'><div class='<? echo $class_three ?>'>
			<div class='<? echo $arrow_three ?>'></div>
			<div class='menu_arrow_filler'></div>
			<div class='menu_arrow_space'></div>			
			<?php echo $text_b ?>
		</div></a>
	
	</div>		
<?php
}