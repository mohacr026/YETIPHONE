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

        // Se retorna una Promesa que se resuelve después de un breve retraso
        typingTimer = new Promise(resolve => {
            setTimeout(() => resolve(handleDropdown($(this).val())), doneTypingInterval);
        });
    });
}

// Función asincrónica que maneja la lógica del dropdown
async function handleDropdown(content) {
    // Si el contenido está vacío, se elimina el dropdown
    if (content.trim().length === 0) {
        const resultDropdown = document.getElementById("resultDropdown");
        if (resultDropdown) resultDropdown.remove();
        return;
    }

    // Obtiene el elemento resultDropdown o crea uno nuevo si no existe
    const resultDropdown = document.getElementById("resultDropdown") || createResultDropdown();

    try {
        // Limpia el contenido existente y actualiza con nuevos elementos
        const ul = await updateDropdownAsync(content);

        // Verifica si ya existe un ul dentro de resultDropdown
        const existingUl = resultDropdown.querySelector("ul");
        if (existingUl) {
            // Si existe, actualiza su contenido en lugar de crear uno nuevo
            existingUl.innerHTML = ul.innerHTML;
        } else {
            // Si no existe, agrega el ul al resultDropdown
            resultDropdown.appendChild(ul);
        }
    } catch (error) {
        // Maneja errores mostrando un mensaje de error en el dropdown
        console.error(error);
        const li = document.createElement("li");
        li.innerHTML = `Error: ${error.message}`;
        resultDropdown.appendChild(li);
    }
}

// Función que crea y devuelve un nuevo elemento resultDropdown
function createResultDropdown() {
    const resultDropdown = document.createElement("div");
    resultDropdown.id = "resultDropdown";

    // Busca el contenedor de la barra de búsqueda y añade resultDropdown
    const searchBarDiv = document.querySelector(".searchBar");
    searchBarDiv.classList.add("open");
    
    searchBarDiv.appendChild(resultDropdown);

    return resultDropdown;
}

// Función asincrónica que actualiza el contenido del dropdown
function updateDropdownAsync(content) {
    return new Promise(async (resolve, reject) => {
        const ul = document.createElement("ul");

        try {
            // Intenta obtener datos utilizando fetchData
            const data = new FormData();
            data.append('toSearch', content);

            const result = await fetchData(data);
            console.log(result);
            // Para cada resultado, crea un objeto Product y agrega un elemento de lista al ul
            if(result.length == 0) {
                let li = document.createElement("li");
                li.innerText = "No results matched";
                ul.appendChild(li);
            } else {
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
            }

            resolve(ul);
        } catch (error) {
            console.log(error);
            // Rechaza la Promesa si hay un error
            reject(error);
        }
    });
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
