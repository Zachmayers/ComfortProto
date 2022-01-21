<?php

class Mysqldb {
	//set up the class
	var $dbhost;
	var $db;
	var $dbuser;
	var $dbpassword;
	var $sql;
	var $result;
	var $numberrows;
	var $dbconnection = false;
	var $insert_id;
 
	function get_insert_id() { 
		$this->insert_id=mysql_insert_id(); return $this->insert_id;
	}
 
	function getdb() {
		return $this->db;
	}
 
	function setdb($req_db) {
		$this->db = $req_db;
	}
 
	function setdbuser($req_user) {
		$this->dbuser = $req_user;
	}
 
	function setdbpassword($req_password) {
		$this->dbpassword = $req_password;
	}
 
	function getsql() {
		return $this->sql;
	}
 
	function setsql($req_sql) {
		$this->sql = $req_sql;
	}
 
	function getnumberrows() {
		return $this->numberrows;
	}
 
	function setnumberrows($req_numberrows) {
		$this->numberrows = $req_numberrows;
	}
 
	function setdbconnection($req_dbconnection){
		$this->dbconnection = $req_dbconnection;
	}
 
	function closedbconnection(){
		if($this->dbconnection=TRUE) {mysql_close($this->dbconnection);}
	}
	
	function real_escape($string) {
		return mysql_real_escape_string($string,$this->dbconnection);
	}
 
/*
	function mysqldb(){
		$HOST           =    "localhost";
		$DB             =    "servebar_main";
		$WEBUSER        =    "servebar_admin";
		$WEBPASSWORD    =    "Handle1t";
		$this->setdb($DB);
		$this->setdbuser($WEBUSER);
		$this->setdbpassword($WEBPASSWORD);
		$this->opendbconnection();
	}
*/
	
//PROTOTYPE SITE
	function mysqldb(){
		$HOST           =    "localhost";
		$DB             =    "henschen_SBC";
		$WEBUSER        =    "henschen_sbcuser";
		$WEBPASSWORD    =    "Handle1t";
		$this->setdb($DB);
		$this->setdbuser($WEBUSER);
		$this->setdbpassword($WEBPASSWORD);
		$this->opendbconnection();
	}
	
 
	function opendbconnection(){
		$this->dbconnection=mysql_connect("$this->dbhost","$this->dbuser","$this->dbpassword");
		if ($this->dbconnection)//if we have connected select and return true
		{
		mysql_select_db($this->db,$this->dbconnection) or die("Unable to select database");
		} else {
		$this->dbconnection=false;
		}
 
// unset the data so it couldn't be dumped
	$this->dbhost='';
	$this->db='';
	$this->dbuser='';
	$this->dbpassword='';
	}
 
	function selectquery(){
		$this->qry=@mysql_query($this->sql,$this->dbconnection);
		if(!$this->qry){$this->numberrows=0; return false;
	}//query error
 
	else{//query passed
	$this->numberrows=@mysql_numrows($this->qry);
	//if we have any result fill in the result array
	if($this->numberrows>=0) {
		for($x=0;$x<$this->numberrows;$x++){$this->result[$x]=@mysql_fetch_array($this->qry);} return true; }  else{$this->numberrows=0; return false;}//if we don't have results give error
	}//end query passed
	}
}//end of class mysqldb  


//GOAL

//Send out emails every 30 minutes.  Send a single email for multiple entries into the email queue.  Do not send more than one email to the same user per 3 hours
//Check to see if the user has logged in since the job was posted, if so, no need to send match email.

//test = archive_email_queue
//real = email_queue_match

$db = new Mysqldb;

//Get emails in queue
	$db->setsql("SELECT DISTINCT userID FROM archive_email_queue WHERE date_sent = 0 LIMIT 100");
	$db->selectquery();
	$result = $db->result;
	
	echo count($result);	
	
	if (count($result) > 0) {
		$count = 0;
		//create beginning of merge_var argument
		$merge_var_array = array();
		$recipient_array = array();
		$recipient_id_array = array();
		//create array holders
	
		foreach ($result as $row) {	
			$userID = $row['userID'];
			echo $userID." ";

			//get the users last login to determine whether they have already viewed any of the jobs
			$db = new Mysqldb;
			$db->setsql("SELECT login_date FROM login_track WHERE userID = '".$userID."' ORDER BY login_date DESC LIMIT 1");
			$db->selectquery();
			$user_login = $db->result;

			foreach($user_login as $login) {
				$last_login = $login['login_date'];
			}
			echo "Login = ".$last_login;
			//get the creation date for the last job in the email queue for this user
			$db = new Mysqldb;			
			$db->setsql("SELECT job_match.date_created FROM archive_email_queue, job_match
								 WHERE archive_email_queue.userID = '".$userID."'
								 AND job_match.userID = '".$userID."'
								 AND job_match.jobID = archive_email_queue.jobID
								 AND archive_email_queue.date_sent = 0
								 ORDER BY job_match.date_created DESC
								 LIMIT 1	");
			$db->selectquery();
			$date_array = $db->result;
			
			if (count($date_array) > 0) {
				foreach($date_array as $date) {
					$date_created = $date['date_created'];
				}
			} else {
				$date_created = 0;
			}
			echo "Created = ".$date_created;					
	
			$db = new Mysqldb;
			$db->setsql("SELECT firstname, email, email_setting, userID, valid_hash FROM members WHERE userID = '".$row['userID']."' ");
			$db->selectquery();
			$info = $db->result;
		
			foreach($info as $user) {
				$userID = $user['userID'];
				$to_email = htmlentities($user['email'], ENT_QUOTES, 'UTF-8');
				$first_name = htmlentities($user['firstname'], ENT_QUOTES, 'UTF-8');
				$last_name = htmlentities($user['lastname'], ENT_QUOTES, 'UTF-8');				
				$email_setting = $user['email_setting'];
				$key_hash = $user['valid_hash'];
				break;
			}	
			
			//if user has NOT logged in since job creation include them into send arrays for batch email			
			if ($date_created > $last_login) {
				echo "GREATER THAN LOGIN ".$userID." | ";
				if ($email_setting == 'Y') {
					//determine when the last email was sent to this user, if it is under 3 hours, skip this user
					$db = new Mysqldb;
					$db->setsql("SELECT date_sent FROM archive_email_queue 
										WHERE userID = '".$userID."' 
										ORDER BY date_sent DESC LIMIT 1");
					$db->selectquery();
					$date_sent_array = $db->result;
					foreach ($date_sent_array as $email_date) {
						$last_email_sent = $email_date['date_sent'];
					}
					
					date_default_timezone_set('America/Denver');		
					$date1 =  time();
					$date2 = strtotime($last_email_sent);
					$hourdiff = ($date1 - $date2) / 3600;
					
					echo $userID."DIFF=".$hourdiff." | ";
									
					if ($hourdiff > 3) {				
						$recipient_inside_array = array('email' => $to_email, 'name' => $first_name);
						$recipient_array[] = $recipient_inside_array ;
	
						$merge_inner = array('rcpt' => $to_email, 'vars' => array(array('name' => 'fname', 'content' => $first_name), array('name' => 'userID', 'content' => $userID), array( 'name' => 'keyhash', 'content' => $key_hash)));								
						$merge_var_array[] = $merge_inner;
						
						//Add their ID to an array to mark as "sent" later
						$recipient_id_array[] = $userID;					
					} else {
						echo "LESS THAN 3 HRS | ";
					}
				} else {
					//email setting should not be "N", but if somehow it slipped into the queue, remove the entries
					$db = new Mysqldb;
					$db->setsql("DELETE FROM archive_email_queue WHERE userID = '".$userID."' ");
					$db->selectquery();
					
				}
			} else {
				//Add their ID to an array to mark as "sent" later
				$recipient_id_array[] = $userID;									
			}
		}
		
		var_dump($merge_var_array);
		var_dump($recipient_id_array);			
		//echo $recipient_array;	

			$text_date = date('M j, Y', $date1);
												
					$subject = 'SBC - Job Match for *|FNAME|*';

					//$message = '<html><body>';
					$message = '<table width="580">';
					$message .= "<tr><td colspan='2'><a href='http://servebartendcook.com'><img src='http://servebartendcook.com/images/main.png' height='80'></a></td></tr>";				
					$message .= "<tr><td colspan='2'><h2> *|FNAME|*, you have a new job opportunity!</h2></td></tr>";
					$message .= "<tr><td> &nbsp; </td><td>A new job that matches your skills and location have been added to <a href='http://servebartendcook.com'>ServeBartendCook.com</a>.</td></tr>";		
					$message .= "<tr><td> &nbsp; </td><td>This update was added on ".$text_date.".  Jobs on ServeBartendCook tend to fill quickly, so the faster you respond, the better your chances of receiving an interview.</td></tr>";		
					$message .= "<tr><td> &nbsp; </td><td>Please login to view the details of this employment opportunity.</td></tr>";		
					$message .= "<tr><td> &nbsp; </td><td><h3>Follow Us:</h3>  <a href='http://facebook.com/servebartendcook'><img src='http://servebartendcook.com/images/facebook.png' height='30'></a> <a href='http://twitter.com/servebarcook'><img src='http://servebartendcook.com/images/twitter.png' height='30'></a></td></tr>";
					$message .= "<tr><td> &nbsp; </td><td> &nbsp; </td></tr>";
					$message .= "<tr><td> &nbsp; </td><td><font color='gray' size='2'><i>To unsubscribe and stop receiving job match notifications please click:  <a href='http://servebartendcook.com/job_notice_unsubscribe.php?page_code=ABn4t67uR&id=*|USERID|*&key_hash=*|KEYHASH|*'>unsubscribe</a></i></font></td></tr>";										
					$message .= "<tr><td> &nbsp; </td><td><font color='gray' size='1'><i>White Bird, LLC, 424 E Central Blvd. #141, Orlando, FL 32801</i></font></td></tr>";										
					$message .= '</table>';
					//$message .= 'first = *|FNAME|* ID = *|USERID|*  hash = *|KEYHASH|*';		
					//$message .= '</body></html>';
					
					
					//FIX THIS
					$plain_text = "*|FNAME|*, you have a new job opportunity!/r/n/r/n";
					$plain_text .= "A new that matches your skills and location have been added to ServeBartendCook.com./r/n/";		
					$plain_text .= "This update was added on ".textdate.".  Jobs on ServeBartendCook tend to fill quickly, so the faster you respond, the better your chances of receiving an interview.</r/n/";		
					$plain_text .= "Please login to view the details of this employment opportunity./r/n/r/n/";		
					$plain_text .= "To unsubscribe and stop receiving job match notifications please go to:  http://servebartendcook.com/job_notice_unsubscribe.php?page_code=ABn4t67uR&id=*|USERID|*&key_hash=*|KEYHASH|*";										
					$plain_text .= "  /r/n/r/n/White Bird, LLC, 424 E Central Blvd. #141, Orlando, FL 32801";										

					
					$from_email = "info@servebartendcook.com";
					$from_name = "ServeBartendCook";
					
					$tag = "job_match";

										
					
					$args = array(
					    'key' => 'I0--PjxJ5IkJQhKv329s9A',
					    'message' => array(
					        "html" => "$message",
					        "text" => "$plain_text",
					        "from_email" => "$from_email",
					        "from_name" => "$from_name",
					        "subject" => "$subject",
					        "to" => $recipient_array,
					        'tags' => array("$tag"),
					        "track_opens" => true,
					        "track_clicks" => true,
					        "auto_text" => false,
							"preserve_recipients" => false,
						    "merge_vars" => $merge_var_array
						    )							        
					);
					
// Open a curl session for making the call

				$curl = curl_init('https://mandrillapp.com/api/1.0/messages/send.json' );
				// Tell curl to use HTTP POST
				curl_setopt($curl, CURLOPT_POST, true);
				
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
				// Tell curl not to return headers, but do return the response
				curl_setopt($curl, CURLOPT_HEADER, false);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				
				curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
				// Set the POST arguments to pass on
				curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($args));
				
				// Make the REST call, returning the result
				$response = curl_exec($curl);
				 // Close the connection
				    curl_close( $curl ); 					
				echo $response;										
					//mail($to, $subject, $message, $headers);	

				//Write to QUEUE AS SENT
				$db = new Mysqldb;				
				foreach($recipient_id_array as $row) {
					$db->setsql("UPDATE archive_email_queue SET date_sent = NOW() 
										WHERE userID = '".$row."' 
										AND date_sent = 0");
					$db->selectquery();					
				}
	}


?>