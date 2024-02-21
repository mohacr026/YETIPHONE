window.addEventListener("load", function(){
    let div = document.createElement("div");
    div.innerHTML = "<h3>Error !</h3><p>Something went wrong with your order, please check the availability of the products in your cart</p>";
    div.classList.add("popupError");
    document.body.appendChild(div);

    document.body.addEventListener("click", function(){
        div.remove()
    })
});