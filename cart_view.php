<?php include 'cart_logic.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Carrito de Compras</h2>
    <div class="product-grid">
        <?php 
        $total = 0;
        foreach ($_SESSION['cart'] as $id => $quantity):
            $product = $products[$id];
            $subtotal = $product['price'] * $quantity;
            $total += $subtotal;
        ?>
            <div class="product-card">
                <div class="product-info">
                    <h3><?= $product['name'] ?></h3>
                    <p>Cantidad: <?= $quantity ?></p>
                    <p class="price">Subtotal: $<?= number_format($subtotal, 0, ',', '.') ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <h3>Total: $<?= number_format($total, 0, ',', '.') ?></h3>
    <form action="generate_invoice.php" method="post">
        <button type="submit">Generar Boleta</button>
    </form>
</body>
</html>
