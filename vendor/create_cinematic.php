<?php
session_start();
require_once '../function.php';

if (!isset($_SESSION['id_user'])) {
    die(json_encode(['success' => false, 'message' => 'Требуется авторизация']));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['id_user'];
    $project_name = validate($_POST['project_name']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $video_type = validate($_POST['video_type']);
    $duration = (int)$_POST['duration'];
    $deadline = validate($_POST['deadline']);
    $description = validate($_POST['description']);
    $concept_art = isset($_POST['concept_art']) ? 1 : 0;
    $professional_sound = isset($_POST['professional_sound']) ? 1 : 0;
    $logo_animation = isset($_POST['logo_animation']) ? 1 : 0;

    $files = [];

    $files_json = json_encode($files);

    $sql = "INSERT INTO orders (
                user_id, project_name, email, phone, video_type, duration, deadline, 
                description, concept_art, professional_sound, logo_animation, files
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $params = [
        $user_id, $project_name, $email, $phone, $video_type, $duration, $deadline,
        $description, $concept_art, $professional_sound, $logo_animation, $files_json
    ];

    $result = make($sql, $params);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Заказ успешно создан']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Ошибка при создании заказа']);
    }

} else {
    echo json_encode(['success' => false, 'message' => 'Некорректный запрос']);
}
?>