<?php
session_start();
include 'products_logic.php';
include 'db_connection.php'; // Asegúrate de tener este archivo con $conn

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT fullname, email, phone, address FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($nombre, $email, $telefono, $direccion);
$stmt->fetch();
$stmt->close(); 

function findProductById($products, $id) {
    foreach ($products as $p) {
        if ($p['id'] == $id) return $p;
    }
    return null;
}

$total = 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css" />

</head>
<body>

<div class="checkout-wrapper">
    <!-- Productos en el carrito -->
    <div class="checkout-left">
        <h3>Resumen de tu compra</h3>
        <?php if (!empty($_SESSION['cart'])): ?>
            <?php foreach ($_SESSION['cart'] as $id => $qty): 
                $product = findProductById($products, $id);
                if (!$product) continue;
                $subtotal = $product['price'] * $qty;
                $total += $subtotal;
            ?>
                <div class="product-item">
                    <strong><?= $product['name'] ?></strong><br>
                    Cantidad: <?= $qty ?><br>
                    Subtotal: $<?= number_format($subtotal, 0, ',', '.') ?>
                </div>
            <?php endforeach; ?>
            <h4>Total a pagar: $<?= number_format($total, 0, ',', '.') ?></h4>
        <?php else: ?>
            <p>No tienes productos en el carrito.</p>
        <?php endif; ?>
    </div>

    <!-- Formulario de datos del cliente -->
    <div class="checkout-right">
        <h3>Datos para el pago</h3>
        <form action="generate_invoice_view.php" method="post">
        <input type="text" name="nombre" value="<?= htmlspecialchars($nombre) ?>" required>
        <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
        <input type="telefono" name="email" value="<?= htmlspecialchars($telefono) ?>" required>
        <textarea name="direccion" required><?= htmlspecialchars($direccion) ?></textarea>

            
            <!-- Aquí puedes agregar campos como método de pago o número de tarjeta ficticio -->

            <button type="submit">Confirmar y Generar Boleta</button>
        </form>
    </div>
</div>

</body>
</html>
