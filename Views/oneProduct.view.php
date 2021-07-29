<div class="col-12">
      <div class="oneProduct row g-0 rounded align-middle overflow-hidden flex-md-row col-sm-12 mb-4">
        <div class="col-4 d-lg-block me-5 oneProduct">
            <img src='<?= URL."public/assets/images/".$oneProduct[0]['image'] ?>' class="col-10 col-sm-12 m-5" >
        </div>
        <div class="col-5 p-4 d-flex flex-column position-static oneProduct ms-4">
          <h3 class="mb-0"><?= $oneProduct[0]["nom"] ?></h3>
          <hr>
<?php 
  if ($oneProduct[0]["stock"] < 10){
?>
          <div class="mb-1 text-danger">Attention il ne reste plus que <?= $oneProduct[0]["stock"]?>  exemplaires de ce produit</div>
<?php
  } else {
?>
          <div class="mb-1 text-success">Actuellement en stock (<?= $oneProduct[0]["stock"]?> disponibles)</div>
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
        <div class="col-2 p-4 border rounded d-flex flex-column position-static oneProduct">
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
          <form action="<?=URL?>product/addToCart&id=<?=$_GET['id']?>" method="POST">
          <label  for="numberProduct">Quantité :</label>
            <input class="col-3 border rounded text-center" type="number" name="numberProduct" id="numberProduct" value=1>
          <br>
          <strong class="d-inline-block mb-2 text-success"><?= $oneProduct[0]["prix"] ?>€</strong>
          <br>
          <span class="d-inline-block mb-1 text-muted">
            <span><img src='<?= URL."public/assets/images/"?>cadenas.png' class="me-2" height="15px">Transactions sécurisées</span>
          </span>
          <br>
          <button type="submit" class="btn btn-primary">Ajouter au panier</button>
          </form>
        </div>
      </div>
    </div>
  </div>
