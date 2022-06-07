<?php
require_once '../../includes/database_conn.php';

// echo '<pre>';
// print_r($_FILES);

if (empty($_POST['update_category_title'])) {
    echo 'category is empty';
}

if (!empty($_POST['update_category_title']) && $_FILES['update_category_thumbnail']['error'] === 4) {
    $categoryId = $_POST['update_category_id'];
    $categoryTitle = mysqli_real_escape_string($conn, $_POST['update_category_title']);

    $checkTitle = mysqli_query($conn, "SELECT * FROM category WHERE category_title = '$categoryTitle'");

    if (mysqli_num_rows($checkTitle) == 1) {
        $checkTitle2 = mysqli_query($conn, "SELECT * FROM category WHERE category_title = '$categoryTitle' AND category_id = $categoryId");

        if (mysqli_num_rows($checkTitle2) == 0) {
            echo 'category title already exist';
        } else {
            $categoryId = mysqli_real_escape_string($conn, $_POST['update_category_id']);
            $categoryTitle = mysqli_real_escape_string($conn, $_POST['update_category_title']);

            $updateCategory = mysqli_query($conn, "UPDATE category SET category_title = '$categoryTitle' WHERE category_id = $categoryId");

            if ($updateCategory) {
                echo 'title updated';
            }
        }
    } else {
        $categoryId = mysqli_real_escape_string($conn, $_POST['update_category_id']);
        $categoryTitle = ucwords(mysqli_real_escape_string($conn, $_POST['update_category_title']));

        $updateCategory = mysqli_query($conn, "UPDATE category SET category_title = '$categoryTitle' WHERE category_id = $categoryId");

        if ($updateCategory) {
            echo 'title updated';
        }
    }
}

if (!empty($_POST['update_category_title']) && $_FILES['update_category_thumbnail']['error'] === 0) {
    $categoryThumbnailName = $_FILES['update_category_thumbnail']['name'];
    $categoryThumbnailSize = $_FILES['update_category_thumbnail']['size'];
    $categoryThumbnailTmpName = $_FILES['update_category_thumbnail']['tmp_name'];

    $validImgExt = ['jpg', 'jpeg', 'png'];
    $thumbnailExt = explode('.', $categoryThumbnailName);
    $thumbnailExt = strtolower(end($thumbnailExt));

    if (!in_array($thumbnailExt, $validImgExt)) {
        echo 'invalid file';
    } else if ($categoryThumbnailSize > 10485760 || $categoryThumbnailSize > 41943040) {
        echo 'too large';
    } else {
        $categoryId = mysqli_real_escape_string($conn, $_POST['update_category_id']);
        $categoryTitle = mysqli_real_escape_string($conn, $_POST['update_category_title']);
        $checkTitle = mysqli_query($conn, "SELECT * FROM category WHERE category_title = '$categoryTitle'");

        if (mysqli_num_rows($checkTitle) > 0) {
            $checkTitle2 = mysqli_query($conn, "SELECT * FROM category WHERE category_title = '$categoryTitle' AND category_id = $categoryId");

            if (mysqli_num_rows($checkTitle2) == 0) {
                echo 'category title already exist';
            } else {
                $categoryId = mysqli_real_escape_string($conn, $_POST['update_category_id']);
                $categoryTitle = mysqli_real_escape_string($conn, $_POST['update_category_title']);
                $oldCategoryThumbnail = $_POST['category_thumbnailDB'];

                $newCategoryThumbnailName = uniqid() . '.' .$thumbnailExt;

                move_uploaded_file($categoryThumbnailTmpName, '../../assets/images/' . $newCategoryThumbnailName);
                unlink('../../assets/images/' . $oldCategoryThumbnail);

                $updateCategory = mysqli_query($conn, "UPDATE category SET category_title = '$categoryTitle', categoty_thumbnail = '$newCategoryThumbnailName' WHERE category_id = $categoryId");

                if ($updateCategory) {
                    echo 'updated successfully';
                }
            }
        } else {
            $categoryId = mysqli_real_escape_string($conn, $_POST['update_category_id']);
            $categoryTitle = mysqli_real_escape_string($conn, $_POST['update_category_title']);
            $oldCategoryThumbnail = $_POST['category_thumbnailDB'];

            $newCategoryThumbnailName = uniqid() . '.' . $thumbnailExt;

            move_uploaded_file($categoryThumbnailTmpName, '../../assets/images/' . $newCategoryThumbnailName);
            unlink('../../assets/images/' . $oldCategoryThumbnail);

            $updateCategory = mysqli_query($conn, "UPDATE category SET category_title = '$categoryTitle', categoty_thumbnail = '$newCategoryThumbnailName' WHERE category_id = $categoryId");

            if ($updateCategory) {
                echo 'updated successfully';
            }
        }
    }
}
