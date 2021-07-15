<?php
namespace Controllers;

class CartController  extends MainController{

    public function cart()
    {
        $data_page = [
            "page_description" => "Panier",
            "page_title" => "panier",
            "view" => "Views/panier.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }

    public function viewCart()
    {

        $carts = $this->productsManager->viewCart($_SESSION["id_panier"]);
        $data_page = [
            "page_description" => "Panier",
            "page_title" => "panier",
            "view" => "Views/panier.view.php",
            "cart" => $carts,
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }

    public function checkout()
    {
        $cart = $this->productsManager->viewCart($_SESSION["id_panier"]);
       // var_dump($cart);
        $user = $this->usermanager->viewUser($_SESSION["login"]);
        $data_page = [
            "page_description" => "checkout",
            "page_title" => "checkout",
            "view" => "Views/checkout.view.php",
            "cart" => $cart,
            "user" => $user,
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }

}