<?php 
require_once '../../includes/database_conn.php';

if(!empty($_POST['delete_category_id'])) {
    $deleteCategoryId = $_POST['delete_category_id'];

    $getCategory = mysqli_query($conn, "SELECT * FROM category WHERE category_id = $deleteCategoryId");

    $categoryImg = '';

    while($row = mysqli_fetch_array($getCategory)) {
        $categoryImg = $row['categoty_thumbnail'];
    }

    $deleteCategory = mysqli_query($conn, "DELETE FROM category WHERE category_id = $deleteCategoryId");

    if($deleteCategory) {
        echo 'deleted';
        unlink('../../assets/images/' . $categoryImg);
    }
}