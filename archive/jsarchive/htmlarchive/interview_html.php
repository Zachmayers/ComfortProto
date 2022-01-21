<?php
	
function interview_menu_html($job_list_array, $job_list_archive, $count) {

?>
	<div style="float:left; width:100%">
		<div style="float:left; width:85px;">
			<img src='images/interviewred.png' height="75px" width="75px" alt='interview'>
		</div>
		<div style="float:left; width:500px;">
			<h2>Interview List & Notes</h2>
			
			<a href='interview.php?page=all'><h4>View All Upcoming Interviews</h4></a>
		</div>
	</div>

	<a href='#' class='current'><div class='selected_tab' id='current_tab'>Current Jobs</div></a>
	<a href='#' class='archive'><div class='unselected_tab' id='archive_tab'>Archive</div></a>

	<table class='dark' id='current' style='width:620px;'>
		<thead>
			<tr>
				<th width='40%'>Position</th>
				<th width='20%'>Upcoming Interviews</th>
				<th width='20%'>Completed Interviews</th>
				<th width='20%'>Canceled Interviews</th>				
			</tr>
		</thead>
<?php	
		if (count($job_list_array) > 0) {
			foreach($job_list_array as $key=>$row) {
				if ($row['post_type'] == "bounty") {
					echo "<tr class='current_jobs'>";
						echo "<td>";
							echo "<a href='interview.php?page=job&ID=".$row['jobID']."'>".$row['title']."</a>";
						echo "</td>";
						echo "<td align='center'>";
							echo $count[$key]['upcoming'];
						echo "</td>";
						echo "<td align='center'>";
							echo $count[$key]['complete'];
						echo "</td>";
						echo "<td align='center'>";
							echo $count[$key]['cancel'];
						echo "</td>";
					echo "</tr>";	
				} else {
					echo "<tr class='current_jobs'>";
						echo "<td>";
							echo $row['title'];
						echo "</td>";										
						echo "<td colspan='3'>";
							echo "<b><font color='red'>Interviews Only Available for Paid Job Posts</font></b>";						
						echo "</td>";
					echo "</tr>";					
				}				
			}
		}	
		
		if (count($job_list_archive) > 0) {
			foreach($job_list_archive as $row) {
				echo "<tr class='archive_jobs' style='display:none'>";
					echo "<td>";
						echo "<a href='interview.php?page=job&ID=".$row['jobID']."'>".$row['title']."</a>";
					echo "</td>";
					echo "<td align='center'>";
						echo "NA";
					echo "</td>";
					echo "<td align='center'>";
						echo "NA";
					echo "</td>";
					echo "<td align='center'>";
						echo "NA";
					echo "</td>";
				echo "</tr>";					
			}
		}			
	echo "</table>";
	
}	

function interview_list_all_html($type, $interview_list) {
?>	
	<div style="float:left; width:100%">
		<div style="float:left; width:85px;">
			<img src='images/interviewred.png' height="75px" width="75px" alt='interview'>
		</div>
		<div style="float:left; width:500px;">
<?php
				if ($type == "current") {
					echo "<h2>Upcoming Interviews</h2>";
				} else {
					echo "<h2>Past Interviews Interviews (1-Year)</h2>";		
				}
?>			
			<a href='interview.php'><h4>View Interviews by Job Post</h4></a>
		</div>
	</div>
<?php
	
	if ($type == "current") {
		echo "<div class='selected_tab' id='current_tab'>Upcoming</div>";
		echo "<a href='interview.php?page=past'><div class='unselected_tab' id='archive_tab'>Past</div></a>";
	} else {
		echo "<a href='interview.php?page=all'><div class='unselected_tab' id='current_tab'>Upcoming</div></a>";
		echo "<div class='selected_tab' id='archive_tab'>Past</div>";		
	}

	echo "<table class='dark' id='candidates' style='width:620px; margin-top:20px'>";
	echo "<thead>";
		echo "<tr>";
			echo "<th width='30%'>Candidate</th>";
			echo "<th width='30%'>Position</th>";
			echo "<th width='20%'>Date</th>";
			echo "<th width='20%'>Status*</th>";
		echo "</tr>";	
	echo "</thead>";

	if(count($interview_list) > 0) {		
		date_default_timezone_set('America/Los_Angeles');		
		$current_date =  date('Y-m-d');

		foreach($interview_list as $row) {
			//status checks
			$notice = "";
			if ($row['status'] == "employee_cancel" || $row['status'] == "view_employee_cancel") {
				$status = "<font color='red'><b>EMPLOYEE CANCELED</b></font>";
				$notice = "<font color='red'><b>!!!</b> &nbsp; &nbsp;";
			} elseif ($row['status'] == "employer_cancel"  || $row['status'] == "view_employer_cancel") {
				$status = "<font color='red'><b>You canceled</b></font>";			 	
			} elseif ($current_date > $row['interview_date']) {
				$status = "Past";
			} elseif ($status == "viewed") {
				$status = "Viewed<br />".date('M d, g:i A', strtotime($row['status_date']));
			} else {
				$status = "Pending";
			}
			
			echo "<tr>";
				echo "<td width='30%'>".$notice."<a href='candidate.php?ID=".$row['candidateID']."&matchID=".$row['matchID']."'>".$row['firstname']." ".$row['lastname']."</a></td>";
				echo "<td width='30%'><a href='job.php?ID=".$row['jobID']."'>".$row['title']."</a></td>";
				echo "<td width='20%'><a href='candidate.php?ID=".$row['candidateID']."&matchID=".$row['matchID']."&page=interview'>".date('M d, g:i A', strtotime($row['interview_date']))."</a></td>";
				echo "<td width='20%'>".$status."</td>";	
			echo "</tr>";			
		}
	} else {
		echo "<tr><td colspan='5'>No Interviews</td></tr>";
	}
	echo "</table>";
	
}


function interview_list_job_html($post_type, $job_title, $interview_list, $count, $view_expired) {	
?>
	<div style="float:left; width:100%">
		<div style="float:left; width:85px;">
			<img src='images/interviewred.png' height="75px" width="75px" alt='interview'>
		</div>
		<div style="float:left; width:500px;">
			<h2>Scheduled Interviews for <?php echo $job_title ?></h2>
		</div>
	</div>
<?php
	
	
	echo "<table class='dark' id='candidates' style='width:620px; margin-top:20px'>";
		echo "<thead><tr>";
			echo "<th width='35%'>Candidate</th>";
			echo "<th width='35%'>Interview Date</th>";
			echo "<th width='30%'>Status*</th>";
		echo "</thead>";
	echo "</table>";

	if ($post_type == "bounty") {
		echo "<table class='dark' id='candidates' style='width:620px;'>";
		if(count($interview_list) > 0) {		
			date_default_timezone_set('America/Los_Angeles');		
			$current_date =  date('Y-m-d');
	
			foreach($interview_list as $row) {
				//status checks
				$notice = "";
				if ($row['status'] == "employee_cancel" || $row['status'] == "view_employee_cancel") {
					$status = "<font color='red'><b>EMPLOYEE CANCELED</b></font>";
					$notice = "<font color='red'><b>!!!</b> &nbsp; &nbsp;";
				} elseif ($row['status'] == "employer_cancel" || $row['status'] == "view_employer_cancel") {
					$status = "<font color='red'><b>You canceled</b></font>";			 	
				} elseif ($current_date > $row['interview_date']) {
					$status = "Past";
				} elseif ($status == "viewed") {
					$status = "Viewed<br />".date('M d, g:i A', strtotime($row['status_date']));
				} else {
					$status = "Pending";
				}
				
				if ($view_expired == 'N') {
					$candidate_name = "<a href='candidate.php?ID=".$row['candidateID']."&matchID=".$row['matchID']."'>".$row['firstname']." ".$row['lastname']."</a>";
				} else {
					$candidate_name = $row['firstname']." ".$row['lastname'];					
				}
				
				echo "<tr>";
					echo "<td width='35%'>".$notice." ".$candidate_name."</td>";
					echo "<td width='35%'><a href='candidate.php?ID=".$row['candidateID']."&matchID=".$row['matchID']."&page=interview'>".date('M d, g:i A', strtotime($row['interview_date']))."</a></td>";
					echo "<td width='30%'>".$status."</td>";	
				echo "</tr>";			
			}
		} else {
			echo "<tr><td colspan='5'>No Interviews</td></tr>";
		}
		echo "</table>";
	} else {
		echo "<h3>Interview Reminders only available for Bounty Job Posts.</h3>";
		
		echo "<a href='job.php?ID=new_job'><div class='green_button choice' id='bounty_final' style='float:left; margin-top:30px; margin-left:140px; width:350px; text-align:center'>";
			echo "<img src='images/savegreen.png' style='width:25px;height:25px;vertical-align:middle'>";
			echo "<span style='margin-left:10px; vertical-align:middle;'>Post a Bounty Job!</span>";
		echo "</div></a>";
		
		echo "<div style='float:left; width:100%; text-align:center;'>";
			echo "<i>Bounty Posts help support the ServeBartendCook community</i><br />";
			echo "<a href='main.php?page=bounty_summary'>Learn More About Bounty Job Posts</a>";
		echo "</div>";
	}
	
}

function notes_list_job_html($post_type, $title, $notes_array) {
?>
	<div style="float:left; width:100%">
		<div style="float:left; width:85px;">
			<img src='images/interviewred.png' height="75px" width="75px" alt='interview'>
		</div>
		<div style="float:left; width:500px;">
			<h2 style='margin-bottom:0px'>Candidate Notes</h2>
			<h4  style='margin-top:0px'><? echo $title ?></h4>
		</div>
	</div>
	
	<div id='button_holder' style='float:left; width:100%; margin-left:5px; margin-bottom:-10px;'>	
		<div style='float:left; width:75px; margin-right:5px; margin-bottom:0px;' >
			<h4 style='display:inline:'>SORT BY</h4>
		</div>
				<a href='interview.php?page=notes_list&ID=<? echo $_GET['ID'] ?>&sort=culture'>	
					<div style='float:left; width:140px; text-align:center; margin-right:5px; cursor:pointer;' class='btn btn-primary'>
						Company Fit
					</div>
				</a>

				<a href='interview.php?page=notes_list&ID=<? echo $_GET['ID'] ?>&sort=experience'>
					<div style='float:left; width:140px; text-align:center; margin-right:5px; cursor:pointer;' class='btn btn-primary'>
						Experience
					</div>
				</a>

				<a href='interview.php?page=notes_list&ID=<? echo $_GET['ID'] ?>&sort=availability'>
					<div style='float:left; width:110px; text-align:center; cursor:pointer;' class='btn btn-primary'>
						Availability
					</div>
				</a>			
			</div>
	
<?php
		echo "<div id='results' style='float:left;'>";
			echo "<table class='dark' id='candidates' style='width:625px;'>";
				echo "<thead><tr>";
					echo "<th style='width:20%'>Candidate</th>";
					echo "<th style='width:20%; text-align:center'>Company Fit</th>";
					echo "<th style='width:20%; text-align:center'>Relevant Experience</th>";
					echo "<th style='width:20%'>Availability</th>";
					echo "<th style='width:20%;text-align:center'>Notes</th>";
				echo "</tr></thead>";
			echo "</table>";
			
		if ($post_type == "bounty") {
			echo "<table class='dark' id='candidates' style='width:625px;'>";
			if(count($notes_array) > 0) {		
				$notes_type = array("culture", "experience", "availability");
	
				foreach($notes_array as $notes) {
					if (count($notes) > 0) {
						echo "<tbody class='note_rows'>";
							foreach ($notes as $row) {
	
								foreach($notes_type as $type) {
									switch($row[$type]) {
										default:
											$row[$type] = "<span style='color:black''>$row[$type]</span>";
										break;
			
										case "Poor":
											$row[$type] = "<span style='color:#8e080b'>$row[$type]</span>";
										break;
			
										case "Good":
											$row[$type] = "<span style='color:#ac681e'>$row[$type]</span>";									
										break;
			
										case "Great":
											$row[$type] = "<span style='color:green'>$row[$type]</span>";
										break;
									}
								}
									
								echo "<tr >";	
									echo "<td style='width:20%'><a href='candidate.php?ID=".$row['userID']."&matchID=".$row['matchID']."'>".$row['firstname']." ".$row['lastname']."</a></td>";	
									echo "<td style='width:20%' align='center'>".$row['culture']."</td>";
									echo "<td style='width:20%' align='center'>".$row['experience']."</td>";
									echo "<td style='width:20%' align='center'>".$row['availability']."</td>";
									echo "<td style='width:20%' align='center'><a href='candidate.php?ID=".$row['userID']."&matchID=".$row['matchID']."&page=notes'>VIEW</a></td>";
								echo "</tr>";
									
							}
							echo "</tbody>";
						}
					}
				} else {			
					echo "<tr><td colspan='4'>You haven't added any interview notes for any candidates yet.<br />To add notes please visit the <a href='job.php?ID=".$_GET['ID']."'>job page</a>.</td></tr>";
				}
				echo "</table>";	
			} else {
				echo "<h3>Candidate Notes & Ranking only available for Bounty Job Posts.</h3>";
				
				echo "<a href='job.php?ID=new_job'><div class='green_button choice' id='bounty_final' style='float:left; margin-top:30px; margin-left:140px; width:350px; text-align:center'>";
					echo "<img src='images/savegreen.png' style='width:25px;height:25px;vertical-align:middle'>";
					echo "<span style='margin-left:10px; vertical-align:middle;'>Post a Bounty Job!</span>";
				echo "</div></a>";
				
				echo "<div style='float:left; width:100%; text-align:center;'>";
					echo "<i>Bounty Posts help support the ServeBartendCook community</i><br />";
					echo "<a href='main.php?page=bounty_summary'>Learn More About Bounty Job Posts</a>";
				echo "</div>";
			}
	echo "</div>";		

}
?>