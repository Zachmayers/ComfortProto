function search() {
		
/*
	$(document).on("change", '#category', function() {	
		var category = $(this).val();				
		window.location = 'search.php?category='+category;
	})
*/
		
	$(document).on('click', '#search', function(){
			$('.error').hide();
			
			var category = $('#category').val().trim();		
			var keyword = $('#keyword').val().trim();
			
			if (keyword.length == 0) {
				dataString = "category=" + encodeURIComponent(category);
				alert(dataString);
				$.when(send_ajax(dataString, "ajax/search.ajax.php?type=category")).done(function(data){
					$(".item_row").replaceWith(data);	
					//window.location = "item.php?id="+data+"&page=edit_photos";
				});																						

			} else {
				//$('.container').hide();			
				//$('#loader').show();			
				dataString = "keyword=" + encodeURIComponent(keyword) + "&category=" + encodeURIComponent(category);
				alert(dataString);
				$.when(send_ajax(dataString, "ajax/search.ajax.php?type=keyword_category")).done(function(data){
					$(".item_row").replaceWith(data);	
					//window.location = "item.php?id="+data+"&page=edit_photos";
				});																						
 			}					
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