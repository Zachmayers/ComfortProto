<?php
	function job_template_html($template_data, $question_data, $requirement_data) {	
		$job_data = $template_data['jobs'];
		$sub_skills_data = $template_data['skills'];
		$requirements_index = $template_data['requirements_index'];
		$questions_index = $template_data['question_index'];
			
		echo "<a href='admin.php?page=new_job_template'>ADD TEMPLATE</a><br />";
		echo "<h2>Kitchen Template</h2>";
		foreach($job_data as $row) {
			if ($row['main_skill'] == "Kitchen"){
				echo "<b>Title:</b>  ".$row['title']."<br />";
				echo "<b>Schedule:</b>  ".$row['schedule']."<br />";
				echo "<b>Pay Type:</b>  ".$row['views']."<br />";
				echo "<b>Skills:  </b><br />";
				foreach($sub_skills_data as $sub_skill) {
					if ($row['templateID'] == $sub_skill['templateID']) {
						echo "&nbsp; &nbsp; ".$sub_skill['sub_skill']."<br />";
					}					
				}
				echo "<b>Requirements:  </b><br />";
				foreach($requirements_index as $index) {
					if ($row['templateID'] == $index['templateID']) {
						foreach ($requirement_data as $requirement) {
							if($requirement['reqID'] == $index['reqID']) {
								echo "&nbsp; &nbsp; ".$requirement['requirement']."<br />";
							}
						}
					}					
				}
				echo "<b>Questions:  </b><br />";
				foreach($questions_index as $index) {
					if ($row['templateID'] == $index['templateID']) {
						foreach ($question_data as $question) {
							if($question['questionID'] == $index['questionID']) {
								echo "&nbsp; &nbsp; ".$question['question']."<br />";
							}
						}
					}					
				}
				
				echo "<a href='admin.php?page=edit_template&ID=".$row['templateID']."'>Edit Template</a><br />";
				echo "<hr><br />";
			}
		}

		echo "<h2>Server Template</h2>";
		foreach($job_data as $row) {
			if ($row['main_skill'] == "Server"){
				echo "<b>Title:</b>  ".$row['title']."<br />";
				echo "<b>Schedule:</b>  ".$row['schedule']."<br />";
				echo "<b>Pay Type:</b>  ".$row['views']."<br />";
				echo "<b>Skills:  </b><br />";
				foreach($sub_skills_data as $sub_skill) {
					if ($row['templateID'] == $sub_skill['templateID']) {
						echo "&nbsp; &nbsp; ".$sub_skill['sub_skill']."<br />";
					}					
				}
				echo "<b>Requirements:  </b><br />";
				foreach($requirements_index as $index) {
					if ($row['templateID'] == $index['templateID']) {
						foreach ($requirement_data as $requirement) {
							if($requirement['reqID'] == $index['reqID']) {
								echo "&nbsp; &nbsp; ".$requirement['requirement']."<br />";
							}
						}
					}					
				}
				echo "<b>Questions:  </b><br />";
				foreach($questions_index as $index) {
					if ($row['templateID'] == $index['templateID']) {
						foreach ($question_data as $question) {
							if($quesion['questionID'] == $index['questionID']) {
								echo "&nbsp; &nbsp; ".$question['question']."<br />";
							}
						}
					}					
				}
				
				echo "<a href='admin.php?page=edit_template&ID=".$row['templateID']."'>Edit Template</a><br />";
				echo "<hr><br />";
			}
		}

		echo "<h2>Bartender Template</h2>";
		foreach($job_data as $row) {
			if ($row['main_skill'] == "Bartender"){
				echo "<b>Title:</b>  ".$row['title']."<br />";
				echo "<b>Schedule:</b>  ".$row['schedule']."<br />";
				echo "<b>Pay Type:</b>  ".$row['views']."<br />";
				echo "<b>Skills:  </b><br />";
				foreach($sub_skills_data as $sub_skill) {
					if ($row['templateID'] == $sub_skill['templateID']) {
						echo "&nbsp; &nbsp; ".$sub_skill['sub_skill']."<br />";
					}					
				}
				echo "<b>Requirements:  </b><br />";
				foreach($requirements_index as $index) {
					if ($row['templateID'] == $index['templateID']) {
						foreach ($requirement_data as $requirement) {
							if($requirement['reqID'] == $index['reqID']) {
								echo "&nbsp; &nbsp; ".$requirement['requirement']."<br />";
							}
						}
					}					
				}
				echo "<b>Questions:  </b><br />";
				foreach($questions_index as $index) {
					if ($row['templateID'] == $index['templateID']) {
						foreach ($question_data as $question) {
							if($quesion['questionID'] == $index['questionID']) {
								echo "&nbsp; &nbsp; ".$question['question']."<br />";
							}
						}
					}					
				}
				
				echo "<a href='admin.php?page=edit_template&ID=".$row['templateID']."'>Edit Template</a><br />";
				echo "<hr><br />";
			}
		}

		echo "<h2>Manager Template</h2>";
		foreach($job_data as $row) {
			if ($row['main_skill'] == "Manager"){
				echo "<b>Title:</b>  ".$row['title']."<br />";
				echo "<b>Schedule:</b>  ".$row['schedule']."<br />";
				echo "<b>Pay Type:</b>  ".$row['views']."<br />";
				echo "<b>Skills:  </b><br />";
				foreach($sub_skills_data as $sub_skill) {
					if ($row['templateID'] == $sub_skill['templateID']) {
						echo "&nbsp; &nbsp; ".$sub_skill['sub_skill']."<br />";
					}					
				}
				echo "<b>Requirements:  </b><br />";
				foreach($requirements_index as $index) {
					if ($row['templateID'] == $index['templateID']) {
						foreach ($requirement_data as $requirement) {
							if($requirement['reqID'] == $index['reqID']) {
								echo "&nbsp; &nbsp; ".$requirement['requirement']."<br />";
							}
						}
					}					
				}
				echo "<b>Questions:  </b><br />";
				foreach($questions_index as $index) {
					if ($row['templateID'] == $index['templateID']) {
						foreach ($question_data as $question) {
							if($quesion['questionID'] == $index['questionID']) {
								echo "&nbsp; &nbsp; ".$question['question']."<br />";
							}
						}
					}					
				}
				
				echo "<a href='admin.php?page=edit_template&ID=".$row['templateID']."'>Edit Template</a><br />";
				echo "<hr><br />";
			}
		}

		echo "<h2>Host Template</h2>";
		foreach($job_data as $row) {
			if ($row['main_skill'] == "Host"){
				echo "<b>Title:</b>  ".$row['title']."<br />";
				echo "<b>Schedule:</b>  ".$row['schedule']."<br />";
				echo "<b>Pay Type:</b>  ".$row['views']."<br />";
				echo "<b>Skills:  </b><br />";
				foreach($sub_skills_data as $sub_skill) {
					if ($row['templateID'] == $sub_skill['templateID']) {
						echo "&nbsp; &nbsp; ".$sub_skill['sub_skill']."<br />";
					}					
				}
				echo "<b>Requirements:  </b><br />";
				foreach($requirements_index as $index) {
					if ($row['templateID'] == $index['templateID']) {
						foreach ($requirement_data as $requirement) {
							if($requirement['reqID'] == $index['reqID']) {
								echo "&nbsp; &nbsp; ".$requirement['requirement']."<br />";
							}
						}
					}					
				}
				echo "<b>Questions:  </b><br />";
				foreach($questions_index as $index) {
					if ($row['templateID'] == $index['templateID']) {
						foreach ($question_data as $question) {
							if($quesion['questionID'] == $index['questionID']) {
								echo "&nbsp; &nbsp; ".$question['question']."<br />";
							}
						}
					}					
				}
				
				echo "<a href='admin.php?page=edit_template&ID=".$row['templateID']."'>Edit Template</a><br />";
				echo "<hr><br />";
			}
		}

		echo "<h2>Bus Template</h2>";
		foreach($job_data as $row) {
			if ($row['main_skill'] == "Bus"){
				echo "<b>Title:</b>  ".$row['title']."<br />";
				echo "<b>Schedule:</b>  ".$row['schedule']."<br />";
				echo "<b>Pay Type:</b>  ".$row['views']."<br />";
				echo "<b>Skills:  </b><br />";
				foreach($sub_skills_data as $sub_skill) {
					if ($row['templateID'] == $sub_skill['templateID']) {
						echo "&nbsp; &nbsp; ".$sub_skill['sub_skill']."<br />";
					}					
				}
				echo "<b>Requirements:  </b><br />";
				foreach($requirements_index as $index) {
					if ($row['templateID'] == $index['templateID']) {
						foreach ($requirement_data as $requirement) {
							if($requirement['reqID'] == $index['reqID']) {
								echo "&nbsp; &nbsp; ".$requirement['requirement']."<br />";
							}
						}
					}					
				}
				echo "<b>Questions:  </b><br />";
				foreach($questions_index as $index) {
					if ($row['templateID'] == $index['templateID']) {
						foreach ($question_data as $question) {
							if($quesion['questionID'] == $index['questionID']) {
								echo "&nbsp; &nbsp; ".$question['question']."<br />";
							}
						}
					}					
				}
				
				echo "<a href='admin.php?page=edit_template&ID=".$row['templateID']."'>Edit Template</a><br />";
				echo "<hr><br />";
			}
		}
				
	}
	
	function edit_job_template_html($templateID, $job_data, $question_data, $requirement_data) {
		$utilities = new Utilities;
		$admin = new Admin;

		$skills_array = $job_data['skills'];
		$FOH_skills = $admin->get_job_template_skills("FOH");
		$BOH_skills = $admin->get_job_template_skills("BOH");
		$management_skills = $admin->get_job_template_skills("Management");

		$requirements_index = $job_data['requirements_index'];
		$questions_index = $job_data['question_index'];
		echo "<h2>Edit Template</h2>";

		foreach($job_data['jobs'] as $row) {
			if ($row['templateID'] == $templateID){
				$main_skill = $row['main_skill'];
				switch($row['main_skill']) {
					case "Manager":
						$sub_skill_data = $management_skills;
					break; 
					
					case "Kitchen":
						$sub_skill_data = $BOH_skills;
					break;
					
					case "Server":
						$sub_skill_data = $FOH_skills;
					break;
					
					case "Bartender":
						$sub_skill_data = $FOH_skills;
					break;
					
					case "Host":
						$sub_skill_data = $FOH_skills;
					break;
					
					case "Bus":
						$sub_skill_data = $BOH_skills;
					break; 
				}
				
			switch ($row['schedule']) {
				default:
					$full_select = "";
					$temp_select = "";
					$part_select = "";
				break;			
			
				case "Full Time":
					$full_select = "selected";
					$temp_select = "";
					$part_select = "";
				break;
				
				case "Part Time":
					$full_select = "";
					$temp_select = "";
					$part_select = "selected";
				break;

				case "Temporary":
					$full_select = "";
					$temp_select = "selected";
					$part_select = "";
				break;
			}
			
			switch ($row['pay_type']) {
				default:
					$negotiable_select = "";
					$min_select = "";
					$min_tips_select = "";
					$hourly_select = "";
					$salary_select = "";	
				break;			
			
				case "Negotiable":
					$negotiable_select = "selected";
					$min_select = "";
					$min_tips_select = "";
					$hourly_select = "";
					$salary_select = "";	
				break;
				
				case "Min Wage":
					$negotiable_select = "";
					$min_select = "selected";
					$min_tips_select = "";
					$hourly_select = "";
					$salary_select = "";	
				break;

				case "Min Wage plus Tips":
					$negotiable_select = "";
					$min_select = "";
					$min_tips_select = "selected";
					$hourly_select = "";
					$salary_select = "";	
				break;

				case "Hourly":
					$negotiable_select = "";
					$min_select = "";
					$min_tips_select = "";
					$hourly_select = "selected";
					$salary_select = "";	
				break;	
				
				case "Salary":
					$negotiable_select = "";
					$min_select = "";
					$min_tips_select = "";
					$hourly_select = "";
					$salary_select = "selected";	
				break;							
			}
				
			
				echo "<b>Title:</b>  <input type='text' id='title' value='".$row['title']."'><br />";

				echo "<b>Schedule: </b>";
				echo "<select id='schedule'>";
					echo "<option value='Full Time' $full_select >Full Time</option>";			
					echo "<option value='Part Time' $part_select >Part Time</option>";			
					echo "<option value='Temporary' $temp_select >Temporary</option>";			
				echo "</select><br />";
	
				echo "<b>Pay Type: </b>";
				echo "<select id='pay'>";
					echo "<option value='Min Wage' $min_select >Min Wage</option>";			
					echo "<option value='Min Wage Plus Tips' $min_tips_select >Min Wage Plus Tips</option>";			
					echo "<option value='Hourly' $hourly_select >Hourly</option>";			
					echo "<option value='Salary' $salary_select >Salary</option>";			
					echo "<option value='Negotiable' $negotiable_select >Negotiable</option>";			
				echo "</select><br />";

				echo "<b>Skills:  </b><br />";
				echo "<select multiple id='sub_skills' size='15'>";
					foreach($sub_skill_data as $skill) {
						$skill_selected = "";						
						foreach($skills_array as $index) {
							if($index['templateID'] == $templateID && $index['sub_skill'] == $skill['skill']) {
								$skill_selected = "selected";
							}	
						}					
					echo "<option value='".$skill['skill']."' $skill_selected>".$skill['skill']."</option>";			
				}
				echo "</select><br />";
				echo "<b>Requirements:  </b><br />";
				echo "&nbsp; <br />";
				echo "General:<br />";
				echo "<select multiple id='general_requirements' size='10'>";
					foreach($requirement_data as $requirement) {
						if($requirement['type'] == "General") {
							$req_selected = "";
							foreach($requirements_index as $index) {
								if($index['reqID'] == $requirement['reqID'] && $index['templateID'] == $templateID) {
									$req_selected = "selected";
								}
							}
						echo "<option value='".$requirement['reqID']."' $req_selected>".$requirement['requirement']."</option>";	
					}		
				}
				echo "</select><br />";
				echo "&nbsp; <br />";
				echo "Front of House:<br />";
				echo "<select multiple id='front_requirements' size='10'>";
					foreach($requirement_data as $requirement) {
						if($requirement['type'] == "Front") {
							$req_selected = "";
							foreach($requirements_index as $index) {
								if($index['reqID'] == $requirement['reqID'] && $index['templateID'] == $templateID) {
									$req_selected = "selected";
								}
							}
						echo "<option value='".$requirement['reqID']."' $req_selected>".$requirement['requirement']."</option>";	
					}		
				}
				echo "</select><br />";
				echo "&nbsp; <br />";
				echo "Back of House:<br />";
				echo "<select multiple id='back_requirements' size='10'>";
					foreach($requirement_data as $requirement) {
						if($requirement['type'] == "Back") {
							$req_selected = "";
							foreach($requirements_index as $index) {
								if($index['reqID'] == $requirement['reqID'] && $index['templateID'] == $templateID) {
									$req_selected = "selected";
								}
							}
						echo "<option value='".$requirement['reqID']."' $req_selected>".$requirement['requirement']."</option>";	
					}		
				}
				echo "</select><br />";				
				
				echo "<b>Questions:  </b><br />";
				echo "<select multiple id='questions' size='35'>";
					foreach($question_data as $question) {
						$q_selected = "";
								foreach($questions_index as $index) {							
									if($index['questionID'] == $question['questionID'] && $index['templateID'] == $templateID) {
										$q_selected = "selected";
									}
								}
						if ($question['type'] == "General" || $question['type'] == $main_skill) {								
							echo "<option value='".$question['questionID']."' $q_selected>".$question['question']."</option>";
						}			
					}
				echo "</select><br />";
				echo "<input type='text' id='pass'><br />";
				
				echo "<a href='#' id='save_template'>Save Changes</a> | <a href='#' id='delete_template'>Delete Template</a><br />";
				echo "<hr><br />";
			}
		}	
	}		

	
	function new_job_template_html($question_data, $requirement_data) {
		$utilities = new Utilities;
		$admin = new Admin;
		
		$FOH_skills = $admin->get_employee_skills("FOH");
		$BOH_skills = $admin->get_employee_skills("BOH");
		$management_skills = $admin->get_employee_skills("Management");
		
		$kitchen_skills = $BOH_skills;
		$server_skills = $FOH_skills;
		$host_skills = $FOH_skills;
		$bus_skills = $BOH_skills;
		$bar_skills = $FOH_skills;

		echo "<h2>New Job Template</h2>";
		echo "<div id='error' style='display:none; color:red;'>Data Error</div><br />";
		echo "<b>Category: </b>";
			echo "<select id='main_skill'>";
				echo "<option value='Kitchen'>Kitchen</option>";
				echo "<option value='Server'>Server</option>";
				echo "<option value='Bartender'>Bartender</option>";
				echo "<option value='Manager'>Manager</option>";
				echo "<option value='Host'>Host</option>";
				echo "<option value='Bus'>Bus</option>";	
			echo "</select><br />";
		
		echo "<b>Title: </b><input type='text' id='title'><br />";
		echo "<b>Schedule: </b>";
			echo "<select id='schedule'>";
				echo "<option value='Part Time'>Part Time</option>";
				echo "<option value='Full Time'>Full Time</option>";
				echo "<option value='Temporary'>Temporary</option>";
			echo "</select><br />";
			
		echo "<b>Pay Type: </b>";
			echo "<select id='pay'>";
				echo "<option value='Min Wage'>Min Wage</option>";
				echo "<option value='Min Wage Plus Tips'>Min Wage Plus Tips</option>";
				echo "<option value='Hourly'>Hourly</option>";
				echo "<option value='Salary'>Salary</option>";
				echo "<option value='Negotiable'>Negotiable</option>";
			echo "</select><br />";
			
		echo "<b>Sub Skills</b>";
			echo "<select multiple class='sub_skills' id='Kitchen' size='15' style='display:none'>";
			foreach ($kitchen_skills as $skill) {
				echo "<option value='".$skill['skill']."'>".$skill['skill']."</option>";			
			}
			echo "</select><br />";
			echo "<select multiple class='sub_skills' id='Server' size='15' style='display:none'>";
			foreach ($server_skills as $skill) {
				echo "<option value='".$skill['skill']."'>".$skill['skill']."</option>";			
			}
			echo "</select><br />";
			echo "<select multiple class='sub_skills' id='Bartender' size='15' style='display:none'>";
			foreach ($bar_skills as $skill) {
				echo "<option value='".$skill['skill']."'>".$skill['skill']."</option>";			
			}
			echo "</select><br />";
			echo "<select multiple class='sub_skills' id='Manager' size='15' style='display:none'>";
			foreach ($management_skills as $skill) {
				echo "<option value='".$skill['skill']."'>".$skill['skill']."</option>";			
			}
			echo "</select><br />";
			echo "<select multiple class='sub_skills' id='Host' size='15' style='display:none'>";
			foreach ($host_skills as $skill) {
				echo "<option value='".$skill['skill']."'>".$skill['skill']."</option>";			
			}
			echo "</select><br />";
			echo "<select multiple class='sub_skills' id='Bus' size='15' style='display:none'>";
			foreach ($bus_skills as $skill) {
				echo "<option value='".$skill['skill']."'>".$skill['skill']."</option>";			
			}
			echo "</select><br />";

			echo "<b>Requirements: </b>";
			echo "<select multiple id='requirements' size='15'>";
				foreach ($requirement_data as $row) {
					echo "<option value='".$row['reqID']."'>".$row['requirement']."</option>";			
				}				
			echo "</select><br />";
				
			echo "<b>Questions: </b>";
			echo "<select multiple id='questions'>";
				foreach ($question_data as $row) {
					echo "<option value='".$row['questionID']."'>".$row['question']."</option>";			
				}				
			echo "</select><br />";	
			
			echo "<input type='text' id='pass'><br />";
			
			echo 	"<a href='#' id='save_template'>Save Template</a>";	
	}
	
	function requirements_template_html($requirement_data) {
		echo "<h2>Requirements</h2>";
		echo "<a href='admin.php?page=new_requirement'>Add Requirement</a><br />";
		foreach($requirement_data as $row) {
			echo "<a href='admin.php?page=edit_requirement&id=".$row['reqID']."'>".$row['requirement']."</a><br />";
			echo " &nbsp; <br />";
		}
	}
	
	function questions_template_html($question_data) {
		$question_array = $question_data['questions'];
		$answer_array = $question_data['answers'];
		
		echo "<h2>Questions</h2>";
		echo "<a href='admin.php?page=new_question'>Add Question</a><br />";

		foreach($question_array as $row) {
			echo "<b>Question: </b> (".$row['type'].") <a href='admin.php?page=edit_question&id=".$row['questionID']."'>".$row['question']."</a><br />";
			echo "<b>Answers<br />";
				foreach($answer_array as $answer) {
					if($row['questionID'] == $answer['questionID']) {
						echo $answer['answer']."<br />";
					}
				}
			echo " &nbsp; <br />";
		}
	}
	
	function edit_requirement_template_html($reqID, $requirement_data) {
		echo "<h2>Edit Requirement</h2>";
		echo "<div id='error' style='display:none; color:red;'>Data Error</div><br />";
		
		foreach($requirement_data as $row) {
			if ($reqID == $row['reqID']) {
				echo "<b>Requirement :</b><input type='text' id='requirement' value='".$row['requirement']."'><br />";
				echo "<b>Type :</b><input type='text' id='type' value='".$row['type']."'> (General, Front, Back)<br />";
				echo "<input type='text' id='pass'><br />";
				echo "<a href='#' id='save_requirement'>Save Requirement</a> | <a href='#' id='delete_requirement'>Delete Requirement</a>";				
			}
		}
	}
	
	function edit_question_template_html($questionID, $question_array) {
		echo "<h2>Edit Question</h2>";
		foreach ($question_array['questions'] as $row) {
			if ($row['questionID'] == $questionID) {
				echo "<b>Question :</b><input type='text' id='question' value='".$row['question']."'><br />";	
				echo "<b>Type :</b><input type='text' id='type' value='".$row['type']."'><br />";				
			}
		}
		
		echo "<b>Answers</b>";
		$count = 0;

		foreach ($question_array['answers'] as $row) {
			if ($row['questionID'] == $questionID) {
				echo "<input type='text' class='answer' value='".$row['answer']."'><br />";
				$count++;
			}
		}
		
		if ($count < 5) {
			while($count < 5) {
				echo "<input type='text' class='answer'><br />";			
				$count++;
			}
		}		
		
		echo "<hr><br />";
		echo "<input type='text' id='pass'><br />";	
		echo "<a href='#' id='save_question'>Save question</a> | <a href='#' id='delete_question'>Delete Question</a>";
	}	
	
	function new_requirement_html() {
		echo "<h2>New Requirement</h2>";
		echo "<div id='error' style='display:none; color:red;'>Data Error</div><br />";
		
		echo "<b>Requirement</b><br />";
		echo "<textarea id='requirement'></textarea><br />";
		echo "<b>Type :</b><input type='text' id='type'><br />";
		echo "<input type='text' id='pass'><br />";
		echo "<a href='#' id='save_requirement'>Save Requirement</a>";
	}
	
	function new_question_html() {
		echo "<h2>New Question</h2>";
		echo "<div id='error' style='display:none; color:red;'>Data Error</div><br />";
		
		echo "<b>Question</b><br />";
		echo "<textarea id='question'></textarea><br />";
		echo "<b>Type :</b><input type='text' id='type'>(General, Kitchen, Manager, Server, Bartender, Host, Bust)<br />";			
		echo "<b>Answer A: </b><input type='text' class='answer'><br />";
		echo "<b>Answer B: </b><input type='text' class='answer'><br />";
		echo "<b>Answer C: </b><input type='text' class='answer'><br />";
		echo "<b>Answer D: </b><input type='text' class='answer'><br />";
		echo "<b>Answer E: </b><input type='text' class='answer'><br />";
		echo "&nbsp; <br />";
		echo "<input type='text' id='pass'><br />";

		echo "<a href='#' id='save_question'>Save Question</a>";
	}
	
	function employee_job_titles_html($employee_job_titles, $BOH_skills, $FOH_skills, $MGMT_skills, $GEN_skills) {
		$title_array = $employee_job_titles['job_titles'];
		$reference_array = $employee_job_titles['job_reference'];		
		
		echo "<div id='error' style='display:none; color:red'>Fields cannot be blank</div><br />";
		echo "<b>New Job Title:</b>  <input type='text' id='new_title'>";
		echo "&nbsp; &nbsp; <select id='type'>";
			echo "<option value='FOH'>FOH</option>";
			echo "<option value='BOH'>BOH</option>";
			echo "<option value='Management'>Management</option>";
		echo "</select>";
		echo "&nbsp; &nbsp; <a href='#' id='save_new_title'>SAVE TITLE</a><br />";
		
		echo "&nbsp; <br />";
		echo "&nbsp; <br />";		
		echo "<b>New Skill:</b>  <input type='text' id='new_skill'> &nbsp; &nbsp; ";
		echo "&nbsp; &nbsp; <select id='skill_type'>";
			echo "<option value='FOH'>FOH</option>";
			echo "<option value='BOH'>BOH</option>";
			echo "<option value='Management'>Management</option>";
			echo "<option value='General'>General</option>";
		echo "</select>";

		echo "&nbsp; &nbsp; <select id='rankable'>";
			echo "<option value='N'>Not Rankable</option>";
			echo "<option value='Y'>Rankable</option>";
		echo "</select>";
		
		echo " &nbsp; &nbsp; <a href='#' id='save_new_skill'>SAVE SKILL</a>";

		echo "&nbsp; <br />";
		echo "&nbsp; <br />";		
	
		echo "<h3>Job Titles</h3>";
		
		foreach($title_array as $title) {
			echo "<a href='admin.php?page=edit_employee_job_title&titleID=".$title['titleID']."'><b>".$title['title']."</b> - ".$title['type']."</a><br />";
			switch($title['type']) {
				case "FOH":
					$skills_array = $FOH_skills;
				break;
	
				case "BOH":
					$skills_array = $BOH_skills;
				break;
	
				case "Management":
					$skills_array = $MGMT_skills;
				break;				
			}

			foreach($skills_array as $skill) {

				foreach($reference_array as $ref) {
					if ($ref['skillID'] == $skill['skillID'] && $ref['titleID'] == $title['titleID']) {
						echo "&nbsp; &nbsp; ".$skill['skill']."<br />";
					}
				}
			}
			echo "&nbsp; <br />";
		}
		
		echo "<h3>FOH Skills</h3>";
			foreach($FOH_skills as $row) {
				echo "<b>".$row['skill']."</b> - Rankable: ".$row['rankable']."<br />";
			}
			
		echo "<h3>BOH Skills</h3>";
			foreach($BOH_skills as $row) {
				echo "<b>".$row['skill']."</b> - Rankable: ".$row['rankable']."<br />";
			}

		echo "<h3>Management Skills</h3>";
			foreach($MGMT_skills as $row) {
				echo "<b>".$row['skill']."</b> - Rankable: ".$row['rankable']."<br />";
			}

		echo "<h3>General Skills</h3>";
			foreach($GEN_skills as $row) {
				echo "<b>".$row['skill']."</b> - Rankable: ".$row['rankable']."<br />";
			}			

	}
	
	function employee_job_title_edit_html($job_title_data, $BOH_skills, $FOH_skills, $MGMT_skills, $GEN_skills) {
		//get some info out of the array
	
		$title = $job_title_data['job_title']['title'];
		$type = $job_title_data['job_title']['type'];
		
		$utilities = new Utilities;
		$title_skills = $job_title_data['skills'];

		$FOH = $BOH = $management = "";
		
		switch($type) {
			case "FOH":
				$FOH = "selected";
				$skills_array = $FOH_skills;
			break;

			case "BOH":
				$BOH = "selected";
				$skills_array = $BOH_skills;
			break;

			case "Management":
				$management = "selected";
				$skills_array = $MGMT_skills;
			break;
			
		}
		
		
		echo "<h2>".$title."</h2>";
		echo "<input type='hidden' id='titleID' value='".$_GET['titleID']."'>";
		echo "<div id='error' style='display:none; color:red'>Fields cannot be blank</div><br />";	
		echo "<b>Title: </b><input type='text' id='new_title' value='".$title."'><br />";
		
		echo "<b>Type: </b><select id='type'>";
			echo "<option value='FOH' ".$FOH.">FOH</option>";
			echo "<option value='BOH' ".$BOH.">BOH</option>";
			echo "<option value='Management' ".$management.">Management</option>";
		echo "</select>  <i>NOTE:  If you change the type, you will need to come back and change the skills after you save.  The skills will not update to the proper list (FOH or BOH)";
		
		echo "&nbsp; <br />";
		echo "&nbsp; <br />";
		echo "<b>Skills</b><br />";
		
		echo "<select multiple id='employee_skills' size='30'>";
		foreach($skills_array as $row) {
			$skillID = $row['skillID'];
			$selected = "";

			foreach($title_skills as $title) {
	
				if ($title['skillID'] == $skillID) {
					$selected = "selected";
				}
			}
			//$array_test = $utilities->in_array_r($skillID, $title_skills, "skill");
			
			echo "<option value='".$skillID."' ".$selected.">".$row['skill']."</option>";
		}
		
		echo "</select><br />";
		echo "&nbsp; <br />";
		
		echo "<a href='#' id='save_changes'>SAVE CHANGES</a>";
	}	
?>