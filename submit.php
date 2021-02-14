<?php
session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'YMRZc0TG09eLa8yy';
$DATABASE_NAME = 'reversi';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

$sql = "insert into GAMES (player, score, time) VALUES ('".$_SESSION['name']."', '".$_POST['score']."','".$_POST['time']."')";
mysqli_query( $con, $sql);
?>