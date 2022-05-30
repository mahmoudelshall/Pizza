<?php 

session_start();

include_once('connection.php');
if(isset($_GET['transaction_id']) && isset($_SESSION['order_id'])){
            
            //  change order status to paid
            $order_status = "paid";
            $order_id = $_SESSION['order_id'];
            $payment_date = date("Y-m-d h:i:s");
            $transaction_id=$_GET['transaction_id'];
            $sql = "UPDATE orders set order_status = '$order_status'  where order_id = $order_id";
    
            $order_op  = mysqli_query($conn, $sql);
            // echo mysqli_error($con);
            //exit;

 

           // store payment info    
           $sql = "INSERT INTO payments (order_id,transaction_id,payment_date)
            VALUES ($order_id,'$transaction_id','$payment_date')";
           $payment_op  = mysqli_query($conn, $sql); 

           header("location: thank_you.php?success_message=thank for shopping with us");
        exit;

    }else{
        header("location: index.php");


    }



?>