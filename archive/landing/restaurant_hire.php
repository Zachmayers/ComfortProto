<?php
	$refID = $cmp = $rgn = $ste = $dmg = $ad = $msc_a = $msc_b = "NA";
	
	//loop through reference GET vars and set
	foreach($_GET as $key => $value) {
		switch($key) {
			case "refID":
				$refID = $value;
			break;
			
			case "CMP":
				$cmp = $value;
			break;

			case "RGN":
				$rgn = $value;
			break;
			
			case "STE":
				$ste = $value;
			break;
			
			case "DMG":
				$dmg = $value;
			break;

			case "AD":
				$ad = $value;
			break;

			case "MSCA":
				$msc_a = $value;
			break;

			case "MSCB":
				$msc_b = $value;
			break;			
		}
	}
	
	if (isset($_COOKIE['ID'])) {	
		//do nothing
	} else {	
		if ($refID == "NA" && $cmp == "NA" && $rgn == "NA" && $ste == "NA" && $dmg == "NA" && $ad == "NA" && $msc_a == "NA" && $msc_b == "NA") {
			//do nothing
		} else {
			//set cookie for ad tracking
			$ad_track = 	$refID.",".$cmp.",".$rgn.",".$ste.",".$dmg.",".$ad.",".$msc_a .",".$msc_b;
			setcookie('ID', $ad_track, time() + (86400 * 30), '/');	
		}
	}	
	
?>
<!doctype html>
<html lang="en">
<head>
	
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38015816-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
	
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- <meta name="description" content=""> -->

	<title>Serve. Bartend. Cook. - The Finest Hospitality Jobs!</title>

  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700' rel='stylesheet' type='text/css'>


<style>

html { 
  background: #000 url(fbar02bg.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  margin-left: 0;
  margin-right:0;
}


h1 {font-family: 'Open Sans Condensed', sans-serif; color: #fff; margin-top: 0px; font-size: 32px}
h2 {color: #fff; margin-top: 0px; font-size: 18px}

.btn {  position: relative;text-decoration: none; font-family: 'Open Sans Condensed'; border-radius: 20px;  background: #c31c23; padding: 6px; padding-left: 30px; padding-right: 30px; color: #fff; text-align: center; font-size: 24px; font-weight: bold; width: 300px;  border: 2px solid #fff;}

.btn:hover {background: #ae171e;}

.header {text-align: center; width: 100%; margin-top: 60px;}

.header img {width: 100%; height: auto; max-width: 940px;} 

.content  {max-width: 90%; position: relative; margin: 0 auto; margin-top: 180px; padding: 0px; }

p {font-family: 'Open Sans Condensed', sans-serif; color: #fff!important; font-size: 24px; line-height: 28px; margin-bottom: 40px;}

.block {max-width: 100%; background: rgba(0, 0, 0, 0.7); padding: 20px; border-radius: 8px;padding-bottom: 40px; text-align: center;} 

a {
    color: #fff;
}


@media (max-width: 767px) and (orientation: portrait){

h1 {font-family: 'Open Sans Condensed', sans-serif; color: #fff; margin-top: 0px; font-size: 28px}
h2 {color: #fff; margin-top: 0px; font-size: 18px}

.header {text-align: center; width: 100%; margin-top: 30px;}

.content  {max-width: 98%; position: relative; margin: 0 auto; margin-top: 60px; padding: 0px; }

.block {max-width: 100%; float: right; background: rgba(0, 0, 0, 0.3); padding: 20px; border-radius: 8px;padding-bottom: 40px; text-align: center;} 

p {font-size: 24px; margin-top: -10px;}

html { 
  background: #000 url(fbar02bg.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}


}

@media (max-width: 767px) and (orientation: landscape){

.block {max-width: 100%; float: right; background: rgba(0, 0, 0, 0.3); padding: 20px; border-radius: 8px;padding-bottom: 40px; text-align: center;} 

.header {text-align: center; width: 100%; margin-top: 10px;}
.content {margin-top: 0px;}
p {font-size: 22px;}


}

</style>


</head>
<body>

<div class="header">
<img src="logo.png" class="logo">
</div>

<div class="content">

<div class="block">
		<h1>FIND YOUR NEW JOB TODAY</h1>

		<p>We match you with the best jobs available based on skills, experience and location.</p>

		<a href="http://servebartendcook.com/index.php?page=employee_signup" class="btn">GET STARTED NOW</a>
		<p style='margin-bottom:10px; margin-top:15px'><a href='http://servebartendcook.com'>Learn More</a></p>
		<span style='color:white;'><a href='http://servebartendcook.com/index.php?page=employer_signup'>Are you hiring?  Click Here</a></span>
</div>
</div>


</body>
</html>