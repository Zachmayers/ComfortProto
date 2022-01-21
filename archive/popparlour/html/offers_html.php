<?php	
	
function offers_open_html($open_offers, $accepted_trades) {
	$utilities = new Utilities;
	$offers = new Offers($_SESSION['userID']);

	//break arrays
	$open_offers_wanted = $open_offers['wanted'];
	$open_offers_offered = $open_offers['offered'];

	$accepted_trades_wanted = $accepted_trades['wanted'];
	$accepted_trades_offered = $accepted_trades['offered'];

var_dump($open_offers);
?>		
	<div class='container' style="min-height: 70%">
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-9 col-md-offset-3">
				<h2 style="color:black"><i class="fa fa-map-o" aria-hidden="true"></i>  Offers & Trades</h2>
			</div>	
		</div>

		<div class='row' style="margin-bottom:12px">
			<div class="col-md-9 col-md-offset-3">
				<h3 style="color:black">Current Offers</h3>
			</div>	
		</div>
<?php
		if (count($open_offers_offered) > 0) {
			foreach($open_offers_offered as $row) {
				$offerID = $row['tradeID'];
				$offered_itemID = $row['item_offered'];
				$offered_name = $row['name'];
				$offered_pic = $row['photo'];
				$offered_category = $row['category'];
				$offered_description = $row['description'];
				$offer_date = $row['date'];

				foreach($open_offers_wanted as $want) {
					if ($want['tradeID'] == $offerID) {
						$wanted_itemID = $want['item_wanted'];
						$wanted_name = $want['name'];
						$wanted_pic = $want['photo'];
						$wanted_category = $want['category'];
						$wanted_description = $want['description'];						
					}
				}
?>	
					<div class="row item_row" style='font-size:16px; margin-bottom:12px'>	
						
						<div class="col-md-5 col-xs-5" >
				            <div class="panel panel-default panel-opportunity">
				            	<div class="panel-heading text-center">
					                <h5 class="panel-title">
					                	<? echo $offered_name ?>
					                </h5>
				            	</div>
            
								<div class="panel-body" style="color: black; ">
									<div class="col-md-5 col-xs-12" >
							        	<a href='#' class='view_item' id='<? echo $offered_itemID ?>'>
								        	<img src="images/items/<? echo $offered_pic ?>.jpg" class="center-block; img-fluid img-responsive" >
							        	</a>
									</div>
									<div class="col-md-7 hidden-xs" >
										<h4 style="margin-top: -5px;"><? echo $offered_category ?></h5>
										<span style="color: gray"><? echo $offered_description ?></span>
									</div>
									<div class="col-xs-12 visible-xs" >
										<a href='#'>View </a>
									</div>
									
				              	</div>
				              	
				              	<div class="panel-footer text-center visible-xs">
					                View Details
				            	</div>

				              	
				            </div>
				        </div>
						<div class="col-md-2 col-xs-2">
							FOR
						</div>
						<div class="col-md-5 col-xs-5" >
				            <div class="panel panel-default panel-opportunity">
				            	<div class="panel-heading text-center">
					                <h5 class="panel-title">
					                	<? echo $wanted_name ?>
					                </h5>
				            	</div>
            
								<div class="panel-body" style="color: black; padding:0" >
									<div class="col-md-5 col-xs-12">
							        	<img src="images/items/<? echo $wanted_pic ?>.jpg" class="center-block; img-fluid img-responsive" >
									</div>
									<div class="col-md-7 hidden-xs" >
										<h4 style="margin-top: 10px;"><? echo $wanted_category ?></h5>
										<span style="color: gray"><? echo $wanted_description ?></span><br />
										View Details
									</div>
				              	</div>
				              	<div class="panel-footer text-center visible-xs">
					                View Details
				            	</div>

				            </div>
				        </div>

						<div class="col-md-12 col-xs-12 text-center">
							Trade offered <? echo $offer_date ?>
						</div>
				        
						<div class="col-md-12 col-xs-12 text-center">
							<a href='#' class="accept btn btn-success" id="<? echo $offerID ?>">Accept</a>
							<a href='#' class="reject btn btn-success" id="<? echo $offerID ?>">Decline</a>
						</div>
<hr>
		</div>
<?php
					
		}
	} else {
?>
		<div class="row item_row" style='font-size:16px; margin-bottom:12px'>		
			<div class="col-md-12 ">
				NONE
			</div>
		</div>
<?php		
	} 
?>

		<div class='row' style="margin-bottom:12px">
			<div class="col-md-9 col-md-offset-3">
				<h3 style="color:black">Accepted Trades</h3>
			</div>	
		</div>
<?php
		if (count($accepted_trades_offered) > 0) {
			foreach($accepted_trades_offered as $row) {
				$offerID = $row['tradeID'];
				$offered_itemID = $row['item_offered'];
				$offered_name = $row['name'];
				$offered_pic = $row['photo'];
				$offered_category = $row['category'];
				$offered_description = $row['description'];

				foreach($accepted_trades_wanted as $want) {
					if ($want['tradeID'] == $offerID) {
						$wanted_itemID = $want['item_wanted'];
						$wanted_name = $want['name'];
						$wanted_pic = $want['photo'];
						$wanted_category = $want['category'];
						$wanted_description = $want['description'];												
					}
				}
?>	
					<div class="row item_row" style='font-size:16px; margin-bottom:12px'>		
						<div class="col-md-5 col-xs-5" >
				            <div class="panel panel-default panel-opportunity">
				            	<div class="panel-heading text-center">
					                <h5 class="panel-title">
					                	<? echo $offered_name ?>
					                </h5>
				            	</div>
            
								<div class="panel-body" style="color: black; ">
									<div class="col-md-5 col-xs-5">
							        	<a href='#' class='view_item' id='<? echo $offered_itemID ?>'>
								        	<img src="images/items/<? echo $offered_pic ?>.jpg" class="center-block; img-fluid img-responsive" >
							        	</a>
									</div>
									<div class="col-md-7 col-xs-7" >
										<h4 style="margin-top: -5px;"><? echo $offered_category ?></h5>
										<span style="color: gray"><? echo $offered_description ?></span>
									</div>
				              	</div>
				            </div>
				        </div>
						<div class="col-md-2 ">
							for
						</div>
						<div class="col-md-5 col-xs-5" >
				            <div class="panel panel-default panel-opportunity">
				            	<div class="panel-heading text-center">
					                <h5 class="panel-title">
					                	<? echo $wanted_name ?>
					                </h5>
				            	</div>
            
								<div class="panel-body" style="color: black; ">
									<div class="col-md-5 col-xs-5">
							        	<img src="images/items/<? echo $wanted_pic ?>.jpg" class="center-block; img-fluid img-responsive" >
									</div>
									<div class="col-md-7 col-xs-7" >
										<h4 style="margin-top: -5px;"><? echo $wanted_category ?></h5>
										<span style="color: gray"><? echo $wanted_description ?></span>
									</div>
				              	</div>
				            </div>
				        </div>
					
							<div class="col-md-12 text-center">
								TRADE ACCEPTED! <br />
								<a href="message.php?tradeID=<? echo $offerID ?>">Open Messages</a><br />
								Have you completed this trade? <a href="trade.php?tradeID=<? echo $offerID ?>">Completed</a>
							</div>
<hr>
		</div>
<?php
					
		}
	} else {
?>
		<div class="row item_row" style='font-size:16px; margin-bottom:12px'>		
			<div class="col-md-12 ">
				NONE
			</div>
		</div>
<?php		
	} 
?>
	</div>	
<?php
}	

function offers_pending_html($pending_trades, $accepted_trades) {
	$utilities = new Utilities;
	$offers = new Offers($_SESSION['userID']);

	//break arrays
	$pending_trades_wanted = $pending_trades['wanted'];
	$pending_trades_offered = $pending_trades['offered'];

	$accepted_trades_wanted = $accepted_trades['wanted'];
	$accepted_trades_offered = $accepted_trades['offered'];
?>
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-9 col-md-offset-3">
				<h3 style="color:black">Pending Trades</h3>
			</div>	
		</div>
<?php
		
		if (count($pending_trades_offered) > 0) {
			foreach($pending_trades_offered as $row) {
				$offerID = $row['tradeID'];
				$offered_itemID = $row['item_offered'];
				$offered_name = $row['name'];
				$offered_pic = $row['photo'];
				$offered_category = $row['category'];
				$offered_description = $row['description'];

				foreach($pending_trades_wanted as $want) {
					if ($want['tradeID'] == $offerID) {
						$wanted_itemID = $want['item_wanted'];
						$wanted_name = $want['name'];
						$wanted_pic = $want['photo'];
						$wanted_category = $want['category'];
						$wanted_description = $want['description'];												
					}
				}
?>	
					<div class="row item_row" style='font-size:16px; margin-bottom:12px'>		
						<div class="col-md-5 col-xs-5" >
				            <div class="panel panel-default panel-opportunity">
				            	<div class="panel-heading text-center">
					                <h5 class="panel-title">
					                	<? echo $offered_name ?>
					                </h5>
				            	</div>
            
								<div class="panel-body" style="color: black; ">
									<div class="col-md-5 col-xs-5">
							        	<a href='#' class='view_item' id='<? echo $offered_itemID ?>'>
								        	<img src="images/items/<? echo $offered_pic ?>.jpg" class="center-block; img-fluid img-responsive" >
							        	</a>
									</div>
									<div class="col-md-7 col-xs-7" >
										<h4 style="margin-top: -5px;"><? echo $offered_category ?></h5>
										<span style="color: gray"><? echo $offered_description ?></span>
									</div>
				              	</div>
				            </div>
				        </div>
						<div class="col-md-2 ">
							for
						</div>
						<div class="col-md-5 col-xs-5" >
				            <div class="panel panel-default panel-opportunity">
				            	<div class="panel-heading text-center">
					                <h5 class="panel-title">
					                	<? echo $wanted_name ?>
					                </h5>
				            	</div>
            
								<div class="panel-body" style="color: black; ">
									<div class="col-md-5 col-xs-5">
							        	<img src="images/items/<? echo $wanted_pic ?>.jpg" class="center-block; img-fluid img-responsive" >
									</div>
									<div class="col-md-7 col-xs-7" >
										<h4 style="margin-top: -5px;"><? echo $wanted_category ?></h5>
										<span style="color: gray"><? echo $wanted_description ?></span>
									</div>
				              	</div>
				            </div>
				        </div>
<hr>
		</div>
<?php
					
		}
	} else {
?>
		<div class="row item_row" style='font-size:16px; margin-bottom:12px'>		
			<div class="col-md-12 ">
				NONE
			</div>
		</div>
<?php		
	} 
?>	

		<div class='row' style="margin-bottom:12px">
			<div class="col-md-9 col-md-offset-3">
				<h3 style="color:black">Accepted Trades</h3>
			</div>	
		</div>
<?php
		if (count($accepted_trades_offered) > 0) {
			foreach($accepted_trades_offered as $row) {
				$offerID = $row['tradeID'];
				$offered_itemID = $row['item_offered'];
				$offered_name = $row['name'];
				$offered_pic = $row['photo'];
				$offered_category = $row['category'];
				$offered_description = $row['description'];

				foreach($accepted_trades_wanted as $want) {
					if ($want['tradeID'] == $offerID) {
						$wanted_itemID = $want['item_wanted'];
						$wanted_name = $want['name'];
						$wanted_pic = $want['photo'];
						$wanted_category = $want['category'];
						$wanted_description = $want['description'];												
					}
				}
?>	
					<div class="row item_row" style='font-size:16px; margin-bottom:12px'>		
						<div class="col-md-5 col-xs-5" >
				            <div class="panel panel-default panel-opportunity">
				            	<div class="panel-heading text-center">
					                <h5 class="panel-title">
					                	<? echo $offered_name ?>
					                </h5>
				            	</div>
            
								<div class="panel-body" style="color: black; ">
									<div class="col-md-5 col-xs-5">
							        	<a href='#' class='view_item' id='<? echo $offered_itemID ?>'>
								        	<img src="images/items/<? echo $offered_pic ?>.jpg" class="center-block; img-fluid img-responsive" >
							        	</a>
									</div>
									<div class="col-md-7 col-xs-7" >
										<h4 style="margin-top: -5px;"><? echo $offered_category ?></h5>
										<span style="color: gray"><? echo $offered_description ?></span>
									</div>
				              	</div>
				            </div>
				        </div>
						<div class="col-md-2 ">
							for
						</div>
						<div class="col-md-5 col-xs-5" >
				            <div class="panel panel-default panel-opportunity">
				            	<div class="panel-heading text-center">
					                <h5 class="panel-title">
					                	<? echo $wanted_name ?>
					                </h5>
				            	</div>
            
								<div class="panel-body" style="color: black; ">
									<div class="col-md-5 col-xs-5">
							        	<img src="images/items/<? echo $wanted_pic ?>.jpg" class="center-block; img-fluid img-responsive" >
									</div>
									<div class="col-md-7 col-xs-7" >
										<h4 style="margin-top: -5px;"><? echo $wanted_category ?></h5>
										<span style="color: gray"><? echo $wanted_description ?></span>
									</div>
				              	</div>
				            </div>
				        </div>
					
							<div class="col-md-12 text-center">
								TRADE ACCEPTED! <br />
								<a href="message.php?tradeID=<? echo $offerID ?>">Open Messages</a><br />
								Have you completed this trade? <a href="trade.php?tradeID=<? echo $offerID ?>">Completed</a>
							</div>
<hr>
		</div>
<?php
					
		}
	} else {
?>
		<div class="row item_row" style='font-size:16px; margin-bottom:12px'>		
			<div class="col-md-12 ">
				NONE
			</div>
		</div>
<?php		
	} 
?>
	</div>	
<?php
}

function offers_complete_html($completed_trades, $revoked_trades, $rejected_trades) {
	$utilities = new Utilities;
	$offers = new Offers($_SESSION['userID']);

	//break arrays
	$completed_trades_wanted = $completed_trades['wanted'];
	$completed_trades_offered = $completed_trades['offered'];

	$revoked_trades_wanted = $revoked_trades['wanted'];
	$revoked_trades_offered = $revoked_trades['offered'];
	
	$rejected_trades_wanted = $rejected_trades['wanted'];
	$rejected_trades_offered = $rejected_trades['offered'];
	
?>
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-9 col-md-offset-3">
				<h3 style="color:black">Completed Trades</h3>
			</div>	
		</div>
<?php
		if (count($completed_trades_offered) > 0) {
			foreach($completed_trades_offered as $row) {
				$offerID = $row['tradeID'];
				$offered_itemID = $row['item_offered'];
				$offered_name = $row['name'];
				$offered_pic = $row['photo'];
				$offered_category = $row['category'];
				$offered_description = $row['description'];
				foreach($completed_trades_wanted as $want) {
					if ($want['tradeID'] == $offerID) {
						$wanted_itemID = $want['item_wanted'];
						$wanted_name = $want['name'];
						$wanted_pic = $want['photo'];
						$wanted_category = $want['category'];
						$wanted_description = $want['description'];												
					}
				}
?>	
					<div class="row item_row" style='font-size:16px; margin-bottom:12px'>		
						<div class="col-md-5 col-xs-5" >
				            <div class="panel panel-default panel-opportunity">
				            	<div class="panel-heading text-center">
					                <h5 class="panel-title">
					                	<? echo $offered_name ?>
					                </h5>
				            	</div>
            
								<div class="panel-body" style="color: black; ">
									<div class="col-md-5 col-xs-5">
							        	<a href='#' class='view_item' id='<? echo $offered_itemID ?>'>
								        	<img src="images/items/<? echo $offered_pic ?>.jpg" class="center-block; img-fluid img-responsive" >
							        	</a>
									</div>
									<div class="col-md-7 col-xs-7" >
										<h4 style="margin-top: -5px;"><? echo $offered_category ?></h5>
										<span style="color: gray"><? echo $offered_description ?></span>
									</div>
				              	</div>
				            </div>
				        </div>
						<div class="col-md-2 ">
							for
						</div>
						<div class="col-md-5 col-xs-5" >
				            <div class="panel panel-default panel-opportunity">
				            	<div class="panel-heading text-center">
					                <h5 class="panel-title">
					                	<? echo $wanted_name ?>
					                </h5>
				            	</div>
            
								<div class="panel-body" style="color: black; ">
									<div class="col-md-5 col-xs-5">
							        	<img src="images/items/<? echo $wanted_pic ?>.jpg" class="center-block; img-fluid img-responsive" >
									</div>
									<div class="col-md-7 col-xs-7" >
										<h4 style="margin-top: -5px;"><? echo $wanted_category ?></h5>
										<span style="color: gray"><? echo $wanted_description ?></span>
									</div>
				              	</div>
				            </div>
				        </div>
							<div class="col-md-12 ">
								<i>Trade Completed</i>
							</div>
<hr>
		</div>
<?php
					
		}
	} else {
?>
		<div class="row item_row" style='font-size:16px; margin-bottom:12px'>		
			<div class="col-md-12 ">
				NONE
			</div>
		</div>
<?php		
	} 
?>

		<div class='row' style="margin-bottom:12px">
			<div class="col-md-9 col-md-offset-3">
				<h3 style="color:black">Rejected Trades</h3>
			</div>	
		</div>
<?php
		if (count($rejected_trades_offered) > 0) {
			foreach($rejected_trades_offered as $row) {
				$offerID = $row['tradeID'];
				$offered_itemID = $row['item_offered'];
				$offered_name = $row['name'];
				$offered_pic = $row['photo'];
				$offered_category = $row['category'];
				$offered_description = $row['description'];
				foreach($rejected_trades_wanted as $want) {
					if ($want['tradeID'] == $offerID) {
						$wanted_itemID = $want['item_wanted'];
						$wanted_name = $want['name'];
						$wanted_pic = $want['photo'];
						$wanted_category = $want['category'];
						$wanted_description = $want['description'];												
					}
				}
?>	
					<div class="row item_row" style='font-size:16px; margin-bottom:12px'>		
						<div class="col-md-5 col-xs-5" >
				            <div class="panel panel-default panel-opportunity">
				            	<div class="panel-heading text-center">
					                <h5 class="panel-title">
					                	<? echo $offered_name ?>
					                </h5>
				            	</div>
            
								<div class="panel-body" style="color: black; ">
									<div class="col-md-5 col-xs-5">
							        	<a href='#' class='view_item' id='<? echo $offered_itemID ?>'>
								        	<img src="images/items/<? echo $offered_pic ?>.jpg" class="center-block; img-fluid img-responsive" >
							        	</a>
									</div>
									<div class="col-md-7 col-xs-7" >
										<h4 style="margin-top: -5px;"><? echo $offered_category ?></h5>
										<span style="color: gray"><? echo $offered_description ?></span>
									</div>
				              	</div>
				            </div>
				        </div>
						<div class="col-md-2 ">
							for
						</div>
						<div class="col-md-5 col-xs-5" >
				            <div class="panel panel-default panel-opportunity">
				            	<div class="panel-heading text-center">
					                <h5 class="panel-title">
					                	<? echo $wanted_name ?>
					                </h5>
				            	</div>
            
								<div class="panel-body" style="color: black; ">
									<div class="col-md-5 col-xs-5">
							        	<img src="images/items/<? echo $wanted_pic ?>.jpg" class="center-block; img-fluid img-responsive" >
									</div>
									<div class="col-md-7 col-xs-7" >
										<h4 style="margin-top: -5px;"><? echo $wanted_category ?></h5>
										<span style="color: gray"><? echo $wanted_description ?></span>
									</div>
				              	</div>
				            </div>
				        </div>
					
							<div class="col-md-12 ">
								<i>Trade declined</i>
							</div>
<hr>
		</div>
<?php
					
		}
	} else {
?>
		<div class="row item_row" style='font-size:16px; margin-bottom:12px'>		
			<div class="col-md-12 ">
				NONE
			</div>
		</div>
<?php		
	} 
?>
</div>
<?php
}

function offers_failed_html($failed_trades, $idsputed_trades) {
	$utilities = new Utilities;
	$offers = new Offers($_SESSION['userID']);

	//break arrays
	$failed_trades_wanted = $failed_trades['wanted'];
	$failed_trades_offered = $failed_trades['offered'];

	$disputed_trades_wanted = $disputed_trades['wanted'];
	$disputed_trades_offered = $disputed_trades['offered'];
	
?>
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-9 col-md-offset-3">
				<h3 style="color:black">Failed Trades</h3>
			</div>	
		</div>
<?php
		if (count($failed_trades_offered) > 0) {
			foreach($failed_trades_offered as $row) {
				$offerID = $row['tradeID'];
				$offered_itemID = $row['item_offered'];
				$offered_name = $row['name'];
				$offered_pic = $row['photo'];
				$offered_category = $row['category'];
				$offered_description = $row['description'];
				foreach($failed_trades_wanted as $want) {
					if ($want['tradeID'] == $offerID) {
						$wanted_itemID = $want['item_wanted'];
						$wanted_name = $want['name'];
						$wanted_pic = $want['photo'];
						$wanted_category = $want['category'];
						$wanted_description = $want['description'];												
					}
				}
?>	
					<div class="row item_row" style='font-size:16px; margin-bottom:12px'>		
						<div class="col-md-5 col-xs-5" >
				            <div class="panel panel-default panel-opportunity">
				            	<div class="panel-heading text-center">
					                <h5 class="panel-title">
					                	<? echo $offered_name ?>
					                </h5>
				            	</div>
            
								<div class="panel-body" style="color: black; ">
									<div class="col-md-5 col-xs-5">
							        	<a href='#' class='view_item' id='<? echo $offered_itemID ?>'>
								        	<img src="images/items/<? echo $offered_pic ?>.jpg" class="center-block; img-fluid img-responsive" >
							        	</a>
									</div>
									<div class="col-md-7 col-xs-7" >
										<h4 style="margin-top: -5px;"><? echo $offered_category ?></h5>
										<span style="color: gray"><? echo $offered_description ?></span>
									</div>
				              	</div>
				            </div>
				        </div>
						<div class="col-md-2 ">
							for
						</div>
						<div class="col-md-5 col-xs-5" >
				            <div class="panel panel-default panel-opportunity">
				            	<div class="panel-heading text-center">
					                <h5 class="panel-title">
					                	<? echo $wanted_name ?>
					                </h5>
				            	</div>
            
								<div class="panel-body" style="color: black; ">
									<div class="col-md-5 col-xs-5">
							        	<img src="images/items/<? echo $wanted_pic ?>.jpg" class="center-block; img-fluid img-responsive" >
									</div>
									<div class="col-md-7 col-xs-7" >
										<h4 style="margin-top: -5px;"><? echo $wanted_category ?></h5>
										<span style="color: gray"><? echo $wanted_description ?></span>
									</div>
				              	</div>
				            </div>
				        </div>
								<i>Trade Failed</i>
							</div>
<hr>
		</div>
<?php
					
		}
	} else {
?>
		<div class="row item_row" style='font-size:16px; margin-bottom:12px'>		
			<div class="col-md-12 ">
				NONE
			</div>
		</div>
<?php		
	} 
?>	

		<div class='row' style="margin-bottom:12px">
			<div class="col-md-9 col-md-offset-3">
				<h3 style="color:black">Disputed Trades</h3>
			</div>	
		</div>
<?php
		if (count($disputed_trades_offered) > 0) {
			foreach($disputed_trades_offered as $row) {
				$offerID = $row['tradeID'];
				$offered_itemID = $row['item_offered'];
				$offered_name = $row['name'];
				$offered_pic = $row['photo'];
				$offered_category = $row['category'];
				$offered_description = $row['description'];
				foreach($disputed_trades_wanted as $want) {
					if ($want['tradeID'] == $offerID) {
						$wanted_itemID = $want['item_wanted'];
						$wanted_name = $want['name'];
						$wanted_pic = $want['photo'];
						$wanted_category = $want['category'];
						$wanted_description = $want['description'];												
					}
				}
?>	
					<div class="row item_row" style='font-size:16px; margin-bottom:12px'>		
						<div class="col-md-5 col-xs-5" >
				            <div class="panel panel-default panel-opportunity">
				            	<div class="panel-heading text-center">
					                <h5 class="panel-title">
					                	<? echo $offered_name ?>
					                </h5>
				            	</div>
            
								<div class="panel-body" style="color: black; ">
									<div class="col-md-5 col-xs-5">
							        	<a href='#' class='view_item' id='<? echo $offered_itemID ?>'>
								        	<img src="images/items/<? echo $offered_pic ?>.jpg" class="center-block; img-fluid img-responsive" >
							        	</a>
									</div>
									<div class="col-md-7 col-xs-7" >
										<h4 style="margin-top: -5px;"><? echo $offered_category ?></h5>
										<span style="color: gray"><? echo $offered_description ?></span>
									</div>
				              	</div>
				            </div>
				        </div>
						<div class="col-md-2 ">
							for
						</div>
						<div class="col-md-5 col-xs-5" >
				            <div class="panel panel-default panel-opportunity">
				            	<div class="panel-heading text-center">
					                <h5 class="panel-title">
					                	<? echo $wanted_name ?>
					                </h5>
				            	</div>
            
								<div class="panel-body" style="color: black; ">
									<div class="col-md-5 col-xs-5">
							        	<img src="images/items/<? echo $wanted_pic ?>.jpg" class="center-block; img-fluid img-responsive" >
									</div>
									<div class="col-md-7 col-xs-7" >
										<h4 style="margin-top: -5px;"><? echo $wanted_category ?></h5>
										<span style="color: gray"><? echo $wanted_description ?></span>
									</div>
				              	</div>
				            </div>
				        </div>
					
							<div class="col-md-12 ">
								<i>Trade Disputed</i>
							</div>
<hr>
		</div>
<?php
					
		}
	} else {
?>
		<div class="row item_row" style='font-size:16px; margin-bottom:12px'>		
			<div class="col-md-12 ">
				NONE
			</div>
		</div>
<?php		
	} 

?>
	</div>

<?php
}
	
function offers_html($pending_trades, $open_offers, $accepted_trades, $completed_trades, $revoked_trades, $rejected_trades, $failed_trades, $disputed_trades) {
	$utilities = new Utilities;
	$offers = new Offers($_SESSION['userID']);
	
	//break arrays
	$pending_trades_wanted = $pending_trades['wanted'];
	$pending_trades_offered = $pending_trades['offered'];

	$open_offers_wanted = $open_offers['wanted'];
	$open_offers_offered = $open_offers['offered'];

	$accepted_trades_wanted = $accepted_trades['wanted'];
	$accepted_trades_offered = $accepted_trades['offered'];

	$completed_trades_wanted = $completed_trades['wanted'];
	$completed_trades_offered = $completed_trades['offered'];

	$revoked_trades_wanted = $revoked_trades['wanted'];
	$revoked_trades_offered = $revoked_trades['offered'];

	$rejected_trades_wanted = $rejected_trades['wanted'];
	$rejected_trades_offered = $rejected_trades['offered'];

	$failed_trades_wanted = $failed_trades['wanted'];
	$failed_trades_offered = $failed_trades['offered'];

	$disputed_trades_wanted = $disputed_trades['wanted'];
	$disputed_trades_offered = $disputed_trades['offered'];
	
?>		
	<div class='container' style="min-height: 70%">
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-9 col-md-offset-3">
				<h2 style="color:black"><i class="fa fa-map-o" aria-hidden="true"></i>  Offers & Trades</h2>
			</div>	
		</div>

		<div class='row' style="margin-bottom:12px">
			<div class="col-md-9 col-md-offset-3">
				<h3 style="color:black">Current Offers</h3>
			</div>	
		</div>
<?php
		if (count($open_offers_offered) > 0) {
			foreach($open_offers_offered as $row) {
				$offerID = $row['tradeID'];
				$offered_itemID = $row['item_offered'];
				$offered_name = $row['name'];
				foreach($open_offers_wanted as $want) {
					if ($want['tradeID'] == $offerID) {
						$wanted_itemID = $want['item_wanted'];
						$wanted_name = $want['name'];
					}
				}
?>	
					<div class="row item_row" style='font-size:16px; margin-bottom:12px'>		
						<div class="col-md-12 ">
							<a href='#' class='view_item' id='<? echo $offered_itemID ?>'> <? echo $offered_name?></a>
							for <a href='#' class='view_item' id='<? echo $wanted_itemID ?>'> <? echo $wanted_name?></a>
						</div>
					
						<div class="col-md-12">
							<a href='#' class="accept btn btn-success" id="<? echo $offerID ?>">Accept</a>
							<a href='#' class="reject btn btn-success" id="<? echo $offerID ?>">Decline</a>
						</div>
<hr>
		</div>
<?php
					
		}
	} else {
?>
		<div class="row item_row" style='font-size:16px; margin-bottom:12px'>		
			<div class="col-md-12 ">
				NONE
			</div>
		</div>
<?php		
	} 
?>

		<div class='row' style="margin-bottom:12px">
			<div class="col-md-9 col-md-offset-3">
				<h3 style="color:black">Accepted Trades</h3>
			</div>	
		</div>
<?php
		if (count($accepted_trades_offered) > 0) {
			foreach($accepted_trades_offered as $row) {
				$offerID = $row['tradeID'];
				$offered_itemID = $row['item_offered'];
				$offered_name = $row['name'];
				foreach($accepted_trades_wanted as $want) {
					if ($want['tradeID'] == $offerID) {
						$wanted_itemID = $want['item_wanted'];
						$wanted_name = $want['name'];
					}
				}
?>	
					<div class="row item_row" style='font-size:16px; margin-bottom:12px'>		
						<div class="col-md-12 ">
							<a href='#' class='view_item' id='<? echo $offered_itemID ?>'> <? echo $offered_name?></a>
							for <a href='#' class='view_item' id='<? echo $wanted_itemID ?>'> <? echo $wanted_name?></a>
						</div>
					
							<div class="col-md-12">
								TRADE ACCEPTED! <a href="message.php?tradeID=<? echo $offerID ?>">Open Messages</a><br />
								Have you completed this trade? <a href="trade.php?tradeID=<? echo $offerID ?>">Completed</a>
							</div>
<hr>
		</div>
<?php
					
		}
	} else {
?>
		<div class="row item_row" style='font-size:16px; margin-bottom:12px'>		
			<div class="col-md-12 ">
				NONE
			</div>
		</div>
<?php		
	} 
?>


		<div class='row' style="margin-bottom:12px">
			<div class="col-md-9 col-md-offset-3">
				<h3 style="color:black">Pending Trades</h3>
			</div>	
		</div>
				
<?php
		
		if (count($pending_trades_offered) > 0) {
			foreach($pending_trades_offered as $row) {
				$offerID = $row['tradeID'];
				$offered_itemID = $row['item_offered'];
				$offered_name = $row['name'];
				foreach($pending_trades_wanted as $want) {
					if ($want['tradeID'] == $offerID) {
						$wanted_itemID = $want['item_wanted'];
						$wanted_name = $want['name'];
					}
				}
?>	
					<div class="row item_row" style='font-size:16px; margin-bottom:12px'>		
						<div class="col-md-12 ">
							<a href='#' class='view_item' id='<? echo $offered_itemID ?>'> <? echo $offered_name?></a>
							for <a href='#' class='view_item' id='<? echo $wanted_itemID ?>'> <? echo $wanted_name?></a>
						</div>
					
<hr>
		</div>
<?php
					
		}
	} else {
?>
		<div class="row item_row" style='font-size:16px; margin-bottom:12px'>		
			<div class="col-md-12 ">
				NONE
			</div>
		</div>
<?php		
	} 
?>	
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-9 col-md-offset-3">
				<h3 style="color:black">Completed Trades</h3>
			</div>	
		</div>
<?php
		if (count($completed_trades_offered) > 0) {
			foreach($completed_trades_offered as $row) {
				$offerID = $row['tradeID'];
				$offered_itemID = $row['item_offered'];
				$offered_name = $row['name'];
				foreach($completed_trades_wanted as $want) {
					if ($want['tradeID'] == $offerID) {
						$wanted_itemID = $want['item_wanted'];
						$wanted_name = $want['name'];
					}
				}
?>	
					<div class="row item_row" style='font-size:16px; margin-bottom:12px'>		
						<div class="col-md-12 ">
							<a href='#' class='view_item' id='<? echo $offered_itemID ?>'> <? echo $offered_name?></a>
							for <a href='#' class='view_item' id='<? echo $wanted_itemID ?>'> <? echo $wanted_name?></a>
						</div>
							<div class="col-md-12 ">
								<i>Trade Completed</i>
							</div>
<hr>
		</div>
<?php
					
		}
	} else {
?>
		<div class="row item_row" style='font-size:16px; margin-bottom:12px'>		
			<div class="col-md-12 ">
				NONE
			</div>
		</div>
<?php		
	} 
?>

		<div class='row' style="margin-bottom:12px">
			<div class="col-md-9 col-md-offset-3">
				<h3 style="color:black">Rejected Trades</h3>
			</div>	
		</div>
<?php
		if (count($rejected_trades_offered) > 0) {
			foreach($rejected_trades_offered as $row) {
				$offerID = $row['tradeID'];
				$offered_itemID = $row['item_offered'];
				$offered_name = $row['name'];
				foreach($rejected_trades_wanted as $want) {
					if ($want['tradeID'] == $offerID) {
						$wanted_itemID = $want['item_wanted'];
						$wanted_name = $want['name'];
					}
				}
?>	
					<div class="row item_row" style='font-size:16px; margin-bottom:12px'>		
						<div class="col-md-12 ">
							<a href='#' class='view_item' id='<? echo $offered_itemID ?>'> <? echo $offered_name?></a>
							for <a href='#' class='view_item' id='<? echo $wanted_itemID ?>'> <? echo $wanted_name?></a>
						</div>
					
							<div class="col-md-12 ">
								<i>Trade declined</i>
							</div>
<hr>
		</div>
<?php
					
		}
	} else {
?>
		<div class="row item_row" style='font-size:16px; margin-bottom:12px'>		
			<div class="col-md-12 ">
				NONE
			</div>
		</div>
<?php		
	} 
?>
	
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-9 col-md-offset-3">
				<h3 style="color:black">Failed Trades</h3>
			</div>	
		</div>
<?php
		if (count($failed_trades_offered) > 0) {
			foreach($failed_trades_offered as $row) {
				$offerID = $row['tradeID'];
				$offered_itemID = $row['item_offered'];
				$offered_name = $row['name'];
				foreach($failed_trades_wanted as $want) {
					if ($want['tradeID'] == $offerID) {
						$wanted_itemID = $want['item_wanted'];
						$wanted_name = $want['name'];
					}
				}
?>	
					<div class="row item_row" style='font-size:16px; margin-bottom:12px'>		
						<div class="col-md-12 ">
							<a href='#' class='view_item' id='<? echo $offered_itemID ?>'> <? echo $offered_name?></a>
							for <a href='#' class='view_item' id='<? echo $wanted_itemID ?>'> <? echo $wanted_name?></a>
						</div>
								<i>Trade Failed</i>
							</div>
<hr>
		</div>
<?php
					
		}
	} else {
?>
		<div class="row item_row" style='font-size:16px; margin-bottom:12px'>		
			<div class="col-md-12 ">
				NONE
			</div>
		</div>
<?php		
	} 
?>	

		<div class='row' style="margin-bottom:12px">
			<div class="col-md-9 col-md-offset-3">
				<h3 style="color:black">Disputed Trades</h3>
			</div>	
		</div>
<?php
		if (count($disputed_trades_offered) > 0) {
			foreach($disputed_trades_offered as $row) {
				$offerID = $row['tradeID'];
				$offered_itemID = $row['item_offered'];
				$offered_name = $row['name'];
				foreach($disputed_trades_wanted as $want) {
					if ($want['tradeID'] == $offerID) {
						$wanted_itemID = $want['item_wanted'];
						$wanted_name = $want['name'];
					}
				}
?>	
					<div class="row item_row" style='font-size:16px; margin-bottom:12px'>		
						<div class="col-md-12 ">
							<a href='#' class='view_item' id='<? echo $offered_itemID ?>'> <? echo $offered_name?></a>
							for <a href='#' class='view_item' id='<? echo $wanted_itemID ?>'> <? echo $wanted_name?></a>
						</div>
					
							<div class="col-md-12 ">
								<i>Trade Disputed</i>
							</div>
<hr>
		</div>
<?php
					
		}
	} else {
?>
		<div class="row item_row" style='font-size:16px; margin-bottom:12px'>		
			<div class="col-md-12 ">
				NONE
			</div>
		</div>
<?php		
	} 

?>
	</div>
<?php
 }


