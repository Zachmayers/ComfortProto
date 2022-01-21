function new_moment() {
		$(".book").click(function() {
			var event = $('#event').val();
			var title = $('#title').val();
			var location = $('#pac-input').val();
			var address = $('#address').val();
			var zip = $('#zip').val();
			var date = $('#date').val();
			var time = $('#time').val();
			var description = $('#description').val();			

			dataString = "event=" + event + "&title=" + encodeURIComponent(title) + "&location=" + encodeURIComponent(location)
								+ "&address=" + encodeURIComponent(address) + "&zip=" + encodeURIComponent(zip) 
								+ "&date=" + date + "&time=" + time + "&description=" + encodeURIComponent(description) ;
								alert(event);
			
/*
			$('#remove_holder').hide();		
			$('#recommendation_loader').show();		
*/
			$.when(send_ajax(dataString, "ajax/moment.ajax.php?type=new_moment", "NA")).done(function(data){
				//alert(data);
				
				//show confirmation page
				$('.form-horizontal').hide();
				$('.book').hide();
				$('#step_four').hide();
				$('#general_holder').hide();
				$('#confirmation_holder').show();		

				//window.location = "moment.php?page=confirmation&momentID=" + data;
			});
			return false;
		});		
}

function next_buttons() {
		$(".next").click(function() {
				var step = $(this).attr("ID");
				$('.container').hide();
				
				if (step == "one_next") {
					location_name = $('#pac-input').val();
					var address = $('#address').val();
					var zip = $('#zip').val();
					$('#step_two').show();
					$('#location_name').text(location_name);
					$('#location_address').text(address);
				} else if (step == "two_next") {
					var date = $('#date').val();
					var time = $('#time').val();

					$('#step_three').show();	
					$('#review_date').text(date);
					$('#review_time').text(time);
				} else if (step == "three_next") {
					var description = $('#description').val();	
					$('#step_four').show();		
					$('#review_description').text(description);
				}
		})

		$(".back").click(function() {
				var step = $(this).attr("ID");
				$('.container').hide();
				
				if (step == "four_back") {
					$('#step_three').show();
				} else if (step == "three_back") {
					$('#step_two').show();					
				} else if (step == "two_back") {
					$('#step_one').show();										
				}
		}	) 
 }
function checkout(type, momentID) {
		$(".checkout").click(function() {
		

			dataString = "type=" + type + "&momentID=" + momentID  ;
			//alert(dataString);
			$.when(send_ajax(dataString, "ajax/moment.ajax.php?type=checkout", "NA")).done(function(data){
			//	alert(data);
				window.location.reload();
			});
			return false;
		});		
	
}

function checkin(type, momentID) {
		$(".checkin").click(function() {
		

			dataString = "type=" + type + "&momentID=" + momentID  ;
			
			$.when(send_ajax(dataString, "ajax/moment.ajax.php?type=checkin", "NA")).done(function(data){
				//alert(data);
				window.location.reload();
			});
			return false;
		});		
	
}

function accept_moment(momentID) {
			$(".accept").click(function() {
		

				dataString = "momentID=" + momentID  ;
			
				//alert(dataString);
			$.when(send_ajax(dataString, "ajax/moment.ajax.php?type=accept", "NA")).done(function(data){
				//alert(data);
				window.location.reload();
			});
			return false;
		});		
}

function send_message(momentID) {
	
	$(".show_message").click(function() {
		$(".map").hide();
		$(".messages").show();
	})

	$(".show_map").click(function() {
		$(".messages").hide();
		$(".map").show();
	})
	
	
		$(".send_message").click(function() {
		
				var message = $('#message').val();

				dataString = "momentID=" + momentID + "&message="+message ;
			
				//alert(dataString);
			$.when(send_ajax(dataString, "ajax/moment.ajax.php?type=send_message", "NA")).done(function(data){
				//alert(data);
				window.location.reload();
			});
			return false;
		});		
}

function update_chat_box(momentID) {
	setInterval(function() {
				dataString = "momentID=" + momentID ;
			$.when(send_ajax(dataString, "ajax/moment.ajax.php?type=check_message", "NA")).done(function(data){
				//alert(data);
				if (data != false) {
					//replace chat div
					 $('#chat_box').html(data);
					 $('.msg_button').hide();
					 $('.new_msg_button').show();
				}
				//window.location.reload();
			});
		
	}, 5000)
}

function check_for_message_alert() {
	setInterval(function() {
		if($('#message_alert').is(":hidden")) {
				dataString = "" ;
			$.when(send_ajax(dataString, "ajax/moment.ajax.php?type=check_message_alert", "NA")).done(function(data){
				//alert(data);
				if (data != false) {
					//replace chat div
					
					 $('#message_alert').show();
				}
				//window.location.reload();
			});
		}
		
	}, 5000)
}

function rate(momentID, type) {
				$(".rate").click(function() {
				var rating = $('#rating').val();
				var notes = $('#notes').val();	
	
				dataString = "momentID=" + momentID +"&type="+ type + "&rating="+rating+"&notes="+notes ;
			
				//alert(dataString);
			$.when(send_ajax(dataString, "ajax/moment.ajax.php?type=rate", "NA")).done(function(data){
				//alert(data);
				window.location.reload();
			});
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
	document.getElementById('pac-input').value = place.name;
	document.getElementById('address').value = address;
	document.getElementById('city').value = city;		
	document.getElementById('state').value = state;
	document.getElementById('zip').value = zip;
//alert(address);
		
  });
}
