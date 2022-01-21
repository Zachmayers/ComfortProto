<?php
function profile_html_employer_mobile($member_data, $employer_data) {					
		$utilities = new Utilities;
		$store_types = $utilities->store_types;
		
		$general_data = $employer_data['general'];
		$store_data = $employer_data['stores_jobs'];
		$store_array = $store_data['stores'];
		$open_job_array = $store_data['open_jobs'];
		$expired_job_array = $store_data['expired_jobs'];

		if ($general_data['website'] == "" || $general_data['website'] == "http://") {
			$website_text = "NA";
			$website_link = "";
		} else {
			$website_text = $general_data['website'];
			$website_link = $general_data['website'];			
		}
										
		if ($member_data['photo_setting'] == 'Y') {
			$photo_text = "<b>ON</b> - <i>You can view candidate photos.</i>";
			$photo_yes = "selected";
			$photo_no = "";
		} else {
			$photo_text = "<b>OFF</b> - <i>Candidate photos are not shown.</i>";		
			$photo_yes = "";
			$photo_no = "selected";
		}
				
/*******************
*
*  Profile HTML - Employer
*
********************/
?>	
	<div class='main_box' style='margin-top:80px; width:100%;'>
	
	<div  id='employer_profile' style='margin-left:10px; margin-right:5px; margin-bottom:15px; color:#760006'>
		<b>Name:</b> <? echo $member_data['firstname']." ".$member_data['lastname'] ?><br />
<?php
		if ($general_data['position'] != '') {
?>			
			<b>Position:</b> <? echo $general_data['position'] ?><br />
<?php
		}
?>
		<b>Photo Setting:</b> <? echo $photo_text ?><br />
		
		<div style='width:100%; margin-top:15px; margin-bottom:15px; text-align:center; '><a href='#' class='btn btn-primary' id='personal_details'>Edit Profile Details</a>	</div>								
		&nbsp; <br />
	</div>
	
	<div id='employer_profile_edit' style='display:none; margin-left:10px; margin-top:10px; color:#760006'>
		<div id='required_fields_warning' style='display:none; color:red'><b>PLEASE FILL OUT ALL REQUIRED FIELDS BELOW.</b></div>
		<table>
			<tr>
				<td>First Name: </td><td><input type='text' id='first_name' value='<? echo $member_data['firstname'] ?>'></td>
			</tr>
			<tr>
				<td>Last Name: </td><td><input type='text' id='last_name' value='<? echo $member_data['lastname'] ?>'></td>
			</tr>	
<?php
			if ($general_data['position'] != '') {
?>					
			<tr>
				<td>Position: </td><td><input type='text' id='position' value='<? echo $general_data['position']  ?>'></td>
			</tr>
<?php
			} else {
				echo "<input type='hidden' id='position' value=''>";
			}
?>
			<tr>
				<td>Employee Photos: </td>
				<td><select id='photo_setting' style='background-color:#b76163'>
						<option value='Y' <? echo $photo_yes ?>>Viewable</option>
						<option value='N' <? echo $photo_no ?>>Hidden</option>
					</select>		
				</td>
			</tr>		
				
		</table>
		
			<div id='button_holder'>		
				<div style='float:left; margin-top:15px; margin-bottom:35px; text-align:center; width:100%'><a href='#' class='btn btn-large btn-primary' id='save_changes'>Save Changes</a> <a href='#' class='btn btn-large btn-primary' id='cancel_employer_edit'>Cancel</a></div>													
			</div>
	</div>	

			<table class="dark store_details" style='width:100%; margin-top:-25px;'>
				<tr>
					<th align="left">Your Stores</th>
				</tr>	
			</table>		
<?php
		if (count($store_array) == 0) {
			echo "Add a Location</br>";
		} else {
			foreach ($store_array as $row) {
				//SET VARIABLES
				
				if ($row['website'] == "") {
					$website = "<i>None Entered</i>";
				} else {
					$website = $row['website'];					
				}
				
				if ($row['facebook'] == "") {
					$facebook = "<i>None Entered</i>";
				} else {
					$facebook = $row['facebook'];					
				}
				
				if ($row['twitter'] == "") {
					$twitter = "<i>None Entered</i>";
				} else {
					$twitter = $row['twitter'];					
				}											

				echo "<div class='store_details' style='float:left; width:100%; margin-left:3px; margin-right:2px; margin-bottom:10px;'>";
						echo "<table cellspacing='4' style='color:#760006'>";	
						echo "<tr>";				
							echo "<td><b>Store Name:  </b></td><td><i>".$row['name']."</i></td>";
						echo "</tr>";

						echo "<tr>";				
							echo "<td><b>Address: </b></td><td>".$row['address']."</td>";
						echo "</tr>";				
						echo "<tr>";				
							echo "<td><b>Zip Code: </b></td><td>".$row['zip']."</td>";
						echo "</tr>";				
						echo "<tr>";			
							echo "<td><b>Type: </b></td><td>".$row['description']."</td>";
						echo "</tr>";				

						echo "<tr>";				
							echo "<td ><b>Open Jobs:  </b></td><td>".$open_job_array[$row['storeID']]."</td>";
						echo "</tr>";
						echo "<tr>";				
							echo "<td><b>Website: </b></td><td>".$website."</td>";
						echo "</tr>";				

						echo "<tr>";				
							echo "<td><b>Facebook: </b></td><td>".$facebook."</td>";
						echo "</tr>";				

						echo "<tr>";				
							echo "<td><b>Twitter: </b></td><td>".$twitter."</td>";
						echo "</tr>";				

					echo "</table>";				

					
					echo "<div style='float:left; width:100%; text-align:center; margin-top:10px; margin-bottom:15px;'>";
						echo "<a href='#' class='btn btn-primary edit_store_show' id='".$row['storeID']."'>Edit Store Details</a>  <a href='job.php?ID=new_job&storeID=".$row['storeID']."' class='btn btn-primary' id='add_store'>Post Job</a>";									
					echo "</div>";
				echo "</div>";
			}
		}

?>
			<hr>
			<div id='button_holder' class='store_details'>			
				<div style='float:left; margin-top:15px; text-align:center; width:100%'><a href='employer.php?page=new_store' class='btn btn-large btn-primary'>Add Store/Location</a></div>									
			</div>
		&nbsp; <br />
		</div>
		</div>
	</div>
	
		<div id="edit_store_form" style='float:left; margin-top:10px; display:none'>	
			<div id="store_required_warning" style="display:none"><font color="red"><b>ALL REQUIRED FIELDS MUST BE COMPLETED.</b></font></div>
			<div id="store_zip_warning" style="display:none"><font color="red"><b>PLEASE ENTER A VALID ZIP CODE.</b></font></div>

					<h3 style='text-align:center; color:#760006;'>Required Information</h3>
					<table style='color:#760006; width:100%'>
						<tr>
							<td><b>Store Name: &nbsp; </b></td>
							<td><input type="text" id="store_name"></input></div></td>
						</tr>
							<td><b>Street Address: &nbsp;</b></td>
							<td><input type="text" id="address"></input></td>
						</tr>
						<tr>
							<td><b>Zip Code: &nbsp; </b></td>
							<td><input type="text" id="zip"></input></td>
						</tr>
						<tr>
							<td><b>Business Type: &nbsp; </b></td>
							<td>
								<select id="description" style='background-color:#b76163;'>
									<option value='0'>--Location Type--</option>																	
<?php
									foreach ($store_types as $type) {
										$selected = "";						
										if ($row == $row['description']) {
											$selected = "selected";
										} 
										echo "<option value='".$type."' ".$selected." >".$type."</option>";
									}
?>					
								</select>
							</td>
						</tr>
					</table>

					<h3 style='text-align:center; color:#760006; margin-top:10px;'>Optional Information</h3>
					<table style='color:#760006; width:100%'>					
						<tr>
							<td><b>Website: &nbsp;</b></td> 
							<td><input type="text" id="website"></input></td>
						</tr>
						<tr>
							<td><b>Facebook: &nbsp;</b></td> 
							<td><input type="text" id="facebook"></input></td>
						</tr>
						<tr>
							<td><b>Twitter: &nbsp;</b></td> 
							<td><input type="text" id="twitter"></input></td>
						</tr>			
						
						<input type="hidden" id="storeID" value=''>	
					</table>

				<div style='float:left; margin-top:10px; margin-bottom:25px; text-align:center; width:100%'><a href='#' class='btn btn-primary' id='edit_store' >Save Changes</a> <a href='#' class='btn btn-primary' id='cancel_store_edit'>Cancel</a></div>									
			</div>
		</div>		
		
<?php		
}

function new_store_html_mobile($new_user) {
		$utilities = new Utilities;
		$store_types = $utilities->store_types;
?>
	<div class='main_box' style='margin-top:70px; width:100%;'>

		<div class="add_store_form">
			<table class="dark" style='width:100%'>
				<tr>
					<th>Add Store/Location</th>
				</tr>	
			</table>		
		
			<div id="store_required_warning" style="display:none"><font color="red"><b>ALL REQUIRED FIELDS MUST BE COMPLETED.</b></font></div>
			<div id="store_zip_warning" style="display:none"><font color="red"><b>PLEASE ENTER A VALID ZIP CODE.</b></font></div>
			
					<h3 style='text-align:center; color:#760006;'>Required Information</h3>
					<table style='color:#760006; width:100%'>
						<tr>
							<td><b>Store Name: &nbsp; </b></td>
							<td><input type="text" id="pac-input"></input></div></td>
						</tr>
							<td><b>Street Address: &nbsp;</b></td>
							<td><input type="text" id="address" value=""></input></td>
						</tr>
						<tr>
							<td><b>Zip Code: &nbsp; </b></td>
							<td><input type="text" id="zip"></input></td>
						</tr>
<?php
						if ($new_user == "Y") {
?>
						<tr>
							<td><b>Your Title: </b></td>
							<td><select id="position" style='background-color:#b76163;'>
									<option value='Manager'>Manager</option>
									<option value='General Manager'>General Manager</option>
									<option value='Assistant Manager'>Assistant Manager</option>
									<option value='Kitchen Manager'>Kitchen Manager</option>
									<option value='Bar Manager'>Bar Manager</option>
									<option value='Owner'>Owner</option>
									<option value='HR'>HR</option>
									<option value='Other'>Other</option>
							</select></td>
						</tr>	
<?php							
						}
?>
						<tr>
							<td>
								<b>Business Type: &nbsp; </b>
							</td>
							<td>
								<select id="description" style='background-color:#b76163;'>
									<option value='0'>--Location Type--</option>								
									
<?php
								foreach ($store_types as $type) {
									echo "<option value='".$type."'>".$type."</option>";
								}
?>					
								</select>
							</td>
						</tr>
					</table>

					<h3 style='text-align:center; margin-top:5px; color:#760006;'>Optional Information</h3>
					<table style='color:#760006; width:100%'>					
						<tr>
							<td><b>Website: &nbsp;</b></td> 
							<td><input type="text" id="website"></input></td>
						</tr>
						<tr>
							<td><b>Facebook: &nbsp;</b></td> 
							<td><input type="text" id="facebook"></input></td>
						</tr>
						<tr>
							<td><b>Twitter: &nbsp;</b></td> 
							<td><input type="text" id="twitter"></input></td>
						</tr>			
						
						<input type="hidden" id="name" value=''>	
					</table>
					
						<div id='button_holder' style='margin-top:20px; text-align:center;'>			
							<a href='#' class='btn btn-large btn-primary add_store' id='post'>Save & Post a Job</a> <a href='#' class='btn btn-large btn-primary add_store' id='home'>Save & Return Home</a>
						</div>
						&nbsp; <br />
						&nbsp; <br />																								
		</div>	
		</div>
<?php	
}

function employer_interviews_html_mobile($interview_list) {
	echo "<div class='main_box' style='margin-top:80px; width:100%;'>";

	echo	"<h3>Upcoming Interviews</h3>";
	
	echo "<h4>Which interviews would you like to see?</h4>";
	echo "<select style='font-size:16px'>";
	echo "<option>See All Interviews</option>";
	echo "<option>Job 1</option>";
	echo "<option>Job 2</option>";
	echo "<option>Job 3</option>";
	echo "<option>Job 4</option>";
	echo "</select>";
	echo "<br><br>";
	echo "<a href='#'><h4>See Past Interviews*</h4></a>";
	echo "<span style='color:#760006'><i>Note: Interview records are not official, nor are they to be used for legal purposes. <br>Please see <a href='http://servebartendcook.com/index.php?page=TOS'>Terms of Use</a> for more information.</i></span>";

	echo "<table class='dark' id='candidates' style='width:620px; margin-top:20px'>";
	echo "<thead><tr>";
	echo "<th width='30%'>Candidate</th>";
	echo "<th width='20%'>Position</th>";
	echo "<th width='30%'>Interview Date</th>";
	echo "<th width='20%'>Status*</th></tr>";
	echo "</thead>";
	
	if(count($interview_list) > 0) {		
		foreach($interview_list as $row) {
			echo "<tr>";
				echo "<td width='30%'>".$row['firstname']." ".$row['lastname']."</td>";
				echo "<td width='20%'>".$row['title']." (<i>".$row['name']."</i>)</td>";
				echo "<td width='30%'>".$row['interview_date']."</td>";
				echo "<td width='20%'>".$row['status']."</td>";	
			echo "</tr>";			
		}
	} else {
		echo "<tr><td colspan='6'>No Current Interviews Scheduled</td></tr>";
	}
	echo "</table>";
	echo "</div>";
}

function profile_html_type_switch_mobile() {	
	
	echo "<div class='main_box' style='margin-top:70px; '>";				
	
		echo "<div style='width:100%; margin-left:2px; margin-right:2px;'>";

		echo "&nbsp; <br />";
		echo "You have signed up for an Employer account.  This account type is for managers posting open jobs.<br />";
		echo "&nbsp; <br />";
		echo "If you are a Job Seeker wish to create a profile to apply to open jobs, you can switch your account type by filling out the info below.";	
		echo "&nbsp; <br />";

		echo "<div id='employee_zip_warning' class='warning' style='display:none; width:100%; text-align:center;'><font color='red'><b>Please use a valid zip code</b></font></div>";
		echo	"<div id='age_warning' class='warning' style='display:none; width:100%; text-align:center;'><font color='red'><b>You must be over 18 to use this site</b></font></div>";
		echo "<div id='other_warning' class='warning' style='display:none; width:100%; text-align:center;'><font color='red'><b>There was a problem processing your request, please contact admin@servebartendcook.com</b></font></div><br />";
		echo "<div id='employee_invalid_zip_warning' class='warning' style='display:none; width:100%; text-align:center;'><font color='red'><b>The zip code entered is either invalid or a military zip code</b></font></div>";

		echo "<b>Zip Code:</b> <input type='text' id='zip' name='zip' size='16'  /><br />";       
		echo "<input type='checkbox' id='age' value='18'>";
		echo "<div style='font-size: 11px;'><b>I certify that I am at least 18 years of age.</b></div>";
		echo "<div style='float:left; margin-top:20px; margin-bottom:20px; width:100%'><a href='#' class='btn btn-large btn-primary' id='change_account_type'>Change Account Type</a></div>";					
	
		echo "</div>";
	echo "</div>";
}
?>