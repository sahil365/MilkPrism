<?php

session_start();
include "common/connection.php";

if(!isset($_SESSION["id"]))
{
	header("location:index.php");
}
$id = $_SESSION["id"];


if(isset($_POST["submit"]))
{
	$oldpassword = $_POST["oldpassword"];
	$newpassword = $_POST["newpassword"];
	$cnewpassword = $_POST["cnewpassword"];

	$admin = $con->query("select * from admin where id='$id' && password='$oldpassword'");
	$rowcount = $admin->num_rows;

	if($rowcount==1)
	{
		if($newpassword == $cnewpassword)
		{
			$con->query("update admin set password='$newpassword' where id='$id'");
			
			header("location:dashboard.php");
		}
	}
}

?>

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Change Password</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />

<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />

<!-- font-awesome icons CSS -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons CSS -->

 <!-- side nav css file -->
 <link href='css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css'/>
 <!-- side nav css file -->
 
 <!-- js-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>

<!--webfonts-->
<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
<!--//webfonts--> 

<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
<!--//Metis Menu -->

<style type="text/css">
	.title1{
		background-color: lightgrey;
		padding: 1em 0 1em 0;
	}
</style>

</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
	<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
		<!--left-fixed -navigation-->
		<aside class="sidebar-left">
      <?php include "common/sidebar.php";?>
    </aside>
	</div>
		<!--left-fixed -navigation-->
		
		<!-- header-starts -->
		<?php include "common/header.php";?>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
				<div class="forms">
					
					
					<div class="row">
						<h3 class="title1" style="color: black;background-color:transparent">Change Password :</h3>
						<div class="form-three widget-shadow">
							<form class="form-horizontal" method="post">
								<div class="form-group">
									<label for="oldpassword" class="col-sm-2 control-label">Old Password</label>
									<div class="col-sm-8">
										<input type="password" class="form-control1" id="oldpassword" name="oldpassword" placeholder="Enter old password" minlength="8" required>
									</div>
								</div>
								<div class="form-group">
									<label for="newpassword" class="col-sm-2 control-label">New Password</label>
									<div class="col-sm-8">
										<input type="password" class="form-control1" id="newpassword" name="newpassword" placeholder="Enter New Password" minlength="8" required>
									</div>
								</div>
								<div class="form-group">
									<label for="cnewpassword" class="col-sm-2 control-label">Confirm New Password</label>
									<div class="col-sm-8">
										<input type="password" class="form-control1" id="cnewpassword" name="cnewpassword" placeholder="Enter New Password" minlength="8" required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12" style="text-align: center;">
										<input type="submit" class="btn btn-danger" id="submit" name="submit" value="submit">
									</div>
								</div>
								<div class="form-group">
									<?php
									if(isset($_POST["submit"])){
										if($rowcount != 1){
											echo '<div class="alert alert-danger" role="alert">Old Password is Wrong !!</div>';
										}

										if($newpassword != $cnewpassword){
											echo '<div class="alert alert-danger" role="alert">Password Mismatched !!</div>';

										}
									}
									?>
								</div>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<!--footer-->
		<?php include "common/footer.php";?>
        <!--//footer-->
	</div>
	
	<!-- side nav js -->
	<script src='js/SidebarNav.min.js' type='text/javascript'></script>
	<script>
      $('.sidebar-menu').SidebarNav()
    </script>
	<!-- //side nav js -->
	
	<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	
	<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.js"> </script>
   
</body>
</html>