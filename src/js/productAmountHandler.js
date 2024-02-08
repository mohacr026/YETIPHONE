let max;
document.addEventListener('DOMContentLoaded', function () {
    let decrease = document.getElementById("decreaseAmount");
    let increase = document.getElementById("increaseAmount");
    let number = document.getElementById("amount");
    max = number.max
    decrease.addEventListener("click", function(){
        if(number.value > 1) {
            number.value = parseInt(number.value)-1;
        }
    })

    increase.addEventListener("click", function(){
        if(number.value < 99 && number.value < max) {
            number.value = parseInt(number.value)+1;
        }
    })

    $("#amount").on("blur", function() {
        value = parseInt($(this).val());
        if(value < 1) $("#amount").val(1)
        else if(value > max) $("#amount").val(parseInt(max))
        else if(value > 99) $("#amount").val(parseInt(99))
    })
});