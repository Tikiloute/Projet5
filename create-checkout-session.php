<?php

require 'vendor/autoload.php';
\Stripe\Stripe::setApiKey('sk_test_51JDYWyGStSoF0gzC9IZjXGtkdETZFGyVvnSSXgnE6IzwRYCsHlRDeIdkxo6CHHLhUngZUdUf0aJZI7x7eIApz4Yp00k4yrTfKR');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost:projet5-1';

$checkout_session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card'],
  'line_items' => [[
    'price_data' => [
      'currency' => 'eur',
      'unit_amount' => $_SESSION["prixGlobal"]*100,
      'product_data' => [
        'name' => 'Votre panier',
        'images' =>["https://i.imgur.com/CVZxaZS.jpg"],
      ],
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => URL.'stripeSuccess',
  'cancel_url' => URL. 'payStripe/cancel.html',
]);

//header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);