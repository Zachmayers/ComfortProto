	function info() {
	
	$(".info_button").click(function() {
		box = $(this).attr("ID");
		
		$(".page_list").hide();
		$("#" + box + "_box").show('fast');
		return false;
	});
	
}