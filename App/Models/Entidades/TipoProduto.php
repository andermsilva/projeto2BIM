<?php 
 namespace App\Models\Entidades;
 
 class TipoProduto{

    private int $tipocod;
    private string $tipo_nome;

    public function getTipo_nome():string
    {
        return $this->tipo_nome;
    }

   
    public function setTipo_nome($tipo_nome)
    {
        $this->tipo_nome = $tipo_nome;
  
    }

     public function getTipocod():int
    {
        return $this->tipocod;
    }
    
    public function setTipocod($tipocod)
    {
        $this->tipocod = $tipocod;

    }
 }
 ?>