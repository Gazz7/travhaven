<?php
header('content:aplication/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('../config/conection.php');
    include('functions.php');
    try {
        $ID = $_POST['ID'];
        $result = delete($ID, 'comments', 'comment_ID');
        header("Location:../index.php?page=adminPanel");
    } catch (PDOException $ex) {

        http_response_code(500);
    }
} else {
    http_response_code(404);
}
