<!DOCTYPE html>
<html>
	<head>
		<title>Create Account</title>
		<link rel="stylesheet" type="text/css" href="css/topBar.css">
		<link rel="stylesheet" type="text/css" href="css/createAccount.css">
	</head>
<body>
	<div class = "topBar">
		<img class = "logo" src = "css/img/logo.png">
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