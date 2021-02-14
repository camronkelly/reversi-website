var Board = (function() {

  var canvas = document.getElementById('canvas'),
      context = canvas.getContext('2d');
  var colors = {
    board: '#005c00',
    grid: '#007100',
    hint: '#42a842'
  };
  var size;
  var gridSize = 8;
  var drawGridLines = function() {
    context.strokeStyle = colors.grid;
    canvas.style.border = '4px solid ' + '#000000';
    context.lineWidth = 1;
    for (var i = 0; i < gridSize; i++) {
      context.moveTo(0, i * size);
      context.lineTo(gridSize * size, i * size);
      context.stroke();
      context.moveTo(i * size, 0);
      context.lineTo(i * size, gridSize * size);
      context.stroke();
    }
  };

  var addListeners = function(clickCallback) {
    canvas.addEventListener('click', function(event) {
      var x = event.offsetX, y = event.offsetY;
      clickCallback(Math.floor((x / canvas.width) * gridSize),
                    Math.floor((y / canvas.height) * gridSize));
    });
  };

  var clearCell = function(x, y) {
    context.fillStyle = colors.board;
    context.fillRect(x * size + 1, y * size + 1, size - 2, size - 2);
  };
  var placePiece = function(x, y, color) {
    clearCell(x, y);
    context.fillStyle = color;
    context.beginPath();
    context.arc(x * size + size / 2, y * size + size / 2, size / 2 - 4, 0, 2 * Math.PI, false);
    context.closePath();
    context.fill();
  };
  var placeHint = function(x, y) {
    context.fillStyle = '#42A842';
    context.fillRect(x * size + 1, y * size + 1, size - 2, size - 2);
  };
  
  var changeBoardColor = function(newColor){
    board.colors = newColor;
    Board.init(size, onClick);
  }
  return {
    clearCell: clearCell,
    placePiece: placePiece,
    placeHint: placeHint,
    init: function(_size, clickCallback) {

      size = _size;
      gridSize = document.getElementById("gridSize").value;
      colors.board = document.getElementById("boardColor").value
      canvas.width = canvas.height = size * gridSize;
      context.fillStyle = colors.board;
      context.fillRect(0, 0, size * gridSize, size * gridSize);
      drawGridLines();
      addListeners(clickCallback);
    }
  };

})();
