<?php
require_once '../../includes/database_conn.php';

    $selected = $_POST['selected_status'];
    $order_id = $_POST['order_id'];

    $update = mysqli_query($conn, "UPDATE orders SET order_status = $selected WHERE order_id = $order_id");

    if($update) {
        echo 'success';
    }