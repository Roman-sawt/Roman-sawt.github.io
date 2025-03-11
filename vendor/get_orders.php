<?php
session_start();
require_once '../function.php';

if (!isset($_SESSION['id_user'])) {
    die(json_encode(['success' => false, 'message' => 'Требуется авторизация']));
}

$user_id = $_SESSION['id_user'];

$orders = query("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC", [$user_id]);

echo json_encode(['success' => true, 'orders' => $orders]);
?>