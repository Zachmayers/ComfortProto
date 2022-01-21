<?php
function store_list_dialogue_delete_store() {
// dialog box deleting a store
?>
		<div id="delete_store_form" title="Delete Store" style="display:none">
			</br>
				Deleting this store will remove it from your profile and remove ALL jobs associated with this store	</br>
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


	function profile_dialogue_video() {
// dialog box deleting a store
?>
		<div id="video_box" title="Video Resume" style="display:none; text-align:center">
			<div id='video-loader' style='width:500px; min-height:300px; padding-top:100px;'>
				Loading....
			</div>
						
			<div id='video-holder'>
				<div class='video-header'>
					<h4></h4>
				</div>
				
				<div class='video-body'>
				
				</div>
			</div>
					
		</div>																																		
<?php
}

function inappropriate_warning() {
?>
		<div id="inappropriate_form" title="Report Inappropriate Content" style="display:none;">
			&nbsp; <br />
			Click "REPORT" below if the content of this profile contains offensive or inappropriate content.<br />
			&nbsp; <br />
			An admin will be notified immediately and we will look into the issue.<br />
		</div>																											
<?php	
}


?>