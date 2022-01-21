<?php
require_once('mysqldb.class.php');	
require_once('utilities.class.php');	
require_once('employee.class.php');	

class Product {
		
	function get_specific_product_list() {
		
		$employee = new Employee($_SESSION['userID']);
		
		$employee_data = $employee->get_employee_data();
		$skill_array = $employee_data['skills']['skills'];

		$skill_test_array = array();
		$FOH_array = array('FOH', 'Server', 'Bartender', 'Host');
		$BOH_array = array('BOH', 'Kitchen', 'Bus');
				
		foreach($skill_array as $row) {
			$skill_test_array[] = $row['skill'];
		}

		$question_type = "NA";		
		$member_broad_skills = array();
		
		 if(count(array_intersect($skill_test_array, $FOH_array)) > 0){
		 	$member_broad_skills[] = "FOH";
 		}
 		
 		 if(count(array_intersect($skill_test_array, $BOH_array)) > 0){
		 	$member_broad_skills[] = "BOH";
 		}
		
		if (in_array("Manager", $skill_test_array)) {
		 	$member_broad_skills[] = "MGMT";
		}

		if (count($member_broad_skills) == 0) {
			//display page to encourage them to add skills
			$display = array("condition" => "none", "question_data" => "NA", "products" =>"NA");												
		} else {
			//get last action
			date_default_timezone_set('America/Los_Angeles');		
			$current_date =  date('Y-m-d');			
			
			$database = new Database;
			$database->query('SELECT date(date) as last_date FROM amazon_results WHERE userID = :userID ORDER BY last_date DESC LIMIT 1');
			$database->bind(':userID', $_SESSION['userID']);
			$result = $database->resultset();

			//test date to make sure page should be shown
			if (count($result) == 0) {
				$test = true;
			} else {
				foreach($result as $row) {
					$last_date = $row['last_date'];
				}

				if ($current_date > $last_date) {
					$test = true;
				} else {
					$test = false;
				}
			}
			
			
			if ($test == true) {
				$database = new Database;

				//get last entry
				$database->query('SELECT * FROM amazon_results WHERE userID = :userID ORDER BY date DESC LIMIT 1');
				$database->bind(':userID', $_SESSION['userID']);
				$result = $database->resultset();	

				$last_questionID = 0;
				if (count($result) > 0) {
					foreach($result as $row) {
						$last_questionID = $row['questionID'];
					}
				}				
				
				//get batch of questionIDs based on user skills
				$question_array = array();

				foreach($member_broad_skills as $skill) {				
					$database->query('SELECT amazon_questions.questionID FROM amazon_questions, amazon_question_type
													 WHERE amazon_questions.questionID != :questionID
													 AND amazon_questions.questionID = amazon_question_type.questionID 
													 AND amazon_question_type.type = :type');
					$database->bind(':questionID', $last_questionID);
					$database->bind(':type', $skill);
					$result = $database->resultset();	

					foreach($result as $row) {
						$question_array[] = $row['questionID'];
					} 
				}
								
				//get a random questionID from the array, then test to see if the user has already ranked all products from the question

				$total_count = count($question_array);
				$count = 1;

				while ($count <= $total_count) {
					//test to see if all elements have been removed from array
					if (count($question_array) > 0) {
						//shuffle array
						shuffle($question_array);
						
						//get the first item
						$new_questionID = $question_array[0];
						
						//test the question to see if there are any products left to rank
						$database->query('SELECT * FROM amazon_products, amazon_product_question
														WHERE amazon_product_question.questionID = :questionID
														AND amazon_products.productID = amazon_product_question.productID');
						$database->bind(':questionID', $new_questionID);
						$product_array = $database->resultset();	
						
						$database->query('SELECT * FROM amazon_results
														WHERE questionID = :questionID
														AND userID = :userID');
						$database->bind(':questionID', $new_questionID);
						$database->bind(':userID', $_SESSION['userID']);
						$result_array = $database->resultset();
						
						if (count($result_array) == count($product_array)) {
							//remove question and restart the loop
							unset($question_array[0]);
							//$test = true;
							$count++;
						} else {														
							$condition = "products";
							$count = $total_count;
							break;						
						}							
							
					} else {
						//out of questions condition
						$condition = "none";
						$question_data = "NA";
						$product_list = "NA";
						
						$count = $total_count;		
						break;				
					}				
				} //END WHILE LOOP
			} else {
				//comeback tomorrow condition
				$condition = "date";
				$question_data = "NA";
				$product_list = "NA";
			}		

			if ($condition == "products") {
				$database = new Database;

				$database->query('SELECT * FROM amazon_questions WHERE questionID = :questionID');
				$database->bind(':questionID', $new_questionID);
				$question_data = $database->single();	

				$product_list = $this->create_product_list($product_array, $result_array);	
				
				//get question type
				$database->query('SELECT * FROM amazon_question_type WHERE questionID = :questionID');
				$database->bind(':questionID', $new_questionID);
				$type_array = $database->resultset();
				
				$question_type = "NA";
				shuffle($type_array);
				foreach($type_array as $type) {
					if (in_array($type['type'], $member_broad_skills)) {
						$question_type = $type['type'];
					}
				}	
							
			}
			
			$display = array("condition" => $condition, "question_data" =>$question_data, "question_type" => $question_type, "products" => $product_list);												
		}	
		
		return $display;
	}
	
	function create_product_list($product_array, $result_array) {
		if (count($result_array) > 0) {
			//analyze the results, find the highest rank
			$highest_rank = 0;
			$highest_productID = 0;
			foreach($result_array as $row) {
				
				if ($row['product_result'] > $highest_rank) {
						foreach($product_array as $key=>$product) {
							if ($product['productID'] == $row['productID']) {
								unset($product_array[$key]);
								//set new highest rank
								$highest_rank = $row['product_result'];
								$highest_productID = $product['productID'];
								$highest_details = $product;
								$highest_date= $row['date'];
							}
						}
				} else {
					foreach($product_array as $key=>$product) {
						if ($product['productID'] == $row['productID']) {
							unset($product_array[$key]);
						}
					}				
				}
			}
		}

		//create 3 products (or two if only two are left) to show to user
		$display_products = array();

		$product_count = 0;		
		if ($highest_productID > 0 && $highest_rank > 0) {
			$display_products['highest']['details'] = $highest_details;
			$display_products['highest']['date'] = $highest_date;
			$product_count = 1;
		} else {
			$display_products['highest']['details'] = "NA";
			$display_products['highest']['date'] = "NA";
		}

		if (count($product_array) < 3) {
			$total_count = count($product_array);
			$product_count = 0;		
		} else {
			$total_count = 3;
		}

		foreach($product_array as $row) {
			if ($product_count < $total_count) {
				$display_products['list'][] = $row;			
			}
			$product_count++;			
		}
		
		return $display_products;
	}
	
	function get_random_product_list() {
		$database = new Database;

		$database->query('SELECT productID FROM amazon_products ');
		$result = $database->resultset();
		
		$flat_result = array();
		foreach($result as $row) {
			$flat_result[] = $row['productID'];
		}
				
		shuffle($flat_result);
		
		$product[0] = $flat_result[0];
		$product[1] = $flat_result[1];
		$product[2] = $flat_result[2];
		
		foreach($product as $row) {
			$database->query('SELECT * FROM amazon_products WHERE productID = :productID');
			$database->bind(':productID', $row);			
			$result = $database->resultset();
			
			if (count($result) > 0) {
				foreach($result as $row_2) {
					$product_array[] = $row_2;
				}
			} else {
				$product_array[] = "NA";
			}
		}	
	
		return $product_array;	
	}
	
	function rank_products($questionID, $ranked_product, $other_products) {	
		$database = new Database;
		
		$comparisonID = "NA";			
				
		if ($ranked_product != "NA") {
			//add product to ranking list or increase ranking
			
			$database->query('SELECT productID, comparisonID, product_result FROM amazon_results WHERE userID = :userID 
										AND productID = :productID');
			$database->bind(':userID', $_SESSION['userID']);
			$database->bind(':productID', $ranked_product);
			$result = $database->resultset();	

			if (count($result) > 0) {
				//increase rank
				foreach($result as $row) {
					$product_result = $row['product_result'] + 1;
				}

				$database->query('UPDATE amazon_results SET product_result = :product_result , date = NOW()
												WHERE productID = :productID
												AND userID = :userID');
				$database->bind(':userID', $_SESSION['userID']);
				$database->bind(':productID', $ranked_product);
				$database->bind(':product_result', $product_result);
				$database->execute();	
			} else {				
				//get an ID for comparison, so that all products have the same comparison ID for later data
				$database->query('SELECT MAX(comparisonID) as maxID FROM amazon_results');
				$result = $database->single();	

				$comparisonID = $result['maxID'] + 1;

				$database->query('INSERT INTO amazon_results (userID, productID, comparisonID, questionID, product_result, date)
												VALUES (:userID, :productID, :comparisonID, :questionID, :product_result, NOW())');
				$database->bind(':userID', $_SESSION['userID']);
				$database->bind(':productID', $ranked_product);
				$database->bind(':comparisonID', $comparisonID);
				$database->bind(':questionID', $questionID);
				$database->bind(':product_result', '1');
				$database->execute();	
			}
		} 		

		//insert the rest of the items in
		if ($comparisonID == "NA") {
			$database->query('SELECT MAX(comparisonID) as maxID FROM amazon_results');
			$result = $database->single();	

			$comparisonID = $result['maxID'] + 1;
		}

		foreach($other_products as $row) {
			if ($row != "NA") {
				$database->query('INSERT INTO amazon_results (userID, productID, comparisonID, questionID, product_result, date)
												VALUES (:userID, :productID, :comparisonID, :questionID, :product_result, NOW())');
				$database->bind(':userID', $_SESSION['userID']);
				$database->bind(':productID', $row);
				$database->bind(':comparisonID', $comparisonID);
				$database->bind(':questionID', $questionID);
				$database->bind(':product_result', '0');
				$database->execute();					
			}
		}	
	}
	
	function viewed_products($questionID, $other_products) {
			$database = new Database;

			$database->query('INSERT INTO amazon_views (userID, questionID, item_1_ID, item_2_ID, item_3_ID, date)
											VALUES (:userID, :questionID, :product_one, :product_two, :product_three, NOW())');
			$database->bind(':userID', $_SESSION['userID']);
			$database->bind(':questionID', $questionID);
			$database->bind(':product_one', $other_products[0]);
			$database->bind(':product_two', $other_products[1]);
			$database->bind(':product_three', $other_products[2]);
			$database->execute();					
	}
	
	function get_product_ranking($productID) {
		$database = new Database;

		$database->query('SELECT DISTINCT comparisonID FROM amazon_results WHERE productID = :productID');
		$database->bind(':productID', $productID);
		$comparison_result = $database->resultset();

		$database->query('SELECT product_result FROM amazon_results WHERE product_result > 0 AND productID = :productID');
		$database->bind(':productID', $productID);
		$product_result = $database->resultset();
		
		$result_total = 0;
		if (count($product_result) > 0 && count($comparison_result) > 0) {
			foreach($product_result as $row) {
				$result_total = $result_total + $row['product_result'];
			}

			$comparison_count = count($comparison_result);
			$count_result = $result_total / $comparison_count;
			if ($count_result > 1) {
				$percentage_result = 100;
			} else {		
				$rounded = round($count_result, 2);
				$percentage_result = $rounded * 100;
			}
		} else {
			$percentage_result = 0;
		}
	
		return $percentage_result;	
	}
	
	function get_product_badge_status() {
		//get current badge status
		$database = new Database;
		
		$database->query('SELECT DISTINCT comparisonID FROM amazon_results WHERE userID = :userID');
		$database->bind(':userID', $_SESSION['userID']);
		$result = $database->resultset();
		
		$count = count($result);
		
		$badge = "None";
		
		if ($count >= 5) {
			$badge = "Bronze";
		}	
		
		if ($count >= 12) {
			$badge = "Silver";
		}	
		
		if ($count >= 25) {
			$badge = "Gold";
		}	
		
		$bronze_distance = $silver_distance = $gold_distance = "NA";
		switch($badge) {
			case "None":
				$bronze_distance = 5 - $count;
				$silver_distance = 12 - $count;
				$gold_distance = 25 - $count;				
			break; 
			
			case "Bronze":
				$silver_distance = 12 - $count;
				$gold_distance = 25 - $count;				
			break; 

			case "Silver":
				$gold_distance = 25 - $count;				
			break; 			
		}	
	
		$product_badge_details = array("count" => $count, "badge" => $badge, "bronze_distance" => $bronze_distance, "silver_distance" => $silver_distance, "gold_distance" => $gold_distance);
		
		return $product_badge_details;
	}
	
	function get_top_products($type) {
		$database = new Database;
		
		$database->query('SELECT amazon_products.productID, amazon_results.product_result 
							FROM amazon_results, amazon_products, amazon_product_question, amazon_question_type 
							WHERE amazon_results.product_result > 0
							AND amazon_results.productID = amazon_products.productID
							AND amazon_products.productID = amazon_product_question.productID
							AND amazon_product_question.questionID = amazon_question_type.questionID
							AND amazon_question_type.type = :question_type');
		$database->bind(':question_type', $type);
		$result = $database->resultset();

		if (count($result) > 0) {
			$productID_array = array();
			foreach($result as $row) {
				if (!in_array($row['productID'], $productID_array)) {
					$productID_array[] = $row['productID'];
				}
			}
			
			$product_associative_array = array();
			foreach($productID_array as $productID) {
				$product_associative_array[$productID] = 0;
			}
			
			foreach($product_associative_array as $key=>$product) {
				foreach($result as $row) {
					if ($key == $row['productID']) {
						$product_associative_array[$key] = $product_associative_array[$key] + $row['product_result'];
					}
				}	
			}

			//sort the array
					
			asort($product_associative_array);
			
			if (count($product_associative_array)) {			
				$threeHighest = array_slice($product_associative_array, -3, null, true);
				$threeHighestKeys = array_keys($threeHighest);
			} else {
				$threeHighestKeys = array_keys($product_associative_array);
			}
						
			//get the details
			$result_array = array();
			foreach($threeHighestKeys as $key) {
				$database->query('SELECT * FROM amazon_products WHERE productID = :productID');
				$database->bind(':productID', $key);
				$result = $database->single();
				$result_array[] = $result;
			}
		} else {
			$result_array = "NA";
		}

		return $result_array;
	}
}	



?>