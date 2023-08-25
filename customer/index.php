<?php
session_start();
include 'common/connection.php';
if (isset($_SESSION['customer_id'])) {
    $cid = $_SESSION['customer_id'];
}

$products = $con->query("select * from product");

if (isset($_POST['submit'])) {
    $product_id    = $_POST['product_id'];
    $product_price   = $_POST['price'];
    $product_qty     = $_POST['qty'];


    # to check whether the product is already in the cart or not
    $cart_result = $con->query("select * from cart where customer_id='$cid' and product_id='$product_id'");
    $cart_row_count = $cart_result->num_rows;

    if ($cart_row_count == 1) {
        echo "<script>alert('Product Already Exist in Cart'); document.location='cart.php';</script>";
    } else {
        $r = $con->query("insert into cart(quantity,price,product_id,customer_id) values('$product_qty','$product_price','$product_id','$cid')");
        if ($r) {
            echo "<script>alert('Added to Cart')</script>";
        } else {
            header('location:index.php');
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> MilkPrism</title>

    <link rel="shortcut icon" href="assets/images/fav.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawsom-all.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

<body>

    <!-- ################# Header Starts Here#######################--->
    <?php include 'common/header.php'; ?>


    <!-- ################# Slider Starts Here#######################--->

    <div class="slider-detail" style="height: 100%;">

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <!-- <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li> -->
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner">
                <!-- <div class="carousel-item active">
                    <img class="d-block w-100" src="assets/images/slider/slider1.jpg" width="100%" alt="First slide">

                </div> -->
                <div class="carousel-item active">
                    <img class="d-block w-100" src="assets/images/slider/slider2.jpg" width="100%" alt="First slide">
                </div>

                <div class="carousel-item">
                    <img class="d-block w-100" src="assets/images/slider/slider3.jpg" height="500px " width="100%" alt="Second slide">

                </div>


            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>


    </div>
    <br><br><br><br>

    <!-- ################# Key Features Starts Here#######################--->
    <form method="post">
        <section class="key-features">
            <div class="container">
                <div class="inner-title">

                    <h2>Products</h2>
                    <p></p>
                </div>
                <div class="row">
                    <?php
                    while ($product = $products->fetch_object()) {

                        $shopOb = $con->query("select * from shop where shop_id='$product->shop_id' ");
                        $shop_fet_ob = $shopOb->fetch_object();

                    ?>

                        <div class="col-md-4 col-sm-6">
                            <div class="single-key ">
                                <a href="product_details.php?p_id=<?php echo $product->product_id; ?>&shop_id=<?php echo $product -> shop_id; ?>">

                                    <img src="../Shopkeeper/upload/<?php echo $product->image; ?>" style="border-radius:10px" height="200">

                                    <input type="hidden" class="text-left" id="price" name="price" value="<?php echo $product->price; ?>">
                                    <input type="hidden" class="text-left" id="product_id" name="product_id" value="<?php echo $product->product_id; ?>">

                                    <h5 style="font-size: 2em;margin-top:10px;"><?php echo $product->product_name; ?></h5>
                                    <p class="text-left"><?php echo $product->description; ?></p>
                                    <h5 class="text-left" style="margin-top: 10px;">Price : <?php echo $product->price; ?></h5>
                                    <h6 class="text-left">Shop : <?php echo $shop_fet_ob->shop_name ?></h6>

                                </a>

                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>






            </div>

        </section>
    </form>


    <!-- ################# Our Team Starts Here#######################--->







    <!-- ################# Footer Starts Here#######################--->


    <?php include 'common/footer.php'; ?>

</body>

<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/plugins/scroll-fixed/jquery-scrolltofixed-min.js"></script>
<script src="assets/js/script.js"></script>


</html>