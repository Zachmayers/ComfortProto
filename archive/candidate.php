<?php
//======================
//
//   Candidate Page - This is the page that displays when an employer views an employee interested in their job post
//
//======================

//Required Class files
	require_once('classes/candidate.class.php');	
	require_once('classes/job.class.php');	
	require_once('classes/utilities.class.php');	

//Required HTML files
	require_once('html/candidate_html.php');	
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
	$js_file = "<script type='text/javascript' src='js/candidate.js?v=".$version."'></script>";

	$general_content = new General_Content;
	
// display header, with name, type, and required javascript file
	//if user is logged in display, if not, display warning page
	if (isset($_SESSION['userID'])) {
						
		//Test if valid viewer
		$matchID = $_GET['matchID'];
		$candidate = new Candidate($_GET['matchID']);

		$display = $candidate->legal_view_test($_GET['ID']);
		
		if ($_GET['type'] != "printer" && $display == "valid") {
			$general_content->html_top("profile_employee", $js_file);				
		} elseif ($display == "invalid") {
			$general_content->html_top("profile_employee", $js_file);							
		}

		switch($display) {						
			case "valid":
				$page = $_GET['page'];
				$candidate_data = $candidate->get_candidate();

				//determine if this is a paid bounty job
				$jobID = $candidate->get_jobID();
				$job = new Job($jobID);
				$job_data = $job->get_job_data(array('general'));
				$post_type = $job_data['general']['post_type'];				
				
				$count = 0;
				//get total hospitality experience & other experience
				$past_employment = $candidate_data['employee_data']['employment'];
				$total_experience = array();
				$hospitality_holder = array();
				$other_holder = array();	
				$unknown_holder = array();	
							
				$flat_employmentID_holder = array(); //use this to double check skills

				foreach($past_employment as $row) {
					//echo var_dump($row);
						if ($row['category'] == "other") {
							$other_holder[] = $row;
						} elseif ($row['category'] == "") {						
							$unknown_holder[] = $row;	
						} else {
							$hospitality_holder[] = $row;							
						}
						
						$flat_employmentID_holder[] = $row['ID'];	
				}

				$total_experience['other'] = $utilities->determine_years_of_experience($other_holder);
				$total_experience['unknown'] = $utilities->determine_years_of_experience($unknown_holder);
				$total_experience['hospitality'] = $utilities->determine_years_of_experience($hospitality_holder);
				$total_experience['total'] = $total_experience['other'] + $total_experience['unknown'] + $total_experience['hospitality'];

				if ($candidate_data['employee_data']['experience_overwrite'] != "NA") {
					$total_experience['total'] = $candidate_data['employee_data']['experience_overwrite']['total'];
					$total_experience['hospitality'] = $candidate_data['employee_data']['experience_overwrite']['hospitality'];
				}
							//echo var_dump($total_experience);
				
				
				//get experience related to specific skills, workplace types
/*
				$experience = 0;
				$store_type = $utilities->general_store_types;
				$employee_store_type_experience = array();
				foreach($store_type as $row) {
					$test_holder = array();
					foreach($past_employment as $employment) {
						if ($employment['business_type'] == $row) {
							$test_holder[] = $employment;
						}
					}

					$experience = $utilities->determine_years_of_experience($test_holder);
					if ($experience > 0) {
						$employee_store_type[$row] = $experience;
					}
				}
*/
				
				//get experience related to specific positions
				$experience = 0;
				$unique_positions = $utilities->get_unique_array_values($past_employment, 'position');
				$employee_position_experience = array();
				foreach($unique_positions as $row) {
					$test_holder = array();
					foreach($past_employment as $employment) {
						if ($employment['position'] == $row) {
							$test_holder[] = $employment;
						}
					}

					$employee_position_experience[$row] = $utilities->determine_years_of_experience($test_holder);
				}

				//get experience related to specific skills
				//thos one is a little tricker, first we need to group the skills
				$experience = 0;

				$sub_skill_array = array();
				$usable_skill_array = array();
				foreach($candidate_data['employee_data']['skills']['sub_skills'] as $row) {
					foreach($row as $inner_row) {
						//remove old skills not attached to a job
						if ($inner_row['employmentID'] > 0 && in_array($inner_row['employmentID'], $flat_employmentID_holder)) {
							$sub_skill_array[] = $inner_row['sub_skill'];
							$usable_sklll_array[] = $inner_row;
						}		
					}
				}
				$unique_skills = array_unique($sub_skill_array);
				$employee_skills_experience = array();
				$old_employee_skills = array();
				
				foreach($unique_skills as $row) {
					
					$test_holder = array();

					foreach($usable_sklll_array as $skill) {

						if ($skill['sub_skill'] == $row) {
							//get employment data for attached skill
							foreach($past_employment as $employment) {
								if($employment['ID'] == $skill['employmentID']) {
									$test_holder[] = $employment;
								}
							}
							
							if ($skill['employmentID'] == 0) {
								$old_employee_skills[] = $row;
							}
						}
					}
					$experience = $utilities->determine_years_of_experience($test_holder);
					$employee_skills_experience[$row] = $experience;
				}
				
				//get employe skills that were from the old style, not attached to any job		
				
				//In case of an old profile, create a new description based on descriptons of old skills
/*
				if ($candidate_data['general']['description'] == "") {
					if (count($candidate_data['employee_data']['skills']['skills']) > 0) {
						foreach($candidate_data['employee_data']['skills']['skills'] as $row) {
							if ($row['description'] != "") {
								$candidate_data['general']['description'] .= "<b>".$row['skill']."</b> - ".$row['description']."<br />&nbsp; <br />";
							}
						}
					}
				}				
*/

				if (count($employee_skills_experience) > 1) {
					arsort($employee_skills_experience);
				}
				
				if (count($employee_position_experience) > 1) {
					arsort($employee_position_experience);
				}							

				switch($page) {
					
					default:
					//log candidate as viewed by employer
						$candidate->candidate_viewed($matchID, $candidate_data['candidate_response']['jobID']);
						
						if ($_GET['type'] == "printer") {
							$job = new Job($candidate_data['candidate_response']['jobID']);
							$job_data = $job->get_job_data(array('general', 'store'));
							candidate_printer_html($candidate_data, $job_data);	
						}else if ($candidate_data['general']['temp'] == "Y") {
							candidate_resume_html($candidate_data, $total_experience);											
?>
							<script>
								$(document).ready(function() {		
									var profileID = "<? echo $_GET['ID'] ?>";
									var matchID = "<? echo $_GET['matchID'] ?>";
									var highlight = "<? echo $candidate_data['candidate_response']['highlight'] ?>";
									var resume = "<? echo $candidate_data['general']['resume'] ?>";

									candidate(profileID, highlight, matchID, resume);									
								})
							</script>
<?php
						} else {
							candidate_html($candidate_data, $total_experience, $employee_store_type, $employee_position_experience, $employee_skills_experience, $old_employee_skills, $post_type);
							//loader_box();								
?>
							<script>
								$(document).ready(function() {		
									var profileID = "<? echo $_GET['ID'] ?>";
									var matchID = "<? echo $_GET['matchID'] ?>";
									var highlight = "<? echo $candidate_data['candidate_response']['highlight'] ?>";
									var resume = "<? echo $candidate_data['general']['resume'] ?>";
									
									candidate(profileID, highlight, matchID, resume);									
								})
							</script>
<?php
					}
				break;
				
				case "past_replies":
					$general_array = $candidate_data['general'];
					candidate_past_replies_html($general_array, $candidate_data, 'current');					
				break;
				
				case "archive_replies":
					$general_array = $candidate_data['general'];
					$archive_data = $candidate->get_archived_reply();
					candidate_past_replies_html($general_array, $archive_data, 'archive');					
				break;
																
			}
						
			break;
			
			case "invalid":
				$general_content->illegal_view();		
			break;		
		}			
		
	} else {
		$general_content->login_warning_page();	
	}	
	
	if ($_GET['type'] != "printer") {
		$general_content->html_footer();
	}
?>