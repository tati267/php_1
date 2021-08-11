<?php
    require 'data.php';
    require 'functions.php';
    require 'config.php';

    $lots_history = [];

if (isset($_COOKIE['lot_history'])) {
    $arr_cookie = unserialize($_COOKIE['lot_history']);

    foreach ($lots as $lots_key => $lots_value) {
        foreach ($arr_cookie as $arr_cookie_key => $arr_cookie_value) {
            if ($lots_key == $arr_cookie_value) {
                $lots_history[] = $lots_value;
            }
        }
    }
}

    $page_content = includeTemplate('history.php', [
        'lots' => $lots,
        'categories' => $categories,
        'lots_history' => $lots_history
    ]);

    $layout_content = includeTemplate('layout.php', [
        'content' => $page_content,
        'is_auth' => $is_auth,
        'categories' => $categories,
        'user_name' => $user_name,
        'user_avatar'=>$user_avatar,
        'title' => 'History'
    ]);

    print($layout_content);

?>