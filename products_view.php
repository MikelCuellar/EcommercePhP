<?php
session_start();
include 'products_logic.php';

$total_items = array_sum($_SESSION['cart'] ?? []);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos Deportivos</title>
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

<div class="product-grid">
    <?php foreach ($products as $product): ?>
        <div class="product-card">
            <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
            <div class="product-info">
                <h3><?= $product['name'] ?></h3>
                <p class="price">$<?= number_format($product['price'], 0, ',', '.') ?></p>
                <form>
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <button type="button" class="add-to-cart-btn" data-id="<?= $product['id'] ?>">Añadir al carrito</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Mensaje emergente personalizado -->
<div id="cart-message">
    <p>Producto agregado al carrito</p>
    <button onclick="window.location.href='cart_view.php'">Ir al carrito</button>
    <button onclick="closeCartMessage()">Seguir comprando</button>
</div>

<!-- Script para carrito -->
<script>
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.dataset.id;

            fetch('cart_logic.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'product_id=' + encodeURIComponent(productId)
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'ok') {
                    document.getElementById('cart-message').style.display = 'block';

                    const cartCount = document.querySelector('.cart-count');
                    if (cartCount) {
                        cartCount.textContent = data.total_items;
                    } else {
                        const cartIcon = document.querySelector('.cart-icon');
                        const newCount = document.createElement('span');
                        newCount.classList.add('cart-count');
                        newCount.textContent = data.total_items;
                        cartIcon.appendChild(newCount);
                    }
                } else {
                    alert('Hubo un error al agregar al carrito');
                }
            });
        });
    });

    function closeCartMessage() {
        document.getElementById('cart-message').style.display = 'none';
    }
</script>

<!-- Script para abrir/cerrar submenú de Categorías -->
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

</body>
</html>
