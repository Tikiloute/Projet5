<?php

namespace Models;

use PDO;

class Usermanager  extends Model{

    public function viewUser(mixed $id): mixed
    {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateur WHERE identifiant = :identifiant");
        $stmt->bindParam(":identifiant", $id , PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        return $result;
        
    }

    public function createAccount(mixed $login, mixed $password, string $nom, string $prenom, mixed $mail, mixed $adresse, int $code): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO utilisateur (identifiant, password, nom, prenom, mail, adresse, code) VALUES (:identifiant, :password, :nom, :prenom, :mail, :adresse, :code)");
        $stmt->bindParam(":identifiant", $login, PDO::PARAM_INT);
        $stmt->bindParam(":password", $password, PDO::PARAM_INT);
        $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
        $stmt->bindParam(":prenom", $prenom, PDO::PARAM_STR);
        $stmt->bindParam(":adresse", $adresse, PDO::PARAM_STR_CHAR);
        $stmt->bindParam(":mail", $mail, PDO::PARAM_STR_CHAR);
        $stmt->bindParam(":code", $code, PDO::PARAM_STR_CHAR);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function modifyAccountInfo(mixed $id, mixed $identifiant, mixed $password): void
    {
        $stm = $this->pdo->prepare("UPDATE utilisateur SET identifiant= :identifiant, password= :password WHERE id = :id");
        $stm->bindParam(":identifiant", $identifiant, PDO::PARAM_STR_CHAR);
        $stm->bindParam(":password", $password, PDO::PARAM_STR_CHAR);
        $stm->bindParam(":id", $id, PDO::PARAM_INT);
        $stm->execute();
        $stm->closeCursor();
    }

    public function modifyRole(mixed $role, mixed $login): void
    {
        $stm = $this->pdo->prepare("UPDATE utilisateur SET role= :role WHERE identifiant = :login");
        $stm->bindParam(":role", $role, PDO::PARAM_STR_CHAR);
        $stm->bindParam(":login", $login , PDO::PARAM_STR_CHAR);
        $stm->execute();
        $stm->closeCursor();
    }


    
}