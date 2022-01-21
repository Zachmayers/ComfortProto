<?php
require_once('classes/utilities.class.php');
require_once('html/employee_html.php');	
require_once('html/general_content_html.php');
require_once('html/public_job_html.php');


session_start();

	if (isset($_SESSION['tempID']) && $_SESSION['tempID'] != 0) {
		$utilities = new Utilities;
		public_full_header_html("", "", "", "", "", "", "", "", "", "");

					if ($_FILES['resume_file']['size'] > 5000000 || $_FILES['resume_file']['name'] == "") {
						echo "File exceeds maximum size";
					} else {
						$random = $utilities->generateRandomString(5);
						$new_name = $_SESSION['tempID']."_".$random.".pdf";			
						$file_name = $_FILES['resume_file']['name'];
						$temp_name = $_FILES['resume_file']['tmp_name'];
						$error = $_FILES['resume_file']['error'];
						$img_src = "resumes/".$new_name;			
						$dest = "resumes/";
						$upload_error = $utilities->upload_photo($file_name, $temp_name, $error, $new_name, $dest);
						//write resume to db
						$utilities->update_resume_filename("temp", $new_name);
					}

					if ($error == 0 && $upload_error == 0) {
?>
						<div class='container' style="min-height: 70%">
							<div class='row' style="margin-bottom:12px">
								<div class="col-xs-9 col-xs-offset-3">
									<h2 style="color:black"><i class="fa fa-cog" aria-hidden="true"></i> Application Sent</h2>
								</div>	
							</div>
					
							<div class="row setting_row" style="text-align:center; font-size:16px; margin-bottom:12px">		
								<h3>Successful Upload</h3>
								<a href='jobs.php'>Back to Jobs</a>
							</div><br />
						</div>
<?php
					} else {
						echo "There was a problem uploading the file.";
					}
	} elseif (isset($_SESSION['userID']) && $_SESSION['userID'] != 0) {
		//headers
		$general_content = new General_Content;
		$general_content->html_top("profile", $js_file);

		$utilities = new Utilities;
		
					if ($_FILES['resume_file']['size'] > 5000000 || $_FILES['resume_file']['name'] == "") {
						echo "File exceeds maximum size";
					} else {
						$random = $utilities->generateRandomString(5);
						$new_name = $_SESSION['userID']."_".$random.".pdf";			
						$file_name = $_FILES['resume_file']['name'];
						$temp_name = $_FILES['resume_file']['tmp_name'];
						$error = $_FILES['resume_file']['error'];
						$img_src = "resumes/".$new_name;			
						$dest = "resumes/";
						$upload_error = $utilities->upload_photo($file_name, $temp_name, $error, $new_name, $dest);
						//write resume to db
						$utilities->update_resume_filename("member", $new_name);
					}
					
					if ($error == 0 && $upload_error == 0) {
						//$utilities->update_resume_id("temp", $new_name, $_SESSION['tempID']);
						profile_html_successful_upload();	
					} else {
						echo "There was a problem uploading the file.";
					}
			$general_content->html_footer();
		
	} else {
		echo "Error";
	}
?>