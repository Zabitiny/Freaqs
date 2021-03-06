<?php
	include("includes/config.php");
	include("includes/classes/Account.php");
	include("includes/classes/Constants.php");

	$account = new Account($con);

	include("includes/handlers/signup-handler.php");

	function getInputValue($name){
		if(isset($_POST[$name])){
			echo $_POST[$name];
		}
	}
?>

<!doctype html>
<html>
<head>
	<title>Welcome to The Freaq Show!</title>
	<Link rel="stylesheet" type="text/css" href="assets/css/register.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>

<body>
    <div id="background">
		<div id="loginContainer">	
      <div id="inputContainer">
        <form id="registerForm" method="POST">
					
					<h2>Create your free account</h2>
					<p>
						<?php echo $account->getError(Constants::$usernameCharacters); ?>
						<?php echo $account->getError(Constants::$usernameTaken); ?>
						<label for="username">Username</label>
						<input id="username" name="username" type="text" placeholder="e.g. Big Tuna" value="<?php getInputValue('username') ?>" required> 
					</p>

					<p>
						<?php echo $account->getError(Constants::$firstNameCharacters); ?>
						<label for="firstName">Fist Name</label>
						<input id="firstName" name="firstName" type="text" placeholder="e.g. Jim" value="<?php getInputValue('firstName') ?>" required> 
					</p>

					<p>
						<?php echo $account->getError(Constants::$lastNameCharacters); ?>
						<label for="lastName">Last Name</label>
						<input id="lastName" name="lastName" type="text" placeholder="e.g. Halpert" value="<?php getInputValue('lastName') ?>" required> 
					</p>

					<p>
						<?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
						<?php echo $account->getError(Constants::$emailInvalid); ?>
						<?php echo $account->getError(Constants::$emailTaken); ?>
						<label for="email">Email</label>
						<input id="email" name="email" type="email" value="<?php getInputValue('email') ?>" required> 
					</p>

					<p>
						<label for="email2">Confirm Email</label>
						<input id="email2" name="email2" type="email" value="<?php getInputValue('email2') ?>" required> 
					</p>

					<p>
						<label for="password">Password</label>
						<input id="password" name="password" type="password" required>
						<?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
						<?php echo $account->getError(Constants::$passwordNotAlphaNumeric); ?>
						<?php echo $account->getError(Constants::$passwordCharacters); ?>
					</p>			

					<p>
						<label for="password2">Confirm Password</label>
						<input id="password2" name="password2" type="password" required>
					</p>

					<button type="submit" name="registerButton">sign up</button>

					<div class="hasAccountText">
						<a href="login.php">Already have an account?</a>
					</div>
					
				</form>
			</div>
            
			<div id="loginText">
				
				<h1>Made By & For Music FREAKS</h1>
				<h2>The place with the best frequencies</h2>
				<ul>
					<li>Variety of shuffle options</li>
					<li>Discuss lyrics with others</li>
					<li>Have AI smooth out your queue</li>
				</ul>

			</div>

		</div>
	</div>
</body>