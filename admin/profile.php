<?php
session_start();
if (!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin'] != true) {
    header("Location: ./login");
} else {
    $admin_id = $_SESSION['admin_id'];
}
require_once '../includes/database_conn.php';

$get_admin_info = mysqli_query($conn, "SELECT * FROM admin WHERE admin_id = $admin_id");

$info = mysqli_fetch_array($get_admin_info);

$userProfileIcon = $info['profile_image'];

$admin_id = $_SESSION['admin_id'];

$get_admin_acc = mysqli_query($conn, "SELECT * FROM admin WHERE admin_id = $admin_id");

$row = mysqli_fetch_array($get_admin_acc);
$admin_username = $row['admin_username'];
$admin_email = $row['admin_email'];
$admin_password = $row['admin_password'];
$profile_image = $row['profile_image'];
$admin_type = $row['admin_type'];
$admin_name = $row['admin_name'];
$admin_phone_number = $row['admin_phone_number'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


    <!-- datatable lib -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Cabin:wght@400;500;600;700;800&family=Poppins:wght@200;300;400;500;600;700&display=swap">

    <link rel="stylesheet" href="../assets/css/admin.css">
    <title>Admin Panel</title>
</head>

<body>
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

    <?php include 'top.php';?>

    <!-- MAIN -->
    <main>
        <h1 class="title">View Profile</h1>
        <ul class="breadcrumbs">
            <li><a href="index">Home</a></li>
            <li class="divider">/</li>
            <li><a href="profile" class="active">View Profile</a></li>
        </ul>
        <section class="profile">
            <div class="account-wrapper">
                <div class="first-row">
                    <div class="img-cont">
                        <?php
                        if($profile_image == '') {
                        ?>
                        <img src="../assets/images/no_profile_pic.png" alt="" id="old-profile-src">
                        <?php
                        } else {
                        ?>
                        <img src="../assets/images/<?php echo $profile_image; ?>" alt="" id="old-profile-src">
                        <?php
                        }
                        ?>
                        <button data-id="<?php echo $admin_id ?>" id="remove">REMOVE</button>
                        <span style="color: #dc3545; font-size: 12px;" class="error-image"></span>
                        <form id="update_img">
                            <div class="form-group">
                                <input type="hidden" name="admin_id" id="admin_id" value="<?php echo $admin_id; ?>">
                                <input type="hidden" name="old_profile_pic" id="old_profile_pic"
                                    value="<?php echo $rowInfo['user_profile_image'] ?>">
                                <input type="file" accept=".jpg, .jpeg, .png" name="profile_pic" id="profile_pic">
                                <button type="submit">UPDATE</button>
                            </div>
                        </form>
                    </div>
                    <div class="account-details">
                        <?php
                        if($admin_name == '') {
                        ?>
                        <h1 class="name"><?php echo $admin_username ?></h1>
                        <?php
                        } else {
                        ?>
                        <h1 class="name"><?php echo $admin_name ?></h1>
                        <?php
                        }
                        $get_admin_type = mysqli_query($conn, "SELECT * FROM admin_type WHERE admin_type_id = $admin_type");

                        $row = mysqli_fetch_array($get_admin_type);

                        $type = $row['admin_type'];
                        ?>
                        <h3 class="type"><?php echo strtoupper($type); ?></h3>
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
                                    if($admin_name == '') {
                                    ?>
                                    <h1><?php echo $admin_username ?></h1>
                                    <?php
                                    } else {
                                    ?>
                                    <h1><?php echo $admin_name ?></h1>
                                    <?php
                                    }
                                    ?>
                                    <h3 style="word-wrap: break-all;"><?php echo $admin_email; ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content" id="profile-details">
                        <form id="profile_details">
                            <h1 class="profile-details">PROFILE DETAILS</h1>
                            <hr>
                            <input type="hidden" name="profile_details_id" id="" value="<?php echo $admin_id ?>">
                            <div class="form-group">
                                <span>Name</span>
                                <input type="text" name="admin_name" id="admin_name"
                                    placeholder="Input complete name" value="<?php echo $admin_name; ?>">
                            </div>
                            <div class="form-group">
                                <span>Username</span>
                                <input type="text" name="admin_username" id="admin_username"
                                    placeholder="Input username" value="<?php echo $admin_username; ?>">
                            </div>
                            <button type="submit">UPDATE</button>
                        </form>
                        <form id="contact">
                            <h1 class="profile-details">CONTACT</h1>
                            <hr>
                            <input type="hidden" name="profile_details_id" id="" value="<?php echo $admin_id ?>">
                            <div class="form-group">
                                <span>Phone Number</span>
                                <input type="tel" name="phone_number" id="phone_number" placeholder="Input phone number"
                                    onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="11" minlength="11"
                                    value="<?php echo $admin_phone_number; ?>">
                            </div>
                            <div class="form-group">
                                <span>Email</span>
                                <input type="email" name="contact-email" id="" value="<?php echo $admin_email; ?>">
                            </div>
                            <button type="submit">UPDATE</button>
                        </form>

                        <form id="password">
                            <h1 class="profile-details">PASSWORD</h1>
                            <hr>
                            <input type="hidden" name="password_id" id="" value="<?php echo $admin_id ?>">
                            <div class="form-group">
                                <span>Old Password</span>
                                <input type="password" name="old_password" id="old_password"
                                    placeholder="Input old password">
                                <span style="color: #dc3545; font-size: 12px;" class="error-old_password"></span>
                            </div>
                            <div class="form-group">
                                <span>New Password</span>
                                <input type="password" name="new_password" id="new_password"
                                    placeholder="Input new password">
                                <span style="color: #dc3545; font-size: 12px;" class="error-new_password"></span>
                            </div>
                            <div class="form-group">
                                <span>Confirm Password</span>
                                <input type="password" name="confirm_password" id="confirm_password"
                                    placeholder="Input confirm password">
                                <span style="color: #dc3545; font-size: 12px;" class="error-confirm_password"></span>
                            </div>
                            <button type="submit">UPDATE</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- FOR PROFILE VALIDATION -->
        <?php
        if(isset($_SESSION['admin_profile'])) {
            $alert = $_SESSION['admin_profile'];
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
                unset($_SESSION['admin_profile']);
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
                unset($_SESSION['admin_profile']);
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
                unset($_SESSION['admin_profile']);
            }
        } else {
            $alert = '';
        }
        ?>

            <!-- FOR CONTACT VALIDATION -->
            <?php
        if(isset($_SESSION['admin_contact'])) {
            $alert = $_SESSION['admin_contact'];
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
                unset($_SESSION['admin_contact']);
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
                unset($_SESSION['admin_contact']);
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
                unset($_SESSION['admin_contact']);
            }
        } else {
            $alert = '';
        }
        ?>
        <?php
        if(isset($_SESSION['admin_password'])) {
            $alert = $_SESSION['admin_password'];
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
                unset($_SESSION['admin_password']);
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
                unset($_SESSION['admin_password']);
            }
            } else {
                $alert = '';
            }
            ?>

        <script>
            $('#profile-btn').on('click', function (e) {
                e.preventDefault();
                $('.tab-content #profile_details').css("display", "flex");
                $('.tab-content #profile_details').addClass('active');
                $('.tab-content #contact').removeClass('active');
                $('.tab-content #password').removeClass('active');
            })

            $('#contact-btn').on('click', function (e) {
                e.preventDefault();
                $('.tab-content #profile_details').css("display", "none");
                $('.tab-content #profile_details').removeClass('active');
                $('.tab-content #contact').addClass('active');
                $('.tab-content #password').removeClass('active');
            })

            $('#password-btn').on('click', function (e) {
                e.preventDefault();
                $('.tab-content #profile_details').css("display", "none");
                $('.tab-content #profile_details').removeClass('active');
                $('.tab-content #contact').removeClass('active');
                $('.tab-content #password').addClass('active');
            })

            // PROFILE IMAGE
            $(window).on('load', function () {
                var src = $('#old-profile-src').attr('src');
                var split = src.split('/');
                var oldProfileImg = split[split.length - 1];

                if (oldProfileImg == 'no_profile_pic.png') {
                    $('#remove').css("display", "none")
                } else {
                    $('#remove').on('click', function (e) {
                        e.preventDefault();
                        var src = $('#old-profile-src').attr('src');
                        var split = src.split('/');
                        var oldProfileImg = split[split.length - 1];
                        var admin_id = $(this).data('id');

                        $.ajax({
                            type: "POST",
                            url: "./functions/delete-profile-image",
                            data: {
                                'delete': true,
                                'admin_id': admin_id,
                                'OldProfileImg': oldProfileImg,
                            },
                            success: function (response) {
                                if (response == 'success') {
                                    location.reload();
                                }
                                console.log(response);
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
                    console.log(response);
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
            } else if($.trim(old_password).length < 8) {
                $('.error-old_password').text('Password is too short!');
            } else {
                $('.error-old_password').text('');
            }

            if($.trim(new_password).length == 0) {
                $('.error-new_password').text('Input new password!');
            } else if($.trim(new_password).length < 8) {
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
                        console.log(response);
                    }
                })
            }
        })
        </script>

        <?php include 'bottom.php'?>

</body>

</html>