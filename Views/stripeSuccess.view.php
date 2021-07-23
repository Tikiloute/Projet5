<?php
require 'vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_51JDYWyGStSoF0gzC9IZjXGtkdETZFGyVvnSSXgnE6IzwRYCsHlRDeIdkxo6CHHLhUngZUdUf0aJZI7x7eIApz4Yp00k4yrTfKR');

// $_SESSION["payment_intent"] = $checkout_session->toArray()["payment_intent"];
$paid =\Stripe\PaymentIntent::retrieve($_SESSION["payment_intent"])->toArray()["charges"]["data"][0]["paid"];

// echo "<pre>";
// var_dump(\Stripe\PaymentIntent::retrieve($_SESSION["payment_intent"])->toArray()["charges"]["data"][0]["paid"]);
// echo "</pre>";

//var_dump($_SESSION["payment_intent"]);
//var_dump(\Stripe\PaymentIntent::retrieve($_SESSION["payment_intent"])->toArray());

if (\Stripe\PaymentIntent::retrieve($_SESSION["payment_intent"])->toArray()["id"] === $_SESSION["payment_intent"]){
    if ($paid == true){
    ?>
    <p>L'équipe de Mr Shopping vous remercie pour votre achat !</p>
    <a class="btn btn-primary" href="<?=URL?>accueil">Revenir à l'accueil</a>

    <?php
    } else {
        echo "erreur paiement veuillez recommencer ou contacter notre service client !";
    }
}
