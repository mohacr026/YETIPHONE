<script>
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
</script>

<aside id="mobile-nav">
    <h2>Navigation</h2>
    <a href="index.php?controller=Product&action=showAddProducts" class="links" tabindex="<?php echo $tabindex++; ?>">Add new products</a>
    <a href="index.php?controller=Product&action=showEditProducts" class="links" tabindex="<?php echo $tabindex++; ?>">Edit existing products</a>
    <a href="index.php?controller=Category&action=showAddCategories" class="links" tabindex="<?php echo $tabindex++; ?>">Add new categories</a>
    <a href="index.php?controller=Category&action=showEditCategories" class="links" tabindex="<?php echo $tabindex++; ?>">Edit existing categories</a>
    <a href="index.php?controller=Purchase&action=showPurchases" class="links" tabindex="<?php echo $tabindex++; ?>">Check purchases</a>
    <a href="index.php?controller=Canvas&action=signature" class="links" tabindex="<?php echo $tabindex++; ?>">Administrate signature</a>
</aside>

