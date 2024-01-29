window.onload = loadCanvas;
function loadCanvas(){
    var canvas = document.getElementById("menuCanvas");
    var context = canvas.getContext("2d");

    context.fillStyle = "blue";
    context.fillRect(50, 50, 100, 75);
}