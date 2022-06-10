<?php
session_start();
require_once '../includes/database_conn.php';

// LOGIN
$loginEmail = mysqli_real_escape_string($conn, $_POST['loginEmail']);
$loginPass = mysqli_real_escape_string($conn, $_POST['loginPassword']);
$checkLoginEmail = mysqli_query($conn, "SELECT * FROM customers WHERE email = '$loginEmail' || username = '$loginEmail'");

if (mysqli_num_rows($checkLoginEmail) == 0) {
    echo 'email not registered';
} else {
    $row = mysqli_fetch_array($checkLoginEmail);

    if (password_verify($loginPass, $row['password'])) {
        if (isset($_POST['rem']) == 'checked') {
            setcookie('email', $loginEmail, time() + (86400 * 30), '/');
            setcookie('password', $loginPass, time() + (86400 * 30), '/');
        } else {
            setcookie('email', '');
            setcookie('password', '');
        }
        $_SESSION['loggedin'] = true;
        $_SESSION['id'] = $row['user_id'];
        echo 'success';
    } else {
        echo 'wrong password';
    }
}
