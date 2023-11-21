<?php 
  namespace App\Models\Entidades;

  class Pagamento{
    private int $id;
    private TipoPagamento $tipoPgto;
    private string $dataPgto;
    private float $valor;
    private Pedido $pedido;
    private string $cancelado;

    public function __construct(){
        $this->tipoPgto = new TipoPagamento();
        $this->pedido =  new Pedido();
    }
  
    public function getId()
    {
        return $this->id;
    }

 
    public function setId($id)
    {
        $this->id = $id;

    
    }

     
    public function getDataPgto()
    {
        return $this->dataPgto;
    }

    
    public function setDataPgto($dataPgto)
    {
        $this->dataPgto = $dataPgto;

       
    }

    public function getValor()
    {
        return $this->valor;
    }

  
    public function setValor($valor)
    {
        $this->valor = $valor;

     
    }

 
    public function getPedido()
    {
        return $this->pedido;
    }

    
    public function setPedido($pedido)
    {
        $this->pedido = $pedido;

       
    }

  
    public function getCancelado()
    {
        return $this->cancelado;
    }

    public function setCancelado($cancelado)
    {
        $this->cancelado = $cancelado;

    
    }

    public function getTipoPgto()
    {
        return $this->tipoPgto;
    }

    public function setTipoPgto($tipoPgto)
    {
        $this->tipoPgto = $tipoPgto;

        return $this;
    }
  }

?>