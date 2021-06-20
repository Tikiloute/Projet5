
<div class="col-12">
      <div class="row g-0 rounded align-middle overflow-hidden flex-md-row mb-4  h-md-250 position-relative">
        <div class="col-4 d-none d-lg-block">
            <img src='<?= URL."public/assets/images/".$oneProduct[0]['image'] ?>' class="col-10 m-5" >
        </div>
        <div class="col-5 p-4 d-flex flex-column position-static">
          <h3 class="mb-0"><?= $oneProduct[0]["nom"] ?></h3>
          <hr>
<?php 
  if ($oneProduct[0]["stock"] < 10){
?>
          <div class="mb-1 text-danger">Attention il ne reste plus que <?= $oneProduct[0]["stock"]?>  exemplaires de ce produit</div>
<?php
  }
?>
          <div class="mb-1 text-warning">Habituellement expédié sous 3 jours</div>
          <br>
          <p class="mb-auto"><?= $oneProduct[0]["description"] ?></p>
          <br>
          <strong class="d-inline-block h3 mb-2 text-success"><?= $oneProduct[0]["prix"] ?>€</strong>
          <br>
        </div>
        <div class="col-2 p-4 border rounded d-flex flex-column position-static">
          <h6 class="mb-0 text-warning">Livraison gratuite si la commande dépasse les 50€</h6>
          <hr>
          <div class="mb-1 text-muted">A remplir</div>
<?php
  if ($oneProduct[0]["stock"] > 0){
?>
          <div class="mb-1 h6 text-success">Actuellement en stock</div>
<?php
  } else {
?>  
          <div class="mb-1 h6 text-danger">Article actuellement indisponible</div>
<?php
  } 
?>
          <br>
          <form action="#" method="POST">
          <label  for="numberProduct">Quantité</label>
            <input class="col-3 border rounded" type="number" name="numberProduct" id="numberProduct">
          </form>
          <br>
          <strong class="d-inline-block mb-2 text-success"><?= $oneProduct[0]["prix"] ?>€</strong>
          <br>
          <span class="d-inline-block mb-1 text-muted">
            
            <span><img src='<?= URL."public/assets/images/"?>cadenas.png' class="me-2" height="15px">Transactions sécurisées</span>
          </span>
          <br>
          <a href="#" class="card-link btn btn-primary">Ajouter au panier</a>
        </div>
      </div>
    </div>
  </div>
