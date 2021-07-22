<?php
require 'vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_51JDYWyGStSoF0gzC9IZjXGtkdETZFGyVvnSSXgnE6IzwRYCsHlRDeIdkxo6CHHLhUngZUdUf0aJZI7x7eIApz4Yp00k4yrTfKR');

//header('Content-Type: application/json');

// $checkout_session = \Stripe\Checkout\Session::create([
//   'payment_method_types' => ['card'],
//   'line_items' => [[
//     'price_data' => [
//       'currency' => 'eur',
//       'unit_amount' => $_SESSION["prixGlobal"]*100,
//       'product_data' => [
//         'name' => 'Votre panier',
//         'images' =>["https://i.imgur.com/CVZxaZS.jpg"],
//       ],
//     ],
//     'quantity' => 1,
//   ]],
//   'mode' => 'payment',
//   'success_url' => URL."stripeSuccess",
//   'cancel_url' => URL. 'checkout',
// ]);


// $_SESSION["payment_intent"] = $checkout_session->toArray()["payment_intent"];
echo "<pre>";
var_dump(\Stripe\PaymentIntent::retrieve($_SESSION["payment_intent"])->toArray()["charges"]["data"][0]["paid"]);

echo "</pre>";

var_dump(\Stripe\PaymentIntent::retrieve($_SESSION["payment_intent"])->toArray()["paid"]);

var_dump($_SESSION["payment_intent"]);
var_dump($_SESSION["paid"] ?? "Non payé");

//header("HTTP/1.1 303 See Other");
//header("Location: " . $checkout_session->url);
?>
<p>L'équipe de Mr Shopping vous remercie pour votre achat !</p>
<a class="btn btn-primary" href="<?=URL?>accueil">Revenir à l'accueil</a>

<?php

