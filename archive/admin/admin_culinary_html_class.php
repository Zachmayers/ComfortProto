<?php
	function main_culinary_html($member_data) {
?>		
		<h2 style="text-align: center">Culinary Administrator Portal</h2>
			
		<h4 style="text-align: center"><? echo $member_data['school'] ?> Page - Beta Version 1.01</h4>	
			<div style="margin-left: 10px; margin-right: 5px; float:left; width:100%">
				<i>This site is intended for culinary administrators only, if you are a student, please visit <a href='http://servebartendcook.com'>ServeBartendCook.com</a> to view and apply to jobs</i><br />
				&nbsp; <br />				
				Click the link below to view a list of regional kitchen jobs that have actively selected the 'Allow Culinary Interns' button when posting the job on ServeBartendCook.com<br />
				&nbsp; <br />
				When an employer posts a job, notices are sent to all qualified candidates instantly, so jobs tend to get responses quickly.  It is suggested that you contact the employer within the first 48 hours of the time and date posted. <br />
				&nbsp; <br />
				All jobs expire after 14 days on the site.
				<div style="float:left; width:100%; text-align: center; margin-top: 25px; margin-bottom: 25px;">
					<a href='culinary.php?page=culinary_job_list' class='btn btn-large btn-primary'>CULINARY INTERN OPPORTUNITIES</a><br />
				</div>
			</div>
		<hr>								 
			&nbsp; <br />	
			This account expires	on <? echo date('m-d-Y', strtotime($member_data['expiration_date']))	?>.<br />
			&nbsp; <br />				
			Main Page:  <a href='http://servebartendcook.com'>ServeBartendCook.com</a><br />
			Facebook:  	<a href='http://facebook.com/servebartendcook'>facebook.com/servebartendcook</a><br />	
			Twitter:  	<a href='http://twitter.com/servebarcook'>twitter.com/servebarcook</a>		
<?php
	}//end html_page_main function
	
	function create_culinary_member() {
?>
		<h1 style="display:inline;">SBC ADMIN PANEL</h1>
		<br /> &nbsp; <br />
		<br /> &nbsp; <br />
		<div id='date_error' style='display:none; color:red'>Date Error<br /></div>
		<b>School: </b><input type="text" id="school" name="school"><br />
		<b>Email: </b><input type="text" id="email" name="email"><br />
		<b>Password: </b><input type="text" id="password" name="password"><br />
		<b>Exp. Year: </b><input type="text" id="year" name="year"> (<i>XXXX</i>)<br />
		<b>Exp. Month: </b><input type="text" id="month" name="month"> (<i>XX</i>)<br />
		<b>Exp. Day: </b><input type="text" id="day" name="day"> (<i>XX</i>)<br />
		<b>Admin Pass: </b><input type="text" id="pass" name="pass"><br />

		<div id='success' style='display:none; color:red'>Save Successful<br /></div>
		
		<a href='#' id='save_culinary'>SAVE</a>	
<?php	
	}
	
	function culinary_job_list_html($job_array) {	
?>		
		<h1>Culinary Intern Jobs</h1>
		The following is a list of culinary intern opportunities form the last 30 days.<br />
		<table class="dark">
			<tr>
				<th style="width: 250px;">Job Title</th>
				<th style="width: 60px;">Date Created</th>												
				<th style="width: 60px;">Status</th>																
			</tr>	
		</table>

		<table class='dark'>
<?php
		foreach($job_array as $row) {
			date_default_timezone_set('America/Los_Angeles');		
			$current_date =  date('Y-m-d', strtotime("+15 minutes"));

			if ($current_date > $row['expiration_date']) {
				$job_status = "Expired<b>*</b>";
			} else {
				$job_status = $row['job_status'];				
			}
			echo "<tr>";
				echo "<td style='width: 250px;'><a href='culinary.php?page=view_culinary_job&id=".$row['jobID']."'>".$row['title']."</a><br />".$row['name']."</td>";
				echo "<td style='width: 60px;'>".date('m-d-Y', strtotime($row['date_created']))."</td>";						
				echo "<td style='width: 60px;'>".$job_status."</td>";						
			echo "</tr>";		
		}
?>
		</table>
		<i>* Expired jobs are not necessarily filled, they just no longer appear on the main site.</i>
<?php	
	}
	
function view_culinary_job_html($job_data, $job_views, $employer_name) {
$utilities = new Utilities;

//==================================
//!  First break master arrays into trait arrays
//
//  Modify any data for presentation
//==================================

		$jobID							= $job_data['general']['jobID'];
		$store_name					= $job_data['store']['name'];
		$address						= $job_data['store']['address'];
		$zip								= $job_data['store']['zip'];
		$website						= $job_data['store']['website'];
		$facebook						= $job_data['store']['facebook'];
		$twitter							= $job_data['store']['twitter'];
		$store_type					= $job_data['store']['description'];

		$employer 						= $job_data['employer'];
		$title		 						= $job_data['general']['title'];
		$requirements		 			= $job_data['requirements'];
		$notes							= $job_data['general']['description'];
		$qualifications					= $$job_data['general']['qualifications'];
		$main_skill		 				= $job_data['skills']['main_skill']['specialty'];
		$specialtyID			 		= $job_data['skills']['main_skill']['ID'];
		$benefits						= $job_data['general']['benefits'];
		$benefits_desc				= $job_data['general']['benefits_desc'];
		$schedule						= $job_data['general']['schedule'];
		$comp_type					= $job_data['general']['comp_type'];
		$comp_value					= $job_data['general']['comp_value'];
		$question_array				= $job_data['question_list']['questions'];
		$sub_skills						= $job_data['skills']['sub_skills'];
		$employment					= $job_data['general']['past_employment'];
		$date_created					= $job_data['general']['date_created'];
		$intern							= $job_data['general']['intern'];
		
		$candidate_videos			= $job_data['candidate_videos'];
		
		//get city and state 
		$city_state_array = $utilities->get_city_state($zip);
		$city = strtolower($city_state_array['city']);
		$city = substr_replace($city, strtoupper(substr($city, 0, 1)), 0, 1);

		$state = $city_state_array['state'];

		if ($store_type == "Other") {
			$store_type = "";
		}

		switch($intern) {
			default:
				$intern = "NA";
			break;
			
			case "Y":
				$intern = "Yes";
			break;
			
			case "N":
				$intern = "No";
			break;
		}		

		switch($comp_type) {
			default:
				$compensation = $comp_type;
			break;
			
			case "Hourly":
				$compensation = "$".$comp_value."/hr";
			break;
			
			case "Salary":
				$compensation = "Salary:  $".$comp_value;
			break;				
		}		

		if ($benefits == "Y") {
			$benefits_text =	"<i>".$benefits_desc."</i><br />";
		} else {
			$benefits_text = 	"None<br />";				
		}
		
		switch($main_skill) {
			case "Bartender":
				$main_skill_image = "<img src='images/main-bar.png' height='150px'>";
			break;
			
			case "Manager":
				$main_skill_image = "<img src='images/main-manager.png' height='150px'>";
			break;
			
			case "Kitchen":
				$main_skill_image = "<img src='images/main-cook.png' height='150px'>";
			break;
			
			case "Server":
				$main_skill_image = "<img src='images/main-server.png' height='150px'>";
			break;
									
			case "Bus":
				$main_skill_image = "<img src='images/main-bus.png' height='150px'>";
			break;

			case "Host":
				$main_skill_image = "<img src='images/main-host.png' height='150px'>";
			break;						
		}				
		
		
		if ($notes == "" && $qualifications == "") {
			$notes_text = "";
		} else {
			$notes_text = $notes." <br />".$qualifications;
		}
		
		$website_text = "";
		if ($website == "") {
			$website_text = "No Website";
		} else {
			$website_text = "<a href='http://".$website."'>Website</a>";
		}

		if ($facebook == "") {
			$facebook_text = "";
		} else {
			$facebook_text = " | <a href='http://".$facebook."'>Facebook</a>";
		}
		
		if ($twitter == "") {
			$twitter_text = "";
		} else {
			$twitter_text = " | <a href='http://".$twitter."'>Twitter</a>";
		}												
			
		echo "<div class='job_details'>";
			echo "<div id='title_holder' style='width:100%; margin-top:-10px; float:left; padding-left:10px; font-size:1.125em;'>";
				echo "<h1>".$title."</h2>";
			echo "</div><br />";
			
			echo	"<table class='dark' style='width:100%;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle'><h4>Contact & Stats</h4></th>";
				echo "</tr>";			
			echo "</table>";
			
			$total_views = $job_views['qualified'] + $job_views['unqualified'] + $job_views['list'];
			if ($total_views < 10) {
				$total_views = "NA";
			}
			echo "<div style='float:left; width:100%; margin-top:5px; margin-bottom:5px; margin-left:5px;'>";	
				echo "<table style='width:600px'>"	;	
					echo "<tr><td style='width:100px'><b>Company:</b></td><td>".$store_name." (".$store_type.")</td></tr>";
					echo "<tr><td style='width:100px'><b>Contact Name:</b></td><td>".$employer_name['firstname']." ".$employer_name['lastname']. " (".$employer['position'].")</td></tr>";			
					echo "<tr><td style='width:100px'><b>Contact Email:</b></td><td>".$employer_name['email']."</td></tr>";
					echo "<tr><td style='width:100px'><b>Job Reach:</b></td><td>".$job_views['reach']."</td></tr>";				
					echo "<tr><td style='width:100px'><b>Job Views:</b></td><td>".$total_views."</td></tr>";	
				echo "</table>";			
			echo "</div>";			

			echo	"<table class='dark' style='width:100%;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle'><h4>General Details</h4></th>";
				echo "</tr>";			
			echo "</table>";
	
			echo "<div style='float:left; width:100%'>";
				echo "<div style='float:left; width:50%'>";
		
					echo "<div id='date_holder' style='width:100%; margin-top:10px; float:left; font-size:1.125em'>";
						echo "<div style='float:left; width:140px;'>&#9679; <b>Date Posted:</b> </div>";
						echo "<div id='date' style='float:left; padding-left:10px;'>".date('m-d-Y', strtotime($date_created))."</div>";
					echo "</div><br />";	
									
					echo "<div id='schedule_holder' style='width:100%; margin-top:10px; float:left; font-size:1.125em'>";		
						echo "<div style='float:left; width:150px;'>&#9679; <b>Schedule:</b></div>";
						echo "<span id='schedule_current' >".$schedule."</span>";
					echo "</div>";	
					
					echo "<div id='compensation_holder' style='width:100%; margin-top:10px; float:left; font-size:1.125em'>";					
						echo "<div style='float:left; width:150px;'>&#9679; <b>Compensation:</b></div>";
						echo "<span id='compensation_current'>".$compensation."</span>";
					echo "</div>";	
								
					echo "<div id='benefits_holder' style='width:100%; margin-top:10px; margin-bottom:10px; float:left; font-size:1.125em'>";					
						echo "<div style='float:left; width:150px;'>&#9679;  <b>Benefits:</b></div>";
						echo  "<span id='benefits_current'>".$benefits_text."</span>";
					echo "</div>";	
				
				echo "</div>";

				echo "<div style='float:left; width:50%'>";
										
					echo "<div id='type_holder' style='width:100%; margin-left:5px; margin-top:10px; margin-bottom:10px; float:left; font-size:1.125em'>";					
						echo  "<span id='store_type'>&#9679;  <b>Location: </b>".$address." <br /> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ".$city.", ".$state." ".$zip."</span>";
					echo "</div>";						

					echo "<div id='type_holder' style='width:100%; margin-left:5px; margin-bottom:10px; float:left; font-size:1.125em'>";					
						echo  "<span id='store_type'> &nbsp; ".$website_text.$facebook_text.$twitter_text."</span>";
					echo "</div>";	

				echo "</div>";
			echo "</div>";

			echo	"<table class='dark' style='width:100%;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle'><h4>PREFERRED JOB SKILLS</h4></th>";
				echo "</tr>";			
			echo "</table>";
			
			echo "<div id='skill_holder' style='width:100%; float:left; margin-bottom:10px;'>";
				echo "<div style='width:170px; float:left; text-align:center;'>";
					echo $main_skill_image."<br />";
				echo "</div>";																							
		
				echo "<div style='width:450px; float:left;'>";
					if (count($sub_skills) == 0) {
						echo "&nbsp; <br /><i>No Specific Skills Required</i>";
					} else {							
						//table for display
						echo "<table id='skill_display' CELLSPACING=6 cellpadding=6 width='425px' style='color:red'>";
						$row_count = 2;
						foreach ($sub_skills as $row) {
								if ($row_count % 2 == 0) {		
									echo "<tr>";	
									echo "<td><b> &#x2713; ".$row['sub_specialty']."</b></td>";
								} else {
									echo "<td><b> &#x2713; ".$row['sub_specialty']."</b></td>";								
									echo "</tr>";
								}
								$row_count++;
						}
						if ($row_count % 2 == 0) {	
							echo "</tr>";
						}															
						echo "</table>";	
					}			
				echo "</div>";
			echo "</div>";
						
			echo	"<table class='dark' style='width:100%; margin-bottom:5px;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle'><h4>ADDITIONAL REQUIREMENTS</h4></th>";
				echo "</tr>";			
			echo "</table>";

			echo "<div id='requirements_holder' style='float:left; margin-left:5px; margin-bottom:10px; font-size:1.125em'>"	;	
				if (count($requirements) > 0) {
					foreach ($requirements as $row) {
						echo "<img src='images/icon-locations.png' style='vertical-align:middle;' width=30px;></b>".$row['requirement']."<br />";
					}				
				} else {
					echo "<i>No Requirements Listed</i>";
				}					
			echo "</div>";
			
			if ($notes_text != "") {
				echo	"<table class='dark' style='margin-bottom:5px; width:100%;'>";
					echo "<tr valign='middle'>";
					echo "<th valign='middle'><h4>OTHER INFORMATION</h4></th>";
					echo "</tr>";			
				echo "</table>";
	
				echo "<div id='notes_holder' style='float:left; margin-left:5px; margin-bottom:10px; font-size:1.125em'>";
					echo "<div id='notes_current' style='float:left; padding-left:10px;'><i>".$notes_text."</i></div>";
				echo "</div><br />";
			}			

			echo	"<table class='dark' style='width:100%;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle'><h4>PRE-INTERVIEW QUESTIONS</h4></th>";
				echo "</tr>";			
			echo "</table>";
			echo "<i>You will be required to answer these questions when you apply for this position</i><br />";
			echo "<div id='question_holder' style='float:left; margin-top:5px; margin-left:5px; margin-bottom:5px; font-size:1.125em'>";	
				if (count($question_array) > 0) {
					$count = 1;
					foreach ($question_array as $row) {
						switch($count) {
							case "1":
								$question_image = "<a href='#' class='edit_questions'><img src='images/icon-one.png' style='vertical-align:middle;' width=30px;></a>";
							break;
							
							case "2":
								$question_image = "<a href='#' class='edit_questions'><img src='images/icon-two.png' style='vertical-align:middle;' width=30px;></a>";
							break;
		
							case "3":
								$question_image = "<a href='#' class='edit_questions'><img src='images/icon-three.png' style='vertical-align:middle;' width=30px;></a>";
							break;					
						}						
						echo $question_image." <a href='#' style='display:none' class='remove_question' data-question='".$row['questionID']."'>Remove</a>" .$row['question']."<br /> &nbsp; <br />";
						$count++;
					}
				} else {
					echo "<b>No Questions Added</b>";			
				}
				
			echo "</div>";

			echo	"<table class='dark' style='width:100%; margin-bottom:10px;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle'></th>";
				echo "</tr>";			
			echo "</table>";
					
		echo "</div>";															
	}	
?>