<?php

$items_per_page = 4;

function getOffset($items_per_page){
	$page = isset($_GET['page'])? $_GET['page'] : 1;
	return ($page - 1) * $items_per_page;
}

// Get new instance of PDO object
$dbc = new PDO('mysql:host=127.0.0.1;dbname=codeup_pdo_test_db', 'ashley', 'password');

// Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query = 'SELECT * FROM national_parks LIMIT :limit OFFSET :offset';
$stmt = $dbc->prepare($query);
$stmt->bindValue(':limit', $items_per_page, PDO::PARAM_INT);
$stmt->bindValue(':offset', getOffset($items_per_page), PDO::PARAM_INT);
$stmt->execute();

$parks = $stmt->fetchAll(PDO::FETCH_ASSOC);

$count = $dbc->query('SELECT count(*) FROM national_parks')->fetchColumn();
$numPages = ceil($count / $items_per_page);

$page = isset($_GET['page'])?$_GET['page']: 1;
$previous_page = $page - 1;
$next_page = $page + 1;

if(!empty($_POST))
{

	if(!empty($_POST['name']) && !empty($_POST['location']) && !empty($_POST['date_established']) && !empty($_POST['area']) && !empty($_POST['description']))
	{

		$stmt = $dbc->prepare('INSERT INTO national_parks (name, location, date_established, area, description) VALUES (:name, :location, :date_established, :area, :description)');

	    $stmt->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
	    $stmt->bindValue(':location', $_POST['location'], PDO::PARAM_STR);
	    $stmt->bindValue(':date_established', $_POST['date_established'], PDO::PARAM_STR);
	    $stmt->bindValue(':area', $_POST['area'], PDO::PARAM_STR);
	    $stmt->bindValue(':description', $_POST['description'], PDO::PARAM_STR);

	    $stmt->execute();
	}
	else
	{
		echo "this is wrong";
	}
}


?>
<html>
<head>
	<title>National Parks</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>
	<h2>National Parks</h2>
	<div class="table-responsive">
        <table class="table table-striped">
    		<tr>
    			<th>Id</th>
    			<th>Park Name</th>
    			<th>Location</th>
    			<th>Date Established</th>
    			<th>Area in Acres</th>
    			<th>Description</th>
    		</tr>
    		<? foreach($parks as $rows): ?>
    			<tr>
    				<td><?= $rows['id']; ?></td>
    				<td><?= $rows['name']; ?></td>
    				<td><?= $rows['location']; ?></td>
    				<td><?= $rows['date_established']; ?></td>
    				<td><?= $rows['area']; ?></td>
    				<td><?= $rows['description']; ?></td>
    			</tr>
    		<? endforeach; ?>
    	</table>
    </div>

<!---________________ Links ________________ -->
    <ul class="pager">
        <? if(getOFFSET($items_per_page) !== 0): ?>
    	<li><?= "<a href=\"?page={$previous_page}\">Previous</a>"; ?></li>
    	<? endif; ?>
    	<? if($numPages > $page): ?>
    	<li><?= "<a href=\"?page={$next_page}\">"; ?>Next</a></li>
    	<? endif; ?>
    </ul>

	<br>
		<form action='#' method='POST'>
		<table class="form">
			<tr>
				<td><label name="name">Park Name</label></td>
				<td><input type="text" id="name" name="name" value='<?= isset($_POST['name']) ? $_POST['name'] : ' '; ?>'></td>
			</tr>
			<tr>
				<td><label name="location">Location</label></td>
				<td><input type="text" id="location" name="location" value='<?= isset($_POST['location']) ? $_POST['location'] : ' '; ?>'></td>
			</tr>
			<tr>
				<td><label name="date_established">Date Established</label></td>
				<td><input type="date" id="date_established" name="date_established" placeholder="YYYY-MM-DD" value='<?= isset($_POST['date_established']) ? $_POST['date_established'] : ' '; ?>'></td>
			</tr>
			<tr>
				<td><label name="date">Area</label></td>
				<td><input type="text" id="area" name="area" value='<?= isset($_POST['area']) ? $_POST['area'] : ' '; ?>'></td>
			</tr>
			<tr>
				<td><label name="description">Description</label></td>
				<td><textarea name="description"cols="30" rows="4" value='<?= isset($_POST['description']) ? $_POST['description'] : ' '; ?>'></textarea></td>
			</tr>
	   </table>
				<input type='submit' class="submit">
		</form>
</body>
</html>
