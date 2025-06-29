<?php
session_start();
include 'products_logic.php';

$total_items = array_sum($_SESSION['cart'] ?? []);

function findProductById($products, $id) {
    foreach ($products as $product) {
        if ($product['id'] == $id) {
            return $product;
        }
    }
    return null;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="navbar">
    <a href="products_view.php" class="logo">DEPORTIVA</a>

    <nav class="menu">
        <ul>
            <li class="dropdown">
                <a href="#" id="toggle-categorias">Categorías</a>
                <ul class="dropdown-menu" id="submenu-categorias">
                    <li><a href="#">Fútbol</a></li>
                    <li><a href="#">Básquetbol</a></li>
                    <li><a href="#">Tenis</a></li>
                    <li><a href="#">Running</a></li>
                    <li><a href="#">Boxeo</a></li>
                </ul>
            </li>
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
            <a href="cart_view.php" class="cart-icon">
                <img src="icons/cart.svg" alt="Carrito" />
                <span class="cart-count"><?= $total_items ?></span>
            </a>
        </div>
    </div>
</header>

<h2 class="cart-title">Carrito de Compras</h2>

<div class="cart-items-container">
<?php 
$total = 0;
foreach ($_SESSION['cart'] as $id => $quantity):
    $product = findProductById($products, $id);
    if (!$product) {
        echo "<div class='product-card'><p>Producto ID $id no encontrado.</p></div>";
        continue;
    }

    $subtotal = $product['price'] * $quantity;
    $total += $subtotal;
?>
<div class="product-card product-item">
    <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
    <div class="item-details">
        <h3><?= $product['name'] ?></h3>
        <p class="price"><strong>Subtotal: $<?= number_format($subtotal, 0, ',', '.') ?></strong></p>

        <div class="cart-quantity-controls">
            <form action="cart_update.php" method="post" style="display:inline;">
                <input type="hidden" name="action" value="decrease">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <button type="submit">-</button>
            </form>

            <span class="quantity-display"><?= $quantity ?></span>

            <form action="cart_update.php" method="post" style="display:inline;">
                <input type="hidden" name="action" value="increase">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <button type="submit">+</button>
            </form>

            <form action="cart_update.php" method="post" style="display:inline;">
                <input type="hidden" name="action" value="remove">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <button type="submit" class="remove-button">X</button>
            </form>
        </div>
    </div>
</div>



<?php endforeach; ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggle = document.getElementById('toggle-categorias');
        const submenu = document.getElementById('submenu-categorias');
        const dropdown = toggle.closest('.dropdown');

        toggle.addEventListener('click', function (e) {
            e.preventDefault();
            dropdown.classList.toggle('open');
        });

        document.addEventListener('click', function (e) {
            if (!dropdown.contains(e.target)) {
                dropdown.classList.remove('open');
            }
        });
    });
</script>

<div class="cart-total-container">
    <div class="cart-total-box">
        <h3>Total a pagar:</h3>
        <p class="cart-total-amount">$<?= number_format($total, 0, ',', '.') ?></p>
    </div>
    <form action="checkout.php" method="get">
        <button type="submit" class="custom-button">Ir a pagar</button>
    </form>
</div>

</body>
</html>
