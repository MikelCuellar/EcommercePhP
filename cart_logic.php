<?php
session_start();
include 'products_logic.php'; // este trae el array real de productos

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    if (!isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] = 1;
    } else {
        $_SESSION['cart'][$productId]++;
    }
    echo json_encode(['status' => 'ok']);
    exit;

        // Calcular total actualizado
        $total_items = array_sum($_SESSION['cart']);

        echo json_encode(['status' => 'ok', 'total_items' => $total_items]);
        exit;
    }
?>
