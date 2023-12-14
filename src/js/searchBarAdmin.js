class Product{
    constructor(id, name, description, category, image, price, stock, featured, isActive) {
        this.id = id;
        this.name = name;
        this.description = description;
        this.category = category;
        this.image = image;
        this.price = price;
        this.stock = stock;
        this.featured = featured;
        this.isActive = isActive;
    }

    render(){
        let productComponent = document.createElement("div");
        productComponent.classList.add("productComponent");
        let productDiv = document.createElement("div");
        productDiv.classList.add("product");
        let productName = document.createElement("p");
        productName.classList.add("productName");
        productName.innerText = this.name;
        let editLink = document.createElement("a");
        editLink.innerText = "Edit";
        editLink.href = "index.php?controller=Product&action=editproduct&id=" + this.id;
        let toggleLink = document.createElement("a");
        toggleLink.innerText = this.isActive ? "Disable" : "Enable";
        toggleLink.href = "index.php?controller=Product&action=showActDesc&id=" + this.id;

        productDiv.appendChild(productName);
        productDiv.appendChild(editLink);
        productDiv.appendChild(toggleLink);
        productComponent.appendChild(productDiv);

        return productComponent;
    }
}
let productsArray = [];
window.addEventListener("load", (event) => {
    const categoriesScript = document.getElementById("categoryJSON");
    let categoriesData;
    let productsData;
    if(categoriesScript) {
        const content = categoriesScript.innerHTML || categoriesScript.textContent;
        categoriesData = JSON.parse(content);
    }
    const productsScript = document.getElementById("productJSON");
    
    if(productsScript) {
        const content = productsScript.innerHTML || productsScript.textContent;
        productsData = JSON.parse(content);
        productsData.forEach(productData => {
            let categoryName = categoriesData.filter(element => {
                return element.id == productData.id_category;
            })[0].name;
            let product = new Product(
                productData.id,
                productData.name,
                productData.description,
                categoryName,
                productData.image,
                productData.price,
                productData.stock,
                productData.featured,
                productData.isActive
            );
            productsArray.push(product);
        });

        
    }
    
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
        let divToWrite = document.getElementsByClassName(controller.toLowerCase() + "Container")[0]; 
                while(divToWrite.firstChild) {
                    divToWrite.removeChild(divToWrite.firstChild);
                }
                if(controller == "Product"){
                    let productsMatched = productsArray.filter(product =>{
                        const regex = new RegExp(content, "gi");
                        const productName = product.name && product.name.match(regex);
                        const productCategory = product.category && product.category.match(regex);
                        const productId = product.id && product.id.match(regex);

                        return productName || productCategory || productId;
                    })
                    
                    productsMatched.forEach(product => {
                        divToWrite.appendChild(product.render());
                    });
                }
                
    });
}