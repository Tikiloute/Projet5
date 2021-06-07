<?php

namespace Controllers;

class ConnectionController extends MainController{
    
    public function connection()
    {
        $data_page = [
            "page_description" => "Page de connexion",
            "page_title" => "Page de connexion",
            "view" => "Views/connexion.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }

    public function tryToConnect()
    {

        $data_page = [
            "page_description" => "Page de connexion",
            "page_title" => "Page de connexion",
            "view" => "Views/connexion.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
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
        if(!empty($_POST["login"]) && !empty($_POST["password"]) && !empty($_POST["name"]) && !empty($_POST["surname"]) && !empty($_POST["mail"]) && !empty($_POST["address"])){
            $code = rand(1, 10000);
            $_SESSION["alert"] = [
                "message" => "Compte crée, code : ".$code."veuillez le valider avec le lien présent dans votre boite mail",
                "type" => "alert-success"
            ];
            $mdp = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $this->user->createAccount($_POST["login"], $mdp, $_POST["name"], $_POST["surname"], $_POST["mail"], $_POST["address"]);
           // mail($_POST["mail"], "Veuillez valider votre inscrption", "cliquez sur le lien suivant");
        }else {
            $_SESSION["alert"] = [
                "message" => "Veuillez remplir tous les champs !  code : ",
                "type" => "alert-danger"
            ];
        }
        $data_page = [
            "page_description" => "compte validé",
            "page_title" => "compte validé",
            "view" => "Views/createAccount.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
        //$test = password_verify("tiki", "$2y$10$0ONnPQGcTmilqll7C.O2j.UtI9aJnnf/SoLkzv9kZ1jkNcc0DzWpC");
        //var_dump($test);
    }

    public function connected()
    {
        $data_page = [
            "page_description" => "Page de connexion",
            "page_title" => "Page de connexion",
            "view" => "Views/connexion.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }
    
}