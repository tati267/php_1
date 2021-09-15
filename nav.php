  <?php

$sql = 'SELECT `CategoryName`, `CategoryClass` FROM categories';
$result = mysqli_query($link, $sql);
if ($result) {
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $page_content = include_template('error.php', ['error' => mysqli_error($link)]);
}
