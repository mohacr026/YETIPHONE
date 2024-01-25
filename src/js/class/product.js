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

    renderList(){
        let li = document.createElement("li");
        li.classList.add("listItem");

        let linkComponent = document.createElement("a");
        linkComponent.href = "index.php?controller=Product&action=showProductPage&id=" + this.id;
        let insideComponent = document.createElement("div");

        let image = document.createElement("img");
        image.src = this.image;
        image.alt = this.name;
        image.classList.add("listItemImage");
        insideComponent.appendChild(image);

        let sideContent = document.createElement("div");
        sideContent.classList.add("listItemContent")

        let name = document.createElement("p");
        name.innerText = this.name;
        name.classList.add("listItemName");
        sideContent.appendChild(name);

        let price = document.createElement("p");
        price.innerText = this.price + "€";
        price.classList.add("listItemPrice");
        sideContent.appendChild(price);

        insideComponent.appendChild(sideContent);
        linkComponent.appendChild(insideComponent);
        li.appendChild(linkComponent);

        return li;

    }
}