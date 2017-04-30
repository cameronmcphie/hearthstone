<!DOCTYPE html>
<html>
	<head>
		<title>Create Account</title>
		<link rel="stylesheet" type="text/css" href="css/topBar.css">
		<link rel="stylesheet" type="text/css" href="css/createAccount.css">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	</head>
<body>
	<div class = "topBar">
		<img class = "logo" src = "css/img/logo.png">
    	<div class = "menuBar">
    		<a class="w3-btn w3-ripple w3-red left-button" href="index.php">Cancel</a>
    	</div>
    	<div class = "title">Create Account</div>
	</div>
	<div class="mainContainer">
		<div class="formContainer">
			<strong>Create Account:</strong>
			<form action="createAccountProcessing.php" method="post">
				Username: <input type="text" name="username" value="" /><br/>
				Password: <input type="password" name="password" value="" /><br/>
				<br/>
				<?php
					parse_str($_SERVER['QUERY_STRING']);
					if (isset($attempt))
					{
				  	if($attempt == 'failed')
				  	{
				 		echo "<strong style = \"color: red\">The username is already taken!</strong><br/>";
					}
				}
				?>
				<input class="loginButton" type="submit" name="submit" value="Create Account"/>
			</form>
		</div>
	</div>
</body>