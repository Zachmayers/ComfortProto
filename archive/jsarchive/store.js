function store(storeID) {

		$("#edit_store_show").click(function() {
			$(".store_details").hide();
			$("#edit_store_form").show("fast");
			return false;
		});	
					
		$("#cancel_store_edit").click(function() {
			$("#edit_store_form").hide();					
			$(".store_details").show('fast');
			return false;
		});						
					
		$("#current").click(function() {
			current_class = $('#current_tab').attr('class');
			
			if (current_class == "unselected_tab") {
				$('#current_tab').removeClass('unselected_tab');
				$('#current_tab').addClass('selected_tab');
				$('#archive_tab').removeClass('selected_tab');
				$('#archive_tab').addClass('unselected_tab');							
			}
			
			$(".current_jobs").show();
			$(".archive_jobs").hide();
			return false;
		});	
		
		$("#archive").click(function() {					
			current_class = $('#archive_tab').attr('class');
			//alert(current_class);	
			if (current_class == "unselected_tab") {
				$('#current_tab').addClass('unselected_tab');
				$('#current_tab').removeClass('selected_tab');
				$('#archive_tab').addClass('selected_tab');
				$('#archive_tab').removeClass('unselected_tab');							
			}
			
			$(".archive_jobs").show();
			$(".current_jobs").hide();
			return false;
		});																																																																		


		$("#edit_store").click(function() {
			store_name = $('#store_name').val();
			address = $('#address').val();
			zip = $('#zip').val();
			website = $('#website').val();
			description = $('#description').val();
			dataString = "storeID=" + storeID + "&name=" + encodeURIComponent(store_name) + "&address=" + encodeURIComponent(address) + "&zip=" + zip + "&description=" + encodeURIComponent(description) + "&website=" + website;
			//alert(dataString);
			if (store_name.length == 0 || address.length == 0 || zip.length == 0) {
				$('#store_empty_warning').show();
			} else if (isNaN(zip) == true || zip.length != 5) {
				$('#store_zip_warning').show();
			} else {	
				$("#loader_box").dialog("open");									
				$.ajax({
					type: "POST",
					url: "ajax/store.ajax.php?type=edit_store",
					data: dataString,
					success: function(data) {
						//alert(data);
						if (data == "zip") {
							$("#loader_box").dialog("close");									
							$("#store_zip_warning").show();
						} else {
							window.location.reload();
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
};

function store_mobile(storeID) {

		$("#edit_store_show").click(function() {
			$(".store_details_holder").hide();
			$("#edit_store_form").show("fast");
			//alert("here");
			return false;
		});	
		
		$("#cancel_store_edit").click(function() {
			$("#edit_store_form").hide();					
			$(".store_details_holder").show('fast');
			return false;
		});						
		
		$("#current").click(function() {
			current_class = $('#current_tab').attr('class');
			
			if (current_class == "unselected_tab") {
				$('#current_tab').removeClass('unselected_tab');
				$('#current_tab').addClass('selected_tab');
				$('#archive_tab').removeClass('selected_tab');
				$('#archive_tab').addClass('unselected_tab');							
			}
			
			$(".current_jobs").show();
			$(".archive_jobs").hide();
			return false;
		});	
		
		$("#archive").click(function() {					
			current_class = $('#archive_tab').attr('class');
			//alert(current_class);	
			if (current_class == "unselected_tab") {
				$('#current_tab').addClass('unselected_tab');
				$('#current_tab').removeClass('selected_tab');
				$('#archive_tab').addClass('selected_tab');
				$('#archive_tab').removeClass('unselected_tab');							
			}
			$(".archive_jobs").show();
			$(".current_jobs").hide();
			return false;
		});																																																																		


	$("#edit_store").click(function() {
			$(".main_box").hide();	
			$("#loader_box").show();		
			store_name = $('#store_name').val();
			address = $('#address').val();
			zip = $('#zip').val();
			website = $('#website').val();
			description = $('#description').val();
			dataString = "storeID=" + storeID + "&name=" + encodeURIComponent(store_name) + "&address=" + encodeURIComponent(address) + "&zip=" + zip + "&description=" + encodeURIComponent(description) + "&website=" + website;
			//alert(dataString);
			if (store_name.length == 0 || address.length == 0 || zip.length == 0) {
				$(".main_box").show();	
				$("#loader_box").hide();	
				$('#store_empty_warning').show();
			} else if (isNaN(zip) == true || zip.length != 5) {
				$(".main_box").show();	
				$("#loader_box").hide();	
				$('#store_zip_warning').show();
			} else {	
				$.ajax({
					type: "POST",
					url: "ajax/store.ajax.php?type=edit_store",
					data: dataString,
					success: function(data) {
						//alert(data);
						if (data == "zip") {
							$(".main_box").show();	
							$("#loader_box").hide();	
							$("#store_zip_warning").show();
						} else {
							window.location.reload();
						}
					}
				});	
			}	
		return false;				
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
											url: "ajax/store.ajax.php?type=add_store",
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
										url: "ajax/store.ajax.php?type=delete_store",
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