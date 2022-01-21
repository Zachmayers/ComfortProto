<?php
require_once('mysqldb.class.php');	
require_once('utilities.class.php');	
require_once('member.class.php');	

class MomentList {

	public $userID;
	
	function __construct($userID) {
		$this->userID = $userID;
	}
	
		function get_moment_list($type, $regionID) {
			//get todays date
			//today creator booked
			$date = new DateTime("now", new DateTimeZone('America/New_York') );
			$format_date = $date->format('Y-m-d');

			switch($type) {
				case "today_client":
					$database = new Database;
					
					$database->query('SELECT * FROM moments
					  			      	 WHERE creatorID = :creatorID					  			     
					  			      	  AND moment_date = :current_date');
					$database->bind(':creatorID', $_SESSION['userID']);
					$database->bind(':current_date', $format_date);
					
			
					$result = $database->resultset();
					return $result;
				break;

				case "today_provider":
					$database = new Database;
			
					$database->query('SELECT * FROM moments
					  			      	 WHERE providerID = :providerID AND moment_date = :current_date
					  				  	 		');
					$database->bind(':providerID', $_SESSION['userID']);
					$database->bind(':current_date', $format_date);
				
			
					$result = $database->resultset();
					return $result;
				break;
				
				case "upcoming_client":
					$database = new Database;
					$database->query('SELECT * FROM moments
					  			      	 WHERE creatorID = :clientID AND moment_date >= :current_date
					  			      	 ORDER BY moment_date ASC');
					$database->bind(':clientID', $_SESSION['userID']);
					$database->bind(':current_date', $format_date);
			
					$result = $database->resultset();
					return $result;
				break;	
				
				case "upcoming_provider":
					$database = new Database;
					$database->query('SELECT * FROM moments
					  			      	 WHERE providerID = :providerID AND moment_date >= NOW()
					  			      	 ORDER BY moment_date ASC');
					$database->bind(':providerID', $_SESSION['userID']);
			
					$result = $database->resultset();
					return $result;
				break;		
					
				
				case "available":
					$database = new Database;
					$database->query('SELECT * FROM moments
					  			      	 WHERE moment_date >= :current_date
					  			      	 AND providerID IS NULL
					  			      	 ORDER BY moment_date ASC');
					$database->bind(':current_date', $format_date);
					$result = $database->resultset();
					return $result;
				break;				
						
				case "past_provider":
					$database = new Database;
					$database->query('SELECT * FROM moments, moment_track
					  			      	 WHERE moments.providerID = :providerID
					  			      	 AND moments.status = :status
					  			      	 AND moments.momentID = moment_track.momentID');
					$database->bind(':providerID', $_SESSION['userID']);
					$database->bind(':status', 'complete');
			
					$result = $database->resultset();
					return $result;
				break;		
				
				case "past_client":
					$database = new Database;
					$database->query('SELECT * FROM moments, moment_track
					  			      	 WHERE moments.creatorID = :clientID
					  			      	 AND moments.status = :status
					  			      	 AND moments.momentID = moment_track.momentID');
					$database->bind(':clientID', $_SESSION['userID']);
					$database->bind(':status', 'complete');
			
					$result = $database->resultset();
					return $result;
				break;		

			}
			
		}	
		
		function check_new_messages() {
			$database = new Database;
			
			if ($_SESSION['type'] == "provider") {
				$database->query('SELECT * FROM chat, moments
				  			      	 WHERE moments.providerID = :userID
				  			      	 AND moments.momentID = chat.momentID
				  			      	 AND chat.senderID != :userID
				  			      	 AND chat.provider_checked IS NULL');				
			} else {
					$database->query('SELECT * FROM chat, moments
				  			      	 WHERE moments.creatorID = :userID
				  			      	 AND moments.momentID = chat.momentID
				  			      	 AND chat.senderID != :userID
				  			      	 AND chat.client_checked IS NULL');							
			}
					
			$database->bind(':userID', $_SESSION['userID']);

			$result = $database->resultset();
			return $result;
			
		}
		
		function unchecked_messages() {
			$database = new Database;
			
			if ($_SESSION['type'] == "provider") {
				$database->query('SELECT * FROM chat, moments
				  			      	 WHERE moments.providerID = :userID
				  			      	 AND moments.momentID = chat.momentID
				  			      	 AND chat.senderID != :userID
				  			      	 AND chat.provider_checked IS NULL');				
			} else {
					$database->query('SELECT * FROM chat, moments
				  			      	 WHERE moments.creatorID = :userID
				  			      	 AND moments.momentID = chat.momentID
				  			      	 AND chat.senderID != :userID
				  			      	 AND chat.client_checked IS NULL');							
			}
					
			$database->bind(':userID', $_SESSION['userID']);

			$result = $database->resultset();
			return $result;
			
		}

		function check_open_messages() {
			//first get new mess
			$database = new Database;
			
			if ($_SESSION['type'] == "provider") {
				$database->query('SELECT * FROM chat, moments
				  			      	 WHERE moments.providerID = :userID
				  			      	 AND moments.momentID = chat.momentID
				  			      	 AND chat.senderID != :userID
				  			      	 AND moments.status IS NULL
				  			      	 AND chat.provider_checked IS NOT NULL');				
			} else {
					$database->query('SELECT * FROM chat, moments
				  			      	 WHERE moments.creatorID = :userID
				  			      	 AND moments.momentID = chat.momentID
				  			      	 AND chat.senderID != :userID
				  			      	 AND moments.status IS NULL
				  			      	 AND chat.client_checked IS NOT NULL');							
			}
					
			$database->bind(':userID', $_SESSION['userID']);

			$result = $database->resultset();
			return $result;
			
		}		
		

}