function message(tradeID, receiverID) {

	$(document).on("click", '.add_message', function() {	
		message_text = $('#new_message').val().trim();
		dataString = "tradeID="+tradeID+"&receiverID="+receiverID+"&message_text="+message_text;	
		alert(dataString);
		$.when(send_ajax(dataString, "ajax/message.ajax.php?type=add_message", "full")).done(function(data){
			alert(data);
		});							
		return false;
		
	})

}