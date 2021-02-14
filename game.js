var script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.4.1.min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);

var Game = (function() {

  var gridSize =8;
  var directions = [
    [1, 0], [-1, 0], [0, -1], [0, 1],
    [-1, -1], [1, -1], [1, 1], [-1, 1]
  ];
  var data = [];
  var colors;
  
  var player = 0;
  var mode;
  var numWhite;
  var numBlack;
  var _currentPlayer;
  var endgame = 0;
  var btn = document.getElementById("submitScore");
  //swap player from 0 to 1 vice versa, put player number into matrix, and place player piece on board
  var place = function(x, y) {
    player ^= 1;
    data[y][x] = player;
    Board.placePiece(x, y, colors[player]);
  };

  //checks cells to see if a move is possible
  //if nearby cells are empty, no move
  //since player number changes before the piece is changed, compare the slot with the previously placed player
  //check outward from the point in a line that extends until the opposite player is found then move is valid
  var canMove = function(x, y, dx, dy) {
    if (data[y + dy] === void 0 || data[y + dy][x + dx] === void 0)
      return false;
    if (data[y + dy][x + dx] === player) {
      for (var _x = x + 2 * dx, _y = y + 2 * dy;; _x += dx, _y += dy) {
        if (data[_y] === void 0 || data[_y][_x] === void 0 ||
            data[_y][_x] === -1)
          return false;
        if (data[_y][_x] === player ^ 1)
          return true;
      }
    }
  };

  //function that handles flipping tokens when a valid move has been made
  var move = function(x, y) {
    var flip = function(dx, dy) {
      if (data[y + dy] === void 0 || data[y + dy][x + dx] === void 0)
        return false;
      for (var _x = x + dx, _y = y + dy;; _x += dx, _y += dy) {
        if (data[_y][_x] === player ^ 1)
          return true;
        data[_y][_x] = player ^ 1;
        Board.placePiece(_x, _y, colors[player ^ 1]);
      }
    };
    directions.forEach(function(e) {
      if (canMove(x, y, e[0], e[1]))
        flip(e[0], e[1]);
    });
  };

  var isValidMove = function(x, y) {
    if (data[y][x] !== -1)
      return false;
    var move = canMove.bind(this, x, y);
    for (var i = 0; i < directions.length; i++) {
      if (move.apply(this, directions[i]))
        return true;
    }
    return false;
  };

  var initData = function() {
    for (var i = 0; i < gridSize; i++) {
      data[i] = [];
      for (var j = 0; j < gridSize; j++) {
        data[i].push(-1);
      }
    }
  };

  var createHints = function() {
    for (var y = 0; y < gridSize; y++) {
      for (var x = 0; x < gridSize; x++) {
        if (isValidMove(x, y)) {
          Board.placeHint(x, y);
        } else if (data[y][x] === -1) {
          Board.clearCell(x, y);
        }
      }
    }
  };

  var noMoves = function(){
    for (var y = 0; y < gridSize; y++) {
      for (var x = 0; x < gridSize; x++) {
        if (isValidMove(x, y)) {
          return false;
        }
      }
    }
    return true;
  }

  var endGame = function(){
    if(noMoves()){
      player^=1;
      if(noMoves()){
        return true;
      }
    }
    return false;
  }
  function formatTime(time) {
    var h = m = s = ms = 0;
    var newTime = '';

    h = Math.floor( time / (60 * 60 * 1000) );
    time = time % (60 * 60 * 1000);
    m = Math.floor( time / (60 * 1000) );
    time = time % (60 * 1000);
    s = Math.floor( time / 1000 );
    ms = time % 1000;

    newTime = pad(h, 2) + ':' + pad(m, 2) + ':' + pad(s, 2) + ':' + pad(ms, 3);
    return newTime;
}
  function submitstuff(){
    var time = formatTime(x.time());
    var score = numBlack; 
    var myData = {'score':score, 'time':time}
    $.ajax({
    type: "POST",
    url : "submit.php",
    data : myData,
    success: function(data){
      console.log(data);
      }
    });
}
btn.onclick = function() {
  submitstuff();
}
  var displayScore = function(){
    document.getElementById("numBlack").innerHTML = document.getElementById("playerOne").value+ ": " + numBlack;
    document.getElementById("numWhite").innerHTML = document.getElementById("playerTwo").value+ ": " + numWhite;
  }
  var currentPlayer = function(){
    
    if(player === 1){_currentPlayer = document.getElementById("playerTwo").value}
    else if(player ===0){_currentPlayer = document.getElementById("playerOne").value}
    document.getElementById("currentPlayer").innerHTML=_currentPlayer;
  }
  var randomMove = function(){
    var X = [];
    var Y = [];
    for(var i = 0; i < data.length;i++){
      for(var j = 0; j < data[i].length;j++){
        if(isValidMove(i,j)){
            X.push(i);
            Y.push(j);
        }
      }
    }

    randomElement = Math.floor(Math.random() * Y.length);
    onClick(X[randomElement],Y[randomElement]);
  }
  var onClick = function(x, y) {
    if (!isValidMove(x, y))
      return;
    move(x, y);
    place(x, y);
    numWhite = 0;
    numBlack = 0;
    for(var i = 0; i < data.length; i++){
      for(var j = 0; j < data[i].length;j++){
        if(data[i][j] === 0){numWhite+=1;}
        else if(data[i][j]===1){numBlack+=1;}
      }
    }
    if(endGame()){
      endgame = 1;
    }
    createHints();
    displayScore();
    currentPlayer();
    if(!endGame() && mode == 0 && player == 1){
      //await sleep(2000);
      //stops working after a few moves with timeout for some reason
      //window.setTimeout(randomMove,1000); 
      randomMove();
    }
    
  };


  return {
    init: function(size) {
      numWhite=2;
      numBlack=2;
      colors = [document.getElementById("playerTwo").value, document.getElementById("playerOne").value];
      gridSize = document.getElementById("gridSize").value;
      mode = document.getElementById("mode").value;
      player = 0;
      displayScore();
      currentPlayer();
      Board.init(size, onClick);
      initData();
      place(gridSize/2, gridSize/2-1); place(gridSize/2-1, gridSize/2-1);
      place(gridSize/2-1, gridSize/2); place(gridSize/2, gridSize/2);
      createHints();
    }
  };

})();

