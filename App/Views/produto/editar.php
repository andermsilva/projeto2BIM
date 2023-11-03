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
    <form method="post" action="http://<?php echo APP_HOST; ?>/produto/atualizar" enctype="multipart/form-data">
        <div class="container3">
            <input type="hidden" name="cod" value="<?php echo $viewVar['produto']->getCodigo(); ?>">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome do Produto</label>
                <input type="text" name="nome" class="form-control"
                    value="<?php echo $viewVar['produto']->getNome(); ?>" id="nome">

            </div>
            <div class="mb-3">
                <label for="preco" class="form-label">Preço</label>
                <input type="text" class="form-control" value="<?php echo $viewVar['produto']->getPreco(); ?>"
                    name="preco" id="preco" placeholder="R$">
            </div>
            <div class="mb-3">
                <label for="peso" class="form-label">Peso</label>
                <input type="text" class="form-control" value="<?php echo $viewVar['produto']->getPeso(); ?>" id="peso"
                    name="peso" placeholder="Kg">
            </div>

            <div class="mb-3">
                <label for="peso" class="form-label">Tipo</label>
                <select class="form-select" name="tipo">
                    <option selected>Selecione um tipo</option>
                    <?php
                    foreach ($viewVar["listaTipo"] as $tipo) { ?>

                        <option  
                        <?php echo ($tipo->getTipocod() == $viewVar['produto']->getTipoProduto()->getTipocod()? 'selected':''  )?>
                        value="<?php echo $tipo->getTipocod() ?>">
                            <?php echo $tipo->getTipo_nome() ?>
                        </option>
                        ?>

                    <?php } ?>
                </select>

            </div>
            <div class="mb-3 up">
            <input type="hidden" name="imagem0" id="imagem0" value="<?php echo $viewVar['produto']->getImageUrl(); ?>">
                <input type="hidden" name="imagem1" id="imagem1" value="<?php echo $viewVar['produto']->getImageUrl(); ?>">
                <label for="imagem">Imagem</label>
                <input type="file" class="form-control" 
                id="imagem" name="imagem" 
                value="qq"
                accept="image/*>">
                <p class="help-block">JPG, PNG ou GIF.</p>
                <p><img id="foto" data-src="holder.js/180x180"
                 src="http://<?php echo APP_HOST ?>/public/image/produtos/<?php echo $viewVar['produto']->getImageurl() ?>" 
                 width="100" class="img-fluid"
                        alt="Imagem Produto"></p>
            </div>

            <div class="mb-3" style="width: 600px;">
                <label for="descricao" class="form-label">Informções do Produto ou Ingredientes</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3">

                <?php echo $viewVar['produto']->getDescricao() ?>
                </textarea>

                <input class="form-check-input" 
                   <?php echo ($viewVar['produto']->getPromo() == 1)?'checked':'';?>
                type="checkbox" id="promo" name="promo">
                <label class="form-check-label" for="promo">
                    Promoção 
                </label>

            </div>



        </div>

        <br>

        <button type="submit" class="btn btn-primary">Salvar</button>

    </form>
</div>