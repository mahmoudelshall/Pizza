<?php 
session_start();
include_once "connection.php";
if(isset($_POST['checkout_btn'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $address = $_POST['address'];
        $order_cost = $_SESSION['total'];
        $order_status = 'not paid';
        $order_date = date("Y-m-d h:i:s");
        
$sql = "INSERT INTO orders (order_cost, order_status, user_name, user_email, user_phone,user_city,user_address,order_date)
         VALUES ($order_cost,'$order_status','$name','$email','$phone','$city','$address','$order_date')";

$op  = mysqli_query($conn, $sql);

if ($op) {
  $order_id = mysqli_insert_id($conn);
  // get all products from cart and insert them into database
  foreach($_SESSION['cart'] as $id => $product){
    $product = $_SESSION['cart'][$id];
    $product_id = $product['product_id'];
    $product_name = $product['product_name'];  
    $product_image = $product['product_image'];  
    $product_price = $product['product_price'];  
    $product_quantity = $product['product_quantity'];  

    $sql = "INSERT INTO order_items (order_id, product_id,product_name,product_image,product_price,product_quantity,user_name,order_date)
            VALUES ($order_id,$product_id,'$product_name','$product_image',$product_price,$product_quantity,'$name','$order_date')";
    $op_item  = mysqli_query($conn, $sql);
   
  }
} else {
  header("location: index.php");
}




  ////////////////

// store order id in session
$_SESSION['order_id'] = $order_id;

// take user to payment page

header("location: payment.php");
}
?>