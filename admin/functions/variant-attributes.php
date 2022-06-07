<?php
session_start();
require_once '../../includes/database_conn.php';

$variant_id = $_POST['variant_id'];
$attributes = $_POST['attributes'];
$product_slug = $_POST['product_slug'];
$product_id = $_POST['product_id'];

for($count = 0; $count < count($attributes); $count++) {
    $split = explode(',', $attributes[$count]);
    foreach($split as $row) {
        $insert_attribute = mysqli_query($conn, "INSERT INTO product_attribute (variant_id, product_id, attribute_title) VALUES ('$variant_id[$count]', '$product_id', '$row')");
    }
}

if($insert_attribute) {
    $_SESSION['product_id'] = $product_id;
    $_SESSION['alert'] = 'success_variant';
    echo 'success';
}