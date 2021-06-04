<h1> Bienvenue sur la page de connexion non prise en compte pour l'instant </h1>

<form action="<?= URL ?>connect/tryToConnect" method="POST">
  <div class="mb-3">
    <label for="login" class="form-label">Votre identifiant</label>
    <input type="text" class="form-control" id="login" name="login">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Mot de passe</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <button type="submit" class="btn btn-primary">Vous connectez</button>
  <a href="<?= URL ?>connect/createAccount" type="button" class="btn btn-success">Créer un compte</a>
</form>