<?php

namespace Models;

use PDO;

class Usermanager  extends Model{

    public function viewUser(mixed $id): mixed
    {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateur WHERE identifiant = :identifiant");
        $stmt->bindParam(":identifiant", $id , PDO::PARAM_STR_CHAR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        return $result;
    }

    public function createAccount(mixed $login, mixed $password, string $nom, string $prenom, mixed $mail, mixed $adresse, int $code): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO utilisateur (identifiant, password, nom, prenom, mail, adresse, code) VALUES (:identifiant, :password, :nom, :prenom, :mail, :adresse, :code)");
        $stmt->bindParam(":identifiant", $login, PDO::PARAM_STR_CHAR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR_CHAR);
        $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
        $stmt->bindParam(":prenom", $prenom, PDO::PARAM_STR);
        $stmt->bindParam(":adresse", $adresse, PDO::PARAM_STR_CHAR);
        $stmt->bindParam(":mail", $mail, PDO::PARAM_STR_CHAR);
        $stmt->bindParam(":code", $code, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function modifyAccountInfo(mixed $id, mixed $identifiant, mixed $password): void
    {
        $stmt = $this->pdo->prepare("UPDATE utilisateur SET identifiant= :identifiant, password= :password WHERE id = :id");
        $stmt->bindParam(":identifiant", $identifiant, PDO::PARAM_STR_CHAR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR_CHAR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function modifyRole(mixed $role, mixed $login): void
    {
        $stmt = $this->pdo->prepare("UPDATE utilisateur SET role= :role WHERE identifiant = :login");
        $stmt->bindParam(":role", $role, PDO::PARAM_STR_CHAR);
        $stmt->bindParam(":login", $login , PDO::PARAM_STR_CHAR);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function addBillAddress(mixed $billAddress, int $id): void
    {
        $stmt = $this->pdo->prepare("UPDATE utilisateur SET adresse_de_facturation= :billAddress WHERE id = :id");
        $stmt->bindParam(":billAddress", $billAddress, PDO::PARAM_STR_CHAR);
        $stmt->bindParam(":id", $id , PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function purchaseHistory($userName)
    {
        $stmt = $this->pdo->prepare("SELECT DATE_FORMAT(p.date, '%d/%m/%Y') AS date, p.quantity, u.nom, u.prix, s.id_panier FROM panier p INNER JOIN status_panier s ON s.id_panier = p.id_panier INNER JOIN produit u ON u.id = p.id_produit WHERE s.id_utilisateur = :identifiant AND s.status = 1 AND s.verrou = 1 ORDER BY p.date ASC");
        $stmt->bindParam(":identifiant", $userName , PDO::PARAM_STR_CHAR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        return $result;
    }

    public function updateCustomerInformations(mixed $identifiant, mixed $nom, mixed $prenom, mixed $adresse, mixed $mail): void
    {
        $stmt = $this->pdo->prepare("UPDATE utilisateur SET nom = :nom, prenom = :prenom, adresse = :adresse, mail = :mail WHERE identifiant = :identifiant");
        $stmt->bindParam(":nom", $nom, PDO::PARAM_STR_CHAR);
        $stmt->bindParam(":prenom", $prenom, PDO::PARAM_STR_CHAR);
        $stmt->bindParam(":adresse", $adresse, PDO::PARAM_STR_CHAR);
        $stmt->bindParam(":mail", $mail, PDO::PARAM_STR_CHAR);
        $stmt->bindParam(":identifiant", $identifiant , PDO::PARAM_STR_CHAR);
        $stmt->execute();
        $stmt->closeCursor();
    }
}