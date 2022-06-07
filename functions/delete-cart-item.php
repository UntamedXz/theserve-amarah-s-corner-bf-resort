<?php
session_start();
require_once '../includes/database_conn.php';

$cart_id = $_POST['cart_id'];

$deleteCart = mysqli_query($conn, "DELETE FROM cart WHERE cart_id = $cart_id");

if($deleteCart) {
    $_SESSION['alert'] = 'success';
    echo "success";
}