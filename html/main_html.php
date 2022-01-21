<?php
		

function main_html_provider($upcoming_moments, $messages) {
	
$moment = new Moment("new");
?>		
	<div class='container' style="margin-top:75px;">
		<div class="row">
			<div class="col-md-6">
				<h2 style="margin-bottom: 0px">Welcome</h3>
			</div>		
			<div class="col-md-offset-2 col-md-4 col-sm-offset-2 col-sm-4 col-xs-offset-0 col-xs-12" style="margin-top: 20px;">	
				<div class="row">
					<div class="col-md-12 no-line">		
					</div>
				</div>
				<div class="row" style="margin-top: 5px">
					<div class="col-md-12 no-line">			
<?
					if (count($messages) == 0) {
						echo "<div class='col-12 text-center'>You have no new messages</div>";
					} else {
						echo "<div class='col-12 text-center'>You have new messages</div>";
					}
?>						
					</div>
				</div>
			</div>
		</div>
		
	<div class="row" id='job_summary_holder' style="margin-top: 15px;">
		<div class="col-md-12 col-xs-12 text-center">
			<h2>Todays Moments</h2>
		</div>

		<div class="col-md-12 col-xs-12" >
<?php
		if (count($upcoming_moments) > 0) {
			foreach($upcoming_moments as $row) {
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
	                        <a href="moment.php?momentID=<? echo $row['momentID'] ?>" class="button" >View Details</a>

						</div>
				</div>
<?php
		}				
		} else {
			echo "<div class='col-12 text-center'>None</div>";
		}
?>
			</div>
		</div>
		
		<div class="col-md-12 col-xs-12 text-center" style="margin-top: 25px">
				<div class="row">
					<div class="col-md-12 text-center">			
						<a href='moment_list.php?type=available'>		
							<div class='button'>View Opportunities</div>
						</a>
					</div>
				</div>
				
		<div class="col-md-12 col-xs-12 text-center" style="margin-top: 25px">
				<div class="row">
					<div class="col-md-12 text-center">			
						<a href='moment_list.php?type=upcoming'>		
							<div class='button' >Upcoming Moments</div>
						</a>
					</div>
				</div>
		</div>
				
				
				<div class="row">
					<div class="col-md-12 text-center">			
						<a href='moment_list.php?type=past'>		
							<div class='button' >Past Moments</div>
						</a>
					</div>
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

function main_html_client($upcoming_moments, $messages, $moment_types) {
$moment = new Moment("new");	

?>		
	<div class='container' >
		<div class="row" style="padding-top:75px;">
			<div class="col-md-12 text-center">
				<h2 style="margin-bottom: 0px">Welcome</h3>
			</div>	
		
				
			<div class="col-md-12" style="margin-top: 20px;">	
				<div class="row">
					<div class="col-md-12 text-center">
						<h3>Book a Moment</h3>			
						
<?
		$row_counter = 1;
		$total_count = 1;
		foreach($moment_types as $row) {
			if ($row_counter == 1) {
				echo "<div class='row'>";			
			}
				echo "<div class = 'col-4 card'>";
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

					
					</div>
				</div>
			</div>
		</div>
		
	<div class="row d-flex justify-content-center" id='job_summary_holder' style="margin-top: 15px;">
		<div class="col-md-12 col-xs-12 text-center">
			<h2>Today's Moments</h2>
		</div>


		<div class="col-md-12 col-xs-12 text-center" style="margin-top: 25px">
<?php

		if (count($upcoming_moments) > 0) {
			foreach($upcoming_moments as $row) {
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
	                        <a href="moment.php?momentID=<? echo $row['momentID'] ?>" class="button" >View Details</a>

						</div>
				</div>
			
<?php				
			}
		} else {
			echo "<div class='col-12 text-center'>None</div>";
		}
?>
				</div>
			</div>
		</div>
		
		<div class="col-md-12 col-xs-12 text-center" style="margin-top: 25px">
				<div class="row">
					<div class="col-md-12 text-center">			
						<a href='moment_list.php?type=upcoming'>		
							<div class='button' >Upcoming Moments</div>
						</a>
					</div>
				</div>
		</div>
		
		
		<div class="col-md-12 col-xs-12 text-center" style="margin-top: 25px">
				<div class="row">
					<div class="col-md-12 text-center">			
						<a href='moment_list.php?type=past'>		
							<div class='button'>Past Moments</div>
						</a>
					</div>
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

	


	
function password_change_html() {
?>
		<div style='float:left; width:600px; margin-top:10px; margin-bottom:15px; ' >
			<table class="dark" style='width:100%'>
				<tr>
					<th style='font-size:20px'>CHANGE PASSWORD</th>
				</tr>	
			</table>
		</div>

		<div id="change_password_form" style='float:left; margin-left:10px; width:600px; margin-top:5px; color:#760006'>
				<div id="new_pass_warning" style="display:none; color:red;">
					<b>Your new passwords don't match.</b> <br />
				</div>
				<div id="old_pass_warning" style="display:none; color:red;">
					<b>Your old password is incorrect. </b><br />
				</div>
				<div id="pass_length_warning" style="display:none; color:red;">
					<b>Your new password must be between 6 and 12 characters.</b><br />
				</div>
				
				<table style='margin-top:10px'>
					<tr>
						<td><b>Old Password:</b></td>
						<td><input type="password" id="old_pass"></td>
					</tr>
					<tr>
						<td><b>New Password:</b></td>
						<td><input type="password" id="new_pass1"></td>
					</tr>
					<tr>
						<td><b>Re-type New Password:</b></td>
						<td><input type="password" id="new_pass2"></td>
					</tr>	
				</table>
			
			<div style='float:left; margin-top:10px; width:100%'><a href='#' class='btn btn-large btn-primary' id="change_password">Change Password</a></div>					
			
		</div>

		<div id="pass_loader" style="display:none">
				&nbsp; <br />
				<h4>Updating...</h4>
		</div>
			
		<div id="pass_change_sucess" style="display:none">
				&nbsp; <br />
				<h4>Password successfully changed.</h4>
		</div>
<?php		
}
	



	




		
function email_verification_html($email_verification,$email, $creation_date) {
?>
	<div class='container' style="min-height: 70%">
		<div class="row">
			<div class="col-md-12 text-center" style="margin-top: 15px;">
				<h4>Verification Email</h4>
			</div>
		</div>						

<?php
			if ($email_verification == 'Y') {
?>
				<div class="row">
					<div class="col-md-offset-2 col-md-10">
						You've already verified your email address.  There's nothing else you need to do to continue using the site.
					</div>
				</div>
<?php
			} else {	
?>
				<div class="row">
					<div class="col-md-12 text-center">
						<h5>An email was to sent to <b><? echo $email ?></b> on <? echo date("D, d M Y", strtotime($creation_date)) ?></h4>
					</div>

					<div class="col-md-12 text-center">
<?php
					if ($_SESSION['type'] == 'employee') {
?>
						<i>You will be unable to apply to jobs until you click the verification link included in your introductory email.</i><br />
<?php
					} else {
?>
						<i>You will need to click the link provided in the verification email before you can finalize a job post.</i><br />				
<?php
					}
?>
					</div>
				</div>	
				
				
<!-- 	hidden input for JS -->
				<input type='hidden' id='email' value='<? echo $email ?>'>
<!-- 	end hidden input for JS -->
				
				<div class="row" style="margin-bottom: 30px; margin-top: 15px;">
					<div class="col-md-12 text-center" id='email_links'>
						<a href='#' class='btn btn-large btn-primary' id='resend_verification'>RESEND VERIFICATION TO ABOVE EMAIL</a><br />			  
						&nbsp; <br />
						<a href='#' class='btn btn-large btn-primary' id='change_email_button'>CHANGE EMAIL ADDRESS</a><br />
					</div>				
				</div>
	
<!-- 	HIdden div for email change, controlled by main.js -->			
				<div class="" id='email_change_holder' style="display:none;">
					<div class="col-md-12 col-xs-12 text-center" style="margin-bottom: 15px;">
						<h3>Change Email Address</h3>
						
						<h4 style="margin-bottom:0px;"><? echo $email ?></h4>
					</div>

					<div class='row input name_input'>
						<div class='error col-md-10 col-md-offset-2 col-xs-10 col-xs-offset-2' id='employer_empty_warning' style="display:none; width:100%; text-align:center; color:red"><b>NOTICE: Please complete required fields</b></div>
						<div class='error col-md-10 col-md-offset-2 col-xs-10 col-xs-offset-2' id='employer_duplicate_warning' style="display:none; width:100%; text-align:center; color:red"><b>NOTICE: Email already being used</b></div>
						<div class='error col-md-10 col-md-offset-2 col-xs-10 col-xs-offset-2' id='employer_email_warning' style="display:none; width:100%; text-align:center; color:red"><b>NOTICE: Invalid email address</b></div>
						<div class='error col-md-10 col-md-offset-2 col-xs-10 col-xs-offset-2'  id='general_warning' style="display:none; width:100%; text-align:center; color:red"><b>NOTICE: Something went wrong, please try again later</b></div>

						<form class="form-horizontal">
							<div class="form-group email_form">
						   		<label for="edit_email" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Email Address</label>
						   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
							   		<input type='text' class='edit_email form-control'  placeholder='New Email Address' id='new_email'>   
								</div>
							</div>
						</form>
			
						<div class="row" style="margin-bottom:35px">
							<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
								<button type="button" class="btn btn-success" id='submit_new_email'>
									<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save
								</button>
			
								<button type="button" class="btn btn-link cancel" id="wrong_email_back" style="color:#8e080b;">
									Cancel
								</button>
							</div>
						</div>
							
						<input type='hidden' id='old_email' value='<? echo $email ?>'>
						<input type='hidden' id='type' value='<? echo $_SESSION['type'] ?>'>
						
					</div>
				</div>
				
				<div class="row text-center" id='email_loader' style="display: none">
					<h4>Loading.....</h4>
				</div>	
				
				<div class="row text-center"  id='verification_sent' style="display: none">
					<h5>The verification email was resent to the address above.  Please make sure to check your spam/junk folder.</h5>
				</div>	
<?php
		}
?>																												
	</div>
<?php
}						
?>