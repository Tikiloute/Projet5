<h1>Ajouter de nouveaux produits ici !</h1>

<form action="<?= URL ?>connect/addProduct" method="POST" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="productName" class="form-label">Nom du produit</label>
    <input type="text" class="form-control" id="productName" name="name">
  </div>
  <div class="mb-3">
    <label for="productDescription" class="form-label">Description</label>
    <textarea name="description" class="form-control" id="productDescription" cols="50" rows="5"></textarea>
  </div>
  <div class="mb-3">
    <label for="productStock" class="form-label">Stock</label>
    <input type="number" class="form-control" id="productStock" name="stock">
  </div>
  <div class="mb-3">
    <label for="productImage" class="form-label">Image</label>
    <input type="file" class="form-control" id="productImage" name="image">
  </div>
  <label for="modifyCategory" class="form-label">Catégorie</label>
  <select class="form-control" name="category_name" id="modifyCategory">
<?php
  foreach ($categories as $category){
?>
  <option value="<?= $category['id']?>"><?= $category['category_name']?></option>
<?php
    }
?>
  </select>
  <div class="mb-3">
    <label for="productPrice" class="form-label">Prix</label>
    <input type="number" class="form-control" id="productPrice" name="price">
  </div>
  <button type="submit" class="btn btn-primary">Envoyer</button>
</form>