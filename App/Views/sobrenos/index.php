<?php
    use App\Lib\Sessao;
?>


<div class="container-sm">

    <?php
 /*    if (Sessao::retornaErro()) {
        echo "<br> <span class='alert alert-warning'> " . Sessao::retornaErro() . " <br> </span>";
    }
    if (Sessao::retornaMensagem()) {
        echo " <br> <span class='alert alert-warning'>" . Sessao::retornaMensagem() . " <br> </span>";
    } */
    ?>
        <div style="font-size: 35px;">
              <p class="text-center">Sobre Nós</p>
        </div>
                
   
        <div>
           <p  style="font-size: 25px;"> De onde Viemos: </p>
             <?php  echo $viewVar['nos']->getDe_onde_viemos(); ?>
        </div>
        
        <div>
            <p style="font-size: 25px;"> Fundação: </p>
             <?php echo $viewVar['nos']->getFundacao(); ?>
        </div>
        <div>
            <p style="font-size: 25px;"> Porque Cidade: </p>
             <?php echo $viewVar['nos']->getPorqueCidade(); ?>
        </div>
        <div>
            <p style="font-size: 25px;"> Curiosidades: </p>
             <?php echo $viewVar['nos']->getCuriosidades(); ?>
        </div>
           
        
        
        

    
   
   
     
    
             

