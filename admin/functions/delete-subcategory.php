<?php 
require_once '../../includes/database_conn.php';

if(!empty($_POST['delete_subcategory_id'])) {
    $deleteSubcategoryId = $_POST['delete_subcategory_id'];

    $deleteCategory = mysqli_query($conn, "DELETE FROM subcategory WHERE subcategory_id = $deleteSubcategoryId");

    if($deleteCategory) {
        echo 'deleted';
    }
}