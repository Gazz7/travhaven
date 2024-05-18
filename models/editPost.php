<?php
header('Content:application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('../config/conection.php');
    include('functions.php');
    try {
        $title = $_POST['title'];
        $content = $_POST['contentE'];
        $ID = $_POST['idEdit'];

        $targetDir = '../assets/images/';
        $extensions = ['jpg', 'png', 'jpeg', 'JPG'];
        $fileName = $_FILES['file']['name'];
        $fileName = isset($_FILES['file']['name']) ? $_FILES['file']['name'] : '';
        if (!empty($fileName)) {
            $targetPath = $targetDir . $fileName;
            $fileType = pathinfo($targetPath, PATHINFO_EXTENSION);
            if (in_array($fileType, $extensions)) {
                if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
                    $result = editPost($ID, $title, $content, $fileName);
                    echo json_encode(['success' => true]);

                    header("Location:../index.php?page=userPanel");
                    exit;
                } else {
                }
            } else {
            }
        } else {
        }
    } catch (PDOException $ex) {

        http_response_code(500);
    }
} else {
    http_response_code(404);
}
