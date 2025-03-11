<?php
    session_start();
    require_once '../function.php';

    $name = validate($_POST['name']);
    $login = validate($_POST['login']);
    $password = validate($_POST['password']);

    $checkUser = query("SELECT id_user FROM user WHERE login = ?", [$login]);

    if (count($checkUser) > 0) {
        echo json_encode(['success' => false, 'message' => 'Такой логин уже занят']);
    } else {
        make("INSERT INTO user (name, login, password) VALUES (?, ?, ?)", [$name, $login, $password]);
        echo json_encode(['success' => true, 'message' => 'Регистрация прошла успешно']);
    }
?>