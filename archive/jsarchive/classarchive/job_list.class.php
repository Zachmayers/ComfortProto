<?php
require_once('mysqldb.class.php');	
require_once('job.class.php');	
require_once('utilities.class.php');	

class JobList {

	public $userID;
	
	function __construct($userID) {
		$this->jobID = $userID;
	}
	
	function get_job_list() {
		$utilities = new Utilities;
		
		$current_jobs = $this->get_jobs("current");
		$archive_jobs = $this->get_jobs("archive");

		$current_bounty = $this->get_jobs("current_bounty");
		$current_lite = $this->get_jobs("current_lite");
		
		//create a separate category of floating jobs
		//these are expired jobs that are less than a week old
		//employers will want to access these for applications and interviews
		$float_jobs = $this->get_jobs("float");

		$float_bounty = $this->get_jobs("float_bounty");
		$float_lite = $this->get_jobs("float_lite");
		

		$job_list = array("current" => $current_jobs, 
									"archive" => $archive_jobs,
									"float" => $float_jobs,
									"current_bounty" => $current_bounty,
									"current_lite" => $current_lite,
									"float_bounty" => $float_bounty,
									"float_lite" => $float_lite);
		
		array_walk_recursive($job_list, array($utilities, "makeSafe"));

		return $job_list;		
	}
	
	function get_job_list_by_group() {
		//get current jobs by groupID, float jobs, and incomplete jobs
		
		//we need to start by getting jobs then sorting them into groups, becasause they have expiration dates and groups do not
		$all_current_jobs = $this->get_jobs("current");
		$float_jobs = $this->get_jobs("float");

		$current_groups = array();
		$float_groups = array();
		
		$current_count = $float_count = $incomplete_count = 0;
		
		//get groups associated with jobs
		if (count($all_current_jobs) > 0) {
			foreach($all_current_jobs as $row) {
				if (!in_array($row['groupID'], $current_groups) && $row['groupID'] != 0) {
					$current_groups[] = $row['groupID'];
				}
			}
		}

		if (count($float_jobs) > 0) {
			foreach($float_jobs as $row) {
				if (!in_array($row['groupID'], $float_groups) && $row['groupID'] != 0) {
					$float_groups[] = $row['groupID'];
				}
			}
		}
		
				
		//separate current jobs into complete and incomplete
		$complete_current_jobs = array();
		$incomplete_current_jobs = array();
		
		foreach($all_current_jobs as $row) {
			if ($row['job_status'] == "Open" || $row['job_status'] == "Filled") {
				$complete_current_jobs[] = $row;
				$current_count++;
			} else {
				$incomplete_current_jobs[] = $row;
				$incomplete_count++;
			}
		}
		
		//resource heavy but necessary
		//get group details
		$final_current_array = array();
		$final_float_array = array();
		$final_incomplete_array = array();
		if (count($current_groups) > 0) {
			foreach($current_groups as $row) {
				$group_details = $this->get_group_details($row);
				$current_row = array();
				if (count($complete_current_jobs) > 0) {
					foreach ($complete_current_jobs as $job) {
						if ($job['groupID'] == $row) {
							$current_row[] = $job;
						}
					}
				}
				
				$final_current_array[] = array("group_details" => $group_details, "group_jobs" => $current_row);
			}
		}


		if (count($float_groups) > 0) {
			foreach($float_groups as $row) {
				$group_details = $this->get_group_details($row);
				$current_row = array();
				if (count($float_jobs) > 0) {
					foreach ($float_jobs as $job) {
						if ($job['groupID'] == $row) {
							$current_row[] = $job;
							$float_count++;
						}
					}
				}
				
				$final_float_array[] = array("group_details" => $group_details, "group_jobs" => $current_row);
			}
		}


		if (count($current_groups) > 0) {
			foreach($current_groups as $row) {
				$group_details = $this->get_group_details($row);
				$current_row = array();
				if (count($incomplete_current_jobs) > 0) {
					foreach ($incomplete_current_jobs as $job) {
						if ($job['groupID'] == $row) {
							$current_row[] = $job;
						}
					}
				}
				
				if ($group_details['post_status'] == "draft") {
					$final_incomplete_array[] = array("group_details" => $group_details, "group_jobs" => $current_row);				
				}
			}
		}		

		return array("current_jobs" => $final_current_array, 
							"float_jobs" => $final_float_array, 
							"incomplete_jobs" => $final_incomplete_array,
							"current_count" => $current_count,
							"float_count" => $float_count,
							"incomplete_count" => $incomplete_count);
	}
	
	
	function get_jobs($type) {
		$database = new Database;
		$utilities = new Utilities;
		
		switch($type) {
			case "current":
				$database->query("SELECT * FROM jobs, stores
											WHERE jobs.userID = :userID
											AND jobs.expiration_date > NOW()
											AND jobs.storeID = stores.storeID
											ORDER BY jobs.expiration_date DESC");
				$database->bind(':userID', $_SESSION['userID']);			
				$result = $database->resultset();
			break;
			
			case "archive":
				$database->query("SELECT * FROM jobs, stores
											WHERE jobs.userID = :userID
											AND (jobs.job_status = :open OR jobs.job_status = :filled)
											AND jobs.expiration_date BETWEEN NOW() - INTERVAL 365 DAY AND NOW() - INTERVAL 3 DAY 
											AND jobs.storeID = stores.storeID
											ORDER BY jobs.expiration_date DESC");	
				$database->bind(':userID', $_SESSION['userID']);			
				$database->bind(':open', "Open");			
				$database->bind(':filled', "Filled");			
				$result = $database->resultset();											
			break;				
			
			case "archive_lite":
				$database->query("SELECT * FROM jobs, stores
											WHERE jobs.userID = :userID
											AND jobs.post_type != :post_type
											AND jobs.expiration_date BETWEEN NOW() - INTERVAL 365 DAY AND NOW() - INTERVAL 3 DAY 
											AND jobs.storeID = stores.storeID
											ORDER BY jobs.expiration_date DESC");	
				$database->bind(':post_type', 'bounty');										
				$database->bind(':userID', $_SESSION['userID']);			
				$result = $database->resultset();											
			break;	
			
			case "archive_bounty":
				$database->query("SELECT * FROM jobs, stores
											WHERE jobs.userID = :userID
											AND jobs.post_type = :post_type
											AND jobs.expiration_date BETWEEN NOW() - INTERVAL 365 DAY AND NOW() - INTERVAL 14 DAY 
											AND jobs.storeID = stores.storeID
											ORDER BY jobs.expiration_date DESC");	
				$database->bind(':post_type', 'bounty');										
				$database->bind(':userID', $_SESSION['userID']);			
				$result = $database->resultset();											
			break;				
			
			
			case "current_bounty":
				$database->query("SELECT * FROM jobs, stores
											WHERE jobs.userID = :userID
											AND jobs.post_type = :post_type
											AND jobs.expiration_date > NOW()
											AND jobs.storeID = stores.storeID
											ORDER BY jobs.expiration_date DESC");
				$database->bind(':post_type', 'bounty');										
				$database->bind(':userID', $_SESSION['userID']);			
				$result = $database->resultset();
			break;	
			
			case "current_lite":
				$database->query("SELECT * FROM jobs, stores
											WHERE jobs.userID = :userID
											AND jobs.post_type != :post_type
											AND jobs.expiration_date > NOW()
											AND jobs.storeID = stores.storeID
											ORDER BY jobs.expiration_date DESC");
				$database->bind(':post_type', 'bounty');										
				$database->bind(':userID', $_SESSION['userID']);			
				$result = $database->resultset();
			break;				
								
			case "float":
				$database->query("SELECT * FROM jobs, stores
											WHERE jobs.userID = :userID
											AND jobs.expiration_date BETWEEN NOW() - INTERVAL 4 DAY AND NOW()
											AND jobs.storeID = stores.storeID
											AND jobs.job_status = :job_status
											ORDER BY jobs.expiration_date DESC");	
				$database->bind(':userID', $_SESSION['userID']);			
				$database->bind(':job_status', 'Open');			
				$result = $database->resultset();
			break;
			
			case "float_bounty":
				$database->query("SELECT * FROM jobs, stores
											WHERE jobs.userID = :userID
											AND jobs.post_type = :post_type
											AND jobs.expiration_date BETWEEN NOW() - INTERVAL 15 DAY AND NOW()
											AND jobs.storeID = stores.storeID
											ORDER BY jobs.expiration_date DESC");
				$database->bind(':post_type', 'bounty');																						
				$database->bind(':userID', $_SESSION['userID']);			
				$result = $database->resultset();
			break;												

			case "float_lite":
				$database->query("SELECT * FROM jobs, stores
											WHERE jobs.userID = :userID
											AND jobs.post_type != :post_type
											AND jobs.expiration_date BETWEEN NOW() - INTERVAL 4 DAY AND NOW()
											AND jobs.storeID = stores.storeID
											ORDER BY jobs.expiration_date DESC");
				$database->bind(':post_type', 'bounty');																						
				$database->bind(':userID', $_SESSION['userID']);			
				$result = $database->resultset();
			break;																											
		}

		//GET CANDIDATE AND REACH COUNTS FOR EACH JOB & DETERMINE WHETHER LITE JOB OR NOT
		foreach($result as $key => $row) {
			if ($row['job_status'] == "Open" || $row['job_status'] == "Filled") {
				$job = new Job($row['jobID']);
				$job_data = $job->get_job_data(array('new_view_count', 'positive_count'));

				//get job responses from the archive table
				//jobs over 90 days old will not have accurate data from the above method
				//leave above method for legacy functions that may exist
				$archived_responses = $job->get_archive_responses();
				$archived_count = count($archived_responses);

				//$reach_array = $job_data['candidate_count'];
				$views_array = $job_data['new_view_count'];
				$positive_array = $job_data['positive_count'];

				//$result[$key]['reach'] = $reach_array;
				$result[$key]['views'] = $views_array;
				$result[$key]['positive'] = $positive_array;
				$result[$key]['archived_responses'] = $archived_count;				
				
				//determine whther job is a Lite Job (non-paid)
				//only note this if the job is from an active region
				
			} else {
				//$result[$key]['reach'] = 0;
				$result[$key]['views'] = 0;
				$result[$key]['positive'] = 0;
				//$result[$key]['negative'] = 0;
				//$result[$key]['lite_post'] = "N";
			}			
		}
		return $result;
	}
	
	function get_archive_groups() {
		$database = new Database;

		$database->query("SELECT * FROM group_post, stores
									WHERE group_post.userID = :userID
									AND group_post.post_status = :post_status
									AND group_post.date_posted BETWEEN NOW() - INTERVAL 396 DAY AND NOW() - INTERVAL 28 DAY
									AND group_post.storeID = stores.storeID
									ORDER BY group_post.date_posted DESC");
		$database->bind(':post_status', 'posted');																						
		$database->bind(':userID', $_SESSION['userID']);			
		$result = $database->resultset();
		
		//get receipts for stores that have receipts
		if (count($result) > 0) {
			foreach($result as $key => $row) {
				if ($row['region_status'] == "paid") {
					//get receiptID
					$database->query('SELECT * FROM stripe_payment WHERE groupID = :groupID');
					$database->bind(':groupID', $row['groupID']);
					$payment_data = $database->single();
					$result[$key]['receiptID'] = $payment_data['paymentID'];
				}
			}
		}
		
		return $result;
	}
	
	function filter_current_jobs_by_store($storeID, $type) {
		$current_jobs = $this->get_jobs('current');

		$store_jobs_array = array();
		if (count($current_jobs) > 0) {
			foreach ($current_jobs as $row) {
				if ($row['storeID'] == $storeID) {
					$store_jobs_array[] = $row;					
				}
			}
		}

		if ($type == "list") {
			return $store_jobs_array;
		} elseif ($type == "count") {
			return count($store_jobs_array);
		} elseif ($type == "open_count") {
			$count = 0;
			foreach($store_jobs_array as $row) {
				if($row['job_status'] == "Open") {
					$count++;
				}
			}
			return $count;
		}
	}
	
	function get_lite_jobs() {
		$utilities = new Utilities;
		$database = new Database;

		$database->query("SELECT jobs.jobID, jobs.title, jobs.expiration_date, stores.zip FROM jobs, stores
									WHERE jobs.userID = :userID
									AND stores.storeID = jobs.storeID
									AND jobs.expiration_date >= NOW()
									AND jobs.post_type != :post_type
									AND jobs.job_status = :job_status
									ORDER BY jobs.expiration_date DESC");	
									
		$database->bind(':userID', $_SESSION['userID']);			
		$database->bind(':post_type', 'bounty');			
		$database->bind(':job_status', 'open');			
		$result = $database->resultset();

		$lite_job_list = array();
		//filter the result for jobs posted in low activity regions
		if (count($result) > 0) {
			foreach($result as $row) {
				$region_status = $utilities->determine_region_status($row['zip']);
				if ($region_status == "bounty") {
					$lite_job_list[] = $row;
				}
			}
		}

		return $lite_job_list;											
	}
	
	function get_group_jobs($groupID){
		$database = new Database;
		$database->query("SELECT * FROM jobs
									WHERE userID = :userID
									AND groupID = :groupID");	
									
		$database->bind(':userID', $_SESSION['userID']);			
		$database->bind(':groupID', $groupID);			
		$result = $database->resultset();
		
		return $result;
	}

	function get_group_store($groupID){
		$database = new Database;
		$database->query("SELECT * FROM jobs, stores
									WHERE jobs.groupID = :groupID
									AND jobs.userID = :userID
									AND stores.storeID = jobs.storeID");	
									
		$database->bind(':userID', $_SESSION['userID']);			
		$database->bind(':groupID', $groupID);			
		$result = $database->resultset();
		
		return $result;
	}	
	
	function get_group_details($groupID) {
		//return details for job post
		$database = new Database;
		
		if ($groupID > 0) {
			$database->query("SELECT * FROM group_post WHERE groupID = :groupID AND userID = :userID");	
			$database->bind(':groupID', $groupID);
			$database->bind(':userID', $_SESSION['userID']);
			$result = $database->single();	
		} else {
			$result = "error";
		}
		
		if ($result['userID'] != $_SESSION['userID']) {
			$result = "error";
		}
		
		return $result;
	}
	
}
