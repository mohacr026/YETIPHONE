import { ShopUser } from "./class/shopUser.js";

window.addEventListener("load", function(){
    console.log("hola");
    let currentCart;
    //let user = new ShopUser("iker@gmail.com", "carrito");
     sessionStorage.clear()
    let storedUser = ShopUser.loadFromSessionStorage();
    console.log(storedUser);
});

function addCartToLocalStorage(itemsJson) {
    localStorage.setItem("cartItems", itemsJson);
}

function addCartToDatabase(){
    // Funcion que ha de ir a php
}

function getCartFromLocalStorage(){
    localStorageCart = localStorage.getItem('cartItems');
    itemsJson = localStorageCart ? localStorageCart : null;
    return itemsJson;
}

function getCartFromDatabase(){
    // Funcion que ha de ir a php
}

function addProductToCart(product, cart){
    let newCart = cart;
    let itemIndex = getItemIndex(newCart, product.id);
    if(itemIndex !== -1){
        // Si el objeto ya esta en el carrito
        newCart[itemIndex].quantity += product.quantity;
    } else {
        // Si es un objeto nuevo en el carrito
        newCart.push(product);
    }

    console.log("CARRITO VIEJO");
    console.log(cart);
    console.log("CARRITO NUEVO");
    console.log(newCart);

    return newCart;
}

function getItemIndex(cart, id) {
    return cart.findIndex(product => product.id === id);
}