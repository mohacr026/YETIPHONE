$(document).ready(function () {
    var dni = $('#dni');
    var password = $('#password');
    var cPassword = $('#confirmPassword');
    var boton = $('#signup');
    boton.prop('disabled', true);
    dni.on('keyup', function() {
        var errorMessage = document.getElementById("errorMessage");
        var resto = parseInt(dni.val().substring(0, dni.val().length - 1)) % 23;
        var letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T']; 
        if(dni.val().charAt(dni.val().length - 1).toUpperCase() == letras[resto]) {
            errorMessage.innerHTML = "";
            boton.prop('disabled', false);
            password.trigger('keyup');
        } else {
            errorMessage.innerHTML = "DNI must be valid";
            boton.prop('disabled', true);
        }
    });
    password.on('keyup', function() {
        var errorMessage = document.getElementById("errorMessage");
        checkData();
    });
    cPassword.on('keyup', function() {
        var errorMessage = document.getElementById("errorMessage");
        checkData();
    });
});

function checkData(){
    var dni = $('#dni');
    var password = $('#password');
    var cPassword = $('#confirmPassword');
    var boton = $('#signup');
    if(password.val() === cPassword.val()){
        errorMessage.innerHTML = "";
        boton.prop('disabled', false);
        dni.trigger('keyup');
    } else {
        errorMessage.innerHTML = "Passswords must match!";
        boton.prop('disabled', true);
    }
}