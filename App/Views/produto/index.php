<h2 class="text-center">
    <?php echo TITLE; ?>
</h2>
<h3 class="text-center">Gerenciamento de Produtos</h3>

<div class="container-sm">
    <div class="d-flex justify-content-between">

        <div>

            <a class="" href="http://<?php echo APP_HOST ?>/produto/cadastro">
                <button type="button" class="btn btn-success">Novo</button>
            </a>
        </div>

      
        <div class="input-group mb-3" style="width:300px;">
            <input class="form-control" type="text" placeholder="Recipient's username"
                aria-label="Recipient's username">
            <button class="btn btn-outline-success" type="button" id="button-addon2">Buscar</button>

        </div>
    </div>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col-2">Nome</th>
                <th scope="col-2">Descrição</th>
                <th scope="col-2">Peso/ml</th>
                <th scope="col-2">Preço </th>
                <th scope="col-2">Imagem</th>

                <th scope="col-2">Promoção</th>
                <th scope="col-2" class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">

            <?php
            foreach ($viewVar['listaProdutos'] as $produto) { ?>
                <tr>
                    <th scope="row">
                        <?php echo $produto->getCodigo(); ?>
                    </th>
                    <td>
                        <?php echo $produto->getNome(); ?>
                    </td>
                    <td>
                        <?php echo substr($produto->getDescricao(), 0, 70); ?>
                    </td>
                    <td class="text-center">
                        <?php echo $produto->getPeso(); ?> 
                    </td>
                    <td>
                        R$
                        <?php echo number_format($produto->getPreco(), 2, ',', '.'); ?>
                    </td>
                    <td>
                        <img src="http://<?php echo APP_HOST ?>/public/image/produtos/<?php echo $produto->getImageUrl(); ?>"
                            width="45 alt="">
                       <!--   -->
                    </td>
                  
                    <td>
                        <?php echo ($produto->getPromo() == 1) ? 'promoção' : ''; ?>
                    </td>
                    <td class=" d-flex justify-content-center">

                        <a href="http://<?php echo APP_HOST ?>/produto/edicao/<?php echo $produto->getCodigo(); ?><?php echo $viewVar['queryString']; ?>"
                        style="margin-right: 5px;">

                            <button type="button" class="btn btn-primary">Editar</button> 
                        </a>
                        <button type="button" class="btn btn-danger">Excluir</button>

                    </td>

                </tr>
            <?php } ?>



        </tbody>
    </table>
    <div class="teste" >
        <?php echo $viewVar['paginacao']; ?>
   </div>

</div>