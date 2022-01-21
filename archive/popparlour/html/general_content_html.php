<?php
require_once('classes/member.class.php');

class General_Content {
//This class contains the HTML for General Content user on each page: the Header/Top of Page, Footer, Button Barsand error/warning pages

	function html_top($page, $js_file_name) {
//Forces page to refresh, this is needed, or else people adding new info to profile and clicking "back" will see old info

/*
header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
header('Pragma: no-cache'); // HTTP 1.0.
header('Expires: 0'); // Proxies. 
*/
	
	$utilities = new Utilities;
	$site_type = $utilities->site_type;
	
	$robot_test = $utilities->robot_test($page);

?>

<!DOCTYPE html>
<html lang="en" class="homehead">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="og:title" content="Pop Parlour Delivery Menu" />
	<meta property="og:description" content="Pop Parlour now delivers coffee, tea, pops, and beer locally in Orlando" />
	<meta property="og:image" content="images/Pop_Parlour_Black_Penguin_On_Transparent.png'" />


	<title>Pop Parlour Delivery Ordering</title>
	
	<meta name='robots' content='noindex'>
    <link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Comfortaa:300,400,700" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/theme.css?v=1" rel="stylesheet">
  <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>  
		<script src="js/jQuery.SimpleCart.js?v=2r" ></script>
		<link href="css/simple_Cart.css?v=2a" rel="stylesheet">
    <!-- Bootstrap CSS File -->
  
    
    
      <!-- END MITCH CSS -->


	<script type="text/javascript" src="js/ajax.js?v=6"></script>	
    <!-- Required JavaScript Libraries -->
<!--     <script src="js/jquery.min.js"></script> -->
    <script src="js/bootstrap.min.js"></script>
    
    <!-- Custom Javascript File -->
    <script src="js/custom.js"></script>

	<script type="text/javascript" src="js/general.js?v=5"></script>	
<!-- 	<script type='text/javascript' src="js/dist/clipboard.min.js"></script> -->
	
	<? echo $js_file_name ?>
	
	<!-- Favicons -->
	<link rel="shortcut icon" href="images/favicon.png" />
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
<!--	
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
-->
	
<!-- <link type="text/css" href="css/custom-theme/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" /> -->
<script type="text/javascript" src="js/jquery-ui-1.8.23.custom.min.js"></script> 

 <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script> 
<!--  <script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>  -->

 <script type="text/javascript" src="js/jquery_form.js"></script>
<script src='https://checkout.stripe.com/checkout.js'></script>
	
	<script>
		//Required for Safari iOS to reload the page when a user pressed back, if we don't do this, an old verion of a profile may appear
		$(window).bind("pageshow", function(event) {
				if (event.originalEvent.persisted) {
				window.location.reload() 
			}
		});
	</script>
	
	
</head>

 <body >

    <nav class="navbar navbar navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle "  id="cart_scroll" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
<!--             <span class="sr-only">Toggle navigation</span> -->
                                <a href="#"><i class="fa fa-shopping-cart" style='color:black; font-size:1.5em; margin-top:15px;'></i></a>

          </button>

          <a class="navbar-brand" href="#"><img src='images/Pop_Parlour_Black_Penguin_On_Transparent.png' height="70px"> </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav pull-right-nav">
                            <li class="icon-link">
                                <a href="#" id="cart_scroll"><i class="fa fa-shopping-cart" style='color:black; font-size:1.5em; margin-top:15px;'></i></a>
                            </li>
<!--
                            <li>
                            	<a href="#" id="logout">Logout</a>
                            </li>
-->
                        </ul>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    </div>
    
        <div class="jumbotron">

<?php	
		
}


 // end of function
	
	function html_footer() {

	$utilities = new Utilities; 
	$site_type = $utilities->site_type;		
?>

    </div>
    <!-- /content -->
    <!-- Call out block -->
<!--     <div class="block block-pd-sm block-bg-primary"> -->
	<div class="block block-pd-sm block-bg-primary">
        <div class="container">
            <div class="row">
<!--
	            <div class="col-xs-4 text-right">
	                <h5>Navigation</h5>
	                <a href="main.php">Home</a><br/>
		                <a href="#">Search</a><br />
						<a href="#">Settings</a><br />		                
	            </div>
	            <div class="col-xs-4 text-center">
                   <h5>Information</h5>
                  <a href="#">Contact</a><br />
                  <a href="#">Privacy</a><br />
                   <a href="#">TOS</a><br />
                </div>
	            <div class="col-xs-4">
                   <h5>Follow Us</h5>
                   <a href="https://facebook.com/">Facebook</a><br />
                   <a href="https://instagram.com/">Instagram</a><br />
                   <a href="https://twitter.com/">Twitter</a><br />
                </div>
-->

            </div>
        </div>
    </div>

    <!-- ======== @Region: #footer ======== -->
<!--
    <footer id="footer" class="block block-bg-grey-dark">
        <div class="container">
            <div class="row subfooter">
                <div class="col-md-12 text-center">
                    <p>Copyright 2019 © XXXXXXXX</p>
                </div>
            </div>

            <a href="#top" class="scrolltop">Top</a>

        </div>
    </footer>
-->

	
	</div>

	<!-- End Wrapper -->
	

<script>
// 		general_buttons();
	
	
/*
	$("#logout").click(function() {
		$.ajax({
			type: "POST",
			url: "lgout.php",
			success: function(data) {
				//alert("logout");
				//window.location = "http://servebartendcook.com";
			}
		});	
		return false;
	});	
*/

</script>

<?php	
//		$utilities->twitter_RM();
/*
	if ($site_type == "live") {
		$utilities->google_adwords_RM();
	}		
*/
?>	
<!--  INITIALIZE AT TOP FOR NOW
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    <script src="js/custom.js"></script>
-->

</body>
</html>
<?php
}	
	
//end function

	
	function illegal_view() {
		echo "<h1>You do not have permission to view this page.</h1>";		
	}
	
	function no_exist() {
		echo "<div class='container' style='min-height:70%'>";
			echo "<h2 style='text-align:center'>Oops, this page no longer exists.</h2>";
			echo "<h3 style='text-align:center'><a href='main.php'>Home</h3>";	
		echo"</div>";	
	}
	
				
}
?>