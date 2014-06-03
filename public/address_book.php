<?
	// echo "<h1>GET</h1>";
	// var_dump($_GET);
	// echo "<br>";
	// echo "<h1>POST</h1>";
	// var_dump($_POST);
	// echo "<br>";

$filename = "address_book.csv";
$address_book = [];
$new_contact = $_POST;

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

function read_csv($file)
{
	$handle = fopen($file, 'r');
	$array = [];
	while(!feof($handle))
	{
		$row = fgetcsv($handle);
		if(is_array($row))
		{
			$array[] = $row;
		}
	}
	fclose($handle);
	return $array;
}

;

$address_book = read_csv($filename);
$isValid = false;

if(isset($_GET['index']))
{
	$index = $_GET['index'];
	unset($address_book[$index]);
	$address_book = array_values($address_book);
}

if (!empty($new_contact['name']) && !empty($new_contact['address']) && !empty($new_contact['city']) && !empty($new_contact['state']) && !empty($new_contact['zip_code']))
{
	if(empty($new_contact['phone']))
	{
		echo " ";
	}
	$isValid = true;
	if($isValid)
	{
		array_push($address_book, $new_contact);
	}
}
else
{
	echo "Please enter valid data.";
}
var_dump($address_book);

save_contact($address_book, $filename);
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
			<th>Name</th><th>Address</th><th>City</th><th>State</th><th>Zip Code</th><th>Phone Number</th><th>Remove</th>
		</tr>
	<? foreach($address_book as $index => $contact): ?>
		<tr>
		<? foreach ($contact as $value): ?>
			<!-- validate 5 required fields: name, address, city, state and zip -->
			<?= "<td>" . htmlspecialchars(strip_tags($value)) . "</td>"?>
			<!-- save information to a csv file -->
		<? endforeach; ?>
		<td><?="<a href=\"/address_book.php?index={$index}\">Remove Item</a>";?></td>
		</tr>
	<? endforeach; ?>
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
