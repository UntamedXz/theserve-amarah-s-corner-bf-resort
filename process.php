<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="assets/css/orderstatus.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Order Status</title>
</head>
<style>
    body {
        background: url(./assets/images/background.png) no-repeat;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        height: 100vh;
    }

    .container {
        margin-top: 50px;
        margin-bottom: 50px;
    }

    .card {

        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background: url("./assets/images/amarah's-corner-white-bg.png");
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 0.10rem;
        color: rgb(0, 0, 0);
        background-repeat: no-repeat;
        background-size: cover;
        height: auto;
    }


    .card-header:first-child {
        border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0;
    }

    .card-header {

        padding: 0.75rem 1.25rem;
        margin-bottom: 0;
        background-color: transparent;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .track {
        position: relative;
        background-color: rgb(0, 0, 0);
        height: 7px;
        display: -webkit-box;

        display: flex;
        margin-bottom: 60px;
        margin-top: 50px;
    }

    .track .step {
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
        width: 25%;
        margin-top: -18px;
        text-align: center;
        position: relative;
    }

    .track .step.active:before {
        background: #ffaf08;
    }

    .track .step::before {
        height: 7px;
        position: absolute;
        content: "";
        width: 100%;
        left: 0;
        top: 18px;
    }

    .track .step.active .icon {

        background: #ffaf08;
        color: rgb(0, 0, 0);

    }

    .track .icon {
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        position: relative;
        border-radius: 100%;
        background: rgb(0, 0, 0);
        color: #ffffff;
    }

    .track .step.active .text {
        font-weight: 400;
        color: #000;
    }

    .track .text {

        display: block;
        margin-top: 7px;
    }

    .itemside {

        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        width: 100%;
    }

    .itemside .aside {

        position: relative;
        -ms-flex-negative: 0;
        flex-shrink: 0;
    }

    .img-sm {

        width: 80px;
        height: 80px;
        padding: 7px;
    }

    ul.row,
    ul.row-sm {

        list-style: none;
        padding: 0
    }

    .itemside .info {

        padding-left: 15px;
        padding-right: 7px;
    }

    .itemside .title {
        display: block;
        margin-bottom: 5px;
        color: #212529;
    }

    p {
        margin-top: 0;
        margin-bottom: 1rem
    }

    .btn-warning {

        color: #000000;
        background-color: #ffaf08;
        border-color: #ffaf08;
        border-radius: 5px;
        width: 200px;
        margin: 20px;
    }

    @media screen {}

    .btn-warning:hover {

        color: #ffffff;
        background-color: #ffaf08;
        border-color: #ffaf08;
        border-radius: 1px;
    }

    .row {
        color: rgb(255, 255, 255);
        background: rgb(0, 0, 0);
        border-radius: 5px;
        margin-left: 15px;
        margin-right: 15px;
    }
</style>

<body>
    <div id="preloader"></div>

    <?php include './includes/navbar.php';?>
    <br>
    <div class="container">
        <article class="card">

            <a href="#" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i> Back to orders</a>
            <header class="card-header"> My Purchase </header>
            <div class="card-body">
                <h6>Order ID: OD45345345435</h6>
                <article class="card">
                    <div class="card-body row">
                        <div class="col"> <strong>Estimated Delivery time:</strong> <br>29 nov 2019 </div>
                        <div class="col"> <strong>Shipping BY:</strong> <br> BLUEDART, | <i class="fa fa-phone"></i>
                            +1598675986 </div>
                        <div class="col"> <strong>Status:</strong> <br> Pending </div>
                        <div class="col"> <strong>Tracking #:</strong> <br> BD045903594059 </div>
                    </div>
                </article>
                <div class="track">
                    <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span
                            class="text">Order Confirmed</span> </div>
                    <div class="step "> <span class="icon"> <i class="fa fa-box"></i> </span> <span
                            class="text">Preparing</span> </div>
                    <div class="step "> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">To be
                            Receive</span> </div>
                    <div class="step "> <span class="icon"> <i class="fa fa-home"></i> </span> <span class="text">Order
                            Delivered</span> </div>
                </div>
                <br>
                <br>
                <ul class="row">
                    <li class="col-md-4">
                        <p class="title">SUMMARY</p>
                    </li>
                </ul>


            </div>
        </article>
    </div>


    <!-- SCRIPT -->
    <script>
        var loader = document.getElementById("preloader");

        window.addEventListener("load", function () {
            loader.style.display = "none";
        })
    </script>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script src="./assets/js/script.js"></script>
</body>

</html>