<?php
session_start();
require_once '../includes/database_conn.php';

// REGISTER
$reg_username = mysqli_real_escape_string($conn, $_POST['reg-username']);
$reg_email = mysqli_real_escape_string($conn, $_POST['reg-email']);
$reg_password = mysqli_real_escape_string($conn, $_POST['reg-password']);

$checkRegEmail = mysqli_query($conn, "SELECT * FROM customers WHERE email = '$reg_email'");

if (mysqli_num_rows($checkRegEmail) > 0) {
    echo 'Email already exist!';
} else {
    $insertReg = mysqli_query($conn, "INSERT INTO customers (username, email, password) VALUES ('$reg_username', '$reg_email', '$reg_password')");
    if ($insertReg) {
        echo 'Registered Successfully!';
    } else {
        echo 'Something went wrong!';
    }
}
