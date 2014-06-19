var gameTime = 60;
var score = 0;
var random;
var mole;
var gameOn;
var delay = 1000;
var player;

//start button
$('#gameOn').click(function(event){
	//start cryo sound
	$('#cryo')[0].play();
	//starting the interval with two seconds between each 'mole'
	gameOn =  setInterval(function(){

		random = Math.round(Math.random()*8);
		mole = $('.mole')[random];

		$(mole).fadeIn(200).delay(delay).fadeOut(300);

		$(mole).on('click', function(){
			$(this).fadeOut(100);
		});

	}, 2000);

	//when a mole is clicked, trigger sound, add to score, decrease delay between moles
	$('.mole').on('click', function(){
		$('#laser')[0].play();
		$('#score').html(score += 1);
		switch(score)
		{
			case 3: delay = 600;
			break;
			case 8: delay = 400;
			break;
			case 15: delay = 200;
			break;
		}
	});

	//timer
	continueGame();
});
//when gameover, change to all done screen, change button to reload button, clear interval
function gameOver(){
	clearInterval(gameOn);
	$('#box').addClass('gameover').html('<p>All done!</p>').css('border', 'none');
	$('#gameOn').click(function(){
		location.reload();
	});

	// if(score > 0)
	// {
	// 	player = prompt('High Score! Enter in your name:');
	// }
	// else
	// {
	// 	alert('YOU SUCK!');
	// }
}

//timer function
function continueGame(){
	setTimeout(function(){
		gameTime--;
		$('#timer').html(gameTime);

		if (gameTime > 0)
		{
			continueGame();
		}
		else
		{
			gameOver();
		}
	}, 1000);
}
