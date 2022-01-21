function opportunity_list_viewed() {
//as the document loads, write views to database
		$(function(){ 	
				dataString = "none";
				//alert(dataString);
				$.when(send_ajax(dataString, "ajax/opportunity_list.ajax.php?type=list_viewed", "none")).done(function(data){
					//alert(data);
				})
		})
}


function qualified_job_list(profile_status) {
	//as the document loads, load job summary separately
		$(function(){ 	
				dataString = "none";
				//alert(type);
					$.when(send_ajax(dataString, "ajax/opportunity_list.ajax.php?type=load_qualified_list&device=full", "none")).done(function(data){
						$("#qualified_opportunity_holder").replaceWith(data);
						if (profile_status != "complete") {
							$('#filter').hide('fast');
					
							$('[data-match="Y"]').show();
							$('[data-match="N"]').show();
					
							$('#show_all').addClass('active');				
							$('#show_matches').removeClass('active');
							$('#show_filter').removeClass('active');
					
							$('#match_header').hide();
							$('#all_header').show();		
						}	

						//add clear fix divs for spacing
						var clear_count = 1
					    $('.clearfix').each(function () {
						     	var clearID = $(this).data('job') 
					     		if ($(this).data('visible') == "Y") {
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
						 			
						 		} else {
								 	$('#clear_'+clearID).hide();	
							 		$(this).removeClass("visible-xs");						     																 						 		
							 		$(this).removeClass("visible-md");						     																 						 		
							 		$(this).removeClass("visible-lg");						     																 						 		
						 		}
					     });	
					});
		})
		
}

function unqualified_job_list(type) {
	//as the document loads, load job summary separately
		$(function(){ 	
				dataString = "none";
				//alert(dataString);
				if (type == 'full') {
					$.when(send_ajax(dataString, "ajax/opportunity_list.ajax.php?type=load_unqualified_list&device=full", "none")).done(function(data){
						//alert("here");
						$("#unqualified_opportunity_holder").replaceWith(data);
					});
				} else if (type == 'mobile') {
					$.when(send_ajax(dataString, "ajax/opportunity_list.ajax.php?type=load_unqualified_list&device=mobile", "none")).done(function(data){
						//alert("here");
						$("#unqualified_opportunity_holder").replaceWith(data);
					});					
				}
		})
}

function opportunity_list() {
	
		$(".not_interested").click(function() {
			jobID = $(this).attr('ID');		
			//alert(jobID);			
			$("#not_interested_form").dialog("open");
			return false;
		});		
		
		$(".match").click(function() {
			current_class = $('#match_tab').attr('class');
				//alert(current_class);	
		
			if (current_class == "unselected_tab") {
				$('#match_tab').removeClass('unselected_tab');
				$('#match_tab').addClass('selected_tab');
				$('#other_tab').removeClass('selected_tab');
				$('#other_tab').addClass('unselected_tab');							
			}
			
			$("#match").show();
			$("#match_header").show();						
			$("#other").hide();
			$("#other_header").hide();	
			
			return false;
		});	
		
		$(".other").click(function() {					
			current_class = $('#other_tab').attr('class');
			//alert(current_class);	
			if (current_class == "unselected_tab") {
				$('#match_tab').addClass('unselected_tab');
				$('#match_tab').removeClass('selected_tab');
				$('#other_tab').addClass('selected_tab');
				$('#other_tab').removeClass('unselected_tab');							
			}
			
			$("#other").show();
			$("#other_header").show();												
			$("#match").hide();
			$("#match_header").hide();												
			return false;
		});																																																																		
																											
		$(function() {
			$("#not_interested_form").dialog({
				autoOpen: false,
				modal: true,
				height: 250,
				width: 450,
				buttons: {
					"Not Interested": function() {	
						dataString = "jobID=" + jobID + "&interest=N";
						$("#not_interested_form").dialog("close");																											
						$.when(send_ajax(dataString, "update_job.php?type=employee_interest", "full")).done(function(data){
							//alert(data);
							window.location.reload();
						})
					}
				}
			});
		});	
}


function filter_opportunties(device, profile_status) {
	var view_status = 'match';
	if (profile_status != "complete") {
		view_status = 'all';
	}	
	
	$(document).on("click", '#show_matches', function() {					
		$('#filter').hide('fast');

		$('[data-match="N"]').hide();
		$('[data-match="Y"]').show();
		
		$(this).addClass('active');
			
		$('#show_all').removeClass('active');
		$('#show_filter').removeClass('active');

		$('#all_header').hide();		
		$('#match_header').show();
		
			var clear_count = 1
			$('.clearfix').show();
		    $('.clearfix').each(function () {
			     	var clearID = $(this).data('job') 
		     		if ($(this).data('visible') == "Y") {
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
			 			
			 		} else {
					 	$('#clear_'+clearID).hide();	
				 		$(this).removeClass("visible-xs");						     																 						 		
				 		$(this).removeClass("visible-md");						     																 						 		
				 		$(this).removeClass("visible-lg");						     																 						 		
			 		}
		     });	
		
		view_status = 'match';

		return false;
	});	
	
	$(document).on("click", '#show_all', function() {					
		$('#filter').hide('fast');

		$('[data-match="Y"]').show();
		$('[data-match="N"]').show();

		$(this).addClass('active');
		
		$('#show_matches').removeClass('active');
		$('#show_filter').removeClass('active');

		$('#match_header').hide();
		$('#all_header').show();	
		
		view_status = 'all';
		
			//add clear fix divs for spacing
			var clear_count = 1
			$('clearfix').show();
		    $('.clearfix').each(function () {
			 	if (clear_count % 2 == 0) {
					if (!$(this).hasClass("visible-xs")) {
				 		$(this).addClass("visible-xs");						     								
					}
				} else {
				 	$(this).removeClass("visible-xs");
				 	$(this).hide();						     													
				}			
				
			 	if (clear_count % 4 == 0) {
					if (!$(this).hasClass("visible-md")) {
				 		$(this).addClass("visible-md");						     								
					}
					
					if (!$(this).hasClass("visible-lg")) {
				 		$(this).addClass("visible-lg");						     								
					}
					
				} else {
				 	$(this).removeClass("visible-md");
				 	$(this).removeClass("visible-lg");
				 	$(this).hide();						     													
				}			
				     
			 	clear_count++;
		     });	
	
		return false;
	});	
	
	$(document).on("click", '#show_filter', function() {
		window.scrollTo(0, 0);														
		$('#filter').show('fast');

		$('[data-match="Y"]').show();
		$('[data-match="N"]').show();
		
		$(this).addClass('active');
		
		$('#show_matches').removeClass('active');
		$('#show_all').removeClass('active');

		$('#match_header').hide();
		$('#all_header').hide();	
		
		view_status == "all";		

			//add clear fix divs for spacing
			var clear_count = 1
			$('clearfix').show();
		    $('.clearfix').each(function () {
			 	if (clear_count % 2 == 0) {
					if (!$(this).hasClass("visible-xs")) {
				 		$(this).addClass("visible-xs");						     								
					}
				} else {
				 	$(this).removeClass("visible-xs");
				 	$(this).hide();						     													
				}
				
			 	if (clear_count % 4 == 0) {
					if (!$(this).hasClass("visible-md")) {
				 		$(this).addClass("visible-md");						     								
					}
					
					if (!$(this).hasClass("visible-lg")) {
				 		$(this).addClass("visible-lg");						     								
					}
					
				} else {
				 	$(this).removeClass("visible-md");
				 	$(this).removeClass("visible-lg");
				 	$(this).hide();						     													
				}			     
							     
			 	clear_count++;
		     });	
		
		return false;
	});
		
	
	$(document).on("click", '#filter_button', function() {
		$('#filter').toggle('slow');
		$('#filter_button').hide();		
		
		return false;
	});
		
	
	$(document).on("click", '.select_all', function(evt) {	
		evt.stopImmediatePropagation(); 		//prevents double firing of event		
		
		filter_type = $(this).attr('id');			
	     $("." + filter_type + "_filter_span").each(function () {
			if ($(this).data(filter_type + "_filter") == "unselected") {
				$(this).data(filter_type + "_filter", "selected");
				$(this).removeClass('unselected_button');
				$(this).addClass('selected_button');
				
				if (filter_type == "comp") {
					if ($(this).data('comp') == "Hourly" && $(this).data('comp_filter') == "selected") {
						$('#hourly_range').show();
					} else if 	($(this).data('comp') == "Hourly" && $(this).data('comp_filter') == "unselected") {
						$('#hourly_range').hide();
					}
					
					if ($(this).data('comp') == "Salary" && $(this).data('comp_filter') == "selected") {
						$('#salary_range').show();
					} else if 	($(this).data('comp') == "Salary" && $(this).data('comp_filter') == "unselected") {
						$('#salary_range').hide();
					}						
				}		
		     }
		})
		return false;
	});	

	$(document).on("click", '#save_filter', function() {	
	  // alert("HERE");
	    $('#hourly_warning').hide();
	    $('#salary_warning').hide();
	    
		var clear_array = [];


	//	$('#filter').hide();						
		//	var skill_filter_count = 0;
		//loop through all checked skills put them into an array
		skill_list = new Array;
	     $('.job_skill_filter_span').each(function () {
	     		checked_skill = $(this).data('skill');
	     		if ($(this).data('job_skill_filter') == "selected") {
		 			skill_list.push(checked_skill);
		 		}
	    });	
	    var SkillJsonString = JSON.stringify(skill_list);    
	    
	    
		schedule_list = new Array;
	     $('.schedule_filter_span').each(function () {
	     		checked_schedule = $(this).data('schedule');
	     		if ($(this).data('schedule_filter') == "selected") {
		 			schedule_list.push(checked_schedule);
		 		}
	    });		         
	    var ScheduleJsonString = JSON.stringify(schedule_list);
	    
		comp_list = new Array;
	     $('.comp_filter_span').each(function () {
	     		checked_comp = $(this).data('comp');
	     		if ($(this).data('comp_filter') == "selected") {
		 			comp_list.push(checked_comp);
		 		}
	    });		         
	    var CompJsonString = JSON.stringify(comp_list);
	    	    
	    if ($('#hourly').data('comp_filter') == "selected") {
		    var hourly_min = $('#hourly_min').val();
//		    var hourly_max = $('#hourly_max').val();
		    if (isNaN(hourly_min) || hourly_min == "")	{
			    var hourly_test = 'N';
		    } else {
			    var hourly_test = 'Y';			    
		    }	    
	    } else {
		    var hourly_min = 'NA';
//		    var hourly_max = 'NA';
			var hourly_test = 'Y';			    		    		    		    
	    }
	    
	    if ($('#salary').data('comp_filter') == "selected") {
		    var salary_min = $('#salary_min').val();
//		    var salary_max = $('#salary_max').val();
		    if (isNaN(salary_min) || hourly_min == "")	{
			    var salary_test = 'N';
			    $('#salary_warning').show();
		    } else {
			    var salary_test = 'Y';			    
		    }	    
	    } else {
		    var salary_min = 'NA';
//		    var salary_max = 'NA';
			var salary_test = 'Y';			    		    		    		    
	    }
	    
	    if (hourly_test == 'Y' && salary_test == 'Y') {	
			//determine what to hide and what to show
			//loop through all rows
		     $('.job_row').each(function () {
				$(this).hide(); 		 		

			    if (($(this).data('match') == "Y" && view_status == "match") || (view_status == "all")) {

			     	//check each filter
				 	
				 	skill_count = 0;
				 	
				 	if (skill_list.length > 0) {
				 		for(var i in skill_list) {		 		
					        if(skill_list[i] == $(this).data('skill')) {
					      		skill_count++;
					        }
					    }
				    } else {
					    //nothing selected so ignore criteria
					    skill_count = 1;
				    }
				    
			 		schedule_count = 0;
				 	if (schedule_list.length > 0) {
				 		for(var i in schedule_list) {		 		
					        if(schedule_list[i] == $(this).data('schedule')) {
					      		schedule_count++;
					        }
					    }
				    } else {
					    //nothing selected so ignore criteria
					    schedule_count = 1;
				    }
					    
			 		comp_count = 0;
				 	if (comp_list.length > 0) {
				 		for(var i in comp_list) {		 		
					        if(comp_list[i] == $(this).data('comptype')) {
						    	//check to see if hourly and/or salary is checked, if so, check value 
						    	if(comp_list[i] == "Hourly") {
							    	if (parseFloat($(this).data('compvalue')) >= hourly_min) {
										comp_count++;								    	
							    	}
						    	} else if (comp_list[i] == "Salary") {
							    	if (parseFloat($(this).data('compvalue')) >= salary_min) {
										comp_count++;								    	
							    	}							    	
						    	} else {
					      			comp_count++;							    	
						    	}	   
					        }
					    }
				    } else {
					    //nothing selected so ignore criteria
					    comp_count = 1;
				    }
			 		
			 		//if it meets all criteria, show, if not hide
			 	//	alert(skill_count + " " + schedule_count + " " + comp_count);
			 		if (skill_count > 0 && schedule_count > 0 && comp_count > 0) {
				 		$(this).show();
				 		clear_array.push($(this).data('jobid'));
			 		} else {
				 		//$(this).show(); 		 		
			 		}
			 	}
		    });		         
			//show filter warning text
			$('#clear_filter_holder').show();
		} else {
			$('#filter').show();						
			if (hourly_test == 'N') {
			    $('#hourly_warning').show();				
			}

			if (salary_test == 'N') {
			    $('#salary_warning').show();				
			}			
		}					

			var clear_count = 1
			$('.clearfix').show();
			//alert(clear_array);
		    $('.clearfix').each(function () {
			     	var clearID = $(this).data('job') ;
		     		if ($.inArray(clearID, clear_array) !== -1) {
			     		
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
			 			
			 		} else {
				 		//alert(clearID);
					 	$('#clear_'+clearID).hide();	
				 		$(this).removeClass("visible-xs");				
				 		$(this).removeClass("visible-md");			     																 						 		
				 		$(this).removeClass("visible-lg");			     																 						 		
			 		}
		     });	

		return false;
	});										
	
	$(document).on("click", '.job_skill_filter_span', function(evt) {
		evt.stopImmediatePropagation(); 		//prevents double firing of event		
		//first toggle the filter flag on the selected skill
		if ($(this).data('job_skill_filter') == "selected") {
			$(this).data('job_skill_filter', 'unselected');
/*
			$(this).removeClass('selected_button');
			$(this).addClass('unselected_button');	
*/	
			$(this).removeClass('active');	
			$(this).children('.fa-check-square-o').hide();
			$(this).children('.fa-square-o').show();

		} else {
			$(this).data('job_skill_filter', 'selected');
/*
			$(this).removeClass('unselected_button');
			$(this).addClass('selected_button');	
*/
			$(this).addClass('active');	
			$(this).children('.fa-square-o').hide();
			$(this).children('.fa-check-square-o').show();				
		}		
		return false;
	});
	
/*
	$(document).on("click", '.store_filter_span', function(evt) {
		evt.stopImmediatePropagation(); 		//prevents double firing of event		
		//first toggle the filter flag on the selected skill
		if ($(this).data('store_filter') == "selected") {
			$(this).data('store_filter', 'unselected');
			$(this).removeClass('selected_button');
			$(this).addClass('unselected_button');		
		} else {
			$(this).data('store_filter', 'selected');
			$(this).removeClass('unselected_button');
			$(this).addClass('selected_button');			
		}		
		return false;
	});
*/
	
	$(document).on("click", '.schedule_filter_span', function(evt) {
		evt.stopImmediatePropagation(); 		//prevents double firing of event		
		//first toggle the filter flag on the selected skill
		if ($(this).data('schedule_filter') == "selected") {
			$(this).data('schedule_filter', 'unselected');
/*
			$(this).removeClass('selected_button');
			$(this).addClass('unselected_button');		
*/
			$(this).removeClass('active');	
			$(this).children('.fa-check-square-o').hide();
			$(this).children('.fa-square-o').show();

		} else {
			$(this).data('schedule_filter', 'selected');
/*
			$(this).removeClass('unselected_button');
			$(this).addClass('selected_button');			
*/
			$(this).addClass('active');	
			$(this).children('.fa-square-o').hide();
			$(this).children('.fa-check-square-o').show();

		}		
		return false;
	});	
	
	$(document).on("click", '.comp_filter_span', function(evt) {
		evt.stopImmediatePropagation(); 		//prevents double firing of event		
		//first toggle the filter flag on the selected skill
		if ($(this).data('comp_filter') == "selected") {
			$(this).data('comp_filter', 'unselected');
/*
			$(this).removeClass('selected_button');
			$(this).addClass('unselected_button');		
*/
			$(this).removeClass('active');	
			$(this).children('.fa-check-square-o').hide();
			$(this).children('.fa-square-o').show();

		} else {
			$(this).data('comp_filter', 'selected');
/*
			$(this).removeClass('unselected_button');
			$(this).addClass('selected_button');			
*/
			$(this).addClass('active');	
			$(this).children('.fa-square-o').hide();
			$(this).children('.fa-check-square-o').show();

		}
		if ($(this).data('comp') == "Hourly" && $(this).data('comp_filter') == "selected") {
			$('#hourly_range').show();
		} else if 	($(this).data('comp') == "Hourly" && $(this).data('comp_filter') == "unselected") {
			$('#hourly_range').hide();
		}
		
		if ($(this).data('comp') == "Salary" && $(this).data('comp_filter') == "selected") {
			$('#salary_range').show();
		} else if 	($(this).data('comp') == "Salary" && $(this).data('comp_filter') == "unselected") {
			$('#salary_range').hide();
		}						
		return false;
	});		
}

function opportunity_response_list() {

	$("#current_responses").click(function() {						
		$("#current_response_holder").show();
		$("#current_header").show();												
		$("#archive_response_holder").hide();
		$("#archive_header").hide();												
		return false;
	});	
	
	$("#archive_responses").click(function() {						
		$("#current_response_holder").hide();
		$("#current_header").hide();												
		$("#archive_response_holder").show();
		$("#archive_header").show();												
		return false;
	});																																																																																																																																				
	
}