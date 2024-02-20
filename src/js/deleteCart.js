import { ShopUser } from "./class/shopUser.js";

let storedUser

window.addEventListener("load", function(){
    storedUser = ShopUser.loadFromSessionStorage();

    storedUser.cart = JSON.parse('{"shoppingCart": []}');
    storedUser.saveToSessionStorage();

    localStorage.removeItem(storedUser.email)
})