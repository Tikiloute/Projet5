<h1 class="text-center"> Bienvenue sur la page de votre compte</h1>
<br>
<br>

<?php 
if($users["role"] != "administrateur"){
    /**
     * Partie Client------------------------------------------------------------------------------------------------------------
     */
    echo "<h2 class='text-center'>Bienvenue sur votre espace ".$_SESSION["login"].", ici vous pourrez modifier vos informations <h2>";
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
<?php 
    if (!empty($users["adresse_de_facturation"])){
?>
                    <td class="tableauInfos text-center text-uppercase fw-bolder"><?= "Votre adresse de facturation" ?></td>
<?php 
    }
?>
                </tr>
                <tr>
                    <td class="tableauInfos text-center text-capitalize"><?= $users["nom"]?></td>
                    <td class="tableauInfos text-center text-capitalize"><?= $users["prenom"]?></td>
                    <td class="tableauInfos text-center"><?= $users["adresse"]?></td>
                    <td class="tableauInfos text-center text-capitalize"><?= $users["mail"]?></td>
<?php 
    if (!empty($users["adresse_de_facturation"])){
?>
                    <td class="tableauInfos text-center text-capitalize"><?= $users["adresse_de_facturation"]?></td>
<?php 
    }
?>

                    <td><a href="<?= URL ?>connect/connected/modifyProfile" class="btn btn-outline-secondary" type="submit" value="Modifier vos informations" >Modifier vos informations</td>   
                </tr>
            </table>
<?php 
    if(empty($users["adresse_de_facturation"])){ // ajout de
?>
            <a href="<?= URL ?>connect/connected&billAddress" type="button" class="btn btn-success">Ajouter une adresse de facturation</a>
<?php 
    } else {
?>
            <a href="<?= URL ?>connect/connected&billAddress" type="button" class="btn btn-success">Modifiez votre adresse de facturation</a>
<?php
 } 
    if(isset($_GET["billAddress"])){ // ajout de
?>
                <form class="mt-2" action="<?= URL ?>connect/connected/billAddress&updateBillAddress=true" method="POST">
                    <input placeholder="Votre adresse de facturation" type="text" name="billAddress" id="billAddress">
                    <input class="btn btn-primary" type="submit" value="Validez">
                </form>
<?php
    }
?>
        </div>
        
        <!-- onclick ajouter un champs puis gérer le champs avec $_POST et un update de la bdd -->
    </div>

    <br>
    <br>
    <?php
    if (!empty($purchaseHistory)){
    ?>
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
                    
                    if(isset($purchaseHistory)){
                        foreach ($purchaseHistory as $purchase){
                    ?>
                <tr>
                    <td class="tableauInfos text-center"><?= $purchase["nom"] ?></td>
                    <td class="tableauInfos text-center"><?= $purchase["quantity"] ?></td>
                    <td class="tableauInfos text-center"><?= $purchase["prix"]* $purchase["quantity"] ?>€</td>
                    <td class="tableauInfos text-center"><?= $purchase["date"] ?></td>
                </tr>
                    <?php
                        }
                    }
                    ?>
            </table>
        </div>
    </div>
<?php
    }
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
    <h4>Ajouter des produits</h4>
    <a href="<?= URL ?>connect/addProduct" type="button" class="btn btn-success">Créer un produit</a>
    <br>
    <br>
    <h4>Modifier le rôle d'un compte</h4>
    <a href="<?= URL ?>connect/modifyRole" type="button" class="btn btn-success">Modifier le rôle</a>
    <br>
    <br>
    <h4>Modifier les produits</h4>
    <a href="<?= URL ?>connect/modifyProduct" type="button" class="btn btn-success">Modifier les produits</a>
    <br>
    <br>
    <h4>Voir le chiffre d'affaire</h4>
    <a href="<?= URL ?>connect/turnover" type="button" class="btn btn-success">Chiffre d'affaire</a>
    <br>
    <br>
    <h4>Voir le stock</h4>
    <a href="<?= URL ?>connect/stock" type="button" class="btn btn-success">Voir le stock</a>
    <br>
    <br>
    <h4>Modifier vos identifiants</h4>
    <a href="<?= URL ?>connect/modifyAdministratorIdentify" type="button" class="btn btn-success">Modifier votre identifiant / Mot de passe</a>

<?php
/**
 * Fin partie administrateur-------------------------------------------------------------------------------------------------------
 */
}
