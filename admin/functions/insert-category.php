<?php
require_once '../../includes/database_conn.php';

if(empty($_POST['insert_category_title']) && $_FILES['insert_category_thumbnail']['error'] === 4) {
    echo 'empty fields';
} else if(empty($_POST['insert_category_title'])) {
    echo 'empty category title';
} else if($_FILES['insert_category_thumbnail']['error'] === 4) {
    echo 'empty thumbnail';
} else {
    $categoryTitle = mysqli_real_escape_string($conn, $_POST['insert_category_title']);
    $categoryThumbnailName = $_FILES['insert_category_thumbnail']['name'];
    $categoryThumbnailSize = $_FILES['insert_category_thumbnail']['size'];
    $categoryThumbnailTmpName = $_FILES['insert_category_thumbnail']['tmp_name'];

    $validImgExt = ['jpg', 'jpeg', 'png'];
    $imgExt = explode('.', $categoryThumbnailName);
    $imgExt = strtolower(end($imgExt));

    if(!in_array($imgExt, $validImgExt)) {
        echo 'file not supported';
    } else if($categoryThumbnailSize > 10485760) {
        echo 'file too large';
    } else {
        $categoryTitle = mysqli_real_escape_string($conn, $_POST['insert_category_title']);

        $check = mysqli_query($conn, "SELECT * FROM category WHERE category_title = '$categoryTitle'");

        if(mysqli_num_rows($check) > 0) {
            echo 'title already exist';
        } else {
            $newThumbnailName = uniqid() . '.' . $imgExt;

            move_uploaded_file($categoryThumbnailTmpName, '../../assets/images/' . $newThumbnailName);

            $insertCategory = mysqli_query($conn, "INSERT INTO category VALUES ('', '$categoryTitle', '$newThumbnailName')");

            if($insertCategory) {
                echo 'successful';
            }
        }
    }
}
?>