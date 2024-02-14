import { ShopUser } from "./class/shopUser.js";

let storedUser

window.addEventListener("load", function(){
    storedUser = ShopUser.loadFromSessionStorage();
})