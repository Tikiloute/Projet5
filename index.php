<?php 
session_start();

require('Controllers/autoload.controller.php');

//permet de bien pointer si plusieurs niveaux de dossier sont nécessaire (ex: si home/articles nous pointons vrs articles et que nous repassons sur accueil nous aurons accueil/home sans ce URL)
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS'])? "https" : "http")."://".$_SERVER['HTTP_HOST'].$_SERVER["PHP_SELF"]));


$mainController = new \Controllers\MainController();
$connectionController = new \Controllers\ConnectionController();

try{
    if(empty($_GET['page'])){
        $page = "accueil";
    }else {
        $url = explode("/", filter_var($_GET["page"]), FILTER_SANITIZE_URL); //This filter allows all letters, digits and $-_.+!*'(),{}|\\^~[]`"><#%;/?:@&=
        $page = $url[0];
    }

    switch($page){
        case "accueil":
            $mainController->home();
        break;

        case "page1":
            $mainController->page1();
        break;

        case "page2":
            $mainController->page2();
        break;

        case "cart":
            $mainController->panier();
        break;

        case "connect":
           if(!empty($url[1])){

                switch($url[1]){

                    case "connected" :
                        $connectionController->connected();
                    break;

                    case "createAccount" :
                        $connectionController->createAccount();
                    break;

                    case "accountCreated":
                        $connectionController->accountCreated();
                    break;

                    default : $connectionController->connection();
                }
           }else{
            $connectionController->connection();
           }
        break;

        case "disconnect":
            $connectionController->disconnect();
        break;

        default : throw new Exception("La page n'existe pas"); //on lance une nouvelle exception
    }
} catch(Exception $e) {
    $mainController->pageError($e->getMessage());
}

?>