<?php
session_start();
require_once '../function.php';

if (!isset($_SESSION['id_user'])) {
    die(json_encode(['success' => false, 'message' => 'Требуется авторизация']));
}

$product_id = (int)$_POST['product_id'];
$user_id = $_SESSION['id_user'];

$product_exists = query("SELECT id FROM products WHERE id = ?", [$product_id]);
if (empty($product_exists)) {
    die(json_encode(['success' => false, 'message' => 'Товар не найден']));
}

$cart_item = query("SELECT id, quantity FROM cart WHERE user_id = ? AND product_id = ?", [$user_id, $product_id]);

if (empty($cart_item)) {
    $result = make("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1)", [$user_id, $product_id]);
} else {
    $result = make("UPDATE cart SET quantity = quantity + 1 WHERE id = ?", [$cart_item[0]['id']]);
}

if ($result) {
    echo json_encode(['success' => true, 'message' => 'Товар добавлен в корзину']);
} else {
    echo json_encode(['success' => false, 'message' => 'Ошибка добавления товара']);
}
?>