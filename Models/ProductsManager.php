<?php

namespace Models;

use PDO;

class ProductsManager  extends Model{
    
    public function cart(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM produit_panier p INNER JOIN panier a ON p.id_panier = a.id INNER JOIN produit o ON p.id_produit = o.id WHERE a.id_utilisateur = :id ORDER BY a.date");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        return $result;

    }

    public function allProducts(): array //limit offset pour la pagination!
    {
        $stmt = $this->pdo->prepare("SELECT * FROM produit LIMIT 10 OFFSET 0");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        return $result;
    }

    public function updateStock(int $stock, int $id): void
    {
        $stm = $this->pdo->prepare("UPDATE produit SET stock= :stock WHERE id = :id");
        $stm->bindParam(":stock", $stock, PDO::PARAM_INT);
        $stm->bindParam(":id", $id, PDO::PARAM_INT );
        $stm->execute();
        $stm->closeCursor();
    }

    public function category(): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM category");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        return $result;
    }

    public function product_category(): array
    {
        $stmt = $this->pdo->prepare("SELECT p.id as idProduit, p.nom, p.description, p.prix, p.id_category, c.id, c.category_name FROM produit p INNER JOIN category c ON c.id = p.id_category");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        return $result;
    }

    public function updateProduct(mixed $name, mixed $description, int $price, int $id_category , int $id): void
    {
        $stmt = $this->pdo->prepare("UPDATE produit SET nom= :nom, description= :description, prix= :price, id_category= :id_category WHERE id = :id");
        $stmt->bindParam(":nom", $name, PDO::PARAM_STR_CHAR);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR_CHAR );
        $stmt->bindParam(":price", $price, PDO::PARAM_INT);
        $stmt->bindParam(":id_category", $id_category, PDO::PARAM_INT);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT );
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function addProduct(mixed $name, mixed $description, int $stock, $image, int $price, int $id_category): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO produit (nom, description, stock, image, prix, id_category) VALUES (:nom, :description, :stock, :image, :prix, :id_category)");
        $stmt->bindParam(":nom", $name, PDO::PARAM_STR_CHAR);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR_CHAR);
        $stmt->bindParam(":stock", $stock, PDO::PARAM_INT);
        $stmt->bindParam(":image", $image);
        $stmt->bindParam(":prix", $price, PDO::PARAM_INT);
        $stmt->bindParam(":id_category", $id_category, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

}