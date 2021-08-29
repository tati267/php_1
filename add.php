<?php
require 'data.php';
require 'functions.php';
require 'config.php';
require 'init.php';

$datetime = '';

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
    $lot_photo = $_FILES['lot-photo'];
    $datetime = date("h:i:sa");
    $errors=validate_form_add($form);

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
                $form['path'] = $path;
            }
        }
    }
     else {
		$errors['file'] = 'You have not uploaded';
	}

	if (count($errors)) {
		$page_content = include_template('add.php', [
            'categories' => $categories,
            'form' => $form,
            'errors' => $errors,
        ]);
	} else {
        $lot_name = mysqli_real_escape_string($link, $form['lot-name']);
        $category_id = search_id_by_category($link, $form['category']);
        $description = mysqli_real_escape_string($link, $form['message']);
        $lot_price= mysqli_real_escape_string($link, $form['lot-price']);
        $lot_step = mysqli_real_escape_string($link, $form['lot-step']);
        $path = mysqli_real_escape_string($link, $form['path']);
        $sqlNewLot = "INSERT INTO lots (`LotName`, `LotStepBid`, `LotPrice`,`LotImgUrl`, `LotDescription`,`CategoryID`, `LotDateTime`)
                VALUES ('$lot_name', '$lot_step', '$lot_price','./img/$path', '$description','$category_id', NOW())";
        $resultNewLot = mysqli_query($link, $sqlNewLot);

        if ($resultNewLot) {
             // request on showing 9 recent lots
            $sqlLots = 'SELECT *  FROM Lots as l
            JOIN Categories AS c ON l.CategoryID=c.CategoryID
            ORDER BY `LotDateTime` DESC LIMIT 9';

            if ($res = mysqli_query($link, $sqlLots)) {
                $lots = mysqli_fetch_all($res, MYSQLI_ASSOC);
            }
            else {
                $page_content = include_template('error.php', ['error' => mysqli_error($link)]);
            }
            $page_content = include_template('index.php', [
                'categories' => $categories,
                'lots' => $lots,
            ]);
        }
        else {
            $error = mysqli_error($link);
            $page_content = include_template('error.php', ['error' => $error]);
        }
    }
}
else {
	$page_content = include_template('add.php', [
        'categories' => $categories,
    ]);
}

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'is_auth' => $is_auth,
    'categories' => $categories,
    'user_name' => $user_name,
    'user_avatar'=>$user_avatar,
    'title' => 'Add lot'
]);

print($layout_content);

?>
