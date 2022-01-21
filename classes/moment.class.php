<?php
require_once('mysqldb.class.php');	
require_once('utilities.class.php');	

require_once('message.class.php');	

class Moment {

	public $momentID;
	
	function __construct($momentID) {
		$this->momentID = $momentID;
	}
	
	function get_moment_type_list() {
			$database = new Database;
			
			$database->query('SELECT * FROM moment_types');
			$result = $database->resultset();	
			return $result;	
	}
	
	function create_moment($event, $title, $address, $zip, $date, $time, $description) {
			$database = new Database;

			$low_timestamp = strtotime($time) - 59*60;
			$high_timestamp = strtotime($time) + 59*60;

			$low_time = date('H:i', $low_timestamp);
			$high_time = date('H:i', $high_timestamp);


			//test for duplicate/double book
			$database->query('SELECT momentID FROM moments
					  			      	 WHERE creatorID = :creatorID AND moment_date = :date 
											 AND moment_time BETWEEN :low AND :high');
					$database->bind(':creatorID', $_SESSION['userID']);
					$database->bind(':date', $date);
					$database->bind(':low', $low_time);
					$database->bind(':high', $high_time);
					$result = $database->resultset();

					if (count($result) > 0) {
						return "doublebook";
					} else {
						$database->query('INSERT INTO moments
										(creatorID, moment_type, location_name, description, moment_date, moment_time, address, city, state, zip, regionID)
										VALUES (:creatorID, :moment_type, :location_name, :description, :date, :time, :address, :city, :state, :zip, :regionID)');
						$database->bind(':creatorID', $_SESSION['userID']);
						$database->bind(':moment_type', $event);
						$database->bind(':location_name', $title);
						$database->bind(':description', $description);
						$database->bind(':date', $date);
						$database->bind(':time', $time);
						$database->bind(':address', $address);
						$database->bind(':city', "Orlando");
						$database->bind(':state', "FL");
						$database->bind(':zip', $zip);
						$database->bind(':regionID', "1");

						$database->execute();
						$momentID = $database->lastInsertId();
						
						$database->query('INSERT INTO moment_track
										(momentID)
										VALUES (:momentID)');
						$database->bind(':momentID', $momentID);

						$database->execute();
						
						//$moment_array = array("momentID" => $momentID);
									
						//return $moment_array;
						return $momentID;
					}
		}
		
		function get_standard_detail($moment_type){
			$database = new Database;
			
			$database->query('SELECT * FROM moment_types WHERE ID = :ID');
			$database->bind(':ID', $moment_type);

			$result = $database->single();	
			return $result;	
			
		}
		
		function check($userID, $user_type, $type, $momentID) {
			$database = new Database;
	
			switch ($type) {
				case "check_in":
			
					switch ($user_type) {
						case "client":
						
							$database->query('UPDATE moment_track
											 SET client_checkin = NOW()
											 where momentID = :momentID');
						break;
						
						case "provider":

							$database->query('UPDATE moment_track
											 SET provider_checkin = NOW()
											 where momentID = :momentID');
						break;
					}
					
					$database->bind(':momentID', $momentID);
					$database->execute();
					
					//see if passcode exist, if not then create
					$passcode = $this->get_passcode($momentID);
					return $passcode;
				break;

				case "check_out":
					switch ($user_type) {
						case "client":
							$database->query('UPDATE moment_track
											 SET client_checkout = NOW()
											 where momentID = :momentID');
						break;
						
						case "provider":

							$database->query('UPDATE moment_track
											 SET provider_checkout = NOW()
											 where momentID = :momentID');
						break;
					}
					
					$database->bind(':momentID', $momentID);
					$database->execute();

					//test for complete
					$database->query('SELECT provider_checkout, client_checkout FROM moment_track
					WHERE momentID = :momentID ');
					$database->bind(':momentID', $momentID);
					$result = $database->single();

					if (!is_null($result['provider_checkout']) && !is_null($result['provider_checkout'])) {
						$database->query('UPDATE moment_track
											 SET complete = :complete
											 WHERE momentID = :momentID');
						$database->bind(':momentID', $momentID);
						$database->bind(':complete', "Y");
						$database->execute();

						$database->query('UPDATE moments
						SET complete = :complete
						WHERE momentID = :momentID');
						$database->bind(':momentID', $momentID);
						$database->bind(':complete', "Y");
						$database->execute();						
					}
				break;
				
			}
			
		
		}
		
		function get_passcode($momentID) {
			//check if passcode exists, if so return, else create passcode by random word from each of 3 tables
			
			$database = new Database;
			
			$database->query('SELECT pass_code FROM moment_track WHERE momentID = :momentID ');
			$database->bind(':momentID', $momentID);
			$result = $database->single();	
			
			if (is_null($result['pass_code'])) {
				//write new passcode
					$database->query('SELECT color FROM colors ORDER BY RAND() LIMIT 1');
					$result = $database->single();	
					$color = $result['color'];
					
					$database->query('SELECT adjective FROM adjective ORDER BY RAND() LIMIT 1');
					$result2 = $database->single();	
					$adjective = $result2['adjective'];
					
					$database->query('SELECT noun FROM nouns ORDER BY RAND() LIMIT 1');
					$result3 = $database->single();	
					$noun = $result3['noun'];			
							
										
					$passcode = $adjective." ".$color." ".$noun;
					
					$database->query('UPDATE moment_track
						SET pass_code = :passcode
						WHERE momentID = :momentID');
						$database->bind(':momentID', $momentID);
						$database->bind(':passcode', $passcode);
						$database->execute();						
			} else {
					$passcode = $result['pass_code'];
			}
			
			return $passcode;
		}
		
		function accept($momentID) {
			//update moment table to add provider
			//error check make sure propvide doesnt already exist
			
			$database = new Database;
			$database->query('UPDATE moments
									SET providerID = :providerID
									WHERE momentID = :momentID');
									$database->bind(':momentID', $momentID);
									$database->bind(':providerID', $_SESSION['userID']);
									$database->execute();		
									
								
		}
		

		function update_moment($payload) {
			$database = new Database;

			$database->query('UPDATE moments SET
			creatorID = :creatorID,
			moment_type = :moment_type,
			description = :description,
			moment_date = :moment_date, 
			moment_time = :moment_time,
			address = :address,
			city = :city, 
			state = :state,
			zip := zip, 
			regionID := regionID
			WHERE momentID = :momentID');
			$database->bind(':creatorID', $payload['userID']);
			$database->bind(':moment_type', $payload['type']);
			$database->bind(':description', $payload['description']);
			$database->bind(':date', $payload['date']);
			$database->bind(':time', $payload['time']);
			$database->bind(':address', $payload['address']);
			$database->bind(':city', $payload['city']);
			$database->bind(':state', $payload['state']);
			$database->bind(':zip', $payload['zip']);
			$database->bind(':regionID', $payload['regionID']);	
			$database->bind(':momentID', $payload['momentID']);	
			$database->execute();
		}

		function cancel_moment($momentID) {
			$database = new Database;

			$database->query('UPDATE moments SET
			status = :status
			WHERE momentID = :momentID');
			$database->bind(':status', "canceled");
			$database->bind(':momentID', $momentID);	
			$database->execute();
		}

		function rate_moment($rating, $notes, $type) {
			$database = new Database;
			$momentID = $this->momentID;
			//make sure user has checked out of moment		
	
				$database->query('SELECT provider_checkout, client_checkout FROM moment_track
			  			      	 WHERE momentID = :momentID ');
				$database->bind(':momentID', $momentID);
				$result = $database->single();

			if ($type == "client") {
				if (!is_null($result['client_checkout'])) {
					
					$database->query('UPDATE moment_track
						SET client_moment_rating = :rating, client_notes = :notes
						WHERE momentID = :momentID');
						$database->bind(':rating', $rating);
						$database->bind(':notes', $notes);
						$database->bind(':momentID', $momentID);
						$database->execute();
						return "True";
				} else {
					return "No Checkout Value";
				}
					

			} elseif ($type == "provider") {
				$database->query('UPDATE moment_track
				SET provider_moment_rating = :rating, provider_notes = :notes
				WHERE momentID = :momentID');
				$database->bind(':rating', $rating);
				$database->bind(':notes', $notes);
				$database->bind(':momentID', $momentID);				
				$database->execute();
				return "True";
			}


		}	

		function get_moment_data($momentID) {
			$database = new Database;
	
			$database->query('SELECT * FROM moments
			  			      	 WHERE momentID = :momentID ');
			$database->bind(':momentID', $momentID);
			$result = $database->single();
			
			return $result;
		}

		function get_checkin($momentID) {
			$database = new Database;
	
			$database->query('SELECT * FROM moment_track
			  			      	 WHERE momentID = :momentID ');
			$database->bind(':momentID', $momentID);
			$result = $database->single();
			
			return $result;
		}
		
		function valid_chat_test($momentID) {
			return true;
		}
		
		function get_chat($momentID) {
			$database = new Database;
	
			$database->query('SELECT * FROM chat
			  			      	 WHERE momentID = :momentID ');
			$database->bind(':momentID', $momentID);
			$result = $database->resultset();
			return $result;
		}	
		
		function get_updated_chat($momentID) {
			$database = new Database;
			
			if ($_SESSION['type'] == "provider") {
				$database->query('SELECT * FROM chat
				  			      	 WHERE momentID = :momentID
				  			      	 AND (provider_checked < date_created
				  			      	 OR provider_checked IS NULL)');
				$database->bind(':momentID', $momentID);
				$result = $database->resultset();
				
				if (count($result) > 0) {
					$database->query('UPDATE chat
					SET provider_checked = NOW()
					WHERE momentID = :momentID');
					$database->bind(':momentID', $momentID);				
					$database->execute();				
				}			
			} else {
				$database->query('SELECT * FROM chat
				  			      	 WHERE momentID = :momentID
				  			      	 AND (client_checked < date_created
				  			      	 OR client_checked IS NULL)');
				$database->bind(':momentID', $momentID);
				$result = $database->resultset();
				
				if (count($result) > 0) {
					$database->query('UPDATE chat
					SET client_checked = NOW()
					WHERE momentID = :momentID');
					$database->bind(':momentID', $momentID);				
					$database->execute();				
				}			
				
			}
			
			return $result;
		}	
		
		
		function update_view_chat($momentID) {
			$database = new Database;
			
			if ($_SESSION['type'] == "provider") {
					$database->query('UPDATE chat
					SET provider_checked = NOW()
					WHERE momentID = :momentID');
					$database->bind(':momentID', $momentID);				
					$database->execute();										
			} else {
					$database->query('UPDATE chat
					SET client_checked = NOW()
					WHERE momentID = :momentID');
					$database->bind(':momentID', $momentID);				
					$database->execute();								
			}
			
		}		
		
		
		function send_message($momentID, $message) {
			$database = new Database;

			$database->query('INSERT INTO chat
							(momentID, senderID, message, date_created)
							VALUES (:momentID, :senderID, :message, NOW())');
			$database->bind(':senderID', $_SESSION['userID']);
			$database->bind(':momentID', $momentID);
			$database->bind(':message', $message);

			$database->execute();
			
		}		
		


	
	
	function report_inappropriate_content($ID, $type) {
		$message = new Message;
		$message->inappropriate_message($type, $ID, $_SESSION['userID']);
	}

	
}
?>