$(document).ready(loadCanvas);

function loadCanvas(){
    var mainCanvas = document.getElementById('mainCanvas');
    var context = mainCanvas.getContext("2d");  

    // Variables para almacenar la posición inicial del ratón
    var drawing = false;
    var startX, startY;
    
    // Drawing mode true = draw / erase
    var drawingMode = true;
    var drawing = false;

    document.getElementById('drawMode').addEventListener('click', function() {
        drawingMode = true;
    });

    document.getElementById('eraseMode').addEventListener('click', function() {
        drawingMode = false;
    });

    // Configura eventos de ratón
    mainCanvas.addEventListener('mousedown', function(e) {
      drawing = true;
      startX = e.clientX - mainCanvas.getBoundingClientRect().left;
      startY = e.clientY - mainCanvas.getBoundingClientRect().top;
    });
    
    mainCanvas.addEventListener('mousemove', function(e) {
      if (!drawing) return;
    
      var x = e.clientX - mainCanvas.getBoundingClientRect().left;
      var y = e.clientY - mainCanvas.getBoundingClientRect().top;
    
      if(drawingMode){
        // Dibuja la línea
        context.beginPath();
        context.moveTo(startX, startY);
        context.lineTo(x, y);
        context.stroke();
        
        // Actualiza la posición inicial para la próxima línea
        startX = x;
        startY = y;
      } else {
        context.clearRect(x - 5, y - 5, 50, 50);
      }
    });
    
    mainCanvas.addEventListener('mouseup', function() {
      drawing = false;
    });
    
    mainCanvas.addEventListener('mouseout', function() {
      drawing = false;
    });

    saveButton = document.getElementById("saveButton")
    saveButton.addEventListener("click", function() {
      var imageData = mainCanvas.toDataURL();
      var XmlRequest = new XMLHttpRequest();
    
      XmlRequest.onreadystatechange = function() {
          if (XmlRequest.readyState === 4) {
              if (XmlRequest.status === 200) {
                  console.log(XmlRequest.responseText);
              } else {
                  console.error("Error in the request. Status code: " + XmlRequest.status);
              }
          }
      };
    
      XmlRequest.onerror = function() {
          console.error("An error ocurred while saving!.");
      };
    
      XmlRequest.open("POST", "view/adminSignature/saveSignature.php", true);
      XmlRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      XmlRequest.send("image=" + encodeURIComponent(imageData));
    });
}
