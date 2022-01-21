<?php

function search_html($item_list, $category_list) {

?>	
<!-- 	<div class='container' style="min-height: 550px;"> -->
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-12 text-center">
				<h2 style="color:black">Search</h2>
			</div>	
			<div class="col-md-12 text-center">
				<form class="form-horizontal">
					<div class="form-group">				
						<label for="item_category" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Category</label>
						<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
							<select class='item_category form-control' id='category'>
								<option value='all'>All</option>
<?php
										foreach($category_list as $row) {
											 echo "<option value='".$row['category']."'>".$row['category']."</option>";
										}	
?>									
							</select>
						</div>
					</form>
				</div>
			</div>	

			<div class="col-md-12 text-center">
				<form class="form-horizontal">
					<div class="form-group">				
						<label for="keyword" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Search Term</label>
						<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
							<input type="text" class='keyword' id="keyword">
						</div>
					</form>
				</div>
			</div>	

			<div class="row member_row" style="font-size:16px; margin-top:30px; margin-bottom:12px">		
				<div class="col-md-9 col-md-offset-3 col-xs-9 col-xs-offset-2">
					<button type="button" class="btn btn-success" id='search' style="margin-bottom: 5px;">
						<i class="fa fa-plus-circle" aria-hidden="true" style="background-color: transparent"></i> Search
					</button> &nbsp; 
				</div>
			</div>	
			
		</div>
		
		<div class="row item_row" style="font-size:16px; margin-bottom:20px">
		
<?php
		if (count($item_list) > 0) {				
				foreach($item_list as $row) {
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
		}
?>
		</div>

	
	</div>
	
</div>
<?php
}	

function search_result_row($item) {
?>
		<div class="col-md-4 col-xs-12 " >
            <div class="panel panel-default panel-opportunity">
            	<div class="panel-heading text-center">
	                <h5 class="panel-title">
	                	<? echo $item['name'] ?>
	                </h5>
            	</div>
            
				<div class="panel-body" style="color: black; ">
					<div class="col-md-5 col-xs-5">
						<a href='item.php?id=<? echo $item['itemID'] ?>' class='view_item'>
			        		<img src="images/items/<? echo $item['photo'] ?>.jpg" class="center-block; img-fluid img-responsive" >
						</a>
					</div>
					<div class="col-md-7 col-xs-7" >
						<h4 style="margin-top: -5px;"><? echo $item['category'] ?></h5>
						<span style="color: gray"><? echo $item['description'] ?></span><br />
						<a href='#'>View Item</a>
					</div>
              	</div>
            </div>
        </div>
<?php	
}
