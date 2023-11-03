<h2 class="text-center">
    <?php

    use App\Lib\Sessao;

    echo TITLE; ?>
</h2>

<div class="container-sm">

    <div class="d-flex justify-content-between">

        <div>

            <a class="" href="http://<?php echo APP_HOST ?>/produto/cadastro">
                <button type="button" class="btn btn-success">Novo</button>
            </a>
        </div>


        <form action="http://<?php echo APP_HOST; ?>/produto/" method="get" class="form-inline">
            <div class="input-group mb-3" style="width:300px;">

                <input class="form-control" type="text" name="busca" placeholder=""
                    aria-label="Recipient's username">
                <button class="btn btn-outline-success" type="subimit" id="button-addon2">Buscar</button>

            </div>
        </form>
    </div>
    <?php
    if (Sessao::retornaErro()) {

        echo "<br> <span class='alert alert-warning'> ".Sessao::retornaErro()." <br> </span>";
    }
    if ( Sessao::retornaMensagem()) {

        echo " <br> <span class='alert alert-warning'>". Sessao::retornaMensagem()." <br> </span>";
    }

    ?>

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
                            height="30" alt="">

                    </td>

                    <td>
                        <?php echo ($produto->getPromo() == 1) ? 'promoção' : 'Normal'; ?>
                    </td>
                    <td class="d-flex justify-content-center align-items-center">

                        <a href="http://<?php echo APP_HOST; ?>/produto/edicao/<?php echo $produto->getCodigo(); ?>
                        <?php echo $viewVar['queryString']; ?>" style="margin-right: 5px;">

                            <button type="button" class="btn btn-primary">Editar</button>
                        </a>
                        <a href="">


                            <button type="button" class="btn btn-danger">Excluir</button>
                        </a>

                    </td>

                </tr>
            <?php } ?>



        </tbody>
    </table>
    <div class="teste">
        <?php echo $viewVar['paginacao']; ?>
    </div>

</div>