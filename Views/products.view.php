<div class="container">
  <div class="row">
<?php 
if (!empty($products)){
    foreach ($products as $product){
        if (!empty($_GET["category"]) && $product["id_category"] === $_GET["category"]){
?>
        <div class="col-sm-12 col-md-4 col-12">
            <div class="custom-column">
                <div class="card" style="width: 18rem;">
                    <img src="<?= URL."public/assets/images/".$product["image"] ?>" width="auto" height="auto" class="mt-2 card-img-top" alt=<?= $product['description']?>>
                    <div class="card-body">
                        <p class="h5 card-text"><?= $product["nom"] ?></p>
                    </div>
                        <ul class="list-group list-group-flush">
                            <li class="h6 list-group-item">Prix : <?= $product['prix'] ?>€ </li>
                        </ul>
                    <div class="col-sm-12 col-md-12 col-12 card-body">
                        <a href="<?=URL?>product&id=<?=$product['id']?>" class="col-5 card-link btn btn-primary">Voir l'article</a>
                        <a href="#" class="col-5 card-link btn btn-primary">Ajouter au panier</a>
                    </div>
                </div>
            </div>
        </div>
    <br>
<?php
        }
    }
}
?>
    </div>
</div>

