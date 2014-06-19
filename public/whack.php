<?
$fileName = 'whack_highscores.txt';
$scores = [];
//open highScores file
function highScore($filename)
{
	if(is_readable($filename) && filesize($filename) > 0){
		$handle = fopen($filename, 'r');
		$contents = trim(fread($handle, filesize($filename)));
		$scores = explode(PHP_EOL, $contents);
	}
	return $scores;
}

$highScores = highScore($fileName);
?>

<!DOCTYPE HTML>
<html>
<head>
	<title></title>
<script src="/js/jquery-2.1.1.js"></script>
<link rel="stylesheet" href="/css/whack.css">
</head>
<body>
	<h1>Laser Time</h1>
	<button id="gameOn">Bring on the pain!</button>
	<br>
	Timer: <span id="timer">60</span>
	<br>
	Pulses: <span id="score"></span>
	<br>

<div id="highScores">
	<table>
	<th>High Scores</th>
	<? foreach ($highScores as $score):?>
	<tr><td><?= $score; ?></td></tr>
	<? endforeach; ?>
	</table>
</div>

	<audio id="laser" preload="auto">
  		<source src="/sound/laser.wav" type="audio/wav">
	</audio>

	<audio id="cryo" preload="auto">
  		<source src="/sound/cryo.wav" type="audio/wav">
	</audio>

	<div id="box">
		<div class='box'>
			<img class='mole' src="/img/hair.png">
		</div>
		<div class='box'>
			<img class='mole' src="/img/hair.png">
		</div>
		<div class='box'>
			<img class='mole' src="/img/hair.png">
		</div>
		<div class='box' class='left-middle'>
			<img class='mole' src="/img/hair.png">
		</div>
		<div class='box'>
			<img class='mole' src="/img/hair.png">
		</div>
		<div class='box'>
			<img class='mole' src="/img/hair.png">
		</div>
		<div class='box' class="left-bottom">
			<img class='mole' src="/img/hair.png">
		</div>
		<div class='box'>
			<img class='mole' src="/img/hair.png">
		</div>
		<div class='box'>
			<img class='mole' src="/img/hair.png">
		</div>
	</div>

<script src="/js/whack.js"></script>

</body>
</html>
