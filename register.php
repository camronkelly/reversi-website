<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'YMRZc0TG09eLa8yy';
$DATABASE_NAME = 'reversi';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {

	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if (!isset($_POST['username'], $_POST['password'], $_POST['firstname'],$_POST['lastname'],$_POST['age'],$_POST['gender'],$_POST['location'])) {
	die ('Please complete the registration form!');
}

if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['firstname'])||empty($_POST['lastname'])||empty($_POST['age'])||empty($_POST['gender'])||empty($_POST['location'])) {
	die ('Please complete the registration form');
}


if ($stmt = $con->prepare('SELECT id, password FROM players WHERE username = ?')) {
	
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();

	if ($stmt->num_rows > 0) {
		echo 'Username exists, please choose another!';
	} else {

        if ($stmt = $con->prepare('INSERT INTO players (username, password, firstname, lastname, age, gender, location) VALUES (?, ?, ?, ?, ?, ?, ?)')) {
	        //hash the password 
	        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	        $stmt->bind_param('sssssss', $_POST['username'], $password, $_POST['firstname'],$_POST['lastname'],$_POST['age'],$_POST['gender'],$_POST['location']);
	        $stmt->execute();
	        echo 'You have successfully registered, you can now login!';
        } else {
	        
	        echo 'Could not prepare statement!';
        }
	}
	$stmt->close();
} else {
	
	echo 'Could not prepare statement!';
}
//autologin
session_start();

if ($stmt = $con->prepare('SELECT id, password FROM players WHERE username = ?')) {
	
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();

    $stmt->store_result(); 
}
if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $password);
    $stmt->fetch();

    if (password_verify($_POST['password'], $password)) {
       
        session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['name'] = $_POST['username'];
        $_SESSION['id'] = $id;
        header('Location: home.php');
    } else {
        echo 'Incorrect password!';
    }
} else {
    echo 'Incorrect username!';
}
$stmt->close();
$con->close();
?>