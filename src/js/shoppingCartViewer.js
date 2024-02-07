import { ShopUser } from "./class/shopUser.js";

let currentUser

window.addEventListener("load", function(){
    currentUser = ShopUser.loadFromSessionStorage();
    let div = document.getElementById("carrito");

    currentUser.cart.shoppingCart.forEach(item => {
        let product = document.createElement("div");
        product.classList.add("cartProduct");
        let image = document.createElement("img");
        image.src = "./src/img/products/" + item.image
        let name = document.createElement("p");
        name.innerText = item.name;
        let quantity = document.createElement("p");
        quantity.innerText = item.quantity;
        let price = document.createElement("p");
        price.innerText = item.price;

        product.appendChild(image);
        product.appendChild(name);
        product.appendChild(quantity);
        product.appendChild(price);
        div.appendChild(product);
        
    });
    
    div.style.backgroundColor = "white";
    div.style.padding = "1rem";

});