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
    <input type="hidden" name="admin_type" id="admin_type" value="<?php echo $admin_type; ?>">
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
        <form id="delete_updates_db">
            <div style="display: none;" class="form-group">
                <span>Category ID</span>
                <input type="text" id="delete_updates" name="delete_updates" value="">
            </div>
            <p>Are you sure, you want to delete this updates?</p>
        </form>
        <hr>
        <div class="bottom">
            <div class="buttons">
                <button id="modalClose" type="button" class="cancel">CLOSE</button>
                <button form="delete_updates_db" id="deleteSubCategory" type="submit" class="save">DELETE</button>
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
        <form enctype="multipart/form-data" id="update-updates">
            <div class="form-group" style="display: none;">
                <span>Updates ID</span>
                <input type="text" style="border-radius: 5px; padding: 0 5px;" name="update_updates_id" id="update_updates_id"></input>
                <span class="error-text" style="color: #ffaf08; font-size: 13px; font-weight: 600;"></span>
            </div>
            <div class="form-group">
                <span>Updates Text</span>
                <textarea style="border-radius: 5px; padding: 0 5px;" name="update_updates_text" id="update_updates_text" cols="20" rows="5"></textarea>
                <span class="error-text" style="color: #ffaf08; font-size: 13px; font-weight: 600;"></span>
            </div>
            <div class="form-group">
                <span>Update Image</span>
                <input type="file" accept=".jpg, .jpeg, .png" class="file" name="update_updates_image"
                    id="update_updates_image">
                <span class="error-image" style="color: #ffaf08; font-size: 13px; font-weight: 600;"></span>
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
                <button form="update-updates" type="submit" id="update_category" name="update_category" class="save">SAVE
                    CHANGES</button>
            </div>
        </div>
    </div>

    <!-- INSERT -->
    <div id="popup-box" class="popup-box insert-modal">
        <div class="top">
            <h3>INSERT UPDATES</h3>
            <div id="modalClose" class="fa-solid fa-xmark"></div>
        </div>
        <hr>
        <form enctype="multipart/form-data" id="insert-updates">
            <div class="form-group">
                <span>Updates Text</span>
                <textarea style="border-radius: 5px; padding: 0 5px;" name="updates_text" id="updates_text" cols="20" rows="5"></textarea>
                <span class="error-text" style="color: #ffaf08; font-size: 13px; font-weight: 600;"></span>
            </div>
            <div class="form-group">
                <span>Update Image</span>
                <input type="file" accept=".jpg, .jpeg, .png" class="file" name="updates_image"
                    id="updates_image">
                <span class="error-image" style="color: #ffaf08; font-size: 13px; font-weight: 600;"></span>
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
                <button form="insert-updates" type="submit" id="insert_updates" name="insert_updates"
                    class="save">INSERT</button>
            </div>
        </div>
    </div>

    <?php include 'top.php';?>

    <!-- MAIN -->
    <main>
        <h1 class="title">View Updates</h1>
        <ul class="breadcrumbs">
            <li><a href="index">Home</a></li>
            <li class="divider">/</li>
            <li><a href="updates" class="active">View Updates</a></li>
        </ul>
        <section class="view-category">
            <button id="getInsert" class="insert_cat" type="button"><i class="fa-solid fa-plus"></i> <span>INSERT
                    UPDATES</span> </button>
            <div class="wrapper">
                <table id="example" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Update ID</th>
                            <th>Update Text</th>
                            <th>Update Image</th>
                            <th>Date Posted</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </section>

        <script>
            if($('#admin_type').val() != 1) {
                $('#getInsert').hide();
                $('.edit-modal').hide();
                $('.delete-modal').hide();
            } else {
                $('#getInsert').show();
                $('.edit-modal').show();
                $('.delete-modal').show();
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
                    url: "./functions/updates-table",
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
                var updates_id = $(this).data('id');
                $.ajax({
                    url: './functions/processing',
                    type: 'POST',
                    data: 'updates_id=' + updates_id,
                    success: function (res) {
                        var obj = JSON.parse(res);
                        $(".edit-modal").addClass("active");
                        $("#update_updates_id").val(obj.updates_id);
                        $("#update_updates_text").val(obj.updates_text);
                        $("#file").attr("src", "../assets/images/" + obj.updates_image);
                        console.log(res);
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
                var updates_id = $(this).data('id');
                $("#delete_updates").val(updates_id);
            });

            // CLOSE MODAL
            $(document).on('click', '#modalClose', function () {
                $('.edit-modal').removeClass("active");
                $('.view-modal').removeClass("active");
                $('.insert-modal').removeClass("active");
                $(".delete-modal").removeClass("active");
                $("#edit-category")[0].reset();
                $("#insert-updates")[0].reset();
                $('#file').attr("src", '');
                $('.error-text').text('');
                $('.error-image').text('');
            })
        </script>

        <script>
            // SUBMIT EDIT
            $(document).ready(function () {
                $("#edit-category").on('submit', function (e) {
                    e.preventDefault();
                })

                // SUBMIT INSERT
                $('#insert-updates').on('submit', function (e) {
                    e.preventDefault();
                    console.log('test');
                    
                    if($('#updates_text').val() == '') {
                        $('.error-text').text('Input updates text!');
                    } else {
                        $('.error-text').text('');
                    }

                    if($.trim($('#updates_image').val()).length == 0) {
                        $('.error-image').text('Upload image!');
                    } else {
                        var imgExt = $('#updates_image').val().split('.').pop().toLowerCase();

                        if ($.inArray(imgExt, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                        $('.error-image').text('File not supported');
                        } else {
                            var imgSize = $('#updates_image')[0].files[0].size;

                            if (imgSize > 10485760) {
                                $('.error-image').text('File too large');
                            } else {
                                $('.error-image').text('');
                            }
                        }
                    }

                    if($('.error-text').text() != '' && $('.error-image').text() != '') {
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
                            url: "./functions/insert-updates",
                            type: "POST",
                            data: new FormData(this),
                            dataType: 'text',
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function(data) {
                                if(data == 'success') {
                                    $('.insert-modal').removeClass("active");
                                    $('#toast').addClass('active');
                                    $('.progress').addClass('active');
                                    $('#toast-icon').removeClass(
                                        'fa-solid fa-triangle-exclamation').addClass(
                                        'fa-solid fa-check warning');
                                    $('.text-1').text('Success!');
                                    $('.text-2').text('Add updates successfully!');
                                    setTimeout(() => {
                                        $('#toast').removeClass("active");
                                        $('.progress').removeClass("active");
                                    }, 5000);
                                    $('#example').DataTable().ajax.reload();
                                    $('#insert-updates')[0].reset();
                                }
                            }
                        })
                    }
                })

                // SUBMIT DELETE
                $("#delete_updates_db").on('submit', function (e) {
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "./functions/delete-updates",
                        data: new FormData(this),
                        dataType: 'text',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (response) {
                            if (response === 'success') {
                                $('.delete-modal').removeClass("active");
                                $('#toast').addClass('active');
                                $('.progress').addClass('active');
                                $('#toast-icon').removeClass(
                                    'fa-solid fa-triangle-exclamation').addClass(
                                    'fa-solid fa-check warning');
                                $('.text-1').text('Success!');
                                $('.text-2').text('Update deleted successfully!');
                                setTimeout(() => {
                                    $('#toast').removeClass("active");
                                    $('.progress').removeClass("active");
                                }, 5000);
                                $('#example').DataTable().ajax.reload();
                                $('#delete_updates_db')[0].reset();
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