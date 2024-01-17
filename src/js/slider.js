// Slider Principal
let principalSlideIndex = 0;
let principalTouchStartX = 0;

function handlePrincipalTouchStart(event) {
    principalTouchStartX = event.touches[0].clientX;
}

function handlePrincipalTouchMove(event) {
    const principalTouchEndX = event.touches[0].clientX;
    const deltaX = principalTouchStartX - principalTouchEndX;

    if (Math.abs(deltaX) > 30) {
        if (deltaX > 0) {
            changePrincipalSlide(1); // Deslizar hacia la izquierda
        } else {
            changePrincipalSlide(-1); // Deslizar hacia la derecha
        }
    }
}

function showPrincipalSlide(index) {
    const principalSlides = document.querySelector('.slider-principal .slider');
    const totalPrincipalSlides = document.querySelectorAll('.slider-principal .slider img').length;

    principalSlideIndex = (index + totalPrincipalSlides) % totalPrincipalSlides;

    principalSlides.style.transform = `translateX(${-principalSlideIndex * 100}%)`;

    // Actualizar el estado de las líneas indicadoras
    const indicators = document.querySelectorAll('.slider-principal .indicator');
    indicators.forEach((indicator, i) => {
        indicator.classList.toggle('active', i === principalSlideIndex);
    });
}

function changePrincipalSlide(n) {
    showPrincipalSlide(principalSlideIndex += n);
}

// Slider Destacados
let destacadosSlideIndex = 0;
let destacadosTouchStartX = 0;

function handleDestacadosTouchStart(event) {
    destacadosTouchStartX = event.touches[0].clientX;
}

function handleDestacadosTouchMove(event) {
    const destacadosTouchEndX = event.touches[0].clientX;
    const deltaX = destacadosTouchStartX - destacadosTouchEndX;

    if (Math.abs(deltaX) > 30) {
        if (deltaX > 0) {
            changeDestacadosSlide(1); // Deslizar hacia la izquierda
        } else {
            changeDestacadosSlide(-1); // Deslizar hacia la derecha
        }
    }
}

function showDestacadosSlide(index) {
    const destacadosSlides = document.querySelector('.slider-destacados .products-slider');
    const totalDestacadosSlides = document.querySelectorAll('.slider-destacados .products-slider .productImg').length;

    destacadosSlideIndex = (index + totalDestacadosSlides) % totalDestacadosSlides;

    destacadosSlides.style.transform = `translateX(${-destacadosSlideIndex * 100}%)`;
}

function changeDestacadosSlide(n) {
    showDestacadosSlide(destacadosSlideIndex += n);
}

// Autoplay para ambos sliders (opcional)
setInterval(() => {
    changePrincipalSlide(1);
}, 10000);

