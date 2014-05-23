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
	<h2>User Login</h2>

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
	        <button type="submit">Log In</button>
	    </p>
		</form>

		<h2>Compose Email</h2>
		<form method="POST">
		<p>
			<label for="email_to">To:</label>
			<input type="text" id="email_to" name="email_to">
		</p>
		<p>
			<label for="email_from">From:</label>
			<input type="text" id="email_from" name="email_from">
		</p>
		<p>
			<label for="subject">Subject:</label>
			<input type="text" id="subject" name="subject">
		</p>
		<p>
			<label for="email_body"></label>
			<textarea id="email_body" name="email_body" rows="20" cols="80"></textarea>
		</p>
		<p>
		<button type="submit">Submit</button>
	</p>
		</form>

</body>
</html>
