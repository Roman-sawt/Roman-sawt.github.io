<?php
session_start();
require_once '../function.php';

if (isset($_SESSION['id_user'])) {
    $user = query("SELECT id_user, name, login FROM user WHERE id_user = ?", [$_SESSION['id_user']]);
    if (count($user) > 0) {
        echo json_encode(['success' => true, 'user' => $user[0]]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Пользователь не найден']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Пользователь не авторизован']);
}
?>