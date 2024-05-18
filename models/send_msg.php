<?php
header('content:aplication/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('../config/conection.php');
    include('functions.php');
    try {
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $content = $_POST['content'];
        $errors = 0;
        $emailReg = "/^([a-z0-9_ .-]+)@([\d a-z.-]+).([a-z.]{2,6})$/";
        if (preg_match($emailReg, $email) == 0) {

            $errors++;
        }
        if ($errors == 0) {
            $result = insertMessage($email, $subject, $content);


            if ($result) {
                $responese = ['msg' => "Success add comment"];
                echo json_encode($responese);
                http_response_code(200);
                header('Location: ../index.php?page=home');
            } else {
                $responese = ['msg' => "Success registration"];
                echo json_encode($responese);
                http_response_code(200);
                header('Location: ../index.php?page=home');
            }
        }
    } catch (PDOException $ex) {

        http_response_code(500);
    }
} else {
    http_response_code(404);
}
