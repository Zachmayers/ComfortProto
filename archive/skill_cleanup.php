<?php
/*
require_once($_SERVER['DOCUMENT_ROOT'].'/classes/mysqldb.class.php');		

if ($_GET['key'] == "grok212") {
	echo "START<br />";

		$database = new Database;
		$database->query('SELECT skillID FROM sub_skills WHERE userID = :userID LIMIT 2200');
		$database->bind(':userID', "0");
		$result = $database->resultset();
		
		foreach ($result as $row){
			echo "SKILLID=".$row['skillID'];
			$database->query('SELECT userID FROM skills WHERE skillID = :skillID');
			$database->bind(':skillID', $row['skillID']);
			$skill = $database->single();

			echo " | USERID=".$skill['userID']."<br />";

			$database->query('UPDATE sub_skills SET userID = :userID WHERE skillID = :skillID');
			$database->bind(':skillID', $row['skillID']);
			$database->bind(':userID', $skill['userID']);
			$database->execute();
			
		}
	
	echo "FINISH";
}
*/
?>