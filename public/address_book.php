<?
//initialize empty address book
$address_book = [];

//storing info from the $_POST
$new_contact = $_POST;

$error_message = "";
$errorMessage = '';

//setting a check for all $_POST data
$isValid = false;

//include the AddressDataStore class to read and write files
require_once('classes/address_data_store.php');

//creating a new instance of the class
$ads = new AddressDataStore('address_book.csv');
//accessing the address class and reading the file
$address_book = $ads->read_address_book();


if(!empty($new_contact)){
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
		$error_message = "Please enter valid data.";
	}
}



//if the user clicks a remove link, sets the $_GET and removes the item
if(isset($_GET['index']))
{
	$index = $_GET['index'];
	unset($address_book[$index]);
	$address_book = array_values($address_book);
}

//verify that there were valid uploaded files
if(isset($_FILES['file1']) && ($_FILES['file1']['type'] !== 'text/csv'))
{
	$errorMessage = "ERROR: Please use a csv file";
}
elseif(count($_FILES) > 0 && $_FILES['file1']['error'] == 0)
{
	//set destination for uploaded files
	$upload_dir = '/vagrant/sites/codeup.dev/public/uploads/';
	//get the file name using basename
	$filename = basename($_FILES['file1']['name']);
	// Create the saved filename using the file's original name and our upload directory
	$saved_filename = $upload_dir . $filename;
	// Move the file from the temp location to our uploads directory
	move_uploaded_file($_FILES['file1']['tmp_name'], $saved_filename);
	//add new csv file data and merging it to existing address book
	$new_book = new AddressDataStore($saved_filename);
	$new_book = $new_book->read_address_book();
	$address_book = array_merge($address_book, $new_book);
}

//accesses the class and saves the information to the csv file
$ads->write_address_book($address_book);

?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Address Book</title>
</head>
<body>
<h2 align="center">Address Book</h2>

<!-- 	address book table -->
	<table align="center" border= 1>
		<tr>
			<th>Name</th>
			<th>Address</th>
			<th>City</th>
			<th>State</th>
			<th>Zip Code</th>
			<th>Phone Number</th>
			<th>Remove</th>
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
	<? if(isset($error_message)): ?>
	<p style="color:red"><?= $error_message; ?></p>
	<? endif; ?>
	<!--    FORMS    -->

	<!-- forms for name -->
	<table>
	<form method="POST" action='address_book.php'>
		<tr>
			<td align="right"><label for="name">Name </label></td>
			<td><input type="text" id="name" name="name"></td>
		</tr>

			<!-- form for address -->
		<tr>
			<td align="right"><label for="address">Address </label></td>
			<td><input type="text" id="address" name="address"></td>
		</tr>

			<!-- form for city -->
		<tr>
			<td align="right"><label for="city">City </label></td>
			<td><input type="text" id="city" name="city"></td>
		</tr>

			<!-- form for state -->
		<tr>
			<td align="right"><label for="state">State </label></td>
			<td><input type="text" id="state" name="state"></td>
		</tr>

			<!-- form for zip -->
		<tr>
			<td align="right"><label for="zip_code">Zip Code </label></td>
			<td><input type="text" id="zip_code" name="zip_code"></td>
		</tr>

			<!-- form for phone -->
		<tr>
			<td align="right"><label for="phone_number">Phone Number </label></td>
			<td><input type="text" id="phone_number" name="phone_number"></td>
		</tr>
	</table>
		<input type="submit">
	</form>

<h3>Upload Address Book</h3>
	<? if(isset($errorMessage)): ?>
	<p style="color:red"><?= $errorMessage; ?></p>
	<? endif; ?>
	<form method='POST' enctype="multipart/form-data">
		<input type="file" name="file1">
		<input type="submit" value="Upload">
	</form>

</body>
</html>
