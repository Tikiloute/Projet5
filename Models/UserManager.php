<?php

namespace Models;

class Usermanager  extends Model{

    public function viewUser(mixed $login)// impossible à hinter ici (?array  ,  ?bool)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateur WHERE identifiant = :identifiant");
        $stmt->bindParam(":identifiant", $login);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }


    public function createAccount(mixed $login,mixed $password, string $nom, string $prenom, mixed $mail, mixed $adresse, int $code): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO utilisateur (identifiant, password, nom, prenom, mail, adresse, code) VALUES (:identifiant, :password, :nom, :prenom, :mail, :adresse, :code)");
        $stmt->bindParam(":identifiant", $login);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":nom", $nom);
        $stmt->bindParam(":prenom", $prenom);
        $stmt->bindParam(":adresse", $adresse);
        $stmt->bindParam(":mail", $mail);
        $stmt->bindParam(":code", $code);
        $stmt->execute();
        var_dump($stmt);
    }

    
}