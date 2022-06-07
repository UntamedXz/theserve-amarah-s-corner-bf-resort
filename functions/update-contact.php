<?php
session_start();
require_once '../includes/database_conn.php';

$user_id = $_POST['profile_details_id'];
$phone_num = mysqli_real_escape_string($conn, $_POST['phone_number']);
$email = mysqli_real_escape_string($conn, $_POST['contact-email']);

$get_old_email = mysqli_query($conn, "SELECT * FROM customers WHERE user_id = $user_id");

$row = mysqli_fetch_array($get_old_email);

$old_email = $row['email'];

if($email == $old_email) {
    $updateContact = mysqli_query($conn, "UPDATE customers SET phone_number = '$phone_num' WHERE user_id = $user_id");

    if($updateContact) {
        $_SESSION['contact'] = 'success';
        echo 'success';
    }
} else {
    $check_if_email_exist = mysqli_query($conn, "SELECT * FROM customers WHERE email = '$email'");

    if(mysqli_num_rows($check_if_email_exist) > 0) {
        $_SESSION['contact'] = 'failed';
        echo 'failed';
    } else {
        $updateContact = mysqli_query($conn, "UPDATE customers SET phone_number = '$phone_num', email = '$email' WHERE user_id = $user_id");

        if($updateContact) {
            $_SESSION['contact'] = 'success';
            echo 'success';
        }
    }
}