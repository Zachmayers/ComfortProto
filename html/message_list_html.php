<?php
		

function latest_messages_html($current_messages, $moment_current_array, $unchecked_messages, $moment_unchecked_array) {
$moment = new Moment("new");	
?>		
	<div class='container' style="margin-top:75px;">
		
		

	<div class="row" id='job_summary_holder' style="margin-top: 15px;">
		<div class="col-md-12 col-xs-12 text-center">
			<h2>Unchecked Messages</h2>
		</div>

		<div class="col-md-12 col-xs-12" >
<?php
		if (count($unchecked_messages) > 0) {
			foreach($moment_unchecked_array as $moment) {
				foreach($unchecked_messages as $row) {
	//				$moment_details = $moment->get_standard_detail($row['moment_type']);
					if ($row['momentID'] == $moment) {
	?>
		                <div class="row " style="padding-bottom: 20px;">
	<!--
								<h2 class="block-title titlename text-center "><? echo $moment_details['moment_type'] ?></h2>
								<h3 class="block-title titlename text-center "><? echo $row['location_name'] ?></h2>
	-->
								<div class="col-12 text-center ">
									<? echo $row['message'] ?>
									<a href="message.php?momentID=<? echo $row['momentID'] ?>">
										View Message Thread
									</a>
								</div>							
						</div>
	<?php
					}
				}	
			}			
		} else {
			echo "None";
		}
?>
			</div>
		</div>
		

		</div>
		

	<div class="row" id='job_summary_holder' style="margin-top: 15px;">
		<div class="col-md-12 col-xs-12 text-center">
			<h2>Current Messages</h2>
		</div>

		<div class="col-md-12 col-xs-12" >
<?php
		if (count($current_messages) > 0) {
			foreach($moment_unchecked_array as $moment) {
				foreach($current_messages as $row) {
	//				$moment_details = $moment->get_standard_detail($row['moment_type']);
					if ($row['momentID'] == $moment) {
	?>
		                <div class="row " style="padding-bottom: 20px;">
	<!--
								<h2 class="block-title titlename text-center "><? echo $moment_details['moment_type'] ?></h2>
								<h3 class="block-title titlename text-center "><? echo $row['location_name'] ?></h2>
	-->
								<div class="col-12 text-center ">
									<? echo $row['message'] ?>
									<a href="message.php?momentID=<? echo $row['momentID'] ?>">
										View Message Thread
									</a>
								</div>							
						</div>
	<?php
					}
				}	
			}			
		} else {
			echo "None";
		}
?>
			</div>
		</div>
		

		</div>
	</div>
	
	 &nbsp; <br />

	
	<div class="row">
		<div class="col-md-12 no-line text-center">			
		</div>
	</div> &nbsp; <br />
	
<?php
}		
				
?>