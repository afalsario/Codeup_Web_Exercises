<?
	// echo "<h1>GET</h1>";
	// var_dump($_GET);
	// echo "<br>";
	// echo "<h1>POST</h1>";
	// var_dump($_POST);
	// echo "<br>";

$filename = "address_book.csv";
$address_book = [];
$address_book[] = $_POST;

// function to store new entries
function save_contact($contacts, $file)
{
	if(is_writeable($file))
	{
		$handle = fopen($file, 'w');
		foreach ($contacts as $fields)
		{
			fputcsv($handle, $fields);
		}
		fclose($handle);
	}
}

$isValid = false;
var_dump($_POST);
if (!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['zip_code']))
{
	$isValid = true;
	if(empty($_POST['phone_number']))
	{
		array_pop($_POST);
	}
}

if($isValid)
{
	save_contact($address_book, $filename);
}

// display error if information is missing
?>
<html>
<head>
	<title></title>
</head>
<body>
<!-- 	address book table -->

	<table border= 1>
		<tr>
			<th>Name</th><th>Address</th><th>City</th><th>State</th><th>Zip Code</th><th>Phone Number</th>
		</tr>
	<?
		foreach($address_book as $contact)
		{
			foreach ($contact as $type => $value)
			{
				// validate 5 required fields: name, address, city, state and zip
				if (empty($value))
				{
					echo "Please enter valid $type.<br>";
					echo "<td>" . '' . "</td>";
				}
				else
				{
					echo "<td>{$value}</td>";
				// save information to a csv file
				}
			}
		}
	?>
	</table>
	<!-- forms for last and first name -->
	<br>
	<form method="POST" action='address_book.php'>

	<label for="name">Name </label>
		<input type="text" id="name" name="name" value="<? $isValid && $_POST['name'] ? $_POST['name'] : '';?>">
	<br>

	<!-- form for address -->
		<label for="address">Address </label>
		<input type="text" id="address" name="address">
	<br>

	<!-- form for city -->
		<label for="city">City </label>
		<input type="text" id="city" name="city">
	<br>

	<!-- form for state -->
		<label for="state">State </label>
		<input type="text" id="state" name="state">
	<br>

	<!-- form for zip -->
		<label for="zip_code">Zip Code </label>
		<input type="text" id="zip_code" name="zip_code">
	<br>


	<!-- form for phone -->
		<label for="phone_number">Phone Number </label>
		<input type="text" id="phone_number" name="phone_number">
	<br>

	<input type="submit">
</form>

</body>
</html>
