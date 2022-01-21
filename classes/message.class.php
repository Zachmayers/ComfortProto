<?php
require_once('mysqldb.class.php');	
require_once('utilities.class.php');	
require_once('member.class.php');
require_once('job.class.php');		

/*
require_once($_SERVER['DOCUMENT_ROOT'].'/sendgrid/sendgrid-php/sendgrid-php.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/sendgrid/smtpapi-php/smtpapi-php.php');
*/

class Message {

	function email_queue($jobID) {
		//build a queue of emails which will be executed by a CRON job to throttle outgoing email bursts
		
		$duplicate = $this->duplicate_message_test($jobID);
		
		if ($duplicate == false) {
			$database = new Database;
			$database->query("SELECT job_match.userID FROM job_match, members 
										WHERE job_match.jobID = :jobID
										AND job_match.userID = members.userID
										AND members.email_setting = :email_setting ");		
			$database->bind(':jobID', $jobID);
			$database->bind(':email_setting', "Y");
			$result = $database->resultset();
	
			$database = new Database;
			$database->beginTransaction();
			$database->query('INSERT INTO email_queue_match (jobID, userID, date_created) 
										VALUES (:jobID, :userID, NOW() )');
			foreach($result as $row) {
				$database->bind(':userID', $row['userID']);			
				$database->bind(':jobID', $jobID);
				$database->execute();		
			}			
			$database->endTransaction();
		}		
		
	}
	
	function email_queue_test($member_array, $jobID) {
		//build a queue of emails which will be executed by a CRON job to throttle outgoing email bursts
		
		//$duplicate = $this->duplicate_message_test($jobID);
			
			$database = new Database;
			$database->beginTransaction();
			$database->query('INSERT INTO email_queue_match (jobID, userID, date_created) 
										VALUES (:jobID, :userID, NOW() )');
			foreach($member_array as $row) {
				$database->bind(':userID', $row);			
				$database->bind(':jobID', $jobID);
				$database->execute();		
			}			
			$database->endTransaction();
	}	
	
	function send_notification($type, $jobID, $userID) {
		$database = new Database;
		$member = new Member($userID);
		$job = new Job($jobID);
		//echo $type." | ".$jobID." | ".$userID;
		$member_array = $member->get_member_data();
		$job_array = $job->get_job_data(array('general'));		
				
		$to_name = $member_array['firstname']." ".$member_array['lastname'];
					
		switch($type) {
					
			case "employer_new_candidate":
				$from_email = "info@servebartendcook.com";
				$from_name = "ServeBartendCook";
				
				$subject = 'SBC - Interested Candidate for '.$job_array['general']['title'];

				$message = '<table width="580">';
				$message .= "<tr><td colspan='2'><a href='http://servebartendcook.com'><img src='http://servebartendcook.com/images/SBC-logo-RED.png' height='80'></a></td></tr>";				
				$message .= "<tr><td colspan='2'><h2>".$member_array['firstname'].", you have an interested job candidate!</h2></td></tr>";
				$message .= "<tr><td> &nbsp; </td><td>A potential employee is interested in setting up an interview for your job post titled ".$job_array['general']['title'].".  Please login at <a href='http://servebartendcook.com'>ServeBartendCook.com</a> to view their profile.</td></tr>";		
				$message .= "<tr><td> &nbsp; </td><td> &nbsp; </td></tr>";
				$message .= "<tr><td> &nbsp; </td><td>Feel free to contact us with any problems of questions at info@servebartendcook.com. </td></tr>";
				$message .= "<tr><td> &nbsp; </td><td><h3>Follow Us:</h3>  <a href='http://facebook.com/servebartendcook'><img src='http://servebartendcook.com/images/facebook.png' height='30'></a> <a href='http://twitter.com/servebarcook'><img src='http://servebartendcook.com/images/twitter.png' height='30'></a></td></tr>";
				$message .= '</table>';	
				
				$plain_text = $member_array['firstname'].", you have an interested job candidate!\r\n\r\n";
				$plain_text .= "A potential employee is interested in setting up an interview for your job post titled ".$job_array['general']['title'].".  Please login at www.servebartendcook.com to view their resume.\r\n\r\n";		
				$plain_text .= "To stop receiving job candidate emails, you may wait until your job posting expires (14 days after creation) or log into ServeBartendCook.com and mark the position you created as 'Filled'.  Feel free to contact us with any problems of questions at info@servebartendcook.com.";
									
				$tag = "employer_candidate_notice";
				
				$this->send_mail($message, $plain_text, $subject, $member_array['email'], $to_name, $from_email, $from_name, $tag)	;	
													
			break;			
		}	
	}	
	
	
	function send_verification_notification($valid_hash, $userID) {
		$database = new Database;
		$member = new Member($userID);
		
		$member_array = $member->get_member_data();
				
		$to_name = $member_array['firstname']." ".$member_array['lastname'];

		$subject = 'ServeBartendCook - Email Verification';
		
		$message = '<table width="580">';
		$message .= "<tr><td colspan='2'><a href='http://servebartendcook.com'><img src='http://servebartendcook.com/images/SBC-logo-RED.png' height='80'></a></td></tr>";				
		$message .= "<tr><td colspan='2'><h2>".$member_array['firstname'].", thank you for registering at ServeBartendCook.com!  Please verify your email address below.</h2></td></tr>";

/*
		$message .= "<tr><td> &nbsp; </td><td>To verify your account and email address please click on the following link: <a href='http://threewhitebirds.com/SBC/email_verification.php?userID=".$member_array['userID']."&valid_hash=".$valid_hash."'>threewhitebirds.com/SBC/email_verification.php?userID=".$member_array['userID']."&valid_hash=".$valid_hash."</a></td></tr>";						
		$message .= "<tr><td> &nbsp; </td><td>If this email is located in your spam folder, it is important that you whitelist this email address, as all new job opportunities will be sent to you via this address.</td></tr>";						
		$message .= "<tr><td> &nbsp; </td><td>If the above link is not clickable please cut and paste on the following link: http://threewhitebirds.com/SBC/email_verification.php?userID=".$member_array['userID']."&valid_hash=".$valid_hash."</td></tr>";						
*/
		$message .= "<tr><td> &nbsp; </td><td>To verify your account and email address please click on the following link: <a href='http://servebartendcook.com/email_verification.php?userID=".$member_array['userID']."&valid_hash=".$member_array['valid_hash']."'>ServeBartendCook.com/email_verification.php?userID=".$member_array['userID']."&valid_hash=".$member_array['valid_hash']."</a></td></tr>";						
		$message .= "<tr><td> &nbsp; </td><td>If this email is located in your spam folder, it is important that you whitelist this email address, as all new job opportunities will be sent to you via this address.</td></tr>";						
		$message .= "<tr><td> &nbsp; </td><td>If the above link is not clickable please cut and paste on the following link: http://servebartendcook.com/email_verification.php?userID=".$userID."&valid_hash=".$member_array['valid_hash']."</td></tr>";						

		$message .= "<tr><td colspan='2'> </td></tr>";						
		$message .= "<tr><td> &nbsp; </td><td>If you have any problems, questions, or comments please email us at admin@servebartendcook.com. </td></tr>";						
		$message .= "<tr><td> &nbsp; </td><td><h3>Follow Us:</h3>  <a href='http://facebook.com/servebartendcook'><img src='http://servebartendcook.com/images/facebook.png' height='30'></a> <a href='http://twitter.com/servebarcook'><img src='http://servebartendcook.com/images/twitter.png' height='30'></a></td></tr>";
		$message .= '</table>';		
		
		$plain_text = $member_array['firstname'].", thank you for registering at ServeBartendCook.com!  Please verify your email address below.\r\n\r\n";

		$plain_text .= "To verify your account and email address visit  the following link: servebartendcook.com/email_verification.php?userID=".$member_array['userID']."&valid_hash=".$member_array['valid_hash']."'>ServeBartendCook.com/email_verification.php?userID=".$member_array['userID']."&valid_hash=".$member_array['valid_hash']."\r\n\r\n";						
		$plain_text .= "If this email is located in your spam folder, it is important that you whitelist this email address, as all new job opportunities will be sent to you via this address.\r\n\r\n";						

		$plain_text .= "If you have any problems, questions, or comments please email us at admin@servebartendcook.com.";						
		
		$from_email = "info@servebartendcook.com";
		$from_name = "ServeBartendCook";
		$tag = "Verification";
		
		$this->send_mail($message, $plain_text, $subject, $member_array['email'], $to_name, $from_email, $from_name, $tag);			
	}
	
	function send_new_email_verification_notification($new_valid_hash, $userID, $new_email) {
		$database = new Database;
		$member = new Member($userID);
		
		$member_array = $member->get_member_data();
				
		$to_name = $member_array['firstname']." ".$member_array['lastname'];

		$subject = "ServeBartendCook - Verify Updated Email";
		
		$message = "<table width='580'>";

		$message .= "<tr><td colspan='2'><a href='http://servebartendcook.com'><img src='http://servebartendcook.com/images/SBC-logo-RED.png' height='80'></a></td></tr>";				
		$message .= "<tr><td colspan='2'><h2>".$member_array['firstname'].", we've received your request to change you email address.  Please verify your email address by clicking the link below.</h2></td></tr>";

		$message .= "<tr><td> &nbsp; </td><td>To update your email address please click on the following link: <a href='http://servebartendcook.com/email_verification.php?type=change&userID=".$member_array['userID']."&valid_hash=".$new_valid_hash."'>ServeBartendCook.com/email_verification.php?userID=".$member_array['userID']."&valid_hash=".$new_valid_hash."</a></td></tr>";						
		$message .= "<tr><td> &nbsp; </td><td>Once verified, this will be your new login email for ServeBartendCook.com.</td></tr>";						
// 		$message .= "<tr><td> &nbsp; </td><td>If the above link is not clickable please cut and paste on the following link: http://servebartendcook.com/email_verification.php?userID=".$userID."&valid_hash=".$member_array['valid_hash']."</td></tr>";						

		$message .= "<tr><td colspan='2'> </td></tr>";						
		$message .= "<tr><td> &nbsp; </td><td>If you have any problems, questions, or comments please email us at admin@servebartendcook.com. </td></tr>";						
		$message .= "<tr><td> &nbsp; </td><td><h3>Follow Us:</h3>  <a href='http://facebook.com/servebartendcook'><img src='http://servebartendcook.com/images/facebook.png' height='30'></a> <a href='http://twitter.com/servebarcook'><img src='http://servebartendcook.com/images/twitter.png' height='30'></a></td></tr>";
		$message .= "</table>";		
		
		$plain_text = $member_array['firstname'].", we've received your request to change you email address.  Please verify your email address below.<br>";

		$plain_text .= "To update your email address please go to the following link: ServeBartendCook.com/email_verification.php?userID=".$member_array['userID']."&type=change&valid_hash=".$new_valid_hash." <br>";						
// 		$plain_text .= "If this email is located in your spam folder, it is important that you whitelist this email address, as all new job opportunities will be sent to you via this address.<br>";						

		$plain_text .= "If you have any problems, questions, or comments please email us at admin@servebartendcook.com.";						
		
		$from_email = "info@servebartendcook.com";
		$from_name = "ServeBartendCook";
		$tag = "New Email";
		
		$this->send_mail($message, $plain_text, $subject, $new_email, $to_name, $from_email, $from_name, $tag);			
	}	
	
	function send_admin_created_verification($userID, $token) {
		$member = new Member($userID);
		
		$member_array = $member->get_member_data();
						
		$to_name = $member_array['firstname']." ".$member_array['lastname'];

		$subject = 'ServeBartendCook - Email Verification';

		$message = '<table width="580">';
		$message .= "<tr><td colspan='2'><a href='http://servebartendcook.com'><img src='http://servebartendcook.com/images/main.png' height='80'></a></td></tr>";				
		$message .= "<tr><td colspan='2'>".$member_array['firstname'].",</td></tr>";
		$message .= "<tr><td> &nbsp; </td><td>&nbsp; </td></tr>";
		
		$message .= "<tr><td> &nbsp; </td><td>Ready to make hiring a LOT easier? We’ve already created a user profile for you - just click the link below to set your ServeBartendCook password and start posting jobs now.</td></tr>";
		$message .= "<tr><td> &nbsp; </td><td>&nbsp; </td></tr>";
		
		$message .= "<tr><td> &nbsp; </td><td align='center'><a href='http://servebartendcook.com/password_reset.php?ID=".$userID."&token=".$token."&access=PJ'>Set Password and Login</a></td></tr>";						
		$message .= "<tr><td> &nbsp; </td><td>&nbsp; </td></tr>";								
								
		$message .= "<tr><td> &nbsp; </td><td> If you have any questions or comments email us at admin@servebartendcook.com.</td></tr>";

		$message .= "<tr><td colspan='2'> </td></tr>";						
		$message .= "<tr><td> &nbsp; </td><td><h3>Follow Us:</h3>  <a href='http://facebook.com/servebartendcook'><img src='http://servebartendcook.com/images/facebook.png' height='30'></a> <a href='http://twitter.com/servebarcook'><img src='http://servebartendcook.com/images/twitter.png' height='30'></a></td></tr>";
		$message .= '</table>';		
		
		
		$from_email = "info@servebartendcook.com";
		$from_name = "ServeBartendCook";
		$tag = "PJ-Verification";
		
		$this->send_mail($message, $message, $subject, $member_array['email'], $to_name, $from_email, $from_name, $tag);			
	}	
	
	function send_recommendation_link($recommendationID, $senderID, $email, $firstname, $lastname, $hash, $public_hash) {
		$database = new Database;
		$member = new Member($senderID);
		
		$member_array = $member->get_member_data();
		
		$sender_name = $member_array['firstname']." ".$member_array['lastname'];
		$sender_email = $member_array['email'];

		$to_name = $firstname." ".$lastname;

		//$email = "jbhenschen@gmail.com";
		
		$subject = $sender_name." has recommended you for a job.";
		
		$message = '<table width="580">';
		$message .= "<tr><td colspan='2'><a href='http://servebartendcook.com'><img src='http://servebartendcook.com/images/main.png' height='80'></a></td></tr>";				
		$message .= "<tr><td colspan='2'><h2>".$firstname.",</h2></td></tr>";
		
		$message .= "<tr><td colspan='2'><h3>".$sender_name." has recommended you for a job on ServeBartendCook.</h3></td></tr>";
		$message .= "<tr><td colspan='2'><h3>Please sign in using the link below to view the job details and the recommendation:</h3></td></tr>";		
		$message .= "<tr><td> &nbsp; </td><td align='center'><a href='http://servebartendcook.com/index.php?recommendID=".$recommendationID."&hash=".$hash."'>SERVEBARTENDCOOK</a></td></tr>";						
		
		$message .= "<tr><td> &nbsp; </td><td>The job that ".$sender_name." recommended you for has a Bounty on it.  This means if you apply for the job via ServeBartendCook and are hired, ".$sender_name." will eligible to be paid the Bounty amount.</td></tr>";						
		$message .= "<tr><td colspan='2'> </td></tr>";						
		$message .= "<tr><td colspan='2'> </td></tr>";						


		$message .= "<tr><td colspan='2'> </td></tr>";	
		$message .= "<tr><td> &nbsp; </td><td>This email was sent on behalf of ".$sender_name." (".$sender_email."), we will not contact you any more regarding this job.</td></tr>";						
							
		$message .= "<tr><td> &nbsp; </td><td>If you have any problems, questions, or comments please email us at admin@servebartendcook.com. </td></tr>";						
		$message .= "<tr><td> &nbsp; </td><td><h3>Follow Us:</h3>  <a href='http://facebook.com/servebartendcook'><img src='http://servebartendcook.com/images/facebook.png' height='30'></a> <a href='http://twitter.com/servebarcook'><img src='http://servebartendcook.com/images/twitter.png' height='30'></a></td></tr>";
		$message .= '</table>';		
				
		$from_email = "info@servebartendcook.com";
		$from_name = "ServeBartendCook";
		$tag = "recommendation_link";
		
		$this->send_mail($message, $message, $subject, $email, $to_name, $from_email, $from_name, $tag);			
	}	
	
	function send_interview_cancellation_notice($job_title, $interview_date, $employer_details, $employee_details) {
		
		$to_name = $employer_details['firstname']." ".$employer_details['lastname'];
		
		$subject = 'SBC Interview Cancellation';

		$message = '<table width="580">';
		$message .= "<tr><td colspan='2'><a href='http://servebartendcook.com'><img src='http://servebartendcook.com/images/main.png' height='80'></a></td></tr>";				
		$message .= "<tr><td colspan='2'><h2>".$employer_details['firstname'].",</h2></td></tr>";
		
		$message .= "<tr><td colspan='2'><h3>".$employee_details['firstname']." ".$employee_details['lastname']." has cancelled their interview for:</h3></td></tr>";
		$message .= "<tr><td> &nbsp; </td><td><h3>".$job_title." on ".$interview_date."</h3></td></tr>";		
		$message .= "<tr><td> &nbsp; </td><td>Please log in to ServeBartendCook.com to view other interview details.</td></tr>";						
		
		$message .= "<tr><td colspan='2'> </td></tr>";						
		$message .= "<tr><td colspan='2'> </td></tr>";						


		$message .= "<tr><td colspan='2'> </td></tr>";	
							
		$message .= "<tr><td> &nbsp; </td><td>If you have any problems, questions, or comments please email us at admin@servebartendcook.com. </td></tr>";						
		$message .= "<tr><td> &nbsp; </td><td><h3>Follow Us:</h3>  <a href='http://facebook.com/servebartendcook'><img src='http://servebartendcook.com/images/facebook.png' height='30'></a> <a href='http://twitter.com/servebarcook'><img src='http://servebartendcook.com/images/twitter.png' height='30'></a></td></tr>";
		$message .= '</table>';		
				
		$from_email = "info@servebartendcook.com";
		$from_name = "ServeBartendCook";
		$tag = "interview_cancellation";
		
		$email = $employer_details['email'];
		//$email = "jbhenschen@gmail.com";
		
		$this->send_mail($message, $message, $subject, $email, $to_name, $from_email, $from_name, $tag);			
		
	}
	
	function send_interview_cancellation_confirmation($job_title, $interview_date, $employee_details) {
		//This is sent to the user who canceled their interview, just in case someone got ahold of the link and canceled erroneously

		$to_name = $employee_details['firstname']." ".$employee_details['lastname'];
		
		$subject = 'SBC Interview Cancellation Confirmation';

		$message = '<table width="580">';
		$message .= "<tr><td colspan='2'><a href='http://servebartendcook.com'><img src='http://servebartendcook.com/images/main.png' height='80'></a></td></tr>";				
		$message .= "<tr><td colspan='2'><h2>".$employee_details['firstname'].",</h2></td></tr>";
		
		$message .= "<tr><td colspan='2'><h3>We are sending this email to confirm that you cancelled your interview for: </h3></td></tr>";
		$message .= "<tr><td> &nbsp; </td><td><h3>".$job_title." on ".$interview_date."</h3></td></tr>";		
		$message .= "<tr><td> &nbsp; </td><td>If this is incorrect, please email us immediately at admin@servebartendcook.com</td></tr>";						
		
		$message .= "<tr><td colspan='2'> </td></tr>";						
		$message .= "<tr><td colspan='2'> </td></tr>";						


		$message .= "<tr><td colspan='2'> </td></tr>";	
							
		$message .= "<tr><td> &nbsp; </td><td>If you have any problems, questions, or comments please email us at admin@servebartendcook.com. </td></tr>";						
		$message .= "<tr><td> &nbsp; </td><td><h3>Follow Us:</h3>  <a href='http://facebook.com/servebartendcook'><img src='http://servebartendcook.com/images/facebook.png' height='30'></a> <a href='http://twitter.com/servebarcook'><img src='http://servebartendcook.com/images/twitter.png' height='30'></a></td></tr>";
		$message .= '</table>';		
				
		$from_email = "info@servebartendcook.com";
		$from_name = "ServeBartendCook";
		$tag = "interview_cancellation_confirmation";
		
		$email = $employee_details['email'];
		//$email = "jbhenschen@gmail.com";
		
		$this->send_mail($message, $message, $subject, $email, $to_name, $from_email, $from_name, $tag);			
		
	}	
	
	function password_reset_link($userID, $email, $token) {
		$database = new Database;
		$member = new Member($userID);
		
		$member_array = $member->get_member_data();
				
		$to_name = $member_array['firstname']." ".$member_array['lastname'];

		$subject = 'SBC - Password Reset';
		
		$message = '<table width="580">';
// 		$message .= "<tr><td colspan='2'><a href='http://servebartendcook.com'><img src='http://servebartendcook.com/images/main.png' height='80'></a></td></tr>";				
		$message .= "<tr><td colspan='2'><a href='http://servebartendcook.com'><img src='http://servebartendcook.com/images/SBC-logo-RED.png' height='80'></a></td></tr>";				

		$message .= "<tr><td colspan='2'><h2>".$member_array['firstname'].", to reset your password, please click the link below.</h2></td></tr>";

/*
		$message .= "<tr><td> &nbsp; </td><td>To verify your account and email address please click on the following link: <a href='http://threewhitebirds.com/SBC/email_verification.php?userID=".$member_array['userID']."&valid_hash=".$valid_hash."'>threewhitebirds.com/SBC/email_verification.php?userID=".$member_array['userID']."&valid_hash=".$valid_hash."</a></td></tr>";						
		$message .= "<tr><td> &nbsp; </td><td>If this email is located in your spam folder, it is important that you whitelist this email address, as all new job opportunities will be sent to you via this address.</td></tr>";						
		$message .= "<tr><td> &nbsp; </td><td>If the above link is not clickable please cut and paste on the following link: http://threewhitebirds.com/SBC/email_verification.php?userID=".$member_array['userID']."&valid_hash=".$valid_hash."</td></tr>";						
*/
		$message .= "<tr><td> &nbsp; </td><td align='center'><a href='http://servebartendcook.com/password_reset.php?ID=".$userID."&token=".$token."'>RESET PASSWORD</a></td></tr>";						
		$message .= "<tr><td> &nbsp; </td><td><i>This link will only be valid for 48 hours.</i></td></tr>";						
		$message .= "<tr><td colspan='2'> </td></tr>";						
		$message .= "<tr><td colspan='2'> </td></tr>";						

		$message .= "<tr><td> &nbsp; </td><td>If the above link is not clickable please cut and paste on the following link: http://servebartendcook.com/password_reset.php?ID=".$userID."&token=".$token."</td></tr>";						

		$message .= "<tr><td colspan='2'> </td></tr>";						
		$message .= "<tr><td> &nbsp; </td><td>If you have any problems, questions, or comments please email us at admin@servebartendcook.com. </td></tr>";						
		$message .= "<tr><td> &nbsp; </td><td><h3>Follow Us:</h3>  <a href='http://facebook.com/servebartendcook'><img src='http://servebartendcook.com/images/facebook.png' height='30'></a> <a href='http://twitter.com/servebarcook'><img src='http://servebartendcook.com/images/twitter.png' height='30'></a></td></tr>";
		$message .= '</table>';		
				
		$from_email = "info@servebartendcook.com";
		$from_name = "ServeBartendCook";
		$tag = "password_reset";
		
		$this->send_mail($message, $message, $subject, $member_array['email'], $to_name, $from_email, $from_name, $tag);			
		
	}
	
	function inappropriate_message($type, $ID, $userID) {
		$to = "jbhenschen@gmail.com";
		$subject = 'SBC - Inappropriate Content';
		
		$headers = "From: ServeBartendCook <info@servebartendcook.com>\r\n";
		$headers .= "Reply-To: info@servebartendcook.com\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$message = "Inappropriate Content Report <br />";
		$message .= $type.": ".$ID."<br />";
		$message .= "FROM: ".$userID."<br />";
		
		mail($to, $subject, $message, $headers);						
	}
	
	function send_invite($type, $email) {
		$member = new Member($_SESSION['userID']);
		$utilities = new Utilities;
		
		$member_array = $member->get_member_data();
				
		$from_name = $member_array['firstname']." ".$member_array['lastname'];
		
		$site_type = $utilities->site_type;
		
		$to_email = $email;
		$to_name = "";
				
		//check to see if this user has send an email to this person already, if so, ignore and give warning
		$database = new Database;
		$database->query("SELECT inviteID FROM invites 
									WHERE senderID = :userID
									AND receiver_email = :clean_email ");		
		$database->bind(':userID', $_SESSION['userID']);
		$database->bind(':clean_email', $to_email);
		$result = $database->resultset();

		if (count($result) > 0) {
			$type = "repeat";
		}
		
		//check to see how many this user has sent in the last 24 hours		
		$database = new Database;
		$database->query("SELECT inviteID FROM invites 
									WHERE senderID = :userID
									AND date > DATE_SUB(NOW(), INTERVAL 1 DAY)");		
		$database->bind(':userID', $_SESSION['userID']);
		$result = $database->resultset();

		if (count($result) > 5) {
			$type = "spam";
		}

		switch($type) {
			case "manager":
				if ($member_array['firstname'] != "") {
					$subject = $from_name." wants you check out ServeBartendCook.com for hiring";

					$message = '<table width="580">';
					$message .= "<tr><td colspan='2'><a href='http://servebartendcook.com'><img src='http://servebartendcook.com/images/main.png' height='80'></a></td></tr>";				
					$message .= "<tr><td colspan='2'><h2>".$from_name." wants you to check out <a href='http://servebartendcook.com'>ServeBartendCook.com</a> for hiring.</h2></td></tr>";
			
					$message .= "<tr><td> &nbsp; </td><td><a href='http://servebartendcook.com'>ServeBartendCook.com</a> allows you to post a hospitality based job with specific skill requirements.  Emails are sent out to all candidates that meet your qualifications. And it is FREE.</td></tr>";						
					$message .= "<tr><td colspan='2'> </td></tr>";						
					$message .= "<tr><td> &nbsp; </td><td><b>Advantages:</b></td></tr>";						
					$message .= "<tr><td> &nbsp; </td><td>  - More than a classified ad, emails are actively sent to people looking for jobs.</td></tr>";						
					$message .= "<tr><td> &nbsp; </td><td>  - Only people that meet your qualification will see the job.</td></tr>";						
					$message .= "<tr><td> &nbsp; </td><td>  - Standardized employee profiles, for easy comparison.</td></tr>";						
					$message .= "<tr><td> &nbsp; </td><td>  - Add pre-interview questions to screen candidates.</td></tr>";						
					$message .= "<tr><td> &nbsp; </td><td>  - Employee profiles can have pictures and video introductions (these can be turned off if they violate your HR policy).</td></tr>";						
					$message .= "<tr><td> &nbsp; </td><td>  - And it is free!</td></tr>";						
					$message .= "<tr><td colspan='2'> </td></tr>";						
					$message .= "<tr><td> &nbsp; </td><td>Give <a href='http://servebartendcook.com'>ServeBartendCook.com</a> a try today.</td></tr>";						
					$message .= "<tr><td colspan='2'> </td></tr>";						
					$message .= "<tr><td colspan='2'> </td></tr>";						
					$message .= "<tr><td> &nbsp; </td><td><font size='1'><i>".$from_name." (".$member_array['email'].") requested that this email be sent to you.  You will not be contacted by ServeBartendCook.com unless you create an account.</i></font></td></tr>";						
					$message .= '</table>';		

					$plain_text = $message;
					$tag = "employer_invite";
					
					$this->send_mail($message, $plain_text, $subject, $to_email, $to_name, $member_array['email'], $from_name, $tag);	
					
					//write record to db
					$database = new Database;
					$database->query("INSERT INTO invites
											(senderID, receiver_email, type, date)
											VALUES (:userID, :clean_email, 'manager', NOW()) ");		
					$database->bind(':userID', $_SESSION['userID']);
					$database->bind(':clean_email', $to_email);
					$database->execute();
				}
			break;
			
			case "employee":
				if ($member_array['firstname'] != "") {
					$subject = $from_name." wants you check out ServeBartendCook.com for jobs";

					$message = '<table width="580">';
					$message .= "<tr><td colspan='2'><a href='http://servebartendcook.com'><img src='http://servebartendcook.com/images/main.png' height='80'></a></td></tr>";				
					$message .= "<tr><td colspan='2'><h2>".$from_name." wants you to check out <a href='http://servebartendcook.com'>ServeBartendCook.com</a>.</h2></td></tr>";
			
					$message .= "<tr><td> &nbsp; </td><td>ServeBartendCook.com matches you with hospitality jobs in your area based on your specific skills and experience.</td></tr>";						
					$message .= "<tr><td colspan='2'> </td></tr>";						
					$message .= "<tr><td> &nbsp; </td><td>You can create a profile in a few easy steps, then be notified of new jobs in your area.</td></tr>";						
					$message .= "<tr><td> &nbsp; </td><td>You can even add photos of your culinary or mixology creations, and a video introduction using YouTube, Vine, or Instagram.</td></tr>";						
					$message .= "<tr><td colspan='2'> </td></tr>";						
					$message .= "<tr><td> &nbsp; </td><td>Give <a href='http://servebartendcook.com'>ServeBartendCook.com</a> a try today.</td></tr>";						
					$message .= "<tr><td colspan='2'> </td></tr>";						
					$message .= "<tr><td colspan='2'> </td></tr>";						
					$message .= "<tr><td> &nbsp; </td><td><font size='1'><i>".$from_name." (".$member_array['firstname'].") requested that this email be sent to you.  You will not be contacted by ServeBartendCook.com unless you create an account.</i></font></td></tr>";						
					$message .= '</table>';		

					$plain_text = $message;
					$tag = "employee_invite";
					
					$this->send_mail($message, $plain_text, $subject, $to_email, $to_name, $member_array['email'], $from_name, $tag);			

					$database = new Database;
					$database->query("INSERT INTO invites
											(senderID, receiver_email, type, date)
											VALUES (:userID, :clean_email, 'employee', NOW()) ");		
					$database->bind(':userID', $_SESSION['userID']);
					$database->bind(':clean_email', $to_email);
					$database->execute();
				}			
			break;
			
			case "repeat":
				return "repeat";		
			break;
			
			case "member":
				return "member";		
			break;
			
			case "spam":
				return "spam";		
			break;									
		}
	}
	
	function send_server_error($error_text) {
		$to_email = "jbhenschen@gmail.com";
		$to_name = "James";
		$from_email = "admin@servebartendcook.com";
		$from_name = "SBC Admin";
		$subject = "Server Error - MySQL Down";

		$message = 'A login occurred that could not connect to MySQL.  Check site and Contact HostGator  |  ';
		$message .= $error_text;

		$plain_text = $message;
		$tag = "server_error";
		
		$this->send_mail($message, $plain_text, $subject, $to_email, $to_name, $from_email, $from_name, $tag);
	}
	
	function new_employer_job_post($job_details, $store_details) {
		$message = "<b>Initial Job Post</b><br />";
		
		$message .= "&nbsp; <br />";
		
		$message .= "Job Title:  ".$job_details['title']."<br />";
		$message .= "Job ID:  ".$job_details['jobID']."<br />";
		$message .= "Store:  ".$store_details['name']."<br />";
		$message .= "Zip:  ".$store_details['zip']."<br />";
		
		$subject = "New Job Poster";
		$to_email = "jbhenschen@gmail.com";
		$to_name = "James";
		$from_email = "admin@servebartendcook.com";
		$from_name = "SBC Admin";
		$tag = "initial_post_notice";

		$this->send_mail($message, $message, $subject, $to_email, $to_name, $from_email, $from_name, $tag);	
	}
	
	function new_bounty_post($job_data) {		
		$message = "<b>Bounty Job Post</b><br />";
		
		$message .= "&nbsp; <br />";
		
		$message .= "Job Title:  ".$job_data['general']['title']."<br />";
		$message .= "Job ID:  ".$job_data['general']['jobID']."<br />";
		$message .= "Bounty:  ".$job_data['general']['bounty']."<br />";
		$message .= "Payment:  ".$job_data['general']['total_payment']."<br />";
		$message .= "Status:  ".$job_data['general']['payment_status']."<br />";

		$message .= "Store:  ".$job_data['store']['name']."<br />";
		$message .= "Zip:  ".$job_data['store']['zip']."<br />";
		
		$subject = "New Bounty Post";
		$to_email = "jbhenschen@gmail.com";
		$to_name = "James";
		$from_email = "admin@servebartendcook.com";
		$from_name = "SBC Admin";
		$tag = "bounty_post_notice";

		$this->send_mail($message, $message, $subject, $to_email, $to_name, $from_email, $from_name, $tag);	
	}	

	function new_hire_notice($jobID) {		
		$message = "<b>Bounty Job Closed - Possible Hire</b><br />";
		
		$message .= "&nbsp; <br />";
		
		$message .= "Job ID:  ".$jobID."<br />";
		
		$subject = "Bounty Job Closed";
		$to_email = "jbhenschen@gmail.com";
		$to_name = "James";
		$from_email = "admin@servebartendcook.com";
		$from_name = "SBC Admin";
		$tag = "bounty_close_notice";

		$this->send_mail($message, $message, $subject, $to_email, $to_name, $from_email, $from_name, $tag);	
	}	
		
		
	function send_mail($message, $plain_text, $subject, $to_email, $to_name, $from_email, $from_name, $tag) {
		
		$sendgrid = new SendGrid('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');

		$email = new SendGrid\Email();
		$email
		    ->addTo("$to_email", "$to_name")
		    ->setFrom("$from_email")
		    ->setFromName("$from_name")
		    ->setSubject("$subject")
		    ->setCategory("$tag")
		    ->setText("$plain_text")
		    ->setHtml("$message");

			// catch the error

		try {
		    $sendgrid->send($email);
		} catch(\SendGrid\Exception $e) {
		    echo $e->getCode();
		    foreach($e->getErrors() as $er) {
		        echo $er;
				$headers = "From: ServeBartendCook <info@servebartendcook.com>\r\n";
				$headers .= "Reply-To: info@servebartendcook.com\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		        
		        mail("jbhenschen@gmail.com", "email error", $er, $headers);
		    }
		}
		
	}
	
	private function duplicate_message_test($jobID) {
		$database = new Database;
		$database->query("SELECT jobID FROM email_queue_match 
									WHERE jobID = :jobID LIMIT 1");		
		$database->bind(':jobID', $jobID);
		$result = $database->resultset();	
		$duplicate = count($result);	
		
		if ($duplicate > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function track_error($type, $result, $firstname, $lastname, $username, $password, $access, $company, $position, $website, $refID) {
		switch ($type) {
			case "employer_signup":
					$subject = "Employer Signup Error";

					$message = "There was an error during employer sign-up.  Here is the info:<br />";
					
					$message .= "Name: ".$firstname." ".$lastname."<br />";
					$message .= "Username: ".$username."<br />";
					$message .= "Pass: ".$password."<br />";
					$message .= "Access: ".$access."<br />";
					$message .= "Company: ".$company."<br />";
					$message .= "Positions: ".$position."<br />";
					$message .= "Website: ".$website."<br />";
					$message .= "RefID: ".$refID."<br />";
					$message .= "RESULT: ".$result."<br />";
					
					$plain_text = $message;
					$to_email = "jbhenschen@gmail.com";
					$to_name = "SBC Admin";
					$from_email = "admin@servebartendcook.com";
					$from_name = "admin";
					$tag = "error_track";
					
					$this->send_mail($message, $plain_text, $subject, $to_email, $to_name, $from_email, $from_name, $tag);			
			break;
		}
	}

	
}
?>