<?php
require_once '../../includes/database_conn.php';

if(empty($_POST['insert_variant_title'])) {
    echo 'empty field';
} else {
    $variantTitle =  strtoupper($_POST['insert_variant_title']);

    $check = mysqli_query($conn, "SELECT * FROM product_variant WHERE variant_title = '$variantTitle'");

    if(mysqli_num_rows($check) > 0) {
        echo 'title already exist';
    } else {
        $insertVariant = mysqli_query($conn, "INSERT INTO product_variant VALUES ('', '$variantTitle')");

        if($insertVariant) {
            echo 'success';
        } else {
            echo 'failed';
        }
    }
}