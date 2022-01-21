function public_job(jobID, public_hash) {
	$(document).on("click", '#more', function() {
		$('.description').show('fast');	
		$('#visible_description').hide();
		$('#more').hide();			
		return false;
	})

	$(document).on("click", '#less', function() {
		$('.description').hide('fast');	
		$('#visible_description').show();
		$('#more').show();		
		return false;	
	})	

/*
	$(document).on("click", '#apply', function() {
		window.location = "index.php?page=employee_signup&ID=" + jobID + "&ref=" + public_hash;			
		return false;	
	})	
*/
	
	$(document).on("click", '#apply', function() {
		$('.apply_details').show();
		$('.job_details').hide();
		$('.job_details_large').hide()	
		
		return false;	
	})	
	
	$(document).on("click", '#cancel_apply', function() {
		$('.apply_details').hide();
		$('.job_details').show();
		$('.job_details_large').show()	
		
		return false;	
	})		
	
	$(document).on("click", '#cancel_apply_2', function() {
		$('.upload_resume').hide();
		$('.job_details').show();
		$('.job_details_large').show()	
		
		return false;	
	})		
	
		
	$(document).on("click", '#resume', function() {
		$('.apply_details').hide();
		$('.upload_resume').show();
		return false;	
	})		

	$(document).on("click", '#save_resume', function() {
		ID = $('#jobID').val();
		var resume = $('#resume_file').val();
		var fileExtension = ['pdf'];
		
		first_name = $('.edit_first_name').val().trim();
		last_name = $('.edit_last_name').val().trim();
		email = $('.edit_email').val().trim();
		experience = $('.edit_experience').val().trim();

		raw_phone = $('.edit_phone').val().trim();	
		contact_phone = raw_phone.replace(/[^\d.]/g, "");
		var question_count = $('#question_count').val();

		switch(question_count) {
			case "0":
				questionID_1="NA";
				questionID_2="NA";
				questionID_3="NA";								
			break;
			
			case "1":
				questionID_1=$("#questionID_1").val();
				questionID_2="NA";
				questionID_3="NA";								
			break;
			
			case "2":
				questionID_1=$("#questionID_1").val();
				questionID_2=$("#questionID_2").val();
				questionID_3="NA";								
			break;
			
			case "3":
				questionID_1=$("#questionID_1").val();
				questionID_2=$("#questionID_2").val();
				questionID_3=$("#questionID_3").val();								
			break;							
		}
		
			if (questionID_1 != "NA") {
				answer_1 = $("#answer_1").val().trim();
				//alert(answer_1);
				if (answer_1.length == 0) {
					empty_check = "empty";
				}
			} else {
				answer_1 = "";
			}
			
			if (questionID_2 != "NA") {
				answer_2 = $("#answer_2").val().trim();
				if (answer_2.length == 0) {
					empty_check = "empty";
				}
			} else {
				answer_2 = "";
			}
			
			if (questionID_3 != "NA") {
				answer_3 = $("#answer_3").val().trim();
				if (answer_3.length == 0) {
					empty_check = "empty";
				}
			} else {
				answer_3 = "";
			}
		
		if (resume == "") {
			$('#file_empty_warning').show();
			window.scrollTo(0, 0);			
		 } else if ($.inArray($('#resume_file').val().split('.').pop().toLowerCase(), fileExtension) == -1) {
			$('#file_type_warning').show();		            	
			window.scrollTo(0, 0);			
		} else if (first_name.length == 0 || last_name.length == 0 ) {
			$('#name_empty_warning').show();	
			$('.name_form').addClass('has-error');
			window.scrollTo(0, 0);			
		} else if (email.length == 0 ) {
			$('#email_empty_warning').show();	
			$('.email_form').addClass('has-error');								
			window.scrollTo(0, 0);			
		} else if (contact_phone.length != 10)	 {
			$('#phone_empty_warning').show();	
			$('.phone_form').addClass('has-error');
			window.scrollTo(0, 0);			
		} else {
		    dataString = "jobID=" + jobID + "&first_name=" + encodeURIComponent(first_name) + "&last_name=" 
		    + encodeURIComponent(last_name)+"&phone=" + encodeURIComponent(contact_phone)
		    + "&email=" + encodeURIComponent(email) + "&experience=" + experience + "&questionID_1=" + questionID_1 + 
									"&answer_1=" + encodeURIComponent(answer_1) + "&questionID_2=" + questionID_2 + 
									"&answer_2=" + encodeURIComponent(answer_2) +"&questionID_3=" + questionID_3 + 
									"&answer_3=" + encodeURIComponent(answer_3);
			$.when(send_ajax(dataString, "ajax/resume.ajax.php?type=add_resume", "")).done(function(data){
				//alert(data);
				if (data != "N") {
					$("#resume_upload_button").click();
					return false;					
				}
			});																						
			//write to db get tempid
			//trigger upload
		}
		
		return false;	
	})		
	
	$("#resume_file").change(function(){	
			    input = this;
			    //alert(input.files);
				if (input.files && input.files[0]) {
					if (input.files[0].size > 5000000) {
						$("#file_size_warning").show();	
					} else if (input.files[0].type == "application/pdf") {
						return false;
					} else {
						$("#file_type_warning").show();	
					}		
			} 	    
	});
	
	
	$('#answer_1').keyup(function () {
		var max = 250;
		var len = $(this).val().length;
		if (len >= max) {
	    	$('#charNum_1').text(' you have reached the limit');
		} else {
	    	var char = max - len;
			$('#charNum_1').text(char + ' characters left');
		}
	});
	
	$('#answer_2').keyup(function () {
		var max = 250;
		var len = $(this).val().length;
		if (len >= max) {
	    	$('#charNum_2').text(' you have reached the limit');
		} else {
	    	var char = max - len;
			$('#charNum_2').text(char + ' characters left');
		}
	});
	
	$('#answer_3').keyup(function () {
		var max = 250;
		var len = $(this).val().length;
		if (len >= max) {
	    	$('#charNum_3').text(' you have reached the limit');
		} else {
	    	var char = max - len;
			$('#charNum_3').text(char + ' characters left');
		}
	});	
	
}

function copy_clip() {
	new ClipboardJS('.btn');

	$(document).on("click", ".copy_btn", function() {
		jobID = 	$(this).attr("ID");	
		dataString = "jobID="+jobID;
		$.when(send_ajax(dataString, "ajax/opportunity.ajax.php?type=log_copy")).done(function(data){
			$('#copy_link').hide();
			$('#copy_notice').show();
		})
		
		return false;				
	})
	
}