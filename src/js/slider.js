let slideIndex = 0;
let touchStartX = 0;

function handleTouchStart(event) {
    touchStartX = event.touches[0].clientX;
}

function handleTouchMove(event) {
    const touchEndX = event.touches[0].clientX;
    const deltaX = touchStartX - touchEndX;

    if (Math.abs(deltaX) > 30) {
        if (deltaX > 0) {
            changeSlide(1); // Deslizar hacia la izquierda
        } else {
            changeSlide(-1); // Deslizar hacia la derecha
        }
    }
}

function showSlide(index) {
    const slides = document.querySelector('.slider');
    const totalSlides = document.querySelectorAll('.slider img').length;

    slideIndex = (index + totalSlides) % totalSlides;

    slides.style.transform = `translateX(${-slideIndex * 100}%)`;

    // Actualizar el estado de las líneas indicadoras
    const indicators = document.querySelectorAll('.indicator');
    indicators.forEach((indicator, i) => {
        indicator.classList.toggle('active', i === slideIndex);
    });
}

function changeSlide(n) {
    showSlide(slideIndex += n);
}

// Autoplay (opcional)
setInterval(() => {
    changeSlide(1);
}, 3000);
