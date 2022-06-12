<?php
session_start();
require_once '../includes/database_conn.php';

if(isset($_POST['cancel'])) {
    $order_id = $_POST['order_id'];

    $cancel_order = mysqli_query($conn, "DELETE FROM orders WHERE order_id = $order_id");

    if($cancel_order) {
        $_SESSION['cancelled'] = true;
        echo 'success';
    }
}