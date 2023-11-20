<h2 class="text-center">
    <?php

    use App\Lib\Sessao;

    echo TITLE; ?>
</h2>


<?php

if (isset($_SESSION['erro'])) {

    echo "<br> <span class='alert alert-warning'> " . $_SESSION['erro'] . " <br> </span>";
}
if (isset($_SESSION['mensagem'])) {

    echo " <br> <span class='alert alert-warning'>" . $_SESSION['mensagem'] . " <br> </span>";
}

if (isset($_SESSION["tipo"]) && $_SESSION['tipo'] == 'admin') { ?>

    <div class="container-sm">

        <div class="d-flex justify-content-between">

            <div>

                <a class="" href="http://<?php echo APP_HOST ?>/produto/cadastro">
                    <button type="button" class="btn btn-success">Novo</button>
                </a>
            </div>


            <form action="http://<?php echo APP_HOST; ?>/produto/" method="get" class="form-inline">
                <div class="input-group mb-3" style="width:300px;">

                    <input class="form-control" type="text" name="busca" placeholder="" aria-label="Recipient's username">
                    <button class="btn btn-outline-success" type="subimit" id="button-addon2">Buscar</button>

                </div>
            </form>
        </div>




        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col-2">Nome</th>
                    <th scope="col-2">Descrição</th>
                    <th scope="col-2">Kg/ml</th>
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

                            <a href="http://<?php echo APP_HOST; ?>/produto/exclusao/<?php echo $produto->getCodigo(); ?>
                        <?php echo $viewVar['queryString']; ?>" style="margin-right: 5px;">

                                <button type="button" class="btn btn-danger">Excluir</button>
                            </a>



                        </td>

                    </tr>
                <?php } ?>



            </tbody>
        </table>
    <?php } else { 
       
        ?>


        <div class="container-sm">

            <div class="d-flex justify-content-end">

                <form action="http://<?php echo APP_HOST; ?>/produto/" method="get" class="form-inline">
                    <div class="input-group mb-3" style="width:300px;">

                        <input class="form-control" type="text" name="busca" placeholder=""
                            aria-label="Recipient's username">
                        <button class="btn btn-outline-success" type="subimit" id="button-addon2">Buscar</button>

                    </div>
                </form>
            </div>




            <hr>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"># </th>
                        <th scope="col">Nome</th>
                        <th scope="col">Descriçao</th>
                        <th scope="col">Peso/ml</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Adicionar ao carrinho</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                  
                    foreach ($viewVar['listaProdutos'] as $produto) { ?>

                        <tr>
                            <th scope="row">

                                <img src="http://<?php echo APP_HOST ?>/public/image/produtos/<?php echo $produto->getImageUrl(); ?>"
                                    height="30" alt="">

                            </th>
                            <td>
                                <?php echo $produto->getNome() ?>
                            </td>
                            <td>
                                <?php echo $produto->getDescricao() ?>
                            </td>
                            <td>
                                <?php echo $produto->getPeso() ?>
                            </td>
                            <td>
                                <?php
                                $desc = $produto->getPreco() - $produto->getPreco() * 0.07;
                                echo ($produto->getPromo() == 1) ? 'Promo R$ ' : 'R$ ';
                                echo ($produto->getPromo() == 1) ? number_format($desc, 2, ',', '.') : number_format($produto->getPreco(), 2, ',', '.') ?>
                            </td>
                            <td>

                                <form method="post" action="http://<?php echo APP_HOST ?>/pedido/carrinho" class="d-flex">
                                
                                 <input type="hidden" name="cod" value="<?php echo $produto->getCodigo()?>">
                                   
                                   
                                    <input type="hidden" name="preco" value="<?php echo $produto->getPreco()?>">
                                   
                                   
                                    <input class="form-control" name="qtd" type="number" id="qtd"
                                     style="width: 60px;" min="1" value="1"> &nbsp;
                                 
                                 
                                     <button type="submit" class="btn btn-outline-success btn-floating"
                                        data-mdb-ripple-color="dark" >
                                        <i class="fas fa-star">+</i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                    <?php } ?>


                <?php } ?>

            </tbody>
        </table>

        <div class="teste">
            <?php echo $viewVar['paginacao']; ?>
        </div>

    </div>