<?php
//======================
//
//   Main Page - Displays main page after login
//
//======================

//Required Class files
	require_once('classes/utilities.class.php');	
	require_once('classes/wine.class.php');
	
//Required HTML files
	require_once('html/wine_html.php');	
	require_once('html/general_content_html.php');
	
	
//start session
	session_start();
//Forces page to refresh, this is needed, or else people adding new info to profile and clicking "back" will see old info
header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
header('Pragma: no-cache'); // HTTP 1.0.
header('Expires: 0'); // Proxies. 

	$utilities = new Utilities;
	$general_content = new General_Content;
	$wine = new Wine();

	$version = $utilities->version;	
	
//name of javascript file
	$js_file = "<script type='text/javascript' src='js/wine.js?v=".$version."'></script>";


//Determine whether user is logged in
	if (isset($_SESSION['userID'])) {
		//user is logged in
					
		//***** Header ********//
			$general_content->html_top('wine', $js_file);
		
		
	if (isset($_GET['page'])) {
		$view = $_GET['page'];
	} else {
		$view = "main_menu";		
	}
	
			switch($view) {
					
/*
				case "main_menu":
					main_menu_html();		
?>
<script>
					$(document).ready(function() {
						main_functions();							
					})
</script>
<?php	
				break;
*/
				
				case "new":
					if ($_SESSION['admin'] == "Y") {
						add_wine_html();
?>
<script>	
						$(document).ready(function() {
							add_wine();
						})
</script>
<?php
						
					} else {
						//error page
					}

				break;
				
				case "varietal_list":
					if ($_SESSION['admin'] == "Y") {
						$varietals = $wine->get_varietals();
						varietal_list_html($varietals);						
					} else {
						//error page
					}
				break;				
				
				case "edit_varietal":
					if ($_SESSION['admin'] == "Y") {
						$varietal_array = $wine->get_varietal_details($_GET['ID']);
						$varietal_details = $varietal_array['details'];
						$taste_array = $varietal_array['taste_array'];
						
						$taste_options = $wine->get_taste_options();
						
						varietal_details_html($varietal_details, $taste_array, $taste_options);		
?>
<script>
						$(document).ready(function() {
							var varietalID = "<? echo $_GET['ID'] ?>";
							alert(varietalID);
							varietal(varietalID);
						})
</script>
<?php				
					} else {
						//error page
					}				
				break;
				
															
				case "admin":	
				//create				
					admin_menu_html();
				break;
				
				case "modify":
					switch($_GET['action']) {
						default:
							throttle_menu_html();
						break;
						
						case "setup":
							//check for current data
							//check type
							$batch_details = $data_view->get_batch_details($_GET['ID']);
							//display different page based on type

							switch($batch_details[0]['type']) {
								case "CSV":
									upload_menu_html($_GET['batchID'], $batch_details['clean'], $batch_details['ping'], $batch_details['destination']);
								break;
								
								case "post":
									batch_setup_html($_GET['batchID'], $batch_details['clean'], $batch_details['ping'], $batch_details['destination']);					
								break;
								
							}
							
						break;
					}
				break;				

				case "even":
					//check for current data
					$data_view = new Data_View();
					$data_list = $data_view->get_batch_info();
					
					throttle_even_html($data_list);
?>
<script>
					even_throttle();
</script>
<?php
				break;				

				case "hours":
					//check for current data
					$data_view = new Data_View();
					$data_list = $data_view->get_batch_info();
					
					throttle_hours_html($data_list);
?>
<script>
					hourly_throttle();
</script>
<?php
					
				break;				
			}			
		
	} else {
		$general_content->login_warning_page();		
	}
		
$general_content->html_footer();
?>