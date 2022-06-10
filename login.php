<?php
session_start();
if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    header("Location: ./index");
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/css/backup.css">
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

    <!-- LOGIN FORM -->
    <div class="login-form-container">
        <form id="login">
            <a href="#" class="logo"><img src="./assets/images/official_logo.png" alt=""></a>
            <h3>sign in</h3>
            <span>email/username</span>
            <input type="text" name="loginEmail" id="loginEmail" class="box" placeholder="enter your email"
                value="<?php if(isset($_COOKIE['email'])) {echo $_COOKIE['email'];} ?>">
            <input type="hidden" name="" id="error-email">
            <span>password</span>
            <input type="password" name="loginPassword" id="loginPassword" class="box" placeholder="enter your password" value="<?php if(isset($_COOKIE['password'])) {echo $_COOKIE['password'];} ?>">
            <input type="hidden" name="" id="error-password">
            <div class="checkbox">
                <input type="checkbox" name="rem" id="remember-me" <?php if(isset($_COOKIE['email']) && isset($_COOKIE['password'])) {echo "checked";} ?>>
                <label for="remember-me">remember me</label>
            </div>
            <input type="submit" name="login" value="sign in" class="btn">
            <p>forget password? <a href="#">click here</a></p>
            <p>don't have an account? <a href="register">create one</a></p>
        </form>
    </div>

    <?php include './includes/cart-count.php' ?>
    <script>
        $('#login').on('submit', function(e) {
            e.preventDefault();

            if ($('#loginEmail').val() == '') {
                $('#error-email').val('Input email or username!');
            } else {
                $('#error-email').val('');
            }

            if ($('#loginPassword').val() == '') {
                $('#error-password').val('Input password!');
            } else {
                $('#error-password').val('');
            }

            if ($('#error-email').val() != '') {
                $('#toast').addClass('active');
                $('.progress').addClass('active');
                $('.text-1').text('Error!');
                $('.text-2').text('Input email!');
                setTimeout(() => {
                    $('#toast').removeClass("active");
                    $('.progress').removeClass("active");
                }, 5000);
            } else if ($('#error-password').val() != '') {
                $('#toast').addClass('active');
                $('.progress').addClass('active');
                $('.text-1').text('Error!');
                $('.text-2').text('Input password!');
                setTimeout(() => {
                    $('#toast').removeClass("active");
                    $('.progress').removeClass("active");
                }, 5000);
            } else {
                $.ajax({
                    type: "POST",
                    url: "./functions/login-validation",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        if (response == 'email not registered') {
                            $('#toast').addClass('active');
                            $('.progress').addClass('active');
                            // $('#toast-icon').removeClass(
                            //     'fa-solid fa-triangle-exclamation').addClass(
                            //     'fa-solid fa-check warning');
                            $('.text-1').text('Error!');
                            $('.text-2').text('Email not registered!');

                            setTimeout(() => {
                                $('#toast').removeClass("active");
                                $('.progress').removeClass("active");
                            }, 5000);
                        }

                        if (response == 'wrong password') {
                            $('#toast').addClass('active');
                            $('.progress').addClass('active');
                            // $('#toast-icon').removeClass(
                            //     'fa-solid fa-triangle-exclamation').addClass(
                            //     'fa-solid fa-check warning');
                            $('.text-1').text('Error!');
                            $('.text-2').text('Wrong password');

                            setTimeout(() => {
                                $('#toast').removeClass("active");
                                $('.progress').removeClass("active");
                            }, 5000);
                        }

                        if (response == 'success') {
                            location.href = 'http://localhost/theserve-amarah-s-corner-las-pinas';
                        }

                        console.log(response);
                    }
                })
            }
        })
    </script>

    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js">
    </script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js">
    </script>
    <script src="./assets/js/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <script>
        // PRELOADER JS
        var loader = document.getElementById("preloader");

        window.addEventListener("load", function () {
            loader.style.display = "none";
            setTimeout(() => {
                document.querySelector(".toast").classList.remove("active");
            }, 5000);
        })
    </script>
</body>

</html>