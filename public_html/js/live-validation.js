$(document).ready(function(){

	// Listen to the username input field
	$('#username').blur(validateUsername);

});

// Function to validate the username
function validateUsername() {

	// Get the username and save into a variable
	var username = $(this).val();

	// Check the length of the username
	if( username.length < 5 ) {
		// Too short
		$('#username-message').html('<p style:"color:red;">Must be at least 5 characters</p>');
		return;
	} else if( username.length > 20 ) {
		// Too long
		$('#username-message').html('Must be less than 20 characters');
		return;
	} else {
		// Good to go
		$('#username-message').html('');
	}

	// Prepare data for the server
	var dataForServer = {
		username: username
	} 

	// Send the username to the server to be checked
	$.ajax({
		type: 'post',
		url: 'api/validate-username.php',
		data: dataForServer,
		success: function( responseFromServer ) {

			$('#username-message').html( responseFromServer );

		},
		error: function() {
			alert('Something went wrong');
		}
	});



}