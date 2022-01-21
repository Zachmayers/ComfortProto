function photo() {
		$("#profile_pic_choose").change(function(){
		    input = this;
			if (input.files && input.files[0]) {
				if (input.files[0].size > 4000000) {
					$('#file_size_warning').show();
					//alert("Please choose a file less than 2 MB");
				} else if (input.files[0].type == "image/png" || input.files[0].type == "image/jpg" || input.files[0].type == "image/jpeg") {
						//if (window.confirm("Upload image: " + input.files[0].name + "?")) {
							$("#loader_box").dialog("open");																			
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
						url: "update_profile.php?type=remove_photo",
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
			window.location.reload();	
		} else {
			$("#loader_box").dialog("close");		
			status.html(xhr.responseText);
		}
	}
});										
					
			$("#delete_photo").click(function() {
				dataString = "type=profile";
				$("#loader_box").dialog("open");															
				$.ajax({
					type: "POST",
					url: "update_profile.php?type=remove_photo",
					data: dataString,
					success: function(data) {
						//alert(data);
						window.location.reload();
					}
				});					
				return false;
			});																	
}

function profile(userID) {
  
		$("#profile_pic_choose").change(function(){
		    input = this;
			if (input.files && input.files[0]) {
				if (input.files[0].size > 4000000) {
					$('#file_size_warning').show();
					//alert("Please choose a file less than 2 MB");
				} else if (input.files[0].type == "image/png" || input.files[0].type == "image/jpg" || input.files[0].type == "image/jpeg") {
						//if (window.confirm("Upload image: " + input.files[0].name + "?")) {
							$("#loader_box").dialog("open");																			
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
						url: "update_profile.php?type=remove_photo",
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
			window.location.reload();	
		} else {
			$("#loader_box").dialog("close");		
			status.html(xhr.responseText);
		}
	}
});										
					
			$("#delete_photo").click(function() {
				dataString = "type=profile";
				$("#loader_box").dialog("open");															
				$.ajax({
					type: "POST",
					url: "update_profile.php?type=remove_photo",
					data: dataString,
					success: function(data) {
						//alert(data);
						window.location.reload();
					}
				});					
				return false;
			});																

			$(".decline").click(function() {
				//alert(userID);
				jobID = $(this).attr('ID');		
				$("#decline_form").dialog("open");								
				return false;
			});						

					$(function() {
						$("#decline_form").dialog({
							autoOpen: false,
							modal: true,
							height: 200,
							width: 450,
							buttons: {
								"Decline": function() {	
									dataString = "candidateID=" + userID + "&jobID=" + jobID;
									//alert(dataString);
									$("#loader_box").dialog("open");									
									$("#decline_form").dialog("close");																		
									$.ajax({
										type: "POST",
										url: "update_job.php?type=decline",
										data: dataString,
										success: function(data) {
											//alert(data);
											window.location = "job_list.php";
										}
									});					
								}
							}
						});
					});														
			
			$(function() {
				$("#loader_box").dialog({
					autoOpen: false,
					modal: true,
					height: 200,
					width: 450
				});
			});	
			
}

function video_player(video_url) {
 	$.embedly.defaults.key = 'f5b7ea57c3b84df88d4e8d9c6c9acb05'; 
	$.embedly.defaults.query = { autoplay:true}; 
//	$('#video_player a').embedly({key: 'f5b7ea57c3b84df88d4e8d9c6c9acb05'});


			$("#watch_video").click(function() {	
				var height= 200;		
				$("#video_box").dialog("open");
				 $("#video-loader").show();
				//url = 'http://www.youtube.com/watch?v=vsmUpYIA99o'
				 $.embedly.oembed(video_url).progress(function(data){
				 	$("#video-loader").hide();
				      $('#video-holder .video-header h4').html(data.title);
				      $('#video-holder .video-body').html(data.html);
				    });				
				return false;
			});
			
			$(".sample_video").click(function() {	
				var height= 200;
				video_type = $(this).attr('ID');
				if (video_type = 'bartender') {
					sample_url = 'http://www.youtube.com/watch?v=JXvEDTSYiNI'			
				}		
				$("#video_box").dialog("open");
				 $("#video-loader").show();
				 $.embedly.oembed(sample_url).progress(function(data){
				 	$("#video-loader").hide();
				      $('#video-holder .video-header h4').html(data.title);
				      $('#video-holder .video-body').html(data.html);
				    });				
				return false;
			});
			
			$(".play_sample_video").click(function() {	
				var height= 200;
				video_type = $(this).attr('ID');
				switch(video_type) {
					case "bartender":
						sample_url = 'http://www.youtube.com/watch?v=ZHS23AmZGz4';
					break;
					
					case "cook":
						sample_url = 'http://www.youtube.com/watch?v=u2ZDGyb1loM';
					break;

					case "server":
						sample_url = 'http://www.youtube.com/watch?v=cylNA1aA5IE';
					break;													
				}		
				$("#video_box").dialog("open");
				 $("#video-loader").show();
				 $.embedly.oembed(sample_url).progress(function(data){
				 	$("#video-loader").hide();
				      $('#video-holder .video-header h4').html(data.title);
				      $('#video-holder .video-body').html(data.html);
				    });				
				return false;
			});
			
			
			
			$(function() {
				$("#video_box").dialog({
					autoOpen: false,
					modal: true,
					minHeight: 200,
					minWidth: 500,										
					height: "auto",
					width: "auto",
					close: function() {
						$('#video-holder .video-body').html('');
					}
				});
			});				
}

function profile_employer(userID) {

	$('#personal_details').click(function() {
		$('#employer_profile').hide();
		$('#employer_profile_edit').show('fast');	
		return false;	
	});
	
	$('#cancel_employer_edit').click(function() {
		$('#employer_profile_edit').hide();
		$('#employer_profile').show('fast');	
		return false;	
	});	

	$('#add_store').click(function() {
		$('#store_required_warning').hide();
		$('#store_zip_warning').hide();	
				
		store_name = encodeURIComponent($('#store_name').val().trim());
		store_website = $('#store_website').val().trim();
		store_address = encodeURIComponent($('#address').val().trim());
		store_zip = $('#zip').val().trim();
		business_type = $('#description').val();
		
		if (store_name.length == 0 || store_address.length == 0 || store_zip.length == 0) {
			//alert("here");
			$('#store_required_warning').show();
		} else {
			$("#loader_box").dialog("open");																		
			dataString = "store_name=" + store_name + "&store_website=" + store_website + "&store_address=" + store_address + "&store_zip=" + store_zip + "&type=" + business_type;
			$.ajax({
				type: "POST",
				url: "update_profile.php?type=add_store",
				data: dataString,
				success: function(data) {
					//alert(data);
					if (data == "zip_error") {
						$('#store_zip_warning').show();
						$("#loader_box").dialog("close");																								
					} else {
						window.location = "store.php?ID="+ data;
					}
				}
			});					
		}	
		return false;	
	});
	
	$('#save_changes').click(function() {
		$('#required_fields_warning').hide();
				
		first_name = encodeURIComponent($('#first_name').val().trim());
		last_name = encodeURIComponent($('#last_name').val().trim());
		company = encodeURIComponent($('#company').val().trim());
		position = encodeURIComponent($('#position').val().trim());
		website = $('#website').val().trim();
		photo_setting = $('#photo_setting').val();		
		
		if (first_name.length == 0 || last_name.length == 0 || company.length == 0 || position.length == 0) {
			$('#required_fields_warning').show();
		} else {
			$("#loader_box").dialog("open");																		
			dataString = "first_name=" + first_name + "&last_name=" + last_name + "&company=" + company + "&position=" + position + "&website=" + website + "&photo_setting=" + photo_setting;
			$.ajax({
				type: "POST",
				url: "update_profile.php?type=employer_details",
				data: dataString,
				success: function(data) {
					//alert(data);
					window.location.reload();
				}
			});					
		}	
		return false;	
	});	

	$(function() {
		$("#loader_box").dialog({
			autoOpen: false,
			modal: true,
			height: 200,
			width: 450
		});
	});																		
	
}

function employee_advanced() {
			$("#change_compensation").click(function() {
				$('#compensation_visible').hide();			
				$('#compensation_hidden').show('fast');
			});
			
			$("#cancel_compensation").click(function() {
				$('#compensation_hidden').hide();			
				$('#compensation_visible').show('fast');
			});	
			
			$("#change_business").click(function() {
				$('#business_visible').hide();			
				$('#business_hidden').show('fast');
			});
			
			$("#cancel_business").click(function() {
				$('#business_hidden').hide();			
				$('#business_visible').show('fast');
			});						
			
			$("#comp_type").change(function() {	
				comp_type = $(this).val();
				if (comp_type == "All") {
					$("#comp_value_form").hide('fast') 
				} else {
					$("#comp_value_form").show('fast') 				
				}
			});	

			$('#select_all').on('click', function() {
			    $('.business').attr('checked', $(this).is(":checked"));
			});
			
		$(".edit_compensation").click(function() {
			comp_type = $('#comp_type');
			if (comp_type == "All") {
				comp_value = "0";
			} else {
				comp_value = $('#comp_value');
			}
			dataString = "comp_type=" + comp_type + "&comp_value=" + comp_value;
			//alert(dataString);
			if (comp_type != "All" && isNaN(comp_value)) {
				$("#comp_warning").show();
			} else {
				$("#loader_box").dialog("open");																		
				$.ajax({
					type: "POST",
					url: "update_profile.php?type=comp_type",
					data: dataString,
					success: function(data) {
						//alert(data);
						window.location.reload();
					}
				});	
			}

		return false;					
		});	
		
		$(".edit_store_skip").click(function() {
			var allVals = [];
			$('.business:unchecked').each(function() {
				 allVals.push($(this).val());
				 //alert($(this).val());
			});

			dataString = "store_skip=" + allVals;
			//alert(dataString);
				$("#loader_box").dialog("open");																		
				$.ajax({
					type: "POST",
					url: "update_profile.php?type=store_skip",
					data: dataString,
					success: function(data) {
						//alert(data);
						window.location.reload();
					}
				});	
		return false;					
		});			
			
		$(function() {
			$("#loader_box").dialog({
				autoOpen: false,
				modal: true,
				height: 200,
				width: 450
			});
		});						
}

function employee_step_one(userID, status) {
		$(".main_skill").click(function() {
			main_skill = $(this).attr('ID');
			box = main_skill + "_holder";	
			//alert(box);	
			$(".main_skill").hide();
			$("#" + box + "").show('fast');			
			return false;
		});	
		
		$(".back").click(function() {
			main_skill = $(this).attr('ID');
			box = main_skill + "_holder";	
			//alert(box);
			$("#" + box + "").hide('fast');				
			$(".main_skill").show('fast');
			return false;
		});			
		
		$(".save_add_another").click(function() {
			main_skill = $(this).attr('id');
			var allVals = [];
			count = 0;
			$('.' + main_skill + ':checked').each(function() {
				 allVals.push($(this).val());
				 count++;
				 //alert($(this).val());
			});
			desc = $('#' + main_skill + "_desc").val();
			experience = $('#' + main_skill + "_experience").val();
			seeking = $('#' + main_skill + "_seeking").val();	
						     
			dataString = "userID=" + userID + "&specialty=" + main_skill + "&sub=" + allVals + "&description=" + encodeURIComponent(desc) + "&experience=" + experience + "&seeking=" + seeking + "&status=1";
			//alert(dataString);
			if (isNaN(experience)) {
				$("#" + main_skill + "_experience_warning").show();
			} else if (count == 0) {
				$("#" + main_skill + "_sub_warning").show();				
			} else {
				$("#loader_box").dialog("open");																		
				$.ajax({
					type: "POST",
					url: "update_profile.php?type=add_skill",
					data: dataString,
					success: function(data) {
						//alert(data);
						window.location.reload();
					}
				});	
			}

		return false;					
		});	
		
		$(".save_continue").click(function() {
			main_skill = $(this).attr('id');
			status = $("#status").val();
			var allVals = [];
			count = 0;
			$('.' + main_skill + ':checked').each(function() {
				 allVals.push($(this).val());
				 count++;
				 //alert($(this).val());
			});
			desc = $('#' + main_skill + "_desc").val();
			experience = $('#' + main_skill + "_experience").val();
			seeking = $('#' + main_skill + "_seeking").val();				     
			dataString = "userID=" + userID + "&specialty=" + main_skill + "&sub=" + allVals + "&description=" + encodeURIComponent(desc) + "&experience=" + experience + "&seeking=" + seeking + "&status=" + status;
			//alert(dataString);
			if (isNaN(experience)) {
				$("#" + main_skill + "_experience_warning").show();
			} else if (count == 0) {
				$("#" + main_skill + "_sub_warning").show();				
			} else {
				$("#loader_box").dialog("open");
				if (status == "complete") {
					$.ajax({
						type: "POST",
						url: "update_profile.php?type=add_skill",
						data: dataString,
						success: function(data) {
							//alert(data);
							window.location = "profile.php";	
						}				
					});					
				} else {																	
					$.ajax({
						type: "POST",
						url: "update_profile.php?type=add_skill",
						data: dataString,
						success: function(data) {
							if (status > 2) {
								dataString = "status=" + status;
							} else {
								dataString = "status=2";								
							}
							$.ajax({
								type: "POST",
								url: "update_profile.php?type=update_status",
								data: dataString,
								success: function(data) {
									//alert(data);
									window.location = "profile.php";
								}
							});	
						}
					});	
				}
			}

		return false;					
		});	
		
		$(".continue").click(function() {
				$("#loader_box").dialog("open");																		
					if (status > 2) {
						dataString = "status=" + status;
					} else {
						dataString = "status=2";								
					}
						$.ajax({
							type: "POST",
							url: "update_profile.php?type=update_status",
							data: dataString,
							success: function(data) {
								//alert(data);
								window.location = "profile.php";
							}
						});	
		return false;					
		});		
		
		$(".remove_skill").click(function() {
			$("#loader_box").dialog("open");
			skillID = $(this).attr('ID');									
			dataString = "skillID=" + skillID;
			$.ajax({
				type: "POST",
				url: "update_profile.php?type=remove_skill",
				data: dataString,
				success: function(data) {
					//alert(data);
					window.location.reload();
				}
			});	
			return false;					
		});
		
		$(function() {
			$("#loader_box").dialog({
				autoOpen: false,
				modal: true,
				height: 200,
				width: 450
			});
		});													
}

function employee_step_two(status) {
		$(".edit_work").click(function() {
			employmentID = $(this).attr('ID');
			//alert(employmentID);
			$(".add_work_form").hide();
			$(".visible_employment").hide();			
			$("#employment_record_" + employmentID).show('fast');
			return false;			
		});
		
		$(".remove_work").click(function() {
			employmentID = $(this).attr('ID');
			//alert(employmentID);
			dataString = "workID=" + employmentID;
			//alert(dataString);
			$("#loader_box").dialog("open");
			$.ajax({
				type: "POST",
				url: "update_profile.php?type=remove_work",
				data: dataString,
				success: function(data) {
					//alert(data);
					window.location.reload();
				}
			});								
			return false;			
		});				
		
		$(".cancel").click(function() {
			$(".hidden_employment").hide();
			$(".remove_warning").hide();					
			$(".step_button").show('fast');
			$(".visible_employment").show('fast');
			$(".add_work_form").show('fast');
			return false;			
		});	
		
		
		$(".save_add_another").click(function() {
			past_company = $('#past_company').val();
			past_position = $('#past_position').val();
			past_website = $('#past_website').val();							
			start_date = $('#start_date').val();
			end_date = $('#end_date').val();
			dataString = "company=" + encodeURIComponent(past_company) + "&website=" + past_website + "&position=" + encodeURIComponent(past_position) + "&start_date=" + encodeURIComponent(start_date) + "&end_date=" + encodeURIComponent(end_date);
			//alert(dataString);
			if (past_company.length == 0) {
				$('#past_company_empty_warning').show();						
			} else {
				//alert("here");
				$("#loader_box").dialog("open");
				$.ajax({
					type: "POST",
					url: "update_profile.php?type=add_work",
					data: dataString,
					success: function(data) {
						window.location.reload();
					}
				});
			}					
			return false;					
		});	
		
		$(".save_continue").click(function() {
			past_company = $('#past_company').val();
			past_position = $('#past_position').val();
			past_website = $('#past_website').val();							
			start_date = $('#start_date').val();
			end_date = $('#end_date').val();
			//alert(status);
			//create conditions for continuing
			if (past_company.length == 0 ) {
				if (past_position.length != 0 || past_website.length != 0 || start_date.length != 0 || end_date.length != 0) {
					condition = "empty_company";
				} else {
					condition = "continue";
				}
			} else {
				condition = "save_continue";			
			}
			
			switch(condition) {
				case "empty_company":
					$('#past_company_empty_warning').show();										
				break;
				
				case "continue":
				//continue with no save
					$("#loader_box").dialog("open");																		
							if (status > 3 || status == "complete") {
								dataString = "status=" + status;
							} else {
								dataString = "status=3";								
							}
						$.ajax({
							type: "POST",
							url: "update_profile.php?type=update_status",
							data: dataString,
							success: function(data) {
								window.location = "profile.php";						
							}
						});				
				break;
				
				case "save_continue":
					dataString = "company=" + encodeURIComponent(past_company) + "&website=" + past_website + "&position=" + encodeURIComponent(past_position) + "&start_date=" + encodeURIComponent(start_date) + "&end_date=" + encodeURIComponent(end_date);
					//alert(dataString);
					$("#loader_box").dialog("open");
					if (status == "complete") {
						$.ajax({
							type: "POST",
							url: "update_profile.php?type=add_work",
							data: dataString,
							success: function(data) {
								//alert(data);
								window.location = "profile.php";						
							}
						});
					
					} else {
						$.ajax({
							type: "POST",
							url: "update_profile.php?type=add_work",
							data: dataString,
							success: function(data) {
								if (status > 3 || status == "complete") {
									dataString = "status=" + status;
								} else {
									dataString = "status=3";								
								}
								$.ajax({
									type: "POST",
									url: "update_profile.php?type=update_status",
									data: dataString,
									success: function(data) {
										//alert(data);
										window.location.reload();
									}
								});	
							}
						});
					}
				break;
			}				
			return false;					
		});			
				
		
		$(".save_changes").click(function() {
			employmentID = $(this).attr('ID');
			past_company = $('#company_' + employmentID).val();
			past_position = $('#position_'  + employmentID).val();
			past_website = $('#website_'  + employmentID).val();							
			start_date = $('#start_'  + employmentID).val();
			end_date = $('#end_'  + employmentID).val();
			
			dataString = "workID=" + employmentID + "&company=" + encodeURIComponent(past_company) + "&website=" + past_website + "&position=" + encodeURIComponent(past_position) + "&start_date=" + encodeURIComponent(start_date) + "&end_date=" +  encodeURIComponent(end_date);
			//alert(dataString);
			if (past_company.length == 0) {
				$('#company_empty_warning_' + employmentID).show();						
			} else {
				//alert("here");
				$("#loader_box").dialog("open");
				$.ajax({
					type: "POST",
					url: "update_profile.php?type=edit_work",
					data: dataString,
					success: function(data) {
						//alert(data);
						window.location.reload();
					}
				});
			}					
			return false;					
		});	
		
		$(function() {
			$("#loader_box").dialog({
				autoOpen: false,
				modal: true,
				height: 200,
				width: 450
			});
		});													
}

function employee_step_three(status) {
		$(".edit_education").click(function() {
			educationID = $(this).attr('ID');
			//alert(educationID);
			$(".visible_education").hide();
			$("#add_education_form").hide();			
			$("#education_" + educationID + "_edit").show('fast');
			return false;			
		});	
		
		$(".cancel").click(function() {
			$(".hidden_education").hide();
			$(".remove_warning").hide();						
			$(".visible_education").show('fast');
			$("#add_education_form").show('fast');						
			return false;
		});			
		
		$(".save_add_another").click(function() {
			school = $('#school').val();
			degree = $('#degree').val();
			dataString = "school=" + encodeURIComponent(school) + "&degree=" + encodeURIComponent(degree);
			//alert(dataString);
			if (school.length == 0) {
				$('#school_empty_warning').show();						
			} else {
				//alert("here");
				$("#loader_box").dialog("open");
				$.ajax({
					type: "POST",
					url: "update_profile.php?type=add_education",
					data: dataString,
					success: function(data) {
						//alert(data);
						window.location.reload();
					}
				});
			}					
			return false;					
		});	
		
		$(".save_continue").click(function() {
			school = $('#school').val();
			degree = $('#degree').val();
			//alert(dataString);
			
			//create conditions for continuing
			if (school.length == 0 ) {
				if (degree.length != 0) {
					condition = "empty_school";
				} else {
					condition = "continue";
				}
			} else {
				condition = "save_continue";			
			}
			
			switch(condition) {
				case "empty_school":
					$('#school_empty_warning').show();					
				break;
				
				case "continue":
					$("#loader_box").dialog("open");																		
							if (status > 4 || status == "complete") {
								dataString = "status=" + status;
							} else {
								dataString = "status=4";								
							}
						$.ajax({
							type: "POST",
							url: "update_profile.php?type=update_status",
							data: dataString,
							success: function(data) {
								//alert(data);
								window.location = "profile.php";						
							}
						});					
				break;
				
				case "save_continue":
						dataString = "school=" + encodeURIComponent(school) + "&degree=" + encodeURIComponent(degree);				
						$("#loader_box").dialog("open");
						if (status == "complete") {
							$.ajax({
								type: "POST",
								url: "update_profile.php?type=add_education",
								data: dataString,
								success: function(data) {
									window.location = "profile.php";						
								}
							});
						
						} else {
							$.ajax({
								type: "POST",
								url: "update_profile.php?type=add_education",
								data: dataString,
								success: function(data) {
									if (status > 4 || status == "complete") {
										dataString = "status=" + status;
									} else {
										dataString = "status=4";								
									}
									$.ajax({
										type: "POST",
										url: "update_profile.php?type=update_status",
										data: dataString,
										success: function(data) {
											//alert(data);
											window.location.reload();
										}
									});	
								}
							});
						}
				break;
			}
			return false;
		});

				
		$(".save_changes").click(function() {
			educationID = $(this).attr('ID');
			school = $('#school_' + educationID).val();
			degree = $('#degree_' + educationID).val();
			dataString = "educationID=" + educationID + "&school=" + encodeURIComponent(school) + "&degree=" + encodeURIComponent(degree);
			//alert(dataString);
			if (school.length == 0) {
				$('#school_empty_warning_' + educationID + '').show();						
			} else {
				//alert("here");
				$("#loader_box").dialog("open");
				$.ajax({
					type: "POST",
					url: "update_profile.php?type=edit_education",
					data: dataString,
					success: function(data) {
							//alert(data);
							window.location.reload();
					}
				});
			}					
			return false;					
		});	
		
		$(".remove_education").click(function() {
			educationID = $(this).attr('ID');		
			dataString = "educationID=" + educationID;
			//alert(dataString);
			$("#loader_box").dialog("open");
			$.ajax({
				type: "POST",
				url: "update_profile.php?type=remove_education",
				data: dataString,
				success: function(data) {
					//alert(data);
					window.location.reload();
				}
			});		
			return false;			
		});		
			
		$(function() {
			$("#loader_box").dialog({
				autoOpen: false,
				modal: true,
				height: 200,
				width: 450
			});
		});													
}

function employee_step_four(status, ref_jobID) {
				
		$(".save_continue").click(function() {
				var allVals = [];
			     $('input[type=checkbox]:checked').each(function() {
			     	//alert("check");
			     	  allVals.push($(this).val());
			     });																																																	
				dataString = "languages=" + allVals;
				//alert(dataString);
					$("#loader_box").dialog("open");									
					$.ajax({
						type: "POST",
						url: "update_profile.php?type=employee_languages",
						data: dataString,
						success: function(data) {
							//alert(data);
							dataString = "status=complete";
								$.ajax({
									type: "POST",
									url: "update_profile.php?type=update_status",
									data: dataString,
									success: function(data) {
										if (ref_jobID == "" || ref_jobID == "NA") {
											window.location.reload();
										} else {
											window.location = "job.php?ID=" + ref_jobID;
										}
									}
								});	
						}
					});
			return false;					
		});		
		
		$(".back").click(function() {
				$("#loader_box").dialog("open");																		
				dataString = "status=3";
						$.ajax({
							type: "POST",
							url: "update_profile.php?type=update_status",
							data: dataString,
							success: function(data) {
								//alert(data);
								window.location.reload();
							}
						});	
		return false;					
		});					
		
	$(".remove_video").click(function() {
		videoID = $(this).attr("ID");
		dataString = "videoID=" + videoID;
		//alert(dataString);
		$("#loader_box").dialog("open");
		$.ajax({
			type: "POST",
			url: "update_profile.php?type=remove_video",
			data: dataString,
			success: function(data) {
					//alert(data);
					window.location = "profile.php";
			}
		});	
		return false;				  	
	});						
				
		$(function() {
			$("#loader_box").dialog({
				autoOpen: false,
				modal: true,
				height: 200,
				width: 450
			});
		});		
}	

function employee_edit_details(status) {
				
		$(".save_continue").click(function() {
				$(".warning").hide();
				first_name = $('#first_employee').val().trim();
				last_name = $('#last_employee').val().trim();
				zip = $('#zip_employee').val().trim();
				raw_phone = $('#contact_phone').val().trim();	
				contact_phone = raw_phone.replace(/[^\d.]/g, "");
				var allVals = [];
			     $('input[type=checkbox]:checked').each(function() {
			     	//alert("check");
			     	  allVals.push($(this).val());
			     });																																																	
				dataString = "first_name=" + encodeURIComponent(first_name) + "&last_name=" + encodeURIComponent(last_name) + "&zip=" + zip + "&phone=" + contact_phone + "&languages=" + allVals;
				//alert(dataString);
				if (first_name.length == 0 || last_name.length == 0 || zip.length == 0) {
					$('#employee_empty_warning').show();
				} else if (isNaN(zip) == true || zip.length != 5) {
					$('#employee_zip_warning').show();
				} else {
					$("#loader_box").dialog("open");									
					$.ajax({
						type: "POST",
						url: "update_profile.php?type=employee_details",
						data: dataString,
						success: function(data) {
							//alert(data);
							if (data == "zip") {
								$("#loader_box").dialog("close");									
								$('#employee_invalid_zip_warning').show();	
							} else {	
								window.location = "profile.php"						
							}
						}
					});
				}	
			return false;					
		});			
				
		$(function() {
			$("#loader_box").dialog({
				autoOpen: false,
				modal: true,
				height: 200,
				width: 450
			});
		});		
}	

function employee_advanced()	{
		$("#comp_change").click(function() {
			$("#comp_change").hide();					
			$("#compensation_hidden").show('fast');
			return false;			
		});	
		
		$("#comp_cancel").click(function() {
			$("#comp_change").show();					
			$("#compensation_hidden").hide();
			return false;			
		});					
		
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
				$("#loader_box").dialog("open");
				$.ajax({
					type: "POST",
					url: "update_profile.php?type=edit_email_match",
					data: dataString,
					success: function(data) {
							//alert(data);
							window.location.reload();
					}
				});			
			return false;			
		});			
		
		$("#comp_type").change(function() {
			comp_type = $(this).val();
			//alert(comp_type);
			if (comp_type != "All") {
				$("#comp_value_form").show('fast');				
			} else {
				$("#comp_value_form").hide('fast');								
			}
			return false;			
		});	
		
		$("#save_comp").click(function() {
			comp_type = $('#comp_type').attr('value');
			if (comp_type != "All") {
				comp_value = $('#comp_value').attr('value');
			} else {
				comp_value = 0;
			}
			dataString = "comp_type=" + comp_type + "&comp_value=" + comp_value;
			//alert(dataString);
			if (isNaN(comp_value) == true) {
				$('#value_warning').show();						
			} else {
				//alert("here");
				$("#loader_box").dialog("open");
				$.ajax({
					type: "POST",
					url: "update_profile.php?type=edit_comp",
					data: dataString,
					success: function(data) {
							//alert(data);
							window.location.reload();
					}
				});
			}					
			return false;					
		});	
				
		$(function() {
			$("#loader_box").dialog({
				autoOpen: false,
				modal: true,
				height: 200,
				width: 450
			});
		});							
}	

function employee_video() {

	$("#save_video").click(function() {
		url = $("#video_url").val();
		//alert(url);
		$("#loader_box").dialog("open");
		$(".warning").hide();				
		$.embedly.extract(url, {key:'f5b7ea57c3b84df88d4e8d9c6c9acb05'})
		.progress(function(data){
			//alert(data.media.type);
		  if (data.media == undefined || data.provider_name == undefined) {
			  $("#loader_box").dialog("close");					  
			  $('#host_warning').show();			  
		  } else {
			  var type = data.media.type;
			  var host = data.provider_name;
			  //alert(type);
			  //alert(host);
			  switch(host) {
				  case "Instagram":
					if (type == "video") {
						action = "save";
					} else if (type == "photo") {
						action = "wrong_type";
					} else {
						action = "private";
					}
				  break;
				  
				  case "Vine":
					if (type == "video") {
						action = "save";
					} else {
						action = "wrong_type";
					}
				  break;
				  
				  case "YouTube":
					if (type == "video") {
						action = "save";
					} else {
						action = "private";
					}
				  break;	
				  
				  default:
				  	action = "wrong_host";
				  break;		  
			  }
			  //alert(action);
			  switch(action) {
				  case "save":
					dataString = "video_url=" + url;
					//alert(dataString);
						$.ajax({
							type: "POST",
							url: "update_profile.php?type=upload_video",
							data: dataString,
							success: function(data) {
									//alert(data);
									window.location = "profile.php";
							}
						});					  
				  break;
				  
				  case "wrong_type":
				  	 $("#loader_box").dialog("close");					  
					 $ ('#type_warning').show();			  
				  break;
				  
				  case "private":
				  	 $("#loader_box").dialog("close");					  
					 $ ('#private_warning').show();			  
				  break;	
				  
				  case "wrong_host":
				  	 $("#loader_box").dialog("close");					  
					  $('#host_warning').show();			  
				  break;			  			  		  			  
			  }
		  }
			return false;			
		});	
	});			
		
	$(".remove_video").click(function() {
		videoID = $(this).attr("ID");
		dataString = "videoID=" + videoID;
		//alert(dataString);
		$("#loader_box").dialog("open");
		$.ajax({
			type: "POST",
			url: "update_profile.php?type=remove_video",
			data: dataString,
			success: function(data) {
					//alert(data);
					window.location = "profile.php";
			}
		});	
		return false;				  	
	});
	
	$(function() {
		$("#loader_box").dialog({
			autoOpen: false,
			modal: true,
			height: 200,
			width: 450
		});
	});										
}	

function profile_employee_other(profileID, highlight) {

		$(".profile_tab").click(function() {
		profile_view = $(this).attr('ID');
		//alert(profile_view);
		
		$('.profile_tab').removeClass('selected_tab');
		$('.profile_tab').addClass('unselected_tab');
		$('#'+profile_view+'').removeClass('unselected_tab');		
		$('#'+profile_view+'').addClass('selected_tab');
		
		if (profile_view == "profile") {
			$('.details').show();	
			$('#questions_holder').hide();	
			$('#message_holder').hide();														
		} else {
			$('.details').hide();
			$('#' + profile_view + '_holder').show();		
		}
		return false;
	});	
	
			$("#watch_video").click(function() {
				//alert("here");
				$("#video_box").dialog("open");
				return false;
			});

			$(function() {
				$("#video_box").dialog({
					autoOpen: false,
					modal: true,
					height: 400,
					width: 600
				});
			});	
			
		$(".highlight_candidate").click(function() {
			matchID = $(this).attr('ID');
			if (highlight == "Y") {
				new_highlight = "N";
			} else {
				new_highlight = "Y";
			}
			dataString = "matchID=" + matchID + "&highlight=" + new_highlight;
				$.ajax({
					type: "POST",
					url: "update_job.php?type=highlight",
					data: dataString,
					success: function(data) {
						$("#loader_box").dialog("open");				
						window.location.reload();
					}
				});					
			return false;
		});				
			
			$("#report").click(function() {
				//alert("report");
				$("#loader_box").dialog("open");				
				$("#inappropriate_form").dialog("open");
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
							dataString = "profileID=" + profileID + "&type=profile";
							$.ajax({
								type: "POST",
								url: "update_profile.php?type=report",
								data: dataString,
								success: function(data) {
									//alert(data);
									window.location.reload();
								}
							});					
						}
					}
				});
			});	
			
	$(function() {
		$("#loader_box").dialog({
			autoOpen: false,
			modal: true,
			height: 200,
			width: 450
		});
	});																																							
																
}

function employee_step_one_mobile(userID, status) {
		$(".main_skill").click(function() {
			main_skill = $(this).attr('ID');
			box = main_skill + "_holder";	
			//alert(box);	
			$(".main_skill").hide();
			$(".back").show();
			$("#" + box + "").show('fast');			
			return false;
		});	
		
		$(".back").click(function() {
			$(".skill_holder").hide('fast');				
			$(".main_skill").show('fast');
			$(".back").hide();			
			return false;
		});			
		
		$(".save_add_another").click(function() {
			$('#button_holder').hide();
			$(".main_box").hide();	
			$("#loader_box").show();	
			main_skill = $(this).attr('id');
			var allVals = [];
			count = 0;
			$('.' + main_skill + ':checked').each(function() {
				 allVals.push($(this).val());
				 count++;
				 //alert($(this).val());
			});
			desc = $('#' + main_skill + "_desc").val();
			experience = $('#' + main_skill + "_experience").val();
			seeking = $('#' + main_skill + "_seeking").val();	
						     
			dataString = "userID=" + userID + "&specialty=" + main_skill + "&sub=" + allVals + "&description=" + encodeURIComponent(desc) + "&experience=" + experience + "&seeking=" + seeking + "&status=1";
			//alert(dataString);
			if (isNaN(experience)) {
				$("#" + main_skill + "_experience_warning").show();
				$(".main_box").show();	
				$("#loader_box").hide();	
				$('#button_holder').show();							
			} else if (count == 0) {
				$("#" + main_skill + "_sub_warning").show();
				$(".main_box").show();	
				$("#loader_box").hide();	
				$('#button_holder').show();															
			} else {
				$.ajax({
					type: "POST",
					url: "update_profile.php?type=add_skill",
					data: dataString,
					success: function(data) {
						//alert(data);
						window.location.reload();
					}
				});	
			}

		return false;					
		});	
		
		$(".save_continue").click(function() {
			$('#button_holder').hide();
			$(".main_box").hide();	
			$("#loader_box").show();	
			main_skill = $(this).attr('id');
			status = $("#status").val();
			//alert(status);
			var allVals = [];
			count = 0;
			$('.' + main_skill + ':checked').each(function() {
				 allVals.push($(this).val());
				 //alert($(this).val());
				 count++;
			});
			desc = $('#' + main_skill + "_desc").val();
			experience = $('#' + main_skill + "_experience").val();
			seeking = $('#' + main_skill + "_seeking").val();				     
			dataString = "userID=" + userID + "&specialty=" + main_skill + "&sub=" + allVals + "&description=" + encodeURIComponent(desc) + "&experience=" + experience + "&seeking=" + seeking + "&status=" + status;
			//alert(dataString);
			if (isNaN(experience)) {
				$(".main_box").show();	
				$("#loader_box").hide();	
				$('#button_holder').show();										
				$("#" + main_skill + "_experience_warning").show();
			} else if (count == 0) {
				$(".main_box").show();	
				$("#loader_box").hide();	
				$('#button_holder').show();										
				$("#" + main_skill + "_sub_warning").show();
			} else {
				if (status == "complete") {
					$.ajax({
						type: "POST",
						url: "update_profile.php?type=add_skill",
						data: dataString,
						success: function(data) {
							//alert(data);
							window.location = "profile.php";	
						}				
					});					
				} else {																	
					$.ajax({
						type: "POST",
						url: "update_profile.php?type=add_skill",
						data: dataString,
						success: function(data) {
							if (status > 1 || status == "complete") {
								dataString = "status=" + status;
							} else {
								dataString = "status=2";								
							}
							$.ajax({
								type: "POST",
								url: "update_profile.php?type=update_status",
								data: dataString,
								success: function(data) {
									//alert(data);
									window.location = "profile.php";	
								}
							});	
						}
					});	
				}
			}

		return false;					
		});	
		
		$(".continue").click(function() {
				$('#button_holder').hide();
				$(".main_box").hide();	
				$("#loader_box").show();	
				if (status > 1 || status == "complete") {
					dataString = "status=" + status;
				} else {
					dataString = "status=2";								
				}
						$.ajax({
							type: "POST",
							url: "update_profile.php?type=update_status",
							data: dataString,
							success: function(data) {
								//alert(data);
								window.location = "profile.php";	
							}
						});	
		return false;					
		});		
		
		$(".remove_skill").click(function() {
			$('#button_holder').hide();
			$(".main_box").hide();	
			$("#loader_box").show();	
			skillID = $(this).attr('ID');									
			dataString = "skillID=" + skillID;
			$.ajax({
				type: "POST",
				url: "update_profile.php?type=remove_skill",
				data: dataString,
				success: function(data) {
					//alert(data);
					window.location.reload();
				}
			});	
			return false;					
		});		
}

function employee_step_two_mobile(status) {
		$(".edit_work").click(function() {
			employmentID = $(this).attr('ID');
			//alert(employmentID);
			$(".add_work_form").hide();
			$(".visible_employment").hide();			
			$("#employment_record_" + employmentID).show('fast');
			return false;			
		});
		
		$(".remove_work").click(function() {
			$('#button_holder').hide();
			$(".main_box").hide();	
			$("#loader_box").show();	
			employmentID = $(this).attr('ID');
			//alert(employmentID);
			dataString = "workID=" + employmentID;
			//alert(dataString);
			$.ajax({
				type: "POST",
				url: "update_profile.php?type=remove_work",
				data: dataString,
				success: function(data) {
					//alert(data);
					window.location.reload();
				}
			});								
			return false;			
		});				
		
		$(".cancel").click(function() {
			$(".hidden_employment").hide();
			$(".remove_warning").hide();					
			$(".step_button").show('fast');
			$(".visible_employment").show('fast');
			$(".add_work_form").show('fast');
			return false;			
		});	
		
		
		$(".save_continue").click(function() {
			$('#button_holder').hide();
			$(".main_box").hide();	
			$("#loader_box").show();	
			past_company = $('#past_company').val();
			past_position = $('#past_position').val();
			past_website = $('#past_website').val();							
			start_date = $('#start_date').val();
			end_date = $('#end_date').val();
			dataString = "company=" + encodeURIComponent(past_company) + "&website=" + past_website + "&position=" + encodeURIComponent(past_position) + "&start_date=" + encodeURIComponent(start_date) + "&end_date=" + encodeURIComponent(end_date);
			//alert(dataString);
			
			//create conditions for continuing
			if (past_company.length == 0 ) {
				if (past_position.length != 0 || past_website.length != 0 || start_date.length != 0 || end_date.length != 0) {
					condition = "empty_company";
				} else {
					condition = "continue";
				}
			} else {
				condition = "save_continue";			
			}
			//alert(condition);
			switch(condition) {
				case "empty_company":
					$(".main_box").show();	
					$("#loader_box").hide();	
					$('#button_holder').show();																									
					$('#past_company_empty_warning').show();										
				break;	
				
				case "continue":
				//continue with no save
				$('#loader_holder').show();																		
							if (status > 3 || status == "complete") {
								dataString = "status=" + status;
							} else {
								dataString = "status=3";								
							}
						$.ajax({
							type: "POST",
							url: "update_profile.php?type=update_status",
							data: dataString,
							success: function(data) {
								window.location = "profile.php";						
							}
						});							
				break;
				
				case "save_continue":
					if (status == "complete") {
						$.ajax({
							type: "POST",
							url: "update_profile.php?type=add_work",
							data: dataString,
							success: function(data) {
								//alert(data);
								window.location = "profile.php";						
							}
						});
					
					} else {
						$.ajax({
							type: "POST",
							url: "update_profile.php?type=add_work",
							data: dataString,
							success: function(data) {
								dataString = "status=3";
								$.ajax({
									type: "POST",
									url: "update_profile.php?type=update_status",
									data: dataString,
									success: function(data) {
										//alert(data);
										window.location = "profile.php";
									}
								});	
							}
						});
				}				
				break;
			}
			
		});	
		
		$(".save_add_another").click(function() {
			$('#button_holder').hide();
			$(".main_box").hide();	
			$("#loader_box").show();	
			past_company = $('#past_company').val();
			past_position = $('#past_position').val();
			past_website = $('#past_website').val();							
			start_date = $('#start_date').val();
			end_date = $('#end_date').val();
			dataString = "company=" + encodeURIComponent(past_company) + "&website=" + past_website + "&position=" + encodeURIComponent(past_position) + "&start_date=" + encodeURIComponent(start_date) + "&end_date=" + encodeURIComponent(end_date);
			//alert(dataString);
			if (past_company.length == 0) {
				$(".main_box").show();	
				$("#loader_box").hide();	
				$('#button_holder').show();																									
				$('#past_company_empty_warning').show();						
			} else {
				$.ajax({
					type: "POST",
					url: "update_profile.php?type=add_work",
					data: dataString,
					success: function(data) {
						window.location.reload();
					}
				});
			}					
			return false;					
		});			
				
		$(".continue").click(function() {
				$('#button_holder').hide();
				$(".main_box").show();	
				$("#loader_box").hide();	
				dataString = "status=3";
						$.ajax({
							type: "POST",
							url: "update_profile.php?type=update_status",
							data: dataString,
							success: function(data) {
								//alert(data);
								window.location = "profile.php";
							}
						});	
			return false;					
		});	
		
		$(".save_changes").click(function() {
			$('#button_holder').hide();
			$(".main_box").hide();	
			$("#loader_box").show();	
			employmentID = $(this).attr('ID');
			past_company = $('#company_' + employmentID).val();
			past_position = $('#position_'  + employmentID).val();
			past_website = $('#website_'  + employmentID).val();							
			start_date = $('#start_'  + employmentID).val();
			end_date = $('#end_'  + employmentID).val();
			dataString = "workID=" + employmentID + "&company=" + encodeURIComponent(past_company) + "&website=" + past_website + "&position=" + encodeURIComponent(past_position) + "&start_date=" + encodeURIComponent(start_date) + "&end_date=" + encodeURIComponent(end_date);
			//alert(dataString);
			if (past_company.length == 0) {
				$(".main_box").show();	
				$("#loader_box").hide();	
				$('#button_holder').show();																									
				$('#company_empty_warning_' + employmentID).show();						
			} else {
				$.ajax({
					type: "POST",
					url: "update_profile.php?type=edit_work",
					data: dataString,
					success: function(data) {
						//alert(data);
						window.location.reload();
					}
				});
			}					
			return false;					
		});	
		
		$(".back").click(function() {
				$('#button_holder').hide();
				$(".main_box").hide();	
				$("#loader_box").show();	
				dataString = "status=1";
						$.ajax({
							type: "POST",
							url: "update_profile.php?type=update_status",
							data: dataString,
							success: function(data) {
								//alert(data);
								window.location.reload();
							}
						});	
		return false;					
		});			
}

function employee_step_three_mobile(status) {
		$(".edit_education").click(function() {
			educationID = $(this).attr('ID');
			//alert(educationID);
			$(".remove_warning").hide();									
			$(".save_continue").hide()	;
			$(".save_add_another").hide();							
			$(".visible_education").hide();
			$(".add_education_form").hide();			
			$("#education_" + educationID + "_edit").show('fast');
			return false;			
		});	
		
		$(".cancel").click(function() {
			$(".hidden_education").hide();
			$(".remove_warning").hide();						
			$(".visible_education").show('fast');
			$(".add_education_form").show('fast');
			$("#add_education_form").show('fast');
			$(".save_continue").show();	
			$(".save_add_another").show();																				
			return false;
		});			
		
		$(".save_add_another").click(function() {
			$('#button_holder').hide();
			$(".main_box").hide();	
			$("#loader_box").show();	
			school = $('#school').val();
			degree = $('#degree').val();
			dataString = "school=" + encodeURIComponent(school) + "&degree=" + encodeURIComponent(degree);
			if (school.length == 0) {
				$(".main_box").show();	
				$("#loader_box").hide();	
				$('#button_holder').show();																									
				$('#school_edit_empty_warning').show();
				$('#school_empty_warning').show();																
			} else {
				$.ajax({
					type: "POST",
					url: "update_profile.php?type=add_education",
					data: dataString,
					success: function(data) {
						//alert(data);
						window.location.reload();
					}
				});
			}					
			return false;					
		});	
		
		$(".save_continue").click(function() {
			$('#button_holder').hide();
			$(".main_box").hide();	
			$("#loader_box").show();	
			school = $('#school').val();
			degree = $('#degree').val();
			dataString = "school=" + encodeURIComponent(school) + "&degree=" + encodeURIComponent(degree);
			//alert(dataString);
			
			if (school.length == 0 ) {
				if (degree.length != 0) {
					condition = "empty_school";
				} else {
					condition = "continue";
				}
			} else {
				condition = "save_continue";			
			}
			//alert(condition);
			switch(condition) {
				case "empty_school":
					$('#school_empty_warning').show();						
				break;
			
				case "continue":
					$('#button_holder').hide();
					$(".main_box").hide();	
					$("#loader_box").show();	
						if (status > 4 || status == "complete") {
							dataString = "status=" + status;
						} else {
							dataString = "status=4";								
						}
							$.ajax({
								type: "POST",
								url: "update_profile.php?type=update_status",
								data: dataString,
								success: function(data) {
									//alert(data);
									window.location = "profile.php";
								}
							});					
				break;
				
				case "save_continue":
					if (status == "complete") {
						$.ajax({
							type: "POST",
							url: "update_profile.php?type=add_education",
							data: dataString,
							success: function(data) {
								window.location = "profile.php";						
							}
						});
					
					} else {
						$.ajax({
							type: "POST",
							url: "update_profile.php?type=add_education",
							data: dataString,
							success: function(data) {
								dataString = "status=4";
								$.ajax({
									type: "POST",
									url: "update_profile.php?type=update_status",
									data: dataString,
									success: function(data) {
										//alert(data);
										window.location.reload();
									}
								});	
							}
						});
					}				
				break;
			}
			return false;					
		});			
				
		$(".continue").click(function() {
				$('#button_holder').hide();
				$(".main_box").hide();	
				$("#loader_box").show();	
				dataString = "status=4";
						$.ajax({
							type: "POST",
							url: "update_profile.php?type=update_status",
							data: dataString,
							success: function(data) {
								//alert(data);
								window.location.reload();
							}
						});	
				return false;					
		});	
		
		$(".save_changes").click(function() {
			$('#button_holder').hide();
			$(".main_box").hide();	
			$("#loader_box").show();	
			educationID = $(this).attr('ID');
			school = $('#school_' + educationID).val();
			degree = $('#degree_' + educationID).val();
			dataString = "educationID=" + educationID + "&school=" + encodeURIComponent(school) + "&degree=" + encodeURIComponent(degree);
			//alert(dataString);
			if (school.length == 0) {
				$(".main_box").show();	
				$("#loader_box").hide();	
				$('#button_holder').show();																						
				$('#school_empty_warning_' + educationID + '').show();						
			} else {
				$.ajax({
					type: "POST",
					url: "update_profile.php?type=edit_education",
					data: dataString,
					success: function(data) {
							//alert(data);
							window.location.reload();
					}
				});
			}					
			return false;					
		});	
		
		$(".remove_education").click(function() {
			$('#button_holder').hide();
			$(".main_box").hide();	
			$("#loader_box").show();	
			educationID = $(this).attr('ID');		
			dataString = "educationID=" + educationID;
			//alert(dataString);
			$.ajax({
				type: "POST",
				url: "update_profile.php?type=remove_education",
				data: dataString,
				success: function(data) {
					//alert(data);
					window.location.reload();
				}
			});		
			return false;			
		});		
	
		$(".back").click(function() {
				$('#button_holder').hide();
				$(".main_box").hide();	
				$("#loader_box").show();	
				dataString = "status=2";
						$.ajax({
							type: "POST",
							url: "update_profile.php?type=update_status",
							data: dataString,
							success: function(data) {
								//alert(data);
								window.location.reload();
							}
						});	
		return false;					
		});							
}

function employee_step_four_mobile(status, ref_jobID) {
				
		$(".save_continue").click(function() {
				$('#button_holder').hide();
				$(".main_box").hide();	
				$("#loader_box").show();	
				var allVals = [];
			     $('input[type=checkbox]:checked').each(function() {
			     	//alert("check");
			     	  allVals.push($(this).val());
			     });																																																	
				dataString = "languages=" + allVals;
				//alert(dataString);
					//$("#loader_box").dialog("open");									
					$.ajax({
						type: "POST",
						url: "update_profile.php?type=employee_languages",
						data: dataString,
						success: function(data) {
							//alert(data);
							dataString = "status=complete";
								$.ajax({
									type: "POST",
									url: "update_profile.php?type=update_status",
									data: dataString,
									success: function(data) {
										//alert(data);
										if (ref_jobID == "NA" || ref_jobID == "") {
											window.location.reload();
										} else {
											window.location = "job.php?ID=" + ref_jobID;											
										}
									}
								});	
						}
					});
			return false;					
		});	
				
		$(".back").click(function() {
				$('#button_holder').hide();
				$(".main_box").hide();	
				$("#loader_box").show();	
				dataString = "status=3";
						$.ajax({
							type: "POST",
							url: "update_profile.php?type=update_status",
							data: dataString,
							success: function(data) {
								//alert(data);
								window.location.reload();
							}
						});	
		return false;					
		});						
}

function employee_edit_details_mobile() {
				
		$(".save_continue").click(function() {
				$('#button_holder').hide();
				$(".main_box").hide();	
				$("#loader_box").show();	
				$(".warning").hide();
				first_name = $('#first_employee').val().trim();
				last_name = $('#last_employee').val().trim();
				zip = $('#zip_employee').val().trim();
				raw_phone = $('#contact_phone').val().trim();	
				contact_phone = raw_phone.replace(/[^\d.]/g, "");
				var allVals = [];
			     $('input[type=checkbox]:checked').each(function() {
			     	//alert("check");
			     	  allVals.push($(this).val());
			     });																																																	
				dataString = "first_name=" + encodeURIComponent(first_name) + "&last_name=" + encodeURIComponent(last_name) + "&zip=" + zip + "&phone=" + contact_phone + "&languages=" + allVals;
				//alert(dataString);
				if (first_name.length == 0 || last_name.length == 0 || zip.length == 0) {
					$(".main_box").show();	
					$("#loader_box").hide();	
					$('#button_holder').show();																										
					$('#employee_empty_warning').show();
				} else if (isNaN(zip) == true || zip.length != 5) {
					$(".main_box").show();	
					$("#loader_box").hide();	
					$('#button_holder').show();																						
					$('#employee_zip_warning').show();
				} else {
					$.ajax({
						type: "POST",
						url: "update_profile.php?type=employee_details",
						data: dataString,
						success: function(data) {
							//alert(data);
							if (data == "zip") {
								$(".main_box").show();	
								$("#loader_box").hide();	
								$('#button_holder').show();																						
								$('#employee_invalid_zip_warning').show();	
							} else {	
								window.location = "profile.php"						
							}
						}
					});
				}	
			return false;					
		});			
}																																																																																										

function mobile_profile_employer() {
		
	$('#personal_details').click(function() {
		$('#employer_profile').hide();
		$('#employer_profile_edit').show('fast');	
		return false;	
	});
	
	$('#cancel_employer_edit').click(function() {
		$('#employer_profile_edit').hide();
		$('#employer_profile').show('fast');	
		return false;	
	});	

	$('#add_store').click(function() {
		$('#button_holder').hide();
		$(".main_box").hide();	
		$("#loader_box").show();	
		$('#store_required_warning').hide();
		$('#store_zip_warning').hide();	
				
		store_name = encodeURIComponent($('#store_name').val().trim());
		store_website = encodeURIComponent($('#store_website').val().trim());
		store_address = $('#address').val().trim();
		store_zip = $('#zip').val().trim();
		business_type = $('#description').val();
		
		if (store_name.length == 0 || store_address.length == 0 || store_zip.length == 0) {
			$(".main_box").show();	
			$("#loader_box").hide();	
			$('#button_holder').show();																						
			$('#store_required_warning').show();
		} else {
			dataString = "store_name=" + store_name + "&store_website=" + store_website + "&store_address=" + store_address + "&store_zip=" + store_zip + "&type=" + business_type;
			$.ajax({
				type: "POST",
				url: "update_profile.php?type=add_store",
				data: dataString,
				success: function(data) {
					//alert(data);
					if (data == "zip_error") {
						$(".main_box").show();	
						$("#loader_box").hide();	
						$('#button_holder').show();																											
						$('#store_zip_warning').show();
					} else {
						window.location = "store.php?ID="+ data;
					}
				}
			});					
		}	
		return false;	
	});
	
	$('#save_changes').click(function() {
		$('#button_holder').hide();
		$(".main_box").hide();	
		$("#loader_box").show();	
		$('#required_fields_warning').hide();
				
		first_name = encodeURIComponent($('#first_name').val().trim());
		last_name = encodeURIComponent($('#last_name').val().trim());
		company = encodeURIComponent($('#company').val().trim());
		position = encodeURIComponent($('#position').val().trim());
		website = $('#website').val().trim();
		photo_setting = $('#photo_setting').val();		
		
		if (first_name.length == 0 || last_name.length == 0 || company.length == 0 || position.length == 0) {
			$(".main_box").show();	
			$("#loader_box").hide();	
			$('#button_holder').show();																						
			$('#required_fields_warning').show();
		} else {
			dataString = "first_name=" + first_name + "&last_name=" + last_name + "&company=" + company + "&position=" + position + "&website=" + website + "&photo_setting=" + photo_setting;
			$.ajax({
				type: "POST",
				url: "update_profile.php?type=employer_details",
				data: dataString,
				success: function(data) {
					//alert(data);
					window.location.reload();
				}
			});					
		}	
		return false;	
	});	

}

function employee_advanced_mobile()	{		
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
			$('#button_holder').hide();
			$(".main_box").hide();	
			$("#loader_box").show();	
			match_setting = $('#email_setting').val();
			dataString = "email_match_setting=" + match_setting;
				$.ajax({
					type: "POST",
					url: "update_profile.php?type=edit_email_match",
					data: dataString,
					success: function(data) {
							//alert(data);
							window.location = "profile.php";
					}
				});			
			return false;			
		});			
		
}	

function employee_video_mobile() {

	$("#save_video").click(function() {
		$('#button_holder').hide();
		$(".main_box").hide();	
		$("#loader_box").show();	
		url = $("#video_url").val();
		alert(url);
		$(".warning").hide();				
		$.embedly.extract(url, {key:'f5b7ea57c3b84df88d4e8d9c6c9acb05'})
		.progress(function(data){
			//alert(data.media.type);
		  if (data.media == undefined || data.provider_name == undefined) {
			$(".main_box").show();	
			$("#loader_box").hide();	
				$('#button_holder').show();																						
			  $('#host_warning').show();			  
		  } else {
			  var type = data.media.type;
			  var host = data.provider_name;
			  //alert(type);
			  //alert(host);
			  switch(host) {
				  case "Instagram":
					if (type == "video") {
						action = "save";
					} else if (type == "photo") {
						action = "wrong_type";
					} else {
						action = "private";
					}
				  break;
				  
				  case "Vine":
					if (type == "video") {
						action = "save";
					} else {
						action = "wrong_type";
					}
				  break;
				  
				  case "YouTube":
					if (type == "video") {
						action = "save";
					} else {
						action = "private";
					}
				  break;	
				  
				  default:
				  	action = "wrong_host";
				  break;		  
			  }
			  alert(action);
			  switch(action) {
				  case "save":
					dataString = "video_url=" + url;
					//alert(dataString);
						$.ajax({
							type: "POST",
							url: "update_profile.php?type=upload_video",
							data: dataString,
							success: function(data) {
									//alert(data);
									window.location = "profile.php";
							}
						});					  
				  break;
				  
				  case "wrong_type":
					$(".main_box").show();	
					$("#loader_box").hide();	
					$('#button_holder').show();																						
					$('#type_warning').show();			  
				  break;
				  
				  case "private":
					$(".main_box").show();	
					$("#loader_box").hide();	
					$('#button_holder').show();																						
					$('#private_warning').show();			  
				  break;	
				  
				  case "wrong_host":
					$(".main_box").show();	
					$("#loader_box").hide();	
					$('#button_holder').show();																						
					 $('#host_warning').show();			  
				  break;			  			  		  			  
			  }
		  }
			return false;			
		});	
	});			
		
}

function photo_functions_mobile() {

			$("#profile_pic_choose").change(function(){
		    input = this;
		   // alert(input.files);
			if (input.files && input.files[0]) {
				if (input.files[0].size > 4000000) {
				   $("#button_holder_photo").show();		   
					$("#loader").hide();	
					$("#loader_box").show();	
				} else if (input.files[0].type == "image/png" || input.files[0].type == "image/jpg" || input.files[0].type == "image/jpeg") {
						//if (window.confirm("Upload image: " + input.files[0].name + "?")) {
							//$("#loader_box").dialog("open");																			
							$("#profile_upload_button").click();
							return false;
/*
						} else {
							window.location.reload();
						}				
*/
				} else {
				   $("#button_holder_photo").show();		   
					$("#loader").hide();	
					$("#file_type_warning").show();	
				}		
			} 	    
		});
		
		$("#bartender_pic_choose").change(function(){
			    input = this;
				if (input.files && input.files[0]) {
					if (input.files[0].size > 4000000) {
					   $("#button_holder_photo").show();		   
						$("#loader").hide();	
					   $("#file_size_warning").show();	
					} else if (input.files[0].type == "image/png" || input.files[0].type == "image/jpg" || input.files[0].type == "image/jpeg") {
/* 							if (window.confirm("Upload image: " + input.files[0].name + "?")) {					 */
								//$("#loader_box").dialog("open");																			
								$("#bartender_upload_button").click();						
								return false;
/*
							} else {
								window.location.reload();
							}				
*/
					} else {
					   $("#button_holder_photo").show();		   
						$("#loader").hide();	
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
		    input = this;
			if (input.files && input.files[0]) {
				if (input.files[0].size > 2000000) {
				   $("#button_holder_photo").show();		   
					$("#loader").hide();	
				   $("#file_size_warning").show();	
				} else if (input.files[0].type == "image/png" || input.files[0].type == "image/jpg" || input.files[0].type == "image/jpeg") {
/* 						if (window.confirm("Upload image: " + input.files[0].name + "?")) {					 */
							//$("#loader_box").dialog("open");																			
							$("#kitchen_upload_button").click();						
							return false;
/*
						} else {
							window.location.reload();
						}				
*/
				} else {
				   $("#button_holder_photo").show();		   
					$("#loader").hide();	
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
			   $("#button_holder_photo").hide();		   
				$("#loader").show();	
			
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
			   $("#button_holder_photo").hide();		   
				$("#loader").show();	
				photoID = $(this).attr("ID");
				//alert(photoID);
				if (window.confirm("Remove profile photo?")) {
					dataString = "photoID=" + photoID;
					$.ajax({
						type: "POST",
						url: "update_profile.php?type=remove_photo",
						data: dataString,
						success: function(data) {
							//alert(data);
							window.location = "profile.php";
						}
					});												
				} else {
				   $("#button_holder_photo").show();		   
					$("#loader").hide();	
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
			window.location.reload();	
		} else {
			//$("#loader_box").dialog("close");		
			status.html(xhr.responseText);
		}
	}
});										
					
			$("#delete_photo").click(function() {
				dataString = "type=profile";
				$(".main_box").hide();	
				$("#loader_box").show();	
				$.ajax({
					type: "POST",
					url: "update_profile.php?type=remove_photo",
					data: dataString,
					success: function(data) {
						//alert(data);
						window.location.reload();
					}
				});					
				return false;
			});																
}	

function profile_employee_other_mobile(profileID, matchID) {

		$(".inappropriate").click(function() {
			$("#inappropriate_form").show();
			$(".inappropriate").hide();
			return false;
		});	
		
		$(".cancel_report").click(function() {
			$("#inappropriate_form").hide();
			$(".inappropriate").show();
			return false;
		});																

		$("#view_questions").click(function() {
			$('#video-holder .video-body').html('');				
			$(".menu_holder").hide();
			$("#profile_holder").hide();
			$("#close_video").hide();																																	
			$("#question_holder").show('fast');
			return false;			
		});

		$("#view_message").click(function() {
			$('#video-holder .video-body').html('');				
			$(".menu_holder").hide();
			$("#profile_holder").hide();	
			$("#close_video").hide();																																																
			$("#message_holder").show('fast');
			return false;			
		});
		
		$("#view_profile").click(function() {
			$('#video-holder .video-body').html('');		
			$(".menu_holder").hide();
			$("#close_video").hide();																																				
			$("#profile_holder").show();																
			return false;			
		});	
		
		$("#highlight").click(function() {
			$(".main_box").hide();	
			$("#loader_box").show();		
			dataString = "matchID=" + matchID + "&highlight=Y";
			//alert(dataString);
				$.ajax({
					type: "POST",
					url: "update_job.php?type=highlight",
					data: dataString,
					success: function(data) {
						//alert(data);
						window.location.reload()
					}
				});					
			return false;
		});		
		
		$("#unhighlight").click(function() {
			$(".main_box").hide();	
			$("#loader_box").show();	
			dataString = "matchID=" + matchID + "&highlight=N";
				$.ajax({
					type: "POST",
					url: "update_job.php?type=highlight",
					data: dataString,
					success: function(data) {
						//$("#loader_box").dialog("open");				
						window.location.reload()
					}
				});					
			return false;
		});														
}

function video_player_mobile(video_url) {
 	$.embedly.defaults.key = 'f5b7ea57c3b84df88d4e8d9c6c9acb05'; 
	$.embedly.defaults.query = { autoplay:true, maxwidth:500}; 
//	$('#video_player a').embedly({key: 'f5b7ea57c3b84df88d4e8d9c6c9acb05'});

			$("#watch_video").click(function() {	
				var height= 200;
				$(".video_button").hide();
				$(".menu_holder").hide();
				$("#profile_holder").hide();
				$("#close_video").show();																	
				$("#video_holder").show();
				 $("#video-loader").show();
				//url = 'http://www.youtube.com/watch?v=vsmUpYIA99o'
				 $.embedly.oembed(video_url).progress(function(data){
				 	$("#video-loader").hide();
				      $('#video-holder .video-header h4').html(data.title);
				      $('#video-holder .video-body').html(data.html);
				    });				
				return false;
			});
			
			$("#close_video").click(function() {
				$('#video-holder .video-body').html('');		
				$('#video_holder').hide();
				$(".video_button").show();
				$("#profile_holder").show();
				$("#close_video").hide();																	
				return false;
			});	
			
			$(".sample_video").click(function() {	
				video_type = $(this).attr('ID');
				if (video_type == 'bartender') {
					sample_url = 'http://www.youtube.com/watch?v=JXvEDTSYiNI'
				}
				var height= 200;
				$(".sample_video").hide();
				$("#close_sample").show();																	
				$("#video_holder").show();
				 $("#video-loader").show();
				 $.embedly.oembed(sample_url).progress(function(data){
				 	$("#video-loader").hide();
				      $('#video-holder .video-header h4').html(data.title);
				      $('#video-holder .video-body').html(data.html);
				    });				
				return false;
			});
			
			$("#close_sample").click(function() {
				$('#video-holder .video-body').html('');		
				$('#video_holder').hide();
				$(".sample_video").show();
				$("#close_sample").hide();																	
				return false;
			});	
			
	$(".remove_video").click(function() {
		videoID = $(this).attr("ID");
		dataString = "videoID=" + videoID;
		//alert("H" + dataString);
		$('#button_holder').hide();
		$(".main_box").hide();	
		$("#loader_box").show();	
		$.ajax({
			type: "POST",
			url: "update_profile.php?type=remove_video",
			data: dataString,
			success: function(data) {
					//alert(data);
					window.location = "profile.php";
			}
		});	
		return false;				  	
	});	
	
		$('.report').click(function() {
				dataString = "jobID=" + profileID + "&type=profile";
				$.ajax({
					type: "POST",
					url: "update_job.php?type=report",
					data: dataString,
					success: function(data) {
						//alert(data);
						window.location.reload();
					}
				});					
		});																	
				
}

function store_details() {

					$("#add_store").click(function() {
						$("#add_store_form").dialog("open");
						return false;
					});	

					$(".delete_store").click(function() {
						//alert("here");
						storeID = $(this).attr('id');					
						$("#delete_store_form").dialog("open");
						return false;
					});						
					
					$(function() {
						$("#add_store_form").dialog({
							autoOpen: false,
							modal: true,
							height: 300,
							width: 450,
							buttons: {
								"Add Store": function() {	
									//alert("here");
									store_name = $('#store_name').attr('value');
									address = $('#address').attr('value');
									zip = $('#zip').attr('value');
									website = $('#store_website').attr('value');
									description = $('#description').attr('value');
									dataString = "name=" + encodeURIComponent(store_name) + "&address=" + encodeURIComponent(address) + "&zip=" + zip + "&description=" + encodeURIComponent(description) + "&website=" + website;
									//alert(dataString);
									if (store_name.length == 0 || address.length == 0 || zip.length == 0) {
										$('#store_empty_warning').show();
									} else if (isNaN(zip) == true || zip.length != 5) {
										$('#store_zip_warning').show();
									} else {
										$("#loader_box").dialog("open");									
										$("#add_store_form").dialog("close");
										$.ajax({
											type: "POST",
											url: "update_profile.php?type=add_store",
											data: dataString,
											success: function(data) {
												if (data == "zip") {
													$("#loader_box").dialog("close");																					
													$('#store_zip_warning').show();													
												} else {
													window.location.reload();
												}
											}
										});
									}					
								}
							}
						});
					});
					
					$(function() {
						$("#delete_store_form").dialog({
							autoOpen: false,
							modal: true,
							height: 250,
							width: 350,
							buttons: {
								"Remove Store": function() {	
									dataString = "storeID=" + storeID;
									//alert(dataString);
									$("#loader_box").dialog("open");									
									$("#delete_store_form").dialog("close");									
									$.ajax({
										type: "POST",
										url: "update_profile.php?type=delete_store",
										data: dataString,
										success: function(data) {
											//alert(data);
											window.location.reload();
										}
									});					
								}
							}
						});
					});	
					
			$(function() {
				$("#loader_box").dialog({
					autoOpen: false,
					modal: true,
					height: 200,
					width: 450
				});
			});																																																				
}	
