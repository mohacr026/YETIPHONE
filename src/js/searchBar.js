import { Product } from "./product.js";

// Se agrega un evento que se ejecuta cuando la ventana ha cargado completamente
window.addEventListener("load", () => {
    searchBarEvents();
});

// Declaración de variables globales
let typingTimer;
const doneTypingInterval = 500;

// Función que agrega un evento de escucha al input de búsqueda
function searchBarEvents() {
    $('#search').on('input', function () {
        // Se limpia el temporizador si ya está en marcha
        clearTimeout(typingTimer);

        // Se establece un temporizador para ejecutar handleDropdown después de un breve retraso
        typingTimer = setTimeout(() => handleDropdown($(this).val()), doneTypingInterval);
    });
}

// Función asincrónica que maneja la lógica del dropdown
async function handleDropdown(content) {
    // Obtiene el elemento resultDropdown o crea uno nuevo si no existe
    const resultDropdown = document.getElementById("resultDropdown") || createResultDropdown();

    // Si el contenido está vacío, se elimina el dropdown
    if (content.trim().length === 0) {
        resultDropdown.remove();
    } else {
        // Se limpia el contenido existente y se actualiza con nuevos elementos
        resultDropdown.innerHTML = "";
        resultDropdown.appendChild(await updateDropdownAsync(content));
    }
}

// Función que crea y devuelve un nuevo elemento resultDropdown
function createResultDropdown() {
    const resultDropdown = document.createElement("div");
    resultDropdown.id = "resultDropdown";

    // Busca el contenedor de la barra de búsqueda y añade resultDropdown
    const searchBarDiv = document.querySelector(".searchBar");
    searchBarDiv.appendChild(resultDropdown);

    return resultDropdown;
}

// Función asincrónica que actualiza el contenido del dropdown
async function updateDropdownAsync(content) {
    const ul = document.createElement("ul");

    try {
        // Intenta obtener datos utilizando fetchData
        const data = new FormData();
        data.append('toSearch', content);

        const result = await fetchData(data);

        // Para cada resultado, crea un objeto Product y agrega un elemento de lista al ul
        result.forEach(productData => {
            const product = new Product(
                productData.productId,
                productData.name,
                productData.description,
                productData.category,
                productData.img,
                productData.price,
                productData.stock,
                productData.featured,
                productData.isActive
            );

            ul.appendChild(product.renderList());
        });
    } catch (error) {
        // Maneja errores mostrando un mensaje de error en el dropdown
        console.error(error);
        const li = document.createElement("li");
        li.innerHTML = `Error: ${error.message}`;
        ul.appendChild(li);
    }

    return ul;
}

// Función que realiza una solicitud fetch para obtener datos del servidor
function fetchData(data) {
    return fetch('index.php?controller=Product&action=searchProducts', {
        method: 'POST',
        body: data,
    })
    .then(response => {
        // Verifica si la respuesta de la petición es exitosa
        if (!response.ok) {
            throw new Error('Error en la petición HTTP, estado ' + response.status);
        }
        // Devuelve el resultado en formato JSON
        return response.json();
    })
    .catch(error => {
        // Lanza un error si hay un problema durante la solicitud fetch
        throw new Error(error.message);
    });
}