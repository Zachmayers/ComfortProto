<?php
	function ad_data_html($ad_data) {	

		$region_array = $ad_data['regions'];
		$details_array = $ad_data['details'];
	
		echo "<h2>Regions</h2>";
		if (count($region_array) > 0) {
			foreach($region_array as $row) {
				echo "<b>Region:</b>  ".$row['region_name']."<br />";
				echo "<b>Zip Code:</b>  ".$row['region_zip']."<br />";
				echo "<b>Views:</b>  ".$row['views']."<br />";
				echo "<hr><br />";
			}
		} else {
			echo "No advertising regions, please add one.<br /> &nbsp; <br />";
		}
		
		echo "New Region Name <input id='region'><br />";
		echo "Region Zip <input id='zip'><br />";
		echo "Pass <input id='region_pass'><br />";
		echo "<a href='#' id='submit_region'>Add Region</a><br />";
		
		echo "<div id='region_warning' style='color:red; display:none'>In valid zip</div>";
		
		
		echo "<br />&nbsp; <br />";
		echo "<h2>ADS</h2>";
		if (count($region_array) > 0) {
			foreach($region_array as $region) {
				echo "<h3>".$region['region']." - ".$region['zip']."</h3>";
				foreach($details_array as $row) {
					if($row['regionID'] == $region['regionID'] ) {
						
						echo "<img src='".$row['ad_photo']."'><br />";
						echo "<a href='".$row['ad_link']."'>".$row['ad_title']."</a><br />";
						echo $row['ad_text']."<br />";
						echo $row['deal']."<br />";						
						echo "<a href='#' class='remove_ad' id='".$row['adID']."'>REMOVE AD</a>";
						echo "<br />&nbsp; <br />";
					}
				}
				echo "&nbsp; <br />";
				echo "Add new advertisement <br />";
				echo "REGION:  ";
				echo "<select id='regionID'>";
					foreach($region_array as $row) {
						echo "<option value='".$row['regionID']."'>".$row['region_name']."</option>";						
					}
				echo "</select><br />";
				echo "Ad Type:  ";
				echo "<select id='ad_type'>";
						echo "<option value='amazon'>amazon</option>";						
				echo "</select><br />";				
				echo "Ad Title <input id='ad_title'><br />";
				echo "Ad Link <input id='ad_link'><br />";
				echo "Deal <input id='deal'><br />";
				echo "Photo Link <input id='photo_link'><br />";
				echo "Ad Description <textarea id='description' cols='30' rows='4'></textarea><br />";
				echo "Pass <input id='ad_pass'><br />";
				echo "<a href='#' id='submit_ad'>Submit Ad</a><br />";
				
				echo "<div id='ad_warning' style='color:red; display:none'>This region has the maximum amount of ads</div>";
				
				echo "&nbsp; <br />";				
			}
		} else {
			echo "No advertising regions, please add one";
		}
				
	}
?>