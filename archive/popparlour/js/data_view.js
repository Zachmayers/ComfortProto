function analyze_functions() {

	$(document).on("change", '.lead_status', function() {
		lead_status = $(this).val();
		window.location = "data_view.php?view=summary&type=lead_status&query="+lead_status		
		
		return false;
	});
		
}

function submit_auto_data(json_array) {
	
	$(document).on("click", '#upload_auto', function() {	
		
		jason_array_clean = JSON.stringify(json_array).replace('&','')

		dataString = "data_array="+jason_array_clean;	
		alert(dataString);
		$('.upload_holder').hide();
		$('.loader').show();

		$.when(send_ajax(dataString, "ajax/upload_script.ajax.php?type=upload_auto", "full")).done(function(data){
			alert(data);
			window.location = "data_view.php?view=auto_report";
		});							

		return false;		
	})	
}

function submit_lead_data(json_array) {
	$(document).on("click", '#map_fields', function() {	
		//json_array = JSON.stringify(json_array).replace(/[\/\(\)\']/g, "\\$&")

		lp_key = $('#key').val();
		campaign_id = $('#campaign_id').val();
		name = $('#name').val();

		first_name = $('.field_first_name').val();
		last_name = $('.field_last_name').val();
		phone_home = $('.field_phone_home').val();
		phone_cell = $('.field_phone_cell').val();
		phone_work = $('.field_phone_work').val();
		phone_ext = $('.field_phone_ext').val();
		address = $('.field_address').val();
		address2 = $('.field_address2').val();
		city = $('.field_city').val();
		state = $('.field_state').val();
		zip_code = $('.field_zip_code').val();
		county = $('.field_county').val();
		country = $('.field_country').val();
		email_address = $('.field_email_address').val();
		dob = $('.field_dob').val();
		ip_address = $('.field_ip_address').val();
		src = $('.field_src').val();
		type = $('.field_type').val();
		landing_page = $('.field_landing_page').val();
		gender = $('.field_gender').val();
		height_feet = $('.field_height_feet').val();
		height_inches = $('.field_height_inches').val();
		weight = $('.field_weight').val();
		tobacco_use = $('.field_tobacco_use').val();
		insurance_type = $('.field_insurance_type').val();
		jornaya_lead_id = $('.field_jornaya_lead_id').val();
		trusted_form_token = $('.field_trusted_form_token').val();
		opt_in_date_time = $('.field_opt_in_date_time').val();
		household_income = $('.field_household_income').val();
		sub_id = $('.field_sub_id').val();
		currently_insured = $('.field_currently_insured').val();
		pub_id = $('.field_pub_id').val();

		dataString = "first_name="+first_name+
							"&last_name="+last_name+
							"&phone_home="+phone_home+
							"&phone_cell="+phone_cell+
							"&phone_work="+phone_work+
							"&phone_ext="+phone_ext+
							"&address="+address+
							"&address2=" +address2+
							"&city="+city+
							"&state="+state+
							"&zip_code="+zip_code+
							"&county="+county+
							"&country="+country+
							"&email_address="+email_address+
							"&dob="+dob+
							"&ip_address="+ip_address+
							"&src="+src+
							"&type="+type+
							"&landing_page="+landing_page+
							"&gender="+gender+
							"&height_feet="+height_feet+
							"&height_inches="+height_inches+
							"&weight="+weight+
							"&tobacco_use="+tobacco_use+
							"&insurance_type="+insurance_type+
							"&jornaya_lead_id="+jornaya_lead_id+
							"&trusted_form_token="+trusted_form_token+
							"&opt_in_date_time="+opt_in_date_time+
							"&household_income="+household_income+
							"&sub_id="+sub_id+
							"&currently_insured="+currently_insured+
							"&pub_id="+pub_id+
							"&name="+name+
							"&lp_key="+lp_key+
							"&campaign_id="+campaign_id+
							"&data_array="+JSON.stringify(json_array);	
		alert(dataString);
		$('#loader').show();
		$.when(send_ajax(dataString, "ajax/upload_script.ajax.php?type=upload_lead_data", "full")).done(function(data){
			alert(data);
			window.location = 'main.php?page=modify';
		});							

		return false;		
	})
	
	$(document).on("click", '#map_leads', function() {	
		
		jason_array_clean = JSON.stringify(json_array).replace('&','')

		dataString = "data_array="+jason_array_clean;	
		//alert(dataString);
		$.when(send_ajax(dataString, "ajax/upload_script.ajax.php?type=upload_leads")).done(function(data){
			alert(data);
		});							

		return false;		
	})
	
	$(document).on("click", '#map_calls', function() {	

		jason_array_clean = JSON.stringify(json_array).replace('&','')

		dataString = "data_array="+jason_array_clean;	

		//dataString = "data_array="+JSON.stringify(json_array);	
		alert(dataString);
		$.when(send_ajax(dataString, "ajax/upload_script.ajax.php?type=upload_calls", "full")).done(function(data){
			alert(data);
		});							

		return false;		
	})
	
	
}