document.addEventListener("DOMContentLoaded", function () {
    var categoriasBtn = document.getElementById("categoriasBtn");
    var categoriasDropdown = document.getElementById("categoriasDropdown");

    categoriasBtn.addEventListener("click", function () {
        categoriasDropdown.classList.toggle("categoryshow");
    });

    // Cierra el desplegable si se hace clic fuera de él
    window.addEventListener("click", function (event) {
        if (!event.target.matches("#categoriasBtn")) {
            var dropdowns = document.getElementsByClassName("categorias-dropdown");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains("categoryshow")) {
                    openDropdown.classList.remove("categoryshow");
                }
            }
        }
    });
});