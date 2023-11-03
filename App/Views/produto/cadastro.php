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
            <div class="mb-3">
                <label for="nome" class="form-label">Nome do Produto</label>
                <input type="text" name="nome" class="form-control"
             
                id="nome">

            </div>
            <div class="mb-3">
                <label for="preco" class="form-label">Preço</label>
                <input type="text" class="form-control" name="preco" value="" id="preco" placeholder="R$">
            </div>
            <div class="mb-3">
                <label for="peso" class="form-label">Peso</label>
                <input type="text" class="form-control" id="peso" name="peso" placeholder="Kg">
            </div>

            <div class="mb-3">
                <label for="peso" class="form-label">Tipo</label>
                <select class="form-select" name="tipo">
                    <option selected>Selecione um tipo</option>
                    <?php
                    foreach ($viewVar["listaTipo"] as $tipo) { ?>

                        <option value="<?php echo $tipo->getTipocod() ?>">
                            <?php echo $tipo->getTipo_nome() ?>
                        </option>
                        ?>

                    <?php } ?>
                </select>

            </div>
            <div class="mb-3 up">
                <label for="imagem">Imagem</label>
                <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*">
                <p class="help-block">JPG, PNG ou GIF.</p>
                <p><img id="foto" data-src="holder.js/180x180" src="" width="180" class="img-fluid"
                        alt="Imagem Produto"></p>
            </div>

            <div class="mb-3" style="width: 600px;">
                <label for="descricao" class="form-label">Informções do Produto ou Ingredientes</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
                <input class="form-check-input" type="checkbox" id="promo" name="promo">
                <label class="form-check-label" for="promo">
                    Promoção
                </label>

            </div>



        </div>

        <br>

        <button type="submit" class="btn btn-primary">Salvar</button>

        <a href="http://<?php echo APP_HOST; ?>/produto">
           <button type="button" class="btn btn-secondary">Cancelar</button>
           </a>

    </form>
</div>