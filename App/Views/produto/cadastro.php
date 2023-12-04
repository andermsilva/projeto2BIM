<h2 class="text-center">Cadastro de Produto</h2>
<div class="container2 container">
    <?php if ($Sessao::retornaErro()) { ?>
        <div class="alert alert-warning" role="alert">
            <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php foreach ($Sessao::retornaErro() as $key => $mensagem) {
                echo $mensagem . "<br />";
            } ?>
        </div>
    <?php } ?>
    <form method="post" action="http://<?php echo APP_HOST; ?>/produto/salvar" enctype="multipart/form-data">
        <div class="container3">
            

        </div>

        <br>

        <button type="submit" class="btn btn-primary">Salvar</button>

        <a href="http://<?php echo APP_HOST; ?>/produto">
           <button type="button" class="btn btn-secondary">Cancelar</button>
           </a>

    </form>
</div>