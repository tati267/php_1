<?php
require ('functions.php');
require ('data.php');

$lot = null;

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

$page_content = renderTemplate('index.php', [
    'categories' => $categories,
    'lots' => $lots,
]);

$layout_content = renderTemplate('layout.php', [
    'content' => $page_content,
    'is_auth' => $is_auth,
    'categories' => $categories,
    'user_name' => $user_name,
    'user_avatar'=>$user_avatar,
    'title' => $page_title
]);

print($layout_content);
?>