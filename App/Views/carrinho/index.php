<div class="container-sm" style="width: 600px;">

    <h2>Carrinho de compras</h2>
    <?php
       if (isset($_SESSION['erro'])) {

           echo "<br> <span class='alert alert-warning'> " . $_SESSION['erro'] . " <br> </span>";
       }
       if (isset($_SESSION['mensagem'])) {

           echo " <br> <span class='alert alert-warning'>" . $_SESSION['mensagem'] . " <br> </span>";
       }

     

    ?>
    <hr>

    <div class="d-flex justify-content-between">
  
        <a class="" href="http://<?php echo APP_HOST ?>/pedido/esvaziar">
            <button type="button" class="btn btn-secondary">Esvaziar</button>
        </a>
       
        <a class="" href="http://<?php echo APP_HOST ?>/pedido/verificar">
            <button type="button" class="btn btn-success">Finalizar Comprar</button>
        </a>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">
                    foto
                </th>
                <th scope="col">Nome</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Pseso/ml</th>
                <th scope="col">Valor</th>

                <th scope="col">Ações</th>

            </tr>
        </thead>
        <tbody>

            <?php
            //var_dump($_SESSION["endereco"]);
            if(isset($_SESSION['listaPedidos'])){

            for ($i = 0; $i < count($_SESSION['listaPedidos']); $i++) {
                $pedido = $_SESSION['listaPedidos'][$i];
                $cor = "";
                if ($i % 2 == 0) {
                    $cor = 'table-primary';
                } else {
                    $cor = 'table-warning';
                }
                ?>

                <tr <?php echo "class = '" . $cor . "' d-flex" ?>>
                    <td class="m-auto">
                        <img src="http://<?php echo APP_HOST; ?>/public/image/produtos/<?php echo $pedido['imagem'] ?>"
                            width="60" alt="">

                    </td>

                    <td class="m-auto">
                        <div>

                            <?php echo $pedido['nome'] ?>
                        </div>
                    </td>

                    <td>
                        <div>

                            <?php echo $pedido['qtd'] ?>
                        </div>
                    </td>

                    <td>


                        <div>
                            <?php echo $pedido['peso'] ?>

                        </div>
                    </td>

                    <td>

                        <div>

                            <?php echo $pedido['valor'] ?>
                        </div>
                    </td>

                    <td class="d-flex item-justfy-center" style="height:60px;">

                        <div class="m-auto">
                            <a class="link-underline mt-2" 
                            href="http://<?php echo APP_HOST ?>/pedido/alterarPedido/<?php echo $pedido['cod']?>">
                                <img src="http://<?php echo APP_HOST ?>/public/image/excluir.png" width="25" alt="">
                            </a>
                        </div>

                    </td>


                </tr>



            <?php } } else{?>
                    <tr>
                        <td class="text-center" colspan="6"><h4>Carrinho vazio</h4></td>
                    </tr>
                <?php }?>
        </tbody>
    </table>

</div>