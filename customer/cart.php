<?php
include 'common/connection.php';

session_start();
if (!isset($_SESSION['customer_id'])) {
    header('location:index.php');
}


$id = $_SESSION['customer_id'];
$cart = $con->query("select * from cart where customer_id='$id'");


?>




<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>My Cart</title>

    <link rel="shortcut icon" href="assets/images/fav.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawsom-all.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />


</head>

<body>

    <!-- ################# Header Starts Here#######################--->
    <?php include 'common/header.php' ?>



    <!-- ################# Our Team Starts Here#######################--->

    <!--  ************************* Page Title Starts Here ************************** -->
    <div class="page-nav no-margin row">
        <div class="container">
            <div class="row">
                <h2>Milk Prism</h2>
                <ul>
                    <li> <a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li><i class="fas fa-angle-double-right"></i> My Cart</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- ######## Page  Title End ####### -->



    <div style="margin-top:0px;" class="row no-margin">
    </div>



    <section class="pt-5 pb-5">
        <div class="container">
            <div class="row w-100">
                <div class="col-lg-12 col-md-12 col-12">
                    <h3 class="display-5 mb-2 text-center">MY Cart</h3>
                    <p class="mb-5 text-center">
                        <i class="text-info font-weight-bold"></i>
                    </p>
                    <table id="shoppingCart" class="table table-condensed table-responsive">
                        <thead>
                            <tr>
                                <th style="width:60%">Product</th>
                                <th style="width:12%">Price</th>
                                <th style="width:10%">Quantity</th>
                                <th style="width:10%">Sub Total</th>
                                <th style="width:8%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            while ($result = $cart->fetch_object()) {
                                $x = $con->query("select * from product where product_id='$result->product_id'");
                                $xx = $x->fetch_object();

                                $amount = $result->price * $result->quantity;

                                $total = $total + $amount;
                            ?>
                                <tr>
                                    <td data-th="Product">
                                        <div class="row">
                                            <div class="col-md-3 text-left">
                                                <img height="500" width="300" src="../Shopkeeper/upload/<?php echo $xx->image; ?>" alt="" class="img-fluid d-none d-md-block rounded mb-2 shadow ">
                                            </div>
                                            <div class="col-md-9 text-left mt-sm-2">
                                                <h4><?php echo $xx->product_name; ?></h4>
                                                <p class="font-weight-light"><?php echo $xx->description; ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Price"><?php echo $result->price; ?></td>
                                    <td data-th="Quantity">
                                        <input type="text" class="form-control form-control-lg text-center" value="<?php echo $result->quantity; ?>" onchange="return updateQuantity(this.value, <?php echo $result->product_id; ?>)">
                                    </td>
                                    <td data-th="Price">
                                        <?php echo $amount; ?>
                                    </td>
                                    <td class="actions" data-th="">
                                        <div class="text-right">

                                            <button class="btn btn-white border-secondary bg-white btn-md mb-2">
                                                <a href="delcart.php?dcid=<?php echo $result->id; ?>"><i class="fas fa-trash"></i></a>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="float-right text-right">
                        <h4>Subtotal:</h4>
                        <h1><?php echo $total; ?> RS</h1>
                    </div>
                </div>
            </div>
            <div class="row mt-4 d-flex align-items-center">
                <div class="col-sm-6 order-md-2 text-right">
                    <a href="myorder.php" class="btn btn-primary mb-4 btn-lg pl-5 pr-5">Checkout</a>
                </div>
                <div class="col-sm-6 mb-3 mb-m-1 order-md-1 text-md-left">
                    <a href="index.php">
                        <i class="fas fa-arrow-left mr-2"></i> Continue Shopping</a>
                </div>
            </div>
        </div>
    </section>
    </div>





    <!-- ################# Footer Starts Here#######################--->


    <?php include 'common/footer.php' ?>

    </div>

</body>

<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/plugins/scroll-fixed/jquery-scrolltofixed-min.js"></script>
<script src="assets/js/script.js"></script>

<script type="text/javascript">
    function updateQuantity(quantity, pid) {

        $.ajax({

            type: "POST",
            url: 'update_quantity.php',
            data: {
                quantity: quantity,
                product_id: pid
            },
            success: function(result) {

                document.location = 'cart.php';
            }
        });
    }
</script>

</html>