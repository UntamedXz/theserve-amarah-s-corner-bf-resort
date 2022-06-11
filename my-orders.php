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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
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
            height: 100vh;
        }
    </style>
</head>

<body>
    <div id="preloader"></div>

    <?php include './includes/navbar.php';?>
    <input type="hidden" name="" id="cartCount" value="<?php echo $cartCount; ?>">

    <input type="hidden" id="profileIconCheck" value="<?php echo $userProfileIcon; ?>">

    <h1 style="text-align: center; font-size: 80px;">GAGO KA KAYE BILLONES <br>
    LALO KA NA PUTA KA RYAN</h1>

    <script>
        $(window).on('load', function() {
            if($('#profileIconCheck').val() == '') {
                $('#profileIcon').attr("src","./assets/images/no_profile_pic.png");
            } else {
                $('#profileIcon').attr("src","./assets/images/" + $('#profileIconCheck').val());
            }
        })
    </script>

    

    <?php include './includes/cart-count.php' ?>
    <script>
        var loader = document.getElementById("preloader");

        window.addEventListener("load", function () {
            loader.style.display = "none";
        })

        $('#profile-btn').on('click', function(e) {
            e.preventDefault();
            $('.tab-content #profile_details').css("display", "flex");
            $('.tab-content #profile_details').addClass('active');
            $('.tab-content #contact').removeClass('active');
            $('.tab-content #password').removeClass('active');
        })

        $('#contact-btn').on('click', function(e) {
            e.preventDefault();
            $('.tab-content #profile_details').css("display", "none");
            $('.tab-content #profile_details').removeClass('active');
            $('.tab-content #contact').addClass('active');
            $('.tab-content #password').removeClass('active');
        })

        $('#password-btn').on('click', function(e) {
            e.preventDefault();
            $('.tab-content #profile_details').css("display", "none");
            $('.tab-content #profile_details').removeClass('active');
            $('.tab-content #contact').removeClass('active');
            $('.tab-content #password').addClass('active');
        })

        // PROFILE IMAGE
        $(window).on('load', function() {
            var src = $('#old-profile-src').attr('src');
            var split = src.split('/');
            var oldProfileImg = split[split.length-1];

            if(oldProfileImg == 'no_profile_pic.png') {
                $('#remove').css("display", "none")
            } else {
                $('#remove').on('click', function(e) {
                    e.preventDefault();
                    var src = $('#old-profile-src').attr('src');
                    var split = src.split('/');
                    var oldProfileImg = split[split.length-1];
                    var user_id = $(this).data('id');

                    $.ajax({
                        type: "POST",
                        url: "./functions/delete-profile-image",
                        data: {
                            'delete': true,
                            'user_id': user_id,
                            'OldProfileImg': oldProfileImg,
                        },
                        success: function(response) {
                            if(response == 'success') {
                                location.reload();
                            }
                        }
                    })
                })
            }
        })

        // UPDATE PROFILE IMAGE
        $('#update_img').on('submit', function(e) {
            e.preventDefault();

            if($.trim($('#profile_pic').val()).length == 0) {
                $('.error-image').text('Insert image!');
            } else {
                var imageExt = $('#profile_pic').val().split('.').pop().toLowerCase();

                if($.inArray(imageExt, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                    $('.error-image').text('File not supported!');
                } else {
                    var imageSize = $('#profile_pic')[0].files[0].size;

                    if(imageSize > 10485760) {
                        $('.error-image').text('File too large!');
                    } else {
                        $.ajax({
                            url: "./functions/update-profile-picture",
                            type: "POST",
                            data: new FormData(this),
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function(response) {
                                if(response == 'success') {
                                    location.reload();
                                } else {
                                    alert(response);
                                }
                            }
                        })
                    }
                }
            }
        })

        // SUBMIT UPDATE PROFILE DETAILS
        $('#profile_details').on('submit', function(e){
            e.preventDefault()

            $.ajax({
                url: "./functions/update-profile-details",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    if(response == 'success') {
                        location.reload();
                    } else {
                        location.reload();
                    }
                }
            })
        })

        // SUBMIT UPDATE CONTACT
        $('#contact').on('submit', function(e){
            e.preventDefault()

            $.ajax({
                url: "./functions/update-contact",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    if(response == 'success') {
                        location.reload();
                    } else if(response == 'failed') {
                        location.reload();
                    }
                }
            })
        })

        // SUBMIT UPDATE PASSWORD
        $('#password').on('submit', function(e) {
            e.preventDefault();
            var old_password = $('#old_password').val();
            var new_password = $('#new_password').val();
            var confirm_password = $('#confirm_password').val();

            if($.trim(old_password).length == 0) {
                $('.error-old_password').text('Input old password!');
            } else if($.trim(old_password).length < 6) {
                $('.error-old_password').text('Password is too short!');
            } else {
                $('.error-old_password').text('');
            }

            if($.trim(new_password).length == 0) {
                $('.error-new_password').text('Input new password!');
            } else if($.trim(new_password).length < 6) {
                $('.error-new_password').text('Password is too short!');
            } else {
                $('.error-new_password').text('');
            }

            if($.trim(confirm_password).length == 0) {
                $('.error-confirm_password').text('Input confirm password!');
            } else if($.trim(confirm_password).length < 8) {
                $('.error-confirm_password').text('Password is too short!');
            } else {
                $('.error-confirm_password').text('');
            }

            if($('.error-old_password').text() != '' || $('.error-new_password').text() != '' || $('.error-confirm_password').text() != '') {
                $('#toast').addClass('active');
                $('.progress').addClass('active');
                $('.text-1').text('Error!');
                $('.text-2').text('Fill all required fields!');
                setTimeout(() => {
                    $('#toast').removeClass("active");
                    $('.progress').removeClass("active");
                }, 5000);
            } else {
                $.ajax({
                    type: "POST",
                    url: "./functions/update-password",
                    data: new FormData(this),
                    dataType: 'text',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        if(response == 'wrong password') {
                            $('#toast').addClass('active');
                            $('.progress').addClass('active');
                            $('.text-1').text('Error!');
                            $('.text-2').text('Wrong password!');
                            setTimeout(() => {
                                $('#toast').removeClass("active");
                                $('.progress').removeClass("active");
                            }, 5000);
                        } else if(response == 'password not matched!') {
                            $('#toast').addClass('active');
                            $('.progress').addClass('active');
                            $('.text-1').text('Error!');
                            $('.text-2').text('The password confirmation does not match!');
                            setTimeout(() => {
                                $('#toast').removeClass("active");
                                $('.progress').removeClass("active");
                            }, 5000);
                        } else if(response == 'success') {
                            location.reload();
                        }
                    }
                })
            }
        })
    </script>
</body>

</html>