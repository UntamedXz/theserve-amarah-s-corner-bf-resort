<?php
require_once '../../includes/database_conn.php';

$update_id = $_POST['update_updates_id'];
$update_text = mysqli_real_escape_string($conn, $_POST['update_updates_text']);
$update_image = $_FILES['update_updates_image']['name'];
$update_image_tmp = $_FILES['update_updates_image']['tmp_name'];

$get_old_update = mysqli_query($conn, "SELECT * FROM updates WHERE updates_id = $update_id");

$row = mysqli_fetch_array($get_old_update);

$old_image = $row['updates_image'];

if($_FILES['update_updates_image']['error'] == 4) {
    $updates_update = mysqli_query($conn, "UPDATE updates SET updates_text = '$update_text' WHERE updates_id = $update_id");

    if($updates_update) {
        echo 'success';
    }
} else {
    $imgExt = explode('.', $update_image);
    $imgExt = strtolower(end($imgExt));

    $newImageName = uniqid() . '.' . $imgExt;

    move_uploaded_file($update_image_tmp, '../../assets/images/' . $newImageName);

    $updates_update = mysqli_query($conn, "UPDATE updates SET updates_text = '$update_text', updates_image = '$newImageName' WHERE updates_id = $update_id");

    unlink('../../assets/images/' . $old_image);

    if($updates_update) {
        echo 'success';
    }
}