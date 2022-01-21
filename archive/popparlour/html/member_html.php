<?php

function member_owner_html($view, $member_data, $open_items, $traded_items, $offer_counts, $feedback_received, $review_counts, $token_count) {

?>	
	<div class='container' style="min-height: 550px">
		<div class='row profile' style="margin-bottom:12px">
			<div class="col-md-12 text-center">
<?php
				if ($view == "owner") {
?>
					<b><? echo $member_data['nickname'] ?></b> <a href='#' id='edit_nickname'>Edit Nickname</a><br />
					<b><? echo $member_data['firstname'] ?> <? echo $member_data['lastname'] ?> <i>Private</i></b> <a href='#' id='edit_name'>Edit Name</a><br />
					<b>Email: <? echo $member_data['email'] ?></b> <i>Private</i><br />
					<b>Facebook Account: HOLDER</b><br />
					<b>Available Tokens: <? echo($token_count) ?></b> <a href='#' class='add_tokens'>Add Tokens</a><br />
<?php					
				} else {
?>
					<h3><? echo $member_data['nickname'] ?></h3>
<?php					
				}	
?>
			</div>	
		</div>
				
		<div class='row profile' style="margin-bottom:12px">
			<div class="col-md-12 text-center">
				<h3>Trade Stats</h3>
				<b>Completed Trades: <? echo $offer_counts['complete'] ?><br />
				<b>Open Trades: <? echo $offer_counts['open'] ?></b><br />
				<b>Current Offers: <? echo $offer_counts['offers'] ?></b><br />
				<b>Failed Trades: <? echo $offer_counts['failed'] ?></b><br />
				<b>Disputed Trades: <? echo $offer_counts['disputed'] ?></b><br />
			</div>
		</div>
		
		<div class='row profile' style="margin-bottom:12px">
			<div class="col-md-12 text-center">
				<h3>Rating</h3>
				<b>Positive: <? echo $review_counts['positive'] ?><br />
				<b>Neutral: <? echo $review_counts['neutral']  ?></b><br />
				<b>Negative: <? echo $review_counts['negative']  ?></b><br />
			</div>
		</div>

		<div class='row profile' style="margin-bottom:12px">
			<div class="col-md-12 text-center">
				<h3>Reviews</h3>
<?php
				if (count($feedback_received) > 0) {
					foreach($feedback_received as $row) {
						$rating_text = "Neutral";
						switch($row['rating']) {
							case 0:
								$rating_text = "Negative";
							break;
							case 1:
								$rating_text = "Neutral";
							break;
							case 2:
								$rating_text = "Positive";
							break;
						}
?>
						<div class='row' style="margin-bottom:12px">
							<div class="col-md-12">
								<a href="member.php?ID=<? echo $row['userID'] ?>"><? echo $row['nickname'] ?></a> traded with <? echo $member_data['nickname'] ?> on <? echo $row['date'] ?>.<br />
								<b>Rating: <? echo $rating_text ?><br />
								<i><? echo $row['review'] ?></i>
							</b>
						</div>
<?php						
					}
				}
?>				
			</div>
		</div>
		

		<div class='row edit_name_form' style="display:none">			
				<div class='col-md-12 text-center'>
					Enter Name<br />

						<div class='error col-md-10 col-md-offset-2' id='empty_warning' style="color:red; margin-bottom:5px; display:none"><b>Fields cannot be empty.</b></div>
			
						<form class="form-horizontal">
							<div class="form-group" id="first_name_form" style="margin-bottom: 3px">
						   		<label for="first_name" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">First Name</label>
						   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
									<input type='text' class="first_name form-control" id="first_name" value='<? echo  $member_data['first_name'] ?>' placeholder='First Name'><br />
								</div>
							</div>
							<div class="form-group" id="last_name_form" style="margin-bottom: 3px">
						   		<label for="last_name" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Last Name</label>
						   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
									<input type='text' class="last_name form-control" id="last_name" value='<? echo  $member_data['first_name'] ?>' placeholder='Last Name'><br />
								</div>
							</div>
						</form>
						
						<div class="row" style="margin-bottom:25px">
							<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
								<button type="button" class="btn btn-success" id='save_name_edit'>
									<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save Changes
								</button>
			
								<button type="button" class="btn btn-link" id="cancel_name_edit" style="color:#8e080b;">
									Cancel
								</button>
							</div>
						</div>							
					</div>

					
				</div>
		</div>


		<div class='row edit_nickname_form' style="display:none">			
				<div class='col-md-12 text-center'>
					Enter Nickname<br />

						<div class='error col-md-10 col-md-offset-2' id='empty_warning' style="color:red; margin-bottom:5px; display:none"><b>Fields cannot be empty.</b></div>
			
						<form class="form-horizontal">
							<div class="form-group" id="nickname_form" style="margin-bottom: 3px">
						   		<label for="nickname" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">First Name</label>
						   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
									<input type='text' class="nickname form-control" id="nickname" value='<? echo  $member_data['nickname'] ?>' placeholder='Display Name'><br />
								</div>
							</div>
						</form>
						
						<div class="row" style="margin-bottom:25px">
							<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
								<button type="button" class="btn btn-success" id='save_nickname_edit'>
									<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Save Changes
								</button>
			
								<button type="button" class="btn btn-link" id="cancel_nickname_edit" style="color:#8e080b;">
									Cancel
								</button>
							</div>
						</div>							
					</div>

					
				</div>
		</div>


		<div class='row' style="margin-bottom:12px">
			<div class="col-md-12">
				<a href='#'>View Open Items</a><br />
				<a href='#'>View Completed Trades</a><br />
			</div>
		</div>
	</div>
<?php
}	

function member_visitor_html($member_data) {
?>	
	<div class='container' style="min-height: 550px">
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-12 text-center">
				<h2 style="color:black">BADGE HOLDER<? echo $member_data['username'] ?></h2>
				<b>FB Friends in Common: HOLDER</b><br />
			</div>	
		</div>
				
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-12 text-center">
				<h3>Trade Stats</h3>
				<b>Completed Trades: HOLDER<br />
				<b>Pending Trades: HOLDER</b><br />
				<b>Failed Trades: HOLDER</b><br />				
			</div>
		</div>

		<div class='row' style="margin-bottom:12px">
				<h3>Public Collections</h3>		
		</div>
	</div>
<?php
}
