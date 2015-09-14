// JavaScript Document
// Functionality for Vehicle Edit feature

$(document).ready(function(e) {
	// Initial Fade Out
	$("#edit-panel").fadeOut(0);
    // Edit button clicked: open #edit-panel
	$('.edit').click(function(){
		// Set fade div height
		var fade_height = $('#vehicles').height();
		$('#edit-panel').css("height", fade_height);
		// Fade in
		$('#edit-panel').fadeIn(200, "swing");
		// Focus on form
		$('#v-year').focus();
	});
	
	
	
	
	
});// End $(document).ready()
	