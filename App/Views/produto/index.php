<h2 class="text-center">
    <?php echo TITLE; ?>
</h2>
<h3 class="text-center">Gerenciamento de Produtos</h3>

<div class="container-sm">
    <div>
        <a href="http://<?php echo APP_HOST ?>/produto/cadastro">
            <button type="button" class="btn btn-success">Novo</button>
        </a>
    </div>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col-2">Nome</th>
                <th scope="col-2">Descrição</th>
                <th scope="col-2">Peso</th>
                <th scope="col-2">Preço </th>
                <th scope="col-2">Imagem</th>
               
                <th scope="col-2">Promoção</th>
                <th scope="col-2">Ações</th>
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
                        <?php echo substr($produto->getDescricao(), 0, 25); ?>
                    </td>
                    <td>
                        <?php echo $produto->getPeso(); ?> Kg
                    </td>
                    <td>
                        R$
                        <?php echo number_format($produto->getPreco(), 2, ',', '.'); ?>
                    </td>
                    <td>
                        <?php echo $produto->getImageUrl(); ?>
                    </td>
                  
                    <td>
                        <?php echo $produto->getPromo(); ?>
                    </td>
                    <td class="d-flex">

                        <a href="http://<?php echo APP_HOST ?>/produto/cadastro/ <?php echo $produto->getCodigo(); ?>">

                            <button type="button" class="btn btn-primary">Editar</button> &nbsp;
                        </a>
                        <button type="button" class="btn btn-danger">Excluir</button>

                    </td>

                </tr>
            <?php } ?>



        </tbody>
    </table>
</div>