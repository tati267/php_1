<?php
require 'data.php';
require 'functions.php';
require 'config.php';
require 'init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form = $_POST;
    $user_photo = $_FILES['user-photo'];
    $required_fields = ['email', 'password', 'name', 'message'];
    $errors = [];

    foreach ($form as $field => $value) {
        if ($field == 'email') {
            $email = mysqli_real_escape_string($link, $value);
            $sql = "SELECT `UserEmail` FROM `Users` WHERE `UserEmail` = '$email'";
            $sql_query = mysqli_query($link, $sql);
            $result = mysqli_fetch_array ($sql_query);

            if ($result !== NULL) {
                $errors[$field] = 'This email is already been used';
            }

            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $errors[$field] = 'Email has to be correct';
            }
        }

        if ($field=== 'password') {
            if (!preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}/', $value)) {
                $errors['password'] = 'Must contain at least one number and one uppercase and lowercase letter, and at least 5 or more characters';
            }
        }

        if ($field === 'name') {
            if (!preg_match('/^[a-zA-Z0-9-_]+$/', $value)) {
                $errors['name'] = 'Should contain only alphanumeric!';
            }
        }

        if ($field === 'message') {
            if (!preg_match('/^[a-zA-Z0-9-_]+$/', $value)) {
                $errors['message'] = 'Should contain only alphanumeric!';
            }
        }

        if (empty($value)) {
            $errors[$field] = 'Fill up this field';
        }
    }
    if ($_FILES['user-photo']['name']) {
        if (isset($_FILES['user-photo']['name'])) {
            $tmp_name = $user_photo['tmp_name'];
            $path = $user_photo['name'];

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $file_type = finfo_file($finfo, $tmp_name);

            if ($file_type !== "image/jpeg") {
                $errors['file'] = 'Upload photo in jpeg format';
            }
            else {
                move_uploaded_file($tmp_name, 'img/' . $path);
                $form['path'] = $path;
            }
        }
    }
     else {
        $errors['file'] = 'You have not uploaded photo';
    }

    if (count($errors)) {
        $page_content = includeTemplate('sign-up.php', [
            'categories' => $categories,
            'form' => $form,
            'errors' => $errors,
        ]);
    }
    else {
        if (!$link) {
            $error = mysqli_connect_error();
            $page_content = include_template('error.php', ['error' => $error]);
        }
        else {
            $password_hash = password_hash($form['password'], PASSWORD_DEFAULT);
            $email = mysqli_real_escape_string($link, $form['email']);
            $name = mysqli_real_escape_string($link, $form['name']);
            $password = mysqli_real_escape_string($link, $password_hash);
            $message = mysqli_real_escape_string($link, $form['message']);

            $sql = "INSERT INTO Users (`UserEmail`, `UserName`, `UserPassword`,`UserComments`) VALUES ('$email', '$name', '$password','$message')";
            $result = mysqli_query($link, $sql);

            if ($result) {
                $page_content = includeTemplate('index.php', []);
            }
            else {
                $error = mysqli_error($link);
                $page_content = includeTemplate('error.php', ['error' => $error]);
            }
        }
    }
}
else {
    $page_content = includeTemplate('sign-up.php', [
        'categories' => $categories,
    ]);
}

$layout_content = includeTemplate('layout.php', [
    'content' => $page_content,
    'is_auth' => $is_auth,
    'categories' => $categories,
    'user_name' => $user_name,
    'user_avatar'=>$user_avatar,
    'title' => "Sign up"
]);

print($layout_content);
?>