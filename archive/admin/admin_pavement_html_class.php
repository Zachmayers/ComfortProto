<?php
	function main_pavement_html($list_array) {
?>		
		<h2 style="text-align: center">SBC Pavement Portal</h2>
			
		<h4 style="text-align: center">Version 0.9</h4>	
			<div style="margin-left: 10px; margin-right: 5px; float:left; width:100%">
				<div style="float:left; width:100%;margin-top: 25px; margin-bottom: 25px;">
					<h2>REGIONAL LISTS</h2>
					<div style="float:left; width:100%; margin-left:5px; margin-top: 5px; margin-bottom: 25px;">
<?php
						if (count($list_array) > 0) {
							foreach($list_array as $row) {
								echo "<a href='admin_pavement.php?page=list&regionID=".$row['regionID']."'>".$row['city']." - ".$row['region']."</a><br />";
							}
						} else {
							echo "<i>No current lists.</i>";			
						}
?>
					</div>
				</div>
			</div>
		<hr>								 
<?php
	}//end html_page_main function
	
	function pavement_list_html($list_details) {
		
		echo "<h2>".$list_details['city']." - ".$list_details['region']."</h2>";
		echo "&nbsp; <br />";
		echo "<hr><br />";

		foreach($list_details['list_array'] as $row) {
			if ($row['open'] == "N") {
				$complete = "<font color='red'>COMPLETE</font> - ";
			} else {
				$complete = "";
			}
			echo "<h4 style='margin-top:0px;'>".$complete."<a href='admin_pavement.php?page=store&storeID=".$row['storeID']."'>".$row['name']."</a></h4><br />";
		}
		
	}
	
	function pavement_store_html($details) {
?>		
	<div style="float:left">
		<div style="float:left; width:400px;" id="employer_signup_box">
			<h1 style="text-align:center">Employer Sign-Up</h1>
<?php
	if ($details['open'] != 'N') {
?>				
			<span style="font-family: 'Nothing You Could Do', cursive; text-align:center;"><h2>Hiring for your business?</h2></span>	

		  <div id="empty_warning" class="warning" style="display:none; width:100%; text-align:center;"><font color="red"><b>NOTICE: Please complete required fields</b></font></div>
		  <div id="employer_duplicate_warning" class="warning" style="display:none; width:100%; text-align:center;"><font color="red"><b>NOTICE: Email already being used</b></font></div>
		  <div id="employer_email_warning" class="warning" style="display:none; width:100%; text-align:center;"><font color="red"><b>NOTICE: Invalid email address</b></font></div>
		  <div id="login_warning" class="warning" style="display:none; width:100%; text-align:center;"><font color="red"><b>WARNING: YOU MUST LOG OUT OF THE LAST ACCOUNT</b></font></div>
	
		   <input type="hidden" id="access_2" name="access" value="catscradle"/>  
		  <div id="employer-form">
		    <table cellpadding="10" cellspacing="6">
		      <tr>
		        <td align="right"><B>First Name:</B></td>
		        <td valign="top"><input type="text" id="firstname" name="firstname" size="16" maxlength="16"/></td>	        
		      </tr>
		      <tr>
		        <td align="right"><B>Last Name:</B></td>
		        <td valign="top"><input type="text" id="lastname" name="lastname" size="16" maxlength="16"/></td>	        
		      </tr>
		      <tr>
		        <td align="right"><B>Title:</B></td>
		       <td valign="top"> <select id="position">
			       <option value="Manager">Manager</option>
			       <option value="Assistant Manager">Assistant Manager</option>
			       <option value="General Manager">General Manager</option>
			       <option value="Bar Manager">Bar Manager</option>
			       <option value="Kitchen Manager">Kitchen Manager</option>
			       <option value="Other">Other</option>
		        </select>  </td> 
		      </tr>   
		      <tr>
		        <td align="right"><B>Email Address:</B></td>
		        <td><input type="text" id="email" name="email" size="30" maxlength="100"/></td>       
		      </tr>
		    </table>
		  </div>
		  <div style="margin-bottom:15px; margin-left:150px;"><button id="pavement_employer" class="step_button">SUBMIT</button></div>		  
		  <div id="loader" style="display:none; margin-left:125px;"><h2>Loading....</h2> </div>
		</div>  
		
		<div id='employer_complete' style="float:left; width:400px; display:none;">
			<h1 style="text-align:center">Employer Sign-Up Complete!</h1>
			<h2 style="text-align:center">Email Sent</h2>
		</div>
<?php		
	}
		echo "<div class='add_store_form'>";		
			echo "<div style='width:600px; float:left'>";
			echo "<b>Temporary Password:</b> ".$details['temp_pass']."<br />";
				echo "<div style='width:50%; margin-right:10px; float:left;'>";
					echo "<table style='color:#760006; width:100%'>";
						echo "<tr>";
							echo "<td><b>Store Name: &nbsp; </b></td>";
							echo "<td>".$details['name']."</td>";
						echo "</tr>";
							echo "<td><b>Street Address: &nbsp;</b></td>";
							echo "<td>".$details['address']."</td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td><b>Zip Code: &nbsp; </b></td>";
							echo "<td>".$details['zip']."</td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td><b>Business Type: &nbsp; </b></td>";
							echo "<td>".$details['description']."</td>";
						echo "</tr>";
					echo "</table>";
				echo "</div>";

				echo "<div style='width:40%; float:left;'>";
					echo "<table style='color:#760006; width:100%'>";					
						echo "<tr>";
							echo "<td><b>Website: &nbsp;</b></td>"; 
							echo "<td>".$details['website']."</td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td><b>Facebook: &nbsp;</b></td>"; 
							echo "<td>".$details['facebook']."</td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td><b>Twitter: &nbsp;</b></td>"; 
							echo "<td>".$details['twitter']."</td>";
						echo "</tr>";									
					echo "</table>";
				echo "</div>";
				echo "<input type='hidden' id='storeID' value='".$details['storeID']."'></input>";
				echo "<input type='hidden' id='regionID' value='".$details['regionID']."'></input>";
		echo "</div>";	
		
?>		
<script>
		$(document).on("click", '#pavement_employer', function() {
			storeID = $("#storeID").val();
			first_name = encodeURIComponent($("#firstname").val().trim());
			last_name = encodeURIComponent($("#lastname").val().trim());
			position = encodeURIComponent($("#position").val().trim());
			email = encodeURIComponent($("#email").val().trim());
			regionID = $("#regionID").val();
			
			if (first_name.length == 0 || last_name.length == 0 || email.length == 0) {
				$('#empty_warning').show();
			} else {	
				$('#employer_signup_box').hide();
				$('.add_store_form').hide();
				$('.warning').hide();
				dataString = "storeID=" + storeID + "&first_name=" + first_name + "&last_name=" + last_name + "&position=" + position +
									"&email=" + email;
									//alert(dataString);
				$.ajax({
					type: "POST",
					url: "admin_pavement.php?page=pavement_ajax",
					data: dataString,
					success: function(data) {					
						//alert(data);
						if (data == "email") {
							$('#employer_signup_box').show();							
							$('.add_store_form').show();
							$('#employer_email_warning').show();
							window.scrollTo(0, 0);
						} else if (data == "duplicate") {
							$('#employer_signup_box').show();							
							$('.add_store_form').show();
							$('#employer_duplicate_warning').show();
							window.scrollTo(0, 0);
						} else if (data == "login") {
							$('#employer_signup_box').show();							
							$('.add_store_form').show();
							$('#login_warning').show();
							window.scrollTo(0, 0);							
						} else if (data == "Yes") {
							//change this to splash page
							//window.location = "job.php?ID=new_job";
							//$('#employer_signup_box').hide();
							$('#employer_complete').show();
							$('.add_store_form').show();
						} 						
					}
				});	
			}				
			return false;
		});	
		
		$(document).on("click", '#delete', function() {
			storeID = $("#storeID").val();
			regionID = $("#regionID").val();

			dataString = "storeID=" + storeID;

			$.ajax({
				type: "POST",
				url: "admin_stats.php?page=pavement_ajax&type=delete_store",
				data: dataString,
				success: function(data) {
					//alert(data);
					window.location = "admin_stats?page=pavement_list&type=list&regionID=" + regionID;
				}
			});	
			return false;
		});		
</script>
<?php		
	}	