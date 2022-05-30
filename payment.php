<?php 
session_start();

?>


<?php 
    include_once "inc/header.php";
?>




<section class="ftco-section contact-section">
    <div class="container mt-5">
        <p class="text-center font-weight-bold" style="font-size: 1.8rem;">Payment</p>
    </div>
    <div class="mx-auto container text-center">
    <?php if(isset($_SESSION['order_id']) && $_SESSION['order_id']!=0
            && isset($_SESSION['total']) && $_SESSION['total']!=0 ){?>
        <?php $amount = strval($_SESSION['total']); ?>
        <p>Total: $ <?php echo $_SESSION['total'] ?></p>
        <div id="paypal-button-container"></div>
        
    <?php }else{?>

        <p> you don't have any order</p>

    <?php } ?>
    </div>
</section>



        <!-- Sample PayPal credentials (client-id) are included -->
        <script src="https://www.paypal.com/sdk/js?client-id=Ae4OiW5Plm5OSVZDNzEGtXL6WCWGV2_Qco30UdQK77jVeiDA4iqv5Epi1qSdYeJe4aByBuQaYLKzpt7w&currency=USD&intent=capture"></script>
        <script>
          const paypalButtonsComponent = paypal.Buttons({
              // optional styling for buttons
              // https://developer.paypal.com/docs/checkout/standard/customize/buttons-style-guide/
              style: {
                color: "gold",
                shape: "rect",
                layout: "vertical"
              },

              // set up the transaction
              createOrder: (data, actions) => {
                  // pass in any options from the v2 orders create call:
                  // https://developer.paypal.com/api/orders/v2/#orders-create-request-body
                  const createOrderPayload = {
                      purchase_units: [
                          {
                              amount: {
                                  value: "<?php echo $amount; ?>"
                              }
                          }
                      ]
                  };

                  return actions.order.create(createOrderPayload);
              },

              // finalize the transaction
              onApprove: (data, actions) => {
                  const captureOrderHandler = (details) => {
                      const payerName = details.payer.name.given_name;
                      const transaction = details.purchase_units[0].payments.captures[0];
                      console.log('Transaction completed');

                      window.location.href = "complete_payment.php?transaction_id="+transaction.id;

                  };
                  return actions.order.capture().then(captureOrderHandler);
              },

              // handle unrecoverable errors
              onError: (err) => {
                  console.error('An error prevented the buyer from checking out with PayPal');
              }
          });

          paypalButtonsComponent
              .render("#paypal-button-container")
              .catch((err) => {
                  console.error('PayPal Buttons failed to render');
              });
        </script>




<?php 
    include_once "inc/footer.php";
?>