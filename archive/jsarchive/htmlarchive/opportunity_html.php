<?php
function opportunity_html($button_type, $opportunity_data, $employee_data, $answer_array, $email_verification, $group_jobs, $empty) {
$utilities = new Utilities;
//==================================
//!  First break master arrays into trait arrays
//
//  Modify any data for presentation
//==================================
		$job_data						= $opportunity_data['job_data'];

		$post_type					= $job_data['general']['post_type'];
		$bounty						= $job_data['general']['bounty'];
		$hash							= $job_data['general']['public_hash'];

		$jobID							= $job_data['general']['jobID'];
		$store_name					= $job_data['store']['name'];
		$address						= $job_data['store']['address'];
		$zip								= $job_data['store']['zip'];
		$website						= $job_data['store']['website'];
		$facebook						= $job_data['store']['facebook'];
		$twitter							= $job_data['store']['twitter'];
		$store_type					= $job_data['store']['description'];
		$image							= $job_data['store']['image'];
		$template						= $job_data['general']['template'];

		$employer 					= $job_data['employer'];
		$title		 						= $job_data['general']['title'];
		$requirements		 		= $job_data['requirements'];
		$notes							= $job_data['general']['description'];
		$qualifications				= $job_data['general']['qualifications'];
		$main_skill		 			= $job_data['skills']['main_skill']['specialty'];
		$specialtyID			 		= $job_data['skills']['main_skill']['ID'];
		$benefits						= $job_data['general']['benefits'];
		$benefits_desc				= $job_data['general']['benefits_desc'];
		$walkin							= $job_data['general']['walkin'];
		$walkin_desc					= $job_data['general']['walkin_desc'];
		$schedule						= $job_data['general']['schedule'];
		$comp_type					= $job_data['general']['comp_type'];
		$comp_value					= $job_data['general']['comp_value'];
		$comp_value_high			= $job_data['general']['comp_value_high'];
		$comp_value_low			= $job_data['general']['comp_value_low'];		
		$question_array				= $job_data['question_list']['questions'];
		$sub_skills						= $job_data['skills']['sub_skills'];
		$employment					= $job_data['general']['past_employment'];
		$date_created				= $job_data['general']['date_created'];
		
		if ($employee_data != "employer") {
			$response_data 				= $opportunity_data['response_data'];
			$employee_info		 			= $employee_data['general'];
			$past_employment		 	= $employee_data['employment'];
			$employment_version		= $employee_data['employment_version'];
			$personal_message			= $employee_data['personal_message']['message'];
			$saved_answer_array			= $employee_data['saved_answers'];
			$profile_status					= $employee_data['general']['profile_status'];
		} else {
			$response_data 				= array();
			$employee_info		 			= "";
			$past_employment		 	= "";
		}

		$notes = $utilities->clickable_links($notes);

		$city_state = $utilities->get_city_state($zip);
		
		//string for google map
		$google_name = str_replace(" ", "+", $store_name);
		$google_city = str_replace(" ", "+", $city_state['city']);
//		$google_address = $google_name."+".$google_city."+".$city_state['state']."+".$zip;
		$google_address = $address."+".$google_city."+".$city_state['state']."+".$zip;
							
		switch($comp_type) {
			default:
				$compensation = $comp_type;
			break;
			
			case "Hourly":
				if($comp_value > 0 && $comp_value_high == "" && $comp_value_low == "") {
					if ($comp_value_high == 0 && $comp_value_low == 0) {
						$compensation = "$".$comp_value."/hr";
					}
				} else if ($comp_value_high == $comp_value_low) {
					$compensation = "$".$comp_value_high."/hr";
				} else {
					$compensation = "$".$comp_value_low."/hr - $".$comp_value_high."/hr";
				}
			break;
			
			case "Salary":
				if($comp_value > 0 && $comp_value_high == "" && $comp_value_low == "") {
					if ($comp_value_high == 0 && $comp_value_low == 0) {
						$compensation = "$".$comp_value."/Yr";
					}
				} else if ($comp_value_high == $comp_value_low) {
					$compensation = "$".$comp_value_high."/Yr";
				} else {
					$compensation = "$".$comp_value_low."/Yr - $".$comp_value_high."/Yr";
				}
			break;				
		}		
		

		if ($benefits == "Y") {
			$benefits_text =	$benefits_desc;
		} else {
			$benefits_text = 	"None";				
		}
		
		if ($walkin == "Y") {
			$walkin_text =	"".$walkin_desc." - <i>Please mention ServeBartendCook</i>";
		} else {
			$walkin_text = 	"Not Preferred";				
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
		
		
		$lower_button = "N";
		
		if ($image == "") {
			$image = "<h4 style='margin-top:20px; margin-bottom:25px;'>No Company<br/>Logo</h4>";
		} else {
			$image = "<img src='images/store_pics/".$image."?".time()."' class='center-block profilephoto' style='max-height:150px;max-width:150px;height:auto;width:auto'>";
		}
		
//***********  END VARIABLE SETUP			GOOGLE API KEY - AIzaSyDb95KTBjE8mIPl_bvDMxs1vvLkyLhAiXs											
?>

    <!-- ======== @Region: #content ======== -->
    <div id="content" style="min-height: 70%">

    <!-- Profile block -->
    	<div class="block-contained" >
            <div class="col-md-4 job_details_large">
                <div class="text-center">
				     <h2 class="block-title titlename"><? echo $title ?> </h2>
					    <ul class="oppnotes">
                            <li><? echo $store_type ?></li>
							<li><i class="fa fa-map-marker" aria-hidden="true"></i> <? echo $address." ".$city_state['city']." ".$city_state['state'].", ".$zip ?></li>
                        </ul>
                    <div class="row panel-opportunity-photo">
						<div class="col-md-12 col-xs-6">
							<? echo $image ?>
						</div>
						<div class="col-md-12 col-xs-6 ">
							<div class="opportunitymap embed-container ">
								<iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDb95KTBjE8mIPl_bvDMxs1vvLkyLhAiXs	&q=<? echo $google_address ?>" width="300" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
		                    </div>
							
<!--
                      		<div class="portfoliophotos">
                          		<img src="images/opportunity-photo01.jpg">
						  		<img src="images/opportunity-photo02.jpg">
						  		<img src="images/opportunity-photo03.jpg">
						  		<img src="images/opportunity-photo04.jpg">
                        	</div>
-->
						</div>
                    </div>
<!--
					<div class="opportunitymap embed-container hidden-xs">
						<iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDb95KTBjE8mIPl_bvDMxs1vvLkyLhAiXs	&q=<? echo $google_address ?>" width="300" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
-->
                </div>

                <div class="row endorsements hidden-xs">
					<div class="col-md-12">
                 		<h4>Recent Posts from <? echo $store_name ?></h4>
<?php
						if (count($group_jobs) > 0) {	
							$count = 0;
							
							foreach($group_jobs as $row) {
								if ($row['job_status'] == "Open" && $row['jobID'] != $_GET['ID']) {
									$count++;
?>                 		
							 	    <div class="row other_job" id="<? echo $row['jobID'] ?>&hash=<? echo $row['public_hash'] ?>" style="cursor:pointer">
										<div class="col-md-12"><h5><i class="fa fa-circle-thin" aria-hidden="true"></i> <? echo $row['title'] ?></h5></div>
			                    	</div>
<?php
								}
							}
							
							if ($count == 0) {
								echo "<h5> - No other current jobs</h5>";								
							}
						} else {
							echo "<h5> - No other current jobs</h5>";								
						}
?>
					</div>
                </div>
            </div>

            <div class="col-md-8 job_details">
				<div  class="row">
					<div class="col-md-12">
						<h2 class="block-title positiontitle"><? echo $store_name ?></h2>
					</div>
				</div>
            </div>

            <div class="col-md-8 job_details">
                <div class="row pastwrap">
                    <div class="col-md-12">
						<div class="row">

<?php
//The apply button only appears in the case that this is a non-expired job, being viewed by an employeewho has not already applied, otherwise something else appears
	switch($button_type) {
		case "all":
			//IN THIS CASE THE EMPLOYEE HAS ALREADY RESPONDED, SO DO NOT SHOW BUTTON, JUST SHOW DATE RESPONDED
			if ($response_data['employee_interest'] == "Y") {
				$lower_button = "Y";
?>
						<div class="col-md-12">
							<h4 style='margin-bottom:10px; margin-top:-10px; color: #ff5821!important'>You responded to this job on: <? echo date('M j, Y', strtotime($response_data['date_responded'])) ?></h4>
		                    <div id="copy_link" style="margin-top: 15px">
		                    	<a href='#' class="btn" id="copy_btn" data-clipboard-text="https://servebartendcook.com/public_listing_new.php?ID=<? echo $_GET['ID'] ?>&ref=<? echo $_GET['hash'] ?>&utm_source=site&utm_medium=job_seeker&utm_campaign=share&utm_keyword=<? echo $_SESSION['userID'] ?>"><i class="fa fa-share-alt-square" aria-hidden="true"></i> Share Job With a Friend</a>
		                	</div>
		                	<div id="copy_notice" style="color:red; margin-top: 15px; display:none">
		                    	<i>Job link copied to clipboard</i> - Paste on Social Media, Messengers, Email or Anywhere!</i>
		                	</div>	                        	

						</div>

<?php				
			} else {
			//IN THIS CASE THE EMPLOYEE HAS NOT YET APPLIED, SO SHOW APLY BUTTON
?>
                            <div class="col-md-6">
	                            <a href="#" id="interested" class="btn btn-more  btn-lg i-right" style="background-color: #ff5821; color: #fff;" >APPLY NOW <i class="fa fa-angle-right"></i></a>
			                    <div id="copy_link" style="margin-top: 15px">
			                    	<a href='#' class="btn" id="copy_btn" data-clipboard-text="https://servebartendcook.com/public_listing_new.php?ID=<? echo $_GET['ID'] ?>&ref=<? echo $_GET['hash'] ?>&utm_source=site&utm_medium=job_seeker&utm_campaign=share&utm_keyword=<? echo $_SESSION['userID'] ?>"><i class="fa fa-share-alt-square" aria-hidden="true"></i> Share Job With a Friend</a>
			                	</div>
			                	<div id="copy_notice" style="color:red; margin-top: 15px; display:none">
			                    	<i>Job link copied to clipboard</i> - Paste on Social Media, Messengers, Email or Anywhere!</i>
			                	</div>	                        	
	                        </div>
                            <div class="col-md-6"></div>
<?php
			}
		break;
		
		case "expired":
			if ($response_data['employee_interest'] == "Y") {
			//IN THIS CASE THE JOB IS EXPIRED AND THE USER HAS APPLIED PREVIOUSLY, SHOW THE DATE THEY APLIED		
?>
						<div class="col-md-12">
							<h5 style='margin-bottom:3px; margin-top:-10px; color: #ff5821!important'>This opportunity has expired.</h4>
						</div>

						<div class="col-md-12">
							<h4 style='margin-bottom:10px; color: #ff5821!important'>You responded to this job on: <? echo date('M j, Y', strtotime($response_data['date_responded'])) ?></h4>
						</div>
<?php
			} else {
			//THIS CASE THE JOB IS EXPIRED, USER NEVER APPLIED - SHOULD ONLY GET HERE ACCIDENTALLY
?>
						<div class="col-md-12">
							<h5 style='margin-bottom:10px; margin-top:-10px; color: #ff5821!important'>This opportunity has expired.</h4>
						</div>
<?php
			}
		break;				
		
		case "employer":
		//THIS CASE IS AN EMPLOYER PREVIEWING THEIR JOB, THE BUTTON APPLY APPEARS BUT IS INACTIVE
?>
                            <div class="col-md-6"><a href="job.php?ID=<? echo $jobID ?>&page=edit" class="btn btn-more btn-lg i-right" style="background-color: #ff5821; color: #fff;">EDIT JOB POST<i class="fa fa-angle-right"></i></a></div>
                            <div class="col-md-6"></div>
<?php
		break;
	}	
?>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">Date Posted:</div>
                            <div class="col-xs-6"><? echo date('M j, Y', strtotime($date_created)) ?></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">Schedule:</div>
                            <div class="col-xs-6"><? echo $schedule ?></div>
                        </div>
						<div class="row">
                            <div class="col-xs-6">Compensation:</div>
                            <div class="col-xs-6"><? echo $compensation ?></div>
                        </div>
						<div class="row">
                            <div class="col-xs-6">Benefits:</div>
                            <div class="col-xs-6"><? echo $benefits_text ?></div>
                        </div>
<?php
						if ($walkin == "Y") {
?>
							<div class="row">
	                            <div class="col-xs-6">Walk-ins Allowed:</div>
	                            <div class="col-xs-6"><? echo $walkin_text ?></div>
	                        </div>
<?php							
						}
?>                        
                    </div>
                </div>

<?php
		if ($template != "custom_b") {
?>
                <div class="row profileskills">
                    <div class="col-md-12">
                        <h4>Preferred Job Skills - <? echo $main_skill ?></h4>
                        <div class="row">
<?php
							if (count($sub_skills) == 0) { 
?>
  	                        	<div class="col-md-6 jobskills"><i>No specific skills required for this positions</i></div>
<?php								
							} else {
								foreach($sub_skills as $row) {
?>
									<div class="col-md-6 jobskills"><i class="fa fa-star-o" aria-hidden="true"></i> <? echo $row['sub_specialty'] ?></div>
<?php									
								}							
							}
?>
                        </div>
                    </div>
                </div>

                <div class="row addrequire">
					<div class="col-md-12">   
						<h4>Additional Requirements</h4>				
                   		<ul class="fa-ul">
<?php
							if (count($requirements) == 0) {
?>
		                        <li><i> No additional requirements</i></li>
<?php								
							} else {
								foreach($requirements as $row) {
?>
			                        <li><i class="fa-li fa fa-check-circle-o"></i> <? echo $row ['requirement'] ?></li>
<?php									
								}																
							}
?>
						</ul>
					</div>
                </div>
 <?php
		}
?>
               
<?php
				if ($notes != "") {
?>                
                <div class="row extrainfo">
                    <div class="col-md-12">
	                        <h4>Other Details</h4> <? echo nl2br($notes) ?>
                    </div>
                </div>
<?php							
				} 
?>
                
                <div class="row addrequire">
                    <div class="col-md-12">
	                    <h4>Pre-Interview Questions</h4>
                   		<ul class="fa-ul">
<?php
							if (count($question_array) == 0) {
?>
		                        <li><i> No pre-interview questions required</i></li>
<?php								
							} else {
								foreach($question_array as $row) {
?>
			                        <li><i class="fa-li fa fa-question-circle-o"></i> <? echo $row ['question'] ?></li>
<?php									
								}																
							}
?>
						</ul>
                    </div>
					<div class="col-md-12">
						&nbsp;
					</div>          
                </div>
                
            </div>
<!-- APPLICATION FORM APPEARS WHEN BUTTON IS PRESSED -->                
    <div class="col-md-8 " id='interested_warning_form' style="display:none">				
<?php
		application_warning_form($employee_data, $question_array, $saved_answer_array, $personal_message, $post_type, $empty, $email_verification, $title, $store_name);
?>
	</div>	

    <div class="col-md-8 " id='interested_form' style="display:none">				
<?php
		application_form($employee_data, $question_array, $saved_answer_array, $personal_message, $post_type, $empty, $email_verification, $title, $store_name);
?>
	</div>
</div>
<?php
 }

function application_form($employee_data, $question_array, $saved_answer_array, $personal_message, $post_type, $empty, $email_verification, $title, $store_name) {
?>
    <div class="row pastwrap">
 
             <div class="col-md-12">
				<div  class="row">
					<div class="col-md-12 text-center">
						<h2 class="block-title positiontitle">APPLICATION</h2>
					</div>

					<div class="col-md-12">
						<h2 class="block-title " style='margin-top:20px'><? echo $title ?> @ <? echo $store_name ?></h2>
					</div>
					<div class="col-md-12">
						<h5 style='margin-top:0px; margin-bottom:20px'>Your profile will serve as your resume.</h4>
					</div>
				</div>
            </div><br />
        <div class="col-md-12">
			<div>
				<div class="form-group">
					<label for="phone">Phone Number</label>
					<div id='phone_warning' style='display:none; color:red'><b>Please include a contact phone number below.</b></div>
					<input type='tel' id='phone' class="form-control" value='<? echo $employee_data['general']['contact_phone'] ?>'><br />
				</div>	
			
				<input type='hidden' id='question_count' value='<? echo count($question_array) ?>'>
<?php
				$count = 1;
				if (count($question_array) > 0) {
?>
				<h4>Pre-Interview Questions</h4>
				This employer has requested that candidates answer the pre-interview questions below:<br/>
				
				<div class="form-group" style='margin-top:15px;'>
					<div id='empty_warning' style="display:none; color:red"><b>You must answer all questions below.</b></div>
<?php
						foreach ($question_array as $question) {
							//determine if they user has an answer saved
							$employee_answer = "";
							if (count($saved_answer_array) > 0) {
								foreach($saved_answer_array as $answer) {
									if ($answer['template_questionID'] == $question['template_questionID']) {
										$employee_answer = $answer['answer'];
									}
								}
							}
?>			
						<input type='hidden' id='questionID_<? echo $count ?>' value='<? echo $question['questionID'] ?>'>					
						<label for="answer_<? echo $count ?>"><? echo $question['question'] ?></label>
						<div id='charNum_<? echo $count ?>' style="color:black; margin-bottom:2px; padding-left:15px;"></div>						
						<textarea id='answer_<? echo $count ?>'  class="form-control" rows='3' maxlength='250'><? echo $employee_answer ?></textarea>
<?php
						$count++;
						if ($count != count($question)) {
							echo "<br />";
						}
		}
?>
					<div class="checkbox" style='margin-top:-10px'>
						<label>
					    	<input type="checkbox" class='save_answers unselected_button' id='save_answers' data-save_answer='unselected' value="">
							<i>Remember the above answers for future jobs.</i>	
						</label>
					</div>
		</div>
<?php							
	}
?>	
		<br />
		<div class="form-group">
			<h4>Personal Message</h4>
			<label for="personal_message">(Optional)</label>
		
<!-- 			<div style="color:gray; margin-left:10px; float:left; width:100%"><i>You may enter a personal message for this employer below:</i></div> -->
			<div id='charNum_message' style="color:black; margin-bottom:2px; margin-left:10px;"></div>										
			<textarea id='personal_message' class="form-control" rows='3' maxlength='250' placeholder='e.g. reason why you want to work their establishment, a reference that currently works at their establishment, etc.'><? echo $personal_message ?></textarea>

			<div class="checkbox">
				<label>
			    	<input type="checkbox" class='save_message unselected_button' id='save_message' data-save_message='unselected' value="">
					<i>Remember this message for future jobs.</i>	
				</label>
			</div>
        </div>
    </div>
						
	&nbsp; <br />
     <div class="col-md-12" style="margin-bottom: 50px">
	
		<b>Your profile, contact information, and any information entered below will be viewable by the person who posted this job.</b><br />
		&nbsp; <br />			
		<a href='#' class='btn btn-large btn-primary' id='submit_interested'>Submit Application</a> <a href='#' class='btn btn-large btn-primary' id='cancel'>Cancel</a><br />
		<div style="margin-top: 10px;"><b>Note: </b>Submitting a request does NOT guarantee an interview.  Hiring decisions and Interviews are at the sole discretion of the employer.</div>			
     </div>
	</div>
 </div>
<?php
		//HIDDEN FORM
	echo "<input type='hidden' id='hash' value='".$_GET['hash']."'>";

}
	
function application_warning_form($employee_data, $question_array, $saved_answer_array, $personal_message, $post_type, $empty, $email_verification, $title, $store_name) {
?>
    <div class="row pastwrap">
		<div class="col-md-12" >

<?php			
				if ($email_verification != "Y") {
?>
					<h4>To apply to this position you will need to:</h4><br/>
						<a href='main.php?page=verify_email' class='btn btn-primary'>Verify Your Email Address</a>
						<br />			
<?php													
				} elseif ($empty == "Y") {
?>
					<h4>Your profile doesn't contain any past employment or skills</h4><br />
					<a href='employee.php?page=profile_menu' class='btn btn-primary'>Complete Your Profile</a><br />
					&nbsp; <br />		
					<h5><a href="#" id="apply_anyway">Apply Anyway</a></h5>
					<i>An incomplete profile may reduce your chances of getting any interview</i>
<?php					
				}	
?>
		</div>
    </div>
<?php			
	
}


function opportunity_application_sent() {
?>	
	<div class='container' style="min-height: 70%">

		<h2 style="text-align:center">Application Sent</h2>
		
		<div class="row">
			<div class="col-md-12 col-xs-offset-1 col-xs-10">
		
				The employer has been notified of your interest.  If the employer is interested, they will contact you directly via the contact information you have included on your profile.<br />
				&nbsp; <br />
				<b>Remember </b>- Having a complete profile with no spelling or grammar errors increases your chance of getting an interview.<br />
				&nbsp; <br />			
			</div>
		</div>

		<div class="row text-center" style="margin-bottom:5px;">		
			<h2>Good Luck!</h5>
			<hr>
		</div>
		
		<div class="row text-center" id="suggestion_list_holder" style="margin-bottom:15px;">		
			<b>&nbsp; </b>
		</div>
	</div>
<?php
}

function suggestion_list_html($random_suggestion) {
	if (count($random_suggestion) == 3) {
?>
	<div class="row" id="suggestion_list_holder" style="margin-bottom:15px;">		

		<h2 style="text-align: center">Help Our Hospitality Community</h2>
		<h5 style="text-align: center; margin-bottom: 30px;"><i>Please share one of the jobs below:</i></h4>
		
		
<?php
		foreach($random_suggestion as $row) {
			if ($row['image'] == "") {			
				switch($row['specialty']) {
					case "Bartender":
						$image = "<img src='images/main-bar.png' class='profilephoto' style='max-height:50px;max-width:50px;height:auto;width:auto'>";
					break;
					
					case "Server":
						$image = "<img src='images/main-server.png' class='profilephoto' style='max-height:50px;max-width:50px;height:auto;width:auto'>";
					break;
					
					case "Kitchen":
						$image = "<img src='images/main-cook.png' class='profilephoto' style='max-height:50px;max-width:50px;height:auto;width:auto'>";
					break;		
					
					case "Host":
						$image = "<img src='images/main-host.png' class='profilephoto' style='max-height:50px;max-width:50px;height:auto;width:auto'>";
					break;
												
					case "Bus":
						$image = "<img src='images/main-bus.png' class='profilephoto' style='max-height:50px;max-width:50px;height:auto;width:auto'>";
					break;
	
					case "Manager":
						$image = "<img src='images/main-manager.png' class='profilephoto' style='max-height:50px;max-width:50px;height:auto;width:auto'>";
					break;					
					
				}
				
			} else {
				//$image = "images/store_pics/".$row['image']."?".time();
				$image = "<img src='images/store_pics/".$row['image']."?".time()."' class='profilephoto' style='max-height:50px;max-width:50px;height:auto;width:auto'>";
			}

		switch($row['comp_type']) {
			default:
				$compensation = $row['comp_type'];
			break;
			
			case "Hourly":
				if ($row['comp_value'] > 0) {
					$compensation = "$".$row['comp_value']."/hr";
					$comp_filter = $row['comp_value'];
				} elseif ($row['comp_value_low'] == $row['comp_value_high']) {
					$compensation = "$".$row['comp_value_high']."/hr";
					$comp_filter = $row['comp_value_high'];					
				} else {
					$compensation = "$".$row['comp_value_low']."/hr - $".$row['comp_value_high']."/hr";
					$comp_filter = $row['comp_value_high'];
				}
			break;
			
			case "Salary":
				$compensation = "Salary:  $".number_format($row['comp_value']);
				if ($row['comp_value'] > 0) {
					$compensation = "$".number_format($row['comp_value']);
					$comp_filter = $row['comp_value'];
				} elseif ($row['comp_value_low'] == $row['comp_value_high']) {
					$compensation = "$".number_format($row['comp_value_high']);
					$comp_filter = $row['comp_value_high'];
				} else {
					$compensation = "$".number_format($row['comp_value_low'])." - $".number_format($row['comp_value_high']);
					$comp_filter = $row['comp_value_high'];
				}
			break;				
		}			
?>		
			<div class="col-md-4" style="margin-bottom: 15px;">	
					<div class="row">
						<div class="col-md-2 col-xs-2 col-xs-offset-1 col-md-offset-0 text-right" style="margin-top: 7px">
				        	<a href="opportunity.php?ID=<? echo $row['jobID'] ?>&hash=<? echo $row['public_hash'] ?>">
				        		<? echo $image ?>
				        	</a>
			        	</div>			        	

						<div class="col-md-10 col-xs-8">
							<? echo $row['title']; ?><br />
							<? echo $row['name']; ?><br />
							<? echo $compensation; ?>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-11 col-xs-11 col-xs-offset-1 col-md-offset-1">
		                    <div id="copy_link_<? echo $row['jobID'] ?>" style="margin-top: 0px">
		                    	<a href='#' class="btn copy_btn_suggest" id="<? echo $row['jobID'] ?>" data-clipboard-text="https://servebartendcook.com/public_listing_new.php?ID=<? echo $row['jobID'] ?>&ref=<? echo $row['public_hash'] ?>&utm_source=site&utm_medium=job_seeker&utm_campaign=share&utm_keyword=<? echo $_SESSION['userID'] ?>"><i class="fa fa-share-alt-square" aria-hidden="true"></i> Share Job With a Friend</a>
		                	</div>
		                	<div id="copy_notice_<? echo $row['jobID'] ?>" class="copy_notice_<? echo $row['jobID'] ?>" style="color:red; margin-top: 0px; display:none">
		                    	<i>Job link copied to clipboard</i> - Paste on Social Media, Messengers, Email or Anywhere!</i>
		                	</div>	                        	
						</div>						
					</div>
			</div>
<?php
		}	
?>
	</div>
<?php	
	}				
}

function opportunity_html_expired() {				
?>	
		<h1>Expired Listing</h1>
		
		<table class="dark">
			<tr><td>This Job Listing has expired and is no longer available</td></tr>
		</table>					
<?php
}	

	
function opportunity_html_removed() {					
?>	
		<h1>Job Removed</h1>
		
		<table class="dark">
			<tr><td>This Job Listing has been removed from the site.</td></tr>
		</table>					
<?php			
}
