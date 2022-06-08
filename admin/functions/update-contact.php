<?php
session_start();
require_once '../../includes/database_conn.php';

$admin_id = $_POST['profile_details_id'];
$phone_num = mysqli_real_escape_string($conn, $_POST['phone_number']);
$email = mysqli_real_escape_string($conn, $_POST['contact-email']);

$get_old_email = mysqli_query($conn, "SELECT * FROM admin WHERE admin_id = $admin_id");

$row = mysqli_fetch_array($get_old_email);

$old_email = $row['admin_email'];

if($email == $old_email) {
    $updateContact = mysqli_query($conn, "UPDATE admin SET admin_phone_number = '$phone_num' WHERE admin_id = $admin_id");

    if($updateContact) {
        $_SESSION['admin_contact'] = 'success';
        echo 'success';
    }
} else {
    $check_if_email_exist = mysqli_query($conn, "SELECT * FROM admin WHERE admin_email = '$email'");

    if(mysqli_num_rows($check_if_email_exist) > 0) {
        $_SESSION['admin_contact'] = 'failed';
        echo 'failed';
    } else {
        $updateContact = mysqli_query($conn, "UPDATE admin SET admin_phone_number = '$phone_num', admin_email = '$email' WHERE admin_id = $admin_id");

        if($updateContact) {
            $_SESSION['admin_contact'] = 'success';
            echo 'success';
        }
    }
}