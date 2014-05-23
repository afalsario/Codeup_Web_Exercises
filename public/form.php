<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	var_dump($_GET);
	echo "<br>";
	var_dump($_POST);
	echo "<br>";
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
			<label for="saved_folder">
				Save a copy to my sent folder<input type="checkbox" id="saved_folder" name="saved_folder" value="Yes" checked>
			</label>
		</p>
		<p>
			<button type="submit">Submit</button>
		</p>
		</form>

		<h2>Multiple Choice Test</h2>
		<form method="POST">
			<p>
				Am I excited for the weekend?
				<label for="1Yes">Yes<input type="radio" id="1Yes" name="1form"></label>
				<label for="1No">No<input type="radio" id="1No" name="1form"></label>
			</p>
			<p>
				Am I doing anything fun?
				<label for="Yes">Yes<input type="radio" id="Yes" name="2form"></label>
				<label for="No">No<input type="radio" id="No" name="2form"></label>
			</p>
			<p>
				What are my favorite movie genres?

				<label for="comedy">Comedy<input type="checkbox" id="comedy" name="movies[]" value="comedy">

				<label for="thriller">Thriller<input type="checkbox" id="thriller" name="movies[]" value="thriller"></label>

				<label for="action">Action<input type="checkbox" id="action" name="movies[]" value="action"></label>

				<label for="romance">Romance<input type="checkbox" id="romance" name="movies[]" value="romance"></label>
			</p>
			<p>
			<button type="submit">Submit</button>
		</p>
		</form>

</body>
</html>
