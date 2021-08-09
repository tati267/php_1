<?php
require 'data.php';
require 'functions.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form_login = $_POST;

    $required = ['email', 'password'];
    $errors = [];

    foreach ($form_login as $field => $value) {
        if ($field == 'email') {
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $errors[$field] = 'Email должен быть корректным';
            }
        }
        if (empty($value)) {
            $errors[$field] = 'Это поле надо заполнить';
        }
    }

    if (!count($errors) and $user = searchUserByEmail($form_login['email'], $users)) {
        if (password_verify($form_login['password'], $user['password'])) {
            $_SESSION['user'] = $user;
        }
        else {
            $errors['password'] = 'Неверный пароль';
        }
    }
    else {
        $errors['email'] = 'Такой пользователь не найден';
    }

    if (count($errors)) {
        $page_content = includeTemplate('login.php', [
            'form_login' => $form_login,
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