function jobs() {
	$(document).on("click", '#more_jobs', function() {
		$('#more_job_holder').hide();
		$('#login_holder').show();	
				
		return false;
	});	
	
	$(document).on("click", '.job', function() {
		var job_ref = $(this).attr('ID');
		window.location = "https://servebartendcook.com/public_listing_new.php?ID=" + job_ref;				
		return false;
	});		

	$(document).on("click", '#login', function() {
		window.location = "https://servebartendcook.com/?page=login";				
		return false;
	});	

	$(document).on("click", '#employee', function() {
		window.location = "https://servebartendcook.com/?page=employee_signup";				
		return false;
	});	
}

function new_jobs(page, region, position) {
	page = page + 1;
	
	$(document).on("click", '#next_page', function() {
		//alert("HERE")
		if (position != "") {
			position_text = "?position="+position;			
		} else {
			position_text = "?position=all";
		}
		
		if (region != "") {
			region_text = "&region="+region;			
		} else {
			region_text = "&region=all";
		}
		
		window.location = "jobs.php"+position_text+region_text+"&page="+page;				
		return false;
	});	
	
	$(document).on("click", '.job', function() {
		var job_ref = $(this).attr('ID');
		window.location = "https://servebartendcook.com/public_listing_new.php?ID=" + job_ref;				
		return false;
	});		

	$(document).on("click", '#login', function() {
		window.location = "https://servebartendcook.com/?page=login";				
		return false;
	});	

	$(document).on("click", '#employee', function() {
		window.location = "https://servebartendcook.com/?page=employee_signup";				
		return false;
	});	
	
	$(document).on("click", '#show_filters', function() {
		$('#region_holder').hide();
		$('#filter_holder').show();
					
		return false;
	});	

	$(document).on("click", '#cancel_filters', function() {
		$('#filter_holder').hide();
		$('#region_holder').show();
					
		return false;
	});	
	
	$(document).on("click", '#add_filter', function() {
		var position = $('#edit_position').val();
		var region = $('#edit_region').val();

		window.location = "jobs.php?position="+position+"&region="+region;				
					
		return false;
	});	
	
}