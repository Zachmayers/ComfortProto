<?php
	function admin_store_data_html($store_data, $upload_url) {
?>
		<div style='text-align:center; margin-top:50px'>
		StoreID <input type="text" id="storeID"> <button id="find_store">Find Store</button>
		<br />
		<br />
		</div>
<?php
		if (count($store_data) > 0) {
			foreach ($store_data as $row) {
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
						
				</div>

			<div class='status' style="color:red;"></div>			

			<div class="add_photo_tools" style="">			
			    <form class="myform" action="<? echo $upload_url ?>.php?type=store&storeID=<? echo $row['storeID'] ?>" method="post" enctype="multipart/form-data" style="position:absolute; top:-500px;">
			        <input type="file" class="store_pic_choose" id="store_pic_choose_<? echo $row['storeID'] ?>" data-store_id="<? echo $row['storeID'] ?>" name="store_pic_choose" >
					<input type="submit" value="Save Store Pic1" id="store_upload_button_<? echo $row['storeID'] ?>"><br />
				</form>
			</div>
			
		</div>
			
	
<?php	
			}
		}	
	}	
	
	function stores_html($stores_array) {
?>		

		<h1 style="display:inline;">Store List</h1> &nbsp; &nbsp; <a href="admin.php"><button>Admin Home</button></a>	
		<br /> &nbsp; <br />
		<hr>	
		<table class='dark'>
<?php
		foreach($stores_array as $row) {
			echo "<tr>";
			echo "<td><a href='admin.php?page=view_store&id=".$row['storeID']."'>".$row['name']."</a></td>";
			echo "<td>".$row['firstname']." ".$row['lastname']."</td>";		
			echo "</tr>";		
		}
?>
		</table>
		<hr>	
<?php
	}//end html_page_main function
	
?>