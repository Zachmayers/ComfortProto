function index_full() {

$(document).on('click', '#learn_button', function(event){
    event.preventDefault();

    $('html, body').animate({
        scrollTop: $("#learn").offset().top
    }, 800);
});

	//Make the enter key work to click login and signup
	$("#login-form").keyup(function (e) {
		  if (e.which == 13) {
			    $('#login_button').trigger('click');
			    return false;
		  }
	 });
	 
	$("#employee-form").keyup(function (e) {
		  if (e.which == 13) {
			    $('#employee_signup').trigger('click');
			    return false;
		  }
	 });	
	 	
	$("#employer-form").keyup(function (e) {
		  if (e.which == 13) {
			    $('#employer_signup').trigger('click');
			    return false;
		  }
	 });	
	 
	$("#wrong_email").click(function(evt) {
			evt.stopImmediatePropagation();		
			$("#complete_page").hide();
			$('#email_change_holder').show();	
			return false;
	});
	
	$("#wrong_email_back").click(function(evt) {
			evt.stopImmediatePropagation();		
			$('#email_change_holder').hide();	
			$("#complete_page").show();
			return false;
	});	
	
	$(".login_now").click(function(evt) {
			evt.stopImmediatePropagation();	
			type = $(this).attr('ID');	
			$(".login_now").hide();
			$("#loader").show();
						
			if (type == "employer") {
				window.location = "main.php";
			} else if (type == "employee") {
				window.location = "employee.php?page=new_splash";									
			} else {
				window.location = "index.php?page=login";	
			}
			return false;
	});	
	
	

	$("#submit_new_email").click(function(evt) {
			evt.stopImmediatePropagation();		
			$(".warning").hide();

			$('.email_button').hide();							
			$('#loader').show();	
			
			old_email = $('#old_email').val();
			new_email = $('#new_email').val();
			type = $('#type').val();

			if (type == "employer") {
				url = "ajax/employer.ajax.php?type=change_email";
			} else if (type == "employee") {
				url = "ajax/employee.ajax.php?type=change_email";
			}
			
			if (type == "employer" || type == "employee") {
			dataString = "new_email=" + new_email + "&old_email=" + old_email;
			//alert(dataString);
			if (new_email.length == 0) {
				$('#loader').hide();	
				$('.email_button').show();							
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
							$('#loader').hide();	
							$('.email_button').show();							
							$('#employer_email_warning').show();
							window.scrollTo(0, 0);
						} else if (data == "duplicate") {
							$('#loader').hide();	
							$('.email_button').show();							
							$('#employer_duplicate_warning').show();
							window.scrollTo(0, 0);
						} else if (data == "yes") {
							//Take to page
							window.location = 'index.php?page=complete'
						} 
					}
				});
			}
		} else {
			$('#loader').hide();	
			$('.email_button').show();										
			$('#general_warning').show();
		}
		return false;
	});						 		
	
	$("#logout").click(function() {
		$.ajax({
			type: "POST",
			url: "lgout.php",
			success: function(data) {
				//alert("logout");
				window.location = "http://google.com";
			}
		});	
		return false;
	});		
		
	$("#forgot_password_send").click(function() {
			$("#forgot_password_send").hide();
			$("#forgot_pass_form").hide();										
			$("#pass_loader").show();	
			email = $("#retrieve_password").val();
			dataString = "email=" + email;
			$.ajax({
				type: "POST",
				url: "ajax/verification.ajax.php?type=forgot_password",
				data: dataString,
				success: function(data) {
					//alert(data);
					if (data == "yes" || data == "email_validation") {
						$('#wrong_email').hide();	
						$("#pass_loader").hide();											
						$("#password_reset").show();													
					} else if (data == "no") {
						$("#forgot_pass_form").show();
						$("#pass_loader").hide();					
						$('#wrong_email').show();		
						$("#forgot_password_send").show();												
					} else if (data == "deactivate") {
						$("#forgot_pass_form").show();
						$("#pass_loader").hide();					
						$('#deactivate').show();		
						$("#forgot_password_send").show();																		
					} else {
						$('#wrong_email').hide();	
						$("#pass_loader").hide();											
						$("#forgot_pass_form").show();
						$("#pass_error_warning").show();																			
					}
				}
			});			
		return false;		
	});	
	
	$("#login_button").click(function() {
		$('.warning').hide();	

		user = $('#user_login').val();
		pass = $('#pass_login').val();
		var jobID = $('#jobID').val();
		var public_hash = $('#public_hash').val();
		var type = $('#type').val();
		dataString = "user=" + user + "&pass=" + encodeURIComponent(pass) + "&jobID=" + jobID + "&public_hash=" + public_hash + "&type=" + type;
		//alert(dataString);							
		$("#delay_holder").empty();					
		$('#login_button').hide();		
		$('#fb_holder').hide();						
		$('#loader').show();	
		//alert(dataString);	
		$.ajax({
			type: "POST",
			url: "ajax/verification.ajax.php?type=login",
			data: dataString,
			success: function(data) {
				if (data == "false") {
					$('#loader').hide();
					$('#invalid_login').show();	
					$('#login_button').show();		
					$('#fb_holder').show();																			
				} else if (data == "deactivate") {
					$('#loader').hide();
					$('#deactivation_warning').show();	
					$('#login_button').show();																																			
					$('#fb_holder').show();																			
				} else if (data == "complete") {			
					window.location = "main.php";
				} else if ($.isNumeric(data)) {
					//code changed on update.  No longer do users have to actively click "Finalize Profile" to change profile status to complete (button no longer exists, profile set to complete as soon as past employment is added)
					//Therefore, some users may have enough information to have a complete profile, though never clicked the button previously,
					//test to see if user has enough details to qualify as "complete", if so, change status in background

					$.when(send_ajax("none", "ajax/main.ajax.php?type=check_profile_status", 'none')).done(function(new_data){
						window.location = "opportunity.php?ID=" + data + "&hash=" + public_hash;					
					});														
				} else if (data == "profile") {
					//code changed on update.  No longer do users have to actively click "Finalize Profile" to change profile status to complete (button no longer exists, profile set to complete as soon as past employment is added)
					//Therefore, some users may have enough information to have a complete profile, though never clicked the button previously,
					//test to see if user has enough details to qualify as "complete", if so, change status in background

					$.when(send_ajax("none", "ajax/main.ajax.php?type=check_profile_status", 'none')).done(function(new_data){
						if (new_data == "complete") {
							window.location = "main.php";							
						} else {
							window.location = "employee.php";							
						}
					});																			
				} else {
					$("#delay_holder").replaceWith(data);	
					$('#loader').hide();
					$('#invalid_login').hide();	
					$('#login_button').show();																										
					$('#fb_holder').show();																			
				}
			}
		});		
		return false;			
	});
			
	$("#signup_client").unbind('click').click(function() {	
			//alert("here");
			$(".warning").hide();
			$('#signup_employer').hide();
			$('#loader').show();

			var permission = "Y";
			var access = $('#access_2').val();
			var first = $('#firstname').val().trim();
			var last = $('#lastname').val();
			var login_email = $('#login_email').val();
			var set_password = $('#set_password').val();
//			var signup_track = $('#signup_track').val();
			var phone = $('#phone').val().trim();
			var provider = 'N';
			
			dataString = "access=" + access + "&first=" + encodeURIComponent(first) + "&last=" + encodeURIComponent(last)
								+ "&login=" + login_email + "&pass=" + encodeURIComponent(set_password) + "&phone=" + phone + "&provider=" + provider;
			//alert(dataString);
			if (access.length == 0 || first.length == 0 || last.length == 0 ||  login_email.length == 0 || set_password.length == 0) {
				$('#loader').hide();
				$('#signup_employer').show();
				$('#employer_empty_warning').show();
				//alert("1")
				window.scrollTo(0, 0);
			} else if (set_password.length > 12 || set_password.length < 6) {
				$('#loader').hide();
				$('#signup_employer').show();
				$('#employer_pass_warning').show();
				window.scrollTo(0, 0);
				//alert("5")
			} else {
				//alert("44")
				$.ajax({
					type: "POST",
					url: "ajax/verification.ajax.php?type=register_user",
					data: dataString,
					success: function(data) {
						
						if (data == "access") {
							$('#loader').hide();
							$('#signup_employer').show();
							$('#employer_access_warning').show();
							window.scrollTo(0, 0);
						} else if (data == "email") {
							$('#loader').hide();
							$('#signup_employer').show();
							$('#employer_email_warning').show();
							window.scrollTo(0, 0);
						} else if (data == "duplicate") {
							$('#loader').hide();
							$('#signup_employer').show();
							$('#employer_duplicate_warning').show();
							window.scrollTo(0, 0);
						} else if (data == "yes") {
							//$('#loader').hide();
							//window.location = 'index.php?page=complete'
							window.location = "main.php";
						} else {
							$('#loader').hide();
							$('#signup_employer').show();
							$('#employer_error').show();							
							window.scrollTo(0, 0);
						}
					}
				});
			}		
		return false;			
	});
	
	
	$("#signup_provider").unbind('click').click(function() {	
			//alert("here");
			$(".warning").hide();
			$('#signup_employer').hide();
			$('#loader').show();

			var permission = "Y";
			var access = $('#access_2').val();
			var first = $('#firstname').val().trim();
			var last = $('#lastname').val();
			var login_email = $('#login_email').val();
			var set_password = $('#set_password').val();
//			var signup_track = $('#signup_track').val();
			var phone = $('#phone').val().trim();
			var provider = 'Y';
			
			dataString = "access=" + access + "&first=" + encodeURIComponent(first) + "&last=" + encodeURIComponent(last)
								+ "&login=" + login_email + "&pass=" + encodeURIComponent(set_password) + "&phone=" + phone + "&provider=" + provider;
			//alert(dataString);
			if (access.length == 0 || first.length == 0 || last.length == 0 ||  login_email.length == 0 || set_password.length == 0) {
				$('#loader').hide();
				$('#signup_employer').show();
				$('#employer_empty_warning').show();
				//alert("1")
				window.scrollTo(0, 0);
			} else if (set_password.length > 12 || set_password.length < 6) {
				$('#loader').hide();
				$('#signup_employer').show();
				$('#employer_pass_warning').show();
				window.scrollTo(0, 0);
				//alert("5")
			} else {
				//alert("44")
				$.ajax({
					type: "POST",
					url: "ajax/verification.ajax.php?type=register_user",
					data: dataString,
					success: function(data) {
						
						if (data == "access") {
							$('#loader').hide();
							$('#signup_employer').show();
							$('#employer_access_warning').show();
							window.scrollTo(0, 0);
						} else if (data == "email") {
							$('#loader').hide();
							$('#signup_employer').show();
							$('#employer_email_warning').show();
							window.scrollTo(0, 0);
						} else if (data == "duplicate") {
							$('#loader').hide();
							$('#signup_employer').show();
							$('#employer_duplicate_warning').show();
							window.scrollTo(0, 0);
						} else if (data == "yes") {
							//$('#loader').hide();
							//window.location = 'index.php?page=complete'
							window.location = "main.php";
						} else {
							$('#loader').hide();
							$('#signup_employer').show();
							$('#employer_error').show();							
							window.scrollTo(0, 0);
						}
					}
				});
			}		
		return false;			
	}	)
	
	$("#signup_provider_old").unbind('click').click(function() {
			alert("here");
			$(".warning").hide();
			$('#employee_signup').hide();
			$('#loader').show();
			if ($('#age').is(":checked")) {
				var age = "Y";
			} else {
				var age = "N";
			}
			
			var access = $('#access_2').val().trim();
			var first = $('#firstname_2').val().trim();
			var last = $('#lastname_2').val().trim();
			
			var zip = $('#zip').val().trim();
			var login_email = $('#login_email_2').val().trim();
			var set_password = $('#set_password_2').val().trim();
			dataString = "access=" + access + "&first=" + encodeURIComponent(first) + "&last=" + encodeURIComponent(last) + 
								"&zip=" + zip + "&login="  + login_email + "&pass=" + encodeURIComponent(set_password) + "&phone=" + phone + "&provider=Y";
			if (access.length == 0 || first.length == 0 || last.length == 0 || zip.length == 0 || login_email.length == 0 || set_password.length == 0) {
				$('#loader').hide();
				$('#employee_signup').show();
				$('#employee_empty_warning').show();
 				window.scrollTo(0, 0);
			} else if (set_password.length > 12 || set_password.length < 6) {
				$('#loader').hide();
				$('#employee_signup').show();			
				$('#employee_pass_warning').show();
				window.scrollTo(0, 0);
			} else if (age == "N") {
				$('#loader').hide();
				$('#employee_signup').show();			
				$("#age_warning").show();																																																						
				window.scrollTo(0, 0);
			} else {
				$.ajax({
					type: "POST",
					url: "ajax/verification.ajax.php?type=register_user",
					data: dataString,
					success: function(data) {
						//alert(data);
						if (data == "access") {
							$('#loader').hide();
							$('#employee_signup').show();
							$('#employee_access_warning').show();
							window.scrollTo(0, 0);
						} else if (data == "email") {
							$('#loader').hide();
							$('#employee_signup').show();
							$('#employee_email_warning').show();
							window.scrollTo(0, 0);
						}  else if (data == "duplicate") {
							$('#loader').hide();
							$('#employee_signup').show();
							$('#employee_duplicate_warning').show();
							window.scrollTo(0, 0);
						}  else if (data == "zip") {
							$('#loader').hide();
							$('#employee_signup').show();
							$('#employee_invalid_zip_warning').show();									
							window.scrollTo(0, 0);
						} else if (data == "yes") {
							window.location = "main.php";				

							//window.location = 'index.php?page=complete'
						} else {
							$('#loader').hide();
							$('#employee_signup').show();
							$('#employee_error').show();														
							window.scrollTo(0, 0);
						}
					}
				});	
			}		
		return false;		
	});
	
	
		$("#verification_send").click(function() {
			$("#verification_send").hide();
			$("#resend_form").hide();										
			$("#verification_loader").show();				
			email = $("#email_verify").val();
			dataString = "email=" + email;
			$.ajax({
				type: "POST",
				url: "ajax/verification.ajax.php?type=email_verify",
				data: dataString,
				success: function(data) {
					//alert(data);
					if (data == "Y") {
						$('#bad_email').hide();	
						$("#verification_loader").hide();																								
						$('#verification_sent').show();
					} else if (data == "deactivate") {
						$('#deactivation_warning').show();
						$("#verification_send").show();
						$("#resend_form").show();	
						$("#verification_loader").hide();																																																										
					} else if (data == "N") {
						$('#bad_email').show();
						$("#verification_send").show();
						$("#resend_form").show();
						$("#verification_loader").hide();																																																						
					} else {
						$('#bad_email').hide();	
						$("#verification_loader").hide();																								
						$('#error').show();						
					}
				}
			});			
			return false;		
		});
		
	$("#get_started").click(function() {
		$('.get_started').hide();	
		$('.blargier').hide();	
		$(".selection").show();	
		return false;																							
	})		
	
	$(".get_started_low").click(function() {
		window.scrollTo(0, 0);
		$('.get_started').hide();	
		$('.blargier').hide();	
		$(".selection").show();	
		return false;																							
	})				
			
}


function facebook_login(type, jobID, refID, CMP, RGN, STE, DMG, AD, MSCA, MSCB, public_hash) {

	$("#fb_login").click(function() {
		//evt.stopImmediatePropagation();	
		stupid_function_2();	
	  return false;
  });
  
  function stupid_function() {
	  	$('.buttons').hide();		
		$('#signup-buttons').hide();																																	
		$('#main_loader').show();																																			
		$('.warning').hide();																																			
		$('#login_button').hide();					
		$('#fb_login').hide();	
		//alert("test");				
	    FB.getLoginStatus(function(response) {
	        if (response.status === 'connected') {
	            get_user_details();
	         } else {
		         //mobile requires this to be a separate function
		         stupid_function_2();
	          }
	    });	  
  }
  
    function stupid_function_2() {
		  	$('.buttons').hide();		
			$('#signup-buttons').hide();																																	
			$('#main_loader').show();																																			
			$('.warning').hide();																																			
			$('#login_button').hide();					
			$('#fb_login').hide();	

				FB.login(function(response) {
				    if (response.status === 'connected') {
				      // Logged into app and Facebook.
					   get_user_details();
				    } else if (response.status === 'not_authorized') {
						$('.buttons').show();																																			
						$('#main_loader').hide();																																			
						$('#login_button').show();					
						$('#fb_login').show();
						$('#signup-buttons').show();																																												
					}					
				}, {scope: 'public_profile,email'});
  }

  
  function get_user_details() {
		FB.api('/me', {fields: 'id, email, first_name, last_name'}, function(response) {
		    	//alert(JSON.stringify(response));
		    	all_data = JSON.stringify(response);
		    
				//check if user allowed his email address to be given in FB permission
				if (response.email === undefined || response.email === null) {
					email = "";
				} else {
			    	var email = response.email;					
				}
		    	var fb_ID = response.id;
		    	var first_name = response.first_name;
		    	var last_name = response.last_name;
		    	
		    	//alert(email);
		    	//alert(fb_ID);
		    		
				dataString = "email=" + email + "&fb_ID=" + fb_ID + "&public_hash=" + public_hash + "&jobID=" + jobID + "&firstname=" + first_name + "&lastname=" + last_name;
				//alert(dataString);
				$.when(send_ajax(dataString, "ajax/verification.ajax.php?type=facebook_test", '')).done(function(data){
					//alert(data);
					if (data == "login") {
						dataString = "email=" + email + "&fb_ID=" + fb_ID + "&public_hash=" + public_hash + "&jobID=" + jobID;						
						$.when(send_ajax(dataString, "ajax/verification.ajax.php?type=facebook_login", '')).done(function(data){
							//route to proper page after login	
							//alert(data);
							if (data == "deactivate") {
								$('#main_loader').hide();
								$('#fb_deactivation_warning').show();	
								$('#fb_login').show();													
								$('#login_button').show();					
								$('.buttons').show();	
								$('#signup-buttons').show();																																																																		
							} else if (data == "complete") {			
								window.location = "main.php";
							} else if ($.isNumeric(data)) {
								window.location = "opportunity.php?ID=" + data + "&hash=" + public_hash;						
							} else if (data == "profile") {
								//code changed on update.  No longer do users have to actively click "Finalize Profile" to change profile status to complete (button no longer exists, profile set to complete as soon as past employment is added)
								//Therefore, some users may have enough information to have a complete profile, though never clicked the button previously,
								//test to see if user has enough details to qualify as "complete", if so, change status in background
			
								$.when(send_ajax("none", "ajax/main.ajax.php?type=check_profile_status", 'none')).done(function(new_data){
									if (new_data == "complete") {
										window.location = "main.php";							
									} else {
										window.location = "employee.php";							
									}
								});																			
							} else {
								$('#main_loader').hide();
								$('#fb_error_warning').show();	
								$('.buttons').show();		
								$('#login_button').show();					
								$('#fb_login').show();	
								$('#signup-buttons').show();																																																																													
							}							
						})		
					} else if (data == "register") {
						//show registration page
						window.location = "index.php?page=fb_signup";
					} else {
						//error reporting
					}
				});																	
		    	
		});
	}

	$(".fb_signup").click(function(evt) {
		//evt.stopImmediatePropagation();		
		$('.warning').hide();					
		$('.fb_signup_holder').hide();					
		$('#main_loader').show();					
		
		access = "catscradle";
		first = $('#firstname').val();
		last = $('#lastname').val();
		zip = $('#zip').val().trim();
		login_email = $('#email').val();
		fb_ID = $('#fb_ID').val();
		user_type = $(this).attr('id');
		dataString = "access=" + access + "&user_type=" + user_type + "&firstname=" + encodeURIComponent(first) + "&lastname=" + encodeURIComponent(last) + "&fb_ID=" + fb_ID
								+ "&email=" + login_email + "&zip=" + zip + "&jobID=" + jobID + "&refID=" + refID + "&CMP=" + CMP + "&RGN=" + RGN + "&DMG=" + DMG + "&STE="
								 + STE + "&AD=" + AD + "&MSCA=" + MSCA + "&MSCB=" + MSCB;
		//alert(dataString);
			if (first.length == 0 || last.length == 0 || login_email.length == 0) {
				$('#main_loader').hide();	
				$('.fb_signup_holder').show();													
				$('#fb_empty_warning').show();
				window.scrollTo(0, 0);
			} else if (isNaN(zip) == true || zip.length != 5) {
				$('#main_loader').hide();	
				$('.fb_signup_holder').show();													
				$('#fb_zip_warning').show();
				window.scrollTo(0, 0);				
			} else {
				$.when(send_ajax(dataString, "ajax/verification.ajax.php?type=facebook_register", 'NA')).done(function(data){	
						//alert(data);
						if (data == "email") {
							$('#main_loader').hide();	
							$('.fb_signup_holder').show();													
							$('#fb_email_warning').show();
							window.scrollTo(0, 0);
						} else if (data == "duplicate") {
							$('#main_loader').hide();	
							$('.fb_signup_holder').show();													
							$('#fb_duplicate_warning').show();
							window.scrollTo(0, 0);
						}  else if (data == "zip") {
							$('#main_loader').hide();	
							$('.fb_signup_holder').show();													
							$('#fb_invalid_zip_warning').show();
							window.scrollTo(0, 0);													
						} else if (data == "yes") {
							window.location = 'index.php?page=complete'
						} else {
							$('#main_loader').hide();	
							$('.fb_signup_holder').show();													
							$('#fb_error').show();							
							window.scrollTo(0, 0);
						}
				});
		}	
		return false;	
	});
	
	
	$("#fb_connect").click(function(evt) {
		evt.stopImmediatePropagation();		
		$('#email_form').hide();
		$('.warning').hide();
		$('#main_loader').show();		
		fb_ID = $('#fb_ID').val();
		email = $('#connect_email').val().trim();
		password = $('#connect_pass').val().trim();

		//alert(email.length)
		if (email.length == 0 || password.length == 0) {
			$('#empty_warning').show();			
			$('#email_form').show();
			$('#main_loader').hide();		
		} else {
			dataString = "email=" + email + "&password=" + password + "&fb_ID=" + fb_ID;
			//alert(dataString);
			$.when(send_ajax(dataString, "ajax/verification.ajax.php?type=facebook_connect", "NA")).done(function(data){	
				//alert(data);
				if (data == 'false') {
					$('#invalid_login').show();
					$('#email_form').show();
					$('#main_loader').hide();		
				} else if (data == "deactivate") {
					$('#deactivation_warning').show();
					$('#email_form').show();
					$('#main_loader').hide();		
				} else if (data == "duplicate") {
					$('#duplicate_warning').show();				
					$('#email_form').show();
					$('#main_loader').hide();		
				} else {
					$('#final_text').show();	
					$('#main_loader').hide();		
				}
			})												
		}
		return false;
	});
}

function change_password(ID, token) {
	
		$(document).on("click", '#change_password', function() {					
			$('.warning').hide();	
			$('#new_pass_warning').hide();
			$('#pass_length_warning').hide();							
			$('#old_pass_warning').hide();																	

			new_pass1 = $('#new_pass1').val();
			new_pass2 = $('#new_pass2').val();	
			if (new_pass1 == new_pass2) {
				if (new_pass1.length < 6 || new_pass1.length > 12) {
					$('#pass_length_warning').show();							
				} else {		
					dataString = "new_pass=" + encodeURIComponent(new_pass1) + "&ID=" + ID + "&token=" + token;

					//alert(dataString);
					$("#pass_change_form").hide();
					$("#pass_loader").show();
					$.ajax({
						type: "POST",
						url: "ajax/verification.ajax.php?type=change_password",
						data: dataString,
						success: function(data) {
							//alert(data);
							if (data == "no") {
								$('#invalid_warning').show();																									
								$("#pass_change_form").show();
								$("#pass_loader").hide();
							} else if (data == "invalid") {
								$('#invalid_warning').show();																									
								$("#pass_loader").hide();
							} else if (data == "deactivate") {
								$('#deactivate_warning').show();																									
								$("#pass_change_form").hide();
								$("#pass_loader").hide();
							} else if (data == "email_validation") {
								$("#pass_change_form").hide();
								$('#verification_warning').show();																									
								$("#pass_loader").hide();
							} else if (data == "yes") {
								$("#pass_loader").hide();
								$("#pass_change_form").hide();
								$("#pass_change_success").show();																		
							} else {
								$("#pass_change_form").hide();
								$('#error').show();																									
								$("#pass_loader").hide();								
							}
						}
					});	
				}
			} else {
				$('#new_pass_warning').show();
			}
			return false;				
		})		
}


function mysql_test() {
		dataString = "step=test";
				$.ajax({
					type: "POST",
					url: "ajax/verification.ajax.php?type=mysql_test",
					data: dataString,
					success: function(data) {
						//alert(data);
						if (data != "1") {
							$("#server_warning").show();	
							//send email to admin	
							dataString = "step=email";		
							//alert(dataString);												
								$.ajax({
									type: "POST",
									url: "ajax/verification.ajax.php?type=mysql_test",
									data: dataString,
									success: function(data) {
										//alert(data);
									}
								});	
						} 																
					}
				});	
	
}