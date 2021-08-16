<?php
require ('config.php');
require ('functions.php');
require ('data.php');

$page_content = includeTemplate('sign-up.php', [
    'categories' => $categories,
    'lots' => $lots,
]);

$layout_content = includeTemplate('layout.php', [
    'content' => $page_content,
    'is_auth' => $is_auth,
    'categories' => $categories,
    'user_name' => $user_name,
    'user_avatar'=>$user_avatar,
    'title' => "Home page"
]);

print($layout_content);
?>