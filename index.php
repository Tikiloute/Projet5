<?php 
session_start();

require('Controllers/autoload.controller.php');
require_once('vendor\stripe\stripe-php\init.php');


use Controllers\MainController;
use Controllers\ConnectionController;
use Controllers\AdministratorController;
use Controllers\ProductController;
use Controllers\CartController;
use Models\ProductsManager;

//permet de bien pointer si plusieurs niveaux de dossier sont nécessaire (ex: si home/articles nous pointons vrs articles et que nous repassons sur accueil nous aurons accueil/home sans ce URL)
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS'])? "https" : "http")."://".$_SERVER['HTTP_HOST'].$_SERVER["PHP_SELF"]));

// $stripe = new \Stripe\StripeClient("sk_test_51JDYWyGStSoF0gzC9IZjXGtkdETZFGyVvnSSXgnE6IzwRYCsHlRDeIdkxo6CHHLhUngZUdUf0aJZI7x7eIApz4Yp00k4yrTfKR");

// $customer = $stripe->customers->create([
//     'description' => 'example customer',
//     'email' => 'bruno.etcheverry@hotmail.fr',
//     'payment_method' => 'pm_card_visa',
//     'balance' => 1000,
// ]);

//var_dump($stripe);
//var_dump($stripe->charges->create([]));
$mainController = new MainController();
$connectionController = new ConnectionController();
$administratorController = new AdministratorController();
$productController = new ProductController();
$cartController = new CartController();
$productsManager = new ProductsManager();

define("CATEGORY", $productsManager->category());

//variable globale category

try {
    if (empty($_GET['page'])) {
        $page = "accueil";
    } else {
        $url = explode("/", filter_var($_GET["page"]), FILTER_SANITIZE_URL); //This filter allows all letters, digits and $-_.+!*'(),{}|\\^~[]`"><#%;/?:@&=
        $page = $url[0];
    }

    switch ($page) {
        case "accueil":
            $mainController->home();
            break;

        case "cart":
            if (!empty($url[1])) {

                switch ($url[1]) {

                    case "modifyQuantity" :
                        $productController->modifyQuantity();
                        break;

                    case "deleteProductCart" :
                        $productController->deleteProductCart();
                        break;

                    default : $cartController->viewCart();
                }
            } else {
                $cartController->viewCart();
                break;
            }

            $cartController->viewCart();
            break;

        case "connect":
           if (!empty($url[1])) {

                switch ($url[1]) {

                    case "connected" :
                        if (!empty($url[2])){
                            switch ($url[2]) {

                                case "billAddress" : 
                                    $administratorController->addBillAddress();
                                    break;
                                
                                default : $connectionController->connected();
                            }
                        }
                        $connectionController->connected();
                        break;

                    case "createAccount" :
                        $connectionController->createAccount();
                        break;

                    case "accountCreated":
                        $connectionController->accountCreated();
                        break;

                    case "stock":
                        $administratorController->stock();
                        break;

                    case "modifyAdministratorIdentify" :
                        $administratorController->modifyAdministratorIdentify();
                        break;

                    case "modifyRole" :
                        $administratorController->modifyRole();
                        break;

                    case "modifyRoleValidate" :
                        $administratorController->validateRole();
                        break;

                    case "modifyProduct" :
                        $administratorController->modifyProduct();
                        break;

                    case "productModified" :
                        $administratorController->modifyProduct();
                        break;

                    case "addProduct" :
                        $administratorController->addProduct();
                        break;

                    default : $connectionController->connection();
                }
           } else {
                $connectionController->connection();
                break;
           }
            break;
        
        case "disconnect": 
            var_dump("disconnect");
            $connectionController->disconnect();
            break;

        case "products":

            if (!empty($url[1])) {

                switch ($url[1]) {

                    case "addToCart" : $productController->addToCart();
                    break;
                
                }
            }
            
            $productController->showProducts();
            break;

        case "product":

            if (!empty($url[1])) {

                switch ($url[1]) {

                    case "addToCart" : $productController->addToCart();
                    break;
         
                }
            }

            $productController->showOneProduct();
            break;
        
        case "checkout": 
            $cartController->checkout();
            break;

        case "payStripe":

            if (!empty($url[1])) {

                switch ($url[1]) {

                    case "success" : $cartController->success();
                    break;

                    case "cancel" : $productController->addToCart();
                    break;
                } 
            }

            require_once('create-checkout-session.php');
            break;

            case "stripeSuccess": 
                $cartController->success();
                break;

        default : throw new Exception ("La page n'existe pas"); //on lance une nouvelle exception
    }
} catch (Exception $e) {
    $mainController->pageError($e->getMessage());
}
