class Category{
    constructor(user, itemsJson) {
        this.user = user;
        this.itemsJson = itemsJson;
    }

    addCartToLocalStorage() {
        localStorage.setItem("cartItems", this.itemsJson)
    }

    getCartFromLocalStorage(){
        localStorageCart = localStorage.getItem('cartItems')
        this.itemsJson = localStorageCart ? localStorageCart : null
    }

    addProductToCart(product){
        let newCart = this.itemsJson;
        let itemIndex = this.getItemIndex(newCart, product.id);
        if(itemIndex !== -1){
            // Si el objeto ya esta en el carrito
            newCart[itemIndex].quantity += product.quantity;
        } else {
            // Si es un objeto nuevo en el carrito
            newCart.push(product)
        }

        console.log("CARRITO VIEJO");
        console.log(this.itemsJson);
        console.log("CARRITO NUEVO");
        console.log(newCart);

        this.itemsJson = newCart;
    }

    getItemIndex(cart, id) {
        return cart.findIndex(product => product.id === id);
    }

}