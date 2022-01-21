<?php

function product_display($question, $question_type, $question_type_text, $lead_product, $lead_product_date, $product_list, $product_badge_status, $ranking_array) { 

	echo "<div id='product_holder' style='float:left; width:100%;'>";

		echo "<div style='float:left; width:96.5%; padding-left:3.5%'>";		
			echo "<h2 style='margin-bottom:10px; margin-top:10px; color:black'>We need your opinion.</h2>";
				if ($question_type != "NA") {
					echo "<b>Because of your experience in ".$question_type_text.", we'd like to know what you think.</b><br><br>";
				}	
		echo "</div>";

		echo "<div style='float:left; width:100%; background-color:#e9e6de; padding-top:8px; padding-bottom:8px; padding-left:3.5%; padding-right:3.5%'><b>Badge: ".$product_badge_status['badge']."</b> ";

			if ($product_badge_status['badge'] == "None") {
				echo "<i>Rate ".$product_badge_status['bronze_distance']." more items for the <a href='#' id='learn_more'>next badge</a>.</i><br />";
			} elseif ($product_badge_status['badge'] == "Bronze" || $product_badge_status['badge'] == "None") {
					echo "<i>Rate ".$product_badge_status['silver_distance']." more items for the <a href='#' id='learn_more'>next badge</a>.</i><br />";
			} elseif ($product_badge_status['badge'] == "Silver" || $product_badge_status['badge'] == "Bronze" || $product_badge_status['badge'] == "None") {
					echo "<i>Rate ".$product_badge_status['gold_distance']." more items for the <a href='#' id='learn_more'>next badge</a>.</i><br />";
			}

		echo "</div>";
			
		echo "<div style='float:left; width:100%;'>";
			
			echo "<div style='float:left; width: 93%; padding-left: 3.5%; padding-right:3.5%; padding-top:12px; padding-bottom:12px; background-color:#8e080b; color: white; font-size:18px'>".$question['question']."</div>";
				echo "<p style='padding-left:3.5%; padding-right:3.5%'><i>Click an image or product name to learn more about each product.</i></p>";	
			echo "</div>";
			
			echo "<div style='float:left; width:96.5%; padding-left:3.5%;'>";

				//if we have a lead product, show it first
				if ($lead_product != "NA") {
					echo "<div style='float:left; width:100%; margin-top:12px; min-height:110px; position:relative; border-style: solid; border-width: 1px; border-color:#2E6652; border-radius: 5px 0 0 5px'>";
						echo "<div style='float:left; width:40%; text-align:center;position:relative; top:60px'>";
							echo "<div class='amazon_image'>".$lead_product['image_link']."</div><br />";
						echo "</div>";
	
						echo "<div class='badge_header'>".$lead_product['text_link']."</div>";
						echo "<div style='float:right; width:57%'><b>Previously, you told us you liked this product. Is it better than the products below?</b></div>";					
							echo "<div style='float:right; width:57%; margin-top:32px; font-size:12px'>".$ranking_array[$lead_product['productID']]."% ranked this as one of the best products.</div>";				

					echo "</div>";			
									
					echo "<div class='green_button rank_product' style='width:40%;' id='".$lead_product['productID']."'>";
						  echo "<img src='images/savegreen.png'  style='width:25px;height:25px;vertical-align:middle;'>";
						  echo "<span style='margin-left:8px; vertical-align: middle; font-size:14px'>This one is better!</span>";
					echo "</div>";
				}
			
				foreach($product_list as $row) {
					echo "<div style='float:left; width:100%; margin-top:12px; position:relative; border-style: solid; border-width: 1px; border-color:#2E6652; border-radius: 5px 0 0 5px'>";
						echo "<div style='float:left; width:40%; text-align:center; min-height:120px;position:relative'>";
							echo "<div class='amazon_image'>".$row['image_link']."</div><br />";
						echo "</div>";
	
						echo "<div class='badge_header'>".$row['text_link']."</div>";
						
						if ($product_badge_status['badge'] == "Gold" || $product_badge_status['badge'] == "Silver") {
							echo "<div style='float:right; width:57%; margin-top:32px; font-size:12px'>".$ranking_array[$row['productID']]."% ranked this as one of the best products.</div>";				
						} else {
							echo "<div style='float:right; width:57%; margin-top:32px; font-size:12px'><i>Unlock Silver Badge to see what other users think of this product.</i></div>";							
						}				
					echo "</div>";			
	
					echo "<div class='green_button rank_product' style='width:40%;' id='".$row['productID']."'>";
						  echo "<img src='images/savegreen.png'  style='width:25px;height:25px;vertical-align:middle;'>";
						  echo "<span style='margin-left:8px; vertical-align: middle; font-size:14px'>This one!</span>";
					echo "</div>";
				}
				echo "</div>";
			
		echo "<div style='float:left; width:100%; margin-top:25px;'>";
			if ($product_badge_status['badge'] != "None") {
				echo "<a href='products.php?page=top&type=".$question_type."'><div class='take_me_back_bar' style='background-color:#628c7e;text-align:center; margin-top:8px'>";
					echo "View top ".$question_type_text." products. <img src='images/whitearrowforward.png' style='height:44px; vertical-align:middle;'>";
				echo "</div></a>";
			}
			
			echo "<a href='#' class='rank_product' id='NA'><div class='take_me_back_bar' style='margin-top:-10px;'>";
				echo "<img src='images/whitearrowback.png' style='height:44px; vertical-align:middle;'>I'm not familiar with these products.</div></a>";
			echo "</div>";
			
			if ($product_badge_status['badge'] == "None") {
				echo "<div style='text-align:center;'><h3>Unlock the Bronze Badge to view top rated products!</h3></div>";
			}
	echo "</div>";		
}

function thank_you_page($new_badge_count, $product_badge_status, $skill, $skill_text) {
	echo "<div style='float:left; width:100%;'>";

	switch($new_badge_count) {
		default:
		
			echo "<div style='float:left; width:96.5%; margin-left:7px;'>";		
				echo "<h2 style='margin-bottom:10px; margin-top:10px; color:black'>Thanks for your opinion!</h2>";
				echo "<h3>Come back tomorrow to rate another set of products</h3>";
				
				if ($product_badge_status['badge'] == "None") {
					echo "<h4><i>Rate ".$product_badge_status['bronze_distance']." more items to unlock the next badge.</i></h4><br />";
				} elseif ($product_badge_status['badge'] == "Bronze" || $product_badge_status['badge'] == "None") {
						echo "<i>Rate ".$product_badge_status['silver_distance']." more items to unlock the next badge.</i><br />";
				} elseif ($product_badge_status['badge'] == "Silver" || $product_badge_status['badge'] == "Bronze" || $product_badge_status['badge'] == "None") {
						echo "<i>Rate ".$product_badge_status['gold_distance']." more items to unlock the next badge.</i><br />";
				}
			echo  "</div>";
			
		break;
		
		case "5":
			echo "<div style='float:left; width:96.5%; padding-left:3.5%; margin-top:10px;'>";	
				echo "<div style='float:left; width:100%; text-align:center;'><img src='images/productbronze.png' height='100px' alt='bronzebadge'></div>";			
				echo "<h2 style='margin-bottom:10px; margin-top:10px; color:black'>Congratulations, you've unlocked a Bronze Badge!</h2>";
				echo "<h3>You can now view top ranked products.</h3>";
				
				echo "<a href='products.php?page=top&type=".$skill."'>View top ".$skill_text." products now</a><br />";
				
				echo "<i>Come back tomorrow to rank more products!</i>";
			echo "</div>";
		break;
		
		case "12":
			echo "<div style='float:left; width:96.5%; padding-left:3.5%; margin-top:10px;'>";	
				echo "<div style='float:left; width:100%; text-align:center;'><img src='images/productsilver.png' height='100px' alt='silverbadge'></div>";			
				echo "<h2 style='margin-bottom:10px; margin-top:10px; color:black'>Congratulations, you've unlocked a Silver Badge!</h2>";
				echo "<h3>You can now view how other people users ranked products.</h3>";
				
				echo "<i>Come back tomorrow to rank more products!</i>";
			echo "</div>";
		break;	
		
		case "25":
			echo "<div style='float:left; width:96.5%; padding-left:3.5%; margin-top:10px;'>";	
				echo "<div style='float:left; width:100%; text-align:center;'><img src='images/productgold.png' height='100px' alt='goldbadge'></div>";			
				echo "<h2 style='margin-bottom:10px; margin-top:10px; color:black'>Congratulations, you've unlocked a Gold Badge!</h2>";
				
				echo "<i>Come back tomorrow to rank more products!</i>";
			echo "</div>";
		break;			
	}
	
	echo "</div>";
}

function product_badge_descriptions($product_badge_status) {
	echo "<div id='description_holder' style='float:left; width:100%; margin-top:10px; display:none;'>";
	
		echo "<a href='#' class='hide_more' id='NA'><div class='take_me_back_bar' style='margin-top:-10px;'>";
			echo "<img src='images/whitearrowback.png' style='height:44px; vertical-align:middle;'>BACK TO PRODUCTS";
		echo "</div></a>";

		echo "<div style='float:left; width:98%; margin-left:5px; margin-right:3px;'>";
			echo"<h4>Earn badges by giving us your expert opinion on industry products!</h4>";
	
			if ($product_badge_status['badge'] == "None") {
				echo "<h4>Rate ".$product_badge_status['bronze_distance']." more items for the next badge.!</h4>";
			} elseif ($product_badge_status['badge'] == "Bronze" || $product_badge_status['badge'] == "None") {
				echo "<h4>Rate ".$product_badge_status['silver_distance']." more items for the next badge!</h4>";
			} elseif ($product_badge_status['badge'] == "Silver" || $product_badge_status['badge'] == "Bronze" || $product_badge_status['badge'] == "None") {
				echo "<h4>Rate ".$product_badge_status['gold_distance']." more items for the next badge!</h4>";
			}
			
			echo "&nbsp; <img src='images/productbronze.png' height='50px' alt='bronzebadge'> &nbsp; &nbsp; <h3 style='display:inline'>Bronze Badge</h3><br />";
			echo "<div style='float:left; width:100%; margin-left:15px; margin-bottom:10px;'>";
				echo "<b>Rate 5 products and unlock this badge.</b> <br />The Bronze Badge allows you to view the top 3 rated products at any time.<br />";
			echo "</div>";
			
			echo "&nbsp; <img src='images/productsilver.png' height='50px' alt='silverbadge'> &nbsp; &nbsp; <h3 style='display:inline'>Silver Badge</h3><br />";
			echo "<div style='float:left; width:100%; margin-left:15px; margin-bottom:10px;'>";
				echo "<b>Rate 12 products and unlock this badge.</b>  <br />The Silver Badge allows you to see how your colleagues rank each individual product.<br />";
			echo "</div>";
	
			echo "&nbsp; <img src='images/productgold.png' height='50px' alt='goldbadge'> &nbsp; &nbsp; <h3 style='display:inline'>Gold Badge</h3><br />";
			echo "<div style='float:left; width:100%; margin-left:15px; margin-bottom:15px;'>";
				echo "<b>Rate 25 products and unlock this badge.</b>  <br />???? This badge is a mystery!<br />";
			echo "</div>";
		
			
			echo "<b>Only one set of products per day, so be sure to come back often</b><br />";
		echo "</div>";

	echo "</div>";
}

function product_random_display($product_array) { 
	
	echo "<div id='product_holder' style='float:left; width:100%;'>";

		echo "<div style='float:left; width:96.5%; padding-left:3.5%'>";		
			echo "<h2 style='margin-bottom:10px; margin-top:10px; color:black'><a href='http://servebartendcook.com'>Find Great Hospitality Jobs!</a></h2>";
			
			echo "<h3>Check out some industry related products below</h3>";
			
			foreach($product_array as $row) {
				
				echo "<div style='float:left; width:100%; margin-top:12px; position:relative; border-style: solid; border-width: 1px; border-color:#2E6652; border-radius: 5px 0 0 5px'>";
				
					echo "<div style='float:left; width:40%; min-height:120px; position:relative'>";
					
					if ($row != "NA") {
						echo "<div class='amazon_image'>".$row['image_link']."</div><br />";
						
					echo "</div>";
						
					echo "<div class='badge_header'>".$row['text_link']."</div>";
					
					echo "<div style='float:right; width:57%; margin-top:12px; font-size:18px'></div>";
										
				echo "</div>";			
							
				}	
			}	
			echo "<div style='float:left; margin-top:20px; margin-bottom:20px; font-size:18px'>Want to find a job in the hospitality industry? <a href='http://www.servebartendcook.com'>Create a free profile on ServeBartendCook</a> and find job opportunities in minutes.</div>";			

		echo "</div>";

	echo "</div>";
}

function product_tomorrow_display() { 
	echo "<div style='float:left; width:100%; margin-left:5px; margin-right:5px;'>";
			
		echo "<h2 style='margin-bottom:10px; margin-top:10px; color:black; text-align:center;'>Earn Badges</h2>";
		echo "<strong>You've ranked the maximum amount of products for the day.</strong><br /> &nbsp; <br />";
		echo "<i>Come back tomorrow to rank more products!</i>";
				
	echo "</div>";
}

function product_none_display() { 
	echo "<div style='float:left; width:100%; margin-left:5px; margin-right:5px;'>";
			
		echo "<h2 style='margin-bottom:10px; margin-top:10px; color:black; text-align:center;'>Earn Badges</h2>";
		echo "<i><strong>There are no products currently available for you to rank.</strong></i><br />";
		echo "<i>Please check back another time.</i>";
				
	echo "</div>";
}

function top_product_display($type, $product_list) { 
	echo "<div id='product_holder' style='style='float:left; width:96.5%; padding-left:3.5%''>";
		
		echo "<h3>These are the current top ".$type." products.</h3>";
		echo "<i>These rankings change as more users vote.</i><br />";				
												
			foreach($product_list as $row) {
				echo "<div style='float:left; width:100%; margin-top:12px; min-height:120px; position:relative; border-style: solid; border-width: 1px; border-color:#2E6652; border-radius: 5px 0 0 5px'>";
					echo "<div style='float:left; width:40%; text-align:center; position:relative; top:56px'>";
						echo "<div class='amazon_image'>".$row['image_link']."</div><br />";
					echo "</div>";
					echo "<div class='badge_header'>".$row['text_link']."</div>";
				echo "</div>";			
			}
	echo "</div>";
}

?>