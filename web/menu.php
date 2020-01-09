
<?php
/* [INIT - GET PRODUCTS] */
require __DIR__ . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "2a-config.php";
require PATH_LIB . "2b-lib-db.php";
require PATH_LIB . "3a-lib-products.php";
$pdtLib = new Products();
$products = $pdtLib->get();

?>
<?php include_once $RELATIVE_PATH . "navbar.php"; ?>
<!DOCTYPE html>
<html>
  <head>
    <title>
      Cafe 2020 Menu
    </title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	
	
	
	
    <link rel="stylesheet" href="public/3c-theme.css">
    
  </head>
  
    
    <div id="page-products"><?php
      if (is_array($products)) {
        foreach ($products as $id => $row) { ?>
          <div class="pdt">
		  <!-- set all pictures to a good size-->
            <img class="pdt-img" height = "150"  width = "350" src="images/<?= $row['product_image'] ?>"/>
            <h3 class="pdt-name"><?= $row['product_name'] ?></h3>
            <div class="pdt-price">£<?= $row['product_price'] ?></div>
            <div class="pdt-desc"><?= $row['product_description'] ?></div>
            
          </div>
        <?php }
      } else {
        echo "No products found.";
      }
      ?></div>

    
    <div id="page-cart" class="ninja"></div>
  </body>
</html>



