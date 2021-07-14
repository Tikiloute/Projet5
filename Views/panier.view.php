<h1> Bienvenue sur la page de votre panier </h1>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis cumque numquam nesciunt minima porro rerum non in, ut, rem laudantium libero veritatis ex doloribus mollitia. Voluptas, quisquam eligendi ea quidem culpa quia adipisci illum sunt magnam provident, aut ut, qui unde voluptatibus a delectus vel recusandae nulla beatae. Accusantium distinctio aut atque ducimus, eius qui eum sed autem ex dolorem saepe optio numquam aliquam veritatis perferendis ipsa quae consectetur magni mollitia nostrum deserunt impedit. Sint nam harum amet deleniti quia, illum expedita rerum saepe labore. Dolorem, nesciunt possimus fugit sequi totam deserunt eveniet iusto reiciendis nemo architecto error et placeat!</p>

<?php
$sum = 0;
$quantity = 0;
foreach ($cart as $carts){

$sum += $carts["prix"] * $carts["quantity"];
//var_dump($carts);
$quantity += $carts["quantity"];

?>
<hr>
<div class="row">
    <div class="row col-md-10">
    <a href="<?=URL?>product&id=<?=$carts['id']?>"><img src="<?= URL."public/assets/images/".$carts["image"] ?>" alt="<?=$carts["description"]?>" class="col-md-5" width="auto" height="auto"></a>
        <div class="col p-4 d-flex flex-column position-static">
          <a href="<?=URL?>product&id=<?=$carts['id']?>" class="text-decoration-none text-info"><h3 class="mb-0"><?= $carts["nom"] ?></h3></a>
            <p class="card-text mb-auto"><?=$carts["description"]?></p>
            <form action="<?=URL?>cart/modifyQuantity" method="POST">
                <label  for="numberProduct">Quantité : </label>
                <input type="hidden" name="idProduct" value=<?= $carts["id"]?>>
                <input class="col-3 border rounded text-center" type="number" name="quantity" id="quantityProduct" value=<?= $carts["quantity"]?>>
                <button type="submit" class="btn btn-primary">Modifiez la quantité</button>
            </form>
            <form action="<?=URL?>cart/deleteProductCart" method="POST">
                <input type="hidden" name="idProduct" value=<?= $carts["id"]?>>
                <button type="submit" class="btn btn-danger">Supprimez l'article</button>
            </form>
        </div>
    </div>
    <div class="">
       <h5 class="price"> Prix : <?= $carts["prix"]*$carts["quantity"] ?>€ </h5>
    </div>
</div>

<?php
}
?>
<hr>
            <h3 class="price">Sous-total (<?= $quantity ?> articles) : <?= $sum ?>€</h3>
            <button type="button" class="btn btn-warning payButton">Passez la commande</button>
<?php 