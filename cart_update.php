<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $product_id = $_POST['product_id'] ?? '';

    if (!is_numeric($product_id)) {
        header("Location: cart_view.php");
        exit;
    }

    switch ($action) {
        case 'increase':
            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id]++;
            }
            break;

        case 'decrease':
            if (isset($_SESSION['cart'][$product_id]) && $_SESSION['cart'][$product_id] > 1) {
                $_SESSION['cart'][$product_id]--;
            }
            break;

        case 'remove':
            if (isset($_SESSION['cart'][$product_id])) {
                unset($_SESSION['cart'][$product_id]);
            }
            break;
    }
}

header("Location: cart_view.php");
exit;
