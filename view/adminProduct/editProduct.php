<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
</head>
<body>

<?php include_once("./view/header.php"); ?>

<div class="container">
    <h2>Editar Producto</h2>

    <form action="?action=updateProduct" method="post" enctype="multipart/form-data">
        <?php
        // Obtener el ID del producto de la URL
        $productId = $_GET['id'];

        // Obtener el producto para mostrar la información actual
        $product = $this->getProductById($productId);

        if ($product) {
        ?>
        <input type="hidden" name="id" value="<?php echo $product->getId(); ?>">

        <label for="name">Nombre:</label>
        <input type="text" name="name" value="<?php echo $product->getName(); ?>" required>

        <label for="description">Descripción:</label>
        <textarea name="description" required><?php echo $product->getDescription(); ?></textarea>

        <label for="price">Precio:</label>
        <input type="number" name="price" value="<?php echo $product->getPrice(); ?>" required>

        <label for="category">Categoría:</label>
        <select name="category" required>
            <!-- Aquí deberías cargar las categorías desde la base de datos y seleccionar la actual del producto -->
            <option value="1" <?php echo ($product->getCategoryId() == 1) ? 'selected' : ''; ?>>Categoría 1</option>
            <option value="2" <?php echo ($product->getCategoryId() == 2) ? 'selected' : ''; ?>>Categoría 2</option>
            <!-- Agrega más opciones según tus categorías -->

        </select>

        <label for="stock">Stock:</label>
        <input type="number" name="stock" value="<?php echo $product->getStock(); ?>" required>

        <label for="image">Imagen:</label>
        <input type="file" name="image">

        <img src="<?php echo $product->getImage(); ?>" alt="Imagen actual" width="100">

        <button type="submit">Guardar Cambios</button>
        <?php
        } else {
            echo "Producto no encontrado.";
        }
        ?>
    </form>
</div>

<?php include_once("./view/footer.php"); ?>

</body>
</html>
