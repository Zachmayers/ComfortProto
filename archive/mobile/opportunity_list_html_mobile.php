<?php
function qualified_job_list_holder_mobile($job_types, $schedule_types, $comp_types, $email_verification, $firstname, $zip, $city_state) {					
?>	

		<div id='menu_buttons_match' style='float:right; width:100%; margin-bottom:5px; margin-top:0px; text-align:center;'>
			<div style='width:32.5%; float:left; background-color:#DBDCCE; min-height:30px; margin-right:1%; color:#5D0000; cursor:pointer;' id='show_matches' ><h4 style='margin-bottom:10px; margin-top:10px;'>Matches</h4></div>
			<div style='width:32.5%; float:left; background-color:#DBDCCE; min-height:30px; margin-right:1.5%; color:#5D0000; cursor:pointer;' id='show_all' ><h4 style='margin-bottom:10px; margin-top:10px;'>All Jobs</h4></div>
			<div style='width:32.5%; float:right; background-color:#DBDCCE; min-height:30px; color:#5D0000; cursor:pointer;' id='show_filter'><h4 style='margin-bottom:10px; margin-top:10px;'>Filter</h4></div>
		</div>

	<div id="main-page" class='main_box' style="float:left; width:100%; margin-top:5px;">
		<div id='opportunity_list_header'>
			<div style='float:left; width:100%; margin-top:5px; text-align:center;'>
				<h3 style='margin-top:0px;'><? echo $firstname; ?>'s Opportunities</h2>		
				<h4 style='margin-bottom:5px'>My Region:  <a href='employee.php?page=settings'><? echo $zip ?> </a>(<? echo $city_state['city'].", ".$city_state['state']; ?>)</h4>
			</div>
<?php
			if ($email_verification == 'N') {
				echo "<div style='width:99%; margin-left:3px;'>You cannot view job details or apply for jobs until you verify your email address: <a href='main.php?page=verify_email'>Learn More</a></div><br />";  
			}
?>
			<div id='match_header' style='width:99%; margin-left:3px;'><b>Based on your profile, below are the current jobs (within 40 miles) for which you qualify</b></div>
			<div id='all_header' style='display:none; width:98%; margin-left:3px;'><b>Below are all the current available jobs in your region (within 40 miles).</b></div>
			<div id='clear_filter_holder' style='width:100%; text-align:center; color:red; display:none;'>Filters On</div>
<!-- 			<div style='width:100%; float:left; background-color:#DBDCCE; min-height:30px; margin-right:1px; text-align:center;'><a href='#' id='filter_button' style='color:#5D0000'><h4 id='filter_text' style='margin-bottom:10px; margin-top:10px;'>Filter Jobs</h4><h4 id='cancel_text' style='margin-bottom:10px; margin-top:10px; display:none;'>Cancel</h4></a></div> -->

			<table class="dark">			
				<tr>
					<th style="width: 60%;" align='left'>Position</th>
<!-- 					<th style="width: 40%;">Bounty</th> -->
					<th style="width: 40%;">Status</th>
				</tr>	
			</table>
		</div>
		
<?php
	echo "<div id='filter' style='display:none; float:left;'>";
		echo "<div style='width:100%; float:left; margin-left:2px; margin-right:2px;'>";
			echo "<h2 style='margin-top:7px; text-align:center;'>Filters</h2>";	
			echo "<div style='float:left; width:99%; margin-left:3px; margin-right:2px; margin-bottom:5px;'>Select any of the options below to filter your current job matches.</div>";
			
			if (count($job_types) > 1) {
					echo "<h5 style='margin-bottom:3px; margin-top:3px; margin-left:5px;'>Skill Filters</h5>";
//					echo "<a href='#' class='select_all' id='job_skill'>SELECT ALL</a>";
					echo "<div style='width:100%; float:left; text-align:center; margin-bottom:15px;'>";
					echo "<table id='skill_form' class='form' CELLSPACING=2 cellpadding=2 width='100%'>";
					$row_count = 2;
					echo "<tr>";						
						foreach ($job_types as $skill) {
							//skill filters based on the opportunities
								if ($row_count % 2 == 0 && $row_count != 2) {						
									echo "</tr>";
									echo "<tr>";	
									echo "<td><span class='job_skill_filter_span unselected_button' data-job_skill_filter='unselected' data-skill='".$skill."' style='cursor:pointer;'>".$skill."</span></td>";
									
								} else {
									echo "<td><span class='job_skill_filter_span unselected_button' data-job_skill_filter='unselected' data-skill='".$skill."' style='cursor:pointer;'>".$skill."</span></td>";
								}
								$row_count++;
					}
				if ($row_count % 2 != 0) {	
					echo "</tr>";
				}															
				echo "</table>";
				echo "</div>";
			}
						
			if (count($schedule_types) > 1) {
					echo "<h5 style='margin-bottom:3px; margin-top:3px; margin-left:5px;'>Schedule Filters</h5>";
//					echo "<a href='#' class='select_all' id='schedule'>SELECT ALL</a>";
					echo "<div style='width:100%; float:left; text-align:center; margin-bottom:15px;'>";
					echo "<table id='schedule_form' class='form' CELLSPACING=2 cellpadding=2 width='100%'>";
					$row_count = 2;
					echo "<tr>";						
						foreach ($schedule_types as $schedule) {
							//skill filters based on the opportunities
								if ($row_count % 2 == 0 && $row_count != 2) {						
									echo "</tr>";
									echo "<tr>";	
									echo "<td><span class='schedule_filter_span unselected_button' data-schedule_filter='unselected' data-schedule='".$schedule."' style='cursor:pointer;'>".$schedule."</span></td>";
									
								} else {
									echo "<td><span class='schedule_filter_span unselected_button' data-schedule_filter='unselected' data-schedule='".$schedule."' style='cursor:pointer;'>".$schedule."</span></td>";
								}
								$row_count++;
					}
				if ($row_count % 2 != 0) {	
					echo "</tr>";
				}															
				echo "</table>";
				echo "</div>";
			}
			
			if (count($comp_types) > 1) {
					echo "<h5 style='margin-bottom:3px; margin-top:3px; margin-left:5px;'>Compensation Filters</h5>";
//					echo "<a href='#' class='select_all' id='comp'>SELECT ALL</a>";
					echo "<div style='width:100%; float:left; text-align:center;'>";
					echo "<table id='comp_type_form' class='form' CELLSPACING=2 cellpadding=2 width='100%'>";
					$row_count = 2;

					if (in_array("Hourly", $comp_types))	 {
						echo "<tr>";	
							echo "<td ><span class='comp_filter_span unselected_button' data-comp_filter='unselected' data-comp='Hourly' id='hourly' style='cursor:pointer;'>Hourly</span></td>";																		
							echo "<td> <span id='hourly_range' style='display:none'>$<input type='text' id='hourly_min' value='".$hourly_range[0]['MIN(comp_value)']."' style='width:60px;'> - $<input type='text' id='hourly_max' value='".$hourly_range[0]['MAX(comp_value)']."' style='width:60px;'></span></td>";
						echo "</tr>";
						echo "<tr id='hourly_warning' style='display:none'>";
							echo "<td colspan='2' style='color:red'>Values must be numbers</td>";
						echo "<tr>";
					}
					
					if (in_array("Salary", $comp_types)) {
						echo "<tr>";	
							echo "<td ><span class='comp_filter_span unselected_button' data-comp_filter='unselected' data-comp='Salary' id='salary' style='cursor:pointer;'>Salary</span></td>";																		
							echo "<td > <span id='salary_range' style='display:none'>$<input type='text' id='salary_min' value='".$salary_range[0]['MIN(comp_value)']."' style='width:60px;'> - $<input type='text' id='salary_max' value='".$salary_range[0]['MAX(comp_value)']."' style='width:60px;'></span></div>";
						echo "</tr>";
						echo "<tr id='salary_warning' style='display:none'>";
							echo "<td colspan='2' style='color:red'>Values must be numbers</td>";
						echo "<tr>";
					}
					
					
					echo "<tr>";		
						if (in_array("Min Wage", $comp_types) || in_array("Min Wage Plus Tips", $comp_types))	 {
							echo "<td><span class='comp_filter_span unselected_button' data-comp_filter='unselected' data-comp='Min Wage' style='cursor:pointer;'>Min Wage</span></td>";						
						} else {
							echo "<td> &nbsp; </td>";
						}
						if (in_array("Negotiable", $comp_types)) {
							echo "<td><span class='comp_filter_span unselected_button' data-comp_filter='unselected' data-comp='Negotiable' style='cursor:pointer;'>Negotiable</span></td>";												
						} else {
							echo "<td> &nbsp; </td>";						
						}
					echo "</tr>";
					
				echo "</table>";
				echo "</div>";
			}
			
/*
			if (count($store_types) > 1) {
					echo "<h5 style='margin-bottom:3px; margin-top:7px; margin-left:5px;'>Store Filters</h5>";
					echo "<a href='#' class='select_all' id='store'>SELECT ALL</a>";
					echo "<div style='width:100%; float:left; text-align:center; margin-bottom:15px;'>";
					echo "<table id='store_form' class='form' CELLSPACING=2 cellpadding=2 width='100%'>";
					$row_count = 2;
					echo "<tr>";						
						foreach ($store_types as $description) {
							//skill filters based on the opportunities
								if ($row_count % 2 == 0 && $row_count != 2) {						
									echo "</tr>";
									echo "<tr>";	
									echo "<td><span class='store_filter_span unselected_button' data-store_filter='unselected' data-store='".$description."' style='cursor:pointer;'>".$description."</span></td>";
									
								} else {
									echo "<td><span class='store_filter_span unselected_button' data-store_filter='unselected' data-store='".$description."' style='cursor:pointer;'>".$description."</span></td>";
								}
								$row_count++;
					}
				if ($row_count % 2 != 0) {	
					echo "</tr>";
				}															
				echo "</table>";
				echo "</div>";
			}																	
*/
						
			echo "<br />";
			echo "<div style='float:left; width:100%; text-align:center; padding-bottom:5px; margin-top:15px;'><a href='#' id='save_filter' class='btn btn-large btn-primary'>APPLY FILTERS</a><a href='opportunity_list.php'> &nbsp; <i>clear filters</i></a></div>";		
			echo "&nbsp; <br />";
			echo "</div>";														
		echo "</div>";
	
?>		

			<div id='match'>		
				<div id='qualified_opportunity_holder' style='width:80%; float:left; text-align:center; margin-top:20px;'>
					<h4>Loading Job Data</h4>
					<img src='images/ajax_loader.gif' height="20px" width="20px"> 
				</div>				
			</div>			
					
<?php	
}

function unqualified_job_list_holder_mobile() {					
?>	
	<div id='menu_buttons_match' style='float:right; width:100%; margin-bottom:5px; margin-top:0px; text-align:center;'>
		<div style='width:32.5%; float:left; background-color:#DBDCCE; min-height:30px; margin-right:1%'><a href='opportunity_list.php?page=bounties' style='color:#5D0000'><h4 style='margin-bottom:10px; margin-top:10px;'>Bounties</h4></a></div>
		<div style='width:32.5%; float:left; background-color:#DBDCCE; min-height:30px; margin-right:1.5%'><a href='opportunity_list.php' style='color:#5D0000'><h4 style='margin-bottom:10px; margin-top:10px;'>Matches</h4></a></div>
		<div style='width:32.5%; float:right; background-color:#DBDCCE; min-height:30px;'><a href='opportunity_list.php?type=other' style='color:#5D0000'><h4 style='margin-bottom:10px; margin-top:10px;'>Other</h4></a></div>
	</div>
		
	<div id="main-page" class='main_box' style="float:left; width:100%; margin-top:5px;">
		<div id='opportunity_list_header'>
			<div style='float:left; width:100%; margin-top:5px; text-align:center;'>
				<h3 style="text-align:center;">Other Jobs</h2> 
			</div>
	
			<div id='other_header' style='width:98%; margin-left:3px;'><b><font color='red'>Below are the current jobs (within 40 miles) for which you do NOT qualify or TURNED OFF matches.</font></b></div>
			&nbsp; <br />
				
				<table class="dark">			
				<tr>
					<th style="width: 40%;" align='left'>Position</th>
					<th style="width: 20%;">Status</th>
				</tr>	
				</table>
		</div>

			<div id='match'>		
				<div id='unqualified_opportunity_holder' style='width:80%; float:left; text-align:center; margin-top:20px;'>
					<h4>Loading Job Data</h4>
					<img src='images/ajax_loader.gif' height="20px" width="20px"> 
				</div>				
			</div>			
					
<?php

}

function qualified_opportunity_list_html_mobile($opportunity_list, $employee_match_types, $email_verification) {

	echo "<div id='qualified_opportunity_holder'>";
/*
	if($hidden_count > 0) {
		echo "&nbsp <i>".$hidden_count." job(s) hidden by filters</i><br />";
	}
*/
	
	echo "<table class='dark' id='opportunity_table'>";
	
	if (count($opportunity_list) > 0) {
		foreach($opportunity_list as $row) {
			if ($email_verification == "N") {
				//withhold name of store
				$row['name'] = "<i>Location withheld until email verified<i>";
				$row['jobID'] = "email_warning";
				//Link to warning page
			}
			
			switch($row['specialty']) {
				case "Bartender":
					$image = "main-bar.png";
				break;
				
				case "Server":
					$image = "main-server.png";
				break;
				
				case "Kitchen":
					$image = "main-cook.png";
				break;		
				
				case "Host":
					$image = "main-host.png";
				break;
											
				case "Bus":
					$image = "main-bus.png";
				break;

				case "Manager":
					$image = "main-manager.png";
				break;														
			}
		
			if ($row['responded'] == "Y") {
				$status = "Responded";
			} elseif ($row['viewed'] == "Y") {
				$status = "Viewed";
			} else {
				$status = "<font color='green'>New</font>";						
			}
			
			if (in_array($row['specialty'], $employee_match_types)) {
				$match_hidden = "";
				$match_data = 'Y';
			} else {
				$match_hidden = "style='display:none'";
				$match_data = 'N';
			}
			

				if ($row['job_status'] == "Open") {
					echo "<tr class='job_row' data-jobid='".$row['jobID']."' data-match='".$match_data."' data-skill='".$row['specialty']."' data-comptype='".$row['comp_type']."' data-compvalue='".$row['comp_value']."' data-schedule='".$row['schedule']."'  $match_hidden >";
					echo "<td style='width: 70%;'><img src='images/".$image."' height=45px; width=45px; style='vertical-align:middle;'/>  <a href='opportunity.php?ID=".$row['jobID']."&hash=".$row['public_hash']."'>".$row['title']."</a><br />";
					echo  $row['name']."</td>";
// 					echo "<td style='width: 40%;' align='center'><i>None</i></td>";
					echo "<td style='width: 30%;' align='center'>".$status."</td>";
					echo "</tr>";	
				} elseif ($row['job_status'] == "Filled") {
					echo "<tr class='job_row' data-jobid='".$row['jobID']."' data-match='".$match_data."' data-skill='".$row['specialty']."' data-comptype='".$row['comp_type']."' data-compvalue='".$row['comp_value']."' data-schedule='".$row['schedule']."'  $match_hidden >";
					echo "<td style='width: 70%;'><img src='images/".$image."' height=45px; width=45px; style='vertical-align:middle;'/>   <strike>".$row['title']."</strike><br />";
					echo $row['name']."</td>";
// 					echo "<td style='width: 40%;' align='center'><i>None</i></td>";
					echo "<td style='width: 30%;' align='center'><font color='red'>FILLED</font></td>";
					echo "</tr>";						
				}
		}	
	} 
	
	if (count($opportunity_list) == 0){
		echo "<table class='dark'>";			
			echo "<tr><td colspan='3'>Your profile or filter criteria does not match to any current jobs in your region.  <br />New jobs are added WEEKLY, sometimes DAILY</td></tr>";
			//echo "<tr><td colspan='3'><b>NOTE:</b>  You will only see jobs that match your skills and are currently unfilled.</td></tr>";
	}	
		
	echo "</table>";

	echo "</div>";	
}

function qualified_opportunity_list_html_mobile_old($qualified_bounty_list, $qualified_list, $hidden_count, $email_verification) {

	echo "<div id='qualified_opportunity_holder'>";
	if($hidden_count > 0) {
		echo "&nbsp <i>".$hidden_count." job(s) hidden by filters</i><br />";
	}
	
	echo "<table class='dark' id='opportunity_table'>";
	
	if (count($qualified_bounty_list) > 0) {
		foreach($qualified_bounty_list as $row) {
			if ($email_verification == "N") {
				//withhold name of store
				$row['name'] = "<i>Location withheld until email verified<i>";
				$row['jobID'] = "email_warning";
				//Link to warning page
			}
			
			$image = "bounty.png";
		
			if (isset($row['date_viewed']) && $row['date_viewed'] > 0) {
				$status = "Viewed";
				if ($row['employee_interest'] == "Y") {
					$status = "Responded";
				}		
			} else {
				$status = "<font color=green>New</font>";						
			}

				if ($row['job_status'] == "Open") {
					echo "<tr>";
					echo "<td style='width: 40%;'><img src='images/".$image."' height=45px; width=45px; style='vertical-align:middle;'/>  <a href='opportunity.php?ID=".$row['jobID']."&hash=".$row['public_hash']."'>".$row['title']."</a><br />";
					echo  $row['name']."</td>";
					echo "<td style='width: 40%; color:#8e080b' align='center'><b>$".$row['bounty']."</b></td>";
					echo "<td style='width: 20%;' align='center'>".$status."</td>";
					echo "</tr>";	
				} elseif ($row['job_status'] == "Filled") {
					echo "<tr>";
					echo "<td style='width: 40%;'><img src='images/".$image."' height=45px; width=45px; style='vertical-align:middle;'/>   <strike>".$row['title']."</strike><br />";
					echo $row['name']."</td>";
					echo "<td style='width: 40%; color:#8e080b' align='center'><b>$".$row['bounty']."</b></td>";
					echo "<td style='width: 20%;' align='center'><font color='red'>FILLED</font></td>";
					echo "</tr>";						
				}
		}	
	}
	
	if (count($qualified_list) > 0) {
		foreach($qualified_list as $row) {
			if ($email_verification == "N") {
				//withhold name of store
				$row['name'] = "<i>Location withheld until email verified<i>";
				$row['jobID'] = "email_warning";
				//Link to warning page
			}
			
			switch($row['specialty']) {
				case "Bartender":
					$image = "main-bar.png";
				break;
				
				case "Server":
					$image = "main-server.png";
				break;
				
				case "Kitchen":
					$image = "main-cook.png";
				break;		
				
				case "Host":
					$image = "main-host.png";
				break;
											
				case "Bus":
					$image = "main-bus.png";
				break;

				case "Manager":
					$image = "main-manager.png";
				break;														
			}
		
			if (isset($row['date_viewed']) && $row['date_viewed'] > 0) {
				$status = "Viewed";
				if ($row['employee_interest'] == "Y") {
					$status = "Responded";
				}		
			} else {
				$status = "<font color=green>New</font>";						
			}

				if ($row['job_status'] == "Open") {
					echo "<tr>";
					echo "<td style='width: 40%;'><img src='images/".$image."' height=45px; width=45px; style='vertical-align:middle;'/>  <a href='opportunity.php?ID=".$row['jobID']."&hash=".$row['public_hash']."'>".$row['title']."</a><br />";
					echo  $row['name']."</td>";
					echo "<td style='width: 40%;' align='center'><i>None</i></td>";
					echo "<td style='width: 20%;' align='center'>".$status."</td>";
					echo "</tr>";	
				} elseif ($row['job_status'] == "Filled") {
					echo "<tr>";
					echo "<td style='width: 40%;'><img src='images/".$image."' height=45px; width=45px; style='vertical-align:middle;'/>   <strike>".$row['title']."</strike><br />";
					echo $row['name']."</td>";
					echo "<td style='width: 40%;' align='center'><i>None</i></td>";
					echo "<td style='width: 20%;' align='center'><font color='red'>FILLED</font></td>";
					echo "</tr>";						
				}
		}	
	} 
	
	if (count($qualified_list) == 0 && count($qualified_bounty_list) == 0){
		echo "<table class='dark'>";			
			echo "<tr><td colspan='3'>Your profile or filter criteria does not match to any current jobs in your region.  <br />New jobs are added WEEKLY, sometimes DAILY</td></tr>";
			echo "<tr><td colspan='3'><b>NOTE:</b>  You will only see jobs that match your skills and are currently unfilled.</td></tr>";
	}	
		
	echo "</table>";

	echo "</div>";	
}

function unqualified_opportunity_list_html_mobile($unqualified_list, $email_verification) {
	echo "<div id='unqualified_opportunity_holder'>";

		echo "<table class='dark'>";

	if (count($unqualified_list) > 0) {
		foreach($unqualified_list as $row) {
			if ($email_verification == "N") {
				//withhold name of store
				$row['jobID'] = "email_warning";
				//Link to warning page
			}
			
			switch($row['specialty']) {
				case "Bartender":
					$image = "main-bar.png";
				break;
				
				case "Server":
					$image = "main-server.png";
				break;
				
				case "Kitchen":
					$image = "main-cook.png";
				break;		
				
				case "Host":
					$image = "main-host.png";
				break;
											
				case "Bus":
					$image = "main-bus.png";
				break;

				case "Manager":
					$image = "main-manager.png";
				break;														
			}
		
				if ($row['job_status'] == "Open") {
					echo "<tr>";
					echo "<td style='width: 40%;'><img src='images/".$image."' height=45px; width=45px; style='vertical-align:middle;'/>  <a href='opportunity.php?ID=".$row['jobID']."&hash=".$row['public_hash']."'>".$row['title']."</a></td>";
					echo "<td style='width: 20%;' align='center'>Open</td>";					
					echo "</tr>";	
				} elseif ($row['job_status'] == "Filled") {
					echo "<tr>";
					echo "<td style='width: 40%;'><img src='images/".$image."' height=45px; width=45px; style='vertical-align:middle;'/>   <strike>".$row['title']."</strike></td>";
					echo "<td style='width: 20%;' align='center'><font color='red'>FILLED</font></td>";
					echo "</tr>";						
				}
		}	
	} else {
				echo "<tr><td colspan='2'>There are no other jobs currently in your region.  <br />New jobs are added WEEKLY, sometimes DAILY.</td></tr>";	
	}	
		echo "</table>";	
	echo "</div>";
}

function local_bounty_list_html_mobile($qualified_bounty_list, $email_verification) {
?>
		<div id='menu_buttons_match' style='float:right; width:100%; margin-bottom:5px; margin-top:0px; text-align:center;'>
			<div style='width:32.5%; float:left; background-color:#DBDCCE; min-height:30px; margin-right:1%'><a href='opportunity_list.php?page=bounties' style='color:#5D0000'><h4 style='margin-bottom:10px; margin-top:10px;'>Bounties</h4></a></div>
			<div style='width:32.5%; float:left; background-color:#DBDCCE; min-height:30px; margin-right:1.5%'><a href='opportunity_list.php' style='color:#5D0000'><h4 style='margin-bottom:10px; margin-top:10px;'>Matches</h4></a></div>
			<div style='width:32.5%; float:right; background-color:#DBDCCE; min-height:30px;'><a href='opportunity_list.php?type=other' style='color:#5D0000'><h4 style='margin-bottom:10px; margin-top:10px;'>Other</h4></a></div>
		</div>
		
	<div id="main-page" class='main_box' style="float:left; width:100%; margin-top:5px;">
		<div id='opportunity_list_header'>
			<div style='float:left; width:100%; margin-top:5px; text-align:center;'>
				<h3 style="text-align:center;">Local Bounties</h2> 
			</div>
<?php
			if ($email_verification == 'N') {
				echo "<div style='width:99%; margin-left:3px;'>You cannot view job details or apply for jobs until you verify your email address: <a href='main.php?page=verify_email'>Learn More</a></div><br />";  
			}
?>			
			<table class="dark">			
				<tr>
					<th style="width: 40%; background-color:#2e6552" align='left'>Position</th>
					<th style="width: 40%; background-color:#2e6552">Bounty</th>
					<th style="width: 20%; background-color:#2e6552">Status</th>
				</tr>	
			</table>
			
<?php	
	echo "<table class='dark' id='opportunity_table'>";
	
	if (count($qualified_bounty_list) > 0) {
		foreach($qualified_bounty_list as $row) {
			if ($email_verification == "N") {
				//withhold name of store
				$row['name'] = "<i>Location withheld until email verified<i>";
				$row['jobID'] = "email_warning";
				//Link to warning page
			}
			
			$image = "bounty.png";
		
			if (isset($row['date_viewed']) && $row['date_viewed'] > 0) {
				$status = "Viewed";
				if ($row['employee_interest'] == "Y") {
					$status = "Responded";
				}		
			} else {
				$status = "<font color=green>New</font>";						
			}

				if ($row['job_status'] == "Open") {
					echo "<tr>";
					echo "<td style='width: 40%;'><img src='images/".$image."' height=45px; width=45px; style='vertical-align:middle;'/>  <a href='opportunity.php?ID=".$row['jobID']."&hash=".$row['public_hash']."'>".$row['title']."</a><br />";
					echo  $row['name']."</td>";
					echo "<td style='width: 40%; color:#8e080b' align='center'><b>$".$row['bounty']."</b></td>";
					echo "<td style='width: 20%;' align='center'>".$status."</td>";
					echo "</tr>";	
				} elseif ($row['job_status'] == "Filled") {
					echo "<tr>";
					echo "<td style='width: 40%;'><img src='images/".$image."' height=45px; width=45px; style='vertical-align:middle;'/>   <strike>".$row['title']."</strike><br />";
					echo $row['name']."</td>";
					echo "<td style='width: 40%; color:#8e080b' align='center'><b>$".$row['bounty']."</b></td>";
					echo "<td style='width: 20%;' align='center'><font color='red'>FILLED</font></td>";
					echo "</tr>";						
				}
		}	
	}
	
}

function opportunity_list_responses_mobile($current_responses, $expired_responses) {
?>
	<div 'menu_buttons_match' style='float:right; width:100%; margin-bottom:5px; margin-top:0px; text-align:center;'>
<?php
	if ($expired_responses == "NA") {
?>
		<div style='width:99%; float:left; background-color:#DBDCCE; min-height:30px; margin-right:1px;'><a href='opportunity_list.php?page=responses' style='color:#5D0000'><h4 id='filter_text' style='margin-bottom:10px; margin-top:10px;'>Current Responses</h4><h4 id='cancel_text' style='margin-bottom:10px; margin-top:10px; display:none;'>Cancel</h4></a></div>
<?php		
		
	} else {
?>
		<div style='width:49.75%; float:left; background-color:#DBDCCE; min-height:30px; margin-right:1px;'><a href='#' id='current_responses' style='color:#5D0000'><h4 id='filter_text' style='margin-bottom:10px; margin-top:10px;'>Current Responses</h4><h4 id='cancel_text' style='margin-bottom:10px; margin-top:10px; display:none;'>Cancel</h4></a></div>
		<div style='width:49.75%; float:left; background-color:#DBDCCE; min-height:30px;'><a href='#' id='archive_responses' style='color:#5D0000'><h4 style='margin-bottom:10px; margin-top:10px;'>Past Responses</h4></a></div>

<?php		
	}	
?>	
	</div>

	<div id="main-page" class='main_box' style="float:left; width:100%; margin-top:5px;">
		<div id='opportunity_list_header'>
			<div style='float:left; width:100%; margin-top:25px; text-align:center;'>
				<h2 style="text-align:center;">Your Job Responses</h2> 
			</div>

			<div id='current_header' style='width:99%; margin-left:3px;'><b>The jobs below are the most recent jobs to which you have responded.</b></div>
			<div id='archive_header' style='display:none; width:98%; margin-left:3px;'>
				<b>The jobs below are past jobs to which you have responded (last 90 days).</b><br />
				<a href='opportunity_list.php?page=responses&search=archive'>View Last 2-Years</a> (<i>This my take a few minutes</i>)
			</div>
			&nbsp; <br />
		</div>

<?php
	
	echo "<div id='current_response_holder'>";
	
		echo "<table class='dark' id='current_table'>";
		
		if (count($current_responses) > 0) {
			foreach($current_responses as $row) {
				switch($row['specialty']) {
					case "Bartender":
						$image = "main-bar.png";
					break;
					
					case "Server":
						$image = "main-server.png";
					break;
					
					case "Kitchen":
						$image = "main-cook.png";
					break;		
					
					case "Host":
						$image = "main-host.png";
					break;
												
					case "Bus":
						$image = "main-bus.png";
					break;
	
					case "Manager":
						$image = "main-manager.png";
					break;														
				}
	
				if ($row['job_status'] == "Open") {
					echo "<tr>";
					echo "<td style='width: 40%;'><img src='images/".$image."' height=45px; width=45px; style='vertical-align:middle;'/>  <a href='opportunity.php?ID=".$row['jobID']."&hash=".$row['public_hash']."'>".$row['title']."</a><br />";
					echo  $row['name']."</td>";
					echo "<td style='width: 20%;' align='center'>Responded:  ".date('m-d-Y', strtotime($row['date_responded']))."</td>";
					echo "</tr>";	
				} elseif ($row['job_status'] == "Filled") {
					echo "<tr>";
					echo "<td style='width: 40%;'><img src='images/".$image."' height=45px; width=45px; style='vertical-align:middle;'/>   <strike>".$row['title']."</strike><br />";
					echo $row['name']."</td>";
					echo "<td style='width: 20%;' align='center'><font color='red'>FILLED</font></td>";
					echo "</tr>";						
				}
			}	
		} else {
			echo "<tr><td colspan='2'>You have no current job responses</td></tr>";	
		}	
		echo "</table>";
	
		echo "</div>";	
		
	echo "<div id='archive_response_holder' style='display:none'>";
		echo "<table class='dark'>";
		if (count($expired_responses) > 0) {
			foreach($expired_responses as $row) {
				switch($row['specialty']) {
					case "Bartender":
						$image = "main-bar.png";
					break;
					
					case "Server":
						$image = "main-server.png";
					break;
					
					case "Kitchen":
						$image = "main-cook.png";
					break;		
					
					case "Host":
						$image = "main-host.png";
					break;
												
					case "Bus":
						$image = "main-bus.png";
					break;
	
					case "Manager":
						$image = "main-manager.png";
					break;														
				}
			
					if ($row['job_status'] == "Open") {
						echo "<tr>";
						echo "<td style='width: 40%;'><img src='images/".$image."' height=45px; width=45px; style='vertical-align:middle;'/>  <a href='opportunity.php?ID=".$row['jobID']."&hash=".$row['public_hash']."'>".$row['title']."</a><br />";
						echo  $row['name']."</td>";
						echo "<td style='width: 20%;' align='center'>Responded: ".date('m-d-Y', strtotime($row['date_responded']))."</td>";
						echo "</tr>";	
					} elseif ($row['job_status'] == "Filled") {
						echo "<tr>";
						echo "<td style='width: 40%;'><img src='images/".$image."' height=45px; width=45px; style='vertical-align:middle;'/>   <strike>".$row['title']."</strike><br />";
						echo $row['name']."</td>";
						echo "<td style='width: 20%;' align='center'><font color='red'>FILLED</font></td>";
						echo "</tr>";						
					}
			}	
		} else {
			echo "<tr><td colspan='2'>You have no archived job responses</td></tr>";	
		}	
		echo "</table>";
	
		echo "</div>";	
	echo "</div>";
}

function opportunity_list_incomplete_profile_mobile() {
	echo "<h4>You must complete your <a href='employee.php?page=profile_menu'>PROFILE</a> before you can view jobs</h4>";  
	echo "<b>We match you with jobs based on your profile</b>";
}
?>