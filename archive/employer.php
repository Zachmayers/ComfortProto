<?php	
//======================
//
//   Employer Page - An employer viewing their own profile
//
//======================

//Required Class files
	require_once('classes/employer.class.php');	
	require_once('classes/member.class.php');	
	require_once('classes/utilities.class.php');	

//Required HTML files
	require_once('html/employer_html.php');	
	require_once('html/general_content_html.php');

	
//start session
session_start();
//Forces page to refresh, this is needed, or else people adding new info to profile and clicking "back" will see old info
header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
header('Pragma: no-cache'); // HTTP 1.0.
header('Expires: 0'); // Proxies. 

	$utilities = new Utilities;
	$version = $utilities->version;	

		
//name of javascript file
	$js_file = "<script type='text/javascript' src='js/employer.js?v=".$version."'></script>";
//	$js_file .= "<script src='https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places'></script>";
//    $js_file .= "<script>google.maps.event.addDomListener(window, 'load', initialize);</script>";
	
	$general_content = new General_Content;
	
// display header, with name, type, and required javascript file
	//if user is logged in display, if not, display warning page
	if (isset($_SESSION['userID'])) {		
		$general_content->html_top("profile_employer", $js_file);
		
	
		if ($_SESSION['type'] == "employer") {	
			$page = $_GET['page'];
					
			$employer = new Employer($_SESSION['userID']);
			$member = new Member($_SESSION['userID']);
				
			$employer_data = $employer->get_employer_data();
			$member_data = $member->get_member_data();
				
			if (count($employer_data['stores_jobs']['stores']) == 0) {
				$new_user = 'Y';
			} else {
				$new_user = 'N';
			}

				switch($page) {
					default:
						$store_type_array = $utilities->store_types;
						$open_job_count = 0;
						$open_jobs = $employer_data['stores_jobs']['open_jobs'];

						if (count($open_jobs) > 0) {
							foreach ($open_jobs as $row) {
								$open_job_count = $open_job_count + $row;
							}
						}
						
						$site_type = $utilities->site_type;
						
						if ($site_type == "live") {
							$upload_url = "//servebartendcook.com/upload_pic";
						} elseif ($site_type == "prototype") {
							//$upload_url = "//threewhitebirds.com/SBC/upload_pic";	
							$upload_url = "//threewhitebirds.com/CLEAN/upload_pic";	
						}
						
						profile_html_employer($member_data, $employer_data, $open_job_count, $store_type_array, $upload_url);
						employer_html_loader();		
?>
<script>
						$(document).ready(function() {
							profile_employer(<? echo json_encode($employer_data['stores_jobs']['stores']) ?>);
							store_photo();
							employer_account_switch();
						})
</script>
<?php	
					break;
										
					case "switch_account":
						profile_html_type_switch();
?>
<script>
						$(document).ready(function() {
							employer_account_switch();
						})
</script>
<?php								 
					break;
				}										
			
		} else {
			$general_content->illegal_view();					
		}		
		
	} else {
		$general_content->login_warning_page();	
	}	
	
$general_content->html_footer();
?>