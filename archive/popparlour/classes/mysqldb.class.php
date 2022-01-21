<?php
	//require_once('db_config.php');	

class Database {
	
//PROTOTYPE SITE
	
    private $host      = "localhost";
    private $user      = "servebar_popadmin";
    private $pass      = "Overl0rd11";
    private $dbname = "servebar_popparlour";
	
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
?>