<?php
	
require_once('sendgrid/sendgrid-php/sendgrid-php.php');
require_once('sendgrid/smtpapi-php/smtpapi-php.php');	
	
class Database {
/*
    private $host      = "localhost";
    private $user      = "servebar_admin";
    private $pass      = "Handle1t";
    private $dbname = "servebar_main";
*/

    private $host      = "localhost";
    private $user      = "servebar_newuser";
    private $pass      = "Overl0rd11";
    private $dbname = "servebar_new";


//PROTOTYPE SITE
/*
    private $host      = "localhost";
    private $user      = "henschen_sbcuser";
    private $pass      = "Handle1t";
    private $dbname = "henschen_servebar_main";
*/

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

// Find employers that have signed up recently, but have not put in a job and send them offer to help

	$database = new Database;
	$database->query("SELECT userID, email, firstname, lastname FROM members 
								 WHERE creation_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 day) AND DATE_SUB(NOW(), INTERVAL 1 day) 
								 AND type = 'employer'
								 AND current_login > 0");		
	$result = $database->resultset();

	if (count($result) > 0) {
		foreach ($result as $row) {	
			$userID = $row['userID'];

				$database->query("SELECT jobID FROM jobs WHERE userID = :userID");		
				$database->bind(':userID', $userID);		
				$jobs_array = $database->resultset();

				if (count($jobs_array) == 0) {
					//send message offering help
					
					$first_name = $row['firstname'];
					$last_name = $row['lastname'];
					$email = $row['email'];
					
					//echo $first_name." ".$last_name."<br />";
					
					$to_email = $email;
					$to_name = $first_name." ".$last_name;
					$subject = 'ServeBartendCook - Here to help';
					
					$message = '<table width="580">';
					$message .= "<tr><td colspan='2'><a href='http://servebartendcook.com'><img src='http://servebartendcook.com/images/SBC-logo-RED.png' height='80'></a></td></tr>";				
					$message .= "<tr><td colspan='2'><h2>".$first_name.",</h2></td></tr>";
					$message .= "<tr><td> &nbsp; </td><td>We noticed that you created an employer account, but have not yet posted a job.</td></tr>";		
					$message .= "<tr><td> &nbsp; </td><td>Do you have any questions or need any assistance posting your job?</td></tr>";		
					$message .= "<tr><td> &nbsp; </td><td>Please feel free to contact us at admin@servebartendcook.com. We're always happy to help.</td></tr>";		

					$message .= "<tr><td> &nbsp; </td><td>&nbsp; </td></tr>";		
					$message .="<tr><td>&nbsp; </td>Cheers,</td></tr>";
					$message .="<tr><td>&nbsp; </td>SBC Team</td></tr>";
					
					$message .= "<tr><td> &nbsp; </td><td>&nbsp; </td></tr>";		
					$message .= "<tr><td> &nbsp; </td><td><i>If you meant to create a job-seeker account, please email us and we will change the account type for you</td></tr>";		

					$message .= "<tr><td> &nbsp; </td><td><h3>Follow Us:</h3>  <a href='http://facebook.com/servebartendcook'><img src='http://servebartendcook.com/images/facebook.png' height='30'></a> <a href='http://twitter.com/servebarcook'><img src='http://servebartendcook.com/images/twitter.png' height='30'></a> <a href='http://instagram.com/servebartendcook'><img src='http://servebartendcook.com/images/Istagram-Icon.png' height='30'></a></td></tr>";
					$message .= "<tr><td> &nbsp; </td><td> &nbsp; </td></tr>";
					$message .= '</table>';		
										
					$from_email = "admin@servebartendcook.com";
					$from_name = "ServeBartendCook";
					
					$tag = "employer_followup";
					
/*
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
*/
					
		$sendgrid = new SendGrid('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');

		$email = new SendGrid\Email();
		$email
		    ->addTo("$to_email", "$to_name")
		    ->setFrom("$from_email")
		    ->setFromName("$from_name")
		    ->setSubject("$subject")
		    ->setCategory("$tag")
		    ->setText("$message")
		    ->setHtml("$message");
		    
			// catch the error

		try {
		   // $sendgrid->send($email);
		} catch(\SendGrid\Exception $e) {
		    echo $e->getCode();
		    foreach($e->getErrors() as $er) {
		        echo $er;
				$headers = "From: ServeBartendCook <info@servebartendcook.com>\r\n";
				$headers .= "Reply-To: info@servebartendcook.com\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		        
		       // mail("jbhenschen@gmail.com", "email error", $er, $headers);
		    }
		}
		    
					
// Open a curl session for making the call

/*
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
*/
					    
					    				
				}
	}
}
?>