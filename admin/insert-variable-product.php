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

if (isset($_SESSION['alert'])) {
    $product_id = $_SESSION['product_id'];
    $alert = $_SESSION['alert'];
} else {
    $alert = '';
    $product_id = '0';
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

    <?php include 'top.php';?>

    <!-- MAIN -->
    <main>
        <h1 class="title">Insert Variable Product</h1>
        <ul class="breadcrumbs">
            <li><a href="index">Home</a></li>
            <li class="divider">/</li>
            <li><a href="product">View Product</a></li>
            <li class="divider">/</li>
            <li><a href="insert-variable-product" class="active">Insert Variable Product</a></li>
        </ul>
        <section class="insert-product">
            <div class="insert-product-wrapper">
                <div class="form_container_variable">
                    <span class="product_tab">Product Tab</span>
                    <div class="tabs">
                        <button id="details_btn">PRODUCT DETAILS</button>
                        <button id="variant_btn">PRODUCT VARIANT</button>
                        <button id="variations_btn">PRODUCT VARIATIONS</button>
                    </div>

                    <!-- DETAILS TAB -->
                    <form id="details_tab" style="display: none;">
                        <div class="form_group">
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
                        <div class="form_group subcategory-group" id="row_<?php echo $count; ?>">
                            <span>Product Subcategory</span>
                            <select name="subcategory-list" id="subcategory-list">
                                <option selected="selected" value="SELECT SUBCATEGORY">SELECT SUBCATEGORY</option>
                            </select>
                            <span class="error error-subcategory"></span>
                        </div>
                        <div class="form_group">
                            <span>Product Title</span>
                            <input type="text" name="product_title" id="product_title">
                            <span class="error error-title"></span>
                        </div>
                        <div class="form_group">
                            <span>Product Url</span>
                            <input type="text" name="product_url" id="product_url" readonly>
                            <span class="error error-url"></span>
                        </div>
                        <div class="form_group">
                            <span>Product Description</span>
                            <textarea name="product_desc" id="simpleProduct-desc" cols="20" rows="5"></textarea>
                            <span class="error error-desc"></span>
                        </div>
                        <div class="form_group">
                            <span>Product Regular Price</span>
                            <input type="text" name="product_price" id="product_price">
                            <span class="error error-price"></span>
                        </div>
                        <div class="form_group">
                            <span>Product Sale Price</span>
                            <input type="text" name="product_salePrice" id="product_sale">
                            <span class="error error-sale"></span>
                        </div>
                        <div class="form_group">
                            <span>Product Image 1</span>
                            <input type="file" accept=".jpg, .jpeg, .png" name="product_image1" id="productimage1">
                            <span class="error error-image"></span>
                        </div>
                        <div class="form_group">
                            <span>Image Preview</span>
                            <img id="file" style="width: 100px;" src="">
                        </div>
                        <div class="form_group">
                            <span>Product Keyword</span>
                            <input type="text" name="product_keyword" id="product_keyword">
                            <span class="error error-keyword"></span>
                        </div>
                        <button type="submit" id="details_insert">NEXT</button>
                    </form>

                    <!-- VARIANT TAB -->
                    <form id="variant_tab" style="display: flex;">
                        <input type="hidden" name="product_id" id="" value="<?php echo $product_id; ?>">
                        <h5>*Ignore if product don't have variations</h5>
                        <div class="variant_group">
                            <select name="variant_list" id="variant_list">
                                <option value="">SELECT VARIANT</option>
                                <?php
                                $get_variant = mysqli_query($conn, "SELECT * FROM product_variant");

                                foreach ($get_variant as $variant_row) {
                                ?>
                                <option value="<?php echo $variant_row['variant_id'] ?>">
                                    <?php echo $variant_row['variant_title'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <button id="add_variant">ADD</button>
                        </div>
                        <div class="table">
                            <input type="hidden" name="product_slug" id="product_slug">

                            <table id="variant_attribute" style="width: 100%;">
                            </table>

                        </div>
                        <button id="submit_variant">NEXT</button>
                    </form>

                    <!-- VARIATIONS TAB -->
                    <form id="variations_tab" style="display: none;">
                        <input type="hidden" name="product_id" id="" value="<?php echo $product_id; ?>">
                        <div class="form_group">
                            <span>Attributes</span>

                            <div class="select-wrapper">
                                <?php
                                $get_variant_product = mysqli_query($conn, "SELECT product_variant.variant_title, product_variant.variant_id FROM product_variant INNER JOIN product_attribute ON product_variant.variant_id = product_attribute.variant_id WHERE product_id = 193 GROUP BY product_variant.variant_title");

                                foreach ($get_variant_product as $product_variant) {
                                $variant_id = $product_variant['variant_id'];
                                ?>
                                <select name="attribute[]" class="attribute" id="attribute"
                                    onchange="getSelectedItems()" required>
                                    <option value=""><?php echo $product_variant['variant_title']; ?></option>
                                    <?php
                                    $get_product_attribute = mysqli_query($conn, "SELECT * FROM product_attribute WHERE product_id = 193 AND variant_id = $variant_id");

                                    foreach ($get_product_attribute as $product_attribute) {
                                    ?>
                                    <option value="<?php echo $product_attribute['attribute_id']; ?>">
                                        <?php echo $product_attribute['attribute_title']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <?php
                                }
                                ?>
                                <button id="add_variations">ADD</button>
                            </div>
                        </div>

                        <table id="variations_table">
                            <tr>
                                <td>
                                    <div class="form_group">
                                        <span>Variations</span>
                                        <input type="text" name="variations" id="variations">
                                    </div>
                                    <div class="group_form_group_2">
                                        <div class="form_group price">
                                            <span>Additional Price</span>
                                            <input type="text" name="" id="">
                                        </div>
                                        <div class="form_group select">
                                            <span>In Stock</span>
                                            <select name="" id="">
                                                <option value="">SELECT STATUS</option>
                                                <option value="YES">YES</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <input type="text" name="combi" id="showValue">
                    </form>
                </div>
            </div>
        </section>

        <?php
if ($alert == 'success') {
    echo '
    <script>
        $("#details_btn").css("background-color", "#070506");
        $("#details_btn").css("color", "#ffaf08");
        $("#variant_btn").css("background-color", "#ffaf08");
        $("#variant_btn").css("color", "#070506");
        $("#details_tab").css("display", "none");
        $("#variant_tab").css("display", "flex");
        $("#variations_tab").css("display", "none");
        $("#product_slug").val($("#product_url").val());
    </script>
    ';
    unset($_SESSION['alert']);
} else if ($alert == 'success_variant') {
    echo '
    <script>
        $("#details_btn").css("background-color", "#070506");
        $("#details_btn").css("color", "#ffaf08");
        $("#variant_btn").css("background-color", "#070506");
        $("#variant_btn").css("color", "#ffaf08");
        $("#variations_btn").css("background-color", "#ffaf08");
        $("#variations_btn").css("color", "#070506");
        $("#details_tab").css("display", "none");
        $("#variant_tab").css("display", "none");
        $("#variations_tab").css("display", "flex");
    </script>
    ';
    unset($_SESSION['alert']);
}
?>

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

            var dataTables = $('#attrTbl').DataTable({
                "processing": true,
                "serverSide": true,
                "pagingType": "simple",
                "scrollX": true,
                "sScrollXInner": "100%",
                "paging": false,
                "ordering": false,
                "info": false,
                scrollY: "165px",
                "ajax": {
                    url: "./functions/product-attributes-table",
                    type: "post"
                }
            });
        </script>

        <script>
            // CATEGORY | SUBCATEGORY AJAX
            $(document).ready(function () {
                $("#category-list").change(function () {
                    var category_id = $(this).val();
                    $.ajax({
                        url: "./functions/get-subcategory",
                        type: "POST",
                        data: {
                            category_id: category_id
                        },
                        success: function (data) {
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

            $('#product_title').keyup(function () {
                var str = $(this).val();
                var trims = $.trim(str)
                var slug = trims.replace(/[^a-z0-9]/gi, '-').replace(/-+/g, '-').replace(/^|-$/g, '')
                $('#product_url').val(slug.toLowerCase());
                $('#product_keyword').val(str);
            })

            // $('#details_tab').on('submit', function(e) {
            //     e.preventDefault();

            //     if ($('#category-list').val() == 'SELECT CATEGORY') {
            //         $('.error-category').text('Category required');
            //     } else {
            //         $('.error-category').text('');
            //     }

            //     if ($('.subcategory-group').css('display') == 'none') {
            //             $('#subcategory-list').val('SELECT SUBCATEGORY')
            //             $('.error-subcategory').text('');
            //         } else {
            //             if ($('#subcategory-list').val() == 'SELECT SUBCATEGORY' || $('#subcategory-list').val() == '' || $('#subcategory-list').val() == 'none') {
            //                 $('.error-subcategory').text('Subcategory required');
            //             } else {
            //                 $('.error-subcategory').text('');
            //             }
            //         }
            //     if ($.trim($('#product_title').val()).length == 0) {
            //         $('.error-title').text('Product Title required');
            //     } else {
            //         $('.error-title').text('');
            //     }
            //     if ($.trim($('#product_url').val()).length == 0) {
            //         $('.error-url').text('Product URL required');
            //     } else {
            //         $('.error-url').text('');
            //     }
            //     if ($.trim($('#simpleProduct-desc').val()).length == 0) {
            //             $('.error-desc').text('');
            //         } else {
            //             $('.error-desc').text('');
            //         }
            //     if ($.trim($('#product_price').val()).length == 0) {
            //         $('.error-price').text('Product Price required');
            //     } else {
            //         $('.error-price').text('');
            //     }
            //     if ($.trim($('#product_image1').val()).length == 0) {
            //         $('.error-image').text('');
            //     } else {
            //         var imgExt = $('#product_image1').val().split('.').pop().toLowerCase();

            //         if ($.inArray(imgExt, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
            //             $('.error-image').text('File not supported');
            //         } else {
            //             var imgSize = $('#product_image1')[0].files[0].size;

            //             if (imgSize > 10485760) {
            //                 $('.error-image').text('File too large');
            //             } else {
            //                 $('.error-image').text('');
            //             }
            //         }
            //     }
            //     if ($.trim($('#product_keyword').val()).length == 0) {
            //         $('.error-keyword').text('Product Keyword required');
            //     } else {
            //         $('.error-keyword').text('');
            //     }
            //     if ($('.error-category').text() != '' || $('.error-subcategory').text() != '' || $('.error-title')
            //         .text() != '' || $('.error-url').text() != '' || $('.error-price').text() != '' || $(
            //             '.error-price').text() != '' || $('.error-salePrice').text() != '' || $('.error-image')
            //         .text() != '' || $('.error-keyword').text() != '') {
            //         $('#toast').addClass('active');
            //         $('.progress').addClass('active');
            //         $('.text-1').text('Error!');
            //         $('.text-2').text('Fill all required fields!');
            //         setTimeout(() => {
            //             $('#toast').removeClass("active");
            //             $('.progress').removeClass("active");
            //         }, 5000);
            //     } else {
            //         $.ajax({
            //             url: "./functions/insert-variable-product-process",
            //             type: "POST",
            //             data: new FormData(this),
            //             dataType: 'text',
            //             contentType: false,
            //             cache: false,
            //             processData: false,
            //             success: function(data) {
            //                 if (data == 'success') {
            //                     location.reload();
            //                 } else if (data == 'failed') {
            //                     $('#toast').addClass('active');
            //                     $('.progress').addClass('active');
            //                     $('.text-1').text('Error!');
            //                     $('.text-2').text('Something went wrong!');
            //                     setTimeout(() => {
            //                         $('#toast').removeClass("active");
            //                         $('.progress').removeClass("active");
            //                     }, 5000);
            //                     $('#example').DataTable().ajax.reload();
            //                 } else if (data == 'product already exist') {
            //                     $('#toast').addClass('active');
            //                     $('.progress').addClass('active');
            //                     $('.text-1').text('Error!');
            //                     $('.text-2').text('Product already exist!');
            //                     setTimeout(() => {
            //                         $('#toast').removeClass("active");
            //                         $('.progress').removeClass("active");
            //                     }, 5000);
            //                 } else {
            //                     $('#toast').addClass('active');
            //                     $('.progress').addClass('active');
            //                     $('.text-1').text('Error!');
            //                     $('.text-2').text(data);
            //                     setTimeout(() => {
            //                         $('#toast').removeClass("active");
            //                         $('.progress').removeClass("active");
            //                     }, 5000);
            //                 }
            //             }
            //         })
            //     }
            // });

            // TAB
            $('#details_insert').on('click', function (e) {
                e.preventDefault();
                $('#details_btn').css("background-color", "#070506");
                $('#details_btn').css("color", "#ffaf08");
                $('#variant_btn').css("background-color", "#ffaf08");
                $('#variant_btn').css("color", "#070506");
                $('#details_tab').css("display", "none");
                $('#variant_tab').css("display", "flex");
            })

            $('#variant_list').change(function () {
                var value = $(this).val();

                if (value === '') return;
                var theDiv = $("is" + value);

                var option = $("option[value='" + value + "']", this);
                option.attr("disabled", "disabled");

                theDiv.slideDown().removeClass("hidden");
                theDiv.find('a').data("option", option);
            })

            // ADDING ATTRIBUTES
            var count = 0;

            $('#add_variant').on('click', function (e) {
                e.preventDefault();
                var selected_variant_id = $('#variant_list').find(":selected").val();
                var selected_variant = $('#variant_list').find(":selected").text();

                if (selected_variant_id === '') return;
                var theDiv = $("is" + selected_variant_id);

                var option = $("option[value='" + selected_variant_id + "']", this);
                option.attr("disabled", "disabled");

                theDiv.slideDown().removeClass("hidden");
                theDiv.find('a').data("option", option);

                console.error('shet')

                var trim = $.trim(selected_variant);

                count = count + 1;

                output = '<tr id="row_' + count + '">';
                output += '<td> <div class="group_form_group">';
                output +=
                    '<div class="form_group left"> <span>Variant: </span> <input type="text" name="variant_name" id="variant_name" value="' +
                    trim + '"> <input type="text" class="variant_id" name="variant_id[]" value="' + selected_variant_id +
                    '"> </div>';
                output +=
                    '<div class="form_group center"> <span>Attributes: </span> <input type="text" name="attributes[]" id="attributes" placeholder="Input attributes separated by comma" value=""> </div>';

                output +=
                    '<div class="form_group right"> <button id="' + count +
                    '" class="remove_variant" data-id="' + selected_variant_id +
                    '"><i class="fa-solid fa-trash"></i></button> </div>';

                output += '</div>';

                output += '</td>';
                output += '</tr>';

                $('#variant_attribute').append(output);

            })

            $(document).on('click', '.remove_variant', function () {
                var row_id = $(this).attr("id");
                var variant_id = $(this).data("id");
                $("#variant_list option[value=" + variant_id + "]").removeAttr('disabled');
                $('#row_' + row_id + '').remove();
            })

            $('#variant_tab').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "./functions/variant-attributes",
                    dataType: 'text',
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: new FormData(this),
                    success: function (response) {
                        if (response == 'success') {
                            location.reload();
                        } else {
                            alert(response);
                        }
                    }
                })
            })

            // ADDING VARIATIONS
            function getSelectedItems() {
                var elements = document.getElementsByClassName('attribute');

                var results = [];

                for (var i = 0; i < elements.length; i++) {
                    var element = elements[i];
                    var strSel = element.options[element.selectedIndex].value;
                    results.push(strSel);
                }
                var newArr = results.join(',').replace(/,/g, '/').split();
                document.getElementById("showValue").value = newArr;
            }

            var countV = 0;

            $('#add_variations').on('click', function (e) {
                e.preventDefault();
                if ($('#showValue').val() == ',' || $('#showValue').val() == '') {
                    alert('bawal yan');
                }
            })
        </script>

        <?php include 'bottom.php'?>

</body>

</html>