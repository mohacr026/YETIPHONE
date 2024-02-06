import { ShopUser } from "./class/shopUser.js";

window.addEventListener("load", function(){
    logUser();
});

function fetchCartFromLocalStorage(email){
    let cartJson;
    if(email == null){
        cartJson = null
    } else {
        const cartData = localStorage.getItem(email);
        if(cartData) cartJson = JSON.parse(cartData);
        else cartJson = null;
    }
    
    console.log(cartJson);
    return cartJson;
}

function logUser() {
    let email = document.getElementById("email").dataset.email;
    console.log(email);
    sessionStorage.clear();
    let cartJson = fetchCartFromLocalStorage(email);
    if(cartJson === null) cartJson = JSON.parse('{"shoppingCart": []}');
    let newUser = new ShopUser(email, cartJson);
    newUser.saveToSessionStorage();
    console.log(newUser);
}