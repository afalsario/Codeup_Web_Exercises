<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	var_dump($_GET);
	var_dump($_POST);
?>

	<form method="POST" action="">
    <p>
        <label for="username">Username</label>
        <input id="username" name="username" type="text" placeholder="Username">
    </p>
    <p>
        <label for="password">Password</label>
        <input id="password" name="password" type="password" placeholder="Password">
    </p>
    <p>
        <input type="submit" value="Log In">
    </p>
</form>

</body>
</html>
