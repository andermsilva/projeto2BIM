<h2 class="text-center">Excluir Produto</h2>
<div class="card-excluir">
    <?php if ($Sessao::retornaErro()) { ?>
        <div class="alert alert-warning" role="alert">
            <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php foreach ($Sessao::retornaErro() as $key => $mensagem) {
                echo $mensagem . "<br />";
            } ?>
        </div>
    <?php } ?>
    <form method="post" action="http://<?php echo APP_HOST; ?>/produto/excluir">


        <div class="input-group mb-3">
            <input type="hidden" name="cod" value="<?php echo trim($viewVar['produto']->getCodigo()) ?>">
            <label for="nome" class="form-label">Nome

                <input type="text" class="form-control" name="nome" id="nome" readonly placeholder=""
                    value="<?php echo ($viewVar['produto']->getNome()) ?>">
            </label>
            &nbsp;
            <label for="tipo" class="form-label">Tipo

                <input type="text" class="form-control" name="imagem"
                    value="<?php echo trim($viewVar['produto']->getTipoProduto()->getTipo_nome()) ?>" placeholder="">
            </label>
        </div>
        <div class="input-group">
            <span class="input-group-text">Descrição:</span>
            <textarea class="form-control" aria-label="With textarea" readonly>
                    <?php echo trim($viewVar['produto']->getDescricao()) ?>
                </textarea>
        </div>
        <br>
       
                <strong style="margin-left: 130px;">Imagem do Produto</strong>
            <img 
            src="http://<?php echo APP_HOST ?>/public/image/produtos/<?php echo trim($viewVar['produto']->getImageUrl()) ?>"
                class="rounded mx-auto d-block" id="foto" data-src="holder.js/180x180" width="120" alt="...">
       
        <br>

        <button type="submit" class="btn btn-danger">Excluir</button>

        <a href="http://<?php echo APP_HOST; ?>/produto">
            <button type="button" class="btn btn-secondary">Cancelar</button>
        </a>


    </form>
</div>