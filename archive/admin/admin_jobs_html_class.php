<?php
	function current_jobs_html($jobs_array) {
		
		switch($_GET['zip']) {
			case "all":
				$region = "All";
			break;
			
			case "other":
				$region = "Other";
			break;
			
			case "32801":
				$region = "Orlando";
			break;
			
			case "33602":
				$region = "Tampa";
			break;
			
			case "33147":
				$region = "Miami";
			break;
			
			case "32202":
				$region = "Jacksonville";
			break;
		}		
		
		
		//get type counts
		$server_count = 0;
		$bartender_count = 0;
		$kitchen_count = 0;
		$manager_count = 0;
		$host_count = 0;
		$bus_count = 0;

		foreach($jobs_array as $row) {
			switch($row['specialty']) {
				case "Server":
					$server_count ++;
				break;
				
				case "Bartender":
					$bartender_count ++;
				break;

				case "Kitchen":
					$kitchen_count ++;
				break;

				case "Manager":
					$manager_count ++;
				break;

				case "Host":
					$host_count ++;
				break;

				case "Bus":
					$bus_count ++;
				break;				
			}	
		}		
		
?>		
	<div class="container">
		<h1 style="display:inline;">Job List - <? echo $region ?></h1> &nbsp; &nbsp; <a href="admin.php"><button>Admin Home</button></a>	
		<br /> &nbsp; <br />
		<b>Server Jobs: </b><? echo $server_count ?><br />
		<b>Bartender Jobs: </b><? echo $bartender_count ?><br />
		<b>Kitchen Jobs: </b><? echo $kitchen_count ?><br />
		<b>Manager Jobs: </b><? echo $manager_count ?><br />
		<b>Host Jobs: </b><? echo $host_count ?><br />
		<b>Bus Jobs: </b><? echo $bus_count ?><br />
		
		<table class="dark">
			<tr>
				<th style="width: 250px;">Job Title</th>
				<th style="width: 80px;" class='info' id='reach_box'>Store</th>
				<th style="width: 60px;" class='info' id='views_box'>Job Type</th>
				<th style="width: 60px;" class='info' id='interest_box'>Date Created</th>												
				<th style="width: 60px;" class='info' id='declines_box'>Expiration Date</th>
			</tr>	
		</table>

		<table class='dark'>
<?php
		foreach($jobs_array as $row) {
			echo "<tr>";
				echo "<td style='width: 250px;'><a href='admin.php?page=view_job&type=current&id=".$row['jobID']."'>".$row['title']."</a></td>";
				echo "<td style='width: 80px;'>".$row['name']."</td>";	
				echo "<td style='width: 60px;'>".$row['specialty']."</td>";	
				echo "<td style='width: 60px;'>".$row['date_created']."</td>";						
				echo "<td style='width: 60px;'>".$row['expiration_date']."</td>";						
			echo "</tr>";		
		}
?>
		</table>
		<hr>
	</div>	
<?php
	}
	
	function archive_jobs_html($archive_array) {
?>		
	<div class="container">
		<h1 style="display:inline;">Archived Job List</h1> &nbsp; &nbsp; <a href="admin.php"><button>Admin Home</button></a>	
		<br /> &nbsp; <br />
		<hr>	
		<table class='dark'>
<?php
		echo count($archive_array);
		foreach($archive_array as $row) {
			echo "<tr>";
			echo "<td><a href='admin.php?page=view_job&type=archive&id=".$row['jobID']."'>".$row['title']."</a></td>";
			echo "<td>".$row['name']."</td>";	
			echo "<td>".$row['expiration_date']."</td>";
			echo "<td><a href='#' class='unarchive' id='".$row['jobID']."'>Un-Archive</a></td>";															
			echo "</tr>";		
		}
?>
		</table>
		<hr>	
	</div>
<?php
	}
	
function jobs_by_store($jobs_array) {
				
		//get type counts
		$server_count = 0;
		$bartender_count = 0;
		$kitchen_count = 0;
		$manager_count = 0;
		$host_count = 0;
		$bus_count = 0;

		foreach($jobs_array as $row) {
			switch($row['specialty']) {
				case "Server":
					$server_count ++;
				break;
				
				case "Bartender":
					$bartender_count ++;
				break;

				case "Kitchen":
					$kitchen_count ++;
				break;

				case "Manager":
					$manager_count ++;
				break;

				case "Host":
					$host_count ++;
				break;

				case "Bus":
					$bus_count ++;
				break;				
			}	
		}		
		
?>		
	<div class="container">
		<h1 style="display:inline;">Job List</h1> &nbsp; &nbsp; <a href="admin.php"><button>Admin Home</button></a>	
		<br /> &nbsp; <br />
		<b>Server Jobs: </b><? echo $server_count ?><br />
		<b>Bartender Jobs: </b><? echo $bartender_count ?><br />
		<b>Kitchen Jobs: </b><? echo $kitchen_count ?><br />
		<b>Manager Jobs: </b><? echo $manager_count ?><br />
		<b>Host Jobs: </b><? echo $host_count ?><br />
		<b>Bus Jobs: </b><? echo $bus_count ?><br />
		
		<table class="dark">
			<tr>
				<th style="width: 250px;">Job Title</th>
				<th style="width: 60px;" class='info' id='views_box'>Job Type</th>
				<th style="width: 60px;" class='info' id='interest_box'>Date Created</th>												
				<th style="width: 60px;" class='info' id='declines_box'>Expiration Date</th>
			</tr>	
		</table>

		<table class='dark'>
<?php
		foreach($jobs_array as $row) {
			echo "<tr>";
				echo "<td style='width: 250px;'><a href='admin.php?page=view_job&type=current&id=".$row['jobID']."'>".$row['title']."</a></td>";
				echo "<td style='width: 60px;'>".$row['specialty']."</td>";	
				echo "<td style='width: 60px;'>".$row['date_created']."</td>";						
				echo "<td style='width: 60px;'>".$row['expiration_date']."</td>";						
			echo "</tr>";		
		}
?>
		</table>
		<hr>
	</div>
<?php	
}

function culinary_jobs($jobs_array) {
			
?>		
	<div class="container">
		<h1>Culinary Intern Jobs</h1>
		<table class="dark">
			<tr>
				<th style="width: 250px;">Job Title</th>
				<th style="width: 60px;" class='info' id='interest_box'>Date Created</th>												
				<th style="width: 60px;" class='info' id='declines_box'>Expiration Date</th>
			</tr>	
		</table>

		<table class='dark'>
<?php
		foreach($jobs_array as $row) {
			echo "<tr>";
				echo "<td style='width: 250px;'><a href='admin.php?page=view_job&type=current&id=".$row['jobID']."'>".$row['title']."</a></td>";
				echo "<td style='width: 60px;'>".$row['date_created']."</td>";						
				echo "<td style='width: 60px;'>".$row['expiration_date']."</td>";						
			echo "</tr>";		
		}
?>
		</table>
		<hr>	
	</div>
<?php	
}
	
function view_job_html($job_data, $job_views) {
$utilities = new Utilities;

//==================================
//!  First break master arrays into trait arrays
//
//  Modify any data for presentation
//==================================
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

		$employer 					= $job_data['employer'];
		$title		 						= $job_data['general']['title'];
		$requirements		 		= $job_data['requirements'];
		$notes							= $job_data['general']['description'];
		$qualifications				= $job_data['general']['qualifications'];
		$main_skill		 			= $job_data['skills']['main_skill']['specialty'];
		$specialtyID			 		= $job_data['skills']['main_skill']['ID'];
		$benefits						= $job_data['general']['benefits'];
		$benefits_desc				= $job_data['general']['benefits_desc'];
		$schedule						= $job_data['general']['schedule'];
		$comp_type					= $job_data['general']['comp_type'];
		$comp_value					= $job_data['general']['comp_value'];
		$question_array				= $job_data['question_list']['questions'];
		$sub_skills						= $job_data['skills']['sub_skills'];
		$employment					= $job_data['general']['past_employment'];
		$date_created				= $job_data['general']['date_created'];
		
		$city_state = $utilities->get_city_state($zip);
		
		//string for google map
		$google_name = str_replace(" ", "+", $store_name);
		$google_city = str_replace(" ", "+", $city_state['city']);
		$google_address = $google_name."+".$google_city."+".$city_state['state']."+".$zip;
	
						
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
			$benefits_text =	"<i>".$benefits_desc."</i>";
		} else {
			$benefits_text = 	"None";				
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
		
		$lower_button = "N";
		
		if ($image == "") {
			$image = "<h4 style='margin-top:20px; margin-bottom:25px;'>No Company<br/>Logo</h4>";
		} else {
			$image = "<img src='images/store_pics/".$image."' class='profilephoto'>";
		}
		
		//echo var_dump($job_views);


		//get data about each person that responded
		$candidate_array = array();
		//echo var_dump($job_data['positive_list']);
		if (count($job_data['positive_list']) > 0) {
			foreach($job_data['positive_list'] as $row) {
				$candidate = new Candidate($row['matchID']);
				$candidate_data = $candidate->get_candidate();
				$skill_array = $candidate_data['employee_data']['skills']['skills'];
				$sub_skill = $candidate_data['employee_data']['skills']['sub_skills']; 
				
				$experience = 0;
				$skillID = "NA";
				foreach($skill_array as $skill) {
					if ($skill['skill'] == $job_data['skills']['main_skill']['specialty']) {
						$experience = $skill['experience'];
						$skillID = $skill['skillID'];
					}
				}

				$sub_skill_array = array();												
			
				if ($skillID != "NA") {
					$sub_skill_data = $sub_skill[$skillID];
					foreach($sub_skill_data as $data) {
						$sub_skill_array[] = $data['sub_skill'];
					}
				}

				$candidate_array[] = array("userID" => $row['userID'],
												"profile_pic" => $row['profile_pic'],
												"message" => $row['message'],
												"matchID" => $row['matchID'],
												"highlight" => $row['highlight'],
												"date_responded" => $row['date_responded'],
												"firstname" => $candidate_data['general']['firstname'],
												"lastname" => $candidate_data['general']['lastname'],
												"experience" => $experience,
												"sub_skills" => $sub_skill_array);
			}
		}


		
	echo "<div class='container'>";
		
		echo "<b>Remove Job:</b>  <input type='text' id='remove_job_pass'><br />";
		echo "<a href='#' class='remove_job' id='".$jobID."'>SUBMIT</a><br />";											
			
		echo "<div class='job_details'>";
			echo "<h2>Job Stats</h2>";
			echo "<b>Reach:</b> <a href='admin.php?page=view_matches&id=".$jobID."'>".$job_views['reach']."</a><br />";
			echo "<b>Qualified Views:</b> ".$job_views['qualified_views']."<br />";
			echo "<b>Unqualified Views:</b> ".$job_views['unqualified_views']."<br />";
			echo "<b>Unique Views:</b> ".$job_views['unique_views']."<br />";
			echo "<b>List Views:</b> ".$job_views['list_views']."<br />";
			echo "<b>Declines:</b> ".$job_views['declines']."<br />";
			echo "<b>Applied:</b> ".count($job_views['interested'])."<br />";
			echo "&nbsp; <br />";
			echo "<i>Allow Culinary Interns: ".$intern."<br />";
			echo "Require Past Employment: ".$employment."</i><br />";

			echo "<h2 style='text-align:center'>CANDIDATE JOB VIEW</h2>";
			echo "<div style='width:100%; float:left; text-align:center; margin-bottom:5px;'><b><i>This is how potential candidates view your job post</i></b></div>";

			echo	"<table class='dark' style='width:100%;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle'><h4>General Details</h4></th>";
				echo "</tr>";			
			echo "</table>";
			
?>

    <!-- ======== @Region: #content ======== -->
    <div id="content">

    <!-- Profile block -->
    	<div class="block-contained" >
            <div class="col-md-4 job_details_large">
                <div class="text-center">
				     <h2 class="block-title titlename"><? echo $store_name ?></h2>
					    <ul class="oppnotes">
                            <li><? echo $store_type ?></li>
							<li><i class="fa fa-map-marker" aria-hidden="true"></i> <? echo $address." ".$city_state['city']." ".$city_state['state'].", ".$zip ?></li>
                        </ul>
                    <div class="row panel-opportunity-photo">
						<div class="col-md-12 col-xs-6">
							<? echo $image ?>
						</div>
						<div class="col-md-12 col-xs-6">
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
					<div class="opportunitymap embed-container hidden-xs">
						<iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDb95KTBjE8mIPl_bvDMxs1vvLkyLhAiXs	&q=<? echo $google_address ?>" width="300" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>

                <div class="row endorsements hidden-xs">
					<div class="col-md-12">
                 		<h4>Recent Posts from <? echo $store_name ?></h4>
<?php
						if (count($group_jobs['job_data']) > 0) {	
							$count = 0;
							foreach($group_jobs['job_data'] as $row) {
								if ($row['job_status'] == "Open" && $row['jobID'] != $_GET['ID']) {
									$count++;
?>                 		
							 	    <div class="row other_job" id="<? echo $row['jobID'] ?>&hash=<? echo $row['public_hash'] ?>" style="cursor:pointer">
			                      		<div class="col-xs-4 padding-zero">
<!-- 								  			<img src="//graph.facebook.com/TwoChefsSeafood/picture?type=square&height=60" > -->
			                        	</div>
										<div class="col-xs-8 padding-top-sm"><h5><? echo $store_name ?></h5> <? echo $row['title'] ?></div>
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
						<h2 class="block-title positiontitle"><? echo $title ?> </h2>
					</div>
				</div>
            </div>

            <div class="col-md-8 job_details">
                <div class="row pastwrap">
                    <div class="col-md-12">
						<div class="row">

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
                    </div>
                </div>

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
				if ($notes != "") {
?>                
                <div class="row extrainfo">
                    <div class="col-md-12">
	                        <h4>Other Details</h4> <? echo $notes ?>
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
		                        <li><i> No additional requirements</i></li>
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
<!--
<?php
					if ($lower_button == "Y") {
?>          
					<div class="col-md-12">
						<a href="#" class="btn btn-more btn-apply btn-lg i-right">APPLY NOW<i class="fa fa-angle-right"></i></a>
					</div>
<?php
					}
?>                
-->
                </div>
                
                
<!--
                <div class="otheropp visible-xs">
     				<div class="col-md-12">
            	        <h4>Other Opportunities</h4>
						<div class="row">
                  	      	<div class="col-xs-4 padding-zero">
                   		         <img src="images/opportunity02-logo.png">
				   			</div>
				   			<div class="col-xs-8 padding-top-sm"><h5>SPOON</h5>Line Cook</div>
				   		</div>
				   		<div class="row">
                       		<div class="col-xs-4 padding-zero"><img src="images/opportunity03-logo.png">
						   	</div>
						   	<div class="col-xs-8 padding-top-sm"><h5>G IS FOR GRAPES</h5>Pour Manager</div>
                    	</div>
						<div class="row">
                    	    <div class="col-xs-4 padding-zero"><img src="images/opportunity04-logo.png">
                        </div>
                        <div class="col-xs-8 padding-top-sm"><h5>BLUE MUG</h5>Server</div>
                    </div>
				</div>
-->
            </div>
<?php

			echo	"<table class='dark' style='width:100%; margin-bottom:10px;'>";
				echo "<tr valign='middle'>";
				echo "<th valign='middle'></th>";
				echo "</tr>";			
			echo "</table>";
			
			echo "<h2>Applicants</h2>";
			
				echo "<table class='dark' id='candidates' style='width:625px;'>";
				echo "<tr><th>Candidate</th><th id='normal' class='sort_candidates' style='cursor: pointer;'>Responded</th><th>Features</th></tr>";
				if(count($candidate_array) > 0) {		

					foreach ($candidate_array as $candidate) {
						//Get Candidate Features
						if ($candidate['highlight'] == 'Y') {
							$candidate_features = "";
							$video_class = "";														
							foreach ($candidate_videos as $video) {
								if ($video['userID'] == $candidate['userID'])	 {
									$video_class = "candidate_video";
									$candidate_features .= "<img src='images/job-video.png'>";					
								}					
							}
							
							if ($candidate['profile_pic'] != "") {
								$photo_class = "candidate_photo";	
								$candidate_features .= "<img src='images/job-photo.png'>";													
							} else {
								$photo_class = "";														
							}
							
							if ($candidate['message'] != "") {
								$message_class = "candidate_message";	
								$candidate_features .= "<img src='images/job-note.png'>";																										
							} else {
								$message_class = "";														
							}						
														
							//turn sub_skill array into comma list
							$sub_skill_text = "";	
							if (count($candidate['sub_skills']) > 0) {
								foreach($candidate['sub_skills'] as $sub_skill) {
									$sub_skill_text .= $sub_skill.", ";
								}
							}			
							$candidate_class = $video_class." ".$photo_class." ".$message_class;
							echo "<tr class='candidate_row ".$candidate_class."' data-experience='".$candidate['experience']."' data-skills='".$sub_skill_text."' data-candidate_skill_filter='show' data-experience_filter='show'>";	
							echo "<td style='background-color:#e9e6de;'>".$highlight." <a href='admin.php?page=view_candidate&matchID=".$candidate['matchID']."'>".$candidate['firstname']." ".$candidate['lastname']."</a></td>";	
							echo "<td align='center' style='background-color:#e9e6de;'>".date('M j, Y', strtotime($candidate['date_responded']))."</td>";
							echo "<td align='center' style='background-color:#e9e6de;'>".$candidate_features."</td>";
							echo "</tr>";
						}
					}
					
					foreach ($candidate_array as $candidate) {
						//Get Candidate Features
						if ($candidate['highlight'] != 'Y') {
							$candidate_features = "";
							$video_class = "";														
/*
							foreach ($candidate_videos as $video) {
								if ($video['userID'] == $candidate['userID'])	 {
									$video_class = "candidate_video";
									$candidate_features .= "<img src='images/job-video.png'>";					
								}					
							}
*/
							
							if ($candidate['profile_pic'] != "") {
								$photo_class = "candidate_photo";	
								$candidate_features .= "<img src='images/job-photo.png'>";													
							} else {
								$photo_class = "";														
							}
							
							if ($candidate['message'] != "") {
								$message_class = "candidate_message";	
								$candidate_features .= "<img src='images/job-note.png'>";																										
							} else {
								$message_class = "";														
							}						
														
							$sub_skill_text = "";	
							if (count($candidate['sub_skills']) > 0) {
								foreach($candidate['sub_skills'] as $sub_skill) {
									$sub_skill_text .= $sub_skill." ";
								}
							}															

							$candidate_class = $video_class." ".$photo_class." ".$message_class;
							echo "<tr class='candidate_row ".$candidate_class."' data-experience='".$candidate['experience']."' data-skills='".$sub_skill_text."' data-candidate_skill_filter='show' data-experience_filter='show'>";	
							echo "<td ><a href='admin.php?page=view_candidate&matchID=".$candidate['matchID']."'>".$candidate['firstname']." ".$candidate['lastname']."</a></td>";	
							echo "<td align='center'>".date('M j, Y', strtotime($candidate['date_responded']))."</td>";
							echo "<td align='center'>".$candidate_features."</td>";
							echo "</tr>";
						}
					} 					 

					echo "</table>";
				} else {
					echo "<tr><td colspan='4'>&nbsp; No interested candidates yet.  <br /> &nbsp; You will be notified by email when a candidate is interested.</td></tr>";
					echo "</table>";
				}
		
		echo "</div>";	
		echo "</div>";														
	}	
	
	function match_list_html($match_array) {
		echo "<div class='container'>";
		echo "<h1>Job Matches</h1>";
		echo "Filter:  <a href='#' class='filter' id='all'>All</a> <a href='#' class='filter' id='Y'>Interested</a> <a href='#' class='filter' id='N'>Decline</a><br />";
		echo "<table class='dark'>";
		echo "<tr><th>Name</th><th>Response (Date)</th><th>Date Viewed</th><th>View Response</th></tr>";

		if (count($match_array) > 0) {
			foreach ($match_array as $row) {
				if ($row['employee_interest'] == "") {
					$response_date = "NA";
					$view_response = "NA";
				} else {
					$response_date = $row['date_responded'];	
					if ($row['employee_interest'] == "Y")	{
						$view_response = "<a href='admin.php?page=view_response&id=".$row['userID']."&matchID=".$row['matchID']."'>View Response</a>";
					} else {
						$view_response = "NA";
					}		
				}
				echo "<tr class='".$row['employee_interest']." members'>";
					echo "<td><a href='admin.php?page=member_details&id=".$row['userID']."'>".$row['lastname'].", ".$row['lastname']." </a></td>";
					echo "<td>".$row['employee_interest']." (".$response_date.")</td>";	
					echo "<td>".$row['date_viewed']."</td>";	
					echo "<td>".$view_response."</td>";																						
				echo "</tr>";
			}
		} else {
			echo "<tr><td colspan='5'>No Matches</td></tr>";
		}
		echo "</table>";
		echo "</div>";	
	}	
	
	function job_data_html() {
		echo "<div class='container'>";	
		echo "<h2>Select your criteria</h2>";
		
		echo "<form method='GET' action='admin.php'>";
		echo "Region: <input type='text' id='zip' name='zip'> (zip code, type 'all' for all members) <i>This includes a 40 mile radius</i><br />";
		echo "&nbsp; <br />";
		echo "Job Type:  <select name='skill' id='skill'>";
			echo "<option value='all'>All</option>";
			echo "<option value='Server'>Server</option>";
			echo "<option value='Bartender'>Bartender</option>";
			echo "<option value='Kitchen'>Kitchen</option>";
			echo "<option value='Host'>Host</option>";
			echo "<option value='Bus'>Bus</option>";
			echo "<option value='Manager'>Manager</option>";
		echo "</select><br />";
		echo "<input type='hidden' name='page' value='job_data'>";
		echo "<input type='hidden' name='type' value='search'>";		
		echo "<input type='submit'><br />";
		echo "&nbsp; <br />";
		echo "</form>";	
		echo "</div>";	
	}
	
	function job_data_results_html($job_array, $skill, $zip) {
		$admin = new Admin;
		$utilities = new Utilities;
		$member = new Member;
		$page = $_GET['number'];
		if ($page == "") {
			$page = 1;
		}
		
		$total_records = count($job_array);	
		$total_pages = ceil($total_records / 50);
		if ($page == $total_pages) {
			$next = "";
		} else {
			$next_page = $page + 1;
			$next = "<a href='admin.php?zip=".$zip."&skill=".$skill."&page=job_data&type=search&number=".$next_page."'>Next Page</a>";
		}
		
		if ($page == 1) {
			$prev = "";
		} else {
			$prev_page = $page - 1;
			$prev = "<a href='admin.php?zip=".$zip."&skill=".$skill."&page=job_data&type=search&number=".$prev_page."'>Prev Page</a>";
		}
		
		$deactivated_count = 0;
		foreach($job_array as $row) {
			if ($row['valid'] == 'N') {
				$deactivated_count++;				
			}		
		}
		
?>		
	<div class="container">
		<h1 style="display:inline;">Job List</h1> &nbsp; &nbsp; <a href="admin.php"><button>Admin Home</button></a><br />	
			<b>Skill: </b><? echo $skill ?>
			<br /> &nbsp; <br />
			Total Records:  <? echo $total_records ?> (<? echo $total_pages ?> pages) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <? echo $prev." | ".$next ?> <br />
			Deactivated = <? echo $deactivated_count ?> <br />
		<table class='dark'>
		<tr><th>Job</th><th>Store</th><th>Zip</th><th>Creation Date</th><th>Pay</th><th>Schedule</th><th>Questions</th><th>Reach</th><th>Views</th><th>Responses</th></tr> 
		
<?php
		
		$i = ($page - 1) * 50;
		$upper = $i + 49;
		
		if ($upper > $total_records) {
			$upper = $total_records;
		}
		while ($i <= $upper) {	
		
			$match_array = $admin->get_matches("job", $job_array[$i]['jobID']);
			$reach = count($match_array);
			$response_count = 0;
			$view_count = 0;		
			if ($reach > 0) {	
				foreach($match_array as $match) {
					if ($match['employee_interest'] == 'Y') {
						$response_count++;
					}
					
					if ($match['date_viewed'] > 0) {
						$view_count++;
					}			
				}
			}
			
			$job = new Job;
			$question_array = $job->get_job_details($job_array[$i]['jobID'], 'questions');
			if (count($question_array) > 0) {
				$questions = 'Y';
			} else {
				$questions = 'N';				
			}
		
			if ($job_array[$i]['comp_type'] == "Hourly") {
				$pay = $job_array[$i]['comp_value'];
			} else {
				if ($job_array[$i]['comp_type'] == "") {
					$pay = "NA";
				} else {
					$pay = $job_array[$i]['comp_type'];	
				}			
			}
		
			echo "<tr>";
			echo "<td><a href='admin.php?page=view_job&type=current&id=".$job_array[$i]['jobID']."'>".$job_array[$i]['title']."</a></td>";
			echo "<td>".$job_array[$i]['name']."</td>";	
			echo "<td align='center'>".$job_array[$i]['zip']."</td>";																		
			echo "<td align='center'>".$job_array[$i]['date_created']."</td>";
			echo "<td align='center'>".$pay."</td>";
			echo "<td align='center'>".$job_array[$i]['schedule']."</td>";	
			echo "<td align='center'>".$questions."</td>";								
			echo "<td align='center'>".$reach."</td>";	
			echo "<td align='center'>".$view_count."</td>";																	
			echo "<td align='center'>".$response_count."</td>";																																			
			echo "</tr>";	
			
			$i++;	
		}
?>
		</table>
		<hr>
	</div>	
<?php
	}	
	
function candidate_html($candidate_data, $total_experience, $employee_store_type, $employee_position_experience, $employee_skills_experience, $old_employee_skills) {
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
		
		if ($employee_array['general']['profile_pic'] == "" || $_SESSION['photo_setting'] == 'N') {
			$photo = "";
		} else {
			$photo = "<img src='images/profile_pics/".$employee_array['general']['profile_pic']."' height='100' width='100'>";						
		}			
			
//DETERMINE TABS FOR PAGE SWITCHING				
		$tab_count = 0;
		if (count($question_array) > 0) {
			$tab_count++;	
			$question_tab = "<a href='#' ><div class='unselected_tab profile_tab' id='questions' style='width:100px;'>Questions</div></a>";
		} else {
			$question_tab = "";
		}
		
		if ($response_array['message'] != "") {
			$tab_count++;	
			$message_tab = "<a href='#' ><div class='unselected_tab profile_tab' id='message' style='width:100px;'>Message</div></a>";
		} else {
			$message_tab = "";
		}
		
		if (count($past_replies) > 0) {
			$past_reply_notice = "<a href='candidate.php?ID=".$_GET['ID']."&matchID=".$_GET['matchID']."&page=past_replies'>YES - View Details</a>";
		} else {
			$past_reply_notice = "NO - <a href='candidate.php?ID=".$_GET['ID']."&matchID=".$_GET['matchID']."&page=archive_replies'>Check past 2 years</a>";			
		}
		
		if ($response_array['highlight'] == "Y") {
			$highlight_notice = "<font color='#FFD700' size='5px'><b>&#9733; </b></font>";
		} else {
			$highlight_notice = "";			
		}
		
/*******************
*
*  Profile HTML - Employee
*
********************/

	if ($tab_count > 0) {	
		echo "<a href='#' ><div class='selected_tab profile_tab' id='profile' style='width:100px;'>Profile</div></a>";
		echo $question_tab;
		echo $message_tab;
	}
	echo "<a href='candidate.php?ID=".$_GET['ID']."&matchID=".$_GET['matchID']."&type=printer'><div class='unselected_tab' style='width:150px; margin-left:2px;'>View as Application</div></a>";
	
?>
	<table class='dark' style='width:100%;'>
		<tr valign='middle'>
		<th valign='middle'><h4><? echo $highlight_notice ?><? echo $general_array['firstname'] ?> <? echo $general_array['lastname'] ?></h4></th>
		</tr>			
	</table>
			
	<div id="profile_holder" class='details'>
			
		<div style='float:left; width:20%; margin-top:8px'>
				<? echo $photo ?>
		</div>
				
			<div id='name_holder' style='width:70%; float:left;'>
				<h3 style='color: #760006; margin-bottom:8px'><? echo $general_array['firstname'] ?> <? echo $general_array['lastname'] ?></h4>
				
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

	<div class='main_box' id='profile_holder' style='width:100%; float:left; margin-top:4px'>		
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
	
	<div style='float:left; width:100%; background-color:#e9e6de; padding-top:20px; padding-bottom:20px' id='quote_holder'>
<?php
	if ($quote == "") {
		echo "<div style='margin-right:3.5%; margin-left:3.5%'><i>No personal quote</i></div>";
	} else {
		echo "<div style='margin-right:3.5%; margin-left:3.5%'><i>".$quote."</i></div>";		
	}
?>		
	</div>
	
	<div class='employee_profile_header'>Experience</div> 
		<table class='dark' style='margin-left:3.5%'>
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
				echo "<a href='candidate.php?page=specific_position&ID=".$candidateID."&matchID=".$matchID."&type=".$key."'>".$key.": ".$row."</a> <br />";
			}
		} else {
			echo "NONE";
		}	
		echo "</td>";
			echo "</tr>";
?>
		</table>
	
	<div class='employee_profile_header'>Skills</div>
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

	<div class='employee_profile_header'>Past Employment</div>
<?php
	echo "<table class='dark' style='margin-left:3.5%'>";	
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
					echo "<td width='45%;'><a href='http://".$row['website']."'><b>".$row['company']."</b></a>".$indicator." <br />".$row['position']."</td>";
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

	<div class='employee_profile_header'>Education</div>	
<?php
	echo "<table class='dark' style='margin-left:3.5%'>";	
	
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
?>

	<div class='employee_profile_header'>Certifications & Awards</div>	
<?php
		echo "<table class='dark' style='margin-left:3.5%'>";
			if (count($awards) > 0) {
				echo "<tr>";
					echo "<td><h3>AWARDS</h3></td>";
				echo "</tr>";
					
				foreach ($awards as $row) {
					echo "<tr>";
						echo "<td style='word-wrap: break-word;'>".$row['award']."</td>";
					echo "</tr>";
				}
			}
			
			if (count($certifications) > 0) {
				echo "<tr>";
					echo "<td><h3>CERTIFICATIONS</h3></td>";
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
?>


<?php 
	if ($description != "") {	
		echo "<div class='employee_profile_header' style='margin-bottom:10px'>General Description</div>";
		
		echo "<div style='float:left; width:100%; margin-top:5px; margin-left:3.5%; margin-right:3.5%;'>";
		echo "<div style='margin-left:2%; margin-right:3.5%; margin-bottom:3.5%; color:#8e8e8e'>";
			echo $description;
		echo "</div>";	
	}
	echo "<a href='#' id='report'>Report Inappropriate Content</a>";
	echo "</div>";
echo "</div>";
echo "</div>";
	
//=====================
//! 	HIDDEN DIVS FOR TABS
//=====================

	
	echo "<div class='details' id='message_holder' style='display:none; margin-left:10px; color:#760006'>";
		echo "<h4>Personal Message</h4>";
		echo "<div style='margin-left:5px;'>";
		echo $utilities->makeSafe_flat($response_array['message']);
		echo "</div>";
	echo "</div>";
	
	echo "<div class='details' id='questions_holder' style='display:none; margin-left:10px; color:#760006'>";
		echo "<h4>Pre-Interview Answers</h4>";

		if (count($question_array) > 0) {
			foreach ($question_array as $row) {
				echo "<div style='color:gray; margin-top:3px; margin-left:10px; float:left; width:100%'>";	
				echo "<i>".$row['question']."</i><br />";
				echo "</div><br />";
				echo "<div style='margin-top:4px; margin-bottom:10px; margin-left:10px; float:left; width:100%'>";	
				echo $utilities->makeSafe_flat($row['answer']);
				echo "</div>";
			}
		}
	echo "</div>";			
	}
?>