<h1>Bienvenue sur la page de création de compte</h1>

<form action="<?= URL ?>connect/accountCreated" method="POST">
  <div class="mb-3">
    <label for="createAccountLogin" class="form-label">Votre identifiant</label>
    <input type="text" class="form-control" id="createAccountLogin" name="login">
  </div>
  <div class="mb-3">
    <label for="createAccountSurname" class="form-label">Votre prénom</label>
    <input type="text" class="form-control" id="createAccountSurname" name="surname">
  </div>
  <div class="mb-3">
    <label for="createAccountName" class="form-label">Votre nom</label>
    <input type="text" class="form-control" id="createAccountName" name="name">
  </div>
  <div class="mb-3">
    <label for="createAccountAddress" class="form-label">Votre adresse (N'oubliez pas le code postal et la ville !)</label>
    <input type="text" class="form-control" id="createAccountAdress" name="address">
  </div>
  <div class="mb-3">
    <label for="createAccountMail" class="form-label" >Votre adresse e-mail</label>
    <input type="email" class="form-control" id="createAccountMail" name="mail">
  </div>
  <div class="mb-3">
    <label for="createAccountPassword" class="form-label">Mot de passe</label>
    <input type="password" class="form-control" id="createAccountPassword" name="password">
  </div>
  <div class="mb-3">
    <label for="createAccountConfirmPassword" class="form-label">Confirmez votre mot de passe</label>
    <input type="password" class="form-control" id="createAccountConfirmPassword" name="confirmPassword">
  </div>
  <button type="submit" class="btn btn-primary">Envoyer</button>
</form>