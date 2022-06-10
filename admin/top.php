<div id="preloader"></div>

<!-- SIDEBAR -->
<section id="sidebar">
    <div class="logo__details">
        <img src="../assets/images/official_logo_crop.png" alt="logo">
        <h1>Amarah's Corner</h1>
    </div>
    <ul class="side-menu">
        <li><a href="index" class="active"><i class='bx bxs-dashboard icon'></i>Dashboard</a></li>
        <li class="divider" data-text="social">Social</li>
        <li>
            <a href="#"><i class='bx bx-edit icon'></i>Updates <i class="bx bx-chevron-right icon-right"></i></a>
            <ul class="side-dropdown">
                <li><a href="#">Insert Update</a></li>
                <li><a href="#">View Update</a></li>
            </ul>
        </li>
        <li><a href="#"><i class='bx bx-chat icon'></i>Messages</a></li>
        <li class="divider" data-text="categories">Categories</li>
        <li>
        <li><a href="category"><i class='bx bxs-category icon'></i>Category</a></li>
        <li><a href="subcategory"><i class='bx bxs-category-alt icon'></i>Sub Category</a></li>
        </li>
        <li class="divider" data-text="product">Product</li>
        <li>
        <li><a href="product-variant"><i class='bx bx-list-plus icon'></i>Product Variants</a></li>
        <li><a href="product"><i class='bx bxs-bowl-hot icon'></i>Products</a></li>
        </li>
        <li class="divider" data-text="orders">orders</li>
        <li>
            <a href="order"><i class='bx bxs-cart icon'></i>Orders</a>
        </li>
        <li>
            <a href="order-delivered"><i class='bx bx-package icon'></i>Order Delivered</a>
        </li>
        <li class="divider" data-text="settings">settings</li>
        <li>
            <a href="users"><i class='bx bxs-user-circle icon'></i>Users</a>
            <!-- <a href="#"><i class='bx bxs-palette icon'></i>Home Appearance</a>
            <a href="#"><i class='bx bxs-cog icon'></i>Admin Settings</a> -->
        </li>
    </ul>
</section>
<!-- SIDEBAR -->

<!-- NAVBAR -->
<section id="content">
    <!-- NAVBAR -->
    <nav>
        <i class="bx bx-menu toggle-sidebar"></i>
        <form action="#" class="search-form">
            <div class="form-group">
                <input type="text" placeholder="Search here...">
                <i class="bx bx-search icon"></i>
            </div>
        </form>
        <div class="right">
            <div class="icons">
                <a href="#" id="search-btn" class="nav-link">
                    <i class="bx bx-search icon"></i>
                </a>
                <a href="#" class="nav-link">
                    <i class="bx bxs-bell"></i>
                    <span class="badge">5</span>
                </a>
                <a href="#" class="nav-link">
                    <i class="bx bxs-message-square-dots"></i>
                    <span class="badge">8</span>
                </a>
            </div>
            <span class="divider"></span>
            <div class="profile">
                <img style="border: 2px solid #ffaf08;" id="profileIcon" src="">
                <ul class="profile-link">
                    <li><a href="profile"><i class="bx bxs-user-circle icon"></i>Profile</a></li>
                    <li><a href="./functions/logout"><i class="bx bxs-log-out-circle"></i>Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- NAVBAR -->

    <input type="hidden" id="profileIconCheck" value="<?php echo $userProfileIcon; ?>">

    <script>
        $(window).on('load', function() {
            if($('#profileIconCheck').val() == '') {
                $('#profileIcon').attr("src","../assets/images/no_profile_pic.png");
            } else {
                $('#profileIcon').attr("src","../assets/images/" + $('#profileIconCheck').val());
            }
        })
    </script>

    <div id="overlay" class="hide"></div>