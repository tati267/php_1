<?php
require_once 'functions.php';
$link = [
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
    'database' => 'yeticave'
];

$link = mysqli_connect($link['host'], $link['user'],$link['password'], $link['database']);
mysqli_set_charset($link, 'utf8');

$categories = [];
$page_content='';
?>
