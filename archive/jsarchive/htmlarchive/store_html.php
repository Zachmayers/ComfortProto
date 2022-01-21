<?php
function store_html($store_data, $store_types) {	

//==================================
//!  First break master arrays into trait arrays
//
//  Modify any data for presentation
//==================================

		$store_array 					= $store_data['general'];
		$open_jobs 					= $store_data['open_jobs'];
		$expired_jobs					= $store_data['expired_jobs']; 	
		
?>	
		<table class='dark' style="width:100%;">
			<tr valign='middle'>
			<th valign='middle'><h4><? echo $store_array['name'] ?></h4></th>
			</tr>		
		</table>

		<div style="float:left; width:100%;">
		<table class="dark store_details">
			<tr>
				<td>BUSINESS TYPE:</td>
				<td><? echo $store_array['description'] ?></td>
			</tr>
			<tr>
				<td>WEBSITE:</td><td><a href="http://<? echo $store_array['website'] ?>"><? echo $store_array['website'] ?></a></td>
			</tr>			
			<tr>
				<td align="left"><div style="float:left"><a href="https://maps.google.com/maps?hl=en&q=<? echo $store_array['address'].' '.$store_array['zip']?>"><img src="images/maps.png" align="right"></a></div></td>
				<td><? echo $store_array['address'] ?><br>
					<? echo $store_array['zip'] ?>
				</td>
			</tr>			
		</table>
		&nbsp; <br />
		
		<div id="edit_store_form" style='float:left; margin-top:20px; display:none'>	
			<div id="store_required_warning" style="display:none"><font color="red"><b>ALL REQUIRED FIELDS MUST BE COMPLETED.</b></font></div>
			<div id="store_zip_warning" style="display:none"><font color="red"><b>PLEASE ENTER A VALID ZIP CODE.</b></font></div>
			<table style='color:#760006; margin-top:5px; width:100%'>
				<tr>
					<td><b>Store Name: &nbsp; </b></td>
					<td><input type="text" id="store_name" value='<? echo $store_array['name'] ?>'></input></div></td>
				</tr>
				<tr>
					<td><b>Website: (optional)&nbsp;</b></td> 
					<td><input type="text" id="website" value='<? echo $store_array['website'] ?>'></input></td>
				</tr>
					<td><b>Street Address: &nbsp;</b></td>
					<td><input type="text" id="address" value='<? echo $store_array['address'] ?>'></input></td>
				</tr>
				<tr>
					<td><b>Zip Code: &nbsp; </b></td>
					<td><input type="text" id="zip" value='<? echo $store_array['zip'] ?>'></input></td>
				</tr>
				<tr>
					<td><b>Business Type: &nbsp; </b></td>
					<td><select id="description" style="background-color:#b76163;">
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
			<div style="float:left; margin-top:35px; width:100%"><a href='#' class='btn btn-large btn-primary' id='edit_store'>Edit Store</a> <a href='#' class='btn btn-large btn-primary' id='cancel_store_edit'>Cancel</a></div>									
		</div>		
		</div>		

		<div class='store_details' style="float:left; width:100%">
		<h1 class='store-title'>Jobs</h1>

			<a href='#' id='current'><div class='selected_tab' id='current_tab'>Current Jobs</div></a>
			<a href='#' id='archive'><div class='unselected_tab' id='archive_tab'>Archive</div></a>			
			<table class="dark">
			<tr>
				<th style="width: 250px;">Job Title</th>
				<th style="width: 80px;" class='info' id='reach_box' >Reach</th>
				<th style="width: 60px;" class='info' id='views_box'>Views</th>
				<th style="width: 60px;" class='info' id='interest_box'>Interest</th>												
				<th style="width: 60px;" class='info' id='declines_box'>Declines</th>
			</tr>	
			</table>
		
<?php
			if (count($open_jobs) > 0) {
?>
			<table class='dark current_jobs'>
				<tr>
<?php			
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
						<td style="width: 200px;"><h4><a href='job.php?ID=<? echo $row['jobID'] ?>'><? echo $row['title'] ?></a></h4><br>Expires: <? echo date('M j, Y', strtotime($row['expiration_date'])) ?></td>
						<td style="width: 60px;" align="center"><? echo $reach_count ?></td>
						<td style="width: 60px;" align="center"><? echo $views ?></td>				
						<td style="width: 60px;" align="center"><? echo $responses ?></td>								
						<td style="width: 60px;" align="center"><? echo $declines ?></td>								
					</tr>	
<?php
				} elseif (is_numeric($job_status)) {
					$open_count++;																																											
?>
						<td style="width: 200px;"><h4><a href='job.php?ID=<? echo $row['jobID'] ?>'><? echo $row['title'] ?></a></h4><br>Expires: NA</td>
						<td colspan="4" align="center"><font color="red">Incomplete</font></td>
					</tr>	
<?php				
				
				} elseif ($job_status ==  "Filled") {
					$open_count++;
?>
						<td style="width: 200px;"><h4 style="text-decoration:line-through"><a href='job.php?ID=<? echo $row['jobID'] ?>'><? echo $row['title'] ?></a></h4><br />Expires: <? echo date('M j, Y', strtotime($row['expiration_date'])) ?></td>
						<td colspan="4" align="center"><font color="gray"><b><? echo $job_status ?><b></font></td>
					</tr>	
<?php								
				}
				
			} 
			echo "</table>";
			
			//If counts are zero, display holder
			if ($open_count == 0) {
?>
				<table  class="dark">
				<tr class = "current_jobs">
					<td colspan="5" align="center"><font color="gray"><b>No Current Open Jobs<b></font></td>
				</tr>	
				</table>
<?php				
			}
		} else {
?>
			<i>No current jobs</i>
<?php
		}
		
		if (count($expired_jobs) > 0) {
?>
			<div class='archive_jobs' style="display:none"><b>Jobs remain in the Archive for 90 days.</b></div>			
				<table class='dark archive_jobs' style="display:none;">	
					<tr>
<?php			
				foreach ($expired_jobs as $row) {
?>
						<td style="width: 200px;"><h4 style="text-decoration:line-through"><a href='job.php?ID=<? echo $row['jobID'] ?>'><? echo $row['title'] ?></a></h4><br />Expires: <? echo date('M j, Y', strtotime($row['expiration_date'])) ?></td>
						<td colspan="4" align="center"><font color="gray"><b>EXPIRED<b></font></td>
					</tr>	
<?php								
				}
			} 
?>
			</table>
<?php			
			//If counts are zero, display holder
			if (count($expired_jobs) == 0) {
?>
				<table class="dark">
					<tr class = "archive_jobs" style="display:none">
						<td colspan="5" align="center"><font color="gray"><b>No Archived Jobs<b></font></td>
					</tr>	
				</table>
<?php				
			}
?>			
			&nbsp; <br />
			&nbsp; <br />		
	</div>
<?php
}

/*
function store_candidate_html($storeID, $store_name, $store_type, $website, $address, $zip, $first_name, $last_name, $position, $admin) {					
	
/*******************
*
*  Display the Store Page based on usertype and userID
*
********************/

/*
		$job = new Job;
		$member = new Member;
		$utilities = new Utilities;
		
		$store_types = $utilities->store_types;
		$location_array = $utilities->get_city_state($zip);		
		
		foreach($location_array as $row) {
			$state = $row['state'];
			$city = $row['city'];
		}												
*/
		
/*******************
*
*  Store  HTML
*
********************/

/*
?>	
		<table class='dark' style='width:100%;'>
			<tr valign='middle'>
			<th valign='middle'><h4><? echo $store_name ?></h4></th>
			</tr>		
		</table>

		<div style="float:left; width:100%;">
		<table class="dark store_details">
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
*/
?>