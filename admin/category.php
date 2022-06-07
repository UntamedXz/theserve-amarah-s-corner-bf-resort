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
            <h3>Delete Category</h3>
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

    <!-- UPDATE -->
    <div id="popup-box" class="popup-box edit-modal">
        <div class="top">
            <h3>Edit Category</h3>
            <div id="modalClose" class="fa-solid fa-xmark"></div>
        </div>
        <hr>
        <form enctype="multipart/form-data" id="edit-category">
            <div style="display: none;" class="form-group">
                <span>Category ID</span>
                <input type="text" id="update_category_id" name="update_category_id" value="">
            </div>
            <div class="form-group">
                <span>Category Title</span>
                <input type="text" id="update_category_title" name="update_category_title" value="">
            </div>
            <div class="form-group">
                <span>Select Category Image</span>
                <input type="file" accept=".jpg, .jpeg, .png" class="file" name="update_category_thumbnail"
                    id="update_category_thumbnail">
            </div>
            <div class="form-group">
                <span>Image Preview</span>
                <img id="file" style="width: 200px;" src="">
            </div>
        </form>
        <hr>
        <div class="bottom">
            <div class="buttons">
                <button id="modalClose" type="button" class="cancel">CANCEL</button>
                <button form="edit-category" type="submit" id="update_category" name="update_category" class="save">SAVE
                    CHANGES</button>
            </div>
        </div>
    </div>

    <!-- INSERT -->
    <div id="popup-box" class="popup-box insert-modal">
        <div class="top">
            <h3>INSERT Category</h3>
            <div id="modalClose" class="fa-solid fa-xmark"></div>
        </div>
        <hr>
        <form enctype="multipart/form-data" id="insert-category">
            <div class="form-group">
                <span>Category Title</span>
                <input type="text" id="insert_category_title" name="insert_category_title" value="">
            </div>
            <div class="form-group">
                <span>Select Category Image</span>
                <input type="file" accept=".jpg, .jpeg, .png" class="file" name="insert_category_thumbnail"
                    id="insert_category_thumbnail">
            </div>
            <div class="form-group">
                <span>Image Preview</span>
                <img id="insertFile" style="width: 100px;" src="">
            </div>
        </form>
        <hr>
        <div class="bottom">
            <div class="buttons">
                <button id="modalClose" type="button" class="cancel">CANCEL</button>
                <button form="insert-category" type="submit" id="insert_category_btn" name="insert_category_btn"
                    class="save">INSERT</button>
            </div>
        </div>
    </div>

    <?php include 'top.php';?>

    <!-- MAIN -->
    <main>
        <h1 class="title">View Category</h1>
        <ul class="breadcrumbs">
            <li><a href="index">Home</a></li>
            <li class="divider">/</li>
            <li><a href="view-category" class="active">View Category</a></li>
        </ul>
        <section class="view-category">
            <button id="getInsert" class="insert_cat" type="button"><i class="fa-solid fa-plus"></i> <span>INSERT
                    CATEGORY</span> </button>
            <div class="wrapper">
                <table id="example" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Category Title</th>
                            <th>Category Thumbnail</th>
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
                    url: "./functions/category-table",
                    type: "post"
                }
            });
        </script>

        <!-- IMAGE PREVIEW -->
        <script>
            $('#update_category_thumbnail').on('change', function () {
                var file = this.files[0];

                if (file) {
                    var reader = new FileReader();

                    reader.addEventListener('load', function () {
                        $('#file').attr("src", this.result);
                    })

                    reader.readAsDataURL(file);
                }
            })

            $('#insert_category_thumbnail').on('change', function () {
                var file = this.files[0];

                if (file) {
                    var reader = new FileReader();

                    reader.addEventListener('load', function () {
                        $('#insertFile').attr("src", this.result);
                    })

                    reader.readAsDataURL(file);
                }
            })
        </script>

        <script>
            // GET EDIT
            $(document).on('click', '#getEdit', function (e) {
                e.preventDefault();
                var category_id_edit = $(this).data('id');
                $.ajax({
                    url: './functions/processing',
                    type: 'POST',
                    data: 'category_id_edit=' + category_id_edit,
                    success: function (res) {
                        var obj = JSON.parse(res);
                        $(".edit-modal").addClass("active");
                        $("#update_category_id").val(obj.category_id);
                        $("#update_category_title").val(obj.category_title);
                        $("#file").attr("src", "../assets/images/" + obj.category_thumbnail);
                    }
                })
            });

            // GET INSERT
            $(document).on('click', '#getInsert', function (e) {
                e.preventDefault();
                $('.insert-modal').addClass('active');
            });

            // GET DELETE
            $(document).on('click', '#getDelete', function (e) {
                e.preventDefault();
                $('.delete-modal').addClass('active');
                var category_id_edit = $(this).data('id');
                $("#delete_category_id").val(category_id_edit);
            });

            // CLOSE MODAL
            $(document).on('click', '#modalClose', function () {
                $('.edit-modal').removeClass("active");
                $('.view-modal').removeClass("active");
                $('.insert-modal').removeClass("active");
                $(".delete-modal").removeClass("active");
                $("#edit-category")[0].reset();
                $("#insert-category")[0].reset();
                $('#file').attr("src", '');
            })
        </script>

        <script>
            // SUBMIT EDIT
            $(document).ready(function () {
                $("#edit-category").on('submit', function (e) {
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "./functions/update-category",
                        data: new FormData(this),
                        dataType: 'text',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (response) {
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
                            } else if (response === 'category title already exist') {
                                $('#toast').addClass('active');
                                $('.progress').addClass('active');
                                $('.text-1').text('Error!');
                                $('.text-2').text('Category title already exist!');
                                setTimeout(() => {
                                    $('#toast').removeClass("active");
                                    $('.progress').removeClass("active");
                                }, 5000);
                            } else if (response === 'title updated') {
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
                                $("#edit-category")[0].reset();
                                $("#insert-category")[0].reset();
                                $('#file').attr("src", '');
                            } else if (response === 'invalid file') {
                                $('#toast').addClass('active');
                                $('.progress').addClass('active');
                                $('.text-1').text('Error!');
                                $('.text-2').text('File not supported!');
                                setTimeout(() => {
                                    $('#toast').removeClass("active");
                                    $('.progress').removeClass("active");
                                }, 5000);
                                $('#example').DataTable().ajax.reload();
                            } else if (response === 'invalid file') {
                                $('#toast').addClass('active');
                                $('.progress').addClass('active');
                                $('.text-1').text('Error!');
                                $('.text-2').text('File is too large!');
                                setTimeout(() => {
                                    $('#toast').removeClass("active");
                                    $('.progress').removeClass("active");
                                }, 5000);
                                $('#example').DataTable().ajax.reload();
                            } else if (response === 'updated successfully') {
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
                                $("#edit-category")[0].reset();
                                $("#insert-category")[0].reset();
                                $('#file').attr("src", '');
                            } else {
                                $('#toast').addClass('active');
                                $('.progress').addClass('active');
                                $('.text-1').text('Error!');
                                $('.text-2').text(response);
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
                $('#insert-category').on('submit', function (e) {
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "./functions/insert-category",
                        data: new FormData(this),
                        dataType: 'text',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (response) {
                            if (response === 'empty fields') {
                                $('#toast').addClass('active');
                                $('.progress').addClass('active');
                                $('.text-1').text('Error!');
                                $('.text-2').text('All fields are required!');
                                setTimeout(() => {
                                    $('#toast').removeClass("active");
                                    $('.progress').removeClass("active");
                                }, 5000);
                            } else if (response === 'empty category title') {
                                $('#toast').addClass('active');
                                $('.progress').addClass('active');
                                $('.text-1').text('Error!');
                                $('.text-2').text('Category title is empty!');
                                setTimeout(() => {
                                    $('#toast').removeClass("active");
                                    $('.progress').removeClass("active");
                                }, 5000);
                            } else if (response === 'empty thumbnail') {
                                $('#toast').addClass('active');
                                $('.progress').addClass('active');
                                $('.text-1').text('Error!');
                                $('.text-2').text('Category thumbnail is empty!');
                                setTimeout(() => {
                                    $('#toast').removeClass("active");
                                    $('.progress').removeClass("active");
                                }, 5000);
                            } else if (response === 'file not supported') {
                                $('#toast').addClass('active');
                                $('.progress').addClass('active');
                                $('.text-1').text('Error!');
                                $('.text-2').text('File is not supported!');
                                setTimeout(() => {
                                    $('#toast').removeClass("active");
                                    $('.progress').removeClass("active");
                                }, 5000);
                            } else if (response === 'file too large') {
                                $('#toast').addClass('active');
                                $('.progress').addClass('active');
                                $('.text-1').text('Error!');
                                $('.text-2').text('File is too large!');
                                setTimeout(() => {
                                    $('#toast').removeClass("active");
                                    $('.progress').removeClass("active");
                                }, 5000);
                            } else if (response === 'title already exist') {
                                $('#toast').addClass('active');
                                $('.progress').addClass('active');
                                $('.text-1').text('Error!');
                                $('.text-2').text('Category title already exists!');
                                setTimeout(() => {
                                    $('#toast').removeClass("active");
                                    $('.progress').removeClass("active");
                                }, 5000);
                            } else if (response === 'successful') {
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
                                $("#edit-category")[0].reset();
                                $("#insert-category")[0].reset();
                                $('#file').attr("src", '');
                            } else {
                                $('#toast').addClass('active');
                                $('.progress').addClass('active');
                                $('.text-1').text('Error!');
                                $('.text-2').text(response);
                                setTimeout(() => {
                                    $('#toast').removeClass("active");
                                    $('.progress').removeClass("active");
                                }, 5000);
                                $('#example').DataTable().ajax.reload();
                            }
                        }
                    })
                })

                // SUBMIT DELETE
                $("#delete_category").on('submit', function (e) {
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "./functions/delete-category",
                        data: new FormData(this),
                        dataType: 'text',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (response) {
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
                            } else {
                                $('#toast').addClass('active');
                                $('.progress').addClass('active');
                                $('.text-1').text('Error!');
                                $('.text-2').text(response);
                                setTimeout(() => {
                                    $('#toast').removeClass("active");
                                    $('.progress').removeClass("active");
                                }, 5000);
                            }
                        }
                    })
                })
            });
        </script>


        <?php include 'bottom.php'?>

</body>

</html>