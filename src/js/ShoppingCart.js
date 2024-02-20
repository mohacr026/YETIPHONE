import { ShopUser } from "./class/shopUser.js";

let storedUser;

window.addEventListener("load", function(){
    // sessionStorage.clear();
    // localStorage.clear();
    storedUser = ShopUser.loadFromSessionStorage();
    checkIfUserIsLogged();
    console.log("USUARIO DE SESION");
    console.log(storedUser);
    addButtonEvents();
});

function checkIfUserIsLogged(){
    if(storedUser === null){
        let cartJson = fetchCartFromLocalStorage("temporalAcces");
        if(cartJson === null) cartJson = JSON.parse('{"shoppingCart": []}');
        let newUser = new ShopUser("temporalAcces", cartJson);
        newUser.saveToSessionStorage();
        storedUser = ShopUser.loadFromSessionStorage();
    }
}

function logUser(email) {
    if(!storedUser.email === "temporalAcces") {
        let cart = getNewestCart(email);
    }
}

function getNewestCart(email) {
    let localStorageCart = fetchCartFromLocalStorage(email);
    let databaseCart = fetchCartFromDatabase(email);

    let definitiveCart

    if(localStorageCart && databaseCart){
        // CASO CUANDO EL USUARIO TIENE 2 carritos
    } else if(localStorageCart)  definitiveCart = localStorageCart;
    else if(databaseCart)  definitiveCart = databaseCart;
}

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

function fetchCartFromDatabase(email) {
    return new Promise((resolve, reject) => {
        // Configurar los datos que se enviarán en la petición POST
        const data = new FormData();
        data.append('email', email);
    
        // Realizar la petición POST a PHP
        fetch('index.php?controller=ShoppingCart&action=getUserCart', {
          method: 'POST',
          body: data
        })
          .then(response => {
            // Verificar si la petición fue exitosa (código de estado 200)
            if (response.ok) {
              // Resolver la promesa con los datos devueltos por PHP
              resolve(response.json());
            } else {
              // Rechazar la promesa con un mensaje de error
              reject('Error en la petición al servidor PHP');
            }
          })
          .catch(error => {
            // Rechazar la promesa en caso de un error en la conexión
            reject('Error de conexión');
          });
      });
}

function addButtonEvents(){
    let addToCartButtons = document.getElementsByClassName("addCart");
    for (let i = 0; i < addToCartButtons.length; i++) {
        let button = addToCartButtons[i];
        if(button){
            button.addEventListener("click", function() {
                let productId = button.dataset.product;
                let productPrice = button.dataset.price;
                let productName = button.dataset.name;
                let productImage = button.dataset.image
                console.log("USER ANTES DE AÑADIR");
                console.log(storedUser);
                let productQuantity = document.getElementById("amount");
                if(productQuantity) addProductToCart(productId, storedUser.cart, productPrice, productName, productImage, productQuantity.value)
                else addProductToCart(productId, storedUser.cart, productPrice, productName, productImage)
            })
        }
    }
}

function addProductToCart(product, cart, price, name, image, quantity=null){
    let newCart = cart.shoppingCart;
    console.log(newCart.length);
    quantity = quantity == null ? 1 : quantity
    if(newCart.length != 0){
        let itemIndex = getItemIndex(newCart, product);
        if(itemIndex != -1){
            // Si el objeto ya esta en el carrito
            newCart[itemIndex].quantity += quantity;
        } else {
            // Si es un objeto nuevo en el carrito
            let cartItem = {
                "product": product,
                "quantity": quantity,
                "price" : price,
                "name" : name,
                "image" : image
            }
            console.log(newCart);
            newCart.push(cartItem);
        }
    } else {
        // Si el carrito esta vacio
        let cartItem = {
            "product": product,
            "quantity": quantity,
            "price" : price,
            "name" : name,
            "image" : image
        }
        console.log(newCart);
        newCart.push(cartItem);
    }

    console.log(storedUser);
    sessionStorage.setItem('User', JSON.stringify(storedUser));
    localStorage.setItem(storedUser.email, JSON.stringify(storedUser.cart));
    if(storedUser.email != "temporalAcces") uploadCartToDatabase(storedUser.email, storedUser.cart);
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

function getItemIndex(cart, targetProduct) {
    for (let i = 0; i < cart.length; i++) {
        if (cart[i].product === targetProduct) {
            return i;
        }
    }
    return -1;
}