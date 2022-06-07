<?php
require_once '../includes/database_conn.php';

if($_POST['update']) {
    $price = $_POST['price'];
    $cart_id = $_POST['cart_id'];
    $qty = $_POST['qty'];
    $subtotal = $_POST['subtotal'];
    $user_id = $_POST['user_id'];

    $updateCart = mysqli_query($conn, "UPDATE cart SET product_qty = '$qty', product_total = '$subtotal' WHERE cart_id = $cart_id AND user_id = $user_id");
}