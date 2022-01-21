<?php
function main_menu_html($menu_items) {

/*
	$max_upload = min(ini_get('post_max_size'), ini_get('upload_max_filesize'));
	$max_upload = str_replace('M', '', $max_upload);
	$max_upload = $max_upload * 1024;
*/
	
	//echo $max_upload;
?>

<div id='holder' style="margin-top:-50px;">
			<h2 style="color: black; text-align:center">Pop Parlour Delivery</h1><br />
			<h3 style='text-align:center'><a href="#" id="coffee">Coffee/Tea</a> | <a href='#' id="pops">Pops</a> | <a href='#' id="beer">Alcohol</a></h3>
<div class='dashboard block block-pd-sm'>
		<div class='container text-center'>


        <!-- Menu -->
        <div class="menu">
            <div class="container">
                <div class="row">
                    <!-- Menu and categories -->
                    <div class="col-md-9 search-grid">
                        <div class="product-container">
                            <!-- Menu List of items -->
                            <div class="menu-list">
                                <div class="panel panel-default coffee" id="content1">
                                    <div class="panel-heading" style="color:black">Coffee/Tea</div>
                                    <div class="panel-body">
                                        <div class="row">
<?php
										foreach($menu_items as $row) {
											if ($row['type'] == "coffee" || $row['type'] == "tea") { 
												$small_soy = $row['small_price'] + 0.5;
												$small_other = $row['small_price'] + 0.75;
												$large_soy = $row['large_price'] + 0.5;
												$large_other = $row['large_price'] + 0.75;
												
?>												
	                                            <div class="col-md-6 col-xs-12"> <!-- start loop -->
	                                                <div class="menu-item-container"><div class="item-name"><?php echo $row['item_name'] ?></div>
	                                                    <div class="item-price-container"><b>
			                                                    
		                                                        <div class="item-price col-md-12 col-xs-12 small_price" data-item='<? echo $row['itemID'] ?>'>
		                                                            $<?php echo $row['small_price'] ?><br /> &nbsp; <br />
		                                                        </div>
		          
		          		                                        <div class="item-price col-md-12 col-xs-12 small_price_soy" style="display:none" data-item='<? echo $row['itemID'] ?>'>
		                                                            $<?php echo $small_soy ?><br /> &nbsp; <br />
		                                                        </div>
		                                                        
		          		                                        <div class="item-price col-md-12 col-xs-12 small_price_other" style="display:none" data-item='<? echo $row['itemID'] ?>'>
		                                                            $<?php echo $small_other ?><br /> &nbsp; <br />
		                                                        </div>
		                                                        
                                              
		       		                                            <div class="item-price col-md-12 col-xs-12 large_price" style="display:none" data-item='<? echo $row['itemID'] ?>'>
		                                                            $<?php echo $row['large_price'] ?><br /> &nbsp; <br />
		                                                        </div>

		       		                                            <div class="item-price col-md-12 col-xs-12 large_price_soy" style="display:none" data-item='<? echo $row['itemID'] ?>'>
		                                                            $<?php echo $large_soy ?><br /> &nbsp; <br />
		                                                        </div>

		       		                                            <div class="item-price col-md-12 col-xs-12 large_price_other" style="display:none" data-item='<? echo $row['itemID'] ?>'>
		                                                            $<?php echo $large_other ?><br /> &nbsp; <br />
		                                                        </div></b>
                                                 
		                            <?php
			                            						$count = 0;
			                            						if ($row['size_choice'] == 'Y') {
				                    ?>
				                    							
						                    						<div class="col-md-4 col-xs-12">
							                    						<div class="form-group">
						                    							<select class="size form-control" data-test='<? echo $row['itemID'] ?>'>
							                    							<option value="12" data-test='<? echo $row['itemID'] ?>'>12 oz</option>
							               					                <option value="16" data-test='<? echo $row['itemID'] ?>'>16 oz</option>     							
						                    							</select>
							                    						</div>
						                    						</div>
				                    <?php        
					                    							$count++;						
			                            						} 
			                            						
			                            						if ($row['temp_choice'] == 'Y') {
				                    ?>
					                    						<div class="col-md-4 col-xs-12">
						                    					<div class="form-group">

						                    							<select class="temp form-control" data-test='<? echo $row['itemID'] ?>'>
						                    							<option value="Hot">Hot</option>
						               					                <option value="Iced">Iced</option>     							
					                    							</select>
						                    					</div>
					                    						</div>
				                    <?php  
					                    							$count++;      						
			                            						} 
			                        
			                            						if ($row['milk_choice'] == 'Y') {
				                    ?>
					                    						<div class="col-md-4 col-xs-12">
						                    						<div class="form-group">

						                    							<select class="milk form-control" id="milk_<? echo $row['itemID'] ?>" data-test='<? echo $row['itemID'] ?>'>
<!-- 						                    							<option value="No Milk">No Milk</option> -->
						               					                <option value="milk" selected>Whole</option>     							
						               					                <option value="soy">Soy</option>     							
						               					                <option value="oat">Oat</option>     							
						               					                <option value="almond">Almond</option>     							
					                    							</select>
						                    						</div>
					                    						</div>
				                    <?php        	
					                    							$count++;					
			                            						}
			                            						
			                            						
																switch($count) {
																	case "0":
?>
												                        <div class="col-md-12 col-xs-12">
													                       &nbsp; &nbsp;
										                        		</div>
<?php															
																	break;

																	case "1":
?>
												                        <div class="col-md-8 col-xs-12">
													                       &nbsp; &nbsp;
										                        		</div>
<?php															
																	break;

																	case "2":
?>
												                        <div class="col-md-4 col-xs-12">
													                       &nbsp; &nbsp;
										                        		</div>
<?php															
																	break;
																}
			                            						
			                        ?>
			                        							<br /> &nbsp; <br />
		                                                        <div class="col-md-12 col-xs-12">
		                                                            <button id='<? echo $row['itemID'] ?>' class="btn btn-primary sc-add-to-cart" 
		                                                            	data-name="<?php echo $row['item_name'] ?>" 
		                                                            	data-price="<?php echo $row['small_price'] ?>" 
		                  		                                        data-price_soy="<?php echo $small_soy ?>" 
		                  		                                        data-price_other="<?php echo $small_other ?>" 

		                                                 		        data-price_large="<?php echo $row['large_price'] ?>" 
		                                                 		        data-price_large_soy="<?php echo $large_soy ?>" 
		                                                 		        data-price_large_other="<?php echo $large_other ?>" 

		                                                            	data-item="<?php echo $row['itemID'] ?>" 
		                                                            	data-size="regular"
		                                                            	data-temp="hot"
		                                                            	data-milk="none"
		                                                            	type="submit">ADD</button>
<!-- 		 		                                                    <button class="btn btn-primary sc-add-to-cart large_add" data-name="<?php echo $row['item_name'] ?>" data-price="<?php echo $row['small_price'] ?>" data-item="<?php echo $row['itemID'] ?>" type="submit" style="display: none">lADD</button> -->

		                                                        </div> <br /> &nbsp; <br />
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
                                
                                
                                <div class="panel panel-default pops" id="content1">
                                    <div class="panel-heading" style="color:black">Pops</div>
                                    <div class="panel-body">
                                        <div class="row">
<?php
										foreach($menu_items as $row) {
											if ($row['type'] == "pop") { 
?>										
	                                            <div class="col-md-6"> <!-- start loop -->
	                                                <div class="menu-item-container"><div class="item-name"><?php echo $row['item_name'] ?></div>
	                                                    <div class="item-price-container">
			                                                    
		                                                        <div class="item-price col-md-12 col-xs-12 small_price" data-item='<? echo $row['itemID'] ?>'>
		                                                            $<?php echo $row['small_price'] ?>
		                                                        </div>
		                                                        
<!--
												                        <div class="col-md-9">
													                       &nbsp; &nbsp;
										                        		</div>
			                        							<br /> &nbsp; <br />
-->
		                                                        <div class="col-md-12">
		                                                            <button id='<? echo $row['itemID'] ?>' class="btn btn-primary sc-add-to-cart" 
		                                                            	data-name="<?php echo $row['item_name'] ?>" 
		                                                            	data-price="<?php echo $row['small_price'] ?>" 
		                                                 		        data-price_large="<?php echo $row['large_price'] ?>" 

		                                                            	data-item="<?php echo $row['itemID'] ?>" 
		                                                            	data-size="regular"
		                                                            	data-temp="hot"
		                                                            	data-milk="none"
		                                                            	type="submit">ADD</button>
<!-- 		 		                                                    <button class="btn btn-primary sc-add-to-cart large_add" data-name="<?php echo $row['item_name'] ?>" data-price="<?php echo $row['small_price'] ?>" data-item="<?php echo $row['itemID'] ?>" type="submit" style="display: none">lADD</button> -->

		                                                        </div> <br /> &nbsp; <br />
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
 
 
                                 <div class="panel panel-default beer" id="content1">
                                    <div class="panel-heading" style="color:black">Beer/Wine</div>
                                    <div class="panel-body">
                                        <div class="row">
<?php
										foreach($menu_items as $row) {
											if ($row['type'] == "beer") { 
?>										
	                                            <div class="col-md-6"> <!-- start loop -->
	                                                <div class="menu-item-container"><div class="item-name"><?php echo $row['item_name'] ?></div>
	                                                    <div class="item-price-container">
			                                                    
		                                                        <div class="item-price col-md-12 col-xs-12 small_price" data-item='<? echo $row['itemID'] ?>'>
		                                                            $<?php echo $row['small_price'] ?>
		                                                        </div>
<!--
		                                                        
												                        <div class="col-md-9">
													                       &nbsp; &nbsp;
										                        		</div>
			                        							<br /> &nbsp; <br />
-->
		                                                        <div class="col-md-12">
		                                                            <button id='<? echo $row['itemID'] ?>' class="btn btn-primary sc-add-to-cart" 
		                                                            	data-name="<?php echo $row['item_name'] ?>" 
		                                                            	data-price="<?php echo $row['small_price'] ?>" 
		                                                 		        data-price_large="<?php echo $row['large_price'] ?>" 

		                                                            	data-item="<?php echo $row['itemID'] ?>" 
		                                                            	data-size="regular"
		                                                            	data-temp="hot"
		                                                            	data-milk="none"
		                                                            	type="submit">ADD</button>
<!-- 		 		                                                    <button class="btn btn-primary sc-add-to-cart large_add" data-name="<?php echo $row['item_name'] ?>" data-price="<?php echo $row['small_price'] ?>" data-item="<?php echo $row['itemID'] ?>" type="submit" style="display: none">lADD</button> -->

		                                                        </div> <br /> &nbsp; <br />
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
                               
                                
                            </div>
                            <!-- //Menu List of items -->
                        </div>
                    </div>
                    <!-- //Menu and categories -->
                    <!-- Cart Grid -->
                    <div class="col-md-3 cart_scroll">
                        <div id="cart"></div>
                    </div>
                    <!-- //Cart Grid -->
                </div>
            </div>
        </div>

	</div><br />
</div>	
<?php	
}	

function checkout_html($item_array) {
?>

<div id='holder' style="margin-top:-50px;">
	<h2 style="color:black; text-align:center">Delivery Info</h1>

<div class='dashboard block block-pd-sm'>
		<div class='container text-center'>
			<b>Please be aware we are only able to deliver in a 6 mile radius of Lake Eola or UCF<br />
			Contact us for more information.</b><br /> &nbsp; <br />
			<div class='row' id='order_items' style="display:none">
				<div class='col-md-12 text-center'>
			
			<h3>Order Details</h3> <br />
<?php
			$total = 1;
			foreach($item_array as $row) {
				echo "<b>".$row['description']." (".$row['quantity'].") - $".$row['price']."</b><br />";
				$total = $total + $row['price'];
			}
			echo "<br /> &nbsp; <br /><b>Delivery Fee: $1.00</b><br /> <i>This fee goes directly to supporting our staff</i> <br />";
			
			echo "<br /> &nbsp; <br /><b>TOTAL: $".$total."</b><br /> &nbsp; <br />";
?>				
	 				<a href='#' class='btn btn-large btn-success checkout_holder' id='customButton'> CHECKOUT</a><br /> &nbsp; <br />
	 				<a href='main.php'>Update Order</a>		<br /> &nbsp; <br />
	 				<img src="images/Stripe.png" height='40px'>						
		
				</div>
			</div>
			
			<div class='row' id="address">

				<div class='col-md-12 text-center'>

					<div class='row'>
						<div class='col-md-12 text-center'>
							<div class="error" style="color:red; display:none"><b>All Fields Required</b></div>
							<form class="form-horizontal">
								<div class="form-group">
							   		<label for="name" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label" style="color:black">Full Name</label>
							   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
								   		<input type='text' class='name form-control'  placeholder='Name' id='name'>   
									</div>
								</div>
								
								
								<div class="form-group">
							   		<label for="email" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label" style="color:black">Email</label>
							   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
								   		<input type='text' class='email form-control'  placeholder='Email' id='email'>   
									</div>
								</div>								
								
								<div class="form-group">
							   		<label for="street" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label" style="color:black">Street</label>
							   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
								   		<input type='text' class='street form-control'  placeholder='Street' id='street'>   
									</div>
								</div>

								<div class="form-group">
							   		<label for="zip" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label" style="color:black">Zip Code</label>
							   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
								   		<input type='text' class='zip form-control'  placeholder='Zip Code' id='zip'>   
									</div>
								</div>

								<div class="form-group">
							   		<label for="phone" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label" style="color:black">Phone</label>
							   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
								   		<input type='text' class='phone form-control'  placeholder='Phone' id='phone'>   
									</div>
								</div>

								<div class="form-group">
							   		<label for="notes" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label" style="color:black">Notes</label>
							   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
								   		<input type='text' class='notes form-control'  placeholder='Any notes regarding your order' id='notes'>   
									</div>
								</div>

								<div class="form-group">
							   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0"><b>Delivery Day/Time</b>
								   		<select id="day">
									   		<option value="monday">Monday</option>
									   		<option value="tuesday">Tuesday</option>
									   		<option value="wednesday">Wednesday</option>
									   		<option value="thursday">Thursday</option>
									   		<option value="friday">Friday</option>
									   		<option value="saturday">Saturday</option>
									   		<option value="sunday">Sunday</option>
								   		</select>  
								   		<select id="time">
									   		<option value="8AM">8 AM</option>
									   		<option value="830AM">8:30 AM</option>
									   		<option value="9AM">9 AM</option>
									   		<option value="930AM">9:30 AM</option>
									   		<option value="10AM">10 AM</option>
									   		<option value="1030AM">10:30 AM</option>
									   		<option value="11AM">11 AM</option>
									   		<option value="1130AM">11:30 AM</option>
									   		<option value="12PM">12 PM</option>
									   		<option value="1230PM">12:30 PM</option>
									   		<option value="1PM">1 PM</option>
									   		<option value="130PM">1:30 PM</option>
									   		<option value="2PM">2 PM</option>
									   		<option value="230PM">2:30 PM</option>
									   		<option value="3PM">3 PM</option>
									   		<option value="330PM">3:30 PM</option>
									   		<option value="4PM">4 PM</option>
									   		<option value="430PM">4:30 PM</option>
									   		<option value="5PM">5 PM</option>
								   		</select>  
								   		
									</div>
								</div>
								
								
							</form><br />

							<div class='row'>
								<div class="col-md-12 text-center">
									<a href='#' class='btn btn-large btn-primary' id="enter_address">Next Step</a>
								</div>					
							</div>

						</div>
					</div><br />
					
				</div>
			</div>
		</div>
		
		<div class='row' id="loader" style="display:none">
			<div class='col-md-12 text-center'>
				<h2 style="color:white">Loading....</h2>
			</div>
		</div>

		
	</div><br />
</div>	
<?php	
}

function admin_login_html() {
?>
<div id='holder'>

<div class='dashboard block block-pd-sm'>
		<div class='container text-center'>
			<h1>Open Orders</h1>
			<div class="form-group">
		   		<label for="password" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label" style="color:black">Password</label>
		   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
			   		<input type='text' class='password form-control'  placeholder='Password' id='password'>   
				</div>
			</div>
			<a href="#" id="login">ENTER</a>
		</div>
<?php
}

function admin_html($open_orders) {
	$pop = new Pop;
?>
<div id='holder'>

<div class='dashboard block block-pd-sm'>
		<div class='container text-center'>
			<h1>Open Orders</h1>
<?php
			foreach($open_orders as $row) {
				//get cart
				$item_array = $pop->get_cart($row['orderID']);
?>
					<div class='row'>
						<div class='col-md-12 text-center'>
							<? echo $row['first_name']." ".$row['last_name'] ?><br />
							<? echo $row['street']." - ".$row['zip'] ?><br />
							<? echo $row['phone'] ?><br />
							<? echo $row['email'] ?><br />
							<? echo $row['day']."/".$row['time'] ?><br />
							<? echo $row['notes'] ?><br />
							<? echo $row['date_created'] ?><br />

							<div class='row'>
<?php
							foreach($item_array as $item) {
								 echo $item['description']." (".$item['quantity'].") - ".$item['price']."<br />";
							}
?>
								<div class='col-md-12 text-center'>
		
									<div class='row'>
										<a href='#' id="<? echo $row['orderID'] ?>" class="delivered" >Delivery Complete</a>
									</div>
		
								</div>
							</div><br />
							
						</div>
					</div>

<?php
			}
?>
				</div>
				<a href='#' id='logout'>Logout</a>
		
		<div class='row' id="loader" style="display:none">
			<div class='col-md-12 text-center'>
				<h2 style="color:white">Loading....</h2>
			</div>
		</div>

		
	</div><br />
</div>	
<?php
}

function thank_you_html() {
	$pop = new Pop;
?>
<div id='holder'>

<div class='dashboard block block-pd-sm'>
		<div class='container text-center'>
			<h2 style='color:black'>Thank You</h1><br />
			A receipt has been sent to your email address.<br /> &nbsp; <br />
			We will contact you if we have any questions about your order<br /> &nbsp; <br />
		
	</div><br />
</div>	
<?php
	
}

function error_html() {
?>


<div id='holder'>

<div class='dashboard block block-pd-sm'>
		<div class='container text-center' style="color: black">
			<h1>Oops</h1>
			<h5 style="color: white">Something went wrong.</h5>

		</div>
	</div><br />
</div>	

<?php
}
	
		
?>