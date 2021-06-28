<?php
namespace Controllers;

class AdministratorController  extends MainController{

    public function stock()
    {
        if (isset($_POST["addStock"])){
            $stock = $_POST["addStock"] + $_GET['stock'];
            if ($stock >= 0){
                $this->productsManager->updateStock($stock, $_GET["id"]);
                $_SESSION["alert"] = [
                    "message" => "Stock mis à jour !",
                    "type" => SELF::ALERT_SUCCESS
                ];
            } else {
                $_SESSION["alert"] = [
                    "message" => "Vous ne pouvez pas avoir un stock négatif !",
                    "type" => SELF::ALERT_DANGER
                ];
            }
        }
        $productsManager = $this->productsManager->allProducts();
        $data_page = [
            "page_description" => "Espace personnel",
            "page_title" => "Espace personnel",
            "produits" => $productsManager,
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
        if (!empty($_POST["login"])){
            $user = $this->usermanager->viewUser($_POST["login"]);
            if (!empty($_POST["role"])){
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
        $productCategory = $this->productsManager->product_category();
        $categories = $this->productsManager->category();
        if (isset($_POST["name"],$_POST["description"], $_POST["price"], $_POST["category_name"],  $_POST["id"])){
            $this->productsManager->updateProduct($_POST["name"], $_POST["description"], $_POST["price"],$_POST["category_name"] , $_POST["id"]);
            $_SESSION["alert"] = [
                "message" => "La modification du produit est effectuée",
                "type" => SELF::ALERT_SUCCESS
            ];
        }
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

    public function addProduct()
    {
        $productCategory = $this->productsManager->product_category();
        $categories = $this->productsManager->category();
        if (!empty($_POST["name"]) && !empty($_POST["description"])  && !empty($_POST["stock"]) && !empty($_FILES["image"]) && !empty($_POST["price"]) && !empty($_POST["category_name"])){
            $maxSize = 2097152; // représente 2 méga octets
            if ($_FILES["image"]["size"] <= $maxSize){
                move_uploaded_file($_FILES["image"]["tmp_name"], "public\assets\images\\".$_FILES["image"]["name"]);
                $this->productsManager->addProduct($_POST["name"], $_POST["description"], $_POST["stock"], $_FILES["image"]["name"], $_POST["price"], $_POST["category_name"]);
                $_SESSION["alert"] = [
                    "message" => "La création du produit est effectuée",
                    "type" => SELF::ALERT_SUCCESS
                ];
            } else {
                $_SESSION["alert"] = [
                    "message" => "La taille de l'image ne doit pas dépasser les 2 méga-octets",
                    "type" => SELF::ALERT_DANGER
                ];
            }
        };
        $data_page = [
            "page_description" => "Espace personnel",
            "page_title" => "Espace personnel",
            "productCategory" => $productCategory,
            "categories" => $categories,
            "view" => "Views/addProduct.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }

    public function addBillAddress()
    {
        $user = $this->usermanager->viewUser($_SESSION["login"]);
        if ($_GET["updateBillAddress"] = true && !empty($_POST["billAddress"])){
            if ($user["adresse_de_facturation"] !== $_POST["billAddress"]){
                $this->usermanager->addBillAddress($_POST["billAddress"], $_SESSION["idUser"]);
                $_SESSION["alert"] = [
                    "message" => "Adresse de facturation mise à jour !",
                    "type" => SELF::ALERT_SUCCESS
                ];
            } else {
                $_SESSION["alert"] = [
                    "message" => "L'adresse saisie est la même que celle déjà enregistrée, veuillez recommencer !",
                    "type" => SELF::ALERT_DANGER
                ];
            }
        } else {
            $_SESSION["alert"] = [
                "message" => "Veuillez remplir le champs !",
                "type" => SELF::ALERT_DANGER
            ];
        }
    }

}