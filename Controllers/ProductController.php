<?php
namespace Controllers;

class ProductController  extends MainController{

    public function showProducts()
    {
        if(!empty($_GET["category"])){
            $allProducts = $this->productsManager->allProducts();
        } else {
            $_SESSION["alert"] = [
                "message" => "Cette page n'existe pas !",
                "type" => SELF::ALERT_DANGER
            ];
        }
        if(isset($allProducts)){
            $data_page = [
                "page_description" => "Espace personnel",
                "page_title" => "Espace personnel",
                "products" => $allProducts,
                "view" => "Views/products.view.php",
                "template" => "Views/common/template.php"
            ];
            $this->newPage($data_page);
        } else {
            $data_page = [
                "page_description" => "Espace personnel",
                "page_title" => "Espace personnel",
                "view" => "Views/products.view.php",
                "template" => "Views/common/template.php"
            ];
            $this->newPage($data_page);
        } 
    }




}