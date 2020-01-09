<?php
class Products extends DB {
  function get () {
 

    return $this->fetch(
      "SELECT * FROM `products`", null, 
      "product_id"
    );
  }

  function add ($name, $img, $desc, $price) {
 

    return $this->exec(
      "INSERT INTO `products` (`product_name`, `product_image`, `product_description`, `product_price`) VALUES (?, ?, ?, ?)",
      [$name, $img, $desc, $price]
    );
  }

  function edit ($id, $name, $img, $desc, $price) {


    return $this->exec(
      "UPDATE `products` SET `product_name`=?, `product_image`=?, `product_description`=?, `product_price`=? WHERE `product_id`=?",
      [$name, $img, $desc, $price, $id]
    );
  }

  function del ($id) {
 

    return $this->exec(
      "DELETE FROM `products` WHERE `product_id`=?",
      [$id]
    );
  }
}
?>