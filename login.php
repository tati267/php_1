<?php
require 'data.php';
require 'functions.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form = $_POST;

    $required = ['email', 'password'];
    $errors = [];
    foreach ($form as $field => $value) {
        if ($field == 'email') {
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $errors[$field] = 'Email has to be correct';
            }
        }
        if (empty($value)) {
            $errors[$field] = 'Fill up this field';
        }
    }

    if (count($errors)) {
        $page_content = includeTemplate('login.php', [
            'categories' => $categories,
            'form' => $form,
            'errors' => $errors
        ]);
    }
    else {
        header('Location: ./index.php');
        exit();
    }
}
else {
    if (isset($_SESSION['user'])) {
        $page_content = includeTemplate('index.php', [
            'lots' => $lots,
            'categories' => $categories,
        ]);
    }
    else {
        $page_content = includeTemplate('login.php', [
            'categories' => $categories,
        ]);
    }
}

$layout_content = includeTemplate('layout.php', [
    'content' => $page_content,
    'is_auth' => $is_auth,
    'categories' => $categories,
    'user_name' => $user_name,
    'user_avatar'=>$user_avatar,
    'title' => 'Login'
]);

print($layout_content);
?>