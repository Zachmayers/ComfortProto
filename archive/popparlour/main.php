<?php
//======================
//
//   Main Page - Displays main page after login
//
//======================

//Required Class files
	require_once('classes/utilities.class.php');	
	require_once('classes/pop.class.php');
	
//Required HTML files
	require_once('html/main_html.php');	
	require_once('html/admin_menu_html.php');	
	
	require_once('html/general_content_html.php');
	
	
//start session
	session_start();
//Forces page to refresh, this is needed, or else people adding new info to profile and clicking "back" will see old info
header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
header('Pragma: no-cache'); // HTTP 1.0.
header('Expires: 0'); // Proxies. 

	$utilities = new Utilities;
	$general_content = new General_Content;

	$version = $utilities->version;	
	
//name of javascript file
	$js_file = "<script type='text/javascript' src='js/main.js?v=".$version."'></script>";


//Determine whether user is logged in
// 	if (isset($_SESSION['userID'])) {
		//user is logged in
					
		//***** Header ********//
			$general_content->html_top('main', $js_file);
		
		
	if (isset($_GET['page'])) {
		$view = $_GET['page'];
	} elseif  ($_SESSION['admin'] == "Y") {
		$view = "admin";
	} else {
		$view = "main_menu";
	}
			
		//Determine whether email address has been verified LATER FIX THIS
												
			switch($view) {
					
				case "main_menu":
					$pop = new Pop;
					$menu_items = $pop->get_menu_items();
					main_menu_html($menu_items);		
?>
<script>
					$(document).ready(function() {
						size_change();	
						temp_change();	
						milk_change();		
						save_order();				
						empty_cart();	
						buttons();																																																
						$('#cart').simpleCart();
					})
</script>
<?php	
				break;
								
				case "checkout":
					$pop = new Pop;
					$valid = $pop->check_orderID($_GET['orderID']);
					
					if ($valid == "Y") {
						$item_array = $pop->get_cart($_GET['orderID']);
						$checkout_amount = $pop->get_checkout_amount($_GET['orderID']);
						checkout_html($item_array);		
					} else {
						error_html();
					}
?>
<script>
					$(document).ready(function() {
						var orderID = "<? echo $_GET['orderID'] ?>";
						var checkout_amount = '<? echo $checkout_amount ?>'* 100 +100;
						enter_address(orderID);	
						new_checkout(checkout_amount, orderID);											
					});
</script>
<?php	
				break;

				case "thank_you":
					thank_you_html();		
				break;
															
				case "admin":	
				
				//echo "ADMIN".$_SESSION['admin'];
					if ($_SESSION['admin'] == "Y") {
						$pop = new Pop;
						$open_orders = $pop->get_open_orders();
						admin_html($open_orders);					
					} else {
						admin_login_html();											
					}
?>
<script>
					$(document).ready(function() {
						delivered();
						login();
						logout();						
					});
</script>
<?php	
					
				break;
				
				case "error":
					error_html();			
				break;
				
			}			
		
/*
	} else {
		$general_content->login_warning_page();		
	}
*/
		
$general_content->html_footer();
?>