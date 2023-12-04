<div id="demo" class="carousel slide centralizar" data-bs-ride="carousel">


    <div class="carousel-indicators centralizar">
        <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
        <button type="button" data-bs-target="#demo" data-bs-slide-to="3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <p><img src="http://<?php echo APP_HOST ?>/public/image/banner/pokee.jpg" class="img-fluid"
                    alt="Responsive image"></p>
        </div>
        <div class="carousel-item active">
            <p><img src="http://<?php echo APP_HOST ?>/public/image/banner/saladacenoura.jpg" class="img-fluid"
                    alt="Responsive image"></p>
        </div>
        <div class="carousel-item active">
            <p><img src="http://<?php echo APP_HOST ?>/public/image/banner/brazo-gitano.jpg" class="img-fluid"
                    alt="Responsive image"></p>
        </div>
        <div class="carousel-item active">
            <p><img src="http://<?php echo APP_HOST ?>/public/image/banner/tortaSalgada.jpg" class="img-fluid"
                    alt="Responsive image"></p>
        </div>
    </div>
    <!-- adicionei -->
</div>
<?php
if (isset($_SESSION´['mensagem'])) {  var_dump($_SESSION['mensagem']) ?>
    <div class="class='alert alert-warning">
        <?php echo $_SESSION´['mensagem']; ?>
    </div>
<?php } ?>
<div class="container d-flex flex-row mb-3 p-4 flex-wrap align-content-center justify-content-start">
    <?php
    foreach ($viewVar["listaProdutos"] as $produto) {
        // echo $produto->getImageUrl();
        ?>
        <div class="card shadow mb-4 ms-4 corfundo2" style="width: 18rem;">


            <img src="http://<?php echo APP_HOST; ?>/public/image/produtos/<?php echo $produto->getImageUrl(); ?>"
                class="img_card" alt="...">
            <div class="card-body">
                <p class="card-text">
                    <?= $produto->getNome() ?>.... R$ <?= number_format($produto->getPreco(), 2, ',', ".") ?>
                </p>
                <p class="card-text">
                    <?= number_format($produto->getPeso(), 2, ',', '.') ?> Kg
                </p>
            </div>
        </div>
    <?php } ?>

</div>
<br />
<br />
<br />