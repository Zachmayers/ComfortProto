<?php
class Database {
/*
    private $host      = "localhost";
    private $user      = "servebar_admin";
    private $pass      = "Handle1t";
    private $dbname = "servebar_main";
*/

//PROTOTYPE SITE
    private $host      = "localhost";
    private $user      = "henschen_sbcuser";
    private $pass      = "Handle1t";
    private $dbname = "henschen_servebar_main";

 //   private $dbname = "henschen_SBC";
 
    private $dbh;
    private $error;
    
	private $stmt;    
 
    public function __construct(){
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
        // Create a new PDO instanace
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
        // Catch any errors
        catch(PDOException $e){
            $this->error = $e->getMessage();
        }
    }
    
	public function query($query){
	    $this->stmt = $this->dbh->prepare($query);
	}    
	
	public function bind($param, $value, $type = null){
	    if (is_null($type)) {
	        switch (true) {
	            case is_int($value):
	                $type = PDO::PARAM_INT;
	                break;
	            case is_bool($value):
	                $type = PDO::PARAM_BOOL;
	                break;
	            case is_null($value):
	                $type = PDO::PARAM_NULL;
	                break;
	            default:
	                $type = PDO::PARAM_STR;
	        }
	    }
	    $this->stmt->bindValue($param, $value, $type);
	}   
	
	public function execute(){
	    return $this->stmt->execute();
	}	
	
	public function resultset(){
	    $this->execute();
	    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function single(){
	    $this->execute();
	    return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	public function rowCount(){
	    return $this->stmt->rowCount();
	}	
	
	public function lastInsertId(){
	    return $this->dbh->lastInsertId();
	}			 
	
	public function beginTransaction(){
	    return $this->dbh->beginTransaction();
	}	
	
	public function endTransaction(){
	    return $this->dbh->commit();
	}
	
	 public function cancelTransaction(){
	    return $this->dbh->rollBack();
	}	
	
	public function debugDumpParams(){
	    return $this->stmt->debugDumpParams();
	}		
}

//Get jobs that employers started to enter, but stopped.  Send them an email asking if they need assistance.
	$database = new Database;
	$database->query("SELECT jobID, userID, storeID, title FROM jobs 
								 WHERE date_created BETWEEN DATE_SUB(NOW(), INTERVAL 2 DAY) AND DATE_SUB(NOW(), INTERVAL 1 DAY) 
								 AND (job_status = :custom_edit OR job_status = :template_edit OR job_status = :final_step)");		
	$database->bind(':custom_edit', "custom_edit");		
	$database->bind(':template_edit', "template_edit");		
	$database->bind(':final_step', "final_step");		
	$result = $database->resultset();
	
	//start an array of users, to make sure emails aren't doubled
	$sent_users = array();
	if (count($result) > 0) {
		foreach ($result as $row) {	
			$userID = $row['userID'];
			if (!in_array($userID, $sent_users)) {
				//check if user has posted a valid job in the interval above (this would mean the abandoned the unfiinished job and created a new one)
				$database->query("SELECT jobID FROM jobs 
											 WHERE (job_status = :open OR job_status = :filled)
											 AND userID = :userID");		
				$database->bind(':open', "Open");		
				$database->bind(':filled', "Filled");		
				$database->bind(':userID', $userID);		
				$jobs_array = $database->resultset();

				if (count($jobs_array) == 0) {
					//send message offering help
					
					//get name and email
					$database->query("SELECT email, firstname, lastname FROM members WHERE userID = :userID");		
					$database->bind(':userID', $userID);		
					$name_array = $database->single();
					
					$first_name = $name_array['firstname'];
					$last_name = $name_array['lastname'];
					//$email = $name_array['email'];
					
					echo $first_name." ".$last_name."<br />";
					
					$to_email = "jbhenschen@gmail.com";
					$to_name = $first_name." ".$last_name;
					$subject = 'SBC - Checking on your job post';
					
					$message = '<table width="580">';
					$message .= "<tr><td colspan='2'><a href='http://servebartendcook.com'><img src='http://servebartendcook.com/images/main.png' height='80'></a></td></tr>";				
					$message .= "<tr><td colspan='2'><h2>".$first_name.",</h2></td></tr>";
					$message .= "<tr><td> &nbsp; </td><td>We noticed that you began posting a job on our site, but didn't finish it.</td></tr>";		
					$message .= "<tr><td> &nbsp; </td><td>Do you have any questions or need any assistance posting your job?</td></tr>";		
					$message .= "<tr><td> &nbsp; </td><td>Please contact us at admin@servebartendcook.com. We're always happy to help.</td></tr>";		
					$message .= "<tr><td> &nbsp; </td><td> &nbsp; </td></tr>";
					$message .="<tr><td>&nbsp; </td>Cheers,</td></tr>";
					$message .="<tr><td>&nbsp; </td>SBC Team</td></tr>";
					$message .= "<tr><td> &nbsp; </td><td><h3>Follow Us:</h3>  <a href='http://facebook.com/servebartendcook'><img src='http://servebartendcook.com/images/facebook.png' height='30'></a> <a href='http://twitter.com/servebarcook'><img src='http://servebartendcook.com/images/twitter.png' height='30'></a> <a href='http://instagram.com/servebartendcook'><img src='http://servebartendcook.com/images/Istagram-Icon.png' height='30'></a></td></tr>";
					$message .= "<tr><td> &nbsp; </td><td> &nbsp; </td></tr>";

					$message .= '</table>';		
										
					$from_email = "admin@servebartendcook.com";
					$from_name = "ServeBartendCook";
					
					$tag = "incomplete_job_followup";
					$args = array(
					    'key' => 'I0--PjxJ5IkJQhKv329s9A',
					    'message' => array(
					        "html" => "$message",
					        "text" => "$message",
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
					$sent_users[] = $userID;	
				}
			}							
	}
}
?>