<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test</title>
</head>
<body>
	<form method="post">				
		<label for="username">&emsp;Username:&emsp;</label>
		<input type="text" id="username" name="username" value=""><br><br>
		<label for="password">&emsp;Password:&emsp;</label>
		<input type="password" id="password" name="password" value=""><br><br>

		<button type="submit" name="btn-user">New user</button><br><br>
	</form>
</body>
</html>

<?php
	include_once 'PasswordManager.php';

	$pass = $_POST['password'];
	$uname = $_POST['username'];

	$pm = new PasswordManager($uname,$pass);

	if(isset($_POST["btn-user"])) {

		if($pm->setNewPassword($pass)){
			echo '<p>Password is valid.</p>';
			$pm->storeUser();
		echo '<p>Account has been stored.</p>';	
		}else{
			$err = $pm->validatePassword($pass);
			echo $err;
		}
	}
?>