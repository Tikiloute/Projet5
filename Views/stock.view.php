<h1>Page des stocks</h1>

<div class="row justify-content-center">
    <div class="col-auto">
        <table class="table table-responsive">
            <tr>
                <td class="tableauInfos text-center text-uppercase fw-bolder"><?= "nom" ?></td>
                <td class="tableauInfos text-center text-uppercase fw-bolder"><?= "description" ?></td>
                <td class="tableauInfos text-center text-uppercase fw-bolder"><?= "prix" ?></td>
                <td class="tableauInfos text-center text-uppercase fw-bolder"><?= "stock"?></td>
            </tr>
                <?php
                    foreach($produits as $products){
                ?>
            <tr>
                <td class="tableauInfos text-center"><?= $products["nom"] ?></td>
                <td class="tableauInfos text-center"><?= $products["description"] ?></td>
                <td class="tableauInfos text-center"><?= $products["prix"] ?>€</td>
                <td class="tableauInfos text-center"><?= $products["stock"] ?></td>
            </tr>
                <?php
                    }
                ?>
        </table>
    </div>
</div>
