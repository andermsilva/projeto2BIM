<h2 class="text-center">Pedidos</h2>
<?php

if (isset($_SESSION['erro'])) {

    echo "<br> <span class='alert alert-warning'> " . $_SESSION['erro'] . " <br> </span>";
}
if (isset($_SESSION['mensagem'])) {

    echo " <br> <span class='alert alert-warning'>" . $_SESSION['mensagem'] . " <br> </span>";
}



?>
<div class="container-sm">

    <div class="d-flex justify-content-end">

        <form action="http://<?php echo APP_HOST; ?>/pedido/" method="get" class="form-inline">


            <label for="basic-url" class="form-label">Pesquisa por data:</label>
            <div class="input-group mb-3" style="width:450px;">


                <input class="form-control" type="date" name="dt1" placeholder="" aria-label="Recipient's username">

                <input class="form-control" type="date" name="dt2" placeholder="" aria-label="Recipient's username">
                <button class="btn btn-outline-success" type="subimit" id="button-addon2">Buscar</button>

            </div>
        </form>
    </div>




    <hr>
    <?php
    if ($_SESSION['tipo'] == 'user') {
        ?>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Número do pedido </th>
                    <th scope="col">Tipo Pagamento</th>
                    <th scope="col">Data</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>

            <?php
            if (isset($_SESSION['mensagem']) && $_SESSION['mensagem'] == 'Sem resultado') {
                echo "<tbody class='d-none'>";
            } else {
                echo "<tbody >";
            }

            foreach ($viewVar['listaPedidos'] as $pedido) {
                $date = date_create($pedido->getData());
                ?>

                <tr>
                    <th scope="row">

                        <?php echo $pedido->getPed_num() ?>
                    </th>
                    <td>
                        <?php echo $pedido->getTipoPagamento()->getNome() ?>
                    </td>
                    <td>
                        <?php echo date_format($date, 'd/m/Y H:i:s' )?>
                    </td>
                    <td>

                        <?php echo $pedido->getProdutos() ?>
                    </td>
                    <td>
                        R$
                        <?php echo number_format($pedido->getValor(), 2, ',', '.') ?>
                    </td>
                    <td>

                        <form method="post" action="http://<?php echo APP_HOST ?>/pedido/carrinho" class="d-flex">

                            <input type="hidden" name="cod" value="<?php //echo $produto->getCodigo()?>">


                            <input type="hidden" name="preco" value="<?php //echo $produto->getPreco()?>">

                            <?php
                            if ($pedido->getStatus()->getStatusId() == 2) {
                                ?>
                                <a
                                    href="http://<?php echo APP_HOST ?>/pagamento/pagar/<?php echo $pedido->getPed_num() ?>">Pagar</a>
                                &nbsp; &nbsp; &nbsp;

                                <a
                                    href="http://<?php echo APP_HOST ?>/pedido/cancelar/<?php echo $pedido->getPed_num() ?>">Cancelar</a>
                            <?php } ?>
                            <?php
                            if ($pedido->getStatus()->getStatusId() == 1) {
                                ?>
                                <a
                                    href="http://<?php echo APP_HOST ?>/pedido/finalizado/<?php echo $pedido->getPed_num() ?>">Finalizado</a>
                            <?php }
                            if ($pedido->getStatus()->getStatusId() == 3) { ?>

                                <a href="">Cancelado</a>

                            <?php } ?>
                        </form>
                    </td>
                </tr>

            <?php } ?>




            </tbody>
        </table>
    <?php } else { ?>
        <h3>Pedidos dos usuarios</h3>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Usuario</th>
                    <th scope="col">Número do pedido </th>
                    <th scope="col">Tipo Pagamento</th>
                    <th scope="col">Data</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            
                <?php

                if (isset($_SESSION['mensagem']) && $_SESSION['mensagem'] == 'Sem resultado') {
                    echo "<tbody class='d-none'>";
                } else {
                    echo "<tbody >"; ?>
                   
               <?php }


                foreach ($viewVar['listaPedidos'] as $pedido) {
                    $date = date_create($pedido->getData());
                    ?>

                    <tr>
                        <th scope="row">

                            <?php echo $pedido->getUsuario()->getId() ?>
                        </th>
                        <th scope="row">

                            <?php echo $pedido->getPed_num() ?>
                        </th>
                        <td>
                            <?php echo $pedido->getTipoPagamento()->getNome() ?>
                        </td>
                        <td>
                            <?php echo date_format($date, 'd/m/Y H:i:s' ) ?>
                        </td>
                        <td>

                            <?php echo $pedido->getProdutos() ?>
                        </td>
                        <td>
                            R$
                            <?php echo number_format($pedido->getValor(), 2, ',', '.') ?>
                        </td>
                        <td>

                            <a href="">Editar</a>

                        </td>
                    </tr>

                <?php } ?>




            </tbody>
        </table>
    <?php } ?>
    <div class="teste">
        <?php 
        
           echo $viewVar['paginacao']; 
        
        ?>
        <?php 
            if (isset($_SESSION['mensagem']) && $_SESSION['mensagem'] == 'Sem resultado') {?>
            <a href="http://<?php echo APP_HOST ?>/pedido" > Nova busca </a>
           <?php
            }
        ?>
    </div>

</div>