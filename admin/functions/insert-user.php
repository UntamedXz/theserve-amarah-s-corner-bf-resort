<?php 
require_once '../../includes/database_conn.php';

$admin_name = mysqli_real_escape_string($conn, $_POST['insert_admin_name']);
$admin_username = mysqli_real_escape_string($conn, $_POST['insert_admin_username']);
$admin_password = mysqli_real_escape_string($conn, $_POST['insert_admin_password']);
$admin_type = $_POST['admin_type'];
$hashed_pass = password_hash($admin_password, PASSWORD_DEFAULT);

$insert_user = mysqli_query($conn, "INSERT INTO admin (admin_name, admin_username, admin_password, admin_type) VALUES ('$admin_name', '$admin_username', '$hashed_pass', '$admin_type')");

if($insert_user) {
    echo 'success';
}