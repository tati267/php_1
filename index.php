<?php
require ('config.php');
require ('functions.php');
require ('init.php');

$lot = null;

if (!$link) {
    $error = mysqli_connect_error();
    $page_content = include_template('error.php', ['error' => $error]);
}
else {
    $sql = 'SELECT `CategoryName`, `CategoryClass` FROM categories';
    $result = mysqli_query($link, $sql);

    if ($result) {
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    else {
        $error = mysqli_error($link);
        $page_content = include_template('error.php', ['error' => $error]);
    }
}

if (isset($_SESSION['user'])) {
    $user_name = $_SESSION['user']['name'];
}

if (isset($_GET['lot_id'])) {
	$lot_id = $_GET['lot_id'];

	foreach ($lot_list as $item) {
		if ($item['id'] == $lot_id) {
			$lot = $item;
			break;
		}
	}
}

if (!$lot) {
	http_response_code(404);
}

$page_content = include_template('index.php', [
    'categories' => $categories,
    'lots' => $lots,
]);

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'is_auth' => $is_auth,
    'categories' => $categories,
    'user_name' => $user_name,
    'user_avatar'=>$user_avatar,
    'title' => "Home page"
]);

print($layout_content);
?>