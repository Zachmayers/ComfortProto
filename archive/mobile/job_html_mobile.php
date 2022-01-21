<?php
	
function job_html_employer_select_location_mobile($first_name, $store_array, $store_type_array) {
	$utilities = new Utilities;
	
 	echo 	"<div class='main_box' style='margin-top:80px; width:99%;'>";
		
		echo "<h3 style='margin-bottom:30px; text-align:center;'>".$first_name." - Where are you hiring?</h2>";
		
		if (count($store_array) > 0) {
			//list
			$new_store_form = "display:none";
			$first_job_note = "display:none";
		} else {
			$new_store_form = "";
			$first_job_note = "";
		}

		if (count($store_array) > 0) {				

			if (count($store_array) > 0) {
				foreach($store_array as $row) {
					$city_state = $utilities->get_city_state($row['zip']);
					echo "<div style='float:left; width:100%; margin-bottom:15px; margin-left:5px; margin-right:5px;'>";
						echo "<div style='float:left; width:60%; margin-right:5px;'>";
							echo "<h4 style='margin-bottom:0px'>".$row['name']."</h4>";
							echo "&nbsp; &nbsp; <i>".$row['address']."</i><br />";
							echo "&nbsp; &nbsp; <i>".$city_state['city'].", ".$city_state['state']." ".$row['zip']."</i>";
						echo "</div>";
						echo "<div style='float:left; width:30%; text-align:center; background-color:#8e080b; cursor:pointer' id='".$row['storeID']."' class='selected_job_titles location_select'>CONTINUE --></div>";
					echo "</div>";
				}
			}
?>
			<div id='add_new_location_note' style='float:left; width:100%; margin-bottom:15px;'>
				<hr><br />
				<div style='float:left; width:80%; margin-left:10%; margin-right:8%; text-align:center; background-color:#8e080b;' id='new_location' class='selected_job_titles'> + ADD NEW LOCATION</div>
				
				<div style='float:left; width:100%; text-align:center;'>
					<i>You can manage posts at multiple locations</i>
				</div>

			</div>
<?php
	}
?>
		<div id='store_warning' style='width:100%; float:left; display:none; color:red'>Please choose a valid Store Location.</div>

		<div id='new_store_holder' style='float:left; width:100%; margin-top:10px; <? echo $new_store_form ?>;'>
				<hr style='color:#760006; background-color:#760006'>

			<table class="dark" style='width:100%; margin-top:-7px;'>
				<tr>
					<th>Add Store/Location</th>
				</tr>	
			</table>		

		<span style='<? echo $first_job_note ?>'><i>First you need to create a location for your business.<br />(You only need to do this for your first job post, you can use the same location after that.)</i><br /></span>

		<div class="add_store_form" style='width:100%; float:left; margin-left:3px;'>		
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
						<tr style='<? echo $first_job_note ?>'>
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
						<tr>
							<td>
								<b>Business Type: &nbsp; </b>
							</td>
							<td>
								<select id="description" style='background-color:#b76163;'>
									<option value='0'>--Location Type--</option>								
									
<?php
								foreach ($store_type_array as $type) {
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
					
					<div style='float:left; margin-top:35px; margin-left:15px; margin-bottom:20px; width:100%'>
						<a href='#' class='btn btn-large btn-primary add_store' id='post'>Save & Continue</a>								
<?php
					if ($first_job_note != "") {
?>
						<a href='#' class='btn btn-large btn-primary cancel_add'>Cancel</a>											
<?php					
					}
?>	
					</div>
					<div style='float:left; margin-top:15px; width:100%; <? echo $first_job_note ?>'>You can manage jobs at multiple locations as well.  You can add new stores/locations and edit location details on your "Settings" page.</div>								
						&nbsp; <br />
						&nbsp; <br />																								
		</div>	




		</div>	
	</div>
</div>

<?php
}	

function job_html_employer_selection_mobile($storeID, $store_name, $region_status, $next_cl_date) {

	//in this version, we will allow the user to select from a couple options
	// 1) Single job post $15
	// 2) All FOH or All BOH for $30, this will allow the user to select up to 4 jobs to post
	// 3) All Positions for $55, this will allow the user to select up to 8 jobs to post
	
	//Free for low regions
	
	if ($region_status == "free") {
		$single_price = $four_price = $eight_price = "<i>FREE</i>";
	} else {
		$single_price = "$15";
		$four_price = "$30";
		$eight_price = "$55";	
	}

	
	echo 	"<div class='main_box' style='margin-top:80px; width:100%;'>";
		//echo	"<h3 style='text-align:center'>Job Post - ".$store_name."</h3>";
		echo "<h3 style='margin-bottom:20px; text-align:center;'>How many positions do you need to fill?</h2>";
?>		
		
			<div id='single' class='job_post' style='width:100%; float:left; margin-bottom:15px; cursor:pointer;'>
				<div style='float:left; width:100%'>
					<div style='float:left; text-align:center; width:90%; margin-left:5%; margin-right:5%; border-radius:10px; border-style:solid; border-width:3px; border-color:white; background-color:#8e080b;'>
						<h4 style='color:white; margin-top:8px; margin-bottom:8px;'>INDIVIDUAL JOB POST - <? echo $single_price ?></h4>
					</div>
				</div>
				<div style='float:left; width:100%; text-align:center; margin-top:-25px;'>			
					<h5 style='margin-bottom:0px; color:#8e080b'><i>Post a one job opening of any type</i></h5>
				</div>

			</div>

			<div id='FOH' class='job_post' style='width:100%; float:left; margin-bottom:15px; cursor:pointer;'>
				<div style='float:left; width:100%'>
					<div style='display:inline; float:left; text-align:center; width:90%; margin-left:5%; margin-right:5%; border-radius:10px; border-style:solid; border-width:3px; border-color:white; background-color:#8e080b;'>
						<h4 style='color:white; margin-top:8px; margin-bottom:8px;'>&nbsp; ALL FRONT OF HOUSE - <? echo $four_price ?> &nbsp;</h4>
					</div>
				</div>
				<div style='float:left; width:100%; text-align:center; margin-top:-25px;'>			
					<h5 style='margin-bottom:0px; color:#8e080b'><i>Include up to </i><b>4</b><i> FOH Openings in this post!</i></h5>
				</div>
			</div>
			
			<div id='BOH' class='job_post' style='width:100%; float:left; margin-bottom:15px; cursor:pointer;'>
				<div style='float:left; width:100%'>
					<div style='float:left; text-align:center; width:90%; margin-left:5%; margin-right:5%; border-radius:10px; border-style:solid; border-width:3px; border-color:white; background-color:#8e080b;'>
						<h4 style='color:white; margin-top:8px; margin-bottom:8px; cursor:pointer;'>&nbsp; ALL BACK OF HOUSE - <? echo $four_price ?> &nbsp;</h4>
					</div>
				</div>
				<div style='float:left; width:100%; text-align:center; margin-top:-25px;'>			
					<h5 style='margin-bottom:0px; color:#8e080b'><i>Include up to </i><b>4</b><i> BOH Openings in this post!</i></h5>
				</div>
			</div>

			<div id='all' class='job_post' style='width:100%; float:left; margin-bottom:15px; cursor:pointer;'>
				<div style='float:left; width:100%'>
					<div style='float:left; text-align:center; width:90%; margin-left:5%; margin-right:5%; border-radius:10px; border-style:solid; border-width:3px; border-color:white; background-color:#8e080b;'>
						<h4 style='color:white; margin-top:8px; margin-bottom:8px; cursor:pointer;'>&nbsp; HIRING ALL POSITIONS - <? echo $eight_price ?> &nbsp;</h4>
					</div>
				</div>
				<div style='float:left; width:100%; text-align:center; margin-top:-25px;'>			
					<h5 style='margin-bottom:0px; color:#8e080b'><i>Include up to </i><b>8</b><i> FOH & BOH Openings in this post!</i></h5>
				</div>
			</div>
			
<?php
		if ($region_status != "free") {
			echo "<div style='width:100%; float:left' id='included_text'>";
				echo "<div style='float:left; width:82%; margin-left:8%; margin-right:10%; margin-bottom:5px; margin-top:10px; padding-top:7px; padding-bottom:7px; padding-left:5px; padding-right:2px; border-radius:10px; border-style:solid; border-width:2px; border-color:#a9a9a9;'>";			
					echo "<h5 style='text-align:center; margin-bottom:3px; margin-top:0px;'>Included with ANY purchase!</h5>";
					
					echo "<div style='float:left; width:100%'>";
						echo "<div style='float:left; width:10%'><img src='images/add.png' style='vertical-align:middle' height='20' width='20' alt='check'></div>";
						echo "<div style='float:left; width:90%'>Your job(s) will be posted on ServeBartendCook.com</div><br />";
					echo "</div>";

					echo "<div style='float:left; width:100%'>";
						echo "<div style='float:left; width:10%'><img src='images/add.png' style='vertical-align:middle' height='20' width='20' alt='check'></div>";
						echo "<div style='float:left; width:90%'><b>Your job(s) will be featured in our regional Craigslist group post</b></div>";
					echo "</div>";

					echo "<div style='float:left; width:100%'>";					
						echo "<div style='float:left; width:10%'><img src='images/add.png' style='vertical-align:middle' height='20' width='20' alt='check'></div>";
						echo "<div style='float:left; width:90%'>Email alerts will be sent to all users who match your job(s) criteria</div><br />";					
					echo "</div>";
				echo "</div>";
			echo "</div>";
		} else {
			echo "<div style='width:100%; float:left' id='included_text'>";
				echo "<div style='float:left; width:82%; margin-left:8%; margin-right:10%; margin-bottom:5px; margin-top:10px; padding-top:7px; padding-bottom:7px; padding-left:5px; padding-right:2px; border-radius:10px; border-style:solid; border-width:2px; border-color:#a9a9a9;'>";			
					echo "<h5 style='text-align:center; margin-bottom:3px; margin-top:0px;'>Jobs in your region are currently free to post.</h5>";
				echo "</div>";
			echo "</div>";			
		}	
}

function job_html_employer_templates_mobile($group_details, $group_job_list, $job_template_array, $former_jobs, $storeID, $store_name, $former_jobs2, $email_verification, $email, $region_status, $receiptID) {
	$all_display = $boh_display = $foh_display = "display:none;";
	$checkout_test = "N";
	$posted_count = 0;  //for completed posts adding more
	
	//detrmine number of posts left
	$total_post_number = $group_details['max_posts'];
	$current_posts = count($group_job_list);
	
	$remaining_posts = $total_post_number - $current_posts;
	
	switch($group_details['type']) {
		default:
			$title_text = "Individual Job Post";
			$count_text = "";
			$back = "all_back";
			if (count($group_job_list) == 0) {
				$all_display = "";
			}
			$cost = "$15";
			
			if ($current_posts > 0) {
				$checkout_test = "Y";
			}
			
			$remain_text = 1;
			
			$allowable_posts = 1;			
		break;
		
		case "BOH":
			$title_text = "Hiring All Back of House";
			$count_text = "<div style='float:left; width:100%; text-align:center; margin-bottom:10px;'><b>You may include up to 4 BOH openings in this post</b></div>";
			$back = "boh_back";
			if (count($group_job_list) == 0) {
				$boh_display = "";
			}
			$cost = "$30";
			
			if ($current_posts > 1) {
				$checkout_test = "Y";
			}
			
			$remain_text = 2;		
			
			$allowable_posts = 4;								
		break;

		case "FOH":
			$title_text = "HIRING ALL FRONT OF HOUSE";
			$count_text = "<div style='float:left; width:100%; text-align:center; margin-bottom:10px;'><b>You may include up to 4 FOH openings in this post</b></div>";
			$back = "foh_back";
			if (count($group_job_list) == 0) {
				$foh_display = "";
			}
			$cost = "$30";

			if ($current_posts > 1) {
				$checkout_test = "Y";
			}
			
			$remain_text = 2;	
			
			$allowable_posts = 4;									
		break;

		case "all":
			$title_text = "Hiring All Positions";
			$count_text = "<div style='float:left; width:100%; text-align:center; margin-bottom:10px;'><b>You may include up to 8 openings in this post</b></div>";
			$back = "all_back";
			if (count($group_job_list) == 0) {
				$all_display = "";
			}
			$cost = "$55";
			
			if ($current_posts > 3) {
				$checkout_test = "Y";
			}
			
			$remain_text = 4;	
			
			$allowable_posts = 8;																
		break;		
	}

	switch($group_details['post_status']) {
		default:
			if ($region_status == "free") {
				$cost = "FREE";
				$pending_statement = "<i>Post Pending - Finalize Below</i>";
			} else {
				$pending_statement = "<i>Post Pending - Awaiting Checkout Below</i>";		
			}
		break;
		
		case "posted":
			if ($region_status == "free") {
				$cost = "FREE";
				$pending_statement = "<i>Job Posted</i>";
			} else {
				$pending_statement = "<i>Job Posted</i>";		
			}
		break;
	}		
	
	echo 	"<div class='main_box' style='float:left; margin-top:10px; width:99%;'>";
		echo	"<h3 style='text-align:center'>".$store_name."</h3>";

		echo "<div class='job_post_holder' style='float:left; width:94%; margin-left:2px; margin-right:2px; margin-bottom:5px; margin-top:10px; padding-top:7px; padding-bottom:7px; padding-left:10px; padding-right:10px; border-radius:5px; border-style:solid; border-width:2px; border-color:#a9a9a9;'>";
			echo "<h4 style='text-align:center; margin-bottom:0px;'>".$title_text."</h4>";
			if ($group_details['post_status'] == "posted") {
				$expiration_date = "Error";
				$expired = "Y";
				if (count($group_job_list) > 0) {
					foreach ($group_job_list as $row) {
						if ($row['job_status'] == "Open" || $row['job_status'] == "Filled") {
							$expiration_date = date('M j, Y', strtotime($row['expiration_date']));
						}
					}
				}
				if (strtotime($expiration_date) > strtotime(date('M j, Y'))) {
					$expired = "N";
				}
				if ($expired == "N") {
					echo "<h4 style='text-align:center'>Post Expires on ".$expiration_date."</h4>";	
				} else {
					echo "<h4 style='text-align:center; color:red'>Expired on ".$expiration_date."</h4>";					
				}					
			} else {
				echo "<h4 style='text-align:center'>".$count_text."</h4>";			
			}

		if (count($group_job_list) > 0) {
			//display current jobs associated with group
			echo "<div style='width:100%; float:left;'>";
				echo "<table id='current_posts' style='width:100%; float:left;' cellspacing='10'>";
					foreach ($group_job_list as $row) {
	
						echo "<tr>";
							echo "<td style='width:90%'>";
									echo "<div style='width:100%; float:left;'>";
										echo "<div style='width:10%; float:left;'>";
											echo "<img src='images/postjob.png' style='vertical-align:middle' height='40' width='40' alt='post'>";
										echo "</div>";
										echo "<div style='width:90%; float:left;'>";
											echo "<div style='width:100%; float:left; padding-left:15px;'>";
												echo "<h3 style='margin-bottom:0px; display:inline;'> &nbsp; ".$row['title']."</h3><br />";
												if ($group_details['post_status'] == "posted") {
													if ($row['job_status'] != "Open" && $row['job_status'] != "Filled") {
														echo "&nbsp; &nbsp; <i style='color:red'>Post Pending <br /> Click 'SAVE UPDATES' below</i><br />";
													} else {
														$posted_count++;
														echo "&nbsp; &nbsp; ".$pending_statement;
													}	
												} else {
													echo "&nbsp; &nbsp; ".$pending_statement;	
												}
											echo "</div>";
										echo "</div>";
									echo "</div>";
								echo "</td>";
								echo "<td align='right'>";
//										echo "<div style='float:right; width:80%; text-align:center;'><h4><a href='job.php?ID=".$row['jobID']."'>EDIT</a></h3></div><br />";
									if ($group_details['post_status'] == "posted") {
										if ($row['job_status'] != "Open" && $row['job_status'] != "Filled") {
											echo "<div style='float:right; width:80%; text-align:center;'><h4><a href='job.php?ID=".$row['jobID']."'>EDIT</a></h3></div><br />";
										} else {
											if ($expired == "N") {
												echo "<div style='float:right; width:80%; text-align:center;'><h4><a href='job.php?ID=".$row['jobID']."&page=edit'>VIEW/EDIT</a></h3></div><br />";																				
											} else {
												echo "<div style='float:right; width:80%; text-align:center;'><h4><a href='job.php?ID=".$row['jobID']."'><i>Expired</i></a></h4></div><br />";																														
											}
										}
									} else {
										echo "<div style='float:right; width:80%; text-align:center;'><h4><a href='job.php?ID=".$row['jobID']."'>EDIT</a></h3></div><br />";
									}

								echo "</td>";
							echo "</tr>";
						}
				echo "</table>";
		
				if ($remaining_posts > 0 && $group_details['type'] != "single") {
					if ($current_posts > 0) {
						if ($group_details['post_status'] == "posted" && $expired == "Y") {
							
						} else {
							echo "<div style='width:100%; margin-bottom:15px; margin-top:8px; padding-left:25px; margin-left:25px width:100%; float:left;' class='more_button'><a href='#' class='btn btn-primary' id='show_".$group_details['type']."'> + Add Another Opening (Up to ".$remaining_posts." more)* </a></div>";
						}						
					}
				}

	
				echo "<div style='width:100%; float:left' id='included_text'>";
					if ($group_details['post_status'] == "posted") {
						//count posted items 
						if ($posted_count != $allowable_posts) {
							if ($group_details['region_status'] == "free") {
								$receiptID = "free";
							}
							echo "<h5 style='text-align:center; margin-bottom:5px;'>Any openings added to this post will expire on:  ".$expiration_date."</h5>";	

							if ($group_details['type'] == "FOH" || $group_details['type'] == "BOH" || $group_details['type'] == "all") {
								if ($posted_count != $allowable_posts && $expired != "Y") {
									echo "<div style='float:left; width:100%; text-align:center; margin-top:10px; margin-bottom:10px;'>";
					 					echo "<a href='#' class='btn btn-large btn-primary checkout_holder' id='update_post' style='background-color:#2e6652;'> <img src='images/savegreen.png' height='25px' width='25px' alt='check' style='vertical-align:middle'> SAVE UPDATES</a>";									
					 					echo "<br /> &nbsp; <br /><i>By clicking 'Save Updates' you agree to our full <a href='index.php?page=TOS'>Terms of Service</a> and <a href='index.php?page=privacy_policy'>Privacy Policy</a></i><br />";
									echo "</div>";
								}
								echo "<br />";	
							} 				
												
						} else {
							echo "<h5 style='text-align:center; margin-bottom:5px;'>All openings above are currently posted: <a href='job.php?ID=new_job&page=location'>POST NEW JOB</a></h5>";						
							echo " &nbsp; <br />";							
						}
						
						if ($remaining_posts > 0) {
//							echo "&nbsp; <br />";		
							echo "&nbsp; &nbsp; &nbsp; &nbsp; <b>*IMPORTANT - Unused openings DO NOT carry over as credits for future jobs posts.</b>";				
						}
						
						if ($receiptID > 0 && $receiptID != "NA") {
							echo "<h5 style='text-align:center; margin-top:10px'><a href='job.php?ID=new_job&groupID=".$group_details['groupID']."&page=group_receipt&receiptID=".$receiptID."'>VIEW RECEIPT</a></h5>";							
						}
					
					} else {
						if ($region_status == "free") {
							echo "<h5 style='text-align:center; margin-bottom:5px;'>Included with your post</h5>";
							echo "&nbsp; &nbsp; &nbsp; &nbsp; <img src='images/add.png' style='vertical-align:middle' height='20' width='20' alt='check'> The Above job and specific openings will be posted on ServeBartendCook.com<br />";
							echo "&nbsp; &nbsp; &nbsp; &nbsp; <img src='images/add.png' style='vertical-align:middle' height='20' width='20' alt='check'> Email alerts will be sent to all users who match the criteria in the above openings<br />";
						} else {
							echo "<h5 style='text-align:center; margin-bottom:10px;'>Included with your purchase</h5>";
							echo "&nbsp; &nbsp; &nbsp; &nbsp; <img src='images/add.png' style='vertical-align:middle' height='20' width='20' alt='check'> The above job and specific openings will be posted on ServeBartendCook.com<br />";
							echo "&nbsp; &nbsp; &nbsp; &nbsp; <img src='images/add.png' style='vertical-align:middle' height='20' width='20' alt='check'> Email alerts will be sent to all users who match the criteria in the above openings<br />";
							echo "&nbsp; &nbsp; &nbsp; &nbsp; <img src='images/add.png' style='vertical-align:middle' height='20' width='20' alt='check'> Openings will be included in our regional Craigslist Group Post (posted on Tues. or Thurs.)<br />";
							if ($remaining_posts > 0) {
								echo "&nbsp; <br />";		
								echo "&nbsp; &nbsp; &nbsp; &nbsp; <b>*IMPORTANT - Unused openings DO NOT carry over as credits for future jobs posts.</b><br />";
							}
						}
					}
				
/*
						if ($region_status == "free") {
							echo "<h5 style='text-align:center; margin-bottom:5px; margin-top:10px;'>Included with your post</h5>";
							echo "<img src='images/add.png' style='vertical-align:middle' height='20' width='20' alt='check'> The above job will be posted on ServeBartendCook.com<br />";
							echo "<img src='images/add.png' style='vertical-align:middle' height='20' width='20' alt='check'> Email alerts will be sent to all users who match the above job(s) criteria<br />";
						} else {
							echo "<h5 style='text-align:center; margin-bottom:5px; margin-top:10px;'>Included with your purchase</h5>";
							
							echo "<div style='float:left; width:100%'>";
								echo "<div style='float:left; width:8%'><img src='images/add.png' style='vertical-align:middle' height='20' width='20' alt='check'></div>";
								echo "<div style='float:left; width:92%'>The Above job(s) will be posted on ServeBartendCook.com.</div>";
							echo "</div>";
			
							echo "<div style='float:left; width:100%'>";				
								echo "<div style='float:left; width:8%'><img src='images/add.png' style='vertical-align:middle' height='20' width='20' alt='check'></div>";
								echo "<div style='float:left; width:92%'>Email alerts will be sent to all users who match the above job(s) criteria.</div>";
							echo "</div>";

							echo "<div style='float:left; width:100%'>";							
								echo "<div style='float:left; width:8%'><img src='images/add.png' style='vertical-align:middle' height='20' width='20' alt='check'></div>";
								echo "<div style='float:left; width:92%'><b>The above jobs will be featured in our regional Craigslist group post**</b></div>";
							echo "</div>";
							if ($remaining_posts > 0) {
								echo "&nbsp; <br />";		
								echo "&nbsp; &nbsp; &nbsp; &nbsp; <b>*IMPORTANT - Unused openings DO NOT carry over as credits for future jobs posts.</b><br />";
							}
						}
*/
				echo "</div>";
			echo "</div>";
		}		
	
		echo "<div id='single_post_options' class='post_options' style='width:100%; float:left; ".$all_display."'>";
		echo "<div id='single_job_type_holder' style='width:100%; float:left; text-align:center'>";
			echo "<h4 style='text-align:center;'>Select Job Category: </h4>";		
	
/*
				echo "<a href='#' class='main_skill' id='Bartender'><img src='images/main-bar.png' height='120px' style='margin-left:5px; '></a>";	
				echo "<a href='#' class='main_skill' id='Manager'><img src='images/main-manager.png' height='120px' style='margin-left:5px;'></a>";																			
				echo "<a href='#' class='main_skill' id='Server'><img src='images/main-server.png' height='120px' style='margin-left:5px;'></a>";										
				echo "<a href='#' class='main_skill' id='Kitchen'><img src='images/main-cook.png' height='120px' style='margin-left:5px;'></a>";										
				echo "<a href='#' class='main_skill' id='Host'><img src='images/main-host.png' height='120px' style='margin-left:5px;'></a>";										
				echo "<a href='#' class='main_skill' id='Bus'><img src='images/main-bus.png' height='120px' style='margin-left:5px;'></a>";		
*/
	
				echo "<div style='float:left; width:100%'>";
					echo "<div style='float:left; width:50%'>";
						echo "<a href='#' class='main_skill btn btn-large btn-primary' id='Bartender' style='background-color:#8e080b; float:left; width:80%; text-align:center; margin-left:5%; margin-right:10%'><img src='images/martini.png' style='vertical-align:middle; margin-bottom:7px;' height='40px' width='40px' alt='people'><br />BARTENDER</a>";	
					echo "</div>";
					echo "<div style='float:left; width:50%'>";
						echo "<a href='#' class='main_skill btn btn-large btn-primary' id='Manager' style='background-color:#8e080b; float:left; width:80%; text-align:center; margin-left:5%; margin-right:10%'><img src='images/morejobsavailable.png' style='vertical-align:middle; margin-bottom:7px;' height='40px' width='40px' alt='people'><br />MANAGER</a>";																			
					echo "</div>";
				echo "</div>";
				
				echo "<div style='float:left; width:100%'>";
					echo "<div style='float:left; width:50%'>";
						echo "<a href='#' class='main_skill btn btn-large btn-primary' id='Server' style='background-color:#8e080b; float:left; text-align:center; width:80%; text-align:center; margin-left:5%; margin-right:10%; margin-top:10px;'><img src='images/plate.png' style='vertical-align:middle; margin-bottom:7px;' height='40px' width='40px' alt='people'><br />SERVER</a>";										
					echo "</div>";
					echo "<div style='float:left; width:50%'>";
						echo "<a href='#' class='main_skill btn btn-large btn-primary' id='Kitchen' style='background-color:#8e080b; float:left; text-align:center; width:80%; text-align:center; margin-left:5%; margin-right:10%; margin-top:10px;'><img src='images/cheftools.png' style='vertical-align:middle; margin-bottom:7px;' height='40px' width='40px' alt='people'><br />KITCHEN</a>";										
					echo "</div>";
				echo "</div>";
				
				echo "<div style='float:left; width:100%'>";
					echo "<div style='float:left; width:50%'>";
						echo "<a href='#' class='main_skill btn btn-large btn-primary' id='Host' style='background-color:#8e080b; float:left; text-align:center; width:80%; text-align:center; margin-left:5%; margin-right:10%; margin-top:10px;'><img src='images/frontofhouse.png' style='vertical-align:middle; margin-bottom:7px;' height='40px' width='40px' alt='people'><br />HOST</a>";										
					echo "</div>";
					echo "<div style='float:left; width:50%'>";
						echo "<a href='#' class='main_skill btn btn-large btn-primary' id='Bus' style='background-color:#8e080b; float:left; text-align:center; width:80%; text-align:center; margin-left:5%; margin-right:10%; margin-top:10px;'><img src='images/seeprofile.png' style='vertical-align:middle; margin-bottom:7px;' height='40px' width='40px' alt='people'><br />BUSSER</a>";		
					echo "</div>";
				echo "</div>";
				
				if (count($former_jobs) > 0) {
					echo "<h3 style='margin-top:10px; text-align:center'>OR</h3>";			
					echo "<h3 style='margin-bottom:10px; text-align:center'>Repost a job (up to 9-months old):</h3>";	
	
					echo 	"&nbsp; &nbsp; <select id='former_job' style='background-color:#b76163'>";
						echo "<option value='NA'>SELECT FORMER JOB POST</option>";				
						foreach($former_jobs as $row) {
							echo "<option value='".$row['jobID']."'>".$row['title']." - ".date('M j, Y', strtotime($row['date_created']))."</option>";
						}
					echo "</select><br />";	
				}	
		echo "</div>";
		
		if ($current_posts > 0) {						
			echo "<div style='width:100%; text-align:center; float:left; margin-bottom:15px; margin-top:12px; display:none' class='all_main_back'><a href='#' class='btn btn-primary selection_back' id='all_back'> Back </a></div>";
		}
	echo "</div>";
	
 	echo "<div id='boh_post_options' class='post_options' style='width:100%; float:left; ".$boh_display."'>";
		echo "<div id='single_job_type_holder' style='width:100%; float:left; text-align:center;'>";
			echo "<h3>Job Category: </h3>";		

/*
				echo "<a href='#' class='main_skill' id='Manager'><img src='images/main-manager.png' height='120px' style='margin-left:5px;'></a>";																			
				echo "<a href='#' class='main_skill' id='Kitchen'><img src='images/main-cook.png' height='120px' style='margin-left:5px;'></a>";										
				echo "<a href='#' class='main_skill' id='Bus'><img src='images/main-bus.png' height='120px' style='margin-left:5px;'></a>";		
*/

				echo "<div style='float:left; width:100%'>";
					echo "<div style='float:left; width:50%'>";
						echo "<a href='#' class='main_skill btn btn-large btn-primary' id='Manager' style='background-color:#8e080b; float:left; width:80%; text-align:center; margin-left:5%; margin-right:10%; margin-top:10px;'><img src='images/morejobsavailable.png' style='vertical-align:middle; margin-bottom:7px;' height='40px' width='40px' alt='people'><br />MANAGER</a>";																			
					echo "</div>";
					echo "<div style='float:left; width:50%'>";
						echo "<a href='#' class='main_skill btn btn-large btn-primary' id='Kitchen' style='background-color:#8e080b; float:left; width:80%; text-align:center; margin-left:5%; margin-right:10%; margin-top:10px;'><img src='images/cheftools.png' style='vertical-align:middle; margin-bottom:7px;' height='40px' width='40px' alt='people'><br />KITCHEN</a>";										
					echo "</div>";
				echo "</div>";
				
				echo "<div style='float:left; width:100%'>";
					echo "<div style='float:left; width:50%'>";
						echo "<a href='#' class='main_skill btn btn-large btn-primary' id='Bus' style='background-color:#8e080b; float:left; width:80%; text-align:center; margin-left:5%; margin-right:10%; margin-top:10px;'><img src='images/seeprofile.png' style='vertical-align:middle; margin-bottom:7px;' height='40px' width='40px' alt='people'><br />BUSSER</a>";		
					echo "</div>";
					echo "<div style='float:left; width:50%'>";
						echo " &nbsp; ";										
					echo "</div>";
				echo "</div>";

	
				if (count($former_jobs) > 0) {
					echo "<h3 style='margin-top:10px; text-align:center'>OR</h3>";			
					echo "<h3 style='margin-bottom:10px; text-align:center'>Repost a job (up to 9-months old):</h3>";	
	
					echo 	"&nbsp; &nbsp; <select id='former_job' style='background-color:#b76163'>";
						echo "<option value='NA'>SELECT FORMER JOB POST</option>";				
						foreach($former_jobs as $row) {
							echo "<option value='".$row['jobID']."'>".$row['title']." - ".date('M j, Y', strtotime($row['date_created']))."</option>";
						}
					echo "</select><br />";	
				}	
		echo "</div>";

		if ($current_posts > 0) {						
			echo "<div style='width:100%; text-align:center; float:left; margin-bottom:15px; margin-top:12px; display:none' class='boh_main_back'><a href='#' class='btn btn-primary selection_back' id='boh_back'> Back </a></div>";
		}
		
	echo "</div>";													
														
 	echo "<div id='foh_post_options' class='post_options' style='width:100%; float:left; ".$foh_display."'>";
		echo "<div id='single_job_type_holder' style='width:100%; float:left; text-align:center;'>";
			echo "<h4 style='text-align:center'>Select Job Category</h4>";		
		
/*
				echo "<a href='#' class='main_skill' id='Bartender'><img src='images/main-bar.png' height='120px' style='margin-left:5px; '></a>";	
				echo "<a href='#' class='main_skill' id='Manager'><img src='images/main-manager.png' height='120px' style='margin-left:5px;'></a>";																			
				echo "<a href='#' class='main_skill' id='Server'><img src='images/main-server.png' height='120px' style='margin-left:5px;'></a>";										
				echo "<a href='#' class='main_skill' id='Host'><img src='images/main-host.png' height='120px' style='margin-left:5px;'></a>";										
				echo "<a href='#' class='main_skill' id='Bus'><img src='images/main-bus.png' height='120px' style='margin-left:5px;'></a>";		
*/

				echo "<div style='float:left; width:100%'>";
					echo "<div style='float:left; width:50%'>";
						echo "<a href='#' class='main_skill btn btn-large btn-primary' id='Bartender' style='background-color:#8e080b; float:left; width:80%; text-align:center; margin-left:5%; margin-right:10%'><img src='images/martini.png' style='vertical-align:middle; margin-bottom:7px;' height='40px' width='40px' alt='people'><br />BARTENDER</a>";	
					echo "</div>";
					echo "<div style='float:left; width:50%'>";
						echo "<a href='#' class='main_skill btn btn-large btn-primary' id='Manager' style='background-color:#8e080b; float:left; width:80%; text-align:center; margin-left:5%; margin-right:10%'><img src='images/morejobsavailable.png' style='vertical-align:middle; margin-bottom:7px;' height='40px' width='40px' alt='people'><br />MANAGER</a>";																			
					echo "</div>";
				echo "</div>";
				
				echo "<div style='float:left; width:100%'>";
					echo "<div style='float:left; width:50%'>";
						echo "<a href='#' class='main_skill btn btn-large btn-primary' id='Server' style='background-color:#8e080b; float:left; text-align:center; width:80%; text-align:center; margin-left:5%; margin-right:10%; margin-top:10px;'><img src='images/plate.png' style='vertical-align:middle; margin-bottom:7px;' height='40px' width='40px' alt='people'><br />SERVER</a>";										
					echo "</div>";
					echo "<div style='float:left; width:50%'>";
						echo "<a href='#' class='main_skill btn btn-large btn-primary' id='Host' style='background-color:#8e080b; float:left; text-align:center; width:80%; text-align:center; margin-left:5%; margin-right:10%; margin-top:10px;'><img src='images/frontofhouse.png' style='vertical-align:middle; margin-bottom:7px;' height='40px' width='40px' alt='people'><br />HOST</a>";										
					echo "</div>";
				echo "</div>";
				
				echo "<div style='float:left; width:100%'>";
					echo "<div style='float:left; width:50%'>";
						echo "<a href='#' class='main_skill btn btn-large btn-primary' id='Bus' style='background-color:#8e080b; float:left; text-align:center; width:80%; text-align:center; margin-left:5%; margin-right:10%; margin-top:10px;'><img src='images/seeprofile.png' style='vertical-align:middle; margin-bottom:7px;' height='40px' width='40px' alt='people'><br />BUSSER</a>";		
					echo "</div>";
					echo "<div style='float:left; width:50%'>";
						echo " &nbsp; ";
					echo "</div>";
				echo "</div>";

	
				if (count($former_jobs) > 0) {
					echo "<h3 style='margin-top:10px; text-align:center'>OR</h3>";			
					echo "<h3 style='margin-bottom:10px; text-align:center'>Repost a job (up to 9-months old):</h3>";	
	
					echo 	"&nbsp; &nbsp; <select id='former_job' style='background-color:#b76163'>";
						echo "<option value='NA'>SELECT FORMER JOB POST</option>";				
						foreach($former_jobs as $row) {
							echo "<option value='".$row['jobID']."'>".$row['title']." - ".date('M j, Y', strtotime($row['date_created']))."</option>";
						}
					echo "</select><br />";	
				}	
		echo "</div>";
		
		if ($current_posts > 0) {								
			echo "<div style='width:100%; text-align:center; float:left; margin-bottom:15px; margin-top:12px; display:none' class='foh_main_back'><a href='#' class='btn btn-primary selection_back' id='foh_back'> Back </a></div>";
		}
		
	echo "</div>";													
		
?>					
			<div id='job_template_holder' class='job_post_holder' style='width:100%'>	
			
				<div class='job_templates' style='width:100%; float:left; text-align:center; margin-top:30px;'> </div>
				<div style='width:100%; float:left; text-align:center; margin-top:10px'> <a href='#' class='different job_type_graphic <? echo $back ?>' style='display:none;'><i>BACK</i></a></div>
			
			</div>
		</div>
	</div>
<?php
	echo "</div>";

		echo "<div class='job_post_holder' style='float:left; width:96%; margin-bottom:0px; margin-top:0px;'>";
			if($group_details['post_status'] != "posted") {
				echo "<table class='job_post_holder' style='width:100%'>";
					echo "<tr>";
						echo "<td style='width:80%'><h3 style='margin-bottom:0px;'> &nbsp; &nbsp; &nbsp; &nbsp; TOTAL COST</h3></td>";
						echo "<td align='right'><h3 style='margin-bottom:0px; text-align:center;'><span id='cost'>".$cost."</span></h3></td>";
					echo "</tr>";
				echo "</table>";	
			}
			
			if ($region_status != "free") {
				if ($group_details['post_status'] != "posted") {
				
					echo "<div class='job_post_holder' style='width:100%; float:left; margin-top:5px; text-align:center;'>";
					if ($checkout_test == "Y") {
						echo "<i>By clicking 'Checkout and Post' you agree to our full <a href='index.php?page=TOS'>Terms of Service</a> and <a href='index.php?page=privacy_policy'>Privacy Policy</a></i><br />";
						echo "&nbsp; <br />";
	
						if ($email_verification == "Y") {
		 					echo "<a href='#' class='btn btn-large btn-primary checkout_holder' id='customButton' style='background-color:#2e6652;'> <img src='images/savegreen.png' height='25px' width='25px' alt='check' style='vertical-align:middle'> CHECKOUT & POST JOB(S)</a>";									
						} else {
		 					echo "<a href='#' class='btn btn-large btn-primary checkout_holder' id='verify_email_warning' style='background-color:#2e6652;'> <img src='images/savegreen.png' height='25px' width='25px' alt='check' style='vertical-align:middle'> CHECKOUT & POST JOB(S)</a>";										
						}					
	
						echo "&nbsp; <br />";
						echo "<br />";
						echo "<img src='images/outline.png' height='26px' width='119px' alt='stripe' ><br />";
													
					
					} else {
						echo "<a href='#' class='btn btn-large btn-primary checkout_holder' id='no_save' style='background-color:grey;'>Checkout and Post Job(s)</a><br /> &nbsp; <br />";
						echo "<font color='red'><i>You must select at least ".$remain_text." openings to check out with this type of post.</i></font><br /> &nbsp; <br />";					
					}
	
					echo "**<i>Craigslist Group posts are typically published on the next available Tuesday or Thursday, based on the number of current regional posts.</i>";				
					echo "&nbsp; <br />";
				}
				
/*
				echo "<div class='job_post_holder' style='width:100%; float:left; margin-top:10px; text-align:center;'>";
				if ($checkout_test == "Y") {
					echo "<i>By clicking 'Checkout and Post' you agree to our full <a href='index.php?page=TOS'>Terms of Service</a> and <a href='index.php?page=privacy_policy'>Privacy Policy</a></i><br />";
					echo "&nbsp; <br />";

					if ($email_verification == "Y") {
	 					echo "<a href='#' class='btn btn-large btn-primary checkout_holder' id='customButton' style='background-color:#2e6652;'> <img src='images/savegreen.png' height='25px' width='25px' alt='check' style='vertical-align:middle'> CHECKOUT & POST JOB(S)</a>";									
					} else {
	 					echo "<a href='#' class='btn btn-large btn-primary checkout_holder' id='verify_email_warning' style='background-color:#2e6652;'> <img src='images/savegreen.png' height='25px' width='25px' alt='check' style='vertical-align:middle'> CHECKOUT & POST JOB(S)</a>";										
					}					

					echo "&nbsp; <br />";
					echo "<br />";
					echo "<img src='images/outline.png' height='26px' width='119px' alt='stripe' ><br />";
				} else {
					echo "<a href='#' class='btn btn-large btn-primary checkout_holder' id='no_save' style='background-color:grey;'>Checkout and Post Job(s)</a><br /> &nbsp; <br />";
					echo "<font color='red'><i>You must select at least ".$remain_text." jobs to check out with this type of post.</i></font>";					
					echo "&nbsp; <br />";
				}

				echo "**<i>Craigslist Group posts are typically published on the next available Tuesday or Thursday, based on the number of current regional posts.</i>";				
				echo "&nbsp; <br />";
*/
							
				
			} else {
				if ($group_details['post_status'] != "posted") {
					echo "<div class='job_post_holder' style='width:100%; float:left; margin-top:5px; text-align:center;'>";
					if ($checkout_test == "Y") {
						echo "<i>By clicking 'Post' you agree to our full <a href='index.php?page=TOS'>Terms of Service</a> and <a href='index.php?page=privacy_policy'>Privacy Policy</a></i><br />";
						echo "&nbsp; <br />";
	
						if ($email_verification == "Y") {
		 					echo "<a href='#' class='btn btn-large btn-primary checkout_holder' id='free_post' style='background-color:#2e6652;'> <img src='images/savegreen.png' height='25px' width='25px' alt='check' style='vertical-align:middle'> POST JOB(S)</a>";									
						} else {
		 					echo "<a href='#' class='btn btn-large btn-primary checkout_holder' id='verify_email_warning' style='background-color:#2e6652;'> <img src='images/savegreen.png' height='25px' width='25px' alt='check' style='vertical-align:middle'> POST JOB(S)</a>";										
						}					
						echo "&nbsp; <br />";
						echo "<br />";
	
					} else {
						echo "<a href='#' class='btn btn-large btn-primary checkout_holder' id='no_save' style='background-color:grey;'>Post Job(s)</a><br /> &nbsp; <br />";
						echo "<font color='red'><i>You must select at least ".$remain_text." jobs to check out with this type of post.</i></font>";					
					}				
				}

/*
				echo "<div class='job_post_holder' style='width:100%; float:left; margin-top:5px; text-align:center;'>";
				if ($checkout_test == "Y") {
					echo "<i>By clicking 'Post' you agree to our full <a href='index.php?page=TOS'>Terms of Service</a> and <a href='index.php?page=privacy_policy'>Privacy Policy</a></i><br />";
					echo "&nbsp; <br />";

					if ($email_verification == "Y") {
	 					echo "<a href='#' class='btn btn-large btn-primary checkout_holder' id='free_post' style='background-color:#2e6652;'> <img src='images/savegreen.png' height='25px' width='25px' alt='check' style='vertical-align:middle'> POST JOB(S)</a>";									
					} else {
	 					echo "<a href='#' class='btn btn-large btn-primary checkout_holder' id='verify_email_warning' style='background-color:#2e6652;'> <img src='images/savegreen.png' height='25px' width='25px' alt='check' style='vertical-align:middle'> POST JOB(S)</a>";										
					}					
					echo "&nbsp; <br />";
					echo "<br />";

				} else {
					echo "<a href='#' class='btn btn-large btn-primary checkout_holder' id='no_save' style='background-color:grey;'>Post Job(s)</a><br /> &nbsp; <br />";
					echo "<font color='red'><i>You must select at least ".$remain_text." jobs to check out with this type of post.</i></font>";					
				}				
*/
			}	
			
		echo "</div>";	
	echo "</div>";
	
					echo "<div id='verification_warning' style='float:left; text-align:center; margin-top:100px; width:100%; display:none;'>";
						echo "<h4>You must verify your email address by clicking the link sent to <b>".$email."</b></h4>";
						echo "<i>You only need to do this for your first job post.</i><br />";
						
						echo "<br />";
						echo "<a href='#' class='verify_email_warning_back'><h4>BACK</h4></a>";
						echo "<br />";
						echo "<br />";
						echo "To resend or change your email address <br /> <a href='main.php?page=verify_email'><h4>CLICK HERE</h4></a>";
					echo "</div>";
			

					echo "<div id='payment_loader' style='float:left; margin-top:100px; width:100%; display:none;'>";
						echo "<div style='float:left; width:100%; text-align:center; margin-top:60px;'>";
							echo "<h2>Processing Payment..</h4>";
							echo "<h4>This may take a few minutes</h4>";
							echo "<h4>PLEASE DO NOT PRESS THE BACK BUTTON</h4>";
						echo "</div>";
					echo "</div>";
					
					echo "<div id='free_loader' style='float:left; margin-top:-200px; width:100%; display:none;'>";
						echo "<div style='float:left; width:100%; text-align:center; margin-top:60px;'>";
							echo "<h2>Posting Jobs....</h4>";
							echo "<h4>This may take a few minutes</h4>";
							echo "<h4>PLEASE DO NOT PRESS THE BACK BUTTON</h4>";
						echo "</div>";
					echo "</div>";					
				
					echo "<div id='payment_error' style='float:left; margin-top:100px; width:100%; display:none;'>";
						echo "<div style='float:left; width:100%; text-align:center; margin-top:40px;'>";
							echo "<h2>Payment Error</h4>";
							echo "<h4>There was a problem processing your payment</h4>";
							echo "<h4>Please click BACK or refresh your page.</h4>";
							echo "<b>Contact:  admin@servebartendcook.com</b>";
						echo "</div>";
					echo "</div>";
}

function job_html_employer_new_mobile($storeID, $store_array, $former_jobs) {	

	echo 	"<div class='main_box' style='margin-top:80px; width:100%;'>";
	echo 	"<h1 style='text-align:center;'>Create New Job</h1>";

	echo "<div style='width:100%; text-align:center'>";
		echo "<h3>Location:</h3>";
		
			echo 	"<select id='storeID' style='background-color:#b76163'>";
				if (count($store_array) > 0) {
					foreach($store_array as $row) {
						if ($row['storeID'] == $storeID) {
							$selected = "selected";
						} else {
							$selected = "";
						}
						echo "<option value='".$row['storeID']."' ".$selected." >".$row['name']."</option>";
					}
				}
				echo "<option value='new'>CREATE NEW LOCATION</option>";								
			echo "</select><br />";	
	
			echo "<div id='store_warning' style='width:100%; float:left; display:none; color:red'>Please choose a valid Store Location.</div>";	
			echo "<div id='store_count_warning' style='width:100%; float:left; display:none; color:red'>You have reached the maximum open jobs (10) for this location.  Please mark a job as filled to post a new job.<br /></div>";

		echo "<div id='job_type_holder' style='width:100%; float:left;'>";			
			echo "<h3>Job Category: </h3>";		
		
			echo "<a href='#' class='main_skill' id='Bartender'><img src='images/main-bar.png' height='120px' style='margin-left:5px; '></a>";	
			echo "<a href='#' class='main_skill' id='Manager'><img src='images/main-manager.png' height='120px' style='margin-left:5px;'></a>";																			
			echo "<a href='#' class='main_skill' id='Server'><img src='images/main-server.png' height='120px' style='margin-left:5px;'></a>";										
			echo "<a href='#' class='main_skill' id='Kitchen'><img src='images/main-cook.png' height='120px' style='margin-left:5px;'></a>";										
			echo "<a href='#' class='main_skill' id='Host'><img src='images/main-host.png' height='120px' style='margin-left:5px;'></a>";										
			echo "<a href='#' class='main_skill' id='Bus'><img src='images/main-bus.png' height='120px' style='margin-left:5px;'></a>";		

			if (count($former_jobs) > 0) {
				echo "<h3 style='margin-top:10px; text-align:center'>OR</h3>";			
				echo "<h3 style='margin-bottom:10px; text-align:center'>Repost a job (up to 9-months old):</h3>";	

				echo 	"&nbsp; &nbsp; <select id='former_job' style='background-color:#b76163'>";
					echo "<option value='NA'>SELECT FORMER JOB POST</option>";				
					foreach($former_jobs as $row) {
						echo "<option value='".$row['jobID']."'>".$row['title']." - ".date('M j, Y', strtotime($row['date_created']))."</option>";
					}
				echo "</select><br />";	
			}	
		echo "</div>";													
		
?>					
		<div id='job_template_holder' style='width:100%'>	
		
			<div class='job_templates' style='width:100%; float:left; text-align:center; margin-top:30px;'> </div>
		
			<div style='width:100%; float:left; text-align:center;'> 
				<br /><hr><a href='#' class='different job_type_graphic back' style='display:none;'><i>Click to choose a different type</i></a>
			</div>
		</div>
	</div>
</div>
<?php
}

function job_html_employer_no_store_mobile($company) {
	
		$utilities = new Utilities;
		$store_types = $utilities->store_types;	
	
		echo 	"<div class='main_box' style='margin-top:80px; width:100%;'>";
?>	
		<h1 style='text-align:center; margin-bottom:3px;'>Create New Job</h1>

		<div style='margin-left:3px; width:98%;'><font style='color:#760006'><i>First you need to create a location for your business.<br />(You only need to do this for your first job post, you can use the same location for future job posts.)</i></font></div><br />
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
						<tr>
							<td><b>Business Type: &nbsp; </b></td>
							<td><select id="description" style='background-color:#b76163;'>
									<option value='0'>--Location Type--</option>																	
<?php
										foreach ($store_types as $type) {
											echo "<option value='".$type."'>".$type."</option>";
										}
?>					
								</select>
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
<?php		
	}

function job_html_employer_template_edit_mobile($page, $job_data, $store_array, $sub_specialty_array, $template_requirements_array, $template_questions_array) {					
	$utilities = new Utilities;				
//==================================
//!  First break master arrays into trait arrays
//
//  Modify any data for presentation
//==================================

		$jobID							= $job_data['general']['jobID'];
		$store_name					= $job_data['store']['name'];
		$storeID						= $job_data['store']['storeID'];
		$title		 						= $job_data['general']['title'];
		$requirements		 		= $job_data['requirements'];
		$notes							= $job_data['general']['description'];
		$qualifications				= $$job_data['general']['qualifications'];
		$main_skill		 			= $job_data['skills']['main_skill']['specialty'];
		$specialtyID			 		= $job_data['skills']['main_skill']['ID'];
		$benefits						= $job_data['general']['benefits'];
		$benefits_desc				= $job_data['general']['benefits_desc'];
		$schedule						= $job_data['general']['schedule'];
		$comp_type					= $job_data['general']['comp_type'];
		$comp_value					= $job_data['general']['comp_value'];
		$question_array				= $job_data['question_list']['questions'];
		$answer_array				= $job_data['question_list']['answers'];	
		$sub_skills						= $job_data['skills']['sub_skills'];
		$employment					= $job_data['general']['past_employment'];
		$intern							= $job_data['general']['intern'];
		$date_created				= $job_data['general']['date_created'];
		$expiration_date			= $job_data['general']['expiration_date'];

		if ($page == "Expired") {
			$job_status = "Expired";
		} else {
			$job_status = $job_data['general']['job_status'];			
		}		
		
		$comp_alert = "";
		switch($comp_type) {
			default:
				$compensation = $comp_type;
			break;
			
			case "Hourly":
				$compensation = "$".$comp_value."/hr";
				if ($comp_value == 0) {
					$comp_alert - "<b><font color='red'>!</font></b>";
				}
			break;
			
			case "Salary":
				$compensation = "Salary:  $".$comp_value."/yr";
				if ($comp_value == 0) {
					$comp_alert - "<b><font color='red'>!</font></b>";
				}				
			break;				
		}		

		if ($benefits == "Y") {
			$benefits_text =	"Yes<br /><i>".$benefits_desc."</i><br />";
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
		
		if ($employment == "") {
			$employment = "N";
		}
		
		if ($intern == "") {
			$intern = "N";
		}		
		
		if ($notes == "") {
			$notes_text = "<i>None Entered</i>";
		} else {
			$notes_text = $notes;
		}

//==================================
//!  Display
//
//  Display is broken into separate functions for each specific section, this is for the use of AJAX to reload specific section of page on changes
//
//==================================

	echo "<div class='main_box'>";
			if ($job_status == "Open") {
				//echo "<div style='float:left; margin-top:15px; text-align:center; width:100%;'><a href='#' id='".$jobID."' class='close_job btn btn-primary'>Mark Job as Filled</a> &nbsp; &nbsp; <a href='opportunity.php?ID=".$jobID."' class='btn btn-primary'>View Job Post</a></div><br /> &nbsp; <br />";		
				echo "<div style='float:left; margin-top:15px; text-align:center; width:100%;'><a href='opportunity.php?ID=".$jobID."' class='btn btn-primary'>View Job Post</a></div><br /> &nbsp; <br />";				
			} elseif ($job_status == "Expired") {
				echo "<div style='float:left; margin-top:15px; text-align:center; width:100%;'><h4>This Posting Has Expired</h4></div>";		
			} elseif ($job_status == "Filled") {
				//echo "<div style='float:left; margin-top:0px; margin-bottom:5px; text-align:center; width:100%;'><h4 style='margin-top:10px;'>Position Filled</h4> <a href='#' id='".$jobID."' class='unfill btn btn-primary'>Mark as Open</a></div><br /> &nbsp; <br />";		
				echo "<div style='float:left; margin-top:0px; margin-bottom:5px; text-align:center; width:100%;'><h4 style='margin-top:10px;'>Position FIlled</div><br />";		
			} else {
				echo "<h3 style='text-align:center; margin-top:25px; margin-bottom:5px;'>Review and Edit Job Details</h4>";	
				echo "<div style='width:100%; float:left; text-align:center'><b>Any items marked with <b><font color='red'>!</font></b> need to be completed</b></div><br />";				
			}
			
			if ($job_status == "Open" || $job_status == "Filled" || $job_status == "Filled") {
/*
				echo "<div style='float:left; width:100%; margin-left:5px; margin-bottom:-15px; margin-top:-45px;'><br /> &nbsp;<h4>Posted: ".date('m-d-Y', strtotime($date_created))."</h4>";
				echo "<h4 style='margin-top:-15px;'>Expiration: ".date('m-d-Y', strtotime($expiration_date))."</h4></div>";
*/

				echo "<div style='float:left; width:100%; margin-left:5px; margin-bottom:-15px; margin-top:0px;'><h4>Posted: ".date('m-d-Y', strtotime($date_created))."</h4>";
				echo "<h4 style='margin-top:-15px;'>Expiration: ".date('m-d-Y', strtotime($expiration_date))."</h4></div>";
			}

			echo	"<table class='dark' style='width:100%;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle' style='text-align:left;' width='80%'>General Details</th>";
				echo "<th style='text-align:center; background-color:#DBDCCE;'><a href='#' id='edit_general' style='color:#5D0000;'>EDIT</a></th>";
				echo "</tr>";			
			echo "</table>";
			
			echo "<div class='general_data_holder' style=width:100%; float:left;'>";			
				display_general_section_mobile($title, $store_array, $storeID, $store_name, $schedule, $compensation, $comp_type, $comp_value, $benefits, $benefits_text, $benefits_desc, $intern, $employment, $main_skill);	
			echo "</div>";

			echo "<div class='general_data_loading' style='display:none; text-align:center; width:100%; float:left; margin-top:30px; margin-bottom:20px;'>";
				echo "<h1>LOADING.....</h1>";
			echo "</div>";

			echo	"<table class='dark' style='width:100%;'>";
				echo "<tr valign='middle'>";
				if ($job_status == "Open" || $job_status == "Filled" || $job_status == "Expired") {
					echo "<th valign='middle' style='text-align:left;'>PREFERRED JOB SKILLS</th>";
				} else {
					echo "<th valign='middle' style='text-align:left;' width='80%'>PREFERRED SKILLS</th>";					
					echo "<th style='text-align:center; background-color:#DBDCCE;'><a href='#' id='edit_skills' style='color:#5D0000;'>EDIT</a></th>";
				}				
				echo "</tr>";			
			echo "</table>";
	
			echo "<div class='skills_data_holder' style=width:100%; float:left;'>";		
				display_skills_section_mobile($job_status, $main_skill, $main_skill_image, $specialtyID, $sub_specialty_array, $sub_skills);			
			echo "</div>";
			
			echo "<div class='skills_data_loading' style='display:none; text-align:center; width:100%; float:left; margin-top:30px; margin-bottom:20px;'>";
				echo "<h1>LOADING.....</h1>";
			echo "</div>";
					
			echo	"<table class='dark' style='width:100%;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle' style='text-align:left;' width='80%'>OTHER REQUIREMENTS</th>";
				echo "<th style='text-align:center; background-color:#DBDCCE;'><a href='#' ID='edit_requirements' style='color:#5D0000;'>EDIT</a></th>";
				echo "</tr>";			
			echo "</table>";

			echo "<div class='requirements_data_holder' style=width:100%; float:left;'>";		
				display_requirements_section_mobile($requirements, $template_requirements_array, $main_skill);			
			echo "</div>";
		
			echo "<div class='requirements_data_loading' style='display:none; text-align:center; width:100%; float:left; margin-top:30px; margin-bottom:20px;'>";
				echo "<h1>LOADING.....</h1>";
			echo "</div>";

			echo	"<table class='dark' style='width:100%;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle' style='text-align:left;' width='80%'>OTHER INFO</th>";
				echo "<th style='text-align:center; background-color:#DBDCCE;'><a href='#' ID='edit_notes' style='color:#5D0000;'>EDIT</a></th>";
				echo "</tr>";			
			echo "</table>";

			echo "<div class='general_data_holder' style=width:100%; float:left;'>";					
				display_notes_section_mobile($notes, $notes_text);
			echo "</div>";

			echo "<div class='general_data_loading' style='display:none; text-align:center; width:100%; float:left; margin-top:30px; margin-bottom:20px;'>";
				echo "<h1>LOADING.....</h1>";
			echo "</div>";

			echo	"<table class='dark' style='width:100%;'>";
				echo "<tr valign='middle'>";
				if ($job_status == "Open" || $job_status == "Filled" || $job_status == "Expired") {
					echo "<th valign='middle' style='text-align:left;'>QUESTIONS</th>";
				} else {
					echo "<th valign='middle' style='text-align:left;' width='80%'>QUESTIONS</th>";
					echo "<th style='text-align:center; background-color:#DBDCCE;'><a href='#' ID='edit_questions' style='color:#5D0000;'>EDIT</a></th>";		
				}
				echo "</tr>";			
			echo "</table>";


			echo "<div class='questions_data_holder' style=width:100%; float:left;'>";					
				display_questions_section_mobile($job_status, $question_array, $template_questions_array, $main_skill);			
			echo "</div>";
			
			echo "<div class='questions_data_loading' style='display:none; text-align:center; width:100%; float:left; margin-top:30px; margin-bottom:20px;'>";
				echo "<h1>LOADING.....</h1>";
			echo "</div>";
		
		echo "&nbsp; <br />";	
		echo "&nbsp; <br />";	

		echo	"<table class='dark' style='width:100%;'>";
			echo "<tr valign='middle'>";
			echo "<th valign='middle'></th>";
			echo "</tr>";			
		echo "</table>";

		if ($comp_type == "") {
			echo "<div style='color:red; float:left; '><h4>Please complete the fields above marked with '!'</h4></div><br />";		
		} else {
			if ($job_status == "Open") {
				echo "<div style='float:left; width:100%; text-align:center;'> &nbsp; <br /><a href='job.php?ID=".$jobID."' class='btn btn-large btn-primary' >SAVE & CONTINUE  </a></div><br /> &nbsp; <br />";			
			} elseif ($job_status == "Filled") {
				//echo "<h2 style='display:inline; float:left; margin-top:15px;'> &nbsp;TO SAVE EDITS PLEASE 'UNFILL' POSITION ABOVE</h2>";	
			} elseif ($job_status == "Expired") {
				echo "<div style='float:left; margin-top:10px; text-align:center; width:100%;'><h4>This job post has expired</h4></div>";
			} else {
				echo "<div id='complete_error' style='color:red; float:left; display:none'>Please make sure that all fields above are complete, and you've clicked 'save' for each of them.</div><br />";		
				echo "<div id='open_warning' style='color:red; float:left; margin-bottom:10px; width:100%; text-align:center; display:none'><b>Please click 'Save' or 'Cancel' on these sections above:</b><br />";		
					echo "<div id='edit_general_form_warning' class='open_warning_holder' style='float:left; text-align:center; display:none; width:100%;'><b>GENERAL DETAILS</b><br /></div>";
					echo "<div id='edit_skills_form_warning' class='open_warning_holder' style='float:left; text-align:center; display:none; width:100%;'><b>PREFERRED SKILLS</b><br /></div>";
					echo "<div id='edit_requirements_form_warning' class='open_warning_holder' style='float:left; text-align:center; display:none; width:100%;'><b>OTHER REQUIREMENTS</b><br /></div>";
					echo "<div id='edit_notes_form_warning' class='open_warning_holder' style='float:left; text-align:center; display:none; width:100%;'><b>OTHER INFO</b><br /></div>";
					echo "<div id='edit_questions_form_warning' class='open_warning_holder' style='float:left; text-align:center; display:none; width:100%;'><b>QUESTIONS</b><br /></div>";
				echo "</div>";
				echo "<div style='width:100%; margin-bottom:15px; margin-top:8px; width:100%; text-align:center; float:left;'><a href='opportunity.php?ID=".$jobID."' class='btn btn-primary'>Preview Job Post</a></div>";
				echo "<div style='float:left; width:100%; text-align:center;'> &nbsp; <br /><a href='#' class='continue btn btn-large btn-primary' >NEXT STEP</a> <br /> &nbsp; <br /><a href='#' class='remove_job' id='".$_GET['ID']."'>Delete Job</a></div>&nbsp; <br />";			
	
			}
		}								
		
		echo	"<table class='dark' style='width:100%; margin-top:2px;'>";
			echo "<tr valign='middle'>";
			echo "<th valign='middle'></th>";
			echo "</tr>";			
		echo "</table>";
	
		echo "</div>";
	echo "</div>";	

	echo "<div id='remove_job_form' style='margin-top:100px; text-align:center; display:none;'>";
		echo "<b>Do you want to fully delete this entire job post?</b><br /> &nbsp; <br />";
		echo "<a href='#' id='delete_job'>Delete Job</a> | <a href='#' id='cancel_delete'>Cancel</a>";
	echo "</div>";
	
	echo "<div id='close_job_form' style='margin-top:100px; margin-left:3px; margin-right:3px; text-align:center;display:none'>";
		echo "Marking the position as 'Filled' and candidates will no longer be able to respond to the job.</br>";
		echo "&nbsp; <br />";
		echo "You will also NOT be able to view any more resumes associated with this posting.</br> &nbsp; <br />";
		echo "<b><a href='#' id='close_job_action'>Mark as Filled</a> | <a href='#' class='cancel_fill'>Cancel</a></b>";
	echo "</div>";	
	
	echo "<div id='unfill_form' style='margin-top:100px;  margin-left:3px; margin-right:3px;  text-align:center;display:none'>";
		echo "This will change the status of the position to 'Open'.  The listing will still expire on the original expiration date.</br>";
		echo "&nbsp; <br />";
		echo "<b><a href='#' id='unfill_job_action'>Mark as Open</a> | <a href='#' class='cancel_unfill'>Cancel</a></b>";
	echo "</div>";													
																													
}

//SEPARATE DISPLAY SECTIONS FOR AJAX
function display_general_section_mobile($title, $store_array, $storeID, $store_name, $schedule, $compensation, $comp_type, $comp_value, $benefits, $benefits_text, $benefits_desc, $intern, $employment, $main_skill) {
	echo "<div id='general_holder' style='width:100%; margin-top:10px; float:left; font-size:1.125em'>";
		echo "<div id='title_holder' style='width:100%; margin-top:10px; float:left; font-size:1.125em'>";
			echo "<div style='float:left; width:140px;'><img src='images/job-video.png' id='title_image' class='arrow_image' style='vertical-align:top'>&nbsp; <b>Job Title:</b> </div>";
			echo "<div id='title_current' class='current' style='float:left; width:50%; margin-left:5px;'>".$title."</div>";
			echo "<div id='title_form' class='form' style='display:none; margin-left:25px; float:left; vertical-align:top; width:100%;'>";
				echo "<input type='text' id='title_input' value='".$title."'>";
				echo "<div id='title_error' class='error' style='color:red; display:none; float:left; padding-left:5px;'>Field cannot be blank</div><br />";
			echo "</div>";
		echo "</div><br />";
	
		echo "<div id='store_holder' style='width:100%; margin-top:10px; float:left; font-size:1.125em'>";
			echo "<div style='float:left; width:140px;'><img src='images/job-video.png' class='arrow_image' id='store_image' style='vertical-align:middle'>&nbsp; <b>Location:</b></div>    <div id='store_current' class='current' style='float:left; width:50%; margin-left:5px;' >".$store_name."</div>";
			echo "<span id='store_form' style='display:none; float:left; vertical-align:top; margin-left:25px; width:100%;' class='form'><select id='store_input'>";
			$selected = "";
			foreach($store_array as $row) {
				if ($row['storeID'] == $storeID) {
					$selected = "selected";
				} else {
					$selected = "";
				}
				echo "<option value='".$row['storeID']."' $selected >".$row['name']."</option>";
			}
			echo "</select>";			
			echo "<div id='location_error' class='error' style='color:red; display:none; float:left; padding-left:5px;'>An error occurred, please try again or contact admin@servebartendcook.com</div><br />";
		echo "</div>";	

		echo "<div id='schedule_holder' style='width:100%; margin-top:10px; float:left; font-size:1.125em'>";		
			echo "<div style='float:left; width:150px;'><img src='images/job-video.png' class='arrow_image' id='schedule_image'>&nbsp; <b>Schedule:</b></div> <span id='schedule_current' class='current' >".$schedule."</span>";
				echo "<span id='schedule_form' style='display:none; float:left; vertical-align:top; width:100%; margin-left:25px;' class='form'><select id='schedule_input'>";
					if ($schedule == "Full Time") {
						echo "<option value='Full Time' selected>Full Time</option>";
					} else {
						echo "<option value='Full Time'>Full Time</option>";							
					}
					if ($schedule == "Part Time") {
						echo "<option value='Part Time' selected>Part Time</option>";
					} else {
						echo "<option value='Part Time'>Part Time</option>";							
					}						
					if ($schedule == "Temporary") {
						echo "<option value='Temporary' selected>Temporary</option>";
					} else {
						echo "<option value='Temporary'>Temporary</option>";							
					}						
				echo "</select>";	
				echo "<div id='schedule_error' class='error' style='color:red; display:none; float:left; padding-left:5px;'>An error occurred, please try again or contact admin@servebartendcook.com</div><br />";
		echo "</div>";	

	if ($comp_value == "") {
		$comp_value = 0;
	}
	
	if ($comp_type == "") {
		$empty_warning_symbol = "<b><font color='red'>!</font></b>";
		$empty_warning = "<div style='color:red; float:left; width:100%; margin-left:25px;'>This Field Must be Completed</div>";
		$input_display = "display:none";
	} elseif ($comp_type == "Hourly" && $comp_value == "0"){
		$empty_warning_symbol = "<b><font color='red'>!</font></b>";
		$empty_warning = "<div style='color:red; float:left; width:100%; margin-left:25px;'>This Field Must be Completed</div>";
		$input_display = "display:none";
	} elseif ($comp_type == "Salary" && $comp_value == "0"){
		$empty_warning_symbol = "<b><font color='red'>!</font></b>";
		$empty_warning = "<div style='color:red; float:left; width:100%; margin-left:25px;'>This Field Must be Completed</div>";
		$input_display = "display:none";
	} else {
		$empty_warning_symbol = "";
		$empty_warning = "";	
		$input_display = "display:none";			
	}
	
	echo "<div id='compensation_holder' style='width:100%; margin-top:10px; float:left; font-size:1.125em'>";					
		echo "<div style='float:left; width:150px;'><img src='images/job-video.png' class='arrow_image' id='compensation_image'>&nbsp; ".$empty_warning_symbol." <b>Compensation:</b></div> <span id='compensation_current' class='current' >".$compensation."</span>";
			echo "<span id='compensation_form' style='float:left; vertical-align:top; width:100%; margin-left:25px; ".$input_display."' class='form'><select id='compensation_type_input'>";
				$comp_display = "style='display:none'";
				if ($comp_type == "Min Wage Plus Tips") {
					echo "<option value='Min Wage Plus Tips' selected>Min Wage Plus Tips</option>";
				} else {
					echo "<option value='Min Wage Plus Tips'>Min Wage Plus Tips</option>";							
				}
				if ($comp_type == "Min Wage") {
					echo "<option value='Min Wage' selected>Min Wage</option>";
				} else {
					echo "<option value='Min Wage'>Min Wage</option>";							
				}						
				if ($comp_type == "Hourly" || $comp_type == "") {
					$comp_display = "";
					echo "<option value='Hourly' selected>Hourly</option>";
				} else {
					echo "<option value='Hourly'>Hourly</option>";							
				}
				if ($comp_type == "Salary") {
					$comp_display = "";
					echo "<option value='Salary' selected>Salary</option>";
				} else {
					echo "<option value='Salary'>Salary</option>";							
				}						
				if ($comp_type == "Negotiable") {
					echo "<option value='Negotiable' selected>Negotiable</option>";
				} else {
					echo "<option value='Negotiable'>Negotiable</option>";							
				}																		
			echo "</select>";
			echo "<span id='comp_value_holder' $comp_display > $<input type='text' id='compensation_value_input' value='".$comp_value."' style='width:60px'></span>";			
			echo $empty_warning; 
			echo "<div id='compensation_error' class='error' style='color:red; display:none; float:left; padding-left:5px;'>Amount cannot be blank and can only contain numbers.</div><br />";
		echo "</div>";	

		if ($main_skill == "Kitchen") {
			echo "<div id='intern_holder' style='width:100%; margin-top:10px; float:left; font-size:1.125em'>";		
				echo "<img src='images/job-video.png' class='arrow_image'  id='intern_image'> &nbsp; <b>Allow Culinary School Interns:</b>  <span id='intern_current' class='current' >".$intern."</span>";
				echo "<span id='intern_form' style='display:none; float:left; vertical-align:top; width:100%; margin-left:25px;' class='form'><select id='intern_input'>";
					if ($intern == "Y") {
						echo "<option value='Y' selected>Y</option>";
						echo "<option value='N'>N</option>";							
					} else {
						echo "<option value='N' selected>N</option>";
						echo "<option value='Y'>Y</option>";							
					} 								
				echo "</select>";			
			echo "</div>";
		}	

		echo "<div id='benefits_holder' style='width:100%; margin-top:10px; float:left; font-size:1.125em'>";					
			echo "<div style='float:left; width:150px;'><img src='images/job-video.png' class='arrow_image' id='benefits_image'>&nbsp; <b>Benefits:</b></div>";  
			echo "<div style='width:85%; float:left; margin-left:35px; margin-right:5px;' id='benefits_current' class='current' >".$benefits_text."</div>";
				echo "<div id='benefits_form' style='display:none; float:left; vertical-align:top; width:100%; margin-left:25px;' class='form'><select id='benefits_input'>";
					$benefits_display = "style='display:none; float:left; width:100%;'";
					if ($benefits == "Y") {
						echo "<option value='Y' selected>Yes</option>";
						$benefits_display = "float:left; width:100%;'";					
					} else {
						echo "<option value='Y'>Yes</option>";							
					}
					if ($benefits == "N" || $benefits == "") {
						echo "<option value='N' selected>None</option>";
					} else {
						echo "<option value='N'>None</option>";							
					}						
				echo "</select>";
				echo "<div id='benefits_desc_holder' $benefits_display ><i>Please enter a brief description of benefits.</i><br /><textarea style='width:275px;' cols='200' rows='2' id='benefits_desc_input'>".$benefits_desc."</textarea></div>";			
				echo"</div>";
			echo "</div>";	

		echo "<div id='employment_holder' style='width:100%; margin-top:10px; margin-bottom:10px; float:left; font-size:1.125em'>";		
			echo "<img src='images/job-video.png' class='arrow_image' id='employment_image'> &nbsp; <b>Require Past Employment on Profile/Application:</b>  <span id='employment_current' class='current' >".$employment."</span>";
			echo "<span id='employment_form' style='display:none; float:left; vertical-align:top; width:100%; margin-left:25px;' class='form'><select id='employment_input'>";
					if ($employment == "Y") {
						echo "<option value='Y' selected>Y</option>";
						echo "<option value='N'>N</option>";							
					} else {
						echo "<option value='N' selected>N</option>";
						echo "<option value='Y'>Y</option>";							
					} 								
				echo "</select>";			
		echo "</div>";
		echo "<input type='hidden' id='main_skill_hidden' value='".$main_skill."'>";
		echo "<div style='width:100%; float:left; margin-left:20px; margin-bottom:12px; display:none' id='general_buttons'><a href='#' id='save_general' class='btn btn-primary'>Save General Details</a> <a href='#' id='done_general' class='btn btn-primary'>Cancel</a> </div>";
			
	echo "</div>";
}

function display_skills_section_mobile($job_status, $main_skill, $main_skill_image, $specialtyID, $sub_specialty_array, $sub_skills) {
			echo "<div id='skill_holder' style='width:100%; float:left; margin-bottom:10px; margin-left:3px;'>";
				if ($job_status == "Open" || $job_status == "Filled" || $job_status == "Expired") {
					echo "<i>Skills cannot be edited on 'Open' job posts.</i>";	
					echo "<div style='width:110px; float:left; text-align:center;'>";
						echo $main_skill_image."<br />";
					echo "</div>";																							
				} else {
					echo "<div id='main_image' style='width:110px; float:left; text-align:center;'>";
						echo $main_skill_image."<br />";
					echo "</div>";										
				}
				
				echo "<div style='float:left; width:60%'>";
					//table for display
					echo "<table id='skill_display' CELLSPACING=2 cellpadding=2 style='color:red;'>";
						foreach($sub_skills as $sub_specialty) {
							echo "<tr>";	
								echo "<td><b> &#x2713; ".$sub_specialty['sub_specialty']."</b></td>";
							echo "</tr>";
						}				
					echo "</table>";				
					
					//table for editing
					echo "<table id='skill_form' CELLSPACING=2 cellpadding=2 style='display:none'>";
					$row_count = 2;
					foreach ($sub_specialty_array as $row) {
						$selection = "unselected";
						foreach($sub_skills as $sub_specialty) {
							if (html_entity_decode($sub_specialty['sub_specialty']) == html_entity_decode($row['skill'])) {
								$selection = "selected";			
							}	
						}
						
						if ($row_count % 2 == 0) {														
							echo "<tr>";					
								echo "<td width='48%'><span class='sub_skill ".$selection."_button' data-sub_skill='".$selection."' data-skill_value='".$row['skill']."' style='cursor:pointer;'><span class='fui-check-inverted' style='color:white; float:left;'></span>".$row['skill']."</span></td>";
						} else {
								echo "<td width='48%'><span class='sub_skill ".$selection."_button' data-sub_skill='".$selection."' data-skill_value='".$row['skill']."' style='cursor:pointer;'><span class='fui-check-inverted' style='color:white; float:left;'></span>".$row['skill']."</span></td>";
							echo "</tr>";
						}
						$row_count++;
						if ($row_count % 2 == 0) {	
							echo "</tr>";
						}											
					}							
				echo "</table>";
				echo "</div>";
				
				echo "<div style='float:left; width:100%; text-align:center; margin-top:10px; margin-bottom:5px;'>";
					echo "<table id='skill_form' style='width:100%' CELLSPACING=2 cellpadding=2>";
						echo "<tr>";
							echo "<td width='48%' align='right'><a href='#' class='save_sub_specialties btn btn-primary' id='".$specialtyID."' data-specialty='".$main_skill."' style='display:none;'>Save Skills</a>";
							echo "<td width='48%'><a href='#' id='done_skills' class='btn btn-primary' style='display:none;'>Cancel</a></td>";
						echo "</tr>";
					echo "</table>";	
				echo "</div>";							
			echo "</div>";
}

function display_requirements_section_mobile($requirements, $template_requirements_array, $main_skill) {
	echo "<div id='requirements_holder' style='float:left; margin-left:5px; margin-bottom:10px; font-size:1.125em'>"	;	

	echo "<div id='requirements' style='float:left; width:100%;'>";	
		if (count($requirements) > 0) {
			foreach ($requirements as $row) {
				echo "<b><a href='#' class='edit_requirements' id='edit_requirements'><img src='images/icon-locations.png' style='vertical-align:middle;' width=30px;></a></b>".$row['requirement']."<br />";
			}				
		} else {
			echo "<i>No Other Requirements Added</i>";
		}
	echo "</div>";
	
	echo "<div style='width:99%; display:none; float:left;' id='requirement_list'>";
				echo "<h3 style='margin-bottom:0px; margin-left:5px;'>General</h3>";
					echo "<table CELLSPACING=6 cellpadding=1>";
					foreach ($template_requirements_array as $row) {
						$selection = "unselected";
						foreach($requirements as $req) {
							if ($req['requirement'] == $row['requirement']) {
								$selection = "selected";								
							}	
						}				
						if ($row['type'] == "General") {								
							echo "<tr>";
							echo "<td width='100%'><span style='width:100%; text-align:left; cursor:pointer;' class='requirement ".$selection."_button' data-requirement='".$selection."' data-requirement_value='".$row['requirement']."'><span class='fui-check-inverted' style='color:white; float:left;'></span> &nbsp; ".$row['requirement']."</span></td>";
							echo "</tr>";
						}
					}								
				echo "</table>";

				if ($main_skill == "Kitchen" || $main_skill == "Manager") {
					echo "<h3 style='margin-bottom:0px; margin-left:5px;'>Back of House</h3>";
						echo "<table CELLSPACING=6 cellpadding=1>";
						foreach ($template_requirements_array as $row) {
							$selection = "unselected";
							foreach($requirements as $req) {
								if ($req['requirement'] == $row['requirement']) {
									$selection = "selected";								
								}	
							}				

							if ($row['type'] == "Back") {							
								echo "<tr>";
								echo "<td width='100%'><span style='width:100%; text-align:left; cursor:pointer;' class='requirement ".$selection."_button' data-requirement='".$selection."' data-requirement_value='".$row['requirement']."'><span class='fui-check-inverted' style='color:white; float:left;'></span> &nbsp; ".$row['requirement']."</span></td>";
								echo "</tr>";
							}
						}								
					echo "</table>";
				}

				if ($main_skill == "Server" || $main_skill == "Manager" || $main_skill == "Bartender" || $main_skill == "Host" || $main_skill == "Bus") {				
					echo "<h3 style='margin-bottom:0px; margin-left:5px;'>Front of House</h3>";
						echo "<table CELLSPACING=6 cellpadding=1>";
						foreach ($template_requirements_array as $row) {
							$selection = "unselected";
							foreach($requirements as $req) {
								if ($req['requirement'] == $row['requirement']) {
									$selection = "selected";								
								}	
							}				

							if ($row['type'] == "Front") {
								echo "<tr>";
								echo "<td width='100%'><span style='width:100%; text-align:left; cursor:pointer;' class='requirement ".$selection."_button' data-requirement='".$selection."' data-requirement_value='".$row['requirement']."'><span class='fui-check-inverted' style='color:white; float:left;'></span> &nbsp; ".$row['requirement']."</span></td>";
								echo "</tr>";
							}
						}								
					echo "</table>";	
				}	
		echo "<div style='float:left; width:100%; margin-top:10px; margin-bottom:5px; margin-left:15px;'>";
			echo "<a href='#' id='save_requirement' class='btn btn-primary'>Save Requirements</a> <a href='#' class='done_requirements btn btn-primary'>Cancel</a> </div>";
		echo "</div>";							
	echo "</div>";
}

function display_questions_section_mobile($job_status, $question_array, $template_questions_array, $main_skill) {
	echo "<div id='question_holder' style='float:left; margin-left:5px; margin-bottom:10px; font-size:1.125em'>";	
	
	if ($job_status == "Open" || $job_status == "Filled" || $job_status == "Expired") { 
		echo "<i>Question cannot be edited on 'Open' job posts.</i><br /> &nbsp; <br />";		
	}
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
				
				if ($job_status == "Open" || $job_status == "Filled") { 
					echo " - ".$row['question']."<br /> &nbsp; <br />";
					$count++;			
				} else {
					echo $question_image." <a href='#' style='display:none' class='remove_question' data-question='".$row['questionID']."'><b>Remove - </b></a>" .$row['question']."<br />";
					$count++;
				}
			}				
		} else {
			echo "<b>No Questions Added</b>";			
		}
		
		 echo "<div style='float:left; display:none' class='strange_holder'>";
	 		//For an bizarre unknown reason, if this div is not here, the maximum questions warning will not appear, but everything else appears properly
	 		//and it has to .show with the div below, it makes no fucking sense at all
	 		echo "&nbsp;";	
		echo "</div>";
	
		
	echo "<div style='width:95%; float:left; display:none; text-align:center;'  class='strange_holder' id='question_list'>";
	//If the user has more than 3 questions, don't allow more
	if (count($question_array) >= 3) {
		echo "<div style='width:95%; float:left;'><b>You have the maximum amount of pre-interview questions.  To add a new one please delete an existing question.</b><br />";
		echo " &nbsp; <br />";
		echo "<a href='#' id='done_questions' class='btn btn-primary'>Cancel</a></div>";
	} else {
			echo "&nbsp; <br />";
			echo "<b>General Questions:</b><br />";
			echo "<select id='general_question' style='width:316px;'>";
				echo "<option value='NA'>--Select a Question--</option>";	
			foreach($template_questions_array as $row) {
				if ($row['type'] == "General") {
					echo "<option value='".$row['questionID']."'>".$row['question']."</option>";	
				}
			}
			echo "</select><br />";
			echo "&nbsp; <br />";
			echo "<b>".$main_skill." Specific Questions:</b><br />";
			echo "<select id='specific_question' style='width:315px;'>";
				echo "<option value='NA'>--Select a Question--</option>";	
			foreach($template_questions_array as $row) {
				if ($row['type'] == $main_skill) {
					echo "<option value='".$row['questionID']."'>".$row['question']."</option>";	
				}
			}
			echo "</select><br />";
			echo "&nbsp; <br />";			
		echo "<b>Or Enter A Question Below: </b><br />";
		echo "<div id='charNum' style='color:red; margin-bottom:2px;'></div>"; //Holder for character counter
		echo "<textarea id='new_question' style='width:95%;' cols='200' rows='2' maxlength='250'></textarea><br />";
		echo "&nbsp; <br />";
		echo "<a href='#' id='save_question' class='btn btn-primary'>Add Question</a> <a href='#' id='done_questions' class='btn btn-primary'>Cancel</a> ";
	}
	echo "</div>";
	echo "</div>";
}

function display_notes_section_mobile($notes, $notes_text) {
		echo "<div id='notes_holder' style='float:left; margin-left:5px; margin-bottom:10px; font-size:1.125em'>";
			echo "<div class='notes_current' style='float:left; padding-left:10px; margin-top:5px;'>".$notes_text."</div>";
			echo "<div id='notes_form' style='display:none; float:left;'>";		
				echo "<textarea id='notes_input' style='width:95%; margin-top:10px;' cols='200' rows='2' maxlength='250'>".$notes."</textarea><br />";
				echo "<div style='margin-top:5px; margin-left:5px; margin-bottom:5px;'>";
					echo "<a href='#' id='save_notes' class='btn btn-primary'>Save Notes</a> <a href='#' id='done_notes' class='btn btn-primary'>Cancel</a> ";
				echo "</div>";
		echo "</div>";
		echo "</div><br />";
}

function job_html_employer_custom_mobile($jobID, $job_data, $store_array, $sub_specialty_array, $template_questions_array, $template_requirements_array) {

		$storeID						= $job_data['store']['storeID'];
		$store_name					= $job_data['store']['name'];
		$main_skill 					= $job_data['skills']['main_skill']['specialty'];
		$specialtyID			 		= $job_data['skills']['main_skill']['ID'];
		$requirements		 		= $job_data['requirements'];
		$question_array				= $job_data['question_list']['questions'];		
		
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

	
//==================================
//!  Display
//
//==================================
		
	echo 	"<div class='main_box' style='margin-top:80px; width:100%;'>";
			echo "<h3 style='text-align:center;'>New Job Post</h4>";
			echo "<div style='text-align:center; width:100%; float:left;'><b><i>All fields are required, unless otherwise noted</i></b></div>";	

			echo	"<table class='dark' style='width:100%;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle' style='text-align:left;'>General Details</th>";
				echo "</tr>";			
			echo "</table>";

			echo "<div id='title_holder' style='width:100%; margin-top:10px; margin-left:5px; margin-right:2px; float:left; font-size:1.125em'>";
				echo "<b>Job Title:</b> <input type='text' id='title_input'>";
				echo "<span id='title_error' class='error' style='color:red; display:none; padding-left:5px;'><br />Field cannot be blank</span><br />";
			echo "</div><br />";

		echo "<div id='store_holder' style='width:100%; margin-top:10px; margin-left:5px; margin-right:2px; float:left; font-size:1.125em'>";
			echo "<b>Location:</b> &nbsp; ".$store_name;
/*
			$selected = "";
			foreach($store_array as $row) {
				if ($row['storeID'] == $storeID) {
					$selected = "selected";
				} else {
					$selected = "";
				}
				echo "<option value='".$row['storeID']."' $selected >".$row['name']."</option>";
			}
			echo "</select>";			
			echo "<div id='location_error' class='error' style='color:red; display:none; float:left; padding-left:5px;'>An error occurred, please try again or contact admin@servebartendcook.com</div><br />";
*/
		echo "</div>";	
		
	echo "<div id='schedule_holder' style='width:100%; margin-top:10px; margin-left:5px; margin-right:2px; float:left; font-size:1.125em'>";		
		echo "<b>Schedule:  </b><select id='schedule_input'>";
				if ($schedule == "Full Time") {
					echo "<option value='Full Time' selected>Full Time</option>";
				} else {
					echo "<option value='Full Time'>Full Time</option>";							
				}
				if ($schedule == "Part Time") {
					echo "<option value='Part Time' selected>Part Time</option>";
				} else {
					echo "<option value='Part Time'>Part Time</option>";							
				}						
				if ($schedule == "Temporary") {
					echo "<option value='Temporary' selected>Temporary</option>";
				} else {
					echo "<option value='Temporary'>Temporary</option>";							
				}						
			echo "</select>";			
			echo "<div id='schedule_error' class='error' style='color:red; display:none; float:left; padding-left:5px;'>An error occurred, please try again or contact admin@servebartendcook.com</div><br />";
		echo "</div>";	
			
	echo "<div id='compensation_holder' style='width:95%; margin-top:10px; margin-left:5px; margin-right:2px; float:left; font-size:1.125em'>";					
			echo "<b>Compensation: </b><select id='compensation_type_input'>";
					echo "<option value='Min Wage Plus Tips'>Min Wage Plus Tips</option>";							
					echo "<option value='Min Wage'>Min Wage</option>";							
					echo "<option value='Hourly'>Hourly</option>";							
					echo "<option value='Salary'>Salary</option>";							
					echo "<option value='Negotiable'>Negotiable</option>";							
			echo "</select>";
			echo "<span id='comp_value_holder' style='display:none;'><br /> &nbsp; &nbsp; &nbsp; $<input type='text' id='compensation_value_input' style='width:60px'></span>";			
			echo "<span id='compensation_error' class='error' style='color:red; display:none; float:left; padding-left:5px;'>Amount cannot be blank and can only contain numbers.</span><br />";
		echo "</div>";	
						
		echo "<div id='benefits_holder' style='width:100%; margin-top:10px; margin-left:5px; margin-right:2px; float:left; font-size:1.125em'>";					
			echo "<b>Benefits:</b>  <select id='benefits_input'>";
				echo "<option value='N'>None</option>";							
				echo "<option value='Y'>Yes</option>";
			echo "</select>";
			echo "<div id='benefits_desc_holder' style='display:none; width100%; text-align:center'><i>Please enter a brief description of benefits.</i><br /><textarea style='width:90%;' cols='200' rows='2' id='benefits_desc_input'></textarea></div>";			
		echo "</div>";	

		if ($main_skill == "Kitchen") {
			echo "<div id='intern_holder' style='width:100%; margin-left:5px; margin-right:2px; margin-top:10px; float:left; font-size:1.125em'>";		
				echo "<b>Allow Culinary School Interns:</b> <select id='intern_input'>";
						echo "<option value='N'>N</option>";							
						echo "<option value='Y'>Y</option>";							
				echo "</select>";			
			echo "</div>";	
		}

	echo "<div id='employment_holder' style='width:100%; margin-left:5px; margin-right:2px; margin-top:10px; margin-bottom:10px; float:left; font-size:1.125em'>";		
		echo "<b>Require Past Employment on Profile/Application:</b> ";
		echo "<select id='employment_input'>";
			echo "<option value='Y' >Y</option>";
			echo "<option value='N'>N</option>";							
		echo "</select>";			
	echo "</div>";	

	echo	"<table class='dark' style='width:100%;'>";
		echo "<tr valign='middle'>";
		echo "<th valign='middle' style='text-align:left;'>PREFERRED JOB SKILLS</th>";
		echo "</tr>";			
	echo "</table>";
			
	echo "<div style='width:100%; float:left; margin-left:5px; margin-bottom:10px;'>";
		echo "<h3 style='text-align:center'>".$main_skill." Skills</h3>";
		echo "<i>Check the boxes of all preferred candidate skills.</i>";
		
		echo "<div style='float:left; width:100%;'>";								
				echo "<table id='skill_form' CELLSPACING=2 cellpadding=2>";
					$row_count = 2;
					foreach ($sub_specialty_array as $row) {
						$selection = "unselected";
						
						if ($row_count % 2 == 0) {														
							echo "<tr>";					
								echo "<td width='48%'><span class='sub_skill ".$selection."_button' data-sub_skill='".$selection."' data-skill_value='".$row['skill']."' style='cursor:pointer;'><span class='fui-check-inverted' style='color:white; float:left;'></span> ".$row['skill']."</span></td>";
						} else {
								echo "<td width='48%'><span class='sub_skill ".$selection."_button' data-sub_skill='".$selection."' data-skill_value='".$row['skill']."' style='cursor:pointer;'><span class='fui-check-inverted' style='color:white; float:left;'></span> ".$row['skill']."</span></td>";
							echo "</tr>";
						}
						$row_count++;
						if ($row_count % 2 == 0) {	
							echo "</tr>";
						}											
					}									
				echo "</table>";
			//hidden forms
			
			echo "<input type='hidden' id='specialtyID' value='".$specialtyID."'>";	
			echo "<input type='hidden' id='specialty' value='".$main_skill."'>";	
		echo "</div>";
	echo "</div>";
						
	echo	"<table class='dark' style='width:100%; margin-bottom:5px;'>";
		echo "<tr valign='middle'>";
		echo "<th valign='middle' style='text-align:left;'>ADDITIONAL REQUIREMENTS</th>";
		echo "</tr>";			
	echo "</table>";

echo "<div class='requirements_data_holder' style=width:100%; float:left;'>";			
	echo "<div id='requirements_holder' style='float:left; margin-left:5px; margin-bottom:10px; font-size:1.125em'>"	;	
				echo "<h3 style='margin-bottom:0px; text-align:center;'>General</h3>";
					echo "<table class='form' CELLSPACING=1 cellpadding=6>";
					foreach ($template_requirements_array as $row) {
						$selection = "unselected";
						foreach($requirements as $req) {
							if ($req['requirement'] == $row['requirement']) {
								$selection = "selected";								
							}	
						}				
						if ($row['type'] == "General") {								
							echo "<tr>";	
							echo "<td width='100%'><span style='width:100%; text-align:left; cursor:pointer;' class='requirement ".$selection."_button' data-requirement='".$selection."' data-requirement_value='".$row['requirement']."'><span class='fui-check-inverted' style='color:white; float:left;'></span> &nbsp; ".$row['requirement']."</span></td>";
							echo "</tr>";
						}
					}								
				echo "</table>";

				if ($main_skill == "Kitchen" || $main_skill == "Manager") {
					echo "<h3 style='margin-bottom:0px; text-align:center;'>Back of House</h3>";
						echo "<table class='form' CELLSPACING=1 cellpadding=6>";
						foreach ($template_requirements_array as $row) {
							$selection = "unselected";
							foreach($requirements as $req) {
								if ($req['requirement'] == $row['requirement']) {
									$selection = "selected";								
								}	
							}				

							if ($row['type'] == "Back") {							
								echo "<tr>";	
								echo "<td width='100%'><span style='width:100%; text-align:left; cursor:pointer;' class='requirement ".$selection."_button' data-requirement='".$selection."' data-requirement_value='".$row['requirement']."'><span class='fui-check-inverted' style='color:white; float:left;'></span> &nbsp; ".$row['requirement']."</span></td>";
								echo "</tr>";
							}
						}								
					echo "</table>";
				}

				if ($main_skill == "Server" || $main_skill == "Manager" || $main_skill == "Bartender" || $main_skill == "Host" || $main_skill == "Bus") {				
					echo "<h3 style='margin-bottom:0px; text-align:center;'>Front of House</h3>";
						echo "<table class='form' CELLSPACING=1 cellpadding=6>";
						foreach ($template_requirements_array as $row) {
							$selection = "unselected";
							foreach($requirements as $req) {
								if ($req['requirement'] == $row['requirement']) {
									$selection = "selected";								
								}	
							}				

							if ($row['type'] == "Front") {
								echo "<tr>";	
								echo "<td width='100%'><span style='width:100%; text-align:left; cursor:pointer;' class='requirement ".$selection."_button' data-requirement='".$selection."' data-requirement_value='".$row['requirement']."'><span class='fui-check-inverted' style='color:white; float:left;'></span> &nbsp; ".$row['requirement']."</span></td>";
								echo "</tr>";
							}
						}								
					echo "</table>";	
				}
		echo "</div>";
echo "</div>";
			
	echo "<div class='requirements_data_loading' style='display:none; text-align:center; width:100%; float:left; margin-top:30px; margin-bottom:20px;'>";
		echo "<h1>LOADING.....</h1>";
	echo "</div>";
	
	echo	"<table class='dark' style='width:100%;'>";
		echo "<tr valign='middle'>";
		echo "<th valign='middle' style='text-align:left;'>OTHER INFO</th>";
		echo "</tr>";			
	echo "</table>";

	echo "<div id='notes_holder' style='float:left; margin-left:5px; margin-bottom:10px; font-size:1.125em'>";
		echo "<b>&nbsp; &nbsp; Notes (optional): </b>";
		echo "<div id='notes_form' style='float:left; margin-left:5px; margin-bottom:10px;'>";		
			echo "<textarea id='notes_input' style='width:95%;' cols='200' rows='2' maxlength='250'></textarea><br />";
		echo "</div>";
	echo "</div><br />";		

	echo	"<table class='dark' style='width:100%; margin-bottom:5px;'>";
		echo "<tr valign='middle'>";
		echo "<th valign='middle' style='text-align:left;' width='80%'>QUESTIONS</th>";
		echo "<th style='text-align:center; background-color:#DBDCCE;'><a href='#' id='edit_questions' style='color:#5D0000;'>EDIT</a></th>";		
		echo "</tr>";			
	echo "</table>";

echo "<div class='questions_data_holder' style=width:100%; float:left;'>";						
	echo "<div id='question_holder' style='float:left; margin-left:5px; margin-bottom:10px; font-size:1.125em'>";	
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
				echo $question_image." <a href='#' style='display:none' class='remove_question' data-question='".$row['questionID']."'>Remove - </a>" .$row['question']."<br />";
				$count++;
			}				
		} else {
			echo "&nbsp; <i>No Questions Entered</i> <br />";
		}
		
	 	echo "<div style='float:left; display:none' class='strange_holder'>";
	 		//For an bizarre unknown reason, if this div is not here, the maximum questions warning will not appear, but everything else appears properly
	 		//and it has to .show with the div below, it makes no fucking sense at all
	 		echo "&nbsp;";	
		echo "</div>";

		
	echo "<div style='width:95%; float:left; display:none; text-align:center;' id='question_list'>";
	//If the user has more than 3 questions, don't allow more
	
	if (count($question_array) >= 3) {
		echo "<b>You have the maximum amount of pre-interview questions.  To add a new one please delete an existing question.</b><br />";
		echo "<a href='#' id='done_questions'>Cancel</a> ";		
	} else {
			echo "&nbsp; <br />";
			echo "<b>General Questions:</b><br />";
			echo "<select id='general_question' style='width:316px;'>";
				echo "<option value='NA'>--Select a Question--</option>";	
			foreach($template_questions_array as $row) {
				if ($row['type'] == "General") {
					echo "<option value='".$row['questionID']."'>".$row['question']."</option>";	
				}
			}
			echo "</select><br />";
			echo "&nbsp; <br />";
			echo "<b>".$main_skill." Specific Questions:</b><br />";
			echo "<select id='specific_question' style='width:315px;'>";
				echo "<option value='NA'>--Select a Question--</option>";	
			foreach($template_questions_array as $row) {
				if ($row['type'] == $main_skill) {
					echo "<option value='".$row['questionID']."'>".$row['question']."</option>";	
				}
			}
			echo "</select><br />";
			echo "&nbsp; <br />";			
		echo "<b>Or Enter A Question Below: </b><br />";
		echo "<div id='charNum' style='color:red; margin-bottom:2px;'></div>"; //Holder for character counter
		echo "<textarea id='new_question' style='width:95%;' cols='200' rows='2' maxlength='250'></textarea><br />";
		echo "&nbsp; <br />";
		echo "<a href='#' id='save_question' class='btn btn-primary'>Add Question</a> <a href='#' id='done_questions' class='btn btn-primary'>Cancel</a> ";
	}
	
	echo "</div>";
	echo "</div>";
	echo "</div>";

	echo "<div class='questions_data_loading' style='display:none; text-align:center; width:100%; float:left; margin-top:30px; margin-bottom:20px;'>";
		echo "<h1>LOADING.....</h1>";
	echo "</div>";	
		
	echo	"<table class='dark' style='width:100%;'>";
		echo "<tr valign='middle'>";
		echo "<th valign='middle'></th>";
		echo "</tr>";			
	echo "</table>";

		echo "&nbsp; <br />";
		echo "<div style='text-align:center; float:left; margin-top:10px; width:100%;'><a href='#' class='btn btn-large btn-primary continue' >NEXT STEP</a><br /> &nbsp; <br /><a href='#' class='remove_job' id='".$_GET['ID']."'>Delete Job</a></div>";	
		echo	"<table class='dark' style='width:100%; margin-top:2px;'>";
			echo "<tr valign='middle'>";
			echo "<th valign='middle'></th>";
			echo "</tr>";			
		echo "</table>";
		
	echo "</div>";
	
	echo "<div id='remove_job_form' style='margin-top:100px; text-align:center; display:none;'>";
		echo "<b>Do you want to fully delete this entire job post?</b><br /> &nbsp; <br />";
		echo "<a href='#' id='delete_job'>Delete Job</a> | <a href='#' id='cancel_delete'>Cancel</a>";
	echo "</div>";														
}

function job_html_choose_type_mobile($jobID, $title, $option, $lite_job) {

echo "<div class='main_box' style='float:left; width:100%'>";
			
		echo "<div style='float:left; width:98%; margin-bottom:5px; margin-top:10px;'>";
		
			echo "<h3 style='text-align:center'>Please Select a Job Post Type</h3>";	
				if ($option == "bounty") {
					echo "<div style='width:100%; float:left; margin-top:20px; border-radius:5px; border-style:solid; border-width:2px; border-color:#a9a9a9; margin-left:2px; margin-right:2px;'>";
						echo "<div style='width:100%; float:left; text-align:center;'>";
							echo "<h3>Bounty Post</h4>";
								echo "<a href='main.php?page=bounty_summary'><h4 style='margin-bottom:0px'>WE UTILIZE ALL OF OUR MEMBERS AS RECRUITERS</h4></a>";
								echo "<a href='main.php?page=bounty_summary'>How does this work?</a>";
						echo "</div>";
	
						echo "<div style='float:left; width:100%; margin-bottom:0px; margin-top:-5px; text-align:center;'>";
							echo "<a href='#' class='choice' id='bounty_final'><img src='images/bountyemployer.png' height='100px' width='100px' alt='bounty' style='display:inline-block; margin-left: 0 5px;'></a>";
						echo "</div>";
						
						echo "<div style='float:left; width:100%; padding-top:5px; margin-left:5px; margin-2px;'>";
							echo "<b>&#10004 We pay our users to recommend top candidates to you.</b><br />";
							echo "<b>&#10004 We advertise top Bounty Jobs on: <br /> &nbsp; &nbsp; &nbsp; &#9679;FACEBOOK<br /> &nbsp; &nbsp; &nbsp; &#9679;TWITTER <br /> &nbsp; &nbsp; &nbsp; &#9679;CRAIGSLIST</b><br />";
							echo "<b>&#10004 Simple new tools to improve your candidate screening process.</b><br />";
							echo "<b>&#10004 Bounty jobs appear at the top of users job lists, and stay there.</b><br />";
						echo "</div>";
						
						echo "<div style='float:left; width:100%; text-align:center;'>";
							echo "<h4 style='margin-bottom:0px;'>Select this option for the most exposure and best candidate options</h4>";
							echo "<a href='main.php?page=bounty_faq'>Check out our FAQ</a><br />";
							echo "&nbsp; <br />";

							echo "<div class='green_button choice' id='bounty_final' style='float:left; width:98%; text-align:center'>";
								 echo "<img src='images/savegreen.png' style='width:25px;height:25px;vertical-align:middle; cursor:pointer'>";
								echo "<span style='margin-left:10px; vertical-align:middle;'>CONTINUE POSTING</span>";
							echo "</div>";
							echo "<br /><i>Bounty Posts help support the ServeBartendCook community</i>";
							echo "<br /> &nbsp; <br />";
							//echo "NOTE:  There is no limit to the amount of Bounty Jobs you can post";							
						echo "</div>";
						
					echo "</div>";
					
					echo "<div style='float:left; width:100%; text-align:center; margin-top:15px;'>";	
						echo "Or <br/>";
						echo "<h4 style='margin-bottom:0px;'><a href='#' class='choice' id='free_final'>Lite Job Post</a></h4>";
//						echo "<h4>IMPORTANT:  You are limited to ONE open lite job post on the site at a time</h4>";

						echo "<i>Lite Job Posts do not include any of the features associated with Bounty Job posts.</i><br />";	
						echo "<i>Lite Jobs are not advertised on any other sites.</i><br />";	
						echo "<i>Lite Job Posts always appear BELOW bounty posts, and move down the list as more jobs are posted.</i><br />";					
						echo "<br />";
						echo "<h5><a href='#' id='edit'>Back to Edit Job Post</a></h5>";
					echo "</div>";	
					
					
					//the code below was removed, it restricts the user to one lite post at a time

/*
					if ($lite_job == "NA") {					
						echo "<div style='float:left; width:100%; text-align:center; margin-top:15px;'>";	
							echo "Or <br/>";
							echo "<h4 style='margin-bottom:0px;'><a href='#' class='choice' id='free_final'>Lite Job Post</a></h4>";
							echo "<h4>IMPORTANT:  You are limited to ONE open lite job post on the site at a time</h4>";

							echo "<i>Lite Job Posts do not include any of the features associated with Bounty Job posts.</i><br />";	
							echo "<i>Lite Jobs are not advertised on any other sites.</i><br />";	
							echo "<i>Lite Job Posts always appear BELOW bounty posts, and move down the list as more jobs are posted.</i><br />";					
							echo "<br />";
							echo "<h5><a href='#' id='edit'>Back to Edit Job Post</a></h5>";
						echo "</div>";	
					} else {
						echo "<div style='float:left; width:100%; text-align:center; margin-top:15px;'>";	
							echo "<h3>Or</h3>";
							echo "<h4 style='margin-bottom:0px;'><a href='#' id='lite_warning'>Lite Job Post</a></h4>";
							echo "<h4 style='margin-top:0px;'>You are limited to ONE open lite job post on the site at a time</h4>";

							echo "<div id='lite_warning_holder' style='display:none; float:left; width:100%; margin-bottom:10px;'>";
								echo "<h4 style='margin-bottom:0px; color:red'>You must wait until your job <a href='job.php?ID=".$lite_job['jobID']."'>".$lite_job['title']."</a> Expires";
								echo "<h4 style='color:red'>Next Lite Job Post Available ".date('M j, Y', strtotime($lite_job['expiration_date']))."</h4>";
								echo "<h4 style='margin-bottom:0px;'>Please continue with the BOUNTY JOB option above.</h4>";
								echo "<i>Bounty job posts are unlimited</i>";
							echo "</div>";
							
							echo "<i>Lite Job Posts do not include any of the features associated with Bounty Job posts.</i><br />";	
							echo "<i>Lite Jobs are not advertised on any other sites.</i><br />";	
							echo "<i>Lite Job Posts always appear BELOW bounty posts, and move down the list as more jobs are posted.</i><br />";					
							echo "<br />";
							echo "&nbsp; <br />";
							
							echo "<h5><a href='#' id='edit'>Back to Edit Job Post</a></h5>";
						echo "</div>";					
					}				
*/
					
				} else {
					echo "<div style='width:100%; float:left; margin-top:20px; border-radius:5px; border-style:solid; border-width:2px; border-color:#a9a9a9;'>";
						echo "<div style='width:100%; float:left; text-align:center;'>";
							echo "<h3>Bounty Post</h3>";
							echo "<h4>Premium Posts Currently Unavailable in Your Region.</h4>";
							echo "To ensure the best value for your money, we only allow paid bounty posts in regions with high activity.<br />";
							echo "Free posts are still available!<br />";
							echo "Bounty Posts will be available soon in your region!<br />";
						echo "</div>";
					echo "</div>";
					
					echo "<div style='float:left; width:100%; text-align:center; margin-top:25px;'>";	
						echo "Or <br/>";
						echo "<h4 style='margin-bottom:0px;'><a href='#' class='choice' id='free_final'>Basic Job Post (Free)</a></h4>";
						echo "<i>This does not include any of the above features.</i><br />";					
						echo "<br />";
						echo "&nbsp; <br />";
						echo "<h5><a href='#' id='edit'>Back to Edit Job Post</a></h5>";
					echo "</div>";					
				}
					
				
		echo "</div>";	
	echo "</div>";

	echo "<div class='loader_box' style='display:none; margin-top:75px; text-align:center; float:left; width:100%'><h3>Loading...</h3></div>";
}

/*
function job_html_choose_type_mobile($jobID, $title, $option) {

echo "<div class='main_box' style='float:left; width:100%'>";
			
		echo "<div style='float:left; width:98%; margin-bottom:5px; margin-top:10px;'>";
		
			echo "<h3>Please Select a Job Post Type</h3>";	
				if ($option == "bounty") {
					echo "<div style='width:100%; float:left; margin-top:20px; border-radius:5px; border-style:solid; border-width:2px; border-color:#a9a9a9; margin-left:2px; margin-right:2px;'>";
						echo "<div style='width:100%; float:left; text-align:center;'>";
							echo "<h3>Bounty Post</h4>";
								echo "<a href='main.php?page=bounty_faq'><h4>What is this?  And what makes it awesome?</h4></a>";
						echo "</div>";
	
						echo "<div style='float:left; width:100%; margin-bottom:0px; margin-top:-5px; text-align:center;'>";
							echo "<a href='#' class='choice' id='bounty_final'><img src='images/bounty.png' height='100px' width='100px' alt='bounty' style='display:inline-block; margin-left: 0 5px;'></a>";
						echo "</div>";
						
						echo "<div style='float:left; width:100%; padding-top:5px; margin-left:5px; margin-2px;'>";
							echo "<b>&#10004 We pay users to recommend candidates to you.</b><br />";
							echo "<b>&#10004 Reduce Interview No-Shows w/confirmation system.</b><br />";
							echo "<b>&#10004 Save your personal notes on candidates.</b><br />";
							echo "<b>&#10004 Sort and rank candidates using your notes.</b><br />";
							echo "<b>&#10004 Compare your job response rate to similar local jobs.</b><br />";
							echo "<b>&#10004 Priority ranking on the site, based on bounty size.</b><br />";
						echo "</div>";
						
						echo "<div style='float:left; width:100%; text-align:center;'>";
							echo "<div class='green_button choice' id='bounty_final' style='float:left; width:98%; text-align:center'>";
								 echo "<img src='images/savegreen.png' style='width:25px;height:25px;vertical-align:middle; cursor:pointer'>";
								echo "<span style='margin-left:10px; vertical-align:middle;'>FINISH POSTING WITH BOUNTY</span>";
							echo "</div><br /> &nbsp; <br />";
							//echo "<i>Minimum post cost:  $25</i>";
						echo "</div>";
						
					echo "</div>";
				} else {
					echo "<div style='width:100%; float:left; margin-top:20px; border-radius:5px; border-style:solid; border-width:2px; border-color:#a9a9a9;'>";
						echo "<div style='width:100%; float:left; text-align:center;'>";
							echo "<h3>Bounty Post</h3>";
							echo "<h4>Bounty posts are not yet available in your region.</h4>";
							echo "We only allow paid posts in highly active regions to provide more value.<br />";
							echo "Free posts are still available!<br />";
//							echo "Free posts are still available!<br />";
//							echo "Bounty Posts will be available soon in your region!<br />";
						echo "</div>";
					echo "</div>";
				}
					
				echo "<div style='float:left; width:100%; text-align:center; margin-top:25px;'>";	
					echo "Or <br/>";
					echo "<h4 style='margin-bottom:0px;'><a href='#' class='choice' id='free_final'>Basic Job Post</a></h4>";
					echo "<i>This does not include any of the above features.</i><br />";					
					echo "<br />";
					echo "&nbsp; <br />";
					echo "<h5><a href='#' id='edit'>Back to Edit Job Post</a></h5>";
				echo "</div>";
				
		echo "</div>";	
	echo "</div>";

	echo "<div class='loader_box' style='display:none; margin-top:75px; text-align:center; float:left; width:100%'><h3>Loading...</h3></div>";
}
*/

function job_html_bounty_step_mobile($jobID, $title) {
echo "<div class='main_box' style='width:100%; float:left;'>";
	echo "<h3 style='text-align:center; margin-bottom:2px;'>".$title."</h3>";
		
//	echo "<h4 style='text-align:center'>Select your bounty amount below.</h4>";
		
		
		echo "<div style='float:left; width:100%; margin-left:3px;'>";
//			echo "<h4>The base posting fee is $19 and there is a minimum bounty of $6.</h4>";
//			echo "<i>If you post more than one job in a transaction, the base fee will be reduced for each job after the first!</i><br />";
			
//			echo "<div class='final_step' style='float:left; width:93%; background-color:#e9e6de; color:#8d0609; margin-left:5px; margin-right:5px; margin-bottom:5px; margin-top:10px; padding-top:7px; padding-bottom:7px; border-radius:5px; border-style:solid; border-width:2px; border-color:#a9a9a9;'>";
/*
			echo "<p>";
				echo "<input type='text' id='amount' readonly style='border:0; color:#8d0609; font-weight:bold;'>";
			echo "</p>";
*/

/*
				echo "<div style='width:100%; color:#8d0609; margin-bottom:5px; text-align:center;'><h4 style='margin-bottom:5px;'>Selected Bounty:";
					echo "<select id='bounty_cost'>";
						for ($bounty = 5; $bounty <=100; $bounty = $bounty + 5) {
							$cost = $bounty * 1.20;
							echo "<option value=$bounty>".$cost."</option>";
						}
					echo "</select><br />";
				echo "Approximate Rank: <span id='rank'><i>Loading...</i></span><br /><span style='font-size:12px;'><i>Placement compared to other local jobs</i></span></div>";
					 
					
				echo " &nbsp; The bounties will be paid to the user(s) who recommend a candidate that you hire.";


			echo "</div>";
			echo "<div style='float:left; width:85%; margin-left:25px; font-size:12px;'>";
				echo "<i>Bounty cost includes a 20% processing fee. <a href='main.php?page=bounty_payout'>Learn more about bounty payouts</a></i>";
			echo "</div>";
*/

		echo "</div>";
		
		echo "<div style='float:left; width:100%;'>";
			echo "<div style='float:left; width:95%; margin-left:5px; margin-bottom:5px; margin-top:10px; padding-top:7px; padding-bottom:7px; padding-left:3px; padding-right:3px; border-radius:5px; border-style:solid; border-width:2px; border-color:#a9a9a9;'>";
			
			echo "<div style='float:left; width:100%'>";
				echo "<div style='float:left; width:100%; text-align:center'>";
					echo "<h3>Cost Summary</h3>";
				echo "</div>";
				echo "<table style='width:100%'>";
					echo "<tr>";
						echo "<td><h4 style='margin-bottom:0px;'>Job Post Fee</h4></td>";
						echo "<td align='right'><h4 style='margin-bottom:0px;'>$19</h4></td>";
					echo "</tr>";
					
					echo "<tr>";
						echo "<td> &#8226; Priority Placement</td>";
						echo "<td align='right'><img src='images/savegreen.png' height='15px' width='15px' alt='check' style='vertical-align:middle'>Included</td>";
					echo "</tr>";		
					
					echo "<tr>";
						echo "<td colspan='2'><span style='font-size:12px;'> - <i>Approximate Rank: <b></i><span id='rank'><i>Loading...</i></span><i></b> (Placement compared to other local jobs)</i></span></td>";
					echo "</tr>";			
					
					echo "<tr>";
						echo "<td> &#8226; Similar Job Stat Comparison</td>";
						echo "<td align='right'><img src='images/savegreen.png' height='15px' width='15px' alt='check' style='vertical-align:middle'>Included</td>";
					echo "</tr>";

					echo "<tr>";
						echo "<td> &#8226; Save Candidate Notes</td>";
						echo "<td align='right'><img src='images/savegreen.png' height='15px' width='15px' alt='check' style='vertical-align:middle'>Included</td>";
					echo "</tr>";

					echo "<tr>";
						echo "<td> &#8226; Interview Reminder System</td>";
						echo "<td align='right'><img src='images/savegreen.png' height='15px' width='15px' alt='check' style='vertical-align:middle'>Included</td>";
					echo "</tr>";		
					
					echo "<tr>";
						echo "<td>&#8226; We advertise ALL Bounty Jobs on: <br /> &nbsp; &nbsp; &nbsp; &#10004Facebook<br /> &nbsp; &nbsp; &nbsp; &#10004Twitter <br /> &nbsp; &nbsp; &nbsp; &#10004Craigslist</b><br />&nbsp; &nbsp; &nbsp; (<i>Limited Time Offer</i>)</td>";
						echo "<td align='right'><img src='images/savegreen.png' height='15px' width='15px' alt='check' style='vertical-align:middle'>Included</td>";
					echo "</tr>";																						

					echo "<tr>";
						echo "<td><h4 style='margin-bottom:0px;'><a href='main.php?page='bounty_summary'>Bounty</a></h4></td>";
						echo "<td align='right'><h4 style='margin-bottom:0px;'>	";
							echo "$<select id='bounty_cost'>";
								for ($bounty = 5; $bounty <=100; $bounty = $bounty + 5) {
									$cost = $bounty * 1.20;
									echo "<option value=$bounty>".$cost."</option>";
								}
						echo "</select></h4></td>";
					echo "</tr>";
					
					echo "<tr>";
						echo "<td colspan='2' align='right' style='color:red'>You can change this amount! &#8648; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>";
					echo "</tr>";
					
					echo "<tr>";
						echo "<td colspan='2' align='right' ><a href='#' class='toggle_info_box'>Learn Why</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td>";
					echo "</tr>";

				echo "</table>";
				
			echo "</div>";
		echo "</div>";	
		
		echo "<div class='learn_more_box' style='display:none; float:left; width:95%; background-color:#e9e6de; color:#8d0609; text-align:center; margin-left:5px; margin-bottom:5px; margin-top:10px; padding-top:7px; padding-bottom:7px; padding-right:3px; border-radius:5px; border-style:solid; border-width:2px; border-color:#a9a9a9;'>";
			echo "<h4>Think of a bounty as a reward</h4>";
			echo "&#10004; The larger the bounty, the more we pay any user who recommends candidates you hire.  The larger the reward, the more incentive our users have to recommend awesome candidates. <a href='main.php?page=bounty_summary'>More</a><br />";
			echo "&nbsp; <br />";
			echo "&#10004; The job with largest bounty is ALWAYS AT THE TOP OF THE JOB LIST.  When other jobs are posted, it never moves down.  Users will see the top job first, for the life of the job post. <a href='main.php?page=bounty_summary'>More</a><br />";
			echo "&nbsp; <br />";
			echo "&#10004; We offer more for your dollar than any other job site, AND we give back to our users in the form of real money!<br />";
			echo "&nbsp; <br />";
			echo "<a href='#' class='toggle_info_box'>Close</a>";
		echo "</div>";
		
		
		echo "<div style='float:left; width:95%; margin-left:5px; margin-bottom:5px; margin-top:0px;'>";
			echo "<table style='width:100%'>";
				echo "<tr>";
					echo "<td><h3 style='margin-bottom:0px;'>TOTAL COST</h3></td>";
					echo "<td align='right'><h3 style='margin-bottom:0px;'><span id='cost'>$25</span></h3></td>";
				echo "</tr>";
			echo "</table>";		
		echo "</div>";
			
			//hidden inputs
			echo "<input type='hidden' id='total_amount' value='25'>";
			
			echo "<div style='width:100%; float:left; text-align:center; margin-top:10px;'>";
				echo "<a href='#' class='btn btn-large btn-primary' id='save' style='background-color:#2e6652;'> <img src='images/savegreen.png' height='25px' width='25px' alt='check' style='vertical-align:middle'> Review and Checkout!</a><br />";
				echo "<br /><a href='#' class='back'><--BACK</a><br />";
				echo "&nbsp; <br />";
				echo "<i>Bounty amount includes 20% processing fee.</i><br />";
				echo "<a href='main.php?page=bounty_payout'>Learn how bounties are paid out</a><br />";
			echo "</div>";
			
	echo "</div>";	
echo "</div>";
//echo "<div class='loader_box' style='display:none; margin-top:75px; text-align:center; float:left; width:100%'><h3>Loading...</h3></div>";

}

function job_html_employer_payment_step_mobile($jobID, $job_data) {
	
	$title = $job_data['general']['title'];
	$store = $job_data['store']['name'];

//	echo var_dump($_SESSION['boost'][$jobID]);
	
	echo "<div class='main_box'>";
		echo "<h3 style='text-align:center; margin-top:5px;'>Boost & Distribution Checkout</h3>";
		
		echo "<div id='payment_info' style='float:left; width:100%'>";	
			echo "<h4 style='margin-bottom:0px; text-align:center;'>".$title."</h3>";
			echo "<h4 style='text-align:center;'>".$store."</h3>";
					
			echo "<div style='float:left; width:100%; margin-left:10px; margin-right:10px;'>";
				echo "<h4 style='margin-bottom:5px;'>Review Your Order Below:</h3>";
			
				echo "<div style='float:left; width:100%; margin-left:15px; margin-bottom:15px;'>";
					if ($_SESSION['boost'][$jobID]['cl_group'] == 'Y') {
						echo "<div style='float:left; width:100%;'>";
							echo "<h4 style='margin-bottom:0px;'>&#10004; Craigslist Group Post - $20</h4>";
							echo "<div style='float:left; width:90%; padding-left:10px; margin-bottom:5px;'>";
								echo "Your job will be included in the following Tuesday or Thursday group post (<i>Schedule may change around holidays</i>)<br />";
							echo "</div>";
						echo "</div>";				
					}
					if ($_SESSION['boost'][$jobID]['social'] == 'Y') {
						echo "<div style='float:left; width:100%;'>";
							echo "<h4 style='margin-bottom:0px'>&#10004; Social Media Sponsored Post - $15</h4>";
							echo "<div style='float:left; width:90%; padding-left:7px; margin-bottom:5px;'>";
								echo "We typically promote your jobs on FaceBook within 24-48 hours.  (<i>promotion may be delayed on weekends and holidays</i>)<br />";
							echo "</div>";
						echo "</div>";
						echo "&nbsp; <br />";				
					}
					
					if ($_SESSION['boost'][$jobID]['email'] == 'Y') {
						echo "<div style='float:left; width:100%;'>";
							echo "<h4 style='margin-bottom:0px'>&#10004; Featured in Weekly Email - $5</h4>";
							echo "<div style='float:left; width:90%; padding-left:7px; margin-bottom:5px;'>";
								echo "Email blasts typically go out on Tuesdays (unless it is a holiday).<br />";
							echo "</div>";
						echo "</div>";
						echo "&nbsp; <br />";				
					}
					

/*
					echo "<div style='float:left; width:100%; text-align:center'>";
						echo "<div class='warning' id='phone_warning' style='float:left; width:100%; color:red; display:none;'>Please enter a valid phone number to continue.</div>";
						echo "<input type='text' id='employer_phone' placeholder='Phone Number'><br />";					
						echo "<div style='float:left; width:90%;'><i>Please include a phone number in case we need to contact you regarding your purchase</i></div>";
					echo "</div>";
*/
				echo "</div>";					
?>	
		
			<div style="float: left; width: 100%; text-align: center; margin-top: 10px;">
				<h4>TOTAL COST:  $<?php echo $_SESSION['boost'][$jobID]['final_cost'] ?>.00</h4>

				<a href='#' class='btn btn-large btn-primary' id='customButton' style='background-color:#2e6652; '> <img src='images/savegreen.png' height='25px' width='25px' alt='check' style='vertical-align:middle'>  CHECKOUT</a>
				&nbsp; <br />
				<br /><i>By clicking above agree to our full <a href='index.php?page=TOS'>Terms of Service</a> and <a href='index.php?page=privacy_policy'>Privacy Policy</a></i><br />

				<br />
				<img src='images/outline.png' height='26px' width='119px' alt='stripe' ><br />
			</div>
<?php			
		echo "</div>";
	echo "</div>";

	
	echo "<div id='payment_loader' style='float:left; width:100%; display:none;'>";
		echo "<div style='float:left; width:100%; text-align:center; margin-top:60px;'>";
			echo "<h2>Processing Payment..</h4>";
			echo "<h4>This may take a few minutes</h4>";
			echo "<h4>Please do not press the back button</h4>";
		echo "</div>";
	echo "</div>";

	echo "<div id='payment_error' style='float:left; width:100%; display:none;'>";
		echo "<div style='float:left; width:100%; text-align:center; margin-top:40px;'>";
			echo "<h2>Payment Error</h4>";
			echo "<h4>There was a problem processing your payment</h4>";
			echo "<h4><a href='job.php?ID=".$_GET['ID']."'>Back to Payment Page</a></h4>";
			echo "<b>Contact:  admin@servebartendcook.com</b>";
		echo "</div>";
	echo "</div>";
	

echo "</div>";	
	
	echo "<div class='loader_box' style='display:none; margin-top:75px; text-align:center; float:left; width:100%'><h3>Loading...</h3></div>";
}

function job_html_employer_payment_step_mobile_OLD($jobID, $job_data) {
	
	$title = $job_data['general']['title'];
	$store = $job_data['store']['name'];
	$total_payment = 100*$job_data['general']['total_payment'];
	$bounty_amount = $job_data['general']['bounty_amount'];
	
	echo "<h1 style='text-align:center; margin-bottom:10px;'>Job Post Checkout</h1>";
		
		echo "<div id='payment_info' style='float:left; width:100%'>";	
			echo "<h3 style='margin-left:10px;'>".$title."</h3>";
			echo "<h3 style='margin-left:10px;'>".$store."</h3>";
			
					
			echo "<div style='float:left; width:100%; margin-left:5px; margin-right:3px;'>";
				echo "<h4>By continuing you agree to the following:</h4>";
			
				echo "<div style='float:left; width:95%; margin-left:5px; margin-bottom:15px; margin-right:3px;'>";
					echo "<b>&#8226; Only one job advertisement per job post.  Jobs advertising multiple positions may be removed.</b><br />";
					echo "&nbsp; <br />";
					echo "<b>&#8226; Job posts must not instruct users to apply through a different site or in a different manner other than through ServeBartendCook.com.  Job posts that include such instructions may be removed.  (users must apply through ServeBartendCook to be eligible for bounties)</b><br />";
					echo "&nbsp; <br />";
					echo "<b>&#8226; Do not include links to other sites in your job post, except where instructed or allowed.  Any links will be removed and the job post may be removed.</b><br />";
					echo "&nbsp; <br />";
					echo "<b>&#8226; By posting a paid job post with a bounty, you are allowing us to contact you via email or phone to confirm any candidate you hire from ServeBartendCook.com so that we may pay out the proper bounty.</b><br />";
					echo "&nbsp; <br />";
					echo "<b>&#8226; Job posts that contain any content that ServeBartendCook deems inappropriate may be removed.</b><br />";
					echo "&nbsp; <br />";
					echo "<b>&#8226; You agree to our full <a href='#'>Terms of Service</a> and <a href='#'>Privacy Policy</a></b>.<br />";
				echo "</div>";
				
				echo "<div style='float:left; width:98%; text-align:center;'>";
					echo "<b>Please include a phone number in case we need to contact you:</b><br />";
					echo "<div class='warning' id='phone_warning' style='float:left; width:100%; color:red; display:none;'>Please enter a valid phone number to continue.</div>";
					echo "<input type='text' id='employer_phone'><br />";
				echo "</div>";
						
?>			
			<div style="float: left; width: 100%; text-align: center; margin-top: 30px;">
				<a href='#' class='btn btn-large btn-primary' id='customButton' style='background-color:#2e6652;'> <img src='images/savegreen.png' height='25px' width='25px' alt='check' style='vertical-align:middle'>  PAYMENT & CHECKOUT</a>
				<br />
				&nbsp; <br />
				<img src='images/outline.png' height='26px' width='119px' alt='stripe' ><br />
				<a href='#' class='back' id='bounty_final'>BACK</a><br />
				&nbsp; <br />				
				<a href='#' class='back' id='template_edit'>EDIT JOB POST</a><br />
				&nbsp; <br />
			</div>
<?php			
		echo "</div>";
	echo "</div>";
	
	echo "<div class='loader_box' style='display:none; margin-top:75px; text-align:center; float:left; width:100%'><h3>Loading...</h3></div>";
	
	
	echo "<div id='payment_loader' style='float:left; width:100%; display:none;'>";
		echo "<div style='float:left; width:100%; text-align:center; margin-top:60px;'>";
			echo "<h2>Processing Payment..</h4>";
			echo "<h4>This may take a few minutes</h4>";
			echo "<h4>Please do not press the back button</h4>";
		echo "</div>";
	echo "</div>";

	echo "<div id='payment_error' style='float:left; width:100%; display:none;'>";
		echo "<div style='float:left; width:100%; text-align:center; margin-top:40px;'>";
			echo "<h2>Payment Error</h4>";
			echo "<h4>There was a problem processing your payment</h4>";
			echo "<h4><a href='job.php?ID=".$_GET['ID']."'>Back to Payment Page</a></h4>";
			echo "<b>Contact:  admin@servebartendcook.com</b>";
		echo "</div>";
	echo "</div>";
echo "</div>";		
}

function job_html_employer_final_step_mobile($jobID, $title) {					

		echo "<div class='main_box'>";
			echo	"<table class='dark' style='width:100%;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle'>".$title."</th>";
				echo "</tr>";			
			echo "</table>";
?>
			<div style='margin-bottom:5px; margin-left:5px; margin-right:2px;'>
				<h3>Please Review the Terms and Rules below:</h3>
<!--
					<h4 style='margin-top:15px'>Only one job advertisement per job post.  Posts advertising multiple positions may be removed.</h4>
					<h4>You may not use more than one account to post jobs.  Doing so may result in deactivation of the associated account(s).</h4>
-->

					<ul style="font-size:16px;">
						<li style="margin-bottom:10px;">Candidates within 40 miles of your location will be able to view this job post. If they are interested, they can allow you to view their profile and contact information.</li>
						<li style="margin-bottom:10px;">When a candidate applies, you will be notified via email, and on this site. You can choose to contact them on your own via email or by phone.</li>
						<li style="margin-bottom:10px;">Job postings remain open for 28 days.</li>
						<li style="margin-bottom:10px;">After you submit your job post, editing of job post is limited.</li>
						<li style="margin-bottom:10px;">To comply with anti-discrimination laws, please do NOT reference gender, race or age in your job post.</li>
						<li style="margin-bottom:10px; color:red;">If your Job post contains any inappropriate content, the post will be immediately removed and your account may be suspended or removed.</li>
						<li style="margin-bottom:10px;">By clicking 'Post Job' you agree to all of the above, as well as all <a href='index.php?page=TOS'>Terms of Service</a> and the <a href='index.php?page=privacy_policy'>Privacy Policy</a>.</li>
					</ul>	
				&nbsp; <br />
					<div class='final_step' style='margin-bottom:5px; margin-top:10px; text-align:center'>				
						<a href='#' class='btn btn-large btn-primary' id='match'>POST JOB</a><br />
						&nbsp; <br />
						Or <br/>
						 <h5 style='margin-top:-3px;'><a href='opportunity.php?ID=<? echo $jobID ?>'>Preview Job Post</a></h5>					
						 <h5 style='margin-top:-10px;'><a href='#' id='edit'>Edit Job Post</a></h5>
					</div>
		</div>
	</div>	
<?php		
}

function job_html_email_warning_mobile($email, $valid) {
	
	echo "<div style='float:left; width:100%; text-align:center;'>";
		echo "<h3>Verification Email</h2><br />";
		echo "<div style='float:left; width:99%; padding-left:3px; padding-right:3px;' id='email_header'>";
			if ($valid == 'Y') {
				echo "<h4>You must verify your email address by clicking the link sent to <b>".$email."</b></h4>";
				echo "<i>You only need to do this for your first job post.</i><br />";
				
				echo "<br />";
				echo "<div class='selected_job_titles' id='edit' style='float:left; margin-left:12%; width:70%'>Click here to edit your job post.</div>";
				echo "<br />";
				echo "<a href='main.php'><div class='selected_job_titles' style='float:left; margin-left:12%;width:70%; margin-bottom:10px'>Click here to return to the main menu.</div></a>";
				echo "<br />";
				echo "<br />";
				echo "<br />";
				echo "<br />";
				echo "To resend or change your email address <br /> <a href='main.php?page=verify_email'>CLICK HERE</a>";
			} else {
				echo "<h4>There was a problem sending a verification to your email address.  Please try again, or contact admin@servebartendcook.com</h4>";
			}
		echo "</div>";	
	echo "</div>";	
}

function job_html_group_receipt_mobile($groupID, $group_job_list, $store_name, $receipt_data)	{

		$receiptID = $_GET['receiptID'];
		
		if ($receipt_data != "free") {
			$payment_amount = $receipt_data['payment_amount'];
			$payment_date = $receipt_data['date'];			
		}
		
//==================================
//!  Display
//==================================

 	echo 	"<div class='main_box' style='float:left; width:99%;'>";

		//echo	"<h2 style='text-align:center'>".$store_name."</h4>";
	
?>
		<div id="job_listing" style="width:99%; float:left; margin-left:7px; margin-right:7px;">
<?php
		if ($receipt_data == "free") {
?>
			<h4 style='margin-top:15px; text-align:center;'>Jobs Successfully Posted</h4><br />
			<b>Jobs Posted for <?php echo $store_name ?> </b><br /> &nbsp; <br />

<?php
		} else {
?>
			<h2 style='margin-top:15px; text-align:center;'>Job Post Payment Receipt</h2>
			<h4>Confirmation Number:  #<? echo $receiptID ?>-<? echo $groupID ?></h4>
			<b>Payment Date: <? echo date('M j, Y', strtotime($payment_date)) ?></b><br />
			<b>Payment Amount:  $<? echo $payment_amount ?></b><br /> &nbsp; <br />
			<b>Jobs Posted for <?php echo $store_name ?> </b><br /> &nbsp; <br />
<?php
		}
	
			foreach($group_job_list as $row) {
				if ($row['job_status'] == "Open" || $row['job_status'] == "Filled") {
					echo "&nbsp; &nbsp; &nbsp; &nbsp; &#8226; <b>".$row['title']."</b><br />";
				}
			}
?>			
			<br />
			All job postings expire 28 days after posting.  <br />You can view details about your job post from the <a href='main.php'>home page</a>.<br />
			You will be able to view candidates up to 3 days after your job postings expire.
			&nbsp; <br />
			&nbsp; <br />
<?php
		if ($receipt_data != "free") {
?>
			*<i>An email receipt has been sent to the email address you included with your payment information.</i>
<?php
		}
?>		
			</div>
		</div>
	</div>
<?php
}

function job_html_boost_receipt_mobile($job_data, $receipt_data)	{

//==================================
//!  First break master arrays into trait arrays
//
//  Modify any data for presentation
//==================================
		$receiptID = $_GET['receiptID'];

		$jobID							= $job_data['general']['jobID'];
		$title		 						= $job_data['general']['title'];
		$public_hash					= $job_data['general']['public_hash'];
		$expiration_date			= $job_data['general']['expiration_date'];
		$main_skill		 			= $job_data['skills']['main_skill']['specialty'];

		$payment_amount 		= $receipt_data['payment_data']['payment_amount'];
		$payment_date				= $receipt_data['payment_data']['date'];	
		
		$boost_data					=	$receipt_data['boost_data'];
		
		$view_date = date('M j, Y', strtotime("+14 days", strtotime($expiration_date)));	

//==================================
//!  Display
//==================================	
?>
		<div id="job_listing" style="float:left; width:98%; margin-left:5px;">
			<h3 style='margin-top:15px; text-align:center;'>Job Boost Payment Receipt</h2>
<!-- 			<h4>An email receipt has been sent to the email address you included with your payment information on</h4> -->
			
			<h4 style='text-align:center;'>Job Post: <? echo $title ?></h4>
			<h4>Confirmation Number:  #<? echo $receiptID ?>-<? echo $jobID ?></h4>
			<b>Payment Date: <? echo date('M j, Y', strtotime($payment_date)) ?></b><br />
			<b>Payment Amount:  <? echo $payment_amount ?></b><br />
			
			&nbsp; <br />
			<b><?php echo $title ?> Boost & Distribution: </b><br />
<?php
			foreach($boost_data as $row) {
				switch($row['boost_type']) {
					case "cl_group":
						echo "&nbsp; &nbsp;  - Craigslist Group Post: ";
					break;
					
					case "social":
						echo "&nbsp; &nbsp;  - Social Media: ";
					break;				

					case "email":
						echo "&nbsp; &nbsp;  - Email Blast: ";
					break;				
				}
				
				echo "Status - ";
				if ($row['date_boosted'] > 0) {
					echo " Boosted ".date('M j, Y', strtotime($row['date_boosted']))."<br />";;
				} else {
					echo " <i>Boost Pending*</i><br />";
				}
			}
?>			
			<br />
			&nbsp; <br />
			&nbsp; <br />
			&nbsp; <br />
			*<i>Group Craigslist Posts are posted on Tuesdays and Thursdays (except holidays).  Social Media posts typically take up to 48 hours.  Featured Emails are typically sent on Tuesdays.		
			</div>
						
		</div>
<?php
}

function job_html_employer_bounty_receipt_mobile($job_data, $expired)	{

//==================================
//!  First break master arrays into trait arrays
//
//  Modify any data for presentation
//==================================

		$jobID							= $job_data['general']['jobID'];
		$title		 						= $job_data['general']['title'];
		$public_hash					= $job_data['general']['public_hash'];
		$expiration_date			= $job_data['general']['expiration_date'];
		$main_skill		 			= $job_data['skills']['main_skill']['specialty'];
		
		$view_date = date('M j, Y', strtotime("+14 days", strtotime($expiration_date)));	

//==================================
//!  Display
//==================================

	echo "<h3 style='text-align:center'>".$title."</h3>";
		
		if ($expired == "Y") {
			echo "<div id='job_listing'>";
				echo "<h4>This Job Listing Has Expired</h4>";
			echo "</div>";			
		} else {				
?>
		<div id="job_listing" style="float:left; width:98%; margin-left:5px;">
			<h3 style='text-align:center;'>Payment Complete</h3>
			<h4>An email receipt has been sent to the email address you included with your payment information</h4>
			<h4>Confirmation Number:  #<? echo $jobID ?></h4>

			<h4 style='margin-bottom:0px'>Your job post expires on <?php echo date('M j, Y', strtotime($expiration_date)) ?></h4>
			<h4 style='margin-top:0px;'>You will be able to view candidates until <? echo $view_date ?></h4>
			
			An email message will be sent to all candidates who meet the qualifications of your job post, and your job will appear on the site in approximately 30 minutes.<br />		
			&nbsp; <br />

			You will be notified via email when an interested candidate response.  You will be able to view their profile and contact information on the site. </i><br>
			
			<div style='background-color:#E7E7DD; width:80%' class='bubble_inside'>
				<h4 style='text-align:center'>DID YOU KNOW?</h4>
				
				You can easily share your job on Facebook or Twitter:<br />
				&nbsp; <br />
				<div style='float:left; text-align:center; width:100%;' >
					<a href='https://twitter.com/share' class='twitter-share-button' data-text='Great new job on ServeBartendCook.com' data-related='servebarcook' data-lang='en'  data-count='none' data-hashtags='servebartendcook' data-url='http://servebartendcook.com/public_listing_new.php?ID=<? echo $jobID ?>&ref=<? echo $public_hash ?>'>Tweet</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','twitter-wjs');</script>
				</div>
				
				<div style='float:left; text-align:center; width:100%;' >				
					<div style='margin: 0 auto; width:50%;' class='fb-share-button' data-href='http://servebartendcook.com/public_listing_new.php?ID=<? echo $jobID ?>&ref=<? echo $public_hash ?>' data-type='button'></div><br />
				</div>
				
				
				<div style='float:left; text-align:center; margin-top:10px; margin-bottom:10px; width:100%;' ><b>OR</b></div><br />
				You can use ServeBartendCook.com in combination with other Classified/Job Sites to help screen and organize your candidates.<br />
				&nbsp; <br />	
				
				<div style='float:left; text-align:center; margin-top:10px; padding-bottom:30px; width:100%;' >													
					<a href='main.php?page=share_link' class='btn btn-primary' id='".$main_skill."'>Learn More</a>
					&nbsp; &nbsp;
					<a href='job.php?ID=<? echo $jobID ?>&page=get_link' class='btn btn-primary' id='".$main_skill."'>Get Link</a><br />
				</div>
				&nbsp; <br />					
			</div>
						
		</div>
<?php
	}
}

function job_html_employer_boost_mobile($job_data, $expired, $job_option) {

//==================================
//!  First break master arrays into trait arrays
//
//  Modify any data for presentation
//==================================

		$jobID							= $job_data['general']['jobID'];
		$title		 						= $job_data['general']['title'];
		$store							= $job_data['store']['name'];
		$boost_data					= $job_data['boost_data'];
		
		$boost_type_array = array();
		
		if (count($boost_data) > 0) {
			foreach($boost_data as $row) {
				$boost_type_array[] = $row['boost_type'];
			}
		}
		
		if ($_GET['note'] == "new") {
			$new_note = "<h3 style='margin-top:5px; text-align:center;'>Your Job Post is Complete</h3>";
			$new_note .= "<h4  style='margin-top:2px; text-align:center;'>We hope you find a great employee!</h4>";
			//$new_note .= "<i>You will be notified via email when an interested candidate response.  You will be able to view their profile and contact information on the site.	</i>";			
		} else {
			$new_note = "";
		}
		
//==================================
//!  Display
//==================================

	echo "<div class='main_box' style=' width:100%;'>";		
		echo "<h3 style='margin-bottom:0px; text-align:center;'>".$title."</h3>";
			
		if ($expired == "Y") {
			echo "<div id='job_listing'>";
				echo "<h4>This Job Listing Has Expired</h4>";
			echo "</div>";			
		} else {	
			
		echo "<div style='float:left; width:99%;'>";
			echo $new_note;

			echo "<div style='float:left; width:99%; margin-left:3px; margin-bottom:2px;'><b>We offer the following options for more exposure for your job post.</b></div>";

			echo "<div style='float:left; width:96%; margin-left:3px; margin-bottom:5px; margin-top:10px; padding-top:7px; padding-bottom:7px; padding-left:3px; padding-right:3px; border-radius:5px; border-style:solid; border-width:2px; border-color:#a9a9a9;'>";
			
			echo "<div style='float:left; width:100%'>";
				echo "<div style='float:left; width:100%; text-align:center'>";
					echo "<h3>Optional Job Boost</h3>";
				echo "</div>";

				if ($job_option == "free") {
					echo "<h4>Job Board Distribution and Boosting is not currently available in your regions</h4>";
				} else {
				
				echo "<table style='width:100%'>";
					echo "<tr>";
						echo "<td style='width:70%'>";
							echo "<h4 style='margin-bottom:0px;'>Craigslist Group Post</h4>";
							echo "<div style='width:100%; float:left; margin-left:5px;'>We advertise jobs on Craigslist regionally every Tuesday & Thursday.  Select this options to include your job post in <b>2</b> of our postings! <a href='main.php?page=boost_faq&type=cl_group'>Learn More</a></div>";
						echo "</td>";
						echo "<td align='right'>";
						
							if (in_array("cl_group", $boost_type_array)) {
								foreach($boost_data as $row) {
									if ($row['boost_type'] == "cl_group") {
										if ($row['date_boosted'] > 0) {
											$boost_note = "Posted on ".date("m-d-y", strtotime($row['date_boosted']));											
										} else {
											$boost_note = "<i>Boost Pending</i>";
										}	
									}
								}
								echo "<div style='float:right; width:80%; text-align:center;'>Already Boosted <br />".$boost_note."</div><br />";			
							} else {
								echo "<div style='float:right; width:80%; text-align:center;' class='unselected_job_titles boost_button' data-status='unselected' data-price='20' id='cl_group'>$20</div><br />";
							}

						echo "</td>";
					echo "</tr>";
										
					echo "<tr>";
						echo "<td style='width:70%'>";
							echo "<h4 style='margin-bottom:0px;'>Sponsored Social Media & Email</h4>";
							echo "<div style='width:100%; float:left; margin-left:5px;'>Select this option to have your job appear on Facebook as a sponsored post targeting industry specific candidates. <a href='main.php?page=boost_faq&type=social'>Learn More</a></div>";
						echo "</td>";
						echo "<td align='right'>";
						
							if (in_array("social", $boost_type_array)) {
								foreach($boost_data as $row) {
									if ($row['boost_type'] == "social") {
										if ($row['date_boosted'] > 0) {
											$boost_note = "Posted on ".date("m-d-y", strtotime($row['date_boosted']));											
										} else {
											$boost_note = "<i>Boost Pending</i>";
										}	
									}
								}
								echo "<div style='float:right; width:80%; text-align:center;'>Already Boosted <br />".$boost_note."</div><br />";			
							} else {
								echo "<div style='float:right; width:80%; text-align:center;' class='unselected_job_titles boost_button' data-status='unselected' data-price='15' id='social'>$15</div><br />";
							}

						echo "</td>";
					echo "</tr>";

					echo "<tr>";
						echo "<td style='width:70%'>";
							echo "<h4 style='margin-bottom:0px;'>Weekly Email Blast</h4>";
							echo "<div style='width:100%; float:left; margin-left:5px;'>Select this option to have your job Featured in our regional weekly email blast sent to members. <a href='main.php?page=boost_faq&type=email'>Learn More</a></div>";
						echo "</td>";
						echo "<td align='right'>";
						
							if (in_array("email", $boost_type_array)) {
								foreach($boost_data as $row) {
									if ($row['boost_type'] == "email") {
										if ($row['date_boosted'] > 0) {
											$boost_note = "Posted on ".date("m-d-y", strtotime($row['date_boosted']));											
										} else {
											$boost_note = "<i>Boost Pending</i>";
										}	
									}
								}
								echo "<div style='float:right; width:80%; text-align:center;'>Already Boosted <br />".$boost_note."</div><br />";			
							} else {
								echo "<div style='float:right; width:80%; text-align:center;' class='unselected_job_titles boost_button' data-status='unselected' data-price='5' id='email'>$5</div><br />";
							}

						echo "</td>";
					echo "</tr>";
					
					echo "<tr>";
						echo "<td style='width:70%'>";
							echo "<h4 style='margin-bottom:0px;'>Google Search Ads</h4>";
							echo "<div style='width:100%; float:left; margin-left:5px;'>This option is not available yet.</div>";
						echo "</td>";
						echo "<td align='right'>";
							echo "<div style='float:right; width:80%; text-align:center;'><i>Coming Soon</i></div><br />";			
						echo "</td>";
					echo "</tr>";					
					
/*
					if (count($boost_type_array) == 0) {
						echo "<tr>";
							echo "<td style='width:70%'>";
								echo "<h4 style='margin-bottom:0px;'>Select All (Best Deal!)</h4>";
								echo "<div style='width:100%; float:left; margin-left:5px;'>Select all the option above for only $55, that's a XX% discount!</div>";
							echo "</td>";
							echo "<td align='right'>";
								echo "<div style='float:right; width:80%; text-align:center;' class='unselected_job_titles select_all' data-status='unselected' data-boost_id='all'>Select All</div>";
							echo "</td>";
						echo "</tr>";
					}
*/

				echo "</table>";
				
				}
			echo "</div>";
		echo "</div>";	
				
		echo "<div style='float:left; width:96%; margin-bottom:0px; margin-top:0px;'>";
			echo "<table style='width:100%'>";
				echo "<tr>";
					echo "<td style='width:80%'><h3 style='margin-bottom:0px;'>TOTAL COST</h3></td>";
					echo "<td align='right'><h3 style='margin-bottom:0px; text-align:center;'><span id='cost'>$0</span></h3></td>";
				echo "</tr>";
			echo "</table>";	
			
			echo "<div style='width:100%; float:left; margin-top:10px; text-align:center;'>";
				echo "<a href='#' class='btn btn-large btn-primary checkout_holder' id='save_boost' style='background-color:#2e6652; display:none'> <img src='images/savegreen.png' height='25px' width='25px' alt='check' style='vertical-align:middle'> Review and Checkout!</a>";
				echo "<a href='#' class='btn btn-large btn-primary checkout_holder' id='no_save' style='background-color:grey;'> Review & Checkout</a>";
		
				echo "<div style='width:100%; float:left; margin-top:10px; text-align:center; margin-bottom:10px;'>";
					echo "<a href='main.php'>No thanks, maybe later</a><br />";
					echo "<i>You can boost your job post at anytime from the main page!</i>";
				echo "</div>";	

			echo "</div>";	
		echo "</div>";

	}				
}


function job_html_employer_sent_mobile($job_data)	{

//==================================
//!  First break master arrays into trait arrays
//
//  Modify any data for presentation
//==================================

		$jobID							= $job_data['general']['jobID'];
		$title		 						= $job_data['general']['title'];
		$public_hash					= $job_data['general']['public_hash'];
		$main_skill		 			= $job_data['skills']['main_skill']['specialty'];

//==================================
//!  Display
//==================================
?>
	<div class='main_box' style='margin-top:100px; width:100%;'>			
		<div>
		<div style='width:98%; margin-left:5px; margin-top:20px;'>
			<h4 style='margin-top:25px; text-align:center;'>Your Job Post is Complete</h4>
			<h5 style='margin-top:2px; text-align:center; margin-bottom:0px;'>We hope you find a great employee!</h5>			
			<b>An email message has been sent to all candidates who meet the qualifications of your job post.</b><br />		
			&nbsp; <br />
			<i>You will be notified via email when an interested candidate responds.  You will be able to view their profile and contact information on the site.	</i>
			
			<div style='background-color:#E7E7DD; width:80%' class='bubble_inside'>
				<h4 style='text-align:center'>DID YOU KNOW?</h4>
				
				You can easily share your job on Facebook or Twitter:<br />
				&nbsp; <br />
				<div style='float:left; text-align:center; width:100%;' >
					<a href='https://twitter.com/share' class='twitter-share-button' data-text='Great new job on ServeBartendCook.com' data-related='servebarcook' data-lang='en'  data-count='none' data-hashtags='servebartendcook' data-url='http://servebartendcook.com/public_listing_new.php?ID=<? echo $jobID ?>&ref=<? echo $public_hash ?>'>Tweet</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','twitter-wjs');</script>
				</div>
				
				<div style='float:left; text-align:center; width:100%;' >				
					<div style='margin: 0 auto; width:50%;' class='fb-share-button' data-href='http://servebartendcook.com/public_listing_new.php?ID=<? echo $jobID ?>&ref=<? echo $public_hash ?>' data-type='button'></div><br />
				</div>
				
				
				<div style='float:left; text-align:center; margin-top:10px; margin-bottom:10px; width:100%;' ><b>OR</b></div><br />
				You can use ServeBartendCook.com in combination with other Classified/Job Sites to help screen and organize your candidates.<br />
				&nbsp; <br />	
				
				<div style='float:left; text-align:center; margin-top:10px; padding-bottom:30px; width:100%;' >													
					<a href='main.php?page=share_link' class='btn btn-primary' id='".$main_skill."'>Learn More</a>
					&nbsp; &nbsp;
					<a href='job.php?ID=<? echo $jobID ?>&page=get_link' class='btn btn-primary' id='".$main_skill."'>Get Link</a><br />
				</div>
				&nbsp; <br />					
			</div>
						
		</div>
<?php
}
			

function job_html_employer_edit_mobile($job_data) {

//==================================
//!  First break master arrays into trait arrays
//
//  Modify any data for presentation
//==================================

		$jobID							= $job_data['general']['jobID'];
		$status		 					= $job_data['general']['job_status'];

//==================================
//!  Display
//==================================


?>
	<div class='main_box' style='margin-top:110px; width:100%; text-align:center; margin-bottom:25px;'>
		<h2>Job Edit Options</h2>

<?php
		if ($status != "Open" && $status != "Filled") {
?>
			<a href='job.php?ID=<? echo $jobID ?>&page=edit_skills'>
				<div style='float:left; width:85%; margin-bottom:-5px;' class='bubble_inside'>
					<h2 style='display:inline'>Skills</h2>
				</div>
			</a>	
<?php
		}
?>		
			<a href='job.php?ID=<? echo $jobID ?>&page=edit_details'>
				<div style='float:left; width:85%; margin-bottom:-5px;' class='bubble_inside'>
					<h2 style='display:inline'>Details</h2>
				</div>
			</a>			

<?php
		if ($status != "Open" && $status != "Filled") {
?>
			<a href='job.php?ID=<? echo $jobID ?>&page=edit_questions'>
				<div style='float:left; width:85%; margin-bottom:-5px;' class='bubble_inside'>
					<h2 style='display:inline'>Interview Questions</h2>
				</div>	
			</a>
<?php
		}
?>		
			
		<div style='float:left; width:100%'><hr style='border: 1px solid #760006; margin-top:20px;'></div>	

<?php
		if ($status == "Open") {
?>		
			<a href='#' class='filled' id='<? echo $jobID ?>'>
				<div style='float:left; width:85%;' class='bubble_inside'>
					<h2 style='display:inline'>Position Filled?</h2>
				</div>
			</a>
	
<?php		
		} elseif ($status == "Filled") {
?>
			<a href='#' class='unfill' id='<? echo $jobID ?>'>
				<div style='float:left; width:85%;' class='bubble_inside'>
					<h2 style='display:inline'>Unfill Position</h2>
				</div>
			</a>
<?php			
		} else {
?>
			<a href='#' class='remove_job' id='<? echo $jobID ?>'>
				<div style='float:left; width:85%;' class='bubble_inside'>
					<h2 style='display:inline'>Delete Job</h2>
				</div>
			</a>
<?php			
		}
?>

	<div id='delete_warning' style='float:left; width:90%; margin-left:5px; display:none'>
		<b>Do you wish to delete this job and all of it's content?</b><br />
		&nbsp; <br />
		<div id='button_holder'>		
			<div style='margin-top:15px; margin-bottom:25px; text-align:center'><a href='#' id='<? echo $jobID ?>' class='delete_job btn btn-large btn-primary'>Delete Job</a> <a href='#' id='delete_cancel' class='btn btn-large btn-primary'>Cancel</a></div>	
		</div>
	</div>

	<div id='filled_warning' style='float:left; width:90%; margin-left:5px; display:none'>
		<b>Mark this position as filled?</b><br />
		<i>You will no longer receive candidate notices</i>
		&nbsp; <br />
		<div id='button_holder'>				
			<div style='margin-top:15px; margin-bottom:25px; text-align:center'><a href='#' id='<? echo $jobID ?>' class='fill_job btn btn-large btn-primary'>Fill Job</a> <a href='#' id='fill_cancel' class='btn btn-large btn-primary'>Cancel</a></div>
		</div>
	</div>
				
	</div>
<?php
}

function job_html_employer_open_mobile($job_data, $last_login, $sub_specialty_array, $candidate_array, $highlight_array, $trait_array) {	

$utilities = new Utilities;
				
//==================================
//!  First break master arrays into trait arrays
//
//  Modify data for presentation
//==================================

		$jobID							= $job_data['general']['jobID'];
		$job_status					= $job_data['general']['job_status'];
		$title		 						= $job_data['general']['title'];
		$post_type					= $job_data['general']['post_type'];
		$main_skill		 			= $job_data['skills']['main_skill']['specialty'];
		$expiration_date			= $job_data['general']['expiration_date'];
		$reach_count				= $job_data['candidate_count'];
		$post_type					= $job_data['general']['post_type'];
		$bounty_amount			= $job_data['general']['bounty_amount'];
		$views							= $job_data['view_count'];

		$responses = count($job_data['positive_list']);


		//reach thresholds for newer regions
		switch($main_skill) {		
			default:
				$min_reach = 100;			
			break;
		
			case "Manager":
				$min_reach = 25;
			break;
			
			case "Host":
				$min_reach = 50;
			break;			

			case "Bus":
				$min_reach = 50;
			break;									
		}
		
		//calculate hours left before expiration
		date_default_timezone_set('America/Los_Angeles');		
		$date1 =  time();
		$date2 = strtotime($expiration_date);
		$hourdiff = ($date2 - $date1) / 3600;
		$expired = "N";
		if ($hourdiff < 0) {
			$expired = "Y";
		}	
				
		if ($post_type == "bounty") {
			$view_date = date('m-d-Y', strtotime("+14 days", strtotime($expiration_date)));	
		} else {
			$view_date = date('m-d-Y', strtotime("+3 days", strtotime($expiration_date)));	
		}
		

//==================================
//!  Display
//==================================
?>
		<div class='main_box' style='margin-top:60px; width:100%;'>		

		<div style='float:left; margin-left:12px;'>
			<h3><? echo $title ?></h3>
<?php
			if ($expired == "N") {
?>
				<h4 style='margin-top:2px; margin-bottom:2px;'>Post Expires <? echo date('M j, Y', strtotime($expiration_date)) ?></h4>
<?php
			} else {
?>				
				<h4 style='margin-top:2px; margin-bottom:2px; color:red'>POST EXPIRED ON <? echo date('M j, Y', strtotime($expiration_date)) ?></h4></span>
<?php				
			}
?>
		</div>

		<div id='button_holder' style='float:left; width:100%; margin-left:5px; margin-top:0px; margin-bottom:5px;'>
			
		<div style='float:left; width:85px; text-align:center; margin-right:5px; cursor:pointer;' id='filter' class='toggle btn btn-large btn-primary'>
			Filter
		</div>

<?php
	if ($post_type == "bounty") {
?>
		<a href='interview.php?page=notes_list&ID=<? echo $jobID ?>'><div style='float:left; width:85px; text-align:center; margin-right:5px; cursor:pointer;' class='btn btn-large btn-primary'>
			<b>&#9733; </b>Notes
		</div></a>
<?php		
	}	
?>	
		
		<a href='job.php?ID=<? echo $jobID ?>&page=get_link'><div style='float:left; width:85px; margin-right:5px; text-align:center;' class='btn btn-large btn-primary'>
			Share
		</div></a>
		
		<a href='job.php?ID=<? echo $jobID ?>&page=edit'><div style='float:left; width:85px; text-align:center;' class='btn btn-large btn-primary'>
			Edit
		</div></a>		
			
	</div><br />
		
	<div class='results' style='width:100%; margin-top:10px; float:left;'>

<!--  CANDIDATE FILTERS BUTTONS	 -->

		<div id='filter_holder' class='holder' style='display:none; margin-top:5px; margin-bottom:20px;'>
<?php
			if ($candidate_array != "Expired") {
/*
				if ($post_type == "bounty") {
					echo "<h4 style='margin-bottom:-5px; margin-left:5px; display:inline;'>FILTER CANDIDATES</h4> &nbsp; &nbsp; <a href='#' class='toggle' id='filter_close'><b>Hide Filters</b></a>";
	
					echo "<table id='skill_form' class='form' CELLSPACING=6 cellpadding=6 width='300'>";					
						echo "<tr>";						
							echo "<td><span id='all' class='recommendation_filter_span unselected_button' data-recommendation_filter='unselected' data-recommendation='all' style='cursor:pointer;'>All Referrals</span></td>";						
							echo "<td><span id='employer' class='skill_filter_span unselected_button' data-recommendation_filter='unselected' data-recommendation='employee' style='cursor:pointer;'>Referred By Your Employees</span></td>";
						echo "</tr>";
					echo "</table>";			
				}	
*/
	
?>	
			<h4 style='margin-bottom:-5px; margin-left:5px; display:inline;'>FILTER BY SKILL</h4> &nbsp; &nbsp; <a href='#' class='toggle' id='filter_close'><b>Hide Filters</b></a>
			<table id='skill_form' class='form' CELLSPACING=2 cellpadding=2 width='95%'>
<?php	
			$row_count = 2;
				
				echo "<tr>";						
				foreach ($sub_specialty_array as $row) {			
					if ($row_count % 2 == 0 && $row_count != 2) {						
						echo "</tr>";
						echo "<tr>";	
						echo "<td><span class='skill_filter_span unselected_button' data-job_skill_filter='unselected' data-skill='".$row['skill']."' style='cursor:pointer;'>".$row['skill']."</span></td>";
						
					} else {
						echo "<td><span class='skill_filter_span unselected_button' data-job_skill_filter='unselected' data-skill='".$row['skill']."' style='cursor:pointer;'>".$row['skill']."</span></td>";
					}
					$row_count++;
			}
			if ($row_count % 2 != 0) {	
				echo "</tr>";
			}			
?>												
			</table>
			
<!--
			<h4 style='margin-bottom:-5px; margin-left:5px; display:inline;'>FILTER BY PERSONALITY</h4>
			<table id='trait_form' class='form' CELLSPACING=2 cellpadding=2 width='95%'>
<?php	
			$row_count = 2;
				
				echo "<tr>";						
				foreach ($trait_array as $row) {			
					if ($row_count % 2 == 0 && $row_count != 2) {						
						echo "</tr>";
						echo "<tr>";	
						echo "<td><span class='trait_filter_span unselected_button' data-trait_filter='unselected' data-trait='$row' style='cursor:pointer;'>$row</span></td>";			
					} else {
						echo "<td><span class='trait_filter_span unselected_button' data-trait_filter='unselected' data-trait='$row' style='cursor:pointer;'>$row</span></td>";
					}
					$row_count++;
			}
			if ($row_count % 2 != 0) {	
				echo "</tr>";
			}			
?>																
			</table>
-->
			
	
			<h4 style='margin-bottom:2px; margin-left:5px;'>EXPERIENCE FILTER</h4>		
			<p><input type='text' id='amount' readonly style='border:0; color:#8d0609; font-weight:bold;'></p>
				 
			<div id='slider1' style='margin-bottom:2px; margin-left:15px;'></div>	
<?php
			} else {
				echo "<h4 style='margin-bottom:-5px; margin-left:5px; display:inline;'>This Job Post Has Expired</h4> &nbsp; &nbsp; <a href='#' class='toggle' id='filter_close'><b>Hide Filters</b></a>";				
			}	
?>
		</div>
		
		
<!--  CANDIDATE STATS		 -->
		<div id='stats_holder' class='holder' style='margin-top:5px; display:none'>	
			<h4 style='margin-top:30px; margin-bottom:-5px; margin-left:10px; display:inline;'>JOB STATS</h4> &nbsp; &nbsp; <a href='#' class='toggle' id='stats_close'><b>Hide Stats</b></a>

<?php
	//A low reach indicates an immature region, display alternative text
			if ($reach_count > $min_reach) {			
				echo "<table cellspacing=10 style='margin-left:45px'>";
					echo "<tr><td><b>REACH:</b></a></td><td><b>".$reach_count."</b></td></tr>";	
					echo "<tr><td><b>VIEWS:</b></td><td><b>".$views."</b></td></tr>";	
					echo "<tr><td><b>DECLINES:</b></td><td><b>".$declines."</b></td></tr>";	
				echo "</table>";
			} else {
				echo "<div style='float:left; margin-left:35px; margin-bottom:10px; width:90%;'>";
					echo "<h4 style='margin-bottom:0px;'>Candidate statistics are not available yet for this region and/or job type.</h4>";
					echo "<i>Data will be available soon.</i><br />";
				echo "</div>";
			}
		echo "</div>";
		

//CANDIDATE LIST
		echo "<div style='float:left; width:100%; margin-left:5px;'>";
			echo "<div id='skill_filter_warning' style='float:left; padding-right:25px; color:red; display:none;'><b>Skill filter: ON</b></div>";					
			echo "<div id='trait_filter_warning' style='float:left; padding-right:25px; color:red; display:none;'><b>Trait filter: ON</b></div>";					
			echo "<div id='experience_filter_warning' style='float:left; color:red; display:none'><b>Experience filter: ON</b></div>";					
		echo "</div>";
		
		echo "<div style='float:left; width:100%; margin-left:5px;'>";
			echo "<font color='red'>Candidate profiles ONLY available until <b>".$view_date."</b>. <br />Please print applications for your records.</font></br />";
		echo "</div>";

		candidate_list_mobile($candidate_array, $highlight_array, $last_login);

/*
				echo "<table class='dark' id='candidates' style='width:100%'>";
				echo "<tr><th>Name</th><th class='reverse_candidates' style='cursor: pointer; text-align:center'>Date <b>&#8645;</b></th><th>Features</th></tr>";
				if(count($candidate_array) > 0) {		
					echo "<tbody class='regular'>";
					foreach ($candidate_array as $candidate) {
						
						if ($candidate['quote'] == "") {
							$td_dark_line = "border-bottom:1pt solid black;";
						} else {
							$td_dark_line = "";
						}

							echo "<tr class='candidate_row ".$candidate['candidate_class']."' data-experience='".$candidate['experience']."' data-skills='".$candidate['sub_skill_text']."' data-traits='".$candidate['trait_text']."' data-candidate_skill_filter='show' data-experience_filter='show' data-candidate_trait_filter='show'>";	
								echo "<td style='".$candidate['highlight_style']." $td_dark_line'>".$candidate['new']." <a href='candidate.php?ID=".$candidate['userID']."&matchID=".$candidate['matchID']."'>".$candidate['firstname']." ".$candidate['lastname']."</a>".$candidate['past_reply_note']."</td>";	
								echo "<td style='".$candidate['highlight_style']." $td_dark_line' align='center'>".date('M j, Y', strtotime($candidate['date_responded']))."</td>";
								echo "<td style='".$candidate['highlight_style']." $td_dark_line' align='center'>".$candidate['candidate_features']."</td>";
							echo "</tr>";
							if ($candidate['quote'] != "") {
								echo "<tr class='candidate_row ".$candidate['candidate_class']."' data-experience='".$candidate['experience']."' data-skills='".$candidate['sub_skill_text']."' data-traits='".$candidate['trait_text']."' data-candidate_skill_filter='show' data-experience_filter='show' data-candidate_trait_filter='show'>";
									echo "<td  style='".$candidate['highlight_style']." height:5px; border-bottom:1pt solid black;' colspan='3'>".$candidate['quote']."</td>";							
								echo "</tr>";
							}
					} 					
					echo "</tbody>";
					echo "</table>";
					
				} else {
					echo "<tr><td colspan='4'>&nbsp; No interested candidates yet.  <br /> &nbsp; You will be notified by email when a candidate is interested.</td></tr>";
					echo "</table>";
				}
			echo "</div>";
			echo "</div>";			
*/
			
			echo "&nbsp; <br />";
			echo "</div>";									
}

function candidate_list_mobile($candidate_array, $highlight_array, $last_login) {

	echo "<div id='results' style='float:left; width:100%;'>";
		if ($candidate_array != "Expired") {
			echo "<table class='dark' id='candidates' style='width:100%'>";
				echo "<thead><tr><th>Candidate List</th></tr></thead>";
			echo "</table>";

			if(count($highlight_array) > 0) {		
	//turn in sectioned divs
				
				echo "<div class='highlight_rows' style='float:left; width:100%; background-color:#e9e6de;'>";
				
				//FIRST DISPLAY HIGHLIGHTED CANDIDATES
					foreach ($highlight_array as $candidate) {
						if ($candidate['quote'] == "") {
							$td_dark_line = "border-bottom:1pt solid black;";
						} else {
							$td_dark_line = "";
						}
	
						if (count($candidate['past_replies']) > 0) {
							$past_reply_note = "<br /><font size='0.8em' ><i>&nbsp; *Applied at this location before</i></font>";
						} else {
							$past_reply_note = "";
						}
						
						if (isset($candidate['recommendation']) && $candidate['recommendation'] > 0) {
							$recommended = "<a href='candidate.php?ID=".$candidate['userID']."&matchID=".$candidate['matchID']."'><img src='images/receivedreferral.png' height='30px' width='30px' alt='recommended'></a>";
							$recommendation = 'Y';
						} else {
							$recommended = "&nbsp;";
							$recommendation = 'N';
						}					
						
							if ($candidate['photo'] == "") {
								$photo = "";	
							} else { 							
								$photo = "<img src='images/profile_pics/".$candidate['photo']."' height='50px' width='50px' alt='profile' style='border-radius: 50%;'>";														
							}
													
							//turn sub_skill array into comma list/\
							$sub_skill_text = "";	
							if (count($candidate['sub_skills']) > 0) {
								foreach($candidate['sub_skills'] as $sub_skill) {
									$sub_skill_text .= $sub_skill.", ";
								}
							}	
							
/*
							if ($row['recommendation_employer'] == 'Y') {
								$recommendation_employer = 'Y';
							} else {
								$recommendation_employer = 'N';							
							}
*/
							
							echo "<div style='float:left; width:100%; margin-top:8px;' class='candidate_row ".$candidate['candidate_class']."' data-experience='".$candidate['experience']."' data-skills='".$candidate['sub_skill_text']."' data-candidate_skill_filter='show' data-experience_filter='show'>";	
								//div for photo, new notice, and date
								echo "<div style='float:left; width:40%; text-align:center'>";
									echo "<a href='candidate.php?ID=".$candidate['userID']."&matchID=".$candidate['matchID']."'>".$photo."</a><br />";
									echo date('M j, Y', strtotime($candidate['date_responded']));
								echo "</div>"; 
								
								//div for name, high light notice and thumbs up and buttons
								echo "<div style='float:left; width:60%'>";
									echo "<div style='float:left; width:100%'>";
										echo "<font color='#DAA520' size='5px'><b>&#9733; </b></font><a href='candidate.php?ID=".$candidate['userID']."&matchID=".$candidate['matchID']."'><h4 style='display:inline'>".$candidate['firstname']." ".$candidate['lastname']."</a></h4>";	
									echo "</div>";
									
/*
									echo "<div style='float:left; width:100%'>";
										//three buttons
										echo "<div style='float:left; width:33%; text-align:center;'>";
											echo $recommended;
										echo "</div>";
										echo "<div style='float:left; width:33%; text-align:center;'>";
											echo "<a href='candidate.php?ID=".$candidate['userID']."&matchID=".$candidate['matchID']."&page=interview'><img src='images/interviewred.png' height='40px' width='40px' alt='interview'></a>";			
										echo "</div>";
										echo "<div style='float:left; width:30%; text-align:center;'>";
											echo "<a href='candidate.php?ID=".$candidate['userID']."&matchID=".$candidate['matchID']."&page=notes'><img src='images/personalsummary.png' height='40px' width='40px' alt='notes'></a>";									
										echo "</div>";	
									echo "</div>";	
*/
								echo "</div>";
								
								if ($candidate['quote'] != "") {
									echo "<div style='float:left; width:100%; margin-left:2px; margin-right:2px;'>";
										echo "<i>".$candidate['quote']."</i>";					
									echo "</div>";
								}
								
							echo "<div style='float:left; width:100%'>";		
								echo "<hr>";
							echo "</div>";							
									
						echo "</div>";
						
								//NEED DARK LINE	
					}
				
				echo "</div>";
				}
				if(count($candidate_array) > 0) {
					
					echo "<div class='regular' style='float:left; width:100%;'>";
					
					foreach ($candidate_array as $candidate) {
						
						if (count($candidate['past_replies']) > 0) {
							$past_reply_note = "<br /><font size='0.8em' ><i>&nbsp; *Applied at this location before</i></font>";
						} else {
							$past_reply_note = "";
						}
						
						if ($candidate['quote'] == "") {
							$td_dark_line = "border-bottom:1pt solid black;";
						} else {
							$td_dark_line = "";
						}
	
/*
						if (isset($candidate['recommendation']) && $candidate['recommendation'] > 0) {
							$recommended = "<a href='candidate.php?ID=".$candidate['userID']."&matchID=".$candidate['matchID']."'><img src='images/receivedreferral.png' height='30px' width='30px' alt='recommended'></a>";
							$recommendation = 'Y';
						} else {
							$recommended = "&nbsp;";
							$recommendation = 'N';
						}					
*/
												
							if ($candidate['photo'] == "") {
								$photo = "";	
							} else {
								$photo = "<img src='images/profile_pics/".$candidate['photo']."' height='50px' width='50px' alt='profile' style='border-radius: 50%; align-vertical:middle;'>";														
							}
							
							$new = "";	
							if ($candidate['date_responded'] > $last_login) {
								$new = "<font color='red'><b><i>NEW</i></b></font>";
							}
							
							$sub_skill_text = "";	
							if (count($candidate['sub_skills']) > 0) {
								foreach($candidate['sub_skills'] as $sub_skill) {
									$sub_skill_text .= $sub_skill." ";
								}
							}															
	
/*
							if ($row['recommendation_employer'] == 'Y') {
								$recommendation_employer = 'Y';
							} else {
								$recommendation_employer = 'N';							
							}		
*/

							echo "<div style='float:left; width:100%; margin-top:8px;' class='candidate_row ".$candidate['candidate_class']."' data-experience='".$candidate['experience']."' data-skills='".$candidate['sub_skill_text']."' data-candidate_skill_filter='show' data-experience_filter='show'>";	
								//div for photo, new notice, and date
								echo "<div style='float:left; width:40%; text-align:center'>";
									echo $new."<a href='candidate.php?ID=".$candidate['userID']."&matchID=".$candidate['matchID']."'>".$photo."</a><br />";
									echo date('M j, Y', strtotime($candidate['date_responded']));
								echo "</div>"; 
								
								//div for name, high light notice and thumbs up and buttons
								echo "<div style='float:left; width:60%'>";
									echo "<div style='float:left; width:100%'>";
										echo "<a href='candidate.php?ID=".$candidate['userID']."&matchID=".$candidate['matchID']."'><h4 style='display:inline'>".$candidate['firstname']." ".$candidate['lastname']."</a></h4>";	
									echo "</div>";
									
/*
									echo "<div style='float:left; width:100%'>";
										//three buttons
										echo "<div style='float:left; width:33%; text-align:center; margin-top:3px;'>";
											echo $recommended;
										echo "</div>";
										echo "<div style='float:left; width:33%; text-align:center;'>";
											echo "<a href='candidate.php?ID=".$candidate['userID']."&matchID=".$candidate['matchID']."&page=interview'><img src='images/interviewred.png' height='40px' width='40px' alt='interview'></a>";			
										echo "</div>";
										echo "<div style='float:left; width:30%; text-align:center;'>";
											echo "<a href='candidate.php?ID=".$candidate['userID']."&matchID=".$candidate['matchID']."&page=notes'><img src='images/personalsummary.png' height='40px' width='40px' alt='notes'></a>";									
										echo "</div>";	
									echo "</div>";	
*/
								echo "</div>";
								
								if ($candidate['quote'] != "") {
									echo "<div style='float:left; width:100%; margin-left:2px; margin-right:2px;'>";
										echo "<i>".$candidate['quote']."</i>";					
									echo "</div>";
								}	
								
							echo "<div style='float:left; width:100%'>";		
								echo "<hr>";
							echo "</div>";							
								
						echo "</div>";
						
						}
				
					echo "</div>";
				}
		
				if (count($candidate_array) == 0 && count($highlight_array) == 0) {
					echo "<div style='float:left; width:100%; margin-left:3px; margin-right:3px;'> &nbsp; No interested candidates yet.  <br /> &nbsp; You will be notified by email when a candidate is interested.</div>";
				}
		} else {
			echo "<h4>This Job Has Expired</h4>";
			echo "Candidate Profile are no longer available for this job post.";
		}
	echo "</div>";		
}

function job_html_employer_link_mobile($job_data) {

//==================================
//!  First break master arrays into trait arrays
//
//  Modify any data for presentation
//==================================

		$jobID							= $job_data['general']['jobID'];
		$job_status					= $job_data['general']['job_status'];
		$title		 						= $job_data['general']['title'];
		$main_skill		 				= $job_data['skills']['main_skill']['specialty'];
		$public_hash					= $job_data['general']['public_hash'];
		
//==================================
//!  Display
//==================================

		echo "<div class='main_box' style='margin-top:75px; margin-left:3px; width:98%;'>";		

		if ($job_status == "Expired") {		
			 echo "<h2>This job listing has expired</h2>";
			 echo "Links are not available for expired jobs.";			
		} else {		
?>
		<h4 style='text-align:center'>We Can Help You Stay Organized</h4>
		<b>You can use the following link on other sites to require job candidates to apply through ServeBartendCook.com.</b>

		<div class='bubble_inside' style='background-color:#E7E7DD;'>
			<div style='width:98%; word-wrap: break-word;'>
				<h4 style='margin-bottom:0px;'>Quick Share</h4>
				&nbsp; <br />
<!--
					<div style='margin-top:0px; float:left;'><a href='https://twitter.com/share' class='twitter-share-button' data-text='Great new job on ServeBartendCook.com' data-related='servebarcook' data-lang='en'  data-count='none' data-hashtags='servebartendcook' data-url='http://servebartendcook.com/public_listing_new.php?ID=<? echo $jobID ?>&ref=<? echo $public_hash ?>'>Tweet</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','twitter-wjs');</script></div>
						&nbsp; &nbsp; &nbsp; 
-->
						<div style='margin-top:-18px; margin-left:10px;' class='fb-share-button' data-href='http://servebartendcook.com/public_listing_new.php?ID=<? echo $jobID ?>&ref=<? echo $public_hash ?>' data-type='button'></div>
			</div>
		</div>

		
		<div class='bubble_inside' style='background-color:#E7E7DD;'>
		
			<div style='width:98%; word-wrap: break-word;'>
				<h4 style='margin-bottom:0px;'>General Link</h4>
				<i>(You can use this link on sites like Facebook or Twitter to link to your job.)</i><br />
				&nbsp; <br />
				<b style='color:gray'>http://servebartendcook.com/public_listing_new.php?ID=<? echo $jobID ?>&ref=<? echo $public_hash ?></b><br />
				&nbsp; <br />
			</div>
		</div>

		<div class='bubble_inside' style='background-color:#E7E7DD;'>	
			<div style='width:98%; word-wrap: break-word;'>	
				<h4 style='margin-bottom:0px;'>HTML Text for Clickable Link:</h4>
				<i>(Copy and paste this text to create a clickable link on your website or on Classified/Job Post sites)</i><br />
				&nbsp; <br />			
				<b style='color:gray'>&lt;a href='http://servebartendcook.com/public_listing_new.php?ID=<? echo $jobID ?>&ref=<? echo $public_hash ?>'&gt;Apply Here &lt;a&gt;</b><br />
			</div>
		</div>		
		
<!-- 		If you have any questions about how this works, please feel free to email us at admin@servebartendcook.com<br /> -->
		&nbsp; <br />
<?php
		}
		echo "</div>";
}

function job_html_employer_similar_list_mobile($similar_list, $job_title, $broad_skill, $view_count, $response_count, $bounty, $rank_array, $expired) {

	switch($broad_skill) {
			case "Bartender":
				$image = "main-bar.png";
			break;
			
			case "Manager":
				$image =  "main-manager.png";
			break;
			
			case "Kitchen":
				$image =  "main-cook.png";
			break;
			
			case "Server":
				$image =  "main-server.png";
			break;
									
			case "Bus":
				$image =  "main-bus.png";
			break;

			case "Host":
				$image =  "main-host.png";
			break;						
		}
	
	echo "<h3 style='text-align:center'>Similar Jobs in Your Region</h3>";
	echo "<div style='float:left; width:98%; background-color:#e9e6de; padding-top:6px; padding-left:1%; padding-right:1%'>";
		echo "<h4 style='margin-bottom:0px;'>Your Job: ".$job_title."<br />";
		echo "Bounty: $".$bounty."&nbsp; <br />";
		echo "Approx. Overall Rank: ".$rank_array['overall']." &nbsp; <br />";
		//echo "Approx. ".$broad_skill." Rank: ".$rank_array['skill']." &nbsp; (<a href='main.php?page=bounty_faq'>Learn More</a>)<br />";
		echo "Current Views: ".$view_count."<br />";
		echo "Current Responses: ".count($response_count)."</h4>";
	echo "</div>";
	
	//echo "<div style='float:right; margin-right:10px; margin-top:-145px'><img src='images/".$image."' height='150px' width='150px' alt='broad_skill'></div>";
	
	echo "<table class='dark' style='width:100%'><tr>";
		echo "<th style='width:100%'>Similar Job List</th>";
	echo "</tr></table>";
	
	if ($expired != "Y") {		
		if ($similar_list == "NA" || count($similar_list) == 0) {
			echo "No similar jobs in your region - this changes daily.";
		} else {
			foreach($similar_list as $row) {
				//compare views and responses
					if ($row['view_count'] == 0) {
						$row['view_count'] = 0.1;
					}
					if ($view_count >= $row['view_count']) {
						$difference = $view_count - $row['view_count'];
						$fraction = $difference / $row['view_count'];
						
						if ($fraction <= 0.1) {
							$view_text = "Similar Views";
						} elseif ($fraction > 0.1 && $fraction <= 0.2) {
							$view_text = "Slightly less views than your job";						
						} elseif ($fraction > 0.2 && $fraction <= 0.5) {
							$view_text = "<font color='green'>Moderately less views than your job</font>";						
						} elseif ($fraction > 0.5) {
							$view_text = "<font color='green'>Far less views than your job</font>";
						}						
					} elseif ($view_count < $row['view_count']) {
						$difference = $row['view_count'] - $view_count;
						$fraction = $difference / $row['view_count'];
						
						if ($fraction <= 0.1) {
							$view_text = "Similar Views";
						} elseif ($fraction > 0.1 && $fraction <= 0.2) {
							$view_text = "Slightly more views than your job";						
						} elseif ($fraction > 0.2 && $fraction <= 0.5) {
							$view_text = "<font color='red'>Moderately more views than your job</font>";						
						} elseif ($fraction > 0.5) {
							$view_text = "<font color='red'>Far more views than your job</font>";
						}										
					}

					
					if ($row['response_count'] == 0) {
						$row['response_count'] = 0.1;
					}
					if (count($response_count) >= $row['response_count']) {
						$difference = count($response_count) - $row['response_count'];
						$fraction = $difference / $row['response_count'];
						
						if ($fraction <= 0.1) {
							$response_text = "Similar Responses";
						} elseif ($fraction > 0.1 && $fraction <= 0.2) {
							$response_text = "Slightly less responses than your job";						
						} elseif ($fraction > 0.2 && $fraction <= 0.5) {
							$response_text = "<font color='green'>Moderately less responses than your job</font>";						
						} elseif ($fraction > 0.5) {
							$response_text = "<font color='green'>Far less responses than your job</font>";
						}						
					} elseif (count($response_count) < $row['response_count']) {
						$difference = $row['response_count'] - count($response_count);
						$fraction = $difference / $row['response_count'];
						
						if ($fraction <= 0.1) {
							$response_text = "Similar Responses";
						} elseif ($fraction > 0.1 && $fraction <= 0.2) {
							$response_text = "Slightly more responses than your job";						
						} elseif ($fraction > 0.2 && $fraction <= 0.5) {
							$response_text = "<font color='red'>Moderately more responses than your job</font>";						
						} elseif ($fraction > 0.5) {
							$response_text = "<font color='red'>Far more responses than your job</font>";
						}										
					}				
				
				if (isset($row['bounty']) && $row['bounty'] > 0) {
					$bounty = "$".$row['bounty'];				
				} else {
					$bounty = "NA";
				}
	
				echo "<div style='float:left; width:100%; margin-left:3px;'>";
					echo "<b>".$row['title']." - ".$row['name']."</b><br />";
					echo "&nbsp;<br />";
					echo "Pay: ".$row['comp_type']." ".$row['comp_value']." |  Bounty: ".$bounty."<br />";
					echo "Views: ".$view_text."<br />";
					echo "Applicants: ".$response_text."<br />";
					echo "<hr>";
				echo "</div>";
				
/*
				echo "<table class='dark' style='width:100%'>";
					echo "<tr>"; 
						echo "<td style='width:25%'>".$row['title']." <br><b>".$row['name']."</b></td>";
						echo "<td style='width:25%'>".$row['comp_type']." ".$row['comp_amount']."<br />".$bounty."</td>";
						echo "<td style='width:25%'>".$view_text."</td>";
						echo "<td style='width:25%'>".$response_text."</td>";
					echo "</tr>";
				echo "</table>";
*/
				
			}
		}
	} else {
		echo "<h4>This job has expired.</h4>";
		echo "Comparisons are only available for open jobs.";
	}
}

function job_html_hire_confirmation_mobile($expired, $job_title, $store, $recommended_candidates, $bounty_status) {

	if ($bounty_status == "closed") {
		if (count($recommended_candidates) == 0) {
			echo "<div id='hire_list_header' style='width:95%; float:left; margin-left:3px;'>";
				echo "<div style='float:left; width:100%; margin-top:10px; margin-left:1.5%'>";		
				echo "<h2 style='margin-bottom:10px; margin-top:10px; color:black; text-align:center;'>Hire Confirmation</h2>";
				echo "<h3>".$job_title."</h3>";
				echo "<h4>".$store."</h2>";
				echo "<b>You indicated that you did not hire anyone that was recommended on this site.</b><br />";
				echo "&nbsp; <br />";
				echo "<i>If this is incorrect, please contact us at admin@servebartnedcook.com</i>";
			echo "</div>";
		} else {
			echo "<div id='hire_list_header' style='width:95%; float:left; margin-left:3px;'>";
				echo "<div style='float:left; width:100%; margin-top:10px; margin-left:1.5%'>";		
				echo "<h2 style='margin-bottom:10px; margin-top:10px; color:black; text-align:center;'>Hire Confirmation</h2>";
				echo "<h3>".$job_title."</h3>";
				echo "<h4>".$store."</h2>";
				echo "<b>You indicated that you hired the following candidates from the site:</b><br />";
				foreach($recommended_candidates as $row) {
					echo "&nbsp; &nbsp; <i>".$row['firstname']." ".$row['lastname']."</i><br />";
				}
				echo "We are in the process or have already paid bounties to the users who recommended these candidates.<br />";
				echo "&nbsp; <br />";
				echo "<b>If this is incorrect, please contact us at admin@servebartnedcook.com</b>";
			echo "</div>";			
		}
	} else {
?>	
		<div id='hire_list_header' style='float:left; width:100%;'>
			<div style='float:left; width:100%; margin-top:10px; margin-left:2px'>			
<!-- 				<h2 style='margin-bottom:10px; margin-top:10px; color:black; text-align:center;'>Hire Confirmation</h2> -->
				<h3 style="text-align:center;"><? echo $job_title ?></h3>
				<h4 style='margin-bottom:10px; text-align:center;'><? echo $store ?></h4>
				<h4 style='text-align:center; margin-bottom:2px'>Have you completed your hiring?</h4>
				<div style="float:left; width100%; text-align:center;">
					<b>We need this information so that we can pay bounties.</b>
				</div>
			</div>
			
			<div style='float:left; width:100%;'>	
<?php
		
		echo "<div id='candidate_holder' style='float:left; width:90%; margin-left:10px; margin-right:10px;'>";
			echo "<h5 style='text-align:center;'>Please Select All of Candidates below that you have hired.</h5>";
			
			echo "<div class='warning' id='none_selection' style='float:left; width:100%; color:red; display:none; margin-bottom:3px; text-align:center;'>";
				echo "Please select a user OR select 'I Did Not Hire Anyone'";
			echo "</div>";
			
			if (count($recommended_candidates) > 0) {
				foreach($recommended_candidates as $row) {
					$selection = "unselected";
					if ($row['recommended_status'] == "hired") {
						$selection = "selected";			
					}	
					echo "<span class='hire_span ".$selection."_button' data-hire='".$selection."' data-hire_value='".$row['userID']."' style='cursor:pointer; margin-right:10px; margin-bottom:3px; '><span class='fui-check-inverted' style='color:white; float:left; '></span> ".$row['firstname']." ".$row['lastname']."</span>";
				}	
				
				echo "<div id='hire_button_holder' style='width:100%; float:left;'>";
					echo "<div class='green_button' id='show_confirm' style='float:left; width:135px; margin-top:20px;'>";
						echo "<span style='margin-left:10px; vertical-align:middle;'>Save Selection</span>";
					echo "</div><br />";
		
					echo "<div style='float:left; width:100%; margin-top:5px;'>";
						echo "<a href='#' id='show_confirm_none'><h5>I did not hire anyone from the list</h5></a>";
					echo "</div>";
									
					echo "<div style='float:left; width:100%;'>";	
						echo "<i>ServeBartendCook will pay bounties to the users who recommended the above candidates.</i><br />";
						echo "<b>Note:  If you plan on hiring more people from the site, PLEASE COMPLETE THIS ONLY AFTER YOU HAVE FINISHED HIRING.</b>";
					echo "</div>";
				echo "</div>";
					
			} else {
				echo "<b>No candidates with recommendations have applied for this position.</b><br />";
				echo "<b>We only need this information if you've hired someone with a 'Recommendation'.</b>";							
			}				
	
		echo "</div>";

		echo "<div id='confirmation_holder' style='display:none; width:100%; float:left; margin-top:20px; margin-left:3px;'>";
		
			echo "<h3 style='text-align:center;'>Confirmation</h3>";
			echo "<h4 style='margin-bottom:5px; text-align:center;'>I have completed my hiring and have hired the below candidates:</h4>";

			if (count($recommended_candidates) > 0) {
				foreach($recommended_candidates as $row) {
					echo "<div class='confirm_user_holder' ID='".$row['userID']."' style='display:none; float:left; width:100%; margin-bottom:0px; text-align:center;'><h5 style='margin-bottom:0px;'>".$row['firstname']." ".$row['lastname']."</h5></div>";
				}		
			}
	
				echo "<div class='green_button' id='confirm_hire' style='float:left; margin-top:20px; margin-left:10px; width:200px; '>";
					echo "<span style='margin-left:10px; vertical-align:middle;'>Confirm Selection</span>";
				echo "</div>";
				
				echo "<div style='float:left; width:100%; margin-top:10px; margin-left:10px;'>";
					echo "<a href='#' id='cancel_confirm'>CANCEL</a>";
				echo "</div>";
			echo "</div>";
			
		echo "<div id='confirmation_none_holder' style='display:none; width:100%; float:left; margin-top:20px;'>";
			echo "<h3 style='text-align:center;'>Confirmation</h3>";
			echo "<h4 style='text-align:center;'>I did not hire anyone from the list.</h4>";

			echo "<div class='green_button' id='confirm_none' style='float:left; margin-left:10px; width:200px; text-align:center'>";
				echo "<span style='margin-left:10px; vertical-align:middle;'>Confirm Selection</span>";
			echo "</div><br /> &nbsp; <br />";
			
			echo "<div style='float:left; width:100%; margin-top:10px; margin-left:10px;'>";
				echo "<a href='#' id='cancel_none'>CANCEL</a>";
			echo "</div>";
		echo "</div>";
			
		echo "</div>";
	}
}

function job_html_employer_similar_warning_mobile($similar_list, $job_title, $broad_skill, $view_count, $response_count) {
	switch($broad_skill) {
			case "Bartender":
				$image = "main-bar.png";
			break;
			
			case "Manager":
				$image =  "main-manager.png";
			break;
			
			case "Kitchen":
				$image =  "main-cook.png";
			break;
			
			case "Server":
				$image =  "main-server.png";
			break;
									
			case "Bus":
				$image =  "main-bus.png";
			break;

			case "Host":
				$image =  "main-host.png";
			break;						
		}
	
	echo "<h3 style='text-align:center'>Similar Jobs in Your Region</h3>";
	echo "<div style='float:left; width:98%; background-color:#e9e6de; padding-top:6px; padding-left:1%; padding-right:1%'>";
		echo "<h4>Your Job: ".$job_title."<br />";
		echo "Approx. Overall Rank: NA<br />";
		echo "Current Views: ".$view_count."<br />";
		echo "Current Responses: ".count($response_count)."</h4>";
	echo "</div>";
		
	echo "<table class='dark' style='width:100%'><tr>";
		echo "<th style='width:30%'>Similar Job</th>";
		echo "<th style='width:20%'>Pay/Salary</th>";
		echo "<th style='width:20%'>Bounty</th>";
		echo "<th style='width:15%'>Views</th>";
		echo "<th style='width:15%'>Responses</th>";
	echo "</tr></table>";
	
	echo "<h3>Similar Job Data is no longer available</h3>";
/*
	if (count($similar_list) > 4) {
		echo "<h4>Posting a Bounty Job would have allowed you to compare your results to ".count($similar_list)." similar local jobs.</h4>";
	}
*/
	
/*
	echo "<div style='float:left; width:100%; text-align:center'>";
		echo "<a href='job.php?ID=new_job'><div class='green_button choice' id='bounty_final' style='float:left; width:98%; text-align:center'>";
			echo "<img src='images/savegreen.png' style='width:25px;height:25px;vertical-align:middle'>";
			echo "<span style='margin-left:10px; vertical-align:middle;'>Post a Bounty Job!</span>";
		echo "</div></a>";
	echo "</div>";
	
	echo "<div style='float:left; width:100%; text-align:center;'>";
		echo "<i>Bounty Posts help support the ServeBartendCook community</i><br />";
		echo "<a href='main.php?page=bounty_summary'>Learn More About Bounty Job Posts</a>";
	echo "</div>";
*/
}

function job_html_employer_expired_mobile($job_data) {					
$utilities = new Utilities;
//==================================
//!  First break master arrays into trait arrays
//
//  Modify any data for presentation
//==================================

		$jobID							= $job_data['general']['jobID'];
		$job_status					= $job_data['general']['job_status'];
		$expiration_date				= $job_data['general']['expiration_date'];
		$store_name					= $job_data['general']['store_name'];
		$title		 						= $job_data['general']['title'];
		$description					= $utilities->mynl2br($job_data['general']['description']);
		$qualifications					= $utilities->mynl2br($job_data['general']['qualifications']);
		$main_skill		 				= $job_data['skills']['main_skill']['specialty'];
		$benefits						= $job_data['general']['benefits'];
		$benefits_desc				= $utilities->mynl2br($job_data['general']['benefits_desc']);
		$schedule						= $job_data['general']['schedule'];
		$comp_type					= $job_data['general']['comp_type'];
		$comp_value					= $job_data['general']['comp_value'];
		$job_questions_array		= $job_data['questions'];
		$required_skills				= $job_data['skills']['required_sub_skills'];
		$preferred_skills				= $job_data['skills']['preferred_sub_skills'];
		$employment					= $job_data['general']['past_employment'];
		$reach_count					= $job_data['candidate_count'];
		$candidates_array			= $job_data['positive_list'];
		$views							= $job_data['view_count'];
		$declines						= $job_data['negative_count'];
		$candidate_videos			= $job_data['candidate_videos'];

		$responses = count($candidates_array);
		
		//calculate hours left before expiration
		date_default_timezone_set('America/Los_Angeles');		
		$date1 =  time();
		$date2 = strtotime($expiration_date);
		$hourdiff = ($date2 - $date1) / 3600;

		if ($hourdiff < 0) {
			$job_status = "Expired";
		}

		if ($benefits == "Y") {
			$benefits_text =	"<tr><td>BENEFITS:</td><td>".$benefits_desc."</td></tr>";
		} else {
			$benefits_text = 	"<tr><td>BENEFITS:</td><td>NA</td></tr>";				
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
		
		if ($job_status == "Expired") {		
			$candidate_bar = " ";
			$expiration = "EXPIRED";
		} else {
			$candidate_bar = " ";
			$expiration = "Expires:  ".date('M j, Y', strtotime($expiration_date));			
		}

//==================================
//!  Display
//==================================
		
		echo "<div class='main_box' style='margin-top:30px; width:100%;'>";		

		echo "<h4 style='margin-top:-15px; margin-left:5px;'>Job Post ".$job_status."</h4>";	
		echo $candidate_bar;
		echo	"<table class='dark' style='width:100%;'>";
			echo "<tr valign='middle'>";
			echo "<th valign='middle' align='left'><b>".$title."</b></th>";
			echo "</tr>";			
		echo "</table>";
		
		switch($main_skill) {
			case "Bartender":
				echo "<div style='float:right; margin-right:10px; margin-top:-55px;'><img src='images/main-bar.png' height='80px'></div>";
			break;
			
			case "Manager":
				echo "<div style='float:right; margin-right:10px; margin-top:-55px;'><img src='images/main-manager.png' height='80px'></div>";
			break;
			
			case "Kitchen":
				echo "<div style='float:right; margin-right:10px; margin-top:-55px;'><img src='images/main-cook.png' height='80px'></div>";
			break;
			
			case "Server":
				echo "<div style='float:right; margin-right:10px; margin-top:-55px;'><img src='images/main-server.png' height='80px'></div>";
			break;
									
			case "Bus":
				echo "<div style='float:right; margin-right:10px; margin-top:-55px;'><img src='images/main-bus.png' height='80px'></div>";
			break;

			case "Host":
				echo "<div style='float:right; margin-right:10px; margin-top:-55px;'><img src='images/main-host.png' height='80px'></div>";
			break;						
		}					
?>
		<div id="job_listing">
		<div id="job_details">	
<?php
		echo "<table class='dark'>";
?>		
			<tr><td>SCHEDULE:</td><td><? echo $schedule ?></td></tr>
			<tr><td>COMPENSATION:</td><td><? echo $compensation ?></td></tr>

<?php
			if ($benefits == "Y") {
				echo 	"<tr><td>BENEFITS:</td><td>".$benefits_desc."</td></tr>";
			} else {
				echo 	"<tr><td>BENEFITS:</td><td>NA</td></tr>";				
			}
?>			
		</table>					

		<div id="job_skills">	
			<div style='flat:left'>	
				<table class='dark' style='width:48%; float:left;'>
					<tr valign='middle'>
					<th valign='middle'><b>Required</b></th>
					</tr>			
				</table>
				
				<table class='dark' style='width:48%; float:right;'>
					<tr valign='middle'>
					<th valign='middle'><b>Preferred</b></th>
					</tr>			
				</table>
			</div>	
			
			<div style='flat:left; width:100%'>	
				<table style='width:46%; float:left;' cellpadding="6" cellspacing="6" >
<?php
				if (count($required_skills) > 0) {
					foreach ($required_skills as $row) {
						echo "<tr><td style='margin-left:3px'><b> &#9830; ".$row['sub_specialty']."</b></td></tr>";
					}	
				} else {
					echo "<tr><td> &nbsp; </td></tr>";					
				}
?>				
				</table>
				
				<table style='width:46%; float:right;' cellpadding="6" cellspacing="6">
<?php		
				if (count($preferred_skills) > 0) {
					foreach ($preferred_skills as $row) {
						echo "<tr><td style='margin-left:3px'> &#9830; ".$row['sub_specialty']."</td></tr>";
					}	
				} else {
					echo "<tr><td> &nbsp; </td></tr>";					
				}
?>	
			</table>
			</div><br />
			&nbsp; <br />								
<?				
			echo "<div style='margin-top:15px; float:left; width:100%;'>";
			echo "<hr style='border: 1px solid #760006;'>";
			
			echo "<div style='float:left; width:100%;'>";			
				echo "<div class='bubble_inside' style='width:89%; float:left; background-color:#E7E7DD; margin-left:2px; margin-right:2px; padding-bottom:20px;'>";
					echo "<h5 style='text-align:center; margin-top:-11px; margin-bottom:0px;'>PRIMARY RESPONSIBILITIES</h5>";
						echo "<div style='color:black; float:left; margin-left:2px; margin-right:2px;'>";
							echo $description;		
						echo "</div>";	
				echo "</div>";
			echo "</div>";
			
			echo "<div style='float:left; width:100%; margin-top:-10px;'>";			
				echo "<div class='bubble_inside' style='width:89%; float:left; background-color:#E7E7DD; margin-left:2px; margin-right:2px; padding-bottom:20px;'>";
					echo "<h5 style='text-align:center; margin-top:-11px; margin-bottom:0px;'>SPECIFIC REQUIREMENTS</h5>";
						echo "<div style='color:black; float:left; margin-left:2px; margin-right:2px;'>";
							echo $qualifications;		
						echo "</div>";	
				echo "</div>";
			echo "</div>";
			
			if (count($question_array) > 0) {
				echo "<div id='interview_question' style='margin-top:25px; float:left; width:100%;'>";
				echo "<hr style='border: 1px solid #760006; margin-bottom:10px;'>";
				echo "<b>PRE-INTERVIEW QUESTIONS:</b><br />";
				echo "&nbsp; <br />";	
				foreach ($question_array as $question) {
					echo "Question:<br />";							
					echo "<div style='color:gray; margin-top:3px; margin-left:10px; float:left; width:100%'>";	
					echo $question['question']."<br />";
					echo "</div><br />";
					echo "&nbsp; <br />";
				}
				echo "</div>";
			}
			echo "</div>";			
			echo "</div>";
	echo "</div>";
}

function job_html_removed_mobile() {
		echo "<h4 style='margin-top:-15px;'>This job post has been removed.</h4>";
		echo "Please contact admin@servebartendcook.com with questions.<br />";	
}

function job_html_employer_no_edit_mobile() {
		echo "<h4 style='margin-top:-15px;'>This function is not available for Open, Filled, or Expired Jobs</h4>";	
}