<?php
    if (isset($category["category_name"])){
?>
<h2>Bienvenue sur la partie <?= $category["category_name"]?></h2>
<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi reprehenderit rem ipsam nemo, accusantium numquam fugiat ab voluptatum quia quidem aliquid similique optio repellendus exercitationem quis illum velit. Quaerat adipisci error quibusdam amet repellendus quo perspiciatis dicta beatae veritatis. Est doloremque omnis aliquid consequuntur, impedit dolor repudiandae, inventore laudantium exercitationem optio consequatur quibusdam accusamus quis. Iusto esse minima quaerat quibusdam molestias commodi sed, natus earum veniam! Id obcaecati facere veritatis fugit nisi incidunt qui corporis fuga quae voluptatibus, pariatur quo necessitatibus tempora repellendus sit dolor neque quas animi illo enim, voluptatum cupiditate? Voluptatum aliquid sed dolore placeat? Molestiae, a dignissimos?</p>
<?php
    }
?>
<div class="container text-center container-fluid">
  <div class="row ">
<?php 
if (!empty($products)){
    foreach ($products as $product){
?>
        <div class="col-md-4 sm-col-12 mx-auto col-12 text-center container">
            <div class="custom-column">
                <div class="card mx-auto" style="width: auto;">
                    <div class="card-image">
                        <a href="<?=URL?>product&id=<?=$product['id']?>"><img src="<?= URL."public/assets/images/".$product["image"] ?>"  class="mt-2 card-img-top photo" alt=<?= $product['description']?>></a>
                    </div>
                    <div class="card-body  text-center white">
                        <p class="h6 card-text white"><?= $product["nom"] ?></p>
                    </div>
                        <ul class="list-group list-group-flush">
                            <li class="h6 list-group-item">Prix : <?= $product['prix'] ?>€ </li>
                        </ul>
                    <div class="col-sm-12 col-md-12 col-12 card-body">
                        <a href="<?=URL?>product&id=<?=$product['id']?>" class="col-5 card-link btn btn-info text-light">Voir l'article</a>
                        <a href="<?=URL?>products/addToCart&category=<?= $_GET['category']?>&paging=<?= $_GET["paging"]?>&id=<?=$product['id']?>" class="col-5 card-link btn btn-primary">Ajouter au panier</a>
                    </div>
                </div>
            </div>
        </div>
    <br>
<?php
    }
}
?>
    </div>
</div>
<br>
<br>
<?php 
    if (isset($_GET["paging"]) && $_GET["paging"] <= $numberOfPages){
        if (isset($_GET["paging"]) && $_GET["paging"] >0){
?>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center text-decoration-none">
    <li class="page-item <?php if ($_GET["paging"]<2){ echo "disabled"; } ?>"><a class="page-link link-dark" href="<?= URL."products&amp;category=".$_GET["category"]."&amp;paging=".$_GET["paging"]-1 ?>" >Pécédent</a></li>
<?php
for ($i = 1; $i <= $numberOfPages; $i++){
?>

    <li class="page-item"><a class="page-link link-dark" href="<?= URL."products&amp;category=".$_GET["category"]."&amp;paging=".$i ?>"><?= $i ?></a></li>
   
<?php
}
?>
 <li class="page-item <?php if ($_GET["paging"]==$numberOfPages){ echo "disabled"; } ?>"><a class="page-link link-dark" href="<?= URL."products&amp;category=".$_GET["category"]."&amp;paging=".$_GET["paging"]+1 ?>">Suivant</a></li>
  </ul>
</nav>

<?php
        }
    }