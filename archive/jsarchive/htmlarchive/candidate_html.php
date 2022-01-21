<?php

function candidate_html($candidate_data, $total_experience, $employee_store_type, $employee_position_experience, $employee_skills_experience, $old_employee_skills, $post_type) {
$utilities = new Utilities;
//==================================
//!  First break master arrays into trait arrays
//
//  Modify any data for presentation
//==================================

		$matchID						= $_GET['matchID'];
		$candidateID					= $_GET['ID'];

		$general_array				= $candidate_data['general'];
		$employee_array			= $candidate_data['employee_data'];
	
		$skill_array 					= $candidate_data['employee_data']['skills']['skills'];
		$sub_skill						= $candidate_data['employee_data']['skills']['sub_skills']; 
		$employment_array		= $candidate_data['employee_data']['employment'];
		$employment_version	= $candidate_data['employee_data']['employment_version'];
		$education_array 			= $candidate_data['employee_data']['education'];
		$language_array 			= $candidate_data['employee_data']['languages'];
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

		$resume						= $candidate_data['general']['resume'];	

		if ($employee_array['general']['profile_pic'] == "") {
			$profile_pic = "<span class='profilephoto'><i class='fa fa-user fa-4x' aria-hidden='true'></i></span>";
			$profile_pic_size = "small";
			$profile_pic_status = "N";
		} else {
			if (file_exists("images/profile_pics/".$employee_array['general']['profile_pic'])) {
				//get profile photo size for legacy photos:
				$profile_pic_size_array = getimagesize("images/profile_pics/".$employee_array['general']['profile_pic']);
				if ($profile_pic_size_array[1] < 200) {
					$profile_pic_size = "small";
					$profile_pic = "<img src='images/profile_pics/".$employee_array['general']['profile_pic']."?".time()."' class='center-block profilephoto' id='main_photo' style='margin-top:80px; margin-bottom:80px'>";
				} else {
					$profile_pic = "<img src='images/profile_pics/".$employee_array['general']['profile_pic']."?".time()."' class='center-block profilephoto' id='main_photo' style='max-height:280px;max-width:280px;height:auto;width:auto;'>";
					$profile_pic_size = "large";
				}
				$profile_pic_status = "Y";	
			} else {
				$profile_pic = "<span class='profilephoto'><i class='fa fa-user fa-4x' aria-hidden='true'></i></span>";
				$profile_pic_size = "small";
				$profile_pic_status = "N";
			}	
		}	

		if ($employment_version == "new" && count($employment_array) > 0) {
			$new_employment_array = $utilities->reorder_employment($employment_array);
		}	

//MAKE PHONE NUMBER READABLE
		if ($employee_array['general']['contact_phone'] == "") {
			$contact_phone = "<i>No phone entered</i>";
		} else {
			$contact_phone = substr_replace($employee_array['general']['contact_phone'] , '-', 3, 0);
			$contact_phone = substr_replace($contact_phone , '-', 7, 0);			
		}		
		
			
//DETERMINE TABS FOR PAGE SWITCHING				
		
		if (count($past_replies) > 0) {
			$past_reply_notice = "<a href='candidate.php?ID=".$_GET['ID']."&matchID=".$_GET['matchID']."&page=past_replies'>YES - View Details</a>";
		} else {
			$past_reply_notice = "NO - <a href='candidate.php?ID=".$_GET['ID']."&matchID=".$_GET['matchID']."&page=archive_replies'>Check past 2 years</a>";			
		}
				
/*******************
*
*  Candidate HTML
*
********************/

//TABS - QUESTION AND MESSAGE TAB ONLY APPEAR IF THOSE ITEMS EXIST
?>
<div class="container">	
	<div class='block block-pd-sm text-center edit_menu'>
		<div class="row">
			<div class="col-md-offset-2 col-xs-offset-1 col-md-8 col-xs-10">
				<div class="row">
					<div class='col-md-3 col-xs-6 unselected_tab btn btn-large btn-default profile_tab' id="profile" style="cursor: pointer;">
						<i class="fa fa-eye" aria-hidden="true"></i> View Profile
					</div>
					<div class='col-md-3 col-xs-6 unselected_tab  btn btn-large btn-default profile_tab' id="questions" style="cursor: pointer;">
						<i class="fa fa-eye" aria-hidden="true"></i> View Questions
					</div>
					<div class='col-md-3 col-xs-6 unselected_tab  btn btn-large btn-default profile_tab' id="message">
						<i class="fa fa-eye" aria-hidden="true"></i> View Message
					</div>
					<div class='col-md-3 col-xs-6 unselected_tab  btn btn-large btn-default profile_tab' id="application">
						<i class="fa fa-eye" aria-hidden="true"></i> View Application
					</div>
				</div>
			</div>
			
<?php
			if ($resume != NULL) {
?>			
			<div class="row">
				<div class='col-md-3 col-md-offset-4 col-xs-6 col-xs-offset-3 unselected_tab btn btn-large btn-default profile_tab' id="resume" style="cursor: pointer;">
					<i class="fa fa-eye" aria-hidden="true"></i> View Resume File
				</div>
			</div>
<?php
			}
?>
			
		</div>
	</div>
	
			
        <!-- Profile block -->
        <div class="block-contained ">
            <div class="row">
                <div class="col-md-4">
                    <h2 class="block-title titlename text-center">
<?php
						if ($response_array['highlight'] == "Y") {
?>
							<a href='#' class='highlight_candidate' id='<? echo $_GET['matchID'] ?>' style="color:black"><i class="fa fa-star" aria-hidden="true" style="font-size: 20pt; color: #b76e1f"></i></a> <font color="color: #b76e1f"><? echo $general_array['firstname'] ?> <? echo $general_array['lastname'] ?></font>
<?php							
						} else {
?>
							<a href='#' class='highlight_candidate' id='<? echo $_GET['matchID'] ?>' style="color:black"><i class="fa fa-star-o" aria-hidden="true" style="font-size: 20pt;"></i></a> <? echo $general_array['firstname'] ?> <? echo $general_array['lastname'] ?>
<?php							
						}
?>
					</h2>
                </div>
                <div class="col-md-8 details">
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

            <div class="col-md-4 details">
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
								echo "<img src='images/gallery_pics/".$photo['photo']."?".time()."' class='center-block profilephoto' style='max-height:280px;max-width:280px;height:auto;width:auto; display:none' id='".$photo['photoID']."_large'>";
							}	
						}
						
						if (count($bar_photo_array) > 0) {
							foreach($bar_photo_array as $photo) {
								echo "<img src='images/gallery_pics/".$photo['photo']."?".time()."' class='center-block profilephoto' style='max-height:280px;max-width:280px;height:auto;width:auto; display:none' id='".$photo['photoID']."_large'>";
							}	
						}							
?>
                        <div class="portfoliophotos" style="margin-bottom: 0px">
<?php
							if (count($kitchen_photo_array) > 0 || count($bar_photo_array) > 0) {
								if ($profile_pic_status == "Y") {	
									//Thumb of main profile pic	
									echo "<a href='#' class='thumb' id='profile'><img src='images/profile_pics/".$employee_array['general']['profile_pic']."?".time()."' class='portfoliophotos'></a>";
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

                    <div class="panel-body" style="padding-top:10px">
	                    Applied in last 90 days: <? echo $past_reply_notice ?><br />
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

            <div class="col-md-8 details">
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
								
                    			echo "<div class='profilecircle cactive-total  15yr'>";
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
                        <h4 class="spacer">Skills</h4>
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
                <div class="row pastwrap details">
                    <div class="col-md-12">
                        <h4 style="padding-top: 15px;">Past Employment</h4>
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
									<div class="col-md-6 col-xs-6 col-xs-offset-1" style="color:black"><i class="fa fa-circle-o" aria-hidden="true"></i> <? echo strtoupper($row['company']) ?></div>
									<div class="col-md-3 col-xs-5" style="color:black"><? echo $row['position'] ?></div>
									<div class="col-md-3 col-xs-10 col-xs-offset-2"><? echo $start_date." - ".$end_date ?>  <i><? echo $time ?></i></div>
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

                <div class="row profileedu details">
                    <div class="col-md-12">
                        <h4 style='margin-bottom:5px;'>Education</h4>

						<div class="row">                        
<?php
						if (count($education_array) > 0) {
							foreach ($education_array as $row) {
?>
		                        <div class="col-md-6 col-xs-10 col-xs-offset-1 school"><i class="fa fa-graduation-cap" aria-hidden="true"></i> <? echo $row['school'] ?> - <? echo $row['degree'] ?></div>
<?php
							}
						} else {
?>
							<div class="col-md-6 col-xs-10 col-xs-offset-1 school"><i class="fa fa-circle-thin" aria-hidden="true"></i> <i>None Entered</i></div>
<?php
						}
?>	
						</div>
                    </div>
                </div>
                
                <div class="row awardscerts details">
<?php
					if (count($certifications) == 0 && count($awards) == 0) {
?>
                		<div class="col-md-12">
		                    <h4 style='margin-bottom:10px;'>Awards & Certifications</h4>
							<i class="fa fa-circle-thin" aria-hidden="true"></i> <i>None Listed</i>
                		</div>
<?php
					} else {
?>
                		<div class="col-md-6">
<?php
						if (count($awards) > 0) {
?>
                  			<h4 style='margin-bottom:10px;'>Awards</h4>
                  			<div class="col-md-12 col-xs-10 col-xs-offset-1">
<?php					
							foreach ($awards as $row) {
?>	
								<i class="fa fa-trophy" aria-hidden="true"></i> <? echo $row['award'] ?></br>		
<?php
							}
?>
							</div>
<?php
						}
?>			
						</div>
						
						<div class="col-md-6">					
<?php			
							if (count($certifications) > 0) {
?>
             			       <h4 style='margin-bottom:10px; margin-top:10px'>Certifications</h4>
			 				   <div class="col-md-12 col-xs-10 col-xs-offset-1">
             			       
<?php				
								foreach ($certifications as $row) {
?>
									<i class="fa fa-id-card" aria-hidden="true"></i> <? echo $row['certification'] ?></br>		
<?php
								}
?>
								</div>
<?php
							}
?>					
						</div>
<?php
					}
?>
                </div>
                
            <div class="row extrainfo details">
                <div class="col-md-12">
                    <h4>Description</h4> 
                    <? echo nl2br($description) ?>
                </div>
            </div>
            
<!--             HIDDEN MESSAGE TAB -->
			<div class='row' id='message_holder' style="display:none">
                <div class="col-md-12" style="margin-bottom:50px">
                    <h4 style='margin-bottom:10px;'>Personal Message</h4>
					<?php echo $utilities->makeSafe_flat($response_array['message']); ?>
                </div>
			</div>
			
<!--             HIDDEN QUESTIONS TAB -->
			<div class='row' id='questions_holder' style="display:none">
                <div class="col-md-12" style="margin-bottom:50px">
                    <h4 style='margin-bottom:10px;'>Pre-Interview Questions</h4>
<?php
					if (count($question_array) > 0) {
						foreach ($question_array as $row) {
?>
							<h5><? echo $row['question'] ?></h5>
							<i><? echo $utilities->makeSafe_flat($row['answer']) ?></i>
<?php
						}
					}
?>
                </div>
			</div>	
			
        </div>
</div>	
<?php	
}


function candidate_resume_html($candidate_data, $total_experience) {
$utilities = new Utilities;
//==================================
//!  First break master arrays into trait arrays
//
//  Modify any data for presentation
//==================================

		$matchID						= $_GET['matchID'];
		$candidateID					= $_GET['ID'];

		$general_array				= $candidate_data['general'];
		$employee_array			= $candidate_data['employee_data'];
		$question_array				= $candidate_data['answer_array'];
		$response_array			= $candidate_data['candidate_response'];
	
		$resume						= $candidate_data['general']['resume'];

		if ($employee_array['general']['profile_pic'] == "") {
			$profile_pic = "<span class='profilephoto'><i class='fa fa-user fa-4x' aria-hidden='true'></i></span>";
			$profile_pic_size = "small";
			$profile_pic_status = "N";
		} else {
			if (file_exists("images/profile_pics/".$employee_array['general']['profile_pic'])) {
				//get profile photo size for legacy photos:
				$profile_pic_size_array = getimagesize("images/profile_pics/".$employee_array['general']['profile_pic']);
				if ($profile_pic_size_array[1] < 200) {
					$profile_pic_size = "small";
					$profile_pic = "<img src='images/profile_pics/".$employee_array['general']['profile_pic']."?".time()."' class='center-block profilephoto' id='main_photo' style='margin-top:80px; margin-bottom:80px'>";
				} else {
					$profile_pic = "<img src='images/profile_pics/".$employee_array['general']['profile_pic']."?".time()."' class='center-block profilephoto' id='main_photo' style='max-height:280px;max-width:280px;height:auto;width:auto;'>";
					$profile_pic_size = "large";
				}
				$profile_pic_status = "Y";	
			} else {
				$profile_pic = "<span class='profilephoto'><i class='fa fa-user fa-4x' aria-hidden='true'></i></span>";
				$profile_pic_size = "small";
				$profile_pic_status = "N";
			}	
		}	


//MAKE PHONE NUMBER READABLE
		if ($employee_array['general']['contact_phone'] == "") {
			$contact_phone = "<i>No phone entered</i>";
		} else {
			$contact_phone = substr_replace($employee_array['general']['contact_phone'] , '-', 3, 0);
			$contact_phone = substr_replace($contact_phone , '-', 7, 0);			
		}		
		
			
				
/*******************
*
*  Candidate HTML
*
********************/

//TABS - QUESTION AND MESSAGE TAB ONLY APPEAR IF THOSE ITEMS EXIST
?>
<div class="container">	
	<div class='block block-pd-sm text-center edit_menu'>
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="row">
					<h5>This candidate did not complete a profile.  They included only a resume.</h5><br />
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class='col-md-3 col-md-offset-4 col-xs-6 col-xs-offset-3 unselected_tab btn btn-large btn-default profile_tab' id="resume" style="cursor: pointer;">
				<i class="fa fa-eye" aria-hidden="true"></i> View Resume File
			</div>
		</div>
		
	</div>
	
			
        <!-- Profile block -->
        <div class="block-contained ">
            <div class="row">
                <div class="col-md-4">
                    <h2 class="block-title titlename text-center">
<?php
						if ($response_array['highlight'] == "Y") {
?>
							<a href='#' class='highlight_candidate' id='<? echo $_GET['matchID'] ?>' style="color:black"><i class="fa fa-star" aria-hidden="true" style="font-size: 20pt; color: #b76e1f"></i></a> <font color="color: #b76e1f"><? echo $general_array['firstname'] ?> <? echo $general_array['lastname'] ?></font>
<?php							
						} else {
?>
							<a href='#' class='highlight_candidate' id='<? echo $_GET['matchID'] ?>' style="color:black"><i class="fa fa-star-o" aria-hidden="true" style="font-size: 20pt;"></i></a> <? echo $general_array['firstname'] ?> <? echo $general_array['lastname'] ?>
<?php							
						}
?>
					</h2>
                </div>
                <div class="col-md-8 details">
                </div>
            </div>

            <div class="col-md-4 details">
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
						
						$kitchen_photo_array = array();
						$bar_photo_array = array();
						//hidden images		
						if (count($kitchen_photo_array) > 0) {
							foreach($kitchen_photo_array as $photo) {
								echo "<img src='images/gallery_pics/".$photo['photo']."?".time()."' class='center-block profilephoto' style='max-height:280px;max-width:280px;height:auto;width:auto; display:none' id='".$photo['photoID']."_large'>";
							}	
						}
						
						if (count($bar_photo_array) > 0) {
							foreach($bar_photo_array as $photo) {
								echo "<img src='images/gallery_pics/".$photo['photo']."?".time()."' class='center-block profilephoto' style='max-height:280px;max-width:280px;height:auto;width:auto; display:none' id='".$photo['photoID']."_large'>";
							}	
						}							
?>
                        <div class="portfoliophotos" style="margin-bottom: 0px">
<?php
							if (count($kitchen_photo_array) > 0 || count($bar_photo_array) > 0) {
								if ($profile_pic_status == "Y") {	
									//Thumb of main profile pic	
									echo "<a href='#' class='thumb' id='profile'><img src='images/profile_pics/".$employee_array['general']['profile_pic']."?".time()."' class='portfoliophotos'></a>";
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

                    <div class="panel-body" style="padding-top:10px">
	                    Applied in last 90 days: <? echo $past_reply_notice ?><br />
                        <div class="profilephone"><? echo $contact_phone ?></div>
                        <div class="profileemail"><? echo $general_array['email'] ?></div>
<?php
							$language_array = array();
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

                <div class="row endorsements hidden-xs">
					<div class="col-md-12">
	                    <h4>Endorsements</h4>
	                    <br />
							<b>No Endorsements</b>
					</div>
                </div>
            </div>

            <div class="col-md-8 details">
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
								
                    			echo "<div class='profilecircle cactive-total  15yr'>";
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
	                
            </div>
            
            <div class="col-md-8">
                <div class="row pastwrap details">
                    <div class="col-md-12">
                        <h4 style="padding-top: 15px;">Pre-Interview Questions</h4>
<?php
							if (count($question_array) > 0) {
								foreach ($question_array as $row) {
?>
									<h5><? echo $row['question'] ?></h5>
									<i><? echo $utilities->makeSafe_flat($row['answer']) ?></i>
<?php
								}
							}
?>
                </div>

                    </div>        
                </div>

                <div class="row profileedu details">
                    <div class="col-md-12">
                    </div>
                </div>
                
                <div class="row awardscerts details">
                </div>
                
            <div class="row extrainfo details">
            </div>
            
                <div class="row endorsements hidden-md hidden-lg">
					<div class="col-xs-12">
	                    <h4>Endorsements</h4>
	                    <br />
					</div>
                </div>
            </div>
            
            
<!--             HIDDEN MESSAGE TAB -->
			<div class='row' id='message_holder' style="display:none">
                <div class="col-md-12" style="margin-bottom:50px">
                    <h4 style='margin-bottom:10px;'>Personal Message</h4>
					<?php echo $utilities->makeSafe_flat($response_array['message']); ?>
                </div>
			</div>
			
<!--             HIDDEN QUESTIONS TAB -->
			<div class='row' id='questions_holder' style="display:none">
                <div class="col-md-12" style="margin-bottom:50px">
                    <h4 style='margin-bottom:10px;'>Pre-Interview Questions</h4>
<?php
					if (count($question_array) > 0) {
						foreach ($question_array as $row) {
?>
							<h5><? echo $row['question'] ?></h5>
							<i><? echo $utilities->makeSafe_flat($row['answer']) ?></i>
<?php
						}
					}
?>
                </div>
			</div>	
			
        </div>
</div>	
<?php	
}


function candidate_printer_html($candidate_data, $job_data) {

$utilities = new Utilities;
//==================================
//!  First break master arrays into trait arrays
//
//  Modify any data for presentation
//==================================
//echo var_dump($candidate_data);
		$matchID						= $_GET['matchID'];
		$candidateID					= $_GET['ID'];

		$general_array				= $candidate_data['general'];
		$employee_array			= $candidate_data['employee_data'];
	
		$skill_array 					= $candidate_data['employee_data']['skills']['skills'];
		$sub_skill						= $candidate_data['employee_data']['skills']['sub_skills']; 
		$employment_array		= $candidate_data['employee_data']['employment'];
		$employment_version	= $candidate_data['employee_data']['employment_version'];
		$education_array 			= $candidate_data['employee_data']['education'];
		$language_array 			= $candidate_data['employee_data']['languages'];
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
		
		$interview_schedule		 =	$candidate_data['interview_schedule'];	

		if ($employment_version == "new" && count($employment_array) > 0) {
			$new_employment_array = $utilities->reorder_employment($employment_array);
		}					

//MAKE PHONE NUMBER READABLE
		if ($employee_array['general']['contact_phone'] == "") {
			$contact_phone = "<i>No phone entered</i>";
		} else {
			$contact_phone = substr_replace($employee_array['general']['contact_phone'] , '-', 3, 0);
			$contact_phone = substr_replace($contact_phone , '-', 7, 0);			
		}			

		if ($response_array['contact'] == "") {
			$secondary_contact = "NA";
		} else {
			$secondary_contact = $response_array['contact'];			
		}

//Headers required
?>

<!DOCTYPE html>
<html lang="en">
<head>	
<STYLE TYPE='text/css'> P.pagebreakhere {page-break-before: always}
</STYLE>
</head>
<body>

<div style='width:650px; float:left'>
	<div style='text-align:center'>
		<h2>Application for Employment</h2>
		<h3><? echo $store_name ?></h3>
	</div>
	
	<i><b>Powered by ServeBartendCook.com</b></i><br />
	<table border='2' style='border-collapse: collapse;' cellspacing="10" cellpadding="10" width='100%'>
		<tr>
			<td width='30%'><b>Application Date</b></td>
			<td><?php echo date('M j, Y', strtotime($response_array['date_responded'])) ?></td>
		</tr>	
		<tr>
			<td width='30%'><b>Position Desired</b></td>
			<td><? echo $job_data['general']['title'] ?></td>
		</tr>	
		<tr>
			<td width='30%'><b>Name (Last, First)</b></td>
			<td><? echo $general_array['lastname'] ?>, <? echo $general_array['firstname'] ?></td>
		</tr>
		<tr>
			<td width='30%'><b>Phone</b></td>
			<td><? echo $contact_phone ?></td>
		</tr>
		<tr>
			<td width='30%'><b>Email</b></td>
			<td><? echo $general_array['email'] ?></td>
		</tr>
		<tr>
			<td><b>Secondary Contact</b></td>
			<td><? echo $utilities->makeSafe_flat($secondary_contact) ?></td>
		</tr>
		
<?php
		if ($interview_schedule['interviewID'] > 0) {
?>
		<tr>
			<td><b>Scheduled Interview</b></td>
			<td><?php echo date('M j, Y', strtotime($interview_schedule['interview_date'])) ?></td>
		</tr>
<?php			
		}
?>
	</table>
	
	<hr>
	<div style='margin-bottom:-20px;'>
		<h3>Past Employment</h3>
	</div>
	
	<table border='2' style='border-collapse: collapse;' cellspacing="10" cellpadding="10" width='100%'>
		<th><b>COMPANY</b></th>	
		<th><b>POSITION</b></th>	
		<th><b>START DATE</b></th>	
		<th><b>END DATE</b></th>		
<?php

		if (count($employee_array) > 0) {
			foreach ($employment_array as $row) {
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
					echo "<td width='25%'><b>".$row['company']."</b></td>";
					echo "<td width='25%'>".$row['position']."</td>";		
					echo "<td width='25%'>".$start_date."</td>";
					echo "<td width='25%'>".$end_date." ".$time."</td>";
				echo "</tr>";
			}			
		} else {
			echo "<tr><td colspan='4'>None Entered</td></tr>";
		}
?>
	</table>
	
	<hr>
	<div style='margin-bottom:-20px;'>
		<h3>Education/Certification</h3>
	</div>
	
	<table border='2' style='border-collapse: collapse;' cellspacing="10" cellpadding="10" width='100%'>
		<th><b>INSTITUTION/SCHOOL</b></th>	
		<th><b>DEGREE/CERTIFICATION</b></th>	
<?php
		if (count($education_array) > 0) {
			foreach ($education_array as $row) {
				echo "<tr>";
					echo "<tr>";
						echo "<td width='50%'><b>".$row['school']."</b></td>";				
						echo "<td width='50%'>".$row['degree']."</td>";
					echo "</tr>";
				echo "</tr>";
			}			
		} else {
			echo "<tr><td colspan='4'>None Entered</td></tr>";
		}
?>
	</table>
	
<?php
	if (count($language_array) > 0) {
	echo "<hr>";
	 echo "<b>Additional Languages: </b>";
		$count = 1;
		foreach($language_array as $row) {
			echo $row['lang'];
			if ($count != count($language_array)) {
				echo ", ";
			}
			$count++;
		}
		echo "<br />";		 
	 }	
	
	if (count($certifications) > 0) {
		echo "<hr>";
		 echo "<b>Certifications: </b>";
			$count = 1;
			foreach($certifications as $row) {
				echo $row['certification'];
				if ($count != count($certifications)) {
					echo ", ";
				}
				$count++;
			}
			echo "<br /> &nbsp; <br />";		 
	}
	
	if (count($awards) > 0) {
		 echo "<b>Awards: </b>";
			$count = 1;
			foreach($awards as $row) {
				echo $row['award'];
				if ($count != count($awards)) {
					echo ", ";
				}
				$count++;
			}
			echo "<br /> &nbsp; <br />";		 
	}	

?>	

<!-- <P CLASS="pagebreakhere"> &nbsp; </P> -->

<!--
<h3 style='margin-bottom:-10px;'>SKILLS</h3>
<hr>
-->
<?php
/*
	if (count($skill_array) > 0) {
		foreach($skill_array as $row) {
			$sub_skill_array = $sub_skill[$row['skillID']];
			if(count($sub_skill_array) > 0) {
				echo "<b>".$row['skill']."</b>:  ";
				foreach ($sub_skill_array as $sub) {
					if ($sub['skillID'] == $row['skillID']) {
						echo $sub['sub_skill'].", ";
					}
				}
				echo "<br />";
			}
		}
	} else {
		echo "No Skills Entered";
	}
*/
		
		if ($response_array['message'] != "") {
			echo "<h3 style='margin-bottom:-10px;'>PERSONAL MESSAGE</h3>";
			echo "<hr>";
			echo "<i>".$utilities->makeSafe_flat($response_array['message'])."</i>";
			echo "<br /> &nbsp; <br />";		
		}
		
		if (count($question_array) > 0) {
			echo "<h3 style='margin-bottom:-10px;'>QUESTION RESPONSES</h3>";
			echo "<hr>";
			foreach ($question_array as $row) {
				echo "<b>".$row['question']."</b><br />";
				echo "<div style='margin-left:5px; margin-right:5px; width:100%;'><i>".$utilities->makeSafe_flat($row['answer'])."</i></div><br />";
				echo "&nbsp; <br />";
			}		
		}
		
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
			
			echo "<hr>";
			echo "<h3 style='margin-bottom:-10px;'>RECOMMENDATION/REFERENCE</h3>";
			echo "<hr>";
			
			echo "<div style='float:left; width:100%;'>";

				echo "<div id='recommendation_summary_holder' style='float:left; width:100%;'>";
					echo "<div style='float:left; width:90%; margin-bottom:10px'><h4>".$recommendation['firstname']." ".$recommendation['lastname']." has provided a job reference for this candidate.</h4>";
						echo $relation_text;
						echo $experience_text;
						echo $current_text;
				echo "</div>";
				
				
			echo "</div>";

		echo "</div>";
		echo "<br /><hr>";
		
	}
	
?>
</div>

</body>
</html>
<?php
}
	
function candidate_past_replies_html($general_array, $candidate_data, $type) {

		if ($type == 'current') {
			$past_replies	 = $candidate_data['past_replies'];
			$date_note = "90 days.";		
		} else {
			//get archive info
			$past_replies	 = $candidate_data;
			$date_note = "2 years.";													
		}
?>		
	<div class='container'>
		<div class="row">
			<div class="col-md-12 text-center">
				<h2>Previous applications</h1>
				<h4><? echo $general_array['firstname'] ?> <? echo $general_array['lastname'] ?> previously applied to jobs at your location listed below.</h4>
				<i>This list only contains jobs from the last <? echo $date_note ?></i><br />
				&nbsp; <br />
			</div>
		</div>
		
		<div class="row hidden-xs">
			<div class="col-md-offset-2 col-md-4">
				<h4>Job Title</h5>
			</div>
			<div class="col-md-4">			
				<h4>Date</h5>
			</div>
		</div>
<?php
	
	if (count($past_replies) > 0) {
		foreach ($past_replies as $row) {
?>		
		<div class="row">
			<div class="col-md-offset-2 col-md-4 col-xs-offset-1 col-xs-5">
				<? echo $row['title'] ?>
			</div>	
			<div class="col-md-4 col-xs-5">			
				<? echo date('M j, Y', strtotime($row['date_responded'])) ?>
			</div>
		</div>
<?php
		}
	} else {
?>
		<div class="row" style="margin-bottom:70px">
			<div class="col-md-offset-2 col-md-10 col-xs-offset-1 col-xs-10">
				<b><i>&nbsp;  No past applications</i></b><br />
			</div>
		</div>
<?php
		}
		
	if ($type == "current") {
?>
		<div class="row" style="margin-bottom:20px">
			<div class="col-md-offset-2 col-md-10">
				<a href='candidate.php?ID=<? echo $_GET['ID'] ?>&matchID=<? echo $_GET['matchID'] ?>&page=archive_replies' class='btn btn-large btn-primary archive' id='post'>Check Archive (max. 2-years)</a><br /> &nbsp; <br /><i>(this may take a few moments)</i>
			</div>
		</div>
<?php
	}
?>	
</div>
<?php	
}
?>