<?php
require ('functions.php');

$is_auth = (bool) rand(0, 1);
$page_title = 'Home';
$user_name = 'Константин';
$user_avatar = 'img/user.jpg';
$date = ['30.07.2021','31.07.2021'];
$categories = [
[
    'category' =>'Доски и лыжи',
    'class'=>'boards'
],
[
    'category' =>'Крепления',
    'class'=>'attachment'
],
[
    'category' =>'Ботинки',
    'class'=>'boots'
],
[
    'category' =>'Одежда',
    'class'=>'clothing'
],
[
    'category' =>'Инструменты',
    'class'=>'tools'
],
[
    'category' =>'Разное',
    'class'=>'other'
]
];
$lots = [
[
    'name' => '2014 Rossignol District Snowboard',
    'category' => 'Доски и лыжи',
    'price' => '10999',
    'url' => 'img/lot-1.jpg',
],
[
    'name' => 'DC Ply Mens 2016/2017 Snowboard',
    'category' => 'Доски и лыжи',
    'price' => '159999',
    'url' => 'img/lot-2.jpg',
],
[
    'name' => 'Крепления Union Contact Pro 2015 размер L/XL',
    'category' => 'Крепления',
    'price' => '8000',
    'url' => 'img/lot-3.jpg',
],
[
    'name' => 'Ботинки для сноуборда DC Mutiny Charocal',
    'category' => 'Ботинки',
    'price' => '10999',
    'url' => 'img/lot-4.jpg',
],
[
    'name' => 'Куртка для сноуборда DC Mutiny Charocal',
    'category' => 'Одежда',
    'price' => '7500',
    'url' => 'img/lot-5.jpg',
],
[
    'name' => 'Маска Oakley Canopy',
    'category' => 'Разное',
    'price' => '5400',
    'url' => 'img/lot-6.jpg',
]
];

$page_content = renderTemplate('index.php', [
    'categories' => $categories,
    'lots' => $lots,
    'date'=> $date,
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
