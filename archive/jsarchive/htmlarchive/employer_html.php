<?php

function profile_html_employer($member_data, $employer_data, $open_job_count, $store_type_array, $upload_url) {
//SETUP VARIABLES					
		$utilities = new Utilities;
		$store_types = $utilities->store_types;
		
		$general_data = $employer_data['general'];
		$store_data = $employer_data['stores_jobs'];
		$store_array = $store_data['stores'];
		$open_job_array = $store_data['open_jobs'];
		$expired_job_array = $store_data['expired_jobs'];

		if ($general_data['website'] == "" || $general_data['website'] == "http://") {
			$website_text = "NA";
			$website_link = "";
		} else {
			$website_text = $general_data['website'];
			$website_link = $general_data['website'];			
		}
				
		if ($general_data['position'] != '') {
			$position = $general_data['position'];
		} else {
			$position = "NA";
		}	
		
		if ($_SESSION['type'] == "employee") {
			$type = "Job Seeker";
		} else {
			$type = "Employer";
		}				
		
// END SETUP VARIABLES
?>	

	<div class='container employer_info'>
		<div class='row' style="margin-bottom:25px">
			<div class=" text-center">
				<h2>General Information</h2>
			</div>
		</div>
		
		<div class="row main_row name_row" style='font-size:16px; margin-bottom:12px'>		
			<div class="col-xs-5 col-md-3 col-md-offset-3">
				<a href='#' class='edit' id="name"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> <b>NAME:</b>
			</div>
			<div class="col-xs-5 col-md-6">
				<? echo $member_data['firstname']." ".$member_data['lastname'] ?>
			</div>
		</div>
			
		<div class="row main_row name_row" style='font-size:16px; margin-bottom:12px'>		
			<div class="col-xs-5 col-md-3 col-md-offset-3">
				<a href='#' class='edit' id="position"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> <b>POSITION:</b>
			</div>
			<div class="col-xs-5 col-md-6">
				<? echo $position ?>
			</div>
		</div>
		
		<div class="row main_row setting_row" style="font-size:16px; margin-bottom:12px">		
			<div class="col-xs-5 col-md-3 col-md-offset-3">
				<a href='#' class='edit' id="email"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> <b>EMAIL ADDRESS:</b>
			</div>
			<div class="col-xs-6 col-md-6" style="word-wrap:break-word;">
				<? echo $member_data['email'] ?>
			</div>
		</div>

		<div class="row main_row setting_row" style="font-size:16px; margin-bottom:12px">		
			<div class="col-xs-5 col-md-3 col-md-offset-3">
				<a href='#' class="edit" id='password'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> <b>PASSWORD:</b>
			</div>
			<div class="col-xs-5 col-md-6">
				***********************
			</div>
		</div>
		
		<div class="row main_row setting_row" style="font-size:16px; margin-bottom:12px">		
			<div class="col-xs-5 col-md-3 col-md-offset-3">
				<a href='#' class='edit' id="account_type"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> <b>ACCOUNT TYPE: </b>
			</div>
			<div class="col-xs-5 col-md-6">
				<? echo $type ?>
			</div>
		</div>
		
<!-- *****GENERAL FORMS START ******	 -->	

		<div class=' input name_input' style="display:none; min-height: 70%">
			<div class='error col-md-10 col-md-offset-2' id='name_empty_warning' style="color:red; display:none"><b>Name cannot be empty</b></div>

			<div class="form-horizontal">
				<div class="form-group name_form">
			   		<label for="edit_first_name" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">First Name</label>
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='text' class='edit_first_name form-control' value='<? echo $member_data['firstname'] ?>' placeholder='First Name'><br />
					</div>
					<label for="edit_last_name" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Last Name</label>
					<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='text' class='edit_last_name form-control' value='<? echo $member_data['lastname'] ?>' placeholder='Last Name'><br />
					</div>
				</div>
			</div>
			
			<div class="row" style="margin-bottom:25px">
				<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
					<button type="button" class="btn btn-success save_name">
						<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save
					</button>

					<button type="button" class="btn btn-link cancel" style="color:#8e080b;">
						Cancel
					</button>
				</div>
			</div>							
		</div>
		
		<div class=' input position_input' style="display: none; min-height: 70%">
			<div class="form-horizontal">					
				<div class="form-group">
			   		<label for="edit_position" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">POSITION: </label>
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
			   			<select class="form-control" id="edit_position">
							<option value='Manager'>Manager</option>
							<option value='General Manager'>General Manager</option>
							<option value='Assistant Manager'>Assistant Manager</option>
							<option value='Kitchen Manager'>Kitchen Manager</option>
							<option value='Bar Manager'>Bar Manager</option>
							<option value='Owner'>Owner</option>
							<option value='HR'>HR</option>
							<option value='Other'>Other</option>
						</select><br />
					</div>
				</div>
			</div>
			
			<div class="row" style="margin-bottom:15px">
				<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
					<button type="button" class="btn btn-success save_position">
						<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save
					</button>

					<button type="button" class="btn btn-link cancel" style="color:#8e080b;">
						Cancel
					</button>
				</div>
			</div>									
		</div>
		

		<div class=' email_input input' style="display:none; min-height: 70%">
			<div class='error col-md-10 col-md-offset-2' id='email_empty_warning' style="color:red; display:none"><b>Email cannot be empty</b></div>
			<div class='error col-md-10 col-md-offset-2' id='non_email_warning' style="color:red; display:none"><b>Please enter a valid email address</b></div>
			<div class='error col-md-10 col-md-offset-2' id='duplicate_warning_blarg' style="color:red; display:none">This email address is already being used</div>

			<div class="form-horizontal">
				<div class="form-group" id="email_form">
			   		<label for="edit_award" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Email Address</label>
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='text' class='edit_email_holder form-control'  id="edit_email_holder" value='<? echo $member_data['email'] ?>' placeholder='Email'>
					</div>
				</div>
			</div>
			
			<input type="hidden" id="old_email_holder" value="<? echo $member_data['email'] ?>">

			<div class="row" style="margin-bottom:25px">
				<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
					<button type="button" class="btn btn-success save_email_edit">
						<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save
					</button>
					
					<button type="button" class="btn btn-link cancel" style="color:#8e080b;">
						Cancel
					</button><br /> &nbsp; <br />
					<b>A verification email will be sent to your new address</b>

				</div>
			</div>							
		</div>

		<div class='row' id="email_change_success" style="display:none; min-height: 70%">
			<div class="row" style="margin-bottom:25px">
				<div class="col-md-10 col-md-offset-2 col-xs-10 col-xs-offset-2">
					<h5>ACTION REQUIRED</h5>
					A verification link has been sent to your new email address. You must click the link in that email to finalize the change.
				</div>
			</div>							
		</div>
		
		<div class=' password_input input' style="display:none">
			<div class='error col-md-10 col-md-offset-2' id='new_pass_warning' style="color:red; display:none">Your new passwords don't match</div>
			<div class='error col-md-10 col-md-offset-2' id='old_pass_warning' style="color:red; display:none">Your old password is incorrect</div>
			<div class='error col-md-10 col-md-offset-2' id='pass_length_warning' style="color:red; display:none">New password must be between 6 and 12 characters</div>

			<div class="form-horizontal password_change_holder">
				<div class="form-group">				
					<label for="old_password" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Old Password</label>
					<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='password' class='old_pass form-control' id="old_pass" placeholder='Old Password'><br />
					</div>
					<label for="new_pass1" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">New Password</label>
					<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='password' class='new_pass1 form-control' id="new_pass1" placeholder='New Password'><br />
					</div>
					<label for="new_pass2" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Re-type New Password</label>
					<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='password' class='new_pass2 form-control' id="new_pass2" placeholder='Re-type New Password'><br />
					</div>
				</div>		
			</div>
			
			<div class="row password_change_holder" style="margin-bottom:25px">
				<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
					<button type="button" class="btn btn-success save_new_password">
						<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save
					</button>
					
					<button type="button" class="btn btn-link cancel" style="color:#8e080b;">
						Cancel
					</button><br /> &nbsp; <br />
				</div>
			</div>		
			
			<div class='' id="password_change_success" style="display:none; min-height: 70%">
				<div class="row" style="margin-bottom:25px">
					<div class="col-md-10 col-md-offset-2">
						Password successfully changed.
					</div>
				</div>							
			</div>
								
		</div>

		<div class='row account_type_input input' style="display:none">
			<div class='error col-md-10 col-md-offset-2' id='bad_zip_warning' style="color:red; display:none"><b>Please enter a valid zip</b></div>
			<div class='error col-md-10 col-md-offset-2' id='job_warning' style="color:red; display:none"><b>You cannot switch account types while you have open job posts</b></div>
			
			<div class="row">
				<div class="col-md-10 col-md-offset-2 col-xs-9 col-xs-offset-2">
<?php
			if ($_SESSION['type'] == "employee") {
?>
					<h4>Switch account to Employer Account</h4>
					&nbsp; &nbsp; <h5>An employer account will allow you to post job opening, but you will no longer be able to view apply to jobs.</h5>
<?php				
			} else {
				if ($open_job_count > 0) {
?>
						<h4>Switch account to Job Seeker Account</h4>
						&nbsp; &nbsp; <h5>You cannot switch account types while you have open jobs posted.  Please change your account type after your job posts have expired.</h5>
<?php									
				} else {
?>
						<h4>Switch account to Job Seeker Account</h4>
						&nbsp; &nbsp; <h5>A Job Seeker account will allow you view and apply to jobs, but you will no longer be able to post job openings.</h5>
	
						<div class="form-horizontal">
							<div class="form-group" id="zip_form">
						   		<label for="new_zip" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Zip Code</label>
						   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
									<input type='number' class='new_zip form-control' id="zip" placeholder='Zip Code' maxlength="5">
								</div>
							</div>
						</div>
<?php									
				}	
			}
?>
				</div>
			</div>
			
			<div class="row" style="margin-bottom:25px; margin-top: 25px;">
				<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
<?php
					if ($_SESSION['type'] == "employee" || $open_job_count == 0) {
?>	
					<button type="button" class="btn btn-success" id="change_account_type">
						<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Switch
					</button>
<?php
					}
?>					
					<button type="button" class="btn btn-link cancel" style="color:#8e080b;">
						CANCEL
					</button><br /> &nbsp; <br />

				</div>
			</div>							
		</div>


<!-- *****STORE DETAILS START ******	 -->	

		<div class='row store_details' style="margin-bottom:25px">
			<div class="col-md-12 text-center">
				<h2>My Stores</h2>
			</div>
		</div>
		
		<div class="warning row" id="file_size_warning" style="display:none; color:red; margin-top:10px;">
			<div class="col-md-8 col-md-offset-4">
				<h4>Please choose a file less than 5 MB</h4>
			</div>
		</div>
						
		<div class="warning row" id='file_type_warning' style="display:none; color:red; margin-top:10px;">
			<div class="col-md-8 col-md-offset-4">
				<h4>Please choose a PNG or JPG file</h4>
			</div>
		</div>			
	
<?php
		if (count($store_array) == 0) {
?>
<!-- 			Add a Location</br> -->
<?php
		} else {
			foreach ($store_array as $row) {
//SET VARIABLES
				$casual_select = $upscale_casual_select = $upscale = $catering = "";
								
				if ($row['website'] == "") {
					$website = "<i>None Entered</i>";
				} else {
					$website = $row['website'];					
				}
				
				if ($row['facebook'] == "") {
					$facebook = "<i>None Entered</i>";
				} else {
					$facebook = $row['facebook'];					
				}

//END  SET VARIABLE	
?>	
		<div class='row store_details' style="margin-bottom:35px">
				<div class="col-md-offset-2 col-md-4 col-xs-offset-0 col-xs-4 text-center">
					<div class="col-md-12" style="min-height: 110px">
												
<?php
						if ($row['image'] == "") {
?>
							<h4 style='margin-top:40px'>NO LOGO<br/>ADDED</h4>
<?php							
						} else {
?>
	                        <div class="row">
								<img src="images/store_pics/<? echo $row['image']."?".time() ?>" class="center-block profilephoto" id='main_photo' height="110px" width="110px">
						    </div>							
<?php							
						}
?>
					</div>
					
						<div class="col-md-12 col-xs-12" style="margin-top: 13px; margin-bottom: 25px;">
							<button type="button" class="btn btn-primary edit_photo hidden-xs" id="<? echo $row['storeID'] ?>" style="margin-bottom: 10px">
								<i class="fa fa-pencil-square-o" aria-hidden="true" style="background-color: transparent"></i> Edit Photo
							</button>
							
							<a href="#" class="edit_photo hidden-md hidden-sm hidden-lg" id="<? echo $row['storeID'] ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></i> Edit Pic</a>
<?php
							if ($row['image'] != "") {	
?>	       
								<br /><a href="#" class="delete_photo" id="store" data-store_id="<? echo $row['storeID'] ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></i> Delete</a>
<?php
							}
?>    
		            	</div>
					
					
				</div>
				<div class="col-md-5 col-xs-7">
					<div class="row">
						<div class="col-md-4 col-xs-4">
							<b>Store: </b>
						</div>
						<div class="col-md-8 col-xs-7">
							<? echo $row['name'] ?>
						</div>						
					</div>
	
					<div class="row">
						<div class="col-md-4 col-xs-4">
							<b>Address: </b>
						</div>
						<div class="col-md-8 col-xs-7">
							<? echo $row['address'] ?>
						</div>						
					</div>
	
					<div class="row">
						<div class="col-md-4 col-xs-4">
							<b>Zip: </b>
						</div>
						<div class="col-md-8 col-xs-7">
							<? echo $row['zip'] ?>
						</div>						
					</div>
	
					<div class="row">
						<div class="col-md-4 col-xs-4">
							<b>Type: </b>
						</div>
						<div class="col-md-8 col-xs-7">
							<? echo $row['description'] ?>
						</div>						
					</div>
					
					<div class="row">
						<div class="col-md-4 col-xs-4">
							<b>Website: </b>
						</div>
						<div class="col-md-8 col-xs-7">
							<? echo $website ?>
						</div>						
					</div>
	
					<div class="row">
						<div class="col-md-4 col-xs-4">
							<b>Facebook: </b>
						</div>
						<div class="col-md-8 col-xs-7">
							<? echo $facebook ?>
						</div>						
					</div>
	
					<div class="row" style="margin-top:25px">
						<div class="col-md-12">
							<a href='#' class='btn btn-primary edit_store' id='<? echo $row['storeID'] ?>'><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Store Details</a>  <!-- <a href='job.php?ID=new_job&storeID=<? echo $row['storeID'] ?>' class='btn btn-primary' id='add_store'>Post Job</a> -->							
						</div>
					</div>
					
				</div>

			<div class='status' style="color:red;"></div>			

			<div class="add_photo_tools" style="">			
			    <form class="myform" action="<? echo $upload_url ?>.php?type=store&storeID=<? echo $row['storeID'] ?>" method="post" enctype="multipart/form-data" style="position:absolute; top:-500px;">
			        <input type="file" class="store_pic_choose" id="store_pic_choose_<? echo $row['storeID'] ?>" data-store_id="<? echo $row['storeID'] ?>" name="store_pic_choose" >
					<input type="submit" value="Save Store Pic1" id="store_upload_button_<? echo $row['storeID'] ?>"><br />
				</form>
			</div>
			
		</div>

<!-- *****STORE FORMS START ******	 -->	
		
		<div class=" edit_store_holder" id="edit_store_holder_<? echo $row['storeID'] ?>" style="font-size:16px; margin-top:30px; margin-bottom:12px; display: none">		
			<h4 style="text-align:center; color:#760006;">Edit Location</h2>

			<div class='error col-md-10 col-md-offset-2' id='store_required_warning' style="color:red; margin-bottom:5px; display:none">Please complete required fields</div>
			<div class='error col-md-10 col-md-offset-2' id='store_zip_warning' style="color:red; margin-bottom:5px; display:none">Please enter a valid zip code</div>
			<div class='error col-md-10 col-md-offset-2' id='location_type_warning' style="color:red; margin-bottom:5px; display:none">Please select a location type</div>

			<div class="form-horizontal">
				<div class="form-group" id="edit_location_form" style="margin-bottom:3px">
			   		<label for="edit_location" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Store Name</label>
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='text' class='edit_location form-control' id="edit_location_<? echo $row['storeID'] ?>" value="<? echo $row['name'] ?>" placeholder='Required'><br />
					</div>

			   		<label for="edit_address" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Street Address</label>
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='text' class='edit_address form-control' id="edit_address_<? echo $row['storeID'] ?>"  value="<? echo $row['address'] ?>" placeholder='Required'><br />
					</div>
					
			   		<label for="edit_zip" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Zip Code</label>
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='text' class='edit_zip form-control' id="edit_zip_<? echo $row['storeID'] ?>" value="<? echo $row['zip'] ?>" placeholder='Required'><br />
					</div>

			   		<label for="edit_description" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Business Type</label>
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
			   			<select class="form-control" id="edit_description_<? echo $row['storeID'] ?>">
							<option value='0'>--Location Type--</option>																	
<?php
							foreach ($store_type_array as $type) {
								if ($row['description'] == $type) {
									$selected = "selected";
								} else {
									$selected = "";
								}
								echo "<option value='".$type."' $selected >".$type."</option>";
							}
?>					
						</select><br />
					</div>

			   		<label for="edit_website" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Website</label>
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='text' class='edit_website form-control' id="edit_website_<? echo $row['storeID'] ?>" value="<? echo $row['website'] ?>" placeholder='Optional'><br />
					</div>

			   		<label for="edit_facebook" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Facebook</label>
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='text' class='edit_facebook form-control' id="edit_facebook_<? echo $row['storeID'] ?>" value="<? echo $row['facebook'] ?>" placeholder='Optional'><br />
					</div>

					<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
						<a href='#' class='btn btn-large btn-success save_store_edit' id="<? echo $row['storeID'] ?>">Save</a>								
						&nbsp; <a href='#' class='cancel_edit_store'>Cancel</a>											
					</div>
			
				</div>			
			</div>
		</div>	
		
<?php
			}
		}
?>
		<div class='store_details' style="float:left; margin-top:15px; margin-bottom:35px; width:100%; text-align:center">
			<h5>To add a new location, simply begin posting a job</h5>
			<a href='job.php?ID=new_job&page=location' class='btn btn-success btn-large'>POST A NEW JOB</a>
		</div>	
	</div>		
											
<?php		
}

/*
function profile_html_type_switch() {	
?>	
	<table class='dark' style="width:100%;">
		<tr valign='middle'>
			<th valign='middle'>Switch Account Type</th>
		</tr>		
	</table>
		
	You have signed up for an Employer account.  This account type is for managers posting open jobs.<br />
	&nbsp; <br />
	If you are a Job Seeker wish to create a profile to apply to open jobs, you can switch your account type by filling out the info below.	
	&nbsp; <br />

	<div id='employee_zip_warning' class='warning' style="display:none; width:100%; text-align:center;"><font color='red'><b>Please use a valid zip code</b></font></div>
	<div id='age_warning' class='warning' style="display:none; width:100%; text-align:center;"><font color='red'><b>You must be over 18 to use this site</b></font></div>
	<div id='other_warning' class='warning' style="display:none; width:100%; text-align:center;"><font color='red'><b>There was a problem processing your request, please contact admin@servebartendcook.com</b></font></div><br />
	<div id='employee_invalid_zip_warning' class='warning' style="display:none; width:100%; text-align:center;"><font color='red'><b>The zip code entered is either invalid or a military zip code</b></font></div>

	<b>Zip Code:</b> <input type='text' id='zip' name='zip' size='16'  /><br />    
	<input type='checkbox' id='age' value='18'>
	<div style="font-size: 11px;"><b>I certify that I am at least 18 years of age.</b></div>
	<div style="float:left; margin-top:20px; width:100%"><a href='#' class='btn btn-large btn-primary' id='change_account_type'>Change Account Type</a></div>				
<?php
}
*/

function employer_html_loader() {
?>
	<div class="" id="loader" style="display: none">
		<div class="row text-center" style="margin-top: 150px; margin-bottom: 150px;">
			<h3>LOADING...</h3>
		</div>
	</div>
<?php
}

?>