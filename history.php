<?php
require 'init.php';
require 'config.php';

$lots = [];

if (isset($_COOKIE['lot_history'])) {
    $cookies = json_decode($_COOKIE['lot_history']);
    $lots = implode(', ', $cookies);

    $cur_page = $_GET['page'] ?? 1;
    $page_items = 6;

    $sql_count = "SELECT COUNT(*) AS `count`
                  FROM `lots`
                  WHERE `LotID` IN ($lots)";

    $sql_query_count = mysqli_query($link, $sql_count);

    if ($sql_query_count) {
        $items_count = mysqli_fetch_assoc($sql_query_count)['count'];
        $pages_count = ceil($items_count / $page_items);
        $offset = ($cur_page - 1) * $page_items;

        $pages = range(1, $pages_count);

        $sql = "SELECT *  FROM Lots as l
                JOIN Categories AS c ON l.CategoryID=c.CategoryID
                WHERE l.LotID IN ($lots)
                LIMIT $page_items
                OFFSET $offset";

        if ($sql_query = mysqli_query($link, $sql)) {
            $url = $_SERVER['REQUEST_URI'];
            $url = explode('?page', $url)[0];

            $lots = mysqli_fetch_all($sql_query, MYSQLI_ASSOC);
            $page_content = include_template('history.php', [
                'url' => $url,
                'lots' => $lots,
                'nav_menu' => $nav_menu,
                'pages' => $pages,
                'pages_count' => $pages_count,
                'cur_page' => $cur_page
            ]);
        }
        else {
            $page_content = include_template('error.php', ['error' => mysqli_error($link)]);
        }
    }
    else {
        $page_content = include_template('error.php', ['error' => mysqli_error($link)]);
    }
}
else {
    $page_content = include_template('error.php', ['error_title' => 'Ваша история просмотров пуста']);
}

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'is_auth' => $is_auth,
    'categories' => $categories,
    'user_name' => $user_name,
    'user_avatar'=>$user_avatar,
    'title' => 'History'
]);

print($layout_content);

?>
