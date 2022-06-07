<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <!-- ===== ===== Remix Font Icons Cdn ===== ===== -->
    <link rel="stylesheet" href="fonts/remixicon.css">
    <link rel="stylesheet" href="./assets/css/customerProfile.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Amarah's Corner - BF Resort Las Piñas</title>

    <style>
        body {
            background: url(./assets/images/navbar.png) no-repeat;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            height: 100vh;
        }
    </style>

    <style>
        /* ===== =====>> Css Variables  <<===== =====  */
:root {
  /* =====>>  Font Color  <<===== */
  --f1-color: #fff;
  --f2-color: #ffaf08;
  --f3-color: rgba(0, 0, 0, 0.8);
  --f4-color: rgba(0, 0, 0, 0.6);
  --f5-color: #ffaf08;
  --f6-color: #88cee6;

  /* =====>>  Background Color  <<===== */
  --bg1-color: rgb(0, 0, 0);
  --bg2-color: #000;
  --bg3-color: #ffaf08;
  --bg4-color: #ffaf08;
  --bg5-color: #ffaf08;
  --bg6-color: rgba(0, 0, 0, 0.4);
  --bg7-color: rgba(0, 0, 0, 0.2);
  --glass-bg: linear-gradient(
    to right bottom,
    rgba(255, 255, 255, 0.575),
    rgba(255, 255, 255, 0.3)
  );
  --C-lg-bg: linear-gradient(45deg, #ff3399, #ff9933);

  /* ===== =====>>  Font Size  <<===== =====  */
  --xxxl-fs: 2.2rem;
  --xxl-fs: 1.8rem;
  --xl-fs: 1.6rem;
  --l-fs: 1.4rem;
  --m-fs: 1.2rem;
  --s-fs: 1.1rem;
  --xs-fs: 1rem;

  /* =====>>  Margin  <<===== */
  --m-2-5: 2.5rem;
  --m-1-8: 1.8rem;
  --m-1-5: 1.5rem;
  --m-0-6: 0.6rem;
  --m-0-5: 0.5rem;
  --m-0-3: 0.3rem;

  /* =====>>  Padding  <<===== */
  --p-2-5: 2.5rem;
  --p-1-5: 1.5rem;
  --p-1-0: 1rem;
  --p-0-8: 0.8rem;
  --p-0-5: 0.5rem;
  --p-0-4: 0.4rem;
  --p-0-3: 0.3rem;
}

/* ===== =====>>  Body Css  <<===== =====  */


/* ===== =====>>  Body Main-Background Css  <<===== =====  */
.main_bg {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: url(bg.png);
  background-position: left;
  z-index: -1;
  filter: blur(10px);
}

/* ===== =====>>  Main-Container Css  <<===== =====  */
.container {
  display: grid;
  grid-template-columns: 1fr 2fr;
  grid-template-areas:
    "header header"
    "userProfile userDetails"
    "work_skills timeline_about"
    "work_skills timeline_about";
  width: 100%;
  height: 100vh;
  background: var(--glass-bg);
  padding: var(--p-1-5);
  box-shadow: 0 0 5px rgba(255, 255, 255, 0.5), 0 0 25px rgba(0, 0, 0, 0.08);
}
/* ===== =====>>  Container Cards Grid-Area Css Start  <<===== =====  */
header {
  grid-area: header;
}

.userProfile {
  grid-area: userProfile;
}

.work_skills {
  grid-area: work_skills;
}

.userDetails {
  grid-area: userDetails;
}

.timeline_about {
  grid-area: timeline_about;
}

/* ===== =====>>  Container Cards Css  <<===== =====  */
.container .card {
  background: var(--glass-bg);
  backdrop-filter: blur(3rem);
  border-radius: 0.5rem;
  box-shadow: 0 0 25px rgba(0, 0, 0, 0.05);
  padding: var(--p-1-5);
}

/* ===== =====>>  Container Header/Navbar Css  <<===== =====  */
.eh{
    align-items: center;
    justify-content: center;
}

/* ===== =====>>  User Main-Profile Css Start  <<===== ===== */
.container .userProfile {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 0;
  background: none;
  backdrop-filter: none;
  box-shadow: none;
}

.container .userProfile .profile figure img {
  width: 18rem;
  height: 18rem;
  border-radius: 50%;
}

/* ===== =====>>  Work & Skills Css Start  <<===== ===== */
.container .work_skills {
  padding: var(--p-1-5);
}

.work_skills .work .heading,
.work_skills .skills .heading {
  position: relative;
  font-size: var(--xs-fs);
  color: rgba(0, 0, 0, 0.6);
  text-transform: uppercase;
  margin-bottom: var(--m-1-5);
}

.work_skills .work .heading::before,
.work_skills .skills .heading::before {
  content: "";
  position: absolute;
  bottom: 0;
  right: 0;
  height: 0.1rem;
  width: 88%;
  background: var(--bg6-color);
}

.work_skills .work .primary,
.work_skills .work .secondary {
  position: relative;
}

.work_skills .work .primary h1,
.work_skills .work .secondary h1 {
  font-size: var(--l-fs);
  color: var(--f3-color);
  margin-bottom: var(--m-0-6);
}

.work_skills .work .primary span,
.work_skills .work .secondary span {
  position: absolute;
  top: 0;
  right: 3rem;
  font-weight: 700;
  font-size: var(--s-fs);
  color: var(--f5-color);
  background: #000000;
  padding: var(--p-0-4) var(--p-1-0);
  border-radius: 0.4rem;
}

.work_skills .work .primary p,
.work_skills .work .secondary p {
  margin-bottom: var(--m-1-8);
  font-size: var(--m-fs);
  color: rgba(0, 0, 0, 0.6);
  line-height: 1.6rem;
}

/* =====>>  Skills Bars Css  <<===== */
.work_skills .skills ul li {
  position: relative;
  font-size: var(--m-fs);
  line-height: 1.8rem;
  margin: var(--m-0-5);
  color: var(--f2-color);
  font-weight: 500;
}

.work_skills .skills ul li::before {
  content: "";
  position: absolute;
  top: 0;
  bottom: 0;
  right: 0;
  margin: auto;
  height: 0.2rem;
  background: var(--bg3-color);
  animation: skills 8s linear infinite;
  animation-delay: calc(-2s * var(--i));
}

@keyframes skills {
  0% {
    width: 50%;
    filter: hue-rotate(180deg);
  }

  50% {
    width: 0;
  }

  100% {
    width: 50%;
    filter: hue-rotate(0);
  }
}

/* ===== =====>>  User Details Css Start  <<===== ===== */
.userDetails {
  position: relative;
  padding: var(--p-1-5) var(--p-2-5);
}

.userDetails .userName h1 {
  font-size: var(--xxxl-fs);
}

.userDetails .userName .map {
  position: absolute;
  top: 2.5rem;
  left: 18.5rem;
  display: flex;
  justify-content: center;
  align-items: center;
}

.userDetails .userName .map .ri {
  margin-right: var(--m-0-3);
  font-size: var(--m-fs);
}

.userDetails .userName .map span {
  font-size: var(--s-fs);
  color: var(--f3-color);
  font-weight: 700;
}

.userDetails .userName p {
  font-size: var(--m-fs);
  font-weight: 700;
  color: var(--f5-color);
  margin-bottom: var(--m-1-8);
}

.userDetails .rank {
  position: relative;
  margin-bottom: var(--m-1-8);
}

.userDetails .rank .heading {
  font-size: var(--xs-fs);
  color: var(--f4-color);
  text-transform: uppercase;
  margin-bottom: var(--m-0-6);
}

.userDetails .rank span {
  font-size: var(--xxl-fs);
  font-weight: 700;
}

.userDetails .rank .rating {
  position: absolute;
  top: 2.7rem;
  left: 3.5rem;
}

.userDetails .rank .rating .rate {
  color: var(--f5-color);
  font-size: var(--l-fs);
}

.userDetails .rank .rating .underrate {
  color: var(--f6-color);
}

.userDetails .btns ul,
.userDetails .btns ul li {
  display: flex;
  align-items: center;
}

.userDetails .btns ul li {
  margin-right: var(--m-2-5);
  border-radius: 0.5rem;
}

.userDetails .btns ul li .ri {
  margin-right: var(--m-0-5);
  font-size: var(--xl-fs);
}

.userDetails .btns ul li a {
  font-size: var(--l-fs);
  color: var(--f2-color);
  font-weight: 500;
}

a{text-decoration: none;}

.userDetails .btns ul .active {
  background: #000000;
  padding: var(--p-0-5) var(--p-1-5);
}

.userDetails .btns ul li:hover {
    background: #818181;
    padding: var(--p-0-5) var(--p-1-5);
  }
.userDetails .btns{
    background-color: #000;
    font-size: var(--l-fs);
    color: var(--f2-color);
    font-weight: 500;
    padding: var(--p-0-5) var(--p-1-5);
    border-radius: 5px;
}
.userDetails .btns ul .active a,
.userDetails .btns ul .active .ri {
  color: var(--f5-color);
}

/* ===== =====>>  Timeline & About Css Start  <<===== ===== */
.timeline_about {
  padding: var(--p-2-5);
}

.timeline_about .tabs ul {
  position: relative;
  display: flex;
  align-items: center;
  margin-bottom: var(--m-2-5);
}

.timeline_about .tabs ul::before {
  content: "";
  position: absolute;
  bottom: 0;
  right: 0;
  width: 100%;
  height: 1px;
  background: var(--bg7-color);
}

.timeline_about .tabs ul li {
  position: relative;
  display: flex;
  align-items: center;
  margin-right: var(--m-2-5);
  padding-bottom: var(--p-0-8);
  cursor: pointer;
}

.timeline_about .tabs ul li span {
  font-size: var(--l-fs);
  font-weight: 500;
}

.timeline_about .tabs ul li .ri {
  margin-right: var(--m-0-5);
}

.timeline_about .tabs ul .active::before {
  content: "";
  position: absolute;
  bottom: 0;
  width: 100%;
  height: 2px;
  background: var(--bg5-color);
}

.timeline_about .contact_info .heading,
.timeline_about .basic_info .heading {
  font-size: var(--xs-fs);
  color: var(--f4-color);
  text-transform: uppercase;
  margin-bottom: var(--m-1-5);
}

.timeline_about .contact_info ul,
.timeline_about .basic_info ul {
  margin-bottom: var(--m-1-5);
}

.timeline_about .contact_info ul li,
.timeline_about .basic_info ul li {
  display: flex;
  margin: var(--m-0-5) 0;
}

.timeline_about .contact_info ul li h1,
.timeline_about .basic_info ul li h1 {
  font-weight: 500;
  font-size: var(--m-fs);
  min-width: 12rem;
}

.timeline_about .contact_info ul li span,
.timeline_about .basic_info ul li span {
  font-size: var(--m-fs);
}

.timeline_about .contact_info ul .phone span,
.timeline_about .contact_info ul .email span,
.timeline_about .contact_info ul .site span {
  color: var(--f5-color);
}


/* Style the tab */
.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
  }

  /* Style the buttons inside the tab */
  .tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
  }

  /* Change background color of buttons on hover */
  .tab button:hover {
    background-color: #ddd;
  }

  /* Create an active/current tablink class */
  .tab button.active {
    background-color: #ccc;
  }

  /* Style the tab content */
  .tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
  }

  input[type=text]{
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
  }

  /* Add a background color when the inputs get focus */
  .wow input[type=text]:focus, input[type=password]:focus {
    background-color: #ddd;
    outline: none;
  }

  /* Set a style for all buttons */
  .wow button {
    background-color: #ffaf08;
    color: rgb(0, 0, 0);
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
  }

  button:hover {
    opacity:1;
  }

@media screen and (max-width: 1024px) {
    html {
      font-size: 9px;
    }
  }

  @media screen and (max-width: 900px) {
    html {
      font-size: 10px;
    }
  }



  @media screen and (max-width: 768px) {
    html {
      font-size: 12px;
    }

    /* ===== =====>>  Container Css Start  <<===== ===== */
    .container {
      grid-template-columns: 1fr;
      grid-template-areas:
        "header"
        "userProfile"
        "userDetails"
        "work_skills"
        "timeline_about";
      overflow-x: hidden;
      overflow-y: inherit;
      padding: 0;
      width: 100%;
      height: 100%;
      box-shadow: none;
    }

    /* ===== =====>>  Container Card Css Start  <<===== ===== */
    .container .card {
      backdrop-filter: none;
    }

    .userDetails {
      margin-bottom: 3rem;
    }

    .container::before,
    .container::after {
      display: none;
    }

    /* ===== =====>>  Header/Navbar Css Start  <<===== ===== */
    .container header {
      padding: 2.5rem;
    }
  }

  @media screen and (max-width: 500px) {
    .container {
      width: 100%;
      overflow: initial;
    }
  }

  @media screen and (max-width: 350px) {
    .main_bg {
      animation: none;
    }
  }
    </style>

</head>

<body>

<div id="preloader"></div>

<?php include './includes/navbar.php';?>

<section class="eh">
<span class="main_bg"></span>


    <!-- ===== ===== Main-Container ===== ===== -->
    <div class="container">

        <!-- ===== ===== User Main-Profile ===== ===== -->
        <section class="userProfile card">
            <div class="profile">
                <figure><img src="./assets/images/kaye.jpg" alt="profile" width="250px" height="250px"></figure>
            </div>
        </section>


        <!-- ===== ===== Work & Skills Section ===== ===== -->
        <section class="work_skills card" id="profile">

            <!-- ===== ===== Work Contaienr ===== ===== -->
            <div class="work">
                <h1 class="heading">MY PROFILE</h1>
                <div class="primary">
                    <h1>KAYE BILLONES</h1>
                    <p>kbillones95@gmail.com</p>
                    <button><span>EDIT </span></button>

            </div>
            </div>

            <!-- ===== ===== Skills Contaienr ===== ===== -->
            <div class="skills">
                <h1 class="heading">BASIC INFORMATION</h1>
                <p>Birthday: Oct 12, 2000</p>
                <p>Gender: Female</p>
            </div>
        </section>


        <!-- ===== ===== User Details Sections ===== ===== -->
        <section class="userDetails card">
            <div class="userName">
                <h1 class="name">Kaye Billones</h1>
                <p class="customer">Customer</p>
            </div>

            <div class="rank">
                <h1 class="heading">Rate</h1>
                <span>8,6</span>
                <div class="rating">
                    <i class="ri-star-fill rate"></i>
                    <i class="ri-star-fill rate"></i>
                    <i class="ri-star-fill rate"></i>
                    <i class="ri-star-fill rate"></i>
                    <i class="ri-star-fill rate underrate"></i>
                </div>
            </div>

            <div class="btns" class="tab">
                <ul>
                    <li class="sendMsg" class="tablinks"  onclick="openCity(event, 'London')">
                        <i class="ri-chat-4-fill ri" ></i>
                        <a href="#London">Profile</a>
                    </li>

                    <li class="sendMsg" class="tablinks" onclick="openCity(event, 'Paris')">
                        <i class="ri-check-fill ri"></i>
                        <a href="#Paris">Contact</a>
                    </li>

                    <li class="sendMsg" class="tablinks" onclick="openCity(event, 'Tokyo')">
                        <a href="#Tokyo">Bank Account</a>
                    </li>

                </ul>
            </div>
        </section>


        <!-- ===== ===== Timeline & About Sections ===== ===== -->
        <section class="timeline_about card">


<div id="London" class="tabcontent">
<form action="/action_page.php">
  <div class="wow">
    <h1>PROFILE DETAILS</h1>
    <hr>

    <label for="name"><b>Name</b></label>
    <input type="text" placeholder="Enter Complete Name" name="name" id="name" required>

    <label for="email"><b>Email</b></label>
    <input type="text" value="kbillones95@gmail.com" name="email" id="email" required>

    <label for="day"><b>Birthday</b></label>
    <input type="text" placeholder="Enter your birthday" name="day" id="day" required>

    <label for="gender"><b>Gender</b></label>
    <input type="text" placeholder="Enter your gender" name="gender" id="gender" required>

    <hr>
    <button type="submit" class="registerbtn">SUBMIT</button>
  </div>
</form>
</div>

<div id="Paris" class="tabcontent">

<form action="/action_page.php">
  <div class="wow">
    <h1>CONTACT INFORMATION</h1>
    <hr>

    <label for="phone"><b>Phone Number</b></label>
    <input type="text" placeholder="Enter Mobile/Telephone Number" name="phone" id="phone" required>

    <label for="address"><b>Complete Address</b></label>
    <input type="text" placeholder="Enter Complete Address" name="address" id="address" required>

    <label for="zip"><b>Zip Code</b></label>
    <input type="text" placeholder="Enter Zip Code" name="zip" id="zip" required>
    <hr>
    <button type="submit" class="registerbtn">SUBMIT</button>
  </div>
</form>
</div>


<div id="Tokyo" class="tabcontent">

<form action="/action_page.php">
  <div class="wow">
    <h1>BANK ACCOUNT INFORMATION</h1>
    <p>Please fill in this form to add a bank account.</p>
    <hr>

    <label for="bankAccount"><b>Fullname in your bank account</b></label>
    <input type="text" placeholder="Enter Full Name in your bank account" name="email" id="email" required>

    <label for="accountNo"><b>Account Number</b></label>
    <input type="text" placeholder="Account Number" name="accountNo" id="accountNo" required>

    <label for="bankName"><b>Bank Name</b></label>
    <input type="text" placeholder="Enter Bank Name" name="bankName" id="bankName" required>
    <hr>
    <button type="submit" class="registerbtn">SUBMIT</button>
  </div>
</form>
</div>


        </section>
    </div>

    </section>

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
    </script>


<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>

</body>
</html>