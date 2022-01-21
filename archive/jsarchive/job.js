function job_employer(jobID) {
	
		//add clear fix divs for spacing
		var clear_count = 1
	    $('.clearfix').each(function () {
		     	var clearID = $(this).data('user') 
	 			if (clear_count % 2 == 0) {
		 			$('#clear_'+clearID).show();
		 			$(this).addClass("visible-xs");						     								
	 			} else {
		 			$('#clear_'+clearID).hide();
		 			$(this).removeClass("visible-xs");						     								
	 			}
	 			
	 			if (clear_count % 4 == 0) {
		 			$('#clear_'+clearID).show();
		 			$(this).addClass("visible-md");						     								
		 			$(this).addClass("visible-lg");						     								
	 			} else {
		 			$('#clear_'+clearID).hide();
		 			$(this).removeClass("visible-md");						     								
		 			$(this).removeClass("visible-lg");						     								
	 			}
	 			
	 			clear_count++;
	     });	
	

//JOB INTO TOGGLE
	$(document).on("click", '.toggle', function() {
		button = $(this).attr('ID');
		$('.holder').hide();
		
		switch(button) {
			case "filter":
				$('#filter_holder').show();			
			break;
			
			case "stats":
				$('#stats_holder').show();			
			break;
		}
		return false;
	});	
	
	$(".skill_button ").click(function() {	
		$(this).toggleClass("active");
		
		if ($(this).hasClass("active")) {
			$(this).children('.fa-circle-thin').hide();
			$(this).children('.fa-check').show();
		} else {
			$(this).children('.fa-check').hide();
			$(this).children('.fa-circle-thin').show();			
		}
		
		if ($(this).data('job_skill_filter') == "selected") {
			$(this).data('job_skill_filter', 'unselected');
		} else {
			$(this).data('job_skill_filter', 'selected');
		}
		

		 $(".candidate_row").show();
		 
		 var skill_filter_count = 0;
		//loop through all checked skills put them into an array
		skill_list = new Array;
	     $('.skill_button').each(function () {
	     		checked_skill = $(this).data('skill');
	     		if ($(this).data('job_skill_filter') == "selected") {
		 			skill_list.push(checked_skill);
		 			skill_filter_count++;
		 		}
	     });	

		//loop through candidates, test for skill, then flag
			 $('.candidate_row').each(function() {
			 		skill_data = $(this).data('skills');
			 		filter_test = matchAll(skill_data, skill_list);
				   if (filter_test) {
					   $(this).data('candidate_skill_filter', 'show');
				   } else {
					   $(this).data('candidate_skill_filter', 'hide');						   
				   }
				   
				if ($(this).data('candidate_skill_filter') == "show" && $(this).data('experience_filter') == "show") {
					$(this).show();
				} else {
					$(this).hide();						
				}						   	     				   
			 });	
			//show note that skills are filtered
			if (skill_filter_count > 0) {
				$('#skill_filter_warning').show();
			} else {
				$('#skill_filter_warning').hide();		
			}		 			 
		
	})
	

	$(document).on("click", '.skill_filter_span', function(evt) {
		
		evt.stopImmediatePropagation(); 		//prevents double firing of event
		//alert("HERE");
		//first toggle the filter flag on the selected skill
		if ($(this).data('job_skill_filter') == "selected") {
			$(this).data('job_skill_filter', 'unselected');
			$(this).removeClass('selected_button');
			$(this).addClass('unselected_button');		
		} else {
			$(this).data('job_skill_filter', 'selected');
			$(this).removeClass('unselected_button');
			$(this).addClass('selected_button');			
		}
		
		 $(".candidate_row").show();
		 
		 var skill_filter_count = 0;
		//loop through all checked skills put them into an array
		skill_list = new Array;
	     $('.skill_filter_span').each(function () {
	     		checked_skill = $(this).data('skill');
	     		if ($(this).data('job_skill_filter') == "selected") {
		 			skill_list.push(checked_skill);
		 			skill_filter_count++;
		 		}
	     });	

		//loop through candidates, test for skill, then flag
			 $('.candidate_row').each(function() {
				 	userID = $(this).data('userID');
			 		skill_data = $(this).data('skills');
			 		filter_test = matchAll(skill_data, skill_list);
			 		//alert(filter_test);			 		
				   if (filter_test) {
					   $(this).data('candidate_skill_filter', 'show');
				   } else {
					   $(this).data('candidate_skill_filter', 'hide');						   
				   }
				   
				if ($(this).data('candidate_skill_filter') == "show" && $(this).data('experience_filter') == "show") {
					$(this).show();
				} else {
					$(this).hide();						
				}						   	     				   
			 });	
	//show note that skills are filtered
	if (skill_filter_count > 0) {
		$('#skill_filter_warning').show();
	} else {
		$('#skill_filter_warning').hide();		
	}		 			 
});	

	
  $(function() { 
  	$( "#slider1" ).slider({
    	value:0,
		min: 0,
		max: 20,
		step: 1,
		slide: function( event, ui ) {
        	$( "#amount" ).val( ui.value + " year(s)" );
			 $('.candidate_row').each(function() {
			 	experience = $(this).data('experience');
					if (experience < ui.value) {
					   $(this).data('experience_filter', 'hide');
					} else {
					   $(this).data('experience_filter', 'show');
					}
					
					if ($(this).data('candidate_skill_filter') == "show" && $(this).data('experience_filter') == "show") {
						$(this).show();
					} else {
						$(this).hide();						
					}						   	     				   							 	
			 });
			if (ui.value > 0) {
				$('#experience_filter_warning').show();
			} else {
				$('#experience_filter_warning').hide();		
			}			        	
		}
    });
    
    $( "#amount" ).val($( "#slider1" ).slider( "value" ) + " year(s)" )		 			 
    
  });								
					
	$(".sort_candidates").click(function() {
		sort_type = $(this).attr('ID');
		if (sort_type == "normal") {
			$('#candidates').hide();
			$('#candidates_reverse').show('fast');
		} else if (sort_type == "reverse") {
			$('#candidates_reverse').hide();
			$('#candidates').show('fast');							
		}
		return false;
	})
					
	$(".filter").click(function() {
		filter_type = $(this).attr("ID");
		//alert(filter_type);	
		switch(filter_type) {
			case "all_filter":
				$('.filter').css("background-color", "");							
				$('#all_filter').css("background-color", "#4c0100");
				$('.candidate_row').show('fast');
			break;
		
			case "video_filter":
				$('.filter').css("background-color", "");							
				$('#video_filter').css("background-color", "#4c0100");
				$('.candidate_row').hide();
				$('.candidate_video').show('fast');								
			break;
			
			case "photo_filter":
				$('.filter').css("background-color", "");							
				$('#photo_filter').css("background-color", "#4c0100");
				$('.candidate_row').hide();
				$('.candidate_photo').show('fast');								
			break;

			case "response_filter":
				$('.filter').css("background-color", "");							
				$('#response_filter').css("background-color", "#4c0100");
				$('.candidate_row').hide();
				$('.candidate_message').show('fast');								
			break;							
		}					
		return false;
	});	

	$(document).on("click", '.highlight', function() {	
		//alert("here");				
			matchID = $(this).attr('ID');
			dataString = "matchID=" + matchID + "&highlight=Y";				
			//alert(dataString);		
			$.when(send_ajax(dataString, "ajax/candidate.ajax.php?type=highlight", "full")).done(function(data){
				//alert(data);
				window.location.reload();
			});							
			return false;
		});		
		
	$(document).on("click", '.unhighlight', function() {					
			matchID = $(this).attr('ID');
			dataString = "matchID=" + matchID + "&highlight=N";
			
			$.when(send_ajax(dataString, "ajax/candidate.ajax.php?type=highlight", "full")).done(function(data){
				//alert(data);
				window.location.reload();
			});							
			return false;
		});										
																						
/*
			$(document).on("click", '.close_job', function() {					
				$(".main_box").hide();
				$("#close_job_form").show();
				return false;
			});	
							
			$(document).on("click", '.unfill', function() {					
				$(".main_box").hide();
				$("#unfill_form").show();
				return false;
			});																																																																														

			$(document).on("click", '.cancel_fill', function() {					
				$("#close_job_form").hide();
				$(".main_box").show();
				return false;
			});																																																																														

			$(document).on("click", '.cancel_unfill', function() {					
				$("#unfill_form").hide();
				$(".main_box").show();
				return false;
			});																																																																														
											
			$(document).on("click", '#close_job_action', function() {	
				$("#close_job_form").hide();
					dataString = "jobID=" + jobID;
					//alert(dataString);
					$.when(send_ajax(dataString, "ajax/job.ajax.php?type=close_job", "mobile")).done(function(data){
						//alert(data);
						window.location = "job_list.php";
					});																		
					return false;
				});
					
			$(document).on("click", '#unfill_job_action', function() {																						
				$("#unfill_form").hide();
				dataString = "jobID=" + jobID;
				//alert(dataString);
				$.when(send_ajax(dataString, "ajax/job.ajax.php?type=unfill_job", "mobile")).done(function(data){
					//alert(data);
					window.location = "job_list.php";
				});																		
				return false;
			});	
*/
		
	//used for filtering candidates	
		function matchAll(str, arr) {
			for (var i=0; i<arr.length; ++i) {
				if (str.indexOf(arr[i]) === -1) {
			    	return false;
			    }
			 }
			return true;
		}	     																													
}

function reverse_candidate_order() {
	//reverses the order of candidates on the candidate list
	$(document).on("click", '.reverse_candidates', function() {			
		$(function(){
		    $("tbody.highlight_rows").each(function(elem,index){
		      	var arr = $.makeArray($("tr",this).detach());
			  	arr.reverse();
		        $(this).append(arr);
		    });
		});																											
				
		$(function(){
		    $("tbody.regular").each(function(elem,index){
		      	var arr = $.makeArray($("tr",this).detach());
			  	arr.reverse();
		        $(this).append(arr);
		    });
		});																									
		return false;
	});		
}

		

function location_selection(new_user) {

	$(document).on("click", "#new_location", function() {	
		$('.store_row').hide();
		$('.new_store_holder').show('fast');
		return false;
	});
	
	$(document).on("click", ".cancel_add", function() {	
		$('.new_store_holder').hide();
		$('.store_row').show('fast');
		return false;
	});	
	
	
	$(document).on("click", ".location_select", function() {	
		var storeID = $(this).attr('ID');
		window.location = "job.php?ID=new_job&page=selection&storeID="+ storeID;							
	});
	

	$(document).on("click", ".add_store", function() {	
		$('.error').hide();

		destination = $(this).attr('ID');
				
		store_name = encodeURIComponent($('#name').val().trim());
		if (store_name.length == 0) {
			store_name = encodeURIComponent($('#pac-input').val().trim());			
		}
		
		if (new_user == 'Y') {
			position = $('#position').val();
		} else {
			position = 'NA';
		}
		
		store_website = $('#website').val().trim();
		facebook = $('#facebook').val().trim();
		store_address = encodeURIComponent($('#address').val().trim());
		store_zip = $('#zip').val().trim();
		business_type = $('#description').val();
		
		if (store_name.length == 0 || store_address.length == 0 || store_zip.length == 0) {
			//alert("warning");
			$(window).scrollTop(0);
			$('#store_required_warning').show();
		} else if (business_type == 0 || business_type == null){
			$(window).scrollTop(0);
			$('#location_type_warning').show();			
		} else {
			//$(".main_box").hide();
			dataString = "store_name=" + store_name + "&store_website=" + store_website + "&store_address=" + store_address + "&store_zip=" + store_zip + "&type=" + business_type + "&facebook=" + facebook + "&position=" + position;
			//alert(dataString);
			$.when(send_ajax(dataString, "ajax/store.ajax.php?type=add_store")).done(function(data){
				//alert(data);
				if (data == "zip_error") {
					//$(".main_box").show();
					$('#store_zip_warning').show();
					//$("#loader_box").dialog("close");																								
				} else {
					//$("#loader_box").dialog("close");																																		
					window.location = "job.php?ID=new_job&page=add_photo&storeID="+ data;							
				}
			});											
			
		}	
		return false;	
	});
	
	$(".show_edit_store").click(function() {
		//Get store details and populate form
		var storeID = $(this).attr('ID');
		$(".store_row").hide();					
		$("#edit_store_holder_"+storeID+"").show('fast');	
		return false;
	});	
					
	$(".cancel_edit_store").click(function() {
		$(".edit_store_holder").hide();					
		$(".store_row").show('fast');
		return false;
	});						

	$(".save_store_edit").click(function() {
		$('.error').hide();
	
		var storeID = $(this).attr('ID');
		store_name = $('#edit_location_'+storeID).val();
		store_address = $('#edit_address_'+storeID).val();
		store_zip = $('#edit_zip_'+storeID).val();
		store_website = $('#edit_website_'+storeID).val();
		store_facebook = $('#edit_facebook_'+storeID).val();
		business_type = $('#edit_description_'+storeID).val();
		
		if (store_name.length == 0 || store_address.length == 0 || store_zip.length == 0) {
			//alert("warning");
			$(window).scrollTop(0);
			$('#store_required_warning_'+storeID).show();
		} else if (business_type == 0 || business_type == null){
			$(window).scrollTop(0);
			$('#location_type_warning_'+storeID).show();			
		} else {
			//$(".main_box").hide();
			dataString = "storeID=" + storeID + "&name=" + encodeURIComponent(store_name) + "&website=" + encodeURIComponent(store_website) + "&address=" + encodeURIComponent(store_address) + "&zip=" + store_zip + "&description=" + business_type + "&facebook=" + encodeURIComponent(store_facebook);
			$.when(send_ajax(dataString, "ajax/store.ajax.php?type=edit_store")).done(function(data){
				if (data == "zip") {
					$(window).scrollTop(0);
					$('#store_zip_warning_'+storeID).show();
					//$("#loader_box").dialog("close");																								
				} else {
					//$("#loader_box").dialog("close");																																		
					window.location.reload();						
				}
			});											
			
		}	
		return false;	
});																			
	
	
}

function store_photo(storeID) {
	$(".skip_photo_glug").click(function() {
		window.location = "job.php?ID=new_job&page=selection&storeID="+storeID
		return false;
	});		
	
	
	$(".store_pic_choose").change(function(){
	    input = this;
	    storeID = $(this).data("store_id");

		if (input.files && input.files[0]) {
			if (input.files[0].size > 4000000) {
				$(".container").show();		
				$('#file_size_warning').show();
				//alert("Please choose a file less than 2 MB");
			} else if (input.files[0].type == "image/png" || input.files[0].type == "image/jpg" || input.files[0].type == "image/jpeg") {
					//if (window.confirm("Upload image: " + input.files[0].name + "?")) {
						//alert("here");
						//$("#loader_box").dialog("open");																			
						$("#store_upload_button_"+storeID).click();	
						return false;
					//} else {
					//	window.location.reload();
					//}	
			} else {
				$(".container").show();						
				$('#file_type_warning').show();				
				//alert("File must be a JPEG or PNG image file");
			}		
		} 	    
	});
	
	$(".edit_photo").click(function() {	
		$(".container").hide();		
		storeID = $(this).attr("id");
		//alert(navigator.appName);
/*
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
*/
		  //alert(browser);
//phase out browser junk

		$("#store_pic_choose_"+storeID).click();																			  
		
/*
		switch(pic_type) {
			case "profile":
				  switch(browser) {
					  case "normal":
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
*/
		return false;
	});	
	
	$(".delete_photo").click(function() {
		dataString = "storeID=" + storeID;
		//alert(dataString);
		$.when(send_ajax(dataString, "ajax/employer.ajax.php?type=remove_photo")).done(function(data){
			window.location.reload();
		});																	
		return false;
	});		
		
	var status = $('.status');
	
	$('form').ajaxForm({
	    beforeSend: function() {
	        status.empty();
	        var percentVal = '0%';
	       // bar.width(percentVal)
	        //percent.html(percentVal);
	    },
	    uploadProgress: function(event, position, total, percentComplete) {
	        var percentVal = percentComplete + '%';
	        //$("#loader_percentage").replaceWith("<span id='loader_percentage'><font size='6px'>" + percentVal + "</font></span>");
	        
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
/*
				$(".main_box").show();	
				$("#loader_percentage_box").hide();													
*/
				status.html(xhr.responseText);
			}
		}
	});										
	
}

function job_post_selection(storeID) {
	
	$(document).on("click", ".job_post", function() {	
		var post_type = $(this).attr('ID');
		//alert("test");
		//lets start the job post process
		dataString = "jobID=NA&post_type=" + post_type + "&storeID=" + storeID;
		//alert(dataString);
		$.when(send_ajax(dataString, "ajax/job.ajax.php?type=create_group", "NA")).done(function(data){
				//alert(data);
				if (data == "error") {
					//show error
				} else {
					window.location = "job.php?ID=new_job&page=templates&groupID="+ data;							
				}
			
		});
		
	});
}						

function new_job(job_templates, groupID, storeID) {

	$(document).on("click", "#show_FOH", function() {
		$("#current_posts").hide();
		$(".current_post").hide();
		$('#included_text').hide();	
		$('.more_button').hide();	
		$('#foh_post_options').show('fast');
		$('.foh_main_back').show('fast');	
		return false;								
	});
	
	$(document).on("click", "#show_BOH", function() {
		$("#current_posts").hide();
		$(".current_post").hide();
		$('#included_text').hide();	
		$('.more_button').hide();	
		$('#boh_post_options').show('fast');
		$('.boh_main_back').show('fast');

		return false;									
	});

	$(document).on("click", "#show_all", function() {
		$("#current_posts").hide();
		$(".current_post").hide();
		$('#included_text').hide();	
		$('.more_button').hide();	
		$('#single_post_options').show('fast');
		$('.all_main_back').show('fast');	

		return false;			
	});
	

	$(document).on("click", ".selection_back", function() {
		var selection_type = $(this).attr('ID');
		
		$("#current_posts").show('fast');
		$(".current_post").show('fast');
		$('#included_text').show('fast');	
		$('.more_button').show('fast');	
		
		if (selection_type == "boh_back") {
			$('#boh_post_options').hide();		
		} else if (selection_type == "foh_back") {
			$('#foh_post_options').hide();					
		} else if (selection_type == "all_back") {
			$('#single_post_options').hide();	
		}

		return false;		
	});

		
		$(document).on("click", ".main_skill", function() {	
			$(".post_options").hide();
			$(".job_type_graphic").hide();
			$(".cost_details").hide();

			job_type = $(this).attr('ID');
			template_form = "<h5>Select " + job_type + " Template</h5><br /><select id='job_template' class='form-control'>";
			
			template_form += "<option value='NA'>----- Select a Template -----</option>"; 
			
			for (var i = 0; i < job_templates[job_type].length; i++) {
				template_form += "<option value='" + job_templates[job_type][i]['templateID'] + "'>" + job_templates[job_type][i]['title'] + "</option>"; 
			}
			template_form += "</select><br />";
// 			template_form += " &nbsp; <br />";
			template_form += "- OR -<br />";
			template_form += " &nbsp; <br />";
			template_form += "<a href='#' id='custom_job' data-skill='" + job_type + "'>CREATE CUSTOM JOB</a>";
							
			$("#job_template_holder").show();
			$("." + job_type).show();			
			$(".different").show();
			$( "div.job_templates" ).html(template_form);
			
			return false;
		});
				
		$(document).on("click", ".all_back", function() {	
			//alert("HERE");
			$("#job_template_holder").hide();
			$(".job_type_graphic").hide();
			$("#single_post_options").show();
			$(".cost_details").show();
			return false;		
		});		
		
		$(document).on("click", ".boh_back", function() {	
			$("#job_template_holder").hide();
			$(".job_type_graphic").hide();
			$("#boh_post_options").show();
			$(".cost_details").show();
			return false;		
		});

		$(document).on("click", ".foh_back", function() {	
			$("#job_template_holder").hide();
			$(".job_type_graphic").hide();
			$("#foh_post_options").show();
			$(".cost_details").show();
			return false;		
		});		
		
		$(document).on("change", "#job_template", function() {

			$("#store_warning").hide();	
			$(".job_post_holder").hide();		
			templateID = $(this).val();
			//storeID = $("#storeID").val();
			if (storeID == "new" || storeID < 1) {
				$("#store_warning").show();			
				$(".job_post_holder").show();		
			} else {
				if (templateID != "NA") {	
				  //calculate number of open jobs
				  	dataString = "storeID=" + storeID + "&result_type=open_count"; 
					$.when(send_ajax(dataString, "ajax/job_list.ajax.php?type=jobs_by_store", "NA")).done(function(count){
					
						if(count < 50) {			
							dataString = "templateID=" + templateID + "&storeID=" + storeID + "&groupID=" + groupID + "&jobID=NA";	
							//alert(dataString);								
							$.when(send_ajax(dataString, "ajax/job.ajax.php?type=new_template_job", "NA")).done(function(data){
								//alert(data);
								if(data == "NA") {
									$('#refresh_warning').hide();									
									//$("#loader_box").dialog("close");
									$("#location_warning").show();	
								} else {
									$('#refresh_warning').hide();																		
									//$("#loader_box").dialog("close");
									window.location = "job.php?ID=" + data;	
								}	
							});	
						} else {
							$(".job_post_holder").show();									
/*
							$("#store_warning_box").dialog("open");						
							$("#loader_box").dialog("close");
*/
						}
					});	
			
				}
			}
			return false;
		});

		$(document).on("click", "#custom_job", function() {			
			main_skill = $(this).data('skill');
			$(".job_post_holder").hide();		
			
			//alert(main_skill);
			//	storeID = $('#storeID').val();	
			//alert(storeID);
			if (storeID == "new" || storeID < 1) {
				$("#store_warning").show();	
				$(".job_post_holder").show();						
			} else {
			  //calculate number of open jobs
			  	dataString = "storeID=" + storeID + "&result_type=open_count"; 
				$.when(send_ajax(dataString, "ajax/job_list.ajax.php?type=jobs_by_store", "full")).done(function(count){
					//alert(count);
				
					if(count < 50) {	
						$('.main_box').hide();						
						dataString = "main_skill=" + main_skill + "&storeID=" + storeID +  "&groupID=" + groupID + "&jobID=NA";	
						$.when(send_ajax(dataString, "ajax/job.ajax.php?type=new_custom_job", "full")).done(function(data){
							//alert(data);
							if(data == "NA") {
								$('.main_box').show();	
								$('#refresh_warning').hide();	
							//	$("#loader_box").dialog("close");
										$(".job_post_holder").show();		

								$("#location_warning").show();	
							} else {
								//$("#loader_box").dialog("close");								
								window.location = "job.php?ID=" + data;	
							}	
						});	
					} else {
						$(".job_post_holder").show();		
					}
				});				
			}	
			return false;
		});	
		
		$(document).on("change", "#former_job", function() {
			//alert("here");
			$("#store_warning").hide();
			$(".job_post_holder").hide();		
						
			jobID = $(this).val();
			//storeID = $("#storeID").val();
			if (storeID == "new" || storeID < 1) {
				$("#store_warning").show();	
				$(".job_post_holder").show();		
			} else {
				if (jobID != "NA") {
				
				  //calculate number of open jobs
				  	dataString = "storeID=" + storeID + "&result_type=open_count"; 
					$.when(send_ajax(dataString, "ajax/job_list.ajax.php?type=jobs_by_store", "full")).done(function(count){
						//alert(count);
					
						if(count < 50) {											
							dataString = "jobID=" + jobID + "&storeID=" + storeID + "&groupID=" + groupID;	
							//alert(dataString);
							$('.main_box').hide();	
							$.when(send_ajax(dataString, "ajax/job.ajax.php?type=repost_job", "full")).done(function(data){
								//alert(data);
								$('#former_job').prop('selectedIndex',0);
								if(data == "NA") {
									$('.main_box').show();	
									$('#refresh_warning').hide();	
									//$("#loader_box").dialog("close");
									$("#location_warning").show();
									$(".job_post_holder").show();		
	
								} else {
									//$("#loader_box").dialog("close");
									window.location = "job.php?ID=" + data;	
								}	
							});
						} else {
							$(".job_post_holder").show();		

							//$("#store_warning_box").dialog("open");																
							//$("#loader_box").dialog("close");
						}
					});										
				}
			}
			return false;
		});	
}


function template_edit(jobID, comp_type, comp_value, groupID) {
		
		$(document).on("change", "#compensation_type", function() {
			comp_type = $(this).val();
			
			if (comp_type == "Hourly" || comp_type == "Salary") {
				$("#comp_value_holder").show();				
				if (comp_type == "Hourly") {
					$('.comp_label').text("per Hour");
				} else {
					$('.comp_label').text("per Year");
				}
			} else {
				$("#comp_value_holder").hide();								
			}
			return false;		
		});	
		
		$(document).on("change", "#benefits", function() {
			benefits = $(this).val();
			
			if (benefits == "Y") {
				$("#benefits_description").show();				
			} else {
				$("#benefits_description").hide();								
			}
			return false;		
		});						

		$(document).on("change", "#walkin", function() {
			benefits = $(this).val();
			
			if (benefits == "Y") {
				$("#walkin_description").show();				
			} else {
				$("#walkin_description").hide();								
			}
			return false;		
		});						
	
		
	$(document).on("click", '.sub_skill_button', function() {
	//	evt.stopImmediatePropagation(); 		//prevents double firing of event
		$(this).toggleClass("active");
		
		if ($(this).hasClass("active")) {
			$(this).children('.fa-circle-thin').hide();
			$(this).children('.fa-check').show();
		} else {
			$(this).children('.fa-check').hide();
			$(this).children('.fa-circle-thin').show();			
		}
	});				
			
	
//requirements	
		$(document).on("click", '.requirement', function(evt) {
// 			evt.stopImmediatePropagation(); 		//prevents double firing of event
			
			$(this).toggleClass("active");
			
			if ($(this).hasClass("active")) {
				$(this).children('.fa-circle-thin').hide();
				$(this).children('.fa-check').show();
			} else {
				$(this).children('.fa-check').hide();
				$(this).children('.fa-circle-thin').show();			
			}
		});					

		$(document).on("click", "#save_requirement", function() {
			var allVals = [];
		    $('.requirement').each(function () {
	     		checked_req = $(this).data('requirement_value');
	     		if ($(this).data('requirement') == "selected") {
		 			allVals.push(checked_req);
		 		}
		    });	
			dataString = "jobID=" + jobID + "&requirements=" + allVals;
			//alert(dataString);
			$.when(send_ajax(dataString, "ajax/job.ajax.php?type=update&criteria=requirements", "full")).done(function(data){
				//alert(data);
				window.location.reload();
			});				
			return false;
		});
		
				
//questions	
		$(document).on("click", ".edit_question", function() {
			var questionID = $(this).attr('ID');
			$(".job_details").hide();
			$(".question_holder").hide();
			$("#edit_question_holder_"+questionID).show();
			return false;			
		});

		$(document).on("click", ".cancel_edit_question", function() {
			$(".edit_question_holder").hide();
			$(".job_details").show();
			$(".question_holder").show();
			return false;			
		});
		
		$(document).on("click", "#add_question_button", function() {
			$(".job_details").hide();
			$(".question_holder").hide();
			$(".add_question_row").show();
			return false;			
		});
		
		$(document).on("click", ".cancel_add_question", function() {
			$(".add_question_row").hide();
			$(".job_details").show();
			$(".question_holder").show();
			return false;			
		});

		
		$(document).on("click", ".remove_question", function() {
			questionID = $(this).attr("ID");

			dataString = "jobID=" + jobID + "&questionID=" + questionID + "&question=NA&type=remove";

			$.when(send_ajax(dataString, "ajax/job.ajax.php?type=update&criteria=question")).done(function(data){
				$(".job_details").show();
				$( ".questions_row" ).replaceWith(data);
			});				

			return false;
		});		

		$(document).on("change", ".edit_general_question", function() {
			questionID = $(this).attr("ID");
			templateID = $(this).val();
			$(".edit_question_holder").hide();
			$("#loader").show();

			dataString = "jobID=" + jobID + "&questionID=" + questionID + "&question=NA&template_questionID=" + templateID;
			$.when(send_ajax(dataString, "ajax/job.ajax.php?type=update&criteria=edit_question")).done(function(data){
				$("#loader").hide();

				$(".job_details").show();
				$( ".questions_row" ).replaceWith(data);
			});				

			return false;
		});
		
		$(document).on("change", ".specific_question", function() {
			questionID = $(this).attr("ID");
			templateID = $(this).val();
			$(".edit_question_holder").hide();
			$("#loader").show();

			dataString = "jobID=" + jobID + "&questionID=" + questionID + "&question=NA&template_questionID=" + templateID;
			$.when(send_ajax(dataString, "ajax/job.ajax.php?type=update&criteria=edit_question")).done(function(data){
				$("#loader").hide();

				$(".job_details").show();
				$( ".questions_row" ).replaceWith(data);
			});				
			return false;
		});		

		$(document).on("click", ".save_question_edit", function() {
			questionID = $(this).attr("ID");
			question = $("#custom_question_"+questionID).val().trim();

			if(question.length == 0 || question == "") {
				$(".edit_question_holder").hide();
				$(".question_holder").show();				
			} else {
				dataString = "jobID=" + jobID + "&questionID=" + questionID + "&question="+question+"&template_questionID=NA";
				$.when(send_ajax(dataString, "ajax/job.ajax.php?type=update&criteria=edit_question")).done(function(data){
					$(".job_details").show();
					$( ".questions_row" ).replaceWith(data);
				});				
			}
			return false;
		});
		
		$(document).on("change", "#add_general_question", function() {
			templateID = $("#add_general_question").val();

			dataString = "jobID=" + jobID + "&questionID=" + templateID + "&question=NA&type=add";

			$.when(send_ajax(dataString, "ajax/job.ajax.php?type=update&criteria=question")).done(function(data){
				$(".job_details").show();
				$( ".questions_row" ).replaceWith(data);
			});				

			return false;
		});
		
		$(document).on("change", "#add_specific_question", function() {
			templateID = $("#add_specific_question").val();

			dataString = "jobID=" + jobID + "&questionID=" + templateID + "&question=NA&type=add";

			$.when(send_ajax(dataString, "ajax/job.ajax.php?type=update&criteria=question")).done(function(data){
				$(".job_details").show();
				$( ".questions_row" ).replaceWith(data);
			});				

			return false;
		});
		
		$(document).on("click", ".save_question_add", function() {
			question = $("#add_custom_question").val().trim();

			if(question.length == 0 || question == "") {
				$(".add_question_row").hide();
				$(".question_holder").show();
			} else {
				dataString = "jobID=" + jobID + "&template_questionID=NA&questionID=NA&question="+encodeURIComponent(question)+"&type=add";

				$.when(send_ajax(dataString, "ajax/job.ajax.php?type=update&criteria=edit_question")).done(function(data){
					$(".job_details").show();
					$( ".questions_row" ).replaceWith(data);
				});				
			}
			return false;
		});
		
		
		$(document).on("keyup", ".add_question_box", function() {		
			var max = 250;
			var len = $(this).val().length;
			if (len >= max) {
		    	$('#charNum_add_question').text(' you have reached the limit');
			} else {
		    	var char = max - len;
				$('#charNum_add_question').text(char + ' characters left');
			}
		});	

		$(document).on("keyup", ".edit_question_box", function() {		
			var max = 250;
			var len = $(this).val().length;
			if (len >= max) {
		    	$('#charNum_edit_question').text(' you have reached the limit');
			} else {
		    	var char = max - len;
				$('#charNum_edit_question').text(char + ' characters left');
			}
		});	
		
		$(document).on("keyup", "#benefits_description", function() {		
			var max = 250;
			var len = $(this).val().length;
			if (len >= max) {
		    	$('#charNum_benefits').text(' you have reached the limit');
			} else {
		    	var char = max - len;
				$('#charNum_benefits').text(char + ' characters left');
			}
		});	

		$(document).on("keyup", "#walkin_description", function() {		
			var max = 250;
			var len = $(this).val().length;
			if (len >= max) {
		    	$('#charNum_walkin').text(' you have reached the limit');
			} else {
		    	var char = max - len;
				$('#charNum_walkin').text(char + ' characters left');
			}
		});	
		
		
		$(document).on("keyup", "#description", function() {		
			var max = 750;
			var len = $(this).val().length;
			if (len >= max) {
		    	$('#charNum_description').text(' you have reached the limit');
			} else {
		    	var char = max - len;
				$('#charNum_description').text(char + ' characters left');
			}
		});	
		
		
		$(document).on("click", ".continue", function() {
			//check wage
			//check job title
			//arrange wage
			$(".error").hide();
			$('#wage_form').removeClass('has-error');					
			$('#edit_job_title').removeClass('has-error');					

			var error = false;	
			main_skill = $("#main_skill_hidden").val().trim();	
			specialtyID = $("#specialtyID_hidden").val().trim();	
							
			title = $("#job_title").val().trim();	
				//storeID = $("#store_input").val();	
			schedule = $("#schedule").val();	
			comp_type = $("#compensation_type").val();	
			description = $("#description").val();	
			
			if (comp_type == "Hourly" || comp_type == "Salary") {
				comp_value_raw_high = $("#wage_amount_high").val().trim();	
				comp_value_raw_low = $("#wage_amount_low").val().trim();	
			} else {
				comp_value_raw_high = comp_value_raw_low = "0";
			}
			
			benefits = $("#benefits").val();	
			if (benefits == 'Y') {
				benefits_desc = $("#benefits_description").val().trim();	
			} else {
				benefits_desc = "";				
			}	
				
			walkin = $("#walkin").val();	
			if (walkin == 'Y') {
				walkin_desc = $("#walkin_description").val().trim();	
			} else {
				walkin_desc = "";				
			}	
	
			//errors
			if (title == "") {
				$('#title_error').show();
				$('#edit_job_title').addClass('has-error');					
				error = true;
			}

			if (isNaN(comp_value_raw_high) || comp_value_raw_high == "" || isNaN(comp_value_raw_low) || comp_value_raw_low == "") {
				$('#compensation_error').show();		
				$('#wage_form').addClass('has-error');					
				error = true;					
			} else {
				//check high vs low
				if (Number(comp_value_raw_high) > Number(comp_value_raw_low)) {
					comp_value_high = comp_value_raw_high;
					comp_value_low = comp_value_raw_low;
				} else {
					comp_value_high = comp_value_raw_low;
					comp_value_low = comp_value_raw_high;					
				}
			}				
	
			var allSkills = [];			
		    $('.sub_skill_button').each(function () {
	     		if ($(this).hasClass('active')) {
		     		checked_skill = $(this).attr('id');
			 		checked_skill = encodeURIComponent(checked_skill);
		 			allSkills.push(checked_skill);
		 		}
		    });	
	
			var allReq = [];
		    $('.requirement').each(function () {
		 		if ($(this).hasClass('active')) {
		     		checked_req = $(this).attr('id');
			 		checked_req = encodeURIComponent(checked_req);
		 			allReq.push(checked_req);
		 		}
		    });	

			notes = $('#notes_input').val();

			if (error == false) {
				dataString =	"jobID=" + jobID +
									"&title=" + encodeURIComponent(title) +	
									"&main_skill=" + main_skill +		
									"&specialtyID=" + specialtyID +	
									"&schedule=" + schedule +				
									"&comp_type=" + comp_type +				
									"&comp_value_high=" + comp_value_high +				
									"&comp_value_low=" + comp_value_low +				
									"&benefits=" + benefits +				
									"&benefits_desc=" + encodeURIComponent(benefits_desc) +				
									"&walkin=" + walkin +				
									"&walkin_desc=" + encodeURIComponent(walkin_desc) +				
									"&skills=" + allSkills +				
									"&requirements=" + allReq +				
									"&notes=" + encodeURIComponent(description);		
					$('.container').hide();			
					$('#loader').show();			

					$.when(send_ajax(dataString, "ajax/job.ajax.php?type=edit_all_details", "full")).done(function(data){
						window.location = "job.php?ID=new_job&page=templates&groupID=" + groupID					
					});	
			} else {
				window.scrollTo(0, 0);
			}	

			return false;		
		});	
}


function choose_type(jobID) {

	$(document).on("click", ".choice", function() {
		var post_choice = $(this).attr('ID');
		
		dataString = "jobID=" + jobID + "&status=" + post_choice;
		//alert(dataString);
		$(".main_box").hide();
		$(".loader_box").show();
		
		$.when(send_ajax(dataString, "ajax/job.ajax.php?type=update_status", "none")).done(function(data){
			//alert(data);
			window.location.reload();
		});																											
											
		return false;
	});
	
	$(document).on("click", "#edit", function() {
		dataString = "jobID=" + jobID + "&status=template_edit";
		$.when(send_ajax(dataString, "ajax/job.ajax.php?type=update_status", "none")).done(function(data){
			//alert(data);
			window.location.reload();
		});																											
											
		return false;
	});			
	
	$(document).on("click", "#lite_warning", function() {
		$('#lite_warning_holder').show();
		return false;
	});		
}


function free_post(groupID, email_verification) {
	$(document).on("click", "#free_post", function() {
      	$('.job_post_holder').hide();
		$('#loader').show();

		dataString = "jobID=NA&groupID=" + groupID;

		//alert(dataString);

		$.when(send_ajax(dataString, "ajax/job.ajax.php?type=free_group_post", "NA")).done(function(result){
			//alert(result);
			window.location = "job.php?ID=new_job&groupID=" + groupID + "&page=group_receipt&receiptID=" + result;

	      	$('#free_loader').hide();
			$('#successful_post').show();			
		});																											

	});
	
}

function update_post(groupID, email_verification) {
	$(document).on("click", "#update_post", function() {
      	$('.job_post_holder').hide();
		$('#loader').show();

		dataString = "jobID=NA&groupID=" + groupID;

		//alert(dataString);

		$.when(send_ajax(dataString, "ajax/job.ajax.php?type=update_group_post", "NA")).done(function(result){
			//alert(result);
			window.location = "main.php";

	      	$('#free_loader').hide();
			$('#successful_update').show();			
		});																											

	});
	
}

function new_checkout(groupID, checkout_amount, email_verification) {
		
	var handler = StripeCheckout.configure({
//    key: 'pk_test_hlMmZ8ZYtBTp8nP1B6D5decQ',
    key: 'pk_live_AgWSTdNBK30Ccwe8VOxGdBs7',
    image: 'new_square_logo.png',
    locale: 'auto',
    color: 'black',
    token: function(token, args) {
      // You can access the token ID with `token.id`.
      // Get the token ID to your server-side code for use.
      		$('.job_post_holder').hide();
			$('#payment_loader').show();

			$.ajax({
				type: "POST",
				url: "ajax/checkout.ajax.php?key=F23dfhjed",
				data: {tokenid: token.id, email: token.email, checkout_amount: checkout_amount, groupID: groupID},
				success: function(data) {
					//if successful show success page
					//alert(data);
					if (data != "fail") {
						var employer_phone = "NA";
						
						dataString = "jobID=NA&groupID=" + groupID + "&checkout_amount=" + checkout_amount + "&employer_phone=" + employer_phone + "&transactionID=" + data;

						//alert(dataString);
				
						$.when(send_ajax(dataString, "ajax/job.ajax.php?type=post_paid", "NA")).done(function(result){
							//alert(result);
							window.location = "job.php?ID=new_job&groupID=" + groupID + "&page=group_receipt&receiptID=" + result;
						});																											
						
					} else {
						$('.container').show();			
					
						$("#payment_loader").hide();
						$("#payment_error").show();
					}
				}
			});
      
    }
  });

  $('#customButton').on('click', function(e) {
	  //first check to make sure there is a phone number included
	  $('.warning').hide();

		    // Open Checkout with further options:

		    handler.open({
		      name: 'ServeBartendCook.com',
		      description: 'Job Post Checkout',
		      zipCode: true,
		      amount: checkout_amount,
		      allowRememberMe: false,
		    });
		    e.preventDefault();
	    return false; 
	});
	
	  // Close Checkout on page navigation:
	  $(window).on('popstate', function() {
	    handler.close();
	  });	
	  
 	$(document).on("click", "#verify_email_warning", function() {
 		//show email warning and re-send verification
 		$('.job_post_holder').hide();
 		$('#verification_warning').show();
  		return false;		
 	});
 	
 	$(document).on("click", ".verify_email_warning_back", function() {
 		$('#verification_warning').hide();
 		$('.job_post_holder').show();
 		return false;
 	}); 	
}

function checkout(jobID, checkout_amount, cl_group, social, email) {
	alert("OLD CHECKOUT");
	
	var handler = StripeCheckout.configure({
    key: 'pk_test_hlMmZ8ZYtBTp8nP1B6D5decQ',
//    key: 'pk_live_AgWSTdNBK30Ccwe8VOxGdBs7',
    image: 'new_square_logo.png',
    locale: 'auto',
    color: 'black',
    token: function(token, args) {
      // You can access the token ID with `token.id`.
      // Get the token ID to your server-side code for use.
      		$('#payment_info').hide();
			$('#payment_loader').show();

			$.ajax({
				type: "POST",
				url: "ajax/checkout.ajax.php?key=F23dfhjed",
				data: {tokenid: token.id, email: token.email, checkout_amount: checkout_amount, jobID: jobID},
				success: function(data) {
					//if successful show success page
					//alert(data);
					if (data != "fail") {
						var employer_phone = "NA";
						
						dataString = "jobID=" + jobID + "&cl_group=" + cl_group + "&social=" + social + "&email=" + email + "&checkout_amount=" + checkout_amount + "&employer_phone=" + employer_phone + "&transactionID=" + data;

						//alert(dataString);
				
						$.when(send_ajax(dataString, "ajax/job.ajax.php?type=boost_paid", "NA")).done(function(result){
							//alert(result);
							window.location = "job.php?ID=" + jobID + "&page=boost_receipt&receiptID=" + result;
						});																											
						
					} else {
						$("#payment_loader").hide();
						$("#payment_error").show();
					}
				}
			});
      
    }
  });

  $('#customButton').on('click', function(e) {
	  //first check to make sure there is a phone number included
	  $('.warning').hide();

		    // Open Checkout with further options:

		    handler.open({
		      name: 'ServeBartendCook.com',
		      description: 'Job Post Checkout',
		      zipCode: true,
		      amount: checkout_amount,
		      allowRememberMe: false,
		    });
		    e.preventDefault();
	    return false; 
	});
	
	  // Close Checkout on page navigation:
	  $(window).on('popstate', function() {
	    handler.close();
	  });	
}

function checkout_old(jobID, checkout_amount) {
//alert(checkout_amount);

	$(document).on("click", ".back", function() {
		var status = $(this).attr('ID');
		dataString = "jobID=" + jobID + "&status=" + status;
		//alert(dataString);
		$(".main_box").hide();
		$(".loader_box").show();

		$.when(send_ajax(dataString, "ajax/job.ajax.php?type=update_status", "none")).done(function(data){
			//alert(data);
			window.location.reload();
		});																											
	});
	
	var handler = StripeCheckout.configure({
//    key: 'pk_test_hlMmZ8ZYtBTp8nP1B6D5decQ',
    key: 'pk_live_AgWSTdNBK30Ccwe8VOxGdBs7',
    image: 'new_square_logo.png',
    locale: 'auto',
    color: 'black',
    token: function(token, args) {
      // You can access the token ID with `token.id`.
      // Get the token ID to your server-side code for use.
      		$('#payment_info').hide();
			$('#payment_loader').show();

			$.ajax({
				type: "POST",
				url: "ajax/checkout.ajax.php?key=F23dfhjed",
				data: {tokenid: token.id, email: token.email, checkout_amount: checkout_amount, jobID: jobID},
				success: function(data) {
					//if successful show success page
					//alert(data);
					if (data == "success") {
						var employer_phone = "NA";

						var dataString = "jobID=" + jobID + "&employer_phone=" + employer_phone;
						//alert(dataString);
						$.when(send_ajax(dataString, "ajax/match.ajax.php?type=match_bounty", "NA")).done(function(result){
							//alert(result);
							window.location = "job.php?ID=" + jobID + "&page=bounty_receipt";
						});																											
						
					} else {
						$("#payment_loader").hide();
						$("#payment_error").show();
					}
				}
			});
      
    }
  });

  $('#customButton').on('click', function(e) {
	  //first check to make sure there is a phone number included
	  $('.warning').hide();

		    // Open Checkout with further options:

		    handler.open({
		      name: 'ServeBartendCook.com',
		      description: 'Job Post Checkout',
		      zipCode: true,
		      amount: checkout_amount,
		      allowRememberMe: false,
/*
		      opened: function() {
			  	$('#payment_info').hide();
			  	$('#payment_loader').show();
		      },
		      
		      closed: function() {
			  	$('#payment_loader').hide();
			  	$('#payment_info').show();
		      }
*/
		    });
		    e.preventDefault();
	    return false; 
	});
	
	  // Close Checkout on page navigation:
	  $(window).on('popstate', function() {
	    handler.close();
	  });
	
}

function checkout_mobile(jobID, checkout_amount) {
//alert(checkout_amount);

	$(document).on("click", ".back", function() {
		var status = $(this).attr('ID');
		dataString = "jobID=" + jobID + "&status=" + status;
		$('#payment_info').hide();
		$('.loader_box').show();
		$.when(send_ajax(dataString, "ajax/job.ajax.php?type=update_status", "none")).done(function(data){
			//alert(data);
			window.location.reload();
		});	
		return false;																									
	});
	
	var handler = StripeCheckout.configure({
    key: 'pk_test_hlMmZ8ZYtBTp8nP1B6D5decQ',
//    key: 'pk_live_AgWSTdNBK30Ccwe8VOxGdBs7',
    image: 'new_square_logo.png',
    locale: 'auto',
    color: '#760006',
    token: function(token, args) {
      // You can access the token ID with `token.id`.
      // Get the token ID to your server-side code for use.
      		$('#payment_info').hide();
			$('#payment_loader').show();

			$.ajax({
				type: "POST",
				url: "ajax/checkout.ajax.php?key=F23dfhjed",
				data: {tokenid: token.id, email: token.email, checkout_amount: checkout_amount, jobID: jobID},
				success: function(data) {
					//if successful show success page
					//alert(data);
					if (data == "success") {
						var employer_phone = $('#employer_phone').val().trim();

						var dataString = "jobID=" + jobID + "&employer_phone=" + employer_phone;
						//alert(dataString);
						$.when(send_ajax(dataString, "ajax/match.ajax.php?type=match_bounty", "NA")).done(function(result){
							//alert(result);
							window.location = "job.php?ID=" + jobID + "&page=bounty_receipt";
						});																											
						
					} else {
						$("#payment_loader").hide();
						$("#payment_error").show();
					}
				}
			});
      
    }
  });

  $('#customButton').on('click', function(e) {
	  //first check to make sure there is a phone number included
	  $('.warning').hide();
		    // Open Checkout with further options:

		    handler.open({
		      name: 'ServeBartendCook.com',
		      description: 'Job Post Checkout',
		      zipCode: true,
		      amount: checkout_amount,
		      allowRememberMe: false,
/*
		      opened: function() {
			  	$('#payment_info').hide();
			  	$('#payment_loader').show();
		      },
		      
		      closed: function() {
			  	$('#payment_loader').hide();
			  	$('#payment_info').show();
		      }
*/
		    });
		    e.preventDefault();
	    return false; 
	});
	
	  // Close Checkout on page navigation:
	  $(window).on('popstate', function() {
	    handler.close();
	  });
	
}

function final_step(jobID) {

	$(document).on("click", "#match", function() {
		$("#match_form").dialog("open");
		return false;
	});	
	
	$(function() {
		$("#match_form").dialog({
			autoOpen: false,
			modal: true,
			height: 300,
			width: 450,
			buttons: {
				"Match": function() {	
					dataString = "jobID=" + jobID;
					//alert(dataString);
					$('.main_box').hide();	
					$("#match_form").dialog("close");					
					$.when(send_ajax(dataString, "ajax/match.ajax.php?type=match", "full")).done(function(data){
						//alert(data);
						$("#loader_box").dialog("close");					
						//window.location = "job.php?ID=" + jobID + "&page=sent";
						window.location = "job.php?ID=" + jobID + "&page=boost&note=new";
					});																											
				}
			}
		});
	});
	
	$(document).on("click", "#edit", function() {
		dataString = "jobID=" + jobID + "&status=template_edit";
		$.when(send_ajax(dataString, "ajax/job.ajax.php?type=update_status", "full")).done(function(data){
			//alert(data);
			window.location.reload();
		});																											
											
		return false;
	});	
			
}


function remove_job(jobID) {
		
		$(document).on("click", ".remove_job", function() {	
			$('.container').hide();			
			$('#loader').show();			
			dataString = "jobID=" + jobID;
			$.when(send_ajax(dataString, "ajax/job.ajax.php?type=remove_job", "mobile")).done(function(data){
				//alert(data);
				if (data > 0) {
					window.location = "job.php?ID=new_job&page=templates&groupID=" + data;														
				} else {
					window.location = "main.php";						
				}				
			})
			return false;
		});					
}

function confirm_hire(jobID) {

	$(document).on("click", '.hire_span', function(evt) {
		evt.stopImmediatePropagation(); 		//prevents double firing of event
		//alert("HERE");
		
		//first toggle the filter flag on the selected skill
		if ($(this).data('hire') == "selected") {
			$(this).data('hire', 'unselected');
			$(this).removeClass('selected_button');
			$(this).addClass('unselected_button');		
		} else {
			$(this).data('hire', 'selected');
			$(this).removeClass('unselected_button');
			$(this).addClass('selected_button');			
		}		
	});		

	$(function() {
		var allVals;
		
		$(document).on("click", "#show_confirm", function() {
			//alert("HERE");
			$('#none_selection').hide();			    
			$('#candidate_holder').hide();
			$("#confirmation_holder").show();
			
			allVals = [];	
			var count = 0;		
		    $('.hire_span').each(function () {
	     		if ($(this).data('hire') == "selected") {
		     		checkedID = $(this).data('hire_value');
		 			allVals.push(checkedID);	 			
		 			$('#' + checkedID).show();
		 			count++;
		 		}
		    });	
		    
		    if (count == 0) {
				$("#confirmation_holder").hide();
				$('#candidate_holder').show();
				$('#none_selection').show();			    
		    }		
			return false;				
		});
			
		$(document).on("click", "#cancel_confirm", function() {
			$(".confirm_user_holder").hide();
			$("#confirmation_holder").hide();
			$('#candidate_holder').show();
			return false;				
		})
			
		
			$(document).on("click", "#confirm_hire", function() {
	
					//var hire_status = $(this).attr('ID');
		
	/*
					var allVals = [];			
				    $('.hire_span').each(function () {
			     		if ($(this).data('hire') == "selected") {
				     		checkedID = $(this).data('hire_value');
				 			allVals.push(checkedID);
				 		}
				    });	
	*/
	//	alert(allVals);		    
					dataString = "jobID=" + jobID + "&status=complete&candidate_list="+ allVals;
					//alert(dataString);
					
					$.when(send_ajax(dataString, "ajax/job.ajax.php?type=confirm_hire", "full")).done(function(data){
						//alert(data);
						window.location.reload();
					});							
	
				return false;	
			});
	});
	
	$(document).on("click", "#show_confirm_none", function() {
		$('#candidate_holder').hide();
		$("#confirmation_none_holder").show();
		return false;				
	});
	
	$(document).on("click", "#cancel_none", function() {
		$("#confirmation_none_holder").hide();
		$('#candidate_holder').show();
		return false;				
	})
	
	$(document).on("click", "#confirm_none", function() {
		dataString = "jobID=" + jobID + "&status=complete&candidate_list=";
		//alert(dataString);
		
		$.when(send_ajax(dataString, "ajax/job.ajax.php?type=confirm_hire", "full")).done(function(data){
			//alert(data);
			window.location.reload();
		});							

		return false;	
	})	

}



	function initialize() {

  // Create the search box and link it to the UI element.
  var input = /** @type {HTMLInputElement} */(
      document.getElementById('pac-input'));

  var autocomplete = new google.maps.places.Autocomplete(
    /** @type {HTMLInputElement} */(input));

  // [START region_getplaces]
  // Listen for the event fired when the user selects an item from the
  // pick list. Retrieve the matching places for that item.
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    var place = autocomplete.getPlace();
    
    var street_number = '';
    var street_name = '';
    var city = '';
    var state = '';
    var zip = '';
    
	var length = place.address_components.length;   
	
	for (var i = 0; i < length; i++) {
		 switch(place.address_components[i]['types'][0]) {
		 	case 'street_number':
		 		street_number = place.address_components[i]['long_name'];
		 	break;
		 	
		 	case 'route':
		 		street_name = place.address_components[i]['long_name'];
		 	break;

		 	case 'locality':
		 		city = place.address_components[i]['long_name'];
		 	break;

		 	case 'administrative_area_level_1':
		 		state = place.address_components[i]['long_name'];
		 	break;

		 	case 'postal_code':
		 		zip = place.address_components[i]['long_name'];
		 	break;		 	
		 }
	}    
    
    address = street_number + ' ' + street_name;
//	alert(JSON.stringify(place.address_components, null, 4));

/*
	var div = document.getElementById('business');
	div.innerHTML = div.innerHTML + "<h4 style='text-align:center'>" + place.name + '</h4>';
*/
	document.getElementById('name').value = place.name;
	document.getElementById('address').value = address;
//	document.getElementById('city').value = city;		
//	document.getElementById('state').value = state;
	document.getElementById('zip').value = zip;
//alert(address);
		
  });
}


function HtmlDecode(html) {
	if (html != "") {
	    var div = document.createElement("div");
	    div.innerHTML = html;
	    return div.childNodes[0].nodeValue;
    } else {
	    return html;
    }
}

function copy_clip() {
	new ClipboardJS('.btn');
	$(document).on("click", "#copy_btn", function() {
		$('#copy_notice').show();
		return false;				
	})
}