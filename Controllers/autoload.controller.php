<?php
function register($class){
    var_dump($class);
    require_once("$class.php");
}

spl_autoload_register("register");

