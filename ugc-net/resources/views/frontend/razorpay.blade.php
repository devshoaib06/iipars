<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Razorpay</title>

        <script type="text/javascript" src="https://checkout.razorpay.com/v1/razorpay.js"></script>
        <script type="text/javascript">
            var razorpay = new Razorpay({
              key: '<?php echo $api_key; ?>',
                // logo, displayed in the payment processing popup
              image: 'https://i.imgur.com/n5tjHFD.png',
            });
            razorpay.once('ready', function(response) {
              console.log(response.methods);
            });
            
            
        </script>
    </head>
    <body>
        <button id="rzp-button1">Pay</button>
        <!-- <form action="https://www.example.com/payment/success/" method="POST">
        <script
            src="https://checkout.razorpay.com/v1/checkout.js"
            data-key="<?php echo $api_key; ?>" 
            data-amount="<?php echo $details['amount']?>"
            data-currency="<?php echo $details['currency']?>"
            data-order_id="<?php echo $order['id']?>"
            data-buttontext="Pay with Razorpay"
            data-name="Karmick"
            data-description="A simple test script"
            data-image="https://example.com/your_logo.jpg"
            data-prefill.name="Supratim Mukherjee"
            data-prefill.email="karmicksol207@gmail.com"
            data-prefill.contact="9999999999"
            data-theme.color="#F37254"
        ></script>
        <input type="hidden" custom="Hidden Element" name="hidden">
        </form> -->
    </body>
   
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
    var options = {
        "key": "<?php echo $api_key; ?>", // Enter the Key ID generated from the Dashboard
        "amount": "<?php echo $api_key; ?>", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise or INR 500.
        "currency": "<?php echo $details['currency']?>",
        "name": "Karmick",
        "description": "A simple test script",
        "image": "http://teachinns.karmickdev.com/public/frontend/images/logo.png",
        "order_id": "<?php echo $order['id']?>",//This is a sample Order ID. Create an Order using Orders API. (https://razorpay.com/docs/payment-gateway/orders/integration/#step-1-create-an-order). Refer the Checkout form table given below
        "handler": function (response){
            alert(response.razorpay_payment_id);
        },
        "prefill": {
            "name": "Supratim Mukherjee",
            "email": "karmicksol207@gmail.com",
            "contact": "9999999999"
        },
        "notes": {
            "address": "note value"
        },
        "theme": {
            "color": "#F37254"
        }
    };
    var rzp1 = new Razorpay(options);
    
    document.getElementById('rzp-button1').onclick = function(e){
        rzp1.open();
        e.preventDefault();
    }
    </script>
</html>
