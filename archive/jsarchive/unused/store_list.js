function store_list() {
	$(document).ready(function(){

					$("#state").change(function() {
						new_state = $('#state').attr('value');
						dataString = "state=" + new_state;
					  	$.ajax({
							type: "POST",
							url: "update_profile.php?type=get_city",
							data: dataString,
							success: function(data) {
								$("#city_inner").replaceWith(data);
								}
						});					
					});	

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
									new_state = $('#state').attr('value');
									city = $('#city').attr('value');
									address = $('#address').attr('value');
									zip = $('#zip').attr('value');
									website = $('#website').attr('value');
									description = $('#description').attr('value');
									dataString = "name=" + store_name + "&address=" + address + "&state=" + new_state + "&city=" + city + "&zip=" + zip + "&description=" + description + "&website=" + website;
									//alert(dataString);
									if (store_name.length == 0 || address.length == 0 || zip.length == 0) {
										$('#store_empty_warning').show();
									} else if (isNaN(zip) == true || zip.length != 5) {
										$('#store_zip_warning').show();
									} else if (city == undefined) {
										$('#store_city_warning').show();						
									} else {
										$.ajax({
											type: "POST",
											url: "update_profile.php?type=add_store",
											data: dataString,
											success: function(data) {
												//alert(data);
												if (data == "true") {
													window.location.reload();
												} else {
													$('#warning').append(data);
													$('#warning').show();
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
		
	});					
}
