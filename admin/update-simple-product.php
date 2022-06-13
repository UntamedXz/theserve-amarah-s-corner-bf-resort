<?php
session_start();
if (!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin'] != true) {
    header("Location: ./login");
} else {
    $admin_id = $_SESSION['admin_id'];
}
require_once '../includes/database_conn.php';

$get_admin_info = mysqli_query($conn, "SELECT * FROM admin WHERE admin_id = $admin_id");

$info = mysqli_fetch_array($get_admin_info);

$userProfileIcon = $info['profile_image'];
$admin_type = $info['admin_type'];

$id = $_GET['id'];
$decode_id = base64_decode(urldecode($id));

$getSimpleProduct = mysqli_query($conn, "SELECT * FROM product WHERE product_id = $decode_id");

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
    $result_array['product_status'] = $result['product_status'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


    <!-- datatable lib -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cabin:wght@400;500;600;700;800&family=Poppins:wght@200;300;400;500;600;700&display=swap">

    <link rel="stylesheet" href="../assets/css/admin.css">

    <style>
        .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody::-webkit-scrollbar {
            width: 0px;
        }

        .dataTables_wrapper .dataTables_info {
            color: #936500 !important;
        }

        .dataTables_filter {
            margin-bottom: 10px;
        }

        .dataTables_filter label {
            color: #ffaf08;
        }

        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #ffaf08;
            color: #ffaf08;
        }

        table.dataTable thead {
            border-radius: 5px !important;
        }

        table.dataTable thead tr {
            background-color: #ffaf08;
            color: #070506;
            white-space: nowrap;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 5px 10px;
            background-color: #ffaf08 !important;
            color: #070506 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #070506 !important;
            border-color: #ffaf08;
            color: #ffaf08 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            background-color: #936500 !important;
            color: #070506 !important;
        }

        .dataTables_wrapper .dataTables_length select {
            color: #ffaf08 !important;
            border-color: #936500;
            background: #070506 !important;
        }

        .dataTables_wrapper .dataTables_length label {
            color: #936500 !important;
        }

        table thead tr th:first-child {
            border-top-left-radius: 5px !important;
        }

        table thead tr th:last-child {
            border-top-right-radius: 5px !important;
        }
    </style>
    <title>Admin Panel</title>
</head>

<body>
    <!-- TOAST -->
    <div class="toast" id="toast">
        <div class="toast-content" id="toast-content">
            <i id="toast-icon" class="fa-solid fa-triangle-exclamation warning"></i>

            <div class="message">
                <span class="text text-1" id="text-1"></span>
                <span class="text text-2" id="text-2"></span>
            </div>
        </div>
        <i class="fa-solid fa-xmark close"></i>
        <div class="progress"></div>
    </div>

    <?php include 'top.php';?>

    <!-- MAIN -->
    <main>
        <h1 class="title">Update Product</h1>
        <ul class="breadcrumbs">
            <li><a href="index">Home</a></li>
            <li class="divider">/</li>
            <li><a href="product">View Product</a></li>
            <li class="divider">/</li>
            <li><a href="insert-simple-product" class="active">Update Product</a></li>
        </ul>

        <section class="insert-product">
            <div class="insert-product-wrapper">
                <div class="product-container">
                    <input type="hidden" name="admin_type" id="admin_type" value="<?php echo $admin_type; ?>">
                    <h1>Product Details</h1>
                    <hr>
                    <form action="" enctype="multipart/form-data" id="update-simpleProductForm">
                        <div style="display: none;" class="form-group">
                            <span>Product ID</span>
                            <input type="text" name="product_id" id="simpleProduct-id" readonly value="<?php echo $decode_id; ?>">
                        </div>
                        <div class="form-group">
                            <span>Product Category</span>
                            <select name="category-list" id="category-list">
                                <option selected="selected" value="SELECT CATEGORY">SELECT CATEGORY</option>
                                <?php
                                $fetchCategory = mysqli_query($conn, "SELECT * FROM category");

                                foreach ($fetchCategory as $categoryRow) {
                                    $isSelected = '';
                                    if ($result_array['category_id'] == $categoryRow['category_id']) {
                                        $isSelected = "selected";
                                }
                                ?>

                                    <option value="<?php echo $categoryRow['category_id']; ?>" <?php echo $isSelected; ?>><?php echo $categoryRow['category_title']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <span class="error error-category"></span>
                        </div>
                        <?php
                        $categoryId = $result_array['category_id'];
                        $getSubcategory = mysqli_query($conn, "SELECT * FROM subcategory WHERE category_id = '$categoryId'");

                        if (mysqli_num_rows($getSubcategory) > 0) {
                        ?>
                            <div class="form-group subcategory-group">
                                <span>Product Subcategory</span>
                                <select name="subcategory-list" id="subcategory-list">
                                    <option selected="selected" value="SELECT SUBCATEGORY">SELECT SUBCATEGORY</option>
                                    <?php
                                    $getSubcategoryOptions = mysqli_query($conn, "SELECT * FROM subcategory WHERE category_id = '$categoryId'");

                                    foreach ($getSubcategoryOptions as $subcategoryOptions) {
                                        $isSelected = '';
                                        if ($result_array['subcategory_id'] == $subcategoryOptions['subcategory_id']) {
                                            $isSelected = "selected";
                                    }
                                    ?>
                                        <option value="<?php echo $subcategoryOptions['subcategory_id']; ?>" <?php echo $isSelected; ?>><?php echo $subcategoryOptions['subcategory_title']; ?></option>
                                    <?php
                                    }
                                        ?>
                                                                    </select>
                                                                    <span class="error error-subcategory"></span>
                                                                </div>
                                                            <?php
                                    } else {
                                    ?>
                                    <div class="form-group subcategory-group" style="display: none;">
                            <span>Product Subcategory</span>
                            <select name="subcategory-list" id="subcategory-list">
                                <option selected="selected" value="SELECT SUBCATEGORY">SELECT SUBCATEGORY</option>
                            </select>
                            <span class="error error-subcategory"></span>
                        </div>

                                    <?php
                                    }
                                    ?>
                        <div class="form-group">
                            <span>Product Title</span>
                            <input type="text" name="product_title" id="simpleProduct-title" value="<?php echo $result_array['product_title']; ?>">
                            <span class="error error-title"></span>
                        </div>
                        <div class="form-group">
                            <span>Product Url</span>
                            <input type="text" name="product_url" id="simpleProduct-url" value="<?php echo $result_array['product_slug']; ?>" readonly>
                            <span class="error error-url"></span>
                        </div>
                        <div class="form-group">
                            <span>Product Price</span>
                            <input type="text" name="product_price" id="simpleProduct-price" value="<?php echo $result_array['product_price']; ?>">
                            <span class="error error-price"></span>
                        </div>
                        <div class="form-group">
                            <span>Product Sale Price</span>
                            <input type="text" name="product_salePrice" id="simpleProduct-salePrice" value="<?php echo $result_array['product_sale']; ?>">
                            <span class="error error-salePrice"></span>
                        </div>
                        <div class="form-group">
                            <span>Product Image 1</span>
                            <input type="file" accept=".jpg, .jpeg, .png" name="product_image1" id="simpleProduct-image1">
                            <span class="error error-image"></span>
                        </div>
                        <div class="form-group">
                            <span>Image Preview</span>
                            <img id="file" style="width: 100px;" src="../assets/images/<?php echo $result_array['product_img1']; ?>">
                        </div>
                        <div class="form-group">
                            <span>Product Keyword</span>
                            <input type="text" name="product_keyword" id="simpleProduct-keyword" value="<?php echo $result_array['product_keyword']; ?>">
                            <span class="error error-keyword"></span>
                        </div>
                        <div style="display: none;" class="form-group">
                            <span>Old Image</span>
                            <input type="text" name="product_oldImage" id="simpleProduct-oldImage" value="<?php echo $result_array['product_img1']; ?>">
                            <span class="error error-keyword"></span>
                        </div>
                        <div class="form-group">
                            <span>Product Status</span>
                            <select name="product_status" id="product_status">
                                <option value="">SELECT</option>
                                <?php
                                $get_product_status = mysqli_query($conn, "SELECT * FROM product_status");

                                foreach($get_product_status as $status) {
                                ?>
                                <option value="<?php echo $status['product_status_id'] ?>" <?php if($status['product_status_id'] == $result_array['product_status']) { echo 'selected="selected"';} ?>><?php echo $status['product_status'] ?></option>
                                <?php 
                                }
                                ?>
                            </select>
                            <span class="error error-status"></span>
                        </div>
                        <button type="submit" id="update-simple-product">UPDATE</button>
                    </form>
                </div>
            </div>
        </section>

        <script>
            if($('#admin_type').val() != 1) {
                $('#category-list').attr('disabled','disabled');
                $('#subcategory-list').attr('disabled','disabled');
                $('#simpleProduct-title').attr('disabled','disabled');
                $('#simpleProduct-url').attr('disabled','disabled');
                $('#simpleProduct-desc').attr('disabled','disabled');
                $('#simpleProduct-price').attr('disabled','disabled');
                $('#simpleProduct-salePrice').attr('disabled','disabled');
                $('#simpleProduct-image1').attr('disabled','disabled');
                $('#simpleProduct-keyword').attr('disabled','disabled');
            }
        </script>

        <!-- IMAGE PREVIEW -->
        <script>
            $('#simpleProduct-image1').on('change', function() {
                var file = this.files[0];

                if(file) {
                    var reader = new FileReader();

                    reader.addEventListener('load', function() {
                        $('#file').attr("src", this.result);
                    })

                    reader.readAsDataURL(file);
                }
            })
        </script>

        <!-- CATEGORY | SUBCATEGORY AJAX -->
        <script>
            $(document).ready(function() {
                $("#category-list").change(function() {
                    var category_id = $(this).val();
                    $.ajax({
                        url: "./functions/get-subcategory",
                        type: "POST",
                        data: {
                            category_id: category_id
                        },
                        success: function(data) {
                            if (data === 'empty') {
                                $('.subcategory-group').hide();
                            } else {
                                $('.subcategory-group').show();
                                $('#subcategory-list').html(data);
                            }
                        }
                    })
                });
            });
        </script>

        <!-- UPDATE SIMPLE PRODUCT -->
        <script>
            $('#simpleProduct-title').keyup(function() {
                var str = $(this).val();
                var trims = $.trim(str)
                var slug = trims.replace(/[^a-z0-9]/gi, '-').replace(/-+/g, '-').replace(/^|-$/g, '')
                $('#simpleProduct-url').val(slug.toLowerCase());
                $('#simpleProduct-keyword').val(str);
            })

            $(document).ready(function() {
                $('#update-simpleProductForm').on('submit', function(e) {
                    e.preventDefault();

                    if ($('#category-list').val() == 'SELECT CATEGORY') {
                        $('.error-category').text('Category required');
                    } else {
                        $('.error-category').text('');
                    }
                    if ($('.subcategory-group').css('display') == 'none') {
                        $('#subcategory-list').val('SELECT SUBCATEGORY')
                        $('.error-subcategory').text('');
                    } else {
                        if ($('#subcategory-list').val() == 'SELECT SUBCATEGORY' || $('#subcategory-list').val() == '' || $('#subcategory-list').val() == 'none') {
                            $('.error-subcategory').text('Subcategory required');
                        } else {
                            $('.error-subcategory').text('');
                        }
                    }
                    if ($.trim($('#simpleProduct-title').val()).length == 0) {
                        $('.error-title').text('Product Title required');
                    } else {
                        $('.error-title').text('');
                    }
                    if ($.trim($('#simpleProduct-url').val()).length == 0) {
                        $('.error-url').text('Product URL required');
                    } else {
                        $('.error-url').text('');
                    }
                    if ($.trim($('#simpleProduct-price').val()).length == 0) {
                        $('.error-price').text('Product Price required');
                    } else {
                        $('.error-price').text('');
                    }
                    if ($.trim($('#simpleProduct-image1').val()).length == 0) {
                        $('.error-image').text('');
                    } else {
                        var imgExt = $('#simpleProduct-image1').val().split('.').pop().toLowerCase();

                        if ($.inArray(imgExt, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                            $('.error-image').text('File not supported');
                        } else {
                            var imgSize = $('#simpleProduct-image1')[0].files[0].size;

                            if (imgSize > 10485760) {
                                $('.error-image').text('File too large');
                            } else {
                                $('.error-image').text('');
                            }
                        }
                    }
                    if ($.trim($('#simpleProduct-keyword').val()).length == 0) {
                        $('.error-keyword').text('Product Keyword required');
                    } else {
                        $('.error-keyword').text('');
                    }
                    if($.trim($('#product_status').val()) == "") {
                    $('.error-status').text('Product Status required');
                    } else {
                        $('.error-status').text('');
                    }

                    if ($('.error-category').text() != '' || $('.error-subcategory').text() != '' || $('.error-title').text() != '' || $('.error-url').text() != '' || $('.error-price').text() != '' || $('.error-price').text() != '' || $('.error-salePrice').text() != '' || $('.error-image').text() != '' || $('.error-keyword').text() != '') {
                        $('#toast').addClass('active');
                        $('.progress').addClass('active');
                        $('.text-1').text('Error!');
                        $('.text-2').text('Fill all required fields!');
                        setTimeout(() => {
                            $('#toast').removeClass("active");
                            $('.progress').removeClass("active");
                        }, 5000);
                    } else {
                        $.ajax({
                            url: "./functions/update-simple-product-process",
                            type: "POST",
                            data: new FormData(this),
                            dataType: 'text',
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function(data) {
                                if (data === 'success') {
                                    $('.edit-modal').removeClass("active");
                                    $('#toast').addClass('active');
                                    $('.progress').addClass('active');
                                    $('#toast-icon').removeClass(
                                        'fa-solid fa-triangle-exclamation').addClass(
                                        'fa-solid fa-check warning');
                                    $('.text-1').text('Success!');
                                    $('.text-2').text('Product updated successfully!');
                                    setTimeout(() => {
                                        $('#toast').removeClass("active");
                                        $('.progress').removeClass("active");
                                    }, 5000);
                                    $('#example').DataTable().ajax.reload();
                                } else if (data === 'failed') {
                                    $('.edit-modal').removeClass("active");
                                    $('#toast').addClass('active');
                                    $('.progress').addClass('active');
                                    // $('#toast-icon').removeClass(
                                    //     'fa-solid fa-triangle-exclamation').addClass(
                                    //     'fa-solid fa-check warning');
                                    $('.text-1').text('Error!');
                                    $('.text-2').text('Something went wrong!');
                                    setTimeout(() => {
                                        $('#toast').removeClass("active");
                                        $('.progress').removeClass("active");
                                    }, 5000);
                                    $('#example').DataTable().ajax.reload();
                                } else if (data === 'product already exist') {
                                    $('.edit-modal').removeClass("active");
                                    $('#toast').addClass('active');
                                    $('.progress').addClass('active');
                                    // $('#toast-icon').removeClass(
                                    //     'fa-solid fa-triangle-exclamation').addClass(
                                    //     'fa-solid fa-check warning');
                                    $('.text-1').text('Error!');
                                    $('.text-2').text('Product already exist!');
                                    setTimeout(() => {
                                        $('#toast').removeClass("active");
                                        $('.progress').removeClass("active");
                                    }, 5000);
                                    $('#example').DataTable().ajax.reload();
                                } else {
                                    $('#toast').addClass('active');
                                    $('.progress').addClass('active');
                                    $('.text-1').text('Error!');
                                    $('.text-2').text('Something went wrong!');
                                    setTimeout(() => {
                                        $('#toast').removeClass("active");
                                        $('.progress').removeClass("active");
                                    }, 5000);
                                }

                                console.log(data);
                            }
                        })
                    }
                });
            });
        </script>

        <?php include 'bottom.php'?>

</body>

</html>