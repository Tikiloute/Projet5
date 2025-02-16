<?php

namespace Models;

use PDO;

class ProductsManager  extends Model{
    
    public function cart(mixed $id_panier): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM produit_panier p INNER JOIN panier a ON p.id_panier = a.id INNER JOIN produit o ON p.id_produit = o.id WHERE a.id_panier = :id ORDER BY a.date");
        $stmt->bindParam(":id_panier", $id_panier, PDO::PARAM_STR_CHAR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        return $result;
    }

    public function viewCart(mixed $idPanier): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM panier p INNER JOIN produit r ON p.id_produit = r.id WHERE p.id_panier = :id_panier ORDER BY p.date ASC");
        $stmt->bindParam(":id_panier", $idPanier, PDO::PARAM_STR_CHAR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        return $result;
    }

    public function aimViewCart(mixed $idPanier, mixed $idProduit): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM panier p INNER JOIN produit r ON p.id_produit = r.id WHERE p.id_panier = :id_panier AND p.id_produit = :id_produit ORDER BY p.date ASC");
        $stmt->bindParam(":id_panier", $idPanier, PDO::PARAM_STR_CHAR);
        $stmt->bindParam(":id_produit", $idProduit, PDO::PARAM_STR_CHAR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        return $result;
    }

    public function allProducts(int $limit, int $offset): array //limit offset pour la pagination!
    {
        $stmt = $this->pdo->prepare("SELECT * FROM produit LIMIT :limit OFFSET :offset");
        $stmt->bindParam(":offset", $offset,\PDO::PARAM_INT);
        $stmt->bindParam(":limit", $limit,\PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        return $result;
    }

    public function allProductsNoOffset(): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM produit");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $result;
    }

    public function allProductsByCategory(int $idCategory, int $limit, int $offset): array //limit offset pour la pagination!
    {
        $stmt = $this->pdo->prepare("SELECT * FROM produit WHERE id_category = :id_category LIMIT :limit OFFSET :offset");
        $stmt->bindParam(":id_category", $idCategory, PDO::PARAM_INT);
        $stmt->bindParam(":offset", $offset,\PDO::PARAM_INT);
        $stmt->bindParam(":limit", $limit,\PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        return $result;
    }

    public function showOneProduct(int $id): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM produit WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT );
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $result;
    }

    public function updateStock(int $stock, int $id): void
    {
        $stmt = $this->pdo->prepare("UPDATE produit SET stock= :stock WHERE id = :id");
        $stmt->bindParam(":stock", $stock, PDO::PARAM_INT);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT );
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function category(): array // créer un manager pour lui
    {
        $stmt = $this->pdo->prepare("SELECT * FROM category");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        return $result;
    }

    public function getCategory(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM category WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT );
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        if ($result === false){
            $result = null;
        }

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
        $stmt->bindParam(":image", $image, PDO::PARAM_STR_CHAR);
        $stmt->bindParam(":prix", $price, PDO::PARAM_INT);
        $stmt->bindParam(":id_category", $id_category, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function countCategory(int $id_category): void
    {
        $stmt = $this->pdo->prepare(("SELECT COUNT(*) FROM produit WHERE id_category = :id_category"));
        $stmt->bindParam(":id_category", $id_category, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function addToCart(mixed $id_panier, int $id_utilisateur, int $id_produit): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO panier (id_panier, id_utilisateur, date, id_produit) VALUES (:id_panier, :id_utilisateur, NOW(), :id_produit)");
        $stmt->bindParam(":id_panier", $id_panier, PDO::PARAM_STR_CHAR);
        $stmt->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
        $stmt->bindParam(":id_produit", $id_produit, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function addToCartStatus(mixed $idPanier, int $idUser): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO status_panier (id_panier, id_utilisateur) VALUES (:id_panier, :id_utilisateur)");
        $stmt->bindParam(":id_panier", $idPanier, PDO::PARAM_STR_CHAR);
        $stmt->bindParam(":id_utilisateur", $idUser, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function addQuantityProduct(int $quantity, int $id_produit): void
    {
        $stmt = $this->pdo->prepare("UPDATE panier SET quantity = :quantity WHERE id_produit = :id_produit");
        $stmt->bindParam(":quantity", $quantity, PDO::PARAM_INT);
        $stmt->bindParam(":id_produit", $id_produit, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function countIdProduit(int $idProduit): void
    {
        $stmt = $this->pdo->prepare(("SELECT COUNT(*) FROM produit WHERE id_produit = :id_produit"));
        $stmt->bindParam(":id_produit", $idProduit, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function countProduitByCategory($idCategory)
    {
        $stmt = $this->pdo->prepare(("SELECT COUNT(*) FROM produit WHERE id_category = :id_category"));
        $stmt->bindParam(":id_category", $idCategory, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $result;
    }

    public function deleteProductCart(mixed $idPanier, int $idProduit): void
    {
        $stmt = $this->pdo->prepare(("DELETE FROM panier WHERE id_panier = :id_panier AND id_produit = :id_produit"));
        $stmt->bindParam(":id_panier", $idPanier, PDO::PARAM_STR_CHAR);
        $stmt->bindParam(":id_produit", $idProduit, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function deleteProduct(int $idProduit): void
    {
        $stmt = $this->pdo->prepare(("DELETE FROM produit WHERE id = :id_produit"));
        $stmt->bindParam(":id_produit", $idProduit, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function deleteCart(mixed $idPanier): void
    {
        $stmt = $this->pdo->prepare(("DELETE FROM panier WHERE id_panier = :id_panier"));
        $stmt->bindParam(":id_panier", $idPanier, PDO::PARAM_STR_CHAR);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function lockCart(bool $lock, mixed $idPanier): void
    {
        $stmt = $this->pdo->prepare("UPDATE status_panier SET verrou = :verrou WHERE id_panier = :id_panier");
        $stmt->bindParam(":verrou", $lock, PDO::PARAM_BOOL);
        $stmt->bindParam(":id_panier", $idPanier, PDO::PARAM_STR_CHAR);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function viewStatusCart(mixed $idPanier)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM status_panier WHERE id_panier = :id_panier");
        $stmt->bindParam(":id_panier", $idPanier, PDO::PARAM_STR_CHAR );
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $result;
    }

    public function updateStatusCart(bool $status, mixed $idPanier): void
    {
        $stmt = $this->pdo->prepare("UPDATE status_panier SET status = :status WHERE id_panier = :id_panier");
        $stmt->bindParam(":status", $status, PDO::PARAM_BOOL);
        $stmt->bindParam(":id_panier", $idPanier, PDO::PARAM_STR_CHAR);
        $stmt->execute();
        $stmt->closeCursor();
    }

}