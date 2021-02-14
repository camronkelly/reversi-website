<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit();
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
                <h1>Reversi</h1>
                <a href="home.php"><i class="fas fa-home"></i>Home</a>
                <a href="game.php"><i class="fas fa-chess-board"></i>Game</a>
                <a href="help.php"><i class="fas fa-question"></i>Help</a>
                <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>  
                <a href="about.php"><i class="fas fa-robot"></i></i>About</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>About</h2>
			<div>
				<p>Each of the disks' two sides corresponds to one player.
                    Dark must place a piece with the dark side up on the board, 
                    in such a position that there exists at least one straight 
                    (horizontal, vertical, or diagonal) occupied line between the new piece and another dark piece,
                    with one or more contiguous light pieces between them. <br><br>
                
                    After placing the piece, dark turns over (flips, captures) all light pieces lying on a straight 
                    line between the new piece and any anchoring dark pieces. All reversed pieces now show the dark side, 
                    and dark can use them in later moves—unless light has reversed them back in the meantime. 
                    In other words, a valid move is one where at least one piece is reversed.<br><br>
                
                    Players take alternate turns. If one player can not make a valid move, play 
                    passes back to the other player. When neither player can move, the game ends. 
                    This occurs when the grid has filled up or when neither player can legally 
                    place a piece in any of the remaining squares. This means the game may end before the 
                    grid is completely filled. This possibility may occur because one player has no pieces 
                    remaining on the board in that player's color. In over-the-board play this is generally 
                    scored as if the board were full 
                
                </p>
			</div>
		</div>
	</body>
</html>