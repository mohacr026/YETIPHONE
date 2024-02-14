import { ShopUser } from "./class/shopUser.js";

let storedUser

window.addEventListener("load", function(){
    storedUser = ShopUser.loadFromSessionStorage();
    
    let userInput = document.getElementById("user");
    userInput.value = storedUser.email;
    let cartInput = document.getElementById("cart");
    cartInput.value = JSON.stringify(storedUser.cart.shoppingCart);
})