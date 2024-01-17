document.addEventListener("DOMContentLoaded", function () {
    const image = document.getElementById('productPageShowingImage');
    const zoom = document.getElementById('zoom');
    const zoomImage = document.createElement('img');

    let clearSrc;
    let zoomLevel = 1;

    const originalImage = image.src;

    zoomImage.setAttribute('src', originalImage);
    zoom.appendChild(zoomImage);

    const preloadImage = url => {
        let img = new Image();
        img.src = url;
    }

    preloadImage(originalImage);

    const enterImage = function (e) {
        zoom.classList.add('show', 'loading');
        clearTimeout(clearSrc);

        let posX, posY, touch = false;

        if (e.touches) {
            posX = e.touches[0].clientX;
            posY = e.touches[0].clientY;
            touch = true;
        } else {
            posX = e.clientX;
            posY = e.clientY;
        }

        // Center zoom on image
        zoom.style.top = `${posY - zoom.offsetHeight / 2}px`;
        zoom.style.left = `${posX - zoom.offsetWidth / 2}px`;

        zoomImage.setAttribute('src', originalImage);

        zoomImage.onload = function () {
            console.log('hires image loaded!');
            setTimeout(() => {
                zoom.classList.remove('loading');
            }, 500);
        }
    }

    const leaveImage = function () {
        zoom.style.transform = null;
        zoomLevel = 1;
        zoom.classList.remove('show');
        clearSrc = setTimeout(() => {
            zoomImage.setAttribute('src', '');
        }, 250);
    }

    const move = function (e) {
        e.preventDefault();

        let posX, posY, touch = false;

        if (e.touches) {
            posX = e.touches[0].clientX;
            posY = e.touches[0].clientY;
            touch = true;
        } else {
            posX = e.clientX;
            posY = e.clientY;
        }

        zoom.style.top = `${posY - zoom.offsetHeight / 2}px`;
        zoom.style.left = `${posX - zoom.offsetWidth / 2}px`;

        let percX = (posX - image.offsetLeft) / image.offsetWidth,
            percY = (posY - image.offsetTop) / image.offsetHeight;

        let zoomLeft = -percX * zoomImage.offsetWidth + (zoom.offsetWidth / 2),
            zoomTop = -percY * zoomImage.offsetHeight + (zoom.offsetHeight / 2);

        zoomImage.style.left = `${zoomLeft}px`;
        zoomImage.style.top = `${zoomTop}px`;
    }

    const handleZoom = function (e) {
        e.preventDefault();
        e.deltaY > 0 ? zoomLevel -= 0.1 : zoomLevel += 0.1;

        // Limit zoom to 1.5
        if (zoomLevel < 1) zoomLevel = 1;
        if (zoomLevel > 1.5) zoomLevel = 1.5;

        console.log(`zoom level: ${zoomLevel}`);
        zoom.style.transform = `scale(${zoomLevel})`;
    }

    image.addEventListener('mouseenter', enterImage);
    image.addEventListener('touchstart', enterImage);

    image.addEventListener('mouseleave', leaveImage);
    image.addEventListener('touchend', leaveImage);

    image.addEventListener('mousemove', move);
    image.addEventListener('touchmove', move);

    image.addEventListener('wheel', handleZoom);
});
