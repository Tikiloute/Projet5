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
        if (!empty($_SESSION["id_panier"])){
            $carts = $this->productsManager->viewCart($_SESSION["id_panier"]);
        } else {
            $carts = NULL;
        }
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

    public function success()
    {
        $_SESSION["alert"] = [
            "message" => "Votre achat a bien été effectué !",
            "type" => SELF::ALERT_SUCCESS
        ];
        $data_page = [
            "page_description" => "Success",
            "page_title" => "Success",
            "view" => "Views\stripeSuccess.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }

}