<?php
session_start();
require_once '../../includes/database_conn.php';

// LOGIN
$loginEmail = mysqli_real_escape_string($conn, $_POST['email_username']);
$loginPass = mysqli_real_escape_string($conn, $_POST['password']);
$checkLoginEmail = mysqli_query($conn, "SELECT * FROM admin WHERE admin_email = '$loginEmail' OR admin_username = '$loginEmail'");

if (mysqli_num_rows($checkLoginEmail) == 0) {
    echo 'email or username not registered';
} else {
    $row = mysqli_fetch_array($checkLoginEmail);

    if (password_verify($loginPass, $row['admin_password'])) {
        if (isset($_POST['rem']) == 'checked') {
            setcookie('admin_email', $loginEmail, time() + (86400 * 30), '/');
            setcookie('admin_password', $loginPass, time() + (86400 * 30), '/');
        } else {
            setcookie('admin_email', '');
            setcookie('admin_password', '');
        }
        $_SESSION['adminloggedin'] = true;
        $_SESSION['admin_id'] = $row['admin_id'];
        echo 'success';
    } else {
        echo 'wrong password';
    }
}