<?php
session_start();
if (isset($_SESSION['admin'])) {
    unset($_SESSION['admin']);
} elseif (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
}
header('Location:../index.php?page=home');
