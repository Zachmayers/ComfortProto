function trade(tradeID) {

	$(document).on("click", '.open_trade', function() {
		$('.trade_row').show();			
		return false;
	});
		

	$(document).on("click", '.offer_item', function() {	
		offer_itemID = $(this).attr('id');
		dataString = "offer_itemID="+offer_itemID+"&want_itemID="+itemID;	
		alert(dataString);
		$.when(send_ajax(dataString, "ajax/trade.ajax.php?type=offer_trade", "full")).done(function(data){
			alert(data);
			$('.offer_complete').show();

		});							
		return false;
		
	})

	$(document).on("click", '.revoke_item', function() {	
		tradeID = $(this).attr('id');
		dataString = "tradeID="+tradeID;	
		alert(dataString);
		$.when(send_ajax(dataString, "ajax/trade.ajax.php?type=revoke_trade", "full")).done(function(data){
			alert(data);
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
	
	$(document).on("click", '.complete_trade', function() {
		$("#complete_trade_form").show(); 
		$(".complete_trade").hide(); 
		$(".failed_trade").hide(); 

		return false;
	});

	$(document).on("click", '.cancel_review', function() {	
		$("#complete_trade_form").hide();
		$(".complete_trade").show(); 
		$(".failed_trade").show(); 
		
		return false;		
	})
	
	$(document).on("click", '.save_review', function() {	
// 		tradeID = $(this).data('trade');
/*
		rating = $('.rating[data-trade='+tradeID+']').val();
		review = $('.review[data-trade='+tradeID+']').val();
		userID = $('.userID[data-trade='+tradeID+']').val();
*/
	
		rating = $('.rating').val();
		review = $('.review').val();
		userID = $('.userID').val();
		
		dataString = "tradeID="+tradeID+"&rating="+rating+"&review="+review+"&userID="+userID;	
		alert(dataString);
		$.when(send_ajax(dataString, "ajax/trade.ajax.php?type=add_feedback", "full")).done(function(data){
			alert(data);
		});							

		return false;		
	})
	
}