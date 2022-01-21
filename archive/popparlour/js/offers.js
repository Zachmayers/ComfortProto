function offers() {
	
	$(document).on("click", '.view_item', function() {
		var itemID = $(this).attr('id');
		window.location = "item.php?id="+itemID		
		return false;
	});
	

/*
	$(document).on("click", '.accept', function() {
		var offerID = $(this).data('offerid');
		alert(offerID);
		$(".offer_accept_holder_"+offerID).show();			
		return false;
	});
*/

/*
	$(document).on("click", '.cancel_accept', function() {
		var offerID = $(this).data('offerid');
		$(".offer_accept_holder_"+offerID).hide();			
		return false;
	});
*/
	
	$(document).on("click", '.counter', function() {
		var offerID = $(this).data('offerid');
		$(".offer_counter_holder_"+offerID).show();			
		return false;
	});

	$(document).on("click", '.cancel_counter', function() {
		var offerID = $(this).data('offerid');
		$(".offer_counter_holder_"+offerID).hide();			
		return false;
	});
	
	
	$(document).on("click", '.submit_location', function() {
		var offerID = $(this).data('offerid');
		var location = encodeURIComponent($(".meeting_place_"+offerID).val());
		$(".offer_accept_holder_"+offerID).hide();			

		dataString = "offerID="+offerID+"&location="+location;	
		alert(dataString);
		$.when(send_ajax(dataString, "ajax/offers.ajax.php?type=accept_offer", "full")).done(function(data){
			alert(data);
			window.location.reload();
		});							

		return false;
	});
	
	$(document).on("click", '.submit_counter', function() {
		var offerID = $(this).data('offerid');
		var new_itemID = $(".counter_offer_"+offerID).val();
		$("#offer_counter_holder_"+offerID).hide();			

		dataString = "offerID="+offerID+"&new_itemID="+new_itemID;	
		alert(dataString);
		$.when(send_ajax(dataString, "ajax/offers.ajax.php?type=counter_offer", "full")).done(function(data){
			alert(data);
			window.location.reload();
		});							
		
		return false;
	});
	
	
/*
	$(document).on("click", '.decline', function() {
		var offerID = $(this).data('offerid');
		
		dataString = "offerID="+offerID;	

		$.when(send_ajax(dataString, "ajax/offers.ajax.php?type=decline_offer", "full")).done(function(data){
			alert(data);
			window.location.reload();
		});							
		return false;
	});
*/
		

	$(document).on("change", '#flargle', function() {	
		trade_itemID = $(this).val();
		$('.trade_row').hide();		
		
		dataString = "trade_itemID="+trade_itemID;	
		$.when(send_ajax(dataString, "ajax/item.ajax.php?type=offer_trade&itemID="+itemID, "full")).done(function(data){
			alert(data);
			$('.offer_complete').show();

		});							
		return false;
		
	})
	
	$(document).on("click", '.accept', function() {	
		tradeID = $(this).attr('id');
		dataString = "tradeID="+tradeID;	
		alert(dataString);
		$.when(send_ajax(dataString, "ajax/trade.ajax.php?type=accept_trade", "full")).done(function(data){
			alert(data);
		});							
		return false;
		
	})
	
	$(document).on("click", '.reject', function() {	
		tradeID = $(this).attr('id');
		dataString = "tradeID="+tradeID;	
		alert(dataString);
		$.when(send_ajax(dataString, "ajax/trade.ajax.php?type=reject_trade", "full")).done(function(data){
			alert(data);
		});							
		return false;
		
	})
}



	