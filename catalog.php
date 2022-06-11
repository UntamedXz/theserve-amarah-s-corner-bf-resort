<?php
session_start();
require_once "./includes/database_conn.php";

$id = $_GET['id'];
$decode_id = base64_decode(urldecode($id));

$getCategoryTitle = mysqli_query($conn, "SELECT category_title FROM category WHERE category_id = $decode_id");

$categoryTitle = '';
while ($result = mysqli_fetch_assoc($getCategoryTitle)) {
    $categoryTitle = $result['category_title'];
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/css/backup.css">
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

    <?php include './includes/navbar.php'; ?>
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
                                <img src="./assets/images/<?php echo $category_row['categoty_thumbnail']; ?>" alt="">
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

    <section class="catalog">
        <h3 class="title-header"><?php echo $categoryTitle ?></h3>
        <div class="container">
            <!-- <div class="container-left">
                <div class="container-left-cont">

                </div>
            </div> -->
            <div class="container-right">
                <div class="container-right-cont">
                    <?php
                    $getProduct = mysqli_query($conn, "SELECT subcategory.subcategory_title, product.product_status, product.product_img1, product.product_title, product.product_price, product.product_slug FROM product LEFT JOIN subcategory ON product.subcategory_id=subcategory.subcategory_id WHERE product.category_id = $decode_id");

                    foreach ($getProduct as $rowProduct) {

                        if($rowProduct['product_status'] == 2) {
                    ?>
                        <a href="#" class="catalog-box" style="position: relative;">
                            <?php
                            if(!empty($rowProduct['product_img1'])) {
                            ?>
                            <div class="img-cont">
                                <img style="filter: grayscale(100%);" src="./assets/images/<?php echo $rowProduct['product_img1']; ?>" alt="">
                            </div>
                            <?php
                            } else {
                            ?>
                            <div class="no-img-cont">
                                <img style="filter: grayscale(100%);" src="./assets/images/image_not_available-yellow.png" alt="">
                            </div>
                            <?php
                            }
                            ?>
                            <div class="details">
                                <h4 style="filter: grayscale(100%);"><?php echo $rowProduct['product_title'] ?></h4>
                                <h5 style="color: #ffaf08; font-weight: 400; filter: grayscale(100%);"><?php echo $rowProduct['subcategory_title']; ?></h5>
                                <h5 style="filter: grayscale(100%);" class="price">P<?php echo $rowProduct['product_price'] ?></h5>
                                <button style="filter: grayscale(100%);" class="order-btn"><i class='bx bxs-cart'></i>ORDER NOW</button>
                            </div>
                            <span style="color: #fff; font-weight: 800; font-size: 32px; position: absolute; filter: unset; top: 45%; transform: translateY(-60%); transform: rotate(-35deg);" class="status">NOT AVAILABLE</span>
                        </a>
                    <?php
                        } else {
                        ?>
                        <a href="product?link=<?php echo $rowProduct['product_slug']; ?>" class="catalog-box">
                            <?php
                            if(!empty($rowProduct['product_img1'])) {
                            ?>
                            <div class="img-cont">
                                <img src="./assets/images/<?php echo $rowProduct['product_img1']; ?>" alt="">
                            </div>
                            <?php
                            } else {
                            ?>
                            <div class="no-img-cont">
                                <img src="./assets/images/image_not_available-yellow.png" alt="">
                            </div>
                            <?php
                            }
                            ?>
                            <div class="details">
                                <h4><?php echo $rowProduct['product_title'] ?></h4>
                                <h5 style="color: #ffaf08; font-weight: 400;"><?php echo $rowProduct['subcategory_title']; ?></h5>
                                <h5 class="price">P<?php echo $rowProduct['product_price'] ?></h5>
                                <button class="order-btn"><i class='bx bxs-cart'></i>ORDER NOW</button>
                            </div>
                        </a>
                        <?php
                        }
                    }
                    ?>
                </div>
                <div id="load-more-products">
                    <input type="submit" class="load-more-products" value="LOAD MORE">
                </div>
            </div>
    </section>

    <?php include './includes/cart-count.php' ?>
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
    <!-- SCRIPT -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js">
    </script>

    <script src="./assets/js/script.js"></script>

    <script>
        var products_col = document.querySelectorAll(".catalog-box");
        var load_more_products = document.querySelector(".load-more-products");

        if (products_col.length < 8) {
            load_more_products.style.display = 'none';
        } else {
            load_more_products.style.display = 'block';

            var current_products_col = 8;
            load_more_products.addEventListener("click", function() {
                for (var i = current_products_col; i < current_products_col + 8; i++) {
                    if (products_col[i]) {
                        products_col[i].style.display = "flex";
                    }
                }
                current_products_col += 4;
                if (current_products_col >=
                    products_col.length) {
                    event.target.style.display = "none";
                }
            });
        }
    </script>

    <script>
        var loader = document.getElementById("preloader");

        window.addEventListener("load", function() {
            loader.style.display = "none";
        })
    </script>
</body>

</html>