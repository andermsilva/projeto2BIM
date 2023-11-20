<h1>pedidos</h1>
<div class="container-sm">

    <div class="d-flex justify-content-end">

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
                <th scope="col">Número so pedido </th>
                <th scope="col">Tipo Pagamento</th>
                <th scope="col">Data</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Valor</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            foreach ($viewVar['listaPedidos'] as $pedido) { ?>

                <tr>
                    <th scope="row">

                        <?php echo $pedido->getPed_num() ?>
                    </th>
                    <td>
                        <?php echo $pedido->getTipoPagamento()->getNome() ?>
                    </td>
                    <td>
                        <?php echo $pedido->getData() ?>
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


                            <a href="">Finalizar</a>/ 
                            <a href="">Cancelar</a>
                           
                        </form>
                    </td>
                </tr>

            <?php } ?>




        </tbody>
    </table>

    <div class="teste">
        <?php echo $viewVar['paginacao']; ?>
    </div>

</div>