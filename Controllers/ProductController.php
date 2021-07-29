<?php
namespace Controllers;

class ProductController  extends MainController{

    public function showProducts()
    {
       // $cart = $this->productsManager->viewCart($_SESSION["id_panier"]);
        $allProducts = [];
        if (!empty($_GET["category"]) && !empty($_GET["paging"])){
            $count = $this->productsManager->countProduitByCategory($_GET["category"]);
            $numberOfPages = ceil($count["COUNT(*)"]/SELF::LIMIT);
            $category = $this->productsManager->getCategory($_GET["category"]);
            if ($category === null){
                $this->displayError();
            }
            if ($_GET["paging"]<1 || $_GET["paging"]>$numberOfPages){
                $this->displayError();
            } else {
                $allProducts = $this->productsManager->allProductsByCategory($_GET["category"], SELF::LIMIT, ($_GET["paging"]-1)*SELF::LIMIT);
            }
        } else {
            $this->displayError();
            $category = NULL;
            $count = NULL;
            $numberOfPages = NULL;
        }
        $data_page = [
            "page_description" => "Page produits",
            "page_title" => "Page produits",
            "products" => $allProducts,
            "category" => $category,
            "count" => $count,
            "numberOfPages" => $numberOfPages,
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

    public function modifyQuantity()
    {
        if (isset($_POST["quantity"], $_POST['idProduct'], $_POST["stock"])){
            if ($_POST["quantity"] > 0 && $_POST["quantity"] <= $_POST["stock"]){
                $_SESSION["alert"] = [
                    "message" => "Vous avez bien modifié le nombre d'article souhaité",
                    "type" => SELF::ALERT_SUCCESS
                ];
                $this->productsManager->addQuantityProduct($_POST["quantity"], $_POST['idProduct']);    
            } else {
                $_SESSION["alert"] = [
                    "message" => "Vous ne pouvez pas avoir une quantité à 0 ou supérieure à notre stock",
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

    public function payWithStripe()
    {
        $data_page = [
            "page_description" => "Checkout",
            "page_title" => "Checkout",
            "view" => "Views/checkout.html",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }

    public function deleted()
    {
        $allProducts = $this->productsManager->allProductsNoOffset();
        $this->productsManager->deleteProduct($_GET["id"]);
        $_SESSION["alert"] = [
            "message" => "Le produit a bien été supprimé",
            "type" => SELF::ALERT_SUCCESS
        ];
        $data_page = [
            "page_description" => "Supprimer des produits",
            "page_title" => "Supprimer des produits",
            "allProducts" => $allProducts,
            "view" => "Views/deleteProduct.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }

}