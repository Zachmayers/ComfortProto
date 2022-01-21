<?php

//Loop through and emails for the next 10 in the queue
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

$db = new Mysqldb;

//Get emails in queue
	$db->setsql("SELECT * FROM email_queue_match WHERE date_sent = 0 LIMIT 30");
	$db->selectquery();
	$result = $db->result;
	//echo count($result);
	
	
	if (count($result) > 0) {
		foreach ($result as $row) {	
			$db = new Mysqldb;
			$db->setsql("SELECT firstname, email, email_setting, valid_hash FROM members WHERE userID = '".$row['userID']."' ");
			$db->selectquery();
			$info = $db->result;
			$jobID = $row['jobID'];
			$userID = $row['userID'];
			echo $userID." ";
			//Check the table again for any other jobs matched to this person and create an array of jobID's
			$db->setsql("SELECT * FROM email_queue_match, job_match WHERE email_queue_match.date_sent = 0 
								AND email_queue_match.userID = '".$userID."'
								AND job_match.jobID = email_queue_match.jobID
								AND job_match.userID = '".$userID."'
								AND email_queue_match.userID = '".$userID."' ");
			$db->selectquery();
			$user_matches = $db->result;
			echo "-Count Match=".count($user_matches);
			//get the users last login to determine whether they have already viewed any of the jobs
			$db->setsql("SELECT login_date FROM login_track WHERE userID = '".$userID."' ORDER BY login_date DESC LIMIT 1");
			$db->selectquery();
			$user_login = $db->result;
			echo "-Login=".$last_login;
			foreach($user_login as $login) {
				$last_login = $login['login_date'];
			}
			
			$user_match_original = $user_matches;
			
			//if user has logged in since job creation, pull it from array
			foreach($user_matches as $key=>$match) {
				echo "-Date Create".$match['date_created'];
				if ($match['date_created'] < $last_login) {
					unset($user_matches[$key]);
				}
			}
			
			//check date sent, if it is > 0, pull from array
			foreach($user_matches as $key=>$match) {
				if ($match['date_sent'] > 0) {
					unset($user_matches[$key]);
				}
			}
			
			echo "-New Count=".count($user_matches)."<br />";
			//set job type counts
			$bartender_count = 0;
			$server_count = 0;
			$kitchen_count = 0;
			$host_count = 0;
			$bus_count = 0;
			$manager_count = 0;			
			
			if (count($user_matches) > 0) {
				foreach($user_matches as $match) {			
					$db = new Mysqldb;
					$db->setsql("SELECT date_created, specialty FROM jobs, jobs_specialties 
										WHERE jobs.jobID = '".$match['jobID']."'
										AND jobs_specialties.jobID = '".$match['jobID']."' ");
					$db->selectquery();
					$job_array = $db->result;
					//echo count($job_array);
					foreach($job_array as $job_info) {
						$specialty = $job_info['specialty'];
						$date_created = date('M j, Y', strtotime($job_info['date_created']));
						switch($specialty) {
							case "Bartender":
								$bartender_count++;
							break;
							
							case "Server":
								$server_count++;
							break;
							
							case "Kitchen":
								$kitchen_count++;
							break;
							
							case "Host":
								$host_count++;
							break;	
							
							case "Bus":
								$bus_count++;
							break;	
							
							case "Manager":
								$manager_count++;
							break;																										
						}					
					}	
				}
				
				$total_count = $bartender_count + $server_count + $kitchen_count + $host_count + $bus_count + $manager_count;
				
				$job_type_text = "(";
				if ($bartender_count > 0) {
					$job_type_text .= " Bartender";					
				}
				if ($server_count > 0) {
					$job_type_text .= " Server";					
				}	
				if ($kitchen_count > 0) {
					$job_type_text .= " Kitchen";					
				}	
				if ($host_count > 0) {
					$job_type_text .= " Host";					
				}	
				if ($bus_count > 0) {
					$job_type_text .= " Bus";					
				}	
				if ($manager_count > 0) {
					$job_type_text .= " Manager";					
				}	
				$job_type_text .= ") ";					
			
				foreach($info as $user) {
					$to_email = htmlentities($user['email'], ENT_QUOTES, 'UTF-8');
					$first_name = htmlentities($user['firstname'], ENT_QUOTES, 'UTF-8');
					$last_name = htmlentities($user['lastname'], ENT_QUOTES, 'UTF-8');				
					$email_setting = $user['email_setting'];
					$key_hash = $user['valid_hash'];
					break;
				}
			
				$to_name = $first_name." ".$last_name;
			
				$to_email = "admin@servebartendcook.com";
			//echo "jobID".$jobID;
			if ($email_setting == 'Y') {
					
					//Mark all user matches as sent
					foreach($user_match_original as $sent) {
						$db->setsql("UPDATE email_queue_match
											SET date_sent = NOW()
											WHERE emailID = '".$sent['emailID']."' ");	
						$db->selectquery();
					}
												
					$subject = 'SBC - Job Match for '.$first_name;

					//$message = '<html><body>';
					$message = '<table width="580">';
					$message .= "<tr><td colspan='2'><a href='http://servebartendcook.com'><img src='http://servebartendcook.com/images/main.png' height='80'></a></td></tr>";				
					$message .= "<tr><td colspan='2'><h2>".$first_name.", you have a new job opportunity!</h2></td></tr>";
					$message .= "<tr><td> &nbsp; </td><td>A ".$total_count." job(s) ".$job_type_text." that matches your skills and location have been added to <a href='http://servebartendcook.com'>ServeBartendCook.com</a>.</td></tr>";		
					$message .= "<tr><td> &nbsp; </td><td>This update was added on ".$date_created.".  Jobs on ServeBartendCook tend to fill quickly, so the faster you respond, the better your chances of receiving an interview.</td></tr>";		
					$message .= "<tr><td> &nbsp; </td><td>Please login to view the details of this employment opportunity.</td></tr>";		
					$message .= "<tr><td> &nbsp; </td><td><h3>Follow Us:</h3>  <a href='http://facebook.com/servebartendcook'><img src='http://servebartendcook.com/images/facebook.png' height='30'></a> <a href='http://twitter.com/servebarcook'><img src='http://servebartendcook.com/images/twitter.png' height='30'></a></td></tr>";
					$message .= "<tr><td> &nbsp; </td><td> &nbsp; </td></tr>";
					$message .= "<tr><td> &nbsp; </td><td><font color='gray' size='2'><i>To unsubscribe and stop receiving job match notifications please click:  <a href='http://servebartendcook.com/job_notice_unsubscribe.php?page_code=ABn4t67uR&id=".$userID."&key_hash=".$key_hash."'>unsubscribe</a></i></font></td></tr>";										
					$message .= "<tr><td> &nbsp; </td><td><font color='gray' size='1'><i>White Bird, LLC, 322 E Central Blvd., Orlando, FL 32801</i></font></td></tr>";										
					$message .= '</table>';		
					//$message .= '</body></html>';
					
					
					//FIX THIS
					$plain_text = $first_name.", you have a new job opportunity!/r/n/r/n";
					$plain_text .= "A new ".$specialty." job that matches your skills and location has been added to ServeBartendCook.com./r/n/";		
					$plain_text .= "This job was added on ".$date_created.".  Jobs on ServeBartendCook tend to fill quickly, so the faster you respond, the better your chances of receiving an interview.</r/n/";		
					$plain_text .= "Please login to view the details of this employment opportunity./r/n/r/n/";		
					$plain_text .= "To change your email settings or profile match settings please login to ServeBartendCook.com and click 'Email Notifications' on the main page (click 'Help' on the mobile version').  Feel free to contact us with any problems or questions at info@servebartendcook.com.";
					$plain_text .= "To unsubscribe and stop receiving job match notifications please go to:  http://servebartendcook.com/job_notice_unsubscribe.php?page_code=ABn4t67uR&id=".$userID."&key_hash=".$key_hash;										
					$plain_text .= "  /r/n/r/n/White Bird, LLC, 322 E Central Blvd., Orlando, FL 32801";										

					
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
					        "to" => array(array("email" => "$to_email",
					        					"name" => "$to_name")),
					        'tags' => array("$tag"),
					        "track_opens" => true,
					        "track_clicks" => true,
					        "auto_text" => false
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
														
					//mail($to, $subject, $message, $headers);
				} elseif ($email_setting == 'N') {
					foreach($user_match_original as $sent) {				
						echo "HERE".$sent['emailID'];
						
						$db->setsql("DELETE FROM email_queue_match
											WHERE emailID = '".$sent['emailID']."' ");	
						$db->selectquery();	
					}		
				} else {
					foreach($user_match_original as $sent) {
						$db->setsql("UPDATE email_queue_match
											SET date_sent = NOW()
											WHERE emailID = '".$sent['emailID']."' ");	
						$db->selectquery();
					}
				}
		} else {
			foreach($user_match_original as $sent) {
				$db->setsql("UPDATE email_queue_match
									SET date_sent = NOW()
									WHERE emailID = '".$sent['emailID']."' ");	
				$db->selectquery();
			}			
		}	
	}
}


?>