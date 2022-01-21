function member(userID) {

	$(document).on("click", '.add_tokens', function() {
			dataString = "number=10";
			//alert(dataString);
			$.when(send_ajax(dataString, "ajax/member.ajax.php?type=add_tokens")).done(function(data){
				alert(data);
				window.location = reload();
			});
			
			return false;
	});
	
	$(document).on("click", '#edit_nickname', function() {
		$('.profile').hide();			
		$('.edit_nickname_form').show();			
		return false;
	});

	$(document).on("click", '#cancel_nickname_edit', function() {
		$('.edit_nickname_form').hide();			
		$('.profile').show();			
		return false;
	});
	
	$(document).on("click", '#save_nickname_edit', function() {
			$(".warning").hide();

			var nickname = $('#nickname').val().trim();
			
			dataString = "nickname=" + encodeURIComponent(nickname);
			alert(dataString);

			if (nickname.length == 0) {
				$('#loader').hide();
				$('#empty_warning').show();
 				window.scrollTo(0, 0);
 			} else {
				$.when(send_ajax(dataString, "ajax/member.ajax.php?type=edit_nickname")).done(function(data){
					alert(data);
					if (data == "duplicate") {
						$('#loader').hide();
						$('#duplicate_display_warning').show();
						window.scrollTo(0, 0);							
					} else {
						window.location = reload();
					}
				});
 			}
			
			return false;
	});
	

	$(document).on("click", '#edit_name', function() {
		$('.profile').hide();			
		$('.edit_name_form').show();			
		return false;
	});

	$(document).on("click", '#cancel_name_edit', function() {
		$('.edit_name_form').hide();			
		$('.profile').show();			
		return false;
	});
	
	$(document).on("click", '#save_name_edit', function() {
			$(".warning").hide();

			var firstname = $('#firstname').val().trim();
			var lastname = $('#lastname').val().trim();
			
			dataString = "firstname=" + encodeURIComponent(firstname) + "&lastname=" + encodeURIComponent(lastname);
			alert(dataString);

			if (nickname.length == 0) {
				$('#loader').hide();
				$('#empty_warning').show();
 				window.scrollTo(0, 0);
 			} else {
				$.when(send_ajax(dataString, "ajax/member.ajax.php?type=edit_name")).done(function(data){
					alert(data);
					window.location = reload();
				});
 			}
			
			return false;
	});
	
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