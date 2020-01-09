
<?php
$hostname = 'proj-mysql.uopnet.plymouth.ac.uk';
$username = 'ISAD251_SDaniel';
$password = 'ISAD251_22201615';
$databasename = 'isad251_sdaniel';
$query = "SELECT * FROM products";
$connection = mysqli_connect($hostname, $username, $password, $databasename);
$result1 = mysqli_query($connection, $query);
$result2 = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>cafe.html</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
<style>
table, th, td {
  border: 1px solid black;
}
  th {
	  background: rgba(76, 175, 80, 0.3);
  color: black;
	  
  }
  
  tr{
	    background: rgba(76, 175, 80, 0.3);
  color: black;
	  
  }
  
</style>
</head>

<body style="filter: blur(0px);">
    <div style="background-image: url(&quot;assets/image/coffeeAndToast.jpg&quot;);background-position: center;width: 100%;height: 100vh;background-size: cover;opacity: 1;filter: blur(0px);background-repeat: no-repeat;">
        <nav class="navbar navbar-light navbar-expand-md sticky-top navigation-clean-button" style="height: 80px;background-color: #bacfe1;color: #3a2121;opacity: 1;filter: blur(0px) hue-rotate(0deg);">
            <div class="container-fluid"><a class="navbar-brand" href="#" style="color: rgb(11,73,88);">Cafe Drinks &amp; Snacks</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div
                    class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item" role="presentation"><a class="nav-link active" id="home" style="color:#ffffff;" href="index 2.php">&nbsp;Home</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" id="menu" style="color:#ffffff;" href="menu.php">Menu</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" id="justOrder" style="color:#ffffff;" href="3b-products.php">Just Order</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" id="justOrder" style="color:#ffffff;" href="register.php">Register</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" id="register" style="color:#ffffff;" href="index 2.php">Log out</a></li>
						<li class="nav-item" role="presentation"><a class="nav-link" id="register" style="color:#ffffff;" href="index.php">Admin</a></li>
                    </ul>
            </div>
    </div>
    </nav>
	<div style="float: left">
	<table id="orderTable" class="order_table" cellspacing="0" width="auto%">
        
            <tr>
				
                <th>Food</th>
                <th>Picture</th>
                <th>Description</th>
                <th>Price</th>
				
                <th></th>
                
            </tr>
        
            <?php  while($row1 = mysqli_fetch_array($result1)):;?>
            <tr>
                
                <td><b><?php echo $row1[1];?></b></td>
                <td><img src="../web/assets/<?php echo $row1[2];?>" alt="<?php echo $row1[1];?>" width="150" height="100"></td>
                <td><b><?php echo $row1[3];?></b></td>
				<td><b>£<?php echo $row1[4];?></b></td>
				
                <th><button class="btnAdd" id="btn<?php echo $row1[0];?>"type="submit">+</button></th>
            </tr>
            <td><?php  endwhile; ?></td>
       
    </table>
	</div>
	<div style="float: right">
	<table id="orderTable"  class="order_table" cellspacing="0" width="auto%">
        
            <tr>
				
                <th>Food</th>
                <th>Picture</th>
                <th>Description</th>
				<th>Qty</th>
                <th>Price</th>
				
                
            </tr>
        
            <?php  while($row2 = mysqli_fetch_array($result2)):;?>
            <tr>
                
                <td><b><?php echo $row2[1];?></b></td>
                <td><img src="../web/assets/<?php echo $row2[2];?>" alt="<?php echo $row2[1];?>" width="150" height="100"></td>
                <td><b><?php echo $row2[3];?></b></td>
				<td><b></td>
				<td><b>£<?php echo $row2[4];?></b></td>
				
                <th><button class="btnMinus" id="btn<?php echo $row2[0];?>"type="submit">-</button></th>
            </tr>
            <td><?php  endwhile; ?></td>
			
			
    </table>
	</div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>