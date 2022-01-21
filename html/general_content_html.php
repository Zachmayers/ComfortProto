<?php

require_once('classes/member.class.php');


class General_Content {
//This class contains the HTML for General Content user on each page: the Header/Top of Page, Footer, Button Barsand error/warning pages

	function html_top_new($page, $js_file_name) {
	$utilities = new Utilities;
	$site_type = $utilities->site_type;
	
	$robot_test = $utilities->robot_test($page);

?>

<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
		<title>Comfort &#8211; When you need someone there</title>
<meta name='robots' content='max-image-preview:large' />
<link rel='dns-prefetch' href='//maps.google.com' />
<link rel='dns-prefetch' href='//www.google.com' />
<link rel='dns-prefetch' href='//fonts.googleapis.com' />
<link rel='dns-prefetch' href='//s.w.org' />
<link href='https://fonts.gstatic.com' crossorigin rel='preconnect' />
<link rel="alternate" type="application/rss+xml" title="Comfort &raquo; Feed" href="https://www.getcomfort.app/feed/" />
<link rel="alternate" type="application/rss+xml" title="Comfort &raquo; Comments Feed" href="https://www.getcomfort.app/comments/feed/" />
		<script type="text/javascript">
			window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/13.1.0\/72x72\/","ext":".png","svgUrl":"https:\/\/s.w.org\/images\/core\/emoji\/13.1.0\/svg\/","svgExt":".svg","source":{"concatemoji":"https:\/\/www.getcomfort.app\/wp-includes\/js\/wp-emoji-release.min.js?ver=5.8.2"}};
			!function(e,a,t){var n,r,o,i=a.createElement("canvas"),p=i.getContext&&i.getContext("2d");function s(e,t){var a=String.fromCharCode;p.clearRect(0,0,i.width,i.height),p.fillText(a.apply(this,e),0,0);e=i.toDataURL();return p.clearRect(0,0,i.width,i.height),p.fillText(a.apply(this,t),0,0),e===i.toDataURL()}function c(e){var t=a.createElement("script");t.src=e,t.defer=t.type="text/javascript",a.getElementsByTagName("head")[0].appendChild(t)}for(o=Array("flag","emoji"),t.supports={everything:!0,everythingExceptFlag:!0},r=0;r<o.length;r++)t.supports[o[r]]=function(e){if(!p||!p.fillText)return!1;switch(p.textBaseline="top",p.font="600 32px Arial",e){case"flag":return s([127987,65039,8205,9895,65039],[127987,65039,8203,9895,65039])?!1:!s([55356,56826,55356,56819],[55356,56826,8203,55356,56819])&&!s([55356,57332,56128,56423,56128,56418,56128,56421,56128,56430,56128,56423,56128,56447],[55356,57332,8203,56128,56423,8203,56128,56418,8203,56128,56421,8203,56128,56430,8203,56128,56423,8203,56128,56447]);case"emoji":return!s([10084,65039,8205,55357,56613],[10084,65039,8203,55357,56613])}return!1}(o[r]),t.supports.everything=t.supports.everything&&t.supports[o[r]],"flag"!==o[r]&&(t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&t.supports[o[r]]);t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&!t.supports.flag,t.DOMReady=!1,t.readyCallback=function(){t.DOMReady=!0},t.supports.everything||(n=function(){t.readyCallback()},a.addEventListener?(a.addEventListener("DOMContentLoaded",n,!1),e.addEventListener("load",n,!1)):(e.attachEvent("onload",n),a.attachEvent("onreadystatechange",function(){"complete"===a.readyState&&t.readyCallback()})),(n=t.source||{}).concatemoji?c(n.concatemoji):n.wpemoji&&n.twemoji&&(c(n.twemoji),c(n.wpemoji)))}(window,document,window._wpemojiSettings);
		</script>
		<style type="text/css">
img.wp-smiley,
img.emoji {
	display: inline !important;
	border: none !important;
	box-shadow: none !important;
	height: 1em !important;
	width: 1em !important;
	margin: 0 .07em !important;
	vertical-align: -0.1em !important;
	background: none !important;
	padding: 0 !important;
}

a:link { text-decoration: none; }
a:visited { text-decoration: none; }
a:hover { text-decoration: none; }
a:active { text-decoration: none; }

      .button {
        align-items: center;
        background-clip: padding-box;
        background-color: #fa6400;
        border: 1px solid transparent;
        border-radius: 1rem;
        box-shadow: rgba(0, 0, 0, 0.02) 0 1px 3px 0;
        box-sizing: border-box;
        color: #fff;
        cursor: pointer;
        display: inline-flex;
        font-family: system-ui, -apple-system, system-ui, "Helvetica Neue",
          Helvetica, Arial, sans-serif;
        font-size: 16px;
        font-weight: 600;
        justify-content: center;
        line-height: 1.25;
        margin: 0;
        min-height: 3rem;
        padding: calc(0.875rem - 1px) calc(1.5rem - 1px);
        position: relative;
        text-decoration: none;
        transition: all 250ms;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
        vertical-align: baseline;
        width: auto;
      }

      .button:hover,
      .button:focus {
        background-color: #fb8332;
        box-shadow: rgba(0, 0, 0, 0.1) 0 4px 12px;
      }

      .button:hover {
        transform: translateY(-1px);
      }

      .button:active {
        background-color: #c85000;
        box-shadow: rgba(0, 0, 0, 0.06) 0 2px 4px;
        transform: translateY(0);
      }
      
      .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        transition: 0.3s;
        width: 10%;
        display: flex;
        padding-bottom: 3px;
        padding-left: 3px;
        padding-right: 3px;
        padding-top: 3px;

        justify-content: center;
      }

      .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
      }

      .container {
        padding: 2px;
      }
</style>

<?php
	if ($site_type == "prototype" || $robot_test == false) {
		echo "<meta name='robots' content='noindex'>";
	}
?>	
    <!-- Google Fonts -->
<link rel='stylesheet' id='google-fonts-raleway-css'  href='//fonts.googleapis.com/css?family=Raleway:300,400,500,600,700' type='text/css' media='all' />
<link rel='stylesheet' id='google-fonts-open-sans-css'  href='//fonts.googleapis.com/css?family=Open+Sans:500,600,700' type='text/css' media='all' />
<link rel='stylesheet' id='google-fonts-1-css'  href='https://fonts.googleapis.com/css?family=Roboto%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7CRoboto+Slab%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7CPT+Sans%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7COpen+Sans%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic&#038;display=auto&#038;ver=5.8.2' type='text/css' media='all' />
 <script type="text/javascript">
            window._nslDOMReady = function (callback) {
                if ( document.readyState === "complete" || document.readyState === "interactive" ) {
                    callback();
                } else {
                    document.addEventListener( "DOMContentLoaded", callback );
                }
            };
</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<script type="text/javascript">function setREVStartSize(e){
			//window.requestAnimationFrame(function() {				 
				window.RSIW = window.RSIW===undefined ? window.innerWidth : window.RSIW;	
				window.RSIH = window.RSIH===undefined ? window.innerHeight : window.RSIH;	
				try {								
					var pw = document.getElementById(e.c).parentNode.offsetWidth,
						newh;
					pw = pw===0 || isNaN(pw) ? window.RSIW : pw;
					e.tabw = e.tabw===undefined ? 0 : parseInt(e.tabw);
					e.thumbw = e.thumbw===undefined ? 0 : parseInt(e.thumbw);
					e.tabh = e.tabh===undefined ? 0 : parseInt(e.tabh);
					e.thumbh = e.thumbh===undefined ? 0 : parseInt(e.thumbh);
					e.tabhide = e.tabhide===undefined ? 0 : parseInt(e.tabhide);
					e.thumbhide = e.thumbhide===undefined ? 0 : parseInt(e.thumbhide);
					e.mh = e.mh===undefined || e.mh=="" || e.mh==="auto" ? 0 : parseInt(e.mh,0);		
					if(e.layout==="fullscreen" || e.l==="fullscreen") 						
						newh = Math.max(e.mh,window.RSIH);					
					else{					
						e.gw = Array.isArray(e.gw) ? e.gw : [e.gw];
						for (var i in e.rl) if (e.gw[i]===undefined || e.gw[i]===0) e.gw[i] = e.gw[i-1];					
						e.gh = e.el===undefined || e.el==="" || (Array.isArray(e.el) && e.el.length==0)? e.gh : e.el;
						e.gh = Array.isArray(e.gh) ? e.gh : [e.gh];
						for (var i in e.rl) if (e.gh[i]===undefined || e.gh[i]===0) e.gh[i] = e.gh[i-1];
											
						var nl = new Array(e.rl.length),
							ix = 0,						
							sl;					
						e.tabw = e.tabhide>=pw ? 0 : e.tabw;
						e.thumbw = e.thumbhide>=pw ? 0 : e.thumbw;
						e.tabh = e.tabhide>=pw ? 0 : e.tabh;
						e.thumbh = e.thumbhide>=pw ? 0 : e.thumbh;					
						for (var i in e.rl) nl[i] = e.rl[i]<window.RSIW ? 0 : e.rl[i];
						sl = nl[0];									
						for (var i in nl) if (sl>nl[i] && nl[i]>0) { sl = nl[i]; ix=i;}															
						var m = pw>(e.gw[ix]+e.tabw+e.thumbw) ? 1 : (pw-(e.tabw+e.thumbw)) / (e.gw[ix]);					
						newh =  (e.gh[ix] * m) + (e.tabh + e.thumbh);
					}				
					if(window.rs_init_css===undefined) window.rs_init_css = document.head.appendChild(document.createElement("style"));					
					document.getElementById(e.c).height = newh+"px";
					window.rs_init_css.innerHTML += "#"+e.c+"_wrapper { height: "+newh+"px }";				
				} catch(e){
					console.log("Failure at Presize of Slider:" + e)
				}					   
			//});
		  };</script>
		<style type="text/css" id="wp-custom-css">
			.share-buttons li a { background: transparent; }

.alt-search-box.main-search-container:before {
    background: rgba(51,51,51,0.2) !important;
}

.form-booking-event .coupon-widget-wrapper { display: inline-block; }		</style>
		<style id="kirki-inline-styles">#logo img{max-height:43px;}#header.cloned #logo img{max-width:120px;}body{font-family:Raleway;font-size:15px;font-weight:400;line-height:27px;text-align:left;text-transform:none;color:#707070;}#logo h1 a,#logo h2 a{font-family:Raleway;font-size:24px;font-weight:400;line-height:27px;text-align:left;text-transform:none;color:#666;}h1,h2,h3,h4,h5,h6{font-family:Raleway;font-weight:400;}#navigation ul > li > a{font-family:Raleway;font-size:16px;font-weight:400;line-height:32px;text-align:left;text-transform:none;color:#444;}/* cyrillic-ext */
@font-face {
  font-family: 'Raleway';
  font-style: normal;
  font-weight: 400;
  font-display: swap;
  src: url(/home/customer/www/loneme.app/public_html/wp-content/fonts/raleway/1Ptxg8zYS_SKggPN4iEgvnHyvveLxVvaorCFPrcVIT9d4cydYA.woff) format('woff');
  unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
}
/* cyrillic */
@font-face {
  font-family: 'Raleway';
  font-style: normal;
  font-weight: 400;
  font-display: swap;
  src: url(/home/customer/www/loneme.app/public_html/wp-content/fonts/raleway/1Ptxg8zYS_SKggPN4iEgvnHyvveLxVvaorCMPrcVIT9d4cydYA.woff) format('woff');
  unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
}
/* vietnamese */
@font-face {
  font-family: 'Raleway';
  font-style: normal;
  font-weight: 400;
  font-display: swap;
  src: url(/home/customer/www/loneme.app/public_html/wp-content/fonts/raleway/1Ptxg8zYS_SKggPN4iEgvnHyvveLxVvaorCHPrcVIT9d4cydYA.woff) format('woff');
  unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
}
/* latin-ext */
@font-face {
  font-family: 'Raleway';
  font-style: normal;
  font-weight: 400;
  font-display: swap;
  src: url(/home/customer/www/loneme.app/public_html/wp-content/fonts/raleway/1Ptxg8zYS_SKggPN4iEgvnHyvveLxVvaorCGPrcVIT9d4cydYA.woff) format('woff');
  unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Raleway';
  font-style: normal;
  font-weight: 400;
  font-display: swap;
  src: url(/home/customer/www/loneme.app/public_html/wp-content/fonts/raleway/1Ptxg8zYS_SKggPN4iEgvnHyvveLxVvaorCIPrcVIT9d4cw.woff) format('woff');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}</style>	

<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
 
    <!-- Bootstrap CSS File -->
<!--     <link href="css/bootstrap.min.css?v=2a" rel="stylesheet"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Libraries CSS Files -->
    <link href="fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    


	<script type="text/javascript" src="js/ajax.js?v=5"></script>	
    <!-- Required JavaScript Libraries -->
    <script src="js/jquery.min.js"></script>
<!--
    <script src="js/bootstrap.min.js"></script>
    
-->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- Custom Javascript File -->
<!--     <script src="js/custom.js"></script> -->

	<script type="text/javascript" src="js/general.js?v=5"></script>	
	<script type='text/javascript' src="js/dist/clipboard.min.js"></script>
	
	<? echo $js_file_name ?>
	
	<!-- Favicons -->
	<link rel="shortcut icon" href="images/favicon.png" />
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	
<link type="text/css" href="css/custom-theme/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-ui-1.8.23.custom.min.js"></script> 

 <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script> 

 <script type="text/javascript" src="js/jquery_form.js"></script>
	
</head>

 <body class="page-index has-hero">

<nav class="navbar fixed-top navbar-expand-lg navbar-light " style="background-color: #e3f2fd;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="/loneme_proto/images/comfort-logo-blk.png" alt="" height="24"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="main.php">Home</a>
        </li>
 <?php
 		if ($_SESSION['type'] == "client") {
?>
	    <li class="nav-item">
          <a class="nav-link" href="create_moment.php">Book a Moment</a>
        </li>

<?php	 		
 		} elseif ($_SESSION['type'] == "provider") {
?>
        <li class="nav-item">
          <a class="nav-link" href="moment_list.php?type=available">Your Opportunities</a>
        </li>

<?php	 		
 		}
 
?>
        <li class="nav-item">
          <a class="nav-link" href="moment_list.php?type=upcoming">Upcoming Moments</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="moment_list.php?type=past">Past Moments</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="#" id='logout'>Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<?php	
		
}


/*
	function html_top($page, $js_file_name) {
	
	$utilities = new Utilities;
	$site_type = $utilities->site_type;
	
	$robot_test = $utilities->robot_test($page);

?>

<!DOCTYPE html>
<html lang="en">
<head>

	<title>LoneMe - A Prototype</title>
	
	<meta charset="utf-8" />
<!-- 	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /> -->
<!--
	<meta name="viewport" content="user-scalable = yes">
	<meta name="viewport" content="width=1050">	
-->
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

	
<?php
	if ($site_type == "prototype" || $robot_test == false) {
		echo "<meta name='robots' content='noindex'>";
	}
?>	
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300i,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Julius+Sans+One" rel="stylesheet">
    <!-- Bootstrap CSS File -->
    <link href="css/bootstrap.min.css?v=2a" rel="stylesheet">
  
    <!-- Libraries CSS Files -->
    <link href="fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- Main Stylesheet File -->
    <link href="css/style.css?v=2a" rel="stylesheet">
    
	<!-- CustomStylesheet File -->
  	<link href="css/custom.css?v=3" rel="stylesheet">
    


	<script type="text/javascript" src="js/ajax.js?v=5"></script>	
    <!-- Required JavaScript Libraries -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    

	<script type="text/javascript" src="js/general.js?v=5"></script>	
	<script type='text/javascript' src="js/dist/clipboard.min.js"></script>
	
	<? echo $js_file_name ?>
	
	<!-- Favicons -->
	<link rel="shortcut icon" href="images/favicon.png" />
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	
<link type="text/css" href="css/custom-theme/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-ui-1.8.23.custom.min.js"></script> 

 <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script> 
<!--  <script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>  -->

 <script type="text/javascript" src="js/jquery_form.js"></script>
	
	<script>
		//Required for Safari iOS to reload the page when a user pressed back, if we don't do this, an old verion of a profile may appear
		$(window).bind("pageshow", function(event) {
				if (event.originalEvent.persisted) {
				window.location.reload() 
			}
		});
	</script>
	
	
</head>

 <body class="page-index has-hero">


    <div id="background-wrapper" class="block block-pd-sm block-bg-grey-dark block-bg-overlay block-bg-overlay-6" data-block-bg-img="images/main-desktop-bg-bartender.jpg">

        <!-- ======== @Region: #navigation ======== -->
        <div id="navigation" class="wrapper">

            <!--Header & navbar-branding region-->
            <div class="header">
                <div class="header-inner container">
                    <div class="row">
                        <div class="col-md-12 col-xs-9 text-center" style="margin-top: -5px">
                            <!--navbar-branding/logo - hidden image tag & site name so things like Facebook to pick up, actual logo set via CSS for flexibility -->

                        </div>
                        <div class="col-xs-3 hidden-sm hidden-md hidden-lg">
                            <div class="navbar navbar-default">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
	            

                <div class="navbar navbar-default ">
                    <!--mobile collapse menu button-->

                    <!--social media icons-->
                    <div class="navbar-text social-media social-media-inline pull-right hidden-xs">
                        <a href=""><i class="fa fa-facebook"></i></a>
                        <a href=""><i class="fa fa-instagram"></i></a>
                        <a href="/"><i class="fa fa-twitter"></i></a>
                    </div>
                    <!--everything within this div is collapsed on mobile-->
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav" id="main-menu">
                            <li class="icon-link">
                                <a href="main.php"><i class="fa fa-home"></i></a>
                            </li>
<!--
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Profile<b class="caret"></b></a>
                                <!-- Dropdown Menu -->
                                <ul class="dropdown-menu">
                                    <li>
                                    	<a href="job.php?ID=new_job&page=location" tabindex="-1" class="menu-item">Post New Job</a>
                                    </li>
                                    <li>
                                    	<a href="main.php" tabindex="-1" class="menu-item">Current Job Posts</a>
                                    </li>                                    
                                    <li>
                                    	<a href="job_list.php" tabindex="-1" class="menu-item">View Job Archive</a>
                                    </li>
                                </ul>
                            </li>
-->
                            <li>
                            	<a href="#">Settings</a>
                            </li>
                            <li>
                            	<a href="#">Help/FAQ</a>
                            </li>
                            <li>
                            	<a href="#">Contact</a>
                            </li>                            
                            <li>
                            	<a href="#" id="logout">Logout</a>
                            </li>
                        </ul>
                    </div>
                    <!--/.navbar-collapse -->
                </div>
            </div>
        </div>
    </div>
<?php	
		
}
*/


 // end of function
 
 function nav_bar_bottom() {
?>
	 <nav class="navbar fixed-bottom navbar-light bg-light" >
			 <div class="container-fluid">
				 <div class="alert alert-success " id="message_alert" role="alert" style="display:none">
					  You have a new message <a href="message_list.php">View Message</a>
					</div>
			  </div>

		  <div class="container-fluid" >

				  <div class="col-3 text-center">
					 <a href="main.php"><i class="bi-house" style="font-size: 2rem; color: cornflowerblue"></i></a>
				  </div>
				  <div class="col-3 text-center">
					 <i class="bi-list-stars" style="font-size: 2rem; color: cornflowerblue"></i>
				  </div>
				  <div class="col-3 text-center">
					 <a href="message_list.php"><i class="bi-inbox" style="font-size: 2rem; color: cornflowerblue"></i></a>
				  </div>
				  <div class="col-3 text-center">
					 <i class="bi-gear" style="font-size: 2rem; color: cornflowerblue"></i>
				  </div>
			  
		  </div>
	 </nav>  
<?php
 }
	
	function html_footer() {

	$utilities = new Utilities; 
	$site_type = $utilities->site_type;		
?>
&nbsp; <br /> &nbsp; <br /> &nbsp; <br /> &nbsp; <br />
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

	            </div>
	            <div class="col-xs-4 text-center">
                   <h5>Information</h5>
                  <a href="#">Contact</a><br />
                  <a href="#">Privacy</a><br />
                   <a href="#">TOS</a><br />
                </div>
	            <div class="col-xs-4">
                   <h5>Follow Us</h5>
                   <a href="#">Facebook</a><br />
                   <a href="#">Instagram</a><br />
                   <a href="#">Twitter</a><br />
                </div>
-->

            </div>
        </div>
    </div>

    <!-- ======== @Region: #footer ======== -->
    <footer id="footer" class="block block-bg-grey-dark">
<!--
        <div class="container">
            <div class="row subfooter">
                <div class="col-md-12 text-center">
                    <p>Copyright 2021</p>
                </div>
            </div>

            <a href="#top" class="scrolltop">Top</a>
-->

        </div>
    </footer>

	
	</div>

	<!-- End Wrapper -->
	

<script>
		general_buttons();
	
	
	$("#logout").click(function() {
		$.ajax({
			type: "POST",
			url: "lgout.php",
			success: function(data) {
				//alert("logout");
			
			}
		});	
		return false;
	});	

</script>


</body>
</html>
<?php
}	
	
//end function


	
	
	function login_warning_page() {
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<title>LoneMe - Prototype</title>
	
	<meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta name='robots' content='noindex'>

    <!-- MITCH CSS -->
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300i,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Julius+Sans+One" rel="stylesheet">
    <!-- Bootstrap CSS File -->
    <link href="css/bootstrap.min.css?v=2a" rel="stylesheet">
  
    <!-- Libraries CSS Files -->
    <link href="fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- Main Stylesheet File -->
    <link href="css/style.css?v=2a" rel="stylesheet">
    
	<!-- CustomStylesheet File -->
  	<link href="css/custom.css?v=3" rel="stylesheet">
    
      <!-- END MITCH CSS -->
	<script type="text/javascript" src="js/ajax.js?v=5"></script>	
    <!-- Required JavaScript Libraries -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    <!-- Custom Javascript File -->
<!--     <script src="js/custom.js"></script> -->

<!-- 	<script type="text/javascript" src="js/general.js?v=5"></script>	 -->
		
	<!-- Favicons -->
	<link rel="shortcut icon" href="images/favicon.png" />
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	
<link type="text/css" href="css/custom-theme/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-ui-1.8.23.custom.min.js"></script> 

 <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script> 
<!--  <script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>  -->

<!--  <script type="text/javascript" src="js/jquery_form.js"></script> -->
		
</head>

 <body class="page-index has-hero">

    <div id="background-wrapper" class="block block-pd-sm block-bg-grey-dark block-bg-overlay block-bg-overlay-6" data-block-bg-img="images/main-desktop-bg-bartender.jpg">

        <!-- ======== @Region: #navigation ======== -->
        <div id="navigation" class="wrapper">

            <!--Header & navbar-branding region-->
            <div class="header">
                <div class="header-inner container">
                    <div class="row">
                        <div class="col-md-12 col-xs-9 text-center">
                            <h1 class="hidden">LoneMe</h1>
                        </div>
                        <div class="col-xs-3 hidden-sm hidden-md hidden-lg">
                            <div class="navbar navbar-default">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
	            &nbsp; 
            </div>
        </div>
    </div>

	<div class='container' style="min-height: 60%">
		<div class="row text-center" style="margin-top: 40px">
			<h1>You must be logged in to view this page</h1>
		</div>
	</div>
<?php		
	}
	
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