<?php
session_start();
require_once '../function.php'; 

    if (!isset($_SESSION['id_user'])) {
        die(json_encode(['success' => false, 'message' => 'Требуется авторизация']));
    }

    $product_id = (int)$_POST['product_id'];
    $user_id = $_SESSION['id_user'];

    $result = make("DELETE FROM cart WHERE user_id = ? AND product_id = ?", [$user_id, $product_id]);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Товар удален из корзины']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Ошибка удаления товара']);
    }
?>