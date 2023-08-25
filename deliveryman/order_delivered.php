<?php
session_start();
include "common/connection.php";

if(!isset($_SESSION["deliveryman_id"]))
{
	header("location:index.php");
}
$id = $_GET["o_id"];
$del_id = $_GET["deliveryman_id"];

$qry = $con -> query("update orders set isDelivered='1', deliveryman_id='$del_id' where order_id='$id' ");

if($qry){
    echo "<script>alert('Delivery Done !!'); document.location='view_order.php'</script>";
} else{
    echo "<script>alert('Something went Wrong !!'); document.location='view_order.php'</script>";
}


?>
