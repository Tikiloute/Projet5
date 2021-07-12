<h1> Bienvenue sur la page de votre panier </h1>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis cumque numquam nesciunt minima porro rerum non in, ut, rem laudantium libero veritatis ex doloribus mollitia. Voluptas, quisquam eligendi ea quidem culpa quia adipisci illum sunt magnam provident, aut ut, qui unde voluptatibus a delectus vel recusandae nulla beatae. Accusantium distinctio aut atque ducimus, eius qui eum sed autem ex dolorem saepe optio numquam aliquam veritatis perferendis ipsa quae consectetur magni mollitia nostrum deserunt impedit. Sint nam harum amet deleniti quia, illum expedita rerum saepe labore. Dolorem, nesciunt possimus fugit sequi totam deserunt eveniet iusto reiciendis nemo architecto error et placeat!</p>

<?php
$sum = 0;
foreach ($cart as $carts){

$sum += $carts["prix"] * $carts["quantity"];
//var_dump($carts["id_produit"]);

?>
<hr>
<div class="row">
    <div class="row col-md-10">
    <img src="<?= URL."public/assets/images/".$carts["image"] ?>" alt="<?=$carts["description"]?>" class="col-md-5" width="auto" height="auto">
        <div class="col p-4 d-flex flex-column position-static">
          <h3 class="mb-0"><?= $carts["nom"] ?></h3>
            <p class="card-text mb-auto"><?=$carts["description"]?></p>
            <p class="card-text mb-auto">Quantité : <?=$carts["quantity"]?></p>
        </div>
    </div>
    <div class="">Prix : <?= $carts["prix"] ?>€</div>
</div>

<?php
}
?>
<hr>
    <h3>Prix total : <?= $sum ?>€</h3>

<?php 