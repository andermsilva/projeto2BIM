<h2 class="text-center">
    <?php

    use App\Lib\Sessao;

    echo TITLE; ?> Endereços
</h2>




<div class="container-sm">

    <div class="d-flex justify-content-between">

        <div>

            <a class="" href="http://<?php echo APP_HOST ?>/endereco/cadastro">
                <button type="button" class="btn btn-success">Novo</button>
            </a>
        </div>


    
    </div>




    <hr>
    <table class="table">
        <thead>
            <tr>
                <?php if(isset($_SESSION['tipo']) && $_SESSION['tipo']== 'user'){?>
                <th colspan="8"><?php echo $_SESSION['username']?></th>
                <?php } else{?>
                    <th colspan="8">Administrativo</th>
                    <?php }?>
            </tr>
            <tr>
                <th scope="col">#</th>
                <th scope="col-2">Rua</th>
                <th scope="col-2">Numero</th>
                <th scope="col-2">Bairro</th>
                <th scope="col-2">CEP </th>
                <th scope="col-2">Complemento</th>


                <th scope="col-2">Cidade</th>
                <th scope="col-2" class="text-center">Apagar</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">

            <?php
       
            foreach ($viewVar['locais'] as $local) { ?>
                <tr>
                    <td>

                        <?php echo $local->getEndCod() ?> 
                          
                        
                    </td>
                    <td>

                        <?php echo $local->getLogradouro() ?>
                    </td>
                    <td>

                        <?php echo $local->getNumero() ?>
                    </td>

                    <td>

                        <?php echo $local->getBairro() ?>
                    </td>
                    <td>

                        <?php echo $local->getCep() ?>
                    </td>
                    <td>

                        <?php echo $local->getComplemento() ?>
                    </td>
                    <td>
                        <?php echo $local->getCidade() ?>

                    </td>
                    <td>

                       <a href="http://<?php echo APP_HOST; ?>/endereco/excluir/<?php echo $local->getEndCod() ?>">
                       <button type="button" onClick="confirm('Deseja Realmente apagar o endereço?')" class="btn btn-danger">Apagar</button>

                    </a>
                    </td>

                </tr>

            <?php } ?>
        </tbody>
    </table>

</div>