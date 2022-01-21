<?php

function profile_html_employee_splash($member_data, $email_verification, $opportunity_data) {

		if ($email_verification == "N") {
			$verification_note = "<h5 style='margin-bottom:3px;'><font color='red'>NOTICE:</font>  <a href='main.php?page=verify_email'>You need to verify your email address before responding to jobs.</a></h4>";
		} else {
			$verification_note = "";
		}	
?>
		<div class="container" id="splash_box" style="min-height: 70%">		
			<div class="row">
				<div class="col-md-offset-3 col-md-9 col-xs-offset-1 col-md-10">
					<h2 style='color:black'>WELCOME <? echo $member_data['firstname'] ?>!</h2>
				</div>
<?php
				if ($opportunity_data == "NA") {
?>
					<div class="col-md-offset-3 col-md-9 col-xs-offset-1 col-md-10">
						<h4 style="margin-bottom:0px; margin-top:10px; color:black;">Are you ready to find a new job?</h4>
					</div>
<?php	
				} else {
					//this person has come from a public job post, acknowledge this
					$job_title = $opportunity_data['job_data']['general']['title'];
					$store = $opportunity_data['job_data']['store']['name'];
?>
					<div class="col-md-offset-3 col-md-9 col-xs-offset-1 col-md-10">
						<h4 style="margin-bottom:10px; margin-top:10px;">Start Application</h4>
					</div>
				
					<div class="col-md-offset-3 col-md-9 col-xs-offset-1 col-md-10">
						You will need to create a quick profile to apply to the job: <br /><b><? echo $job_title. " @ ".$store ?></b><br />
					</div>
<?php
				}
?>
			</div>
			
			<div class="row start_profile" id='start_profile' style="margin-top: 25px">
				<div class="col-md-3 text-right col-xs-3">
					<img src='images/redarrow.png' class="pull-right img-responsive" alt='lets_get_started' height='94px' width='94px' style="z-index:100; margin-top: 10px;">
				</div>
				<div class="col-md-9 col-xs-9">
<?php
		if ($opportunity_data == "NA") {
?>
					<h3 class="start_profile" style="cursor: pointer">Create My Profile!</h3>
					Begin making your profile now and start applying to jobs!
<?php
		} else {
?>
					<h3 class="start_profile" style="cursor: pointer">Start profile/application</h3>
					Begin making your profile and apply!
<?php
		}
?>
				</div>
			</div>

<?php
		if ($opportunity_data == "NA") {
?>
			<div class="row skip_profile" id='skip_profile'>
				<div class="col-md-3 text-right col-xs-3">
					<img src='images/redarrow.png'  class="pull-right img-responsive"alt='lets_get_started' height='94px' width='94px' style="z-index:100">
				</div>
				<div class="col-md-9 col-xs-9">
					<h3 class="skip_profile" style="cursor: pointer">Create my profile later</h3>
					Just show me some jobs
				</div>
			</div>
			
			<div class="row" style="margin-top: 25px;">			
				<div class="col-md-9 col-md-offset-3 col-xs-9">
					<h5>Are you an Employer here to post jobs? - <a href='employee.php?page=settings'>SWITCH ACCOUNT TYPE</a></h5>
				</div>
			</div>
			
<?php
		}
?>

			<div class="row" style="margin-top: 15px; margin-bottom: 50px">			
				<div class="col-md-9 col-md-offset-3">
					<? echo $verification_note; ?>	
				</div>
			</div>
		</div>
<?php
}


function profile_html_work_skills_menu($past_employment_array, $FOH, $BOH, $management, $employment_skills, $template_skills, $total_experience, $experience_overwrite, $profile_status) {
	$utilities = new Utilities;
?>	

	<div class='container' style="min-height: 70%">
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-9 col-md-offset-3 col-xs-12">
				<h2 style="color:black"><i class="fa fa-cutlery" aria-hidden="true"></i> ADD/EDIT EXPERIENCE & SKILLS</h2>
			</div>	
		</div>

		
<?php
			foreach($past_employment_array as $row) {
				$start_date = $utilities->convert_month($row['start_month'])." ".$row['start_year'];
				if ($row['current'] == "Y") {
					$end_date = "Current";
				} else {
					$end_date = $utilities->convert_month($row['end_month'])." ".$row['end_year'];
				}
				
				$start_month_selection = $utilities->month_selections($row['start_month']);
				$end_month_selection = $utilities->month_selections($row['end_month']);
	
			//preselect category
				$casual_select = $upscale_casual_select = $upscale = $catering = "";
				
				switch($row['business_type']) {
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
					
					case "Other":
						$other_select = "selected";
					break;	
				}
				
				$FOH_display = $BOH_display = $management_display = $other_display = "display:none";
				
				if ($row['category'] == "Server" || $row['category'] == "Host" || $row['category'] == "Bus" || $row['category'] == "Management" || $row['category'] == "Bartender" || $row['category'] == "Hospitality") {
					$FOH_display = "";
				}

				if ($row['category'] == "Kitchen" || $row['category'] == "Bus" || $row['category'] == "Management" || $row['category'] == "Hospitality") {
					$BOH_display = "";
				}
				
				if ($row['category'] == "Management" || $row['category'] == "Hospitality") {
					$management_display = "";
				}				

				if ($row['category'] == "Other") {
					$other_display = "";
				}				
				
				if ($row['current'] == "Y") {
					$checked = "checked";
				} else {
					$checked = "";
				}
	
							
?>	
			<div class="row work_row" style='font-size:16px;'>		
				<div class="col-md-3 col-xs-4 col-md-offset-3">
					<a href='#' class='edit_work' id='<? echo $row['ID'] ?>'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> <? echo $row['company'] ?><br />
				</div>
				<div class="col-md-3 col-xs-4">
					<? echo $row['position'] ?>
				</div>
				<div class="col-md-3 col-xs-4">
					<? echo $start_date." - ".$end_date ?>
				</div>
			</div>
			<div class="row work_row" style='font-size:14px; margin-bottom:25px'>
				<div class="col-md-9 col-md-offset-3 col-xs-9 col-xs-offset-0">
					&nbsp; &nbsp; &nbsp; Skills: &nbsp;
<?php
					if (count($employment_skills) > 0) {
						$count = 0;
						foreach($employment_skills as $skill) {
							if ($skill['employmentID'] == $row['ID']) {
/*
								echo $skill['sub_skill'];
								if ($count != count($employment_skills)) {
									echo ", ";
								}
*/
								$count++;

							}
						}
							
						
						if($count == 0) {
							echo "<i>None Entered</i>";
						} else {
						echo "<i>".$count." Skills</i>";
						}
					} else {
						echo "<i>None Entered</i>";
					}
?>
				</div>
				<div class="col-xs-12">
					<hr>
				</div>
			</div>
			
			<div class=' work_input' data-work_id='<? echo $row['ID'] ?>' style="display: none">
				<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1' id='empty_company_<? echo $row['ID'] ?>' style='float:left; width:100%; color:red; display:none'><b>Company cannot be blank.</b></div>
				<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1' id='empty_position_<? echo $row['ID'] ?>' style='float:left; width:100%; color:red; display:none'><b>Position cannot be blank.</b></div>
				<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1' id='empty_title_<? echo $row['ID'] ?>' style='float:left; width:100%; color:red; display:none'><b>Title cannot be blank.</b></div>	
				<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1' id='empty_type_<? echo $row['ID'] ?>' style='float:left; width:100%; color:red; display:none'><b>Please select a location type.</b></div>
				<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1' id='empty_year_<? echo $row['ID'] ?>' style='float:left; width:100%; color:red; display:none'><b>Enter a valid employment year</b></div>
				<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1' id='bad_dates_year_<? echo $row['ID'] ?>' style='float:left; width:100%; color:red; display:none'><b>Employment end date cannot be earlier than start date.</b></div>


				<div class="form-horizontal">
					<div class="form-group company_form_<? echo $row['ID'] ?>">
					   		<label for="edit_company" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Company</label>
					   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
								<input type='text' class='edit_company form-control' id="past_company_<? echo $row['ID'] ?>" data-work_id='<? echo $row['ID'] ?>' value='<? echo $row['company'] ?>' placeholder='Company Name'>
							</div>
					</div>
					
					<div class="form-group business_form_<? echo $row['ID'] ?>">
					   		<label for="edit_business_type" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Business Type</label>
					   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
								<select class='edit_business_type form-control' id="business_type_<? echo $row['ID'] ?>" data-work_id='<? echo $row['ID'] ?>'>
								<option value='0' >--Location Type--</option>
								<option value='Casual' <? echo $casual_select ?>>Casual</option>
								<option value='Upscale Casual' <? echo $upscale_casual_select ?>>Upscale Casual</option>
								<option value='Upscale' <? echo $upscale_select ?>>Upscale</option>
								<option value='Catering' <? echo $catering_select ?>>Catering</option>
								<option value='Other' <? echo $other_select ?>>Other</option>
								</select>
							</div>
					</div>

					<div class="form-group position_form_<? echo $row['ID'] ?>">						
							<label for="edit_position" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Position Type</label>
							<div class="ccol-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
								<select class='edit_position form-control' id="job_category_<? echo $row['ID'] ?>" data-work_id='<? echo $row['ID'] ?>'>
									<option value="NA">-- Select a Position --</option>		
									<option disabled="disabled">-- Front of House Positions --</option>		
<?php
									foreach($FOH as $position) {
										$selected = "";
										if ($row['titleID'] == $position['titleID']) {
											$selected = "selected";
										}
										echo "<option class='FOH' value='".$position['titleID']."' ".$selected." >".$position['title']."</option>";
									}
?>	
									<option disabled="disabled">-- Back of House Positions --</option>		
<?php
									foreach($BOH as $position) {
										$selected = "";
										if ($row['titleID'] == $position['titleID']) {
											$selected = "selected";
										}
										echo "<option class='BOH' value='".$position['titleID']."' ".$selected." >".$position['title']."</option>";
									}
?>	
									<option disabled="disabled">-- Management Positions --</option>		
<?php
									foreach($management as $position) {
										$selected = "";
										if ($row['titleID'] == $position['titleID']) {
											$selected = "selected";
										}
										echo "<option class='management' value='".$position['titleID']."' ".$selected." >".$position['title']."</option>";
									}
?>								
									<option disabled="disabled">-- Other Positions --</option>		
<?php
									$selected = "";
									if ($row['titleID'] == 1) {
										$selected = "selected";
									}
										
									echo "<option class='other' value='1' $selected >Other Hospitality</option>";
	
									$selected = "";
									if ($row['titleID'] == 1) {
										$selected = "selected";
									}
	
									echo "<option class='non' value='0' $selected >Non-Hospitality</option>";			
?>
								</select>
							</div>
					</div>
					
					<div class="form-group title_form_<? echo $row['ID'] ?>">						
							<label for="edit_title" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Title</label>
							<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
								<input type='text' class='edit_title form-control' id="past_position_<? echo $row['ID'] ?>" data-work_id='<? echo $row['ID'] ?>' id='positionID_<? echo $row['ID'] ?>' value='<? echo $row['position'] ?>' placeholder='Position Title'><br />
							</div>
					</div>
										
					<div class="form-group start_date_form_<? echo $row['ID'] ?>">	
							<label for="edit_start_date" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Start Date</label>
							<div class="col-md-4 col-md-offset-0 col-xs-4 col-xs-offset-1 col-sm-4  col-sm-offset-0">
								<select class='edit_start_date form-control' id="start_month_<? echo $row['ID'] ?>" data-work_id='<? echo $row['ID'] ?>'  >
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
							</div>
							<div class="col-md-4 col-xs-4 col-sm-4">
								<input type="number" class='edit_start_date form-control' id="start_year_<? echo $row['ID'] ?>" data-work_id='<? echo $row['ID'] ?>' maxlength="4"  placeholder="Year" value="<? echo $row['start_year'] ?>">
							</div>
					</div>

					<div class="form-group end_date_form_<? echo $row['ID'] ?>">							
							<label for="edit_end_date" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">End Date</label>
							<div class="col-md-4 col-md-offset-0 col-xs-4 col-xs-offset-1 col-sm-4  col-sm-offset-0">
								<select class='edit_end_date form-control' id="end_month_<? echo $row['ID'] ?>" data-work_id='<? echo $row['ID'] ?>'  >
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
							</div>
							<div class="col-md-4 col-xs-4 col-sm-4">						
								<input type="number" class='edit_end_date form-control' id="end_year_<? echo $row['ID'] ?>" data-work_id='<? echo $row['ID'] ?>' maxlength="4"  placeholder="Year" value="<? echo $row['end_year'] ?>">
							</div>
					</div>
					
						<div class="checkbox col-md-offset-2 col-md-10 col-xs-offset-1 col-xs-10">
						 	<label>
							    &nbsp; &nbsp; <input type="checkbox" class="current" id="current_employment_<? echo $row['ID'] ?>" data-work_id='<? echo $row['ID'] ?>' value="current" <? echo $checked ?> >
							    Currently Employed Here
							</label>
						</div><br />

				<div class="row text-center" style="margin-bottom: 5px; margin-top:20px">
					<h4>Skills Used/Learned at this Job</h4>
				</div>
									
				<div class="row" style="margin-bottom: 5px;">
					<div class="col-md-8 col-md-offset-2 col-xs-12 col-xs-offset-0 text-center no-line">
						<a href="#" class="toggle_FOH" id="<? echo $row['ID'] ?>"><h5 class="no-line text-center" style="color: black">FRONT OF HOUSE SKILLS &nbsp;  <i class="fa fa-caret-down" id="caret_down_FOH_<? echo $row['ID'] ?>" aria-hidden="true"></i><i class="fa fa-caret-up" id="caret_up_FOH_<? echo $row['ID'] ?>" aria-hidden="true" style="display: none"></i></h5></a>
						<div class="row work_skills FOH_skills" id='FOH_<? echo $row['ID'] ?>' style="display: none">
<?php
							$count = 1;
							foreach($template_skills as $skill) {
								$active = "";
								$check = "display:none";
								$circle = "";

								if ($skill['type'] == "FOH") {
									//loop through previously enetered user skills and mark them as selected
									if (count($employment_skills) > 0 ) {
										foreach ($employment_skills as $sub_skill) {
											if ($sub_skill['employmentID'] == $row['ID'] && html_entity_decode($sub_skill['sub_skill']) == html_entity_decode($skill['skill'])) {
												$active = "active";
												$circle = "display:none";
												$check = "";
											}
										}					
									}	

								echo "<div class='col-md-4 col-xs-8 col-xs-offset-2 col-md-offset-2' style='margin-bottom:10px'>";
									echo "<button type='button' class='skill_button skill_reference_".$row['ID']." btn btn-default FOH ".$active."' data-skill='".$skill['skill']."' style='width:250px'><i class='fa fa-check' aria-hidden='true' style='".$check."'></i><i class='fa fa-circle-thin' aria-hidden='true' style='".$circle."'></i> ".$skill['skill']."</button>";
								echo "</div>";
								
								$count++;
								}
							}
?>
						</div>
					</div>
				</div>
				
				<div class="row" style="margin-bottom: 5px;">
					<div class="col-md-8 col-md-offset-2 col-xs-12 col-xs-offset-0 text-center no-line">
						<a href="#" class="toggle_BOH no-line" id="<? echo $row['ID'] ?>"><h5 class="no-line text-center" style="color: black">BACK OF HOUSE SKILLS &nbsp;  <i class="fa fa-caret-down" id="caret_down_BOH_<? echo $row['ID'] ?>" aria-hidden="true"></i><i class="fa fa-caret-up" id="caret_up_BOH_<? echo $row['ID'] ?>" aria-hidden="true" style="display: none"></i></h5></a>
						<div class="row work_skills BOH_skills" id='BOH_<? echo $row['ID'] ?>' style="display: none">
<?php
								$count = 1;
								foreach($template_skills as $skill) {
									$active = "";
									$check = "display:none";
									$circle = "";

									if ($skill['type'] == "BOH") {
										//loop through previously enetered user skills and mark them as selected
										if (count($employment_skills) > 0 ) {
											foreach ($employment_skills as $sub_skill) {
												if ($sub_skill['employmentID'] == $row['ID'] && html_entity_decode($sub_skill['sub_skill']) == html_entity_decode($skill['skill'])) {
													$active = "active";
													$circle = "display:none";
													$check = "";
												}
											}					
										}	

									echo "<div class='col-md-4 col-xs-8 col-xs-offset-2 col-md-offset-2' style='margin-bottom:10px'>";
										echo "<button type='button' class='skill_button skill_reference_".$row['ID']." btn btn-default BOH ".$active."' data-skill='".$skill['skill']."' style='width:250px'><i class='fa fa-check' aria-hidden='true' style='".$check."'></i><i class='fa fa-circle-thin' aria-hidden='true' style='".$circle."'></i> ".$skill['skill']."</button>";
									echo "</div>";
									
									$count++;
									}
								}
?>
						</div>
					</div>
				</div>

				<div class="row" style="margin-bottom: 5px;">
					<div class="col-md-8 col-md-offset-2 col-xs-12 col-xs-offset-0 text-center no-line" >
						<a href="#" class="toggle_management no-line" id="<? echo $row['ID'] ?>"><h5 class="no-line text-center" style="color: black">MANAGEMENT SKILLS &nbsp;  <i class="fa fa-caret-down" id="caret_down_management_<? echo $row['ID'] ?>" aria-hidden="true"></i><i class="fa fa-caret-up" id="caret_up_management_<? echo $row['ID'] ?>" aria-hidden="true" style="display: none"></i></h5></a>
						<div class="row work_skills management_skills" id='management_<? echo $row['ID'] ?>'style="margin-bottom: 5px; display: none">
<?php
								$count = 1;
								foreach($template_skills as $skill) {
									$active = "";
									$check = "display:none";
									$circle = "";

									if ($skill['type'] == "Management") {
										//loop through previously enetered user skills and mark them as selected
										if (count($employment_skills) > 0 ) {
											foreach ($employment_skills as $sub_skill) {
												if ($sub_skill['employmentID'] == $row['ID'] && html_entity_decode($sub_skill['sub_skill']) == html_entity_decode($skill['skill'])) {
													$active = "active";
													$circle = "display:none";
													$check = "";
												}
											}					
										}	

									echo "<div class='col-md-4 col-xs-8 col-xs-offset-2 col-md-offset-2' style='margin-bottom:10px'>";
										echo "<button type='button' class='skill_button skill_reference_".$row['ID']." btn btn-default ".$active."' data-skill='".$skill['skill']."' style='width:250px'><i class='fa fa-check' aria-hidden='true' style='".$check."'></i><i class='fa fa-circle-thin' aria-hidden='true' style='".$circle."'></i> ".$skill['skill']."</button>";
									echo "</div>";
									
									$count++;
									}
								}
?>
						</div>
					</div>
				</div>
				
			</div><br />
			
			<div class="row" style="margin-bottom:25px">
				<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
					<button type="button" class="btn btn-success save_edit_position" id='<? echo $row['ID'] ?>'>
						<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save
					</button>
					
					<button type="button" class="btn btn-danger remove_work" id='<? echo $row['ID'] ?>'>
						<i class="fa fa-trash-o" aria-hidden="true"></i></i> Delete
					</button>

					<button type="button" class="btn btn-link cancel_edit_work" style="color:#8e080b;">
						Cancel
					</button>
				</div>
			</div>							
		</div>
<?php
		}		
		
		if (count($past_employment_array) > 0) {
?>
		<div class="row totals_holder work_row" style="font-size:16px;  cursor:pointer">
			
			<div class='col-md-3 col-md-offset-6 col-xs-8 col-xs-offset-0 text-right border'>
				<a href='#' class='edit_years'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> <b>HOSPITALITY EXPERIENCE</b>
			</div>
			<div class='col-md-2 col-xs-4 text-center'>
<?php
				if ($experience_overwrite == "NA") {
?>
					<b><? echo $total_experience['hospitality'] ?> yrs</b>
<?php					
				} else {
?>
					<b><? echo $experience_overwrite['hospitality'] ?> yrs</b> <br /><i style='font-size:12px'>Calculated <? echo $total_experience['hospitality'] ?> yrs</i>
<?php					
				}
?>
			</div>
		</div>

		<div class="row totals_holder work_row" style="font-size:16px; cursor:pointer">
			<div class='col-md-3 col-md-offset-6 col-xs-8 col-xs-offset-0 text-right'>
				<a href='#' class='edit_years'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> <b>TOTAL WORK EXPERIENCE</b>
			</div>
			<div class='col-md-2 col-xs-4 text-center' >
<?php
				if ($experience_overwrite == "NA") {
?>
					<b><? echo $total_experience['total'] ?> yrs</b>
<?php
				} else {
?>
					<b><? echo $experience_overwrite['total'] ?> yrs</b> <br /><i style='font-size:12px'>Calculated <? echo $total_experience['total'] ?> yrs</i>
<?php
				}
?>
			</div>
		</div>
		
		<div class="form-group experience_row" style="display:none">	
			<div class="row">					
				<label for="hospitality_experience" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Hospitality Experience</label>
				<div class='error col-md-10 col-md-offset-2' id='non_number' style='float:left; width:100%; color:red; display:none'><b>Experience must be a number.</b></div>
				<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
<?php
					if ($experience_overwrite == "NA") {
?>
						<input type='number' class='experience form-control' id='hospitality_experience' value='<? echo $total_experience['hospitality'] ?>' placeholder='Years'><br />
<?php						
					} else {
?>
						<input type='number' class='experience form-control' id='hospitality_experience' value='<? echo $experience_overwrite['hospitality'] ?>' placeholder='Years'><br />
<?php
					}
?>
				</div>
			</div>	
			<div class="row">					
				<label for="total_experience" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Total Experience</label>
				<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
<?php
					if ($experience_overwrite == "NA") {
?>
						<input type='number' class='experience form-control' id='total_experience' value='<? echo $total_experience['total'] ?>' placeholder='Years'><br />
<?php						
					} else {
?>
						<input type='number' class='experience form-control' id='total_experience' value='<? echo $experience_overwrite['total'] ?>' placeholder='Years'><br />
<?php
					}
?>
				</div>
			</div>
			
			<div class="row" style="margin-bottom:25px">
				<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
					<button type="button" class="btn btn-success save_years">
						<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save
					</button>
	
					<button type="button" class="btn btn-link cancel_edit_years" style="color:#8e080b;">
						Cancel
					</button>
				</div>
			</div>							
			
		</div>
<?php
		}
?>
		

		<div class="row" id='new_work_button_holder' style="margin-bottom: 25px; margin-top: 25px; cursor:pointer">
			<div class='green_button col-md-9 col-md-offset-3' id='add_work_button'>
				<h4><i class="fa fa-plus" aria-hidden="true"></i> New Work/Skills Entry</h4>
			</div>
		</div>
		
		<div class='work_input' id='new_work_holder' style="display: none; margin-top: -25px">
			<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1' id='empty_company_new' style='color:red; display:none'>Company cannot be blank.</div>
			<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1' id='empty_position_new' style='color:red; display:none'>Position cannot be blank.</div>
			<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1' id='empty_type_new' style='color:red; display:none'>Please select a location type.</div>
			<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1' id='empty_year_new' style='color:red; display:none'>Enter a valid employment year.</div>
			<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1' id='bad_dates_year_new' style='color:red; display:none'>Employment end date cannot be earlier than start date.</div>

			<div class="form-horizontal">
				<div class="form-group new_company_form">
				   		<label for="new_company" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Company</label>
				   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
							<input type='text' class='new_company form-control' id="new_company" placeholder='Company Name'>
						</div>
				</div>
					
				<div class="form-group">
				   		<label for="new_business_type" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Business Type</label>
				   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
							<select class='new_business_type form-control' id="new_business_type">
							<option value='0' >--Location Type--</option>
							<option value='Casual'>Casual</option>
							<option value='Upscale Casual'>Upscale Casual</option>
							<option value='Upscale'>Upscale</option>
							<option value='Catering'>Catering</option>
							<option value='Other'>Other</option>
							</select>
						</div>
				</div>

				<div class="form-group new_position_form">						
						<label for="new_position" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Position Type</label>
						<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
							<select class='new_position form-control' id="new_position">
								<option value="NA">-- Select a Position --</option>		
								<option disabled="disabled">-- Front of House Positions --</option>		
<?php
								foreach($FOH as $position) {
									echo "<option class='FOH' value='".$position['titleID']."' data-broad='".$position['category']."'>".$position['title']."</option>";
								}
?>	
								<option disabled="disabled">-- Back of House Positions --</option>		
<?php
								foreach($BOH as $position) {
									echo "<option class='BOH' value='".$position['titleID']."' data-broad='".$position['category']."'>".$position['title']."</option>";
								}
?>	
								<option disabled="disabled">-- Management Positions --</option>		
<?php
								foreach($management as $position) {
									echo "<option class='management' value='".$position['titleID']."' data-broad='".$position['category']."' >".$position['title']."</option>";
								}
?>								
								<option disabled="disabled">-- Other Positions --</option>		
								<option class='other' value='1' data-broad="other">Other Hospitality</option>
								<option class='non' value='0' data-broad="other" >Non-Hospitality</option>			
							</select>
						</div>
				</div>
					
				<div class="form-group new_title_form">	
						<label for="new_title" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Title</label>
						<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
							<input type='text' class='new_title form-control' id='new_title' placeholder='Position Title'><br />
						</div>
				</div>
										
				<div class="form-group">	
						<label for="new_start_date" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Start Date</label>
						<div class="col-md-4 col-md-offset-0 col-xs-4 col-xs-offset-1 col-sm-4  col-sm-offset-0">
							<select class='new_start_date form-control' id="new_start_month" >
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
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4">
							<input type="number" class='new_start_date form-control' id="new_start_year" maxlength="4"  placeholder="Year"></input>
						</div>
				</div>

				<div class="form-group">							

						<label for="new_end_date" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">End Date</label>
						<div class="col-md-4 col-md-offset-0 col-xs-4 col-xs-offset-1 col-sm-4  col-sm-offset-0">
							<select class='new_end_date form-control' id="new_end_month">
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
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4">						
							<input type="number" class='new_end_date form-control' id="new_end_year" maxlength="4"  placeholder="Year"></input>
						</div>
				</div>	
						
					<div class="checkbox col-md-offset-2 col-md-10 col-xs-offset-1 col-xs-10">
					 	<label>
						    &nbsp; &nbsp; <input type="checkbox" class="current" id="new_current_employment" value="current" >
						    Currently Employed Here
						</label>
					</div>	
				<br />
				
				<div class=" text-center" style="margin-bottom: 5px; margin-top: 20px;">
					<h4>Skills Used/Learned at this Job</h4>
				</div>
				
				<div class="" style="margin-bottom: 5px;margin-top:20px">
					<div class="col-md-8 col-md-offset-2 col-xs-12 col-xs-offset-0 text-center">
						<a href='#' class="no-line text-center toggle_FOH" id="new" style="color: black; cursor:pointer; z-index:99999">FRONT OF HOUSE SKILLS &nbsp;  <i class="fa fa-caret-down" id="caret_down_FOH_new" aria-hidden="true"></i><i class="fa fa-caret-up" id="caret_up_FOH_new" aria-hidden="true" style="display: none"></i></a>
						<div class="row work_skills FOH_skills" id='FOH_new' style="display: none">
<?php
							foreach($template_skills as $skill) {
								if ($skill['type'] == "FOH") {
									echo "<div class='col-md-4 col-xs-8 col-xs-offset-1 col-md-offset-2' style='margin-bottom:10px'>";
										echo "<button type='button' class='skill_button skill_reference_new btn btn-default' id='".$skill['skill']."' data-skill='".$skill['skill']."' style='width:250px'><i class='fa fa-check' aria-hidden='true' style='display:none'></i><i class='fa fa-circle-thin' aria-hidden='true'></i> ".$skill['skill']."</button>";
									echo "</div>";
								}
							}
?>
						</div>
					</div>
				</div><br />&nbsp; <br />
				
				<div class="" style="margin-bottom: 5px;">
					<div class="col-md-8 col-md-offset-2 col-xs-12 col-xs-offset-0 text-center">
						<a href='#' class="no-line text-center toggle_BOH" id="new" style="color: black; cursor:pointer">BACK OF HOUSE SKILLS &nbsp;  <i class="fa fa-caret-down" id="caret_down_BOH_new" aria-hidden="true"></i><i class="fa fa-caret-up" id="caret_up_BOH_new" aria-hidden="true" style="display: none"></i></a>
						<div class="row work_skills BOH_skills" id='BOH_new' style="display: none">
<?php
							foreach($template_skills as $skill) {
								if ($skill['type'] == "BOH") {
									echo "<div class='col-md-4 col-xs-8 col-xs-offset-1 col-md-offset-2' style='margin-bottom:10px'>";
										echo "<button type='button' class='skill_button skill_reference_new btn btn-default' id='".$skill['skill']."' data-skill='".$skill['skill']."' style='width:250px'><i class='fa fa-check' aria-hidden='true' style='display:none'></i><i class='fa fa-circle-thin' aria-hidden='true'></i> ".$skill['skill']."</button>";
									echo "</div>";
								}
							}
?>
						</div>
					</div>
				</div><br />&nbsp; <br />

				<div class="" style="margin-bottom: 5px;">
					<div class="col-md-8 col-md-offset-2 col-xs-12 col-xs-offset-0 text-center">
						<a href="#" class="toggle_management" id="new" class="no-line toggle_management text-center" style="color: black; cursor:pointer">MANAGEMENT SKILLS &nbsp;  <i class="fa fa-caret-down" id="caret_down_management_new" aria-hidden="true"></i><i class="fa fa-caret-up" id="caret_up_management_new" aria-hidden="true" style="display: none"></i></a>
						<div class="row work_skills management_skills" id='management_new' style="display: none">
<?php
							foreach($template_skills as $skill) {
								if ($skill['type'] == "Management") {
									echo "<div class='col-md-4 col-xs-8 col-xs-offset-1 col-md-offset-2' style='margin-bottom:10px'>";
										echo "<button type='button' class='skill_button skill_reference_new btn btn-default' id='".$skill['skill']."' data-skill='".$skill['skill']."' style='width:250px'><i class='fa fa-check' aria-hidden='true' style='display:none'></i><i class='fa fa-circle-thin' aria-hidden='true'></i> ".$skill['skill']."</button>";
									echo "</div>";
								}
							}
?>
						</div>
					</div>
				</div>
				
			</div><br />
			
			<div class="row" style="margin-bottom:25px; margin-top: 20px;">
				<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
					<button type="button" class="btn btn-success save_new_work">
						<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save
					</button>

					<button type="button" class="btn btn-link cancel_new_work" style="color:#8e080b;">
						Cancel
					</button>
				</div>
			</div>							
		</div>
<?php
}


function profile_html_edit_education($employee_education) {
?>	
	<div class='container' style="min-height: 70%">
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-9 col-md-offset-3">
				<h2 style="color:black"><i class="fa fa-graduation-cap" aria-hidden="true"></i> ADD/EDIT EDUCATION</h2>
			</div>	
		</div>

<!--
		<div class="row education_row" style="margin-bottom:10px">		
			<div class="col-md-3 col-md-offset-3">
				<h4>SCHOOL</h4>
			</div>
			<div class="col-md-3">
				<h4>TYPE</h4>
			</div>
		</div>
-->
<?php
			foreach($employee_education as $education) {
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
?>	
			<div class="row education_row" style='font-size:16px; margin-bottom:12px'>		
				<div class="col-md-3 col-md-offset-3 col-xs-5 ">
					<a href='#' class='edit_education' id='<? echo $education['ID'] ?>'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> <? echo $education['degree'] ?> from <? echo $education['school'] ?>
				</div>
				<div class="col-md-3 col-xs-5">
					<? echo $education['type'] ?>
				</div>
			</div>
			
			<div class=' education_input' data-education_id='<? echo $education['ID'] ?>' style="display:none">
				<div class='error col-md-10 col-md-offset-2' id='school_empty_warning_<? echo $education['ID'] ?>' style="color:red; margin-bottom:5px; display:none"><b>INSTITUTION CANNOT BE EMPTY</b></div>

				<div class="form-horizontal">
					<div class="form-group" id="school_form_<? echo $education['ID'] ?>" style="margin-bottom:3px">
				   		<label for="edit_school" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Institution</label>
				   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
							<input type='text' class='edit_school form-control ' data-education_id='<? echo $education['ID'] ?>' value='<? echo $education['school'] ?>' placeholder='Institution'><br />
						</div>
					</div>
					
					<div class="form-group">					
						<label for="edit_degree" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Degree</label>
						<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
							<input type='text' class='edit_degree form-control' data-education_id='<? echo $education['ID'] ?>' value='<? echo $education['degree'] ?>' placeholder='Degree'><br />
						</div>
						<label for="edit_education_type" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Type</label>
						<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
							<select class='edit_education_type form-control' data-education_id='<? echo $education['ID'] ?>'>
								<option value='Other'>Other</option>		
								<option value='Culinary School' <? echo $culinary ?>>Culinary School</option>
								<option value='Bartending School' <? echo $bartending ?>>Bartending School</option>
								<option value='College' <? echo $college ?>>College/University</option>
							</select>
						</div>
					</div>
				</div>
				
				<div class="row" style="margin-bottom:25px">
					<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
						<button type="button" class="btn btn-success save_education_edit" id='<? echo $education['ID'] ?>'>
							<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save
						</button>
						
						<button type="button" class="btn btn-danger remove_education" id='<? echo $education['ID'] ?>'>
							<i class="fa fa-trash-o" aria-hidden="true"></i></i> Delete
						</button>

						<button type="button" class="btn btn-link cancel_edit_education" style="color:#8e080b;">
							Cancel
						</button>
					</div>
				</div>							
			</div>
<?php
		}
?>	
		<div class="row" id='new_education_button_holder' style="margin-bottom: 25px; margin-top: 25px; cursor:pointer">
			<div class='green_button col-md-9 col-md-offset-3' id='add_education_button'>
				<h4><i class="fa fa-plus" aria-hidden="true"></i> New Education Entry</h4>
			</div>
		</div>

		<div class='' id='new_education_holder' style="display:none">
			<div class='error col-md-10 col-md-offset-2' id='new_school_empty_warning' style="color:red; margin-bottom:5px; display:none"><b>Institution cannot be empty</b></div>

			<div class="form-horizontal">
				<div class="form-group" id="new_school_form" style="margin-bottom: 3px">
			   		<label for="new_school" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Institution</label>
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='text' class="new_school form-control" id="new_school" placeholder='Institution'><br />
					</div>
				</div>
				<div class="form-group">				
					<label for="new_degree" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Degree</label>
					<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='text' class='new_degree form-control' id="new_degree" placeholder='Degree'><br />
					</div>
					<label for="new_education_type" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Type</label>
					<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<select class='new_education_type form-control'>
							<option value='Other'>Other</option>		
							<option value='Culinary School'>Culinary School</option>
							<option value='Bartending School'>Bartending School</option>
							<option value='College'>College/University</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class="row" style="margin-bottom:25px">
				<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
					<button type="button" class="btn btn-success" id='save_new_education'>
						<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save
					</button>

					<button type="button" class="btn btn-link" id="cancel_new_education" style="color:#8e080b;">
						Cancel
					</button>
				</div>
			</div>							
		</div>
	</div>
		
	</div>	
<?php	
}

function profile_html_edit_certification($template_certifications, $employee_certifications, $employee_awards) {
?>	
	<div class='container' style="min-height: 70%">
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-9 col-md-offset-3">
				<h2 style="color:black"><i class="fa fa-graduation-cap" aria-hidden="true"></i> ADD/EDIT CERTIFICATIONS & AWARDS</h2>
			</div>	
		</div>
<!--
		<div class="row certification_row" style="margin-bottom:10px">		
			<div class="col-md-3 col-md-offset-3">
				<h4>ENTRY</h4>
			</div>
			<div class="col-md-3">
				<h4>TYPE</h4>
			</div>
		</div>
-->
<?php
		if (count($employee_certifications) > 0) {
			foreach($employee_certifications as $row) {
?>
				<div class="row certification_row" style='font-size:16px; margin-bottom:12px'>		
					<div class="col-md-3 col-md-offset-3 col-xs-6">
						<a href='#' class='edit_certification' id='<? echo $row['certificationID'] ?>'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> <? echo $row['certification'] ?>
					</div>
					<div class="col-md-3 col-xs-5">
						Certification
					</div>
				</div>
				
				<div class='row certification_input' data-certification_id='<? echo $row['certificationID'] ?>' style="display:none">
					<div class="row">
						<div class="col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-2 col-xs-10 col-xs-offset-1">
							<h5>Enter a certification of select from the list below</h5>
						</div>
					</div>
					
					<div class='error col-md-10 col-md-offset-2' id='certification_empty_warning_<? echo $row['certificationID'] ?>' style="color:red; display:none">Certification cannot be empty</div>
	
					<div class="form-horizontal">
						<div class="form-group" id="certification_form_<? echo $row['certificationID'] ?>">
					   		<label for="edit_certification" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Certification</label>
					   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
								<input type='text' class='edit_certification_holder form-control' data-certification_id='<? echo $row['certificationID'] ?>' id="certification_<? echo $row['certificationID'] ?>" value='<? echo $row['certification'] ?>' placeholder='Type or Select Certification Below'><br />
							</div>
							<label for="edit_common" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Common Certifications</label>
							<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
								<select class='edit_common form-control' data-certification_id='<? echo $row['certificationID'] ?>'>
									<option class='0'>--Common Certifications--</option>
<?php
									foreach($template_certifications as $common) {
										echo "<option class='".$row['certificationID']."' value='".$common."'>".$common."</option>";										
									}	
?>
								</select>
							</div>
						</div>
					</div>
					
					<div class="row" style="margin-bottom:25px">
						<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
							<button type="button" class="btn btn-success save_certification_edit" id='<? echo $row['certificationID'] ?>'>
								<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save
							</button>
							
							<button type="button" class="btn btn-danger remove_certification" id='<? echo $row['certificationID'] ?>'>
								<i class="fa fa-trash-o" aria-hidden="true"></i></i> Delete
							</button>
	
							<button type="button" class="btn btn-link cancel_edit_certification" style="color:#8e080b;">
								Cancel
							</button>
						</div>
					</div>							
				</div>
<?php
			}
		}	
?>				
		
		<div class=' new_certification_input' style="display:none">
			<div class="row">
				<div class="col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-2 col-xs-10 col-xs-offset-1">
					<h5>Enter a certification or select from the list below</h5>
				</div>
			</div>

			<div class='error col-md-10 col-md-offset-2' id='new_certification_empty_warning' style="color:red; display:none"><b>Certification cannot be empty</b></div>

			<div class="form-horizontal">
				<div class="form-group" id="new_certification_form">
			   		<label for="new_certification" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Certification</label>
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='text' class='new_certification form-control' id="certification_new" placeholder='Type or Select Certification Below'><br />
					</div>
					<label for="edit_common" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Common Certifications</label>
					<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<select class='edit_common form-control'>
							<option class='0'>--- Common Certifications ---</option>
<?php
							foreach($template_certifications as $common) {
								echo "<option class='new' value='".$common."'>".$common."</option>";										
							}	
?>
						</select>
					</div>
				</div>
			</div>
			
			<div class="row" style="margin-bottom:25px">
				<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
					<button type="button" class="btn btn-success save_new_certification">
						<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save
					</button>

					<button type="button" class="btn btn-link cancel_new_certification" style="color:#8e080b;">
						Cancel
					</button>
				</div>
			</div>							
		</div>

<?php
		if (count($employee_awards) > 0) {
			foreach($employee_awards as $row) {
?>
				<div class="row award_row" style='font-size:16px; margin-bottom:12px'>		
					<div class="col-md-3 col-md-offset-3 col-xs-6">
						<a href='#' class='edit_award' id='<? echo $row['awardID'] ?>' ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> <? echo $row['award'] ?>
					</div>
					<div class="col-md-3 col-xs-5">
						Award
					</div>
				</div>
				
				<div class=' award_input' data-award_id='<? echo $row['awardID'] ?>' style="display:none">
					<div class='error col-md-10 col-md-offset-2' id='award_empty_warning_<? echo $row['awardID'] ?>' style="color:red; display:none"><b>Award cannot be empty</b></div>
	
					<div class="form-horizontal">
						<div class="form-group" id="award_form_<? echo $row['awardID'] ?>">
					   		<label for="edit_award" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Award</label>
					   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
								<input type='text' class='edit_award_holder form-control' data-award_id='<? echo $row['awardID'] ?>' value='<? echo $row['award'] ?>' placeholder='Award'><br />
							</div>
						</div>
					</div>
					
					<div class="row" style="margin-bottom:25px">
						<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
							<button type="button" class="btn btn-success save_award_edit" id='<? echo $row['awardID'] ?>'>
								<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save
							</button>
							
							<button type="button" class="btn btn-danger remove_award" id='<? echo $row['awardID'] ?>'>
								<i class="fa fa-trash-o" aria-hidden="true"></i></i> Delete
							</button>
	
							<button type="button" class="btn btn-link cancel_edit_award" style="color:#8e080b;">
								Cancel
							</button>
						</div>
					</div>							
				</div>
<?php
			}
		}
?>	
		<div class=' new_award_input' style="display:none">
			<div class='error col-md-10 col-md-offset-2' id='new_award_empty_warning' style="color:red; display:none"><b>Award cannot be empty</b></div>

			<div class="form-horizontal">
				<div class="form-group" id="new_award_form">
			   		<label for="new_award" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Award</label>
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='text' class='new_award form-control' placeholder='Award'><br />
					</div>
				</div>
			</div>
			
			<div class="row" style="margin-bottom:25px">
				<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
					<button type="button" class="btn btn-success save_new_award">
						<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save
					</button>

					<button type="button" class="btn btn-link cancel_new_award" style="color:#8e080b;">
						Cancel
					</button>
				</div>
			</div>							
		</div>

		<div class="row" id='new_certification_button_holder' style="margin-bottom: 25px; margin-top: 25px; cursor:pointer">
			<div class='green_button col-md-9 col-md-offset-3 col-xs-10 col-xs-offset-1' id='add_certification_button'>
				<h4><i class="fa fa-plus" aria-hidden="true"></i> New Certification Entry</h4>
			</div>
		</div>
		
		<div class="row" id='new_award_button_holder' style="margin-bottom: 25px; margin-top: 25px; cursor:pointer">
			<div class='green_button col-md-9 col-md-offset-3 col-xs-10 col-xs-offset-1' id='add_award_button'>
				<h4><i class="fa fa-plus" aria-hidden="true"></i> New Award Entry</h4>
			</div>
		</div>

	</div>	
<?php	
}


function profile_html_general_info($first_name, $last_name, $email, $zip, $phone, $traits, $languages, $employee_traits, $employee_languages, $employee_seeking) {
//pretty phone number
	$contact_phone = substr_replace($phone , '-', 3, 0);
	$contact_phone = substr_replace($contact_phone , '-', 7, 0);			
	$utilities = new Utilities;
	$broad_types = $utilities->main_skills;

?>
	<div class='container' style="min-height: 60%">
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-9 col-md-offset-3 col-xs-9 col-xs-offset-3 ">
				<h2 style="color:black"><i class="fa fa-drivers-license" aria-hidden="true"></i> EDIT GENERAL INFORMATION</h2>
			</div>	
		</div>

		<div class="row main_row name_row" style='font-size:16px; margin-bottom:12px'>		
			<div class="col-xs-5 col-md-3 col-md-offset-3">
				<a href='#' class='edit' id="name"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> <b>NAME:</b>
			</div>
			<div class="col-xs-5 col-md-6">
				<? echo $first_name." ".$last_name ?>
			</div>
		</div>
		
		<div class="row main_row zip_row" style='font-size:16px; margin-bottom:12px'>		
			<div class="col-xs-5  col-md-3 col-md-offset-3">
				<a href='#' class='edit' id="zip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> <b>REGION:</b>
			</div>
			<div class="col-xs-5 col-md-6">
				<? echo $zip ?>
			</div>
		</div>
		
		<div class="row main_row phone_row" style='font-size:16px; margin-bottom:12px'>		
			<div class="col-xs-5 col-md-3 col-md-offset-3">
				<a href='#' class='edit' id="phone"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> <b>PHONE:</b>
			</div>
			<div class="col-xs-5 col-md-6">
				<? echo $contact_phone ?>
			</div>
		</div>

<!--
		<div class="row main_row email_row" style='font-size:16px; margin-bottom:12px'>		
			<div class="col-xs-5  col-md-3 col-md-offset-3">
				<a href='#' class='edit' id="email"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> <b>EMAIL:</b>
			</div>
			<div class="col-xs-7 col-md-6" style="word-wrap: break-word;">
				<? echo $email ?>
			</div>
		</div>
-->

		<div class="row main_row languages_row" style='font-size:16px; margin-bottom:12px'>		
			<div class="col-xs-5 col-md-3 col-md-offset-3">
				<a href='#' class='edit' id="languages"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> <b>LANGUAGES:</b>
			</div>
			<div class="col-xs-5 col-md-6">
<?php
				if (count($employee_languages) == 0) {
					echo "<i>None</i>";
				} else {
					foreach($employee_languages as $row) {
						echo $row['lang']." ";
					}
				}				
?>
			</div>
		</div>
		
		<div class="row main_row seeking_row" style='font-size:16px; margin-bottom:12px'>		
			<div class="col-xs-5 col-md-3 col-md-offset-3">
				<a href='#' class='edit' id="seeking"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> <b>SEEKING THESE JOBS:</b>
			</div>
			<div class="col-xs-5 col-md-6">
<?php
				if (count($employee_seeking) == 0) {
					echo "<i>None</i>";
				} else {
					foreach($employee_seeking as $row) {
						if (in_array($row['skill'], $broad_types) && $row['seeking'] == "Y") {
							echo $row['skill']." ";
						}
					}
				}				
?>
			</div>
		</div>
		
			
		<div class=' input name_input' style="display:none">
			<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1' id='name_empty_warning' style="color:red; display:none"><b>Name cannot be empty</b></div>

			<div>
				<div class="form-group name_form">
			   		<label for="edit_first_name" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">First Name</label>
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='text' class='edit_first_name form-control' value='<? echo $first_name ?>' placeholder='First Name'><br />
					</div>
					<label for="edit_last_name" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Last Name</label>
					<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='text' class='edit_last_name form-control' value='<? echo $last_name ?>' placeholder='Last Name'><br />
					</div>
				</div>
			</div>
		
				<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
					<button type="button" class="btn btn-success save_name">
						<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save
					</button>

					<button type="button" class="btn btn-link cancel" style="color:#8e080b;">
						Cancel
					</button>
			</div>							
		</div>
			
		<div class=' input zip_input' style="display:none">
			<div class="col-md-9 col-md-offset-3 col-sm-9 col-sm-offset-3">
				You will be matched to jobs in an approximate 40 mile radius of your zip code.
			</div>
			<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1' id='zip_empty_warning' style="color:red; display:none"><b>Zip Code cannot be empty</b></div>
			<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1' id='zip_invalid_warning' style="color:red; display:none"><b>Zip Code does not appear to be valid</b></div>

			<div class="form-horizontal">
				<div class="form-group zip_form">
			   		<label for="edit_zip" class="col-md-2 col-xs-2 col-xs-offset-1 control-label">Zip Code</label>
			   		<div class="col-md-9 col-xs-8">
						<input type='text' class='edit_zip form-control' value='<? echo $zip ?>' maxlength="5" placeholder='Zip Code'><br />
					</div>
			</div>
			</div>
			
			<div class="row" style="margin-bottom:25px">
				<div class="col-md-10 col-xs-10 col-md-offset-3 col-xs-offset-1 col-sm-offset-3">
					<button type="button" class="btn btn-success save_zip">
						<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save
					</button>

					<button type="button" class="btn btn-link cancel" style="color:#8e080b;">
						Cancel
					</button>
				</div>
			</div>							
		</div>

		<div class=' input phone_input' style="display:none">
			<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1' id='phone_empty_warning' style="color:red; display:none">Phone must be 10 digits - ### ### ####</div>

			<div class="form-horizontal">
				<div class="form-group phone_form">
			   		<label for="edit_phone" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Phone Number</label>
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='phone' class='edit_phone form-control' value='<? echo $phone ?>' placeholder='Phone Number'><br />
					</div>
				</div>
			</div>
			
			<div class="row" style="margin-bottom:25px">
				<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1 col-sm-offset-2">
					<button type="button" class="btn btn-success save_phone">
						<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save
					</button>

					<button type="button" class="btn btn-link cancel" style="color:#8e080b;">
						Cancel
					</button>
				</div>
			</div>							
		</div>
		
		<div class=' input email_input' style="display:none">
			<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1' id='email_empty_warning' style="color:red; display:none">Please provide a valid email address</div>
			<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1' id='email_duplicate_warning' style="color:red; display:none">This email address is already being used</div>

			<div class="form-horizontal">
				<div class="form-group email_form">
			   		<label for="edit_email" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Email Address</label>
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='text' class='edit_email form-control' value='<? echo $email ?>' placeholder='Email Address'><br />
					</div>
				</div>
			</div>
			
			<div class="row" style="margin-bottom:25px">
				<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1 col-sm-offset-2">
					<button type="button" class="btn btn-success save_email">
						<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save
					</button>

					<button type="button" class="btn btn-link cancel" style="color:#8e080b;">
						Cancel
					</button>
				</div>
			</div>							
		</div>		

		<div class=' input languages_input' style="display:none">
			<div class="row" style="margin-bottom: 5px;">
				<div class="col-md-8 col-md-offset-2 col-md-9 col-xs-offset-1">
					<h5>Select any languages you speak</h5>
					<div class="row">
<?php
					$count = 1;
					foreach($languages as $row) {
						$active = "";
						$check = "display:none";
						$circle = "";
						
						foreach($employee_languages as $lang) {
							if ($lang['lang'] == $row) {
								$active = "active";
								$circle = "display:none";
								$check = "";
							}
						}

						echo "<div class='col-md-3 col-xs-5' style='margin-bottom:10px'>";
							echo "<button type='button' class='language_button btn btn-default ".$active."' id='".$row."' style='width:150px'><i class='fa fa-check' aria-hidden='true' style='".$check."'></i><i class='fa fa-circle-thin' aria-hidden='true' style='".$circle."'></i> ".$row."</button>";
						echo "</div>";
						
						$count++;
					}
?>
					</div>
				</div>
			</div>
			<div class="row" style="margin-bottom:25px">
				<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
					<button type="button" class="btn btn-success save_languages">
						<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save
					</button>

					<button type="button" class="btn btn-link cancel" style="color:#8e080b;">
						Cancel
					</button>
				</div>
			</div>							
		</div>

		<div class='input seeking_input' style="display:none">
			<div class="row" style="margin-bottom: 5px;">
				<div class="col-md-8 col-md-offset-2 col-md-9 col-xs-offset-1">
					<h5>You will be matched to the following job types</h5>
					<div class="row">
<?php
					$count = 1;
					foreach($broad_types as $row) {
						$active = "";
						$check = "display:none";
						$circle = "";
						
						foreach($employee_seeking as $seeking) {
							if ($seeking['skill'] == $row && $seeking['seeking'] == "Y") {
								$active = "active";
								$circle = "display:none";
								$check = "";
							}
						}

						echo "<div class='col-md-3 col-xs-5' style='margin-bottom:10px'>";
							echo "<button type='button' class='seeking_button btn btn-default ".$active."' id='".$row."' style='width:150px'><i class='fa fa-check' aria-hidden='true' style='".$check."'></i><i class='fa fa-circle-thin' aria-hidden='true' style='".$circle."'></i> ".$row."</button>";
						echo "</div>";
						
						$count++;
					}
?>
					</div>
				</div>
			</div>
			<div class="row" style="margin-bottom:25px">
				<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
					<button type="button" class="btn btn-success save_seeking">
						<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save
					</button>

					<button type="button" class="btn btn-link cancel" style="color:#8e080b;">
						Cancel
					</button>
				</div>
			</div>							
		</div>

	</div>		
<?php	
}

function profile_html_personal_info($quote, $long_description) {
?>

	<div class='container' style="min-height: 70%">
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-9 col-md-offset-3">
				<h2 style="color:black"><i class="fa fa-file-text" aria-hidden="true"></i> PERSONAL QUOTE & DESCRIPTION</h2>
			</div>	
		</div>

		<div class="row" >		
			<div class="col-md-12">
				<h4>Personal Quote</h5>
				&nbsp; <i>Give a short description (70 characters or less) of who you are, as an employee.</i>
			</div>
			
			<div class="col-md-12" id='charNum' style='color:red;'></div>
			<div class="col-md-12 employee_summary">
				<textarea class="form-control" id='quote' rows="3" maxlength="70"><?php echo $quote ?></textarea>
			</div>
		</div><br />
		
		<div class="row">		
			<div class="col-md-12">
				<h4>Description</h5>
					&nbsp; <i>Paste your resume or include any additional information you'd like to share with potential employers in the area below.</i>
			</div>
			
			<div class="col-md-12 employee_summary">
				<textarea class="form-control" id='long_description' rows="8"><?php echo $long_description ?></textarea>
			</div>
		</div><br />

		<div class="row" style="margin-bottom:35px">		
			<div class="col-md-12">		
				<button type="button" class="btn btn-success" id='save_descriptions'>
					<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save
				</button>
			</div>
		</div>

	</div>
<?php	
}

function profile_html_edit_photos($upload_url, $photo, $raw_photo, $kitchen, $bartender, $kitchen_photos, $bar_photos, $profile_status) {
	if ($raw_photo != "NA") {
		$profile_pic_size_array = getimagesize("images/profile_pics/".$raw_photo);
			if ($profile_pic_size_array[1] < 200) {
				$profile_pic_size = "small";
			} else {
				$profile_pic_size = "large";
			}
	} else {
		$profile_pic_size = "NA";
	}
?>		

	<div class='container' style="min-height: 70%">
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-8 col-md-offset-4">
				<h2 style="color:black"><i class="fa fa-image" aria-hidden="true"></i> ADD/EDIT PHOTOS</h2>
			</div>	
		</div>

		<div class="warning row" id="file_size_warning" style="display:none; color:red; margin-top:10px;">
			<div class="col-md-8 col-md-offset-4">
				<h4>Please choose a file less than 5 MB</h4>
			</div>
		</div>
						
		<div class="warning row" id='file_type_warning' style="display:none; color:red; margin-top:10px;">
			<div class="col-md-8 col-md-offset-4">
				<h4>Please choose a PNG or JPG file</h4>
			</div>
		</div>																																																																																														


		<div class='row'>
            <div class="col-md-4 col-md-offset-1">
                <div class="panel-employee text-center">
					<h4 style="padding-top:7px">Main Profile Pic</h4>
                    <div class="panel-employee-photo">
<?
						if($profile_pic_size == "small") {
?>
	                        <div class="row">
								<img src="images/profile_pics/<? echo $raw_photo."?".time() ?>" class="center-block profilephoto" id='main_photo' style='margin-top:80px; margin-bottom:80px'>
						    </div>
<?php							
						} elseif($profile_pic_size == "large") {
?>
	                       <img src="images/profile_pics/<? echo $raw_photo."?".time() ?>" class="center-block profilephoto" id='main_photo' style="max-height:280px;max-width:280px;height:auto;width:auto;">
<?php												
						} else {
?>
	                        <div class="row">
								<h2>NA</h2>
						    </div>
<?php							
						}
?>
						<div class="col-md-7 col-md-offset-3" style="margin-top: 5px; margin-bottom: 25px;">
							<button type="button" class="btn btn-warning edit_profile_photo add_photo" id="profile">
								<i class="fa fa-pencil-square-o" aria-hidden="true" style="background-color: transparent"></i> Edit
							</button>
<?php
							if ($photo != "<b>NO PHOTO</b>") {	
?>	       
							<button type="button" class="btn btn-danger remove_profile_photo remove_photo" id="profile">
								<i class="fa fa-trash-o" aria-hidden="true"></i></i> Delete
							</button>
<?php
							}
?>    
		            	</div>

                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="panel-employee text-center">
					<h4>Other Pics (up to 12)</h4>
					<b>Use this space to showcase your skills</b><br />
					
					<div class="row">
<?php
					$image_count = 1;
					$total_count = 0;
					if (count($bar_photos) > 0) {	
						foreach($bar_photos as $photo) {
							if ($image_count == 5) {
								$image_count = 1;
?>
							</div>
							<div class="row">
<?php							
							}
?>
							<div class="col-md-3">	
								<img src='images/gallery_pics/<? echo $photo['thumb']."?".time() ?>' height='100' class="center-block" style="margin-bottom: 3px; margin-top: 15px;">
								<button type="button" class="btn btn-danger remove_photo" id='<? echo $photo['photoID'] ?>'>
									<i class="fa fa-trash-o" aria-hidden="true"></i></i> Delete
								</button>
							</div>
<?php
						$image_count++;
						$total_count++;
						}
					}

					if (count($kitchen_photos) > 0) {			
						foreach($kitchen_photos as $photo) {
							
							if ($image_count == 5) {
								$image_count = 1;
?>
								</div>
								<div class="row">
<?php							
							}							 
?>
							<div class="col-md-3">	
								<img src='images/gallery_pics/<? echo $photo['thumb']."?".time() ?>' height='100' class="center-block" style="margin-bottom: 3px; margin-top: 15px;">
								<button type="button" class="btn btn-danger remove_photo" id='<? echo $photo['photoID'] ?>'>
									<i class="fa fa-trash-o" aria-hidden="true"></i></i> Delete
								</button>
							</div>
<?php
								$image_count++;
								$total_count++;
							}
						}
?>
					</div>

					<div class="row" id='new_photo_button_holder' style="margin-bottom: 31px; margin-top: 15px; cursor:pointer">
<?php
					if ($total_count < 12) {	
?>					
						<div class="green_button col-md-12 add_photo" id="bartender">
							<h4><i class="fa fa-plus" aria-hidden="true"></i> New Gallery Photo</h4>
						</div>
<?php
					} else {
?>
						<div class='green_button col-md-12' id='add_photo_button'>
							&nbsp; <br />
						</div>
<?php						
					}
?>		
					</div>
                </div> &nbsp; <br />
            </div>
		</div>


	</div>	
					
	<div id='status' style="width:100%; color:red;"></div>			
	
	<form id='profile_form_ie' action='<? echo $upload_url ?>_ie.php?type=profile' method='post' enctype='multipart/form-data' style="float:left; padding-bottom:25px; padding-left:30px; margin-top:30px; display:none;">
		<h2 style="text-align:center;">Choose a File</h2>
		&nbsp; &nbsp; &nbsp; &nbsp; <input type='file' id='profile_pic_choose_ie' name='profile_pic_choose_ie' >
		<input type='submit' value='Save Profile Pic' id='profile_upload_button_ie'><br />
		<a href='#' class='upload_cancel' id='profile'>Cancel</a><br />"				
		<div id='status' style="color:red"></div>"	
	</form>			
						
	<div id="add_photo_tools" style="margin-top:-15px;">			
	    <form id="myform" action="<? echo $upload_url ?>.php?type=profile" method="post" enctype="multipart/form-data" style="position:absolute; top:-500px;">
	        <input type="file" id="profile_pic_choose" name="profile_pic_choose" >
			<input type="submit" value="Save Profile Pic1" id="profile_upload_button"><br />
		</form>
	</div>
	
	<form id="bar_form" action="<? echo $upload_url ?>.php?type=bartender" method="post" enctype="multipart/form-data" style="position:absolute; top:-500px;">
        <input type="file" id="bartender_pic_choose" name="bartender_pic_choose" >
		<input type="submit" value="Save Profile Pic" id="bartender_upload_button"><br />
	</form>

	<div id='status' style="width:100%; color:red;"></div>			

	<form id='bar_form_ie' action='<? echo $upload_url ?>_ie.php?type=bartender' method='post' enctype='multipart/form-data' style="float:left; padding-top:30px; padding-left:10px; display:none">
	    <h2 style='text-align:center;'>Choose a File</h2>
	    &nbsp; &nbsp; &nbsp; &nbsp; <input type='file' id='bartender_pic_choose_ie' name='bartender_pic_choose_ie' ><br />
	    &nbsp; <br />
		&nbsp; &nbsp; &nbsp;  &nbsp; <input type='submit' value='Save Cocktail Pic' id='bartender_upload_button_ie'><br />
		<a href='#' class='upload_cancel' id='bar'>Cancel</a><br />											
		&nbsp; <br />
		<div id='status' style="color:red"></div>	
	</form>			

<?php
}
	
function profile_html_employee_settings($email_setting, $option, $email, $open_job_count, $share_status) {

		$standard = "";
		$off = "";
		$one = "";
		$three = "";		
		if ($email_setting == 'Y') {
			$standard = "selected";
			$email_text = "Normal <br /><i style='font-size:12px;'>Notices sent when matched jobs are entered</i>";
		} else {
			if ($option == "0") {
				$off = "selected";
				$email_text = "Off <br /><i style='font-size:12px;'>No job notices sent</i>";
			} else if ($option == "1") {
				$one = "selected";	
				$email_text = "1-Month Reminder <br /><i style='font-size:12px;'>A single reminder will be sent in one month</i>";			
			} else if ($option == "3") {
				$three = "selected";
				$email_text = "3-Month Reminder <br /><i style='font-size:12px;'>A single reminder will be sent in three months</i>";
			}		
		}	
		
		if ($_SESSION['type'] == "employee") {
			$type = "Job Seeker";
		} else {
			$type = "Employer";
		}	
		
?>
	<div class='container' style="min-height: 70%">
		<div class='row' style="margin-bottom:12px">
			<div class="col-xs-9 col-xs-offset-3">
				<h2 style="color:black"><i class="fa fa-cog" aria-hidden="true"></i> SETTINGS</h2>
			</div>	
		</div>

		<div class="row setting_row" style="font-size:16px; margin-bottom:12px">		
			<div class="col-xs-5 col-md-3 col-md-offset-3">
				<a href='main.php?page=email' class='edit_email'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> Email Address
			</div>
			<div class="col-xs-7 col-md-4" style="word-wrap: break-word;">
				<? echo $email ?>
			</div>
		</div>

		<div class="row setting_row" style="font-size:16px; margin-bottom:12px">		
			<div class="col-xs-5 col-md-3 col-md-offset-3">
				<a href='#' class='edit_password'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> Password
			</div>
			<div class="col-xs-4 col-md-4">
				***********************
			</div>
		</div>
		
<?php
		if ($_SESSION['type'] == "employee") {
?>
			<div class="row setting_row" style="font-size:16px; margin-bottom:12px">		
				<div class="col-xs-5 col-md-3 col-md-offset-3">
					<a href='#' class='edit_share_setting'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> Sharable Profile (<a href="main.php?page=share_faq"><i>What's this?</i></a> )
				</div>
				<div class="col-xs-7 col-md-4">
					<? echo $share_status ?>
				</div>
			</div>
<?php
		}
?>
		
		<div class="row setting_row" style="font-size:16px; margin-bottom:12px">		
			<div class="col-xs-5 col-md-3 col-md-offset-3">
				<a href='#' class='edit_email_setting'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> Email Setting
			</div>
			<div class="col-xs-7 col-md-4">
				<? echo $email_text ?>
			</div>
		</div>

		<div class="row setting_row" style="font-size:16px; margin-bottom:12px">		
			<div class="col-xs-5 col-md-3 col-md-offset-3">
				<a href='#' class='edit_account_type'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> Account Type
			</div>
			<div class="col-xs-4 col-md-4">
				<? echo $type ?>
			</div>
		</div>
	
<!-- 	FORMS	 -->

		<div class=' email_input_holder' style="display:none">
			<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-2' id='email_empty_warning' style="color:red; display:none"><b>Email cannot be empty</b></div>
			<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-2' id='non_email_warning' style="color:red; display:none"><b>Please enter a valid email address</b></div>
			<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-2' id='duplicate_email_warning' style="color:red; display:none"><b>Email address already being used</b></div>

			<div class="form-horizontal">
				<div class="form-group" id="email_form">
			   		<label for="edit_award" class="col-md-2 col-xs-2 col-xs-offset-1 control-label">Email Address</label>
			   		<div class="col-md-9 col-xs-8">
						<input type='text' class='edit_email_holder form-control'  id="edit_email_holder" value='<? echo $email ?>' placeholder='Email'>
					</div>
				</div>
			</div>
			
			<input type="hidden" id="old_email_holder" value="<? echo $email ?>">

			<div class="row" style="margin-bottom:25px">
				<div class="col-md-10 col-xs-10 col-md-offset-3 col-xs-offset-1">
					<button type="button" class="btn btn-success save_email_edit">
						<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save
					</button>
					
					<button type="button" class="btn btn-link cancel_email_edit" style="color:#8e080b;">
						Cancel
					</button><br /> &nbsp; <br />
					<b>A verification email will be sent to your new address</b>

				</div>
			</div>							
		</div>

		<div class='row' id="email_change_success" style="display:none">
			<div class="row" style="margin-bottom:25px">
				<div class="col-md-10 col-md-offset-2 col-xs-10 col-xs-offset-1">
					<h5>ACTION REQUIRED</h5>
					A verification link has been sent to your new email address. You must click the link in that email to finalize the change.
				</div>
			</div>							
		</div>
		
		<div class=' password_change_holder' style="display:none">
			<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1' id='new_pass_warning' style="color:red; display:none"><b>Your new passwords don't match</b></div>
			<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1' id='old_pass_warning' style="color:red; display:none"><b>Your old password is incorrect</b></div>
			<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1' id='pass_length_warning' style="color:red; display:none"><b>Your new password must be between 6 and 12 characters</b></div>

			<div class="form-horizontal">
				<div class="form-group">				
					<label for="old_password" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Old Password</label>
					<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='password' class='old_pass form-control' id="old_pass" placeholder='Old Password'><br />
					</div>
					<label for="new_pass1" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">New Password</label>
					<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='password' class='new_pass1 form-control' id="new_pass1" placeholder='New Password'><br />
					</div>
					<label for="new_pass2" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Re-type New Password</label>
					<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='password' class='new_pass2 form-control' id="new_pass2" placeholder='Re-type New Password'><br />
					</div>
				</div>		
			</div>
			
			<div class="row" style="margin-bottom:25px">
				<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
					<button type="button" class="btn btn-success save_new_password">
						<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save
					</button>
					
					<button type="button" class="btn btn-link cancel_edit_password" style="color:#8e080b;">
						Cancel
					</button><br /> &nbsp; <br />
				</div>
			</div>							
		</div>

		<div class='' id="password_change_success" style="display:none">
			<div class="row" style="margin-bottom:25px">
				<div class="col-md-10 col-md-offset-2">
					Password successfully changed.
				</div>
			</div>							
		</div>
		
		<div class=' email_setting_input' style="display: none">
			<div class="form-horizontal">					
				<div class="form-group">
			   		<label for="edit_email_setting" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Email Setting</label>
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<select class='edit_email_setting form-control' id="edit_email_setting">
							<option value='Y' <? echo $standard ?> >Standard</option>
							<option value='1' <? echo $one ?>>Notices Off & Reminder 1 month</option>";
							<option value='3' <? echo $three ?> >Notices Off & Reminder 3 months</option>";						
							<option value='N' <? echo $off ?> >All Off</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class="row" style="margin-bottom:15px">
				<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
					<button type="button" class="btn btn-success save_email_setting">
						<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save
					</button>

					<button type="button" class="btn btn-link cancel_email_setting" style="color:#8e080b;">
						Cancel
					</button>
				</div>
			</div>			

			<div class="row" style="margin-bottom:25px">
				<div class="col-md-9 col-md-offset-2 col-xs-10 col-xs-offset-1">
					<b>Standard:</b> Receive emails when you are matched to a job, giving the best opportunity for a quick response.<br  />
					&nbsp; <br />
					<b>Notices Off & Reminder:</b> No notification of jobs that match your profile.<br />
						A single reminder will be sent in one or three months.  No other emails.<br />			
					&nbsp; <br />
					<b>All Off:</b> No notification of jobs that match your profile.<br />
						You may miss out on several opportunities.<br />
				</div>
			</div>
						
		</div>
		
		
		<div class=' type_input_holder' style="display:none">
			<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1' id='zip_empty_warning' style="color:red; display:none"><b>Email cannot be empty</b></div>
			<div class='error col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1' id='bad_zip_warning' style="color:red; display:none"><b>Please enter an email address</b></div>
			
			<div class="row">
				<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
<?php
			if ($_SESSION['type'] == "employee") {
?>
					<h4>Switch account to Employer Account</h4>
					An employer account will allow you to post job opening, but you will no longer be able to view apply to jobs.
<?php				
			} else {
				if ($open_job_count > 0) {
?>
						<h4>Switch account to Job Seeker Account</h4>
						You cannot switch account types while you have open jobs posted.  Please change you account type after your job postings have expired.
<?php									
				} else {
?>
						<h4>Switch account to Job Seeker Account</h4>
						A Job Seeker account will allow you view and apply to jobs, but you will no longer be able to post job openings.
	
						<div class="form-horizontal">
							<div class="form-group" id="zip_form">
						   		<label for="new_zip" class="col-md-2 col-md-offset-0 col-xs-10 col-xs-offset-1 control-label">Zip Code</label>
						   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1">
									<input type='number' class='new_zip form-control'  placeholder='Zip Code' maxlength="5">
								</div>
							</div>
						</div>
<?php									
				}	
			}
?>
				</div>
			</div>
			
			<div class="row" style="margin-bottom:25px; margin-top: 25px;">
				<div class="col-md-10 col-xs-10 col-md-offset-3 col-xs-offset-1">
<?php
					if ($_SESSION['type'] == "employee" || $open_job_count == 0) {
?>	
					<button type="button" class="btn btn-success save_type_switch" id="change_account_type">
						<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Switch
					</button>
<?php
					}
?>					
					<button type="button" class="btn btn-link cancel_account_type" style="color:#8e080b;">
						Cancel
					</button><br /> &nbsp; <br />

				</div>
			</div>							
		</div>
		
		<div class='share_setting_input' style="display: none">
			<div class="form-horizontal">					
				<div class="form-group">
			   		<label for="edit_share_setting" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Profile Share Setting</label>
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<select class='edit_share_setting form-control' id="edit_share_setting">
							<option value='Y' <? echo $yes ?> >Yes</option>
							<option value='N' <? echo $no ?> >No</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class="row" style="margin-bottom:15px">
				<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
					<button type="button" class="btn btn-success save_share_setting">
						<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save
					</button>

					<button type="button" class="btn btn-link cancel_share_setting" style="color:#8e080b;">
						Cancel
					</button>
				</div>
			</div>			
		</div>
		
	</div>	

<?php
}

function profile_html_upload_resume($resume) {
	if ($resume == NULL) {
		$resume = "N";
	} else {
		$resume = "/resumes/".$resume.".pdf";
	}
		
?>
	<div class='container' style="min-height: 70%">
		<div class='row' style="margin-bottom:12px">
			<div class="col-xs-9 col-xs-offset-2">
				<h2 style="color:black"><i class="fa fa-cog" aria-hidden="true"></i> UPLOAD PDF RESUME</h2>
			</div>	
		</div>

<?php
		if ($resume != "N") {
?>
		<div class="row setting_row" style="font-size:16px; margin-bottom:12px">		
			<div class="col-xs-5 col-md-3 col-md-offset-3">
				<a href='#' class='view_resume'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> View Resume
			</div>
			<div class="col-xs-7 col-md-4" style="word-wrap: break-word;">
				<a href='#' class='remove_resume'>Remove Resume</a>
			</div>
		</div><br />

<?php
		} else {
?>
	
<!-- 	FORMS	 -->

		<div class='resume_input_holder'>
			<div class='error col-md-10 col-xs-10 col-md-offset-3 col-xs-offset-2' id='file_empty_warning' style="color:red; display:none"><b>Please Choose a File</b></div>
			<div class='error col-md-10 col-xs-10 col-md-offset-3 col-xs-offset-2' id='file_type_warning' style="color:red; display:none"><b>Resume must be a PDF file</b></div>

			<div class="form-horizontal">
				<div class="col-md-8 col-md-offset-3 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
					<form id="myform" action="upload_resume.php" method="post" enctype="multipart/form-data" >
					<label class="btn btn-default">
						Browse <input type="file" id="resume_file" name="resume_file" hidden>
						<input type="submit" value="Save Profile Pic1" id="resume_upload_button" hidden>

					</label>
					</form>

				</div>
			</div><br /> &nbsp; <br />
			&nbsp; <br />
			
			<div class="row" style="margin-bottom:25px; margin-top:25px">
				<div class="col-md-10 col-xs-10 col-md-offset-3 col-xs-offset-1">
					<button type="button" class="btn btn-success save_resume">
						<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save
					</button>
				</div>
			</div>							
		</div>
<?php
	}
?>		
	</div>	

<?php
}

function profile_html_successful_upload() {
?>
	<div class='container' style="min-height: 70%">
		<div class='row' style="margin-bottom:12px">
			<div class="col-xs-9 col-xs-offset-3">
				<h2 style="color:black"><i class="fa fa-cog" aria-hidden="true"></i> UPLOAD PDF RESUME</h2>
			</div>	
		</div>

		<div class="row setting_row" style="text-align:center; font-size:16px; margin-bottom:12px">		
			<h3>Successful Upload</h3>
			<a href='employee.php'>Back to Profile</a>
		</div><br />
	</div>
<?php	
}

function profile_html_employee($employee_data, $total_experience, $employee_store_type, $employee_position_experience, $employee_skills_experience, $old_employee_skills, $ref_job_store) {
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
		
		if ($employee_data['general']['profile_pic'] == "") {
			$profile_pic = "<i class='fa fa-user fa-4x profilephoto' aria-hidden='true'></i>";
			$profile_pic_size = "small";
			$profile_pic_status = "N";
		} else {
			//get profile photo size for legacy photos:
			$profile_pic_size_array = getimagesize("images/profile_pics/".$employee_data['general']['profile_pic']);
			if ($profile_pic_size_array[1] < 200) {
				$profile_pic_size = "small";
				$profile_pic = "<img src='images/profile_pics/".$employee_data['general']['profile_pic']."?".time()."' class='center-block profilephoto' id='main_photo' style='margin-top:80px; margin-bottom:80px'>";
			} else {
				$profile_pic = "<img src='images/profile_pics/".$employee_data['general']['profile_pic']."?".time()."' class='center-block profilephoto' id='main_photo' style='max-height:280px;max-width:280px;height:auto;width:auto;'>";
				$profile_pic_size = "large";
			}
			$profile_pic_status = "Y";
		}	
		

//MAKE PHONE NUMBER READABLE
		if ($employee_data['general']['contact_phone'] == "") {
			$contact_phone = "<i>No phone entered</i>";
		} else {
			$contact_phone = substr_replace($employee_data['general']['contact_phone'] , '-', 3, 0);
			$contact_phone = substr_replace($contact_phone , '-', 7, 0);			
		}			
					
?>	
	
<!-- NEED CONTAINER DIV -->
<div class="container">
	<div class='block block-pd-sm text-center edit_menu'>
		
<?php
		//button only appears if user has signed up from public job post
		if ($ref_job_store != "NA") {
?>
		<div class="row">
            <div class="col-md-12 col-xs-12 text-center" style="margin-top:-10px; margin-bottom: 5px;">
	            <b>Click an option to add/edit info on your profile.</b><br />
	        </div>
		</div>
<?php		
		}
?>	
		
		
		<div class="row">
			<div class="col-md-offset-2 col-xs-offset-0 col-md-8 col-xs-12">
				<div class="row">
					<div class='col-md-4 col-xs-4 unselected_tab btn btn-large btn-default edit' id="general_info" style="cursor: pointer;">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Basic Info
					</div>
					<div class='col-md-4 col-xs-4 unselected_tab  btn btn-large btn-default edit' id="work_skills_menu">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Experience
					</div>
					<div class='col-md-4 col-xs-4 unselected_tab  btn btn-large btn-default edit' id="edit_certification">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>Certification
					</div>
				</div>
			</div>
		</div>
		
		<div class="row" style="margin-top: 10px">
			<div class="col-md-offset-2 col-xs-offset-0 col-md-8 col-xs-12">
				<div class="row">
					<div class='col-md-4 col-xs-4 unselected_tab btn btn-large btn-default edit' id="edit_education">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Education
					</div>
					<div class='col-md-4 col-xs-4 unselected_tab btn btn-large btn-default edit' id="edit_photos">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Photos
					</div>
					<div class='col-md-4 col-xs-4 unselected_tab btn btn-large btn-default edit' id="edit_personal_info">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Description
					</div>
				</div>
			</div>
		</div>		
<!-- NEW			 -->
		<div class="row" style="margin-top: 10px">
			<div class="col-md-offset-4 col-xs-offset-3 col-md-8 col-xs-12">
				<div class="row">
					<div class='col-md-6 col-xs-6 unselected_tab btn btn-large btn-default edit' id="edit_resume">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>Upload a PDF Resume
					</div>
				</div>
			</div>
		</div>
		
		
<?php
		//button only appears if user has signed up from public job post
		if ($ref_job_store != "NA") {
?>
		<div class="row">
            <div class="col-md-12 col-xs-12 text-center" style="margin-top: 20px;">
	             <a href="opportunity.php?ID=<? echo $ref_job_store['ref_jobID'] ?>" class="btn btn-more btn-lg i-right" style="background-color: #ff5821; color: #fff;">Finish Profile and Apply<i class="fa fa-angle-right"></i></a>
				 &nbsp; <a href='#' class="cancel_apply">CANCEL</a><br />
				<i> You can view your profile below</i>

	        </div>
	        <div class="col-md-12 col-xs-12">
		        <hr>
	        </div>
		</div>
<?php		
		}
?>	
		
	</div>
		
	
        <!-- Profile block -->
        <div class="block-contained ">
            <div class="row">
                <div class="col-md-4">
                    <h2 class="block-title titlename">
						<? echo $general_array['firstname'] ?> <? echo $general_array['lastname'] ?>
					</h2>
                </div>
                <div class="col-md-8">
<?php
					if ($quote == "") {
?>
						<h4 class="block-title quoteline" style="margin-top: 6px;"><i>No personal quote added</i></h2>
<?php
					} else {
?>
            	        <h4 class="block-title quoteline"  style="margin-top: 6px;"><i>"<? echo $quote ?>"</i></h2>
<?php
					}
?>		
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel-employee text-center">

                    <div class="panel-employee-photo">
<?
						if($profile_pic_size == "small") {
?>
	                        <div class="row">
		                        <? echo $profile_pic ?>
						    </div>
<?php							
						} else {
?>
		                    <? echo $profile_pic ?>
<?php												
						}
						
						//hidden images		
						if (count($kitchen_photo_array) > 0) {
							foreach($kitchen_photo_array as $photo) {
								echo "<img src='images/gallery_pics/".$photo['photo']."?".time()."' class='center-block profilephoto' style='max-height:280px;max-width:280px;height:auto;width:auto; display:none' id='".$photo['photoID']."_large'>";
							}	
						}
						
						if (count($bar_photo_array) > 0) {
							foreach($bar_photo_array as $photo) {
								echo "<img src='images/gallery_pics/".$photo['photo']."?".time()."' class='center-block profilephoto' style='max-height:280px;max-width:280px;height:auto;width:auto; display:none' id='".$photo['photoID']."_large'>";
							}	
						}							
?>
                        <div class="portfoliophotos">
<?php
							if (count($kitchen_photo_array) > 0 || count($bar_photo_array) > 0) {
								if ($profile_pic_status == "Y") {	
									//Thumb of main profile pic	
									echo "<a href='#' class='thumb' id='profile'><img src='images/profile_pics/".$employee_data['general']['profile_pic']."?".time()."' class='portfoliophotos'></a>";
								}
							}
															
							if (count($kitchen_photo_array) > 0) {
								foreach($kitchen_photo_array as $photo) {
									echo "<a href='#' class='thumb' id='".$photo['photoID']."'><img src='images/gallery_pics/".$photo['thumb']."?".time()."' class='portfoliophotos'></a>";
								}	
							}
							
							if (count($bar_photo_array) > 0) {
								foreach($bar_photo_array as $photo) {
									echo "<a href='#' class='thumb' id='".$photo['photoID']."'><img src='images/gallery_pics/".$photo['thumb']."?".time()."' class='portfoliophotos'></a>";
								}	
							}							
?>
                        </div>
                    </div>

                    <div class="panel-body" >
                        <div class="profilephone" style="margin-top: -30px"><? echo $contact_phone ?></div>
                        <div class="profileemail"><? echo $general_array['email'] ?></div>
<?php
						$lang_count = count($language_array);
						if ($lang_count > 0) {
?>
							<b>Languages</b>
                         <ul class="langlist">
							
<?php
							foreach($language_array as $row) {
								echo "<li>".$row['lang']."</li>";
							}
						} 
?>
                        </ul>
                    </div>
                </div>

                <div class="row endorsements hidden-xs">
					<div class="col-md-12">
	                    <h4>Endorsements</h4>
	                    <br />
	                    &nbsp; &nbsp; <i>Coming Soon</i>
<!--
	                    <div class="row">
	                        <div class="col-xs-4 padding-zero">
	                            <img src="images/employee02.jpg">
	                        </div>
	                        <div class="col-xs-8 padding-top-sm">
		                        Holy cow John beats the meat out of the competition
		                    </div>
	                    </div>
	                    <div class="row">
	                        <div class="col-xs-4 padding-zero">
		                        <img src="images/employee03.jpg">
	                        </div>
	                        <div class="col-xs-8 padding-top-sm">That meats legit</div>
	                    </div>
	                    <div class="row">
	                        <div class="col-xs-4 padding-zero">
		                        <img src="images/employee04.jpg">
	                        </div>
	                        <div class="col-xs-8 padding-top-sm">
		                        It goes in extra hot and finishes early, the steak is great too!
		                    </div>
	                    </div>
-->

					</div>
                </div>
            </div>

            <div class="col-md-8">
                <div id="hostpitalityblock">
	                    <div class="circlewrap hosp-exp">
<?
								//based on total Hospitaltiy experience light up right circle
								$hospitality_five = (round($total_experience['hospitality'])%5 === 0) ? round($total_experience['hospitality']) : round(($total_experience['hospitality']+5/2)/5)*5;

								if ($hospitality_five < 5) {
									echo "<div class='profilecircle c5yr'></div>";									
								} else {
			                        echo "<div class='profilecircle cpast c5yr'></div>";
								}	
								
								if ($hospitality_five >= 10) {
			                        echo "<div class='profilecircle cpast c10yr'></div>";
								}	else {
			                        echo "<div class='profilecircle c10yr'></div>";									
								}
								
                    			echo "<div class='profilecircle cactive 15yr'>";
									echo "<h4>Hospitality</h4>".round($total_experience['hospitality'])."<span class='subyears'>YEARS</span>";
								echo "</div>";
								
								if ($hospitality_five >= 20) {
			                        echo "<div class='profilecircle cpast c20yr'></div>";
								}	else {
			                        echo "<div class='profilecircle c20yr'></div>";									
								}
								
								if ($hospitality_five >= 25) {
			                        echo "<div class='profilecircle cpast c20yr'></div>";
								} else {
			                        echo "<div class='profilecircle c25yr'></div>";									
								}
?>	
								<span style="display: inline-block;vertical-align: middle; line-height: normal; padding-bottom: 20px">	
									<a href='#' class='hospitality_header' style=' display:inline; color:#8b0909'><h5><i class="fa fa-chevron-right" aria-hidden="true"></i></h5></a>
								</span>
	                    	</div>
	                    	
	                    	<div class="circlewrap total-exp" style='display:none'>
								<span style="display: inline-block;vertical-align: middle; line-height: normal; padding-bottom: 20px">	
									<a href='#' class='total_header' style=' display:inline; color:#8b0909'><h5><i class="fa fa-chevron-left" aria-hidden="true"></i></h5></a>
								</span>
		                    	
<?
								//based on total Hospitaltiy experience light up right circle
								$total_five = (round($total_experience['total'])%5 === 0) ? round($total_experience['total']) : round(($total_experience['total']+5/2)/5)*5;

								if ($total_five < 5) {
									echo "<div class='profilecircle c5yr'></div>";									
								} else {
			                        echo "<div class='profilecircle cpast c5yr'></div>";
								}	
								
								if ($total_five >= 10) {
			                        echo "<div class='profilecircle cpast c10yr'></div>";
								}	else {
			                        echo "<div class='profilecircle c10yr'></div>";									
								}
								
                    			echo "<div class='profilecircle cactive-total 15yr'>";
									echo "<h4>TOTAL</h4>".round($total_experience['total'])."<span class='subyears'>YEARS</span>";
								echo "</div>";
								
								if ($total_five >= 20) {
			                        echo "<div class='profilecircle cpast c20yr'></div>";
								}	else {
			                        echo "<div class='profilecircle c20yr'></div>";									
								}
								
								if ($total_five >= 25) {
			                        echo "<div class='profilecircle cpast c25yr'></div>";
								} else {
			                        echo "<div class='profilecircle c25yr'></div>";									
								}
?>
	                    	</div> 
                </div>
                
                <div class="row exposwrap">
	                
                    <div class="col-md-6 profileexperience">
                        <h4>Positions Held (Yrs)</h4>
<?php
						if (count($employee_position_experience) > 0) {//WRONG THING : SHOULD BE SKILLS
							$count = 1;
							foreach($employee_position_experience as $key=>$row) {
								if ($count == 1) {
									$circle = "topcircle";
								} else {
									$circle = "subcircle";
								}
								
								$rounded_yrs = round($row);
								if ($rounded_yrs < 1) {
									$rounded_yrs = "<1";
								}
								
								if ($count > 3) {
									$position_display = "style='display:none'";
									$position_class = "hidden_position";
								} else {
									$position_display = "";									
									$position_class = "";
								}
								
?>
								 <div class="topexperience <? echo $position_class ?>" <? echo $position_display ?>><? echo $key ?>:
								 	<div class="<? echo $circle ?>"><? echo $rounded_yrs ?></div>
								 </div>
<?php
								$count++;
							}
						} else {
?>
							 <div class="topexperience">
								 <i class="fa fa-circle-thin" aria-hidden="true"></i> None Listed
							 </div>
<?php
						}	
						
						if (count($employee_position_experience) > 3) {
?>
							<a href='#' id="show_positions_button"><h5 style='text-align:center; color:#8b0909' class="show_positions_button"><i class="fa fa-chevron-down" aria-hidden="true"></i> SHOW MORE POSITIONS <i class="fa fa-chevron-down" aria-hidden="true"></i></h5></a>		                        
							<a href='#' id="hide_positions_button"><h5 style='text-align:center; color:#8b0909; display:none;' class="hide_positions_button"><i class="fa fa-chevron-up" aria-hidden="true"></i> HIDE POSITIONS <i class="fa fa-chevron-up" aria-hidden="true"></i></h5></a>		                        
<?php
						}
?>
                    </div>                    

                    <div class="col-md-6 profilepositions">
                        <h4 class="spacer">Skills</h4>
<?php
						if (count($employee_skills_experience) > 0) {
							$count = 1;
							$bar = "";
							$rounded_row = "";
							foreach($employee_skills_experience as $key=>$row) {
								$rounded_row = round($row);
								if ($rounded_row < 10) {
									if ($rounded_row == 0) {
										$bar = "posbar01";
										$row = "less than 1";					
									} else {
										$bar = "posbar0".$rounded_row;
									}
								} else {
									$bar = "posbar08";
								}
								
								if ($count > 4) {
									$skill_display = "style='display:none'";
									$skill_class = "hidden_skill";
								} else {
									$skill_display = "";									
									$skill_class = "";
								}
?>
					            <div class="posbar <? echo $bar ?> <? echo $skill_class ?>" <? echo $skill_display ?>>
					                <span><? echo $key ?></span><span><? echo $row ?> yr(s)</span>
					            </div>
<?php	
								$count++;		
							}
						} else {
?>
				            <div class="topexperience" style="margin-top: -10px; ">
				                <i class="fa fa-circle-thin" aria-hidden="true"></i> No Hospitality Skills Listed
				            </div>
<?php							
						}	
						
						if (count($employee_skills_experience) > 3) {
?>
							<a href='#' id="show_skills_button"><h5 style='text-align:center; color:#8b0909; margin-top:40px;' class="show_skills_button"><i class="fa fa-chevron-down" aria-hidden="true"></i> SHOW MORE SKILLS <i class="fa fa-chevron-down" aria-hidden="true"></i></h5></a>		                        
							<a href='#' id="hide_skills_button"><h5 style='text-align:center; color:#8b0909; margin-top:40px; display:none' class="hide_skills_button"><i class="fa fa-chevron-up" aria-hidden="true"></i> HIDE SKILLS <i class="fa fa-chevron-up" aria-hidden="true"></i></h5></a>		                        
<?php
						}
?> 
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="row pastwrap">
                    <div class="col-md-12">
	                    <hr>
                        <h4 style="padding-top: 15px;">Past Employment</h4>
 <?php
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
?>	
								<div class="row">
									<div class="col-md-6 col-xs-6 col-xs-offset-1" style="color:black"><i class="fa fa-circle-o" aria-hidden="true"></i> <? echo strtoupper($row['company']) ?></div>
									<div class="col-md-3 col-xs-5" style="color:black"><? echo $row['position'] ?></div>
									<div class="col-md-3 col-xs-10 col-xs-offset-2"><? echo $start_date." - ".$end_date ?>  <i><? echo $time ?></i></div>
								</div>			
<?php
							}
						} else {
?>
							<div class="row">
								<div class="col-md-12 "><i class="fa fa-circle-thin" aria-hidden="true"></i> No Past Employment Entered.</div>
							</div>
<?php
		}	
?>                
                    </div>        
                </div>

                <div class="row profileedu">
                    <div class="col-md-12">
                        <h4 style='margin-bottom:5px;'>Education</h4>

						<div class="row">                        
<?php
						if (count($education_array) > 0) {
							foreach ($education_array as $row) {
?>
		                        <div class="col-md-6 col-xs-10 col-xs-offset-1 school"><i class="fa fa-graduation-cap" aria-hidden="true"></i> <? echo $row['school'] ?> - <? echo $row['degree'] ?></div>
<?php
							}
						} else {
?>
							<div class="col-md-6 col-xs-10 col-xs-offset-0 school"><i class="fa fa-circle-thin" aria-hidden="true"></i> <i>Optional</i></div>
<?php
						}
?>	
						</div>
                    </div>
                </div>
                
                <div class="row awardscerts">
<?php
					if (count($certifications) == 0 && count($awards) == 0) {
?>
                		<div class="col-md-12">
		                    <h4 style='margin-bottom:10px;'>Awards & Certifications</h4>
							<i class="fa fa-circle-thin" aria-hidden="true"></i> <i>Optional</i>
                		</div>
<?php
					} else {

						if (count($awards) > 0) {
?>
                			<div class="col-md-6">
                  				<h4 style='margin-bottom:10px;'>Awards</h4>
                  				<div class="col-md-12 col-xs-10 col-xs-offset-1">
<?php					
								foreach ($awards as $row) {
?>	
									<i class="fa fa-trophy" aria-hidden="true"></i> <? echo $row['award'] ?></br>		
<?php
								}
?>
								</div>
							</div>
<?php
						}

							if (count($certifications) > 0) {
?>
								<div class="col-md-6">					

	             			       <h4 style='margin-bottom:10px;'>Certifications</h4>
				 				   <div class="col-md-12 col-xs-10 col-xs-offset-1">
<?php				
									foreach ($certifications as $row) {
?>
										<i class="fa fa-id-card" aria-hidden="true"></i> <? echo $row['certification'] ?></br>		
<?php
								}
?>
									</div>
								</div>
<?php
							}
					}
?>
                </div>
                
                <div class="row extrainfo">
                    <div class="col-md-12">
                        <h4>Description</h4> 		<? echo nl2br($description) ?>
                    </div>
                </div>
                
<!--
                <div class="endorsements visible-xs">
                    <h4>Endorsements</h4>
                    <div class="row">
                        <div class="col-xs-4 padding-zero">
                            <img src="images/employee02.jpg">
                        </div>
                        <div class="col-xs-8 padding-top-sm">
	                        Holy cow John beats the meat out of the competition
	                    </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 padding-zero">
	                        <img src="images/employee03.jpg">
                        </div>
                        <div class="col-xs-8 padding-top-sm">
	                        That meats legit
	                    </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 padding-zero">
	                        <img src="images/employee04.jpg">
                        </div>
                        <div class="col-xs-8 padding-top-sm">
	                        It goes in extra hot and finishes early, the steak is great too!
	                    </div>
                    </div>
                </div>
-->
            </div>
    </div>
</div>
<?php
}


function profile_html_type_switch() {	
?>	
	<table class='dark' style="width:100%;">
		<tr valign='middle'>
			<th valign='middle'>Switch Account Type</th>
		</tr>		
	</table>
		
	You have signed up for a Job-Seeker/Employee account.  This account type is for members looking for open jobs.<br />
	&nbsp; <br />
	If you are an Employer (Manager, HR Respresentative, etc.) and wish to post jobs on the site, you can switch your account type by filling out the info below.	
	&nbsp; <br />

	<div id='empty_warning' class='warning' style="display:none; width:100%; text-align:center;"><font color='red'><b>Please complete required fields</b></font></div>
	<div id='permission_warning' class='warning' style="display:none; width:100%; text-align:center;"><font color='red'><b>You must check the box below to continue</b></font></div>
	<div id='other_warning' class='warning' style="display:none; width:100%; text-align:center;"><font color='red'><b>There was a problem processing your request, please contact admin@servebartendcook.com</b></font></div><br />

		
	<b>Company:</b> <input type='text' id='company' name='company' size='16' /><br />
	&nbsp; <br />
	<b>Your Title:</b> <input type='text' id='position' name='position' size='16' placeholder='owner, manager, etc' /><br />       
	<input type='checkbox' id='permission' value='18'>
	<div style="font-size: 11px;"><b>I certify that I represent the company entered below and have the right and/or permission to make hiring decisions or recommendations.</b></div>
	<div style="float:left; margin-top:20px; width:100%"><a href='#' class='btn btn-large btn-primary' id='change_account_type'>Change Account Type</a></div>					
<?php
}

function profile_html_loader() {
?>
	<div class="" id="loader" style="display: none">
		<div class="row text-center" style="margin-top: 150px; margin-bottom: 150px;">
			<h3>LOADING...</h3>
		</div>
	</div>
<?php
}
?>