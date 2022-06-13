<?php
session_start();
if (isset($_SESSION['admin_id']) && !empty($_SESSION['id'])) {
    header("Location: ./index");
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cabin:wght@400;500;600;700;800&family=Poppins:wght@200;300;400;500;600;700&display=swap">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <title>Login - Admin Panel</title>

    <style>
        body {
            background: url(../assets/images/background.png);
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            background-attachment: fixed;
            height: 100vh;
        }

        @media (min-width: 768px) {
            .toast {
                top: 20px;
            }
        }
    </style>
</head>

<body>
    <div id="preloader"></div>

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
        <form id="admin_login">
            <a href="#" class="logo"><img src="../assets/images/official_logo.png" alt=""></a>
            <h3>sign in</h3>
            <span>email/username</span>
            <input type="text" id="email_username" name="email_username" class="box" placeholder="enter your email or username" value="<?php if (isset($_SESSION['admin_email'])) { echo $_SESSION['admin_email']; } if(isset($_COOKIE['admin_email'])) { echo $_COOKIE['admin_email']; } ?>">
            <input type="hidden" name="" id="error-email">
            <span>password</span>
            <input type="password" id="password" name="password" class="box" placeholder="enter your password" value="<?php if(isset($_COOKIE['admin_password'])) { echo $_COOKIE['admin_password']; } ?>">
            <input type="hidden" name="" id="error-password">
            <div class="checkbox">
                <input type="checkbox" name="rem" id="remember-me" <?php if(isset($_COOKIE['admin_email']) && isset($_COOKIE['admin_password'])) { echo "checked"; } ?>>
                <label for="remember-me">remember me</label>
            </div>
            <input type="submit" name="login" value="sign in" class="btn">
            <p>forget password? <a href="#">click here</a></p>
        </form>
    </div>

    <script>
        $('#admin_login').on('submit', function(e) {
            e.preventDefault();

            if ($('#email').val() == '') {
                $('#error-email').val('Input email or username!');
            } else {
                $('#error-email').val('');
            }

            if ($('#password').val() == '') {
                $('#error-password').val('Input password!');
            } else {
                $('#error-password').val('');
            }

            if ($('#error-email').val() != '') {
                $('#toast').addClass('active');
                $('.progress').addClass('active');
                $('.text-1').text('Error!');
                $('.text-2').text('Input email or username!');

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
                        } else if (response == 'wrong password') {
                            $('#toast').addClass('active');
                            $('.progress').addClass('active');
                            $('.text-1').text('Error!');
                            $('.text-2').text('Wrong password');

                            setTimeout(() => {
                                $('#toast').removeClass("active");
                                $('.progress').removeClass("active");
                            }, 5000);
                        } else if (response == 'success') {
                            window.location.replace("index");
                        } else if(response == 'email or username not registered') {
                            $('#toast').addClass('active');
                            $('.progress').addClass('active');
                            $('.text-1').text('Error!');
                            $('.text-2').text('Email or Username not registered!');

                            setTimeout(() => {
                                $('#toast').removeClass("active");
                                $('.progress').removeClass("active");
                            }, 5000);
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
                        console.log(response);
                    }
                })
            }
        })

        // PRELOADER JS
        var loader = document.getElementById("preloader");

        window.addEventListener("load", function() {
            loader.style.display = "none";
            setTimeout(() => {
                document.querySelector(".toast").classList.remove("active");
            }, 5000);
        })
    </script>
</body>

</html>