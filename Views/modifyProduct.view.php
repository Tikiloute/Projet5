<h1>Modifiez vos produits ici !</h1>

<?php
foreach ($productCategory as $product){
?>
<form action="<?= URL ?>connect/productModified" method="POST">
    <label for="modifyName" class="form-label">Nom du produit</label>
    <input class="form-control" type="text" name="name" id="modifyName" value="<?= $product["nom"] ?>">
<br>
    <label for="modifyDescription" class="form-label">Description</label>
    <textarea class="form-control" name="description" id="modifyDescription" cols="50" rows="3"><?=$product["description"]?></textarea>
<br>
    <label for="modifyPrice" class="form-label">Prix</label>
    <input class="form-control" type="number" name="price" id="modifyPrice" value="<?= $product["prix"] ?>">
<br>
    <input class="form-control" type="hidden" name="id" value="<?= $product["idProduit"] ?>">

    <label for="modifyCategory" class="form-label">Catégorie</label>
    <select class="form-control" name="category_name" id="modifyCategory">
<?php
foreach ($categories as $category){
    if ($category['category_name'] === $product["category_name"]){
?>
    <option value="<?= $category['id']?>" selected><?= $product["category_name"]?></option>
<?php
    } else {
?>
    <option value="<?= $category['id']?>"><?= $category['category_name']?></option>
<?php        
    }
}
?>
    </select>
    <br>
    <input class="btn btn-primary" type="submit" value="Modifiez">
</form>
<br>
<hr>

<?php 
}
?>