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

	$db = new Mysqldb;

//Get jobs that expire inside of 24 hours

	//calculate hours left before expiration
	date_default_timezone_set('America/Los_Angeles');		
	$date1 =  time();

	$db->setsql("SELECT * FROM jobs WHERE expiration_date > NOW() AND job_status = 'Open'");
	$db->selectquery();
	$result = $db->result;
	
	//start an array of users, to make sure emails aren't doubled
	$sent_users = array();
	echo "COUNT ".count($result)."<br />";
	if (count($result) > 0) {
		foreach ($result as $row) {	
			$date2 = strtotime($row['expiration_date']);
			$hourdiff = ($date2 - $date1) / 3600;
			echo $date2." - ".$date1." = ".$hourdiff." || ";
			if ($hourdiff <= 25) {
				$db = new Mysqldb;
				$db->setsql("SELECT firstname, email, email_setting FROM members WHERE userID = '".$row['userID']."' AND email_setting = 'Y' ");
				$db->selectquery();
				$info = $db->result;
				
				foreach($info as $user) {
					$to_email = $user['email'];
					$first_name = $user['firstname'];
					$last_name = $user['lastname'];				
					//echo $to.$first_name.$email_setting;
				}				
				
				if (!in_array($row['userID'], $sent_users)) {
					$to_name = $first_name." ".$last_name;
					$subject = 'SBC - Jobs Expiring in 24 Hours';
					
					$message = '<table width="580">';
					$message .= "<tr><td colspan='2'><a href='http://servebartendcook.com'><img src='http://servebartendcook.com/images/main.png' height='80'></a></td></tr>";				
					$message .= "<tr><td colspan='2'><h2>".$first_name.", you have at least one job posting that is about to expire.</h2></td></tr>";
					$message .= "<tr><td> &nbsp; </td><td>A job that you posted is set to expire within 24 hours.</td></tr>";		
					$message .= "<tr><td> &nbsp; </td><td>After this job expires you will NOT be able to view any interested candidates.  Please log in to review any candidate information, if needed.</td></tr>";		
					$message .= "<tr><td> &nbsp; </td><td><a href='servebartendcook.com'>ServeBartendCook.com</a></td></tr>";		
					$message .= "<tr><td> &nbsp; </td><td><h3>Follow Us:</h3>  <a href='http://facebook.com/servebartendcook'><img src='http://servebartendcook.com/images/facebook.png' height='30'></a> <a href='http://twitter.com/servebarcook'><img src='http://servebartendcook.com/images/twitter.png' height='30'></a></td></tr>";
					$message .= "<tr><td> &nbsp; </td><td> &nbsp; </td></tr>";
					$message .= '</table>';		
					//$message .= '</body></html>';
					
					$plain_text = $first_name.", you have a job that is about to expire. /r/n/r/n";
					$plain_text .= "A job posting of yours is set to expire within 24 hours. /r/n/";		
					$plain_text .= "After this job expires you will NOT be able to view any interested candidates.  Please log in to review any candidates information if needed. /r/n/";		
					
					$from_email = "info@servebartendcook.com";
					$from_name = "ServeBartendCook";
					
					$tag = "expiration_warning_24hrs";
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
					echo $response;
					 // Close the connection
					    curl_close( $curl ); 					
					
				//Push user ID to sent array;
					$sent_users[] = $row['userID'];	
					echo $row['userID']."SENT COUNT ".count($sent_users)."<br />";
				} else {
					echo $row['userID'].": IN SENT ARRAY ".count($sent_users)."<br />";					
				}
			}
												
		}	
	}


?>