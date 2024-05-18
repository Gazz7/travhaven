<?php
header('Content:application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('../config/conection.php');
    include('functions.php');
    try {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $ID = $_POST['ID'];

        $targetDir = '../assets/images/';
        $extensions = ['jpg', 'png', 'jpeg', 'JPG', 'PNG', 'JPEG'];
        $fileName = $_FILES['img']['name'];
        $fileName = isset($_FILES['img']['name']) ? $_FILES['img']['name'] : '';
        if (!empty($fileName)) {
            $targetPath = $targetDir . $fileName;
            $fileType = pathinfo($targetPath, PATHINFO_EXTENSION);
            if (in_array($fileType, $extensions)) {
                if (move_uploaded_file($_FILES['img']['tmp_name'], $targetPath)) {
                    $result = createPost($ID, $title, $content, $fileName);
                    echo json_encode(['success' => true]);
                    var_dump("JAAAA");
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
