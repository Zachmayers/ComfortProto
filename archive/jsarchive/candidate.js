
function candidate(profileID, highlight, matchID, resume) {

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
	
	$(".highlight_candidate").click(function() {
		matchID = $(this).attr('ID');
		if (highlight == "Y") {
			new_highlight = "N";
		} else {
			new_highlight = "Y";
		}
		dataString = "matchID=" + matchID + "&highlight=" + new_highlight;

		$.when(send_ajax(dataString, "ajax/candidate.ajax.php?type=highlight")).done(function(data){
			//alert(data);
			window.location.reload();
		});											

		return false;
	});	
	
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

	$("#resume").click(function() {
		window.location = "resumes/" + resume;		
	})
	
			
	$("#report").click(function() {
		//alert("report");
		$("#loader_box").dialog("open");				
		$("#inappropriate_form").dialog("open");
		return false;
	});			
			
	$(function() {
		$("#inappropriate_form").dialog({
			autoOpen: false,
			modal: true,
			height: 250,
			width: 450,
			buttons: {
				"Report": function() {	
					dataString = "profileID=" + profileID + "&type=profile";

					$.when(send_ajax(dataString, "ajax/candidate.ajax.php?type=report", "full")).done(function(data){
						//alert(data);
						window.location.reload();
					});															
				}
			}
		});
	});				
}


 function notes(profileID) {
	 
	$("#show_edit_notes").click(function() {
		$('#notes_summary').hide();	
		$('#edit_notes_form').show();	
		return false;
	});
	
	$("#cancel_notes").click(function() {
		$('#edit_notes_form').hide();	
		$('#notes_summary').show();	
		return false;
	});
	
	 
	$("#save_notes").click(function()  {
		$('#warning').hide();

		var notesID = $('#notesID').val();
		var matchID = $('#matchID').val();
		
		var culture = $('#culture').val();
		var experience = $('#experience').val();
		var availability = $('#availability').val();
		var notes = $('#general_notes').val().trim();
	
		dataString = "notesID=" + notesID + "&matchID=" + matchID + "&candidateID=" + profileID + "&culture=" + culture + "&experience=" + experience + "&availability=" + availability + "&notes=" + encodeURIComponent(notes);
		//alert(dataString);
		$.when(send_ajax(dataString, "ajax/candidate.ajax.php?type=edit_notes", "full")).done(function(data){
			//alert(data);
			window.location.reload();	
		});		

		return false;	
	});			
	 
 }