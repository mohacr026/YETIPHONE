window.addEventListener("load", (event) => {
    searchBarEvents();
});

function searchBarEvents() {
    $('#search').keyup(function(){
        let content = $(this).val();
        console.log(content);
        let resultDropdown = document.getElementById("resultDropdown");

        if(content.trim().length != 0) handleDropdown(content, resultDropdown);
        else if(content.length === 0) handleDropdown(content, resultDropdown);
    });
}

async function handleDropdown(content, resultDropdown) {
    if (content.length === 0 && resultDropdown) {
        // ESTÁ VACÍO Y EXISTE
        resultDropdown.remove();
    } else if (content.length > 0 && resultDropdown) {
        // NO ESTÁ VACÍO Y EXISTE
        // Actualiza el contenido de resultDropdown
        resultDropdown = await updateDropdownAsync(resultDropdown, content);
    } else if (content.length > 0 && !resultDropdown) {
        // NO ESTÁ VACÍO Y NO EXISTE
        resultDropdown = document.createElement("div");
        resultDropdown.id = "resultDropdown";

        // Actualiza el contenido de resultDropdown
        resultDropdown = await updateDropdownAsync(resultDropdown, content);

        let body = document.getElementsByTagName("body")[0];
        body.appendChild(resultDropdown);
    }
}

async function updateDropdownAsync(resultDropdown, content) {
    // Elimina todos los hijos del resultDropdown
    resultDropdown.innerHTML = '';

    // Crea un nuevo ul
    let ul = document.createElement("ul");

    try {
        // Intenta obtener datos utilizando fetchData
        let data = new FormData();
        data.append('toSearch', content);

        const resultado = await fetchData(data);
        // Actualiza el contenido del ul con el resultado
        let li = document.createElement("li");
        li.innerHTML = resultado;
        ul.appendChild(li);
    } catch (error) {
        // Maneja errores
        console.error(error)
        let li = document.createElement("li");
        li.innerHTML = `Error: ${error.message}`;
        ul.appendChild(li);
    }

    // Agrega el ul al resultDropdown
    resultDropdown.appendChild(ul);

    // Devuelve el resultDropdown envuelto en una promesa
    return resultDropdown;
}


function fetchData(data) {
    return new Promise((resolve, reject) => {
        fetch('index.php?controller=Product&action=searchProducts', {
            method: 'POST',
            body: data,
        })
        .then(response => {
          if (!response.ok) {
            throw new Error('Error en la petición HTTP, estado ' + response.status);
          }
          return response.json();
        })
        .then(data => {
          // Intentar parsear el JSON recibido
          console.log(data);
          try {
            //const parsedData = JSON.parse(data);
            //console.log(parsedData);
            resolve(data);
          } catch (error) {
            reject('Error al parsear el JSON');
          }
        })
        .catch(error => {
          reject(error.message);
        });
    });
  }
  
  // Ejemplo de uso
  
  