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
    $getProfileInfo = mysqli_query($conn, "SELECT * FROM customers WHERE user_id = $userId");
    
    $rowInfo = mysqli_fetch_array($getProfileInfo);
    $bday = strtotime($rowInfo['user_birthday']);
    $str_bday = date("F j, Y", $bday);
    ?>
    <section class="account">
        <div class="account-wrapper">
            <div class="first-row">
                <div class="img-cont">
                    <?php
                    if($rowInfo['user_profile_image'] == '') {
                    ?>
                    <img src="./assets/images/no_profile_pic.png" alt="" id="old-profile-src">
                    <?php
                    } else {
                    ?>
                    <img src="./assets/images/<?php echo $rowInfo['user_profile_image']; ?>" alt="" id="old-profile-src">
                    <?php
                    }
                    ?>
                    <button data-id="<?php echo $userId ?>" id="remove">REMOVE</button>
                    <span style="color: #fff; font-size: 13px; font-weight: 800;" class="error-image"></span>
                    <form id="update_img">
                        <div class="form-group">
                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $userId; ?>">
                            <input type="hidden" name="old_profile_pic" id="old_profile_pic" value="<?php echo $rowInfo['user_profile_image'] ?>">
                        <input type="file" accept=".jpg, .jpeg, .png" name="profile_pic" id="profile_pic">
                        <button type="submit">UPDATE</button>
                        </div>
                    </form>
                </div>
                <div class="account-details">
                    <?php
                    if($rowInfo['name'] == '') {
                    ?>
                    <h1 class="name"><?php echo $rowInfo['username'] ?></h1>
                    <?php
                    } else {
                    ?>
                    <h1 class="name"><?php echo $rowInfo['name'] ?></h1>
                    <?php
                    }
                    ?>
                    <h3 class="type">Customer</h3>
                    <div class="tab">
                        <button id="profile-btn">PROFILE</button>
                        <button id="contact-btn">CONTACT</button>
                        <button id="password-btn">PASSWORD</button>
                    </div>
                </div>
            </div>
            <div class="second-row">
                <div class="profile-info">
                    <div class="my-profile">
                        <span class="myProfile">MY PROFILE</span>
                        <hr>
                        <div class="name-email-edit">
                            <div class="name-email">
                                <?php
                                if($rowInfo['name'] == '') {
                                ?>
                                <h1><?php echo $rowInfo['username'] ?></h1>
                                <?php
                                } else {
                                ?>
                                <h1><?php echo $rowInfo['name'] ?></h1>
                                <?php
                                }
                                ?>
                                <h3 style="word-wrap: break-all;"><?php echo $rowInfo['email'] ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="basic-information">
                        <span class="basicInformation">BASIC INFORMATION</span>
                        <hr>
                        <div class="basicInfoWrapper">
                            <span>Birthday: <strong><?php if($rowInfo['user_birthday'] != '0000-00-00') { echo $str_bday; }  ?></strong></span>
                            <span>Gender: <strong><?php echo $rowInfo['user_gender'] ?></strong></span>
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="profile-details">
                    <form id="profile_details">
                        <h1 class="profile-details">PROFILE DETAILS</h1>
                        <hr>
                        <input type="hidden" name="profile_details_id" id="" value="<?php echo $userId ?>">
                        <div class="form-group">
                            <span>Name</span>
                            <input type="text" name="customer_name" id="customer_name" placeholder="Input complete name" value="<?php echo $rowInfo['name'] ?>">
                        </div>
                        <div class="form-group">
                            <span>Username</span>
                            <input type="text" name="customer_username" id="customer_username" placeholder="Input username" value="<?php echo $rowInfo['username'] ?>">
                        </div>
                        <div class="form-group">
                            <span>Birthday</span>
                            <input type="date" name="customer_bday" id="customer_bday" value="<?php echo $rowInfo['user_birthday']; ?>">
                        </div>
                        <div class="form-group">
                            <span>Gender</span>
                            <div class="gender">
                              <input type="radio" name="gender" id="" value="FEMALE" <?php if($rowInfo['user_gender'] == "FEMALE") { echo "checked"; } ?>>
                                <label for="for female">FEMALE</label>
                                <input type="radio" name="gender" id="" value="MALE" <?php if($rowInfo['user_gender'] == "MALE") { echo "checked"; } ?>>
                                <label   for="for female">MALE</label>
                            </div>
                        </div>
                        <button type="submit">UPDATE</button>
                    </form>
                    <form id="contact">
                        <h1 class="profile-details">CONTACT</h1>
                        <hr>
                        <input type="hidden" name="profile_details_id" id="" value="<?php echo $userId ?>">
                        <div class="form-group">
                            <span>Phone Number</span>
                            <input type="tel" name="phone_number" id="phone_number" placeholder="Input phone number" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="11" value="<?php echo $rowInfo['phone_number'] ?>">
                        </div>
                        <div class="form-group">
                            <span>Email</span>
                            <input type="email" name="contact-email" id="" value="<?php echo $rowInfo['email'] ?>">
                        </div>
                        <button type="submit">UPDATE</button>
                    </form>

                    <form id="password">
                        <h1 class="profile-details">PASSWORD</h1>
                        <hr>
                        <input type="hidden" name="password_id" id="" value="<?php echo $userId ?>">
                        <div class="form-group">
                            <span>Old Password</span>
                            <input type="password" name="old_password" id="old_password" placeholder="Input old password">
                            <span style="color: #000; font-size: 13px; font-weight: 800;" class="error-old_password"></span>
                        </div>
                        <div class="form-group">
                            <span>New Password</span>
                            <input type="password" name="new_password" id="new_password" placeholder="Input new password">
                            <span style="color: #000; font-size: 13px; font-weight: 800;" class="error-new_password"></span>
                        </div>
                        <div class="form-group">
                            <span>Confirm Password</span>
                            <input type="password" name="confirm_password" id="confirm_password" placeholder="Input confirm password">
                            <span style="color: #000; font-size: 13px; font-weight: 800;" class="error-confirm_password"></span>
                        </div>
                        <button type="submit">UPDATE</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- FOR PROFILE VALIDATION -->
    <?php
    if(isset($_SESSION['profile'])) {
        $alert = $_SESSION['profile'];
        if($alert == 'success') {
            echo "
            <script>
                $('.tab-content #profile_details').css('display', 'flex');
                $('.tab-content #profile_details').addClass('active');
                $('.tab-content #contact').removeClass('active');
                $('.tab-content #password').removeClass('active');
                $('#toast').addClass('active');
                $('.progress').addClass('active');
                $('#toast-icon').removeClass('fa-solid fa-triangle-exclamation').addClass('fa-solid fa-check warning');
                $('.text-1').text('Success!');
                $('.text-2').text('Profile updated successfully!');
    
                setTimeout(() => {
                $('#toast').removeClass('active');
                $('.progress').removeClass('active');
                }, 5000);
                </script>
            ";
            unset($_SESSION['profile']);
        } else if($alert == 'failed') {
            echo "
            <script>
                $('.tab-content #profile_details').css('display', 'flex');
                $('.tab-content #profile_details').addClass('active');
                $('.tab-content #contact').removeClass('active');
                $('.tab-content #password').removeClass('active');
                $('#toast').addClass('active');
                $('.progress').addClass('active');
                $('.text-1').text('Error!');
                $('.text-2').text('Email already used!');
                setTimeout(() => {
                $('#toast').removeClass('active');
                $('.progress').removeClass('active');
                }, 5000);
                </script>
            ";
            unset($_SESSION['profile']);
        } else {
            echo "
            <script>
                $('.tab-content #profile_details').css('display', 'flex');
                $('.tab-content #profile_details').addClass('active');
                $('.tab-content #contact').removeClass('active');
                $('.tab-content #password').removeClass('active');
                $('#toast').addClass('active');
                $('.progress').addClass('active');
                $('.text-1').text('Error!');
                $('.text-2').text('Something went wrong!');
                setTimeout(() => {
                $('#toast').removeClass('active');
                $('.progress').removeClass('active');
                }, 5000);
                </script>
            ";
            unset($_SESSION['profile']);
        }
    } else {
        $alert = '';
    }
    ?>

    <!-- FOR CONTACT VALIDATION -->
    <?php
    if(isset($_SESSION['contact'])) {
        $alert = $_SESSION['contact'];
        if($alert == 'success') {
            echo "
            <script>
                $('.tab-content #profile_details').css('display', 'none');
                $('.tab-content #profile_details').removeClass('active');
                $('.tab-content #contact').addClass('active');
                $('.tab-content #password').removeClass('active');
                $('#toast').addClass('active');
                $('.progress').addClass('active');
                $('#toast-icon').removeClass('fa-solid fa-triangle-exclamation').addClass('fa-solid fa-check warning');
                $('.text-1').text('Success!');
                $('.text-2').text('Contact updated successfully!');
    
                setTimeout(() => {
                $('#toast').removeClass('active');
                $('.progress').removeClass('active');
                }, 5000);
                </script>
            ";
            unset($_SESSION['contact']);
        } else if($alert == 'failed') {
            echo "
            <script>
                $('.tab-content #profile_details').css('display', 'none');
                $('.tab-content #profile_details').removeClass('active');
                $('.tab-content #contact').addClass('active');
                $('.tab-content #password').removeClass('active');
                $('#toast').addClass('active');
                $('.progress').addClass('active');
                $('.text-1').text('Error!');
                $('.text-2').text('Email already used!');
                setTimeout(() => {
                $('#toast').removeClass('active');
                $('.progress').removeClass('active');
                }, 5000);
                </script>
            ";
            unset($_SESSION['contact']);
        } else {
            echo "
            <script>
                $('.tab-content #profile_details').css('display', 'none');
                $('.tab-content #profile_details').removeClass('active');
                $('.tab-content #contact').addClass('active');
                $('.tab-content #password').removeClass('active');
                $('#toast').addClass('active');
                $('.progress').addClass('active');
                $('.text-1').text('Error!');
                $('.text-2').text('Something went wrong!');
                setTimeout(() => {
                $('#toast').removeClass('active');
                $('.progress').removeClass('active');
                }, 5000);
                </script>
            ";
            unset($_SESSION['contact']);
        }
    } else {
        $alert = '';
    }
    ?>

<?php
    if(isset($_SESSION['password'])) {
        $alert = $_SESSION['password'];
        if($alert == 'success') {
            echo "
            <script>
                $('.tab-content #profile_details').css('display', 'none');
                $('.tab-content #profile_details').removeClass('active');
                $('.tab-content #contact').removeClass('active');
                $('.tab-content #password').addClass('active');
                $('#toast').addClass('active');
                $('.progress').addClass('active');
                $('#toast-icon').removeClass('fa-solid fa-triangle-exclamation').addClass('fa-solid fa-check warning');
                $('.text-1').text('Success!');
                $('.text-2').text('Password updated successfully!');
    
                setTimeout(() => {
                $('#toast').removeClass('active');
                $('.progress').removeClass('active');
                }, 5000);
                </script>
            ";
            unset($_SESSION['password']);
        } else {
            echo "
            <script>
                $('.tab-content #profile_details').css('display', 'none');
                $('.tab-content #profile_details').removeClass('active');
                $('.tab-content #contact').addClass('active');
                $('.tab-content #password').removeClass('active');
                $('#toast').addClass('active');
                $('.progress').addClass('active');
                $('.text-1').text('Error!');
                $('.text-2').text('Something went wrong!');
                setTimeout(() => {
                $('#toast').removeClass('active');
                $('.progress').removeClass('active');
                }, 5000);
                </script>
            ";
            unset($_SESSION['password']);
        }
    } else {
        $alert = '';
    }
    ?>

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

        $('.close').on('click', function(e) {
        $('#toast').removeClass("active");
        $('.progress').removeClass("active");
        })
    </script>
</body>

</html>