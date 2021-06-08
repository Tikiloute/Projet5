<h1 class="text-center"> Bienvenue sur la page de votre compte</h1>
<br>
<br>

<?php 


echo "<h2 class='text-center'>Bienvenue sur votre espace ".$_SESSION["login"].", ici vous pourrez modifier vos informations ";
?>
<br>
<br>
<h3>Vos informations personnelles :</h3>
<br>

<div class="row justify-content-center">
    <div class="col-auto">
        <table class="table table-responsive">
            <tr>
                <td class="tableauInfos text-center text-uppercase fw-bolder"><?= "Votre nom" ?></td>
                <td class="tableauInfos text-center text-uppercase fw-bolder"><?= "Votre prénom" ?></td>
                <td class="tableauInfos text-center text-uppercase fw-bolder"><?= "Votre adresse" ?></td>
                <td class="tableauInfos text-center text-uppercase fw-bolder"><?= "Votre adresse email"?></td>
            </tr>
            <tr>
                <td class="tableauInfos text-center text-capitalize"><?= $users["nom"]?></td>
                <td class="tableauInfos text-center text-capitalize"><?= $users["prenom"]?></td>
                <td class="tableauInfos text-center"><?= $users["adresse"]?></td>
                <td class="tableauInfos text-center text-capitalize"><?= $users["mail"]?></td>
                <td><button type="button" class="btn btn-outline-secondary">Modifier vos informations</button></td>
            </tr>
        </table>
    </div>
</div>