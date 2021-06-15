<h1>Modifiez vos produits ici !</h1>

<?php
foreach ($productCategory as $product){
?>
<form action="<?= URL ?>connect/productModified" method="POST">
    <input type="text" name="name" id="" value="<?= $product["nom"] ?>">
    <textarea name="description" id="" cols="50" rows="1"><?=$product["description"]?></textarea>
    <input type="number" name="price" id="" value="<?= $product["prix"] ?>">
    <input type="hidden" name="id" value="<?= $product["idProduit"] ?>">
    <select name="category_name" id="">
    <option value="" selected><?= $product["category_name"]?></option>
<?php
foreach ($categories as $category){
    if ($category['category_name'] !== $product["category_name"]){
?>
    <option value="<?= $category['id']?>"><?= $category['category_name']?></option>
<?php
    }
}
?>
    </select>
    <input class="btn btn-primary" type="submit" value="<?= $product['idProduit']?>">
</form>
<br>
<?php 
}
?>