<?php
header('content:aplication/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('../config/conection.php');
    include('functions.php');
    try {
        $value = $_POST['ID'];
        $ID = $_POST['userID'];
        $result = update($ID, 'role', $value);
        header("Location:../index.php?page=adminPanel");
    } catch (PDOException $ex) {

        http_response_code(500);
    }
} else {
    http_response_code(404);
}
