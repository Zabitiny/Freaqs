<?php
// functions for cleaning up user input
function sanitizeFormPassword($inputText) {
	$inputText = strip_tags($inputText); // disallows people from entering php txt into fields so that they don't hack me
	return $inputText;
}

function sanitizeFormUsername($inputText) {
	$inputText = strip_tags($inputText);
	$inputText = str_replace(" ", "", $inputText); // gets rid of spaces
	return $inputText;
}

function sanitizeFormString($inputText) {
	$inputText = strip_tags($inputText);
	$inputText = str_replace(" ", "", $inputText);
	$inputText = ucfirst(strtolower($inputText));
	return $inputText;
}

// register button pressed
if(isset($_POST['registerButton'])){
	// cleans up data inputed from user
	$username = sanitizeFormUsername($_POST['username']);
	$firstName = sanitizeFormString($_POST['firstName']);
	$lastName = sanitizeFormString($_POST['lastName']);
	$email = sanitizeFormString($_POST['email']);
	$email2 = sanitizeFormString($_POST['email2']);
	$password = sanitizeFormPassword($_POST['password']);
	$password2 = sanitizeFormPassword($_POST['password2']);

	if($account->register($username, $firstName, $lastName, $email, $email2, $password, $password2)) {
		$_SESSION['userLoggedIn'] = $username;
		header("Location: index.php");
	}
}

?>