<?php
session_start();
require_once '../../includes/database_conn.php';

$admin_id = $_POST['profile_details_id'];
$name = ucwords(mysqli_real_escape_string($conn, $_POST['admin_name']));
$username = mysqli_real_escape_string($conn, $_POST['admin_username']);

$updateProfileDetails = mysqli_query($conn, "UPDATE admin SET admin_name = '$name', admin_username = '$username' WHERE admin_id = $admin_id");

if($updateProfileDetails) {
    $_SESSION['admin_profile'] = 'success';
    echo 'success';
}