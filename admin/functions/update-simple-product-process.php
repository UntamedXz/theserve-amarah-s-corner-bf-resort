<?php
require_once '../../includes/database_conn.php';

$productId = $_POST['product_id'];
$productCategory = $_POST['category-list'];
$productSubcategory = $_POST['subcategory-list'];
$productTitle = mysqli_real_escape_string($conn, ucwords($_POST['product_title']));
$productUrl = $_POST['product_url'];
$productPrice = $_POST['product_price'];
$productSalePrice = $_POST['product_salePrice'];
$productImage1Name = $_FILES['product_image1']['name'];
$productImage1TmpName = $_FILES['product_image1']['tmp_name'];
$productKeyword = $_POST['product_keyword'];
$productOldImage = $_POST['product_oldImage'];

if ($_FILES['product_image1']['error'] === 4) {
    $checkProduct = mysqli_query($conn, "SELECT * FROM product WHERE product_title = '$productTitle'");

    if (mysqli_num_rows($checkProduct) > 0) {
        $checkIfProductExist2 = mysqli_query($conn, "SELECT * FROM product WHERE product_title = '$productTitle' AND product_id = $productId");

        if (mysqli_num_rows($checkIfProductExist2) == 0) {
            echo 'product already exist';
        } else {
            $updateProduct = mysqli_query($conn, "UPDATE product SET category_id = '$productCategory', subcategory_id = '$productSubcategory', product_title = '$productTitle', product_slug = '$productUrl', product_keyword = '$productKeyword', product_price = '$productPrice', product_sale = '$productSalePrice' WHERE product_id = $productId");

            if ($updateProduct) {
                echo 'success';
            }
        }
    } else {
        $updateProduct = mysqli_query($conn, "UPDATE product SET category_id = '$productCategory', subcategory_id = '$productSubcategory', product_title = '$productTitle', product_slug = '$productUrl', product_keyword = '$productKeyword', product_price = '$productPrice', product_sale = '$productSalePrice' WHERE product_id = $productId");

        if ($updateProduct) {
            echo 'success';
        }
    }
}

if ($_FILES['product_image1']['error'] === 0) {
    $checkIfProductExist = mysqli_query($conn, "SELECT * FROM product WHERE product_title = '$productTitle'");

    if (mysqli_num_rows($checkIfProductExist) > 0) {
        $checkIfProductExist2 = mysqli_query($conn, "SELECT * FROM product WHERE product_title = '$productTitle' AND product_id = $productId");

        if (mysqli_num_rows($checkIfProductExist2) == 0) {
            echo 'product already exist';
        } else {
            $imgExt = explode('.', $productImage1Name);
            $imgExt = strtolower(end($imgExt));

            $newImageName = uniqid() . '.' . $imgExt;

            move_uploaded_file($productImage1TmpName, '../../assets/images/' . $newImageName);
            unlink('../../assets/images/' . $productOldImage);

            $updateProduct = mysqli_query($conn, "UPDATE product SET category_id = '$productCategory', subcategory_id = '$productSubcategory', product_title = '$productTitle', product_slug = '$productUrl', product_img1 = '$newImageName', product_keyword = '$productKeyword', product_price = '$productPrice', product_sale = '$productSalePrice' WHERE product_id = $productId");

            if ($updateProduct) {
                echo 'success';
            }
        }
    } else {
        $imgExt = explode('.', $productImage1Name);
        $imgExt = strtolower(end($imgExt));

        $newImageName = uniqid() . '.' . $imgExt;

        move_uploaded_file($productImage1TmpName, '../../assets/images/' . $newImageName);
        unlink('../../assets/images/' . $productOldImage);

        $updateProduct = mysqli_query($conn, "UPDATE product SET category_id = '$productCategory', subcategory_id = '$productSubcategory', product_title = '$productTitle', product_slug = '$productUrl', product_img1 = '$newImageName', product_keyword = '$productKeyword', product_price = '$productPrice', product_sale = '$productSalePrice' WHERE product_id = $productId");

        if ($updateProduct) {
            echo 'success';
        }
    }
}
