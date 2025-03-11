<?php
    session_start();
    require_once '../function.php'; 

if (!isset($_SESSION['id_user'])) {
    die(json_encode(['success' => false, 'message' => 'Требуется авторизация']));
}

$user_id = $_SESSION['id_user'];

$cart_items = query("
    SELECT c.*, p.title, p.price 
    FROM cart c
    JOIN products p ON c.product_id = p.id
    WHERE c.user_id = ?
", [$user_id]);

if (empty($cart_items)) {
    die(json_encode(['success' => false, 'message' => 'Корзина пуста']));
}

make("DELETE FROM cart WHERE user_id = ?", [$user_id]);

echo json_encode(['success' => true, 'message' => 'Заказ успешно оформлен']);
?>