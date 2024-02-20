import { ShopUser } from "./class/shopUser.js";

let storedUser
let totalPrice = 0

window.addEventListener("load", function(){
    storedUser = ShopUser.loadFromSessionStorage();
    initCart();
    updatePrice();
    paymentButtonEvt();
    loadResume();
});

function initCart(){
    let div = document.getElementById("cartElements");
    storedUser.cart.shoppingCart.forEach(item => {
        let product = document.createElement("div");
        product.id = item.product;
        product.classList.add("cartProduct");
        let image = document.createElement("img");
        image.src = "./src/img/products/" + item.image
        let name = document.createElement("p");
        name.setAttribute("name", "name");
        name.innerText = item.name;
        let quantity = document.createElement("p");
        quantity.innerText = item.quantity;
        quantity.setAttribute("quantity", "quantity");
        quantity.classList.add("quantity");
        let price = document.createElement("p");
        price.innerText = item.price * item.quantity;
        price.setAttribute("price", "price");
        price.classList.add("price");

        let addBtn = document.createElement("button");
        addBtn.innerHTML = "<img src='./src/img/addBtn.png' alt='add more of this product to cart'></img>"
        let decBtn = document.createElement("button");
        decBtn.innerHTML = "<img src='./src/img/decBtn.png' alt='decrease amount of this product to cart'></img>"
        let delBtn = document.createElement("button");
        delBtn.innerHTML = "<img src='./src/img/trash.png' alt='remove this product from cart'></img> "
        let btnDiv = document.createElement("div");


        
        btnDiv.appendChild(addBtn);
        btnDiv.appendChild(decBtn);
        btnDiv.appendChild(delBtn);
        
        // Eventos de los botones
        addBtn.addEventListener("click", function(){
            addProduct(item.product);
        })

        decBtn.addEventListener("click", function(){
            decProduct(item.product);
        })

        delBtn.addEventListener("click", function(){
            delProduct(item.product);
        })

        product.appendChild(image);
        product.appendChild(name);
        product.appendChild(quantity);
        product.appendChild(price);
        product.appendChild(btnDiv);
        div.appendChild(product);
        
    });
}

function updatePrice(){
    totalPrice = 0
    storedUser.cart.shoppingCart.forEach(item => {
        totalPrice += (item.quantity * item.price);
    })
    let totalTag = document.getElementById("total")
    totalTag.innerText = "TOTAL: " + totalPrice
}

function paymentButtonEvt(){
    let paymentBtn = document.getElementById("buy");

    paymentBtn.addEventListener("click", function(){
        if(storedUser.cart.shoppingCart.length === 0){
            console.log("carritoVacio");
        } else {
            document.location.href = "index.php?controller=ShoppingCart&action=goToPayment";
        }
    });
}

function addProduct(productId){
    const data = new FormData();
    data.append("product", productId)
    fetch('index.php?controller=Product&action=getProductStock', {
        method: 'POST',
        body: data
        })
        .then(response => response.json())
        .then(data => {
            let stock = data[0].stock
            let itemIndex = getItemIndex(storedUser.cart.shoppingCart, productId);
            console.log(storedUser.cart.shoppingCart[itemIndex].quantity);
            if(storedUser.cart.shoppingCart[itemIndex].quantity < stock) {
                storedUser.cart.shoppingCart[itemIndex].quantity += 1;
                let currentProduct = document.getElementById(productId);
                let currentQuantity = currentProduct.getElementsByClassName("quantity")[0];
                currentQuantity.innerHTML = storedUser.cart.shoppingCart[itemIndex].quantity;
                let currentPrice = currentProduct.getElementsByClassName("price")[0];
                currentPrice.innerHTML = storedUser.cart.shoppingCart[itemIndex].quantity * storedUser.cart.shoppingCart[itemIndex].price;

                updatePrice();
                loadResume();
            }
            else console.log("NO STOCK");
            console.log(storedUser.cart.shoppingCart[itemIndex].quantity);

            sessionStorage.setItem('User', JSON.stringify(storedUser));
            localStorage.setItem(storedUser.email, JSON.stringify(storedUser.cart));
            if(storedUser.email != "temporalAcces") uploadCartToDatabase(storedUser.email, storedUser.cart);

        })
        .catch(error => console.log(error))
}

function decProduct(productId){
    let itemIndex = getItemIndex(storedUser.cart.shoppingCart, productId);
    console.log(storedUser.cart.shoppingCart[itemIndex].quantity);
    if(storedUser.cart.shoppingCart[itemIndex].quantity > 1) {
        storedUser.cart.shoppingCart[itemIndex].quantity -= 1;
        console.log(storedUser.cart.shoppingCart[itemIndex].quantity);

        let currentProduct = document.getElementById(productId);
        let currentQuantity = currentProduct.getElementsByClassName("quantity")[0];
        currentQuantity.innerHTML = storedUser.cart.shoppingCart[itemIndex].quantity;
        let currentPrice = currentProduct.getElementsByClassName("price")[0];
        currentPrice.innerHTML = storedUser.cart.shoppingCart[itemIndex].quantity * storedUser.cart.shoppingCart[itemIndex].price;

        updatePrice();
        loadResume();

        sessionStorage.setItem('User', JSON.stringify(storedUser));
        localStorage.setItem(storedUser.email, JSON.stringify(storedUser.cart));
        if(storedUser.email != "temporalAcces") uploadCartToDatabase(storedUser.email, storedUser.cart);

    }
    else {
        console.log("borra");
        delProduct(productId);
    }

    
}

function delProduct(productId){
    storedUser.cart.shoppingCart = storedUser.cart.shoppingCart.filter(item => item.product !== productId);
    
    document.getElementById(productId).remove();

    updatePrice();
    loadResume();

    sessionStorage.setItem('User', JSON.stringify(storedUser));
    localStorage.setItem(storedUser.email, JSON.stringify(storedUser.cart));
    if(storedUser.email != "temporalAcces") uploadCartToDatabase(storedUser.email, storedUser.cart);
}

function getItemIndex(cart, targetProduct) {
    for (let i = 0; i < cart.length; i++) {
        if (cart[i].product === targetProduct) {
            return i;
        }
    }
    return -1;
}

function uploadCartToDatabase(email, cart){
    const data = new FormData();
    data.append('email', email);
    data.append('cart', JSON.stringify(cart));

    fetch('index.php?controller=ShoppingCart&action=saveUserCart', {
      method: 'POST',
      body: data
    })
    .then (response => {
      if (response.ok) console.log("SUBIDO OK");
      else console.log("NO SUBIDO");
    })
    .catch(error => console.log(error))
}

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