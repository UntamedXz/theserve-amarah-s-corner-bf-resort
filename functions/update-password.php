<?php
session_start();
require_once '../includes/database_conn.php';

$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];
$user_id = $_POST['password_id'];

$get_user_password = mysqli_query($conn, "SELECT * FROM customers WHERE user_id = $user_id");

$row = mysqli_fetch_array($get_user_password);

$user_old_password = $row['password'];

if($old_password == $user_old_password) {
    if($new_password == $confirm_password) {
        $update_password = mysqli_query($conn, "UPDATE customers SET password = '$new_password' WHERE user_id = $user_id");

        if($update_password) {
            $_SESSION['password'] = 'success';
            echo 'success';
        }
    } else {
        echo 'password not matched!';
    }
} else {
    echo 'wrong password';
}