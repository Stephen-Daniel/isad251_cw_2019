<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>cafe.html</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
	<link rel="stylesheet" href="assets/css/styles.css">
</head>

<body style="filter: blur(0px);">
    <div style="background-image: url(&quot;assets/image/coffeeAndToast.jpg&quot;);background-position: center;width: 100%;height: 100vh;background-size: cover;opacity: 1;filter: blur(0px);background-repeat: no-repeat;">
        <nav class="navbar navbar-light navbar-expand-md sticky-top navigation-clean-button" style="height: 80px;background-color: #bacfe1;color: #3a2121;opacity: 1;filter: blur(0px) hue-rotate(0deg);">
            <div class="container-fluid"><a class="navbar-brand" href="#" style="color: rgb(11,73,88);">Cafe Drinks &amp; Snacks</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div
                    class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item" role="presentation"><a class="nav-link active" id="home" style="color:#ffffff;" href="index.php">&nbsp;Home</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" id="menu" style="color:#ffffff;" href="menu.php">Menu</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" id="justOrder" style="color:#ffffff;" href="order.php">Just Order</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link active" id="justOrder" style="color:#ffffff;" href="register.php">Register</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" id="register" style="color:#ffffff;" href="login.php">Log In</a></li>
                    </ul>
            </div>
    </div>
    </nav>
    
	<div class="container-fluid main-panel">
        <div class="row">
            <div class="col d-flex justify-content-center align-items-center">
                <div class="login-user-avatar"></div>
                <div class="login-panel">
                    <div class="login-form">
        <form method="post" action="../register/register.php">
            <!--<?php include('../errors/errors.php')?>-->

            <div class="form-group">
			<div class="input-group"><input class="form-control" type="text" id="firstName" name="firstName" required="" placeholder="First name"></div>
            </div>

            <div class="form-group">
			<div class="input-group"><input class="form-control" type="text" id="lastName" name="lastName" required="" placeholder="Last name"></div>
            </div>
            <div class="form-group">
			<div class="input-group"><input class="form-control" type="text" id="addressLineOne" name="addressLineOne" required="" placeholder="Address"></div>
            </div>
            <div class="form-group">
			<div class="input-group"><input class="form-control" type="text" id="addressLineTwo" name="addressLineTwo" required="" placeholder="Address"></div>
            </div>
            <div class="form-group">
			<div class="input-group"><input class="form-control" type="text" id="city" name="city" required="" placeholder="City"></div>
            </div>
            <div class="form-group">
			<div class="input-group"><input class="form-control" type="text" id="postcode" name="postcode" required="" placeholder="Postcode"></div>
            </div>
            <div class="form-group">
			<div class="input-group"><input class="form-control" type="text" id="email" name="email" required="" placeholder="Email"></div>
            </div>
            <div class="form-group">
			<div class="input-group"><input class="form-control" type="text" id="username" name="username" required="" placeholder="Username"></div>
            </div>
            <div class="form-group">
			<div class="input-group"><input class="form-control" type="password" id="password" name="password" required="" placeholder="Password"></div>    
            </div>
            <div class="form-group">
			<div class="input-group"><input class="form-control" type="password" id="repeatPassword" name="repeatPassword" required="" placeholder="Repeat password"></div>
            </div>
			<div class="form-group"><button class="btnComplete" type="Submit">Complete sign up</button></div>
            

        </form>
      </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>