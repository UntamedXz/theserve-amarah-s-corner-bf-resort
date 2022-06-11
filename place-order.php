<?php
session_start();
require_once './includes/database_conn.php';
if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location: ./login");
}

if(isset($_SESSION['order_id'])) {
    $order_id = $_SESSION['order_id'];
} else {
    $order_id = 0;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/backup.css">
    <title>Receipt</title>
</head>
<style>
    body {
        background: url(./assets/images/background.png) no-repeat;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        height: 100%;
    }

    .card {
        border: none;
        border-radius: 5px;
        overflow: hidden;
    }

    .logo {
        background-image: url('./assets/images/navbar.png');
        background-size: contain;
        position: relative;
        border-radius: 5px 5px 0px 0px;

    }

    .gif {
        width: 180px;
    }

    .forgif {
        text-align: center;
    }

    .totals tr td {
        font-size: 13px
    }

    .product-qty span {
        font-size: 12px;
        color: #dedbdb;
    }

    .qr {
        text-align: center;
    }

    .logoTop {
        width: 150px;

    }

    .container {
        border-radius: 15px;

    }

    .fa-home {
        color: #ffaf08;
        border-radius: 5px;
        padding: 5px;
        position: absolute;
        right: 50px;
        top: 30px;
    }

    .fa-home:hover {
        color: #ffc240;
    }
</style>

<body>
    <div id="preloader"></div>


    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="text-left logo p-2 px-5"> <img src="./assets/images/logo.png" class="logoTop"> <a
                            href="index" class="w3-xxxlarge"><i class="fa fa-home"></i></a> </div>
                    <div class="invoice p-5">
                        <h5>Your order Confirmed!</h5>
                        <div class="forgif"><img class="gif" src="./assets/images/courier.gif"></div>

                        <?php
                        $get_name = mysqli_query($conn, "SELECT * FROM order_address WHERE order_id = $order_id");

                        foreach($get_name as $name) {
                        ?>
                        <span class="font-weight-bold d-block mt-4">Hello, <?php echo $name['billing_name']; ?> <h3 class="customerName"></h3>
                        </span> <span>Your order has been confirmed and will be shipped right away!</span>
                        <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
                        <?php
                        }
                        ?>  
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>
                                            <?php
                                            $get_date = mysqli_query($conn, "SELECT * FROM orders WHERE order_id = $order_id");

                                            foreach($get_date as $date) {
                                            ?>
                                            <div class="py-2"> 
                                                <span class="d-block text-muted">Order Date</span>
                                                <span><?php echo $date['order_date']; ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="py-2"> <span class="d-block text-muted">Order No</span>
                                                <span><?php echo $date['order_id']; ?></span>
                                                <div class="qr"></div>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $get_payment = mysqli_query($conn, "SELECT payment.payment_title
                                            FROM payment
                                            INNER JOIN orders
                                            ON orders.payment_method = payment.payment_id
                                            WHERE order_id = $order_id");

                                            foreach($get_payment as $payment) {
                                            ?>
                                            <div class="py-2"> <span class="d-block text-muted">Payment</span>
                                                <span><?php echo $payment['payment_title']; ?></span> </div>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $get_address = mysqli_query($conn, "SELECT * FROM order_address WHERE order_id = $order_id");

                                            foreach($get_address as $address) {
                                            ?>
                                            <div class="py-2"> <span class="d-block text-muted">Shipping Address</span>
                                                <span><?php echo $address['block_street_building'] . ", " . $address['barangay'] . ", " . $address['city_municipality'] . ", " . $address['province']; ?></span> </div>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="product border-bottom table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <?php
                                    $get_order_items = mysqli_query($conn, "SELECT order_items.order_id, product.product_title, product.product_img1, subcategory.subcategory_title, order_items.qty, order_items.product_total
                                    FROM order_items
                                    LEFT JOIN product
                                    ON order_items.product_id = product.product_id
                                    LEFT JOIN subcategory
                                    ON order_items.subcategory_id = subcategory.subcategory_id
                                    WHERE order_items.order_id = $order_id");

                                    foreach($get_order_items as $items) {
                                    ?>
                                    <tr>
                                        <td width="20%"> <img src="./assets/images/<?php echo $items['product_img1']; ?>" width="80px"> </td>
                                        <td width="60%"> <span class="font-weight-bold"><?php echo $items['product_title']; ?></span>
                                            <div class="product-qty"> <span><?php echo $items['subcategory_title']; ?></span> <span class="d-block">Quantity:<?php echo $items['qty']; ?></span> </div>
                                        </td>
                                        <td width="20%">
                                            <div class="text-right"> <span class="font-weight-bold">P <?php echo $items['product_total']; ?></span> </div>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row d-flex justify-content-end">
                            <div class="col-md-5">
                                <table class="table table-borderless">
                                <?php
                                        $get_total = mysqli_query($conn, "SELECT * FROM orders WHERE order_id = $order_id");

                                        foreach($get_total as $total) {

                                            $totalDB = $total['order_total'];
                                            $shipping = $total['shipping_fee'];
                                            $subtotal = $totalDB - $shipping;
                                        ?>
                                    <tbody class="totals">
                                        <tr>
                                            <td>
                                                <div class="text-left"> <span class="text-muted">Subtotal</span> </div>
                                            </td>
                                            <td>
                                                <div class="text-right"> <span>P <?php echo $subtotal; ?></span> </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="text-left"> <span class="text-muted">Shipping Fee</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-right"> <span>P <?php echo $shipping; ?></span> </div>
                                            </td>
                                        </tr>
                                        <tr class="border-top border-bottom">
                                            <td>
                                                <div class="text-left"> <span class="font-weight-bold">Total</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-right"> <span class="font-weight-bold">P <?php echo $totalDB; ?></span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <?php
                                        }
                                        ?>
                                </table>
                            </div>
                        </div>
                        <p>We will be sending shipping confirmation email when the item shipped successfully!</p>
                        <p class="font-weight-bold mb-0">Thanks for shopping with us!</p> <span>Amarah's Corner
                            Team</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- SCRIPT -->
        <script>
            var loader = document.getElementById("preloader");

            window.addEventListener("load", function () {
                loader.style.display = "none";
            })
        </script>
        <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
        <script src="./assets/js/script.js"></script>
</body>

</html>