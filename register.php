<?php 
session_start();
require_once './includes/database_conn.php';

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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

    <!-- REGISTRATION FORM -->
    <div class="reg-form-container">
        <form id="register">
            <a href="#" class="logo"><img src="./assets/images/official_logo.png" alt=""></a>
            <h3>sign up</h3>
            <div class="group_form">
                <div class="form_group">
                    <span>name</span>
                    <input type="text" class="box" name="reg-name" id="reg-name" placeholder="enter your name">
                    <span style="color: #dc3545; font-size: 12px; font-weight: 600;" id="error-name"></span>
                </div>
                <div class="form_group">
                    <span>Username</span>
                    <input type="text" name="reg-username" class="box" placeholder="enter your username" id="username"
                        value="">
                    <span style="color: #dc3545; font-size: 12px; font-weight: 600;" id="error-username"></span>
                </div>
            </div>
            <div class="group_form">
                <div class="form_group">
                    <span>email</span>
                    <input type="email" name="reg-email" class="box" placeholder="enter your email" id="reg-email" value="">
                    <span style="color: #dc3545; font-size: 12px; font-weight: 600;" id="error-email"></span>
                </div>
                <div class="form_group">
                    <span>Phone Number</span>
                    <input type="tel" name="reg-tel" id="reg-tel" class="box" placeholder="enter your phone number" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    <span style="color: #dc3545; font-size: 12px; font-weight: 600;" id="error-tel"></span>
                </div>
            </div>
            <div class="group_form">
                <div class="form_group">
                    <span>Gender</span>
                    <div class="gender">
                        <div class="gender_wrapper">
                            <input type="radio" name="gender" id="gender" value="FEMALE">
                            <label for="for female">FEMALE</label>
                        </div>
                        <div class="gender_wrapper">
                            <input type="radio" name="gender" id="gender" value="MALE">
                            <label for="for female">MALE</label>
                        </div>
                    </div>
                    <span style="color: #dc3545; font-size: 12px; font-weight: 600;" id="error-gender"></span>
                </div>
                <div class="form_group">
                    <span>Birthday</span>
                    <input type="date" name="reg-bday" id="reg-bday" class="box">
                    <span style="color: #dc3545; font-size: 12px; font-weight: 600;" id="error-bday"></span>
                </div>
            </div>
            <div class="group_form">
                <div class="form_group">
                    <span>password</span>
                    <input type="password" name="reg-password" class="box" placeholder="enter your password" id="password"
                        value="">
                        <span style="color: #dc3545; font-size: 12px; font-weight: 600;" id="error-password"></span>
                </div>
                <div class="form_group">
                    <span>confirm password</span>
                    <input type="password" name="reg-confirm-password" class="box" placeholder="enter confirm password" id="reg-confirm-password"
                        value="">
                        <span style="color: #dc3545; font-size: 12px; font-weight: 600;" id="error-confirm-password"></span>
                </div>
            </div>
            <input type="submit" name="register" value="sign up" class="btn">
            <p>have an account? <a href="login">login now</a></p>
        </form>
    </div>

    <?php include './includes/cart-count.php' ?>
    <script>
        $('#register').on('submit', function (e) {
            e.preventDefault();

            if($.trim($('#reg-name').val()).length == 0) {
                $('#error-name').text('Input name!');
            } else {
                $('#error-name').text('');
            }

            if ($.trim($('#username').val()).length == 0) {
                $('#error-username').text('Input username!');
            } else {
                $('#error-username').text('');
            }

            if ($.trim($('#reg-email').val()).length == 0) {
                $('#error-email').text('Input email!');
            } else {
                $('#error-email').text('');
            }

            if($.trim($('#reg-tel').val()).length == 0) {
                $('#error-tel').text('Input phone number!');
            } else {
                if($.trim($('#reg-tel').val()).length < 11) {
                    $('#error-tel').text('Phone number invalid!');
                } else {
                    $('#error-tel').text('');
                }
            }

            if($('input[name="gender"]:checked').length == 0) {
                $('#error-gender').text('Select gender!');
            } else {
                $('#error-gender').text('');
            }

            if($('#reg-bday').val().length == 0) {
                $('#error-bday').text('Input bday!');
            } else {
                var bday = $('#reg-bday').val();
                d = new Date(bday.split("/").reverse().join("-"))
                var curDate = new Date();

                curDate.setYear(curDate.getFullYear() - 18);
                if(curDate >= d) {
                    $('#error-bday').text('');
                } else {
                    $('#error-bday').text('You must be at least 18 years of age!');
                    setTimeout(() => {
                        $('#toast').removeClass("active");
                        $('.progress').removeClass("active");
                    }, 5000);
                }
            }

            if ($('#password').val() == '') {
                $('#error-password').text('Input password!');
            } else if($('#password').val().length < 8) {
                $('#error-password').text('Password too short');
            } else {
                $('#error-password').text('');
            }

            if ($('#reg-confirm-password').val() == '') {
                $('#error-confirm-password').text('Input confirm password');
            } else {
                if ($('#reg-confirm-password').val() != $('#password').val()) {
                    $('#error-confirm-password').text('The password confirmation does not match!');
                } else {
                    $('#error-confirm-password').text('');
                }
            }

            if($('#error-name').text() != '' || $('#error-username').text() != '' || $('#error-email').text() != '' || $('#error-tel').text() != '' || $('#error-gender').text() != '' || $('#error-bday').text() != '' || $('#error-password').text() != '' || $('#error-confirm-password').text() != '') {
                $('#toast').addClass('active');
                $('.progress').addClass('active');
                $('.text-1').text('Error!');
                $('.text-2').text('Fill all fields!');
                setTimeout(() => {
                    $('#toast').removeClass("active");
                    $('.progress').removeClass("active");
                }, 5000);
            } else {
                $.ajax({
                    type: "POST",
                        url: "./functions/register-validation",
                        data: new FormData(this),
                        dataType: 'text',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (response) {
                            if(response == 'Username already exist!') {
                                $('#toast').addClass('active');
                                $('.progress').addClass('active');
                                $('.text-1').text('Error!');
                                $('.text-2').text('Username already used!');
                                setTimeout(() => {
                                    $('#toast').removeClass("active");
                                    $('.progress').removeClass("active");
                                }, 5000);
                            } else if(response == 'Email already exist!') {
                                $('#toast').addClass('active');
                                $('.progress').addClass('active');
                                $('.text-1').text('Error!');
                                $('.text-2').text('Email already used!');
                                setTimeout(() => {
                                    $('#toast').removeClass("active");
                                    $('.progress').removeClass("active");
                                }, 5000);
                            } else if(response == 'Registered Successfully!') {
                                $('#toast').addClass('active');
                                $('.progress').addClass('active');
                                $('#toast-icon').removeClass(
                                    'fa-solid fa-triangle-exclamation').addClass(
                                    'fa-solid fa-check warning');
                                $('.text-1').text('Success!');
                                $('.text-2').text('Registered account successfully!');
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
    </script>

    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js">
    </script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js">
    </script>
    <script src="./assets/js/script.js"></script>
    <script>
        // PRELOADER JS
        var loader = document.getElementById("preloader");

        window.addEventListener("load", function () {
            loader.style.display = "none";
            setTimeout(() => {
                document.querySelector(".toast").classList.remove("active");
            }, 5000);
        })

        // CUSTOM ALERT JS
        document.querySelector('#close-alert').onclick = () => {
            alertbox.style.display = 'none';
        }
    </script>
</body>

</html>