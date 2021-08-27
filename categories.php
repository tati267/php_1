<?php

$sql = "SELECT * FROM `categories`
            ORDER BY `CategoryID`";
$sql_query = mysqli_query($link, $sql);

if (!$sql_query = mysqli_query($link, $sql)) {
    $errorMsg = 'Ошибка: ' . mysqli_error($link);
    die($errorMsg);
}

$nav_menu = mysqli_fetch_all($sql_query, MYSQLI_ASSOC);
