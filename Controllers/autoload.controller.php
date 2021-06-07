<?php
function register($class){
    //antislash /homepages/32/d733915466/htdocs/Controllers\MainController
    $classN = str_replace('\\', '/', $class);
    require_once("$classN.php");
    var_dump($classN);

    //transformé en slash avec str_replace /homepages/32/d733915466/htdocs/Controllers/MainController
}

spl_autoload_register("register");

