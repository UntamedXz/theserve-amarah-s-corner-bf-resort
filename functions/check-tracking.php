<?php
session_start();
require_once '../includes/database_conn.php';

$email = $_POST['email'];
$order_id = $_POST['order-id'];

$check = mysqli_query($conn, "SELECT customers.email, orders.order_id
FROM orders
INNER JOIN customers
ON orders.user_id = customers.user_id
WHERE orders.order_id = $order_id AND customers.email = '$email'");

if(mysqli_num_rows($check) > 0) {
    $_SESSION['email'] = $email;
    echo "your-order?id=" . $order_id;
} else {
    echo 'Invalid credentials!';
}