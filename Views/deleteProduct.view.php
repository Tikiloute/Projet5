<h1>Ici vous pourrez supprimer les produits dans la liste suivante :</h1>
<br>
<br>
<hr>
<br>
<?php 
foreach ($allProducts as $product){
?>

<div>
    <p><?= $product["nom"]?> dont la quantité est de <?= $product["stock"]?> et le prix est de <?= $product["prix"]?>€<a class="ms-3 text-decoration-none" href="<?= URL ?>connect/deleted&id=<?= $product["id"] ?>">     ❌</a> </p>
<br>
<hr>
<br>
</div>

<?php
}
