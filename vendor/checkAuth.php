<?php
    session_start();
    require_once '../function.php';

    if (isset($_SESSION['id_user'])) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
?>