<? //used for the sample submisstion of XML format jobs
	
require_once('classes/mysqldb.class.php');	
require_once('classes/utilities.class.php');	

$database = new Database;
$database->query('SELECT * FROM jobs, stores WHERE jobs.storeID = stores.storeID
								AND jobs.job_status = :job_status
								AND jobs.post_type = :post_type
								AND jobs.expiration_date > :date
								ORDER BY jobs.date_created DESC');
$database->bind(':post_type', 'bounty');
$database->bind(':job_status', 'Open');
$database->bind(':date', '2017-01-23 00:00:00');

$result = $database->resultset();

echo "ADD VERSION AND ENCODING HERE!!!!!!<br/>";

echo htmlspecialchars("<source>");
echo "<br />";
echo htmlspecialchars("<publisher>ServeBartendCook</publisher>");
echo "<br />";
echo htmlspecialchars("<publisherurl>https://servebartendcook.com</publisherurl>");
echo "<br />";
echo htmlspecialchars("<lastBuildDate>Wed, 18 Jan 2017 22:49:39 GMT</lastBuildDate>");
echo "<br />";

	foreach($result as $row) {
		
		$date = date('D, j M Y h:i:s e', strtotime($row['date_created']));

		$url = "http://servebartendcook.com/public_listing_new.php?ID=".$row['jobID']."&ref=".$row['public_hash'];
		
		$utilities = new Utilities;
		$city_state = $utilities->get_city_state($row['zip']);
		$city = $city_state['city'];
		$state = $city_state['state'];
		
		//get sub_skills
		$database->query('SELECT * FROM jobs_sub_specialties WHERE jobID = :jobID');
		$database->bind(':jobID', $row['jobID']);
		$sub_skills = $database->resultset();
		
		$database->query('SELECT * FROM job_requirements WHERE jobID = :jobID');
		$database->bind(':jobID', $row['jobID']);
		$requirements = $database->resultset();

		//$requirements = $row['requirements'];
		
		$description = "SKILLS REQUIRED: ";
		if (count($sub_skills) > 0) {
			foreach ($sub_skills as $skill) {
				$description .= $skill['sub_specialty'].", ";
			}
		} else {
			$description .= "  None <br />";
		}
		
		if (count($requirements) > 0) {
			$description .= "OTHER REQUIREMENTS: ";
			foreach ($requirements as $req) {
				$description .= $req['requirement']." ";
			}
		} 
		
		if ($row['description'] != "") {
			$description .= $row['jobs.description'];
		}
		
		
		$compensation = "";
		switch($row['comp_type']) {
			default:
				$compensation = $row['comp_type'];
			break;
			
			case "Hourly":
				$compensation = "$".$row['comp_value']."/hr";
			break;
			
			case "Salary":
				$compensation = "Salary:  $".$row['comp_valeu']."/year";
			break;				
		}		
echo htmlspecialchars("<job>");
echo "<br />";		
echo htmlspecialchars("<title><![CDATA[".$row['title']."]]></title>");
echo "<br />";
echo htmlspecialchars("<date><![CDATA[".$date."]]></date>");
echo "<br />";
echo htmlspecialchars("<referencenumber><![CDATA[".$row['jobID']."]]></referencenumber>");
echo "<br />";
echo htmlspecialchars("<url><![CDATA[".$url."]]></url>");
echo "<br />";
echo htmlspecialchars("<company><![CDATA[".$row['name']."]]></company>");
echo "<br />";
echo htmlspecialchars("<city><![CDATA[".$city."]]></city>");
echo "<br />";
echo htmlspecialchars("<state><![CDATA[".$state."]]></state>");
echo "<br />";
echo htmlspecialchars("<country><![CDATA[US]]></country>");
echo "<br />";
echo htmlspecialchars("<postalcode><![CDATA[".$row['zip']."]]></postalcode>");
echo "<br />";
echo htmlspecialchars("<description><![CDATA[".$description."]]></description>");
echo "<br />";
echo htmlspecialchars("<salary><![CDATA[".$compensation."]]></salary>");
echo "<br />";
echo htmlspecialchars("<jobtype><![CDATA[".$row['schedule']."]]></jobtype>");
echo "<br />";
echo htmlspecialchars("</job>");
echo "<br />";
	}
echo htmlspecialchars("</source>");	
?>
