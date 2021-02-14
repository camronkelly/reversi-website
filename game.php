<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit();
}
?>

<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'YMRZc0TG09eLa8yy';
$DATABASE_NAME = 'reversi';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

$columns = array('Player','Score','Time');

$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

if ($result = $con->query('SELECT * FROM games ORDER BY ' .  $column . ' ' . $sort_order)) {
	$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
	$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
	$add_class = ' class="highlight"';
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
  <style>
  
    
  </style>
</head>

<body class = "loggedin">

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
  <br>

  <div class="content">
    <div>
    <h2>Game</h2>
    <br>
  <div style="text-align:center">
    <div class = "timecontainer">
      Time: <span id="time" style="font-size:22px" ></span>
    </div>
  </div>
    <br>
  <div class = "gamecontainer">
    <canvas id="canvas"></canvas>
  </div>

  <div class = "gameButtonContainer">
    <div class = gameButtonContainer2>
      <div >
          <button id="settingsBtn" class = "settingsBtn" style="float:left">Settings</button><button id="resetbtn" class = "settingsBtn" style = "float:right" onclick = "Game.init(70); resetTimer();startTimer()">Reset</button>
      </div>
    </div>   
  </div>
  
  <div>Current Player: <span id = "currentPlayer"></span></div>
  <div><span id = "numBlack"></span></div>
  <div><span id = "numWhite"></span></div>

  <div id="settingsModal" class="settingsModal">

        <div class="settingsModalOpen">
          <span class="close">&times;</span>
          <h2>Game Settings</h2>
          <p style="font-weight: bold">Choose a grid size:</p>
            <select name = "grid size" id = "gridSize">
              <option value='8' selected>8</option>
              <option value='6'>6</option>
              <option value='4'>4</option>
            </select>
            
          <p style="font-weight: bold">Choose a color for the Board:</p>
            <select name = "board color" id = "boardColor">
              <option value='Green' selected>Green</option>
              <option value='Blue'>Blue</option>
              <option value='Black'>Black</option>
              <option value='Purple'>Purple</option>
            </select>
    
          <p style="font-weight: bold">Choose a color for player one:</p>
            <select name = "player one color" id = "playerOne">
              <option value='Black' selected>Black</option>
              <option value='Blue'>Blue</option>
              <option value='Green'>Green</option>
              <option value='Purple'>Purple</option>
            </select>
    
          <p style="font-weight: bold">Choose a color for player two:</p>
            <select name = "player two color" id = "playerTwo">
              <option value='White' selected>White</option>
              <option value='Blue'>Blue</option>
              <option value='Green'>Green</option>
              <option value='Purple'>Purple</option>
            </select>

          <p style="font-weight: bold">Choose a Mode:</p>
            <select name = "mode" id = "mode">
              <option value='0' selected>Single Player</option>
              <option value='1'>Two Player </option>
            </select>
    
          <p>
            <button type = submit id = "submitSettings">Submit</button>
            <button type= "reset" id = "cancel" value="Cancel">Cancel</button>
            <button id = "default" value = "Default">Default</button>
          </p>
        </div>
      </div>
  </div>
  <div>
    <div>
      <button id="submitScore" class = "submitScore" style="float:left">Submit Score</button><br><br>
    </div>
			    <table>
          <tr>
            <th><a href="game.php?column=Player&order=<?php echo $asc_or_desc; ?>">Player<i class="fas fa-sort<?php echo $column == 'Player' ? '-' . $up_or_down : ''; ?>"></i></a></th>
				    <th><a href="game.php?column=Score&order=<?php echo $asc_or_desc; ?>">Score<i class="fas fa-sort<?php echo $column == 'Score' ? '-' . $up_or_down : ''; ?>"></i></a></th>
				    <th><a href="game.php?column=Time&order=<?php echo $asc_or_desc; ?>">Time<i class="fas fa-sort<?php echo $column == 'Time' ? '-' . $up_or_down : ''; ?>"></i></a></th>
				    </tr>
				    <?php while ($row = $result->fetch_assoc()): ?>
				    <tr>
					  <td<?php echo $column == 'Player' ? $add_class : ''; ?>><?php echo $row['Player']; ?></td>
					  <td<?php echo $column == 'Score' ? $add_class : ''; ?>><?php echo $row['Score']; ?></td>
					  <td<?php echo $column == 'Time' ? $add_class : ''; ?>><?php echo $row['Time']; ?></td>
				    </tr>
				    <?php endwhile; ?>
			    </table>

    </div>
  </div>
</body>

<script src="settings.js"></script>
<script src="timer.js"></script>
<script src="board.js"></script>
<script src="game.js"></script>
<script>
settings();
show();
startTimer();
Game.init(70);
</script>



</html>

<?php
	    $result->free();
    }
?>