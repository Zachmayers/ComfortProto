<?php
	require_once('classes/utilities.class.php');
	require_once('classes/candidate.class.php');
	require_once('html/profile_html.php');

error_reporting(1);

	$utilities = new Utilities;
	

	$candidate = new Candidate('NA');
	$version = $utilities->version;	
	
	//Test to see if public hash and jobID match, then check if job is expired or filled
	$valid_page = $candidate->public_view_test($_GET['ID'], $_GET['hash']);

	if ($valid_page == "true") {
		
 		$candidate->log_public_view($_GET['ID']);

		$profile_data = $candidate->get_public_data($_GET['ID']);


		$count = 0;
		//get total hospitality experience & other experience
		$past_employment = $profile_data['employee_data']['employment'];
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

		if ($profile_data['employee_data']['experience_overwrite'] != "NA") {
			$total_experience['total'] = $profile_data['employee_data']['experience_overwrite']['total'];
			$total_experience['hospitality'] = $profile_data['employee_data']['experience_overwrite']['hospitality'];
		}
				
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
		foreach($profile_data['employee_data']['skills']['sub_skills'] as $row) {
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
								

		if (count($employee_skills_experience) > 1) {
			arsort($employee_skills_experience);
		}
		
		if (count($employee_position_experience) > 1) {
			arsort($employee_position_experience);
		}	

		public_candidate_full_header_html($profile_data);
		public_candidate_html($profile_data, $total_experience, $employee_store_type, $employee_position_experience, $employee_skills_experience, $old_employee_skills);	
?>
		<script>
			$(document).ready(function() {
				candidateID = '<? echo $_GET['ID'] ?>';
				public_candidate(candidateID);		
			});
		</script>
<?php																										
	} else {
		public_candidate_page_warning($profile_data);
	}
?>