window.onload = checkboxEvent;

function checkboxEvent(){
    let checkbox = document.getElementById("showParent");
    let divToHide = document.getElementById("parentCategoryDiv");
    checkbox.addEventListener("change", function(){
        if(divToHide.style.visibility == "visible") {
            divToHide.style.visibility = "hidden";
        } else divToHide.style.visibility = "visible";
        console.log(divToHide.style.visibility);
    })
}