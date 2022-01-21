function garage() {
	
		$(".edit_item").click(function() {	
			var itemID = $(this).attr('ID');
			//window.location = "project.php?id=" + projectID;
		})
	
		$("#add_item_button").click(function() {	
			$('.item_row').hide();		
			$('#add_item_button').hide();		
			$("#new_item_holder").show();					
			return false;
		})
	
		$("#cancel_new_item").click(function() {	
			$("#new_item_holder").hide();		
			$('.item_row').show();		
			$('#add_project_button').show();		
			return false;
		})		
		
		$("#save_new_item").click(function() {
			$('.error').hide();

			item_name = $('#item_name').val().trim();
			description = $('#new_description').val().trim();
			type = $('.new_item_category').val();

			if (item_name.length == 0) {
				$('#new_item_empty_warning').show();
				$('#new_item_form').addClass('has-error');					
			} else {
				$('.container').hide();			
				$('#loader').show();			
				dataString = "item_name=" + encodeURIComponent(item_name) + "&description=" + encodeURIComponent(description) + "&type=" + encodeURIComponent(type);
				alert(dataString);
				$.when(send_ajax(dataString, "ajax/item.ajax.php?type=add_item")).done(function(data){
					alert(data);
					window.location = "item.php?id=" + data + "&page=edit_photos";
				});																						
			}					
			return false;					
		});	
		
}