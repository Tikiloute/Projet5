<h1>Modifiez vos produits ici !</h1>

<form action="#" method="POST">
<?php
foreach($products as $product){
?>
    <input type="text" name="name" value="<?= $product["nom"] ?>">
    <textarea name="descrption" cols="30" rows="4" placeholder="<?= $product["description"] ?>" ><?= htmlspecialchars($product["description"]) ?></textarea>
    <input type="number" name="price" value="<?= $product["prix"] ?>" ?>
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