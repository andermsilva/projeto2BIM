<h1 class="text-center"><?php echo TITLE;?></h1>
<div class="container d-flex flex-row mb-3 p-4 flex-wrap align-content-center justify-content-start">
    <?php 
    foreach ($viewVar["listaProdutos"] as $produto) {
       // echo $produto->getImageUrl();
        ?>
        <div class="card shadow mb-4 ms-4 corfundo2" style="width: 18rem;">
       
      
      <img src="http://<?php echo APP_HOST; ?>/public/image/produtos/<?php echo $produto->getImageUrl();?>" class="img_card" alt="..."> 
        <div class="card-body">
            <p class="card-text"><?= $produto->getNome()?>.... R$ <?=number_format($produto->getPreco(),2,',',".") ?></p>
            <p class="card-text"><?= number_format($produto->getPeso(), 2, ',', '.')?> Kg</p>
        </div>
    </div> 
    <?php } ?>
 
</div>
<br />
<br />
<br />