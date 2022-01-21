<?php

function job_list_html_employer_mobile($job_list_array, $group_list) {					

	$archive_lite = $job_list_array['archive_lite'];
	$archive_bounty = $job_list_array['archive_bounty'];
		
	$archive = $job_list_array['archive'];
		
	echo "<div class='archive_jobs main_box' style='float:left; width:99%; margin-left:2px;'>";	
		echo "<h3 style='text-align:center'>Job Post Archive (Past Year)</h3>";
		echo "<b>&#9679 If you choose 'Repost', you will be able to review and edit any openings before checking out and posting.</b><br /> &nbsp; <br />";

		echo "<table class='dark' style='width:100%;'>";
		
		if (count($archive) > 0 && count($group_list) > 0) {
			foreach($group_list as $group) {
				switch($group['type']) {
					case "single":
						$type = "Individual Post";
					break;
					case "FOH":
						$type = "Hiring All FOH";
					break;
					case "BOH":
						$type = "Hiring All BOH";
					break;
					case "all":
						$type = "Hiring All Positions";
					break;
				}
?>
			<tr>
				<td  colspan="2">
					<h3><? echo $type." <br />".date('M j, Y', strtotime($group['date_created'])) ?></h3>
				</td>
				<td  width="150px;" align="center">
					<a href='#'>		
						<div class='btn btn-large btn-primary repost' id='<? echo $group['groupID'] ?>' style='background-color:#8e080b;  width:50%; text-align:center;margin-right:3px;'>Repost</div>
					</a>					
				</td>
			</tr>
<?php				
			
				foreach ($archive as $row) {
						
					if ($row['job_status'] == "Open" || $row['job_status'] == "Filled") {																																													
						if ($row['groupID'] == $group['groupID']) {																																													
?>
							<tr>
								<td style="width: 10px;"> &nbsp; </td>
								<td style="width: 200px;"><b><? echo $row['title'] ?></b><br /><? echo $row['name'] ?></td>
								<td  align="center">Expired<br /><? echo date('M j, Y', strtotime($row['expiration_date'])) ?></td>
							</tr>	
<?php
						}	
					}							
				}
			}
		} else {
			echo "<tr>";
				echo "<td colspan='2'>No jobs in your Archive.</td>";
			echo "</tr>";
		} 
		echo "</table>";
	echo "</div>";
}	

function job_list_html_employer_no_store_mobile() {		

	echo "<h2>You must complete your profile by adding at least one location.</h2>";
	
	echo "<h4>You can manage hiring and job posts at multiple locations if necessary</h4>";			
}