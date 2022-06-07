<?php
session_start();
require_once '../includes/database_conn.php';

if(isset($_POST['add-to-cart'])) {
    $product_id = $_POST['product_id'];
    $userId = $_POST['userId'];
    $qty = $_POST['qty'];
    $total = $_POST['total'];

    $getProduct = mysqli_query($conn, "SELECT * FROM product WHERE product_id = $product_id");

    while($row = mysqli_fetch_array($getProduct)) {
        $productId = $row['product_id'];
        $categoryId = $row['category_id'];
        $subcategoryId = $row['subcategory_id'];
    }

    $insertCart = mysqli_query($conn, "INSERT INTO cart (user_id, category_id, subcategory_id, product_id, product_qty, product_total) VALUES ('$userId', '$categoryId', '$subcategoryId', '$productId', '$qty', '$total')");

    if($insertCart) {
        $_SESSION['alert'] = 'success';
        echo 'success';
    }
}
?>