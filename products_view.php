<?php include 'products_logic.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos Deportivos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="product-grid">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                <div class="product-info">
                    <h3><?= $product['name'] ?></h3>
                    <p class="price">$<?= number_format($product['price'], 0, ',', '.') ?></p>
                    <form action="cart.php" method="post">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <button type="submit">Agregar al carrito</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
