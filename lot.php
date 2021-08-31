<?php
require 'functions.php';
require 'config.php';
require 'init.php';

$lot = null;
$cookie_name = 'lot_history';
$cookie_value = [];
$cookie_expire = strtotime("+30 days");
$cookie_path = "/";
$lot_id = $_GET['lot_id'];

if (!$link) {
    $error = mysqli_connect_error();
     $page_content = include_template('error.php', ['error' => $error]);
} else {
    $sqlCategories = 'SELECT `CategoryName`, `CategoryClass` FROM categories';
    $resultCategories = mysqli_query($link, $sqlCategories);

    $sqlLots = 'SELECT *  FROM Lots as l
    JOIN Categories AS c ON l.CategoryID=c.CategoryID
    ORDER BY `LotDateTime` DESC LIMIT 9';

    if ($resultCategories) {
        $categories = mysqli_fetch_all($resultCategories, MYSQLI_ASSOC);
    }

    if ($res = mysqli_query($link, $sqlLots)) {
        $lots = mysqli_fetch_all($res, MYSQLI_ASSOC);
    }
    else {
        $page_content = include_template('error.php', ['error' => mysqli_error($link)]);
    }

    $sqlBidsQuantity= "SELECT * FROM bids
    WHERE LotID = '$lot_id'";

    if ($res = mysqli_query($link, $sqlBidsQuantity)) {
        $bidsQuantity = mysqli_num_rows($res);
    }
    else {
        $page_content = include_template('error.php', ['error' => mysqli_error($link)]);
    }

    $sqlBids= "SELECT * FROM Bids as b
    JOIN Users AS u ON b.UserID=u.UserID
    WHERE b.LotID = '$lot_id'
    ORDER BY BidPrice DESC";

    if ($res = mysqli_query($link, $sqlBids )) {
        $bids = mysqli_fetch_all($res, MYSQLI_ASSOC);
    }
    else {
        $page_content = include_template('error.php', ['error' => mysqli_error($link)]);
    }

    if (isset($_GET['lot_id'])) {
        $lot_id = $_GET['lot_id'];

        foreach ($lots as $key => $value) {
            if ($key == $lot_id) {
                $lot = $value;
                break;
            }
        }

        if (isset($_COOKIE['lot_history'])) {
            $cookie_value = json_decode($_COOKIE['lot_history'], true);
        }

        if (!in_array($lot_id, $cookie_value)) {
            $cookie_value[] = $lot_id;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form = $_POST;
    $errors=[];

    if ($form['cost']) {
        if(!filter_var($form['cost'], FILTER_VALIDATE_INT)) {
            $errors['cost'] = 'Insert integer';
        } else if(empty($form['cost'])) {
            $errors['cost'] = 'Fill up this field';
        }
    }

    if (count($errors)) {
        $page_content = include_template('lot.php', [
            'categories' => $categories,
            'form' => $form,
            'errors' => $errors,
        ]);
    } else {
        $cost = mysqli_real_escape_string($link, $form['cost']);
        $user_id = search_id_by_user($link, $user_name);

        $sqlNewLot = "INSERT INTO bids (`BidPrice`, `BidDate`, `UserID`)
                VALUES ('$cost', NOW(), '$user_id')";
        $resultNewLot = mysqli_query($link, $sqlNewLot);

        if ($resultNewLot) {
            $page_content = include_template('lot.php', [
                'categories' => $categories,
                'lots' => $lot,
                'is_auth' => $is_auth,
                'bids' => $bids,
                'bidsQuantity' => $bidsQuantity
            ]);
        }
        else {
            $error = mysqli_error($link);
            $page_content = include_template('error.php', ['error' => $error]);
        }
    }
}

$page_content = include_template('lot.php', [
    'categories' => $categories,
    'lots' => $lot,
    'is_auth' => $is_auth,
    'bids' => $bids,
    'bidsQuantity' => $bidsQuantity
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
