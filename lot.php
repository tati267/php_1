<?php
    require 'data.php';
    require 'functions.php';
    require 'config.php';

    $lot = null;
    $cookie_name = 'lot_history';
    $lot_indices = [];
    $cookie_expire = strtotime("+30 days");
    $cookie_path = "/";

    if (isset($_GET['lot_id'])) {
        $lot_id = $_GET['lot_id'];

        foreach ($lots as $key => $value) {
            if ($key == $lot_id) {
                $lot = $value;
                break;
            }
        }

        if (isset($_COOKIE['lot_history'])) {
            $lot_indices = unserialize($_COOKIE['lot_history']);

            if (!in_array($lot_id, $lot_indices)) {
                $lot_indices[] = $lot_id;
            }

            $cookie_value = serialize($lot_indices);
            setcookie($cookie_name , $cookie_value, $cookie_expire, $cookie_path);
        } else {
            $lot_indices[] = $lot_id;
            $cookie_value = serialize($lot_indices);
            setcookie($cookie_name , $cookie_value, $cookie_expire, $cookie_path);
        }
    }

    if (!$lot) {
        exit(http_response_code(404));
    }

    $page_content = include_template('lot.php', [
        'categories' => $categories,
        'lots' => $lot,
        'is_auth' => $is_auth,
        'Bids' => $Bids,
    ]);

    $layout_content = include_template('layout.php', [
        'content' => $page_content,
        'is_auth' => $is_auth,
        'categories' => $categories,
        'user_name' => $user_name,
        'user_avatar'=>$user_avatar,
        'title' => 'Lot'
    ]);

    print($layout_content);
?>
