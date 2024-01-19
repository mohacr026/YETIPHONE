document.addEventListener('DOMContentLoaded', function () {
    let decrease = document.getElementById("decreaseAmount");
    let increase = document.getElementById("increaseAmount");
    let number = document.getElementById("amount");

    decrease.addEventListener("click", function(){
        if(number.value > 1) {
            number.value = parseInt(number.value)-1;
        }
    })

    increase.addEventListener("click", function(){
        if(number.value < 99) {
            number.value = parseInt(number.value)+1;
        }
    })
});