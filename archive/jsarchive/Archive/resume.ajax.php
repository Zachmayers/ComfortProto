<?php

//CHANGE FOR LIVE SITE
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/utilities.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/employee.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/opportunity.class.php');

	$utilities = new Utilities;
	$site_type	 = $utilities->site_type;
	
	session_start();
	
	if ($site_type == "prototype") {
		ini_set('display_errors',1);
		error_reporting(E_ALL|E_STRICT); 
	} 
	
	$type = $_GET['type'];
	
	$member = new Member("temp");
	
	switch($_GET['type']) {	
	
		case "add_resume":
			$ID = $_POST['jobID'];

			$firstname = trim($_POST['first_name']);
			$lastname = trim($_POST['last_name']);
			$phone = trim($_POST['phone']);
			$email = trim($_POST['email']);	
			$experience = trim($_POST['experience']);	

			$questionID_1 = $_POST['questionID_1'];
			$answer_1 = trim($_POST['answer_1']);		
			$questionID_2 = $_POST['questionID_2'];
			$answer_2 = trim($_POST['answer_2']);								
			$questionID_3 = $_POST['questionID_3'];
			$answer_3 = trim($_POST['answer_3']);	
			
			$member_update_array = array("firstname" => $firstname, "lastname" =>$lastname, "email" => $email, "contact_phone" => $phone);
			$tempID = $member->update_public_resume($member_update_array);	
			$_SESSION['tempID'] = $tempID;
			
			///update experience							
			$total = trim($experience);
			$hospitality = trim($experience);
			
			$employee = new Employee($tempID);
			$employee->overwrite_experience($total, $hospitality);
			
			$input_array = array("interest"=>"Y", 
											"questionID_1"=>$questionID_1, "answer_1"=>$answer_1,
											"questionID_2"=>$questionID_2, "answer_2"=>$answer_2,
											"questionID_3"=>$questionID_3, "answer_3"=>$answer_3);
								
			$opportunity = new Opportunity($ID);			
			$test = $opportunity->update_opportunity('temp', $input_array); //add
			
			echo $_SESSION['tempID'];
		break;	
		
	} 
?>