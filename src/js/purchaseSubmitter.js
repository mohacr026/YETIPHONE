import { ShopUser } from "./class/shopUser.js";

let storedUser

window.addEventListener("load", function(){
    storedUser = ShopUser.loadFromSessionStorage();
    
    let userInput = document.getElementById("user");
    userInput.value = storedUser.email;
    let cartInput = document.getElementById("cart");
    cartInput.value = JSON.stringify(storedUser.cart.shoppingCart);
    let totalprice = document.getElementById("totalPrice");
    let sum = getCartTotal(storedUser.cart.shoppingCart);
    totalprice.innerHTML = sum+"€";

    loadResume();
})

function loadResume(){
    let resume = document.getElementById("resume");
    while(resume.firstChild) {
        resume.removeChild(resume.firstChild);
    }
    storedUser.cart.shoppingCart.forEach(item => {
      let li = document.createElement("li");
      li.innerHTML = item.name + " x " + item.quantity
      resume.appendChild(li);
    })
}

function getCartTotal(cart) {
    let sum = 0;
    cart.forEach(item => {
        sum += (item.price * item.quantity);
    });
    return sum
}