<?php
//Page Description
//This is the page that displays a store and it's details, it is either editable, or just viewable
	
//Required Class files
	require_once('classes/utilities.class.php');
	require_once('classes/store.class.php');
	require_once('classes/job.class.php');

//Required HTML files
	require_once('html/store_html.php');
	require_once('html/general_content_html.php');
	require_once('mobile/store_html_mobile.php');	
	
//Required Dialogue files
	require_once('dialogue/store_dialogue_class.php');
	require_once('dialogue/mobile_dialogue.php');	
		
//start session
	session_start();
//Forces page to refresh, this is needed, or else people adding new info to profile and clicking "back" will see old info
header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
header('Pragma: no-cache'); // HTTP 1.0.
header('Expires: 0'); // Proxies. 

	$utilities = new Utilities;
	$version = $utilities->version;	
		
//name of javascript file
	$js_file = "<script type='text/javascript' src='js/store.js?v=".$version."'></script> ";
	
//GET variable
	$storeID = $_GET['ID'];
		
//define objects
	$general_content = new General_Content;
	
// display header, with name, type, and required javascript file
	//if user is logged in display, if not, display warning page
	if (isset($_SESSION['userID'])) {
	
		$general_content->html_top('store', $js_file);
			
		$store = new Store($storeID);
		$store_data = $store->get_store_data();
		
		//viewer is not owner, don't show edit buttons		
		if ($store_data['general']['userID'] == $_SESSION['userID']) {
			$display = "owner";
		} else {
			$display = "illegal_view";
		}			
		
			switch($display){	
				case "owner":
					if ($_SESSION['device'] == "full") {							
						store_html($store_data, $utilities->store_types);
						loader_box();															
?>
<script>
						$(document).ready(function() {
							var storeID = <? echo $storeID ?>;
							store(storeID);	
						})
</script>
<?php		
					} else {
						store_owner_html_mobile($store_data, $utilities->store_types);						
						mobile_loader_box();															
?>
<script>
						$(document).ready(function() {
							var storeID = "<? echo $storeID ?>";
							store_mobile(storeID);	
						})
</script>
<?php
					}		
				break;

				case "illegal_view":
						$general_content->illegal_view();									
				break;					
			}

	} else {
		login_warning_html();		
	}	
	//display footer
	
	$general_content->html_footer();	
?>