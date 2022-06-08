<?php
require_once '../../includes/database_conn.php';

if (!empty($_POST['delete_order_id'])) {
    $delete_order = $_POST['delete_order_id'];

    $get_order = mysqli_query($conn, "SELECT * FROM orders WHERE order_id = $delete_order");

    $screenshot = '';

    while ($row = mysqli_fetch_array($get_order)) {
        $screenshot = $row['screenshot_payment'];
    }

    if (!empty($screenshot)) {
        $delete_order = mysqli_query($conn, "DELETE FROM orders WHERE order_id = $delete_order");

        if ($delete_order) {
            echo 'deleted';
            unlink('../../assets/images/' . $screenshot);
        }
    } else {
        $delete_order = mysqli_query($conn, "DELETE FROM orders WHERE order_id = $delete_order");

        if ($delete_order) {
            echo 'deleted';
        }
    }
}
