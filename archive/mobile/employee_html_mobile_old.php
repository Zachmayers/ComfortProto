<?php
	

//HOLDER FOR NEW PROFILE CREATION PAGES ONLY EDIT FUNCTION UNTIL THE "END NEW PAGES" HOLDER

function profile_html_employee_splash_mobile($member_data, $email_verification) {
		if ($email_verification == "N") {
			$verification_note = "<h4><font color='red'>NOTICE:</font>  <a href='main.php?page=verify_email'>You still need to verify your email address before applying to any jobs.</a></h4>";
		} else {
			$verification_note = "";
		}	

		echo "<div id='splash_box' style='float:left; text-align:center; width:99%; margin-right:7px;'>";		

			echo "<h3 style='text-align:center; margin-top:5px; margin-bottom:3px;'>WELCOME</h3>";
			echo "<div id='welcome_text' style='width:100%; margin-left:3px; margin-right:3px; margin-bottom:5px; text-align:center'>";
			echo "<font-color='#760006'>We're ready to match you with the jobs you want.  All you need to do is create a profile.</font><br />";
			echo "</div>";
			echo "&nbsp; <br />";
			echo "&nbsp; <br />";
			
			echo "<a href='employee.php?page=profile_menu' class='btn btn-large btn-warning'>Let's Get Started!</a><br />";
			echo "&nbsp; <br />";

			echo "<a href='employee.php?page=switch_account'>Are you an Employer here to post jobs?  Click Here</a>";
			echo "&nbsp; <br />";
			echo "&nbsp; <br />";

			echo $verification_note;
		
		echo "</div>";
}

function profile_employee_menu_mobile($email_verification, $completion_percent, $profile_status, $experience_complete, $education_complete, $personal_complete) {
?>
	<div style=' float:left; width:100%; padding-right:3.5%; padding-left:3.5%'>
		<div style='float:left; width:100%;'>
			
			<h2 style='margin-bottom:10px; margin-top:10px; color:black'>Profile <? echo $completion_percent ?>% Complete</h2><i>We need a graphic here</i>	

			<div class='warning' id='skill_warning' style='color:red; display:none;'>You must complete at least the Skills & Experience section to view and respond to job openings.</div>
			
		<div id='experience_button' style='width:100%; float:left;'>
				<div style='width:3%; float:left'><img src="images/frontofhouse.png" alt="menu" style="position: relative; bottom: 12px; height:80px"></div>
				<div id='experience_main_button' class='unselected_job_areas'>Experience & Skills<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'><? echo $experience_complete ?></span>
				</div>
		</div>

		<div id='education_button' style='width:100%; float:left;'>
				<div style='width:3%; float:left'><img src="images/frontofhouse.png" alt="menu" style="position: relative; bottom: 12px; height:80px"></div>
				<div id='experience_main_button' class='unselected_job_areas'>Education, Certifications & Awards<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'><? echo $education_complete ?></span>
				</div>
		</div>

		<div id='personal_button' style='width:100%; float:left;'>
				<div style='width:3%; float:left'><img src="images/frontofhouse.png" alt="menu" style="position: relative; bottom: 12px; height:80px"></div>
				<div id='personal_main_button' class='unselected_job_areas'>Personal Info & Description<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'><? echo $personal_complete ?></span>
				</div>
		</div>
		
<?php
	echo $email_verification;
	if ($email_verification != "Y") {
?>
	<div style='width:100%; float:left;'>		
		<a href='#'>You still need to verify your email address, click for more info</a>
	</div>
<?php
	}
	
	if ($profile_status != "complete") {
		if ($experience_complete == "<i>Incomplete</>") {
?>
			<div style='width:100%; float:left;'>	
				WARNING ABOUT NEEDING TO AD SKILLS & EXPERIENCE	
				<a href='#' id='complete_profile'>GREYED OUT FINALIZE PROFILE BUTTON</a>
			</div>	
<?php			
		} else {
?>
			<div style='width:100%; float:left;'>		
				<a href='#' id='complete_profile'>FINALIZE PROFILE BUTTON</a>
			</div>	
<?php
		}
	//FINALIZE TEXT
	}
?>
		</div>
	</div>
	
<?php
}

function profile_html_work_skills_menu_mobile($past_employment_array, $FOH, $BOH, $management) {
?>	
	<div style=' float:left; width:100%; padding-right:3.5%; padding-left:3.5%'>

		<div style='float:left; width:100%;'>
			
		<h2 style='margin-bottom:10px; margin-top:10px; color:black'>Experience & Skills</h2>	
				
<?php
		if (count($past_employment_array) > 0) {
?>
			<div style='width:3%; float:left'>
				<img src="images/nextarrow.png" alt="bartender" style="position: relative; bottom: 4px; height:44px">
			</div>
			<div class='bottom_navigation' id='experience_button'>Edit Experience (<? echo count($past_employment_array) ?> Entries)</div>
				<div id='experience_holder' style='float:left; width:100%; display:none'>
<?php	
					foreach($past_employment_array as $row) {
						if ($row['current'] == 'Y') {
							$end_date = "Current";
						} else {
							$end_date = $row['end_month']."/".$row['end_year'];
						}
						
						echo "<a href='employee.php?page=edit_past_employment&ID=".$row['ID']."'>Edit</a> ".$row['position']." - ".$row['company']."  ".$row['start_month']."/".$row['start_year']." - ".$end_date."<br />";
						echo "<i>".$row['skill_count']." Skill(s) <br /> <br />";
					}
				echo "</div>";
		}
?>

		ADD WORK EXPERIENCE		
		<div id='FOH_button' style='width:100%; float:left;'>
				<div style='width:3%; float:left'><img src="images/frontofhouse.png" alt="menu" style="position: relative; bottom: 12px; height:80px"></div>
				<div id='FOH_main_button' class='unselected_job_areas'>Front of House<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>Servers, Bartenders, Hosts, etc.</span>
				</div>
			</div>
		
		
		<div id='FOH_title_buttons' style='width:100%; float:left; margin-left:20%; margin-top:-20px; margin-bottom:8px; margin-right:8px; background-color:#ffffff; display:none;'>

<?php
		foreach($FOH as $title){
			echo "<div class='unselected_job_titles job_titles_button' data-status='unselected' data-title_id='".$title['titleID']."'>".$title['title']."</div>";
		}
	
?>	
		</div>
		</div>

			<div id='BOH_button' style='width:100%; float:left;'>
				<div style='width:3%; float:left'><img src="images/cheftools.png" alt="chefware" style="position: relative; bottom: 12px; height:80px"></div>
				<div id='BOH_main_button' class='unselected_job_areas'>Back of House<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>Chefs, Cooks, Dishwashers, etc.</span>
				</div>
			</div>
			
	<div id='BOH_title_buttons' style='width:100%; float:left; margin-left:20%; margin-top:-20px; margin-bottom:8px; margin-right:8px; background-color:#ffffff; display:none;'>

<?php
		foreach($BOH as $title){
			echo "<div class='unselected_job_titles job_titles_button' data-status='unselected' data-title_id='".$title['titleID']."'>".$title['title']."</div>";
		}
	
?>	
		</div>
		
		<div id='management_button' style='width:100%; float:left;'>
			<div style='width:3%; float:left'><img src="images/kitchen_manager.png" alt="manager" style="position: relative; bottom: 12px; height:80px"></div>
			<div id='management_main_button' class='unselected_job_areas'>Management<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>Managers, Asst. Managers, etc.</span>
			</div>
		</div>
		
		<div id='management_title_buttons' style='width:100%; float:left; margin-left:20%; margin-top:-20px; margin-bottom:8px; margin-right:8px; background-color:#ffffff; display:none;'>

<?php
		foreach($management as $title){
			echo "<div class='unselected_job_titles job_titles_button' data-status='unselected' data-title_id='".$title['titleID']."'>".$title['title']."</div>";
		}
	
?>		
		</div>
		
		<div id='other_button' style='width:100%; float:left;'>
			<div style='width:3%; float:left'><img src="images/paperclip.png" alt="paperclip" style="position: relative; bottom: 12px; height:80px"></div>
			<div id='other_main_button' class='unselected_job_areas'>Other Job Type<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>Jobs outside of hospitality</span>
			</div>
			
			
		</div>

		
			
		<div style='width:3%; float:left'><img src="images/nextarrow.png" alt="bartender" style="position: relative; bottom: 4px; height:44px"></div>

<!-- 		Do not change the ID of this button, it fires the javascript to save the selected items and move to the next page -->
		<div class='bottom_navigation' id='save_titles'>Next Step</div>
			
	</div>
<?php
}

function profile_html_edit_employment_mobile($status, $employmentID, $employment_record, $current_skills, $template_skills, $type) {
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
			$button_one_text = "FOH Button One";
			$button_two_text = "FOH Button Two";
			$button_three_text = "FOH Button Three";
			$category = array("task", "learn", "manage");
		break;
		
		case "BOH":
			$button_one_text = "BOH Button One";
			$button_two_text = "BOH Button Two";
			$button_three_text = "BOH Button Three";
			$category = array("tool", "create", "manage");
		break;

		case "Management":
			$button_one_text = "Management Button One";
			$button_two_text = "Management Button Two";
			$button_three_text = "Management Button Three";
			$category = array("task", "learn", "manage");
		break;		
	}	
	
?>	
	<div style='float:left; width:100%; padding-right:3.5%; padding-left:3.5%; text-align:center;'>
		<h2 style='margin-bottom:10px; margin-top:10px; color:black;'>Work Experience</h2>
	</div>
		
	<div style='float:left; width:100%; padding-right:8px; padding-left:8px'>
	<div id='FOH_button' style='width:100%; float:left;'>
				<div style='width:3%; float:left'><img src="images/frontofhouse.png" alt="menu" style="position: relative; bottom: 12px; height:80px"></div>
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
							<td valign="baseline"><select id='business_type' style='background-color:#e8e8e8'>
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
		<div style='float:left; width:100%; margin-top:-8px; margin-bottom:8px; padding-right:8px; padding-left:4px'><b>In this job, did you...</b>
		<div style='width:100%; margin-top:8px; margin-bottom:8px; margin-right:8px; background-color:#ffffff;'>

<?php
	//IF job_type is "Other" this is a non-restaurant job, no sub-skills will be displayed
	
	if ($type != "Other") {
?>		
		<div id='button_one_holder' style='width:100%; float:left;'>
				<div style='width:3%; float:left'><img src="images/nextarrow.png" alt="next_company" style="position: relative; bottom: 0px; height:44px"></div>
				<div id='main_button_one' class='unselected_job_areas'><? echo $button_one_text ?></div>
		</div>
		
		
		<div id='button_one_skill_buttons' style='width:100%; float:left; margin-left:20%; margin-top:5px; margin-bottom:8px; margin-right:8px; background-color:#ffffff; display:none;'>

<?php
		//loop through skill options based on category
		echo "<div style='float:left; width:100%;'>";
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
				}
			}
		echo "</div>";
	echo "</div>"
?>			

		<div id='button_two_holder' style='width:100%; float:left;'>
				<div style='width:3%; float:left'><img src="images/nextarrow.png" alt="next_company" style="position: relative; bottom: 0px; height:44px"></div>
				<div id='main_button_two' class='unselected_job_areas'><? echo $button_two_text ?></div>
		</div>
		
		
		<div id='button_two_skill_buttons' style='width:100%; float:left; margin-left:20%; margin-top:5px; margin-bottom:8px; margin-right:8px; background-color:#ffffff; display:none;'>

<?php
		//loop through skill options based on category
		echo "<div style='float:left; width:100%;'>";
		foreach($template_skills as $row) {
			$skill_button_class = "unselected_job_titles";
			$skill_data_status = "unselected";

			if ($row['category'] == $category[1]) {
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

					echo "<div class='unselected_job_titles skill_titles_button' data-status='unselected' data-skill='".$row['skill']."'>".$row['skill']."</div>";
			}
		}
		echo "</div>";
	echo "</div>";
?>			

		<div id='button_three_holder' style='width:100%; float:left;'>
				<div style='width:3%; float:left'><img src="images/nextarrow.png" alt="next_company" style="position: relative; bottom: 0px; height:44px"></div>
				<div id='main_button_three' class='unselected_job_areas'><? echo $button_three_text ?></div>
		</div>
		
		
		<div id='button_three_skill_buttons' style='width:100%; float:left; margin-left:20%; margin-top:5px; margin-bottom:8px; margin-right:8px; background-color:#ffffff; display:none;'>

<?php
		//loop through skill options based on category
		echo "<div style='float:left; width:100%;'>";
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

					echo "<div class='unselected_job_titles skill_titles_button' data-status='unselected' data-skill='".$row['skill']."'>".$row['skill']."</div>";
			}
		}
		echo "</div>";
	echo "</div>";
		
	} //end if
?>					
			</div>
		</div>
		

<!-- HIDDEN INPUT, DO NOT REMOVE -->
		<input type='hidden' id='job_category' value="<? echo $job_category ?>">
		<input type='hidden' id='status' value="<? echo $status ?>">
		
		<div style='float:left; width:100%;'>

		<div style='width:3%; float:left' class='save_position' id='<? echo $employmentID ?>'><img src="images/nextjobarea.png" alt="next_company" style="position: relative; bottom: 4px; height:44px"></div>
		<div class='bottom_navigation'>Save Position Details</div><br />

		<a href='#' class='show_delete'>Delete Employment Record</a>
	</div>
<?php			
	profile_html_employment_delete_warning_mobile("Employment", $title, $employmentID);
}

function profile_html_job_page_no_update_mobile($employment_record, $FOH, $BOH, $Management) {
	//THIS PAGE IS DISPLAYED WHEN A USER EDITS PAST EMPLOYMENT THEY ENTERED PRIOR TO UPDATE
		

	//hidden forms
	echo "<input type='hidden' id='workID' value='".$_GET['ID']."'>";	
	


//Start Page
	echo "We would like to determine what skills are associated with your previous job, but we don't recognize ".$employment_record['position']."<br />";
	
	echo "Is this position a: <br />";
?>	
		<div id='FOH_button' style='width:100%; float:left;'>
				<div style='width:3%; float:left'><img src="images/frontofhouse.png" alt="menu" style="position: relative; bottom: 12px; height:80px"></div>
				<div id='FOH_main_button' class='unselected_job_areas'>Front of House<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>Servers, Bartenders, Hosts, etc.</span>
				</div>
			</div>
		
		
		<div id='FOH_title_buttons' style='width:100%; float:left; margin-left:20%; margin-top:-20px; margin-bottom:8px; margin-right:8px; background-color:#ffffff; display:none;'>
			Does this position closely resemble one of the following (if not, select Other):
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
			Does this position closely resemble one of the following (if not, select Other):
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
			Does this position closely resemble one of the following (if not, select Other):
<?php
		foreach($management as $title){
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

function profile_html_intermediate_page_mobile($past_employment_array) {
	?>	

<!-- 	LOGAN -->

<div style='float:left; width:100%; padding-right:3.5%; padding-left:3.5%'>

		<div style='float:left; width:100%;'>
			
		<h2 style='margin-bottom:10px; margin-top:10px; color:black'>Position saved.</h2>	
		
		<div id='add_another_job' style='width:100%; float:left;'>
			<div style='width:3%; float:left'><img src="images/add.png" alt="add_job" style="position: relative; bottom: 12px; height:80px"></div>
			<div id='add_another_job_main' class='unselected_job_areas'>Add<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>another job here.</span></div>
			</div>

			<div style=' float:left; width:100%; padding-bottom:10%; padding-right:3.5%; padding-left:3.5%'>

			<table align='center' style='width:100%'>
						<tr>
							<td style='width:30%'><b>Company: &nbsp; </b></td>
							<td style='width:70%'><input type="text" name="past_company" id="past_company"></input></td>
						</tr>
						<tr>
							<td><b>Business Type: &nbsp; </b></td>
							<td valign="baseline"><select id='business_type' style='background-color:#e8e8e8'>
							<option value='0' >--Location Type--</option>;
							<option value='Casual' ".$casual_selected.">Casual</option>;
							<option value='Upscale_Casual' ".$upscale_casual_selected.">Upscale Casual</option>;
							<option value='Upscale' ".$upscale_selected.">Upscale</option>;
							<option value='Catering' ".$catering_selected.">Catering</option>;
						</select>
						</td>
						</tr>

						<tr>
							<td><b>Start Date: &nbsp; </b></td>
							<td><select id="start_month" style='background-color:#e8e8e8'>
										<option value='1'>Jan.</option>
										<option value='2'>Feb.</option>
										<option value='3'>Mar.</option>
										<option value='4'>Apr.</option>
										<option value='5'>May</option>
										<option value='6'>June</option>
										<option value='7'>July</option>
										<option value='8'>Aug.</option>
										<option value='9'>Sep.</option>
										<option value='10'>Oct.</option>
										<option value='11'>Nov.</option>
										<option value='12'>Dec.</option>
									</select>	
									<input type="text" id="start_year" maxlength="4" style='width:50px;' placeholder="Year"></input>
							</td>
						</tr>
						<tr>
							<td class='end'><b>End Date: &nbsp; </b></td>
							<td class='end'><select id="end_month" style='background-color:#e8e8e8'>
										<option value='1'>Jan.</option>
										<option value='2'>Feb.</option>
										<option value='3'>Mar.</option>
										<option value='4'>Apr.</option>
										<option value='5'>May</option>
										<option value='6'>June</option>
										<option value='7'>July</option>
										<option value='8'>Aug.</option>
										<option value='9'>Sep.</option>
										<option value='10'>Oct.</option>
										<option value='11'>Nov.</option>
										<option value='12'>Dec.</option>
									</select>	
									<input type="text" id="end_year" maxlength="4" style='width:50px;' placeholder="Year"></input>
							</td>
						</tr>	
						</table>
								<span style='width:84%; margin-right:8px;' id='current_employment' class='current_employment unselected_button' data-current_employment='unselected'><span class='fui-check-inverted' style='color:white; float:left; cursor:pointer;'></span> Currently Employed</span>
			</div>				
				
	
	<div id='next_job_area' style='width:100%; float:left;'>
			<div style='width:3%; float:left'><img src="images/nextjobarea.png" alt="add_job" style="position: relative; bottom: 12px; height:80px"></div>
			<div id='next_job_area_main' class='unselected_job_areas'>Move on<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>to a different position.</span></div>
			</div>
			<div style='float:left; width:100%; padding-right:3.5%; padding-left:20%;'>
			<div class='unselected_job_titles'>other titles</div>
			<div class='unselected_job_titles'>other titles</div>
			<div class='unselected_job_titles'>other titles</div>
			<div class='unselected_job_titles'>other titles</div>
			</div>
			<span style='width:72%; margin-left:21%; margin-bottom:10%' class='current_employment unselected_button'><span class='fui-check-inverted' style='color:white; float:left; cursor:pointer;'></span> Select other job types.</span>

			</div>
	
	<div style='width:3%; float:left'><img src="images/nextarrow.png" alt="bartender" style="position: relative; bottom: 4px; height:44px"></div>

<!-- 		Do not change the ID of this button, it fires the javascript to save the selected items and move to the next page -->
		<div class='bottom_navigation' id='save_titles'>Next Step</div>
			
	<?php
	
}

function profile_html_education_menu_mobile($template_certifications, $template_awards, $employee_education, $employee_certifications, $employee_awards) {
?>	
	<div style=' float:left; width:100%; padding-right:3.5%; padding-left:3.5%'>

		<div style='float:left; width:100%;'>
			
		<h2 style='margin-bottom:10px; margin-top:10px; color:black'>Education/Certification</h2>	
		
		<h4 style='margin-bottom:10px; margin-top:10px; color:6c6367'>Tell us about your culinary education.</h4>
		<div style='color:6c6367; font-size:14px; margin-right:3.5%;'>Click any types of culinary education you have. <br>You can edit this information in your profile later.</div>		
		<br>
		<div id='certification_holder_button' style='width:100%; float:left;'>
				<div style='width:3%; float:left'><img src="images/certificate.png" alt="menu" style="position: relative; bottom: 12px; height:80px"></div>
				<div id='certification_main_button' data-job_area_selection='unselected' class='unselected_job_areas'>Certifications (<? echo count($employee_certifications) ?>)<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>Add culinary certifications received.</span>
				</div>
			</div>
		
		
		<div id='certification_options' style='width:100%; float:left; margin-left:20%; margin-top:-20px; margin-bottom:8px; margin-right:8px; background-color:#ffffff; display:none;'>

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
			<div id='save_button_holder' style='float:left; width:100%'>
				<a href='#' id='save_changes'>Save Changes</a>
			</div>
			
			<div id='other_certification_holder' style='float:left; width:100%; display:none;'>
				New Certification<br />
				<div class='error' id='empty_warning' style='color:red; display:none;'>Certification cannot be blank</div>
				<input type='text' id='new_certification' maxlength="25"><br />
				<a href='#' id='add_certification'>Add Certification</a>
				<a href='#' id='cancel_other'>Cancel</a>			
			</div>


		</div>
		
		</div>

			<div id='education_holder_button' style='width:100%; float:left;'>
				<div style='width:3%; float:left'><img src="images/school.png" alt="chefware" style="position: relative; bottom: 12px; height:80px"></div>
				<div id='education_main_button' class='unselected_job_areas'>Education <span id='education_count'>(<? echo count($employee_education) ?>)</span><br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>Add culinary schools attended.</span>
				</div>
			</div>
			
	<div id='education_options' style='width:100%; float:left; margin-left:20%; margin-top:-20px; margin-bottom:8px; margin-right:8px; background-color:#ffffff; display:none;'>

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
				echo "<a href='#' class='edit_education' id='".$education['ID']."'>EDIT</a> ".$education['school']." - ".$education['degree']." <a href='#' class='remove_education_button' id='".$education['ID']."'>REMOVE</a><br />";
				echo "<i>".$education['type']."</i>";	
			echo "</div>";
			
			echo "<div class='education_input' data-education_id='".$education['ID']."' style='display:none'>";
				echo "<div class='error' id='school_empty_warning_".$education['ID']."' style='color:red'>Institution cannot be empty</div>";
				echo "<input type='text' class='edit_school' data-education_id='".$education['ID']."' value=".$education['school']." placeholder='Insitution'><br />";
				echo "<input type='text' class='edit_degree' data-education_id='".$education['ID']."' value=".$education['degree']." placeholder='Degree'><br />";
				echo "<select class='edit_education_type' data-education_id='".$education['ID']."'>";
						echo "<option value='Other'>Other</option>";			
						echo 	"<option value='Culinary School' ".$culinary.">Culinary School</option>";
						echo "<option value='Bartending School' ".$bartending.">Bartending School</option>";
						echo "<option value='College' ".$college.">College/University</option>";
				echo "</select>";
				echo "<a href='#' class='save_education_edit' data-education_id='".$education['ID']."'>Save</a>  <a href='#' class='cancel_edit_education'>CANCEL</a>";
			echo "</div>";
			
			echo "<div class='delete_warning' data-education_id='".$education['ID']."' style='display:none'>";
				echo "Remove Employment Record? <a href='#' class='remove_record' id='".$education['ID']."'>YES</a> | <a href='#' class='cancel_remove_education'>CANCEL</a>";
			echo "</div>";			
		}
?>	
			<a href='#' id='add_education_button'>Add Education</a>				
			
			<div id='new_education_holder' style='display:none'>
				<div class='error' id='new_school_empty_warning' style='color:red'>Institution cannot be blank</div><br />
				<input type='text' id='new_school' placeholder='Insitution'><br />
				<input type='text' id='new_degree' placeholder='Degree'><br />
				Type: <select id='education_type'>
							<option value='Other'>Other</option>			
							<option value='Culinary School'>Culinary School</option>
							<option value='Bartending School'>Bartending School</option>
							<option value='College'>College/University</option>
				</select><br />
				<a href='#' id='save_new_education'>Save Education</a> | <a href='#' id='cancel_new_education'>Cancel</a>
				
			</div>
		</div>
		
		
		
		
		<div id='award_holder_button' style='width:100%; float:left;'>
			<div style='width:3%; float:left'><img src="images/award.png" alt="manager" style="position: relative; bottom: 12px; height:80px"></div>
			<div id='award_main_button' class='unselected_job_areas'>Contests or Awards (<? echo count($employee_awards) ?>)<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>Add contests or awards won.</span>
			</div>
		</div>
		
		<div id='award_options' style='width:100%; float:left; margin-left:20%; margin-top:-20px; margin-bottom:8px; margin-right:8px; background-color:#ffffff; display:none;'>

<?php
		foreach($employee_awards as $award){
			echo "<div class='award_row'>";
				echo "<a href='#' class='edit_award' id='".$award['wardID']."'>EDIT</a> ".$award['award']." <a href='#' class='remove_award_button' id='".$award['awardID']."'>REMOVE</a><br />";
			echo "</div>";
			
			echo "<div class='award_input' data-award_id='".$award['awardID']."' style='display:none'>";
				echo "<div class='error' id='award_empty_warning_".$award['awardID']."' style='color:red'>Award field cannot be empty</div>";
				echo "<input type='text' class='edit_award' data-award_id='".$award['awardID']."' value=".$award['award']." placeholder='Award'><br />";
				echo "<a href='#' class='save_award_edit' data-award_id='".$award['awardID']."'>Save</a>  <a href='#' class='cancel_edit_award'>CANCEL</a>";
			echo "</div>";
			
			echo "<div class='delete_warning' data-award_id='".$award['awardID']."' style='display:none'>";
				echo "Remove Award Record? <a href='#' class='remove_award_record' id='".$award['awardID']."'>YES</a> | <a href='#' class='cancel_remove_award'>CANCEL</a>";
			echo "</div>";			
		}
?>	
			<a href='#' id='add_award_button'>Add Award of Contest Win</a>				
			
			<div id='new_award_holder' style='display:none'>
				<div class='error' id='new_award_empty_warning' style='color:red; display:none'>Award details cannot be blank</div><br />
				<input type='text' id='new_award' placeholder='Award or Contest'><br />
				<a href='#' id='save_new_award'>Save Award</a> | <a href='#' id='cancel_new_award'>Cancel</a>
	
		</div>			
	</div>
<?php
	
}

function profile_html_personal_menu_mobile($traits, $languages, $employee_traits, $employee_languages) {
	?>
	
	<div style=' float:left; width:100%; padding-right:3.5%; padding-left:3.5%'>

		<div style='float:left; width:100%;'>
			
		<h2 style='margin-bottom:10px; margin-top:10px; color:black'>Additional Info</h2>	
		
		<h4 style='margin-bottom:10px; margin-top:10px; color:6c6367'>Tell us more about you.</h4>
		
		<div id='photo_button' style='width:100%; float:left;'>
				<div style='width:3%; float:left'><img src="images/person.png" alt="you" style="position: relative; bottom: 12px; height:80px"></div>
				<div id='photo_main_button' class='unselected_job_areas'>Profile Photos<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>Add profile photo and culinary or drink photos.</span>
				</div>
		</div>		

		<div id='summary_button' style='width:100%; float:left;'>
				<div style='width:3%; float:left'><img src="images/person.png" alt="you" style="position: relative; bottom: 12px; height:80px"></div>
				<div id='summary_main_button' class='unselected_job_areas'>Personal Summary (Incomplete)<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>Describe who you are as an employee.</span>
				</div>
		</div>

		
		<div id='trait_holder_button' style='width:100%; float:left;'>
				<div style='width:3%; float:left'><img src="images/traits.png" alt="traits" style="position: relative; bottom: 12px; height:80px"></div>
		
				<div id='traits_main_button' data-job_area_selection='unselected' class='unselected_job_areas'>Traits & Languages<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>Choose your top three character traits.</span>
				</div>
			</div>
		
		<div id='trait_options' style='float:left; background-color:white; color:6c6367; font-size:12px; margin-left:20%; margin-right:-20%; display:none'>Choose three traits that best describe you.
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
				
				echo "<div class='".$class." trait_button' data-status='".$status."'>".$trait."</div>";
			}
	
?>	
				</div>
				
		<div id='language_summary' style='float:left; background-color:white; color:6c6367; font-size:12px;'>What languages do you speak?
		<div style='float-left; width:100%; margin-top:8px;'>

<?php
		foreach($languages as $language){
				$status = "unselected";
				$class = "unselected_job_titles";
				if (count($employee_languages) > 0) {
					foreach($employee_languages as $row) {
						if ($row['languages'] == $language) {
							$status = "selected";
							$class = "selected_job_titles";							
						}
					}
				}

			echo "<div class='".$class." language_button' data-status='".$status."'>".$language."</div>";
		}
?>	
		</div>
		</div>

	<div style=' float:left; width:100%; padding-right:3.5%; padding-left:3.5%'>

		<div style='width:3%; float:left;'><img src="images/completeprofile.png" alt="complete_profile" style="position: relative; bottom: 4px; height:44px"></div>
		<div class='bottom_navigation' id='save_changes'>Save Changes</div>
	</div>
				
				
			</div>
			
			
			
		</div>
  	
<!--
  	<div id='language_button' style='width:100%; float:left;'>
				<div style='width:3%; float:left'><img src="images/languages_spoken.png" alt="languages" style="position: relative; bottom: 12px; height:80px"></div>
				<div id='language_main_button' data-job_area_selection='unselected' class='unselected_job_areas'>Languages Spoken<br><span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>Choose the languages you speak.</span>
			</div>
			</div>

	</div>
-->

<?php
	
}

function profile_html_personal_info_mobile($quote, $long_description) {
?>
		<div id='employee_summary' style='color:6c6367; font-size:12px; margin-left:3.5%; margin-right:3.5%;'>In 140 characters or less, tell us who you are.  <a href='#'>Example</a><br />
		This will be the first thing an employer sees when you apply for a job, think of it as a 'headline'.<br />
		<div id='charNum' style='color:red'></div><br />
		<textarea style="width:90%; margin-top:8px; margin-bottom:8px;" cols="200" rows="2" maxlength="140" id='quote'><?php echo $quote ?></textarea>
		
		<h3>Want to include a longer description?</h3>

		<div id='employee_summary' style='color:6c6367; font-size:12px; margin-left:3.5%; margin-right:3.5%;'>Include any other information you'd like to in the area below.  (OPTIONAL)
		<textarea style="width:90%; margin-top:8px; margin-bottom:8px;" cols="200" rows="2" id='long description'><?php echo $long_description ?></textarea>
		<br />
		<a href='#' id='save_descriptions'>SAVE DESCRIPTIONS</a>
<?php	
}

function profile_html_edit_photos_mobile($upload_url, $photo, $kitchen, $bartender, $kitchen_photos, $bar_photos) {
	
	echo "<div class='main_box' style='color:#760006; margin-top:110px; width:100%;'>";
			
		echo "<h2 style='text-align:center'>Profile Photo</h2>";
							
				echo "<div style='width:100%; float:left;'>";
					echo "<div style='width:30%; float:left;  margin-left:10px; margin-top:10px;'>";
					echo $photo;
					echo "</div>";
					
					echo "<div style='width:65%; float:left; margin-bottom:30px; margin-top:25px; text-align:center;'>";
						echo "<div class='button_holder_photo'>";
							echo "<a href='#' class='add_photo btn btn-primary' id='profile'>Change Profile Photo</a> <br />";
						if ($photo != "NO PHOTO") {	
							echo " &nbsp; <br />";
							echo " &nbsp; <br />";
							echo "<a href='#' class='remove_photo btn btn-primary' id='profile'>Remove Profile Photo</a>";
						}
						echo "</div>";
						
						echo "<div id='loader' style='display:none;'>";
							echo "<h4>Loading....</h4>";
						echo "</div>";						
						
						echo "<div id='file_size_warning' style='display:none; color:red; margin-top:10px;'>";
							echo "<b>Please choose a file less than 4 MB</b>";
						echo "</div>";
						
						echo "<div id='file_type_warning' style='display:none; color:red; margin-top:10px;'>";
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
					echo "</div>";
						
?>
					<div id="add_photo_tools" style="margin-top:-15px;">			
					    <form id="myform" action="<? echo $upload_url ?>.php?type=profile" method="post" enctype="multipart/form-data" style="position:absolute; top:-500px;">
					        <input type="file" id="profile_pic_choose" name="profile_pic_choose" >
							<input type="submit" value="Save Profile Pic1" id="profile_upload_button"><br />
						</form>
					</div>
<?php	
			
				if ($bartender == true) {
					echo "<h2 style='text-align:center'>Cocktail Photos</h2>";
					echo "<div style='width:100%; margin:left:5px; text-align:center;'>";
					echo "You may upload up to 6 photos showing your bartending skills.<br />";
					echo "&nbsp; <br/>";
				
					if (count($bar_photos) > 0) {			
						$count = 1;
						echo "<b>Click on a photo to remove it.</b><br />";
						foreach($bar_photos as $photo) {
							echo "<a href='#' class='remove_photo' id='".$photo['photoID']."'><img src='images/gallery_pics/".$photo['thumb']."' height='70' style='margin-left:8px; margin-bottom:8px;'></a>";
							if ($count % 3 == 0) {
								$icon .= "<br />";
							}
							$count++;
						}
					} 
					
					if (count($bar_photos) < 6) {
						echo "<div class='button_holder_photo' style='width:100%; text-align:center; margin-bottom:15px; margin-top:15px; '><a href='#' class='add_photo btn btn-primary' id='bartender' style='margin-left:20px;'>Add Cocktail Photos</a></div>";

						echo "<div id='loader' style='display:none;'>";
							echo "<h4>Loading....</h4>";
						echo "</div>";						
						
						echo "<div id='file_size_warning' style='display:none; color:red; margin-top:10px;'>";
							echo "<b>Please choose a file less than 4 MB</b>";
						echo "</div>";
						
						echo "<div id='file_type_warning' style='display:none; color:red; margin-top:10px;'>";
							echo "<b>Please choose a PNG of JPG file</b>";
						echo "</div>";																																																																																														
																													
					}
					echo "<div class='button_holder_photo' style='width:100%; text-align:center; margin-bottom:15px; margin-top:25px; '><a href='employee.php' class='btn btn-primary' style='margin-left:20px;'>Done With Photos</a></div>";
					
					echo "</div>";
?>
					<form id="bar_form" action="<? echo $upload_url ?>.php?type=bartender" method="post" enctype="multipart/form-data" style="position:absolute; top:-500px;">
					        <input type="file" id="bartender_pic_choose" name="bartender_pic_choose" >
							<input type="submit" value="Save Profile Pic" id="bartender_upload_button"><br />
					</form>
<?php

					echo "<div id='status' style='width:100%; color:red;'>";				
					echo "</div>";				

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
				echo "<h2 style='text-align:center'>Culinary Photos</h2>";
				echo "<div style='width:100%; margin:left:5px; text-align:center;'>";
				echo "You may upload up to 6 photos showing your culinary skills.<br />";
				echo "&nbsp; <br/>";

					if (count($kitchen_photos) > 0) {			
						$count = 1;
						echo "<b>Click on a photo to remove it.</b><br />";
						foreach($kitchen_photos as $photo) {
							echo "<a href='#' class='remove_photo' id='".$photo['photoID']."'><img src='images/gallery_pics/".$photo['thumb']."' height='70' style='margin-left:8px; margin-bottom:8px;'></a>";
							if ($count % 3 == 0) {
								$icon .= "<br />";
							}
							$count++;
						}
					} 
					
					if (count($kitchen_photos) < 6) {
						echo "<div class='button_holder_photo' style='width:100%; text-align:center; margin-bottom:15px; margin-top:15px; '><a href='#' class='add_photo btn btn-primary' id='kitchen' style='margin-left:20px;'>Add Culinary Photos</a></div>";

						echo "<div id='loader' style='display:none;'>";
							echo "<h4>Loading....</h4>";
						echo "</div>";						
						
						echo "<div id='file_size_warning' style='display:none; color:red; margin-top:10px;'>";
							echo "<b>Please choose a file less than 4 MB</b>";
						echo "</div>";
						
						echo "<div id='file_type_warning' style='display:none; color:red; margin-top:10px;'>";
							echo "<b>Please choose a PNG of JPG file</b>";
						echo "</div>";																																																																																																																												
					}
					echo "<div class='button_holder_photo' style='width:100%; text-align:center; margin-bottom:15px; margin-top:25px; '><a href='employee.php'  class='btn btn-primary' style='margin-left:20px;'>Done With Photos</a></div>";
					
					echo "</div>";
?>
					<form id="kitchen_form" action="<? echo $upload_url ?>.php?type=kitchen" method="post" enctype="multipart/form-data" style="position:absolute; top:-500px;">
					        <input type="file" id="kitchen_pic_choose" name="kitchen_pic_choose" style="">
							<input type="submit" value="Save Profile Pic" id="kitchen_upload_button"><br />
					</form>		
<?php

					echo "<div id='status' style='width:100%; color:red'>";				
					echo "</div>";				

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
	
}


function profile_html_employment_delete_warning_mobile($type, $record_name, $ID) {
?>
	<div id='delete_holder' style='float:left; margin-top:50px; text-align:center; display:none;'>
		<h3>Are you sure you want to remove <? echo $type." - ".$record_name ?> and all associated information?</h3>
		<a href='#' class='delete' id='<? echo $ID ?>'>Delete</a> &nbsp; &nbsp; <a href='#' id='cancel'>
	</div>
<?php
}
 
function profile_html_employee_photo_mobile($type, $member_data, $employee_data) {
$utilities = new Utilities;
//!!!!!!!CHANGE THIS FOR LIVE SITE!!!!!!!
$site_type = $utilities->site_type;
if ($site_type == "live") {
	$upload_url = "http://servebartendcook.com/upload_pic";
} elseif ($site_type == "prototype") {
	$upload_url = "http://threewhitebirds.com/SBC/upload_pic";	
}

	$skill_array = $employee_data['skills']['skills'];
	
	$bartender = false;
	$kitchen = false;
	
	foreach($skill_array as $row) {
		if ($row['skill'] == "Bartender") {
			$bartender = true;
		}
		
		if ($row['skill'] == "Kitchen") {
			$kitchen = true;
		}		
	}

	if ($type == "menu") {
		if ($bartender == false && $kitchen == false) {
			$type = "profile";
		}
	}
	
	echo "<div class='main_box' style='color:#760006; margin-top:110px; width:100%;'>";
		switch($type) {
			case "menu":
				echo "<h2 style='text-align:center'>Edit Photos</h2>";
				echo "<div style='float:left; margin-bottom:25px; margin-top:25px; text-align:center; width:100%'><a href='employee.php?page=edit_photo&type=profile' class='btn btn-large btn-primary'>PROFILE PHOTO</a></div>";								
				if ($kitchen == true) {
					echo "<div style='float:left; margin-bottom:25px; text-align:center; width:100%'><a href='employee.php?page=edit_photo&type=kitchen' class='btn btn-large btn-primary'>CULINARY PHOTOS</a></div>";													
				}
				
				if ($bartender == true) {
					echo "<div style='float:left; margin-bottom:25px; text-align:center; width:100%'><a href='employee.php?page=edit_photo&type=bar' class='btn btn-large btn-primary'>COCKTAIL PHOTOS</a></div>";													
				}									
			break;
			
			case "profile":
				echo "<h2 style='text-align:center'>Profile Photo</h2>";
				
				if ($employee_data['general']['profile_pic'] != "") {
					$photo = "<img src='images/profile_pics/".$employee_data['general']['profile_pic']."' height='100' width='100'>";								
				} else {
					$photo = "<b>NO PHOTO</b>";
				}
				
				echo "<div style='width:100%; float:left;'>";
					echo "<div style='width:30%; float:left;  margin-left:10px; margin-top:10px;'>";
					echo $photo;
					echo "</div>";
					
					echo "<div style='width:65%; float:left; margin-bottom:30px; margin-top:25px; text-align:center;'>";
						echo "<div class='button_holder_photo'>";
							echo "<a href='#' class='add_photo btn btn-primary' id='profile'>Change Profile Photo</a> <br />";
						if ($employee_data['general']['profile_pic'] != "") {	
							echo " &nbsp; <br />";
							echo " &nbsp; <br />";
							echo "<a href='#' class='remove_photo btn btn-primary' id='profile'>Remove Profile Photo</a>";
						}
						echo "</div>";
						
						echo "<div id='loader' style='display:none;'>";
							echo "<h4>Loading....</h4>";
						echo "</div>";						
						
						echo "<div id='file_size_warning' style='display:none; color:red; margin-top:10px;'>";
							echo "<b>Please choose a file less than 4 MB</b>";
						echo "</div>";
						
						echo "<div id='file_type_warning' style='display:none; color:red; margin-top:10px;'>";
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
					echo "</div>";
						
?>
					<div id="add_photo_tools" style="margin-top:-15px;">			
					    <form id="myform" action="<? echo $upload_url ?>.php?type=profile" method="post" enctype="multipart/form-data" style="position:absolute; top:-500px;">
					        <input type="file" id="profile_pic_choose" name="profile_pic_choose" >
							<input type="submit" value="Save Profile Pic1" id="profile_upload_button"><br />
						</form>
					</div>
<?php	
			
			break;	
			
			case "bar":
				$photo_gallery = $employee_data['bar_photos'];
				echo "<h2 style='text-align:center'>Cocktail Photos</h2>";
				echo "<div style='width:100%; margin:left:5px; text-align:center;'>";
				echo "You may upload up to 6 photos showing your bartending skills.<br />";
				echo "&nbsp; <br/>";
				
					if (count($photo_gallery) > 0) {			
						$count = 1;
						echo "<b>Click on a photo to remove it.</b><br />";
						foreach($photo_gallery as $photo) {
							echo "<a href='#' class='remove_photo' id='".$photo['photoID']."'><img src='images/gallery_pics/".$photo['thumb']."' height='70' style='margin-left:8px; margin-bottom:8px;'></a>";
							if ($count % 3 == 0) {
								$icon .= "<br />";
							}
							$count++;
						}
					} 
					
					if (count($photo_gallery) < 6) {
						echo "<div class='button_holder_photo' style='width:100%; text-align:center; margin-bottom:15px; margin-top:15px; '><a href='#' class='add_photo btn btn-primary' id='bartender' style='margin-left:20px;'>Add Cocktail Photos</a></div>";

						echo "<div id='loader' style='display:none;'>";
							echo "<h4>Loading....</h4>";
						echo "</div>";						
						
						echo "<div id='file_size_warning' style='display:none; color:red; margin-top:10px;'>";
							echo "<b>Please choose a file less than 4 MB</b>";
						echo "</div>";
						
						echo "<div id='file_type_warning' style='display:none; color:red; margin-top:10px;'>";
							echo "<b>Please choose a PNG of JPG file</b>";
						echo "</div>";																																																																																														
																													
					}
					echo "<div class='button_holder_photo' style='width:100%; text-align:center; margin-bottom:15px; margin-top:25px; '><a href='employee.php' class='btn btn-primary' style='margin-left:20px;'>Done With Photos</a></div>";
					
					echo "</div>";
?>
				<form id="bar_form" action="<? echo $upload_url ?>.php?type=bartender" method="post" enctype="multipart/form-data" style="position:absolute; top:-500px;">
				        <input type="file" id="bartender_pic_choose" name="bartender_pic_choose" >
						<input type="submit" value="Save Profile Pic" id="bartender_upload_button"><br />
				</form>
<?php

					echo "<div id='status' style='width:100%; color:red;'>";				
					echo "</div>";				

					echo "<form id='bar_form_ie' action='".$upload_url."_ie.php?type=bartender' method='post' enctype='multipart/form-data' style='float:left; padding-top:30px; padding-left:10px; display:none'>";
					        echo "<h2 style='text-align:center;'>Choose a File</h2>";
					        echo "&nbsp; &nbsp; &nbsp; &nbsp; <input type='file' id='bartender_pic_choose_ie' name='bartender_pic_choose_ie' ><br />";
					        echo "&nbsp; <br />";
							echo "&nbsp; &nbsp; &nbsp;  &nbsp; <input type='submit' value='Save Cocktail Pic' id='bartender_upload_button_ie'><br />";
							echo "<a href='#' class='upload_cancel' id='bar'>Cancel</a><br />";												
							echo "&nbsp; <br />";
							echo "<div id='status' style='color:red'></div>";	
					echo "</form>";

			break;
			
			case "kitchen":
				$photo_gallery = $employee_data['kitchen_photos'];
				echo "<h2 style='text-align:center'>Culinary Photos</h2>";
				echo "<div style='width:100%; margin:left:5px; text-align:center;'>";
				echo "You may upload up to 6 photos showing your culinary skills.<br />";
				echo "&nbsp; <br/>";

					if (count($photo_gallery) > 0) {			
						$count = 1;
						echo "<b>Click on a photo to remove it.</b><br />";
						foreach($photo_gallery as $photo) {
							echo "<a href='#' class='remove_photo' id='".$photo['photoID']."'><img src='images/gallery_pics/".$photo['thumb']."' height='70' style='margin-left:8px; margin-bottom:8px;'></a>";
							if ($count % 3 == 0) {
								$icon .= "<br />";
							}
							$count++;
						}
					} 
					
					if (count($photo_gallery) < 6) {
						echo "<div class='button_holder_photo' style='width:100%; text-align:center; margin-bottom:15px; margin-top:15px; '><a href='#' class='add_photo btn btn-primary' id='kitchen' style='margin-left:20px;'>Add Culinary Photos</a></div>";

						echo "<div id='loader' style='display:none;'>";
							echo "<h4>Loading....</h4>";
						echo "</div>";						
						
						echo "<div id='file_size_warning' style='display:none; color:red; margin-top:10px;'>";
							echo "<b>Please choose a file less than 4 MB</b>";
						echo "</div>";
						
						echo "<div id='file_type_warning' style='display:none; color:red; margin-top:10px;'>";
							echo "<b>Please choose a PNG of JPG file</b>";
						echo "</div>";																																																																																																																												
					}
					echo "<div class='button_holder_photo' style='width:100%; text-align:center; margin-bottom:15px; margin-top:25px; '><a href='employee.php'  class='btn btn-primary' style='margin-left:20px;'>Done With Photos</a></div>";
					
					echo "</div>";
?>
					<form id="kitchen_form" action="<? echo $upload_url ?>.php?type=kitchen" method="post" enctype="multipart/form-data" style="position:absolute; top:-500px;">
					        <input type="file" id="kitchen_pic_choose" name="kitchen_pic_choose" style="">
							<input type="submit" value="Save Profile Pic" id="kitchen_upload_button"><br />
					</form>		
<?php

					echo "<div id='status' style='width:100%; color:red'>";				
					echo "</div>";				

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

			break;			
		}
		
	echo "</div>";
}	
	

//!!!!!!!LIVE SITE  ----  CHANGE UPLOAD URL FOR BOTH profile_html_employee AND step_four


function profile_html_employee_mobile($member_data, $employee_data, $employment_gaps) {		
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

function no_past_employment_mobile() {
	echo "No Previous Employment Information Added<br />";	
}

function old_past_employment_mobile($employment_array) {
	if (count($employment_array) > 0) {			
		echo "<table cellpadding='12' style='margin-left:5px; table-layout:fixed;'>";	
		foreach ($employment_array as $row) {
			echo "<tr>";
				echo "<td style='width:30%;'><a href='http://".$row['website']."'><b>".$row['company']."</b></a></td>";
				echo "<td style='width:20%;'>".$row['position']."</td>";
				echo "<td style='word-wrap: break-word; color:red;'><b>! Incompatible Dates:  UPDATE INFORMATION</b></td>";		
			echo "</tr>";
		}
		echo "</table>";
	}
}

function new_past_employment_mobile($new_employment_array, $employment_gaps) {

		$utilities = new Utilities;
		if (count($new_employment_array) > 0) {			
		echo "<table cellpadding='12' style='margin-left:5px; table-layout:fixed;'>";	
			foreach ($new_employment_array as $row) {
				//test for employment gap
				$indicator = "";
				if (count($employment_gaps) > 0) {
					foreach($employment_gaps as $gap) {
						if($gap['secondID'] == $row['ID']) {
							$indicator = "<font color='red'><b>*</b></font>";
						} elseif ($gap['firstID'] == $row['ID']) {
							$indicator = "<font color='red'><b>*</b></font>";							
						}		
					}
				}
				
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
					echo "<td width='60%;'><a href='http://".$row['website']."'><b>".$row['company']."</b></a>".$indicator." <br />".$row['position']."</td>";
					echo "<td>".$start_date." - ".$end_date."<br /><i>".$time."</i></td>";
				echo "</tr>";
			}
			echo "</table>";
			if (count($new_employment_array) > 0) {			
				$gap_text = "";
				$count = 0;
				foreach($employment_gaps as $row) {
					$gap_text .= $row['gap_text'];
					$count++;
					if ($count != count($employment_gaps)) {
						$gap_text .= ", ";
					}
				}
				if (count($employment_gaps) > 0) {
					echo "<div style='color:red; float:left; margin-left:5px; margin-right:3px;'>*You have gaps in your employment: ".$gap_text."<br /> <i>Employers may ask you to explain</i></div>";
				}
			} 
		}
}



function profile_html_employee_step_one_mobile($member_data, $employee_data, $email_verification) {
		$utilities = new Utilities;
		
		$name_array = array("Manager", "Server", "Bartender", "Kitchen", "Bus", "Host");		
		$sub_arrays = array($utilities->management_skills, $utilities->server_skills, $utilities->bar_skills, $utilities->kitchen_skills, $utilities->bus_skills, $utilities->host_skills);		

		$skill_array = $employee_data['skills']['skills'];
		$skill_count = count($skill_array);
		$sub_skill = $employee_data['skills']['sub_skills']; 

		$bartender_select = "-webkit-filter: grayscale(70%);";
		$server_select = "-webkit-filter: grayscale(70%);";
		$kitchen_select = "-webkit-filter: grayscale(70%);";
		$bus_select = "-webkit-filter: grayscale(70%);";
		$host_select = "-webkit-filter: grayscale(70%);";
		$manager_select = "-webkit-filter: grayscale(70%);";	
		
		//if they have no skills yet, show splash page
		if ($skill_count == 0) {
			$hide_page = "display:none;";		
		} else {
			$hide_page = "";					
		}

		if ($skill_count > 0) {
		
			foreach($skill_array as $row) {
				switch($row['skill']) {
					case "Bartender":
						$bartender_select = "";
					break;
					
					case "Server":
						$server_select = "";
					break;
					
					case "Kitchen":
						$kitchen_select = "";
					break;
					
					case "Bus":
						$bus_select = "";
					break;
	
					case "Host":
						$host_select = "";
					break;
	
					case "Manager":
						$manager_select = "";
					break;					
				}				
			}
		}		
		
		if ($email_verification == "N") {
			$verification_note = "<h4 style='text-align:center;'><font color='red'>NOTICE:</font>  <a href='main.php?page=verify_email'>You still need to verify your email address</a></h4>";
		} else {
			$verification_note = "";
		}	

		echo "<div class='main_box' style='float:left; width:100%; ".$hide_page."'>";		
			if ($member_data['profile_status'] != "complete") {
				echo "<h3 class='main_skill' style='text-align:center;'>Profile: Step 1 of 4</h3>";
			}
			
			echo $verification_note;
			
			if ($skill_count == 0 && $member_data['profile_status'] != "complete") {
				$skip_button = "<th style='text-align:center; background-color:#DBDCCE; color:#5D0000; width:25%;'><a href='#' class='continue btn btn-warning' ><span style='color:#5D0000;'>Skip</span></a></th>";
			} else {
				$skip_button = "<th style='text-align:center; width:25%; background-color:#DBDCCE; color:#5D0000;'> &nbsp; </th>";
			}
						
				echo	"<div id='top_bar' style='width:100%; text-align:center; margin-top:-2px; display:none'>";
					echo "<div style='width:15%; float:left; background-color:#DBDCCE; text-align:center; min-height:30px; margin-right:0px;'><a href='#' class='back_button' style='color:#5D0000'><h4 style='margin-bottom:10px; margin-top:10px;'>Back</h4></a></div>";
					echo "<div style='width:70%; float:left; background-color:#8e080b; text-align:center; min-height:30px; margin-right:0px;'><h4 style='margin-bottom:10px; margin-top:10px; color:white'>EXPERIENCE</h4></div>";
					echo "<div style='width:15%; float:left; background-color:#DBDCCE; min-height:30px;'><h4 style='margin-bottom:10px; margin-top:10px; color:#5D0000'> &nbsp; </h4></div>";
				echo "</div>";
	
				echo "<table style='width:100%; background-color:#8e080b'>";
				echo "<tr>";
				echo "<th style='line-height:1px;'>&nbsp; </th>";
				echo "</tr>";
				echo "</table>";
			
		echo "<input type='hidden' id='status' value='".$member_data['profile_status']."'>";
		
				echo "<div id='step_one' style='color:#760006'>";
					echo "<h3 class='main_skill' style='text-align:center; margin-top:5px; '> &nbsp; Skills & Experience</h4>";
					echo " <div class='main_skill' style='text-align:center;'>&nbsp; Please select a skill to add to your profile or edit:</div><br />";
					echo "<div id='specialty_warning' style='display:none'><font color='red'>You must select a skill</font></div>";

					echo "<form id='form1'>";
						echo "<div class='main_skill' style='width:100%; float:left; text-align:center;'>";
							echo "<a href='#' class='main_skill' id='Bartender'><img src='images/main-bar.png' height='120px' style='margin-right:20px;".$bartender_select."'></a>";	
							echo "<a href='#' class='main_skill' id='Manager'><img src='images/main-manager.png' height='120px' style='".$manager_select."'></a>";																			
						echo "</div><br />";
						echo "<div class='main_skill' style='width:100%; float:left;  text-align:center;'>";
							echo "<a href='#' class='main_skill' id='Server'><img src='images/main-server.png' height='120px' style='margin-right:20px;".$server_select."'></a>";										
							echo "<a href='#' class='main_skill' id='Kitchen'><img src='images/main-cook.png' height='120px' style='".$kitchen_select."'></a>";										
						echo "</div><br />";
						echo "<div class='main_skill' style='width:100%; float:left; text-align:center;'>";
							echo "<a href='#' class='main_skill' id='Host'><img src='images/main-host.png' height='120px' style='margin-right:20px;".$host_select."'></a>";										
							echo "<a href='#' class='main_skill' id='Bus'><img src='images/main-bus.png' height='120px' style='".$bus_select."'></a>";		
						echo "</div>";
				
					if ($skill_count > 0 && $member_data['profile_status'] != "complete") {
						echo "<div class='main_skill' style='float:left; margin-top:15px; padding-bottom:15px; width:100%; text-align:center;'>";
							echo " <a href='#' class='continue btn btn-primary'>Continue to Next Step</a><br />";
							echo "&nbsp; <br />";
						echo "</div>";
					}			
				
					for ($i = 0; $i<=5; $i++) {
						$experience = "";
						$description = "";
						$seeking = "";
						$current_sub_array = array();
						$remove_button = 'N';
						$skillID = "";
						

						if (count($skill_array) > 0) {
							foreach ($skill_array as $key=>$row) {
								if ($row['skill'] == $name_array[$i]) {
									$experience = $row['experience'];
									$description = $row['description'];
									$seeking = $row['seeking'];
									$current_sub_array = $employee_data['skills']['sub_skills'][$row['skillID']]; 	
									$remove_button = 'Y';
									$skillID = $row['skillID'];
									unset($skill_array[$key]);
								} 
							}
						} 
						
						//Hidden Div that opens when clicking the proper badge
						echo "<div class='skill_holder' id='".$name_array[$i]."_holder' style=' width:100%; margin-top:-30px; margin-left:0px; display:none'>";

						echo "<div style='float:left; text-align:center; margin-top:-20px; margin-bottom:5px; width:100%;'><h3 style='display:inline; vertical-align:middle'>".$name_array[$i]."</h3></div>";

				echo "<table style='width:100%; background-color:#8e080b; margin-bottom:5px;'>";
				echo "<tr>";
				echo "<th style='line-height:1px;'>&nbsp; </th>";
				echo "</tr>";
				echo "</table>";

						if ($seeking == 'N') {
							$n_selected = "selected";
							$y_selected = "";
						} else {
							$n_selected = "";
							$y_selected = "selected";							
						}				

						echo "<div style='float:left; text-align:center; margin-top:0px; width:30%;'>";
							if ($name_array[$i] == "Bartender") {
								echo "<img src='images/main-bar.png' height='85px';>";	
							} elseif ($name_array[$i]== "Manager") {
								echo "<img src='images/main-manager.png' height='80px';>";																			
							} elseif ($name_array[$i] == "Server") {
								echo "<img src='images/main-server.png' height='80px';>";										
							} elseif ($name_array[$i] == "Kitchen") {
								echo "<img src='images/main-cook.png' height='80px';>";										
							} elseif ($name_array[$i] == "Host") {
								echo "<img src='images/main-host.png' height='80px';>";										
							} elseif ($name_array[$i] == "Bus") {
								echo "<img src='images/main-bus.png' height='80px';>";										
							}							
						echo "</div>";
						
					echo "<div style='float:left; width:69%; padding-top:0px; margin-left:0px; margin-bottom:5px;'>";

						echo "<div><b>Seeking this job type?</b> &nbsp; ";
						echo "<select class='seeking' id='".$name_array[$i]."_seeking' style='background-color:#b76163'>";
							echo "<option value='Y' ".$y_selected.">Yes</option>";
							echo "<option value='N' ".$n_selected.">No</option>";
						echo "</select></div><br/>";
						echo "<div style='margin-top:-15px; margin-bottom:5px;'><i style='font-size:11px'>Selecting 'No' will leave these details on your resume, but will not match you with jobs of this type</i></div>";
						
						
						echo "<div id='".$name_array[$i]."_experience_warning' style='display:none; float:left; width:100%;'><font color='red'><b>! Experience must be a number.</b></font></div>";
						echo "<input type='text' class='experience' id='".$name_array[$i]."_experience' value='".$experience."' style='width:40px;'> years of experience.<br />";
					echo "</div>";

				echo "<table style='width:100%; background-color:#8e080b; margin-top:5px;'>";
				echo "<tr>";
				echo "<th style='line-height:1px;'>&nbsp; </th>";
				echo "</tr>";
				echo "</table>";

						echo "<div style='float:left; width:100%; margin-top:10px;'>";
						echo "<div style='font-size:14pt; width:100%; text-align:center;'><b>Specific Skills</b></div>";
						echo "<div style='float:left; margin-left:3px; margin-right:3px;'><b>Important:</b>  <i>These selections are used to identify potential job opportunities for you.</i></div><br/>";
						echo "<div id='".$name_array[$i]."_sub_warning' style='display:none'> &nbsp; &nbsp; <font color='red'><b>! You must select at least one specialty.</b></font></div>";
						echo "<table width='98%' cellpadding='3' style='margin-left:3px;'>";
						echo "<tr>";
						echo "</tr>";
						
						echo "<table style='width:100%'>";
						$row_count = 2;
						foreach($sub_arrays[$i] as $row) {
							$selection = "unselected";
							if (count($current_sub_array) > 0) {
								foreach ($current_sub_array as $sub_skill) {
									if ($sub_skill['sub_skill'] == $row) {
										$selection = "selected";
									}
								}
							}
							
							if ($row_count % 2 == 0) {
								echo "<tr>";						
								echo "<td width='48%'><span class='sub_skill ".$name_array[$i]."_sub_skill ".$selection."_button' data-sub_skill='".$selection."' data-skill_value='$row'><span class='fui-check-inverted' style='color:white; float:left; cursor:pointer'></span> $row</span></td>";
							} else {
								echo "<td width='48%'><span class='sub_skill ".$name_array[$i]."_sub_skill ".$selection."_button' data-sub_skill='".$selection."' data-skill_value='$row'><span class='fui-check-inverted' style='color:white; float:left; cursor:pointer'></span> $row</span></td>";
								echo "</tr>";
							}
							$row_count++;
						}
						if ($row_count % 2 == 0) {	
							echo "</tr>";
						}											
						echo "</table>";
						
						echo "</div>";
						
						echo "<div style='float:left; width:100%; padding-top:10px; margin-bottom:5px; text-align:center;'>";
						echo "Brief description of your experience<br/>";
						echo "<textarea class='skill_desc' id='".$name_array[$i]."_desc' cols='50' rows='5' style='width:90%;'>".$description."</textarea><br />";
						echo "</div>";						
						
						
				echo "<table style='width:100%; background-color:#8e080b'>";
				echo "<tr>";
				echo "<th style='line-height:1px;'>&nbsp; </th>";
				echo "</tr>";
				echo "</table>";
		
						if ($member_data['profile_status'] != "complete") {
							if ($remove_button == "Y") {								
								$width = "33%";
							} else {
								$width = "49.5%";
							}
							echo "<div id='button_holder' style='float:left; width:100%; text-align:center;'>";	
								echo "<div style='width:".$width."; float:left; background-color:#b76e1f; min-height:30px; margin-right:1px;'><a href='#' class='save_add_another' id='".$name_array[$i]."' style='color:white'><h4 style='margin-bottom:10px; margin-top:10px;'>Save & Add Another</h4></a></div>";
								echo "<div style='width:".$width."; float:left; background-color:#b76e1f; min-height:30px; margin-right:1px; text-align:center'><a href='#' class='save_continue' id='".$name_array[$i]."' style='color:white'><h4 style='margin-bottom:10px; margin-top:10px;'>Save & Continue</h4></a></div>";
								if ($remove_button == 'Y') {
									echo "<div style='width:33%; float:left; background-color:#b76e1f; min-height:30px;'><a href='#' class='remove_skill' id='".$skillID."'' style='color:white'><h4 style='margin-bottom:10px; margin-top:10px;'>Delete Experience</h4></a></div>";											
								}
							echo "</div>";
						} else {
							echo "<div id='button_holder' style='float:left; width:100%; text-align:center;'>";	
									echo "<div style='width:50%; float:left; background-color:#b76e1f; min-height:30px; margin-right:1px;'><a href='#' class='save_continue' id='".$name_array[$i]."' style='color:white'><h4 style='margin-bottom:10px; margin-top:10px;'>Save Changes</h4></a></div>";
									if ($remove_button == 'Y') {
										echo "<div style='width:49%; float:right; background-color:#b76e1f; min-height:30px;'><a href='#' class='remove_skill' id='".$skillID."'' style='color:white'><h4 style='margin-bottom:10px; margin-top:10px;'>Delete Experience</h4></a></div>";											
									}
							echo "</div>";
						}
						
				echo "<table style='width:100%; background-color:#8e080b'>";
				echo "<tr>";
				echo "<th style='line-height:1px;'>&nbsp; </th>";
				echo "</tr>";
				echo "</table>";						
						
						echo "</div>";
					}
					echo "</div>";												
				echo "</div>";													
}	

function profile_html_employee_step_two_mobile($member_data, $employee_data) {
		$utilities = new Utilities;
		$employment_array = $employee_data['employment'];
		$employment_version = $employee_data['employment_version'];			
		
		if ($employment_version == "new" && count($employment_array) > 0) {
			$new_employment_array = $utilities->reorder_employment($employment_array);
		} else {
			$new_employment_array = $employment_array;
		}					
		
		
		echo "<div class='main_box' style='float:left; width:100%; margin-top:0px; margin-bottom:10px; '>";				

		if  ($member_data['profile_status'] != "complete") {
			$back = "<a href='#' class='back'><h4 style='margin-bottom:10px; margin-top:10px; color:#5D0000'>Back</h4></a>";
			$skip = "<a href='#' class='continue'><h4 style='margin-bottom:10px; margin-top:10px; color:#5D0000'>Skip</h4></a>";
			$step = "<h3 style='text-align:center;'>Profile: Step 2 of 4</h3>";
		} else {
			$back = "<h4 style='margin-bottom:10px; margin-top:10px;'> &nbsp; </h4>";
			$skip = "<h4 style='margin-bottom:10px; margin-top:10px;'> &nbsp; </h4>";
			$step = "";
		}

		echo	"<div id='top_bar' style='width:100%; text-align:center; '>";
			echo "<div style='width:15%; float:left; background-color:#DBDCCE; text-align:center; min-height:30px;'>".$back."</div>";
			echo "<div style='width:70%; float:left; background-color:#8e080b; text-align:center; min-height:30px;'><h4 style='margin-bottom:10px; margin-top:10px; color:white'>EMPLOYMENT</h4></div>";
			echo "<div style='width:15%; float:left; background-color:#DBDCCE; min-height:30px;'>".$skip."</div>";
		echo "</div>";

		echo "<table style='width:100%; background-color:#8e080b'>";
		echo "<tr>";
		echo "<th style='line-height:1px;'>&nbsp; </th>";
		echo "</tr>";
		echo "</table>";
				
		echo $step; 
							
				echo "<div id='step_two' style='color:#760006'>";
					
					echo "<div id='employment_list'>";
					if (count($new_employment_array) > 0) {
						echo "<div class='visible_employment' style='float:left; width:100%; margin-left:5px; margin-right:5px; margin-bottom:-25px;'>";
							echo "<div style='float:left; width:35%; text-align:center;'><h4>Company</h4></div>";
							echo "<div style='float:left; width:30%; text-align:center;'><h4>Position</h4></div>";
							echo "<div style='float:left; width:20%; text-align:center;'><h4>Dates</h4></div>";						
							echo "<div style='float:left; width:10%; text-align:center;'><h4>Edit</h4></div>";						
						echo "</div>";

						echo "<table class='visible_employment' style='width:100%;'>";
						echo "<tr>";
						echo "<th style='line-height:1px; background-color:#e9e6de'>&nbsp; </th>";
						echo "</tr>";
						echo "</table>";	
						
						
						foreach ($new_employment_array as $row) {
							$start_date = $row['start_month']."/".$row['start_year'];
							if ($row['current'] == 'Y') {
								$end_date = 'Current';
							} else {
								$end_date = $row['end_month']."/".$row['end_year'];					
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
							
							//Visible table
							$emp_date = $start_date."-".$end_date." ".$time;
							echo "<table class='visible_employment' cellspacing='6' cellpadding='6' style='margin-left:0px; margin-bottom:0px; width:98%; table-layout:fixed;' id='employment_".$row['ID']."'>";							
							echo "<tr>";
							echo "<td width='35%' style='word-wrap: break-word;'><b>".$row['company']."</b></td>";
							echo "<td width='30%' style='word-wrap: break-word;'>".$row['position']."</td>";		
							echo "<td width='25%' style='word-wrap: break-word;'>".$emp_date."</td>";
							echo "<td width='10%'><a href='#' class='edit_work' id='".$row['ID']."'><img src='images/edit.png'></a></td>";	

							echo "</tr>";
							echo "</table>";	
							
							echo "<table class='visible_employment' style='width:100%;'>";
							echo "<tr>";
							echo "<th style='line-height:1px; background-color:#e9e6de'>&nbsp; </th>";
							echo "</tr>";
							echo "</table>";								

							$jan_start = $feb_start =$mar_start = $apr_start = $may_start = $jun_start = $jul_start = $aug_start = $sep_start = $oct_start = $nov_start = $dec_start = ""; 
							$jan_end = $feb_end =$mar_end = $apr_end = $may_end = $jun_end = $jul_end = $aug_end = $sep_end = $oct_end = $nov_end = $dec_end = ""; 
							
							switch($row['start_month']) {
								case "1":
									$jan_start = 'selected';
								break;
								case "2":
									$feb_start = 'selected';
								break;
								case "3":
									$mar_start = 'selected';
								break;
								case "4":
									$apr_start = 'selected';
								break;
								case "5":
									$may_start = 'selected';
								break;
								case "6":
									$jun_start = 'selected';
								break;
								case "7":
									$jul_start = 'selected';
								break;
								case "8":
									$aug_start = 'selected';
								break;
								case "9":
									$sep_start = 'selected';
								break;
								case "10":
									$oct_start = 'selected';
								break;
								case "11":
									$nov_start = 'selected';
								break;
								case "12":
									$dec_start = 'selected';
								break;				
							}
							
							switch($row['end_month']) {
								case "1":
									$jan_end = 'selected';
								break;
								case "2":
									$feb_end = 'selected';
								break;
								case "3":
									$mar_end = 'selected';
								break;
								case "4":
									$apr_end = 'selected';
								break;
								case "5":
									$may_end = 'selected';
								break;
								case "6":
									$jun_end = 'selected';
								break;
								case "7":
									$jul_end = 'selected';
								break;
								case "8":
									$aug_end = 'selected';
								break;
								case "9":
									$sep_end = 'selected';
								break;
								case "10":
									$oct_end = 'selected';
								break;
								case "11":
									$nov_start = 'selected';
								break;
								case "12":
									$dec_end = 'selected';
								break;				
							} 	
							
							if ($row['current'] == 'Y') {
								$selection = "selected";
							} else {
								$selection = "unselected";
							}						 
							
							//Hidden table for editing
							echo "<div class='hidden_employment' style='display:none' id='employment_record_".$row['ID']."'>";

								echo "<h4 style='text-align:center;'>Edit Employment Record</h4>";
								echo "<div id='company_empty_warning_".$row['ID']."' style='display:none; float:left; width:100%; margin-top:10px; text-align:center;'><font color='red'><b>COMPANY CANNOT BE BLANK.</b></font></div>";								
								echo "<div id='year_warning_".$row['ID']."' style='display:none; margin-left:10px; margin-top:5px; margin-bottom:-10px;'><font color='red'><b>PLEASE ENTER A VALID YEAR (e.g. 2012)</b></font></div>";			  
								echo "<div id='greater_warning_".$row['ID']."' style='display:none; margin-left:10px; margin-top:5px; margin-bottom:-10px;'><font color='red'><b>START DATE CANNOT BE LATER THAN END DATE</b></font></div>";			  
	
								echo "<table align='center' style='width:100%; margin-top:20px;'>";
									echo "<tr>";
									echo "<td><b>Company:</b></td><td><input type='text' id='company_".$row['ID']."' value='".$row['company']."'></td>";
									echo "</tr>";
									echo "<tr>";
									echo "<td><b>Website:</b></td><td><input type='text' id='website_".$row['ID']."' value='".$row['website']."'></td>";
									echo "</tr>";
									echo "<tr>";
									echo "<td><b>Position:</b></td><td><input type='text' id='position_".$row['ID']."' value='".$row['position']."'></td>";		
									echo "</tr>";
									echo "<tr>";
										echo "<td><b>Start Date: &nbsp; </b></td>";
										echo "<td><select id='start_month_".$row['ID']."'>";
													echo "<option value='1' ".$jan_start." >Jan.</option>";
													echo "<option value='2' ".$feb_start." >Feb.</option>";
													echo "<option value='3' ".$mar_start." >Mar.</option>";
													echo "<option value='4' ".$apr_start." >Apr.</option>";
													echo "<option value='5' ".$may_start." >May</option>";
													echo "<option value='6' ".$jun_start." >June</option>";
													echo "<option value='7' ".$jul_start." >July</option>";
													echo "<option value='8' ".$aug_start." >Aug.</option>";
													echo "<option value='9' ".$sep_start." >Sep.</option>";
													echo "<option value='10' ".$oct_start." >Oct.</option>";
													echo "<option value='11' ".$nov_start." >Nov.</option>";
													echo "<option value='12' ".$dec_start." >Dec.</option>";
												echo "</select>";	
												echo "<input type='text' name='start_year' id='start_year_".$row['ID']."' maxlength='4' style='width:50px;' value='".$row['start_year']."'></input> (Year <i>XXXX</i>)";
										echo "</td>";
									echo "</tr>";
									echo "<tr>";
										echo "<td class='end'><b>End Date: &nbsp; </b></td>";
										echo "<td class='end'><select id='end_month_".$row['ID']."'>";
													echo "<option value='1' ".$jan_end." >Jan.</option>";
													echo "<option value='2' ".$feb_end." >Feb.</option>";
													echo "<option value='3' ".$mar_end." >Mar.</option>";
													echo "<option value='4' ".$apr_end." >Apr.</option>";
													echo "<option value='5' ".$may_end." >May</option>";
													echo "<option value='6' ".$jun_end." >June</option>";
													echo "<option value='7' ".$jul_end." >July</option>";
													echo "<option value='8' ".$aug_end." >Aug.</option>";
													echo "<option value='9' ".$sep_end." >Sep.</option>";
													echo "<option value='10' ".$oct_end." >Oct.</option>";
													echo "<option value='11' ".$nov_end." >Nov.</option>";
													echo "<option value='12' ".$dec_end." >Dec.</option>";
												echo "</select>";	
												echo "<input type='text' name='end_year' id='end_year_".$row['ID']."' maxlength='4' style='width:50px;' value='".$row['end_year']."'></input> (Year <i>XXXX</i>)";
										echo "</td>";
									echo "</tr>";
						
									echo "<tr>	";	
										echo "<td> &nbsp; </td>";
										echo "<td>";									
												echo "<span style='100%;' class='current_employment ".$selection."_button' id='current_employment_".$row['ID']."' data-current_employment='".$selection."'><span class='fui-check-inverted' style='color:white; float:left; cursor:pointer'></span>Currently Employed</span>";
												//echo "<br /> &nbsp; <label class='checkbox'><input type='checkbox' id='current_".$row['ID']."' value='Current' data-toggle='checkbox' ".$checked." > Currently Employed</label>";
											echo "</td>";
									echo "</tr>";		
													
								echo "</table>";
								echo " &nbsp <br />";

								echo "<table style='width:100%; background-color:#8e080b; margin-top:0px;'>";
								echo "<tr>";
								echo "<th style='line-height:1px;'>&nbsp; </th>";
								echo "</tr>";
								echo "</table>";					
													
								echo "<div id='button_holder' style='float:left; width:100%; text-align:center;'>";	
									echo "<div style='width:33%; float:left; background-color:#b76e1f; min-height:30px; margin-right:1px;'><a href='#' class='save_changes' id='".$row['ID']."' style='color:white'><h4 style='margin-bottom:10px; margin-top:10px;'>Save</h4></a></div>";
									echo "<div style='width:33%; float:left; background-color:#b76e1f; min-height:30px; margin-right:1px; text-align:center'><a href='#'  class='remove_work' id='".$row['ID']."' style='color:white'><h4 style='margin-bottom:10px; margin-top:10px;'>Delete</h4></a></div>";
									echo "<div style='width:33%; float:left; background-color:#DBDCCE; min-height:30px; margin-right:1px; text-align:center'><a href='#' class='cancel' style='color:white'><h4 style='margin-bottom:10px; margin-top:10px; color:#5D0000;'>Cancel</h4></a></div>";
								echo "</div>";	
								
								echo "<table style='width:100%; background-color:#8e080b; margin-top:0px;'>";
								echo "<tr>";
								echo "<th style='line-height:1px;'>&nbsp; </th>";
								echo "</tr>";
								echo "</table>";														

							echo "</div>";							
						}
					}			
					echo "</div>";	
					
					echo "<div class='add_work_form' style='text-align:center'>";
						
					echo	"<div id='top_bar' style='width:100%; float:left; text-align:center; margin-bottom:10px;'>";
						echo "<div style='width:100%; float:left; background-color:#8e080b; text-align:center; min-height:30px;'><h4 style='margin-bottom:10px; margin-top:10px; color:white'> &nbsp; </h4></div>";
					echo "</div>";
			
					echo "<h4 style='text-align:center'>Add New Employment Record</h4>";
						
?>					
					
						<div id="past_company_empty_warning" style="display:none; margin-left:10px; margin-top:5px;"><font color="red"><b>COMPANY CANNOT BE BLANK.</b></font></div>		  
						<div id="year_warning" style="display:none; margin-left:10px; margin-top:5px;"><font color="red"><b>PLEASE ENTER A VALID YEAR (e.g. 2012)</b></font></div>			  
						<div id="greater_warning" style="display:none; margin-left:10px; margin-top:5px;"><font color="red"><b>START DATE CANNOT BE LATER THAN END DATE</b></font></div>	  

						<table align='center' style='width:100%'>
						<tr>
							<td><b>Company: &nbsp; </b></td>
							<td><input type="text" name="past_company" id="past_company"></input></td>
						</tr>
						<tr>
							<td><b>Website: &nbsp; </b></td>
							<td><input type="text" name="past_website" id="past_website" ></input></td>
						</tr>			
						<tr>
							<td><b>Position: &nbsp; </b></td>
							<td><input type="text" name="past_position" id="past_position" ></input></td>
						</tr>
						<tr>
							<td><b>Start Date: &nbsp; </b></td>
							<td><select id="start_month">
										<option value='1'>Jan.</option>
										<option value='2'>Feb.</option>
										<option value='3'>Mar.</option>
										<option value='4'>Apr.</option>
										<option value='5'>May</option>
										<option value='6'>June</option>
										<option value='7'>July</option>
										<option value='8'>Aug.</option>
										<option value='9'>Sep.</option>
										<option value='10'>Oct.</option>
										<option value='11'>Nov.</option>
										<option value='12'>Dec.</option>
									</select>	
									<input type="text" id="start_year" maxlength="4" style='width:50px;'></input> (Year <i>XXXX</i>)
							</td>
						</tr>
						<tr>
							<td class='end'><b>End Date: &nbsp; </b></td>
							<td class='end'><select id="end_month">
										<option value='1'>Jan.</option>
										<option value='2'>Feb.</option>
										<option value='3'>Mar.</option>
										<option value='4'>Apr.</option>
										<option value='5'>May</option>
										<option value='6'>June</option>
										<option value='7'>July</option>
										<option value='8'>Aug.</option>
										<option value='9'>Sep.</option>
										<option value='10'>Oct.</option>
										<option value='11'>Nov.</option>
										<option value='12'>Dec.</option>
									</select>	
									<input type="text" id="end_year" maxlength="4" style='width:50px;'></input> (Year <i>XXXX</i>)
							</td>
						</tr>	
						<tr>		
							<td> &nbsp; </td>
							<td>
								<span style='width:100%' id='current_employment' class='current_employment unselected_button' data-current_employment='unselected'><span class='fui-check-inverted' style='color:white; float:left; cursor:pointer;'></span> Currently Employed</span>
								
<!-- 									&nbsp; <label class='checkbox'><input type="checkbox" id="current" value="Current" data-toggle='checkbox'> Currently Employed</label> -->
							</td>
						</tr>						
					</table>
					&nbsp; <br />
<?php	
				echo "<table style='width:100%; background-color:#8e080b'>";
				echo "<tr>";
				echo "<th style='line-height:1px;'>&nbsp; </th>";
				echo "</tr>";
				echo "</table>";	
	
				if ($member_data['profile_status'] == "complete") {
					echo "<div id='button_holder' style='float:left; width:100%; text-align:center;'>";	
						echo "<div style='width:75%; float:left; background-color:#b76e1f; min-height:30px; margin-right:1px;'><a href='#' class='save_continue' style='color:white'><h4 style='margin-bottom:10px; margin-top:10px;'>Save New Employment</h4></a></div>";
						echo "<div style='width:24%; float:left; background-color:#b76e1f; min-height:30px;'><a href='employee.php' style='color:white'><h4 style='margin-bottom:10px; margin-top:10px;'>Cancel</h4></a></div>";
					echo "</div>";					
				} else {	
					echo "<div id='button_holder' style='float:left; width:100%; text-align:center;'>";	
						echo "<div style='width:50%; float:left; background-color:#b76e1f; min-height:30px; margin-right:1px;'><a href='#' class='save_add_another' style='color:white'><h4 style='margin-bottom:10px; margin-top:10px;'>Save & Add Another</h4></a></div>";
						echo "<div style='width:49%; float:right; background-color:#b76e1f; min-height:30px; text-align:center'><a href='#' class='save_continue' style='color:white'><h4 style='margin-bottom:10px; margin-top:10px;'>Save & Continue</h4></a></div>";
					echo "</div>";										
				}	
				
				echo "<table style='width:100%; background-color:#8e080b'>";
				echo "<tr>";
				echo "<th style='line-height:1px;'>&nbsp; </th>";
				echo "</tr>";
				echo "</table>";				
				
				echo "</div>";																						
				echo "</div>";														
				echo "</div>";																						
}

function profile_html_employement_correction_mobile($member_data, $employee_data) {
	//This section is used for profiles that didn't have proper date format on their past employment when the Pas Employment section was updated.
	//IT allows them to manually correct the dates
		$utilities = new Utilities;
		$past_employment_array = $employee_data['employment'];

		echo "<div class='main_box' style='margin-top:70px; margin-bottom:15px; '>";				
		
		echo	"<table class='dark add_work_form' style='width:100%;'>";
			echo "<tr valign='middle'>";
			echo "<th valign='middle' align='center'><b>Past Employment</b></th>";
			echo "</tr>";			
		echo "</table>";
							
				echo "<div id='step_two' style='color:#760006'>";
			echo "<div id='employment_list'>";
	
		if (count($past_employment_array) > 0) {
			echo "<h4 style='color:red; margin-top:5px;'>Please add dates to the employment records below (you can edit other details after dates have been added)</h4>";
			foreach ($past_employment_array as $row) {
				echo "<table class='visible_employment' style='width:100%;'>";
				echo "<tr>";
				echo "<th style='line-height:1px; background-color:#e9e6de'>&nbsp; </th>";
				echo "</tr>";
				echo "</table>";	

				echo "<div class='old_employment' style='float:left; width:100%; margin-left:10px;' id='".$row['ID']."'>";
					echo "<div id='year_warning_".$row['ID']."' class='warning' style='display:none; float:left; width:100%; margin-top:5px; color:red;'><b>! PLEASE ENTER A VALID YEAR (e.g. 2012)</b></div>";			  
					echo "<div id='greater_warning_".$row['ID']."' class='warning' style='display:none; float:left; width:100%;  margin-top:5px; color:red;'><b>! START DATE CANNOT BE LATER THAN END DATE</b></div>";			  
				
					echo "<table style='margin-bottom:20px;'>";
						echo "<tr>";
							echo "<td width:40%;><b>".$row['company']." - ".$row['position']."'</b></td>";
							echo "<td><a href='#' class='remove_work' id='".$row['ID']."'>Remove Record</a></td>";														
						echo "</tr>";
						echo "<tr>";
							echo "<td>Start Date: &nbsp; </td>";
							echo "<td><select id='start_month_".$row['ID']."'>";
										echo "<option value='1'>Jan.</option>";
										echo "<option value='2'>Feb.</option>";
										echo "<option value='3'>Mar.</option>";
										echo "<option value='4'>Apr.</option>";
										echo "<option value='5'>May</option>";
										echo "<option value='6'>June</option>";
										echo "<option value='7'>July</option>";
										echo "<option value='8'>Aug.</option>";
										echo "<option value='9'>Sep.</option>";
										echo "<option value='10'>Oct.</option>";
										echo "<option value='11'>Nov.</option>";
										echo "<option value='12'>Dec.</option>";
									echo "</select>";	
									echo "<input type='text' name='start_year' id='start_year_".$row['ID']."' maxlength='4' style='width:45px;'></input> (Year <i>XXXX</i>)";
							echo "</td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td class='end'>End Date: &nbsp; </td>";
							echo "<td class='end'><select id='end_month_".$row['ID']."'>";
										echo "<option value='1'>Jan.</option>";
										echo "<option value='2'>Feb.</option>";
										echo "<option value='3'>Mar.</option>";
										echo "<option value='4'>Apr.</option>";
										echo "<option value='5'>May</option>";
										echo "<option value='6'>June</option>";
										echo "<option value='7'>July</option>";
										echo "<option value='8'>Aug.</option>";
										echo "<option value='9'>Sep.</option>";
										echo "<option value='10'>Oct.</option>";
										echo "<option value='11' >Nov.</option>";
										echo "<option value='12'>Dec.</option>";
									echo "</select>";	
									echo "<input type='text' name='end_year' id='end_year_".$row['ID']."' maxlength='4' style='width:45px;'></input> (Year <i>XXXX</i>)";
								echo "</td>";
						echo "</tr>";
						echo "<tr>";
								echo "<td colspan='2'>";
									echo "&nbsp; <label class='checkbox'><input type='checkbox' id='current_".$row['ID']."' value='Current' data-toggle='checkbox'>Currently Employed</label>";
								echo "</td>";
						echo "</tr>";						
					echo "</table>";				
				echo "</div>";							
			}	
		echo "&nbsp; <br />";	
		echo "<div id='button_holder' style='float:left; width:100%; text-align:center; padding-bottom:20px;'><a href='#' class='btn btn-large btn-primary fix_employment'>Save Changes</a></div>";
	}
	
	echo "</div>";																						
	echo "</div>";														
	echo "</div>";																														
}

function profile_html_employee_step_three_mobile($member_data, $employee_data) {
		$education_array = $employee_data['education'];
		
		echo "<div class='main_box' style='float:left; margin-top:0px; margin-bottom:10px; width:100%; '>";				

		if  ($member_data['profile_status'] != "complete") {
			$back = "<a href='#' class='back'><h4 style='margin-bottom:10px; margin-top:10px; color:#5D0000'>Back</h4></a>";
			$skip = "<a href='#' class='continue'><h4 style='margin-bottom:10px; margin-top:10px; color:#5D0000'>Skip</h4></a>";
			$step = "<h3 style='text-align:center;'>Profile: Step 3 of 4</h3>";
		} else {
			$back = "<h4 style='margin-bottom:10px; margin-top:10px;'> &nbsp; </h4>";
			$skip = "<h4 style='margin-bottom:10px; margin-top:10px;'> &nbsp; </h4>";
			$step = "";
		}

		echo	"<div id='top_bar' style='width:100%; float:left; text-align:center; '>";
			echo "<div style='width:15%; float:left; background-color:#DBDCCE; text-align:center; min-height:30px;'>".$back."</div>";
			echo "<div style='width:70%; float:left; background-color:#8e080b; text-align:center; min-height:30px;'><h4 style='margin-bottom:10px; margin-top:10px; color:white'>EDUCATION</h4></div>";
			echo "<div style='width:15%; float:left; background-color:#DBDCCE; min-height:30px;'>".$skip."</div>";
		echo "</div>";

		echo "<table style='width:100%; background-color:#8e080b'>";
		echo "<tr>";
		echo "<th style='line-height:1px;'>&nbsp; </th>";
		echo "</tr>";
		echo "</table>";
				
		echo $step; 
									
				echo "<div id='step_three' style='color:#760006; '>";					
					echo "<div id='education_list' style=''>";
					if (count($education_array) > 0) {
						echo "<div class='visible_education' style='float:left; width:100%; margin-left:5px; margin-right:5px; margin-bottom:-25px;'>";
							echo "<div style='float:left; width:40%; text-align:center;'><h4>School <br /> Institution</h4></div>";
							echo "<div style='float:left; width:40%; text-align:center;'><h4>Certification <br /> Degree</h4></div>";
							echo "<div style='float:left; width:20%; text-align:center;'><h4>Edit</h4></div>";						
						echo "</div>";

				echo "<table class='visible_education' style='width:100%;'>";
				echo "<tr>";
				echo "<th style='line-height:1px; background-color:#e9e6de'>&nbsp; </th>";
				echo "</tr>";
				echo "</table>";	

						foreach ($education_array as $row) {
								echo "<table class='visible_education' cellspacing='6' cellpadding='6' style='margin-left:0px; margin-bottom:5px; width:98%; table-layout:fixed;'>";							

								echo "<tr>";
								echo "<td style='width:50%' style='word-wrap: break-word;'><b>".$row['school']."</b></td>";
								echo "<td style='width:40%' style='word-wrap: break-word;'>".$row['degree']."</td>";
								echo "<td align='right' style='width:10%'><a href='#' class='edit_education' id='".$row['ID']."'><img src='images/edit.png'></a></td>";	
								echo "</tr>";
								echo "</table>";		
								
								echo "<table class='visible_education' style='width:100%;'>";
								echo "<tr>";
								echo "<th style='line-height:1px; background-color:#e9e6de'>&nbsp; </th>";
								echo "</tr>";
								echo "</table>";	
						
							
							//Hidden table for editing
								echo "<div class='hidden_education' id='education_".$row['ID']."_edit' style='display:none;'>";
								echo "<h4 style='text-align:center;'>Edit Employment Record</h4>";
								echo "<div id='school_empty_warning_".$row['ID']."' style='display:none; margin-top:3px; text-align:center;'><font color='red'><b>INSTITUTION CANNOT BE BLANK.</b></font></div>";

								echo "<table style='width:100%; margin-top:20px;'>";
									echo "<tr>";
									echo "<td width='98%' align='center'><b>Institution:</b></td>";
									echo "</tr>";
									echo "<tr>";
									echo "<td width='98%' align='center'><input type='text' id='school_".$row['ID']."' value='".$row['school']."' style='width:95%;'></td>";
									echo "</tr>";
									echo "<tr>";
									echo "<td width='98%' align='center'><b>Degree/Certification:</b></td>";
									echo "</tr>";
									echo "<tr>";
									echo "<td width='98%' align='center'><input type='text' id='degree_".$row['ID']."'  value='".$row['degree']."' style='width:95%;'></td>";		
									echo "</tr>";
									
								echo "</table>";
								echo " &nbsp <br />";

								echo "<table style='width:100%; background-color:#8e080b; margin-top:0px;'>";
								echo "<tr>";
								echo "<th style='line-height:1px;'>&nbsp; </th>";
								echo "</tr>";
								echo "</table>";					
													
								echo "<div id='button_holder' style='float:left; width:100%; text-align:center;'>";	
									echo "<div style='width:33%; float:left; background-color:#b76e1f; min-height:30px; margin-right:1px;'><a href='#' class='save_changes' id='".$row['ID']."' style='color:white'><h4 style='margin-bottom:10px; margin-top:10px;'>Save</h4></a></div>";
									echo "<div style='width:33%; float:left; background-color:#b76e1f; min-height:30px; margin-right:1px; text-align:center'><a href='#'  class='remove_education' id='".$row['ID']."' style='color:white'><h4 style='margin-bottom:10px; margin-top:10px;'>Delete</h4></a></div>";
									echo "<div style='width:33%; float:left; background-color:#DBDCCE; min-height:30px; margin-right:1px; text-align:center'><a href='#' class='cancel' style='color:white'><h4 style='margin-bottom:10px; margin-top:10px; color:#5D0000;'>Cancel</h4></a></div>";
								echo "</div>";	
								
								echo "<table style='width:100%; background-color:#8e080b; margin-top:0px;'>";
								echo "<tr>";
								echo "<th style='line-height:1px;'>&nbsp; </th>";
								echo "</tr>";
								echo "</table>";														
							
								
							echo "</div>";
						}
					}			
					
					echo "</div>";
					
					echo "<div class='add_education_form' style='text-align:center;'>";
					
		echo	"<div id='top_bar' style='width:100%; float:left; text-align:center; margin-bottom:10px;'>";
			echo "<div style='width:100%; float:left; background-color:#8e080b; text-align:center; min-height:30px;'><h4 style='margin-bottom:10px; margin-top:10px; color:white'> &nbsp; </h4></div>";
		echo "</div>";

		echo "<h4 style='text-align:center'>New Education/Certification</h4>";
									
?>
					<div id="school_empty_warning" style="display:none; margin-top:3px; text-align:center;"><font color="red"><b>INSTITUTION CANNOT BE BLANK.</b></font></div>
					<table class='add_education_form' style='width:98%;'>
					<tr>
						<td width='100%' style='text-align:center'><b>School/Institution: &nbsp; </b></td>
					</tr>
					<tr>
						<td width='100%'><input type="text" name="school" id="school" style='width:100%'></input></td>
					</tr>
					<tr>
						<td width='100%' style='text-align:center'><b>Degree/Certification: &nbsp; </b></td>
					</tr>
					<tr>	
						<td width='100%'><input type="text" name="degree" id="degree" style='width:100%'></input></td>
					</tr>
				</table>
				&nbsp; <br />
<?php		
	
				echo "<table style='width:100%; background-color:#8e080b'>";
				echo "<tr>";
				echo "<th style='line-height:1px;'>&nbsp; </th>";
				echo "</tr>";
				echo "</table>";
	
	
				if ($member_data['profile_status'] == "complete") {
					echo "<div id='button_holder' style='float:left; width:100%; text-align:center;'>";	
						echo "<div style='width:75%; float:left; background-color:#b76e1f; min-height:30px; margin-right:1px;'><a href='#' class='save_continue' style='color:white'><h4 style='margin-bottom:10px; margin-top:10px;'>Save New Education Record</h4></a></div>";
						echo "<div style='width:24%; float:left; background-color:#b76e1f; min-height:30px;'><a href='employee.php' style='color:white'><h4 style='margin-bottom:10px; margin-top:10px;'>Cancel</h4></a></div>";
					echo "</div>";					
				} else {	
					echo "<div id='button_holder' style='float:left; width:100%; text-align:center;'>";	
						echo "<div style='width:50%; float:left; background-color:#b76e1f; min-height:30px; margin-right:1px;'><a href='#' class='save_add_another' style='color:white'><h4 style='margin-bottom:10px; margin-top:10px;'>Save & Add Another</h4></a></div>";
						echo "<div style='width:49%; float:right; background-color:#b76e1f; min-height:30px; text-align:center'><a href='#' class='save_continue' style='color:white'><h4 style='margin-bottom:10px; margin-top:10px;'>Save & Continue</h4></a></div>";
					echo "</div>";										
				}	
				
				echo "<table style='width:100%; background-color:#8e080b'>";
				echo "<tr>";
				echo "<th style='line-height:1px;'>&nbsp; </th>";
				echo "</tr>";
				echo "</table>";				
				
				echo "</div>";
				echo "</div>";
				echo "</div>";																														
}

function profile_html_employee_step_four_mobile($member_data, $employee_data) {
$utilities = new Utilities;
//!!!!!!!CHANGE THIS FOR LIVE SITE!!!!!!!
$site_type = $utilities->site_type;

if ($site_type == "live") {
	$upload_url = "http://servebartendcook.com/upload_pic";
} elseif ($site_type == "prototype") {
	$upload_url = "http://threewhitebirds.com/SBC/upload_pic";	
}

	$skill_array = $employee_data['skills']['skills'];
	
	$bartender = false;
	$kitchen = false;
	
	foreach($skill_array as $row) {
		if ($row['skill'] == "Bartender") {
			$bartender = true;
		}
		
		if ($row['skill'] == "Kitchen") {
			$kitchen = true;
		}		
	}

	if ($type == "menu") {
		if ($bartender == false && $kitchen == false) {
			$type = "profile";
		}
	}


		$video_array = $employee_data['video'];
		foreach($video_array as $row) {
			$video_url = $row['url'];
			$videoID = $row['videoID'];
		}
		$photo = $employee_data['general']['profile_pic'];		
		
		echo "<div class='main_box' style='float:left; width:100%;'>";				

		echo	"<div id='top_bar' style='width:100%; float:left; text-align:center; '>";
			echo "<div style='width:15%; float:left; background-color:#DBDCCE; text-align:center; min-height:30px;'><a href='#' class='back'><h4 style='margin-bottom:10px; margin-top:10px; color:#5D0000'>Back</h4></a></div>";
			echo "<div style='width:70%; float:left; background-color:#8e080b; text-align:center; min-height:30px;'><h4 style='margin-bottom:10px; margin-top:10px; color:white'>PERSONALIZE</h4></div>";
			echo "<div style='width:15%; float:left; background-color:#DBDCCE; min-height:30px;'><h4 style='margin-bottom:10px; margin-top:10px;'> &nbsp; </h4></div>";
		echo "</div>";

		echo "<table style='width:100%; background-color:#8e080b'>";
		echo "<tr>";
		echo "<th style='line-height:1px;'> &nbsp; </th>";
		echo "</tr>";
		echo "</table>";
				
		echo "<h3 style='text-align:center;'>Profile: Step 4 of 4</h3>";					
		echo "<table style='width:100%; background-color:#8e080b;'>";
		echo "<tr>";
		echo "<th style='line-height:1px;'> &nbsp; </th>";
		echo "</tr>";
		echo "</table>";


		$pic_options = "<div style='float:left; width:100%; margin-top:10px; margin-left:5px; color:#760006'>";
		$pic_options .= "<h4 style='text-align:center'>Profile Photo (<i>optional</i>)</h4>";		

		if ($photo == "") {
			$pic_options .= "<div class='photo_holder' style='float:left; width:100%; min-height:50px; text-align:center''><span class='button_holder_photo'><a href='#' id='profile' class='add_photo btn btn-primary'>Add Profile Photo</a></span>";
//			$pic_options .= "<div id='loader' style='float:left; width:100%; text-align:center; display:none;'>Loading....</div>";		
//			$pic_options .= "<div id='file_size_warning' style='float:left; margin-top:10px; color:red; width:100%; text-align:center; display:none;'>File too large.  Must be less than 4 MB.</div>";		
			$pic_options .= "<div id='status' style='color:red; width:100%; text-align:center; float:left;'></div>";		
//			$pic_options .= "</form>";
			$pic_options .= "</div>";		
			
			$photo_edit = "";
		} else {
			$pic_options .= "<div class='photo_holder' style='float:left; width:100%; min-height:170px;'>";			
			$pic_options .= "<div id='loader' style='float:left; width:100%; text-align:center; display:none;'>Loading....</div>";		
			$pic_options .= "<div id='photo_buttons' style='float:left; width:50%; margin-top:15px; margin-left:15px;'><span id='button_holder_photo'><a href='#' class='add_photo btn btn-primary' id='profile'>Change Profile Photo</a></span> <br /> &nbsp; <br /> &nbsp; <br /> <a href='#' class='remove_photo btn btn-primary' id='profile'>Remove Profile Photo</a></div>";		
			$pic_options .= "<div id='profile_pic' style='float:left;'><img src='images/profile_pics/".$photo."' height='130' width='130'></div>";
			$pic_options .= "<div id='status' style='color:red'></div>";		
//			$pic_options .= "</form>";			
			$pic_options .= "</div>";
			
		}
		$pic_options .= "</div>";
		
		echo $pic_options;
		echo "<div id='file_size_warning' style='color:red; width:100%; text-align:center; display:none;'>&nbsp; <br /><b>Please choose a file less than 4 MB</b></div>";
		echo "<div id='file_type_warning' style='color:red; width:100%; text-align:center; display:none;'>&nbsp; <br /><b>Please choose a PNG or JPG file</b></div>";

		if ($kitchen == true || $bartender == true) {
			echo "<h4 style='text-align:center; color:#760006'>Other Photos (<i>optional</i>)</h4>";
		}
		if ($kitchen == true) {
			echo "<div style='float:left; margin-bottom:25px; text-align:center; width:100%'><a href='employee.php?page=edit_photo&type=kitchen' class='btn btn-primary'>Culinary Photos</a></div>";													
		}
		
		if ($bartender == true) {
			echo "<div style='float:left; margin-bottom:20px; text-align:center; width:100%'><a href='employee.php?page=edit_photo&type=bar' class='btn btn-primary'>Cocktail Photos</a></div>";													
		}									

		echo "<table style='width:100%; background-color:#8e080b'>";
		echo "<tr>";
		echo "<th style='line-height:1px;'> &nbsp; </th>";
		echo "</tr>";
		echo "</table>";
		
?>
		<div id="add_photo_tools" style="margin-top:-15px;">			
		    <form id="myform" action="<? echo $upload_url ?>.php?type=profile" method="post" enctype="multipart/form-data" style="position:absolute; top:-500px;">
		        <input type="file" id="profile_pic_choose" name="profile_pic_choose" >
				<input type="submit" value="Save Profile Pic1" id="profile_upload_button"><br />
			</form>
		</div>

<?php

		echo "<div style='float:left; width:100%; text-align:center; margin-top:10px; color:#760006'>";		
		echo "<h4>Video Resume (<i>optional</i>)</h4>";

	if (count($video_array) > 0) {
			echo "<div style='text-align:center; margin-top:15px;'>";

				echo "<div style='float:left; width:100%'>";	
					echo "<div style='float:left; width:100%; text-align:center;'>";
					echo "<a href='#' class='video_button btn btn-primary' id='watch_video'>View Video</a> <a href='#' class='btn btn-primary' id='close_video' style='display:none'>Close Video</a>";	
					echo "&nbsp; ";					
					echo "<a href='#' class='btn btn-primary remove_video' id='".$videoID."'>Remove Video</a><br />";
					echo "</div>";
					echo "<div style='text-align:center; float:left; width:100%; margin-top:10px;'>";
					 	echo "<b>Post different video:</br><br/>";
						echo "<a href='employee.php?page=video&type=vine'><img src='images/icon-vine.png' height='75px' width='75px'></a> <a href='employee.php?page=video&type=instagram'><img src='images/icon-instagram.png' height='75px' width='75px'></a> <a href='employee.php?page=video&type=youtube'><img src='images/icon-youtube.png' height='75px' width='75px'></a>";
					echo "</div>";
				echo "</div>";
							
				echo " &nbsp; <br />";
								
			echo "</div>";			
	
		} else {
			echo "<div style='float:left; text-align:center;'>";
				echo "Adding a video is simple.  Using Instagram, Vine, or Youtube you can easily embed a short video into your profile in one step! <br/>";				
				echo "<div style='width:100%; text-align:center'>";
				echo "<b>Choose a video type:</br><br/>";				
				echo "<a href='employee.php?page=video&type=vine'><img src='images/icon-vine.png' height='75px' width='75px'></a> <a href='employee.php?page=video&type=instagram'><img src='images/icon-instagram.png' height='75px' width='75px'></a> <a href='employee.php?page=video&type=youtube'><img src='images/icon-youtube.png' height='75px' width='75px'></a>";
				echo "</div>";
			echo "</div>";
		}
		echo "</div>";
		
?>
	<div id='video_holder' class='menu_holder' style=' width:100%; display:none;'>
		<div style='margin-left:5px;'>
			<div id='video-loader' style='width:500px; min-height:300px; padding-top:100px;'>
				Loading....
			</div>
						
			<div id='video-holder'>
				<div class='video-header'>
					<h4></h4>
				</div>
				
				<div class='video-body'>
				
				</div>
			</div>
		</div>	
	</div>
	
<?php
		echo "<table style='width:100%; background-color:#8e080b;'>";
		echo "<tr>";
		echo "<th style='line-height:1px;'> &nbsp; </th>";
		echo "</tr>";
		echo "</table>";
?>	

				<div id="languages form" style='color:#760006; width:100%; margin-bottom:15px;'>
						<table style='margin-top:10px; width:100%;' cellspacing="4">
						<tr>
							<td colspan="2"><b>Multilingual?</b>  &nbsp; Select any or none of the languages below</td>
						</tr>
						<tr class="lang_list" style="margin-left:10px;">	
							<td><span class='language unselected_button' id='Spanish' data-language='unselected'><span class='fui-check-inverted' style='color:white; float:left; cursor:pointer;'></span>Spanish</span></td>					
							<td><span class='language unselected_button' id='French' data-language='unselected'><span class='fui-check-inverted' style='color:white; float:left; cursor:pointer'></span>French</span></td>					
						</tr>
						
						<tr class="lang_list" style="margin-left:10px;">	
							<td><span class='language unselected_button' id='Japanese' data-language='unselected'><span class='fui-check-inverted' style='color:white; float:left; cursor:pointer;'></span>Japanese</span></td>					
							<td><span class='language unselected_button' id='Italian' data-language='unselected'><span class='fui-check-inverted' style='color:white; float:left; cursor:pointer;'></span>Italian</span></td>					
						</tr>
								
						<tr class="lang_list" style="margin-left:10px;">	
							<td><span class='language unselected_button' id='German' data-language='unselected'><span class='fui-check-inverted' style='color:white; float:left; cursor:pointer;'></span>German</span></td>					
							<td><span class='language unselected_button' id='Korean' data-language='unselected'><span class='fui-check-inverted' style='color:white; float:left; cursor:pointer;'></span>Korean</span></td>					
						</tr>	
						
						<tr class="lang_list" style="margin-left:10px;">	
							<td><span class='language unselected_button' id='Russian' data-language='unselected'><span class='fui-check-inverted' style='color:white; float:left; cursor:pointer;'></span>Russian</span></td>					
							<td><span class='language unselected_button' id='Hindi' data-language='unselected'><span class='fui-check-inverted' style='color:white; float:left; cursor:pointer;'></span>Hindi</span></td>					
						</tr>
						<tr class="lang_list" style="margin-left:10px;">	
							<td><span class='language unselected_button' id='Other' data-language='unselected'><span class='fui-check-inverted' style='color:white; float:left; cursor:pointer;'></span>Other</span></td>					
							<td> &nbsp; </td>
						</tr>																			
					</table>
				</div>
<?php	

		echo "<table style='width:100%; background-color:#8e080b'>";
		echo "<tr>";
		echo "<th style='line-height:1px;'>&nbsp; </th>";
		echo "</tr>";
		echo "</table>";

		echo "<div id='button_holder' style='float:left; width:100%; text-align:center;'>";	
			echo "<div style='width:100%; float:left; background-color:#b76e1f; min-height:30px;'><a href='#' class='save_continue' style='color:white'><h4 style='margin-bottom:10px; margin-top:10px;'>COMPLETE YOUR PROFILE</h4></a></div>";
		echo "</div>";					

		echo "<table style='width:100%; background-color:#8e080b'>";
		echo "<tr>";
		echo "<th style='line-height:1px;'>&nbsp; </th>";
		echo "</tr>";
		echo "</table>";
		
		echo "<div style='width:100%; float:left; margin-left:3px; margin-right:3px; margin-bottom:5px; text-align:center; color:#760006'>";
			echo "<h4 style='margin-bottom:5px'>IMPORTANT</h4>";
			echo "After clicking 'Complete Your Profile' you will be matched to jobs as they are entered on the site.<br/>";					
			echo "<b>You will receive an email notification when a new job that matches your profile is entered on the site.</b><br/>";					
			echo "<i>After clicking 'Complete Your Profile', you can change your email settings at any time on the Profile page</i><br/>";			
		echo "</div>";
		
		
		echo "<div id='loader_holder' style='display:none'>";
			echo "<b>LOADING...</b>";
		echo "</div>";								
					
		echo "</div>";	
}

function profile_complete_splash_mobile() {

	echo "<div style='width:99%; float:left; margin-left:3px; margin-right:7px; margin-top:55px; text-align:center;'>";
	
		echo "<h2>Profile Complete</h2>";
		
		echo "<h4>Your profile is complete, BUT you still need to verify your email address in order to view job details or apply for jobs.</h4><br />";
		echo "&nbsp; <br />";
		echo "<a href='main.php?page=verify_email' class='btn btn-large btn-warning signup'>Verify Email Address</a><br />";
		echo "&nbsp; <br />";		
		echo "&nbsp; <br />";		
		echo "<a href='opportunity_list.php' class='btn btn-large btn-warning signup'>View Job List</a><br />";
		echo "&nbsp; <br />";	
		echo "&nbsp; <br />";		
		echo "<a href='employee.php' class='btn btn-large btn-warning signup'>View Profile</a><br />";
		echo "&nbsp; <br />";	
		echo "&nbsp; <br />";		
	echo "</div>";
}

function profile_html_employee_video_mobile($member_data, $employee_data) {	
	$video_array = $employee_data['video'];
	if (count($video_array) > 0) {
		foreach($video_array as $row) {
			$video_url = $row['url'];
			$videoID = $row['videoID'];			
		}
	} else {
		$video_url = "";
	}
	
		echo "<div class='main_box' style='float:left; width:100%;'>";				

		echo "<h3 style='text-align:center;'>Personal Video</h3>";

	switch($_GET['type']) {
		default:
			if ($video_url == "") {
				echo "<div style='margin-left:5px; margin-top:10px; margin-left:3px; margin-right:3px;'>";
						echo "Adding a video is simple.  Using Instagram, Vine, or Youtube you can easily embed a short video into your profile in one step! <br/>";				
						echo "<div style='width:100%; margin-top:15px; text-align:center'>";
						echo "<b>Choose a video type:</br><br/>";				
						echo "<a href='employee.php?page=video&type=vine'><img src='images/icon-vine.png' height='75px' width='75px'></a> <a href='employee.php?page=video&type=instagram'><img src='images/icon-instagram.png' height='75px' width='75px'></a> <a href='employee.php?page=video&type=youtube'><img src='images/icon-youtube.png' height='75px' width='75px'></a>";				
				echo "</div>";
			} else {
				echo "<div style='margin-left:5px; margin-top:15px;'>";
					echo "<div style='float:left; width:100%'>";	
						echo "<div style='float:left; width:100%; text-align:center; margin-bottom:20px;'>";		
							echo "<a href='#' class='btn btn-primary remove_video' id='".$videoID."'>	Remove Video</a><br />";
							echo "&nbsp; <br />";
							echo "&nbsp; <br />";
							echo "<a href='#' class='btn btn-primary' id='watch_video'>	Play Video</a><br />";
						echo "</div>";
						echo "&nbsp; <br />";
						echo "<div style='text-align:center; float:left; width:100%; margin-top:-20px;'>";
						 	echo "<b>Post different video:</br><br/>";
							echo "<a href='employee.php?page=video&type=vine'><img src='images/icon-vine.png' height='75px' width='75px'></a> <a href='employee.php?page=video&type=instagram'><img src='images/icon-instagram.png' height='75px' width='75px'></a> <a href='employee.php?page=video&type=youtube'><img src='images/icon-youtube.png' height='75px' width='75px'></a>";
						echo "</div>";
					echo "</div>";						
					echo " &nbsp; <br />";
					
						echo "<div id='video_holder' class='menu_holder' style=' width:100%; float:left; display:none;'>";
							echo "<table class='dark'>";
							echo "<tr valign='middle'>";
								echo "<th valign='middle'>Personal Video</th>";
							echo "</tr>";
							echo "</table>";
							echo "<div style='margin-left:5px;'>";
								echo "<div id='video-loader' style='width:500px; min-height:300px; float:left; padding-top:100px;'>";
									echo "Loading....";
								echo "</div>";
											
								echo "<div id='video-holder'>";
									echo "<div class='video-header'>";
										echo "<h4></h4>";
									echo "</div>";
									
									echo "<div class='video-body'>";
									
									echo "</div>";
								echo "</div>";
							echo "</div>";	
						echo "</div>";
											
				echo "</div>";
			}			
		break;
		
		case "vine":
			echo "<div style='float:left;'>";
				echo "<div style='float:left; margin-left:3px; margin-right:3px; margin-bottom:5px;'>";				
					echo "To embed a video from Vine, simple paste the URL below and click 'Save'<br />";
					echo "&nbsp; <br />";
					echo "<b>URL</b> <input type='text' id='video_url' style='width:98%;'><br />";
					echo "<div id='host_warning' class='warning' style='display:none'><font color='red'><b>This does not appear to be a valid Youtube, Instagram or Vine URL. Be sure to include the 'http://' or 'https://' as shown below.</b></font></div>";
					echo "<div id='type_warning' class='warning' style='display:none'><font color='red'><b>This does not appear to be a link to a video.  You may only link videos here.</b></font></div>";
					echo "<div id='private_warning' class='warning' style='display:none'><font color='red'><b>We are unable to read the data for this video, please make sure that your Instagram account, or Youtube video is set to 'Public'.</b></font></div>";
					echo "&nbsp; <br />";
					echo "<a href='#' class='btn btn-primary' id='save_video' style='margin-left:30px;'>Save Video</a><br />";	
					echo "&nbsp; <br />";
					echo "<div style='font-size:11px; margin-bottom:3px;'>Video content must be owned by you.  Any inappropriate content will immediately removed and your account may be subject temporary or permanent deactivation.</div>";
				echo "</div>";
				
				echo "<table style='width:100%; background-color:#8e080b'>";
				echo "<tr>";
				echo "<th style='line-height:1px;'> &nbsp; </th>";
				echo "</tr>";
				echo "</table>";

				echo "<h4 style='text-align:center; margin-top:0px; margin-bottom:0px;'>How to find your Vine video URL</h4>";

				echo "<table style='width:100%; background-color:#8e080b'>";
				echo "<tr>";
				echo "<th style='line-height:1px;'> &nbsp; </th>";
				echo "</tr>";
				echo "</table>";

				echo " &nbsp; <br />";
				echo "<a href='images/3-circles-vine.png'><img src='images/3-circles-vine.png' height='200px'></a>";
				echo "&nbsp; <a href='images/share-post-vine.png'><img src='images/share-post-vine.png' height='200px'></a>";						
				echo "&nbsp; <a href='images/copy-link-vine.png'><img src='images/copy-link-vine.png' height='200px'></a>";			
			echo "</div>";			
		break;
		
		case "instagram":
			echo "<div style='float:left;'>";
				echo "<div style='float:left; margin-left:3px; margin-right:3px; margin-bottom:5px;'>";				
					echo "To embed a video from Instagram, simple paste the URL below and click 'Save'<br />";
					echo "&nbsp; <br />";
					echo "<b>URL</b> <input type='text' id='video_url' style='width:98%;'><br />";
					echo "<div id='host_warning' class='warning' style='display:none'><font color='red'><b>This does not appear to be a valid Youtube, Instagram or Vine URL. Be sure to include the 'http://' or 'https://' as shown below.</b></font></div>";
					echo "<div id='type_warning' class='warning' style='display:none'><font color='red'><b>This does not appear to be a link to a video.  You may only link videos here.</b></font></div>";
					echo "<div id='private_warning' class='warning' style='display:none'><font color='red'><b>We are unable to read the data for this video, please make sure that your Instagram account, or Youtube video is set to 'Public'.</b></font></div>";
					echo "&nbsp; <br />";
					echo "<a href='#' class='btn btn-primary' id='save_video' style='margin-left:30px;'>Save Video</a><br />";	
					echo "&nbsp; <br />";
					echo "<b>Note: </b> Instagram videos must be set to 'Public' to be attached to your profile.<br />";
					echo "<div style='font-size:11px'>Video content must be owned by you.  Any inappropriate content will immediately removed and your account may be subject temporary or permanent deactivation.</div>";
				echo "</div>";
				
				echo "<table style='width:100%; background-color:#8e080b'>";
				echo "<tr>";
				echo "<th style='line-height:1px;'> &nbsp; </th>";
				echo "</tr>";
				echo "</table>";
				
				echo "<h4 style='text-align:center; margin-top:0px; margin-bottom:0px;'>How to find your Instagram video URL</h4>";
				
				echo "<table style='width:100%; background-color:#8e080b'>";
				echo "<tr>";
				echo "<th style='line-height:1px;'> &nbsp; </th>";
				echo "</tr>";
				echo "</table>";
				
				echo " &nbsp; <br />";
				echo "<a href='images/instrgram-3-circles.png'><img src='images/instrgram-3-circles.png' height='200px'></a>";
				echo "&nbsp; <a href='images/instagram-url-link.png' height='100px'><img src='images/instagram-url-link.png' height='200px''></a><br />";			
			echo "</div>";			
		break;
		
		case "youtube":
			echo "<div style='float:left;'>";
				echo "<div style='float:left; margin-left:3px; margin-right:3px; margin-bottom:5px;'>";				
					echo "To embed a video from YouTube, simple paste the URL below and click 'Save'<br />";
					echo "&nbsp; <br />";
					echo "<b>URL</b> <input type='text' id='video_url' style='width:98%;'><br />";
					echo "<div id='host_warning' class='warning' style='display:none'><font color='red'><b>This does not appear to be a valid Youtube, Instagram or Vine URL. Be sure to include the 'http://' or 'https://' as shown below.</b></font></div>";
					echo "<div id='type_warning' class='warning' style='display:none'><font color='red'><b>This does not appear to be a link to a video.  You may only link videos here.</b></font></div>";
					echo "<div id='private_warning' class='warning' style='display:none'><font color='red'><b>We are unable to read the data for this video, please make sure that your Instagram account, or Youtube video is set to 'Public'.</b></font></div>";
					echo "&nbsp; <br />";
					echo "<a href='#' class='btn btn-primary' id='save_video' style='margin-left:30px;'>Save Video</a><br />";	
					echo "&nbsp; <br />";
					echo "<b>Note: </b>YouTube videos must be set to 'Public' to be attached to your profile.<br />";
					echo "<div style='font-size:11px'>Video content must be owned by you.  Any inappropriate content will immediately removed and your account may be subject temporary or permanent deactivation.</div>";									
				echo "</div>";
				
				echo "<table style='width:100%; background-color:#8e080b'>";
				echo "<tr>";
				echo "<th style='line-height:1px;'> &nbsp; </th>";
				echo "</tr>";
				echo "</table>";

				echo "<h4 style='text-align:center; margin-top:0px; margin-bottom:0px;'>How to find your YouTube video URL</h4>";
				
				echo "<table style='width:100%; background-color:#8e080b'>";
				echo "<tr>";
				echo "<th style='line-height:1px;'> &nbsp; </th>";
				echo "</tr>";
				echo "</table>";
				
				echo " &nbsp; <br />";
				echo "<b>iPhone Browser:</b>  In the browser, simply copy the link from the browser bar. <br />";
				echo "&nbsp; <br />";
				echo "<b>iPhone YouTube App:</b>  Click the share icon (prong-shaped icon) and then click 'Copy Link', from the pop-up box.<br />";
				echo "&nbsp; <br />";
				echo "<b>Android Browser:</b>  Click the share icon (prong-shaped icon) and the URL will appear in a pop-up box, simply copy that URL.<br />";
			echo "</div>";			
		break;				
	}
		echo "</div>";			
}

function profile_html_employee_edit_options($member_data, $employee_data) {
	$skill_array = $employee_data['skills']['skills'];
?>
	<div class='main_box' style='margin-top:110px; width:100%; text-align:center;'>
		<h2>Profile Edit Options</h1>

			<a href='employee.php?page=edit_photo&type=profile'>
				<div style='float:left; width:85%; margin-bottom:-5px;' class='bubble_inside'>
					<h2 style='display:inline'>Profile Photo</h2>
				</div>
			</a>			

			<a href='employee.php?page=video'>
				<div style='float:left; width:85%; margin-bottom:-5px;' class='bubble_inside'>
					<h2 style='display:inline'>Video Resume</h2>
				</div>
			</a>			

			<a href='employee.php?page=edit_details'>
				<div style='float:left; width:85%; margin-bottom:-5px;' class='bubble_inside'>
					<h2 style='display:inline'>General Details</h2>
				</div>	
			</a>

			<a href='employee.php?page=edit_skills'>
				<div style='float:left; width:85%; margin-bottom:-5px;' class='bubble_inside'>
					<h2 style='display:inline'>Skills & Experience</h2>
				</div>
			</a>
			
			<a href='employee.php?page=edit_employment'>
				<div style='float:left; width:85%; margin-bottom:-5px;' class='bubble_inside'>
					<h2 style='display:inline'>Past Employment</h2>
				</div>
			</a>
			
			<a href='employee.php?page=edit_education'>
				<div style='float:left; width:85%; margin-bottom:-5px;' class='bubble_inside'>
					<h2 style='display:inline'>Education</h2>
				</div>
			</a>
			
			<a href='employee.php?page=advanced'>
				<div style='float:left; width:85%; margin-bottom:-5px;' class='bubble_inside'>
					<h2 style='display:inline'>Email Settings</h2>
				</div>
			</a>									
<?php
		foreach ($skill_array as $row) {
			if ($row['skill'] == "Bartender") {
?>
			<a href='employee.php?page=edit_photo&type=bar'>
				<div style='float:left; width:85%; margin-bottom:-5px;' class='bubble_inside'>
					<h2 style='display:inline'>Cocktail Photos</h2>
				</div>
			</a>			
<?php				
			}
			
			if ($row['skill'] == "Kitchen") {
?>
			<a href='employee.php?page=edit_photo&type=kitchen'>
				<div style='float:left; width:85%; margin-bottom:-5px;' class='bubble_inside'>
					<h2 style='display:inline;'>Culinary Photo</h2>
				</div>
			</a>			
<?php								
			}
		}
?>
	</div>
<?php
}

function profile_html_employee_edit_details_mobile($member_data, $employee_data, $option) {
		$language_array = $employee_data['languages'];
		$email_setting = $employee_data['general']['email_setting'];

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
		
		$Spanish = "unselected";
		$French = "unselected";
		$Italian = "unselected";
		$German = "unselected";
		$Japanese = "unselected";
		$Chinese  = "unselected";
		$Portuguese  = "unselected";
		$Korean = "unselected";
		$Russian = "unselected";
		$Greek = "unselected";
		$Hindi  = "unselected";
		$Other = "unselected";
		if (count($language_array) > 0) {
			foreach($language_array as $row) {
				$$row['lang'] = "selected";			
			}
		}
?>

			<div class='main_box' id="details_edit_employee" style='color:#760006; margin-top:110px; width:98%; margin-left:3px; margin-right:3px; text-align:center;'>
			<h2>General Details</h2>
			Please review and make any necessary changes below:
				&nbsp; <br />				
				</br>
				  <div id="employee_empty_warning" class='warning' style="display:none; margin-left:10px;"><font color="red"><b>PLEASE COMPLETE ALL FIELDS</b></font></div>
				  <div id="employee_zip_warning" class='warning' style="display:none; margin-left:10px;"><font color="red"><b>PLEASE USE A VALID ZIP CODE</b></font></div>
				  <div id="employee_invalid_zip_warning" class='warning' style="display:none; margin-left:10px;"><font color="red"><b>THE ZIP CODE ENTERED IS EITHER INVALID OR A MILITARY ZIP CODE</b></font></div>
				<table width='95%'>
				<tr>
					<td><b>First Name: &nbsp; </b></td>
					<td><input type="text" name="new_first" id="first_employee" value="<? echo $member_data['firstname'] ?>"></input></td>
				</tr>
				<tr>
					<td><b>Last Name: &nbsp; </b></td>
					<td><input type="text" name="new_last" id="last_employee" value="<? echo $member_data['lastname'] ?>"></input><div id="name_warning" style="display:none"></div></td>
				</tr>
				<tr>
					<td><b>Zip Code: &nbsp; </b></td>
					<td><input type="text" name="new_zip" id="zip_employee" value="<? echo $member_data['zip']  ?>"></input></td>
				</tr>
				<tr>
					<td><b>Contact Phone: &nbsp; </b></td>
					<td><input type="text" name="contact_phone" id="contact_phone" value="<? echo $employee_data['general']['contact_phone']  ?>"></input></td>
				</tr>		
				<tr>
					<td ><b>Email Setting: </b></td>
					<td><select style='background-color:#b76163' id='email_setting'>
						<option value='Y' <? echo $standard ?> >Standard</option>
						<option value='1' <? echo $one ?>>Notices Off & Reminder 1 month</option>";
						<option value='3' <? echo $three ?> >Notices Off & Reminder 3 months</option>";						
						<option value='N' <? echo $off ?> >All Off</option>
						</select> 
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center"><a href='#' id='more_info'>Learn More</a></td>
				</tr>
			</table>
			</div>
				
			<div id='description_box' style='display:none; background-color:#DBDCCE; width:98%; margin-left:3px; margin-right:3px;'>
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

				<div id="languages form" class='main_box' style='color:#760006; width:98%; margin-bottom:15px;'>
						<table style='margin-top:0px' cellspacing="4">
						<tr>
							<td colspan="2"><b>Multilingual?</b> &nbsp; Select any or none of the languages below</td>
						</tr>
						<tr class="lang_list" style="margin-left:10px;">	
							<td><span class='language <? echo $Spanish ?>_button' id='Spanish' data-language='<? echo $Spanish ?>'><span class='fui-check-inverted' style='color:white; float:left; cursor:pointer;'></span>Spanish</span></td>					
							<td><span class='language <? echo $French ?>_button' id='French' data-language='<? echo $French ?>'><span class='fui-check-inverted' style='color:white; float:left; cursor:pointer;'></span>French</span></td>					
						</tr>
						
						<tr class="lang_list" style="margin-left:10px;">	
							<td><span class='language <? echo $Japanese ?>_button' id='Japanese' data-language='<? echo $Japanese ?>'><span class='fui-check-inverted' style='color:white; float:left; cursor:pointer;'></span>Japanese</span></td>					
							<td><span class='language <? echo $Italian ?>_button' id='Italian' data-language='<? echo $Italian ?>'><span class='fui-check-inverted' style='color:white; float:left; cursor:pointer;'></span>Italian</span></td>					
						</tr>
								
						<tr class="lang_list" style="margin-left:10px;">	
							<td><span class='language <? echo $German ?>_button' id='German' data-language='<? echo $German ?>'><span class='fui-check-inverted' style='color:white; float:left; cursor:pointer;'></span>German</span></td>					
							<td><span class='language <? echo $Korean ?>_button' id='Korean' data-language='<? echo $Korean ?>'><span class='fui-check-inverted' style='color:white; float:left; cursor:pointer;'></span>Korean</span></td>					
						</tr>	
						
						<tr class="lang_list" style="margin-left:10px;">	
							<td><span class='language <? echo $Russian ?>_button' id='Russian' data-language='<? echo $Russian ?>'><span class='fui-check-inverted' style='color:white; float:left; cursor:pointer;'></span>Russian</span></td>					
							<td><span class='language <? echo $Hindi ?>_button' id='Hindi' data-language='<? echo $Hindi ?>'><span class='fui-check-inverted' style='color:white; float:left; cursor:pointer;'></span>Hindi</span></td>					
						</tr>
						<tr class="lang_list" style="margin-left:10px;">	
							<td><span class='language <? echo $Other ?>_button' id='Other' data-language='<? echo $Other ?>'><span class='fui-check-inverted' style='color:white; float:left; cursor:pointer;'></span>Other</span></td>					
							<td> &nbsp; </td>
						</tr>																			
					</table>
				</div>	
				
<?php	
				echo "<table style='width:100%; background-color:#8e080b'>";
				echo "<tr>";
				echo "<th style='line-height:1px;'>&nbsp; </th>";
				echo "</tr>";
				echo "</table>";
				
			echo "<div id='button_holder' style='float:left; width:100%; text-align:center;'>";	
				echo "<div style='width:100%; float:left; background-color:#b76e1f; min-height:30px;'><a href='#' class='save_continue' style='color:white'><h4 style='margin-bottom:10px; margin-top:10px;'>Save All Changes</h4></a></div>";
			echo "</div>";		

				echo "<table style='width:100%; background-color:#8e080b'>";
				echo "<tr>";
				echo "<th style='line-height:1px;'>&nbsp; </th>";
				echo "</tr>";
				echo "</table>";
						
				
			echo "</div>";
}



function profile_html_employee_find_video_link_mobile($type) {
?>
	<div class='main_box' style='margin-top:70px; width:100%;'>

		<div style='float:left; width:100%; text-align:center;'>
			<h2>Find Video Link</h2>
<?php

	switch($type) {
		case "vine":
			echo "<b>How to find the URL to your Vine video: <br />";
			echo "&nbsp; <br />";
			echo "<a href='images/3-circles-vine.png'><img src='images/3-circles-vine.png' height='100px'></a><br />"	;
			echo "<a href='images/share-post-vine.png'><img src='images/share-post-vine.png' height='100px'></a><br />"	;						
			echo "<a href='images/copy-link-vine.png'><img src='images/copy-link-vine.png' height='100px'></a><br />"	;			
		break;
		
		case "instagram":
			echo "<b>How to find the URL to your Instagram video: <br />";	
			echo "&nbsp; <br />";
			echo "<a href='images/instrgram-3-circles.png'><img src='images/instrgram-3-circles.png' height='100px'></a><br />";
			echo "<a href='images/instagram-url-link.png' height='100px'><img src='images/instagram-url-link.png' height='100px''></a><br />";			
		break;
	}
echo "</div>";
echo "</div>";
}

function profile_html_type_switch_mobile() {	
	
	echo "<div class='main_box' style='margin-top:70px; '>";				
	
		echo "<div style='width:100%; margin-left:2px; margin-right:2px;'>";

			echo "&nbsp; <br />";		
			echo "You have signed up for a Job-Seeker/Employee account.  This account type is for members looking for open jobs.<br />";
			echo "&nbsp; <br />";
			echo "If you are an Employer (Manager, HR Respresentative, etc.) and wish to post jobs on the site, you can switch your account type by filling out the info below.";	
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