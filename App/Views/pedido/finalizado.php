<h1 class="text-center">Pedido Finalizado</h1>
<?php
if (isset($_SESSION['erro'])) {

    echo "<br> <span class='alert alert-warning'> " . $_SESSION['erro'] . " <br> </span>";
}
if (isset($_SESSION['mensagem'])) {

    echo " <br> <span class='alert alert-warning'>" . $_SESSION['mensagem'] . " <br> </span>";
}



?>
<div class="container-sm">

   
<div class="d-flex justify-content-end ">


    <div class="text-end" >
     <p><a class="link-offset-2" href="http://<?php echo APP_HOST ?>/pedido">
        Voltar para pedidos
    </a></p>

    </div>

</div>
    <hr>

    <table class="table">
        <thead>
          
            <tr>
                <th colspan="4" >
                    <span> Numero do pedido:
                        <?php echo $viewVar['pedido'][0]['ped_num'] ?>
                    </span>
                   
                </th>
                <th class="text-end">
                <span> Forma de pagamento:
                        <?php echo $viewVar['pagamento']->getNome() ?>
                    </span>
                </th>
            </tr>
            <tr>
                <th colspan="5" class="text-center">
 <!-- #region -->Endereço da entrega
                </th>
            </tr>
            <tr>
                <th>Rua</th>
                <th>Numero</th>
                <th>Bairro</th>
                <th>CEP</th>
                <th class="text-center">Cidade</th>

            </tr>
            <tr>
                <th>
                    <?php echo $viewVar['local']->getLogradouro();

                    // echo $viewVar['pedido'][0]['ped_num']
                    ?>

                </th>
                <th>
                    <?php echo $viewVar['local']->getNumero();

                    // echo $viewVar['pedido'][0]['ped_num']
                    ?>

                </th>
                <th>
                    <?php echo $viewVar['local']->getBairro();

                    // echo $viewVar['pedido'][0]['ped_num']
                    ?>

                </th>
                <th>
                    <?php echo $viewVar['local']->getCep();

                    // echo $viewVar['pedido'][0]['ped_num']
                    ?>

                </th>
                <th class="text-center">
                    <?php echo $viewVar['local']->getCidade();

                    // echo $viewVar['pedido'][0]['ped_num']
                    ?>

                </th>
            </tr>
            <tr>
                <th colspan="5" class="text-center">
 <!-- #region -->Itens do Pedido
        </th>
            </tr>
            <tr>

                <th scope="col">Produto</th>
                <th scope="col">Data</th>
                <th scope="col">Quantidade</th>
                <th colspan="2" scope="col" class="text-end">Valor</th>

            </tr>

        </thead>
        <tbody>
        
            <?php


            foreach ($viewVar['pedido'] as $pedido) { ?>

                <tr>

                    <td>
                        <?php echo $pedido['nome'] ?>
                    </td>
                    <td>
                        <?php echo $pedido['ped_data'] ?>
                    </td>
                    <td>

                        <?php echo $pedido['qtd'] ?>
                    </td>
                    <td colspan="2" class="text-end">
                        R$
                        <?php echo number_format($pedido['valor'], 2, ',', '.') ?>
                    </td>
                    <!--  <td>

                        <form method="post" action="http://<?php echo APP_HOST ?>/pedido/carrinho" class="d-flex">

                            <input type="hidden" name="cod" value="<?php //echo $produto->getCodigo()?>">


                            <input type="hidden" name="preco" value="<?php echo $produto['qtd'] ?>">

                            <?php
                            if ($pedido['pgto_cod'] == 2) {
                                ?>
                                <a
                                    href="http://<?php echo APP_HOST ?>/pagamento/pagar/<?php echo $pedido->getPed_num() ?>">Pagar</a>
                              &nbsp;  &nbsp;  &nbsp;

                                <a href="http://<?php echo APP_HOST ?>/pedido/cancelar/<?php echo $pedido->getPed_num() ?>">Cancelar</a>
                            <?php } ?>
                            <?php
                            if ($pedido['pgto_cod'] == 1) {
                                ?>
                                <a href="">Finalizado</a>
                            <?php }
                            if ($pedido['pgto_cod'] == 3) { ?>

                                <a href="">Cancelado</a>

                            <?php } ?>
                        </form>
                    </td> -->
                </tr>

            <?php } ?>




        </tbody>
    </table>

    <div class="teste">

    </div>

</div>