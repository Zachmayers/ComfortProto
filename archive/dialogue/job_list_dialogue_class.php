<?php
	function dialogue_remove_job() {
?>
		<div id="remove_job_form" title="Remove Position?" style="display:none">
			Are you sure you would like to completely delete this position?</div>
		</div>		
<?php
}

	function dialogue_job_response() {
?>
		<div id="not_interested_form" title="No Interest?" style="display:none">
			Click below if you are NOT interested in this position.</br>
			This position will be removed from your list.  The store owner will NOT see your resume or contact information.</br>
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
?>