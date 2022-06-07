<?php
session_start();
require_once "./includes/database_conn.php";

$id = $_GET['link'];

if(isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
} else {
    $user_id = '';
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
    <title>Amarah's Corner - BF Resort Las Piñas</title>

    <style>
        body {
            background: url(./assets/images/background.png) no-repeat;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            height: 100vh;
        }
    </style>
</head>

<body>
    <div id="preloader"></div>

    <?php include './includes/navbar.php';?>
    <input type="hidden" name="" id="cartCount" value="<?php echo $cartCount; ?>">

    <input type="hidden" id="profileIconCheck" value="<?php echo $userProfileIcon; ?>">

    <script>
        $(window).on('load', function() {
            if($('#profileIconCheck').val() == '') {
                $('#profileIcon').attr("src","./assets/images/no_profile_pic.png");
            } else {
                $('#profileIcon').attr("src","./assets/images/" + $('#profileIconCheck').val());
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
                $('.text-2').text('Item added to cart successfully!');
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

    <!-- MENU SECTION -->
    <section class="menu" id="menu">
        <h3 class="title-header">Menu</h3>
        <div class="menu__container">
            <div class="menu__wrapper swiper mySwiper">
                <div class="menu__content swiper-wrapper">
                <?php
                $get_category = mysqli_query($conn, "SELECT * FROM category");

                foreach ($get_category as $category_row) {
                $encryptedCategoryId = urlencode(base64_encode($category_row['category_id']));
                ?>
                    <a href="catalog?id=<?php echo $encryptedCategoryId; ?>" class="menu__card swiper-slide">
                        <div class="menu__image">
                            <img src="./assets/images/<?php echo $category_row['categoty_thumbnail']; ?>">
                        </div>
                        <div class="menu__name">
                            <h3><?php echo ucwords($category_row['category_title']); ?></h3>
                        </div>
                    </a>
                <?php
                }
                ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </section>

    <?php
    $getProduct = mysqli_query($conn, "SELECT * FROM product WHERE product_slug = '$id'");

    foreach ($getProduct as $row) {
    ?>
    <section class="product-details">
        <div class="product-details__wrapper">
            <div class="left">
                <input type="hidden" name="" id="product_id" value="<?php echo $row['product_id']; ?>">
                <input type="hidden" name="" id="user_id" value="<?php echo $user_id; ?>">
                <?php
                if (!empty($row['product_img1'])) {
                ?>
                <div class="img-container">
                    <img src="./assets/images/<?php echo $row['product_img1']; ?>" alt="">
                </div>
                <?php
                } else {
                ?>
                <div class="no-img-container">
                    <img src="./assets/images/image_not_available-black.png" alt="">
                </div>
                <?php
                }
                ?>
                <div class="product-details">
                    <h1 class="product-title">
                        <?php echo $row['product_title']; ?>
                    </h1>
                    <span class="price"><small>Starts at </small> <b>P<span
                                class="priceValue"><?php echo $row['product_price']; ?></span> </b></span>
                    <!-- <span class="desc">
                        Ham with Mozarella and Special Cheese
                    </span> -->
                </div>
            </div>
            <div class="right">
                <div class="form-group">
                    <span>Special Instructions (Optional)</span>
                    <input type="text" name="" id="">
                </div>
            </div>
        </div>
    </section>
    <?php
}
?>

    <div class="product-footer">
        <div class="product-footer__wrapper">
            <div class="qty-container">
                <div class="prev qtyBtn">-</div>
                <div class="next qtyBtn">+</div>
                <input class="number-spinner" type="number" name="" id="" value="1" min="1">
            </div>
            <div class="total-box">
                <div class="total">
                    <span class="totalText">Total</span>
                    <span class="totalPrice">P<span
                            class="totalPriceSpan"><?php echo $row['product_price']; ?></span></span>
                </div>
                <div class="btn-container">
                    <button type="submit" id="addToCart">ADD TO CART</button>
                </div>
            </div>
        </div>
    </div>

    <?php include './includes/cart-count.php' ?>
    <script src="./assets/js/script.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.prev').on('click', function () {
                var prev = $(this).closest('.qty-container').find('input').val();

                if (prev == 1) {
                    var a = 1;
                    $(this).closest('.qty-container').find('input').val(a);
                } else {
                    var prevVal = prev - 1;
                    $(this).closest('.qty-container').find('input').val(prevVal);
                }
            });

            $('.next').on('click', function () {
                var next = $(this).closest('.qty-container').find('input').val();

                if (next == 100) {
                    $(this).closest('.qty-container').find('input').val('100');
                } else {
                    var nextVal = ++next;
                    $(this).closest('.qty-container').find('input').val(nextVal);
                }
            });

            $(".qtyBtn").on('click', function () {
                var total = parseFloat($('.number-spinner').val()).toFixed(2);
                var price = parseFloat($('.priceValue').text()).toFixed(2);

                var sum = parseFloat(total * price).toFixed(2);
                $('.totalPriceSpan').text(sum);
            });
        })
    </script>

    <script>
        $('#addToCart').on('click', function (e) {
            e.preventDefault();
            var userId = $('#user_id').val();
            var product_id = $('#product_id').val();
            var qty = $('.number-spinner').val();
            var total = $('.totalPriceSpan').text();

            if(userId == '') {
                location.href = 'http://localhost/theserve-amarah-s-corner-las-pinas/login';
            } else {
                $.ajax ({
                    type: "POST",
                    url: "./functions/add-to-cart",
                    data: {
                        'add-to-cart': true,
                        'userId': userId,
                        'product_id': product_id,
                        'qty': qty,
                        'total': total,
                    },
                    success: function (response) {
                        if (response == 'success') {
                            location.reload();
                        }
                    }
                })
            }
        })
    </script>

    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 'auto',
            spaceBetween: 15,
            centeredSlides: true,
            loop: true,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>

    <script>
        var loader = document.getElementById("preloader");

        window.addEventListener("load", function () {
            loader.style.display = "none";
        })
    </script>
</body>

</html>