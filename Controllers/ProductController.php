<?php
namespace Controllers;

class ProductController  extends MainController{

    public function showProducts()
    {
        if(!empty($_GET["category"])){
            $allProducts = $this->productsManager->allProducts();
           // $countByCategory = $this->productsManager->countCategory($)
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

    public function showOneProduct()
    {
        $oneProduct = $this->productsManager->showOneProduct($_GET["id"]);

        $data_page = [
            "page_description" => "Espace personnel",
            "page_title" => "Espace personnel",
            "oneProduct" => $oneProduct,
            "view" => "Views/oneProduct.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }

}