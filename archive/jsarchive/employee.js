function photo() {
	$("#profile_pic_choose").change(function(){
	    input = this;
		if (input.files && input.files[0]) {
			if (input.files[0].size > 4000000) {
				$('#file_size_warning').show();
				//alert("Please choose a file less than 2 MB");
			} else if (input.files[0].type == "image/png" || input.files[0].type == "image/jpg" || input.files[0].type == "image/jpeg") {
					//if (window.confirm("Upload image: " + input.files[0].name + "?")) {
						//alert("here");
						//$("#loader_box").dialog("open");																			
						$("#profile_upload_button").click();	
						return false;
					//} else {
					//	window.location.reload();
					//}	
			} else {
				$('#file_type_warning').show();				
				//alert("File must be a JPEG or PNG image file");
			}		
		} 	    
	});
	
	$("#bartender_pic_choose").change(function(){
		    input = this;
			if (input.files && input.files[0]) {
				if (input.files[0].size > 4000000) {
					$('#file_size_warning_bar').show();
				} else if (input.files[0].type == "image/png" || input.files[0].type == "image/jpg" || input.files[0].type == "image/jpeg") {
/* 							if (window.confirm("Upload image: " + input.files[0].name + "?")) {					 */
							$("#loader_box").dialog("open");																			
							$("#bartender_upload_button").click();						
							return false;
/*
						} else {
							window.location.reload();
						}				
*/
				} else {
					$('#file_type_warning_bar').show();				
				}
		}				 	    
	});
	
	$("#bartender_upload_button_ie").click(function(){
		//alert("here");
		$('#loader_box').dialog("open");	
	});		
	$("#kitchen_upload_button_ie").click(function(){
		//alert("here");
		$('#loader_box').dialog("open");	
	});				

	$("#profile_upload_button_ie").click(function(){
		//alert("here");
		$('#loader_box').dialog("open");	
	});	
	
	$(".upload_cancel").click(function(){
		//alert("cancel");
		cancel_type = $(this).attr("ID");
		switch(cancel_type) {
			case "profile":
  				$('#profile_form_ie').hide();					
  				$('#profile_pic').show();				 	    						 	    		
  				$('#photo_buttons').show();	  																							  							  				
			break;
			
			case "bar":
  				$('#bar_form_ie').hide();		
  				$('.holder_Bartender').show();				 	    						 	    			  																						  				
			break;
			
			case "kitchen":
  				$('#kitchen_form_ie').hide();		
  				$('.holder_Kitchen').show();				 	    						 	    			  																						  				
			break;				
		}
	});								
								

	$("#kitchen_pic_choose").change(function(){
	    input = this;
		if (input.files && input.files[0]) {
			if (input.files[0].size > 4000000) {
				$('#file_size_warning_kitchen').show();				
			} else if (input.files[0].type == "image/png" || input.files[0].type == "image/jpg" || input.files[0].type == "image/jpeg") {
/* 						if (window.confirm("Upload image: " + input.files[0].name + "?")) {					 */
						$("#loader_box").dialog("open");																			
						$("#kitchen_upload_button").click();						
						return false;
/*
					} else {
						window.location.reload();
					}				
*/
			} else {
				$('#file_type_warning_kitchen').show();				
			}		
		}		    
	});		
			  
		$(".remove_gallery").click(function() {
			gallery_type = $(this).attr('ID');		
			//alert(gallery_type);			
			$("#" + gallery_type + "_photo_view").hide();
			$("#" + gallery_type + "_photo_remove").show();						
			return false;
		});								  

		$(".add_photo").click(function() {
			pic_type = $(this).attr("id");
			//alert(pic_type);
			//alert(navigator.appName);
			var iOS = ( navigator.userAgent.match(/(iPad|iPhone|iPod)/g) ? true : false );
			var rv = 0;
			if (navigator.appName == 'Microsoft Internet Explorer') {
			    var ua = navigator.userAgent;
			    var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
			    if (re.exec(ua) != null)
			    rv = parseFloat( RegExp.$1 );
			    if (rv < 10) {
				    browser = "low_ie";
			    } else {
				    browser = "normal";
			    }
			 } else if (iOS == true) {
			 	browser = "normal" //javascript alerts lockup ios when there is a file in the input, use old style, apple sucks
			 } else {
				 browser = "normal";
			 }
			  //alert(browser);
			
			switch(pic_type) {
				case "profile":
					  switch(browser) {
						  case "normal":
						 // alert("HERE");
						  	$("#profile_pic_choose").click();																			  
						  break;
						  
						  case "low_ie":
			  				$('#photo_buttons').hide();
			  				$('#profile_pic').hide();				 	    						 	    		
			  				$('#profile_form_ie').show();																				  							  
						  break;
					  }
				break;
				
				case "bartender":
					  switch(browser) {
						  case "normal":
						  	$("#bartender_pic_choose").click();													
						  break;
						  
						  case "low_ie":
			  				$('.holder_Bartender').hide();				 	    						 	    		
			  				$('#bar_form_ie').show();																				  
						  break;
					  }
				break;

				case "kitchen":
					  switch(browser) {
						  case "normal":
						  	$("#kitchen_pic_choose").click();													
						  break;
						  
						  case "low_ie":
			  				$('.holder_Kitchen').hide();				 	    						 	    		
			  				$('#kitchen_form_ie').show();																				  
						  break;
					  }
				break;							
			}
			return false;
		});					
		
		$(".remove_photo").click(function() {
			photoID = $(this).attr("ID");
			//alert(photoID);
			if (window.confirm("Remove profile photo?")) {
				dataString = "photoID=" + photoID;
				$.ajax({
					type: "POST",
					url: "ajax/employee.ajax.php?type=remove_photo",
					data: dataString,
					success: function(data) {
						//alert(data);
						$("#loader_box").dialog("open");																			
						window.location.reload();
					}
				});												
			}
			return false;
		});	

				var status = $('#status');
$('form').ajaxForm({
    beforeSend: function() {
        status.empty();
        var percentVal = '0%';
       // bar.width(percentVal)
        //percent.html(percentVal);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
       // bar.width(percentVal)
        //percent.html(percentVal);
    },
    success: function() {
        var percentVal = '100%';
        //bar.width(percentVal)
      //  percent.html(percentVal);
    },
	complete: function(xhr) {
		//alert(xhr.responseText);
		if(xhr.responseText == "Successful") {
			//alert("HERE");
			window.location.reload();	
		} else {
			$("#loader_box").dialog("close");		
			status.html(xhr.responseText);
		}
	}
});										
					
	$("#delete_photo").click(function() {
		dataString = "type=profile";
		$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=remove_photo", "full")).done(function(data){
			//alert(data);
			window.location.reload();
		});																	
		return false;
	});	
	
}

function employee_fix_employment() {
	
		$(".remove_work").click(function() {
			employmentID = $(this).attr('ID');
			//alert(employmentID);
			dataString = "workID=" + employmentID;
			//alert(dataString);
			$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=remove_work", "full")).done(function(data){
				//alert(data);
				window.location.reload();	
			});																								
			return false;			
		});		
		
		$(".fix_employment").click(function() {
			
			$("#loader_box").dialog({
				autoOpen: false,
				modal: true,
				height: 200,
				width: 450
			});
				
			$("#loader_box").dialog("open");																															
			
			
			$('.warning').hide();				
			var num_entries = $('.old_employment').length			
			//alert(num_entries);
			//loop through all entries
			var error = 'N';
			var count = 0;
			$('.old_employment').each(function() {
				employmentID = $(this).attr('ID');
				start_month = parseInt($('#start_month_'  + employmentID).val());
				start_year = parseInt($('#start_year_'  + employmentID).val());
				end_month = parseInt($('#end_month_'  + employmentID).val());
				end_year = parseInt($('#end_year_'  + employmentID).val());
				if($('#current_'  + employmentID).is(':checked'))	 {
					current = 'Y'
				} else {
					current = 'N'
				}	

			
				if(start_year < 1950) {
					$('#year_warning_' + employmentID).show();
					error = "Y";	
				} else if(isNaN(start_year)) {
					$('#year_warning_' + employmentID).show();	
					error = "Y";	
				} else if(isNaN(end_year) && current == "N") {
					$('#year_warning_' + employmentID).show();						
					error = "Y";	
				} else if(current == 'N' &&	start_year < 1950) {
					$('#year_warning_' + employmentID).show();	
					error = "Y";	
				} else if (current == 'N' && start_year > end_year) {
					$('#greater_warning_' + employmentID).show();	
					error = "Y";	
				} else if (current == 'N' && start_year == end_year && start_month > end_month) {
					$('#greater_warning_' + employmentID).show();	
					error = "Y";	
				}
				
				count++;

				if (count == num_entries) {
					if (error == 'Y') {
						$("#loader_box").dialog("close");																															
					} else if (error == 'N') {
						new_count = 0;
						$('.old_employment').each(function() {	
								employmentID = $(this).attr('ID');
								start_month = parseInt($('#start_month_'  + employmentID).val());
								start_year = parseInt($('#start_year_'  + employmentID).val());
								end_month = parseInt($('#end_month_'  + employmentID).val());
								end_year = parseInt($('#end_year_'  + employmentID).val());
								if($('#current_'  + employmentID).is(':checked'))	 {
									current = 'Y'
								} else {
									current = 'N'
								}	
								
								dataString = "workID=" + employmentID + "&start_month=" + encodeURIComponent(start_month) + "&start_year=" + encodeURIComponent(start_year) + "&end_month=" + encodeURIComponent(end_month) + "&end_year=" + encodeURIComponent(end_year) + "&current=" + current;				
								//alert(dataString);
								$.ajax({
									type: "POST",
									url: "ajax/employee.ajax.php?type=fix_past_employment",
									data: dataString,
									success: function(data) {
										//alert(data);
										new_count++;
										if (new_count == num_entries) {
											window.location.reload();									
										}		
									}
								});
						})				 
					}					
				}	
				
			});
			return false;					
		});					
}


function employee_edit_settings(device, p_status, old_zip) {

		$(".edit_email").click(function() {	
			$('.setting_row').hide();		
			$('.email_input_holder').show();
			return false;
		})

		$(".cancel_email_edit").click(function() {	
			$('.email_input_holder').hide();
			$('.setting_row').show();		
			return false;
		})
		
		
		$(".edit_password").click(function() {	
			$('.setting_row').hide();		
			$('.password_change_holder').show();
			return false;
		})

		$(".cancel_edit_password").click(function() {	
			$('.password_change_holder').hide();
			$('.setting_row').show();		
			return false;
		})
		

		$(".edit_email_setting").click(function() {	
			$('.setting_row').hide();		
			$(".email_setting_input").show();		
			return false;
		})

		$(".cancel_email_setting").click(function() {	
			$(".email_setting_input").hide();		
			$('.setting_row').show();		
			return false;
		})
		
		
		$(".edit_account_type").click(function() {	
			$('.setting_row').hide();		
			$('.type_input_holder').show();
			return false;
		})

		$(".cancel_account_type").click(function() {	
			$('.type_input_holder').hide();
			$('.setting_row').show();		
			return false;
		})

		$(".edit_share_setting").click(function() {	
			$('.setting_row').hide();		
			$(".share_setting_input").show();		
			return false;
		})

		$(".cancel_share_setting").click(function() {	
			$(".share_setting_input").hide();		
			$('.setting_row').show();		
			return false;
		})


		$(".save_email_edit").click(function() {
			$('.error').hide();
			new_email = $('#edit_email_holder').val().trim();
			old_email = $('#old_email_holder').val().trim();

			if (new_email.length == 0) {
				$('#email_empty_warning').show();
				$('#edit_email_holder').addClass('has-error');					
			} else {
				$('.container').hide();
				$('#loader').show();
				dataString = "new_email=" + new_email + "&old_email=" + old_email;
				
				$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=new_email")).done(function(data){
					if (data == "email") {
						$('#loader').hide();
						$('.container').show();
						$('#non_email_warning').show();
						$('#edit_email_holder').addClass('has-error');		
					} else if (data == "duplicate") {
						$('#loader').hide();
						$('.container').show();
						$('#duplicate_email_warning').show();
						$('#edit_email_holder').addClass('has-error');											
					} else {	
						$('#loader').hide();
						$('.container').show();
						$('.email_input_holder').hide();
						$('#email_change_success').show();	
					}	
				})
			}
			
			return false;					
		});			
		
		
		$(".save_new_password").click(function() {
			$('.error').hide();

			old_pass = $('#old_pass').val();
			new_pass1 = $('#new_pass1').val();
			new_pass2 = $('#new_pass2').val();	
			if (new_pass1 == new_pass2) {
				if (new_pass1.length < 6 || new_pass1.length > 12) {
					$('#pass_length_warning').show();	
					$('#new_pass1').addClass('has-error');					
					$('#new_pass2').addClass('has-error');					
				} else {		
					dataString = "old_pass=" + encodeURIComponent(old_pass) + "&new_pass=" + encodeURIComponent(new_pass1);
					$('.container').hide();
					//$('#loader').show();

					$.ajax({
						type: "POST",
						url: "ajax/main.ajax.php?type=change_password",
						data: dataString,
						success: function(data) {
							//$('#loader').hide();
							$('.show').hide();

							if (data == "no") {
								$('.container').show();
								$('#old_pass_warning').show();																	
								$('#new_pass1').removeClass('has-error');					
								$('#new_pass2').removeClass('has-error');					
								$('#old_pass').addClass('has-error');					
							} else {
								$('.container').show();
								$(".password_change_holder").hide();																												
								$("#password_change_success").show();																			
							}
						}
					});	
				}
			} else {
				$('#pass_length_warning').hide();	
				$('#new_pass_warning').show();														
				$('#new_pass1').addClass('has-error');					
				$('#new_pass2').addClass('has-error');					
			}	
			return false;			
		})
		
		$(".save_email_setting").click(function() {
			$('.error').hide();
			email_setting = $('#edit_email_setting').val();

			$('.container').hide();
			$('#loader').show();
			dataString = "email_match_setting=" + email_setting;

			$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=email_settings")).done(function(data){
				window.location.reload();
			})
			return false;					
		});		
		
		$(".save_share_setting").click(function() {
			$('.error').hide();
			share_setting = $('#edit_share_setting').val();

			$('.container').hide();
			$('#loader').show();
			dataString = "share_setting=" + share_setting;
			$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=share_settings")).done(function(data){
				window.location.reload();
			})
			return false;					
		});						

		$("#change_account_type").click(function() {
			$('.error').hide();

			$('.container').hide();
			$('#loader').show();

			dataString = "switch=NA" ;
			$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=switch_account_type")).done(function(data){
				//alert(data);
				window.location = "main.php";
			});																						

			return false;					
		});			
				
}

function employee_advanced()	{		
		$("#notice_change").click(function() {
			$("#notice_change").hide();					
			$("#notice_hidden").show('fast');
			return false;			
		});
		
		$("#notice_cancel").click(function() {
			$("#notice_hidden").hide();
			$("#notice_change").show('fast');								
			return false;			
		});			
		
		$("#save_notice_change").click(function() {
			match_setting = $('#email_setting').val();
			dataString = "email_match_setting=" + match_setting;
			$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=email_settings", "full")).done(function(data){
				//alert(data);
				$("#loader_box").dialog("close");																						
				window.location = "employee.php";
			});																						
			return false;			
		});					
}


// NEW FUNCTIONS
function new_splash() {
	$(".start_profile").click(function() {
		window.location = "employee.php";
		return false;			
	});
	
	$(".skip_profile").click(function() {
		window.location = "opportunity_list.php";
		return false;			
	});
}


function employee_main() {
	$(".show_edit_menu").click(function() {
		$(".edit_menu").toggle();
		$(".edit_icon").toggle();
		return false;			
	});
		
	$(".cancel_apply").click(function() {
		dataString = "update=update";
		$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=update_ref_job")).done(function(data){
			window.location = "main.php";		
		});
		return false;			
	});

	
	$(".edit").click(function() {
		page = $(this).attr("ID");
		window.location = "employee.php?page=" + page;
		return false;			
	});
	
	$("#show_positions_button").click(function() {
 		$(".hidden_position").show('fast');
		$(".show_positions_button").hide();
		$(".hide_positions_button").show();
		return false;			
	});

	$("#hide_positions_button").click(function() {
		$(".hidden_position").hide('fast');
		$(".show_positions_button").show();
		$(".hide_positions_button").hide();
		return false;			
	});	
	
	$("#show_skills_button").click(function() {
 		$(".hidden_skill").show('fast');
		$(".show_skills_button").hide();
		$(".hide_skills_button").show();
		return false;			
	});

	$("#hide_skills_button").click(function() {
		$(".hidden_skill").hide('fast');
		$(".show_skills_button").show();
		$(".hide_skills_button").hide();
		return false;			
	});	

	$(".thumb").click(function() {
		var photoID = $(this).attr('ID');
		$(".profilephoto").hide();
		if (photoID == "profile") {
			$("#main_photo").show();
		} else {
			$("#"+photoID+"_large").show();	
		}
		return false;			
	});	

	$(".hospitality_header").click(function() {
		$(".hosp-exp").hide('fast');
		$(".total-exp").show('slow');
		return false;			
	});	

	$(".total_header").click(function() {
		$(".total-exp").hide('fast');
		$(".hosp-exp").show('slow');
		return false;			
	});	
	
}

function employee_profile_menu(device, verification, ref_jobID, profile_status) {
	$("#experience_button").click(function() {
			window.location = "employee.php?page=work_skills_menu";
			return false;			
		});
		
	$("#education_button").click(function() {
			window.location = "employee.php?page=education_menu";
			return false;			
		});		
		
	$("#personal_button").click(function() {
			window.location = "employee.php?page=personal_menu";
			return false;			
		});	

	$("#upload_resume").click(function() {
			window.location = "employee.php?page=upload_resume";
			return false;			
		});			
		
	$(".job_titles_button").click( function() {	
		if ($(this).data("status") == "selected") {
			$(this).data("status", 'unselected');
			$(this).removeClass('selected_job_titles');
			$(this).addClass('unselected_job_titles');	
		} else {
			$(this).data("status", 'selected');
			$(this).removeClass('unselected_job_titles');
			$(this).addClass('selected_job_titles');
		}			 

		skillID = $(this).data('skill_id');
		s_status = $(this).data('s_status');
		
		if (s_status == 'unselected') {
			seeking = 'Y';
		} else {
			seeking = 'N';
		}
		dataString = "skillID=" + skillID + "&seeking=" + seeking + "&profile_status=" + profile_status;
		$('.main_box').hide();
		$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=update_seeking", device)).done(function(data){
			if (device == "full") {
				$("#loader_box").dialog("close");
			}			
			window.location = "employee.php?page=profile_menu";		
		});
		

	});						
		
	$("#finalize").click(function() {
			$(".error").hide();			
			var skill_test = $(this).attr('ID');
			
			if (skill_test == "no") {
				$("#skill_warning").show();
			} else {
				//complete profile and send them somewhere
				dataString = "status=complete";
				$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=update_status", device)).done(function(data){
				//alert(data);
						if (ref_jobID == "NA" || ref_jobID == "") {
							if (verification == 'Y') {
								window.location = "main.php";	
							} else {
								window.location = "main.php";									
							}																
						} else {
							if (verification == 'Y') {							
								window.location = "opportunity.php?ID=" + ref_jobID;	
							} else {
								window.location = "opportunity.php?ID=email_warning";									
							}										
						}
						
					if (device == "full") {
						$("#loader_box").dialog("close");
					}
						
				});
			}
			return false;			
		});	
		
	$("#finalize_incomplete").click(function() {
			$("#incomplete_profile").show();
			return false;			
		});								
}

function employee_work_skills_menu(){
	
		$(".edit_work").click(function() {	
			var workID = $(this).attr('ID');
			$('#new_work_button_holder').hide();		
			$('.work_row').hide();		
			$(".work_input[data-work_id="+workID+"]").show();		
			return false;
		})

		$(".cancel_edit_work").click(function() {	
			$('.work_input').hide();		
			$('.work_row').show();
			$('#new_work_button_holder').show();		
			return false;
		})
		
		$(".remove_work").click(function() {	
			var workID = $(this).attr('ID');
			//get data from hidden forms	
			workID = $(this).attr('ID');

			dataString = "workID=" + workID;								
			$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=remove_work")).done(function(data){
				window.location = "employee.php?page=work_skills_menu";
			});	

			return false;
		})
		
		$("#add_work_button").click(function() {	
			$('.work_row').hide();		
			$('#add_work_button').hide();		
			$("#new_work_holder").show();					
			return false;
		})
		
		$(".cancel_new_work").click(function() {	
			$("#new_work_holder").hide();		
			$('.work_row').show();		
			$('#add_work_button').show();		
			return false;
		})		
	
		$(".edit_position").change(function() {
			var workID = $(this).data('work_id');
			var job_type = ($(this).find(':selected').attr('class'));
			var position_text = ($(this).find(':selected').text());
			var positionID = ($(this).find(':selected').val());

			if (positionID > 1) {
				$("#positionID_"+workID +"").attr('value', position_text);
			}

			return false;
		})

		$(".new_position").change(function() {
			var job_type = ($(this).find(':selected').attr('class'));
			var position_text = ($(this).find(':selected').text());
			var positionID = ($(this).find(':selected').val());
			
			if (positionID > 1) {
				$("#new_title").attr('value', position_text);
			}

			return false;
		})
		
		$(".toggle_FOH").click(function() {
			FOH_ID = $(this).attr('ID');
			$("#FOH_"+FOH_ID).toggle();
			$("#caret_down_FOH_"+FOH_ID).toggle();
			$("#caret_up_FOH_"+FOH_ID).toggle();
			
			return false;
		})	

		$(".toggle_BOH").click(function() {
			BOH_ID = $(this).attr('ID');
			$("#BOH_"+BOH_ID).toggle();
			$("#caret_down_BOH_"+BOH_ID).toggle();
			$("#caret_up_BOH_"+BOH_ID).toggle();
			
			return false;
		})	

		$(".toggle_management").click(function() {
			MGMT_ID = $(this).attr('ID');
			$("#management_"+MGMT_ID).toggle();
			$("#caret_down_management_"+MGMT_ID).toggle();
			$("#caret_up_management_"+MGMT_ID).toggle();
			
			return false;
		})	
		
		
		$(".edit_years").click(function() {	
			$('#new_work_button_holder').hide();		
			$('.work_row').hide();		
			$(".experience_row").show();		
			return false;
		})

		$(".cancel_edit_years").click(function() {	
			$('.experience_row').hide();		
			$('.work_row').show();
			$('#new_work_button_holder').show();		
			return false;
		})
		
		$(".save_years").click(function() {		
			$('.error').hide();	

			 var total = $('#total_experience').val();
			 var hospitality = $('#hospitality_experience').val();

			if(isNaN(total) || isNaN(hospitality)) {
				$('#non_number').show();	
			} else {
				$('.container').hide();			
				$('#loader').show();			
				dataString = "total=" + total + "&hospitality=" + hospitality;					

				$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=overwrite_experience")).done(function(data){
					window.location = "employee.php?page=work_skills_menu";
				})			
				
			}

		});		

		$(".skill_button").click(function() {	
			$(this).toggleClass("active");
			
			if ($(this).hasClass("active")) {
				$(this).children('.fa-circle-thin').hide();
				$(this).children('.fa-check').show();
			} else {
				$(this).children('.fa-check').hide();
				$(this).children('.fa-circle-thin').show();			
			}
		})		
		
		$(".save_edit_position").click(function() {		
			$('.error').hide();	
		//	alert($(this).attr('id'));
			ID = $(this).attr('ID');
			past_company = $('#past_company_'+ID).val();
			past_position = $('#past_position_'+ID).val();
			business_type = $('#business_type_'+ID).val();							
			start_month = parseInt($('#start_month_'+ID).val());
			start_year = parseInt($('#start_year_'+ID).val());
			end_month = parseInt($('#end_month_'+ID).val());
			end_year = parseInt($('#end_year_'+ID).val());
			titleID = $('#job_category_'+ID).val();
			//p_status = $('#status').val();
			var job_type = ($('#job_category_'+ID).find(':selected').attr('class'));

			if ($('#current_employment_'+ID).is(':checked') ) {
				current = 'Y'
			} else {
				current = 'N'
			}		

//get selected skills
			var skill_count = 0;
			var skill_array = [];
			
			//loop though job titles looking for selected items
		     $('.skill_reference_'+ID).each(function () {
		 		if ($(this).hasClass('active')) {	
		 			selected_skill = $(this).data('skill');
		 			selected_skill = encodeURIComponent(selected_skill);
		 			skill_array.push(selected_skill);	
		 			skill_count++;	
		 		}
		     });	
			 
			 if (skill_count == 0) {
				 skill_array = "NA";
			 }
			 
			//create conditions for continuing		
			if (past_company.length == 0 ) {
				condition = "empty_company";				
			} else if (titleID == "NA") {
				condition = "empty_position";	
			} else if (past_position.length == 0) {
				condition = "empty_title";	
			} else if (business_type == '0') {
				condition = "empty_type";
			} else if(isNaN(start_year)) {
				condition = "start_year";
			} else if(isNaN(end_year) && current == "N") {
				condition = "end_year";									
			} else if(start_year < 1950) {
				condition = "start_year";
			} else if(current == 'N' &&	start_year < 1950) {
				condition = "end_year";	
			} else if (current == 'N' && start_year > end_year) {
				condition = "greater";
			} else if (current == 'N' && start_year == end_year && start_month > end_month) {
				condition = "greater";				
			} else {
				condition = "save";			
			}
			
			switch(condition) {
				case "empty_company":
					$('#empty_company_' + ID + '').show();	
					$('.company_form_'+ID+'').addClass('has-error');					
					window.scrollTo(0, 0);
				break;
				
				case "empty_position":
					$('#empty_position_' + ID + '').show();	
					$('.position_form_'+ID+'').addClass('has-error');					
					window.scrollTo(0, 0);
				break;						

				case "empty_title":
					$('#empty_title_' + ID + '').show();	
					$('.title_form_'+ID+'').addClass('has-error');					
					window.scrollTo(0, 0);
				break;						

				case "empty_type":
					$('#empty_type_' + ID + '').show();	
					$('.type_form_'+ID+'').addClass('has-error');					
					window.scrollTo(0, 0);
				break;	
			
				case "start_year":
					$('#empty_year_' + ID + '').show();	
					$('.start_year_form_'+ID+'').addClass('has-error');					
					window.scrollTo(0, 0);
				break;

				case "end_year":
					$('#empty_year_' + ID + '').show();	
					$('.end_year_form_'+ID+'').addClass('has-error');					
					window.scrollTo(0, 0);
				break;
				
				case "greater":
					$('#bad_dates_year_' + ID + '').show();
					$('.end_year_form_'+ID+'').addClass('has-error');					
					$('.start_year_form_'+ID+'').addClass('has-error');					
					window.scrollTo(0, 0);
				break;								
								
				case "save":
					$('.container').hide();			
					$('#loader').show();			
					dataString = "ID=" + ID + "&company=" + encodeURIComponent(past_company) + 
										"&business_type=" + business_type + "&position=" + encodeURIComponent(past_position) + 
										"&start_month=" + encodeURIComponent(start_month) + "&start_year=" + encodeURIComponent(start_year) +
										"&end_month=" + encodeURIComponent(end_month) + "&end_year=" + encodeURIComponent(end_year) + 
										"&current=" + current + "&skill_array=" + skill_array + "&titleID=" + titleID;						

					$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=edit_work")).done(function(data){
						window.location = "employee.php?page=work_skills_menu";
					})			
				break;
			}
		return false;
		});	
		
		$(".save_new_work").click(function() {		
			$('.error').hide();	
			new_company = $('#new_company').val();
			new_position = $('#new_title').val();
			new_business_type = $('#new_business_type').val();							
			new_start_month = parseInt($('#new_start_month').val());
			new_start_year = parseInt($('#new_start_year').val());
			new_end_month = parseInt($('#new_end_month').val());
			new_end_year = parseInt($('#new_end_year').val());
			new_titleID = $('#new_position').val();
			broad_category = ($('#new_position').find(':selected').data('broad'));
			var new_job_type = ($('#new_job_category').find(':selected').attr('class'));

			if ($('#new_current_employment').is(':checked') ) {
				new_current = 'Y'
			} else {
				new_current = 'N'
			}		
			

//get selected skills
			var skill_count = 0;
			var skill_array = [];
			
			//loop though job titles looking for selected items
		     $('.skill_reference_new').each(function () {
		 		if ($(this).hasClass('active')) {	
		 			selected_skill = $(this).data('skill');
		 			selected_skill = encodeURIComponent(selected_skill);
		 			skill_array.push(selected_skill);	
		 			skill_count++;	
		 		}
		     });	
		     
			 if (skill_count == 0) {
				 skill_array = "NA";
			 }
			 
			//create conditions for continuing		
			if (new_company.length == 0 ) {
				condition = "empty_company";				
			} else if (new_titleID == "NA") {
				condition = "empty_position";	
			} else if (new_position.length == 0) {
				condition = "empty_title";	
			} else if (new_business_type == '0') {
				condition = "empty_type";
			} else if(isNaN(new_start_year)) {
				condition = "start_year";
			} else if(isNaN(new_end_year) && new_current == "N") {
				condition = "end_year";									
			} else if(new_start_year < 1950) {
				condition = "start_year";
			} else if(new_current == 'N' &&	new_start_year < 1950) {
				condition = "end_year";	
			} else if (new_current == 'N' && new_start_year > new_end_year) {
				condition = "greater";
			} else if (new_current == 'N' && new_start_year == new_end_year && new_start_month > new_end_month) {
				condition = "greater";				
			} else {
				condition = "save";			
			}
			
			//alert(condition);
			switch(condition) {
				case "empty_company":
					$('#empty_company_new').show();	
					$('.new_company_form').addClass('has-error');					
					window.scrollTo(0, 0);
				break;
				
				case "empty_position":
					$('#empty_position_new').show();	
					$('.new_position_form').addClass('has-error');					
					window.scrollTo(0, 0);
				break;						

				case "empty_title":
					$('#empty_title_new').show();	
					$('.new_title_form').addClass('has-error');					
					window.scrollTo(0, 0);
				break;						

				case "empty_type":
					$('#empty_type_new').show();	
					$('.new_type_form').addClass('has-error');					
					window.scrollTo(0, 0);
				break;	
			
				case "start_year":
					$('#empty_year_new').show();	
					$('.new_start_date').addClass('has-error');					
					window.scrollTo(0, 0);
				break;

				case "end_year":
					$('#empty_year_new').show();	
					$('.new_end_date').addClass('has-error');					
					window.scrollTo(0, 0);
				break;
				
				case "greater":
					$('#bad_dates_year_new').show();
					$('.new_end_year_form').addClass('has-error');					
					$('.new_start_year_form').addClass('has-error');					
					window.scrollTo(0, 0);
				break;								
								
				case "save":
					$('.container').hide();			
					$('#loader').show();			
					dataString = "company=" + encodeURIComponent(new_company) + 
										"&business_type=" + new_business_type + "&position=" + encodeURIComponent(new_position) + "&broad_category=" + encodeURIComponent(broad_category) + 
										"&start_month=" + encodeURIComponent(new_start_month) + "&start_year=" + encodeURIComponent(new_start_year) +
										"&end_month=" + encodeURIComponent(new_end_month) + "&end_year=" + encodeURIComponent(new_end_year) + 
										"&current=" + new_current + "&skill_array=" + skill_array + "&titleID=" + new_titleID;						

					$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=add_work")).done(function(data){
						window.location = "employee.php?page=work_skills_menu";
					})			
				break;
			}
		return false;
		});			
				
}

function employee_edit_education(){	
											
		$(".edit_education").click(function() {	
			var educationID = $(this).attr('ID');
			//alert(educationID);
			$('#new_education_button_holder').hide();		
			$('.education_row').hide();		
			$(".education_input[data-education_id="+educationID+"]").show();		
			return false;
		})

		$(".cancel_edit_education").click(function() {	
			$('.education_input').hide();		
			$('.education_row').show();
			$('#new_education_button_holder').show();		
			return false;
		})
		
		$(".remove_education_button").click(function() {	
			var educationID = $(this).attr('ID');
			//alert(educationID)
			$('.education_row').hide();		
			$(".delete_warning[data-education_id="+educationID+"]").show();		
			return false;
		})

		$(".cancel_remove_education").click(function() {	
			$('.delete_warning').hide();		
			$('.education_row').show();
			return false;
		})
		
		$("#add_education_button").click(function() {	
			$('.education_row').hide();		
			$('#add_education_button').hide();		
			$("#new_education_holder").show();					
			return false;
		})
		
		$("#cancel_new_education").click(function() {	
			$("#new_education_holder").hide();		
			$('.education_row').show();		
			$('#add_education_button').show();		
			return false;
		})		
		
		$(".save_education_edit").click(function() {
			$('.error').hide();

			educationID = $(this).attr('ID');
			//alert(educationID);
			school = $(".edit_school[data-education_id="+educationID+"]").val().trim();	
			degree = $(".edit_degree[data-education_id="+educationID+"]").val().trim();	
			type = $(".edit_education_type[data-education_id="+educationID+"]").val().trim();	

			dataString = "educationID=" + educationID + "&school=" + encodeURIComponent(school) + "&degree=" + encodeURIComponent(degree) + "&type=" + encodeURIComponent(type);
			//alert(dataString);
			if (school.length == 0) {
				$('#school_empty_warning_' + educationID + '').show();	
				$('#school_form_'+educationID+'').addClass('has-error');					
			} else {
				$('.container').hide();			
				$('#loader').show();			
				$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=edit_education")).done(function(data){
					//alert(data);
					window.location.reload();
				});																						
			}					
			return false;					
		});	
		
		$(".remove_education").click(function() {
			$('.error').hide();
			$('.container').hide();			
			$('#loader').show();			
			
			educationID = $(this).attr('ID');	
				
			dataString = "educationID=" + educationID;
			$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=remove_education")).done(function(data){
				window.location.reload();
			});																						
			return false;			
		});		
		
		$("#save_new_education").click(function() {
			$('.error').hide();

			school = $('#new_school').val().trim();
			degree = $('#new_degree').val().trim();
			type = $('.new_education_type').val();

			if (school.length == 0) {
				$('#new_school_empty_warning').show();
				$('#new_school_form').addClass('has-error');					
			} else {
				$('.container').hide();			
				$('#loader').show();			
				dataString = "school=" + encodeURIComponent(school) + "&degree=" + encodeURIComponent(degree) + "&type=" + encodeURIComponent(type);

				$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=add_education")).done(function(data){
					//alert(data);
					window.location.reload();
				});																						
			}					
			return false;					
		});	
		
}

function employee_edit_certification() {

		$(".edit_certification").click(function() {	
			var certificationID = $(this).attr('ID');
			$('.certification_row').hide();		
			$('#new_certification_button_holder').hide();
			$('.award_row').hide();		
			$('#new_award_button_holder').hide();							
			$(".certification_input[data-certification_id="+certificationID+"]").show();
			return false;
		})

		$(".cancel_edit_certification").click(function() {	
			$('.certification_input').hide();		
			$('.certification_row').show();
			$('#new_certification_button_holder').show();		
			$('.award_row').show();		
			$('#new_award_button_holder').show();		
			return false;
		})
				
		$(".edit_common").change(function() {
			var certification_text = ($(this).find(':selected').text());
			var certificationID = ($(this).find(':selected').attr('class'));

			if (certificationID > 0 || certificationID == "new") {
				$("#certification_"+certificationID+"").attr('value', certification_text);
			}

			return false;
		})
		
		
		$("#add_certification_button").click(function() {	
			$('.certification_row').hide();		
			$('#add_certification_button').hide();	
			$('.award_row').hide();		
			$('#new_award_button_holder').hide();		
				
			$(".new_certification_input").show();					
			return false;
		})
		
		$(".cancel_new_certification").click(function() {	
			$(".new_certification_input").hide();		
			$('.certification_row').show();		
			$('#add_certification_button').show();	
			$('.award_row').show();		
			$('#new_award_button_holder').show();						
			return false;
		})												
	
	
		$(".edit_award").click(function() {	
			var awardID = $(this).attr('ID');
			$('.award_row').hide();		
			$('#new_award_button_holder').hide();		
			$('.certification_row').hide();		
			$('#new_certification_button_holder').hide();
			$(".award_input[data-award_id="+awardID+"]").show();		
			return false;
		})

		$(".cancel_edit_award").click(function() {	
			$('.award_input').hide();		
			$('.award_row').show();
			$('#new_award_button_holder').show();		
			$('.certification_row').show();		
			$('#new_certification_button_holder').show();
			return false;
		})
		
		$(".remove_award_button").click(function() {	
			var awardID = $(this).attr('ID');
			//alert(awardID)
			$('.award_row').hide();		
			$(".delete_warning[data-award_id="+awardID+"]").show();		
			return false;
		})

		$(".cancel_remove_award").click(function() {	
			$('.delete_warning').hide();		
			$('.award_row').show();
			return false;
		})
		
		$("#add_award_button").click(function() {	
			$('.award_row').hide();		
			$('#add_award_button').hide();		
			$('.certification_row').hide();		
			$('#add_certification_button').hide();	

			$(".new_award_input").show();					
			return false;
		})
		
		$(".cancel_new_award").click(function() {	
			$(".new_award_input").hide();		
			$('.award_row').show();		
			$('.certification_row').show();		
			$('#add_certification_button').show();	

			$('#add_award_button').show();		
			return false;
		})												
		
//Save and remove action buttons		
		$(".save_new_certification").click(function() {	
			$('.error').hide();
			certification = $('.new_certification').val().trim();
			
			if (certification.length == 0) {
				$('#new_certification_empty_warning').show();
				$('#new_certification_form').addClass('has-error');					
			} else {
				$('.container').hide();
				$('#loader').show();
				dataString = "certification=" + encodeURIComponent(certification);								
				$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=add_certification")).done(function(data){
					window.location.reload();
				});	
			}
			return false;
		})
											
		
		$(".save_certification_edit").click(function() {
			$('.error').hide();

			certificationID = $(this).attr('ID');
			certification = $(".edit_certification_holder[data-certification_id="+certificationID+"]").val().trim();	

			//alert(dataString);
			if (certification.length == 0) {
				$('#certification_empty_warning_' + certificationID + '').show();			
				$('#certification_form_'+certificationID+'').addClass('has-error');					
			} else {
				dataString = "certificationID=" + certificationID + "&certification=" + encodeURIComponent(certification);
				
				$('.container').hide();			
				$('#loader').show();			
				$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=edit_certification")).done(function(data){
					window.location.reload();
				});																						
			}					
			return false;					
		});	
		

		$(".save_award_edit").click(function() {
			$('.error').hide();

			awardID = $(this).attr('ID');
			award = $(".edit_award_holder[data-award_id="+awardID+"]").val().trim();	

			if (award.length == 0) {
				$('#award_empty_warning_' + awardID + '').show();						
				$('#award_form_'+awardID+'').addClass('has-error');					
			} else {
				dataString = "awardID=" + awardID + "&award=" + encodeURIComponent(award);

				$('.container').hide();	
				$('#loader').show();					
				$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=edit_award")).done(function(data){
					//alert(data);
					window.location.reload();
				});																						
			}					
			return false;					
		});	
		
		$(".remove_certification").click(function() {
			$('.error').hide();
			
			certificationID = $(this).attr('ID');		
			dataString = "certificationID=" + certificationID;
			$('.container').hide();	
			$('#loader').show();					
			$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=remove_certification")).done(function(data){
				//alert(data);
				window.location.reload();
			});																						
			return false;			
		});				
				
		$(".remove_award").click(function() {
			$('.error').hide();
			
			awardID = $(this).attr('ID');		
			dataString = "awardID=" + awardID;
			$('.container').hide();	
			$('#loader').show();					
			$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=remove_award")).done(function(data){
				//alert(data);
				window.location.reload();
			});																						
			return false;			
		});		

		$(".save_new_award").click(function() {
			$('.error').hide();
			
			award = $('.new_award').val().trim();

			if (award.length == 0) {
				$('#new_award_empty_warning').show();
				$('#new_award_form').addClass('has-error');					
			} else {
				$('.container').hide();
				$('#loader').show();
				dataString = "award=" + encodeURIComponent(award);
				$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=add_award")).done(function(data){
					//alert(data);
					window.location.reload();
				});																						
			}					
			return false;					
		});	
}

function employee_general_info() {
	
	$(".edit").click(function() {	
		$('.main_row').hide();		
		var input_row = $(this).attr('ID')
		$("."+input_row+"_input").show();
		return false;
	})

	$(".cancel").click(function() {	
		$('.input').hide();		
		$('.main_row').show();
		return false;
	})	

	$(".language_button ").click(function() {	
		$(this).toggleClass("active");
		
		if ($(this).hasClass("active")) {
			$(this).children('.fa-circle-thin').hide();
			$(this).children('.fa-check').show();
		} else {
			$(this).children('.fa-check').hide();
			$(this).children('.fa-circle-thin').show();			
		}
	})
	
	$(".seeking_button ").click(function() {	
		$(this).toggleClass("active");
		
		if ($(this).hasClass("active")) {
			$(this).children('.fa-circle-thin').hide();
			$(this).children('.fa-check').show();
		} else {
			$(this).children('.fa-check').hide();
			$(this).children('.fa-circle-thin').show();			
		}
	})	
	
	$(".save_zip").click(function() {
		$('.error').hide();
		$('.zip_form').removeClass('has-error');					

		zip = $('.edit_zip').val().trim();

		if (isNaN(zip) == true || zip.length != 5) {
			$('#zip_empty_warning').show();	
			$('.zip_form').addClass('has-error');					
		} else {
		    dataString = "zip=" + encodeURIComponent(zip);

			$('.container').hide();			
			$('#loader').show();			
			$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=employee_zip")).done(function(data){
				if (data == "zip") {
					$('.zip_form').addClass('has-error');					
					$('.container').show();			
					$('#loader').hide();			
					$('#zip_invalid_warning').show();	
				} else {
					//alert(data);
					window.location.reload();
				}
			});																						
		}					
		return false;					
	});	

	$(".save_name").click(function() {
		$('.error').hide();

		first_name = $('.edit_first_name').val().trim();
		last_name = $('.edit_last_name').val().trim();

		if (first_name.length == 0 || last_name.length == 0) {
			$('#name_empty_warning').show();	
			$('.name_form').addClass('has-error');					
		} else {
		    dataString = "first_name=" + encodeURIComponent(first_name) + "&last_name=" + encodeURIComponent(last_name);

			$('.container').hide();			
			$('#loader').show();			
			$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=employee_name")).done(function(data){
				//alert(data);
				window.location.reload();
			});																						
		}					
		return false;					
	});	
	
	$(".save_phone").click(function() {
		$('.error').hide();

		raw_phone = $('.edit_phone').val().trim();	
		contact_phone = raw_phone.replace(/[^\d.]/g, "");

		if (contact_phone.length != 10) {
			$('#phone_empty_warning').show();	
			$('.phone_form').addClass('has-error');					
		} else {
		    dataString = "phone=" + encodeURIComponent(contact_phone);

			$('.container').hide();			
			$('#loader').show();			
			$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=employee_phone")).done(function(data){
				//alert(data);
				window.location.reload();
			});																						
		}					
		return false;					
	});
	
	$(".save_email").click(function() {
		$('.error').hide();
		
		email = $('.edit_email').val().trim();	
			
		dataString = "new_email=" + email;
		//alert(dataString);
		if (email.length == 0) {
			$('#email_empty_warning').show();	
			$('.email_form').addClass('has-error');					
		} else {
			$('.container').hide();			
			$('#loader').show();			
			$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=new_email")).done(function(data){
				//alert(data);
				if (data == "email") {
					$('#email_empty_warning').show();	
					$('.email_form').addClass('has-error');		
				} else if (data == "duplicate") {
					$('#email_duplicate_warning').show();	
					$('.email_form').addClass('has-error');										
				} else {
					window.location.reload();
				}
			});																						
		}
		return false;					
	});			
	
	$(".save_languages").click(function() {
		$('.error').hide();

		var allVals = [];
	     $('.language_button').each(function() {
	     	//alert("check");
	     	if ($(this).hasClass('active')) {
	     		allVals.push($(this).attr('id'));
	     	}
	    });		

	    dataString = "languages=" + allVals;
		$('.container').hide();			
		$('#loader').show();			
		$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=employee_languages")).done(function(data){
			//alert(data);
			window.location.reload();
		});																						

		return false;					
	});	
	
	$(".save_seeking").click(function() {

		var allVals = [];
	     $('.seeking_button').each(function() {
	     	//alert("check");
	     	if ($(this).hasClass('active')) {
	     		allVals.push($(this).attr('id'));
	     	}
	    });		

	    dataString = "seeking=" + allVals;
	    //alert(dataString);
		$('.container').hide();			
		$('#loader').show();			
		$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=update_seeking_group")).done(function(data){
			//alert(data);
			window.location.reload();
		});																						

		return false;					
	});	

}

function employee_personal_menu(device){	
	$("#summary_button").click(function() {
			window.location = "employee.php?page=edit_personal_info";
			return false;			
		});
		
	$("#photo_button").click(function() {
			window.location = "employee.php?page=edit_photos";
			return false;			
		});		
		
//Banner buttons	
		$("#trait_holder_button").click(function(evt) {
			evt.stopImmediatePropagation(); 		//prevents double firing of event
			large_button_toggle("trait_options", "traits_main_button", "selected_job_areas", "unselected_job_areas", "trait_button");
			return false;			
		});
		
	$("#name_holder_button").click(function() {
			window.location = "employee.php?page=settings";
			return false;			
		});		
		
				
//Higlight-able selection buttons
	$(".trait_button").click( {selected_class: "selected_job_titles", unselected_class: "unselected_job_titles"}, trait_button_selection);						 

	$(".language_button").click( {selected_class: "selected_job_titles", unselected_class: "unselected_job_titles"}, sub_button_selection);						 
		
	$("#save_changes").click(function() {
		$('#trait_options').hide();
		
			var trait_array = [];
			var language_array = [];

			var trait_count = 0;
			var language_count = 0;
			
		     $('.trait_button').each(function () {
			 		if ($(this).data('status') == "selected") {	
			 			selected_trait = $(this).data('trait');
			 			trait_array.push(selected_trait);	
			 			trait_count++;	
			 		}
		     });
		     
		     $('.language_button').each(function () {
			 		if ($(this).data('status') == "selected") {
			 			selected_language = $(this).data('language');
			 			//alert(selected_language)
			 			language_array.push(selected_language);	
			 			language_count++;	
			 		}
		     });			     	

		dataString = "trait_array=" + trait_array + "&language_array=" + language_array;
		//alert(dataString);
		$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=edit_traits_languages", device)).done(function(data){
			//alert(data);
			window.location.reload();
		});																						
		return false;					
	});	
}

function employee_personal_info() {

	$('#quote').keyup(function () {
		var max = 70;
		var len = $(this).val().length;
		if (len >= max) {
	    	$('#charNum').text(' You have reached the text limit');
		} else {
	    	var char = max - len;
			$('#charNum').text(char + ' characters left');
		}
	});

	$("#save_descriptions").click(function() {
		$('.container').hide();
		$('#loader').show();
		
		quote = $('#quote').val().trim();
		description = $('#long_description').val().trim();
		dataString = "quote=" + encodeURIComponent(quote) + "&description=" + encodeURIComponent(description);
		//alert(dataString);
		$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=edit_descriptions")).done(function(data){
			window.location = "employee.php";
		});																						
		return false;					
	});	
}

function employee_edit_resume(resume) {
		$(document).on("click", '.save_resume', function() {
			$('.error').hide();
			resume = $('#resume_file').val();
			if (resume != "") {
				var fileExtension = ['pdf'];
		        if ($.inArray($('#resume_file').val().split('.').pop().toLowerCase(), fileExtension) == -1) {
		            //show file type error
					$('#file_type_warning').show();		            
        		} else {
					$("#resume_upload_button").click();	        		
        		}
			} else {
	            //show file type error
				$('#file_empty_warning').show();
			}
					return false;					
			});	
			
		$(document).on("click", '.view_resume', function() {
			window.location = "resumes/" + resume;
		})					
			
		$(document).on("click", '.remove_resume', function() {
				dataString = "resume=" + resume;
				$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=remove_resume", "")).done(function(data){
					//alert(data);
					window.location.reload();
				});																						
		});																						
																						
}

function employee_edit_photos() {
	photo_functions_mobile();
}


//END NEW FUNCTIONS


function photo_functions_mobile() {

			$("#profile_pic_choose").change(function(){	
				$(".container").hide();	
				$(".warning").hide();	
/*
				$("#loader_percentage_box").show();
				$("#loader_box").show();								
*/
			    input = this;
			   // alert(input.files);
				if (input.files && input.files[0]) {
					if (input.files[0].size > 5000000) {
						$(".container").show();	
/*
						$("#loader_percentage_box").hide();
						$("#loader_box").hide();									
*/
						$("#file_size_warning").show();	
					} else if (input.files[0].type == "image/png" || input.files[0].type == "image/jpg" || input.files[0].type == "image/jpeg") {
						$("#profile_upload_button").click();
						return false;
					} else {
						$(".container").show();	
/*
						$("#loader_percentage_box").hide();													
						$("#loader_box").hide();									
*/
						$("#file_type_warning").show();	
					}		
			} 	    
		});
		
		$("#bartender_pic_choose").change(function(){
			$(".container").hide();	
			$(".warning").hide();	
/*
			$("#loader_percentage_box").show();								
			$("#loader_box").show();									
*/
			    input = this;
				if (input.files && input.files[0]) {
					if (input.files[0].size > 5000000) {
						$(".container").show();	
/*
						$("#loader_percentage_box").hide();	
						$("#loader_box").hide();									
*/
						$("#file_size_warning").show();	
					} else if (input.files[0].type == "image/png" || input.files[0].type == "image/jpg" || input.files[0].type == "image/jpeg") {
						$("#bartender_upload_button").click();						
						return false;
					} else {
						$(".container").show();	
/*
						$("#loader_percentage_box").hide();													
						$("#loader_box").hide();									
*/
						$("#file_type_warning").show();	
					}
			}				 	    
		});
		
		$("#bartender_upload_button_ie").click(function(){
			//alert("here");
			//$('#loader_box').dialog("open");	
		});		
		$("#kitchen_upload_button_ie").click(function(){
			//alert("here");
			//$('#loader_box').dialog("open");	
		});				
	
		$("#profile_upload_button_ie").click(function(){
			//alert("here");
			//$('#loader_box').dialog("open");	
		});	
		
		$(".upload_cancel").click(function(){
			//alert("cancel");
			cancel_type = $(this).attr("ID");
			switch(cancel_type) {
				case "profile":
	  				$('#profile_form_ie').hide();					
	  				$('#profile_pic').show();				 	    						 	    		
	  				$('#photo_buttons').show();	  																							  							  				
				break;
				
				case "bar":
	  				$('#bar_form_ie').hide();		
	  				$('.holder_Bartender').show();				 	    						 	    			  																						  				
				break;
				
				case "kitchen":
	  				$('#kitchen_form_ie').hide();		
	  				$('.holder_Kitchen').show();				 	    						 	    			  																						  				
				break;				
			}
		});								
									

		$("#kitchen_pic_choose").change(function(){
			$(".container").hide();	
			$(".warning").hide();	
/*
			$("#loader_percentage_box").show();								
			$("#loader_box").show();									
*/
		    input = this;
			if (input.files && input.files[0]) {
				if (input.files[0].size > 5000000) {
						$(".container").show();	
/*
						$("#loader_percentage_box").hide();	
						$("#loader_box").hide();									
*/
						$("#file_size_warning").show();	
				} else if (input.files[0].type == "image/png" || input.files[0].type == "image/jpg" || input.files[0].type == "image/jpeg") {
					$("#kitchen_upload_button").click();						
					return false;
				} else {
						$(".container").show();	
/*
						$("#loader_percentage_box").hide();													
						$("#loader_box").hide();									
*/
						$("#file_type_warning").show();	
				}		
			}		    
		});		
				  
		$(".remove_gallery").click(function() {
			gallery_type = $(this).attr('ID');		
			//alert(gallery_type);			
			$("#" + gallery_type + "_photo_view").hide();
			$("#" + gallery_type + "_photo_remove").show();						
			return false;
		});								  

			$(".add_photo").click(function() {			
				pic_type = $(this).attr("id");
				//alert(pic_type);
				//alert(navigator.appName);
				var rv = 0;
				if (navigator.appName == 'Microsoft Internet Explorer') {
				    var ua = navigator.userAgent;
				    var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
				    if (re.exec(ua) != null)
				    rv = parseFloat( RegExp.$1 );
				    if (rv < 10) {
					    browser = "low_ie";
				    } else {
					    browser = "normal";
				    }
				 } else {
					 browser = "normal";
				 }
				  //alert(browser);
				switch(pic_type) {
					case "profile":
						  switch(browser) {
							  case "normal":
							  	$("#profile_pic_choose").click();																			  
							  break;
							  
							  case "low_ie":
				  				$('#photo_buttons').hide();
				  				$('#profile_pic').hide();				 	    						 	    		
				  				$('#profile_form_ie').show();																				  							  
							  break;
						  }
					break;
					
					case "bartender":
						  switch(browser) {
							  case "normal":
							  	$("#bartender_pic_choose").click();													
							  break;
							  
							  case "low_ie":
				  				$('.holder_Bartender').hide();				 	    						 	    		
				  				$('#bar_form_ie').show();																				  
							  break;
						  }
					break;

					case "kitchen":
						  switch(browser) {
							  case "normal":
							  	$("#kitchen_pic_choose").click();													
							  break;
							  
							  case "low_ie":
				  				$('.holder_Kitchen').hide();				 	    						 	    		
				  				$('#kitchen_form_ie').show();																				  
							  break;
						  }
					break;							
				}
				return false;
			});					
			
			$(".remove_photo").click(function() {
			   $(".button_holder_photo").hide();		   
				photoID = $(this).attr("ID");
				if (window.confirm("Remove photo?")) {
					$('.main_box').hide();
					dataString = "photoID=" + photoID;
					$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=remove_photo", "mobile")).done(function(data){
						//alert(data);
						window.location = "employee.php?page=edit_photos";
					});																						
				} else {
				   $(".button_holder_photo").show();		   
				}
				return false;
			});	

				var status = $('#status');
$('form').ajaxForm({
    beforeSend: function() {
        status.empty();
        var percentVal = '0%';
       // bar.width(percentVal)
        //percent.html(percentVal);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
//		alert(percentVal);
        $("#loader_percentage").replaceWith("<span id='loader_percentage'><font size='6px'>" + percentVal + "</font></span>");
        
         //  alert(percentVal);

       // bar.width(percentVal)
        //percent.html(percentVal);
    },
    success: function() {
        var percentVal = '100%';
        //bar.width(percentVal)
      //  percent.html(percentVal);
    },
	complete: function(xhr) {
		//alert(xhr.responseText);
		if(xhr.responseText == "Successful") {
			window.location.reload();	
		} else {
			$(".main_box").show();	
			$("#loader_percentage_box").hide();													
			status.html(xhr.responseText);
		}
	}
});										
					
			$("#delete_photo").click(function() {
				dataString = "type=profile";
				$(".main_box").hide();	
					$.when(send_ajax(dataString, "ajax/employee.ajax.php?type=remove_photo", "mobile")).done(function(data){
						//alert(data);
						window.location.reload();
					});																						
				return false;
			});																
}

