if (isset($lot_photo)) {

$tmp_name = $lot_photo['tmp_name'];
$file_name = $lot_photo['name'];
$file_path = __DIR__ . '/uploads/';

$finfo = finfo_open(FILEINFO_MIME_TYPE);
$file_type = finfo_file($finfo, $tmp_name);

if ($file_type !== 'image/jpeg') {
$errors['file'] = 'Upload photo in jpeg format';
}
else {
move_uploaded_file($tmp_name, $file_path . $file_name);
$lot['file-path'] = 'uploads/' . $file_name;
}
}


if (isset($_FILES['lot_img']['name'])) {
$tmp_name = $_FILES['lot_img']['tmp_name'];
$path = $_FILES['lot_img']['name'];

$finfo = finfo_open(FILEINFO_MIME_TYPE);
$file_type = finfo_file($finfo, $tmp_name);
if ($file_type !== "image/jpeg") {
$errors['file'] = 'Upload photo in jpeg format';
}
else {
move_uploaded_file($tmp_name, 'img/' . $path);
$lot['path'] = $path;
}
}