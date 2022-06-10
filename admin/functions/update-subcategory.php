<?php
require_once '../../includes/database_conn.php';

if ($_POST['update_category-list'] == "" && empty($_POST['update-subcategory'])) {
    echo 'empty field';
} else if ($_POST['update_category-list'] == "") {
    echo 'empty category';
} else if (empty($_POST['update-subcategory'])) {
    echo 'empty subcategory';
} else {
    $category = $_POST['update_category-list'];
    $subcategoryId = $_POST['update_subcategory_id'];
    $subcategoryTitle = ucwords($_POST['update-subcategory']);

    $check = mysqli_query($conn, "SELECT * FROM subcategory WHERE subcategory_title = '$subcategoryTitle'");

    if (mysqli_num_rows($check) == 1) {
        $check2 = mysqli_query($conn, "SELECT * FROM subcategory WHERE category_id = $category AND subcategory_title = '$subcategoryTitle'");

        if (mysqli_num_rows($check2) > 0) {
            echo 'subcategory title already exist';
        } else {
            $update = mysqli_query($conn, "UPDATE subcategory SET category_id = $category, subcategory_id = $subcategoryId, subcategory_title = '$subcategoryTitle' WHERE subcategory_id = $subcategoryId");

            if ($update) {
                echo 'success';
            }
        }
    } else {
        $update = mysqli_query($conn, "UPDATE subcategory SET category_id = $category, subcategory_title = '$subcategoryTitle' WHERE subcategory_id = $subcategoryId");

        if ($update) {
            echo 'success';
        }
    }
}
