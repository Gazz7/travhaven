<?php
header('Content:application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('../config/conection.php');
    include('functions.php');
    try {
        $userName = $_POST['username'];
        $ID = $_POST['idUser'];
        $targetDir = '../assets/images/';
        $extensions = ['jpg', 'png', 'jpeg', 'JPG'];
        $fileName = $_FILES['fileImg']['name'];
        $fileName = isset($_FILES['fileImg']['name']) ? $_FILES['fileImg']['name'] : '';
        if (!empty($fileName)) {
            $targetPath = $targetDir . $fileName;
            $fileType = pathinfo($targetPath, PATHINFO_EXTENSION);
            if (in_array($fileType, $extensions)) {
                if (move_uploaded_file($_FILES['fileImg']['tmp_name'], $targetPath)) {
                    $result = editUser($ID, $userName, $fileName);
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
