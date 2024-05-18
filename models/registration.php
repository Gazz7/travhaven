<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('../config/conection.php');
    include('functions.php');
    try {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $passc = $_POST['passc'];
        $errors = 0;
        $passReg = "/^(?=.*[\d])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*])[\w!@#$%^&*]{8,}$/";
        $emailReg = "/^([a-z0-9_ .-]+)@([\d a-z.-]+).([a-z.]{2,6})$/";
        $chckEmail = checkUser($email);

        if ($chckEmail > 0) {
            $errors++;
        }
        if ($pass != $passc) {
            $errors++;
        }
        if (preg_match($passReg, $pass) == 0) {

            $errors++;
        }
        if (preg_match($emailReg, $email) == 0) {

            $errors++;
        }
        if ($errors == 0) {
            $hashpass = md5($pass);

            $reg = register($username, $email, $hashpass);
            if ($reg) {
                $responese = ['msg' => "Success registration"];
                echo json_encode($responese);
                http_response_code(200);
                header('Location: ../index.php?page=home');
            } else {
                $responese = ['msg' => "Registration failed"];
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
