<h1 class="text-center"> Bienvenue sur la page de votre compte</h1>
<br>
<br>

<?php 
var_dump($users);
if($users["role"] != "administrateur"){
    /**
     * Partie Client------------------------------------------------------------------------------------------------------------
     */
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
                </tr>
            </table>
            <form action="https://google.com">
                <input class="btn btn-outline-secondary" type="submit" value="Modifier vos informations" />
            </form>
        </div>
        <a href="<?= URL ?>connect/connected" type="button" class="btn btn-success">Ajouter une adresse de facturation</a>
        <!-- onclick ajouter un champs puis gérer le champs avec $_POST et un update de la bdd -->
    </div>

    <br>
    <br>
    <h3>Historique de vos commandes :</h3>
    <br>
    <div class="row justify-content-center">
        <div class="col-auto">
            <table class="table table-responsive">
                <tr>
                    <td class="tableauInfos text-center text-uppercase fw-bolder"><?= "produit" ?></td>
                    <td class="tableauInfos text-center text-uppercase fw-bolder"><?= "quantité" ?></td>
                    <td class="tableauInfos text-center text-uppercase fw-bolder"><?= "prix" ?></td>
                    <td class="tableauInfos text-center text-uppercase fw-bolder"><?= "date"?></td>
                </tr>
                    <?php
                        for($i = 0; $i < $countPanier; $i++){
                    ?>
                <tr>
                    <td class="tableauInfos text-center"><?= $panier[$i]["nom"] ?></td>
                    <td class="tableauInfos text-center"><?= $panier[$i]["quantity"] ?></td>
                    <td class="tableauInfos text-center"><?= $panier[$i]["prix"] ?>€</td>
                    <td class="tableauInfos text-center"><?= $panier[$i]["date"] ?></td>
                </tr>
                    <?php
                        }
                    ?>
            </table>
        </div>
    </div>
<?php
/**
 * Fin partie client -------------------------------------------------------------------------------------------------------------
 */
} else {
/**
 * Début partie administrateur ----------------------------------------------------------------------------------------------------
 */
    echo "<h2 class='text-center'>Bienvenue sur votre espace ".$_SESSION["login"].", ici vous pourrez administrer le site marchand";
?>
    <br>
    <br>
    <h3>Ajouter des produits</h3>
    <a href="<?= URL ?>connect/addArticle" type="button" class="btn btn-success">Créer un produit</a>
    <br>
    <br>
    <h3>Modifier le rôle d'un compte</h3>
    <a href="<?= URL ?>connect/modifyRole" type="button" class="btn btn-success">Modifier le rôle</a>
    <br>
    <br>
    <h3>Créer une promotion</h3>
    <a href="<?= URL ?>connect/modifyRole" type="button" class="btn btn-success">promotion</a>
    <br>
    <br>
    <h3>Voir le chiffre d'affaire</h3>
    <a href="<?= URL ?>connect/turnover" type="button" class="btn btn-success">chiffre d'affaire</a>
    <br>
    <br>
    <h3>Voir le stock</h3>
    <a href="<?= URL ?>connect/stock" type="button" class="btn btn-success">voir le stock</a>

<?php
/**
 * Fin partie administrateur-------------------------------------------------------------------------------------------------------
 */
}
