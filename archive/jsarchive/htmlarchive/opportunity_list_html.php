<?php
function qualified_job_list_holder($job_types, $schedule_types, $comp_types, $email_verification, $firstname, $zip, $city_state, $profile_status, $incomplete_note) {					
?>	

		<div>
			<div class='container text-center'>
					<div class='row'>
						<div class='col-md-12'>
					<h2>Job Opportunities for <? echo $firstname; ?></h2>	
						<h4 style='margin-bottom:0px'>My Region:  <a href='employee.php?page=general_info'><? echo $zip ?> </a>(<? echo $city_state['city'].", ".$city_state['state']; ?>)</h4>
						<div id='button_holder'>			
							<div id='clear_filter_holder' style='display:none;'><b>Filters On</b></div>		
						</div>
					</div>
				</div>
			</div>
		</div>

<!-- 		Job Filter Buttons Are hidden until user clicks 'Filter' -->
		<div id='filter' style="display:none;">
			<div class='container-fluid margin-top-md margin-top-xs'  style='background:#ccc'>	
				<div class='container'>
					<div class='block block-pd-sm padding-md'>
	
<?php
						if ($profile_status != "complete") {
?>
							<h5>Please complete your <a href='employee.php?page=profile_menu'>PROFILE</a> to access filters.				
<?php
						} else {
?>
							<b>Select any of the options below to filter your current job matches.</b>
<?php				
							//THIS FILTER APPEARS AS LONG AS THERE ARE JOBS WITH A SPECIFIC (THERE ALWAYS WILL BE UNDER THE CURRENT BUILD)
							if (count($job_types) > 1) {
								$row_count = 0;	//COUNT THE ROWS TO PROPERLY END THE DIVS, SO YOU CAN INCLUDE EMPTIES AS NEEDED				
?>
								<div class='row'>
									<h4>Position Type</h4>
										<div id='skill_form' class='form'>
											<div class='row'>						
<?php
											foreach ($job_types as $skill) {
?>					
													<div class='col-md-3 padding-md col-xs-4 padding-xs'>
														<span class='job_skill_filter_span unselected_button btn btn-default btn-block' data-job_skill_filter='unselected' data-skill='<? echo $skill ?>' >
															<i class="fa fa-check-square-o" aria-hidden="true" style='display:none'></i> <i class="fa fa-square-o" aria-hidden="true"></i> <? echo $skill ?>
														</span>
													</div>
											
<?php								
												if ($row_count == 4) {
													$row_count = 1;
												} elseif ($row_count == 0) {
													$row_count = 2;
												} else {
													$row_count++;									
												}
											}
							
/*
											if ($row_count == 2) {
?>
												<div class='col-md-3'> &nbsp; </div>	
												<div class='col-md-3'> &nbsp; </div>		
												<div class='col-md-3'> &nbsp; </div>		
								
<?php
											} elseif ($row_count == 3) {
?>
												<div class='col-md-3'> &nbsp; </div>		
												<div class='col-md-3'> &nbsp; </div>		
<?php
											}
											
											if ($row_count == 4) {
?>				
												<div class='col-md-3'> &nbsp; </div>		
<?php
											}	
*/
?>														
											</div>
										</div>
								</div>
						
<?php
									}
							
				if (count($schedule_types) > 1) {
					$row_count = 0;
?>
		
					<div class='row'>
					<h4 >Schedule</h4>
				
						<div id='schedule_form' class='form'>
						<div class='row'>
<?php						
							foreach ($schedule_types as $schedule) {
?>
										<div class='col-md-3 padding-md col-xs-4 padding-xs'>
											<span class='schedule_filter_span unselected_button btn btn-default btn-block' data-schedule_filter='unselected' data-schedule='<? echo $schedule ?>' >
												<i class="fa fa-check-square-o" aria-hidden="true" style='display:none'></i> <i class="fa fa-square-o" aria-hidden="true"></i> <? echo $schedule ?>
											</span>
										</div>
<?php
									
/*
								if ($row_count == 4) {
									$row_count = 1;
								} elseif ($row_count == 0) {
									$row_count = 2;
								} else {
									$row_count++;									
								}
*/
							}
							
/*
							if ($row_count == 2) {
?>
										<div class='col-md-3'> &nbsp; </div>	
										<div class='col-md-3'> &nbsp; </div>	
										<div class='col-md-3'> &nbsp; </div>	
									
<?php
					} elseif ($row_count == 3) {
?>
										<div class='col-md-3'> &nbsp; </div>	
										<div class='col-md-3'> &nbsp; </div>	
									
<?php			
					}
					
					if ($row_count == 4) {
?>
										<div class='col-md-3'> &nbsp; </div>	
												
<?php						
					} 
*/
?>
							</div>
							</div>
						</div>
<?php
				}
				
				if (count($comp_types) > 1) {
?>			
					<div class='row'>
						<h4>Compensation</h4>
					
							<div id='comp_type_form' class='form' >
<?php	
						if (in_array("Hourly", $comp_types))	 {
?>
								<div class='row'>	
									<div class='col-md-3 padding-md col-xs-4 padding-xs'><span class='comp_filter_span unselected_button btn btn-default btn-block' data-comp_filter='unselected' data-comp='Hourly' id='hourly'> <i class="fa fa-check-square-o" aria-hidden="true" style='display:none'></i> <i class="fa fa-square-o" aria-hidden="true"></i> Hourly</span></div>																	
										<div class='col-md-6 padding-md col-xs-8 padding-xs'><span id='hourly_range' style='display:none'>At Least: $<input type='text' id='hourly_min' style="width:60px;">/hr</span></div>
								</div>
								<div id='hourly_warning' class='row' style="display:none">
									<div class='col-md-12' style="color:red">Values must be numbers</div>
								</div>
<?php
						}
						
						if (in_array("Salary", $comp_types)) {
?>
								<div class='row'>	
									<div class='col-md-3 padding-md col-xs-4 padding-xs'><span class='comp_filter_span unselected_button btn btn-default btn-block' data-comp_filter='unselected' data-comp='Salary' id='salary'> <i class="fa fa-check-square-o" aria-hidden="true" style='display:none'></i> <i class="fa fa-square-o" aria-hidden="true"></i> Salary</span></div>																		
									<div class='col-md-6 padding-md col-xs-8 padding-xs'> <span id='salary_range' style="display:none">At least: $<input type='text' id='salary_min' style='width:60px;'>/yr</span></div>
								</div>
								<span id='salary_warning' style="display:none">
									<div style="color:red">Values must be numbers</div>
								</span>
<?php
						}
?>	
								<div class='row'>	
<?php		
							if (in_array("Min Wage", $comp_types) || in_array("Min Wage Plus Tips", $comp_types))	 {
?>
									<div class='col-md-3 padding-md col-xs-4 padding-xs'><span class='comp_filter_span unselected_button btn btn-default btn-block' data-comp_filter='unselected' data-comp='Min Wage'> <i class="fa fa-check-square-o" aria-hidden="true" style='display:none'></i> <i class="fa fa-square-o" aria-hidden="true"></i> Min Wage</span></div>						
<?php
							} else {
?>
									<div class='col-md-3 padding-md col-xs-4 padding-xs'> &nbsp; </div>	
<?php
							}
							
							if (in_array("Negotiable", $comp_types)) {
?>
									<div class='col-md-3 padding-md col-xs-4 padding-xs'><span class='comp_filter_span unselected_button btn btn-default btn-block' data-comp_filter='unselected' data-comp='Negotiable'><i class="fa fa-check-square-o" aria-hidden="true" style='display:none'></i> <i class="fa fa-square-o" aria-hidden="true"></i> Negotiable</span></div>												
<?php
							} else {
?>
									<div class='col-md-3 padding-md col-xs-4 padding-xs'> &nbsp; </div>	
<?php					
							}
?>
<!--
									<div class='col-md-3'> &nbsp; </div>						
									<div class='col-md-3'> &nbsp; </div>						
-->
								</div>
							</div>
						</div>
					
<?php
				}
			}
?>
					</div>
				</div>
<?php		
		if ($profile_status == "complete") {
?>		
			<div class='container'>
					<div class='row'>
						<a href='#' id='save_filter' class='btn btn-primary'>APPLY FILTERS</a><a href='opportunity_list.php'> &nbsp; <i>clear filters</i></a>
					</div><br />
			</div>
<?php	
		}
?>				
			</div><!----------------  END FILTERS ----------------->
		&nbsp; <br />
	</div>	
		<div class='container'>
	<div id='opportunity_list_header' class=''>
	
	<div class='block block-pd-sm text-center'>
			<div class='col-md-12'>
				<div class='selected_tab profile_tab btn btn-large btn-default active' id='show_matches'>My Matches</div>
				<div class='unselected_tab profile_tab btn btn-large btn-default' id='show_all' >All Jobs</div>
				<div class='unselected_tab profile_tab btn btn-large btn-default' id='show_filter'>Filter Jobs</div>
			</div>
			<div class='col-md-12'>
				<div id='match_header' >Based on your profile, below are the current jobs (within 40 miles) for which you qualify.</div>
				<div id='all_header' style="display:none">Below are all the current available jobs in your region (within 40 miles).</div>
			</div>
	</div>
	<div id='match'>
			
<!----  THIS DIV IS REPLACED AND LOADED IN VIA AJAX, IT IS REPLACED WITH THE CONTENTS OF qualified_opportunity_list_html()	---->			
				<div id='qualified_opportunity_holder' class='block block-pd-sm' style='text-align:center;'>
					<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
					<h4>Loading Job Data...</h4>				
				</div>
				
			</div>
			</div>
		</div>
	</div>
<?php
}


function qualified_opportunity_list_html($opportunity_list, $employee_match_types, $email_verification, $profile_status) {
?>
	<div id='qualified_opportunity_holder' class='row'>
<?php		
	$count = 1;
	if (count($opportunity_list) > 0) {	
// BEGIN LOOP OF JOBS
		foreach($opportunity_list as $row) {

		//internal  tags for proper remarketing
		$position = $row['specialty'];
		switch($row['specialty']) {
			default:
				$category = "FOH";
			break;
			
			case "Kitchen":
				$category = "BOH";
			break;
			
			case "Bus":
				$category = "BOH";
			break;
		}
		
		$tracking_tag = "category=".$category."&position=".$position;

		//DIFFERENT TEXT BASED ON WHETHER JOB WAS VIEWED, REPLIED, OR NEW
			if ($row['responded'] == "Y") {
				$status = "Responded";
			} elseif ($row['viewed'] == "Y") {
				$status = "<i>Viewed</i>";
			} else {
				$status = "<font color='green'>NEW!</font>";						
			}
			
			if ($row['image'] == "") {			
				switch($row['specialty']) {
					case "Bartender":
						$image = "images/main-bar.png";
					break;
					
					case "Server":
						$image = "images/main-server.png";
					break;
					
					case "Kitchen":
						$image = "images/main-cook.png";
					break;		
					
					case "Host":
						$image = "images/main-host.png";
					break;
												
					case "Bus":
						$image = "images/main-bus.png";
					break;
	
					case "Manager":
						$image = "images/main-manager.png";
					break;					
					
				}
				
			} else {
				$image = "images/store_pics/".$row['image']."?".time();
			}

		//VARIABLE TO HIDE/SHOW NON-MATCHES
			if (in_array($row['specialty'], $employee_match_types)) {
				$match_hidden = "";
				$match_data = 'Y';
			} else {
				$match_hidden = "style='display:none'";
				$match_data = 'N';
			}

			$comp_filter = 0;
		switch($row['comp_type']) {
			default:
				$compensation = $row['comp_type'];
			break;
			
			case "Hourly":
				if ($row['comp_value'] > 0) {
					$compensation = "$".$row['comp_value']."/hr";
					$comp_filter = $row['comp_value'];
				} elseif ($row['comp_value_low'] == $row['comp_value_high']) {
					$compensation = "$".$row['comp_value_high']."/hr";
					$comp_filter = $row['comp_value_high'];					
				} else {
					$compensation = "$".$row['comp_value_low']."/hr - $".$row['comp_value_high']."/hr";
					$comp_filter = $row['comp_value_high'];
				}
			break;
			
			case "Salary":
				$compensation = "Salary:  $".number_format($row['comp_value']);
				if ($row['comp_value'] > 0) {
					$compensation = "$".number_format($row['comp_value']);
					$comp_filter = $row['comp_value'];
				} elseif ($row['comp_value_low'] == $row['comp_value_high']) {
					$compensation = "$".number_format($row['comp_value_high']);
					$comp_filter = $row['comp_value_high'];
				} else {
					$compensation = "$".number_format($row['comp_value_low'])." - $".number_format($row['comp_value_high']);
					$comp_filter = $row['comp_value_high'];
				}
			break;				
		}		
			
//END VARIABLES FOR JOB LISTING

//JOBS THAT ARE OPEN AND JOBS THAT ARE FILLED DISPLAY DIFFERENTLY

			if ($row['job_status'] == "Open") {
?>
	
		<div class="col-md-3 col-xs-6 text-center job_row" data-jobid='<? echo $row['jobID'] ?>' data-match='<? echo $match_data ?>' data-skill='<? echo $row['specialty'] ?>' data-comptype='<? echo $row['comp_type'] ?>' data-compvalue='<? echo $comp_filter ?>' data-schedule='<? echo $row['schedule'] ?>' <? echo $match_hidden ?>>
            <div class="panel panel-default panel-opportunity text-center">
            	<div class="panel-heading">
                <h5 class="panel-title">
                	<? echo $row['name'] ?>
                </h5>
            </div>
            
            <div class="panel-employee-photo">
	            <img src="<? echo $image ?>" class="center-block" style="max-height:150px;max-width:150px;height:auto;width:auto">
	         </div>
            	<div class="panel-body">
			  		<h2 style="margin-top:0px; word-break: break-word"><? echo $row['title'] ?></h2>
			  		<ul class="list-group">
			  			<li class="list-group-item"><? echo $status ?></li>
			  			<li class="list-group-item"><? echo $row['schedule'] ?></li>
			  			<li class="list-group-item"><? echo $compensation ?></li>
                	</ul>
					<a href="opportunity.php?ID=<? echo $row['jobID'] ?>&hash=<? echo $row['public_hash'] ?>&<? echo $tracking_tag ?>" class="btn btn-primary">VIEW DETAILS</a>
              	</div>
            </div>
        </div>
        
		<div class="clearfix" id='clear_<? echo $row['jobID'] ?>' data-job='<? echo $row['jobID'] ?>' data-visible='<? echo $match_data ?>' style="display:none;"></div>
<?php					

			}
			$count++;
		}
			
	//IF THERE ARE NO JOB OPENINGS SHOW NOTE	
	} elseif (count($opportunity_list) == 0) {
?>
		<div class="row">	
			<tr>
				<td colspan='4'>Your profile or filter criteria does not match to any current jobs in your region.  <br />New jobs are added WEEKLY, sometimes DAILY</td>
			</tr>
<?php
	}	
?>		
		</div>
	
<?php	
}

function opportunity_list_responses($current_responses) {
?>

	<div class='container' style="min-height: 70%">
		<div class='row'>
			<div class='col-md-8 col-md-offset-2 text-center'>
				<h2 style="text-align: center">Jobs Applications</h2>
				<h5 style="text-align: center">The jobs below are recent jobs to which you have responded (last 90 days)</h5>
				<a href='opportunity_list.php?page=responses&search=archive'>Search Last 2-Years</a> (<i>This my take a few minutes</i>)
			</div>
		</div>

			<div class='row' id='current_response_holder' style="margin-top: 25px; margin-bottom: 40px">
				<div id='current_table' class='col-md-10 col-md-offset-2' style="font-size:16px;">
			
<?php
				//LOOP FOR PAST RESPONSES
					if (count($current_responses) > 0) {
						foreach($current_responses as $row) {
?>
							<div class='row' style="margin-bottom: 15px;">
								<div class='col-md-6'>
									<a href='opportunity.php?ID=<? echo $row['jobID']."&hash=".$row['public_hash'] ?>'><? echo $row['title'] ?> @ <? echo $row['name'] ?></a><br />
									Posted - <? echo date('m-d-Y', strtotime($row['date_created'])) ?><br />
								</div>
								<div class='col-md-3 text-right'>									
									Applied - <? echo date('m-d-Y', strtotime($row['date_responded'])) ?><br />
								</div>
							</div>
<?php	
						}	
					} else {
?>
						<div class='row'>
							<div class='col-md-12'>
								You have no recent job applications.
							</div>
						</div>
<?php
					}
?>	
				</div>
			</div>
<?php
}

function opportunity_list_incomplete_profile() {
	echo "<h4>You must complete your <a href='employee.php?page=profile_menu'>PROFILE</a> before you can view jobs</h4>";  
	echo "<b>We match you with jobs based on your profile</b>";
}
