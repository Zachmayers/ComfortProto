<?php
	function employees_html($employees_array) {
		$admin = new Admin;
		$utilities = new Utilities;
		$page = $_GET['number'];
		
		$total_records = count($employees_array);	
		$total_pages = ceil($total_records / 50);
		
		if ($page == $total_pages) {
			$next = "";
		} else {
			$next_page = $page + 1;
			$next = "<a href='admin.php?page=members&type=employee&number=".$next_page."'>Next Page</a>";
		}
		
		if ($page == 1) {
			$prev = "";
		} else {
			$prev_page = $page - 1;
			$prev = "<a href='admin.php?page=members&type=employee&number=".$prev_page."'>Prev Page</a>";
		}
		
?>		
	<div class="container">
		<h1 style="display:inline;">Member List</h1> &nbsp; &nbsp; <a href="admin.php"><button>Admin Home</button></a>	
		<br /> &nbsp; <br />
		
		<form method="get" action="admin.php">
		Search criteria:  <select id='criteria' name='criteria'>
									<option value='zip'>Zip Code</option>
									<option value='last_name'>Last Name</option>
									<option value='email'>Email</option>
									<option value='status'>Status</option>
									<option value='video'>Video</option>
									<option value='photo'>Photo</option>
									<option value='active'>Active</option>
							</select>
			Term:  <input type="text" id="term" name="term">  <button id="search">Search</button>
			<input type="hidden" name="page" value="members">
			<input type="hidden" name="type" value="employee">
			<input type="hidden" name="number" value="1">			
		</form>	
			<br /> &nbsp; <br />
			Total Records:  <? echo $total_records ?> (<? echo $total_pages ?> pages) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <? echo $prev." | ".$next ?> <br />
				
		<table class='dark'>
		<tr><th>Name</th><th>Email</th><th>Status</th><th>Features</th><th>Zip</th><th>Validation</th><th>Active</th></tr>
		
<?php
		
		$i = ($page - 1) * 50;
		$upper = $i + 49;
		//foreach($employees_array as $row) {
		
		while ($i <= $upper) {
			$features = "";
		
			if ($employees_array[$i]['profile_pic'] != "") {
				$features .= "P";
			} 
			
			$video_array = $admin->get_member_info("video", $employees_array[$i]['userID']);
			if (count($video_array) > 0) {
				$features .= " V";
			}
			
			$gallery_array = $admin->get_member_info("gallery", $employees_array[$i]['userID']);
			if (count($gallery_array) > 0) {
				$features .= " G";
			} 
			
			if ($row['profile_status'] == "complete") {
				$skills_array = $admin->get_member_info("skills", $employees_array[$i]['userID']);
				if (count($skills_array) == 0) {
					$profile_status = 1;
				} else {
					$profile_status = "Complete";
				}			
			} else {
					$profile_status = $employees_array[$i]['profile_status'];
			}
	
		
			echo "<tr>";
			echo "<td><a href='admin.php?page=member_details&id=".$employees_array[$i]['userID']."'>".$employees_array[$i]['lastname'].", ".$employees_array[$i]['firstname']."</a></td>";
			echo "<td align='center'>".$employees_array[$i]['email']."</td>";		
			echo "<td align='center'>".$profile_status."</td>";		
			echo "<td align='center'>".$features."</td>";		
			echo "<td align='center'>".$employees_array[$i]['zip']."</td>";								
			echo "<td align='center'>".$employees_array[$i]['email_validation']."</td>";
			echo "<td align='center'>".$employees_array[$i]['valid']."</td>";																	
			echo "</tr>";	
			
			$i++;	
		}
?>
		</table>
		<hr>
	</div>
<?php
	}//end html_page_main function
	
	function employers_html($employers_array) {
		$admin = new Admin;
		$utilities = new Utilities;
		$page = $_GET['number'];
		
		$total_records = count($employers_array);	
		$total_pages = ceil($total_records / 50);

		if ($page == $total_pages) {
			$next = "";
		} else {
			$next_page = $page + 1;
			$next = "<a href='admin.php?page=members&type=employer&number=".$next_page."'>Next Page</a>";
		}
		
		if ($page == 1) {
			$prev = "";
		} else {
			$prev_page = $page - 1;
			$prev = "<a href='admin.php?page=members&type=employer&number=".$prev_page."'>Prev Page</a>";
		}
		
?>		
	<div class="container">
		<h1 style="display:inline;">Employer List</h1> &nbsp; &nbsp; <a href="admin.php"><button>Admin Home</button></a>	
		<br /> &nbsp; <br />
		
		<form method="get" action="admin.php">
		Search criteria:  <select id='criteria' name='criteria'>
									<option value='last_name'>Last Name</option>
									<option value='email'>Email</option>
							</select>
			Term:  <input type="text" id="term" name="term">  <button id="search">Search</button>
			<input type="hidden" name="page" value="members">
			<input type="hidden" name="type" value="employer">
			<input type="hidden" name="number" value="1">			
		</form>	
			<br /> &nbsp; <br />
			Total Records:  <? echo $total_records ?> (<? echo $total_pages ?> pages) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <? echo $prev." | ".$next ?> <br />
				
		<table class='dark'>
		<tr><th>Name</th><th>Email</th><th>Company</th><th>Position</th><th># of Stores</th><th>Validation</th><th>Active</th></tr>
		
<?php
		
		$i = ($page - 1) * 50;
		$upper = $i + 49;

		while ($i <= $upper) {	
		
			echo "<tr>";
			echo "<td><a href='admin.php?page=member_details&id=".$employers_array[$i]['userID']."'>".$employers_array[$i]['lastname'].", ".$employers_array[$i]['firstname']."</a></td>";
			echo "<td align='center'>".$employers_array[$i]['email']."</td>";		
			echo "<td align='center'>".$employers_array[$i]['company']."</td>";	
			echo "<td align='center'>".$$employers_array[$i]['position']."</td>";																		
			echo "<td align='center'>FIX THIS</td>";
			echo "<td align='center'>".$employers_array[$i]['email_validation']."</td>";
			echo "<td align='center'>".$employers_array[$i]['valid']."</td>";																	
			echo "</tr>";	
			
			$i++;	
		}
?>
		</table>
		<hr>	
	</div>
<?php
	}	
	
	function profile_pics_html($member_array, $page, $number_of_pages, $type) {
		$utilities = new Utilities;	
		echo "<div class='container'>";
		echo "<h1>Profile Pics</h1>";
		echo "<div style='float:left; width:100%;'>";
			echo "PAGE: ";
			$i = 1;
			while($i <= $number_of_pages) {
				if ($page == $i) {
					echo $i." ";
				} else {
					if ($type == "all") {
						echo "<a href='admin.php?page=profile_pics&number=".$i."'>".$i." </a>";						
					} else {
						$month = $_GET['month'];
						$year = $_GET['year'];
						
						echo "<a href='admin.php?page=profile_pics_month&month=".$month."&year=".$year."&number=".$i."'>".$i." </a>";												
					}
				}
				$i++;
			}
		echo "</div>";
		echo "<table class='dark'>";
		foreach($member_array as $row) {
			echo "<tr>";
			echo "<td>".$row['userID']."</td>";		
			echo "<td><a href='admin.php?page=member_details&id=".$row['userID']."'>".$row['lastname'].", ".$$row['firstname']."</a></td>";
			echo "<td><img src='images/profile_pics/".$row['profile_pic']."' height='170' width='170'></td>";	
			echo "</tr>";			
		}
		echo "</table>";
		echo "</div>";
	}
	
	function gallery_pics_html($member_array, $page, $number_of_pages, $type) {
		$utilities = new Utilities;	
		echo "<div class='container'>";
		echo "<h1>Gallery Pics</h1>";
		echo "<div style='float:left; width:100%;'>";
			echo "PAGE: ";
			$i = 1;
			while($i <= $number_of_pages) {
				if ($page == $i) {
					echo $i." ";
				} else {
					if ($type == "all") {
						echo "<a href='admin.php?page=gallery_pics&number=".$i."'>".$i." </a>";						
					} else {
						$month = $_GET['month'];
						$year = $_GET['year'];
						
						echo "<a href='admin.php?page=gallery_pics_month&month=".$month."&year=".$year."&number=".$i."'>".$i." </a>";												
					}
				}
				$i++;
			}
		echo "</div>";

		echo "<table class='dark'>";
		foreach($member_array as $row) {
			if ($row['deleted'] == "Y") {
				$deleted = "Deleted";
				$photo = "<img src='images/gallery_pics/deleted/".$row['photo']."' height='70' width='70'>";								
			} else {
				$deleted = "Live";
				$photo = "<img src='images/gallery_pics/".$row['thumb']."'>";				
			}
			
			echo "<tr>";
			echo "<td>".$row['userID']."</td>";		
			echo "<td><a href='admin.php?page=member_details&id=".$row['userID']."'>".$$row['lastname'].", ".$row['firstname']."</a></td>";
			echo "<td>".$deleted."</td>";					
			echo "<td>".$photo."</td>";	
			echo "</tr>";			
		}
		echo "</table>";
		echo "</div>";
	}	
		
	function videos_html($member_array) {
		$utilities = new Utilities;	
		echo "<div class='container'>";
		echo "<h1>Videos</h1>";
		echo "<table class='dark'>";
		foreach($member_array as $row) {
			echo "<tr>";
			echo "<td>".$row['userID']."</td>";		
			echo "<td><a href='admin.php?page=member_details&id=".$row['userID']."'>".$row['lastname'].", ".$row['firstname']."</a></td>";
			echo "<td>".$row['url']."</td>";	
			echo "</tr>";			
		}
		echo "</table>";
		echo "</div>";
	}	
	
	function user_data_html() {
		echo "<div class='container'>";
		
		echo "<h2>Select your criteria</h2>";
		
		echo "<form method='GET' action='admin.php?page=user_data&type=search&number=1'>";
		echo "Region: <input type='text' id='zip' name='zip'> (zip code, type 'all' for all members) <i>This includes a 40 mile radius</i><br />";
		echo "&nbsp; <br />";
		echo "Skill:  <select name='skill' id='skill'>";
			echo "<option value='all'>All</option>";
			echo "<option value='Server'>Server</option>";
			echo "<option value='Bartender'>Bartender</option>";
			echo "<option value='Kitchen'>Kitchen</option>";
			echo "<option value='Host'>Host</option>";
			echo "<option value='Bus'>Bus</option>";
			echo "<option value='Manager'>Manager</option>";
		echo "</select><br />";
		echo "<input type='hidden' name='page' value='user_data'>";
		echo "<input type='hidden' name='type' value='search'>";		
		echo "<input type='submit'><br />";
		echo "&nbsp; <br />";
		echo "</form>";	
		echo "</div>";	
	}
	
	function user_data_results_html($member_array, $skill, $zip) {
		$admin = new Admin;
		$utilities = new Utilities;
		$member = new Member;
		$page = $_GET['number'];
		if ($page == "") {
			$page = 1;
		}
		
		$total_records = count($member_array);	
		$total_pages = ceil($total_records / 50);
		if ($page == $total_pages) {
			$next = "";
		} else {
			$next_page = $page + 1;
			$next = "<a href='admin.php?zip=".$zip."&skill=".$skill."&page=user_data&type=search&number=".$next_page."'>Next Page</a>";
		}
		
		if ($page == 1) {
			$prev = "";
		} else {
			$prev_page = $page - 1;
			$prev = "<a href='admin.php?zip=".$zip."&skill=".$skill."&page=user_data&type=search&number=".$prev_page."'>Prev Page</a>";
		}
		
		$email_count = 0;
		$deactivated_count = 0;
		foreach($member_array as $row) {
			if ($row['valid'] == 'N') {
				$deactivated_count++;				
			}

			if ($row['email_setting'] == 'N') {
				$email_count++;				
			}			
		}
		
?>		
	<div class="container">
		<h1 style="display:inline;">Member List</h1> &nbsp; &nbsp; <a href="admin.php"><button>Admin Home</button></a><br />	
			<b>Skill: </b><? echo $skill ?>
			<br /> &nbsp; <br />
			Total Records:  <? echo $total_records ?> (<? echo $total_pages ?> pages) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <? echo $prev." | ".$next ?> <br />
			Deactivated = <? echo $deactivated_count ?> <br />
			Email Unsubscribe = <? echo $email_count ?> <br />	
		<table class='dark'>
		<tr><th>Name</th><th>Email</th><th>Skill</th><th>Seeking</th><th>Zip</th><th>Emails</th><th>Active</th></tr>
		
<?php
		
		$i = ($page - 1) * 50;
		$upper = $i + 49;

		if ($upper > $total_records) {
			$upper = $total_records;
		}
		while ($i <= $upper) {	
		
			echo "<tr>";
			echo "<td><a href='admin.php?page=member_details&id=".$member_array[$i]['userID']."'>".$member_array[$i]['lastname'].", ".$member_array[$i]['firstname']."</a></td>";
			echo "<td align='center'>".$member_array[$i]['email']."</td>";
			if ($skill == "all") {
				echo "<td align='center'>NA</td>";				
				echo "<td align='center'>NA</td>";				
			} else {		
				echo "<td align='center'>".$member_array[$i]['skill']."</td>";	
				echo "<td align='center'>".$member_array[$i]['seeking']."</td>";	
			}
			echo "<td align='center'>".$$member_array[$i]['zip']."</td>";																		
			echo "<td align='center'>".$member_array[$i]['email_setting']."</td>";
			echo "<td align='center'>".$member_array[$i]['valid']."</td>";																	
			echo "</tr>";	
			
			$i++;	
		}
?>
		</table>
		<hr>	
	</div>
<?php
	}
	
	function create_employer_html() {
		echo "<div class='container'>";

		echo "<h1>Create new employer</h1>";
?>
		   <input type="hidden" id="access_2" name="access" value="catscradle"/>  
		  <div id="employer-form">
		    <table cellpadding="10" cellspacing="6">
		      <tr>
		        <td align="right" width="140"  style="padding-right: 10px;"><input type="checkbox" id="permission" value="18"></td>
		        <td colspan="2" style="font-size: 11px;"><b>I certify that I represent the company entered below and have the right and/or permission to make hiring decisions or recommendations.</b></td>
		      </tr>		    		    
		      <tr>
		        <td align="right"><B>First Name:</B></td>
		        <td valign="top"><input type="text" id="firstname" name="firstname" size="16" maxlength="16"/></td>	        
		      </tr>
		      <tr>
		        <td align="right"><B>Last Name:</B></td>
		        <td valign="top"><input type="text" id="lastname" name="lastname" size="16" maxlength="16"/></td>	        
		      </tr>
		      <tr>
		        <td align="right"><B>Company:</B></td>
		        <td valign="top"><input type="text" id="company" name="company" size="16" /></td>        
		      </tr> 
		      <tr>
		        <td align="right"><B>Your Title:</B></td>
		        <td valign="top"><input type="text" id="position" name="position" size="16" placeholder="owner, manager, etc" /></td>        
		      </tr>   
		      <tr>
		        <td align="right"><B>Website:</B></td>
		        <td valign="top"><input type="text" id="website" name="website" size="16" placeholder="optional" /></td>        
		      </tr> 
<!--
		      <tr>
		        <td align="right"><B>Phone:</B></td>
		        <td valign="top"><input type="text" id="phone" name="phone" size="16" placeholder="optional" /></td>
		      </tr>                                     		                                          
-->
		      <tr>
		        <td align="right"><B>Email address:</B></td>
		        <td><input type="text" id="login_email" name="login_email" size="30" maxlength="100"/></td>       
		      </tr>
		      <tr>
		        <td align="right"><B>Re-type Email:</B></td>
		        <td><input type="text" id="login_email_retype" name="login_email_retype" size="30" maxlength="100"></td>    
		      </tr>      
		      <tr>
		        <td align="right"><B>Password:</B></td>
		        <td valign "top"><input type="password" id="set_password" name="password" size="16" maxlength="12" placeholder="between 6 and 12 chars"></td>	        
		      </tr>
		      <tr>
		        <td align="right"><B>Re-type Password:</B></td>
		        <td valign "top"><input type="password" id="check_set_password" name="password" size="16" maxlength="12"></td>        
		      </tr>            
		      <tr><td colspan="3" style="font-size: 11px; padding: 10px;" align="center">By clicking "Submit", you agree to the following:</br>  <b><a href="index.php?page=TOS">Terms of Service</a>, <a href="index.php?page=privacy_policy"> Privacy Policy</a></b></td></tr>
		    </table>
		  </div>
		  <div style="margin-bottom:15px; margin-left:150px;"><button id="signup_employer" class="step_button">SUBMIT</button></div>		  
		  <div id="loader" style="display:none; margin-left:125px;"><h2>Loading....</h2> </div>
		</div>
	</div>		
<script>
	$("#signup_employer").unbind('click').click(function() {	
			//alert("here");
			$(".warning").hide();
			$('#signup_employer').hide();
			$('#loader').show();
			if ($('#permission').is(":checked")) {
				var permission = "Y";
			} else {
				var permission = "N";
			}
			var access = $('#access_2').val();
			var first = $('#firstname').val().trim();
			var last = $('#lastname').val();
			var company = $('#company').val();
			var position = $('#position').val();
			var website = $('#website').val();					
			var login_email = $('#login_email').val();
			var login_email_retype = $('#login_email_retype').val();					
			var set_password = $('#set_password').val();
			var check_set_password = $('#check_set_password').val();					
			dataString = "access=" + access + "&first=" + first + "&last=" + last+ "&company=" + company + "&position=" + position + "&website=" + website + "&login=" + login_email + "&pass=" + set_password;
			//alert(dataString);
			if (access.length == 0 || first.length == 0 || last.length == 0 || company.length == 0 || position.length == 0 || login_email.length == 0 || set_password.length == 0) {
				$('#loader').hide();
				$('#signup_employer').show();
				$('#employer_empty_warning').show();
			} else if (set_password.length > 12 || set_password.length < 6) {
				$('#loader').hide();
				$('#signup_employer').show();
				$('#employer_pass_warning').show();
			} else if (set_password != check_set_password) {
				$('#loader').hide();
				$('#signup_employer').show();
				$('#employer_pass_check_warning').show();
			} else if (login_email != login_email_retype) {
				$('#loader').hide();
				$('#signup_employer').show();
				$('#employer_email_retype_warning').show();
			} else if (permission == "N") {
				$('#loader').hide();
				$('#signup_employer').show();			
				$("#permission_warning").show();																																																						
			} else {
				$.ajax({
					type: "POST",
					url: "http://threewhitebirds.com/SBC/ajax/verification.ajax.php?type=register_employer_admin",
					data: dataString,
					success: function(data) {
						alert(data);
					}
				});
			}					
	})
</script>
<?php   
	}	
	
?>