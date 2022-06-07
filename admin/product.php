<?php
session_start();
if (!isset($_SESSION['adminloggedin']) && $_SESSION['adminloggedin'] == false) {
    header("Location: ./login");
}
require_once '../includes/database_conn.php';
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
            font-weight: 900;
            text-transform: uppercase;
        }

        .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody {
            overflow-x: scroll !important;
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
            <h3>Delete Product</h3>
            <div id="modalClose" class="fa-solid fa-xmark"></div>
        </div>
        <hr>
        <form id="delete_product">
            <div style="display: none;" class="form-group">
                <span>Category ID</span>
                <input type="text" id="delete_product_id" name="delete_product_id" value="">
            </div>
            <p>Are you sure, you want to delete this product?</p>
        </form>
        <hr>
        <div class="bottom">
            <div class="buttons">
                <button id="modalClose" type="button" class="cancel">CLOSE</button>
                <button form="delete_product" id="deleteProduct" type="submit" class="save">DELETE</button>
            </div>

        </div>
    </div>

    <?php include 'top.php'; ?>

    <!-- MAIN -->
    <main>
        <h1 class="title">View Product</h1>
        <ul class="breadcrumbs">
            <li><a href="index">Home</a></li>
            <li class="divider">/</li>
            <li><a href="product" class="active">View Product</a></li>
        </ul>
        <section class="view-category">
            <button onclick="location.href = 'insert-simple-product';" id="getInsert" class="insert_cat"
                type="button"><i class="fa-solid fa-plus"></i> <span>INSERT SIMPLE PRODUCT</span> </button>
            <button onclick="location.href = 'insert-variable-product';" id="getInsert" class="insert_cat"
                type="button"><i class="fa-solid fa-plus"></i> <span>INSERT VARIABLE PRODUCT</span> </button>
            <div class="wrapper">
                <table id="example" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Product Image</th>
                            <th>Category</th>
                            <th>Subcategory</th>
                            <th>Product</th>
                            <th>URL</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </section>


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
                    url: "./functions/product-table",
                    type: "post"
                }
            });
        </script>

        <script>
            //  GET VIEW
            $(document).on('click', '#getView', function (e) {
                e.preventDefault();
                var category_id_view = $(this).data('id');
                $.ajax({
                    url: './functions/processing',
                    type: 'POST',
                    data: 'category_id_view=' + category_id_view,
                    success: function (res) {
                        var obj = JSON.parse(res);
                        $(".view-modal").addClass("active");
                        $("#category_title_view").text(obj.category_title);
                        $("#category_thumbnail_view").attr("src", "../assets/images/" + obj
                            .category_thumbnail);
                    }
                })
            });

            // GET EDIT
            $(document).on('click', '#getEdit', function (e) {
                e.preventDefault();
                var product_id = $(this).data('id');
                $.ajax({
                    url: './functions/processing',
                    type: 'POST',
                    data: 'product_id=' + product_id,
                    success: function (res) {
                        location.href = res;
                    }
                })
            });

            // GET DELETE
            $(document).on('click', '#getDelete', function (e) {
                e.preventDefault();
                $('.delete-modal').addClass('active');
                var product_id = $(this).data('id');
                $("#delete_product_id").val(product_id);
            });

            $(document).on('click', '#modalClose', function() {
                $('.edit-modal').removeClass("active");
                $('.view-modal').removeClass("active");
                $('.insert-modal').removeClass("active");
                $(".delete-modal").removeClass("active");
                $("#edit-category")[0].reset();
                $("#insert-category")[0].reset();
            })

            // SUBMIT DELETE
            $("#delete_product").on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "./functions/delete-product",
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
                                $('#toast-icon').removeClass('fa-solid fa-triangle-exclamation').addClass('fa-solid fa-check warning');
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
        </script>


        <?php include 'bottom.php' ?>

</body>

</html>