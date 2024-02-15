// Slider Destacados
let destacadosSlideIndex = 0;
let destacadosTouchStartX = 0;
let intervalId; // Variable para almacenar el ID del intervalo
let forwardDirection = true; // Variable para controlar la dirección del movimiento

function handleDestacadosTouchStart(event) {
    destacadosTouchStartX = event.touches[0].clientX;
}

function startAutoSlider() {
    intervalId = setInterval(() => {
        if (forwardDirection) {
            changeDestacadosSlide(1); // Cambiar al siguiente slide
        } else {
            changeDestacadosSlide(-1); // Cambiar al slide anterior
        }
    }, 5000); // Cambiar cada 5 segundos (ajusta según sea necesario)
}

function stopAutoSlider() {
    clearInterval(intervalId); // Detener el intervalo
}

function changeDestacadosSlide(n) {
    showDestacadosSlide(destacadosSlideIndex + n);
}

function showDestacadosSlide(index) {
    const destacadosSlides = document.querySelector('.slider-destacados .products-slider');
    const totalDestacadosSlides = document.querySelectorAll('.slider-destacados .products-slider .product').length;
    let newIndex = index;

    if (index < 0) {
        newIndex = totalDestacadosSlides - 1; // Si llega al principio, vuelve al último producto
    } else if (index >= totalDestacadosSlides) {
        newIndex = 0; // Si llega al final, vuelve al primer producto
    }

    destacadosSlideIndex = newIndex;
    destacadosSlides.style.transition = 'transform 60s linear'; // Transición lenta durante 60 segundos (ajusta según sea necesario)
    destacadosSlides.style.transform = `translateX(${-destacadosSlideIndex * 100}%)`;

    // Cambiar la dirección después de 5 segundos
    setTimeout(() => {
        forwardDirection = !forwardDirection;
    }, 5000);
}

// Iniciar el slider automático al cargar la página
startAutoSlider();
