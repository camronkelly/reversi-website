<?php
session_start();

if (isset($_SESSION['loggedin'])) {
	header('Location: home.php');
	exit();
}

?>
      

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>reversi</title>
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="style.css" type = "text/css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
<style>

</style>

<body class = "intro">

<div class = "reversiIntro">Reversi</div>

<div class = "gamePic"><img src="game.png"></div>

<div class = "accountButtonContainer">
  <div class = accountButtonContainer2>
      <div >
        <button id="loginBtn" class="loginBtn">Log In</button><button id="registerBtn"class = "registerBtn">Register</button>
      </div>
  </div>   
</div>


  <div id="loginModal" class ="loginModal">
    <div class = "loginModalOpen">
      <span class="closeLogin">&times;</span>
      <h1>Login</h1>
      <form action="authenticate.php" method="post">

          <label for="username">
            <i class="fas fa-user"></i>
          </label>
          <input type="text" name="username" placeholder="Username" id="username" required>
        
          <label for="password">
           <i class="fas fa-lock"></i>
          </label>
          <input type="password" name="password" placeholder="Password" id="password" required>
              
        <input type="submit" value="Login" id = "submit">
      </form>
      </div>
  </div>


		<div class="registerModal" id = "registerModal">
      <div class = "registerModalOpen">
      <span class="closeRegister">&times;</span>
			<h1>Register</h1>
			<form action="register.php" method="post" autocomplete="off">

				<label for="username">
					<i class="fas fa-user"></i>
				</label>
        <input type="text" name="username" placeholder="Username" id="username2" required>
        
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
        <input type="password" name="password" placeholder="Password" id="password2" required>
        
				<label for="firstname">
          <i class="fas fa-file-signature"></i>
        </label>
        <input type="text" name="firstname" placeholder="First Name" id="firstname" required>

				<label for="lastname">
          <i class="fas fa-file-signature"></i>
        </label>
        <input type="text" name="lastname" placeholder="Last Name" id="lastname" required>

				<label for="age">
          <i class="far fa-calendar-plus"></i>
        </label>
        <input type="text" name="age" placeholder="Age" id="age" required>

        <label for="gender">
          <i class="fas fa-venus-mars"></i>
        </label>
        <input type="text" name="gender" placeholder="Gender" id="gender" required>

				<label for="location">
          <i class="fas fa-map-signs"></i>
        </label>
        <input type="location" name="location" placeholder="Location" id="location" required>
        <input type="submit" value="Register">
      </form>
      </div>
 
		</div>

    
</body>
<script src="login_display.js"></script>
<script>
login_display();
</script>



</html>

