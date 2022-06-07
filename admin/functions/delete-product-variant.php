<?php 
require_once '../../includes/database_conn.php';

if(!empty($_POST['delete_variant_id'])) {
    $deleteVariantId = $_POST['delete_variant_id'];

    $deleteVariant = mysqli_query($conn, "DELETE FROM product_variant WHERE variant_id = $deleteVariantId");

    if($deleteVariant) {
        echo 'deleted';
    }
}