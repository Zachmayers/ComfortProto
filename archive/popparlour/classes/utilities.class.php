<?php
require_once('mysqldb.class.php');	
//require_once('employee.class.php');	

class Utilities {
/*****
	CHANGE THIS VARIABLE TO WHEN TRANSFERRING FILES TO THE LIVE SITE
*****/

	public $site_type = "prototype"; //
//	public $site_type = "live";

	public $version = "2v"; //
	
	public $languages = array("Spanish",
				"French",
				"Italian",
				"German",
				"Japanese",
				"Chinese",
				"Portuguese",
				"Korean",
				"Russian",
				"Greek",
				"Hindi",
				"Other");

	 public $states = array('AL'=>"Alabama",  
				'AK'=>"Alaska",  
				'AZ'=>"Arizona",  
				'AR'=>"Arkansas",  
				'CA'=>"California",  
				'CO'=>"Colorado",  
				'CT'=>"Connecticut",  
				'DE'=>"Delaware",  
				'DC'=>"District Of Columbia",  
				'FL'=>"Florida",  
				'GA'=>"Georgia",  
				'HI'=>"Hawaii",  
				'ID'=>"Idaho",  
				'IL'=>"Illinois",  
				'IN'=>"Indiana",  
				'IA'=>"Iowa",  
				'KS'=>"Kansas",  
				'KY'=>"Kentucky",  
				'LA'=>"Louisiana",  
				'ME'=>"Maine",  
				'MD'=>"Maryland",  
				'MA'=>"Massachusetts",  
				'MI'=>"Michigan",  
				'MN'=>"Minnesota",  
				'MS'=>"Mississippi",  
				'MO'=>"Missouri",  
				'MT'=>"Montana",
				'NE'=>"Nebraska",
				'NV'=>"Nevada",
				'NH'=>"New Hampshire",
				'NJ'=>"New Jersey",
				'NM'=>"New Mexico",
				'NY'=>"New York",
				'NC'=>"North Carolina",
				'ND'=>"North Dakota",
				'OH'=>"Ohio",  
				'OK'=>"Oklahoma",  
				'OR'=>"Oregon",  
				'PA'=>"Pennsylvania",
				'PR'=>"Puerto Rico",  
				'RI'=>"Rhode Island",  
				'SC'=>"South Carolina",  
				'SD'=>"South Dakota",
				'TN'=>"Tennessee",  
				'TX'=>"Texas",  
				'UT'=>"Utah",  
				'VT'=>"Vermont",  
				'VA'=>"Virginia",  
				'WA'=>"Washington",  
				'WV'=>"West Virginia",  
				'WI'=>"Wisconsin",  
				'WY'=>"Wyoming");
				
	public $main_skills = array("Manager",
						"Server",
						"Bartender",
						"Kitchen",
						"Host",
						"Bus");
						
	public $management_skills = array(
						"Assistant Manager",
						"Bar Manager",
						"General Manager",
						"Key Holder",
						"Kitchen Manager",
						"Shift Leader"
						);						
	
	public $server_skills = array(
						"Barista",
						"Bottle Service",
						"Casual Dining",
						"Cicerone",
						"Charcuterie Knowledge",
						"Craft Beer Knowledge",
						"Fine Dining",
						"Head Server",
						"Maitre Fromager",
						"Regional Cuisine Knowledge",
						"Shift Leader",
						"Sommelier",
						"Specialty Food Knowledge",
						"Wine Knowledge"
						);
						
	public $bar_skills = array(
						"Bar Manager",
						"Barista",						
						"Beer and Wine",
						"Cicerone",
						"Classic Cocktails",
						"Flair Bartending",
						"High Volume",
						"Molecular Mixology",
						"Sommelier"
						);

	public $kitchen_skills = array(
						"Broiler",
						"Brick Oven",
						"Casual Dining",
						"Classically Trained",
						"Charcutier",
						"Fast Food",
						"Fine Dining",
						"Fry",
						"Grill",
						"Head Chef",
						"Kitchen Manager",
						"Kosher",					
						"Line Cook",
						"Molecular Gastronomy",
						"Pastry",
						"Pizza",
						"Regional Cuisine",
						"Sushi",
						"Sous-Chef",
						"Vegan/Vegetarian");	
						
	public $host_skills = array(
						"Cashier",
						"Casual Dining",
						"Coat Check",
						"Fine Dining",
						"Front Desk",
						"Host",
						"Valet");
						
	public $bus_skills = array(
						"Bus",
						"Casual Dining",
						"Fine Dining",
						"Food Runner",
						"Server Assistant"
						);								
						
	public $store_types = array(
					"Beer Bar",
					"Bistro",
					"Brew House",					
					"Cafe",
					"Casual Bar",					
					"Casual Dining",
					"Catering Company",
					"Cocktail Bar",
					"Diner",
					"Dive Bar",					
					"Fine Dining",
					"Food Truck",
					"Gastropub",
					"Irish Pub",
					"Nightclub",
					"Personal Chef",
					"Resort",					
					"Steakhouse",
					"Sushi Bar/Restaurant",
					"Wine and Beer",
					"Wine Bar",
					"Other");	
					
	public $certifications = array(
					"ServSafe",
					"TIPS",
					"Sommelier Level 1",
					"Sommelier Level 2",
					"Sommelier Level 3",
					"Master Sommelier",
					"Certified Beer Server",
					"Certified Cicerone",
					"Master Cicerone"
	);						
									
	public $traits = array(
			'Adventurous',
			'Analytical',			
			'Committed',
			'Compassionate',
			'Cooperative',
			'Creative',
			'Dependable',
			'Determined',
			'Enthusiastic',
			'Flexible',
			'Independent',
			'Outgoing'
	);
	
	public $general_store_types = array(
			'Casual',
			'Upscale Casual',
			'Upscale',
			'Catering',
			'Nightclub'
	);

	function convert_month($number) {
		$month = "";
		
		switch($number) {
			case "1":
				$month = "Jan";
			break;
			
			case "2":
				$month = "Feb";
			break;

			case "3":
				$month = "Mar";
			break;

			case "4":
				$month = "Apr";
			break;

			case "5":
				$month = "May";
			break;

			case "6":
				$month = "June";
			break;

			case "7":
				$month = "July";
			break;

			case "8":
				$month = "Aug";
			break;

			case "9":
				$month = "Sep";
			break;

			case "10":
				$month = "Oct";
			break;
			
			case "11":
				$month = "Nov.";
			break;
			
			case "12":
				$month = "Dec";
			break;		
		}
		
		return $month;
	}

	function get_cities($state) {
		$database = new Database;
		$database->query("SELECT city FROM state_city
							WHERE state = :state
							ORDER BY city ASC");
		$database->bind(':state', $state);
		$result = $database->single();
		return $result;
	}
	
	function get_email($valid_hash) {
		$database = new Database;
		$database->query("SELECT email FROM members
									WHERE valid_hash = :valid_hash");
		$database->bind(':valid_hash', $valid_hash);
		$result = $database->single();
		return $result['email'];		
	}
	
	function in_array_r($needle, $haystack, $sort) {
		$found = false;

		foreach ($haystack as $item) {
			if ($item[$sort] == $needle) {
				$found = true;
				break;
			} elseif (is_array($item)) {
				$found = $this->in_array_r($needle, $item, $sort);
			}
		}
		return $found;
	}
	
	function sub_skill_validation($sub, $specialty) {
		$sub_array = explode(",", $sub);		

		$management_array = $this->management_skills;
		$server_array = $this->server_skills;		
		$bar_array = $this->bar_skills;
		$kitchen_array = $this->kitchen_skills;
		$bus_array = $this->bus_skills;
		$host_array = $this->host_skills;			
		
		switch($specialty) {
			case "Manager":
				$skill_list = $this->management_skills;				
			break;
			
			case "Server":
				$skill_list = $this->server_skills;				
			break;
			
			case "Bartender":
				$skill_list = $this->bar_skills;				
			break;			

			case "Kitchen":
				$skill_list = $this->kitchen_skills;				
			break;

			case "Bus":
				$skill_list = $this->bus_skills;				
			break;

			case "Host":
				$skill_list = $this->host_skills;				
			break;			
		}
		
		$sub_count = count($sub_array);
		$count = 0;
		foreach($sub_array as $row) {
			if (in_array($row, $skill_list)) {
				$count++;
			}
		}
		
		if ($sub_count == $count) {
			return "valid";
		} else {
			return "invalid";
		}

	}	
	
	function get_city_state($zip) {
		$database = new Database;
		
		$database->query("SELECT city, state FROM zcta WHERE zip = :zip");
		$database->bind(':zip', $zip);
		$result = $database->single();
		return $result;
	}
	
	function zip_validate($zip) {
		$database = new Database;
		
		$database->query("SELECT latitude FROM zcta WHERE zip = :zip");
		$database->bind(':zip', $zip);
		$result = $database->resultset();
		if (count($result) > 0) {
			return "valid";
		} else {
			return "invalid";
		}
	}
	
	function makeSafe(&$value, $key) {
	
		$value = str_replace ("&amp;", "&", $value);
		$value = str_replace ('&quot;', '"', $value);
		$value = str_replace ("&#039;", "'", $value);		
		
		$value = htmlentities($value, ENT_QUOTES, 'UTF-8'); // use htmlspecialchars() if you want

		//$value = $this->mynl2br($value);	
	
		//return $value;
	}
	
	function clickable_links($string) {
		$url = '@(http(s)?)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
		$string = preg_replace($url, '<a href="http$2://$4" target="_blank" title="$0">$0</a>', $string);
		return $string;		
	}
	
	function makeSafe_array(&$value, $key) {
	
		$value = str_replace ("&amp;", "&", $value);
		$value = str_replace ('&quot;', '"', $value);
		$value = str_replace ("&#039;", "'", $value);		
		
		$value = htmlentities($value, ENT_QUOTES, 'UTF-8'); // use htmlspecialchars() if you want
			
		//$value = $this->mynl2br($value);	
	
		//return $value;
	}	

	function makeSafe_flat($value) {
	
		$value = str_replace ("&amp;", "&", $value);
		$value = str_replace ('&quot;', '"', $value);
		$value = str_replace ("&#039;", "'", $value);		
		
		$value = htmlentities($value, ENT_QUOTES, 'UTF-8'); // use htmlspecialchars() if you want
	
		return $value;
	} 	
	
	function get_coordinates($zip) {
		$database = new Database;
		
		$database->query("SELECT latitude, longitude FROM zcta WHERE zip = :zip");
		$database->bind(':zip', $zip);
		$result = $database->single();
		return $result;
	}
		
	function distance($lat1, $lng1, $lat2, $lng2)  {
		$pi80 = M_PI / 180;
		$lat1 *= $pi80;
		$lng1 *= $pi80;
		$lat2 *= $pi80;
		$lng2 *= $pi80;
	 
		$r = 6372.797; // mean radius of Earth in km
		$dlat = $lat2 - $lat1;
		$dlng = $lng2 - $lng1;
		$a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
		$c = 2 * atan2(sqrt($a), sqrt(1 - $a));
		$km = $r * $c;
		$miles = $km * 0.621371192;
		return $miles;
	}	
	
	function mynl2br($text) { 
		return strtr($text, array("\r\n" => '<br />', "\r" => '<br />', "\n" => '<br />')); 
	}
		
	function get_photo_number() {
		$database = new Database;

		$database->query("SELECT photoID FROM photo_gallery ORDER BY photoID DESC LIMIT 1 ");
		$result = $database->resultset();
		if (count($result) > 0) {
			foreach ($result as $row) {
				$photoID = $row['photoID'];
			}
		} else {
			$photoID = 0;
		}
		$photoID = $photoID + 1;
		return $photoID;		
	}
	
	function generateRandomString($length) {
	    $characters = '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, strlen($characters) - 1)];
	    }
	    return $randomString;
	}	
	
	function ie_detect() {
		if(preg_match('/(?i)msie [6-8]/',$_SERVER['HTTP_USER_AGENT'])) {
			$_SESSION['browser'] = "low_ie";
		} else {
			    // if IE>8
			$_SESSION['browser'] = "other";			    
		}
	}
	
	function upload_photo($file_name, $temp_name, $error, $new_name, $dest) {	
				if ($error > 0) {
					echo "Problem: ";
					switch ($error) {
						case 1:  echo "File exceeded Maximum Size";
							break;
						case 2:  echo "File exceeded Maximum Size";
							break;
						case 3:  echo "File only partially uploaded";
							break;
						case 4:  echo "No file uploaded";
							break;
						case 6:  echo "Cannot upload file, no temp directory specified";
							break;
						case 7:  echo "upload failed, cannot write to disk";
							break;
					}
					exit;
				}
				
				//put the file in the proper directory
				
				$upfile = $dest.basename($file_name);

				if (is_uploaded_file($temp_name)) {
					if (move_uploaded_file($temp_name, $upfile)) {
						} else {
							echo "There was a problem uploading, please try again or contact support.";
						exit;
					}
				} else {
					echo "This type of file not allowed.";
					exit;
				}
				
				//echo "<p>File uploaded successfully<p>";
				$old_name = $dest.$file_name;
				$new_path = $dest.$new_name;
				//echo $old_name." | ".$new_name." | ".$new_path;
				rename($old_name, $new_path);
				return 0;
	}
	
	function convert_png_to_jpg($filePath) {
		$image = imagecreatefrompng($filePath);
		$bg = imagecreatetruecolor(imagesx($image), imagesy($image));
		imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
		imagealphablending($bg, TRUE);
		imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
		imagedestroy($image);
		$quality = 75; // 0 = worst / smaller file, 100 = better / bigger file 
		//truncate file name, get rid of png
		imagejpeg($bg, $filePath . ".jpg", $quality);
		ImageDestroy($bg);
		return 0;
	}
	
	function resizePic($imgSrc, $new_height, $new_width, $new_name, $dest) { 
		//if pic has already been compressed during PNG conversion, ignore
/*
		if ($resize == "Y") {
			$image = imagecreatefromjpeg($img_src);	
			$quality = 75; // 0 = worst / smaller file, 100 = better / bigger file 
			imagejpeg($image, $dest, $quality);
		}
*/
	    //getting the image dimensions 
		list($width, $height) = getimagesize($imgSrc);
	    $myImage = imagecreatefromjpeg($imgSrc);

		$ratio = $width / $height;	    
		
		if( $ratio > 1) {
		    $resized_width = 500; //suppose 500 is max width or height
		    $resized_height = 500/$ratio;
		}
		else {
		    $resized_width = 500*$ratio;
		    $resized_height = 500;
		}	   

	   
 	    //$process = imagecreatetruecolor(round($resized_width), round($resized_height));

		$resized_image = imagecreatetruecolor($resized_width, $resized_height);
		imagecopyresampled($resized_image, $myImage, 0, 0, 0, 0, $resized_width, $resized_height, $width, $height);
	
	   // imagedestroy($process);
	    imagedestroy($myImage);
		
		$destination = $dest.$new_name;
		
		imagejpeg($resized_image, $destination);
		return 0;
	}		
		
	function CroppedThumbnail($imgSrc, $thumbnail_width, $thumbnail_height, $name, $dest) { 
	    //getting the image dimensions 
	    list($width_orig, $height_orig) = getimagesize($imgSrc);  
	    $myImage = imagecreatefromjpeg($imgSrc);
	    $ratio_orig = $width_orig/$height_orig;
	   
	    if ($thumbnail_width/$thumbnail_height > $ratio_orig) {
	       $new_height = $thumbnail_width/$ratio_orig;
	       $new_width = $thumbnail_width;
	    } else {
	       $new_width = $thumbnail_height*$ratio_orig;
	       $new_height = $thumbnail_height;
	    }
	   
	    $x_mid = $new_width/2;  //horizontal middle
	    $y_mid = $new_height/2; //vertical middle
	   
	    $process = imagecreatetruecolor(round($new_width), round($new_height));
	   
	    imagecopyresampled($process, $myImage, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
	    $thumb = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
	    imagecopyresampled($thumb, $process, 0, 0, ($x_mid-($thumbnail_width/2)), ($y_mid-($thumbnail_height/2)), $thumbnail_width, $thumbnail_height, $thumbnail_width, $thumbnail_height);
	
	    imagedestroy($process);
	    imagedestroy($myImage);
		
		$destination = $dest.$name;
		imagejpeg($thumb, $destination);
		return 0;
	}
	
	function update_inventory_photo($type, $pic, $thumb) {
		$database = new Database;
		
		switch($type) {
			case "profile":
				$userID = $_SESSION['userID'];
				if ($userID != 0) {
					$database->query("UPDATE members
										SET profile_pic = :profile_pic
										WHERE userID = :userID ");
					$database->bind(':profile_pic', $pic);
					$database->bind(':userID', $userID);
					$database->execute();	
					
					$database->query("INSERT INTO photo_updates (userID, type, date)
										VALUES (:userID, :type, NOW())");
					$database->bind(':userID', $userID);
					$database->bind(':type', $type);
					$database->execute();						
				}
			break;

			case "store":
				$userID = $_SESSION['userID'];
				$storeID = $thumb; //old placeholder
				if ($userID != 0) {
					$database->query("UPDATE stores
										SET image = :profile_pic
										WHERE userID = :userID
										AND storeID = :storeID");
					$database->bind(':profile_pic', $pic);
					$database->bind(':userID', $userID);
					$database->bind(':storeID', $storeID);
					$database->execute();	
					
					$database->query("INSERT INTO photo_updates (userID, type, date)
										VALUES (:userID, :type, NOW())");
					$database->bind(':userID', $userID);
					$database->bind(':type', $type);
					$database->execute();
				}
			break;

			case "admin_store":
				$storeID = $thumb; //old placeholder
				if ($_SESSION['userID'] == "admin") {
					$database->query("UPDATE stores
										SET image = :profile_pic
										WHERE storeID = :storeID");
					$database->bind(':profile_pic', $pic);
					$database->bind(':storeID', $storeID);
					$database->execute();	
				}
			break;
			
			default:
				$userID = $_SESSION['userID'];
				if ($userID != 0) {
					$database->query("INSERT INTO photo_gallery (userID, type, photo, thumb)
										VALUES (:userID, :type, :pic, :thumb)");
					$database->bind(':pic', $pic);
					$database->bind(':userID', $userID);
					$database->bind(':type', $type);
					$database->bind(':thumb', $thumb);
					$database->execute();
					
					$database->query("INSERT INTO photo_updates (userID, type, date)
										VALUES (:userID, :type, NOW())");
					$database->bind(':userID', $userID);
					$database->bind(':type', "gallery");
					$database->execute();												
				}			
			break;
		}
	}
	
	function skill_to_image($skill) {
		//convert the skill to the proper icon by replacing spaces with underscores and adding the extension
		$skill_image = str_replace(" ", "_", $skill);
		$skill_image = $skill_image.".png";
		return $skill_image;
	}
	
	function set_user_ad_region() {
		if($_SESSION['type'] == "employer") {
			$_SESSION['regionID'] = "none";
			$_SESSION['region_name'] = "none";
		} else {
			$employee = new Employee($_SESSION['userID']);
			$employee_data = $employee->get_employee_data();
			$employee_zip = $employee_data['general']['zip'];
			
			$employee_coordinates = $this->get_coordinates($employee_zip);
			$emp_lat = $employee_coordinates['latitude'];
			$emp_long = $employee_coordinates['longitude'];
			
			$database = new Database;
			$database->query("SELECT * FROM ad_regions");
			$result = $database->resultset();
			
			$_SESSION['regionID'] = "none";
			$_SESSION['region_name'] = "none";
			
			foreach($result as $row) {
				$coordinates = $this->get_coordinates($row['region_zip']);
				$distance = $this->distance($emp_lat, $emp_long, $coordinates['latitude'], $coordinates['longitude']);
				if ($distance <= 40) {
					$_SESSION['regionID'] = $row['regionID'];
					$_SESSION['region_name'] = $row['region_name'];				
				}
			}
		}
	}
	
	function get_local_deals() {
		$database = new Database;
		$database->query("SELECT * FROM ad_details WHERE regionID = :regionID");
		$database->bind(':regionID', $_SESSION['regionID']);
		$result = $database->resultset();
		return $result;
	}
		
	function get_ad($type) {
	
		switch($type) {
			case "sidebar":
				//get random number for rotating ads
				$number = rand(0, 7);
				switch($number) {
					case "7":
						$ad_text = "<div class='alignleft'>  
							<script type='text/javascript'>
							 amzn_assoc_ad_type = 'banner';
							 amzn_assoc_tracking_id = 'servebartendcook-20';
							 amzn_assoc_marketplace = 'myhabit';
							 amzn_assoc_region = 'US';
							 amzn_assoc_placement = 'assoc_banner_placement_default';
							 amzn_assoc_campaigns = 'myhabit';
							 amzn_assoc_p = '14';
							 amzn_assoc_banner_type = 'rotating';
							 amzn_assoc_width = '160';
							 amzn_assoc_height = '600';
							</script>
							<script src='//z-na.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&Operation=GetScript&ID=OneJS&WS=1'></script>
							</div>";				
					break;
					
					case "0":
						$ad_text = "<div class='alignleft'>  
							<script type='text/javascript'>
							 amzn_assoc_ad_type = 'banner';
							 amzn_assoc_tracking_id = 'servebartendcook-20';
							 amzn_assoc_marketplace = 'amazon';
							 amzn_assoc_region = 'US';
							 amzn_assoc_placement = 'assoc_banner_placement_default';
							 amzn_assoc_campaigns = 'local';
							 amzn_assoc_p = '14';
							 amzn_assoc_banner_type = 'category';
							 amzn_assoc_isresponsive = 'false';
							 amzn_assoc_banner_id = '0ADX0B8A8ZH3HWVXT3G2';
							 amzn_assoc_width = '160';
							 amzn_assoc_height = '600';
							</script>
							<script src='//z-na.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&Operation=GetScript&ID=OneJS&WS=1'></script>
							</div>";				
					break;
					
					case "1":
						$ad_text = "<div class='alignleft'>  
							<a href='http://www.anrdoezrs.net/click-7585394-10434993' target='_top'>
							<img src='http://www.lduhtrp.net/image-7585394-10434993' width='120' height='600' alt='Get eChapters as low as $1.99!' border='0'/></a>				
							</div>";								
					break;			
					
					case "2":
						$ad_text = "<div class='alignleft'>  
							<a href='http://www.anrdoezrs.net/click-7585394-10434993' target='_top'>
							<img src='http://www.lduhtrp.net/image-7585394-10434993' width='120' height='600' alt='Get eChapters as low as $1.99!' border='0'/></a>				
							</div>";								
					break;
					
					case "3":
						$ad_text = "<div class='alignleft'>  
							<a href='http://www.tkqlhce.com/click-7585394-11729884' target='_top'>
							<img src='http://www.lduhtrp.net/image-7585394-11729884' width='120' height='600' alt='CraftBeerClub.com-Beer Club Gifts-120x90 banner  ' border='0'/></a>
							</div>";								
					break;
					
					case "4":
						$ad_text = "<div class='alignleft'>  
							<a href='http://www.dpbolvw.net/click-7585394-11010337' target='_top'>
							<img src='http://www.tqlkg.com/image-7585394-11010337' width='160' height='600' alt='' border='0'/></a>
							</div>";								
					break;
					
					case "5":
						$ad_text = "<div class='alignleft'>  
							<a href='http://www.anrdoezrs.net/click-7585394-11507400' target='_top'>
							<img src='http://www.lduhtrp.net/image-7585394-11507400' width='120' height='600' alt='Shop Corelle' border='0'/></a>
							</div>";								
					break;
					
					case "6":
						$ad_text = "<div class='alignleft'>  
							<a href='http://www.jdoqocy.com/click-7585394-11633407' target='_top'>
							<img src='http://www.tqlkg.com/image-7585394-11633407' width='160' height='600' alt='' border='0'/></a>
							</div>";								
					break;																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																											
				}
			break;
			
			case "square":
				//get random number for rotating ads
				$number = rand(0, 6);
				switch($number) {
					case "0":
						$ad_text = "<div class='alignleft'>  
										<script type='text/javascript'>
										 amzn_assoc_ad_type = 'banner';
										 amzn_assoc_tracking_id = 'servebartendcook-20';
										 amzn_assoc_marketplace = 'myhabit';
										 amzn_assoc_region = 'US';
										 amzn_assoc_placement = 'assoc_banner_placement_default';
										 amzn_assoc_campaigns = 'myhabit';
										 amzn_assoc_p = '12';
										 amzn_assoc_banner_type = 'rotating';
										 amzn_assoc_width = '300';
										 amzn_assoc_height = '250';
										</script>
										<script src='//z-na.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&Operation=GetScript&ID=OneJS&WS=1'></script>
										</div>";		
					break;
					
					case "1":
						$ad_text = "<div class='alignleft'>  
							<script type='text/javascript'>
							 amzn_assoc_ad_type = 'banner';
							 amzn_assoc_tracking_id = 'servebartendcook-20';
							 amzn_assoc_marketplace = 'amazon';
							 amzn_assoc_region = 'US';
							 amzn_assoc_placement = 'assoc_banner_placement_default';
							 amzn_assoc_campaigns = 'local';
							 amzn_assoc_p = '12';
							 amzn_assoc_banner_type = 'category';
							 amzn_assoc_isresponsive = 'false';
							 amzn_assoc_banner_id = '0ASW3QKMM8DXW61JZ6G2';
							 amzn_assoc_width = '300';
							 amzn_assoc_height = '250';
							</script>
							<script src='//z-na.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&Operation=GetScript&ID=OneJS&WS=1'></script>
							</div>";				
					break;
					
					case "2":
							$ad_text = "<a href='http://www.anrdoezrs.net/click-7585394-11600425' target='_top'>
											<img src='http://www.awltovhc.com/image-7585394-11600425' width='300' height='250' alt='' border='0'/></a>";					
					break;
					
					case "3":
							$ad_text = "<a href='http://www.tkqlhce.com/click-7585394-10494485' target='_top'>
												<img src='http://www.awltovhc.com/image-7585394-10494485' width='300' height='250' alt='RENT your textbook and save up to $100!' border='0'/></a>";					
					break;

					case "4":
							$ad_text = "<a href='http://www.anrdoezrs.net/click-7585394-10879971' target='_top'>
												<img src='http://www.awltovhc.com/image-7585394-10879971' width='300' height='250' alt='GoldMedalWineClub.com-Great Wine Gifts-300x250' border='0'/></a>";					
					break;

					case "5":
							$ad_text = "<a href='http://www.jdoqocy.com/click-7585394-11010338' target='_top'>
								<img src='http://www.ftjcfx.com/image-7585394-11010338' width='300' height='250' alt='' border='0'/></a>";					
					break;	
	
					case "6":
							$ad_text = "<a href='http://www.dpbolvw.net/click-7585394-11633461' target='_top'>
								<img src='http://www.lduhtrp.net/image-7585394-11633461' width='300' height='250' alt='' border='0'/></a>";					
					break;																								
				}			
			break;
			
			case "banner":
				//get random number for rotating ads
				$number = rand(0, 1);
				switch($number) {
					case "0":
						$ad_text = "<div class='alignleft'>
											<script type='text/javascript'>
											 amzn_assoc_ad_type = 'banner';
											 amzn_assoc_tracking_id = 'servebartendcook-20';
											 amzn_assoc_marketplace = 'amazon';
											 amzn_assoc_region = 'US';
											 amzn_assoc_placement = 'assoc_banner_placement_default';
											 amzn_assoc_linkid = 'DE6G4MOEJW3CGUDZ';
											 amzn_assoc_campaigns = 'local';
											 amzn_assoc_p = '48';
											 amzn_assoc_banner_type = 'category';
											 amzn_assoc_isresponsive = 'false';
											 amzn_assoc_banner_id = '10V9D0N751QJFW7SMN02';
											 amzn_assoc_width = '728';
											 amzn_assoc_height = '90';
											</script>
											<script src='//z-na.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&Operation=GetScript&ID=OneJS&WS=1'></script>
											</div>";		
					break;
					
					case "1":
						$ad_text = "<div class='alignleft'>
											<script type='text/javascript'>
											 amzn_assoc_ad_type = 'banner';
											 amzn_assoc_tracking_id = 'servebartendcook-20';
											 amzn_assoc_marketplace = 'myhabit';
											 amzn_assoc_region = 'US';
											 amzn_assoc_placement = 'assoc_banner_placement_default';
											 amzn_assoc_linkid = '4V5JLDBS53ML4VTE';
											 amzn_assoc_campaigns = 'myhabit';
											 amzn_assoc_p = '48';
											 amzn_assoc_banner_type = 'rotating';
											 amzn_assoc_width = '728';
											 amzn_assoc_height = '90';
											</script>
											<script src='//z-na.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&Operation=GetScript&ID=OneJS&WS=1'></script>
											</div>";				
					break;					
				}			
			break;
			
		}
		$ad_text = "";
		return $ad_text;
	}
	
	function get_blog_post() {
		$rss = new DOMDocument();
		$rss->load('http://servebartendcook.com/blog/feed/');
		$feed = array();
		foreach ($rss->getElementsByTagName('item') as $node) {
			//get only the latest blog post
			$feed['title'] = $node->getElementsByTagName('title')->item(0)->nodeValue;
			$feed['description'] = $node->getElementsByTagName('description')->item(0)->nodeValue;
			$feed['link'] = $node->getElementsByTagName('link')->item(0)->nodeValue;
			$feed['date'] = $node->getElementsByTagName('pubDate')->item(0)->nodeValue;
			break;
		}
			$feed['title'] = str_replace(' & ', ' &amp; ', $feed['title']);
			$feed['date'] = date('F d, Y', strtotime($feed['date']));
		
		return $feed;
	}
	
	function get_open_graph_data($opportunityID) {
		$opportunity = new Opportunity($opportunityID);
		$version = $this->version;	
		$site_type = $this->site_type;
			
		//get job details
		$opportunity_data = $opportunity->get_opportunity_data();
		$job_data						= $opportunity_data['job_data']['general'];
		$main_skill						= $opportunity_data['job_data']['skills']['main_skill']['specialty'];
		
		//trim descrip for meta tag
		$trim_description = (strlen($job_data['description']) > 300) ? substr(trim($job_data['description']),0,297).'...' : $job_data['description'];
																	
		switch($main_skill) {
			case "Bartender":
				$og_title = "Bartender Position Available";
				$og_description = $title.":  ".$trim_description;				
			
			break;
			
			case "Manager":
				$og_title = "Management Position Available";
				$og_description = $title.":  ".$trim_description;				
			break;
			
			case "Kitchen":
				$og_title = "Kitchen Position Available";
				$og_description = $title.":  ".$trim_description;				
			break;
			
			case "Server":
				$og_title = "Server Position Available";
				$og_description = $title.":  ".$trim_description;				
			break;
									
			case "Bus":
				$og_title = "Bus Position Available";
				$og_description = $title.":  ".$trim_description;				
			break;

			case "Host":
				$og_title = "Host Position Available";
				$og_description = $title.":  ".$trim_description;				
			break;						
		}
				
		
		if ($site_type == "prototype") {
			$og_url = "http://threewhitebirds.com/SBC/public_listing_new.php?ID=".$opportunityID."&ref=".$job_data['public_hash'];
			$og_image = "http://threewhitebirds.com/SBC/graphics/icon_800.png";
		} else {
			$og_url = "http://servebartendcook.com/public_listing_new.php?ID=".$opportunityID."&ref=".$job_data['public_hash'];		
			$og_image = "http://servebartendcook.com/graphics/icon_800.png";
		}

		$meta_tags =	"<meta property='og:title' content='".$og_title."' />";
		$meta_tags .= "<meta property='og:site_name' content='ServeBartendCook' />";
		$meta_tags .= "<meta property='og:description' content='".$og_description."' />";	
		$meta_tags .= "<meta property='og:image' content='".$og_image."' />";	
		$meta_tags .= "<meta property='og:url' content='".$og_url."' />";
		$meta_tags .= "<meta name='twitter:card' content='summary'>";
		$meta_tags .= "<meta name='twitter:url' content='".$og_url."'>";
		$meta_tags .= "<meta name='twitter:title' content='".$og_title."'>";
		$meta_tags .= "<meta name='twitter:description' content='".$og_description."'>"; 
		
		return $meta_tags;
	}	
	
	function reorder_employment($employment_array) {
		//Red-order employment to ensure employment marked current appear at the top of the list
		$current_employment = array();
		$past_employment = array();
		foreach($employment_array as $row) {
			if ($row['current'] == 'Y') {
				$current_employment[] = $row;
			} else {
				$past_employment[] = $row;
			}
		}
		
		$new_employment_array = array();
		foreach($current_employment as $row) {
			$new_employment_array[] = $row;
		}
		foreach($past_employment as $row) {
			$new_employment_array[] = $row;
		}			
		
		return $new_employment_array;
	}	
	
	function check_email_verification() {
		$database = new Database;
		
		$database->query('SELECT email_validation FROM members WHERE userID = :userID');
		$database->bind(':userID', $_SESSION['userID']);
		$user_array = $database->single();	

		if($user_array['email_validation'] == "Y") {
			return "Y";
		} else {
			return "N";
		}	
	}
	
	function google_analytics() {
	//google analytics tag	
?>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-38015816-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			
			gtag('config', 'UA-38015816-1');
			gtag('config', 'AW-1025707558');  
		</script>
<?php	
	}	
	
	function google_analytics_conversion($type, $groupID) {
	//google analytics tag	
		switch($type) {
			case "post":
?>
			<!-- Event snippet for Job Post conversion page -->
			<script>
			  gtag('event', 'conversion', {
			      'send_to': 'AW-1025707558/CPnoCN_KpYYBEKacjOkD',
			      'transaction_id': '<? echo $groupID ?>'
			  });
			</script>
<?php	
			break;
			
			case "employee":
?>
				<!-- Event snippet for Sign-Up Complete conversion page -->
				<script>
				  gtag('event', 'conversion', {'send_to': 'AW-1025707558/2RQaCMjlwnAQppyM6QM'});
				</script>
<?php	
			break;
			
			case "employer":
?>
				<!-- Event snippet for Employer Sign-Up/Job Start conversion page -->
				<script>
				  gtag('event', 'conversion', {'send_to': 'AW-1025707558/cGEJCKqvsIYBEKacjOkD'});
				</script>
<?php	
			break;			
		}
	}	
	
	
	function google_analytics_old() {
	
	//google analytics tag	
?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-38015816-1', 'auto');
	  ga('send', 'pageview');

</script>

<!-- Google Code for Remarketing Tag -->
<!--------------------------------------------------
Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
--------------------------------------------------->
<!--
<script type="text/javascript">
var google_tag_params = {
job_id: 'REPLACE_WITH_VALUE',
job_locid: 'REPLACE_WITH_VALUE',
job_pagetype: 'REPLACE_WITH_VALUE',
job_totalvalue: 'REPLACE_WITH_VALUE',
};
</script>

<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1025707558;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1025707558/?guid=ON&amp;script=0"/>
</div>
</noscript>
-->

<?php	
	}
	
	function google_adwords_RM() {
	//Google adwords remarketing tag
?>
<!-- Google Code for Remarketing Tag -->
<!--------------------------------------------------
Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
--------------------------------------------------->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1025707558;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1025707558/?guid=ON&amp;script=0"/>
</div>
</noscript>
<?php	
		
	}
	
	function facebook_RM() {
	//FACEBOOK REMARKETING		
?>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1436959506576243');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1436959506576243&ev=PageView&noscript=1"
/></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->


<!-- OLD
<script>(function() {
	  var _fbq = window._fbq || (window._fbq = []);
	  if (!_fbq.loaded) {
	    var fbds = document.createElement('script');
	    fbds.async = true;
	    fbds.src = '//connect.facebook.net/en_US/fbds.js';
	    var s = document.getElementsByTagName('script')[0];
	    s.parentNode.insertBefore(fbds, s);
	    _fbq.loaded = true;
	  }
	  _fbq.push(['addPixelId', '1436959506576243']);
	})();
	window._fbq = window._fbq || [];
	window._fbq.push(['track', 'PixelInitialized', {}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=1436959506576243&amp;ev=NoScript" /></noscript>
-->
<?php
	}	
	
	function linkedin_RM() {
?>
		<script type="text/javascript"> 
			_linkedin_data_partner_id = "63349"; 
		</script>
		
		<script type="text/javascript"> 
			(function(){var s = document.getElementsByTagName("script")[0]; var b = document.createElement("script"); b.type = "text/javascript";b.async = true; b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js"; s.parentNode.insertBefore(b, s);})(); 
		</script> 
		
		<noscript> 
			<img height="1" width="1" style="display:none;" alt="" src="https://dc.ads.linkedin.com/collect/?pid=63349&fmt=gif" /> 
		</noscript>
<?php		
	}
	
	function facebook_conversion() {
?>
<!--
<script>(function() {
		var _fbq = window._fbq || (window._fbq = []);
		if (!_fbq.loaded) {
		var fbds = document.createElement('script');
		fbds.async = true;
		fbds.src = '//connect.facebook.net/en_US/fbds.js';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(fbds, s);
		_fbq.loaded = true;
		}
		})();
		window._fbq = window._fbq || [];
		window._fbq.push(['track', '6010056443425', {'value':'0.00','currency':'USD'}]);
		</script>
		<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6010056443425&amp;cd[value]=0.00&amp;cd[currency]=USD&amp;noscript=1" /></noscript>
-->
<?php		
	}				
	
	function twitter_RM() {
?>
	<script src="//platform.twitter.com/oct.js" type="text/javascript"></script>
	<script type="text/javascript">twttr.conversion.trackPid('l6abs', { tw_sale_amount: 0, tw_order_quantity: 0 });</script>
	<noscript>
	<img height="1" width="1" style="display:none;" alt="" src="https://analytics.twitter.com/i/adsct?txn_id=l6abs&p_id=Twitter&tw_sale_amount=0&tw_order_quantity=0" />
	<img height="1" width="1" style="display:none;" alt="" src="//t.co/i/adsct?txn_id=l6abs&p_id=Twitter&tw_sale_amount=0&tw_order_quantity=0" />
	</noscript>
<?php		
	}		
	
	function month_selections($month) {
		$jan = $feb =$mar = $apr = $may = $jun = $jul = $aug = $sep = $oct = $nov = $dec = ""; 
		
		switch($month) {
			case "1":
				$jan = 'selected';
			break;
			
			case "2":
				$feb = 'selected';
			break;
			
			case "3":
				$mar = 'selected';
			break;
			
			case "4":
				$apr = 'selected';
			break;
			
			case "5":
				$may = 'selected';
			break;
			
			case "6":
				$jun = 'selected';
			break;
			
			case "7":
				$jul = 'selected';
			break;
			
			case "8":
				$aug = 'selected';
			break;
			
			case "9":
				$sep = 'selected';
			break;
			
			case "10":
				$oct = 'selected';
			break;
			
			case "11":
				$nov = 'selected';
			break;
			
			case "12":
				$dec = 'selected';
			break;				
		}
		
		return array("jan" => $jan,
							"feb" => $feb,
							"mar" => $mar,
							"apr" => $apr,
							"may" => $may,
							"jun" => $jun,
							"jul" => $jul,
							"aug" => $aug,
							"sep" => $sep,
							"oct" => $oct,
							"nov" => $nov,
							"dec" => $dec);		
	}	
	
	function determine_years_of_experience($date_array) {
		//This is more laborious than it seems.  Work overlap must be taken into consideration when determining dates

		if (count($date_array) > 0) {
		//first convert the month-year entries into single numbers for easier match
		foreach($date_array as $key=>$row) {
			$date_array[$key]['start_date_number'] = $row['start_year'] + $row['start_month']/12;
			if ($row['current'] == 'Y') {
				$row['end_year'] = date('Y');
				$row['end_month'] = date('n');	
			}
			$date_array[$key]['end_date_number'] = $row['end_year'] + $row['end_month']/12;		
		}	
		
		//sort so the earliest is first
		usort($date_array, array( $this, 'comp'));
		
		$total_experience = 0;
				
		//set up an array of dates to ignore
		$ignore_dates = array();
		
		foreach($date_array as $initial_dates) {

			if (!in_array($initial_dates['ID'], $ignore_dates)) {
				$ignore_dates[] = $initial_dates['ID'];
				//get the first end date
				$initialID = $initial_dates['ID'];
				$initial_start_date = $initial_dates['start_date_number'];				
				$initial_end_date = $initial_dates['end_date_number'];
				
				//now loop through again to look for start dates that begin before the end date
				$count = 0;
				foreach($date_array as $test) {
					if (!in_array($test['ID'], $ignore_dates)) {
						if ($test['start_date_number'] < $initial_end_date) {
							//we know this is an overlap, so lets already toss it away 
							$ignore_dates[] = $test['ID'];
							//see if the end date is greater than the current end date, if so, it becomes the new end date
							if ($test['end_date_number'] > $initial_end_date) {
								$initial_end_date = $test['end_date_number'];
							}
						}
					}
				}
				$experience =  $initial_end_date - $initial_start_date;
				$total_experience = $total_experience +$experience;
			
				$denominator = 4;
			    $x = $total_experience * $denominator;
			    $x = floor($x);
			    $total_experience = $x / $denominator;
			}
		}
	} else {
		$total_experience = 0;
	}
	return $total_experience;	
}

		function comp($a, $b) {
		    if ($a['start_date_number'] == $b['start_date_number']) {
		        return 0;
		    } else {
		    
		    return ($a['start_date_number'] < $b['start_date_number']) ? -1 : 1;
		    }
		}											


	function get_unique_array_values($array, $key) {
		$new_array = array();
		foreach($array as $row) {
			$new_array[] = $row[$key];
		}
		
		$unique_array = array_unique($new_array);
		return $unique_array;
	}
	
	function get_meta_data($page) {
		switch($page) {
			default:
				$title = "Hospitality Hiring Made Easy | Serve. Bartend. Cook.";
				$description = "Find local hospitality jobs or hire staff! Quick, easy job search and posting for servers, bartenders, cooks.  Job Matching for restaurant, bar positions.";
			break;
			
			case "login":
				$title = "Login and Get Job Matches Today | Serve. Bartend. Cook.";
				$description = "Login to access the fastest, easiest way to find a new hospitality job or hire a new hospitality employee! Welcome back.";			
			break;
			
			case "employee_signup":
				$title = "NEED A JOB? Use Serve Bartend Cook to find jobs today.";
				$description = "Register to find a new hospitality job in local restaurants and bars! Job matching site makes your job search easier, faster, and more fun.";			
			break;
			
			case "employer_signup":
				$title = "ARE YOU HIRING? Use Serve Bartend Cook to find staff today.";
				$description = "Register to find new hospitality staff for your bar or restaurant! Job matching helps you find qualified applicants quickly and easily.";			
			break;
			
			case "info_graphic":
				$title = "We Save You Time and Money | Serve. Bartend. Cook.";
				$description = "Hire new staff in minutes. Job posting, job matching, and resume review. See applicant profiles and sort candidates by skills and experience.";			
			break;		
		}
		
		$meta_data = array("title" => $title, "description" => $description);
		return $meta_data;
	}	
	
	function convert_datetime($month, $day, $year, $hour, $minute, $ampm) {
		//convert into timestamp for database 0000-00-00 00:00:00 format
		
		if ($ampm == "PM") {
			$hour = $hour + 12;
		}
		
		if ($day < 10) {
			$day = "0".$day;
		}
		
		if ($hour < 10) {
			$hour = "0".$hour;
		}						
		
		$date = $year."-".$month."-".$day." ".$hour.":".$minute.":00";
		
		return $date;
	}
	
	function check_recommendation_landing_page($recommendID, $recommend_hash) {
		//when someone browses to the landing page with recommendation GET variables, test them
		$database = new Database;

		$database->query("SELECT * FROM bounty_recommendations
										WHERE ID = :recommendID
										AND hash = :hash");
		$database->bind(':recommendID', $recommendID);			
		$database->bind(':hash', $recommend_hash);			
		$bounty_data = $database->single();

		if (isset($bounty_data['ID']) && $bounty_data['ID'] > 0) {
			if ($bounty_data['recommend_status'] != "Notified") {
				$result = "accepted";
			} else {
				//get the name of the recommender
				$database->query("SELECT firstname, lastname FROM members WHERE userID = :userID");
				$database->bind(':userID', $bounty_data['userID']);			
				$member_data = $database->single();

				//get job title and location
				$database->query("SELECT jobs.title, stores.name FROM jobs, stores 
												WHERE jobID = :jobID
												AND jobs.job_status = :job_status
												AND jobs.expiration_date >= NOW()
												AND stores.storeID = jobs.storeID");
				$database->bind(':jobID', $bounty_data['jobID']);			
				$database->bind(':job_status', "Open");			
				$job_array = $database->resultset();

				if (count($job_array) > 0) {
					foreach($job_array as $row) {
						$job_data = $row;
					}
				} else {
					$job_data = "expired";
				}
				
				//test the results
				if (isset($bounty_data['recommendedID']) && $bounty_data['recommendedID'] > 0) {
					$result = "current_user";
					$result = array("candidate" => "current_user", "recommender" => array("firstname" => $member_data['firstname'], "lastname" => $member_data['lastname']), "job_data" => $job_data);				
				} else {			
					$result = array("candidate" =>array("email" => $bounty_data['email'], "firstname" => $bounty_data['firstname'], $bounty_data['lastname']), "recommender" => array("firstname" => $member_data['firstname'], "lastname" => $member_data['lastname']), "job_data" => $job_data);
				}
				
				//set session
				$_SESSION['recommend'] = array("jobID" => $bounty_data['jobID'], "recommendID" => $recommendID, "email" => $bounty_data['email'], "firstname" => $bounty_data['firstname'], "lastname" => $bounty_data['lastname'], "recommenderID" => $bounty_data['userID']);			
			}
		} else {
			$result = "invalid";
		}	
		
		return $result;
	}
	
	function determine_region_status($zip) {
		//determine the number of users in a 40 mile radius to determine whther this user can put in a bounty job
//		$threshold = 800;
		$threshold = 1500;
		
		$coordinates = $this->get_coordinates($zip);

		$longitude = $coordinates['longitude'];
		$latitude = $coordinates['latitude'];
				
		//40 mile appoximation, square
		$max_lat = $latitude + 0.57971;
		$min_lat = $latitude - 0.57971;
		$max_long = $longitude + 0.57827;
		$min_long = $longitude - 0.57827;
		
		$database = new Database;							
		$database->query("SELECT COUNT(members.userID) FROM members, zcta WHERE members.type = :type
												AND members.valid = :valid
												AND members.profile_status = :status
												AND members.zip = zcta.zip
												AND zcta.latitude BETWEEN :min_lat AND :max_lat
												AND zcta.longitude BETWEEN :min_long AND :max_long ");									
		$database->bind(':type', 'employee');
		$database->bind(':valid', 'Y');
		$database->bind(':status', 'complete');
		$database->bind(':min_lat', $min_lat);
		$database->bind(':max_lat', $max_lat);
		$database->bind(':min_long', $min_long);
		$database->bind(':max_long', $max_long);
		$result = $database->single();	

		if ($result['COUNT(members.userID)'] > $threshold) {
			$type = "bounty";
		} else {
			$type = "free";
		}
		
		return $type;
	}

	function convert_password($userID, $password) {
		$database = new Database;

		$options = ['cost' => 10,];		
		$new_pass = password_hash($password, PASSWORD_BCRYPT, $options);		
		
		$database->query('UPDATE members SET password = :new_pass, pass_test = :new_flag
									WHERE userID = :userID');
		$database->bind(':userID', $userID);		
		$database->bind(':new_pass', $new_pass);		
		$database->bind(':new_flag', "Y");	
		
		$database->execute();
	}
		
	function robot_test($page) {
		$page_array = array("profile", "main", "opportunity", "opportunity_list", "job", "job_list", "profile_employer","profile_employee", "forgot_pass", "verification_email", "illegal");
		if (in_array($page, $page_array)) {
			return false;
		} else {
			return true;
		}
	}
	
	function get_job_public_hash($jobID) {
		$database = new Database;

		$database->query("SELECT public_hash FROM jobs
										WHERE jobID = :jobID
										AND job_status = :job_status ");									
		$database->bind(':jobID', $jobID);
		$database->bind(':job_status', 'Open');
		$result = $database->single();	
		$public_hash = $result['public_hash'];
		
		return $public_hash;		
	}
	
	function get_job_public_ID($hash) {
		$database = new Database;

		$database->query("SELECT jobID FROM jobs
										WHERE public_hash = :public_hash
										AND job_status = :job_status ");									
		$database->bind(':public_hash', $hash);
		$database->bind(':job_status', 'Open');
		$result = $database->single();	
		$jobID = $result['jobID'];
		
		return $jobID;		
	}
	
	
	function get_job_title($jobID) {
		$database = new Database;

		//get job title and location
		$database->query("SELECT jobs.title, stores.name, stores.image FROM jobs, stores 
										WHERE jobID = :jobID
										AND jobs.job_status = :job_status
										AND jobs.expiration_date >= NOW()
										AND stores.storeID = jobs.storeID");
		$database->bind(':jobID', $jobID);			
		$database->bind(':job_status', "Open");			
		$job_array = $database->resultset();

		if (count($job_array) > 0) {
			foreach($job_array as $row) {
				$job_data = $row;
			}
		} else {
			$job_data = "NA";
		}
		
		return $job_data;				
	}	
}
?>