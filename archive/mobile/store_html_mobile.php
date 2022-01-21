<?php
function store_owner_html_mobile($store_data, $store_types) {					
	

//==================================
//!  First break master arrays into trait arrays
//
//  Modify any data for presentation
//==================================

		$store_array 					= $store_data['general'];
		$open_jobs 					= $store_data['open_jobs'];
		$expired_jobs					= $store_data['expired_jobs']; 
						
echo 	"<div class='main_box' style='margin-top:70px; width:100%;'>";
?>
		<div style="float:left; width:100%;">
		
		<div class='store_details_holder'>
			<table class="dark">
				<tr>
					<td>LOCATION NAME:</td>
					<td><? echo $store_array['name'] ?></td>
				</tr>		
				<tr>
					<td>BUSINESS TYPE:</td>
					<td><? echo $store_array['description'] ?></td>
				</tr>
				<tr>
					<td>WEBSITE:</td><td><a href="http://<? echo $store_array['website'] ?>"><? echo $store_array['website'] ?></a></td>
				</tr>			
				<tr>
					<td align="left"><div style="float:left"><a href="https://maps.google.com/maps?hl=en&q=<? echo $store_array['address'].' '.$store_array['zip']?>"><img src="images/maps.png" align="right"></a></div></td>
					<td><? echo $store_array['address'] ?> (<? echo $store_array['zip'] ?>)</td>
				</tr>			
			</table>
		</div>
		
		<div id='edit_store_form' style='display:none; margin-top:15px; margin-left:5px; margin-right:5px; width:100%'>
			<div id="store_empty_warning" style="display:none"><font color="red"><b>ALL REQUIRED FIELDS MUST BE COMPLETED.</b></font></div>
			<div id="store_zip_warning" style="display:none"><font color="red"><b>PLEASE ENTER A VALID ZIP CODE.</b></font></div>
			
			<table style='color:#760006; margin-top:5px; width:98%'>
				<tr>
					<td><b>Store Name: &nbsp; </b></td>
					<td><input type="text" name="store_name" id="store_name" value="<? echo $store_array['name'] ?>"></input></td>
				</tr>
				<tr>
					<td><b>Website: (optional)&nbsp;</b></td> 
					<td><input type="text" name="website" id="website" value="<? echo $store_array['website'] ?>"></input></td>
				</tr>
					<td><b>Street Address: &nbsp;</b></td>
					<td><input type="text" name="address" id="address" value="<? echo $store_array['address'] ?>"></input></td>
				</tr>
				<tr>
					<td><b>Zip Code: &nbsp; </b></td>
					<td><input type="text" name="zip" id="zip" value="<? echo $store_array['zip'] ?>"></input></td>
				</tr>
				<tr>
					<td><b>Business Type: &nbsp; </b></td>
					<td><select id="description" style='background-color:#b76163;'>
<?php
						foreach ($store_types as $row) {
							$selected = "";						
							if ($row == $store_array['description']) {
								$selected = "selected";
							} 
							echo "<option value='".$row."' $selected >".$row."</option>";
						}
?>					
					</select></td>
			</table>
			
			<div id='button_holder'>		
				<div style='float:left; margin-top:15px; margin-bottom:35px; width:100%'><a href='#' class='btn btn-large btn-primary' id='edit_store'>Save Changes</a> <a href='#' class='btn btn-large btn-primary' id='cancel_store_edit'>Cancel</a></div>													
			</div>
	
		</div>
		&nbsp; <br />
		&nbsp; <br />
		
		<div style='float:left; width:100%; margin-top:5px; margin-bottom:20px; text-align:center;' class='store_details_holder'><a href='job.php?ID=new_job&storeID=".$storeID."' class='btn btn-primary'>CREATE JOB</a> <a href='#' id='edit_store_show' class='btn btn-primary'>Edit Store</a></div>															
			<a href='#' class='current' id='current'><div class='selected_tab' id='current_tab'>Current Jobs</div></a>
			<a href='#' class='archive' id='archive'><div class='unselected_tab' id='archive_tab'>Archive</div></a>

			<table class="dark" style='width:100%'>
			<tr>
				<th style="width: 60%;">Job Title</th>
				<th style="width: 20%;" class='info' id='reach_box'>Reach</th>
				<th style="width: 20%;" class='info' id='interest_box'>Interest</th>												
			</tr>	
			</table>
<?php
			if (count($open_jobs) > 0) {
				foreach ($open_jobs as $row) {
					$job_status = $row['job_status'];							
					
					if ($job_status == "Open") {
						$job = new Job($row['jobID']);
						$job_data = $job->get_job_data(array('candidate_count', 'positive_list', 'negative_count', 'view_count'));
						$reach_count = $job_data['candidate_count'];
						$responses = count($job_data['positive_list']);	
						$declines = $job_data['negative_count'];	
						$views = $job_data['view_count'];	
						$open_count++;																																							
?>
					<table class="dark"  style='width:100%'>
					<tr class = "current_jobs">
						<td style="width: 60%;"><h4><a href='job.php?ID=<? echo $row['jobID'] ?>'><? echo $row['title'] ?></a></h4><br>Expires: <? echo date('M j, Y', strtotime($row['expiration_date'])) ?></td>
						<td style="width: 20%;" align="center"><? echo $reach_count ?></td>
						<td style="width: 20%;" align="center"><? echo $responses ?></td>								
					</tr>	
					</table>
<?php
				} elseif (is_numeric($job_status)) {
					$open_count++;																																											
?>
					<table class="dark"  style='width:100%'>
					<tr class="current_jobs">
						<td style="width: 60%;"><h4><a href='job.php?ID=<? echo $row['jobID'] ?>'><? echo $row['title'] ?></a></h4><br>Expires: NA</td>
						<td colspan="4" align="center"><font color="red">Incomplete</font></td>
					</tr>	
					</table>
<?php				
				
				} elseif ($job_status == "Filled") {
					$archive_count++;
?>
					<table  class="dark"  style='width:100%'>
					<tr class="archive_jobs" style="display:none">
						<td style="width: 60%;"><h4 style="text-decoration:line-through"><a href='job.php?ID=<? echo $row['jobID'] ?>'><? echo $row['title'] ?></a></h4><br />Expires: <? echo date('M j, Y', strtotime($row['expiration_date'])) ?></td>
						<td colspan="4" align="center"><font color="gray"><b><? echo $job_status ?><b></font></td>
					</tr>	
					</table>
<?php								
				}
				
			} 
		}
			//If counts are zero, display holder
			if ($open_count == 0) {
?>
				<table  class="dark" style='width:100%'>
				<tr class = "current_jobs">
					<td colspan="5" align="center"><font color="gray"><b>No Current Open Jobs<b></font></td>
				</tr>	
				</table>
<?php				
			}
			
		if (count($expired_jobs) > 0) {
				echo "<div class='archive_jobs' style='display:none'><b>Jobs remain in the Archive for 90 days.</b></div>";				
				echo "<table class='dark archive_jobs' style='display:none;'>";	
				echo "<tr>";
			
				foreach ($expired_jobs as $row) {
?>
						<td style="width: 60%;"><h4 style="text-decoration:line-through"><a href='job.php?ID=<? echo $row['jobID'] ?>'><? echo $row['title'] ?></a></h4><br />Expires: <? echo date('M j, Y', strtotime($row['expiration_date'])) ?></td>
						<td colspan="4" align="center"><font color="gray"><b>EXPIRED<b></font></td>
					</tr>	
<?php								
				}
				
			} 
			echo "</table>";
			
			
			if (count($expired_jobs) == 0) {
?>
				<table  class="dark"  style='width:100%'>
				<tr class = "archive_jobs" style="display:none">
					<td colspan="5" align="center"><font color="gray"><b>No Archived Jobs<b></font></td>
				</tr>	
				</table>
<?php				
			}
			
			echo "&nbsp; <br />";
			echo "&nbsp; <br />";			
		echo "</div></div>";
}

function store_candidate_html_mobile($storeID, $store_name, $store_type, $website, $address, $zip, $first_name, $last_name, $position, $admin) {					
	
/*******************
*
*  Display the Store Page based on usertype and userID
*
********************/

		$job = new Job;
		$member = new Member;
		$utility = new Utilities;
		
		$location_array = $utility->get_city_state($zip);		
		
		foreach($location_array as $row) {
			$state = $row['state'];
			$city = $row['city'];
		}												
		
/*******************
*
*  Store  HTML
*
********************/
?>	

	<div class='main_box' style='margin-top:110px; width:100%;'>

		<h2 style='text-align:center'><? echo $store_name ?></h2>

		<div style="float:left; width:100%;">
		<table class="dark">
<?php
		if ($admin == "N") {
?>				
			<tr>
				<td>REPRESENTATIVE:</td>
				<td><? echo $first_name." ".$last_name." | ".$position ?></td>
			</tr>	
<?php
		}
?>
			<tr>
				<td>BUSINESS TYPE:</td>
				<td><? echo $store_type ?></td>
			</tr>
			<tr>
				<td>WEBSITE:</td><td><a href="http://<? echo $website ?>"><? echo $website ?></a></td>
			</tr>			
			<tr>
				<td align="left"><div style="float:left"><a href="https://maps.google.com/maps?hl=en&q=<? echo $address.' '.$city.' '.$state.' '.$zip?>"><img src="images/maps.png" align="right"></a></div></td>
				<td><? echo $address ?><br>
				<? echo ucwords(strtolower($city)) ?>, <? echo $state ?> <? echo $zip ?>
				</td>
			</tr>			
		</table>
		&nbsp; <br />
		
	</div>
<?php
}
?>