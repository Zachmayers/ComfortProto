<?php
function job_list_html($job_list_array, $group_list) {	

	$archive_lite = $job_list_array['archive_lite'];
	$archive = $job_list_array['archive'];
?>		
	<div class='container archive_jobs' style="min-height: 70%;">
		<div class='row' style="margin-bottom:25px">
			<div class="col-md-12 text-center">
				<h2>Job Post Archive</h2>
				<h4>Below is a record of expired jobs posts within the last year</h4>
<!-- 				<b>&#9679 If you choose 'Repost', you will be able to review and edit any openings before checking out and posting.</b> -->
 				<b>&#9679 Reposting and new job posts are current not available.</b>

			</div>
		</div>
<?php		
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
				<div class='row' style="margin-top: 45px; ">
					<div class="col-md-3 col-md-offset-2 col-xs-6 col-xs-offset-0">
						<h3 style="display:inline; margin-bottom: 0px;"><? echo $type ?></h3>
<?php
						if ($group['receiptID'] > 0) {
							echo "<br /><a href='job.php?ID=new_job&groupID=".$group['groupID']."&page=group_receipt&receiptID=".$group['receiptID']."'><b>View Receipt</b></a>";					
						} else {
							echo "<br /><i>Free Post - No Receipt</i></a>";					
							
						}
?>
					</div>
					<div class="col-md-5 col-xs-6 text-right">
						<a href='#' class='btn btn-large btn-success' >Repost Unavailable</a>
					</div>
				</div>
<?php				
				foreach ($archive as $row) {
					if ($row['job_status'] == "Open" || $row['job_status'] == "Filled") {
						if ($row['groupID'] == $group['groupID']) {	
?>
							<div class='row' style="margin-bottom: 10px">
								<div class="col-md-4 col-md-offset-2 col-xs-6 col-xs-offset-0">
									<i class="fa fa-circle-thin" aria-hidden="true"></i> <b><? echo $row['title'] ?></b>
									<br /> &nbsp; &nbsp; <? echo $row['name'] ?>
								</div>
								<div class="col-md-4 col-xs-6 text-right">								
									 Expired <? echo date('M j, Y', strtotime($row['expiration_date'])) ?>
								</div>
							</div>
<?php	
						}
					}							
				}
			}
		} else {
?>
			<div class='row'>
				<div class="col-md-2 col-md-offset-4">
					No jobs in your Archive
				</div>
			</div>
<?php
		}
?> 
	</div>
<?php
}

function job_list_html_employer_no_store() {		
?>
	<h2>You must complete your profile by adding at least one location.</h2>	
	<h4>You can manage hiring and job posts at multiple locations if necessary</h4>
<?php		
}

function job_list_html_loader() {
?>
	<div class="container" id="loader" style="display: none">
		<div class="row text-center" style="margin-top: 150px; margin-bottom: 150px;">
			<h3>LOADING...</h3>
		</div>
	</div>
<?php
}
?>