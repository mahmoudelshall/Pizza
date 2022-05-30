<?php
session_start();
if (isset($_POST['add_to_cart'])){
    // it means that there is at least one product
    if (isset($_SESSION['cart'])){
        // get all ids in cart 
        $products_array_ids = array_column($_SESSION['cart'],"product_id");
      
        // check if product has already been added to cart or not 
        if(!in_array($_POST['product_id'],$products_array_ids)){
            // add product to cart
            $product_id = $_POST['product_id'];

            $product_array = array(
                'product_id' =>  $product_id,
                'product_name' => $_POST['product_name'],
                'product_price' => $_POST['product_price'],
                'product_image' => $_POST['product_image'],
                'product_special_offer' => $_POST['product_special_offer'],
                'product_quantity' => $_POST['product_quantity'],
             );

             $_SESSION['cart'][$product_id]=$product_array;
        }else{
            echo "<script>alert('product has already been added to cart')</script>";
        }
    // if user adding frist product to cart    
    }else{
          // add product to cart
          $product_id = $_POST['product_id'];

          $product_array = array(
              'product_id' =>  $product_id,
              'product_name' => $_POST['product_name'],
              'product_price' => $_POST['product_price'],
              'product_image' => $_POST['product_image'],
              'product_special_offer' => $_POST['product_special_offer'],
              'product_quantity' => $_POST['product_quantity'],
           );

           $_SESSION['cart'][$product_id]=$product_array;

    }
    //  calculate total cart
    calculateTotalCart();





}elseif(isset($_POST['remove_btn'])){
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);

    //  calculate total cart
    calculateTotalCart();



}elseif(isset($_POST['edit_quantity_btn'])){
    
    $product_id = $_POST['product_id'];
    $product_quantity= $_POST['product_quantity'];
    $product =$_SESSION['cart'][$product_id]; 
    $product['product_quantity'] = $product_quantity;
    $_SESSION['cart'][$product_id]=$product;

    //  calculate total cart
     calculateTotalCart();
} else{

}
function calculateTotalCart(){
    $total_price = 0;
    $total_quantity = 0;
    foreach($_SESSION['cart'] as $id => $product){
        $product = $_SESSION['cart'][$id];
        $price = $product['product_price'];
        $quantity = $product['product_quantity'];
        $total_price = $total_price + ( $price * $quantity );
        $total_quantity = $total_quantity + $quantity;
    }
    $_SESSION['total'] = $total_price;
    $_SESSION['quantity'] = $total_quantity;

}
    
?>


<?php 
    include_once "inc/header.php";
?>

<!-- Cart section -->
<section class="cart container mt-5 my-3 py-5">
    <div class="container mt-5">
        <h2 class="font-weight-bold">Your Cart</h2>
        <hr>
    </div>


    <table class="mt-5 pt-5 table table-dark table-hover table-responsive-xl">
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>

        <?php if (isset($_SESSION['cart'])){ ?>
            <?php foreach($_SESSION['cart'] as $key => $value){ ?>
        <tr>
            <td>
                <div class="product-info d-flex">
                    <img src="<?php echo 'assets/images/'.$value['product_image']; ?>" class="cart-table-img">
                    <div class="ml-3">
                        <p><?php echo $value['product_name']; ?> </p>
                        <small><span>Price of one: $</span><?php echo $value['product_price']; ?></small>
                        <br>
                    </div>
                </div>
            </td>
            <td>
                <form action="cart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                    <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>">
                    <input type="submit" name="edit_quantity_btn" class="btn btn-outline-primary" value="edit">
                </form>
            </td>
            <td>
                <span class="product-price">$<?php echo $value['product_price']*$value['product_quantity']; ?></span>
                <br>
                <form action="cart.php" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                            <input type="submit" class="btn btn-outline-danger mt-2" name="remove_btn" value="remove">
                        </form>
            </td>
        </tr>

            <?php } ?>
        <?php } ?>

    </table> 
    <div class="cart-total text-center">
      
        <p>Total: $ <?php if (isset($_SESSION['cart'])){ echo $_SESSION['total'];}?></p>
        <form method="GET" action="checkout.php">
            <input type="submit" class="btn btn-primary" value="Checkout" name="checkout_btn">
        </form>
    </div>


    <div class="check-container">
        
    </div>

</section>

<!-- End Cart section -->






<?php 
    include_once "inc/footer.php";
?>