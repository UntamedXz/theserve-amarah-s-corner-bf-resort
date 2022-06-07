<?php
require_once '../../includes/database_conn.php';

$update_variant_id = $_POST['update_variant_id'];
$update_variant_title = strtoupper(mysqli_real_escape_string($conn, $_POST['update_variant_title']));

$check_variant_title = mysqli_query($conn, "SELECT * FROM product_variant WHERE variant_title = '$update_variant_title'");

if(!empty($update_variant_title)) {
    if(mysqli_num_rows($check_variant_title) > 0) {
        $check_variant_title = mysqli_query($conn, "SELECT * FROM product_variant WHERE variant_title = '$update_variant_title' AND variant_id = $update_variant_id");
    
        if(mysqli_num_rows($check_variant_title) == 1) {
            echo 'success';
        } else {
            echo 'already exist';
        }
    } else {
        $insert_variant_title = mysqli_query($conn, "UPDATE product_variant SET variant_title = '$update_variant_title' WHERE variant_id = $update_variant_id");
    
        if($insert_variant_title) {
            echo 'success';
        }
    }
} else {
    echo 'empty';
}