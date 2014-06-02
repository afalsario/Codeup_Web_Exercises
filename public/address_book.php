<?
	// echo "<h1>GET</h1>";
	// var_dump($_GET);
	// echo "<br>";
	// echo "<h1>POST</h1>";
	// var_dump($_POST);
	// echo "<br>";
// function to store new entries

$contacts = $_POST;

foreach($contacts as $type => $value)
{
	echo "<table><tr><td>{$value}</td></tr></table>";
}


// validate 5 required fields: name, address, city, state and zip

// display error if information is missing

// save information to a csv file


// display information





?>
<html>
<head>
	<title></title>
</head>
<body>
	<!-- forms for last and first name -->
	<form method="POST">
	<label for="contact_name">Name </label>
		<input type="text" id="contact_name" name="contact_name" value="Ashley Falsario">
	<br>

	<!-- form for address -->
		<label for="address">Address </label>
		<input type="text" id="address" name="address" value="782 Crestway Drive">
	<br>

	<!-- form for city -->
		<label for="city">City </label>
		<input type="text" id="city" name="city" value="San Antonio">
	<br>

	<!-- form for state -->
		<label for="state">State </label>
		<input type="text" id="state" name="state" value="TX">
	<br>

	<!-- form for zip -->
		<label for="zip_code">Zip Code </label>
		<input type="text" id="zip_code" name="zip_code" value="78239">
	<br>


	<!-- form for phone -->
		<label for="phone_number">Phone Number </label>
		<input type="text" id="phone_number" name="phone_number" value="(210) 319-8669">
	<br>

	<input type="submit">
</form>

</body>
</html>
