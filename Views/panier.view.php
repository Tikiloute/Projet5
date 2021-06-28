<h1> Bienvenue sur la page de votre panier </h1>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis cumque numquam nesciunt minima porro rerum non in, ut, rem laudantium libero veritatis ex doloribus mollitia. Voluptas, quisquam eligendi ea quidem culpa quia adipisci illum sunt magnam provident, aut ut, qui unde voluptatibus a delectus vel recusandae nulla beatae. Accusantium distinctio aut atque ducimus, eius qui eum sed autem ex dolorem saepe optio numquam aliquam veritatis perferendis ipsa quae consectetur magni mollitia nostrum deserunt impedit. Sint nam harum amet deleniti quia, illum expedita rerum saepe labore. Dolorem, nesciunt possimus fugit sequi totam deserunt eveniet iusto reiciendis nemo architecto error et placeat!</p>

<?php
$sum = 0;
foreach ($cart as $carts){

$sum += $carts["prix"];
?>
<hr>
    <img src="<?= URL."public/assets/images/".$carts["image"] ?>" alt="<?=$carts["description"]?>" class='card-image' >
    <h4><?= $carts["nom"] ?></h4>
    <div>Prix : <?= $carts["prix"] ?>€</div>

<hr>
<?php
}
?>

    <h3>Prix total : <?= $sum ?>€</h3>