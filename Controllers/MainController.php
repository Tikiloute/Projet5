<?php

namespace Controllers;

class MainController{

    private $mainManager;
    private $products;

    public function __construct()
    {
        $this->mainManager = new \Models\MainManager();
        $this->products = new \Models\ProductsManager();
    }

    protected function newPage($data)
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

        $datass = $this->mainManager->getDataX();
        $data_page = [
            "page_description" => "Accueil du site",
            "page_title" => "Accueil",
            "datas" => $datass,
            "view" => "Views/accueil.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
        $this->products->test();
        print_r($datass);
    }

    public function page1()
    {
        $_SESSION["alert"] = [
            "message" => "exemple de message d'alerte",
            "type" => "alert-danger"
        ];

        $data_page = [
            "page_description" => "Page 1",
            "page_title" => "Page 1",
            "view" => "Views/page1.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->newPage($data_page);
    }

    public function page2()
    {
        $data_page = [
            "page_description" => "Page 2",
            "page_title" => "Page 2",
            "view" => "Views/page2.view.php",
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