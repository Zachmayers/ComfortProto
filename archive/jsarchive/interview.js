function interview_menu() {
	
	$(".current").click(function() {
		current_class = $('#current_tab').attr('class');
		
		if (current_class == "unselected_tab") {
			$('#current_tab').removeClass('unselected_tab');
			$('#current_tab').addClass('selected_tab');
			$('#archive_tab').removeClass('selected_tab');
			$('#archive_tab').addClass('unselected_tab');							
		}
		
		$('.current_jobs').show();
		$('.archive_jobs').hide();
		return false;
	});	
	
	$(".archive").click(function() {	
		current_class = $('#archive_tab').attr('class');
		//alert(current_class);	
		
		if (current_class == "unselected_tab") {
			$('#current_tab').addClass('unselected_tab');
			$('#current_tab').removeClass('selected_tab');
			$('#archive_tab').addClass('selected_tab');
			$('#archive_tab').removeClass('unselected_tab');							
		}
		
		$('.archive_jobs').show();
		$('.current_jobs').hide();
		return false;
	});																																														
}


function job_list_mobile() {
		$(".current").click(function() {
			current_class = $('#current_tab').attr('class');
			
			if (current_class == "unselected_tab") {
				$('#current_tab').removeClass('unselected_tab');
				$('#current_tab').addClass('selected_tab');
				$('#archive_tab').removeClass('selected_tab');
				$('#archive_tab').addClass('unselected_tab');							
			}
			
			$('.current_jobs').show();
			$('.archive_jobs').hide();
			return false;
		});	
		
		$(".archive").click(function() {	
			current_class = $('#archive_tab').attr('class');
			//alert(current_class);	
			
			if (current_class == "unselected_tab") {
				$('#current_tab').addClass('unselected_tab');
				$('#current_tab').removeClass('selected_tab');
				$('#archive_tab').addClass('selected_tab');
				$('#archive_tab').removeClass('unselected_tab');							
			}
			
			$('.archive_jobs').show();
			$('.current_jobs').hide();
			return false;
		});																																														


		$("#add-job-button").click(function() {
			$('.job-page').hide();	
			$('.add_button').hide();																			
			$('#add-job-form').show('fast');
			return false;
		});
		
		$("#add-job-submit").click(function() {		
			$("#main_box").hide();	
			$("#loader_box").show();	
			storeID = $('#storeID').attr('value');
			window.location = "job.php?ID=new_job&storeID=" + storeID;
		});		
}