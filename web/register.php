
<?php include_once "navbar.php"; ?>

<html>
<head><title>cafe.html</title>
    
</head>

	<div class="container-fluid main-panel">
        <div class="row">
            <div class="col d-flex justify-content-center align-items-center">
                <div class="login-user-avatar"></div>
                <div class="login-panel">
                    <div class="login-form">
        <form method="post" action="../register/register.php">
            <!--<?php include('../errors/errors.php')?>-->
			<br></br>
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
  
</body>

</html>