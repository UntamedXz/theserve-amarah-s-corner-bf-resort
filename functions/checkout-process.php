<?php
session_start();
require_once '../includes/database_conn.php';

date_default_timezone_set('Asia/Manila');
$user_id = $_POST['user_id'];
$billing_name = $_POST['billing_name'];
$billing_phone = $_POST['billing_phone'];
$email = $_POST['billing_email'];
$address = $_POST['address'];
$province = $_POST['province'];
$city = $_POST['city'];
$barangay = $_POST['barangay'];
$payment = $_POST['payment'];
$delivery = $_POST['deliver'];
$screenshot = $_FILES['screenshot']['name'];
$screenshottmp = $_FILES['screenshot']['tmp_name'];
$reference = $_POST['reference'];
$shipping_value = $_POST['shipping_value'];
$order_total = $_POST['order_total_val'];
$date = date('F j, Y h:i A');

if ($payment == 2) {
    $imgExt = explode('.', $screenshot);
    $imgExt = strtolower(end($imgExt));

    $newImageName = uniqid() . '.' . $imgExt;
    move_uploaded_file($screenshottmp, '../assets/images/' . $newImageName);

    $insert_orders = mysqli_query($conn, "INSERT INTO orders (user_id, payment_method, delivery_method, shipping_fee, screenshot_payment, reference, order_total, order_date, order_status) VALUES ('$user_id', '$payment', '$delivery', '$shipping_value', '$newImageName', '$reference', '$order_total', '$date', '1')");

    if ($insert_orders) {
        $order_id = mysqli_insert_id($conn);

        $insert_order_address = mysqli_query($conn, "INSERT INTO order_address (order_id, block_street_building, province, city_municipality, barangay) VALUES ('$order_id', '$address', '$province', '$city', '$barangay')");

        if ($insert_order_address) {
            $get_cart = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = $user_id");

            foreach ($get_cart as $row) {
                $product_id = $row['product_id'];
                $cart_id = $row['cart_id'];
                $subcategory_id = $row['subcategory_id'];
                $product_qty = $row['product_qty'];
                $product_total = $row['product_total'];

                $insert_order_list = mysqli_query($conn, "INSERT INTO order_items (order_id, product_id, subcategory_id, qty, product_total) VALUES ('$order_id', '$product_id', '$subcategory_id', '$product_qty', '$product_total')");

                if ($insert_order_list) {
                    $delete_cart_item = mysqli_query($conn, "DELETE FROM cart WHERE cart_id = $cart_id");
                }
            }
            if ($delete_cart_item) {
                $_SESSION['order_id'] = $order_id;
                echo 'success';
            }
        }
    }
} else {
    $insert_orders = mysqli_query($conn, "INSERT INTO orders (user_id, payment_method, delivery_method, shipping_fee, order_total, order_date, order_status) VALUES ('$user_id', '$payment', '$delivery', '$shipping_value', '$order_total', '$date', '1')");

    if ($insert_orders) {
        $order_id = mysqli_insert_id($conn);

        $insert_order_address = mysqli_query($conn, "INSERT INTO order_address (order_id, billing_name, billing_number, block_street_building, province, city_municipality, barangay) VALUES ('$order_id', '$billing_name', '$billing_phone', '$address', '$province', '$city', '$barangay')");

        if ($insert_order_address) {
            $get_cart = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = $user_id");

            foreach ($get_cart as $row) {
                $product_id = $row['product_id'];
                $cart_id = $row['cart_id'];
                $subcategory_id = $row['subcategory_id'];
                $product_qty = $row['product_qty'];
                $product_total = $row['product_total'];

                $insert_order_list = mysqli_query($conn, "INSERT INTO order_items (order_id, product_id, subcategory_id, qty, product_total) VALUES ('$order_id', '$product_id', '$subcategory_id', '$product_qty', '$product_total')");

                if ($insert_order_list) {
                    $delete_cart_item = mysqli_query($conn, "DELETE FROM cart WHERE cart_id = $cart_id");
                }
            }
            if ($delete_cart_item) {
                $_SESSION['order_id'] = $order_id;
                echo 'success';
            }
        }
    }
}
