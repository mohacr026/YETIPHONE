<aside>
    <label for="search"><h2>Search</h2></label>
    <input type="text" name="search" id="search" class="searchBar" tabindex="<?php echo $tabindex++; ?>" aria-label="Search">
    <h2>Navigation</h2>
    <a href="index.php?controller=Product&action=showAddProducts" tabindex="<?php echo $tabindex++; ?>">Add new products</a>
    <a href="index.php?controller=Product&action=showEditProducts" tabindex="<?php echo $tabindex++; ?>">Edit existing products</a>
    <a href="index.php?controller=Category&action=showAddCategories" tabindex="<?php echo $tabindex++; ?>">Add new categories</a>
    <a href="index.php?controller=Category&action=showEditCategories" tabindex="<?php echo $tabindex++; ?>">Edit existing categories</a>
    <a href="index.php?controller=Purchase&action=showPurchases" tabindex="<?php echo $tabindex++; ?>">Check purchases</a>
    <a href="index.php?controller=Canvas&action=signature" tabindex="<?php echo $tabindex++; ?>">Administrate signature</a>
    <a href="index.php?controller=Product&action=showInterfaz" tabindex="<?php echo $tabindex++; ?>">Go to user interface</a>
</aside>