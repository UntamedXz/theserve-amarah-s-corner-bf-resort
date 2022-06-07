<!-- BACKGROUND OVERLAY -->
<div id="backgroundOverlay"></div>
<header class="header">
    <!-- NAVIGATION BAR 1 -->
    <div class="header-1">
        <a href="#" class="logo"><img src="./assets/images/official_logo.png" alt=""></a>
        <form action="#" class="search-form">
            <input type="text" name="search-input" id="search-input" placeholder="search here...">
            <label for="search-input" class="bx bx-search-alt-2"></label>
        </form>
        <div class="left">
            <div id="search-btn" class="bx bx-search-alt-2"></div>
            <a href="cart" class="nav-link">
                <i class="bx bxs-cart"></i>
                <span class="badge"></span>
            </a>
            <a href="login" id="login-btn" class="bx bxs-user loginBtn"></a>
            <div id="navbar" class="bx bx-menu-alt-right"></div>
            <div class="profile">
                <img id="profileIcon" src="" alt="">
                <ul class="profile-link">
                    <li><a href="http://localhost/theserve-amarah-s-corner-las-pinas/account"><i class="bx bxs-user-circle icon"></i>Profile</a></li>
                    
                    <li><a href="./includes/logout"><i class="bx bxs-log-out-circle"></i>Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
<!-- NAVIGATION BAR 2 -->
<nav class="custom-nav">
    <a href="http://localhost/theserve-amarah-s-corner-las-pinas">home</a>
    <a href="http://localhost/theserve-amarah-s-corner-las-pinas/#menu">menu</a>
    <a href="http://localhost/theserve-amarah-s-corner-las-pinas/#updates">updates</a>
    <a href="http://localhost/theserve-amarah-s-corner-las-pinas/#feedbacks">feedback</a>
    <a href="#">contact</a>
</nav>
<!-- MOBILE NAVIGATION MENU -->
<nav class="dropdown-nav">
    <div class="bx bxs-x-square" id="close-menu"></div>
    <a href="http://localhost/theserve-amarah-s-corner-las-pinas">home</a>
    <a href="index#menu">menu</a>
    <a href="#updates">updates</a>
    <a href="#feedbacks">feedback</a>
    <a href="#">contact</a>
</nav>

<script>
    // PROFILE DROPDOWN
    const profile = document.querySelector('.profile');
    const imgProfile = profile.querySelector('img');
    const dropdownProfile = profile.querySelector('.profile-link');

    imgProfile.addEventListener('click', function() {
        dropdownProfile.classList.toggle('show');
    })

    window.addEventListener('click', function(e) {
        if (e.target !== imgProfile) {
            if (e.target !== dropdownProfile) {
                if (dropdownProfile.classList.contains('show')) {
                    dropdownProfile.classList.remove('show');
                }
            }
        }
    })
</script>

<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
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

<?php include './includes/cart-count.php' ?>