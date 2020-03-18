<?php

ob_start();
    //start session 
    session_start();
    //include config
    require('config.php');

   
    // require("admin/index.php");
    // require("admin/admin_functions.php");

    require("classes/meRaviQr/qrlib.php");
    require('classes/Messages.php');
    require('classes/Mail.php');
    require('classes/Bootstrap.php');
    require('classes/Controller.php');
    require('classes/Model.php');

    require('controllers/home.php');
    require('controllers/events.php');
    require('controllers/users.php');
    require('controllers/transactions.php');
    require('controllers/about.php');
    require('controllers/team.php');
    require('controllers/contact.php');

    require('models/home.php');
    require('models/user.php');
    require('models/event.php');
    require('models/transaction.php');
    require('models/about.php');
    require('models/team.php');
    require('models/contact.php');



    $bootstrap = new Bootstrap($_GET);

    //print_r($_GET);

    $controller = $bootstrap->createController();

    if($controller) {
        $controller->executeAction();
    }


    // flutter wave api
function flutter_wave (){
  
if (isset($_SESSION['total_price']) && $_SESSION['total_price'] > 0 ){

$rave = <<<DELIMETER
<input type="submit" class="btn btn-primary flutter_btn" style="cursor:pointer;" value="Pay Now" id="submit" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
<script type="text/javascript">
 
  document.addEventListener("DOMContentLoaded", function(event) {
    document.getElementById('submit').addEventListener('click', function () {
        let cust_email      = document.getElementById('email').value;
        let cust_number     = document.getElementById('number').value;
        let cust_name       = document.getElementById('name').value;
    


    var flw_ref = "", chargeResponse = "", trxref = "YOUCONNECT"+ Math.random(), API_publicKey = "FLWPUBK_TEST-6921d097ab745d1e299bccf98fbc7ac1-X";

    getpaidSetup(
      {
        PBFPubKey: "FLWPUBK_TEST-6921d097ab745d1e299bccf98fbc7ac1-X",
      	customer_email: cust_email,
      	amount: {$_SESSION['ticket_total_price']},
        customer_phone: cust_number,
        currency: "NGN",
        cust_name: cust_name,
      	txref: "YOUCONNECT"+ Math.random(),
      	meta: [{metaname:"flightID", metavalue: "AP1234"}],
        onclose:function(response) {
        },
        callback:function(response) {
          currency = "NGN"
          amount = {$_SESSION['ticket_total_price']};
          txref = response.tx.txRef, chargeResponse = response.tx.chargeResponseCode;
          if (chargeResponse == "00" || chargeResponse == "0") {
            window.location = "/daveTicket/index?controller=transactions&txref="+txref+"&amt="+amount+"&cur="+currency+"&name="+cust_name+""; //Add your success page here
          } else {
            window.location = "../public/payverification_fail.php?txref="+txref;  //Add your failure page here
          }
        }
      }
    );
    });
  });
</script>

DELIMETER;

echo $rave;

    }

}

?>
