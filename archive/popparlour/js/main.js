function sub_total() {
	$(document).on("change", '.quantity', function() {	
		var quantity = 0;
		var price = 0;
		
		$(".price").each(function() {
			price = $(this).val();
			ID = $(this).attr("ID");
			quantity = $("#quantity_" + ID).val();
			sub_total = sub_total + price * quantity;
		})

		$("#sub_total").replaceWith("<span id='sub_total'>"+sub_total+"</span>");	
		
		//change div
		return false;

	})	
}

function size_change() {
	$(document).on("change", '.size', function() {	
		var itemID = $(this).data('test');
		var size = $(this).val();
		//alert(itemID);
		
		$(".small_price[data-item="+itemID+"]").hide();
		$(".small_price_soy[data-item="+itemID+"]").hide();
		$(".small_price_other[data-item="+itemID+"]").hide();
		$(".large_price[data-item="+itemID+"]").hide();
		$(".large_price_soy[data-item="+itemID+"]").hide();
		$(".large_price_other[data-item="+itemID+"]").hide();
		
		if (size == "12") {
/*
			$(".large_price[data-item="+itemID+"]").hide();
			$(".small_price[data-item="+itemID+"]").show();
*/
			if ($("#"+itemID).hasClass('soy')) {
				$(".small_price_soy[data-item="+itemID+"]").show();			
			} else if ($("#"+itemID).hasClass('almond') || $(this).hasClass('oat')) {
				$(".small_price_other[data-item="+itemID+"]").show();						
			} else {
				$(".small_price[data-item="+itemID+"]").show();				
			}
			
			$("#"+itemID).removeClass('large');
			$("#milk_"+itemID).removeClass('large');

		} else {
/*
			$(".small_price[data-item="+itemID+"]").hide();
			$(".large_price[data-item="+itemID+"]").show();
*/

			if ($("#"+itemID).hasClass('soy')) {
				$(".large_price_soy[data-item="+itemID+"]").show();			
			} else if ($("#"+itemID).hasClass('almond') || $("#"+itemID).hasClass('oat')) {
				$(".large_price_other[data-item="+itemID+"]").show();						
			} else {
				$(".large_price[data-item="+itemID+"]").show();				
			}

			var name = $("#"+itemID).data('name');
			$("#"+itemID).addClass('large')
			$("#milk_"+itemID).addClass('large');
			
/*
			$(".small_add[data-item="+itemID+"]").hide();
			$(".large_add[data-item="+itemID+"]").show();			
*/
		}
		return false;

	})	
}

function temp_change() {
	$(document).on("change", '.temp', function() {	
		var itemID = $(this).data('test');
		var temp = $(this).val();
		//alert(itemID);
		
		if (temp == "hot") {
			$("#"+itemID).removeClass('iced')
		} else {
			$("#"+itemID).addClass('iced')
		}
		return false;

	})	
}

function milk_change() {
	$(document).on("change", '.milk', function() {	
		var itemID = $(this).data('test');
		var milk = $(this).val();
		
		if ($(this).hasClass('large')) {
			var size = "large";
		} else {
			var size = "small";
		}
		
		//alert(itemID);
		$("#"+itemID).removeClass('milk')
		$("#"+itemID).removeClass('almond')
		$("#"+itemID).removeClass('soy')
		$("#"+itemID).removeClass('oat')
		
		$(".small_price[data-item="+itemID+"]").hide();
		$(".small_price_soy[data-item="+itemID+"]").hide();
		$(".small_price_other[data-item="+itemID+"]").hide();
		$(".large_price[data-item="+itemID+"]").hide();
		$(".large_price_soy[data-item="+itemID+"]").hide();
		$(".large_price_other[data-item="+itemID+"]").hide();
		
		if (milk == "milk") {
			$("#"+itemID).addClass('milk')
			if ($(this).hasClass('large')) {
				$(".large_price[data-item="+itemID+"]").show();
			} else {
				$(".small_price[data-item="+itemID+"]").show();				
			}
		} else if (milk == "almond") {
			$("#"+itemID).addClass('almond');
			if ($(this).hasClass('large')) {
				$(".large_price_other[data-item="+itemID+"]").show();
			} else {
				$(".small_price_other[data-item="+itemID+"]").show();				
			}
		} else if (milk == "soy") {
			$("#"+itemID).addClass('soy')
			if ($(this).hasClass('large')) {
				$(".large_price_soy[data-item="+itemID+"]").show();
			} else {
				$(".small_price_soy[data-item="+itemID+"]").show();				
			}
		} else if (milk == "oat") {
			$("#"+itemID).addClass('oat')
			if ($(this).hasClass('large')) {
				$(".large_price_other[data-item="+itemID+"]").show();
			} else {
				$(".small_price_other[data-item="+itemID+"]").show();				
			}
		} else {
			if ($(this).hasClass('large')) {
				$("#"+itemID).addClass('milk')
				$(".large_price[data-item="+itemID+"]").show();
			} else {
				$(".small_price[data-item="+itemID+"]").show();				
			}
			
		}
		return false;

	})	
}

function login() {
	$(document).on("click", '#login', function() {	
		var pass = $('#password').val();
		dataString = "pass="+pass;
		//alert(dataString);
	$.when(send_ajax(dataString, "ajax/pop.ajax.php?type=login", "full")).done(function(data){
		//alert(data);
		window.location.reload()
	});							
		
	});
}


function save_order() {
	$(document).on("click", '#checkout', function() {	
		//alert(localStorage.getItem("shoppingCart"));
    	//shopping_cart = JSON.parse(localStorage.getItem("shoppingCart"));
		//alert(shopping_cart);
		
		
	shopping_cart = localStorage.getItem("shoppingCart");
	
	if (localStorage.length === 0) {
		
	} else {
		dataString = "item_list="+shopping_cart;	
		//alert(dataString);
		$.when(send_ajax(dataString, "ajax/pop.ajax.php?type=save_order", "full")).done(function(data){
			//alert(data);
			window.location = "main.php?page=checkout&orderID="+data;
		});		
	}					
	return false;
	})

}

function empty_cart() {
		$(document).on("click", '#empty_cart', function() {	
			localStorage.clear();
			window.location.reload();
		});
}

function enter_address(orderID) {
	$(document).on("click", '#enter_address', function() {	
			$(".error").hide();

		var name = $("#name").val().trim();
		var email = $("#email").val().trim();
		var street = $("#street").val().trim();
		var zip = $("#zip").val().trim();
		var phone = $("#phone").val().trim();
		var notes = $("#notes").val().trim();
		var day = $("#day").val().trim();
		var time = $("#time").val().trim();
				
		if (name == "" || street == "" || zip == "" || email == "" || phone == "") {
			$(".error").show();
		} else {
			dataString = "name="+name+"&street="+street+"&zip="+zip+"&email="+email+"&phone="+phone+"&notes="+notes+"&day="+day+"&time="+time;	
				//alert(dataString);
				$.when(send_ajax(dataString, "ajax/pop.ajax.php?type=save_address&orderID="+orderID, "full")).done(function(data){
					//alert(data);
					//window.location = "main.php?page=checkout&orderID="+data;
					if (data == "error") {
						window.location = "main.php?page=error";
					} else {
						$('#order_items').show();
						$('#address').hide();						
					}
					
				});							
			
		}
		
	return false;
	})

}

function delivered() {
	$(document).on("click", '.delivered', function() {	
		var orderID = $(this).attr('ID');

		dataString = "orderID="+orderID;	
				//alert(dataString);
				$.when(send_ajax(dataString, "ajax/pop.ajax.php?type=delivered", "full")).done(function(data){
					//alert(data);
					window.location.reload();
				});									
		return false;
	})

}


function new_checkout(checkout_amount, orderID) {
		
	var handler = StripeCheckout.configure({
   // key: 'pk_test_kGzjayEBOoz1XmfQfPRfRTGN00DUIXrXgQ',
   key: 'pk_live_PlRrZOHHqp82VugF4xNCqijN00Iymvn3uG',
   
 //   image: 'new_square_logo.png',
    locale: 'auto',
    color: 'black',
    token: function(token, args) {
      // You can access the token ID with `token.id`.
      // Get the token ID to your server-side code for use.
/*
      		$('.job_post_holder').hide();
			$('#payment_loader').show();
*/

			$.ajax({
				type: "POST",
				url: "ajax/checkout.ajax.php?key=F23dfhjed",
				data: {tokenid: token.id, email: token.email, checkout_amount: checkout_amount},
				success: function(data) {
					//if successful show success page
					//alert(data);
					if (data != "fail") {
						
						dataString = "checkout_amount=" + checkout_amount + "&transactionID=" + data + "&orderID=" +orderID

						//alert(dataString);
				
						$.when(send_ajax(dataString, "ajax/pop.ajax.php?type=paid", "NA")).done(function(result){
							//alert(result);
							//empty local storage
							$(".checkout_holder").hide();
							localStorage.clear();
							window.location = "main.php?page=thank_you";
						});																											
						
					} else {
/*
						$('.container').show();			
					
						$("#payment_loader").hide();
						$("#payment_error").show();
*/
					}
				}
			});
      
    }
  });

  $('#customButton').on('click', function(e) {
	  $('.warning').hide();

		    // Open Checkout with further options:

		    handler.open({
		      name: 'Pop Parlour',
		      description: 'Delivery Order',
		      zipCode: true,
		      amount: checkout_amount,
		      allowRememberMe: false,
		    });
		    e.preventDefault();
	    return false; 
	});
	
	  // Close Checkout on page navigation:
	  $(window).on('popstate', function() {
	    handler.close();
	  });	
	  
}


function logout() {
		$(document).on("click", '#logout', function() {

			dataString = "test=test";
			$.when(send_ajax(dataString, "ajax/pop.ajax.php?type=blarg", "full")).done(function(data){
				//alert(data);
				window.location.reload();
			});		
		})					
}

function buttons() {
	$("#coffee").click(function() {
	    $('html, body').animate({
	        scrollTop: $(".coffee").offset().top
	    }, 1000);
	    return false;
	});
	
	$("#pops").click(function() {
	    $('html, body').animate({
	        scrollTop: $(".pops").offset().top
	    }, 1000);
	    return false;	    
	});
	
	$("#beer").click(function() {
	    $('html, body').animate({
	        scrollTop: $(".beer").offset().top
	    }, 1000);
	    return false;	    
	});
	
	$("#cart_scroll").click(function() {
	    $('html, body').animate({
	        scrollTop: $(".cart_scroll").offset().top
	    }, 1000);
	    return false;	    
	});
	
}
