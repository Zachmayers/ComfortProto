<?php
require_once('classes/utilities.class.php');
require_once('classes/employee.class.php');
session_start();

	if (isset($_SESSION['userID']) && $_SESSION['userID'] != 0) {
		$employee = new Employee($_SESSION['userID']);
		$utilities = new Utilities;
		$type = $_GET['type'];
			//swtich depending on type of pics upload
			switch($type) {
				case "profile":
					if ($_FILES['profile_pic_choose_ie']['size'] > 2000000 || $_FILES['profile_pic_choose_ie']['name'] == "") {
						echo "File exceeds maximum size";
					} elseif ($_FILES['profile_pic_choose_ie']['type'] == "image/jpeg" || $_FILES['profile_pic_choose_ie']['type'] == "image/pjpeg" || $_FILES['profile_pic_choose_ie']['type'] == "image/jpg" || $_FILES['profile_pic_choose_ie']['type'] == "image/png") {
						$new_name = $_SESSION['userID'].".jpg";			
						$file_name = $_FILES['profile_pic_choose_ie']['name'];
						$temp_name = $_FILES['profile_pic_choose_ie']['tmp_name'];
						$error = $_FILES['profile_pic_choose_ie']['error'];
						$img_src = "images/profile_pics/".$new_name;			
						$dest = "images/profile_pics/";
						$upload_error = $utilities->upload_photo($file_name, $temp_name, $error, $new_name, $dest);
						if ($_FILES['profile_pic_choose_ie']['type'] == "image/png") {
							$convert_error = $utilities->convert_png_to_jpg($img_src);
							$img_src = $img_src.".jpg";
						} else {
							$convert_error = 0;
						}			
						$dest = "images/profile_pics/";
						//echo $img_src;
						$crop_error = $utilities->CroppedThumbnail($img_src, "170", "170", $new_name, $dest);
						if ($error == 0 && $convert_error == 0 && $upload_error == 0 && $crop_error == 0) {
							$utilities->update_inventory_photo("profile", $new_name, "");
							echo "Successful";			
						} else {
							echo "There was a problem uploading the file.";
						}
					} else {
						echo "Incompatible file type.  Please use a .jpeg or .png file. | ";											
					}					
				break;
					
				case "bartender":
					if ($_FILES['bartender_pic_choose_ie']['size'] > 2000000) {
						echo "File exceeds maximum size";
					} elseif ($_FILES['bartender_pic_choose_ie']['type'] == "image/jpeg" || $_FILES['bartender_pic_choose_ie']['type'] == "image/pjpeg" || $_FILES['bartender_pic_choose_ie']['type'] == "image/jpg" || $_FILES['bartender_pic_choose_ie']['type'] == "image/png") {
						//Get current photos of specific type
						$employee_data = $emplyee->get_employee_data();
						$photo_array = $employee_data['bar_photos'];
						if (count($photo_array) <= 6) {
							//Get the file extension
							if ($_FILES['bartender_pic_choose_ie']['type'] == "image/jpeg" || $_FILES['bartender_pic_choose_ie']['type'] == "image/pjpeg" || $_FILES['bartender_pic_choose_ie']['type'] == "image/jpg") {
								$extension = ".jpg";
							} else {
								$extension = ".png";								
							}		
							$photo_number = $utilities->get_photo_number();
							$new_name = "bartender_".$photo_number."_".$_SESSION['userID'].".jpg";	
							$thumb_name = "bartender_".$photo_number."_".$_SESSION['userID']."_s.jpg";										
							$file_name = $_FILES['bartender_pic_choose_ie']['name'];
							$temp_name = $_FILES['bartender_pic_choose_ie']['tmp_name'];
							$error = $_FILES['bartender_pic_choose_ie']['error'];
							$img_src = "images/gallery_pics/".$new_name;
							$dest = "images/gallery_pics/";		
							$upload_error = $utilities->upload_photo($file_name, $temp_name, $error, $new_name, $dest);
							if ($_FILES['bartender_pic_choose_ie']['type'] == "image/png") {
								$convert_error = $utilities->convert_png_to_jpg($img_src);
								$img_src = $img_src.".jpg";
							} else {
								$convert_error = 0;
							}	
							$dest = "images/gallery_pics/";									
							$crop_error = $utilities->CroppedThumbnail($img_src, "60", "60", $thumb_name, $dest);									

							if ($error == 0 && $upload_error == 0) {
								$utilities->update_inventory_photo("bartender", $new_name, $thumb_name);			
								echo "Successful";			
							} else {
								echo "There was a problem uploading the file.";
							}							
						} else {
							echo "You already have the maximum number of files for this gallery.";
						}
					} else {
						echo "Incompatible file type.  Please use a .jpeg or .png file.";											
					}
				break;	
				
				case "kitchen":				
					if ($_FILES['kitchen_pic_choose_ie']['size'] > 2000000) {
						echo "File exceeds maximum size";
					} elseif ($_FILES['kitchen_pic_choose_ie']['type'] == "image/jpeg" || $_FILES['kitchen_pic_choose_ie']['type'] == "image/pjpeg" || $_FILES['kitchen_pic_choose_ie']['type'] == "image/jpg" || $_FILES['kitchen_pic_choose_ie']['type'] == "image/png") {
						//Get current photos of specific type
						$employee_data = $emplyee->get_employee_data();
						$photo_array = $employee_data['bar_photos'];
						if (count($photo_array) <= 6) {
							//Get the file extension
							if ($_FILES['kitchen_pic_choose_ie']['type'] == "image/jpeg" || $_FILES['kitchen_pic_choose_ie']['type'] == "image/pjpeg" || $_FILES['kitchen_pic_choose']['type'] == "image/jpg") {
								$extension = ".jpg";
							} else {
								$extension = ".png";								
							}		
							$photo_number = $utilities->get_photo_number();
							$new_name = "kitchen_".$photo_number."_".$_SESSION['userID'].".jpg";	
							$thumb_name = "kitchen_".$photo_number."_".$_SESSION['userID']."_s.jpg";										
							$file_name = $_FILES['kitchen_pic_choose_ie']['name'];
							$temp_name = $_FILES['kitchen_pic_choose_ie']['tmp_name'];
							$error = $_FILES['kitchen_pic_choose_ie']['error'];
							$img_src = "images/gallery_pics/".$new_name;
							$dest = "images/gallery_pics/";	
							//echo $temp_name;	
							$upload_error = $utilities->upload_photo($file_name, $temp_name, $error, $new_name, $dest);
							if ($_FILES['kitchen_pic_choose_ie']['type'] == "image/png") {
								$convert_error = $utilities->convert_png_to_jpg($img_src);
								$img_src = $img_src.".jpg";
							} else {
								$convert_error = 0;
							}	
							$dest = "images/gallery_pics/";									
							$crop_error = $utilities->CroppedThumbnail($img_src, "60", "60", $thumb_name, $dest);									
							if ($error == 0 && $upload_error == 0) {
								$utilities->update_inventory_photo("kitchen", $new_name, $thumb_name);			
								echo "Successful";			
							} else {
								echo "There was a problem uploading the file.";
							}												
							
						} else {
							echo "You already have the maximum number of files for this gallery.";
						}
					} else {
						echo "Incompatible file type.  Please use a .jpeg or .png file.";											
					}
					
				break;									
			}	
	}
?>