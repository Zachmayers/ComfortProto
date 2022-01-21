<?php
require_once('classes/utilities.class.php');
require_once('classes/employee.class.php');
require_once('classes/employer.class.php');
session_start();

	if (isset($_SESSION['userID']) && $_SESSION['userID'] != 0) {
		$utilities = new Utilities;
		$type = $_GET['type'];
			//swtich depending on type of pics upload
			switch($type) {
				case "profile":
					$employee = new Employee($_SESSION['userID']);

					if ($_FILES['profile_pic_choose']['size'] > 5000000 || $_FILES['profile_pic_choose']['name'] == "") {
						echo "File exceeds maximum size";
					} else {
						$new_name = $_SESSION['userID'].".jpg";			
						$thumb_name = $_SESSION['userID']."_s.jpg";										
						$file_name = $_FILES['profile_pic_choose']['name'];
						$temp_name = $_FILES['profile_pic_choose']['tmp_name'];
						$error = $_FILES['profile_pic_choose']['error'];
						$img_src = "images/profile_pics/".$new_name;			
						$dest = "images/profile_pics/";
						$upload_error = $utilities->upload_photo($file_name, $temp_name, $error, $new_name, $dest);
						if ($_FILES['profile_pic_choose']['type'] == "image/png") {
							$convert_error = $utilities->convert_png_to_jpg($img_src);
							$img_src = $img_src.".jpg";
						} else {
							$convert_error = 0;
						}			
						$dest = "images/profile_pics/";
						$crop_error = $utilities->resizePic($img_src, "500", "500", $new_name, $dest);
						//$crop_error = $utilities->CroppedThumbnail($img_src, "300", "300", $thumb_name, $dest);
						//$crop_error = 0;
					}
					
					if ($error == 0 && $convert_error == 0 && $upload_error == 0 && $crop_error == 0) {
						$utilities->update_inventory_photo("profile", $new_name, "");
						echo "Successful";			
					} else {
						echo "There was a problem uploading the file.";
					}
				break;

				case "store":
					$employer = new Employer($_SESSION['userID']);
					$storeID = $_GET['storeID'];
					if ($_FILES['store_pic_choose']['size'] > 5000000 || $_FILES['store_pic_choose']['name'] == "") {
						echo "File exceeds maximum size";
					} else {
						$new_name = $storeID.".jpg";			
						$thumb_name = $storeID."_s.jpg";										
						$file_name = $_FILES['store_pic_choose']['name'];
						$temp_name = $_FILES['store_pic_choose']['tmp_name'];
						$error = $_FILES['store_pic_choose']['error'];
						$img_src = "images/store_pics/".$new_name;			
						$dest = "images/store_pics/";
						$upload_error = $utilities->upload_photo($file_name, $temp_name, $error, $new_name, $dest);
						if ($_FILES['store_pic_choose']['type'] == "image/png") {
							$convert_error = $utilities->convert_png_to_jpg($img_src);
							$img_src = $img_src.".jpg";
						} else {
							$convert_error = 0;
						}			
						$dest = "images/store_pics/";

						$crop_error = $utilities->resizePic($img_src, "500", "500", $new_name, $dest);
						//$crop_error = $utilities->CroppedThumbnail_old($img_src, "300", "300", $thumb_name, $dest);
					}
					
					if ($error == 0 && $convert_error == 0 && $upload_error == 0) {
						$utilities->update_inventory_photo("store", $new_name, $storeID);
						echo "Successful";			
					} else {
						echo "There was a problem uploading the file.";
					}
				break;
					
				case "bartender":
					$employee = new Employee($_SESSION['userID']);

					if ($_FILES['bartender_pic_choose']['size'] > 5000000) {
						echo "File exceeds maximum size";
					} else {
						//Get current photos of specific type
						$employee_data = $employee->get_employee_data();
						$photo_array = $employee_data['bar_photos'];
						if (count($photo_array) <= 12) {
							//Get the file extension
							if ($_FILES['bartender_pic_choose']['type'] == "image/jpeg" || $_FILES['bartender_pic_choose']['type'] == "image/jpg") {
								$extension = ".jpg";
							} else {
								$extension = ".png";								
							}		
							$photo_number = $utilities->get_photo_number();
							$new_name = "bartender_".$photo_number."_".$_SESSION['userID'].".jpg";	
							$thumb_name = "bartender_".$photo_number."_".$_SESSION['userID']."_s.jpg";										
							$file_name = $_FILES['bartender_pic_choose']['name'];
							$temp_name = $_FILES['bartender_pic_choose']['tmp_name'];
							$error = $_FILES['bartender_pic_choose']['error'];
							$img_src = "images/gallery_pics/".$new_name;
							$dest = "images/gallery_pics/";		
							$upload_error = $utilities->upload_photo($file_name, $temp_name, $error, $new_name, $dest);
							if ($_FILES['bartender_pic_choose']['type'] == "image/png") {
								$convert_error = $utilities->convert_png_to_jpg($img_src);
								$img_src = $img_src.".jpg";
							} else {
								$convert_error = 0;
							}	
							$dest = "images/gallery_pics/";	
							$crop_error = $utilities->resizePic($img_src, "500", "500", $new_name, $dest);
								
							$crop_error = $utilities->CroppedThumbnail($img_src, "300", "300", $thumb_name, $dest);									
							//$crop_error = 0;
							
						} else {
							echo "You already have the maximum number of files for this gallery.";
						}
					}

					if ($error == 0 && $upload_error == 0) {
						$utilities->update_inventory_photo("bartender", $new_name, $thumb_name);			
						echo "Successful";			
					} else {
						echo "There was a problem uploading the file.";
					}				
				
				break;	
				
				case "kitchen":				
					$employee = new Employee($_SESSION['userID']);

					if ($_FILES['kitchen_pic_choose']['size'] > 5000000) {
						echo "File exceeds maximum size";
					} else {
						//Get current photos of specific type
						$employee_data = $employee->get_employee_data();
						$photo_array = $employee_data['kitchen_photos'];
						if (count($photo_array) <= 12) {
							//Get the file extension
							if ($_FILES['kitchen_pic_choose']['type'] == "image/jpeg" || $_FILES['kitchen_pic_choose']['type'] == "image/jpg") {
								$extension = ".jpg";
							} else {
								$extension = ".png";								
							}		
							$photo_number = $utilities->get_photo_number();
							$new_name = "kitchen_".$photo_number."_".$_SESSION['userID'].".jpg";	
							$thumb_name = "kitchen_".$photo_number."_".$_SESSION['userID']."_s.jpg";										
							$file_name = $_FILES['kitchen_pic_choose']['name'];
							$temp_name = $_FILES['kitchen_pic_choose']['tmp_name'];
							$error = $_FILES['kitchen_pic_choose']['error'];
							$img_src = "images/gallery_pics/".$new_name;
							$dest = "images/gallery_pics/";	
							//echo $temp_name;	
							$upload_error = $utilities->upload_photo($file_name, $temp_name, $error, $new_name, $dest);
							if ($_FILES['kitchen_pic_choose']['type'] == "image/png") {
								$convert_error = $utilities->convert_png_to_jpg($img_src);
								$img_src = $img_src.".jpg";
							} else {
								$convert_error = 0;
							}	
							$dest = "images/gallery_pics/";
							$crop_error = $utilities->resizePic($img_src, "500", "500", $new_name, $dest);
									
							$crop_error = $utilities->CroppedThumbnail($img_src, "300", "300", $new_name, $dest);
							//$crop_error = 0;
							
						} else {
							echo "You already have the maximum number of files for this gallery.";
						}
					}
					
					if ($error == 0 && $upload_error == 0) {
						$utilities->update_inventory_photo("kitchen", $new_name, $thumb_name);			
						echo "Successful";			
					} else {
						echo "There was a problem uploading the file.";
					}												
				break;									
			}	
	} else if ($_SESSION['userID'] == "admin") {
				$utilities = new Utilities;

					$storeID = $_GET['storeID'];
					if ($_FILES['store_pic_choose']['size'] > 5000000 || $_FILES['store_pic_choose']['name'] == "") {
						echo "File exceeds maximum size";
					} else {
						$new_name = $storeID.".jpg";			
						$thumb_name = $storeID."_s.jpg";										
						$file_name = $_FILES['store_pic_choose']['name'];
						$temp_name = $_FILES['store_pic_choose']['tmp_name'];
						$error = $_FILES['store_pic_choose']['error'];
						$img_src = "images/store_pics/".$new_name;			
						$dest = "images/store_pics/";
						$upload_error = $utilities->upload_photo($file_name, $temp_name, $error, $new_name, $dest);
						if ($_FILES['store_pic_choose']['type'] == "image/png") {
							$convert_error = $utilities->convert_png_to_jpg($img_src);
							$img_src = $img_src.".jpg";
						} else {
							$convert_error = 0;
						}			
						$dest = "images/store_pics/";

						$crop_error = $utilities->resizePic($img_src, "500", "500", $new_name, $dest);
						//$crop_error = $utilities->CroppedThumbnail_old($img_src, "300", "300", $thumb_name, $dest);
					}
					
					if ($error == 0 && $convert_error == 0 && $upload_error == 0) {
						$utilities->update_inventory_photo("store_admin", $new_name, $storeID);
						echo "Successful";			
					} else {
						echo "There was a problem uploading the file.";
					}
		
	}
?>