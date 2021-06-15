<?php
namespace Controllers;

class AdministratorController  extends MainController{

    public function stock()
    {
        if (isset($_POST["addStock"])){
            $stock = $_POST["addStock"] + $_GET['stock'];
            $this->products->updateStock($stock, $_GET["id"]);
            header("location connect/stock");
        }
        $products = $this->products->allProducts();
        $data_page = [
            "page_description" => "Espace personnel",
            "page_title" => "Espace personnel",
            "produits" => $products,
            "view" => "Views/stock.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page); 
    }

    public function modifyAdministratorIdentify()
    {
        $user = $this->user->viewUser($_SESSION["login"]);
        if (!empty($_POST["changePassword"]) && $_POST["changePassword"] === $_POST["ConfirmPassword"]){
                $mdp = password_hash($_POST["changePassword"], PASSWORD_DEFAULT);
                if (empty($_POST["changeLogin"])){ //si login est vide on passe ici
                    if (password_verify($_POST["changePassword"], $user["password"]) === false){ //si les mots de passe $_POST et db sont differents
                        $this->user->modifyAccountInfo($user["id"], $user["identifiant"], $mdp);
                        $_SESSION["alert"] = [
                            "message" => "Votre mot de passe a bien été changé !",
                            "type" => "alert-success"
                        ];
                    } else {
                        $_SESSION["alert"] = [
                            "message" => "Votre mot de passe est identique à l'ancien, veuillez le changer !",
                            "type" => "alert-danger"
                        ];
                    }
                } else { //si login est rempli on passe ici
                    if ($_POST["changePassword"] === $_POST["ConfirmPassword"] && $_POST["changeLogin"] != $user["identifiant"]){
                        $this->user->modifyAccountInfo($user["id"], $_POST["changeLogin"], $mdp);
                        $_SESSION["alert"] = [
                            "message" => "Vos informations ont bien été changées !",
                            "type" => "alert-success"
                        ];
                        unset($_SESSION["login"]);
                        $_SESSION["login"] = $_POST["changeLogin"];
                    } else {
                        $_SESSION["alert"] = [
                            "message" => "Votre identifiant et/ou mot de passe sont identiques !",
                            "type" => "alert-danger"
                        ];
                    }
                }
        } else {
            if (isset($_POST["changePassword"]) || isset($_POST["ConfirmPassword"])){
                $_SESSION["alert"] = [
                    "message" => "Vos champs sont vides, veuillez les remplir",
                    "type" => "alert-danger"
                ];
            }
        }
        $data_page = [
            "page_description" => "Espace personnel",
            "page_title" => "Espace personnel",
            "view" => "Views/modifyAdministratorIdentify.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page); 
    }

    public function modifyRole()
    {
        $data_page = [
            "page_description" => "Espace personnel",
            "page_title" => "Espace personnel",
            "view" => "Views/modifyRole.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page); 
        var_dump($_POST["role"]);
    }

    public function modifyProduct()
    {
        $product = $this->products->products();
        var_dump($product);
        $data_page = [
            "page_description" => "Espace personnel",
            "page_title" => "Espace personnel",
            "products" => $product,
            "view" => "Views/modifyProduct.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }
}