export class Category{
    constructor(id, name, subcategories, isActive) {
        this.id = id;
        this.name = name;
        this.subcategories = subcategories;
        this.isActive = isActive;
    }

    render(){
        // Each component div
        let categoryComponent = document.createElement("div");
        categoryComponent.classList.add("categoryComponent");
        // Div inside div for positioning
        let categoryDiv = document.createElement("div");
        categoryDiv.classList.add("category");
        // Name
        let categoryName = document.createElement("p");
        categoryName.classList.add("categoryName");
        categoryName.innerText = this.name;
        // Edit link
        let editLink = document.createElement("a");
        editLink.innerText = "Edit";
        editLink.href = "index.php?controller=Category&action=editCategory&id=" + this.id;
        // Enable / Disable link
        let toggleLink = document.createElement("a");
        toggleLink.innerText = this.isActive ? "Disable" : "Enable";
        toggleLink.href = "index.php?controller=Category&action=showActDesc&id=" + this.id;

        // If category has subcategories, append subcategories
        if(this.subcategories.length != 0){
            let subcategoriesDiv = document.createElement("div");
            subcategoriesDiv.classList.add("subcategoriesContainer");
            // For each subcategory
            this.subcategories.forEach(subcategory => {
                // Each subcategory div
                let subcategoryDiv = document.createElement("div");
                subcategoryDiv.classList.add("subcategory");

                let subcategoryName = document.createElement("div");
                subcategoryName.innerText = subcategory.name;
                subcategoryName.classList.add("subcategoryName");

                let subcategoryEditLink = document.createElement("a");
                subcategoryEditLink.href = "index.php?controller=Category&action=editCategory&id=" + subcategory.id;
                subcategoryEditLink.innerText = "Edit";

                let subcategoryToggleLink = document.createElement("a");
                subcategoryToggleLink.innerText = subcategory.isActive ? "Disable" : "Enable";
                subcategoryToggleLink.href = "index.php?controller=Category&action=showActDesc&id=" + subcategory.id;

                subcategoryDiv.appendChild(subcategoryName);
                subcategoryDiv.appendChild(subcategoryEditLink);
                subcategoryDiv.appendChild(subcategoryToggleLink);

                subcategoriesDiv.appendChild(subcategoryDiv);
            });

        }

        categoryDiv.appendChild(categoryName);
        categoryDiv.appendChild(editLink);
        categoryDiv.appendChild(toggleLink);
        if(subcategoriesDiv) categoryDiv.appendChild(subcategoriesDiv);
        categoryComponent.appendChild(categoryDiv);

        return categoryComponent;
    }
}
