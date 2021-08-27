<?php
    require 'functions.php';
    require 'config.php';
    require 'init.php';

    $lot = null;
    $cookie_name = 'lot_history';
    $lot_indices = [];
    $cookie_expire = strtotime("+30 days");
    $cookie_path = "/";
    $lot_id = $_GET['id'] ? intval($_GET['id']) : null;

    if (!$link) {
        $error = mysqli_connect_error();
        $page_content = include_template('error.php', ['error' => $error]);
    } else {
        $sqlCategories = 'SELECT `CategoryName`, `CategoryClass` FROM categories';
        $resultCategories = mysqli_query($link, $sqlCategories);

        if ($resultCategories) {
            $categories = mysqli_fetch_all($resultCategories, MYSQLI_ASSOC);
        }

        else {
            $error = mysqli_error($link);
            $page_content = include_template('error.php', ['error' => $error]);
        }

       $sqlLots = 'SELECT *  FROM Lots as l
       JOIN Categories AS c ON l.CategoryID=c.CategoryID
       ORDER BY `LotDateTime` DESC LIMIT 9';

        if ($res = mysqli_query($link, $sqlLots)) {
            $lots = mysqli_fetch_all($res, MYSQLI_ASSOC);
        }
        else {
            $page_content = include_template('error.php', ['error' => mysqli_error($link)]);
        }

        $sqlBids= "SELECT * FROM Bids as b
        JOIN Users AS u ON b.UserID=u.UserID
        WHERE b.LotID = '1'
        ORDER BY BidPrice DESC";

        if ($res = mysqli_query($link, $sqlBids )) {
            $bids = mysqli_fetch_all($res, MYSQLI_ASSOC);
        }
        else {
            $page_content = include_template('error.php', ['error' => mysqli_error($link)]);
        }

        $page_content = include_template('index.php', [
            'categories' => $categories,
            'lots' => $lots,
            'bids' => $bids,
        ]);

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

    }

    $page_content = include_template('lot.php', [
        'categories' => $categories,
        'lots' => $lot,
        'is_auth' => $is_auth,
        'bids' => $bids,
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
