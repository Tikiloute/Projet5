<?php

namespace Controllers;

use Models\ProductsManager;
use Models\Usermanager;

class MainController{

    protected $products;
    protected $user;

    public function __construct()
    {
        $this->products = new ProductsManager();
        $this->user = new Usermanager();
    }

    protected function newPage(array $data)
    {
        extract($data);
        ob_start();
        require_once($view);
        $page_content = ob_get_clean();
        require_once($template);
    }

    public function home()
    {
        $_SESSION["alert"] = [
            "message" => "exemple de message d'alerte",
            "type" => "alert-success"
        ];

        $data_page = [
            "page_description" => "Accueil du site",
            "page_title" => "Accueil",
            "view" => "Views/accueil.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }

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

    public function informatique()
    {
        $data_page = [
            "page_description" => "section informatique",
            "page_title" => "Catégorie : informatique",
            "view" => "Views/informatique.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }

    public function jeuxVideo()
    {
        $data_page = [
            "page_description" => "section jeux vidéo",
            "page_title" => "Catégorie : jeux vidéo",
            "view" => "Views/jeuxVideo.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }

    public function electronique()
    {
        $data_page = [
            "page_description" => "section electronique",
            "page_title" => "Catégorie : électronique",
            "view" => "Views/electronique.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }

    public function musique()
    {
        $data_page = [
            "page_description" => "section musique",
            "page_title" => "Catégorie : musique",
            "view" => "Views/musique.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }

    public function panier()
    {
        $data_page = [
            "page_description" => "Panier",
            "page_title" => "panier",
            "view" => "Views/panier.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }

    public function pageError(string $msg) :void
    {
        $data_page = [
            "page_description" => "Page de gestion des erreurs",
            "page_title" => "Page de gestion des erreurs",
            "msg" => $msg,
            "view" => "Views/erreur.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }

}