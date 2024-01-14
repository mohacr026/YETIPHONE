let product_id;
let product_id_array;

window.addEventListener("load", (event) => {
    product_id = document.getElementById("product_id");
    let product_id_value = product_id.value;
    product_id_array = product_id_value.replace('-', '').split(/(\d+)/).filter(Boolean);

    let name;
    let category = $("#category option:selected").text();
    updateProductId("", category, "")
    
    $('#name').keyup(function() {
        name = $('#name').val();
        updateProductId("", name)
    });

    $('#category').on("change",function() {
        category = $( "#category option:selected").text();
        updateProductId(category, "")
    });
});

function updateProductId(category, name) {
    if(category != "") product_id_array[0] = category.slice(0, 2).toUpperCase();
    if(name != "" && name.length >= 2) product_id_array[2] = name.slice(0, 2).toUpperCase();

    let newId = product_id_array[0] + product_id_array[1] + "-" + product_id_array[2];
    product_id.value = newId;

    if(product_id_array[0] != "CC" && product_id_array[2] != "PP") {
        let numberPromise = getNumber('categoria', 'nombre');
        numberPromise
        .then(result => {
            console.log(result);
        })
        .catch(error => console.error('Error:', error));
    }
}

function getNumber(category, name) {
    return new Promise((resolve, reject) => {
      const url = 'tu_servidor_php.php'; // Reemplaza con la URL correcta de tu servidor PHP
  
      fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `category=${encodeURIComponent(category)}&name=${encodeURIComponent(name)}`,
      })
        .then(response => {
          if (!response.ok) {
            throw new Error(`Error en la solicitud: ${response.status}`);
          }
          return response.json();
        })
        .then(result => resolve(result))
        .catch(error => reject(new Error(`Error en la solicitud: ${error.message}`)));
    });
}