<!DOCTYPE html>
<html>

	<head>
		<title>Homepage</title>
		<link rel="stylesheet" type="text/css" href="css/topBar.css">
		<link rel="stylesheet" type="text/css" href="css/homePage.css">
	</head>

<body>
	<div class = "topBar">
		<img class = "logo" src = "css/img/logo.png">
    	<div class = "title">Deck Builder</div>
	</div>
	<div class = "mainContainer">
		<div class = "leftContainer">
			<div class = "loginContainer">
				<div class="formText"><strong>Enter User  Name and Password</strong></div>
			   <form action="userpwFormProcessing.php" method="post">
			      Username: <input type="text" name="username" value="" /><br/>
			      Password: <input type="password" name="password" value="" /><br/>
			      <br/>
			      <?php
			      	parse_str($_SERVER['QUERY_STRING']);
			      	if (isset($attempt))
			      	{
				      	if($attempt == 'failed')
				      	{
				     		echo "<strong style = \"color: red\">Your username or password is incorrect!</strong><br/>";
						}
					}
			      ?>
			      <input class="loginButton" type="submit" name="submit" value="Login"/>
			   </form>
				   <a href="createAccount.php") style="text-decoration:none">
				   	<input class="createButton" type="button" name="createAccount" value="Create Account"/>
				   </a>
		   </div>
		</div>
		<div class = "rightContainer">
		<div class="outerContainer">
			<a href="allCards.php">
				<div class="allCardsContainer"></div>
			</a>
			</div>
		</div>
	</div>
</body>
</html>

