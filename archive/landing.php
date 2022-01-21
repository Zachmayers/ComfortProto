<?php
	require_once('classes/utilities.class.php');
	require_once('html/landing_html.php');

error_reporting(0);

	
// 	if (isset($_GET['page'])) {
		landing_header_html($_GET['page'], $google_analytics, $fb_remarket);
		landing_body_html($_GET['page'], $brands);	
		landing_footer_html($_GET['page']);	
	
?>
		<script>
			$(document).ready(function() {
				index_full("NA", "NA", "NA", "NA", "NA", "NA", "NA", "NA", "NA");
			});
		</script>
<?php			
/*
	} else {																							
		public_page_warning($valid_page, $device, $site_type);
	}
*/
?>