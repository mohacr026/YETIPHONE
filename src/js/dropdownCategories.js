window.addEventListener("load", (event) => {
    loadEvents();
  });

function loadEvents(){
    let components = document.getElementsByClassName("categoryComponent");
     
    for (let i = 0; i < components.length; i++) {
        let component = components[i];
        
        component.addEventListener("click", function(){
            for (let y = 0; y < components.length; y++) {
                let componentToHide = components[y];
                if(componentToHide != component){
                    let subcategoriesDivA = componentToHide.getElementsByClassName("subcategoriesContainer");
                    let subcategoriesDiv = subcategoriesDivA[0];
                    
                    if(subcategoriesDiv != null) {
                        subcategoriesDiv.transition = "all 0.5s;";
                        subcategoriesDiv.style.maxHeight = "0";
                        subcategoriesDiv.style.opacity = "0";
                        subcategoriesDiv.transition = "all 1s;";
                    }
                }
            }
            let subcategoriesDivA = component.getElementsByClassName("subcategoriesContainer");
            let subcategoriesDiv = subcategoriesDivA[0];
            if(subcategoriesDiv != null){
                if(subcategoriesDiv.style.maxHeight == "100vh") {
                    subcategoriesDiv.style.maxHeight = "0";
                    subcategoriesDiv.style.opacity = "0";

                } else {
                    subcategoriesDiv.style.maxHeight = "100vh";
                    subcategoriesDiv.style.opacity = "1";
                }
            }
        })
    }
}