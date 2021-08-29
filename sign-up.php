<?php
require 'functions.php';
require 'config.php';
require 'init.php';

if (!$link) {
    $error = mysqli_connect_error();
    $page_content = include_template('error.php', ['error' => $error]);
}
else {
    $sqlCategories = 'SELECT `CategoryName`, `CategoryClass` FROM categories';
    $resultCategories = mysqli_query($link, $sqlCategories);

    if ($resultCategories) {
        $categories = mysqli_fetch_all($resultCategories, MYSQLI_ASSOC);
    }
    else {
        $error = mysqli_error($link);
        $page_content = include_template('error.php', ['error' => $error]);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form = $_POST;
    $user_photo = $_FILES['user-photo'];
    $errors=validate_form_sign_up($form);

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

    if (empty($errors)) {
        $password_hash = password_hash($form['password'], PASSWORD_DEFAULT);
        $email = mysqli_real_escape_string($link, $form['email']);
        $name = mysqli_real_escape_string($link, $form['name']);
        $password = mysqli_real_escape_string($link, $password_hash);
        $message = mysqli_real_escape_string($link, $form['message']);

        $sql = "INSERT INTO Users (`UserEmail`, `UserName`, `UserPassword`,`UserComments`) VALUES ('$email', '$name', '$password','$message')";
        $result = mysqli_query($link, $sql);

        if ($result) {
            $page_content = include_template('index.php', [
            ]);
        }
    }
    else {
        $page_content = include_template('sign-up.php', [
            'categories' => $categories,
            'form' => $form,
            'errors' => $errors,
        ]);
    }
}
else {
    $page_content = include_template('sign-up.php', [
        'categories' => $categories,
    ]);
}

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'is_auth' => $is_auth,
    'categories' => $categories,
    'user_name' => $user_name,
    'user_avatar'=>$user_avatar,
    'title' => "Sign up"
]);

print($layout_content);
?>
