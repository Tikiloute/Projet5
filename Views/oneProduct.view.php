<div class="col-md-6">
      <div class="row g-0 rounded align-middle overflow-hidden flex-md-row mb-4  h-md-250 position-relative">
        <div class="col-auto d-none d-lg-block">
            <img src='<?= URL."public/assets/images/".$oneProduct[0]['image'] ?>' class="me-5" width="320px" height="400px">
        </div>
        <div class="col p-4 d-flex flex-column position-static">
          <h3 class="mb-0"><?= $oneProduct[0]["nom"] ?></h3>
          <hr>
          <div class="mb-1 text-muted">A remplir</div>
          <div class="mb-1 text-muted">En stock ?</div>
          <p class="mb-auto"><?= $oneProduct[0]["description"] ?></p>
          <br>
          <strong class="d-inline-block mb-2 text-success"><?= $oneProduct[0]["prix"] ?>€</strong>
          <br>
          <a href="#" class="card-link btn btn-primary">Ajouter au panier</a>
        </div>

      </div>
    </div>
  </div>
