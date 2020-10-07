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
				<form id="loginForm" action="register.php" method="POST">
					<h2>login to your account</h2>
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
						<a href="signup.php">Don't have an account yet? Sign up here.</a>
					</div>

				</form>
			</div>

			<div id="loginText">
				<h1>made by & for music freaks</h1>
				<h2>the place where you can find your favorite frequencies</h2>
				<ul>
					<li>smooth trainsitions between songs</li>
					<li>different shuffle options</li>
					<li>discuss lyrics with others</li>
					<li>have AI line up your playlist for you</li>
				</ul>
			</div>
		</div>
	</div>

</body>
</html>