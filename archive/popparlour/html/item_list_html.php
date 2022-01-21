<?php
function item_list_open_html($open_items) {	

?>	

	
	<div class='container' style="min-height: 70%">
		<div class='row item_row' style="margin-bottom:12px">
			
			<div class="col-md-9 col-md-offset-3">
				<h2 style="color:black"><i class="fa fa-map-o" aria-hidden="true"></i> My Untraded Items</h2>
			</div>	
		</div>
<?php		
		if (count($open_items) > 0) {
			foreach($open_items as $row) {
?>	

		<div class="col-md-4 col-xs-12 item_row" >
            <div class="panel panel-default panel-opportunity">
            	<div class="panel-heading text-center">
	                <h5 class="panel-title">
	                	<? echo $row['name'] ?>
	                </h5>
            	</div>
            
				<div class="panel-body" style="color: black; ">
					<div class="col-md-5 col-xs-5">
						<a href='item.php?id=<? echo $row['itemID'] ?>' class='view_item'>
			        		<img src="images/items/<? echo $row['photo'] ?>.jpg" class="center-block; img-fluid img-responsive" >
						</a>
					</div>
					<div class="col-md-7 col-xs-7" >
						<h4 style="margin-top: -5px;"><? echo $row['category'] ?></h5>
						<span style="color: gray"><? echo $row['description'] ?></span>
					</div>
              	</div>
            </div>
        </div>
			
<?php
		}
?>	
<?php	
		} else {
?>
			<div class='row item_row'>
				<div class="col-md-2 col-md-offset-4">
					No open items
				</div>
			</div>
<?php
		}
?>		

		<div class="row" id='new_item_button_holder' style="margin-bottom: 25px; margin-top: 25px; cursor:pointer">
			<div class='green_button col-md-9 col-md-offset-3' id='add_item_button'>
				<h4><i class="fa fa-plus" aria-hidden="true"></i> New Item</h4>
			</div>
		</div>

		<div class='' id='new_item_holder' style="display:none">
			<div class='error col-md-10 col-md-offset-2' id='new_item_empty_warning' style="color:red; margin-bottom:5px; display:none"><b>Fields cannot be empty.</b></div>

			<form class="form-horizontal">
				<div class="form-group" id="new_item_form" style="margin-bottom: 3px">
			   		<label for="item_name" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Item Name</label>
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='text' class="item_name form-control" id="item_name" placeholder='Item Name'><br />
					</div>
				</div>
				<div class="form-group">				
					<label for="new_description" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Brief Description</label>
					<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='text' class='new_description form-control' id="new_description" placeholder='Description'><br />
					</div>
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
				</form>
			</div>
			
			<div class="row" style="margin-bottom:25px">
				<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
					<button type="button" class="btn btn-success" id='save_new_item'>
						<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save Item
					</button>

					<button type="button" class="btn btn-link" id="cancel_new_item" style="color:#8e080b;">
						Cancel
					</button>
				</div>
			</div>							
		</div>
	</div>

	</div>
<?php
}

function item_list_traded_html($traded_items) {	
?>	
			
	<div class='container' style="min-height: 70%">
		<div class='row item_row' style="margin-bottom:12px">
			<div class="col-md-9 col-md-offset-3">
				<h2 style="color:black"><i class="fa fa-map-o" aria-hidden="true"></i> My Traded Items</h2>
			</div>	
		</div>
<?php		
		if (count($traded_items) > 0) {
			foreach($traded_items as $row) {
?>	
			<div class="row item_row" style='font-size:16px; margin-bottom:12px'>		
				<div class="col-md-3 col-md-offset-3 col-xs-5 ">
					 <? echo $row['name']?><br />
					 <i><? echo $row['description'] ?></i>
				</div>
				<div class="col-md-3 col-xs-5">
					Type: <? echo $row['category'] ?>
				</div>
			</div>
			
<?php
		}
?>	
<?php	
		} else {
?>
			<div class='row'>
				<div class="col-md-2 col-md-offset-4">
					No traded items
				</div>
			</div>
<?php
		}
?> 

		<div class="row" id='new_item_button_holder' style="margin-bottom: 25px; margin-top: 25px; cursor:pointer">
			<div class='green_button col-md-9 col-md-offset-3' id='add_item_button'>
				<h4><i class="fa fa-plus" aria-hidden="true"></i> New Item</h4>
			</div>
		</div>

		<div class='' id='new_item_holder' style="display:none">
			<div class='error col-md-10 col-md-offset-2' id='new_item_empty_warning' style="color:red; margin-bottom:5px; display:none"><b>Fields cannot be empty.</b></div>

			<form class="form-horizontal">
				<div class="form-group" id="new_item_form" style="margin-bottom: 3px">
			   		<label for="item_name" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Item Name</label>
			   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='text' class="item_name form-control" id="item_name" placeholder='Item Name'><br />
					</div>
				</div>
				<div class="form-group">				
					<label for="new_description" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Brief Description</label>
					<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='text' class='new_description form-control' id="new_description" placeholder='Description'><br />
					</div>
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
				</form>
			</div>
			
			<div class="row" style="margin-bottom:25px">
				<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
					<button type="button" class="btn btn-success" id='save_new_item'>
						<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save Item
					</button>

					<button type="button" class="btn btn-link" id="cancel_new_item" style="color:#8e080b;">
						Cancel
					</button>
				</div>
			</div>							
		</div>
	</div>

	</div>
<?php
}

function item_list_html_loader() {
?>
	<div class="container" id="loader" style="display: none">
		<div class="row text-center" style="margin-top: 150px; margin-bottom: 150px;">
			<h3>LOADING...</h3>
		</div>
	</div>
<?php
}
?>