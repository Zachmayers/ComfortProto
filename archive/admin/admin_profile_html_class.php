<?php
	function profile_employee_menu_html($profile_details, $logins, $ID, $activation_notes, $last_edit) {
		$utilities = new Utilities;
	
		$name = $profile_details['firstname']." ".$profile_details['lastname'];
		$email = $profile_details['email'];
		$email_setting = $profile_details['email_setting'];
		$active = $profile_details['valid'];		
		$creation_date = $profile_details['creation_date'];	
		$last_edit_date = $last_edit['date'];
		$last_edit_type = $last_edit['type'];
		
		if ($active == "Y") {
			$status = "Active";
		} else {
			$status = "Deactivated";
		}
		
?>		
	<div class="container">
		<h1 style="display:inline;">Employee Profile</h1> &nbsp; &nbsp; <a href="admin.php"><button>Admin Home</button></a>	
		<br /> &nbsp; <br />
		<h2><? echo $name." | ".$status ?></h2>
		<b>Email:</b>  <? echo $email ?><br />
		<b>Email Setting:</b> <? echo $email_setting ?><br />
		<b>Creation Date:</b>  <? echo $creation_date ?><br />
		<b>Last Login:</b>  <? echo $logins[0]['login_date']; ?> <? echo count($logins); ?><br />
		<b>Last Edit:</b>  <? echo $last_edit_date; ?> | <? echo $last_edit_type; ?><br />

		&nbsp; <br />
		<input type='hidden' id='userID' value='<? echo $ID ?>'>		
		<a href='#' class='open_form' id='change_email'>Change Email Setting</a><br />
		<div id='change_email_holder' class="change_form" style='display:none; margin-top:5px; margin-left:10px; margin-bottom:5px;'>
			Pass: <input type='text' id='email_pass'><br />
			<input type='hidden' id='email_setting' value='<? echo $email_setting ?>'>								
			<a href='#' id='change_email_button'>CHANGE EMAIL SETTING</a>
		</div>
		<a href='#' class='open_form' id='change_activation'>Activate/Deactivate Account</a><br />
		<div id='change_activation_holder' class="change_form" style='display:none; margin-top:5px; margin-left:10px; margin-bottom:5px;'>
			Pass: <input type='text' id='activation_pass'><br />
			Note: <input type='text' id='activation_reason'><br />			
			<input type='hidden' id='activation_setting' value='<? echo $active ?>'>
			<a href='#' id='change_activation_button'>CHANGE ACTIVATION SETTING</a>
		</div>		
		<a href='admin.php?page=view_profile&id=<? echo $ID ?>'>View Full Profile</a><br />
		<a href='admin.php?page=employee_matches&id=<? echo $ID ?>'>View Job Matches</a><br />				
		<a href='admin.php?page=logins&id=<? echo $ID ?>'>View All Logins</a><br />
		<a href='admin.php?page=edits&id=<? echo $ID ?>'>View All Profile Edits</a><br />						
						
<?php
		if (count($activation_notes) > 0) {
			echo "<h1>Activation Changes</h1>";
			foreach ($activation_notes as $row) {
				echo "<b>Changed To:  </b>".$row['change_to']."<br />";
				echo "<b>Date:  </b>".$row['date']."<br />";
				echo "<b>Notes:  </b>".$row['reason']."<br />";	
				echo "<hr><br/>";		
			}
		}
		echo "</div>";
	}
	
	function profile_employer_menu_html($profile_details, $logins, $store_array, $ID, $activation_notes, $employer_data) {
		$utilities = new Utilities;
	
		$name = $profile_details['firstname']." ".$profile_details['lastname'];
		$email = $profile_details['email'];
		$email_setting = $profile_details['email_setting'];
		$active = $profile_details['valid'];		
		$creation_date = $profile_details['creation_date'];	
		$company = $employer_data['general']['company'];
		$position = $employer_data['general']['position'];

		if ($active == "Y") {
			$status = "Active";
		} else {
			$status = "Deactivated";
		}
		
?>		
	<div class='container'>

		<h1 style="display:inline;">Employee Profile</h1> &nbsp; &nbsp; <a href="admin.php"><button>Admin Home</button></a>	
		<br /> &nbsp; <br />
		<h2><? echo $name." | ".$status ?></h2>
		<b>Email:</b>  <? echo $email ?><br />
		<b>Company:</b>  <? echo $company ?><br />
		<b>Position:</b>  <? echo $position ?><br />		
		<b>Email Setting:</b> <? echo $email_setting ?><br />
		<b>Creation Date:</b>  <? echo $creation_date ?><br />
		<b>Last Login:</b>  <? echo $logins[0]['login_date']; ?> <? echo count($logins); ?><br />
		&nbsp; <br />
<!-- 		<a href='#' id='change_email'>Change Email Setting</a><br /> -->
		<a href='#' class='open_form' id='change_activation'>Activate/Deactivate Account</a><br />
		<div id='change_activation_holder' class="change_form" style='display:none; margin-top:5px; margin-left:10px; margin-bottom:5px;'>
			Pass: <input type='text' id='activation_pass'><br />
			Note: <input type='text' id='activation_reason'><br />			
			<input type='hidden' id='activation_setting' value='<? echo $active ?>'>
			<a href='#' id='change_activation_button'>CHANGE ACTIVATION SETTING</a>
		</div>		
		<a href='admin.php?page=logins&id=<? echo $ID ?>'>View All Logins</a><br />
		&nbsp; <br />
		&nbsp; <br />
<?php
		if (count($activation_notes) > 0) {
			echo "<h1>Activation Changes</h1>";
			foreach ($activation_notes as $row) {
				echo "<b>Changed To:  </b>".$row['change_to']."<br />";
				echo "<b>Date:  </b>".$row['date']."<br />";
				echo "<b>Notes:  </b>".$row['reason']."<br />";	
				echo "<hr><br/>";		
			}
		}

		echo "<h2>STORES</h2>";

		foreach ($store_array as $row) {
			echo "<b>Name:  </b>".$row['name']."<br />";
			echo "<b>Description:  </b>".$row['description']."<br />";
			echo "<b>Website:  </b>".$row['website']."<br />";
			echo "<b>Facebook:  </b>".$row['facebook']."<br />";
			echo "<b>Twitter:  </b>".$row['twitter']."<br />";
			echo "<b>Street:  </b>".$row['address']."<br />";
			echo "<b>Zip:  </b>".$row['zip']."<br />";
			echo "<a href='admin.php?page=store_job_list&id=".$row['storeID']."'>View Jobs</a><br />";
			echo "&nbsp; <br />";
			echo "&nbsp; <br />";			
		}

		if (count($activation_notes) > 0) {
			echo "<h1>Activation Changes</h1>";
			foreach ($activation_notes as $row) {
				echo "<b>Changed To:  </b>".$row['change_to']."<br />";
				echo "<b>Date:  </b>".$row['date']."<br />";
				echo "<b>Notes:  </b>".$row['reason']."<br />";	
				echo "<hr><br/>";		
			}
		}
		echo "</div>";
	}	

function profile_html_employee($employee_data, $total_experience, $employee_store_type, $employee_position_experience, $employee_skills_experience, $old_employee_skills) {					
		$utilities = new Utilities;
		
		$employeeID					= $_GET['ID'];

		$general_array				= $employee_data['general'];
	
		$skill_array 					= $employee_data['skills']['skills'];
		$sub_skill						= $employee_data['skills']['sub_skills']; 
		$employment_array		= $employee_data['employment'];
		$employment_version	= $employee_data['employment_version'];
		$education_array 			= $employee_data['education'];
		$language_array 			= $employee_data['language'];
		$kitchen_photo_array 	= $employee_data['kitchen_photos'];
		$bar_photo_array			= $employee_data['bar_photos'];
		$traits							= $employee_data['traits'];
		$language_array			= $employee_data['languages'];
		$awards						= $employee_data['awards'];
		$certifications				= $employee_data['certifications'];

		$quote							= $employee_data['general']['quote'];
		$description					= $employee_data['general']['description'];
		
		if ($employee_data['general']['profile_pic'] == "") {
			$profile_pic = "<span class='profilephoto'><i class='fa fa-user fa-4x' aria-hidden='true'></i></span>";
			$profile_pic_size = "small";
			$profile_pic_status = "N";
		} else {
			//get profile photo size for legacy photos:
			$profile_pic_size_array = getimagesize("images/profile_pics/".$employee_data['general']['profile_pic']);
			if ($profile_pic_size_array[1] < 200) {
				$profile_pic_size = "small";
				$profile_pic = "<img src='images/profile_pics/".$employee_data['general']['profile_pic']."?".time()."' class='center-block profilephoto' id='main_photo' style='margin-top:80px; margin-bottom:80px'>";
			} else {
				$profile_pic = "<img src='images/profile_pics/".$employee_data['general']['profile_pic']."?".time()."' class='profilephoto' id='main_photo' width='200' height='200'>";
				$profile_pic_size = "large";
			}
			$profile_pic_status = "Y";			
		}	
		
//MAKE PHONE NUMBER READABLE
		if ($employee_data['general']['contact_phone'] == "") {
			$contact_phone = "<i>No phone entered</i>";
		} else {
			$contact_phone = substr_replace($employee_data['general']['contact_phone'] , '-', 3, 0);
			$contact_phone = substr_replace($contact_phone , '-', 7, 0);			
		}			
					
?>		
	
        <!-- Profile block -->
        <div class="block-contained ">
            <div class="row">
                <div class="col-md-4">
                    <h2 class="block-title titlename">
						<? echo $general_array['firstname'] ?> <? echo $general_array['lastname'] ?>
					</h2>
                </div>
                <div class="col-md-8">
<?php
					if ($quote == "") {
?>
						<h4 class="block-title quoteline" style="margin-top: 6px;"><i>No personal quote added</i></h2>
<?php
					} else {
?>
            	        <h4 class="block-title quoteline"  style="margin-top: 6px;"><i>"<? echo $quote ?>"</i></h2>
<?php
					}
?>		
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel-employee text-center">

                    <div class="panel-employee-photo">
<?
						if($profile_pic_size == "small") {
?>
	                        <div class="row">
		                        <? echo $profile_pic ?>
						    </div>
<?php							
						} else {
?>
		                    <? echo $profile_pic ?>
<?php												
						}
						
						//hidden images		
						if (count($kitchen_photo_array) > 0) {
							foreach($kitchen_photo_array as $photo) {
								echo "<img src='images/gallery_pics/".$photo['photo']."?".time()."' class='profilephoto' id='".$photo['photoID']."_large' style='display:none'>";
							}	
						}
						
						if (count($bar_photo_array) > 0) {
							foreach($bar_photo_array as $photo) {
								echo "<img src='images/gallery_pics/".$photo['photo']."?".time()."' class='profilephoto' id='".$photo['photoID']."_large' style='display:none'>";
							}	
						}							
?>
                        <div class="portfoliophotos">
<?php
							if (count($kitchen_photo_array) > 0 || count($kitchen_photo_array) > 0) {
								if ($profile_pic_status == "Y") {	
									//Thumb of main profile pic	
									echo "<a href='#' class='thumb' id='profile'><img src='images/profile_pics/".$employee_data['general']['profile_pic']."?".time()."' class='portfoliophotos'></a>";
								}

							}
															
							if (count($kitchen_photo_array) > 0) {
								foreach($kitchen_photo_array as $photo) {
									echo "<a href='#' class='thumb' id='".$photo['photoID']."'><img src='images/gallery_pics/".$photo['thumb']."?".time()."' class='portfoliophotos'></a>";
								}	
							}
							
							if (count($bar_photo_array) > 0) {
								foreach($bar_photo_array as $photo) {
									echo "<a href='#' class='thumb' id='".$photo['photoID']."'><img src='images/gallery_pics/".$photo['thumb']."?".time()."' class='portfoliophotos'></a>";
								}	
							}							
?>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="profilephone"><? echo $contact_phone ?></div>
                        <div class="profileemail"><? echo $general_array['email'] ?></div>
<?php
						$lang_count = count($language_array);
						if ($lang_count > 0) {
?>
							<b>Languages</b>
                         <ul class="langlist">
							
<?php
							foreach($language_array as $row) {
								echo "<li>".$row['lang']."</li>";
							}
						} 
?>
                        </ul>
                    </div>
                </div>

                <div class="row endorsements hidden-xs hidden-sm details" style="min-height: 500px">
					<div class="col-md-12">
	                    <h4>Endorsements</h4>
	                    <br />
	                    &nbsp; &nbsp; <i>Coming Soon</i>
<!--
	                    <div class="row">
	                        <div class="col-xs-4 padding-zero">
	                            <img src="images/employee02.jpg">
	                        </div>
	                        <div class="col-xs-8 padding-top-sm">
		                        Holy cow John beats the meat out of the competition
		                    </div>
	                    </div>
	                    <div class="row">
	                        <div class="col-xs-4 padding-zero">
		                        <img src="images/employee03.jpg">
	                        </div>
	                        <div class="col-xs-8 padding-top-sm">That meats legit</div>
	                    </div>
	                    <div class="row">
	                        <div class="col-xs-4 padding-zero">
		                        <img src="images/employee04.jpg">
	                        </div>
	                        <div class="col-xs-8 padding-top-sm">
		                        It goes in extra hot and finishes early, the steak is great too!
		                    </div>
	                    </div>
-->

					</div>
                </div>
            </div>

            <div class="col-md-8">
                <div id="hostpitalityblock">
	                    <div class="circlewrap hosp-exp">
<?
								//based on total Hospitaltiy experience light up right circle
								$hospitality_five = (round($total_experience['hospitality'])%5 === 0) ? round($total_experience['hospitality']) : round(($total_experience['hospitality']+5/2)/5)*5;

								if ($hospitality_five < 5) {
									echo "<div class='profilecircle c5yr'></div>";									
								} else {
			                        echo "<div class='profilecircle cpast c5yr'></div>";
								}	
								
								if ($hospitality_five >= 10) {
			                        echo "<div class='profilecircle cpast c10yr'></div>";
								}	else {
			                        echo "<div class='profilecircle c10yr'></div>";									
								}
								
                    			echo "<div class='profilecircle cactive 15yr'>";
									echo "<h4>Hospitality</h4>".round($total_experience['hospitality'])."<span class='subyears'>YEARS</span>";
								echo "</div>";
								
								if ($hospitality_five >= 20) {
			                        echo "<div class='profilecircle cpast c20yr'></div>";
								}	else {
			                        echo "<div class='profilecircle c20yr'></div>";									
								}
								
								if ($hospitality_five >= 25) {
			                        echo "<div class='profilecircle cpast c20yr'></div>";
								} else {
			                        echo "<div class='profilecircle c25yr'></div>";									
								}
?>
								<span style="display: inline-block;vertical-align: middle; line-height: normal; padding-bottom: 20px">	
									<a href='#' class='hospitality_header' style=' display:inline; color:#8b0909'><h5><i class="fa fa-chevron-right" aria-hidden="true"></i></h5></a>
								</span>
	                    	</div>
	                    	
	                    	<div class="circlewrap total-exp" style='display:none'>
								<span style="display: inline-block;vertical-align: middle; line-height: normal; padding-bottom: 20px">	
									<a href='#' class='total_header' style=' display:inline; color:#8b0909'><h5><i class="fa fa-chevron-left" aria-hidden="true"></i></h5></a>
								</span>		                    	
<?
								//based on total Hospitaltiy experience light up right circle
								$total_five = (round($total_experience['total'])%5 === 0) ? round($total_experience['total']) : round(($total_experience['total']+5/2)/5)*5;

								if ($total_five < 5) {
									echo "<div class='profilecircle c5yr'></div>";									
								} else {
			                        echo "<div class='profilecircle cpast c5yr'></div>";
								}	
								
								if ($total_five >= 10) {
			                        echo "<div class='profilecircle cpast c10yr'></div>";
								}	else {
			                        echo "<div class='profilecircle c10yr'></div>";									
								}
								
                    			echo "<div class='profilecircle cactive-total 15yr'>";
									echo "<h4>Total</h4>".round($total_experience['total'])."<span class='subyears'>YEARS</span>";
								echo "</div>";
								
								if ($total_five >= 20) {
			                        echo "<div class='profilecircle cpast c20yr'></div>";
								}	else {
			                        echo "<div class='profilecircle c20yr'></div>";									
								}
								
								if ($total_five >= 25) {
			                        echo "<div class='profilecircle cpast c25yr'></div>";
								} else {
			                        echo "<div class='profilecircle c25yr'></div>";									
								}
?>
	                    	</div> 
                </div>
                
                <div class="row exposwrap">
	                
                    <div class="col-md-6 profileexperience">
                        <h4>Positions Held (Yrs)</h4>
<?php
						if (count($employee_position_experience) > 0) {//WRONG THING : SHOULD BE SKILLS
							$count = 1;
							foreach($employee_position_experience as $key=>$row) {
								if ($count == 1) {
									$circle = "topcircle";
								} else {
									$circle = "subcircle";
								}
								
								$rounded_yrs = round($row);
								if ($rounded_yrs < 1) {
									$rounded_yrs = "<1";
								}
								
								if ($count > 3) {
									$position_display = "style='display:none'";
									$position_class = "hidden_position";
								} else {
									$position_display = "";									
									$position_class = "";
								}
								
?>
								 <div class="topexperience <? echo $position_class ?>" <? echo $position_display ?>><? echo $key ?>:
								 	<div class="<? echo $circle ?>"><? echo $rounded_yrs ?></div>
								 </div>
<?php
								$count++;
							}
						} else {
?>
							 <div class="topexperience">
								 <i class="fa fa-circle-thin" aria-hidden="true"></i> None Listed
							 </div>
<?php
						}	
						
						if (count($employee_position_experience) > 3) {
?>
							<a href='#' id="show_positions_button"><h5 style='text-align:center; color:#8b0909' class="show_positions_button"><i class="fa fa-chevron-down" aria-hidden="true"></i> SHOW MORE POSITIONS <i class="fa fa-chevron-down" aria-hidden="true"></i></h5></a>		                        
							<a href='#' id="hide_positions_button"><h5 style='text-align:center; color:#8b0909; display:none;' class="hide_positions_button"><i class="fa fa-chevron-up" aria-hidden="true"></i> HIDE POSITIONS <i class="fa fa-chevron-up" aria-hidden="true"></i></h5></a>		                        
<?php
						}
?>
                    </div>                    

                    <div class="col-md-6 profilepositions">
                        <h4>Skills</h4>
<?php
						if (count($employee_skills_experience) > 0) {
							$count = 1;
							$bar = "";
							$rounded_row = "";
							foreach($employee_skills_experience as $key=>$row) {
								$rounded_row = round($row);
								if ($rounded_row < 10) {
									if ($rounded_row == 0) {
										$bar = "posbar01";
										$row = "less than 1";					
									} else {
										$bar = "posbar0".$rounded_row;
									}
								} else {
									$bar = "posbar08";
								}
								
								if ($count > 4) {
									$skill_display = "style='display:none'";
									$skill_class = "hidden_skill";
								} else {
									$skill_display = "";									
									$skill_class = "";
								}
?>
					            <div class="posbar <? echo $bar ?> <? echo $skill_class ?>" <? echo $skill_display ?>>
					                <span><? echo $key ?></span><span><? echo $row ?> yr(s)</span>
					            </div>
<?php	
								$count++;		
							}
						} else {
?>
				            <div class="topexperience" style="margin-top: -10px">
				                <i class="fa fa-circle-thin" aria-hidden="true"></i> No Hospitality Skills Listed
				            </div>
<?php							
						}	
						
						if (count($employee_skills_experience) > 3) {
?>
							<a href='#' id="show_skills_button"><h5 style='text-align:center; color:#8b0909; margin-top:40px;' class="show_skills_button"><i class="fa fa-chevron-down" aria-hidden="true"></i> SHOW MORE SKILLS <i class="fa fa-chevron-down" aria-hidden="true"></i></h5></a>		                        
							<a href='#' id="hide_skills_button"><h5 style='text-align:center; color:#8b0909; margin-top:40px; display:none' class="hide_skills_button"><i class="fa fa-chevron-up" aria-hidden="true"></i> HIDE SKILLS <i class="fa fa-chevron-up" aria-hidden="true"></i></h5></a>		                        
<?php
						}
?> 
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="row pastwrap">
                    <div class="col-md-12">
                        <h4>PAST EMPLOYMENT</h4>
 <?php
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
?>	
								<div class="row">
									<div class="col-md-6"><i class="fa fa-circle-o" aria-hidden="true"></i> <? echo strtoupper($row['company']) ?></div>
									<div class="col-md-3"><? echo $row['position'] ?></div>
									<div class="col-md-3"><? echo $start_date." - ".$end_date ?>  <i><? echo $time ?></i></div>
								</div>			
<?php
							}
						} else {
?>
							<div class="row">
								<div class="col-md-12 "><i class="fa fa-circle-thin" aria-hidden="true"></i> No Past Employment Entered.</div>
							</div>
<?php
		}	
?>                
                    </div>        
                </div>

                <div class="row profileedu">
                    <div class="col-md-12">
                        <h4 style='margin-bottom:5px;'>Education</h4>

						<div class="row">                        
<?php
						if (count($education_array) > 0) {
							foreach ($education_array as $row) {
?>
		                        <div class="col-md-6 school"><i class="fa fa-graduation-cap" aria-hidden="true"></i> <? echo $row['school'] ?> - <? echo $row['degree'] ?></div>
<?php
							}
						} else {
?>
							<div class="col-md-6 school"><i class="fa fa-circle-thin" aria-hidden="true"></i> <i>Optional</i></div>
<?php
						}
?>	
						</div>
                    </div>
                </div>
                
                <div class="row awardscerts">
<?php
					if (count($certifications) == 0 && count($awards) == 0) {
?>
                		<div class="col-md-12">
		                    <h4 style='margin-bottom:10px;'>Awards & Certifications</h4>
							<i class="fa fa-circle-thin" aria-hidden="true"></i> <i>Optional</i>
                		</div>
<?php
					} else {
?>
                		<div class="col-md-6">
<?php
						if (count($awards) > 0) {
?>
                  			<h4 style='margin-bottom:10px;'>Awards</h4>
<?php					
							foreach ($awards as $row) {
?>	
								<i class="fa fa-trophy" aria-hidden="true"></i> <? echo $row['award'] ?></br>		
<?php
							}
						}
?>			
						</div>
						
						<div class="col-md-6">					
<?php			
							if (count($certifications) > 0) {
?>
             			       <h4 style='margin-bottom:10px;'>Certifications</h4>
<?php				
								foreach ($certifications as $row) {
?>
									<i class="fa fa-id-card" aria-hidden="true"></i> <? echo $row['certification'] ?></br>		
<?php
								}
							}
?>					
						</div>
<?php
					}
?>
                </div>
                
                <div class="row extrainfo">
                    <div class="col-md-12">
                        <h4>Description</h4> 		<? echo nl2br($description) ?>
                    </div>
                </div>
                
<!--
                <div class="endorsements visible-xs">
                    <h4>Endorsements</h4>
                    <div class="row">
                        <div class="col-xs-4 padding-zero">
                            <img src="images/employee02.jpg">
                        </div>
                        <div class="col-xs-8 padding-top-sm">
	                        Holy cow John beats the meat out of the competition
	                    </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 padding-zero">
	                        <img src="images/employee03.jpg">
                        </div>
                        <div class="col-xs-8 padding-top-sm">
	                        That meats legit
	                    </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 padding-zero">
	                        <img src="images/employee04.jpg">
                        </div>
                        <div class="col-xs-8 padding-top-sm">
	                        It goes in extra hot and finishes early, the steak is great too!
	                    </div>
                    </div>
                </div>
-->
            </div>
</div>
<?php
}


//=====================
//! 	Separate Past Employment Displays
//!    The past employment data was changed, and not all profiles have been updates
//=====================


function no_past_employment() {
	echo "No Previous Employment Information Added<br />";	
}

function old_past_employment($employment_array) {
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

function new_past_employment($new_employment_array, $employment_gaps, $gap_message) {
	$utilities = new Utilities;
	
	echo "<table cellpadding='12' cellspacing='12' style='margin-left:20px; margin-top:20px;'>";	
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
			
			$start_date = $row['start_month']."/".$row['start_year'];
			if ($row['current'] == 'Y') {
				$end_date = 'Current';
			} else {
				$end_date = $row['end_month']."/".$row['end_year'];					
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
				echo "<td width='200px;'><a href='http://".$row['website']."'><b>".$row['company']."</b></a>".$indicator."</td>";
				echo "<td width='125px;'>".$row['position']."</td>";		
				echo "<td width='200px'>".$start_date." - ".$end_date." ".$time."</td>";
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

	function profile_employer_html($profile_details, $stores, $jobs, $logins, $employer_data) {
		$member = new Member;
?>		
	<div class='container'>

		<h1 style="display:inline;">Employer Profile</h1> &nbsp; &nbsp; <a href="admin.php"><button>Admin Home</button></a>	
		<br /> &nbsp; <br />
		<hr>	
		<table class='dark'>
<?php
		foreach($profile_details as $row) {
			$name = $row['firstname']." ".$row['lastname'];
			$email = $row['email'];
			$email_verify = $row['email_validation'];
		}
		
		foreach($employer_data as $row) {
			$company = $row['company'];
		}
				
		echo "<tr>";
		echo "<td>Name: </td><td>".$name." | ".$company."</td>";	
		echo "</tr>";
		
		echo "<tr>";	
		echo "<td>Contact: </td><td>".$email."</td>";						
		echo "</tr>";			
?>
		</table>
		<h2>Stores</h2>
		<hr>
<?php
		if (count($stores) > 0) {
			foreach($stores as $row) {
				echo "<div style='float:left; width:100%;'>";
				
				echo "<div style='float:left; width:50%;'>";
				echo "<b>".$row['name']."</b><br />";
				echo $row['address'].", ".$row['zip']."<br />";
				echo "</div>";

				echo "<div style='float:left; width:50%;'>";					
				echo "<b>Jobs</b> <br />";
				
				if (count($jobs) > 0) {
					foreach($jobs as $job) {
						if ($row['storeID'] == $job['storeID']) {
							echo "<a href='admin.php?page=view_job&id=".$job['jobID']."'>".$job['title']."</a><br />";
						}
					}
				}
				echo "</div>";
				
				echo "</div>";
				echo "&nbsp; <br />";				
			}
		}
		
		echo "&nbsp; <br />";
?>		
		&nbsp; <br />
		<hr>	
		<h2>Logins</h2>
<?php
		if (count($logins) > 0) {
			foreach($logins as $row) {
				echo $row['login_date']."<br />";
			}
		}
?>
	</div>
<?php
	}//end profile_view
	
	function all_edits_html($edit_array) {
?>
	<div class='container'>

		<table class='dark'>
		<tr><th>Date</th><th>Edit Type</th></tr>
<?php
		if (count($edit_array) > 0) {
			foreach ($edit_array as $row) {
				echo "<tr>";
					echo "<td>".$row['date']."</td>";
					echo "<td>".$row['type']."</td>";
				echo "</tr>";
			}
		} else {
			echo "<tr><td colspan='3'>No Recent Edits</td></tr>";
		}
		echo "</table>";
	}
	
	function all_logins_html($logins) {
?>
		<table class='dark'>
		<tr><th>Date</th><th>Device</th><th>IP Adress</th></tr>
<?php
		if (count($logins) > 0) {
			foreach ($logins as $row) {
				echo "<tr>";
					echo "<td>".$row['login_date']."</td>";
					echo "<td>".$row['browser']."</td>";
					echo "<td>".$row['IP']."</td>";		
				echo "</tr>";
			}
		} else {
			echo "<tr><td colspan='3'>No Logins</td></tr>";
		}
		echo "</table>";
		echo "</div>";
	}	
	
	function view_member_matches($match_array) {
?>
	<div class='container'>

		<table class='dark'>
		<tr><th>Job</th><th>Response (Date)</th><th>Date Viewed</th><th>Expiration Date</th><th>View Response</th></tr>
<?php
		if (count($match_array) > 0) {
			foreach ($match_array as $row) {
				if ($row['employee_interest'] == "") {
					$response_date = "NA";
					$view_response = "NA";
				} else {
					$response_date = $row['date_responded'];	
					if ($row['employee_interest'] == "Y")	{
						$view_response = "<a href='admin.php?page=view_response&id=".$_GET['id']."&matchID=".$row['matchID']."'>View Response</a>";
					} else {
						$view_response = "NA";
					}		
				}
				echo "<tr>";
					echo "<td><a href='admin.php?page=view_job&id=".$row['jobID']."'>".$row['title']."</a></td>";
					echo "<td>".$row['employee_interest']." (".$response_date.")</td>";	
					echo "<td>".$row['date_viewed']."</td>";	
					echo "<td>".$row['expiration_date']."</td>";
					echo "<td>".$view_response."</td>";																						
				echo "</tr>";
			}
		} else {
			echo "<tr><td colspan='5'>No Matches</td></tr>";
		}
		echo "</table>";
		
		echo "</div>";
	}
	
	function view_response_html($question_array, $secondary_contact, $message) {
		echo "<div class='container'>";

		echo "<h2>Job Response Details</h2>";
		
		if ($secondary_contact == "") {
			echo "<b>Secondary Contact:</b> <i>None</i><br />";
		} else {
			echo "<b>Secondary Contact:</b> ".$secondary_contact."<br />";			
		}
		
		if ($message == "") {
			echo "<b>Message:</b> <i>None</i><br />";
		} else {
			echo "<b>Message:</b> <br />".$secondary_contact."<br />";			
		}
		
		echo " &nbsp; <br />";
		echo " &nbsp; <br />";		
		echo "<h2>Questions</h2>";
		if (count($question_array) > 0) {
			foreach ($question_array as $row) {
				echo "<b>Question: </b>".$row['question']."<br />";
				echo "<b>Answer: </b>".$row['answer']."<br />";
			}
		} else {
			echo "None";
		}
		
	}
	
	function view_employment_list($employment_array) {
		$code = $_GET['code'];
		if ($code == "supersillygrgtt56") {
			$admin = new Admin;
			$admin->rewrite_employment_dates();
			echo "DONE AND DONE<br />";
		}
		
		echo "<h2>Past Employment Test</h2>";
		
/*
		echo "<table width='600'>";
		echo "<tr><td>Company</td><td>Position</td><td>Start</td><td>End</td><td>New Start</td>";
		foreach($employment_array as $row) {
			$admin = new Admin;
			$start_date = $row['start_date'];
			$end_date = $row['end_date'];
			$new_start = $admin->employment_convert('start', $start_date);
			$new_end = $admin->employment_convert('end', $end_date);
			
			echo "<tr>";
				echo "<td>".$row['company']."</td>";
				echo "<td>".$row['position']."</td>";
				echo "<td>".$row['start_date']."</td>";
				echo "<td>".$row['end_date']."</td>";
				echo "<td>".$new_start['month']." ".$new_start['year']." - ".$new_end['month']." ".$new_end['year']."</td>";
			echo "</tr>";
		}
		echo "</table>";
*/
		echo "</div>";
	}
?>