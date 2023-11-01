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
            <a class="nav-link active text-light" aria-current="page" href="http://<?php echo APP_HOST; ?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="#">Produtos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="#">Pedidos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="#">Sobre</a>
          </li>
        </ul>
        <a href="" class="nav-link text-light">

          <img src="http://<?php echo APP_HOST; ?>/public/image/carrinho.svg" width="20">&nbsp;
          <span class="qtd-car">03</span>
        </a> &nbsp;
        <div class="dropdown" style="margin-right: 80px;">
          <button class="btn  dropdown-toggle text-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            user
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" style="width: 30px;" href="#">minha conta</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li><a class="dropdown-item" style="width: 30px;" href="#">logout

              </a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

</div>