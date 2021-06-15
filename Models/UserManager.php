<?php

namespace Models;

class Usermanager  extends Model{

    public function viewUser(mixed $id): mixed
    {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateur WHERE identifiant = :identifiant");
        $stmt->bindParam(":identifiant", $id);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result;
        $stmt->closeCursor();
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
        $stmt->closeCursor();
    }

    public function modifyAccountInfo(mixed $id, mixed $identifiant, mixed $password): void
    {
        $stm = $this->pdo->prepare("UPDATE utilisateur SET identifiant= :identifiant, password= :password WHERE id = :id");
        $stm->bindParam(":identifiant", $identifiant);
        $stm->bindParam(":password", $password);
        $stm->bindParam(":id", $id);
        $stm->execute();
        $stm->closeCursor();
    }

    public function modifyRole(mixed $role, mixed $login): void
    {
        $stm = $this->pdo->prepare("UPDATE utilisateur SET role= :role WHERE identifiant = :login");
        $stm->bindParam(":role", $role);
        $stm->bindParam(":login", $login);
        $stm->execute();
        $stm->closeCursor();
    }


    
}