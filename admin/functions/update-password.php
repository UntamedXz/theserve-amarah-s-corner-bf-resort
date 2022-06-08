<?php
session_start();
require_once '../../includes/database_conn.php';

$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];
$admin_id = $_POST['password_id'];
$new_hash_password = password_hash($new_password, PASSWORD_DEFAULT);

$get_user_password = mysqli_query($conn, "SELECT * FROM admin WHERE admin_id = $admin_id");

$row = mysqli_fetch_array($get_user_password);

$user_old_password = $row['admin_password'];

if(password_verify($old_password, $user_old_password)) {
    if($new_password == $confirm_password) {
        $update_password = mysqli_query($conn, "UPDATE admin SET admin_password = '$new_hash_password' WHERE admin_id = $admin_id");

        if($update_password) {
            $_SESSION['admin_password'] = 'success';
            echo 'success';
        }
    } else {
        echo 'password not matched!';
    }
} else {
    echo 'wrong password';
}