<?php
function select_moment_type_html($moment_types) {
?>
	<div class='container'>
				
		<div class='row' style="margin-bottom:12px; padding-top:75px;">
			<h2 style="text-align:center; margin-bottom:0px;">Select Moment Type</h2>
		</div>
<?
		$row_counter = 1;
		$total_count = 1;
		foreach($moment_types as $row) {
			if ($row_counter == 1) {
				echo "<div class='row'>";			
			}
				echo "<div class = 'col-4'>";
				echo "<figure class='figure'>";
				echo	"<a href='create_moment.php?momentID=".$row['ID']."'><img src='/loneme_proto/images/".$row['image']."' class='img-fluid' alt='...'></a>";
				echo "<figcaption class='figure-caption'>".$row['moment_type']."</figcaption>";
				echo "</div>";
			if ($row_counter == 3 || $total_count == count($moment_types)) {
				echo "</div>";
				$row_counter = 1;
			} else {
				$row_counter++;
				$total_count++;
			}
		}
?>			
		</div>
		
			
<?php		
}
	
function create_moment_html_new_form() {
	//get moment types
	//echo var_dump($moment_details);
?>
	<div class='container' id="step_one">
				
		<div class='row' style="margin-bottom:12px; padding-top:75px;">
			<h2 style="text-align:center; margin-bottom:0px;">Step 1 Location</h2>

		<div class=" job_details" id='general_holder' style="font-size:16px;">

			<div class="form-horizontal">
		   		<label for="new_location" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Place Name</label>
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='text' class='new_location form-control' id="pac-input" placeholder='Required'><br />
					</div>
				   	
			   		<label for="address" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Street Address</label>
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='text' class='address form-control' id="address"  value="" placeholder='Required'><br />
					</div>
					
			   		<label for="zip" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Zip Code</label>
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='text' class='zip form-control' id="zip" value="" placeholder='Required'><br />
					</div>	
								
					<label for="zip" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">City</label>
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='text' class='city form-control' id="city" value="" placeholder='Required'><br />
					</div>				

					<label for="zip" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">State</label>
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='text' class='state form-control' id="state" value="" placeholder='Required'><br />
					</div>		
					
				<div class="row">
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<a href='#' class='next' id="one_next">
							<div class='button'><i class="fa fa-thumb-tack" aria-hidden="true"></i> NEXT</div>
						</a>
					</div>
				</div>
		

			</div>
		</div>
		</div>
	</div>
	<div class='container' id="step_two" style='display:none'>

		<div class='row' style="margin-bottom:12px; padding-top:75px;">
			<h2 style="text-align:center; margin-bottom:0px;">Step 2 Date & Time</h2>

			<div class=" job_details" id='general_holder' style="font-size:16px;">

					<div class="form-horizontal">
						<div class="form-group" id="edit_date_time" style="margin-bottom:3px">
						   	<label for="date_time" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label"><i class="fa fa-circle-thin" aria-hidden="true" style="background-color: transparent"></i> Date</label>
					   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
								<input type='date' class='date_time form-control' id="date" placeholder='Required' min="<?= date('Y-m-d') ?>"><br />
							</div>
						   	<label for="time" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label"><i class="fa fa-circle-thin" aria-hidden="true" style="background-color: transparent"></i> Time</label>
					   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
								<input type='time' class='time form-control' id="time" placeholder='Required'><br />
							</div>
						</div>
					</div>
				</div>
		
				<div class="row">
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<a href='#' class='back' id="two_back">
							<div class='button'><i class="fa fa-thumb-tack" aria-hidden="true"></i> BACK</div>
						</a>
				   		
						<a href='#' class='next' id="two_next">
							<div class='button'><i class="fa fa-thumb-tack" aria-hidden="true"></i> NEXT</div>
						</a>
					</div>
				</div>
		
		
		</div>
	</div>

	<div class='container' id="step_three" style='display:none'>

		<div class='row' style="margin-bottom:12px; padding-top:75px;">
			<h2 style="text-align:center; margin-bottom:0px;">Step 3 Description</h2>

		<div class=" job_details" id='general_holder' style="font-size:16px;">

			<div class="form-horizontal">
				<div class="form-group" id="edit_description" style="margin-bottom:3px">
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
					   	<div class="col-md-12" id='charNum_description' style="color:red; margin-bottom:2px;"></div> <!-- //Holder for character counter -->
						<textarea class="form-control" id="description"  placeholder="Place any additional information here" maxlength='750'></textarea><br />
					</div>
				</div>
				
			</div>

				<div class="row">
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<a href='#' class='back' id="three_back">
							<div class='button'><i class="fa fa-thumb-tack" aria-hidden="true"></i> BACK</div>
						</a>
				   		
						<a href='#' class='next' id="three_next">
							<div class='button'><i class="fa fa-thumb-tack" aria-hidden="true"></i> NEXT</div>
						</a>
					</div>
				</div>

		</div>	
	</div>
	</div>
	<div class='container' id="step_four" style='display:none'>

		<div class='row' style="margin-bottom:12px; padding-top:75px;">
			<h2 style="text-align:center; margin-bottom:0px;">Final Step - Review</h2>

		<div class=" job_details" id='general_holder' style="font-size:16px;">
			<div id="location_name"></div>
			<div id="location_address"></div>
			<div id="review_date"></div>
			<div id="review_time"></div>
			<div id="review_description"></div>
			
			<input type='hidden' class='event' id="event"  value="<? echo $_GET['momentID'] ?>"><br />


				<div class="row">
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<a href='#' class='back' id="four_back">
							<div class='button'><i class="fa fa-thumb-tack" aria-hidden="true"></i> BACK</div>
						</a>
				   		
						<a href='#' class='book'>
							<div class='button'><i class="fa fa-thumb-tack" aria-hidden="true"></i> Book Moment!</div>
						</a>
					</div>
				</div>
		</div>	
	</div>
		

	</div>
	
		<div class=" job_details " id='confirmation_holder' style="font-size:16px; margin-top:50px; text-align:center; display:none">
			Your Moment Has Been Submitted<br />
			We are matching you with an available Human <br />
			You will be notified with details of how to check-in to your moment as soon as there is a match<br />
			<br />
			<a href='main.php'>Back</a>
		</div>

</div>
		
<?php
	//	}
}	

function view_moment_provider($moment_details, $provider_status, $check, $pass_code, $chat, $standard_details) {
?>
    <div id="content" style="min-height: 70%; margin-top:75px">

    <!-- Profile block -->
    	<div class="" >
                <div class="row ">
				     <h2 class="block-title titlename text-center "><? echo $standard_details['moment_type'] ?></h2>
						<div class="col-6 text-center ">
							<img src="/loneme_proto/images/<? echo $standard_details['image'] ?>" class="img-fluid" alt="...">
						</div>							
						<div class="col-6">
						    <ul class="oppnotes">
							    <li><?php echo date_format(new DateTime($moment_details['moment_date']), "D M j") ?></li>
								<li><?php echo date_format(new DateTime($moment_details['moment_time']), "g:i a") ?></li>
								<li><? echo $moment_details['address']." ".$moment_details['city']." ".$moment_details['state'].", ".$moment_details['zip'] ?></li>
	                        </ul>
						</div>
				</div>
				<div class="row justify-content-center" style="margin-bottom:25px;">
					<div class="col-10">
						<b>Moment Details:</b> <? echo $moment_details['description'] ?>
					</div>
				</div>				
				<div class="text-center row ">	
						<div class="col-md-12 col-xs-12 map ">							
							<div class="opportunitymap embed-container " style="position:relative; padding-bottom:75%; height:0; overflow:hidden">
								<iframe
								  width="600"
								  height="450"
								  style="border:0; position:absolute; top:0; left:0; width:100% !important; height:100% !important"
								  loading="lazy"
								  allowfullscreen
								  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyChqlrKggbgsBdhXpA6GnSorZq7ueMSrHs
								    &q=<? echo $moment_details['address']."+".$moment_details['city']."+".$moment_details['state']."+".$moment_details['zip'] ?>">
								</iframe>
		                    </div>
						</div>   
	 			 <div class="col-12 messages" style="display:none; background-color: #D3D3D3">
<?php	
//					if ($provider_status == "accepted") {
						echo "<h3>Messages</h3>";
						echo "<div id='chat_box'>";
						if (count($chat) > 0) {
							foreach ($chat as $row) {
								if ($row['senderID'] == $_SESSION['userID']) {
								} else {
								}
								echo "<div class='col-10'>";
								echo $row['message']."<br />".$row['date_created']."<br /> &nbsp; <br />";
								echo "</div>";
						}
					}
					echo "</div>";

?>
							<div class="form-horizontal">
								<div class="form-group" id="edit_description" style="margin-bottom:3px">
							   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
									   	<div class="col-md-12" id='charNum_description' style="color:red; margin-bottom:2px;"></div> <!-- //Holder for character counter -->
										<textarea class="form-control" id="message"  placeholder="Message" maxlength='750'></textarea><br />
									</div>
										<a href='#' class='send_message'>
											<button type='button' class='button' >Send Message</button>
										</a>
								</div>
							</div>

                    </div></div></div>
		                    
		
						</div>
                    </div>
    			</div>
    			<div class="row " style="margin-top:15px;">
    			</div>
     			<div class="row ">
     			</div>
     			
	 			 <div class="row text-center ">
	 			 	<div class="col-12 text-center">
						<h3>Status</h3>
<?php
					if ($provider_status == "accepted") {
						if (is_null($check['provider_checkin'])) {
							echo "<a href='#' class='checkin'><button type='button' class='button'>Check In</button></a><br />";
						} else {
							echo "YOU HAVE CHECKED IN<br />";
							if (is_null($check['client_checkin'])) {
								echo "<i>Waiting on your client</i><br />";
							} else {
								echo "YOUR CLIENT IS HERE!<br />";
								echo "The Pass Phrase is: ".$check['pass_code']."<br />";
?>
								            <a href='#' class='checkout'>
								                <button type='button' class='button'>
								                    End & Rate Moment
								            </button></a>
<?php

							}
?>
								<a href='message.php?momentID=<? echo $_GET['momentID'] ?>'>
					                    <button type='button' class='button'>
					                        Message Client
					                    </button>
								</a>
<?php
						}
						
					} else {
							echo "<a href='#' class='accept'><button type='button' class='button'>Accept Moment</button></a><br />";						
					}
?>						
	 			 	</div>
	 			 </div>
    </div>
</div>

<?php
				if ($provider_status == "accepted") {
	}
?>
&nbsp;<br />
&nbsp;<br />
<?php
}

function view_moment_client($moment_details, $provider_status, $check, $pass_code, $chat, $standard_details){
?>
    <div id="content" style="min-height: 70%; margin-top:75px">

    <!-- Profile block -->
    	<div class="" >
                <div class="row ">
				     <h2 class="block-title titlename text-center "><? echo $standard_details['moment_type'] ?></h2>
						<div class="col-6 text-center ">
							<img src="/loneme_proto/images/<? echo $standard_details['image'] ?>" class="img-fluid" alt="...">
						</div>							
						<div class="col-6">
						    <ul class="oppnotes">
							    <li><?php echo date_format(new DateTime($moment_details['moment_date']), "D M j") ?></li>
								<li><?php echo date_format(new DateTime($moment_details['moment_time']), "g:i a") ?></li>
								<li><? echo $moment_details['address']." ".$moment_details['city']." ".$moment_details['state'].", ".$moment_details['zip'] ?></li>
	                        </ul>
						</div>
				</div>
				<div class="row justify-content-center" style="margin-bottom:25px;">
					<div class="col-10">
						<b>Moment Details:</b> <? echo $moment_details['description'] ?>
					</div>
				</div>				
				<div class="text-center row ">	
						<div class="col-md-12 col-xs-12 map ">							
							<div class="opportunitymap embed-container " style="position:relative; padding-bottom:75%; height:0; overflow:hidden">
								<iframe
								  width="600"
								  height="450"
								  style="border:0; position:absolute; top:0; left:0; width:100% !important; height:100% !important"
								  loading="lazy"
								  allowfullscreen
								  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyChqlrKggbgsBdhXpA6GnSorZq7ueMSrHs
								    &q=<? echo $moment_details['address']."+".$moment_details['city']."+".$moment_details['state']."+".$moment_details['zip'] ?>">
								</iframe>
		                    </div>
						</div>   
	 			 <div class="col-12 messages" style="display:none; background-color: #D3D3D3">
<?php	
//					if ($provider_status == "accepted") {
						echo "<h3>Messages</h3>";
						echo "<div id='chat_box'>";
						if (count($chat) > 0) {
							foreach ($chat as $row) {
								if ($row['senderID'] == $_SESSION['userID']) {
								} else {
								}
								echo "<div class='col-10'>";
								echo $row['message']."<br />".$row['date_created']."<br /> &nbsp; <br />";
								echo "</div>";
						}
					
					}
						echo "</div>";
					
?>
							<div class="form-horizontal">
								<div class="form-group" id="edit_description" style="margin-bottom:3px">
							   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
									   	<div class="col-md-12" id='charNum_description' style="color:red; margin-bottom:2px;"></div> <!-- //Holder for character counter -->
										<textarea class="form-control" id="message"  placeholder="Message" maxlength='750'></textarea><br />
									</div>
										<a href='#' class='send_message'>
											<button type='button' class='btn btn-primary' >Send Message</button>
										</a>
								</div>
							</div>


                    </div></div></div>
		                    
		
						</div>
                    </div>
    			</div>
    			<div class="row " style="margin-top:15px;">
    			</div>
     			<div class="row ">
     			</div>
     			
	 			 <div class="row text-center ">
	 			 	<div class="col-12 text-center">
						<h3>Status</h3>
<?php
					if ($provider_status == "accepted") {
						if (is_null($check['client_checkin'])) {
							echo "<a href='#' class='checkin'><button type='button' class='button'>Check In</button></a><br />";
						} else {
							echo "YOU HAVE CHECKED IN<br />";
							if (is_null($check['provider_checkin'])) {
								echo "<i>Waiting on your human</i><br />";
							} else {
								echo "YOUR HUMAN IS HERE!<br />";
								echo "The Pass Phrase is: ".$check['pass_code']."<br />";
?>
								            <a href='#' class='checkout'>
								                <button type='button' class='button'>
								                    End & Rate Moment
								            </button></a>
<?php

							}
?>
								<a href='message.php?momentID=<? echo $_GET['momentID'] ?>'>
					                    <button type='button' class='button'>
					                        Message Human
					                    </button>
								</a>
<?php
						}
					} else {
						 echo "Still connecting you with a Human<br /> &nbsp; <br />";
					}	
?>						
	 			 	</div>
	 			 </div>
    </div>
</div>
&nbsp;<br />
&nbsp;<br />
<?php
}

function view_rating_client($moment_details, $check, $standard_details){
?>
    <div id="content" style="min-height: 70%; margin-top:75px">

    <!-- Profile block -->
    	<div class="" >
                <div class="row ">
				     <h2 class="block-title titlename text-center "><? echo $standard_details['moment_type'] ?></h2>
						<div class="col-6 text-center ">
							<img src="/loneme_proto/images/<? echo $standard_details['image'] ?>" class="img-fluid" alt="...">
						</div>							
						<div class="col-6">
						    <ul class="oppnotes">
							    <li><?php echo date_format(new DateTime($moment_details['moment_date']), "D M j") ?></li>
								<li><?php echo date_format(new DateTime($moment_details['moment_time']), "g:i a") ?></li>
								<li><? echo $moment_details['address']." ".$moment_details['city']." ".$moment_details['state'].", ".$moment_details['zip'] ?></li>
	                        </ul>
						</div>
				</div>
				<div class="row justify-content-center" style="margin-bottom:25px;">
					<div class="col-10">
						<b>Moment Details:</b> <? echo $moment_details['description'] ?>
					</div>
				</div>				
				<div class="text-center row ">	
						<div class="col-md-12 col-xs-12 ">							
							<h2>MOMENT COMPLETED</h2>
<?php
							if (is_null($check['client_moment_rating'])) {
?>
							<h5>Please rate your experience</h5>
								<div class="form-horizontal">
									<div class="form-group" id="edit_type" style="margin-bottom:3px">
									   	<label for="rating" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label"><i class="fa fa-circle-thin" aria-hidden="true" style="background-color: transparent"></i> Rating</label>
								   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
									   		<select id='rating' class="form-control rating">
												<option value='1'>1</option>
												<option value='2'>2</option>
												<option value='3'>3</option>
												<option value='4'>4</option>
												<option value='5'>5</option>
											</select><br />	
										</div>
									</div>
								</div>
								
								<div class="form-horizontal">
									<div class="form-group" id="rating_notes" style="margin-bottom:3px">
								   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
										   	<div class="col-md-12" id='charNum_description' style="color:red; margin-bottom:2px;"></div> <!-- //Holder for character counter -->
											<textarea class="form-control notes" id="notes"  placeholder="Place any comments here" maxlength='750'></textarea><br />
										</div>
									</div>
								</div>

								<div class="row">
							   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
										<a href='#' class='rate'>
											<div class='button'><i class="fa fa-thumb-tack" aria-hidden="true"></i> Submit Rating</div>
										</a>
									</div>
								</div>								
<?								
							} else {
?>
							<h5>You rated this moment: <? echo $check['client_moment_rating'] ?></h5>
							Notes: <? echo $check['client_notes'] ?>
<?php								
							}
?>
						</div>   
				</div>


    			<div class="row " style="margin-top:15px;">
    			</div>
     			<div class="row ">
     			</div>
     			
&nbsp;<br />
&nbsp;<br />
<?php
}

function view_rating_provider($moment_details, $check, $standard_details){
?>
    <div id="content" style="min-height: 70%; margin-top:75px">

    <!-- Profile block -->
    	<div class="" >
                <div class="row ">
				     <h2 class="block-title titlename text-center "><? echo $standard_details['moment_type'] ?></h2>
						<div class="col-6 text-center ">
							<img src="/loneme_proto/images/<? echo $standard_details['image'] ?>" class="img-fluid" alt="...">
						</div>							
						<div class="col-6">
						    <ul class="oppnotes">
							    <li><?php echo date_format(new DateTime($moment_details['moment_date']), "D M j") ?></li>
								<li><?php echo date_format(new DateTime($moment_details['moment_time']), "g:i a") ?></li>
								<li><? echo $moment_details['address']." ".$moment_details['city']." ".$moment_details['state'].", ".$moment_details['zip'] ?></li>
	                        </ul>
						</div>
				</div>
				<div class="row justify-content-center" style="margin-bottom:25px;">
					<div class="col-10">
						<b>Moment Details:</b> <? echo $moment_details['description'] ?>
					</div>
				</div>				
				<div class="text-center row ">	
						<div class="col-md-12 col-xs-12 ">							
							<h2>MOMENT COMPLETED</h2>
<?php
							if (is_null($check['provider_moment_rating'])) {
?>
							<h5>Please rate your experience</h5>
								<div class="form-horizontal">
									<div class="form-group" id="edit_type" style="margin-bottom:3px">
									   	<label for="rating" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label"><i class="fa fa-circle-thin" aria-hidden="true" style="background-color: transparent"></i> Rating</label>
								   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
									   		<select id='rating' class="form-control rating">
												<option value='1'>1</option>
												<option value='2'>2</option>
												<option value='3'>3</option>
												<option value='4'>4</option>
												<option value='5'>5</option>
											</select><br />	
										</div>
									</div>
								</div>
								
								<div class="form-horizontal">
									<div class="form-group" id="rating_notes" style="margin-bottom:3px">
								   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
										   	<div class="col-md-12" id='charNum_description' style="color:red; margin-bottom:2px;"></div> <!-- //Holder for character counter -->
											<textarea class="form-control notes" id="notes"  placeholder="Place any comments here" maxlength='750'></textarea><br />
										</div>
									</div>
								</div>

								<div class="row">
							   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
										<a href='#' class='rate'>
											<div class='button'><i class="fa fa-thumb-tack" aria-hidden="true"></i> Submit Rating</div>
										</a>
									</div>
								</div>								
<?								
							} else {
?>
							<h5>You rated this moment: <? echo $check['provider_moment_rating'] ?></h5>
							Notes: <? echo $check['provider_notes'] ?>
<?php								
							}
?>
						</div>   
				</div>


    			<div class="row " style="margin-top:15px;">
    			</div>
     			<div class="row ">
     			</div>
     			
&nbsp;<br />
&nbsp;<br />
<?php
}

function view_moment_provider_old($moment_details, $provider_status, $check_status, $pass_code, $chat) {
	?>
    <div id="content" style="min-height: 70%">

    <!-- Profile block -->
    	<div class="block-contained" >
            <div class="col-md-4 job_details_large">
                <div class="text-center">
				     <h2 class="block-title titlename">Title Holder</h2>
					    <ul class="oppnotes">
                            <li><? echo $moment_details['moment_type'] ?></li>
							<li><i class="fa fa-map-marker" aria-hidden="true"></i> <? echo $moment_details['address']." ".$moment_details['city']." ".$moment_details['state'].", ".$moment_details['zip'] ?></li>
                        </ul>
                    <div class="row panel-opportunity-photo">
<!--
						<div class="col-md-12 col-xs-6">
							IMAGE HOLDR
						</div>
						<div class="col-md-12 col-xs-6 ">
							<div class="opportunitymap embed-container ">
							<iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDb95KTBjE8mIPl_bvDMxs1vvLkyLhAiXs	&q=<? echo $google_address ?>" width="300" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
		                    </div>
							
                      		<div class="portfoliophotos">
                          		<img src="images/opportunity-photo01.jpg">
						  		<img src="images/opportunity-photo02.jpg">
						  		<img src="images/opportunity-photo03.jpg">
						  		<img src="images/opportunity-photo04.jpg">
                        	</div>
						</div>
                    </div>
					<div class="opportunitymap embed-container hidden-xs">
						<iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDb95KTBjE8mIPl_bvDMxs1vvLkyLhAiXs	&q=<? echo $google_address ?>" width="300" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
-->
                </div>


            <div class="col-md-8 job_details">
                <div class="row pastwrap">
                    <div class="col-md-12">
						<div class="row">

                        </div>
                        <div class="row">
                            <div class="col-xs-6">Date & Time:</div>
                            <div class="col-xs-6"><? echo date('M j, Y', strtotime($moment_details['moment_date'])) ?></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">Approx. Length:</div>
                            <div class="col-xs-6">3 Hrs</div>
                        </div>
                <div class="row extrainfo">
                    <div class="col-md-12">
	                        <h4>Other Details</h4> <? echo $moment_details['description'] ?>
                    </div>
                </div>
<?php
		if ($provider_status == "accepted") {
			if (is_null($check_status['provider_checkin'])) {
				echo "<a href='#' class='checkin'>CHECKIN</a><br />";
			} else {
				echo "YOU ARE CHECKED IN<br />";
				echo "PASSCODE: ".$check_status['pass_code']."<br />";
				//echo "<a href='#' class='show_message'>SEND MESSAGE</a><br />";
			
			}	
				if (is_null($check_status['client_checkin'])) {
					echo "CLIENT HAS NOT CHECKED IN<br />";
				} else {
					echo "CLIENT HAS CHECKED IN<br />";
					if (!is_null($check_status['provider_checkin'])) {
						echo "<a href='#' class='checkout'>CHECKOUT</a><br />";
					}
			}
			
			if (count($chat) > 0) {
				echo "<h5>Messages</h5>";
				foreach ($chat as $row) {
					echo $row['date_created']." : ".$row['message']."<br /> &nbsp; <br />";
				}
			}
			
?>
                <div class="row extrainfo message_row">
                    <div class="col-md-12">
	                        <input type="text" class="message" id="message">
	                        <a href='#' class='send_message'>Send</a>
	                        
                    </div>
                </div>

<?php				

		} else {
				echo "<a href='#' class='accept' id='".$_GET['momentID']."'>ACCEPT MOMENT</a>";
		}
?>	
                    </div></div></div>
                    </div>
            </div>
</div>
<?php
	
}


	

