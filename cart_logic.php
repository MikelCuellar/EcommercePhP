<?php
session_start();

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
}

$products = [
    1 => ["name" => "Pelota de Fútbol", "price" => 15000],
    2 => ["name" => "Balón de Básquetbol", "price" => 18000],
    3 => ["name" => "Raqueta de Tenis", "price" => 30000],
    4 => ["name" => "Guantes de Boxeo", "price" => 25000]
];
?>
