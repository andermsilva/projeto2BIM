<?php 
namespace App\Models\Entidades;
use App\Models\Entidades\Status;

class Pedido{

    private int $ped_num;
    private TipoPagamento $tipoPagamento;
    private Usuario $usuario;
    private int $produtos;
    private string $data;
    private float $valor;
    private Endereco $endereco;
    private Status $status;

    public function __construct(){

        $this->tipoPagamento = new TipoPagamento();
        $this->endereco = new Endereco();
        $this->status = new Status();
        $this->usuario = new Usuario();
      }


    
    public function getPed_num()
    {
        return $this->ped_num;
    }

    
    public function setPed_num($ped_num)
    {
        $this->ped_num = $ped_num;

       
    }

    
    public function getTipoPagamento()
    {
        return $this->tipoPagamento;
    }

    public function setTipoPagamento($tipoPagamento)
    {
        $this->tipoPagamento = $tipoPagamento;

   
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

  
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

       
    }

  
    public function getStatus()
    {
        return $this->status;
    }

   
    public function setStatus($status)
    {
        $this->status = $status;

       
    }

   
    public function getData()
    {
        return $this->data;
    }

   
    public function setData($data)
    {
        $this->data = $data;

      
    }

    public function getValor()
    {
        return $this->valor;
    }

  
    public function setValor($valor)
    {
        $this->valor = $valor;

       
    }

  
    public function getEndereco()
    {
        return $this->endereco;
    }

   
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;

        
    }

    public function getProdutos()
    {
        return $this->produtos;
    }

  
    public function setProdutos($produtos)
    {
        $this->produtos = $produtos;

        return $this;
    }
}

?>