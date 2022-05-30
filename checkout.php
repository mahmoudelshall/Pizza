<?php 
session_start();

if(!isset($_SESSION['cart'])||empty($_SESSION['cart'])){
    header('location: index.php');
}

?>


<?php 
    include_once "inc/header.php";
?>




<section class="ftco-section contact-section">
      <div class="container mt-5">
        <p class="text-center font-weight-bold" style="font-size: 1.8rem;">Check Out</p>
        <div class="row block-9 d-flex justify-content-center">		 
         <div class="col-md-6 ftco-animate">
            <form method="POST" action="place_order.php" class="contact-form">
            	<div class="row">
            		<div class="col-md-6">
	                <div class="form-group">
	                  <input type="text" class="form-control" placeholder="Your Name" name="name" required>
	                </div>
                </div>
                <div class="col-md-6">
	                <div class="form-group">
	                  <input type="text" class="form-control" placeholder="Your Email" name="email" required>
	                </div>
	                </div>
              </div>
              <div class="row">
            		<div class="col-md-6">
	                <div class="form-group">
	                  <input type="tel" class="form-control" placeholder="Phone" name="phone" required>
	                </div>
                </div>
                <div class="col-md-6">
	                <div class="form-group">
	                  <input type="text" class="form-control" placeholder="City" name="city" required>
	                </div>
	                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Address" name="address" required>
              </div>
              <div class="form-group">
                <p>Total amount: $<?php echo $_SESSION['total']?></p>
                <input type="submit" value="Checkout" name="checkout_btn" class="btn btn-primary py-3 px-5">
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>







<?php 
    include_once "inc/footer.php";
?>