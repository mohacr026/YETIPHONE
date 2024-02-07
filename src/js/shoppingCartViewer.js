import { ShopUser } from "./class/shopUser.js";

let storedUser

window.addEventListener("load", function(){
    storedUser = ShopUser.loadFromSessionStorage();
    let div = document.getElementById("cartElements");

    storedUser.cart.shoppingCart.forEach(item => {
        let product = document.createElement("div");
        product.id = item.product;
        product.classList.add("cartProduct");
        let image = document.createElement("img");
        image.src = "./src/img/products/" + item.image
        let name = document.createElement("p");
        name.innerText = item.name;
        let quantity = document.createElement("p");
        quantity.innerText = item.quantity;
        let price = document.createElement("p");
        price.innerText = item.price;

        let addBtn = document.createElement("button");
        addBtn.innerHTML = "<img src='./src/img/addBtn.png' alt='add more of this product to cart'></img>"
        let decBtn = document.createElement("button");
        decBtn.innerHTML = "<img src='./src/img/decBtn.png' alt='decrease amount of this product to cart'></img>"
        let delBtn = document.createElement("button");
        delBtn.innerHTML = "<img src='./src/img/delBtn.png' alt='remove this product from cart'></img>"
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
});

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
            if(storedUser.cart.shoppingCart[itemIndex].quantity < stock) storedUser.cart.shoppingCart[itemIndex].quantity += 1;
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
    if(storedUser.cart.shoppingCart[itemIndex].quantity > 0) {
        storedUser.cart.shoppingCart[itemIndex].quantity -= 1;
        console.log(storedUser.cart.shoppingCart[itemIndex].quantity);
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
    let itemIndex = getItemIndex(storedUser.cart.shoppingCart, productId);
    storedUser.cart.shoppingCart = storedUser.cart.shoppingCart.filter(item => item.product !== productId);
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