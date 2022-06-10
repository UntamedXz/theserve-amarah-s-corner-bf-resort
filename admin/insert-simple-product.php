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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Cabin:wght@400;500;600;700;800&family=Poppins:wght@200;300;400;500;600;700&display=swap">

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

    <!-- DELETE -->
    <div id="popup-box" class="popup-box delete-modal">
        <div class="top">
            <h3>Edit Category</h3>
            <div id="modalClose" class="fa-solid fa-xmark"></div>
        </div>
        <hr>
        <form id="delete_category">
            <div style="display: none;" class="form-group">
                <span>Category ID</span>
                <input type="text" id="delete_category_id" name="delete_category_id" value="">
            </div>
            <p>Are you sure, you want to delete this category?</p>
        </form>
        <hr>
        <div class="bottom">
            <div class="buttons">
                <button id="modalClose" type="button" class="cancel">CLOSE</button>
                <button form="delete_category" id="deleteSubCategory" type="submit" class="save">DELETE</button>
            </div>

        </div>
    </div>

    <!-- VIEW -->
    <div id="popup-box" class="popup-box view-modal">
        <div class="top">
            <h3>Edit Category</h3>
            <div id="modalClose" class="fa-solid fa-xmark"></div>
        </div>
        <hr>
        <form enctype="multipart/form-data">
            <h5>Category: <span style="color: #ffaf08; padding-left: 5px;" id="category_title_view"></span></h5>
            <h5>Category Thumbnail: <br> <img id="category_thumbnail_view" style="width: 150px; margin-top: 5px;"
                    src=""></h5>
        </form>
        <hr>
        <div class="bottom">
            <div class="buttons">
                <button id="modalClose" type="button" class="cancel">CLOSE</button>
            </div>
        </div>
    </div>

    <?php include 'top.php'; ?>

    <!-- MAIN -->
    <main>
        <h1 class="title">Insert Simple Product</h1>
        <ul class="breadcrumbs">
            <li><a href="index">Home</a></li>
            <li class="divider">/</li>
            <li><a href="product">View Product</a></li>
            <li class="divider">/</li>
            <li><a href="insert-simple-product" class="active">Insert Simple Product</a></li>
        </ul>

        <section class="insert-product">
            <div class="insert-product-wrapper">
                <div class="product-container">
                    <h1>Product Details</h1>
                    <hr>
                    <form action="" enctype="multipart/form-data" id="insert-simpleProductForm">
                        <div class="form-group">
                            <span>Product Category</span>
                            <select name="category-list" id="category-list">
                                <option selected="selected" value="SELECT CATEGORY">SELECT CATEGORY</option>
                                <?php
                                $fetchCategory = mysqli_query($conn, "SELECT * FROM category");

                                foreach ($fetchCategory as $categoryRow) {
                                ?>
                                <option value="<?php echo $categoryRow['category_id']; ?>">
                                    <?php echo $categoryRow['category_title']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <span class="error error-category"></span>
                        </div>
                        <div class="form-group subcategory-group">
                            <span>Product Subcategory</span>
                            <select name="subcategory-list" id="subcategory-list">
                                <option selected="selected" value="SELECT SUBCATEGORY">SELECT SUBCATEGORY</option>
                            </select>
                            <span class="error error-subcategory"></span>
                        </div>
                        <div class="form-group">
                            <span>Product Title</span>
                            <input type="text" name="product_title" id="simpleProduct-title">
                            <span class="error error-title"></span>
                        </div>
                        <div class="form-group">
                            <span>Product Url</span>
                            <input type="text" name="product_url" id="simpleProduct-url" readonly>
                            <span class="error error-url"></span>
                        </div>
                        <div class="form-group">
                            <span>Product Description</span>
                            <textarea name="product_desc" id="simpleProduct-desc" cols="20" rows="5"></textarea>
                            <span class="error error-desc"></span>
                        </div>
                        <div class="form-group">
                            <span>Product Price</span>
                            <input type="text" name="product_price" id="simpleProduct-price">
                            <span class="error error-price"></span>
                        </div>
                        <div class="form-group">
                            <span>Product Sale Price</span>
                            <input type="text" name="product_salePrice" id="simpleProduct-salePrice">
                            <span class="error error-salePrice"></span>
                        </div>
                        <div class="form-group">
                            <span>Product Image 1</span>
                            <input type="file" accept=".jpg, .jpeg, .png" name="product_image1"
                                id="simpleProduct-image1">
                            <span class="error error-image"></span>
                        </div>
                        <div class="form-group">
                            <span>Image Preview</span>
                            <img id="file" style="width: 100px;" src="">
                        </div>
                        <div class="form-group">
                            <span>Product Keyword</span>
                            <input type="text" name="product_keyword" id="simpleProduct-keyword">
                            <span class="error error-keyword"></span>
                        </div>
                        <div class="form-group">
                            <span>Product Status</span>
                            <select name="product_status" id="product_status" required>
                                <option value="">SELECT</option>
                                <?php
                                $get_product_status = mysqli_query($conn, "SELECT * FROM product_status");

                                foreach($get_product_status as $status) {
                                ?>
                                <option value="<?php echo $status['product_status_id'] ?>"><?php echo $status['product_status'] ?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" id="insert-simple-product">INSERT</button>
                    </form>
                </div>
            </div>
        </section>

        <!-- IMAGE PREVIEW -->
        <script>
        $('#simpleProduct-image1').on('change', function() {
            var file = this.files[0];

            if (file) {
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

        <!-- SUBMIT SIMPLE PRODUCT -->
        <script>
        $('#simpleProduct-title').keyup(function() {
            var str = $(this).val();
            var trims = $.trim(str)
            var slug = trims.replace(/[^a-z0-9]/gi, '-').replace(/-+/g, '-').replace(/^|-$/g, '')
            $('#simpleProduct-url').val(slug.toLowerCase());
            $('#simpleProduct-keyword').val(str);
        })

        $(document).ready(function() {
            $('#insert-simpleProductForm').on('submit', function(e) {
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
                if ($.trim($('#simpleProduct-desc').val()).length == 0) {
                    $('.error-desc').text('');
                } else {
                    $('.error-desc').text('');
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
                if ($('.error-category').text() != '' || $('.error-subcategory').text() != '' || $(
                        '.error-title').text() != '' || $('.error-desc').text() != '' || $('.error-url')
                    .text() != '' || $('.error-price').text() != '' || $('.error-price').text() != '' ||
                    $('.error-salePrice').text() != '' || $('.error-image').text() != '' || $(
                        '.error-keyword').text() != '') {
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
                        url: "./functions/insert-simple-product-process",
                        type: "POST",
                        data: new FormData(this),
                        dataType: 'text',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            if (data == 'success') {
                                $('#toast').addClass('active');
                                $('.progress').addClass('active');
                                $('#toast-icon').removeClass(
                                    'fa-solid fa-triangle-exclamation').addClass(
                                    'fa-solid fa-check warning');
                                $('.text-1').text('Success!');
                                $('.text-2').text('Product added successfully!');
                                setTimeout(() => {
                                    $('#toast').removeClass("active");
                                    $('.progress').removeClass("active");
                                }, 5000);
                                $('#example').DataTable().ajax.reload();
                                $('#insert-simpleProductForm')[0].reset();
                            } else if (data == 'failed') {
                                $('#toast').addClass('active');
                                $('.progress').addClass('active');
                                $('.text-1').text('Error!');
                                $('.text-2').text('Something went wrong!');
                                setTimeout(() => {
                                    $('#toast').removeClass("active");
                                    $('.progress').removeClass("active");
                                }, 5000);
                                $('#example').DataTable().ajax.reload();
                            } else if (data == 'product already exist') {
                                $('#toast').addClass('active');
                                $('.progress').addClass('active');
                                $('.text-1').text('Error!');
                                $('.text-2').text('Product already exist!');
                                setTimeout(() => {
                                    $('#toast').removeClass("active");
                                    $('.progress').removeClass("active");
                                }, 5000);
                            } else {
                                $('#toast').addClass('active');
                                $('.progress').addClass('active');
                                $('.text-1').text('Error!');
                                $('.text-2').text(data);
                                setTimeout(() => {
                                    $('#toast').removeClass("active");
                                    $('.progress').removeClass("active");
                                }, 5000);
                            }
                        }
                    })
                }
            });
        });
        </script>

        <script>
        // TABS
        var variant = document.getElementById("product-variant");
        var attribute = document.getElementById("product-attribute");
        var general = document.getElementById("product-general");
        var btn1 = document.getElementById("btn1");
        var btn2 = document.getElementById("btn2");
        var btn3 = document.getElementById("btn3");

        function openVariant() {
            variant.style.opacity = '1';
            variant.style.pointerEvents = 'visible';
            attribute.style.opacity = '0';
            attribute.style.pointerEvents = 'none';
            btn1.style.color = '#fff';
            btn2.style.color = '#ffaf08';
        }

        function openAttribute() {
            variant.style.opacity = '0';
            variant.style.pointerEvents = 'none';
            attribute.style.opacity = '1';
            attribute.style.pointerEvents = 'visible';
            btn1.style.color = '#ffaf08';
            btn2.style.color = '#fff';
        }
        </script>

        <script>
        // DATA TABLES
        var dataTable = $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "paging": true,
            "pagingType": "simple",
            "scrollX": true,
            "sScrollXInner": "100%",
            "aLengthMenu": [
                [5, 10, 15, 100],
                [5, 10, 15, 100]
            ],
            "iDisplayLength": 5,
            "ajax": {
                url: "./functions/category-table",
                type: "post"
            }
        });
        </script>

        <script>
        // SUBMIT EDIT
        $(document).ready(function() {
            $("#edit-category").on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "update-category",
                    data: new FormData(this),
                    dataType: 'text',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        if (response === 'category is empty') {
                            $('#toast').addClass('active');
                            $('.progress').addClass('active');
                            // $('#toast-icon').removeClass('fa-solid fa-triangle-exclamation').addClass('fa-solid fa-circle-exclamation');
                            $('.text-1').text('Error!');
                            $('.text-2').text('Category title field is empty!');
                            setTimeout(() => {
                                $('#toast').removeClass("active");
                                $('.progress').removeClass("active");
                            }, 5000);
                        }

                        if (response === 'category title already exist') {
                            $('#toast').addClass('active');
                            $('.progress').addClass('active');
                            $('.text-1').text('Error!');
                            $('.text-2').text('Category title already exist!');
                            setTimeout(() => {
                                $('#toast').removeClass("active");
                                $('.progress').removeClass("active");
                            }, 5000);
                        }

                        if (response === 'title updated') {
                            $('.edit-modal').removeClass("active");
                            $('#toast').addClass('active');
                            $('.progress').addClass('active');
                            $('#toast-icon').removeClass(
                                'fa-solid fa-triangle-exclamation').addClass(
                                'fa-solid fa-check warning');
                            $('.text-1').text('Success!');
                            $('.text-2').text('Category title updated successfully!');
                            setTimeout(() => {
                                $('#toast').removeClass("active");
                                $('.progress').removeClass("active");
                            }, 5000);
                            $('#example').DataTable().ajax.reload();
                        }

                        if (response === 'invalid file') {
                            $('#toast').addClass('active');
                            $('.progress').addClass('active');
                            $('.text-1').text('Error!');
                            $('.text-2').text('File not supported!');
                            setTimeout(() => {
                                $('#toast').removeClass("active");
                                $('.progress').removeClass("active");
                            }, 5000);
                            $('#example').DataTable().ajax.reload();
                        }
                        if (response === 'invalid file') {
                            $('#toast').addClass('active');
                            $('.progress').addClass('active');
                            $('.text-1').text('Error!');
                            $('.text-2').text('File is too large!');
                            setTimeout(() => {
                                $('#toast').removeClass("active");
                                $('.progress').removeClass("active");
                            }, 5000);
                            $('#example').DataTable().ajax.reload();
                        }

                        if (response === 'updated successfully') {
                            $('.edit-modal').removeClass("active");
                            $('#toast').addClass('active');
                            $('.progress').addClass('active');
                            $('#toast-icon').removeClass(
                                'fa-solid fa-triangle-exclamation').addClass(
                                'fa-solid fa-check warning');
                            $('.text-1').text('Success!');
                            $('.text-2').text(
                                'Category title and thumbnail updated successfully!'
                            );
                            setTimeout(() => {
                                $('#toast').removeClass("active");
                                $('.progress').removeClass("active");
                            }, 5000);
                            $('#example').DataTable().ajax.reload();
                        }
                    }
                })
            })

            // SUBMIT INSERT
            $('#insert-category').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "./functions/insert-category",
                    data: new FormData(this),
                    dataType: 'text',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        if (response === 'empty fields') {
                            $('#toast').addClass('active');
                            $('.progress').addClass('active');
                            // $('#toast-icon').removeClass('fa-solid fa-triangle-exclamation').addClass('fa-solid fa-circle-exclamation');
                            $('.text-1').text('Error!');
                            $('.text-2').text('All fields are required!');
                            setTimeout(() => {
                                $('#toast').removeClass("active");
                                $('.progress').removeClass("active");
                            }, 5000);
                        }

                        if (response === 'empty category title') {
                            $('#toast').addClass('active');
                            $('.progress').addClass('active');
                            // $('#toast-icon').removeClass('fa-solid fa-triangle-exclamation').addClass('fa-solid fa-circle-exclamation');
                            $('.text-1').text('Error!');
                            $('.text-2').text('Category title is empty!');
                            setTimeout(() => {
                                $('#toast').removeClass("active");
                                $('.progress').removeClass("active");
                            }, 5000);
                        }

                        if (response === 'empty thumbnail') {
                            $('#toast').addClass('active');
                            $('.progress').addClass('active');
                            // $('#toast-icon').removeClass('fa-solid fa-triangle-exclamation').addClass('fa-solid fa-circle-exclamation');
                            $('.text-1').text('Error!');
                            $('.text-2').text('Category thumbnail is empty!');
                            setTimeout(() => {
                                $('#toast').removeClass("active");
                                $('.progress').removeClass("active");
                            }, 5000);
                        }

                        if (response === 'file not supported') {
                            $('#toast').addClass('active');
                            $('.progress').addClass('active');
                            // $('#toast-icon').removeClass('fa-solid fa-triangle-exclamation').addClass('fa-solid fa-circle-exclamation');
                            $('.text-1').text('Error!');
                            $('.text-2').text('File is not supported!');
                            setTimeout(() => {
                                $('#toast').removeClass("active");
                                $('.progress').removeClass("active");
                            }, 5000);
                        }

                        if (response === 'file too large') {
                            $('#toast').addClass('active');
                            $('.progress').addClass('active');
                            // $('#toast-icon').removeClass('fa-solid fa-triangle-exclamation').addClass('fa-solid fa-circle-exclamation');
                            $('.text-1').text('Error!');
                            $('.text-2').text('File is too large!');
                            setTimeout(() => {
                                $('#toast').removeClass("active");
                                $('.progress').removeClass("active");
                            }, 5000);
                        }

                        if (response === 'title already exist') {
                            $('#toast').addClass('active');
                            $('.progress').addClass('active');
                            // $('#toast-icon').removeClass('fa-solid fa-triangle-exclamation').addClass('fa-solid fa-circle-exclamation');
                            $('.text-1').text('Error!');
                            $('.text-2').text('Category title already exists!');
                            setTimeout(() => {
                                $('#toast').removeClass("active");
                                $('.progress').removeClass("active");
                            }, 5000);
                        }

                        if (response === 'successful') {
                            $('.insert-modal').removeClass("active");
                            $('#toast').addClass('active');
                            $('.progress').addClass('active');
                            $('#toast-icon').removeClass(
                                'fa-solid fa-triangle-exclamation').addClass(
                                'fa-solid fa-check warning');
                            $('.text-1').text('Success!');
                            $('.text-2').text('Category successfully added!!');
                            setTimeout(() => {
                                $('#toast').removeClass("active");
                                $('.progress').removeClass("active");
                            }, 5000);
                            $('#example').DataTable().ajax.reload();
                            $('#file').attr("src", '');
                        }
                    }
                })
            })

            // SUBMIT DELETE
            $("#delete_category").on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "./functions/delete-category",
                    data: new FormData(this),
                    dataType: 'text',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        if (response === 'deleted') {
                            $('.delete-modal').removeClass("active");
                            $('#toast').addClass('active');
                            $('.progress').addClass('active');
                            $('#toast-icon').removeClass(
                                'fa-solid fa-triangle-exclamation').addClass(
                                'fa-solid fa-check warning');
                            $('.text-1').text('Success!');
                            $('.text-2').text('Category deleted successfully!');
                            setTimeout(() => {
                                $('#toast').removeClass("active");
                                $('.progress').removeClass("active");
                            }, 5000);
                            $('#example').DataTable().ajax.reload();
                        }
                    }
                })
            })
        });
        </script>


        <?php include 'bottom.php' ?>

</body>

</html>