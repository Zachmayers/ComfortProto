function add_wine(itemID) {
		
		$("#save_new_wine").click(function() {
			$('.error').hide();

			wine_name = $('#new_wine_name').val().trim();
			varietal = $('#new_wine_varietal').val().trim();
			vintage = $('#new_wine_vintage').val().trim();
			category = $('.new_wine_category').val();

			if (wine_name.length == 0) {
				$('#new_wine_empty_warning').show();
				$('#new_wine_form').addClass('has-error');					
			} else {
				$('.container').hide();			
				$('#loader').show();			
				dataString = "wine_name=" + encodeURIComponent(wine) + "&varietal=" + encodeURIComponent(varietal) + "&category=" + encodeURIComponent(category) + "vintage="+encodeURIComponent(vintage);
				alert(dataString);
				$.when(send_ajax(dataString, "ajax/wine.ajax.php?type=add_new_wine&wineID=new")).done(function(data){
					alert(data);
					window.location = "wine.php?id="+data+"&page=add_label";
				});																						
			}					
			return false;					
		});
		
		$("#save_edit_item").click(function() {
			$('.error').hide();

			item_name = $('#item_name').val().trim();
			description = $('#description').val().trim();
			category = $('.item_category').val();
			itemID = $('#itemID').val();

			if (item_name.length == 0) {
				$('#new_item_empty_warning').show();
				$('#new_item_form').addClass('has-error');					
			} else {
				$('.container').hide();			
				$('#loader').show();			
				dataString = "item_name=" + encodeURIComponent(item_name) + "&description=" + encodeURIComponent(description) + "&category=" + encodeURIComponent(category);
				alert(dataString);
				$.when(send_ajax(dataString, "ajax/item.ajax.php?type=update_item&itemID="+itemID)).done(function(data){
					alert(data);
					window.location = "item.php?id="+data;
				});																						
			}					
			return false;					
		});		
									
}


function varietal(varietalID) {
	alert("HERE");
	$(document).on("click", '.update_varietal', function() {
		body = $('.body').val().trim();
		acidity = $('.acidity').val().trim();
		tannin = $('.tannin').val();
		dry = $('.dry').val();
		alcohol = $('.alcohol').val();

		var taste_array = [];
	    $('input[type=checkbox]').each(function() {
          // var $this = $(this);    
            if ( $(this).is(':checked') == true) {
	            taste = $(this).val();
                taste_array.push(taste); // checked, add to array
               // break;
            }
/*
     		if ($(this).data('taste') == "selected") {
	 			taste_array.push(checked_req);
	 		}
*/
	    });	
	    
	    alert(taste_array);

		dataString = "taste_group=" + taste_array + "&varietalID=" + varietalID + "&body=" + body + "&acidity=" + acidity
							+ "&tannin=" + tannin + "&dry=" + dry + "&alcohol=" + alcohol;

		alert(dataString);
		$.when(send_ajax(dataString, "ajax/wine.ajax.php?type=update_varietal")).done(function(data){
			alert(data);
			//window.location.reload();
		});																						

		return false;
	});

	$(document).on("click", '.open_trade', function() {
		$('.trade_row').show();			
		return false;
	});
		

	$(document).on("click", '.offer_item', function() {	
		offer_itemID = $(this).attr('id');
		dataString = "offer_itemID="+offer_itemID+"&wanted_itemID="+itemID;	
		$.when(send_ajax(dataString, "ajax/trade.ajax.php?type=offer_trade", "full")).done(function(data){
			alert(data);
			$('.offer_complete').show();

		});							
		return false;
		
	})	
}


function photo() {
	$("#main_pic_choose").change(function(){
	    input = this;
		if (input.files && input.files[0]) {
			if (input.files[0].size > 5000000) {
				$('#file_size_warning').show();
				alert("Please choose a file less than 2 MB");
			} else if (input.files[0].type == "image/png" || input.files[0].type == "image/jpg" || input.files[0].type == "image/jpeg") {
					//if (window.confirm("Upload image: " + input.files[0].name + "?")) {
						alert("here");
						//$("#loader_box").dialog("open");																			
						$("#main_upload_button").click();	
						return false;
					//} else {
					//	window.location.reload();
					//}	
			} else {
				$('#file_type_warning').show();				
				alert("File must be a JPEG or PNG image file");
			}		
		} 	    
	});
	
	$("#other_pic_choose").change(function(){
		    input = this;
			if (input.files && input.files[0]) {
				if (input.files[0].size > 5000000) {
					$('#file_size_warning_bar').show();
				} else if (input.files[0].type == "image/png" || input.files[0].type == "image/jpg" || input.files[0].type == "image/jpeg") {
/* 							if (window.confirm("Upload image: " + input.files[0].name + "?")) {					 */
							$("#loader_box").dialog("open");																			
							$("#other_upload_button").click();						
							return false;
/*
						} else {
							window.location.reload();
						}				
*/
				} else {
					$('#file_type_warning_bar').show();				
				}
		}				 	    
	});
	
	$("#main_upload_button_ie").click(function(){
		//alert("here");
		$('#loader_box').dialog("open");	
	});		
	$("#other_upload_button_ie").click(function(){
		//alert("here");
		$('#loader_box').dialog("open");	
	});				

	
	$(".upload_cancel").click(function(){
		//alert("cancel");
		cancel_type = $(this).attr("ID");
		switch(cancel_type) {
			case "main":
  				$('#profile_form_ie').hide();					
  				$('#profile_pic').show();				 	    						 	    		
  				$('#photo_buttons').show();	  																							  							  				
			break;
			
			case "other":
  				$('#bar_form_ie').hide();		
  				$('.holder_Bartender').show();				 	    						 	    			  																						  				
			break;
		}
	});								
								
			  
		$(".remove_gallery").click(function() {
			gallery_type = $(this).attr('ID');		
			//alert(gallery_type);			
			$("#" + gallery_type + "_photo_view").hide();
			$("#" + gallery_type + "_photo_remove").show();						
			return false;
		});								  

		$(".add_photo").click(function() {
			pic_type = $(this).attr("id");
			//alert(pic_type);
			//alert(navigator.appName);
			var iOS = ( navigator.userAgent.match(/(iPad|iPhone|iPod)/g) ? true : false );
			var rv = 0;
			if (navigator.appName == 'Microsoft Internet Explorer') {
			    var ua = navigator.userAgent;
			    var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
			    if (re.exec(ua) != null)
			    rv = parseFloat( RegExp.$1 );
			    if (rv < 10) {
				    browser = "low_ie";
			    } else {
				    browser = "normal";
			    }
			 } else if (iOS == true) {
			 	browser = "normal" //javascript alerts lockup ios when there is a file in the input, use old style, apple sucks
			 } else {
				 browser = "normal";
			 }
			  //alert(browser);
			
			switch(pic_type) {
				case "main":
					  switch(browser) {
						  case "normal":
						  	$("#main_pic_choose").click();																			  
						  break;
						  
/*
						  case "low_ie":
			  				$('#photo_buttons').hide();
			  				$('#profile_pic').hide();				 	    						 	    		
			  				$('#profile_form_ie').show();																				  							  
						  break;
*/
					  }
				break;
				
				case "other":
					  switch(browser) {
						  case "normal":
						  	$("#other_pic_choose").click();													
						  break;
						  
/*
						  case "low_ie":
			  				$('.holder_Bartender').hide();				 	    						 	    		
			  				$('#bar_form_ie').show();																				  
						  break;
*/
					  }
				break;
			}
			return false;
		});					
		
		$(".remove_photo").click(function() {
			photoID = $(this).attr("ID");
			//alert(photoID);
			if (window.confirm("Remove photo?")) {
				dataString = "photoID=" + photoID;
				$.ajax({
					type: "POST",
					url: "ajax/item.ajax.php?type=remove_photo",
					data: dataString,
					success: function(data) {
						//alert(data);
						$("#loader_box").dialog("open");																			
						window.location.reload();
					}
				});												
			}
			return false;
		});	

				var status = $('#status');
$('form').ajaxForm({
    beforeSend: function() {
        status.empty();
        var percentVal = '0%';
       // bar.width(percentVal)
        //percent.html(percentVal);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
       // bar.width(percentVal)
        //percent.html(percentVal);
    },
    success: function() {
        var percentVal = '100%';
        //bar.width(percentVal)
      //  percent.html(percentVal);
    },
	complete: function(xhr) {
		alert(xhr.responseText);
		if(xhr.responseText == "Successful") {
			alert("HERE");
			window.location.reload();	
		} else {
			$("#loader_box").dialog("close");		
			status.html(xhr.responseText);
		}
	}
});										
					
	$("#delete_photo").click(function() {
		dataString = "type=main";
		$.when(send_ajax(dataString, "ajax/item.ajax.php?type=remove_photo", "full")).done(function(data){
			//alert(data);
			window.location.reload();
		});																	
		return false;
	});	
	
}

function HtmlDecode(html) {
	if (html != "") {
	    var div = document.createElement("div");
	    div.innerHTML = html;
	    return div.childNodes[0].nodeValue;
    } else {
	    return html;
    }
}

function copy_clip() {
	new ClipboardJS('.btn');
	$(document).on("click", "#copy_btn", function() {
		$('#copy_notice').show();
		return false;				
	})
	
}