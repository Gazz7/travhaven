<?php
session_start();
header('content:aplication/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('../config/conection.php');
    include('functions.php');
    try {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $enc = md5($password);
        $errors = 0;
        $emailRegEx = "/^([a-z0-9_ .-]+)@([\d a-z.-]+).([a-z.]{2,6})$/";

        if (preg_match($emailRegEx, $email) == 0) {

            $errors++;
        }

        $passwordRegEx = "/^(?=.*[\d])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*])[\w!@#$%^&*]{8,}$/";

        if (preg_match($passwordRegEx, $password) == 0) {

            $errors++;
        }

        if ($errors == 0) {
            $userEmail = getEmail($email);
            if (!$userEmail) {
                $responese = ['msg' => "User doesn't exist"];
                echo (json_encode($responese));
                http_response_code(201);
                exit;
            } else {
                if ($userEmail[0]->password != $enc) {
                    $responese = ['msg' => "Wrong password"];
                    echo json_encode($responese);
                    http_response_code(200);
                    exit;
                    // proba

                    exit;
                } else {
                    if ($userEmail[0]->status == 1) {
                        if ($userEmail[0]->role == 1) {
                            $_SESSION['user'] = $userEmail[0];
                            $responese = ['msg' => "Log In success"];
                            echo json_encode($responese);
                            http_response_code(200);
                            exit;
                        }
                        if ($userEmail[0]->role == 2) {
                            $_SESSION['admin'] = $userEmail[0];
                            $responese = ['msg' => "Log In success"];
                            echo json_encode($responese);
                            http_response_code(200);
                            exit;
                        }
                    }
                }
            }
        } else {
            $responese = ['msg' => "Validation error"];
            echo json_encode($responese);
            http_response_code(200);
            exit;
        }
    } catch (PDOException $ex) {

        http_response_code(500);
    }
} else {
    http_response_code(404);
}
