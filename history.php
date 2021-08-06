<?php
    require 'data.php';
    require 'functions.php';

    $page_content = includeTemplate('history.php', [
        'categories' => $categories,
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