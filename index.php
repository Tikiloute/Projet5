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
                        $cartController->deleteProductCart();
                        break;

                    default : $cartController->viewCart();
                }
            } else {
                $cartController->viewCart();
                $cartController->lockCart();
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
            $connectionController->disconnect();
            break;

        case "products":

            if (!empty($url[1])) {

                switch ($url[1]) {

                    case "addToCart" : $cartController->addToCart();
                    break;
                
                }
            }
            
            $productController->showProducts();
            break;

        case "product":

            if (!empty($url[1])) {

                switch ($url[1]) {

                    case "addToCart" : $cartController->addToCart();
                    break;
         
                }
            }

            $productController->showOneProduct();
            break;
        
        case "checkout": 
            $cartController->checkout();
            $cartController->lockCart();
            break;

        case "payStripe":

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
