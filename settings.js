var settings = function()
{
var modal = document.getElementById("settingsModal");


var btn = document.getElementById("settingsBtn");


var span = document.getElementsByClassName("close")[0];

var submit = document.getElementById("submitSettings");

var cancel = document.getElementById("cancel");

var _default = document.getElementById("default");

btn.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}

submit.onclick = function(){
  Game.init(70); resetTimer();startTimer()
  modal.style.display = "none";
}

cancel.onclick = function(){
  modal.style.display = "none";
}

_default.onclick = function(){
  document.getElementById("gridSize").value = "8";
  document.getElementById("boardColor").value = "Green";
  document.getElementById("playerOne").value = "Black";
  document.getElementById("playerTwo").value = "White";
  Game.init(70);resetTimer();startTimer()
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
}