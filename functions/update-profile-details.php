<?php
session_start();
require_once '../includes/database_conn.php';

$user_id = $_POST['profile_details_id'];
$name = ucwords(mysqli_real_escape_string($conn, $_POST['customer_name']));
$username = mysqli_real_escape_string($conn, $_POST['customer_username']);
$bday = mysqli_real_escape_string($conn, $_POST['customer_bday']);
$gender = $_POST['gender'];

$updateProfileDetails = mysqli_query($conn, "UPDATE customers SET name = '$name', username = '$username', user_birthday = '$bday', user_gender = '$gender' WHERE user_id = $user_id");

if($updateProfileDetails) {
    $_SESSION['profile'] = 'success';
    echo 'success';
}