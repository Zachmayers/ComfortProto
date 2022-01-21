<?php

function new_trade_html($item_details, $item_array) {

?>	
	<div class='container' style="min-height: 550px">
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-12 text-center">
				<h2 style="color:black">I want <? echo $item_details['name'] ?></h2>
			</div>	
		</div>
				
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-12 text-center">
				<h3>I offer</h3>
<?php
			if(count($item_array) > 0) {
				foreach($item_array as $row) {
?>
				<div class="col-md-12">		
					<a href='#' class='offer_item' id='<? echo $row['itemID'] ?>'> <? echo $row['name'] ?></a><br />
				</div>
<?php
				}				
			} else {
?>
			<div class="col-md-12">
				None			
			</div>
<?php				
			}
?>
		</div>
		
</div>
<?php
}	

function giver_trade_html($item_details, $status, $offer_details, $trade_details) {
?>	
	<div class='container' style="min-height: 550px">
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-12 text-center">
				<h2  style="color:black"><? echo $item_details['name'] ?></h2>
				<b>Type: <? echo $item_details['category'] ?></b><br />
				<i><? echo $item_details['description'] ?></i><br />
				&nbsp; <br />
				&nbsp; <br />
<?php
				switch($status) {
					case "open":
?>					
						<a href='trade.php?itemID=<? echo $item_details['itemID'] ?>' >Start Trade</a>
<?php					
					break;
					
					case "offered":
?>
<?php
						if ($trade_details['status'] == 'accepted') {
?>
							<i>Offer Accepted</i><br />					
<?php							
						} else {
?>
							<i>Offer Pending</i><br />
<?php							
						}
?>
						
						You Offered: <a href='item.php?id=<? echo $offer_details['itemID'] ?>' ><? echo $offer_details['name'] ?></a><br />
<?php
						if ($trade_details['status'] == 'accepted') {
?>
							<b>Trade Accepted</b>
							<a href='message.php?tradeID=<? echo $trade_details['tradeID'] ?>' >Messages</a><br />
							&nbsp; <br />
							<a href='#' class='complete_trade' id='<? echo $trade_details['tradeID'] ?>' >We've completed this trade</a><br />
							<a href='#' class='failed_trade' id='<? echo $trade_details['tradeID'] ?>' >This trade never happened</a>

							<div class='row' id='complete_trade_form' style="display:none">			
								<div class='col-md-12 text-center'>
											<div class='error col-md-10 col-md-offset-2' id='empty_warning' style="color:red; margin-bottom:5px; display:none"><b>Fields cannot be empty.</b></div>
								
											<form class="form-horizontal">
												<div class="form-group">				
													<label for="rating" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Rating</label>
													<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
														<select class='rating form-control' data-trade='<? echo $trade_details['tradeID'] ?>'>
															<option value='3'>Positive</option>
															<option value='2'>Neutral</option>
															<option value='1'>Negative</option>
														</select>
													</div>
													<label for="review" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Review</label>
													<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
														<input type='text' class='review form-control' id="review" data-trade='<? echo $trade_details['tradeID'] ?>' placeholder='Review'><br />
													</div>
													
											</form>
											
<?php
											if ($_SESSION['userID'] == $trade_details['ownerID'])	{
												$userID = $trade_details['ownerID'];
											} else {
												$userID = $trade_details['buyerID'];
											}
?>							

											<input type='hidden' class='userID'  data-trade='<? echo $trade_details['tradeID'] ?>' value="<? echo $userID ?>">
																						
											<div class="row" style="margin-bottom:25px">
												<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
													<button type="button" class="btn btn-success save_review" data-trade='<? echo $trade_details['tradeID'] ?>'>
														<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save Review
													</button>
													<button type="button" class="btn btn-link cancel_review" data-trade='<? echo $trade_details['tradeID'] ?>' style="color:#8e080b;">
														Cancel
													</button>
												</div>
											</div>							
										</div>
										
									</div>
							</div>

<?php							
						} else {
?>
							<a href='#' class='revoke_item' id='<? echo $trade_details['tradeID'] ?>'>Revoke</a>
<?php							
						}
					break;

					case "rejected":
?>
						<i>Offer Revoked</i><br />					
						<a href='trade.php?itemID=<? echo $item_details['itemID'] ?>&tradeID=new' >New Offer</a>
<?php					
					break;

					case "complete":
?>
						<i>Trade Complete</i><br />	
<?php
						if ($trade_details['buyer_status'] == "complete") {
							echo "You've marked this trade as completed.";							
						} else {
							echo "You've marked this trade as failed.";														
						}
					break;
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

function receiver_trade_html($item_details, $status, $offer_details) {

?>	
	<div class='container' style="min-height: 550px">
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-12 text-center">
<?php
			if ($status == "open") {
?>				
				<h2 style="color:black">Pending Offer</h2>
<?php				
			} else {
?>
				<h2 style="color:black">Rejected Offer</h2>
<?php				
			}				
?>				
				They offer <h3 style="color:black"><? echo $offer_details['name'] ?></h2>
				&nbsp; <br />
				for <br />
				&nbsp; <br />				
				<h3 style="color:black"><? echo $item_details['name'] ?></h2>
				
				&nbsp; <br />
<?php
				switch($status) {
					case "open":
?>					
						<a href='#' class='accept_trade'>Accept Trade</a><br />
						<a href='#' class='reject_trade'>Reject Trade</a><br />						
<?php					
					break;
					
					case "accepted":
						if ($trade_details['status'] == 'accepted') {
?>
							<b>Trade Accepted</b>
							<a href='message.php?tradeID=<? echo $trade_details['tradeID'] ?>' >Messages</a><br />
							&nbsp; <br />
							<a href='#' class='complete_trade' id='<? echo $trade_details['tradeID'] ?>' >We've completed this trade</a><br />
							<a href='#' class='failed_trade' id='<? echo $trade_details['tradeID'] ?>' >This trade never happened</a>

							<div class='row' id='complete_trade_form' style="display:none">			
								<div class='col-md-12 text-center'>
											<div class='error col-md-10 col-md-offset-2' id='empty_warning' style="color:red; margin-bottom:5px; display:none"><b>Fields cannot be empty.</b></div>
								
											<form class="form-horizontal">
												<div class="form-group">				
													<label for="rating" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Rating</label>
													<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
														<select class='rating form-control' data-trade='<? echo $trade_details['tradeID'] ?>'>
															<option value='3'>Positive</option>
															<option value='2'>Neutral</option>
															<option value='1'>Negative</option>
														</select>
													</div>
													<label for="review" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Review</label>
													<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
														<input type='text' class='review form-control' id="review" data-trade='<? echo $trade_details['tradeID'] ?>' placeholder='Review'><br />
													</div>
													
											</form>
											
<?php
											if ($_SESSION['userID'] == $trade_details['ownerID'])	{
												$userID = $trade_details['ownerID'];
											} else {
												$userID = $trade_details['buyerID'];
											}
?>							

											<input type='hidden' class='userID'  data-trade='<? echo $trade_details['tradeID'] ?>' value="<? echo $userID ?>">
																						
											<div class="row" style="margin-bottom:25px">
												<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
													<button type="button" class="btn btn-success save_review" data-trade='<? echo $trade_details['tradeID'] ?>'>
														<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save Review
													</button>
													<button type="button" class="btn btn-link cancel_review" data-trade='<? echo $trade_details['tradeID'] ?>' style="color:#8e080b;">
														Cancel
													</button>
												</div>
											</div>							
										</div>
										
									</div>
							</div>
<?php	
						}				
					break;
					
					case "rejected":
?>					
						<i>Offer Rejected</i><br />
						You rejected this offer.
<?php					
					break;

					case "complete":
?>
						<i>Trade Complete</i><br />	
<?php
						if ($trade_details['owner_status'] == "complete") {
							echo "You've marked this trade as completed.";							
						} else {
							echo "You've marked this trade as failed.";														
						}
					break;
				}
?>

			</div>	
		</div>
		
</div>
<?php
}


