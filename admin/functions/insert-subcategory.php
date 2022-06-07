<?php
require_once '../../includes/database_conn.php';

if($_POST['category-list'] == "CATEGORY" && empty($_POST['insert-subcategory'])) {
    echo 'empty field';
} else if ($_POST['category-list'] == "CATEGORY") {
    echo 'empty category';
} else if (empty($_POST['insert-subcategory'])) {
    echo 'empty subcategory';
} else {
    $category =  $_POST['category-list'];
    $subcategoryTitle = ucwords($_POST['insert-subcategory']);

    $check = mysqli_query($conn, "SELECT * FROM subcategory WHERE subcategory_title = '$subcategoryTitle' AND category_id = $category");

    if(mysqli_num_rows($check) > 0) {
        echo 'title already exist';
    } else {
        $insertSubcategory = mysqli_query($conn, "INSERT INTO subcategory VALUES ($category, '', '$subcategoryTitle')");

        if($insertSubcategory) {
            echo 'success';
        } else {
            echo 'failed';
        }
    }
}