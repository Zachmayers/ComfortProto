function product(questionID, product_one, product_two, product_three, badge, device) {
	//on load, track that the page was viewed
		dataString = "questionID=" + questionID + "&product_one=" + product_one + "&product_two=" + product_two + "&product_three=" + product_three;
		$.when(send_ajax(dataString, "ajax/product.ajax.php?type=viewed", "none")).done(function(data){
		//	alert(data);
		});
	
	
	$(".rank_product").click(function() {
		ranked_product = $(this).attr('ID');

		if (product_one == ranked_product) {
			product_one = "NA";
		}
		if (product_two == ranked_product) {
			product_two = "NA";
		}
		if (product_one == ranked_product) {
			product_three = "NA";
		}
		
		
		dataString = "questionID=" + questionID + "&ranked_product=" + ranked_product + "&product_one=" + product_one + "&product_two=" + product_two + "&product_three=" + product_three;
		$.when(send_ajax(dataString, "ajax/product.ajax.php?type=rank_products", device)).done(function(data){
			$('#product_holder').hide();
			if (device == "mobile") {
				$('#loader_box').show();	
			}		
			window.location = "products.php?page=thanks";
		});
		return false;
	})
	
	$("#learn_more").click(function() {
		$('#product_holder').hide('fast');
		$('#description_holder').show('fast');
		return false;		
	})
	
	$(".hide_more").click(function() {
		$('#description_holder').hide('fast');
		$('#product_holder').show('fast');
		return false;		
	})	
		
	$("#top_products").click(function() {
		if (badge != "None") {
		} else {
			
		}
		return false;		
	})

}