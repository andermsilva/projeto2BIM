<?php 
namespace App\Models\Entidades;

use App\Models\Entidades\Pedido;
use App\Models\Entidades\Produto;

class ProdutoPedido{

    private Produto $produto;
    private Pedido $pedido;
    private int $qtde;
    private float $valorUnitario;
    private float  $desconto;
    private float $sutotal;

    public function __construct(){
        $this->produto = new Produto();
        $this->pedido = new Pedido();
    }

  
    public function getProduto()
    {
        return $this->produto;
    }

    public function setProduto($produto)
    {
        $this->produto = $produto;

        return $this;
    }

    public function getPedido()
    {
        return $this->pedido;
    }

    public function setPedido($pedido)
    {
        $this->pedido = $pedido;

        return $this;
    }

  
    public function getQtde()
    {
        return $this->qtde;
    }

  
    public function setQtde($qtde)
    {
        $this->qtde = $qtde;

        return $this;
    }

    public function getValorUnitario()
    {
        return $this->valorUnitario;
    }

    public function setValorUnitario($valorUnitario)
    {
        $this->valorUnitario = $valorUnitario;

        return $this;
    }

  
    public function getDesconto()
    {
        return $this->desconto;
    }

  
    public function setDesconto($desconto)
    {
        $this->desconto = $desconto;

        return $this;
    }

   
    public function getSutotal()
    {
        return $this->sutotal;
    }
 
    public function setSutotal($sutotal)
    {
        $this->sutotal = $sutotal;

        return $this;
    }
}


?>