<?php
namespace Controllers;

class ProductController  extends MainController{

    public function showProducts()
    {
       // $cart = $this->productsManager->viewCart($_SESSION["id_panier"]);
        $allProducts = [];
        if (!empty($_GET["category"])){
            $category = $this->productsManager->getCategory($_GET["category"]);
            if ($category === null){
                $this->displayError();
            }
            $allProducts = $this->productsManager->allProductsByCategory($_GET["category"]);
        } else {
            $this->displayError();
        }
        $data_page = [
            "page_description" => "Page produits",
            "page_title" => "Page produits",
            "products" => $allProducts,
            "view" => "Views/products.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }

    private function displayError()
    {
        $_SESSION["alert"] = [
            "message" => "Cette page n'existe pas !",
            "type" => SELF::ALERT_DANGER
        ];
    }

    public function showOneProduct()
    {
        $oneProduct = $this->productsManager->showOneProduct($_GET["id"]);
        $data_page = [
            "page_description" => "Page produit",
            "page_title" => "Page produit",
            "oneProduct" => $oneProduct,
            "view" => "Views/oneProduct.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }

    public function addToCart()
    {
        if(!empty($_SESSION["connected"]) && $_SESSION["connected"] === true){
            $id = $_GET["id"];
            $id_panier = bin2hex(openssl_random_pseudo_bytes(10)); //var_char aleatoire à 10 caractères
            if (empty($_SESSION["id_panier"])){
                $_SESSION["id_panier"] = $id_panier;
            }
            $aimCartProduct = $this->productsManager->aimViewCart($_SESSION["id_panier"], $id);
            if (empty($aimCartProduct)){
                if (isset($_SESSION["id_panier"], $id, $_SESSION["idUser"])){
                    $this->productsManager->addToCart($_SESSION["id_panier"], $_SESSION["idUser"], $id);
                    $_SESSION["alert"] = [
                        "message" => "Article bien ajouté à votre panier !",
                        "type" => SELF::ALERT_SUCCESS
                    ];
                    if (!empty($_POST["numberProduct"])){
                        $addQuantity = $aimCartProduct[0]["quantity"] + $_POST["numberProduct"];
                        $this->productsManager->addQuantityProduct($addQuantity, $id);
                    }    
                }
            }else {
                if (empty($_POST["numberProduct"])){
                    $addQuantity = $aimCartProduct[0]["quantity"] +1;
                } else {
                    $addQuantity = $aimCartProduct[0]["quantity"] + $_POST["numberProduct"];
                }
                $this->productsManager->addQuantityProduct($addQuantity, $id);
                $_SESSION["alert"] = [
                    "message" => "Vous avez bien rajouté un exemplaire à cet article dans votre panier !",
                    "type" => SELF::ALERT_SUCCESS
                ];
            }
        } else {
            $_SESSION["alert"] = [
                "message" => "Vous devez vous connecter avant d'ajouter des produits dans votre panier",
                "type" => SELF::ALERT_DANGER
            ];
        }
    }

    public function modifyQuantity()
    {
        if (isset($_POST["quantity"], $_POST['idProduct'])){
            if ($_POST["quantity"] > 0){
                $_SESSION["alert"] = [
                    "message" => "Vous avez bien modifié le nombre d'article souhaité",
                    "type" => SELF::ALERT_SUCCESS
                ];
                $this->productsManager->addQuantityProduct($_POST["quantity"], $_POST['idProduct']);    
            } else {
                $_SESSION["alert"] = [
                    "message" => "Vous ne pouvez pas avoir une quantité à 0",
                    "type" => SELF::ALERT_DANGER
                ];
            }
        } else {
            $_SESSION["alert"] = [
                "message" => "Une erreur s'est produite, veuillez réessayer !",
                "type" => SELF::ALERT_DANGER
            ];
        }
    }

}