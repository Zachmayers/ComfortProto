<?php

function analyze_data_html($results) {
$distinct_array = $results['distinct'];
$result_array =$results['result'];
?>	
	<div class='container' style="min-height: 550px; color:white">
		<div class='row profile' style="margin-bottom:12px">
			<div class="col-md-12 text-center">
				
				<div class='row profile' style="margin-bottom:12px">
					<div class="col-md-12 text-center">
						<h5>DISTINCT ENTRIES - LEAD COMPLETE FIELD</h5><br />
<?php
						foreach($distinct_array as $row) {
							echo $row['lead_complete']."<br />";
						}
?>
						<h5>COUNTS</h5><br />
<?php
						foreach($distinct_array as $entry) {
							$count = 0;
							foreach($result_array as $row) {
								if ($row['lead_complete'] == $entry['lead_complete']) {
									$count++;
								}
							}
							echo $entry['lead_complete'].":  ".$count."<br />";
						}
?>

<!--
						<h3>Current Data Files</h3>
						<b>Data File A: LMX_CRM<br />
						Number of Entries: <? echo $counts['file_a_count'] ?><br />
						Unique Phone Numbers : <? echo $counts['file_a_phone_count'] ?><br />
						<b>Data File B: FF<br />
						Number of Entries: <? echo $counts['file_b_count'] ?><br />
						Unique Phone Numbers : <? echo $counts['file_b_phone_count'] ?><br />
						&nbsp; <br />
						<a href='data_view.php?view=match_list'>View Matched Data</a><br />
						&nbsp; <br />
-->
												
<!--
						<form class="form-horizontal">
							<div class="form-group">				
								<label for="day" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Day of the Week</label>
									<div class="col-md-12">
										<select class='day form-control'>
											<option value='Monday'>Monday</option>
											<option value='Tuesday'>Tuesday</option>
											<option value='Wednesday'>Wednesday</option>
											<option value='Thursday'>Thursday</option>
											<option value='Friday'>Friday</option>
											<option value='Saturday'>Saturday</option>
											<option value='Sunday'>Sunday</option>
										</select>
									</div>
									
								<label for="lead_status" class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-0 control-label">Lead Status</label>
									<div class="col-md-12">
										<select class='lead_status form-control'>
											<option value='Contacted'>Contacted</option>
											<option value='Not Contacted'>Not Contacted</option>
											<option value='Sold'>Sold</option>
										</select>
									</div>
									
									
							</div>
						</form>
-->
			
			
					</div>
				</div>
			</div>
		</div>

<?php
}	

function auto_report_html($record_count, $advertiser_data, $duplicates, $dupe_count, $payout_duplicates, $revenue_duplicates) {
?>
	<div class='container' style="min-height: 550px; color:white">
		<div class='row profile' style="margin-bottom:12px">
			<div class="col-md-12 text-center">
				<div style='float:left; margin-top:-60px; width:100%'>
					<a href='data_view.php?view=auto_report' class='btn btn-large btn-primary' >Advertiser Report</a>
					<a href='data_view.php?view=campaign_single_report' class='btn btn-large btn-primary' >Campaign Report</a>
					<a href='data_view.php?view=duration_single_report' class='btn btn-large btn-primary' >Duration Report</a>
				</div>				
				
				<div class='row profile' style="margin-bottom:12px">
					<div class="col-md-12 text-center">
						<h3>Report - Advertiser Summary</h3><br />
						<b>Total Record Count = <? echo $record_count ?><br />
						<b>Numbers that have Duplicates = <? echo count($duplicates) ?><br />
						<b>Total Duplicates = <? echo $dupe_count ?><br />
						<b>Payout Duplicates = <? echo count($payout_duplicates) ?><br />
						<b>Revenue Duplicates = <? echo count($revenue_duplicates) ?><br />

						&nbsp; <br />

<?php
						foreach($advertiser_data as $key => $row) {
							$total = $row['over_10']['count'] + $row['over_5']['count'] + $row['over_3']['count'] + $row['over_1_5']['count'] + $row['over_0']['count'];
?>
							<div class="panel panel-default panel-info">
							  <!-- Default panel contents -->
							  <div class="panel-heading" style="color: black"><? echo $key.": ".$total ?></div>
							  <table class="table table-striped thead-dark" style="color: black">
								  <thead>
								    <tr>
								      <th scope="col">Time</th>
								      <th scope="col">Sum of Transferred</th>
								      <th scope="col">Avg Transfer Duration</th>
								      <th scope="col">Payout</th>
								      <th scope="col">Revenue</th>
								    </tr>
								  </thead>
								  <tbody>
								    <tr>
								      <th scope="row">Over 10 mins</th>
								      <td align="left"><? echo $row['over_10']['count'] ?></td>
<?php
										if ($row['over_10']['count'] == 0) {
											echo "<td align='left'>0</td>";
										} else {
											echo "<td align='left'>".$row['over_10']['sum'] / $row['over_10']['count']."</td>";
										}
?>
								      <td align="left" class="table-striped"><? echo $row['over_10']['payout'] ?></td>
								      <td align="left"><? echo $row['over_10']['revenue'] ?></td>
								    </tr>
								    
								    <tr>
								      <th scope="row">5 to 10 mins</th>
								      <td align='left'><? echo $row['over_5']['count'] ?></td>
<?php
										if ($row['over_10']['count'] == 0) {
											echo "<td align='left'>0</td>";
										} else {
											echo "<td align='left'>".$row['over_5']['sum'] / $row['over_5']['count']."</td>";
										}
?>
								      <td align='left'><? echo $row['over_5']['payout'] ?></td>
								      <td align='left'><? echo $row['over_5']['revenue'] ?></td>
								    </tr>

								    <tr>
								      <th scope="row">3 to 5 mins</th>
								      <td align='left'><? echo $row['over_3']['count'] ?></td>
<?php
										if ($row['over_3']['count'] == 0) {
											echo "<td align='left'>0</td>";
										} else {
											echo "<td align='left'>".$row['over_3']['sum'] / $row['over_3']['count']."</td>";
										}
?>
								      <td align='left'><? echo $row['over_3']['payout'] ?></td>
								      <td align='left'><? echo $row['over_3']['revenue'] ?></td>
								    </tr>

								    <tr>
								      <th scope="row">1.5 to 3 mins</th>
								      <td align='left'><? echo $row['over_1_5']['count'] ?></td>
<?php
										if ($row['over_1_5']['count'] == 0) {
											echo "<td align='left'>0</td>";
										} else {
											echo "<td align='left'>".$row['over_1_5']['sum'] / $row['over_1_5']['count']."</td>";
										}
?>
								      <td align='left'><? echo $row['over_1_5']['payout'] ?></td>
								      <td align='left'><? echo $row['over_1_5']['revenue'] ?></td>
								    </tr>

								    <tr>
								      <th scope="row">less than1.5 mins</th>
								      <td align='left'><? echo $row['over_0']['count'] ?></td>
<?php
										if ($row['over_0']['count'] == 0) {
											echo "<td align='left'>0</td>";
										} else {
											echo "<td align='left'>".$row['over_0']['sum'] / $row['over_0']['count']."</td>";
										}
?>
								      <td align='left'><? echo $row['over_0']['payout'] ?></td>
								      <td align='left'><? echo $row['over_0']['revenue'] ?></td>
								    </tr>

								    <tr>
								      <th scope="row">Sum</th>
								      <td align='left'><? echo $total ?></td>
								      <td align='left'> - </td>
								      <td align='left'><? echo $row['over_0']['payout'] + $row['over_1_5']['payout'] + $row['over_3']['payout'] + $row['over_5']['payout'] + $row['over_10']['payout']?></td>
								      <td align='left'><? echo $row['over_0']['revenue'] + $row['over_1_5']['revenue'] + $row['over_3']['revenue'] + $row['over_5']['revenue'] + $row['over_10']['revenue']?></td>
								    </tr>
								    
								  </tbody>
								</table>
							</div>	
<?php
						}
?>
					</div>
				</div>
			</div>
		</div>
<?php
}

function campaign_single_report_html($record_count, $campaign_data, $duplicates, $dupe_count) {
?>
	<div class='container' style="min-height: 550px; color:white">
		<div class='row profile' style="margin-bottom:12px">
			<div class="col-md-12 text-center">
				<div style='float:left; margin-top:-60px; width:100%'>
					<a href='data_view.php?view=auto_report' class='btn btn-large btn-primary' >Advertiser Report</a>
					<a href='data_view.php?view=campaign_single_report' class='btn btn-large btn-primary' >Campaign Report</a>
					<a href='data_view.php?view=duration_single_report' class='btn btn-large btn-primary' >Duration Report</a>
				</div>				
				
				<div class='row profile' style="margin-bottom:12px">
					<div class="col-md-12 text-center">
						<h3>Report - Campaign Summary</h3><br />
						<b>Total Record Count = <? echo $record_count ?><br />
						<b>Numbers that have Duplicates = <? echo count($duplicates) ?><br />
						<b>Total Duplicates = <? echo $dupe_count ?><br />
						&nbsp; <br />

<?php
						foreach($campaign_data as $key => $row) {
							$total = $row['over_10']['count'] + $row['over_5']['count'] + $row['over_3']['count'] + $row['over_1_5']['count'] + $row['over_0']['count'];
?>
							<div class="panel panel-default panel-info">
							  <!-- Default panel contents -->
							  <div class="panel-heading" style="color: black"><? echo $key.": ".$total ?></div>
							  <table class="table table-striped thead-dark" style="color: black">
								  <thead>
								    <tr>
								      <th scope="col">Time</th>
								      <th scope="col">Sum of Transferred</th>
								      <th scope="col">Avg Transfer Duration</th>
								      <th scope="col">Payout</th>
								      <th scope="col">Revenue</th>
								    </tr>
								  </thead>
								  <tbody>
								    <tr>
								      <th scope="row">Over 10 mins</th>
								      <td align="left"><? echo $row['over_10']['count'] ?></td>
<?php
										if ($row['over_10']['count'] == 0) {
											echo "<td align='left'>0</td>";
										} else {
											echo "<td align='left'>".$row['over_10']['sum'] / $row['over_10']['count']."</td>";
										}
?>
								      <td align="left" class="table-striped"><? echo $row['over_10']['payout'] ?></td>
								      <td align="left"><? echo $row['over_10']['revenue'] ?></td>
								    </tr>
								    
								    <tr>
								      <th scope="row">5 to 10 mins</th>
								      <td align='left'><? echo $row['over_5']['count'] ?></td>
<?php
										if ($row['over_10']['count'] == 0) {
											echo "<td align='left'>0</td>";
										} else {
											echo "<td align='left'>".$row['over_5']['sum'] / $row['over_5']['count']."</td>";
										}
?>
								      <td align='left'><? echo $row['over_5']['payout'] ?></td>
								      <td align='left'><? echo $row['over_5']['revenue'] ?></td>
								    </tr>

								    <tr>
								      <th scope="row">3 to 5 mins</th>
								      <td align='left'><? echo $row['over_3']['count'] ?></td>
<?php
										if ($row['over_3']['count'] == 0) {
											echo "<td align='left'>0</td>";
										} else {
											echo "<td align='left'>".$row['over_3']['sum'] / $row['over_3']['count']."</td>";
										}
?>
								      <td align='left'><? echo $row['over_3']['payout'] ?></td>
								      <td align='left'><? echo $row['over_3']['revenue'] ?></td>
								    </tr>

								    <tr>
								      <th scope="row">1.5 to 3 mins</th>
								      <td align='left'><? echo $row['over_1_5']['count'] ?></td>
<?php
										if ($row['over_1_5']['count'] == 0) {
											echo "<td align='left'>0</td>";
										} else {
											echo "<td align='left'>".$row['over_1_5']['sum'] / $row['over_1_5']['count']."</td>";
										}
?>
								      <td align='left'><? echo $row['over_1_5']['payout'] ?></td>
								      <td align='left'><? echo $row['over_1_5']['revenue'] ?></td>
								    </tr>

								    <tr>
								      <th scope="row">less than1.5 mins</th>
								      <td align='left'><? echo $row['over_0']['count'] ?></td>
<?php
										if ($row['over_0']['count'] == 0) {
											echo "<td align='left'>0</td>";
										} else {
											echo "<td align='left'>".$row['over_0']['sum'] / $row['over_0']['count']."</td>";
										}
?>
								      <td align='left'><? echo $row['over_0']['payout'] ?></td>
								      <td align='left'><? echo $row['over_0']['revenue'] ?></td>
								    </tr>

								    <tr>
								      <th scope="row">Sum</th>
								      <td align='left'><? echo $total ?></td>
								      <td align='left'> - </td>
								      <td align='left'><? echo $row['over_0']['payout'] + $row['over_1_5']['payout'] + $row['over_3']['payout'] + $row['over_5']['payout'] + $row['over_10']['payout']?></td>
								      <td align='left'><? echo $row['over_0']['revenue'] + $row['over_1_5']['revenue'] + $row['over_3']['revenue'] + $row['over_5']['revenue'] + $row['over_10']['revenue']?></td>
								    </tr>
								    
								  </tbody>
								</table>
							</div>	
<?php
						}
?>
					</div>
				</div>
			</div>
		</div>
<?php
}

function duration_single_report_html($record_count, $duration_data, $duplicates, $dupe_count) {
?>
	<div class='container' style="min-height: 550px; color:white">
		<div class='row profile' style="margin-bottom:12px">
			<div class="col-md-12 text-center">
				<div style='float:left; margin-top:-60px; width:100%'>
					<a href='data_view.php?view=auto_report' class='btn btn-large btn-primary' >Advertiser Report</a>
					<a href='data_view.php?view=campaign_single_report' class='btn btn-large btn-primary' >Campaign Report</a>
					<a href='data_view.php?view=duration_single_report' class='btn btn-large btn-primary' >Duration Report</a>
				</div>				
				
				<div class='row profile' style="margin-bottom:12px">
					<div class="col-md-12 text-center">
						<h3>Report - Duration Summary</h3><br />
						<b>Total Record Count = <? echo $record_count ?><br />
						<b>Numbers that have Duplicates = <? echo count($duplicates) ?><br />
						<b>Total Duplicates = <? echo $dupe_count ?><br />
						&nbsp; <br />

<?php
							$total = $duration_data['over_10']['count'] + $duration_data['over_5']['count'] + $duration_data['over_3']['count'] + $duration_data['over_1_5']['count'] + $duration_data['over_0']['count'];
?>
							<div class="panel panel-default panel-info">
							  <!-- Default panel contents -->
							  <div class="panel-heading" style="color: black">Duration</div>
							  <table class="table table-striped thead-dark" style="color: black">
								  <thead>
								    <tr>
								      <th scope="col">Time</th>
								      <th scope="col">Sum of Transferred</th>
								      <th scope="col">Avg Transfer Duration</th>
								      <th scope="col">Payout</th>
								      <th scope="col">Revenue</th>
								    </tr>
								  </thead>
								  <tbody>
								    <tr>
								      <th scope="row">Over 10 mins</th>
								      <td align="left"><? echo $duration_data['over_10']['count'] ?></td>
<?php
										if ($duration_data['over_10']['count'] == 0) {
											echo "<td align='left'>0</td>";
										} else {
											echo "<td align='left'>".$duration_data['over_10']['sum'] / $duration_data['over_10']['count']."</td>";
										}
?>
								      <td align="left" class="table-striped"><? echo $duration_data['over_10']['payout'] ?></td>
								      <td align="left"><? echo $duration_data['over_10']['revenue'] ?></td>
								    </tr>
								    
								    <tr>
								      <th scope="row">5 to 10 mins</th>
								      <td align='left'><? echo $duration_data['over_5']['count'] ?></td>
<?php
										if ($duration_data['over_10']['count'] == 0) {
											echo "<td align='left'>0</td>";
										} else {
											echo "<td align='left'>".$duration_data['over_5']['sum'] / $duration_data['over_5']['count']."</td>";
										}
?>
								      <td align='left'><? echo $duration_data['over_5']['payout'] ?></td>
								      <td align='left'><? echo $duration_data['over_5']['revenue'] ?></td>
								    </tr>

								    <tr>
								      <th scope="row">3 to 5 mins</th>
								      <td align='left'><? echo $duration_data['over_3']['count'] ?></td>
<?php
										if ($duration_data['over_3']['count'] == 0) {
											echo "<td align='left'>0</td>";
										} else {
											echo "<td align='left'>".$duration_data['over_3']['sum'] / $duration_data['over_3']['count']."</td>";
										}
?>
								      <td align='left'><? echo $duration_data['over_3']['payout'] ?></td>
								      <td align='left'><? echo $duration_data['over_3']['revenue'] ?></td>
								    </tr>

								    <tr>
								      <th scope="row">1.5 to 3 mins</th>
								      <td align='left'><? echo $duration_data['over_1_5']['count'] ?></td>
<?php
										if ($duration_data['over_1_5']['count'] == 0) {
											echo "<td align='left'>0</td>";
										} else {
											echo "<td align='left'>".$duration_data['over_1_5']['sum'] / $duration_data['over_1_5']['count']."</td>";
										}
?>
								      <td align='left'><? echo $duration_data['over_1_5']['payout'] ?></td>
								      <td align='left'><? echo $duration_data['over_1_5']['revenue'] ?></td>
								    </tr>

								    <tr>
								      <th scope="row">less than1.5 mins</th>
								      <td align='left'><? echo $duration_data['over_0']['count'] ?></td>
<?php
										if ($duration_data['over_0']['count'] == 0) {
											echo "<td align='left'>0</td>";
										} else {
											echo "<td align='left'>".$duration_data['over_0']['sum'] / $duration_data['over_0']['count']."</td>";
										}
?>
								      <td align='left'><? echo $duration_data['over_0']['payout'] ?></td>
								      <td align='left'><? echo $duration_data['over_0']['revenue'] ?></td>
								    </tr>

								    <tr>
								      <th scope="row">Sum</th>
								      <td align='left'><? echo $total ?></td>
								      <td align='left'> - </td>
								      <td align='left'><? echo $duration_data['over_0']['payout'] + $duration_data['over_1_5']['payout'] + $duration_data['over_3']['payout'] + $duration_data['over_5']['payout'] + $duration_data['over_10']['payout']?></td>
								      <td align='left'><? echo $duration_data['over_0']['revenue'] + $duration_data['over_1_5']['revenue'] + $duration_data['over_3']['revenue'] + $duration_data['over_5']['revenue'] + $duration_data['over_10']['revenue']?></td>
								    </tr>
								    
								  </tbody>
								</table>
							</div>	
					</div>
				</div>
			</div>
		</div>
<?php
}

function verify_data_html() {
?>	
	<div class='container' style="min-height: 550px">
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-12 text-center">

			</div>	
		</div>
	</div>
<?php
}


function match_list_html($match_list) {
?>	
	<div class='container' style="min-height: 550px">
<?php
	echo var_dump($match_list);
	foreach($match_list as $row) {
		$ff = $row['ff'];
		$lm = $row['lm'];
?>		
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-12 text-center">

			</div>	
		</div>
<?php
	}
?>				
	</div>
<?php
}

function lead_type_html($summary_data) {
?>	
	<div class='container' style="min-height: 550px">
<?php
	echo var_dump($summary_data);
	foreach($summary_data as $row) {
?>		
		<div class='row' style="margin-bottom:12px">
			<div class="col-md-12 text-center">

			</div>	
		</div>
<?php
	}
?>				
	</div>
<?php

}
