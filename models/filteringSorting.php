<?php

header('content:aplication/json');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include('../config/conection.php');
    include('functions.php');
    try {
        $query = "SELECT * FROM `blogs` AS b INNER JOIN `users` u ON b.author_ID = u.ID WHERE `u`.`status` = 1";

        $params = [];

        if (isset($_GET['search'])) {

            $query .= " AND (`b`.`title` LIKE ?) ORDER BY `b`.`created_at` DESC";

            $search = "%" . $_GET['search'] . "%";

            array_push($params, $search);
        }



        // executing the query

        global $conn;

        $exec = $conn->prepare($query);

        $exec->execute($params);

        $result = $exec->fetchAll();

        $numOfBlogs = count($result);

        // getting only 6 blogs

        $blogsPerPage = $_GET['blogsPerPage'];

        $page = ($_GET['page'] - 1) * $blogsPerPage;

        $blogs = [];

        for ($i = $page; $i < $blogsPerPage + $page; $i++) {

            if ($i >= count($result)) break;

            array_push($blogs, $result[$i]);
        }
        // for ($i = 0; $i < count($blogs); $i++) {
        //     $blogs[$i]['likes'] = getLikes($blogs[$i]->ID);
        // }
        foreach ($blogs as $b) {
            $b->likes = getLikes($b->blog_ID);
        }
        foreach ($blogs as $b) {
            $b->comments = getCommentsForBlog($b->blog_ID);
        }



        // response

        $response = ['blogs' => $blogs, 'num' => $numOfBlogs];

        echo json_encode($response);

        http_response_code(200);
    } catch (PDOException $ex) {
        http_response_code(500);
    }
} else {
    http_response_code(404);
}
