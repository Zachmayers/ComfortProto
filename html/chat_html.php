<?php
		

function chat_html($messages) {

?>		
	<div class='container' style="margin-top:75px;">
		
		

	<div class="row" id='job_summary_holder' style="margin-top: 15px;">
		<div class="col-md-12 col-xs-12 text-center">
			<h2>Messages</h2>
		</div>

		<div class="col-md-12 col-xs-12" >
<?php
		if (count($messages) > 0) {
			foreach($messages as $row) {
?>
                <div class="row " style="padding-bottom: 20px;">
						<div class="col-12 text-center ">
							<? echo $row['message'] ?>
						</div>							
				</div>
<?php
			}				
		} else {
			echo "None";
		}
?>
							<div class="form-horizontal">
								<div class="form-group" id="edit_description" style="margin-bottom:3px">
							   		<div class="col-md-9 col-md-offset-0 col-xs-10 col-xs-offset-1 col-sm-9  col-sm-offset-0">
									   	<div class="col-md-12" id='charNum_description' style="color:red; margin-bottom:2px;"></div> <!-- //Holder for character counter -->
										<textarea class="form-control" id="message"  placeholder="Message" maxlength='750'></textarea><br />
									</div>
										<a href='#' class='send_message'>
											<button type='button' class='button' >Send Message</button>
										</a>
								</div>
							</div>

			</div>
		</div>
		

		</div>
		
		

	</div>
	
	 &nbsp; <br />

	
	<div class="row">
		<div class="col-md-12 no-line text-center">			
		</div>
	</div> &nbsp; <br />
	
<?php
}		
				
?>