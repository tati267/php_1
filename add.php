<?php
require 'data.php';
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lot = $_POST;
    $lot_photo = $_FILES['lot-photo'];

    $required_fields = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date'];
    $errors = [];

    foreach ($required_fields as $field) {
		if (empty($_POST[$field])) {
            $errors[$field] = 'Fill up this field';
		}
	}

    foreach ($lot as $key=>$value) {
        if ($key=== 'category') {
            if($value==='Select category') {
                $errors['category'] = 'Choose category';
            }
        }

        if ($key=== 'lot-rate') {
            if($value=="" || !filter_var($value, FILTER_VALIDATE_INT)) {
                $errors['lot-rate'] = 'Insert integer';
            }
        }

        if ($key === 'lot-step') {
            if($value==="" || !filter_var($value, FILTER_VALIDATE_INT)) {
                $errors['lot-step'] = 'Insert integer';
            }
        }

        if ($key === 'lot-name') {
            if ($value==="" || !preg_match('/^[a-zA-Z0-9-_]+$/', $value)) {
                $errors['lot-name'] = 'should contain only alphanumeric!';
            }
        }

        if ($key === 'message') {
            if ($value==="" || !preg_match('/^[a-zA-Z0-9-_]+$/', $value)) {
                $errors['message'] = 'should contain only alphanumeric!';
            }
        }
    }
    if ($_FILES['lot-photo']['name']) {
        if (isset($_FILES['lot-photo']['name'])) {
            $tmp_name = $lot_photo['tmp_name'];
            $path = $lot_photo['name'];

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $file_type = finfo_file($finfo, $tmp_name);

            if ($file_type !== "image/jpeg") {
                $errors['file'] = 'Upload photo in jpeg format';
            }
            else {
                move_uploaded_file($tmp_name, 'img/' . $path);
                $lot['path'] = $path;
            }
        }
    }
     else {
		$errors['file'] = 'You have not uploaded';
	}

	if (count($errors)) {
		$page_content = includeTemplate('add.php', [
            'categories' => $categories,
            'lot' => $lot,
            'errors' => $errors,
        ]);
	}
    else {
		$page_content = includeTemplate('lot.php', [
            'lot' => $lot,
            'categories' => $categories,
        ]);
	}
}

else {
	$page_content = includeTemplate('add.php', [
        'categories' => $categories,
    ]);
}

$layout_content = includeTemplate('layout.php', [
    'content' => $page_content,
    'is_auth' => $is_auth,
    'categories' => $categories,
    'user_name' => $user_name,
    'user_avatar'=>$user_avatar,
    'title' => 'Add lot'
]);

print($layout_content);

?>