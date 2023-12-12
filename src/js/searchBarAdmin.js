window.addEventListener("load", (event) => {
    searchBarEvents();
});

function searchBarEvents(){
    let destinationElement = document.getElementById("destination");
    let controller = destinationElement.dataset.destination;

    console.log(controller);

    $('#search').keyup(function(){
        let query = $(this).val();

        $.ajax({
            url: 'index.php?controller='+controller+"&action=searchBarFilters",
            method: 'POST',
            data: { query: query },
            success: function(data){
                let divToWrite = "#" + controller.toLowerCase + "Container";
                $(divToWrite).html(data);
            }
        });
    });
}

/*
$(document).ready(function(){
    $('#searchCourses').keyup(function(){
        var query = $(this).val();
    
        $.ajax({
            url: 'searchCourses.php',
            method: 'POST',
            data: { query: query },
            success: function(data){
                $('#coursesTable').html(data);
                setupToggleFunction();
            }
        });
    });
    });
*/