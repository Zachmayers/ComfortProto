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
	$count = 0;
	if (count($result) > 0) {
		foreach ($result as $row) {	
			$db = new Mysqldb;
			$db->setsql("SELECT firstname, email, email_setting FROM members WHERE userID = '".$row['userID']."' ");
			$db->selectquery();
			$info = $db->result;
			$jobID = $row['jobID'];

			foreach($info as $user) {
				$to_email = $user['email'];
				$first_name = $user['firstname'];
				$last_name = $user['lastname'];				
				$email_setting = $user['email_setting'];
				//echo $to.$first_name.$email_setting;
				break;
			}
			
			$to_name = $first_name." ".$last_name;
			
			$db = new Mysqldb;
			$db->setsql("SELECT date_created, specialty FROM jobs, jobs_specialties 
								WHERE jobs.jobID = '".$jobID."'
								AND jobs_specialties.jobID = '".$jobID."' ");
			$db->selectquery();
			$job_array = $db->result;
			//echo count($job_array);
			foreach($job_array as $job_info) {
				$specialty = $job_info['specialty'];
				$date_created = date('M j, Y', strtotime($job_info['date_created']));
				//echo $specialty;
			}			
			//echo "jobID".$jobID;
			if ($email_setting == 'Y') {
				$db->setsql("UPDATE email_queue_match
									SET date_sent = NOW()
									WHERE emailID = '".$row['emailID']."' ");	
				$db->selectquery();
												
					$subject = 'SBC - '.$specialty.' Job Match for '.$first_name;
					
/*
					$headers = "From: ServeBartendCook <info@servebartendcook.com>\r\n";
					$headers .= 'Bcc: admin@servebartendcook.com' . "\r\n";	
					$headers .= "Reply-To: info@servebartendcook.com\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
*/
					//$message = '<html><body>';
					$message = '<table width="580">';
					$message .= "<tr><td colspan='2'><a href='http://servebartendcook.com'><img src='http://servebartendcook.com/images/main.png' height='80'></a></td></tr>";				
					$message .= "<tr><td colspan='2'><h2>".$first_name.", you have a new job opportunity!</h2></td></tr>";
					$message .= "<tr><td> &nbsp; </td><td>A new ".$specialty." job that matches your skills and location has been added to <a href='http://servebartendcook.com'>ServeBartendCook.com</a>.</td></tr>";		
					$message .= "<tr><td> &nbsp; </td><td>This job was added on ".$date_created.".  Jobs on ServeBartendCook tend to fill quickly, so the faster you respond, the better your chances of receiving an interview.</td></tr>";		
					$message .= "<tr><td> &nbsp; </td><td>Please login to view the details of this employment opportunity.</td></tr>";		
					$message .= "<tr><td> &nbsp; </td><td><h3>Follow Us:</h3>  <a href='http://facebook.com/servebartendcook'><img src='http://servebartendcook.com/images/facebook.png' height='30'></a> <a href='http://twitter.com/servebarcook'><img src='http://servebartendcook.com/images/twitter.png' height='30'></a></td></tr>";
					$message .= "<tr><td> &nbsp; </td><td> &nbsp; </td></tr>";
					$message .= "<tr><td> &nbsp; </td><td>To change your email settings or profile match settings please login to ServeBartendCook.com and click 'Email Notifications' on the main page (click 'Help' on the mobile version').  Feel free to contact us with any problems or questions at info@servebartendcook.com.</td></tr>";
					$message .= '</table>';		
					//$message .= '</body></html>';
					
					$plain_text = $first_name.", you have a new job opportunity!/r/n/r/n";
					$plain_text .= "A new ".$specialty." job that matches your skills and location has been added to ServeBartendCook.com./r/n/";		
					$plain_text .= "This job was added on ".$date_created.".  Jobs on ServeBartendCook tend to fill quickly, so the faster you respond, the better your chances of receiving an interview.</r/n/";		
					$plain_text .= "Please login to view the details of this employment opportunity./r/n/r/n/";		
					$plain_text .= "To change your email settings or profile match settings please login to ServeBartendCook.com and click 'Email Notifications' on the main page (click 'Help' on the mobile version').  Feel free to contact us with any problems or questions at info@servebartendcook.com.";
					
					$from_email = "info@servebartendcook.com";
					$first_name = "ServeBartendCook";
					
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
echo "HI".$response;
 // Close the connection
    curl_close( $curl ); 					
														
					//mail($to, $subject, $message, $headers);
				} elseif ($email_setting == 'N') {
					echo "HERE".$row['emailID'];
					$db->setsql("DELETE FROM email_queue_match
										WHERE emailID = '".$row['emailID']."' ");	
					$db->selectquery();			
				}
		}	
	}


?>