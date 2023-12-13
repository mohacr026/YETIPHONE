window.addEventListener("load", (event) => {
    searchBarEvents();
    filterEvents();
});

let filtersArray = {};

function filterEvents() {

}

function searchBarEvents(){
    let destinationElement = document.getElementById("destination");
    let controller = destinationElement.dataset.destination;

    $('#search').keyup(function(){
        let content = $(this).val();
        content = content.toLowerCase();

        $.ajax({
            url: 'index.php?controller='+controller+"&action=searchBarFilters",
            method: 'POST',
            data: {
                query: content,
                filters: filtersArray
            },
            success: function(data){
                let divToWrite = document.getElementsByClassName(controller.toLowerCase() + "Container")[0]; 
                while(divToWrite.firstChild) {
                    divToWrite.removeChild(divToWrite.firstChild);
                }
                data.forEach(product => {
                    let productComponent = document.createElement("div");
                    productComponent.classList.add("productComponent");
                    let productDiv = document.createElement("div");
                    productDiv.classList.add("product");
                    let productName = document.createElement("p");
                    productName.classList.add("productName");
                    productName.innerText = product.name;
                    let editLink = document.createElement("a");
                    editLink.innerText = "Edit";
                    editLink.href = "index.php?controller=Product&action=editproduct&id=" + product.id;
                    let toggleLink = document.createElement("a");
                    toggleLink.innerText = product.isActive ? "Disable" : "Enable";
                    toggleLink.href = "index.php?controller=Product&action=showActDesc&id=" + product.id;

                    productDiv.appendChild(productName);
                    productDiv.appendChild(editLink);
                    productDiv.appendChild(toggleLink);
                    productComponent.appendChild(productDiv);
                    divToWrite.appendChild(productComponent);
                    
                    /*
                    Es una copia de esta version del componente de php ->

                    echo "<div class='productComponent'>";
                    echo "  <div class='product'>";
                    echo "      <p class='productName'>$productName</p>";
                    echo "      <a href='index.php?controller=Product&action=editproduct&id=$productId'>Edit</a>";
                    $statusMessage = $productStatus ? "Disable" : "Enable";
                    echo "      <a href='index.php?controller=Product&action=showActDesc&id=$productId'>$statusMessage</a>";
                    echo "  </div>";
                    echo "</div>";
                    */
                });
                
                
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("AJAX request failed:", textStatus, errorThrown);
            }
        });
    });
}