window.addEventListener("load", function(){
    let bigImage = document.getElementById("productPageShowingImage");

    let sideImages = document.getElementsByClassName("sideImage");

    for (let i = 0; i < sideImages.length; i++) {
        const image = sideImages[i];
        image.addEventListener("click", function(){
            bigImage.src = image.src;
            loadZoom();
        })
    }
})