<?php 
require_once '../includes/database_conn.php';

$image = $_FILES['profile_pic']['name'];
$image_tmp = $_FILES['profile_pic']['tmp_name'];
$oldImage = $_POST['old_profile_pic'];
$userId = $_POST['user_id'];

$checkCustomerInfo = mysqli_query($conn, "SELECT * FROM customers WHERE user_id = $userId");

$row = mysqli_fetch_array($checkCustomerInfo);

$oldImgDatabase = $row['user_profile_image'];

if($oldImgDatabase == '') {
    $imgExt = explode('.', $image);
    $imgExt = strtolower(end($imgExt));

    $newImageName = uniqid() . '.' . $imgExt;
    move_uploaded_file($image_tmp, '../assets/images/' . $newImageName);

    $updateProfileImg = mysqli_query($conn, "UPDATE customers SET user_profile_image = '$newImageName' WHERE user_id = $userId");

    if($updateProfileImg) {
        echo 'success';
    }
} else {
    $imgExt = explode('.', $image);
    $imgExt = strtolower(end($imgExt));

    $newImageName = uniqid() . '.' . $imgExt;
    move_uploaded_file($image_tmp, '../assets/images/' . $newImageName);
    unlink('../assets/images/' . $oldImage);

    $updateProfileImg = mysqli_query($conn, "UPDATE customers SET user_profile_image = '$newImageName'");

    if($updateProfileImg) {
        echo 'success';
    }
}