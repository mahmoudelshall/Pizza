<?php
session_start();

if(isset($_SESSION['order_id']) && isset($_SESSION['total']) ){
        
   $order_id = $_SESSION['order_id'];
   $total = $_SESSION['total'];
   $produts_bought = $_SESSION['cart'];

   // remove all session 
   session_destroy();
    

}else{
    header("location: index.php");

}

?>


<?php 
    include_once "inc/header.php";
?>


<section class="ftco-section contact-section">
    <div class="container mt-5">
        <p class="text-center font-weight-bold" style="font-size: 1.8rem;"><?php echo $_GET['success_message'];?></p>
    </div>
    <div class="mx-auto container text-center">
 
        <p><?php echo "Order Id: ".$order_id; ?> </p>
        <p>please keep order id in save </p>
        <p>we will deliver your meals within 30 minutes </p>


   
    </div>
</section>





<?php 
    include_once "inc/footer.php";
?>