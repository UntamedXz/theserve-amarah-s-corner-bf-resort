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

$id = $_GET['id'];
$decode_id = base64_decode(urldecode($id));
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
    <title>Admin Panel</title>
</head>

<body>
    <?php include 'top.php';?>

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

    <!-- MAIN -->
    <main>
        <h1 class="title">View Selected Order Deliver</h1>
        <ul class="breadcrumbs">
            <li><a href="index">Home</a></li>
            <li class="divider">/</li>
            <li><a href="order">View Order Delivered</a></li>
            <li class="divider">/</li>
            <li><a href="view-category" class="active">View Selected Order Delivered</a></li>
        </ul>
        <section class="orders-view-edit">
            <?php
            $get_date = mysqli_query($conn, "SELECT orders.order_date, order_status.order_status_name
            FROM orders
            INNER JOIN order_status
            ON orders.order_status = order_status.order_status_id
            WHERE order_id = $decode_id");

            foreach($get_date as $date) {
            ?>
            <h1>You are viewing complete details of this order #<?php echo $decode_id; ?> was placed on <?php echo $date['order_date']; ?> and has currently
            <?php echo $date['order_status_name']; ?></h1>
            <?php
            }
            ?>
            <div class="wrapper">
                <div class="left-wrapper">
                    <h3>Order #<?php echo $decode_id; ?> Details</h3>
                    <hr>
                    <div class="order_details_sec">
                        <h2>Order Details</h2>

                        <div class="details_container">
                            <div class="title-header">
                                <span>PRODUCT</span>
                                <span>TOTAL</span>
                            </div>
                        </div>

                        <hr>

                        <div class="product_order">
                            <?php
                            $get_items = mysqli_query($conn, "SELECT product.product_title, subcategory.subcategory_title, order_items.qty, order_items.product_total
                            FROM order_items
                            LEFT JOIN product
                            ON product.product_id = order_items.product_id
                            LEFT JOIN subcategory
                            ON order_items.subcategory_id = subcategory.subcategory_id
                            WHERE order_items.order_id = $decode_id");

                            foreach($get_items as $items) {
                            ?>
                            <div class="products">
                                <div class="products_details">
                                    <span class="product_name"><?php echo $items['product_title']; ?></span>
                                    <span class="product_subcategory"><?php echo $items['subcategory_title']; ?></span>
                                    <span class="product_qty">x<?php echo $items['qty']; ?></span>
                                </div>
                                <span>P <?php echo $items['product_total']; ?></span>
                            </div>
                            <?php
                            }
                            ?>
                        </div>

                        <hr>

                        <div class="subtotal_container">
                            <?php
                            $get_total = mysqli_query($conn, "SELECT * FROM orders WHERE order_id = $decode_id");

                            foreach($get_total as $total) {

                                $totalDB = $total['order_total'];
                                $shipping = $total['shipping_fee'];
                                $subtotal = $totalDB - $shipping;
                            ?>
                            <div class="subtotal_items">
                                <span>Subtotal</span>
                                <span>P <?php echo number_format((float)$subtotal, 2, '.', ''); ?></span>
                            </div>
                            <?php
                            }
                            ?>
                        </div>

                        <hr>

                        <div class="shipping_container">
                            <?php
                            $get_shipping = mysqli_query($conn, "SELECT * FROM orders WHERE order_id = $decode_id");

                            foreach($get_shipping as $shipping) {
                            ?>
                            <div class="shipping_items">
                                <span>Shipping Fee</span>
                                <span>P <?php echo $shipping['shipping_fee']; ?></span>
                            </div>
                            <?php
                            }
                            ?>
                        </div>

                        <hr>

                        <div class="payment_container">
                            <?php
                            $payment = mysqli_query($conn, "SELECT payment.payment_title
                            FROM payment
                            INNER JOIN orders
                            ON orders.payment_method = payment.payment_id
                            WHERE orders.order_id = $decode_id");

                            foreach($payment as $method) {
                            ?>
                            <div class="payment_items">
                                <span>Payment Method</span>
                                <span><?php echo $method['payment_title']; ?></span>
                            </div>
                            <?php
                            }
                            ?>
                        </div>

                        <hr>

                        <div class="total_container">
                            <?php
                            $get_total = mysqli_query($conn, "SELECT * FROM orders WHERE order_id = $decode_id");

                            foreach($get_total as $total) {
                            ?>
                            <div class="total_items">
                                <span>Total</span>
                                <span>P <?php echo $total['order_total']; ?></span>
                            </div>
                            <?php
                            }
                            ?>
                        </div>

                    </div>

                    <?php
                    $check_method = mysqli_query($conn, "SELECT * FROM orders WHERE order_id = $decode_id AND payment_method = 2");

                    if(mysqli_num_rows($check_method) > 0) {
                    foreach($check_method as $reference) {
                    ?>
                    <div class="gcash_details_sec">
                        <h2>Gcash Payment Details</h2>

                        <div class="gcash_container">
                            <div class="screenshot_container">
                                <img src="../assets/images/<?php echo $reference['screenshot_payment']; ?>" alt="">
                            </div>
                            <div class="reference_container">
                                <span>Reference No.</span>
                                <span><?php echo $reference['reference']; ?></span>
                            </div>
                        </div>

                        <div class="popup_image">
                            <div class="img_container">
                                <img class="image" src="../assets/images/gcashscreenshot.jpg" alt="">
                            </div>
                        </div>

                    </div>
                    <?php
                    }
                    }
                    ?>

                    <div class="customer_details_sec">
                        <h2>Customer Details</h2>

                        <hr>

                        <div class="customer_container">
                            <?php
                            $get_customer = mysqli_query($conn, "SELECT * FROM order_address WHERE order_id = $decode_id");

                            foreach($get_customer as $name) {
                            ?>
                            <div class="customer_items">
                                <span>Name:</span>
                                <span><?php echo $name['billing_name'] ?></span>
                            </div>
                            <?php
                            }
                            ?>
                        </div>

                        <hr>

                        <div class="customer_container">
                            <?php
                            $get_email = mysqli_query($conn, "SELECT customers.email FROM orders INNER JOIN customers ON orders.user_id = customers.user_id WHERE order_id = $decode_id");

                            foreach($get_email as $email) {
                            ?>
                            <div class="customer_items">
                                <span>Email:</span>
                                <span><?php echo $email['email']; ?></span>
                            </div>
                            <?php
                            }
                            ?>
                        </div>

                        <hr>

                        <div class="customer_container">
                            <?php
                            $get_number = mysqli_query($conn, "SELECT * FROM order_address WHERE order_id = $decode_id");

                            foreach($get_number as $number) {
                            ?>
                            <div class="customer_items">
                                <span>Phone Number:</span>
                                <span><?php echo $number['billing_number']; ?></span>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="billing_details_sec">
                        <h2>Billing Details</h2>

                        <hr>
                        <?php
                        $get_billing_details = mysqli_query($conn, "SELECT * FROM order_address WHERE order_id = $decode_id");


                        foreach($get_billing_details as $billing) {
                        ?>
                        <div class="billing_container">
                            <span><?php echo $billing['billing_name']; ?></span>
                            <span><?php echo $billing['block_street_building']; ?>,</span>
                            <span><?php echo $billing['barangay']; ?>,</span>
                            <span><?php echo $billing['city_municipality']; ?>,</span>
                            <span><?php echo $billing['province']; ?></span>
                        </div>
                        <?php
                        }
                        ?>
                </div>

                
            </div>

            <div class="right-wrapper">
                <h3>Order Actions</h3>
                <hr>
                <div class="order_details_sec">
                        <h2>Current Order Status Pending</h2>

                        <form id="update_status">
                            <input type="hidden" name="order_id" id="order_id" value="<?php echo $decode_id; ?>">
                            <span>Change Order Status</span>
                            <select name="selected_status" id="selected_status" required disabled>
                                <option value="">SELECT PROCESS</option>
                                <?php
                                $get_option = mysqli_query($conn, "SELECT * FROM order_status");
                                $get_selected = mysqli_query($conn, "SELECT * FROM orders WHERE order_id = $decode_id");

                                $fetch = mysqli_fetch_array($get_selected);
                                $selected = $fetch['order_status'];

                                foreach($get_option as $option) {
                                ?>
                                <option value="<?php echo $option['order_status_id']; ?>" <?php if($option['order_status_id'] == $selected) { echo 'selected="selected"';} ?>><?php echo $option['order_status_name']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <button disabled>UPDATE STATUS</button>
                        </form>

                    </div>
                </div>
        </section>

        <?php
        if(isset($_SESSION['update'])) {
            $update = $_SESSION['update'];

            if($update == 'success') {
                echo "
                    <script>
                        $('#toast').addClass('active');
                        $('.progress').addClass('active');
                        $('#toast-icon').removeClass(
                            'fa-solid fa-triangle-exclamation').addClass(
                            'fa-solid fa-check warning');
                        $('.text-1').text('Success!');
                        $('.text-2').text('Order status updated successfully!');
                        setTimeout(() => {
                            $('#toast').removeClass('active');
                            $('.progress').removeClass('active');
                        }, 5000);
                    </script>
                ";
                unset($_SESSION['update']);
            }
            unset($_SESSION['update']);
        }
        ?>

        <script>
            $('#update_status').on('submit', function(e) {
                e.preventDefault();

                console.log(status);

                $.ajax({
                    type: "POST",
                    url: "./functions/update-status",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if(response == 'success') {
                            location.reload();
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
                    }
                })
            })

            document.querySelectorAll('.screenshot_container img').forEach(image => {
                image.onclick = () => {
                    document.querySelector('.popup_image').style.display = 'flex';
                    document.querySelector('.popup_image img').src = image.getAttribute('src');
                }
            });

            document.querySelector('.popup_image').onclick = () => {
                document.querySelector('.popup_image').style.display = 'none';
            };
        </script>


        <?php include 'bottom.php'?>

</body>

</html>