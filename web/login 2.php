<?php include_once "navbar.php"; ?>
<html>

<head>
    
</head>


<br></br>
    <div class="container-fluid main-panel">
        <div class="row">
            <div class="col d-flex justify-content-center align-items-center">
                <div class="login-user-avatar"></div>
                <div class="login-panel">
                    <div class="login-form">
                        <form>
                            <div class="form-group">
                                <div class="input-group"><input class="form-control" type="text" id="tableNumber" name="tableNumber" required="" placeholder="Table number"></div>
                                <div class="input-group"><input class="form-control" type="text" id="login-username" name="username" required="" placeholder="Username"></div>
                            </div>
                            <div class="form-group">
                                <div class="input-group"><input class="form-control" type="password" name="password" required="" placeholder="Password"></div>
                            </div>
                            <div class="form-group">
                                <div class="input-group"></div>
                            </div>
                            <div class="form-group"><a href="3b-products.php" class="btn btn-info" role="button">Login</a></div>
                        </form>
                    </div>
                    <div class="login-response has-error"></div>
                </div>
            </div>
        </div>
    </div>
    </div>

</body>

</html>