<?php
require_once('mysqldb.class.php');	
require_once('utilities.class.php');	

class Store {

	public $storeID;
	
	function __construct($storeID) {
		$this->storeID = $storeID;
	}
		
	function get_store_data() {

		$general_data = $this->get_general_data();
		$open_jobs_array = $this->get_store_jobs("open");
		$expired_jobs_array = $this->get_store_jobs("closed");
		
		$store_array = array('general' => $general_data, 
											'open_jobs' => $open_jobs_array,
											'expired_jobs' => $expired_jobs_array);
											
		$utilities = new Utilities;
		array_walk_recursive($store_array, array($utilities, "makeSafe"));

		return $store_array;	
	}
	
	private function get_general_data() {
		$database = new Database;
		
		$database->query('SELECT * FROM stores WHERE storeID = :storeID');
		$database->bind(':storeID', $this->storeID);
		$result = $database->single();
		
		return $result;		
	}
	
	private function get_store_jobs($type) {
		$database = new Database;

		switch($type) {
			case "open":
				$database->query('SELECT jobID, title, expiration_date, job_status FROM jobs WHERE storeID = :storeID
											AND expiration_date > NOW()
											ORDER BY expiration_date DESC');								
			break;
			
			case "closed":
				$database->query('SELECT jobID, title, expiration_date, job_status FROM jobs WHERE storeID = :storeID
											AND expiration_date BETWEEN NOW() - INTERVAL 90 DAY AND NOW()
											ORDER BY expiration_date DESC');								
			break;
		}
		
		$database->bind(':storeID', $this->storeID);		
		$result = $database->resultset();	
				
		return $result;					
	}

	function update_store_data($new_store_data) {
		$store_data = $this->get_store_data();
		
		if ($_SESSION['type'] == "employer" && count($new_store_data) != 0 && $_SESSION['userID'] == $store_data['general']['userID']) {
			$database = new Database;			

			$database->query("UPDATE stores 
										SET 	name = :name, 
												address = :address, 
												zip = :zip,
												description = :description, 
												website = :website,
												facebook = :facebook
										WHERE storeID = :storeID
										AND userID = :userID ");		
			$database->bind(':name', $new_store_data['name']);
			$database->bind(':address', $new_store_data['address']);	
			$database->bind(':description', $new_store_data['description']);		
			$database->bind(':website', $new_store_data['website']);						
			$database->bind(':zip', $new_store_data['zip']);
			$database->bind(':facebook', $new_store_data['facebook']);
			$database->bind(':storeID', $this->storeID);
			$database->bind(':userID', $_SESSION['userID']);			
			$database->execute();
									
			return "true";	
		} else {
			return "error";
		}
	}
	
	function add_store($store_details) {

		if ($_SESSION['type'] == "employer") {
			$database = new Database;
			
			$database->query('INSERT INTO stores (userID, name, address, zip, description, website, facebook)
										VALUES (:userID, :name, :address, :zip, :description, :website, :facebook)');
			$database->bind(':userID', $_SESSION['userID']);			
			$database->bind(':name', $store_details['name']);
			$database->bind(':address', $store_details['address']);
			$database->bind(':zip', $store_details['zip']);
			$database->bind(':description', $store_details['description']);
			$database->bind(':website', $store_details['website']);
			$database->bind(':facebook', $store_details['facebook']);
			$database->execute();	
			
			return $database->lastInsertId();
		} else {
			return "error";
		}	
	}		
}

?>