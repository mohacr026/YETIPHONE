document.addEventListener("DOMContentLoaded", function() {
    const toggleButton = document.createElement('button');
    toggleButton.textContent = '☰';
    toggleButton.classList.add('toggle-button');
    document.body.appendChild(toggleButton);
    
    toggleButton.addEventListener('click', function() {
        const mobileNav = document.getElementById('mobile-nav');
        if (mobileNav.style.display === 'none' || mobileNav.style.display === '') {
            mobileNav.style.display = 'block';
        } else {
            mobileNav.style.display = 'none';
        }
    });
});

