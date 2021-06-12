<?php

namespace Models;

class ProductsManager  extends Model{
    
    public function cart($id)// impossible à hinter ici (?array  ,  ?bool)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM produit_panier p INNER JOIN panier a ON p.id_panier = a.id INNER JOIN produit o ON p.id_produit = o.id WHERE a.id_utilisateur = :id ORDER BY a.date");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function products()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM produit");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

}