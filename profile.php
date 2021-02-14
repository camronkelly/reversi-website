<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit();
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'YMRZc0TG09eLa8yy';
$DATABASE_NAME = 'reversi';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$stmt = $con->prepare('SELECT firstname, lastname, age, gender, location FROM players WHERE id = ?');

$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($firstname,$lastname,$age,$gender,$location);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
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
			<h2>Profile Page</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>First Name:</td>
						<td><?=$firstname?></td>
					</tr>
					<tr>
						<td>Last Name:</td>
						<td><?=$lastname?></td>
                    </tr>
                    <tr>
						<td>Age:</td>
						<td><?=$age?></td>
                    </tr>
                    <tr>
						<td>Gender:</td>
						<td><?=$gender?></td>
                    </tr>
                    <tr>
						<td>Location:</td>
						<td><?=$location?></td>
                    </tr>
				</table>
			</div>
		</div>
	</body>
</html>