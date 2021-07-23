<?php

namespace Controllers;

class ConnectionController extends MainController{
    
    protected $sessionUser;

    public function connected()
    {
        if (!empty($_POST["login"])){
            $userLogin = $this->usermanager->viewUser($_POST["login"]);// bool = false si n'existe pas; array si existe
        }
        if (empty($_SESSION["connected"])){
            if (!empty($_POST["login"]) && !empty($_POST["password"]) && $userLogin !==  false){
                if (password_verify($_POST["password"], $userLogin["password"]) === true){

                    $_SESSION["connected"] = true;
                    $_SESSION["login"] = $userLogin["identifiant"];
                    $_SESSION["idUser"] = $userLogin["id"];
                    $purchaseHistory = $this->usermanager->purchaseHistory($_SESSION["idUser"]);

                    $_SESSION["alert"] = [
                        "message" => "Vous êtes bien connecté !",
                        "type" => SELF::ALERT_SUCCESS
                    ];
                    $data_page = [
                        "page_description" => "Espace personnel",
                        "page_title" => "Espace personnel",
                        "purchaseHistory" => $purchaseHistory,
                        "users" => $this->usermanager->viewUser($_SESSION["login"]),//ici nous avons toutes les informations de la personne connectée
                        "view" => "Views/connected.view.php",
                        "template" => "Views/common/template.php"
                    ];
                    $this->newPage($data_page);

                } else { // si password_verify = false mais que le login existe (userLogin = true) alors :
                    $_SESSION["alert"] = [
                        "message" => "Le mot de passe est erroné",
                        "type" => SELF::ALERT_DANGER
                    ];
                    $data_page = [
                        "page_description" => "Page de connexion",
                        "page_title" => "Page de connexion",
                        "view" => "Views/connexion.view.php",
                        "template" => "Views/common/template.php"
                    ];
                    $this->newPage($data_page);
                }
            } else {
                $_SESSION["alert"] = [
                    "message" => "Mauvais mot de passe et / ou identifiant",
                    "type" => SELF::ALERT_DANGER
                ];
                $data_page = [
                    "page_description" => "Page de connexion",
                    "page_title" => "Page de connexion",
                    "view" => "Views/connexion.view.php",
                    "template" => "Views/common/template.php"
                ];
                $this->newPage($data_page);
            }
        } else {
                $purchaseHistory = $this->usermanager->purchaseHistory($_SESSION["idUser"]);

                $data_page = [
                    "page_description" => "Espace personnel",
                    "page_title" => "Espace personnel",
                    "purchaseHistory" => $purchaseHistory,
                    "users" => $this->usermanager->viewUser($_SESSION["login"]),//ici nous avons toutes les informations de la personne connectée
                    "view" => "Views/connected.view.php",
                    "template" => "Views/common/template.php"
                ];
                $this->newPage($data_page);
        }
    }

    public function createAccount()
    {
        
        $data_page = [
            "page_description" => "Page de creation de compte",
            "page_title" => "Page de creation de compte",
            "view" => "Views/createAccount.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }

    public function accountCreated()
    {
        if (!empty($_POST["login"]) && !empty($_POST["password"]) && !empty($_POST["name"]) && !empty($_POST["surname"]) && !empty($_POST["mail"]) && !empty($_POST["address"])){
            if ($_POST["password"] === $_POST["confirmPassword"]){
                $code = rand(1, 1000000);
                $_SESSION["alert"] = [
                    "message" => "Compte crée, code : ".$_POST["login"]."-----".$_POST["password"]."   veuillez le valider avec le lien présent dans votre boite mail",
                    "type" => SELF::ALERT_SUCCESS
                ];
                $mdp = password_hash($_POST["password"], PASSWORD_DEFAULT);
                $this->usermanager->createAccount($_POST["login"], $mdp, $_POST["name"], $_POST["surname"], $_POST["mail"], $_POST["address"], $code);
            } else {
                $_SESSION["alert"] = [
                    "message" => "Les deux mots de passe ne correspondent pas",
                    "type" => SELF::ALERT_DANGER
                ];
                //voir en js pour faire correspondre les deux mdp, en l'état les champs déjà inscrit disparaissent (normal)
            }
        } else {
            $_SESSION["alert"] = [
                "message" => "Veuillez remplir tous les champs !",
                "type" => SELF::ALERT_DANGER
            ];
        }
        // $destinataire = $_POST["mail"];
        // $sujet = "test de mail";
        // $message = //ici mettre l'url de la page avec un case qui permettra de rentrer ce code --- "Votre code secret est le : ".$code;
        // $headers = "From:bruno.etcheverry77@gmail.com";
        // mail($destinataire, $sujet, $message, $headers);

        $data_page = [
            "page_description" => "compte validé",
            "page_title" => "compte validé",
            "view" => "Views/createAccount.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }

    public function disconnect()
    {
        if (!empty($_SESSION["id_panier"])){
            $this->productsManager->deleteCart($_SESSION["id_panier"]);
        }
        unset($_SESSION["connected"]);
        unset($_SESSION["login"]);
        unset($_SESSION["idUser"]);
        unset($_SESSION["id_panier"]);
        $data_page = [
            "page_description" => "Page de connexion",
            "page_title" => "Page de connexion",
            "view" => "Views/connexion.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }
    
}