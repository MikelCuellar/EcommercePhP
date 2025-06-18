<?php include 'products_logic.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos Deportivos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="navbar">
    <div class="logo">DEPORTIVA</div>
    
    <nav class="menu">
        <ul>
            <li><a href="#">Categorías</a></li>
            <li><a href="#">Hombre</a></li>
            <li><a href="#">Mujer</a></li>
            <li><a href="#">Niños</a></li>
            <li><a href="#">Accesorios</a></li>
            <li><a href="#">Salud</a></li>
        </ul>
    </nav>

    <div class="search-user">
        <input type="text" placeholder="Buscar...">
        <div class="icons">
            <a href="#"><img src="icons/user.svg" alt="Usuario" /></a>
            <a href="#"><img src="icons/cart.svg" alt="Carrito" /></a>
        </div>
    </div>
</header>

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
