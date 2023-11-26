
<div class="container">
<h1>Pagameto</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col" class="text-center">Quantidade</th>
                <th scope="col" class="text-center">Valor Unitario</th>
                <th scope="col" class="text-center">Valor Total</th>

            </tr>
        </thead>
        <tbody>
            <form method="post" action="http://<?php echo APP_HOST ?>/pagamento/finalizar" class="text-center">

                <?php
                $somaTotal = 0;
                $i = 0;
               // $carrinho = $_SESSION['carrinho'];

               $arr_produtos = array();    
              
              // var_dump($viewVar['listaPedidos']);

               if(isset($viewVar['listaPedidos'])){
                         
                   $arr_produtos = $viewVar['listaPedidos'];
                
                }
                 //var_dump($arr_produtos);exit;


                foreach ($arr_produtos as $chave => $produto) { ?>

                    <tr>

                        <td>
                            <?php echo $produto['nome'] ?>
                        </td>
                        <td class="text-center">
                            <?php echo $produto['qtd'] ?>
                        </td>
                        <td class="text-center">R$

                            <?php echo number_format($produto['preco'], 2, ',', '.') ?>
                        </td>
                        <td class="text-center"> R$ <?php echo  number_format($produto['preco'] * $produto['qtd'], 2, ',', '.') ?></td>



                    </tr>

                    <?php
                    echo $somaTotal += $produto['preco'] * $produto['qtd'];
                $i ++; } ?>
                <tr>
                    <th colspan="2"></th>
                    <th class="text-center">Total</th>
                    <th class="text-center">R$ <?php echo number_format($somaTotal, 2, ',', '.') ?></th>
                    <input type="hidden" name="valor_total" value="<?php echo $somaTotal ?>">
                   
                  
                    <input type="hidden" name="ped_num" value="<?php echo $produto['ped_num']?>" >
                    

                <tr>
                    <td style="text-align: end;" class="align-items-center">
                        &nbsp;
                    </td>

                    <td class="text-end" colspan="2">
                        <input type="text" value="<?php echo $produto['pgto_cod'] ?>" class="input-group-text"
                            style="height: 40px; width: 400px;margin-left: auto;" name="identificador">

                    </td>

                    <!--  <td class="d-flex align-items-center">

                    </td> -->

                    <td class="text-center align-items-center">
                        <input class="btn btn-primary" type="submit" value="Pagar" style="margin-right: auto;"
                            name="btnPagar">
                    </td>

                </tr>
               
            </form>
        </tbody>
    </table>



</div>