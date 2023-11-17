<div class="container-sm" style="width: 400px;">

    <h2>Carrinho de compras</h2>
    <?php
 /*    if ($_SESSION['erro']) {

        echo "<br> <span class='alert alert-warning'> " . $_SESSION['erro'] . " <br> </span>";
    }
    if ($_SESSION['mensagem']) {

        echo " <br> <span class='alert alert-warning'>" . $_SESSION['mensagem'] . " <br> </span>";
    } */

    ?>
    <hr>

    <div>

        <a class="" href="http://<?php echo APP_HOST ?>/pedido/esvaziar">
            <button type="button" class="btn btn-secondary">Esvaziar</button>
        </a>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Ações</th>

            </tr>
        </thead>
        <tbody>

            <?php
            // var_dump($viewVar["listaTipos"][5]);exit;
            /* for ($i = 0; $i < count($viewVar["listaTipos"]); $i++) {
                $tipo = $viewVar["listaTipos"][$i];
                $cor = "";
                if ($i % 2 == 0) {
                    $cor = 'table-primary';
                } else {
                    $cor = 'table-warning';
                } */
                ?>

                <tr <?php //echo "class = '" . $cor . "'" ?> >
                    <td>
                        <?php //echo $tipo->getTipocod() ?>
                    </td>
                    <td>
                        <?php //echo $tipo->getTipo_nome() ?>
                    </td>
                    <td class="d-flex item-justfy-center">
                        <div>

                            <a class="link-underline"
                             href="http://<?php echo APP_HOST ?>/tipoproduto/cadastro/<?php echo $tipo->getTipoCod()?>">
                                <img src="http://<?php echo APP_HOST ?>/public/image/editar.png" width="25" alt="">
                            </a>
                        </div>
                        <div>


                            <a class="link-underline" href="http://<?php echo APP_HOST ?>/tipoproduto/exclusao">
                                <img src="http://<?php echo APP_HOST ?>/public/image/excluir.png" width="25" alt="">
                            </a>
                        </div>

                    </td>


                </tr>



            <?php // } ?>
        </tbody>
    </table>

</div>