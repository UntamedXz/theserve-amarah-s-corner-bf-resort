<?php
session_start();
require_once './includes/database_conn.php';
if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location: ./login");
}

$user_id = $_SESSION['id'];

$getAccountInfo = mysqli_query($conn, "SELECT * FROM customers WHERE user_id = '$user_id'");

while($row = mysqli_fetch_array($getAccountInfo)) {
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

    <!-- DELETE -->
    <div id="popup-box" class="popup-box delete-modal">
        <div class="top">
            <h3>Delete Item</h3>
            <div id="modalClose" class="fa-solid fa-xmark"></div>
        </div>
        <hr>
        <form id="delete">
            <input type="hidden" name="" id="cartId" value="">
            <p>Are you sure, you want to delete this item?</p>
        </form>
        <hr>
        <div class="bottom">
            <div class="buttons">
                <button id="modalClose" type="button" class="cancel">CLOSE</button>
                <button form="delete" id="delete-btn" type="submit" class="save">DELETE</button>
            </div>

        </div>
    </div>

    <div id="popup-box" class="popup-box delete-all-modal">
        <div class="top">
            <h3>Delete All Items</h3>
            <div id="modalClose" class="fa-solid fa-xmark"></div>
        </div>
        <hr>
        <form id="delete_all">
            <input type="hidden" name="user_id" id="user_id" value="">
            <p>Are you sure, you want to delete all items in cart?</p>
        </form>
        <hr>
        <div class="bottom">
            <div class="buttons">
                <button id="modalClose" type="button" class="cancel">CLOSE</button>
                <button form="delete_all" id="delete-btn" type="submit" class="save">DELETE</button>
            </div>

        </div>
    </div>

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

    <?php
    if(isset($_SESSION['alert'])) {
        $alert = $_SESSION['alert'];
        if($alert == 'success') {
            echo "
            <script>
                $('#toast').addClass('active');
                $('.progress').addClass('active');
                $('#toast-icon').removeClass('fa-solid fa-triangle-exclamation').addClass('fa-solid fa-check warning');
                $('.text-1').text('Success!');
                $('.text-2').text('Cart item deleted successfully!');
                setTimeout(() => {
                $('#toast').removeClass('active');
                $('.progress').removeClass('active');
                }, 5000);
            </script>
            ";
            unset($_SESSION['alert']);
        } else if($alert == 'success_all') {
            echo "
            <script>
                $('#toast').addClass('active');
                $('.progress').addClass('active');
                $('#toast-icon').removeClass('fa-solid fa-triangle-exclamation').addClass('fa-solid fa-check warning');
                $('.text-1').text('Success!');
                $('.text-2').text('All cart item successfully deleted!');
                setTimeout(() => {
                $('#toast').removeClass('active');
                $('.progress').removeClass('active');
                }, 5000);
            </script>
            ";
            unset($_SESSION['alert']);
        }
    } else {
        $alert = '';
    }
    ?>

    <section class="cart">
        <div class="wrapper">
            <input type="hidden" name="user_id" id="user_id" value="<?php echo $userId; ?>">
            <h1>Shopping Cart</h1>
            <hr>
            <?php
                    if($cartCount > 0) {
                    ?>
                    <button id="remove_all" data-id="<?php echo $user_id; ?>">REMOVE ALL</button>
                    <?php
                    } else {
                    ?>
                    <h3 style="text-align: center;">No items in cart!</h3>
                    <?php
                    }
                    ?>
            <div class="project">
                <div class="shop">
                    <?php

                    $getUserCart = mysqli_query($conn, "SELECT cart.cart_id, product.product_title, product.product_img1, subcategory.subcategory_title, product.product_price, cart.product_qty, cart.product_total
                    FROM cart
                    LEFT JOIN product
                    ON cart.product_id = product.product_id
                    LEFT JOIN subcategory
                    ON cart.subcategory_id = subcategory.subcategory_id WHERE cart.user_id = $userId");

                    foreach($getUserCart as $row) {
                    ?>
                    <form id="cart_item">
                        <div class="box" data-id="<?php echo $row['cart_id']; ?>">
                            <?php
                        if($row['product_img1'] != '') { 
                        ?>
                            <div class="img" style="background:
                            url(./assets/images/<?php echo $row['product_img1']; ?>) no-repeat; background-size: cover;
                            background-position: center;">
                            </div>
                            <?php
                        } else {
                        ?>
                            <div class="img"
                                style="display: flex; align-items: center; justify-content: center; color: #6b6b6b;">
                                <span>NO IMAGE AVAILABLE</span>
                            </div>
                            <?php
                        }
                        ?>
                            <div class="content">
                                <h3><?php echo $row['product_title']; ?></h3>
                                <h5><?php echo $row['subcategory_title']; ?></h5>
                                <h4>Price <strong>P<span
                                            data-price="<?php echo $row['cart_id']; ?>"><?php echo $row['product_price']; ?></span>
                                    </strong></h4>
                                <div class="qty-remove">
                                    <p class="unit">Quantity: <input id="qty" min="1" class="qty"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            value="<?php echo $row['product_qty']; ?>"
                                            data-id="<?php echo $row['cart_id']; ?>"></p>
                                    <h4 class="subTotal">Subtotal <strong>P<span class="subtotal"
                                                data-sub_total="<?php echo $row['cart_id']; ?>"><?php echo $row['product_total']; ?></span>
                                        </strong></h4>
                                </div>
                                <p form="cart_item" class="btn-area" data-id="<?php echo $row['cart_id']; ?>">
                                    <i class='bx bxs-trash'></i>
                                    <span class="btn-2">Remove</span>
                                </p>
                            </div>
                        </div>
                    </form>
                    <?php
                    }
                    ?>
                </div>
                <?php
                if($cartCount > 0) {
                ?>
                <div class="right-bar">
                    <div class="overall_total">
                        <span>Total</span>
                        <div class="total_value">
                            <span><strong>P</strong></span><span class="total">0.00</span>
                        </div>
                    </div>
                    <button id="go_to_checkout">PROCEED TO CHECKOUT</button>
                </div>
                <?php
                }
                ?>
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
    </script>

    <script type="text/javascript">
    // PREVENT TO TYPE 0 

    // GET SUBTOTAL 
    $('.qty').each(function() {
        $(this).keyup(function() {
            if ($(this).val() == '' || $(this).val() == '0') {
                var user_id = $('#user_id').val();
                var id = $(this).data('id');
                var price = $('*[data-price= ' + id + ']').text();
                var priceFloat = parseFloat(price).toFixed(2);
                var qty = 1;
                var subtotal = parseFloat((priceFloat * qty)).toFixed(2);
                $('*[data-sub_total= ' + id + ']').text(subtotal);

                $.ajax({
                    type: "POST",
                    url: "./functions/update-cart",
                    data: {
                        'update': true,
                        'price': priceFloat,
                        'cart_id': id,
                        'qty': qty,
                        'subtotal': subtotal,
                        'user_id': user_id,
                    },
                    success: function(response) {}
                })
            } else {
                var user_id = $('#user_id').val();
                var id = $(this).data('id');
                var price = $('*[data-price= ' + id + ']').text();
                var priceFloat = parseFloat(price).toFixed(2);
                var qty = parseInt($(this).val());
                var subtotal = parseFloat((priceFloat * qty)).toFixed(2);
                $('*[data-sub_total= ' + id + ']').text(subtotal);

                $.ajax({
                    type: "POST",
                    url: "./functions/update-cart",
                    data: {
                        'update': true,
                        'price': priceFloat,
                        'cart_id': id,
                        'qty': qty,
                        'subtotal': subtotal,
                        'user_id': user_id,
                    },
                    success: function(response) {}
                })
            }
            var gdtotal = 0;
            $('.subtotal').each(function() {
                var subtotal = parseFloat($(this).text());
                gdtotal += subtotal;
            })
            $('.total').text(gdtotal.toFixed(2));
        })
    })

    $(window).on('load', function() {
        var gdtotal = 0;
            $('.subtotal').each(function() {
                var subtotal = parseFloat($(this).text());
                gdtotal += subtotal;
            })
            $('.total').text(gdtotal.toFixed(2));
    })

    // REMOVE ALL ITEMS
    $('#remove_all').on('click', function(e) {
        e.preventDefault();
        var user_id = $(this).data('id');

        $('.delete-all-modal').addClass('active');
        $('#user_id').val(user_id);
    })

    // CLICK REMOVE
    $('.btn-area').on('click', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('.delete-modal').addClass('active');
        $('#cartId').val(id);
    })

    // SUBMIT DELETE
    $('#delete').on('submit', function(e) {
        e.preventDefault();
        var cart_id = $('#cartId').val();

        $.ajax({
            type: "POST",
            url: "./functions/delete-cart-item",
            data: {
                'cart_id': cart_id,
            },
            success: function(response) {
                if (response == 'success') {
                    location.reload();
                }
            }
        })
    })

    // SUBMIT DELETE ALL
    $('#delete_all').on('submit', function(e) {
        e.preventDefault();

        var user_id = $('#user_id').val();
        
        $.ajax({
            type: "POST",
            url: "./functions/delete-all-cart",
            data: {
                'user_id': user_id,
            },
            success: function(response) {
                if (response == 'success') {
                    location.reload();
                } else {
                    console.log(response);
                }
            }
        })
    })

    $('#go_to_checkout').on('click', function(e) {
        e.preventDefault();
        location.href = 'checkout'
    })

    // CLOSE MODAL
    $(document).on('click', '#modalClose', function() {
        $(".delete-modal").removeClass("active");
        $(".delete-all-modal").removeClass("active");
    })

    $('.close').on('click', function(e) {
        $('#toast').removeClass("active");
        $('.progress').removeClass("active");
    })
    </script>
</body>

</html>