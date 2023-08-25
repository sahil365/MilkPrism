<?php

session_start();

unset($_SESSION["deliveryman_id"]);

// session_destroy();

header("location:index.php");


?>