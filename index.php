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
    $sqlCategories = 'SELECT `CategoryName`, `CategoryClass` FROM categories';
    $resultCategories = mysqli_query($link, $sqlCategories);

    if ($resultCategories) {
        $categories = mysqli_fetch_all($resultCategories, MYSQLI_ASSOC);
    }
    else {
        $error = mysqli_error($link);
        $page_content = include_template('error.php', ['error' => $error]);
    }
       // request on showing 9 recent lots
       $sql = 'SELECT *  FROM Lots as l
       JOIN Categories AS c ON l.CategoryID=c.CategoryID
       ORDER BY `LotDateTime` DESC LIMIT 9';

       if ($res = mysqli_query($link, $sql)) {
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


if (isset($_SESSION['user'])) {
    $user_name = $_SESSION['user']['UserName'];
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
