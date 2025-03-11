<?php
require_once '../function.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $description = validate($_POST['description']);

    $sql = "INSERT INTO applications (name, email, description) VALUES (?, ?, ?)";
    $params = [$name, $email, $description];

    $result = make($sql, $params);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Заявка успешно отправлена']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Ошибка при отправке заявки']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Некорректный запрос']);
}
?>