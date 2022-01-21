<?php
function main_html_employee_mobile($profile_status, $first_name, $last_name, $new_notifications, $general_notifications, $bounty_count) {

	if ($bounty_count > 0) {
		$bounty_note = "(".$bounty_count.")";
	} else {
		$bounty_note = "";
	} 	

?>
	<div id="holder" class='panel'>
		
	<div style="margin-top:15px;">
		<h3 style='margin-top:-7px; margin-left:10px;'>Welcome, <? echo $first_name ?></h1>
		<h4 style='margin-top:-5px; margin-left:12px;'>Job-Seeker Account</h4>
		
		<div style="float:left; width:100%;">
<?php
		notification_display_employee_mobile($new_notifications, $general_notifications, $bounty_count);
?>						
	<h3 style='margin-left:8px'>Today I'd like to...</h3>
	<div id='main_buttons' style='width:100%; float:left; text-align:center; padding-left:5%;'>
		<div style="float:left; width:100%">
			<div  style='width:32%; float:left;'>
				<img class='jobs_button' src='images/bountyemployer.png' height='120px' width='120px' alt='bounty' style='cursor:pointer'>
			</div>
			<div style='width:60%; float:left; text-align:center; margin-left:25px;margin-top:10px'>
				<div class='jobs_button' style='float:left; margin-top:30px; width:130px; text-align:center; padding-right:10px; padding-left:10px; padding-top:3px; padding-bottom:3px; background-color:#2e6652; margin-bottom:5px; margin-right: 10px; border-radius:5px; color:white; cursor:pointer'><h5 style='margin-top:8px; margin-bottom:8px'>Job Matches</h5></div>

<!--
				<div class='bounty_list_button' style='float:left; width:130px; text-align:center; padding-right:10px; padding-left:10px; padding-top:8px; padding-bottom:8px; background-color:#2e6652; margin-bottom:5px; margin-right: 10px; border-radius:5px; color:white; cursor:pointer'>Earn Money <? echo $bounty_note ?></div>
				<div class='bounty_status_button' style='float:left; width:130px; text-align:center; padding-right:10px; padding-left:10px; padding-top:8px; padding-bottom:8px; background-color:#2e6652; margin-bottom:5px; margin-right: 10px; border-radius:5px; color:white; cursor:pointer'>Check Bounty Status</div>
-->
<!-- 				<div style='float:left; width:130px; text-align:center; padding-right:10px; padding-left:10px; padding-top:8px; padding-bottom:8px; margin-bottom:5px; margin-right: 10px;'><a href='main.php?page=bounty_faq'>LEARN MORE</a></div> -->
			</div>
		</div>

		<div style="float:left; width:100%; margin-top:-15px;">		
			<div  style='width:32%; float:left;'>
				<img class='jobs_button' src='images/findajob.png' height='120px' width='120px' alt='bounty' style='cursor:pointer'>
			</div>
			<div style='width:60%; float:left; text-align:center; margin-left:25px;margin-top:10px'>
<!-- 				<div class='jobs_button' style='float:left; width:130px; text-align:center; padding-right:10px; padding-left:10px; padding-top:8px; padding-bottom:8px; background-color:#760006; margin-bottom:5px; margin-right: 10px; border-radius:5px; color:white; cursor:pointer'>View Job Matches</div> -->
				<div class='profile_button' style='float:left; margin-top:30px; width:130px; text-align:center; padding-right:10px; padding-left:10px; padding-top:3px; padding-bottom:3px; background-color:#760006; margin-bottom:5px; margin-right: 10px; border-radius:5px; color:white; cursor:pointer'><h5 style='margin-top:8px; margin-bottom:8px'>Update Profile</h5></div>
<!-- 				<div style='float:left; width:130px; text-align:center; padding-right:10px; padding-left:10px; padding-top:8px; padding-bottom:8px; margin-bottom:5px; margin-right: 10px;'><a href='main.php?page=general_faq'>LEARN MORE</a></div> -->
			</div>
		</div>
		
		<div style="float:left; width:100%">	
			<div style='width:32%; float:left;'>
				<img class='responses_button' src='images/jobresponse.png' height='120px' width='120px' alt='bounty' style='cursor:pointer'>
			</div>
			<div style='width:60%; float:left; text-align:center; margin-left:25px;margin-top:10px'>
				<div class='responses_button' style='float:left; margin-top:30px; width:130px; text-align:center; padding-right:10px; padding-left:10px; padding-top:3px; padding-bottom:3px; background-color:#760006; margin-bottom:5px; margin-right: 10px; border-radius:5px; color:white; cursor:pointer'><h5 style='margin-top:8px; margin-bottom:8px'>Applications</h5></div>
<!-- 				<div class='interview_button' style='float:left; width:130px; text-align:center; padding-right:10px; padding-left:10px; padding-top:8px; padding-bottom:8px; background-color:#760006; margin-bottom:5px; margin-right: 10px; border-radius:5px; color:white; cursor:pointer'>View Interviews</div> -->
<!-- 				<div style='float:left; width:130px; text-align:center; padding-right:10px; padding-left:10px; padding-top:8px; padding-bottom:8px; margin-bottom:5px; margin-right: 10px;'><a href='main.php?page=interview_faq'>LEARN MORE</a></div> -->
			</div>
		</div>
	</div>

		</div>		
	</div>

	<div id='incomplete_profile' style='width:100%; float:left; text-align:center; padding-top:35px; padding-bottom:25px; color:#8e080b; display:none;'>
		<h3>Oops, you aren't quite ready.</h3>  <h3>You still need to complete your profile.</h3>
		<h4><a href='#'>Click Here</a> to complete your profile (Don't forget to click the green "Finalize Profile" button at the bottom)</h4>
		<b><a href='#' id='close_warning'>Back</a></b>
	</div>

			<div style='float:left; width:100%; text-align:center; margin-bottom:10px; margin-top:10px;' >
				<a href='main.php?page=faq'><div class='btn btn-large btn-primary' style='float:left; width:43%; text-align:center;margin-left:3px;'>HELP/FAQ</div></a> 
				<a href='employee.php?page=settings'><div class='btn btn-large btn-primary' style='float:right; width:43%; text-align:center;margin-right:3px;'>SETTINGS</div></a>
			</div>	

			<div style='width:100%; text-align:center;'>
				<a href="http://facebook.com/servebartendcook"><img src="images/facebook.png" border="0"></a>
				<a href="http://twitter.com/servebarcook"><img src="images/twitter.png" border="0"></a>
				<a href="http://instagram.com/servebartendcook"><img src="images/Istagram-Icon.png" border="0" height='40px' width='40px'></a>
			</div>
			
			
			<div style='float:left; width:100%; margin-top:10px;' >
				<table class="dark" style='width:100%'>
					<tr>
						<th align='right' id='logout'>LOGOUT</th>
					</tr>	
				</table>
			</div>						
			
		<div style='width:100%; text-align:center; padding-bottom:20px;'>
			<a href="http://servebartendcook.com/index.php?page=privacy_policy">Privacy Policy</a> | <a href="http://servebartendcook.com/index.php?page=TOS">Terms of Service</a><br />
			<p>Copyright &copy; 2017 SBC Industries, LLC</p>
		</div>		
</div>
<?php	
	}	
	
		
function employee_opportunity_summary_mobile_html($opportunity_count, $unqualified_count) {
	echo "<span id='opportunity_summary_holder' style='float:left; width:100%;'>";
			echo "Matches: ".count($opportunity_count)." / <i>Other:  ".$unqualified_count."</i>";
	echo "</span>";										
}

function urgent_html_employee_mobile($profile_status, $first_name, $last_name, $urgent_notifications) {
?>
	<div id="holder">
		<div style="margin-top:15px;">
		<h1 style='margin-top:-5px; margin-left:12px;'>Hi <? echo $first_name."  ".$last_name ?></h1>
		
		<div style="float:left; width:100%;">
<?php
		if ($urgent_notifications['urgent_count'] > 1) {
			echo "<h4>You have ".$urgent_notifications['urgent_count']." items to take care of below:</h4>";
		} else {
			echo "<h4>You have one item to take care of below:</h4>";			
		}
		
	//the notification display order will take care of itself, pull the first item off of the top of the list
	if (count($urgent_notifications['interview_one']) > 0) {
		$urgent_notification_details = $urgent_notifications['interview_one'][0];	
		$title = "<h3 style='display:inline;'>Interview Reminder</h3>";
		
		$sub_title = "";	

		$notice_text = "<table style='float:left; width:100%;margin-left:10px;'>";
			$notice_text .= "<tr><td><b>Interview Date:</b></td> <td>".date("F j, Y, g:i a", strtotime($urgent_notification_details['interview_date']))."</td></tr>";
			$notice_text .= "<tr><td><b>Company:</b></td> <td> ".$urgent_notification_details['name']."</td></tr>";
			$notice_text .= "<tr><td><b>Position:</b></td> <td> ".$urgent_notification_details['title']."</td></tr>";
		$notice_text .= "</table>";
		
		$action_text = "<h4 style='margin-top:20px'>Are you still planning on attending this interview?</h4>";

		$buttons = "<div style='width:100%; float:left; text-align:center;'>";
		$buttons .= "<a href='#' class='continue_one' id='".$urgent_notification_details['matchID']."'><h5 style='margin-bottom:0px;'>I plan to attend.</h5></a>";
		$buttons .= "(<i>You can still cancel later</i>)<br />";
		$buttons .= "<h5><a href='#' id='cancel_initial' style='color:red'>Cancel Interview*</a></h5>";
		$buttons .= "</div>";
		$buttons .= "<b>*You can cancel with one click, no need to give a reason. We'll notify the employer.</b><br />";
		
		$continue = "continue_one";
		
	} elseif (count($urgent_notifications['interview_three']) > 0) {
		$urgent_notification_details = $urgent_notifications['interview_three'][0];	
		$title = "<h3 style='display:inline;'>Interview Reminder</h3>";
		//$sub_title = "<h4>You have an interview coming up in the next few days.</h4>";	
		$sub_title = "";	

		$notice_text = "<table style='float:left; width:100%;margin-left:10px;'>";
			$notice_text .= "<tr><td><b>Interview Date:</b></td> <td>".date("F j, Y, g:i a", strtotime($urgent_notification_details['interview_date']))."</td></tr>";
			$notice_text .= "<tr><td><b>Company:</b></td> <td> ".$urgent_notification_details['name']."</td></tr>";
			$notice_text .= "<tr><td><b>Position:</b></td> <td> ".$urgent_notification_details['title']."</td></tr>";
		$notice_text .= "</table>";
		
		$action_text = "<h4 style='margin-top:20px'>Are you still planning on attending this interview?</h4>";

		$buttons = "<div style='width:100%; float:left; text-align:center;'>";
		$buttons .= "<a href='#' class='continue_three' id='".$urgent_notification_details['matchID']."'><h5 style='margin-bottom:0px;'>I plan to attend.</h5></a>";
		$buttons .= "(<i>You can still cancel later</i>)<br />";
		$buttons .= "<h5><a href='#' id='cancel_initial' style='color:red'>Cancel Interview*</a></h5>";
		$buttons .= "</div>";
		$buttons .= "<b>*You can cancel with one click, no need to give a reason. We'll notify the employer.</b><br />";

		$continue = "continue_three";
		
	} elseif (count($urgent_notifications['employer_cancel']) > 0) {
		$urgent_notification_details = $urgent_notifications['employer_cancel'][0];	
		$title = "<h3 style='display:inline;'>Interview Canceled</h3>";
		$sub_title = "";
		
		$notice_text = "&nbsp; <br /><b>".$urgent_notification_details['name']." canceled your interview that was scheduled for ".date("F j, Y, g:i a", strtotime($urgent_notification_details['interview_date']))."</b><br />";
		$notice_text .= "&nbsp; <br />";
				
		$action_text = "<a href='#' class='accept_cancel' id='".$urgent_notification_details['matchID']."'><h5 style='text-align:center'>Continue to Main Site</h5>";

		$buttons = "";
		
		$continue = "";		
	}
		
?>					
	<div style='float:left; width:96%;padding-left:5px; padding-top:5px; padding-bottom:5px; background-color:#e9e6de; border-style:solid; border-color:#760006; border-width:3px; margin-top:0px; border-radius:20px; margin-bottom:10px'>
		<a href='#' class='view_notices'><img src='images/postjob.png' height='50px' width='50px' alt='recommendation' style='vertical-align:middle;'></a>  <? echo $title ?>
			
<?php
		echo "<div id='urgent_holder' style='width:85%; margin-left:10px'>";
			echo $sub_title;		
			echo $notice_text;
			echo $action_text;
			echo $buttons;
		echo "</div>";
		
		echo "<div id='confirmation_holder' style='width:100%; float:left; margin-right:5px; min-height:250px; display:none;'>";
			echo "<h4 style='margin-top:20px'>Are you sure you want to cancel your interview with ".$urgent_notification_details['name']."?</h4>";	
			echo  "<h5 style='text-align:center'><a href='#' class='cancel_confirm' id='".$urgent_notification_details['matchID']."' style='color:red'>Confirm Cancellation</a></h5>";
			
			echo "<div style='width:100%; float:left; text-align:center'>";			
				echo "<a href='#' class='".$continue."' id='".$urgent_notification_details['matchID']."'><b>No, I plan to attend.</b></a>";
			echo "</div>";
		echo "</div>";
		
		echo "<div id='cancel_saved' style='width:100%; margin-left:10px margin-right:5px; text-align:center; min-height:250px; display:none'>";
			echo "<h4>Interview Canceled</h4>";
			echo "<b>We will contact ".$urgent_notification_details['name']." to let them know.  No further action required.</b><br />";
			echo " &nbsp; <br />";
			echo " &nbsp; <br />";
			echo "<a href='#' class='continue'><h5>Continue to Main Site</h5>";
		echo "</div>";
		
	echo "</div>";
}		
	
function main_html_employer_mobile($first_name, $last_name, $photo_setting, $employer_data, $email_verification) {
	
	$notice_count = 0;
	
	//Get store count
	$store_count = count($employer_data['stores_jobs']['stores']);

	if ($store_count == 0) {
		$account_switch_text = "<div style='margin-left:10px; width:100%; float:left; margin-right:5px; margin-bottom:5px; '>Are you a Job Seeker here to view jobs?  <a href='employer.php?page=switch_account'>Click Here</a></div><br />";
		$notice_count++;
	} else {
		$account_switch_text = "";		
	}

	if ($email_verification == "N") {
		$verification_text = "<div style='margin-left:10px; width:100%; float:left; margin-right:5px; '>You need to verify your email address: <a href='main.php?page=verify_email'>VERIFY</a> </div><br />";
		$notice_count++;
	} else {
		$verification_text = "";		
	}
	
	if ($photo_setting == "Y") {
		$photo_text = "";
	} else {
		$photo_text = "<div style='margin-left:10px; width:100%; float:left; margin-right:5px; margin-bottom:5px'>Candidate photos are:  <a href='main.php?page=settings'>OFF</a></div>";		
		$notice_count++;
	}
	
	if ($notice_count == 0) {
		$notice_count_text = "<div style='margin-left:10px; float:left; width:100%; margin-right:5px; margin-bottom:5px; text-align:center;'><i>To post a new job, click 'Post a Job'.</i><br /><i>To view current responses, click an open job below.</i></div>";
	} else {
		$notice_count_text = "";
	}	

/*******************
*
*  Displays main page after login
*
********************/
?>		
	<div id="holder">

	<? echo $account_switch_text ?>	
	<div style="margin-top:10px; float:left; width:100%;">
		<h3 style='margin-top:-7px; margin-left:10px;'>Welcome, <? echo $first_name ?>!</h1>
		<h4 style='margin-top:-5px; margin-left:12px; margin-bottom:0px;'>Employer Account</h4>
		
				<div style='width:100%; float:left; margin-bottom:10px; margin-top:18px; '>

					<div style='width:100%; float:left;'>
						<a href='job.php?ID=new_job&page=location'>		
						<div style='width:3%; float:left'><img src="images/postjob.png" alt="post_job" style="position: relative; bottom: 8px; height:80px"></div>
						<div class='unselected_job_areas'>Post a Job<br>
							<span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>Find new staff now.</span>
						</div>
						</a>
					</div>
					
					<div style='width:100%; float:left;'>
						<a href='job_list.php'>		
						<div style='width:3%; float:left'><img src="images/postjob.png" alt="post_job" style="position: relative; bottom: 8px; height:80px"></div>
						<div class='unselected_job_areas'>Quick Repost<br>
							<span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>Repost an old opening.</span>
						</div>
						</a>
					</div>
					
				</div>
			
			<div style='width:100%; float:left; margin-top:10px;'>
				
				<div id='job_summary_holder' style='width:100%; float:left; margin-bottom:8px; margin-right:8px; background-color:#ffffff;'>
					<div style='float:left; width:100%; background-color:#4c0100; color:white; text-align:center; padding-bottom:12px;'>
						<h4 style='margin-bottom:0px; padding-top:3px;'>My Current Job Posts</h4>
					</div>

					<div style='text-align:center; float:left; width:100%; margin-top:20px;'>LOADING....</div>
				
				</div>					
			</div>					
						
			<div style='float:left; width:100%; text-align:center; margin-bottom:10px;'>
				<a href='employer.php'><div class='btn btn-large btn-primary' style='float:right; width:43%; text-align:center;margin-right:3px;'>SETTINGS</div></a> <a href='main.php?page=faq'><div class='btn btn-large btn-primary' style='float:left; width:43%; text-align:center;margin-left:3px;'>HELP/FAQ</div></a><br />
			</div>			

			<div style='width:100%; text-align:center;'>
				<a href="http://facebook.com/servebartendcook"><img src="images/facebook.png" border="0"></a>
				<a href="http://twitter.com/servebarcook"><img src="images/twitter.png" border="0"></a>
				<a href="http://instagram.com/servebartendcook"><img src="images/Istagram-Icon.png" border="0" height='40px' width='40px'></a>
			</div>
			
			
			<div style='float:left; width:100%; margin-top:10px;' >
				<table class="dark" style='width:100%'>
					<tr>
						<th align='right' id='logout'>LOGOUT</th>
					</tr>	
				</table>
			</div>						
			
		<div style='width:100%; text-align:center; padding-bottom:20px;'>
			<a href="http://servebartendcook.com/index.php?page=privacy_policy">Privacy Policy</a> | <a href="http://servebartendcook.com/index.php?page=TOS">Terms of Service</a><br />
			<p>Copyright &copy; 2016 SBC Industries, LLC</p>
		</div>		
</div>

		<?php
	}//end html_page_main function
	
function urgent_html_employer_mobile($first_name, $last_name, $urgent_notifications) {
?>
	<div id="holder" style='float:left; width:100%;'>
		<div style="margin-top:15px;">
		<h3 style='margin-top:-5px; margin-left:12px;'>Hi <? echo $first_name."  ".$last_name ?></h3>
		
		<div style="float:left; width:100%; margin-left:2px;">
<?php
		if ($urgent_notifications['urgent_count'] > 1) {
			echo "<h4>There are ".$urgent_notifications['urgent_count']." items to take care of below:</h4>";
		} else {
			echo "<h4>There is one item to take care of below:</h4>";			
		}
		
	//the notification display order will take care of itself, pull the first item off of the top of the list
	if (count($urgent_notifications['hire_notice'])) {
		$urgent_notification_details = $urgent_notifications['hire_notice'][0];	

		if (date("Y-m-d") >= $urgent_notification_details['job_details']['expiration_date']) {
			$confirm_none_class = "confirm_none";
		} else {
			$confirm_none_class = "show_confirm_none";
		}
		
		$title = "&nbsp; &nbsp; <h3 style='display:inline'>Bounty Follow-up</h3>";
		$sub_title = "<h4 class='sub_title' style='margin-top:10px; margin-bottom:5px;'>Have you hired anyone for: </h4>";
		$sub_title .= "<h4 class='sub_title' style='margin-top:0px; margin-bottom:0px;'>".$urgent_notification_details['job_details']['title']." at ".$urgent_notification_details['job_details']['name']."</h4>";
		$sub_title .= "<i class='sub_title'>Posted on ".date('M j, Y', strtotime($urgent_notification_details['job_details']['date_created']))."</i><br />";

		$action_text = "<div id='choice_holder' style='width:100%; float:left'>";
			$action_text .= "&nbsp; <br />";
			$action_text .= "<a href='#' class='still_hiring' id='".$urgent_notification_details['job_details']['jobID']."'><h5>No, I am still in the process of hiring.</h5></a>";
			$action_text .= "<a href='#' id='show_complete'><h5>Yes, I have hired candidate(s) for this position.</h5></a>";
		$action_text .= "</div>"; 		

		$action_text .= "<div id='candidate_holder' style='width:100%; float:left; display:none'>";
			$action_text .= "<h4 style='margin-bottom:0px'>Select everyone you have hired for this position:</h4>";
			$action_text .= "<i style='font-size:.8em'>These are candidates who were recommended by other users.</i><br />";
			$action_text .= "<i style='font-size:.8em'>We need this information to properly pay bounties.</i>";

			$action_text .= "<table style='margin-top:10px; float:left; width:100%;'>";
			$row_count = 2;
			foreach($urgent_notification_details['candidate_details'] as $row) {					
				if ($row['recommend_status'] == "Hired") {
					$selected_class = "selected_button";
					$selected_data = "selected";
				} else {
					$selected_class = "unselected_button";
					$selected_data = "unselected";		
				}

				if ($row_count % 2 == 0) {														
					$action_text .=  "<tr>";					
						$action_text .=  "<td align='left' width='43%'><span class='candidate ".$selected_class."' data-user_selection='".$selected_data."' data-hire_value='".$row['userID']."' style='cursor:pointer;'><span class='fui-check-inverted' style='color:white; float:left; '></span> ".$row['firstname']." ".$row['lastname']."</span></td>";
				} else {
						$action_text .= "<td align='left' width='43%'><span class='candidate ".$selected_class."' data-user_selection='".$selected_data."' data-hire_value='".$row['userID']."' style='cursor:pointer;'><span class='fui-check-inverted' style='color:white; float:left; '></span> ".$row['firstname']." ".$row['lastname']."</span></td>";
					$action_text .= "</tr>";
				}
				$row_count++;
			}
			if ($row_count % 2 == 0) {	
				$action_text .= "</tr>";
			}																		
			$action_text .= "</table>";
			
			$action_text .=  "<div style='float:left; width:100%; margin-bottom:10px;'>";
				$action_text .=  "<span class='unselected_button ".$confirm_none_class."' id='".$urgent_notification_details['job_details']['jobID']."' style='cursor:pointer;'><span class='fui-check-inverted' style='color:white; float:left; '></span> None of the above</span>";
			$action_text .=  "</div>";	
			
			$action_text .= "<a href='#' id='save_step'><h5>Save Selection</h5></a>";
			$action_text .= "<a href='#' class='still_hiring' id='".$urgent_notification_details['job_details']['jobID']."'>Oops, I haven't completed hiring yet.</a><br />";
			
		$action_text .= "</div>";
		
		//holder for confirmation, but them in spans to show or hide
		$action_text .= "<div id='confirm_holder' style='width:100%; float:left; display:none'>";
			$action_text .= "<div id='confirm_user_text' style='width:100%; float:left;'>Please confirm that you hired the following:<br /></div><br />";
			foreach($urgent_notification_details['candidate_details'] as $row) {
				$action_text .= "<div class='confirm_user_holder' ID='".$row['userID']."' style='display:none'><b>".$row['firstname']." ".$row['lastname']."</b></div><br />";		
			}			
			$action_text .= "<a href='#' class='confirm_candidates' id='".$urgent_notification_details['job_details']['jobID']."'><h5 style='margin-top:0px; margin-bottom:0px;'>I'm done hiring</h5></a><i>This will mark your job as filled</i>";			
			$action_text .= "<br /><a href='#' class='confirm_candidates_open' id='".$urgent_notification_details['job_details']['jobID']."'><h5>I've hired the above, but may still hire someone else</h5></a><br />";			
			$action_text .= "<a href='#' id='back'>Back</a><br />";
		$action_text .= "</div>";

		$action_text .= "<div id='confirmation_none_holder' style='width:100%; float:left; display:none'>";
			$action_text .= "<div style='width:100%; float:left;'><h4>You did not hire anyone from the previous list?</h4></div>";
			$action_text .= "<br /><a href='#' class='confirm_none' id='".$urgent_notification_details['job_details']['jobID']."'><h5 style='margin-bottom:0px;'>I've hired someone else, or am no longer hiring</h5></a><i>This will mark your job as filled</i><br /> &nbsp; <br />";			
			$action_text .= "<a href='#' class='still_hiring' id='".$urgent_notification_details['job_details']['jobID']."'><h5>I am still in the process of hiring.</h5></a>";
			$action_text .= "<a href='#' id='cancel_none'>Back</a><br />";

		$action_text .= "</div>";
		
		$buttons = "";
		
	} elseif (count($urgent_notifications['interview_cancels']) > 0) {
		$urgent_notification_details = $urgent_notifications['interview_cancels'][0];	
		$title = " &nbsp; &nbsp; <h3 style='display:inline'>Interview Canceled</h3>";
		$sub_title = "<h4 style='margin-top:10px; margin-bottom:25px;'>".$urgent_notification_details['firstname']." ".$urgent_notification_details['lastname']." has canceled her/his interview.</h4>";	

		$action_text = "<b>The interview on ".date("F j, Y, g:i a", strtotime($urgent_notification_details['interview_date']))." for the position '".$urgent_notification_details['title']."' has been canceled.</b><br />";
		
		$buttons = "&nbsp; <br /> &nbsp; <br /><a href='#' class='accept_cancel_employer' id='".$urgent_notification_details['matchID']."'><h5>Continue to Main Site</h5></a><br />"; 
	}
?>					
	<div style='float:left; width:95%; padding-left:5px; padding-top:5px; padding-bottom:5px; background-color:#e9e6de; border-style:solid; border-color:#760006; border-width:3px; margin-top:0px; border-radius:20px; margin-bottom:10px'>
		<a href='#' class='view_notices'><img src='images/postjob.png' height='50px' width='50px' alt='recommendation' style='vertical-align:middle;'></a>  <? echo $title ?>
			
<?php
		echo "<div id='confirmation_holder' style='width:97%; text-align:center; float:left; margin-left:3px; margin-right:5px; min-height:200px;'>";	
			echo $sub_title;			
			echo $action_text;
			echo $buttons;
		echo "</div>";
	echo "</div>";
}

function notification_display_employee_mobile($new_notifications, $general_notifications, $bounty_count) {

	//start with general notices
	//at the moment these are email verification warning, and old employment type warning

	$general_count = 0;
	if ($general_notifications['email_verification'] == "N") {
		$verification_text = "<div style='margin-left:10px; width:100%; float:left; margin-right:3px; '><b>You need to verify your email address:</b> <a href='main.php?page=verify_email'>VERIFY</a> </div><br />";
		$general_count++;
	} else {
		$verification_text = "";		
	}
				
	if ($general_notifications['employment_version'] == "old") {
		$employment_version_notice = "<div style='margin-left:10px; float:left; width:100%; margin-bottom:5px;'>We've updated our matching system.  Please update your skills & experience to receive more accurate job opportunities.</div>";		
		$general_count++;
	} else {
		$employment_version_notice = "";
	}

	$recommendation_count = 0;
	$recommend_display = "display:none;";
	$toggle_show = "";
	$toggle_hide = "display:none;";
	$recommendation_notice = "";
	if (count($new_notifications['recommendations']) > 0) {
		if ($new_notifications['recommendations'] != "NA") {
			foreach($new_notifications['recommendations'] as $row) {
				$recommendation_notice .= "<font color='red'><b><i>NEW</i></b></font> ".$row['name']['firstname']." ".$row['name']['lastname']." has recommended you for the <a href='opportunity.php?ID=".$row['opportunity_details']['jobID']."&hash=".$row['opportunity_details']['public_hash']."'>".$row['opportunity_details']['title']." at ".$row['opportunity_details']['name']."</a>. <br />";
				$recommendation_count++;
				$toggle_show = "display:none;";
				$toggle_hide = "";
				$recommend_display = "";
			}
		} else {
			$recommendation_notice .= "";
		}
	}
	
	if (count($general_notifications['recommendations']) > 0) {
		if ($general_notifications['recommendations'] != "NA") {
			foreach($general_notifications['recommendations'] as $row) {
				$recommendation_notice .= "<b>&#8226; ".$row['name']['firstname']." ".$row['name']['lastname']." has recommended you for the <a href='opportunity.php?ID=".$row['opportunity_details']['jobID']."&hash=".$row['opportunity_details']['public_hash']."'>".$row['opportunity_details']['title']." at ".$row['opportunity_details']['name']."</a></b>. <br />";
				$recommendation_count++; 
			}
		} else {
			$recommendation_notice .= "";
		}
	}
		
	
	if ($general_count > 0) {
?>	
	<div style='float:left; width:100%; padding-left:5px; padding-top:5px; padding-bottom:5px; background-color:#e9e6de;  border-top: solid #760006 3px; border-bottom: solid #760006 3px;  margin-top:0px;  margin-bottom:10px'>
		<img src='images/postjob.png' height='50px' width='50px' alt='recommendation' style='vertical-align:middle;'>  &nbsp; &nbsp;  <h4 style='display:inline'>General Notices</h4>
		<div id='general_holder' style='width:97%;float:left; margin-left:3px; margin-right:5px;'>
				<? echo $verification_text ?>
				<? echo $employment_version_notice ?>
			</div>		
	</div>

<?php
	}

	if ($recommendation_count > 0) {
?>	
	<div style='float:left; width:100%; padding-left:5px; padding-top:5px; padding-bottom:5px; background-color:#e9e6de; border-top: solid #760006 3px; border-bottom: solid #760006 3px; margin-bottom:10px'>
		<a href='#' class='show_button'><img src='images/postjob.png' height='50px' width='50px' alt='recommendation' style='vertical-align:middle;'></a> &nbsp; &nbsp; <h4 style='display:inline; margin-bottom:0px;'> My Recommendations <a href='#' class='show_button'>(<? echo $recommendation_count ?>)</a></h4>
		<div id='recommendation_holder' style='float:left; width:90%; margin-left:20px; <? echo $recommend_display ?>' >
			<h4>Your colleagues would like to recommended you for the jobs below.</h4>
			<? echo $recommendation_notice ?>
			<div style='margin-top:15px; float:left; width:100%'><font size='.825em'><i>If you apply through SBC and are hired, the user who recommended you will be eligible to earn a bounty.</i></font></div><br />
		</div>
	</div>

<?php
	}
	
	if ($general_count == 0 && $recommendation_count == 0 && $bounty_count > 0) {
?>	
	<div style='float:left; width:100%; padding-left:5px; padding-top:5px; padding-bottom:5px; background-color:#e9e6de;  border-top: solid #760006 3px; border-bottom: solid #760006 3px;  margin-top:0px;  margin-bottom:10px'>
		<img src='images/finalize_profile.png' height='50px' width='50px' alt='recommendation' style='vertical-align:middle;'>  &nbsp; &nbsp;  <h4 style='display:inline'>Don't Forget!</h4>
		<div id='reminder_holder' style='width:97%;float:left; margin-left:3px; margin-right:5px;' >
			<div style='margin-left:10px; float:left; width:100%; margin-bottom:5px;'>
				You can earn money by recommending people for jobs with bounties!<br />
				Click the "Earn Money" button below!
			</div>
		</div>
	</div>
<?php		
	}
	
}	
	
function employer_job_summary_html_mobile($current_jobs, $float_jobs, $incomplete_jobs, $current_count, $float_count, $incomplete_count) {
	echo "<div id='job_summary_holder' style='float:left; width:100%; margin-bottom:5px;'>";		
		if (count($current_count) == 0 && count($float_count) == 0 && count($incomplete_count) == 0) {
?>
			<div style='float:left; width:100%; background-color:#4c0100; color:white; text-align:center; padding-bottom:12px;'>
				<h4 style='margin-bottom:0px; padding-top:3px;'>Recent Job Posts</h4>
			</div>		
					
			<div style='float:left; width:100%; text-align:center'>
				<h4>No current jobs</h4>
			</div>
<?php
		} else {	
?>
			<div style='float:left; width:100%; background-color:#4c0100; color:white; text-align:center; padding-bottom:12px;'>
				<h4 style='margin-bottom:0px; padding-top:3px;'>Recent Job Posts</h4>
			</div>		
<?php	
			date_default_timezone_set('America/Los_Angeles');		
			$current_date = time();
			$incomplete_array = array();

		
//BEGIN INSERT

		date_default_timezone_set('America/Los_Angeles');		
		$current_date = time();
					
		if ($current_count > 0 || $float_count > 0) {	
			$valid_count = $current_count + $float_count;

			if ($valid_count > 0) {	
				if ($current_count > 0) {
					
					$old_style_current_jobs = array();
					
					//show jobs based on group
					//first show jobs with a group, then show jobs witih groupID 0 (these are pre-group update)

					foreach($current_jobs as $group) {
			
						$group_details = $group['group_details'];
						$group_jobs = $group['group_jobs'];
						//show a header based on group type
						//no header for single
						
						if ($group_details != "old") {
							if (count($group_jobs) > 0) {
								switch($group_details['type']) {
									case "single":
/*
										$type_header = "";
										$in_group = "N";
*/
										$type_header = "<h3 style='color:#4c0100; margin-bottom:0px; margin-left:5px;'>Individual Post - <a href='job.php?ID=new_job&page=templates&groupID=".$group_details['groupID']."'>Edit</a></h4>";
										$type_header .= "<div style='width:100%; float:left; margin-top:0px;'><hr style='color:#a9a9a9'></div>";
										$in_group = "Y";
									break;
									case "all":
										$type_header = "<h3 style='color:#4c0100; margin-bottom:0px; margin-left:5px;'>Hiring All Positions - <a href='job.php?ID=new_job&page=templates&groupID=".$group_details['groupID']."'>Edit</a></h4>";
										$type_header .= "<div style='width:100%; float:left; margin-top:0px;'><hr style='color:#a9a9a9'></div>";
										$in_group = "Y";
									break;
									case "FOH":
										$type_header = "<h3 style='color:#4c0100; margin-bottom:0px; margin-left:5px;'>Hiring All Front of House - <a href='job.php?ID=new_job&page=templates&groupID=".$group_details['groupID']."'>Edit</a></h4>";
										$type_header .= "<div style='width:100%; float:left; margin-top:0px;'><hr style='color:#a9a9a9'></div>";
										$in_group = "Y";
									break;
									case "BOH":
										$type_header = "<h3 style='color:#4c0100; margin-bottom:0px; margin-left:5px;'>Hiring All Back of House - <a href='job.php?ID=new_job&page=templates&groupID=".$group_details['groupID']."'>Edit</a></h4>	";
										$type_header .= "<div style='width:100%; float:left; margin-top:0px;'><hr style='color:#a9a9a9'></div>";
										$in_group = "Y";
									break;
								}
								
								echo $type_header;
								
								$count = 0;
								foreach ($group_jobs as $row) {	
									$count++;
									if ($count == count($group_jobs)) {
										$last_job = "Y";
									} else {
										$last_job = "N";
									}
									$status = date('M j, Y', strtotime($row['expiration_date']));
									employer_summary_list_view_mobile($row, $status, $last_job, $in_group);								
								}
							}
						} else {
							if (count($group_jobs) > 0) {
								foreach($group_jobs as $job) {
									$old_style_current_jobs[] = $job;
								}
							}
						}						
					}
					
					//Show jobs that have a groupID of 0, these were created before the update that implemented group post
					if (count($old_style_current_jobs) > 0) {
						foreach ($old_style_current_jobs as $row) {	
						//	echo var_dump($row);
						//	if ($row['groupID'] == 0) {	
								$status = date('M j, Y', strtotime($row['expiration_date']));
								employer_summary_list_view_mobile($row, $status, "Y", "N");								
						//	}
						}
					}					
				}
			}
					
			if ($float_count > 0) {

				$old_style_float_jobs = array();
		
				foreach($float_jobs as $group) {
					$group_details = $group['group_details'];
					$group_jobs = $group['group_jobs'];

					if (count($group_jobs) > 0) {	
						if ($group_details != "old") {
	
							//show a header based on group type
							//no header for single
							switch($group_details['type']) {
								case "single":
/*
									$type_header = "";
									$in_group = "N";
*/
									$type_header = "<h3 style='color:#4c0100; margin-bottom:0px; margin-left:5px;'>Individual Post - <a href='job.php?ID=new_job&page=templates&groupID=".$group_details['groupID']."'>Edit</a></h4>";
									$type_header .= "<div style='width:100%; float:left; margin-top:0px;'><hr style='color:#a9a9a9'></div>";
									$in_group = "Y";
								break;
								case "all":
									$type_header = "<h3 style='color:#4c0100; margin-bottom:0px; margin-left:5px;'>Hiring All Positions - <a href='job.php?ID=new_job&page=templates&groupID=".$group_details['groupID']."'>Edit</a></h4>";
									$type_header .= "<div style='width:100%; float:left; margin-top:0px;'><hr style='color:#a9a9a9'></div>";
									$in_group = "Y";
								break;
								case "FOH":
									$type_header = "<h3 style='color:#4c0100; margin-bottom:0px; margin-left:5px;'>Hiring All Front of House - <a href='job.php?ID=new_job&page=templates&groupID=".$group_details['groupID']."'>Edit</a></h4>";
									$type_header .= "<div style='width:100%; float:left; margin-top:0px;'><hr style='color:#a9a9a9'></div>";
									$in_group = "Y";
								break;
								case "BOH":
									$type_header = "<h3 style='color:#4c0100; margin-bottom:0px; margin-left:5px;'>Hiring All Back of House - <a href='job.php?ID=new_job&page=templates&groupID=".$group_details['groupID']."'>Edit</a></h4>";
									$type_header .= "<div style='width:100%; float:left; margin-top:0px;'><hr style='color:#a9a9a9'></div>";
									$in_group = "Y";
								break;
							}
							
							echo $type_header;
					
							$count = 0;

							foreach ($group_jobs as $row) {										
									$count++;
									if ($count == count($group_jobs)) {
										$last_job = "Y";
									} else {
										$last_job = "N";
									}
									$status = "<font color='red'>EXPIRED</font>";								
									employer_summary_list_view_mobile($row, $status, $last_job, $in_group);								
							}	
					} else {
						if (count($group_jobs) > 0) {
							foreach($group_jobs as $job) {
								$old_style_float_jobs[] = $job;
							}
						}
					}
				}
			}	
					//Show jobs that have a groupID of 0, these were created before the update that implemented group post
					if (count($old_style_float_jobs) > 0) {
						foreach ($old_style_float_jobs as $row) {	
								$status = "<font color='red'>EXPIRED</font>";								
								employer_summary_list_view_mobile($row, $status, "Y", "N");								
						}	
					}									
				}			
			}	
				
	if (count($incomplete_jobs) > 0) {
?>
		<div style='float:left; width:100%; background-color:#a9a9a9; text-align:center; padding-bottom:12px;'>
			<h4 style='color:white; margin-bottom:0px; padding-top:3px;'>Unfinished Posts</h4>
		</div>		

<!--
		<div style='float:left; width:100%; margin-top:20px; background-color:#a9a9a9;'>
			<h4 style='color:white; text-align:center; margin-bottom:5px;'>Unfinished Posts</h4>
		</div>
-->
<?php	

			foreach($incomplete_jobs as $group) {
					$group_details = $group['group_details'];
					$group_jobs = $group['group_jobs'];

					switch($group_details['type']) {
						case "single":
							foreach($group_jobs as $job) {
								echo "<div style='float:left; width:100%; text-align:center'>";
									echo "<h4 style='margin-bottom:5px;'>".$job['title']." <a href='job.php?ID=".$job['jobID']."'>Incomplete (click to finish)</a></h4>";
								echo "</div>";
								echo "<div style='width:100%; float:left; margin-top:3px;'><hr style='color:#a9a9a9'></div>";
							}
						break;
						
						case "all":
							echo "<div style='float:left; width:100%; text-align:center'>";
								echo "<h4 style='margin-bottom:5px;'>Hiring All Positions <a href='job.php?ID=new_job&page=templates&groupID=".$group_details['groupID']."'>Incomplete (click to finish)</a></h4>";
							echo "</div>";
							echo "<div style='width:100%; float:left; margin-top:3px;'><hr style='color:#a9a9a9'></div>";
						break;
						
						case "FOH":
							echo "<div style='float:left; width:100%; text-align:center'>";
								echo "<h4 style='margin-bottom:5px;'>Hiring All Front of House <a href='job.php?ID=new_job&page=templates&groupID=".$group_details['groupID']."'>Incomplete (click to finish)</a></h4>";
							echo "</div>";
							echo "<div style='width:100%; float:left; margin-top:3px;'><hr style='color:#a9a9a9'></div>";
						break;
						
						case "BOH":
							echo "<div style='float:left; width:100%; text-align:center'>";
								echo "<h4 style='margin-bottom:5px;'>Hiring All Back of House <a href='job.php?ID=new_job&page=templates&groupID=".$group_details['groupID']."'>Incomplete (click to finish)</a></h4>";
							echo "</div>";
							echo "<div style='width:100%; float:left; margin-top:3px;'><hr style='color:#a9a9a9'></div>";
						break;
					}				
			}
	}


///END INSERT
	
	if (count($incomplete_array) > 0) {
?>
		<div style='float:left; width:100%; background-color:#a9a9a9; color:white; text-align:center; padding-bottom:12px;'>
			<h4 style='margin-bottom:0px; padding-top:3px;'>Incomplete Job Posts</h4>
		</div>		
<?php	
			foreach($incomplete_array as $row) {
				echo "<div style='float:left; width:100%; text-align:center'>";
					echo "<h4 style='margin-bottom:3px'>".$row['title']." <a href='job.php?ID=".$row['jobID']."'>Incomplete (click to finish)</a></h4>";
				echo "</div>";
				echo "<div style='width:100%; float:left;'><hr style='color:#a9a9a9'></div>";
			}
		}

		echo "<div style='float:left; width:100%; font-size:14px; margin-top:10px; margin-bottom:10px; text-align:center;'><a href='job_list.php'><b>View Job Archive</b></a></p>";
	}			
	echo "</div>";			
}

function employer_summary_list_view_mobile($row, $status, $last_job, $in_group) {
	$job = new Job($row['jobID']);
	$job_data = $job->get_job_data(array('skills'));
	
	if ($in_group == "Y") {
		$circle = " &nbsp; &nbsp; &nbsp; &nbsp; &#9702; ";
		$indent = " &nbsp; &nbsp; &nbsp; &nbsp; ";
	} else {
		$circle = "";
		$indent = "";
	}


	if ($row['job_status'] == "Open" || $row['job_status'] == "Filled") {	
						
		echo "<div style='float:left; width:100%;'>";
			echo "<div style='float:left; width:68%; margin-left:2%;'>";
				echo "<a href='job.php?ID=".$row['jobID']."'><h4 style='color:#b76163; margin-bottom:0px;'>".$circle.$row['title']."</h4>";
				echo $indent."</a>Expires: ".$status."<br /> ";
			echo "</div>";

			echo "<a href='job.php?ID=".$row['jobID']."'>";										
				echo "<div style='float:left; width:28%; padding-top:5px; margin-right:2%;'>";
					echo "<div style='width:100%; float:left; padding-top:7px; padding-bottom:7px; border-radius:2px; border-style:solid; border-width:2px; border-color:#a9a9a9; text-align:center'>";
						echo "CANDIDATES (".$row['positive'].")";
					echo "</div>";
				echo "</div>";
			echo "</a>";

/*
			echo "<a href='job.php?ID=".$row['jobID']."&page=edit'>";
				echo "<div style='float:left; width:30%; padding-top:5px; margin-right:10px;'>";
					echo "<div style='width:100%; float:left; padding-top:7px; padding-bottom:7px; border-radius:2px; border-style:solid; border-width:2px; border-color:#a9a9a9; text-align:center'>";
						echo "VIEW/EDIT";
					echo "</div>";
				echo "</div>";
			echo "</a>";
*/
					
/*
			echo "<a href='job.php?ID=".$row['jobID']."&page=boost'>";
				echo "<div style='float:left; width:20%; padding-top:5px;'>";
					echo "<div style='width:100%; float:left; padding-top:7px; padding-bottom:7px; border-radius:2px; border-style:solid; border-width:2px; border-color:#a9a9a9; background-color:#2e6652; color:white; text-align:center'>";
						echo "BOOST!";
					echo "</div>";
				echo "</div>";
			echo "</a>";
*/
					
			if ($last_job == "Y") {
				echo "<div style='width:100%; float:left; margin-top:3px;'><hr style='color='#a9a9a9'></div>";			
			}	
		echo "</div>";
	} elseif ($row['job_status'] == "Removed") {
		if ($current_date < strtotime($row['expiration_date'])) {	
			echo "<div style='float:left; width:100%; text-align:center'>";
				echo "<h4>".$row['title']." : REMOVED BY ADMIN</h4>";	
			echo "</div>";
			echo "<div style='width:100%; float:left; margin-top:3px;'><hr style='color:#a9a9a9'></div>";
		}																										
	} 
}
	
	function employer_share_link_html_mobile() {
?>
	<div style='margin-top:110px; width:98%;'>
			<h2 style='text-align:center'>Stay Organized</h2>
			
			<h4 style='text-align:center'>You can use SBC with other sites to keep all candidates responses organized in one location</h4>

			<div style="margin-left:10px; margin-right:10px; margin-top:10px; margin-bottom:10px; padding-left:10px;" class='bubble_inside'> 	
				<b>We can provide you direct link to your ServeBartendCook job post that you can use on other sites (like Facebook, Twitter, a classified ad site, your own website, etc.).<br />  
				&nbsp; <br />
				This link will lead to a page with your job post and will require candidates to apply through ServeBartendCook.com.<br />
				&nbsp; <br />
				This means all the applications will be consistent and organized.  And only those with the required skills will be able to apply.</h4>
			</div>

			<div style="margin-left:5px; margin-right:10px; margin-top:10px; margin-bottom:10px; padding-left:5px;" class='bubble_inside'> 
				<h3 style='text-align:center'>Benefits</h3>				
				<ul>
					<li><b>Ensure ALL applicants meet your requirements</b></li>
					<li style='margin-top:5px;'><b>Require applicants answer ALL pre-interview questions</b></li>
					<li style='margin-top:5px;'><b>Candidates will have consistent applications for easy review (NO MORE RANDOM RESPONSES)</b></li>
					<li style='margin-top:5px;'><b>All responses will be ORGANIZED in one place, for sorting, and highlighting top candidates.</b></li>		
				</ul>	
				&nbsp; <br />
					
			</div>
	
			<div style="margin-left:5px; margin-right:10px; margin-top:10px; margin-bottom:10px;" class='bubble_inside'>
				<h3 style='text-align:center'>How to get a Job link to share</h3>				
				To get a link to your job, simply click "Jobs" on the navigation tab, then click a job post.  You should see a "Get Job Link" button on the page.  <br /> &nbsp; <br />That's it!</font><br />
				<b>Note:</b> <i>You can only get links to completed job posts, and the link become invalid after the job expires.</i>
			</div>			
	</div>
<?php		
	}
	
	function 	main_html_employer_no_store_mobile($company) {
		$utilities = new Utilities;
		$store_types = $utilities->store_types;
								
?>	
	<div style='margin-top:110px; width:100%;'>

		<div class="add_store_form" style='margin-top:20px'>
			<table class="dark" style='width:100%'>
				<tr>
					<th valign='middle'>Welcome - Finish Your Profile</th>
				</tr>	
			</table>		
			
			<div style='width:100%; margin-left:3px; margin-right:3px;'>
			<font style='color:#760006'>Before you can post a job, you need to create a location for your business.<br/><i>You can create multiple locations and manage separate job post at each one.</i></font><br />		
			<div id="store_required_warning" style="display:none"><font color="red"><b>ALL REQUIRED FIELDS MUST BE COMPLETED.</b></font></div>
			<div id="store_zip_warning" style="display:none"><font color="red"><b>PLEASE ENTER A VALID ZIP CODE.</b></font></div>
			
			<table style='color:#760006; margin-top:5px; width:100%'>
				<tr>
					<td><b>Store Name: &nbsp; </b></td>
					<td><input type="text" name="store_name" id="store_name" value='<? echo $company ?>'></input><div id="name_warning" style="display:none"></div></td>
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
				<div style='float:left; margin-top:35px; margin-left:10px; width:100%'><a href='#' class='btn btn-large btn-primary' id='add_store'>Add Store/Location</a></div>									
			</div>
		
			</div>
		</div>	
		</div>
		&nbsp; <br />
		
<?php
	}
	function password_change_html_mobile() {
?>
	<div id="holder">
		
	<div style=' float:left; width:100%; padding-right:3.5%; padding-left:3.5%'>
		<h3 style='margin-bottom:10px; margin-top:10px;'>Change Password</h3>
	</div>
		<div style="float:left; width:100%;">
		
		<div id="change_password_form" style='margin-left:10px; margin-top:10px; color:#760006'>
				<div id="new_pass_warning" style="display:none; color:red;">
					<b>Your new passwords don't match.</b> <br />
				</div>
				<div id="old_pass_warning" style="display:none; color:red;">
					<b>Your old password is incorrect. </b><br />
				</div>
				<div id="pass_length_warning" style="display:none; color:red;">
					<b>Your new password must be between 6 and 12 characters.</b><br />
				</div>
				
						<b>Old Password</b><br />
						<input type="password" style='width:95%; margin-bottom:10px;' id="old_pass"><br />

						<b>New Password</b><br />
						<input type="password" style='width:95%; margin-bottom:10px;' id="new_pass1"><br />

						<b>Re-type New Password:</b><br />
						<input type="password" style='width:95%; margin-bottom:10px;' id="new_pass2"><br />
			
			<div style='float:left; margin-top:20px; width:90%; margin-bottom:10px;'><a href='#' class='btn btn-large btn-primary' id="change_password">Change Password</a></div>					
			
		</div>

		<div id="pass_loader" style="display:none">
				&nbsp; <br />
				<h4>Updating...</h4>
		</div>
			
		<div id="pass_change_sucess" style="display:none">
				&nbsp; <br />
				<h4>Password successfully changed.</h4>
		</div>

		</div>
	</div>
	</div>
	
<?php		
	}
	
	function main_html_employee_improve_mobile($profile_rank) {
?>	
	<div id="holder">
		
	<div style="margin-top:20px;">
		<h1 style="text-align:center;">Profile Analysis</h1>
		
		<h3 style="text-align:center;">Your profile rank is: <? echo $profile_rank['letter'] ?></h3>
		<div style='margin-left:2px; margin-right:2px; width:100%;'><i>Only you can see this ranking, it is meant as a guide for improving your profile</i></div>
		
<?php
		if ($profile_rank['letter'] == "A+") {
			echo "Your profile looks great!";			
		} elseif ($profile_rank['letter'] == "incomplete") {
			echo "<h4>Your profile is incomplete.</h4>";
		} else {
			echo "<div style='float:left; width:100%; margin-top:10px; margin-bottom:5px;'>";
				echo "<table class='dark' style='width:100%; text-align:center;'>";
					echo "<tr><th>Specific Tips</th></tr>";	
				echo "</table>";			
			echo "</div>";
			echo "<br />";
			
			echo "<div style='width:98%; float:left; margin-left:5px; margin-right:5px;'>";			
			
			if ($profile_rank['employment'] == 1) {
				echo "<h4>Past Employment</h4>";
				echo "<font color='red'>You have no past employment listed on your profile.<br />";  
				echo "&nbsp; <br />Employers often ignore profiles with no past employment.</font><br />";
				echo "&nbsp; <br />Go to your <a href='employee.php'>Profile</a> to add past employment.<br />";				
			}
			
			if ($profile_rank['word_count'] == 2) {
				echo "<h4>Skill Description</h4>";
				echo "<font color='red'>Your descriptions of your skills/experience is very brief.<br />";  
				echo "&nbsp; <br />You should include a short paragraph about your skills.  Approximately 3 or 4 sentences is ideal.   This helps employers quickly and easily assess your skills</font><br />";
				echo "&nbsp; <br />Go to your <a href='employee.php'>Profile</a> to edit your skills.<br />";				
			}
			
			if ($profile_rank['education'] == 1) {
				echo "<h4>Education/Certification</h4>";
				echo "<font color='red'>Your profile contains no certifications or educational background<br />";  
				echo "&nbsp; <br />You may want to add any certifications or relevant classes you've taken.  If you have a relevant degree, you should include it on your profile.</font><br />";
				echo "&nbsp; <br />Go to your <a href='employee.php'>Profile</a> to edit your skills.<br />";				
			}			

			if ($profile_rank['video'] == 1) {
				echo "<h4>Video</h4>";
				echo "<font color='red'>Employers almost always view and respond to profiles with videos first.<br />";  
				echo "&nbsp; <br />Creating a quick video is simple.  Just use Vine, Instagram, or YouTube to create a short video introducing yourself.  Even a short video can increase your odds of getting a great job.</font><br />";
				echo "&nbsp; <br />Go to your <a href='employee.php'>Profile</a> to add a video.<br />";				
			}									
			echo "</div>";			
		}
?>	
	
			<div style='float:left; width:100%; margin-top:10px; margin-bottom:5px;'>
				<table class='dark' style='width:100%; text-align:center;'>
					<tr><th>General Tips</th></tr>
				</table>		
			</div>
			<br />
			<div style='width:100%; float:left; margin-left:8px; padding-right:15px;'>		
				<ul style='width:80%; margin-right:10px;'>
					<li>Make sure your profile is complete.</li>
					<li>Spelling and grammar is very important.  Double check your profile for typos.</li>
					<li>If you have included photo(s) on your profile, make sure they are tasteful and appropriate.</li>
					<li>When answering pre-interview questions, be sure to provide a thorough and honest answer.</li>
				</ul>
			</div>
		</div>

<?php
	}	
						
function employee_faq_menu_mobile() {
?>
		<div style="float:left; width:100%; margin-top: 15px;">
			<h3 style='text-align:center;'>Frequently Asked Questions</h3>
		</div>
		
		<div style="float:left; width:100%; margin-left:25px; margin-top: 15px;">
			<a href='main.php?page=general_faq'><img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"></a> &nbsp; <h4 style='display:inline'><a href='main.php?page=general_faq'>GENERAL</a></h4><br />
			&nbsp; <br />
<!--
			<a href='main.php?page=bounty_faq'><img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"></a> &nbsp; <h4 style='display:inline'><a href='main.php?page=bounty_faq'>BOUNTIES</a></h4><br />
			&nbsp; <br />
			<a href='main.php?page=interview_faq'><img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"></a> &nbsp; <h4 style='display:inline'><a href='main.php?page=interview_faq'>INTERVIEW REMINDERS</a></h4><br />
			&nbsp; <br />
-->
			<a href='main.php?page=contact'><img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"></a> &nbsp; <h4 style='display:inline'><a href='main.php?page=contact'>CONTACT</a></h4><br />
		</div>
<?php	
}

function employer_faq_menu_mobile() {
?>
		<div style="float:left; width:100%; margin-top: 15px;">
			<h3 style='text-align:center;'>General FAQ</h3>
		</div>	

		<div style="float:left; width:96%; margin-left: 5px; margin-right: 3px; margin-bottom:15px">
			<div style='float:left; padding-top:15px; margin-left:10px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>HOW DO I FIND EMPLOYEES?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					Create a job and an email will be sent to all matching candidates within a 40-mile radius. If they are interested in the job, you will receive an email notice. <br/>
				</div>
			</div>
	
			
			<div style='float:left; padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>WHAT DOES IT COST?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					<b>Single Job Post</b> - $15<br />
					<b>Post up to 4 Back of House Openings</b> - $30<br />
					<b>Post up to 4 Front of House Opening</b> - $30<br />
					<b>Post up to 8 FOH & BOH Openings</b> - $55<br />
					&nbsp; <br />
					These prices are for the following regions:<br />
					&nbsp;	- Orlando, FL and surrounding region<br />
					&nbsp;	- Tampa, FL and surrounding region<br />
					&nbsp;	- Miami, FL and surrounding region<br />
					&nbsp;	- Charlotte, NC and surrounding region<br />
					&nbsp;	- Charleston, SC and surrounding region <br />
					&nbsp; <br />				
					In all other regions Job posts are currently free. 
					&nbsp; <br />
				</div>
			</div>
			
			<div style='float:left; padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>WHAT IF I CHOOSE 'ALL BOH' OR 'ALL FOH' BUT DON'T HAVE 4 POSITIONS TO HIRE?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					If you choose all "All BOH" or "All FOH", you must select at least 2 or more positions to hire (up to a max. of 4).  If you select less than 4, remaining openings DO NOT carry over as credits for future job posts.  Even if you only need 3 positions, it is still a discount compared to posting 3 single jobs ($10/post vs. $15/post).  The intent is to offer discounts and make it easier for those that need to hire multiple positions at once.
				&nbsp; <br />
				</div>
			</div>			
			

<!--
			<div style='float:left; padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>WHAT JOB BOOST OPTIONS ARE AVAILABLE?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					We currently offer the following job boost options, which can be purchased anytime after you post a job on ServeBartendCook (more options will be available in the future):
					<div style='margin-left:15px; margin-top:10px;'>
						&#9679; Craigslist Group Post - <a href='main.php?page=boost_faq&type=cl_group'>Learn More</a><br />
						&#9679; Promoted Social Media - <a href='main.php?page=boost_faq&type=social'>Learn More</a><br />
						&#9679; Regional Email Blast - <a href='main.php?page=boost_faq&type=email'>Learn More</a><br />
						&#9679; Google Ads - <i>Coming Soon</i><br />
					</div>			
				</div>
			</div>
-->

			<div style='float:left; padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>WHAT HAPPENED TO BOUNTIES?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					We have phased out bounty jobs to re-work the concept.  Current Bounty Jobs will remain on the site, with all associated features, until they expire.  For now, bounties are not an option for new job posts.
				&nbsp; <br />
				</div>
			</div>			
		
			<div style='float:left; padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>HOW DO I DEACTIVATE MY ACCOUNT?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					Great news - you don’t need to deactivate your account! Even if you’re not looking for staff on ServeBartendCook right now, you can leave your account as-is and return to it any time in the future. Your account will always remain private, so no one will ever be able to contact you through the site, unless you post a job.<br /> 
					&nbsp; <br />
					If you still wish you deactivate your account, you may email us at deactivate@servebartendcook.com. 
				</div>
			</div>	
		</div>	
<?php	
}

	
function employee_faq_general_mobile() {
?>				
		<div style="float:left; width:100%; margin-top: 15px;">
			<h3 style='text-align:center;'>General FAQ</h3>
		</div>	

		<div style="float:left; width:96%; margin-left: 5px; margin-right: 3px; margin-bottom:15px">
		
			<div style='float:left; padding-top:15px; margin-left:10px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>HOW DO I FIND JOBS?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					Jobs find you based on your experience and location. All you need to do is create a profile and you will be notified any time a job matches your skills and is within 40 miles of your location.
				</div>
			</div>
	
			
			<div style='float:left; padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>HOW DO I STOP GETTING MATCHED TO TYPES OF JOBS I DON’T WANT?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					In your profile menu, scroll to "You are being matched to these job types", then deselect the skill you wish to no longer to receive jobs for (the button will turn grey).<br />
					&nbsp; <br />
					Your experience will still appear on your profile, but you will not be matched to jobs of this type. 
				</div>
			</div>
			
			<div style='float:left;padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>HOW DO I CHANGE MY LOCATION?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					You can update your zip code by visiting the <a href='employee.php?page=settings'>SETTINGS</a> page.	
				</div>
			</div>
	
			<div style='float:left;padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>HOW DO I CHANGE THE NUMBER OF YEARS OF EXPERIENCE LISTED ON MY PROFILE?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					All experience on your profile is connected to jobs that you have entered on the site. SBC adds the experience of all of your jobs together to show your total experience in a particular skill. <br />
					&nbsp; <br />
					If you want your profile to reflect more experience, simply add more jobs to your job history with correct start/end date, or correct any start/end dates on the jobs that you have already entered.
				</div>
			</div>
			
			<div style='float:left;padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>HOW DO I ADD NEW SKILLS TO MY PROFILE?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					All skills on your profile are connected to a job that you have entered on the site. If you would like to add new skills to your profile, you can either 1) add a new job with new skills, or 2) edit any existing experience you have already entered on the site and select more skills
				</div>
			</div>
			
			<div style='float:left;padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>HOW DO I CHANGE MY EMAIL SETTINGS?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					In your profile, click "Email Settings" on the left side of the page. From here you can edit your notification email settings.
				</div>
			</div>
		
			<div style='float:left;padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>HOW DO I DEACTIVATE MY ACCOUNT?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					Great news - you don’t need to deactivate your account! Even if you’re not looking for a job on ServeBartendCook, you can leave your account as-is and return to it any time in the future. Your account will always remain private if you don’t apply for a job on the site, so no one will ever be able to view your profile.<br /> 
					&nbsp; <br />
					If you don’t want to get email alerts about job matches, just click "Email Settings" on the left side of your Profile page. From here you can change your email settings.<br />
					&nbsp; <br />
					If you still wish you deactivate your account, you may email us at deactivate@servebartendcook.com. 
				</div>
			</div>		
		
		</div>
<?php
}

function employer_faq_general_mobile() {
?>				
		<div style="float:left; width:100%; margin-top: 15px;">
			<h3 style='text-align:center;'>General FAQ</h3>
		</div>	

		<div style="float:left; width:96%; margin-left: 5px; margin-right: 3px; margin-bottom:15px">
			<div style='float:left; padding-top:15px; margin-left:10px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>HOW DO I FIND EMPLOYEES?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					Create a job and an email will be sent to all matching candidates within a 40-mile radius. If they are interested in the job, you will receive an email notice. <br/>
					&nbsp; <br />
					We suggest posting a job with a Bounty to get the most views of your job posting.
				</div>
			</div>
	
			
			<div style='float:left; padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>WHAT DOES IT COST?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					Job posts are free.  You may optional choose to pay to "Boost" your job post, which will post your job on other job boards and advertise you job on social media, give you more exposure to qualified candidates
				</div>
			</div>

			<div style='float:left; padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>WHAT JOB BOOST OPTIONS ARE AVAILABLE?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					We currently offer the following job boost options, which can be purchased anytime after you post a job on ServeBartendCook (more options will be available in the future):
					<div style='margin-left:15px; margin-top:10px;'>
						&#9679; Craigslist Group Post -  XXXX. <br />
						&#9679; Promoted Social Media -  <br />
						&#9679; Indeed.com -  <br />
					</div>			
				</div>
			</div>

			<div style='float:left; padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>WHAT HAPPENED TO BOUNTIES?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					We have phased out bounty jobs to re-work the concept.  Current Bounty Jobs will remain on the site, with all associated features, until they expire.  But bounties are not an option with new job posts.
				&nbsp; <br />
				</div>
			</div>			
		
			<div style='float:left; padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>HOW DO I DEACTIVATE MY ACCOUNT?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					Great news - you don’t need to deactivate your account! Even if you’re not looking for staff on ServeBartendCook right now, you can leave your account as-is and return to it any time in the future. Your account will always remain private, so no one will ever be able to contact you through the site, unless you post a job.<br /> 
					&nbsp; <br />
					If you still wish you deactivate your account, you may email us at deactivate@servebartendcook.com. 
				</div>
			</div>	
		</div>	
<?php
}

function employee_faq_bounty_mobile() {
?>
		<div style="float:left; width:100%; margin-top: 15px;">
			<h3 style='text-align:center;'>Bounty FAQ</h3>
		</div>	

		<div style="float:left; width:96%; margin-left: 5px; margin-right: 3px; margin-bottom:15px">

			<div style='float:left; padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>WHAT IS A BOUNTY?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
				A bounty is a professional recommendation, with an actual benefit to you – money! If you refer an SBC user to a job on the site, and they get the job, you will receive a bounty payment from ServeBartendCook. Each bounty payment is different, depending on employer.
				</div>
			</div>		
			
			<div style='float:left; padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>CAN I REALLY EARN MONEY BY RECOMMENDING SOMEONE?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					YES!  If you recommend a candidate for a listed position with a bounty, and they accept your recommendation and are hired, you make money.  We pay via PAYPAL or an AMAZON GIFT CARD.
				</div>
			</div>		
			
			<div style='float:left; padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>HOW DO I RECOMMEND SOMEONE FOR A BOUNTY JOB?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					When you view the job with a bounty, you will have the option to Apply or Recommend a someone for the job. Choose the Recommend option, and provide your friend’s name and email. <br />
					&nbsp; <br />
					If your friend is already an SBC user, your work is done. If not, we will contact them to let them know that they’ve been recommended for a job. They can register for the site and apply for the bounty job in minutes.
				</div>
			</div>		
	
			<div style='float:left; padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>DOES MY RECOMMENDATION SHOW UP ON THEIR APPLICATION?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					Yes.  If someone you recommend applies for a job through SBC and accepts your application, your name and a summary of your profile will appear on their application.<br />
					&nbsp; <br />
					You can see a summary of your recommendation before you recommend someone.  The summary is based on the information in your profile.  So to give the best recommendation, make sure your profile is up to date!
				</div>
			</div>		
	
			<div style='float:left; padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>HOW DO I COLLECT A BOUNTY?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					If an employee who accepted your recommendation is verified by SBC as hired, you will receive an email, confirming that your bounty will arrive within 30 days. You will then be able to collect the bounty in the form of a PAYPAL payment or AMAZON GIFT CARD.<br />
					&nbsp; <br />
					You can always check your job list status to view the status of any bounty job recommendations you have made.
				</div>
			</div>		
	
	<!--
			<div style='float:left; padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>HOW DO I CHECK A BOUNTY STATUS?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					From your homepage, select Check Bounty Status. This page will show you all Bounty Jobs for which you have recommended friends, with corresponding status:
					Viewed: Your friend has seen your job reference.
					Accepted: Your friend has put your recommendation on their application to the job. Keep in mind that your friend may receive more than one recommendation, and can only accept one per application.
					Hired: Your friend has been hired for the job, congrats, you should be receiving an email confirmation soon!
					Removed: The employer has decided to remove the job posting.
					Closed: The employer has either hired someone else, the job posting has expired, or your friend chose to use someone else’s job recommendation. You will not receive a Bounty payment for this job
				</div>
			</div>		
	-->
	
			<div style='float:left; padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>WHEN DO I GET MY BOUNTY?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					If your Bounty status says Hired, wait for ServeBartendCook to email you, confirming that your friend was hired, and that you will receive your Bounty. Once you receive this email, you should receive your payment, via email, within 30 days. Keep an eye out!
				</div>
			</div>		
	
			<div style='float:left; padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>WHAT HAPPENS IF I DON’T GET MY BOUNTY?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					Only the first successful recommendation for any given job posting will receive a Bounty, even if multiple employees are hired for the same position. So recommend your friends quickly and often!
				</div>
			</div>		
	
			<div style='float:left; padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>HOW DO I GET RECOMMENDED FOR A BOUNTY JOB?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					Ask your work friends (past and present) to join ServeBartendCook, and provide a recommendation for you for any Bounty job you want. All they need to do is create a profile, and give us your name. We’ll do the rest.
				</div>
			</div>		
			
			<div style='float:left; padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>WHY CAN I ONLY COLLECT $600 IN A YEAR?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					For tax purposes we can currently only payout a maximum of $600 in bounties per user per year.  Please review our Terms of Service for all terms and restrictions.
				</div>
			</div>
		</div>		
<?php
}

function employer_faq_bounty_mobile() {
?>
		<div style="float:left; width:100%; margin-top: 15px;">
			<h3 style='text-align:center;'>Bounty FAQ</h3>
		</div>	

		<div style="float:left; width:96%; margin-left: 5px; margin-right: 3px; margin-bottom:15px">

			<div style='padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>WHAT IS A BOUNTY?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					A bounty premium job post that allows users to be recommended by other industry professionals, with an actual benefit to the person doing the recommending (they get paid). As an employer, you are much more likely to get high-quality candidates when you place a Bounty on a job. <br />
					&nbsp; <br />
					When an SBC user is recommended for a job on the site, and you hire them for the job, the person who recommended your new employee will receive a Bounty payment directly from ServeBartendCook.<br /> 
					&nbsp; <br />				
					It’s up to you, the employer, as to how much you’d like to spend on any given job. The higher the Bounty, the more visibility your jobs will post will have AND the more incentive users have to recommend the best candidates to you.  This gives a greater chance for higher quality candidates.
				</div>
			</div>		
			
			<div style='padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>WHY ARE BOUNTIES AWESOME?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					Just a few of the reasons: <br />
					<div style='margin-left:15px; margin-top:10px;'>
						<b>&#9679; Candidates are recommended by industry professionals. <br />
						&#9679; User are incentivized to give the best recommendations with money. <br />
						&#9679; The larger the bounty, the higher your post appears on the site.  This means your job won't get pushed down or off the page like other job sites - the more you pay. <br />
						&#9679; You can view the credentials of the users who recommend candidates, to you can chose candidates recommended by the best in the industry. <br />
						&#9679; You can have us send Interview Reminders to candidates to reduce no-shows. <br />
						&#9679; You can enter easy notes to compare candidates efficiently. <br />
						&#9679; You can compare you job post to others in the region to see how you stack up (number of results, payscale, bounty amount etc.). <br /></b>
					</div>			
				</div>
			</div>		
			
			<div style='padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>HOW DO I PLACE A BOUNTY ON A JOB?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					When you finish with a job posting, we will ask you if you would like to place a bounty on your job. The higher the bounty, the higher you job appears on the site to users in your region, your job will stay at the top of the job list in your area – don’t worry about posting the job over and over, just to make sure people see it! <br />
					&nbsp; <br />	
					SBC will allow you to see Bounty payments in your area, so you can be sure to get at the top of the list, and stay at the top of the list.<br />
					&nbsp; <br />
					Simply choose what your job posting is worth to you, post the job, and start receiving professional recommendations in no time.
				</div>
			</div>		
	
	<!--
			<div style='padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>WHY SHOULD I PLACE A BOUNTY ON A JOB?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					Your job (unlike non-bounty jobs) will be accessible to all users in your region, regardless of skill and experience matches, giving you the largest pool of potential employees possible. The higher the bounty, the more visible your job posting will be to potential employees. 
				</div>
			</div>		
	-->
	
			<div style='padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>DO I GET ANYTHING ELSE FOR PAYING TO POST A BOUNTY JOB?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					As an employer who uses the Bounty system, you get much more than professional recommendations. Additional features that are unlocked on the SBC website for employers that use the bounty system are:<br />
					&#9679;	Job review. View other jobs with Bounties in your area. Adjust your job posting to find the best employee.<br />
					&#9679;	Candidate Interview Reminders. We send e-confirmations for job interviews that applicants can cancel with the touch of a button. Don’t waste your time waiting for applicants that don’t show.<br />
					&#9679;	Candidate Notes. Take notes on each candidate you interview, and let us help you organize your feedback with simple drop-down options.
				</div>
			</div>		
			
			<div style='padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>ARE BOUNTY JOBS AVAILABLE IN ALL REGIONS?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					The Bounty feature is only available to employers in SBC’s highly active regions, so you may be outside of an active region.<br />
					&nbsp; <br />
					We want users to get the most benefit for their dollar, so we don't charge or offer bounties in regions that may not have high activity.  Once your region is highly active, bounties will be available.
				</div>
			</div>
			
			<div style='padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>WHAT HAPPENS WHEN I HIRE AN EMPLOYEE WITH A BOUNTY?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					If an employee is hired from a Bounty job posting, SBC will confirm the new hire with you via email or on the website (or a phone call if we can't get in touch with you otherwise.).<br />
					&nbsp; <br />
					You can confirm the hire yourself by clicking “Finished Hiring?” in your job list and choosing the candidate you hired. Once the new hire is confirmed, the professional recommendation will receive an email, and their Bounty payment will arrive within 30 days.
				</div>
			</div>		
	
			<div style='padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>HOW MUCH SHOULD I PAY TO POST A BOUNTY JOB?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					How much you want to spend above the minimum $25 Bounty Job posting fee is up to you. The more you spend, the higher you job post appears on the site AND the more incentive users have to recommend quality applicants.  No need to post more than once. Post one time, and get the most bang for your buck.<br />
					&nbsp; <br />
					<a href='main.php?page=bounty_payout'>Click Here</a> to view details about how we pay out bounties to users.
				</div>
			</div>
	
			<div style='padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>WHAT DOES 'APPROXIMATE RANK' MEAN?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					As mentioned above, the more money you post the higher you job appears on the site to users in your region.  We say "Approximate Rank", because if someone posts a higher bounty after you post, your post will appear below the new job.  We cannot guarantee any specific position on the site.  BUT we do guarantee that you will always appear above jobs with no bounty and above with smaller bounties.<br />
	<!-- 				Also, since we show jobs based on a users geographic region, a user that is located between two major cities may be seeing jobs from both regions, so you may be be ranked higher in your own region, but when combined with another region, might appear lower in that user's list.  -->
					&nbsp; <br />
				</div>
			</div>
	
			<div style='padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>ARE FREE JOB POSTS STILL AVAILABLE?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
				We do offer Lite Job Posts for free, but there is a limitation on the number of open Lite Jobs you can post as well as limited features. Bounty Jobs are equivalent to the classic job post on ServeBartendCook.<br />
					&nbsp; <br />
					NOTE <i>All Free Job posts always appear below all Bounty jobs on the site.  Free jobs also do not include any of the other above features.</i>
				</div>
			</div>		
		</div>			
<?php
}

function employee_faq_interview_mobile() {
?>
		<div style="float:left; width:100%; margin-top: 15px;">
			<h3 style='text-align:center;'>Interview Reminder FAQ</h3>
		</div>	

		<div style="float:left; width:96%; margin-left: 5px; margin-right: 3px; margin-bottom:15px">
			<div style='padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>WHAT IS AN INTERVIEW REMINDER?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					Employers may set up a reminder if they've scheduled an interview with you.  We will send you a reminder a few days before the interview, and the day before.  We provide you with a very simple way to cancel your interview if necessary.  Our goal is to reduce interview no-shows for employers.<br />
				</div>
			</div>				
					
			<div style='padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>HOW DO I CANCEL MY UPCOMING INTERVIEW?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					ServeBartendCook makes it super easy to cancel interviews. No more awkward phone calls! From your homepage, click View Interviews. <br />
					&nbsp; <br />
					Simply click Cancel for the job you no longer want to interview for, and we’ll let the employer know for you. <br />
					&nbsp; <br />				
					You’re welcome.
				</div>
			</div>		
		</div>		
<?php	
}

function employer_faq_interview_mobile() {
?>
		<div style="float:left; width:100%; margin-top: 15px;">
			<h3 style='text-align:center;'>Interview Reminder FAQ</h3>
		</div>	

		<div style="float:left; width:96%; margin-left: 5px; margin-right: 3px; margin-bottom:15px">
			<div style='padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>HOW DO I SEND INTERVIEW REMINDERS?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					First, call your candidate to schedule the interview (their phone number is on their profile).<br />  
					&nbsp;<br />				
					In your candidate list, click the interview icon then select that date you and your candidate agreed on.   <br />
					&nbsp;<br />
					We will send email reminders to the candidate multiple times before their interview, as well as reminders when they log into the site.  These reminder include an easy one-click cancel option.  If they cancel, we will email you immediately.<br />
					&nbsp; <br />				
					<i>Note: this feature only available for jobs with bounties.</i>
				</div>
			</div>		
	
			<div style='padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>HOW DO INTERVIEW REMINDERS REDUCE NO-SHOWS?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					Our research shows that users often accept several interviews, and once they accept a job, it is easier for them to no-show than to try to call and cancel.  ALthough this may be frustrating, it happens to be a reality in the industry.<br />
					&nbsp; <br />
					When surveying users, they told us that if they had an easy one-click option to cancel an interview, they would be more likely to user it.<br />
					&nbsp; <br />
					Also, we send them several reminders to help encourage them to either show up or cancel.
				</div>
			</div>		
	
			<div style='padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>HOW DO I MAKE NOTES ON MY INTERVIEW?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					To take notes on your candidate, view your candidate list and click on the Notes icon.  This takes you to your candidate notes page, where you can rate your applicants on Company Fit, Experience, and Availability. <br />
					&nbsp; <br />
					You can also take your own open-ended notes about each candidate.<br />
					&nbsp; <br />
					<i>Note: this feature only available for jobs with bounties.</i>
				</div>
			</div>		
	
			<div style='padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>HOW DO I SEE COMPETITOR JOBS?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					In your job list, click COMPARE to view comparable jobs. Here you will see how your job measures up to other jobs in your area in regards to pay, job views, job responses and bounties.<br />
					&nbsp; <br />
					<i>Note: this feature only available for jobs with bounties.</i>
				</div>
			</div>		
		</div>
<?php	
}

function employee_summary_bounty_mobile() {
?>
		<div style="float:left; width:100%; margin-top: 15px;">
			<h3 style='text-align:center;'>NEW BOUNTY SYSTEM SUMMARY</h3>
		</div>	

		<div style="float:left; width:96%; margin-left: 5px; margin-right: 3px; margin-bottom:15px">
			<div style='padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>WHAT IS A BOUNTY?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					A bounty is an amount of money ServeBartendCook will pay to a user that recommends a candidate for a job (provided that candidates gets hired).  Unlike typical sites, we actually give you a portion of the money employers pay to post jobs, if you recommend someone who gets hired.  This gives users a reason to recommend great candidates for great jobs!
				</div>
			</div>		
	
			<div style='padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>HOW MUCH DO BOUNTIES PAY?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					It depends on how much the employer spends to post the job.  The more they pay, the larger the bounty. <br />
				</div>
			</div>		
	
			<div style='padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>DO ALL JOBS PAY BOUNTIES?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					No.  If an employer chooses to post a "Free Job" there is no available bounty for that job, and you won't be able to recommend someone for that position.<br />
				</div>
			</div>		

			<div style='padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>HAVE QUESTIONS?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					Check out our <a href='main.php?page=bounty_faq'>BOUNTY FAQ</a> for more details.
				</div>
			</div>		

		</div>
<?php	
}

function employer_summary_bounty_mobile() {
?>
			<div style='float:left; width:100%; padding-top:5px;'>
				<h1 style='text-align:center;'>How do Bounties work?</h1>
				
				<h3 style="text-align: center">It's incredibly simple</h3>
				<div style='float:left; width:100%; margin-left:5px; margin-right:3px; margin-top:10px;'>
					<div style='float:left; width:98%; margin-left:5px;'>
						<h4 style='margin-bottom:5px;'>&#9679; We pay a portion of your job post fee to any of our users who recommend a candidate you hire</h4>
					</div>
					
					<div style='float:left; width:90%; margin-top:0px; margin-left:10px; margin-right:3px;'>										
						<i>We literally turn all of our users into industry recruiters at a fraction of what it would cost to hire an actual recruiter, and with better results!  Traditional job sites do nothing like this. We give back to our users for helping you.</i>
						<br />
						&nbsp; <br />
					</div>		
				</div>		

				<h3 style="text-align: center">Can I trust a recommendations?</h3>
				<div style='float:left; width:100%; margin-left:5px; margin-right:3px; margin-top:10px;'>
					<div style='float:left; width:98%; margin-left:5px;'>					
						<h4 style='margin-bottom:5px;'>&#9679; The name and details of the person who is recommending the candidate appear on the application</h4>
					</div>

					<div style='float:left; width:90%; margin-top:0px; margin-left:10px; margin-right:3px;'>															
							<i>You will be able to easily determine whether the recommendation comes from a person you are familiar with, or from someone who works at a reputable establishment!</i>
							<br />
							&nbsp; <br />
					</div>
				</div>

				<h3 style="text-align: center">Bounty Jobs stay at the top</h3>
				<div style='float:left; width:100%; margin-left:5px; margin-right:3px; margin-top:10px;'>
					<div style='float:left; width:98%; margin-left:5px;'>										
						<h4 style='margin-bottom:5px;'>&#9679; The job with the largest bounty in the region is ALWAYS at the top of the list until it expires</h4>
					</div>
					
					<div style='float:left; width:90%; margin-top:0px; margin-left:10px; margin-right:3px;'>															
						<i>This means bounty jobs aren't pushed way down and out of view after more people post jobs, like most classified ad sites.  The top bounty job in the region will be at the top of the list for the life of the job post!  Followed by other bounty posts, ranked by bounty size, with free posts at the bottom.  (this means more exposure)</i>
						<br />
						&nbsp; <br />
					</div>
				</div>


				<h3 style="text-align: center">How much does it cost?</h3>
				<div style='float:left; width:100%; margin-left:5px; margin-right:3px; margin-top:10px;'>					
					<div style='float:left; width:98%; margin-left:5px;'>										
						<h4 style='margin-bottom:5px;'>&#9679; Pay what you want</h4>
					</div>

					<div style='float:left; width:90%; margin-top:0px; margin-left:10px; margin-right:3px;'>																				
						<i>The job cost is variable, and up to you. The more you pay, the larger the bounty, and the more we pay the person who recommends a candidate you hire.  If you are serious about your hiring process, place a larger bounty to incentivize people to spread the word and recommend people.</i>
						<br />
						&nbsp; <br />
					</div>
				</div>

				<h3 style="text-align: center">It is less than most job sites</h3>
				<div style='float:left; width:100%; margin-left:5px; margin-right:3px; margin-top:10px;'>				

					<div style='float:left; width:98%; margin-left:5px;'>												
						<h4 style='margin-bottom:5px;'>&#9679; It's less than most classified ad job sites, and far less than hiring a recruiter</h4>
					</div>
	
					<div style='float:left; width:90%; margin-top:0px; margin-left:10px; margin-right:3px;'>																				
						<i>Seriously, the minimum cost is $25.  And you can pay more to increase the bounty and encourage our users to compete with each other to recommend you the best candidate (they only get paid if you hire a candidate they recommend).</i>
						<br />
						&nbsp; <br />
					</div>
				</div>

				<h3 style="text-align: center">What else do I get for my money?</h3>
				<div style='float:left; width:100%; margin-left:5px; margin-right:3px; margin-top:10px;'>					
					
					<div style='float:left; width:98%; margin-left:5px;'>										
						<h4 style='margin-bottom:5px;'>&#9679; Useful options that no one else offers</h4>
					</div>

					<div style='float:left; width:90%; margin-top:0px; margin-left:10px; margin-right:3px;'>																									
						<i>Compare yourself to other jobs on the site, take notes on candidates (even use a simple pre-made list), sort and filter candidates by notes, let us send interview reminders to candidates to help reduce no-shows.  <a href='main.php?page=bounty_faq'>Learn More</a></i>
						<br />
						&nbsp; <br />
					</div>
				</div>

				<h3 style="text-align: center">I like free stuff</h3>
				<div style='float:left; width:100%; margin-left:5px; margin-right:3px; margin-top:10px;'>
					
					<div style='float:left; width:98%; margin-left:5px;'>										
						<h4 style='margin-bottom:5px;'>&#9679; So do we, we offer limited Lite Job posts for free.</h4>
					</div>
					
					<div style='float:left; width:90%; margin-top:0px; margin-left:10px; margin-right:3px;'>																				
						 <i>If finding a top candidate isn't quite as important to you, Lite job posts are available for free, but they have limited features and the number of active posts are limited.  Lite Jobs will always be listed below the local bounty jobs.  For example, if there are currently 15 bounty jobs in the region, when you post your job it will start at 16th on the list and move down as other post free jobs.</i>
						<br />
						&nbsp; <br />
					</div>
				</div>

<!--
				<h3 style="text-align: center">I like Free stuff</h3>
				<div style='float:left; width:100%; margin-left:5px; margin-right:3px; margin-top:10px;'>
					
					<div style='float:left; width:98%; margin-left:5px;'>										
						<h4 style='margin-bottom:5px;'>&#9679; So do we, and basic job posts are still available for free</h4>
					</div>
					
					<div style='float:left; width:90%; margin-top:0px; margin-left:10px; margin-right:3px;'>																				
						 <i>If finding a top candidate isn't quite as important to you, free job posts are still available as usual.  BUT they will always be listed below the local bounty jobs.  For example, if there are currently 15 bounty jobs in the region, when you post your job it will start at 16th on the list and move down as other post free jobs.</i>
						<br />
						&nbsp; <br />
					</div>
				</div>
-->
	
				<h4 style="text-align:center">Check out our <a href='main.php?page=bounty_faq'>BOUNTY FAQ</a> for more details.</h4>
					
									
<!-- 					We now offer two types of job posts "Free" and "Bounty Posts".  Obviously free posts are free, but offer no special benefits.  Bounty Posts allow you to choose the amount you want to pay, starting at a minimum of $25.  We pay a portion of your job posting fee to users who recommend the best candidates. -->
				</div>
			</div>	
<?php	
}

function main_html_boost_info_mobile($type) {
	switch($type) {
		case "cl_group":
?>
		<div style="float:left; width:100%; margin-top: 0px;">
			<h3 style='text-align:center;'>Job Boost - Craigslist Group Post</h3>
		</div>	

		<div style="float:left; width:96%; margin-left: 5px; margin-right: 3px; margin-bottom:15px">

			<div style='float:left; padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>WHAT IS A CRAIGSLIST GROUP POST?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					Twice per week we post an advertisement on Craigslist.com that contains job title, location, and a link to the job page for each recently boosted post.  These posts only contain only the boosted posts the have purchased the Craigslist Group Post option and are regions specific.
					(e.g.  only Orlando region jobs are posted on Craigslist Orlando).  
					&nbsp; <br />					
					<br />The number of jobs advertised on this post varies depending on how many job posters have recently purchased the Craigslist boost option.  We typically post on Tuesdays and Thursdays.  Although these days
					may vary based on the time of year.  We use view and click data to determine the best days and times to post on Craigslist to give your job the best exposure.  We are constantly updated our algorithms with new data to give the best results.  Currently, each boosted job is 
					posted in two consecutive group posts.  
					&nbsp; <br />					
					<br />
					After you purchase a boost, the first Craigslist post is typically the closest Tuesday or Thursday to the date you posted.  This may vary depending on the time of day posted.  Craigslist Group posts are typically delayed on weeks with major holidays, to help ensure better exposure. 
				</div>
			</div>		

<?php		
		break;
		
		case "social":
?>
		<div style="float:left; width:100%; margin-top: 0px;">
			<h3 style='text-align:center;'>Job Boost - Social Media (Facebook & Instagram)</h3>
		</div>	

		<div style="float:left; width:96%; margin-left: 5px; margin-right: 3px; margin-bottom:15px">

			<div style='float:left; padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>WHAT IS A SOCIAL MEDIA BOOST?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					For those jobs that have purchased a Social Media Boost will have their jobs posted on Facebook & Instagram as a Paid/Sponsored Promotion.  We promote the individual job with a link to the job page and
					specifically target users in the region of the job who would be most likely to have interest in the position.  
					
					&nbsp; <br />					
					<br />					
					We constantly refine our Facebook and Instagram audience targeting data to ensure that promoted
					posts get seen by the people who are in the region, in the industry, and are specific to that particular job.  We constantly update our targeting based on result data we have collected for thousands of job posts. 
				</div>
			</div>		
<?php		
		break;
		
		case "email":
?>
		<div style="float:left; width:100%; margin-top: 0px;">
			<h3 style='text-align:center;'>Job Boost - Featured Email Blast (Regional)</h3>
		</div>	

		<div style="float:left; width:96%; margin-left: 5px; margin-right: 3px; margin-bottom:15px">

			<div style='float:left; padding-top:15px; margin-left:10px; margin-top:15px;'>
				<img src="images/redarrow.png" height="20px" width="20px" alt='faq' style="vertical-align:text-bottom"> &nbsp; <h4 style='display:inline'>WHAT IS AN EMAIL BOOST?</h4><br />
				<div style='margin-left:30px; margin-top:10px;'>
					For those jobs that have purchased an Email boost, we include the job title and location in our weekly email blast.  We send a weekly email to all available candidates (region specific) that includes details of the weekly featured jobs.
					
					&nbsp; <br />					
					<br />					
					This is in addition to email alerts, which are automatically sent when a job that matches a users skill is posted.
				</div>
			</div>		
<?php		
		break;						
	}
}

function bounty_payout_mobile() {
?>

	<div style='float:left; width:99%; margin-left:3px; margin-right:3px; margin-bottom:10px;'>
		<h3 style='text-align:center; margin-top:10px;'>BOUNTY PAYOUT INFO</h3>

		<b>After a bounty job expires we will contact you via email (or phone if we are unable to reach via email) to determine whether you hired a candidate that was recommended by a user. 
		 If so, we will then contact that user and pay them the bounty amount via PayPal Payment or Amazon Gift Card.</b><br />		

		<h5 style='text-align:center; margin-bottom:0px;'>SBC pays bounties as follows</h5>
		
		<table cellspacing='6' cellpadding='6' align="center">
			<th>Bounty Payout*</th>
			<th>Total Post Cost*</th>
<?php
	$count = 1;
	
	while($count <= 20) {
		$bounty = $count * 5;
		$cost = 19 + 1.2 * $bounty;
		echo "<tr>";
			echo "<td align='center'>$".$bounty."</td>";
			echo "<td align='center'>$".$cost."</td>";			
		echo "</tr>";	
		$count++;	
	}
?>
		</table>
		<i>*Total Post Cost includes a $19 base fee plus the bounty and a processing fee of 20% of the bounty amount.</i>
	</div>
<?php	
}

function contact_html_mobile() {
?>
		<div style="float:left; width:100%; margin-top: 15px; margin-bottom:10px;">
			<h3 style='text-align:center;'>CONTACT US</h3>
		</div>	

		<div style="float:left; width:96%; margin-left: 15px; margin-right: 3px; margin-bottom:15px">
				Technical Issues: <a href="mailto:admin@servebartendcook.com">admin@servebartendcook.com</a><br />
				&nbsp; <br />
				Marketing Team: <a href="mailto:marketing@servebartendcook.com">marketing@servebartendcook.com</a><br />
				&nbsp; <br />
				Account Deactivation: <a href="mailto:deactivate@servebartendcook.com">deactivate@servebartendcook.com</a>	
		</div><br/>				
<?php	
}

	
/*
	function employee_how_html_mobile() {
?>	
	<div id="holder">
		
	<div class='main_box' id="details_edit_employee" style='width:100%; float:left; margin-left:3.5%; margin-right:3.5%;'>
			<h3 style='margin-top:10px; margin-bottom:10px'>Help/FAQs</h3>	
			<h4 style='margin-bottom:10px; margin-top:10px; color:6c6367'>Have a question? We can help.</h4>

			<div id='how_button' style='width:100%; float:left; margin-top:10px;'>
					<div class='warning' id='incomplete_error' style='color:red; float:right; margin-right:3px; display:none;'><b>You must complete your profile first</b><br /></div>
					<div style='width:3%; float:left'><img src="images/howitworks.png" alt="menu" style="position: relative; bottom: 12px; height:80px"></div>
					<div class='unselected_job_areas'>How SBC Works<br>
						<span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>
							<span id='opportunity_summary_holder'>How do we find you the best jobs?</span>
						</span>
					</div>
			</div>
			
			<div id="how_holder" style="display:none; margin-left:6%">	
				<h3>How it Works</h3>
				
					<div class='bubble_how'>
						<h2>Create a Profile</h2>
							Your profile is like a resume, detailing your skills and experience. You may also include a profile photo and photos of your work, via Instagram, Vine or Youtube.
					</div>
					
					<div class='bubble_how'>
						<h2>View Jobs</h2>			
							You will be matched to jobs that match your skills and are within 40 miles of your zip code. You'll be notified via email of any new jobs that are posted in the future that match your profile.
					</div>
					
					<div class='bubble_how'>
						<h2>Apply</h2>						
						If you respond to a job, a message is sent directly to the job poster with your profile info, so make sure your profile is thorough!					
					</div>
		
					<div class='bubble_how'>
						<h2>Remain Anonymous</h2>									
						Your info will remain <i>completely hidden</i> unless you decide to request an interview from the employer.<br />
						No one can search your profile or view it until you let them.  So you can wait until the perfect job appears, then let them see your profile.
					</div>
			</div>
			
			<div id='help_button' style='width:100%; float:left;'>
					<div class='warning' id='incomplete_error' style='color:red; float:right; margin-right:3px; display:none;'><b>You must complete your profile first</b><br /></div>
					<div style='width:3%; float:left'><img src="images/faq.png" alt="menu" style="position: relative; bottom: 12px; height:80px"></div>
					<div class='unselected_job_areas'>FAQ<br>
						<span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>
							<span id='opportunity_summary_holder'>Let us answer your questions.</span>
						</span>
					</div>
			</div>
			
		<div id="help_holder" style="display:none; margin-left:6%">	
			<h3>Frequently Asked Questions</h3>
					
			<div class='bubble_how'>
				<h2>How do I find jobs?</h2>
				Jobs find you based on your experience and location.  <br/> &nbsp; <br/>All you need to do is create a profile and you will be notified any time a job matches your skills and is within 40 miles of your location.	</div>
		
			<div class='bubble_how'>
				<h2>How do I stop getting matched to certain types of jobs?</h2>
				When editing your profile, scroll to "You are being matched to these job types", then deselect the skill you wish to no longer to receive jobs for (the button will turn grey).  
				<br /> &nbsp; <br />Your experience will still appear on your profile, but you will not be matched to any open jobs of this type.	
			</div>	
			
			<div class='bubble_how'>
				<h2>How do I change my location?</h2>
				You can update your zip code by visiting the <a href='employee.php?page=settings'>SETTINGS</a> page.	
			</div>							
		
			<div class='bubble_how'>
				<h2>How do I change the number of years of experience listed on my profile?</h2>
				All experience on your profile is connected to a job that you have entered on the site. SBC adds the experience of all of your jobs together to show your total experience in a particular skill. If you want your profile to reflect more experience, simply add more jobs to your job history with correct start/end date, or correct any start/end dates on the jobs that you have already entered.
			</div>
			
			<div class='bubble_how'>
				<h2>How do I add new skills to my profile?</h2>
				All skills on your profile are connected to a job that you have entered on the site. If you would like to add new skills to your profile, you can either 1) add a new job with new skills, or 2) edit any existing experience you’ve already entered on the site and select more skills.
			</div>
		
			<div class='bubble_how'>
				<h2>How do I change my email settings?</h2>
				In your main menu, click "Settings". From there, you can manage your email settings.
			</div>
		
			<div class='bubble_how'>
				<h2>How do I deactivate my account?</h2>
				Please email <a href="mailto:deactivate@servebartendcook.com">deactivate@servebartendcook.com</a> and request that your account be deactivated.
			</div>
		</div>
			
			<div id='contact_button' style='width:100%; float:left;'>
					<div class='warning' id='incomplete_error' style='color:red; float:right; margin-right:3px; display:none;'><b>You must complete your profile first</b><br /></div>
					<div style='width:3%; float:left'><img src="images/contactus.png" alt="menu" style="position: relative; bottom: 12px; height:80px"></div>
					<div class='unselected_job_areas'>Contact Us<br>
						<span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>
							<span id='opportunity_summary_holder'>Have more questions? Email us now.</span>
						</span>
					</div>
			</div>

		<div id="contact_holder" style="display:none">	
			<div style='margin-left:6%;'>
				<h3>Contact Us</h3>
				
				<div class='bubble_how'>
					<h2>Technical Issues:</h2> 
					<a href="mailto:admin@servebartendcook.com">admin@servebartendcook.com</a>
				</div>	
				
				<div class='bubble_how'>
					<h2>Marketing Team:</h2> 
					<a href="mailto:marketing@servebartendcook.com">marketing@servebartendcook.com</a>
				</div>
				
				<div class='bubble_how'>
					<h2>Account Deactivation:</h2> 
					<a href="mailto:deactivate@servebartendcook.com">deactivate@servebartendcook.com</a>						</div>
			</div>				
		</div>						
		
<?php
	}


	function employer_how_html_mobile() {
?>	
	<div id="holder">
		
	<div class='main_box' id="details_edit_employee" style='width:100%; float:left; margin-left:3.5%; margin-right:3.5%;'>
			<h3 style='margin-top:10px; margin-bottom:10px'>Help/FAQs</h3>	
			<h4 style='margin-bottom:10px; margin-top:10px; color:6c6367'>Have a question? We can help.</h4>

			<div id='how_button' style='width:100%; float:left; margin-top:10px;'>
					<div class='warning' id='incomplete_error' style='color:red; float:right; margin-right:3px; display:none;'><b>You must complete your profile first</b><br /></div>
					<div style='width:3%; float:left'><img src="images/howitworks.png" alt="menu" style="position: relative; bottom: 12px; height:80px"></div>
					<div class='unselected_job_areas'>How SBC Works<br>
						<span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>
							<span id='opportunity_summary_holder'>How do we find you the best employees?</span>
						</span>
					</div>
			</div>
	
		<div id="how_holder" style="display:none; margin-left:6%">		
			<h3>How it Works</h3>
		
			<div class='bubble_how'>
				<h2>Enter Your Location</h2>
					Create a store location or multiple locations.  You can stay organized and manage hiring at separate restaurant or bar locations.
			</div>
			
			<div class='bubble_how'>
				<h2>Create a Job Post</h2>
					Create a job by post by picking and choosing required skills.  You can also enter 'Pre-Interview Questions' for additional candidate screening.
			</div>
			
			<div class='bubble_how'>
				<h2>View Responses</h2>
					Email notices will be sent out to all candidates within 25 miles matching the experience in your job post.<br />									
					You will be notified via email when a candidate is interested.	
			</div>
			
			<div class='bubble_how'>
				<h2>Stay Organized</h2>
					You can post a link to your ServeBartendCook.com job post on your Facebook page or anywhere else.  This will allow people to apply through ServeBartendCook to keep all applications organized and sortable in one place.
			</div>
		</div>
		
			<div id='help_button' style='width:100%; float:left;'>
					<div class='warning' id='incomplete_error' style='color:red; float:right; margin-right:3px; display:none;'><b>You must complete your profile first</b><br /></div>
					<div style='width:3%; float:left'><img src="images/faq.png" alt="menu" style="position: relative; bottom: 12px; height:80px"></div>
					<div class='unselected_job_areas'>FAQ<br>
						<span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>
							<span id='opportunity_summary_holder'>Let us answer your questions.</span>
						</span>
					</div>
			</div>
		
		
		<div id="help_holder" style="display:none; margin-left:6%">	
			<h3>FAQ</h3>
		
			<div class='bubble_how'>
				<h2>How do I find employees?</h2>
					Create a job and an email will be sent to all matching candidates.  If they are interested in the job, you will receive an email notice.	
			</div>
		
			<div class='bubble_how'>
				<h2>My company will not allow me to view pictures.</h2>
					In your profile you can turn photo viewing off. This will hide all photos and videos on profiles of interested candidates. 
			</div>
	
			<div class='bubble_how'>
				<h2>How do I deactivate my account?</h2>
					Please email <a href="mailto:deactivate@servebartendcook.com">deactivate@servebartendcook.com</a> and request that your account be deactivated.			
			</div>		
		</div>
		

			<div id='contact_button' style='width:100%; float:left;'>
					<div class='warning' id='incomplete_error' style='color:red; float:right; margin-right:3px; display:none;'><b>You must complete your profile first</b><br /></div>
					<div style='width:3%; float:left'><img src="images/contactus.png" alt="menu" style="position: relative; bottom: 12px; height:80px"></div>
					<div class='unselected_job_areas'>Contact Us<br>
						<span style='width:90%; margin:auto; color:#e9e6de; font-size: 12px;'>
							<span id='opportunity_summary_holder'>Have more questions? Email us now.</span>
						</span>
					</div>
			</div>
		
		<div id="contact_holder" style="display:none; margin-left:6%">	
				<h3>Contact Us</h3>
				
				<div class='bubble_how'>
					<h2>Technical Issues:</h2> 
					<a href="mailto:admin@servebartendcook.com">admin@servebartendcook.com</a>
				</div>	
				
				<div class='bubble_how'>
					<h2>Marketing Team:</h2> 
					<a href="mailto:marketing@servebartendcook.com">marketing@servebartendcook.com</a>
				</div>
				
				<div class='bubble_how'>
					<h2>Account Deactivation:</h2> 
					<a href="mailto:deactivate@servebartendcook.com">deactivate@servebartendcook.com</a>						</div>
			</div>				
		</div>						

<?php
	}
	
	
	function employer_help_html_mobile() {
?>	
	<div id="holder">
	<div id="fixed-menu" style="text-align:center">
		<img src="images/mobile-logo320.png" style="padding-top:15px;">
	</div>	
		
	<div style="margin-top:80px;">				
		<h1 style="text-align:center;">FAQ</h1>
				
		<table class='dark' style='width:100%;'>
			<tr valign='middle'>
			<th valign='middle'><b>Let us answer your questions.</b></th>
			</tr>			
		</table>
		
		<div style='padding-top:15px; margin-left:10px; color:#760006'>
				Create a job and an email will be sent to all matching candidates.  If they are interested in the job, you will receive an email notice.	
		</div><br/>
	
		<table class='dark' style='width:100%;'>
			<tr valign='middle'>
			<th valign='middle'><b>My company will not allow me to view videos or pictures</b></th>
			</tr>			
		</table>
		
		<div style='padding-top:15px; margin-left:10px; color:#760006'>
				In your profile you can turn photo and video viewing off.  This will hide all photos and videos on profiles of interested cnadidates. 
		</div><br/>

		<table class='dark' style='width:100%;'>
			<tr valign='middle'>
			<th valign='middle'><b>Deactivate my account?</b></th>
			</tr>			
		</table>
		
		<div style='padding-top:15px; margin-left:10px; color:#760006'>
				Please email admin@servebartendcook.com and request that your account be deactivated.
		</div><br/>
		
		<table class='dark' style='width:100%;'>
			<tr valign='middle'>
			<th valign='middle'><b>Contact Us</b></th>
			</tr>			
		</table>
		
		<div style='padding-top:15px; margin-left:10px; color:#760006'>
				Technical Issues:  admin@servebartendcook.com<br />
				&nbsp; <br />
				Marketing Team: marketing@servebartendcook.com<br />
		</div><br/>		

<?php
	}
*/
	
function email_verification_mobile($email_verification,$email, $creation_date) {

	echo "<div id='holder'>";
		
		echo "<div style='margin-top:30px; float:left; text-align:center; margin-left:3px; margin-right:3px; text-align:center;'>";	
		
		echo "<h3>Verification Email</h2><br />";
			if ($email_verification == 'Y') {
				echo "You've already verified your email address.  There's nothing else you need to do to continue using the site.";
			} else {	
				echo "<div style='float:left; width:100%;' id='email_header'>";
					echo "<h4>An email was to sent to <b>".$email."</b> on ".date("D, d M Y", strtotime($creation_date)).".</h4>";
					if ($_SESSION['type'] == 'employee') {
						echo "<i>You can complete your profile now, but you will be unable to apply for jobs or view details until you click the verification link included in your introductory email.</i><br />";
					} else {
						echo "<i>You will need to click the link provided in the verification email before you can finalize a job post.</i><br />";					
					}
				echo "</div>";
				
				
				//hidden input for JS
				echo "<input type='hidden' id='email' value='".$email."'>";
				
				echo "&nbsp; <br />";
				echo "<div id='email_links'>";			
					echo "<a href='#' class='btn btn-large btn-warning' id='resend_verification'>RESEND VERIFICATION</a><br />";			  
					echo "&nbsp; <br />";
					echo "&nbsp; <br />";
					echo "<a href='#' class='btn btn-large btn-warning' id='change_email_button'>CHANGE EMAIL ADDRESS</a><br />";				
					echo "&nbsp; <br />";
				echo "</div>";
							
				
				echo "<div id='email_change_holder' style='display:none; width:100%; float:left; margin-left:3px; margin-right:3px; margin-top:10px; text-align:center; min-height:450px;'>";
					echo "<h3>Change Email Address</h3>";
					echo "&nbsp; <br />";
					echo "&nbsp; <br />";
						
					echo "<div id='employer_empty_warning' class='warning' style='display:none; width:100%; text-align:center;'><font color='red'><b>NOTICE: Please complete required fields</b></font></div>";
					echo "<div id='employer_duplicate_warning' class='warning' style='display:none; width:100%; text-align:center;'><font color='red'><b>NOTICE: Email already being used</b></font></div>";
					echo "<div id='employer_email_warning' class='warning' style='display:none; width:100%; text-align:center;'><font color='red'><b>NOTICE: Invalid email address</b></font></div>";
					echo "<div id='general_warning' class='warning' style='display:none; width:100%; text-align:center;'><font color='red'><b>NOTICE: Something went wrong, please try again later.</b></font></div>";
			
					echo "<h4 style='margin-bottom:0px;'>".$email."</h4><br />";
				    echo "<input type='text' placeholder='Email Address' id='new_email' style='width:90%; margin-top:0px; margin-bottom:10px;'><br />";	        
					echo	"<div style='display: inline-block; width:70%; margin:auto; color:white; text-align:center;' class='btn btn-large btn-warning' id='submit_new_email'>Change Email Address</div><br />";
					echo "<input type='hidden' id='old_email' value='".$email."'>";
					echo "<input type='hidden' id='type' value='".$_SESSION['type']."'>";
					echo "&nbsp; <br />";
					echo "<a href='#' id='wrong_email_back'>Cancel</a>";
				echo "</div>";
				
				echo "<div id='email_loader' style='display:none; float:left; text-align:center; width:100%;'>";
					echo "<font size='6px'><b>Loading......</b></font><br />";	
				echo "</div>";	
				
				echo "<div id='verification_sent' style='display:none; float:left; text-align:center; width:100%;'>";
					echo "The verification email was resent to the address above.  Please make sure to check you spam/junk folder.<br />";	
				echo "</div>";	
				
				echo "<div id='new_verification_sent' style='display:none; float:left; text-align:center; width:100%;'>";
					echo "A new verification link was sent to your corrected email address.  Please make sure to check you spam/junk folder.<br />";	
				echo "</div>";														
		}																												
		echo "</div>";
	echo "</div>";
	}
	
	function local_deals_html_mobile($ad_data) {
?>	
	<div id="holder">
		
	<div style="margin-top:10px;">
<?php
		if($ad_data == "none") {
			echo "<h1 style='text-align:center;'>No current deals</h1>";			
		} else {				
			echo "<h1 style='text-align:center;'>Local ".$_SESSION['region_name']." Deals</h1>";
			echo "<h4 style='text-align:center'>Support your local community by visiting the deals below!</h4>";
					
			echo "<table class='dark' style='width:100%;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle'></th>";
				echo "</tr>";			
			echo "</table>";
			
			foreach($ad_data as $ad) {
				echo "<div style='float:left; text-align:center; width:100%; margin-right:3px; margin-left:3px; margin-bottom:10px;'>";
					echo "<a href='".$ad['ad_link']."'><img src='".$ad['ad_photo']."'></a><br />";
					echo "<a href='".$ad['ad_link']."'><b>".$ad['ad_title']."</b></a><br />";
					echo "".$ad['ad_text']."<br />";
					echo "<font color='red'><b><i>".$ad['deal']."</i></b></font><br />";
				echo "</div>";
			}	
			
		}
	}					
?>