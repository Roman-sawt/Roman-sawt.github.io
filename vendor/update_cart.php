<?php
session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $productId = $_POST['product_id'];
        $quantity = (int)$_POST['quantity'];

        if (array_key_exists($productId, $_SESSION['cart'])) {
            $_SESSION['cart'][$productId]['quantity'] = $quantity;
            echo json_encode(['status' => 'success', 'message' => 'Количество обновлено']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Товар не найден в корзине']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Некорректный запрос']);
    }
?>