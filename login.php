<?php
	include("includes/config.php");
	include("includes/classes/Account.php");
	include("includes/classes/Constants.php");

	$account = new Account($con);

	include("includes/handlers/login-handler.php");

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
				<form id="loginForm" action="browse.php" method="POST">
					<h2>Login to your account</h2>
					<p>
						<label for="loginUsername">Username</label>
						<input id="loginUsername" name="loginUsername" type="text" placeholder="e.g. Big Tuna" value="<?php getInputValue('loginUsername') ?>" required> 
					</p>

					<p>
						<label for="loginPassword">Password</label>
						<input id="loginPassword" name="loginPassword" type="password" required>
					</p>

					<?php echo $account->getError(Constants::$loginFailed); ?>

					<button type="submit" name="loginButton">log in</button>

					<div class="hasAccountText">
						<a href="signup.php">Don't have an account yet?</a>
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
</html>