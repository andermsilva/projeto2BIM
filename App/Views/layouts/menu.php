<div class="cor-bg-ft-mn text-light">

  <nav class="navbar navbar-expand-lg espacamento">
    <div class="container-fluid">

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
        aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active text-light" aria-current="page" href="http://<?php



            echo APP_HOST; ?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="http://<?php echo APP_HOST; ?>/produto">Produtos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" 
            
            href="http://<?php echo APP_HOST; ?>/pedido">
            Pedidos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="http://<?php echo APP_HOST; ?>/sobrenos">Sobre</a>
          </li>

          <?php
          if (isset($_SESSION['loggedin']) && isset($_SESSION['username']) && $_SESSION['tipo']=='admin') { ?>
            <li class="nav-item">
              <a class="nav-link text-light" href="http://<?php echo APP_HOST; ?>/tipoproduto">Tipo Produto </a>
            </li>

          <?php } ?>

        </ul>
        <a href="http://<?php echo APP_HOST; ?>/pedido/carrpedido" class="nav-link text-light">

          <img src="http://<?php echo APP_HOST; ?>/public/image/carrinho.svg" width="20">&nbsp;
          <span class="qtd-car"><?php echo (isset($_SESSION['carrinho']))? count($_SESSION['carrinho']):'0'?></span>
        </a> &nbsp;

        <?php if (isset($_SESSION['loggedin']) && isset($_SESSION['username'])) { ?>
          
          <div class="dropdown" style="margin-right: 40px;">
            <button class="btn  dropdown-toggle text-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
               <?php echo substr($_SESSION['username'], 0, 8) ?>
            </button>
                   
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" style="width: 30px;"
                  href="http://<?php echo APP_HOST; ?>/login/dashboard">Minha conta</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>

              <li><a class="dropdown-item" style="width: 30px;" href="http://<?php echo APP_HOST; ?>/login/logout">Logout

                </a></li>
            </ul>
          </div>
        <?php } else { ?>
          <div class="" style="margin-right: 80px;">
            <a href="http://<?php echo APP_HOST; ?>/login" class="dropdown-item">
              Entrar/Cadastrar
            </a>

          </div>
          <?php

        } ?>
      </div>

    </div>
  </nav>

</div>
<main>