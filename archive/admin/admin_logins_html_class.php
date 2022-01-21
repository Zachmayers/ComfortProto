<?php
	function logins_html($logins_array) {
?>		

		<h1 style="display:inline;">Logins - Last 7 days</h1> &nbsp; &nbsp; <a href="admin.php"><button>Admin Home</button></a>	
		<br /> &nbsp; <br />
		<hr>								 
		<table class='dark'>
<?php
		foreach($logins_array as $row) {
			echo "<tr>";
			echo "<td><a href='admin.php?page=view_profile&id=".$row['userID']."'>".$row['firstname']." ".$row['lastname']."</a></td>";
			echo "<td>".$row['login_date']."</td>";			
			echo "</tr>";		
		}
?>
		</table>
		<hr>								 		
<?php
	}//end html_page_main function
	
?>