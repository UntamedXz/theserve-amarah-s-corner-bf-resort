<?php
require_once '../../includes/database_conn.php';

if (!empty($_POST['delete_product_id'])) {
    $deleteProductId = $_POST['delete_product_id'];

    $getProduct = mysqli_query($conn, "SELECT * FROM product WHERE product_id = $deleteProductId");

    $productImg = '';

    while ($row = mysqli_fetch_array($getProduct)) {
        $productImg = $row['product_img1'];
    }

    if (!empty($productImg)) {
        $deleteProduct = mysqli_query($conn, "DELETE FROM product WHERE product_id = $deleteProductId");

        if ($deleteProduct) {
            echo 'deleted';
            unlink('../../assets/images/' . $productImg);
        }
    } else {
        $deleteProduct = mysqli_query($conn, "DELETE FROM product WHERE product_id = $deleteProductId");

        if ($deleteProduct) {
            echo 'deleted';
        }
    }
}
