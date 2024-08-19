<?php
    require_once "stripe-php-master/init.php";

    $stripeDetails = array(
        "secretKey" => "sk_test_51OTdSkFOLOhoKPosyIjKiF7j6oejzCsHOMcIBvFhKC2zPpGopbPMX8qVNgyMXoHeg5jXZASDiRM75Umj1rZeSEC100H5v2rvOE",
        "publishableKey" => "pk_test_51OTdSkFOLOhoKPosClrXAz58BejmHK3U7xGmOuJGaDdknT3xtyvQCU0epXoUiVRN1xwiPu48H3YywXVSdDVoF57I00mr73ldTd"
    );

    \Stripe\Stripe::setApiKey($stripeDetails["secretKey"]);
?>