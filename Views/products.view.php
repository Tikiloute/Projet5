<div class="container">
  <div class="row">
<?php 
if (!empty($products)){
    foreach ($products as $product){
        if (!empty($_GET["category"]) && $product["id_category"] === $_GET["category"]){
?>
        <div class="col-sm-12 col-md-4">
            <div class="custom-column">
                <div class="custom-column-header">
                    <h5 class="card-title"><?= $product["nom"] ?></h5>
                </div>
                <div class="card" style="width: 18rem;">
                    <img src="<?= URL."public/assets/images/".$product["image"] ?>" width="100px" height="210px" class="card-img-top" alt=<?= $product['description']?>>
                    <div class="card-body">
                        <p class="card-text"><?= $product['description'] ?></p>
                    </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Prix : <?= $product['prix'] ?>€ </li>
                        </ul>
                    <div class="card-body">
                        <a href="#" class="card-link btn btn-primary">Voir l'article</a>
                        <a href="#" class="card-link btn btn-primary">Ajouter au panier</a>
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

