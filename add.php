<?php
require 'data.php';
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$lot = $_POST;

	$required = ['title', 'description'];
	$dict = ['title' => 'Name', 'description' => 'Description', 'file' => 'Image'];
	$errors = [];
	foreach ($required as $key) {
		if (empty($_POST[$key])) {
            $errors[$key] = 'Fill up this field';
		}
	}

	if (isset($_FILES['lot_img']['name'])) {
		$tmp_name = $_FILES['lot_img']['tmp_name'];
		$path = $_FILES['lot_img']['name'];

		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$file_type = finfo_file($finfo, $tmp_name);
		if ($file_type !== "image/JPEG") {
			$errors['file'] = 'Upload photo in JP';
		}
		else {
			move_uploaded_file($tmp_name, 'uploads/' . $path);
			$lotf['path'] = $path;
		}
	}
	else {
		$errors['file'] = 'You have not uploaded image';
	}

	if (count($errors)) {
		$page_content = includeTemplate('add.php', ['lot' => $lot, 'errors' => $errors, 'dict' => $dict]);
	}
	else {
		$page_content = includeTemplate('view.php', ['lot' => $lot]);
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