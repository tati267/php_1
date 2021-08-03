<?php
    require 'data.php';
    require 'functions.php';

    $lot = null;

    if (isset($_GET['lot_id'])) {
        $lot_id = $_GET['lot_id'];

        foreach ($lots as $key => $value) {
            if ($key == $lot_id) {
                $lot = $value;
                break;
            }
        }
    }

    if (!$lot) {
        exit(http_response_code(404));
    }

    $page_content = includeTemplate('lot.php', [
        'categories' => $categories,
        'lots' => $lot,
        'bets' => $bets,
    ]);

    $layout_content = includeTemplate('layout.php', [
        'content' => $page_content,
        'is_auth' => $is_auth,
        'categories' => $categories,
        'user_name' => $user_name,
        'user_avatar'=>$user_avatar,
        'title' => 'Lot'
    ]);

    print($layout_content);

?>
