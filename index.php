<?php
require_once './includes/database_conn.php';
session_start();

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <script>
        (function (w, d) {
            w.CollectId = "628c48cbfaa7943a0bbb67f1";
            var h = d.head || d.getElementsByTagName("head")[0];
            var s = d.createElement("script");
            s.setAttribute("type", "text/javascript");
            s.async = true;
            s.setAttribute("src", "https://collectcdn.com/launcher.js");
            h.appendChild(s);
        })(window, document);
    </script>
</head>

<body>
    <div id="preloader"></div>

    <?php include './includes/navbar.php';
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo "
        <script type='text/javascript'>
            window.onload = (event) => {
                document.querySelector('.header .header-1 .left .profile').style.display = 'flex';

                document.querySelector('.header .header-1 .left .loginBtn').style.display = 'none';
            }
        </script>
        ";
    }
    ?>

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

    <!-- BANNER SECTION -->
    <section class="banner" id="home">
        <img src="./assets/images/banner2.jpg" alt="">
    </section>
    <!-- BRANCH NAME SECTION -->
    <section class="branch">
        <h1 class="branch">Amarah's Corner - BF Resort Las Piñas Branch</h1>
        <h5 class="desc">We aim to be one of the most competitive Pizza Place nationwide. By Serving one of the best
            pizza that will satisfy your cravings.</h5>
    </section>
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
    <input type="hidden" name="" id="cartCount" value="<?php echo $cartCount; ?>">
    <!-- UPDATES SECTION -->
    <section class="updates" id="updates">
        <h3 class="title-header">Updates</h3>
        <div class="row">
            <?php
            $get_updates = mysqli_query($conn, "SELECT * FROM updates");

            foreach($get_updates as $updates) {
            ?>
            <!-- UPDATE 1 -->
            <div class="col">
                <div class="image-cont">
                    <img src="./assets/images/<?php echo $updates['updates_image'] ?>" alt="">
                </div>
                <h4>Posted on <?php echo $updates['updates_date']; ?></h4>
                <h5><?php echo $updates['updates_text']; ?></h5>
            </div>
            <?php } ?>
        </div> 
        <div id="load-more">
            <input type="submit" class="load-more" value="LOAD MORE">
        </div>
    </section>
    <!-- FEEDBACK SECTION -->
    <section class="feedbacks" id="feedbacks">
        <h3 class="title-header">FEEDBACKS</h3>
        <div class="feedbacks__cont">
            <!-- FEEDBACK 1 -->
            <div class="feedbacks__card">
                <div class="feedbacks__top">
                    <div class="feedbacks__user-profile">
                        <div class="feedbacks__user-profile__image">
                            <img class="img" src="./assets/images/B612_20220322_202642_720-min.jpg">
                        </div>
                        <div class="feedbacks__name-user">
                            <h4>Jennifer Sabado</h4>
                            <h5>@jennifer.sabado</h5>
                        </div>
                    </div>

                    <div class="feedbacks__rate">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                    </div>
                </div>
                <div class="feedbacks__comments">
                    <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates quos error reiciendis
                        pariatur
                        voluptate eos, mollitia sit explicabo corrupti dolores, fugiat saepe ad nulla ut!</h5>
                </div>
            </div>
            <!-- FEEDBACK 2 -->
            <div class="feedbacks__card">
                <div class="feedbacks__top">
                    <div class="feedbacks__user-profile">
                        <div class="feedbacks__user-profile__image">
                            <img class="img" src="./assets/images/Kaye.jpg">
                        </div>
                        <div class="feedbacks__name-user">
                            <h4>Kaye Billones</h4>
                            <h5>@kaye.billones</h5>
                        </div>
                    </div>

                    <div class="feedbacks__rate">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                    </div>
                </div>
                <div class="feedbacks__comments">
                    <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates quos error reiciendis
                        pariatur
                        voluptate eos, mollitia sit explicabo corrupti dolores, fugiat saepe ad nulla ut!</h5>
                </div>
            </div>
            <!-- FEEDBACK 3 -->
            <div class="feedbacks__card">
                <div class="feedbacks__top">
                    <div class="feedbacks__user-profile">
                        <div class="feedbacks__user-profile__image">
                            <img class="img" src="./assets/images/Mark.jpg">
                        </div>
                        <div class="feedbacks__name-user">
                            <h4>Mark Ryan Jancorda</strong>
                                <h5>@markryan.jancorda</h5>
                        </div>
                    </div>

                    <div class="feedbacks__rate">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                    </div>
                </div>
                <div class="feedbacks__comments">
                    <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates quos error reiciendis
                        pariatur
                        voluptate eos, mollitia sit explicabo corrupti dolores, fugiat saepe ad nulla ut!</h5>
                </div>
            </div>
            <!-- FEEDBACK 4 -->
            <div class="feedbacks__card">
                <div class="feedbacks__top">
                    <div class="feedbacks__user-profile">
                        <div class="feedbacks__user-profile__image">
                            <img class="img" src="./assets/images/Jovy.jpg">
                        </div>
                        <div class="feedbacks__name-user">
                            <h4>Jovelyn Ocampo</strong>
                                <h5>@jovelyn.ocampo</h5>
                        </div>
                    </div>

                    <div class="feedbacks__rate">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                    </div>
                </div>
                <div class="feedbacks__comments">
                    <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates quos error reiciendis
                        pariatur
                        voluptate eos, mollitia sit explicabo corrupti dolores, fugiat saepe ad nulla ut!</h5>
                </div>
            </div>
        </div>
        <div id="load-more-feedbacks">
            <input type="submit" class="load-more-feedbacks" value="LOAD MORE">
        </div>
    </section>

    <?php
    if(isset($_SESSION['cancelled'])) {
        echo "
            <script>
                $('#toast').addClass('active');
                $('.progress').addClass('active');
                $('#toast-icon').removeClass(
                    'fa-solid fa-triangle-exclamation').addClass(
                    'fa-solid fa-check warning');
                $('.text-1').text('Success!');
                $('.text-2').text('Order cancelled successfully!');
                setTimeout(() => {
                    $('#toast').removeClass('active');
                    $('.progress').removeClass('active');
                }, 5000);
            </script>
        ";
        unset($_SESSION['cancelled']);
    }

    if(isset($_SESSION['checkout'])) {
        echo "
            <script>
                $('#toast').addClass('active');
                $('.progress').addClass('active');
                $('#toast-icon').removeClass(
                    'fa-solid fa-triangle-exclamation').addClass(
                    'fa-solid fa-check warning');
                $('.text-1').text('Success!');
                $('.text-2').text('The order confirmation has been sent to your email account and mobile number!');
                setTimeout(() => {
                    $('#toast').removeClass('active');
                    $('.progress').removeClass('active');
                }, 5000);
            </script>
        ";
        unset($_SESSION['checkout']);
    }
    ?>



    <?php include './includes/footer.php';?>

    <?php include './includes/cart-count.php' ?>
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

        $(window).on('load', function() {
            $(document).ready(function() {
                if (window.location.href.indexOf("tracking") > -1) {
                    $('.tracking_wrapper').addClass('active');
                }
            });
        })
    </script>
</body>

</html>