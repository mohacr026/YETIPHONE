window.addEventListener("load", (event) => {
    searchBarEvents();
});

function searchBarEvents() {
    $('#search').keyup(function(){
        let content = $(this).val();
        console.log(content);
        let resultDropdown = document.getElementById("resultDropdown");

        if(resultDropdown) console.log(resultDropdown);
        if(content.length == 0 && resultDropdown) {
            // ESTA VACIO Y EXISTE
            resultDropdown.remove();
            console.log("INTENTO BORRAR");
        } else if((content.length > 0) && resultDropdown){
            // NO ESTA VACIO Y EXISTE
            resultDropdown = updateDropdownAsync(resultDropdown, content);
            console.log("INTENTO CAMBIAR");
        } else if((content.length > 0) && !resultDropdown){
            // NO ESTA VACIO Y NO EXISTE
            console.log("INTENTO CREAR");
            resultDropdown = document.createElement("div");
            resultDropdown.id = "resultDropdown";

            resultDropdown = updateDropdownAsync(resultDropdown, content);

            let body = document.getElementsByTagName("body")[0];
            body.appendChild(resultDropdown);
        }
    });
}

async function updateDropdownAsync(resultDropdown, content) {
    while(resultDropdown.firstChild) {
        resultDropdown.removeChild(resultDropdown.firstChild);
    }
    // Updatea el div resultDropdown de acuerdo con el content
    let ul = document.createElement("ul");
    
    const data = {toSearch: content};

    fetchData(data)
    .then(resultado => {
        console.log('Éxito:', resultado);
        let li = document.createElement("li");
        li.innerHTML = resultado;
        ul.appendChild(li);
    })
    .catch(error => {
        console.error('Error:', error);
        let li = document.createElement("li");
        li.innerHTML = resultado;
        ul.appendChild(li);
    });
    
    resultDropdown.appendChild(ul);
    return resultDropdown;
}

function fetchData(data) {
    return new Promise((resolve, reject) => {
        fetch('index.php?controller=Product&action=searchProducts', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
          })
        .then(response => {
          if (!response.ok) {
            throw new Error('Error en la petición HTTP, estado ' + response.status);
          }
          return response.json();
        })
        .then(data => {
          // Intentar parsear el JSON recibido
          try {
            const parsedData = JSON.parse(data);
            resolve(parsedData);
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
  
  