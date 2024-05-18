<?php
session_start();
header('content:aplication/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('../config/conection.php');
    include('functions.php');
    try {
        $author_id = $_POST['author_id'];
        $blog_id = $_POST['blog_id'];
        $result = checkLikes($author_id, $blog_id);
        if ($result == 1) {
            $delete = removeLike($author_id, $blog_id);
            $count = getLikes($blog_id);
            $responese = ['msg' => "delete", 'id' => $blog_id, 'num' => $count];
            echo json_encode($responese);
            http_response_code(200);
        } else {
            $insert = like($author_id, $blog_id);
            $count = getLikes($blog_id);
            $responese = ['msg' => "like", 'id' => $blog_id, 'num' => $count];
            echo json_encode($responese);
            http_response_code(200);
        }
    } catch (PDOException $ex) {

        http_response_code(500);
    }
} else {
    http_response_code(404);
}
