<?php
$MERCHANT_KEY = "WnvQF6Tj";
$SALT = "CQwuLpS6QW";

// Merchant Key and Salt as provided by Payu.
//$hash = hash('sha512','WnvQF6Tj|1|200|testprod|smitha|smitha@thewhiteboard.company|weqwe231313||||||||||CQwuLpS6QW');

// $PAYU_BASE_URL = "https://sandboxsecure.payu.in";     // For Sandbox Mode
//$PAYU_BASE_URL = "https://secure.payu.in";            // For Production Mode
//$PAYU_BASE_URL = "https://test.payu.in";

$action = '';

?>
<html>
  <head>
  <script>
   // var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      /*if(hash == '') {
        return;
      }*/
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
  </head>
  <body onload="submitPayuForm()">
    <h2>Processing payment</h2>
    <p>Redirecting to payment. Please wait......</p>
    <img src="{{ URL::to('/') }}/images/processing.gif" alt="processing" width="350" height="350" class="img-responsive" />
    <br/> 
    <?php $formError=0; if($formError) { //https://www.payumoney.com/sandbox/citruspage/#/view/522FBC24284B242032BBCBB4ACF26F29?>
    
      <span style="color:red">Please fill all mandatory fields.</span>
      <br/>
      <br/>
    <?php } ?>  
    <form action="https://secure.payu.in/_payment" method="post" name="payuForm">
      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
      <input type="hidden" name="amount" value="<?php echo $amt ?>" />
      <input type="hidden" name="productinfo" value="<?php echo $productinfo ?>" />
      <input type="hidden" name="service_provider" value="payu_paisa" />
      <input type="hidden" name="firstname" value="<?php echo $firstname ?>" />
      <input type="hidden" name="email" value="<?php echo $email ?>" />
      <input type="hidden" name="phone" value="<?php echo $phone ?>" />
      <input type="hidden" name="currency_code" value="<?php echo $currency ?>" />
      <input type="hidden" name="surl" value="http://www.redcarpetassist.com/payment-success" />
      <input type="hidden" name="furl" value="http://www.redcarpetassist.com/payment-fail" />
      <input type="hidden" name="curl" value="http://www.redcarpetassist.com/payment-cancel" />
      <!--<input type="text" name="udf1" value="4353453535345">-->
      <!--<input type="submit" name="" value="Submit">-->
    </form>
  </body>
</html>