<?php
namespace Controllers;

class ProductController  extends MainController{

    public function showProducts()
    {
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
            "page_description" => "Espace personnel",
            "page_title" => "Espace personnel",
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
        var_dump($_SESSION["id_panier"]);
        $data_page = [
            "page_description" => "Espace personnel",
            "page_title" => "Espace personnel",
            "oneProduct" => $oneProduct,
            "view" => "Views/oneProduct.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }

    public function addToCart()
    {
        $cart = $this->productsManager->viewCart($_SESSION["id_panier"]);
        var_dump($_SESSION["id_panier"]);
        $this->productsManager->addToCart($_SESSION["id_panier"], $_SESSION["idUser"], $_GET["id"]);
        $_SESSION["alert"] = [
            "message" => "Article bien ajouté à votre panier !",
            "type" => SELF::ALERT_SUCCESS
        ];
        var_dump($cart);
    }

}