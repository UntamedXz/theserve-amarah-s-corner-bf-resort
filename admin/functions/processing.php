<?php
session_start();
require_once '../../includes/database_conn.php';

// LOGIN
if (isset($_POST['login'])) {
    $email = mysqli_escape_string($conn, $_POST['email']);
    $password = mysqli_escape_string($conn, $_POST['password']);

    if (empty($email) && empty($password)) {
        $_SESSION['status'] = "no input";
        header("Location: ../login");
    } else if (empty($email)) {
        $_SESSION['status'] = "no email";
        header("Location: ../login");
    } else if (empty($password)) {
        $_SESSION['admin_email'] = $_POST['email'];
        $_SESSION['status'] = "no password";
        header("Location: ../login");
    } else {
        $check = mysqli_query($conn, "SELECT * FROM admin WHERE admin_email = '$email'");

        if (mysqli_num_rows($check) == 0) {
            $_SESSION['status'] = "email not registered";
            $_SESSION['admin_email'] = $_POST['email'];
            header("Location: ../login");
        } else {
            $row = mysqli_fetch_array($check);

            if ($password == $row['admin_password']) {
                if (isset($_POST['rem']) == 'checked') {
                    setcookie('admin_email', $row['admin_email'], time() + (86400 * 30), '/');
                    setcookie('admin_password', $row['admin_password'], time() + (86400 * 30), '/');
                } else {
                    setcookie('admin_email', '');
                    setcookie('admin_password', '');
                }
                $_SESSION['adminloggedin'] = true;
                $_SESSION['adminEmail'] = $email;
                header("Location: ../index");
            } else {
                $_SESSION['status'] = "wrong password";
                $_SESSION['admin_email'] = $_POST['email'];
                $_SESSION['adminEmail'] = '';
                header("Location: ../login");
            }
        }
    }
}

// EDIT CATEGORY MODAL
if (isset($_REQUEST['category_id_edit'])) {
    $category_id = $_REQUEST['category_id_edit'];
    $get_category = mysqli_query($conn, "SELECT * FROM category WHERE category_id = '$category_id'");

    $result_array = array();
    while ($result = mysqli_fetch_assoc($get_category)) {
        $result_array['category_id'] = $result['category_id'];
        $result_array['category_title'] = $result['category_title'];
        $result_array['category_thumbnail'] = $result['categoty_thumbnail'];
    }

    echo json_encode($result_array);
}

// VIEW CATEGORY MODAL
if (isset($_REQUEST['category_id_view'])) {
    $category_id = $_REQUEST['category_id_view'];
    $get_category = mysqli_query($conn, "SELECT category_title, categoty_thumbnail FROM category WHERE category_id = '$category_id'");

    $result_array = array();
    while ($result = mysqli_fetch_assoc($get_category)) {
        $result_array['category_title'] = $result['category_title'];
        $result_array['category_thumbnail'] = $result['categoty_thumbnail'];
    }

    echo json_encode($result_array);
}

// EDIT SUB CATEGORY MODAL
if (isset($_REQUEST['subcategory_id_edit'])) {
    $subcategory_id = $_REQUEST['subcategory_id_edit'];
    $get_subcategory = mysqli_query($conn, "SELECT category.category_id, subcategory.subcategory_id, subcategory.subcategory_title
    FROM subcategory
    INNER JOIN category
    ON subcategory.category_id=category.category_id
    WHERE subcategory.subcategory_id = $subcategory_id");

    $result_array = array();
    while ($result = mysqli_fetch_assoc($get_subcategory)) {
        $result_array['category_id'] = $result['category_id'];
        $result_array['subcategory_id'] = $result['subcategory_id'];
        $result_array['subcategory_title'] = $result['subcategory_title'];
    }

    echo json_encode($result_array);
}

// EDIT VARIANT MODAL
if (isset($_POST['variant_id_edit'])) {
    $variantId = $_POST['variant_id_edit'];

    $getVariant = mysqli_query($conn, "SELECT * FROM product_variant WHERE variant_id = $variantId");

    $result_array = array();
    while ($result = mysqli_fetch_assoc($getVariant)) {
        $result_array['variant_id'] = $result['variant_id'];
        $result_array['variant_title'] = $result['variant_title'];
    }

    echo json_encode($result_array);
}

// EDIT PRODUCT PAGE
if (isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    $checkProduct = mysqli_query($conn, "SELECT * FROM product_variation WHERE product_id = $productId");

    $encryptedId = urlencode(base64_encode($productId));

    if(mysqli_num_rows($checkProduct) > 0) {
        echo "insert-variable-product?id=" . $productId;
    } else {
        echo "update-simple-product?id=" . $encryptedId;
    }
}

// EDIT SIMPLE PRODUCT
if (isset($_POST['simple_product_id'])) {
    $productId = $_POST['simple_product_id'];

    $getSimpleProduct = mysqli_query($conn, "SELECT * FROM product WHERE product_id = $productId");

    $result_array = array();
    while ($result = mysqli_fetch_assoc($getSimpleProduct)) {
        $result_array['category_id'] = $result['category_id'];
        $result_array['subcategory_id'] = $result['subcategory_id'];
        $result_array['product_title'] = $result['product_title'];
        $result_array['product_slug'] = $result['product_slug'];
        $result_array['product_price'] = $result['product_price'];
        $result_array['product_sale'] = $result['product_sale'];
        $result_array['product_img1'] = $result['product_img1'];
        $result_array['product_keyword'] = $result['product_keyword'];
    }

    echo json_encode($result_array);
}

// EDIT ORDER STATUS
if (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    $checkOrder = mysqli_query($conn, "SELECT * FROM orders WHERE order_id = $order_id");

    $encryptedId = urlencode(base64_encode($order_id));

    if(mysqli_num_rows($checkOrder) > 0) {
        echo "view-edit-orders?id=" . $encryptedId;
    }
}

// VIEW ORDER DELIVERED
if (isset($_POST['order_id_view'])) {
    $order_id_view = $_POST['order_id_view'];

    $checkOrder = mysqli_query($conn, "SELECT * FROM orders WHERE order_id = $order_id_view");

    $encryptedId = urlencode(base64_encode($order_id_view));

    if(mysqli_num_rows($checkOrder) > 0) {
        echo "view-order-delivered?id=" . $encryptedId;
    }
}

// EDIT UPDATES MODAL
if (isset($_REQUEST['updates_id'])) {
    $updates_id = $_REQUEST['updates_id'];
    $get_updates = mysqli_query($conn, "SELECT * FROM updates WHERE updates_id = '$updates_id'");

    $result_array = array();
    while ($result = mysqli_fetch_assoc($get_updates)) {
        $result_array['updates_id'] = $result['updates_id'];
        $result_array['updates_text'] = $result['updates_text'];
        $result_array['updates_image'] = $result['updates_image'];
        $result_array['updates_date'] = $result['updates_date'];
    }

    echo json_encode($result_array);
}