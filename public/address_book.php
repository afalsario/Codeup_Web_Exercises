<?
//initialize empty address book
$address_book = [];

//storing info from the $_POST
$new_contact = $_POST;

//creating a new instance of the class
$addresses = new AddressDataStore();

//accessing the address class and reading the file
$address_book = $addresses->read_address_book();

//setting a check for all $_POST data
$isValid = false;

class AddressDataStore
{
    public $filename = 'address_book.csv';

    function read_address_book()
    {
        $handle = fopen($this->filename, 'r');
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

    function write_address_book($addresses_array)
    {
        if(is_writeable($this->filename))
		{
			$handle = fopen($this->filename, 'w');
			foreach ($addresses_array as $fields)
			{
				fputcsv($handle, $fields);
			}
			fclose($handle);
		}
    }
}

//if the user clicks a remove link, sets the $_GET and removes the item
if(isset($_GET['index']))
{
	$index = $_GET['index'];
	unset($address_book[$index]);
	$address_book = array_values($address_book);
}

//checking that all values are filled
if (!empty($new_contact['name']) && !empty($new_contact['address']) && !empty($new_contact['city']) && !empty($new_contact['state']) && !empty($new_contact['zip_code']))
{
	//if phone number is empty, filling it with an empty string
	if(empty($new_contact['phone']))
	{
		echo " ";
	}
	//if the info is there, changes var $isValid to true and pushes the info to the address array
	$isValid = true;
	if($isValid)
	{
		array_push($address_book, $new_contact);
	}
}
else
{
	// display error if information is missing
	echo "Please enter valid data.";
}

//accesses the class and saves the information to the csv file
$addresses->write_address_book($address_book);

?>
<html>
<head>
	<title>Address Book</title>
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
					 <td> <?= htmlspecialchars(strip_tags($value)) ?> </td>
				<? endforeach; ?>
				<td><?="<a href=\"/address_book.php?index={$index}\">Remove Item</a>";?></td>
			</tr>
		<? endforeach; ?>
	</table>

	<!--    FORMS    -->

	<!-- forms for name -->
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
