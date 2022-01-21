<?php
	function main_html($member_count, $employee_count, $employer_count, $old_employment) {
?>		
	<div class="container text-center">
		<h1 style="display:inline;">SBC ADMIN PANEL</h1>
		<br /> &nbsp; <br />
			
		<hr>								 
		<h2>Current Stats</h2>	
			<b>Total Members:</b> <? echo $member_count ?><br />
			<b>Employees</b> <? echo $employee_count ?><br />
			<b>Employers</b> <? echo $employer_count ?><br />	
			<br /> &nbsp; <br />
		
		<hr>								 
		<h2>USERS</h2>	
			<a href="admin.php?page=logins">Logins</a> <br />
			<a href="admin.php?page=members&type=employee&number=1">Employees</a><br />
			<a href="admin.php?page=members&type=employer&number=1">Employers</a><br />
			<a href="admin.php?page=stores">Stores</a><br />
			<a href="admin.php?page=profile_pics">All Profile Pics</a><br />
			Month Profile Pics:	<a href="admin.php?page=month_profile_pics&month=01&year=2017">Jan</a>, 
				<a href="admin.php?page=month_profile_pics&month=02&year=2017">Feb</a>, 
				<a href="admin.php?page=month_profile_pics&month=03&year=2017">Mar</a>, 
				<a href="admin.php?page=month_profile_pics&month=04&year=2017">Apr</a>, 
				<a href="admin.php?page=month_profile_pics&month=05&year=2017">May</a>, 
				<a href="admin.php?page=month_profile_pics&month=06&year=2017">Jun</a>, 
				<a href="admin.php?page=month_profile_pics&month=07&year=2017">Jul</a>, 
				<a href="admin.php?page=month_profile_pics&month=08&year=2017">Aug</a>, 
				<a href="admin.php?page=month_profile_pics&month=09&year=2017">Sep</a>, 
				<a href="admin.php?page=month_profile_pics&month=10&year=2017">Oct</a>, 
				<a href="admin.php?page=month_profile_pics&month=11&year=2017">Nov</a>, 
				<a href="admin.php?page=month_profile_pics&month=12&year=2017">Dec</a>		 
			<br />
			<a href="admin.php?page=gallery_pics">All Gallery Pics</a><br />
			Month Gallery Pics:	<a href="admin.php?page=month_gallery_pics&month=01&year=2017">Jan</a>, 
				<a href="admin.php?page=month_gallery_pics&month=02&year=2017">Feb</a>, 
				<a href="admin.php?page=month_gallery_pics&month=03&year=2017">Mar</a>, 
				<a href="admin.php?page=month_gallery_pics&month=04&year=2017">Apr</a>, 
				<a href="admin.php?page=month_gallery_pics&month=05&year=2017">May</a>, 
				<a href="admin.php?page=month_gallery_pics&month=06&year=2017">Jun</a>, 
				<a href="admin.php?page=month_gallery_pics&month=07&year=2017">Jul</a>, 
				<a href="admin.php?page=month_gallery_pics&month=08&year=2017">Aug</a>, 
				<a href="admin.php?page=month_gallery_pics&month=09&year=2017">Sep</a>, 
				<a href="admin.php?page=month_gallery_pics&month=10&year=2017">Oct</a>, 
				<a href="admin.php?page=month_gallery_pics&month=11&year=2017">Nov</a>, 
				<a href="admin.php?page=month_gallery_pics&month=12&year=2017">Dec</a>		 
			<br />

			<a href="admin.php?page=videos">Videos</a><br />
			_________ <br />
			<a href="admin.php?page=create_employer">Create Employer</a><br />	
			_________ <br />
			<a href="admin.php?page=create_culinary">Create Culinary Member</a><br />	

			<br /> &nbsp; <br />			
		
		<h2>JOBS</h2>	
				<a href="admin.php?page=culinary_jobs">CULINARY JOBS</a><br />
		
			<h3 style='margin-left:10px;'>Current</h3>				
			<br /> &nbsp; <br />
			<div style='margin-left:20px;'> 
				<a href="admin.php?page=current_jobs&zip=32801">Orlando</a><br />
				<a href="admin.php?page=current_jobs&zip=33602">Tampa</a><br />
				<a href="admin.php?page=current_jobs&zip=33147">Miami</a><br />
				<a href="admin.php?page=current_jobs&zip=32202">Jacksonville</a><br />
				<a href="admin.php?page=current_jobs&zip=all">All</a><br />
				<a href="admin.php?page=current_jobs&zip=other">Other</a><br />
			</div>

			<h3 style='margin-left:10px;'>Archive</h3>				
			<br /> &nbsp; <br />
			<div style='margin-left:20px;'> 
				<a href="admin.php?page=archive_jobs&zip=32801">Orlando</a><br />
				<a href="admin.php?page=archive_jobs&zip=33602">Tampa</a><br />
				<a href="admin.php?page=archive_jobs&zip=33147">Miami</a><br />
				<a href="admin.php?page=archive_jobs&zip=32202">Jacksonville</a><br />
				<a href="admin.php?page=archive_jobs&zip=all">All</a><br />
				<a href="admin.php?page=archive_jobs&zip=other">Other</a><br />
				<br /> &nbsp; <br />
				<a href="admin.php?page=advertising">ADVERTISING</a><br />	
				<br /> &nbsp; <br />
			</div>

		<hr>	
		
		<h2>SPECIFIC JOB BY ID</h2>
			<b>JobID: </b><input type='text' id='jobID'><br />
			<a href='#' id='view_job'>VIEW JOB</a><br />
		<hr>
				
		<br />
		<h2>MORE STATS</h2>
			<a href="admin.php?page=user_data">Member Data</a><br />
			<a href="admin.php?page=job_data">Job Data</a>
		<br />
		<hr>
		&nbsp; <br />
		<h2>EMPLOYER ITEMS</h2>		
		<a href="admin.php?page=job_templates">Job Templates</a><br />
		<a href="admin.php?page=view_questions">Question Templates</a><br />
		<a href="admin.php?page=view_requirements">Requirement Templates</a>
		
		<h2>EMPLOYEE ITEMS</h2>		
		<a href="admin.php?page=employee_job_titles">Employee Job Titles</a><br />
		<a href="admin.php?page=employee_skills">Employee Skills</a><br />
	</div>		
<?php		
	}//end html_page_main function
	
	function create_culinary_member() {
?>
		<h1 style="display:inline;">SBC ADMIN PANEL</h1>
		<br /> &nbsp; <br />
		<br /> &nbsp; <br />
		<div id='date_error' style='display:none; color:red'>Date Error<br /></div>
		<b>School: </b><input type="text" id="school" name="school"><br />
		<b>Email: </b><input type="text" id="email" name="email"><br />
		<b>Password: </b><input type="text" id="password" name="password"><br />
		<b>Exp. Year: </b><input type="text" id="year" name="year"> (<i>XXXX</i>)<br />
		<b>Exp. Month: </b><input type="text" id="month" name="month"> (<i>XX</i>)<br />
		<b>Exp. Day: </b><input type="text" id="day" name="day"> (<i>XX</i>)<br />
		<b>Admin Pass: </b><input type="text" id="pass" name="pass"><br />

		<div id='success' style='display:none; color:red'>Save Successful<br /></div>
		
		<a href='#' id='save_culinary'>SAVE</a>	
<?php	
	}
?>