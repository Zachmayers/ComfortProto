<?php

function admin_menu_html() {

?>	
	<div class='container' style="min-height: 550px; color:white">
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-12 text-center">
				<h2 style="color:black">Admin Menu</h2>
			</div>
		</div>

		<div class='row' style="margin-bottom:12px">
			<div class="col-md-12 text-center">
				<a href='wine.php?page=edit_varietals'>Setup Varietals</a>(<i>Temporary</i>)<br />
				
				<a href='wine.php?page=new' id='add_wine'>Add Wine</a><br />
				<a href='wine_list.php' id='view_wine'>View/Edit Wines</a><br />
				&nbsp; <br />
				

				<a href='#'>Create Group</a><br />
				<a href='#'>View/Edit Groups</a><br />
				&nbsp; <br />


				<a href='#'>View Data</a><br />
				&nbsp; <br />

			</div>
		</div>
		
</div>
<?php
}	

function item_visitor_html($item_details, $item_offered, $user_items) {

?>	
	<div class='container' style="min-height: 550px">
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-12 text-center">
				<h2 style="color:black"><? echo $item_details['name'] ?></h2>
				<b>Type: <? echo $item_details['category'] ?></b><br />
				<i><? echo $item_details['description'] ?></i><br />
				&nbsp; <br />
				&nbsp; <br />
<?php
				if ($item_offered == 'Y') {
?>										
					<a href='trade.php?itemID=<? echo $item_details['itemID'] ?>' <i>Trade Pending</i></a>
<?php										
				} else {
?>					
					<a href='trade.php?itemID=<? echo $item_details['itemID'] ?>' >Start Trade</a>
<?php					
				}
?>				
			</div>	
		</div>
		
		<div class='row trade_row' style="margin-bottom:0px; display: none">
			<div class="col-md-12">
				<h3 style="margin-bottom: 10px;"><i class="fa fa-list" aria-hidden="true" style="background-color: transparent"></i> Select Item</h2>
			</div>	
		</div>

		<div class="row trade_row" style="font-size:16px; margin-bottom:20px; margin-top:20px; display: none">		
				<form class="form-horizontal">
					
					<div class="form-group">					
						<label for="building_select" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Item</label>
						<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
							<select class='building_select form-control' id="flargle">
								<option value='0'>-- Select Item --</option>
								
<?php
								if (count($user_items) > 0) {				
									foreach($user_items as $row) {
?>
										<option value='<? echo $row['itemID'] ?>'><? echo $row['name'] ?></option>
<?php
									}
								}
?>
							</select>
						</div>
					</div>
				
				</form>
		</div>
		
		<div class='row offer_complete' style="margin-bottom:0px; display: none">
			<div class="col-md-12">
				<h3 style="margin-bottom: 10px;"><i class="fa fa-list" aria-hidden="true" style="background-color: transparent"></i> Offer Sent</h2>
			</div>	
		</div>
			
	</div>
	
</div>
<?php
}

function item_edit_html($item_details, $category_list) {

?>	
	<div class='container' style="min-height: 550px">
			<div class='row'>			
				<div class='col-md-12 text-center'>
					Edit your item<br />
					<div class='row' style="margin-bottom:12px">
						<div class="col-md-12 text-center">
							<img src="images/items/<? echo $item_details['photo'] ?>.jpg"><br />
							<a href="item.php?id=<? echo $_GET['id'] ?>&page=edit_photos">Edit Photo</a>
						</div>
					</div>

						<div class='error col-md-10 col-md-offset-2' id='new_item_empty_warning' style="color:red; margin-bottom:5px; display:none"><b>Fields cannot be empty.</b></div>
			
						<form class="form-horizontal">
							<div class="form-group" id="edit_item_form" style="margin-bottom: 3px">
						   		<label for="item_name" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Item Name</label>
						   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
									<input type='text' class="item_name form-control" id="item_name" value="<? echo $item_details['name'] ?>" placeholder='Item Name'><br />
								</div>
							</div>
							<div class="form-group">				
								<label for="item_category" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Category</label>
								<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
									<select class='item_category form-control'>
<?php
										foreach($category_list as $row) {
											if ($item_details['category'] == $row['category']) {
												echo "<option value='".$row['category']."' selected >".$row['category']."</option>";
											} else {
												echo "<option value='".$row['category']."'>".$row['category']."</option>";												
											}
										}	
?>									
									</select>
								</div>
								<label for="description" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Brief Description</label>
								<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
									<input type='text' class='description form-control' id="description" value="<? echo $item_details['description'] ?>" placeholder='Description'><br />
								</div>
								
							</form>
							
							<input type="hidden" id="itemID" value="<? echo $item_details['itemID'] ?>">
						
						<div class="row" style="margin-bottom:25px">
							<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
								<button type="button" class="btn btn-success" id='save_edit_item'>
									<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save
								</button>
			
								<button type="button" class="btn btn-link" id="cancel_edit_item" style="color:#8e080b;">
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

function item_add_html($category_list) {

?>	
	<div class='container' style="min-height: 550px">
			<div class='row'>			
				<div class='col-md-12 text-center'>
					Enter Item Details<br />

						<div class='error col-md-10 col-md-offset-2' id='new_item_empty_warning' style="color:red; margin-bottom:5px; display:none"><b>Fields cannot be empty.</b></div>
			
						<form class="form-horizontal">
							<div class="form-group" id="new_item_form" style="margin-bottom: 3px">
						   		<label for="item_name" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Item Name</label>
						   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
									<input type='text' class="item_name form-control" id="item_name" placeholder='Item Name'><br />
								</div>
							</div>
							<div class="form-group">				
								<label for="new_item_category" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Category</label>
								<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
									<select class='new_item_category form-control'>
<?php
										foreach($category_list as $row) {
											 echo "<option value='".$row['category']."'>".$row['category']."</option>";
										}	
?>									
									</select>
								</div>
								<label for="new_description" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Brief Description</label>
								<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
									<input type='text' class='new_description form-control' id="new_description" placeholder='Description'><br />
								</div>
								
							</form>
						
						<div class="row" style="margin-bottom:25px">
							<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
								<button type="button" class="btn btn-success" id='save_new_item'>
									<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Add Photo Next
								</button>
			
<!--
								<button type="button" class="btn btn-link" id="cancel_new_item" style="color:#8e080b;">
									Cancel
								</button>
-->
							</div>
						</div>							
					</div>

					
				</div>
			</div>
			
	</div>
	
</div>
<?php
}

function item_edit_photos_html($upload_url, $main_pic, $other_pics, $itemID) {
?>	
	<div class='container' style="min-height: 70%">
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-8 col-md-offset-4">
				<h2 style="color:black"><i class="fa fa-image" aria-hidden="true"></i> ADD/EDIT PHOTOS</h2>
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


		<div class='row'>
            <div class="col-md-4 col-md-offset-1">
                <div class="panel-employee text-center">
					<h4 style="padding-top:7px">Main Pic</h4>
                    <div class="panel-employee-photo">
<?php							
						if($main_pic != "NA") {
?>
	                       <img src="images/items/<? echo $main_pic.".jpg?".time() ?>" class="center-block profilephoto" id='main_photo' style="max-height:280px;max-width:280px;height:auto;width:auto;">
<?php												
						} else {
?>
	                        <div class="row">
								<h2>NA</h2>
						    </div>
<?php							
						}
?>
						<div class="col-md-7 col-md-offset-3" style="margin-top: 5px; margin-bottom: 25px;">
							<button type="button" class="btn btn-warning edit_main_photo add_photo" id="main">
								<i class="fa fa-pencil-square-o" aria-hidden="true" style="background-color: transparent"></i> Edit
							</button>
<?php
							if ($main_pic != "NA") {	
?>	       
								<button type="button" class="btn btn-danger remove_profile_photo remove_photo" id="profile">
									<i class="fa fa-trash-o" aria-hidden="true"></i></i> Delete
								</button>
<?php
							}
?>    
		            	</div>

                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="panel-employee text-center">
					<h4>Other Pics (up to 12)</h4>
					
					<div class="row">
<?php
					$image_count = 1;
					$total_count = 0;
					if (count($other_pics) > 0) {	
						foreach($other_pics as $photo) {
							if ($image_count == 5) {
								$image_count = 1;
?>
							</div>
							<div class="row">
<?php							
							}
?>
							<div class="col-md-3">	
								<img src='images/gallery_pics/<? echo $photo['thumb']."?".time() ?>' height='100' class="center-block" style="margin-bottom: 3px; margin-top: 15px;">
								<button type="button" class="btn btn-danger remove_photo" id='<? echo $photo['photoID'] ?>'>
									<i class="fa fa-trash-o" aria-hidden="true"></i></i> Delete
								</button>
							</div>
<?php
						$image_count++;
						$total_count++;
						}
					}
?>
					</div>

					<div class="row" id='new_photo_button_holder' style="margin-bottom: 31px; margin-top: 15px; cursor:pointer">
<?php
					if ($total_count < 12) {	
?>					
						<div class="green_button col-md-12 add_photo" id="other">
							<h4><i class="fa fa-plus" aria-hidden="true"></i> New Gallery Photo</h4>
						</div>
<?php
					} else {
?>
						<div class='green_button col-md-12' id='add_photo_button'>
							&nbsp; <br />
						</div>
<?php						
					}
?>		
					</div>
                </div> &nbsp; <br />
            </div>
		</div>


	</div>	
					
	<div id='status' style="width:100%; color:red;"></div>			
	
<!--
	<form id='profile_form_ie' action='<? echo $upload_url ?>_ie.php?type=profile' method='post' enctype='multipart/form-data' style="float:left; padding-bottom:25px; padding-left:30px; margin-top:30px; display:none;">
		<h2 style="text-align:center;">Choose a File</h2>
		&nbsp; &nbsp; &nbsp; &nbsp; <input type='file' id='profile_pic_choose_ie' name='profile_pic_choose_ie' >
		<input type='submit' value='Save Profile Pic' id='profile_upload_button_ie'><br />
		<a href='#' class='upload_cancel' id='profile'>Cancel</a><br />"				
		<div id='status' style="color:red"></div>"	
	</form>			
-->
	<div id="add_photo_tools" style="margin-top:-15px;">			
	    <form id="myform" action="<? echo $upload_url ?>.php?type=main&itemID=<? echo $itemID ?>" method="post" enctype="multipart/form-data" style="position:absolute; top:-500px;">
	        <input type="file" id="main_pic_choose" name="main_pic_choose" >
			<input type="submit" value="Save Main Pic" id="main_upload_button"><br />
		</form>
	</div>
	
	<form id="bar_form" action="<? echo $upload_url ?>.php?type=other&itemID=<? echo $itemID ?>" method="post" enctype="multipart/form-data" style="position:absolute; top:-500px;">
        <input type="file" id="other_pic_choose" name="other_pic_choose" >
		<input type="submit" value="Save Other Pic" id="other_upload_button"><br />
	</form>

	<div id='status' style="width:100%; color:red;"></div>			

<!--
	<form id='bar_form_ie' action='<? echo $upload_url ?>_ie.php?type=other' method='post' enctype='multipart/form-data' style="float:left; padding-top:30px; padding-left:10px; display:none">
	    <h2 style='text-align:center;'>Choose a File</h2>
	    &nbsp; &nbsp; &nbsp; &nbsp; <input type='file' id='bartender_pic_choose_ie' name='bartender_pic_choose_ie' ><br />
	    &nbsp; <br />
		&nbsp; &nbsp; &nbsp;  &nbsp; <input type='submit' value='Save Cocktail Pic' id='bartender_upload_button_ie'><br />
		<a href='#' class='upload_cancel' id='bar'>Cancel</a><br />											
		&nbsp; <br />
		<div id='status' style="color:red"></div>	
	</div>			
-->
	
</div>
<?php
}

