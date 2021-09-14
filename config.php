<?php

session_start();

$is_auth = false;
$user_name = null;
$user_avatar = null;

if (isset($_SESSION['user'])) {
    $user_name = $_SESSION['user']['UserName'];
    $is_auth = true;
    $user_avatar = $_SESSION['user']['UserImgPath'];
}
