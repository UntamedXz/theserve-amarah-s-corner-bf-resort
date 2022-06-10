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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cabin:wght@400;500;600;700;800&family=Poppins:wght@200;300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <title>Admin Panel</title>
</head>

<body>
    <?php include 'top.php'; ?>

        <!-- MAIN -->
        <main>
            <h1 class="title">Dashboard</h1>
            <ul class="breadcrumbs">
                <li><a href="#" class="active">Home</a></li>
            </ul>
            <section class="dashboard">
                <div class="dashboard-wrapper">
                    <!-- <div class="box">
                        <div class="titles">
                            <i class='bx bxs-category icon'></i>
                            <div class="label">
                                <span class="count">
                                    13
                                </span>
                                <span>Category</span>
                            </div>
                        </div>
                        <div class="hr"></div>
                        <div class="view">
                            <span>View Details</span>
                            <button><i class='bx bx-right-arrow-alt'></i></button>
                        </div>
                    </div>
                    <div class="box">
                        <div class="titles">
                            <i class='bx bxs-category icon'></i>
                            <div class="label">
                                <span class="count">
                                    13
                                </span>
                                <span>Subcategory</span>
                            </div>
                        </div>
                        <div class="hr"></div>
                        <div class="view">
                            <span>View Details</span>
                            <button><i class='bx bx-right-arrow-alt'></i></button>
                        </div>
                    </div>
                    <div class="box">
                        <div class="titles">
                            <i class='bx bxs-category icon'></i>
                            <div class="label">
                                <span class="count">
                                    13
                                </span>
                                <span>Product Variants</span>
                            </div>
                        </div>
                        <div class="hr"></div>
                        <div class="view">
                            <span>View Details</span>
                            <button><i class='bx bx-right-arrow-alt'></i></button>
                        </div>
                    </div>
                    <div class="box">
                        <div class="titles">
                            <i class='bx bxs-category icon'></i>
                            <div class="label">
                                <span class="count">
                                    13
                                </span>
                                <span>Products</span>
                            </div>
                        </div>
                        <div class="hr"></div>
                        <div class="view">
                            <span>View Details</span>
                            <button><i class='bx bx-right-arrow-alt'></i></button>
                        </div>
                    </div> -->

                    <div class="box">
                        <div class="titles">
                            <i class='bx bx-recycle'></i>
                            <div class="label">
                                <?php
                                $get_pending = mysqli_query($conn, "SELECT COUNT(order_status) as count FROM orders WHERE order_status = 1");

                                foreach($get_pending as $pending) {
                                ?>
                                <span class="count">
                                    <?php echo $pending['count'] ?>
                                </span>
                                <?php
                                }
                                ?>
                                <span>Pending Orders</span>
                            </div>
                        </div>
                        <div class="hr"></div>
                        <div class="view">
                            <span>View Details</span>
                            <button><i class='bx bx-right-arrow-alt'></i></button>
                        </div>
                    </div>
                    <div class="box">
                        <div class="titles">
                        <i class='bx bx-list-check' ></i>
                            <div class="label">
                            <?php
                                $get_pending = mysqli_query($conn, "SELECT COUNT(order_status) as count FROM orders WHERE order_status = 2");

                                foreach($get_pending as $confirmed) {
                                ?>
                                <span class="count">
                                    <?php echo $confirmed['count'] ?>
                                </span>
                                <?php
                                }
                                ?>
                                <span>Order Confirmed</span>
                            </div>
                        </div>
                        <div class="hr"></div>
                        <div class="view">
                            <span>View Details</span>
                            <button><i class='bx bx-right-arrow-alt'></i></button>
                        </div>
                    </div>
                    <div class="box">
                        <div class="titles">
                        <i class='bx bxs-bowl-hot' ></i>
                            <div class="label">
                            <?php
                                $get_pending = mysqli_query($conn, "SELECT COUNT(order_status) as count FROM orders WHERE order_status = 3");

                                foreach($get_pending as $preparing) {
                                ?>
                                <span class="count">
                                    <?php echo $preparing['count'] ?>
                                </span>
                                <?php
                                }
                                ?>
                                <span>Preparing Order</span>
                            </div>
                        </div>
                        <div class="hr"></div>
                        <div class="view">
                            <span>View Details</span>
                            <button><i class='bx bx-right-arrow-alt'></i></button>
                        </div>
                    </div>
                    <div class="box">
                        <div class="titles">
                        <i class='bx bxs-package' ></i>
                            <div class="label">
                            <?php
                                $get_pending = mysqli_query($conn, "SELECT COUNT(order_status) as count FROM orders WHERE order_status = 1");

                                foreach($get_pending as $to_be_received) {
                                ?>
                                <span class="count">
                                    <?php echo $to_be_received['count'] ?>
                                </span>
                                <?php
                                }
                                ?>
                                <span>To be Received</span>
                            </div>
                        </div>
                        <div class="hr"></div>
                        <div class="view">
                            <span>View Details</span>
                            <button><i class='bx bx-right-arrow-alt'></i></button>
                        </div>
                    </div>
                    <div class="box">
                        <div class="titles">
                        <i class='bx bx-fork' ></i>
                            <div class="label">
                            <?php
                                $get_pending = mysqli_query($conn, "SELECT COUNT(order_status) as count FROM orders WHERE order_status = 1");

                                foreach($get_pending as $delivered) {
                                ?>
                                <span class="count">
                                    <?php echo $delivered['count'] ?>
                                </span>
                                <?php
                                }
                                ?>
                                <span>Order Delivered</span>
                            </div>
                        </div>
                        <div class="hr"></div>
                        <div class="view">
                            <span>View Details</span>
                            <button><i class='bx bx-right-arrow-alt'></i></button>
                        </div>
                    </div>
                </div>

                
            </section>
            <?php include 'bottom.php' ?>
</body>

</html>