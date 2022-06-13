<?php
require_once '../../includes/database_conn.php';

date_default_timezone_set('Asia/Manila');
$date = date('F j, Y');
$updates_text = mysqli_real_escape_string($conn, $_POST['updates_text']);
$updates_image = $_FILES['updates_image']['name'];
$updates_image_tmp = $_FILES['updates_image']['tmp_name'];

$imgExt = explode('.', $updates_image);
$imgExt = strtolower(end($imgExt));

$newImageName = uniqid() . '.' . $imgExt;

move_uploaded_file($updates_image_tmp, '../../assets/images/' . $newImageName);

$insert_updates = mysqli_query($conn, "INSERT INTO updates (updates_text, updates_image, updates_date) VALUES ('$updates_text', '$newImageName', '$date')");

if($insert_updates) {
    echo 'success';
}