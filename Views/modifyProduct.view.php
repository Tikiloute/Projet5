<h1>Modifiez vos produits ici !</h1>

<form action="#" method="POST">
<?php
foreach($products as $product){
?>
    <label for="nameProduct">Nom du produit : </label>
    <input type="text" id="nameProduct" name="name" value="<?= $product["nom"] ?>">
    <label for="descrptionPoduct">Description : </label>
    <textarea name="descrption" cols="30" id="descrptionPoduct" rows="4" placeholder="<?= $product["description"] ?>" ><?= htmlspecialchars($product["description"]) ?></textarea>
    <label for="priceProduct">Prix du produit : </label>
    <input type="number" name="price" id="priceProduct" value="<?= $product["prix"] ?>" ?>
    <select name="category" >
        <option value="" selected disabled>Catégorie</option>
        <option value="informatique">informatique</option>
        <option value="jeux-vidéo">jeux-vidéo</option>
        <option value="électronique">électronique</option>
        <option value="Musique">Musique</option>
    </select>
    <input type="submit" class="btn btn-primary" value="Valider">
    <br>
<?php 
}
?>
</form>