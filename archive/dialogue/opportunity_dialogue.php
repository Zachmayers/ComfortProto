<?php
function dialogue_job_response() {
?>
		
		<div id="not_interested_form" title="No Interest?" style="display:none">
			Click below if you are NOT interested in this position.</br>
			This position will be removed from your list.  The store owner will not see your resume or contact information.</br>
		</div>
		
		<div id="inappropriate_form" title="Report Content to Admin" style="display:none">
			Is this content inappropriate?</br>
			&nbsp; <br />
			Clicking "Report" will send a message to an admin to review this content for possible removal.
		</div>				
<?php
}

function loader_box() {
?>
		<div id="loader_box" title="Loading" style="display:none; text-align:center">
			&nbsp; <br />
			Loading......<br />
		</div>																											
<?php	
}

function refresh_warning() {
?>
		<div id="refresh_warning" style="display:none; float:left; width:100%; text-align:center;">
			&nbsp; <br />
			<h4>Please Refresh Page to Re-Load Your Information</h4><br />
		</div>																											
<?php	
}
