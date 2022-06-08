<?php 
require_once '../../includes/database_conn.php';

$image = $_FILES['profile_pic']['name'];
$image_tmp = $_FILES['profile_pic']['tmp_name'];
$oldImage = $_POST['old_profile_pic'];
$adminId = $_POST['admin_id'];

$checkAdminInfo = mysqli_query($conn, "SELECT * FROM admin WHERE admin_id = $adminId");

$row = mysqli_fetch_array($checkAdminInfo);

$oldImgDatabase = $row['profile_image'];

if($oldImgDatabase == '') {
    $imgExt = explode('.', $image);
    $imgExt = strtolower(end($imgExt));

    $newImageName = uniqid() . '.' . $imgExt;
    move_uploaded_file($image_tmp, '../../assets/images/' . $newImageName);

    $updateProfileImg = mysqli_query($conn, "UPDATE admin SET profile_image = '$newImageName' WHERE admin_id = $adminId");

    if($updateProfileImg) {
        echo 'success';
    }
} else {
    $imgExt = explode('.', $image);
    $imgExt = strtolower(end($imgExt));

    $newImageName = uniqid() . '.' . $imgExt;
    move_uploaded_file($image_tmp, '../assets/images/' . $newImageName);
    unlink('../../assets/images/' . $oldImageDatabase);

    $updateProfileImg = mysqli_query($conn, "UPDATE admin_id SET profile_image = '$newImageName' WHERE admin_id = $adminId");

    if($updateProfileImg) {
        echo 'success';
    }
}