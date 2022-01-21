<?php	

function loader_box() {
?>
		<div id="loader_box" title="Loading" style="display:none; text-align:center">
			&nbsp; <br />
			Loading......<br />
		</div>																											
<?php	
}

function delete_job_warning() {
?>
		<div id="remove_job_form" title="Delete Job Post" style="display:none; text-align:center">
			&nbsp; <br />
			Do you want to fully delete this job post and all information associated with it?
		</div>																											
<?php	
}

function job_filled_warning() {
?>
		<div id="close_job_form" title="Close Job Posting?" style="display:none">
			This will mark the position as "Filled" and candidates will no longer be able to respond to the job.</br>
			&nbsp; <br />
			You will also NOT be able to view any more resumes associated with this posting.</br>
		</div>	
		
		<div id="unfill_form" title="Change Status to Open?" style="display:none">
			This will change the status of the position to "Open".  The listing will still expire on the original expiration date.</br>
			&nbsp; <br />
		</div>													
<?php	
}


function job_match_warning() {
?>
		<div id="match_form" title="Send Match Notices" style="display:none;">
			&nbsp; <br />
			Clicking match will send out notifications to all qualified candidates.  You will be notified as soon as any candidate is interested.<br />
			&nbsp; <br />
			NOTE:  You will only be able to edit the job 'Responsibilities' and 'Specific Requirements' once the job is submitted.<br />
		</div>																											
<?php	
}
	
function dialogue_job_responses() {
?>
				
		<div id="incomplete_form" title="Job Profile Incomplete" style="display:none">
			You must complete your profile to find potential candidates.  Please fill in all areas marked "required".
		</div>		
		
		<div id="remove_job_form" title="Delete Job Completely?" style="display:none">
			Fully delete this job and all of its details?</br>
		</div>		
		
	
		<div id="decline_form" title="Decline Candidate?" style="display:none">
			Decline candidate?  The candidate will receive a message that you are not interested and he or she will be removed from this list.
		</div>
		
		<div id="reach_info_box" title="What is Reach?" style="display:none">
			The number on the right is the total number of employees in your region.  The number on the left is the number that have matched at least one criteria. <br />
			&nbsp; <br />
			Reach can increase on any given day as new people sign up for ServeBartendCook.com.
		</div>												
		
		<div id="loader_box" title="Updating" style="display:none; text-align:center">
			&nbsp; <br />
			Updating......<br />
		</div>																											
									
<?php		
}

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