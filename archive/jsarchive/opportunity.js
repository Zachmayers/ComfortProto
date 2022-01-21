function opportunity(jobID, empty, email_verification) {	
		$(".inappropriate").click(function() {
			jobID = $(this).attr('ID');		
			//alert(jobID);			
			$("#inappropriate_form").dialog("open");
			return false;
		});						
			
		$("#interested").click(function() {
			$(".job_details_large").addClass('hidden-xs');	
			$(".job_details").hide();								
			
			if (empty == "N" && email_verification == "Y") {
/*
				$("#application_warning").show();																									
				$("#application_form").hide();
*/
				$("#interested_form").show('fast');
			} else {
/*
				$("#application_warning").show();																									
				$("#application_form").hide();
*/
				$("#interested_warning_form").show('fast');				
			}							
			return false;
		});	
				
		$("#apply_anyway").click(function() {
			$("#interested_warning_form").hide();				
			$("#interested_form").show('fast');

			return false;
		});		
					
		$("#cancel").click(function() {
			//alert(jobID);	
			$(".job_details_large").removeClass('hidden-xs');								
			$("#interested_form").hide();
			$(".job_details").show('fast');														
			return false;
		});			
		
		$(".other_job").click(function() {
			var jobID = $(this).attr('ID');
			window.location = "opportunity.php?ID=" + jobID;														
			return false;
		});																			
					
		$("#view_application").click(function() {
			//hide buttons and hide all job details
			$(".job_details").hide();		
			window.scrollTo(0, 0);														
			$("#application_details").show('fast');
			return false;
		});	

		$("#hide_application").click(function() {
			$("#application_details").hide();
			window.scrollTo(0, 0);														
			$(".job_details").show('fast');		
			return false;
		});	
		
		$("#edit_recommendation").click(function() {
			//hide buttons and hide all job details
			$("#application_summary_holder").hide();
			window.scrollTo(0, 0);														
			$("#edit_recommendation_holder").show('fast');
			return false;
		});	
		
		$("#cancel_edit_recommendation").click(function() {
			//hide buttons and hide all job details
			$("#edit_recommendation_holder").hide();
			window.scrollTo(0, 0);														
			$("#application_summary_holder").show('fast');
			return false;
		});	
		
		
		$(".view_recommendation").click(function() {
			var recommendationID = $(this).data("recommendation_id");
			
			$(".reference_notice[data-recommendation_id="+recommendationID+"]").toggle();			
			$(".rejection_holder").toggle();			
			$(".recommendation_summary_holder[data-recommendation_id="+recommendationID+"]").toggle();		
			return false;
		});			
							
		$("#remove_recommendation").click(function() {		
			$(".recommendation_summary_holder").hide();		
			$("#remove_holder").show();			
			return false;
		});	

		$(".cancel_remove").click(function() {
			$("#remove_holder").hide();			
			$(".recommendation_summary_holder").show();		
			return false;
		});	
		
		$(".confirm_remove").click(function() {
			var recommendationID = $(this).data('recommendation_id');

			dataString = "jobID=" + jobID + "&recommendationID=" + recommendationID;			
			
			$('#remove_holder').hide();		
			$('#recommendation_loader').show();		

			$.when(send_ajax(dataString, "ajax/opportunity.ajax.php?type=remove_recommendation", "NA")).done(function(data){
				//alert(data);
				window.location.reload();
			});
			return false;
		});	

		$("#change_recommendation").click(function() {		
			$(".recommendation_summary_holder").hide();		
			$("#change_recommendation_holder").show();			
			return false;
		});	
		
		$("#cancel_change").click(function() {		
			$("#change_recommendation_holder").hide();			
			$(".recommendation_summary_holder").show();		
			return false;
		});	
		
		$(".confirm_change").click(function() {
			var recommend_count = 0;
			var recommendID = 0;
						
		     $(".recommend_button").each(function () {
			    //alert($(this).data("s_status"));
			 		if ($(this).data("s_status") == "selected") {	
			 			recommend_count++;
			 			recommendID = $(this).data('recommend_id');
			 		}
		     });

			 if (recommend_count == 0) {
				$('body').scrollTop(0);	
				$('#empty_recommendation').show()
				recommend_error = "Y"; 
			 } else if (recommend_count > 1) {
				$('body').scrollTop(0);	
				$('#empty_recommendation').show()				 
			 } else {
				recommend_error = "N"; 
			 }
			 
			 if (recommend_error == "N") {
				$('#change_recommendation_holder').hide();		
				$('#recommendation_loader').show();		

				dataString = "jobID=" + jobID + "&recommendID=" + recommendID;	
				//alert(dataString);					
	
				$.when(send_ajax(dataString, "ajax/opportunity.ajax.php?type=change_recommendation", "NA")).done(function(data){
					//alert(data);
					window.location.reload();
				});

			}
			return false;
		});	
		
	
		
		$(".confirm_recommendation").click(function() {
			var recommendationID = $(this).data('recommendationID');

			dataString = "jobID=" + jobID + "&recommendationID=" + recommendationID;						

			$.when(send_ajax(dataString, "ajax/opportunity.ajax.php?type=accept_recommendation", "NA")).done(function(data){
			//	alert(data);
				window.location.reload();
			});
			return false;
		});	
		
		
	$('#review_application').click(function() {
		$('#review_holder').show();
		dataString = "jobID=NA";						
		$.when(send_ajax(dataString, "ajax/opportunity.ajax.php?type=review", "NA")).done(function(data){
		//	alert(data);
			$('#review_holder').replaceWith(data);
		});
		return false;
	});
	

//recommendation toggle
	$(document).on("click", '.recommend_button', function(evt) {
			evt.stopImmediatePropagation(); 		//prevents double firing of event
			$('#confirm_change_holder').hide();

			$('.recommendation_selection_holder').hide();
			//first toggle the filter flag on the selected skill
			if ($(this).data("s_status") == "selected") {
				$(this).data("s_status", 'unselected');
				$(this).removeClass("selected_button");
				$(this).addClass("unselected_button");
			} else {
				//first uneselect everything
				$('.recommend_button').removeClass("selected_button");
				$('.recommend_button').not(this).removeClass("selected_button");
				$('.recommend_button').not(this).addClass("unselected_button");
				$('.recommend_button').not(this).data("s_status", 'unselected');

				$(this).data("s_status", 'selected');
				$(this).removeClass("unselected_button");
				$(this).addClass("selected_button");
				
				var recommendID = $(this).attr('ID');

				$('#holder_'+recommendID).show();
				$('#confirm_change_holder').show();
			}			 
		 })	
	
		
	$(document).on("click", '.save_answers', function(evt) {
		evt.stopImmediatePropagation(); 		//prevents double firing of event
		
		if ($(this).data('save_answers') == "selected") {
				$(this).data('save_answers', 'unselected');
				$(this).removeClass('selected_button');
				$(this).addClass('unselected_button');	
		} else {
				$(this).data('save_answers', 'selected');
				$(this).removeClass('unselected_button');
				$(this).addClass('selected_button');			
		}
	});		
	
	$(document).on("click", '.save_message', function(evt) {
		evt.stopImmediatePropagation(); 		//prevents double firing of event
		
		if ($(this).data('save_message') == "selected") {
				$(this).data('save_message', 'unselected');
				$(this).removeClass('selected_button');
				$(this).addClass('unselected_button');	
		} else {
				$(this).data('save_message', 'selected');
				$(this).removeClass('unselected_button');
				$(this).addClass('selected_button');			
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
	
	$('#personal_message').keyup(function () {
		var max = 250;
		var len = $(this).val().length;
		if (len >= max) {
	    	$('#charNum_message').text(' you have reached the limit');
		} else {
	    	var char = max - len;
			$('#charNum_message').text(char + ' characters left');
		}
	});	
						
	$("#submit_interested").click(function() {
		var question_count = $('#question_count').val();
		var personal_message = $('#personal_message').val().trim();
		var raw_phone = $('#phone').val().trim();
		var recommendation_check = $('#recommendation_check').val();
		var hash = $('#hash').val();
							
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
		
		
		//if recommendations exist, make sure the user has actively chosen one or actively acknowledged they do not want any on their application
		var recommend_error = "N"; 
		var recommendID = "none";
		if (recommendation_check == 'Y') {
			var recommend_count = 0;
			var recommendID = 0;
						
		     $(".recommend_button").each(function () {
			     //alert($(this).data("s_status"));
			 		if ($(this).data("s_status") == "selected") {	
			 			recommend_count++;
			 			recommendID = $(this).data('recommend_id');
			 		}
		     });

			 if (recommend_count == 0) {
				 $('body').scrollTop(0);	
				$('#empty_recommendation').show()
				recommend_error = "Y"; 
			 } else if (recommend_count > 1) {
				 $('body').scrollTop(0);	
				$('#empty_recommendation').show()				 
			 } else {
				recommend_error = "N"; 
			 }
		}
		//alert(recommendation_check);
		//alert(recommend_error);
		
		if (recommend_error == 'N') {
			empty_check = "ok";		
			
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
			
				if (question_count > 0) {
					if ($('.save_answers').data('save_answers') == "selected") {
						save_answers = 'Y';
					} else {
						save_answers = 'N';					
					}															
				} else {
					save_answers = 'N';
				}	
				
				if ($('.save_message').data('save_message') == "selected") {
					save_message = 'Y';
				} else {
					save_message = 'N';					
				}								
	
			if (empty_check == "empty") {
				$("#empty_warning").show();
				window.scrollTo(0, 0);														
			} else if (raw_phone.length == 0) {
				$("#phone_warning").show();	
				window.scrollTo(0, 0);														
			} else {	
				var phone = raw_phone.replace(/[^\d]/g, "");												
				$(".main_box").hide();	
				dataString = "jobID=" + jobID + "&save_message=" + save_message + 
									"&save_answers=" + save_answers + 
									"&personal_message=" + encodeURIComponent(personal_message) + 
									"&phone=" + phone + "&questionID_1=" + questionID_1 + 
									"&answer_1=" + encodeURIComponent(answer_1) + "&questionID_2=" + questionID_2 + 
									"&answer_2=" + encodeURIComponent(answer_2) +"&questionID_3=" + questionID_3 + 
									"&answer_3=" + encodeURIComponent(answer_3) + 
									"&recommendID=" + recommendID + "&interest=Y";						
				//alert(dataString);

				$.when(send_ajax(dataString, "ajax/opportunity.ajax.php?type=employee_interest", "full")).done(function(data){
					//alert(data);
					//alert(hash);
					$("#loader_box").dialog("close");
					window.location = "opportunity.php?ID=" + jobID + "&hash=" + hash+ "&page=sent";
				});				
			}	
		}

	return false;															
	});
					
					$(function() {
						$("#inappropriate_form").dialog({
							autoOpen: false,
							modal: true,
							height: 250,
							width: 450,
							buttons: {
								"Report": function() {	
									dataString = "jobID=" + jobID + "&type=job";
									$("#inappropriate_form").dialog("close");
									$.when(send_ajax(dataString, "ajax/opportunity.ajax.php?type=report", "full")).done(function(data){
										window.location.reload();
									});								
								}
							}
						});
					});															
					
					$(function() {
						$("#not_interested_form").dialog({
							autoOpen: false,
							modal: true,
							height: 250,
							width: 450,
							buttons: {
								"Not Interested": function() {	
									dataString = "jobID=" + jobID + "&secondary_contact=NA&interest=N";
									$("#not_interested_form").dialog("close");
									$('.main_box').hide();
									$.when(send_ajax(dataString, "ajax/opportunity.ajax.php?type=employee_interest", "full")).done(function(data){
										$("#loader_box").dialog("close");
										window.location = "opportunity_list.php";
									});											
								}
							}
						});
					});		
}

function suggested_list() {
		//as the document loads, load suggestion summary separately
		$(function(){ 	
			dataString = "jobID=NA";
			$.when(send_ajax(dataString, "ajax/opportunity.ajax.php?type=load_suggestions")).done(function(data){
				$("#suggestion_list_holder").replaceWith(data);
			});
		})
}

function copy_clip(jobID) {
	new ClipboardJS('.btn');
	$(document).on("click", "#copy_btn", function() {
		dataString = "jobID="+jobID;
		$.when(send_ajax(dataString, "ajax/opportunity.ajax.php?type=log_copy")).done(function(data){
			$('#copy_link').hide();
			$('#copy_notice').show();
		})
		return false;				
	})	
}

function copy_clip_suggest() {
	new ClipboardJS('.btn');
	$(document).on("click", ".copy_btn_suggest", function() {
		jobID = 	$(this).attr("ID");	

		dataString = "jobID="+jobID;
		$.when(send_ajax(dataString, "ajax/opportunity.ajax.php?type=log_copy")).done(function(data){
			$('#copy_link_'+jobID).hide();
			$('#copy_notice_'+jobID).show();
		})
		return false;				
	})
}

function recommend(jobID) {

	$("#submit_summary").click(function() {
		email = $("#email").val().trim();	
		firstname = $("#firstname").val().trim();	
		lastname = $("#lastname").val().trim();	
		coworker = $("#coworker").val().trim();	
		employer = $("#employer").val().trim();	
//		notes = $("#notes").val().trim();	
		
		if (email.length ==0 || firstname.length == 0 || lastname.length == 0 || coworker.length == 0 || employer.length == 0) {
			$('#empty_error').show();			
		} else {
			dataString = "jobID=" + jobID + "&email="  + email + "&firstname=" + firstname + "&lastname=" + lastname + "&coworker="  + coworker + "&employer="  + employer;
			$('#recommend_form').hide();	
					
			$.when(send_ajax(dataString, "ajax/opportunity.ajax.php?type=recommend_summary", "full")).done(function(data){
				//alert(data);
				$('#summary').show();	
				$("#summary_holder").replaceWith(data);
			});	
		}
		
		return false;
	});
	
	$("#recommend_cancel").click(function() {
		$('#summary').hide();	
		$('#recommend_form').show();	
				
		return false;
	})
	
	$(".warning_cancel").click(function() {		
		$('.warning').hide();	
		$('#recommend_form').show();	
				
		return false;
	})			
	
	$(".recommend").click(function() {
		$('.error').hide();						

		email = $("#email_final").val().trim();	
		firstname = $("#firstname_final").val().trim();	
		lastname = $("#lastname_final").val().trim();	
		coworker = $("#coworker_final").val().trim();	
		employer = $("#employer_final").val().trim();	
//		notes = $("#notes_final").val().trim();	

		if (email.length ==0 || firstname.length == 0 || lastname.length == 0 || coworker.length == 0 || employer.length == 0) {
			$('#empty_error').show();						
		} else {					
			$('#summary').hide();	
			dataString = "jobID=" + jobID + "&email="  + email + "&firstname=" + firstname + "&lastname=" + lastname + "&coworker="  + coworker + "&employer="  + employer;
			//alert(dataString);
			$.when(send_ajax(dataString, "ajax/opportunity.ajax.php?type=recommend", "full")).done(function(data){
				//alert(data);
				
				switch(data) {
					default:
						//default case includes text to replace link span
						$('#non-member').show();
						$('#new_email').replaceWith("" + email + "");
						$('#name').replaceWith(firstname + " " + lastname);
					//	$('#recommend_link').replaceWith(data);
					break;
					
					case "duplicate":
						$('#duplicate_warning').show();
					break;					
					
					case "self":
						$('#self_warning').show();
					break;
					
					case "employer":
						$('#employer_warning').show();
					break;
					
					case "deactivate":
						$('#deactivated_warning').show();
					break;					

					case "no_user":
					break;

					case "none":
						$('#member').show();
					break;					
				}
			});	
		}																										
											
		return false;
	});	
	
	$(".show_remove").click(function() {		
		$('#recommendation_holder').hide();	
		$('#remove_holder').show();	
				
		return false;
	})	
	
	$(".cancel_remove").click(function() {		
		$('#remove_holder').hide();	
		$('#recommendation_holder').show();	
				
		return false;
	})			
			
	$('#save_remove').click(function() {
		$('#summary_holder').hide();

		dataString = "jobID=" + jobID;						
		//alert(dataString);

		$.when(send_ajax(dataString, "ajax/opportunity.ajax.php?type=rescind_recommendation", "full")).done(function(data){
			//alert(data);
			
		});
		return false;
	});
	
}
