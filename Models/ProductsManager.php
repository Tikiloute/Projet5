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
        $stmt->closeCursor();
    }

    public function allProducts(): array //limit offset pour la pagination!
    {
        $stmt = $this->pdo->prepare("SELECT * FROM produit LIMIT 10 OFFSET 0");
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
        $stmt->closeCursor();
    }

    public function updateStock(int $stock, int $id): void
    {
        $stm = $this->pdo->prepare("UPDATE produit SET stock= :stock WHERE id = :id");
        $stm->bindParam(":stock", $stock, \PDO::PARAM_INT);
        $stm->bindParam(":id", $id, \PDO::PARAM_INT );
        $stm->execute();
        $stm->closeCursor();
    }
    public function category()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM category");
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
        $stmt->closeCursor();
    }

    public function product_category()
    {
        $stmt = $this->pdo->prepare("SELECT p.id as idProduit, p.nom, p.description, p.prix, p.id_category, c.id, c.category_name FROM produit p INNER JOIN category c ON c.id = p.id_category");
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
        $stmt->closeCursor();
    }

    public function updateProduct($name, $description, $price, $id_category , $id): void
    {
        $stm = $this->pdo->prepare("UPDATE produit SET nom= :nom, description= :description, prix= :price, id_category= :id_category WHERE id = :id");
        $stm->bindParam(":nom", $name, \PDO::PARAM_STR_CHAR);
        $stm->bindParam(":description", $description, \PDO::PARAM_STR_CHAR );
        $stm->bindParam(":price", $price, \PDO::PARAM_INT);
        $stm->bindParam(":id_category", $id_category, \PDO::PARAM_INT);
        $stm->bindParam(":id", $id, \PDO::PARAM_INT );
        $stm->execute();
        $stm->closeCursor();
    }

}