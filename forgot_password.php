<?php
ini_set('display_errors',1); 
 error_reporting(E_ALL);
	require_once('classes.php');	

 $email = $_POST['email'];
 
	if ($email != "") {
		$db = new Mysqldb;	
		$db->setsql("SELECT userID, valid, email_validation, valid_hash FROM members WHERE email = '".$email."' ");			
		$db->selectquery();
		$result = $db->result;
		if (count($result) == 1) {
			foreach ($result as $row) {
				$valid = $row['valid'];
				$email_validation = $row['email_validation'];
				$userID = $row['userID'];
				$valid_hash = $row['valid_hash'];
			}
			
			if ($valid == "N") {
				echo "deactivate";				
			} elseif ($email_validation != "Y") {
				echo "email_validation";
			} else {
				$message_class = new Message;
	
				//create a new password and email it to user
				$utilities = new Utilities;
				$new_pass = $utilities->generateRandomString(8); 
				
				$db->setsql("UPDATE members 
									SET password = sha1('".$new_pass."') 
									WHERE email = '".$email."'
									LIMIT 1");			
				$db->selectquery();
							
				$subject = 'SBC - Password Reset';
				
				$from_email = "info@servebartendcook.com";
				$first_name = "ServeBartendCook";
					
				$message = '<table width="580">';
				$message .= "<tr><td colspan='2'><a href='http://servebartendcook.com'><img src='http://servebartendcook.com/images/main.png' height='80'></a></td></tr>";				
				$message .= "<tr><td colspan='2'><h2>Your ServeBartendCook password has been reset.</h2></td></tr>";
				$message .= "<tr><td> &nbsp; </td><td> Please login using the password:  <b>".$new_pass."</b>   You may change your password in the profile area.</td></tr>";		
				$message .= "<tr><td> &nbsp; </td><td><h3>Follow Us:</h3>  <a href='http://facebook.com/servebartendcook'><img src='http://servebartendcook.com/images/facebook.png' height='30'></a> <a href='http://twitter.com/servebarcook'><img src='http://servebartendcook.com/images/twitter.png' height='30'></a></td></tr>";
				$message .= "<tr><td> &nbsp; </td><td><font color='gray' size='2'><i>To unsubscribe and stop receiving job match notifications please click:  unsbscribe</i></font></td></tr>";										
				$message .= "<tr><td> &nbsp; </td><td><font color='gray' size='1'><i>White Bird, LLC, 322 E Central Blvd., Orlando, FL 32801</i></font></td></tr>";										

				$message .= '</table>';		
					
				$plain_text = "Your ServeBartendCook password has been reset.\r\n\r\n";
				$plain_text .= "Please login using the password:  ".$new_pass."  You may change your password in the profile area.";		
					
				$tag = "password_reset";
	
				$from_email = "info@servebartendcook.com";
				$from_name = "ServeBartendCook";			
					
				$message_class->send_mail($message, $plain_text, $subject, $email, "SBC Member", $from_email, $from_name, $tag)	;									
				
				echo "yes";
			}
		} else {
			echo "no";
		}
	} else {
		echo "no";
	}
