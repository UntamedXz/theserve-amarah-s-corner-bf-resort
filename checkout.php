<?php
session_start();
require_once './includes/database_conn.php';
if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location: ./login");
}

$user_id = $_SESSION['id'];

$getAccountInfo = mysqli_query($conn, "SELECT * FROM customers WHERE user_id = '$user_id'");

while ($row = mysqli_fetch_array($getAccountInfo)) {
    $userId = $row['user_id'];
    $userProfileIcon = $row['user_profile_image'];
}

if(isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];

    $getUserId = mysqli_query($conn, "SELECT * FROM customers WHERE user_id = $user_id");
    $row = mysqli_fetch_array($getUserId);
    $userId = $row['user_id'];
    $userProfileIcon = $row['user_profile_image'];

    $getCartCount = mysqli_query($conn, "SELECT SUM(product_qty) FROM cart WHERE user_id = $userId");
    $rowCount = mysqli_fetch_array($getCartCount);
    $cartCount = $rowCount['SUM(product_qty)'];
} else {
    $cartCount = '0';
}

if($cartCount < 1) {
    header("location: index");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/backup.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>

</head>


<script>
    $(document).ready(function () {
        $('#table_id').dataTable({
            responsive: true,
            scrollX: true,
        });
    });
</script>
</script>


<title>Amarah's Corner - BF Resort Las Piñas</title>

<style>
    body {
        background: url(./assets/images/background.png) no-repeat;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        height: 100%;
    }
</style>
</head>

<body>
    <div id="preloader"></div>

    <?php include './includes/navbar.php';?>
    <input type="hidden" name="" id="cartCount" value="<?php echo $cartCount; ?>">

    <input type="hidden" id="profileIconCheck" value="<?php echo $userProfileIcon; ?>">

    <script>
        $(window).on('load', function () {
            if ($('#profileIconCheck').val() == '') {
                $('#profileIcon').attr("src", "./assets/images/no_profile_pic.png");
            } else {
                $('#profileIcon').attr("src", "./assets/images/" + $('#profileIconCheck').val());
            }
        })
    </script>

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

    <section class="checkout">
        <div class="checkout_wrapper">
            <div class="left_checkout_wrapper">
                <form action="" id="checkout_form">
                    <h1>Checkout</h1>
                    <?php
$get_info = mysqli_query($conn, "SELECT * FROM customers WHERE user_id = $user_id");

foreach ($get_info as $info) {
    ?>
                    <span>Personal Information</span>
                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
                    <div class="group_form_group">
                        <div class="form_group left">
                            <span>Billing Fullname</span>
                            <input class="default" type="text" name="billing_name" id="fullname"
                                value="<?php echo $info['name'] ?>">
                            <span class="error-fullname" style="color: #dc3545;"></span>
                        </div>
                        <div class="form_group right">
                            <span>Phone Number</span>
                            <input class="default" type="tel" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="11" name="billing_phone" id="phone_number"
                                value="<?php echo $info['phone_number'] ?>">
                            <span class="error-phone_number" style="color: #dc3545;"></span>
                        </div>
                    </div>
                    <div class="form_group">
                        <span>Email Address</span>
                        <input class="default" type="text" name="billing_email" id="email" readonly
                            value="<?php echo $info['email'] ?>">
                        <span class="error-email_address" style="color: #dc3545;"></span>
                    </div>
                    <?php
}
?>
                    <span class="click_here"><a href="account">Click here</a> to update personal information</span>
                    <div class="group_form_group">
                        <div class="form_group">
                            <span>Block No., Bldg. & St. Name</span>
                            <input type="text" name="address" id="block">
                            <span class="error-block" style="color: #dc3545;"></span>
                        </div>
                        <div class="form_group">
                            <span>Province</span>
                            <input type="text" name="province" id="province">
                            <span class="error-province" style="color: #dc3545;"></span>
                        </div>
                    </div>
                    <div class="group_form_group">
                        <div class="form_group">
                            <span>City/Municipality</span>
                            <input type="text" name="city" id="city">
                            <span class="error-city" style="color: #dc3545;"></span>
                        </div>
                        <div class="form_group">
                            <span>Barangay</span>
                            <input type="text" name="barangay" id="barangay">
                            <span class="error-barangay" style="color: #dc3545;"></span>
                        </div>
                    </div>

                    <div class="payment-wrapper">
                        <span>Mode of Payment</span>
                        <div class="option_wrapper">
                            <input type="radio" value="1" name="payment" class="payment" id="option-1" checked>
                            <input type="radio" value="2" name="payment" class="payment" id="option-2">
                            <label for="option-1" class="option option-1">
                                <div class="box"></div>
                                <span>Cash on Delivery</span>
                            </label>
                            <label for="option-2" class="option option-2">
                                <div class="box"></div>
                                <span>Gcash</span>
                            </label>
                        </div>
                    </div>

                    <div class="gcash_payment">
                        <div class="img-container">
                            <img src="./assets/images/gcashqr.png" alt="">
                        </div>
                        <div class="content">
                            <div class="form_group">
                                <span>Screenshot of Payment:</span>
                                <input type="file" name="screenshot" accept=".jpg, .jpeg, .png" id="screenshot">
                                <span class="error-screenshot" style="color: #dc3545;"></span>
                            </div>
                            <div class="form_group">
                                <span>Reference No:</span>
                                <input type="text" name="reference" id="reference">
                                <span class="error-reference" style="color: #dc3545;"></span>
                            </div>
                        </div>
                    </div>

                    <div class="payment-wrapper">
                        <span>Mode of Delivery</span>
                        <div class="option_wrapper">
                            <input type="radio" name="deliver" value="1" class="deliver" id="option-1-d" checked>
                            <input type="radio" name="deliver" value="2" class="deliver"
                                id="option-2-d">
                            <input type="radio" name="deliver" value="3" class="deliver"
                                id="option-3-d">
                            <label for="option-1-d" class="option option-1">
                                <div class="box"></div>
                                <span>Pick Up</span>
                            </label>
                            <label for="option-2-d" class="option option-2">
                                <div class="box"></div>
                                <span>Delivery via Lalamove</span>
                            </label>
                            <label for="option-3-d" class="option option-3">
                                <div class="box"></div>
                                <span>Delivery within BF</span>
                            </label>
                        </div>
                        <span class="error-deliver" style="color: #dc3545;"></span>
                    </div>

                    <input type="hidden" name="shipping_value" id="shipping_value">
                    <input type="hidden" name="order_total_val" id="order_total_val">

                    <button type="submit">COMPLETE PURCHASE</button>
                </form>
            </div>
            <div class="right_checkout_wrapper">
                <span class="order_title">YOUR ORDER</span>
                <hr>
                <?php
                $get_cart = mysqli_query($conn, "SELECT product.product_title, subcategory.subcategory_title, cart.product_total, product_qty
                FROM cart
                LEFT JOIN product
                ON cart.product_id = product.product_id
                LEFT JOIN subcategory
                ON cart.subcategory_id = subcategory.subcategory_id
                WHERE user_id = $user_id");

                foreach ($get_cart as $cart) {
                ?>
                <div class="form_group">
                    <div class="span_group">
                        <span><?php echo $cart['product_title']; ?></span>
                        <span class="sub_category"><?php echo $cart['subcategory_title']; ?></span>
                        <span class="qty">x<?php echo $cart['product_qty']; ?></span>
                    </div>
                    <div class="total_span">
                        <span>P</span><span class="total_per_item"><?php echo $cart['product_total']; ?></span>
                    </div>
                </div>
                <?php
                }
                ?>
                <hr>
                <div class="form_group">
                    <span>Total Purchases</span>
                    <div class="total_span">
                        <span>P</span><span class="total_purchases get_total">199.00</span>
                    </div>
                </div>
                <div class="form_group">
                    <span>Shipping Fee</span>
                    <div class="total_span">
                        <span>P</span><span class="shipping_fee get_total">199.00</span>
                    </div>
                </div>
                <hr>
                <div class="form_group">
                    <span>Total</span>
                    <div class="total_span total_bold">
                        <span class="total_bold">P</span><span class="total_bold overall_total">0.00</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include './includes/cart-count.php'?>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js">
    </script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js">
    </script>
    <script src="./assets/js/script.js"></script>
    <script>
        var loader = document.getElementById("preloader");

        window.addEventListener("load", function () {
            loader.style.display = "none";
        })
    </script>

    <script type="text/javascript">
        // GET TOTAL
        $(window).on('load', function () {

            var delivery_opt = $('input[name=deliver]:checked').val();

            if (delivery_opt == "2") {
                $('.shipping_fee').text(parseFloat(200).toFixed(2));
                $('#shipping_value').val(parseFloat(200).toFixed(2));
            } else {
                $('.shipping_fee').text(parseFloat(0).toFixed(2));
                $('#shipping_value').val(parseFloat(0).toFixed(2));
            }

            var overall_total = 0;
            $('.total_per_item').each(function () {
                var subtotal = parseFloat($(this).text());
                overall_total += subtotal;
            })

            $('.total_purchases').text(parseFloat(overall_total).toFixed(2));

            var total_purchases = $('.total_purchases').text();
            var shipping_fee = $('.shipping_fee').text();
            var sum = parseFloat(total_purchases) + parseFloat(shipping_fee);

            $('.overall_total').text(parseFloat(sum).toFixed(2));
            $('#order_total_val').val(parseFloat(sum).toFixed(2));
        })

        $('.deliver').on('change', function () {
            var delivery_opt = $('input[name=deliver]:checked').val();

            if (delivery_opt == "2") {
                $('.shipping_fee').text(parseFloat(200).toFixed(2));
                $('#shipping_value').val(parseFloat(200).toFixed(2));
            } else {
                $('.shipping_fee').text(parseFloat(0).toFixed(2));
                $('#shipping_value').val(parseFloat(0).toFixed(2));
            }

            var total_purchases = $('.total_purchases').text();
            var shipping_fee = $('.shipping_fee').text();
            var sum = parseFloat(total_purchases) + parseFloat(shipping_fee);

            $('.overall_total').text(parseFloat(sum).toFixed(2));
            $('#order_total_val').val(parseFloat(sum).toFixed(2));
        })

        $('.payment').on('change', function() {
            var payment_opt = $('input[name=payment]:checked').val();

            if(payment_opt == "2") {
                $('.gcash_payment').css("display", "flex");
            } else {
                $('.gcash_payment').css("display", "none");
            }
        })

        // SUBMIT CHECKOUT
        $('#checkout_form').on('submit', function(e) {
            e.preventDefault();

            if($.trim($('#fullname').val()) == '') {
                $('.error-fullname').text('Input fullname!');
            } else {
                $('.error-fullname').text('');
            }
            
            if($.trim($('#phone_number').val()).length < 11) {
                $('.error-phone_number').text('Complete phone number first!');
            } else {
                $('.error-phone_number').text('');
            }

            if($.trim($('#block').val()) == '') {
                $('.error-block').text('Input Block No/Building/Street No!');
            } else {
                $('.error-block').text('');
            }

            if($.trim($('#province').val()) == '') {
                $('.error-province').text('Input Province!');
            } else {
                $('.error-province').text('');
            }

            if($.trim($('#city').val()) == '') {
                $('.error-city').text('Input City!');
            } else {
                $('.error-city').text('');
            }

            if($.trim($('#barangay').val()) == '') {
                $('.error-barangay').text('Input barangay!');
            } else {
                $('.error-barangay').text('');
            }

            if($('.gcash_payment').css("display") == "flex") {
                if($.trim($('#screenshot').val()) == '') {
                    $('.error-screenshot').text('Upload payment screenshot!');
                } else {
                    var imgExt = $('#screenshot').val().split('.').pop().toLowerCase();

                    if ($.inArray(imgExt, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                        $('.error-screenshot').text('File not supported');
                    } else {
                        var imgSize = $('#screenshot')[0].files[0].size;

                        if (imgSize > 10485760) {
                            $('.error-screenshot').text('File too large');
                        } else {
                            $('.error-screenshot').text('');
                        }
                    }
                }

                if($.trim($('#reference').val()) == '') {
                    $('.error-reference').text('Input reference!');
                } else {
                    $('.error-reference').text('');
                }
            } else {
                $('.error-screenshot').text('');
            }

            if($('.error-fullname').text() != '' || $('.error-phone_number').text() != '' || $('.error-block').text() != '' || $('.error-province').text() != '' || $('.error-city').text() != '' || $('.error-barangay').text() != '' || $('.error-screenshot').text() != '') {
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
                    type: "POST",
                    url: "./functions/checkout-process",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        if(response == 'success') {
                            window.location.href = "place-order";
                        }
                        console.log(response);
                    }
                })
            }

        })

    </script>
</body>

</html>