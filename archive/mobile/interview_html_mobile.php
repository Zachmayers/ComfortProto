<?php
	
function interview_menu_html_mobile($job_list_array, $job_list_archive, $count) {

?>
	<div class='main_box' style='margin-top:53px; width:100%;'>
		<div style="float:left; width:100%; text-align:center;">
			<div style='width:49.5%; float:left; background-color:#DBDCCE; min-height:30px; margin-right:1px;'><a href='#' class='current' style='color:#5D0000'><h4 style='margin-bottom:10px; margin-top:10px;'>Current</h4> </a></div>
			<div style='width:49.5%; float:left; background-color:#DBDCCE; min-height:30px; margin-right:1px;'><a href='#' class='archive' style='color:#5D0000'><h4 style='margin-bottom:10px; margin-top:10px;'>Archive</h4></a></div>
		</div>
	<div style="float:left; width:100%; text-align: center;">
		<h3>Interview List</h3>			
		<a href='interview.php?page=all'><h4>View All Upcoming Interviews</h4></a>
	</div>

	<table class='dark' id='current' style='width:100%'>
		<thead>
			<tr>
				<th width='40%'>Position</th>
				<th width='30%'>Set</th>
				<th width='30%'>Canceled</th>				
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
							echo $count[$key]['cancel'];
						echo "</td>";
					echo "</tr>";	
				} else {
					echo "<tr class='current_jobs'>";
						echo "<td>";
							echo $row['title'];
						echo "</td>";										
						echo "<td colspan='2'>";
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
	echo "</div>";
}	

function interview_list_all_html_mobile($type, $interview_list) {
?>	
	<div class='main_box' style='margin-top:53px; width:100%;'>
	<div style="float:left; width:100%">
		<div style="float:left; width:100%; text-align:center;">
			<div style='width:49.5%; float:left; background-color:#DBDCCE; min-height:30px; margin-right:1px;'><a href='interview.php?page=all' class='current' style='color:#5D0000'><h4 style='margin-bottom:10px; margin-top:10px;'>Upcoming</h4> </a></div>
			<div style='width:49.5%; float:left; background-color:#DBDCCE; min-height:30px; margin-right:1px;'><a href='interview.php?page=past' class='archive' style='color:#5D0000'><h4 style='margin-bottom:10px; margin-top:10px;'>Archive</h4></a></div>
		</div>
		
		<div style="float:left; width:100%; text-align: center;">
<?php
				if ($type == "current") {
					echo "<h3>Upcoming Interviews</h3>";
				} else {
					echo "<h3>Past Interviews Interviews (1-Year)</h3>";		
				}
?>			
			<a href='interview.php'><h4>View Interviews by Job Post</h4></a>
		</div>
	</div>
<?php

	echo "<table class='dark' id='candidates' style='width:100%; margin-top:20px'>";
	echo "<thead>";
		echo "<tr>";
			echo "<th width='35%'>Candidate</th>";
			echo "<th width='35%'>Date</th>";
			echo "<th width='30%'>Status</th>";
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
				$status = "<font color='red'><b>YOU CANCELED</b></font>";			 	
			} elseif ($current_date > $row['interview_date']) {
				$status = "Past";
			} elseif ($status == "viewed") {
				$status = "Viewed<br />".date('M d, g:i A', strtotime($row['status_date']));
			} else {
				$status = "Pending";
			}
			
			echo "<tr>";
				echo "<td width='35%'>".$notice."<a href='candidate.php?ID=".$row['candidateID']."&matchID=".$row['matchID']."'>".$row['firstname']." ".$row['lastname']."</a></td>";
				echo "<td width='35%' align='center'><a href='candidate.php?ID=".$row['candidateID']."&matchID=".$row['matchID']."&page=interview'>".date('M d, g:i A', strtotime($row['interview_date']))."</a><br /><a href='job.php?ID=".$row['jobID']."'>".$row['title']."</a></td>";
				echo "<td width='30%'>".$status."</td>";	
			echo "</tr>";			
		}
	} else {
		echo "<tr><td colspan='3'>No Interviews</td></tr>";
	}
	echo "</table>";
	echo "</div>";
}


function interview_list_job_html_mobile($post_type, $job_title, $interview_list, $count, $view_expired) {	
?>
	<div class='main_box' style='margin-top:53px; width:100%;'>
	<div style="float:left; width:100%">
		<div style="float:left; width:100%">
			<h3>Scheduled Interviews for <?php echo $job_title ?></h3>
		</div>
	</div>
<?php
	
	echo "<table class='dark' id='candidates' style='width:100%; margin-top:20px'>";
		echo "<thead><tr>";
			echo "<th width='35%'>Candidate</th>";
			echo "<th width='35%'>Date</th>";
			echo "<th width='30%'>Status</th>";
		echo "</thead>";
	echo "</table>";

	if ($post_type == "bounty") {
		echo "<table class='dark' id='candidates' style='width:100%'>";
		if(count($interview_list) > 0) {		
			date_default_timezone_set('America/Los_Angeles');		
			$current_date =  date('Y-m-d');
	
			foreach($interview_list as $row) {
				//status checks
				$notice = "";
				if ($row['status'] == "employee_cancel" || $row['status'] == "view_employee_cancel") {
					$status = "<font color='red'><b>EMPLOYEE CANCELED</b></font>";
					$notice = "<font color='red'><b>!!!</b> &nbsp; &nbsp;";
				} elseif ($row['status'] == "employee_cancel" || $row['status'] == "view_employer_cancel") {
					$status = "<font color='red'><b>YOU CANCELED</b></font>";			 	
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
		echo "<h4 style='margin-left:3px'>Interview Reminders only available for Bounty Job Posts.</h4>";

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
	}
	echo "</div>";
}

function notes_list_job_html_mobile($post_type, $title, $notes_array) {
?>
	<div class='main_box' style='margin-top:55px; width:100%;'>
		<div style="float:left; width:100%; text-align:center">
			<h3 style='margin-bottom:3px'>Candidate Notes</h3>
			<h4><? echo $title ?></h4>		
		</div>
	</div>
	
	<div id='button_holder' style='float:left; width:100%; margin-right0px;'>	
<!--
		<div style="float:left; width:100%; margin-bottom:0px; text-align:center;" >
			<h4 style='text-align:center; margin-bottom:3px;'>SORT</h4>
		</div>
-->
		
		<div style='float:left; width:100%; margin-bottom:0px; text-align:center;' >
				<div style="float:left; width:15%; text-align:center; margin-left:2px; margin-top:3px;">
					SORT
				</div>
				
				<a href='interview.php?page=notes_list&ID=<? echo $_GET['ID'] ?>&sort=culture'>	
					<div style="float:left; width:24%; text-align:center; margin-left:2px; margin-right:2px; cursor:pointer;" class='btn btn-primary'>
						Fit
					</div>
				</a>

				<a href='interview.php?page=notes_list&ID=<? echo $_GET['ID'] ?>&sort=experience'>
					<div style="float:left; width:24%; text-align:center; margin-right:2px; cursor:pointer;" class='btn btn-primary'>
						Exp.
					</div>
				</a>

				<a href='interview.php?page=notes_list&ID=<? echo $_GET['ID'] ?>&sort=availability'>
					<div style="float:left; width:25%; text-align:center; cursor:pointer;" class='btn btn-primary'>
						Avail.
					</div>
				</a>
		</div>		
	</div>
	
<?php

		echo "<div id='results' style='float:left; width:100%'>";
			echo "<table class='dark' id='candidates' style='width:100%'>";
				echo "<thead><tr><th>Candidate</th><th style='text-align:center'>Fit</th><th style='text-align:center'>Exp.</th><th>Avail.</th></tr></thead>";
			echo "</table>";
		if ($post_type == "bounty") {
			echo "<table class='dark' id='candidates' style='width:100%'>";
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
									echo "<td><a href='candidate.php?ID=".$row['userID']."&matchID=".$row['matchID']."'>".$row['firstname']." ".$row['lastname']."</a><br /><a href='candidate.php?ID=".$row['userID']."&matchID=".$row['matchID']."&page=notes'>View Notes</a></td>";	
									echo "<td align='center'>".$row['culture']."</td>";
									echo "<td align='center'>".$row['experience']."</td>";
									echo "<td align='center'>".$row['availability']."</td>";
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
				echo "<h4 style='margin-left:3px'>Candidate Notes only available for Bounty Job Posts.</h4>";
		
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
			}
	echo "</div>";		
	echo "</div>";
}
?>