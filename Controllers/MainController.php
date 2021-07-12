<?php

namespace Controllers;

use Models\ProductsManager;
use Models\Usermanager;

class MainController{

    const ALERT_DANGER = "alert-danger"; //red_alert
    const ALERT_SUCCESS = "alert-success";//green_alert
    const ALERT_WARNING = "alert-warning";//orange_alert
    const LIMIT = 1; //pour la pagination

    protected $productsManager;
    protected $usermanager;


    public function __construct()
    {
        $this->productsManager = new ProductsManager();
        $this->usermanager = new Usermanager();
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