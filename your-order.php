<?php
session_start();
require_once './includes/database_conn.php';

if(isset($_SESSION['email'])) {
    $order_id = $_GET['id'];

    $get_order_info = mysqli_query($conn, "SELECT * FROM orders WHERE order_id = $order_id");

    $row = mysqli_fetch_array($get_order_info);

    $order_user_id = $row['user_id'];
    $shipping_fee = $row['shipping_fee'];
    $order_total = $row['order_total'];
    $order_total = $row['order_total'];
    $order_status = $row['order_status'];
} else {
    header('location: index');
}

unset($_SESSION['email']);

if(isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];

    $getUserId = mysqli_query($conn, "SELECT * FROM customers WHERE user_id = $user_id");
    $row = mysqli_fetch_array($getUserId);
    $userId = $row['user_id'];
    $userProfileIcon = $row['user_profile_image'];

    $getCartCount = mysqli_query($conn, "SELECT SUM(product_qty) FROM cart WHERE user_id = $userId");
    $rowCount = mysqli_fetch_array($getCartCount);
    $cartCount = $rowCount['SUM(product_qty)'];

    $user_id = $_SESSION['id'];

    $getAccountInfo = mysqli_query($conn, "SELECT * FROM customers WHERE user_id = '$user_id'");

    while($row = mysqli_fetch_array($getAccountInfo)) {
        $userId = $row['user_id'];
        $userProfileIcon = $row['user_profile_image'];
    }
} else {
    $cartCount = '0';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>


<script>
$(document).ready(function() {
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

    <?php include './includes/navbar.php'; ?>
    <input type="hidden" name="" id="cartCount" value="<?php echo $cartCount; ?>">

    <input type="hidden" id="profileIconCheck" value="<?php echo $userProfileIcon; ?>">

    <script>
    $(window).on('load', function() {
        if ($('#profileIconCheck').val() == '') {
            $('#profileIcon').attr("src", "./assets/images/no_profile_pic.png");
        } else {
            $('#profileIcon').attr("src", "./assets/images/" + $('#profileIconCheck').val());
        }
    })
    </script>

    <section class="tracking-status">
        <div class="wrapper">
            <div class="current_status">
                <span class="status_header">Current Status</span>
                <div class="icon_status">
                <!-- pending -->
                <?php if($order_status == 1) { ?>
                <i class="fa-solid fa-users-line"></i>
                <!-- confirmed -->
                <?php } else if($order_status == 2) { ?>
                <i class="fa-solid fa-check"></i>
                <!-- preparing -->
                <?php } else if($order_status == 3) { ?>
                <i class="fa-solid fa-bowl-rice"></i>
                <!-- to be received -->
                <?php } else if($order_status == 4) { ?>
                <i class="fa-solid fa-box"></i>
                <!-- order delivered -->
                <?php } else if($order_status == 5) { ?>
                <i class="fa-solid fa-utensils"></i>
                <?php } ?>
                </div>
                <?php
                $get_status = mysqli_query($conn, "SELECT order_status.order_status_name FROM orders INNER JOIN order_status ON orders.order_status = order_status.order_status_id WHERE orders.order_status = $order_status");

                $status_row = mysqli_fetch_array($get_status);
                ?>
                <span class="status"><?php echo $status_row['order_status_name'] ?></span>
            </div>
            <div class="hr"></div>
            <div class="order_id_wrapper">
                <span><strong>Order ID:</strong></span>
                <span>#<?php echo $order_id; ?></span>
            </div>
            <div class="hr"></div>
            <div class="order_summary">
                <span class="order_summary_title">Order Summary</span>

                <div class="summary_wrapper">
                    <?php
                    $get_items = mysqli_query($conn, "SELECT product.product_title, subcategory.subcategory_title, order_items.qty, order_items.product_total
                    FROM order_items
                    LEFT JOIN product
                    ON order_items.product_id = product.product_id
                    LEFT JOIN subcategory
                    ON order_items.subcategory_id = subcategory.subcategory_id
                    WHERE order_items.order_id = $order_id");

                    foreach($get_items as $items) {
                    ?>
                    <div class="products">
                        <div class="menu_wrapper">
                            <span class="menu_name"><?php echo $items['product_title']; ?></span>
                            <span class="subcategory"><?php echo $items['subcategory_title']; ?></span>
                            <span class="product_qty">x<?php echo $items['qty']; ?></span>
                        </div>
                        <span class="price">P <?php echo $items['product_total']; ?></span>
                    </div>
                    <?php
                    }
                    ?>
                    <div class="hr"></div>
                    <?php
                    $get_totals = mysqli_query($conn, "SELECT * FROM orders WHERE order_id = $order_id");

                    $totals = mysqli_fetch_array($get_totals);

                    $shipping_fee = $totals['shipping_fee'];
                    $total = $totals['order_total'];
                    $subtotal = $total - $shipping_fee;
                    ?>
                    <div class="products">
                        <span class="total">Sub Total</span>
                        <span class="price">P <?php echo number_format((float)$subtotal, 2, '.', ''); ?></span>
                    </div>
                    <div class="products">
                        <span class="total">Shipping Fee</span>
                        <span class="price">P <?php echo $shipping_fee; ?></span>
                    </div>
                    <div class="hr"></div>
                    <div class="products">
                        <span class="overall_total">Total</span>
                        <span class="overall_price">P <?php echo $total; ?></span>
                    </div>
                </div>
            </div>
            <div class="hr"></div>
            <div class="order_buttons">
                <?php
                if($order_status == 1) {
                ?>
                <button class="cancel">CANCEL ORDER</button>
                <?php
                }
                ?>
                <button class="go_home">GO BACK TO HOME</button>
                <input type="hidden" name="" id="order_id" value="<?php echo $order_id ?>">
            </div>
        </div>
    </section>

    <?php include './includes/cart-count.php' ?>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js">
    </script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js">
    </script>
    <script src="./assets/js/script.js"></script>
    <script>
    var loader = document.getElementById("preloader");

    window.addEventListener("load", function() {
        loader.style.display = "none";
    })

    $('.go_home').on('click', function(e) {
        location.href = 'index';
    })

    $('.cancel').on('click', function(e) {
        var order_id = $('#order_id').val();

        console.log(order_id);

        $.ajax({
            type: "POST",
            url: "./functions/cancel-order",
            data: {
                'cancel': true,
                'order_id': order_id,
            },
            success: function (response) {
                if(response == 'success') {
                    location.href = 'index';
                }
                console.log(response);
            }
        })
    })
    </script>
</body>

</html>