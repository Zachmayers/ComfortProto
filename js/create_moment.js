function new_moment() {
		$(".book").click(function() {
			var event = $('#event').val();
			var title = $('#title').val();
			var location = $('#location').val();
			var address = $('#address').val();
			var zip = $('#zip').val();
			var date = $('#date').val();
			var time = $('#time').val();
			var description = $('#description').val();			

			dataString = "event=" + event + "&title=" + encodeURIComponent(title) + "&location=" + encodeURIComponent(location)
								+ "&address=" + encodeURIComponent(address) + "&zip=" + encodeURIComponent(zip) 
								+ "&date=" + date + "&time=" + time + "&description=" + encodeURIComponent(description) ;
			
/*
			$('#remove_holder').hide();		
			$('#recommendation_loader').show();		
*/
alert(dataString);
			$.when(send_ajax(dataString, "ajax/moment.ajax.php?type=new_moment", "NA")).done(function(data){
				alert(data);
				window.location = "main.php";
			});
			return false;
		});		
}
