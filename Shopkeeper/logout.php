<?php

session_start();

unset($_SESSION["shop_id"]);
// session_destroy();

header("location:index.php");


?>