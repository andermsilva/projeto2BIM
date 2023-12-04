<section class="container_card ">
    <form method="post" action="http://<?php echo APP_HOST ?>/pedido/salvarPedido" style="width: 80%;" class="text-center mx-auto">
        <div class="text">
            <h4 class="text-center">FINALIZAR PEDIDO</h4>
        </div>
        <div class="cl_filtro" style="margin-left: 0;">
            <label for="">Endereços de Entrega</label>

            <?php
         
            ?>
            <select class="form-select form-select-sm" name="endereco">

                <!--  <option>Selecione um endereço para entrega</option> -->
//
                <?php
             //   var_dump($viewVar['result']);exit;
                foreach ($viewVar['result'] as $item) {
                  //  for ($i = 0; $i < count($item); $i++) {

                        ?>

                        <option value="<?php echo $item->getEndCod(); ?>">

                           Rua: <?php echo $item->getLogradouro(); ?>, 
                           Nº: <?php echo $item->getNumero(); ?>
                           Bairro: <?php echo $item->getBairro(); ?>,
                           CEP: <?php echo $item->getCep(); ?>, 
                          Complemento:  <?php /* echo $item->getComplemento(); */ ?>,
                          Cidade:  <?php echo $item->getCep(); ?>
                            

                        </option>

                        <?php

                   // }
                } ?>
            </select>
        </div>
        <hr>
        <table class="table">
            <thead>
                <tr>

                    <th scope="col">Nome</th>
                    <th scope="col" class="text-center">Quantidade</th>
                    <th scope="col" class="text-center">Valor Unitario</th>
                    <th scope="col" class="text-center">Valor Total</th>
                    <th scope="col" class="text-center">Excluir</th>
                </tr>
            </thead>
            <tbody>

                <?php


                $somaTotal = 0;
              /*   $i = 0;
                $vetor = $_SESSION['carrinho']; */

             /*  var_dump($_SESSION['listaPedidos']);
              echo "<hr>"; */
              $arr_produtos = array();    
              
              if(isset($_SESSION['listaPedidos']) && count($_SESSION['listaPedidos'])>0){
                        
                  $arr_produtos = $_SESSION['listaPedidos'];
               
                }else{

                   // echo "aqui2"; exit;
                    $arr_produtos = $_viewVar['listaPedidos'];
                }
                //var_dump($arr_produtos);exit;

                foreach ($arr_produtos as $produto) {


                    if ($produto != null) { ?>
                        <tr>

                            <td>
                                <?= $produto['nome'] ?>

                            </td>
                            <td class="text-center">
                                <?= $produto['qtd'] ?>
                            </td>

                            <td class="text-center">R$
                                <?= number_format($produto['preco'], 2, ',', '.') ?>
                            </td>

                            <td class="text-center">R$
                                <?= number_format(($produto['preco'] * $produto['qtd']), 2, ',', '.') ?>
                            </td>

                            <td class="text-center">

                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">



                                    <button class="btn btn-danger" onclick="confirm('Deseja excluir o registro?')">
                                        <a style="color:white; text-decoration: none;"
                                            href="http://<?php echo APP_HOST ?>/pedido/alterarPedido/<?php echo $produto['cod'] ?>">Excluir</a>

                                    </button>

                                </div>

                            </td>

                        </tr>

                        <?php

                        $somaTotal += $produto['preco'] * $produto['qtd'];
                       // $i++;
                    }
                } ?>
                <tr>
                    <th colspan="2"></th>
                    <th class="text-center">Total</th>
                    <th class="text-center">R$
                        <?= number_format($somaTotal, 2, ',', '.') ?>
                    </th>
                    <th colspan="2"></th>
                </tr>
            </tbody>
        </table>



        <div class="text-center">
            <?php

            foreach ($viewVar['tipos'] as $tpPgto) { ?>

                <label for="pgto">
                    <?php echo $tpPgto->getNome() ?>
                </label>


                <input type="radio" name="pgto" required <?php $tpPgto->getCod() == 9 ? 'checked' : '' ?> id="pgto"
                    value="<?php echo $tpPgto->getCod()?>">&nbsp;


            <?php } ?>
            <br />
            <br />
              <input type="hidden" name="iduser" value="<?php echo $_SESSION['iduser'];?>">
              <input type="hidden" name="total" value="<?php echo $somaTotal;?>">
            <input type="submit" class="btn btn-outline-success" name="finalizar" value="Realizar Pagamento" />
        </div>

    </form>

</section>

<!--   </form> -->
</div>
</div>