function profile_employer(store_array) {
	
	$(".edit").click(function() {	
		$('.main_row').hide();	
		$('.store_details').hide();	
		var input_row = $(this).attr('ID')
		$("."+input_row+"_input").show();
		return false;
	})
	
	$(".cancel").click(function() {	
		$('.input').hide();		
		$('.main_row').show();
		$('.store_details').show();	
		return false;
	})		
	
	$('.save_name').click(function() {
		$('.error').hide();
				
		first_name = encodeURIComponent($('.edit_first_name').val().trim());
		last_name = encodeURIComponent($('.edit_last_name').val().trim());
		
		if (first_name.length == 0 || last_name.length == 0) {
			$('#name_empty_warning').show();
		} else {
			$('.container').hide();			
			$('#loader').show();			
			
			dataString = "first_name=" + first_name + "&last_name=" + last_name;
			//alert(dataString);
			$.when(send_ajax(dataString, "ajax/employer.ajax.php?type=employer_name")).done(function(data){
				window.location.reload();
			});											
		}	
		return false;	
	});	
	
	$('.save_position').click(function() {
		$('.error').hide();
				
		position = encodeURIComponent($('#edit_position').val().trim());
		
		$('.container').hide();			
		$('#loader').show();			
			
		dataString = "position=" + position;
		$.when(send_ajax(dataString, "ajax/employer.ajax.php?type=employer_position")).done(function(data){
			window.location.reload();
		});											
		return false;	
	});	
	
		$(".save_email_edit").click(function() {
			$('.error').hide();
			email = $('#edit_email_holder').val().trim();
			old_email = $('#old_email_holder').val().trim();

			if (email.length == 0) {
				$('#email_empty_warning').show();
				$('#edit_email_holder').addClass('has-error');					
			} else {
				$('.container').hide();
				$('#loader').show();
				dataString = "new_email=" + email + "&old_email=" + old_email;
				
				$.when(send_ajax(dataString, "ajax/employer.ajax.php?type=new_email")).done(function(data){
					if (data == "email") {
						$('#loader').hide();
						$('.container').show();
						$('#non_email_warning').show();
						$('#edit_email_holder').addClass('has-error');	
					} else if (data == "duplicate") {
						$('#loader').hide();
						$('.container').show();
						$('#duplicate_warning_blarg').show();
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
							$('#loader').hide();
							//$('.show').hide();

							if (data == "no") {
								$('.container').show();
								$('#old_pass_warning').show();																	
								$('#new_pass1').removeClass('has-error');					
								$('#new_pass2').removeClass('has-error');					
								$('#old_pass').addClass('has-error');					
							} else {
								$('.container').show();
								$('#loader').hide();

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
		});				
		
	$(".edit_store").click(function() {
		var storeID = $(this).attr('ID');
		$('.main_row').hide();	
		$('.store_details').hide();	
		$("#edit_store_holder_"+storeID).show('fast');	

		return false;
	});	
	
	$(".cancel_edit_store").click(function() {
		$(".edit_store_holder").hide();					
		$('.main_row').show();	
		$('.store_details').show();	
		return false;
	});						
						

	$(".save_store_edit").click(function() {
		var storeID = $(this).attr('ID');

		$(".error").hide();					

		store_name = $('#edit_location_'+storeID).val();
		address = $('#edit_address_'+storeID).val();
		zip = $('#edit_zip_'+storeID).val();
		website = $('#edit_website_'+storeID).val();
		facebook = $('#edit_facebook_'+storeID).val();
		description = $('#edit_description_'+storeID).val();
		dataString = "storeID=" + storeID + "&name=" + encodeURIComponent(store_name) + "&address=" + encodeURIComponent(address) + "&zip=" + zip + "&description=" + encodeURIComponent(description) + "&website=" + website + "&facebook=" + facebook;

		if (store_name.length == 0 || address.length == 0 || zip.length == 0 || description == 0 || description == null) {
			$('#store_required_warning').show();
		} else if (isNaN(zip) == true || zip.length != 5) {
			$('#store_zip_warning').show();
		} else {	
			$('.container').hide();			
			$('#loader').show();			

			$.when(send_ajax(dataString, "ajax/store.ajax.php?type=edit_store")).done(function(data){
				//alert(data);
				if (data == "zip") {
					$('#loader').hide();			
					$('.container').show();			
					$("#store_zip_warning").show();
				} else {
					window.location.reload();
				}
			});											
		}	
	return false;				
});																			
}

function store_photo() {
	$(".store_pic_choose").change(function(){
	    input = this;
	    storeID = $(this).data("store_id");

		if (input.files && input.files[0]) {
			if (input.files[0].size > 5000000) {
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
				$('#file_type_warning').show();				
				//alert("File must be a JPEG or PNG image file");
			}		
		} 	    
	});
	
	$(".edit_photo").click(function() {			
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
	    storeID = $(this).data("store_id");
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


function add_store(new_user) {

	$('.add_store').click(function() {
		//alert("here");
		$('#store_required_warning').hide();
		$('#store_zip_warning').hide();	
		
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
		twitter = $('#twitter').val().trim();
		store_address = encodeURIComponent($('#address').val().trim());
		store_zip = $('#zip').val().trim();
		business_type = $('#description').val();
		
		if (store_name.length == 0 || store_address.length == 0 || store_zip.length == 0 || business_type == 0 || business_type == null) {
			//alert("here");
			$('#store_required_warning').show();
		} else {
			$(".main_box").hide();
			dataString = "store_name=" + store_name + "&store_website=" + store_website + "&store_address=" + store_address + "&store_zip=" + store_zip + "&type=" + business_type + "&facebook=" + facebook + "&twitter=" + twitter  + "&position=" + position;
			//alert(dataString);
			$.when(send_ajax(dataString, "ajax/store.ajax.php?type=add_store", "full")).done(function(data){
				//alert(data);
				if (data == "zip_error") {
					$(".main_box").show();
					$('#store_zip_warning').show();
					$("#loader_box").dialog("close");																								
				} else {
					$("#loader_box").dialog("close");																													
					if (destination == 'post') {
						window.location = "job.php?ID=new_job&storeID="+ data;							
					} else {
						window.location = "main.php";														
					}
				}
			});											
			
		}	
		return false;	
	});
}


function employer_account_switch() {

		$("#change_account_type").click(function() {
			$(".warning").hide();
			//$('#loader').show();

			var zip = $('#zip').val();
			dataString = "zip=" + zip ;
			if (isNaN(zip) == true || zip.length != 5 || zip == "") {
				//$('#loader').hide();
				$('#bad_zip_warning').show();
			} else {
				//alert("here");
				$.when(send_ajax(dataString, "ajax/employer.ajax.php?type=switch_account_type")).done(function(data){
					 if (data == "zip") {
						$('#loader').hide();
						$('#bad_zip_warning').show();
					} else if (data == "job") {									
						$('#loader').hide();
						$('#job_warning').show();
					} else {
						window.location = "employee.php?page=new_splash";
					}
				});																						
			}
			return false;					
		});		
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