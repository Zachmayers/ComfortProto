<?php
		

function upcoming_moments_html($upcoming_moments) {
$moment = new Moment("new");	
?>		
	<div class='container' style="margin-top:75px;">
		
		

	<div class="row" id='job_summary_holder' style="margin-top: 15px;">
		<div class="col-md-12 col-xs-12 text-center">
			<h2>Upcoming Moments</h2>
		</div>

		<div class="col-md-12 col-xs-12" >
<?php
		if (count($upcoming_moments) > 0) {
			foreach($upcoming_moments as $row) {
				$moment_details = $moment->get_standard_detail($row['moment_type']);
?>
                <div class="row " style="padding-bottom: 20px;">
	                <div class="col-12 card">
						<h2 class="block-title titlename text-center "><? echo $moment_details['moment_type'] ?></h2>
						<div class="row">
						<div class="col-6 text-center ">
							<a href="moment.php?momentID=<? echo $row['momentID'] ?>">
							<img src="/loneme_proto/images/<? echo $moment_details['image'] ?>" class="img-fluid" alt="...">
							</a>
						</div>	
						<div class="col-6">
						    <ul class="oppnotes">
<!-- 							    <li><?php echo $row['moment_type']; ?></li> -->
							    <li><?php echo date_format(new DateTime($row['moment_date']), "D M j") ?></li>
								<li><?php echo date_format(new DateTime($row['moment_time']), "g:i a") ?></li>	
								<li><? echo $row['location_name'] ?></li>
										
	                        </ul>

<!-- 	                        <a href="moment.php?momentID=<? echo $row['momentID'] ?>" class="btn btn-primary" style="background-color:#ff8c00">View Details</a> -->

						</div>
						</div>
	                </div>
				</div>
<?php
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

function past_moments_html($past_moments) {
	$moment = new Moment("new");
?>
	<div class='container' style="margin-top:75px;">
		
		

	<div class="row" id='job_summary_holder' style="margin-top: 15px;">
		<div class="col-md-12 col-xs-12 text-center">
			<h2>Past Moments</h2>
		</div>

		<div class="col-md-12 col-xs-12" >
<?php
		if (count($past_moments) > 0) {
			foreach($past_moments as $row) {
				$moment_details = $moment->get_standard_detail($row['moment_type']);
?>
                <div class="row " style="padding-bottom: 20px;">
						<h2 class="block-title titlename text-center "><? echo $moment_details['moment_type'] ?></h2>
						<div class="col-6 text-center ">
							<img src="/loneme_proto/images/<? echo $moment_details['image'] ?>" class="img-fluid" alt="...">
						</div>							
						<div class="col-6">
						    <ul class="oppnotes">
<!-- 							    <li><?php echo $row['moment_type']; ?></li> -->
							    <li><?php echo date_format(new DateTime($row['moment_date']), "D M j") ?></li>
								<li><?php echo date_format(new DateTime($row['moment_time']), "g:i a") ?></li>	
								<li><? echo $row['address'] ?></li>
										
	                        </ul>
	                        <a href="moment.php?momentID=<? echo $row['momentID'] ?>" class="btn btn-primary" style="background-color:#ff8c00">View Details</a>

						</div>
				</div>
<?php
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

function available_moments_html($available_moments) {
	$moment = new Moment("new");	

?>
	<div class='container' style="margin-top:75px;">
		
		

	<div class="row" id='job_summary_holder' style="margin-top: 15px;">
		<div class="col-md-12 col-xs-12 text-center">
			<h2>Available Moments</h2>
		</div>

		<div class="col-md-12 col-xs-12" >
<?php
		if (count($available_moments) > 0) {
			foreach($available_moments as $row) {
				$moment_details = $moment->get_standard_detail($row['moment_type']);
?>
                <div class="row " style="padding-bottom: 20px;">
						<h2 class="block-title titlename text-center "><? echo $moment_details['moment_type'] ?></h2>
						<div class="col-6 text-center ">
							<img src="/loneme_proto/images/<? echo $moment_details['image'] ?>" class="img-fluid" alt="...">
						</div>							
						<div class="col-6">
						    <ul class="oppnotes">
<!-- 							    <li><?php echo $row['moment_type']; ?></li> -->
							    <li><?php echo date_format(new DateTime($row['moment_date']), "D M j") ?></li>
								<li><?php echo date_format(new DateTime($row['moment_time']), "g:i a") ?></li>	
								<li><? echo $row['address'] ?></li>
										
	                        </ul>
	                        <a href="moment.php?momentID=<? echo $row['momentID'] ?>" class="btn btn-primary" style="background-color:#ff8c00">View Details</a>

						</div>
				</div>
<?php
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