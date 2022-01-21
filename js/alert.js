
function check_for_message_alert() {
	setInterval(function() {
		if($('#message_alert').is(":hidden")) {
				dataString = "message" ;
			$.when(send_ajax(dataString, "ajax/moment.ajax.php?type=check_message_alert", "NA")).done(function(data){
				//alert(data);
				if (data == "true") {
					
					 $('#message_alert').show();
				}
			});
		}
		
	}, 5000)
}

