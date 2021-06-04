    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item"><a href="<?= URL ?>accueil" class="nav-link active mt-2" aria-current="page">Accueil</a></li>
        <li class="nav-item"><a href="<?= URL ?>page1" class="nav-link mt-2">Page 1</a></li>
        <li class="nav-item"><a href="<?= URL ?>page2" class="nav-link mt-2">page 2</a></li>
        <li class="nav-item"><a href="<?= URL ?>cart" class="nav-link"><img src="<?= URL ?>public\assets\images\cart.png" width="40px" alt="caddie représentant le panier de client"></a></li>
        <li class="nav-item"><a href="<?= URL ?>connect" class="nav-link mt-2">Se connecter</a></li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search">
        <button class="btn btn-outline-secondary" type="submit">Rechercher</button>
      </form>
    </div>
  </div>
</nav>
