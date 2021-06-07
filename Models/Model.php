<?php

namespace Models;

abstract class Model{

    protected $pdo;

    public function __construct(){
        $this->pdo = new \PDO("mysql:host=localhost; dbname=shop;charset=utf8", "root", "");
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); //permet d'avoir un warning si erreur dans le corps du site (ERRMODE_EXCEPTION) mieux que ERRMODE_WARNING(en haut du site)
    }

}