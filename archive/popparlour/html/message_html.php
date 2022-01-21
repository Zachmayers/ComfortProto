<?php
 	function message_list_html($status, $wanted_item_details, $offered_item_details, $message_array) {
?>		
<div id='holder'>

		<div class='container'>
			<h2 class='block-title'><strong>Arrange Trade
			</strong> <? echo $wanted_item_details['name'] ?> for <? echo $offered_item_details['name'] ?></h2>
			
<?php
			if (count($message_array) > 0) {
				foreach($message_array as $row) {
					if ($row['senderID'] == $_SESSION['userID']) {
						$person = "<b>You:</b>  ";
					} else {
						$person = "<b>Them:</b>  ";
					}
?>
					<div class='row'>
						<div class='col-md-12'>
							<? echo $person." ".$row['message'] ?>
						</div>
					</div>
<?php					
				}
			}
?>			
			<form class="form-horizontal" style="margin-top: 25px;">
				<div class="form-group">				
					<label for="new_message" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Send Message</label>
					<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
						<input type='text' class='new_message form-control' id="new_message" placeholder='Message'><br />
					</div>
				</div>	
			</form>
						
			<div class="row" style="margin-bottom:25px">
				<div class="col-md-10 col-xs-10 col-md-offset-2 col-xs-offset-1">
					<button type="button" class="btn btn-success add_message" id='add_message'>
						<i class="fa fa-check-square-o" aria-hidden="true" style="background-color: transparent"></i> Send Message
					</button>
				</div>
			</div>							
	</div><br />
<?php	
}	
?>