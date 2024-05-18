<?php
function getAll($table)
{
    global $conn;
    $upit = "SELECT * FROM  $table";
    $result = $conn->query($upit)->fetchAll();
    return $result;
}
function getBlogData()
{
    global $conn;
    $upit = "SELECT * FROM blogs as b INNER JOIN users as u ON b.author_ID = u.ID";
    $result = $conn->query($upit)->fetchAll();
    return $result;
}

function getSinglePost($id)
{
    global $conn;
    $upit = " SELECT * FROM blogs as b INNER JOIN users as u ON b.author_ID = u.ID WHERE b.blog_ID = :id ";
    $prepare = $conn->prepare($upit);
    $prepare->bindParam(":id", $id);
    $prepare->execute();
    $result = $prepare->fetchAll();
    return $result;
}
function getComments()
{
    global $conn;
    $upit = "SELECT * FROM comments as c INNER JOIN users as u ON c.author_ID = u.ID";
    $result = $conn->query($upit)->fetchAll();
    return $result;
}

function getCommentsForBlog($id)
{
    global $conn;
    $upit = "SELECT COUNT(comment_ID) as 'Num' FROM `comments` WHERE blog_ID = :id";
    $prepare = $conn->prepare($upit);
    $prepare->bindParam(":id", $id);
    $prepare->execute();
    $result = $prepare->fetchAll();
    return $result;
}

function getCommentContent($id)
{
    global $conn;
    $upit = "SELECT comment_ID, content, created_at, username, image FROM `comments` as c INNER JOIN `users` as u ON u.ID=c.author_ID WHERE c.blog_ID = :id";
    $prepare = $conn->prepare($upit);
    $prepare->bindParam(":id", $id);
    $prepare->execute();
    $result = $prepare->fetchAll();
    return $result;
}

function getEmail($email)
{
    global $conn;
    $upit = "SELECT * FROM users WHERE email = :email";
    $prepare = $conn->prepare($upit);
    $prepare->bindParam(":email", $email);
    $prepare->execute();
    $result = $prepare->fetchAll();
    return $result;
}

function register($username, $email, $hashpass)
{
    global $conn;
    $upit = "INSERT INTO `users` (`ID`, `username`, `email`, `password`, `image`, `role`, `status`, `datetime_created`) VALUES (NULL, ?, ?, ?, 'profile.png', '1', '1', current_timestamp())";
    $prepare = $conn->prepare($upit);
    $prepare->bindParam(1, $username);
    $prepare->bindParam(2, $email);
    $prepare->bindParam(3, $hashpass);
    $prepare->execute();
    $result = $prepare->fetchAll();
    return $result;
}

function insertComment($postId, $userId, $conntent)
{

    global $conn;
    $upit = "INSERT INTO `comments` (`comment_ID`, `content`, `created_at`, `blog_ID`, `author_ID`) VALUES (NULL, ?, current_timestamp(), ?, ?)";
    $prepare = $conn->prepare($upit);
    $prepare->bindParam(1, $conntent);
    $prepare->bindParam(2, $postId);
    $prepare->bindParam(3, $userId);
    $prepare->execute();
    $result = $prepare->fetchAll();
    return $result;
}

function insertMessage($email, $subject, $content)
{

    global $conn;
    $upit = "INSERT INTO `messages` (`message_ID`, `subject`, `content`, `email`, `received_at`) VALUES (NULL, ?, ?, ?, current_timestamp())";
    $prepare = $conn->prepare($upit);
    $prepare->bindParam(1, $subject);
    $prepare->bindParam(2, $content);
    $prepare->bindParam(3, $email);
    $prepare->execute();
    $result = $prepare->fetchAll();
    return $result;
}

function delete($ID, $table, $column)
{

    global $conn;
    $upit = "DELETE FROM $table WHERE $table. $column = ?";
    $prepare = $conn->prepare($upit);
    $prepare->bindParam(1, $ID);
    $prepare->execute();
    $result = $prepare->fetchAll();
    return $result;
}

function update($ID, $column, $value)
{
    global $conn;
    $upit = "UPDATE `users` SET $column = ? WHERE `users`.`ID` = ?";
    $prepare = $conn->prepare($upit);
    $prepare->bindParam(1, $value);
    $prepare->bindParam(2, $ID);
    $prepare->execute();
    $result = $prepare->fetchAll();
    return $result;
}

// function createPost($ID, $title, $content, $fileName)
// {
//     global $conn;
//     $upit = "INSERT INTO `blogs` (`blog_ID`, `title`, `content`, `image`, `likes`, `author_ID`, `created_at`) VALUES (NULL, ?, ?, ?, '0', ?, current_timestamp())";
//     $prepare = $conn->prepare($upit);
//     $prepare->bindParam(1, $title);
//     $prepare->bindParam(2, $content);
//     $prepare->bindParam(3, $fileName);
//     $prepare->bindParam(4, $ID);
//     $prepare->execute();
//     $result = $prepare->fetchAll();
//     return $result;
// }
function createPost($id, $title, $content, $fileName)
{
    global $conn;
    $upit = "INSERT INTO `blogs` (`blog_ID`, `title`, `content`, `images`, `likes`, `author_ID`, `created_at`) VALUES (NULL, ?, ?, ?, '0', ?, current_timestamp())";
    $prepare = $conn->prepare($upit);
    $prepare->bindParam(1, $title);
    $prepare->bindParam(2, $content);
    $prepare->bindParam(3, $fileName); // Swap the order of these two lines
    $prepare->bindParam(4, $id); // Swap the order of these two lines
    $prepare->execute();
    $result = $prepare->fetchAll();
    return $result;
}

function getUserPosts($ID)
{

    global $conn;
    $upit = "SELECT * FROM `blogs`  WHERE `author_ID`=? ";
    $prepare = $conn->prepare($upit);
    $prepare->bindParam(1, $ID);
    $prepare->execute();
    $result = $prepare->fetchAll();
    return $result;
}

function getUserComments($ID)
{

    global $conn;
    $upit = "SELECT * FROM `comments` WHERE `author_ID`=? ";
    $prepare = $conn->prepare($upit);
    $prepare->bindParam(1, $ID);
    $prepare->execute();
    $result = $prepare->fetchAll();
    return $result;
}
function getUser($id)
{
    global $conn;
    $upit = "SELECT username FROM `users` WHERE ID = ?";
    $prepare = $conn->prepare($upit);
    $prepare->bindParam(1, $id);
    $prepare->execute();
    $result = $prepare->fetchAll();
    return $result;
}

function getLikes($id)
{
    global $conn;
    $upit = "SELECT COUNT(*) as `Num` FROM `likes` WHERE blog_id = ?";
    $prepare = $conn->prepare($upit);
    $prepare->bindParam(1, $id);
    $prepare->execute();
    $result = $prepare->fetch();
    return $result;
}
function checkLikes($auth_id, $blog_id)
{
    global $conn;
    $upit1 = "SELECT COUNT(*) as `Num` FROM `likes` WHERE blog_id = ? AND author_id = ?";
    $prepare = $conn->prepare($upit1);
    $prepare->bindParam(1, $blog_id);
    $prepare->bindParam(2, $auth_id);
    $prepare->execute();
    $result = $prepare->fetch();
    return $result->Num;
}
function removeLike($auth_id, $blog_id)
{
    global $conn;
    $upit2 = "DELETE  FROM `likes` WHERE blog_id = ? AND author_id = ?";
    $prepare = $conn->prepare($upit2);
    $prepare->bindParam(1, $blog_id);
    $prepare->bindParam(2, $auth_id);
    $prepare->execute();
    $result1 = $prepare->fetch();

    return $result1;
}
function like($auth_id, $blog_id)
{
    global $conn;
    $upit3 = "INSERT INTO `likes` (`likes_id`, `blog_id`, `author_id`) VALUES (NULL, ?, ?)";
    $prepare = $conn->prepare($upit3);
    $prepare->bindParam(1, $blog_id);
    $prepare->bindParam(2, $auth_id);
    $prepare->execute();
    $result3 = $prepare->fetch();


    return $result3;
}

function checkUser($email)
{
    global $conn;
    $upit1 = "SELECT COUNT(*) as `Num` FROM `users` WHERE email = ? ";
    $prepare = $conn->prepare($upit1);
    $prepare->bindParam(1, $email);
    $prepare->execute();
    $result = $prepare->fetch();
    return $result->Num;
}

function editPost($id, $title, $content, $fileName)
{
    global $conn;
    $upit = "UPDATE `blogs` SET `title` = ?, `content` = ?, `images` = ?, `likes` = '' WHERE `blogs`.`blog_ID` = ?";
    $prepare = $conn->prepare($upit);
    $prepare->bindParam(1, $title);
    $prepare->bindParam(2, $content);
    $prepare->bindParam(3, $fileName);
    $prepare->bindParam(4, $id);
    $prepare->execute();
    $result = $prepare->fetch();
    return $result;
}


function numPost($id)
{
    global $conn;
    $upit = "SELECT COUNT(*) FROM `blogs` WHERE author_ID = ?";
    $prepare = $conn->prepare($upit);
    $prepare->bindParam(1, $id);
    $prepare->execute();
    $result = $prepare->fetchAll();
    return $result;
}

function editUser($id, $userName, $fileName)
{
    global $conn;
    $upit = "UPDATE `users` SET `username` = ?, `image` = ? WHERE `users`.`ID` = ?";
    $prepare = $conn->prepare($upit);
    $prepare->bindParam(1, $userName);
    $prepare->bindParam(2, $fileName);
    $prepare->bindParam(3, $id);
    $prepare->execute();
    $result = $prepare->fetchAll();
    return $result;
}
