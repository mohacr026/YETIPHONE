import { ShopUser } from "./class/shopUser.js";

let currentUser

window.addEventListener("load", function(){
    currentUser = ShopUser.loadFromSessionStorage();
    let div = document.getElementById("carrito");

    div.innerHTML = JSON.stringify(currentUser.cart.shoppingCart);
    div.style.backgroundColor = "white";
    div.style.padding = "1rem";

});