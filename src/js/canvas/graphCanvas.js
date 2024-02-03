$(document).ready(loadGraphs);

function loadGraphs(){
    fetchData("Product", "Products stock");
    fetchData("Category", "Categories products")
}

function fetchData(model, graphTitle){    
    console.log('index.php?controller=' + model + '&action=fetch' + model + 's');
    $.ajax({
        url: 'index.php?controller=' + model + '&action=fetch' + model + 's',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            if(data.success){
                console.log(data.info);
                loadGraph(model+"sGraph", graphTitle, data.info);
            } else {
                console.error(data.message);
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            console.error(xhr);
            console.error("Error en la solicitud AJAX:", textStatus, errorThrown);
            console.error('Estado de la respuesta', xhr.status);
            console.error('Respuesta del servidor:', xhr.responseText);
        }
    });
}

function loadGraph(elementID, title, data){
    var canvas = document.getElementById(elementID);

    // var data = [
    // { name: "Product A", count: 10 },
    // { name: "Product B", count: 8 },
    // { name: "Product C", count: 7 },
    // { name: "Product D", count: 4 },
    // { name: "Product E", count: 2 }
    // ];

    // Extract the product names and counts from the data
    var labels = data.map(function(item) { return item.name; });
    var counts = data.map(function(item) { return item.count; });

    var context = canvas.getContext("2d");
    
    // Set the bar width and spacing
    var barWidth = 40;
    var barSpacing = 20;

    // Set the starting position for the bars
    var startX = 50;
    // This starting point in Y axis will allow the bars to be printed above the products names
    var startY = canvas.height - 50;

    // Gets max count result to set it as the top of the graph to draw in
    var maxCount = Math.max(...counts);

    // Loop through the data and draw the bars
    for (var i = 0; i < data.length; i++) {
    var x = startX + (barWidth + barSpacing) * i;
    var height = (counts[i] / maxCount) * (canvas.height - 100);
    var y = startY - height;

    // Write the text "Products stock" in the top left corner
    context.fillStyle = "black";
    context.font = "16px Arial";
    context.textAlign = "left";
    context.fillText(title, canvas.clientWidth / 2, 25);

    // Draw the bar
    context.fillStyle = "rgba(75, 192, 192, 0.2)";
    context.fillRect(x, y, barWidth, height);

    // Draw the count label
    context.fillStyle = "black";
    context.font = "12px Arial";
    context.textAlign = "center";
    context.fillText(counts[i], x + barWidth / 2, y - 10);

    // Draw the product name label
    context.fillText(labels[i], x + barWidth / 2, startY + 20);
    }
}