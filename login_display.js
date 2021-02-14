var login_display = function()
{
var modal = document.getElementById("loginModal");
var modal2 = document.getElementById("registerModal");

var btn = document.getElementById("loginBtn");
var btn2 = document.getElementById("registerBtn");


var span = document.getElementsByClassName("closeLogin")[0];
var span2 = document.getElementsByClassName("closeRegister")[0];

var submit = document.getElementById("submit");


btn.onclick = function() {
  modal.style.display = "block";
}

btn2.onclick = function() {
  modal2.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}
span2.onclick = function() {
  modal2.style.display = "none";
}

window.addEventListener("click", function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
  if (event.target == modal2) {
    modal2.style.display = "none";
  }
});

}
