<?php 
 namespace App\Models\Entidades;
 
 class TipoProduto{

    private int $tipo_cod;
    private string $tipo_nome;

    /**
     * Get the value of tipo_nome
     */ 
    public function getTipo_nome():string
    {
        return $this->tipo_nome;
    }

   
    public function setTipo_nome($tipo_nome)
    {
        $this->tipo_nome = $tipo_nome;

        
    }

 
    public function getTipo_cod():int
    {
        return $this->tipo_cod;
    }

    
    public function setTipo_cod($tipo_cod)
    {
        $this->tipo_cod = $tipo_cod;

    }
 }
 ?>