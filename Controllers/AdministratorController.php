<?php
namespace Controllers;

class AdministratorController  extends MainController{

    public function stock()
    {
        if (isset($_POST["addStock"])){
            $stock = $_POST["addStock"] + $_GET['stock'];
            $this->productsManagager->updateStock($stock, $_GET["id"]);
            header("location connect/stock");
        }
        $productsManagager = $this->productsManagager->allProducts();
        $data_page = [
            "page_description" => "Espace personnel",
            "page_title" => "Espace personnel",
            "produits" => $productsManagager,
            "view" => "Views/stock.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page); 
    }

    public function modifyAdministratorIdentify()
    {
        $user = $this->usermanager->viewUser($_SESSION["login"]);
        if (!empty($_POST["changePassword"]) && $_POST["changePassword"] === $_POST["ConfirmPassword"]){
                $mdp = password_hash($_POST["changePassword"], PASSWORD_DEFAULT);
                if (empty($_POST["changeLogin"])){ //si login est vide on passe ici
                    if (password_verify($_POST["changePassword"], $user["password"]) === false){ //si les mots de passe $_POST et db sont differents
                        $this->usermanager->modifyAccountInfo($user["id"], $user["identifiant"], $mdp);
                        $_SESSION["alert"] = [
                            "message" => "Votre mot de passe a bien été changé !",
                            "type" => SELF::ALERT_SUCCESS
                        ];
                    } else {
                        $_SESSION["alert"] = [
                            "message" => "Votre mot de passe est identique à l'ancien, veuillez le changer !",
                            "type" => SELF::ALERT_DANGER
                        ];
                    }
                } else { //si login est rempli on passe ici
                    if ($_POST["changePassword"] === $_POST["ConfirmPassword"] && $_POST["changeLogin"] != $user["identifiant"]){
                        $this->usermanager->modifyAccountInfo($user["id"], $_POST["changeLogin"], $mdp);
                        $_SESSION["alert"] = [
                            "message" => "Vos informations ont bien été changées !",
                            "type" => SELF::ALERT_SUCCESS
                        ];
                        unset($_SESSION["login"]);
                        $_SESSION["login"] = $_POST["changeLogin"];
                    } else {
                        $_SESSION["alert"] = [
                            "message" => "Votre identifiant et/ou mot de passe sont identiques !",
                            "type" => SELF::ALERT_DANGER
                        ];
                    }
                }
        } else {
            if (isset($_POST["changePassword"]) || isset($_POST["ConfirmPassword"])){
                $_SESSION["alert"] = [
                    "message" => "Vos champs sont vides, veuillez les remplir",
                    "type" => SELF::ALERT_DANGER
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
    }

    public function validateRole()
    {
        $user = $this->usermanager->viewUser($_POST["login"]);
        if (!empty($_POST["login"]) && !empty($_POST["role"])){
            if ($user["role"] !== $_POST["role"]) {
                $_SESSION["alert"] = [
                    "message" => "Le rôle de ".$_POST["login"]." est désormais '".$_POST["role"]."' !",
                    "type" => SELF::ALERT_SUCCESS
                ];
                $this->usermanager->modifyRole($_POST["role"], $_POST["login"]);
            } else {
                $_SESSION["alert"] = [
                    "message" => "Le rôle de ".$_POST["login"]." est déjà '".$_POST["role"]."' !",
                    "type" => SELF::ALERT_DANGER
                ];
            }
        } else {
            $_SESSION["alert"] = [
                "message" => "Veuillez rentrer le pseudonyme et / ou le rôle!",
                "type" => SELF::ALERT_DANGER
            ];
        }
        $data_page = [
            "page_description" => "Espace personnel",
            "page_title" => "Espace personnel",
            "view" => "Views/modifyRole.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }

    public function modifyProduct()
    {
        $productCategory = $this->productsManagager->product_category();
        $categories = $this->productsManagager->category();
        var_dump($productCategory);
        $data_page = [
            "page_description" => "Espace personnel",
            "page_title" => "Espace personnel",
            "productCategory" => $productCategory,
            "categories" => $categories,
            "view" => "Views/modifyProduct.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }

    public function productModified()
    {
        if (isset($_POST["name"],$_POST["description"], $_POST["price"], $_POST["category_name"],  $_POST["id"] )){
            $this->productsManagager->updateProduct($_POST["name"], $_POST["description"], $_POST["price"],$_POST["category_name"] , $_POST["id"]);
            header("location connect/modifyProduct");
            $_SESSION["alert"] = [
                "message" => "La modification du produits est effectué",
                "type" => SELF::ALERT_SUCCESS
            ];
        } else {
            $_SESSION["alert"] = [
                "message" => "La modification du produits n'a pas fonctionné",
                "type" => SELF::ALERT_DANGER
            ];
        }
        $productCategory = $this->productsManagager->product_category();
        $categories = $this->productsManagager->category();
        var_dump($_POST["id"]);
        var_dump($_POST["category_name"]);

        $data_page = [
            "page_description" => "Espace personnel",
            "page_title" => "Espace personnel",
            "productCategory" => $productCategory,
            "categories" => $categories,
            "view" => "Views/modifyProduct.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }


}