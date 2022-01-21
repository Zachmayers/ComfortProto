<?php
	function view_store_html($store_details, $job_list) {
		$member = new Member;
		
		foreach($store_details as $row) {
			$store_name = $row['name'];
			$address = $row['address'];
			$zip = $row['zip'];
			$owner = $row['userID'];
		}
		
		$owner_details = $member->get_user_data("name", $owner);
		
		foreach($owner_details as $row) {
			$name = $row['firstname']." ".$row['lastname'];
		}		
		
?>		

		<h1 style="display:inline;">Store Details</h1> &nbsp; &nbsp; <a href="admin.php"><button>Admin Home</button></a>	
		<br /> &nbsp; <br />
		<hr>	
		<table class='dark'>
<?php	
		echo "<tr>";	
		echo "<td>Name: </td><td>".$store_name."</td>";						
		echo "</tr>";			
	
		echo "<tr>";
		echo "<td>Owner: </td><td>".$name."</td>";	
		echo "</tr>";
		
		echo "<tr>";	
		echo "<td>Address: </td><td>".$address." ".$zip."</td>";						
		echo "</tr>";					
		
?>
		</table>
		<hr>	
		&nbsp; </br>
		<table class="dark">
			<tr>
				<th>Job Title</th>
				<th>Expiration Date</th>
			</tr>
<?php
		if (count($job_list) > 0) {
			foreach($job_list as $row) {
				echo "<tr>";
				echo "<td>".$row['title']."</td>";
				echo "<td>".$row['expiration_date']."</td>";
				echo "</tr>";			
			}
		}
		echo "</table>";
	}//end html_page_main function