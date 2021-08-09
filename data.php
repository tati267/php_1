<?php
$is_auth = (bool) rand(0, 1);
$user_name = 'Costa';
$user_avatar = 'img/user.jpg';
$categories = [
['category' =>'Snowboard&Ski','class'=>'boards'],
['category' =>'Bindings','class'=>'bindings'],
['category' =>'Boots','class'=>'boots'],
['category' =>'Snowwear','class'=>'clothing'],
['category' =>'Accessories','class'=>'tools'],
['category' =>'Other','class'=>'other']
];
$lots = [
[
    'id' => 1,
    'name' => '2014 Rossignol District Snowboard',
    'category' => 'Snowboard&Ski',
    'price' => '350',
    'url' => 'img/lot-1.jpg',
    'about' => ''
],
[
    'id' => 2,
    'name' => 'DC Ply Mens 2016/2017 Snowboard',
    'category' => 'Snowboard&Ski',
    'price' => '299',
    'url' => 'img/lot-2.jpg',
],
[
    'id' => 3,
    'name' => 'Bindings Union Contact Pro 2015 size L/XL',
    'category' => 'Bindings',
    'price' => '109',
    'url' => 'img/lot-3.jpg',
],
[
    'id' => 4,
    'name' => 'Boots for Snowboard DC Mutiny Charocal',
    'category' => 'Boots',
    'price' => '340',
    'url' => 'img/lot-4.jpg',
],
[
    'id' => 5,
    'name' => 'Jacket for Snowboard DC Mutiny Charocal',
    'category' => 'Clothes',
    'price' => '169',
    'url' => 'img/lot-5.jpg',
],
[
    'id' => 6,
    'name' => 'Face Mask DRAGON DX Goggle 2021',
    'category' => 'Other',
    'price' => '270',
    'url' => 'img/lot-6.jpg',
    'about' => "The DX goggle is a timeless Dragon shape that's been upgraded to meet the demands of today's consumers. The DX checks all the boxes: 100-percent UV protection, Super Anti Fog lens treatment, and a design that guarantees seamless goggle-to-helmet fit. Those looking for a no-fuss goggle should look no further than the DX."
]
];

$bets = [
    ['name' => 'Alex', 'price' => 250, 'ts' => strtotime('-' . rand(1, 50) .' minute')],
    ['name' => 'Paul', 'price' => 280, 'ts' => strtotime('-' . rand(1, 18) .' hour')],
    ['name' => 'Catherine', 'price' => 300, 'ts' => strtotime('-' . rand(25, 50) .' hour')],
    ['name' => 'Skye', 'price' => 250, 'ts' => strtotime('last week')]
];

$users = [
    ['email'=>'ignat.v@gmail.com', 'password' => 'ug0GdVMi'],
    ['email'=>'kitty_93@gmail.com', 'password' => 'daecNazD'],
    ['email'=>'warrior07@mail.ru', 'password' => 'oixb3aL8'],
];