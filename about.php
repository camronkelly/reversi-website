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
				<p>Author: Camron Kelly</p>
			</div>
		</div>
	</body>
</html>