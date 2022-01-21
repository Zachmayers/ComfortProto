<?php
	function main_stats_html() {
?>		
	<div class="container text-center">
		<h2 style="text-align: center">Administrator Stats Portal</h2>
			
		<h4 style="text-align: center">Beta Version 1.3 (Watch the Throne)</h4>	
			<div style="margin-left: 10px; margin-right: 5px; float:left; width:100%">
				<div style="float:left; width:100%;margin-top: 25px; margin-bottom: 25px;">
					<h2>Latest Paid Jobs</h2>
					&nbsp; <br />
					<a href='admin_stats.php?page=paid_jobs' class='btn btn-large btn-primary'>PAID JOBS</a><br />
					&nbsp; <br />
					&nbsp; <br />

					<h2>Mailer Indicators</h2>
					&nbsp; <br />
					<a href='admin_stats.php?page=mailer_indicators' class='btn btn-large btn-primary'>MAILER INDICATORS</a><br />
					&nbsp; <br />
					&nbsp; <br />
					
					<h2>Amazon Cards Owed</h2>
					&nbsp; <br />
					<a href='admin_stats.php?page=amazon_cards' class='btn btn-large btn-primary'>AMAZON MENU</a><br />
					&nbsp; <br />
					&nbsp; <br />					
				

					<h2>Insightly Updates</h2>
					&nbsp; <br />
					<a href='admin_stats.php?page=insightly_menu' class='btn btn-large btn-primary'>INSIGHTLY MENU</a><br />
					&nbsp; <br />
					&nbsp; <br />
					
					<h2>CL Setup</h2>
					&nbsp; <br />
					<a href='admin_stats.php?page=cl_setup' class='btn btn-large btn-primary'>CL MENU</a><br />
					&nbsp; <br />
					&nbsp; <br />
					
					<h2>Ad Job Feed</h2>
					&nbsp; <br />
					<a href='admin_stats.php?page=ad_feed' class='btn btn-large btn-primary'>FEED DATA</a><br />
					&nbsp; <br />
					&nbsp; <br />
										
					
					<h2>Landing Page Setup</h2>
					&nbsp; <br />
					<a href='admin_stats.php?page=store_images' class='btn btn-large btn-primary'>IMAGE LIST</a><br />
					<a href='admin_stats.php?page=landing_setup' class='btn btn-large btn-primary'>SETUP</a><br />

					&nbsp; <br />
					&nbsp; <br />
					
<!--
					<h2>Tracking</h2>
					&nbsp; <br />
					<a href='admin_stats.php?page=build_tracking' class='btn btn-large btn-primary'>BUILD TRACKING TAGS/LINK</a><br />
-->
					&nbsp; <br />
					&nbsp; <br />
					<h2>Stats</h2>
					&nbsp; <br />
					<a href='admin_stats.php?page=stats_menu&type=day' class='btn btn-large btn-primary'>DAILY STATS</a><br />
					&nbsp; <br />
					&nbsp; <br />
					<a href='admin_stats.php?page=stats_menu&type=week' class='btn btn-large btn-primary'>WEEKLY STATS</a><br />
					&nbsp; <br />
					&nbsp; <br />
					<a href='admin_stats.php?page=stats_menu&type=month' class='btn btn-large btn-primary'>MONTHLY STATS</a><br />				
					&nbsp; <br />
					&nbsp; <br />
					<a href='admin_stats.php?page=site_totals&region=all' class='btn btn-large btn-primary'>SITE TOTALS</a><br />				
					&nbsp; <br />
					&nbsp; <br />
					<a href='admin_stats.php?page=bounty_stats_results' class='btn btn-large btn-primary'>BOUNTY STATS</a><br />				
					&nbsp; <br />
					
					<h2>List Data</h2>
					&nbsp; <br />
					<a href='admin_stats.php?page=new_jobs' class='btn btn-large btn-primary'>NEW JOBS (LAST 7 DAYS)</a><br />				
					&nbsp; <br />
					&nbsp; <br />
					<a href='admin_stats.php?page=stores_region&zip=none' class='btn btn-large btn-primary'>STORES BY REGION</a><br />				
					&nbsp; <br />					
					&nbsp; <br />
					<a href='admin_stats.php?page=employer_email_list' class='btn btn-large btn-primary'>EMPLOYER LIST FOR MAILCHIMP</a><br />				
					&nbsp; <br />										
					&nbsp; <br />	
					<a href='admin_stats.php?page=6_month_list' class='btn btn-large btn-primary'>NO LOGINS FOR 6-MONTHS</a><br />				
					&nbsp; <br />
					&nbsp; <br />	
<!--
					<a href='admin_stats.php?page=bounty_stats_choose' class='btn btn-large btn-primary'>DAILY BOUNTY VIEWS</a><br />				
					&nbsp; <br />
-->

					<h2>Employee SendGrid Lists</h2>
					&nbsp; <br />
					<a href='admin_stats.php?page=employee_list&region=orlando' class='btn btn-large btn-primary'>ORLANDO</a><br />				
					&nbsp; <br />
					&nbsp; <br />
					<a href='admin_stats.php?page=employee_list&region=tampa' class='btn btn-large btn-primary'>TAMPA</a><br />				
					&nbsp; <br />
					&nbsp; <br />
					<a href='admin_stats.php?page=employee_list&region=charlotte' class='btn btn-large btn-primary'>CHARLOTTE</a><br />				
					&nbsp; <br />
					&nbsp; <br />
					<a href='admin_stats.php?page=employee_list&region=charleston' class='btn btn-large btn-primary'>CHARLESTON</a><br />				
					&nbsp; <br />
					&nbsp; <br />
										
					<h2>Pavement Setup</h2>
					&nbsp; <br />
					<a href='admin_stats.php?page=pavement_list&type=menu' class='btn btn-large btn-primary'>PAVEMENT LISTS</a><br />				
					&nbsp; <br />
					&nbsp; <br />
					<a href='admin_stats.php?page=pavement_stats' class='btn btn-large btn-primary'>PAVEMENT STATS</a><br />				
					&nbsp; <br />
					
					<h2>Amazon Products</h2>
					&nbsp; <br />
					<a href='admin_stats.php?page=product_options' class='btn btn-large btn-primary'>PRODUCT OPTIONS</a><br />				
					&nbsp; <br />
					&nbsp; <br />
					
<!--
					<h2>Email Statistics (ONLY AVAILABLE ON PROTOTYPE)</h2>
					&nbsp; <br />
					<a href='admin_stats.php?page=email_stats_ajax' class='btn btn-large btn-primary'>EMAIL STATS</a><br />									
-->
				</div>
			</div>
		<hr>
	</div>								 
<?php
	}//end html_page_main function
	
	function build_tracking_link_html() {
?>
	<div class="container text-center">
<?php
		echo "<h3>Use the options below to build a tracking link, tags, or html</h3>";
		
		echo "Please enter up to 10 characters into tags (or leave blank)<br />";
		echo "<b>Do NOT use spaces, instead use _ (underscore)</b><br />";
		echo "<b>Only Numbers, Letters or Underscore.  NO OTHER SYMBOLS</b><br />";
		
		echo "&nbsp; <br />";
		echo "refID:  <input type='text' id='refID' size='10'><br />";		
		echo "CMP:  <input type='text' id='cmp' size='10'><br />";
		echo "RGN:  <input type='text' id='rgn' size='10'><br />";
		echo "STE:  <input type='text' id='ste' size='10'><br />";
		echo "DMG:  <input type='text' id='dmg' size='10'><br />";
		echo "AD:  <input type='text' id='ad' size='10'><br />";
		echo "MSCA:  <input type='text' id='msca' size='10'><br />";
		echo "MSCB:  <input type='text' id='mscb' size='10'><br />";
		
		echo "&nbsp; <br  />";

		echo "Landing Page (without HTTP):  <input type='text' id='landing' size='20'><br />";	
		
		echo "&nbsp; <br  />";

		echo "Text for Clickable Link:  <input type='text' id='click_text' size='20'><br />";	
		echo "<i>For Craigslist or Similar ads</i><br />";
		echo "&nbsp; <br  />";
		echo "&nbsp; <br  />";
		
		echo "<a href='#' id='create_link' class='btn btn-primary'>Create Links</a><br />";
		echo "&nbsp; <br  />";
		
		echo "<div id='link_info_holder'>";		
		echo "</div>";
	
?>
	</div>
<script>
		$(document).on("click", '#create_link', function() {	
			refID = $("#refID").val();
			cmp = $("#cmp").val();
			rgn = $("#rgn").val();
			ste = $("#ste").val();
			dmg = $("#dmg").val();
			ad = $("#ad").val();
			msca = $("#msca").val();
			mscb = $("#mscb").val();
			landing = $("#landing").val();
			click_text = $("#click_text").val();

			dataString = "refID=" + refID + "&CMP=" + cmp + "&RGN=" + rgn + 
								"&STE=" + ste + "&DMG=" + dmg + "&AD=" + ad + "&MSCA=" + msca + 
								"&MSCB=" + mscb + "&landing=" + landing + "&click_text=" + click_text;
			$.ajax({
				type: "POST",
				url: "admin_stats.php?page=build_tracking_ajax",
				data: dataString,
				success: function(data) {
					//alert(data);
					$( "#link_info_holder" ).replaceWith(data);
				}
			});					
			return false;
		});		
</script>
<?php				
}
	
function stat_options_html($type) {	
?>	
	<div class="container text-center">	
		<h1>Stat Options</h1>
<?php	
		switch($type) {
			case "day":
				echo "Year <select id='year'>";
					echo "<option value='2016'>2016</option>";
					echo "<option value='2015'>2015</option>";
					echo "<option value='2014'>2014</option>";
				echo "</select>";
				echo "Month <select id='month'>";
					$month = 1;
					while ($month <= 12) {
						echo "<option value=$month>".$month."</option>";
						$month++;
					}
				echo "</select>";
					echo "Day <select id='day'>";
					$day = 1;
					while ($day <= 31) {
						echo "<option value=$day>".$day."</option>";
						$day++;
					}
				echo "</select>";	
			break;
			
			case "week":
				echo "Week Start Date:  ";
				echo "Year <select id='year'>";
					echo "<option value='2016'>2016</option>";
					echo "<option value='2015'>2015</option>";
					echo "<option value='2014'>2014</option>";
				echo "</select>";
				echo "Month <select id='month'>";
					$month = 1;
					while ($month <= 12) {
						echo "<option value=$month>".$month."</option>";
						$month++;
					}
				echo "</select>";
					echo "Day <select id='day'>";
					$day = 1;
					while ($day <= 31) {
						echo "<option value=$day>".$day."</option>";
						$day++;
					}
				echo "</select>";					
			break;
			
			case "month":
				echo "Year <select id='year'>";
					echo "<option value='2016'>2016</option>";
					echo "<option value='2015'>2015</option>";
					echo "<option value='2014'>2014</option>";
				echo "</select>";
				
				echo "Month <select id='month'>";
					$month = 1;
					while ($month <= 12) {
						echo "<option value=$month>".$month."</option>";
						$month++;
					}
				echo "</select>";			
			break;
		}
		
		echo "<br /> &nbsp; <br /><a href='#' class='submit_stats' id='".$type."'>SUBMIT</a>";
?>
	</div>
<script>
		$(document).on("click", '.submit_stats', function() {	
			//alert("here");
			stats_type = $(this).attr("id");
			if (stats_type == 'day' || stats_type == 'week') {
				day = $('#day').val();
				month = $('#month').val();
				year = $('#year').val();				
			} else {
				day = '1';
				month = $('#month').val();
				year = $('#year').val();								
			}
			window.location = "admin_stats.php?page=view_stats&type="+stats_type+"&day="+day+"&month="+month+"&year="+year;
			return false;
		});		
</script>
<?php		
	}
	
function stats_html($type, $employees, $employers, $jobs, $logins, $employee_types, $job_types) {
$utilities = new Utilities;
$admin = new Admin;

//==================================
//  Modify any data for presentation
//==================================
		$ad_ref_array = $admin->get_signup_ref($employees['new'], $employers['new']);

		$new_employees = count($employees['new']);
		$minus_month_employees = count($employees['month']);
		$minus_year_employees = count($employees['year']);
		
		//changes
		$month_change_employees = $admin->percent_change($new_employees, $minus_month_employees);
		$year_change_employees = $admin->percent_change($new_employees, $minus_year_employees);

		$new_employers = count($employers['new']);
		$minus_month_employers = count($employers['month']);
		$minus_year_employers = count($employers['year']);

		//changes
		$month_change_employers = $admin->percent_change($new_employers, $minus_month_employers);
		$year_change_employers = $admin->percent_change($new_employers, $minus_year_employers);

		$non_verified_new = $admin->non_verified_test($employees['new']) + $admin->non_verified_test($employers['new']);
		$non_verified_month = $admin->non_verified_test($employees['month']) + $admin->non_verified_test($employers['month']);
		$non_verified_year = $admin->non_verified_test($employees['year']) + $admin->non_verified_test($employers['year']);

		$incomplete_new = $admin->incomplete_test("incomplete", $employees['new']) + $admin->incomplete_test("incomplete", $employers['new']);
		$incomplete_month = $admin->incomplete_test("incomplete", $employees['month']) + $admin->incomplete_test("incomplete", $employers['month']);
		$incomplete_year = $admin->incomplete_test("incomplete", $employees['year']) + $admin->incomplete_test("incomplete", $employers['year']);
	
		$runaway_new = $admin->runaway_test($employees['new']) + $admin->runaway_test($employers['new']);
		$runaway_month = $admin->runaway_test($employees['month']) + $admin->runaway_test($employers['month']);
		$runaway_year = $admin->runaway_test($employees['year']) + $admin->runaway_test($employers['year']);
	
		//change
		$month_change_non_verified = $admin->percent_change($non_verified_new, $non_verified_month);
		$year_change_non_verified = $admin->percent_change($non_verified_new, $non_verified_year);
		

		$new_jobs = count($jobs['new']);
		$minus_month_jobs = count($jobs['month']);
		$minus_year_jobs = count($jobs['year']);

		//changes
		$month_change_jobs = $admin->percent_change($new_jobs, $minus_month_jobs);
		$year_change_jobs = $admin->percent_change($new_jobs, $minus_year_jobs);


		$new_logins = count($logins['new']);
		$minus_month_logins = count($logins['month']);
		$minus_year_logins = count($logins['year']);

		//changes
		$month_change_logins = $admin->percent_change($new_logins, $minus_month_logins);
		$year_change_logins = $admin->percent_change($new_logins, $minus_year_logins);
		
		if ($type == "week" || $type == "day") {
			$minus_week_employees = count($employees['week']);
			$minus_week_employers = count($employers['week']);
			$minus_week_jobs = count($jobs['week']);
			$minus_week_logins = count($logins['week']);
			$non_verified_week = $admin->non_verified_test($employees['week']) + $admin->non_verified_test($employers['week']);
			$incomplete_week = $admin->incomplete_test("incomplete", $employees['week']) + $admin->incomplete_test("incomplete", $employers['week']);
			$runaway_week = $admin->runaway_test($employees['week']) + $admin->runaway_test($employers['week']);
			
			//changes
			$week_change_employees = $admin->percent_change($new_employees, $minus_week_employees);			
			$week_change_employers = $admin->percent_change($new_employers, $minus_week_employers);
			$week_change_jobs = $admin->percent_change($new_jobs, $minus_week_jobs);
			$week_change_logins = $admin->percent_change($new_logins, $minus_week_logins);			
			$week_change_non_verified = $admin->percent_change($non_verified_new, $non_verified_week);
			if ($minus_week_employees == 0 && $minus_week_employers == 0) {
				$week_non_verified_ratio = 0;
			} else {
				$week_non_verified_ratio = round(($non_verified_week / ($minus_week_employees + $minus_week_employers))*100, 2);
			}
		}

		if ($type == "day") {
			$minus_day_employees = count($employees['day']);
			$minus_day_employers = count($employers['day']);
			$minus_day_jobs = count($jobs['day']);
			$minus_day_logins = count($logins['day']);	
			$non_verified_day = $admin->non_verified_test($employees['day']) + $admin->non_verified_test($employers['day']);
			$incomplete_day = $admin->incomplete_test("incomplete", $employees['day']) + $admin->incomplete_test("incomplete", $employers['day']);
			$runaway_day = $admin->runaway_test($employees['day']) + $admin->runaway_test($employers['day']);
			
			//changes
			$day_change_employees = $admin->percent_change($new_employees, $minus_day_employees);			
			$day_change_employers = $admin->percent_change($new_employers, $minus_day_employers);			
			$day_change_jobs = $admin->percent_change($new_jobs, $minus_day_jobs);			
			$day_change_logins = $admin->percent_change($new_logins, $minus_day_logins);						
			$day_change_non_verified = $admin->percent_change($non_verified_new, $non_verified_day);
			$day_non_verified_ratio = $admin->percent_change($non_verified_day, ($minus_day_employees + $minus_day_employers));			
			if ($minus_day_employees == 0 && $minus_day_employers == 0) {
				$day_non_verified_ratio = 0;
			} else {
				$day_non_verified_ratio = round(($non_verified_day / ($minus_day_employees + $minus_day_employers))*100, 2);
			}
		}
		
		//Non verified ratios
		if ($new_employees == 0 && $new_employers == 0) {
				$new_non_verified_ratio = 0;
		} else {
			$new_non_verified_ratio = round(($non_verified_new / ($new_employees + $new_employers))*100, 2);
		}
		if ($minus_month_employees == 0 && $minus_month_employers == 0) {
			$month_non_verified_ratio = 0;
		} else {
			$month_non_verified_ratio = round(($non_verified_month / ($minus_month_employees + $minus_month_employers))*100, 2);
		}
		if ($minus_year_employees == 0 && $minus_year_employers == 0) {
			$year_non_verified_ratio = 0;
		} else {	
			$year_non_verified_ratio = round(($non_verified_year / ($minus_year_employees + $minus_year_employers))*100, 2);
		}
		
		if (isset($_GET['region'])) {
			$region = strtoupper($_GET['region']);
		} else {
			$region = "";
		}
		
		switch($type) {
			case "day":
				$header = "Single Day Data: ".$_GET['month']."/".$_GET['day']."/".$_GET['year'];
			break;
			
			case "week":
				$header = "Data for Week Beginning: ".$_GET['month']."/".$_GET['day']."/".$_GET['year'];
			break;	
			
			case "month":
				$header = "Data for Month Beginning: ".$_GET['month']."/".$_GET['day']."/".$_GET['year'];
			break;			
		}
			
		echo "<div class='container'>";
			echo "<h1>".$header."</h1>";

			echo "<a href='admin_stats.php?page=view_stats&type=".$_GET['type']."&day=".$_GET['day']."&month=".$_GET['month']."&year=".$_GET['year']."' class='btn btn-primary'>All</a>  ";
			echo "<a href='admin_stats.php?page=view_stats&type=".$_GET['type']."&day=".$_GET['day']."&month=".$_GET['month']."&year=".$_GET['year']."&region=orlando' class='btn btn-primary'>Orlando</a>  ";
			echo "<a href='admin_stats.php?page=view_stats&type=".$_GET['type']."&day=".$_GET['day']."&month=".$_GET['month']."&year=".$_GET['year']."&region=tampa' class='btn btn-primary'>Tampa</a> ";
			echo "<a href='admin_stats.php?page=view_stats&type=".$_GET['type']."&day=".$_GET['day']."&month=".$_GET['month']."&year=".$_GET['year']."&region=jacksonville' class='btn btn-primary'>Jacksonville</a> ";
			echo "<a href='admin_stats.php?page=view_stats&type=".$_GET['type']."&day=".$_GET['day']."&month=".$_GET['month']."&year=".$_GET['year']."&region=miami' class='btn btn-primary'>Miami</a><br />";
			echo "&nbsp; <br />";

			echo "<a href='admin_stats.php?page=view_stats&type=".$_GET['type']."&day=".$_GET['day']."&month=".$_GET['month']."&year=".$_GET['year']."&region=charlotte' class='btn btn-primary'>Charlotte</a> ";
			echo "<a href='admin_stats.php?page=view_stats&type=".$_GET['type']."&day=".$_GET['day']."&month=".$_GET['month']."&year=".$_GET['year']."&region=triangle' class='btn btn-primary'>Triangle</a> ";
			echo "<a href='admin_stats.php?page=view_stats&type=".$_GET['type']."&day=".$_GET['day']."&month=".$_GET['month']."&year=".$_GET['year']."&region=austin' class='btn btn-primary'>Austin</a> ";
			echo "<a href='admin_stats.php?page=view_stats&type=".$_GET['type']."&day=".$_GET['day']."&month=".$_GET['month']."&year=".$_GET['year']."&region=charleston' class='btn btn-primary'>Charleston</a> ";
			echo "<a href='admin_stats.php?page=view_stats&type=".$_GET['type']."&day=".$_GET['day']."&month=".$_GET['month']."&year=".$_GET['year']."&region=nashville' class='btn btn-primary'>Nashville</a><br />";

			echo "&nbsp; <br />";
			echo "&nbsp; <br />";

			echo "<div id='title_holder' style='width:100%; margin-top:-10px; float:left; padding-left:10px; font-size:1.125em;'>";
				echo "<h2>Stat Summary</h2>";
			echo "</div><br />";
			
			echo	"<table class='dark' style='width:100%;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle' style='width:200px'>Stat</th>";				
				echo "<th valign='middle' style='width:150px'>Current</th>";
				if ($type == "day") {
					echo "<th valign='middle' style='width:150px'>Yesterday</th>";				
				}
				if ($type == "week") {
					echo "<th valign='middle' style='width:150px'>Last Week</th>";				
				}				
				echo "<th valign='middle' style='width:150px'>Last Month</th>";
				echo "<th valign='middle' style='width:150px'>Last Year</th>";
				echo "</tr>";			
			echo "</table>";
			
			echo "<div style='float:left; width:100%; margin-top:5px; margin-bottom:5px; margin-left:5px;'>";	
				echo "<table style='width:600px'>"	;	
					echo "<tr>";
						echo "<td style='width:200px'><b>Employees</b></td>";
						echo "<td style='width:150px'>".$new_employees."</td>";					
						if ($type == "day") {
							echo "<td style='width:150px'>".$minus_day_employees." (".$day_change_employees."%)</td>";
						}					
						if ($type == "week") {
								echo "<td style='width:150px'>".$minus_week_employees." (".$week_change_employees."%)</td>";
						}
					
						echo "<td style='width:150px'>".$minus_month_employees." (".$month_change_employees."%)</td>";
						echo "<td style='width:150px'>".$minus_year_employees." (".$year_change_employees."%)</td>";
					echo "</tr>";
					
					echo "<tr>";
						echo "<td style='width:200px'><b>Employers</b></td>";
						echo "<td style='width:150px'>".$new_employers."</td>";					
						if ($type == "day") {
							echo "<td style='width:150px'>".$minus_day_employers." (".$day_change_employers."%)</td>";
						}					
						if ($type == "week") {
								echo "<td style='width:150px'>".$minus_week_employers." (".$week_change_employers."%)</td>";
						}
					
						echo "<td style='width:150px'>".$minus_month_employers." (".$month_change_employers."%)</td>";
						echo "<td style='width:150px'>".$minus_year_employers." (".$year_change_employers."%)</td>";
					echo "</tr>";
					
					echo "<tr>";
						echo "<td style='width:200px'><b>Jobs</b></td>";
						echo "<td style='width:150px'>".$new_jobs."</td>";					
						if ($type == "day") {
							echo "<td style='width:150px'>".$minus_day_jobs." (".$day_change_jobs."%)</td>";
						}					
						if ($type == "week") {
								echo "<td style='width:150px'>".$minus_week_jobs." (".$week_change_jobs."%)</td>";
						}
					
						echo "<td style='width:150px'>".$minus_month_jobs." (".$month_change_jobs."%)</td>";
						echo "<td style='width:150px'>".$minus_year_jobs." (".$year_change_jobs."%)</td>";
					echo "</tr>";

					echo "<tr>";
						echo "<td style='width:200px'><b>Logins</b></td>";
						echo "<td style='width:150px'>".$new_logins."</td>";					
						if ($type == "day") {
							echo "<td style='width:150px'>".$minus_day_logins." (".$day_change_logins."%)</td>";
						}					
						if ($type == "week") {
								echo "<td style='width:150px'>".$minus_week_logins." (".$week_change_logins."%)</td>";
						}
					
						echo "<td style='width:150px'>".$minus_month_logins." (".$month_change_logins."%)</td>";
						echo "<td style='width:150px'>".$minus_year_logins." (".$year_change_logins."%)</td>";
					echo "</tr>";		
					
					echo "<tr>";
						echo "<td style='width:200px'> &nbsp; </td>";
						echo "<td style='width:150px'> &nbsp; </td>";					
						if ($type == "day") {
							echo "<td style='width:150px'> &nbsp; </td>";
						}					
						if ($type == "week") {
								echo "<td style='width:150px'> &nbsp; </td>";
						}
					
						echo "<td style='width:150px'> &nbsp; </td>";
						echo "<td style='width:150px'> &nbsp; </td>";
					echo "</tr>";													
	
					echo "<tr>";
						echo "<td style='width:200px'><b>Non-Verified (Total)</b></td>";
						echo "<td style='width:150px'>".$non_verified_new."</td>";					
						if ($type == "day") {
							echo "<td style='width:150px'>".$non_verified_day." (".$day_change_non_verified."%)</td>";
						}					
						if ($type == "week") {
								echo "<td style='width:150px'>".$non_verified_week." (".$week_change_non_verified."%)</td>";
						}
					
						echo "<td style='width:150px'>".$non_verified_month." (".$month_change_non_verified."%)</td>";
						echo "<td style='width:150px'>".$non_verified_year." (".$year_change_non_verified."%)</td>";
					echo "</tr>";	
					
					echo "<tr>";
						echo "<td style='width:200px'><b>Non-Verified (Ratio)</b></td>";
						echo "<td style='width:150px'>".$new_non_verified_ratio."%</td>";					
						if ($type == "day") {
							echo "<td style='width:150px'>".$day_non_verified_ratio."%</td>";
						}					
						if ($type == "week") {
								echo "<td style='width:150px'>".$week_non_verified_ratio."%</td>";
						}
					
						echo "<td style='width:150px'>".$month_non_verified_ratio."%</td>";
						echo "<td style='width:150px'>".$year_non_verified_ratio."%</td>";
					echo "</tr>";					
									
					echo "<tr>";
						echo "<td style='width:200px'><b>Incomplete Profiles</b></td>";
						echo "<td style='width:150px'>".$incomplete_new."</td>";					
						if ($type == "day") {
							echo "<td style='width:150px'>".$incomplete_day."</td>";
						}					
						if ($type == "week") {
								echo "<td style='width:150px'>".$incomplete_week."</td>";
						}
					
						echo "<td style='width:150px'>".$incomplete_month."</td>";
						echo "<td style='width:150px'>".$incomplete_year."</td>";
					echo "</tr>";	
					
					echo "<tr>";
						echo "<td style='width:200px'><b>Runaway Members</b></td>";
						echo "<td style='width:150px'>".$runaway_new."</td>";					
						if ($type == "day") {
							echo "<td style='width:150px'>".$runaway_day."</td>";
						}					
						if ($type == "week") {
								echo "<td style='width:150px'>".$runaway_week."</td>";
						}
					
						echo "<td style='width:150px'>".$runaway_month."</td>";
						echo "<td style='width:150px'>".$runaway_year."</td>";
					echo "</tr>";					
				echo "</table>";
				
					echo "&nbsp;<br />";
	
			echo "<h2>Individual Reference Tags</h2>";
//break down ads into bits and pieces
			if ($ad_ref_array != "NA") {
				$signup_ref_array = $ad_ref_array['ref_array'];
			echo "<div style='float:left; width:600px; margin-bottom:10px;'>";
			
				echo "<div style='float:left; width:200px; margin-bottom:10px;'>";
					echo	"<table class='dark' style='width:100%;'>";
						echo "<tr valign='middle'>";
							echo "<th valign='middle' style='width:200px'>refID</th>";				
						echo "</tr>";
					echo "</table>";
					foreach ($ad_ref_array['refID'] as $refID) {
						$count = 0;
						foreach ($signup_ref_array as $row) {
							if ($row['refID'] == $refID) {
								$count++;
							}
						}
						if ($refID == "") {
							$refID = "NA";
						}
						echo "<div style='float:left; width:70%;'>";
							echo $refID;
						echo "</div>";
						echo "<div style='float:left; width:30%;'>";						
							echo "= ".$count;
						echo "</div><br />";
					}
				echo "</div>";
				
				echo "<div style='float:left; width:200px; margin-bottom:10px;'>";
					echo	"<table class='dark' style='width:100%;'>";
						echo "<tr valign='middle'>";
							echo "<th valign='middle' style='width:200px'>CMP</th>";				
						echo "</tr>";
					echo "</table>";
					foreach ($ad_ref_array['CMP'] as $cmp) {
						$count = 0;
						foreach ($signup_ref_array as $row) {
							if ($row['CMP'] == $cmp) {
								$count++;
							}
						}
						if ($cmp == "") {
							$cmp = "NA";
						}
						echo "<div style='float:left; width:70%;'>";
							echo $cmp;
						echo "</div>";
						echo "<div style='float:left; width:30%;'>";						
							echo "= ".$count;
						echo "</div><br />";
					}
				echo "</div>";
				echo "<div style='float:left; width:200px; margin-bottom:10px;'>";
					echo	"<table class='dark' style='width:100%;'>";
						echo "<tr valign='middle'>";
							echo "<th valign='middle' style='width:200px'>RGN</th>";				
						echo "</tr>";
					echo "</table>";
					foreach ($ad_ref_array['RGN'] as $rgn) {
						$count = 0;
						foreach ($signup_ref_array as $row) {
							if ($row['RGN'] == $rgn) {
								$count++;
							}
						}
						if ($rgn == "") {
							$rgn = "NA";
						}						
						echo "<div style='float:left; width:70%;'>";
							echo $rgn;
						echo "</div>";
						echo "<div style='float:left; width:30%;'>";						
							echo "= ".$count;
						echo "</div><br />";
					}
				echo "</div>";
			echo "</div><br />";
			
			echo "<div style='float:left; width:600px; margin-bottom:10px;'>";				
				echo "<div style='float:left; width:200px; margin-bottom:10px;'>";
				echo	"<table class='dark' style='width:100%;'>";
					echo "<tr valign='middle'>";
						echo "<th valign='middle' style='width:200px'>STE</th>";				
					echo "</tr>";
				echo "</table>";

					foreach ($ad_ref_array['STE'] as $ste) {
						$count = 0;
						foreach ($signup_ref_array as $row) {
							if ($row['STE'] == $ste) {
								$count++;
							}
						}
						if ($ste == "") {
							$ste = "NA";
						}						
						echo "<div style='float:left; width:70%;'>";
							echo $ste;
						echo "</div>";
						echo "<div style='float:left; width:30%;'>";						
							echo "= ".$count;
						echo "</div><br />";
					}
				echo "</div>";
								
				echo "<div style='float:left; width:200px; margin-bottom:10px;'>";
					echo	"<table class='dark' style='width:100%;'>";
						echo "<tr valign='middle'>";
							echo "<th valign='middle' style='width:200px'>DMG</th>";				
						echo "</tr>";
					echo "</table>";
					foreach ($ad_ref_array['DMG'] as $dmg) {
						$count = 0;
						foreach ($signup_ref_array as $row) {
							if ($row['DMG'] == $dmg) {
								$count++;
							}
						}
						if ($dmg == "") {
							$dmg = "NA";
						}						
						
						echo "<div style='float:left; width:70%;'>";
							echo $dmg;
						echo "</div>";
						echo "<div style='float:left; width:30%;'>";						
							echo "= ".$count;
						echo "</div><br />";
					}
				echo "</div>";

				echo "<div style='float:left; width:200px; margin-bottom:10px;'>";
					echo	"<table class='dark' style='width:100%;'>";
						echo "<tr valign='middle'>";
							echo "<th valign='middle' style='width:200px'>AD</th>";				
						echo "</tr>";
					echo "</table>";
					foreach ($ad_ref_array['AD'] as $ad) {
						$count = 0;
						foreach ($signup_ref_array as $row) {
							if ($row['AD'] == $ad) {
								$count++;
							}
						}
						if ($ad == "") {
							$ad = "NA";
						}						
						echo "<div style='float:left; width:70%;'>";
							echo $ad;
						echo "</div>";
						echo "<div style='float:left; width:30%;'>";						
							echo "= ".$count;
						echo "</div><br />";
					}
				echo "</div>";
			echo "</div><br />";
			
			echo "<div style='float:left; width:600px; margin-bottom:10px;'>";
				echo "<div style='float:left; width:200px; margin-bottom:10px;'>";
					echo	"<table class='dark' style='width:100%;'>";
						echo "<tr valign='middle'>";
							echo "<th valign='middle' style='width:200px'>MSCA</th>";				
						echo "</tr>";
					echo "</table>";
					foreach ($ad_ref_array['MSCA'] as $msca) {
						$count = 0;
						foreach ($signup_ref_array as $row) {
							if ($row['MSCA'] == $msca) {
								$count++;
							}
						}
						if ($msca == "") {
							$msca = "NA";
						}
						
						echo "<div style='float:left; width:70%;'>";
							echo $msca;
						echo "</div>";
						echo "<div style='float:left; width:30%;'>";						
							echo "= ".$count;
						echo "</div><br />";
					}
				echo "</div>";

				echo "<div style='float:left; width:200px; margin-bottom:10px;'>";
					echo	"<table class='dark' style='width:100%;'>";
						echo "<tr valign='middle'>";
							echo "<th valign='middle' style='width:200px'>MSCB</th>";				
						echo "</tr>";
					echo "</table>";
					foreach ($ad_ref_array['MSCB'] as $mscb) {
						$count = 0;
						foreach ($signup_ref_array as $row) {
							if ($row['MSCB'] == $mscb) {
								$count++;
							}
						}
						if ($mscb == "") {
							$mscb = "NA";
						}
						
						echo "<div style='float:left; width:70%;'>";
							echo $mscb;
						echo "</div>";
						echo "<div style='float:left; width:30%;'>";						
							echo "= ".$count;
						echo "</div><br />";
					}
				echo "</div>";
			echo "</div>";
			echo "</div>";
		
		echo "&nbsp; <br />";
		echo "<h2>Specific Ads</h2>";
			echo	"<table class='dark' style='width:700px;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle' style='width:65px'>Count</th>";				
				echo "<th valign='middle' style='width:65px'>refID</th>";				
				echo "<th valign='middle' style='width:65px'>CMP</th>";
				echo "<th valign='middle' style='width:65px'>RGN</th>";				
				echo "<th valign='middle' style='width:65px'>DMG</th>";				
				echo "<th valign='middle' style='width:65px'>STE</th>";				
				echo "<th valign='middle' style='width:65px'>AD</th>";				
				echo "<th valign='middle' style='width:65px'>MSCA</th>";
				echo "<th valign='middle' style='width:65px'>MSCB</th>";
			echo "</tr>";			

			//loop there specific ad combos and count the dupes
			//create duplicate array for testing
			$test_array = $ad_ref_array['ref_array'];
			foreach($test_array as $key=>$row) {
				unset($test_array[$key]['userID']);
				unset($test_array[$key]['ID']);
			}

			$test_array = array_map("unserialize", array_unique(array_map("serialize", $test_array)));
			
			foreach($test_array as $key=>$row) {
				$count = 0;
				foreach ($ad_ref_array['ref_array'] as $ad) {
					if ($ad['refID'] == $row['refID'] && $ad['CMP'] == $row['CMP']
						&& $ad['RGN'] == $row['RGN'] && $ad['STE'] == $row['STE']
						&& $ad['DMG'] == $row['DMG'] && $ad['AD'] == $row['AD']
						&& $ad['MSCA'] == $row['MSCA'] && $ad['MSCB'] == $row['MSCB']) {
						$count++;	
					}
				}
				echo "<tr>";
					echo "<td>".$count."</td>";
					echo "<td>".$row['refID']."</td>";
					echo "<td>".$row['CMP']."</td>";
					echo "<td>".$row['RGN']."</td>";
					echo "<td>".$row['STE']."</td>";
					echo "<td>".$row['DMG']."</td>";
					echo "<td>".$row['AD']."</td>";
					echo "<td>".$row['MSCA']."</td>";
					echo "<td>".$row['MSCB']."</td>";				
				echo "</tr>";
			}
			echo "</table>";

			} else {
				echo "DATA NOT AVAILABLE";
			}										
			echo "</div>";			
		echo "</div>";	
		
		echo "&nbsp;<br />";
		echo "<h2>EMPLOYEE TYPES</h2>";
			echo	"<table class='dark' style='width:700px;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle' style='width:100px'>Date</th>";				
				echo "<th valign='middle' style='width:100px'>Server</th>";
				echo "<th valign='middle' style='width:100px'>Bartender</th>";				
				echo "<th valign='middle' style='width:100px'>Kitchen</th>";				
				echo "<th valign='middle' style='width:100px'>Manager</th>";				
				echo "<th valign='middle' style='width:100px'>Host</th>";
				echo "<th valign='middle' style='width:100px'>Bus</th>";
				echo "</tr>";			
				echo "<tr>";
					echo "<td style='width:100px'>New</td>";
					echo "<td style='width:100px'>".$employee_types['new']['Server']."</td>";
					echo "<td style='width:100px'>".$employee_types['new']['Bartender']."</td>";
					echo "<td style='width:100px'>".$employee_types['new']['Kitchen']."</td>";
					echo "<td style='width:100px'>".$employee_types['new']['Manager']."</td>";
					echo "<td style='width:100px'>".$employee_types['new']['Host']."</td>";
					echo "<td style='width:100px'>".$employee_types['new']['Bus']."</td>";
				echo "</tr>";
				
				if ($type == "day") {
					echo "<tr>";
						echo "<td style='width:150px'>Yesterday</td>";
						echo "<td style='width:150px'>".$employee_types['day']['Server']."</td>";
						echo "<td style='width:150px'>".$employee_types['day']['Bartender']."</td>";
						echo "<td style='width:150px'>".$employee_types['day']['Kitchen']."</td>";
						echo "<td style='width:150px'>".$employee_types['day']['Manager']."</td>";
						echo "<td style='width:150px'>".$employee_types['day']['Host']."</td>";
						echo "<td style='width:150px'>".$employee_types['day']['Bus']."</td>";
					echo "</tr>";					
				}
				
				if ($type == "week") {
					echo "<tr>";
						echo "<td style='width:150px'>Last Week</td>";
						echo "<td style='width:150px'>".$employee_types['week']['Server']."</td>";
						echo "<td style='width:150px'>".$employee_types['week']['Bartender']."</td>";
						echo "<td style='width:150px'>".$employee_types['week']['Kitchen']."</td>";
						echo "<td style='width:150px'>".$employee_types['week']['Manager']."</td>";
						echo "<td style='width:150px'>".$employee_types['week']['Host']."</td>";
						echo "<td style='width:150px'>".$employee_types['week']['Bus']."</td>";
					echo "</tr>";					
				}
				
				echo "<tr>";
					echo "<td style='width:150px'>Last Month</td>";
					echo "<td style='width:150px'>".$employee_types['month']['Server']."</td>";
					echo "<td style='width:150px'>".$employee_types['month']['Bartender']."</td>";
					echo "<td style='width:150px'>".$employee_types['month']['Kitchen']."</td>";
					echo "<td style='width:150px'>".$employee_types['month']['Manager']."</td>";
					echo "<td style='width:150px'>".$employee_types['month']['Host']."</td>";
					echo "<td style='width:150px'>".$employee_types['month']['Bus']."</td>";
				echo "</tr>";

				echo "<tr>";
					echo "<td style='width:150px'>Last Year</td>";
					echo "<td style='width:150px'>".$employee_types['year']['Server']."</td>";
					echo "<td style='width:150px'>".$employee_types['year']['Bartender']."</td>";
					echo "<td style='width:150px'>".$employee_types['year']['Kitchen']."</td>";
					echo "<td style='width:150px'>".$employee_types['year']['Manager']."</td>";
					echo "<td style='width:150px'>".$employee_types['year']['Host']."</td>";
					echo "<td style='width:150px'>".$employee_types['year']['Bus']."</td>";
				echo "</tr>";				
			echo 	"</table>";
				
		echo "&nbsp;<br />";
		echo "<h3>JOB TYPES*</h3>";
			echo	"<table class='dark' style='width:700px;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle' style='width:100px'>Date</th>";				
				echo "<th valign='middle' style='width:100px'>Server</th>";
				echo "<th valign='middle' style='width:100px'>Bartender</th>";				
				echo "<th valign='middle' style='width:100px'>Kitchen</th>";				
				echo "<th valign='middle' style='width:100px'>Manager</th>";				
				echo "<th valign='middle' style='width:100px'>Host</th>";
				echo "<th valign='middle' style='width:100px'>Bus</th>";
				echo "</tr>";			
				echo "<tr>";
					echo "<td style='width:100px'>New</td>";
					echo "<td align='center' style='width:100px'>".$job_types['new']['Server']['count']."<br />".$job_types['new']['Server']['average']['avg_views']." / ".$job_types['new']['Server']['average']['avg_responses']."</td>";
					echo "<td align='center' style='width:100px'>".$job_types['new']['Bartender']['count']."<br />".$job_types['new']['Bartender']['average']['avg_views']."/".$job_types['new']['Bartender']['average']['avg_responses']."</td>";
					echo "<td align='center' style='width:100px'>".$job_types['new']['Kitchen']['count']."<br />".$job_types['new']['Kitchen']['average']['avg_views']."/".$job_types['new']['Kitchen']['average']['avg_responses']."</td>";
					echo "<td align='center' style='width:100px'>".$job_types['new']['Manager']['count']."<br />".$job_types['new']['Manager']['average']['avg_views']."/".$job_types['new']['Manager']['average']['avg_responses']."</td>";
					echo "<td align='center' style='width:100px'>".$job_types['new']['Host']['count']."<br />".$job_types['new']['Host']['average']['avg_views']."/".$job_types['new']['Host']['average']['avg_responses']."</td>";
					echo "<td align='center' style='width:100px'>".$job_types['new']['Bus']['count']."<br />".$job_types['new']['Bus']['average']['avg_views']."/".$job_types['new']['Bus']['average']['avg_responses']."</td>";
				echo "</tr>";
				
				if ($type == "day") {
					echo "<tr>";
						echo "<td style='width:150px'>Yesterday</td>";
						echo "<td align='center' style='width:100px'>".$job_types['day']['Server']['count']."<br />".$job_types['day']['Server']['average']['avg_views']."/".$job_types['day']['Server']['average']['avg_responses']."</td>";
						echo "<td align='center' style='width:100px'>".$job_types['day']['Bartender']['count']."<br />".$job_types['day']['Bartender']['average']['avg_views']."/".$job_types['day']['Bartender']['average']['avg_responses']."</td>";
						echo "<td align='center' style='width:100px'>".$job_types['day']['Kitchen']['count']."<br />".$job_types['day']['Kitchen']['average']['avg_views']."/".$job_types['day']['Kitchen']['average']['avg_responses']."</td>";
						echo "<td align='center' style='width:100px'>".$job_types['day']['Manager']['count']."<br />".$job_types['day']['Manager']['average']['avg_views']."/".$job_types['day']['Manager']['average']['avg_responses']."</td>";
						echo "<td align='center' style='width:100px'>".$job_types['day']['Host']['count']."<br />".$job_types['day']['Host']['average']['avg_views']."/".$job_types['day']['Host']['average']['avg_responses']."</td>";
						echo "<td align='center' style='width:100px'>".$job_types['day']['Bus']['count']."<br />".$job_types['day']['Bus']['average']['avg_views']."/".$job_types['day']['Bus']['average']['avg_responses']."</td>";
					echo "</tr>";					
				}
				
				if ($type == "week") {
					echo "<tr>";
						echo "<td style='width:150px'>Last Week</td>";
						echo "<td align='center' style='width:100px'>".$job_types['week']['Server']['count']."<br />".$job_types['week']['Server']['average']['avg_views']."/".$job_types['week']['Server']['average']['avg_responses']."</td>";
						echo "<td align='center' style='width:100px'>".$job_types['week']['Bartender']['count']."<br />".$job_types['week']['Bartender']['average']['avg_views']."/".$job_types['week']['Bartender']['average']['avg_responses']."</td>";
						echo "<td align='center' style='width:100px'>".$job_types['week']['Kitchen']['count']."<br />".$job_types['week']['Kitchen']['average']['avg_views']."/".$job_types['week']['Kitchen']['average']['avg_responses']."</td>";
						echo "<td align='center' style='width:100px'>".$job_types['week']['Manager']['count']."<br />".$job_types['week']['Manager']['average']['avg_views']."/".$job_types['week']['Manager']['average']['avg_responses']."</td>";
						echo "<td align='center' style='width:100px'>".$job_types['week']['Host']['count']."<br />".$job_types['week']['Host']['average']['avg_views']."/".$job_types['week']['Host']['average']['avg_responses']."</td>";
						echo "<td align='center' style='width:100px'>".$job_types['week']['Bus']['count']."<br />".$job_types['week']['Bus']['average']['avg_views']."/".$job_types['week']['Bus']['average']['avg_responses']."</td>";
					echo "</tr>";					
				}
				
				echo "<tr>";
					echo "<td style='width:150px'>Last Month</td>";
						echo "<td align='center' style='width:100px'>".$job_types['month']['Server']['count']."<br />".$job_types['month']['Server']['average']['avg_views']."/".$job_types['month']['Server']['average']['avg_responses']."</td>";
						echo "<td align='center' style='width:100px'>".$job_types['month']['Bartender']['count']."<br />".$job_types['month']['Bartender']['average']['avg_views']."/".$job_types['month']['Bartender']['average']['avg_responses']."</td>";
						echo "<td align='center' style='width:100px'>".$job_types['month']['Kitchen']['count']."<br />".$job_types['month']['Kitchen']['average']['avg_views']."/".$job_types['month']['Kitchen']['average']['avg_responses']."</td>";
						echo "<td align='center' style='width:100px'>".$job_types['month']['Manager']['count']."<br />".$job_types['month']['Manager']['average']['avg_views']."/".$job_types['month']['Manager']['average']['avg_responses']."</td>";
						echo "<td align='center' style='width:100px'>".$job_types['month']['Host']['count']."<br />".$job_types['month']['Host']['average']['avg_views']."/".$job_types['month']['Host']['average']['avg_responses']."</td>";
						echo "<td align='center' style='width:100px'>".$job_types['month']['Bus']['count']."<br />".$job_types['month']['Bus']['average']['avg_views']."/".$job_types['month']['Bus']['average']['avg_responses']."</td>";
				echo "</tr>";

				echo "<tr>";
					echo "<td style='width:150px'>Last Year</td>";
						echo "<td align='center' style='width:100px'>".$job_types['year']['Server']['count']."<br />".$job_types['year']['Server']['average']['avg_views']."/".$job_types['year']['Server']['average']['avg_responses']."</td>";
						echo "<td align='center' style='width:100px'>".$job_types['year']['Bartender']['count']."<br />".$job_types['year']['Bartender']['average']['avg_views']."/".$job_types['year']['Bartender']['average']['avg_responses']."</td>";
						echo "<td align='center' style='width:100px'>".$job_types['year']['Kitchen']['count']."<br />".$job_types['year']['Kitchen']['average']['avg_views']."/".$job_types['year']['Kitchen']['average']['avg_responses']."</td>";
						echo "<td align='center' style='width:100px'>".$job_types['year']['Manager']['count']."<br />".$job_types['year']['Manager']['average']['avg_views']."/".$job_types['year']['Manager']['average']['avg_responses']."</td>";
						echo "<td align='center' style='width:100px'>".$job_types['year']['Host']['count']."<br />".$job_types['year']['Host']['average']['avg_views']."/".$job_types['year']['Host']['average']['avg_responses']."</td>";
						echo "<td align='center' style='width:100px'>".$job_types['year']['Bus']['count']."<br />".$job_types['year']['Bus']['average']['avg_views']."/".$job_types['year']['Bus']['average']['avg_responses']."</td>";
				echo "</tr>";				
			echo 	"</table>";	
			echo "*# of Jobs (Avg Views / Avg Responses)";																					
	}
	
	function site_totals_html($total_array) {
		echo "<div class='container'>";
			echo "<h1>Site Stats</h1>";

			echo "<a href='admin_stats.php?page=site_totals&region=all' class='btn btn-primary'>All</a>  ";
			echo "<a href='admin_stats.php?page=site_totals&region=orlando' class='btn btn-primary'>Orlando</a>  ";
			echo "<a href='admin_stats.php?page=site_totals&region=tampa' class='btn btn-primary'>Tampa</a> ";
			echo "<a href='admin_stats.php?page=site_totals&region=jacksonville' class='btn btn-primary'>Jacksonville</a> ";
			echo "<a href='admin_stats.php?page=site_totals&region=miami' class='btn btn-primary'>Miami</a><br /> ";
			echo "&nbsp; <br />";
			echo "<a href='admin_stats.php?page=site_totals&region=charlotte' class='btn btn-primary'>Charlotte</a> ";
			echo "<a href='admin_stats.php?page=site_totals&region=triangle' class='btn btn-primary'>Triangle</a> ";
			echo "<a href='admin_stats.php?page=site_totals&type=&region=austin' class='btn btn-primary'>Austin</a> ";
			echo "<a href='admin_stats.php?page=site_totals&type=&region=charleston' class='btn btn-primary'>Charleston</a> ";
			echo "<a href='admin_stats.php?page=site_totals&type=&region=nashville' class='btn btn-primary'>Nashville</a><br />";

			echo "&nbsp; <br />";
			echo "&nbsp; <br />";

			echo "<div id='title_holder' style='width:100%; margin-top:-10px; float:left; padding-left:10px; font-size:1.125em;'>";
				echo "<h2>Site Totals Summary - Region: ".$_GET['region']."</h2>";
			echo "</div><br />";
			
			echo "Total Members: ".$total_array['total']."<br />";
			echo "Employees: ".$total_array['employee']."<br />";
			echo "Employers: ".$total_array['employer']."<br />";
			echo "Stores: ".$total_array['store']."<br />";
			echo "Unverified: ".$total_array['non_verified']."<br />";
			echo "Incomplete: ".$total_array['incomplete']."<br />";	
			
		echo "</div>";		
	}
	
	function new_jobs_html($new_jobs_array) {
		echo "<div class='container'>";
			echo "<h1>New Jobs (Last 7 days)</h1>";

			echo "&nbsp; <br />";
			echo "&nbsp; <br />";
			foreach ($new_jobs_array as $row) {			
				echo "<h3>".$row['title']."</h3>";
				echo "<b>Store:</b> ".$row['name']."<br />";
				echo "<b>Address:</b> ".$row['address']."<br />";
				echo "<b>Zip:</b> ".$row['zip']."<br />";
				echo "<b>Employer Name:</b> ".$row['firstname']." ".$row['lastname']."<br />";
				echo "<b>Email:</b> ".$row['email']."<br />";
				echo "<b>Facebook:</b> ".$row['facebook']."<br />";	
				echo "<b>Twitter:</b> ".$row['twitter']."<br />";	
				echo "<b>Public Link:</b> http://servebartendcook.com/public_listing_new.php?ID=".$row['jobID']."&ref=".$row['public_hash']."<br />";
				echo "&nbsp; <br />";
			}
			
		echo "</div>";		
	}
	
	function store_by_region_html($store_array) {
		echo "<div class='container'>";
			echo "<h1>Pavement Stats</h1>";
			echo "&nbsp; <br />";
			echo "Zip Code: <input type='text' id='zip' length='5'> &nbsp; <a href='#' id='submit_zip'>Submit</a><br />";
			echo "&nbsp; <br />";
			if (count($store_array) > 0) {
				$database = new Database;
				
				foreach ($store_array as $row) {	
					//get the last job posted
					//not efficient, but does the trick
					$database->query("SELECT date_created, title FROM jobs
												WHERE storeID = :storeID
												AND job_status = :job_status 
												ORDER BY date_created DESC LIMIT 1");																												
					$database->bind(':storeID', $row['storeID']);	
					$database->bind(':job_status', 'open');									
					$job_array = $database->resultset();	
							
					echo "<h3>".$row['name']."</h3>";
					echo "<b>Address:</b> ".$row['address']."<br />";
					echo "<b>Employer Name:</b> ".$row['firstname']." ".$row['lastname']."<br />";
					echo "<b>Last Job Posted:</b> ";
					if (count($job_array) > 0) {
						foreach ($job_array as $job) {
							echo $job['title']." - ".$job['date_created']."<br />";
						}
					} else {
						echo "NA";
					}
					echo "&nbsp; <br />";
				}
			} else {
				echo "<b>No Stores</b>";
			}
			
		echo "</div>";
		
?>
<script>
		$(document).on("click", '#submit_zip', function() {	
			zip = $("#zip").val();
			
			if (isNaN(zip)) {
				alert("Invalid Zip Code");
			} else {
				window.location = 	"admin_stats.php?page=stores_region&zip=" + zip;	
			}
					
			return false;
		});		
</script>
<?php		
				
	}	
	
	function pavement_stats_html($pavement_list, $login_data, $job_data, $job_count) {
		//get counts
		$total_pavement_signups = count($pavement_list);
		
		$inactive_count = 0;
		$inactive_jobs = 0;
		
		foreach ($pavement_list as $row) {
			if ($row['changed'] != "Y") {
				$inactive_count++;
				if (count($job_data[$row['userID']]) > 0) {
					$inactive_jobs++;
				}
			} elseif (count($job_data[$row['userID']]) == 0) {
				$inactive_count++;
			}
		}
				
		$active_count = $total_pavement_signups - $inactive_count;
		
		$percent_active = ($active_count / $total_pavement_signups) * 100;
		$percent_active = round($percent_active, 2);
		
		echo "<div class='container'>";
			echo "<h1>Pavement Stats</h1>";
			echo "&nbsp; <br />";
			echo "<h4>Total Pavement Sign-ups: ".$total_pavement_signups."</h4>";
			echo "<h4>Active Pavement Employers: ".$active_count."</h4>";
			echo "<h4>Inactive Pavement Employers: ".$inactive_count."</h4>";
			echo "<h4>Percent Active: ".$percent_active."%</h4>";
			echo "<h4>Pavement Jobs: ".$job_count."</h4>";
			echo "<h4>Inactive Jobs: ".$inactive_jobs."</h4>";
			echo "<i>Inactive employers have never logged in or never posted a job</i><br/>";
			echo "<i>Inactive jobs are jobs that were posted during pavement sign-up, but they employer never logged in to view results.</i><br/>";
			echo "&nbsp; <br />";
			
			foreach($pavement_list as $row) {
				$login_count = $login_data[$row['userID']];
				
				if ($row['changed'] == "Y") {
					$active = "Y";
					$login_count = $login_count;
					if (count($job_data[$row['userID']]) == 0) {
						$color = "red";
					} else {
						$color = "green";
					}
				} else {
					$active = "N";
					$login_count = "NA";
					$color = "red";
				}
				
				$user_job_count = count($job_data[$row['userID']]);
				
				echo "<font color='$color'><b>Name:</b> ".$row['firstname']." ".$row['lastname']." (".$row['email'].")</font><br />";
				echo "<b>Company: </b>".$row['company']."<br />";
				echo "<b>Active: </b>".$active."<br />";
				echo "<b>Logins: </b>".$login_count."<br />";
				echo "<b>Job Count: </b>".$user_job_count."<br />";
				echo "Reference:  ".$row['userID']." | ".$row['creation_date']."<br />";
				echo "&nbsp; <br />";
				echo "&nbsp; <br />";				
			}
		echo "</div>";
	}						
	
	function email_stats() {
		echo "<h4>Email Stats</h4>";
		echo "Warning:  Only available on prototype<br />";
		
		echo "&nbsp; <br />";
		echo "<b>Key: &nbsp; </b> <input type='text' id='email_key'></input><br />";
		echo "<a href='#' id='run_stats'>Run Stats</a><br />";
		
		echo "<div id='email_stats_holder'></div>";
		
?>
<script>
		$(document).on("click", '#run_stats', function() {	
			city = $("#email_key").val();

			dataString = "email_key=" + city;
			$.ajax({
				type: "POST",
				url: "admin_stats.php?page=email_stats_ajax",
				data: dataString,
				success: function(data) {
					alert(data);
					$("#email_stats_holder").replaceWith(data);
				}
			});					
			return false;
		});		
</script>
<?php		
		
	}
	
	function pavement_menu_html($list_array) {
		echo "<h4>Current Lists</h4>";
		echo "<hr><br />";
		
		if (count($list_array) > 0) {
			foreach($list_array as $row) {
				echo "<a href='admin_stats.php?page=pavement_list&type=list&regionID=".$row['regionID']."'>".$row['city']." - ".$row['region']."</a><br />";
			}
		} else {
			echo "<i>No current lists.</i>";			
		}
		
		echo "&nbsp; <br />";
		echo "&nbsp; <br />";
		echo "&nbsp; <br />";
		echo "<hr><br />";
		echo "<h4>Create New List</h4>";
		
		echo "<b>City: </b><input type='text' id='city'><br />";
		echo "<b>Region: </b><input type='text' id='region'><br />";
		echo "&nbsp; <br />";
		echo "<a href='#' class='btn btn-large btn-primary' id='add_list'>Save</a>";								
		
?>
<script>
		$(document).on("click", '#add_list', function() {	
			city = $("#city").val();
			region = $("#region").val();

			dataString = "city=" + city + "&region=" + region;
			$.ajax({
				type: "POST",
				url: "admin_stats.php?page=pavement_ajax&type=add_list",
				data: dataString,
				success: function(data) {
					//alert(data);
					window.location.reload();
				}
			});					
			return false;
		});		
</script>
<?php		
		
	}
	
	function pavement_view_list_html($list_details) {
		$utilities = new Utilities;
		$store_types = $utilities->store_types;

		echo "<h2>".$list_details['city']." - ".$list_details['region']."</h2>";
		echo "<b>Click an entry to Edit.  Add an entry at bottom of page.</b><br />";
		echo "&nbsp; <br />";
		echo "<a href='#' id='".$list_details['regionID']."' class='btn btn-primary close_list'>Remove List</a>";
		echo "&nbsp; <br />";
		echo "&nbsp; <br />";
		echo "<hr><br />";

		foreach($list_details['list_array'] as $row) {
			if ($row['open'] == 'N') {
				$complete = "<font color='red'>COMPLETE</font> - ";
			}  else {
				$complete = "";
			}

			echo "<h4 style='margin-top:0px;'>".$complete."<a href='admin_stats.php?page=pavement_list&type=view_store&storeID=".$row['storeID']."'>".$row['name']."</a></h4><br />";
		}
		
		echo "<hr><br />";
		echo "<h3>New Entry</h3>";
		
		echo "<div class='add_store_form'>";		
			echo "<div style='width:100%; float:left'>";
				echo "<div id='store_empty_warning' style='display:none'><font color='red'><b>ALL REQUIRED FIELDS MUST BE COMPLETED.</b></font></div>";
				echo "<div id='store_zip_warning' style='display:none'><font color='red'><b>PLEASE ENTER A VALID ZIP CODE.</b></font></div>";
			
				echo "<div style='width:50%; margin-right:10px; float:left;'>";
					echo "<h4 style='text-align:center; color:#760006;'>Required Information</h4>";
					echo "<table style='color:#760006; width:100%'>";
						echo "<tr>";
							echo "<td><b>Store Name: &nbsp; </b></td>";
							echo "<td><input type='text' id='store_name'></input></div></td>";
						echo "</tr>";
							echo "<td><b>Street Address: &nbsp;</b></td>";
							echo "<td><input type='text' id='address'></input></td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td><b>Zip Code: &nbsp; </b></td>";
							echo "<td><input type='text' id='zip'></input></td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td><b>Business Type: &nbsp; </b></td>";
							echo "<td><select id='description' style='background-color:#b76163;'>";
								foreach ($store_types as $type) {
									echo "<option value='".$type."'>".$type."</option>";
								}
							echo "</select></td>";
						echo "</tr>";
					echo "</table>";
				echo "</div>";

				echo "<div style='width:40%; float:left;'>";
					echo "<h4 style='text-align:center; color:#760006;'>Optional Information</h4>";
					echo "<table style='color:#760006; width:100%'>";					
						echo "<tr>";
							echo "<td><b>Website: &nbsp;</b></td>"; 
							echo "<td><input type='text' id='website'></input></td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td><b>Facebook: &nbsp;</b></td>"; 
							echo "<td><input type='text' id='facebook'></input></td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td><b>Twitter: &nbsp;</b></td>"; 
							echo "<td><input type='text' id='twitter'></input></td>";
						echo "</tr>";									
					echo "</table>";
				echo "</div>";
				echo "<input type='hidden' id='regionID' value='".$_GET['regionID']."'>";
			echo "<div style='float:left; margin-top:35px; width:100%'><a href='#' class='btn btn-large btn-primary' id='add_store'>Save</a></div>	";								
		echo "</div>";
?>		
<script>
		$(document).on("click", '#add_store', function() {	
			store_name = encodeURIComponent($("#store_name").val().trim());
			address = encodeURIComponent($("#address").val().trim());
			zip = encodeURIComponent($("#zip").val().trim());
			description = encodeURIComponent($("#description").val().trim());
			website = encodeURIComponent($("#website").val().trim());
			facebook = encodeURIComponent($("#facebook").val().trim());
			twitter = encodeURIComponent($("#twitter").val().trim());
			regionID = encodeURIComponent($("#regionID").val().trim());
			
			if (store_name.length == 0 || address.length == 0 || zip.length == 0) {
				$('#store_empty_warning').show();
			} else if (isNaN(zip) == true || zip.length != 5) {
				$('#store_zip_warning').show();
			} else {	
				dataString = "store_name=" + store_name + "&address=" + address + "&zip=" + zip + "&description=" + description +
									"&website=" + website + "&facebook=" + facebook + "&twitter=" + twitter + "&regionID=" + regionID;
				//alert(dataString);
				$.ajax({
					type: "POST",
					url: "admin_stats.php?page=pavement_ajax&type=add_store",
					data: dataString,
					success: function(data) {
						//alert(data);
						window.location.reload();
					}
				});	
			}				
			return false;
		});		
		
		$(document).on("click", '.close_list', function() {	
			regionID = <?php echo $_GET['regionID'] ?>;

			dataString = "regionID=" + regionID;
			$.ajax({
				type: "POST",
				url: "admin_stats.php?page=pavement_ajax&type=close_list",
				data: dataString,
				success: function(data) {
					//alert(data);
					window.location = 'admin_stats.php?page=pavement_list&type=menu';
				}
			});					
			return false;
		});		
		
</script>
<?php			
	} 

	function pavement_edit_html($details) {
		$utilities = new Utilities;
		$store_types = $utilities->store_types;

		if ($details['open'] == 'N') {
			echo "Employer Signed-up - Cannot Edit<br />";
		} else {
			echo "<h3>Edit Entry</h3>";
			
			echo "<a href='#' id='delete'>Delete Entry</a><br />";
			
			echo "<div class='add_store_form'>";		
				echo "<div style='width:100%; float:left'>";
					echo "<div id='store_empty_warning' style='display:none'><font color='red'><b>ALL REQUIRED FIELDS MUST BE COMPLETED.</b></font></div>";
					echo "<div id='store_zip_warning' style='display:none'><font color='red'><b>PLEASE ENTER A VALID ZIP CODE.</b></font></div>";
		
					echo "<div style='width:50%; margin-right:10px; float:left;'>";
						echo "<h4 style='text-align:center; color:#760006;'>Required Information</h4>";
						echo "<table style='color:#760006; width:100%'>";
							echo "<tr>";
								echo "<td><b>Store Name: &nbsp; </b></td>";
								echo "<td><input type='text' id='store_name' value='".$details['name']."'></input></div></td>";
							echo "</tr>";
								echo "<td><b>Street Address: &nbsp;</b></td>";
								echo "<td><input type='text' id='address' value='".$details['address']."'></input></td>";
							echo "</tr>";
							echo "<tr>";
								echo "<td><b>Zip Code: &nbsp; </b></td>";
								echo "<td><input type='text' id='zip' value='".$details['zip']."'></input></td>";
							echo "</tr>";
							echo "<tr>";
								echo "<td><b>Business Type: &nbsp; </b></td>";
								echo "<td><select id='description' style='background-color:#b76163;'>";
									foreach ($store_types as $type) {
										$selected = "";						
										if ($type == $details['description']) {
											$selected = "selected";
										} 
										echo "<option value='".$type."' $selected >".$type."</option>";
									}
								echo "</select></td>";
							echo "</tr>";
						echo "</table>";
					echo "</div>";
	
					echo "<div style='width:40%; float:left;'>";
						echo "<h4 style='text-align:center; color:#760006;'>Optional Information</h4>";
						echo "<table style='color:#760006; width:100%'>";					
							echo "<tr>";
								echo "<td><b>Website: &nbsp;</b></td>"; 
								echo "<td><input type='text' id='website' value='".$details['website']."'></input></td>";
							echo "</tr>";
							echo "<tr>";
								echo "<td><b>Facebook: &nbsp;</b></td>"; 
								echo "<td><input type='text' id='facebook' value='".$details['facebook']."'></input></td>";
							echo "</tr>";
							echo "<tr>";
								echo "<td><b>Twitter: &nbsp;</b></td>"; 
								echo "<td><input type='text' id='twitter' value='".$details['twitter']."'></input></td>";
							echo "</tr>";									
						echo "</table>";
					echo "</div>";
					echo "<input type='hidden' id='storeID' value='".$details['storeID']."'></input>";
					echo "<input type='hidden' id='regionID' value='".$details['regionID']."'></input>";
	
				echo "<div style='float:left; margin-top:35px; width:100%'><a href='#' class='btn btn-large btn-primary' id='edit_store'>Save</a></div>	";								
			echo "</div>";	
		}
?>		
<script>
		$(document).on("click", '#edit_store', function() {
			storeID = $("#storeID").val();
			store_name = encodeURIComponent($("#store_name").val().trim());
			address = encodeURIComponent($("#address").val().trim());
			zip = encodeURIComponent($("#zip").val().trim());
			description = encodeURIComponent($("#description").val().trim());
			website = encodeURIComponent($("#website").val().trim());
			facebook = encodeURIComponent($("#facebook").val().trim());
			twitter = encodeURIComponent($("#twitter").val().trim());
			regionID = $("#regionID").val();
			
			if (store_name.length == 0 || address.length == 0 || zip.length == 0) {
				$('#store_empty_warning').show();
			} else if (isNaN(zip) == true || zip.length != 5) {
				$('#store_zip_warning').show();
			} else {	
				dataString = "storeID=" + storeID + "&store_name=" + store_name + "&address=" + address + "&zip=" + zip + "&description=" + description +
									"&website=" + website + "&facebook=" + facebook + "&twitter=" + twitter;
									//alert(dataString);
				$.ajax({
					type: "POST",
					url: "admin_stats.php?page=pavement_ajax&type=edit_store",
					data: dataString,
					success: function(data) {
						//alert(data);
						window.location = "admin_stats.php?page=pavement_list&type=list&regionID=" + regionID;
					}
				});	
			}				
			return false;
		});	
		
		$(document).on("click", '#delete', function() {
			storeID = $("#storeID").val();
			regionID = $("#regionID").val();

			dataString = "storeID=" + storeID;

			$.ajax({
				type: "POST",
				url: "admin_stats.php?page=pavement_ajax&type=delete_store",
				data: dataString,
				success: function(data) {
					//alert(data);
					window.location = "admin_stats.php?page=pavement_list&type=list&regionID=" + regionID;
				}
			});	
			return false;
		});		
			
</script>
<?php		
	} 
	
function six_month_list_html($email_list) {
	echo "<h3>Users that haven't logged in for 6-months</h3>";
	echo "<b>COUNT = ".count($email_list)."</b><br />";
	echo "&nbsp; <br />";
	
	foreach($email_list as $row) {
		echo $row['email']."<br />";
	}	
}

function employee_list_html($region, $user_list) {
	echo "<h3>Employee List - ".$region."</h3>";
	echo "&nbsp; <br />";
	
	echo "<table>";
		echo "<tr>";
			echo "<td>userID</td>";
			echo "<td align='center'>email</td>";
			echo "<td align='center'>firstname</td>";
			echo "<td align='center'>lastname</td>";
			echo "<td align='center'>zip</td>";
			echo "<td align='center'>type</td>";
			echo "<td align='center'>email_validation</td>";
			echo "<td align='center'>email_setting</td>";
			echo "<td align='center'>last_login</td>";
		echo "</tr>";
		
		foreach($user_list as $row) {
			echo "<tr>";
				echo "<td>".$row['userID']."</td>";
				echo "<td align='center'>".$row['email']."</td>";
				echo "<td align='center'>".$row['firstname']."</td>";
				echo "<td align='center'>".$row['lastname']."</td>";
				echo "<td align='center'>".$row['zip']."</td>";
				echo "<td align='center'>".$row['type']."</td>";
				echo "<td align='center'>".$row['email_validation']."</td>";
				echo "<td align='center'>".$row['email_setting']."</td>";
				echo "<td align='center'>".$row['last_login']."</td>";
			echo "</tr>";
		}		
	echo "</table>";
}

	
function employer_email_list_html($email_list) {
	echo "<h3>Employer List for MailChimp</h3>";
	echo "&nbsp; <br />";
	
	foreach($email_list as $row) {
		echo $row['email'].",".$row['firstname'].",".$row['lastname']."<br />";
	}	
}

function amazon_product_options() {
		echo "<div id='title_holder' style='width:100%; margin-top:-10px; float:left; padding-left:10px; font-size:1.125em;'>";
			echo "<h2>Amazon Product Options</h2>";
		echo "</div><br />";
		echo "&nbsp; <br />";
	
		echo "<a href='admin_stats.php?page=product_questions' class='btn btn-large btn-primary'>PRODUCT QUESTIONS</a><br />";
		echo "&nbsp; <br />";
		echo "&nbsp; <br />";
		echo "<a href='admin_stats.php?page=product_list' class='btn btn-large btn-primary'>PRODUCT LIST</a><br />";
		echo "&nbsp; <br />";
		echo "&nbsp; <br />";	
		echo "<a href='admin_stats.php?page=product_results' class='btn btn-large btn-primary'>PRODUCT RESULTS</a><br />";
		echo "&nbsp; <br />";
		echo "&nbsp; <br />";
}

function amazon_question_list($question_array) {
	echo "<div id='title_holder' style='width:100%; margin-top:-10px; float:left; padding-left:10px; font-size:1.125em;'>";
		echo "<h2>Amazon Product Questions</h2>";
	echo "</div><br />";
	echo "&nbsp; <br />";

	echo "<b>To remove a question, you must enter the Key first at the bottom of the list.</b><br />";
	echo "&nbsp; <br />";

	if (count($question_array) > 0) {
		foreach($question_array as $row) {
			if ($row['removed'] == 'Y') {
				$remove_text = "<font color='red'>QUESTION REMOVED</font>";
			} else {
				$remove_text = "<a href='#' class='remove_question' id='".$row['questionID']."'>Remove Question</a>";
			}
			echo "<a href='admin_stats.php?page=view_question&ID=".$row['questionID']."'>".$row['question']."</a> &nbsp; ".$remove_text."<br /> &nbsp; <br />";	
		}
		echo "Key: <input type='password' id='remove_question_key'>";		
	} else {
		echo "No Questions";
	}
	echo "&nbsp; <br />";
	echo "&nbsp; <br />";
	echo "<hr><br />";
	echo "<div id='title_holder' style='width:100%; margin-top:-10px; float:left; padding-left:10px; font-size:1.125em;'>";
		echo "<h2>Add Question</h2>";
	echo "</div><br />";
	
	echo "Question Text: <br />";
	echo "<textarea id='question_text' style='width:400px;'></textarea><br />";
	echo "&nbsp; <br />";
	
	echo "None of the Above Text: <br />";
	echo "<textarea id='no_answer' style='width:400px;'></textarea><br />";
	echo "&nbsp; <br />";
	
	echo "Question Type: ";
	echo "<select multiple id='question_type'>";
		echo "<option value='FOH'>FOH</option>";
		echo "<option value='BOH'>BOH</option>";
		echo "<option value='MGMT'>MGMT</option>";
	echo "</select>";
	echo "&nbsp; <br />";	
	echo "&nbsp; <br />";	

	echo "Key: <input type='password' id='new_question_key'>";
	echo " &nbsp; <a href='#' id='save_new_question'>Save New Question</a>";	
	
?>	
<script>
		$(document).on("click", '#save_new_question', function() {
			question_text = encodeURIComponent($("#question_text").val().trim());
			no_answer = encodeURIComponent($("#no_answer").val().trim());
			question_type = $("#question_type").val();
			new_question_key = $("#new_question_key").val();
			
			if (question_text.length == 0 || no_answer.length == 0) {
				$('#empty_warning').show();
			} else {
				dataString = "question_text=" + question_text + "&no_answer=" + no_answer + "&question_type=" + question_type + "&new_question_key=" + new_question_key;
				//alert(dataString);
				$.ajax({
					type: "POST",
					url: "admin_stats.php?page=amazon_ajax&type=add_new_question",
					data: dataString,
					success: function(data) {
						window.location = "admin_stats.php?page=view_question&ID=" + data;
					}
				});	
			}				
			return false;
		});	
		
		$(document).on("click", '.remove_question', function() {
			questionID = $(this).attr('ID');
			remove_question_key = $("#remove_question_key").val();
			
			dataString = "questionID=" + questionID + "&remove_question_key=" + remove_question_key;
			//alert(dataString);
			$.ajax({
				type: "POST",
				url: "admin_stats.php?page=amazon_ajax&type=remove_question",
				data: dataString,
				success: function(data) {
					//alert(data);
					window.location.reload();
				}
			});	
			return false;
		});							
</script>
<?php	
}	

function amazon_product_list($product_list) {
	echo "<div id='title_holder' style='width:100%; margin-top:-10px; float:left; padding-left:10px; font-size:1.125em;'>";
		echo "<h2>Amazon Products</h2>";
	echo "</div><br />";
	echo "&nbsp; <br />";
	if (count($product_list) > 0) {
		foreach($product_list as $row) {
			echo "<a href='admin_stats.php?page=view_product&ID=".$row['productID']."'>".$row['product']."</a> <br />";	
		}
	} else {
		echo "No Products";
	}
	
	echo "&nbsp; <br />";
	echo "<div id='title_holder' style='width:100%; margin-top:-10px; float:left; padding-left:10px; font-size:1.125em;'>";
		echo "<h2>Add Product</h2>";
	echo "</div><br />";
	
	echo "Product Name: <br />";
	echo "<textarea id='product_name' style='width:400px;'></textarea><br />";
	echo "&nbsp; <br />";
	
	echo "Text Link: <br />";
	echo "<textarea id='text_link' style='width:400px;'></textarea><br />";
	echo "&nbsp; <br />";
	
	echo "Image Link: <br />";
	echo "<textarea id='image_link' style='width:400px;'></textarea><br />";
	echo "&nbsp; <br />";
	
	echo "Key: <input type='password' id='add_product_key'>";
	echo "<a href='#' id='add_product'>Add Product</a>";
?>
<script>
		$(document).on("click", '#add_product', function() {
			product_name = encodeURIComponent($("#product_name").val().trim());
			text_link = encodeURIComponent($("#text_link").val().trim());
			image_link = encodeURIComponent($("#image_link").val().trim());
			add_product_key = $("#add_product_key").val();
			
			dataString = "product_name=" + product_name + "&text_link=" + text_link + "&image_link=" + image_link + "&add_product_key=" + add_product_key;
			//alert(dataString);
			$.ajax({
				type: "POST",
				url: "admin_stats.php?page=amazon_ajax&type=add_product",
				data: dataString,
				success: function(data) {
					//alert(data);
					window.location = 'admin_stats.php?page=view_product&ID=' + data;
				}
			});	
			return false;
		});							
</script>
<?php			
}

function amazon_question($question_data, $product_list) {
	$questionID = $question_data['question_info']['questionID'];
	$question = $question_data['question_info']['question'];
	$none_answer = $question_data['question_info']['none_text'];
	
	$FOH = $BOH = $MGMT = "";
	if (count($question_data['question_type']) > 0) {
		foreach($question_data['question_type'] as $row) {
			if ($row['type'] == "FOH") {
				$FOH = "selected";
			} 
			
			if ($row['type'] == "BOH") {
				$BOH = "selected";		
			} 
			
			if ($row['type'] == "MGMT"){
				$MGMT = "selected";		
			}
		}
	}

	$product_array = $question_data['product_array'];
	
	echo "<div id='title_holder' style='width:100%; margin-top:-10px; float:left; padding-left:10px; font-size:1.125em;'>";
		echo "<h2>Question</h2>";
	echo "</div><br />";
	echo "&nbsp; <br />";
	echo "<b>".$question."</b><br /> &nbsp; <br />";

	if (count($product_array) > 0) {
		foreach($product_array as $row) {
			echo "<a href='admin_stats.php?page=view_product&ID=".$row['productID']."'>".$row['product']."</a>&nbsp;  | <a href='#' class='remove_product' id='".$row['productID']."'>Remove From Question</a><br /> &nbsp; <br />";	
		}
	} else {
		echo "No Products Attached<br />";
	}
	echo "&nbsp; <br />";
	
	echo "<input type='hidden' id='questionID' value='".$questionID."'>";
	
	echo "&nbsp; <br />";
	echo "<div id='title_holder' style='width:100%; margin-top:-10px; float:left; padding-left:10px; font-size:1.125em;'>";
		echo "<h2>Add Product</h2>";
	echo "</div><br />";
 	
	echo "<select id='product'>";
		foreach($product_list as $product) {
			echo "<option value='".$product['productID']."'>".$product['product']."</option>";
		}
	echo "</select><br />";
	
	echo "Key: <input type='password' id='add_product_key'>";
	echo " &nbsp; <a href='#' class='add_product' id='".$questionID."'>Add Product</a><br />";	
	echo "&nbsp; <br />";
	echo "<hr>";
	echo "&nbsp; <br />";
	
	echo "<div id='title_holder' style='width:100%; margin-top:-10px; float:left; padding-left:10px; font-size:1.125em;'>";
		echo "<h2>Edit Question</h2>";
	echo "</div><br />";	
	
	echo "Question Text: <br />";
	echo "<textarea id='question_text' style='width:400px;'>".$question."</textarea><br />";
	echo "&nbsp; <br />";
	
	echo "None of the Above Text: <br />";
	echo "<textarea id='no_answer' style='width:400px;'>".$none_answer."</textarea><br />";
	echo "&nbsp; <br />";
	
	echo "Question Type: ";
	echo "<select multiple id='question_type'>";
		echo "<option value='FOH' $FOH >FOH</option>";
		echo "<option value='BOH' $BOH >BOH</option>";
		echo "<option value='MGMT' $MGMT >MGMT</option>";
	echo "</select>";
	echo "&nbsp; <br />";		

	echo "Key: <input type='password' id='edit_question_key'>";
	echo " &nbsp; <a href='#' class='edit_question' id='".$questionID."'>Save Changes</a>";
	
?>
<script>
		$(document).on("click", '.edit_question', function() {
			questionID = $(this).attr('ID');
			question_text = encodeURIComponent($("#question_text").val().trim());
			no_answer = encodeURIComponent($("#no_answer").val().trim());
			question_type = $("#question_type").val();
			edit_question_key = $("#edit_question_key").val();
			
			if (question_text.length == 0 || no_answer.length == 0) {
				$('#empty_warning').show();
			} else {
				dataString = "questionID=" + questionID + "&question_text=" + question_text + "&no_answer=" + no_answer + "&question_type=" + question_type + "&edit_question_key=" + edit_question_key;
				//alert(dataString);
				$.ajax({
					type: "POST",
					url: "admin_stats.php?page=amazon_ajax&type=edit_question",
					data: dataString,
					success: function(data) {
						//alert(data);
						window.location.reload();
					}
				});	
			}				
			return false;
		});	
		
		$(document).on("click", '.add_product', function() {
			questionID = $(this).attr('ID');
			productID = $("#product").val();
			add_product_key = $("#add_product_key").val();
			
			dataString = "questionID=" + questionID + "&productID=" + productID + "&add_product_key=" + add_product_key;
			//alert(dataString);
			$.ajax({
				type: "POST",
				url: "admin_stats.php?page=amazon_ajax&type=add_product_relation",
				data: dataString,
				success: function(data) {
					//alert(data);
					window.location.reload();
				}
			});	
			return false;
		});									
		
		$(document).on("click", '.remove_product', function() {
			productID = $(this).attr('ID');
			questionID = $("#questionID").val();
			
			dataString = "productID=" + productID + "&questionID=" + questionID;
			//alert(dataString);
			$.ajax({
				type: "POST",
				url: "admin_stats.php?page=amazon_ajax&type=remove_product_relation",
				data: dataString,
				success: function(data) {
					//alert(data);
					window.location.reload();
				}
			});	
			return false;
		});							
</script>
<?php
}	

function amazon_product($product_info, $product_attachments, $question_list) {

	echo "<div id='title_holder' style='width:100%; margin-top:-10px; float:left; padding-left:10px; font-size:1.125em;'>";
		echo "<h2>Product Info</h2>";
	echo "</div><br />";
		
	echo "<h5>Display (do not click)</h4>";
	
	echo $product_info['image_link']."<br />";
	echo $product_info['text_link']."<br />";
	echo $product_info['product']."<br /> &nbsp; <br />";
	
	echo "<div id='title_holder' style='width:100%; margin-top:-10px; float:left; padding-left:10px; font-size:1.125em;'>";
		echo "<h2>Question Attachments</h2>";
	echo "</div><br />";
	
	foreach($product_attachments as $row) {
		echo $row['question']." &nbsp; &nbsp; <a href='#' class='detach_product' id='".$row['questionID']."'>Detach Product</a><br />";
	}
	echo "&nbsp; <br />";
	echo "<input type='hidden' id='productID' value='".$product_info['productID']."'>";
	echo "<hr><br />";
	
	echo "<div id='title_holder' style='width:100%; margin-top:-10px; float:left; padding-left:10px; font-size:1.125em;'>";
		echo "<h5>Add Attachment</h5>";
	echo "</div><br />";
	
	echo "<select id='questionID'>";
		foreach($question_list as $row) {
			echo "<option value='".$row['questionID']."'>".$row['question']."</option>";
		}
	echo "</select><br />";
	
	echo "Key: <input type='password' id='attach_question_key'>";
	echo " &nbsp; <a href='#' id='attach_question'>Save Question Attachment</a><br />";
	echo " &nbsp; <br />";
	echo "<hr><br />";
	
	echo "<div id='title_holder' style='width:100%; margin-top:-10px; float:left; padding-left:10px; font-size:1.125em;'>";
		echo "<h2>Edit Product</h2>";
	echo "</div><br />";
	
	echo "Product Name: <br />";
	echo "<textarea id='product_name' style='width:400px;'>".$product_info['product']."</textarea><br />";
	echo "&nbsp; <br />";
	
	echo "Text Link: <br />";
	echo "<textarea id='text_link' style='width:400px;'>".$product_info['text_link']."</textarea><br />";
	echo "&nbsp; <br />";
	
	echo "Image Link: <br />";
	echo "<textarea id='image_link' style='width:400px;'>".$product_info['image_link']."</textarea><br />";
	echo "&nbsp; <br />";
	
	echo "Key: <input type='password' id='edit_product_key'>";
	echo "<a href='#' id='edit_product'>Edit Product</a>";
	
?>
<script>
		$(document).on("click", '.detach_product', function() {
			questionID = $(this).attr('ID');
			productID = $("#productID").val();
			
			dataString = "questionID=" + questionID + "&productID=" + productID;
			//alert(dataString);
			$.ajax({
				type: "POST",
				url: "admin_stats.php?page=amazon_ajax&type=remove_product_relation",
				data: dataString,
				success: function(data) {
					//alert(data);
					window.location.reload();
				}
			});	
			return false;
		});	
		
		$(document).on("click", '#attach_question', function() {
			questionID = $("#questionID").val();
			productID = $("#productID").val();
			add_product_key = $("#attach_question_key").val();
			
			dataString = "questionID=" + questionID + "&productID=" + productID + "&add_product_key=" + add_product_key;
			alert(dataString);
			$.ajax({
				type: "POST",
				url: "admin_stats.php?page=amazon_ajax&type=add_product_relation",
				data: dataString,
				success: function(data) {
					alert(data);
					window.location.reload();
				}
			});	
			return false;
		});									
										
		
		$(document).on("click", '#edit_product', function() {
			productID = $("#productID").val();
			product_name = encodeURIComponent($("#product_name").val().trim());
			text_link = encodeURIComponent($("#text_link").val().trim());
			image_link = encodeURIComponent($("#image_link").val().trim());
			edit_product_key = $("#edit_product_key").val();
			
			dataString = "productID=" + productID + "&product_name=" + product_name + "&text_link=" + text_link + "&image_link=" + image_link + "&edit_product_key=" + edit_product_key;
			alert(dataString);
			$.ajax({
				type: "POST",
				url: "admin_stats.php?page=amazon_ajax&type=edit_product",
				data: dataString,
				success: function(data) {
					alert(data);
					window.location.reload();
				}
			});	
			return false;
		});							
</script>
<?php	
}

function bounty_menu_html() {
		echo "<div>";
			echo "<h1>Bounty Menu</h1>";

			echo "<a href='admin_stats.php?page=bounty&type=pay_list' class='btn btn-primary'>Pay Bounties</a>  ";
			echo "<a href='admin_stats.php?page=bounty&type=follow_up' class='btn btn-primary'>Follow Up</a>  ";
			echo "<a href='admin_stats.php?page=bounty&type=current' class='btn btn-primary'>View Current Bounty Jobs</a> ";
			echo "<a href='admin_stats.php?page=bounty&region=search' class='btn btn-primary'>Search Bounty Jobs</a> ";
		echo "</div>";		
}

function bounty_job_list_html($type, $job_list) {
		echo "<div>";
			echo "<h1>".$type."</h1>";
			
			echo	"<table class='dark' style='width:100%;'>";
				echo "<tr valign='middle'>";
					echo "<th valign='middle' style='width:200px'>Job</th>";				
					echo "<th valign='middle' style='width:150px'>Store</th>";
					echo "<th valign='middle' style='width:150px'>Job Status</th>";				
					echo "<th valign='middle' style='width:150px'>Bounty Status</th>";
					echo "<th valign='middle' style='width:150px'>Expiration</th>";
				echo "</tr>";			
			echo "</table>";
			
			if (count($job_list) > 0) {
				echo	"<table class='dark' style='width:100%;'>";
					foreach($job_list as $row) {
						echo "<tr>";
							echo "<td><a href='admin_stats.php?page=bounty&type=details&jobID=".$row['jobID']."'>".$row['title']."</a></td>";
							echo "<td>".$row['name']."<br />".$row['zip']."</td>";
							echo "<td>".$row['job_status']."</td>";
							echo "<td>".$row['bounty_status']."</td>";
							echo "<td>".$row['expiration_date']."</td>";
						echo "</tr>";
					}
				echo "</table>";
			} else {
				echo "No current bounty jobs.";
			}
			
	echo "</div>";
}
	
function bounty_details_html($bounty_details) {
	//break apart array
	
	$job_details = $bounty_details['job'];
	$recommendations = $bounty_details['recommendations'];
	$follow_up = $bounty_details['follow_up'];
	$bounty_payment = $bounty_details['bounty_payment'];

		echo "<div>";
			echo "<h1>Bounty Details</h1>";
			
			echo "<h3>Job Details</h3>";
				echo "Title: ".$job_details['title']."<br />";
				echo "Store: ".$job_details['name']."<br />";
				echo "Bounty Amount: ".$job_details['bounty']."<br />";
				echo "Job Status: ".$job_details['job_status']."<br />";
				echo "Bounty Status: ".$job_details['bounty_status']."<br />";
				echo "Posted: ".$job_details['date_created']."<br />";
				echo "Expiration: ".$job_details['expiration_date']."<br />";
				echo "Employer: ".$job_details['firstname']." ".$job_details['lastname']." - ".$job_details['position']."<br />";
				echo "Contact: ".$job_details['email']."<br />";
				echo "Zip: ".$job_details['zip']."<br />";
				echo "FIX THIS Link: http://servebartendcook.com/public_listing_new.php?ID=".$job_details['jobID']."&ref=".$job_details['public_hash']."<br />";

			echo "<h3>Recommendations</h3>";
				echo "<div style='float:left; width:100%; margin-left:15px;'>";
					if (count($recommendations) > 0) {
						foreach($recommendations as $row) {
							echo "Recommender: ".$row['bounty_first']." ".$row['bounty_last']." ".$row['bounty_email']." - userID: ".$row['userID']."<br />";
							echo "Candidate: ".$row['firstname']." ".$row['lastname']." ".$row['email']." - userID: ".$row['recommendedID']."<br />";
							echo "Coworker: ".$row['coworker']."<br />";
							echo "Worked for Employer: ".$row['employer']."<br />";
							echo "Date Recommended: ".$row['date']."<br />";
							echo "Status: ".$row['recommend_status']."<br />";
							echo "Status Date: ".$row['status_date']."<br />";
							echo "<hr><br />";
						}
					} else {
						echo "<i>No Recommendations</i>";
					}
				echo "</div>";
				
			echo "<h3>Follow-Ups</h3>";
				echo "<div style='float:left; width:100%; margin-left:15px;'>";
					if (count($follow_up) > 0) {
						foreach($follow_up as $row) {
							echo "Type: ".$row['contact_type']."<br />";
							echo "Scheduled Date: ".$row['schedule_date']."<br />";
							echo "Date Executed: ".$row['date_executed']."<br />";
							echo "Notes: ".$row['notes']."<br />";
							echo "Initials: ".$row['initials']."<br />";
							echo "<hr><br />";
						}
					} else {
						echo "<i>No Follow-ups</i>";
					}
				echo "</div>";
				
			echo "<h3>Payment Details</h3>";
				echo "<div style='float:left; width:100%; margin-left:15px;'>";

				if (count($bounty_payment) > 0) {
					foreach($bounty_payment as $row) {
						echo "Stripe Payment Date: ".$row['date']."<br />";
						echo "Phone: ".$row['phone']."<br />";
						echo "<hr><br />";
					}
				} else {
					echo "<i>No Payments</i>";
				}
				
			echo "</div>";	
		echo "</div>";
}

function bounty_stats_choose_html() {	
?>		
		<h1>Stat Options</h1>
<?php	
				echo "Year <select id='year'>";
					echo "<option value='2016'>2016</option>";
					echo "<option value='2015'>2015</option>";
					echo "<option value='2014'>2014</option>";
				echo "</select>";
				echo "Month <select id='month'>";
					$month = 1;
					while ($month <= 12) {
						echo "<option value=$month>".$month."</option>";
						$month++;
					}
				echo "</select>";
					echo "Day <select id='day'>";
					$day = 1;
					while ($day <= 31) {
						echo "<option value=$day>".$day."</option>";
						$day++;
					}
				echo "</select>";	
		echo "<br /> &nbsp; <br /><a href='#' class='submit_bounty_stats' id='".$type."'>SUBMIT</a>";
?>
<script>
		$(document).on("click", '.submit_bounty_stats', function() {	
			//alert("here");
			day = $('#day').val();
			month = $('#month').val();
			year = $('#year').val();	

			window.location = "admin_stats.php?page=bounty_stats_results&day="+day+"&month="+month+"&year="+year;
			return false;
		});		
</script>
<?php		
	}
	
function bounty_stats_results_html($average_array) {
	echo "<h3>Three Month Daily Averages </h3>";
	echo "&nbsp; <br />";
		
	foreach($average_array as $key_1=>$city) {
		echo "<h2>".$key_1."</h2>";
		echo "<table class='dark' style='width:700px'>";
		
		echo "<tr>";
			echo "<th>Position</th><th align='center'>Free Count</th><th align='center'>Free Views</th><th align='center'>Free Applies</th><th align='center'>Bounty Count</th><th align='center'>Bounty Views</th><th align='center'>Bounty Applies</th>";
		echo "</tr>";
		foreach($city as $key_2=>$specialty) {
			echo "<tr>";
				echo "<td>".$key_2."</td>";
				echo "<td align='center'>".$specialty['free']['count']."</td>";

				if ($specialty['free']['count'] > 0) {
					$avg_free_views = $specialty['free']['avg_views_total']/$specialty['free']['count'];
					$avg_free_applies = $specialty['free']['avg_applies_total']/$specialty['free']['count'];
					echo "<td align='center'>".round($avg_free_views, 3)."</td>";
					echo "<td align='center'>".round($avg_free_applies, 3)."</td>";			
				} else {
					echo "<td align='center'>0</td>";
					echo "<td align='center'>0</td>";
				}
	
				echo "<td align='center'>".$specialty['bounty']['count']."</td>";
				if ($specialty['bounty']['count'] > 0) {
					$avg_bounty_views = $specialty['bounty']['avg_views_total']/$specialty['bounty']['count'];
					$avg_bounty_applies = $specialty['bounty']['avg_applies_total']/$specialty['bounty']['count'];
					echo "<td align='center'>".round($avg_bounty_views, 3)."</td>";
					echo "<td align='center'>".round($avg_bounty_applies, 3)."</td>";				
				} else {
					echo "<td align='center'>0</td>";
					echo "<td align='center'>0</td>";
				}
			echo "</tr>";
		}	
		echo "</table>";	
	}	
}

function boosted_job_list_html($type, $boosted_list) {
		echo "<div>";
			if ($type == "new") {
				echo "<h1>New Boosted Jobs</h1>";				
			} else {
				echo "<h1>Old Boosted Jobs</h1>";								
			}
			
			
			echo	"<table class='dark' style='width:100%;'>";
				echo "<tr valign='middle'>";
					echo "<th valign='middle' style='width:200px'>Job</th>";				
					echo "<th valign='middle' style='width:150px'>Store</th>";
					echo "<th valign='middle' style='width:150px'>Boost Type</th>";				
					echo "<th valign='middle' style='width:150px'>Posted</th>";
					//echo "<th valign='middle' style='width:150px'>Expiration</th>";
				echo "</tr>";			
			echo "</table>";
			
			if (count($boosted_list) > 0) {
				echo	"<table class='dark' style='width:100%;'>";
					foreach($boosted_list as $row) {
						echo "<tr>";
							echo "<td><a href='public_listing_new.php?ID=".$row['jobID']."&ref=".$row['public_hash']."'>".$row['title']." <br />".$row['name']."</a> (".$row['zip'].")";
							echo "<td>".$row['boost_type']."</td>";
							echo "<td>".$row['date_created']."</td>";
							//echo "<td>".$row['expiration_date']."</td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td colspan='5'>";
								if ($type == "new") {
									echo "MARK AS BOOSTED: ";
									echo "Select Date:  ";
									$month = 1;
									echo "<select id='month_".$row['boostID']."'>";

									while($month <= 12) {
									    echo "<option value=".$month.">".$month."</option>";	
									    $month++;
									} 
									echo "</select>/";
									
									$day = 1;
									echo "<select id='day_".$row['boostID']."'>";

									while($day <= 31) {
									    echo "<option value=".$day.">".$day."</option>";	
									    $day++;
									} 
									echo "</select>/";		
									
									echo "<select id='year_".$row['boostID']."'>";
									    echo "<option value='2017'>2017</option>";	
									    echo "<option value='2018'>2018</option>";
									    echo "<option value='2019'>2019</option>";										    	
									echo "</select>";	
									
									echo "&nbsp; <a href='#' id='".$row['boostID']."' class='save_boost' >Save Date</a>";																								
									
								} else {
									echo "Boosted on ".$row['date_boosted'];
								}
								
							echo "</td>";
						echo "</tr>";
					}
				echo "</table>";
			} else {
				echo "No Boosted jobs in this list.";
			}
			
	echo "</div>";
}	

function paid_job_list_html($group_list) {
		echo "<div>";
			echo "<h1>New Paid Jobs</h1>";
						
			
			if (count($group_list) > 0) {
				echo	"<table class='dark' style='width:100%;'>";
					foreach($group_list as $group) {
						echo "<tr>";
							echo "<td><h3>".$group['type']."</h3></td>";
							echo "<td><h3>".$group['name']."</h3></td>";
							echo "<td><h3>".$group['zip']."</h3></td>";
						echo "</tr>";
						
						echo "<tr>";
							echo "<td> &nbsp; </td>";
							echo "<td colspan='2'>";
									echo "MARK AS POSTED: ";
									echo "Select Date:  ";
									$month = 1;
									echo "<select id='month_".$group['groupID']."'>";

									while($month <= 12) {
									    echo "<option value=".$month.">".$month."</option>";	
									    $month++;
									} 
									echo "</select>/";
									
									$day = 1;
									echo "<select id='day_".$group['groupID']."'>";

									while($day <= 31) {
									    echo "<option value=".$day.">".$day."</option>";	
									    $day++;
									} 
									echo "</select>/";		
									
									echo "<select id='year_".$group['groupID']."'>";
									    echo "<option value='2017'>2017</option>";	
									    echo "<option value='2018'>2018</option>";	
									    echo "<option value='2019'>2019</option>";										    
									echo "</select>";	
									
									echo "&nbsp; <a href='#' id='".$group['groupID']."' class='save_cl_post' >Save Date</a>";																								
								
							echo "</td>";
						echo "</tr>";

						foreach ($group['job_list'] as $row) {
							echo "<tr>";
								echo "<td> &nbsp; - </td>";
								echo "<td><a href='public_listing_new.php?ID=".$row['jobID']."&ref=".$row['public_hash']."'>".$row['title']." <br />".$row['name']."</a>";
								echo "<td>".$row['date_created']."</td>";
							echo "</tr>";
						}
					}
				echo "<tr><td colspan='3'> &nbsp; </td>";
				echo "</table>";
			} else {
				echo "No Boosted jobs in this list.";
			}
			
	echo "</div>";
}	

function insightly_options_html($insightly_data, $date) {
		echo "<div>";
			echo "<h1>Data for Insightly Update</h1>";
			
			if ($insightly_data != "N") {
				$new_employers = $insightly_data['new_employers'];
				$new_jobs = $insightly_data['new_jobs'];
				$logins = $insightly_data['logins'];
				echo "<h2>Start Date: ".$date."</h2>";
				echo "<h3>New Employers<h3>";
				
				echo	"<table class='dark' style='width:100%;'>";	
					echo "<tr>";
						echo"<th>USER ID</th>";
						echo "<th>NAME</th>";
						echo "<th>EMAIL</th>";
						echo "<th>STORE</th>";
						echo "<th>STREET</th>";
						echo "<th>ZIP</th>";
						echo "<th>SIGNUP</th>";
					echo "</tr>";
					
					if (count($new_employers) > 0) {
						foreach($new_employers as $row) {
							echo "<tr>";
								echo "<td>".$row['userID']."</td>";
								echo "<td>".$row['lastname'].", ".$row['firstname']."</td>";
								echo "<td>".$row['email']."</td>";
								echo "<td>(".$row['storeID'].") ".$row['name']."</td>";
								echo "<td>".$row['address']."</td>";
								echo "<td>".$row['zip']."</td>";
								echo "<td>".$row['creation_date']."</td>";
							echo "</tr>";	
						}
					} else {
						echo "<tr><td colspan='5'>No new employers</td></tr>";	
					}
				echo "</table>";	
				
				echo "<h3>New Jobs<h3>";
				
				echo	"<table class='dark' style='width:100%;'>";	
					echo "<tr>";
						echo "<th>STORE ID</th>";
						echo "<th>USER ID</th>";
						echo "<th>EMAIL</th>";
						echo "<th>STORE</th>";
						echo "<th>STREET</th>";
						echo "<th>ZIP</th>";
						echo "<th>DATE</th>";
					echo "</tr>";
					
					if (count($new_jobs) > 0) {
						foreach($new_jobs as $row) {
							echo "<tr>";
								echo "<td>".$row['storeID']."</td>";
								echo "<td>".$row['userID']."</td>";
								echo "<td>".$row['email']."</td>";
								echo "<td>".$row['name']."</td>";
								echo "<td>".$row['address']."</td>";
								echo "<td>".$row['zip']."</td>";
								echo "<td>".$row['date_created']."</td>";
							echo "</tr>";	
						}
					} else {
						echo "<tr><td colspan='7'>No new jobs</td></tr>";	
					}
				echo "</table>";					

				echo "<h3>New Employer Logins<h3>";
				
				echo	"<table class='dark' style='width:100%;'>";	
					echo "<tr>";
						echo "<th>USER ID</th>";
						echo "<th>EMAIL</th>";
						echo "<th>DATE</th>";
					echo "</tr>";
					
					if (count($logins) > 0) {
						foreach($logins as $row) {
							echo "<tr>";
								echo "<td>".$row['userID']."</td>";
								echo "<td>".$row['email']."</td>";
								echo "<td>".$row['current_login']."</td>";
							echo "</tr>";	
						}
					} else {
						echo "<tr><td colspan='5'>No new logins</td></tr>";	
					}
				echo "</table>";					
								
			}
			
				echo	"<table class='dark' style='width:100%;'>";						
						echo "<tr>";
							echo "<td> &nbsp; </td>";
							echo "<td colspan='2'>";
									echo "SELECT DATE: ";
									$month = 1;
									echo "<select id='month'>";

									while($month <= 12) {
									    echo "<option value=".$month.">".$month."</option>";	
									    $month++;
									} 
									echo "</select>/";
									
									$day = 1;
									echo "<select id='day'>";

									while($day <= 31) {
									    echo "<option value=".$day.">".$day."</option>";	
									    $day++;
									} 
									echo "</select>/";		
									
									echo "<select id='year'>";
									    echo "<option value='2017'>2017</option>";	
									    echo "<option value='2018'>2018</option>";
									    echo "<option value='2019'>2019</option>";										    	
									echo "</select>";	
									
									echo "&nbsp; <a href='#' id='get_insightly_updates' >Get Data</a>";																								
								
							echo "</td>";
						echo "</tr>";
				echo "</table>";
	echo "</div>";
}

function cl_menu_html() {
		echo "<div>";
			echo "<h1>Data for CL Ad</h1>";
						
				echo	"<table class='dark' style='width:100%;'>";						
						echo "<tr>";
							echo "<td> &nbsp; </td>";
							echo "<td colspan='2'>";
									echo "SELECT DATE: ";
									$month = 1;
									echo "<select id='month'>";

									while($month <= 12) {
									    echo "<option value=".$month.">".$month."</option>";	
									    $month++;
									} 
									echo "</select>/";
									
									$day = 1;
									echo "<select id='day'>";

									while($day <= 31) {
									    echo "<option value=".$day.">".$day."</option>";	
									    $day++;
									} 
									echo "</select>/";		
									
									echo "<select id='year'>";
									    echo "<option value='2017'>2017</option>";	
									    echo "<option value='2018'>2018</option>";	
										    echo "<option value='2019'>2019</option>";									    
									echo "</select>";
									
									echo "ZIP: <input type='text' id='zip'></input>";
	
									
									echo "&nbsp; <a href='#' id='get_cl_data' >Get Data</a>";																								
								
							echo "</td>";
						echo "</tr>";
				echo "</table>";
	echo "</div>";
?>
<script>
		$(document).on("click", '#get_cl_data', function() {	
			//alert("here");
			zip = $('#zip').val();
			month = $('#month').val();
			day = $('#day').val();
			year = $('#year').val();

			dataString = "&zip=" + zip + "&month=" + month + "&day=" + day + "&year=" + year;

			alert(dataString);
			window.location = "admin_stats.php?page=cl_setup"+dataString;
			return false;
		});		
</script>
<?php
}

function cl_result_html($groups_array, $job_array) {
		echo "<div style='margin-left:20px; margin-right:10px;'>";
			echo "<h1>CL Ad</h1>";
			$day = date("l");
			switch($day) {
				case "Monday":
					$day = "mon";
				break;
				case "Tuesday":
					$day = "tues";
				break;
				case "Wednesday":
					$day = "wed";
				break;
				case "Thursday":
					$day = "thurs";
				break;
				case "Friday":
					$day = "fri";
				break;
				case "Saturday":
					$day = "sat";
				break;
				case "Sunday":
					$day = "sun";
				break;
			}
			
			foreach ($job_array as $group) {
				$name = $group['store'];
				$jobs = $group['jobs'];
?>
				&ltb&gt<? echo $name ?>&lt/b&gt - 
<?php
				$total_jobs = count($jobs);
				$count = 1;				
				foreach($jobs as $row) {
					switch($row['specialty']) {
						default:
						  $term = "FOH";
						break;
						
						case "Kitchen":
							  $term = "BOH";				
						break;
						
						case "Dishwasher":
							  $term = "BOH";				
						break;
					}
					
					switch($row['title']) {
						default:
							$title = $row['title'];
						break;
						case "Line Cook - Fine Dining":
							$title = "Line Cook";
						break;
						case "Line Cook - Casual Dining":
							$title = "Line Cook";
						break;
						case "Server - Fine Dining":
							$title = "Server";
						break;
						case "Server - Casual Dining":
							$title = "Server";
						break;
						case "Bartender - Fine Dining":
							$title = "Bartender";
						break;
						case "Bartender - Casual Dining":
							$title = "Bartender";
						break;
						
					}
?>
				&lta href="https://servebartendcook.com/public_listing_new.php?ID=<? echo $row['jobID'] ?>&amp;ref=<? echo $row['public_hash'] ?>&amp;utm_source=CL&amp;utm_medium=<? echo $day ?>&amp;utm_campaign=orl&amp;utm_term=<? echo $term ?>&amp;utm_content=<? echo $row['specialty'] ?>" rel="nofollow"&gt<? echo $title ?>&lt/a&gt
<?php
					if ($count < $total_jobs) {
						echo ", ";
					}
					$count++;
				}
				echo "&ltbr&gt";
				echo "&nbsp; <br />";
				echo "&nbsp; <br />";			
				
			}
		echo "</div>";
}


function mailer_indicator_html($indicator_array, $date) {
		echo "<div>";
			echo "<h1>Possible Mailers</h1>";
			
			if ($indicator_array != "N") {
				echo "<h2>Start Date: ".$date."</h2>";
				echo "<h3>Employers<h3>";
				
				echo	"<table class='dark' style='width:100%;'>";	
					echo "<tr>";
						echo"<th>BUSINESS</th>";
						echo"<th>POSITION</th>";
						echo "<th>END DATE</th>";
						echo "<th>CURRENT</th>";
					echo "</tr>";
					
					if (count($indicator_array) > 0) {
						foreach($indicator_array as $row) {
							echo "<tr>";
								echo "<td>".$row['company']."</td>";
								echo "<td>".$row['position']."</td>";
								echo "<td>".$row['end_month']."</td>";
								echo "<td>".$row['current']."</td>";
							echo "</tr>";	
						}
					} else {
						echo "<tr><td colspan='5'>No entries</td></tr>";	
					}
				echo "</table>";	
			}
			
				echo	"<table class='dark' style='width:100%;'>";						
						echo "<tr>";
							echo "<td> &nbsp; </td>";
							echo "<td colspan='2'>";
									echo "SELECT DATE: ";
									$month = 1;
									echo "<select id='month'>";

									while($month <= 12) {
									    echo "<option value=".$month.">".$month."</option>";	
									    $month++;
									} 
									echo "</select>/";
									
									$day = 1;
									echo "<select id='day'>";

									while($day <= 31) {
									    echo "<option value=".$day.">".$day."</option>";	
									    $day++;
									} 
									echo "</select>/";		
									
									echo "<select id='year'>";
									    echo "<option value='2018'>2018</option>";	
									    echo "<option value='2019'>2019</option>";										    
									echo "</select>";	
									
									echo "&nbsp; <a href='#' id='get_indicator_employers' >Get Data</a>";																								
								
							echo "</td>";
						echo "</tr>";
				echo "</table>";
	echo "</div>";
}

function ad_feed_html($snippet_details) {
		echo "<div>";
			echo "<h1>Ad Feed</h1>";
															
			echo	"<table class='dark' style='width:100%;'>";						
?>
			<tr>
				<th>JobID</th>
				<th>Title</th>
				<th>Store</th>
				<th>URL</th>
				<th>Image</th>
				<th>Description</th>
				<th>Salary</th>
				<th>Address</th>
				<th>Similar Jobs</th>
			</tr>
<?php													
			foreach ($snippet_details as $row)  {
				$url = "https://servebartendcook.com/public_listing_new.php?ID=".$row['jobID']."&ref=".$row['public_hash'];
//				if ($row['image'] == "" || $row['image'] != "") {
					switch($row['main_skill']) {
						case "Bartender":
							$image = "https://servebartendcook.com/images/HiringBartenders2.png";		
						break;
						case "Manager":
							$image = "https://servebartendcook.com/images/HiringMgmt.png";		
						break;
						case "Kitchen":
							$image = "https://servebartendcook.com/images/HiringCooks1.png";						
						break;						
						case "Server":
							$image = "https://servebartendcook.com/images/HiringServers4.png";											
						break;
						case "Bus":
							$image = "https://servebartendcook.com/images/HiringFOH.png";												
						break;
						case "Host":
							$image = "https://servebartendcook.com/images/HiringFOH.png";													
						break;						
					}
/*
				} else {
					$image = "https://servebartendcook.com/images/stores/".$row['image'];
				}
*/
				
				$similar_jobs = "";
				foreach($snippet_details as $detail) {
					if ($detail['jobID'] != $row['jobID'] && $row['main_skill'] == $detail['main_skill']) {
						$similar_jobs .= " ".$detail['jobID'].",";
					}
				}
				
				echo "<tr>";
					echo "<td>".$row['jobID']."</td>";				
					echo "<td>".$row['company']."</td>";
					echo "<td>".$row['snippet_title']."</td>";
					echo "<td>".$row['store_name']."</td>";
					echo "<td>".$url."</td>";
					echo "<td>".$image."</td>";
					echo "<td>".$row['snippet_description']."</td>";
					echo "<td>".$row['snippet_pay_amount']."</td>";
					echo "<td>".$row['store_address']."</td>";
					echo "<td>".$similar_jobs."</td>";
				echo "</tr>";	
		}
		echo "</table>";	

	echo "</div>";
}

function store_image_list_html($store_list) {
		echo "<div>";
			echo "<h1>Store Images by Date of Job Post</h1>";
			
			echo	"<table class='dark' style='width:100%;'>";	
				echo "<tr>";
					echo"<th>STORE</th>";
					echo "<th>ID</th>";
					echo "<th>ZIP</th>";
					echo "<th>IMAGE</th>";
				echo "</tr>";
					
				foreach($store_list as $row) {
					echo "<tr>";
						echo "<td>".$row['name']."</td>";
						echo "<td>".$row['storeID']."</td>";
						echo "<td>".$row['zip']."</td>";
						echo "<td><img src='images/store_pics/".$row['image']."' style='max-height:100px;'></td>";
					echo "</tr>";	
				}

	echo "</div>";
}

function amazon_html($unpaid_list){
	echo "<div>";
	
		echo "<h1>Pending Gift Cards</h1>";

		echo	"<table class='dark' style='width:100%;'>";	
			echo "<tr>";
				echo"<th>USERID</th>";
				echo "<th>STORE</th>";
				echo "<th>NAME</th>";
				echo "<th>EMAIL</th>";
				echo "<th>AMAZON DATE</th>";
			echo "</tr>";

		foreach($unpaid_list as $row) {
			$store = $row['store'];
			$referrer = $row['referrer'];
			echo "<tr>";
				echo "<td>".$referrer['userID']."</td>";
				echo "<td>".$store."</td>";
				echo "<td>".$referrer['firstname']." ".$referrer['lastname']."</td>";
				echo "<td>".$referrer['email']."</td>";				
				echo "<td>";
					$month = 1;
					echo "<select id='month_".$referrer['signupID']."'>";

					while($month <= 12) {
					    echo "<option value=".$month.">".$month."</option>";	
					    $month++;
					} 
					echo "</select>/";
									
					$day = 1;
					echo "<select id='day_".$referrer['signupID']."'>";

					while($day <= 31) {
					    echo "<option value=".$day.">".$day."</option>";	
					    $day++;
					} 
					echo "</select>/";		
									
					echo "<select id='year_".$referrer['signupID']."'>";
					    echo "<option value='2018'>2018</option>";	
					    echo "<option value='2019'>2019</option>";	
					echo "</select>";	
					
					echo "&nbsp; <a href='#' id='".$referrer['signupID']."' class='save_amazon_date' >Save Date</a>";																								
				
			echo "</td>";
			echo "</tr>";	
		}
		echo "</table>";
	echo "</div>";	
}
?>