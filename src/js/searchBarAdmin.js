import { Product } from "./product.js";
import { Category } from "./category.js";

let productsArray = [];
let categoriesArray = [];
window.addEventListener("load", (event) => {
    const productCategoriesScript = document.getElementById("pcategoryJSON");
    let productCategoriesData;
    if(productCategoriesScript) {
        const content = productCategoriesScript.innerHTML || productCategoriesScript.textContent;
        productCategoriesData = JSON.parse(content);
    }

    const categoriesScript = document.getElementById("categoryJSON");
    let categoriesData;
    if(categoriesScript) {
        const content = categoriesScript.innerHTML || categoriesScript.textContent;
        categoriesData = JSON.parse(content);
        categoriesData.forEach(categoryData => {
            let category = new Category(
                categoryData.id,
                categoryData.name,
                categoryData.subcategories,
                categoryData.isActive
            )
            categoriesArray.push(category);
        });
        console.log(categoriesArray);
    }

    const productsScript = document.getElementById("productJSON");
    let productsData;
    if(productsScript) {
        const content = productsScript.innerHTML || productsScript.textContent;
        productsData = JSON.parse(content);
        productsData.forEach(productData => {
            let categoryName = productCategoriesData.filter(element => {
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
                //const productId = product.id && product.id.match(regex);

                return productName || productCategory;
            })
            
            // If no products match your search
            if(productsMatched.length == 0) {
                let empty = document.createElement("div");
                let message = document.createElement("p");
                message.innerText = "No products match your search";
                empty.appendChild(message);
                divToWrite.appendChild(empty);
            }

            productsMatched.forEach(product => {
                divToWrite.appendChild(product.render());
            });
        } else if(controller == "Category"){
            let categoriesMatched = categoriesArray.filter(category =>{
                const regex = new RegExp(content, "gi");
                const categoryName = category.name && category.name.match(regex);
                const categoryCategory = category.category && category.category.match(regex);
                //const categoryId = category.id && category.id.match(regex);

                return categoryName || categoryCategory;
            })
            
            // If no categories match your search
            if(categoriesMatched.length == 0) {
                let empty = document.createElement("div");
                let message = document.createElement("p");
                message.innerText = "No categories match your search";
                empty.appendChild(message);
                divToWrite.appendChild(empty);
            }

            categoriesMatched.forEach(category => {
                divToWrite.appendChild(category.render());
            });
        }
                
    });
}