<?php
namespace Controllers;

class AdministratorController  extends MainController{
    public function stock()
    {
        $products = $this->products->products();
        var_dump($products);
        $data_page = [
            "page_description" => "Espace personnel",
            "page_title" => "Espace personnel",
            "produits" => $products,
            "view" => "Views/stock.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page); 
    }
}