<h1 class="text-center">Vérification avant paiement</h1>
<br>
<br>
<h2  class="text-center"><ins>Détail de la commande</ins></h2>
<br>
<br>
<table class="table">
    <tr class="text-center">
        <th>Nom de l'article</th>
        <th>Quantité</th>
        <th>Prix</th>
    </tr>
<?php
    $price = 0;
    foreach ($cart as $carts){
    $price += $carts["prix"] * $carts["quantity"];
?>
    <tr class="text-center">
        <td><?= $carts["nom"]?></td>
        <td><?= $carts["quantity"]?></td>
<?php
    if ($carts["quantity"] > 1){
?>
        <td><?= $carts["prix"] * $carts["quantity"]?>€ (prix unitaire : <?= $carts["prix"] ?>€)</td>
<?php
    } else {
?>
    <td><?= $carts["prix"]?>€</td>
<?php
    }
?>
    </tr>
<?php
    }
?>
    <tr class="text-center">
        <th></th>
        <th>Prix total :</th>
        <th><?= $price ?>€</th>
        <?php $_SESSION["prixGlobal"] = $price ?>
<?php 
?>
    </tr>
</table>

<br>
<br>
<br>
<?php ; ?>

<h2 class="text-center"><ins>Vérification des informations personnelles</ins></h2>

<br>
<br>

<h3>Votre adresse de livraison :</h3>
<br>
<p>Votre nom :  <?= $user["prenom"]?></p>
<p>Votre prénom : <?= $user["nom"]?></p>
<p>Adresse : <?= $user["adresse"]?></p>
<br>

<?php
    if (!empty($user["adresse_de_facturation"])){
?>

<h3>Votre adresse de facturation :</h3>
<br>
<p>Votre nom :  <?= $user["prenom"]?></p>
<p>Votre prénom : <?= $user["nom"]?></p>
<p>Adresse : <?= $user["adresse_de_facturation"]?></p>
<br>
<br>

<?php
    } else {
?>
    <a href="<?=URL?>connect/connected&billAddress" class="btn btn-success">Ajouter une adresse de facturation</a>
<?php
    }
    $_SESSION["bill"] = $price;
?>

<div class=" text-center">
    <a href="<?=URL?>payStripe" class="btn btn-warning ">Passer au paiement</a>
</div>