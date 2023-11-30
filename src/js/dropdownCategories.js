window.onload=loadEvents;

function loadEvents(){
    let components = document.getElementsByClassName("categoryComponent");

    for (let i = 0; i < components.length; i++) {
        let component = components[i];
        
        component.addEventListener("click", function(){
            let subcategoriesDivA = component.getElementsByClassName("subcategoriesContainer");
            let subcategoriesDiv = subcategoriesDivA[0];
            if(subcategoriesDiv!=null){
                if(subcategoriesDiv.style.maxHeight == "100vh") {
                    subcategoriesDiv.style.maxHeight = "0";
                    subcategoriesDiv.style.transform = "scale(1,0)";
                } else {
                    subcategoriesDiv.style.maxHeight = "100vh";
                    subcategoriesDiv.style.transform = "scale(1)";
                }
            }
        })
    }
}