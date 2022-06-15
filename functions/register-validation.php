<?php
session_start();
require_once '../includes/database_conn.php';

// REGISTER
$reg_name = mysqli_real_escape_string($conn, $_POST['reg-name']);
$reg_username = mysqli_real_escape_string($conn, $_POST['reg-username']);
$reg_email = mysqli_real_escape_string($conn, $_POST['reg-email']);
$reg_phone_number = mysqli_real_escape_string($conn, $_POST['reg-tel']);
$reg_gender = mysqli_real_escape_string($conn, $_POST['gender']);
$reg_bday = mysqli_real_escape_string($conn, $_POST['reg-bday']);
$reg_password = mysqli_real_escape_string($conn, $_POST['reg-password']);
$hashed_pass = password_hash($reg_password, PASSWORD_DEFAULT);

$checkRegEmail = mysqli_query($conn, "SELECT * FROM customers WHERE email = '$reg_email'");
$checkRegUsername = mysqli_query($conn, "SELECT * FROM customers WHERE username = '$reg_username'");

if (mysqli_num_rows($checkRegUsername) > 0) {
    echo 'Username already exist!';
} else {
    if(mysqli_num_rows($checkRegEmail) > 0) {
        echo 'Email already exist!';
    } else {
        $insertReg = mysqli_query($conn, "INSERT INTO customers (name, username, email, password, phone_number, user_birthday, user_gender) VALUES ('$reg_name', '$reg_username', '$reg_email', '$hashed_pass', '$reg_phone_number', '$reg_bday', '$reg_gender')");
        if ($insertReg) {
            echo 'Registered Successfully!';
        } else {
            echo 'Something went wrong!';
        }
    }
}