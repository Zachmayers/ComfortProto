function job_list_employer() {
	
	$(".repost").click(function() {
		var old_groupID = $(this).attr("ID");

		$(".archive_jobs").hide();
		$(".loader").show();
		dataString = "old_groupID=" + old_groupID + "&jobID=new";
			$.when(send_ajax(dataString, "ajax/job.ajax.php?type=repost_group", "NA")).done(function(data){
				if (data != "error") {
					window.location = "job.php?ID=new_job&page=templates&groupID="+ data;							
				} else {
					$(".loader").hide();					
					$(".archive_jobs").show();
				}
			});											
		return false;
	})																																										
}