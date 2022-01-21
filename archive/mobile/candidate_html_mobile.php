<?php
function candidate_mobile_html($candidate_data, $total_experience, $employee_store_type, $employee_position_experience, $employee_skills_experience, $old_employee_skills, $post_type) {
//==================================
//!  First break master arrays into trait arrays
//
//  Modify any data for presentation
//==================================
		$utilities = new Utilities;
		
		$matchID						= $_GET['matchID'];
		$candidateID					= $_GET['ID'];

		$general_array				= $candidate_data['general'];
		$employee_array			= $candidate_data['employee_data'];
	
		$skill_array 					= $candidate_data['employee_data']['skills']['skills'];
		$sub_skill						= $candidate_data['employee_data']['skills']['sub_skills']; 
		$employment_array		= $candidate_data['employee_data']['employment'];
		$employment_version	= $candidate_data['employee_data']['employment_version'];
		$education_array 			= $candidate_data['employee_data']['education'];
		$language_array 			= $candidate_data['employee_data']['language'];
		$kitchen_photo_array 	= $candidate_data['employee_data']['kitchen_photos'];
		$bar_photo_array			= $candidate_data['employee_data']['bar_photos'];
		$traits							= $candidate_data['employee_data']['traits'];
		$awards						= $candidate_data['employee_data']['awards'];
		$certifications				= $candidate_data['employee_data']['certifications'];

		$quote							= $candidate_data['general']['quote'];
		$description					= $candidate_data['general']['description'];
		$question_array				= $candidate_data['answer_array'];
		$response_array			= $candidate_data['candidate_response'];

		$past_replies					= $candidate_data['past_replies'];	
		
		$notes							= $candidate_data['candidate_notes']['notes'];
		$notes_date					= $candidate_data['candidate_notes']['date'];
		
		$recommendation			 = $candidate_data['recommendation_details'];		

		if ($employment_version == "new" && count($employment_array) > 0) {
			$new_employment_array = $utilities->reorder_employment($employment_array);
		}	
		
		if (count($past_replies) > 0) {
			$past_reply_notice = "<a href='candidate.php?ID=".$_GET['ID']."&matchID=".$_GET['matchID']."&page=past_replies'>YES - View Details</a>";
		} else {
			$past_reply_notice = "NO - <a href='candidate.php?ID=".$_GET['ID']."&matchID=".$_GET['matchID']."&page=archive_replies'>Check Archive</a>";			
		}						

//MAKE PHONE NUMBER READABLE
		if ($employee_array['general']['contact_phone'] == "") {
			$contact_phone = "<i>No phone entered</i>";
		} else {
			$contact_phone = substr_replace($employee_array['general']['contact_phone'] , '-', 3, 0);
			$contact_phone = substr_replace($contact_phone , '-', 7, 0);			
		}			
					
		if ($employee_array['general']['profile_pic'] == "" || $_SESSION['photo_setting'] == 'N') {
			$photo = "";
		} else {
			$photo = "<img src='images/profile_pics/".$employee_array['general']['profile_pic']."' height='100px' width='100px' alt='profile_pic'>";						
		}

		$menu_count = 1;
		
				
		if (count($question_array) > 0) {
			$question_link = "<a href='#' id='view_questions' style='color:#5D0000'><h4 style='margin-bottom:10px; margin-top:10px;'>Questions</h4></a>";				
			$menu_count++;				
		} else {
			$question_link = "NA";			
		}		
		
		if ($response_array['message'] != "") {
			$message_link = "<a href='#' id='view_message' style='color:#5D0000'><h4 style='margin-bottom:10px; margin-top:10px;'>Message</h4></a>";			
			$menu_count++;				
		} else {
			$message_link = "NA";
		}
		
		$profile_link = "<a href='#' id='view_profile' style='color:#5D0000'><h4 style='margin-bottom:10px; margin-top:10px;'>Profile</h4></a>";				
		
		if ($response_array['highlight'] == "Y") {
			$highlight_notice = "<a href='#' id='unhighlight'><font color='#FFD700' size='5px'><b>&#9733; </b></font>";
		} else {
			$highlight_notice = "<a href='#' id='highlight'><font size='5px'><b>&#9734; </b></font>";			
		}		

?>	
	<div class='main_box' style='margin-top:50px; width:100%;'>

		<div style='float:left; width:100%'>
<?php
		if ($menu_count > 1) {
			switch($menu_count) {
				case "2":
					$width = "49.5%";
				break;
				
				case "3":
					$width = "33%";
				break;
			}
			
			echo	"<div id='menu_buttons' style='float:right; width:100%; margin-bottom:5px; text-align:center;'>";
				echo "<div style='width:".$width."; float:left; background-color:#DBDCCE; min-height:30px; margin-right:1px;'>".$profile_link."</div>";
				if ($message_link != "NA") {
					echo "<div style='width:".$width."; float:left; background-color:#DBDCCE; min-height:30px; margin-right:1px;'>".$message_link."</div>";					
				}
				if ($question_link != "NA") {
					echo 	"<div style='width:".$width."; float:left; background-color:#DBDCCE; min-height:30px; margin-right:1px;'>".$question_link."</div>";			
				}
				
				if ($post_type == "bounty") {
					echo "<br /><div style='width:49.5%; float:left; background-color:#DBDCCE; min-height:30px; margin-right:1px; margin-top:2px;'><a href='candidate.php?ID=".$candidateID."&matchID=".$matchID."&page=interview' style='color:#5D0000'><h4 style='margin-bottom:10px; margin-top:10px;'><font color='#b76e1f' size='3px'><b>&#9733; </b></font> Interview</h4></a></div>";
					echo "<div style='width:49.5%; float:left; background-color:#DBDCCE; min-height:30px; margin-right:1px; margin-top:2px;'><a href='candidate.php?ID=".$candidateID."&matchID=".$matchID."&page=notes' style='color:#5D0000'><h4 style='margin-bottom:10px; margin-top:10px;'><font color='#b76e1f' size='3px'><b>&#9733; </b></font> My Notes</h4></a></div>";
				}
			echo "</div>";
		}
?>					
<!-- 	<div class='main_box' style='float:left; width:100%; padding-right:3.5%; padding-left:3.5%;'> -->
	<div class='main_box' style='float:left; width:100%; padding-right:3.5%;'>

<?php
	recommender_details_mobile_html($recommendation);
?>

			<div class='edit' id='edit_photos' style='float:left; width:32%; margin-top:10px;'>
				<? echo $photo ?>
			</div>
				
			<div id='name_holder' style='width:60%; float:left; margin-left:4px; margin-right:3.5%'>
				<h4 style='color: #760006; margin-bottom:0px'><? echo $highlight_notice ?> <? echo $general_array['firstname'] ?> <? echo $general_array['lastname'] ?></h4></a>
				
				<div style='font-size:14px;'><strong><? echo $contact_phone ?></strong></div>
				
				<? echo "<div style='font-size:12px'>".$general_array['email'] ?><br />
									
<?php
		$lang_count = count($language_array);
		$count = 1;
		if ($lang_count > 0) {
			echo "<b>Languages:</b>  ";
			foreach($language_array as $row) {
				echo $row['lang'];
				if ($count != $lang_count) {
					echo ", ";
				}
				$count++;
			}
		} 
		echo "</div>";
?>

				<div style='width:100%; float:left; text-align:center; margin-top:5px; margin-bottom:5px;'><b>Previously Applied (90 days): <? echo $past_reply_notice ?></b></div>

				</div>
			</div>
	</div>
					
				
	<div id='message_holder' class='menu_holder' style='width:100%; margin-bottom:10px; display:none;'>
		<table class='dark' style='width:100%;'>
			<tr valign='middle'>
			<th valign='middle'>Personal Message</th>
			</tr>
		</table>
		<div style='margin-left:5px; margin-top:5px; width:98%;'>
			<? echo $utilities->makeSafe_flat($response_array['message']); ?>
		</div>	
	</div>
		
	<div id='question_holder' class='menu_holder' style=' width:100%; margin-bottom:10px; display:none;'>
		<table class='dark' style='width:100%;'>
			<tr valign='middle'>
			<th valign='middle'>Pre-Interview Answers</th>
			</tr>
		</table>
<?php
		if (count($question_array) > 0) {
			foreach ($question_array as $row) {
				echo "<div style='color:gray; margin-top:3px; margin-left:10px; float:left; width:98%'>";	
				echo "<i>".$row['question']."</i><br />";
				echo "</div><br />";
				echo "<div style='margin-top:5px; margin-left:10px; float:left; margin-bottom:3px; width:98%'>";	
				echo $utilities->makeSafe_flat($row['answer']);
				echo "</div>";
			}
		}	
?>
	</div>
</div>

<div class='main_box' id='profile_holder'>		
	<div style='float:left; width:100%; background-color:#b76e1f; padding-top:8px; padding-bottom:8px;'>
<?php
		if (count($traits) == 0) {
			echo "<span style='font-size:14px; color:#ffffff; text-align:center; padding-left:4%; padding-right:4%'>No Personality Traits Entered</span>";
		} else {
			foreach ($traits as $row) {
				echo "<div style='float:left; width:33%; text-align:center; font-size:14px; color:#ffffff;'>".$row['trait']."</div>";
			}
		}
?>
	</div>
	
	<div style='float:left; width:100%; background-color:#e9e6de; padding-top:3.5%; padding-bottom:3.5%;' id='quote_holder'>
<?php
	if ($quote == "") {
		echo "<div style='margin-right:3.5%; margin-left:3.5%'><i>No personal quote</i></div>";
	} else {
		echo "<div style='margin-right:3.5%; margin-left:3.5%'><i>".$quote."</i></div>";		
	}
?>		
	</div>
	
	<div style='float:left; width:97%;'>
		<div class='employee_profile_header' style=''>Experience</div> 
	</div>
	
	<div style='float:left; width:100%; margin-left:3.5%; margin-right:3.5%;'>
		<table class='dark'>
<?php
		if ($total_experience['hospitality'] > 0) {
			echo "<tr>";
				echo "<td width='45%'><strong>Hospitality:</strong></td>";
				echo "<td>".$total_experience['hospitality']." yrs</td>";
			echo "</tr>";	
		}
	
		if ($total_experience['other'] > 0) {
			echo "<tr>";
				echo "<td width='45%'><strong>Other:</strong></td>"; 
				echo "<td>".$total_experience['other']." yrs</td>";
			echo "</tr>";
		}
		
		if ($total_experience['unknown'] > 0) {
			echo "<tr>";
				echo "<td width='45%'><strong>Unknown:</strong></td>"; 
				echo "<td>".$total_experience['unknown']." yrs</td>";
			echo "</tr>";
		}
		
	if (count($employee_store_type) > 0) {
			echo "<tr>";
				echo "<td width='45%'><strong>Experience Type: </strong></td>";
				echo "<td>";
				foreach($employee_store_type as $key=>$row) {
				echo "<a href='candidate.php?page=business_type&ID=".$candidateID."&matchID=".$matchID."&type=".$key."'>".$key.": ".$row." yrs <br>";
			
		}
				echo"</td>";
			echo "</tr>";
	}

		echo "<tr>";
			echo "<td width='45%'><strong>Positions held: </strong></td>";
		echo "<td>";
		if (count($employee_position_experience) > 0) {
			foreach($employee_position_experience as $key=>$row) {
				echo "<a href='candidate.php?page=specific_position&ID=".$candidateID."&matchID=".$matchID."&type=".$key."'>".$key.": ".$row." yrs</a> <br />";
			}
		} else {
			echo "NONE";
		}	
		echo "</td>";
			echo "</tr>";
?>
		</table>
	</div>
	
	<div style='float:left; width:97%;'>
		<div class='employee_profile_header'>Skills</div>
	</div>
	
	<div style='float:left; margin-left:3.5%;'>
<?php
	if (count($employee_skills_experience['gold']) > 0) {
		echo "<img src='images/gold.png' alt='5+ yrs' style='height: 44px'><div class='gold_skills'>5+ Years of Experience </div>";
		
		echo "<table class='dark' style='margin-top:10px; margin-right:3.5%'>";
		foreach($employee_skills_experience['gold'] as $key=>$row) {
			$new_key = urlencode($key);
			echo "<tr>";
				echo "<td width='45%'><strong><a href='candidate.php?page=specific_skill&ID=".$candidateID."&matchID=".$matchID."&type=".$new_key."'>".$key."</td>";
				echo "<td>".$row." yrs </td>";
			echo "</tr>";
		}
		echo "</table>";			
	} 
	
	if (count($employee_skills_experience['silver']) > 0) {
		echo "<img src='images/silver.png' alt='2-5 yrs' style='height: 44px'><div class='silver_skills'>2-5 Years of Experience</div>";
		echo "<table class='dark' style='margin-top:10px; margin-right:3.5%'>";
		foreach($employee_skills_experience['silver'] as $key=>$row) {
			$new_key = urlencode($key);
			echo "<tr><td width='45%'><strong><a href='candidate.php?page=specific_skill&ID=".$candidateID."&matchID=".$matchID."&type=".$new_key."'>".$key."</td>";
			echo "<td>".$row." yrs </td></tr>";
		}
		echo "</table>";			
	} 

	if (count($employee_skills_experience['bronze']) > 0) {
		echo "<img src='images/bronze.png' alt='0-2 yrs' style='height: 44px'><div class='bronze_skills'>0-2 Years of Experience</div>";
		echo "<table class='dark' style='margin-top:10px; margin-right:3.5%'>";
		foreach($employee_skills_experience['bronze'] as $key=>$row) {
			$new_key = urlencode($key);
			echo "<tr><td width='45%'><strong><a href='candidate.php?page=specific_skill&ID=".$candidateID."&matchID=".$matchID."&type=".$new_key."'>".$key."</td>";
			echo "<td>".$row." yrs </td></tr>";
		}
		echo "</table>";
	} 	
	
	if (count($old_employee_skills) > 0) {
		echo "<div class='old_skills' style='margin-top:10px;'>Other Skills </div>";
		echo "<div style='float:left; width:80%; margin-left:2%; margin-right:3.5%; color:#8e8e8e'>";
		foreach($old_employee_skills as $row) {
			echo $row.", ";
		}
		echo "</div>";		
	}
	
	if (count($employee_skills_experience['bronze']) == 0 && count($employee_skills_experience['silver']) == 0 && count($employee_skills_experience['gold']) ==0 && count($old_employee_skills) == 0) {
		echo "<table class='dark' style='margin-top:2%'>";
			echo "<tr>";
				echo "<td>No Skills Entered</td>";	
			echo "</tr>";
		echo "</table>";
	}
	
	echo "</div>";

//PHOTOS

	if (count($kitchen_photo_array) > 0) {				
		echo "<div style='float:left; width:100%;'>";
			echo "<div class='photo_skills'>Kitchen Photos </div>";
			echo "<table style='width:100%;'>";
				echo"<tr>";
					echo "<th style='line-height:1px; background-color:#e9e6de'>&nbsp; </th>";
				echo"</tr>";
			echo "</table>";	
			foreach($kitchen_photo_array as $photo) {
				echo "<div style='float:left; margin-top:-5px; margin-bottom:14px; margin-left: 1%; width:15.6%'><a href='images/gallery_pics/".$photo['photo']."'><img src='images/gallery_pics/".$photo['thumb']."' height='55' style='margin-left:0px; margin-bottom:0px;'></a></div>";
			}
		echo "</div>";
	} 

	if (count($bar_photo_array) > 0) {				
		echo "<div style='float:left; width:100%;'>";
			echo "<div class='photo_skills'>Bar Photos </div>";
			echo "<table style='width:100%;'>";
				echo"<tr>";
					echo "<th style='line-height:1px; background-color:#e9e6de'>&nbsp; </th>";
				echo"</tr>";
			echo "</table>";	
			foreach($bar_photo_array as $photo) {
				echo "<div style='float:left; margin-top:-5px; margin-bottom:14px; margin-left:1%; width:15.6%'><a href='images/gallery_pics/".$photo['photo']."'><img src='images/gallery_pics/".$photo['thumb']."' height='55' style='margin-left:0px; margin-bottom:0px;'></a></div>";
			}
		echo "</div>";
	} 
?>

	<div style='float:left; width:97%;'>
		<div class='employee_profile_header'>Past Employment</div>
	</div>
	
	<div style='float:left; width:100%; margin-left:3.5%; margin-right:3.5%;'>
<?php
		echo "<table class='dark'>";	
		if (count($employment_array) > 0) {			
			foreach ($employment_array as $row) {				
				$start_date = $utilities->convert_month($row['start_month'])." ".$row['start_year'];
				if ($row['current'] == 'Y') {
					$end_date = 'Current';
				} else {
					$end_date = $utilities->convert_month($row['end_month'])." ".$row['end_year'];					
				}

				if ($end_date != "Current") {
					$end_time = $row['end_year'] + $row['end_month']/12;
					$start_time = $row['start_year'] + $row['start_month']/12;

					$total = $end_time - $start_time;
					$denominator = 4;
				    $x = $total * $denominator;
				    $x = floor($x);
				    $x = $x / $denominator;
				    								
					$time = "(".$x." yrs)";
				} else {
					$time = "";
				}
				
				echo "<tr>";
					echo "<td width='45%;'><b>".$row['company']."</b>".$indicator." <br />".$row['position']."</td>";
					echo "<td>".$start_date." - ".$end_date."<br /><i>".$time."</i></td>";
				echo "</tr>";
			}
		} else {
			echo "<tr>";
				echo "<td>No Past Employment Entered.</td>";
			echo "</tr>";
		}	
		echo "</table>";		
?>
	</div>

	<div style='float:left; width:97%;'>
		<div class='employee_profile_header'>Education</div>
	</div>
	
	<div style='float:left; width:100%; margin-left:3.5%; margin-right:3.5%;'>
<?php
	echo "<div style='width:100%; float:left; margin-top:0px;'>";
	echo "<table class='dark'>";	
	
	if (count($education_array) > 0) {
		foreach ($education_array as $row) {
			echo "<tr>";
			echo "<td style='width:45%;'><b>".$row['school']."</b></td>";				
			echo "<td style='word-wrap: break-word;'>".$row['degree']."</td>";
			echo "</tr>";
		}
	} else {
		echo "<tr>";
			echo "<td>No Education Entered.</td>";
		echo "</tr>";
	}
	
	echo "</table>";
	
	echo "</div>";	
?>
	</div>
	
	<div style='float:left; width:97%;'>
		<div class='employee_profile_header'>Certifications & Awards</div>
	</div>
		
	<div style='float:left; width:100%; margin-left:3.5%; margin-right:3.5%;'>
<?php
		echo "<div style='width:100%; float:left; margin-top:0px;'>";
			echo "<table class='dark'>";
			if (count($awards) > 0) {
				echo "<tr>";
					echo "<td><h4>AWARDS</h4></td>";
				echo "</tr>";
					
				foreach ($awards as $row) {
					echo "<tr>";
						echo "<td style='word-wrap: break-word;'>".$row['award']."</td>";
					echo "</tr>";
				}
			}
			
			if (count($certifications) > 0) {
				echo "<tr>";
					echo "<td><h4>CERTIFICATIONS</h4></td>";
				echo "</tr>";
					
				foreach ($certifications as $row) {
					echo "<tr>";
						echo "<td style='word-wrap: break-word;'>".$row['certification']."</td>";
					echo "</tr>";
				}
			}
			

		if (count($certifications) == 0 && count($awards) == 0) {
			echo "<tr>";
				echo "<td>No Certifications or Awards Entered.</td>";
			echo "</tr>";
		}	
		echo "</table>";
	echo "</div>";		
?>
	</div>

<?php 
	if ($description != "") {	
		echo "<div style='float:left; width:97%'>";
			echo "<div class='employee_profile_header'>General Description</div>";
		echo "</div>";
		
		echo "<div style='float:left; width:100%; margin-top:5px; margin-left:3.5%; margin-right:3.5%;'>";
		echo "<div style='margin-left:2%; margin-right:3.5%; margin-bottom:3.5%; color:#8e8e8e'>";
			echo $description;
		echo "</div>";	
	}

echo "</div>";
}

function no_past_employment_mobile() {
	echo "No Previous Employment Information Added<br />";	
}

function old_past_employment_mobile($employment_array) {
	if (count($employment_array) > 0) {			
		echo "<table cellpadding='12' cellspacing='12' style='margin-left:20px; margin-top:20px;'>";	
		foreach ($employment_array as $row) {
			echo "<tr>";
				echo "<td width='200px;'><a href='http://".$row['website']."'><b>".$row['company']."</b></a></td>";
				echo "<td width='125px;'>".$row['position']."</td>";		
				echo "<td width='200px'>".$row['start_date']." - ".$row['end_date']."</td>";
			echo "</tr>";
		}
	echo "</table>";
	}
}

function new_past_employment_mobile($new_employment_array, $employment_gaps, $gap_message) {
		$utilities = new Utilities;
		if (count($new_employment_array) > 0) {			
		echo "<table cellpadding='12' style='margin-left:5px; table-layout:fixed;'>";	
			foreach ($new_employment_array as $row) {
				//test for employment gap
				$indicator = "";
				if (count($employment_gaps) > 0) {
					foreach($employment_gaps as $gap) {
						if($gap['secondID'] == $row['ID']) {
							$indicator = "<font color='red'><b>*</b></font>";
						} elseif ($gap['firstID'] == $row['ID']) {
							$indicator = "<font color='red'><b>*</b></font>";							
						}		
					}
				}
				
				$start_date = $utilities->convert_month($row['start_month'])." ".$row['start_year'];
				if ($row['current'] == 'Y') {
					$end_date = 'Current';
				} else {
					$end_date = $utilities->convert_month($row['end_month'])." ".$row['end_year'];					
				}

				if ($end_date != "Current") {
					$end_time = $row['end_year'] + $row['end_month']/12;
					$start_time = $row['start_year'] + $row['start_month']/12;

					$total = $end_time - $start_time;
					$denominator = 4;
				    $x = $total * $denominator;
				    $x = floor($x);
				    $x = $x / $denominator;
				    								
					$time = "(".$x." yrs)";
				} else {
					$time = "";
				}
				
				echo "<tr>";
					echo "<td width='60%;'><a href='http://".$row['website']."'><b>".$row['company']."</b></a>".$indicator." <br />".$row['position']."</td>";
					echo "<td>".$start_date." - ".$end_date."<br /><i>".$time."</i></td>";
				echo "</tr>";
			}
			echo "</table>";
		
		if (count($new_employment_array) > 0 && count($employment_gaps) > 0) {			
			$gap_text = "";
			$count = 0;
			foreach($employment_gaps as $row) {
				$gap_text .= $row['gap_text'];
				$count++;
				if ($count != count($employment_gaps)) {
					$gap_text .= ", ";
				}
			}
			echo "<div style='color:red; float:left; width:100%; margin-left:5px; margin-right:3px;'>*Gaps in employment: ".$gap_text."<br /> Explanation: <i>".$utilities->makeSafe_flat($gap_message)."</div>";
		} 		
	}	
}

function candidate_past_employment_details_mobile_html($type, $first_name, $last_name, $filter_text, $employment_array) {
	
	echo "<div style='float:left; width:100%; padding-right:3.5%; padding-left:3.5%;'>";
	echo "<h2 style='margin-top: 20px'>".$first_name." ".$last_name."</h2>";
	echo "<h3>".$filter_text."</h3>";
	echo $sub_text;
		
	echo "<div style='width:100%; float:left;'>";
		foreach($employment_array as $row) {
		echo "<table class='dark'>";	
			
				if ($row['business']['current'] == 'Y') {
					$end_date = "Current";
				} else {
					$end_date = $row['business']['end_month']."/".$row['business']['end_year'];
				}
				
				if ($end_date != "Current") {
					$end_time = $row['business']['end_year'] + $row['business']['end_month']/12;
					$start_time = $row['business']['start_year'] + $row['business']['start_month']/12;
	
					$total = $end_time - $start_time;
					$denominator = 4;
				    $x = $total * $denominator;
				    $x = floor($x);
				    $x = $x / $denominator;
				    								
					$time = "(".$x." yrs)";
				} else {
					$time = "";
				}
				
					echo "<tr>";
						echo "<td width='45%;' style='border-bottom:0px; border-top: 1px solid #e2e2d8'><strong>".$row['business']['position']."</strong> <br>".$row['business']['company']."</td>";
						echo $row['business_type'];
					 
						echo "<td style='border-bottom:0px; border-top:1px solid #e2e2d8'>".$row['business']['start_month']."/".$row['business']['start_year']." - ".$end_date." <br> ".$time;"</td></tr>";
					
					echo "<tr>";

					if ($type != "specific_skill") {
						if (count($row['skills']) > 0) {
							foreach($row['skills'] as $sub_skills){
							echo "<td width='45%;><div class='unselected_job_titles job_titles_button'>".$sub_skills['sub_skill']."</div></td></tr>";
							}
						} else {
							echo "<td>No skills added.</td></tr>";
						}
					}
			echo "</table>";
		}
	echo "</div>";	
}


function candidate_past_replies_html_mobile($general_array, $candidate_data, $type) {

		if ($type == 'current') {
			$past_replies	 = $candidate_data['past_replies'];
			$date_note = "90 days.";		
		} else {
			//get archive info
			$past_replies	 = $candidate_data;
			$date_note = "2 years.";													
		}
?>		
	<div id="profile_holder" class='details'>
		<div style='width:100%; float:left; text-align:center; margin-left:3px; margin-right:3px;'>
			<h1>Previous applications</h1>
			<h4><? echo $general_array['firstname'] ?> <? echo $general_array['lastname'] ?> previously applied to jobs at your location listed below.</h4>
			<i>This list only contains jobs from the last <? echo $date_note ?></i><br />
			&nbsp; <br />
		</div>
		
		<div style='width:100%; float:left;'>
		<table class='dark' style='width:100%'>
		<thead><tr><th style='width:55%;'>Job Title</th><th style='text-align:center; width:35%;'>Date </th></tr></thead>
<?php
		foreach ($past_replies as $row) {
			echo "<tr>";	
				echo "<td style='width:575%;'>".$row['title']."</td>";	
				echo "<td style='width:25%;' align='center'>".date('M j, Y', strtotime($row['date_responded']))."</td>";
			echo "</tr>";
		}
		echo "</table>";
		
		if (count($past_replies) == 0) {
			echo "&nbsp; <br /><b><i>&nbsp; No past applications</i></b><br />";
		}
		
	if ($type == "current") {
		echo "<div style='width:100%; float:left; text-align:center; margin-top:15px;'><a href='candidate.php?ID=".$_GET['ID']."&matchID=".$_GET['matchID']."&page=archive_replies' class='btn btn-large btn-primary archive' id='post'>Check Archive (max. 2-years)</a><br /> &nbsp; <br /><i>(this may take a few moments)</i></div>";
	}
	echo "</div>";
	echo "</div>	";
}

function candidate_interview_set_mobile_html($first_name, $last_name) {
	$utilities = new Utilities;
	
	$current_month = date('n');
	$current_day = date('j');
	$current_year = date('Y');
	
	$month_selection_array = $utilities->month_selections($current_month); 
	
	//add warning text
	echo "<div class='main_box' style='margin-top:50px; width:100%;'>";
	
	echo "<div id='interview_holder' style='float:left; width:100%;'>";

		echo	"<h3 style='text-align:center; margin-bottom:5px;'>Send Interview Reminders</h3>";
		
		echo "<h3 style='text-align:center; margin-bottom:15px;'>".$first_name." ".$last_name."</h3>";

		echo "<div style='float:left; width:99%; margin-left:9px; margin-right:3px;'>";
			echo "<h4 style='margin-bottom:0px;'>Have you called the candidate to set up an interview?</h4>";
			echo "<h4>If so, we can send them reminders to help reduce no-shows. <a href='main.php?page=interview_faq'>Learn More.</a></h4>";
		
/*
			echo "If you have called this candidate and set up and interview, create an interview confirmation below.  <br />";
			echo "This can greatly help to reduce 'no-shows'.  <a href='main.php?page=interview_faq'>Learn More.</a><br />";
			echo "&nbsp; <br />";
*/

			echo "<div style='float:left; width:99%; margin-left:7px;'>";	
				echo "&#8226 We will send the candidate email reminders as the interview date approaches.<br />";
				echo "&#8226 The interview reminder allows the candidate to easily cancel the interview with one click.<br />";
				echo "&#8226 You will be emailed immediately if the candidate cancels.<br />";
				echo "&nbsp; <br />";
			echo "</div>";
			
			echo "<h4 style='margin-top:15px; margin-bottom:0px;'>Select Interview Date & Time</h4>";
			echo "<span style='color:red;'><b>NOTE: </b>You must contact candidate directly to schedule interviews.  <br />We only send reminders.  SBC DOES NOT schedule interviews.<br /></span><br />";

			echo "<div id='date_error' class='warning' style='color:red; display:none'><b>Oops, you didn't enter a valid date.</b></div>";
			echo "<table style='margin-bottom:15px; margin-left:10px;'>";
				echo "<tr>";
					echo "<td><b>Date:</b></td>";
	
					echo "<td>";
						echo "<select id='month' style='font-size:16px'>";			
						echo "<option value='01' ".$month_selection_array['jan']." >January</option>";
						echo "<option value='02' ".$month_selection_array['feb']." >February</option>";
						echo "<option value='03' ".$month_selection_array['mar']." >March</option>";
						echo "<option value='04' ".$month_selection_array['apr']." >April</option>";
						echo "<option value='05' ".$month_selection_array['may']." >May</option>";
						echo "<option value='06' ".$month_selection_array['jun']." >June</option>";
						echo "<option value='07' ".$month_selection_array['jul']." >July</option>";
						echo "<option value='08' ".$month_selection_array['aug']." >August</option>";
						echo "<option value='09' ".$month_selection_array['sep']." >September</option>";
						echo "<option value='10' ".$month_selection_array['oct']." >October</option>";
						echo "<option value='11' ".$month_selection_array['nov']." >November</option>";
						echo "<option value='12' ".$month_selection_array['dec']." >December</option>";
						echo "</select>";
	
					echo "<select id='day' style='font-size:16px'>";
						$day_count = 1;
						while($day_count <= 31) {
							if ($current_day == $day_count) {
								$selected = "selected";
							} else {
								$selected = "";
							}
							echo "<option value=".$day_count." ".$selected." >".$day_count."</option>";
							$day_count++;
						}
					echo "</select>";
	
					echo "<select id='year' style='font-size:16px'>";
						echo "<option value=2016>2016</option>";
						echo "<option value=2017>2017</option>";
					echo "</select></td>";
				echo "</tr>";
			
				echo "<tr>";		
					echo "<td><b>Time:</b></td>";
					echo "<td><select id='hour' style='font-size:16px'>";
					$hour_count = 1;
					while($hour_count <= 12) {
						echo "<option value=".$hour_count.">".$hour_count."</option>";
						$hour_count++;
					}		
					echo "</select>:";
					echo "<select id='minute' style='font-size:16px'>";
						echo "<option value='00'>00</option>";
						echo "<option value='15'>15</option>";
						echo "<option value='30'>30</option>";
						echo "<option value='45'>45</option>";
					echo "</select>";
					echo "<select id='ampm' style='font-size:16px'>";
						echo "<option value='PM'>PM</option>";
						echo "<option value='AM'>AM</option>";
					echo "</select></td>";
				echo "</tr>";
			echo "</table>";
			
			echo "<div class='green_button confirm_interview' id='".$_GET['matchID']."'>";
				echo "<img src='images/savegreen.png'  style='width:25px;height:25px;vertical-align:middle'>";
				echo "<span style='margin-left:8px; vertical-align: middle; font-size:18px'>Save </span>";
			echo "</div>";
		echo "</div>";
	echo "</div>";
echo "</div>";
}				

function candidate_interview_edit_mobile_html($first_name, $last_name, $interview_schedule, $interviewID, $matchID, $status) {
	
	$utilities = new Utilities;

	$date = strtotime($interview_schedule);
	
	$year = date('Y', $date);
	$month = date('n', $date);
	$day = date('j', $date);
	$hour = date('g', $date);
	$minute = date('i', $date);
	$ampm = date('A', $date);
		
	$month_selection_array = $utilities->month_selections($month);
	
	$zero_selected = $one_selected = $two_selected = $three_selected = "";
	
	switch($minute) {
		case "00":
			$zero_selected = "selected";
		break;
		case "15":
			$one_selected = "selected";
		break;
		case "30":
			$two_selected = "selected";
		break;
		case "45":
			$three_selected = "selected";
		break;			
	}
	 
	$am = $pm = "";
	
	switch($ampm) {
		case "AM":
			$am = "selected";
		break;
		case "PM":
			$pm = "selected";
		break;
	}
	
	$sixteen = $seventeen = "";
	switch($year) {
		case "2016":
			$sixteen = "selected";
		break;
		case "2017":
			$seventeen = "selected";
		break;
	}

	//add warning text
	echo "<div class='main_box' style='margin-top:10px; float:left; width:100%;'>";
	
	echo "<div style='float:left; width:100%; margin-bottom:0px; text-align:center;'>";
		echo "<h3>Interview</h3>";
		echo "<h4>".$first_name." ".$last_name."</h4>";
	echo "</div>";
	
	echo "<div id='interview_holder' style='float:left; width:100%; margin-left:2px; margin-right:5px'>";

		if ($status == "Past") {
			echo "<h4 style='color:red'>The date for this interview has passed.</h4>";						
		} elseif ($status == "canceled") {
			echo "<h4 style='color:red'>This interview was canceled.</h4>";	
			echo "<h4 style='color:red'>The interview was scheduled with " .$first_name." ".$last_name."</b> on ".$month."/".$day."/".$year." at ".$hour.":".$minute." ".$ampm."</h4>";			
											
		} else {
			echo "<h4 style='margin-bottom:0px'>You have an upcoming interview with " .$first_name." ".$last_name."</b> on ".$month."/".$day."/".$year." at ".$hour.":".$minute." ".$ampm."</h4>";			
			echo "<i>Reminders are sent 3 days before the interview and one day before.</i>";
			echo "<br /> &nbsp; <br />";
			echo "<b>NOTE:</b> It is your responsibility to call the candidate to schedule the interview.<br />";
		}	
	
		echo "<div class='green_button show_edit' style='width:200px; margin-top:10px; margin-left:5px; cursor:pointer;'>";
			echo "<span style='margin-left:8px; vertical-align: middle; font-size:18px'>Edit Interview Date</span>";
		echo "</div>";
	
	echo "</div>";
	
	echo "<div id='edit_holder' style='display:none; float:left; width:100%; margin-left:5px;'>";	
		echo "<div id='date_error' class='warning' style='color:red; display:none'>Oops, you didn't enter a valid date</div>";
		echo "<h4>Have you called ".$first_name." ".$last_name." to reschedule the interview?</h4>";
		
		echo "&#8226 If you change the interview date, we will send the candidate email reminders as the interview date approaches.<br />";
		echo "&#8226 The interview reminder allows the candidate to easily cancel the interview with one click.<br />";
		echo "&#8226 You will be emailed immediately if the candidate cancels.<br />";
		echo "&nbsp; <br />";
		
		echo "<b>Send New Interview Reminder</b>";
		echo "<table style='margin-bottom:15px; margin-left:10px;'>";
			echo "<tr>";
				echo "<td><b>Date:</b></td>";

				echo "<td>";
					echo "<select id='month'>";
					echo "<option value=1 ".$month_selection_array['jan']." >Jan</option>";
					echo "<option value=2 ".$month_selection_array['feb']." >Feb</option>";
					echo "<option value=3 ".$month_selection_array['mar']." >Mar</option>";
					echo "<option value=4 ".$month_selection_array['apr']." >Apr</option>";
					echo "<option value=5 ".$month_selection_array['may']." >May</option>";
					echo "<option value=6 ".$month_selection_array['jun']." >June</option>";
					echo "<option value=7 ".$month_selection_array['jul']." >July</option>";
					echo "<option value=8 ".$month_selection_array['aug']." >Aug</option>";
					echo "<option value=9 ".$month_selection_array['sep']." >Sep</option>";
					echo "<option value=10 ".$month_selection_array['oct']." >Oct</option>";
					echo "<option value=11 ".$month_selection_array['nov']." >Nov</option>";
					echo "<option value=12 ".$month_selection_array['dec']." >Dec</option>";
					echo "</select>";
		
					echo "<select id='day'>";
						$day_count = 1;
						while($day_count <= 31) {
							if ($day == $day_count) {
								$day_selected = "selected";
							} else {
								$day_selected = "";
							}
							echo "<option value=".$day_count." ".$day_selected." >".$day_count."</option>";
							$day_count++;
						}
					echo "</select>";
		
					echo "<select id='year'>";
						echo "<option value=2016 ".$sixteen." >2016</option>";
						echo "<option value=2017 ".$seventeen." >2017</option>";
					echo "</select></td>";
				echo "</tr>";
				
				echo "<tr>";
					echo "<td><b>Time:</b></td>"; 
					echo "<td><select id='hour'>";
						$hour_count = 1;
						while($hour_count <= 12) {
							if ($hour == $hour_count) {
								$hour_selected = "selected";
							} else {
								$hour_selected = "";
							}
							
							echo "<option value=".$hour_count.">".$hour_count."</option>";
							$hour_count++;
						}		
					echo "</select>:";
					
					echo "<select id='minute'>";
						echo "<option value='00' $zero_selected >00</option>";
						echo "<option value='15' $one_selected >15</option>";
						echo "<option value='30' $two_selected >30</option>";
						echo "<option value='45' $three_selected >45</option>";
					echo "</select>";
					echo "<select id='ampm'>";
						echo "<option value='AM' $am >AM</option>";
						echo "<option value='PM' $pm >PM</option>";
					echo "</select></td>";
				echo "</tr>";
			echo "</table>";
		
		echo "<div class='green_button save_edit' id='".$interviewID."'>";
			echo "<img src='images/savegreen.png'  style='width:25px;height:25px;vertical-align:middle'>";
			echo "<span style='margin-left:8px; vertical-align: middle; font-size:18px'>Save</span>";
		echo "</div>";
		echo "<input type='hidden' id='interviewID' value='".$interviewID."'>";
		echo "<input type='hidden' id='matchID' value='".$matchID."'>";

		if ($status != "Past" && $status != "canceled") {
			echo "<br /><br /><a href='#' id='cancel_interview'><h4>I'd like to cancel the interview.</h4></a>";
		}
		
		echo "<br /><a href='#' class='cancel_edit'>CANCEL</a>";
	echo "</div>";
	
	echo "<div id='edit_complete' style='display:none; text-align:center;'>";
		echo "<h2>Interview Edit Saved</h2>";
	echo "</div>";	
	
	echo "<div id='cancel_warning' style='float:left; width:100%; margin-left:3px; display:none'>";
		echo "<h2>Are you sure you want to cancel this interview?</h2>";
		echo "<h4>We will no longer send them reminders</h4>";
		
		echo "<div class='red_button save_interview_cancel' id='".$matchID."' style='width:175px;'>";
			echo "<span style='margin-left:8px; vertical-align: middle; font-size:18px;'>Cancel Interview</span>";
		echo "</div><br />";
		echo "&nbsp; <br />";
		echo "<a href='#' id='cancel_interview_cancel'>BACK</a>";
	echo "</div>";
	
	echo "<div id='cancel_complete' style='float:left; width:100%; text-align:center; display:none'>";
		echo "<br /><h3>Cancellation Saved</h3>";
		echo "<h4>Note:  Be sure to call your candidate to let them know of the change.<h4>";
	echo "</div>";		
	
	echo "</div>";	
}	

function recommender_details_mobile_html($recommendation) {	

	if ($recommendation != "NA" && $recommendation != "") {

			if ($recommendation['experience']['hospitality'] > 0) {
				$experience_text = " who has <b>".$recommendation['experience']['hospitality']." yrs of Hospitality Experience</b>.  ";
			} elseif ($recommendation['experience']['other'] > 0) {
				$experience_text = " who has ".$recommendation['experience']['other']." yrs of general experience.  ";		
			} else {
				$experience_text = ".  ";
			}

			if (count($recommendation['current']) > 0) {
				$current_text = "The job reference is currently employed at <b>";
				$count = 1;
				foreach ($recommendation['current'] as $row) {
					if ($count > 1) {
						$current_text .= " and ";
					}
					$current_text .= $row['company']." as ".$row['position'];
					$count++;
				}
				$current_text .= "</b>.  ";
			} else {
				$current_text = "";
			}
			
			if ($recommendation['coworker'] == 'Y' && $recommendation['employer'] == 'Y') {
				$relation_text = "This job reference comes from a past employee of yours who has worked with this candidate";
			} elseif ($coworker == 'Y') {
				$relation_text = "This job reference comes from a coworker of the candidate";		
			} elseif ($employer == 'Y') {
				$relation_text = "This job reference comes from a past employee of yours";				
			} else {
				$relation_text = "This job reference comes from an SBC member";
			}

			//echo "<div style='float:left; width:90%; padding-left:5px; padding-top:5px; padding-bottom:5px; background-color:#e9e6de; border-style:solid; border-color:#760006; border-width:3px; margin-top:0px; border-radius:20px; margin-bottom:10px'>";
			echo "<div style='float:left; width:100%; padding-left:10px; padding-top:5px; padding-bottom:5px; background-color:#e9e6de; border-top: solid #760006 3px; border-bottom: solid #760006 3px;  margin-top:-3px;  margin-bottom:10px'>";

				echo "<a href='#' class='view_reference'><img src='images/receivedreferral.png' height='50px' width='50px' alt='recommendation' style='vertical-align:middle;'></a> &nbsp; ";

				echo "<h4 style='display:inline'><a href='#' class='view_reference'>View Recommendation</a></h4>";

				echo "<div id='recommendation_summary_holder' style='float:left; width:95%; padding-left:5%; padding-right:5%; margin-bottom:10px; color:#760006; display:none'>";
					echo "<div style='float:left; width:90%; margin-bottom:10px'><h4>".$recommendation['firstname']." ".$recommendation['lastname']." has recommended this candidate.</h4>";
						echo $relation_text;
						echo $experience_text;
						echo $current_text;
				echo "</div>";
				
			echo "</div>";
		echo "</div>";
	}
}

function candidate_notes_mobile_html($first_name, $last_name, $photo, $notes, $notes_raw) {	

/*
		if ($photo != "") {
			$photo = "<img src='images/profile_pics/".$photo."' height='75px' width='75px' alt='profile_pic'>";
		} else {
			$photo = "<span style='margin-top:25px;'>&nbsp; <br /> &nbsp; <br /> &nbsp; &nbsp; <b>NO PHOTO</b></span>";
		}	
*/
	
	echo "<div class='main_box' style='margin-top:50px; ;'>";
		
	echo "<div style='float:left; width:100%; text-align:center; '>";
		echo "<h3>Candidate Notes</h3>";
		echo "<h4>".$first_name." ".$last_name."</h4>";
	echo "</div>";
	
	echo "<div id='notes_summary' style='float:left; width:100%;'>";
		
/*
		echo "<div style='float:left; width:100%; margin-top:5px;'>";
		
			echo "<div style='float:left; width:25%;'>";
				echo $photo;
			echo "</div>";

			echo "<div style='float:left; width:75%; margin-top:5px'>";			
				if ($notes['update_date'] != "") {
					echo "Notes Updated:  ".$notes['update_date']."<br />";				
				}
			echo "</div>";
		echo "</div>";
*/
				
		echo "<div style='float:left; width:100%;'>";
				if ($notes['update_date'] != "") {
					echo "Notes Updated:  ".$notes['update_date']."<br />";				
				}
		
				echo "<div style='float:left; width:32%; padding-top:2px; margin-right:5px; margin-left:3px;'>";
					echo "<div style='width:100%; float:left; padding-top:7px; padding-bottom:7px; border-radius:2px; border-style:solid; border-width:2px; border-color:#a9a9a9; text-align:center'>";
						echo "COMPANY FIT<br />";
						if ($notes['culture'] == "") {
							echo "<i>NA</i>";
						} else {
							echo $notes['culture'];							
						}
					echo "</div>";
				echo "</div>";
				
				echo "<div style='float:left; width:31%; padding-top:2px; margin-right:5px;'>";
					echo "<div style='width:100%; float:left; padding-top:7px; padding-bottom:7px; border-radius:2px; border-style:solid; border-width:2px; border-color:#a9a9a9; text-align:center'>";
						echo "EXPERIENCE<br />";
						if ($notes['experience'] == "") {
							echo "<i>NA</i>";
						} else {
							echo $notes['experience'];							
						}
					echo "</div>";
				echo "</div>";

				echo "<div style='float:left; width:30%; padding-top:2px; margin-right:3px;'>";
					echo "<div style='width:100%; float:left; padding-top:7px; padding-bottom:7px; border-radius:2px; border-style:solid; border-width:2px; border-color:#a9a9a9; text-align:center'>";
						echo "AVAILABILITY<br />";
						if ($notes['availability'] == "") {
							echo "<i>NA</i>";
						} else {
							echo $notes['availability'];							
						}
					echo "</div>";
				echo "</div>";			
			echo "</div>";		
		
		echo "<div style='float:left; width:100%; margin-top:10px; '>";

		echo "<h4 style='text-align:center; margin-bottom:2px;'>GENERAL NOTES</h4>";
			echo "<div style='width:90%; margin-left:15px; margin-right:15px;'>";
				if ($notes['notes'] == "") {
					echo "<i>None Added</i><br />";						
				} else {
					echo "<i>".$notes['notes']."</i><br />";
				}
		echo "</div>";

		echo "<div class='green_button' id='show_edit_notes' style='float:left; margin-left:10px; margin-top:15px;'>";
			echo "<img src='images/addplussigngreen.png'  style='width:25px;height:25px;vertical-align:middle'>";
			echo "<span style='margin-left:8px; vertical-align:middle; font-size:18px'>Edit Notes</span>";
		echo "</div>";
	echo "</div>";

	echo "</div>";
	echo "</div>";
		
		//dermine selected
		$culture_na = $culture_poor = $culture_neutral = $culture_good = $culture_great = "";

		switch($notes_raw['culture']) {
			case "NA":
				$culture_na = "selected";
			break;			
			case "Poor":
				$culture_poor = "selected";
			break;
			case "Neutral":
				$culture_neutral = "selected";
			break;
			case "Good":
				$culture_good = "selected";
			break;
			case "Great":
				$culture_great = "selected";
			break;		
		}
		
		$experience_na = $experience_poor = $experience_neutral = $experience_good = $experience_great = "";
		switch($notes_raw['experience']) {
			case "NA":
				$experience_na = "selected";
			break;			
			case "Poor":
				$experience_poor = "selected";
			break;
			case "Neutral":
				$experience_neutral = "selected";
			break;
			case "Good":
				$experience_good = "selected";
			break;
			case "Great":
				$experience_great = "selected";
			break;		
		}
		
		$availability_na = $availability_poor = $availability_neutral = $availability_good = $availability_great = "";
		switch($notes_raw['availability']) {
			case "NA":
				$availability_na = "selected";
			break;			
			case "Poor":
				$availability_poor = "selected";
			break;
			case "Neutral":
				$availability_neutral = "selected";
			break;
			case "Good":
				$availability_good = "selected";
			break;
			case "Great":
				$availability_great = "selected";
			break;		
		}
		
		
		echo "<div id='edit_notes_form' style='float:left; width:100%; display:none'>";
				
/*
		echo "<div style='float:left; width:100%; margin-top:5px;'>";
		
			echo "<div style='float:left; width:25%;'>";
				echo $photo;
			echo "</div>";

			echo "<div style='float:left; width:75%; margin-top:5px'>";			
				echo "<h4 style='margin-bottom:2px;'>".$first_name." ".$last_name."</h3>";
				echo "Notes Updated:  ".$notes['update_date']."<br />";
			echo "</div>";
		echo "</div>";
*/

		echo "<div style='float:left; width:100%;'>";
				echo "<div style='float:left; width:32%; padding-top:2px; margin-right:5px; margin-left:3px;'>";
					echo "<div style='width:100%; float:left; padding-top:7px; padding-bottom:7px; border-radius:2px; border-style:solid; border-width:2px; border-color:#a9a9a9; text-align:center'>";
						echo "CULTURAL FIT<br />";
						echo "<select id='culture'>";
							echo "<option value='NA' $culture_na>NA</option>";
							echo "<option value='Poor' $culture_poor>Poor</option>";
							echo "<option value='Neutral' $culture_neutral>Neutral</option>";
							echo "<option value='Good' $culture_good>Good</option>";
							echo "<option value='Great' $culture_great>Great</option>";
						echo "<select>";
					echo "</div>";
				echo "</div>";
				
				echo "<div style='float:left; width:31%; padding-top:2px; margin-right:5px;'>";
					echo "<div style='width:100%; float:left; padding-top:7px; padding-bottom:7px; border-radius:2px; border-style:solid; border-width:2px; border-color:#a9a9a9; text-align:center'>";
						echo "EXPERIENCE<br />";
						echo "<select id='experience'>";
							echo "<option value='NA' $experience_na>NA</option>";
							echo "<option value='Poor' $experience_poor>Poor</option>";
							echo "<option value='Neutral' $experience_neutral>Neutral</option>";
							echo "<option value='Good' $experience_good>Good</option>";
							echo "<option value='Great' $experience_great>Great</option>";
						echo "<select>";
					echo "</div>";
				echo "</div>";

				echo "<div style='float:left; width:31%; padding-top:2px; margin-right:3px;'>";
					echo "<div style='width:100%; float:left; padding-top:7px; padding-bottom:7px; border-radius:2px; border-style:solid; border-width:2px; border-color:#a9a9a9; text-align:center'>";
						echo "AVAILABILITY<br />";
						echo "<select id='availability'>";
							echo "<option value='NA' $availability_na>NA</option>";
							echo "<option value='Poor' $availability_poor>Poor</option>";
							echo "<option value='Neutral' $availability_neutral>Neutral</option>";
							echo "<option value='Good' $availability_good>Good</option>";
							echo "<option value='Great' $availability_great>Great</option>";
						echo "<select>";
					echo "</div>";
				echo "</div>";			
			echo "</div>";		
		
		echo "<div style='float:left; width:100%; margin-top:10px;'>";

		echo "<h4 style='text-align:center'>General Notes</h4>";
			echo "<div style='width:90%; margin-left:5px; margin-right:5px;'>";
				echo "<textarea id='general_notes' style='width:100%' rows='3'>".$notes['notes']."</textarea><br />";
		echo "</div>";
				
		echo "<input type='hidden' id='matchID' value=".$notes['matchID'].">";
		echo "<input type='hidden' id='notesID' value=".$notes['ID'].">";
		
		echo "<div class='green_button' id='save_notes' style='margin-top:15px; margin-left:5px;'>";
			echo "<img src='images/savegreen.png'  style='width:25px;height:25px;vertical-align:middle'>";
			echo "<span style='margin-left:8px; vertical-align:middle; font-size:18px'>Save Notes</span>";
		echo "</div>";
			
		echo "&nbsp; <br /><br />&nbsp; <a href='#' id='cancel_notes'>CANCEL</a>";
		echo "</div>";
	echo "</div>";
}

function candidate_interview_none_mobile_html($first_name, $last_name) {
	echo "<div class='main_box' style='margin-top:50px; ;'>";
		
	echo "<div style='float:left; width:100%; text-align:center; '>";
		echo "<h3>Candidate Notes & Interview</h3>";
		echo "<h4>".$first_name." ".$last_name."</h4>";
	echo "</div>";

		echo "<h4 style='margin-left:3px'>Candidate Notes & Interview Reminders only available for Bounty Job Posts.</h4>";

		echo "<div style='float:left; width:100%; text-align:center'>";
			echo "<a href='job.php?ID=new_job'><div class='green_button choice' id='bounty_final' style='float:left; width:98%; text-align:center'>";
				echo "<img src='images/savegreen.png' style='width:25px;height:25px;vertical-align:middle'>";
				echo "<span style='margin-left:10px; vertical-align:middle;'>Post a Bounty Job!</span>";
			echo "</div></a>";
		echo "</div>";
		
		echo "<div style='float:left; width:100%; text-align:center;'>";
			echo "<i>Bounty Posts help support the ServeBartendCook community</i><br />";
			echo "<a href='main.php?page=bounty_summary'>Learn More About Bounty Job Posts</a>";
		echo "</div>";
				
	echo "</div>";
}				


?>