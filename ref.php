
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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Receipt</title>
</head>
<style>
body {
    background: url(./assets/images/background.png) no-repeat;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    height: 100vh;
}

.card {
    border: none;
    border-radius: 15px;
}

.logo {
    background-image: url('./assets/images/navbar.png');
    background-size: contain;
    position: relative;
    border-radius: 15px 15px 0px 0px;

}

.gif {
    width: 180px;
}

.forgif {
    text-align: center;
}

.totals tr td {
    font-size: 13px
}

.product-qty span {
    font-size: 12px;
    color: #dedbdb;
}

.qr {
    text-align: center;
}

.logoTop {
    width: 150px;

}

.container {
    border-radius: 15px;

}

.fa-home {
    color: #ffaf08;
    border-radius: 5px;
    padding: 5px;
    position: absolute;
    right: 50px;
    top: 30px;
}

.fa-home:hover {
    color: #ffc240;
}
</style>

<body>
    <div id="preloader"></div>


    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="text-left logo p-2 px-5"> <img src="./assets/images/logo.png" class="logoTop"> <a
                            href="index.php" class="w3-xxxlarge"><i class="fa fa-home"></i></a> </div>
                    <div class="invoice p-5">
                        <h5>Your order Confirmed!</h5>
                        <div class="forgif"><img class="gif" src="./assets/images/courier.gif"></div>
                        <span class="font-weight-bold d-block mt-4">Hello, <h3 class="customerName">Jen</h3>
                            </span> <span>Your order has been confirmed and will be shipped right away!</span>
                        <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="py-2"> <span class="d-block text-muted">Order Date</span>
                                                <span>05-06-2022</span> </div>
                                        </td>
                                        <td>
                                            <div class="py-2"> <span class="d-block text-muted">Order No</span>
                                                <span>MT12332345</span>
                                                <div class="qr"><img src="./assets/images/qrAmarah.png" width="120"
                                                        left="0"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="py-2"> <span class="d-block text-muted">Payment</span>
                                                <span><img src="https://img.icons8.com/color/48/000000/mastercard.png"
                                                        width="80" /></span> </div>
                                        </td>
                                        <td>
                                            <div class="py-2"> <span class="d-block text-muted">Shipping Address</span>
                                                <span>BF Resorts, Las Pinas City, Philippines</span> </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="product border-bottom table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td width="20%"> <img src="./assets/images/pizza.png" width="120"> </td>
                                        <td width="60%"> <span class="font-weight-bold">Pizza</span>
                                            <div class="product-qty"> <span class="d-block">Quantity:1</span>
                                                <span>Color:Dark</span> </div>
                                        </td>
                                        <td width="20%">
                                            <div class="text-right"> <span class="font-weight-bold">$67.50</span> </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%"> <img src="./assets/images/cheesy.png" width="120"> </td>
                                        <td width="60%"> <span class="font-weight-bold">Cheesy Nachos</span>
                                            <div class="product-qty"> <span class="d-block">Quantity:1</span>
                                                <span>Color:Orange</span> </div>
                                        </td>
                                        <td width="20%">
                                            <div class="text-right"> <span class="font-weight-bold">P 77.50</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row d-flex justify-content-end">
                            <div class="col-md-5">
                                <table class="table table-borderless">
                                    <tbody class="totals">
                                        <tr>
                                            <td>
                                                <div class="text-left"> <span class="text-muted">Subtotal</span> </div>
                                            </td>
                                            <td>
                                                <div class="text-right"> <span>P 168.50</span> </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="text-left"> <span class="text-muted">Shipping Fee</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-right"> <span>P 22</span> </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="text-left"> <span class="text-muted">Tax Fee</span> </div>
                                            </td>
                                            <td>
                                                <div class="text-right"> <span>P 7.65</span> </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="text-left"> <span class="text-muted">Discount</span> </div>
                                            </td>
                                            <td>
                                                <div class="text-right"> <span class="text-success">P 168.50</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="border-top border-bottom">
                                            <td>
                                                <div class="text-left"> <span class="font-weight-bold">Subtotal</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-right"> <span class="font-weight-bold">P 238.50</span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <p>We will be sending shipping confirmation email when the item shipped successfully!</p>
                        <p class="font-weight-bold mb-0">Thanks for shopping with us!</p> <span>Amarah's Corner
                            Team</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- SCRIPT -->
        <script>
        var loader = document.getElementById("preloader");

        window.addEventListener("load", function() {
            loader.style.display = "none";
        })
        </script>
        <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
        <script src="./assets/js/script.js"></script>
</body>

</html>