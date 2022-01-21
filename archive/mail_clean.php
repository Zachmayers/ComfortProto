<?php
	
require_once('classes/mysqldb.class.php');	
	
	$mail_test = $_GET['mail_test'];
	
	if ($mail_test == "yes") {
		
		$database = new Database;

		$database->query('SELECT * FROM unsub_list WHERE done != :done LIMIT 100');
		$database->bind(':done', 'Y');			
		$result = $database->resultset();
		foreach($result as $row) {
			echo $row['email']."<br />";
			$database->query('UPDATE members SET email_setting = :setting WHERE email = :email LIMIT 1');
			$database->bind(':setting', 'N');			
			$database->bind(':email', $row['email']);
			$database->execute();	
			
			$database->query('UPDATE unsub_list SET done = :done WHERE ID = :id LIMIT 1');
			$database->bind(':done', 'Y');			
			$database->bind(':id', $row['ID']);
			$database->execute();		
		}
		
	}
?>