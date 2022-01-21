
function public_candidate(candidateID) {

/*
	$(".profile_tab").click(function() {
		profile_view = $(this).attr('ID');
		if (profile_view == "profile") {
			$('.details').show();	
			$('#questions_holder').hide();	
			$('#message_holder').hide();
		} else if (profile_view == "message")  {
			$('.details').hide();
			$('#questions_holder').hide();	
			$('#message_holder').show();
		} else if (profile_view == "questions")  {
			$('.details').hide();
			$('#message_holder').hide();	
			$('#questions_holder').show();
		} else if (profile_view == "application") {
			window.location = "candidate.php?ID="+profileID+"&matchID="+matchID+"&type=printer";
		}
		return false;
	});	
*/
	
	
	$("#show_positions_button").click(function() {
 		$(".hidden_position").show('fast');
		$(".show_positions_button").hide();
		$(".hide_positions_button").show();
		return false;			
	});

	$("#hide_positions_button").click(function() {
		$(".hidden_position").hide('fast');
		$(".show_positions_button").show();
		$(".hide_positions_button").hide();
		return false;			
	});	
	
	$("#show_skills_button").click(function() {
 		$(".hidden_skill").show('fast');
		$(".show_skills_button").hide();
		$(".hide_skills_button").show();
		return false;			
	});

	$("#hide_skills_button").click(function() {
		$(".hidden_skill").hide('fast');
		$(".show_skills_button").show();
		$(".hide_skills_button").hide();
		return false;			
	});	

	$(".thumb").click(function() {
		var photoID = $(this).attr('ID');
		$(".profilephoto").hide();
		if (photoID == "profile") {
			$("#main_photo").show();
		} else {
			$("#"+photoID+"_large").show();	
		}
		return false;			
	});	

	$(".hospitality_header").click(function() {
		$(".hosp-exp").hide('fast');
		$(".total-exp").show('slow');
		return false;			
	});	

	$(".total_header").click(function() {
		$(".total-exp").hide('fast');
		$(".hosp-exp").show('slow');
		return false;			
	});		
}


