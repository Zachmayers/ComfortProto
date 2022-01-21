$(document).ready(function(){

					$(".incomplete").click(function() {
						$("#incomplete_warning").dialog("open");
						return false;
					});
					
					$(".unavailable").click(function() {
						$("#unavailable_warning").dialog("open");
						return false;
					});
					
					$(".wrong_type").click(function() {
						$("#wrong_type").dialog("open");
						return false;
					});
					
					$(".logout").click(function() {
						dataString = "logout";
						$.ajax({
							type: "POST",
							url: "logout.php",
							data: dataString,
							success: function(data) {
								window.location = "http://servebartendcook.com";
							}
						});	
						return false;
					});
										
					$(function() {
						$("#incomplete_warning").dialog({
							autoOpen: false,
							modal: true,
							height: 250,
							width: 350,
							buttons: {
								"Finish Profile": function() {
									window.location = "http://civilfreelance.com/Temp/profile";
								}
							}
						});
					});
					
					$(function() {
						$("#unavailable_warning").dialog({
							autoOpen: false,
							modal: true,
							height: 250,
							width: 350,
						});
					});
					
					$(function() {
						$("#wrong_type").dialog({
							autoOpen: false,
							modal: true,
							height: 250,
							width: 350,
						});
					});
					
					$(".new").click(function() {
						$("#new_project").dialog("open");
						return false;		
					});

					$(function() {
						$("#new_project").dialog({
							autoOpen: false,
							modal: true,
							height: 165,
							width: 350,
							buttons: {
								"Create": function() {	
									project_name = $('#new_project_name').attr('value');
									dataString = "name=" + project_name;
									//alert(dataString);
									$.ajax({
										type: "POST",
										url: "/Temp/update_project.php?ID=0&action=new_project",
										data: dataString,
										success: function(data) {
											if (data != "<b><i>Required Field</i></b>") {
												window.location = "/Temp/project/" + data + "/new-project";
											} else {
												$('#project_name_warning').append(data);
												$('#project_name_warning').show();
											}
											
										}
									});					
								}
							}
						});
					});	

					$(".no_login").click(function() {
						$("#login_warning").dialog("open");
						return false;
					});
										
					$(function() {
						$("#login_warning").dialog({
							autoOpen: false,
							modal: true,
							height: 250,
							width: 350,
							buttons: {
								"Sign Up": function() {	
								},
								"Login": function() {	
								}
							}
						});
					});

	$("#report_error").click(function() {
		$("#report_error_form").dialog("open");
		return false;
	});
	
	$("#suggestion").click(function() {
		$("#suggestion_form").dialog("open");
		return false;
	});
	
	$(function() {
		$("#report_error_form").dialog({
			autoOpen: false,
			modal: true,
			height: 400,
			width: 350,
			buttons: {
				"Report Error": function() {	
					error_page = $('#error_page').attr('value');
					error_description = $('#error_description').attr('value');
					dataString = "page=" + error_page + "&description=" + error_description;
					$.ajax({
						type: "POST",
						url: "Temp/update_profile.php?type=beta_error",
						data: dataString,
						success: function(data) {
							//alert(data);
								window.location = "/Temp/main";
						}
					});					
				}
			}
		});
	});
	
	$(function() {
		$("#suggestion_form").dialog({
			autoOpen: false,
			modal: true,
			height: 400,
			width: 350,
			buttons: {
				"Suggestion": function() {	
					suggestion = $('#suggestion_description').attr('value');
					dataString = "suggestion=" + suggestion;
					$.ajax({
						type: "POST",
						url: "/Temp/update_profile.php?type=beta_suggestion",
						data: dataString,
						success: function(data) {
							//alert(data);
								window.location = "/Temp/main.php";
						}
					});					
				}
			}
		});
	});
});