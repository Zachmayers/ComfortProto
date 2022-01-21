<?php
	
function job_html_employer_select_location($first_name, $store_array, $store_type_array) {
	$utilities = new Utilities;
	
	if (count($store_array) > 0) {
		//list
		$new_store_form = "display:none";
		$first_job_note = "display:none";
	} else {
		$new_store_form = "";
		$first_job_note = "";
	}
?>	

	<div class='container'>
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-12 text-center">
				<h2 style="color:black">We are currently not accepting new job posts</h2>
				<h5> We are preparing for a complete site redevelopment</h5>
				<h5>We apologize for any inconvenience</h5>
			</div>	
		</div>
		
	</div>
</div>
<?php
}	

function job_html_employer_select_location_old($first_name, $store_array, $store_type_array) {
	$utilities = new Utilities;
	
	if (count($store_array) > 0) {
		//list
		$new_store_form = "display:none";
		$first_job_note = "display:none";
	} else {
		$new_store_form = "";
		$first_job_note = "";
	}
?>	

	<div class='container'>
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-12 text-center">
				<h2 style="color:black"><? echo $first_name ?> - Where are you hiring?</h2>
			</div>	
		</div>
		
<?php
		if (count($store_array) > 0) {				

			if (count($store_array) > 0) {
				foreach($store_array as $row) {
					$city_state = $utilities->get_city_state($row['zip']);
?>
					<div class="row store_row" style="font-size:16px; margin-bottom:20px">		
						<div class="col-md-2 col-md-offset-2 col-xs-3 col-xs-offset-0 text-center">
<?php
							if ($row['image'] != "") {
?>
		                        <div class="row">
									<img src="images/store_pics/<? echo $row['image']."?".time() ?>" class="center-block profilephoto" id='main_photo' height="110px" width="110px">
							    </div>							
<?php								
							} else {
?>
								<h4 style='margin-top:10px'>No Logo<br/>Added</h4>
<?php
							}
?>
						</div>
						<div class="col-md-4 col-xs-5">
							<a href='#' class='show_edit_store' id='<? echo $row['storeID'] ?>'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> <? echo $row['name'] ?><br />
							<span style="font-size:12px;"><i><? echo $row['address'] ?></i></span><br />
							<span style="font-size:12px;"><i><? echo $city_state['city'].", ".$city_state['state']." ".$row['zip'] ?></i></span>
						</div>
						<div class="col-md-2 col-xs-3 text-right">
							<button type="button" class="btn btn-danger location_select" id='<? echo $row['storeID'] ?>'>
								Continue &nbsp; <i class="fa fa-arrow-circle-right" aria-hidden="true" style="background-color: transparent"></i>
							</button>
						</div>
					</div>
					
					<div class=" edit_store_holder" id="edit_store_holder_<? echo $row['storeID'] ?>" style="font-size:16px; margin-top:30px; margin-bottom:12px; display: none">		
						<h4 style="text-align:center; color:#760006;">Edit Location</h2>
			
						<div class='error col-md-10 col-md-offset-2' id='store_required_warning_<? echo $row['storeID'] ?>' style="color:red; margin-bottom:5px; display:none">Please complete required fields</div>
						<div class='error col-md-10 col-md-offset-2' id='store_zip_warning_<? echo $row['storeID'] ?>' style="color:red; margin-bottom:5px; display:none">Please enter a valid zip code</div>
						<div class='error col-md-10 col-md-offset-2' id='location_type_warning_<? echo $row['storeID'] ?>' style="color:red; margin-bottom:5px; display:none">Please select a business type</div>

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
						   		<div class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0">
									<input type='text' class='edit_facebook form-control' id="edit_facebook_<? echo $row['storeID'] ?>" value="<? echo $row['facebook'] ?>" placeholder='Optional'><br />
								</div>

								<div class="col-md-10 col-md-offset-2 col-xs-10 col-xs-offset-2" style="margin-bottom: 10px">			
									<h5 style="margin-top: 5px; "><i>To Edit/Add Logo Image visit</i> <a href="employer.php">SETTINGS</a></h5>	
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
			<div class="row location_row store_row" style="font-size:16px; margin-top:30px; margin-bottom:12px">		
				<div class="col-md-9 col-md-offset-3 col-xs-9 col-xs-offset-2">
					<button type="button" class="btn btn-success" id='new_location' style="margin-bottom: 5px;">
						<i class="fa fa-plus-circle" aria-hidden="true" style="background-color: transparent"> </i> ADD NEW LOCATION
					</button><br />
					You can manage posts at multiple locations
				</div>
			</div>
<?php
	}
?>

		<div class=" new_store_holder" style="font-size:16px; margin-top:30px; margin-bottom:12px; <? echo $new_store_form ?>;">		
			
			<h4 style="text-align:center; color:#760006;">Location</h2>

			<div class="col-md-12 col-xs-12">
				<h5 style='text-align:center; <? echo $first_job_note ?>'><i>First you need to enter a location for your business.<br />(You only need to do this for your first job post, you can use the same location in the future.)</i></h5>
			</div>
			<div class='error col-md-10 col-md-offset-2 col-xs-10 col-xs-offset-1' id='store_required_warning' style="color:red; margin-bottom:5px; display:none">Please complete required fields</div>
			<div class='error col-md-10 col-md-offset-2 col-xs-10 col-xs-offset-1' id='store_zip_warning' style="color:red; margin-bottom:5px; display:none">Please enter a valid zip code</div>
			<div class='error col-md-10 col-md-offset-2 col-xs-10 col-xs-offset-1' id='location_type_warning' style="color:red; margin-bottom:5px; display:none">Please select a business type</div>

			<div class="form-horizontal">
				<div class="form-group" id="location_form" style="margin-bottom:3px">
			   		<label for="new_location" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Store Name</label>
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
<?php
	if (count($store_array) == 0) {
?>	
			   		<label for="position" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Your Title</label>
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
			   			<select class="form-control" id="position">
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
<?php
	}
?>		
			   		<label for="description" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Business Type</label>
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
			   			<select class="form-control" id="description">
							<option value='0'>--Location Type--</option>																	
<?php
							foreach ($store_type_array as $type) {
								echo "<option value='".$type."'>".$type."</option>";
							}
?>					
						</select><br />
					</div>

			   		<label for="website" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Website</label>
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='text' class='website form-control' id="website" placeholder='Optional'><br />
					</div>

			   		<label for="facebook" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Facebook</label>
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='text' class='website form-control' id="facebook" placeholder='Optional'><br />
					</div>
							
					<input type="hidden" id="name" value=''>	

					<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
						<a href='#' class='btn btn-large btn-success add_store' id='post'>Save & Continue</a>								
<?php
						if ($first_job_note != "") {
?>
							&nbsp; <a href='#' class='cancel_add'>Cancel</a>											
<?php					
						}
?>
					</div>
			
				</div>			
			</div><br />
		</div>
	</div>
</div>
<?php
}	

function job_html_add_photo($storeID, $image, $upload_url) {
?>
	<div class='container' style="min-height: 60%">
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-12 text-center">
				<h2 style="color:black">Company Logo/Image (Optional)</h2>
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
		
		<div class="row" style="margin-bottom: 75px;">
			<div class="col-md-offset-2 col-md-4 col-xs-offset-1 col-xs-10 text-center">
<?php
				if ($image == "") {
?>
					<h4 style='margin-top:40px'>NO LOGO<br/>ADDED</h4>
<?php							
				} else {
?>
	                <div class="row text-right">
						<img src="images/store_pics/<? echo $image."?".time() ?>" class="center-block profilephoto" id='main_photo' height="110px" width="110px">
				    </div>							
<?php							
				}
?>
			</div>		
			<div class="col-md-4 col-xs-offset-1 col-xs-10 text-center" style="margin-top: 35px;">
				<button type="button" class="btn btn-primary edit_photo" id="<? echo $storeID ?>" style="margin-bottom: 10px">
					<i class="fa fa-pencil-square-o" aria-hidden="true" style="background-color: transparent"></i> New Photo
				</button>
<?php
				if ($image != "") {	
?>	
					<button type="button" class="btn btn-primary skip_photo_glug" style="margin-bottom: 10px">
						 Continue <i class="fa fa-arrow-circle-o-right" aria-hidden="true" style="background-color: transparent"></i>
					</button>

					<br /><a href="#" class="delete_photo" id="store" data-store_id="<? echo $storeID ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></i> Delete</a>
<?php
				} else {
?>
					<br /><a href="#" class="skip_photo_glug">Skip Image</a><br />
<?php								
				}
?>    
	           </div>
	           <div class="col-md-12 col-xs-12 text-center" style="margin-top:20px;">
		        	<i>You can add or change a company logo any time in 'Settings'</i>
	           </div>
			</div>
				
				
				<div class='status' style="color:red;"></div>			
	
				<div class="add_photo_tools" style="">			
				    <form class="myform" action="<? echo $upload_url ?>.php?type=store&storeID=<? echo $storeID ?>" method="post" enctype="multipart/form-data" style="position:absolute; top:-500px;">
				        <input type="file" class="store_pic_choose" id="store_pic_choose_<? echo $storeID ?>" data-store_id="<? echo $storeID ?>" name="store_pic_choose" >
						<input type="submit" value="Save Store Pic1" id="store_upload_button_<? echo $storeID ?>"><br />
					</form>
				</div>
				
			</div>
			
	</div>
<?php	
}
	
function job_html_employer_selection($storeID, $store_name, $region_status, $next_cl_date) {
	//in this version, we will allow the user to select from a couple options
	// 1) Single job post $15
	// 2) All FOH or All BOH for $30, this will allow the user to select up to 4 jobs to post
	// 3) All Positions for $55, this will allow the user to select up to 8 jobs to post
	
	//Free for low regions
	
	if ($region_status == "free") {
		$single_price = $four_price = $eight_price = "<i>FREE</i>";
	} else {
		$single_price = "$19";
		$four_price = "$35";
		$eight_price = "<b>$40</b>";	
	}
?>
	<div class='container'>
		<div class='row' style="margin-bottom:12px">
			<h2 style="text-align:center; margin-bottom:0px;">How many positions do you need to fill?</h2>
<?php		
		if ($region_status != "free") {
?>
<!-- 			<span style="float:left; width:100%; text-align:center;">(<i>All posts are also advertised in our weekly regional Craigslist Post</i>)</span><br />	 -->
<?php
		}
?>
		</div>
		
		<div class="row store_row" style="font-size:16px; margin-top:45px; margin-bottom:10px">		
			<div class="col-md-5 col-md-offset-3 col-xs-10 col-xs-offset-1">
				<h2 style="margin-top: 0px; margin-bottom:0px;"><i class="fa fa-circle-thin" aria-hidden="true"></i>
				SINGLE JOB POST - <? echo $single_price ?></h2>
				<div class="row">
					<div class="col-xs-offset-1 col-xs-10" style="margin-bottom: 10px; margin-bottom: 3px">
						<i>Post one job opening of any type</i>
					</div>
				</div>
			</div>

			<div class="col-md-2 col-xs-2 col-xs-offset-1 text-right">
				<button type="button" class="btn btn-danger job_post" id='single'>
					Post a SIngle Opening &nbsp; <i class="fa fa-arrow-circle-right" aria-hidden="true" style="background-color: transparent"></i>
				</button>
			</div>
			
		</div>
		<hr>
		
		<div class="row store_row" style="font-size:16px; margin-top:0px; margin-bottom:10px">		
			<div class="col-md-5 col-md-offset-3 col-xs-10 col-xs-offset-1">
				<h2 style="margin-top: 0px; margin-bottom:0px;"><i class="fa fa-glass" aria-hidden="true"></i> 
				ALL FRONT OF HOUSE - <? echo $four_price ?></h2>
				<div class="row">
					<div class="col-xs-offset-1 col-xs-10" style="margin-bottom: 10px; margin-bottom: 3px">
						<i>Include up to </i><b>4</b><i> Front of House Openings in this post!</i>
					</div>
				</div>
			</div>

			<div class="col-md-2 col-xs-2 col-xs-offset-1 text-right">
				<button type="button" class="btn btn-danger job_post" id='FOH'>
					Post ALL FRONT OF HOUSE &nbsp; <i class="fa fa-arrow-circle-right" aria-hidden="true" style="background-color: transparent"></i>
				</button><br />
			</div>
		</div>
		<hr>
		
		<div class="row store_row" style="font-size:16px; margin-top:0px; margin-bottom:10px">		
			<div class="col-md-5 col-md-offset-3 col-xs-10 col-xs-offset-1">
				<h2 style="margin-top: 0px; margin-bottom:0px;"><i class="fa fa-cutlery" aria-hidden="true"></i> 
				ALL BACK OF HOUSE - <? echo $four_price ?></h2>
				<div class="row">
					<div class="col-xs-offset-1 col-xs-10" style="margin-bottom: 10px; margin-bottom: 3px">
						<i>Include up to </i><b>4</b><i> Back of House Openings in this post!</i>
					</div>
				</div>
			</div>

			<div class="col-md-2 col-xs-2 col-xs-offset-1 text-right">
				<button type="button" class="btn btn-danger job_post" id='BOH'>
					Post ALL BACK OF HOUSE &nbsp; <i class="fa fa-arrow-circle-right" aria-hidden="true" style="background-color: transparent"></i>
				</button>
			</div>
		</div>
		<hr>
			
		<div class="row store_row" style="font-size:16px; margin-top:0px; margin-bottom:10px">		
			<div class="col-md-5 col-md-offset-3 col-xs-10 col-xs-offset-1">
				<h2 style="margin-top: 0px; margin-bottom:0px; color: #5cb85c"><i class="fa fa-check-circle" aria-hidden="true"></i> 
				ALL POSITIONS -<? echo $eight_price ?></h2>
				<div class="row">
					<div class="col-xs-offset-1 col-xs-10" style="margin-bottom: 10px; margin-bottom: 3px">
						<i style="color: #5cb85c">Include up to </i><b style="color: #5cb85c">8</b><i style="color: #5cb85c"> BOH & FOH Openings in this post!</i>
					</div>
				</div>
			</div>

			<div class="col-md-2 col-xs-2 col-xs-offset-1 text-right">
				<button type="button" class="btn btn-success job_post" id='all'>
					Post HIRING ALL POSITIONS &nbsp; <i class="fa fa-arrow-circle-right" aria-hidden="true" style="background-color: transparent"></i>
				</button>
			</div>
		</div>
		<hr>
		
			
<?php
		if ($region_status != "free") {
?>
		<div class="row" style="font-size:16px; margin-top:10px; margin-bottom:30px">		
			<div class="col-md-9 col-md-offset-3">
				<h4>Included with ANY purchase!</h5>
			</div>
			<div class="col-md-9 col-md-offset-3">
				<i class="fa fa-plus" aria-hidden="true"></i> Your job(s) will be posted on ServeBartendCook.com<br />
				<i class="fa fa-plus" aria-hidden="true"></i> Email alerts will be sent to all users who match your job(s) criteria<br />
<!-- 				<i class="fa fa-plus" aria-hidden="true"></i> <b>Your job(s) will be featured in our regional Craigslist group post</b> -->
			</div>
		</div>
<?php
		}
}	

function job_html_employer_templates($group_details, $group_job_list, $job_template_array, $storeID, $store_name, $former_jobs, $email_verification, $email, $region_status, $receiptID) {
	$all_display = $boh_display = $foh_display = "display:none;";
	$checkout_test = "N";
	
	//detrmine number of posts left
	$total_post_number = $group_details['max_posts'];
	$current_posts = count($group_job_list);
	
	$remaining_posts = $total_post_number - $current_posts;
	
	switch($group_details['type']) {
		default:
			$title_text = "Individual Job Post";
			$count_text = "";
			$back = "all_back";
			if (count($group_job_list) == 0) {
				$all_display = "";
			}
			$cost = "$19";
			
			if ($current_posts > 0) {
				$checkout_test = "Y";
			}
			
			$remain_text = 1;
			
			$allowable_posts = 1;
		break;
		
		case "BOH":
			$title_text = "Hiring All Back of House";
			$count_text = "You may include up to 4 Back of House openings in this post";
			$back = "boh_back";
			if (count($group_job_list) == 0) {
				$boh_display = "";
			}
			$cost = "$35";
			
			if ($current_posts > 1) {
				$checkout_test = "Y";
			}
			
			$remain_text = 2;	
	
			$allowable_posts = 4;				
		break;

		case "FOH":
			$title_text = "Hiring All Front of House";
			$count_text = "You may include up to 4 Front of House openings in this post";
			$back = "foh_back";
			if (count($group_job_list) == 0) {
				$foh_display = "";
			}
			$cost = "$35";

			if ($current_posts > 1) {
				$checkout_test = "Y";
			}
			
			$remain_text = 2;		
			
			$allowable_posts = 4;				
		break;

		case "all":
			$title_text = "Hiring All Positions";
			$count_text = "You may include up to 8 openings in this post";
			$back = "all_back";
			if (count($group_job_list) == 0) {
				$all_display = "";
			}
			$cost = "<b>$40</b>";
			
			if ($current_posts > 1) {
				$checkout_test = "Y";
			}
			
			$remain_text = 2;	
			
			$allowable_posts = 8;								
		break;		
	} //GOOD

	switch($group_details['post_status']) {
		default:
			if ($region_status == "free") {
				$cost = "FREE";
				$pending_statement = "<i>Post Pending - Finalize Below</i>";
			} else {
				$pending_statement = "<i>Post Pending - Awaiting Checkout Below</i>";		
			}
		break;
		
		case "posted":
			if ($region_status == "free") {
				$cost = "FREE";
				$pending_statement = "<i>Job Posted</i>";
			} else {
				$pending_statement = "<i>Job Posted</i>";		
			}
		break;
	}
	
?>		
	
	<div class='container' style="min-height: 70%">
		<div class='row text-center' style="margin-bottom:12px">
			<h2><? echo $store_name ?></h4>		
		</div>

		<div class='row job_post_holder post_options' style="margin-bottom:30px;">
			<h4 style="text-align:center"><? echo $title_text ?></h2>
<?php
				if ($group_details['post_status'] == "posted") {
					$expiration_date = "Error";
					$expired = "Y";
					if (count($group_job_list) > 0) {
						foreach ($group_job_list as $row) {
							if ($row['job_status'] == "Open" || $row['job_status'] == "Filled") {
								$expiration_date = date('M j, Y', strtotime($row['expiration_date']));
							}
						}
					}
					
					if (strtotime($expiration_date) > strtotime(date('M j, Y'))) {
						$expired = "N";
					}
					
					if ($expired == "N") {
?>
						<h4 style='text-align:center'>Post Expires on <? echo $expiration_date ?></h4>	
<?php
					} else {
?>
						<h4 style='text-align:center; color:red'>Expired on <? echo $expiration_date ?></h4>			
<?php
					}					
				} else {
?>
					<h4 style='text-align:center'><? echo $count_text ?></h4>	
<?php
				} //BRACKER APPEARS CORRECT
?>
		</div>

<?php
		if (count($group_job_list) > 0) {
			//display current jobs associated with group
				foreach ($group_job_list as $row) {
?>		
					<div class='row job_post_holder current_post' style="margin-top:15px">
						<div class="col-md-4 col-md-offset-2 col-xs-10 col-xs-offset-1">
							<h2 style="display: inline"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <? echo $row['title'] ?></h3><br />
<?php
							if ($group_details['post_status'] == "posted") {
								if ($row['job_status'] != "Open" && $row['job_status'] != "Filled") {
									echo "&nbsp; &nbsp; &nbsp; &nbsp; <i style='color:red'>Post Pending - Click 'SAVE UPDATES' below</i><br />";
								} else {
									$posted_count++;
?>
									&nbsp; &nbsp; &nbsp; &nbsp; <? echo $pending_statement; ?> - 
									<a href='job.php?ID=<? echo $row['jobID'] ?>&page=get_link'><i class="fa fa-share-alt-square" aria-hidden="true"></i> Share Job</a>		
<?php
								}	
							} else {
								echo "&nbsp; &nbsp; &nbsp; &nbsp; ".$pending_statement;	
							}
?>
						</div>
						<div class="col-md-5 col-xs-10 col-xs-offset-1 text-md-right">
<?php							
							if ($group_details['post_status'] == "posted") {
								if ($row['job_status'] != "Open" && $row['job_status'] != "Filled") {
?>
									<h4 style="display: inline" class="hidden-xs"><a href='job.php?ID=<? echo $row['jobID'] ?>'><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit/Remove</a></h3>
									<h5 style="display: inline" class="hidden-md hidden-sm hidden-lg"><a href='job.php?ID=<? echo $row['jobID'] ?>'><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit/Remove</a></h3>

<?php
								} else {
									if ($expired == "N") {
?>
										<h4 style="display: inline" class="hidden-xs"><a href='job.php?ID=<? echo $row['jobID'] ?>&page=edit'><i class="fa fa-pencil-square-o" aria-hidden="true"></i> View/Edit Job</a></h3>
										<h5 style="display: inline" class="hidden-md hidden-sm hidden-lg"><a href='job.php?ID=<? echo $row['jobID'] ?>&page=edit'><i class="fa fa-pencil-square-o" aria-hidden="true"></i> View/Edit Job</a></h3>
<?php
									} else {
?>
										<h4 style="display: inline"><a href='job.php?ID=<? echo $row['jobID'] ?>'> EXPIRED</a></h3>
<?php
									}
								}
							} else {
?>
								<h4 style="display: inline" class="hidden-xs"><a href='job.php?ID=<? echo $row['jobID'] ?>&page=edit'><i class="fa fa-pencil-square-o" aria-hidden="true"></i> View/Edit Job</a></h3>
								<h5 style="display: inline" class="hidden-md hidden-sm hidden-lg"><a href='job.php?ID=<? echo $row['jobID'] ?>&page=edit'><i class="fa fa-pencil-square-o" aria-hidden="true"></i> View/Edit Job</a></h3>
<?php
							}
?>							
						</div>
					</div>
<?php
					} //Closes foreach

					if ($remaining_posts > 0 && $group_details['type'] != "single") {
						if ($current_posts > 0) {
?>
							<div class='row job_post_holder current_post' style="margin-top:25px">
								<div class="col-md-10 col-md-offset-2 col-xs-10 col-xs-offset-1">
									&nbsp; &nbsp; &nbsp; &nbsp;<a href='#' class='btn btn-primary btn-large' id='show_<? echo $group_details['type'] ?>'> <i class="fa fa-plus" aria-hidden="true"></i> Add Another Opening (Up to <? echo $remaining_posts ?> more)* </a> 
								</div>
							</div>
<?php	
						}
					}
?>
					<div class="row job_post_holder" id='included_text' style="margin-top: 45px">
<?php
						if ($group_details['post_status'] == "posted") {
							//count posted items 
							if ($posted_count != $allowable_posts) {
								if ($group_details['region_status'] == "free") {
									$receiptID = "free";
								}
?>
						<div class="col-md-12 text-center" >
								<h5 style='text-align:center; margin-bottom:5px;'>Any openings added to this post will expire on:  <? echo $expiration_date ?></h5>	
						</div>
<?php
								if ($group_details['type'] == "FOH" || $group_details['type'] == "BOH" || $group_details['type'] == "all") {
									if ($posted_count != $allowable_posts && $expired != "Y") {
?>
										<div class="col-md-12 text-center" style="margin-top:15px;">
					 						<a href='#' class='btn btn-large btn-success checkout_holder' id='update_post'> <i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> SAVE UPDATES</a>								
					 						<br /> &nbsp; <br /><img src='images/outline.png' height='26px' width='119px' alt='stripe' class="img-responsive center-block">
				
										</div><br />&nbsp; <br />
										<div class="col-md-12 text-center">
											<i>By clicking 'Save Updates' you agree to our <a href='index.php?page=TOS'>Terms of Service</a> and <a href='index.php?page=privacy_policy'>Privacy Policy</a></i><br />
										</div><br />
<?php
								}
								echo "<br />";	
							} 				
												
						} else {
?>
							<div class="col-md-12 text-center" style="margin-top:15px;">
								<h5 style='text-align:center; margin-bottom:5px;'>All openings above are currently posted: <a href='job.php?ID=new_job&page=location'>POST NEW JOB</a></h5>					
							</div>						
<?php
						}
						
						if ($remaining_posts > 0) {
?>
<!--
							<div class="col-md-12 text-center">
								<b>*IMPORTANT - Unused openings DO NOT carry over as credits for future jobs posts.</b>				
							</div>
-->
<?php
						}
						
						if ($receiptID > 0 && $receiptID != "NA") {
?>
							<div class="col-md-12 text-center">
								<h5 style='text-align:center; margin-top:10px'><a href='job.php?ID=new_job&groupID=<? echo $group_details['groupID'] ?>&page=group_receipt&receiptID=<? echo $receiptID ?>'>VIEW RECEIPT</a></h5>							
							</div>
<?php
						}
					} else {
						if ($region_status == "free") {
?>
							<div class="col-md-12">
								<h5 style="text-align:center; margin-bottom:5px;">Included with your post</h5>
								<div class="col-md-10 col-md-offset-2 col-xs-10 col-xs-offset-1">
									<i class="fa fa-plus" aria-hidden="true"></i> The above job and specific openings will be posted on ServeBartendCook.com<br />
									<i class="fa fa-plus" aria-hidden="true"></i> Email alerts will be sent to all users who match the criteria in the above openings<br />
								</div>
							</div>
<?php
						} else {
?>
							<div class="col-md-12 hidden-xs">
								<div class="col-md-10 col-md-offset-2 col-xs-10 col-xs-offset-1">
								<h5 style="margin-bottom:10px;">Included with your purchase</h5>
	
									<i class="fa fa-plus" aria-hidden="true"></i> The above opening(s) will be posted on ServeBartendCook.com<br />
									<i class="fa fa-plus" aria-hidden="true"></i> Email alerts will be sent to all users who match the job criteria<br />
<!-- 									<i class="fa fa-plus" aria-hidden="true"></i> Openings will be included in our regional Craigslist Group Post (typically posted on Tues. or Thurs.)<br /> -->
<!--
<?php
							if ($remaining_posts > 0) {
?>
									&nbsp; <br />		
									<b>*IMPORTANT - Unused openings DO NOT carry over as credits for future jobs posts.</b><br />
<?php
							}
?>
-->
								</div>
							</div>
<?php
						}
					}
?>
		</div>
<?php
		}		
?>
		<div id='single_post_options' class='row post_options' style="margin-top:10px; <? echo $all_display ?>">

			<div id='col-md-12'>
				<h5 style="text-align:center">Select a Job Category: </h3>		
			</div>
			
			<div class="row">
				<div class="col-md-offset-2 col-md-8 col-md-12">
					<div class="col-md-4 col-xs-6" style="margin-top: 5px">
						<button type="button" id='Bartender' class="main_skill btn btn-primary btn-lg btn-block"><i class="fa fa-check-circle-o" aria-hidden="true" style="background-color: transparent"></i> Bartender</button>
					</div>
					<div class="col-md-4 col-xs-6" style="margin-top: 5px">
						<button type="button" id='Manager' class="main_skill btn btn-primary btn-lg btn-block"><i class="fa fa-check-circle-o" aria-hidden="true" style="background-color: transparent"></i> Manager</button>
					</div>
					<div class="col-md-4 col-xs-6" style="margin-top: 5px">
						<button type="button" id='Server' class="main_skill btn btn-primary btn-lg btn-block"><i class="fa fa-check-circle-o" aria-hidden="true" style="background-color: transparent"></i> Server</button>
					</div>

					<div class="col-md-4 col-xs-6" style="margin-top: 5px">
						<button type="button" id='Kitchen' class="main_skill btn btn-primary btn-lg btn-block"><i class="fa fa-check-circle-o" aria-hidden="true" style="background-color: transparent"></i> Kitchen</button>
					</div>
					<div class="col-md-4 col-xs-6" style="margin-top: 5px">
						<button type="button" id='Host' class="main_skill btn btn-primary btn-lg btn-block"><i class="fa fa-check-circle-o" aria-hidden="true" style="background-color: transparent"></i> Host</button>
					</div>
					<div class="col-md-4 col-xs-6" style="margin-top: 5px">
						<button type="button" id='Bus' class="main_skill btn btn-primary btn-lg btn-block"><i class="fa fa-check-circle-o" aria-hidden="true" style="background-color: transparent"></i> Bus</button>
					</div>
				</div>
			</div>
			
<?php
			if (count($former_jobs) > 0) {
?>
			<div class="row" style="margin-top: 15px; margin-bottom: 50px;">
				<div class="col-md-offset-2 col-md-8 col-xs-offset-1 col-xs-10">

					<h5>OR Repost a job (up to 60 days old):</h5>
					<select id='former_job' class="form-control" >
						<option value='NA'>SELECT FORMER JOB POST</option>"
<?php			
						foreach($former_jobs as $row) {
?>
							<option value='<? echo $row['jobID'] ?>'><? echo $row['title']." - ".date('M j, Y', strtotime($row['date_created'])) ?></option>
<?php
						}
?>
					</select>
				</div>
			</div>
<?php
			}
?>	
<?php		
		if ($current_posts > 0) {
?>		
			<div class="row all_main_back text-center" style="margin-top: 35px; margin-bottom: 15px;">
				<a href='#' class='btn btn-primary selection_back' id='all_back'><i class="fa fa-arrow-circle-left" aria-hidden="true" style="background-color: transparent"></i> Back </a>				
			</div>
<?php
		}
?>	
		</div>
	
	<div id='boh_post_options' class='row post_options' style="margin-top:10px; <? echo $boh_display ?>">

		<div id='col-md-12'>
			<h5 style="text-align:center">Select a Job Category: </h3>		
		</div>
		
		<div class="row">
			<div class="col-md-offset-2 col-md-8 col-md-12">
				<div class="col-md-4 col-xs-6" style="margin-top: 5px">
					<button type="button" id='Manager' class="main_skill btn btn-primary btn-lg btn-block"><i class="fa fa-check-circle-o" aria-hidden="true" style="background-color: transparent"></i> Manager</button>
				</div>
				<div class="col-md-4 col-xs-6" style="margin-top: 5px">
					<button type="button" id='Kitchen' class="main_skill btn btn-primary btn-lg btn-block"><i class="fa fa-check-circle-o" aria-hidden="true" style="background-color: transparent"></i> Kitchen</button>
				</div>
				<div class="col-md-4 col-xs-6" style="margin-top: 5px">
					<button type="button" id='Bus' class="main_skill btn btn-primary btn-lg btn-block"><i class="fa fa-check-circle-o" aria-hidden="true" style="background-color: transparent"></i> Bus</button>
				</div>
			</div>	
		</div>																		
<?php
		if (count($former_jobs) > 0) {
?>
			<div class="row" style="margin-top: 15px; margin-bottom: 50px;">
				<div class="col-md-offset-2 col-md-8 col-xs-offset-1 col-xs-10">

					<h5>OR Repost a job (up to 60 days old):</h5>
					<select id='former_job' class="form-control" >
						<option value='NA'>SELECT FORMER JOB POST</option>"
<?php			
						foreach($former_jobs as $row) {
?>
							<option value='<? echo $row['jobID'] ?>'><? echo $row['title']." - ".date('M j, Y', strtotime($row['date_created'])) ?></option>
<?php
						}
?>
					</select>
				</div>
			</div>
<?php
		}
?>	
<?php
		if ($current_posts > 0) {
?>						
			<div class="row all_main_back text-center" style="margin-top: 35px; margin-bottom: 15px;">
				<a href='#' class='btn btn-primary selection_back' id='boh_back'><i class="fa fa-arrow-circle-left" aria-hidden="true" style="background-color: transparent"></i> Back </a>
			</div>
<?php	
		}
?>		
	</div>

	<div id='foh_post_options' class='row post_options' style="margin-top:10px; <? echo $foh_display ?>">

		<div id='col-md-12'>
			<h5 style="text-align:center">Select a Job Category: </h3>		
		</div>
		
		<div class="row">
			<div class="col-md-offset-2 col-md-8 col-md-12">
				<div class="col-md-4 col-xs-6" style="margin-top: 5px">
					<button type="button" id='Bartender' class="main_skill btn btn-primary btn-lg btn-block"><i class="fa fa-check-circle-o" aria-hidden="true" style="background-color: transparent"></i> Bartender</button>
				</div>
				<div class="col-md-4 col-xs-6" style="margin-top: 5px">
					<button type="button" id='Manager' class="main_skill btn btn-primary btn-lg btn-block"><i class="fa fa-check-circle-o" aria-hidden="true" style="background-color: transparent"></i> Manager</button>
				</div>
				<div class="col-md-4 col-xs-6" style="margin-top: 5px">
					<button type="button" id='Server' class="main_skill btn btn-primary btn-lg btn-block"><i class="fa fa-check-circle-o" aria-hidden="true" style="background-color: transparent"></i> Server</button>
				</div>

				<div class="col-md-4 col-xs-6" style="margin-top: 5px">
					<button type="button" id='Host' class="main_skill btn btn-primary btn-lg btn-block"><i class="fa fa-check-circle-o" aria-hidden="true" style="background-color: transparent"></i> Host</button>
				</div>
				<div class="col-md-4 col-xs-6" style="margin-top: 5px">
					<button type="button" id='Bus' class="main_skill btn btn-primary btn-lg btn-block"><i class="fa fa-check-circle-o" aria-hidden="true" style="background-color: transparent"></i> Bus</button>
				</div>
			</div>	
		</div>
<?php
		if (count($former_jobs) > 0) {
?>
			<div class="row" style="margin-top: 15px; margin-bottom: 50px;">
				<div class="col-md-offset-2 col-md-8 col-xs-offset-1 col-xs-10">

					<h5>OR Repost a job (up to 60 days old):</h5>
					<select id='former_job' class="form-control" >
						<option value='NA'>SELECT FORMER JOB POST</option>"
<?php			
						foreach($former_jobs as $row) {
?>
							<option value='<? echo $row['jobID'] ?>'><? echo $row['title']." - ".date('M j, Y', strtotime($row['date_created'])) ?></option>
<?php
						}
?>
					</select>
				</div>
			</div>
<?php
		}

		if ($current_posts > 0) {
?>						
			<div class="row all_main_back text-center" style="margin-top: 15px; margin-bottom: 15px;">
				<a href='#' class='btn btn-primary selection_back' id='foh_back'><i class="fa fa-arrow-circle-left" aria-hidden="true" style="background-color: transparent"></i> Back </a>
			</div>
<?php	
		}
?>	
	</div>
		
	<div id='job_template_holder' class='job_post_holder row post_options text-center'>
		<div class="col-md-offset-2 col-md-8">
			<div class='job_templates'></div><br />
			<a href='#' class='btn btn-large btn-danger different job_type_graphic <? echo $back ?>' style="display: none; margin-bottom: 20px" > <i class="fa fa-arrow-circle-left" aria-hidden="true" style="background-color: transparent"></i> BACK</a>
		</div>
	</div>
	
	<div class='row job_post_holder cost_details' style="margin-bottom: 20px">
<?php
		if ($group_details['post_status'] != "posted") {
?>	
				<div class="col-md-offset-3 col-md-2 col-xs-offset-1 col-xs-6">
					<h3 style="margin-bottom:0px; margin-top: 0px">TOTAL COST</h3>
				</div>
				<div class="col-md-6 col-xs-5 text-right">
					<h3 style="margin-bottom:0px; margin-top: 0px; text-align:center;"><span id='cost'><? echo $cost ?></span></h3>
				</div>
<?php
		}
?>
	</div>
	
<?php

		if ($region_status != "free") {
			if ($group_details['post_status'] != "posted") {
?>			
				<div class='row job_post_holder cost_details' >
<?php
					if ($checkout_test == "Y") {
						if ($email_verification == "Y") {
?>
							<div class="col-md-12 text-center" style="margin-top:15px;">
	 							<a href='#' class='btn btn-large btn-success checkout_holder' id='customButton'> <i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> CHECKOUT & POST JOB(S)</a>								
	 							<br /> &nbsp; <br /><img src='images/outline.png' height='26px' width='119px' alt='stripe' class="img-responsive center-block">
							</div>
							
							<div class="col-md-12 text-center" style="margin-top:15px;">
								<i>By clicking 'Checkout and Post' you agree to our full <a href='index.php?page=TOS'>Terms of Service</a> and <a href='index.php?page=privacy_policy'>Privacy Policy</a></i><br />
							</div><br />
<?php
							if ($remaining_posts > 0) {
?>
								<div class="col-md-12 col-xs-12 text-center" style="margin-bottom: 10px;">
										<b>*IMPORTANT</b> - Unused openings DO NOT carry over as credits for future jobs posts<br />
								</div>
<?php
							}
?>
							
<?php
						} else {
?>
							<div class="col-md-12 text-center" style="margin-top:15px;">
	 							<a href='#' class='btn btn-large btn-success checkout_holder' id='verify_email_warning'> <i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> CHECKOUT & POST JOB(S)</a>								
	 							<br /> &nbsp; <br /><img src='images/outline.png' height='26px' width='119px' alt='stripe' class="img-responsive center-block">

							</div><br />&nbsp; <br />
<?php
						}					
					} else {
?>
						<div class="col-md-12 text-center" style="margin-bottom: 20px;">
							<a href='#' class='btn btn-large btn-success checkout_holder' id='no_save' disabled >Checkout and Post Job(s)</a><br /> &nbsp; <br />
							<font color='red'><i>You must select at least <? echo $remain_text ?> opening(s) to check out with this type of post.</i></font><br /> &nbsp; <br />					
						</div>
<?php
					}
?>	
<!--
					<div class="col-md-12 text-center" style="margin-bottom: 25px">
						**<i>Craigslist Group posts are typically published on the next available Tuesday or Thursday, based on the number of current regional posts.</i>				
					</div>
-->
<?php		
				} 	
			} else {
				if ($group_details['post_status'] != "posted") {				
?>
					<div class='job_post_holder row' style="margin-top:5px; text-align:center;">
<?php
						if ($checkout_test == "Y") {
							if ($email_verification == "Y") {
?>
								<div class="col-md-12 text-center" style="margin-top:15px;">
			 						<a href='#' class='btn btn-large btn-success checkout_holder' id='free_post'> <i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> POST JOB(S)</a>								
								</div><br />&nbsp; <br />
								<div class="col-md-12 text-center" style="margin-top:30px;">
									<i>By clicking 'Checkout and Post' you agree to our full <a href='index.php?page=TOS'>Terms of Service</a> and <a href='index.php?page=privacy_policy'>Privacy Policy</a></i><br />
								</div><br />
<?php
							} else {
?>
			 					<a href='#' class='btn btn-large btn-primary checkout_holder' id='verify_email_warning' style="background-color:#2e6652;"> <img src='images/savegreen.png' height='25px' width='25px' alt='check' style="vertical-align:middle"> POST JOB(S)</a>										
<?php
							}				
?>	
								&nbsp; <br /> <br />
<?php
						} else {
?>
							<div class='job_post_holder row cost_details' style="margin-top:5px; margin-bottom: 30px;">
								<div class="col-md-12 text-center">
									<a href='#' class='btn btn-large btn-success checkout_holder' id='no_save' disabled >Post Job(s)</a><br /> &nbsp; <br />
									<font color='red'><i>You must select at least <? echo $remain_text ?> openings to check out with this type of post.</i></font><br /> &nbsp; <br />					
								</div>
							</div>
<?php
						}				
					}
				}	
?>			
			</div>

			<div class="row" id='verification_warning' style="display:none;">
				<div class="col-md-12 text-center">
					<h4>You must verify your email address by clicking the link sent to <br /><b><? echo $email ?></b></h4>
					<i>You only need to do this for your first job post.</i><br /> <br />
					To resend or change your email address <br /> <a href='main.php?page=verify_email'><h4>CLICK HERE</h4></a><br />
					<a href='#' class='verify_email_warning_back'>BACK</a><br /> <br />

				</div>
			</div>
					
			<div class="row" id='payment_loader' style="display:none;">
				<div class="col-md-12 text-center" style="margin-top:60px;">
					<h2>Processing Payment..</h4>
					<h4>This may take a few minutes</h4>
					<h4>PLEASE DO NOT PRESS THE BACK BUTTON</h4>
				</div>
			</div>
							
			<div class="row" id='free_loader' style="display:none;">
				<div class="col-md-12 text-center" style="margin-top:60px;">
					<h2>Posting Jobs....</h4>
					<h4>This may take a few minutes</h4>
					<h4>PLEASE DO NOT PRESS THE BACK BUTTON</h4>
				</div>
			</div>					
				
			<div class="row" id='payment_error' style="display:none;">
				<div class="col-md-12 text-center" style="color:red; margin-top:0px;">
					<h2>Payment Error</h4>
					<h4>There was a problem processing your payment</h4>
					<h4>Please click BACK or refresh your page.</h4>
					<b>Contact:  admin@servebartendcook.com</b>
				</div>
			</div>
<?php 
	
}
	
function job_html_employer_template_edit($page, $job_data, $store_array, $sub_specialty_array, $template_requirements_array, $template_questions_array) {	

	$utilities = new Utilities;				
//==================================
//!  First break master arrays into trait arrays
//
//  Modify any data for presentation
//==================================

		$templateID					= $job_data['general']['template'];
		$jobID							= $job_data['general']['jobID'];
		$store_name					= $job_data['store']['name'];
		$storeID						= $job_data['store']['storeID'];
		$title		 						= $job_data['general']['title'];
		$requirements		 		= $job_data['requirements'];
		$notes							= $job_data['general']['description'];
		$qualifications				= $$job_data['general']['qualifications'];
		$main_skill		 			= $job_data['skills']['main_skill']['specialty'];
		$specialtyID			 		= $job_data['skills']['main_skill']['ID'];
		$benefits						= $job_data['general']['benefits'];
		$benefits_desc				= $job_data['general']['benefits_desc'];
		$walkin							= $job_data['general']['walkin'];
		$walkin_desc					= $job_data['general']['walkin_desc'];
		$schedule						= $job_data['general']['schedule'];
		$comp_type					= $job_data['general']['comp_type'];
		$comp_value					= $job_data['general']['comp_value'];
		$comp_value_high			= $job_data['general']['comp_value_high'];
		$comp_value_low			= $job_data['general']['comp_value_low'];		
		$question_array				= $job_data['question_list']['questions'];
		$answer_array				= $job_data['question_list']['answers'];	
		$sub_skills						= $job_data['skills']['sub_skills'];
		$date_created				= $job_data['general']['date_created'];
		$expiration_date			= $job_data['general']['expiration_date'];

		if ($templateID == "") {
			$templateID = "custom";
			$description_rows = "12";
		} else {
			$description_rows = "6";
		}

		if ($page == "Expired") {
			$job_status = "Expired";
		} else {
			$job_status = $job_data['general']['job_status'];			
		}		
		
		if($comp_value > 0 && $comp_value_high == "" && $comp_value_low == "") {
			if ($comp_value_high == 0 && $comp_value_low == 0) {
				$comp_value_high = $comp_value;
			}
		}
		
		if ($comp_value_high == 0 && $comp_value_low == 0) {
			$comp_value_high = $comp_value_low = "";
		}

		if ($benefits == "Y") {
			$benefits_text =	"<div style='float:left; width:350px;'>Yes<br /><i>".$benefits_desc."</i></div><br />";
		} else {
			$benefits_text = 	"None<br />";				
		}
								
		if ($notes == "") {
			$notes_text = "<i>None Entered</i>";
		} else {
			$notes_text = $notes;
		}
				

//==================================
//!  Display
//
//  Display is broken into separate functions for each specific section, this is for the use of AJAX to reload specific section of page on changes
//
//
//==================================
?>
	<div class='container'>
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-9 col-md-offset-3">
<?php
			if ($job_status == "Open") {
?>
				<div class='row job_details' style="margin-top:30px">
					<div class="col-md-8 text-center">
<!-- 						<h4>Posted: <? echo date('m-d-Y', strtotime($date_created))."  <br />Expires: ".date('m-d-Y', strtotime($expiration_date)) ?></h4> -->
						<a href='opportunity.php?ID=<? echo $jobID ?>' class='btn btn-lg btn-success'>View Job Post</a><br /> &nbsp; <br />		
					</div>
				</div>
<?php
			} elseif ($job_status == "Expired") {
?>
				<div class='row job_details' style="margin-bottom:10px">
					<div class="col-md-12 text-center">
						<h3 style="display:inline">This Posting Has Expired</h3>
					</div>
				</div>
<?php
			} elseif ($job_status == "Filled") {
?>
				<div class='row job_details' style="margin-bottom:10px">
					<div class="col-md-12 text-center">
						<h3 style="display:inline">Position Filled</h3>
					</div>
				</div>
<?php	
			} else {
?>
				<h2 style="color:black">Please Review and Edit Your Job Details</h2>	
<?php
			}
?>		
				</div>	
			</div>

		<div class='row job_details' style="margin-bottom:12px">
			<div class="col-md-10 col-md-offset-2">
<?php
			if ($templateID == "custom_b") {
?>
				<h4>General Details</h4>
<?php			
			} else {
?>
				<h4>General Details - <? echo $main_skill ?> Position</h4>
<?php
			}
?>	
			</div>
		</div>

		<div class=" job_details" id='general_holder' style="font-size:16px;">
			<div class="form-horizontal">
				<div class='error col-md-10 col-md-offset-2' id='title_error' style="color:red; margin-bottom:5px; display:none"><b>Title cannot be blank</b></div>
				<div class="form-group" id="edit_job_title" style="margin-bottom:3px">
				   	<label for="job_title" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label"><i class="fa fa-circle-thin" aria-hidden="true" style="background-color: transparent"></i> Job Title</label>
				   	<div class="col-md-10 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='text' class='job_title form-control' id='job_title' value='<? echo $title ?>' placeholder='Job Title'><br />
					</div>
				</div>
			</div>

			<div class="form-horizontal">
				<div class="form-group" id="edit_schedule" style="margin-bottom:3px">
				   	<label for="schedule" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label"><i class="fa fa-circle-thin" aria-hidden="true" style="background-color: transparent"></i> Schedule</label>
				   	<div class="col-md-4 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
				   		<select id='schedule' class="form-control schedule">
<?php
							if ($schedule == "Full Time") {
								echo "<option value='Full Time' selected>Full Time</option>";
							} else {
								echo "<option value='Full Time'>Full Time</option>";							
							}
							if ($schedule == "Part Time") {
								echo "<option value='Part Time' selected>Part Time</option>";
							} else {
								echo "<option value='Part Time'>Part Time</option>";							
							}						
							if ($schedule == "Temporary") {
								echo "<option value='Temporary' selected>Temporary</option>";
							} else {
								echo "<option value='Temporary'>Temporary</option>";							
							}	
?>					
						</select><br />	
					</div>
					
				   	<label for="compensation_type" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label"><i class="fa fa-circle-thin" aria-hidden="true" style="background-color: transparent"></i> Wage Type</label>
				   	<div class="col-md-4 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
				   		<select id='compensation_type' class="form-control compensation_type">
<?php
						$comp_display = "display:none";
						$comp_label = "per Hour";

						if ($comp_type == "Min Wage Plus Tips") {
							echo "<option value='Min Wage Plus Tips' selected>Min Wage Plus Tips</option>";
						} else {
							echo "<option value='Min Wage Plus Tips'>Min Wage Plus Tips</option>";							
						}
						if ($comp_type == "Min Wage") {
							echo "<option value='Min Wage' selected>Min Wage</option>";
						} else {
							echo "<option value='Min Wage'>Min Wage</option>";							
						}						
						if ($comp_type == "Hourly" || $comp_type == "") {
							$comp_display = "";
							$comp_label = "per Hour";
							echo "<option value='Hourly' selected>Hourly</option>";
						} else {
							echo "<option value='Hourly'>Hourly</option>";							
						}		
						if ($comp_type == "Salary") {
							$comp_display = "";
							$comp_label = "per Year";
							echo "<option value='Salary' selected>Annual Salary</option>";
						} else {
							echo "<option value='Salary'>Annual Salary</option>";							
						}						
						if ($comp_type == "Negotiable") {
							echo "<option value='Negotiable' selected>Negotiable</option>";
						} else {
							echo "<option value='Negotiable'>Negotiable</option>";							
						}																		
?>					
						</select><br />	
					</div>
				</div>
			</div>

			<div class="form-horizontal" id="comp_value_holder" style="<? echo $comp_display ?>">
				<div class='error col-md-10 col-md-offset-2' id='compensation_error' style="color:red; margin-bottom:5px; display:none"><b>Wage cannot be blank, must be a number</b></div>
	            <div class="form-group" id="wage_form">
	                <label for="wage_amount" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label"><i class="fa fa-circle-thin" aria-hidden="true" style="background-color: transparent"></i> Wage Amount</label>
	                <div class="col-md-4 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
		                <div class="input-group">
		                    <span class="input-group-addon">$</span>
		                    <input type="text" class="form-control" id="wage_amount_high" value="<? echo $comp_value_low ?>">
		                    <span class="input-group-addon comp_label" id="comp_label"><? echo $comp_label ?></span>
		                </div>
	                </div>
	                <div class="col-md-2 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0 text-center">
		                TO
	                </div>    
	                <div class="col-md-4 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
		                <div class="input-group">
		                    <span class="input-group-addon">$</span>
		                    <input type="text" class="form-control" id="wage_amount_low" value="<? echo $comp_value_high ?>">
		                    <span class="input-group-addon comp_label"><? echo $comp_label ?></span>
		                </div>	  
	                </div>              
	            </div>
	         </div>

			<div class="form-horizontal">
				<div class="form-group" id="edit_benefits" style="margin-bottom:3px">
				   	<label for="benefits" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label"><i class="fa fa-circle-thin" aria-hidden="true" style="background-color: transparent"></i> Benefits</label>
				   	<div class="col-md-2 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
				   		<select id='benefits' class="form-control benefits">
<?php
							$benefits_display = "style='display:none;'";
							if ($benefits == "Y") {
								echo "<option value='Y' selected>Yes</option>";
								$benefits_display = "";					
							} else {
								echo "<option value='Y'>Yes</option>";							
							}
							if ($benefits == "N" || $benefits == "") {
								echo "<option value='N' selected>None</option>";
							} else {
								echo "<option value='N'>None</option>";							
							}				
?>		
						</select><br />
					</div>
				   	<div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
					   	<div class="col-md-12" id='charNum_benefits' style="color:red; margin-bottom:2px;"></div> <!-- //Holder for character counter -->
						<textarea class="form-control" id="benefits_description" rows="3" <? echo $benefits_display ?> placeholder="Description of benefits offered" maxlength='250'><? echo $benefits_desc ?></textarea><br />
					</div>
				</div>
			</div>

			<div class="form-horizontal">
				<div class="form-group" id="edit_walkin" style="margin-bottom:3px">
				   	<label for="walkin" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label"><i class="fa fa-circle-thin" aria-hidden="true" style="background-color: transparent"></i> Allow Walk-ins</label>
				   	<div class="col-md-2 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
				   		<select id='walkin' class="form-control walkin">
<?php
							$walkin_display = "style='display:none;'";
							if ($walkin == "Y") {
								echo "<option value='Y' selected>Yes</option>";
								$walkin_display = "";					
							} else {
								echo "<option value='Y'>Yes</option>";							
							}
							if ($walkin == "N" || $walkin == "") {
								echo "<option value='N' selected>No</option>";
							} else {
								echo "<option value='N'>No</option>";							
							}				
?>		
						</select><br />
					</div>
				   	<div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
					   	<div class="col-md-12" id='charNum_walkin' style="color:red; margin-bottom:2px;"></div> <!-- //Holder for character counter -->
						<textarea class="form-control" id="walkin_description" rows="3" <? echo $walkin_display ?> placeholder="What day and time should a candidate come in to apply" maxlength='250'><? echo $walkin_desc ?></textarea><br />
					</div>
				</div>
			</div>

		</div><br />
<?php
	if ($templateID != "custom_b") {
?>
		<div class='row job_details' style="margin-bottom:12px">
			<div class="col-md-10 col-md-offset-2">
				<h4>Preferred Job Skills</h4>
			</div>
		</div>
		
		<div class="row main_row job_details skills_row" style='font-size:16px; margin-bottom:12px'>		
			<div class="col-md-10 col-md-offset-2">
				<div class="row">
<?php
					foreach ($sub_specialty_array as $row) {
						$active = "";
						$check = "display:none";
						$circle = "";

						foreach($sub_skills as $sub_specialty) {
							if (html_entity_decode($sub_specialty['sub_specialty']) == html_entity_decode($row['skill'])) {
								$active = "active";
								$circle = "display:none";
								$check = "";
							}
						}
						echo "<div class='col-md-5' style='margin-bottom:10px'>";
							echo "<button type='button' class='sub_skill_button btn btn-default btn-block ".$active."' id='".$row['skill']."' style='white-space: normal;'><i class='fa fa-check' aria-hidden='true' style='".$check."'></i><i class='fa fa-circle-thin' aria-hidden='true' style='".$circle."'></i> ".$row['skill']."</button>";
						echo "</div>";
					}					
?>
				</div>
			</div>
		</div>

		<div class='row job_details' style="margin-bottom:12px">
			<div class="col-md-10 col-md-offset-2">
				<h4>Other Requirements</h4>
			</div>
		</div>
		
		<div class="row main_row job_details requirements_row" style='font-size:16px; margin-bottom:12px'>		
			<div class="col-md-10 col-md-offset-2">
					<div class='row' style="margin-bottom: 10px">
						<div class="col-md-10 text-center">
							GENERAL
						</div>
					</div>
<?php
					foreach ($template_requirements_array as $row) {
					$active = "";
					$check = "display:none";
					$circle = "";

						foreach($requirements as $req) {
							if ($req['requirement'] == $row['requirement']) {
								$active = "active";
								$circle = "display:none";
								$check = "";
							}
						}
						
						if ($row['type'] == "General") {								
							echo "<div class='col-md-5' style='margin-bottom:10px'>";
								echo "<button type='button' class='requirement btn btn-default btn-block ".$active."' id='".$row['requirement']."' style='word-wrap:break-word; whitespace:normal;'><i class='fa fa-check' aria-hidden='true' style='".$check."'></i><i class='fa fa-circle-thin' aria-hidden='true' style='".$circle."'></i> ".$row['requirement']."</button>";
							echo "</div>";
						}
					}
						
					if ($main_skill == "Kitchen" || $main_skill == "Manager") {
?>
						<div class='row' style="margin-bottom: 10px">
							<div class="col-md-10 text-center">
								BACK OF HOUSE
							</div>
						</div>
<?php
						
						foreach ($template_requirements_array as $row) {
							$active = "";
							$check = "display:none";
							$circle = "";

							foreach($requirements as $req) {
								if ($req['requirement'] == $row['requirement']) {
									$active = "active";
									$circle = "display:none";
									$check = "";
								}
							}

							
							if ($row['type'] == "Back") {	
								echo "<div class='col-md-5' style='margin-bottom:10px'>";
									echo "<button type='button' class='requirement btn btn-default btn-block ".$active."' id='".$row['requirement']."' style='word-wrap:break-word; whitespace:normal;'><i class='fa fa-check' aria-hidden='true' style='".$check."'></i><i class='fa fa-circle-thin' aria-hidden='true' style='".$circle."'></i> ".$row['requirement']."</button>";
								echo "</div>";
							}
						}
					}	
					
					if ($main_skill == "Server" || $main_skill == "Manager" || $main_skill == "Bartender" || $main_skill == "Host" || $main_skill == "Bus") {				
?>
						<div class='row' style="margin-bottom: 10px">
							<div class="col-md-10 text-center">
								FRONT OF HOUSE
							</div>
						</div>
<?php
						
						foreach ($template_requirements_array as $row) {
							$active = "";
							$check = "display:none";
							$circle = "";

							foreach($requirements as $req) {
								if ($req['requirement'] == $row['requirement']) {
									$active = "active";
									$circle = "display:none";
									$check = "";
								}
							}

							
							if ($row['type'] == "Front") {	
								echo "<div class='col-md-5' style='margin-bottom:10px'>";
									echo "<button type='button' class='requirement btn btn-default btn-block ".$active."' id='".$row['requirement']."' style='word-wrap:break-word !important; whitespace:normal !important;'><i class='fa fa-check' aria-hidden='true' style='".$check."'></i><i class='fa fa-circle-thin' aria-hidden='true' style='".$circle."'></i> ".$row['requirement']."</button>";
								echo "</div>";
							}
						}
					}					
?>
				</div>
		</div>
		
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-10 col-md-offset-2">
				<a name="questions"></a><h4 style='margin-bottom:3px'>Pre-Interview Questions</h4>
<?php
				if ($job_status == "template_edit" || $job_status == "custom_edit") {	
?>
					<i>You may add up to 3 questions</i>
<?php					
				} else {
?>
					<i>Questions cannot be changed on open jobs</i>
<?php					
				}			
?>				    
			</div>
		</div>
<?php
		//must be separate function as AJAX reloads this div when questions are edited		
		display_questions_section($job_status, $question_array, $template_questions_array, $main_skill);
	}
?>		
		<div class='row job_details' >
			<div class="col-md-10 col-md-offset-2">
<?php
			if ($templateID == "custom_b")	{
?>
				<h4>Job Description</h4>
<?php
			} else {
?>
				<h4>Additional Information</h4>
<?php
			}
?>
			</div>
		</div>

		<div class=" job_details" id='description_holder' style="font-size:16px;">
			<div class="form-horizontal">
				<div class="form-group" id="edit_description" style="margin-bottom:3px">
				   	<div class="col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1">
					   	<div class="col-md-12" id='charNum_description' style="color:red; margin-bottom:2px;"></div> <!-- //Holder for character counter -->
						<textarea class="form-control" id="description" rows="<? echo $description_rows ?>" placeholder="Place any additional information here" maxlength='750'><? echo $notes ?></textarea><br />
					</div>
				</div>
			</div>
		</div>

<?php
		if ($job_status == "Open") {
?>
			<input type="hidden" id="specialtyID_hidden" value="<? echo $specialtyID ?>">				
			<input type='hidden' id='main_skill_hidden' value='<? echo $main_skill ?>'>
	
			<div class="row job_details" style="margin-bottom:45px">
				<div class="col-md-12 text-center">
					<h2>Finished Editing?</h4>

					<button type="button" class="btn btn-success btn-large continue">
						Save Changes <i class="fa fa-arrow-circle-right" aria-hidden="true" style="background-color: transparent"></i>
					</button>
					
					<a href="job.php?ID=new_job&page=templates&groupID=<? echo $job_data['general']['groupID'] ?>"><button type="button" class="btn btn-danger">
						 Cancel
					</button></a> <br /> &nbsp; <br />
				</div>
			</div>							
<?php
		} elseif ($job_status == "Filled") {
				//echo "<h2 style='display:inline; float:left;'>TO SAVE EDITS PLEASE 'UNFILL' POSITION ABOVE</h4>";	
		} elseif ($job_status == "Expired") {
?>
			<div class="row job_details" style="margin-bottom:45px">
				<h2>This job post has expired</h2>
			</div>
<?php
		} else {
?>
<!--
				<div style="float:left; width:100%; text-align:center;"></div>
					<div id='complete_error' style="color:red; float:left; display:none"><b>Please make sure that all fields above are complete, and you've clicked 'save' for each of them.</b></div><br />		
					<div id='open_warning' style="color:red; float:left; margin-bottom:10px; width:100%; text-align:center; display:none"><b>TO CONTINUE:  Please click 'Save' or 'Cancel' on these sections above:.</b><br />		
					<div id='edit_general_form_warning' class='open_warning_holder' style="float:left; text-align:center; display:none; width:100%;"><b>GENERAL DETAILS</b><br /></div>
					<div id='edit_skills_form_warning' class='open_warning_holder' style="float:left; text-align:center; display:none; width:100%;"><b>JOB SKILLS</b><br /></div>
					<div id='edit_requirements_form_warning' class='open_warning_holder' style="float:left; text-align:center; display:none; width:100%;"><b>OTHER REQUIREMENTS</b><br /></div>
					<div id='edit_notes_form_warning' class='open_warning_holder' style="float:left; text-align:center; display:none; width:100%;"><b>ADDITIONAL INFORMATION</b><br /></div>
					<div id='edit_questions_form_warning' class='open_warning_holder' style="float:left; text-align:center; display:none; width:100%;"><b>PRE-INTERVIEW QUESTIONS</b><br /></div>
				</div>
-->
				
				<input type="hidden" id="specialtyID_hidden" value="<? echo $specialtyID ?>">				
				<input type='hidden' id='main_skill_hidden' value='<? echo $main_skill ?>'>
	
				<div class="row job_details" style="margin-bottom:45px">
					<div class="col-md-12 text-center">
						<h2>Finished Editing?</h4>

						<button type="button" class="btn btn-success btn-large continue">
							Next Step <i class="fa fa-arrow-circle-right" aria-hidden="true" style="background-color: transparent"></i>
						</button>
						
						<button type="button" class="btn btn-danger remove_job" id='<? echo $jobID ?>'>
							<i class="fa fa-trash-o" aria-hidden="true"></i> Delete Job
						</button> <br /> &nbsp; <br />
						<i>You will have another opportunity to edit jobs before checking out</i>
					</div>
				</div>							
				
<!-- 				<div style="width:100%; margin-bottom:15px; margin-top:8px; width:100%; text-align:center; float:left;"><a href='opportunity.php?ID=<? echo $jobID ?>' class='btn btn-primary'>Preview Job Post</a></div> -->
<!--
				<div style="width:100%; margin-bottom:7px; margin-top:8px; width:100%; text-align:center; float:left;"><a href='#' class='continue btn btn-large btn-success' >NEXT STEP</a> <i class="fa fa-arrow-circle-right" aria-hidden="true" style="background-color: transparent"></div><br />
				<div style="width:100%; margin-bottom:7px; margin-top:8px; width:100%; text-align:center; float:left;"><a href='#' class='remove_job' id='<? echo $jobID ?>'>Delete Job</a></div><br />
-->
<?php
			}
?>		
		<table class='dark' style="width:100%; margin-top:2px;">
			<tr valign='middle'>
				<th valign='middle'></th>
			</tr>		
		</table>
		
		</div>	
	</div>
<?php												
}


//KEEEEEEEPPP!!!!!!!!!
function display_questions_section($job_status, $question_array, $template_questions_array, $main_skill) {
?>
		<div class=" main_row questions_row" style='font-size:16px; margin-bottom:0px'>		
			<div class="form-horizontal">
				<div class="form-group">
<?php			
				if (count($question_array) > 0) {
					$count = 1;
					foreach ($question_array as $row) {
						if ($row['template_questionID']	== 0) {
							$question = $row['question'];
						} else {
							$question = "";
						}
						
?>
						<div class="question_holder">
							<label for="question_<? echo $row['questionID'] ?>" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label"><i class="fa fa-circle-thin" aria-hidden="true" style="background-color: transparent"></i> Question <? echo $count ?></label>
						    <div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
							    <p class="form-control-static">
<?php
								if ($job_status == "template_edit" || $job_status == "custom_edit") {				
?>				    
								    <a href="#" class="edit_question" id="<? echo $row['questionID'] ?>"><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>
<?php
								}
?>    
								<? echo $row['question'] ?></p>
						    </div>
						</div>

						<div class="edit_question_holder" id="edit_question_holder_<? echo $row['questionID'] ?>" style="display:none">					    
						    <label for="edit_general_question" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">General Questions:</label>
						    <div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
								<select class="form-control edit_general_question" id="<? echo $row['questionID'] ?>">
									<option value='NA'>--Select a Question--</option>	
<?php
									foreach($template_questions_array as $question_row) {
										if ($question_row['type'] == "General") {
											if ($question_row['questionID'] == $row['template_questionID']) {
												$selected = "selected";
											} else {
												$selected = "";
											}
											echo "<option value='".$question_row['questionID']."' $selected >".$question_row['question']."</option>";	
										}
									}
?>
								</select><br />
						    </div>
	
						    <label for="edit_specific_question" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label"><? echo $main_skill ?> Questions:</b></label>					    
						    <div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
								<select class="form-control edit_specific_question" id="<? echo $row['questionID'] ?>">
									<option value='NA'>--Select a Question--</option>	
<?php
										foreach($template_questions_array as $question_row) {
											if ($question_row['type'] == $main_skill) {
												if ($question_row['questionID'] == $row['template_questionID']) {
													$selected = "selected";
												} else {
													$selected = "";
												}

												echo "<option value='".$question_row['questionID']."' $selected >".$question_row['question']."</option>";	
											}
										}
?>
									</select>
							</div> &nbsp; <br />
	
								<div class="col-md-12 col-xs-12 text-center" style="margin-top:10px">
									OR Write your own question
								</div>
							
							<div class="row">
								<div class="form-horizontal">
									<div class="form-group" class="edit_custom_question">
									   	<div class="col-md-10 col-md-offset-2 col-xs-10 col-xs-offset-1">
										   	<div class="col-md-12" id='charNum_edit_question' style="color:red; margin-bottom:2px;"></div> <!-- //Holder for character counter -->
											<textarea class="form-control edit_question_box" id="custom_question_<? echo $row['questionID'] ?>" rows="3" placeholder="Type question here" maxlength='250'><? echo $question ?></textarea><br />
										</div>
									</div>
								</div>
							</div>
	
							<div class="row" style="margin-bottom:25px">
								<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
									<button type="button" class="btn btn-success save_question_edit" id='<? echo $row['questionID'] ?>'>
										<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save Question
									</button>
									
									<button type="button" class="btn btn-danger remove_question" id='<? echo $row['questionID'] ?>'>
										<i class="fa fa-trash-o" aria-hidden="true"></i></i> Delete Question
									</button>
			
									<button type="button" class="btn btn-link cancel_edit_question" style="color:#8e080b;">
										Cancel
									</button>
								</div>
							</div>		
						</div>					
<?php
						$count++;
					}
				}				
?>	
				</div>
			</div>	

<?php 
			if ($count <= 3) {
				if ($job_status == "template_edit" || $job_status == "custom_edit") {
?>
					<div class="row question_holder" id='new_question_button_holder' style="margin-bottom: 25px; margin-top:0px; cursor:pointer">
						<div class='col-md-10 col-md-offset-2 col-xs-10 col-xs-offset-1' id='add_question_button'>
							<h4 style="margin-top:0px;"><i class="fa fa-plus" aria-hidden="true"></i> Add Question</h4>
						</div>
					</div>
<?php					
				}
			}	
?>
<!-- 	</div> -->
			
		<div class=" main_row add_question_row " style="font-size:16px; margin-bottom:0px; display:none">		
			<div class="form-horizontal">
				<div class="form-group">

					<div class="add_question_holder" id="add_question_holder">					    
						    <label for="add_general_question" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">General Questions:</label>
						    <div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
								<select id='add_general_question' class="form-control">
									<option value='NA'>--Select a Question--</option>	
<?php
									foreach($template_questions_array as $question_row) {
										if ($question_row['type'] == "General") {
											echo "<option value='".$question_row['questionID']."' >".$question_row['question']."</option>";	
										}
									}
?>
								</select><br />
						    </div>
	
						    <label for="add_specific_question" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label"><? echo $main_skill ?> Questions:</b></label>					    
						    <div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
								<select id='add_specific_question' class="form-control">
									<option value='NA'>--Select a Question--</option>	
<?php
										foreach($template_questions_array as $question_row) {
											if ($question_row['type'] == $main_skill) {
												echo "<option value='".$question_row['questionID']."' >".$question_row['question']."</option>";	
											}
										}
?>
									</select>
							</div> &nbsp; <br />
	
								<div class="col-md-12 col-xs-12 text-center" style="margin-top:10px">
									OR Write your own question
								</div>
							
							<div class="row">
								<div class="form-horizontal">
									<div class="form-group" class="add_custom_question">
									   	<div class="col-md-10 col-md-offset-2 col-xs-10 col-xs-offset-1">
									   		<div class="col-md-12" id='charNum_add_question' style="color:red; margin-bottom:2px;"></div> <!-- //Holder for character counter -->
											<textarea class="form-control add_question_box" id="add_custom_question" rows="3" placeholder="Type question here" maxlength='250'></textarea><br />
										</div>
									</div>
								</div>
							</div>
	
							<div class="row" style="margin-bottom:25px">
								<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
									<button type="button" class="btn btn-success save_question_add">
										<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save Question
									</button>
			
									<button type="button" class="btn btn-link cancel_add_question" style="color:#8e080b;">
										Cancel
									</button>
								</div>
							</div>		
						</div>					
				</div>
			</div>				
						
		</div>
	</div>
<?php
}


function job_html_employer_final_step($jobID, $title) {	
?>				
	<div class='main_box'>
		<div id='step_one'>
			<table class='dark' style="width:100%;">
				<tr valign='middle'>
					<th valign='middle'><h4><? echo $title ?></h4></th>
				</tr>		
			</table>

			<div style="margin-bottom:5px;">
				<h3>Please Review the Terms and Rules below:</h3>				
					<ul style="font-size:16px;">
						<li style="margin-bottom:10px;">Candidates within 40 miles of your location will be able to view this job post. If they are interested, they can allow you to view their profile and contact information.</li>
						<li style="margin-bottom:10px;">When a candidate applies, you will be notified via email, and on this site. You can choose to contact them on your own via email or by phone.</li>
						<li style="margin-bottom:10px;">Job postings remain open for 28 days.</li>
						<li style="margin-bottom:10px;">After you submit your job post, editing of job post is limited.</li>
						<li style="margin-bottom:10px;">To comply with anti-discrimination laws, please do NOT reference gender, race or age in your job post.</li>
						<li style="margin-bottom:10px; color:red;">If your Job post contains any inappropriate content, the post will be immediately removed and your account may be suspended or removed.</li>
						<li style="margin-bottom:10px;">By clicking 'Post Job' you agree to all of the above, as well as all <a href='index.php?page=TOS'>Terms of Service</a> and the <a href='index.php?page=privacy_policy'>Privacy Policy</a>.</li>
					</ul>	
				&nbsp; <br />
					<div class='final_step' style="margin-bottom:5px; margin-top:10px; text-align:center">				
						<a href='#' class='btn btn-large btn-primary' id='match'>POST JOB</a><br />
						&nbsp; <br />
						Or <br/>
						 <h5><a href='opportunity.php?ID=<? echo $jobID ?>'>Preview Job Post</a></h5>					
						 <h5><a href='#' id='edit'>Edit Job Post</a></h5>
					</div>
				</div>
			</div>
		</div>
<?php
}

function job_html_email_warning($email, $valid) {
?>	
	<div style="float:left; width:100%; text-align:center;">
		<h3>Verification Email</h2><br />
		<div style="float:left; width:100%; padding-left:3px; padding-right:3px;" id='email_header'>
<?php
			if ($valid == 'Y') {
?>
				<h4>You must verify your email address by clicking the link sent to <b><? echo $email ?></b></h4>
				<i>You only need to do this for your first job post.</i><br /> <br />
				
				<div class='selected_job_titles' id='edit' style="float:left; margin-left:12%; width:70%">Click here to edit your job post.</div> <br />
					<a href='main.php'><div class='selected_job_titles' style="float:left; margin-left:12%;width:70%; margin-bottom:10px">Click here to return to the main menu.</div></a>
					<br />
					<br />
					<br />
					<br />
					To resend or change your email address <br /> <a href='main.php?page=verify_email'>CLICK HERE</a>
<?php
			} else {
?>
				<h4>There was a problem sending a verification to your email address.  Please try again, or contact admin@servebartendcook.com</h4>
<?php
			}
?>
		</div>	
	</div>
<?php	
}	


function job_html_group_receipt($groupID, $group_job_list, $store_name, $receipt_data) {

		$receiptID = $_GET['receiptID'];
		
		if ($receipt_data != "free") {
			$payment_amount = $receipt_data['payment_amount'];
			$payment_date = $receipt_data['date'];			
		}
		
//==================================
//!  Display
//==================================
?>
	<div class='container'>
		<div class='row text-center' >
			<h2><? echo $store_name ?></h2>		
		</div>
	
		<div class="row" id="job_listing">
<?php
		if ($receipt_data == "free") {
?>
			<div class="col-md-12 col-xs-12 text-center">
				<h2 style="margin-top:15px; text-align:center;">Jobs Successfully Posted</h2><br />
			</div>
			<div class="col-md-offset-3 col-md-9" style="margin-bottom: 15px;">
				<b>Jobs Posted for <?php echo $store_name ?> </b>
			</div>

<?php
		} else {
?>
			<div class="col-md-12 col-xs-12 text-center" style="margin-bottom:12px">
				<h4 style="margin-top:15px; text-align:center;">Job Post Payment Receipt</h2>
				<h5>Confirmation Number:  #<? echo $receiptID ?>-<? echo $groupID ?></h4>

			</div>

			<div class="col-md-offset-3 col-md-9 col-xs-offset-1 col-xs-10" style="margin-bottom: 15px;">
				<b>Payment Date: <? echo date('M j, Y', strtotime($payment_date)) ?></b><br />
				<b>Payment Amount:  $<? echo $payment_amount ?></b><br />
				<b>Jobs Posted for <?php echo $store_name ?> </b>
			</div>
<?php
		}
	
		echo "</div>";
		
		foreach($group_job_list as $row) {
?>	
			<div class="row">
				<div class="col-md-offset-3 col-md-9 col-xs-offset-1 col-xs-10">	
					&nbsp; &nbsp; &nbsp; <i class="fa fa-circle-thin" aria-hidden="true" style="background-color: transparent"></i><b> <? echo $row['title'] ?></b>
				</div>
			</div>
<?php
		}
?>			
			<br />
			<div class="row">
				<div class="col-md-offset-3 col-md-9 col-xs-offset-1 col-xs-10" style="margin-bottom: 45px;">
					All job postings expire 28 days after posting.  <br />You can view details about your job post from the <a href='main.php'>home page</a>.<br />
					You will be able to view candidates up to 3 days after your job postings expire.
				</div>
			</div>
<?php
		if ($receipt_data != "free") {
?>
			<div class="row">
				<div class="col-md-offset-3 col-md-9 col-xs-offset-1 col-xs-10" style="margin-bottom: 15px;">
					*<i>An email receipt has been sent to the email address that was included with your payment information.</i>
				</div>
			</div>
<?php
		}
?>		
	</div>
<?php
}

function job_html_employer_open($job_data, $last_login, $sub_specialty_array, $candidate_array, $highlight_array) {	
	$utilities = new Utilities;
				
//==================================
//!  First break master arrays into trait arrays
//
//  Modify any data for presentation
//==================================
		$jobID							= $job_data['general']['jobID'];
		$job_status					= $job_data['general']['job_status'];
		$title		 						= $job_data['general']['title'];
		$post_type					= $job_data['general']['post_type'];
		$main_skill		 			= $job_data['skills']['main_skill']['specialty'];
		$expiration_date			= $job_data['general']['expiration_date'];
// 		$reach_count				= $job_data['candidate_count'];
//		$views							= $job_data['view_count'];
		$post_type					= $job_data['general']['post_type'];

		$responses = count($job_data['positive_list']);
		
		//reach thresholds for newer regions
		
		//calculate hours left before expiration
		date_default_timezone_set('America/Los_Angeles');		
		$date1 =  time();
		$date2 = strtotime($expiration_date);
		$hourdiff = ($date2 - $date1) / 3600;
		$expired = "N";
		if ($hourdiff < 0) {
			$expired = "Y";
		}	

		$view_date = date('M j, Y', strtotime("+3days", strtotime($expiration_date)));				

//==================================
//!  Display
//==================================
?>
	<div class='container' >
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-12 text-center">
				<h3 style='margin-bottom:0px;'><? echo $job_data['store']['name'] ?></h3>
				<h4><? echo $title ?></h4>
		
<?php
		if ($expired == "N") {
?>
				<h4 style="margin-bottom:-10px; margin-left:10px">Expires <? echo date('M j, Y', strtotime($expiration_date)) ?></h4>		
<?php
		} else {
?>
				<h4 style="margin-bottom:-10px; margin-left:10px; color:red">POST EXPIRED ON <? echo date('M j, Y', strtotime($expiration_date)) ?></h4>
<?php
		}
?>

			</div>
		</div><br />

		<div class="row" id='button_holder'>	
			<div class="col-md-12">			
				<div class='btn btn-primary toggle' id="filter"><i class="fa fa-filter" aria-hidden="true"></i> Filter Candidates</div>
				<a href='job.php?ID=<? echo $jobID ?>&page=get_link'>
					<div class='btn btn-primary'><i class="fa fa-share-alt-square" aria-hidden="true"></i> Share Job</div>
				</a>		
			</div>
		</div>
		
<?php
//***********
//       CANDIDATE FILTERS		
//***********
?>
		<div class="row holder" id='filter_holder' style="display:none; margin-top:15px;">
<?php
			if ($candidate_array != "Expired") {
?>			
<!--
				<div class="col-md-12" style="margin-bottom:10px">	
					<h4 style=" display:inline;">FILTER CANDIDATES BY SKILL</h4> &nbsp; &nbsp; <h5 style="display:inline;">&nbsp;  <a href='#' class='toggle' id='filter_close'>Hide Filters</a></a>
				</div>
				
				<div class="row">
					<div class="col-md-offset-1 col-md-11 col-xs-offset-0 col-xs-12">
<?php
				foreach ($sub_specialty_array as $row) {	
?>
					<div class="col-md-4 col-xs-6" style='margin-bottom:10px'>
						<button type='button' class='skill_button btn btn-default btn-block' style="white-space: normal;" id='<? echo $row['skill'] ?>' data-skill="<? echo $row['skill'] ?>" data-job_skill_filter="unselected" ><i class='fa fa-check' aria-hidden='true' style='display:none'></i><i class='fa fa-circle-thin' aria-hidden='true' ></i> <? echo $row['skill'] ?></button>
					</div>

				<div >
					<span class='skill_filter_span unselected_button' data-job_skill_filter='unselected' data-skill='<? echo $row['skill'] ?>' style="cursor:pointer;"><? echo $row['skill'] ?></span>
				</div>
-->
<!--
<?php							
				}
?>
					</div>
				</div>
-->

				<div class="row" style="margin-top: 15px">
					<div class="col-md-12 col-xs-11 col-xs-offset-1">
						<h4 style="margin-bottom:2px; margin-left:5px;">EXPERIENCE FILTER</h4>	
					</div>
				</div>
				<div class="row" style="margin-bottom: 25px;">
					<div class="col-md-offset-1 col-md-10 col-xs-offset-1 col-xs-10">	
						<p> <input type='text' id='amount' readonly style="border:0; color:#8d0609; font-weight:bold;"></p>
						<div id='slider1' style="margin-bottom:2px; margin-left:15px;"></div>

					</div>
				</div>
<?php
			} else {
?>
				<div class="row">
					<div class="col-md-12">
						<h4 style="margin-bottom:-5px; margin-left:5px; display:inline;">This Job Post Has Expired</h4> &nbsp; &nbsp; <a href='#' class='toggle' id='filter_close'><b>Hide Filters</b></a>			
					</div>
				</div>
<?php
			}
?>
		</div>
		
		<div class="row" style="margin-top: 10px;">
			<div class="col-md-12">
				<div id='skill_filter_warning' style="float:left; padding-right:25px; color:red; display:none;"><b>Skill filter: ON</b></div>					
			</div>
			<div class="col-md-12">
				<div id='experience_filter_warning' style="float:left; color:red; display:none"><b>Experience filter: ON</b></div>	
			</div>	
			<div class="col-md-12 hidden-xs">
				<font color='red'>NOTICE: Candidate profiles will only be available until <b><? echo $view_date ?></b>. <br />We suggest that you print applications for your records before that date.</font></br />
			</div>	
		</div>

<?php		
		candidate_list($candidate_array, $highlight_array, $last_login);	
?>			
	</div>
<?php									
}

function candidate_list($candidate_array, $highlight_array, $last_login) {
?>
	<div class="row" id='results' style="margin-top:10px">
<?php
		if ($candidate_array != "Expired") {
			if(count($highlight_array) > 0) {		

				//FIRST DISPLAY HIGHLIGHTED CANDIDATES
					foreach ($highlight_array as $candidate) {
	
						if (array_key_exists('past_replies', $candidate) && count($candidate['past_replies']) > 0) {
							$past_reply_note = "<i style='color:green'>Yes</i>";
						} else {
							$past_reply_note = "No";
						}
													
							//turn sub_skill array into comma list/\
							$sub_skill_text = "";	
							if (array_key_exists('sub_skills', $candidate) && count($candidate['sub_skills']) > 0) {
								foreach($candidate['sub_skills'] as $sub_skill) {
									$sub_skill_text .= $sub_skill.", ";
								}
							}	
							

							if ($candidate['photo'] == "") {
								$photo = "";	
								$photo = "<div class='profilephoto' style='min-height:200px; padding-top:35px;'><i class='fa fa-user fa-4x' aria-hidden='true'></i></div>";
								$profile_pic_size = "small";
							} else { 			
								if (file_exists("images/profile_pics/".$candidate['photo'])) {

									$profile_pic_size_array = getimagesize("images/profile_pics/".$candidate['photo']);
									if ($profile_pic_size_array[1] < 200) {
										$profile_pic_size = "small";
									} else {
										$profile_pic_size = "large";
									}
	
									if($profile_pic_size == "small") {
										$photo = "<img src='images/profile_pics/".$candidate['photo']."?".time()."' class='center-block profilephoto' id='main_photo' style='margin-top:35px;'>";
									} else {
				                       $photo = "<img src='images/profile_pics/".$candidate['photo']."?".time()."' class='center-block profilephoto' id='main_photo' style='max-height:150px;max-width:150px;height:auto;width:auto'>"; 
									}
								} else {
									$photo = "";
									$photo = "<div class='profilephoto' style='min-height:200px; padding-top:35px;'><i class='fa fa-user fa-4x' aria-hidden='true'></i></div>";
									$profile_pic_size = "small";
								}
							}
?>	

				         <div class="col-md-3 col-xs-6 candidate_row <? echo $candidate['candidate_class'] ?>" data-userID='<? echo $candidate['userID'] ?>' data-experience='<? echo $candidate['experience'] ?>' data-skills='<? echo $candidate['sub_skill_text'] ?>' data-candidate_skill_filter='show' data-experience_filter='show'>
				            <div class="panel panel-default panel-highlight panel-employee ">
				            	<div class="panel-heading text-center">
					            	
					            	<div class="row hidden-xs" style="margin-bottom: -15px;">
						            	<div class="col-md-1 col-xs-2">
											<a href='#' class='unhighlight' id='<? echo $candidate['matchID'] ?>' style="color:black"><i class="fa fa-star" aria-hidden="true" style="font-size: 14pt; color: #b76e1f"></i></a>
						            	</div>
						            	<div class="col-md-10 col-xs-11">					            	
											<h4 class="panel-title" style="color:#b76e1f">
												<? echo $candidate['firstname']." ".$candidate['lastname']." ".$new ?>
					                		</h4>					                		
						            	</div>
						            	<div class="col-md-1 col-xs-0">
						            		&nbsp;
						            	</div>
					            	</div>
					            	
					            	<div class="row hidden-sm hidden-md hidden-lg" style="margin-bottom: -15px;">
						            	<div class="col-xs-12">
											<a href='#' class='unhighlight' id='<? echo $candidate['matchID'] ?>' style="color:black"><i class="fa fa-star" aria-hidden="true" style="font-size: 14pt; color: #b76e1f"></i></a>
											<b class="panel-title" style="color:#b76e1f">
												<? echo $candidate['firstname']." ".$candidate['lastname']." ".$new ?>
					                		</b>					                		
						            	</div>
					            	</div>
					            	
				              	</div>
							  	<div class="panel-employee-photo" style="min-height: 170px;">
							 		<? echo $photo ?>	
							 	</div>
							 	<div class="panel-body text-center" >
<!-- 			DOESNT WORK IN IE - FIX LATER				 		<div class="profilecircle cactive text-center"><? echo round($candidate['experience']) ?></div> -->
							 		<ul class="list-dotted hidden-xs" style="margin-top:-30px">
				                		<li><strong><? echo round($candidate['experience']) ?> years experience</strong></li>
										<li class="hidden-xs">Applied: <? echo date('M j, Y', strtotime($candidate['date_responded'])) ?></li>
										<li class="hidden-xs">Previously Applied: <? echo $past_reply_note ?></li>
				                	</ul>
				                	
							 		<div class="hidden-sm hidden-md hidden-lg text-center" style='margin-bottom:10px; margin-top:-30px;'>
				                		<? echo round($candidate['experience']) ?> years experience
				                		<? echo date('M j, Y', strtotime($candidate['date_responded'])) ?>				                		
				                	</div>
				                	
									<a href='candidate.php?ID=<? echo $candidate['userID'] ?>&matchID=<? echo $candidate['matchID'] ?>' class="btn btn-primary">VIEW PROFILE</a>
				              	</div>
				            </div>
				          </div>
						  <div class="clearfix" id='clear_<? echo $candidate['userID'] ?>' data-user='<? echo $candidate['userID'] ?>'  style="display:none;"></div>				          
<?php
					}
				}
				
				if(count($candidate_array) > 0) {

					foreach ($candidate_array as $candidate) {

						if (array_key_exists('past_replies', $candidate) && count($candidate['past_replies']) > 0) {
							$past_reply_note = "YES";
						} else {
							$past_reply_note = "<i>No</i>";
						}	
												
						if ($candidate['photo'] == "") {
							$photo = "";	
							$photo = "<div class='profilephoto' style='min-height:200px; padding-top:35px;'><i class='fa fa-user fa-4x' aria-hidden='true'></i></div>";
							$profile_pic_size = "small";
						} else { 			
							if (file_exists("images/profile_pics/".$candidate['photo'])) {

								$profile_pic_size_array = getimagesize("images/profile_pics/".$candidate['photo']);
								if ($profile_pic_size_array[1] < 200) {
									$profile_pic_size = "small";
								} else {
									$profile_pic_size = "large";
								}
	
								if($profile_pic_size == "small") {
									$photo = "<img src='images/profile_pics/".$candidate['photo']."?".time()."' class='center-block profilephoto' id='main_photo' style='margin-top:30px;'>";
								} else {
			                       $photo = "<img src='images/profile_pics/".$candidate['photo']."?".time()."' class='center-block profilephoto' id='main_photo' style='max-height:160px;max-width:160px;height:auto;width:auto'>"; 
								}
							} else {
								$photo = "";
								$photo = "<div class='profilephoto' style='min-height:200px; padding-top:35px;'><i class='fa fa-user fa-4x' aria-hidden='true'></i></div>";
								$profile_pic_size = "small";								
							}
						}
							
						$new = "";	
						if ($candidate['date_responded'] > $last_login) {
							$new = "<br /><font color='red'><b><i>NEW</i></b></font>";
						}
							
						$sub_skill_text = "";	
						if (array_key_exists('sub_skills', $candidate) && count($candidate['sub_skills']) > 0) {
							foreach($candidate['sub_skills'] as $sub_skill) {
								$sub_skill_text .= $sub_skill." ";
							}
						}	
?>
				          <div class="col-md-3 col-xs-6 candidate_row <? echo $candidate['candidate_class'] ?>" data-userID='<? echo $candidate['userID'] ?>' data-experience='<? echo $candidate['experience'] ?>' data-skills='<? echo $candidate['sub_skill_text'] ?>' data-candidate_skill_filter='show' data-experience_filter='show'>
				            <div class="panel panel-default panel-employee text-center">
				            	<div class="panel-heading">
					            	
					            	<div class="row hidden-xs" style="margin-bottom: -15px;">
						            	<div class="col-md-1 col-xs-2">
											<a href='#' class='highlight' id='<? echo $candidate['matchID'] ?>' style="color:black"><i class="fa fa-star-o" aria-hidden="true" style="font-size: 14pt;"></i></a>
						            	</div>
						            	<div class="col-md-10 col-xs-11">					            	
											<h4 class="panel-title">
												<? echo $candidate['firstname']." ".$candidate['lastname']." ".$new ?>
					                		</h4>					                		
						            	</div>
						            	<div class="col-md-1 col-xs-0">
						            		&nbsp;
						            	</div>
					            	</div>
					            	
					            	<div class="row hidden-sm hidden-md hidden-lg" style="margin-bottom: -15px;">
						            	<div class="col-xs-12">
											<a href='#' class='highlight' id='<? echo $candidate['matchID'] ?>' style="color:black"><i class="fa fa-star-o" aria-hidden="true" style="font-size: 14pt;"></i></a>
											<b class="panel-title">
												<? echo $candidate['firstname']." ".$candidate['lastname']." ".$new ?>
					                		</b>					                		
						            	</div>
					            	</div>
					            	
				              	</div>
				              <div class="panel-employee-photo" style="min-height: 170px;">
							 	 <? echo $photo ?>	
							  </div>
				              <div class="panel-body" >
<!-- 				DOESNT WORK IN IE - FIX LATER 			 	<div class="profilecircle cactive"><? echo round($candidate['experience']) ?></div> -->
							 		<ul class="list-dotted hidden-xs" style="margin-top:-30px;">
				                		<li><strong><? echo round($candidate['experience']) ?> years experience</strong></li>
										<li class="hidden-xs">Applied: <? echo date('M j, Y', strtotime($candidate['date_responded'])) ?></li>
										<li class="hidden-xs">Previously Applied: <? echo $past_reply_note ?></li>
				                	</ul>
				                	
							 		<div class="hidden-sm hidden-md hidden-lg text-center" style='margin-bottom:10px; margin-top:-30px;'>
				                		<? echo round($candidate['experience']) ?> years experience<br />
				                		<? echo date('M j, Y', strtotime($candidate['date_responded'])) ?>
				                	</div>
				                <a href='candidate.php?ID=<? echo $candidate['userID'] ?>&matchID=<? echo $candidate['matchID'] ?>' class="btn btn-primary">VIEW PROFILE</a>
				
				              </div>
				            </div>
				          </div>
				          
						  <div class="clearfix" id='clear_<? echo $candidate['userID'] ?>' data-user='<? echo $candidate['userID'] ?>'  style="display:none;"></div>
<?php
						}
				}
		
				if (count($candidate_array) == 0 && count($highlight_array) == 0) {
?>
					<div class="row" style="margin-top:20px; margin-bottom:50px">
						<div class="col-md-12">
							<h5> &nbsp; &nbsp; &nbsp; No interested candidates yet.  <br /> &nbsp; &nbsp; &nbsp; You will be notified by email when a candidate is interested.</h5>
						</div>
					</div>
<?php
				}
?>
			
			</div>
<?php
		} else {
?>
			<h4>This Job Has Expired</h4>
			Candidate Profiles are no longer available for this job post.
<?php
		}
?>
	</div>
<?php		
}

function job_html_employer_link($job_data, $expired) {					
//==================================
//!  First break master arrays into trait arrays
//
//  Modify any data for presentation
//==================================

		$jobID							= $job_data['general']['jobID'];
		$job_status					= $job_data['general']['job_status'];
		$title		 						= $job_data['general']['title'];
		$public_hash					= $job_data['general']['public_hash'];

//==================================
//!  Display
//==================================
?>
	<div class='container'>
		<div class="row" style="margin-top: 15px;">
			<div class="col-md-12 text-center">
				<h4><? echo $title ?></h4>
			</div>
		</div>		
						
<?php		
		if ($job_status == "Expired" || $expired == 'Y') {	
?>	
			<div class="row">
				<div class="col-md-12 text-center">
					<h4>This job listing has expired</h4>
					<h5>Links are not available for expired jobs.</h5>		
				</div>
			</div>		

<?php
		} else {		
?>

			<div class="row" style="margin-bottom:135px">
				<div class="col-md-12 text-center">
					<h3>Share your Job Opening on Social Media</h4>
					You can copy and paste the following link share your job opening details on other sites:
				</div>
				
				<div class="col-md-12 text-center" style="margin-top:15px; word-wrap: break-word;">
					<i>https://servebartendcook.com/public_listing_new.php?ID=<? echo $jobID ?>&ref=<? echo $public_hash ?></i><br />
					&nbsp; <br />
					<a href='#' class="btn btn-large btn-success" id="copy_btn" data-clipboard-text="https://servebartendcook.com/public_listing_new.php?ID=<? echo $jobID ?>&ref=<? echo $public_hash ?>&utm_source=internal&utm_medium=share&utm_campaign=employer">
						<i class="fa fa-clipboard" aria-hidden="true"></i> Copy Link
					</a><br />
					<div id="copy_notice" style="color:red; display:none">Job Link Copied to Your Clipboard</div>
				</div>
			</div>
<?php
		}
?>
	</div>
<?php
}


function job_html_group_warning($type) {
	switch($type) {
		default:
?>
			<h2>Oops</h2>
			<div style="float:left; width:98%; background-color:#e9e6de; padding-top:6px; padding-left:1%; padding-right:1%">
				<h4>Oops, this isn't the page you were looking for</h4>
				<b>Return <a href='main.php'>HOME</a>.
			</div>			
<?php
		break;
		
		case "posted":
?>
			<h2>Job(s) Already Posted</h2>
			<div style="float:left; width:98%; background-color:#e9e6de; padding-top:6px; padding-left:1%; padding-right:1%">
				<h4>Your jobs are already posted.</h4>
				<b>Return <a href='main.php'>HOME</a> to view your job details.
			</div>	
<?php	
		break;
	}	
}

function job_html_removed() {
?>
	<h2 style="margin-top:-15px;">This job post has been removed.</h2>
	<b>Please contact admin@servebartendcook.com with questions.</b>	
<?php
}

function job_html_employer_no_edit() {
?>
	<h2 style="margin-top:-15px;">This function is not available for Open, Filled, or Expired Jobs</h2>
<?php
}
		

function job_html_employer_no_store() {

	$utilities = new Utilities;
	$store_type_array = $utilities->store_types;										
?>

	<div class='container employer_info'>
		<div class='row' style="margin-bottom:25px">
			<div class="col-md-12 text-center">
				<h2>Post a Job</h2>
			</div>
		</div>
		
		<div class="row add_store_holder"  style="font-size:16px; margin-top:30px; margin-bottom:12px; ">		
			<h4 style="text-align:center; color:#760006;">Location</h2>
			<h5 style="text-align: center"><i>First you need to enter a location for your business.<br />(You only need to do this for your first job post, you can use the same location after that.)</i></h5>
			<div class='error col-md-10 col-md-offset-2' id='store_required_warning' style="color:red; margin-bottom:5px; display:none"><b>ALL REQUIRED FIELDS MUST BE COMPLETED</b></div>
			<div class='error col-md-10 col-md-offset-2' id='store_zip_warning' style="color:red; margin-bottom:5px; display:none"><b>PLEASE ENTER A VALID ZIP CODE</b></div>
			<div class='error col-md-10 col-md-offset-2' id='location_type_warning' style="color:red; margin-bottom:5px; display:none"><b>PLEASE SELECT A LOCATION TYPE</b></div>

			<div class="form-horizontal">
				<div class="form-group" id="edit_location_form" style="margin-bottom:3px">
			   		<label for="edit_location" class="col-md-2 control-label">Store Name</label>
			   		<div class="col-md-10">
						<input type='text' class='edit_location form-control' id="pac-input" placeholder='Required'><br />
					</div>

			   		<label for="edit_address" class="col-md-2 control-label">Street Address</label>
			   		<div class="col-md-10">
						<input type='text' class='edit_address form-control' id="address" value="" placeholder='Required'><br />
					</div>
					
			   		<label for="edit_zip" class="col-md-2 control-label">Zip Code</label>
			   		<div class="col-md-10">
						<input type='text' class='edit_zip form-control' id="zip" placeholder='Required'><br />
					</div>

			   		<label for="edit_description" class="col-md-2 control-label">Business Type</label>
			   		<div class="col-md-10">
			   			<select class="form-control" id="edit_description">
							<option value='0'>--Location Type--</option>																	
<?php
							foreach ($store_type_array as $type) {
								echo "<option value='".$type."' >".$type."</option>";
							}
?>					
						</select><br />
					</div>

			   		<label for="edit_website" class="col-md-2 control-label">Website</label>
			   		<div class="col-md-10">
						<input type='text' class='edit_website form-control' id="edit_website>" placeholder='Optional'><br />
					</div>

			   		<label for="edit_facebook" class="col-md-2 control-label">Facebook</label>
			   		<div class="col-md-10">
						<input type='text' class='edit_facebook form-control' id="edit_facebook" placeholder='Optional'><br />
					</div>

					<div class="col-md-10 col-md-offset-2">
						<a href='#' class='btn btn-large btn-success save_store_edit' id="<? echo $row['storeID'] ?>">Save</a>								
						&nbsp; <a href='#' class='cancel_edit_store'>Cancel</a>											
					</div>
			
				</div>			
			</div>
		</div>	
		
		
		<font style="color:#760006"><i>First you need to enter a location for your business.<br />(You only need to do this for your first job post, you can use the same location after that.)</i></font><br />
		<div id="edit_store_form" style="float:left; margin-top:20px;">	
			<div id="store_required_warning" style="display:none"><font color="red"><b>ALL REQUIRED FIELDS MUST BE COMPLETED.</b></font></div>
			<div id="store_zip_warning" style="display:none"><font color="red"><b>PLEASE ENTER A VALID ZIP CODE.</b></font></div>
			
			<div style="width:100%; float:left">
				<div style="width:50%; margin-right:10px; float:left;">
					<h4 style="text-align:center; color:#760006;">Required Information</h4>
					<table style="color:#760006; width:100%">
						<tr>
							<td><b>Store Name: &nbsp; </b></td>
							<td><input type="text" id="pac-input"></input></div></td>
						</tr>
							<td><b>Street Address: &nbsp;</b></td>
							<td><input type="text" id="address" value=""></input></td>
						</tr>
						<tr>
							<td><b>Zip Code: &nbsp; </b></td>
							<td><input type="text" id="zip"></input></td>
						</tr>
						<tr>
							<td><b>Your Title: </b></td>
							<td><select id="position" style="background-color:#e9e6de;">
									<option value='Manager'>Manager</option>
									<option value='General Manager'>General Manager</option>
									<option value='Assistant Manager'>Assistant Manager</option>
									<option value='Kitchen Manager'>Kitchen Manager</option>
									<option value='Bar Manager'>Bar Manager</option>
									<option value='Owner'>Owner</option>
									<option value='HR'>HR</option>
									<option value='Other'>Other</option>
							</select></td>
						</tr>														
						<tr>
							<td><b>Business Type: &nbsp; </b></td>
							<td><select id="description" style="background-color:#e9e6de;">
									<option value='0'>--Location Type--</option>																	
<?php
									foreach ($store_type_array as $type) {
										echo "<option value='".$type."'>".$type."</option>";
									}
?>					
								</select>
							</select></td>
						</tr>
					</table>
				</div>

				<div style="width:45%; float:left;">
					<h4 style="text-align:center; color:#760006;">Optional Information</h4>
					<table style="color:#760006; width:100%">					
						<tr>
							<td><b>Website: &nbsp;</b></td> 
							<td><input type="text" id="website"></input></td>
						</tr>
						<tr>
							<td><b>Facebook: &nbsp;</b></td> 
							<td><input type="text" id="facebook"></input></td>
						</tr>
						<tr>
							<td><b>Twitter: &nbsp;</b></td> 
							<td><input type="text" id="twitter"></input></td>
						</tr>			
						
						<input type="hidden" id="name" value=''>	
					</table>
				</div>
			<div style="float:left; margin-top:35px; width:100%"><a href='#' class='btn btn-large btn-primary add_store' id='post'>Save & Continue</a></div>									
			<div style="float:left; margin-top:15px; width:100%">You can manage jobs at multiple locations as well.  You can add new stores/locations and edit location details on the "Settings" page.</div>								
		</div>		
	</div>	
</div>	
<?php	
}
	
function job_html_loader() {
?>
	<div class="container" id="loader" style="display: none">
		<div class="row text-center" style="margin-top: 150px; margin-bottom: 150px;">
			<h3>LOADING...</h3>
		</div>
	</div>
<?php
}