<h1>Page de modification des informations personnelles</h1>

<form action="<?= URL ?>connect/modifyAdministratorIdentify" method="POST">
  <div class="mb-3">
    <label for="login" class="form-label">Votre nouvel identifiant (si vous ne souhaitez pas le changer laissez le champs vierge)</label>
    <input type="text" class="form-control" id="changeLogin" name="changeLogin">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Votre nouveau mot de passe</label>
    <input type="password" class="form-control" id="changePassword" name="changePassword">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Confirmez votre nouveau mot de passe</label>
    <input type="password" class="form-control" id="confirmChangePassword" name="ConfirmPassword">
  </div>
  <button type="submit" class="btn btn-primary">Validez</button>
</form>