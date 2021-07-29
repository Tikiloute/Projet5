<h1 class="text-center"> Bienvenue sur la page de votre panier </h1>
<br>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis cumque numquam nesciunt minima porro rerum non in, ut, rem laudantium libero veritatis ex doloribus mollitia. Voluptas, quisquam eligendi ea quidem culpa quia adipisci illum sunt magnam provident, aut ut, qui unde voluptatibus a delectus vel recusandae nulla beatae. Accusantium distinctio aut atque ducimus, eius qui eum sed autem ex dolorem saepe optio numquam aliquam veritatis perferendis ipsa quae consectetur magni mollitia nostrum deserunt impedit. Sint nam harum amet deleniti quia, illum expedita rerum saepe labore. Dolorem, nesciunt possimus fugit sequi totam deserunt eveniet iusto reiciendis nemo architecto error et placeat!</p>
<br>
<br>

<?php
if (!empty($cart)){
?>
    <h2 class="text-center"><ins>Récapitulatif de votre panier</ins></h2>
<br>
<br>
<div class="table-responsive-sm">
    <table class="table">
<?php
$sum = 0;
$quantity = 0;
    foreach ($cart as $carts){

    $sum += $carts["prix"] * $carts["quantity"];
    $quantity += $carts["quantity"];

?>
    <tr class="align-middle text-center">
        <th scope="row"><a href="<?=URL?>product&id=<?=$carts['id']?>" class="text-decoration-none text-info"><h4 class="mb-0"><?= $carts["nom"] ?></h4></a></th>
        <td class="mx-auto"><a href="<?=URL?>product&id=<?=$carts['id']?>"><img src="<?= URL."public/assets/images/".$carts["image"] ?>" alt="<?=$carts["description"]?>" class="col-md-4 col-sm-12 col-lg-6 col-xl-6 imageCart" ></a></td>
        <td>
            <form action="<?=URL?>cart/modifyQuantity" method="POST">
                <label  for="numberProduct">Quantité souhaitée (Qté max : <?= $carts["stock"] ?>) : </label>
                <input type="hidden" name="idProduct" value=<?= $carts["id"]?>>
                <input type="hidden" name="stock" value=<?= $carts["stock"]?>>
                <input class="col-3 border rounded text-center mb-2" type="number" name="quantity" id="quantityProduct" value=<?php if ($carts["quantity"] > $carts["stock"]){ echo $carts["stock"]; } else { echo $carts["quantity"]; }?>>
                <button type="submit" class="btn btn-primary">Modifier la quantité</button>
            </form>
        </td>
        <td class="h4">Prix total : <?= $carts["prix"]*$carts["quantity"] ?>€ (prix unitaire : <?= $carts["prix"] ?>€)</td>
        <td>
            <form action="<?=URL?>cart/deleteProductCart" method="POST">
                <input type="hidden" name="idProduct" value=<?= $carts["id"]?>>
                <button type="submit" class="btn btn-danger">Supprimez l'article</button>
            </form>
      </td>
    </tr>
<?php
    }
?>
    </table>
</div>
<hr>
        <h3 class="price">Sous-total (<?= $quantity ?> articles) : <?= $sum ?>€</h3>
        <a href="<?=URL?>checkout" class="btn btn-warning payButton">Passez la commande</a>
        <br>
        <br>
<?php 
    } elseif(empty($_SESSION["connected"])) {
?>
    <div class=" text-center">
        <h3 class="text-danger text-center">Veuillez vous connecter pour avoir accès à votre panier</h3>
        <br>
        <a href="<?=URL?>connect" class="btn btn-warning">Vous connecter</a>
    </div>
<?php
    } else {
?>
        <h3 class="text-primary text-center">Votre panier est vide</h3>
<?php
    }