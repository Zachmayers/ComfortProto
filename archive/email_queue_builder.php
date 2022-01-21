<?php
	
/*
require_once($_SERVER['DOCUMENT_ROOT'].'/SBC/sendgrid/sendgrid-php/sendgrid-php.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/SBC/sendgrid/smtpapi-php/smtpapi-php.php');
*/
error_reporting(E_ALL);
ini_set('display_errors', 1);	
class Database {
	
	
/*
    private $host      = "localhost";
    private $user      = "servebar_newuser";
    private $pass      = "Overlord11";
    private $dbname = "servebar_new";
*/

//PROTOTYPE SITE
	
    private $host      = "localhost";
    private $user      = "henschen_sbcnew";
    private $pass      = "Overl0rd22";
    private $dbname = "henschen_servebar_main";
	
/*

    private $host      = "localhost";
    private $user      = "henschen_sbcnew";
    private $pass      = "Overl0rd22";
    private $dbname = "henschen_servebar_main";
*/
 
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

/*
	$config = parse_ini_file("../../config.ini"); 
	echo var_dump($config);
*/
/*
$db_config = new DB_Config;
$config = $db_config->get_db_config();
echo var_dump($config);
*/

            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
           // $this->dbh =new PDO('mysql:host=localhost;henschen_servebar_main', 'henschen_sbcnew', 'Overl0rd11');
        }
        // Catch any errors
        catch(PDOException $e){
	        echo "ERROR";
	        //turn this off for live code
	        print_r($e);
            $this->error = $e->getMessage();
        }
    }
    
	public function query($query){
		//echo $query;
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
	    $result = $this->stmt->fetch(PDO::FETCH_ASSOC);
		if (!is_array($result)) {
			return array();
		} else {
		    return $result;
		}
	}		

/*
	public function single(){
	    $this->execute();
	    return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}			
*/
		
	
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


//GOAL

	$database = new Database;

//Get jobs in the last 15 mins
	$database->query("SELECT jobID, storeID FROM jobs WHERE date_created >= DATE_SUB(NOW(), INTERVAL 15 MINUTE) 
									AND job_status = :job_status");
	$database->bind(':job_status', 'Open');
	$result = $database->resultset();
echo var_dump($result);
	if (count($result) > 0) {
	
		//make sure it isnt't already written to queue
	
		foreach ($result as $row) {	
			$jobID = $row['jobID'];
			$storeID = $row['storeID'];
echo $jobID;
			//get the users last login to determine whether they have already viewed any of the jobs
			$database->query("SELECT jobID FROM email_queue_match WHERE jobID = :jobID");
			$database->bind(':jobID', $jobID);
			$job_check = $database->resultset();

			if (count($job_check) == 0) {
				//find matches and write to queue
				$database->query('SELECT zip FROM stores WHERE storeID = :storeID');
				$database->bind(':storeID', $storeID);
				$zip_result = $database->single();
				$zip = $zip_result['zip'];
			
				$database->query("SELECT specialty FROM jobs_specialties WHERE jobID = :jobID");
				$database->bind(':jobID', $jobID);		
				$skill_array = $database->single();
				$specialty = $skill_array['specialty'];
				
				$database->query("SELECT latitude, longitude FROM zcta WHERE zip = :zip");
				$database->bind(':zip', $zip);
				$coordinates = $database->single();
				
				$longitude = $coordinates['longitude'];
				$latitude = $coordinates['latitude'];
				
				//40 mile appoximation, square
				$max_lat = $latitude + 0.57971;
				$min_lat = $latitude - 0.57971;
				$max_long = $longitude + 0.57827;
				$min_long = $longitude - 0.57827;

				$database->query("SELECT members.userID, sub_skills.sub_skill FROM members, skills, sub_skills, zcta WHERE members.type = 'employee'
												AND members.valid = 'Y'
												AND members.profile_status = 'complete'
												AND members.email_validation = 'Y'
												AND skills.userID = members.userID
												AND members.email_setting = 'Y'
												AND skills.skill = :job_specialty
												AND skills.seeking = 'Y'
												AND skills.skillID = sub_skills.skillID
												AND members.zip = zcta.zip
												AND zcta.latitude BETWEEN :min_lat AND :max_lat
												AND zcta.longitude BETWEEN :min_long AND :max_long ");							
		
				$database->bind(':min_lat', $min_lat);
				$database->bind(':max_lat', $max_lat);
				$database->bind(':min_long', $min_long);
				$database->bind(':max_long', $max_long);
				$database->bind(':job_specialty', $specialty);
				$member_sub_skills = $database->resultset();	

				$reduced_member_array = array();

				foreach($member_sub_skills as $row) {
					$reduced_member_array[] = $row['userID'];
				}						
				$member_array = array_unique($reduced_member_array);

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
		}
	}


?>