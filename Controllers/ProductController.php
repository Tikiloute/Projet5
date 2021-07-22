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

    public function payWithStripe()
    {
        $data_page = [
            "page_description" => "Page produit",
            "page_title" => "Page produit",
            "view" => "Views/checkout.html",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }

}