<?php
session_start();
header('content:aplication/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('../config/conection.php');
    include('functions.php');
    try {
        $postId = $_POST['post'];
        $userId = $_POST['user'];
        $content = $_POST['comment'];
        $result = insertComment($postId, $userId, $content);
        if ($result) {
            $responese = ['msg' => "Success add comment"];
            echo json_encode($responese);
            http_response_code(200);
            header('Location: ../index.php?page=single&post=' . $postId);
        } else {
            $responese = ['msg' => "Success registration"];
            echo json_encode($responese);
            http_response_code(200);
            header('Location: ../index.php?page=single&post=' . $postId);
        }
    } catch (PDOException $ex) {

        http_response_code(500);
    }
} else {
    http_response_code(404);
}
