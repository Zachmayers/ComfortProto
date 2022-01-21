function send_ajax(dataString, url) {
	//Since there are so many ajax calls, this is a general function to handle all those calls and throw back a result or error
	
	//make sure both dataString and url exist
	if (dataString.length > 0 && url.length > 0) {
		//determine which loader to show based on full or mobile site
		//alert(dataString);
/*
		switch(type) {
			case "full":
				//alert("here");
					$("#loader_box").dialog({
						autoOpen: false,
						modal: true,
						height: 200,
						width: 450
					});
				
				$("#loader_box").dialog("open");
				$("#refresh_warning").show();				
			break;
			
			case "mobile":
				$("#loader_box").show();				
			break;
			
			case "none":
				//nothing happens here		
			break;

		}
*/
				
		return $.ajax({
					type: "POST",
					url: url,
					data: dataString,
					success: function(data) {
						//alert(data);
					}
				});			
	}															
}