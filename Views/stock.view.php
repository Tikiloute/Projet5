<h1>Page des stocks</h1>
<div class="row justify-content-center stock">
    <div class="col-auto">
        <table class="table table-responsive">
            <tr>
                <td class="tableauInfos text-center text-uppercase fw-bolder"><?= "nom" ?></td>
                <td class="tableauInfos text-center text-uppercase fw-bolder"><?= "description" ?></td>
                <td class="tableauInfos text-center text-uppercase fw-bolder"><?= "prix" ?></td>
                <td class="tableauInfos text-center text-uppercase fw-bolder"><?= "stock"?></td>
                <td class="tableauInfos text-center text-uppercase fw-bolder"><?= "ajouter du stock"?></td>
            </tr>
                <?php
                    foreach($produits as $products){
                ?>
            <tr>
                <form action="<?= URL ?>connect/stock/updateStock&id=<?=$products['id']?>&stock=<?=$products["stock"]?>" method="POST">
                    <td name="productName" class="tableauInfos text-center"><?= $products["nom"] ?></td>
                    <td class="tableauInfos text-center"><?= $products["description"] ?></td>
                    <td class="tableauInfos text-center"><?= $products["prix"] ?>€</td>
                    <td class="tableauInfos text-center"><?= $products["stock"] ?></td>
                    <td class="tableauInfos text-center"><input type="number" name="addStock"></td>
                    <td><button type="submit" class="btn btn-primary">Modifier le stock</button></td>
                </form>
            </tr>
                <?php
                    }
                ?>
        </table>
    </div>
</div>
