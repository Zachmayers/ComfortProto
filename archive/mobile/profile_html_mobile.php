<?php
//	require_once('classes.php');
function 	profile_html_employee_step_one_mobile($first_name, $last_name, $skill_array, $status) {

		$utilities = new Utilities;
		$member = new Member;
		$skill_count = count($skill_array);
		
		$bartender_select = "-webkit-filter: grayscale(70%);";
		$server_select = "-webkit-filter: grayscale(70%);";
		$kitchen_select = "-webkit-filter: grayscale(70%);";
		$bus_select = "-webkit-filter: grayscale(70%);";
		$host_select = "-webkit-filter: grayscale(70%);";
		$manager_select = "-webkit-filter: grayscale(70%);";	

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

		echo "<div class='main_box' style='margin-top:25px; float:left; width:100%; margin-left:2px;'>";				
			if ($skill_count == 0 && $status != "complete") {
				echo "<h4 style='text-align:center; margin-top:5px; margin-bottom:5px;'>WELCOME</h4>";
				echo "<div style='width:100%; margin-left:5px; margin-right:5px;'><font-color='#760006'>In order to match you with jobs from various companies, you first need to finish your profile.  It is only a few quick steps, and you can modify at any time in the future.</font></div>";
			}
			
			echo "<table style='width:100%; margin-top:10px;'>";
				echo "<tr>";
					echo "<td><a href='#' class='back btn btn-warning' style='display:none' id='".$name_array[$i]."'>Back</a></td>";
					if ($status != "complete") {					
						echo "<td align='center'><h2 style='display:inline;'>Profile: Step 1 of 4</h2></td>";
					} else {
						echo "<td> &nbsp; </td>";
					}
					echo "<td align='right'>";
					if (count($skill_array) > 0 && $status != "complete") {
						echo "<a href='#' class='continue btn btn-warning' >Skip</a>";
					}
					echo "</td>";
				echo "</tr>";
			echo "</table>";

		echo "<input type='hidden' id='status' value='".$status."'>";
		echo	"<table class='dark' style='width:100%; margin-top:10px;'>";
			echo "<tr valign='middle'>";
			echo "<th valign='middle'><b>".$first_name." ".$last_name."</b></th>";
			echo "</tr>";			
		echo "</table>";
		
				//build variable arrays
				$sub_arrays = array($utilities->management_skills, $utilities->server_skills, $utilities->bar_skills, $utilities->kitchen_skills, $utilities->bus_skills, $utilities->host_skills);
				$name_array = array("Manager", "Server", "Bartender", "Kitchen", "Bus", "Host");
				$current_skill_count = count($skill_array);
				echo "<div id='step_one' style='color:#760006'>";
					echo "<h4 class='main_skill' style='text-align:center;'> &nbsp; Skills & Experience</h4>";
					echo " <div class='main_skill' style='margin-top:-10px;'>&nbsp; Please select a skill to add to your profile or edit:</div><br />";
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
				
					if (count($skill_array) > 0) {
						echo "<div class='main_skill' style='float:left; margin-top:15px; padding-bottom:15px; width:100%; text-align:center;'>";
							echo " <a href='#' class='continue btn btn-primary'>Continue</a><br />";
							echo "&nbsp; <br />";
						echo "</div>";
					}			
				
					for ($i = 0; $i<=5; $i++) {
						$experience = "";
						$description = "";
						$seeking = "";
						$current_sub_array = array();
						$remove_button = "";

						if (count($skill_array) > 0) {
							foreach ($skill_array as $key=>$row) {
								if ($row['skill'] == $name_array[$i]) {
									$experience = $utilities->makeSafe($row['experience']);
									$description = $utilities->mynl2br($utilities->makeSafe($row['description']));
									$seeking = $row['seeking'];
									$current_sub_array = $member->get_user_data('sub_skills', $row['skillID']);	
									$remove_button = "<div style='margin-top:10px; text-align:center; width:100%;'><a href='#' class='remove_skill btn btn-primary' id='".$row['skillID']."'' >Remove</a></div><br />";	
									unset($skill_array[$key]);
								} 
							}
						} 
						
						//Hidden DIv that opens when clicking the proper badge
						echo "<div class='skill_holder' id='".$name_array[$i]."_holder' style=' width:95%; margin-top:-30px; margin-left:5px; display:none'>";
						echo "<h3 style='text-align:center;'>".$name_array[$i]." Experience</h3>";						
						echo $remove_button;
						echo "&nbsp; <br />";

						if ($seeking == 'N') {
							$n_selected = "selected";
							$y_selected = "";
						} else {
							$n_selected = "";
							$y_selected = "selected";							
						}				

						echo " <div style='text-align:center; style='width:98%'><b style='font-size:13pt'>Seeking this job type?</b> &nbsp; ";
						echo "<select class='seeking' id='".$name_array[$i]."_seeking' style='background-color:#b76163'>";
							echo "<option value='Y' ".$y_selected.">Yes</option>";
							echo "<option value='N' ".$n_selected.">No</option>";
						echo "</select></div><br/>";
						echo "<div style='margin-top:-15px;'><i style='font-size:11px'>Selecting 'No' will leave these details on your resume, but will not match you with jobs of this type</i></div><br />";


						echo "<div style='float:left; margin-top:-5px; width:30%;'>";
							if ($name_array[$i] == "Bartender") {
								echo "<img src='images/main-bar.png' height='80px';>";	
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
						
						echo "<div style='float:left; width:65%; padding-top:15px; margin-left:px;'>";
						echo "<div id='".$name_array[$i]."_experience_warning' style='display:none; float:left;'><font color='red'>Experience must be a number</font></div><br />";
						echo "<input type='text' class='experience' id='".$name_array[$i]."_experience' value='".$experience."' style='width:40px;'> years of experience.<br />";
						echo "</div>";
						
						echo "<div style='float:left; width:100%; padding-top:10px; padding-left:10px;'>";
						echo "Brief description of your experience<br/>";
						echo "<textarea class='skill_desc' id='".$name_array[$i]."_desc' cols='50' rows='5' style='width:90%;'>".$description."</textarea><br />";
						echo "</div>";						
						
						echo "<div style='float:left; width:100%; margin-top:3px;'>";
						echo "<div style='font-size:14pt; width:100%; text-align:center;'><b>Specific Skills</b></div><br />";
						echo "<b>Important:</b>  <i>These selections are used to identify potential job opportunities for you.</i><br/>";
						echo "<div id='".$name_array[$i]."_sub_warning' style='display:none'><font color='red'>You must select at least one specialty.</font></div>";
						echo "<table width='98%' cellpadding='3'>";
						echo "<tr>";
						echo "</tr>";
						
						$row_count = 2;
						foreach($sub_arrays[$i] as $row) {
							$checked = "";
							if (count($current_sub_array) > 0) {
								foreach ($current_sub_array as $sub_skill) {
									if ($sub_skill['sub_skill'] == $row) {
										$checked = "checked";
									}
								}
							}
							if ($row_count % 2 == 0) {
								echo "<tr>";								
								echo "<td style='width:48%; word-wrap: break-word;'><label class='checkbox'>&nbsp;<input type='checkbox' class='".$name_array[$i]."' value='".$row."' ".$checked." data-toggle='checkbox'><b>".$row."</b></label></td>";
							} else {
								echo "<td style='width:48%'><label class='checkbox'>&nbsp;<input type='checkbox' class='".$name_array[$i]."' value='".$row."' ".$checked." data-toggle='checkbox'><b>".$row."</b></label></td>";								
								echo "</tr>";
							}
							$row_count++;
						}
						if ($row_count % 2 == 0) {	
							echo "</tr>";
						}											
						echo "</table>";
						
						echo "</div>";
						if ($status != "complete") {
							echo "<div id='button_holder'>";						
								echo "<div style='float:left; margin-top:15px; padding-bottom:15px; width:100%; text-align:center;'><a href='#' class='save_add_another btn btn-primary' style='margin-right:2px; margin-bottom:2px;' id='".$name_array[$i]."'>Save & Add Another</a>";
								echo " <a href='#' class='save_continue btn  btn-primary' id='".$name_array[$i]."'>Save & Continue</a><br />";
								echo "&nbsp; <br />";
								echo "</div>";
							echo "</div>";
						} else {
							echo "<div id='button_holder'>";						
								echo "<div style=' float:left; margin-top:35px; width:100%; text-align:center;'><a href='#' class='save_continue btn btn-primary' id='".$name_array[$i]."'>Save Changes</a> &nbsp;<br/> &nbsp;</div> ";							
							echo "</div>";
						}
						
						echo "</div>";
						//	echo "</div>";					
					}
								
					echo "</div>";	
											
				echo "</div>";													
}

function profile_html_employee_step_two_mobile($first_name, $last_name, $past_employment_array, $status) {
		$utilities = new Utilities;
		
		echo "<div class='main_box' style='margin-top:70px; margin-bottom:15px; '>";				

		if  ($status != "complete") {
			$back = "<a href='#' class='back btn btn-warning'>Back</a>";
		} else {
			$back = "";
		}
		echo "<table style='width:100%'>";
			echo "<tr>";
				echo "<td>".$back."</td>";
				if ($status != "complete") {
					echo "<td align='center'><h2 style='display:inline;'>Profile: Step 2 of 4</h2></td>";
					echo "<td align='right'><a href='#' class='continue btn btn-warning' >Skip</a></td>";					
				} else {
					echo "<td> &nbsp; </td><td> &nbsp; </td>";
				}

			echo "</tr>";
		echo "</table>";
		
		echo	"<table class='dark add_work_form' style='width:100%;'>";
			echo "<tr valign='middle'>";
			echo "<th valign='middle' align='center'><b>Past Employment</b></th>";
			echo "</tr>";			
		echo "</table>";
							
				echo "<div id='step_two' style='color:#760006'>";
					
					echo "<div id='employment_list'>";
					if (count($past_employment_array) > 0) {
						foreach ($past_employment_array as $row) {
							//Visible table
							$emp_date = $utilities->makeSafe($row['start_date'])."-".$utilities->makeSafe($row['end_date']);
							echo "<table class='visible_employment' cellspacing='6' cellpadding='6' style='margin-left:0px; margin-bottom:20px; width:98%; table-layout:fixed;' id='employment_".$row['ID']."'>";							
							echo "<tr>";
							echo "<td width='35%' style='word-wrap: break-word;'><b>".$utilities->makeSafe($row['company'])."</b></td>";
							echo "<td width='30%' style='word-wrap: break-word;'>".$utilities->makeSafe($row['position'])."</td>";		
							echo "<td width='25%' style='word-wrap: break-word;'>".$emp_date."</td>";
							echo "<td width='10%'><a href='#' class='edit_work' id='".$row['ID']."'><img src='images/edit.png'></a></td>";	

							echo "</tr>";
							echo "</table>";	
							
							//Hidden table for editing
							echo "<div class='hidden_employment' style='display:none' id='employment_record_".$row['ID']."'>";
								echo	"<table class='dark' style='width:100%;'>";
									echo "<tr valign='middle'>";
									echo "<th valign='middle' align='center'><b>Edit Employment Record</b></th>";
									echo "</tr>";			
								echo "</table>";
								echo "<div style='float:left; width:100%; text-align:center; margin-top:25px; margin-top:10px;'><a href='#' class='remove_work btn btn-primary' id='".$row['ID']."'>Remove Record</a></div><br />";														
								echo "<div id='company_empty_warning_".$row['ID']."' style='display:none; float:left; width:100%; margin-top:10px; text-align:center;'><font color='red'><b>COMPANY CANNOT BE BLANK.</b></font></div>";								
								echo "<table style='width:100%; margin-top:20px;'>";
									echo "<tr>";
									echo "<td><b>Company:</b></td><td><input type='text' id='company_".$row['ID']."' value='".$utilities->makeSafe($row['company'])."'></td>";
									echo "</tr>";
									echo "<tr>";
									echo "<td><b>Website:</b></td><td><input type='text' id='website_".$row['ID']."' value='".$utilities->makeSafe($row['website'])."'></td>";
									echo "</tr>";
									echo "<tr>";
									echo "<td><b>Position:</b></td><td><input type='text' id='position_".$row['ID']."' value='".$utilities->makeSafe($row['position'])."'></td>";		
									echo "</tr>";
									echo "<tr>";
									echo "<td><b>Start Date</b></td><td><input type='text' id='start_".$row['ID']."' value='".$utilities->makeSafe($row['start_date'])."'></td>";
									echo "</tr>";
									echo "<tr>";
									echo "<td><b>End Date:</b></td><td><input type='text' id='end_".$row['ID']."' value='".$utilities->makeSafe($row['end_date'])."'></td>";
								echo "</table>";
								echo " &nbsp <br />";

								echo "<div id='button_holder'>";								
									echo "<a href='#' class='btn btn-large btn-primary save_changes' id='".$row['ID']."'>Save Changes</a> <a href='#' class='btn btn-large btn-primary cancel'>Cancel</a>";
								echo "</div>";
							echo "</div>";							
						}
					}			
					echo "</div>";	
					
					echo "<div class='add_work_form'>";
						echo	"<table class='dark' style='width:100%;'>";
							echo "<tr valign='middle'>";
							echo "<th valign='middle' align='center'><b>Add New Employment Record</b></th>";
							echo "</tr>";			
						echo "</table>";
?>					
					
						<div id="past_company_empty_warning" style="display:none; margin-left:10px; margin-top:5px; margin-bottom:-10px;"><font color="red"><b>COMPANY CANNOT BE BLANK.</b></font></div><br />			  
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
							<td><input type="text" name="start_date" id="start_date"></input></td>
						</tr>
						<tr>
							<td><b>End Date: &nbsp; </b></td>
							<td><input type="text" name="end_date" id="end_date"></input></td>
						</tr>
					</table>
					&nbsp; <br />
<?php	
				if ($status == "complete") {
					echo "<div id='button_holder'>";
						echo "<div style='float:left; margin-top:10px; margin-bottom:15px; width:100%'><a href='#' class='save_continue btn btn-large btn-primary'>Save Employment Record</a></div>";					
					echo "</div>";
				} else {	
					echo "<div id='button_holder' style='text-align:center'>";					
						echo "<div style='float:left; margin-top:10px; margin-bottom:15px; margin-left:5px; width:100%; text-align:center;'><a href='#' class='save_add_another btn btn-large btn-primary'>Save & Add Another</a><br />";
						echo "&nbsp; <br />";
						echo "&nbsp; <br />";						
						echo " <a href='#' class='save_continue btn btn-large btn-primary' >Save & Continue</a>";
						echo "&nbsp; <br /> &nbsp; <br /></div>";	
					echo "</div>";						
				}	

				
				echo "</div>";																						
				echo "</div>";														
				echo "</div>";
																							
}	

function profile_html_employee_step_three_mobile($first_name, $last_name, $education_array, $status) {
		$utilities = new Utilities;
		
		echo "<div class='main_box' style='margin-top:70px; '>";				

		if  ($status != "complete") {
			$back = "<a href='#' class='back btn btn-warning'>Back</a>";
		} else {
			$back = "";
		}
		echo "<table style='width:100%'>";
			echo "<tr>";
				echo "<td>".$back."</td>";
					if  ($status != "complete") {				
						echo "<td align='center'><h2 style='display:inline;'>Profile: Step 3 of 4</h2></td>";
						echo "<td align='right'><a href='#' class='continue btn btn-warning' >Skip</a></td>";
					} else {
						echo "<td> &nbsp; </td>";
					}
				echo "</tr>";
			echo "</table>";
		
		echo	"<table class='dark add_education_form' style='width:100%;'>";
			echo "<tr valign='middle'>";
			echo "<th valign='middle' align='center'><b>Education & Certification</b></th>";
			echo "</tr>";			
		echo "</table>";
							
				echo "<div id='step_three' style='color:#760006'>";					
					echo "<div id='education_list'>";
					if (count($education_array) > 0) {
						foreach ($education_array as $row) {
								echo "<table class='visible_education' cellspacing='6' cellpadding='6' style=' margin-bottom:20px; width:98%; table-layout:fixed;'>";							
								echo "<tr>";
								echo "<td style='width:50%' style='word-wrap: break-word;'><b>".$utilities->makeSafe($row['school'])."</b></td>";
								echo "<td style='width:40%' style='word-wrap: break-word;'>".$utilities->makeSafe($row['degree'])."</td>";
								echo "<td align='right' style='width:10%'><a href='#' class='edit_education' id='".$row['ID']."'><img src='images/edit.png'></a></td>";	
								echo "</tr>";
								echo "</table>";								
							
							//Hidden table for editing
							echo "<div class='hidden_education' id='education_".$row['ID']."_edit' style='display:none'>";
								echo	"<table class='dark add_work_form' style='width:100%;'>";
									echo "<tr valign='middle'>";
									echo "<th valign='middle' align='center'><b>Edit Education Record</b></th>";
									echo "</tr>";			
								echo "</table>";
								echo "<div style='float:left; width:100%; margin-top:25px; margin-top:10px; text-align:center;'><a href='#' class='remove_education btn btn-primary' id='".$row['ID']."'>Remove Record</a></div><br />";														
								echo " &nbsp; <br />";
								echo "<table style='width:98%'>";							
								echo "<tr id='school_empty_warning_".$row['ID']."' style='display:none'><td><font color='red'><b>INSTITUTION CANNOT BE BLANK.</b></font></td></tr>";
								echo "<tr>";
								echo "<td width='100%' style='text-align:center'><b>School/Institution:</b></td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td width='100%' style='text-align:center'><input type='text' id='school_".$row['ID']."' style='width:100%' value='".$utilities->makeSafe($row['school'])."'></td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td width='100%' style='text-align:center'><b>Degree/Certification:</b></td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td width='100%' style='text-align:center'><input type='text' id='degree_".$row['ID']."' style='width:100%' value='".$utilities->makeSafe($row['degree'])."'></td>";		
								echo "</tr>";
								echo "</table>";		
								echo " &nbsp; <br />";
								
								echo "<div id='button_holder' style='text-align:center;'>";								
									echo "<a href='#' class='btn btn-large btn-primary save_changes' id='".$row['ID']."'>Save Changes</a> <a href='#' class='btn btn-large btn-primary cancel'>Cancel</a>";
								echo "</div>";

							echo "</div>";
						}
					}			
					echo "</div>";
					
					echo	"<table class='dark add_education_form' style='width:100%;'>";
						echo "<tr valign='middle'>";
						echo "<th valign='middle' align='center'><b>Add Education</b></th>";
						echo "</tr>";			
					echo "</table>";
?>
					<div id="school_empty_warning" style="display:none; margin-top:3px; text-align:center;"><font color="red"><b>INSTITUTION CANNOT BE BLANK.</b></font></div>
					&nbsp; <br />		  
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
			if ($status == "complete") {
				echo "<div id='button_holder' style='margin-left:5px;'>";			
					echo "<div style='float:left; margin-top:10px; margin-bottom:15px; width:100%'><a href='#' class='save_continue btn btn-large btn-primary'>Save Education Record</a></div>";								
				echo "</div>";
			} else {		
				echo "<div id='button_holder' style='text-align:center;'>";						
					echo "<div style='float:left; margin-top:10px; width:100%; text-align:center;'><a href='#' class='save_add_another btn btn-large btn-primary'>Save & Add Another</a><br />";
					echo "&nbsp; <br /> &nbsp; <br />";
					echo " <a href='#' class='save_continue btn btn-large btn-primary'>Save & Continue</a>";
					echo "&nbsp; <br /> &nbsp; <br /></div>";	
				echo "</div>";						
			}
			
				echo "</div>";
				echo "</div>";
				echo "</div>";																														
}

function profile_html_employee_step_four_mobile($first_name, $last_name, $profile_pic, $video_url, $videoID) {
		//$member = new Member;
		
		echo "<div class='main_box' style='margin-top:70px;'>";				

		echo "<table style='width:100%'>";
			echo "<tr>";
				echo "<td><a href='#' class='back btn btn-warning'>Back</a></td>";
				echo "<td align='center'><h2 style='display:inline;'>Profile: Step 4 of 4</h2></td>";
				echo "<td align='right'> &nbsp; </td>";
			echo "</tr>";
		echo "</table>";
		
		echo	"<table class='dark' style='width:100%;'>";
			echo "<tr valign='middle'>";
			echo "<th valign='middle' align='center'><b>Personalize</b></th>";
			echo "</tr>";			
		echo "</table>";
					
?>
				<div id="languages form" style='color:#760006; width:100%;'>
						<table style='margin-top:10px; width:100%;' cellspacing="4">
						<tr>
							<td><b>Multilingual?</b></td> 
							<td colspan='2'>Select any or none of the languages below</td>
						</tr>
						<tr class="lang_list" style="<? echo $display ?> style='margin-left:10px;">
							<td><label class='checkbox'><input type="checkbox" class="languages" value="Spanish" data-toggle='checkbox' <? echo $Spanish ?>> Spanish</label></td>
							<td><label class='checkbox'><input type="checkbox" class="languages" value="French" data-toggle='checkbox' <? echo $French ?>> French</label></td>
							<td><label class='checkbox'><input type="checkbox" class="languages" value="Japanese" data-toggle='checkbox' <? echo $Japanese ?>> Japanese</label></td>				
						</tr>		
						<tr class="lang_list" style="<? echo $display ?> style='margin-left:10px;">	
							<td> <label class='checkbox'><input type="checkbox" class="languages" value="Italian" data-toggle='checkbox' <? echo $Italian ?>> Italian</label></td>
							<td><label class='checkbox'><input type="checkbox" class="languages" value="German" data-toggle='checkbox' <? echo $German ?>> German</label></td>
							<td><label class='checkbox'><input type="checkbox" class="languages" value="Korean" data-toggle='checkbox' <? echo $Korean ?>> Korean</label></td>				
						</tr>	
						<tr class="lang_list" style="<? echo $display ?> style='margin-left:10px;">	
							<td><label class='checkbox'><input type="checkbox" class="languages" value="Russian" data-toggle='checkbox' <? echo $Russian ?>> Russian</label></td>
							<td><label class='checkbox'><input type="checkbox" class="languages" value="Hindi" data-toggle='checkbox' <? echo $Hindi ?>> Hindi</label></td>
							<td><label class='checkbox'><input type="checkbox" class="languages" value="Other" data-toggle='checkbox' <? echo $Other ?>> Other</label></td>				
						</tr>																			
					</table>
				</div>
<?php	

		$pic_options = "<div style='float:left; width:100%; margin-top:10px; margin-left:5px; color:#760006'>";
		$pic_options .= "<h4>Profile Photo (<i>optional</i>)</h4>";		

		if ($profile_pic == "") {
			$pic_options .= "<div class='photo_holder' style='float:left; width:100%; min-height:50px;'><div id='profile_pic' style='float:left; padding-top:15px; padding-right:25px;'>&nbsp; &nbsp; &nbsp; &nbsp; <a href='#' id='profile' class='add_photo btn btn-primary'>Add Profile Photo</a></div>";
			$pic_options .= "<div id='status' style='color:red; float:left;'></div>";		
			$pic_options .= "</form>";
			$pic_options .= "</div>";		
			
			$photo_edit = "";
		} else {
			$pic_options .= "<div class='photo_holder' style='float:left; width:100%; min-height:170px;'>";			
			$pic_options .= "<div id='photo_buttons' style='float:left; width:50%; margin-top:15px; margin-left:15px;'><a href='#' class='add_photo btn btn-primary' id='profile'>Change Profile Photo</a> <br /> &nbsp; <br /> &nbsp; <br /> <a href='#' class='remove_photo btn btn-primary' id='profile'>Remove Profile Photo</a></div>";		
			$pic_options .= "<div id='profile_pic' style='float:left;'><img src='images/profile_pics/".$profile_pic."' height='130' width='130'></div>";
			$pic_options .= "<div id='status' style='color:red'></div>";		
			$pic_options .= "</form>";			
			$pic_options .= "</div>";
			
		}
		$pic_options .= "&nbsp; <br/></div>";
		
		echo $pic_options;
		echo "<div id='file_size_warning' style='color:red; display:none;'>&nbsp; <br /><b>Please choose a file less than 4 MB</b></div>";
		echo "<div id='file_type_warning' style='color:red; display:none;'>&nbsp; <br /><b>Please choose a PNG or JPG file</b></div>";
		echo "<hr>";

?>
		<div id="add_photo_tools" style="margin-top:-15px;">			
		    <form id="myform" action="upload_pic.php?type=profile" method="post" enctype="multipart/form-data" style="position:absolute; top:-500px;">
		        <input type="file" id="profile_pic_choose" name="profile_pic_choose" >
				<input type="submit" value="Save Profile Pic1" id="profile_upload_button"><br />
			</form>
		</div>

<?php

		echo "<div style='float:left; width:100%; margin-top:10px; margin-left:5px; color:#760006'>";		
		echo "<h4>Video Resume (<i>optional</i>)</h4>";

	switch($video_url) {
		default:
			echo "<div style='margin-left:25px; margin-top:15px;'>";

				echo "<div style='float:left; width:100%'>";	
					echo "<div style='float:left; width:25%'>";
					echo "<a href='#' class='video_button btn btn-primary' id='watch_video'>View Video</a> <a href='#' class='btn btn-primary' id='close_video' style='display:none'>Close Video</a>";	
					echo "&nbsp; <br /> &nbsp; <br /> &nbsp; <br />";					
					echo "<a href='#' class='btn btn-primary remove_video' id='".$videoID."'>	Remove Video</a><br />";
					echo "</div>";
					echo "<div style='text-align:center; float:left; width:75%; margin-top:-20px;'>";
					 	echo "<b>Post different video:</br><br/>";
						echo "<a href='profile.php?page=video&type=vine'><img src='images/icon-vine.png' height='75px' width='75px'></a> <a href='profile.php?page=video&type=instagram'><img src='images/icon-instagram.png' height='75px' width='75px'></a> <a href='profile.php?page=video&type=youtube'><img src='images/icon-youtube.png' height='75px' width='75px'></a>";
					echo "</div>";
				echo "</div>";
							
				echo " &nbsp; <br />";
								
			echo "</div>";			
		break;
	
		case "NA":
			echo "<div style='margin-left:25px;'>";
				echo "Adding a video is simple.  Using Instagram, Vine, or Youtube you can easily embed a short video into your profile in one step! <br/>";				
				echo "<div style='width:100%; text-align:center'>";
				echo "<b>Choose a video type:</br><br/>";				
				echo "<a href='profile.php?page=video&type=vine'><img src='images/icon-vine.png' height='75px' width='75px'></a> <a href='profile.php?page=video&type=instagram'><img src='images/icon-instagram.png' height='75px' width='75px'></a> <a href='profile.php?page=video&type=youtube'><img src='images/icon-youtube.png' height='75px' width='75px'></a>";
/*
				echo "<h4>Need Some Inspiration?</h4>";
				echo "Check out the sample videos:  ";
				echo "<a href='#' class='play_sample_video' id='server'>SERVER</a> | ";		
				echo "<a href='#' class='play_sample_video' id='bartender'>BARTENDER</a> | ";		
				echo "<a href='#' class='play_sample_video' id='cook'>CHEF</a>";		
*/
				echo "</div>";
			echo "</div>";
		break;
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

				echo "<div id='button_holder'>";
					echo "<div style='float:left; margin-top:20px; width:95%; margin-bottom:15px; margin-left:5px; text-align:center; color:#760006'>";
					echo "<a href='#' class='save_continue btn btn-large btn-primary'>Complete Your Profile</a><br />";								
					echo "&nbsp; <br />";
					echo "<i>After clicking 'Complete Your Profile' you will be matched to jobs as they are entered on the site.</i><br/>";					
					echo "<i><b>You will receive an email notification when a new job that matches your profile is entered on the site.</b></i><br/>";					
					echo "<i>You can change your email settings at any time on the Edit Profile page</i><br/>";	
					echo "&nbsp; <br /></div>";				
				echo "</div>";	
				
				echo "<div id='loader_holder' style='display:none'>";
					echo "<b>LOADING...</b>";
				echo "</div>";								
							
				echo "</div>";	
}	

function profile_html_employee_video_mobile($video_url, $videoID, $type) {	
	$utilities = new Utilities;
	
		echo "<div class='main_box' style='margin-top:100px; width:98%;'>";				

		echo "<h2 style='text-align:center;'>Personal Video</h2>";

	switch($type) {
		default:
			if ($video_url == "NA") {
				echo "<div style='margin-left:5px; margin-top:10px; margin-left:3px; margin-right:3px;'>";
						echo "Adding a video is simple.  Using Instagram, Vine, or Youtube you can easily embed a short video into your profile in one step! <br/>";				
						echo "<div style='width:100%; margin-top:15px; text-align:center'>";
						echo "<b>Choose a video type:</br><br/>";				
						echo "<a href='profile.php?page=video&type=vine'><img src='images/icon-vine.png' height='75px' width='75px'></a> <a href='profile.php?page=video&type=instagram'><img src='images/icon-instagram.png' height='75px' width='75px'></a> <a href='profile.php?page=video&type=youtube'><img src='images/icon-youtube.png' height='75px' width='75px'></a>";
					echo "</div>";
			} else {
				echo "<div style='margin-left:5px; margin-top:15px;'>";
					echo "<div style='float:left; width:100%'>";	
						echo "<div style='float:left; width:100%; text-align:center; margin-bottom:20px;'>";		
							echo "<a href='#' class='btn btn-primary remove_video' id='".$videoID."'>	Remove Video</a><br />";
						echo "</div>";
						echo "&nbsp; <br />";
						echo "<div style='text-align:center; float:left; width:100%; margin-top:-20px;'>";
						 	echo "<b>Post different video:</br><br/>";
							echo "<a href='profile.php?page=video&type=vine'><img src='images/icon-vine.png' height='75px' width='75px'></a> <a href='profile.php?page=video&type=instagram'><img src='images/icon-instagram.png' height='75px' width='75px'></a> <a href='profile.php?page=video&type=youtube'><img src='images/icon-youtube.png' height='75px' width='75px'></a>";
						echo "</div>";
					echo "</div>";						
					echo " &nbsp; <br />";						
				echo "</div>";
			}			
		break;
		
		case "vine":
			echo "<div style='margin-left:5px;'>";
				echo "To embed a video from Vine, simple paste the URL below and click 'Save'<br />";
				echo "&nbsp; <br />";
				echo "<b>URL</b> <input type='text' id='video_url' style='width:98%;'><br />";
				echo "<div id='host_warning' class='warning' style='display:none'><font color='red'><b>This does not appear to be a valid Youtube, Instagram or Vine URL. Be sure to include the 'http://' or 'https://' as shown below.</b></font></div>";
				echo "<div id='type_warning' class='warning' style='display:none'><font color='red'><b>This does not appear to be a link to a video.  You may only link videos here.</b></font></div>";
				echo "<div id='private_warning' class='warning' style='display:none'><font color='red'><b>We are unable to read the data for this video, please make sure that your Instagram account, or Youtube video is set to 'Public'.</b></font></div>";
				echo "&nbsp; <br />";
				echo "<a href='#' class='btn btn-primary' id='save_video' style='margin-left:30px;'>Save Video</a><br />";	
				echo "&nbsp; <br />";
				echo "<div style='font-size:11px'>Video content must be owned by you.  Any inappropriate content will immediately removed and your account may be subject temporary or permanent deactivation.</div>";
				
				echo "<hr>";
				echo "<h4>How to get your Vine video URL</h4>";
				echo "<a href='images/3-circles-vine.png'><img src='images/3-circles-vine.png' height='200px'></a>";
				echo "&nbsp; <a href='images/share-post-vine.png'><img src='images/share-post-vine.png' height='200px'></a>";						
				echo "&nbsp; <a href='images/copy-link-vine.png'><img src='images/copy-link-vine.png' height='200px'></a>";			
			echo "</div>";			
		break;
		
		case "instagram":
			echo "<div style='margin-left:5px;'>";
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
				
				echo "<hr>";
				echo "<h4>How to get your Instagram video URL</h4>";
				echo "<a href='images/instrgram-3-circles.png'><img src='images/instrgram-3-circles.png' height='200px'></a>";
				echo "&nbsp; <a href='images/instagram-url-link.png' height='100px'><img src='images/instagram-url-link.png' height='200px''></a><br />";			
			echo "</div>";			
		break;
		
		case "youtube":
			echo "<div style='margin-left:5px;'>";
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
				echo "&nbsp; <br />";			
				echo "<h4>How to get your YouTube video URL</h4>";
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
	
	
function profile_html_employer_mobile($profileID, $edit, $first_name, $last_name, $company, $position, $website, $store_array, $photo_setting) {					
	
/*******************
*
*  Display the Profile Page based on usertype and userID, and who is viewing page
*
********************/
		$utilities = new Utilities;
		$store_types = $utilities->store_types;
								
		if ($website == "" || $website == "http://") {
			$website_text = "NA";
			$website_link = "";
		} else {
			$website_text = $website;
			$website_link = $website;			
		}
		
		if ($photo_setting == 'Y') {
			$photo_text = "<b>ON</b> - <i>You can view candidate photos and videos.</i>";
			$photo_yes = "selected";
			$photo_no = "";
		} else {
			$photo_text = "<b>OFF</b> - <i>Candidate photos and videos are not shown.</i>";		
			$photo_yes = "";
			$photo_no = "selected";
		}
				
/*******************
*
*  Profile HTML - Employer
*
********************/
?>	
	<div class='main_box' style='margin-top:100px; width:100%;'>
	
	<div  id='employer_profile' style='margin-left:10px; margin-right:5px; margin-bottom:15px; color:#760006'>
		<b>Name:</b> <? echo $first_name." ".$last_name ?><br />
		<b>Company:</b> <? echo $company ?><br />
		<b>Position:</b> <? echo $position ?><br />
		<b>Website:</b> <? echo $website_text ?><br />
		<b>Photo & Video Setting:</b> <? echo $photo_text ?><br />
		
		<div style='width:100%; margin-top:15px; margin-bottom:15px;'><a href='#' class='btn btn-primary' id='personal_details'>Edit Profile Details</a>	</div>								
		&nbsp; <br />
	</div>
	
	<div id='employer_profile_edit' style='display:none; margin-left:10px; margin-top:10px; color:#760006'>
		<div id='required_fields_warning' style='display:none; color:red'><b>PLEASE FILL OUT ALL REQUIRED FIELDS BELOW.</b></div>
		<table>
			<tr>
				<td>First Name: </td><td><input type='text' id='first_name' value='<? echo $first_name ?>'></td>
			</tr>
			<tr>
				<td>Last Name: </td><td><input type='text' id='last_name' value='<? echo $last_name ?>'></td>
			</tr>			
			<tr>
				<td>Company: </td><td><input type='text' id='company' value='<? echo $company ?>'></td>
			</tr>		
			<tr>
				<td>Position: </td><td><input type='text' id='position' value='<? echo $position ?>'></td>
			</tr>	
			<tr>
				<td>Website: </td><td><input type='text' id='website' value='<? echo $website_link ?>'> <i>(optional)</i></td>
			</tr>	
			<tr>
				<td>Employee Photos & Video Resumes: </td>
				<td><select id='photo_setting' style='background-color:#b76163'>
						<option value='Y' <? echo $photo_yes ?>>Viewable</option>
						<option value='N' <? echo $photo_no ?>>Hidden</option>
					</select>		
				</td>
			</tr>		
				
		</table>
		
			<div id='button_holder'>		
				<div style='float:left; margin-top:15px; margin-bottom:35px; width:100%'><a href='#' class='btn btn-large btn-primary' id='save_changes'>Save Changes</a> <a href='#' class='btn btn-large btn-primary' id='cancel_employer_edit'>Cancel</a></div>													
			</div>
	</div>	

<?php
//if this is user's profile, show list of all stores below
	if ($profileID == $_SESSION['userID']) {
?>		
			<table class="dark" style='width:100%'>
				<tr>
					<th width="60%" align="left">Store Name</th>
					<th width="20%">Jobs</th>
				</tr>	
			</table>		
<?php
		$job = new Job;
		if (count($store_array) == 0) {
			echo "No store locations added.</br>";
			echo "You must add a store location to create job.";
		} else {
		 	echo "<table class='dark' style='width:100%'>";
			foreach ($store_array as $row) {
				//get job count
				
				$open_job_count = count($job->get_job_list('open_jobs_by_store', $row['storeID']));
				$closed_job_count = count($job->get_job_list('expired_filled_jobs_by_store', $row['storeID']));				
				
				echo "<tr>";
				echo "<td width='60%'><a href='store.php?ID=".$row['storeID']."'>".$utilities->makeSafe($row['name'])."</a></td>";
				echo "<td width='20%' align='left'> &nbsp; ".$open_job_count." | ".$closed_job_count."</td>";
				echo "<tr>";
			}
			echo "</table>";
		}
?>
		<div class="add_store_form" style='margin-top:20px;'>
			<table class="dark" style='width:100%'>
				<tr>
					<th>Add Store/Location</th>
				</tr>	
			</table>		
		
			<div id="store_required_warning" style="display:none"><font color="red"><b>ALL REQUIRED FIELDS MUST BE COMPLETED.</b></font></div>
			<div id="store_zip_warning" style="display:none"><font color="red"><b>PLEASE ENTER A VALID ZIP CODE.</b></font></div>
			
			<table style='color:#760006; margin-top:5px; margin-left:5px; margin-right:7px; width:98%'>
				<tr>
					<td><b>Store Name: &nbsp; </b></td>
					<td><input type="text" name="store_name" id="store_name"></input><div id="name_warning" style="display:none"></div></td>
				</tr>
				<tr>
					<td><b>Website: (optional)&nbsp;</b></td> 
					<td><input type="text" name="store_website" id="store_website"></input></td>
				</tr>
					<td><b>Street Address: &nbsp;</b></td>
					<td><input type="text" name="address" id="address"></input></td>
				</tr>
				<tr>
					<td><b>Zip Code: &nbsp; </b></td>
					<td><input type="text" name="zip" id="zip"></input></td>
				</tr>
				<tr>
					<td><b>Business Type: &nbsp; </b></td>
					<td><select id="description" style='background-color:#b76163;'>
<?php
						foreach ($store_types as $row) {
							echo "<option value='".$row."'>".$row."</option>";
						}
?>					
					</select></td>
			</table>
	
			<div id='button_holder'>			
				<div style='float:left; margin-top:25px; margin-left:10px; width:100%'><a href='#' class='btn btn-large btn-primary' id='add_store'>Add Store/Location</a></div>									
			</div>
		</div>	
		&nbsp; <br />
		</div>
<?php		
	} 
}	

function profile_html_employee_mobile($profileID, $first_name, $last_name, $city, $state, $zip, $contact_phone, $contact_email, $skill_array, $past_employment_array, $education_array, $language_array, $profile_pic, $videoID, $video_url) {					
/******
*
*  Set Variables needed for profile
*
********/
		$member = new Member;
		$utilities = new Utilities;
	
		if ($contact_phone == "") {
			$contact_phone = "<i>No phone entered</i>";
		} else {
			$contact_phone = substr_replace($contact_phone, '-', 3, 0);
			$contact_phone = substr_replace($contact_phone, '-', 7, 0);			
		}			
		
		if (count($skill_array) > 0) {
			$employee_skills = array();
			foreach ($skill_array as $row) {
				array_push($employee_skills, $row['skill']);
			}
		}
		
		if ($profile_pic == "") {
			
			$photo_edit = "<div id='photo_buttons' style='float:right; width:100%; margin-bottom:10px; text-align:center;'><a href='profile.php?page=edit_options' class='btn btn-primary' id='profile'>Edit Profile</a> <a href='profile.php?page=edit_photo&type=profile' class='btn btn-primary' id='profile'>Add Photo</a><br />&nbsp; <br />";
		} else {
			$photo = "<img src='images/profile_pics/".$profile_pic."' height='100' width='100'>";						
			$photo_edit = "<div id='photo_buttons' style='float:right; width:100%; margin-bottom:10px; text-align:center;'><a href='profile.php?page=edit_options' class='btn btn-primary' id='profile'>Edit Profile</a>";
		}
		
		if ($videoID == "NA") {
			$photo_edit .= "&nbsp; <a href='profile.php?page=video' class='btn btn-primary' id='profile'>Add Video</a><br />";			
		} else {
			$photo_edit .= "&nbsp; <a href='#' class='video_button btn btn-primary' id='watch_video'>View Video</a> <a href='#' class='btn btn-primary' id='close_video' style='display:none'>Close Video</a><br />";			
		}
		
		$photo_edit .= "</div>";
				
/*******************
*
*  Profile HTML - Employee
*
********************/

?>	
	<div class='main_box' style='margin-top:70px; width:100%;'>

		<div style='float:left; width:100%'>
			<div id="name_holder" style="width:50%; padding-left:10px; margin-top:15px; float:left;">
				<b style='font-size:15pt; color: #760006;'><? echo $first_name ?> <? echo $last_name ?></b><br />
				<b><? echo $contact_phone ?></b><br />
				<? echo $contact_email ?><br />		
<?php
		$lang_count = count($language_array);
		$count = 1;
		if ($lang_count > 0) {
			echo "Languages:  ";
			foreach($language_array as $row) {
				echo $row['lang'];
				if ($count != $lang_count) {
					echo ", ";
				}
				$count++;
			}
		} 
?>
			</div>
			
			<div id="photo_holder" style="margin-top:5px; margin-right:5px; float:right;">
				<? echo $photo ?>
			</div>
		</div>					
					
<?php		
		echo "&nbsp; <br />";
		echo $photo_edit;
		
		echo "</div>";
		
		echo "<div style='width:35%; float:left; margin-top:0px; '>";
?>		
	
			</div>	
			</div>
			</div>
			
		</div>
		
	<div id='video_holder' class='menu_holder' style=' width:100%; display:none;'>
		<table class='dark'>
		<tr valign='middle'>
			<th valign='middle'>Personal Video</th>
		</tr>
		</table>
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
		
	<div id='profile_holder'>	
				
<?php
		
			foreach ($skill_array as $row) {
				if ($row['seeking'] == "Y") {			
					$seeking = "<b>Seeking</b>";
				} else {
					$seeking = "<b>Not Seeking</b>";						
				}
			
				$sub_skills = $member->get_user_data('sub_skills', $row['skillID']);
				if ($row['skill'] == "Manager") {				
					$icon = "<img src='images/main-manager.png' width='100'>";			
				} elseif ($row['skill'] == "Bartender") {
					$input_array = array($profileID, "bartender");
					$photo_gallery = $member->get_user_data('photo_gallery_bartender', $profileID);

					if (count($photo_gallery) > 0) {
					
						$count = 1;
						$icon = "<div id='bartender_photo_view' style='margin-top:5px; min-height:100px; float:left; text-align:center'><b style='color:#760006; margin-left:5px;'>Cocktail Photos</b><br /> &nbsp; <br /> ";
						foreach($photo_gallery as $photo) {
							$icon .= "<a href='images/gallery_pics/".$photo['photo']."'><img src='images/gallery_pics/".$photo['thumb']."' height='40' style='margin-left:3px; margin-bottom:8px;'></a>";
							if ($count % 2 == 0) {
								$icon .= "<br />";
							}
							$count++;
						}
						$icon .= "</div>";					
					} else {	
						$icon = "<img src='images/main-bar.png' height='100'>";										
						$icon .= "<br /><a href='profile.php?page=edit_photo&type=bar' class='btn btn-primary' id='bartender' style='margin-left:5px; margin-top:5px; margin-bottom:5px;'>Add Photo</a>";								
					}
					
					
				} elseif ($row['skill'] == "Kitchen") {
					$input_array = array($profileID, "kitchen");
					$photo_gallery = $member->get_user_data('photo_gallery_kitchen', $profileID);

					if (count($photo_gallery) > 0) {
					
						$count = 1;
						$icon = "<div id='kitchen_photo_view' style='margin-top:5px; min-height:150px; float:left; text-align:center'><b style='color:#760006; margin-left:10px;'>Culinary Photos</b><br /> &nbsp; <br /> ";
						foreach($photo_gallery as $photo) {
							$icon .= "<a href='images/gallery_pics/".$photo['photo']."' ><img src='images/gallery_pics/".$photo['thumb']."' height='40' style='margin-left:3px; margin-bottom:8px;'></a>";
							if ($count % 2 == 0) {
								$icon .= "<br />";
							}
							$count++;
						}
						$icon .= "</div>";					
					} else {	
						$icon = "<img src='images/main-cook.png' height='100'>";										
						$icon .= "<br /><a href='profile.php?page=edit_photo&type=kitchen' class='btn btn-primary' id='kitchen' style='margin-left:5px; margin-top:5px; margin-bottom:5px;'>Add Photo</a>";																
					}
				} elseif ($row['skill'] == "Server") {
					$icon = "<img src='images/main-server.png' height='100'>";										
				} elseif ($row['skill'] == "Host") {
					$icon = "<img src='images/main-host.png' height='100'>";										
				} elseif ($row['skill'] == "Bus") {
					$icon = "<img src='images/main-bus.png' height='100'>";																								
				} else {
					$margin = "0px";					
				}
				
				echo "<table class='dark' style='width:100%;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle' align='left'><span style='float: left;'>".$row['skill']." | ".$utilities->makeSafe($row['experience'])." yrs</span></th>";
				echo "<th align='right'><span style='float: right'>".$seeking."</span></th>";								
				echo "</tr>";
				echo "</table>";
				
				echo "<div style='float:left; margin-bottom:10px; width:100%'>";
				echo "<div style='float:left; width:30%; min-height:100px;'>";
				echo $icon;
				echo "</div>";
				echo "<div style='float:left; margin-top:10px; margin-left:3px; width:65%;'>";
				echo "<table cellspacing='10' class='holder_".$row['skill']."' style='color:#868686'>";
					$count = 1;
					if(count($sub_skills) > 0) {
						foreach ($sub_skills as $sub) {
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

				echo "<hr class='holder_".$row['skill']."' style='border: 0; height: 1px; background-image: -webkit-linear-gradient(left, rgba(0,0,0,0), rgba(0,0,0,0.75), rgba(0,0,0,0)); 
							background-image: -moz-linear-gradient(left, rgba(0,0,0,0), rgba(0,0,0,0.75), rgba(0,0,0,0)); 
							background-image: -ms-linear-gradient(left, rgba(0,0,0,0), rgba(0,0,0,0.75), rgba(0,0,0,0)); 
							background-image: -o-linear-gradient(left, rgba(0,0,0,0), rgba(0,0,0,0.75), rgba(0,0,0,0));'>
							<br />";

				echo "<div class='holder_".$row['skill']."' style='width:100%; margin-left:10px; margin-right:5px; margin-top:-5px;'>";
				echo "<i>".$utilities->mynl2br($utilities->makeSafe($row['description']))."</i><br />";
				echo "</div>";
				
				
				echo "</div>";
				echo "</div>";	
			}


	echo "<table class='dark' style='width:100%;'>";
	echo "<tr valign='middle'>";
	echo "<th valign='middle'>EMPLOYMENT HISTORY</th>";
	echo "</tr>";
	echo "</table>";

	if (count($past_employment_array) > 0) {			
		echo "<table cellpadding='12' style='margin-left:5px; margin-top:20px; table-layout:fixed; width:100%;'>";	
		foreach ($past_employment_array as $row) {
			echo "<tr>";
			echo "<td style='width:30%;'><a href='http://".$utilities->makeSafe($row['website'])."'><b>".$utilities->makeSafe($row['company'])."</b></a></td>";
			echo "<td style='width:20%;'>".$utilities->makeSafe($row['position'])."</td>";		
			echo "<td style='word-wrap: break-word;'>".$utilities->makeSafe($row['start_date'])." - ".$utilities->makeSafe($row['end_date'])."</td>";
		}
		echo "</table>";
	} else {
		echo "No Previous Employers Added <br />";
	}
?>
			
	</br>

<?php
	echo "<table class='dark' style='width:100%;'>";
	echo "<tr valign='middle'>";
	echo "<th valign='middle'>EDUCATION</th>";
	echo "</tr>";
	echo "</table>";

	if (count($education_array) > 0) {
		echo "<table cellpadding='12' style='margin-left:5px; margin-top:20px; table-layout:fixed; width:100%'>";	
		foreach ($education_array as $row) {
			echo "<tr>";
			echo "<td style='width:50%;'><b>".$utilities->makeSafe($row['school'])."</b></td>";				
			echo "<td style='word-wrap: break-word;'>".$utilities->makeSafe($row['degree'])."</td>";
			echo "</tr>";
		}
		echo "</table>";
	} else {
			echo "No education added. <br />";
	}
	echo "</div>";	
}	

function profile_html_employee_edit_options($first_name, $last_name, $skill_array) {
?>
	<div class='main_box' style='margin-top:110px; width:100%; text-align:center;'>
		<h2>Profile Edit Options</h1>

			<a href='profile.php?page=edit_photo&type=profile'>
				<div style='float:left; width:85%; margin-bottom:-5px;' class='bubble_inside'>
					<h2 style='display:inline'>Profile Photo</h2>
				</div>
			</a>			

			<a href='profile.php?page=video'>
				<div style='float:left; width:85%; margin-bottom:-5px;' class='bubble_inside'>
					<h2 style='display:inline'>Video Resume</h2>
				</div>
			</a>			

			<a href='profile.php?page=edit_details'>
				<div style='float:left; width:85%; margin-bottom:-5px;' class='bubble_inside'>
					<h2 style='display:inline'>General Details</h2>
				</div>	
			</a>

			<a href='profile.php?page=edit_skills'>
				<div style='float:left; width:85%; margin-bottom:-5px;' class='bubble_inside'>
					<h2 style='display:inline'>Skills & Experience</h2>
				</div>
			</a>
			
			<a href='profile.php?page=edit_employment'>
				<div style='float:left; width:85%; margin-bottom:-5px;' class='bubble_inside'>
					<h2 style='display:inline'>Past Employment</h2>
				</div>
			</a>
			
			<a href='profile.php?page=edit_education'>
				<div style='float:left; width:85%; margin-bottom:-5px;' class='bubble_inside'>
					<h2 style='display:inline'>Education</h2>
				</div>
			</a>
			
			<a href='profile.php?page=advanced'>
				<div style='float:left; width:85%; margin-bottom:-5px;' class='bubble_inside'>
					<h2 style='display:inline'>Email Settings</h2>
				</div>
			</a>									
<?php
		foreach ($skill_array as $row) {
			if ($row['skill'] == "Bartender") {
?>
			<a href='profile.php?page=edit_photo&type=bar'>
				<div style='float:left; width:85%; margin-bottom:-5px;' class='bubble_inside'>
					<h2 style='display:inline'>Cocktail Photos</h2>
				</div>
			</a>			
<?php				
			}
			
			if ($row['skill'] == "Kitchen") {
?>
			<a href='profile.php?page=edit_photo&type=kitchen'>
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

function profile_html_employee_edit_details_mobile($first_name, $last_name, $zip, $contact_phone, $language_array) {
		
		$Spanish = "";
		$French = "";
		$Italian = "";
		$German = "";
		$Japanese = "";
		$Chinese  = "";
		$Portuguese  = "";
		$Korean = "";
		$Russian = "";
		$Greek = "";
		$Hindi  = "";
		$Other = "";
		if (count($language_array) > 0) {
			foreach($language_array as $row) {
				$$row['lang'] = "checked";			
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
					<td><input type="text" name="new_first" id="first_employee" value="<? echo $first_name ?>"></input></td>
				</tr>
				<tr>
					<td><b>Last Name: &nbsp; </b></td>
					<td><input type="text" name="new_last" id="last_employee" value="<? echo $last_name ?>"></input><div id="name_warning" style="display:none"></div></td>
				</tr>
				<tr>
					<td><b>Zip Code: &nbsp; </b></td>
					<td><input type="text" name="new_zip" id="zip_employee" value="<? echo $zip ?>"></input></td>
					<tr><td colspan="2"><font color='gray'><i> &nbsp; You will be matched to jobs within 40 miles of your zip code.</i></font></td></tr>	
				</tr>
				<tr>
					<td><b>Contact Phone: &nbsp; </b></td>
					<td><input type="text" name="contact_phone" id="contact_phone" value="<? echo $contact_phone ?>"></input></td>
				</tr>		
				<tr><td colspan="2"><font color='gray'><i> &nbsp; Contact info will only be seen when you request an interview</i></font></td></tr>	
			</table>
			</div>

				<div id="languages form" class='main_box' style='color:#760006; width:98%'>
						<table style='margin-top:0px' cellspacing="12">
						<tr>
							<td><b>Multilingual?</b></td> 
							<td colspan='2'>Select any or none of the languages below</td>
						</tr>
						<tr class="lang_list" style="<? echo $display ?> style='margin-left:10px;">
							<td><label class='checkbox'>&nbsp; <input type="checkbox" class="languages" value="Spanish" data-toggle='checkbox' <? echo $Spanish ?>> Spanish</label></td>
							<td><label class='checkbox'>&nbsp; <input type="checkbox" class="languages" value="French" data-toggle='checkbox' <? echo $French ?>> French</label></td>
							<td><label class='checkbox'>&nbsp; <input type="checkbox" class="languages" value="Japanese" data-toggle='checkbox' <? echo $Japanese ?>> Japanese</label></td>				
						</tr>		
						<tr class="lang_list" style="<? echo $display ?> style='margin-left:10px;">	
							<td> <label class='checkbox'>&nbsp; <input type="checkbox" class="languages" value="Italian" data-toggle='checkbox' <? echo $Italian ?>> Italian</label></td>
							<td><label class='checkbox'>&nbsp; <input type="checkbox" class="languages" value="German" data-toggle='checkbox' <? echo $German ?>> German</label></td>
							<td><label class='checkbox'>&nbsp; <input type="checkbox" class="languages" value="Korean" data-toggle='checkbox' <? echo $Korean ?>> Korean</label></td>				
						</tr>	
						<tr class="lang_list" style="<? echo $display ?> style='margin-left:10px;">	
							<td><label class='checkbox'>&nbsp; <input type="checkbox" class="languages" value="Russian" data-toggle='checkbox' <? echo $Russian ?>> Russian</label></td>
							<td><label class='checkbox'>&nbsp; <input type="checkbox" class="languages" value="Hindi" data-toggle='checkbox' <? echo $Hindi ?>> Hindi</label></td>
							<td><label class='checkbox'>&nbsp; <input type="checkbox" class="languages" value="Other" data-toggle='checkbox' <? echo $Other ?>> Other</label></td>				
						</tr>																			
					</table>
				</div>	
				
<?php				
			
			echo "<div id='button_holder'>";
				echo "<div style='float:left; margin-top:25px; margin-bottom:15px; text-align:center; width:100%'><a href='#' class='save_continue btn btn-large btn-primary'>Save Changes</a></div>";								
			echo "</div>";
				
			echo "</div>";
}	

function profile_html_employee_photo_mobile($type, $profileID, $profile_pic) {
	
	echo "<div class='main_box' style='color:#760006; margin-top:110px; width:100%;'>";
		switch($type) {
			case "profile":
				echo "<h2 style='text-align:center'>Profile Photo</h2>";
				
				if ($profile_pic != "") {
					$photo = "<img src='images/profile_pics/".$profile_pic."' height='100' width='100'>";								
				} else {
					$photo = "<b>NO PHOTO</b>";
				}
				
				echo "<div style='width:100%; float:left;'>";
					echo "<div style='width:30%; float:left;  margin-left:10px; margin-top:10px;'>";
					echo $photo;
					echo "</div>";
					
					echo "<div style='width:65%; float:left; margin-bottom:30px; margin-top:25px; text-align:center;'>";
						echo "<div id='button_holder_photo'>";
							echo "<a href='#' class='add_photo btn btn-primary' id='profile'>Change Profile Photo</a> <br />";
							echo " &nbsp; <br />";
							echo " &nbsp; <br />";
							echo "<a href='#' class='remove_photo btn btn-primary' id='profile'>Remove Profile Photo</a>";
						echo "</div>";
						
						echo "<div id='loader' style='display:none;'>";
							echo "<h4>Loading....</h4>";
						echo "</div>";						
						
						echo "<div id='file_size_warning' style='display:none; color:red;'>";
							echo "<b>Please choose a file less than 4 MB</b>";
						echo "</div>";
						
						echo "<div id='file_type_warning' style='display:none; color:red;'>";
							echo "<b>Please choose a PNG of JPG file</b>";
						echo "</div>";																																																																																														
					
					echo "</div>";	
					
					echo "<div id='status' style='width:100%; color:red'>";				
					echo "</div>";				
	
					echo "<form id='profile_form_ie' action='upload_pic_ie.php?type=profile' method='post' enctype='multipart/form-data' style='float:left; padding-bottom:25px; padding-left:30px; margin-top:30px; display:none;'>";
					echo "<h2 style='text-align:center;'>Choose a File</h2>";
					echo "&nbsp; &nbsp; &nbsp; &nbsp; <input type='file' id='profile_pic_choose_ie' name='profile_pic_choose_ie' >";
					echo "<input type='submit' value='Save Profile Pic' id='profile_upload_button_ie'><br />";
					echo "<a href='#' class='upload_cancel' id='profile'>Cancel</a><br />";					
					echo "<div id='status' style='color:red'></div>";		
					echo "</form>";			
					echo "</div>";
						
?>
					<div id="add_photo_tools" style="margin-top:-15px;">			
					    <form id="myform" action="upload_pic.php?type=profile" method="post" enctype="multipart/form-data" style="position:absolute; top:-500px;">
					        <input type="file" id="profile_pic_choose" name="profile_pic_choose" >
							<input type="submit" value="Save Profile Pic1" id="profile_upload_button"><br />
						</form>
					</div>
<?php	
			
			break;	
			
			case "bar":
				$member = new Member;
				echo "<h2 style='text-align:center'>Cocktail Photos</h2>";
				echo "<div style='width:100%; margin:left:5px; text-align:center;'>";
				echo "You may upload up to 6 photos showing your bartending skills.<br />";
				echo "&nbsp; <br/>";
				
				$photo_gallery = $member->get_user_data('photo_gallery_bartender', $profileID);

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
						echo "<div id='button_holder_photo' style='width:100%; text-align:center; margin-bottom:15px; margin-top:15px; '><a href='#' class='add_photo btn btn-primary' id='bartender' style='margin-left:20px;'>Add Cocktail Photos</a></div>";

						echo "<div id='loader' style='display:none;'>";
							echo "<h4>Loading....</h4>";
						echo "</div>";						
						
						echo "<div id='file_size_warning' style='display:none; color:red;'>";
							echo "<b>Please choose a file less than 4 MB</b>";
						echo "</div>";
						
						echo "<div id='file_type_warning' style='display:none; color:red;'>";
							echo "<b>Please choose a PNG of JPG file</b>";
						echo "</div>";																																																																																														
																													
					}
					echo "</div>";
?>
				<form id="bar_form" action="upload_pic.php?type=bartender" method="post" enctype="multipart/form-data" style="position:absolute; top:-500px;">
				        <input type="file" id="bartender_pic_choose" name="bartender_pic_choose" >
						<input type="submit" value="Save Profile Pic" id="bartender_upload_button"><br />
				</form>
<?php

					echo "<div id='status' style='width:100%; color:red'>";				
					echo "</div>";				

					echo "<form id='bar_form_ie' action='upload_pic_ie.php?type=bartender' method='post' enctype='multipart/form-data' style='float:left; padding-top:30px; padding-left:10px; display:none'>";
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
				$member = new Member;
				echo "<h2 style='text-align:center'>Culinary Photos</h2>";
				echo "<div style='width:100%; margin:left:5px; text-align:center;'>";
				echo "You may upload up to 6 photos showing your culinary skills.<br />";
				echo "&nbsp; <br/>";
				
				$photo_gallery = $member->get_user_data('photo_gallery_kitchen', $profileID);

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
						echo "<div id='button_holder_photo' style='width:100%; text-align:center; margin-bottom:15px; margin-top:15px; '><a href='#' class='add_photo btn btn-primary' id='kitchen' style='margin-left:20px;'>Add Culinary Photos</a></div>";

						echo "<div id='loader' style='display:none;'>";
							echo "<h4>Loading....</h4>";
						echo "</div>";						
						
						echo "<div id='file_size_warning' style='display:none; color:red;'>";
							echo "<b>Please choose a file less than 4 MB</b>";
						echo "</div>";
						
						echo "<div id='file_type_warning' style='display:none; color:red;'>";
							echo "<b>Please choose a PNG of JPG file</b>";
						echo "</div>";																																																																																																																												
					}
					echo "</div>";
?>
					<form id="kitchen_form" action="upload_pic.php?type=kitchen" method="post" enctype="multipart/form-data" style="position:absolute; top:-500px;">
					        <input type="file" id="kitchen_pic_choose" name="kitchen_pic_choose" style="">
							<input type="submit" value="Save Profile Pic" id="kitchen_upload_button"><br />
					</form>		
<?php

					echo "<div id='status' style='width:100%; color:red'>";				
					echo "</div>";				

					echo "<form id='kitchen_form_ie' action='upload_pic_ie.php?type=bartender' method='post' enctype='multipart/form-data' style='float:left; padding-top:30px; padding-left:10px; display:none'>";
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

function profile_html_employer_view_employee_mobile($profileID, $first_name, $last_name, $contact_phone, $contact_email, $skill_array, $past_employment_array, $education_array, $language_array, $profile_pic, $secondary_contact, $personal_message, $question_array, $video, $highlight) {
/******
*
*  Set Variables needed for profile
*
********/
		$member = new Member;
		$utilities = new Utilities;
	
		if ($contact_phone == "") {
			$contact_phone = "<i>No phone entered</i>";
		} else {
			$contact_phone_pretty = substr_replace($contact_phone, '-', 3, 0);
			$contact_phone_pretty = substr_replace($contact_phone_pretty, '-', 7, 0);	
			$contact_phone = "<a href='tel:".$contact_phone."'>".$contact_phone_pretty."</a>";		
		}			
		
		if (count($skill_array) > 0) {
			$employee_skills = array();
			foreach ($skill_array as $row) {
				array_push($employee_skills, $row['skill']);
			}
		}
		
		if ($profile_pic == "" || $_SESSION['photo_setting'] == 'N') {
			$photo = "";
		} else {
			$photo = "<img src='images/profile_pics/".$profile_pic."' height='100' width='100'>";						
		}

		$menu_bar = "<div style='float:left; width:100%; margin-bottom:10px; text-align:center;'>";

		$menu_count = 0;
		if ($video != "N" && $_SESSION['photo_setting'] == 'Y') {
			$menu_bar .= "<a href='#' class='btn btn-primary' id='watch_video'>Video Resume</a> <a href='#' class='btn btn-primary' id='close_video' style='display:none'>Close Video</a><br />&nbsp; <br /> ";
			//$menu_count++;				
		}
		
		if (count($question_array) > 0) {
			$menu_bar .= "<a href='#' class='btn btn-primary' id='view_questions'>Questions</a> ";				
			$menu_count++;				
		}		
		
		if ($personal_message != "") {
			$menu_bar .= "<a href='#' class='btn btn-primary' id='view_message'>Message</a> ";				
			$menu_count++;				
		}
		
		if ($menu_count > 0) {
			$menu_bar .= "<a href='#' class='btn btn-primary' id='view_profile'>Profile</a> ";				
			$menu_count++;				
		}			
		
		$menu_bar .= "</div>";
		
		if ($highlight == "Y") {
			$highlight_notice = "<a href='#' id='unhighlight'><font color='#FFD700' size='5px'><b>&#9733; </b></font>";
		} else {
			$highlight_notice = "<a href='#' id='highlight'><font size='5px'><b>&#9734; </b></font>";			
		}		

?>	
	<div class='main_box' style='margin-top:70px; width:100%;'>

		<div style='float:left; width:100%'>
			<div id="name_holder" style="width:50%; padding-left:10px; margin-top:15px; float:left;">
				<? echo $highlight_notice ?> <b style='font-size:15pt; color: #760006;'><? echo $first_name ?> <? echo $last_name ?></b></a><br />
				<b><? echo $contact_phone ?></b><br />
				<? echo $contact_email ?><br />		
<?php
		$lang_count = count($language_array);
		$count = 1;
		if ($lang_count > 0) {
			echo "Languages:  ";
			foreach($language_array as $row) {
				echo $row['lang'];
				if ($count != $lang_count) {
					echo ", ";
				}
				$count++;
			}
		} 

		if ($secondary_contact != "") {
			echo "<br /><b>Secondary Contact: </b>".$secondary_contact;	
		}		
?>
			</div>
			
			<div id="photo_holder" style="margin-top:5px; margin-right:5px; float:right;">
				<? echo $photo ?>
			</div>
		</div>					
					
<?php		
		echo "&nbsp; <br />";
		echo $menu_bar;
		echo "</div>";
		
		echo "<div class='main_box' style='width:35%; float:left; margin-top:0px; '>";
?>		
			</div>	
			</div>
			
		</div>
		
	<div id='message_holder' class='menu_holder' style=' width:100%; display:none;'>
		<table class='dark' style='width:100%;'>
			<tr valign='middle'>
			<th valign='middle'>Personal Message</th>
			</tr>
		</table>
		<div style='margin-left:5px; margin-top:5px; width:98%;'>
			<? echo $personal_message; ?>
		</div>	
	</div>
		
	<div id='question_holder' class='menu_holder' style=' width:100%; display:none;'>
		<table class='dark' style='width:100%;'>
			<tr valign='middle'>
			<th valign='middle'>Pre-Interview Answers</th>
			</tr>
		</table>
<?php
		if (count($question_array) > 0) {
			$member = new Member;
			foreach ($question_array as $row) {
				//get answer
				$answer_array = $member->get_job_answers($row['questionID'], $profileID);
				foreach ($answer_array as $answer) {
					$question_answer = $utilities->makeSafe($answer['answer']);
				}
				echo "<div style='color:gray; margin-top:3px; margin-left:10px; float:left; width:98%'>";	
				echo "<i>".$utilities->makeSafe($row['question'])."</i><br />";
				echo "</div><br />";
				echo "<div style='margin-top:5px; margin-left:10px; float:left; width:98%'>";	
				echo $question_answer;
				echo "</div>";
			}
		}	
?>
	</div>

	<div id='video_holder' class='menu_holder' style=' width:100%; display:none;'>
		<table class='dark' style='width:100%;'>
			<tr valign='middle'>
			<th valign='middle'>Personal Video</th>
			</tr>
		</table>
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

	<div class='main_box' id='profile_holder'>	
<?php
		if (count($skill_array) > 0) {
			foreach ($skill_array as $row) {
			
				$sub_skills = $member->get_user_data('sub_skills', $row['skillID']);
				if ($row['skill'] == "Manager") {				
					$icon = "<img src='images/main-manager.png' width='100'>";			
				} elseif ($row['skill'] == "Bartender") {
					$input_array = array($profileID, "bartender");
					$photo_gallery = $member->get_user_data('photo_gallery_bartender', $profileID);
					if (count($photo_gallery) > 0 && $_SESSION['photo_setting'] == 'Y') {
					
						$count = 1;
						$icon = "<div id='bartender_photo_view' style='margin-top:5px; min-height:100px; float:left; text-align:center'><b style='color:#760006; margin-left:5px;'>Cocktail Photos</b><br /> &nbsp; <br /> ";
						foreach($photo_gallery as $photo) {
							$icon .= "<a href='images/gallery_pics/".$photo['photo']."'><img src='images/gallery_pics/".$photo['thumb']."' height='40' style='margin-left:3px; margin-bottom:8px;'></a>";
							if ($count % 2 == 0) {
								$icon .= "<br />";
							}
							$count++;
						}						
						$icon .= "</div>";
					} else {
						$icon = "<img src='images/main-bar.png' width='100'>";									
					}
					
					
				} elseif ($row['skill'] == "Kitchen") {
					$input_array = array($profileID, "kitchen");
					$photo_gallery = $member->get_user_data('photo_gallery_kitchen', $profileID);

					if (count($photo_gallery) > 0 && $_SESSION['photo_setting'] == 'Y') {
					
						$count = 1;
						$icon = "<div id='kitchen_photo_view' style='margin-top:5px; min-height:150px; float:left; text-align:center'><b style='color:#760006; margin-left:10px;'>Culinary Photos</b><br /> &nbsp; <br /> ";
						foreach($photo_gallery as $photo) {
							$icon .= "<a href='images/gallery_pics/".$photo['photo']."' ><img src='images/gallery_pics/".$photo['thumb']."' height='40' style='margin-left:3px; margin-bottom:8px;'></a>";
							if ($count % 2 == 0) {
								$icon .= "<br />";
							}
							$count++;
						}
						$icon .= "</div>";						
					} else {
						$icon = "<img src='images/main-cook.png' width='100'>";									
					}
					
				} elseif ($row['skill'] == "Server") {
					$icon = "<img src='images/main-server.png' height='100'>";										
				} elseif ($row['skill'] == "Host") {
					$icon = "<img src='images/main-host.png' height='100'>";										
				} elseif ($row['skill'] == "Bus") {
					$icon = "<img src='images/main-bus.png' height='100'>";																								
				} else {
					$margin = "0px";					
				}
				
				echo "<table class='dark' style='width:100%;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle'><span style='float: left;'>".$row['skill']." | ".$utilities->makeSafe($row['experience'])." yrs</span></th>";
				echo "</tr>";
				echo "</table>";
				
				echo "<div style='float:left; margin-bottom:10px; width:100%'>";
				echo "<div style='float:left; width:30%; min-height:100px;'>";
				echo $icon;
				echo "</div>";
				echo "<div style='float:left; margin-top:10px; margin-left:3px; width:65%;'>";
				echo "<table cellspacing='10' class='holder_".$row['skill']."' style='color:#868686; width:98%;'>";
					$count = 1;
					if(count($sub_skills) > 0) {
						foreach ($sub_skills as $sub) {
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

				echo "<hr class='holder_".$row['skill']."' style='border: 0; height: 1px; background-image: -webkit-linear-gradient(left, rgba(0,0,0,0), rgba(0,0,0,0.75), rgba(0,0,0,0)); 
							background-image: -moz-linear-gradient(left, rgba(0,0,0,0), rgba(0,0,0,0.75), rgba(0,0,0,0)); 
							background-image: -ms-linear-gradient(left, rgba(0,0,0,0), rgba(0,0,0,0.75), rgba(0,0,0,0)); 
							background-image: -o-linear-gradient(left, rgba(0,0,0,0), rgba(0,0,0,0.75), rgba(0,0,0,0));'>
							<br />";

				echo "<div class='holder_".$row['skill']."' style='width:100%; margin-left:10px; margin-right:5px; margin-top:-5px;'>";
				echo "<i>".$utilities->mynl2br($utilities->makeSafe($row['description']))."</i><br />";
				echo "</div>";
				
				
				echo "</div>";
				echo "</div>";	
			}
		}
		
	echo "<table class='dark' style='width:100%; margin-top:10px;'>";
	echo "<tr valign='middle'>";
	echo "<th valign='middle'>EMPLOYMENT HISTORY</th>";
	echo "</tr>";
	echo "</table>";

	if (count($past_employment_array) > 0) {			
		echo "<table cellpadding='12' style='margin-left:5px; margin-top:20px; width:98%; table-layout:fixed;'>";	
		foreach ($past_employment_array as $row) {
			echo "<tr>";
			echo "<td style='width:30%'><a href='http://".$utilities->makeSafe($row['website'])."'><b>".$utilities->makeSafe($row['company'])."</b></a></td>";
			echo "<td style='width:20%'>".$utilities->makeSafe($row['position'])."</td>";		
			echo "<td style='word-wrap: break-word;'>".$utilities->makeSafe($row['start_date'])." - ".$utilities->makeSafe($row['end_date'])."</td>";
		}
		echo "</table>";
	} else {
		echo "No Previous Employers Added <br />";
	}
?>
			
	</br>

<?php
	echo "<table class='dark' style='width:100%;'>";
	echo "<tr valign='middle'>";
	echo "<th valign='middle'>EDUCATION</th>";
	echo "</tr>";
	echo "</table>";

	if (count($education_array) > 0) {
		echo "<table cellpadding='12' style='margin-left:5px; margin-top:20px; width:98%; table-layout:fixed;'>";	
		foreach ($education_array as $row) {
			echo "<tr>";
			echo "<td style='width:50%'><b>".$utilities->makeSafe($row['school'])."</b></td>";				
			echo "<td style='word-wrap: break-word;'>".$utilities->makeSafe($row['degree'])."</td>";
			echo "</tr>";
		}
		echo "</table>";
	} else {
			echo "No education added. <br />";
	}	
	echo "</div>";
	
	echo "&nbsp; &nbsp; <a href='#' class='inappropriate'>Report Inappropriate Content</a>";		

	echo "<div id='inappropriate_form' style='display:none; width:98%; margin-top:-25px;'>";
		echo "&nbsp; <br />";
		echo "Click 'REPORT' below if this profile contains offensive or inappropriate content.<br />";
		echo "&nbsp; <br />";
		echo "An admin will be notified immediately.<br />";
		echo "<a href='#' class='report'>REPORT</a> &nbsp; &nbsp; <a href='#' class='cancel_report'>Cancel</a>";
	echo "</div>";		
	
	echo "</div>";
	
}	

function profile_html_employee_advanced_mobile($first_name, $last_name, $email_setting) {	
?>	
	<div class='main_box' id="details_edit_employee" style='color:#760006; margin-top:110px; width:100%; margin-left:5px; width:98%;'>
	<h2 style='text-align:center'>Advanced Settings</h2>
<?php

	$news_email_setting = $email_setting[1];
	switch ($email_setting[0]) {
		case "Y":
			$match_email = "Standard";
			$match_text = "<i>This option send you emails whenever you are matched to a job that matches your skills, giving the best opportunity for a quick response</i><br />";
		break;
		
		case "Weekly":
			$match_email = "Weekly";
			$match_text = "This option send you emails with matches only once per week.  The average response time to job posts is less than 1 hour.<br />";
			$match_text = "This setting may limit your chances of receiving and interview.<br />";
		break;
		
		case "N":
			$match_email = "No Emails";
			$match_text = "With this option you will receive not notification of jobs that match your profile.<br />";
			$match_text = "Several new jobs are added each week and response times are within hours, so you may miss out on several opportunities.<br />";
		break;		
		
		case "spam":
			$match_email = "spam";
		break;
	}
	
	$match_text .= "<div style='font-size:11px'><b>Note:</b>  If you are getting matches of a job type that you don't want, change that 'Skill' to 'Not Seeking' on your profile, and you will no longer be matches to that job type.</div><br />";
	
	echo "<div id='email_visible' style='margin-bottom:10px; width:100%;'>";	
	echo "<b>Job Email Notifications: </b><br />";
		
	if ($match_email != "spam") {	
		echo "Your current job match setting is:  <b>".$match_email."</b><br />";
		echo "<div style='margin-top:5px;'>".$match_text."</div>";
		echo "&nbsp; <br />";
		echo "<div style='float:left; width:100%; margin-bottom:15px;'><a href='#' class='save_continue btn btn-primary' id='notice_change'>Edit Notification Email Setting</a></div>";										
		
		echo "<div id='notice_hidden' style='display:none'>";
		echo "Please select an option to change your settings: <select style='background-color:#b76163' id='email_setting'>";
			echo "<option value='Y'>Standard</option>";
			echo "<option value='N'>No Match Notification Emails</option>";
		echo "</select>";
		echo "<br /> &nbsp; <br />";
		echo "<div style='float:left; margin-top:25px; width:100%; margin-bottom:15px;'><a href='#' class='btn btn-primary' id='save_notice_change'>Save Email Setting</a> <a href='#' class='btn btn-primary' id='notice_cancel'>Cancel</a></div>";										
		echo "</div>";		
			
		echo "</div>";	
	} else {
		echo "Our server records indicate that you reported an email from our site as 'Spam'.  According to anti-spam laws we cannot send any emails to your email account from our servers, as they will degrade the reputation of our mail server.<br />";
		echo "If you believe this is an error, please contact admin@servebartendcook.com.  Note:  Marking an email as 'Junk' reports that email as spam to the server";
	}
	echo "</div>";
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

?>
