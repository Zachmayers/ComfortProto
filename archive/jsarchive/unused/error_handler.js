function error_handler(div_id) {
	//Check input data for errors based on expected data, throw result or error
	//If there is an error, show error div based on ID of input
	
	var error_count = 0;
	
	//loop through inputs based on div ID
	//make sure data exists
	if (div_id.length > 0) {
	
		$("#"+div_id+" input").each(function() {}
			type = $(this).data("input_type");
			switch(type) {
				case "required":
					if (data.length == 0) {
						error_result = false;
					} else {
						error_result = true;
					}																								
				break;
				
				case "numeric":
					if (data.length == 0 || isNaN(data)) {
						error_result = false;
					} else {
						error_result = true;
					}																										
				break;
				
				case "zip":
					if (data.length != 0 || isNaN(data)) {
						error_result = false;
					} else {
						error_result = true;
					}																										
				break;			
			}
		
			if (error_result == false) {
				error_count++;
				$('#error_holder_' + div_id + '').show();		
			}	
	}
	return error_count;
}