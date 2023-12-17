export class Product{
    constructor(id, name, description, category, image, price, stock, featured, isActive) {
        this.id = id;
        this.name = name;
        this.description = description;
        this.category = category;
        this.image = image;
        this.price = price;
        this.stock = stock;
        this.featured = featured;
        this.isActive = isActive;
    }

    render(){
        let productComponent = document.createElement("div");
        productComponent.classList.add("productComponent");
        let productDiv = document.createElement("div");
        productDiv.classList.add("product");
        let productName = document.createElement("p");
        productName.classList.add("productName");
        productName.innerText = this.name;
        let editLink = document.createElement("a");
        editLink.innerText = "Edit";
        editLink.href = "index.php?controller=Product&action=editproduct&id=" + this.id;
        let toggleLink = document.createElement("a");
        toggleLink.innerText = this.isActive ? "Disable" : "Enable";
        toggleLink.href = "index.php?controller=Product&action=showActDesc&id=" + this.id;

        productDiv.appendChild(productName);
        productDiv.appendChild(editLink);
        productDiv.appendChild(toggleLink);
        productComponent.appendChild(productDiv);

        return productComponent;
    }
}