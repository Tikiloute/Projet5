<?php

namespace Controllers;

class ConnectionController extends MainController{
    
    public function connection()
    {
        $data_page = [
            "page_description" => "Page de connexion",
            "page_title" => "Page de connexion",
            "view" => "Views/connected.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }

    public function tryToConnect()
    {
        $_SESSION["alert"] = [
            "message" => "L'identifiant est : ".$_POST["login"]." et le mot de passe est : ".$_POST["password"],
            "type" => "alert-success"
        ];

        $data_page = [
            "page_description" => "Page de connexion",
            "page_title" => "Page de connexion",
            "view" => "Views/connected.view.php",
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

    public function accountCreateOK()
    {
        $_SESSION["alert"] = [
            "message" => "votre mail :".$_POST["mail"]." et votre mot de passe : ".$_POST["password"]." sont bien enregistrés",
            "type" => "alert-success"
        ];

        $data_page = [
            "page_description" => "compte validé",
            "page_title" => "compte validé",
            "view" => "Views/createAccount.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }
}