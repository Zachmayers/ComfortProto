function employer_job_summary() {
	//as the document loads, load job summary separately
	$(function(){ 	
			dataString = "none";
			//alert(dataString);
			$.when(send_ajax(dataString, "ajax/main.ajax.php?type=load_job_summary")).done(function(data){
				$("#job_summary_holder").replaceWith(data);
			});
	})
}


function password_change() {

		$("#change_password").click(function() {
			old_pass = $('#old_pass').val();
			new_pass1 = $('#new_pass1').val();
			new_pass2 = $('#new_pass2').val();	
			if (new_pass1 == new_pass2) {
				if (new_pass1.length < 6 || new_pass1.length > 12) {
					$('#pass_length_warning').show();							
				} else {		
					dataString = "old_pass=" + encodeURIComponent(old_pass) + "&new_pass=" + encodeURIComponent(new_pass1);

					//alert(dataString);
					$("#change_password_form").hide();					
					$("#pass_loader").show();																												
					$.ajax({
						type: "POST",
						url: "ajax/main.ajax.php?type=change_password",
						data: dataString,
						success: function(data) {
							//alert(data);
							if (data == "no") {
								$("#change_password_form").show();					
								$("#pass_loader").hide();																												
								$('#old_pass_warning').show();																	
							} else {
								$("#pass_loader").hide();																												
								$("#pass_change_sucess").show('fast');																			
							}
						}
					});	
				}
			} else {
				$('#pass_length_warning').hide();										
				$('#new_pass_warning').show();
			}	
			return false;			
		});
}

function main_functions(profile_status, device) {
		$(".post_job").click(function() {
				window.location = "job.php?ID=new_job";		
		});
			
		$(".show_button").click(function() {
			$('#recommendation_holder').toggle();

			return false;						
		})

		$(".jobs_button").click(function() {
			window.location = "opportunity_list.php";
			return false;						
		})
		
		$(".profile_button").click(function() {
			if (profile_status == 'complete') {
				window.location = "employee.php";
			} else {
				window.location = "employee.php";
			}
			return false;						
		})
		
		$(".responses_button").click(function() {
			if (profile_status == 'complete') {
				window.location = "opportunity_list.php?page=responses";
			} else {
				window.location = "opportunity_list.php?page=responses";
			}
			return false;						
		})
		
		$("#close_warning").click(function() {
			$('#incomplete_profile').hide();	
			$('#main_buttons').show('fast');											
			return false;			
		});
	
		$("#job_list").click(function() {
			$('#job_summary_holder').toggle('fast');
			return false;			
		});
		
		$("#how_button").click(function() {
			$('#how_holder').toggle('fast');
			return false;			
		});
		
		$("#help_button").click(function() {
			$('#help_holder').toggle('fast');
			return false;			
		});

		$("#contact_button").click(function() {
			$('#contact_holder').toggle('fast');
			return false;			
		});
		
				
		$("#logout").click(function() {
			dataString = "logout";
			$.ajax({
				type: "POST",
				url: "lgout.php",
				data: dataString,
				success: function(data) {
					window.location = "http://servebartendcook.com";
				}
			});	
			return false;
		});		

		$(".email_setting").click(function () {
			setting = $(this).attr("ID");
			//alert(setting);
			dataString = "setting=" + setting;
			$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=email_settings", device)).done(function(data){
				//alert(data);
				$("#email_holder").hide();							
				if (setting == "N") {
					$("#email_off_page").show();														
				} else {
					$("#email_on_page").show();																						
				}
			});														
			return false;				
		});

				
		function change_password() {
			$('#new_pass_warning').hide();
			$('#pass_length_warning').hide();							
			$('#old_pass_warning').hide();																	

			old_pass = $('#old_pass').attr('value');
			new_pass1 = $('#new_pass1').attr('value');
			new_pass2 = $('#new_pass2').attr('value');	
			if (new_pass1 == new_pass2) {
				if (new_pass1.length < 6 || new_pass1.length > 12) {
					$('#pass_length_warning').show();							
				} else {		
					dataString = "old_pass=" + encodeURIComponent(old_pass) + "&new_pass=" + encodeURIComponent(new_pass1);
					//alert(dataString);
					$.ajax({
						type: "POST",
						url: "ajax/main.ajax.php?type=change_password",
						data: dataString,
						success: function(data) {
							//alert(data);
							if (data == "no") {
								$('#old_pass_warning').show();																	
							} else {
								$("#pass_change_form").hide();
								$("#pass_change_sucess").show();																		
							}
						}
					});	
				}
			} else {
				$('#new_pass_warning').show();
			}				
		}
		
	$("#change_email_button").click(function(evt) {
			evt.stopImmediatePropagation();		
			$("#email_links").hide();
			$('#email_change_holder').show();	
			return false;
	});
	
	$("#wrong_email_back").click(function(evt) {
			evt.stopImmediatePropagation();		
			$('#email_change_holder').hide();	
			$("#email_links").show();
			return false;
	});	
	
	$("#submit_new_email").click(function(evt) {
			evt.stopImmediatePropagation();		
			$(".warning").hide();
			$('#email_change_holder').hide();	
			$('#loader_box').show();	
			
			old_email = $('#old_email').attr('value');
			new_email = $('#new_email').val();
			type = $('#type').attr('value');
			
			if (type == "employer") {
				url = "ajax/employer.ajax.php?type=change_email";
			} else if (type == "employee") {
				url = "ajax/employee.ajax.php?type=change_email";
			}
			
			if (type == "employer" || type == "employee") {
			dataString = "new_email=" + new_email + "&old_email=" + old_email;
			//alert(dataString);
			if (new_email.length == 0) {
				$('#loader_box').hide();					
				$('#email_change_holder').show();	
				$('#employer_empty_warning').show();
				window.scrollTo(0, 0);
			} else {
				$.ajax({
					type: "POST",
					url: url,
					data: dataString,
					success: function(data) {
						//alert(data);
						 if (data == "email") {
							$('#loader_box').hide();					
							$('#email_change_holder').show();	
							$('#employer_email_warning').show();
							window.scrollTo(0, 0);
						} else if (data == "duplicate") {
							$('#loader_box').hide();					
							$('#email_change_holder').show();	
							$('#employer_duplicate_warning').show();
							window.scrollTo(0, 0);
						} else if (data == "yes") {
							//Take to page
							$('#loader_box').hide();		
							$('#email_header').hide();		
							$('#new_verification_sent').show();			
						} 
					}
				});
			}
		} else {
			$('#general_warning').show();
		}
	});	
	
	$("#resend_verification").click(function(evt) {
		evt.stopImmediatePropagation();		
		$("#email_links").hide();
		$('#email_loader').show();									

		email =  $("#email").val();
		dataString = "email=" + email;
		//alert(dataString);
		$.ajax({
			type: "POST",
			url: "ajax/verification.ajax.php?type=email_verify",
			data: dataString,
			success: function(data) {
				//alert(data);
				if (data == "Y") {
					//$('#verification_form').show();
					$('#email_loader').hide();																																													
					$('#verification_sent').show();
				} else {
					$('#email_loader').hide();									
					$('#email_links').show();												
					$('#error').show();													
				}
			}
		});					

		return false;
	});		
}

function urgent_notice() {
	
	$('#menu_bar').hide();

	$("#cancel_initial").click(function(evt) {
		//show cancel confirmation
		$('#urgent_holder').hide();
		$('#confirmation_holder').show();			
	})
	
	$(".continue_three").click(function(evt) {
		var matchID = $(this).attr('ID');		
		var new_status = "site_three";
		//alert(new_status);
		dataString = "matchID=" + matchID + "&status=" + new_status;
		$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=update_interview_status", "none")).done(function(data){
			//alert(data);
			//$("#loader").dialog("close");	
			window.location.reload();
		});																		
	})
	
	$(".continue_one").click(function(evt) {
		var matchID = $(this).attr('ID');		
		var new_status = "site_one";
		//alert("ONE");
		dataString = "matchID=" + matchID + "&status=" + new_status;
		$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=update_interview_status", "none")).done(function(data){
			//alert(data);
			//$("#loader").dialog("close");	
			window.location.reload();
		});																		
	})
	
	$(".cancel_confirm").click(function(evt) {
		var matchID = $(this).attr('ID');		
		
		dataString = "matchID=" + matchID;
		//alert(dataString)
		
		$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=cancel_interview", "none")).done(function(data){
			//$("#loader").dialog("close");
			//alert(data);	
			$('#confirmation_holder').hide();			
			$('#cancel_saved').show();	
			$("#loader").dialog("close");			
			//window.location.reload();
		});																		
	})
	
	$(".accept_cancel").click(function(evt) {
		var matchID = $(this).attr('ID');		
		var new_status = "view_employer_cancel";
		
		dataString = "matchID=" + matchID + "&status=" + new_status;
		$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=update_interview_status", "full")).done(function(data){
			$("#loader").dialog("close");	
			window.location.reload();
		});																		
	})
	
	$(".accept_cancel_employer").click(function(evt) {
		var matchID = $(this).attr('ID');		
		var new_status = "view_employee_cancel";
		
		dataString = "matchID=" + matchID + "&status=" + new_status;
		//alert(dataString);
		$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=update_interview_status", "full")).done(function(data){
			//alert(data);
			$("#loader").dialog("close");	
			window.location.reload();
		});																		
	})			
	
	$(".continue").click(function(evt) {
		$("#loader").dialog("open");	
		window.location.reload();		
	})	
	
	

	$("#show_complete").click(function(evt) {
		$('#choice_holder').hide();
		$('.sub_title').hide();

		$('#candidate_holder').show();
		return false;
	})		
	
	$("#back").click(function(evt) {
		window.location.reload();
		return false;
	})		
	
	$(document).on("click", '.candidate', function(evt) {
		evt.stopImmediatePropagation(); 		//prevents double firing of event
		//alert("HERE");
		
		if ($(this).data('user_selection') == "selected") {
			$(this).data('user_selection', 'unselected');
			$(this).removeClass('selected_button');
			$(this).addClass('unselected_button');		
		} else {
			$(this).data('user_selection', 'selected');
			$(this).removeClass('unselected_button');
			$(this).addClass('selected_button');			
		}
	});

$(function() {
	var candidate_list;
	
	$(document).on("click", "#save_step", function() {
		
		$('.sub_title').hide();
		$('#candidate_holder').hide();
		
		$('#confirm_holder').show();
		$('.confirm_user_holder').hide();
		candidate_list = new Array;
		candidate_count = 0;
	    $('.candidate').each(function () {
	    		if ($(this).data('user_selection') == "selected") {
		    		userID = $(this).data('hire_value');
					candidate_list.push(userID);
					candidate_count++;
					$('#' + userID).show();
				}
	    });	
	    return false;
	})

	$(document).on("click",".confirm_candidates", function() {
		var jobID = $(this).attr('ID');

		dataString = "jobID=" + jobID + "&candidate_list=" + candidate_list + "&status=complete";
		//alert(dataString);
		//reset site followup date
		$.when(send_ajax(dataString, "ajax/job.ajax.php?type=confirm_hire", "full")).done(function(data){
			//alert(data);
			$("#loader").dialog("close");	
			window.location.reload();
		});	
		return false;																											
	})	
	
	$(document).on("click",".confirm_candidates_open", function() {
		//this version the employer picked candidates but said they were still hiring
		var jobID = $(this).attr('ID');

		dataString = "jobID=" + jobID + "&candidate_list=" + candidate_list + "&status=open";
		//alert(dataString);
		$.when(send_ajax(dataString, "ajax/job.ajax.php?type=confirm_hire", "full")).done(function(data){
			//alert(data);
			$("#loader").dialog("close");	
			window.location.reload();
		});	
		return false;																											
	})	
	
		
});
	
	$(document).on("click", ".show_confirm_none", function() {
		$('#candidate_holder').hide();
		$('.sub_title').hide();

		$("#confirmation_none_holder").show();
		return false;				
	});

	
	$(document).on("click", "#cancel_none", function() {
		$("#confirmation_none_holder").hide();
		$('#candidate_holder').show();
		return false;				
	})
		
	$(document).on("click", ".confirm_none", function() {
		var jobID = $(this).attr('ID');
			
		dataString = "jobID=" + jobID + "&status=complete&candidate_list=";
		//alert(dataString);
		
		$.when(send_ajax(dataString, "ajax/job.ajax.php?type=confirm_hire", "full")).done(function(data){
			//alert(data);
			window.location.reload();
		});							

		return false;	
	})
	
	
	$(".still_hiring").click(function(evt) {
		var jobID = $(this).attr('ID');
		var status_type = "site";
		var bounty_status = "still_hiring";
		
		dataString = "jobID=" + jobID + "&status_type=" + status_type + "&bounty_status=" + bounty_status;
		//alert(dataString);
		//reset site followup date
		$.when(send_ajax(dataString, "ajax/job.ajax.php?type=update_bounty_status", "full")).done(function(data){
			//alert(data);
			$("#loader").dialog("close");	
			window.location.reload();
		});	
		
		return false;																					
	})
	
	
}
