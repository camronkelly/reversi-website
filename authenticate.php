<?php
session_start();
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'YMRZc0TG09eLa8yy';
$DATABASE_NAME = 'reversi';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if ( !isset($_POST['username'], $_POST['password']) ) {
	die ('Please fill both the username and password field!');
}

// Prepare SQL
if ($stmt = $con->prepare('SELECT id, password FROM players WHERE username = ?')) {
	// Bind parameters
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
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
?>