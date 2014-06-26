<?php

class InvalidInputException extends Exception{}


//-------------1. Establish DB Connection
$dbc = new PDO('mysql:host=127.0.0.1;dbname=address_book', 'ashley', 'password');

// Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try
{
	if(!empty($_POST['new_name']) && !empty($_POST['new_number']))
	{
		$stmt = $dbc->prepare('INSERT INTO contact (first_name, phone_number) VALUES (:new_name, :new_number)');
		$stmt->bindValue(':new_name', $_POST['new_name'], PDO::PARAM_STR);
		$stmt->bindValue(':new_number', $_POST['new_number'], PDO::PARAM_STR);
		$stmt->execute();
	}
	else
	{
		throw new InvalidInputException("Please enter valid data");
	}

}
catch (InvalidInputException $e)
{
	$e->getMessage();
}

$limit = 4;
$offset = 0;

//preparing data from the table so that it shows a limit of items and an offset for pagination
$query = 'SELECT * FROM contact LIMIT :limit OFFSET :offset';
$stmt = $dbc->prepare($query);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

//-------------5. Query for todos on current page.
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<html>
<head>
	<title>Address Book</title>
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/address.css">
</head>
<body>
	<div class="container">
		<h2>Address Book</h2>
		<table class="table table-striped">
			<th>Id</th>
			<th>Name</th>
			<th>Phone Number</th>
			<th>Actions</th>
			<? foreach($contacts as $contact):?>
				<tr>
					<td><?= $contact['con_id'] ?></td>
					<td><?= $contact['first_name'] ?></td>
					<td><?= $contact['phone_number'] ?></td>
					<td>
						<button class="btn btn-primary">View</button>
						<button class="btn btn-danger">Remove</button>
					</td>
				</tr>
			<? endforeach; ?>
		</table>
	</div>
	<div>
		<h2>Add New Contact</h2>
		<? if(isset($e)): ?>
		<?= $e->getMessage(); ?>
		<? endif; ?>
		<form method="POST">
			<input type="text" name="new_name" id="new_name" placeholder="Name">
			<input type="text" name="new_number" id="new_number" placeholder="Phone Number">
			<button type="submit" class="btn btn-success">Add Contact</button>
		</form>
	</div>

</body>
</html>
