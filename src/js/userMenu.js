window.onload = function () {
    document.getElementById("userBtn").addEventListener("click", function (event) {
        let userMenu = document.getElementById("userMenu");
        console.log(userMenu);
        // Verificar si el menú está visible y el clic no fue dentro del menú
        if (!userMenu.contains(event.target)) {
            userMenu.classList.toggle("show");
        }
    });
}

// Cerrar el menú si el usuario hace clic fuera de él
window.onclick = function (event) {
    if (!event.target.matches('.dropBtn') && !event.target.matches('.buttonElements')) {
        var dropdowns = document.getElementsByClassName("dropdownMenu");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
};