$(document).ready(function () {
    var password = $('#password');
    var cPassword = $('#confirmPassword');
    password.on('keyup', function() {
        var errorMessage = document.getElementById("errorMessage");3
        if(password.val() === cPassword.val()){
            errorMessage.innerHTML = "";
        } else {
            errorMessage.innerHTML = "Passswords must match!";
        }
    });
    cPassword.on('keyup', function() {
        var errorMessage = document.getElementById("errorMessage");
        if(password.val() === cPassword.val()){
            errorMessage.innerHTML = "";
        } else {
            errorMessage.innerHTML = "Passswords must match!";
        }
    });
});

window.onload = setupValidation;
function setupValidation(){
    console.log("Validation");
    $("#password").on('input', testPasswords());
}
function testPasswords(){
    
}