<?php

namespace Models;

class ProductsManager  extends Model{
    
    public function cart(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM produit_panier p INNER JOIN panier a ON p.id_panier = a.id INNER JOIN produit o ON p.id_produit = o.id WHERE a.id_utilisateur = :id ORDER BY a.date");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
        //stmt->closeCursor;
    }

    public function allProducts(): array //limit offset !
    {
        $stmt = $this->pdo->prepare("SELECT * FROM produit");
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function updateStock(int $stock, int $id): void
    {
        $stm = $this->pdo->prepare("UPDATE produit SET stock= :stock WHERE id = :id");
        $stm->bindParam(":stock", $stock, \PDO::PARAM_INT);
        $stm->bindParam(":id", $id, \PDO::PARAM_INT );
        $stm->execute();
    }

    public function products()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM produit");
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }


}