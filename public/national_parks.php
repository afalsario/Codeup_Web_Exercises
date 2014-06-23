<?

function getOffset(){
	$page = isset($_GET['page'])? $_GET['page'] : 1;
	return ($page - 1) * 4;
}

// Get new instance of PDO object
$dbc = new PDO('mysql:host=127.0.0.1;dbname=codeup_pdo_test_db', 'ashley', 'password');

// Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query = 'SELECT * FROM national_parks LIMIT 4 OFFSET ' . getOffset();
$parks = $dbc->query($query)->fetchAll(PDO::FETCH_ASSOC);

$count = $dbc->query('SELECT count(*) FROM national_parks')->fetchColumn();
$numPages = ceil($count / 4);

$page = isset($_GET['page'])?$_GET['page']: 1;
$previous_page = $page - 1;
$next_page = $page + 1;

?>
<html>
<head>
	<title>National Parks</title>
	
	<style>
	h2{
		text-align: center;
	}
	table, td, th{
		border:1px solid black;
		text-align: center;
	}
	table{
		margin-right: auto;
		margin-left: auto;
	}
	</style>

</head>
<body>
	<h2>National Parks</h2>
	<table>
		<tr>
			<th>Id</th>
			<th>Park Name</th>
			<th>Location</th>
			<th>Date Established</th>
			<th>Area in Acres</th>
		</tr>
		<? foreach($parks as $rows): ?>
			<tr>
				<td><?= $rows['id']; ?></td>
				<td><?= $rows['Park Name']; ?></td>
				<td><?= $rows['Location']; ?></td>
				<td><?= $rows['Date Established']; ?></td>
				<td><?= $rows['Area in Acres']; ?></td>
			</tr>
		<? endforeach; ?>
	</table>

<!---________________ Links ________________ -->
	<? if(getOFFSET() !== 0): ?>
	<?= "<a href=\"?page={$previous_page}\">Previous</a>"; ?>
	<? endif; ?>
	<? if($numPages > $page): ?>
	<?= "<a href=\"?page={$next_page}\">"; ?>Next</a>
	<? endif; ?>

</body>
</html>
